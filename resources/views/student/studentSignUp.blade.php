@extends('website/new-design-layouts.master')

@section('styles')
<!-- CSS Page Style -->
<script src='https://www.google.com/recaptcha/api.js'></script>
{!! Html::style('assets/css/pages/page_log_reg_v4.css') !!}
<style type="text/css">
	.footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
	.sky-form .state-error + em{margin-top: -20px !important; margin-bottom: 20px !important;color: #A52222 !important;}
	.form-block-main{ padding:60px 55px !important;}
	body {
    margin-bottom:0px !important;
    font-size: 14px;
}
</style>
@endsection

@section('content')
<!--=== Content Part ===-->
<div class="container-fluid">
	<div class="row equal-height-columns">
		<div class="col-md-6 col-sm-6 hidden-xs image-block equal-height-column left-backgrounf-form">
			
		</div>

		<div class="col-md-6 col-sm-6 form-block equal-height-column form-block-main">
			<div class="reg-block">
				<a href="{{ URL::to('/') }}">
					<img class="img-responsive" src="assets/images/logo.png" alt="Admission X">
				</a>
				<h2 class="margin-bottom-30">Create new student account</h2>
				<p class="duplicateEmaill text-info"></p>
				{!! Form::open(['url' => 'student-sign-up-action', 'method' => 'POST','class' => 'sky-form','role'=>'form', 'id'=>'sky-form4','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-user color-green" style="color:#f00 !important;"></i></span>
						<select style="height:47px;" class="form-control rounded-right" name="suffix" >
                            <option value="" disabled selected>Select suffix</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Miss.">Miss.</option>
                            <option value="Mrs.">Mrs.</option>
                        </select>
					</div>
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-user color-green" style="color:#f00 !important;"></i></span>
						<input class="form-control rounded-right" type="text" name="firstName" placeholder="Enter first name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your first name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" required="">
					</div>
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-user color-green" style="color:#f00 !important;"></i></span>
						<input class="form-control" type="text" name="middleName" placeholder="Enter middle name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your middle name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$">
					</div>
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-user color-green" style="color:#f00 !important;"></i></span>
						<input class="form-control" type="text" name="lastName" placeholder="Enter last name here" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter your last name">
					</div>
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-envelope color-green" style="color:#f00 !important;"></i></span>
						<input class="form-control validateEmailAddress" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" placeholder="Enter email here" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
						<p class="text-danger validateEmailAddressMsg hide">This email address is already exist with another user, try again with another email address.</p> 
					</div>
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-call-end color-green" style="color:#f00 !important;"></i></span>
						<input type="text" class="form-control" name="phone" placeholder="Enter phone number here" data-parsley-trigger="change" data-parsley-error-message="Please enter valid mobile number"  required="" data-parsley-maxlength="10" data-parsley-minlength="10" maxlength="10" data-parsley-pattern="^[6-9][0-9]{9}$" data-parsley-length="[10, 10]"><!-- data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[8, 11]" -->
					</div>
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-lock color-green" style="color:#f00 !important;"></i></span>
						<input type="password" class="form-control rounded-right" id="password" name="password" placeholder="Password" required="">
					</div>				
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-lock color-green" style="color:#f00 !important;"></i></span>
						<input type="password" class="form-control rounded-right" id="password_again" name="password_again" placeholder="Confirm Password" required="">
					</div>

					<div class="input-group margin-bottom-20 margin-bottom20">
						<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
						{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
					</div>

					<button type="submit" class="btn-u btn-block rounded"><i class="fa fa-spinner fa-pulse hide" id="loader"></i> Create new</button>

				{!! Form::close() !!}
				<div class="margin-top40">
					<h4>College Sign Up?</h4>
					<a href="{{ URL::to('/educational-institution') }}" target="_blank" class="btn btn-lg btn-info btn-block rounded">click here</a>
				</div>		
			</div>
		</div>
	</div>
</div><!--/container-->
<!--=== End Content Part ===-->

<!--=== Sticky Footer ===-->
{{-- <div class="container sticky-footer">
	<ul class="list-unstyled list-inline social-links margin-bottom-30">
		<li><a href="https://www.facebook.com/AdmissionX" target="_blank" title="Like &amp; Share with us on Facebook"><i class="icon-custom icon rounded-x icon-bg-u fa fa-facebook"></i></a></li>
		<li><a href="https://twitter.com/admission_x" target="_blank" title="Follow us on Twitter"><i class="icon-custom icon rounded-x icon-bg-u fa fa-twitter"></i></a></li>
		<li><a href="javascript:void(0);" title="Connect with us on LinkedIn"><i class="icon-custom icon rounded-x icon-bg-u fa fa-linkedin"></i></a></li>
	</ul>
	<p class="copyright-space">
		<i class="fa fa-envelope"></i> <a href="mailto:support@admissionx.info" target="_top" title="Email us anytime">support@admissionx.info</a> | <i class="fa fa-phone"></i> 011-4224-9249
	</p>
</div> --}}
<!--=== End Sticky Footer ===-->
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
	$('body').addClass('padding-bottom0');
	// $(".image-block").backstretch([
	// 	"assets/images/bg/1.jpg",
	// ]);
</script>
<script type="text/javascript">
	$('form').parsley();
</script>

@endsection