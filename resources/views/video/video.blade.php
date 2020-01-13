@extends('layouts.app')

@section('title','视频列表')

@section('content')
    @include('layouts._message')
    <script>

        $("#commentlistm").ready(function(){
                $.ajax({
                    url: '/user/comments/'+$("#video_id").val(),
                    type:"get",
                    success:function(result) {
                        $("#commentlist").html(result);
                    }
                });
            });

            function sendcomment() {
                $.ajax({
                    url: '/user/comments/create/',
                    data: {
                        content: $("#content").val(),
                        video_id: $("#video_id").val(),
                        '_token':"{{ csrf_token() }}"
                    },
                    type:"post",
                    success:function(result) {
                        $("#commentlist").html(result);
                    }
                });
                $("#content").val('');
                alert('评论成功');
            }

    </script>
    <link href="../css/scojs.css" rel="stylesheet">
    <link href="../css/colpick.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">

    <div style="margin: auto; width: 1030px; height: 980px;">


        <div id="danmup" style="margin: auto;">
        </div>
        <div style="display: none">
            <span class="glyphicon" aria-hidden="true">&#xe072</span>
            <span class="glyphicon" aria-hidden="true">&#xe073</span>
            <span class="glyphicon" aria-hidden="true">&#xe242</span>
            <span class="glyphicon" aria-hidden="true">&#xe115</span>
            <span class="glyphicon" aria-hidden="true">&#xe111</span>
            <span class="glyphicon" aria-hidden="true">&#xe096</span>
            <span class="glyphicon" aria-hidden="true">&#xe097</span>
        </div>


        </body>
        <script src="../js/jquery-2.1.4.min.js"></script>
        <script src="../js/jquery.shCircleLoader.js"></script>
        <script src="../js/sco.tooltip.js"></script>
        <script src="../js/colpick.js"></script>
        <script src="../js/jquery.danmu.js"></script>
        <script src="../js/main.js"></script>

        <script>
            $("#danmup").DanmuPlayer({
                src:"{{$video->video_path}}",
                height: "560px", //区域的高度
                width: "1020px" //区域的宽度
                ,urlToGetDanmu:"/getdanmu/{{$video->id}}"
                ,urlToPostDanmu:"/senddanmu"
            });


            $.getJSON("http://video.test/getdanmu/{{$video->id}}", function(json){
                console.log(json)
                $("#danmup .danmu-div").danmu("addDanmu",json)
            });

        </script>

        <div style=" width: 100%;height: 150px;">
            <h4 style="margin-left: 5px;">{{$video->title}}</h4>
            <span style="margin-left: 6px; color:#888888;">{{$video->views_count}}次观看</span>
            <span style="margin-left: 6px;color:#888888;">{{$video->created_at}}</span>
            <a href="{{route('user.showusercennter',$video->User->id)}}"><img class="img-circle" src="{{$video->User->avatar}}" width="53px;" style="position: absolute; margin-left: -195px; margin-top: 30px;"></a>
            <a href="{{route('user.showusercennter',$video->User->id)}}" style="position: absolute; margin-left: -128px; margin-top: 32px;">{{$video->User->name}}</a>
            <p style="position: absolute; margin-left: 75px; margin-top: 36px;color: #666666;">1名订阅者</p>
            <div style="position: absolute;word-wrap: break-word; word-break: normal; margin-top: 70px; margin-left: 70px; width: 1100px;">简介：{{$video->description}}</div>
        </div>
        <div style=" width: 100%;height: 500px;">
            @guest
                <form>
                    <label for="example">添加评论</label>
                    <textarea class="form-control" name="content" rows="3" placeholder="请先登录"></textarea>
                    <button style="margin-top: 10px;" type="submit" class="btn btn-primary" disabled="disabled">发送评论</button>
                </form>
            @else
                <form>
                    @csrf
                    <label for="example">添加评论</label>
                    <input type="hidden" name="video_id" id="video_id" value="{{$video->id}}">
                    <textarea class="form-control" id="content" placeholder="输入您的评论" name="content" rows="3"></textarea>
                    <button style="margin-top: 10px;" type="button" id="comment" onclick="sendcomment()" class="btn btn-primary">发送</button>
                </form>
            @endguest
            <ul class="media-list" id="commentlist" onload="showcomment()" style="margin-top: 15px; margin-bottom: 100px;">
            </ul>
        </div>
    </div>

@stop

