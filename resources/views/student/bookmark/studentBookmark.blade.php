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
								<span><strong class="text-uppercase">
									@if( $option == 'view' )
										{{ $option }} All Bookmark Details
									@else
										{{ $option }} Bookmark Details
									@endif
									</strong></span>								
							</div>
						</div>
					</div>
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-12">
								<!--Table Search v1-->
								@if( $getStudentBookmarkDataObj )
								<div class="table-search-v1 margin-bottom-20">
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped">
											<thead>
												<tr>
													@if( $option == 'view'  )
													<th>Type</th>
													@endif
													<th>Title</th>
													<!-- <th>Bookmark URL Links</th> -->
													<th>Created Date</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach( $getStudentBookmarkDataObj as $item )
												<tr>
													@if( $option == 'view'  )
													<td><a href="{{ $item->url }}" target="_blank" title="{{ $item->title }}">{{ $item->bookmarktypeinfoName }}</a></td>
													@endif
													<td><a href="{{ $item->url }}" target="_blank" title="{{ $item->title }}">{{ $item->title }}</a></td>
													<!-- <td>
														<a href="{{ $item->url }}" target="_blank" title="Click to view"><i class="fa fa-link"></i> Click to view</a>
													</td> -->
													<td>{{ date('M d, Y ', strtotime($item->created_at)) }}</td>
													<td>
														<a href="{{ url('student/delete-bookmark/') }}/{{ $item->id }}" class=" btn btn-md btn-googleplus"> <!-- text-white -->
														<span class="icon-trash" aria-hidden="true"></span> Delete</a>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>										
									</div>
								</div>
								<div class="row indexPagination">
                    				<div class="col-md-12 text-center">
	                                <div class="custom-pagination">{!! $getStudentBookmarkDataObj->render() !!}</div>
		                            </div>
		                        </div>
		                        @else
		                        <div class="profile-bio">
										<div class="row">
											<div class="col-md-12">
												<h2>No Bookmark</h2>
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