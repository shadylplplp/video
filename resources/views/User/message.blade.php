@extends('layouts.app')

@section('title','投稿视频')

@section('content')
    @include('layouts._message')
    <div style="margin: auto; width: 70%; height: 500px; height: 100%; padding-bottom: 100px;">
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
        <div style="margin-left: 165px;height: 500px; width: 80%; background: #0d8ddb;background-color: transparent;box-shadow:0px 0px 8px 3px #ccc;">
            <table  style="margin-left: 30px; margin-top: 10px; width:93%;">
                <caption>我的私信</caption>
                <tbody>
                @foreach($message as $v)
                    @if($v->sender_id == Auth::id())
                        <tr height="60px" style="text-align: right">
                            <td>
                                <span style="margin-right: 5px;">{{$v->content}}</span>
                                <img src="{{$v->SenderUser->avatar}}" style="width: 40px; height: 40px; margin-left: 5px;">
                            </td>
                        </tr>
                    @else
                        <tr height="60px">
                            <td>
                                <img src="{{$v->SenderUser->avatar}}" style="width: 40px; height: 40px; margin-left: 5px;">
                                <span style="margin-left: 5px;">{{$v->content}}</span>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <form action="{{route('user.sendmessage')}}" method="post">
            @csrf
            <button style="float: right; margin-right: 55px; margin-top: 15px; width: 70px;" type="submit" class="btn btn-success">回复</button>
            <input type="hidden" name="receiver_id" value="{{$id}}">
            <div class="form-group" style="width: 780px; float: right; margin-top: 15px; margin-right: 10px;">
                <input class="form-control" name="content"  width="100px" placeholder="回复内容">
            </div>

        </form>
    </div>
@stop