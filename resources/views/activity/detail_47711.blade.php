<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>糖尿病风险评估工具</title>
    <style>
        html {
            font-family: Arial
        }

        body {
            text-align: center;
        }

        #title {
            margin: 0 auto 0;
            display: table;
            text-align: left;
            background-color: #009AD8;
            width: 42.25rem;
        }

        #title table {
            width: 100%;
            margin: 1rem 0 1rem
        }

        #title img {
            height: 1.8rem;
            width: 1.8rem
        }

        #title td {
            font-size: 1.8rem;
            color: white;
            font-weight: bold;
        }

        .copyright {
            color: #AAA;
            font-size: 0.9rem;
        }

        table {
            margin: auto;
            text-align: center;
            font-size: 1.6rem;
        }

        #p1, #p2, #p3 {
            min-height: 100%;
            margin: 0 auto 0;
            border: 0.1rem solid #AAA;
            border-bottom: none
        }

        #p1 table {
            margin: auto;
            width: 96%
        }

        #p1 td {
            border-bottom: 0.1rem solid #AAA;
        }

        #p1 table tr td:first-child {
            border-right: 1pt solid #AAA
        }

        .gap {
            width: 0.6rem
        }

        .pg {
            margin: 0.4rem 0.6rem 0.4rem 0;
            padding: 0.5rem 0.7rem 0.5rem;
            border: 0.1rem solid #AAA;
            border-radius: 0.3rem;
        }

        .pn {
            text-align: left;
            padding-bottom: 0.4rem;
        }

        .pv {
            color: #009AD8;
            background: none;
            font-size: 110%
        }

        .pi {
            text-align: left;
            font-size: 0.8rem
        }

        input, .ui-select, .btn {
            border: none;
            padding: 1rem 1.5rem 1rem;
            border-radius: 0.5rem;
            color: white;
            background-color: #009AD8;
            text-align: center;
            vertical-align: middle;
        }

        .ui-select l {
            float: right;
            margin-left: 2rem
        }

        .select {
            text-align: left;
            overflow: auto;
            position: absolute;
            z-index: 200;
            background: white;
            border-radius: 0.4rem;
            border: 0.2rem solid silver;
            margin: 1rem 0 0 -1.5rem
        }

        .option, .op-selected {
            width: 26.8rem;
            color: black;
            line-height: 3.2rem;
            padding-left: 0.5rem
        }

        .op-selected {
            border: 0.1rem solid blue;
            background: rgba(0, 154, 216, 0.3)
        }

        .btn-gap {
            display: table-cell;
            width: 0.8rem
        }

        .btn {
            display: table-cell;
            border: 0.1rem solid #009AD8;
            background-color: white;
            color: #009AD8
        }

        .btn-clicked {
            background-color: #009AD8;
            color: white
        }

        #p1 td input[type=button]:first-child {
            float: left
        }

        #p1 td input[type=button]:last-child {
            float: right
        }

        .ui-slider {
            position: relative;
            padding: 0;
            text-align: center;
        }

        .slider-value {
            display: table;
            position: relative;
            line-height: 100%;
            color: #009AD8;
            text-align: center;
            background: none;
            border: 0.1rem solid #009AD8;
            padding: 0.4rem;
            margin-bottom: 1rem;
        }

        .slider-value:after {
            position: absolute;
            top: 100%;
            left: 30%;
            width: 0;
            height: 0;
            border-top: 0.5rem solid #009AD8;
            border-left: 0.5rem solid transparent;
            border-right: 0.5rem solid transparent;
            content: '';
        }

        input[type=range] {
            -webkit-appearance: none;
            width: 27rem;
            height: 0.8rem;
            border-radius: 0.4rem;
            background: #009AD8;
            border: 0.1rem solid #009AD8;
            padding: 0
        }

        input[type=range]:focus {
            outline: none;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            background-color: #009AD8;
            height: 1.8rem;
            width: 1.8rem;
            border-radius: 1.8rem;
        }

        .btn-main {
            display: block;
            background-color: #D63314;
            font-size: 2.4rem;
            margin: 2rem 0 1rem;
        }

        #p2 {
            display: none;
            border: none;
            font-size: 1.6em;
            background: #009AD8;
            color: white;
            text-align: center;
            position: relative
        }

        .half {
            height: 50%;
            display: table;
            margin: auto
        }

        .mid {
            display: table-cell;
            vertical-align: middle;
            text-align: center
        }

        .btn-info {
            font-size: 120%;
            border: 0.1rem solid white;
            border-radius: 0.4rem;
            padding: 0.8rem 2rem 0.8rem;
            width: 11rem;
            margin: auto
        }

        #p3 {
            background: white;
            display: none;
            font-size: 1.5em
        }

        #p3 table {
            margin: 1.6rem 1rem 0;
            text-align: center;
        }

        #p3 table tr td:first-child {
            border-right: 0.1rem solid #AAA
        }

        #p3 table tr:first-child td {
            border-bottom: 0.1rem solid #AAA
        }

        .resP {
            font-size: 2rem;
            background: #009AD8;
            color: white;
            padding: 2rem 0 2rem 0
        }

        .resT {
            text-align: center;
            margin: auto
        }

        .resBorder1 {
            display: table;
            margin: auto;
            margin-top: 2.5rem;
            width: 19.6rem;
            height: 19.6rem;
            border: 0.1rem solid white;
            border-radius: 19.6rem;
        }

        .resBorder2 {
            display: table;
            margin: auto;
            margin-top: 0.25rem;
            width: 18.6rem;
            height: 18.6rem;
            border: 0.3rem solid white;
            border-radius: 18.6rem
        }

        .resBorder3 {
            display: table;
            margin: auto;
            margin-top: 0.8rem;
            position: relative;
            width: 17rem;
            height: 17rem;
        }

        #scoreCanv {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        #score {
            font-size: 300%;
            margin: 0.8rem 0 0.8rem
        }

        #resTab {
            margin: auto;
            color: #009AD8;
            text-align: left;
        }

        .rpg {
            border: 0.1rem solid;
            border-radius: 0.2rem
        }

        .rpv {
            padding: 0.8rem 0.4rem 0.8rem;
            font-size: 1.5rem;
            color: inherit;
            white-space: nowrap;
        }

        #score2 {
            font-size: 2.4rem;
        }

        .res {
            font-size: 1.5rem;
            text-align: left;
            max-width: 29rem;
            line-height: 2rem
        }

        .adv {
            color: gray;
            line-height: 1.6rem;
            text-align: left;
            font-size: 1.1rem;
            margin: 1.4rem 0 4rem 0
        }
    </style>
    <script type="text/javascript">
        function e(id) {
            return document.getElementById(id);
        }
        function setText(id, txt) {
            e(id).textContent = txt;
        }
        function op(id) {
            s = e(id);
            return s.options[s.selectedIndex];
        }
        function show(id) {
            e(id).style.display = "block";
        }
        function hide(id) {
            e(id).style.display = "none";
        }
        function showP1() {
            show("p1");
            hide("p2");
            hide("p3")
        }
        ;
        function showP2() {
            show("p2");
            hide("p1");
            hide("p3")
        }
        ;
        function showP3() {
            show("p3");
            hide("p1");
            hide("p2")
        }
        ;
        function wait(callback, seconds) {
            var timelag = null;//这里应该用if判断一下；可以扩展
            timelag = window.setTimeout(callback, seconds);
        }
        function drawScore(s) {
            var c = e("scoreCanv");
            var ctx = c.getContext("2d");
            x0 = c.width / 2.0;
            y0 = c.height / 2.0;
            ctx.strokeStyle = "white";
            ctx.lineWidth = 8;
            r = x0 - ctx.lineWidth;

            startRad = 0.5 * Math.PI;
            endRad = startRad + Math.PI * 2 * s / 51;

            ctx.beginPath();
            //第一个和第二个参数，代表圆心坐标
            //第三个参数是圆的半径
            //第四个参数代表圆周起始位置(0 起始位置。沿顺时针路线，分别是0.5 (正下方)，1 PI和1.5 PI(正上方)，为画饼图提供了扇形范围的依据)
            //第五个参数是弧长(Math.PI*1 半圆、Math.PI*2就是整个圆)
            ctx.arc(x0, y0, r, startRad, endRad, false);
            ctx.stroke();
        }
        function toggleBtn(id1, id2) {
            e(id1).className = "btn btn-clicked";
            e(id2).className = "btn";
        }
        function onSexMaleClick() {
            setText('sex', '男');
            toggleBtn("btnMale", "btnFemale");
        }
        function onSexFemaleClick() {
            setText('sex', '女');
            toggleBtn("btnFemale", "btnMale");
        }
        function onHistYesClick() {
            setText('hist', '有');
            toggleBtn("btnYes", "btnNo");
        }
        function onHistNoClick() {
            setText('hist', '无');
            toggleBtn("btnNo", "btnYes");
        }
        function showSelect(id) {
            s = e(id);
            if (s.style.display == "block")
                s.style.display = "none";
            else
                s.style.display = "block";
        }
        function onAgeChange(obj, ev) {
            var age = e("age");
            selOp = age.getElementsByClassName("op-selected")[0];
            selOp.className = "option";
            obj.className = "op-selected";
            setText('ageTxt', obj.textContent);

            age.style.display = "none";
            if (ev && ev.stopPropagation)
                ev.stopPropagation()
            else
                window.event.cancelBubble = true
        }
        function cal() {
            showP2();
            wait(function () {
                showP3();
            }, 1500);

            male = e("sex").textContent;
            isMale = (male.indexOf("男") != -1);
            var sexScore = isMale ? 2 : 0;

            hist = e('hist').textContent;
            hasHist = (hist.indexOf("有") != -1);
            var historyScore = hasHist ? 6 : 0;

            selOp = e("age").getElementsByClassName("op-selected")[0];
            var ageScore = parseInt(selOp.getAttribute("value"));

            height = Number(e("height").value) / 100.0;
            weight = Number(e("weight").value);
            var hwRatio = 1.0 * weight / (height * height);
            var hwScore = 0;
            if (hwRatio < 22)
                hwScore = 0;
            if (hwRatio < 24)
                hwScore = 1;
            else if (hwRatio < 30)
                hwScore = 3;
            else
                hwScore = 5;

            girdle = parseInt(e("girdle").value);
            var girdleScore = 0;
            if (!isMale) {
                girdle += 5;
            }
            if (girdle < 75)
                girdleScore = 0;
            else if (girdle < 80)
                girdleScore = 3;
            else if (girdle < 85)
                girdleScore = 5;
            else if (girdle < 90)
                girdleScore = 7;
            else if (girdle < 95)
                girdleScore = 8;
            else
                girdleScore = 10;

            pres = parseInt(e("pressure").value);
            var pressureScore = 0;
            if (pres < 110)
                pressureScore = 0;
            else if (pres < 120)
                pressureScore = 1;
            else if (pres < 130)
                pressureScore = 3;
            else if (pres < 140)
                pressureScore = 6;
            else if (pres < 150)
                pressureScore = 7;
            else if (pres < 160)
                pressureScore = 8;
            else
                pressureScore = 10;
            //!计算
            var ts = sexScore + ageScore + hwScore + girdleScore + pressureScore + historyScore;

            //!输出结果
            drawScore(ts);
            setText('score', ts);
            setText('score2', ts);

            if (ts >= 25) {
                show("risk3");
                hide("risk2");
                setText('risk', "高风险");
                e("resTab").style.color = "red";
                e("resP").style.background = "red";
            }
            else {
                setText('risk', "低风险");
                e("resTab").style.color = "#009AD8";
                e("resP").style.background = "#009AD8";
                show("risk2");
                hide("risk3");
            }
        }

        function reCal() {
            showP1();
        }
        function onweight() {
            updateSlider("weight");

        }
        function onheight() {
            updateSlider("height");
        }
        function ongirdle() {
            updateSlider("girdle");
        }
        function onpressure() {
            updateSlider("pressure");
        }
        function updateSlider(id) {
            r = e(id);
            setText(id + "Txt", r.value);
            rv = e(id + "-v");
            if (rv != null) {
                rv.textContent = r.value;
                perF = 1.0 * (r.value - r.min) / (r.max - r.min);
                rvw = rv.clientWidth;
                rw = r.clientWidth;
                bound = rw - rvw;
                pos = r.clientWidth * perF;
                if (pos > bound)
                    pos = bound;
                else if (pos < 0)
                    pos = 0;
                rv.style.marginLeft = pos;
            }
        }

        function setupTouch(id, touchFunc) {
            var obj = document.getElementById(id);
            obj.addEventListener("touchstart", touchFunc, false);
            obj.addEventListener("touchmove", touchFunc, false);
            obj.addEventListener("touchend", touchFunc, false);
        }

        function load() {
            updateSlider("weight");
            updateSlider("height");
            updateSlider("girdle");
            updateSlider("pressure");

            if (navigator && navigator.userAgent) {
                if (navigator.userAgent.match("MQQBrowser")) {
                    setupTouch("weight", touch);
                    setupTouch("height", touch);
                    setupTouch("girdle", touch);
                    setupTouch("pressure", touch);
                    //alert(navigator.userAgent);
                }
            }

            var startX = 0;
            var startVal = 0;

            function touch(event) {
                var event = event || window.event;
                var o = event.target;
                var t = event.changedTouches[0];
                var min = parseInt(o.min);
                var max = parseInt(o.max);
                switch (event.type) {
                    case "touchstart":
                        startX = t.clientX;
                        startVal = parseInt(o.value);
                        break;
                    case "touchmove":
                        event.preventDefault();
                        var detal = t.clientX - startX;
                        detal = parseInt((max - min) * (1.0 * detal / o.clientWidth))
                        var cv = startVal + detal;
                        if (cv < min)
                            cv = min;
                        if (cv > max)
                            cv = max;
                        o.value = cv;

                        var evt = document.createEvent('Event');
                        evt.initEvent('input', true, true);
                        o.dispatchEvent(evt);
                        break;
                }
            }//end function touch
        }

        function initBaseFontSize() {
            bw = document.body.clientWidth;
            bh = document.body.clientHeight;
            sw = bw / 42;
            sh = bh / 66.0;
            if (sw > sh)
                sw = sh;
            hm = document.getElementsByTagName("html")[0];
            hm.style.fontSize = sw;
        }
        function updatePageHeight(id, adjustPTop) {
            hm = document.getElementsByTagName("html")[0];
            bh = document.body.clientHeight;
            fs = hm.style.fontSize
            fs.replace("px", "");
            fs = parseFloat(fs);
            sw = fs * 42;

            p1 = e(id);
            p1.style.width = sw;

            if (adjustPTop) {
                sh = fs * 60.0;
                paddingTop = (bh - sh) / 2.0;
                if (paddingTop > fs)
                    paddingTop = fs;
                if (paddingTop > 0)
                    p1.style.paddingTop = paddingTop;
            }
        }
    </script>
