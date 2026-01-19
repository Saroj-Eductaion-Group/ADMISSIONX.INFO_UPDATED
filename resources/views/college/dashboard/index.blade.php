@extends('website/new-design-layouts.master')

@section('styles')
{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
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

	.mfp-close{
		width: 25px !important;
	    height: 25px !important;
	    line-height: 25px !important;
	}
	.mfp-close-btn-in .mfp-close {
	    color: #ffffff !important;
	    background: #000000 !important;
    }

    .sidebar-nav-v1 span.badge {
	    margin-top: 0px;
	    margin-right: 10px;
	}

</style>
<style>
	/*.cards {display: flex; flex-wrap: wrap; align-items: stretch;}*/
	.cards {display: inline-flex; flex-wrap: wrap; align-items: stretch;}
	.cards article:hover{border: 1px solid #e2a41b;}
	.cards p:hover{color: #000000 !important;}
	.cards p{color: #fff !important;}
	.card {width: 157px; margin: 5px; border: 1px solid #000; background: #ff7900;} 
	.card img {max-width: 100%;}
	.card .text {padding: 5px 5px 0px 5px;text-align: center;}
	.card .text > button {background: gray;border: 0;color: white;padding: 10px;width: 100%;}

	.scrolling-wrapper {overflow-x: scroll;  overflow-y: hidden;  white-space: nowrap;}
	.cardMobile {display: inline-block;}
	.cardMobile {width: 145px; margin: 5px; border: 1px solid #000; background: #ff7900;} 
	.cardMobile img {max-width: 100%;}
	.cardMobile .text {padding: 5px 5px 0px 5px;text-align: center;}
	.cardMobile .text > button {background: gray;border: 0;color: white;padding: 10px;width: 100%;}
</style>
@endsection

@section('content')
	<div class="wrapper">
		<div class="container content profile">
			<div class="row">
				<div class="col-md-3">
					<a href="{{ URL::to('college', $slugUrl) }}">
					@if( $collegeDataObj )
						@foreach( $collegeDataObj as $collegeData )
							@if( $collegeData->galleryName != '' )
							<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('gallery/')}}/{{ $slugUrl }}/{{ $collegeData->galleryName }}');">
								<a class="hover-effect" href="{{ url('college/delete-college-logo/') }}/{{ $collegeData->galleryId }}/{{ $slugUrl }}"><span class="icon-trash deleteBtnLogoStyle"></span></a>
							</div>
							@else
								<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png'); "></div>	
							@endif
						@endforeach
					@else
						<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png'); ">
							</div>
					@endif					
					</a>
				</div>
				<div class="col-md-7">
					@if(Session::has('accountSettingsUpdate'))
						<div class="alert alert-warning alert-dismissable text-center">
	                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                        {{ Session::get('accountSettingsUpdate') }} <a  href="javascript:void(0);" id="accountSettingTab">Click here to verify.</a>                            
	                    </div>
	            	@endif

	            	@if(Session::has('collegeBannerUpdate'))
						<div class="alert alert-warning alert-dismissable text-center">
	                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                        {{ Session::get('collegeBannerUpdate') }} <a  href="javascript:void(0);" id="collegeBannerTab">Click here to check.</a>                            
	                    </div>
	            	@endif

	            	@if(Session::has('facebookWidgetUrlUpdate'))
						<div class="alert alert-warning alert-dismissable text-center">
	                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                        {{ Session::get('facebookWidgetUrlUpdate') }} <a  href="javascript:void(0);" id="facebookWidgetUrlTab">Click here to check.</a>                            
	                    </div>
	            	@endif

	            	@if(Session::has('socialLinkManagementUpdate'))
						<div class="alert alert-warning alert-dismissable text-center">
	                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                        {{ Session::get('socialLinkManagementUpdate') }} <a  href="javascript:void(0);" id="socialLinkManagementTab">Click here to check.</a>                            
	                    </div>
	            	@endif

	            	@if(Session::has('affiliationAccreditationLetters'))
						<div class="alert alert-warning alert-dismissable text-center">
	                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                        {{ Session::get('affiliationAccreditationLetters') }} <a  href="javascript:void(0);" id="affiliationAccreditationLetters">Click here to verify.</a>                        
	                    </div>
	            	@endif

	            	@if(Session::has('collegeMasterUpdate'))
					<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeMasterUpdate') }}</strong>
					</div>
					@endif

					@if(Session::has('collegeGalleryCaptionUpdate'))
					<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeGalleryCaptionUpdate') }}</strong>
					</div>
					@endif

					@if(Session::has('collegeMasterCreate'))
					<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeMasterCreate') }}</strong>
					</div>
					@endif

					@if(Session::has('collegefacilityUpdate'))
					<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegefacilityUpdate') }}</strong>
					</div>
					@endif

					@if(Session::has('collegeDocumentCaptionUpdate'))
					<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeDocumentCaptionUpdate') }}</strong>
					</div>
					@endif

					@if(Session::has('collegeFacilityUpdates'))
					<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeFacilityUpdates') }}</strong>
					</div>
					@endif

					@if(Session::has('collegeEventUpdate'))
					<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeEventUpdate') }}</strong>
					</div>
					@endif

					@if(Session::has('collegeEventcreate'))
					<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeEventcreate') }}</strong>
					</div>
					@endif

					@if(Session::has('collegeProfileReviewStatus'))
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeProfileReviewStatus') }}</strong>
					</div>
					@endif

					@if(Session::has('confirmDisabledEmail'))
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('confirmDisabledEmail') }}</strong>
					</div>
					@endif

					<h1 class="">
						<a class="hover-effect college-name-style-black" >
							{!! $collegeName = ''; !!}
							@if( $getCollegeNameObj )
								@foreach( $getCollegeNameObj as $getCollegeName )
									{{ $getCollegeName->firstname }} <a href="{{ URL::to('college', $slugUrl) }}" title="{{ $getCollegeName->firstname }}"></a>
									{{--*/ $collegeName = $getCollegeName->firstname /*--}}
								@endforeach
							@endif						
						</a>
					</h1>
					<p>
						<span id="combinedAddress" class="hide"></span>
						@foreach( $getAddressData as $getAddress )
							@if( $getAddress->addresstypeId  == '1' )
								@if( !empty( $getAddress->name ) )
									<p id="redAdd" class="hide"><span class="label label-success">{{ $getAddress->addresstypeName }}</span> : <span class="minimizeRegiAddress" id="firstAddressHere">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->cityName }}, {{ $getAddress->postalcode }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong></span></p>
						    	@else
						    		<p><a href="javascript:void(0);" id="updateRegiAddress"><span class="label label-danger">Please Update Your Registered Address</span></a></p>
						    	@endif
	                        @elseif( $getAddress->addresstypeId  == '2' )
	                        	@if( !empty( $getAddress->name ) )
	                        		<p id="camAdd" class="hide"><span class="label label-warning">{{ $getAddress->addresstypeName }}&nbsp;&nbsp;&nbsp;&nbsp;</span> : <span class="minimizeCampusAddress" id="secondAddressHere">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->cityName }}, {{ $getAddress->postalcode }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong></span></p>
						    	@else
						    		<p><a href="javascript:void(0);" id="updatecampusAddress"><span class="label label-danger">Please Update Your Campus Address</span></a></p>
						    	@endif			                        	
	                        @else
	                        	Address Updated Yet
	                        @endif
	                    @endforeach
					</p>
					
					@if( $getCollegeNameObj )
						@foreach( $getCollegeNameObj as $getCollegeName )
							@if( $getCollegeName->description )
								<p><span class="label label-warning">College Description</span> : {{ str_limit($getCollegeName->description, 180) }} 
									@if( strlen($getCollegeName->description) > 180 )
										<span class="color-green" id="viewMorePopup">More</span>
									@endif
									| <span class="" id="updateMorePopup"><i class="fa fa-pencil"></i></span></p>
								<div id="thanksModal" class="hide white-popup">
									<div class="detail-page-signup">
										<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">College Description</a></h2>
										<hr>
										{{ $getCollegeName->description }}	
									</div>
								</div>
							@else
								<p><span class="label label-danger" id="updateMorePopup">Please Update Your College Description</span></p>
							@endif
						@endforeach
					@endif

					@if( $collegeFacilityDataObj )
						<div class="row margin-top20">
						@foreach( $collegeFacilityDataObj as $item )
							<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
								<p>
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
								<img src="/home-layout/assets/img/facility/{{ $item->iconname }}" width="20"> 
								{{ $item->facilitiesName }}
								</p>
							</div>
						@endforeach
						</div>
					@endif

					<div id="updateDescNow" class="hide white-popup">
						<div class="detail-page-signup">
							<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">College Description</a></h2>
							<hr>
							{!! Form::model($collegeDataDescObj , ['url' => 'college-profile-partial', 'method' => 'POST', 'class' => 'form-horizontal profileUpdateNow', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
								<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
								
								<div class="row padding-top5 padding-bottom5">
									<div class="col-md-12">
										@if( $collegeDataDescObj )
											@foreach(  $collegeDataDescObj as  $collegeData )
												<textarea class="form-control" name="description" rows="8" maxlength="1200" data-parsley-error-message = "Please enter the college description not more than 1200 characters" data-parsley-trigger="change" id="counttextarea">{{ $collegeData->description }}</textarea>
											@endforeach
										@else
											<textarea class="form-control" name="description" rows="8" maxlength="1200" data-parsley-error-message = "Please enter the college description not more than 1200 characters" data-parsley-trigger="change" id="counttextarea"></textarea>
										@endif
										<div class="text-danger">
											<span name="countchars" id="countchars"></span> Characters Remaining. <span name="percent" id="percent"></span>
										</div>    									
									</div>
								</div>
									
								<div class="row padding-top5 padding-bottom5">
									<div class="col-md-12 col-lg-12 text-right">
										<button class="btn-u" type="submit">Submit</button>
									</div>
								</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
				<div class="col-md-2 text-center">
					<ul class="list-inline">
						@if( $getCollegeNameObj )
							@foreach( $getCollegeNameObj as $getCollegeName )
								@if( $getCollegeName->review == '1' )
									<li><a href="javascript:void(0);" class="badgesSize" title="Your profile is successfully reviewed">
										<!-- <span class="fa-stack fa-lg">
										  <i class="fa fa-square-o fa-stack-2x"></i>
										  <i class="fa fa-thumbs-up fa-stack-1x"></i>
										</span> -->
										<img src="/home-layout/assets/img/icons/other/like.png" width="32">
									</a></li>
								@else
									<li><a href="javascript:void(0);" class="badgesSize" title="Your college profile is in review right now. Please update your profile until then. Your profile will be publically available once it has been reviewed by the Admission X team.">
									<!-- <a href="javascript:void(0);" class="badgesSize" title="Your profile is under review"> -->
										<!-- <span class="fa-stack fa-lg">
										  <i class="fa fa-square-o fa-stack-2x"></i>
										  <i class="fa fa-hand-peace-o fa-stack-1x"></i>
										</span> -->
										<img src="/home-layout/assets/img/icons/other/dislike.png" width="32">
									</a></li>
								@endif

								@if( $getCollegeName->verified == '0' )
									<li><a href="javascript:void(0);" class="badgesSize" title="Your profile is not verified">
										<!-- <span class="fa-stack fa-lg">
										  <i class="fa fa-square-o fa-stack-2x"></i>
										  <i class="fa fa-envelope-o fa-stack-1x"></i>
										</span> -->
										<img src="/home-layout/assets/img/icons/other/envelope.png" width="32">
									</a></li>
								@endif
							@endforeach
						@endif
					</ul>
					
				</div>
			</div>
		</div>
		
		<!--=== Profile ===-->
		<div class="container content profile padding0">
			<div class="row">
				<!--Left Sidebar-->
				<div class="col-md-3 md-margin-bottom-40">
					<!-- Upload college logo -->
	                <div class="form-group margin-top10 margin-bottom10 tag-box tag-box-v2 box-shadow shadow-effect-1">
	                	<button class="btn btn-block btn-u" id="uploadNewLogoNow">Upload New Logo</button>
	                	<div class="hide" id="uploadLogoForm">
	                		{!! Form::open(['url' => 'college/upload-college-logo', 'class' => 'form-horizontal uploadGalleryLogoImg', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
		                		@if($collegeDataObj)
			                		@foreach(  $collegeDataObj as  $collegeData )
										<input type="hidden" name="galleryId" value="{{ $collegeData->galleryId }}">
									@endforeach
								@endif
		                		<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
		                		<label for="file" class="input input-file">
					                <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
					                <input type="file" class="form-control" name="uploadCollegeLogo" class="input input-file collegeLogo"  data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload only png , jpg or jpeg." required="">
					            </label>
					            <button class="btn btn-block btn-u">Upload Now</button>
				            {!! Form::close() !!}
				            <!-- <p class="text-danger text-center">(Please upload only jpg or jpeg.)</p> -->
	                	</div>
			        </div>
	                <!-- END -->

					<ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseInstituteDetailMenu"><i class="fa fa-user"></i> Institute Details</a>
							<div id="collapseInstituteDetailMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="#profile" id="profileRemoveTab"><i class="fa fa-user"></i> Account Details</a></li>
			                        <li><a href="#management" class="managementPartialButton" id="managementPartialButton" href="javascript:void(0);"><i class="fa fa-users"></i> Management Details</a></li>
									<li><a href="#account-settings" id="accountSettingTab" class="accountSettingTabPage"><i class="fa fa-cog"></i> Account Settings</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseCollegeDetailMenu"><i class="fa fa-university"></i> College Information</a>
							<div id="collapseCollegeDetailMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="javascript:void(0);" id="collegeBannerTab" class="collegeBannerTabPage"><i class="fa fa-upload"></i> Upload College Banner</a></li>
									<li><a href="#address" class="addressPartialButton" id="addressPartialButton"><i class="fa fa-map-marker"></i> Address</i></a></li>
									<li><a href="#photosvideos" class="photoVideoPartialButton" id="photoVideoPartialButton"><i class="fa fa-picture-o"></i> Gallery </a></li>
									<li><a href="#awardsach" class="photoAchievementsButton" id="photoAchievementsButton"><i class="fa fa-trophy"></i> Achievements </a></li>
									<li><a href="#courses" class="coursesButton" id="coursesButton"><i class="fa fa-book"></i> Course </a></li>
									<li><a href="#facilities" class="facilitiesPartialButton" id="facilitiesPartialButton"><i class="fa fa-list"></i> Facilities </a></li>
									<li><a href="#events" class="eventsPartialButton" id="eventsPartialButton"><i class="fa fa-calendar"></i> Events</a></li>
									<li><a href="#scholarship" class="scholarshipPartialButton" id="scholarshipPartialButton"><i class="fa fa-graduation-cap"></i> Scholarship</a></li>
									<li><a href="#placement" class="photoPlacementButton" id="photoPlacementButton"><i class="fa fa-graduation-cap"></i> Placements </a></li>
									<li><a href="javascript:void(0);" id="affiliationAccreditationLetters" class="affiliationLetters"><i class="fa fa-file-pdf-o"></i> Affiliation / Accreditation Letters</a></li>
									<li><a href="#sportsactivity" id="collegeSportsActivityTab" class="collegeSportsActivityTab"><i class="fa fa-futbol-o"></i> Sports & Activity</a></li>
									<li><a href="#cutoffs" id="collegeCutOffsTab" class="collegeCutOffsTab"><i class="fa fa-list"></i> Cut Offs</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college/faculty', $slugUrl) }}"><i class="fa fa-users"></i> Our faculties</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college/admission-procedure', $slugUrl) }}"><i class="fa fa-file-text"></i> Admission Procedure</a>
						</li>
						<li class="list-group-item">
							<a href="javascript:void(0);" id="facebookWidgetUrlTabPage" class="facebookWidgetUrlTabPage"><i class="fa fa-facebook-square"></i> Facebook Widget URL</a>
						</li>
						<li class="list-group-item">
							<a href="javascript:void(0);" id="socialLinkManagementTabPage" class="socialLinkManagementTabPage"><i class="fa fa-share-alt"></i> Social Link Management</a>
						</li>
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseApplicationMenu"><i class="fa fa-files-o"></i> Application @if($getApplicationsStatusDataObj) 
								<span class="badge rounded-x applicationStatus" style="background: #18BA98;">
								{{ $getApplicationsStatusDataObj }}</span>
							@endif
							</a>
							<div id="collapseApplicationMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="{{ URL::to('college/check-application-status/accepted') }}"><i class="fa fa-files-o"></i> Accepted</a></li>
									<li><a href="{{ URL::to('college/check-application-status/pending') }}"><i class="fa fa-files-o"></i> Pending</a></li>
									<li><a href="{{ URL::to('college/check-application-status/rejected') }}"><i class="fa fa-files-o"></i> Rejected</a></li>
									<li><a href="{{ URL::to('college/check-application-status/cancelled') }}"><i class="fa fa-files-o"></i> Cancelled</a></li>
									<!-- <li><a href="{{ URL::to('college/check-application-status/view') }}"><i class="fa fa-files-o"></i> View All</a></li> -->
									<li><a href="{{ URL::to('college/check-applications', $slugUrl) }}"><i class="fa fa-files-o"></i> View All</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseQueryMenu"><i class="fa fa-comments"></i> Queries 
								@if($getQueryCollegeDataObj)
									<span class="badge rounded-x applicationStatus" style="background: #18BA98;"> {{ $getQueryCollegeDataObj }} </span>
								@endif
							</a>
							<div id="collapseQueryMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="{{ URL::to('college/check-queries-status/replied') }}"><i class="fa fa-comments"></i> Replied</a></li>
									<li><a href="{{ URL::to('college/check-queries-status/pending') }}"><i class="fa fa-comments"></i> Pending</a></li>
									<li><a href="{{ URL::to('college/check-queries-status/view') }}"><i class="fa fa-comments"></i> View All</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college/review-list', $slugUrl) }}" target="_blank"><i class="fa fa-tachometer"></i> Reviews</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college/check-matrix', $slugUrl) }}" target="_blank"><i class="fa fa-bar-chart-o"></i> Metrics</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college/transaction-list', $slugUrl) }}" target="_blank"><i class="fa fa-money"></i> Transaction Details</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college/faqs', $slugUrl) }}"><i class="fa fa-users"></i> College Faqs</a>
						</li>
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseQACMenu"><i class="fa fa-files-o"></i> Question/Answer/Comment</a>
							<div id="collapseQACMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="{{ URL::to('college/submit-question-list/'.$slugUrl) }}"><i class="fa fa-pencil"></i> Question</a></li>
									<li><a href="{{ URL::to('college/submit-answer-list/'.$slugUrl) }}"><i class="fa fa-pencil"></i> Answer</a></li>
									<li><a href="{{ URL::to('college/submit-comments-list/'.$slugUrl) }}"><i class="fa fa-pencil"></i> Commants</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college/check-queries-status/pending') }}" target="_blank"><i class="fa fa-question-circle"></i> Help Desk</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college', $slugUrl) }}" target="_blank"><i class="fa fa-eye"></i> Public View</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college-partner-agreement') }}" target="_blank"><i class="fa fa-link"></i> College Partner Agreement</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('college/terms-conditions', $slugUrl) }}" target="_blank"><i class="fa fa-link"></i> Terms and Conditions</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('/logout') }}" target="_blank"><i class="fa fa-sign-out "></i> Logout</a>
						</li>
					</ul>
				</div>
				<!--End Left Sidebar-->

				<!-- Profile Content -->
				<div class="col-md-9">
					<div class="profile-body margin-bottom-20">
						<div class="tab-v1">
							<ul class="nav nav-justified nav-tabs instituteDetailsBlock hideOnAffaliationClick">
								<li class="active"><a href="#profile" class="profilePartialButton" id="profilePartialButton">Institute Profile <i class="fa fa-edit"></i></a></li>
								<li><a href="#management" class="managementPartialButton" id="managementPartialButton">Management Details <i class="fa fa-edit"></i></a></li>
								<li><a href="#account-settings" id="accountSettingTab" class="accountSettingTabPage"><i class="fa fa-cog"></i> Account Settings/Change Password</a></li>
							</ul>
							<ul class="nav nav-justified nav-tabs nav-tabs1  hide informationDetailsBlock hideOnAffaliationClick">
								<!-- <li class="active"><a href="#profile" class="profilePartialButton" id="profilePartialButton">Profile <i class="fa fa-edit"></i></a></li> -->
								<li class="active"><a href="#address" class="addressPartialButton" id="addressPartialButton">Address <i class="fa fa-edit"></i></a></li>
								<li><a href="#photosvideos" class="photoVideoPartialButton" id="photoVideoPartialButton">Gallery <i class="fa fa-edit"></i></a></li>
								<li><a href="#awardsach" class="photoAchievementsButton" id="photoAchievementsButton">Achievements <i class="fa fa-edit"></i></a></li>
								<li><a href="#courses" class="coursesButton" id="coursesButton">Course <i class="fa fa-edit"></i></a></li>
								<li><a href="#facilities" class="facilitiesPartialButton" id="facilitiesPartialButton">Facilities <i class="fa fa-edit"></i></a></li>
								<li><a href="#events" class="eventsPartialButton" id="eventsPartialButton">Events <i class="fa fa-edit"></i></a></li>
								<li><a href="#scholarship" class="scholarshipPartialButton" id="scholarshipPartialButton">Scholarship <i class="fa fa-edit"></i></a></li>
								<li><a href="#placement" class="photoPlacementButton" id="photoPlacementButton">Placements <i class="fa fa-edit"></i></a></li>
							</ul>
							<div class="tab-content">
								<!-- START COLLECTION OF PARTAILS TAB -->
								<p class="text-center loader">
									<img src="{{asset('assets/images/loading.gif')}}" width="64">	
								</p>
								<div id="loadPartialsTemplates"> </div>
								<!-- END PROFILE TAB -->
							</div>
						</div>
					</div>
						<!-- College Facility FORM DATA -->
					<!-- END -->
				</div>
				<!-- End Profile Content -->
			</div><!--/end row-->
			<div class="row margin-bottom-20">
				<div class="col-md-12">
					<!-- SOCIAL BLOCKS -->
				</div>
			</div>
		</div>
		<!--=== End Profile ===-->
	</div><!--/wrapper-->

@endsection

@section('scripts')

{!! Html::script('assets/js/forms/signup-detail.js') !!}
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('assets/js/plugins/datepicker.js') !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function() {
		SignUpDetailForm.initSignUpForm();
			Datepicker.initDatepicker();
	});
</script>
<script type="text/javascript">
	$('form').parsley();
</script>
<script type="text/javascript">
    //$('.summernote').summernote();
    $('.summernote').summernote({
        placeholder: 'write here...',
        height: 150,
        toolbar: [
          ['font', ['bold', 'underline', 'italic']],
          ['para', ['ul', 'ol', 'paragraph']],
        ],
        popover: {
        image: [
            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
        ],
        link: [
            ['link', ['linkDialogShow', 'unlink']]
        ],
        air: [
            ['color', ['color']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'paragraph']],
            ['table', ['table']],
        ]
        },
        codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
        },
        dialogsInBody: true
    });
    $('#summernote').summernote('fontSize', 18);
</script>
<script type="text/javascript">
	$('body').addClass('padding-bottom0');
	$(".image-block").backstretch([
		"assets/images/bg/1.jpg",
		"assets/images/bg/18.jpg",
	], {
		fade: 1000,
		duration: 7000
	});
	
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
	$("#txtTotalSeats").blur(function(){
		if( $("#txtTotalSeats").val().length != '0' ){
			$("#txtByaSeats").removeAttr('disabled', '');			
		}else{
			$("#txtByaSeats").addAttr('disabled', 'disabled');
		}		
	});

	$('#txtByaSeats').keydown(function(){
		var totalSeats = $("#txtTotalSeats").val();
	    var byaSeats = $("#txtByaSeats").val();
        if (totalSeats < byaSeats) {
            $("#txtByaSeats").val(totalSeats);
            return false;
        }
        return true;
	});
</script>

<script type="text/javascript">
    $(document).ready(function(){   
    	$('form').parsley();

	    $('.collegeLogo').on('change',function(){
	        $('#refresh1').removeClass('hide');
	    });
	    $('#refresh1').on('click',function(e){
	        $('.collegeLogo').val('').trigger('chosen:updated');
	        $('#refresh1').addClass('hide');
	    });

	    $('.aicteDocument').on('change',function(){
	        $('#refresh2').removeClass('hide');
	    });
	    $('#refresh2').on('click',function(e){
	        $('.aicteDocument').val('').trigger('chosen:updated');
	        $('#refresh2').addClass('hide');
	    });

	    $('.ugcDocument').on('change',function(){
	        $('#refresh3').removeClass('hide');
	    });
	    $('#refresh3').on('click',function(e){
	        $('.ugcDocument').val('').trigger('chosen:updated');
	        $('#refresh3').addClass('hide');
	    });
	    
	    //-------------------------------Add New Course Master Form Button------------------------------------------------------//
	  	$(document).ready(function(){
		    $('.courseForm').hide();
	        $(document).on('click', '#addNewCourse', function(){
	        	$(".courseForm").toggle();
	            $(".courseForm").css("visibility","visible");
	        	//$(".courseFormBlock").removeClass('hide');
	        }); 
	    }); 
	    //----------------------------------End Add New Course Master Form Button---------------------------------------------------//

	    //----------------------------Add New Event Form Button---------------------------------------------------------//

	    $(document).ready(function(){
		    $('.eventForm').hide();
	        $(document).on('click', '#addNewEvent', function(){
	        	$(".eventForm").toggle();
	            $(".eventForm").css("visibility","visible");
	        }); 
	    }); 
	    //------------------------------------ End Add New Event Form Button-------------------------------------------------//
	   	
	    //----------------------------Add New College Facility Form Button---------------------------------------------------------//

	    $(document).ready(function(){
		    $('.collegeFacilityForm').hide();
	        $(document).on('click', '#addNewCollegeFacility', function(){
	        	$(".collegeFacilityForm").toggle();
	            $(".collegeFacilityForm").css("visibility","visible");
	        }); 
	    }); 


	    //------------------------------------ End Add New Event Form Button-------------------------------------------------//

	    //----------------------------Add New College Management Details Form Button---------------------------------------------------------//

	    $(document).ready(function(){
		    $('.managementDetailForm').hide();
	        $(document).on('click', '#addNewManagement', function(){
	        	$(".managementDetailForm").toggle();
	            $(".managementDetailForm").css("visibility","visible");
	        }); 
	    }); 
	    //------------------------------------ End Add New Management Details Form Button-------------------------------------------------//

	    //----------------------------Add New College Scholarship Form Button---------------------------------------------------------//

	    $(document).ready(function(){
		    $('.scholarshipForm').hide();
	        $(document).on('click', '#addNewScholarship', function(){
	        	$(".scholarshipForm").toggle();
	            $(".scholarshipForm").css("visibility","visible");
	        }); 
	    }); 
	    //------------------------------------ End Add New Scholarship Form Button-------------------------------------------------//

	    //----------------------------Add New College Scholarship Form Button---------------------------------------------------------//

	    $(document).ready(function(){
		    $('.placementForm').hide();
	        $(document).on('click', '#addNewPlacement', function(){
	        	$(".placementForm").toggle();
	            $(".placementForm").css("visibility","visible");
	        }); 
	    }); 
	    //------------------------------------ End Add New Scholarship Form Button-------------------------------------------------//

	    //----------------------------Add New College Sports Activity Form Button---------------------------------------------------------//

	    $(document).ready(function(){
		    $('.collegeSportsActivityForm').hide();
	        $(document).on('click', '#addNewCollegeSportsActivity', function(){
	        	$(".collegeSportsActivityForm").toggle();
	            $(".collegeSportsActivityForm").css("visibility","visible");
	        }); 
	    }); 
	    //------------------------------------ End Add New Sports Activity Form Button-------------------------------------------------//

	    //----------------------------Add New College Cut Offs Form Button---------------------------------------------------------//

	    $(document).ready(function(){
		    $('.collegeCutOffsForm').hide();
	        $(document).on('click', '#addNewCutOffs', function(){
	        	$(".collegeCutOffsForm").toggle();
	            $(".collegeCutOffsForm").css("visibility","visible");
	        }); 
	    }); 
	    //------------------------------------ End Add New Cut Offs Form Button-------------------------------------------------//

	    $(document).ready(function(){
	        $(document).on('click', '.closePartialBlade', function(){
	        	 window.location.reload();
	        }); 
	    }); 

      //---------------- Ajax Call for course modal-------------------------------------------------------//
       $('table > tbody tr > td > #updateCollegeMasterID').click(function(){
       		var collegemasterId = $(this).next('.collegemasterId').val();
       		var slugUrl = "{!! $slugUrl !!}";
		    $.ajax({
		        type: "GET",
		        url: '/courseMasterPartial',
		        data: {
		            collegemasterId: collegemasterId,
		            slugUrl: slugUrl,
		        },
		        success: function(data){
		            $.magnificPopup.open({
		                type: 'inline',
		                items: {
		                    src: data
		                },
		                closeOnContentClick : false, 
				        closeOnBgClick :true, 
				        showCloseBtn : false, 
				        enableEscapeKey : false,
				        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)"> { costume button with close icon image } </button>'
		            })
		        }
		    });
		});
   		//---------------- Ajax Call for course modal-------------------------------------------------------//
 		
 		
	    //------------------------------------------------------------------------------------//
		$('.stateName').on('change', function(){
			var stateId = $(this).val();
			var HTML = '';
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            data: { stateId: stateId },
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            url: "{{ URL::to('/getCityTotal') }}",
	            success: function(data) {
	        		$.each(data.cityData, function(key, value) {
						HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
					});
					$('.cityName').html(HTML);
	        		$('.cityName').trigger("chosen:updated");
	            }
	        });
		});

		$(document).on('click', '#uploadNewLogoNow', function(){
			$('#uploadNewLogoNow').addClass('hide');
			$('#uploadLogoForm').addClass('fadeIn');
			$('#uploadLogoForm').addClass('animated');
			$('#uploadLogoForm').removeClass('hide');
		});

	});
    //-------------------------------------------------------------------------------------//
</script>

<script type="text/javascript">
//--ON LOAD PROFILE FORM-----------------------------------------------------------------------------------//
	$(document).ready(function(){
		var slug = "{{ $slugUrl }}";
		$('.profilePartialButton').parent().addClass('active');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            data: {slug: slug},
            url: "{{ URL::to('/college/profilePartial') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });

        //LOAD AS PER URL
        var hash = window.location.hash;
	    if(hash){
			$('.tab-v1 > .nav-tabs1 > li').removeClass('active');
	    	$('a[href="' + hash +'"]').parent('li').addClass('active');
	        var currentATagID = $('a[href="' + hash +'"]').attr("id");
	        loadPartialsUrl(currentATagID);	        
	    } else {
	    }

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
	    	if( currentATagID == 'profilePartialButton' ){
	    		URL = "{{ URL::to('/college/profilePartial') }}";
	    		$('.instituteDetailsBlock').removeClass('hide');
				$('.informationDetailsBlock').addClass('hide');
	    	}else if( currentATagID == 'addressPartialButton' ){
	    		URL = "{{ URL::to('/college/addressPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'photoVideoPartialButton' ){
	    		URL = "{{ URL::to('/college/photoVideoPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'photoAchievementsButton' ){
	    		URL = "{{ URL::to('/college/achievementsPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'photoPlacementButton' ){
	    		URL = "{{ URL::to('/college/placementPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'accountSettingTab' ){
	    		URL = "{{ URL::to('/get-account-setting-partials/college') }}";
	    		$('.instituteDetailsBlock').removeClass('hide');
				$('.informationDetailsBlock').addClass('hide');
	    	}else if( currentATagID == 'managementPartialButton' ){
	    		URL = "{{ URL::to('/college/managementPartial') }}";
	    		$('.instituteDetailsBlock').removeClass('hide');
				$('.informationDetailsBlock').addClass('hide');
	    	}else if( currentATagID == 'scholarshipPartialButton' ){
	    		URL = "{{ URL::to('/college/scholarshipPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'facilitiesPartialButton' ){
	    		URL = "{{ URL::to('/college/facilitiesPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'coursesButton' ){
	    		URL = "{{ URL::to('/college/coursesPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'eventsPartialButton' ){
	    		URL = "{{ URL::to('/college/eventsPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'collegeSportsActivityTab' ){
	    		URL = "{{ URL::to('/college/sportsActivityPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}else if( currentATagID == 'collegeCutOffsTab' ){
	    		URL = "{{ URL::to('/college/collegeCutOffPartial') }}";
	    		$('.instituteDetailsBlock').addClass('hide');
				$('.informationDetailsBlock').removeClass('hide');
	    	}

	    	var slug = "{{ $slugUrl }}";
	    	$('#loadPartialsTemplates').html('');
	    	$('.loader').removeClass('hide');
	    	$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
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
		$('li > .profilePartialButton').on('click',function(){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
			$('.instituteDetailsBlock').removeClass('hide');
			$('.informationDetailsBlock').addClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/profilePartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PHOTOS AND VIDEOS
    	$('li > .addressPartialButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/addressPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PHOTOS AND VIDEOS
    	$('li > .photoVideoPartialButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
    		var slug = "{{ $slugUrl }}";
    		$('#loadPartialsTemplates').html('');
    		$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/photoVideoPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Awards + Achievements 
    	$('li > .photoAchievementsButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/achievementsPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Placement
    	$('li > .photoPlacementButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/placementPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

    	//GET PARTAILS FOR Management Details
    	$('li > .managementPartialButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').removeClass('hide');
			$('.informationDetailsBlock').addClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/managementPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

    	//GET PARTAILS FOR scholarship
    	$('li > .scholarshipPartialButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/scholarshipPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});


		//GET PARTAILS FOR facilities
    	$('li > .facilitiesPartialButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/facilitiesPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR courses
    	$('li > .coursesButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/coursesPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR EVENTS
    	$('li > .eventsPartialButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/eventsPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Sports & Activity
    	$('li > .collegeSportsActivityTab').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/sportsActivityPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Sports & Activity
    	$('li > .collegeCutOffsTab').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$('.instituteDetailsBlock').addClass('hide');
			$('.informationDetailsBlock').removeClass('hide');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/college/collegeCutOffPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

	});
//-------------------------------------------------------------------------------------//

//------------------------------ Logo upload validation ------------------------------//

	$('input[name=uploadCollegeLogo]').change(function (e)
		{   
			var ext = $('input[name=uploadCollegeLogo]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
				$("input[name=uploadCollegeLogo]").parsley().reset();
			}else{
				$('input[name=uploadCollegeLogo]').val('');
				$("input[name=uploadCollegeLogo]").parsley().reset();
				return false;
			}
			//Disable input file
		});
//--------------------------------End logo upload validation-------------------------//
</script>

{!! Html::script('home-layout/assets/js/plugins/jquery-ui.min.js') !!}
<script type="text/javascript">
  $(function() {
    $("#datepicker").datepicker({ minDate: 0, dateFormat: 'dd/mm/yy' }).datepicker("setDate", new Date());
  });
</script>

<script type="text/javascript">
	var minimized_elements = $('span.collegeDescMini');
    
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
	var minimized_elements = $('span.minimize1');
    
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
</script>
<script type="text/javascript">
	$('select[name=functionalarea_id]').on('change', function(){
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
            	HTML += '<option selected="" disabled="">Select degree</option>';
            	if( data.code == '200' ){
            		$.each(data.degreeObj, function(i, item) {
            			HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No degree available for this stream</option>';
            	}

            	$('select[name="degree_id"]').empty();
            	$('select[name="degree_id"]').html(HTML);
            	$('select[name="degree_id"]').trigger('chosen:updated');
            }
        });
	});
</script>

<script type="text/javascript">
	$('select[name=degree_id]').on('change', function(){
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
            	HTML += '<option selected="" disabled="">Select course</option>';
            	if( data.code == '200' ){
            		$.each(data.courseObj, function(i, item) {
            			HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No course available for this degree</option>';
            	}

            	$('select[name="course_id"]').empty();
            	$('select[name="course_id"]').html(HTML);
            	$('select[name="course_id"]').trigger('chosen:updated');
            }
        });
	});
</script>

<script type="text/javascript">
	$('#updateRegiAddress').on('click',function(){
		$('.nav-tabs > li').removeClass('active');
		$('#addressPartialButton').parent().addClass('active');
		$('#addressPartialButton').click();		
	});

	$('#updatecampusAddress').on('click',function(){
		$('.nav-tabs > li').removeClass('active');
		$('#addressPartialButton').parent().addClass('active');
		$('#addressPartialButton').click();		
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

	$('#updateMorePopup').on('click', function(){
		$('#updateDescNow').removeClass('hide');
		$.magnificPopup.open({
	        items: {
	            src: '#updateDescNow',
	        },
	        type: 'inline'
	    });		
	});

	$(document).ready(function(){
		var totalChars 		= 1200; //Total characters allowed in textarea
		var countTextBox 	= $('#counttextarea') // Textarea input box
		var charsCountEl 	= $('#countchars'); // Remaining chars count will be displayed here
		charsCountEl.text(totalChars); //initial value of countchars element
		countTextBox.keyup(function() { //user releases a key on the keyboard
			var thisChars = this.value.replace(/{.*}/g, '').length; //get chars count in textarea
			var per = thisChars*100; 
			var value= (per / totalChars); // total percent complete
			value = value.toFixed(2);
			if(thisChars > totalChars) //if we have more chars than it should be
			{
				var CharsToDel = (thisChars-totalChars); // total extra chars to delete
				this.value = this.value.substring(0,this.value.length-CharsToDel); //remove excess chars from textarea
			}else{
				charsCountEl.text( totalChars - thisChars ); //count remaining chars
				$('#percent').text(value +'%');
			}
		});	

		//INPUT BLUR
		$( 'input[name=fees]' ).focusin(function() {
	  		$('span.label-primary').removeClass('hide');
		});
		$( 'input[name=fees]' ).focusout(function() {
	  		$('span.label-primary').addClass('hide');
		});
	});
</script>

<script type="text/javascript">
	$('#accountSettingTab').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.instituteDetailsBlock').removeClass('hide');
		$('.informationDetailsBlock').addClass('hide');
		//$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";

		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },
            url: "{{ URL::to('/get-account-setting-partials/college') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});

	$('.accountSettingTabPage').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.instituteDetailsBlock').removeClass('hide');
		$('.informationDetailsBlock').addClass('hide');
		//$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";

		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },
            url: "{{ URL::to('/get-account-setting-partials/college') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});
</script>

<script type="text/javascript">
	$('#collegeBannerTab').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";

		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },
            url: "{{ URL::to('/get-banner-image-partials/college') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});

	$('.collegeBannerTabPage').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";

		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },
            url: "{{ URL::to('/get-banner-image-partials/college') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});
</script>

<script type="text/javascript">
	$('#facebookWidgetUrlTab').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";

		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },
            url: "{{ URL::to('/get-facebook-widget-partials') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});

	$('.facebookWidgetUrlTabPage').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";

		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },
            url: "{{ URL::to('/get-facebook-widget-partials') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});
</script>

<script type="text/javascript">
	$('#socialLinkManagementTab').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";

		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },

            url: "{{ URL::to('/get-social-link-management-partials') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});

	$('.socialLinkManagementTabPage').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";

		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },

            url: "{{ URL::to('/get-social-link-management-partials') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});
</script>

<script type="text/javascript">
	$('.affiliationLetters').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },
            url: "{{ URL::to('/get-affiliattion-letters/college') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});

	$('#affiliationAccreditationLetters').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnAffaliationClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		var slug = "{{ $slugUrl }}";
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data:{ slug: slug },
            url: "{{ URL::to('/get-affiliattion-letters/college') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});

	$('#profileRemoveTab').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAIL
		$('.hideOnAffaliationClick').removeClass('hide');
		$('.instituteDetailsBlock').removeClass('hide');
		$('.informationDetailsBlock').addClass('hide');
		var slug = "{{ $slugUrl }}";
		$('.profilePartialButton').parent().addClass('active');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {slug: slug},
            url: "{{ URL::to('/college/profilePartial') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });
	});

</script>

<script type="text/javascript">
	//AJAX
	$( '.profileUpdateNow1' ).submit(function(e) {
		$('.updateProfileBlock').addClass('hide');
  		e.preventDefault();
  		var form = $(this).serialize();

  		$('.fbloader').removeClass('hide');

		var facebookPageUrl = $('#facebookPageUrl').val();
		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("check-facebook-page-exists") }}',
	        data: {facebookPageUrl: facebookPageUrl},
	        success: function(data){
        		$('.fbloader').addClass('hide');
	            if( data !== '404' ){
	            	$.ajax({
				        type: "POST",
				        url: '{{ URL::to("college-profile-partial") }}',
				        data: form,
				        success: function(data){
				            if( data.code =='200' ){
				            	//window.location.reload();
				            	$('.updateProfileBlock').removeClass('hide');
				            	$('.updateProfileBlock .profileUpdateMessage').html(data.facebookMessage);
				            	$('#profileUpdate').modal({show: 'true'}); 
				            }
				        }
				    });	
	            }else{
	            	$('.errorFacebookMsg').removeClass('hide');
	            }
	        }
	    });  		
	});
</script>

@endsection
