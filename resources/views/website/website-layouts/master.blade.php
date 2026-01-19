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
		@include('website/website-layouts.style')
	<!--END STYLESHEETS  -->
	{!! Html::script('assets/js/jquery.min.js') !!}

</head>
<body>
	@include('website.new-design-layouts.socialMediaScript')
	<!-- START HEADER  -->
		@include('website/website-layouts.header')
	<!-- END HEADER  -->

	<!-- START CONTENT BLOCK -->
		@yield('content')
	<!-- END CONTENT BLOCK -->
	
	<!-- START FOOTER  -->
		@include('website/website-layouts.footer')
	<!-- END FOOTER  -->

	<!--START JAVASCRIPTS  -->
		@include('website/website-layouts.script')
	<!--END JAVASCRIPTS  -->
</body>
</html> 