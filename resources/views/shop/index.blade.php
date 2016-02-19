<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>易康商城</title>
    <link rel="stylesheet" href="{{asset('/css/swiper-3.3.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/shop.css')}}">

</head>
<body>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img class="img-responsive" src="{{url('/image/test04.jpg')}}">
        </div>
        <div class="swiper-slide">
            <img class="img-responsive" src="{{url('/image/test04.jpg')}}">
        </div>
        <div class="swiper-slide">
            <img class="img-responsive" src="{{url('/image/test04.jpg')}}">
        </div>
    </div>
    <div class="swiper-pagination"></div>
</div>

<div class="container">

    <nav class="navbar-fixed-bottom">
        <div class="nav-button">
            <a href="{{url('/shop/index')}}">
                <img src="{{url('/image/shop_nav/HOME-1.png')}}" alt=""><br>
                <p class="nav-active">首页</p>
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


    <div class="row">

        @foreach($items as $item)
        <div class="col-xs-6">
            <a href="{{url('/shop/commodity/'). $item->id}}">
                <h4>{{$item->name}}</h4>
                <p>{{$item->remark}}</p>
                <img class="img-responsive" src="{{url('/image/test02.png')}}" alt="">
                <div>
                    <p> <span>￥{{$item->price}}</span>{{intval($item->price * 100)}}迈豆</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/swiper-3.3.0.min.js')}}"></script>
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