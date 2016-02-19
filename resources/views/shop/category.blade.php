<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>分类浏览</title>
  <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/shop.css')}}">

</head>
<body style="background-color: #EEEEEE;">

<div class="container category">

  <nav class="navbar-fixed-bottom">
    <div class="nav-button">
      <a href="{{url('/shop/index')}}">
        <img src="{{url('/image/shop_nav/HOME.png')}}" alt=""><br>

        <p>首页</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="{{url('/shop/category')}}">
        <img src="{{url('/image/shop_nav/classification-1.png')}}" alt=""><br>

        <p class="nav-active">分类</p>
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
        <img src="{{url('/image/shop_nav/NOTEPAD.png')}}" alt=""><br>

        <p>订单</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="{{url('/shop/personal')}}">
        <img src="{{url('/image/shop_nav/USER.png')}}" alt=""><br>

        <p>个人</p>
      </a>
    </div>
  </nav>

  <div class="col-xs-3">
    <ul class="list-unstyled">
      <li class="li-active">分类1</li>
      <li>分类2</li>
      <li>分类3</li>
      <li>分类4</li>
      <li>分类5</li>
    </ul>
  </div>

  <div class="col-xs-9">

    <div class="col-xs-6">
      <a href="">
        <h4>诺和针</h4>

        <p>一次性使用无菌注射针</p>
        <img class="img-responsive" src="{{url('/image/test02.png')}}" alt="">

        <div>
          <span>￥22</span>

          <p>迈豆换购价2200</p>
        </div>
      </a>
    </div>

  </div>

</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/shop_category.js')}}"></script>
</body>
</html>