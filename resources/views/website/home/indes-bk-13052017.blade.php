<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Meta tags List -->
	<!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
	<meta property="fb:admins" content="">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="robots" content="index, follow">
	<meta name="twitter:card" content="app"> 
	<meta name="twitter:app:country" content="IN"> 
	<meta name="twitter:app:name:iphone" content="Admission X"> 
	<meta name="twitter:app:id:iphone" content=""> 
	<meta name="twitter:app:name:ipad" content="Admission X"> 
	<meta name="twitter:app:id:ipad" content=""> 
	<meta name="twitter:app:name:googleplay" content="Admission X"> 
	<meta name="twitter:app:id:googleplay" content="">
	<meta name="twitter:app:url:iphone" content=""> 
	<meta name="twitter:app:url:ipad" content=""> 
	<meta name="twitter:app:url:googleplay" content="">

	<meta name="og_title" property="og:title" content="AdmissionX.com">
	<meta name="og_site_name" property="og:site_name" content="AdmissionX.com">
	<meta name="og_image" property="og:image" content="">
	<meta name="og_url" property="og:url" id="og-url" content="https://www.admissionx.com">

	<!-- End -->

	<!-- Meta Two -->
	<meta name="theme-color" content="#72c02c">
	<meta name="author" content="AdmissionX">
	<meta name="description" content="AdmissionX">
	<!-- End -->

	<title>AdmissionX | Welcome Aboard!</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/images/favicon.png">
	
	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
	{!! Html::style('home-layout/assets/css/plugins/bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('home-layout/assets/css/style.css') !!}

	<!-- CSS Header and Footer -->
	{!! Html::style('home-layout/assets/css/headers/header-v6.css') !!}
	{!! Html::style('home-layout/assets/css/footers/footer-v2.css') !!}

	<!-- CSS Implementing Plugins -->
	{!! Html::style('home-layout/assets/css/plugins/animate.css') !!}
	{!! Html::style('home-layout/assets/plugins/line-icons/line-icons.css') !!}
	{!! Html::style('home-layout/assets/plugins/font-awesome/css/font-awesome.min.css') !!}
	{!! Html::style('home-layout/assets/plugins/login-signup-modal-window/css/style.css') !!}
	{!! Html::style('assets/css/blocks.css') !!}
	{!! Html::style('assets/css/pages/page_search.css') !!}
	<!-- CSS Theme -->
	<link rel="stylesheet" type="text/css" href="../home-layout/assets/css/theme-colors/default.css" id="style_color">
	{!! Html::style('home-layout/assets/css/theme-skins/dark.css') !!}

	<!-- CSS Customization -->
	{!! Html::style('home-layout/assets/css/homeLayoutCustom.css') !!}

	<!-- CSS Theme -->
  	{!! Html::style('home-layout/assets/css/agency-style.css') !!}
  	{!! Html::style('home-layout/assets/css/plugins/owl-carousel2/assets/owl.carousel.css') !!}
  	 
  	<!--SKY FORMS  -->
  	{!! Html::style('assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css') !!}
	{!! Html::style('assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css') !!}
	
	<!-- Mandatory js -->
	{!! Html::script('home-layout/assets/plugins/jquery/jquery.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery/jquery-migrate.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
	{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
	{!! Html::style('home-layout/assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css') !!}
	{!! Html::style('home-layout/assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css') !!}
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>

<body class="header-fixed">
	
	{{--*/ $currentUserID = Auth::Id(); /*--}}
	{{--*/
		$getTheLoggedInUserRole = DB::table('users')->where('id','=', Auth::Id())->select('id', 'firstname', 'userrole_id')->take(1)->get();
	/*--}}
	@if( !empty( $getTheLoggedInUserRole ) )
		@if( $getTheLoggedInUserRole[0]->userrole_id == '3' )
		<!-- START HEADER  -->
				@include('website/home-layouts.student-headerv6')
			<!-- END HEADER  -->
		@else
			<!-- START HEADER  -->
				@include('website/home-layouts.headerv6')
			<!-- END HEADER  -->
		@endif
	@else
		<!-- START HEADER  -->
			@include('website/home-layouts.headerv6')
		<!-- END HEADER  -->
	@endif
	

	<!-- Interactive Slider v2 -->
	<div class="interactive-slider-v2 lesspadding100">
		<div class="container">
			<div >
				@if(Session::has('checkEmailSucess'))
		        <div class="alert alert-success alert-dismissible" id="dialog" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		            <strong>{{ Session::get('checkEmailSucess') }}</strong>
		        </div>                        
		    	@endif
			</div>
			<div >
				@if(Session::has('returnBackSignup'))
		        <div class="alert alert-danger alert-dismissible" id="dialog" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		            <strong>{{ Session::get('returnBackSignup') }}</strong>
		        </div>                        
		    	@endif
			</div>
			<h1 class="font-size50">Welcome aboard!</h1>
			<p class="hide">Making higher education accessible, one admission at a time !</p>
			<!-- <form method="POST" action="filter/college" class="sky-form sky-form-no-block padding-top10"> -->
			<form method="GET" action="/explore/college" class="sky-form sky-form-no-block padding-top10">
				<div class="row padding-bottom20">
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 ">
						<label class="select">
							<select name="country_id[]" class="form-control search-blocks-textbox country_id rounded">
								<option selected="" disabled="">Country</option>
								@if( $countryObj )
									<option value="99">India</option>
									@foreach( $countryObj as $item )
										@if( $item->id == '99' )
											<option value="99">{{ $item->name }}</option>
										@else
											<option value="{{ $item->id }}">{{ $item->name }}</option>
										@endif
									@endforeach
								@endif
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 ">
						<label class="select">
							<select name="state_id[]" class="form-control search-blocks-textbox state_id rounded">
								<option selected="" disabled="">State</option>							
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<label class="select">
							<select name="city_id[]" class="form-control search-blocks-textbox city_id rounded">
								<option selected="" disabled="">City</option>
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<label class="select">
							<select name="functionalarea_id[]" class="functionalarea_id rounded">
								<option selected="" disabled="">Stream</option>
								@if( $functionalAreaObj )
									<option value="1">Engineering</option>
									<option value="6">Management</option>
									<option value="11">Pharmacy</option>
									@foreach( $functionalAreaObj as $item )
										<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								@endif
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 form-filter-">
						<label class="select">
							<select name="degree_id[]" class="degree_id rounded"> <!-- class="form-control search-blocks-textbox" -->
								<option selected="" disabled="">Degree</option>
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 ">
						<label class="select">
							<select name="course_id[]" class="form-control search-blocks-textbox course_id rounded">
								<option selected="" disabled="">Branch</option>
							</select>
							<i></i>
						</label>
					</div>
					
				</div>
				<div class="row padding-bottom20">
					<div class="col-xs-12 col-md-6 col-md-offset-3">
						<label class="input">
							<input id="field_id" name="field_id" type="hidden">
							<input type="text" class="form-control search-blocks-textbox rounded" name="collegeName" id="field" placeholder="Enter College Name">
							<span id="results_count"></span>
	                        <span id="empty-message"></span>	
						</label>						
					</div>
				</div>
				<div class="row margin-top20">
					<div class="col-md-4 col-md-offset-4">
						<button class="btn btn-block btn-u search-blocks-textbox searchbutton browseCollege">Browse College</button>
					</div>
				</div>
			</form>
			<br>
			<!-- <div class="col-md-4 col-md-offset-4">
			<p class="text-center"><a class="btn-u" type="button"  data-toggle="modal" href="{{ URL::to('/exam-registration') }}">Exam Registration</a></p>
			</div> -->
		</div>
	</div>

	<div class="purchase">
		<div class="container overflow-h">
			<div class="row">
				<div class="col-md-6 shadow-wrapper">
					<div class="heading heading-v4">
						<h2 class="text-green-color">Student</h2>
					</div>
					<div class="responsive-video box-shadow shadow-effect-2">
						<!-- <iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe> -->
						@if( !empty($getStudentYoutubeObj[0]->galleryName) )
							
							{{--*/ 
								$explodeYoutubeLink = explode('watch?v=', $getStudentYoutubeObj[0]->galleryName);
							/*--}}
							<iframe width="560" height="315" src="http://www.youtube.com/embed/{{$explodeYoutubeLink[1]}}" frameborder="0" allowfullscreen></iframe>
						@else
							<iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe>	
						@endif
					</div>
				</div>
				<div class="col-md-6 shadow-wrapper">
					<div class="heading heading-v4">
						<h2 class="text-green-color">College</h2>
					</div>
					<div class="responsive-video box-shadow shadow-effect-2">
						<!-- <iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe> -->
						@if( !empty($getCollegesYoutubeObj[0]->galleryName) )
							
							{{--*/ 
								$explodeYoutubeLink = explode('watch?v=', $getCollegesYoutubeObj[0]->galleryName);
							/*--}}
							<iframe width="560" height="315" src="http://www.youtube.com/embed/{{$explodeYoutubeLink[1]}}" frameborder="0" allowfullscreen></iframe>	
						@else
							<iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe>
						@endif						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg-color-light">
		<div class="container">
			@if( sizeof($getCollegesInfoObj) > 0 )
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="headline">
						<h4>COLLEGES</h4>
					</div>
				</div>
			</div>
			@endif
			<div class="row featured-blog featCollegeBookmark">
				@if(Auth::check())
					@if( $getCollegesInfoObj )
						<h1 class="hidden-xs fixTheArrow leftArrowIcon"><a href="javascript:void(0);">&nbsp;&nbsp;</a></h1>
						<h1 class="hidden-xs fixTheArrow rightArrowIcon"><a href="javascript:void(0);">&nbsp;&nbsp;</a></h1>
						<ul class="owl-college-v1 padding-left0 padding-right40 list-unstyled">
						@foreach( $getCollegesInfoObj as $item )
							<li>
								<div class="container team-v3">
									<ul class="list-unstyled row">
										<li class="col-sm-3 col-xs-6">
											<div class="team-img">
												<div class="margin-left10 margin-right10 margin-bottom60">
													<a href="{{ URL::to('college', $item->slug) }}" class="text-deco-none">
														@if( $item->logoImageName != '' )
															<div class="featuredCollegeBlock" style="background-image: url('{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->logoImageName }}');">
														@else
															<div class="featuredCollegeBlock" style="background-image: url('{{asset('assets/images')}}/no-college-logo.png');">
														@endif
														    <div class="feature-strip-college-blogs">
														    	@if( $studentCollegesInfoBlogs )
															    	@foreach($studentCollegesInfoBlogs as $bookmarked)
															    		@if( $bookmarked->college_id == $item->collegeprofileId )
																    	<a href="javascript:void(0);" class="bookmarkedHeartIcon">
																    		<input type="hidden" name="bookmarkTableID" value="{{ $bookmarked->id }}">
									  										<input type="hidden" class="collegeName" name="collegeName" value="{{ $item->slug }}">
									  										<input type="hidden" name="collegeURL" value="{{ URL::to('college', $item->slug) }}">
							  												<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses">
							  													<i class="bookmarkHeart rounded-x icon-heart"></i>
																			</span>
								      									</a>
																		{{--*/ break /*--}}
																		@else
																			<a href="javascript:void(0);" class="collegeBookMarkButton">
										  										<input type="hidden" class="collegeName" name="collegeName" value="{{ $item->slug }}">
										  										<input type="hidden" name="collegeURL" value="{{ URL::to('college', $item->slug) }}">
								  												<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses">
								  													<i class="bookmarkHeart rounded-x icon-heart"></i>
																				</span>
									      									</a>
																		@endif
																	@endforeach
																@else
																	<a href="javascript:void(0);" class="collegeBookMarkButton">
								  										<input type="hidden" class="collegeName" name="collegeName" value="{{ $item->slug }}">
								  										<input type="hidden" name="collegeURL" value="{{ URL::to('college', $item->slug) }}">
						  												<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses">
						  													<i class="bookmarkHeart rounded-x icon-heart"></i>
																		</span>
							      									</a>
																@endif		      									
						    								</div>
						    							</div>
						    							<div class="feature-college-overlay searchBox">
						    								<div class="feature-desc">
						      									<div>
						      										<h4 class="indexCollegeBox" ><a href="{{ URL::to('college', $item->slug) }}" class="indexCollegeName" >{{ $item->firstname}}</a></h4>
						      									</div>
																<div class="feature-style">
																	@foreach($getCollegeAddress as $address)
																		@if($address->collegeprofile_id == $item->collegeprofileId)
																			@if( $address->addresstypeId  == '2' )
													                        	@if( !empty( $address->addressname ) )
													                        	 {{ $address->cityName }}, {{ $address->stateName }}
																		    	@else
																		    		
																		    	@endif			                        	
													                        @else
													                        	
													                        @endif
													                     @endif
												                    @endforeach
																</div>
																<!-- <div class="feature-deatils">
																	@if( !empty($collegeFacilityDataObj) )
								 									<p class="clearBothNow text-center margin-top10" ><a href="javascript:void(0);" id="collegeAmenitiesView" class="{{ $item->collegeprofileId }}" style="color: #8a5d5e;">View  Facilities</a></p>
								 									@endif -->

																<!-- Available Facilities
																	@if( $collegeFacilityDataObj )
																		<div class="row">
																			@foreach( $collegeFacilityDataObj as $facility )
																				@if($facility->collegeprofile_id == $item->collegeprofileId)
																				<div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
																					<p class="feature-facility-icon">
																					@if( $facility->facilitiesId == '1' )
																					<img src="/home-layout/assets/img/facility/hostel.png" width="16"> 
																					@elseif( $facility->facilitiesId == '2' )
																					<img src="/home-layout/assets/img/facility/transport.png" width="16"> 
																					@elseif( $facility->facilitiesId == '3' )
																					<img src="/home-layout/assets/img/facility/cafeteria.png" width="16"> 
																					@elseif( $facility->facilitiesId == '4' )
																					<img src="/home-layout/assets/img/facility/audotarium.png" width="16"> 
																					@elseif( $facility->facilitiesId == '5' )
																					<img src="/home-layout/assets/img/facility/library.png" width="16"> 
																					@elseif( $facility->facilitiesId == '6' )
																					<img src="/home-layout/assets/img/facility/labs.png" width="16"> 
																					@elseif( $facility->facilitiesId == '7' )
																					<img src="/home-layout/assets/img/facility/gym.png" width="16"> 
																					@elseif( $facility->facilitiesId == '8' )
																					<img src="/home-layout/assets/img/facility/wifi.png" width="16">
																					@elseif( $facility->facilitiesId == '9' )
																					<img src="/home-layout/assets/img/facility/internet.png" width="16"> 
																					@endif
																					</p>
																				</div>
																				@endif
																			@endforeach
																		</div>
																	@endif -->
																					<!-- {{ $facility->facilitiesName }} -->
																<!-- </div> -->
																<!-- <div class="feature-deatils text-center">
																<a href="{{ URL::to('college', $item->slug) }}" class="btn-u btn-u-xs viewCollege">View Now <i class="fa fa-angle-right margin-left-5"></i></a>
																</div> -->
						    								</div>
														</div>
													</a>
												</div>
												<div class="team-hover">
													<span>Available Facilities</span>
													<small></small>
													<ul class="list-inline team-social-v3 margin-top30">
														@if( $collegeFacilityDataObj )
															<div class="row collegefacility">
																@foreach( $collegeFacilityDataObj as $facility )
																	@if($facility->collegeprofile_id == $item->collegeprofileId)
																	<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1">
																		<p class="feature-facility-icon">
																			<img src="/home-layout/assets/img/facility/icon/{{ $facility->iconname }}" width="64"> 
																		</p>
																	</div>
																	@endif
																@endforeach
															</div>
														@endif
													</ul>
													<div class="feature-deatils text-center margin-top20">
														<a href="{{ URL::to('college', $item->slug) }}" class="btn-u btn-u-md viewCollege viewCOllege">View Now <i class="fa fa-angle-right margin-left-5"></i></a>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
								
							</li>
						@endforeach
						</ul>
					@endif
				@else
					@if( $getCollegesInfoObj )
						<h1 class="hidden-xs fixTheArrow leftArrowIcon"><a href="javascript:void(0);">&nbsp;&nbsp;</a></h1>
						<h1 class="hidden-xs fixTheArrow rightArrowIcon"><a href="javascript:void(0);">&nbsp;&nbsp;</a></h1>
						<ul class="owl-college-v1 padding-left0 padding-right40 list-unstyled">
						@foreach( $getCollegesInfoObj as $item )
							<li>
								<div class="container team-v3">
									<ul class="list-unstyled row">
										<li class="col-sm-3 col-xs-6">
											<div class="team-img">
												<div class="margin-left10 margin-right10 margin-bottom60">
													<a href="{{ URL::to('college', $item->slug) }}" class="text-deco-none">
														@if( $item->logoImageName != '' )
															<div class="featuredCollegeBlock" style="background-image: url('{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->logoImageName }}');">
														@else
															<div class="featuredCollegeBlock" style="background-image: url('{{asset('assets/images')}}/no-college-logo.png');">
														@endif
														    <div class="feature-strip-college-blogs">
						      									<a href="javascript:void(0);" class="collegeBookMarkButton">
							  										<input type="hidden" class="collegeName" name="collegeName" value="{{ $item->slug }}">
							  										<input type="hidden" name="collegeURL" value="{{ URL::to('college', $item->slug) }}">
					  												<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses">
					  													<i class="bookmarkHeart rounded-x icon-heart"></i>
																	</span>
						      									</a>
						    								</div>
						    							</div>
						    							<div class="feature-college-overlay">
						    								<div class="feature-desc">
						      									<div>
						      										<h4 class="indexCollegeBox"><a href="{{ URL::to('college', $item->slug) }}" class="indexCollegeName" >{{ $item->firstname}}</a></h4>
						      									</div>
																<div class="feature-style">
																@foreach($getCollegeAddress as $address)
																		@if($address->collegeprofile_id == $item->collegeprofileId)
																			@if( $address->addresstypeId  == '2' )
													                        	@if( !empty( $address->addressname ) )
													                        	 {{ $address->cityName }}, {{ $address->stateName }}
																		    	@else
																		    		
																		    	@endif			                        	
													                        @else
													                        	
													                        @endif
													                     @endif
												                    @endforeach
																</div>
																<!--<div class="feature-deatils">
																 @if( !empty($collegeFacilityDataObj) )
							 									<p class="clearBothNow text-center margin-top10"><a href="javascript:void(0);" id="collegeAmenitiesView" class="{{ $item->collegeprofileId }}" style="color: #8a5d5e;">View Facilities</a></p>
							 									@endif -->

																<!-- Available Facilities
																	@if( $collegeFacilityDataObj )
																		<div class="row">
																			@foreach( $collegeFacilityDataObj as $facility )
																				@if($facility->collegeprofile_id == $item->collegeprofileId)
																				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
																					<p class="feature-facility-icon">
																					@if( $facility->facilitiesId == '1' )
																					<img src="/home-layout/assets/img/facility/hostel.png" width="16"> 
																					@elseif( $facility->facilitiesId == '2' )
																					<img src="/home-layout/assets/img/facility/transport.png" width="16"> 
																					@elseif( $facility->facilitiesId == '3' )
																					<img src="/home-layout/assets/img/facility/cafeteria.png" width="16"> 
																					@elseif( $facility->facilitiesId == '4' )
																					<img src="/home-layout/assets/img/facility/audotarium.png" width="16"> 
																					@elseif( $facility->facilitiesId == '5' )
																					<img src="/home-layout/assets/img/facility/library.png" width="16"> 
																					@elseif( $facility->facilitiesId == '6' )
																					<img src="/home-layout/assets/img/facility/labs.png" width="16"> 
																					@elseif( $facility->facilitiesId == '7' )
																					<img src="/home-layout/assets/img/facility/gym.png" width="16"> 
																					@elseif( $facility->facilitiesId == '8' )
																					<img src="/home-layout/assets/img/facility/wifi.png" width="16">
																					@elseif( $facility->facilitiesId == '9' )
																					<img src="/home-layout/assets/img/facility/internet.png" width="16"> 
																					@endif
																					</p>
																				</div>
																				@endif
																			@endforeach
																		</div>
																	@endif -->
																					<!-- {{ $facility->facilitiesName }} -->
																<!--</div>
																 <div class="feature-deatils text-center">
																<a href="{{ URL::to('college', $item->slug) }}" class="btn-u btn-u-xs viewCollege">View Now <i class="fa fa-angle-right margin-left-5"></i></a>
																</div> -->
						    								</div>
														</div>

													</a>
												</div>
												<div class="team-hover">
													<span>Available Facilities</span>
													<ul class="list-inline team-social-v3 margin-top30">
														@if( !empty($collegeFacilityDataObj) )
															<div class="row collegefacility">
																@foreach( $collegeFacilityDataObj as $facility )
																	@if($facility->collegeprofile_id == $item->collegeprofileId)
																	<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1">
																		<p class="feature-facility-icon tooltips" data-toggle="tooltip" data-placement="right" title="{{ $facility->facilitiesName }}">
																			<img src="/home-layout/assets/img/facility/icon/{{ $facility->iconname }}" width="64"> 
																		</p>
																	</div>
																	@endif
																@endforeach
															</div>
														@endif
													</ul>
													<div class="feature-deatils text-center margin-top20">
														<a href="{{ URL::to('college', $item->slug) }}" class="btn-u btn-u-md viewCollege viewCOllege">View Now <i class="fa fa-angle-right margin-left-5"></i></a>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</li>
						@endforeach
						</ul>
					@endif			
				@endif
			</div>
		</div>	
	</div>
	<div class="container">
		@if( sizeof($getBlogsObj) > 0 )
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="headline">
					<h4>BLOGS</h4>
				</div>
			</div>
		</div>
		@endif
		<div class="row featured-blog">
			@if( Auth::check() )
				@if( $getBlogsObj )
					@foreach( $getBlogsObj as $item )
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom60">
							<a href="{{ URL::to('blogs', $item['slug']) }}" class="text-deco-none">
								@if($item['featimage'] != '')		
									<div class="featuredCollegeBlock" style="background-image: url('/blogs/{{ $item['featimage'] }}');">
								@else
									<div class="featuredCollegeBlock" style="background-image: url('/blogs/default.jpg');">
								@endif	
								
								    <div class="feature-strip-college-blogs-left">
								    	<p>	<span>{{ $item['onlyCreatedDate'] }}</span>
								    		<small>{{ $item['onlyCreatedMonth'] }}</small>
								    	</p>
	  									<span title="The Featured showcase features some of the most popular blogs"></span>
									</div>
								    <div class="feature-strip-college-blogs">
								    	@if( $studentBookMarkInfoBlogs )
									    	@foreach($studentBookMarkInfoBlogs as $bookmarked)
									    		@if( $bookmarked->blog_id == $item['id'] )
										    	<a href="javascript:void(0);" class="bookmarkedHeartIcon">
										    		<input type="hidden" name="bookmarkTableID" value="{{ $bookmarked->id }}">
			  										<input type="hidden" name="blogName" value="{{ $item['slug'] }}">
			  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item['slug']) }}">
			  										<span title="The Featured showcase features some of the most popular blogs">
			  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
													</span>
												</a>
												{{--*/ break /*--}}
												@else
													<a href="javascript:void(0);" class="blogBookMarkButton">
				  										<input type="hidden" name="blogName" value="{{ $item['slug'] }}">
				  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item['slug']) }}">
				  										<span title="The Featured showcase features some of the most popular blogs">
				  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
														</span>
													</a>
												@endif
											@endforeach
										@else
											<a href="javascript:void(0);" class="blogBookMarkButton">
		  										<input type="hidden" name="blogName" value="{{ $item['slug'] }}">
		  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item['slug']) }}">
		  										<span title="The Featured showcase features some of the most popular blogs">
		  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
												</span>
											</a>
										@endif
									</div>
								</div>
								<div class="feature-blog-overlay">
									<div class="feature-desc">
	  									<div>
	  										<h4 class="feature-headline-blogs-head">{{ $item['topic'] }}</h4>
	  										<small class="feature-headline-blogs-head-sub text-uppercase">BY {{ $item['firstname'] }}</small>
	  									</div>
										<div class="feature-deatils-paragraph">
										{!! $s = substr($item['description'], 0, (90 - 3)) !!}...
										</div>
										<div class="feature-deatils text-center">
										<a href="{{ URL::to('blogs', $item['slug']) }}" class="btn-u btn-u-xs">Read more <i class="fa fa-angle-right margin-left-5"></i></a>
										</div>
									</div>
								</div>
							</a>
						</div>
					@endforeach
				@endif
			@else
				@if( $getBlogsObj )
					@foreach( $getBlogsObj as $item )
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom60">
							<a href="{{ URL::to('blogs', $item['slug']) }}" class="text-deco-none">
								@if($item['featimage'] != '')
									<div class="featuredCollegeBlock" style="background-image: url('/blogs/{{ $item['featimage'] }}');">
								@else
									<div class="featuredCollegeBlock" style="background-image: url('/blogs/default.jpg');">
								@endif
								
								    <div class="feature-strip-college-blogs-left">
								    	<p>	<span>{{ $item['onlyCreatedDate'] }}</span>
								    		<small>{{ $item['onlyCreatedMonth'] }}</small>
								    	</p>
	  									<span title="The Featured showcase features some of the most popular blogs"></span>
									</div>
								    <div class="feature-strip-college-blogs">
								    	<a href="javascript:void(0);" class="blogBookMarkButton">
	  										<input type="hidden" name="blogName" value="{{ $item['slug'] }}">
	  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item['slug']) }}">
	  										<span title="The Featured showcase features some of the most popular blogs">
	  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
											</span>
										</a>
									</div>
								</div>
								<div class="feature-blog-overlay">
									<div class="feature-desc">
	  									<div>
	  										<h4 class="feature-headline-blogs-head">{{ $item['topic'] }}</h4>
	  										<small class="feature-headline-blogs-head-sub text-uppercase">BY {{ $item['firstname'] }}</small>
	  									</div>
										<div class="feature-deatils-paragraph">
										{!! $s = substr($item['description'], 0, (90 - 3)) !!}...
										</div>
										<div class="feature-deatils text-center">
										<a href="{{ URL::to('blogs', $item['slug']) }}" class="btn-u btn-u-xs">Read more <i class="fa fa-angle-right margin-left-5"></i></a>
										</div>
									</div>
								</div>								
							</a>
						</div>
					@endforeach
				@endif			
			@endif			
		</div>
	</div>

	<!-- Testimonials & Clients -->
	<div class="testimonials-clients clearfix" id="Testimonials">
		<div class="tc-testimonials">
			<div class="testimonials-clients-block">
		        <div class="testimonials-v6">
		        @if($getTestimonialDataObj)
		            @foreach( $getTestimonialDataObj as $getTestimonial )
		            <div class="testimonials-v6-item">
		            	<div class="g-display-table g-mb-25">
							<div class="g-display-td g-text-middle" style="max-width: 120px;">
								<img class="thumbnail" src="/testimonial/{{ $getTestimonial->featuredimage }}" alt="{{ $getTestimonial->featuredimage }}">
								<!-- <a href="{{ URL::to('testimonial', $getTestimonial->testimonialsID) }}"></a> -->
							</div>
							<input type="hidden" name="testimonialsID" value="{{ $getTestimonial->testimonialsID }}">
							<div class="g-display-td g-text-middle">
				          		<strong>{{ $getTestimonial->author }}</strong>
				          		<!-- <em>{{ $getTestimonial->title }}</em> -->
							</div>
						</div>
			          	<blockquote>
						{{ str_limit($getTestimonial->description, 350) }}
			          	</blockquote>
			          	</div>
		            @endforeach
		        @endif		        
		        </div>
			</div>
		</div>
		
		<div class="tc-testimonials-clients why-we-item dark">
			<div class="testimonials-clients-block">
		        <ul class="owl-clients-v5">
		        	@if($getTestimonialDataObj)
			        	@foreach( $getTestimonialDataObj as $getTestimonial )		        	
			          		<li class="testimonials-slide-style"><img src="/testimonial/{{ $getTestimonial->featuredimage }}" alt=""></li>
			          	@endforeach
			        @endif		          
		        </ul>
			</div>
		</div>
	</div>
	<div id="collegeAmenModal" class="hide white-popup">
		<div class="detail-page-signup">
			<div class="row">
				<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">College Amenities Details</a></h2>
				<hr>
				<div class="col-md-7 col-md-offset-3">
					<p id="collegeDataRecords"></p>	
				</div>
			</div>			
		</div>
	</div>
	<!-- End Testimonials & Clients -->

	<!-- START FOOTER  -->
		@include('website/home-layouts.footer')
	<!-- END FOOTER  -->

	<!-- JS Global Compulsory -->
	{!! Html::script('home-layout/assets/plugins/jquery/jquery.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery/jquery-migrate.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
	<!-- JS Implementing Plugins -->
	{!! Html::script('home-layout/assets/plugins/back-to-top.js') !!}
	{!! Html::script('home-layout/assets/plugins/smoothScroll.js') !!}
	{!! Html::script('home-layout/assets/plugins/modernizr.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery.parallax.js') !!}
	{!! Html::script('home-layout/assets/plugins/login-signup-modal-window/js/main.js') !!}
	{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
	<!-- JS Customization -->
	{!! Html::script('home-layout/assets/js/custom.js') !!}
	<!-- JS Page Level -->
	{!! Html::script('home-layout/assets/js/app.js') !!}


	<!-- SLIDER SCROLL -->
	{!! Html::script('home-layout/assets/plugins/owl-carousel2/owl.carousel.min.js') !!}
	{!! Html::script('home-layout/assets/js/plugins/owl-carousel2.js') !!}
	{!! Html::script('assets/js/forms/student-details.js') !!}	

	<!-- ALL BookMark AJAX -->
	{!! Html::script('home-layout/assets/js/all-bookmark.js') !!}

	<!-- END -->

	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			OwlCarousel.initOwlCarousel();
		});
	</script>

	<script type="text/javascript">
		$('.functionalarea_id').on('change', function(){
			var currentID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {currentID: currentID},
	            url: "{{ URL::to('getAllDegreeName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	var HTML1 = '';
	            	HTML += '<option selected="" disabled="">Degree</option>';
	            	if( data.code == '200' ){
	            		$.each(data.degreeObj, function(i, item) {
	            			HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No degree available for this stream</option>';
	            	}

	            	$('.degree_id').empty();
	            	$('.degree_id').html(HTML);
	            	$('.degree_id').trigger('chosen:updated');
	            	$('.browseCollege').removeAttr('disabled', 'disabled');
	            	HTML1 += '<option selected="" disabled="">Branch</option>';
	            	$('.course_id').empty();
	            	$('.course_id').html(HTML1);
	            	$('.course_id').trigger('chosen:updated');
	            }
	        });
		});

		$('.degree_id').on('change', function(){
			var currentID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {currentID: currentID},
	            url: "{{ URL::to('getAllCourseName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	HTML += '<option selected="" disabled="">Branch</option>';
	            	if( data.code == '200' ){
	            		$.each(data.courseObj, function(i, item) {
	            			HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No course available for this degree</option>';
	            	}

	            	$('.course_id').empty();
	            	$('.course_id').html(HTML);
	            	$('.course_id').trigger('chosen:updated');
	            }
	        });
		});

		$('.country_id').on('change', function(){
			var countryID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {countryID: countryID},
	            url: "{{ URL::to('getAllStateName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	HTML += '<option selected="" disabled="">State</option>';
	            	if( data.code == '200' ){
	            		$.each(data.stateObj, function(i, item) {
	            			HTML += '<option value="'+data.stateObj[i].stateId+'">'+data.stateObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No state available</option>';
	            	}

	            	$('.state_id').empty();
	            	$('.state_id').html(HTML);
	            	$('.state_id').trigger('chosen:updated');
	            	$('.browseCollege').removeAttr('disabled', 'disabled');
	            }
	        });
		});

		$('.state_id').on('change', function(){
			var currentID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {currentID: currentID},
	            url: "{{ URL::to('getAllCityName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	HTML += '<option selected="" disabled="">City</option>';
	            	if( data.code == '200' ){
	            		$.each(data.cityObj, function(i, item) {
	            			HTML += '<option value="'+data.cityObj[i].cityId+'">'+data.cityObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No city available</option>';
	            	}

	            	$('.city_id').empty();
	            	$('.city_id').html(HTML);
	            	$('.city_id').trigger('chosen:updated');
	            }
	        });
		});
	</script>
	
	<script src="home-layout/assets/js/autocomplete.js"></script>
	<script type="text/javascript">
		$(function() {
	    
	    $("#field").autocomplete({
	        source: 'autocomplete/getCollegeFullName',
	        minLength: 3,
	        select: function(event, ui) {
	            // feed hidden id field
	            $("#field_id").val(ui.item.id);
	            // update number of returned rows
	            $('#results_count').html('');
	            $('.browseCollege').removeAttr('disabled', 'disabled');
	        },
	        open: function(event, ui) {
	            // update number of returned rows
	            var len = $('.ui-autocomplete > li').length;
	            //$('#results_count').html('(#' + len + ')');
	        },
	        close: function(event, ui) {
	            // update number of returned rows
	            $('#results_count').html('');
	        },
	        // mustMatch implementation
	        change: function (event, ui) {
	            if (ui.item === null) {
	                $(this).val('');
	                $('#field_id').val('');
	                $('.browseCollege').attr('disabled', 'disabled');
	            }
	        }
	    });

	    // mustMatch (no value) implementation
	    $("#field").focusout(function() {
	        if ($("#field").val() === '') {
	            $('#field_id').val('');

	        }
	    });
	});
	</script>
<!-- $('.browseCollege').removeAttr('disabled', 'disabled');
 -->	<script type="text/javascript">
		$('.leftArrowIcon').on('click', function(){
			$('.owl-college-v1 .owl-controls .owl-nav .owl-prev').click();
		});
		$('.rightArrowIcon').on('click', function(){
			$('.owl-college-v1 .owl-controls .owl-nav .owl-next').click();
		});

		$('.leftArrowIcon').on('click', function(){
			$('.owl-college-v1 .owl-controls .owl-nav .owl-prev').click();
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
		    $('#dateChange').on('change', function(){
				var dateofbirth = $(this).val();
				var HTML = '';
				var year = '';
				$.ajax({
		            headers: {
		              'X-CSRF-Token': $('input[name="_token"]').val()
		            },
		            method: "GET",
		            data: { dateofbirth: dateofbirth },
		            contentType: "application/json; charset=utf-8",
		            dataType: "json",
		            url: "{{ URL::to('/getCurrentDOBCalculate') }}",
		            success: function(data) {
	            		if( data.code == '200' ){
	            			$('.calculatedDateFromNow').text(data.calculateDate);	
	            			year = data.year;
	           	 			if( year < 18 ){
	           	 				$('input[name=parentsname]').val('');
	           	 				$('input[name=parentsnumber]').val('');
	           	 				$('.gurdianBlock').removeClass('hide');
	            			}else{
	            				$('input[name=parentsname]').val('');
	           	 				$('input[name=parentsnumber]').val('');
	            				$('.gurdianBlock').addClass('hide');
	            			}
	            		}else{

	            		}
		            }
		        });
			});
		});
	</script>
	<script type="text/javascript">
		$(document).on('click', '#collegeAmenitiesView', function(){
			var curentCollegeID = $(this).attr('class');
			
			//AJAX FOR POPUP MAGNIFIC
			$.ajax({
		        type: "POST",
		        url: '/getAllCollegeAmenitiesView',
		        data: {
		            curentCollegeID: curentCollegeID,
		        },
		        dataType: "json",
		        success: function(data){
	        		if( data.code == '200' ){
	        			var HTML = '';
	        			$('#collegeAmenModal').removeClass('hide');
	        			
	        			HTML += '<ul class="list-unstyled">';
	        			$.each(data.getAmenitiesObj, function(key, value) {
	        				HTML += '<li class="padding-top10 padding-bottom10">';
	        				if( data.getAmenitiesObj[key].facilitiesID != '' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/'+data.getAmenitiesObj[key].iconname+'" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';	
	        				}
	        				HTML += '</li>';
	        			});
	        			HTML += '</ul>';
	        			$('#collegeDataRecords').html(HTML);
						$.magnificPopup.open({
					        items: {
					            src: '#collegeAmenModal',
					        },
					        type: 'inline'
					    });
	        		}		            
		        }
		    });
		});
    </script>
</body>

</html>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Meta tags List -->
	<!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
	<meta property="fb:admins" content="">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="robots" content="index, follow">
	<meta name="twitter:card" content="app"> 
	<meta name="twitter:app:country" content="IN"> 
	<meta name="twitter:app:name:iphone" content="Admission X"> 
	<meta name="twitter:app:id:iphone" content=""> 
	<meta name="twitter:app:name:ipad" content="Admission X"> 
	<meta name="twitter:app:id:ipad" content=""> 
	<meta name="twitter:app:name:googleplay" content="Admission X"> 
	<meta name="twitter:app:id:googleplay" content="">
	<meta name="twitter:app:url:iphone" content=""> 
	<meta name="twitter:app:url:ipad" content=""> 
	<meta name="twitter:app:url:googleplay" content="">

	<meta name="og_title" property="og:title" content="AdmissionX.com">
	<meta name="og_site_name" property="og:site_name" content="AdmissionX.com">
	<meta name="og_image" property="og:image" content="">
	<meta name="og_url" property="og:url" id="og-url" content="http://www.admissionx.com">

	<!-- End -->

	<!-- Meta Two -->
	<meta name="theme-color" content="#72c02c">
	<meta name="author" content="AdmissionX">
	<meta name="description" content="AdmissionX">
	<!-- End -->

	<title>AdmissionX | Welcome Aboard!</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/images/favicon.png">
	
	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
	{!! Html::style('home-layout/assets/css/plugins/bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('home-layout/assets/css/style.css') !!}

	<!-- CSS Header and Footer -->
	{!! Html::style('home-layout/assets/css/headers/header-v6.css') !!}
	{!! Html::style('home-layout/assets/css/footers/footer-v2.css') !!}

	<!-- CSS Implementing Plugins -->
	{!! Html::style('home-layout/assets/css/plugins/animate.css') !!}
	{!! Html::style('home-layout/assets/plugins/line-icons/line-icons.css') !!}
	{!! Html::style('home-layout/assets/plugins/font-awesome/css/font-awesome.min.css') !!}
	{!! Html::style('home-layout/assets/plugins/login-signup-modal-window/css/style.css') !!}
	{!! Html::style('assets/css/blocks.css') !!}
	{!! Html::style('assets/css/pages/page_search.css') !!}
	<!-- CSS Theme -->
	<link rel="stylesheet" type="text/css" href="../home-layout/assets/css/theme-colors/default.css" id="style_color">
	{!! Html::style('home-layout/assets/css/theme-skins/dark.css') !!}

	<!-- CSS Customization -->
	{!! Html::style('home-layout/assets/css/homeLayoutCustom.css') !!}

	<!-- CSS Theme -->
  	{!! Html::style('home-layout/assets/css/agency-style.css') !!}
  	{!! Html::style('home-layout/assets/css/plugins/owl-carousel2/assets/owl.carousel.css') !!}
  	 
  	<!--SKY FORMS  -->
  	{!! Html::style('assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css') !!}
	{!! Html::style('assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css') !!}
	
	<!-- Mandatory js -->
	{!! Html::script('home-layout/assets/plugins/jquery/jquery.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery/jquery-migrate.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
	{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
	{!! Html::style('home-layout/assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css') !!}
	{!! Html::style('home-layout/assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css') !!}
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>

<body class="header-fixed">
	
	{{--*/ $currentUserID = Auth::Id(); /*--}}
	{{--*/
		$getTheLoggedInUserRole = DB::table('users')->where('id','=', Auth::Id())->select('id', 'firstname', 'userrole_id')->take(1)->get();
	/*--}}
	@if( !empty( $getTheLoggedInUserRole ) )
		@if( $getTheLoggedInUserRole[0]->userrole_id == '3' )
		<!-- START HEADER  -->
				@include('website/home-layouts.student-headerv6')
			<!-- END HEADER  -->
		@else
			<!-- START HEADER  -->
				@include('website/home-layouts.headerv6')
			<!-- END HEADER  -->
		@endif
	@else
		<!-- START HEADER  -->
			@include('website/home-layouts.headerv6')
		<!-- END HEADER  -->
	@endif
	

	<!-- Interactive Slider v2 -->
	<div class="interactive-slider-v2 lesspadding100">
		<div class="container">
			<div >
				@if(Session::has('checkEmailSucess'))
		        <div class="alert alert-success alert-dismissible" id="dialog" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		            <strong>{{ Session::get('checkEmailSucess') }}</strong>
		        </div>                        
		    	@endif
			</div>
			<div >
				@if(Session::has('returnBackSignup'))
		        <div class="alert alert-danger alert-dismissible" id="dialog" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		            <strong>{{ Session::get('returnBackSignup') }}</strong>
		        </div>                        
		    	@endif
			</div>
			<h1 class="font-size50">Welcome aboard!</h1>
			<p class="hide">Making higher education accessible, one admission at a time !</p>
			<!-- <form method="POST" action="filter/college" class="sky-form sky-form-no-block padding-top10"> -->
			<form method="GET" action="/explore/college" class="sky-form sky-form-no-block padding-top10">
				<div class="row padding-bottom20">
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 ">
						<label class="select">
							<select name="country_id[]" class="form-control search-blocks-textbox country_id rounded">
								<option selected="" disabled="">Country</option>
								@if( $countryObj )
									<option value="99">India</option>
									@foreach( $countryObj as $item )
										@if( $item->id == '99' )
											<option value="99">{{ $item->name }}</option>
										@else
											<option value="{{ $item->id }}">{{ $item->name }}</option>
										@endif
									@endforeach
								@endif
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 ">
						<label class="select">
							<select name="state_id[]" class="form-control search-blocks-textbox state_id rounded">
								<option selected="" disabled="">State</option>							
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<label class="select">
							<select name="city_id[]" class="form-control search-blocks-textbox city_id rounded">
								<option selected="" disabled="">City</option>
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<label class="select">
							<select name="functionalarea_id[]" class="functionalarea_id rounded">
								<option selected="" disabled="">Stream</option>
								@if( $functionalAreaObj )
									<option value="1">Engineering</option>
									<option value="6">Management</option>
									<option value="11">Pharmacy</option>
									@foreach( $functionalAreaObj as $item )
										<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								@endif
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 form-filter-">
						<label class="select">
							<select name="degree_id[]" class="degree_id rounded"> <!-- class="form-control search-blocks-textbox" -->
								<option selected="" disabled="">Degree</option>
							</select>
							<i></i>
						</label>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 ">
						<label class="select">
							<select name="course_id[]" class="form-control search-blocks-textbox course_id rounded">
								<option selected="" disabled="">Branch</option>
							</select>
							<i></i>
						</label>
					</div>
					
				</div>
				<div class="row padding-bottom20">
					<div class="col-xs-12 col-md-6 col-md-offset-3">
						<label class="input">
							<input id="field_id" name="field_id" type="hidden">
							<input type="text" class="form-control search-blocks-textbox rounded" name="collegeName" id="field" placeholder="Enter College Name">
							<span id="results_count"></span>
	                        <span id="empty-message"></span>	
						</label>						
					</div>
				</div>
				<div class="row margin-top20">
					<div class="col-md-4 col-md-offset-4">
						<button class="btn btn-block btn-u search-blocks-textbox searchbutton browseCollege">Browse College</button>
					</div>
				</div>
			</form>
			<br>
			<!-- <div class="col-md-4 col-md-offset-4">
			<p class="text-center"><a class="btn-u" type="button"  data-toggle="modal" href="{{ URL::to('/exam-registration') }}">Exam Registration</a></p>
			</div> -->
		</div>
	</div>

	<div class="purchase">
		<div class="container overflow-h">
			<div class="row">
				<div class="col-md-6 shadow-wrapper">
					<div class="heading heading-v4">
						<h2 class="text-green-color">Student</h2>
					</div>
					<div class="responsive-video box-shadow shadow-effect-2">
						<!-- <iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe> -->
						@if( !empty($getStudentYoutubeObj[0]->galleryName) )
							
							{{--*/ 
								$explodeYoutubeLink = explode('watch?v=', $getStudentYoutubeObj[0]->galleryName);
							/*--}}
							<iframe width="560" height="315" src="http://www.youtube.com/embed/{{$explodeYoutubeLink[1]}}" frameborder="0" allowfullscreen></iframe>
						@else
							<iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe>	
						@endif
					</div>
				</div>
				<div class="col-md-6 shadow-wrapper">
					<div class="heading heading-v4">
						<h2 class="text-green-color">College</h2>
					</div>
					<div class="responsive-video box-shadow shadow-effect-2">
						<!-- <iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe> -->
						@if( !empty($getCollegesYoutubeObj[0]->galleryName) )
							
							{{--*/ 
								$explodeYoutubeLink = explode('watch?v=', $getCollegesYoutubeObj[0]->galleryName);
							/*--}}
							<iframe width="560" height="315" src="http://www.youtube.com/embed/{{$explodeYoutubeLink[1]}}" frameborder="0" allowfullscreen></iframe>	
						@else
							<iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe>
						@endif						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg-color-light">
		<div class="container">
			@if( sizeof($getCollegesInfoObj) > 0 )
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="headline">
						<h4>COLLEGES</h4>
					</div>
				</div>
			</div>
			@endif
			<div class="row featured-blog featCollegeBookmark">
				@if(Auth::check())
					@if( $getCollegesInfoObj )
						<h1 class="hidden-xs fixTheArrow leftArrowIcon"><a href="javascript:void(0);">&nbsp;&nbsp;</a></h1>
						<h1 class="hidden-xs fixTheArrow rightArrowIcon"><a href="javascript:void(0);">&nbsp;&nbsp;</a></h1>
						<ul class="owl-college-v1 padding-left0 padding-right40 list-unstyled">
						@foreach( $getCollegesInfoObj as $item )
							<li>
								<div class="container team-v3">
									<ul class="list-unstyled row">
										<li class="col-sm-3 col-xs-6">
											<div class="team-img">
												<div class="margin-left10 margin-right10 margin-bottom60">
													<a href="{{ URL::to('college', $item->slug) }}" class="text-deco-none">
														@if( $item->logoImageName != '' )
															<div class="featuredCollegeBlock" style="background-image: url('{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->logoImageName }}');">
														@else
															<div class="featuredCollegeBlock" style="background-image: url('{{asset('assets/images')}}/no-college-logo.png');">
														@endif
														    <div class="feature-strip-college-blogs">
														    	@if( $studentCollegesInfoBlogs )
															    	@foreach($studentCollegesInfoBlogs as $bookmarked)
															    		@if( $bookmarked->college_id == $item->collegeprofileId )
																    	<a href="javascript:void(0);" class="bookmarkedHeartIcon">
																    		<input type="hidden" name="bookmarkTableID" value="{{ $bookmarked->id }}">
									  										<input type="hidden" class="collegeName" name="collegeName" value="{{ $item->slug }}">
									  										<input type="hidden" name="collegeURL" value="{{ URL::to('college', $item->slug) }}">
							  												<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses">
							  													<i class="bookmarkHeart rounded-x icon-heart"></i>
																			</span>
								      									</a>
																		{{--*/ break /*--}}
																		@else
																			<a href="javascript:void(0);" class="collegeBookMarkButton">
										  										<input type="hidden" class="collegeName" name="collegeName" value="{{ $item->slug }}">
										  										<input type="hidden" name="collegeURL" value="{{ URL::to('college', $item->slug) }}">
								  												<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses">
								  													<i class="bookmarkHeart rounded-x icon-heart"></i>
																				</span>
									      									</a>
																		@endif
																	@endforeach
																@else
																	<a href="javascript:void(0);" class="collegeBookMarkButton">
								  										<input type="hidden" class="collegeName" name="collegeName" value="{{ $item->slug }}">
								  										<input type="hidden" name="collegeURL" value="{{ URL::to('college', $item->slug) }}">
						  												<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses">
						  													<i class="bookmarkHeart rounded-x icon-heart"></i>
																		</span>
							      									</a>
																@endif		      									
						    								</div>
						    							</div>
						    							<div class="feature-college-overlay searchBox">
						    								<div class="feature-desc">
						      									<div>
						      										<h4 class="indexCollegeBox" ><a href="{{ URL::to('college', $item->slug) }}" class="indexCollegeName" >{{ $item->firstname}}</a></h4>
						      									</div>
																<div class="feature-style">
																	@foreach($getCollegeAddress as $address)
																		@if($address->collegeprofile_id == $item->collegeprofileId)
																			@if( $address->addresstypeId  == '2' )
													                        	@if( !empty( $address->addressname ) )
													                        	 {{ $address->cityName }}, {{ $address->stateName }}
																		    	@else
																		    		
																		    	@endif			                        	
													                        @else
													                        	
													                        @endif
													                     @endif
												                    @endforeach
																</div>
																<!-- <div class="feature-deatils">
																	@if( !empty($collegeFacilityDataObj) )
								 									<p class="clearBothNow text-center margin-top10" ><a href="javascript:void(0);" id="collegeAmenitiesView" class="{{ $item->collegeprofileId }}" style="color: #8a5d5e;">View  Facilities</a></p>
								 									@endif -->

																<!-- Available Facilities
																	@if( $collegeFacilityDataObj )
																		<div class="row">
																			@foreach( $collegeFacilityDataObj as $facility )
																				@if($facility->collegeprofile_id == $item->collegeprofileId)
																				<div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
																					<p class="feature-facility-icon">
																					@if( $facility->facilitiesId == '1' )
																					<img src="/home-layout/assets/img/facility/hostel.png" width="16"> 
																					@elseif( $facility->facilitiesId == '2' )
																					<img src="/home-layout/assets/img/facility/transport.png" width="16"> 
																					@elseif( $facility->facilitiesId == '3' )
																					<img src="/home-layout/assets/img/facility/cafeteria.png" width="16"> 
																					@elseif( $facility->facilitiesId == '4' )
																					<img src="/home-layout/assets/img/facility/audotarium.png" width="16"> 
																					@elseif( $facility->facilitiesId == '5' )
																					<img src="/home-layout/assets/img/facility/library.png" width="16"> 
																					@elseif( $facility->facilitiesId == '6' )
																					<img src="/home-layout/assets/img/facility/labs.png" width="16"> 
																					@elseif( $facility->facilitiesId == '7' )
																					<img src="/home-layout/assets/img/facility/gym.png" width="16"> 
																					@elseif( $facility->facilitiesId == '8' )
																					<img src="/home-layout/assets/img/facility/wifi.png" width="16">
																					@elseif( $facility->facilitiesId == '9' )
																					<img src="/home-layout/assets/img/facility/internet.png" width="16"> 
																					@endif
																					</p>
																				</div>
																				@endif
																			@endforeach
																		</div>
																	@endif -->
																					<!-- {{ $facility->facilitiesName }} -->
																<!-- </div> -->
																<!-- <div class="feature-deatils text-center">
																<a href="{{ URL::to('college', $item->slug) }}" class="btn-u btn-u-xs viewCollege">View Now <i class="fa fa-angle-right margin-left-5"></i></a>
																</div> -->
						    								</div>
														</div>
													</a>
												</div>
												<div class="team-hover">
													<span>Available Facilities</span>
													<small></small>
													<ul class="list-inline team-social-v3 margin-top30">
														@if( $collegeFacilityDataObj )
															<div class="row collegefacility">
																@foreach( $collegeFacilityDataObj as $facility )
																	@if($facility->collegeprofile_id == $item->collegeprofileId)
																	<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1">
																		<p class="feature-facility-icon">
																			<img src="/home-layout/assets/img/facility/icon/{{ $facility->iconname }}" width="64"> 
																		</p>
																	</div>
																	@endif
																@endforeach
															</div>
														@endif
													</ul>
													<div class="feature-deatils text-center margin-top20">
														<a href="{{ URL::to('college', $item->slug) }}" class="btn-u btn-u-md viewCollege viewCOllege">View Now <i class="fa fa-angle-right margin-left-5"></i></a>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
								
							</li>
						@endforeach
						</ul>
					@endif
				@else
					@if( $getCollegesInfoObj )
						<h1 class="hidden-xs fixTheArrow leftArrowIcon"><a href="javascript:void(0);">&nbsp;&nbsp;</a></h1>
						<h1 class="hidden-xs fixTheArrow rightArrowIcon"><a href="javascript:void(0);">&nbsp;&nbsp;</a></h1>
						<ul class="owl-college-v1 padding-left0 padding-right40 list-unstyled">
						@foreach( $getCollegesInfoObj as $item )
							<li>
								<div class="container team-v3">
									<ul class="list-unstyled row">
										<li class="col-sm-3 col-xs-6">
											<div class="team-img">
												<div class="margin-left10 margin-right10 margin-bottom60">
													<a href="{{ URL::to('college', $item->slug) }}" class="text-deco-none">
														@if( $item->logoImageName != '' )
															<div class="featuredCollegeBlock" style="background-image: url('{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->logoImageName }}');">
														@else
															<div class="featuredCollegeBlock" style="background-image: url('{{asset('assets/images')}}/no-college-logo.png');">
														@endif
														    <div class="feature-strip-college-blogs">
						      									<a href="javascript:void(0);" class="collegeBookMarkButton">
							  										<input type="hidden" class="collegeName" name="collegeName" value="{{ $item->slug }}">
							  										<input type="hidden" name="collegeURL" value="{{ URL::to('college', $item->slug) }}">
					  												<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses">
					  													<i class="bookmarkHeart rounded-x icon-heart"></i>
																	</span>
						      									</a>
						    								</div>
						    							</div>
						    							<div class="feature-college-overlay">
						    								<div class="feature-desc">
						      									<div>
						      										<h4 class="indexCollegeBox"><a href="{{ URL::to('college', $item->slug) }}" class="indexCollegeName" >{{ $item->firstname}}</a></h4>
						      									</div>
																<div class="feature-style">
																@foreach($getCollegeAddress as $address)
																		@if($address->collegeprofile_id == $item->collegeprofileId)
																			@if( $address->addresstypeId  == '2' )
													                        	@if( !empty( $address->addressname ) )
													                        	 {{ $address->cityName }}, {{ $address->stateName }}
																		    	@else
																		    		
																		    	@endif			                        	
													                        @else
													                        	
													                        @endif
													                     @endif
												                    @endforeach
																</div>
																<!--<div class="feature-deatils">
																 @if( !empty($collegeFacilityDataObj) )
							 									<p class="clearBothNow text-center margin-top10"><a href="javascript:void(0);" id="collegeAmenitiesView" class="{{ $item->collegeprofileId }}" style="color: #8a5d5e;">View Facilities</a></p>
							 									@endif -->

																<!-- Available Facilities
																	@if( $collegeFacilityDataObj )
																		<div class="row">
																			@foreach( $collegeFacilityDataObj as $facility )
																				@if($facility->collegeprofile_id == $item->collegeprofileId)
																				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
																					<p class="feature-facility-icon">
																					@if( $facility->facilitiesId == '1' )
																					<img src="/home-layout/assets/img/facility/hostel.png" width="16"> 
																					@elseif( $facility->facilitiesId == '2' )
																					<img src="/home-layout/assets/img/facility/transport.png" width="16"> 
																					@elseif( $facility->facilitiesId == '3' )
																					<img src="/home-layout/assets/img/facility/cafeteria.png" width="16"> 
																					@elseif( $facility->facilitiesId == '4' )
																					<img src="/home-layout/assets/img/facility/audotarium.png" width="16"> 
																					@elseif( $facility->facilitiesId == '5' )
																					<img src="/home-layout/assets/img/facility/library.png" width="16"> 
																					@elseif( $facility->facilitiesId == '6' )
																					<img src="/home-layout/assets/img/facility/labs.png" width="16"> 
																					@elseif( $facility->facilitiesId == '7' )
																					<img src="/home-layout/assets/img/facility/gym.png" width="16"> 
																					@elseif( $facility->facilitiesId == '8' )
																					<img src="/home-layout/assets/img/facility/wifi.png" width="16">
																					@elseif( $facility->facilitiesId == '9' )
																					<img src="/home-layout/assets/img/facility/internet.png" width="16"> 
																					@endif
																					</p>
																				</div>
																				@endif
																			@endforeach
																		</div>
																	@endif -->
																					<!-- {{ $facility->facilitiesName }} -->
																<!--</div>
																 <div class="feature-deatils text-center">
																<a href="{{ URL::to('college', $item->slug) }}" class="btn-u btn-u-xs viewCollege">View Now <i class="fa fa-angle-right margin-left-5"></i></a>
																</div> -->
						    								</div>
														</div>

													</a>
												</div>
												<div class="team-hover">
													<span>Available Facilities</span>
													<ul class="list-inline team-social-v3 margin-top30">
														@if( !empty($collegeFacilityDataObj) )
															<div class="row collegefacility">
																@foreach( $collegeFacilityDataObj as $facility )
																	@if($facility->collegeprofile_id == $item->collegeprofileId)
																	<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1">
																		<p class="feature-facility-icon tooltips" data-toggle="tooltip" data-placement="right" title="{{ $facility->facilitiesName }}">
																			<img src="/home-layout/assets/img/facility/icon/{{ $facility->iconname }}" width="64"> 
																		</p>
																	</div>
																	@endif
																@endforeach
															</div>
														@endif
													</ul>
													<div class="feature-deatils text-center margin-top20">
														<a href="{{ URL::to('college', $item->slug) }}" class="btn-u btn-u-md viewCollege viewCOllege">View Now <i class="fa fa-angle-right margin-left-5"></i></a>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</li>
						@endforeach
						</ul>
					@endif			
				@endif
			</div>
		</div>	
	</div>
	<div class="container">
		@if( sizeof($getBlogsObj) > 0 )
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="headline">
					<h4>BLOGS</h4>
				</div>
			</div>
		</div>
		@endif
		<div class="row featured-blog">
			@if( Auth::check() )
				@if( $getBlogsObj )
					@foreach( $getBlogsObj as $item )
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom60">
							<a href="{{ URL::to('blogs', $item['slug']) }}" class="text-deco-none">
								@if($item['featimage'] != '')		
									<div class="featuredCollegeBlock" style="background-image: url('/blogs/{{ $item['featimage'] }}');">
								@else
									<div class="featuredCollegeBlock" style="background-image: url('/blogs/default.jpg');">
								@endif	
								
								    <div class="feature-strip-college-blogs-left">
								    	<p>	<span>{{ $item['onlyCreatedDate'] }}</span>
								    		<small>{{ $item['onlyCreatedMonth'] }}</small>
								    	</p>
	  									<span title="The Featured showcase features some of the most popular blogs"></span>
									</div>
								    <div class="feature-strip-college-blogs">
								    	@if( $studentBookMarkInfoBlogs )
									    	@foreach($studentBookMarkInfoBlogs as $bookmarked)
									    		@if( $bookmarked->blog_id == $item['id'] )
										    	<a href="javascript:void(0);" class="bookmarkedHeartIcon">
										    		<input type="hidden" name="bookmarkTableID" value="{{ $bookmarked->id }}">
			  										<input type="hidden" name="blogName" value="{{ $item['slug'] }}">
			  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item['slug']) }}">
			  										<span title="The Featured showcase features some of the most popular blogs">
			  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
													</span>
												</a>
												{{--*/ break /*--}}
												@else
													<a href="javascript:void(0);" class="blogBookMarkButton">
				  										<input type="hidden" name="blogName" value="{{ $item['slug'] }}">
				  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item['slug']) }}">
				  										<span title="The Featured showcase features some of the most popular blogs">
				  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
														</span>
													</a>
												@endif
											@endforeach
										@else
											<a href="javascript:void(0);" class="blogBookMarkButton">
		  										<input type="hidden" name="blogName" value="{{ $item['slug'] }}">
		  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item['slug']) }}">
		  										<span title="The Featured showcase features some of the most popular blogs">
		  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
												</span>
											</a>
										@endif
									</div>
								</div>
								<div class="feature-blog-overlay">
									<div class="feature-desc">
	  									<div>
	  										<h4 class="feature-headline-blogs-head">{{ $item['topic'] }}</h4>
	  										<small class="feature-headline-blogs-head-sub text-uppercase">BY {{ $item['firstname'] }}</small>
	  									</div>
										<div class="feature-deatils-paragraph">
										{!! $s = substr($item['description'], 0, (90 - 3)) !!}...
										</div>
										<div class="feature-deatils text-center">
										<a href="{{ URL::to('blogs', $item['slug']) }}" class="btn-u btn-u-xs">Read more <i class="fa fa-angle-right margin-left-5"></i></a>
										</div>
									</div>
								</div>
							</a>
						</div>
					@endforeach
				@endif
			@else
				@if( $getBlogsObj )
					@foreach( $getBlogsObj as $item )
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom60">
							<a href="{{ URL::to('blogs', $item['slug']) }}" class="text-deco-none">
								@if($item['featimage'] != '')
									<div class="featuredCollegeBlock" style="background-image: url('/blogs/{{ $item['featimage'] }}');">
								@else
									<div class="featuredCollegeBlock" style="background-image: url('/blogs/default.jpg');">
								@endif
								
								    <div class="feature-strip-college-blogs-left">
								    	<p>	<span>{{ $item['onlyCreatedDate'] }}</span>
								    		<small>{{ $item['onlyCreatedMonth'] }}</small>
								    	</p>
	  									<span title="The Featured showcase features some of the most popular blogs"></span>
									</div>
								    <div class="feature-strip-college-blogs">
								    	<a href="javascript:void(0);" class="blogBookMarkButton">
	  										<input type="hidden" name="blogName" value="{{ $item['slug'] }}">
	  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item['slug']) }}">
	  										<span title="The Featured showcase features some of the most popular blogs">
	  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
											</span>
										</a>
									</div>
								</div>
								<div class="feature-blog-overlay">
									<div class="feature-desc">
	  									<div>
	  										<h4 class="feature-headline-blogs-head">{{ $item['topic'] }}</h4>
	  										<small class="feature-headline-blogs-head-sub text-uppercase">BY {{ $item['firstname'] }}</small>
	  									</div>
										<div class="feature-deatils-paragraph">
										{!! $s = substr($item['description'], 0, (90 - 3)) !!}...
										</div>
										<div class="feature-deatils text-center">
										<a href="{{ URL::to('blogs', $item['slug']) }}" class="btn-u btn-u-xs">Read more <i class="fa fa-angle-right margin-left-5"></i></a>
										</div>
									</div>
								</div>								
							</a>
						</div>
					@endforeach
				@endif			
			@endif			
		</div>
	</div>

	<!-- Testimonials & Clients -->
	<div class="testimonials-clients clearfix" id="Testimonials">
		<div class="tc-testimonials">
			<div class="testimonials-clients-block">
		        <div class="testimonials-v6">
		        @if($getTestimonialDataObj)
		            @foreach( $getTestimonialDataObj as $getTestimonial )
		            <div class="testimonials-v6-item">
		            	<div class="g-display-table g-mb-25">
							<div class="g-display-td g-text-middle" style="max-width: 120px;">
								<img class="thumbnail" src="/testimonial/{{ $getTestimonial->featuredimage }}" alt="{{ $getTestimonial->featuredimage }}">
								<!-- <a href="{{ URL::to('testimonial', $getTestimonial->testimonialsID) }}"></a> -->
							</div>
							<input type="hidden" name="testimonialsID" value="{{ $getTestimonial->testimonialsID }}">
							<div class="g-display-td g-text-middle">
				          		<strong>{{ $getTestimonial->author }}</strong>
				          		<!-- <em>{{ $getTestimonial->title }}</em> -->
							</div>
						</div>
			          	<blockquote>
						{{ str_limit($getTestimonial->description, 350) }}
			          	</blockquote>
			          	</div>
		            @endforeach
		        @endif		        
		        </div>
			</div>
		</div>
		
		<div class="tc-testimonials-clients why-we-item dark">
			<div class="testimonials-clients-block">
		        <ul class="owl-clients-v5">
		        	@if($getTestimonialDataObj)
			        	@foreach( $getTestimonialDataObj as $getTestimonial )		        	
			          		<li class="testimonials-slide-style"><img src="/testimonial/{{ $getTestimonial->featuredimage }}" alt=""></li>
			          	@endforeach
			        @endif		          
		        </ul>
			</div>
		</div>
	</div>
	<div id="collegeAmenModal" class="hide white-popup">
		<div class="detail-page-signup">
			<div class="row">
				<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">College Amenities Details</a></h2>
				<hr>
				<div class="col-md-7 col-md-offset-3">
					<p id="collegeDataRecords"></p>	
				</div>
			</div>			
		</div>
	</div>
	<!-- End Testimonials & Clients -->

	<!-- START FOOTER  -->
		@include('website/home-layouts.footer')
	<!-- END FOOTER  -->

	<!-- JS Global Compulsory -->
	{!! Html::script('home-layout/assets/plugins/jquery/jquery.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery/jquery-migrate.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
	<!-- JS Implementing Plugins -->
	{!! Html::script('home-layout/assets/plugins/back-to-top.js') !!}
	{!! Html::script('home-layout/assets/plugins/smoothScroll.js') !!}
	{!! Html::script('home-layout/assets/plugins/modernizr.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery.parallax.js') !!}
	{!! Html::script('home-layout/assets/plugins/login-signup-modal-window/js/main.js') !!}
	{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
	<!-- JS Customization -->
	{!! Html::script('home-layout/assets/js/custom.js') !!}
	<!-- JS Page Level -->
	{!! Html::script('home-layout/assets/js/app.js') !!}


	<!-- SLIDER SCROLL -->
	{!! Html::script('home-layout/assets/plugins/owl-carousel2/owl.carousel.min.js') !!}
	{!! Html::script('home-layout/assets/js/plugins/owl-carousel2.js') !!}
	{!! Html::script('assets/js/forms/student-details.js') !!}	

	<!-- ALL BookMark AJAX -->
	{!! Html::script('home-layout/assets/js/all-bookmark.js') !!}

	<!-- END -->

	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			OwlCarousel.initOwlCarousel();
		});
	</script>

	<script type="text/javascript">
		$('.functionalarea_id').on('change', function(){
			var currentID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {currentID: currentID},
	            url: "{{ URL::to('getAllDegreeName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	var HTML1 = '';
	            	HTML += '<option selected="" disabled="">Degree</option>';
	            	if( data.code == '200' ){
	            		$.each(data.degreeObj, function(i, item) {
	            			HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No degree available for this stream</option>';
	            	}

	            	$('.degree_id').empty();
	            	$('.degree_id').html(HTML);
	            	$('.degree_id').trigger('chosen:updated');
	            	$('.browseCollege').removeAttr('disabled', 'disabled');
	            	HTML1 += '<option selected="" disabled="">Branch</option>';
	            	$('.course_id').empty();
	            	$('.course_id').html(HTML1);
	            	$('.course_id').trigger('chosen:updated');
	            }
	        });
		});

		$('.degree_id').on('change', function(){
			var currentID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {currentID: currentID},
	            url: "{{ URL::to('getAllCourseName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	HTML += '<option selected="" disabled="">Branch</option>';
	            	if( data.code == '200' ){
	            		$.each(data.courseObj, function(i, item) {
	            			HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No course available for this degree</option>';
	            	}

	            	$('.course_id').empty();
	            	$('.course_id').html(HTML);
	            	$('.course_id').trigger('chosen:updated');
	            }
	        });
		});

		$('.country_id').on('change', function(){
			var countryID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {countryID: countryID},
	            url: "{{ URL::to('getAllStateName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	HTML += '<option selected="" disabled="">State</option>';
	            	if( data.code == '200' ){
	            		$.each(data.stateObj, function(i, item) {
	            			HTML += '<option value="'+data.stateObj[i].stateId+'">'+data.stateObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No state available</option>';
	            	}

	            	$('.state_id').empty();
	            	$('.state_id').html(HTML);
	            	$('.state_id').trigger('chosen:updated');
	            	$('.browseCollege').removeAttr('disabled', 'disabled');
	            }
	        });
		});

		$('.state_id').on('change', function(){
			var currentID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {currentID: currentID},
	            url: "{{ URL::to('getAllCityName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	HTML += '<option selected="" disabled="">City</option>';
	            	if( data.code == '200' ){
	            		$.each(data.cityObj, function(i, item) {
	            			HTML += '<option value="'+data.cityObj[i].cityId+'">'+data.cityObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No city available</option>';
	            	}

	            	$('.city_id').empty();
	            	$('.city_id').html(HTML);
	            	$('.city_id').trigger('chosen:updated');
	            }
	        });
		});
	</script>
	
	<script src="home-layout/assets/js/autocomplete.js"></script>
	<script type="text/javascript">
		$(function() {
	    
	    $("#field").autocomplete({
	        source: 'autocomplete/getCollegeFullName',
	        minLength: 3,
	        select: function(event, ui) {
	            // feed hidden id field
	            $("#field_id").val(ui.item.id);
	            // update number of returned rows
	            $('#results_count').html('');
	            $('.browseCollege').removeAttr('disabled', 'disabled');
	        },
	        open: function(event, ui) {
	            // update number of returned rows
	            var len = $('.ui-autocomplete > li').length;
	            //$('#results_count').html('(#' + len + ')');
	        },
	        close: function(event, ui) {
	            // update number of returned rows
	            $('#results_count').html('');
	        },
	        // mustMatch implementation
	        change: function (event, ui) {
	            if (ui.item === null) {
	                $(this).val('');
	                $('#field_id').val('');
	                $('.browseCollege').attr('disabled', 'disabled');
	            }
	        }
	    });

	    // mustMatch (no value) implementation
	    $("#field").focusout(function() {
	        if ($("#field").val() === '') {
	            $('#field_id').val('');

	        }
	    });
	});
	</script>
<!-- $('.browseCollege').removeAttr('disabled', 'disabled');
 -->	<script type="text/javascript">
		$('.leftArrowIcon').on('click', function(){
			$('.owl-college-v1 .owl-controls .owl-nav .owl-prev').click();
		});
		$('.rightArrowIcon').on('click', function(){
			$('.owl-college-v1 .owl-controls .owl-nav .owl-next').click();
		});

		$('.leftArrowIcon').on('click', function(){
			$('.owl-college-v1 .owl-controls .owl-nav .owl-prev').click();
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
		    $('#dateChange').on('change', function(){
				var dateofbirth = $(this).val();
				var HTML = '';
				var year = '';
				$.ajax({
		            headers: {
		              'X-CSRF-Token': $('input[name="_token"]').val()
		            },
		            method: "GET",
		            data: { dateofbirth: dateofbirth },
		            contentType: "application/json; charset=utf-8",
		            dataType: "json",
		            url: "{{ URL::to('/getCurrentDOBCalculate') }}",
		            success: function(data) {
	            		if( data.code == '200' ){
	            			$('.calculatedDateFromNow').text(data.calculateDate);	
	            			year = data.year;
	           	 			if( year < 18 ){
	           	 				$('input[name=parentsname]').val('');
	           	 				$('input[name=parentsnumber]').val('');
	           	 				$('.gurdianBlock').removeClass('hide');
	            			}else{
	            				$('input[name=parentsname]').val('');
	           	 				$('input[name=parentsnumber]').val('');
	            				$('.gurdianBlock').addClass('hide');
	            			}
	            		}else{

	            		}
		            }
		        });
			});
		});
	</script>
	<script type="text/javascript">
		$(document).on('click', '#collegeAmenitiesView', function(){
			var curentCollegeID = $(this).attr('class');
			
			//AJAX FOR POPUP MAGNIFIC
			$.ajax({
		        type: "POST",
		        url: '/getAllCollegeAmenitiesView',
		        data: {
		            curentCollegeID: curentCollegeID,
		        },
		        dataType: "json",
		        success: function(data){
	        		if( data.code == '200' ){
	        			var HTML = '';
	        			$('#collegeAmenModal').removeClass('hide');
	        			
	        			HTML += '<ul class="list-unstyled">';
	        			$.each(data.getAmenitiesObj, function(key, value) {
	        				HTML += '<li class="padding-top10 padding-bottom10">';
	        				if( data.getAmenitiesObj[key].facilitiesID != '' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/'+data.getAmenitiesObj[key].iconname+'" width="32" alt="'+data.getAmenitiesObj[key].facilitiesName+'"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';	
	        				}
	        				HTML += '</li>';
	        			});
	        			HTML += '</ul>';
	        			$('#collegeDataRecords').html(HTML);
						$.magnificPopup.open({
					        items: {
					            src: '#collegeAmenModal',
					        },
					        type: 'inline'
					    });
	        		}		            
		        }
		    });
		});
    </script>
</body>

</html>
