<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>zpc的Blog</title>
		<link rel="stylesheet" type="text/css" href="../modules/home/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="../modules/home/css/public.css">
        <link rel="stylesheet" type="text/css" href="../modules/home/css/header.css">
	</head>
	<body class="nobg">
		@yield('header')
		@yield('content')
	</body>
	@include('home::layouts.footer')
</html>