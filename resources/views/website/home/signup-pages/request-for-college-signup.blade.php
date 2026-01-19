@extends('website/new-design-layouts.master')

@section('content')
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	.college-pop-left-main{ background: url(/assets/images/homepage/college-pop-bg.png);
	 padding:80px 0px;  background-size:cover; }
	.college-pop-left-top{ width: 51%;
    background: #ffffff;
    padding: 60px 40px;
    margin-left: 24%;
    border-radius: 4px;
    box-shadow: #e2e2e2 0 0 10px; }


	.college-input-fd{ width:85%; padding: 0px; border-bottom:#e7e7e7 solid 1px; border-top:unset; border-left:unset;   background: unset; border-right:unset; color:#000; 
		margin-top:20px; }
	.college-input-fd:focus{ border-bottom:#e7e7e7 solid 1px; box-shadow:none; }	
	.college-input-fd::-webkit-input-placeholder{ color:#000; font-size:15px;}
	.dot1 { height: 33px; line-height: 33px; width: 33px; background-color: #6dabe4;  border-radius: 50%;
    display: inline-block; color: #fff; font-weight: bold;}
	.login-box ul li { display: inline;	}
	.login-box ul li a { border-radius:4px; font-family: open sans, serif;  display: inline-block; background: #3b5998; color: #fff; font-size: 16px; margin-bottom: 15px; text-align: center;  font-weight: 500; }
	.login-box ul li a span {  font-family: open sans, serif;}
	.login-box ul li a.active {  background: #d40d12;}
	
	.college-signin h2{ font-size: 32px; color: #000; 
	font-weight: 800; }
	.college-pop-right-top{  padding:20px 10% 20px 10%;}
	.studentsignUp p{ color:#000; font-size:16px; }

@media only screen and (max-width:767px)
{
.college-pop-left-top{ width:100%; margin-left:unset; }

.college-pop-right-top{ padding: 0px 0% 50px 0%;}
}
.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}

.student-d-flex{display:flex  }


	@media screen and (max-width:767px) {
        .student-d-flex{ display:unset; }
       	.college-signin h2{ padding-top: 20px; font-size: 23px; }
       	.college-pop-left-main{ background:unset; padding:10px 0px 0; }
       	.college-pop-right-top{ padding:0px;}
    }

    @media screen and (max-width:768px) {
	.college-pop-left-top{ width: 94%; margin-left: 3%; }
	.college-signin h2{font-size: 24px; }
    }


</style>

<div class="container-fluid">
	<div class="row student-d-flex">
		<div class="col-md-6 college-pop-left-main">
			<div class="college-pop-left-top">
				<div class="college-signin">
					<h2>College Login</h2>
				</div>
				<div class="row">
					<div class="col-md-12">
						@if ($errors->any())
						    <div class="alert alert-danger alert-dismissable text-center">
						    	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						        @foreach ($errors->all() as $error)
						            {{ $error }}
						        @endforeach
					        </div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						@if(Session::has('success'))
			            <div class="alert alert-success alert-dismissible" id="dialog" role="alert">
			                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                </button>
			                <strong>{{ Session::get('success') }}</strong>
			            </div>                        
			        	@endif
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 ">
						@if(Session::has('confirmDisabledEmail'))
							<div class="alert alert-danger alert-dismissable text-center">
			                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                    {{ Session::get('confirmDisabledEmail') }}                        
			                </div>
			        	@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						@if(Session::has('confirmBlockedEmail'))
							<div class="alert alert-danger alert-dismissable text-center">
			                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                    {{ Session::get('confirmBlockedEmail') }}                        
			                </div>
			        	@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						@if(Session::has('verifiedEmail'))
							<div class="alert alert-success alert-dismissable text-center">
			                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                    {{ Session::get('verifiedEmail') }}                        
			                </div>
			        	@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						@if(Session::has('confirmEmail'))
							<div class="alert alert-success alert-dismissable text-center">
			                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                    {{ Session::get('confirmEmail') }}
			                    <br>
			                    <a href="{{ url('resend-college-email-link', Session::get('emailAdd')) }}" class="btn btn-sm btn-u margin-top10 margin-bottom10" title="Resend email now">Resend Email Now</a>
			                </div>
			        	@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						@if(Session::has('pleaseVierfyYourEmail'))
							<div class="alert alert-warning alert-dismissable text-center">
			                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                    {{ Session::get('pleaseVierfyYourEmail') }}
			                </div>
			        	@endif
					</div>
				</div>
				@if(Session::has('college_flash_message'))
		            <div class="row">
		                <div class="col-md-12">
		                    <div class="alert {{ Session::get('college_alert_class') }}  alert-dismissible fade in text-center" role="alert">
		                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                            <span aria-hidden="true">×</span>
		                        </button>
		                        <strong>{{ Session::get('college_flash_message') }}</strong>
		                        <br>
		                        <a href="{{ url('/login') }}" class="btn btn-sm btn-u margin-top10 margin-bottom10" title="Click here">Click here</a>
		                    </div>
		                </div>
		            </div>
		        @endif
				<form action="/college-login" method="POST" data-parsley-validate="" enctype="multipart/form-data">
					<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" id="email" class="form-control college-input-fd" name="email" placeholder="Email Address" required="required" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" data-parsley-id="6">
					<input type="password" class="form-control college-input-fd" id="password" placeholder="Password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" data-parsley-id="6">
					<button type="submit" class="btn-u btn-block rounded margin-top30 margin-bottom30">Sign In</button>
					<a style="display:block; font-size:16px; font-weight:600; " href="javascript:void(0);" class="forgot_pass text-black" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Forgot Password</a>	
				</form>
			</div>
		</div>
		<div class="col-md-5">
			<div class="college-pop-right-top">
				<div class="college-signin">
					<h2>Create a college account</h2>
					<p class="text-black">Request from admin to create your college profile, submit this form</p>
				</div>
				@if(Session::has('flash_message'))
		            <div class="row">
		                <div class="col-md-12">
		                    <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
		                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                            <span aria-hidden="true">×</span>
		                        </button>
		                        <strong>{{ Session::get('flash_message') }}</strong>
		                    </div>
		                </div>
		            </div>
		        @endif
				<form action="/request/create/college-account" method="POST" data-parsley-validate="" enctype="multipart/form-data">
					<input type="text" required="" class="form-control college-input-fd" name="collegeName" placeholder="College Name" data-parsley-pattern="^[a-zA-Z\s .()-]*$" data-parsley-error-message="Please enter your valid college name" data-parsley-trigger="change">

					<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control college-input-fd validateEmailAddress" name="email" placeholder="Email Address" data-parsley-type="email"  data-parsley-error-message="Please enter valid email address" data-parsley-trigger="change" required="" >
					<p class="text-danger validateEmailAddressMsg hide">This email address is already exist with another user, try again with another email address.</p> 

					<input type="text" class="form-control college-input-fd" name="contactNumber" placeholder="Contact Number" data-parsley-error-message="Please enter valid mobile number" data-parsley-type="digits" data-parsley-trigger="change" required="" data-parsley-maxlength="10" data-parsley-minlength="10" maxlength="10" data-parsley-pattern="^[6-9][0-9]{9}$" data-parsley-length="[10, 10]" > <!-- data-parsley-maxlength="10" data-parsley-minlength="10" maxlength="10" data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10, 10]" -->

					<input  type="text" required="" class="form-control college-input-fd" name="contactPersonName" placeholder="Contact person name" data-parsley-pattern="^[a-zA-Z\s .()-]*$" data-parsley-error-message="Please enter your valid contact person name" data-parsley-trigger="change">

					<div class="margin-bottom10 margin-top40">
						<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
						{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
					</div>

					<button style="width:90%;" type="submit" class="btn-u btn-block rounded margin-top10">Submit</button>
				</form>
				<div class="studentsignUp">
					<p class="margin-top20">Student Sign Up? <a href="{{ URL::to('/student-sign-up') }}" target="_blank">click here</a></p>
					<!-- <button type="submit" class="btn-u btn-block rounded ">Click Here</button> -->
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
    window.onload = function() {
	    var $recaptcha = document.querySelector('#g-recaptcha-response');

	    if($recaptcha) {
	        $recaptcha.setAttribute("required", "required");
	    }
  	};
</script>
@endsection