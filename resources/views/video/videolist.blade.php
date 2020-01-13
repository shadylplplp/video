@extends('layouts.app')

@section('title','视频列表')

@section('content')
    @include('layouts._message')
    <div style="margin: auto; width: 1030px; height: 980px;">
        <div style="width: 680px; height: 900px; float: left;">
                @foreach($videos as $video)
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img style="float: left; position: relative;" src="{{$video->video_image}}" width="108px" height="62px">
                            <a href="{{route('video.show',$video->id)}}" class="videotitle">{{$video->title}}</a>
                            <span class="videoplaycount">播放：{{$video->views_count}}</span>
                            <span class="videocommentcount">评论：{{$video->comments_count}}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-5" style="margin-left: 50px; margin-top: -20px; float: left; width: 100%; position: relative;">
                {!! $videos->appends(Request::except('page'))->render() !!}
            </div>
        </div>
        <div style="width: 320px; height: 900px; margin-left: 20px; float: left;">
            <div class="panel panel-default">
                <div class="panel-heading">周榜排名</div>
                <ul class="list-group">
                    @foreach($videolist as $video)
                    <li class="list-group-item" style="width: 318px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><a href="{{route('video.show',$video->id)}}">{{$video->title}}</a></li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@stop