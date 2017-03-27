<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>微信后台管理</title>
		<link rel="stylesheet" href="/modules/wechat/css/weui.css">
		<link rel="stylesheet" href="/modules/wechat/css/wechat.css">
	</head>
	<body>
		@include('wechat::layouts.header')
		@include('wechat::layouts.content')
	</body>
	<script type="text/javascript" src="/modules/wechat/js/zepto.min.js"></script>
	<script type="text/javascript" src="/modules/wechat/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript" src="/modules/wechat/js/wechat.js"></script>
</html>