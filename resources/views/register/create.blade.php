<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>用户注册</title>
  <link rel="stylesheet" href="{{asset('/css/register.css')}}">
</head>
<body>
<div class="container">
  <form class="register" action="{{url('/register/store')}}" method="POST">
    <div class="form-group">
      <label><span id="label_phone"></span>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="请输入手机号" required>
      </label>
    </div>
    <div class="form-group">
      <label><span id="label_code"></span>
        <input type="text" name="code" id="code" class="form-control" placeholder="请输入验证码" required>
      </label>
      <button type="button" class="btn btn-info" onclick='turnTo();'>获取验证码</button>
    </div>
    <button type="submit" class="btn btn-block">确&emsp;认</button>
    <div class="checkbox">
      <label>
        <input type="checkbox" checked required>
        已阅读并同意
      </label>
      <span>《<a>易康伴侣服务协议</a>》</span>
    </div>
    {{csrf_field()}}
  </form>
</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
  function validateMobile() {
    var mobile = document.getElementById('phone').value;
    var code = document.getElementById('code').value;
    if (mobile.length == 0) {
      document.getElementById('label_phone').innerText = '请输入手机号码！';
      document.getElementById('phone').focus();
      return false;
    }
    if (mobile.length != 11) {
      document.getElementById('label_phone').innerText = '请输入有效的手机号码！';
      document.getElementById('phone').focus();
      return false;
    }

    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
    if (!myreg.test(mobile)) {
      document.getElementById('label_phone').innerText = '请输入有效的手机号码！';
      document.getElementById('phone').focus();
      return false;
    }

    return true;

  }

  function validateAll() {
    if (!validateMobile()) {
      return false;
    }

    if (code.length == 0) {
      document.getElementById('label_code').innerText = '请输入验证码！';
      document.getElementById('code').focus();
      return false;
    }

    if (code.length != 6) {
      document.getElementById('label_code').innerText = '请输入有效的验证码！';
      document.getElementById('code').focus();
      return false;
    }

    if (isNaN(code)) {
      document.getElementById('label_code').innerText = '请输入有效的验证码！';
      document.getElementById('code').focus();
      return false;
    }

    return true;
  }

  function turnTo() {
    if (validateMobile()) {
      $('.form-group button').attr("disabled", "disabled");
      var mobile = document.getElementById('phone').value;
      $.get(
        '/register/sms?phone=' + mobile,
        function (data) {
          if (data.success) {
          } else {
            alert('服务器异常!');
          }
        },
        "json"
      );
      var i = 11;
      function timer() {
        i--;
        $('.form-group button').text(i + '秒后重新发送');
        if (i == 0) {
          clearInterval(timer);
          $('.form-group button').removeAttr("disabled");
          $('.form-group button').text('重新发送');
        }
        setTimeout(timer, 1000);
      }
    };
  }
</script>
</body>
</html>
