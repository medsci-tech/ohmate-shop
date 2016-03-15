<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>{{$item->title}}</title>
    <link rel="stylesheet" href="/css/weui.css">
    <link rel="stylesheet" href="/css/article.css">
</head>
<body>
<div class="weui_panel_bd">
    <div class="weui_media_box weui_media_text">
        <h4 class="weui_media_title">{{$item->title}}</h4>
        <p class="weui_media_desc">{{$item->created_at}}</p>
        <div class="xq_line"></div>
        <video controls="controls"
               src="{{$item->video_url}}"
               width="100%" height="100%"
        >
        </video>
    </div>
</div>
</body>
</html>