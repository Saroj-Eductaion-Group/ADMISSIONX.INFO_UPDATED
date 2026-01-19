@extends('website/new-design-layouts.master')

@section('page-title-name')
Lists of Reviews has been submitted on your behalf
@endsection

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
	<style type="text/css">
	.rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
	.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	</style>
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to($userroleslug.'/dashboard/edit/'.$slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-9">
								@if($userroleslug == 'college')
								<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
								@elseif($userroleslug == 'student')
								<h2>{!! App\Models\StudentProfile::getStudentName($slug) !!}</h2>
								@endif
								<span><strong>List of Reviews</strong></span>
							</div>				
						</div>
					</div>
					<hr class="hr-gap">
					<div class="detail-page-signup margin-bottom40 table-responsive">
						<!-- Updated Course List -->
						@if( sizeof($listOfSubmitReviews) > 0 )
							@if($userroleslug == 'college')
								@include('common-partials.college-review-list-partial')
							@elseif($userroleslug == 'student')
								<div class="headline"><h2>Here is the list of reviews</h2></div>
								@include('common-partials.student-review-list-partial')
							@endif
						@else
							<h5>No Reviews listed.</h5>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection