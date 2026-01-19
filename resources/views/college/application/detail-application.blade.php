@extends('website/new-design-layouts.master')
@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/check-applications', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-6">
								@if( $getCollegeProfileObj )
									@foreach( $getCollegeProfileObj as $item )
										<h2>{{ $item->firstname }}</h2>		
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
					<div class="profile">
						<div class="row margin-top10">
							<div class="col-md-12">
								<h4 style="background: #fff; padding: 15px;">Once you update the allpication status you won't be able to change it. For any queries please <a href="{{ URL::to('contact-us') }}"  target="_blank">Contact us</a></h4>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left">
										<i class="fa fa-info"></i> Course Information
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
															<a  class="btn-u btn-u-yellow btn-u-xs text-light" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}">Pending</a>
														@endif
													@elseif( $item->applicationstatusId =='2' )
														<button class="btn-u  btn-u-yellow btn-u-xs" data-toggle="modal" data-target=".bs-example-modal-md">{{ $item->applicationstatusName }}</button>
													@elseif( $item->applicationstatusId =='3' )
														<button class="btn-u  btn-u-aqua btn-u-xs">{{ $item->applicationstatusName }}</button>
													@else
														<button class="btn-u btn-u-red  btn-u-xs">{{ $item->applicationstatusName }}</button>
													@endif
													@if( $item->applicationstatusId == '2')
													&nbsp;|&nbsp;
													<a href="" data-toggle="modal" data-target=".bs-example-modal-md">Click to update</a>
													@endif
												</li>
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
							<hr>
							@if( $item->applicationstatusId =='1' )
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
													@if( $item->applicationstatusId =='1' )
														<li>Student Name : <strong> {{ $item->userFirsrName }} {{ $item->userMiddleName }} {{ $item->userLastName }}</strong>
														</li>
														<li>Gender : <strong>{{ $item->gender }}</strong></li>
														<li>Date of Birth : <strong>{{ date('M d, Y', strtotime($item->dob)) }}</strong></li>
														<li>Email Address : <strong>{{ $item->email }}</strong></li>
														<li>Phone Number: <strong>{{ $item->phone }}</strong></li>
														@if($item->parentname)
															<li>Parent Name : <strong>{{ $item->parentname }}</strong></li>
														@endif
														@if($item->parentnumber)
															<li>Parent Phone Number : <strong>{{ $item->parentnumber }}</strong></li>
														@endif
													@endif
												@endforeach
											@endif
										</ul>
									</div>
								</div>
							@endif
						</div>
						
						<div class="col-sm-4 sm-margin-bottom-30">
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

											@foreach( $getApplicationsDataObj as $item )
												@if( $item->percent10 )
													{{--*/ $percent10 = $item->percent10.' %';  /*--}}
												@endif
												@if( $item->percent11 )
													{{--*/ $percent11 = $item->percent11.' %';  /*--}}
												@endif
												@if( $item->percent12 )
													{{--*/ $percent12 = $item->percent12.' %';  /*--}}
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
												
												<li>10th Class Percentage : <strong>{{ $percent10 }}</strong></li>
												<li>11th Class Percentage : <strong>{{ $percent11 }}</strong></li>
												<li>12th Class Percentage : <strong>{{ $percent12 }}</strong></li>
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
						<div class="col-sm-4 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									<h2 class="panel-title heading-sm pull-left">
										<i class="fa fa-info"></i> Fee Details
									</h2>
								</div>
								<div class="panel-body">
									@if( $getApplicationsDataObj )
									@foreach( $getApplicationsDataObj as $item )
									<p class="text-info"><i aria-hidden="true" class="fa fa-calendar"></i> Applied Date : {{ date('M d, Y ', strtotime($item->created_at)) }}</p>
									<span><strong>Annual Course Fee (per year):</strong> Rs. {{ $item->totalfees }}/-</span><br>
									<span><strong>Rest Fees Payable at College:</strong> Rs. {{ $item->restfees }}/-</span>
									@endforeach
								@endif
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
				<form method="POST" action="/college/update-application-status">
					<div class="row">
						<div class="col-md-12">
							Update Application Status
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
							<label>Remarks</label>
                			<textarea class="form-control" rows="4" placeholder="Enter the message" name="message" data-parsley-trigger="change" data-parsley-error-message="Please enter reject reason" required=""></textarea>
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


