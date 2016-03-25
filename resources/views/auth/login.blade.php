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