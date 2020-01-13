<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Video;

class CommentController extends Controller
{
    //
    public function showcomments($id)
    {
        $comments=Comment::where('video_id',$id)
            ->where('is_delete',0)
            ->get();
        $content='';
        foreach ($comments as $comment)
        {
            $content.='<li class="media">
                    <div class="media-left">
                        <a href="'.route('user.showusercennter',$comment->User->id).'">
                            <img class="media-object img-circle" width="64px;" src="'.$comment->User->avatar.'">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">'.$comment->User->name.'</h4>
                        <span style="word-wrap:break-word; word-break:break-all;">'.$comment->content.'</span>
                    </div>
                </li>';
        }
        return $content;
    }
    public function createcomment(CommentRequest $commentRequest)
    {
        $data=$commentRequest->all();
        Comment::create([
            'user_id'=>Auth::id(),
            'content'=>$data['content'],
            'video_id'=>$data['video_id'],
        ]);
        $video=Video::find($data['video_id']);
        $video->comments_count++;
        $video->save();
        return redirect()->route('user.comments',$data['video_id']);
    }
}
