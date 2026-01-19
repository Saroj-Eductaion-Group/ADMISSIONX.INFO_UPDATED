<style type="text/css">
	#topcontrol{background: #d40d12;}
</style>
<div class="modal fade mailChimpSubscribeModel" id="mailChimpSubscribeModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header modal-header-design" style="background: #d3070c;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">
					 AdmissionX - Newsletter  
				</h4>
			</div>
			<div class="modal-body text-center">
		        <h4 class="mailchimpMessage"></h4>
		    </div>
		</div>
	</div>
</div>
<!-- Subscribe to Our News Letter Start -->
<div class="foooter-above ">
    <div class="container">
        <div class="row">
            <h3 class="text-uppercase text-center text-white">subscribe to our news letter</h3>
            <div class="ft-newsletter-text text-center text-white text-capitalize ">
                <p class="desktop-hidden">get latest notification of college, exams and News</p>
                <span class="tab-hidden mobile-hidden">college notification</span>
                <span class="tab-hidden mobile-hidden">exam notification</span>
                <span class="tab-hidden mobile-hidden">news update</span>
            </div>          
            <div class="row">
            	<form action="{{ URL::to('/mailchimp') }}" class="footer-subsribe" method="post" id="mailChimpSubscribe" data-parsley-validate>
	                <div class="padding-top40 col-md-offset-3">
	                	<div class="row">
	                		<div class="col-md-3">
	                    		<input type="text" class="nw-name" id="subscribeName" name="username" value="" placeholder="Enter Name" data-parsley-pattern="^[a-zA-Z\s .()-]*$" data-parsley-error-message="Please enter your valid name" data-parsley-trigger="change" required=""><!-- onblur="validateName(this.value);" -->
	                    		<p class="subscribeNameError text-danger hide"></p>
	                		</div>
	                		<div class="col-md-3" style="border-left: solid 1px #fff;">
	                    		<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="nw-name" id="emailSubscribe" name="email" value="" placeholder="Enter Email Address"  data-parsley-type="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required=""> <!-- onblur="validateEmail(this.value);" --> 
	                    		<p class="subscribeEmailError text-danger hide"></p>
	                		</div>
	                		<div class="col-md-1"><input type="submit" class="nw-name nwbtn" value="Submit"></div>
	                	</div>
	                    
	                    <br>
	                    <small class="pull-left text-danger" id="errorMessage"></small>
	                </div>
                </form>
				<p id="thank-you-message" class="text-center" style="color: #ff7900;"></p>
            </div>	
        </div>
    </div>
</div>
<!-- End Subscribe to Our News Letter -->

