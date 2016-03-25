{{--@extends('app')--}}

{{--@section('css')--}}
{{--<link href="{{ asset('/css/components/form-advanced.almost-flat.min.css') }}" rel="stylesheet">--}}
{{--<link href="{{ asset('/css/components/form-password.almost-flat.min.css') }}" rel="stylesheet">--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--<div class="uk-grid uk-grid-collapse">--}}
{{--<div class="uk-width-small-1-3 uk-container-center">--}}
{{--<div class="uk-panel">--}}
{{--@if (count($errors) > 0)--}}
{{--<div class="uk-alert uk-alert-danger">--}}
{{--<strong>Whoops!</strong> 看起来你输错了什么。<br><br>--}}
{{--<ul>--}}
{{--@foreach ($errors->all() as $error)--}}
{{--<li>{{ $error }}</li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--</div>--}}
{{--@endif--}}

{{--<form class="uk-form uk-container-center" role="form" method="POST" action="{{ url('/login') }}">--}}
{{--<fieldset data-uk-margin>--}}
{{--<legend>请登录</legend>--}}
{{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--<div class="uk-form-row uk-form-icon">--}}
{{--<i class="uk-icon-user"></i>--}}
{{--<input type="text" class="form-control" name="email" placeholder="请输入登录邮箱" value="{{ old('email') }}">--}}
{{--</div>--}}
{{--<br>--}}
{{--<div class="uk-form-password uk-form-row uk-form-icon">--}}
{{--<i class="uk-icon-lock"></i>--}}
{{--<input type="password" name="password" placeholder="请输入密码">--}}
{{--<a href="" class="uk-form-password-toggle" data-uk-form-password="{lblShow:'显示', lblHide:'隐藏'}" tabindex="-1">显示</a>--}}
{{--</div>--}}
{{--<div class="uk-form-row">--}}
{{--<input type="checkbox" name="remember" value=""> 记住此账号--}}
{{--</div>--}}
{{--<div class="uk-form-row">--}}
{{--<button type="submit" class="uk-button uk-button-primary">提交</button>--}}
{{--<a class="uk-button uk-button-link" href="{{ url('/password/email') }}">忘记密码</a>--}}
{{--</div>--}}
{{--</fieldset>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--@endsection--}}

{{--@section('js')--}}
{{--<script src="{{ asset('/js/components/form-password.min.js') }}"></script>--}}
{{--@endsection--}}

@extends('app')

@section('css')
@endsection

@section('content')
  <div class="container" id="signin">
    <br><br><br>

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> 看起来你输错了什么。<br><br>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form class="form-signin center-block" @submit.prevent="submitSign | debounce 1000">
      <h2 class="form-signin-heading text-center">请登录</h2>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <label for="inputID" class="sr-only">请输入账号</label>
        <input type="text" id="inputID" class="form-control" placeholder="请输入账号" v-model="email" required autofocus>
      </div>
      <div class="form-group">
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="请输入密码" v-model="password" required>
      </div>
      <div class="form-group">
        <input type="checkbox" name="remember" v-model="remember"> 记住此账号
      </div>
      <p>&emsp;</p>
      <button class="button button-block button-rounded button-primary button-glow" type="submit">登录</button>
      <br>
      <a href="{{ url('/register') }}" class="button button-block button-rounded button-primary button-border button-glow"
         type="button">注册</a>
    </form>

  </div>

@endsection

@section('js')
  <script>
    new Vue({
      el: '#signin',
      data: {
        email: '{{ old('email') }}',
        password: '',
        remember: 0
      },
      methods: {
        submitSign: function () {
          $.post(url('/login'), {
            email: this.email,
            password: this.password,
            remember: this.remember
          })
        }
      }
    });
  </script>
@endsection