<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>我的订单</title>
    <link rel="stylesheet" href="{{asset('/css/shop.css')}}">
</head>
<body>
<div class="container">

    {{--example--}}
    <div class="row order-form">
        <a href="{{url('/shop/order-details')}}"></a>
        <p>&emsp;下单时间：2016.01.01<span class="order-finished">待收货&emsp;</span></p>
        <div class="img-group">
            <div class="col-xs-3"><img class="" src="../image/test02.png" alt=""></div>
            <div class="col-xs-3"><img class="" src="../image/test02.png" alt=""></div>
            <div class="col-xs-3"><img class="" src="../image/test02.png" alt=""></div>
            <div class="col-xs-3"><img class="" src="../image/test02.png" alt=""></div>
        </div>
        <div class="arrow"></div>
        <p>&emsp;实际支付：￥88.00<small>(含运费￥8.00)</small></p>
    </div>
    {{--end_example--}}

</div>

<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config({!! $js !!});
    alert(wx);

    wx.ready(function(){
        alert('ready');
        wx.checkJsApi({
            jsApiList: [
                'checkJsApi',
                'editAddress',
                'chooseWXPay',
                'getLatestAddress',
                'openCard',
                'getLocation'
            ], // 需要检测的JS接口列表，所有JS接口列表见附录2,
            success: function(res) {
                alert('1234');
                alert(res);
                // 以键值对的形式返回，可用的api值true，不可用为false
                // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
            },
            fail: function(res) {
                alert('fail');
                alert(res);
            }
        });
    });
    {{--WeixinJSBridge.invoke('editAddress', {--}}
        {{--appId: "{{$appId}}",--}}
        {{--scope: "jsapi_address",--}}
        {{--signType: "sha1",--}}
        {{--addrSign: "{{$addrSign}}",--}}
        {{--timeStamp: "{{$timestamp}}",--}}
        {{--nonceStr: "123456"--}}
    {{--}, function (res) {--}}
        {{--alert('123');--}}
        {{--alert(res.err_msg);--}}
{{--//若res 中所带的返回值不为空，则表示用户选择该返回值作为收货地址。--}}
{{--//否则若返回空，则表示用户取消了这一次编辑收货地址。--}}
        {{--document.form1.address1.value = res.proviceFirstStageName;--}}
        {{--document.form1.address2.value = res.addressCitySecondStageName;--}}
        {{--document.form1.address3.value = res.addressCountiesThirdStageName;--}}
        {{--document.form1.detail.value = res.addressDetailInfo;--}}
        {{--document.form1.phone.value = res.telNumber;--}}
    {{--});--}}

//    function onBridgeReady(){
//
//    }
//    if (typeof WeixinJSBridge == "undefined"){
//        if( document.addEventListener ){
//            document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
//        }else if (document.attachEvent){
//            document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
//            document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
//        }
//    }else{
//        onBridgeReady();
//    }
</script>
</body>
</html>