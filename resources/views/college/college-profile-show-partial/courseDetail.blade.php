@extends('website/new-design-layouts.master')

@section('styles')
{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
{!! Html::style('home-layout/assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style type="text/css">
	/*.wrapper{background: #f9f9f9;}
	.whiteBackround{background: #FFFFFF;}
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

	.course-details { color: #000; }
</style>
@endsection

@section('content')
	<div class="wrapper">
		
		<div class="whiteBackround">
			<div class="container content profile">
			<div class="row">
				<div class="col-md-3">
					@if( $getCollegeProfileDataObj )
						@foreach( $getCollegeProfileDataObj as $collegeData )
							<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('gallery/')}}/{{ $slugUrl }}/{{ $collegeData->galleryName }}');">
								<div class="pull-right">
									<div class="fb-share-button" data-href="https://{{ env('ipAddressForRedirect') }}/college/{{$slugUrl}}" data-layout="button" data-size="large" data-mobile-iframe="true">
										<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F{{$slugUrl}}&amp;src=sdkpreparse"><img src="/home-layout/assets/img/icons/other/share-on-facebook.png"></a>
									</div>
								</div>
							</div>
						@endforeach
					@else
						<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png'); ">
							<div class="pull-right">
								<div class="fb-share-button" data-href="https://{{ env('ipAddressForRedirect') }}/college/{{$slugUrl}}" data-layout="button" data-size="large" data-mobile-iframe="true">
									<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F{{$slugUrl}}&amp;src=sdkpreparse"><img src="/home-layout/assets/img/icons/other/share-on-facebook.png"></a>
								</div>
							</div>
						</div>
					@endif
				</div>
				<div class="col-md-6">
					<h1 class="">
						<a class="hover-effect college-name-style-black" href="#">
							@if( $getCollegeDetailObj )
								@foreach( $getCollegeDetailObj as $getCollegeName )
									<a href="{{ URL::to('/college') }}/{{ $slugUrl }}" class="no-anchor-text">{{ $getCollegeName->firstname }}</a>
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
					
					<!-- @if( $getCollegeDetailObj )
						@foreach( $getCollegeDetailObj as $getCollegeName )
							@if( $getCollegeName->description )
								<p><span class="label label-warning">College Description</span> : {{ str_limit($getCollegeName->description, 180) }} 
									@if( strlen($getCollegeName->description) > 180 )
										<span class="color-green" id="viewMorePopup">More</span>
									@endif
								</p>
								<div id="thanksModal" class="hide white-popup">
									<div class="detail-page-signup">
										<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">College Description</a></h2>
										<hr>
										{{ $getCollegeName->description }}	
									</div>
								</div>
							@else
								<p><span class="label label-warning">Not updated yet</span></p>
							@endif
						@endforeach
					@endif -->

					@if( $collegeFacilityDataObj )
						<div class="row">
							@foreach( $collegeFacilityDataObj as $item )
								<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
									<p class="tooltips" data-toggle="tooltip" data-placement="right" title="{{ $item->description }}">
									<!-- @if( $item->facilitiesId == '1' )
									<img src="/home-layout/assets/img/facility/hostel.png" width="32"> 
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
				<div class="col-md-3 text-right">
					<ul class="list-inline">
						@if( $getCollegeDetailObj )
							@foreach( $getCollegeDetailObj as $getCollegeName )
								@if( $getCollegeName->review == '1' )
									<li><a href="javascript:void(0);" class="badgesSize" title="This profile is successfully reviewed">
										<!-- <span class="fa-stack fa-lg">
										  <i class="fa fa-square-o fa-stack-2x"></i>
										  <i class="fa fa-thumbs-up fa-stack-1x"></i>
										</span> -->
										<img src="/home-layout/assets/img/icons/other/like.png" width="32">
									</a></li>
								@else
									<li><a href="javascript:void(0);" class="badgesSize" title="This profile is under review">
										<!-- <span class="fa-stack fa-lg">
										  <i class="fa fa-square-o fa-stack-2x"></i>
										  <i class="fa fa-hand-o-up fa-stack-1x"></i>
										</span> -->
										<img src="/home-layout/assets/img/icons/other/dislike.png" width="32">
									</a></li>
								@endif

								@if( $getCollegeName->verified == '0' )
									<li><a href="javascript:void(0);" class="badgesSize" title="This profile is not verified">
										<!-- <span class="fa-stack fa-lg">
										  <i class="fa fa-square-o fa-stack-2x"></i>
										  <i class="fa fa-envelope-o fa-stack-1x"></i>
										</span> -->
										<img src="/home-layout/assets/img/icons/other/envelope.png" width="32">
									</a></li>
								@endif
							@endforeach
						@endif
						<li>
							@if( $getCourseBookmarkedStatus )
								<a href="javascript:void(0);" class="bookmarkedHeartIcon">
									<input type="hidden" name="bookmarkTableID" value="{{ $getCourseBookmarkedStatus[0]->id }}">
									<input type="hidden" class="courseName" name="courseName" value="{{ $collegemasterId }}">
									<input type="hidden" name="collegeURL" value="{{ URL::to('college/detail-course', [$collegemasterId,$slugUrl]) }}">
									<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses" class="white-bg">
										<i class="bookmarkHeart rounded-x icon-heart"></i>
									</span>
								</a>
							@else
								<a href="javascript:void(0);" class="courseBookMarkButton">
									<input type="hidden" class="courseName" name="courseName" value="{{ $collegemasterId }}">
									<input type="hidden" name="collegeURL" value="{{ URL::to('college/detail-course', [$collegemasterId,$slugUrl]) }}">
									<span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses" class="white-bg">
										<i class="bookmarkHeart rounded-x icon-heart"></i>
									</span>
								</a>
							@endif
						</li>
					</ul>
					
				</div>
			</div>
		</div>
		</div>
		<!-- Data Struture -->
		<div class="container content profile padding-top0">
			<div class="row">
				<div class="col-md-12">
					<div class="profile-body">
						<div class="profile-bio">
							<div class="row">
								<div class="col-md-12">
									<h2>College Courses</h2>									
								</div>
								<!-- <div class="col-md-3 text-right">
									@if( $getCollegeMasterCoursesObj )
										@foreach( $getCollegeMasterCoursesObj as $item )
										<a class="btn btn-block btn-windows" href="{{ url('student/apply-course-details/') }}/{{ 
										$item->collegemasterId }}/{{ $slugUrl }}" >Book</a>
										@endforeach
									@endif
								</div> -->
							</div>
							<div class="row">
								<div class="col-md-12"><p class="text-info margin-top10 margin-bottom10"><i class="fa fa-calendar" aria-hidden="true"></i> Session Start Date will update soon by college</p></div>
							</div>
							<div class="row">
								<div class="col-md-6">
									@if( $getCollegeMasterCoursesObj )
										@foreach( $getCollegeMasterCoursesObj as $item )
										<span><strong>Course Fee (per year):</strong> Rs. {{ $item->fees }}</span>
										<span><strong>Last Date for Documents Verification:</strong> Will update soon by college</span>
										<!-- <span><strong>Seats Availbe:</strong> {{ $item->seats }}</span> -->
										<!-- <span><strong>Seats Availbe at Admission X:</strong> {{ $item->seatsallocatedtobya }}</span> -->
										@endforeach
									@endif
								</div>
								<div class="col-md-6">
									@if( $getCollegeMasterCoursesObj )
										@foreach( $getCollegeMasterCoursesObj as $item )
										@if( !empty($item->twelvemarks) )
										<span><strong>Mini. 12th Marks:</strong> {{ $item->twelvemarks }}</span>
										@endif
										@if( !empty($item->others) )
										<span><strong>Others Course Eligibility :</strong> {{ $item->others }}</span>
										@endif										
										@endforeach
									@endif
								</div>
							</div>
						</div><!--/end row-->
						<hr>
						<div class="row">
							<!--Social Icons v3-->
							<div class="col-sm-6 sm-margin-bottom-30">
								<div class="panel panel-profile">
									<div class="panel-heading overflow-h">
										<h2 class="panel-title heading-sm pull-left"><i class="fa fa-info"></i> Course Information</h2>
									</div>
									<div class="panel-body">
										<ul class="list-unstyled social-contacts-v2">
											@if( $getCollegeMasterCoursesObj )
												@foreach( $getCollegeMasterCoursesObj as $item )
													@if($item->courseduration)
													<li>Duration : <a href="javascript:void(0);">
													@if($item->courseduration)
															@if(is_numeric($item->courseduration))
																@if( $item->courseduration == '1' )
																	{{ $item->courseduration }} Year
																@else
																	{{ $item->courseduration }} Years
																@endif
															@else
																{{ $item->courseduration }}
															@endif
														@else
				                                            <span class="label label-warning">Not Updated Yet</span>
				                                        @endif
													</a></li>
													@endif	

													@if($item->functionalareaName)
													<li>Stream : <a href="javascript:void(0);">{{ $item->functionalareaName }}</a></li>
													@endif													
													
													@if($item->educationlevelName)
													<li>Degree Level : <a href="javascript:void(0);">{{ $item->educationlevelName }}</a></li>
													@endif

													@if($item->degreeName)
													<li>Degree : <a href="javascript:void(0);">{{ $item->degreeName }}</a></li>
													@endif													
													
													@if($item->courseName)
													<li>Course : <a href="javascript:void(0);">{{ $item->courseName }}</a></li>
													@endif

													@if($item->coursetypeName)
													<li>Course Type : <a href="javascript:void(0);">{{ $item->coursetypeName }}</a></li>
													@endif

													@if($item->courseDescription)
													<li>Description : <span class="courseDescription">{{ $item->courseDescription }}</span></p>
													@endif
												@endforeach
											@endif							
										</ul>
									</div>
								</div>
							</div>
							<!--End Social Icons v3-->

							<!--Skills-->
							<div class="col-sm-6 sm-margin-bottom-30">
								<div class="panel panel-profile">
									<div class="panel-heading overflow-h">
										<h2 class="panel-title heading-sm pull-left"><i class="fa fa-graduation-cap"></i> Faculty Information</h2>
									</div>
									<div class="panel-body">
										<!-- @if( $getFacultyMemberDetails )
		                                	<div class="panel panel-profile">
												<div id="scrollbar3" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
													@foreach( $getFacultyMemberDetails as $item )
														@if( !empty($item->name)  )
														<div class="alert-blocks alert-dismissable">
															<div class="overflow-h">
																<strong class="color-dark">{{ $item->suffix }} {{ $item->name }}</strong>
																<p>{{ $item->description }}</p>
															</div>
														</div>
														@endif
													@endforeach														
												</div>
											</div>
	                                	@endif -->

	                                	@if(sizeof($getCollegeMasterFacultyObj) > 0)
		                                	<div class="panel panel-profile">
												<div id="scrollbar3" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
													@foreach( $getCollegeMasterFacultyObj as $item )
														@if( !empty($item->name)  )
														<div class="alert-blocks alert-dismissable">
															<div class="overflow-h">
																@if(!empty($item->imagename))
																	<img class="img-circle" src="{{ asset('gallery'.'/'.$slugUrl.'/'.$item->imagename) }}" width="120" height="120">
																@else
																	<img src="/assets/images/no-college-logo.jpg" style="width:100%;">
																@endif 
																<strong class="color-dark">{{ $item->suffix }} {{ $item->name }} </strong><br>
																<strong class="color-dark">Designation : {{ $item->designation }} </strong>
																<p>{!! $item->description !!}</p>
																@if(Auth::check()) 
                                            						@if((Auth::user()->userrole_id == 2) && ($item->users_id == Auth::id()))
																	<p class="pull-right"><a href="{{ url('college/faculty/') }}/{{ $slugUrl}}/{{ $item->id }}" class="btn btn-xs btn-info">View Faculty Details</a></p>
																	@endif
																@endif
															</div>
														</div>
														@endif
													@endforeach														
												</div>
											</div>
	                                	@endif
	                                											
									</div>
								</div>
							</div>
							<!--End Skills-->
							<div class="col-md-4 col-md-offset-4 margin-top20">
								@if( $getCollegeMasterCoursesObj )
									@foreach( $getCollegeMasterCoursesObj as $item )
									<a class="btn-u btn-block" href="{{ url('student/apply-course-details/') }}/{{ $item->collegemasterId }}/{{ $item->slug }}" >Admission</a>
									<!-- <a class="btn-u btn-block" href="{{ url('student/apply-course-details/') }}/{{ $item->collegemasterId }}/{{ $slugUrl }}" >Book</a> -->
									@endforeach
								@endif
							</div>
						</div><!--/end row-->
					</div>
				</div>			
			</div>
		</div>
		<!-- End -->
	</div><!--/wrapper-->

@endsection

@section('scripts')

{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('home-layout/assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js') !!}

<script type="text/javascript">
	jQuery(document).ready(function() {
		App.initScrollBar();			
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
	    	if( currentATagID == 'profilePartialShowButton' ){
	    		URL = "{{ URL::to('/college/profilePartialShow') }}";
	    	}else if( currentATagID == 'addressPartialShowButton' ){
	    		URL = "{{ URL::to('/college/addressPartialShow') }}";
	    	}else if( currentATagID == 'photoVideoPartialShowButton' ){
	    		URL = "{{ URL::to('/college/photoVideoPartialShow') }}";
	    	}else if( currentATagID == 'photoAchievementsShowButton' ){
	    		URL = "{{ URL::to('/college/achievementsPartialShow') }}";
	    	}else if( currentATagID == 'photoPlacementShowButton' ){
	    		URL = "{{ URL::to('/college/placementPartialShow') }}";
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
	});
//-------------------------------------------------------------------------------------//
</script>


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

<script type="text/javascript">
	$(document).ready(function(){
		$('.courseName').on('click',function(){
			var courseName = "{!! $getCollegeMasterCoursesObj[0]->collegemasterId !!}";
			var url = $(location).attr('href');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            url: "{{ URL::to('/student/add-bookmark') }}",
	            data: { courseName: courseName, url: url },
	            dataType: "json",	            
	            success: function(data) {
            		if(data.code == '200'){
            			$('.bookmarkHeart').css('background', '#18BA98');
            			$('.bookmarkHeart').css('color', '#FFFFFF');
            		}else{

            		}
	            }
	        });
	    });
	});
</script>

<script type="text/javascript">
	var minimized_elements = $('span.courseDescription');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 150) return;
        
        $(this).html(
            t.slice(0,150)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(150,t.length)+' <a href="#" class="less">Less</a></span>'
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
@endsection





