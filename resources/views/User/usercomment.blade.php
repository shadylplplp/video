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
                    <p>aaaa</p>
                    <hr width="150px">
                    <h5><strong>粉丝数</strong></h5>
                    <p>123213123</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card ">
                <div class="card-body">
                    <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
                    @guest

                    @else
                        <button id="followbutton" onmouseover="followhtml()" type="followbutton" onclick="follow({{$user->id}})" class="btn btn-primary" style="position: absolute; margin-left: 345px; margin-top: -35px;">
                        @if(count($follow)==0)
                            关注
                        @else
                            已关注
                            @endif
                        </button>
                    @endguest
                </div>
            </div>
            {{-- 用户发布的内容 --}}
            <div class="card ">
                <div class="card-body">
                    <ul style="margin-bottom: 10px;" class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link bg-transparent " href="{{ route('user.showusercennter', $user->id) }}">
                                视频
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-transparent " href="#">
                                评论
                            </a>
                        </li>
                    </ul>

                    @foreach($comments as $comment)
                        <div style="width: 100%; height: 80px; border-bottom:1px solid #dddddd ;">
                            <a style="position: absolute; margin-top: -8px; " href=""><h4 style="margin-left: 0px;">{{$comment->Video->title}}</h4></a>
                            <p style="position: absolute; margin-top: 25px;">评论了:{{$comment->content}}</p>
                        </div>
                    @endforeach

                    {!! $comments->appends(Request::except('page'))->render() !!}
                    <br>
                    <br>
                </div>
            </div>

        </div>
    </div>
    </div>
@stop