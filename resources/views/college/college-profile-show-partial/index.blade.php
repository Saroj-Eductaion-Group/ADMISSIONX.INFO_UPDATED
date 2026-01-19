@extends('website/new-design-layouts.master')

{{--*/  $collegeTitle = '' /*--}}
{{--*/  $collegeDesc = '' /*--}}
{{--*/ $baseURLWeb = env('APP_URL') /*--}}
@if( $getCollegeDetailObj )	
	@foreach( $getCollegeDetailObj as $getCollegeName )
		{{--*/ $collegeTitle = $getCollegeName->firstname /*--}}
		{{--*/ $collegeDesc = $getCollegeName->description /*--}}
	@endforeach
@endif


{{--*/  $collegeLogoImg = '' /*--}}
{{--*/  $collegeLogoImgWidth = '' /*--}}
{{--*/  $collegeLogoImgHeight = '' /*--}}

@if( $getCollegeProfileDataObj )
	@foreach( $getCollegeProfileDataObj as $collegeData )
		@if( $collegeData->galleryName != '' )
			{{--*/  $collegeLogoImg = $baseURLWeb."/gallery/$slugUrl/$collegeData->galleryName" /*--}}
			{{--*/  $collegeLogoImgWidth = $collegeData->width /*--}}
			{{--*/  $collegeLogoImgHeight = $collegeData->height /*--}}
		@else
			{{--*/  $collegeLogoImg = $baseURLWeb."/assets/images/no-college-logo.png" /*--}}
			{{--*/  $collegeLogoImgWidth = '825' /*--}}
			{{--*/  $collegeLogoImgHeight = '1000' /*--}}

		@endif
	@endforeach
@endif

@section('page-title-name')
	{{ $collegeTitle }}
@endsection
@section('meta-tags-seo')
<meta property="fb:admins" content="">
<meta name="title" content="{{ $collegeTitle }}">
<meta name="description" content="{{ str_limit($collegeDesc, 100) }}">
<meta name="keywords" content="{{ $collegeTitle }}">
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

<meta name="og_url" property="og:url" id="og-url" content="{{ env('APP_URL') }}/college/{{$slugUrl}}" />
<meta property="og:type"          content="website" />
<meta name="og_image" property="og:image" content="{{ $collegeLogoImg }}" />
<meta name="og_width" property="og:width" content="{{ $collegeLogoImgWidth }}" />
<meta name="og_height" property="og:height" content="{{ $collegeLogoImgHeight }}" />
<meta name="og_title" property="og:title" content="{{ $collegeTitle }}" />
<meta name="og_description" property="og:description"   content="{{ str_limit($collegeDesc, 100) }}" />
<meta name="og_site_name" property="og:site_name" content="AdmissionX.com" />

@endsection

@section('styles')
{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style type="text/css">
	/* text-based popup styling */
	.white-popup {
	  position: relative;
	  background: #FFF;
	  padding: 25px;
	  width: auto;
	  max-width: 800px;
	  margin: 0 auto;
	}

	/* 

	====== Zoom effect ======

	*/
	.mfp-zoom-in {
	  /* start state */
	  /* animate in */
	  /* animate out */
	}
	.mfp-zoom-in .mfp-with-anim {
	  opacity: 0;
	  transition: all 0.2s ease-in-out;
	  transform: scale(0.8);
	}
	.mfp-zoom-in.mfp-bg {
	  opacity: 0;
	  transition: all 0.3s ease-out;
	}
	.mfp-zoom-in.mfp-ready .mfp-with-anim {
	  opacity: 1;
	  transform: scale(1);
	}
	.mfp-zoom-in.mfp-ready.mfp-bg {
	  opacity: 0.8;
	}
	.mfp-zoom-in.mfp-removing .mfp-with-anim {
	  transform: scale(0.8);
	  opacity: 0;
	}
	.mfp-zoom-in.mfp-removing.mfp-bg {
	  opacity: 0;
	}
	.course-details{color: #000;}
.college-reviews{background-color: #f7f7f7;padding-top: 20px;padding-bottom: 20px;margin-bottom: 20px;border-radius: 14px;box-shadow: 0px 1px 5px 2px #fbfbfb;margin-left: 35px;margin-right: 35px;}
.college-reviews h2{text-align: center;font-size: 25px;font-weight: 700;color: #d40d12;margin-bottom: 0;}
.college-reviews h4{text-align: center;font-size: 15px;font-weight: 400;color: #555;margin-top: 0px;}
.main-top-college-block{border: 1px solid #ccc;margin-top: 30px;margin-bottom: 30px;border-radius: 5px;}
.main-top-college-block h2{text-align: center;font-size: 20px;font-weight: 700;letter-spacing: 2px;border-bottom: 1px solid #adadad;color: #FFF;padding-bottom: 5px; font-family: 'Open Sans', sans-serif;margin-top: 0px; padding-top: 5px;}
.top-course-college{margin-bottom: 10px !important;margin-top: 10px !important;}
.top-course-college li{padding: 5px 0;border-bottom: 1px solid #ccc;}
.top-course-college li:last-child{border-bottom: none;}
.top-course-college img{}
.top-course-college a{font-size: 13px;font-weight: 600;font-family: 'Open Sans', sans-serif;color: #353535;}
.top-course-college p{font-size: 12px;font-weight: 500;color: #545454;margin-bottom: 0px;}
.blockBGStyle{width: 100%; background-size: contain;  background-position: center; background-repeat: no-repeat;}
.blockStyleProfileOverFlow{overflow: hidden;}
.blockStyleProfile{display: block;width: 250px; height: 180px;}
.blockStyleProfileOverFlow{overflow: hidden;}
</style>
@endsection

@section('content')
	<div class="wrapper">
		
		<div class="container content profile">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					@if(Session::has('rightNowCollegeLogIn'))
						<div class="alert alert-info fade in text-center">
	                        <strong>{{ Session::get('rightNowCollegeLogIn') }} <a class="alert-link" href="{{ URL::to('login') }}">dashboard</a>.</strong>                        
	                    </div>
	            	@endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					@if( $getCollegeProfileDataObj )
						@foreach( $getCollegeProfileDataObj as $collegeData )
							@if( $collegeData->galleryName != '' )
							<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('gallery/')}}/{{ $slugUrl }}/{{ $collegeData->galleryName }}');">
								<div class="pull-right">
									<div class="fb-share-button" data-href="{{ env('APP_URL') }}/college/{{$slugUrl}}" data-layout="button" data-size="large" data-mobile-iframe="true">
										<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F{{$slugUrl}}&amp;src=sdkpreparse"><img src="/home-layout/assets/img/icons/other/share-on-facebook.png"></a>
									</div>
								</div>
							</div>
							@else
								<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png'); ">
									<div class="pull-right">
										<div class="fb-share-button" data-href="{{ env('APP_URL') }}/college/{{$slugUrl}}" data-layout="button" data-size="large" data-mobile-iframe="true">
											<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F{{$slugUrl}}&amp;src=sdkpreparse"><img src="/home-layout/assets/img/icons/other/share-on-facebook.png"></a>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					@else
						<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png'); ">
							<div class="pull-right">
								<div class="fb-share-button" data-href="{{ env('APP_URL') }}/college/{{$slugUrl}}" data-layout="button" data-size="large" data-mobile-iframe="true">
									<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F{{$slugUrl}}&amp;src=sdkpreparse"><img src="/home-layout/assets/img/icons/other/share-on-facebook.png"></a>
								</div>
							</div>
						</div>
					@endif
					
				</div>
				<div class="col-md-6">
					<h1 class="">
						<a class="hover-effect college-name-style-black fontSize37" href="#">
							@if( $getCollegeDetailObj )
								{{--*/  $collegeFullName = ''; /*--}}
								@foreach( $getCollegeDetailObj as $getCollegeName )
									{{ $getCollegeName->firstname }}
									{{--*/ $collegeFullName = $getCollegeName->firstname; /*--}}
								@endforeach
							@endif						
						</a>
					</h1>
					<p>
						<span id="combinedAddress" class="fontSize17 hide"></span>
						@foreach( $getCollegeAddressObj as $getAddress )
							@if( $getAddress->addresstypeId  == '1' )
								@if( !empty( $getAddress->name ) )
									<p id="redAdd" class="hide"><span class="label label-success">{{ $getAddress->addresstypeName }}</span> : <span class="minimizeRegiAddress" id="firstAddressHere">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->landmark }}, {{ $getAddress->cityName }}, {{ $getAddress->postalcode }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong></span></p>
						    	@else
						    		
						    	@endif
	                        @elseif( $getAddress->addresstypeId  == '2' )
	                        	@if( !empty( $getAddress->name ) )
	                        		<p id="camAdd" class="hide"><span class="label label-warning">{{ $getAddress->addresstypeName }}</span> : <span class="minimizeCampusAddress" id="secondAddressHere">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->landmark }}, {{ $getAddress->cityName }}, {{ $getAddress->postalcode }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong></span></p>
						    	@else
						    		
						    	@endif			                        	
	                        @else
	                        	
	                        @endif
	                    @endforeach
					</p>
					
					
					@if( $collegeFacilityDataObj )
						<div class="row">
							@foreach( $collegeFacilityDataObj as $item )
								<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
									<p class="tooltips" data-toggle="tooltip" data-placement="right" title="{{ $item->description }}">
									<!-- @if( $item->facilitiesId == '1' )
									<img src="/home-layout/assets/img/facility/hostel.png" width="32" > 
									@elseif( $item->facilitiesId == '2' )
									<img src="/home-layout/assets/img/facility/transport.png" width="32"> 
									@elseif( $item->facilitiesId == '3' )
									<img src="/home-layout/assets/img/facility/cafeteria.png" width="32"> 
									@elseif( $item->facilitiesId == '4' )
									<img src="/home-layout/assets/img/facility/audotarium.png" width="32"> 
									@elseif( $item->facilitiesId == '5' )
									<img src="/home-layout/assets/img/facility/library.png" width="32"> 
									@elseif( $item->facilitiesId == '6' )
									<img src="/home-layout/assets/img/facility/labs.png" width="32"> 
									@elseif( $item->facilitiesId == '7' )
									<img src="/home-layout/assets/img/facility/gym.png" width="32"> 
									@elseif( $item->facilitiesId == '8' )
									<img src="/home-layout/assets/img/facility/wifi.png" width="32">
									@elseif( $item->facilitiesId == '9' )
									<img src="/home-layout/assets/img/facility/internet.png" width="32"> 
									@endif -->
									<img src="/home-layout/assets/img/facility/{{ $item->iconname }}" width="32"> 
									{{ $item->facilitiesName }}
									</p>
								</div>
							@endforeach
						</div>
					@endif


				</div>
				<div class="col-md-3">
					<div class="college-reviews">
						<h2>9.7/10</h2>
						<h4>Based On User Reviews</h4>
					</div>
					<ul class="list-inline text-center">
						@if( $getCollegeDetailObj )
							@foreach( $getCollegeDetailObj as $getCollegeName )
								@if( $getCollegeName->review == '1' )
									<li><a href="javascript:void(0);" class="badgesSize" title="This profile is successfully reviewed">
										<img src="/home-layout/assets/img/icons/other/like.png" width="32">
									</a></li>
								@else
									<li><a href="javascript:void(0);" class="badgesSize" title="This profile is under review">
										<img src="/home-layout/assets/img/icons/other/dislike.png" width="32">
									</a></li>
								@endif

								@if( $getCollegeName->verified == '0' )
									<li><a href="javascript:void(0);" class="badgesSize" title="This profile is not verified">
										<img src="/home-layout/assets/img/icons/other/envelope.png" width="32">
									</a></li>
								@endif
							@endforeach
						@endif
						<li>
							@if( $getBookMarkedCollegeStaus )
								<a href="javascript:void(0);" class="bookmarkedHeartIcon">
									<input type="hidden" name="bookmarkTableID" value="{{ $getBookMarkedCollegeStaus[0]->id }}">
									<input type="hidden" class="collegeName" name="collegeName" value="{{ $slugUrl }}">
									<input type="hidden" name="collegeURL" value="{{ URL::to('college', $slugUrl) }}">
									<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses" class="white-bg">
										<i class="bookmarkHeart rounded-x icon-heart fa-2x"></i>
									</span>
								</a>
							@else
								<a href="javascript:void(0);" class="collegeBookMarkButton">
									<input type="hidden" class="collegeName" name="collegeName" value="{{ $slugUrl }}">
									<input type="hidden" name="collegeURL" value="{{ URL::to('college', $slugUrl) }}">
									<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses" class="white-bg">
										<i class="bookmarkHeart rounded-x icon-heart fa-2x"></i>
									</span>
								</a>
							@endif							
						</li>
					</ul>
					<div class="text-center margin-top20">
						<p class="margin-top10 margin-bottom10">
							<button class="btn btn-block bg-color-green1"><i class="fa fa-check"></i> Apply Now</button>
						</p>
						<p class="margin-top10 margin-bottom10">
							@if( Auth::id() )
								{{--*/  
									$getTheRoleStatus = DB::table('users')->where('id', '=', Auth::id())->select('userrole_id', 'userstatus_id')->take(1)->get();
								/*--}}
								
								@if( $getTheRoleStatus[0]->userrole_id == '3' )
									@if( $getTheRoleStatus[0]->userstatus_id == '1' )
										<button class="btn btn-block btn-u" data-toggle="modal" data-target="#queryStutoColModel" data-whatever="" href=""><i class="fa fa-envelope"></i> Quick Inquiry</button>
									@endif
								@endif
							@else
								<button class="btn btn-block btn-u" data-toggle="modal" data-target="#queryStutoColModel" data-whatever="" href=""><i class="fa fa-envelope"></i> Quick Inquiry</button>
							@endif
						</p>
						<p class="margin-top10 margin-bottom10">
							<a href="javascript:void(0);" class="btn btn-block bg-color-orange"><i class="fa fa-download"></i> Download Brochure</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<!--=== Profile ===-->
		<div class="container content profile padding0">
			<div class="row">
				<!-- Profile Content -->
				@if( $getCollegeDetailObj )
					@foreach( $getCollegeDetailObj as $getCollegeName )
						@if( empty( $getCollegeName->facebookurl ) )
							<div class="col-md-9">
						@else
							<div class="col-md-9">
						@endif
					@endforeach
				@endif

					<div class="profile-body margin-bottom-20">
						<div class="tab-v1">
							<ul class="nav nav-justified nav-tabs">
								<li class="active"><a href="#profile" class="profilePartialShowButton" id="profilePartialShowButton" href="javascript:void(0);">Info</a></li>
								<li><a href="#courses" class="coursePartialShowButton" id="coursePartialShowButton" href="javascript:void(0);">Course & Fee</a></li>
								<li>
									<a href="#reviews" class="reivewPartialShowButton" id="reivewPartialShowButton" href="javascript:void(0);">Review</a>
								</li>
								<li><a href="#placement" class="photoPlacementShowButton" id="photoPlacementShowButton" href="javascript:void(0);">Placements</a></li>
								<li><a href="#photosvideos" class="photoVideoPartialShowButton" id="photoVideoPartialShowButton" href="javascript:void(0);">Gallery</a></li>
								<li>
									<a href="#scholarship" class="scholarshipPartialShowButton" id="scholarshipPartialShowButton" href="javascript:void(0);">Scholarship</a>
								</li>
								<li>
									<a href="#facility" class="facultyPartialShowButton" id="facultyPartialShowButton" href="javascript:void(0);">Faculty</a>
								</li>
							</ul>
							<div class="tab-content">
								<!-- START COLLECTION OF PARTAILS TAB -->
								<p class="text-center loader">
									<img src="{{asset('assets/images/loading.gif')}}" width="64">	
								</p>								
								<div id="loadPartialsTemplates"> </div>
								<!-- END PROFILE TAB -->
								<!-- COURSE FORM DATA -->
								<!-- include('college/college-profile-show-partial.college-course-fee-partials') -->
								@include('common-partials.ads-slider', ['addonClass' => 'margin-top20 margin-bottom20', 'ads_position' => 'default'])
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div id="fb-root"></div>
					<div class="fb-page" data-href="{{ $getCollegeName->facebookurl }}" data-tabs="timeline" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="{{ $getCollegeName->facebookurl }}"><a href="{{ $getCollegeName->facebookurl }}">{{ $getCollegeName->firstname }}</a></blockquote></div></div>						
					@if(sizeof($getCollegeDetailBannerAds) > 0)
					<div class="margin-top20">
						<a href="{{ $getCollegeDetailBannerAds[0]->redirectto }}" target="_blank" title="View Now">
							<img src="{{ asset('assets/ads-banner/'.$getCollegeDetailBannerAds[0]->img) }}" class="img-responsive img-thumbnail">
						</a>
					</div>
					@endif
					@if(sizeof($getListOfAdsManagements) > 0)
						@include('common-partials.ads-slider', ['addonClass' => 'margin-top20 margin-bottom20', 'ads_position' => 'sidebar'])
					@endif

					<!-- Top Courses  -->
					<div class="main-top-college-block">
						<h2 class="funny-boxes-sea">Top Courses</h2>
						<ul class="list-unstyled top-course-college">
							@for($counter = 1; $counter <=5; $counter++)
							<li>
								<div class="row padding-left15 padding-right15 margin-top5">
									<div class="col-md-4">
										<img class="img-thumbnail" src="https://picsum.photos/50/50?random=1{{ $counter }}">
									</div>
									<div class="col-md-8">
										<a href="javascript:void(0);">{{ str_limit('Vellore Institute of Technology', 35) }}</a>
										<p>Vellore</p>
									</div>
								</div>
							</li>
							@endfor
						</ul>
					</div>

					<div class="main-top-college-block">
						<h2 class="bg-color-blue">Feature College</h2>
						<ul class="list-unstyled top-course-college">
							@for($counter = 1; $counter <=5; $counter++)
							<li>
								<div class="row padding-left15 padding-right15 margin-top5">
									<div class="col-md-4">
										<img class="img-thumbnail" src="https://picsum.photos/50/50?random=2{{ $counter }}">
									</div>
									<div class="col-md-8">
										<a class="top-college-name" href="javascript:void(0);">{{ str_limit('Vellore Institute of Technology', 35) }}</a>
										<p>Vellore</p>
									</div>
								</div>
							</li>
							@endfor
						</ul>
					</div>

					<div class="main-top-college-block">
						<h2 class="funny-boxes-red">Reviews</h2>
						<ul class="list-unstyled top-course-college">
							@for($counter = 1; $counter <=5; $counter++)
							<li>
								<div class="row padding-left15 padding-right15 margin-top5">
									<div class="col-md-4">
										<img class="img-thumbnail" src="https://picsum.photos/50/50?random=3{{ $counter }}">
									</div>
									<div class="col-md-8">
										<a class="top-college-name" href="javascript:void(0);">{{ str_limit('Vellore Institute of Technology', 35) }}</a>
										<p>Vellore</p>
									</div>
								</div>
							</li>
							@endfor
						</ul>
					</div>

					<div>
						<p class="margin-top10 margin-bottom10">
							<a href="javascript:void(0);" class="btn btn-block bg-color-orange">GET Free Counseling</a>
						</p>
					</div>
				</div>
				<!-- End Profile Content -->
			</div><!--/end row-->

			<div class="row">
				@if( $getCollegeDetailObj )
					@foreach( $getCollegeDetailObj as $getCollegeName )
						@if( empty( $getCollegeName->facebookurl ) )
							<!-- <div class="col-md-9 col-lg-9"> -->
							<div class="col-md-8 col-lg-8">
						@else
							<div class="col-md-8">
						@endif
					@endforeach
				@endif
				
					<!-- COURSE FORM DATA -->
						<!-- Updated Course List -->
					<div class="detail-page-signup margin-bottom40 tag-box tag-box-v7 table-responsive hidden">
						<div class="headline"><h2>College Facilities</h2></div>
						@if( $getCollegeFacilityListCount > 0 )
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th>Facilities Name </th>
								</tr>
							</thead>
							<tbody>
								@foreach( $collegeFacilityDataObj as $getCollegeFacility )
									<tr>
										<td>
											@if($getCollegeFacility->facilitiesName)
												{{ $getCollegeFacility->facilitiesName }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
											<div class="hr-line-dashed"></div>
											@if( $getCollegeFacility->description )
												<label >Description :- </label>
												<span class="minimize1">{{ $getCollegeFacility->description }}</span></p>	
									<!-- {{ str_limit($getCollegeFacility->description, $limit = 100, $end = '...') }}  -->
											@endif
										</td>										
									</tr>
								@endforeach
							</tbody>
						</table>
						@else
							<h5>No facilities listed.</h5>
						@endif
					</div>
					<!-- END -->


					
				</div>
				@if( $getCollegeDetailObj )
					@foreach( $getCollegeDetailObj as $getCollegeName )
					@if( !empty( $getCollegeName->facebookurl ) )
						<div class="col-md-4">					
							<div id="fb-root"></div>
							<div class="fb-page" data-href="{{ $getCollegeName->facebookurl }}" data-tabs="timeline" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="{{ $getCollegeName->facebookurl }}"><a href="{{ $getCollegeName->facebookurl }}">{{ $getCollegeName->firstname }}</a></blockquote></div></div>						
							@if(sizeof($getCollegeDetailBannerAds) > 0)
							<div class="margin-top20">
								<a href="{{ $getCollegeDetailBannerAds[0]->redirectto }}" target="_blank" title="View Now">
									<img src="{{ asset('assets/ads-banner/'.$getCollegeDetailBannerAds[0]->img) }}" class="img-responsive img-thumbnail">
								</a>
							</div>
							@endif
							@if(sizeof($getListOfAdsManagements) > 0)
								@include('common-partials.ads-slider', ['addonClass' => 'margin-top20 margin-bottom20', 'ads_position' => 'sidebar'])
							@endif
						</div>
					@endif
					@endforeach
				@else
					@if(sizeof($getCollegeDetailBannerAds) > 0)
					<div class="col-md-4">					
						<div class="">
							<a href="{{ $getCollegeDetailBannerAds[0]->redirectto }}" target="_blank" title="View Now">
								<img src="{{ asset('assets/ads-banner/'.$getCollegeDetailBannerAds[0]->img) }}" class="img-responsive img-thumbnail">
							</a>
						</div>
					</div>
					@endif
					@if(sizeof($getListOfAdsManagements) > 0)
						<div class="col-md-4">
							@include('common-partials.ads-slider', ['addonClass' => 'margin-top20 margin-bottom20', 'ads_position' => 'sidebar'])
						</div>
					@endif
				@endif	
			</div>
			<div class="hidden">
				<img src="{{asset('hd1080.png')}}" style="width: 100%; padding-top: 40px; height: 400px; padding-bottom: 40px;">
			</div>
		</div>
		<!--=== End Profile ===-->
	</div><!--/wrapper-->

<div class="modal fade" id="queryStutoColModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(['url' => '/student-for-college', 'method' =>'POST','class' => 'sky-form' ,'role'=>'form','id'=>'sky-form4', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
				<div class="modal-header modal-header-design" style="background: #18BA98;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Write a Query to "{{ $collegeFullName }}"</h4>
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
				</div>
				<div class="modal-body">
					<div class="margin-bottom-20">
						<label>Recipient</label>
						<input class="form-control rounded-right" type="text" value="{{ $collegeFullName }}" disabled="">
					</div>

					<div class="margin-bottom-20">
						<label>Subject</label>
						<input class="form-control rounded-right" type="text" name="subject" maxlength="100" placeholder="Enter the subject" required="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subject" >
					</div>
					<div class="margin-bottom-20">
						<label>Message</label>
						<textarea class="form-control" rows="3" placeholder="Enter the message" name="message" required="" maxlength="250"></textarea>
						<p class="text-danger">(Place your query in 250 characters. Thanks Team Admission X)</p>
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<button type="submit" class="btn-u btn-block rounded">Submit</button>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection

@section('scripts')
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}

<script type="text/javascript">
	$(document).ready(function(){
		if ($('#firstAddressHere').text() === $('#secondAddressHere').text()){
			$("#combinedAddress").text($('#firstAddressHere').text());
			$("#combinedAddress").removeClass('hide');
			$('#redAdd').addClass('hide');
			$('#camAdd').addClass('hide');
		}else{
			$("#combinedAddress").addClass('hide');
			$('#redAdd').removeClass('hide');
			$('#camAdd').removeClass('hide');
		}
	});
	
</script>

<script type="text/javascript">
//--ON LOAD PROFILE FORM-----------------------------------------------------------------------------------//
	$(document).ready(function(){
		var slug = "{{ $slugUrl }}";
		$('.profilePartialShowButton').parent().addClass('active');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "POST",
            dataType: "json",
            data: {slug: slug},
            url: "{{ URL::to('/college/profilePartialShow') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
            	$('#loadPartialsTemplates').html(data);
            }
        });


        //LOAD AS PER URL
        var hash = window.location.hash;
		if(hash){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
	    	$('a[href="' + hash +'"]').parent('li').addClass('active');
	        var currentATagID = $('a[href="' + hash +'"]').attr("id");
	        loadPartialsUrl(currentATagID);	        
	    } else {
	    }

	    //FUNCTION FOR PARTAILS
	    function loadPartialsUrl(currentATagID) {
    		var URL = '';
	    	if( currentATagID == 'coursePartialShowButton' ){
	    		URL = "{{ URL::to('/college/courseListShow') }}";
	    	}else if( currentATagID == 'profilePartialShowButton' ){
	    		URL = "{{ URL::to('/college/profilePartialShow') }}";
	    	}else if( currentATagID == 'addressPartialShowButton' ){
	    		URL = "{{ URL::to('/college/addressPartialShow') }}";
	    	}else if( currentATagID == 'photoVideoPartialShowButton' ){
	    		URL = "{{ URL::to('/college/photoVideoPartialShow') }}";
	    	}else if( currentATagID == 'photoAchievementsShowButton' ){
	    		URL = "{{ URL::to('/college/achievementsPartialShow') }}";
	    	}else if( currentATagID == 'photoPlacementShowButton' ){
	    		URL = "{{ URL::to('/college/placementPartialShow') }}";
	    	}else if( currentATagID == 'reivewPartialShowButton' ){
	    		URL = "{{ URL::to('/college/reviewPartialShow') }}";
	    	}else if( currentATagID == 'scholarshipPartialShowButton' ){
	    		URL = "{{ URL::to('/college/scholarshipPartialShow') }}";
	    	}else if( currentATagID == 'facultyPartialShowButton' ){
	    		URL = "{{ URL::to('/college/facultyPartialShow') }}";
	    	}

	    	var slug = "{{ $slugUrl }}";
	    	$('#loadPartialsTemplates').html('');
	    	$('.loader').removeClass('hide');
	    	$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: URL,
	            success: function(data) {
	            	//Clear OLD
	            	$('.loader').addClass('hide');
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
	    }

		//GET PARTAILS FOR COURSE
		$('li > .coursePartialShowButton').on('click',function(){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/courseListShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PROFILE
		$('li > .profilePartialShowButton').on('click',function(){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/profilePartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PHOTOS AND VIDEOS
    	$('li > .addressPartialShowButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/addressPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PHOTOS AND VIDEOS
    	$('li > .photoVideoPartialShowButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
    		var slug = "{{ $slugUrl }}";
    		$('#loadPartialsTemplates').html('');
    		$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/photoVideoPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Awards + Achievements 
    	$('li > .photoAchievementsShowButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/achievementsPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Placement
    	$('li > .photoPlacementShowButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/placementPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

    	//GET PARTAILS FOR Reviews
		$('li > .reivewPartialShowButton').on('click',function(){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/reviewPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Scholarship
		$('li > .scholarshipPartialShowButton').on('click',function(){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/scholarshipPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Scholarship
		$('li > .facultyPartialShowButton').on('click',function(){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/facultyPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});
	});
//-------------------------------------------------------------------------------------//
</script>

<script type="text/javascript">
	$(document).ready(function(){
		
		if ($('.minimizeRegiAddress').text() === $('.minimizeCampusAddress').text()){
			$("#combinedAddress").text($('.minimizeRegiAddress').text());
			$("#combinedAddress").removeClass('hide');
			$('#redAdd').addClass('hide');
			$('#camAdd').addClass('hide');
		}else{
			$("#combinedAddress").addClass('hide');
			$('#redAdd').removeClass('hide');
			$('#camAdd').removeClass('hide');
		}

	});
	
</script>

<script type="text/javascript">
	var minimized_elements = $('span.collegeDesc');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 180) return;
        
        $(this).html(
            t.slice(0,180)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(180,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
</script>

<script type="text/javascript">
	var minimized_elements = $('span.minimize1');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(100,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
</script>

<script type="text/javascript">
	var minimized_elements = $('span.minimize2');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 50) return;
        
        $(this).html(
            t.slice(0,50)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(50,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
</script>
<script type="text/javascript">
	var minimized_elements = $('span.minimizeRegiAddress');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 190) return;
        
        $(this).html(
            t.slice(0,190)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(190,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
</script>

<script type="text/javascript">
	var minimized_elements = $('span.minimizeCampusAddress');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 190) return;
        
        $(this).html(
            t.slice(0,190)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(190,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });

    $('#viewMorePopup').on('click', function(){
		$('#thanksModal').removeClass('hide');
		$.magnificPopup.open({
	        items: {
	            src: '#thanksModal',
	        },
	        type: 'inline'
	    });		
	});
</script>


<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=801030516664134";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@endsection