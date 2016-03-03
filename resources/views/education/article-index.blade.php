<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>教育学习</title>
    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/member.css">
<body>
<div class="weui_tab">
    <div class="weui_navbar">
        <div id="tab_1" class="weui_navbar_item tab_bg tab_font-size">
            教育知识
        </div>
        <div id="tab_2" class="weui_navbar_item tab_font-size">
            药物治疗
        </div>
        <div id="tab_3" class="weui_navbar_item tab_font-size">
            膳食营养
        </div>
        <div id="tab_4" class="weui_navbar_item tab_font-size">
            合理运动
        </div>
        <div id="tab_5" class="weui_navbar_item tab_font-size">
            血糖监测
        </div>
    </div>
    <div id="view_1" class="tab_bd">
        <div class="weui_panel_bd tab_top">
            @foreach($articles as $index)
            <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">
                <div class="weui_media_hd">
                    <img class="weui_media_appmsg_thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==" alt="">
                </div>
                <div class="weui_media_bd">
                    <h4 class="weui_media_title">1{{$index['title']}}</h4>
                    <p class="weui_media_desc">{{$index['description']}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div id="view_2" class="tab_bd">
        <div class="weui_panel_bd tab_top">
            @foreach($articles as $index)
                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==" alt="">
                    </div>
                    <div class="weui_media_bd">
                        <h4 class="weui_media_title">2{{$index['title']}}</h4>
                        <p class="weui_media_desc">{{$index['description']}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div id="view_3" class="tab_bd">
        <div class="weui_panel_bd tab_top">
            @foreach($articles as $index)
                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==" alt="">
                    </div>
                    <div class="weui_media_bd">
                        <h4 class="weui_media_title">3{{$index['title']}}</h4>
                        <p class="weui_media_desc">{{$index['description']}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div id="view_4" class="tab_bd">
        <div class="weui_panel_bd tab_top">
            @foreach($articles as $index)
                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==" alt="">
                    </div>
                    <div class="weui_media_bd">
                        <h4 class="weui_media_title">4{{$index['title']}}</h4>
                        <p class="weui_media_desc">{{$index['description']}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div id="view_5" class="tab_bd">
        <div class="weui_panel_bd tab_top">
            @foreach($articles as $index)
                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="updateView('{{$index['id']}}','{{$index['uri']}}')">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==" alt="">
                    </div>
                    <div class="weui_media_bd">
                        <h4 class="weui_media_title">5{{$index['title']}}</h4>
                        <p class="weui_media_desc">{{$index['description']}}</p>
                    </div>
                </a>
            @endforeach
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
        });

    });


    function updateView(id, uri) {
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

        window.location.href = uri+'?type=1&id='+id;
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