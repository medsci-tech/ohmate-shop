<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>糖尿病学习</title>

    <link href="{{ asset('/css/uikit.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/accordion.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<ul class="uk-subnav uk-subnav-pill">
    <li class="uk-active"><a href="/article/category/0">全部分类</a></li>
    <li><a href="/article/category/1">糖友科普</a></li>
    <li><a href="/article/category/2">药物治疗</a></li>
    <li><a href="/article/category/3">膳食营养</a></li>
    <li><a href="/article/category/4">合理运动</a></li>
    <li><a href="/article/category/5">血糖监测</a></li>
</ul>



<div class="uk-grid">
    <div class="uk-width-medium-1-2 uk-grid-margin">
    @foreach($items as $item)
        <div class="uk-panel uk-panel-box uk-panel-space">
            <div class="uk-panel-badge uk-badge">{{$item->type->type_ch}}</div>
            <div class="uk-panel-teaser">
                <img style="height: 60px; width: 100%;" src="{{$item->thumbnail}}" alt="">
            </div>
            <h3 class="uk-panel-title">{{$item->title}}</h3>
            {{$item->description}}
        </div>
    @endforeach
    </div>
</div>

<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('/js/uikit.min.js') }}"></script>
<script src="{{ asset('/js/components/accordion.min.js') }}"></script>
</body>
</html>
