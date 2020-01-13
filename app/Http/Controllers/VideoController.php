<?php

namespace App\Http\Controllers;


use App\Video;
use App\Handlers\UploadVideoHandler;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class VideoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showvideolist', 'showvideo','index']]);
    }

    public function showcreate()
    {
        return view('User.contribute');
    }
    public function create(VideoRequest $videoRequest,Video $video,UploadVideoHandler $uploadVideoHandler)
    {
        $data=$videoRequest->all();
        $url=$uploadVideoHandler->save($data['video_path'],'video',Auth::id());
        $data['video_path']=$url['video_path'];
        $data['video_image']=$url['video_image'];
        $data['state']=$url['state'];
        $data['user_id']=Auth::id();
        if (isset($data['is_reprint']))
        {
            $data['is_reprint']=true;
        }else{
            $data['is_reprint']=false;
        }
        Video::create($data);
        return redirect()->route('user.contribute')->with('success','投稿成功');
    }
    public function showeditvideo($id)
    {
        $video=Video::find($id);
        if ($video->user_id!==Auth::id())
        {
            return redirect()->route('user.show');
        }
        return view('User.showeditvideo',compact("video"));
    }
    public function ditvideo(VideoRequest $videoRequest)
    {
        $data=$videoRequest->all();
        $video=Video::find($data['id']);
        if (Auth::id()!==$video->user_id)
        {
            return redirect()->route('user.show');
        }
        $video->title=$data['title'];
        $video->description=$data['description'];
        $video->video_type=$data['video_type'];
        if (isset($data['is_reprint']))
        {
            $video->is_reprint=1;
        }else{
            $video->is_reprint=0;
        }
        $video->save();
        return redirect()->route('user.showeditvideo',$data['id'])->with('success','编辑视频成功');
    }

    public function deletevideo($id)
    {
        $video=Video::find($id);
        if ($video->user_id==Auth::id())
        {
            $video->is_delete=1;
            $video->save();
            return redirect()->route('user.showvideolist')->with('success','删除视频成功');
        }
    }

    public function showvideolist($video_type)
    {
       switch ($video_type)
        {
            case 'fun':
                $type=1;
                break;
            case 'music':
                $type=2;
                break;
            case 'movie':
                $type=3;
                break;
            case 'dance':
                $type=4;
                break;
            case 'tec':
                $type=5;
                break;
            case 'game':
                $type=6;
                break;
            case 'food':
                $type=7;
                break;
        }
        $videos=Video::where('video_type',$type)
            ->where('is_delete',0)
            ->where('state',2)
            ->paginate(14);
        $videolist=Video::where('video_type',$type)
            ->where('is_delete',0)
            ->where('state',2)
            ->where('created_at','>=',date('Y-n-j G:H:i',time()-604800))
            ->orderby('views_count','desc')
            ->paginate(10);

        return view('video.videolist',compact("videos",'videolist'));
    }

    public function showvideo($id)
    {
        $video=Video::find($id);
        $messages=Comment::where('video_id',$id)
            ->where('is_delete',0)
            ->get();
        $video->views_count++;
        if ($video->state!=="0"){
            if (Auth::check())
            {
                if (Auth::user()->can('manage_contents') || Auth::id()==$video->user_id)
                {
                    return view('video.video',compact("video","messages"));
                }
            }elseif($video->state==2){
                $video->save();
                return view('video.video',compact("video","messages"));
            }
        }else{
            return '视频正在转码 请等待';
        }
    }

    public function index()
    {
        $fun=Video::where('video_type',1)->where('state','2')->where('is_delete',0)->orderBy('created_at','desc')->paginate(5);
        $music=Video::where('video_type',2)->where('state','2')->where('is_delete',0)->orderBy('created_at','desc')->paginate(5);
        $movie=Video::where('video_type',3)->where('state','2')->where('is_delete',0)->orderBy('created_at','desc')->paginate(5);
        $dance=Video::where('video_type',4)->where('state','2')->where('is_delete',0)->orderBy('created_at','desc')->paginate(5);
        $tec=Video::where('video_type',5)->where('state','2')->where('is_delete',0)->orderBy('created_at','desc')->paginate(5);
        $game=Video::where('video_type',6)->where('state','2')->where('is_delete',0)->orderBy('created_at','desc')->paginate(5);
        $food=Video::where('video_type',7)->where('state','2')->where('is_delete',0)->orderBy('created_at','desc')->paginate(5);

        return view('home',compact("fun","music","movie","dance","tec","game","food"));
    }

}
