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
        <span class="badge">{{ customerStatistics.friend_count }}</span>
        好友数
      </li>
      <li class="list-group-item">
        <span class="badge">{{ customerStatistics.artcle_count }}</span>
        阅读文章数
      </li>
      <li class="list-group-item">
        <span class="badge">{{ customerStatistics.order_count }}</span>
        交易订单数
      </li>
      <li class="list-group-item">
        <span class="badge">{{ customerStatistics.commodity_count }}</span>
        购买商品数
      </li>
      <li class="list-group-item">
        <span class="badge">{{ customerStatistics.money_count }}</span>
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
          <li v-for=" article in customerArticleStatistics"><span>&emsp;&emsp;&emsp;&emsp;</span>
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
          <li v-for=" item in customerCommodityStatistics"><span>&emsp;&emsp;&emsp;&emsp;</span>
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
<script src="/js/personal_count.js"></script>


</body>
</html>