<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>文章详情</title>
    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/bonus.css">
    <script type="text/css">
        body {
            font-family: "Microsoft YaHei", "WenQuanYi Micro Hei", sans-serif; }

        .actionsheet .weui_actionsheet_menu, .actionsheet .weui_actionsheet_action, .actionsheet .weui_actionsheet {
            background-color: transparent; }
        .actionsheet #weui_actionsheet {
            position: absolute;
            top: 3%; }
        .actionsheet .weui_actionsheet_menu {
            text-align: center; }
        .actionsheet .weui_actionsheet_menu img {
            width: 90%; }
        .actionsheet .weui_actionsheet_menu p {
            position: absolute;
            top: 0px;
            margin-top: 60%;
            width: 70%;
            left: 15%;
            font-size: 50px;
            font-weight: bold;
            color: #ffe034; }
        .actionsheet .weui_actionsheet_action p {
            position: absolute;
            margin-top: -120px;
            width: 70%;
            left: 15%;
            text-align: center;
            color: #ffe034; }
        .actionsheet .weui_actionsheet_action #gethongbao {
            position: absolute;
            margin-top: -80px;
            width: 70%;
            left: 15%;
            background-color: #ffe034;
            color: #df3121;
            font-weight: bold; }
    </script>
</head>
<body>
<div>
    <p>文章详情</p>
</div>
<!--BEGIN actionSheet-->
<div id="actionSheet_wrap">
    <div class="weui_mask_transition" id="mask" style="display: none;"></div>
    <div class="weui_actionsheet" id="weui_actionsheet">
        <div class="weui_actionsheet_menu">
            <img src="/image/education/hongbao.png" alt="">

            <p>10迈豆</p>
        </div>
        <div class="weui_actionsheet_action">
            <p>(每日学习迈豆奖励)</p>
            <a class="weui_btn weui_btn_default" id="gethongbao">确认领取</a>
        </div>
    </div>
</div>
<!--END actionSheet-->

<script src="../../js/vendor/jquery-2.1.4.min.js"></script>
<script>

    function setTimer(i){
        i +=1;
        timer();
        function timer() {
            i--;
            if (i == 0) {
                clearTimeout(timer);
                $('#mask').addClass('weui_fade_toggle');
                $('#mask').css('display','block')
                $('#weui_actionsheet').addClass('weui_actionsheet_toggle');
            } else {
                setTimeout(timer, 1000);
            }
        }
    }


    setTimer(10);
</script>
</body>
</html>