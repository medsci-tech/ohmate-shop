<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>文章详情</title>
    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/hongbao.css">
</head>
<body>
<div>
    <img src="/image/education/1.png" style="width: auto; height: auto">
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

    function settimer(i){
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


    settimer(10);
</script>
</body>
</html>