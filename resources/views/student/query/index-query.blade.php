@extends('website/new-design-layouts.master')

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right">
				@if( $getStudentNameDetailObj )
					@foreach( $getStudentNameDetailObj as $item )
						<a href="{{ URL::to('student/dashboard/edit', $item->slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
					@endforeach
				@endif
			</div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-12">
								@if( $getStudentNameDetailObj )
									@foreach( $getStudentNameDetailObj as $item )
										<h2>{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</h2>		
									@endforeach
								@endif
								<span><strong>Chat Details</strong></span>								
							</div>							
						</div>
					</div>
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-12">
								<!--Table Search v1-->
								@if( $getQueriesDataObj )
								<div class="table-search-v1 margin-bottom-20">
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped">
											<thead>
												<tr>
													<th>SR No.</th>
													<th>College Name</th>
													<th>Status</th>
													<th>Subject</th>
													<th>Message</th>
													<th>Created Date</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												@foreach( $getQueriesDataObj as $key => $item )
												<tr>
													<td>
														<a  class="text-lightblue" href="{{ URL::to('student/query-detail', [$option, $item->id]) }}" title="View">{{ ++$key }}</a>
													</td>
													<td>
														@if( $item->collegeName )
															{{ $item->collegeName }}
														@else
															--
														@endif
													</td>
													<td>
														@if( $item->querytypeinfo == 'replied')
															<button class="btn-u btn-block btn-u-green btn-u-xs">Replied </button>
														@elseif($item->querytypeinfo == 'pending')
															<button class="btn-u btn-block btn-u-yellow btn-u-xs">Pending </button>
														@else
															--
														@endif
													</td>
													<td>
														@if( $item->subject )
															<a  class="text-lightblue" href="{{ URL::to('student/query-detail', [$option, $item->id]) }}" title="View">{{ str_limit($item->subject, 50) }}</a>
														@else
															--
														@endif
													</td>
													<td>
														@if( $item->message )
															{{ str_limit($item->message, 150) }}
														@else
															--
														@endif
													</td>
													
													<td>{{ date('M d, Y', strtotime($item->created_at)) }}</td>
													<td width="20%">
														<a class="btn btn-xs btn-info text-white" href="{{ URL::to('student/query-detail', [$option, $item->id]) }}" title="View"><i class="fa fa-eye"></i> View Details</a>
														<a  class="btn btn-xs btn-warning text-white" href="{{ URL::to('student/query-detail', [$option, $item->id]) }}" title="View"><i class="fa fa-reply"></i> Reply</a>
													</td>
												</tr>
												@endforeach												
											</tbody>
										</table>										
									</div>
								</div>
								<div class="row indexPagination">
                    				<div class="col-md-12 text-center">
	                                	<div class="custom-pagination">{!! $getQueriesDataObj->render() !!}</div>
		                            </div>
		                        </div>
		                        @else
		                        	<div class="profile-bio">
										<div class="row">
											<div class="col-md-12">
												<h2>There are no new messages!</h2>
											</div>							
										</div>
									</div>
		                        @endif
							<!--End Table Search v1-->
							</div>
						</div>
						<hr class="hr-gap">
						<div class="row">	
							<div class="col-md-12">
								<span><strong>Student To Admission X Chat Details</strong></span>
								<!--Table Search v1-->
								@if( $getQueriesAdminDataObj )
								<div class="table-search-v1 margin-bottom-20">
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped">
											<thead>
												<tr>
													<th>SR No.</th>
													<th>Admin Name</th>
													<th>Status</th>
													<th>Subject</th>
													<th>Message</th>
													
													<th>Created Date</th>
												</tr>
											</thead>
											
											<tbody>
												@foreach( $getQueriesAdminDataObj as $key => $item )
												<tr>
													<td>
														<a  class="text-lightblue" href="{{ URL::to('student/query-detail-bya-admin', [$option, $item->id]) }}" title="View">{{ ++$key }}</a>
													</td>
													<td>
														@if( $item->firstname )
															{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}
														@else
															--
														@endif
													</td>
													<td>
														@if( $item->querytypeinfo == 'replied')
															<button class="btn-u btn-block btn-u-green btn-u-xs">Replied </button>
														@elseif($item->querytypeinfo == 'pending')
															<button class="btn-u btn-block btn-u-yellow btn-u-xs">Pending </button>
														@else
															--
														@endif
													</td>
													<td>
														@if( $item->subject )
															<a  class="text-lightblue" href="{{ URL::to('student/query-detail-bya-admin', [$option, $item->id]) }}" title="View">{{ str_limit($item->subject, 50) }}</a>
														@else
															--
														@endif
													</td>
													
													<td>
														@if( $item->message )
															{{ str_limit($item->message, 150) }}
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
	                                	<div class="custom-pagination">{!! $getQueriesAdminDataObj->render() !!}</div>
		                            </div>
		                        </div>
		                        @else
		                        	<div class="profile-bio">
										<div class="row">
											<div class="col-md-12">
												<h2>There are no new messages!</h2>
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