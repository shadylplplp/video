@extends('layouts.app')

@section('title','投稿视频')

@section('content')
    <div style="margin: auto; width: 70%; height: 500px;">
        <ul class="nav nav-pills nav-stacked" style="width:150px; float: left;position: relative;">
            <li role="presentation"><a href="{{route('user.show')}}">个人信息</a></li>
            <li role="presentation"><a href="{{route('user.myfocus')}}">我的关注</a></li>
            <li role="presentation"><a href="{{route('user.myfans')}}">我的粉丝</a></li>
            <li role="presentation"><a href="{{route('user.contribute')}}">视频投稿</a></li>
            <li role="presentation"><a href="{{route('user.showvideolist')}}">投稿编辑</a></li>
            <li role="presentation"><a href="{{route('user.edit')}}">用户信息更改</a></li>
            <li role="presentation" class="active"><a href="{{route('user.passwordedit')}}">修改密码</a></li>
            <li role="presentation"><a href="{{route('user.messagelist')}}">私信</a></li>
        </ul>
        <div style="position: relative; margin-left: 15px; height: 600px; width: 80%; background: #0d8ddb;float: left; background-color: transparent;box-shadow:0px 0px 8px 3px #ccc;">
            @include('layouts._message')
            <form style="margin: 25px;" method="post" action="{{route('user.passwordeditaaa')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInput">当前密码</label>
                    <input type="password" name="oldpassword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInput">更改密码</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput">重复密码</label>
                    <input type="password" name="repeatnewpassword" class="form-control">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInput">验证码</label>
                    <input type="text" name="captcha" class="form-control">
                    @error('captcha')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <img class="thumbnail captcha mt-3 mb-2" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                <button type="submit" class="btn btn-success">提交</button>
            </form>
        </div>

    </div>
@stop