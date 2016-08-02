<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>一元专区</title>
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
     <p>(商品限购一件)</p>
    </div>
    <div class="col-xs-4">
      <a v-if="goods.storage" href="{{url('/shop/cart')}}" class="button button-caution button-rounded" @click="addGoods()">立即购买</a>
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
          $('#touch span').text(cart_num);
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