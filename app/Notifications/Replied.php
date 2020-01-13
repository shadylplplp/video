<?php

namespace App\Notifications;

use App\Messages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Replied extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $message;
    public function __construct(Messages $messages)
    {
        //
        $this->message=$messages;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $messages=$this->message;
        return [
            'message_id'=>$messages->id,
            'content'=>$messages->content,
            'sender_id'=>$messages->sender_id,
            'sender_name'=>$messages->SenderUser->name,
            'avatar'=>str_replace("\\/", "/", json_encode($messages->SenderUser->avatar,JSON_UNESCAPED_UNICODE)),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
