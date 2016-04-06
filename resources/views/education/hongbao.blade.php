<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>迈豆红包</title>
  <link rel="stylesheet" href="{{asset('/css/weui.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/hongbao.css')}}">
</head>
<body>
<div class="actionsheet" style="overflow: hidden">
  <!--BEGIN actionSheet-->
  <div id="actionSheet_wrap">
    <div class="weui_mask_transition" id="mask" style="display: none;"></div>
    <div class="weui_actionsheet" id="weui_actionsheet">
      <div class="weui_actionsheet_menu">
        <img src="{{url('/image/education/hongbao.png')}}" alt="">
        <p>20迈豆</p>
        <p id="chance"></p>
        <p id="motto"></p>
      </div>
      <div class="weui_actionsheet_action">
        <a href="{{url('/shop/index')}}" class="weui_btn weui_btn_default" id="getedu">立刻使用</a>
        <a href="{{$redirect_url}}" class="weui_btn weui_btn_default" id="getshop">继续学习</a>
      </div>
    </div>
  </div>
  <!--END actionSheet-->
</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script>

  function settimer(i){
    i +=1;
    timer();
    function timer() {
      i--;
      $('#showActionSheet').text(i + '秒后弹出');
      $('#showActionSheet').attr("disabled","disabled");
      if (i == 0) {
        clearTimeout(timer);
        $('#showActionSheet').removeAttr("disabled");
        $('#showActionSheet').text('重新计时');
        $('#mask').addClass('weui_fade_toggle');
        $('#mask').css('display','block')
        $('#weui_actionsheet').addClass('weui_actionsheet_toggle');
      } else {
        setTimeout(timer, 1000);
      }
    }
  }

  function action(){
    $('#mask').addClass('weui_fade_toggle');
    $('#mask').css('display','block')
    $('#weui_actionsheet').addClass('weui_actionsheet_toggle');
  }

  $('#showActionSheet').click(function () {
    settimer(10);
  });

  $('#show').click(function(){
    action();
  });

  $('#gethongbao').click(function(){
    $('#mask').removeClass('weui_fade_toggle');
    $('#mask').css('display','none')
    $('#weui_actionsheet').removeClass('weui_actionsheet_toggle');
  });


  settimer(0);
</script>
<script>
  $(document).ready(function () {
    var chances = ['今日还可获取4次','今日还可获取3次','今日还可获取2次','今日还可获取1次','今日已获取完毕,明天再来哦~'];
    var mottos = ['人生在勤，不索何获','书山有路勤为径，学海无涯苦作舟','含泪播种的人一定能含笑收获','行动是成功的阶梯，行动越多，登得越高','今晚多几分钟的准备，明天少几小时的麻烦','拿望远镜看别人，拿放大镜看自己','信心、恒心、决心；创意、乐意','没有天生的信心，只有不断培养的信心','生命对某些人来说是美丽的，这些人的一生都为某个目标而奋斗','做对的事情比把事情做对重要','与其临渊羡鱼，不如退而结网','积极思考造成积极人生，消极思考造成消极人生','以诚感人者，人亦诚而应','先知三日，富贵十年','环境不会改变，解决之道在于改变自己','每一发奋努力的背后，必有加倍的赏赐','不是境况造就人，而是人造就境况','靠山山会倒，靠水水会流，靠自己永远不倒','自古成功在尝试','当一个人先从自己的内心开始奋斗，他就是个有价值的人','生命对某些人来说是美丽的，这些人的一生都为某个目标而奋斗'];

    var i = {{$count - 1}};
    var j =Math.floor(Math.random()*mottos.length);

    $('#chance').text(chances[i]);
    $('#motto').text(mottos[j]);
  });
  if(history.length == 2) {
    WeixinJSBridge.invoke('closeWindow',{},function(res){

      //alert(res.err_msg);

    });
  };
</script>
</body>
</html>