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
    <small>(点击编辑)</small>
  </h5>
  <div class="row" v-for="address in addresses">
    <img v-bind:src=" address.default?chooseImg.imgtrue:chooseImg.imgfalse "
         alt="" @click="chooseAdd(address)"
    >

    <p class="col-xs-4" @click="chooseAdd(address)">收货人</p>
    <span class="col-xs-3" @click="editAdd(address)">@{{ address.name }}</span>
    <span class="col-xs-5" @click="editAdd(address)">@{{ address.phone }}</span>
    <div class="clearfix"></div>
    <p class="col-xs-4" @click="chooseAdd(address)">收货地址</p>
    <span class="col-xs-8" @click="editAdd(address)">@{{ address.address }}</span>
    <div class="clearfix"></div>
    <img v-if=" address.default == false " src="../../image/shop_icon/Delete.png" alt="" @click="removeAdd(address)">
  </div>

  <h5>添加收货地址</h5>

  <div class="row text-center">
    <form @submit.prevent="addAdd">
      <label class="center-block"><span>收货人&emsp;</span>
        <input required type="text" placeholder="收货人姓名" v-model="newAdd.name">
      </label>
      <label><span>手机号&emsp;</span>
        <input required type="text" placeholder="收货人号码" v-model="newAdd.phone">
      </label>

      <div class="clearfix"></div>
      <div>
        <select name="province" id="province"></select>
        <select name="city" id="city"></select>
        <select name="area" id="area"></select>
      </div>
      <label><span id="street">详细地址</span>
        <input required type="text" placeholder="街道地址" v-model="newAdd.address">
      </label>

      <div class="clearfix"></div>
      <button class="btn">添加并设为默认</button>
    </form>
  </div>
</div>
</body>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script>
  var address = new Vue({
    el: '#addresses',
    data: {
      addresses: [],
      newAdd: {
        name: '',
        phone: '',
        address: '',
        postage: 8,
        default: false
      },
      chooseImg: {
        imgtrue: '/image/shop_icon/icon.png',
        imgfalse: '/image/shop_icon/icon1.png'
      },
    },

    methods: {
      removeAdd: function (e) {
        if (e.default == true) {
          this.addresses.$remove(e);
          this.addresses[0].default = true;
        } else {
          this.addresses.$remove(e);
        }
        $.post('/shop/address/create', JSON.stringify(address.$data.addresses),
          function(data, status){
            if (data.success) {
            } else {
              alert('服务器异常!');
            }
          }, "json"
        );
      },
      chooseAdd: function (e) {
        for (i = 0; i < this.addresses.length; i++) {
          this.addresses[i].default = false;
        }
        e.default = true;
      },
      addAdd: function () {
        if ($('#province').val() && $('#city').val() && $('#area').val()) {
          for (i = 0; i < this.addresses.length; i++) {
            this.addresses[i].default = false;
          }
          if ($('#province').val() == '新疆维吾尔自治区' || $('#province').val() == '西藏自治区') {
            this.newAdd.postage = 12;
          }
          this.addresses.push({
            name: this.newAdd.name,
            phone: this.newAdd.phone,
            address: $('#province').val() + $('#city').val() + $('#area').val() + this.newAdd.address,
            postage: this.newAdd.postage,
            default: true
          });
          this.newAdd = {
            name: '',
            phone: '',
            address: '',
            postage: 8,
            default: false
          };
          $.post('/shop/address/create', JSON.stringify(address.$data.addresses));
        }
      },
      editAdd: function (e) {
        if ((this.newAdd.name || this.newAdd.phone || this.newAdd.address) == 0) {
          if (e.default == true) {
            this.addresses[0].default = true;
            this.addresses.$remove(e);
          } else {
            this.addresses.$remove(e);
          }
          this.newAdd.name = e.name;
          this.newAdd.phone = e.phone;
        }
      }
    }
  });
</script>
<script src="{{asset('/js/vendor/city.js')}}"></script>
<script>
$(function () {
city_selector();
});
</script>
</html>