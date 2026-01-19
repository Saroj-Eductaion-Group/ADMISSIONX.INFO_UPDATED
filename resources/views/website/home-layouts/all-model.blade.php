<style type="text/css">
	.modalMain{ width: 450px !important; margin: 30px auto !important;}
	.close:hover{ color:#eee;}
	.modalbdymain{ border:unset !important; background:url(/new-assets/img/login-bg-img.png) left top no-repeat;}
	.sky-form{ border:unset !important; }
	.registermain{ display: block;padding: 10px 20px 5px; background:url(/new-assets/img/register-bg-img.png) left top no-repeat; background-size:cover; }
    .stdntpopupmain{ padding:40px 0px;}   
    .stdntpopupTop{  background: url(/assets/images/homepage/loginpopup-bg2.png); }  
    .stdntpopupHeader{ border-bottom:unset !important; padding-top:0px !important; padding-bottom:0px !important;}
    .stdntdetailRight{ padding-right:4%;}
    .paracontent p{ font-size:14px; text-align:center; padding-top:5px; }
    .paracontent p a{ font-weight:600; }

    .paracontentsignup p{ font-size:16px; text-align:center; }
    .paracontentsignup p a{ font-size:16px; text-align:center; }
    .login-box{ width:100px; margin:0 auto;}
    .login-box ul li{ display: inline;}
    .login-box ul li a {font-family: open sans, serif; display: inline-block; background: #3b5998; color: #fff; font-size: 18px; margin-bottom: 15px; width:40px; height:40px; line-height:40px;  
        text-align: center; font-weight: 500; border-radius:50px !important; }
    .login-box ul li a span { font-family: open sans, serif;}
    .login-box ul li a.active { background: #d40d12;}
	.loginDetailBox{box-shadow:#298baf 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}

	.login-box1 a {font-family: open sans, serif; display: inline-block; background: #3b5998; color: #fff; font-size: 18px; margin-bottom: 15px;
        text-align: center; font-weight: 500; padding: 5px;}
    .login-box1 a span { font-family: open sans, serif;}
    .login-box1 a.active { background: #d40d12;}

    .login-icon-top{ width: 100%;  float: left; padding-bottom:25px; }
    .login-icon-top ul{ list-style:none; margin:0px; padding:0px;}
    .login-icon-top ul li{ display:inline; font-size:14px; color:#000; text-transform: capitalize;  float: left; width: 33%; }

   
    @media screen and (max-width:767px) {
        
        .stdntsigninMn{ padding:0 10% !important;}
        .login-icon-top ul li{ width:48%; }
        .stdntdetailRight{ padding-right:unset; }
        .paracontent p{ font-size:13px; }
        .login-box{ padding-top:unset !important;}
    }

</style>

<div class="modal" id="loginModal" tabindex="-1" role="dialog">
    <div  class="modal-dialog modalLoginRegister" role="document">
        <div  class="modal-content stdntpopupTop">
            <div class="modal-header stdntpopupHeader">
                <button style="margin-top:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#f00;">×</span>
                </button>
            </div>
            <div class="modal-body login-bdy-model" style="padding:0px 15px 0px 0px !important;">
                <div class="row stdntsigninMn">
                  {{--   <div class="col-md-6 hidden-xs">
                        <img src="/assets/images/homepage/loginpopup-bg.png" style="width:100%;">
                    </div> --}}
                    <div class="col-md-11 col-xs-12 col-md-offset-1">
                        <div class="stdntdetailRight margin-right20">
                           <div class="modal-body popupModelbdy">
                           		<form  action="javascript:void(0);" method="POST" data-parsley-validate="" class="newLoginPopupWindow form-horizontal">
                                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide" id="dialog" role="alert">
				                        <strong class="errorMessage"></strong>
				                    </div>
                                    <div class="login-icon-top">
                                        <ul>
                                            <li>
                                                <i style="color:#ffb64d; font-size:17px;" class="fa fa-university"></i>
                                                study abroad
                                            </li>
                                            <li>
                                                <i style="color:#04cebb; font-size:17px;" class="fa fa-pencil"></i>
                                                Latest update
                                            </li>
                                            <li>
                                                <i style="color:#009899; font-size:17px;" class="fa fa-comments"></i>
                                                Q&A
                                            </li>
                                        
                                        </ul>
                                        <ul style="padding-top:34px !important;">
                                            <li>
                                                <i style="color:#bd6005; font-size:17px;" class="fa fa-graduation-cap"></i>
                                                colleges
                                            </li>
                                            <li>
                                                <i style="color:#ffb64d; font-size:17px;" class="fa fa-star"></i>
                                                reviews
                                            </li>
                                            <li>
                                                <i style="color:#312c2c; font-size:17px;" class="fa fa-sticky-note"></i>
                                                examination
                                            </li>

                                        </ul>
                                    </div>
                                    <div>
                                        <h2 style="font-family: 'Open Sans', sans-serif; font-size:30px; color:#000; text-align:center;  padding-top:20px;   font-weight:800;">Login</h2>
                                    </div>
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input required="" id="email" name="email" type="text" class="form-control input-medium" placeholder="Email" data-parsley-id="4">
                                            </div>
                                        </div>
                                        <div class="control-group padding-top15">
                                            <label class="control-label" for="passwordinput">Password:</label>
                                            <div class="controls">
                                                <input required="" id="passwordinput" name="password" class="form-control input-medium" type="password" placeholder="********" data-parsley-id="6">
                                            </div>
                                        </div>
                                        <div class="form-group btn_group_divs loginer_btGroups margin-top20">
                                        	<div class="row">
                                        		<div class="col-md-4">
                                            		<button id="submit_loginn" class="login_btn_click rounded" type="submit">Login</button>
                                        		</div>
                                        		<div class="col-md-8 paracontent">
                                        			<p>Forget Password? <a href="javascript:void(0);" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Click here</a></p>
                                        		</div>
                                        	</div>
                                            <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="login-box padding-top10">
                                    <ul>
                                        <li>
                                            <a class="btn-block rounded" href="{{ URL::to('/auth/facebook') }}">
                                                <i class="fa fa-facebook"></i>
                                                {{-- <span>Connect with Facebook</span> --}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn-block rounded active" href="{{ URL::to('/auth/google') }}">
                                                <i class="fa fa-google-plus"></i>
                                                {{-- <span>Connect with Google</span> --}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
		                        <div class="paracontent">
		                            <p>Don't Have Account? Student Sign Up? <a href="{{ URL::to('/student-sign-up') }}" target="_blank">click here</a></p>
                                    <p>College profile login & signup? <a href="{{ URL::to('/educational-institution') }}" target="_blank">click here</a></p>
		                        </div>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- College Profile Update -->
<!-- Login 2 -->
<div class="modal fade profileUpdateNow updateProfileBlock" id="profileUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header modal-header-design" style="background: #d3070c;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">
					AdmissionX
				</h4>
			</div>
			<div class="modal-body text-center">
		        <h4 class="profileUpdateMessage"></h4>
		    </div>
		</div>
	</div>
</div>
<!-- End -->

<!-- If No Logged In Session -->
<div class="modal fade" id="loginModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modalLoginRegister" role="document">
        <div class="modal-content stdntpopupTop">
            <div class="modal-header stdntpopupHeader">
                <button style="margin-top:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#f00;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding:0px 0px 35px 0px !important;">
                <div class="row stdntsigninMn">
                    <div class="col-md-11 col-xs-12 col-md-offset-1">
                        <div class="stdntdetailRight margin-right20">
                           <div class="modal-body popupModelbdy">
                           		<form  action="javascript:void(0);" method="POST" data-parsley-validate="" class="homeLoginPopupWindow1 form-horizontal">
                                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide" id="dialog" role="alert">
				                        <strong class="errorMessage"></strong>
				                    </div>
                    				<div class="ifNotLoggedInBlock"></div>
                                    <div class="login-icon-top">
                                        <ul>
                                            <li>
                                                <i style="color:#ffb64d; font-size:17px;" class="fa fa-university"></i>
                                                study abroad
                                            </li>
                                            <li>
                                                <i style="color:#04cebb; font-size:17px;" class="fa fa-pencil"></i>
                                                Latest update
                                            </li>
                                            <li>
                                                <i style="color:#009899; font-size:17px;" class="fa fa-comments"></i>
                                                Q&A
                                            </li>
                                        
                                        </ul>
                                        <ul style="padding-top:34px !important;">
                                            <li>
                                                <i style="color:#bd6005; font-size:17px;" class="fa fa-graduation-cap"></i>
                                                colleges
                                            </li>
                                            <li>
                                                <i style="color:#ffb64d; font-size:17px;" class="fa fa-star"></i>
                                                reviews
                                            </li>
                                            <li>
                                                <i style="color:#312c2c; font-size:17px;" class="fa fa-sticky-note"></i>
                                                examination
                                            </li>

                                        </ul>
                                    </div>
                                    <div>
                                        <h2 style="font-family: 'Open Sans', sans-serif; font-size:30px; color:#000; text-align:center;  padding-top:20px;   font-weight:800;">Login</h2>
                                    </div>
                                    <fieldset class="padding-top10">
                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
												<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control input-medium" name="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" placeholder="email address">
                                            </div>
                                        </div>
                                        <div class="control-group padding-top15">
                                            <label class="control-label" for="passwordinput">Password:</label>
                                            <div class="controls">
												<input type="password" class="form-control input-medium" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="form-group btn_group_divs loginer_btGroups margin-top20">
                                        	<div class="row">
                                        		<div class="col-md-4">
                                            		<button id="submit_loginn" class="login_btn_click rounded" type="submit">Login</button>
                                        		</div>
                                        		<div class="col-md-8 paracontent">
                                        			<p>Forget Password? <a href="javascript:void(0);" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Click here</a></p>
                                        		</div>
                                        	</div>
                                            <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="login-box padding-top10">
                                    <ul>
                                        <li>
                                            <a class="btn-block rounded" href="{{ URL::to('/auth/facebook') }}">
                                                <i class="fa fa-facebook"></i>
                                                {{-- <span>Connect with Facebook</span> --}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn-block rounded active" href="{{ URL::to('/auth/google') }}">
                                                <i class="fa fa-google-plus"></i>
                                                {{-- <span>Connect with Google</span> --}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

		                        <div class="paracontent">
		                            <p>Don't Have Account? Student Sign Up? <a href="{{ URL::to('/student-sign-up') }}" target="_blank">click here</a></p>
                                    <p>College profile login & signup? <a href="{{ URL::to('/educational-institution') }}" target="_blank">click here</a></p>
		                        </div>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- If No Logged In Session For College Home Page -->
<div class="modal fade" id="loginModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modalLoginRegister" role="document">
        <div class="modal-content stdntpopupTop">
            <div class="modal-header stdntpopupHeader">
                <button style="margin-top:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#f00;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding:0px 0px 35px 0px !important;">
                <div class="row stdntsigninMn">
                    <div class="col-md-11 col-xs-12 col-md-offset-1">
                        <div class="stdntdetailRight margin-right20">
                           <div class="modal-body popupModelbdy">
                           		<form  action="javascript:void(0);" method="POST" data-parsley-validate="" class="homeLoginPopupWindow2 form-horizontal">
                                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide" id="dialog" role="alert">
				                        <strong class="errorMessage"></strong>
				                    </div>
				                    <div class="ifNotLoggedInBlock"></div>
                                    <div class="login-icon-top">
                                        <ul>
                                            <li>
                                                <i style="color:#ffb64d; font-size:17px;" class="fa fa-university"></i>
                                                study abroad
                                            </li>
                                            <li>
                                                <i style="color:#04cebb; font-size:17px;" class="fa fa-pencil"></i>
                                                Latest update
                                            </li>
                                            <li>
                                                <i style="color:#009899; font-size:17px;" class="fa fa-comments"></i>
                                                Q&A
                                            </li>
                                        
                                        </ul>
                                        <ul style="padding-top:34px !important;">
                                            <li>
                                                <i style="color:#bd6005; font-size:17px;" class="fa fa-graduation-cap"></i>
                                                colleges
                                            </li>
                                            <li>
                                                <i style="color:#ffb64d; font-size:17px;" class="fa fa-star"></i>
                                                reviews
                                            </li>
                                            <li>
                                                <i style="color:#312c2c; font-size:17px;" class="fa fa-sticky-note"></i>
                                                examination
                                            </li>

                                        </ul>
                                    </div>
                                    <div>
                                        <h2 style="font-family: 'Open Sans', sans-serif; font-size:30px; color:#000; text-align:center;  padding-top:20px;   font-weight:800;">Login</h2>
                                    </div>
                                    <fieldset class="padding-top10">
                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control input-medium" name="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" placeholder="email address">	
                                            </div>
                                        </div>
                                        <div class="control-group padding-top15">
                                            <label class="control-label" for="passwordinput">Password:</label>
                                            <div class="controls">
                                                <input type="password" class="form-control input-medium" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="form-group btn_group_divs loginer_btGroups margin-top20">
                                        	<div class="row">
                                        		<div class="col-md-4">
                                            		<button id="submit_loginn" class="login_btn_click rounded" type="submit">Login</button>
                                        		</div>
                                        		<div class="col-md-8 paracontent">
                                        			<p>Forget Password? <a href="javascript:void(0);" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Click here</a></p>
                                        		</div>
                                        	</div>
                                            <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="login-box padding-top10">
                                    <ul>
                                        <li>
                                            <a class="btn-block rounded" href="{{ URL::to('/auth/facebook') }}">
                                                <i class="fa fa-facebook"></i>
                                                {{-- <span>Connect with Facebook</span> --}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn-block rounded active" href="{{ URL::to('/auth/google') }}">
                                                <i class="fa fa-google-plus"></i>
                                                {{-- <span>Connect with Google</span> --}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

		                        <div class="paracontent">
		                            <p>Don't Have Account? Student Sign Up? <a href="{{ URL::to('/student-sign-up') }}" target="_blank">click here</a></p>
                                    <p>College profile login & signup? <a href="{{ URL::to('/educational-institution') }}" target="_blank">click here</a></p>
		                        </div>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- If No Logged In Session For COURSE Home Page -->
<div class="modal fade" id="loginModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modalLoginRegister" role="document">
        <div class="modal-content stdntpopupTop">
            <div class="modal-header stdntpopupHeader">
                <button style="margin-top:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#f00;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding:0px 0px 35px 0px !important;">
                <div class="row stdntsigninMn">
                    <div class="col-md-11 col-xs-12 col-md-offset-1">
                        <div class="stdntdetailRight margin-right20">
                           <div class="modal-body popupModelbdy">
                           		<form  action="javascript:void(0);" method="POST" data-parsley-validate="" class="homeLoginPopupWindow3 form-horizontal">
                                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide" id="dialog" role="alert">
				                        <strong class="errorMessage"></strong>
				                    </div>
				                    <div class="ifNotLoggedInBlock"></div>
                                    <div class="login-icon-top">
                                        <ul>
                                            <li>
                                                <i style="color:#ffb64d; font-size:17px;" class="fa fa-university"></i>
                                                study abroad
                                            </li>
                                            <li>
                                                <i style="color:#04cebb; font-size:17px;" class="fa fa-pencil"></i>
                                                Latest update
                                            </li>
                                            <li>
                                                <i style="color:#009899; font-size:17px;" class="fa fa-comments"></i>
                                                Q&A
                                            </li>
                                        
                                        </ul>
                                        <ul style="padding-top:34px !important;">
                                            <li>
                                                <i style="color:#bd6005; font-size:17px;" class="fa fa-graduation-cap"></i>
                                                colleges
                                            </li>
                                            <li>
                                                <i style="color:#ffb64d; font-size:17px;" class="fa fa-star"></i>
                                                reviews
                                            </li>
                                            <li>
                                                <i style="color:#312c2c; font-size:17px;" class="fa fa-sticky-note"></i>
                                                examination
                                            </li>

                                        </ul>
                                    </div>
                                    <div>
                                        <h2 style="font-family: 'Open Sans', sans-serif; font-size:30px; color:#000; text-align:center;  padding-top:20px;   font-weight:800;">Login</h2>
                                    </div>
                                    <fieldset class="padding-top10">
                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                            	<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control input-medium" name="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="control-group padding-top15">
                                            <label class="control-label" for="passwordinput">Password:</label>
                                            <div class="controls">
												<input type="password" class="form-control input-medium" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="form-group btn_group_divs loginer_btGroups margin-top20">
                                        	<div class="row">
                                        		<div class="col-md-4">
                                            		<button id="submit_loginn" class="login_btn_click rounded" type="submit">Login</button>
                                        		</div>
                                        		<div class="col-md-8 paracontent">
                                        			<p>Forget Password? <a href="javascript:void(0);" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Click here</a></p>
                                        		</div>
                                        	</div>
                                            <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="login-box padding-top10">
                                    <ul>
                                        <li>
                                            <a class="btn-block rounded" href="{{ URL::to('/auth/facebook') }}">
                                                <i class="fa fa-facebook"></i>
                                                {{-- <span>Connect with Facebook</span> --}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn-block rounded active" href="{{ URL::to('/auth/google') }}">
                                                <i class="fa fa-google-plus"></i>
                                                {{-- <span>Connect with Google</span> --}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

		                        <div class="paracontent">
		                            <p>Don't Have Account? Student Sign Up? <a href="{{ URL::to('/student-sign-up') }}" target="_blank">click here</a></p>
                                    <p>College profile login & signup? <a href="{{ URL::to('/educational-institution') }}" target="_blank">click here</a></p>
		                        </div>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- Forget Password -->
<div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modalMain" role="document">
		<div class="modal-content modalbdymain">
			<form  action="/forget-password" method="POST" data-parsley-validate="">
				<div class="modal-header modal-header-design" style="background: #d3070c;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;" >If your are unable to remember your password. Kindly help us to get you back.</h4>
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
<!-- End -->

<!-- Quick Sign for Student -->
<div class="modal fade" id="signUpModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(['url' => '/student-sign-up-action','method' => 'POST','class' => 'sky-form studentSignUpProcess' ,'role'=>'form','id'=>'sky-form4', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}

				<div class="modal-header modal-header-design" style="background: #d3070c;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Create new student account</h4>
				</div>
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
							<input type="text" class="form-control rounded" name="phone" placeholder="Enter phone number here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid phone number" ><!--data-parsley-length="[8, 11]"  data-parsley-pattern="^[7-9][0-9]{9}$" required="" maxlength="10" -->
						</div>
					</div>
					
					<!-- <div class="margin-bottom-10">
						<label>Gender</label>
						<select name="gender" class="form-control">
	                        <option value="" selected disabled >Select Gender</option>
	                        <option value="Male">Male</option>
	                        <option value="Female">Female</option>
                            <option value="Other">Other</option>
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
						<label class="text-center">For College Please <a href="{{ URL::to('/educational-institution') }}" style="color: #18BA98;">Signup here</a></label>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<!-- End -->

<!-- Start Magnific POPUP IF COLLEGE/ADMIN/EMPLOYEE TRYING TO ADD BOOKMARKS -->
<div class="ajax-response-bookmarked-action white-popup hide">
	<h3 class=" text-center bookmarkedMessage"></h3>
</div>