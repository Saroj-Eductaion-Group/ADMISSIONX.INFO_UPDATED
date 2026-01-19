<div class="wrapper">

		<div class="header-v8 header-sticky">

			<div class="blog-topbar">
				<div class="topbar-search-block">
					<div class="container">
						<form action="">
							<input type="text" class="form-control" placeholder="Search">
							<div class="search-close"><i class="icon-close"></i></div>
						</form>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-xs-8">
							<div class="topbar-time visible-xs-block">011-4224-9249 | <a href="mailto:support@admissionx.info">support@admissionx.info</a></div>
						</div>
						<div class="col-sm-4 col-xs-4 clearfix">
							<i class="fa fa-search search-btn pull-right"></i>
							<ul class="topbar-list topbar-log_reg pull-right visible-sm-block visible-md-block visible-lg-block">
								<li class="cd-log_reg home"><a class="cd-signin" href="javascript:void(0);">011-4224-9249</a></li>
								<li class="cd-log_reg"><a class="cd-signup" href="mailto:support@admissionx.info">support@admissionx.info</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>


			<div class="navbar mega-menu" role="navigation">
				<div class="container">

					<div class="res-container">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<div class="navbar-brand">
							<a href="{{ URL::to('/') }}">
								<!-- <img src="{{asset('assets/images/logo.png')}}" alt="Logo" class="logoStyle"> -->
								<img class="@if(Auth::check()) logoStyleShrinkLogin @else logoStyleShrink @endif shrink-logo" src="{{asset('assets/images/logo-slogon.png')}}" alt="admissionx logo">
							</a>
						</div>
					</div>


					<div class="collapse navbar-collapse navbar-responsive-collapse">
						<div class="res-container">
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
					                        <span class="m-r-sm text-muted welcome-message">Hi, {{ str_limit(Auth::user()->firstname, $limit = 17, $end = '') }}
					                        </span></a>
					                        <ul class="dropdown-menu" style="top: auto;">
					                        	<li><a href="{{ URL::to('logout') }}">Logout</a></li>
					                        </ul>
					                    </li>
					                @endif

								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>

		</div>
