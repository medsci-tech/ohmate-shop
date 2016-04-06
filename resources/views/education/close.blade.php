<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <script>
    alert(history.length);
    if ( history.length > 2 ){
      history.go(-1);
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