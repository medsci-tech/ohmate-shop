<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>我的订单</title>
  <link rel="stylesheet" href="{{asset('/css/shop.css')}}">
</head>
<body>
<div class="container" id="order_details">

  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">订单信息</div>
      <table v-cloak class="table table-condensed table2">
        <tr>
          <th>订单号</th>
          <td>@{{ wx_out_trade_no }}</td>
        </tr>
        <tr>
          <th>物流编号</th>
          <td>@{{ post_no }}</td>
        </tr>
        <tr>
          <th>下单时间</th>
          <td>@{{ created_at }}</td>
        </tr>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">收货地址</div>
      <table v-cloak class="table table-condensed table2">
        <tr>
          <th>收货人</th>
          <td>@{{ address.name }}</td>
          <td>@{{ address.phone }}</td>
        </tr>
        <tr>
          <th>收货地址</th>
          <td colspan="2">@{{ address.address }}</td>
        </tr>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">消费明细</div>
      <table v-cloak class="table table-condensed table1">
        <tbody>
        <tr v-for=" item in commodities">
          <td>@{{ item.name }}</td>
          <td>x@{{ item.pivot.amount }}</td>
          <td>@{{ item.price*item.pivot.amount | currency '￥' }}</td>
        </tr>
        </tbody>

        <tfoot>
        <tr>
          <td>运费</td>
          <td></td>
          <td>@{{ post_fee | currency '￥' }}</td>
        </tr>
        <tr>
          <td>迈豆折扣</td>
          <td>@{{ beans_payment*100 | currency '￥' }}迈豆</td>
          <td>－@{{ beans_payment | currency '￥' }}</td>
        </tr>
        <tr>
          <td>合计</td>
          <td></td>
          <th>@{{ total_price | currency '￥' }}</th>
        </tr>
        </tfoot>


      </table>
    </div>
  </div>


  <br><br><br><br>

</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script>
  var list = new Vue({
    el: '#order_details',
    data: JSON.stringify('{!! $json !!}')
  });
</script>
</body>
</html>