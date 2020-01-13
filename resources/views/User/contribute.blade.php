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
            <form style="margin: 25px;" method="post" action="{{route('user.contribute')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">视频标题</label>
                    <input class="form-control" name="title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">视频简介</label>
                    <textarea class="form-control" rows="3" name="description"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">分区</label>
                    <select class="form-control" name="video_type">
                        <option value="1">娱乐</option>
                        <option value="2">音乐</option>
                        <option value="3">电影</option>
                        <option value="4">舞蹈</option>
                        <option value="5">科技</option>
                        <option value="6">游戏</option>
                        <option value="7">美食</option>
                    </select>
                    @error('video_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">上传视频</label>
                    <input type="file" id="exampleInputFile" name="video_path">
                    <p class="help-block">支持mp4,wmv,avi格式 大小小于1024MB</p>
                    @error('video_path')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_reprint">是否转载
                    </label>
                </div>
                <div class="form-group" >
                    <label for="exampleInput">验证码</label>
                    <input type="text" style="width: 100px;" name="captcha" class="form-control" >
                    <img style="margin-top: -45px; margin-left: 110px;" class="thumbnail captcha mt-3 mb-2" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    @error('captcha')
                    <span class="invalid-feedback" style="top: -20px;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>

                <button type="submit" class="btn btn-success">提交</button>
            </form>
        </div>

    </div>
@stop