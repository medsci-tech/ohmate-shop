<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>购物车</title>
  <link rel="stylesheet" href="{{asset('/css/shop_rebuild.css')}}">

</head>
<body>

<div class="container" id="cart_form">

  <template v-if=" cart.length != 0 ">

    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">商品清单</div>
        <ul class="list-unstyled list-group">
          <li class="list-group-item" v-for="goods in cart">
            <div class="media">
              <div class="media-left media-middle">
                <img class="media-object" :src="'/image/shop_goods/' + goods.id + '.png'" alt="...">
              </div>
              <div class="media-body">
                <strong class="media-heading">@{{ goods.name }}</strong>

                <p>
                  <strong>@{{ goods.price | currency '￥' }}</strong>
            <span>数量
              <span @click="numMinus(goods)" class="fa fa-minus"></span>
                  <span>@{{ goods.num }}</span>
                  <span @click="numAdd(goods)" class="fa fa-plus"></span>
                  </span>
                </p>
                <span class="fa fa-close" @click="removeGoods(goods)"></span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">消费明细</div>
        <table class="table table-condensed table1">
          <tbody>
          <tr v-for="goods in cart">
            <td>@{{ goods.name }}</td>
            <td>x@{{ goods.num }}</td>
            <td>@{{ priceGoods(goods) | currency '￥' }}</td>
          </tr>
          </tbody>
          <tfoot>
          <tr>
            <td>运费</td>
            <td></td>
            <td>@{{ address.post_fee | currency '￥' }}</td>
          </tr>
          <tr>
            <td>迈豆折扣</td>
            <td>@{{ Math.round(priceDiscount*100) }}迈豆</td>
            <td>－@{{ priceDiscount | currency '￥' }}</td>
          </tr>
          <tr>
            <td>合计</td>
            <td></td>
            <td>@{{ priceCount | currency '￥' }}</td>
          </tr>
          </tfoot>


        </table>
      </div>
    </div>

    <div class="row">
      <template v-if=" address == null ">
        <div class="col-xs-12">
          <br>
          <a class="button button-block button-caution" href="{{url('/shop/address')}}">添加收货地址</a>
        </div>
      </template>
      <template v-else>
        <div class="panel panel-default">
          <div class="panel-heading">收货地址<a href="{{url('/shop/address')}}"><span class="small">选择收货地址</span></a></div>
          <table class="table table-condensed table2">
            <tr>
              <th>收货人</th>
              <td>@{{ address.name }}</td>
              <td>@{{ address.phone }}</td>
            </tr>
            <tr>
              <th>收货地址</th>
              <td colspan="2">@{{ address.province }}@{{ address.city }}@{{ address.district }}@{{ address.address }}</td>
            </tr>
          </table>
        </div>
      </template>
    </div>
    <br><br><br><br>

    <div class="navbar-fixed-bottom">
      <div class="col-xs-7">
        <p>合计 <span>@{{ priceCount | currency '￥' }}</span></p>
      </div>
      <div class="col-xs-5">
        <button class="button button-caution button-rounded" @click="postCart() | debounce 1000">付&emsp;款</button>
      </div>
    </div>

  </template>

  <template v-if=" cart.length == 0 ">
    <a href="{{url('/shop/index')}}">
      <h3 class="text-center">购物车中没有商品！</h3>
    </a>
  </template>

</div>


<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/shop_cart.js')}}"></script>
</body>
</html>