@extends('website/new-design-layouts.master')

@section('styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- CSS Page Style -->
{!! Html::style('assets/css/pages/page_log_reg_v3.css') !!}

<style type="text/css">
	.sky-form .state-error + em{margin-top: -20px !important; margin-bottom: 20px !important;color: #A52222 !important;}
	.parsley-errors-list{list-style: none !important; text-align: left !important; float: left !important; padding-left: 0px !important;}
	.parsley-custom-error-message{color: #A52222 !important; font-size: 11px;}
	.input-box-style{ border-color: rgba(255,255,255,0.7);  color: #fff;    background: transparent;    height: 45px;    border-radius: 5px;
    padding: 10px;}
    .input-box-style-black{ border-color: #f2f2f2;  color: #000;    background: transparent;    height: 45px;    border-radius: 5px;
    padding: 10px;}
    .input-box-style-border{border: 1px solid #f2f2f2 !important;color: #000; background: transparent; height: 45px; border-radius: 5px;
    padding: 10px;}
    input::-webkit-input-placeholder{color: #000 !important;}
	input:-moz-placeholder{color: #000 !important;} 
	input::-moz-placeholder{color: #000 !important;}
 	input:-ms-input-placeholder{color: #000 !important;}
    .sky-form-no-block{border: none !important;}

    .form-block .btn {text-transform: uppercase; font-size: 12px; padding-top: 12px; padding-bottom: 12px; }
    .colorbackground { background: #dddddd;  color: #555555; }

    .footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
</style>
@endsection

@section('content')
<div class="forms-wrapper">
	<div class="container content-md">
			<div class="margin-bottom-60 head">
				<h1>Login or Register an Account</h1>
				<!-- <p>Making higher education accessible, one admission at a time !</p> -->
			</div>

			<div class="row space-xlg-hor equal-height-columns">
				<!--login Block-->
				<div class="form-block login-block col-md-6 col-sm-12 rounded-left equal-height-column">
					<div class="form-block-header">
						<h2 class="margin-bottom-15">Sign In</h2>
						@if ($errors->any())
						    <div class="alert alert-danger alert-dismissable text-center">
						    	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						        @foreach ($errors->all() as $error)
						            {{ $error }}
						        @endforeach
					        </div>
						@endif
						<div >
							@if(Session::has('success'))
		                    <div class="alert alert-success alert-dismissible" id="dialog" role="alert">
		                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                            <span aria-hidden="true">&times;</span>
		                        </button>
		                        <strong>{{ Session::get('success') }}</strong>
		                    </div>                        
		                	@endif
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
					</div>


					{!! Form::open(['url' => 'user/doLogin', 'method' => 'POST','class' => 'reg-page detail-page-signup', 'data-parsley-validate' => '']) !!}

					<div class="margin-bottom-20">
						<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control input-box-style-border" name="email" placeholder="Email Address" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
					</div>

					<div class="margin-bottom-30">
						<input type="password" class="form-control input-box-style input-box-style-border" id="password" placeholder="Password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="">
					</div>

					<div class="margin-bottom-70">
						<button type="submit" class="btn-u btn-block rounded">Sign In</button>	
					</div>		
					
					<h4>Forget your Password ?</h4>
					<p>no worries, <a class="color-green" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="" href="">click here</a> to reset your password.</p>

					{!! Form::close() !!}

					
					<div class="social-login">
						<div class="or rounded-x">Or</div>
						<ul class="list-unstyled">
							<li>
								<a href="mailto:support@admissionx.info"><button class="btn rounded btn-block btn-lg btn-facebook-inversed margin-bottom-20 colorbackground"><i class="fa fa-envelope"></i> support@admissionx.info</button>
								</a>
								
							</li>							
						</ul>
					</div>
				</div>
				<!--End login Block-->

				<!--Reg Block-->
				<div class="form-block reg-block col-md-6 col-sm-12 rounded-right equal-height-column">
					<div class="form-block-header">
						<h2 class="margin-bottom-10">College Sign Up</h2>
						<!-- <p class="margin-bottom-20">Making higher education accessible, one admission at a time !</p> -->
					</div>

					{!! Form::open(['url' => 'quick-sign-up-action', 'method' => 'POST','class' => 'sky-form sky-form-no-block','role'=>'form', 'id'=>'sky-form3']) !!}
						<div class="duplicateEmaill text-info margin-top10 margin-bottom10"></div>
						<div class="margin-bottom-20">
							<input type="text" required="" class="form-control input-box-style-black" name="collegeName" placeholder="College Name" data-parsley-pattern="^[a-zA-Z\s .()-]*$" data-parsley-error-message="Please enter your valid college name" data-parsley-trigger="change">
						</div>

						<div class="margin-bottom-20">
							<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control input-box-style-black validateEmailAddress" name="email" placeholder="Email Address" data-parsley-type="email" >
							<p class="text-danger validateEmailAddressMsg hide">This email address is already exist with another user, try again with another email address.</p> 
						</div>

						<div class="margin-bottom-20">
							<input type="text" class="form-control input-box-style-black" name="contactNumber" placeholder="Contact Number" data-parsley-error-message="Please enter valid mobile number" data-parsley-type="digits" data-parsley-trigger="change" > <!-- data-parsley-maxlength="10" data-parsley-minlength="10" maxlength="10" data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10, 10]" -->
						</div>

						<div class="margin-bottom-20">
							<input type="password" class="form-control input-box-style-black" id="password1" name="password" placeholder="Password">
						</div>				

						<div class="margin-bottom-20">
							<input type="password" class="form-control input-box-style-black" id="password_again" name="password_again" placeholder="Confirm Password">
						</div>
						<div class="margin-bottom10">
							<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
							{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
						</div>

						<button type="submit" class="btn-u btn-block rounded btnValidate"><i class="fa fa-spinner fa-pulse hide" id="loader"></i> Create new</button>

					{!! Form::close() !!}


					<div class="margin-top40">
						<h4>Student Sign Up?</h4>
						<a href="{{ URL::to('/student-sign-up') }}" target="_blank" class="btn btn-lg btn-info btn-block rounded">click here</a>
					</div>		
				</div>
				<!--End Reg Block-->
			</div>
		</div><!--/container-->
</div>

<div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form  action="forget-password" method="POST" data-parsley-validate="">
      <div class="modal-header modal-header-design">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="recipient-name" class="control-label">Registered Email Address:</label>
            <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" id="recipient-name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-u">Send message</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection


@section('scripts')
{!! Html::script('assets/administrator/js/parsley.js') !!}
{!! Html::script('assets/js/forms/login.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.maskedinput.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js') !!}

<script type="text/javascript">
	jQuery(document).ready(function() {
		LoginForm.initLoginForm();
	});
</script>
<!-- <script type="text/javascript">
	$('#sky-form3').click(function(e){
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
		    return true;
		    //toastr.success('reCAPTCHA marked');
		    //this.form.submit();
		}
	});
</script>
 -->
<script type="text/javascript">
	$('.res-container .navbar-nav li').remove();
	var blogsMenu = '';
	blogsMenu += '<li><a href="education-blogs">Blogs</a></li>';
	$('.res-container .navbar-nav').html(blogsMenu);
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

<script type="text/javascript">
	$('#forgetPasswordModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('If your are unable to remember your password. Kindly help us to get you back.')
  modal.find('.modal-body input').val()
})

</script>

@endsection