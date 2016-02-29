<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>教育学习</title>
    <link rel="stylesheet" href="/css/eduction.css">
    <link rel="stylesheet" href="http://static.runoob.com/assets/foundation-5.5.3/foundation.min.css">

</head>

<body onload="reLoad();" style="background-color: #D8D6D6">
<!--按钮-->
<div class="container">
    <div class="row icon">
        <div class="small-3 columns">
            <img src="/image/education/icon1.png">
            <p class="icon_p1">血糖检测</p>
        </div>
        <div class="small-3 columns">
            <img src="/image/education/icon2.png">
            <p class="icon_p1">药物治疗</p>
        </div>
        <div class="small-3 columns">
            <img src="/image/education/icon3.png">
            <p class="icon_p1">膳食营养</p>
        </div>
        <div class="small-3 columns">
            <img src="/image/education/icon4.png">
            <p class="icon_p1">合理运动</p>
        </div>
    </div>
</div>
<!--文章列表-->
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