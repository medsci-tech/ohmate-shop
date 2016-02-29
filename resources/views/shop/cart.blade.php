<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>购物车</title>
  <link rel="stylesheet" href="{{asset('/css/swiper-3.3.0.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/shop.css')}}">

</head>
<body>

<div class="container" id="cart_form">

  <template v-if=" cart.length != 0 ">

    <div class="row" v-for="goods in cart">
      <div class="col-xs-3">
        <img class="img-responsive" :src="'/image/shop_goods/' + goods.id + '.png'" alt="">
      </div>
      <div class="col-xs-9">
        <h4>@{{ goods.name }}</h4>

        <p>@{{ goods.tag }}</p>
        <br>
        <div>
          <span>@{{ goods.price | currency '￥'  }}</span>
          <s>@{{ goods.priceBefore   | currency '￥'  }}</s>
          <div>
            <p>数量</p>
            <span @click="numMinus(goods)" class="glyphicon glyphicon-minus"></span>
            <p>@{{ goods.num }}</p>
            <span @click="numAdd(goods)" class="glyphicon glyphicon-plus"></span>
          </div>
        </div>
        <img src="{{asset('/image/shop_icon/Delete.png')}}" alt="" @click="removeGoods(goods)">
      </div>
    </div>
    <h5>消费明细></h5>
    <div class="cart-detail">
      <ul class="list-unstyled">
        <li v-for="goods in cart">
          <span>@{{ goods.name }}</span>
          <span>x@{{ goods.num }}</span>
          <span>@{{ priceGoods(goods) | currency '￥' }}</span>
        </li>
      </ul>
      <p>商品价格<span>@{{ priceAll | currency '￥' }}</span></p>
      <p>运费 <span>@{{ postage | currency '￥' }}</span></p>
      <p>迈豆折扣
        <span>－@{{ priceDiscount | currency '￥' }}</span>
        <span>@{{ priceDiscount*100 }}迈豆</span>
      </p>
    </div>
    <div class="navbar-fixed-bottom cart-submit">
      <div class="col-xs-8">
        <p>合计 <span>@{{ priceCount | currency '￥' }}</span></p>
      </div>
      <div class="col-xs-4">
        <button class="btn" @click="postCart()">付&emsp;款</button>
      </div>
    </div>


    <div class="address">
      <template v-if=" address == ''">
        <a class="btn  btn-default center-block" href="{{url('/shop/address')}}">添加收货地址</a>
      </template>
      <template v-else>
        <p>默认收货地址 <a href="{{url('/shop/address')}}"><span>管理地址</span></a></p>
        <p class="col-xs-4">收货人</p>
        <span class="col-xs-3">@{{ address.name }}</span>
        <span class="col-xs-5">@{{ address.phone }}</span>
        <div class="clearfix visible-xs-block"></div>
        <p class="col-xs-4">收货地址</p>
        <span class="col-xs-8">@{{ address.address }}</span>
        <div class="clearfix visible-xs-block"></div>
      </template>
    </div>

  </template>

  <template v-if=" cart.length == 0 ">
    <h3 class="text-center">没有商品！</h3>
    <nav class="navbar-fixed-bottom">

      <nav class="navbar-fixed-bottom">
        <a href="{{url('/shop/index')}}">
          <p>商城首页</p>
        </a>
      </nav>

    </nav>
  </template>

</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/shop_cart.js')}}"></script>

</body>
</html>