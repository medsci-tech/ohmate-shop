<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>今日统计</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/count.css">
</head>
<body>
<div class="container" id="enterprise_count">
  <br>
  <div class="panel panel-success">
    <div class="panel-heading"  v-cloak>数据统计</div>
    <ul class="list-group" v-cloak>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics[0].focus_count }}</span>
        关注用户数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics[0].register_count }}</span>
        注册用户数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics[0].doctor_count }}</span>
        注册医生数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics[0].bean_count | currency '' }}</span>
        支出迈豆总数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics[0].income_count | currency '￥' }}</span>
        收入金额
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics[0].article_count }}</span>
        文章阅读量
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics[0].order_count }}</span>
        订单总数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ enterprise_basic_statistics[0].commodity_count }}</span>
        交易商品数量
      </li>
    </ul>
  </div>
  <div class="panel panel-info" v-if=" enterprise_article_statistics.length != 0">
    <div class="panel-heading">学习统计</div>
    <div class="panel-body" v-cloak>
      <div>
        <canvas id="study"></canvas>
      </div>
      <br>
      <div>
        <ul class="list-unstyled data1">
          <li v-for=" article in enterprise_article_statistics"><span>&emsp;&emsp;&emsp;&emsp;</span>
            @{{ article.article_type.type_ch }}：@{{ article.count }}篇
          </li>
        </ul>
      </div>

    </div>

  </div>
  <div class="panel panel-warning" v-if=" enterprise_commodity_statistics.length != 0">
    <div class="panel-heading">消费统计</div>
    <div class="panel-body" v-cloak>
      <div>
        <canvas id="consume"></canvas>
      </div>
      <br>
      <div>
        <ul class="list-unstyled data2">
          <li v-for=" item in enterprise_commodity_statistics"><span>&emsp;&emsp;&emsp;&emsp;</span>
            @{{ item.commodity.name }}：@{{ item.count }}件
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
    data: JSON.parse('{!! json_encode($data) !!}')
  });


  var data1 = [];
  var data2 = [];
  var color_list = ["#F7464A","#46BFBD","#FDB45C","#949FB1","#4D5360"];
  var highlight_list = ["#FF5A5E","#5AD3D1","#FFC870","#A8B3C5","#616774"];

  for ( i = 0 ; i < count.enterprise_article_statistics.length ; i++ ){
    data1.push({
      value: count.enterprise_article_statistics[i].count,
      color: color_list[i%5],
      highlight: highlight_list[i%5],
      label: count.enterprise_article_statistics[i].article_type.type_ch
    });
    $('.data1').children().eq(i).children('span').css("background-color",color_list[i%5]);
  }

  for ( i = 0 ; i < count.enterprise_commodity_statistics.length ; i++ ){
    data2.push({
      value: count.enterprise_commodity_statistics[i].count,
      color: color_list[i%5],
      highlight: highlight_list[i%5],
      label: count.enterprise_commodity_statistics[i].commodity.name
    });
    $('.data2').children().eq(i).children('span').css("background-color",color_list[i%5]);
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