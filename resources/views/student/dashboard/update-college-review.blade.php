@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Faculty
@endsection

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<style type="text/css">
		.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	</style>
	<style type="text/css">
	.rating_reviews_block{text-align: center;margin-top: 20px;margin-bottom: 20px;border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea;background: #fbfbfb;padding: 20px 0px;}
	.rating_reviews_block img{margin-bottom: 0px !important;}
	.rating_reviews_block h3{font-size: 25px;padding-top: 10px;margin: 0px;font-family: 'Open Sans';font-weight: 600;letter-spacing: 2px;}
	.rating_reviews_block h5{font-size: 15px;padding-top: 10px;margin: 0px;font-family: 'Open Sans', sans-serif;font-weight: 200;letter-spacing: 1px;}
	.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
	</style>
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('student/dashboard/edit', $slug) }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back in Dashboard</a> <a href="{{ URL::to('student/review-list', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
			<div class="profile-body">					
				<div class="profile-bio">
					<div class="row">
						<div class="col-md-12">
							<h2>{!! App\Models\StudentProfile::getStudentName($slug) !!}</h2>
							<span><strong>Reviews Details</strong></span>
						</div>				
						
					</div>
				</div>
				<hr class="hr-gap">
				<div class="bg-color-white padding20">
					@if(Session::has('flash_message'))
				        <div class="row">
				            <div class="col-md-6 col-md-offset-3">
				                <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
				                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                        <span aria-hidden="true">×</span>
				                    </button>
				                    <strong>{{ Session::get('flash_message') }}</strong>
				                </div>
				            </div>
				        </div>
				    @endif
					<form method="POST" action="{{ URL::to('student/review-forms/'.$slug.'/update') }}" data-parsley-validate="" enctype="multipart/form-data">
						<input type="hidden" name="id" value="{{ $getCollegeReviewObj->id }}">
						<div class="row">
							<div class="col-md-8">
								<label>Title</label>
								<input type="text" class="form-control" name="title" placeholder="Enter title" required="" data-parsley-error-message="Please enter title" value="{{ $getCollegeReviewObj->title }}">
							</div>
							<div class="col-md-4">
								<label>Like & Dislike </label><br>
			                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
			                      <label class="btn btn-success @if($getCollegeReviewObj->votes == 1) active @endif">
			                        <input type="radio" name="votes" value="1" id="option1" autocomplete="off" @if($getCollegeReviewObj->votes == 1) checked="" @elseif($getCollegeReviewObj->votes == '2')  @else checked="" @endif><i class="fa fa-thumbs-up"></i> Like
			                      </label>
			                      <label class="btn btn-danger @if($getCollegeReviewObj->votes == 2) active @endif">
			                        <input type="radio" name="votes" value="2" id="option2" autocomplete="off" @if($getCollegeReviewObj->votes == 2) checked @endif><i class="fa fa-thumbs-down"></i> Dislike
			                      </label>
			                    </div>
			                </div>
						</div>	
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-2">
								<label>Academic</label>
								<input type="text" class="form-control" name="academic" placeholder="Enter academic val" required="" data-parsley-error-message="Please enter academic value between 1 to 5 also float value accepted" value="{{ $getCollegeReviewObj->academic }}" min="1" max="5" step="0.1">
							</div>
							<div class="col-md-2">
								<label>Accommodation</label>
								<input type="text" class="form-control" name="accommodation" placeholder="Enter accommodation val" required="" data-parsley-error-message="Please enter accommodation value between 1 to 5 also float value accepted" value="{{ $getCollegeReviewObj->accommodation }}" min="1" max="5" step="0.1">
							</div>
							<div class="col-md-2">
								<label>Faculty</label>
								<input type="text" class="form-control" name="faculty" placeholder="Enter faculty val" required="" data-parsley-error-message="Please enter faculty value between 1 to 5 also float value accepted" value="{{ $getCollegeReviewObj->faculty }}" min="1" max="5" step="0.1">
							</div>
							<div class="col-md-2">
								<label>Infrastructure</label>
								<input type="text" class="form-control" name="infrastructure" placeholder="Enter infrastructure val" required="" data-parsley-error-message="Please enter infrastructure value between 1 to 5 also float value accepted" value="{{ $getCollegeReviewObj->infrastructure }}" min="1" max="5" step="0.1">
							</div>
							<div class="col-md-2">
								<label>Placement</label>
								<input type="text" class="form-control" name="placement" placeholder="Enter placement val" required="" data-parsley-error-message="Please enter placement value between 1 to 5 also float value accepted" value="{{ $getCollegeReviewObj->placement }}" min="1" max="5" step="0.1">
							</div>
							<div class="col-md-2">
								<label>Social</label>
								<input type="text" class="form-control" name="social" placeholder="Enter social val" required="" data-parsley-error-message="Please enter social value between 1 to 5 also float value accepted" value="{{ $getCollegeReviewObj->social }}" min="1" max="5" step="0.1">
							</div>
						</div>	
						<hr class="hr-gap">	
						<div class="row">
							<div class="col-md-12">
								<label>Description</label>
								<textarea class="form-control summernote" rows="4" placeholder="Enter the about faculty" name="description" required="" data-parsley-error-message="Please enter review">{{ $getCollegeReviewObj->description }}</textarea>
							</div>
						</div>
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-2 col-md-offset-5 text-center">
								<button type="submit" class="btn btn-u">Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@endsection