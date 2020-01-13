<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    //


    public function sendmessage(MessageRequest $messageRequest)
    {
        $data=$messageRequest->all();
        Messages::create([
            'receiver_id'=>$messageRequest['receiver_id'],
            'sender_id'=>Auth::id(),
            'content'=>$messageRequest['content'],
        ]);
        return redirect()->route('user.message',$messageRequest['receiver_id']);
    }

    public function showmessages($id)
    {
        $messagesdata=Messages::where('sender_id',$id)
            ->orwhere('receiver_id',$id)
            ->get();
        $message=[];
        foreach ($messagesdata as $v)
        {
            if ($v->receiver_id ==Auth::id() || $v->sender_id ==Auth::id())
            {
                array_push($message,$v);
            }
        }
        return view('User.message',compact("message","id"));
    }

}
