@extends('website/new-design-layouts.master')
@section('styles')
<link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css">
<style type="text/css">
    .resultForCollegeList {width: 63.5%; max-height: 223px;background: #ffffff;z-index: 10 !important;border: 1px solid #c6c6c6;position: absolute;overflow: auto;}
    .resultForCollegeList > ul{text-align: left;}
    .resultForCollegeList > ul > li{padding: 10px 10px 10px 20px;border-bottom: 1px solid #afafaf;}
    .resultForCollegeList > ul > li:last-child{border-bottom: none;}
    .resultForCollegeList > ul > li > a {color: #172e51;font-size: 14px;font-weight: 700;}
    .resultForCollegeList > p{color: #7f7f80;font-size: 12px;font-weight: 600;margin-top: 10px;}
    @media screen and (max-width: 1279px){
        .resultForCollegeList {width: auto;}
    }
</style>
<style type="text/css">
	.rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
	.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	</style>
@endsection

@section('content')       
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
{!! Html::style('/new-assets/css/main.css') !!}
<div class="preloader">
    <span class="preloader-spin"></span>
</div>
<div class="single-listing-school-template single">
    <div class="examsentranceTop padding-top60 padding-bottom80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="examsentranceBoT">
                        <h2 class="text-center padding-bottom15">Search College Reviews</h2>
                        <div class="examsentranceInput">
                            <input type="text"  name="college" value="" class="form-control entranceDateInput" placeholder="Search by Name - college">
                            <i class="fa fa-search examsentrancesearchIcon"></i>
                            <div class="resultForCollegeList scroll hide margin-top15">
                                <ul class="list-unstyled padding-top10">
                                    <li><a href="javascript:void(0);"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end entrance exams -->
    @if(sizeof($listOfSubmitReviews) > 0)
    <div class="page-header">
        <div class="container">
            <div class="col-md-12">
                <div class="row justify-content-between">
                    <h1>List of Reviews ({{ $listOfSubmitReviews->total() }})</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- entrance exams start -->
    <div class="featured-school">
        <div class="container">
            <div class="row margin-bottom30">
                <div class="portfolio-area section featured-school">
                    @foreach($listOfSubmitReviews as $key => $item)
                    <div class="row margin-bottom20 rating_reviews_info">
                    	<div class="col-md-12">
                    		<div class="padding-top10 padding-left10 padding-right10">
				                <label class="font-noraml"><i class="fa-fw fa fa-university"></i>College Name : 
				                @if( $item->collegeUserFirstName )
									<a href="{{ URL::to('/college/'.$item->collegeSlug) }}" target="_blank"> {{ $item->collegeUserFirstName }}</a>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
				                </label>

				                <ul class="list-inline padding-bottom5">
									<li class="padding0">
										<a class="btn btn-info text-white btn-xs border-radius15" href="{{ URL::to('/college/'.$item->collegeSlug.'/reviews') }}"><i class="fa fa-star"></i> View All Reviews</a>
									</li>
									<li class="padding0">|</li>
									<li class="padding0">
										<a class="btn btn-warning text-white btn-xs border-radius15" href="{{ URL::to('/college/'.$item->collegeSlug) }}"><i class="fa fa-eye"></i> View College Profile</a>
									</li>
								</ul>
				            </div>
                    	</div>
					    <div class="col-md-6">
					        <div class="padding-top10 padding-left10 padding-right10">
					            <div>
					                <label class="font-noraml"><i class="fa-fw fa fa-user"></i>Student Name : 
					                @if( $item->collegeUserFirstName )
										{{ $item->studentUserFirstName }} {{ $item->studentUserLastName }}
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
					                </label>
					            </div>
					            <div>
					                <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Review Title : 
									@if($item->title )
										{{ $item->title }}
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
					                </label>
					            </div>
					            <div>
					                <label class="font-noraml"><i class="fa-fw fa fa-calendar"></i> Review Date : 
					                @if($item->created_at)
										{{ date('d F Y', strtotime($item->created_at)) }}
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
					                </label>
					            </div>
					            <div>
						            <label class="font-noraml"><i class="fa-fw fa fa-thumbs-up"></i> Vote : 
						            @if( $item->votes )
										@if($item->votes == 1)<span class="label label-success rounded">Liked</span> @elseif($item->votes == 2)<span class="label label-danger rounded">Disliked</span> @endif
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
						            </label>
						        </div>
					        </div>
					    </div>
					    <div class="col-md-3">
					        <div class=" padding-top10 padding-left10 padding-right10">
					            <div>
						            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Academic : 
						            @if( $item->academic )
										{{ $item->academic }}/5
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
						            </label>
						        </div>
						        <div>
						            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Accommodation : 
						            @if( $item->accommodation )
										{{ $item->accommodation }}/5
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
						            </label>
						        </div>
						        <div>
						            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Faculty : 
						            @if( $item->faculty )
										{{ $item->faculty }}/5
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
						            </label>
						        </div>
					        </div>
					    </div>
					    <div class="col-md-3">
					        <div class=" padding-top10 padding-left10 padding-right10">
						        <div>
						            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Infrastructure : 
						            @if( $item->infrastructure )
										{{ $item->infrastructure }}/5
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
						            </label>
						        </div>
						        <div>
						            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Placement : 
						            @if( $item->placement )
										{{ $item->placement }}/5
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
						            </label>
						        </div>
						        <div>
						            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Social : 
						            @if( $item->social )
										{{ $item->social }}/5
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
						            </label>
						        </div>
					        </div>
					    </div>
					    <div class="col-md-12">
					        <div class=" padding-bottom10 padding-left10 padding-right10">
					            <div>
					                <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Review Description : 
					                @if( $item->description )
										{!! $item->description !!}
									@else
										<span class="label label-warning">Not updated yet</span>
									@endif
					                </label>
					            </div>
					        </div>
					    </div>
					</div>
                    @endforeach
                    <div class="row padding-top20 padding-bottom20">
                        <div class="col-xs-12">
                            <div class="input_right_text text-center">
                                <ul class="pagination">
                                    <li class="search_text">Search results</li>
                                    <li><a href="{{$listOfSubmitReviews->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
                                    <li class="active"><a href="javascript:void(0);">{{ $listOfSubmitReviews->lastItem() }}</a></li>
                                    <li class="search_text" style="width: auto;">of {{ $listOfSubmitReviews->total() }}</li>
                                    <li><a href="{{$listOfSubmitReviews->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    	<div class="page-header">
	        <div class="container">
	            <div class="col-md-12">
	                <div class="row justify-content-between">
	                    <h1>List of Reviews</h1>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="featured-school">
	        <div class="container">
	            <div class="row margin-bottom30">
	                <div class="portfolio-area section featured-school">
	                   <div class="row margin-bottom20 rating_reviews_info">
	                    	<div class="col-md-12">
	                    		<div class="padding-top10 padding-left10 padding-right10">
        							<div class="headline text-center"><h3>Review not listed.</h3></div>
	                    		</div>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    @endif
</div>

{!! Html::script('new-assets/js/jquery-2.2.4.min.js') !!}
{!! Html::script('new-assets/js/owl.carousel.min.js') !!}
{!! Html::script('new-assets/js/slicknav.min.js') !!}
{!! Html::script('new-assets/js/active.js') !!}
@endsection

@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.college-search-partial')
@endsection