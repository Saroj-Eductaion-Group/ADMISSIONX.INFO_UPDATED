@extends('website/new-design-layouts.master')

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

	.mfp-close{
		width: 25px !important;
	    height: 25px !important;
	    line-height: 25px !important;
	}
	.mfp-close-btn-in .mfp-close {
	    color: #ffffff !important;
	    background: #000000 !important;
    }

    .tab-v1 .nav-tabs a {
	    padding: 5px 10px;
	}
</style>
<style>
	/*.cards {display: flex; flex-wrap: wrap; align-items: stretch;}*/
	.cards {display: inline-flex; flex-wrap: wrap; align-items: stretch;}
	.cards article:hover{border: 1px solid #e2a41b;}
	.cards p:hover{color: #000000 !important;}
	.cards p{color: #fff !important;}
	.card {width: 157px; margin: 5px; border: 1px solid #000; background: darkcyan;} 
	.card img {max-width: 100%;}
	.card .text {padding: 5px 5px 0px 5px;text-align: center;}
	.card .text > button {background: gray;border: 0;color: white;padding: 10px;width: 100%;}

	.scrolling-wrapper {overflow-x: scroll;  overflow-y: hidden;  white-space: nowrap;}
	.cardMobile {display: inline-block;}
	.cardMobile {width: 145px; margin: 5px; border: 1px solid #000; background: darkcyan;} 
	.cardMobile img {max-width: 100%;}
	.cardMobile .text {padding: 5px 5px 0px 5px;text-align: center;}
	.cardMobile .text > button {background: gray;border: 0;color: white;padding: 10px;width: 100%;}
</style>
@endsection

@section('content')
	
	<div class="wrapper">
		<div class="container content profile">
			<div class="row">
				<div class="col-md-3 padding-left0">
					<div class="thumbnails thumbnail-style thumbnail-border">
						<div class="thumbnail-img">
							<div class="overflow-hidden">
								<a href="{{ URL::to('student', $slugUrl) }}">
									@if( $studentDataObj )
										@foreach( $studentDataObj as $studentData )
											<img class="img-responsive" src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $studentData->galleryName }}" alt="{{ $studentData->galleryName }}">
											<a class="btn-more hover-effect" href="{{ url('student/delete-student-pic/') }}/{{ $studentData->galleryId }}/{{ $slugUrl }}"><i class="fa fa-trash"></i> Delete</a>
										@endforeach
									@else
										<img class="img-responsive" src="/assets/images/no-college-logo.jpg" alt="Student Profile Images">
									@endif
								</a>
							</div>
						</div>
					</div>

					<div class="form-group margin-top10 margin-bottom10 tag-box tag-box-v2 box-shadow shadow-effect-1">
	                	<button class="btn btn-block btn-u" id="uploadNewLogoNow">Upload New Profile Picture</button>
	                	<div class="hide" id="uploadLogoForm">
	                		{!! Form::open(['url' => 'student/upload-student-pic', 'class' => 'form-horizontal uploadGalleryLogoImg', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
		                		@if($studentDataObj)
			                		@foreach(  $studentDataObj as  $studentData )
										<input type="hidden" name="galleryId" value="{{ $studentData->galleryId }}">
									@endforeach
								@endif
		                		<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
		                		<label for="file" class="input input-file">
					                <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
					                <input type="file" class="form-control" name="uploadStudentPic" class="input input-file collegeLogo"  data-parsley-trigger="change" data-parsley-error-message="Please upload only png , jpg or jpeg." required="">
					            </label>
					            <button class="btn btn-block btn-u">Upload Now</button>
				            {!! Form::close() !!}
				            <!-- <p class="text-danger text-center">(Please upload only jpg or jpeg.)</p> -->
	                	</div>
			        </div>
					
				</div>
				<div class="col-md-9">
					@if(Session::has('collegeProfileReviewStatus'))
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('collegeProfileReviewStatus') }}</strong>
					</div>
					@endif
					@if(Session::has('studentMarksUpdateMsg'))
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('studentMarksUpdateMsg') }}</strong>
					</div>
					@endif

					@if(Session::has('studentMarksUpdatemessage'))
					<div class="alert alert-success alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('studentMarksUpdatemessage') }}</strong>
					</div>
					@endif
					@if(Session::has('academicrecordMessage'))
					<div class="alert alert-success alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('academicrecordMessage') }}</strong>
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
					<div class="row">
						@if($agent->isMobile())
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 text-center hidden-lg hidden-md">
							<div class="scrolling-wrapper">
								<div class="cardMobile" style="min-height: 80px;">
									<a title="Queries" href="{{ URL::to('student/check-queries/view') }}" style="text-decoration: none;">
								    	<div class="text">
								    		<p class="textColorBlack text-capitalize fontSize15  textDecoration" style="padding-top: 20px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis; color: #fff;" ><i class="fa fa-comments"></i> Queries</p>
								    		<p>{{ $getQueriesCount }}</p>
								    	</div>
									</a>
							  	</div>
							  	<div class="cardMobile" style="min-height: 80px;">
									<a title="Queries" href="{{ URL::to('student/check-applications/view') }}" style="text-decoration: none;">
								    	<div class="text">
								    		<p class="textColorBlack text-capitalize fontSize15  textDecoration" style="padding-top: 20px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis; color: #fff;" ><i class="fa fa-file"></i> Application {{ $getApplicationsCount }}</p>
								    		<p>{{ $getApplicationsCount }}</p>
								    	</div>
									</a>
							  	</div>
							  	<div class="cardMobile" style="min-height: 80px;">
									<a title="Queries" href="{{ URL::to('student/check-bookmark/courses') }}" style="text-decoration: none;">
								    	<div class="text">
								    		<p class="textColorBlack text-capitalize fontSize15  textDecoration" style="padding-top: 20px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis; color: #fff;" ><i class="fa fa-book"></i> Bookmark Courses</p>
								    		<p>{{ $getCoursesBookmarkCount }}</p>
								    	</div>
									</a>
							  	</div>
							  	<div class="cardMobile" style="min-height: 80px;">
									<a title="Queries" href="{{ URL::to('student/check-bookmark/colleges') }}" style="text-decoration: none;">
								    	<div class="text">
								    		<p class="textColorBlack text-capitalize fontSize15  textDecoration" style="padding-top: 20px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis; color: #fff;" ><i class="fa fa-star"></i> Bookmark College</p>
								    		<p>{{ $getCollegeBookmarkCount }}</p>
								    	</div>
									</a>
							  	</div>
							  	<div class="cardMobile" style="min-height: 80px;">
									<a title="Queries" href="{{ URL::to('student/check-bookmark/blog') }}" style="text-decoration: none;">
								    	<div class="text">
								    		<p class="textColorBlack text-capitalize fontSize15  textDecoration" style="padding-top: 20px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis; color: #fff;" ><i class="fa fa-bookmark"></i> Bookmark Blogs</p>
								    		<p>{{ $getBlogBookmarkCount }}</p>
								    	</div>
									</a>
							  	</div>
							</div>
						</div>
						@endif
						@if($agent->isDesktop() || $agent->isTablet())
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 text-center hidden-xs hidden-sm">
							<main class="cards">
								<article class="card" style="min-height: 120px;">
									<a title="Queries" href="{{ URL::to('student/check-queries/view') }}" style="text-decoration: none;">
									    <div class="text">
									    	<p class="textColorBlack text-capitalize  textDecoration" style="padding-top: 30px; font-size: large;"><i class="fa fa-comments"></i> Queries</p>
									    	<p style="font-size: large;">{{ $getQueriesCount }}</p>
									    </div>
									</a>
							  	</article>
							  	<article class="card" style="min-height: 120px;">
									<a title="Queries" href="{{ URL::to('student/check-applications/view') }}" style="text-decoration: none;">
									    <div class="text">
									    	<p class="textColorBlack text-capitalize  textDecoration" style="padding-top: 30px; font-size: large;"><i class="fa fa-file"></i> Application</p>
									    	<p style="font-size: large;">{{ $getApplicationsCount }}</p>
									    </div>
									</a>
							  	</article>
							  	<article class="card" style="min-height: 120px;">
									<a title="Queries" href="{{ URL::to('student/check-bookmark/courses') }}" style="text-decoration: none;">
									    <div class="text">
									    	<p class="textColorBlack text-capitalize  textDecoration" style="padding-top: 30px; font-size: large;"><i class="fa fa-book"></i> Bookmark Courses</p>
									    	<p style="font-size: large;">{{ $getCoursesBookmarkCount }}</p>
									    </div>
									</a>
							  	</article>
							  	<article class="card" style="min-height: 120px;">
									<a title="Queries" href="{{ URL::to('student/check-bookmark/colleges') }}" style="text-decoration: none;">
									    <div class="text">
									    	<p class="textColorBlack text-capitalize  textDecoration" style="padding-top: 30px; font-size: large;"><i class="fa fa-star"></i> Bookmark College</p>
									    	<p style="font-size: large;">{{ $getCollegeBookmarkCount }}</p>
									    </div>
									</a>
							  	</article>
							  	<article class="card" style="min-height: 120px;">
									<a title="Queries" href="{{ URL::to('student/check-bookmark/blog') }}" style="text-decoration: none;">
									    <div class="text">
									    	<p class="textColorBlack text-capitalize  textDecoration" style="padding-top: 30px; font-size: large;"><i class="fa fa-bookmark"></i> Bookmark Blogs</p>
									    	<p style="font-size: large;">{{ $getBlogBookmarkCount }}</p>
									    </div>
									</a>
							  	</article>
							</main>
			        	</div>
			        	@endif
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<h1 class="">
								<a class="hover-effect college-name-style-black" >
									{!! $studentName = ''; !!} {!! $studentName1 = ''; !!} {!! $studentName2 = ''; !!}
									@if( $getStudentNameObj )
										@foreach( $getStudentNameObj as $getStudentName )
											{{ $getStudentName->firstname }} {{ $getStudentName->middlename }} {{ $getStudentName->lastname }} <a href="{{ URL::to('student', $slugUrl) }}" title="{{ $getStudentName->firstname }}"></a>
											<?php $studentName = $getStudentName->firstname; ?>
											<?php $studentName1 = $getStudentName->middlename; ?>
											<?php $studentName2 = $getStudentName->lastname; ?>
										@endforeach
									@endif						
								</a>
							</h1>
							<p>
								<span id="combinedAddress" class="hide"></span>
								@foreach( $getAddressData as $getAddress )
									@if( $getAddress->addresstypeId  == '3' )
										@if( !empty( $getAddress->name ) )
											<p id="redAdd" class="hide"><span class="label label-success">{{ $getAddress->addresstypeName }}</span> : <span class="minimizeRegiAddress" id="firstAddressHere">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->cityName }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong>, {{ $getAddress->postalcode }}</span></p>
								    	@else
								    		<p><a href="javascript:void(0);" id="updatePermanentAddress"><span class="label label-danger">Please Update Your Permanent Address</span></a></p>
								    	@endif
			                        @elseif( $getAddress->addresstypeId  == '4' )
			                        	@if( !empty( $getAddress->name ) )
			                        		<p id="camAdd" class="hide"><span class="label label-warning">{{ $getAddress->addresstypeName }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> : <span class="minimizeCampusAddress" id="secondAddressHere">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->cityName }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong>, {{ $getAddress->postalcode }}</span></p>
								    	@else
								    		<p><a href="javascript:void(0);" id="updatePresentAddress"><span class="label label-danger">Please Update Your Present Address</span></a></p>
								    	@endif			                        	
			                        @else
			                        	Address Updated Yet
			                        @endif
			                    @endforeach
							</p>
							<div>
								<span class="label label-primary">D.O.B. | Phone No &nbsp;</span> : 
								@foreach( $studentDOBDataObj as $getDobPhone )
									<label class="text-primary">
										 @if( strtotime($getDobPhone->dateofbirth) == strtotime('0000-00-00 00:00:00') )
		                                        --
		                                @else
		                                    {{--*/ $timestamp = strtotime($getDobPhone->dateofbirth) /*--}}
		                                    {{ date('M d, Y', $timestamp) }}
		                                @endif
									</label>
									<label class="text-primary">( Age as on {!! date('d-m-Y') !!} : </label>
									<label class="text-primary calculatedDateFromNow">{{ $calculateDate }} )</label>
									| {{ $getDobPhone->userPhone }}
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--=== Profile ===-->
		<div class="container content profile padding0">
			<div class="row">
				<!-- Profile Content -->
				<div class="col-md-3 md-margin-bottom-40">
					<ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseStudentDetailMenu"><i class="fa fa-user"></i> Student Details</a>
							<div id="collapseStudentDetailMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="javascript:void(0);" id="profileClickTab"><i class="fa fa-user"></i> Account Details</a></li>
									<li><a href="#address" class="addressPartialButton" id="addressPartialButton" href="javascript:void(0);"><i class="fa fa-map-marker"></i> Address </a></li>
									<li><a href="#academicmarks" class="academicMarksPartialButton" id="academicMarksPartialButton" href="javascript:void(0);"><i class="fa fa-bars"></i> Academic Details</a></li>
									<li><a href="#academicrecord" class="academicRecordPartialButton" id="academicRecordPartialButton" href="javascript:void(0);"><i class="fa fa-file"></i> Academic Certificates</a></li>
									<li><a href="#projectrecord" class="projectRecordPartialButton" id="projectRecordPartialButton" href="javascript:void(0);"><i class="fa fa-book"></i> Projects</a></li>
									<li><a href="#accountsetting" class="accountSettingPartialButton" id="accountSettingPartialButton"><i class="fa fa-cog"></i> Account Settings</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseApplicationMenu"><i class="fa fa-file"></i> Application</a>
							<div id="collapseApplicationMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="{{ URL::to('student/check-applications/accepted') }}"><i class="fa fa-file"></i> Accepted</a></li>
									<li><a href="{{ URL::to('student/check-applications/pending') }}"><i class="fa fa-file"></i> Pending</a></li>
									<li><a href="{{ URL::to('student/check-applications/rejected') }}"><i class="fa fa-file"></i> Rejected</a></li>
									<li><a href="{{ URL::to('student/check-applications/view') }}"><i class="fa fa-file"></i> View All</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseQueryMenu"><i class="fa fa-comments"></i> Queries</a>
							<div id="collapseQueryMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="{{ URL::to('student/check-queries/replied') }}"><i class="fa fa-comments"></i> Replied</a></li>
									<li><a href="{{ URL::to('student/check-queries/pending') }}"><i class="fa fa-comments"></i> Pending</a></li>
									<li><a href="{{ URL::to('student/check-queries/view') }}"><i class="fa fa-comments"></i> View All</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseBookmarkMenu"><i class="fa fa-bookmark"></i> Bookmarks</a>
							<div id="collapseBookmarkMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="javascript:void(0);" id="bookmarkCourses"><i class="fa fa-book"></i> Bookmark Courses</a></li>
									<li><a href="javascript:void(0);" id="bookmarkCollege"><i class="fa fa-star"></i> Bookmark College</a></li>
									<li><a href="javascript:void(0);" id="bookmarkBlogs"><i class="fa fa-bookmark"></i> Bookmark Blogs</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a data-toggle="collapse" href="#collapseQACMenu"><i class="fa fa-files-o"></i> Question/Answer/Comment</a>
							<div id="collapseQACMenu" class="panel-collapse collapse">
								<ul class="">
			                        <li><a href="{{ URL::to('student/submit-question-list/'.$slugUrl) }}"><i class="fa fa-pencil"></i> Question</a></li>
									<li><a href="{{ URL::to('student/submit-answer-list/'.$slugUrl) }}"><i class="fa fa-pencil"></i> Answer</a></li>
									<li><a href="{{ URL::to('student/submit-comments-list/'.$slugUrl) }}"><i class="fa fa-pencil"></i> Commants</a></li>
								</ul>
							</div>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('student/review-list', $slugUrl) }}" target="_blank"><i class="fa fa-tachometer"></i> Your Reviews</a>
						</li>
						<li class="list-group-item">
							<a href="{{ URL::to('student/counselling/'.$slugUrl.'/forms') }}" target="_blank"><i class="fa fa-book"></i> Counselling Forms</a>
						</li>
						<li class="list-group-item"><a href="{{ URL::to('careers-courses') }}" target="_blank"><i class="fa fa-users" aria-hidden="true"></i> Counseling</a></li>
						<!-- <li class="list-group-item"><a href="{{ URL::to('counselling') }}" target="_blank"><i class="fa fa-users" aria-hidden="true"></i> Counseling</a></li> -->
						<li class="list-group-item"><a href="{{ URL::to('help-center') }}" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i> Help Desk</a></li>
						<li class="list-group-item">
							<a href="{{ URL::to('student', $slugUrl) }}" target="_blank"><i class="fa fa-link"></i> Profile View</a> 
						</li> 

					</ul>
				</div>
				<div class="col-sm-9 col-md-9 col-lg-9">
					<div class="profile-body margin-bottom-20">
						<div class="tab-v1">
							<ul class="nav nav-justified nav-tabs hideOnBookamrkClick">
								<li class="active"><a href="#profile" class="profilePartialButton" id="profilePartialButton" href="javascript:void(0);">Profile <i class="fa fa-edit"></i></a></li>
								<li><a href="#address" class="addressPartialButton" id="addressPartialButton" href="javascript:void(0);">Address <i class="fa fa-edit"></i></a></li>
								<li><a href="#academicrecord" class="academicRecordPartialButton" id="academicRecordPartialButton" href="javascript:void(0);">Academic Certificates <i class="fa fa-edit"></i></a></li>
								<li><a href="#projectrecord" class="projectRecordPartialButton" id="projectRecordPartialButton" href="javascript:void(0);">Projects <i class="fa fa-edit"></i></a></li>
								<li><a href="#accountsetting" class="accountSettingPartialButton" id="accountSettingPartialButton" href="javascript:void(0);">Account Settings <i class="fa fa-edit"></i></a></li>
							</ul>
							<div class="tab-content">
								<!-- START COLLECTION OF PARTAILS TAB -->
								<p class="text-center loader">
									<img src="{{asset('assets/images/loading.gif')}}" width="64">	
								</p>
				            	<div>
				                	@if(Session::has('accountSettingsUpdate'))
										<div class="alert alert-warning alert-dismissable text-center" id="dialog" role="alert">
					                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button" aria-label="Close">
					                        	<span aria-hidden="true">&times;</span>
					                        </button>
					                        <strong>{{ Session::get('accountSettingsUpdate') }} </strong>                       
					                    </div>
					            	@endif
								</div>
								<div id="loadPartialsTemplates"> </div>
								<!-- END PROFILE TAB -->
							</div>
						</div>
					</div>
					<!-- Student Academic Records -->
					<div class="academicRecordSection hide">
						@include('student.dashboard.academicMarksRecord')
					</div>
				</div>
				<!-- End Profile Content -->
			</div><!--/end row-->
		</div>
		<!--=== End Profile ===-->
	</div>
@endsection

@section('scripts')

{!! Html::script('assets/js/forms/signup-detail.js') !!}
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}

<script type="text/javascript">
	jQuery(document).ready(function() {
		SignUpDetailForm.initSignUpForm();
	});
</script>
<script type="text/javascript">
	$('form').parsley();
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
	$(".alert").fadeTo(10000, 500).slideUp(500, function(){
    //$(".alert").alert('close');
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
	
	$('form').parsley();

    $('.collegeLogo').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.collegeLogo').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });

	//------------------------------ Logo upload validation ------------------------------//

	$('input[name=uploadStudentPic]').change(function (e)
		{   
			var ext = $('input[name=uploadStudentPic]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
				$("input[name=uploadStudentPic]").parsley().reset();
			}else{
				$('input[name=uploadStudentPic]').val('');
				$("input[name=uploadStudentPic]").parsley().reset();
				return false;
			}
			//Disable input file
		});

	$(document).on('click', '#uploadNewLogoNow', function(){
			$('#uploadNewLogoNow').addClass('hide');
			$('#uploadLogoForm').addClass('fadeIn');
			$('#uploadLogoForm').addClass('animated');
			$('#uploadLogoForm').removeClass('hide');
		});
//--------------------------------End logo upload validation-------------------------//

//--ON LOAD PROFILE FORM-----------------------------------------------------------------------------------//
	$(document).ready(function(){
		var slug = "{{ $slugUrl }}";
		$('.profilePartialButton').parent().addClass('active');
		$('#loadPartialsTemplates').html('');
		$('.academicRecordSection').addClass('hide');
		$('.hideOnBookamrkClick').removeClass('hide');
		$('.loader').removeClass('hide');
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {slug: slug},
            url: "{{ URL::to('/student/profilePartial') }}",
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
	    	if( currentATagID == 'profilePartialButton' ){
	    		URL = "{{ URL::to('/student/profilePartial') }}";
	    	}else if( currentATagID == 'addressPartialButton' ){
	    		URL = "{{ URL::to('/student/addressPartial') }}";
	    	}else if( currentATagID == 'academicRecordPartialButton' ){
	    		URL = "{{ URL::to('/student/photoVideoPartial') }}";
	    	}else if( currentATagID == 'projectRecordPartialButton' ){
	    		URL = "{{ URL::to('/student/projectPartial') }}";
	    	}else if( currentATagID == 'accountSettingPartialButton' ){
	    		URL = "{{ URL::to('/student/accountSetting') }}";
	    	}

	    	var slug = "{{ $slugUrl }}";
	    	$('.hideOnBookamrkClick').removeClass('hide');
	    	$('#loadPartialsTemplates').html('');
	    	$('.academicRecordSection').addClass('hide');
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
			$('.hideOnBookamrkClick').removeClass('hide');
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.academicRecordSection').addClass('hide');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/profilePartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PHOTOS AND VIDEOS
    	$('li > .addressPartialButton').on('click',function(){
			$('.hideOnBookamrkClick').removeClass('hide');
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.academicRecordSection').addClass('hide');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/addressPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PHOTOS AND VIDEOS
    	$('li > .academicRecordPartialButton').on('click',function(){
    		$('.hideOnBookamrkClick').removeClass('hide');
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
    		var slug = "{{ $slugUrl }}";
    		$('#loadPartialsTemplates').html('');
    		$('.academicRecordSection').addClass('hide');
    		$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/photoVideoPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		$('li > .projectRecordPartialButton').on('click',function(){
    		$('.hideOnBookamrkClick').removeClass('hide');
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
    		var slug = "{{ $slugUrl }}";
    		$('#loadPartialsTemplates').html('');
    		$('.academicRecordSection').addClass('hide');
    		$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/projectPartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		$('li > .accountSettingPartialButton').on('click',function(){
    		$('.hideOnBookamrkClick').removeClass('hide');
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
    		var slug = "{{ $slugUrl }}";
    		$('#loadPartialsTemplates').html('');
    		$('.academicRecordSection').addClass('hide');
    		$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/accountSetting') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});


		$('#updatePermanentAddress').on('click',function(){
			$('.nav-tabs > li').removeClass('active');
			$('#addressPartialButton').parent().addClass('active');
			$('#addressPartialButton').click();		
		});

		$('#updatePresentAddress').on('click',function(){
			$('.nav-tabs > li').removeClass('active');
			$('#addressPartialButton').parent().addClass('active');
			$('#addressPartialButton').click();		
		});

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

		$('table > tbody tr > td > #updateStudentMarksID').click(function(){
       		var studentmarksId = $(this).next('.studentmarksId').val();
       		var slugUrl = "{!! $slugUrl !!}";
		    $.ajax({
		        type: "GET",
		        url: '/studentMarksPartial',
		        data: {
		            studentmarksId: studentmarksId,
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

		$('#profileClickTab').on('click', function(){
			$('.hideOnBookamrkClick').removeClass('hide');
			var slug = "{{ $slugUrl }}";
			$('.profilePartialButton').parent().addClass('active');
			$('#loadPartialsTemplates').html('');
			$('.academicRecordSection').addClass('hide');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/profilePartial') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	                $('#loadPartialsTemplates').html(data);
	            }
	        });
		});

	});
//-------------------------------------------------------------------------------------//
</script>

<script type="text/javascript">
  $(function() {
    $("#datepicker").datepicker({ dateFormat: 'dd/mm/yy' }).datepicker("setDate", new Date());
  });

  	$(document).ready(function(){
	    $('.studentMarksForm').hide();
        $(document).on('click', '#addNewMarks', function(){
        	$(".studentMarksForm").toggle();
            $(".studentMarksForm").css("visibility","visible");
        }); 
    }); 
</script>
<script type="text/javascript">
	$('#academicMarksPartialButton').on('click', function(){
		$('.hideOnBookamrkClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.academicRecordSection').removeClass('hide');
	});

	$('#clodeMarksRecords').on('click', function(){
		$('.hideOnBookamrkClick').removeClass('hide');
		$('.academicRecordSection').addClass('hide');
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
            url: "{{ URL::to('/student/profilePartial') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });
	});

</script>
<script type="text/javascript">
	$('#bookmarkCourses').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnBookamrkClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.academicRecordSection').addClass('hide');
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
            url: "{{ URL::to('/get-bookmark-course/student') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});
</script>
<script type="text/javascript">
	$('#bookmarkCollege').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnBookamrkClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.academicRecordSection').addClass('hide');
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
            url: "{{ URL::to('/get-bookmark-college/student') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});
</script>
<script type="text/javascript">
	$('#bookmarkBlogs').on('click', function(){
		//LOAD ACCOUNT SETTING PARTAILS
		$('.loader').removeClass('hide');
		$('.hideOnBookamrkClick').addClass('hide');
		$('#loadPartialsTemplates').html('');
		$('.academicRecordSection').addClass('hide');
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
            url: "{{ URL::to('/get-bookmark-blogs/student') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
                $('#loadPartialsTemplates').html(data);
            }
        });	
	});
</script>

@endsection
