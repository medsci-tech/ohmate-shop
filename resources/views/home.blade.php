@extends('app')

@section('css')
    <link href="{{ asset('/css/components/slideshow.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/slidenav.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/dotnav.almost-flat.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="uk-alert uk-alert-success">
        <strong>您已登陆, 请在右上方导航条选择需要进行的操作.</strong>
    </div>
@endsection

@section('js')
    <script src="{{asset('/js/vendor/vue.js')}}"></script>
    <script src="{{asset('/js/vendor/city.js')}}"></script>
    <script src="{{asset('/js/admin.js')}}"></script>
@endsection