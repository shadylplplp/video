@extends('layouts.app')
@section('title','用户中心')

@section('content')
    <div style="margin: auto; width: 70%; height: 500px;">
    <ul class="nav nav-pills nav-stacked" style="width:150px; float: left;position: relative;">
        <li role="presentation" class="active"><a href="{{route('user.show')}}">个人信息</a></li>
        <li role="presentation"><a href="{{route('user.myfocus')}}">我的关注</a></li>
        <li role="presentation"><a href="{{route('user.myfans')}}">我的粉丝</a></li>
        <li role="presentation"><a href="{{route('user.contribute')}}">视频投稿</a></li>
        <li role="presentation"><a href="{{route('user.showvideolist')}}">投稿编辑</a></li>
        <li role="presentation"><a href="{{route('user.edit')}}">用户信息更改</a></li>
        <li role="presentation"><a href="{{route('user.passwordedit')}}">修改密码</a></li>
        <li role="presentation"><a href="{{route('user.messagelist')}}">私信</a></li>
    </ul>
        <div style="position: relative; margin-left: 15px; height: 600px; width: 80%; background: #0d8ddb;float: left; background-color: transparent;box-shadow:0px 0px 8px 3px #ccc;">
            <img class="img-thumbnail" src="{{$user->avatar}}" style="float: left; width: 100px; height: 100px; position: relative; margin-top: 50px; margin-left: 30px;">
            <ul class="list-group" style="width: 650px; float: left; position: relative; margin-top: 20px; margin-left: 35px;">
                <li class="list-group-item">用户名：{{$user->name}}</li>
                <li class="list-group-item">用户ID：{{Auth::id()}}</li>
                <li class="list-group-item">邮箱：{{$user->email}}</li>
                <li class="list-group-item">注册时间：{{$user->created_at}}</li>
            </ul>
        </div>

    </div>
@stop