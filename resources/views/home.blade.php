@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div style="width: 1130px; height: 230px;">
                            <span style="font-size: 16px; margin-left: 15px;">娱乐</span>
                            <hr style="margin-top: 10px;"/>
                            <div style="width: 1130px; height: 150px;">
                                @foreach($fun as $video)
                                <div class="videodiv">
                                    <a href="{{route('video.show',$video->id)}}"><img style="height: 108px; width: 192px; float: left;" class="img-rounded" src="{{$video->video_image}}"></a>
                                    <a href="{{route('video.show',$video->id)}}"><span style="margin-top: 5px; float: left; margin-left: 2px;">{{$video->title}}</span></a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="width: 1130px; height: 230px;">
                            <span style="font-size: 16px; margin-left: 15px;">音乐</span>
                            <hr style="margin-top: 10px;"/>
                            <div style="width: 1130px; height: 150px;">
                                @foreach($music as $video)
                                    <div class="videodiv">
                                        <a href="{{route('video.show',$video->id)}}"><img style="height: 108px; width: 192px; float: left;" class="img-rounded" src="{{$video->video_image}}"></a>
                                            <a href="{{route('video.show',$video->id)}}"><span style="margin-top: 5px; float: left; margin-left: 2px;">{{$video->title}}</span></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="width: 1130px; height: 230px;">
                            <span style="font-size: 16px; margin-left: 15px;">电影</span>
                            <hr style="margin-top: 10px;"/>
                            <div style="width: 1130px; height: 150px;">
                                @foreach($movie as $video)
                                    <div class="videodiv">
                                        <a href="{{route('video.show',$video->id)}}"><img style="height: 108px; width: 192px; float: left;" class="img-rounded" src="{{$video->video_image}}"></a>
                                        <a href="{{route('video.show',$video->id)}}"><span style="margin-top: 5px; float: left; margin-left: 2px;">{{$video->title}}</span></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="width: 1130px; height: 230px;">
                            <span style="font-size: 16px; margin-left: 15px;">跳舞</span>
                            <hr style="margin-top: 10px;"/>
                            <div style="width: 1130px; height: 150px;">
                                @foreach($dance as $video)
                                    <div class="videodiv">
                                        <a href="{{route('video.show',$video->id)}}"><img style="height: 108px; width: 192px; float: left;" class="img-rounded" src="{{$video->video_image}}"></a>
                                        <a href="{{route('video.show',$video->id)}}"><span style="margin-top: 5px; float: left; margin-left: 2px;">{{$video->title}}</span></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="width: 1130px; height: 230px;">
                            <span style="font-size: 16px; margin-left: 15px;">科技</span>
                            <hr style="margin-top: 10px;"/>
                            <div style="width: 1130px; height: 150px;">
                                @foreach($tec as $video)
                                    <div class="videodiv">
                                        <a href="{{route('video.show',$video->id)}}"><img style="height: 108px; width: 192px; float: left;" class="img-rounded" src="{{$video->video_image}}"></a>
                                        <a href="{{route('video.show',$video->id)}}"><span style="margin-top: 5px; float: left; margin-left: 2px;">{{$video->title}}</span></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="width: 1130px; height: 230px;">
                            <span style="font-size: 16px; margin-left: 15px;">游戏</span>
                            <hr style="margin-top: 10px;"/>
                            <div style="width: 1130px; height: 150px;">
                                @foreach($game as $video)
                                    <div class="videodiv">
                                        <a href="{{route('video.show',$video->id)}}"><img style="height: 108px; width: 192px; float: left;" class="img-rounded" src="{{$video->video_image}}"></a>
                                        <a href="{{route('video.show',$video->id)}}"><span style="margin-top: 5px; float: left; margin-left: 2px;">{{$video->title}}</span></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="width: 1130px; height: 230px; margin-bottom: 80px;">
                            <span style="font-size: 16px; margin-left: 15px;">美食</span>
                            <hr style="margin-top: 10px;"/>
                            <div style="width: 1130px; height: 150px;">
                                @foreach($food as $video)
                                    <div class="videodiv">
                                        <a href="{{route('video.show',$video->id)}}"><img style="height: 108px; width: 192px; float: left;" class="img-rounded" src="{{$video->video_image}}"></a>
                                        <a href="{{route('video.show',$video->id)}}"><span style="margin-top: 5px; float: left; margin-left: 2px;">{{$video->title}}</span></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if (app()->isLocal())
                            @include('sudosu::user-selector')
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
