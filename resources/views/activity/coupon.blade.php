<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>礼品卡</title>
  <link rel="stylesheet" href="{{asset('/css/shop_rebuild.css')}}">
</head>

<body>
<div style="height: 40px;width: 90%;margin: 12px auto 0 auto;background-color: #f00;border-radius: 5px;">
	<a href="http://www.ohmate.cn/shop/index" style="font-size: 18px;color: #fff;line-height: 40px;margin: 0 auto;display: block;width: 50%;text-align: center;" >前往兑换礼品卡</a>
</div>
<div class="container" id="gift_card">
  <br>

  <div v-if="cards == ''" class="text-center"><h3>暂无礼品卡！</h3></div>
  <div v-if="cards != ''" v-cloak class="panel" :class=" card.marked ? 'panel-default' : 'panel-primary'" v-for="card in cards | orderBy 'marked'">
    <div class="panel-heading text-center">
      @{{ card.name }}
      <span class="checkbox" style="display: inline-block; margin: 0; float: right;">
        <label>
          <input type="checkbox" v-model="card.marked">
        </label>
      </span>
    </div>
    <table class="table">
      <tr>
        <th>卡号</th>
        <td>@{{ card.no }}</td>
      </tr>
      <tr>
        <th>密码</th>
        <td>@{{ card.password }}</td>
      </tr>
    </table>
  </div>
</div>
</body>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script>
  var gift_card = new Vue({
    el: '#gift_card',
    data: {
      cards: {!! $result !!}
    },
    methods: ''
  })
</script>
</html>