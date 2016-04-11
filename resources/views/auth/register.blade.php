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

    <form class="form-signin center-block" role="form" method="POST" action="{{ url('/register') }}">
      <h2 class="form-signin-heading text-center">请填写信息</h2>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <label for="name" class="sr-only">请输入真实姓名</label>
        <input type="text" id="email" class="form-control" placeholder="请输入姓名" value="{{ old('name') }}" name="name" required autofocus>
      </div>

      <div class="form-group">
        <label for="email" class="sr-only">请输入邮箱</label>
        <input type="text" id="email" class="form-control" placeholder="请输入邮箱" value="{{ old('email') }}" name="email" required autofocus>
      </div>

      <div class="form-group">
        <label for="password" class="sr-only">请输入密码</label>
        <input type="password" id="password" class="form-control" placeholder="请输入密码" name="password" required>
      </div>

      <div class="form-group">
        <label for="password_confirmation" class="sr-only">请再次输入密码</label>
        <input type="password" id="password_confirmation" class="form-control" placeholder="请确认密码" name="password_confirmation" required>
      </div>

      <button class="button button-block button-rounded button-primary button-glow" type="submit">确认注册</button>

    </form>
  </div>
  </div>
  </div>

@endsection

@section('js')
@endsection