@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Faculty
@endsection
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
							<div class="col-md-9">
								<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
								<span><strong>Faaculty Lists</strong></span>
							</div>				
							<div class="col-md-3">
								<h2 class="text-right"><a class="btn btn-u" href="{{ URL::to('college/faculty/'.$slug.'/create') }}" style="left: unset;bottom: unset;margin-left: unset;text-align: unset;position: unset;"><i class="fa fa-plus"></i> Create</a></h2>
							</div>
						</div>
					</div>
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-12">
								<div class="table-search-v1 margin-bottom-20">
									@if(sizeof($getFacultyObj) > 0)
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped">
											<thead>
												<tr>
													<th>Profile Picture</th>
													<th>Suffix</th>
													<th>Name</th>
													<th>Designation</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
											@foreach($getFacultyObj as $item)
											<tr>
												<td>
													@if(!empty($item->imagename))
														<img class="img-circle" src="{{ asset('gallery'.'/'.$slug.'/'.$item->imagename) }}" width="80" height="80">
													@else
														<p class="text-center">-Not Updated-</p>	
													@endif
												</td>
												<td>{{ $item->suffix }}</td>
												<td>{{ $item->name }}</td>
												<td>{{ $item->designation }}</td>
												<td>{{ $item->email }}</td>
												<td>{{ $item->phone }}</td>
												<td>
													<ul class="list-inline">
														<li>
															<a class="btn btn-warning text-white btn-xs border-radius15" href="{{ URL::to('college/faculty/'.$slug.'/edit/'.$item->id) }}"><i class="fa fa-pencil"></i> Edit</a>
														</li>
														<li> | </li>
														<li>
															<form method="POST" action="{{ URL::to('college/faculty/'.$slug.'/remove/'.$item->id) }}">
																<button type="submit" class="btn btn-danger text-white btn-xs border-radius15" onclick="return confirm('Are you sure to delete this faculty member?')"><i class="fa fa-trash"></i> Delete</button>
															</form>
														</li>
													</ul>
												</td>
											</tr>
											@endforeach
											</tbody>
										</table>
									</div>
									<div class="row indexPagination">
	                    				<div class="col-md-12 text-center">
		                                <div class="custom-pagination">{!! $getFacultyObj->render() !!}</div>
			                            </div>
			                        </div>
			                        @else
			                        <div class="profile-bio">
										<div class="row">
											<div class="col-md-12">
												<div class="headline text-center">
													<h2 class="">No Faculty Member Added...</h2>
												</div>
											</div>							
										</div>
									</div>
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
@endsection