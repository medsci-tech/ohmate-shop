<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>糖友推广</title>
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/personal.css" rel="stylesheet">
</head>
<body>
<div class="bianju">
    <div class="tx">
        <img src="{{$data['head_image_url']}}" class="img-rounded" style="width: 80px;height: 80px">
    </div>
    <div class="bianju">
        <p>{{$data['nickname']}}</p>
    </div>
    <h3><small>请扫描下面的二维码，请扫描下面的二维码请扫描下面的二维码请扫描下面的二维码请</small></h3>
    <div><img src="{{$data['qrCode']}}" class="img-responsive" style="width: 100%"></div>
</div>
</body>
</html>