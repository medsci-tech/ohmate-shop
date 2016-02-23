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
      <a href="{{url('/shop/cart')}}" class="btn" @click="addGoods()">立即购买</a>
    </div>
  </div>

  <div class="jumbotron">
    <div class="alert text-center" role="alert">
      添加成功
    </div>
  </div>

  <div id="test"></div>
</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/swiper-3.3.0.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script>
  var goods = {
    id: '{{$item->id}}',
    name: '{{$item->name}}'.replace("&reg;", "®"),
    tag: '{{$item->remark}}',
    price: {{$item->price}},
    priceBefore: {{$item->price * 1.25}},
    num: 1
  };

  localStorage.clear();

  $('#test').text(localStorage.cart != 'undefined');

  if (localStorage.cart != 'undefined' && localStorage.cart ) {
    var cart = JSON.parse(localStorage.cart);
  } else {
    var cart = [];
  }


  var list = new Vue({
    el: '#goods',
    data: {
      //goods: {
      //  id: '2',
      //  name: '易折清洁消毒棒',
      //  tag: '一次性使用无菌注射针',
      //  price: 22.00,
      //  priceBefore: 30.00,
      //  num: 1
      //},
      goods: goods,
//      cart: cart,
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
        }
        localStorage.cart = JSON.stringify(this.cart);
        this.goods.num = 1;
        $('.jumbotron').show();
        $('.jumbotron').delay(1000).hide(0);
        $('.jumbotron .alert').show();
        $('.jumbotron .alert').delay(300).fadeOut(700);
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
</body>
</html>