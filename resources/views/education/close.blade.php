<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <script>
    if (typeof WeixinJSBridge == "undefined"){
      if( document.addEventListener ){
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
      }else if (document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
      }
    }else{
      onBridgeReady();
    }
    alert('close页面'+history.length);
    a = '{{$original_url}}';
    alert(a);
    if (a){
      window.location.href=a;
    } else {
      WeixinJSBridge.invoke('closeWindow',{},function(res){
        //alert(res.err_msg);
      });
    }
  </script>
</head>
<body>
</body>
</html>