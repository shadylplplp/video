<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Video;

class Danmu extends Model
{
    public $table='danmu';

    protected $fillable=['id','time','text','position','size','color','video_id','user_id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Video()
    {
        return $this->belongsTo(Video::class);
    }

}