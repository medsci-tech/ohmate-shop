<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>京东礼品券</title>
  <link rel="stylesheet" href="{{asset('/css/shop_rebuild.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<div class="container" id="gift_card" v-cloak>
  <br>
  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading text-center">京东礼品券</div>
      <ul class="list-unstyled list-group">
        <li class="list-group-item">
          <div class="media">
            <div class="media-left media-middle">
              <img class="media-object" src="/image/shop_goods/gift1000.png" alt="...">
            </div>
            <div class="media-body">
              <strong class="media-heading">1000元京东礼品券</strong>

              <p>
                <strong>100000迈豆</strong>
            <span>数量
              <span @click="numMinus()" class="fa fa-minus"></span>
              <span>@{{ num }}</span>
              <span @click="numAdd()" class="fa fa-plus"></span>
            </span>
              </p>
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
        <tr>
          <td>1000元京东礼品券</td>
          <td>x@{{ num }}</td>
          <td>@{{ num*100000 }}迈豆</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <td>迈豆消费</td>
          <td></td>
          <td>@{{ num*100000 }}迈豆</td>
        </tr>
        <tr>
          <td>迈豆余额</td>
          <td></td>
          <td>@{{ beans_total - num*100000 }}迈豆</td>
        </tr>
        </tfoot>


      </table>
    </div>
  </div>

  <br><br><br><br>

  <div class="navbar-fixed-bottom">
    <div class="col-xs-7">
      <p>合计 <span>@{{ num*100000 }}迈豆</span></p>
    </div>
    <div class="col-xs-5">
      <button v-if="can_buy" class="button button-caution button-rounded" @click="buyCard | debounce 1000">申请兑换</button>
      <button v-if="!can_buy" class="button button-caution button-rounded" disabled>迈豆不足</button>
    </div>
  </div>

  </template>

  <div class="jumbotron">
    <div class="alert text-center" role="alert">
      <p>申请成功</p>
    </div>
  </div>

</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var gift_card = new Vue({
    el: '#gift_card',
    data: {
      id: '',
      num: 1,
      beans_total: {{$customer->beans_total}}

  },
    computed: {
      can_buy: function () {
        if ((this.beans_total - this.num * 100000) >= 0) {
          return true;
        } else {
          return false;
        }
      }
    },
    methods: {
      numMinus: function () {
        if (this.num >= 2) {
          this.num--;
        }
      },
      numAdd: function () {
        if (this.num <= 98) {
          this.num++;
        }
      },
      buyCard: function () {
        $.post('/shop/gift-card',{amount:gift_card.num},function (data) {
          if(data) {
            $('.jumbotron p').text(data);
            $('.jumbotron').show();
            $('.jumbotron').delay(3000).hide(0);
            $('.jumbotron .alert').show();
            $('.jumbotron .alert').delay(900).fadeOut(2100);
          }
        });
      }

    }
  })

</script>

</body>
</html>