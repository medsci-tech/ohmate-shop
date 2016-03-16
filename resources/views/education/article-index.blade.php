<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>教育学习</title>
    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/member.css">
<body onload="reLoad();">
<div class="weui_tab">
    <div class="weui_navbar">
        <div id="tab_1" class="weui_navbar_item tab_bg tab_font-size">
            <img src="/image/education/index/1.png" alt=""><br>
            糖友科普
        </div>
        <div id="tab_2" class="weui_navbar_item tab_font-size">
            <img src="/image/education/index/2.png" alt=""><br>
            药物治疗
        </div>
        <div id="tab_3" class="weui_navbar_item tab_font-size">
            <img src="/image/education/index/3.png" alt=""><br>
            膳食营养
        </div>
        <div id="tab_4" class="weui_navbar_item tab_font-size">
            <img src="/image/education/index/4.png" alt=""><br>
            合理运动
        </div>
    </div>
    <div class="weui_navbar" style="margin-top: 85px">
        <div id="tab_5" class="weui_navbar_item tab_font-size">
            <img src="/image/education/index/5.png" alt=""><br>
            血糖监测
        </div>
        <div id="tab_2" class="weui_navbar_item tab_font-size">
            <img src="/image/education/index/99.png" alt=""><br>
            积分兑换
        </div>
        <div id="tab_3" class="weui_navbar_item tab_font-size">

        </div>
        <div id="tab_4" class="weui_navbar_item tab_font-size">

        </div>
    </div>
    <div id="view_1" class="tab_bd">
        <div id="detail_1" class="weui_panel_bd tab_top">
            {{--@foreach($articles as $index)--}}
            {{--<a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">--}}
                {{--<div class="weui_media_hd">--}}
                    {{--<img class="weui_media_appmsg_thumb" src="/image/education/article_knowledge.png" alt="">--}}
                {{--</div>--}}
                {{--<div class="weui_media_bd">--}}
                    {{--<h4 class="weui_media_title">1{{$index['title']}}</h4>--}}
                    {{--<p class="weui_media_desc">{{$index['description']}}</p>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--@endforeach--}}
        </div>
    </div>
    <div id="view_2" class="tab_bd">
        <div id="detail_2" class="weui_panel_bd tab_top">
            {{--@foreach($articles as $index)--}}
                {{--<a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">--}}
                    {{--<div class="weui_media_hd">--}}
                        {{--<img class="weui_media_appmsg_thumb" src="/image/education/article_drug.png" alt="">--}}
                    {{--</div>--}}
                    {{--<div class="weui_media_bd">--}}
                        {{--<h4 class="weui_media_title">2{{$index['title']}}</h4>--}}
                        {{--<p class="weui_media_desc">{{$index['description']}}</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--@endforeach--}}
        </div>
    </div>
    <div id="view_3" class="tab_bd">
        <div id="detail_3" class="weui_panel_bd tab_top">
            {{--@foreach($articles as $index)--}}
                {{--<a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">--}}
                    {{--<div class="weui_media_hd">--}}
                        {{--<img class="weui_media_appmsg_thumb" src="/image/education/article_food.png" alt="">--}}
                    {{--</div>--}}
                    {{--<div class="weui_media_bd">--}}
                        {{--<h4 class="weui_media_title">3{{$index['title']}}</h4>--}}
                        {{--<p class="weui_media_desc">{{$index['description']}}</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--@endforeach--}}
        </div>
    </div>
    <div id="view_4" class="tab_bd">
        <div id="detail_4" class="weui_panel_bd tab_top">
            {{--@foreach($articles as $index)--}}
                {{--<a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">--}}
                    {{--<div class="weui_media_hd">--}}
                        {{--<img class="weui_media_appmsg_thumb" src="/image/education/article_sport.png" alt="">--}}
                    {{--</div>--}}
                    {{--<div class="weui_media_bd">--}}
                        {{--<h4 class="weui_media_title">4{{$index['title']}}</h4>--}}
                        {{--<p class="weui_media_desc">{{$index['description']}}</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--@endforeach--}}
        </div>
    </div>
    <div id="view_5" class="tab_bd">
        <div id="detail_5" class="weui_panel_bd tab_top">
            {{--@foreach($articles as $index)--}}
                {{--<a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">--}}
                    {{--<div class="weui_media_hd">--}}
                        {{--<img class="weui_media_appmsg_thumb" src="/image/education/article_glycemia.png" alt="">--}}
                    {{--</div>--}}
                    {{--<div class="weui_media_bd">--}}
                        {{--<h4 class="weui_media_title">5{{$index['title']}}</h4>--}}
                        {{--<p class="weui_media_desc">{{$index['description']}}</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--@endforeach--}}
        </div>
    </div>
</div>

<input type="hidden" id="text_click" value="-1">
<input type="hidden" id="text_id" value="-1">
<input type="hidden" id="text_view" value="1">
<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#view_2").hide();
        $("#view_3").hide();
        $("#view_4").hide();
        $("#view_5").hide();

        changeArticleType('1','detail_1');
        
        $("#tab_1").on('click', function () {
            var view = $("#text_view").val();
            if (view == '2') {
                $("#tab_2").removeClass("tab_bg");
                $("#tab_2").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_1").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_1").show();
                $("#view_2").hide();
            }

            if (view == '3') {
                $("#tab_3").removeClass("tab_bg");
                $("#tab_3").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_1").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_1").show();
                $("#view_3").hide();
            }

            if (view == '4') {
                $("#tab_4").removeClass("tab_bg");
                $("#tab_4").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_1").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_1").show();
                $("#view_4").hide();
            }

            if (view == '5') {
                $("#tab_5").removeClass("tab_bg");
                $("#tab_5").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_1").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_1").show();
                $("#view_5").hide();
            }

            $("#text_view").val('1');
            changeArticleType('1','detail_1');
        });

        $("#tab_2").on('click', function () {
            var view = $("#text_view").val();
            if (view == '1') {
                $("#tab_1").removeClass("tab_bg");
                $("#tab_1").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_2").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_2").show();
                $("#view_1").hide();
            }

            if (view == '3') {
                $("#tab_3").removeClass("tab_bg");
                $("#tab_3").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_2").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_2").show();
                $("#view_3").hide();
            }

            if (view == '4') {
                $("#tab_4").removeClass("tab_bg");
                $("#tab_4").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_2").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_2").show();
                $("#view_4").hide();
            }

            if (view == '5') {
                $("#tab_5").removeClass("tab_bg");
                $("#tab_5").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_2").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_2").show();
                $("#view_5").hide();
            }

            $("#text_view").val('2');
            changeArticleType('2','detail_2');
        });

        $("#tab_3").on('click', function () {
            var view = $("#text_view").val();
            if (view == '1') {
                $("#tab_1").removeClass("tab_bg");
                $("#tab_1").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_3").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_3").show();
                $("#view_1").hide();
            }

            if (view == '2') {
                $("#tab_2").removeClass("tab_bg");
                $("#tab_2").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_3").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_3").show();
                $("#view_2").hide();
            }

            if (view == '4') {
                $("#tab_4").removeClass("tab_bg");
                $("#tab_4").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_3").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_3").show();
                $("#view_4").hide();
            }

            if (view == '5') {
                $("#tab_5").removeClass("tab_bg");
                $("#tab_5").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_3").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_3").show();
                $("#view_5").hide();
            }

            $("#text_view").val('3');
            changeArticleType('3','detail_3');
        });

        $("#tab_4").on('click', function () {
            var view = $("#text_view").val();
            if (view == '1') {
                $("#tab_1").removeClass("tab_bg");
                $("#tab_1").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_4").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_4").show();
                $("#view_1").hide();
            }

            if (view == '2') {
                $("#tab_2").removeClass("tab_bg");
                $("#tab_2").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_4").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_4").show();
                $("#view_2").hide();
            }

            if (view == '3') {
                $("#tab_3").removeClass("tab_bg");
                $("#tab_3").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_4").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_4").show();
                $("#view_3").hide();
            }

            if (view == '5') {
                $("#tab_5").removeClass("tab_bg");
                $("#tab_5").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_4").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_4").show();
                $("#view_5").hide();
            }

            $("#text_view").val('4');
            changeArticleType('4','detail_4');
        });

        $("#tab_5").on('click', function () {
            var view = $("#text_view").val();
            if (view == '1') {
                $("#tab_1").removeClass("tab_bg");
                $("#tab_1").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_5").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_5").show();
                $("#view_1").hide();
            }

            if (view == '2') {
                $("#tab_2").removeClass("tab_bg");
                $("#tab_2").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_5").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_5").show();
                $("#view_2").hide();
            }

            if (view == '3') {
                $("#tab_3").removeClass("tab_bg");
                $("#tab_3").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_5").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_5").show();
                $("#view_3").hide();
            }

            if (view == '4') {
                $("#tab_4").removeClass("tab_bg");
                $("#tab_4").attr("class", "weui_navbar_item tab_font-size");
                $("#tab_5").attr("class", "weui_navbar_item tab_bg tab_font-size");
                $("#view_5").show();
                $("#view_4").hide();
            }

            $("#text_view").val('5');
            changeArticleType('5','detail_5');
        });

    });

    var changeArticleType = function (id, type) {
        $(function () {
            var requestUrl = '/education/article/find';
            $.ajax({
                url: requestUrl,
                data: {
                    type: id
                },
                type: "get",
                dataType: "json",
                success: function (json) {
                    if(json.result == '1') {
                        $("#" + type).empty();
                        var strHtml = "";
                        $(json.articles).each(function () {
                            var pic = this.thumbnail;
                            strHtml += "<a href='javascript:void(0);' class='weui_media_box weui_media_appmsg' onclick='updateView(\"" + this.id + "\")'><div class='weui_media_hd'><img class='weui_media_appmsg_thumb' src='"+pic+"' alt=''></div><div class='weui_media_bd'><h4 class='weui_media_title'>" + this.title + "</h4><p class='weui_media_desc'>阅读量：" + this.count+"</p></div></a> ";
                            console.log(strHtml);
                        });
                        $("#" + type).html(strHtml);
                    }


                },
                error: function (xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                }
            });

        });
    }


    function updateView(id) {
        document.getElementById('text_click').value ='1';
        document.getElementById('text_id').value = id;
        $(function () {
            var requestUrl = '/education/article/update-count';
            $.ajax({
                url : requestUrl,
                data: {
                    id: id
                },
                type : "get",
                dataType : "json",
                success: function (json) {

                },
                error: function (xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                }
            });
        });

        window.location.href = '/education/article/view?type=1&id='+id;
    }

    function reLoad() {
        var flag = document.getElementById('text_click').value;
        var id = document.getElementById('text_id').value;
        if(flag=='1') {
            window.location.href = '/education/article';
        }
    }
</script>
</body>
</html>