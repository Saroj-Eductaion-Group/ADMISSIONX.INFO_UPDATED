@extends('website/new-design-layouts.master')

{{--*/ $bannerImg1 = $bannerImg2 = $bannerImg3 = $bannerImg4 = ''  /*--}}
{{--*/ $redirectTo1 = $redirectTo2 = $redirectTo3 = $redirectTo4 = ''  /*--}}
@foreach($getCollegeSeachBannerAds as $key => $obj)
@if($key == 0)
{{--*/ $bannerImg1 = $obj->img  /*--}}
{{--*/ $redirectTo1 = $obj->redirectto  /*--}}
@elseif($key == 1)
{{--*/ $bannerImg2 = $obj->img  /*--}}
{{--*/ $redirectTo2 = $obj->redirectto  /*--}}
@elseif($key == 2)
{{--*/ $bannerImg3 = $obj->img  /*--}}
{{--*/ $redirectTo3 = $obj->redirectto  /*--}}
@elseif($key == 3)
{{--*/ $bannerImg4 = $obj->img  /*--}}
{{--*/ $redirectTo4 = $obj->redirectto  /*--}}
@endif
@endforeach

@section('styles')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style type="text/css">
    .logoimage{object-fit: contain; background: #fff; height: 153px; display: block; margin-left: auto; margin-right: auto; width: 100%;}
</style>
<link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css">

<style type="text/css">
    .resultForUniversityList {width: 95%; max-height: 223px;background: #ffffff;z-index: 1000 !important;border: 1px solid #c6c6c6;position: absolute;overflow: auto;}
    .resultForUniversityList > ul{text-align: left;}
    .resultForUniversityList > ul > li{padding: 10px 10px 10px 20px;border-bottom: 1px solid #afafaf;}
    .resultForUniversityList > ul > li:last-child{border-bottom: none;}
    .resultForUniversityList > ul > li > a {color: #172e51;font-size: 14px;font-weight: 700;}
    .resultForUniversityList > p{color: #7f7f80;font-size: 12px;font-weight: 600;margin-top: 10px;}
    @media screen and (max-width: 1279px){
        .resultForUniversityList {width: auto;}
    }
    .header-bg-section {max-height: 400px !important;}
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
    <div class="page-header">
        <div class="container">
            <div class="col-md-12">
                <div class="row justify-content-between">       
                    <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('top-university') }}"> University</a> > {{$getUniversityDetailInfoObj->name}}</span></div>
                </div>
            </div>
        </div>
    </div>        
    <div class="featured-school-single">
        <div class="container">
            <div class="header-section"></div>
            <div class="header-bg-section">
                @if( $getUniversityDetailInfoObj->bannerimage != '' )
                    <img src="{{ asset('/common-banner') }}/{{ $getUniversityDetailInfoObj->bannerimage }}" alt="{{$getUniversityDetailInfoObj->name}} logo" style="max-width: 100%;">
                @else
                    <img src="/new-assets/img/schools-in-dehradun-ecole.jpg" alt="{{$getUniversityDetailInfoObj->name}} logo" style="max-width: 100%;">
                @endif
            </div>
            <div class="header-wrapper d-flex">
                <div class="listing-logo">
                    @if( $getUniversityDetailInfoObj->logoimage != '' )
                        <img src="{{ asset('common-logo') }}/{{ $getUniversityDetailInfoObj->logoimage }}" alt="{{$getUniversityDetailInfoObj->name}} logo">
                    @else
                        <img src="/new-assets/img/university.png" alt="{{$getUniversityDetailInfoObj->name}} logo">
                    @endif
                </div>
                <div class="listing-content">
                    <a href="#">
                        <h3>{{$getUniversityDetailInfoObj->name}}</h3>
                    </a>
                </div>
            </div>
            @if(!empty($getUniversityDetailInfoObj->pagedescription))
            <div class="school-info section">
                <div class="section-title">
                    <h3>About {{$getUniversityDetailInfoObj->name}}</h3>
                </div>
                <div class="section-content">
                    <p>{{ $getUniversityDetailInfoObj->pagetitle }}</p>
                    <p>{!! $getUniversityDetailInfoObj->pagedescription !!}</p>
                </div>
            </div>
            @endif
        </div>  
    </div>
    <div class="page-header">
        <div class="container">
            <div class="col-md-12">
                <div class="row justify-content-between">
                    <h1>List of ({{$getUniversityDetailInfoObj->name}}) Colleges </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="featured-school">
        <div class="container">
            <div class="row margin-bottom30">
            <form method="GET" action="/university/{{$getUniversityDetailInfoObj->pageslug}}">
                <div class="col-md-3 sidebar-filters">
                    <div class="sidebar-heading"><h2>Filters</h2></div>
                    @include('website.home.search-pages.search-sidebar-partial.college-type-partial')
                    @include('website.home.search-pages.search-sidebar-partial.affiliation-partial')
                    @include('website.home.search-pages.search-sidebar-partial.education-level-partial')
                    @include('website.home.search-pages.search-sidebar-partial.stream-partial')
                    @include('website.home.search-pages.search-sidebar-partial.degree-partial')
                    @include('website.home.search-pages.search-sidebar-partial.courses-partial')
                    @include('website.home.search-pages.search-sidebar-partial.fees-list-partial')

                    <a href="{{ URL::to('university/'.$getUniversityDetailInfoObj->pageslug) }}"><button type="button" class="btn-u btn-block resetNow margin-top20 margin-bottom20">Reset</button></a>

                    @if(!empty($bannerImg1))
                    <div class="margin-top20">
                        <a href="{{ $redirectTo1 }}" target="_blank" title="View Now">
                            <img src="{{ asset('assets/ads-banner/'.$bannerImg1) }}" class="img-responsive img-thumbnail" alt="banner image">
                        </a>
                    </div>
                    @endif
                    @include('common-partials.ads-slider', ['addonClass' => 'margin-top20 margin-bottom20', 'ads_position' => 'sidebar'])
                </div>
                <div class="col-md-9">
                    <div class="slisting-search">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="university" value="" class="form-control" placeholder="Search by Name - University">
                                <div class="resultForUniversityList scroll hide">
                                    <ul class="list-unstyled padding-top10">
                                        <li><a href="javascript:void(0);"></a></li>
                                    </ul>
                                </div>  
                            </div>
                            <div class="col-md-4">
                                @include('website.home.search-pages.search-sidebar-partial.sort-by-list-partial')
                            </div>
                        </div>
                    </div>
                    @if( sizeof($getFilterOutDataObj) > 0 )
                        @foreach( $getFilterOutDataObj as $item )
                        <div class="single-listing-box col-md-12">
                            <div class="inner d-flex">
                                <div class="listing-img">
                                    <a href="{{ URL::to('/college', $item->slug) }}" title="{{ $item->firstname }}">
                                        @if( $item->caption == 'College Logo' )
                                            @if(file_exists(public_path().'/gallery/'.$item->slug.'/'.$item->galleryName))
                                                @if( $item->galleryName != '' )
                                                    <img class="logoimage" src="{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->galleryName }}" alt="{{ $item->firstname }} logo">
                                                @else
                                                    <img class="logoimage" src="/new-assets/img/school.png" alt="{{ $item->firstname }} logo">
                                                @endif
                                            @else
                                                <img class="logoimage" src="/new-assets/img/school.png" alt="{{ $item->firstname }} logo">
                                            @endif
                                        @else
                                            <img class="logoimage" src="/new-assets/img/school.png" alt="{{ $item->firstname }} logo">
                                        @endif
                                    </a>
                                    
                                </div>
                                <div class="listing-content">
                                    <a href="{{ URL::to('/college', $item->slug) }}" title="{{ $item->firstname }}"><h3>{{ $item->firstname }}</h3></a>
                                    <div class="review-star">
                                        <ul class="list-unstyled list-inline">
                                            <li class="nomargin-nopadding">{{ $item->rating }}</li>
                                            <li class="nomargin-nopadding"><i id="showRateCounter_{{ $item->collegeprofileID}}"></i></li>
                                            <li class="nomargin-nopadding">({{ $item->totalRatingUser }})</li>
                                        </ul>
                                    </div>
                                    @if($item->campusSortAddress != '' && !empty($item->campusSortAddress))
                                        <span><strong>Location: </strong>{{ str_limit($item->campusSortAddress, 100 ) }}</span>
                                    @else
                                        <span><strong>Location: </strong>{{ str_limit($item->registeredSortAddress, 100 ) }}</span>
                                    @endif
                                    <div class="boottom-link" style="width: auto;"> 
                                        <span><a href="/college/{{ $item->slug }}#profile" target="_blank">Admission</a></span>
                                        <span><a href="/college/{{ $item->slug }}#courses" target="_blank">Courses & Fees</a></span>
                                        <span><a href="{{ url('/college/'.$item->slug.'/faculty') }}" target="_blank">Faculty</a></span>
                                        <span><a href="{{ url('/college/'.$item->slug.'/admission-procedure') }}" target="_blank">Admission Procedure</a></span>
                                        <span><a href="{{ url('/college/'.$item->slug.'/reviews') }}" target="_blank">Reviews</a></span>
                                        <span><a href="{{ url('/college/'.$item->slug.'/faqs') }}" target="_blank">FAQs</a></span>
                                    </div>
                                    <p>
                                        <div class="row">
                                            @if( empty(Request::get('functionalarea')) )
                                                
                                            @elseif( !empty(Request::get('functionalarea')) AND empty(Request::get('degree')) AND empty(Request::get('course')) )
                                                <div class="col-md-12 sky-form sky-form-no-block">
                                                    <h6>Available Courses :
                                                    {{--*/ $explodeFuncArea = explode(',', $item->functionalareaName) /*--}}
                                                    @foreach( $explodeFuncArea as $explode )
                                                        <a href="{{ URL::to('/college/detail-course', array($item->collegemasterID,$item->slug), false) }}"  style="color: #000000;">{{ $explode }}</a>
                                                    @endforeach
                                                    </h6>
                                                </div>
                                            @elseif( !empty(Request::get('functionalarea')) AND !empty(Request::get('degree')) AND empty(Request::get('course')) )
                                                <div class="col-md-12 sky-form sky-form-no-block">
                                                    <h6>Available Branches : 
                                                    {{--*/ $explodeFuncArea = explode(',', $item->functionalareaName) /*--}}
                                                    @foreach( $explodeFuncArea as $explode )
                                                        <a href="{{ URL::to('/college/detail-course', array($item->collegemasterID,$item->slug), false) }}"  style="color: #000000;">{{ $explode }}</a>
                                                    @endforeach
                                                    </h6>
                                                </div>
                                            @else
                                                <div class="col-md-12 sky-form sky-form-no-block">
                                                <a href="{{ URL::to('/college/detail-course', array($item->collegemasterID,$item->slug), false) }}"  style="color: #000000;">{{ $item->degreeName }} | {{ $item->courseName }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </p>
                                    @if( !empty(Request::get('functionalarea')) AND !empty(Request::get('degree')) AND !empty(Request::get('course')) )
                                    <p class="clearBothNow">
                                        @if( $item->seats <= 5 && $item->seats > '0')
                                            <span class="pull-left text-left">Seats Available<br>{{ $item->seats }}</span>
                                        @endif
                                        @if($item->fees == '0')
                                        <span class="pull-right text-right"><b style="color: #cb3904;">Fee : N/A</b></span>
                                        @else
                                        <span class="pull-right text-right"><b style="color: #cb3904;">₹ {{ $item->fees }}</b></span><br> <span class="pull-right text-right" style="font-size: 10px;color: #5c952e;"> Per year </span>
                                        @endif
                                    </p>
                                    @endif

                                    <div class="applynow margin-top10">
                                        @if( $item->agreement == '1')
                                            @if( !empty(Request::get('functionalarea')) AND !empty(Request::get('degree')) AND !empty(Request::get('course')) )
                                                <a class="btn-ApplyNow" href="{{ URL::to('/college/detail-course', array($item->collegemasterID,$item->slug), false) }}">Apply Now</a>
                                            @else
                                                <a class="btn-ApplyNow" href="/college/{{ $item->slug }}#courses">Apply Now</a>
                                                {{-- <a class="btn-ApplyNow" href="{{ URL::to('/college', $item->slug) }}">Apply Now</a> --}}
                                            @endif
                                        @endif
                                        @if(Auth::check())
                                        {{--*/   $getLoggedObj = DB::table('users')
                                                ->where('users.id', '=', Auth::id())
                                                ->select('users.id')
                                                ->take(1)
                                                ->get()
                                                ;
                                        /*--}}
                                            @if( $getLoggedObj )
                                            <a class="btn-ApplyNow" href="{{ URL::to('/college', $item->slug) }}">Query</a>
                                            @endif
                                        @else
                                            <a class="btn-ApplyNow" href="{{ URL::to('/query-search-login', $item->slug) }}">Query</a>
                                        @endif
                                        <a class="btn-ApplyNow" href="{{ URL::to('/college', $item->slug) }}">View Details</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $getFilterOutDataObj->appends(\Input::except('page'))->render() !!}</div>
                            </div>
                        </div> -->
                        <div class="row padding-top20 padding-bottom20">
                            <div class="col-xs-12">
                                <div class="input_right_text text-center">
                                    <ul class="pagination">
                                        <li class="search_text">Search results</li>
                                        <li><a href="{{$getFilterOutDataObj->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
                                        <li class="active"><a href="javascript:void(0);">{{ $getFilterOutDataObj->lastItem() }}</a></li>
                                        <li class="search_text" style="width: auto;">of {{ $getFilterOutDataObj->total() }}</li>
                                        <li><a href="{{$getFilterOutDataObj->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if(!empty($bannerImg2))
                            <div class="margin-top20">
                                <a href="{{ $redirectTo2 }}" target="_blank" title="View Now">
                                    <img src="{{ asset('assets/ads-banner/'.$bannerImg2) }}" class="img-responsive img-thumbnail" alt="banner image">
                                </a>
                            </div>
                        @endif
                        @include('common-partials.ads-slider', ['addonClass'=>'margin-top20 margin-bottom20','ads_position'=>'default'])
                    @else
                        <div class="headline text-center"><h3>No match found, please try with different search criteria</h3></div>
                    @endif
                </div>
            </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

@foreach( $getFilterOutDataObj as $item)
<script type="text/javascript">
$(document).ready(function(){
    $("#showRateCounter_{{ $item->collegeprofileID}}").rateYo({
        rating: {{ $item->rating }},
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
@endforeach
<script type="text/javascript">
    $(function() {
        $('.searchParam').change(function() {
            this.form.submit();
        });

        $('input[type="radio"][name="fees"]').change(function() {
            this.form.submit();
        });
    });
</script>
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.university-search-partial')
@endsection

