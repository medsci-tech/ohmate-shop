<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>个人统计</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/count.css">
</head>
<body>
<div class="container" id="costomer_count">
  <br>
  <div class="panel panel-success">
    <div class="panel-heading">基本统计</div>
    <ul class="list-group">
      <li class="list-group-item">
        <span class="badge">@{{ customer_statistics.friend_count }}</span>
        好友数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ customer_statistics.artcle_count }}</span>
        阅读文章数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ customer_statistics.order_count }}</span>
        交易订单数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ customer_statistics.commodity_count }}</span>
        购买商品数
      </li>
      <li class="list-group-item">
        <span class="badge">@{{ customer_statistics.money_count }}</span>
        总消费金额
      </li>
    </ul>
  </div>
  <div class="panel panel-info">
    <div class="panel-heading">学习统计</div>
    <div class="panel-body">
      <div>
        <canvas id="study"></canvas>
      </div>
      <br>
      <div>
        <ul class="list-unstyled data1">
          <li v-for=" article in customer_article_statistics"><span>&emsp;&emsp;&emsp;&emsp;</span>
            文章id:@{{ article.article_type_id }}
          </li>
        </ul>
      </div>

    </div>

  </div>
  <div class="panel panel-warning">
    <div class="panel-heading">消费统计</div>
    <div class="panel-body">
      <div>
        <canvas id="consume"></canvas>
      </div>
      <br>
      <div>
        <ul class="list-unstyled data2">
          <li v-for=" item in customer_commodity_statistics"><span>&emsp;&emsp;&emsp;&emsp;</span>
            商品id:@{{ item.commodity_id }}
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
    el: '#costomer_count',
    data: JSON.parse('{!! json_encode($data) !!}')
  });


  var data1 = [];
  var data2 = [];
  var color_list = ["#F7464A","#46BFBD","#FDB45C","#949FB1","#4D5360"];
  var highlight_list = ["#FF5A5E","#5AD3D1","#FFC870","#A8B3C5","#616774"];

  for ( i = 1 ; i < count.customer_article_statistics.length ; i++ ){
    data1.push({
      value: count.customer_article_statistics[i].count,
      color: color_list[i%5],
      highlight: highlight_list[i%5],
      label: count.customer_article_statistics[i].article_type_id
    });
    $('.data1').find('li:eq(i) span').css("background-color",color_list[i%5]);
  }

  for ( i = 1 ; i < count.customer_commodity_statistics.length ; i++ ){
    data2.push({
      value: count.customer_commodity_statistics[i].count,
      color: color_list[i%5],
      highlight: highlight_list[i%5],
      label: count.customer_commodity_statistics[i].commodity_id
    });
    $('.data1').find('li:eq('+i+') span').css("background-color",color_list[i%5]);
  }

  Chart.defaults.global.responsive = true;
  var ctx = document.getElementById("study").getContext("2d");
  var myStudy = new Chart(ctx).Pie(data1);
  var ct2 = document.getElementById("consume").getContext("2d");
  var myConsume = new Chart(ct2).Pie(data2);


</script>


</body>
</html>