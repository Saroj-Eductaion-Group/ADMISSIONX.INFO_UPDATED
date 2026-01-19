@extends('website/new-design-layouts.master')
@section('styles')
@include('website.home.search-pages.search-field-partials.country-state-city-search-style-partial')
<style type="text/css">
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
</style>
@endsection
@section('content')
<div class="examsentranceTop padding-top80 padding-bottom80">
    @include('website.home.search-pages.search-field-partials.country-state-city-search-partial')
</div>
<div class="exploreCategory padding-top20 padding-bottom20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="exploreCategoryTop text-center padding-bottom15">
                    <h2>explore ({{$getStateDetailInfoObj->countryName}}) ({{$getStateDetailInfoObj->stateName}}) cities list</h2>
                    <p class="padding-top5">BROWSE ({{ $getCountryStateCityList->total() }}) Cities</p>  
                </div>
            </div>
        </div>
        <div class="row margin-top30 margin-bottom30">
            <div class="notificationTop margin-bottom20">
                <h2> List of All Cities ({{ $getCountryStateCityList->total() }}) in {{$getStateDetailInfoObj->stateName}}, {{$getStateDetailInfoObj->countryName}} </h2>
            </div>
            <div class="col-md-12 justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('study-abroad') }}"> Study Abroad </a> > <a class="text-dark" href="{{ URL::to('/study-abroad/'.$getStateDetailInfoObj->countrySlug.'/states') }}"> {{$getStateDetailInfoObj->countryName}} </a> > <a class="text-dark" href="{{ URL::to('/study-abroad/'.$getStateDetailInfoObj->countrySlug.'/'.$getStateDetailInfoObj->stateSlug.'/cities') }} ">{{$getStateDetailInfoObj->stateName}}</a></span></div>
            </div>
            @foreach( $getCountryStateCityList as $item )
            <div class="col-md-4 margin-top20 margin-bottom20">
                <div class="notificationBot clientContactDetails">
                    <div class="row">
                        <div class="col-md-1 margin-left15" style="cursor: pointer;">
                            <div class="detailCoursebotIcon">
                                <a target="_blank" href="{{ URL::to('/'.$item->pageslug.'/'.$item->stateSlug.'/'.$item->countrySlug.'/college-list') }}">
                                    <i class="fa fa-university"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="detailCoursebotContent">
                                <a target="_blank" href="{{ URL::to('/'.$item->pageslug.'/'.$item->stateSlug.'/'.$item->countrySlug.'/college-list') }}">
                                    <h2 style="font-size: 15px !important;">{{ $item->name }} Colleges</h2>
                                </a>        
                            </div>
                        </div>
                    </div>
                    <div class="detailApplyNow text-center">
                        <a class="" style="display: inline-block; padding-left: 10px; padding-right: 10px;" target="_blank" href="{{ URL::to('/'.$item->pageslug.'/'.$item->stateSlug.'/'.$item->countrySlug.'/college-list') }}">View Colleges @if($item->totalCollegeRegAddress > 0)({{ $item->totalCollegeRegAddress}})@endif</a>
                    </div>
                </div>
            </div>
            @endforeach

            @if($getCountryStateCityList->total() > 20)
            <div class="row padding-top20 padding-bottom20">
                <div class="col-xs-12">
                    <div class="input_right_text text-center">
                        <ul class="pagination">
                            <li class="search_text">Search results</li>
                            <li><a href="{{$getCountryStateCityList->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">{{ $getCountryStateCityList->lastItem() }}</a></li>
                            <li class="search_text" style="width: auto;">of {{ $getCountryStateCityList->total() }}</li>
                            <li><a href="{{$getCountryStateCityList->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>  
    </div>
</div>
<!--end explore category-->
@endsection

@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.country-state-city-search-partial')
@endsection

