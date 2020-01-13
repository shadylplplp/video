<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Video;

class Comment extends Model
{
    //
    protected $fillable=['id','user_id','video_id','is_delete','content','created_at'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Video()
    {
        return $this->belongsTo(Video::class);
    }
}
