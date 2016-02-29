<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>注册成功</title>
    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/member.css">
<body>
<div class="weui_msg">
    <div class="weui_icon_area">
        <i class="weui_icon_success weui_icon_msg"></i>
    </div>
    <div class="weui_text_area">
        <h2 class="weui_msg_title">注册成功</h2>
        <p class="weui_msg_desc">说点什么吧，说点什么吧！</p>
    </div>
    <div class="weui_opr_area">
        <p class="weui_btn_area">
            <input type="button" class="weui_btn weui_btn_primary" id="closeWindow">确定</input>
        </p>
    </div>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $js->config(array('checkJsApi','closeWindow'), false, false) ?>);


    wx.ready(function () {

        wx.checkJsApi({
            jsApiList: [
                'closeWindow'
            ],
            success: function (res) {
//                alert(JSON.stringify(res));
            }
        });

        document.querySelector('#closeWindow').onclick = function () {
            wx.closeWindow();
        };

    });

    wx.error(function (res) {
        alert("error:" + res.errMsg);
    });
</script>
</body>
</html>