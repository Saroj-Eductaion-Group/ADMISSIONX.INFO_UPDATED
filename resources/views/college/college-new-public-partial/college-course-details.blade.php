@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Faculty
@endsection

@section('styles')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
{!! Html::style('home-layout/assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    {!! Html::style('home-layout/assets/css/pages/profile.css') !!}
    <style type="text/css">
    .rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
    .rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
    .rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
    .rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
    </style>
    <style type="text/css">
    /*.wrapper{background: #f9f9f9;}
    .whiteBackround{background: #FFFFFF;}
    /* text-based popup styling */
    .white-popup {
      position: relative;
      background: #FFF;
      padding: 25px;
      width: auto;
      max-width: 800px;
      margin: 0 auto;
    }

    /* 

    ====== Zoom effect ======

    */
    .mfp-zoom-in {
      /* start state */
      /* animate in */
      /* animate out */
    }
    .mfp-zoom-in .mfp-with-anim {
      opacity: 0;
      transition: all 0.2s ease-in-out;
      transform: scale(0.8);
    }
    .mfp-zoom-in.mfp-bg {
      opacity: 0;
      transition: all 0.3s ease-out;
    }
    .mfp-zoom-in.mfp-ready .mfp-with-anim {
      opacity: 1;
      transform: scale(1);
    }
    .mfp-zoom-in.mfp-ready.mfp-bg {
      opacity: 0.8;
    }
    .mfp-zoom-in.mfp-removing .mfp-with-anim {
      transform: scale(0.8);
      opacity: 0;
    }
    .mfp-zoom-in.mfp-removing.mfp-bg {
      opacity: 0;
    }

    .course-details { color: #000; }
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
            <div class="col-md-12 text-right"><a href="{{ URL::to('college/'.$slugUrl) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
            <div class="col-md-12">
                <div class="profile-body">                  
                    <div class="profile-bio">
                        <div class="row">
                            <div class="col-md-9">
                                <h2>{!! App\Models\CollegeProfile::getCollegeName($slugUrl) !!}</h2>
                                <span><strong>Course Details</strong></span>
                            </div>              
                        </div>
                        <div class="row">
                            <div class="col-md-12"><p class="text-info margin-top10 margin-bottom10"><i class="fa fa-calendar" aria-hidden="true"></i> Session Start Date will update soon by college</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if( $getCollegeMasterCoursesObj )
                                    @foreach( $getCollegeMasterCoursesObj as $item )
                                    <span><strong>Course Fee (per year):</strong> Rs. {{ $item->fees }}</span>
                                    <span><strong>Last Date for Documents Verification:</strong> Will update soon by college</span>
                                    <!-- <span><strong>Seats Availbe:</strong> {{ $item->seats }}</span> -->
                                    <!-- <span><strong>Seats Availbe at Admission X:</strong> {{ $item->seatsallocatedtobya }}</span> -->
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if( $getCollegeMasterCoursesObj )
                                    @foreach( $getCollegeMasterCoursesObj as $item )
                                    @if( !empty($item->twelvemarks) )
                                    <span><strong>Mini. 12th Marks:</strong> {{ $item->twelvemarks }}</span>
                                    @endif
                                    @if( !empty($item->others) )
                                    <span><strong>Others Course Eligibility :</strong> {{ $item->others }}</span>
                                    @endif                                      
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="hr-gap">
                    <div class="detail-page-signup margin-bottom40 table-responsive">
                        <div class="headline"><h2>Course Information & Faculty Information</h2></div>
                        <div class="row rating_reviews_info">
                            <!--Social Icons v3-->
                            <div class="col-sm-6 sm-margin-bottom-30">
                                <div class="panel panel-profile">
                                    <div class="panel-heading overflow-h">
                                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-info"></i> Course Information</h2>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled social-contacts-v2">
                                            @if( $getCollegeMasterCoursesObj )
                                                @foreach( $getCollegeMasterCoursesObj as $item )
                                                    @if($item->courseduration)
                                                    <li>Duration : <a href="javascript:void(0);">
                                                    @if($item->courseduration)
                                                            @if(is_numeric($item->courseduration))
                                                                @if( $item->courseduration == '1' )
                                                                    {{ $item->courseduration }} Year
                                                                @else
                                                                    {{ $item->courseduration }} Years
                                                                @endif
                                                            @else
                                                                {{ $item->courseduration }}
                                                            @endif
                                                        @else
                                                            <span class="label label-warning">Not Updated Yet</span>
                                                        @endif
                                                    </a></li>
                                                    @endif  

                                                    @if($item->functionalareaName)
                                                    <li>Stream : <a href="javascript:void(0);">{{ $item->functionalareaName }}</a></li>
                                                    @endif                                                  
                                                    
                                                    @if($item->educationlevelName)
                                                    <li>Degree Level : <a href="javascript:void(0);">{{ $item->educationlevelName }}</a></li>
                                                    @endif

                                                    @if($item->degreeName)
                                                    <li>Degree : <a href="javascript:void(0);">{{ $item->degreeName }}</a></li>
                                                    @endif                                                  
                                                    
                                                    @if($item->courseName)
                                                    <li>Course : <a href="javascript:void(0);">{{ $item->courseName }}</a></li>
                                                    @endif

                                                    @if($item->coursetypeName)
                                                    <li>Course Type : <a href="javascript:void(0);">{{ $item->coursetypeName }}</a></li>
                                                    @endif

                                                    @if($item->courseDescription)
                                                    <li>Description : <span class="courseDescription">{{ $item->courseDescription }}</span></p>
                                                    @endif
                                                @endforeach
                                            @endif                          
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--End Social Icons v3-->

                            <!--Skills-->
                            <div class="col-sm-6 sm-margin-bottom-30">
                                <div class="panel panel-profile">
                                    <div class="panel-heading overflow-h">
                                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-graduation-cap"></i> Faculty Information</h2>
                                    </div>
                                    <div class="panel-body">
                                        @if(sizeof($getCollegeMasterFacultyObj) > 0)
                                            <div class="panel panel-profile">
                                                <div id="scrollbar3" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
                                                    @foreach( $getCollegeMasterFacultyObj as $item )
                                                        @if( !empty($item->name)  )
                                                        <div class="alert-blocks alert-dismissable">
                                                            <div class="overflow-h">
                                                                @if(!empty($item->imagename))
                                                                    <img class="img-circle" src="{{ asset('gallery'.'/'.$slugUrl.'/'.$item->imagename) }}" width="120" height="120">
                                                                @else
                                                                    <img src="/assets/images/no-college-logo.jpg" width="120" height="120">
                                                                @endif 
                                                                <strong class="color-dark">{{ $item->suffix }} {{ $item->name }} </strong><br>
                                                                <strong class="color-dark">Designation : {{ $item->designation }} </strong>
                                                                <p>{!! $item->description !!}</p>
                                                                @if(Auth::check()) 
                                                                    @if((Auth::user()->userrole_id == 2) && ($item->users_id == Auth::id()))
                                                                    <p class="pull-right"><a href="{{ url('college/faculty/') }}/{{ $slugUrl}}/{{ $item->id }}" class="btn btn-xs btn-info">View Faculty Details</a></p>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach                                                     
                                                </div>
                                            </div>
                                        @else
                                            <p>No Faculty listed.</p>
                                        @endif
                                                                                
                                    </div>
                                </div>
                            </div>
                            <!--End Skills-->
                            <div class="col-md-4 col-md-offset-4 margin-top20 margin-bottom20">
                                @if( $getCollegeMasterCoursesObj )
                                    @foreach( $getCollegeMasterCoursesObj as $item )
                                    <a class="btn-u btn-block" href="{{ url('student/apply-course-details/') }}/{{ $item->collegemasterId }}/{{ $item->slug }}" >Admission</a>
                                    <!-- <a class="btn-u btn-block" href="{{ url('student/apply-course-details/') }}/{{ $item->collegemasterId }}/{{ $slugUrl }}" >Book</a> -->
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>      
@endsection

@section('scripts')
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('home-layout/assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js') !!}

<script type="text/javascript">
    jQuery(document).ready(function() {
        App.initScrollBar();            
    });
</script>
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