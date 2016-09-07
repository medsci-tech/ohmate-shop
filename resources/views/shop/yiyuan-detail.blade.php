<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>换购专区</title>
  <link rel="stylesheet" href="{{asset('/css/swiper-3.3.0.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/shop.css')}}">
</head>
<body>

<div class="swiper-container">
  <div class="swiper-wrapper">
    @foreach($item['slide_images'] as $slide_image)
      <div class="swiper-slide">
        <img class="img-responsive" src="{{$slide_image['image_url']}}">
      </div>
    @endforeach
  </div>
  <div class="swiper-pagination"></div>
</div>

<div class="container" id="goods" v-cloak>
  <div class="row">
    <div>
      <span>@{{ goods.price | currency '￥' }}</span>
    </div>
    <h4>@{{{ goods.name }}}</h4>

    <p>@{{ goods.tag }}</p>
  </div>
  <div class="row">
    @foreach($item['images'] as $image)
      <img class="img-responsive" src="{{$image['image_url']}}" alt="">
    @endforeach
  </div>
  <br><br><br>

  <div class="navbar-fixed-bottom center-block">
    <div class="col-xs-8">
     <a class="button disabled" disabled="disabled" style="width: 100%;padding: 5px;background-color: transparent !important;border: none !important;">(商品限购一件)</a>
    </div>
    <div class="col-xs-4">
      <a v-if="goods.storage" href="{{url('/shop/yiyuan-cart')}}" class="button button-caution button-rounded" @click="addGoods()">立即购买</a>
      <button v-if="!goods.storage" class="button button-caution button-rounded disabled" @click="addGoods()">立即购买</button>
    </div>
  </div>

  <div class="jumbotron">
    <div class="alert text-center" role="alert">
      <p>@{{ goods.num }}件商品</p>
      <p>添加成功</p>
    </div>
  </div>

</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/swiper-3.3.0.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    $(function () {
	//点击量
		$.ajax({
		url: '/questionnaire2/countNum',
		data: {
			'action'		: 'click',
			'random'		: Math.random()
		},
		dataType: 'text',
		success: function(text) {},
		error: function() {}
	});
	
			
	//微信jssdk	
	var baseUrl = 'http://www.ohmate.cn/questionnaire2',
		imgUrl			= '{{asset("/")}}images/share.png',
		tTitle			= '1元钱 还包邮 让糖友们都哭笑了，福利来了！ ',
		tContent		= '重要的事情说三遍！糖友们领福利啦！领福利啦！领福利啦！'
	wx.config({
		debug: false,
		appId:'<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			'checkJsApi',
			'onMenuShareAppMessage',
			'onMenuShareTimeline',
			'onMenuShareQQ'
			
		]
	});

	wx.ready(function () {
			wx.onMenuShareAppMessage({
			title: tTitle,
			desc: tContent,
			link: baseUrl,
			imgUrl: imgUrl,
			trigger: function (res) {
				$.ajax({
					url: '/questionnaire2/countNum',
					data: {
						'action'		: 'share',
						'random'		: Math.random()
					},
					dataType: 'text',
					success: function(text) {},
					error: function() {}
				});
			},
			success: function (res) {

			},
			cancel: function (res) {
				// alert('已取消');
			},
			fail: function (res) {
				// alert(JSON.stringify(res));
			}
		});
	
		wx.onMenuShareQQ({
			title: tTitle, // 分享标题
			desc: tContent, // 分享描述
			link: baseUrl, // 分享链接
			imgUrl: imgUrl, // 分享图标
			success: function () { 
				$.ajax({
					url: '/questionnaire2/countNum',
					data: {
						'action'		: 'share',
						'random'		: Math.random()
					},
					dataType: 'text',
					success: function(text) {},
					error: function() {}
				});
			
			   // 用户确认分享后执行的回调函数
			},
			cancel: function () { 
			   // 用户取消分享后执行的回调函数
			}
		});
	
		wx.onMenuShareTimeline({
			title: tTitle,
			desc: tContent,
			link: baseUrl,
			imgUrl: imgUrl,
			trigger: function (res) {
				$.ajax({
					url: '/questionnaire2/countNum',
					data: {
						'action'		: 'share',
						'random'		: Math.random()
					},
					dataType: 'text',
					success: function(text) {},
					error: function() {}
				});
			},
			success: function (res) {

			},
			cancel: function (res) {
				// alert('已取消');
			},
			fail: function (res) {
				// alert(JSON.stringify(res));
			}
		});
		
	});
	wx.error(function (res) {
	   alert(res.errMsg);
	});

		
    });
</script>
<script>
  var goods = {
    id: '{{$item["id"]}}',
    name: '{{$item["name"]}}',
    tag: '{{$item["remark"]}}',
    price: {{$item["price"]}},
    storage: {{$item["storage"]}},
    min_cash_price: {{$item["min_cash_price"]}},
    num: 1
  };

  var cart = [];

  var list = new Vue({
    el: '#goods',
    data: {
      goods: goods,
      cart: cart
    },
    methods: {
      addGoods: function () {
        if (this.goods.storage) {
          this.cart.push({
              id: this.goods.id,
              name: this.goods.name,
              tag: this.goods.tag,
              price: this.goods.price,
              num: this.goods.num,
              min_cash_price: this.goods.min_cash_price
          });
          $('.jumbotron').show();
          $('.jumbotron').delay(1000).hide(0);
          $('.jumbotron .alert').show();
          $('.jumbotron .alert').delay(300).fadeOut(700);
          localStorage.cart_yiyuan = JSON.stringify(this.cart);
          setTimeout(function () {
            this.goods.num = 1;
          }, 900);
        } else {
          $('.jumbotron div').html('<p>商品暂时缺货!</p>');
          $('.jumbotron').show();
          $('.jumbotron').delay(1000).hide(0);
          $('.jumbotron .alert').show();
          $('.jumbotron .alert').delay(300).fadeOut(700);
        }
      }
    }
  });


</script>
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