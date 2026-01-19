
@extends('website/new-design-layouts.master')

@section('content')

<!-- CSS Page Style -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
</style>
<style type="text/css">
   .student-pop-left{background: url(/assets/images/homepage/student-pop-bg2.png); padding:180px 5%; background-size:cover; min-height:530px;  }
	.panel-title > a:before { float: right !important; font-family: FontAwesome; content:"\f056";  padding-right: 5px;}
	.panel-title > a.collapsed:before { float: right !important; content:"\f055";}
	.panel-title > a:hover, 
	.panel-title > a:active, 
	.panel-title > a:focus {  text-decoration:none;}
	.student-pop-heading{ background-color:unset !important; border-color:unset !important;}
	.student-pop-panel{ border-color:unset !important; border:unset !important;}
	.whysignUp h2{ font-size:20px; font-weight:600; padding:0 15px;}
	.student-pop-top ul li{ display:inline; color:#000; font-size:20px; padding-right: 12%; font-weight:600;  }
	.student-pop-top{ border-bottom:unset; }
	.student-pop-top li a{text-transform:uppercase;font-weight:600;font-size:18px; padding-left:0px !important; margin-right:25px !important; background:unset !important;}

	.student-pop-top li.active>a, .student-pop-top li.active>a:focus, .student-pop-top li.active>a:hover{  background-color: unset !important;  border-bottom:#d40d12 solid 3px !important;   font-family:'Open Sans', sans-serif; font-weight: 700 !important; font-size: 18px; border-right:unset; border-left:unset; color:#d40d12; border-top:unset;  }
	.student-pop-top li a:hover{ background-color:unset !important; border:unset; border-color: unset !important; cursor:pointer !important; }
	
	.login_btn_click{ background: #d40d12; border-radius: 50px; padding:5px 25px; color: #FFF; font-size: 18px !important; border: unset;}
	.login-box{ width:100px; margin:0 auto; }
    .login-box ul li{ display:inline;}
    .login-box ul li a {  border-radius: 50px;  font-family: open sans, serif; display:inline-block; background:#3b5998; color:#fff; font-size:18px; width:42px; height:42px; line-height:33px;  border-radius:50px; margin-right:5px; }
	.login-box ul li a.active{ background:#d40d12;} 
	.login-box ul li a span{     font-family: open sans, serif; }
	.student-pop-right-main{padding-top: 50px; padding-left:6%; margin-bottom:50px;}
	.dot{ height: 27px; width: 27px; background-color: #bbb; border-radius: 50%; display: inline-block; color: #fff; font-weight: bold;}
	.student-input-field{ padding: 18px 15px !important;   border-radius: 50px; }
	.clientContactDetails{box-shadow:#eeee 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	.student-select-field{ padding:7px 15px !important; border-radius: 50px; display: block;
    width: 100%;  font-size: 14px; color: #999999 !important; background-color: #fff; background-image: none;  border: 1px solid #ccc; }

    .select-suffix-bt{ border:unset; background:unset !important; box-shadow:unset; }
    .select-suffix-bt:focus{ box-shadow:unset !important;}
    .select-suffix-tp{ background:unset !important; border: 1px solid #ccc; border-radius:50px; padding-right:10px;  }
    .student-d-flex{display:flex  }
    
	@media screen and (max-width:767px) {
        
        .student-d-flex{ display:unset; }
    	.student-pop-right-main{ padding-left:unset; }
        .student-pop-left{ padding:80px 5%;}

    }



</style>
	<div class="container-fluid">
		<div class="row student-d-flex">
			<div class="col-md-6 student-pop-left" style="background: ">
				<div class="student-pop-leftTop" style=" background:#fff; padding:10px 15px;">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="whysignUp">
							<h2>Why Sign Up?</h2>
						</div>
						@foreach($getPageContentDataObj as $key => $item)
					    <div class="panel panel-default student-pop-panel">
					        <div class="panel-heading student-pop-heading" role="tab" id="heading_{{$key}}">
					            <h4 class="panel-title">
						        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$key}}" aria-expanded="false" aria-controls="collapse_{{$key}}">
						          {{ $item->title }}
						        </a>
					      		</h4>
							</div>
					        <div id="collapse_{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{{$key}}">
					            <div class="panel-body">{!! $item->description !!}</div>
					        </div>
					    </div>
					    @endforeach
					</div>
				</div>
			</div>
			<div class="col-md-6 student-pop-right-main">
				<div class="row">
					<div class="col-offest-md-2 col-md-10">
						<div class="clientContactDetails">
							<div class="bs-example bs-example-tabs">
			                    <ul id="myTab" class="nav nav-tabs student-pop-top">
			                        <li class="">
			                        	<a id="modalSigninBtn" href="#signinNew" data-toggle="tab" aria-expanded="false">Login</a>
			                        </li>
			                        <li class="active">
			                        	<a id="modalSignupBtn" href="#signupNew" data-toggle="tab" aria-expanded="true">Sign Up</a>
			                        </li>
			                    </ul>
			                </div>

							{{-- <div class="student-pop-top">
								<ul class="student-tabs">
									<li class="active">
										<a  id="modalSigninBtn" href="#">Login</a>
									</li>
									<li>
										<a id="modalSignupBtn" href="#">Sign Up</a>
									</li>
								</ul>
							</div> --}}
							<div class="student-pop-right">
								<div class="row stdntsigninMn hide">
			                        <div class="col-md-12">
			                            <div class="stdntdetailRight">
			                               <div class="popupModelbdy">
			                                    <form style="padding-top:20px;" action="javascript:void(0);" method="POST" data-parsley-validate="" class="newLoginPopupWindow form-horizontal" novalidate="">
			                                        <div class="alert alert-danger alert-dismissible errorMessageBlock hide padding-top10" id="dialog" role="alert">
			                                            <strong class="errorMessage"></strong>
			                                        </div>
			                                        <fieldset class="padding-top10">
			                                            <div class="control-group">
			                                                <div class="controls">
			                                                    <input required="" id="email" name="email" autocomplete="off" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control input-medium student-input-field" placeholder="Email" data-parsley-id="4">
			                                                </div>
			                                            </div>
			                                            <div class="control-group margin-top20">
			                                               	<div class="controls">
			                                                    <input required="" id="passwordinput" name="password" autocomplete="off" class="form-control input-medium student-input-field" type="password" placeholder="Password" data-parsley-id="6">
			                                                </div>
			                                            </div>
			                                            <div class="form-group btn_group_divs loginer_btGroups margin-top20">
			                                                <button id="submit_loginn" class="login_btn_click btn-block" type="submit">Login</button>
			                                                <p class="text-center hide margin-top10 spin_loader hide_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
			                                                <a style="display:block; padding-top:15px;  font-size:16px; font-weight:600; text-align:center;"  href="javascript:void(0);" class="forgot_pass text-black" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Forgot Password</a>
			                                            </div>
			                                            <div>
			                                            	<p class="text-center margin-top10"><span class="dot">or</span></p>
			                                            </div>
														<div class="login-box padding-top10">
															<ul>
																<li>
																	<a class="btn-block" href="{{ URL::to('/auth/facebook') }}">
																		<i class="fa fa-facebook"></i>
																		{{-- <span>Connect with Facebook</span> --}}
																	</a>
																</li>
																<li>
																	<a class="btn-block active" href="{{ URL::to('/auth/google') }}">
																		<i class="fa fa-google-plus"></i>
																		{{-- <span>Connect with Google</span> --}}
																	</a>
																</li>
															</ul>
										                </div>

										                <p class="margin-top10 text-center">College Sign Up? <a href="{{ URL::to('/educational-institution') }}" target="_blank">click here</a></p>
			                                        </fieldset>
			                                    </form>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row stdntsignupMn">
			                       	<div class="col-md-12">
			                            <div class="stdntdetailRight1">
			                               	<div class="popupModelbdy margin-top20">
												<h3>Create new student account</h3>
				                                <form action="javascript:void(0);" method="POST" data-parsley-validate="" class="form-horizontal newStudentSignUpProcess" novalidate="" enctype="multipart/form-data">
				                                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide padding-top10" id="dialog" role="alert">
				                                        <strong class="errorMessage"></strong>
				                                    </div>
				                                    <fieldset class="padding-top10">
				                                    	{{-- <div  class="control-group margin-top15 select-suffix-tp">
															<select  class="form-control select-suffix-bt">
															 	<option value="" selected="" >Select suffix</option>
									                            <option value="Mr.">Mr.</option>
									                            <option value="Miss.">Miss.</option>
									                            <option value="Mrs.">Mrs.</option>
									                        </select>  
									                	
									                    </div> --}}

				                                        <div class="control-group margin-top15">
				                                            <div class="controls">
				                                                <input class="form-control input-medium student-input-field" type="text" name="firstName" autocomplete="off" placeholder="Enter first name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your first name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" required="">
				                                            </div>
				                                        </div>

				                                        <div class="control-group margin-top15">
				                                            <div class="controls">
				                                                <input class="form-control input-medium student-input-field" type="text" name="middleName" autocomplete="off" placeholder="Enter middle name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your middle name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$">
				                                            </div>
				                                        </div>

				                                        <div class="control-group margin-top15">
				                                            <div class="controls">
				                                                <input class="form-control input-medium student-input-field" type="text" name="lastName" autocomplete="off" placeholder="Enter last name here" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter your last name" required="">
				                                            </div>
				                                        </div>

				                                        <div class="control-group margin-top15">
				                                           	<div class="controls">
				                                                <input  class="form-control input-medium student-input-field validateEmailAddress"  type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" autocomplete="off" placeholder="Enter email here" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
																<p class="text-danger validateEmailAddressMsg hide">This email address is already exist with another user, try again with another email address.</p> 
				                                            </div>
				                                        </div>
				                                        <div class="control-group margin-top15">
				                                            <div class="controls">
				                                                <input class="form-control input-medium student-input-field" type="text" name="phone" autocomplete="off" placeholder="Enter phone number here" data-parsley-trigger="change" data-parsley-error-message="Please enter valid mobile number"  required="" data-parsley-maxlength="10" data-parsley-minlength="10" maxlength="10" data-parsley-pattern="^[6-9][0-9]{9}$" data-parsley-length="[10, 10]">
				                                            </div>
				                                        </div>

				                                        <div class="control-group margin-top15">
				                                           	<div class="controls">
				                                                <input type="password" class="form-control input-medium student-input-field" data-type="password" id="password1" name="password" placeholder="Password" required="" data-parsley-trigger="change" data-parsley-error-message="Please enter password minimum 6 character" minlength="6" >
				                                            </div>
				                                        </div>
				                                        <div class="control-group margin-top15">
				                                           	<div class="controls">
				                                                <input type="password" class="form-control input-medium student-input-field" data-type="password" id="password_again" name="password_again" placeholder="Confirm Password" data-parsley-trigger="change" data-parsley-equalto="#password1" data-equalto-message="Password doesn't match" required="" data-parsley-error-message="Password does not match" minlength="6"  >
				                                            </div>
				                                        </div>
				                                        <div class="input-group margin-top15 margin-bottom-20">
															<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
															{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
														</div>
														<p class="text-center loader hide">
															<img src="{{asset('assets/images/loading.gif')}}" width="64">	
														</p>
				                                        <div class="form-group btn_group_divs loginer_btGroups margin-top20">
				                                            <button id="submit_signup" class="login_btn_click btn-block" type="submit">Sign Up</button>
				                                            <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
				                                        </div>
				                                        <div>
			                                            	<p class="text-center margin-top15"><span class="dot">or</span></p>
			                                            </div>
														<div class="login-box padding-top10">
															<ul>
																<li>
																	<a class="" href="{{ URL::to('/auth/facebook') }}">
																		<i class="fa fa-facebook"></i>
																		{{-- <span>Connect with Facebook</span> --}}
																	</a>
																</li>
																<li>
																	<a class=" active" href="{{ URL::to('/auth/google') }}">
																		<i class="fa fa-google-plus"></i>
																		{{-- <span>Connect with Google</span> --}}
																	</a>
																</li>
															</ul>
										                </div>
														<p style="margin-top:20px; text-align:center;">College Sign Up? <a href="{{ URL::to('/educational-institution') }}" target="_blank">click here</a></p>
				                                    </fieldset>
				                                </form>
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
	</div>


@endsection

@section('scripts')
{!! Html::script('assets/administrator/js/parsley.js') !!}
{!! Html::script('assets/js/forms/student-details.js') !!}
<script type="text/javascript">
	jQuery(document).ready(function() {
		StudentSignUpForm.initStudentSignUpForm();
	});
</script>
<script type="text/javascript">
	$('form').parsley();
    window.onload = function() {
	    var $recaptcha = document.querySelector('#g-recaptcha-response');

	    if($recaptcha) {
	        $recaptcha.setAttribute("required", "required");
	    }
  	};

  	$( window ).load(function() {
    	setTimeout(function(){
    		$('input[type="text"]').val('');
    		$('input[type="password"]').val('');
    		$('input[type="email"]').val('');
        }, 1000);
	});
</script>
<script>
    $(document).ready(function(){
        $('#modalSignupBtn').click(function() {
            $('.stdntsignupMn').removeClass('hide');   
            $('.stdntsigninMn').addClass('hide');     
        });

        $('#modalSigninBtn').click(function() {
            $('.stdntsignupMn').addClass('hide');   
            $('.stdntsigninMn').removeClass('hide');   
        }); 
    });

  	$(".set > a").on("click", function() {
      if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(this)
          .siblings(".set .content")
          .slideUp(200);
        $(".set > a i")
          .removeClass("fa-minus")
          .addClass("fa-plus");
      } else {
        $(".set > a i")
          .removeClass("fa-minus")
          .addClass("fa-plus");
        $(this)
          .find("i")
          .removeClass("fa-plus")
          .addClass("fa-minus");
        $(".set > a").removeClass("active");
        $(this).addClass("active");
        $(".set .content").slideUp(200);
        $(this)
          .siblings(".set .content")
          .slideDown(200);
      }
	});
</script>
 
 <script type="text/javascript">
	$('.newStudentSignUpProcess').submit(function(e) {
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
  			$('#submit_signup').prop("disabled", true);
  			$('.loader').removeClass('hide');
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
  			$('#submit_signup').prop("disabled", false);
  			$('.loader').addClass('hide');
  			return false;
  		}
	});

</script>

@endsection


