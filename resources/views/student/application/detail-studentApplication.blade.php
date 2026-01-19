@extends('website/new-design-layouts.master')

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('student/check-applications', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-12">
								@if( $getApplicationsDataObj )
									@foreach( $getApplicationsDataObj as $item )
										<h2>{{ $item->collegeUserFirstName }}</h2>		
									@endforeach
								@endif								
							</div>
						</div>
						<div class="row margin-top10">
							<div class="col-md-6">
								@if( $getApplicationsDataObj )
									@foreach( $getApplicationsDataObj as $item )
									<p class="text-info"><i aria-hidden="true" class="fa fa-calendar"></i> Applied Date : {{ date('M d, Y ', strtotime($item->created_at)) }}</p>
									<span><strong>Annual Course Fee (per year):</strong> Rs. {{ $item->totalfees }}/-</span>
									<span><strong>Rest Fees Payable at College:</strong> Rs. {{ $item->restfees }}/-</span>
									<span><strong>Fees paid to Admission X:</strong> Rs. {{ $item->byafees }}/-</span>
									@endforeach
								@endif
							</div>
							<div class="col-md-6">
								@if( $getApplicationsDataObj )
									@foreach( $getApplicationsDataObj as $item )
										@if( $item->iagreeparents == '1' )
											<span><strong><i class="text-success fa fa-check"></i> After parent's confirmation I filled the application</strong></span>
										@endif
										@if( $item->iagreeform == '1' )
											<span><strong><i class="text-success fa fa-check"></i> I Agree to Terms &amp; Conditions</strong></span>
										@endif
									@endforeach
								@endif
							</div>
						</div>
					</div>
					<hr class="hr-gap">
					<span class="text-highlights text-highlights-red rounded-2x">Once you update the allpication status you won't be able to change it. For any queries please <a href="{{ URL::to('contact-us') }}" class="" style="color: #000;" target="_blank">Contact us</a></span>
					<hr>
					<div class="row">
						<div class="col-sm-6 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left">
										<i class="fa fa-info"></i> Basic Information
									</h2>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled social-contacts-v2">
										@if( $getApplicationsDataObj )
											@foreach( $getApplicationsDataObj as $item )
												{{--*/ $applicationstatusIdCurrent = $item->applicationstatusId; /*--}}
												<li>Application Status : 
													@if( $item->applicationstatusId =='1' )
														@if( $item->paymentstatusID =='1' )
															<button class="btn-u btn-u-green btn-u-xs">{{ $item->applicationstatusName }}</button>
														@else
															<a  href="{{ URL::to('student-course-re-apply', [$item->collegeSlug, $item->encryptApplicationId]) }}" title="Re-Apply Now"><button class="btn-u btn-u-yellow btn-u-xs">Pending</button></a>
														@endif
													@elseif( $item->applicationstatusId =='2' )
														<button class="btn-u  btn-u-yellow btn-u-xs" data-toggle="modal" data-target=".bs-example-modal-md">{{ $item->applicationstatusName }}</button>
													@elseif( $item->applicationstatusId =='3' )
														<button class="btn-u  btn-u-aqua btn-u-xs">{{ $item->applicationstatusName }}</button>
													@else
														<button class="btn-u btn-u-red  btn-u-xs">{{ $item->applicationstatusName }}</button>
													@endif
													@if( $item->applicationstatusId == '2' )
													&nbsp;|&nbsp;
													<a href="" data-toggle="modal" data-target=".bs-example-modal-md">Click to update</a>
													@endif
												</li>
												@if( $item->paymentstatusID != '')
												<li>Payment Status :
														@if( $item->paymentstatusID =='1' )
															<button class="btn-u  btn-u-green btn-u-xs">{{ $item->paymentstatusName }}</button>
														@elseif( $item->paymentstatusID =='2' )
															<button class="btn-u btn-u-red btn-u-xs">{{ $item->paymentstatusName }}</button>
														@elseif( $item->paymentstatusID =='7' )
														<a  href="{{ URL::to('student-course-re-apply', [$item->collegeSlug, $item->encryptApplicationId]) }}" title="Re-Apply Now"><button class="btn-u btn-u-aqua btn-u-xs">Re-Apply Now</button></a>
														@else
															<button class="btn-u btn-u-yellow btn-u-xs">{{ $item->paymentstatusName }}</button>
														@endif
													<!-- @if( $item->paymentstatusID == '7')
													&nbsp;|&nbsp;
													<a href="" data-toggle="modal" data-target=".bs-example-modal-md">Click to update</a>
													@endif -->
												</li>
												@endif
												<li>Student Name : <strong> {{ $item->studentUserFirstName }} {{ $item->studentUserMiddleName }} {{ $item->studentUserLastName }}</strong>
												</li>
												<li>Gender : <strong>{{ $item->gender }}</strong></li>
												<li>Date of Birth : <strong>{{ date('M d, Y', strtotime($item->dob)) }}</strong></li>
												<li>Email Address : <strong>{{ $item->studentEmail }}</strong></li>
												<li>Phone Number: <strong>{{ $item->studentPhone }}</strong></li>
												@if($item->parentname)
												<li>Parent Name : <strong>{{ $item->parentname }}</strong></li>
												@endif
												@if($item->parentnumber)
												<li>Parent Phone Number : <strong>{{ $item->parentnumber }}</strong></li>
												@endif
											@endforeach
										@endif
									</ul>
								</div>
							</div>
							<hr>
							<!-- STREAM SECTION -->
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left">
										<i class="fa fa-book"></i> Course Information
									</h2>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled social-contacts-v2">
										@if( $getApplicationsDataObj )
											@foreach( $getApplicationsDataObj as $item )
												{{--*/ $applicationstatusIdCurrent = $item->applicationstatusId; /*--}}
												<li>Stream : <strong>{{ $item->functionalareaName }}</strong></li>
												<li>Degree Level : <strong>{{ $item->educationlevelName }}</strong></li>
												<li>Degree : <strong>{{ $item->degreeName }}</strong></li>
												<li>Course : <strong>{{ $item->courseName }}</strong></li>
												<li>Course Type : <strong>{{ $item->coursetypeName }}</strong></li>
											@endforeach
										@endif
									</ul>
								</div>
							</div>
							<!-- END -->
						</div>
						
						<div class="col-sm-6 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left">
										<i class="fa fa-info"></i> Academic Records
									</h2>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled social-contacts-v2">
										@if( $getApplicationsDataObj )
											{{--*/ $percent10 = '--'; /*--}}
											{{--*/ $percent11 = '--'; /*--}}
											{{--*/ $percent12 = '--'; /*--}}
											{{--*/ $hobbies = '--'; /*--}}
											{{--*/ $interest = '--'; /*--}}
											{{--*/ $awards = '--'; /*--}}
											{{--*/ $projects = '--'; /*--}}
											{{--*/ $marksheet10 = '--'; /*--}}
											{{--*/ $marksheet11 = '--'; /*--}}
											{{--*/ $marksheet12 = '--'; /*--}}
											{{--*/ $graduationPercent = '--'; /*--}}
											{{--*/ $graduationMarksheet = '--'; /*--}}

											@foreach( $getApplicationsDataObj as $item )
												@if( $item->percent10 )
													{{--*/ $percent10 = $item->percent10.' %';  /*--}}
												@endif
												@if( !empty($item->marksheet10) )
													{{--*/ $marksheet10 = $item->marksheet10;  /*--}}
													{{--*/ 
														$explodeFolderName = explode('-', $marksheet10);
													/*--}}
													{{--*/ $URLFormation = $explodeFolderName[0].'-'.$explodeFolderName[1]; /*--}}
												@endif
												
												@if( $item->percent11 )
													{{--*/ $percent11 = $item->percent11.' %';  /*--}}
												@endif
												@if( $item->marksheet11 )
													{{--*/ $marksheet11 = $item->marksheet11;  /*--}}
												@endif
												@if( $item->percent12 )
													{{--*/ $percent12 = $item->percent12.' %';  /*--}}
												@endif
												@if( $item->marksheet12 )
													{{--*/ $marksheet12 = $item->marksheet12;  /*--}}
												@endif
												@if( $item->hobbies )
													{{--*/ $hobbies = $item->hobbies;  /*--}}
												@endif
												@if( $item->interest )
													{{--*/ $interest = $item->interest;  /*--}}
												@endif
												@if( $item->awards )
													{{--*/ $awards = $item->awards;  /*--}}
												@endif
												@if( $item->projects )
													{{--*/ $projects = $item->projects;  /*--}}
												@endif
												@if( $item->graduationPercent )
													{{--*/ $graduationPercent = $item->graduationPercent.' %';  /*--}}
												@endif
												@if( $item->graduationMarksheet )
													{{--*/ $graduationMarksheet = $item->graduationMarksheet;  /*--}}
												@endif
												
												<li>10th Class Percentage : <strong>{{ $percent10 }}</strong></li>
												<li>10th Class Marksheet :
													@if($item->marksheet10 != '') 
														<a href="/application/{{$URLFormation}}/{{ $marksheet10 }}" title="Click to view" target="_blank">Click to view</a>
													@endif
												</li>
												<li>11th Class Percentage : <strong>{{ $percent11 }}</strong></li>
												<li>11th Class Marksheet : 
													@if($item->marksheet11 != '')
														<a href="/application/{{$URLFormation}}/{{ $marksheet11 }}" title="Click to view" target="_blank">Click to view</a>
													@endif
												</li>
												<li>12th Class Percentage : <strong>{{ $percent12 }}</strong></li>
												<li>12th Class Marksheet : 
													@if($item->marksheet11 != '')
														<a href="/application/{{$URLFormation}}/{{ $marksheet12 }}" title="Click to view" target="_blank">Click to view</a>
													@endif
												</li>
												<li>Graduation Percentage : <strong>{{ $graduationPercent }}</strong></li>
												<li>Graduation Marksheet : 
													@if($item->marksheet11 != '')
														<a href="/application/{{$URLFormation}}/{{ $graduationMarksheet }}" title="Click to view" target="_blank">Click to view</a>
													@endif
												</li>
												<li>Hobbies : <strong>{{ $hobbies }}</strong></li>
												<li>Interests : <strong>{{ $interest }}</strong></li>
												<li>Awards : <strong>{{ $awards }}</strong></li>
												<li>Projects : <strong>{{ $projects }}</strong></li>
											@endforeach
										@endif
									</ul>
								</div>
							</div>
						</div>
					</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
<!-- Modal Screen -->
<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="gridSystemModalLabel">Update Application Status</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="/student/update-application-status" data-parsley-validate = '',enctype = "multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							You are about to cancel your admission for the selected course.
							<input type="hidden" name="applicationId" value="{{ $applicationId }}">
							<select class="form-control" required="" data-parsley-trigger="change" data-parsley-error-message="Please select status type" name="applicationStaus">
								<option disabled="" selected="">Select status type</option>
								@foreach( $getApplicationStatusObj as $item )
									@if( $applicationstatusIdCurrent == $item->id )
										<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
									@else
										<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endif
								@endforeach
							</select>
						</div>

	                    <div class="col-md-12">
	                        <label>Reason for cancelation</label>
	                        <textarea class="form-control" rows="4" placeholder="Enter the message" name="message" required="" data-parsley-trigger="change" data-parsley-error-message="Please enter cancel reason"></textarea>
	                    </div>
					</div>
					<div class="row margin-top20">
						<div class="col-md-4 col-md-offset-8">
							<button class="btn-u btn-block">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End -->

@endsection


