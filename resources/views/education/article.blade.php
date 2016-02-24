<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>教育学习</title>
    <link rel="stylesheet" href="/css/eduction.css">
</head>
<body>
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
                <a href="{{$index['uri']}}"><p>对糖尿病有个初步的了解</p></a>
                <span>阅读量&emsp;{{$index['count']}}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>
</body>
</html>