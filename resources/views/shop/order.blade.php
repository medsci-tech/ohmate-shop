<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>我的订单</title>
  <link rel="stylesheet" href="{{asset('/css/shop.css')}}">
</head>
<body>
<div class="container">

  <nav class="navbar-fixed-bottom">
    <div class="nav-button">
      <a href="{{url('/shop/index')}}">
        <img src="{{url('/image/shop_nav/HOME.png')}}" alt=""><br>
        <p>首页</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="{{url('/shop/category')}}">
        <img src="{{url('/image/shop_nav/classification.png')}}" alt=""><br>
        <p>分类</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="{{url('/shop/cart')}}">
        <img src="{{url('/image/shop_nav/SHOPPING.png')}}" alt=""><br>
        <p>购物车</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="{{url('/shop/order')}}">
        <img src="{{url('/image/shop_nav/NOTEPAD-1.png')}}" alt=""><br>
        <p class="nav-active">订单</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="{{url('/shop/personal')}}">
        <img src="{{url('/image/shop_nav/USER.png')}}" alt=""><br>
        <p>个人</p>
      </a>
    </div>
  </nav>

  {{--example--}}
  <div class="row order-form">
    <a href="{{url('/shop/order-details')}}"></a>
    <p>&emsp;下单时间：2016.01.01<span class="order-finished">待收货&emsp;</span></p>
    <div class="img-group">
      <div class="col-xs-3"><img class="" src="../image/test02.png" alt=""></div>
      <div class="col-xs-3"><img class="" src="../image/test02.png" alt=""></div>
      <div class="col-xs-3"><img class="" src="../image/test02.png" alt=""></div>
      <div class="col-xs-3"><img class="" src="../image/test02.png" alt=""></div>
    </div>
    <div class="arrow"></div>
    <p>&emsp;实际支付：￥88.00<small>(含运费￥8.00)</small></p>
  </div>
  {{--end_example--}}

</div>
</body>
</html>