<footer>
    <div class="footer-top tab-hidden mobile-hidden">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 footer_widget">
                    <div class="inner">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="{{ URL::to('about') }}">About us</a></li>
							<li><a href="{{ URL::to('careers') }}">Careers</a></li>
							<li><a href="{{ URL::to('contact-us') }}">Contact Us</a></li>
							<li><a href="{{ URL::to('latest-updates') }}">Latest Updates</a></li>
							<li><a href="{{ URL::to('help-center') }}">Help Center</a></li>
							<li><a href="{{ URL::to('terms-of-service') }}">Terms of Service</a></li>
							<li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation Policy</a></li>
							<li><a href="{{ URL::to('payments-refunds-policy') }}">Refunds Policy</a></li>
                            <li><a href="{{ URL::to('/educational-institution') }}">College Login & Signup</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 footer_widget">
                    <div class="inner">
                        <h4>Top Courses</h4>
                        <ul>
                            <li><a href="{{ URL::to('engineering/colleges') }}">Engineering</a></li>
                            <li><a href="{{ URL::to('commerce/colleges') }}">Commerce</a></li>
                            <li><a href="{{ URL::to('management/colleges') }}">Management</a></li>
                            <li><a href="{{ URL::to('science/colleges') }}">Science</a></li>
                            <li><a href="{{ URL::to('medical/colleges') }}">Medical</a></li>
                            <li><a href="{{ URL::to('law/colleges') }}">Law</a></li>
                            <li><a href="{{ URL::to('computer-applications/colleges') }}">Computer Applications</a></li>
                            <li><a href="{{ URL::to('architecture/colleges') }}">Architecture</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 footer_widget">
                    <div class="inner">
                        <h4>top exams</h4>
                        <ul>
	                        <li><a href="{{ URL::to('examination-list/engineering') }}">Engineering Exam</a></li>
	                        <li><a href="{{ URL::to('examination-list/commerce') }}">Commerce Exam</a></li>
	                        <li><a href="{{ URL::to('examination-list/arts') }}">Arts Exam</a></li>
	                        <li><a href="{{ URL::to('examination-list/science') }}">Science Exam</a></li>
	                        <li><a href="{{ URL::to('examination-list/medical') }}">Medical Exam</a></li>
	                        <li><a href="{{ URL::to('examination-list/management') }}">Management Exam</a></li>
	                        <li><a href="{{ URL::to('examination-list/law') }}">Law Exam</a></li>
	                        <li><a href="{{ URL::to('/examination') }}">All Examination</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 footer_widget">
                    <div class="inner">
                        <h4>Study Abroad</h4>
                        <ul>
	                        <li><a href="{{ URL::to('united-states/college-list') }}">United States</a></li>
	                        <li><a href="{{ URL::to('united-kingdom/college-list') }}">United Kingdom</a></li>
	                        <li><a href="{{ URL::to('australia/college-list') }}">Australia</a></li>
	                        <li><a href="{{ URL::to('canada/college-list') }}">Canada</a></li>
	                        <li><a href="{{ URL::to('philippines/college-list') }}">Philippines</a></li>
	                        <li><a href="{{ URL::to('japan/college-list') }}">Japan</a></li>
	                        <li><a href="{{ URL::to('singapore/college-list') }}">Singapore</a></li>
	                        <li><a href="{{ URL::to('india/college-list') }}">Study Abroad Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fb-root"></div>
    
</footer>


<!--mobile footer-->
<style type="text/css">
	.template_faq {
    background: #edf3fe none repeat scroll 0 0;
}
.panel-group {
    /*background: #fff none repeat scroll 0 0;
    border-radius: 3px;
    box-shadow: 0 5px 30px 0 rgba(0, 0, 0, 0.04);
    margin-bottom: 0;*/ margin-bottom:unset !important; 
    padding: 30px 0px;
}
.panel-default>.panel-heading{ background:unset; }

#accordion .panel1{
    border: medium none;
    border-radius: 0;
    box-shadow: none;
    margin:0px;
    background: unset;}

#accordion .panel-title1 a 
{ color: #fff; display: block; font-size: 15px;
font-weight: 600; padding: 12px 0px 12px 0px; position: relative; transition:
all 0.3s ease 0s; border-bottom: #eee solid 1px; }
 #accordion .panel-title1 a.collapsed{ color: #fff; } 
#accordion .panel-title1 a::after, #accordion
.panel-title1 a.collapsed::after { content: ""; font-family: fontawesome;
font-size: 21px; height: 55px; right:-15px; line-height: 55px; position:
absolute; text-align: center; top: -5px; transition: all 0.3s ease 0s; width:
55px; } 
#accordion .panel-title1 a.collapsed::after { box-shadow: none; color:
#fff; content: ""; } 
#accordion .panel-body { background: transparent none
repeat scroll 0 0; border-top: medium none; padding:0px 25px 0px 9px;
position: relative; }
 #accordion .panel-body p { border-left: 1px dashed
#fff; padding-left: 25px; color:#fff; }

