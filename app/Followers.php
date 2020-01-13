<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    //
    protected $fillable=['id','followed_id','follower_id','created_at','updated_at'];

    public function FollowUser()
    {
        return $this->belongsTo(User::class,'follower_id');
    }
    public function FollowedUser()
    {
        return $this->belongsTo(User::class,'followed_id');
    }
}
