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
    <h4>@{{ goods.name }}</h4>

    <p>@{{ goods.tag }}</p>
  </div>
  <div class="row">
    @foreach($item['images'] as $image)
      <img class="img-responsive" src="{{$image['image_url']}}" alt="">
    @endforeach
  </div>
  <br><br><br>

  <div class="navbar-fixed-bottom center-block">
    <div class="col-xs-4">
      <span @click="numMinus()" class="fa fa-minus"></span>
      <p v-cloak>@{{ goods.num }}</p>
      <span @click="numAdd()" class="fa fa-plus"></span>
    </div>
    <div class="col-xs-4">
      <button class="button button-defualt" @click="addGoods()">加入购物车</button>
    </div>
    <div class="col-xs-4">
      <a href="{{url('/shop/cart')}}" class="button button-caution button-rounded" @click="addGoods()">立即购买</a>
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
<script>
  var goods = {
    id: '{{$item["id"]}}',
    name: '{{$item["name"]}}',
    tag: '{{$item["remark"]}}',
    price: {{$item["price"]}},
    num: 1
  };

  if (typeof localStorage.cart != 'undefined') {
    var cart = JSON.parse(localStorage.cart);
  } else {
    var cart = [];
  }


  var list = new Vue({
    el: '#goods',
    data: {
      goods: goods,
      cart: cart
    },
    computed: {
      alreadyHave: function () {
        for (i = 0; i < this.cart.length; i++) {
          if (this.cart[i].id == this.goods.id) {
            return i;
          }
        }
        return -1;
      }
    },
    methods: {
      addGoods: function () {
        if (cart_num == ''){
          cart_num = 0;
        }
        if (this.alreadyHave != -1) {
          this.cart[this.alreadyHave].num += this.goods.num;
        } else {
          this.cart.push({
            id: this.goods.id,
            name: this.goods.name,
            tag: this.goods.tag,
            price: this.goods.price,
            priceBefore: this.goods.priceBefore,
            num: this.goods.num
          });
          cart_num++;
        }
        $('#touch span').text( cart_num );
        $('.jumbotron').show();
        $('.jumbotron').delay(1000).hide(0);
        $('.jumbotron .alert').show();
        $('.jumbotron .alert').delay(300).fadeOut(700);
        localStorage.cart = JSON.stringify(this.cart);
        setTimeout(function () {
          this.goods.num = 1;
        }, 900);
      },
      numMinus: function () {
        if (this.goods.num >= 2) {
          this.goods.num--;
        }
      },
      numAdd: function () {
        if (this.goods.num <= 98) {
          this.goods.num++;
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
<script>

  var cart_num = '';
  if (list.cart.length != 0) {
    var i = 0;
    for (item in list.cart) {
      i++;
    }
    cart_num = i;
  }

  $('body').append('<nav id="touch" style="position: fixed;opacity: 0.8;z-index: 100;right: 20px;bottom: 60px;"><a id="touch_btn" href="{{url('/shop/cart')}}" class="button button-large button-glow button-caution button-circle"> <i class="fa fa-shopping-cart"></i> <span class="badge" style="position: absolute;background-color: #f71212;border: 2px solid #EEEEEE;">'+cart_num+'</span> </a> </nav>')
  var touch = document.getElementById('touch');
  var touch_btn = document.getElementById('touch_btn');
  touch_btn.addEventListener('touchmove', function (event) {
    event.preventDefault();
    if (event.targetTouches.length == 1) {
      var position = event.targetTouches[0];
      touch.style.left = position.clientX - 30 + 'px';
      touch.style.top = position.clientY - 30 + 'px';
      touch.style.background = "";
    }
  }, false);
</script>
</body>
</html>