</head>
<body onload="load()" style="background:#FFF;margin:0"
">
<script type="text/javascript">
    initBaseFontSize();
</script>
<div id="title">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:2.5%"></td>
            <td class="gap"></td>
            <td align="left">糖尿病风险评估工具</td>
        </tr>
    </table>
</div>
<div id="p1">
    <script>
        updatePageHeight("p1", true);
        e
    </script>
    <table cellpadding="0" cellspacing="0" id="p1Tab">
        <tr>
            <td>
                <div class="pg" style="margin-top:0px">
                    <div class="pn">性别</div>
                    <div class="pv" id="sex">男</label>
                    </div>
            </td>
            <td class="gap"/>
            <td>
                <div style="display:table;width:100%">
                    <div id="btnMale" class="btn btn-clicked" onclick="onSexMaleClick()">男</div>
                    <div class="btn-gap"></div>
                    <div id="btnFemale" class="btn" onclick="onSexFemaleClick()">女</div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="pg">
                    <div class="pn">年龄
                        <l class="pi">(岁)</l>
                    </div>
                    <div class="pv" id="ageTxt">55-59岁</div>
                </div>
            </td>
            <td class="gap"/>
            <td>
                <div id="agePanel" onclick="showSelect('age')" class="ui-select">
                    <span>请选择您的年龄</span>
                    <l>V</l>
                    <div id="age" class="select" style="display:none;">
                        <div class="option" value="0" onclick="onAgeChange(this, event)">20-24岁</div>
                        <div class="option" value="4" onclick="onAgeChange(this, event)">25-34岁</div>
                        <div class="option" value="8" onclick="onAgeChange(this, event)">35-39岁</div>
                        <div class="option" value="11" onclick="onAgeChange(this, event)">40-44岁</div>
                        <div class="option" value="12" onclick="onAgeChange(this, event)">45-49岁</div>
                        <div class="option" value="13" onclick="onAgeChange(this, event)">50-54岁</div>
                        <div class="op-selected" value="15" onclick="onAgeChange(this, event)">55-59岁</div>
                        <div class="option" value="16" onclick="onAgeChange(this, event)">60-64岁</div>
                        <div class="option" value="18" onclick="onAgeChange(this, event)">65-74岁</div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="pg">
                    <div class="pn">体重
                        <l class="pi">(kg)</l>
                    </div>
                    <div class="pv">
                        <l id="weightTxt">60</l>
                        kg
                    </div>
                </div>
            </td>
            <td class="gap"/>
            <td>
                <div class="ui-slider">
                    <div class="slider-value" id="weight-v">60</div>
                    <input id="weight" oninput="onweight()" type="range" value="60" min="40" max="110" step="1"/>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="pg">
                    <div class="pn">身高
                        <l class="pi">(cm)</l>
                    </div>
                    <div class="pv">
                        <l id="heightTxt">160</l>
                        cm
                    </div>
                </div>
            </td>
            <td class="gap"/>
            <td>
                <div class="ui-slider">
                    <div class="slider-value" id="height-v">160</div>
                    <input id="height" oninput="onheight()" type="range" value="160" min="139" max="208"/>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="pg">
                    <div class="pn">腰围
                        <l class="pi">(cm)</l>
                    </div>
                    <div class="pv">
                        <l id="girdleTxt">80</l>
                        cm
                    </div>
                </div>
            </td>
            <td class="gap"/>
            <td>
                <div class="ui-slider">
                    <div class="slider-value" id="girdle-v">80</div>
                    <input id="girdle" oninput="ongirdle()" type="range" value="80" min="65" max="100"/>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="pg">
                    <div class="pn">收缩压
                        <l class="pi">(mmHg)</l>
                    </div>
                    <div class="pv">
                        <l id="pressureTxt">135</l>
                        mmHg
                    </div>
                </div>
            </td>
            <td class="gap"/>
            <td>
                <div class="ui-slider">
                    <div class="slider-value" id="pressure-v">135</div>
                    <input id="pressure" oninput="onpressure()" type="range" value="135" min="100" max="180"/>
                </div>
            </td>
        </tr>
        <tr>
            <td style="border-bottom:none">
                <div class="pg" style="margin-bottom:0px">
                    <div class="pn">糖尿病家族史</div>
                    <div class="pi">包含父母子女兄妹</div>
                    <div class="pv" id="hist">无</label>
                    </div>
            </td>
            <td class="gap" style="border-bottom:none"/>
            <td style="border-bottom:none">
                <div style="display:table;width:100%">
                    <div id="btnYes" class="btn" onclick="onHistYesClick()"/>
                    有
                </div>
                <div class="btn-gap"></div>
                <div id="btnNo" class="btn btn-clicked" onclick="onHistNoClick()"/>
                无
