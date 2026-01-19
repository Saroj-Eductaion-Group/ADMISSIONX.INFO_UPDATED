
<?php

# add icon images on functional area db
# total count of college lists in functional area table
#

//Laravel Social Auth
//"lucadegasperi/oauth2-server-laravel": "5.1.*",

//College reviews
// {{--*/  
//     $min = 3.5;
//     $max = 5;
//     $number = mt_rand ($min * 10, $max * 10) / 10;
//     $ratingStar = $number;
//     $totlaUserRating = 0;
// /*--}}
// @if(sizeof($collegeRatingObj) > 0)
//     @if($collegeRatingObj[0]->totalCount > 0)
//     {{--*/  
//         $ratingStar = round(($collegeRatingObj[0]->totalAcademic + $collegeRatingObj[0]->totalAccommodation + $collegeRatingObj[0]->totalFaculty + $collegeRatingObj[0]->totalInfrastructure + $collegeRatingObj[0]->totalPlacement + $collegeRatingObj[0]->totalSocial) / ($collegeRatingObj[0]->totalAcademicStar + $collegeRatingObj[0]->totalAccommodationStar + $collegeRatingObj[0]->totalFacultyStar + $collegeRatingObj[0]->totalInfrastructureStar + $collegeRatingObj[0]->totalPlacementStar + $collegeRatingObj[0]->totalSocialStar), 2);

//         $totlaUserRating = $collegeRatingObj[0]->totalCount;
//     /*--}}
//     @endif
// @endif

//college public page
/*@if($collegeData->website)
                                    @if(strpos($collegeData->website,'http://') === false)
                                        <a href="{{ URL::to('http://'.$collegeData->website) }}" target="_blank">{{ $collegeData->website }}</a>
                                    @else
                                        <a href="{{ URL::to($collegeData->website) }}" target="_blank">{{ $collegeData->website }}</a>
                                    @endif
                                @else
                                    --
                                @endif */
//Footer content
/*<!-- <script type="text/javascript">
	//AJAX
	$( '.newLoginPopupWindow' ).submit(function(e) {
		$('.newLoginPopupWindow .errorMessageBlock').addClass('hide');
  		e.preventDefault();
  		var form = $(this).serialize();
  		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("/ajax-do-login") }}',
	        data: form,
	        success: function(data){
	        	if (data.code != '200') {
	        		$('.bs-modal-sm').modal({
					    backdrop: 'static',
					    keyboard: false
					});
	        	}
	        	if( data.code =='200' ){
	        		window.location='/'+data.url;
	            }else if( data.code == '401' ){
	            	$('.newLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.newLoginPopupWindow .errorMessage').html(data.response);
	            }else if( data.code == '210' ){
	            	$('.newLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.newLoginPopupWindow .errorMessage').html(data.response);
	            }else if( data.code == '220' ){
	            	$('.newLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.newLoginPopupWindow .errorMessage').html(data.response);
	            }else{
	            	$('.newLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.newLoginPopupWindow .errorMessage').html(data.response);
	            }
	        }
	    });
	});
</script> -->*/

//Footer Login ajax
// $( '.homeLoginPopupWindow2' ).submit(function(e) {
// 		$('.homeLoginPopupWindow2 .errorMessageBlock').addClass('hide');
//   		e.preventDefault();
//   		if($(this).find('input[name=email]').val() == '' && $(this).find('input[name=password]').val() == ''){
//   			$('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
// 	        $('.homeLoginPopupWindow2 .errorMessage').html("Please enter your email address & password");
// 	        setTimeout(function(){
//                $('.homeLoginPopupWindow2 .errorMessageBlock').addClass('hide');
//             }, 5000);
// 	        return false;
// 		}else if( $(this).find('input[name=email]').val() == ''){
// 			$('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
// 	        $('.homeLoginPopupWindow2 .errorMessage').html("Please enter your email address");
// 	        setTimeout(function(){
//                $('.homeLoginPopupWindow2 .errorMessageBlock').addClass('hide');
//             }, 5000);
// 			return false;
//   		}else if($(this).find('input[name=password]').val() == ''){
//   			$('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
// 	        $('.homeLoginPopupWindow2 .errorMessage').html("Please enter your password");
// 	        setTimeout(function(){
//                $('.homeLoginPopupWindow2 .errorMessageBlock').addClass('hide');
//             }, 5000);
//   			return false;
//   		}else if($(this).find('input[name=email]').val() != ''){
//   			var checkEmail = checkValidateEmail($(this).find('input[name=email]').val());
//   			if (checkEmail == false) {
// 	  			$('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
// 		        $('.homeLoginPopupWindow2 .errorMessage').html("Please enter valid email address");
// 		        setTimeout(function(){
// 	               $('.homeLoginPopupWindow2 .errorMessageBlock').addClass('hide');
// 	            }, 5000);
// 	  			return false;
//   			}
//   			return true;
//   		}

