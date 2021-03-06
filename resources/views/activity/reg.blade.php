<!DOCTYPE html>
<html lang="en" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>我的地址</title>
  <link rel="stylesheet" href="{{asset('/css/shop_rebuild.css')}}">
  <style>
    label.control-label{
       height: 34px;
      line-height: 34px;
    }
  </style>
<body>
<div class="container" id="addresses">
  <div class="row">
    <div class="panel panel-default" id="edit_panel">
      <div class="panel-heading heading-toggle" id="heading_add">添加收货地址</div>
      <div class="hide panel-heading heading-toggle">修改收货地址</div>
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-xs-3 control-label" for="name">收货人</label>

          <div class="col-xs-9">
            <input required type="text" class="form-control" id="name" placeholder="收货人姓名" v-model="newAdd.name">
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="phone">手机号</label>
          <div class="col-xs-9">
            <input required type="text" class="form-control" id="phone" placeholder="收货人号码" v-model="newAdd.phone">
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="code" id="label_code">验证码</label>
          <div class="col-xs-9">
            <input required type="text" class="form-control col-xs-5" style="width: 60%" id="code" placeholder="请输入验证码" v-model="newAdd.code">
            <button type="button" class="btn btn-info" style="width: 36%; margin: 0 0 0 4%;" onclick='turnTo();' id="sendCode">获取验证码</button>
          </div>
        </div>

        <div class="form-group">
          <label class="col-xs-3 control-label" for="province">详细地址</label>
          <div class="col-xs-9">
            <select required class="form-control" name="province" id="province" v-model="newAdd.province"></select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="city"></label>
          <div class="col-xs-9">
            <select required class="form-control" name="city" id="city" v-model="newAdd.city"></select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="area"></label>

          <div class="col-xs-9">
            <select required class="form-control" name="area" id="area" v-model="newAdd.district"></select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="address"></label>
          <div class="col-xs-9">
            <input required type="text" class="form-control" id="address" placeholder="街道地址" v-model="newAdd.address">
          </div>
        </div>

        <div class="form-group">
          <label class="col-xs-3 control-label" for="address">选择类型</label>
          <div class="col-xs-9" style="padding-top: 4px">
            <label style="font-weight: normal"><input type="radio" value="1" name="gift_type" v-model="newAdd.gift_type">糖尿病1型</label>&emsp;
            <label style="font-weight: normal"><input type="radio" value="2" name="gift_type" v-model="newAdd.gift_type">糖尿病2型</label>
          </div>
        </div>

        <div class="form-group text-center" id="button">
          <button class="button button-caution button-rounded" id="button_add"
          type="button" @click="addFun | debounce 1000">确&emsp;定</button>
        </div>
        <input type="hidden" v-model="newAdd.activity_id" value="{{ $id }}">
      </form>
    </div>
    <br>
  </div>
</div>
</body>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/myaddress.js')}}"></script>
<script src="{{asset('/js/vendor/city.js')}}"></script>
<script>
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
  });
  $(function () {
    city_selector();
  });
</script>
<script type="text/javascript">
  function validateMobile() {
    var mobile = document.getElementById('phone').value;
    var code = document.getElementById('code').value;
    if (mobile.length == 0) {
      alert("请输入手机号码！'");
      return false;
    }
    if (mobile.length != 11) {
      alert("请输入有效的手机号码！");
      return false;
    }

    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
    if (!myreg.test(mobile)) {
      alert("请输入有效的手机号码！");
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
      $('#sendCode').attr("disabled", "disabled");
      $('#phone').attr("readonly", "readonly");
      var mobile = document.getElementById('phone').value;
      $.get(
              '/register/commonSms?phone=' + mobile,
              function (data) {
                if (data.success) {
                } else {
                  alert(data.error_message.phone);
                }
              },
              "json"
      );

      var i = 61;
      timer();
      function timer() {
        i--;
        $('#sendCode').text(i + '秒后重发');
        if (i == 0) {
          clearTimeout(timer);
          $('#sendCode').removeAttr("disabled");
          $('#sendCode').text('重新发送');
        } else {
          setTimeout(timer, 1000);
        }
      }
    }
  }

  var browser = {
    versions: function () {
      var u = navigator.userAgent, app = navigator.appVersion;
      return {         //移动终端浏览器版本信息
        trident: u.indexOf('Trident') > -1, //IE内核
        presto: u.indexOf('Presto') > -1, //opera内核
        webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
        gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
        mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
        ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
        android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
        iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
        iPad: u.indexOf('iPad') > -1, //是否iPad
        webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
      };
    }(),
    language: (navigator.browserLanguage || navigator.language).toLowerCase()
  }
</script>
</html>