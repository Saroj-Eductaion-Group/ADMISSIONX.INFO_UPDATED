@extends('website/new-design-layouts.master')

@section('page-title-name')
Lists of Reviews has been submitted on your behalf
@endsection

@section('styles')
<script src='https://www.google.com/recaptcha/api.js'></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
	<style type="text/css">
	.rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
	.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	</style>
@endsection
@if($getCollegeDetailObj)
    {{--*/  
        $collegeFullName = ''; 
    /*--}}
    @foreach( $getCollegeDetailObj as $getCollegeName )
        {{--*/ 
            $collegeFullName = $getCollegeName->firstname; 
        /*--}}
    @endforeach
@endif 
{{--*/  
    $min = 3.5;
    $max = 5;
    $number = mt_rand ($min * 10, $max * 10) / 10;
    $ratingStar = $number;
    $totlaUserRating = 0;
/*--}}
@if(sizeof($collegeRatingObj) > 0)
    @if($collegeRatingObj[0]->totalCount > 0)
    {{--*/  
        $ratingStar = $collegeRatingObj[0]->totlaUserRating;
        $totlaUserRating = $collegeRatingObj[0]->totalCount;
    /*--}}
    @endif
@endif
@section('content')
<div class="single-listing-school-template single">
	@include('college.college-new-public-partial.profile-breadcum-partial')
    <div class="featured-school-single">
        <div class="container">
            @include('college.college-new-public-partial.profile-logo-banner-partial')
        </div>
    </div>
</div>
<div class="wrapper">
	<div class="container content profile" style="padding-top: 0px;">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/'.$slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-9">
								<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
								<span><strong>List of Reviews</strong></span>
							</div>				
						</div>
					</div>
					@if(Session::has('collegeReviews'))
	                <div class="alert alert-success  text-center" role="alert">
	                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                    </button>
	                    <strong>{{ Session::get('collegeReviews') }}</strong>
	                </div>
	                @endif
					<hr class="hr-gap">
					<div class="bg-color-white padding20">
						@if(Auth::check()) 
							<form method="POST" action="{{ URL::to('/college/review-forms/'.$slug.'/submit') }}" data-parsley-validate="" enctype="multipart/form-data">
						@else
							<form class="checkLoginStatusFormSubmit" data-parsley-validate ="" enctype = "multipart/form-data">
						@endif
							<input type="hidden" name="slugUrl" value="{{$slug}}">
							<div class="row">
								<div class="col-md-8">
									<label>Title</label>
									<input type="text" class="form-control" name="title" placeholder="Enter title" required="" data-parsley-error-message="Please enter title" value="">
								</div>
								<div class="col-md-4">
									<label>Like & Dislike </label><br>
				                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
				                      <label class="btn btn-success  active ">
				                        <input type="radio" name="votes" value="1" id="option1" autocomplete="off" checked=""><i class="fa fa-thumbs-up"></i> Like
				                      </label>
				                      <label class="btn btn-danger">
				                        <input type="radio" name="votes" value="2" id="option2" autocomplete="off"><i class="fa fa-thumbs-down"></i> Dislike
				                      </label>
				                    </div>
				                </div>
							</div>	
							<hr class="hr-gap">
							<div class="row">
								<div class="col-md-2">
									<label>Academic</label>
									<input type="text" class="form-control" name="academic" placeholder="Enter academic val" required="" data-parsley-error-message="Please enter academic value between 1 to 5 also float value accepted" value="" min="1" max="5" step="0.1">
								</div>
								<div class="col-md-2">
									<label>Accommodation</label>
									<input type="text" class="form-control" name="accommodation" placeholder="Enter accommodation val" required="" data-parsley-error-message="Please enter accommodation value between 1 to 5 also float value accepted" value="" min="1" max="5" step="0.1">
								</div>
								<div class="col-md-2">
									<label>Faculty</label>
									<input type="text" class="form-control" name="faculty" placeholder="Enter faculty val" required="" data-parsley-error-message="Please enter faculty value between 1 to 5 also float value accepted" value="" min="1" max="5" step="0.1">
								</div>
								<div class="col-md-2">
									<label>Infrastructure</label>
									<input type="text" class="form-control" name="infrastructure" placeholder="Enter infrastructure val" required="" data-parsley-error-message="Please enter infrastructure value between 1 to 5 also float value accepted" value="" min="1" max="5" step="0.1">
								</div>
								<div class="col-md-2">
									<label>Placement</label>
									<input type="text" class="form-control" name="placement" placeholder="Enter placement val" required="" data-parsley-error-message="Please enter placement value between 1 to 5 also float value accepted" value="" min="1" max="5" step="0.1">
								</div>
								<div class="col-md-2">
									<label>Social</label>
									<input type="text" class="form-control" name="social" placeholder="Enter social val" required="" data-parsley-error-message="Please enter social value between 1 to 5 also float value accepted" value="" min="1" max="5" step="0.1">
								</div>
							</div>	
							<hr class="hr-gap">	
							<div class="row">
								<div class="col-md-12">
									<label>Description</label>
									<textarea class="form-control summernote" rows="4" placeholder="Enter the about faculty" name="description" required="" data-parsley-error-message="Please enter review"></textarea>
								</div>
							</div>
							<hr class="hr-gap">
							<div class="row margin-bottom-20">
								<div class="col-md-12">
									<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
									{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
								</div>
							</div>
							<hr class="hr-gap">
							<div class="row">
								<div class="col-md-2 col-md-offset-5 text-center">
									<button type="submit" class="btn btn-u">Submit</button>
								</div>
							</div>
						</form>
					</div>
					<hr class="hr-gap">
					<div class="detail-page-signup margin-bottom40 table-responsive">
						<!-- Updated Course List -->
						@if( sizeof($listOfSubmitReviews) > 0 )
							@include('common-partials.college-review-list-partial')
						@else
							<h5>No Reviews.</h5>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#showRateCounter").rateYo({
        rating: {{ $ratingStar }},
        starWidth: "14px",
        readOnly: true,
        halfStar: true,
        spacing: "2px",
        normalFill: "#A0A0A0",
        ratedFill: "#ff7900",
        numStars: 5,
    });    
});  
</script>
<script type="text/javascript">
    window.onload = function() {
        var $recaptcha = document.querySelector('#g-recaptcha-response');

        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
    };
</script>

<script type="text/javascript">
// POST YOUR QUESTION AND THEN OPEN LOGIN FORM
$( '.checkLoginStatusFormSubmit' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ($(this).parsley().isValid()) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/college-reviews') }}",
            data: form,
            success: function(data){
			    $('#loginModal').modal({
			        show: 'true'
			    });
            },
            error: function(data){
            }
        });
    }else{
        
    }
});
</script>
@endsection