//   		var form = $(this).serialize();
//   		$.ajax({
// 	        type: "POST",
// 	        url: '{{ URL::to("/ajax-do-login") }}',
// 	        data: form,
// 	        success: function(data){
// 	        	if( data.code =='200' ){
// 	        		window.location='/'+data.url;
// 	            }else if( data.code == '401' ){
// 	            	/*$('#loginModal').modal({
// 				        show: 'true'
// 				    });*/
// 	            	$('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
// 	            	$('.homeLoginPopupWindow2 .errorMessage').html(data.response);
// 	            }else if( data.code == '210' ){
// 	            	/*$('#loginModal').modal({
// 				        show: 'true'
// 				    });*/
// 	            	$('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
// 	            	$('.homeLoginPopupWindow2 .errorMessage').html(data.response);
// 	            }else if( data.code == '220' ){
// 	            	/*$('#loginModal').modal({
// 				        show: 'true'
// 				    });*/
// 	            	$('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
// 	            	$('.homeLoginPopupWindow2 .errorMessage').html(data.response);
// 	            }else{
// 	            	/*$('#loginModal').modal({
// 				        show: 'true'
// 				    });*/
// 	            	$('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
// 	            	$('.homeLoginPopupWindow2 .errorMessage').html(data.response);
// 	            }
// 	        }
// 	    });
// 	});



//Footer Content
/*<div class="footerMain bg-black padding-top40 padding-bottom40">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xs-12">
				<div class="footerabout">
					<h2 class="text-white padding-bottom15 text-transform">About AdmissionX</h2>
					<a href="/"><img id="logo-footer" class="footer-logo" src="{{asset('assets/images/logo.jpg')}}" width="200" alt=""></a>
					<p class="margin-bottom-20">AdmissionX is a first of its kind platform that connects students and institutions for the purpose of admission in different courses. With over 31100 colleges, more than 50200 courses in 4000 cities- AdmissionX aims to be your one stop solution for all things admission.</p>
					<ul class="padding-top20">
						<li>
							<a href="https://www.facebook.com/AdmissionX/" target="_blank" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="https://twitter.com/adxdotcom" target="_blank" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="https://in.linkedin.com/company/officialadx" target="_blank" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a>
						</li>
						<li>
							<a href="https://www.youtube.com/channel/UCyF-Xah1WKGEq5bb0jKXtpg" target="_blank" data-original-title="Youtube" ><i class="fa fa-youtube-play	"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 col-xs-12">
				<div class="footercourses">
					<h2 class="text-white padding-bottom15 text-transform">important links</h2>
					<ul>
						<li><a href="{{ URL::to('about') }}">About us</a></li>
						<li><a href="{{ URL::to('careers') }}">Careers</a></li>
						<li><a href="{{ URL::to('contact-us') }}">Contact Us</a></li>
						<li><a href="{{ URL::to('help-center') }}">Help Center</a></li>
						<li><a href="{{ URL::to('terms-of-service') }}">Terms of Service</a></li>
						<li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation Policy</a></li>
						<li><a href="{{ URL::to('payments-refunds-policy') }}">Refunds Policy</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-2 col-xs-12">
				<div class="footercourses">
					<h2 class="text-white padding-bottom15 text-transform">Quick Links</h2>
					<ul>
						<li>
							<a href="{{ URL::to('/examination') }}">All Examination</a>
						</li>
						<li>
							<a href="{{ URL::to('/careers/opportunities') }}">All Career Stream</a>
						</li>
						<li>
							<a href="{{ URL::to('/careers-courses') }}">All Career Courses</a>
						</li>
						<li>
							<a href="{{ URL::to('/popular-careers') }}">Popular Careers</a>
						</li>
						<li>
							<a href="{{ URL::to('/boards') }}">All Education Boards</a>
						</li>
						<li>
							<a href="javascript:void(0);">Study Abroad</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-4 col-xs-12">
				<div class="footernewsletterTop">
					<h2 class="text-white padding-bottom15 text-transform">Contact Us</h2>
						<address class="md-margin-bottom-40 text-white">
							<i class="fa fa-home"></i> 2nd Floor, L 5, Lajpat Nagar, New Delhi - 110024 <br>
							<i class="fa fa-home"></i> 62, SVP Nagar, Four Bungalows, Versova, Mumbai - 400053 <br>
							<i class="fa fa-phone"></i> Phone: 011-4224-9249 <br />
							<i class="fa fa-envelope"></i> Email: <a href="mailto:support@admissionx.info">support@admissionx.info</a>
						</address>
					<h2 class="text-white padding-bottom15 text-transform">newsletter</h2>
					<div class="footernewsletterBot">
						<form action="{{ URL::to('mailchimp') }}" class="footer-subsribe" method="post" id="mailChimpSubscribe" data-parsley-validate>
							<input type="text" class="form-control StayDateInput" id="emailSubscribe" name="email" placeholder="Subscribe to our Newsletter" data-parsley-type="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">

							<button type="submit" class="btn btn-lg btn-primary StayDateButton rounded-right">Subscribe</button>
							<small class="pull-left text-danger" id="errorMessage"></small>
						</form>
						<p id="thank-you-message"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="copyright margin-bottom-10 margin-top-20" style="background: #fff;">
	<div class="container">
		<p class="text-center"><strong>2016 - {!! date('Y') !!} &copy; All Rights Reserved. <a href="javascript:void(0);">AdmissionX</a></strong></p>
	</div>
</div>*/

