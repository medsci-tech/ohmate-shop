<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>易康伴侣-后台</title>
  <link rel="shortcut icon" href="/favicon.ico">

    <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
    @yield('css')
</head>
<body id="index">
@include('nav')

@yield('content')
<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script>
  $('.nav li a').click(function(){
      $(this).addClass('active');
  });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
@yield('js')
</body>
</html>
