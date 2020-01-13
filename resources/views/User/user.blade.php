@extends('layouts.app')
@section('content')
    <script>
        function follow(id){
            htmlobj=$.ajax({url:"/follow/"+id,async:false});
            alert(htmlobj.responseText);
            if (htmlobj.responseText=='关注成功')
            {
                $("#followbutton").html('已关注');
            }else{
                $("#followbutton").html('关注');
            }
        }
    </script>
    <div style="width: 1000px; margin: auto;">
    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="card" style="width: 200px; border:solid 1px #cccccc; padding: 25px;">
                <img class="card-img-top" width="150px" src="{{$user->avatar}}" alt="{{ $user->name }}">
                <div class="card-body">
                    <h5><strong>个人简介</strong></h5>
                    <p>{{$user->description}}</p>
                    <hr width="150px">
                    <h5><strong>粉丝数</strong></h5>
                    <p>{{$user->fans_count}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card ">
                <div class="card-body">
                    <h1 class="mb-0" style="font-size:22px;">
                        {{ $user->name }}
                        <small>
                            {{ $user->email }}
                            @guest
                            @else
                                <button id="followbutton" onmouseover="followhtml()" type="followbutton" onclick="follow({{$user->id}})" class="btn btn-primary" style="margin-left: 0px; margin-top: 0px;">
                                    @if(count($follow)==0)
                                        关注
                                    @else
                                        已关注
                                    @endif
                                </button>
                                <a href="{{route('user.message',$user->id)}}">
                                <button id="followbutton" type="followbutton" class="btn btn-primary" style="margin-left: 5px; margin-top: 0px;">
                                    私信
                                </button>
                                </a>
                            @endguest
                        </small>
                    </h1>

                </div>
            </div>
            {{-- 用户发布的内容 --}}
            <div class="card " style="">
                <div class="card-body">
                    <ul style="margin-bottom: 10px;" class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link bg-transparent " href="#">
                                视频
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-transparent " href="{{ route('user.usercentercomments', $user->id) }}">
                                评论
                            </a>
                        </li>
                    </ul>

                    @foreach($videos as $video)
                        <div style="width: 100%; height: 80px; border-bottom:1px solid #dddddd ; margin-top: 10px">
                            <img src="{{$video->video_image}}" style="width: 125px;">
                            <a style="position: absolute; margin-top: -8px;" href="{{route('video.show',$video->id)}}"><h4 style="margin-left: 17px;">{{$video->title}}</h4></a>
                        </div>
                    @endforeach

                    {!! $videos->appends(Request::except('page'))->render() !!}
                </div>
            </div>

        </div>
    </div>
    </div>
@stop