<nav class="navbar navbar-default navbar-fixed-top" style="position: relative;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Video') }}
        </a>
        <a class="navbar-link" href="{{route('videolist','fun')}}" style="float: left;margin-left: 30px; margin-top: 15px;">娱乐</a>
        <a class="navbar-link" href="{{route('videolist','music')}}" style="float: left;margin-left: 10px; margin-top: 15px;">音乐</a>
        <a class="navbar-link" href="{{route('videolist','movie')}}" style="float: left;margin-left: 10px; margin-top: 15px;">电影</a>
        <a class="navbar-link" href="{{route('videolist','dance')}}" style="float: left;margin-left: 10px; margin-top: 15px;">舞蹈</a>
        <a class="navbar-link" href="{{route('videolist','tec')}}" style="float: left;margin-left: 10px; margin-top: 15px;">科技</a>
        <a class="navbar-link" href="{{route('videolist','game')}}" style="float: left;margin-left: 10px; margin-top: 15px;">游戏</a>
        <a class="navbar-link" href="{{route('videolist','food')}}" style="float: left;margin-left: 10px; margin-top: 15px;">美食</a>
        <ul class="list-inline" style="float: right;margin-top: 15px;">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    @if(Auth::user()->notification_count>0)
                    <a class="nav-link mr-3 badge badge-pill badge-secondary text-red" href="{{ route('notifications.index') }}">
                        {{ Auth::user()->notification_count }}
                    </a>
                    @endif
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="{{ route('user.show') }}">用户中心</a></li>
                                <li><a href="{{ route('follow.show') }}">我的关注</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
