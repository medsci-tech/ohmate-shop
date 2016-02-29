<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="/css/education.css">
    <link rel="stylesheet" href="http://static.runoob.com/assets/foundation-5.5.3/foundation.min.css">
</head>
<body style="background-color: #D8D6D6">
<div class="first_row"></div>
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

<input type="hidden" id="text_click" value="-1">
<input type="hidden" id="text_id" value="-1">
<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    function updateView(id, uri) {
        document.getElementById('text_click').value ='1';
        document.getElementById('text_id').value = id;
        $(function () {
            var requestUrl = '/education/article/update-count';
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

            var requestUrls = '/education/article/update-bean';
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
            window.location.href = '/education/article/category?type=knowledge';
        }
    }
</script>

</body>
</html>