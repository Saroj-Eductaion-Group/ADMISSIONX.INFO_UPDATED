@extends('website/new-design-layouts.master')
@section('styles')
@include('website.home.search-pages.search-field-partials.country-state-city-search-style-partial')
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
        @include('website.home.search-pages.search-field-partials.country-state-city-search-partial')
    </div>
    <!-- end entrance exams -->
    <div class="page-header">
        <div class="container">
            <div class="col-md-12">
                <div class="row justify-content-between">
                    <h1>List of Top Country ({{ $getStudyAbroadObj->total() }})</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- entrance exams start -->
    <div class="featured-school">
        <div class="container">
            <div class="row margin-bottom30">
                <div class="portfolio-area section featured-school bg-white">
                    @foreach($getStudyAbroadObj as $key => $item)
                    <div class="single-portfolio col-md-3">
                        <div class="inner">
                            <div class="portfolio-img">
                                @if( $item->logoimage != '' )
                                    <img src="{{ asset('common-logo') }}/{{ $item->logoimage }}" alt="{{ $item->name}}" style="object-fit: contain; background: #fff; height: 153px; display: block; margin-left: auto; margin-right: auto; width: 100%;">
                                @else
                                    <img src="new-assets/img/school.png" alt="{{ $item->name}}" style="object-fit: contain; background: #fff; height: 153px; display: block; margin-left: auto; margin-right: auto; width: 100%;">
                                @endif
                                <div class="hover-content">
                                    <div>
                                        <a href="{{ URL::to('/'.$item->pageslug.'/college-list') }}" >View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content">
                                <a href="{{ URL::to('/'.$item->pageslug.'/college-list') }}"><h3>{{ $item->name}}</h3></a>
                                <a href="{{ URL::to('/'.$item->pageslug.'/college-list') }}"><div class="applynow"><button class="btn-ApplyNow">No. Of College @if($item->totalCollegeRegAddress > 0)({{ $item->totalCollegeRegAddress}})@endif</button> </div></a>
                                <a href="{{ URL::to('/study-abroad/'.$item->pageslug.'/states') }}"><div class="applynow"><button class="btn-ApplyNow">States/Union Territories @if($item->totalStateCount > 0)({{ $item->totalStateCount}})@endif</button> </div></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row padding-top20 padding-bottom20">
                        <div class="col-xs-12">
                            <div class="input_right_text text-center">
                                <ul class="pagination">
                                    <li class="search_text">Search results</li>
                                    <li><a href="{{$getStudyAbroadObj->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
                                    <li class="active"><a href="javascript:void(0);">{{ $getStudyAbroadObj->lastItem() }}</a></li>
                                    <li class="search_text" style="width: auto;">of {{ $getStudyAbroadObj->total() }}</li>
                                    <li><a href="{{$getStudyAbroadObj->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Html::script('new-assets/js/jquery-2.2.4.min.js') !!}
{!! Html::script('new-assets/js/owl.carousel.min.js') !!}
{!! Html::script('new-assets/js/slicknav.min.js') !!}
{!! Html::script('new-assets/js/active.js') !!}
@endsection

@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.country-state-city-search-partial')
@endsection

