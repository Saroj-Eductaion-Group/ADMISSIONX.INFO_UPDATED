@extends('website/new-design-layouts.master')
@section('styles')
<link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css">

<style type="text/css">
    .resultForStreamList {width: 63.5%; max-height: 223px;background: #ffffff;z-index: 10 !important;border: 1px solid #c6c6c6;position: absolute;overflow: auto;}
    .resultForStreamList > ul{text-align: left;}
    .resultForStreamList > ul > li{padding: 10px 10px 10px 20px;border-bottom: 1px solid #afafaf;}
    .resultForStreamList > ul > li:last-child{border-bottom: none;}
    .resultForStreamList > ul > li > a {color: #172e51;font-size: 14px;font-weight: 700;}
    .resultForStreamList > p{color: #7f7f80;font-size: 12px;font-weight: 600;margin-top: 10px;}
    @media screen and (max-width: 1279px){
        .resultForStreamList {width: auto;}
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
                    <h2 class="text-center padding-bottom15">Search Stream List</h2>
                    {{-- <div class="examsentranceInput">
                        <input type="text"  name="stream" value="" class="form-control entranceDateInput" placeholder="Search by Name - Stream">
                        <i class="fa fa-search examsentrancesearchIcon"></i>
                        <div class="resultForStreamList scroll hide margin-top15">
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
                    <h2>explore stream list</h2>
                    <p class="padding-top5">BROWSE ({{ sizeof($functionalareaList) }}) Stream</p>  
                </div>
            </div>
        </div>
        <div class="row margin-top30 margin-bottom30">
            <div class="notificationTop margin-bottom20">
                <h2> List of All Stream ({{ sizeof($functionalareaList) }})</h2>
            </div>
            @foreach( $functionalareaList as $item )
            <div class="col-md-4 margin-top20 margin-bottom20">
                <div class="notificationBot clientContactDetails">
                    <div class="row">
                        <div class="col-md-1 margin-left15" style="cursor: pointer;">
                            <div class="detailCoursebotIcon">
                                <a target="_blank" href="{{ URL::to('/stream/'.$item->pageslug.'/degree') }}">
                                    <i class="fa fa-book"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="detailCoursebotContent">
                                <a target="_blank" href="{{ URL::to('/stream/'.$item->pageslug.'/degree') }}">
                                    <h2 style="font-size: 15px !important;">{{ $item->name }}</h2>
                                </a>        
                            </div>
                        </div>
                    </div>
                    <div class="detailApplyNow text-center">
                        <a class="" style="display: inline-block; padding-left: 10px; padding-right: 10px;" target="_blank" href="{{ URL::to('/stream/'.$item->pageslug.'/degree') }}">View Degree @if($item->totalDegreeCount > 0)({{ $item->totalDegreeCount}})@endif</a>
                        <a class="" style="display: inline-block; padding-left: 10px; padding-right: 10px;" target="_blank" href="{{ URL::to('/'.$item->pageslug.'/colleges') }}">Explore Colleges</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>  
    </div>
</div>
<!--end explore category-->
@endsection


@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.stream-search-partial')
@include('website.home.search-pages.autocomplete-script-partial.stream-degree-course-edulabel-search-partial')
@endsection

