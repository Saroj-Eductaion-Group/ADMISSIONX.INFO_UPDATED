	<div class="wrapper">
		<!--=== Header ===-->
		<div class="header">
			<div class="container">
				<!-- Logo -->
				<!-- <a class="logo" href="index.html">
					<img src="/assets/administrator/images/logo.jpg" alt="Logo" width="150" >
				</a> -->
				{!! HTML::image("assets/administrator/images/logo.jpg", "Logo", array( 'width' => 150 )) !!}
				<!-- End Logo -->

				<!-- Toggle get grouped for better mobile display -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>
				<!-- End Toggle -->
			</div><!--/end container-->

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
				<div class="container">
					<ul class="nav navbar-nav">
						<!-- Home -->
						<li class="">
							<a href="{{ URL::to('/') }}" title="Home">
								Home
							</a>
						</li>
						<li class=" active">
							<a href="{{ URL::to('/college/dashboard/edit', $slugUrl) }}" title="College Dashboard">
								Dashboard
							</a>
						</li>
		                <li>
		                    <a href="{{ URL::to('logout') }}">
		                        Sign Out
		                    </a>
		                    
		                </li>                
			      
						<!-- End Search Block -->
					</ul>
				</div><!--/end container-->
			</div><!--/navbar-collapse-->
		</div>
		<!--=== End Header ===-->

		

		<!--=== Footer Version 1 ===-->
		
		<!--=== End Footer Version 1 ===-->
	</div><!--/wrapper-->

