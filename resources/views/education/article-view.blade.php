<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>文章详情</title>
    <link rel="stylesheet" href="/css/weui.css">
    <link rel="stylesheet" href="/css/article.css">
    <link rel="stylesheet" href="/css/bonus.css">
</head>
<body>
<div class="weui_panel_bd">
    <div class="weui_media_box weui_media_text">
        <h4 class="weui_media_title">{{$article->id}}</h4>
        <p class="weui_media_desc">时间：{{$article->updated_at->year}}年{{$article->updated_at->month}}月{{$article->updated_at->day}}日</p>
        <img src="/image/education/xq_1.jpg" width="100%">
        <img src="/image/education/xq_2.png" width="100%">
    </div>
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
            <input type="button" class="weui_btn weui_btn_default" id="gethongbao" value="确认领取">
        </div>
    </div>
</div>
<!--END actionSheet-->
<input id="text_id" type="hidden" value="{{$article->id}}">

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

                $(function () {
                    var requestUrls = '/education/article/update-bean';
                    var id = $('#text_id').val();
                    $.ajax({
                        url: requestUrls,
                        data: {
                            id: id
                        },
                        type: "get",
                        dataType: "json",
                        success: function (json) {

                        },
                        error: function (xhr, status, errorThrown) {
                            alert("Sorry, there was a problem!");
                        }
                    });

                });

            } else {
                setTimeout(timer, 1000);
            }
        }
    }


    setTimer(10);
</script>
</body>
</html>