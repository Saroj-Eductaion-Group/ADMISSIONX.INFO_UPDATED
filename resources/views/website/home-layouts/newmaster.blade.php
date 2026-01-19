<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" type="image/png" sizes="96x96" href="favicon.png">
	<meta name="theme-color" content="#ffffff">
	<title>AdmissionX | v.1</title>

	<!--START STYLESHEETS  -->
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Web Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

	<!-- CSS Global Compulsory -->
	{!! Html::style('home-layout/assets/css/plugins/bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('home-layout/assets/css/style.css') !!}

	<!-- CSS Header and Footer -->
	{!! Html::style('home-layout/assets/css/headers/header-v6.css') !!}
	{!! Html::style('home-layout/assets/css/footers/footer-v2.css') !!}

	<!-- CSS Implementing Plugins -->
	{!! Html::style('home-layout/assets/css/plugins/animate.css') !!}
	{!! Html::style('home-layout/assets/plugins/line-icons/line-icons.css') !!}
	{!! Html::style('home-layout/assets/plugins/font-awesome/css/font-awesome.min.css') !!}
	{!! Html::style('home-layout/assets/plugins/login-signup-modal-window/css/style.css') !!}

	<!-- CSS Theme -->
	<link rel="stylesheet" type="text/css" href="home-layout/assets/css/theme-colors/default.css" id="style_color">
	{!! Html::style('home-layout/assets/css/theme-skins/dark.css') !!}

	<!-- CSS Customization -->
	{!! Html::style('home-layout/assets/css/homeLayoutCustom.css') !!}
	<!--END STYLESHEETS  -->
</head>
<body class="header-fixed">
	<!-- START HEADER  -->
		@include('website/home-layouts.newheader')
	<!-- END HEADER  -->
	<!-- START CONTENT BLOCK -->
		@yield('content')
	<!-- END CONTENT BLOCK -->

	<!--START JAVASCRIPTS  -->
	<!-- JS Global Compulsory -->

	{!! Html::script('home-layout/assets/plugins/jquery/jquery.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery/jquery-migrate.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
	<!-- JS Implementing Plugins -->
	{!! Html::script('home-layout/assets/plugins/back-to-top.js') !!}
	{!! Html::script('home-layout/assets/plugins/smoothScroll.js') !!}
	{!! Html::script('home-layout/assets/plugins/modernizr.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery.parallax.js') !!}
	{!! Html::script('home-layout/assets/plugins/login-signup-modal-window/js/main.js') !!}
	<!-- JS Customization -->
	{!! Html::script('home-layout/assets/js/custom.js') !!}
	<!-- JS Page Level -->
	{!! Html::script('home-layout/assets/js/app.js') !!}
	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
		});
	</script>
	<!--END JAVASCRIPTS  -->
	<!-- START FOOTER  -->
		@include('website/home-layouts.footer')
	<!-- END FOOTER  -->
</body>
</html>