.footer-menu{ background:#324589;}
</style>

<div class="footer-menu desktop-hidden">
	<div class="container">
		<div class="row">				
			<div class="col-md-12">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel1 panel1-default">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title1">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									QUICK LINKS
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 col-lg-3 footer_widget">
										<ul>
				                            <li><a href="{{ URL::to('about') }}">About us</a></li>
											<li><a href="{{ URL::to('careers') }}">Careers</a></li>
											<li><a href="{{ URL::to('contact-us') }}">Contact Us</a></li>
											<li><a href="{{ URL::to('help-center') }}">Help Center</a></li>
											<li><a href="{{ URL::to('terms-of-service') }}">Terms of Service</a></li>
											<li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation Policy</a></li>
											<li><a href="{{ URL::to('payments-refunds-policy') }}">Refunds Policy</a></li>
				                            <li><a href="{{ URL::to('/educational-institution') }}">College Login & Signup</a></li>
                        				</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel1 panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title1">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									TOP COURSES
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 col-lg-3 footer_widget">
										<ul>
				                            <li><a href="{{ URL::to('engineering/colleges') }}">Engineering</a></li>
				                            <li><a href="{{ URL::to('commerce/colleges') }}">Commerce</a></li>
				                            <li><a href="{{ URL::to('management/colleges') }}">Management</a></li>
				                            <li><a href="{{ URL::to('science/colleges') }}">Science</a></li>
				                            <li><a href="{{ URL::to('medical/colleges') }}">Medical</a></li>
				                            <li><a href="{{ URL::to('law/colleges') }}">Law</a></li>
				                            <li><a href="{{ URL::to('computer-applications/colleges') }}">Computer Applications</a></li>
				                            <li><a href="{{ URL::to('architecture/colleges') }}">Architecture</a></li>
                        				</ul>
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="panel1 panel-default">
						<div class="panel-heading" role="tab" id="headingFour">
							<h4 class="panel-title1">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
									TOP EXAMS
								</a>
							</h4>
						</div>
						<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 col-lg-3 footer_widget">
										<ul>
					                        <li><a href="{{ URL::to('examination-list/engineering') }}">Engineering Exam</a></li>
					                        <li><a href="{{ URL::to('examination-list/commerce') }}">Commerce Exam</a></li>
					                        <li><a href="{{ URL::to('examination-list/arts') }}">Arts Exam</a></li>
					                        <li><a href="{{ URL::to('examination-list/science') }}">Science Exam</a></li>
					                        <li><a href="{{ URL::to('examination-list/medical') }}">Medical Exam</a></li>
					                        <li><a href="{{ URL::to('examination-list/management') }}">Management Exam</a></li>
					                        <li><a href="{{ URL::to('examination-list/law') }}">Law Exam</a></li>
					                        <li><a href="{{ URL::to('/examination') }}">All Examination</a></li>
                        				</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel1 panel-default">
						<div class="panel-heading" role="tab" id="headingFive">
							<h4 class="panel-title1">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
									STUDY ABROAD 
								</a>
							</h4>
						</div>
						<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 col-lg-3 footer_widget">
										<ul>
					                        <li><a href="{{ URL::to('united-states/college-list') }}">United States</a></li>
					                        <li><a href="{{ URL::to('united-kingdom/college-list') }}">United Kingdom</a></li>
					                        <li><a href="{{ URL::to('australia/college-list') }}">Australia</a></li>
					                        <li><a href="{{ URL::to('canada/college-list') }}">Canada</a></li>
					                        <li><a href="{{ URL::to('philippines/college-list') }}">Philippines</a></li>
					                        <li><a href="{{ URL::to('japan/college-list') }}">Japan</a></li>
					                        <li><a href="{{ URL::to('singapore/college-list') }}">Singapore</a></li>
					                        <li><a href="{{ URL::to('india/college-list') }}">Study Abroad Home</a></li>
                        				</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!--- END COL -->		
		</div>
	</div>
</div>
<div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright-txt" style="color:#fff;">
                         Copyright © 2016 - {!! date('Y') !!} | All Rights Reserved.<a href="{{ URL::to('/') }}">AdmissionX</a>
                    </div>
                </div>
                <div class="col-lg-6 text-right mobile-hidden">
                    <div class="footer-nav">
                        <a href="https://www.facebook.com/AdmissionX/" target="_blank" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
						<a href="https://twitter.com/adxdotcom" target="_blank" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
						<a href="https://in.linkedin.com/company/officialadx" target="_blank" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a>
						<a href="https://www.instagram.com/admissionxofficial/" target="_blank" data-original-title="Instagram"><i class="fa fa-instagram"></i></a>
						<a href="https://www.youtube.com/channel/UCyF-Xah1WKGEq5bb0jKXtpg" target="_blank" data-original-title="Youtube" ><i class="fa fa-youtube-play	"></i></a>
						@if(env('ipAddressForRedirect') == "admissionx.info")
							<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=IXRGLZ4Mw8EDy7uCQpncp3EFUxn8pEuEVLUlU4GudAqEyIjR4aLMk3U7sNkQ"></script></span>
						@else
							<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=RB4GUrj5tO2wKJ3GVA2ibl3nm7pqsbAjr0dxyIfYeny8l0i6rfko96pdcgMU"></script></span>
						@endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--mobile footer-->


<!-- START FOOTER  -->
@include('website/home-layouts.all-model')
<!-- END FOOTER  -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
{!! Html::script('assets/js/parsley.min.js') !!}
{!! Html::script('assets/js/forms/student-details.js') !!}
@include('administrator.users.validate-email-script')


<script type="text/javascript">
	// function validateEmail(emailField){
 //        var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
 //        if (reg.test(emailField.value) == false) 
 //        {
 //            alert('Invalid Email Address');
 //            return false;
 //        }
 //        return true;
	// }

	// function validateName(nameField){
 //        var regname = /^[a-zA-Z\s .()-]*$/;
 //        if (regname.test(nameField.value) == false) 
 //        {
 //            alert('Invalid Name');
 //            return false;
 //        }
 //        return true;
	// }
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('submit', '#mailChimpSubscribe', function(){
		var data = $(this).serialize();
 		var email = $('#emailSubscribe').val();
 		var name = $('#subscribeName').val();
 		if(email == '' && name == ''){
            $('#errorMessage').html('Please enter email address & name');
            return false;
 		}else if (email == '') {
 			$('.subscribeEmailError').removeClass('hide');
            $('.subscribeEmailError').html('Please enter email address');
 			return false;
 			setTimeout(function(){
               $('.subscribeEmailError').addClass('hide');
            }, 3000);
 		}else if(name == ''){
 			$('.subscribeNameError').removeClass('hide');
            $('.subscribeNameError').html('Please enter name');
            setTimeout(function(){
               $('.subscribeNameError').addClass('hide');
            }, 3000);
 			return false;
 		}/*else if(email != ''){
  			var checkEmail = checkValidateEmail(email);
  			if (checkEmail == false) {
	  			$('#errorMessage').html('Please enter valid email');
	  			return false;
  			}
  			return true;
  		}*/

 		$('.mailChimpSubscribeModel').addClass('hide');
		$.ajax({
			type : 'POST',
			url  : '/mailchimp',
			data: JSON.stringify({emailSubscribe: email, subscribeName: name}),
	        contentType: "application/json; charset=utf-8",
	        dataType: "json",
			success :  function(data){
				if( data.code == '200' ){
					$('.mailChimpSubscribeModel').removeClass('hide');
                    $('.mailChimpSubscribeModel .mailchimpMessage').html(data.message);
                    $('#mailChimpSubscribeModel').modal({show: 'true'});
					$('#emailSubscribe').val('');
					$('#subscribeName').val('');
					$('#thank-you-message').text('Thank you for subscribing AdmissionX').show().delay(2000).fadeOut(400);
				}else if( data.code == '400' ){
					$('.mailChimpSubscribeModel').removeClass('hide');
                    $('.mailChimpSubscribeModel .mailchimpMessage').html(data.message);
                    $('#mailChimpSubscribeModel').modal({show: 'true'});
					$('#emailSubscribe').val('');
					$('#subscribeName').val('');
					$('#thank-you-message').text('Thank you for reconfirming as you are already subscribed us').show().delay(2000).fadeOut(400);
				}else{
					$('.mailChimpSubscribeModel').removeClass('hide');
                    $('.mailChimpSubscribeModel .mailchimpMessage').html(data.message);
                    $('#mailChimpSubscribeModel').modal({show: 'true'});
					$('#emailSubscribe').val('');
					$('#subscribeName').val('');
					$('#thank-you-message').text('Thank you for reconfirming as you are already subscribed us').show().delay(2000).fadeOut(400);
				}
	       }
		});
		return false;
		});
	});
