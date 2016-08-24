<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>会员信息</title>
    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/member.css">
<body>
<div class="page slideIn cell">
    <div class="hd img_t">
        <img src="{{$data['head_image_url']}}" class="img_tx">
    </div>
    <div class="bd bd_1">
        <div class="weui_cells">
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>账户名</p>
                </div>
                <div class="weui_cell_ft">{{$data['nickname']}}</div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>用户类型</p>
                </div>
                <div class="weui_cell_ft">{{$data['type']}}</div>
            </div>
        </div>

        <div class="weui_cells weui_cells_access">
            <a href="/shop/order" class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>我的订单</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a>
        </div>

        <div class="weui_cells weui_cells_access">
            <a href="/personal/beans" class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>迈豆余额</p>
                </div>
                <div class="weui_cell_ft text_color">{{$data['beans_total']}}&nbsp;迈豆</div>
            </a>
            <a href="/activity/coupon" class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>礼品卡</p>
                </div>
                <div class="weui_cell_ft text_color"><!--{{$data['card_total']}}-->0&nbsp;张</div>
            </a>
        </div>

        <div class="weui_cells weui_cells_access">
            <a href="/personal/bean-rules" class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>迈豆规则</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a>
            <a href="/personal/about-us" class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>关于我们</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a>
        </div>
    </div>
</div>

</body>

</html>





