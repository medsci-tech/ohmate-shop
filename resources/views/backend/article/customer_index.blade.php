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


@foreach($items as $item)
    <div class="uk-panel">
        <div class="uk-panel-badge uk-badge">{{$item->type->type_ch}}</div>
        <h3 class="uk-panel-title">{{$item->title}}</h3>
    </div>
@endforeach

<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('/js/uikit.min.js') }}"></script>
<script src="{{ asset('/js/components/accordion.min.js') }}"></script>
</body>
</html>
