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
	<meta name="theme-color" content="#18BA98">

	<!-- META TAGS -->
	@yield('meta-tags-seo')
	<!-- END META TAGS -->

	<title>AdmissionX | v.1</title>

	<!--START STYLESHEETS  -->
		@include('website/home-layouts.style')
	<!--END STYLESHEETS  -->
	{!! Html::script('assets/js/jquery.min.js') !!}
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
	    google_ad_client: "ca-pub-5097506219176622",
	    enable_page_level_ads: true
	  });
	</script>
</head>
<body class="header-fixed header-fixed-space-v2"> <!--  -->
	@include('website.new-design-layouts.socialMediaScript')
	{{--*/ $currentUserID = Auth::Id(); /*--}}
	{{--*/
		$getTheLoggedInUserRole = DB::table('users')->where('id','=', Auth::Id())->select('id', 'firstname', 'userrole_id')->take(1)->get();
	/*--}}
	@if( !empty( $getTheLoggedInUserRole ) )
		@if( $getTheLoggedInUserRole[0]->userrole_id == '3' )
			<!-- START HEADER  -->
				@include('website/home-layouts.student-header-inner')
			<!-- END HEADER  -->
		@else
			<!-- START HEADER  -->
				@include('website/home-layouts.header')
			<!-- END HEADER  -->
		@endif
	@else
		<!-- START HEADER  -->
			@include('website/home-layouts.header')
		<!-- END HEADER  -->
	@endif

	<!-- START CONTENT BLOCK -->
		@yield('content')
	<!-- END CONTENT BLOCK -->

	<!-- START FOOTER  -->
		@include('website/home-layouts.footer')
	<!-- END FOOTER  -->

	<!--START JAVASCRIPTS  -->
		@include('website/home-layouts.script')
	<!--END JAVASCRIPTS  -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-100069040-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
