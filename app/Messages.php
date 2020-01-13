<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Messages extends Model
{
    //
    protected $fillable=['id','sender_id','receiver_id','created_id','content'];

    public function ReceivUser()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
   public function SenderUser()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

}
