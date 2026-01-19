<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<!-- Meta -->
	@include ('website.new-design-layouts.seo-content')
	@yield('meta-tags-seo')
	<!--START STYLESHEETS  -->
	@include('website/new-design-layouts.style')
	<!--END STYLESHEETS  -->
</head>
<body>
	@include('website.new-design-layouts.socialMediaScript')
	@include ('website.new-design-layouts.seo-body-tags')
	<!-- START HEADER  -->
	@include('website/new-design-layouts.header')
	<!-- END HEADER  -->

	<!-- START CONTENT BLOCK -->
		@yield('content')
	<!-- END CONTENT BLOCK -->
	
	<!-- START FOOTER  -->
	@include('website/new-design-layouts.footer')
	<!-- END FOOTER  -->

	<!--START JAVASCRIPTS  -->
	@include('website/new-design-layouts.script')
	<!--END JAVASCRIPTS  -->
</body>
</html> 