//College ratin glist page
/*
<div class="row bg-color-green1">
            <div class="col-md-8">
                <h4 class="h4">Based On {{ $collegeRatingObj[0]->totalCount}} Student Ratings Claim This College</h4>
            </div>
            <div class="col-md-4">
            	<h4 class="h4 text-right"> {{ round(($collegeRatingObj[0]->totalAcademic + $collegeRatingObj[0]->totalAccommodation + $collegeRatingObj[0]->totalFaculty + $collegeRatingObj[0]->totalInfrastructure + $collegeRatingObj[0]->totalPlacement + $collegeRatingObj[0]->totalSocial) /($collegeRatingObj[0]->totalAcademicStar + $collegeRatingObj[0]->totalAccommodationStar + $collegeRatingObj[0]->totalFacultyStar + $collegeRatingObj[0]->totalInfrastructureStar + $collegeRatingObj[0]->totalPlacementStar + $collegeRatingObj[0]->totalSocialStar), 2) }}/5</h4>
            </div>
        </div>
*/


/*
<div class="affiliation-type fillter-type single-item">
    <div class="ft-title">Affiliation</div>
    <div class="ft-content content ftn-content">
        <div style="margin-top:10px;">
            {{--*/ $approvedByFlag = 0 /*--}}
            @if( !empty(Request::get('approvedBy')) )
                @foreach(Request::get('approvedBy') as $data)
                    @if( $data == "AICTE" )
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" checked="" value="AICTE" class="ft-checkbox searchParam"> 
                            </label>
                            <label class="input-top-select">
                                AICTE 
                            </label>  
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="UGC" class="ft-checkbox searchParam">
                            </label class="input-top-select">
                            <label class="input-top-select">
                                UGC
                            </label>
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="PCI" class="ft-checkbox searchParam"> 
                            </label>
                            <label class="input-top-select">
                                PCI
                            </label>
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="Others" class="ft-checkbox searchParam">
                            </label>
                            <label class="input-top-select">
                                Others
                            </label>    
                        </span>
                        {{--*/ $approvedByFlag = 1 /*--}}
                    @elseif( $data == "UGC" )
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="AICTE" class="ft-checkbox searchParam"> 
                            </label>
                            <label class="input-top-select">
                                AICTE 
                            </label>  
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" checked="" value="UGC" class="ft-checkbox searchParam">
                            </label class="input-top-select">
                            <label class="input-top-select">
                                UGC
                            </label>
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="PCI" class="ft-checkbox searchParam"> 
                            </label>
                            <label class="input-top-select">
                                PCI
                            </label>
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="Others" class="ft-checkbox searchParam">
                            </label>
                            <label class="input-top-select">
                                Others
                            </label>    
                        </span>
                        {{--*/ $approvedByFlag = 1 /*--}}
                    @elseif( $data == "PCI" )
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="AICTE" class="ft-checkbox searchParam"> 
                            </label>
                            <label class="input-top-select">
                                AICTE 
                            </label>  
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="UGC" class="ft-checkbox searchParam">
                            </label class="input-top-select">
                            <label class="input-top-select">
                                UGC
                            </label>
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" checked="" value="PCI" class="ft-checkbox searchParam"> 
                            </label>
                            <label class="input-top-select">
                                PCI
                            </label>
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="Others" class="ft-checkbox searchParam">
                            </label>
                            <label class="input-top-select">
                                Others
                            </label>    
                        </span>
                        {{--*/ $approvedByFlag = 1 /*--}}
                    @elseif( $data == "Others" )
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="AICTE" class="ft-checkbox searchParam"> 
                            </label>
                            <label class="input-top-select">
                                AICTE 
                            </label>  
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="UGC" class="ft-checkbox searchParam">
                            </label class="input-top-select">
                            <label class="input-top-select">
                                UGC
                            </label>
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" value="PCI" class="ft-checkbox searchParam"> 
                            </label>
                            <label class="input-top-select">
                                PCI
                            </label>
                        </span>
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" name="approvedBy[]" checked="" value="Others" class="ft-checkbox searchParam">
                            </label>
                            <label class="input-top-select">
                                Others
                            </label>    
                        </span>
                        {{--*/ $approvedByFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $approvedByFlag == '0' )
                <span>
                    <label class="input-main-select">
                        <input type="checkbox" name="approvedBy[]" value="AICTE" class="ft-checkbox searchParam"> 
                    </label>
                    <label class="input-top-select">
                        AICTE 
                    </label>  
                </span>
                <span>
                    <label class="input-main-select">
                        <input type="checkbox" name="approvedBy[]" value="UGC" class="ft-checkbox searchParam">
                    </label class="input-top-select">
                    <label class="input-top-select">
                        UGC
                    </label>
                </span>
                <span>
                    <label class="input-main-select">
                        <input type="checkbox" name="approvedBy[]" value="PCI" class="ft-checkbox searchParam"> 
                    </label>
                    <label class="input-top-select">
                        PCI
                    </label>
                </span>
                <span>
                    <label class="input-main-select">
                        <input type="checkbox" name="approvedBy[]" value="Others" class="ft-checkbox searchParam">
                    </label>
                    <label class="input-top-select">
                        Others
                    </label>    
                </span>
            @endif
        </div>
     </div>
