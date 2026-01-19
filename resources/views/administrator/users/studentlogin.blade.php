@extends('website/new-design-layouts.master')
 

@section('styles')
<!-- CSS Page Style -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	.footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
    .login-box1 a {font-family: open sans, serif; display: inline-block; background: #3b5998; color: #fff; font-size: 18px; margin-bottom: 15px;
        text-align: center; font-weight: 500; padding: 5px;}
    .login-box1 a span { font-family: open sans, serif;}
    .login-box1 a.active { background: #d40d12;}
    .background-form {background: url(1.jpg) 50% fixed;padding: 60px 0;position: relative;background-size: cover;}
</style>
@endsection

@section('content')
<!--=== Content Part ===-->
<div class="background-form">
	<div class="container content margin-top0">
		<!-- Session block -->
		<div >
			@if(Session::has('checkEmailSucess'))
	        <div class="alert alert-success alert-dismissible" id="dialog" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	            <strong>{{ Session::get('checkEmailSucess') }}</strong>
	        </div>
	    	@endif
		</div>
		<div >
			@if(Session::has('returnBackSignup'))
	        <div class="alert alert-danger alert-dismissible" id="dialog" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	            <strong>{{ Session::get('returnBackSignup') }}</strong>
	        </div>
	    	@endif
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('confirmDisabledEmail'))
					<div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('confirmDisabledEmail') }}
                    </div>
            	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('confirmBlockedEmail'))
					<div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('confirmBlockedEmail') }}
                    </div>
            	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('verifiedEmail'))
					<div class="alert alert-success alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('verifiedEmail') }}
                    </div>
            	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('confirmEmail'))
					<div class="alert alert-success alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('confirmEmail') }}
                        <br>
                        <a href="{{ url('resend-email-link', Session::get('emailAdd')) }}" class="btn btn-sm btn-u margin-top10 margin-bottom10" title="Resend email now">Resend Email Now</a>
                    </div>
            	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('pleaseVierfyYourEmail'))
					<div class="alert alert-warning alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('pleaseVierfyYourEmail') }}
                    </div>
            	@endif
			</div>
		</div>
		<!-- End Sessio Block -->
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				{!! Form::open(['url' => 'student/doLogin', 'method' => 'POST','class' => 'reg-page detail-page-signup', 'data-parsley-validate' => '']) !!}
					<input type="hidden" name="collegemasterId" value="{{ $collegemasterId }}">
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
					<div class="reg-header">
						<div class="reg-header">
							<a href="{{ URL::to('/') }}">
								<img class="img-responsive" src="{{asset('assets/images/logo.png')}}" alt="Admission X">
							</a>
						</div>

						<h2>Login to your account</h2>
						@if ($errors->any())
						    <div class="alert alert-danger alert-dismissable text-center">
						    	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						        @foreach ($errors->all() as $error)
						            {{ $error }}
						        @endforeach
					        </div>
						@endif
					</div>
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
					<div class="margin-bottom-10">
						<label>Email</label>
						<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control rounded" name="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" placeholder="">			
					</div>
					<div class="margin-bottom-10">
						<label>Password</label>
						<input type="password" class="form-control rounded" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" placeholder="">
					</div>				
					<button type="submit" class="btn-u btn-block rounded">Login</button>
					<div>
                    	<p class="text-center margin-top10"><span class="dot">or</span></p>
                    </div>
					<div class="login-box">
                        <ul>
                            <li>
                                <a class="btn-block rounded" href="{{ URL::to('/auth/facebook') }}">
                                    <i class="fa fa-facebook padding-right10"></i>
                                    <span>Connect with Facebook</span>
                                </a>
                            </li>
                            <li>
                                <a class="btn-block rounded active" href="{{ URL::to('/auth/google') }}">
                                    <i class="fa fa-google-plus padding-right10"></i>
                                    <span>Connect with Google</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <h4>Forget your Password ? <a class="color-green" data-toggle="modal" data-target="#forgetPasswordModal1" data-whatever="" href="">click here</a></h4>
                    <p>Don't Have Account? Click<a class="color-green" data-toggle="modal" data-target="#studentSignUpModel" data-whatever="" href=""> Sign Up </a> to registration.</p>
					<!-- <h4>Forget your Password ?</h4>
					<div class="row">
						<div class="col-md-8">
							<p>No worries, <a class="color-green" data-toggle="modal" data-target="#forgetPasswordModal1" data-whatever="" href="">click here</a> to reset your password.</p>
						</div>
						<div class="col-md-4">
							<p><a class="color-green" data-toggle="modal" data-target="#studentSignUpModel" data-whatever="" href="">? New User Registration Here </a></p>
						</div>
					</div> -->
				{!! Form::close() !!}				
			</div>
		</div><!--/row-->
	</div>
