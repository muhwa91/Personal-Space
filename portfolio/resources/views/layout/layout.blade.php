<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js')}}" defer></script>
    <!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>
    <!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="/css/owl.carousel.css"/>
	<link rel="stylesheet" href="/css/style.css"/>
	<link rel="stylesheet" href="/css/animate.css"/>
    <title>@yield('title', 'index')</title>
</head>
<body>
    @include('layout.header')
    @yield('main')
    @include('layout.footer')
    
    <!--====== Javascripts & Jquery ======-->
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script>
	<script src="/js/jquery.marquee.min.js"></script>
	<script src="/js/main.js"></script>
</body>
</html>