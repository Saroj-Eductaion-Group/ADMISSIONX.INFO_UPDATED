@extends('website/new-design-layouts.master')
@section('styles')
<link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css">

<style type="text/css">
    .resultForUniversityList {width: 63.5%; max-height: 223px;background: #ffffff;z-index: 10 !important;border: 1px solid #c6c6c6;position: absolute;overflow: auto;}
    .resultForUniversityList > ul{text-align: left;}
    .resultForUniversityList > ul > li{padding: 10px 10px 10px 20px;border-bottom: 1px solid #afafaf;}
    .resultForUniversityList > ul > li:last-child{border-bottom: none;}
    .resultForUniversityList > ul > li > a {color: #172e51;font-size: 14px;font-weight: 700;}
    .resultForUniversityList > p{color: #7f7f80;font-size: 12px;font-weight: 600;margin-top: 10px;}
    @media screen and (max-width: 1279px){
        .resultForUniversityList {width: auto;}
    }
</style>
@endsection

@section('content')       
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
{!! Html::style('/new-assets/css/main.css') !!}
<div class="preloader">
    <span class="preloader-spin"></span>
</div>
<div class="single-listing-school-template single" style="width:100%; display:table;
 background:#edeff0;">
    <div class="examsentranceTop padding-top60 padding-bottom80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="examsentranceBoT">
                        <h2 class="text-center padding-bottom15">Search University List</h2>
                        <div class="examsentranceInput">
                            <input type="text"  name="university" value="" class="form-control entranceDateInput" placeholder="Search by Name - University">
                            <i class="fa fa-search examsentrancesearchIcon"></i>
                            <div class="resultForUniversityList scroll hide margin-top15">
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
    <div class="page-header">
        <div class="container">
            <div class="col-md-12">
                <div class="row justify-content-between">
                    <h1>List of Top University ({{ $getUniversityInfoObj->total() }})</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- entrance exams start -->
    <div class="featured-school">
        <div class="container bg-white margin-bottom50">
            <div class="row margin-bottom30">
                <div class="portfolio-area section featured-school  padding-top30" style="display:flex; flex-wrap:wrap;">
                    @foreach($getUniversityInfoObj as $key => $item)
                    <div class="single-portfolio col-md-3">
                        <div class="inner">
                            <div class="portfolio-img">
                                @if( $item->logoimage != '' )
                                    <img src="{{ asset('common-logo') }}/{{ $item->logoimage }}" alt="{{ $item->name}}" style="object-fit: contain; background: #fff; height: 153px; display: block; margin-left: auto; margin-right: auto; width: 100%;">
                                @else
                                    <img src="new-assets/img/university.png" alt="{{ $item->name}}" style="object-fit: contain; background: #fff; height: 153px; display: block; margin-left: auto; margin-right: auto; width: 100%;">
                                @endif
                                <div class="hover-content">
                                    <div>
                                        <a href="{{ URL::to('university', $item->pageslug) }}" >View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content">
                                <a href="{{ URL::to('university', $item->pageslug) }}"><h3>{{ $item->name}}</h3></a>
                                <a href="{{ URL::to('university', $item->pageslug) }}"><div class="applynow"><button class="btn-ApplyNow">View College List @if($item->totalCollegeCount > 0)({{ $item->totalCollegeCount}})@endif</button> </div></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align:center;">
                    <div class="input_right_text text-center">
                        <ul class="pagination">
                            <li class="search_text">Search results</li>
                            <li><a href="{{$getUniversityInfoObj->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">{{ $getUniversityInfoObj->lastItem() }}</a></li>
                            <li class="search_text" style="width: auto;">of {{ $getUniversityInfoObj->total() }}</li>
                            <li><a href="{{$getUniversityInfoObj->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
                        </ul>
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
@include('website.home.search-pages.autocomplete-script-partial.university-search-partial')
@endsection

