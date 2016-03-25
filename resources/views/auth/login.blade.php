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

    <form class="form-signin center-block" role="form" method="POST" action="{{ url('/login') }}">
      <h2 class="form-signin-heading text-center">请登录</h2>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <label for="email" class="sr-only">请输入账号</label>
        <input type="text" id="email" class="form-control" placeholder="请输入账号" name="email" required autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input type="password" id="password" class="form-control" placeholder="请输入密码" name="password" required>
      </div>
      <div class="checkbox">
        <label for="remember">
          <input type="checkbox" name="remember" id="remember"> 记住此账号
        </label>
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

@endsection