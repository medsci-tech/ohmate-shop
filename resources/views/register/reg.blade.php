<!DOCTYPE html>
<html lang="en" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>我的地址</title>
  <link rel="stylesheet" href="{{asset('/css/shop_rebuild.css')}}">

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
            <button type="button" class="btn btn-info" style="width: 36%; margin: 0 0 0 4%;" onclick='turnTo();'>获取验证码</button>
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
          <div class="col-xs-9">
            <label style="font-weight: normal"><input type="radio" value="1" name="gift_type" v-model="newAdd.gift_type">糖尿病I型</label>&emsp;
            <label style="font-weight: normal"><input type="radio" value="2" name="gift_type" v-model="newAdd.gift_type">糖尿病II型</label>
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
</html>