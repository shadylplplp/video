<?php

namespace App\Observers;
use App\Notifications\Replied;
use App\User;
use App\Messages;

class MessageObserver
{
    //
    public function created(Messages $messages)  {
        $num=$messages->ReceivUser->notification_count;
        $num++;
        $messages->ReceivUser->notification_count=$num;
        $messages->save();
        $messages->ReceivUser->notify(new Replied($messages));
    }
}