</div>
</div>
</td>
</tr>
<tr>
    <td colspan="3" style="border:none">
        <div onclick="cal()" class="btn btn-main"/>
        开始计算</div>
        <div class="copyright">Copyright 易康伴侣 All right reserved</div>
    </td>
</tr>
</table>
</div>
<div id="p2">
    <script>updatePageHeight("p2", false);</script>
    <div id="top" class="half">
        <div class="mid">
            <img src="/image/activities/47711/heart.png" />
            <div style="font-size:120%;margin-top:20pt">正在计算，请稍后...</div>
        </div>
    </div>
    <div style="width:90%;margin:auto;border-top:0.1rem solid white;"></div>
    <div id="bottom" class="half">
        <div class="mid">
            <!--<input style="font-size:120%;border:0.1rem solid white;border-radius:5pt;padding:6pt 18pt 6pt" type="button" value="你知道吗？"/>-->
            <div class="btn-info">你知道吗？</div>
            <div style="margin-top:3rem">
                <div>糖尿病患者需要重视补充维生素，尤其是</div>
                <div style="margin-top:0.3rem">
                    <l style="font-size:110%">维生素B和维生素C</l>
                    ，减缓糖尿病并发症的进程
                </div>
            </div>
            <div style="margin:0.8rem 0 0.3rem 0">因此糖尿病患者可以适当吃些</div>
            <div style="font-size:110%;margin-bottom:3rem">鱼 / 奶 / 芥菜 / 甘蓝 / 青椒 / 鲜枣等</div>
        </div>
    </div>