</div>

<div class="modal fade" id="forgetPasswordModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modalMain" role="document">
    <div class="modal-content modalbdymain">
      <form  action="/forget-password" method="POST" data-parsley-validate="">
      <div class="modal-header modal-header-design" style="background: #d3070c;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        	<input type="hidden" name="collegemasterId" value="{{ $collegemasterId }}">
			<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Registered Email Address:</label>
            <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" class="form-control rounded" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" id="recipient-name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default rounded" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-u rounded">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--/container-->
<!--=== End Content Part ===-->
<!-- Quick Sign for Student -->
<div class="modal fade" id="studentSignUpModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(['url' => '/student-apply-course-signup','method' => 'POST','class' => 'sky-form studentApplyCourseSignUpProcess' ,'role'=>'form','id'=>'', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
				<div class="modal-header modal-header-design" style="background: #d3070c;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Create new student account</h4>
				</div>
				<input type="hidden" name="collegemasterId" value="{{ $collegemasterId }}">
				<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
				<p class="duplicateEmaill text-danger"></p>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						@if(Session::has('captchaError'))
							<div class="alert alert-danger alert-dismissable text-center">
		                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                        {{ Session::get('captchaError') }}                        
		                    </div>
		            	@endif
					</div>
				</div>
				<div class="modal-body">
					<div class="row margin-bottom10">
						<div class="col-md-6">
							<label>Suffix</label> 
							<select class="form-control rounded" name="suffix">
                                <option value="" disabled selected>Select suffix</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Mrs.">Mrs.</option>
	                        </select>
						</div>
						<div class="col-md-6">
							<label>First Name</label>
							<input class="form-control rounded" type="text" name="firstName" placeholder="Enter first name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your first name" data-parsley-pattern="^[a-zA-Z\s .]*$" required="">
						</div>
					</div>

					<div class="row margin-bottom10">
						<div class="col-md-6">
							<label>Middle Name</label>
							<input class="form-control rounded" type="text" name="middleName" placeholder="Enter middle name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your middle name" data-parsley-pattern="^[a-zA-Z\s .]*$">
						</div>
						<div class="col-md-6">
							<label>Last Name</label>
							<input class="form-control rounded" type="text" name="lastName" placeholder="Enter last name here" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter your last name" required="">
						</div>
					</div>
					<div class="row margin-bottom10">
						<div class="col-md-6">
							<label>Email</label>
							<input class="form-control rounded validateEmailAddress" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" placeholder="Enter email here" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
							<p class="text-danger validateEmailAddressMsg hide">This email address is already exist with another user, try again with another email address.</p> 
						</div>
						<div class="col-md-6">
							<label>Mobile Number</label>
							<input type="text" class="form-control rounded" name="phone" placeholder="Enter phone number here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid phone number" data-parsley-maxlength="10" data-parsley-minlength="10" maxlength="10" data-parsley-pattern="^[6-9][0-9]{9}$" data-parsley-length="[10, 10]"><!--data-parsley-length="[8, 11]"  data-parsley-pattern="^[7-9][0-9]{9}$" required="" maxlength="10" -->
						</div>
					</div>
					
					<!-- <div class="margin-bottom-10">
						<label>Gender</label>
						<select name="gender" class="form-control">
	                        <option value="" selected disabled >Select Gender</option>
	                        <option value="Male">Male</option>
	                        <option value="Female">Female</option>
	                    </select>
					</div> -->
				    <!-- <div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<div class=" ">
								<label>Date Of Birth</label>
								<input type="date" class="form-control" id="dateChange" name="dateofbirth" placeholder="Enter date of birth here"  data-parsley-error-message = "Please enter your date of birth"  data-parsley-trigger="change">
							</div>
							<label class="text-primary">Age as on {!! date('d-m-Y') !!} : </label>
							<label class="text-primary calculatedDateFromNow"></label>

							<div class="hide gurdianBlock">
								<div class="padding-top10  margin-bottom-10">
									<label>Parent Name</label>
									<input class="form-control rounded" type="text" name="parentsname" placeholder="Enter parent name here" data-parsley-error-message = "Please enter your parent name" data-parsley-trigger="change">
								</div>
								<label>
									<span class="text-info">(Please exclude country code before mobile number [For India : +91])</span>
								</label>
								<div class="margin-bottom-10">
									<label>Parent Phone No</label>
									<input type="text" class="form-control" name="parentsnumber" placeholder="Enter mobile number here" data-parsley-type ="digits" data-parsley-trigger="change" data-parsley-length="[8, 11]" data-parsley-error-message="Please enter valid mobile number" data-parsley-pattern="^[7-9][0-9]{9}$">
								</div>
							</div>	
						</div>
					</div> -->
					<div class="row margin-bottom10">
						<div class="col-md-6">
							<label>Password</label>
							<input type="password" class="form-control rounded" data-type="password" id="password1" name="password" placeholder="Password" required="" data-parsley-trigger="change" data-parsley-error-message="Please enter password minimum 6 character" minlength="6" >
							<!-- data-parsley-minlength="6" data-parsley-min="6" -->
						</div>
						<div class="col-md-6">
							<label>Confirm Password </label>
							<input type="password" class="form-control rounded" data-type="password" id="password_again" name="password_again" placeholder="Confirm Password" data-parsley-trigger="change" data-parsley-equalto="#password1" data-equalto-message="Password doesn't match" required="" data-parsley-error-message="Password does not match" minlength="6"  >
						</div>
					</div>
					<div class="row margin-bottom-10">
						<div class="col-md-12">
							<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
							{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>

					<div class="row margin-top10">
						<div class="col-md-6 col-md-offset-3">
							<button type="submit" class="btn-u btn-block rounded btnValidate"><i class="fa fa-spinner fa-pulse hide" id="loader"></i> Create new</button>
						</div>
					</div>
					<div>
                    	<p class="text-center margin-top10"><span class="dot">or</span></p>
                    </div>
                    <div class="row login-box1">
                    	<div class="col-md-6">
                            <a class="btn-block rounded" href="{{ URL::to('/auth/facebook') }}">
                                <i class="fa fa-facebook padding-right10"></i>
                                <span>Connect with Facebook</span>
                            </a>
                    	</div>
                    	<div class="col-md-6">
                            <a class="btn-block rounded active" href="{{ URL::to('/auth/google') }}">
                                <i class="fa fa-google-plus padding-right10"></i>
                                <span>Connect with Google</span>
                            </a>
                    	</div>
                    </div>
                    <div class="margin-top-10 text-center">
						<label class="text-center">For College Please <a href="{{ URL::to('educational-institution') }}" style="color: #18BA98;">Signup here</a></label>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<!--=== Sticky Footer ===-->
<!-- <div class="container sticky-footer">
	<ul class="list-unstyled list-inline social-links margin-bottom-30">
		<li><a href="https://www.facebook.com/AdmissionX" target="_blank" title="Like &amp; Share with us on Facebook"><i class="icon-custom icon rounded-x icon-bg-u fa fa-facebook"></i></a></li>
		<li><a href="https://twitter.com/admission_x" target="_blank" title="Follow us on Twitter"><i class="icon-custom icon rounded-x icon-bg-u fa fa-twitter"></i></a></li>
		<li><a href="javascript:void(0);" title="Connect with us on LinkedIn"><i class="icon-custom icon rounded-x icon-bg-u fa fa-linkedin"></i></a></li>
	</ul>
	<p class="copyright-space">
		<i class="fa fa-envelope"></i> <a href="mailto:support@admissionx.info" target="_top" title="Email us anytime">support@admissionx.info</a> | <i class="fa fa-phone"></i> 011-4224-9249
	</p>
</div> -->
<!--=== End Sticky Footer ===-->
@endsection


@section('scripts')
<script type="text/javascript" src="/home-layout/assets/plugins/backstretch/jquery.backstretch.min.js"></script>
{!! Html::script('assets/js/forms/login.js') !!}
<script type="text/javascript">
	// $('.btnValidate').click(function(e){
	// 	e.preventDefault();
	//   	var $captcha = $('#recaptcha'),
	//     response = grecaptcha.getResponse();
	// 	if (response.length === 0) {
	// 		toastr.error('reCAPTCHA is mandatory');
	// 	    $( '.msg-error').text( "reCAPTCHA is mandatory" );
	// 	    if( !$captcha.hasClass( "error" ) ){
	// 	      $captcha.addClass( "error" );
	// 	    }
	// 	    return false;
	// 	}else{
	// 	    $('.msg-error').text('');
	// 	    $captcha.removeClass( "error" );
	// 	    //toastr.success('reCAPTCHA marked');
	// 	    this.form.submit();
	// 	}
	// });
</script>

<script type="text/javascript">
	//AJAX
	$( '.studentApplyCourseSignUpProcess' ).submit(function(e) {
  		e.preventDefault();
  		//VALIDATE FORM SUBMISSION
  		if( $(this).find('input[name=firstName]').val() == ''){
  			return false;
  		}else if($(this).find('input[name=lastName]').val() == ''){
  			return false;
  		}else if( $(this).find('input[name=email]').val() == ''){
  			return false;
  		}else if( $(this).find('#password1').val() == ''){
			return false;
		}else if( $(this).find('#password_again').val() == ''){
			return false;
  		}else if( $(this).find('#password1').val() == $(this).find('#password_again').val() ){
  			var form = $(this).serialize();
	  		$.ajax({
		        type: "POST",
		        url: '{{ URL::to("/student-apply-course-signup") }}',
		        data: form,
		        success: function(data){
		            if( data.code =='200' ){
		            	window.location.href="/student-detail-sign-up/"+data.slug;
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
	$('body').addClass('padding-bottom0');
	// $(".image-block").backstretch([
	// 	"assets/images/bg/1.jpg",
	// ]);
</script>
<script type="text/javascript">
	$('#forgetPasswordModal1').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('If your are unable to remember your password. Kindly help us to get you back.')
  modal.find('.modal-body input').val()
})

</script>
<script type="text/javascript">
	// $(".alert").fadeTo(10000, 500).slideUp(500, function(){
	//     $(".alert").alert('close');
	// });
</script>
<script type="text/javascript">
    window.onload = function() {
	    var $recaptcha = document.querySelector('#g-recaptcha-response');

	    if($recaptcha) {
	        $recaptcha.setAttribute("required", "required");
	    }
  	};
</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		App.init();
	});
</script>
<script type="text/javascript">
	$.backstretch([
		"/assets/img/bg/11.jpg",
		"/assets/img/bg/19.jpg",
		"/assets/css/1.jpg",
		"/assets/img/main/img12.jpg",
		], {
			fade: 1000,
			duration: 7000
		});
</script>
@endsection