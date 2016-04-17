<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>易康商城</title>
    <link rel="stylesheet" href="{{asset('/css/swiper-3.3.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/yk-web.css')}}">
    <link rel="stylesheet" href="{{asset('/css/weui.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/hongbao.css')}}">

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
                            <span>￥{{$item->price}}&numsp;</span><small>{{intval($item->price * 100)}}迈豆</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

    <nav class="navbar navbar-default navbar-fixed-bottom" id="index_nav_button">
        <div>
            <a href="{{url('/redirect/article-index')}}" class="button button-action col-xs-6" role="link">获取迈豆</a>
            <a href="{{url('/personal/information')}}" class="button button-highlight col-xs-6" role="link">个人中心</a>
        </div>
    </nav>

    <br><br><br>
    <div class="actionsheet" style="overflow: hidden">
        <!--BEGIN actionSheet-->
        <div id="actionSheet_wrap">
            <div class="weui_mask_transition" id="mask" style="display: none;"></div>
            <div class="weui_actionsheet" id="weui_actionsheet">
                <div class="weui_actionsheet_menu">
                    <img src="{{url('/image/education/hongbao.png')}}" alt="">
                    <p>20迈豆</p>
                    <p class="hongbao-word-1">新用户专享</p>
                    <p class="hongbao-word-2" style="color: #ffe034;">2180迈豆（可抵21.8元）</p>
                    <p class="hongbao-word-3">即可免费领一盒针头</p>
                    <p class="hongbao-word-4">每天坚持学习终身免费用针头</p>
                </div>
                <div class="weui_actionsheet_action">
                    <a class="weui_btn weui_btn_default" id="close_hongbao">确认</a>
                </div>
            </div>
        </div>
        <!--END actionSheet-->
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
        var j = JSON.parse(localStorage.cart);
        for (i=0; i < j.length; i++) ;
        if (i != 0){
            cart_num = i;
        }
    }
    $('body').append('<nav id="touch1" style="position: fixed;opacity: 0.8;z-index: 100;right: 20px;bottom: 60px;"><a id="touch_btn1" href="{{url('/shop/cart')}}" class="button button-primary button-large button-circle" style="background-color: #008CBA;"> <i class="fa fa-shopping-cart"></i>  <span class="badge" style="position: absolute;background-color: #008CBA;border: 2px solid #EEEEEE;">'+cart_num+'</span> </a> </nav>')
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
<script>
    @if(isset($first_in) and $first_in)
        first_in = true;
    @else
        first_in = false;
    @endif

    function settimer(i){
        if ( first_in ) {
            i +=1;
            timer();
            function timer() {
                i--;
                if (i == 0) {
                    clearTimeout(timer);
                    $('#mask').addClass('weui_fade_toggle');
                    $('#mask').css('display','block')
                    $('#weui_actionsheet').addClass('weui_actionsheet_toggle');
                } else {
                    setTimeout(timer, 1000);
                }
            }
        }
    }

    function colse_hongbao(){
        $('#mask').removeClass('weui_fade_toggle');
        $('#mask').css('display','none')
        $('#weui_actionsheet').removeClass('weui_actionsheet_toggle');
    }

    settimer(1);
    $('#close_hongbao').onclick(colse_hongbao())
</script>
</body>
</html>
