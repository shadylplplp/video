@extends('layouts.app')

@section('title','投稿视频')

@section('content')
    <div style="margin: auto; width: 70%; height: 500px;">
        <ul class="nav nav-pills nav-stacked" style="width:150px; float: left;position: relative;">
            <li role="presentation"><a href="{{route('user.show')}}">个人信息</a></li>
            <li role="presentation"><a href="{{route('user.myfocus')}}">我的关注</a></li>
            <li role="presentation"><a href="{{route('user.myfans')}}">我的粉丝</a></li>
            <li role="presentation" class="active"><a href="{{route('user.contribute')}}">视频投稿</a></li>
            <li role="presentation"><a href="{{route('user.showvideolist')}}">投稿编辑</a></li>
            <li role="presentation"><a href="{{route('user.edit')}}">用户信息更改</a></li>
            <li role="presentation"><a href="{{route('user.passwordedit')}}">修改密码</a></li>
            <li role="presentation"><a href="{{route('user.messagelist')}}">私信</a></li>
        </ul>
        <div style="position: relative; margin-left: 15px; height: 600px; width: 80%; background: #0d8ddb;float: left; background-color: transparent;box-shadow:0px 0px 8px 3px #ccc;">
            @include('layouts._message')
            <form style="margin: 25px;" method="post" action="{{route('user.editvideo')}}" enctype="multipart/form-data">
                @csrf
                <input name="id" type="hidden" value="{{$video->id}}">
                <div class="form-group">
                    <label for="exampleInputEmail1">视频标题</label>
                    <input class="form-control" name="title" value="{{$video->title}}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">视频简介</label>
                    <textarea class="form-control" rows="3" name="description">{{$video->description}}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">分区</label>
                    <select class="form-control" name="video_type">
                        <option value="1" @if($video->video_type==1) selected="selected" @endif>娱乐</option>
                        <option value="2" @if($video->video_type==2) selected="selected" @endif>音乐</option>
                        <option value="3" @if($video->video_type==3) selected="selected" @endif>电影</option>
                        <option value="4" @if($video->video_type==4) selected="selected" @endif>舞蹈</option>
                        <option value="5" @if($video->video_type==5) selected="selected" @endif>科技</option>
                        <option value="6" @if($video->video_type==6) selected="selected" @endif>游戏</option>
                        <option value="7" @if($video->video_type==7) selected="selected" @endif>美食</option>
                    </select>
                </div>
                <div class="checkbox">
                    <label>
                        @if($video->is_reprint == 1)
                        <input type="checkbox" name="is_reprint" value="on" >是否转载
                            else
                            <input type="checkbox" name="is_reprint" >是否转载
                            @endif
                    </label>
                </div>
                <div class="form-group col-xs-2" style="margin-left: -15px;">
                    <label for="exampleInput">验证码</label>
                    <input type="text" style="width: 100px;" name="captcha" class="form-control" >
                    @error('captcha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <img style="margin-top: 23px;" class="thumbnail captcha mt-3 mb-2" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                <button type="submit" class="btn btn-success">提交</button>
            </form>
        </div>

    </div>
@stop