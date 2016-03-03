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
@foreach($orders as $order)
  <div class="row order-form">
    <a href="{{url('/shop/order-details')}}"></a>
    <p>&emsp;下单时间：{{$order->created_at->toDateString()}}<span class="order-finished">待收货&emsp;</span></p>
    <div class="img-group">
      @foreach($order['commodities'] as $commodity)
        <div class="col-xs-3"><img class="" src="{{$commodity->portrait}}" alt=""></div>
      @endforeach
    </div>
    <div class="arrow"></div>
    <p>&emsp;实际支付：￥{{$order->cash_payment}}<small>(含运费￥{{$order->post_fee}})</small></p>
  </div>
@endforeach

</div>

<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/vendor/order.js')}}"></script>
</body>
</html>