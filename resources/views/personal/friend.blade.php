<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>糖友推广</title>
    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/member.css">

</head>
<body>

<div class="hd">
    <div class="bd spacing">
        <div class="button_sp_area" style="width: 60%;margin: 0 auto">
            <p style="text-align: left;color: #888">推荐好友扫描二维码,对方注册成为会员后，将向您赠送迈豆积分。</p>
        </div>


        <div class="button_sp_area" style="width: 60%;margin: 0 auto">
            <img src="{{$data['qrCode']}}" width="100%">
        </div>

    </div>
</div>

</body>
</html>