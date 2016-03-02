<!DOCTYPE html>
<html lang="en" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>我的地址</title>
  <link rel="stylesheet" href="{{asset('/css/shop.css')}}">
</head>

<body>
<div class="container" id="addresses">
  <h5 v-show=" addresses != '' ">选择收货地址
  </h5>
  <div class="row" v-for="address in addresses" v-cloak>
    <img v-bind:src=" address.is_default?chooseImg.imgtrue:chooseImg.imgfalse "
         alt="" @click="chooseAdd(address)"
    >

    <p class="col-xs-4" @click="chooseAdd(address)">收货人</p>
    <span class="col-xs-3">@{{ address.name }}</span>
    <span class="col-xs-5">@{{ address.phone }}</span>
    <div class="clearfix"></div>
    <p class="col-xs-4" @click="chooseAdd(address)">收货地址</p>
    <span class="col-xs-8">@{{ address.province }}@{{ address.city }}@{{ address.district }}@{{ address.address }}</span>
    <div class="clearfix"></div>
    <img v-if=" address.is_default == false " src="{{url('/image/shop_icon/Delete.png')}}"
         alt="" @click="removeAdd(address)">
  </div>

  <h5 id="title">添加收货地址</h5>

  <div class="row text-center">
    <form id="button" @submit.prevent="addFun">
      <label class="center-block"><span>收货人&emsp;</span>
        <input required type="text" placeholder="收货人姓名" v-model="newAdd.name">
      </label>
      <label><span>手机号&emsp;</span>
        <input required type="text" placeholder="收货人号码" v-model="newAdd.phone">
      </label>

      <div class="clearfix"></div>
      <div>
        <select name="province" id="province" v-model="newAdd.province"></select>
        <select name="city" id="city" v-model="newAdd.city"></select>
        <select name="area" id="area" v-model="newAdd.district"></select>
      </div>
      <label><span id="street">详细地址</span>
        <input required type="text" placeholder="街道地址" v-model="newAdd.address">
      </label>

      <div class="clearfix"></div>
      <button class="button button-caution button-rounded">添加并设为默认</button>
    </form>
  </div>
</div>
</body>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/address.js')}}"></script>
<script src="{{asset('/js/vendor/city.js')}}"></script>
<script>
  $(function () {
    city_selector();
  });
</script>
</html>