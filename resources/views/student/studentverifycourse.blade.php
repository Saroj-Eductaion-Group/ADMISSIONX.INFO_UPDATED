@extends('website/new-design-layouts.master')
@section('styles')
{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
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

	.course-details { color: #000; }
</style>
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-3">
				@if( $getCollegeProfileDataObj )
						@foreach( $getCollegeProfileDataObj as $collegeData )
							<div class="thumbnails thumbnail-style thumbnail-border blockStyleProfile blockBGStyle blockStyleProfileOverFlow" style="background-image: url('{{asset('gallery/')}}/{{ $slugUrl }}/{{ $collegeData->galleryName }}');">
								<div class="pull-right">
									<div class="fb-share-button" data-href="{{ env('APP_URL') }}/college/{{$slugUrl}}" data-layout="button" data-size="large" data-mobile-iframe="true">
										<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F{{$slugUrl}}&amp;src=sdkpreparse"><img src="/home-layout/assets/img/icons/other/share-on-facebook.png"></a>
									</div>
								</div>
							</div>
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
					<a class="hover-effect college-name-style-black" href="#">
						@if( $getCollegeDetailObj )
							@foreach( $getCollegeDetailObj as $getCollegeName )
								{{ $getCollegeName->firstname }}
							@endforeach
						@endif						
					</a>
				</h1>
				<p>
					<span id="combinedAddress" class="hide"></span>
					@foreach( $getCollegeAddressObj as $getAddress )
						@if( $getAddress->addresstypeId  == '1' )
							@if( !empty( $getAddress->name ) )
								<p id="redAdd" class="hide"><span class="label label-success">{{ $getAddress->addresstypeName }}</span> : <span class="minimizeRegiAddress">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->cityName }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong>, {{ $getAddress->postalcode }}</span></p>
					    	@else
					    		
					    	@endif
                        @elseif( $getAddress->addresstypeId  == '2' )
                        	@if( !empty( $getAddress->name ) )
                        		<p id="camAdd" class="hide"><span class="label label-warning">{{ $getAddress->addresstypeName }}</span> : <span class="minimizeCampusAddress">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->cityName }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong>, {{ $getAddress->postalcode }}</span></p>
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
								<p>
								@if( $item->facilitiesId == '1' )
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
								@endif
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
					<!-- <li><a href="javascript:void(0);" class="badgesSize courseName" name="courseName" title="Bookmark this college"><i class="bookmarkHeart rounded-x icon-heart"></i></a></li> -->
				</ul>
				
			</div>
		</div>
	</div>
</div>

