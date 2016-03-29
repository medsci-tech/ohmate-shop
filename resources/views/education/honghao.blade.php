<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>gongbao</title>
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
        <p>50迈豆</p>
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
</body>
</html>