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
        <h4 class="weui_media_title">{{$article->title}}</h4>
        <p class="weui_media_desc">时间：{{$article->updated_at->year}}年{{$article->updated_at->month}}月{{$article->updated_at->day}}日</p>
        <div class="xq_line"></div>
        <img src="{{$article->thumbnail}}" width="100%">
        {{--<img src="/image/education/xq_2.png" width="100%">--}}
    </div>
</div>
<!--BEGIN actionSheet-->
{{--<div id="actionSheet_wrap">--}}
    {{--<div class="weui_mask_transition" id="mask" style="display: none;"></div>--}}
    {{--<div class="weui_actionsheet" style="display: none;" id="weui_actionsheet">--}}
        {{--<div class="weui_actionsheet_menu">--}}
            {{--<img src="/image/education/hongbao.png" alt="">--}}

            {{--<p>10迈豆</p>--}}
        {{--</div>--}}
        {{--<div class="weui_actionsheet_action">--}}
            {{--<p>(每日学习迈豆奖励)</p>--}}
            {{--<input type="button" class="weui_btn weui_btn_default" id="gethongbao" value="确认领取" onclick="">--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<!--END actionSheet-->
<input id="text_id" type="hidden" value="{{$article->id}}">

<script src="../../js/vendor/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
    var request = function (paras) {
        var url = location.href;
        var paraString = url.substring(url.indexOf("?") + 1, url.length).split("&");
        var paraObj = {}
        for (i = 0; j = paraString[i]; i++) {
            paraObj[j.substring(0, j.indexOf("=")).
                    toLowerCase()] = j
                    .substring(j.indexOf("=") + 1, j.length);

        }
        var returnValue = paraObj[paras.toLowerCase()];
        if (typeof(returnValue) == "undefined") {
            return "";
        } else {
            return returnValue;
        }
    }
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">

    wx.config(<?php echo $js->config(array('checkJsApi','onMenuShareAppMessage'), false, false) ?>);

    wx.ready(function () {

        wx.checkJsApi({
            jsApiList: [
                'onMenuShareAppMessage'
            ],
            success: function (res) {
//                alert(JSON.stringify(res));
            }
        });

        var id = request("id");
        wx.onMenuShareAppMessage({
            title: '{{$article->title}}', // 分享标题
            desc: '{{$article->description}}', // 分享描述
            link: 'http://test.ohmate.com.cn/education/article/view?type=2&id='+id, // 分享链接
            imgUrl: 'http://test.ohmate.com.cn/image/education/titlle-1.png', // 分享图标
            type: 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
//                    alert('已分享');
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
//                    alert('已取消');
            }
        });

    });

    wx.error(function (res) {
        alert("error:" + res.errMsg);
    });

    //    function setTimer(i){
    //        var type = request("type");
    //        if (type == '2')
    //            return;
    //        i +=1;
    //        timer();
    //        function timer() {
    //            i--;
    //            if (i == 0) {
    //                clearTimeout(timer);
    //                $('#mask').addClass('weui_fade_toggle');
    //                $('#mask').css('display','block');
    //                $('#weui_actionsheet').addClass('weui_actionsheet_toggle');
    //                $('#weui_actionsheet').css('display','block');
    //
    //                $(function () {
    //                    var requestUrls = '/education/article/update-bean';
    //                    var id = $('#text_id').val();
    //                    $.ajax({
    //                        url: requestUrls,
    //                        data: {
    //                            id: id
    //                        },
    //                        type: "get",
    //                        dataType: "json",
    //                        success: function (json) {
    //
    //                        },
    //                        error: function (xhr, status, errorThrown) {
    //                            alert("Sorry, there was a problem!");
    //                        }
    //                    });
    //
    //                });
    //
    //            } else {
    //                setTimeout(timer, 1000);
    //            }
    //        }
    //    }


    //    $(document).ready(function() {
    //        $('#gethongbao').click(function () {
    //            $('#mask').removeClass('weui_fade_toggle');
    //            $('#mask').css('display', 'none');
    //            $('#weui_actionsheet').removeClass('weui_actionsheet_toggle');
    //            $('#weui_actionsheet').css('display','block');
    //        });
    //    });

    //    setTimer(10);
</script>
</body>
</html>