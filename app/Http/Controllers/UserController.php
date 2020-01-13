<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Handlers\UploadImageHandler;
use App\Messages;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Video;
use App\Followers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Policies\UserPolicy;
use App\Http\Requests\FollowRequest;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth',['excpet'=>['showuser']]);
    }

    //显示用户信息
    public function show(User $user)
    {
        $user = User::find(Auth::id());
        return view('User.show', compact("user"));
    }

    public function update(User $user,UserRequest $userRequest,UploadImageHandler $UploadImageHandler)
    {
        $data = $userRequest->all();
        $user = User::find(Auth::id());
        if ($user->name !== $data['name'])
        {
            $user->name=$data['name'];
        }
            $user->description=$data['description'];
        if (isset($data['avatar'])){
            $uploadfile=$UploadImageHandler->save($data['avatar'],'avatar',Auth::id(),120);
            $data['avatar']=$uploadfile['path'];
            $user->avatar=$data['avatar'];
        }
        $user->save();
        return redirect()->route('user.edit')->with('success','个人信息修改成功');
    }

    public function edit(User $user)
    {
        $user=User::find(Auth::id());
        return view('User.useredit',compact("user"));
    }

    public function passwordedit()
    {
        return view('User.passwordedit');
    }

    public function updatepassword()
    {
        return view('User.passwordedit');
    }

    public function passwordupdate(User $user,UserRequest $userRequest)
    {
        $user=User::find(Auth::id());
        $data=$userRequest->all();
        if (Hash::check($data['oldpassword'],$user->password))
        {
            if ($data['password']==$data['repeatnewpassword']){
                //旧密码输入正确 密码重复正确
                $user->password=Hash::make($data['password']);
                $user->save();
                return redirect()->route('user.passwordedit')->with('success', '修改密码成功');
            }else{
                //密码重复错误
                return redirect()->route('user.passwordedit')->with('danger', '新密码两次重复不一致');
            }
        }else{
            //旧密码输入错误
            return redirect()->route('user.passwordedit')->with('danger', '原密码输入错误');
        }
    }

    public function showmessageslist(User $user)
    {
        $messagelist=Messages::where('receiver_id',Auth::id())
            ->orwhere('sender_id',Auth::id())
            ->get();
        $list=array();
        foreach ($messagelist as $message)
        {
            $senderid=$message->sender_id;
            $receiverid=$message->receiver_id;
            if (in_array(strval($senderid),$list) == false && $senderid!==Auth::id()){
                $user=User::find($senderid);
                $list[$senderid]=$user;
            }elseif (in_array(strval($receiverid),$list)==false && $receiverid!==Auth::id()){
                $user=User::find($receiverid);
                $list[$receiverid]=$user;
            }
        }
        return view('User.messagelist',compact("list"));
    }


    public function showmyfans(Followers $followers)
    {
        $followers=followers::where('followed_id',Auth::id())->paginate(8);
        return view('User.myfans',compact("followers"));
    }

    public function showmyfocus()
    {
        $followeds=followers::where('follower_id',Auth::id())->paginate(8);

        return view('User.myfocus',compact("followeds"));
    }

    public function showvideolist()
    {
        $videos=Video::where('user_id',Auth::id())
            ->where('is_delete',0)
            ->orderby('created_at','desc')
            ->paginate(6);
        return view('User.showvideolist',compact("videos"));
    }

    public function showuser($id)
    {
        $user=User::find($id);
        $videos=Video::where('user_id',$id)
            ->where('is_delete',0)
            ->where('state',2)
            ->paginate(5);
        $follow=Followers::where('follower_id',Auth::id())
            ->where('followed_id',$id)
            ->get();
        return view('User.user',compact("user","videos","follow"));
    }
    public function showusercentcomments($id)
    {
        $user=User::find($id);
        $comments=Comment::where('user_id',$id)
            ->where('is_delete',0)
            ->paginate(10);
        $follow=Followers::where('follower_id',Auth::id())
            ->where('followed_id',$id)
            ->get();
        return view('User.usercomment',compact("user","comments","follow"));
    }

    public function checkfollow($id,User $user)
    {
        $user=Followers::where('follower_id',Auth::id())
                       ->where('followed_id',$id)
                       ->get();
        if (isset($user->id))
        {
            return 'aaa';
        }else{
            return 'bbb';
        }
    }

    public function follow($id,User $user)
    {
        $user=Followers::where('follower_id',Auth::id())
            ->where('followed_id',$id)
            ->get();
        if (count($user)>0)
        {
            Followers::where('follower_id',Auth::id())
                ->where('followed_id',$id)
                ->delete();
            $user=User::find($id);
            $user->fans_count--;
            $user->save();
            return '取消关注成功';
        }else{
            Followers::create([
                'follower_id'=>Auth::id(),
                'followed_id'=>$id,
            ]);
            $user=User::find($id);
            $user->fans_count++;
            $user->save();
            return '关注成功';
        }
    }
    public function myfocous(FollowRequest $followrequest,User $user)
    {
        $followers=Followers::where('follower_id',Auth::id())->get();
        $data=array();
        foreach ($followers as $follower)
        {
            $videos=Video::where('user_id',$follower->followed_id)
                        ->where('is_delete',0)
                        ->get();
            foreach ($videos as $video){
                array_push($data,$video);
            }
            $comments=Comment::where('user_id',$follower->followed_id)
                            ->where('is_delete',0)
                            ->get();
            foreach ($comments as $comment){
                array_push($data,$comment);
            }
        }
        $sort=[];

        foreach ($data as $k=>$v)
        {
            $sort[$k]=strtotime($v->created_at);
        }
        array_multisort($sort,SORT_DESC,$data);

        $page = $followrequest->page ?: 1;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;
        //实例化LengthAwarePaginator类，并传入对应的参数
        $data = new LengthAwarePaginator(array_slice($data, $offset, $perPage, true), count($data), $perPage,
            $page, ['path' => $followrequest->url(), 'query' => $followrequest->query()]);
        return view('User.myfollow',compact("data"));
    }

}
