<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/images/favicon.png">
	<meta name="theme-color" content="#ffffff">
	<title>AdmissionX | v.1</title>
	
	<!--START STYLESHEETS  -->
		@include('administrator/admin-layouts.style')
	<!--END STYLESHEETS  -->

</head>
<body>
	<div id="wrapper">
		<!-- START HEADER  -->
			@include('administrator/admin-layouts.header')
		<!-- END HEADER  -->

		<!-- START CONTENT BLOCK -->
			@yield('content')
		<!-- END CONTENT BLOCK -->
		
		<!--START JAVASCRIPTS  -->
		@include('administrator/admin-layouts.script')
		<!--END JAVASCRIPTS  -->

		<!-- START FOOTER  -->
			@include('administrator/admin-layouts.footer')
		<!-- END FOOTER  -->
	</div>

</body>
</html> 