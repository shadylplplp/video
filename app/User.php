<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Video;
use App\followers;
use App\Messages;
use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use App\Comment;
use Spatie\Permission\Traits\HasRoles;
use App\Danmu;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasRoles;
    use Notifiable, MustVerifyEmailTrait;
    //use MustVerifyEmailTrait;
    use Notifiable {
        notify as protected laravelNotify;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','avatar','notification_count','description','fans_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function Video()
    {
        return $this->hasMany(Video::class);
    }

    public function follow()
    {
        return $this->hasMany(followers::class);
    }

    public function Message()
    {
        return $this->hasMany(Messages::class);
    }
    public function Danmu()
    {
        return $this->hasMany(Danmu::class);
    }
/*    public function ReceiveMessage()
    {
        return $this->hasMany(Messages::class,'id','sender_id');
    }*/
    public function notify($instance)
    {
        if ($this->id == Auth::id()) {
            return;
        }

        // 只有数据库类型通知才需
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }
        $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

}
