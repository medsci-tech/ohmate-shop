<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>教育学习</title>
    <link rel="stylesheet" href="/css/eduction.css">
</head>
<body onload="reLoad();">
<div class="container">
    @foreach($articles as $index)
    <div class="row">
        <div class="media">
            <div class="media-left media-middle">
                <a href="#">
                    <img class="media-object" src="{{$index['thumbnail']}}" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$index['title']}}</h4>
                <a onclick="updateView({{$index['id']}})"><p>{{$index['description']}}</p></a>
                <span>阅读量&emsp;{{$index['count']}}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>
<input type="hidden" id="text_click" value="-1">
<input type="hidden" id="text_id" value="-1">
<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    function updateView(id) {
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

            var requestUrls = '/eduction/article/book';
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

//        window.location.href = uri;
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