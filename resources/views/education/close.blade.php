<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <script>
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