</div>
*/

/*<!-- 
<script type="text/javascript">
    var courseObj = '';
    var courseOptions = '';
    courseObj = <?php echo json_encode($courseObj); ?>;
    for (var i = 0; i <= courseObj.length - 1; i++) {
        var str = '<option value="'+courseObj[i]['courseId']+'"';
        str += '>'+courseObj[i]['courseName']+ ' (Degree : '+courseObj[i]['degreeName']+' | Stream : '+courseObj[i]['functionalareaName']+') </option>';
        courseOptions += str; 
    }   


    var educationLevelObj = '';
    var educationLevelOptions = '';
    educationLevelObj = <?php echo json_encode($educationLevelObj); ?>;
    for (var i = 0; i <= educationLevelObj.length - 1; i++) {
        var str1 = '<option value="'+educationLevelObj[i]['id']+'"';
        str1 += '>'+educationLevelObj[i]['name']+ '</option>';
        educationLevelOptions += str1; 
    }   

    var courseTypeObj = '';
    var courseTypeObjOptions = '';
    courseTypeObj = <?php echo json_encode($courseTypeObj); ?>;
    for (var i = 0; i <= courseTypeObj.length - 1; i++) {
        var str2 = '<option value="'+courseTypeObj[i]['id']+'"';
        str2 += '>'+courseTypeObj[i]['name']+ '</option>';
        courseTypeObjOptions += str2; 
    }   

    var countDepartmentDetails = 0;
    $('#addNewDepartmentDetailRow').on('click', function(){
        countDepartmentDetails++;
        var HTML = ''+
            '<div class="clientContactDetails margin-bottom20">'+
                '<h4 class="padding-bottom10">Associate Department Detail <a class="btn btn-outline btn-danger text-white btn-xs removeFacultyDepartmentList pull-right"><i class="fa fa-remove"></i> Remove</a></h4>'+
                '<div class="row margin-bottom10">'+
                    '<div class="col-md-4">'+
                        '<label class="">Course</label>'+
                        '<select name="course_id[]" class="form-control text-capitalize js-example-basic-single" +data-parsley-error-message="Please select course name" placeholder="Select course"><option selected="" value="" required=""> --Select course name --</option>'+courseOptions+'</select>'+ 
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<label class="">Degree Level</label>'+
                        '<select name="educationlevel_id[]" class="form-control text-capitalize" +data-parsley-error-message="Please select degree level" placeholder="Select Field Name1"><option selected="" value="" required=""> --Select degree level --</option>'+educationLevelOptions+'</select>'+ 
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<label class="">Course Type</label>'+
                        '<select name="coursetype_id[]" class="form-control text-capitalize" +data-parsley-error-message="Please select course type" placeholder="Select Field Name1"><option selected="" value="" required=""> --Select course type --</option>'+courseTypeObjOptions+'</select>'+ 
                    '</div>'+
                '</div>'+
            '</div>'
        $('.facultyDepartmentSection').append(HTML);
        $('.js-example-basic-single').select2();
    });

    $(document).on('click','.removeFacultyDepartmentList', function(){
        countDepartmentDetails--;
        $(this).parent().parent().remove();
    });
</script> -->*/

