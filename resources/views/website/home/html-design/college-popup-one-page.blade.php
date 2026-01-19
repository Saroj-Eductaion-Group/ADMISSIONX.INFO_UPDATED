@extends('website/new-design-layouts.master')

@section('content')

<style type="text/css">
	.college-pop-left-main{ background: url(/assets/images/homepage/college-pop-bg.png);
	 padding:50px 0px;  background-size:cover; }
	.college-pop-left-top{ width: 76%; background: #f7fff9; padding:60px 70px; margin-left: 35%;
    border-radius: 4px;  box-shadow: #e2e2e2 0 0 10px; }
	.college-input-fd{ padding: 0px; border-bottom:#e7e7e7 solid 1px; border-top:unset; border-left:unset;   background: unset; border-right:unset; color:#000; 
		margin-bottom:10px; }
	.college-input-fd:focus{ border-bottom:#e7e7e7 solid 1px; box-shadow:none; }	
	.college-input-fd::-webkit-input-placeholder{ color:#000; font-size:15px;}
	.dot1 { height: 33px; line-height: 33px; width: 33px; background-color: #6dabe4;  border-radius: 50%;
    display: inline-block; color: #fff; font-weight: bold;}
	.login-box ul li { display: inline;	}
	.login-box ul li a { border-radius:4px; font-family: open sans, serif;  display: inline-block; background: #3b5998; color: #fff; font-size: 16px; margin-bottom: 15px; text-align: center;  font-weight: 500; padding: 5px;}
	.login-box ul li a span {  font-family: open sans, serif;}
	.login-box ul li a.active {  background: #d40d12;}
	.college-signin{ padding-bottom:25px; }
	.college-signin h2{ font-size: 35px; color: #000; text-align: center;  
	font-weight: 800; }
	.college-pop-right-top{  padding:110px 10% 0 20%;}
	.studentsignUp p{ color:#000; font-size:16px; }

@media only screen and (max-width:767px)
{
.college-pop-left-top{ width:100%; margin-left:unset; }
.college-pop-left-main{ background:unset;  }
.college-pop-right-top{ padding: 0px 0% 50px 0%;}
}



</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 college-pop-left-main">
			<div class="college-pop-left-top">
				<div class="college-signin">
						<h2>Sign in</h2>
					</div>
				<form>
					<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" id="email" class="form-control college-input-fd" name="email" placeholder="Email Address" required="required">
					<input type="password" class="form-control college-input-fd" id="password" placeholder="Password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" data-parsley-id="6">
					<button type="submit" class="btn-u btn-block rounded margin-top10">Sign In</button>
					<a style="display:block; padding-top:15px;  font-size:16px; font-weight:600;" href="javascript:void(0);" class="forgot_pass text-black" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Forgot Password</a>	
					<div class="">
						<p class="text-center margin-top10 margin-bottom20"><span class="dot1">or</span></p>
					</div>
					<div class="login-box padding-top10">
						<ul>
							<li>
								<a class="btn-block" href="javascript:void(0);">
									<i class="fa fa-facebook padding-right10"></i>
									<span>Connect with Facebook</span>
								</a>
							</li>
							<li>
								<a class="btn-block active" href="javascript:void(0);">
									<i class="fa fa-google-plus padding-right10"></i>
									<span>Connect with Google</span>
								</a>
							</li>
						</ul>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="college-pop-right-top">
				<div class="college-signin">
					<h2>Sign Up</h2>
				</div>
				<form>
					<input type="collage" id="collage" class="form-control college-input-fd" name="collage" placeholder="Collage Name" required="required">
					<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" id="email" class="form-control college-input-fd" name="email" placeholder="Email Address" required="required">
					<input type="contact" id="contact" class="form-control college-input-fd" name="contact" placeholder="Contact Number" required="required">
					<input type="password" class="form-control college-input-fd" id="password" placeholder="Password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" data-parsley-id="6">
					
					<input type="password" class="form-control college-input-fd" id="password" placeholder="confirm Password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" data-parsley-id="6">

					<button type="submit" class="btn-u btn-block rounded margin-top10">Submit</button>
				</form>
				<div class="studentsignUp">
					<p class="margin-top20">Student Sign Up?</p>
					<button type="submit" class="btn-u btn-block rounded ">Click Here</button>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('scripts')


@endsection