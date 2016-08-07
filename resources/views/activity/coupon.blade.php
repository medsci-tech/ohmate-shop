<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>礼品卡</title>
  <link rel="stylesheet" href="{{asset('/css/shop_rebuild.css')}}">
</head>

<body>
<div class="container" id="gift_card">
  <br>

  <div class="panel" :class=" card.marked ? 'panel-default' : 'panel-primary'" v-for="card in cards | orderBy 'marked'">
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
      cards:[{
        name: '1000元京东购物卡'
        no: '1236666',
        password: '98498651651',
        marked: 0
      },]
    },
    methods: ''
  })
</script>
</html>