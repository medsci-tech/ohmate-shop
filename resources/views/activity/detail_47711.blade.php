<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="{{asset('/css/activity.css')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>联合国糖尿病日线上公益活动</title>
</head>
<body>
<div id="content">
  <div class="logo"></div>
  <div class="text-center active-title">联合国糖尿病日线上公益活动</div>
  <div class="text-center company">
    <h3>主办单位</h3>
    <ul>
      <li>中美健康峰会</li>
    </ul>
    <h3>支持单位</h3>
    <ul>
      <li>世界糖尿病基金会</li>
      <li>北京糖尿病防治协会</li>
      <li>北京协和医学院公共卫生学院</li>
    </ul>
    <h3>承办单位</h3>
    <ul>
      <li>中美健康峰会新闻传媒中心</li>
      <li>易康伴侣（武汉）科技有限责任公司</li>
    </ul>
    <h3 class="red-color">活动时间</h3>
    <ul>
      <li class="red-color">2016年11月14日－2016年11月21日</li>
    </ul>
  </div>
  <div class="product">
    <img src="{{asset('/images/activity/product_3.jpg')}}" width="100%"/>
  </div>
  <div class="remarke">
    注： 所有参与的<font class="red-color">糖友</font>，系统会随机配送四种<font class="red-color">礼品中的两种</font>不能自主选择。
  </div>
  <div class="product">
    <img src="{{asset('/images/activity/product_2.png')}}" width="100%"/>
  </div>
  <div class="submit">
    <a href="{{url('register/reg/'. $id)}}" >
      <img src="{{asset('/images/activity/btn.png')}}" width="100%"/>
    </a>
  </div>
</div>
<div class="bg" id="bg-img">
  <img src="{{asset('/images/activity/bg.jpg')}}" width="100%" height="100%"/>
</div>
</body>
<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
  $(function(){
    var body_height = $('body').height();
    var body_width = $('body').width();
   // console.log(body_height);
    $('#bg-img').height(body_height * 1.14);
  })
</script>
</html>