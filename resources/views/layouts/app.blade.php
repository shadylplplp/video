<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Scripts -->
<!--    <script src="{{ asset('js/app.js') }}" defer></script>-->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="https://how2j.cn/study/js/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://how2j.cn/study/js/bootstrap/3.3.6/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moe2-player@latest/dist/moe2player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/socket.io-client@latest/dist/socket.io.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <link href="https://how2j.cn/study/css/bootstrap/3.3.6/bootstrap.css" rel="stylesheet">
    <style>
        a:hover{text-decoration:none;color: #555555;}
        a:visited{text-decoration:none;color: #555555;}
        a{
            color: #555555;
        }
    </style>
</head>
<body>
@include('layouts._header')
@yield('content')
</body>
@include('layouts._footer')
</html>
