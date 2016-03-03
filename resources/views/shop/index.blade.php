<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>易康商城</title>
    <link rel="stylesheet" href="{{asset('/css/swiper-3.3.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/shop_rebuild.css')}}">

</head>
<body>


<div class="container shop-index">
    <div class="row">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="img-responsive" src="{{url('/image/shop_goods/top1.jpg')}}">
                </div>
                <div class="swiper-slide">
                    <img class="img-responsive" src="{{url('/image/shop_goods/top2.jpg')}}">
                </div>
                <div class="swiper-slide">
                    <img class="img-responsive" src="{{url('/image/shop_goods/top3.jpg')}}">
                </div>
                <div class="swiper-slide">
                    <img class="img-responsive" src="{{url('/image/shop_goods/top4.jpg')}}">
                </div>
            </div>
        <div class="swiper-pagination"></div>
    </div>
    </div>

    <div class="row">

        @foreach($items as $item)
        <div class="col-xs-6">
            <a href="{{url('/shop/commodity/') .'/'. $item->id}}">
                <div class="thumbnail">
                    <img src="{{$item->portrait}}" alt="">
                    <div class="caption">
                        <p>{{$item->name}}</p>
                        <p class="small">{{$item->remark}}</p>
                        <strong>￥{{$item->price}}</strong><span>/<small>{{intval($item->price * 100)}}迈豆</small></span>
                    </div>
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
<script>
    $('body').append('<nav id="touch1" style="position: fixed;opacity: 0.8;z-index: 100;right: 20px;bottom: 20px;"><a href="{{url('/shop/cart')}}" class="button button-large button-glow button-caution button-circle"> <i class="fa fa-shopping-cart"></i> </a> </nav>')
    var touch1 = document.getElementById('touch1');
    touch1.addEventListener('touchmove', function (event) {
        event.preventDefault();
        if (event.targetTouches.length == 1) {
            var touch = event.targetTouches[0];
            touch1.style.left = touch.clientX - 30 + 'px';
            touch1.style.top = touch.clientY - 30 + 'px';
            touch1.style.background = "";
        }
    }, false);
</script>

<script>
    $('body').append('<nav id="touch2" style="position: fixed;opacity: 0.8;z-index: 100;right: 20px;bottom: 90px;"><a href="{{url('/shop/index')}}" class="button button-large button-glow button-highlight button-circle"> <i class="fa fa-list"></i> </a> </nav>')
    var touch2 = document.getElementById('touch2');
    touch2.addEventListener('touchmove', function (event) {
        event.preventDefault();
        if (event.targetTouches.length == 1) {
            var touch = event.targetTouches[0];
            touch2.style.left = touch.clientX - 30 + 'px';
            touch2.style.top = touch.clientY - 30 + 'px';
            touch2.style.background = "";
        }
    }, false);
</script>
</body>
</html>