@extends('website/new-design-layouts.master')

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('student/dashboard/edit', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-9">
								<h2>{!! App\Models\StudentProfile::getStudentName($slug) !!}</h2>
								<span><strong>Counselling Form Lists</strong></span>
							</div>				
						</div>
					</div>
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-12">
								<div class="table-search-v1 margin-bottom-20">
									@if(sizeof($listOfCounsellingForm) > 0)
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped">
											<thead>
												<tr>
													<th>Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>City</th>
													<th>Course</th>
													<th>Examinarion Name</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>
											@foreach($listOfCounsellingForm as $item)
											<tr>
												<td>{{ $item->name }}</td>
												<td>{{ $item->email }}</td>
												<td>{{ $item->phone }}</td>
												<td>{{ $item->cityName }}</td>
												<td>{{ $item->courseName }}</td>
												<td><a href="{{ URL::to('/examination-details/'.$item->examSlug.'/'.$item->type_of_examinationsSlug) }}">{{$item->sortname }} - {{ $item->examinationName }}</a></td>
												<td>{{ date('d F Y h:i a', strtotime($item->created_at)) }}</td>
											</tr>
											@endforeach
											</tbody>
										</table>
									</div>
									<div class="row indexPagination">
	                    				<div class="col-md-12 text-center">
		                                <div class="custom-pagination">{!! $listOfCounsellingForm->render() !!}</div>
			                            </div>
			                        </div>
			                        @else
			                        <div class="profile-bio">
										<div class="row">
											<div class="col-md-12">
												<div class="headline text-center">
													<h2 class="">No Counselling Form Submitted...</h2>
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