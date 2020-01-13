@extends('layouts.app')

@section('title','投稿视频')

@section('content')
    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">

                <div class="card-body">

                    <h3 class="text-xs-center">
                        <i class="far fa-bell" aria-hidden="true"></i> 我的通知
                    </h3>
                    <hr>
                    @if ($notifications->count())

                        <div class="list-unstyled notification-list">
                            @foreach ($notifications as $notification)
                                <li class="media @if ( ! $loop->last) border-bottom @endif">
                                    <div class="media-left">
                                        <a href="">
                                            <?php $avatar=ltrim($notification->data['avatar'],"\\"); ?>
                                            <img class="media-object img-thumbnail mr-3" src="{{$avatar}}" style="width:48px;height:48px;" />
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <div class="media-heading mt-0 mb-1 text-secondary">
                                            <a href="">{{ $notification->data['sender_name'] }}</a>
                                            私信了你
                                            {{-- 回复删除按钮 --}}
                                            <span class="meta float-right" title="{{ $notification->created_at }}">
        <i class="far fa-clock"></i>
        {{ $notification->created_at->diffForHumans() }}
      </span>
                                        </div>
                                        <div class="reply-content">
                                            {!! $notification->data['content'] !!}
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            {!! $notifications->render() !!}
                        </div>

                    @else
                        <div class="empty-block">没有消息通知！</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop