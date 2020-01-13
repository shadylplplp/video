@extends('layouts.app')

@section('title','投稿视频')

@section('content')
    @include('layouts._message')
    <div style="margin: auto; width: 70%; height: 500px;">
        <ul class="nav nav-pills nav-stacked" style="width:150px; float: left;position: relative;">
            <li role="presentation"><a href="{{route('user.show')}}">个人信息</a></li>
            <li role="presentation"><a href="{{route('user.myfocus')}}">我的关注</a></li>
            <li role="presentation"><a href="{{route('user.myfans')}}">我的粉丝</a></li>
            <li role="presentation"><a href="{{route('user.contribute')}}">视频投稿</a></li>
            <li role="presentation"><a href="{{route('user.showvideolist')}}">投稿编辑</a></li>
            <li role="presentation"><a href="{{route('user.edit')}}">用户信息更改</a></li>
            <li role="presentation"><a href="{{route('user.passwordedit')}}">修改密码</a></li>
            <li role="presentation" class="active"><a href="{{route('user.messagelist')}}">私信</a></li>
        </ul>
        <div style="position: relative; margin-left: 15px; height: 600px; width: 80%; background: #0d8ddb;float: left; background-color: transparent;box-shadow:0px 0px 8px 3px #ccc;">
            <table class="table" style="margin-left: 30px; margin-top: 10px; width:800px;">
                <caption>我的私信</caption>
                <tbody>
                @foreach($list as $v)
                <tr>
                    <td>
                        <img src="{{$v->avatar}}" style="width: 40px; height: 40px; margin-left: 5px;">
                        <a href="{{route('user.message',$v->id)}}">
                        <span style="margin-left: 5px;">{{$v->name}}</span>
                        </a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@stop