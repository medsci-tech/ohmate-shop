<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>会员信息</title>
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/personal.css" rel="stylesheet">
</head>
<body>
<div>
    <div class="head">
        <div class="head-img">
            <img src="{{$data['head_image_url']}}}">
        </div>
        <div class="head-dsb">
            <p class="dsb-name">{{$data['nickname']}}</p>
            <p class="dsb-id">{{$data['type']}}</p>
        </div>
    </div>
    <div class="qianbao">
        <div class="qianbao_p qianbao_p_1">
            <p class="maidou_t">迈豆余额</p><br><p class="maidou">{{$data['beans_total']}}迈豆</p>
        </div>
        <div class="text-center qianbao_p_1">
            <p class="maidou_t">礼品卡</p><br><p class="maidou">5张</p>
        </div>
    </div>
    <div style="margin-top: 20px">
        <div class="mt-1">
            <div class="ps-lt">
                <div class="lt-dsb">
                    <p>会员介绍</p>
                    <i class="jt"></i>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb cl-bb">
                    <p>迈豆规则</p>
                    <i class="jt"></i>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 20px">
        <div class="mt-1">
            <div class="ps-lt">
                <div class="lt-dsb">
                    <p>关于我们</p>
                    <i class="jt"></i>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb cl-bb">
                    <p>联系客服</p>
                    <i class="jt"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>