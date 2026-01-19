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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/dashboard/edit', $slug) }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back in Dashboard</a> <a href="{{ URL::to('college/faculty', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
			<div class="profile-body">					
				<div class="profile-bio">
					<div class="row">
						<div class="col-md-12">
							<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
							<span><strong>Faculty Details</strong></span>
						</div>				
						
					</div>
				</div>
				<hr class="hr-gap">
				<div class="bg-color-white padding20">
					<form method="POST" action="{{ URL::to('college/faculty/'.$slug.'/update') }}" data-parsley-validate="" enctype="multipart/form-data">
						<input type="hidden" name="id" value="{{ $getFacultyObj->id }}">
						@include('college/college-faculty.form_fields')
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
	@include('college/college-faculty.search_country_state_city')
@endsection