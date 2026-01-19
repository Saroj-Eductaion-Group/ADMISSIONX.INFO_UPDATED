@extends('website/new-design-layouts.master')
@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right">
				@if( $getStudentProfileObj )
					@foreach( $getStudentProfileObj as $item )
						<a href="{{ URL::to('student/dashboard/edit', $item->slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
					@endforeach
				@endif
			</div>
			<div class="col-md-12">
				<div class="profile-body">
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-12">
								@if( $getStudentProfileObj )
									@foreach( $getStudentProfileObj as $item )
										<h2>{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</h2>		
									@endforeach
								@endif
								<span><strong>Application Details</strong></span>								
							</div>
						</div>
					</div>
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-12">
								<!--Table Search v1-->
								@if( $getStudentApplicationsDataObj )
								<div class="table-search-v1 margin-bottom-20">
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped">
											<thead>
												<tr>
													<th>Application Id</th>
													<th>College Name</th>
													<th>Course Name</th>
													<th>Total Fees</th>
													<th>10 Percentage</th>
													<th>11 Percentage</th>
													<th>12 Percentage</th>
													<th>Application Status</th>
													<th>Payment Status</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody>
												@foreach( $getStudentApplicationsDataObj as $key => $item )
												<tr><!-- {{ ++$key }} -->
													<td><a  class="text-lightblue" href="{{ URL::to('student/application-detail', [$item->collegeSlug, $item->encryptApplicationId]) }}" title="View"> {{ $item->applicationID }}</a></td>
													<td>
														{{ $item->collegeUserFirstName }}
													</td>
													<td><a  class="text-lightblue" href="{{ URL::to('student/application-detail', [$item->collegeSlug, $item->encryptApplicationId]) }}" title="View">{{ $item->functionalareaName }} / {{ $item->degreeName }} / {{ $item->courseName }}</a></td>
													<td>Rs. {{ $item->totalfees }}/-</td>
													<td>
														@if( $item->percent10 )
															{{ $item->percent10 }}
														@else
															--
														@endif
													</td>
													<td>
														@if( $item->percent11 )
															{{ $item->percent11 }}
														@else
															--
														@endif
													</td>
													<td>
														@if( $item->percent12 )
															{{ $item->percent12 }}
														@else
															--
														@endif
													</td>
													<td>
														<a  class="text-lightblue" href="{{ URL::to('student/application-detail', [$item->collegeSlug, $item->encryptApplicationId]) }}" title="View">
														@if( $item->applicationstatusId =='1' )
															@if( $item->paymentstatusID =='1' )
																<button class="btn-u btn-block btn-u-green btn-u-xs">{{ $item->applicationstatusName }}</button>
															@else
																<button class="btn-u btn-block btn-u-yellow btn-u-xs">{{ $item->applicationstatusName }}</button>
															@endif
														@elseif( $item->applicationstatusId =='2' )
															<button class="btn-u btn-block btn-u-yellow btn-u-xs">{{ $item->applicationstatusName }}</button>
														@elseif( $item->applicationstatusId =='3' )
															<button class="btn-u btn-block btn-u-aqua btn-u-xs">{{ $item->applicationstatusName }}</button>
														@else
															<button class="btn-u btn-u-red btn-block btn-u-xs">{{ $item->applicationstatusName }}</button>
														@endif
														</a>
													</td>
													<td>
														@if( $item->paymentstatusID != '')
															@if( $item->paymentstatusID =='1' )
																<a  class="text-lightblue" href="{{ URL::to('student/application-detail', [$item->collegeSlug, $item->encryptApplicationId]) }}" title="View"><button class="btn-u btn-block btn-u-green btn-u-xs">{{ $item->paymentstatusName }}</button></a>
															@elseif( $item->paymentstatusID =='2' )
																<button class="btn-u btn-u-red btn-block btn-u-xs">{{ $item->paymentstatusName }}</button>
															@elseif( $item->paymentstatusID =='7' )
																<p><span class="label label-danger padding-bottom5">You have pending payment </span></p>
																<a  href="{{ URL::to('student-course-re-apply', [$item->collegeSlug, $item->encryptApplicationId]) }}" title="Re-Apply Now"><button class="btn-u btn-block btn-u-aqua btn-u-xs"> Re-Apply Now</button></a>
															@else
																<button class="btn-u btn-block btn-u-yellow btn-u-xs">{{ $item->paymentstatusName }}</button>
															@endif
														@else
															--
														@endif
													</td>
													<td>{{ date('M d, Y', strtotime($item->created_at)) }}</td>
												</tr>
												@endforeach
												
											</tbody>
										</table>										
									</div>
								</div>
								<div class="row indexPagination">
                    				<div class="col-md-12 text-center">
	                                <div class="custom-pagination">{!! $getStudentApplicationsDataObj->render() !!}</div>
		                            </div>
		                        </div>
		                        @else
		                        <div class="profile-bio">
									<div class="row">
										<div class="col-md-12">
											<h2>No Application Filled Yet</h2>
										</div>							
									</div>
								</div>
		                        @endif
							<!--End Table Search v1-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection