<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/images/favicon.png">
	<meta name="theme-color" content="#ffffff">

	<!-- META TAGS -->
	@yield('meta-tags-seo')
	<!-- END META TAGS -->

	<title>AdmissionX | College Dashboard</title>
	
	<!--START STYLESHEETS  -->
		@include('college/college-layouts.style')
	<!--END STYLESHEETS  -->
	{!! Html::script('assets/js/jquery.min.js') !!}
	
</head>
<body>
	<!-- START HEADER  -->
		@include('college/college-layouts.header')
	<!-- END HEADER  -->

	<!-- START CONTENT BLOCK -->
		@yield('content')
	<!-- END CONTENT BLOCK -->
	
	<!--START JAVASCRIPTS  -->
		@include('college/college-layouts.script')
	<!--END JAVASCRIPTS  -->

	<!-- START FOOTER  -->
		@include('college/college-layouts.footer')
	<!-- END FOOTER  -->
</body>
</html> 