</div>
<div id="p3">
    <script>updatePageHeight("p3", false);</script>
    <div class="resP" id="resP">
        <div class="resT">糖尿病风险评估结果</div>
        <div class="resBorder1">
            <div class="resBorder2">
                <div class="resBorder3">
                    <canvas width="180" height="180" id="scoreCanv"></canvas>
                    <div class="mid">
                        <div class="resT">评分</div>
                        <div class="resT" id="score">17</div>
                        <div class="resT" id="risk">低风险</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table cellpadding="0" cellspacing="0" id="resTab">
        <tr>
            <td>
                <div class="rpg" style="margin:0 0.8rem 0.8rem 0">
                    <div class="rpv">计算结果</div>
                </div>
            </td>
            <td>
                <div class="res" style="margin:0 0 0.8rem 0.6rem;">
                    您此次评分结果为
                    <l id="score2">17</l>
                    分
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="rpg" style="margin:0.8rem 0.8rem 0 0">
                    <div class="rpv">我们建议您</div>
                </div>
            </td>
            <td>
                <div class="res" style="margin:0.8rem 0 0 0.6rem">
                    <div id="risk2">您目前得糖尿病的风险不高，还请继续保持健康的生活方式，祝您健康。</div>
                    <div id="risk3" style="display:none">您属于糖尿病高危人群，请尽早就诊，进行口服葡萄糖耐量试验检查。</div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border:none">
                <div class="adv">问卷来源：中国2型糖尿病防治指南2013版。</div>
                <div class="btn btn-main" onclick="reCal()">重新计算</div>
                <div class="copyright">Copyright 易康伴侣 All right reserved</div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>