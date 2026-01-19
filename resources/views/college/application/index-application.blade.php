@extends('website/new-design-layouts.master')

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/dashboard/edit', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-12">
								@if( $getCollegeProfileObj )
									@foreach( $getCollegeProfileObj as $item )
										<h2>{{ $item->firstname }}</h2>		
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
								@if( $getApplicationsDataObj )
								<div class="table-search-v1 margin-bottom-20">
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped">
											<thead>
												<tr>
													<th>SR No.</th>
													<th>Course Name</th>
													<th>Total Fees</th>
													<th>10 Percentage</th>
													<th>11 Percentage</th>
													<th>12 Percentage</th>
													<th>Status</th>
													<th>Student Name</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody>
												@foreach( $getApplicationsDataObj as $key => $item )
												@if( $item->paymentstatusID =='1' )
												<tr>
													<td>
														<a  class="text-lightblue" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}" title="View"><!-- {{ ++$key }} -->{{ $item->applicationID }}</a>
													</td>
													<td><a  class="text-lightblue" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}" title="View">{{ $item->functionalareaName }} / {{ $item->degreeName }} / {{ $item->courseName }}</a></td>
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
													@if( $item->applicationstatusId =='1' )
														@if( $item->paymentstatusID =='1' )
															<button class="btn-u btn-block btn-u-green btn-u-xs">{{ $item->applicationstatusName }}</button>
														@else
															<a  class="btn-u btn-block btn-u-yellow btn-u-xs text-light" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}">Pending</a>
														@endif
													@elseif( $item->applicationstatusId =='2' )
														<a  class="btn-u btn-block btn-u-yellow btn-u-xs text-light" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}">{{ $item->applicationstatusName }}</a>
													@elseif( $item->applicationstatusId =='3' )
														<button class="btn-u btn-block btn-u-aqua btn-u-xs">{{ $item->applicationstatusName }}</button>
													@else
														<button class="btn-u btn-u-red btn-block btn-u-xs">{{ $item->applicationstatusName }}</button>
													@endif
													</td>
													<td>
														@if( $item->applicationstatusId =='1' )
															<a  class="text-lightblue" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}" title="View">{{ $item->userFirsrName }} {{ $item->userMiddleName }} {{ $item->userLastName }}</a>
														@else
															--
														@endif
													</td>
													<td>{{ date('M d, Y', strtotime($item->created_at)) }}</td>
												</tr>
												@endif
												@endforeach												
											</tbody>
										</table>										
									</div>
								</div>
								<div class="row indexPagination">
                    				<div class="col-md-12 text-center">
	                                <div class="custom-pagination">{!! $getApplicationsDataObj->render() !!}</div>
		                            </div>
		                        </div>
		                        @else
		                        	<div class="profile-bio">
										<div class="row">
											<div class="col-md-12">
												<h2>No Application Needs To Be Reviewed</h2>
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