</script>


<script type="text/javascript">
	$('.studentSignUpProcess').submit(function(e) {
  		e.preventDefault();
  		//VALIDATE FORM SUBMISSION
  		if( $(this).find('input[name=firstName]').val() == ''){
  			return false;
  		}else if($(this).find('input[name=lastName]').val() == ''){
  			return false;
  		}else if( $(this).find('input[name=email]').val() == ''){
  			return false;
  		}else if( $(this).find('input[name=phone]').val() == ''){
  			return false;
		}else if( $(this).find('#password1').val() == ''){
			return false;
		}else if( $(this).find('#password_again').val() == ''){
			return false;
  		}else if( $(this).find('#password1').val() == $(this).find('#password_again').val() ){
  			var form = $(this).serialize();
	  		$.ajax({
		        type: "POST",
		        url: '{{ URL::to("/student-sign-up-action") }}',
		        data: form,
		        success: function(data){
		            if( data.code =='200' ){
		            	window.location.href="student-detail-sign-up/"+data.slug;
		            }else if( data.code == '400' ){
                		$('.duplicateEmaill').text('Please verify the captcha').show().delay(5000).fadeOut(400);
                		toastr.error('reCAPTCHA is mandatory');
                	}else{
		            	$('.duplicateEmaill').text('This Email ( '+data.email+' ) address is already registered with us. Please try with new one.').show().delay(5000).fadeOut(400);
	            		$('input[name=email]').val('');
		            }
		        }
		    });
  		}else{
  			return false;
  		}
	});

