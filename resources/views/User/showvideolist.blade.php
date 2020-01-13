@extends('layouts.app')

@section('title','投稿视频')

@section('content')

    <div style="margin: auto; width: 70%; height: 500px;">
        <ul class="nav nav-pills nav-stacked" style="width:150px; float: left;position: relative;">
            <li role="presentation"><a href="{{route('user.show')}}">个人信息</a></li>
            <li role="presentation"><a href="{{route('user.myfocus')}}">我的关注</a></li>
            <li role="presentation"><a href="{{route('user.myfans')}}">我的粉丝</a></li>
            <li role="presentation"><a href="{{route('user.contribute')}}">视频投稿</a></li>
            <li role="presentation" class="active"><a href="{{route('user.showvideolist')}}">投稿编辑</a></li>
            <li role="presentation"><a href="{{route('user.edit')}}">用户信息更改</a></li>
            <li role="presentation"><a href="{{route('user.passwordedit')}}">修改密码</a></li>
            <li role="presentation"><a href="{{route('user.messagelist')}}">私信</a></li>
        </ul>
        <div style="position: relative; margin-left: 15px; height: 600px; width: 80%; background: #0d8ddb;float: left; background-color: transparent;box-shadow:0px 0px 8px 3px #ccc;">
            <table class="table" style="margin-left: 30px; margin-top: 10px; width:800px;">
                <caption>我的投稿</caption>
                <tbody>
                @include('layouts._message')
                @foreach($videos as $video)
                <tr>
                    <td>
                        <a href="{{route('video.show',$video->id)}}">
                        <img src="{{$video->video_image}}" style=" position:relative; float: left; width: 96px; height: 59px; margin-right: 5px;">
                        </a>
                        <a href="{{route('video.show',$video->id)}}">
                        <h4 style="margin-top:0px; margin-left: 105px;">{{$video->title}}</h4>
                        </a>
                        @if($video->state==1)
                        <a href="#" style="margin-left: 3px;" class="btn btn-info btn-sm disabled" role="button">等待审核</a>
                        @elseif($video->state==3)
                            <a href="#" style="margin-left: 3px;" class="btn btn-danger btn-sm disabled" role="button">审核未通过</a>
                        @elseif($video->state==0)
                            <a href="#" style="margin-left: 3px;" class="btn btn-warning btn-sm disabled" role="button">正在转码</a>
                        @endif
                        <a href="{{route('user.deletevideo',$video->id)}}" onclick="return confirm('确定要删除视频?');">
                            <button type="button" style="float: right; margin-top: -20px;" class="btn btn-danger">删除</button>
                        </a>
                        <a href="{{route('user.showeditvideo',$video->id)}}">
                            <button type="button" style="float: right; margin-right: 8px; margin-top: -20px;" class="btn btn-primary">编辑</button>
                        </a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <div class="mt-5" style="margin-left: 30px; margin-top: -35px;">
                {!! $videos->appends(Request::except('page'))->render() !!}
            </div>
        </div>

    </div>
@stop