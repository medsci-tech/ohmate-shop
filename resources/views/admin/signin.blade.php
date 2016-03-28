<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="height=device-width,width=device-width,initial-scale=1.0,user-scalable=no">
  <title>易康伴侣管理后台登录</title>
  <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
</head>
<body>
<div class="container" id="signin">
  <br><br><br>
  <form class="form-signin center-block" @submit.prevent="submitSign | debounce 1000">
    <h2 class="form-signin-heading text-center">欢&emsp;迎</h2>
    <div class="form-group">
      <label for="inputID" class="sr-only">请输入账号</label>
      <input type="text" id="inputID" class="form-control" placeholder="请输入账号" v-model="userID" required autofocus>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="sr-only">密码</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="请输入密码" v-model="password" required>
    </div>
    <p>&emsp;</p>
    <button class="button button-block button-rounded button-primary button-glow" type="submit">确&emsp;认</button>
  </form>

</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script>
  new Vue({
    el: '#signin',
    data: {
      userID:'',
      password:''
    },
    methods: {
      submitSign: function(){
        $.post(url(),{})
      }
    }
  });
</script>
</body>
</html>