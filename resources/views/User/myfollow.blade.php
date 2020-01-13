@extends('layouts.app')

@section('title','投稿视频')

@section('content')
    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">

                <div class="card-body">

                    <h3 class="text-xs-center">
                        我的关注
                    </h3>
                    <hr>
                    <ul style="">
                    @foreach ($data as $v)
                        @if(isset($v->title))
                        <li class="media border-bottom">
                            <div class="media-left">
                                <a href="{{route('user.showusercennter',$v->user_id)}}">
                                    <img class="media-object img-thumbnail mr-3" src="{{$v->User->avatar}}" style="width:48px;height:48px;" />
                                </a>
                            </div>

                            <div class="media-body">
                                <div class="media-heading mt-0 mb-1 text-secondary">
                                    <a href="">{{ $v->User->name }}</a>
                                    投稿了
                                    <span class="meta float-right" title="{{ $v->created_at }}">
                                        <a href="{{route('video.show',$v->id)}}">
                                        {!! $v->title !!}
                                        </a>
        <i class="far fa-clock">{{ $v->created_at->diffForHumans() }}</i>
      </span>
                                </div>
                                <div class="reply-content">
                                </div>
                            </div>
                        </li>
                        @else
                            <li class="media border-bottom">
                                <div class="media-left">
                                    <a href="{{route('user.showusercennter',$v->user_id)}}">
                                        <img class="media-object img-thumbnail mr-3" src="{{$v->User->avatar}}" style="width:48px;height:48px;" />
                                    </a>
                                </div>

                                <div class="media-body">
                                    <div class="media-heading mt-0 mb-1 text-secondary">
                                        <a href="">{{ $v->User->name }}</a>
                                        评论了
                                        <span class="meta float-right" title="{{ $v->created_at }}">
                                            <a href="{{route('video.show',$v->Video->id)}}">
                                            {{$v->Video->title}}
                                            </a>
        <i class="far fa-clock">{{ $v->created_at->diffForHumans() }}</i>
      </span>
                                    </div>
                                    <div class="reply-content">
                                        {!! $v->content !!}
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                    </ul>
                        <div style="margin-bottom: 100px;" class="list-unstyled notification-list">

                            {{ $data->links() }}

                        </div>

                </div>
            </div>
        </div>
    </div>
@stop