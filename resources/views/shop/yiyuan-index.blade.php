<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>换购专区</title>
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
                <div class="swiper-slide">
                    <a href="#">
                        <img class="img-responsive" src="{{url('/image/shop_goods/top5.jpg')}}">
                    </a>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="row">

        @foreach($items as $item)
            <div class="col-xs-6">
                <a href="{{url('/shop/yiyuan-commodity/') .'/'. $item->id}}">
                    <div class="thumbnail">
                        <img src="{{$item->portrait}}" alt="">
                        <div class="caption">
                            <p style="overflow: hidden; text-overflow:ellipsis;white-space:nowrap;">{{$item->name}}</p>
                            <p class="small" style="overflow: hidden; text-overflow:ellipsis;white-space:nowrap;">{{$item->remark}}</p>
                            <strong>￥{{$item->price}}</strong><span>@if($item->min_cash_price == 0)/<small>{{intval($item->price * 100)}}迈豆</small>@endif
                            </span>
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
        speed: 500
    });
</script>
</body>
</html>