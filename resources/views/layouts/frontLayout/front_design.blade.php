<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('css/frontend_css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/frontend_css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/frontend_css/responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('fonts/backend_fonts/css/font-awesome.css') }}" rel="stylesheet" />
<!-- 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous"> -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<!-- for the header -->
	@include('layouts.frontLayout.front_header')
	
	@yield('content')
	
	<!-- for the footer -->
	@include('layouts.frontLayout.front_footer')
	

  
    <script src="{{ asset('js/frontend_js/jquery.js') }}"></script>
	<script src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/frontend_js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('js/frontend_js/price-range.js') }}"></script>
    <script src="{{ asset('js/frontend_js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('js/frontend_js/main.js') }}"></script>
</body>
</html>