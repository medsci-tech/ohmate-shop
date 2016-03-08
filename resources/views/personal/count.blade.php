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
<div class="container">
  <br>
  <div class="panel panel-success">
    <div class="panel-heading">基本统计</div>
    <ul class="list-group">
      <li class="list-group-item">
        <span class="badge">99</span>
        好友数
      </li>
      <li class="list-group-item">
        <span class="badge">99</span>
        阅读文章数
      </li>
      <li class="list-group-item">
        <span class="badge">99</span>
        交易订单数
      </li>
      <li class="list-group-item">
        <span class="badge">99</span>
        购买商品数
      </li>
      <li class="list-group-item">
        <span class="badge">99</span>
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
        <ul class="list-unstyled">
          <li><span style="background-color: #F7464A;">&emsp;&emsp;&emsp;&emsp;</span>
            糖友科普
          </li>
          <li><span style="background-color: #46BFBD;">&emsp;&emsp;&emsp;&emsp;</span>
            药物治疗
          </li>
          <li><span style="background-color: #FDB45C;">&emsp;&emsp;&emsp;&emsp;</span>
            营养膳食
          </li>
          <li><span style="background-color: #949FB1;">&emsp;&emsp;&emsp;&emsp;</span>
            合理运动
          </li>
          <li><span style="background-color: #4D5360;">&emsp;&emsp;&emsp;&emsp;</span>
            血糖监测
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
        <ul class="list-unstyled">
          <li><span style="background-color: #F7464A;">&emsp;&emsp;&emsp;&emsp;</span>
            糖友科普
          </li>
          <li><span style="background-color: #46BFBD;">&emsp;&emsp;&emsp;&emsp;</span>
            药物治疗
          </li>
          <li><span style="background-color: #FDB45C;">&emsp;&emsp;&emsp;&emsp;</span>
            营养膳食
          </li>
          <li><span style="background-color: #949FB1;">&emsp;&emsp;&emsp;&emsp;</span>
            合理运动
          </li>
          <li><span style="background-color: #4D5360;">&emsp;&emsp;&emsp;&emsp;</span>
            血糖监测
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script src="/js/vendor/Chart.min.js"></script>
<script src="/js/personal_count.js"></script>
</body>
</html>