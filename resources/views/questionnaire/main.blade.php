<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>调查问卷</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

  <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css">

  @yield('css')

</head>
<body>

@yield('content')

</body>
<script type="text/javascript" src="{{asset('/')}}vendor/jQuery/jQuery-2.1.4.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    $(function () {
	//点击量
		$.ajax({
		url: '/questionnaire2/countNum',
		data: {
			'action'		: 'click',
			'random'		: Math.random()
		},
		dataType: 'text',
		success: function(text) {},
		error: function() {}
	});
	
			
	//微信jssdk	
	var baseUrl = 'http://www.ohmate.cn/questionnaire2',
		imgUrl			= '{{asset("/")}}images/share.png',
		tTitle			= '1元钱 还包邮 让糖友们都哭笑了，福利来了！ ',
		tContent		= '重要的事情说三遍！糖友们领福利啦！领福利啦！领福利啦！'
	wx.config({
		debug: false,
		appId:'<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			'checkJsApi',
			'onMenuShareAppMessage',
			'onMenuShareTimeline',
			'onMenuShareQQ'
			
		]
	});

	wx.ready(function () {
			wx.onMenuShareAppMessage({
			title: tTitle,
			desc: tContent,
			link: baseUrl,
			imgUrl: imgUrl,
			trigger: function (res) {
				$.ajax({
					url: '/questionnaire2/countNum',
					data: {
						'action'		: 'share',
						'random'		: Math.random()
					},
					dataType: 'text',
					success: function(text) {},
					error: function() {}
				});
			},
			success: function (res) {

			},
			cancel: function (res) {
				// alert('已取消');
			},
			fail: function (res) {
				// alert(JSON.stringify(res));
			}
		});
	
		wx.onMenuShareQQ({
			title: tTitle, // 分享标题
			desc: tContent, // 分享描述
			link: baseUrl, // 分享链接
			imgUrl: imgUrl, // 分享图标
			success: function () { 
				$.ajax({
					url: '/questionnaire2/countNum',
					data: {
						'action'		: 'share',
						'random'		: Math.random()
					},
					dataType: 'text',
					success: function(text) {},
					error: function() {}
				});
			
			   // 用户确认分享后执行的回调函数
			},
			cancel: function () { 
			   // 用户取消分享后执行的回调函数
			}
		});
	
		wx.onMenuShareTimeline({
			title: tTitle,
			desc: tContent,
			link: baseUrl,
			imgUrl: imgUrl,
			trigger: function (res) {
				$.ajax({
					url: '/questionnaire2/countNum',
					data: {
						'action'		: 'share',
						'random'		: Math.random()
					},
					dataType: 'text',
					success: function(text) {},
					error: function() {}
				});
			},
			success: function (res) {

			},
			cancel: function (res) {
				// alert('已取消');
			},
			fail: function (res) {
				// alert(JSON.stringify(res));
			}
		});
		
	});
	wx.error(function (res) {
	   alert(res.errMsg);
	});

		
    });
</script>
</html>