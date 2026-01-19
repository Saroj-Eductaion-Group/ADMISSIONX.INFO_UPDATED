@extends('website/new-design-layouts.master')
@section('styles')
<link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css">

<style type="text/css">
    .resultForStreamDegreeCourseList {width: 63.5%; max-height: 223px;background: #ffffff;z-index: 10 !important;border: 1px solid #c6c6c6;position: absolute;overflow: auto;}
    .resultForStreamDegreeCourseList > ul{text-align: left;}
    .resultForStreamDegreeCourseList > ul > li{padding: 10px 10px 10px 20px;border-bottom: 1px solid #afafaf;}
    .resultForStreamDegreeCourseList > ul > li:last-child{border-bottom: none;}
    .resultForStreamDegreeCourseList > ul > li > a {color: #172e51;font-size: 14px;font-weight: 700;}
    .resultForStreamDegreeCourseList > p{color: #7f7f80;font-size: 12px;font-weight: 600;margin-top: 10px;}
    @media screen and (max-width: 1279px){
        .resultForStreamDegreeCourseList {width: auto;}
    }
</style>
<style type="text/css">
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
</style>
@endsection
@section('content')
<div class="examsentranceTop padding-top80 padding-bottom80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="examsentranceBoT">
                    <h2 class="text-center padding-bottom15">Search Course List</h2>
                    {{-- <div class="examsentranceInput">
                        <input type="text"  name="course" value="" class="form-control entranceDateInput" placeholder="Search by Name - Course">
                        <i class="fa fa-search examsentrancesearchIcon"></i>
                        <div class="resultForStreamDegreeCourseList scroll hide margin-top15">
                            <ul class="list-unstyled padding-top10">
                                <li><a href="javascript:void(0);"></a></li>
                            </ul>
                        </div>
                    </div> --}}
                    <div class="examsentranceInput">
                        <input type="text"  name="search" value="" class="form-control entranceDateInput" placeholder="Search by Name - Courses/Degree/Stream">
                        <i class="fa fa-search examsentrancesearchIcon"></i>
                        <div class="resultForCommonSearchList scroll hide margin-top15">
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
<div class="exploreCategory padding-top20 padding-bottom20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="exploreCategoryTop text-center padding-bottom15">
                    <h2>explore course list</h2>
                    <p class="padding-top5">BROWSE ({{ $streamDegreeCourseList->total() }}) Course</p>  
                </div>
            </div>
        </div>
        <div class="row margin-top30 margin-bottom30">
            <div class="notificationTop margin-bottom20">
                <h2> List of All Course ({{ $streamDegreeCourseList->total() }})</h2>
            </div>
            <div class="col-md-12 justify-content-between margin-bottom10">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('stream') }}"> Stream </a> > <a class="text-dark" href="{{ URL::to('/stream/'.$getDegreeDetailInfoObj->functionalareapageslug.'/degree') }}"> {{$getDegreeDetailInfoObj->functionalareaName}} </a> > <a class="text-dark" href="{{ URL::to('/stream/'.$getDegreeDetailInfoObj->functionalareapageslug.'/'.$getDegreeDetailInfoObj->pageslug.'/courses') }}"> {{$getDegreeDetailInfoObj->name}} </a></span></div>
            </div>
            @foreach( $streamDegreeCourseList as $item )
            <div class="col-md-4 margin-top20 margin-bottom20">
                <div class="notificationBot clientContactDetails">
                    <div class="row">
                        <div class="col-md-1 margin-left15" style="cursor: pointer;">
                            <div class="detailCoursebotIcon">
                                <a target="_blank" href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->degreepageslug.'/'.$item->pageslug.'/colleges') }}">
                                    <i class="fa fa-book"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="detailCoursebotContent">
                                <a target="_blank" href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->degreepageslug.'/'.$item->pageslug.'/colleges') }}">
                                    <h2 style="font-size: 15px !important;">{{ $item->name }}</h2>
                                </a>        
                            </div>
                        </div>
                    </div>
                    <div class="detailApplyNow text-center">
                        <a class="" style="display: inline-block; padding-left: 10px; padding-right: 10px;" target="_blank" href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->degreepageslug.'/'.$item->pageslug.'/colleges') }}">View Colleges @if($item->totalCollegeCount > 0)({{ $item->totalCollegeCount}})@endif</a>
                    </div>
                </div>
            </div>
            @endforeach

            @if($streamDegreeCourseList->total() > 20)
            <div class="row padding-top20 padding-bottom20">
                <div class="col-xs-12">
                    <div class="input_right_text text-center">
                        <ul class="pagination">
                            <li class="search_text">Search results</li>
                            <li><a href="{{$streamDegreeCourseList->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">{{ $streamDegreeCourseList->lastItem() }}</a></li>
                            <li class="search_text" style="width: auto;">of {{ $streamDegreeCourseList->total() }}</li>
                            <li><a href="{{$streamDegreeCourseList->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
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
@include('website.home.search-pages.autocomplete-script-partial.stream-degree-course-search-partial')
@include('website.home.search-pages.autocomplete-script-partial.stream-degree-course-edulabel-search-partial')
@endsection