</script>
<script type="text/javascript">
	$(document).ready(function(){
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
	            url: "{{ URL::to('/getCurrentDOBCalculate') }}",
	            success: function(data) {
            		if( data.code == '200' ){
            			$('.calculatedDateFromNow').text(data.calculateDate);
            			year = data.year;
           	 			if( year < 18 ){
           	 				$('input[name=parentsname]').val('');
           	 				$('input[name=parentsnumber]').val('');
           	 				$('.gurdianBlock').removeClass('hide');
            			}else{
            				$('input[name=parentsname]').val('');
           	 				$('input[name=parentsnumber]').val('');
            				$('.gurdianBlock').addClass('hide');
            			}
            		}else{

            		}
	            }
	        });
		});
	});
</script>

<script type="text/javascript">
	//AJAX
	$( '.homeLoginPopupWindow' ).submit(function(e) {
		$('.homeLoginPopupWindow .errorMessageBlock').addClass('hide');
  		e.preventDefault();
  		if($(this).find('input[name=email]').val() == '' && $(this).find('input[name=password]').val() == ''){
  			$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	        $('.homeLoginPopupWindow .errorMessage').html("Please enter your email address & password");
	        setTimeout(function(){
               $('.homeLoginPopupWindow .errorMessageBlock').addClass('hide');
            }, 5000);
	        return false;
		}else if( $(this).find('input[name=email]').val() == ''){
			$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	        $('.homeLoginPopupWindow .errorMessage').html("Please enter your email address");
	        setTimeout(function(){
               $('.homeLoginPopupWindow .errorMessageBlock').addClass('hide');
            }, 5000);
			return false;
  		}else if($(this).find('input[name=password]').val() == ''){
  			$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	        $('.homeLoginPopupWindow .errorMessage').html("Please enter your password");
	        setTimeout(function(){
               $('.homeLoginPopupWindow .errorMessageBlock').addClass('hide');
            }, 5000);
  			return false;
  		}/*else if($(this).find('input[name=email]').val() != ''){
  			var checkEmail = checkValidateEmail($(this).find('input[name=email]').val());
  			if (checkEmail == false) {
	  			$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
		        $('.homeLoginPopupWindow .errorMessage').html("Please enter valid email address");
		        setTimeout(function(){
	               $('.homeLoginPopupWindow .errorMessageBlock').addClass('hide');
	            }, 5000);
	  			return false;
  			}
  			return true;
  		}*/
  		var form = $(this).serialize();
  		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("/ajax-do-login") }}',
	        data: form,
	        success: function(data){
	        	if( data.code =='200' ){
	        		window.location='/'+data.url;
	            }else if( data.code == '401' ){
	            	$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.homeLoginPopupWindow .errorMessage').html(data.response);
	            }else if( data.code == '210' ){
	            	$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.homeLoginPopupWindow .errorMessage').html(data.response);
	            }else if( data.code == '220' ){
	            	$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.homeLoginPopupWindow .errorMessage').html(data.response);
	            }else{
	            	$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.homeLoginPopupWindow .errorMessage').html(data.response);
	            }
	        }
	    });
	});

	function checkValidateEmail(emailField){
        var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (reg.test(emailField.value) == false) 
        {
            //alert('Invalid Email Address');
            return false;
        }
        return true;
	}

	$( '.newLoginPopupWindow' ).submit(function(e) {
		$('.newLoginPopupWindow .errorMessageBlock').addClass('hide');
  		e.preventDefault();
  		if($(this).find('input[name=email]').val() == '' && $(this).find('input[name=password]').val() == ''){
  			$('.newLoginPopupWindow .errorMessageBlock').removeClass('hide');
	        $('.newLoginPopupWindow .errorMessage').html("Please enter your email address & password");
	        setTimeout(function(){
               $('.newLoginPopupWindow .errorMessageBlock').addClass('hide');
            }, 5000);
	        return false;
		}else if( $(this).find('input[name=email]').val() == ''){
			$('.newLoginPopupWindow .errorMessageBlock').removeClass('hide');
	        $('.newLoginPopupWindow .errorMessage').html("Please enter your email address");
	        setTimeout(function(){
               $('.newLoginPopupWindow .errorMessageBlock').addClass('hide');
            }, 5000);
			return false;
  		}else if($(this).find('input[name=password]').val() == ''){
  			$('.newLoginPopupWindow .errorMessageBlock').removeClass('hide');
	        $('.newLoginPopupWindow .errorMessage').html("Please enter your password");
	        setTimeout(function(){
               $('.newLoginPopupWindow .errorMessageBlock').addClass('hide');
            }, 5000);
  			return false;
  		}/*else if($(this).find('input[name=email]').val() != ''){
  			var checkEmail = checkValidateEmail($(this).find('input[name=email]').val());
  			if (checkEmail == false) {
	  			$('.newLoginPopupWindow .errorMessageBlock').removeClass('hide');
		        $('.newLoginPopupWindow .errorMessage').html("Please enter valid email address");
		        setTimeout(function(){
	               $('.newLoginPopupWindow .errorMessageBlock').addClass('hide');
	            }, 5000);
	  			return false;
  			}
  			return true;
  		}*/

  		var form = $(this).serialize();
  		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("/ajax-do-login") }}',
	        data: form,
	        success: function(data){
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
</script>

<script type="text/javascript">
	$(function() {
  return $(".modal").on("show.bs.modal", function() {
    var curModal;
    curModal = this;
    $(".modal").each(function() {
      if (this !== curModal) {
        $(this).modal("hide");
      }
    });
  });
});
</script>

<script type="text/javascript">
	@if(Session::get('is_open_popup_window_status') == 1)
		$(window).ready(function () {
			toastr.success('{{Session::get('is_open_popup_window_text')}}');
			{{ session()->forget('is_open_popup_window_status') }}
			{{ session()->forget('is_open_popup_window_text') }}
		});
	@endif
</script>

<script type="text/javascript">
	var currentURL = window.location.href;
	var currentMenu = currentURL.substr(currentURL.lastIndexOf('/') + 1)
	$( ".res-container > ul > li > a" ).each( function( index, element ){
		if( currentURL == $( this ).attr('href')){
			$(this).parent().addClass('active');
			$(this).parent().parent().addClass('active');
			$(this).parent().parent().parent().addClass('active');
		}
	});
</script>
<script type="text/javascript">
 //    $(".alert").fadeTo(10000, 500).slideUp(500, function(){
	//     $(".alert").alert('close');
	// });
</script>


<!-- ZOPIM CHAT INTEGRATION -->
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3A9xnwMCkhFv6yQt6VbhXTovbGUcl64J";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>

<script type="text/javascript">
	(function($) {
	'use strict';
		jQuery(document).on('ready', function(){
	
			$('a.page-scroll').on('click', function(e){
				var anchor = $(this);
				$('html, body').stop().animate({
					scrollTop: $(anchor.attr('href')).offset().top - 50
				}, 1500);
				e.preventDefault();
			});		

		}); 	
	})(jQuery);
</script>
<!--End of Zopim Live Chat Script-->
<!-- END