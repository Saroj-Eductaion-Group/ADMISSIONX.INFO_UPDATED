<div class="wrapper">
	<!--=== Header v6 ===-->
		<div class="header-v6 header-sticky">
			<!-- Navbar -->
			<div class="navbar mega-menu" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="menu-container">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<!-- Navbar Brand -->
						<div class="navbar-brand">
							<a href="{{ URL::to('/') }}">
								<!-- <img class="logoStyle default-logo" src="{{asset('assets/images/logo.png')}}" alt="Logo"> -->
								<img class="@if(Auth::check()) logoStyleShrinkLogin @else logoStyleShrink @endif shrink-logo" src="{{asset('assets/images/logo-slogon.png')}}" alt="admissionx logo">
							</a>
						</div>
						<!-- ENd Navbar Brand -->

						<!-- Header Inner Right -->
						<div class="header-inner-right">
							<ul class="menu-icons-list">
								<li class="menu-icons">
									<i class="menu-icons-style search search-close search-btn fa fa-search"></i>
									<div class="search-open">
										<input type="text" class="animated fadeIn form-control" placeholder="Start searching ...">
									</div>
								</li>
							</ul>
						</div>
						<!-- End Header Inner Right -->
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-responsive-collapse">
						<div class="menu-container">
							<ul class="nav navbar-nav">
								<!-- Home -->
								@if(Auth::check())
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
										Applications
									</a>
									<ul class="dropdown-menu" style="top: auto;">
										<li><a href="{{ URL::to('student/check-applications/accepted') }}">Accepted</a></li>
										<li><a href="{{ URL::to('student/check-applications/pending') }}">Pending</a></li>
										<li><a href="{{ URL::to('student/check-applications/rejected') }}">Rejected</a></li>
										<li><a href="{{ URL::to('student/check-applications/view') }}">View All</a></li>
									</ul>
								</li>

								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
										Queries
									</a>
									<ul class="dropdown-menu" style="top: auto;">
										<li><a href="{{ URL::to('student/check-queries/replied') }}">Replied</a></li>
										<li><a href="{{ URL::to('student/check-queries/pending') }}">Pending</a></li>
										<li><a href="{{ URL::to('student/check-queries/view') }}">View All</a></li>
									</ul>
								</li>

								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
										Bookmarks
									</a>
									<ul class="dropdown-menu" style="top: auto;">
										<li><a href="{{ URL::to('student/check-bookmark/colleges') }}">Colleges</a></li>
										<li><a href="{{ URL::to('student/check-bookmark/courses') }}">Courses</a></li>
										<li><a href="{{ URL::to('student/check-bookmark/blog') }}">Blog</a></li>
										<li><a href="{{ URL::to('student/check-bookmark/view') }}">View All</a></li>
									</ul>
								</li>

								<li><a href="{{ URL::to('counselling') }}">Counselling</a></li>
								<li><a href="{{ URL::to('education-blogs') }}">Blogs</a></li>
								<li><a href="{{ URL::to('login') }}">Profile</a></li>
									@if(Auth::check())
					                    <li class="dropdown"><a href="">
					                        <span class="m-r-sm welcome-message">Hi, {{ str_limit(Auth::user()->firstname, $limit = 17, $end = '') }}
					                        </span></a>
					                        <ul class="dropdown-menu" style="top: auto;">
					                        	<li><a href="{{ URL::to('logout') }}">Logout</a></li>
					                        </ul>
					                    </li>
					                @endif
								@endif
							</ul>
						</div>
					</div><!--/navbar-collapse-->
				</div>
			</div>
			<!-- End Navbar -->
		</div>
		<!--=== End Header v6 ===-->
</div>
