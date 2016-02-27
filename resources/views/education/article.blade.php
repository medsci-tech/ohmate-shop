<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>教育学习</title>
    <link rel="stylesheet" href="/css/eduction.css">
    <link rel="stylesheet" href="http://static.runoob.com/assets/foundation-5.5.3/foundation.min.css">

</head>
<body onload="reLoad();">
{{--<div class="container">--}}
    {{--@foreach($articles as $index)--}}
    {{--<div class="row">--}}
        {{--<div class="media">--}}
            {{--<div class="media-left media-middle">--}}
                {{--<a href="#">--}}
                    {{--<img class="media-object" src="{{$index['thumbnail']}}" alt="...">--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="media-body">--}}
                {{--<h4 class="media-heading">{{$index['title']}}</h4>--}}
                {{--<a href="{{$index['uri']}}" onclick="updateView({{$index['id']}})"><p>{{$index['description']}}</p></a>--}}
                {{--<span>阅读量&emsp;{{$index['count']}}</span>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
{{--</div>--}}

<body style="background-color: #D8D6D6">
<div class="container">
    <div class="row icon">
        <div class="medium-3 columns">
            <img src="/image/icon1.png" class="icon_img">

            <p class="icon_p">血糖检测</p>
        </div>
        <div class="medium-3 columns">
            <img src="/image/icon2.png" class="icon_img">

            <p class="icon_p">药物治疗</p>
        </div>
        <div class="medium-3 columns">
            <img src="/image/icon3.png" class="icon_img">

            <p class="icon_p">膳食营养</p>
        </div>
        <div class="medium-3 columns">
            <img src="/image/icon4.png" class="icon_img">

            <p class="icon_p">合理运动</p>
        </div>
    </div>

    <div class="list_top">
        @foreach($articles as $index)
        <div class="list">
            <div class="row" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">
                <div class="small-5 columns">
                    <img src="{{$index['thumbnail']}}">
                </div>
                <div class="small-7 columns">
                    <p class="list_p">{{$index['title']}}</p>

                    <p class="list_p_1">阅读量&emsp;{{$index['count']}}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
<input type="hidden" id="text_click" value="-1">
<input type="hidden" id="text_id" value="-1">
<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    function updateView(id, uri) {
        document.getElementById('text_click').value ='1';
        document.getElementById('text_id').value = id;
        $(function () {
            var requestUrl = '/eduction/article/view';
            $.ajax({
                url : requestUrl,
                data: {
                    id: id
                },
                type : "get",
                dataType : "json",
                success: function (json) {

                },
                error: function (xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                }
            });

            var requestUrls = '/eduction/article/addBean';
            $.ajax({
                url: requestUrls,
                data: {
                    id: id
                },
                type: "get",
                dataType: "json",
                success: function (json) {

                },
                error: function (xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                }
            });


        });

        window.location.href = uri;
    }

    function reLoad() {
        var flag = document.getElementById('text_click').value;
        var id = document.getElementById('text_id').value;
        if(flag=='1') {
//            $(function () {
//                var requestUrls = '/eduction/article/read';
//                $.ajax({
//                    url: requestUrls,
//                    data: {
//                        id: id
//                    },
//                    type: "get",
//                    dataType: "json",
//                    success: function (json) {
//
//                    },
//                    error: function (xhr, status, errorThrown) {
//                        alert("Sorry, there was a problem!");
//                    }
//                });
//
//            });
            window.location.href = '/eduction/article';
        }
    }
</script>
</body>
</html>