/*
New header cut this line 1013

<ul class="nav navbar-nav desktop-hidden hidden-xs">
                                <li><a href="{{ URL::to('top-colleges') }}" class="">top colleges</a></li>
                                <li><a href="{{ URL::to('top-university') }}" class="">top universities</a></li>
                                <li><a href="{{ URL::to('top-courses') }}" class="">top courses</a></li>
                                <li><a href="{{ URL::to('study-abroad') }}" class="">Study Abroad</a></li>
                                <li><a href="{{ URL::to('examination') }}" class="">exams</a></li>
                                <li><a href="{{ URL::to('reviews') }}" class="">Reviews</a></li>
                                <li><a href="{{ URL::to('news') }}" class="">news</a></li>
                                <li><a href="{{ URL::to('education-blogs') }}" class="">blogs</a></li>
                                <li><a href="{{ URL::to('latest-updates') }}" class="">Admission {!! date('Y') !!}</a></li>
                                <li><a href="{{ URL::to('ask') }}" class="">Ask</a></li>
                                <li><a href="{{ URL::to('boards') }}" class="">Education Boards</a></li>
                                <li><a href="{{ URL::to('careers-courses') }}" class="">Career Courses</a></li>
                                <li><a href="{{ URL::to('careers/opportunities') }}" class="">Career Stream</a></li>
                                @if(Auth::check())
                                    <li><a href="{{ URL::to('login') }}">Dashboard</a></li>
                                    <li class="dropdown"><a href="">
                                        <span class="m-r-sm text-muted welcome-message">Hi, {{ str_limit(Auth::user()->firstname, $limit = 17, $end = '') }}
                                        </span></a>
                                        <ul class="dropdown-menu" style="top: auto;">
                                            <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a class="color-green" data-toggle="modal" data-target="#loginModal" data-whatever="" href="">Log In</a></li>
                                    <li><a class="color-green" href="{{ URL::to('/student-sign-up') }}">Sign Up</a></li>
                                    <li class="dropdown signupBlock">
                                        <a href="" class="dropdown-toggle padding0 text-white" title="Student Sign Up"></a>
                                    </li>
                                    <!-- <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                            Sign Up
                                        </a>
                                        <ul class="dropdown-menu" style="top: auto;">
                                            <li><a href="{{ URL::to('/educational-institution') }}" title="College Sign Up"><b><i class="fa fa-sign-in" aria-hidden="true"></i> College Sign Up</b></a></li>
                                            <li><a href="{{ URL::to('/student-sign-up') }}" title="Student Sign Up"><b><i class="fa fa-sign-in" aria-hidden="true"></i> Student Sign Up</b></a></li>
                                        </ul>
                                    </li> -->
                                @endif
                            </ul>*/


