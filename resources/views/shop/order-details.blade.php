<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>我的订单</title>
  <link rel="stylesheet" href="{{asset('/css/shop.css')}}">
</head>
<body>
<div class="container" id="order-details">

  <div class="row address">
    <p>订单信息</p>
    <p></p>
    <p class="col-xs-4" @click="chooseAdd(address)">订单号</p>
    <span class="col-xs-8" @click="editAdd(address)">@{{ order.id }}</span>
    <div class="clearfix"></div>
    <p class="col-xs-4" @click="chooseAdd(address)">物流编号</p>
    <span class="col-xs-8" @click="editAdd(address)">@{{ order.logistics }}</span>
    <div class="clearfix"></div>
    <p class="col-xs-4" @click="chooseAdd(address)">下单时间</p>
    <span class="col-xs-8" @click="editAdd(address)">@{{ order.time }}</span>
    <div class="clearfix"></div>
  </div>
  <div class="row address">
    <p>收货地址</p>
    <p class="col-xs-4" @click="chooseAdd(address)">收货人</p>
    <span class="col-xs-3" @click="editAdd(address)">@{{ order.name }}</span>
    <span class="col-xs-5" @click="editAdd(address)">@{{ order.phone }}</span>
    <div class="clearfix"></div>
    <p class="col-xs-4" @click="chooseAdd(address)">收货地址</p>
    <span class="col-xs-8" @click="editAdd(address)">@{{ order.address }}</span>
    <div class="clearfix"></div>
  </div>
  <h5>消费明细></h5>
  <div class="cart-detail">
    <ul class="list-unstyled">
      <li v-for="goods in cart">
        <span>@{{ goods.name }}</span>
        <span>x@{{ goods.num }}</span>
        <span>@{{ goods.priceGoods | currency '￥' }}</span>
      </li>
    </ul>
    <p>商品价格<span>@{{ priceAll | currency '￥' }}</span></p>
    <p>运费 <span>@{{ address.postage | currency '￥' }}</span></p>
    <p>迈豆折扣
      <span>－@{{ priceDiscount | currency '￥' }}</span>
      <span>@{{ priceDiscount*100 }}迈豆</span>
    </p>
    <p>合计<span>@{{ order.priceAll | currency '￥' }}</span></p>
  </div>
</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script>
  var list = new Vue({
    el: '#order-details',
    data: {
      cart: [{
        id: 01,
        name: '易折消毒棒1',
        priceGoods: 20,
        num: 1
      }, {
        id: 01,
        name: '易折消毒棒1',
        priceGoods: 20,
        num: 1
      }, {
        id: 01,
        name: '易折消毒棒1',
        priceGoods: 20,
        num: 1
      }],
      order: {
        id: 2016100451002,
        logistics: 'EMSS989430820804900',
        time: '2016-01-02',
        name: '杨先生',
        phone: '18311561869',
        address: '湖北省武汉市东湖高新大道3234号',
        priceAll: 60
      },
    },

  });
</script>
</body>
</html>