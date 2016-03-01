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

<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/vendor/order.js')}}"></script>
</body>
</html>