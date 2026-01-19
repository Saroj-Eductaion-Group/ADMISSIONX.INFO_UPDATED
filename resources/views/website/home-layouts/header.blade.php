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


					<div class="collapse navbar-collapse navbar-responsive-collapse" >
						<div class="res-container">
							<ul class="nav navbar-nav">
								@if(Auth::check())
									{{--*/   $getLoggedObj = DB::table('users')
											->where('users.id', '=', Auth::id())
	                                        ->where('users.userrole_id','!=','2')
	                                        ->where('users.userrole_id','!=','3')
	                                        ->select('users.id')
	                                        ->take(1)
	                                        ->get()
	                                        ;
				                	/*--}}
				                	@if( $getLoggedObj )
				                	<li><a href="{{ URL::to('counselling') }}">Counselling</a></li>
									<li><a href="{{ URL::to('education-blogs') }}">Blogs</a></li>
									<li><a href="{{ URL::to('login') }}">Dashboard</a></li>
									<li><a href="{{ URL::to('logout') }}">Logout</a></li>
									@endif
								@else
								<li><a href="{{ URL::to('educational-institution') }}">College</a></li>
								<li><a href="{{ URL::to('counselling') }}">Counselling</a></li>
								<li><a href="{{ URL::to('education-blogs') }}">Blogs</a></li>
								@endif

								@if(Auth::check())

				                	{{--*/   $getCollegeProfileObj = DB::table('users')
												->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
		                                        ->leftJoin('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
		                                        ->where('users.id', '=', Auth::id())
		                                        ->where('users.userrole_id','=','2')
		                                        ->select('collegeprofile.slug')
		                                        ->take(1)
		                                        ->get()
		                                        ;
				                	/*--}}
				                	@if( $getCollegeProfileObj )
				                		<li class="dropdown">
											<a href="{{ URL::to('college/check-applications', $getCollegeProfileObj[0]->slug) }}" class="dropdown-toggle" data-toggle="dropdown"> Applications  </a>
											<ul class="dropdown-menu" style="top: auto;">
												<li><a href="{{ URL::to('college/check-application-status/accepted') }}">Accepted</a></li>
												<li><a href="{{ URL::to('college/check-application-status/pending') }}">Pending</a></li>
												<li><a href="{{ URL::to('college/check-application-status/rejected') }}">Rejected</a></li>
												<li><a href="{{ URL::to('college/check-application-status/cancelled') }}">Cancelled</a></li>
												<li><a href="{{ URL::to('college/check-application-status/view') }}">View All</a></li>
											</ul>
										</li>
										<li class="dropdown">
											<a href="{{ URL::to('college/check-queries', $getCollegeProfileObj[0]->slug) }}" class="dropdown-toggle" data-toggle="dropdown">
												Queries
											</a>
											<ul class="dropdown-menu" style="top: auto;">
												<li><a href="{{ URL::to('college/check-queries-status/replied') }}">Replied</a></li>
												<li><a href="{{ URL::to('college/check-queries-status/pending') }}">Pending</a></li>
												<li><a href="{{ URL::to('college/check-queries-status/view') }}">View All</a></li>
											</ul>
										</li>
										<li><a href="{{ URL::to('education-blogs') }}">Blogs</a></li>
										<li><a href="{{ URL::to('login') }}">Dashboard</a></li>
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
								@else
									<li><a class="color-green" data-toggle="modal" data-target="#loginModal" data-whatever="" href="">Log In</a></li>
									<li><a class="color-green" data-toggle="modal" data-target="#signUpModel" data-whatever="" href="">Sign Up</a></li>
								@endif
								<li><a class="collegeTabBorder" href="{{ URL::to('engineering-association-examination') }}">AIEA Exam</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

		</div>
</div>

@section('scripts')
<script type="text/javascript">
	jQuery(document).ready(function() {
		StudentSignUpForm.initStudentSignUpForm();
	});
</script>
@endsection
