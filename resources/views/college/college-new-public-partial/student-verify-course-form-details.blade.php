@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Faculty
@endsection

@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    {!! Html::style('home-layout/assets/css/pages/profile.css') !!}
    <style type="text/css">
    .rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
    .rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
    .rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
    .rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
    </style>
    {!! Html::style('home-layout/assets/css/pages/profile.css') !!}
    {!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <!-- {!! Html::style('/new-assets/css/plugins/datapicker/datepicker3.css') !!}
    {!! Html::style('/new-assets/css/plugins/daterangepicker/daterangepicker-bs3.css') !!} -->
    <style type="text/css">
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
        .text-danger {
            color: #f34a4e !important;
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
                        <div class="headline"><h2>Course Information</h2></div>
                        <div class="row rating_reviews_info">
                            <!--Social Icons v3-->
                            <div class="col-sm-12 sm-margin-bottom-30">
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

                            <div class="row">
                                {!! Form::model($studentApplyCourseDataObj , ['url' => 'student-course-apply-details', 'method' => 'POST', 'class' => 'form-horizontal profileUpdateNow','data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!} <!-- 'data-parsley-validate' => '' -->
                                <input type="hidden" name="studentSlug" value="{{ $studentSlug }}">
                                <input type="hidden" name="courseMasterID" value="{{ $collegemasterId }}">
                                <input type="hidden" name="collegeProfileID" value="{{ $slugUrl }}">

                                <input type="hidden" name="totalfees" value="@if( $collegeProfileObj ){{ $collegeProfileObj->courseFee }} @endif">
                                {{--*/ $totalAmt = $collegeProfileObj->courseFee;  /*--}}
                                <?php /* <!-- <input type="hidden" name="byafees" value="{{ 10/100*($totalAmt)  }}">
                                <input type="hidden" name="restfees" value="{{ 90/100*($totalAmt)  }}"> --> */ ?>
                                <input type="hidden" name="byafees" value="{{ $byafees }}">
                                <input type="hidden" name="restfees" value="{{ $totalAmt-$byafees  }}">

                                <div class="col-md-12">
                                    <div class="profile-body">
                                        <div class="profile-bio">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Book Admission</h2>                                 
                                                </div>                      
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span>
                                                        <strong>College Annual Fee:</strong> 
                                                        Rs. @if( $collegeProfileObj ){{ $collegeProfileObj->courseFee }}/- @endif
                                                    </span>
                                                    <span>
                                                        <strong>Amount Payable with the application:</strong>
                                                        Rs. {{ $byafees }}/-
                                                       <?php /* <!-- Rs. {{ 10/100*($totalAmt)  }}/- --> */ ?>
                                                    </span>
                                                    <span>
                                                        <strong>Remaining Amount Payable at college:</strong>
                                                        Rs. {{ $totalAmt-$byafees  }}/-
                                                        <?php /* <!-- Rs. {{ 90/100*($totalAmt)  }}/- --> */ ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6 sm-margin-bottom-30">
                                                <div class="panel panel-profile">
                                                    <div class="panel-heading overflow-h">
                                                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-info"></i> Basic Information</h2>
                                                    </div>
                                                    <div class="panel-body">
                                                        @if( $studentApplyCourseDataObj )
                                                            @foreach(  $studentApplyCourseDataObj as  $item )
                                                                <ul class="list-unstyled social-contacts-v2">
                                                                    <li class="margin-bottom-10">First Name<input type="text" class="form-control" name="firstname" value="{{ $item->firstName }}" required="" placeholder="Enter first name here" readonly=""></li>

                                                                    <li class="margin-bottom-10">Middle Name<input type="text" class="form-control" name="middlename" value="{{ $item->middleName }}" placeholder="Enter middle name here" readonly=""></li>

                                                                    <li class="margin-bottom-10">Last Name<input type="text" class="form-control" name="lastname" value="{{ $item->lastName }}" placeholder="Enter last name here" readonly=""></li>

                                                                    <li class="margin-bottom-10"><p class="text-info">For updating your details please click to <a href="/student/dashboard/edit/{{ $studentSlug }}#accountsetting">Dashboard > Account Settings</a></p></li>
                                                                    <li class="margin-bottom-10">I am 
                                                                        @if(!empty($item->gender))
                                                                        <input type="text" class="form-control" name="gender" value="{{ $item->gender }}" placeholder="Enter gender here" readonly="">
                                                                        @else
                                                                        <select class="form-control" name="gender" required="" data-parsley-trigger="change" data-parsley-error-message="Please select gender">
                                                                            <option disabled="" selected="">Select Gender</option>
                                                                            @if( $item->gender == 'Male' )
                                                                                <option value="{{ $item->gender }}">{{ $item->gender }}</option>
                                                                                <option value="Female">Female</option>
                                                                            @elseif( $item->gender == 'Female' )
                                                                                <option value="{{ $item->gender }}">{{ $item->gender }}</option>
                                                                                <option value="Female">Male</option>
                                                                            @else
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                            @endif
                                                                        </select>
                                                                        @endif
                                                                    </li>
                                                                    <li class="margin-bottom-10">
                                                                        Date of Birth<input type="date" id="dateChange" class="form-control" name="dateofbirth" value="{{ $item->dateofbirth }}" @if(!empty($item->dateofbirth) && ($item->dateofbirth != "0000-00-00")) readonly="" @else required="" data-parsley-trigger="change" data-parsley-error-message="Please select valid date of birth" @endif>
                                                                        <label class="text-primary">Age as on {!! date('d-m-Y') !!} : </label>
                                                                        <label class="text-primary calculatedDateFromNow">{{ $calculateDate }}</label>
                                                                    </li>
                                                                    <li class="margin-bottom-10">Email Address<input type="text" class="form-control" name="email" value="{{ $item->userEmailAddress }}" placeholder="Enter email address here" data-parsley-type="email"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" @if(!empty($item->userEmailAddress)) readonly="" @else data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" @endif ></li>
                                                                    <li class="margin-bottom-10">Phone<input type="text" class="form-control" name="phone" value="{{ $item->userPhone }}" placeholder="Enter mobile number here" data-parsley-type="digits"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid mobile number" @if(!empty($item->userPhone)) readonly="" @else required="" data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10, 10]" maxlength="10" @endif></li><!-- data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10, 10]" maxlength="10"-->
                                                                </ul>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 sm-margin-bottom-30">
                                                <div class="panel panel-profile">
                                                    <div class="panel-heading overflow-h">
                                                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-graduation-cap"></i> Acedemic Information</h2>
                                                    </div>
                                                    <div class="panel-body">
                                                        <ul class="list-unstyled social-contacts-v2">
                                                                <!-- <li class="margin-bottom-10">
                                                                    Class 10th Percentage
                                                                    {{--*/ $Percent10 = ''; /*--}}
                                                                    @if( $getStudent10thmarksObj )
                                                                        @foreach(  $getStudent10thmarksObj as  $item )
                                                                            @if( $item->marksName == '10th' )
                                                                                {{--*/  $Percent10 = $item->percentage /*--}}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    <input type="text" class="form-control" name="tenthMarksPercentage" value="{{ $Percent10 }}" placeholder="Enter 10th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 10th percentage here" data-parsley-type="digits" data-parsley-length ="[2, 3]" data-parsley-minlength="1" data-parsley-maxlength="3" maxlength="3" data-parsley-max="100">
                                                                </li> -->
                                                            <li class="margin-bottom-10">
                                                                Class 10th Percentage
                                                                @if( $getStudent10thmarksObj )
                                                                    @foreach(  $getStudent10thmarksObj as  $student10thMarksData )
                                                                        @if( $student10thMarksData->marksName == '10th' )
                                                                            @if(empty($student10thMarksData->percentage))
                                                                            <select class="form-control" name="tenthMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 10th percentage" required="">
                                                                                <option value="" disabled="" selected="">Please Select 10th Percentage</option>
                                                                                {{--*/ $Percent10 = '1' /*--}}
                                                                                @for( $Percent10 = '1'; $Percent10 < '101'; $Percent10++ )
                                                                                    @if( $student10thMarksData->percentage == $Percent10 )
                                                                                        <option value="{{ $Percent10 }}" selected="">{{ $Percent10 }}%</option>
                                                                                    @else
                                                                                        <option value="{{ $Percent10 }}">{{ $Percent10 }}%</option>
                                                                                    @endif
                                                                                @endfor
                                                                            </select> 
                                                                            @else
                                                                            <input type="text" class="form-control" name="tenthMarksPercentage" value="{{ $student10thMarksData->percentage }}"  placeholder="Enter percentage here" readonly="">
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <select class="form-control" name="tenthMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 10th percentage" required="">
                                                                        <option value="" disabled="" selected="">Please Select 10th Percentage</option>
                                                                        {{--*/ $Percent10 = '1' /*--}}
                                                                        @for( $Percent10 = '1'; $Percent10 < '101'; $Percent10++ )
                                                                            <option value="{{ $Percent10 }}">{{ $Percent10 }}%</option>
                                                                        @endfor
                                                                    </select>
                                                                @endif                                          
                                                            </li>
                                                            <li class="margin-bottom-10">Class 10th Mark sheet
                                                                <a href="javascript:void(0);" class="removeTabAction hide" id="remove1"><i class="fa fa-remove"></i></a>
                                                                <input type="file" class="form-control" name="tenMarksheet">
                                                                <p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
                                                            </li>
                                                            <!-- <li class="margin-bottom-10">
                                                            Class 11th Percentage
                                                                {{--*/ $Percent11 = ''; /*--}}
                                                                @if( $getStudent11thmarksObj )
                                                                    @foreach(  $getStudent11thmarksObj as  $item )
                                                                        @if( $item->marksName == '11th' )
                                                                            {{--*/  $Percent11 = $item->percentage /*--}}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                <input type="text" class="form-control" name="eleventhMarksPercentage" value="{{ $Percent11 }}" placeholder="Enter 11th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 11th percentage here" data-parsley-type="digits" data-parsley-length ="[2, 3]" data-parsley-minlength="1" data-parsley-maxlength="3" maxlength="3" data-parsley-max="100">
                                                            </li> -->

                                                            <li class="margin-bottom-10">
                                                                Class 11th Percentage
                                                                @if( $getStudent11thmarksObj )
                                                                    @foreach(  $getStudent11thmarksObj as $student11thMarksData )
                                                                        @if( $student11thMarksData->marksName == '11th' )
                                                                            @if(empty($student11thMarksData->percentage))
                                                                            <select class="form-control" name="eleventhMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 11th percentage" required="">
                                                                                <option value="" disabled="" selected="">Please Select 11th Percentage</option>
                                                                                {{--*/ $Percent11 = '1' /*--}}
                                                                                @for( $Percent11 = '1'; $Percent11 < '101'; $Percent11++ )
                                                                                    @if( $student11thMarksData->percentage == $Percent11 )
                                                                                        <option value="{{ $Percent11 }}" selected="">{{ $Percent11 }}%</option>
                                                                                    @else
                                                                                        <option value="{{ $Percent11 }}">{{ $Percent11 }}%</option>
                                                                                    @endif
                                                                                @endfor
                                                                            </select>
                                                                            @else
                                                                            <input type="text" class="form-control" name="eleventhMarksPercentage" value="{{ $student11thMarksData->percentage }}"  placeholder="Enter percentage here" readonly="">
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <select class="form-control" name="eleventhMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 11th percentage" required="">
                                                                        <option value="" disabled="" selected="">Please Select 11th Percentage</option>
                                                                        {{--*/ $Percent11 = '1' /*--}}
                                                                        @for( $Percent11 = '1'; $Percent11 < '101'; $Percent11++ )
                                                                            <option value="{{ $Percent11 }}">{{ $Percent11 }}%</option>
                                                                        @endfor
                                                                    </select>
                                                                @endif
                                                            </li>
                                                            <li class="margin-bottom-10">Class 11th Mark sheet
                                                                <a href="javascript:void(0);" class="removeTabAction hide" id="remove2"><i class="fa fa-remove"></i></a>
                                                                <input type="file" class="form-control" name="elevenMarksheet">
                                                                <p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
                                                            </li>
                                                            <!-- <li class="margin-bottom-10">Class 12th Percentage
                                                            {{--*/ $Percent12 = ''; /*--}}
                                                                @if( $getStudent12thmarksObj )
                                                                    @foreach(  $getStudent12thmarksObj as  $item )
                                                                        @if( $item->marksName == '12th' )
                                                                            {{--*/  $Percent12 = $item->percentage /*--}}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                <input type="text" class="form-control" name="twelveMarksPercentage" value="{{ $Percent12 }}" placeholder="Enter 12th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 12th percentage here" data-parsley-type="digits" data-parsley-length ="[2, 3]" data-parsley-minlength="1" data-parsley-maxlength="3" maxlength="3" data-parsley-max="100">
                                                            </li> -->
                                                            <li class="margin-bottom-10">
                                                            Class 12th Percentage
                                                                @if( $getStudent12thmarksObj )
                                                                    @foreach(  $getStudent12thmarksObj as $student12thMarksData )
                                                                        @if( $student12thMarksData->marksName == '12th' )
                                                                            @if(empty($student12thMarksData->percentage))
                                                                                <select class="form-control" name="twelveMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 12th percentage" required="">
                                                                                    <option value="" disabled="" selected="">Please Select 12th Percentage</option>
                                                                                    {{--*/ $Percent12 = '1' /*--}}
                                                                                    @for( $Percent12 = '1'; $Percent12 < '101'; $Percent12++ )
                                                                                        @if( $student12thMarksData->percentage == $Percent12 )
                                                                                            <option value="{{ $Percent12 }}" selected="">{{ $Percent12 }}%</option>
                                                                                        @else
                                                                                            <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
                                                                                        @endif
                                                                                    @endfor
                                                                                </select>
                                                                            @else
                                                                                <input type="text" class="form-control" name="twelveMarksPercentage" value="{{ $student12thMarksData->percentage }}"  placeholder="Enter percentage here" readonly="">
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <select class="form-control" name="twelveMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid 12th percentage" required="">
                                                                        <option value="" disabled="" selected="">Please Select 12th Percentage</option>
                                                                        {{--*/ $Percent12 = '1' /*--}}
                                                                        @for( $Percent12 = '1'; $Percent12 < '101'; $Percent12++ )
                                                                            <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
                                                                        @endfor
                                                                    </select>
                                                                @endif
                                                            </li>

                                                            <li class="margin-bottom-10">Class 12th Mark sheet
                                                                <a href="javascript:void(0);" class="removeTabAction hide" id="remove3"><i class="fa fa-remove"></i></a>
                                                                <input type="file" class="form-control" name="tweleveMarksheet">
                                                                <p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
                                                            </li>

                                                            <li class="margin-bottom-10">
                                                            Graduation Percentage
                                                                @if( $getStudentGraduationMarksObj )
                                                                    @foreach(  $getStudentGraduationMarksObj as $graduationMarks )
                                                                        @if( $graduationMarks->marksName == 'Graduation' )
                                                                            @if(empty($graduationMarks->percentage))
                                                                                <select class="form-control" name="twelveMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid Graduation percentage" required="">
                                                                                    <option value="" disabled="" selected="">Please Select Graduation Percentage</option>
                                                                                    {{--*/ $Percent12 = '1' /*--}}
                                                                                    @for( $Percent12 = '1'; $Percent12 < '101'; $Percent12++ )
                                                                                        @if( $graduationMarks->percentage == $Percent12 )
                                                                                            <option value="{{ $Percent12 }}" selected="">{{ $Percent12 }}%</option>
                                                                                        @else
                                                                                            <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
                                                                                        @endif
                                                                                    @endfor
                                                                                </select>
                                                                            @else
                                                                                <input type="text" class="form-control" name="twelveMarksPercentage" value="{{ $graduationMarks->percentage }}"  placeholder="Enter percentage here" readonly="">
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <select class="form-control" name="twelveMarksPercentage" data-parsley-trigger="change" data-parsley-error-message="Please select valid Graduation percentage">
                                                                        <option value="" disabled="" selected="">Please Select Graduation Percentage</option>
                                                                        {{--*/ $Percent12 = '1' /*--}}
                                                                        @for( $Percent12 = '1'; $Percent12 < '101'; $Percent12++ )
                                                                            <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
                                                                        @endfor
                                                                    </select>
                                                                @endif
                                                            </li>

                                                            <li class="margin-bottom-10">Graduation Mark sheet
                                                                <a href="javascript:void(0);" class="removeTabAction hide" id="remove5"><i class="fa fa-remove"></i></a>
                                                                <input type="file" class="form-control" name="graduationMarksheet">
                                                                <p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{--*/ $hobbies = ''; /*--}}
                                        {{--*/ $interests = ''; /*--}}
                                        {{--*/ $achievementsawards = ''; /*--}}
                                        {{--*/ $projects = ''; /*--}}
                                        {{--*/ $studentName = ''; /*--}}
                                        {{--*/ $parentsname = ''; /*--}}
                                        {{--*/ $parentsnumber = ''; /*--}}
                                        @if( $studentApplyCourseDataObj )
                                            @foreach( $studentApplyCourseDataObj as $item )
                                                {{--*/ $hobbies = $item->hobbies; /*--}}
                                                {{--*/ $interests = $item->interests; /*--}}
                                                {{--*/ $achievementsawards = $item->achievementsawards; /*--}}
                                                {{--*/ $projects = $item->projects; /*--}}
                                                {{--*/ $studentName = $item->firstName.' '.$item->lastName; /*--}}
                                                {{--*/ $parentsname = $item->parentsname; /*--}}
                                                {{--*/ $parentsnumber = $item->parentsnumber; /*--}}
                                            @endforeach
                                        @endif

                                        <div class="row guradianBlock hide">
                                            <hr>
                                            <div class="col-sm-12 sm-margin-bottom-30">
                                                <div class="panel panel-profile">
                                                    <div class="panel-heading overflow-h">
                                                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-user"></i> Guardian Information <span class="text-info">(If you are below 18 year of your age)</span></h2>
                                                    </div>

                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <ul class="list-unstyled social-contacts-v2">
                                                                    <li>
                                                                        Parent / Guardian Name
                                                                        <input type="text" name="parentsname" class="form-control" placeholder="Enter parent / guardian name" value="{{ $parentsname }}"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid parent/guardian name" data-parsley-pattern="^[a-zA-Z\s .]*$">
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <ul class="list-unstyled social-contacts-v2">
                                                                    <li>
                                                                        Parent / Guardian Number
                                                                        <input type="text" name="parentsnumber" class="form-control" placeholder="Enter parent / guardian number" value="{{ $parentsnumber }}" data-parsley-type="digits" data-parsley-trigger="change"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid mobile number" >
                                                                        <!-- data-parsley-pattern="^[7-9][0-9]{9}$" maxlength="10"  data-parsley-length="[10, 10]"-->
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <ul class="list-unstyled social-contacts-v2">
                                                                    <li>Parent / Guardian Id Proof
                                                                        <a href="javascript:void(0);" class="removeTabAction hide" id="remove4"><i class="fa fa-remove"></i></a>
                                                                        <input type="file" class="form-control" name="parentImage">
                                                                        <p class="text-danger">(Please upload only jpg, jpeg, png &amp; pdf formats)</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="row margin-top20">
                                                            <div class="col-md-12 text-center">
                                                                <label class="text-black-color">
                                                                    <input id="checkboxActive" type="checkbox" name="studentVerifyAge"> I "{{ $studentName }}" agree that i have the consent of @if( $parentsname )"<span id="parentNameChange">{{ $parentsname }}</span>'s" @else <span id="parentNameChange">guardian</span>'s @endif to pay the booking amount on AdmissionX portal to reverse my seat for this college.
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>                    

                                        <div class="row">
                                            <div class="col-sm-12 sm-margin-bottom-30">
                                                <div class="panel panel-profile">
                                                    <div class="panel-heading overflow-h">
                                                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-tag"></i> Interest Information</h2>
                                                    </div>

                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                Hobbies <textarea class="form-control" name="hobbies" rows="2" placeholder="Enter hobbies here" data-parsley-error-message = "Please enter your hobbies" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s &().,-]*$">{{ $hobbies }}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                Interest <textarea class="form-control" name="interests" rows="2" placeholder="Enter interests here" data-parsley-error-message = "Please enter your interests" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s &().,-]*$">{{ $interests }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                Achievement &amp; Awards <textarea class="form-control" name="achievementsawards" rows="2" placeholder="Enter achievement &amp; awards here" data-parsley-error-message = "Please enter your achievement &amp; awards" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s &().,-]*$">{{ $achievementsawards }}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                Projects <textarea class="form-control" name="projects" rows="2" placeholder="Enter projects here" data-parsley-error-message = "Please enter your projects" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s &().,-]*$">{{ $projects }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12 sm-margin-bottom-30">
                                                <div class="panel panel-profile">
                                                    <div class="panel-heading overflow-h">
                                                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-check"></i> I Agree</h2>
                                                    </div>
                                                    <div class="panel-body text-center">
                                                        <label class="text-black-color">
                                                            <input id="checkboxActive" type="checkbox" name="studentVerifyDetails" required=""> I {{ $studentName }} agree that all of the above details are correct.
                                                        </label>
                                                        <button class="btn-u margin-top20" type="submit">Proceed To Pay</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}                   
                                    </div>
                                </div>
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
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
<!-- {!! Html::script('/new-assets/js/plugins/datapicker/bootstrap-datepicker.js') !!} -->
<script type="text/javascript">
    // $('#dateChange').datepicker({
    //     'autoclose': true,
    //     'changeMonth': true,
    //     'changeYear': true,
    //     'yearRange':  '1940:'+"{!! $lastYear !!}",
    //     'setDate' : "{!! $prevYear !!}",
    //     'endDate' : "{!! $prevYear !!}",
    // });
   // $("#dateChange").datepicker("setDate", "{!!$prevYear !!}");
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


        $('.parentsDocument').on('change',function(){
            $('#refresh3').removeClass('hide');
        });
        $('#refresh3').on('click',function(e){
            $('.parentsDocument').val('').trigger('chosen:updated');
            $('#refresh3').addClass('hide');
        });

        $('.tenthDocument').on('change',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.tenthDocument').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
        });

        $('.twelveDocument').on('change',function(){
            $('#refresh4').removeClass('hide');
        });
        $('#refresh4').on('click',function(e){
            $('.twelveDocument').val('').trigger('chosen:updated');
            $('#refresh4').addClass('hide');
        });

         $('.eleventhDocument').on('change',function(){
            $('#refresh5').removeClass('hide');
        });
        $('#refresh5').on('click',function(e){
            $('.eleventhDocument').val('').trigger('chosen:updated');
            $('#refresh5').addClass('hide');
        });

        

        $('input[name=parentsDocument]').change(function (e)
        {  
            var ext = $('input[name=parentsDocument]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                $('#parentDoc').addClass('hide');
            }else{
                $('input[name=parentsDocument]').val('');
                $('#parentDoc').removeClass('hide');
                return false;
            }
            //Disable input file
        });

        $('input[name=tenthDocument]').change(function (e)
        {  
            var ext = $('input[name=tenthDocument]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                $('#10thDoc').addClass('hide');
            }else{
                $('input[name=tenthDocument]').val('');
                $('#10thDoc').removeClass('hide');
                return false;
            }
            //Disable input file
        });

        $('input[name=twelveDocument]').change(function (e)
        {  
            var ext = $('input[name=twelveDocument]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                $('#12thDoc').addClass('hide');
            }else{
                $('input[name=twelveDocument]').val('');
                $('#12thDoc').removeClass('hide');
                return false;
            }
            //Disable input file
        });

        $('input[name=eleventhDocument]').change(function (e)
        {  
            var ext = $('input[name=eleventhDocument]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                $('#11thDoc').addClass('hide');
            }else{
                $('input[name=eleventhDocument]').val('');
                $('#11thDoc').removeClass('hide');
                return false;
            }
            //Disable input file
        });


    });
    
</script>

<script type="text/javascript">
    var minimized_elements = $('span.collegeDesc');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 180) return;
        
        $(this).html(
            t.slice(0,180)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(180,t.length)+' <a href="#" class="less">Less</a></span>'
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
</script>

<script type="text/javascript">
    var minimized_elements = $('span.minimize1');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(100,t.length)+' <a href="#" class="less">Less</a></span>'
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
</script>

<script type="text/javascript">
    var minimized_elements = $('span.minimize2');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 50) return;
        
        $(this).html(
            t.slice(0,50)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(50,t.length)+' <a href="#" class="less">Less</a></span>'
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
</script>
<script type="text/javascript">
    var minimized_elements = $('span.minimizeRegiAddress');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 190) return;
        
        $(this).html(
            t.slice(0,190)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(190,t.length)+' <a href="#" class="less">Less</a></span>'
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
</script>

<script type="text/javascript">
    var minimized_elements = $('span.minimizeCampusAddress');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 190) return;
        
        $(this).html(
            t.slice(0,190)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(190,t.length)+' <a href="#" class="less">Less</a></span>'
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

    $('#viewMorePopup').on('click', function(){
        $('#thanksModal').removeClass('hide');
        $.magnificPopup.open({
            items: {
                src: '#thanksModal',
            },
            type: 'inline'
        });     
    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        var dateofbirth = $('#dateChange').val();
            var HTML = '';
            var year = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { dateofbirth: dateofbirth },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getCurrentDOBCalculateApply') }}",
                success: function(data) {
                    if( data.code == '200' ){
                        $('.calculatedDateFromNow').text(data.calculateDate);   
                        year = data.year;
                        if( year < 18 ){
                            
                            $('input[name=parentsDocument]').val('');
                            $('.guradianBlock').removeClass('hide');
                            $('input[name=studentVerifyAge]').attr('required', 'required');
                            $('input[name=parentsname]').attr('required', 'required');
                            $('input[name=parentsnumber]').attr('required', 'required');
                            $('input[name=parentImage]').attr('required', 'required');
                        }else{
                            
                            $('input[name=parentsDocument]').val('');
                            $('.guradianBlock').addClass('hide');
                            $('input[name=studentVerifyAge]').removeAttr('required', '');
                            $('input[name=parentsname]').removeAttr('required', '');
                            $('input[name=parentsnumber]').removeAttr('required', '');
                            $('input[name=parentImage]').removeAttr('required', '');
                        }
                    }else{

                    }
                    
                    
                }
            });

        $('#dateChange').on('change', function(){
            var dateofbirth = $(this).val();
            var HTML = '';
            var year = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { dateofbirth: dateofbirth },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getCurrentDOBCalculateApply') }}",
                success: function(data) {
                    if( data.code == '200' ){
                        $('.calculatedDateFromNow').text(data.calculateDate);   
                        year = data.year;
                        if( year < 18 ){
                            // $('input[name=parentsname]').val('');
                            // $('input[name=parentsnumber]').val('');
                            $('input[name=parentsDocument]').val('');
                            $('.guradianBlock').removeClass('hide');
                            $('input[name=studentVerifyAge]').attr('required', 'required');
                            $('input[name=parentsname]').attr('required', 'required');
                            $('input[name=parentsnumber]').attr('required', 'required');
                            $('input[name=parentImage]').attr('required', 'required');
                        }else{
                            // $('input[name=parentsname]').val('');
                            // $('input[name=parentsnumber]').val('');
                            $('input[name=parentsDocument]').val('');
                            $('.guradianBlock').addClass('hide');
                            $('input[name=studentVerifyAge]').removeAttr('required', '');
                            $('input[name=parentsname]').removeAttr('required', '');
                            $('input[name=parentsnumber]').removeAttr('required', '');
                            $('input[name=parentImage]').removeAttr('required', '');
                        }
                    }else{

                    }
                    
                    
                }
            });
        });

        $('input[name=parentsname]').on('change', function(){
            $('#parentNameChange').text('');
            $('#parentNameChange').text($('input[name=parentsname]').val());
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.courseName').on('click',function(){
            var courseName = "{!! $collegemasterId !!}";
            var url = $(location).attr('href');
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "POST",
                url: "{{ URL::to('/student/add-bookmark') }}",
                data: { courseName: courseName, url: url },
                dataType: "json",               
                success: function(data) {
                    if(data.code == '200'){
                        $('.bookmarkHeart').css('background', '#18BA98');
                        $('.bookmarkHeart').css('color', '#FFFFFF');
                    }else{

                    }
                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('input[name=tenMarksheet]').on('change', function(){
            $('#remove1').removeClass('hide');

            var ext = $('input[name=tenMarksheet]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                
            }else{
                $('input[name=tenMarksheet]').val('');
                $('#remove1').addClass('hide'); 
            }

        });

        $('#remove1').on('click', function(){
            $('input[name=tenMarksheet]').val('');
            $('#remove1').addClass('hide');
        });

        $('input[name=elevenMarksheet]').on('change', function(){
            $('#remove2').removeClass('hide');

            var ext = $('input[name=elevenMarksheet]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                
            }else{
                $('input[name=elevenMarksheet]').val('');
                $('#remove2').addClass('hide'); 
            }

        });

        $('#remove2').on('click', function(){
            $('input[name=elevenMarksheet]').val('');
            $('#remove2').addClass('hide');
        });

        $('input[name=tweleveMarksheet]').on('change', function(){
            $('#remove3').removeClass('hide');

            var ext = $('input[name=tweleveMarksheet]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                
            }else{
                $('input[name=tweleveMarksheet]').val('');
                $('#remove3').addClass('hide'); 
            }

        });

        $('#remove3').on('click', function(){
            $('input[name=tweleveMarksheet]').val('');
            $('#remove3').addClass('hide');
        });

        $('input[name=parentImage]').on('change', function(){
            $('#remove4').removeClass('hide');

            var ext = $('input[name=parentImage]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                
            }else{
                $('input[name=parentImage]').val('');
                $('#remove4').addClass('hide'); 
            }

        });

        $('#remove4').on('click', function(){
            $('input[name=parentImage]').val('');
            $('#remove4').addClass('hide');
        });

         $('input[name=graduationMarksheet]').on('change', function(){
            $('#remove5').removeClass('hide');

            var ext = $('input[name=graduationMarksheet]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
                
            }else{
                $('input[name=graduationMarksheet]').val('');
                $('#remove5').addClass('hide'); 
            }

        });

        $('#remove5').on('click', function(){
            $('input[name=graduationMarksheet]').val('');
            $('#remove5').addClass('hide');
        });
    });
</script>
@endsection