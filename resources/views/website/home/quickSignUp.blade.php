@extends('website/website-layouts.master')

@section('styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- CSS Page Style -->
{!! Html::style('assets/css/pages/page_log_reg_v4.css') !!}
<style type="text/css">
	.footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}

	.sky-form .state-error + em{margin-top: -20px !important; margin-bottom: 20px !important;color: #A52222 !important;}
</style>
@endsection

@section('content')
<!--=== Content Part ===-->
<div class="container-fluid">
	<div class="row equal-height-columns">
		<div class="col-md-6 col-sm-6 hidden-xs image-block equal-height-column left-backgrounf-form">
			
		</div>

		<div class="col-md-6 col-sm-6 form-block equal-height-column">
			<div class="reg-block">
				<a href="{{ URL::to('/') }}">
					<img class="img-responsive" src="assets/images/logo.png" alt="Admission X">
				</a>
				<h2 class="margin-bottom-30">Create new college account</h2>
				<p class="duplicateEmaill text-info"></p>
				{!! Form::open(['url' => 'quick-sign-up-action', 'method' => 'POST','class' => 'sky-form','role'=>'form', 'id'=>'sky-form2']) !!}
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span>
						<input type="text" class="form-control rounded-right" name="collegeName" placeholder="Your college name" data-parsley-pattern="^[a-zA-Z\s .()-]*$" data-parsley-error-message="Please enter your valid college name" data-parsley-trigger="change">
					</div>

					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-envelope color-green"></i></span>
						<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control rounded-right validateEmailAddress" name="email" placeholder="Your email address">
						<p class="text-danger validateEmailAddressMsg hide">This email address is already exist with another user, try again with another email address.</p> 
					</div>

					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-call-end color-green"></i></span>
						<input type="text" class="form-control rounded-right" name="contactNumber" placeholder="Your contact number" data-parsley-type="digits" data-parsley-error-message="Please enter valid contact number" data-parsley-trigger="change">
						<!-- data-parsley-error-message="Please enter valid contact number of 7 to 12 digits" data-parsley-type="digits" data-parsley-trigger="change" data-parsley-maxlength="12" data-parsley-minlength="7" maxlength="12" -->
					</div>

					<div class="input-group margin-bottom-30">
						<span class="input-group-addon rounded-left"><i class="icon-lock color-green"></i></span>
						<input type="password" class="form-control rounded-right" id="password" name="password" placeholder="Password">
					</div>				

					<div class="input-group margin-bottom-30">
						<span class="input-group-addon rounded-left"><i class="icon-lock color-green"></i></span>
						<input type="password" class="form-control rounded-right" id="password_again" name="password_again" placeholder="Confirm Password">
					</div>
					<div class="row margin-bottom-20 margin-bottom20">
						<div class="col-md-12">
							<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
							{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>

					<button type="submit" class="btn-u btn-block rounded btnValidate"><i class="fa fa-spinner fa-pulse hide" id="loader"></i> Create new</button>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div><!--/container-->
<!--=== End Content Part ===-->

<!--=== Sticky Footer ===-->
<div class="container sticky-footer">
	<ul class="list-unstyled list-inline social-links margin-bottom-30">
		<li><a href="https://www.facebook.com/AdmissionX/" target="_blank" title="Like &amp; Share with us on Facebook"><i class="icon-custom icon rounded-x icon-bg-u fa fa-facebook"></i></a></li>
		<li><a href="https://twitter.com/admission_x" target="_blank" title="Follow us on Twitter"><i class="icon-custom icon rounded-x icon-bg-u fa fa-twitter"></i></a></li>
		<li><a href="javascript:void(0);" title="Connect with us on LinkedIn"><i class="icon-custom icon rounded-x icon-bg-u fa fa-linkedin"></i></a></li>
	</ul>
	<p class="copyright-space">
		<i class="fa fa-envelope"></i> <a href="mailto:support@admissionx.info" target="_top" title="Email us anytime">support@admissionx.info</a> | <i class="fa fa-phone"></i> 011-4224-9249
	</p>
</div>
<!--=== End Sticky Footer ===-->
@endsection


@section('scripts')

<!-- <script type="text/javascript">
	$('.btnValidate').click(function(e){
		e.preventDefault();
	  	var $captcha = $('#recaptcha'),
	    response = grecaptcha.getResponse();
		if (response.length === 0) {
			toastr.error('reCAPTCHA is mandatory');
		    $( '.msg-error').text( "reCAPTCHA is mandatory" );
		    if( !$captcha.hasClass( "error" ) ){
		      $captcha.addClass( "error" );
		    }
		    return false;
		}else{
		    $('.msg-error').text('');
		    $captcha.removeClass( "error" );
		    //toastr.success('reCAPTCHA marked');
		    this.form.submit();
		}
	});
</script> -->
{!! Html::script('assets/js/forms/login.js') !!}
<script type="text/javascript">
	jQuery(document).ready(function() {
		LoginForm.initLoginForm();
	});
</script>

<script type="text/javascript">
	$('body').addClass('padding-bottom0');
	// $(".image-block").backstretch([
	// 	"assets/images/bg/1.jpg",
	// ]);
</script>
@endsection