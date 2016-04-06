<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
  <script>
    wx.config({!! $js !!});

    wx.ready(function(){
      alert('ready');
      wx.checkJsApi({
        jsApiList: [
          'checkJsApi',
          'editAddress',
          'chooseWXPay',
          'getLatestAddress',
          'openCard',
          'getLocation'
        ], // 需要检测的JS接口列表，所有JS接口列表见附录2,
        success: function(res) {
          alert('close页面' + history.length);
          a = '{{$original_url}}';
          alert(a);
          if (a) {
            window.location.href = a;
          } else {
            wx.closeWindow();
          }
        },
        fail: function(res) {
          alert('fail');
          alert(res);
        }
      });

    });

  </script>
</head>
<body>
</body>
</html>