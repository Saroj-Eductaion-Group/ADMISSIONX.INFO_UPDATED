@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Admission Procedure
@endsection

@section('styles')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
	<style type="text/css">
	.rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
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
								<span><strong>Admission Procedure Lists</strong></span>
							</div>				
						</div>
					</div>
					<hr class="hr-gap">
					<div class="detail-page-signup margin-bottom40 table-responsive">
						<div class="headline"><h2>Manage Your College Admission Procedure Lists</h2></div>
						@if( sizeof($getAdmissionProcedureObj) > 0 )
							@foreach( $getAdmissionProcedureObj as $item )
								<div class="row margin-bottom20 rating_reviews_info">
						            <div class="col-md-9">
						                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
						                    <div>
							                    <label class="font-noraml"><i class="fa-fw fa  fa-list"></i> Title : 
							                	@if($item->title)
													{{ $item->title }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
							                    </label>
							                </div>
						                    <div>
						                        <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Stream : 
						                    	@if($item->functionalareaName)
													{{ $item->functionalareaName }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
						                    <div class="">
						                        <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Degree : 
						                		@if($item->degreeName)
													{{ $item->degreeName }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
												</label>
						                    </div>
						                    <div class="">
						                        <label class="font-noraml"><i class="fa-fw fa fa-list"></i> Degree Level : 
						                        @if($item->educationlevelName)
													{{ $item->educationlevelName }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
						                    <div class="">
						                        <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course Type : 
						                        @if($item->coursetypeName)
													{{ $item->coursetypeName }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
						                    <div class="">
						                        <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course : 
						                        @if($item->courseName)
													{{ $item->courseName }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
						                </div>
						            </div>
						            <div class="col-md-3">
						                <div class=" padding-top10  padding-left10 padding-right10">
						                    <div>
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseImportantDates{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> Important Dates</a>
						                    </div>
						                </div>
						            </div>
						            <div class="col-md-12">
						            	<div class="padding-bottom10 padding-left10 padding-right10">
					                        <label class="font-noraml"><i class="fa-fw fa fa-sticky-note"></i> Admission Procedure Details : </label>
					                        <br>
					                        @if($item->description)
					                            <span class="minimize2">{!! $item->description !!}</span>
					                        @else
					                            <span class="label label-warning">Not updated yet</span>
					                        @endif
					                    </div>
						            </div>
						        	@include('college/admission-procedure.important-dates-partial')
						        </div>
							@endforeach
							<div class="row indexPagination">
                				<div class="col-md-12 text-center">
                                <div class="custom-pagination">{!! $getAdmissionProcedureObj->render() !!}</div>
	                            </div>
	                        </div>
						@else
							<h5>No Admission Procedure listed.</h5>
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
@endsection


