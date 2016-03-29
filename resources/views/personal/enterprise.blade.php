<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>数据统计</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/count.css">
</head>
<body>
<div class="container" id="enterprise_count">
  <br>
  <div class="panel panel-success">
    <div @click="hack" class="panel-heading"  v-cloak>数据统计</div>
    <ul class="list-group" v-cloak>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics.focus_count }}</span>
        关注用户数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics.register_count }}</span>
        注册用户数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics.doctor_count }}</span>
        注册医生数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics.bean_payment_sum | currency '' }}</span>
        已使用迈豆总数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics.cash_payment_sum | currency '￥' }}</span>
        收入金额
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics.order_count }}</span>
        订单总数
      </li>
    </ul>
  </div>
  <div class="panel panel-info" v-show=" enterprise_article_statistics.length != 0">
    <div class="panel-heading">学习统计</div>
    <div class="panel-body" v-cloak>
      <div>
        <canvas id="study"></canvas>
      </div>
      <br>
      <div>
        <ul class="list-unstyled data1">
          <li v-for=" article in enterprise_article_statistics"><span>&emsp;&emsp;&emsp;&emsp;</span>
            @{{ article.article_type.type_ch }}：阅读@{{ article.count }}次
          </li>
        </ul>
      </div>

    </div>

  </div>
  <div class="panel panel-warning" v-show=" enterprise_commodity_statistics.length != 0">
    <div class="panel-heading">消费统计</div>
    <div class="panel-body" v-cloak>
      <div>
        <canvas id="consume"></canvas>
      </div>
      <br>
      <div>
        <ul class="list-unstyled data2">
          <li v-for=" item in enterprise_commodity_statistics"><span>&emsp;&emsp;&emsp;&emsp;</span>
            @{{ item.name }}：@{{ item.count }}件
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script src="/js/vendor/jquery-2.1.4.min.js"></script>
<script src="/js/vendor/Chart.min.js"></script>
<script src="/js/vendor/vue.js"></script>
<script>
  var count = new Vue({
    el: '#enterprise_count',
    data: JSON.parse('{!! json_encode($data) !!}'),
    methods: {
      hack: function () {
        $.post('/hack/clear-user', {}, function (res) {
          if (res.success) {
            alert('清除成功!');
            location.reload(true);
          }
        });
      }
    }
  });


  var data1 = [];
  var data2 = [];
  var color_list = ["#A6CEE3", "#1F78B4", "#B2DF8A", "#33A02C", "#FB9A99", "#E31A1C", "#FDBF6F", "#FF7F00", "#CAB2D6", "#6A3D9A", "#B4B482", "#B15928"];
  var highlight_list = ["#CEF6FF", "#47A0DC", "#DAFFB2", "#5BC854", "#FFC2C1", "#FF4244", "#FFE797", "#FFA728", "#F2DAFE", "#9265C2", "#DCDCAA", "#D98150"];

  for ( i = 0 ; i < count.enterprise_article_statistics.length ; i++ ){
    data1.push({
      value: count.enterprise_article_statistics[i].count,
      color: color_list[i%12],
      highlight: highlight_list[i%12],
      label: count.enterprise_article_statistics[i].article_type.type_ch
    });
    $('.data1').children().eq(i).children('span').css("background-color",color_list[i%12]);
  }

  for ( i = 0 ; i < count.enterprise_commodity_statistics.length ; i++ ){
    data2.push({
      value: count.enterprise_commodity_statistics[i].count,
      color: color_list[i%12],
      highlight: highlight_list[i%12],
      label: count.enterprise_commodity_statistics[i].name
    });
    $('.data2').children().eq(i).children('span').css("background-color",color_list[i%12]);
  }

  if (data1.length == 1) {
    data1.push({
      value: .00001,
      color: "#fff"
    });
  }

  if (data2.length == 1) {
    data2.push({
      value: .00001,
      color: "#fff"
    });
  }

  Chart.defaults.global.responsive = true;
  var ctx = document.getElementById("study").getContext("2d");
  var myStudy = new Chart(ctx).Pie(data1);
  var ct2 = document.getElementById("consume").getContext("2d");
  var myConsume = new Chart(ct2).Pie(data2);


</script>


</body>
</html>