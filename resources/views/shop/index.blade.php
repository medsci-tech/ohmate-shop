<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>易康商城</title>
  <link rel="stylesheet" href="../css/swiper-3.3.0.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/shop.css">

</head>
<body>

<div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <img class="img-responsive" src="../image/test04.jpg">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="../image/test04.jpg">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="../image/test04.jpg">
    </div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<div class="container">

  <nav class="navbar-fixed-bottom">

    <div class="nav-button">
      <a href="shop">
        <img src="../image/shop_nav/HOME-1.png" alt=""><br>

        <p class="nav-active">首页</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="shop_category">
        <img src="../image/shop_nav/classification.png" alt=""><br>

        <p>分类</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="shop_cart">
        <img src="../image/shop_nav/SHOPPING.png" alt=""><br>

        <p>购物车</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="shop_order">
        <img src="../image/shop_nav/NOTEPAD.png" alt=""><br>

        <p>订单</p>
      </a>
    </div>

    <div class="nav-button">
      <a href="shop_person">
        <img src="../image/shop_nav/USER.png" alt=""><br>

        <p>个人</p>
      </a>
    </div>

  </nav>


  <div class="row">

    <div class="col-xs-6">
      <h4>诺和针 32G Tip ETW</h4>

      <p>一次性使用无菌注射针</p>
      <img class="img-responsive" src="../image/test02.png" alt="">

      <div>
        <span>￥22</span>

        <p>迈豆换购价2200</p>
      </div>
    </div>
    <div class="col-xs-6">
      <h4>低糖卫士</h4>

      <p>葡萄糖压片糖果</p>
      <img class="img-responsive" src="../image/test02.png" alt="">

      <div>
        <span>￥29</span>

        <p>迈豆换购价2900</p>
      </div>
    </div>
    <div class="col-xs-6">
      <h4>摇摇杯</h4>

      <p>OGTT测试杯</p>
      <img class="img-responsive" src="../image/test02.png" alt="">

      <div>
        <span>￥20</span>

        <p>迈豆换购价2000</p>
      </div>
    </div>
    <div class="col-xs-6">
      <h4>易折清洁消毒棒</h4>

      <p>一次性使用无菌</p>
      <img class="img-responsive" src="../image/test02.png" alt="">

      <div>
        <span>￥22</span>

        <p>迈豆换购价2200</p>
      </div>
    </div>
    <div class="col-xs-6">
      <h4>清呤卫视</h4>

      <p>碱性泡腾片</p>
      <img class="img-responsive" src="../image/test02.png" alt="">

      <div>
        <span>￥22</span>

        <p>迈豆换购价2200</p>
      </div>
    </div>
    <div class="col-xs-6">
      <h4>诺和针 32G Tip ETW</h4>

      <p>一次性使用无菌注射针</p>
      <img class="img-responsive" src="../image/test02.png" alt="">

      <div>
        <span>￥22</span>

        <p>迈豆换购价2200</p>
      </div>
    </div>
    <div class="col-xs-6">
      <h4>诺和针 32G Tip ETW</h4>

      <p>一次性使用无菌注射针</p>
      <img class="img-responsive" src="../image/test02.png" alt="">

      <div>
        <span>￥22</span>

        <p>迈豆换购价2200</p>
      </div>
    </div>

  </div>

</div>

<script src="../js/vendor/jquery-2.1.4.min.js"></script>
<script src="../js/vendor/swiper-3.3.0.min.js"></script>
<script>
  var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    slidesPerView: 1,
    paginationClickable: true,
    loop: true,
    visiblilityFullfit: true,
    autoplay: 4000,
    speed: 500,
  });
</script>

</body>
</html>