<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>今天，你必须要为母亲做7件事</title>
  <link rel="stylesheet" href="{{asset('/css/swiper-3.3.0.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
  <style>
    .swiper-container {
      position: absolute;
      width: 100%;
      height: 100%;
      background-image: url('{{url('/image/activities/mothersday/background.png')}}');
      background-repeat: no-repeat;
    }

    .img-responsive {
      width: 100%;
      height: 100%;
    }

    .modal-backdrop.in {
      filter: alpha(opacity=80);
      opacity: .8;
    }

    .fade {
      -webkit-transition: opacity .3s linear;
      -o-transition: opacity .3s linear;
      transition: opacity .3s linear;
    }
  </style>
</head>
<body>
<div class="hide">
  <img src="{{url('/image/activities/mothersday/favicon.jpg')}}" alt="">
</div>
<div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/0.png')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/1.png')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/2.png')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/3.png')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/4.png')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/5.png')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/6.png')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/7.png')}}">
    </div>
    <div class="swiper-slide">
      <img class="img-responsive" src="{{url('/image/activities/mothersday/8.png')}}">
    </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <a role="button">
    <img class="img-responsive" src="{{url('/image/activities/mothersday/9.png')}}">
  </a>
</div>


<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/swiper-3.3.0.min.js')}}"></script>
<script src="{{asset('/js/vendor/bootstrap.min.js')}}"></script>

<script>
  var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    slidesPerView: 1,
    paginationClickable: true,
    visiblilityFullfit: true,
    prevButton: '.swiper-button-prev',
    nextButton: '.swiper-button-next',
    speed: 500,
    effect: 'fade',
    fade: {
      crossFade: true
    },
    onReachEnd: function (swiper) {
      setTimeout("$('#myModal').modal('show')", 500);
    }
  });

  $('#myModal').click(function () {
    $('#myModal').modal('hide');
  });

</script>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script>
  wx.config({!! $js !!});

  wx.ready(function(){
    wx.checkJsApi({
      jsApiList: [
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone'
      ], // 需要检测的JS接口列表，所有JS接口列表见附录2,
      success: function(res) {
        wx.onMenuShareTimeline({
          title: '今天，你必须要为母亲做7件事', // 分享标题
          link: '{{url('/activities/mothersday')}}', // 分享链接
          imgUrl: '{{url('/image/activities/mothersday/favicon.jpg')}}', // 分享图标
          success: function () {
            // 用户确认分享后执行的回调函数
          },
          cancel: function () {
            // 用户取消分享后执行的回调函数
          }
        });
        wx.onMenuShareAppMessage({
          title: '今天，你必须要为母亲做7件事', // 分享标题
          desc: '在那刻之后我们开始享受着母爱给我们带来的幸福', // 分享描述
          link: '{{url('/activities/mothersday')}}', // 分享链接
          imgUrl: '{{url('/image/activities/mothersday/favicon.jpg')}}', // 分享图标
          type: '', // 分享类型,music、video或link，不填默认为link
          dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
          success: function () {
            // 用户确认分享后执行的回调函数
          },
          cancel: function () {
            // 用户取消分享后执行的回调函数
          }
        });
        wx.onMenuShareQQ({
          title: '今天，你必须要为母亲做7件事', // 分享标题
          desc: '在那刻之后我们开始享受着母爱给我们带来的幸福', // 分享描述
          link: '{{url('/activities/mothersday')}}', // 分享链接
          imgUrl: '{{url('/image/activities/mothersday/favicon.jpg')}}', // 分享图标
          success: function () {
            // 用户确认分享后执行的回调函数
          },
          cancel: function () {
            // 用户取消分享后执行的回调函数
          }
        });
        wx.onMenuShareWeibo({
          title: '今天，你必须要为母亲做7件事', // 分享标题
          desc: '在那刻之后我们开始享受着母爱给我们带来的幸福', // 分享描述
          link: '{{url('/activities/mothersday')}}', // 分享链接
          imgUrl: '{{url('/image/activities/mothersday/favicon.jpg')}}', // 分享图标
          success: function () {
            // 用户确认分享后执行的回调函数
          },
          cancel: function () {
            // 用户取消分享后执行的回调函数
          }
        });
        wx.onMenuShareQZone({
          title: '今天，你必须要为母亲做7件事', // 分享标题
          desc: '在那刻之后我们开始享受着母爱给我们带来的幸福', // 分享描述
          link: '{{url('/activities/mothersday')}}', // 分享链接
          imgUrl: '{{url('/image/activities/mothersday/favicon.jpg')}}', // 分享图标
          success: function () {
            // 用户确认分享后执行的回调函数
          },
          cancel: function () {
            // 用户取消分享后执行的回调函数
          }
        });
      },
      fail: function(res) {
      }
    });

  });

</script>
</body>
</html>