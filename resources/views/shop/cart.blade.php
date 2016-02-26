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
        <img class="img-responsive" :src="{'/image/shop_goods/' + goods.id + '.png'}" alt="">
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
            <span @click="numMinus(goods)">－</span>
            <input v-model='goods.num' number debounce="200" type="text" maxlength="2"
                   onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"
                   onblur="if( this.value == 0 ) this.value = 1;"
            >
            <span @click="numAdd(goods)">＋</span>
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
      <template v-if=" address == null ">
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

      <div class="nav-button">
        <a href="{{url('/shop/index')}}">
          <img src="{{asset('/image/shop_nav/HOME.png')}}" alt=""><br>

          <p>首页</p>
        </a>
      </div>

      <div class="nav-button">
        <a href="{{url('/shop/category')}}">
          <img src="{{asset('/image/shop_nav/classification.png')}}" alt=""><br>

          <p>分类</p>
        </a>
      </div>

      <div class="nav-button">
        <a href="{{url('/shop/cart')}}">
          <img src="{{asset('/image/shop_nav/SHOPPING-1.png')}}" alt=""><br>

          <p class="nav-active">购物车</p>
        </a>
      </div>

      <div class="nav-button">
        <a href="{{url('/shop/order')}}">
          <img src="{{asset('/image/shop_nav/NOTEPAD.png')}}" alt=""><br>

          <p>订单</p>
        </a>
      </div>

      <div class="nav-button">
        <a href="{{url('/shop/personal')}}">
          <img src="{{asset('/image/shop_nav/USER.png')}}" alt=""><br>

          <p>个人</p>
        </a>
      </div>

    </nav>
  </template>

</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/shop_cart.js')}}"></script>

</body>
</html>