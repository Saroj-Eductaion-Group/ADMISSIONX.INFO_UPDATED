@extends('website/new-design-layouts.master')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
   
    {!! Html::style('/new-assets/css/main.css') !!}
    {!! Html::style('/new-assets/css/jquery.typehead.css') !!}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.10.6/jquery.typeahead.min.css">    
    @section('styles')
    <style type="text/css">
    .typeahead__result {font-size: 14px;}
    .typeahead__result .row {display: table-row;}
    .typeahead__result .row>* {display: table-cell;vertical-align: middle;}
    .typeahead__result>ul>li>a small {padding-left: 0;color: #999;}
    .typeahead__result .project-information li {font-size: 12px;}
    .js-typeahead-user_v2 {height: 48px!important;}
    .typeahead__list {padding-top: 0!important;max-height: 250px;overflow: auto;overflow-y: auto;overflow-x: hidden;}
    .typeahead__list::-webkit-scrollbar {width: 5px;}
    .typeahead__list::-webkit-scrollbar-track {background-color: #eee;}
    .typeahead__list::-webkit-scrollbar-thumb {-webkit-border-radius: 10px;border-radius: 10px;background: #b3b3b3;}
    .typeahead__field input {border-radius: 5px!important;border-radius: 5px!important;padding-left: 20;width: calc(100% - 60px);align-items: center !important;justify-content: center !important;}
    @media screen and (max-width:600px) {
        .typeahead__list {padding-top: 0!important;max-height: 200px;overflow: auto;overflow-y: auto;overflow-x: hidden;margin-top: 30px;left: -15px;right: -15px;width: 110%;}
        .typeahead__cancel-button {top: 6px;right: 1.8em;font-size: 24px !important;}
        .typeahead__dropdown>li>a,
        .typeahead__list>li>a {padding: 10px 20px;}
        .typeahead__list::-webkit-scrollbar {width: 5px;}
        .typeahead__list::-webkit-scrollbar-track {background-color: #eee;}
        .typeahead__list::-webkit-scrollbar-thumb {-webkit-border-radius: 10px;border-radius: 10px;background: #b3b3b3;}
    }   
    .textColorSelect {color: #6b6b6b!important;font-size: 14px!important;font-weight: 200!important;}   
    @if($agent->isMobile())
        .typeahead__result {font-size: 12px;}
        .typeahead__list {padding-top: 0!important;max-height: 205px;overflow: auto;overflow-y: auto;overflow-x: hidden;}
    @endif 
</style>
<link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css">
<style type="text/css">
    .resultForCollegeList {top:140px; width: 56%; max-height: 223px;background: #ffffff;z-index: 1000 !important;border: 1px solid #c6c6c6;position: absolute;overflow: auto;}
    .resultForCollegeList > ul{text-align: left; font-size: 14px;}
    .resultForCollegeList > ul > li{padding: 10px 10px 10px 20px;border-bottom: 1px solid #afafaf;}
    .resultForCollegeList > ul > li:last-child{border-bottom: none;}
    .resultForCollegeList > ul > li > a {color: #172e51;font-size: 14px;font-weight: 700;}
    .resultForCollegeList > p{color: #7f7f80;font-size: 12px;font-weight: 600;margin-top: 10px;}
    @media screen and (max-width: 1279px){
        .resultForCollegeList {top:45px;width: 91%;}
    }
</style>
@endsection

<div class="preloader">
    <span class="preloader-spin"></span>
</div>

<div class="hero-slider">
    @foreach($sliderManager as $key => $item)
    <div class="single-slide" style="background-image: url(slider-image/{{$item->sliderImage}})" data-interval="500">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            @if(Session::has('checkEmailSucess'))
                            <div class="alert alert-success alert-dismissible" id="dialog" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3>{{ Session::get('checkEmailSucess') }}</h3>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            @if(Session::has('returnBackSignup'))
                            <div class="alert alert-danger alert-dismissible" id="dialog" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3>{{ Session::get('returnBackSignup') }}</h3>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-11 col-md-offset-1 text-center">
                        <div class="slide-content">
                            <h2 class="tab-hidden mobile-hidden">{{ $item->scrollerFirstText or 'Find Over' }}  
                                <a  style="color:#fff;" 
                                    href="" 
                                    class="typewrite" 
                                    data-period="2000" 
                                    data-type='[ 
                                        @if($item->isShowCollegeCount == 1) "{{$totalCollege}} Colleges", @endif 
                                        @if($item->isShowExamCount == 1) "{{$totalExamination}} Exams", @endif 
                                        @if($item->isShowCourseCount == 1) "{{$totalCourses}} Courses", @endif 
                                        @if($item->isShowBlogCount == 1) "{{$totalBlogs}} Blogs"  @endif
                                    ]'>
                                </a>
                                <span class="wrap"></span>
                                {{ $item->scrollerLastText or 'On Our Portal' }}
                            </h2>
                            <form method="GET" action="/search" id="searchForm">
                            <div class="header-search-container">
                                <input type="text" name="q" class="searchname" value="" placeholder="Search by Name - College/University/Courses/Degree/Stream/Country/State/City/Exams/Counselling/Jobs" id="header-search" style="font-size: 13px;">
                                <button class="searchbtn"><i class="fa fa-search"></i></button>
                                <div class="resultForCollegeList scroll hide">
                                    <ul class="list-unstyled padding-top10" style="font-size: 14px;">
                                        <li><a href="javascript:void(0);"></a></li>
                                    </ul>
                                </div>  
                            </div>
                            </form>
                            <!-- <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 searchbox">
                                    <form method="GET" action="/search" id="searchForm">
                                        <div class="searchblockheading">
                                            <div class="typeahead__container">
                                                <div class="typeahead__field">
                                                    <span class="typeahead__query">
                                                        <input class="js-typeahead-user_v2 form-control specialityBox textColorSelect" name="q" type="text" placeholder="Search by Name - College/University/Examination/Courses/Blogs/Degree/Stream/Career/News/Question/Country/State/City" autocomplete="off">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="searchbtn hide"></button>
                                    </form>
                                </div>            
                            </div> -->
                            <div class="header-bottom">
                                <p>{{ $item->bottomText}}  </p>
                                <a href="{{ $item->bottomLink}}" class="headerbtn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
    @endforeach               
</div>

@if(sizeof($getHomeBannerAds) > 0)
<div class="container margin-top30">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ $getHomeBannerAds[0]->redirectto }}" target="_blank" title="View Now">
                <!-- <div class="homePageAdd"></div> -->
                <img src="{{ asset('assets/ads-banner/'.$getHomeBannerAds[0]->img) }}" class="img-responsive img-thumbnail">
            </a>
        </div>
    </div>
</div>
@endif
@include('common-partials.ads-slider', ['addonClass' => 'container margin-top30', 'ads_position' => 'default'])

<!-- Explore Almost Everything Start -->
<div class="main-explore-section section sp bg-white">
    <div class="container">
        <div class="section-title">
            <h2>Explore Almost Everything</h2>          
        </div>
        <div class="row">
            @foreach($whatweoffer as $key => $item)
                <a href="{{ $item->pageurl }}" target="_blank">
                <div class="col-md-4 text-center">
                    <div class="single-box">
                        <img src="/whatweoffer/{{ $item->iconImage }}" alt="{{ $item->title }}">
                        <h3>{{ $item->title }}</h3>
                        <p class="mobile-hidden tab-hidden">{!! str_limit( $item->description, 120 ) !!}</p>
                    </div>
                </div>
                </a>
            @endforeach               
        </div>           
    </div>
</div>
<!-- End Explore Almost Everything -->

<!-- Top College of India Start -->
<div class="portfolio-area sp section featured-school bg-white">
    <div class="container">
        <div class="section-title">
            <h2>Top Featured College List</h2>          
        </div>
        <div class="row">
            @foreach($getCollegesInfoObj as $key => $item)
                {{--*/ 
                    $orientation = '';
                    $filenamePath = $item->logoImageName;
                    $filename = public_path().'/gallery/'.$item->slug.'/'.$item->logoImageName;
                    if (file_exists($filename)) {
                        list($width, $height) = getimagesize($filename);
                        //echo "width:-".$width; echo "<br>"; echo "height:- ".$height; echo "<br>";
                        if ($width > $height) {
                            $filenamePath = $item->logoImageName;
                            //echo "landscape mode";
                            $orientation  = ' background: #dcdcdc; height: 153px;  display: block; margin-left: auto; margin-right: auto; width: 50%;';
                        } else if ($width < $height) {
                            $filenamePath = $item->logoImageName;
                            //echo "portrait mode";
                            $orientation  = 'object-fit: contain; background: #dcdcdc; height: 153px; display: block; margin-left: auto; margin-right: auto; width: 50%;';
                        } else {
                            $orientation = ' background: #dcdcdc; height: 153px;  display: block; margin-left: auto; margin-right: auto; width: 50%;';
                            $filenamePath = $item->logoImageName;
                        }
                    }
                /*--}}
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        @if( $item->logoImageName != '' )
                            <img src="{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->logoImageName }}" alt="{{ $item->firstname}} logo" style="object-fit: contain; background: #fff; height: 153px; display: block; margin-left: auto; margin-right: auto; width: 100%;">
                        @else
                            <img src="assets/images/no-college-logo.png" alt="{{ $item->firstname}} logo">
                        @endif
                        <div class="hover-content">
                            <div>
                                <a href="{{ URL::to('/college', $item->slug) }}" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="{{ URL::to('/college', $item->slug) }}"><h3>{{ $item->firstname}}</h3></a>
                        <span>@if($item->cityName) {{ $item->cityName }}, {{ $item->stateName }} @endif</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row text-center" style="margin-top: 20px;">
            <div class="viewDetail">
                <a href="{{ URL::to('/top-colleges') }}">
                    View More 
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Top College of India -->

<!-- Top Courses Start -->
<div class="top-courses sp bgg section ">
    <div class="container">
        <div class="section-title white">
            <h2 class="text-dark">Top Courses</h2>
        </div>
        <ul>
            @foreach($topCousesList as $key => $item)
                <li><a href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->degreepageslug.'/'.$item->pageslug.'/colleges') }}">{{$item->name}}</a></li>
            @endforeach
            @foreach($topDegreeList as $key => $item)
                <li><a href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges') }}">{{$item->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<!-- End Top Courses -->

<!-- Study Abroad Start -->
<div class="brand-area section bg-white margin-top30" >
    <div class="container">
        <div class="section-title">
            <h2>Study Abroad</h2>
            <p>Interested in studying abroad? Choose a country</p>          
        </div>
        <div class="row">
            <div class="studyabroad">
                @foreach($studuAbroadObj as $key => $item)
                <a href="{{ URL::to('/'.$item->pageslug.'/college-list') }}">
                <div class="single-slide">
                    <div class="inner">
                        @if(!empty($item->logoimage))
                        <img class="rounded-x"  src="{{ asset('common-logo') }}/{{ $item->logoimage }}" alt="{{$item->name}} logo">
                        @else
                        <img class="rounded-x"  src="/assets/images/no-college-logo.jpg" alt="{{$item->name}} logo">
                        @endif
                        <p>{{$item->name}}</p>
                    </div>
                </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- End Study Abroad -->

<div class="top-courses sp bgg section ">
    <div class="container">
        <div class="section-title white">
            <h2 class="text-dark">Top Stream</h2>
        </div>
        <ul>
            @foreach($functionalareaList as $key => $item)
                <li><a href="{{ URL::to('/'.$item->pageslug.'/colleges') }}">{{$item->name}}</a></li>
            @endforeach
            @foreach($educationlevelCount as $key => $item)
                <li><a href="{{ URL::to('/'.$item->pageslug.'/colleges') }}">After - {{$item->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>


<!-- Latest Updates Start -->
<div class="testimonial-area sp section bg-white">
    <div class="container">
        <div class="section-title white">
            <h2 class="text-dark">Latest Updates</h2>
        </div>
        <div class="testimonial-slider latest-updates owl-theme">
            @foreach($latestUpdateObj as $key => $item)
            <div class="single-slide" style="min-height: 190px;">
                <div class="inner">
                    <p>{{$item->desc}}</p>
                    <span style="font-size: 12px;">{{$item->name}}</span>, <span style="font-size: 12px;">{{ date('F dS Y', strtotime($item->date)) }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row text-center" style="margin-top: 20px;">
            <div class="viewDetail">
                <a href="{{ URL::to('/latest-updates') }}">
                    View All Updates 
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Latest Updates -->
<div class="top-courses sp bgg section ">
    <div class="container">
        <div class="section-title white">
            <h2 class="text-dark">Top Exams </h2>
        </div>
        <ul>
            @foreach($listOfExaminationList as $key => $item)
                <li class="tooltips" data-toggle="tooltip" data-placement="top" title="{{ $item->name }} - {{ $item->exam_sections_name }}"><a href="{{ URL::to('/examination-details/'.$item->exam_sections_slug.'/'.$item->slug) }}" title="{{ $item->name }} - {{ $item->exam_sections_name }}">{{ $item->sortname }}</a></li>
            @endforeach
            @foreach($listOfExaminationSection as $key => $item)
                <li><a href="{{ URL::to('/examination-list/'.$item->slug) }}">{{$item->name}} - Exams</a></li>
            @endforeach
        </ul>
    </div>
</div>

{!! Html::script('new-assets/js/jquery-2.2.4.min.js') !!}
{!! Html::script('new-assets/js/owl.carousel.min.js') !!}
{!! Html::script('new-assets/js/slicknav.min.js') !!}
{!! Html::script('new-assets/js/active.js') !!}

<script type="text/javascript">
    //made by vipul mirajkar thevipulm.appspot.com
var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.10.6/jquery.typeahead.min.js" defer="defer"></script>
    <!-- <script type="text/javascript" src="new-assets/js/typeaheadquery-home-search.js" defer="defer"></script> -->
    <script type="text/javascript">
        $('.specialityBox').on('click',function(){
            $('.owl-dots').addClass('hide');
        });
        $(document).on("click", function(e){
            if( !$(".specialityBox").is(e.target) ){ 
                //if your box isn't the target of click, hide it
                $(".owl-dots").removeClass('hide');
            }
        });
    </script>
    <style type="text/css">
        .dropdownhover .bg_colorchange{ background:#ff0 !important; opacity:0.5 !important; }
    </style>
    {{-- <script>
        $(".dropdownhover").hover(
          function () {
            $(".hero-slider .single-slide").addClass("bg_colorchange");
          },
          function () {
            $(".hero-slider .single-slide").removeClass("bg_colorchange");
          }
        );
    </script> --}}

    <script type="text/javascript">
        $(document).ready(function(){
            $("#Divtwo").hover(function(){
                $(this).removeClass("Mydivremove");
            });
        });
        // $('.searchbtn').on('click',function(){
        //     var pathname        = window.location.pathname;
        //     var search          = $(".searchname").val();
        //     if (search != "") {
        //         var replaced        = search.replace(/\s+/g, " ");
        //         pathname+"search?q="+replaced;
        //     }else{
        //         pathname = "/search";
        //     }
        //     window.location     = pathname;
        // });
    </script>

{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.filter-page-search-partial')
@endsection