<div class="wrapper">
	<div class="container content profile padding-top0">
		<div class="row">
			{!! Form::model($studentApplyCourseDataObj , ['url' => 'student-course-apply-details', 'method' => 'POST', 'class' => 'form-horizontal profileUpdateNow','data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!} <!-- 'data-parsley-validate' => '' -->
			<input type="hidden" name="studentSlug" value="{{ $studentSlug }}">
			<input type="hidden" name="courseMasterID" value="{{ $courseMasterID }}">
			<input type="hidden" name="collegeProfileID" value="{{ $slugUrl }}">

			<input type="hidden" name="totalfees" value="@if( $collegeProfileObj ){{ $collegeProfileObj->courseFee }} @endif">
			{{--*/ $totalAmt = $collegeProfileObj->courseFee;  /*--}}
			<!-- <input type="hidden" name="byafees" value="{{ 10/100*($totalAmt)  }}">
			<input type="hidden" name="restfees" value="{{ 90/100*($totalAmt)  }}"> -->
			<input type="hidden" name="byafees" value="499">
			<input type="hidden" name="restfees" value="{{ $totalAmt-499  }}">

			<div class="col-md-12">
				<div class="profile-body">
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-12">
								<h2>Book Admission</h2>									
							</div>						
						</div>

						<div class="row">
							<div class="col-md-12">
								<span>
									<strong>College Annual Fee:</strong> 
									Rs. @if( $collegeProfileObj ){{ $collegeProfileObj->courseFee }}/- @endif
								</span>
								<span>
									<strong>Amount Payable with the application:</strong>
									Rs. 499/-
									<!-- Rs. {{ 10/100*($totalAmt)  }}/- -->
								</span>
								<span>
									<strong>Remaining Amount Payable at college:</strong>
									Rs. {{ $totalAmt-499  }}/-
									<!-- Rs. {{ 90/100*($totalAmt)  }}/- -->
								</span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-6 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left"><i class="fa fa-info"></i> Basic Information</h2>
								</div>
								<div class="panel-body">
									@if( $studentApplyCourseDataObj )
										@foreach(  $studentApplyCourseDataObj as  $item )
											<ul class="list-unstyled social-contacts-v2">
												<li class="margin-bottom-10">First Name<input type="text" class="form-control" name="firstname" value="{{ $item->firstName }}" required="" placeholder="Enter first name here" readonly=""></li>
												<li class="margin-bottom-10">Middle Name<input type="text" class="form-control" name="middlename" value="{{ $item->middleName }}" placeholder="Enter middle name here" readonly=""></li>
												<li class="margin-bottom-10">Last Name<input type="text" class="form-control" name="lastname" value="{{ $item->lastName }}" required="" placeholder="Enter last name here" readonly=""></li>
												<li class="margin-bottom-10"><p class="text-info">For updating your details please click to <a href="/student/dashboard/edit/{{ $studentSlug }}#accountsetting">Dashboard > Account Settings</a></p></li>
												<li class="margin-bottom-10">I am 
													@if(!empty($item->gender))
													<input type="text" class="form-control" name="gender" value="{{ $item->gender }}" placeholder="Enter gender here" readonly="">
													@else
													<select class="form-control" name="gender" required="" data-parsley-trigger="change" data-parsley-error-message="Please select gender">
														<option disabled="" selected="">Select Gender</option>
														<option @if($item->gender == 'Male') selected="" @endif value="Male">Male</option>
							                            <option @if($item->gender == 'Female') selected="" @endif value="Female">Female</option>
							                            <option @if($item->gender == 'Other') selected="" @endif value="Other">Other</option>
													</select>
													@endif
												</li>
												<li class="margin-bottom-10">
													Date of Birth<input type="date" id="dateChange" class="form-control" name="dateofbirth" value="{{ $item->dateofbirth }}" @if(!empty($item->dateofbirth) && ($item->dateofbirth != "0000-00-00")) readonly="" @else required="" data-parsley-trigger="change" data-parsley-error-message="Please select valid date of birth" @endif>
													<label class="text-primary">Age as on {!! date('d-m-Y') !!} : </label>
													<label class="text-primary calculatedDateFromNow">{{ $calculateDate }}</label>
												</li>
												<li class="margin-bottom-10">Email Address<input type="text" class="form-control" name="email" value="{{ $item->userEmailAddress }}" placeholder="Enter email address here" data-parsley-type="email"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" readonly=""></li>
												<li class="margin-bottom-10">Phone<input type="text" class="form-control" name="phone" value="{{ $item->userPhone }}" placeholder="Enter mobile number here" data-parsley-type="digits" data-parsley-trigger="change"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid mobile number"  required="" readonly=""></li><!-- data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10, 10]" maxlength="10"-->
											</ul>
										@endforeach
									@endif
								</div>
							</div>
						</div>

						<div class="col-sm-6 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left"><i class="fa fa-graduation-cap"></i> Acedemic Information</h2>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled social-contacts-v2">
											<!-- <li class="margin-bottom-10">
												Class 10th Percentage
												{{--*/ $Percent10 = ''; /*--}}
												@if( $getStudent10thmarksObj )
													@foreach(  $getStudent10thmarksObj as  $item )
														@if( $item->marksName == '10th' )
															{{--*/  $Percent10 = $item->percentage /*--}}
														@endif
													@endforeach
												@endif
												<input type="text" class="form-control" name="tenthMarksPercentage" value="{{ $Percent10 }}" placeholder="Enter 10th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 10th percentage here" data-parsley-type="digits" data-parsley-length ="[2, 3]" data-parsley-minlength="1" data-parsley-maxlength="3" maxlength="3" data-parsley-max="100">
											</li> -->
										<li class="margin-bottom-10">
											Class 10th Percentage
											@if( $getStudent10thmarksObj )
					                            @foreach(  $getStudent10thmarksObj as  $student10thMarksData )
					                                @if( $student10thMarksData->marksName == '10th' )
					                                	@if(empty($student10thMarksData->percentage))
						                               	<select class="form-control" name="tenthMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 10th percentage" required="">
						                                    <option value="" disabled="" selected="">Please Select 10 Percentage</option>
						                                    {{--*/ $Percent10 = '1' /*--}}
						                                    @for( $Percent10 = '1'; $Percent10 < '101'; $Percent10++ )
						                                        @if( $student10thMarksData->percentage == $Percent10 )
						                                            <option value="{{ $Percent10 }}" selected="">{{ $Percent10 }}%</option>
						                                        @else
						                                            <option value="{{ $Percent10 }}">{{ $Percent10 }}%</option>
						                                        @endif
						                                    @endfor
						                                </select> 
						                                @else
					                            		<input type="text" class="form-control" name="tenthMarksPercentage" value="{{ $student10thMarksData->percentage }}"  placeholder="Enter Class 10th Percentage here" readonly="">
					                            		@endif
					                                @endif
					                            @endforeach
					                        @else
					                            <select class="form-control" name="tenthMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 10th percentage" required="">
					                                <option value="" disabled="" selected="">Please Select 10 Percentage</option>
					                                {{--*/ $Percent10 = '1' /*--}}
					                                @for( $Percent10 = '1'; $Percent10 < '101'; $Percent10++ )
					                                    <option value="{{ $Percent10 }}">{{ $Percent10 }}%</option>
					                                @endfor
					                            </select>
					                        @endif											
										</li>
										<li class="margin-bottom-10">Class 10th Mark sheet
											<a href="javascript:void(0);" class="removeTabAction hide" id="remove1"><i class="fa fa-remove"></i></a>
											<input type="file" class="form-control" name="tenMarksheet">
											<p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
										</li>
										<!-- <li class="margin-bottom-10">
										Class 11th Percentage
											{{--*/ $Percent11 = ''; /*--}}
											@if( $getStudent11thmarksObj )
												@foreach(  $getStudent11thmarksObj as  $item )
													@if( $item->marksName == '11th' )
														{{--*/  $Percent11 = $item->percentage /*--}}
													@endif
												@endforeach
											@endif
											<input type="text" class="form-control" name="eleventhMarksPercentage" value="{{ $Percent11 }}" placeholder="Enter 11th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 11th percentage here" data-parsley-type="digits" data-parsley-length ="[2, 3]" data-parsley-minlength="1" data-parsley-maxlength="3" maxlength="3" data-parsley-max="100">
										</li> -->

										<li class="margin-bottom-10">
											Class 11th Percentage
											@if( $getStudent11thmarksObj )
					                            @foreach(  $getStudent11thmarksObj as $student11thMarksData )
					                                @if( $student11thMarksData->marksName == '11th' )
						                                @if(empty($student11thMarksData->percentage))
						                                <select class="form-control" name="eleventhMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 11th percentage" required="">
						                                    <option value="" disabled="" selected="">Please Select 11 Percentage</option>
						                                    {{--*/ $Percent11 = '1' /*--}}
						                                    @for( $Percent11 = '1'; $Percent11 < '101'; $Percent11++ )
						                                        @if( $student11thMarksData->percentage == $Percent11 )
						                                            <option value="{{ $Percent11 }}" selected="">{{ $Percent11 }}%</option>
						                                        @else
						                                            <option value="{{ $Percent11 }}">{{ $Percent11 }}%</option>
						                                        @endif
						                                    @endfor
						                                </select>
						                                @else
					                                	<input type="text" class="form-control" name="eleventhMarksPercentage" value="{{ $student11thMarksData->percentage }}"  placeholder="Enter Class 11th Percentage here" readonly="">
					                                	@endif
					                                @endif
					                            @endforeach
					                        @else
					                            <select class="form-control" name="eleventhMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 11th percentage" required="">
					                                <option value="" disabled="" selected="">Please Select 11 Percentage</option>
					                                {{--*/ $Percent11 = '1' /*--}}
					                                @for( $Percent11 = '1'; $Percent11 < '101'; $Percent11++ )
					                                    <option value="{{ $Percent11 }}">{{ $Percent11 }}%</option>
					                                @endfor
					                            </select>
					                        @endif
				                        </li>
										<li class="margin-bottom-10">Class 11th Mark sheet
											<a href="javascript:void(0);" class="removeTabAction hide" id="remove2"><i class="fa fa-remove"></i></a>
											<input type="file" class="form-control" name="elevenMarksheet">
											<p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
										</li>
										<!-- <li class="margin-bottom-10">Class 12th Percentage
										{{--*/ $Percent12 = ''; /*--}}
											@if( $getStudent12thmarksObj )
												@foreach(  $getStudent12thmarksObj as  $item )
													@if( $item->marksName == '12th' )
														{{--*/  $Percent12 = $item->percentage /*--}}
													@endif
												@endforeach
											@endif
											<input type="text" class="form-control" name="twelveMarksPercentage" value="{{ $Percent12 }}" placeholder="Enter 12th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 12th percentage here" data-parsley-type="digits" data-parsley-length ="[2, 3]" data-parsley-minlength="1" data-parsley-maxlength="3" maxlength="3" data-parsley-max="100">
										</li> -->
										<li class="margin-bottom-10">
										Class 12th Percentage
											@if( $getStudent12thmarksObj )
					                            @foreach(  $getStudent12thmarksObj as $student12thMarksData )
					                                @if( $student12thMarksData->marksName == '12th' )
					                                	@if(empty($student12thMarksData->percentage))
							                                <select class="form-control" name="twelveMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 12th percentage" required="">
							                                    <option value="" disabled="" selected="">Please Select 12 Percentage</option>
							                                    {{--*/ $Percent12 = '1' /*--}}
							                                    @for( $Percent12 = '1'; $Percent12 < '101'; $Percent12++ )
							                                        @if( $student12thMarksData->percentage == $Percent12 )
							                                            <option value="{{ $Percent12 }}" selected="">{{ $Percent12 }}%</option>
							                                        @else
							                                            <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
							                                        @endif
							                                    @endfor
							                                </select>
							                            @else
					                                		<input type="text" class="form-control" name="twelveMarksPercentage" value="{{ $student12thMarksData->percentage }}"  placeholder="Enter Class 12th Percentage here" readonly="">
					                                	@endif
					                                @endif
					                            @endforeach
					                        @else
					                            <select class="form-control" name="twelveMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 12th percentage" required="">
					                                <option value="" disabled="" selected="">Please Select 12 Percentage</option>
					                                {{--*/ $Percent12 = '1' /*--}}
					                                @for( $Percent12 = '1'; $Percent12 < '101'; $Percent12++ )
					                                    <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
					                                @endfor
					                            </select>
					                        @endif
				                        </li>

										<li class="margin-bottom-10">Class 12th Mark sheet
											<a href="javascript:void(0);" class="removeTabAction hide" id="remove3"><i class="fa fa-remove"></i></a>
											<input type="file" class="form-control" name="tweleveMarksheet">
											<p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
										</li>

										<li class="margin-bottom-10">
                                        Graduation Percentage
                                            @if( $getStudentGraduationMarksObj )
                                                @foreach(  $getStudentGraduationMarksObj as $graduationMarks )
                                                    @if( $graduationMarks->marksName == 'Graduation' )
                                                        @if(empty($graduationMarks->percentage))
                                                            <select class="form-control" name="twelveMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid Graduation percentage" required="">
                                                                <option value="" disabled="" selected="">Please Select Graduation Percentage</option>
                                                                {{--*/ $Percent12 = '1' /*--}}
                                                                @for( $Percent12 = '1'; $Percent12 < '101'; $Percent12++ )
                                                                    @if( $graduationMarks->percentage == $Percent12 )
                                                                        <option value="{{ $Percent12 }}" selected="">{{ $Percent12 }}%</option>
                                                                    @else
                                                                        <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        @else
                                                            <input type="text" class="form-control" name="twelveMarksPercentage" value="{{ $graduationMarks->percentage }}"  placeholder="Enter percentage here" readonly="">
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                <select class="form-control" name="twelveMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid Graduation percentage">
                                                    <option value="" disabled="" selected="">Please Select Graduation Percentage</option>
                                                    {{--*/ $Percent12 = '1' /*--}}
                                                    @for( $Percent12 = '1'; $Percent12 < '101'; $Percent12++ )
                                                        <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
                                                    @endfor
                                                </select>
                                            @endif
                                        </li>

                                        <li class="margin-bottom-10">Graduation Mark sheet
                                            <a href="javascript:void(0);" class="removeTabAction hide" id="remove5"><i class="fa fa-remove"></i></a>
                                            <input type="file" class="form-control" name="graduationMarksheet">
                                            <p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
                                        </li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					{{--*/ $hobbies = ''; /*--}}
					{{--*/ $interests = ''; /*--}}
					{{--*/ $achievementsawards = ''; /*--}}
					{{--*/ $projects = ''; /*--}}
					{{--*/ $studentName = ''; /*--}}
					{{--*/ $parentsname = ''; /*--}}
					{{--*/ $parentsnumber = ''; /*--}}
					@if( $studentApplyCourseDataObj )
						@foreach( $studentApplyCourseDataObj as $item )
							{{--*/ $hobbies = $item->hobbies; /*--}}
							{{--*/ $interests = $item->interests; /*--}}
							{{--*/ $achievementsawards = $item->achievementsawards; /*--}}
							{{--*/ $projects = $item->projects; /*--}}
							{{--*/ $studentName = $item->firstName.' '.$item->lastName; /*--}}
							{{--*/ $parentsname = $item->parentsname; /*--}}
							{{--*/ $parentsnumber = $item->parentsnumber; /*--}}
						@endforeach
					@endif

					<div class="row guradianBlock hide">
						<hr>
						<div class="col-sm-12 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left"><i class="fa fa-user"></i> Guardian Information <span class="text-info">(If you are below 18 year of your age)</span></h2>
								</div>

								<div class="panel-body">
									<div class="row">
										<div class="col-md-4">
											<ul class="list-unstyled social-contacts-v2">
												<li>
													Parent / Guardian Name
													<input type="text" name="parentsname" class="form-control" placeholder="Enter parent / guardian name" value="{{ $parentsname }}"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid parent/guardian name" data-parsley-pattern="^[a-zA-Z\s .]*$">
												</li>
											</ul>
										</div>
										<div class="col-md-4">
											<ul class="list-unstyled social-contacts-v2">
												<li>
													Parent / Guardian Number
													<input type="text" name="parentsnumber" class="form-control" placeholder="Enter parent / guardian number" value="{{ $parentsnumber }}" data-parsley-type="digits" data-parsley-trigger="change"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid mobile number" >
													<!-- data-parsley-pattern="^[7-9][0-9]{9}$" maxlength="10"  data-parsley-length="[10, 10]"-->
												</li>
											</ul>
										</div>
										<div class="col-md-4">
											<ul class="list-unstyled social-contacts-v2">
												<li>
													Parent / Guardian Id Proof
													<input type="file" name="parentImage" class="form-control">
												</li>
											</ul>
										</div>
									</div>

									<div class="row margin-top20">
										<div class="col-md-12 text-center">
											<label class="text-black-color">
												<input id="checkboxActive" type="checkbox" name="studentVerifyAge"> I "{{ $studentName }}" agree that i have the consent of @if( $parentsname )"<span id="parentNameChange">{{ $parentsname }}</span>'s" @else <span id="parentNameChange">guardian</span>'s @endif to pay the booking amount on AdmissionX portal to reverse my seat for this college.
			                                </label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>					

					<div class="row">
						<div class="col-sm-12 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left"><i class="fa fa-tag"></i> Interest Information</h2>
								</div>

								<div class="panel-body">
									<div class="row">
										<div class="col-md-6">
											Hobbies <textarea class="form-control" name="hobbies" rows="2" placeholder="Enter hobbies here" data-parsley-error-message = "Please enter your hobbies" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s &().,-]*$">{{ $hobbies }}</textarea>
										</div>
										<div class="col-md-6">
											Interest <textarea class="form-control" name="interests" rows="2" placeholder="Enter interests here" data-parsley-error-message = "Please enter your interests" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s &().,-]*$">{{ $interests }}</textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											Achievement &amp; Awards <textarea class="form-control" name="achievementsawards" rows="2" placeholder="Enter achievement &amp; awards here" data-parsley-error-message = "Please enter your achievement &amp; awards" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s &().,-]*$">{{ $achievementsawards }}</textarea>
										</div>
										<div class="col-md-6">
											Projects <textarea class="form-control" name="projects" rows="2" placeholder="Enter projects here" data-parsley-error-message = "Please enter your projects" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s &().,-]*$">{{ $projects }}</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left"><i class="fa fa-check"></i> I Agree</h2>
								</div>
								<div class="panel-body text-center">
									<label class="text-black-color">
										<input id="checkboxActive" type="checkbox" name="studentVerifyDetails" required=""> I {{ $studentName }} agree that all of the above details are correct.
	                                </label>
	                                <button class="btn-u margin-top20" type="submit">Proceed To Pay</button>
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')

{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}


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


		$('.parentsDocument').on('change',function(){
	        $('#refresh3').removeClass('hide');
	    });
	    $('#refresh3').on('click',function(e){
	        $('.parentsDocument').val('').trigger('chosen:updated');
	        $('#refresh3').addClass('hide');
	    });

	    $('.tenthDocument').on('change',function(){
	        $('#refresh2').removeClass('hide');
	    });
	    $('#refresh2').on('click',function(e){
	        $('.tenthDocument').val('').trigger('chosen:updated');
	        $('#refresh2').addClass('hide');
	    });

	    $('.twelveDocument').on('change',function(){
	        $('#refresh4').removeClass('hide');
	    });
	    $('#refresh4').on('click',function(e){
	        $('.twelveDocument').val('').trigger('chosen:updated');
	        $('#refresh4').addClass('hide');
	    });

	     $('.eleventhDocument').on('change',function(){
	        $('#refresh5').removeClass('hide');
	    });
	    $('#refresh5').on('click',function(e){
	        $('.eleventhDocument').val('').trigger('chosen:updated');
	        $('#refresh5').addClass('hide');
	    });

	    

	    $('input[name=parentsDocument]').change(function (e)
		{  
			var ext = $('input[name=parentsDocument]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				$('#parentDoc').addClass('hide');
			}else{
				$('input[name=parentsDocument]').val('');
				$('#parentDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});

		$('input[name=tenthDocument]').change(function (e)
		{  
			var ext = $('input[name=tenthDocument]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				$('#10thDoc').addClass('hide');
			}else{
				$('input[name=tenthDocument]').val('');
				$('#10thDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});

		$('input[name=twelveDocument]').change(function (e)
		{  
			var ext = $('input[name=twelveDocument]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				$('#12thDoc').addClass('hide');
			}else{
				$('input[name=twelveDocument]').val('');
				$('#12thDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});

		$('input[name=eleventhDocument]').change(function (e)
		{  
			var ext = $('input[name=eleventhDocument]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				$('#11thDoc').addClass('hide');
			}else{
				$('input[name=eleventhDocument]').val('');
				$('#11thDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});


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
		var dateofbirth = $('#dateChange').val();
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
	            url: "{{ URL::to('/getCurrentDOBCalculateApply') }}",
	            success: function(data) {
            		if( data.code == '200' ){
            			$('.calculatedDateFromNow').text(data.calculateDate);	
            			year = data.year;
           	 			if( year < 18 ){
           	 				
           	 				$('input[name=parentsDocument]').val('');
           	 				$('.guradianBlock').removeClass('hide');
           	 				$('input[name=studentVerifyAge]').attr('required', 'required');
           	 				$('input[name=parentsname]').attr('required', 'required');
           	 				$('input[name=parentsnumber]').attr('required', 'required');
           	 				$('input[name=parentImage]').attr('required', 'required');
            			}else{
            				
           	 				$('input[name=parentsDocument]').val('');
            				$('.guradianBlock').addClass('hide');
            				$('input[name=studentVerifyAge]').removeAttr('required', '');
            				$('input[name=parentsname]').removeAttr('required', '');
           	 				$('input[name=parentsnumber]').removeAttr('required', '');
           	 				$('input[name=parentImage]').removeAttr('required', '');
            			}
            		}else{

            		}
	        		
	        		
	            }
	        });

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
	            url: "{{ URL::to('/getCurrentDOBCalculateApply') }}",
	            success: function(data) {
            		if( data.code == '200' ){
            			$('.calculatedDateFromNow').text(data.calculateDate);	
            			year = data.year;
           	 			if( year < 18 ){
           	 				// $('input[name=parentsname]').val('');
           	 				// $('input[name=parentsnumber]').val('');
           	 				$('input[name=parentsDocument]').val('');
           	 				$('.guradianBlock').removeClass('hide');
           	 				$('input[name=studentVerifyAge]').attr('required', 'required');
           	 				$('input[name=parentsname]').attr('required', 'required');
           	 				$('input[name=parentsnumber]').attr('required', 'required');
           	 				$('input[name=parentImage]').attr('required', 'required');
            			}else{
            				// $('input[name=parentsname]').val('');
           	 				// $('input[name=parentsnumber]').val('');
           	 				$('input[name=parentsDocument]').val('');
            				$('.guradianBlock').addClass('hide');
            				$('input[name=studentVerifyAge]').removeAttr('required', '');
            				$('input[name=parentsname]').removeAttr('required', '');
           	 				$('input[name=parentsnumber]').removeAttr('required', '');
           	 				$('input[name=parentImage]').removeAttr('required', '');
            			}
            		}else{

            		}
	        		
	        		
	            }
	        });
		});

		$('input[name=parentsname]').on('change', function(){
			$('#parentNameChange').text('');
			$('#parentNameChange').text($('input[name=parentsname]').val());
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.courseName').on('click',function(){
			var courseName = "{!! $collegemasterId !!}";
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
	$(document).ready(function(){
		$('input[name=tenMarksheet]').on('change', function(){
			$('#remove1').removeClass('hide');

			var ext = $('input[name=tenMarksheet]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				
			}else{
				$('input[name=tenMarksheet]').val('');
				$('#remove1').addClass('hide');	
			}

		});

		$('#remove1').on('click', function(){
			$('input[name=tenMarksheet]').val('');
			$('#remove1').addClass('hide');
		});

		$('input[name=elevenMarksheet]').on('change', function(){
			$('#remove2').removeClass('hide');

			var ext = $('input[name=elevenMarksheet]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				
			}else{
				$('input[name=elevenMarksheet]').val('');
				$('#remove2').addClass('hide');	
			}

		});

		$('#remove2').on('click', function(){
			$('input[name=elevenMarksheet]').val('');
			$('#remove2').addClass('hide');
		});

		$('input[name=tweleveMarksheet]').on('change', function(){
			$('#remove3').removeClass('hide');

			var ext = $('input[name=tweleveMarksheet]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				
			}else{
				$('input[name=tweleveMarksheet]').val('');
				$('#remove3').addClass('hide');	
			}

		});

		$('#remove3').on('click', function(){
			$('input[name=tweleveMarksheet]').val('');
			$('#remove3').addClass('hide');
		});

		$('input[name=graduationMarksheet]').on('change', function(){
            $('#remove5').removeClass('hide');

            var ext = $('input[name=graduationMarksheet]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                
            }else{
                $('input[name=graduationMarksheet]').val('');
                $('#remove5').addClass('hide'); 
            }

        });

        $('#remove5').on('click', function(){
            $('input[name=graduationMarksheet]').val('');
            $('#remove5').addClass('hide');
        });
	});
</script>
@endsection





