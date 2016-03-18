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
                    <a href="http://mp.weixin.qq.com/s?__biz=MzI4NTAxMzc3Mw==&mid=404091722&idx=1&sn=94e3b8e85821a6fc4e937f91dc4035de&scene=0&previewkey=XOaKnnGt5xgBr1pSVCYmkswqSljwj2bfCUaCyDofEow%3D#wechat_redirect">
                        <img class="img-responsive" src="{{url('/image/shop_goods/top1.png')}}">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="http://mp.weixin.qq.com/s?__biz=MzI4NTAxMzc3Mw==&mid=404096608&idx=1&sn=37ad31726ab67eaa3fd04127a57d8de0&scene=0&previewkey=XOaKnnGt5xgBr1pSVCYmkswqSljwj2bfCUaCyDofEow%3D#wechat_redirect">
                        <img class="img-responsive" src="{{url('/image/shop_goods/top2.png')}}">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="http://mp.weixin.qq.com/s?__biz=MzI4NTAxMzc3Mw==&mid=404093809&idx=1&sn=7420813be88695f121e375dcb8238359&scene=0&previewkey=XOaKnnGt5xgBr1pSVCYmkswqSljwj2bfCUaCyDofEow%3D#wechat_redirect">
                        <img class="img-responsive" src="{{url('/image/shop_goods/top3.png')}}">
                    </a>
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
    var cart_num = '';
    if (typeof localStorage.cart != 'undefined') {
        var i = 0;
        var j = JSON.parse(localStorage.cart);
        alert(localStorage.cart);
        for ( k in j) {
            i++;
        }
        if (i != 0){
            cart_num = i;
        }
    }
    $('body').append('<nav id="touch1" style="position: fixed;opacity: 0.8;z-index: 100;right: 20px;bottom: 20px;"><a id="touch_btn1" href="{{url('/shop/cart')}}" class="button button-large button-glow button-caution button-circle"> <i class="fa fa-shopping-cart"></i>  <span class="badge" style="position: absolute;background-color: #f71212;border: 2px solid #EEEEEE;">'+cart_num+'</span> </a> </nav>')
    var touch1 = document.getElementById('touch1');
    var touch_btn1 = document.getElementById('touch_btn1');
    touch_btn1.addEventListener('touchmove', function (event) {
        event.preventDefault();
        if (event.targetTouches.length == 1) {
            var position = event.targetTouches[0];
            touch1.style.left = position.clientX - 30 + 'px';
            touch1.style.top = position.clientY - 30 + 'px';
            touch1.style.background = "";
        }
    }, false);
</script>
</body>
</html>