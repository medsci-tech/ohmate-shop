<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>易康伴侣-后台</title>

    <link href="{{ asset('/css/uikit.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/accordion.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
@include('nav')

@if (count($errors) > 0)
    <div class="uk-alert uk-alert-danger">
        <strong>Whoops!</strong> 看起来你输错了什么。<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (\Session::get('success'))
    <div class="uk-alert uk-alert-success">
        <strong>操作成功!</strong>
    </div>
@endif

@yield('content')

<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('/js/uikit.min.js') }}"></script>
<script src="{{ asset('/js/components/accordion.min.js') }}"></script>
@yield('js')
</body>
</html>

<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>易康伴侣-后台</title>

    <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
    @yield('css')
</head>
<body id="index">
@include('nav')

@yield('content')
<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>

@yield('js')
</body>
</html>
