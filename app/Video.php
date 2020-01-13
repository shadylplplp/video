<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Danmu;

class Video extends Model
{
    //
    protected $fillable=['id','title','description','is_delete','video_path','video_image','video_type','is_reprint','state','user_id','views_count','comments_count'];
    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function Danmu()
    {
        return $this->hasMany(Danmu::class);
    }
}