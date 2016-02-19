<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>易康商城</title>
  <link rel="stylesheet" href="{{asset('css/swiper-3.3.0.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/shop.css')"}}>

</head>
<body>

<div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('image/test04.jpg')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('image/test04.jpg')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('image/test04.jpg')}}">
    </div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<div class="container" id="goods">
  <div class="row">
    <div>
      <span>@{{ goods.price | currency '￥' }}</span><s>原价@{{ goods.priceBefore | currency '￥' }}</s>
    </div>
    <h4>@{{ goods.name }}</h4>

    <p>@{{ goods.tag }}</p>
  </div>
  <div class="row">
    <p>图文详情</p>
  </div>

  <div class="navbar-fixed-bottom">
    <div class="col-xs-4">
      <span @click="numMinus()">－</span>
      <input v-model='goods.num' number debounce="200" type="text" maxlength="2"
             onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"
             onblur="if( this.value == 0 ) this.value = 1;"
      >
      <span @click="numAdd()">＋</span>
    </div>
    <div class="col-xs-4">
      <button class="btn" @click="addGoods()">加入购物车</button>
    </div>
    <div class="col-xs-4">
      <a href="{{url('shop/cart')}}" class="btn" @click="addGoods()">立即购买</a>
    </div>
  </div>

</div>


<script src="{{asset('js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/vendor/swiper-3.3.0.min.js')}}"></script>
<script src="{{asset('js/vendor/vue.js')}}"></script>
<script src="{{asset('js/goods.js')}}">
  if (localStorage.cart != 'undefined' && localStorage.cart) {
    var cart = JSON.parse(localStorage.cart);
  } else {
    var cart = [];
  }


  var shop_cart = new Vue({
    el: '#cart_form',
    data: {
      cart: cart,

      person: {
        beans: 900,
        consume: 0
      },

      address: {
        name: '杨先生',
        phone: '18311561869',
        address: '湖北省武汉市东湖高新大道3234号'
      }
    },

    computed: {
      priceAll: function () {
        var all = 0;
        for (i = 0; i < this.cart.length; i++) {
          all += this.cart[i].price * this.cart[i].num;
        }
        return all;
      },
      priceDiscount: function () {
        this.person.consume =
          this.person.beans < this.priceAll * 100 ? this.person.beans : this.priceAll * 100;
        return this.person.consume / 100;
      },
      priceCount: function () {
        return this.priceAll + 8 - this.priceDiscount;
      }

    },

    methods: {
      removeGoods: function (e) {
        this.cart.$remove(e);
      },
      priceGoods: function (e) {
        return e.price * e.num;
      },
      numMinus: function (e) {
        if (e.num >= 2) {
          e.num--;
        }
      },
      numAdd: function (e) {
        if (e.num <= 98) {
          e.num++;
        }
      },
      beansConsume: function () {
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
    speed: 500,
  });
</script>
</body>
</html>