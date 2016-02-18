<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>购物车</title>
  <link rel="stylesheet" href="{{asset('/css/swiper-3.3.0.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/shop.css')}}">

</head>
<body>

<div class="container" id="cart_form">

  <template v-if=" cart.length != 0 ">

    <div class="row" v-for="goods in cart">
      <div class="col-xs-3">
        <img class="img-responsive" src="{{asset('image/test02.png')}}" alt="">
      </div>
      <div class="col-xs-9">
        <h4>@{{ goods.name }}</h4>

        <p>@{{ goods.detail }}</p>
        <br>
        <div>
          <span>￥@{{ goods.price }}</span>
          <s>￥@{{ goods.priceBefore }}</s>
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
        <img src="../../image/shop_icon/Delete.png" alt="" @click="removeGoods(goods)">
      </div>
    </div>
    <h5>消费明细></h5>
    <div class="cart-detail">
      <ul class="list-unstyled">
        <li v-for="goods in cart">
          <span>{{ goods.name }}</span>
          <span>x{{ goods.num }}</span>
          <span>{{ priceGoods(goods) | currency '￥' }}</span>
        </li>
      </ul>
      <p>商品价格<span>{{ priceAll | currency '￥' }}</span></p>
      <p>运费 <span>￥8.00</span></p>
      <p>迈豆折扣
        <span>－{{ priceDiscount | currency '￥' }}</span>
        <span>
          <input type="text" v-model=" person.consume " number debounce="200" maxlength="6"
                 onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"
          @blur="beansConsume()"
          >
          迈豆
        </span>
      </p>
    </div>
    <div class="navbar-fixed-bottom cart-submit">
      <div class="col-xs-8">
        <p>合计 <span>{{ priceCount | currency '￥' }}</span></p>
      </div>
      <div class="col-xs-4">
        <button class="btn btn-lg">付&emsp;款</button>
      </div>
    </div>


    <div class="address">
      <template v-if=" address == null ">
        <a class="btn  btn-default center-block" href="">添加收货地址</a>
      </template>
      <template v-else>
        <p>默认收货地址 <a href=""><span>管理地址</span></a></p>
        <p class="col-xs-4">收货人</p>
        <span class="col-xs-3">{{ address.name }}</span>
        <span class="col-xs-5">{{ address.phone }}</span>
        <div class="clearfix visible-xs-block"></div>
        <p class="col-xs-4">收货地址</p>
        <span class="col-xs-8">{{ address.address }}</span>
        <div class="clearfix visible-xs-block"></div>
      </template>
    </div>

  </template>

  <template v-if=" cart.length == 0 ">
    <h3 class="text-center">没有商品！</h3>
    <nav class="navbar-fixed-bottom">

      <div class="nav-button">
        <a href="">
          <img src="../../image/shop_nav/HOME-1.png" alt=""><br>

          <p>首页</p>
        </a>
      </div>

      <div class="nav-button">
        <a href="shop_category">
          <img src="../../image/shop_nav/classification.png" alt=""><br>

          <p>分类</p>
        </a>
      </div>

      <div class="nav-button">
        <a href="shop_cart">
          <img src="../../image/shop_nav/SHOPPING.png" alt=""><br>

          <p class="nav-active">购物车</p>
        </a>
      </div>

      <div class="nav-button">
        <a href="shop_order">
          <img src="../../image/shop_nav/NOTEPAD.png" alt=""><br>

          <p>订单</p>
        </a>
      </div>

      <div class="nav-button">
        <a href="shop_person">
          <img src="../../image/shop_nav/USER.png" alt=""><br>

          <p>个人</p>
        </a>
      </div>

    </nav>
  </template>

</div>

<script src="../../js/vendor/jquery-2.1.4.min.js"></script>
<script src="../../js/vendor/vue.js"></script>
<script src="../../js/shop_cart.js"></script>

</body>
</html>