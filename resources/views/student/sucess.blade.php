
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title>AdmissionX | V 1.0</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="96x96" href="favicon.png">
	<meta name="theme-color" content="#ffffff">

	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
	{!! Html::style('assets/css/bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('assets/css/style.css') !!}
	{!! Html::style('assets/css/customstyle.css') !!}	

	<!-- CSS Implementing Plugins -->
	{!! Html::style('assets/css/animate.css') !!}
	{!! Html::style('assets/css/line-icons/line-icons.css') !!}
	{!! Html::style('assets/css/font-awesome/css/font-awesome.min.css') !!}
	
	<!-- CSS Page Style -->
	{!! Html::style('assets/css/pages/page_coming_soon_v1.css') !!}
</head>

<body class="coming-soon-page">
	<div class="coming-soon-bg-cover"></div>
	<!--=== Content Part ===-->
	<div class="container cooming-soon-content valign__middle">
		<!-- Coming Soon Content -->
		<div class="row">
			<div class="col-md-12 coming-soon">
				<!-- <h1><span class="color-green">Hello there !</span></h1> -->
				
				<h2 class="test-info">Thank you for registering with <span class="color-green">AdmissionX</span></h2><br>
				<h3 class="test-info1">Please confirm your email and then continue to login</h3><br>
			<a href="{{ URL::to('/') }}" class="btn-u" title="Take me to login">Take me to login</a><br>
				<h3 class="test-info1">For any support, please contact us at <a href="mailto:support@admissionx.info" target="_top" title="Email us anytime">support@admissionx.info</a></h3><br>
			</div>
		</div>
	</div><!--/container-->
	<!--=== End Content Part ===-->

	<!--=== Sticky Footer ===-->
	<div class="sticky-footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<p class="color-light">
						<i class="fa fa-envelope"></i> <a href="mailto:support@admissionx.info" target="_top" title="Email us anytime">support@admissionx.info</a> | <i class="fa fa-phone"></i> 011-4224-9249
					</p>
				</div>
				<div class="col-sm-6 text-right">
					<ul class="list-inline coming-soon-social">
						<li><a href="https://www.facebook.com/AdmissionX" target="_blank" title="Like &amp; Share with us on Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/admission_x" target="_blank" title="Follow us on Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="javascript:void(0);" title="Connect with us on LinkedIn"><i class="fa fa-linkedin"></i></a></li>						
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--=== End Sticky-Footer ===-->


	<!-- JS Global Compulsory -->
	{!! Html::script('assets/js/jquery.min.js') !!}
	{!! Html::script('assets/js/jquery-migrate.min.js') !!}
	{!! Html::script('assets/css/bootstrap/js/bootstrap.min.js') !!}

	<!-- JS Implementing Plugins -->
	{!! Html::script('assets/js/back-to-top.js') !!}
	{!! Html::script('assets/js/smoothScroll.js') !!}
	
	<!-- JS Customization -->
	{!! Html::script('assets/js/custom.js') !!}
	{!! Html::script('assets/js/app.js') !!}
	
	{!! Html::script('assets/js/countdown/jquery.plugin.js') !!}
	{!! Html::script('assets/js/countdown/jquery.countdown.js') !!}
	{!! Html::script('assets/js/backstretch/jquery.backstretch.min.js') !!}
	{!! Html::script('assets/js/pages/page_coming_soon.js') !!}

	<!--[if lt IE 9]>
	    <script src="assets/plugins/respond.js"></script>
	    <script src="assets/plugins/html5shiv.js"></script>
	    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
	<![endif]-->
	
	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			PageComingSoon.initPageComingSoon();
		});
	</script>

	<!-- Background Slider (Backstretch) -->
	<script>
		$.backstretch([
			"assets/images/bg/1.jpg",
			]);
	</script>

<!--[if lt IE 9]>
	<script src="assets/plugins/respond.js"></script>
	<script src="assets/plugins/html5shiv.js"></script>
	<script src="assets/plugins/placeholder-IE-fixes.js"></script>
	<![endif]-->

</body>
</html>
