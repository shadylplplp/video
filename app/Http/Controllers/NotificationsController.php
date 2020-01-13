<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AUth;
use App\User;

class NotificationsController extends Controller
{
    //
    public function index()
    {
        // 获取登录用户的所有通知
        $notifications = Auth::user()->notifications()->paginate(10);

        Auth::user()->markAsRead();
        return view('notifications.index', compact('notifications'));
    }
}
