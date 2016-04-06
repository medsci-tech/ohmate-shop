<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <script>
    alert('close页面'+history.length);
    if ({{$original_url}}){
      window.location.href="{{$original_url}}";
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