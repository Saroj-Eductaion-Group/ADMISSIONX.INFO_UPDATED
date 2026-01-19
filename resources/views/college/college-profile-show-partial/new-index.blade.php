@extends('website/new-design-layouts.master')

@section('styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style type="text/css">
    .logoimage{object-fit: contain; background: #fff; height: 153px; display: block; margin-left: auto; margin-right: auto; width: 100%;}
    .table tr td{ border:unset !important; background-color:unset !important; border:unset !important; padding:unset !important; line-height:unset !important; }
    .single .table td, .single .table th {padding: .35rem .65rem !important; vertical-align: top !important;border-top: 1px solid #e9ecef !important;}
    .clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
    .wrapper{ position:relative;margin:0 auto;overflow:hidden;height:43px;}
    .list {position:absolute;left:0px;top:0px;min-width:3000px;margin-left:12px;margin-top:0px;}
    .list li{display:table-cell;position:relative;text-align:center;cursor:grab;cursor:-webkit-grab;color:#efefef;vertical-align:middle;}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: #fff; cursor: default; background-color: #d40d12; border: 1px solid #ddd; border-bottom-color: transparent;}
    .scroller {text-align:center;cursor:pointer;display:none;padding:7px;padding-top:11px;white-space:no-wrap;vertical-align:middle;background-color:#fff;}
    .scroller-right{float:right;}
    .scroller-left {float:left;}

    .rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
    .rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
    .rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
    .rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
{!! Html::style('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.css') !!}
{!! Html::style('home-layout/assets/css/pages/blog_masonry_3col.css') !!}
<style type="text/css">
    .blockOnGalleryImg{  height: 180px;   max-height: 180px;    background-repeat: no-repeat;   background-size: cover;   background-position: center;    border-radius: 4px 4px 0 0;    border: 1px solid #dfdfdf;    margin: 5px;     }
    .visibilityHiddenBlock{visibility: hidden !important;}
    .blockOnAttachmentImg{height: 60px;width: 60px;background-size: contain;background-position: center;background-color: #f9f9f9;border-radius: 10px;}
</style>

<style>
    .scrolling-wrapper {overflow-x: scroll;  overflow-y: hidden;  white-space: nowrap;}
    .cardMobile {display: inline-block;}
    .cardMobile {width: auto; margin: 5px; border: 1px solid #ccc;} 
    .cardMobile img {max-width: 100%;}
    .cardMobile .text {padding: 5px 5px 0px 5px;text-align: center;}
    .cardMobile .text > button {background: gray;border: 0;color: white;padding: 10px;width: 100%;}
</style>
@endsection

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
{!! Html::style('/new-assets/css/main.css') !!}

<div class="preloader">
    <span class="preloader-spin"></span>
</div>
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
<div class="single-listing-school-template single">
    @include('college.college-new-public-partial.profile-breadcum-partial')
    <div class="featured-school-single">
        <div class="container">
            @include('college.college-new-public-partial.profile-logo-banner-partial')
            <div class="school-info section">
                <div class="section-title">
                    <div class="row">
                        @if($agent->isMobile())
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 text-center hidden-lg hidden-md">
                            <div class="scrolling-wrapper">
                                <div class="cardMobile">
                                    <a href="#information" aria-controls="information" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Overview</p>
                                        </div>
                                    </a>
                                </div>
                                @if( sizeof($fetchCollegeManagementList) > 0 )
                                <div class="cardMobile">
                                    <a href="#management-info" aria-controls="management-info" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Management Info</p>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @if( sizeof($fetchCollegeCoursesObj) > 0 )
                                <div class="cardMobile">
                                    <a href="#courses" aria-controls="courses" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Course</p>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                <div class="cardMobile">
                                    <a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Photo/Videos/Achievements</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="cardMobile">
                                    <a href="{{ url('/college/'.$slugUrl.'/faculty') }}" target="_blank">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Our Faculties</p>
                                        </div>
                                    </a>
                                </div>
                                @if( sizeof($collegeFacilityDataObj) > 0 )
                                <div class="cardMobile">
                                    <a href="#facilities" aria-controls="facilities" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Facilities</p>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @if( sizeof($getCollegeEvents) > 0 )
                                <div class="cardMobile">
                                    <a href="#events" aria-controls="events" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Events</p>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @if( sizeof($collegeScholarshipsObj) > 0 )
                                <div class="cardMobile">
                                    <a href="#scholarship" aria-controls="scholarship" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Scholarship</p>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @if( sizeof($collegePlacementDataObj) > 0 )
                                <div class="cardMobile">
                                    <a href="#placements" aria-controls="placements" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Placements</p>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @if( sizeof($collegeCutOffsObj) > 0 )
                                <div class="cardMobile">
                                    <a href="#cut-offs" aria-controls="cut-offs" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Cut Offs</p>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                <div class="cardMobile">
                                    <a href="{{ url('/college/'.$slugUrl.'/admission-procedure') }}" target="_blank">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Our Admission Procedure</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="cardMobile">
                                    <a href="{{ url('/college/'.$slugUrl.'/reviews') }}" target="_blank">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Our Reviews</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="cardMobile">
                                    <a href="{{ url('/college/'.$slugUrl.'/faqs') }}" target="_blank">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Our College FAQs</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="cardMobile">
                                    <a href="#help-desk" aria-controls="help-desk" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Help Desk</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="cardMobile">
                                    <a href="#social-widget" aria-controls="social-widget" role="tab" data-toggle="tab">
                                        <div class="text">
                                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Social Widget</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($agent->isDesktop() || $agent->isTablet())
                        <div class="col-md-12">
                            <div class="scroller scroller-left"><i class="glyphicon glyphicon-chevron-left"></i></div>
                            <div class="scroller scroller-right"><i class="glyphicon glyphicon-chevron-right"></i></div>
                            <div class="wrapper">
                                <ul class="nav nav-tabs list" id="myTab">
                                    <li role="information" class="item active">
                                        <a href="#information" aria-controls="information" role="tab" data-toggle="tab"><span>Overview</span></a>
                                    </li>
                                    @if( sizeof($fetchCollegeManagementList) > 0 )
                                    <li class="item" role="management-info">
                                        <a href="#management-info" aria-controls="management-info" role="tab" data-toggle="tab"><span>Management Info</span></a>
                                    </li>
                                    @endif
                                    @if( sizeof($fetchCollegeCoursesObj) > 0 )
                                    <li class="item" role="courses">
                                        <a href="#courses" aria-controls="courses" role="tab" data-toggle="tab"><span>Course</span></a>
                                    </li>
                                    @endif
                                    <li class="item" role="gallery">
                                        <a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab"><span>Photo/Videos/Achievements</span></a>
                                    </li>

                                    <li class="item" role="our-faculties">
                                        <a href="{{ url('/college/'.$slugUrl.'/faculty') }}" target="_blank"><span>Our Faculties</span></a>
                                    </li>

                                    @if( sizeof($collegeFacilityDataObj) > 0 )
                                    <li class="item" role="facilities">
                                        <a href="#facilities" aria-controls="facilities" role="tab" data-toggle="tab"><span>Facilities</span></a>
                                    </li>
                                    @endif
                                    @if( sizeof($getCollegeEvents) > 0 )
                                    <li class="item" role="events">
                                        <a href="#events" aria-controls="events" role="tab" data-toggle="tab"><span>Events</span></a>
                                    </li>
                                    @endif
                                    @if( sizeof($collegeScholarshipsObj) > 0 )
                                    <li class="item" role="scholarship">
                                        <a href="#scholarship" aria-controls="scholarship" role="tab" data-toggle="tab"><span>Scholarship</span></a>
                                    </li>
                                    @endif
                                    @if( sizeof($collegePlacementDataObj) > 0 )
                                    <li class="item" role="placements">
                                        <a href="#placements" aria-controls="placements" role="tab" data-toggle="tab"><span>Placements</span></a>
                                    </li>
                                    @endif
                                    @if( sizeof($collegeCutOffsObj) > 0 )
                                    <li class="item" role="cut-offs">
                                        <a href="#cut-offs" aria-controls="cut-offs" role="tab" data-toggle="tab"><span>Cut Offs</span></a>
                                    </li>
                                    @endif
                                    <li class="item" role="admission-procedure">
                                        <a href="{{ url('/college/'.$slugUrl.'/admission-procedure') }}" target="_blank"><span>Our Admission Procedure</span></a>
                                    </li>
                                    <li class="item" role="our-faculties">
                                        <a href="{{ url('/college/'.$slugUrl.'/reviews') }}" target="_blank"><span>Our Reviews</span></a>
                                    </li>
                                    <li class="item" role="college-faqs">
                                        <a href="{{ url('/college/'.$slugUrl.'/faqs') }}" target="_blank"><span>Our College FAQs</span></a>
                                    </li>
                                    <li class="item" role="help-desk">
                                        <a href="#help-desk" aria-controls="help-desk" role="tab" data-toggle="tab"><span>Help Desk</span></a>
                                    </li>
                                    <li class="item" role="social-widget">
                                        <a href="#social-widget" aria-controls="social-widget" role="tab" data-toggle="tab"><span>Social Widget</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @if(Session::has('collegeQueryForm'))
                <div class="alert alert-success  text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ Session::get('collegeQueryForm') }}</strong>
                </div>
                @endif
            </div>
            <div class="tab-content margin-bottom30">
                <div role="tabpanel" class="tab-pane active" id="information">
                    @include('college.college-new-public-partial.profile-partials')
                </div>
                @if( sizeof($fetchCollegeManagementList) > 0 )
                <div role="tabpanel" class="tab-pane" id="management-info">
                    @include('college.college-new-public-partial.management-list-partials')
                </div>
                @endif
                <div role="tabpanel" class="tab-pane" id="gallery">
                    @include('college.college-new-public-partial.gallery-partial')
                </div>
                @if( sizeof($fetchCollegeCoursesObj) > 0 )
                <div role="tabpanel" class="tab-pane" id="courses">
                    @include('college.college-new-public-partial.courses-list-partial')
                </div>
                @endif

                @if( sizeof($collegeFacilityDataObj) > 0 )
                <div role="tabpanel" class="tab-pane" id="facilities">
                    @include('college.college-new-public-partial.facilities-partial')
                </div>
                @endif
                @if( sizeof($getCollegeEvents) > 0 )
                <div role="tabpanel" class="tab-pane" id="events">
                    @include('college.college-new-public-partial.event-partial')
                </div>
                @endif

                @if( sizeof($collegeScholarshipsObj) > 0 )
                <div role="tabpanel" class="tab-pane" id="scholarship">
                    @include('college.college-new-public-partial.scholarship-partial')
                </div>
                @endif
                @if( sizeof($collegePlacementDataObj) > 0 )
                <div role="tabpanel" class="tab-pane" id="placements">
                    @include('college.college-new-public-partial.placements-partial')
                </div>
                @endif
                @if( sizeof($collegeCutOffsObj) > 0 )
                <div role="tabpanel" class="tab-pane" id="cut-offs">
                    @include('college.college-new-public-partial.cutoffs-partial')
                </div>
                @endif

                @if( sizeof($getCollegeDetailObj) > 0 )
                <div role="tabpanel" class="tab-pane" id="social-widget">
                    @include('college.college-new-public-partial.social-widget-partial')
                </div>
                <div role="tabpanel" class="tab-pane" id="help-desk">
                    @include('college.college-new-public-partial.college-help-desk-partial')
                </div>
                <hr class="hr-gap">
                @endif
            </div>

            @if(sizeof($getCollegeDetailBannerAds) > 0)
            <div class="margin-top20">
                <a href="{{ $getCollegeDetailBannerAds[0]->redirectto }}" target="_blank" title="View Now">
                    <img src="{{ asset('assets/ads-banner/'.$getCollegeDetailBannerAds[0]->img) }}" class="img-responsive img-thumbnail">
                </a>
            </div>
            @endif
            @include('common-partials.ads-slider', ['addonClass' => 'margin-top20 margin-bottom20', 'ads_position' => 'default'])
        </div>  
    </div>
</div>


{!! Html::script('/new-assets/js/jquery-2.2.4.min.js') !!}
{!! Html::script('/new-assets/js/owl.carousel.min.js') !!}
{!! Html::script('/new-assets/js/slicknav.min.js') !!}
{!! Html::script('/new-assets/js/active.js') !!}
{!! Html::script('assets/administrator/js/jquery-2.1.1.js') !!}
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
{!! Html::script('home-layout/assets/js/plugins/fancy-box.js') !!}

{!! Html::script('home-layout/assets/plugins/masonry/jquery.masonry.min.js') !!}
{!! Html::script('home-layout/assets/js/pages/blog-masonry.js') !!}


<script type="text/javascript">
    jQuery(document).ready(function() {
        FancyBox.initFancybox();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        if ($('#firstAddressHere').text() === $('#secondAddressHere').text()){
            $("#combinedAddress").text($('#firstAddressHere').text());
            $("#combinedAddress").removeClass('hide');
            $('#redAdd').addClass('hide');
            $('#camAdd').addClass('hide');
        }else{
            $("#combinedAddress").addClass('hide');
            $('#redAdd').removeClass('hide');
            $('#camAdd').removeClass('hide');
        }
    });
    
</script>
<script type="text/javascript">
    $(document).ready(function(){
        
        if ($('.minimizeRegiAddress').text() === $('.minimizeCampusAddress').text()){
            $("#combinedAddress").text($('.minimizeRegiAddress').text());
            $("#combinedAddress").removeClass('hide');
            $('#redAdd').addClass('hide');
            $('#camAdd').addClass('hide');
        }else{
            $("#combinedAddress").addClass('hide');
            $('#redAdd').removeClass('hide');
            $('#camAdd').removeClass('hide');
        }

    });
    
</script>
<script type="text/javascript">
    var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 0) return;
        
        $(this).html(
            t.slice(0,0)+'<span></span><a href="#" class="more">View</a>'+
            '<span style="display:none; word-break: break-all !important;">'+ t.slice(0,t.length)+'<br><a href="#" class="less">Hide</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
    $('.parent-container-images').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            // options for gallery
            enabled: true
        },
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it
            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
</script>
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
// POST YOUR QUESTION AND THEN OPEN LOGIN FORM
$( '.checkLoginStatusFormSubmit' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ($(this).parsley().isValid()) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/college-helpdesk') }}",
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
<script type="text/javascript">
    $(function(){
      var hash = window.location.hash;
      hash && $('ul.nav a[href="' + hash + '"]').tab('show');

      $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
      });
    });
</script>   
<script type="text/javascript">
    var hidWidth;
    var scrollBarWidths = 40;

    var widthOfList = function(){
        var itemsWidth = 0;
        $('.list li').each(function(){
            var itemWidth = $(this).outerWidth();
            itemsWidth+=itemWidth;
        });
        return itemsWidth;
    };

    var widthOfHidden = function(){
        return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
    };

    var getLeftPosi = function(){
        return $('.list').position().left;
    };

    var reAdjust = function(){
        if (($('.wrapper').outerWidth()) < widthOfList()) {
            $('.scroller-right').show();
        }else {
            $('.scroller-right').hide();
        }
      
        if (getLeftPosi()<0) {
            $('.scroller-left').show();
        }else {
            $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
                $('.scroller-left').hide();
        }
    }

    reAdjust();

    $(window).on('resize',function(e){  
        reAdjust();
    });

    $('.scroller-right').click(function() {
        $('.scroller-left').fadeIn('slow');
        $('.scroller-right').fadeOut('slow');
        $('.list').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){

        });
    });

    $('.scroller-left').click(function() {
        $('.scroller-right').fadeIn('slow');
        $('.scroller-left').fadeOut('slow');
        $('.list').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){

        });
    });  
    $('.collegeProfileApplyNowBtn').click(function() {
        //window.location.reload();
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = '#courses';
        $('html,body').scrollTop(scrollmem);
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
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=801030516664134";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


@endsection


