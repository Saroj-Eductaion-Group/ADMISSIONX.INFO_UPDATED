<style type="text/css">
	.modalMain{ width: 450px !important; margin: 30px auto !important;}
	.close:hover{ color:#eee;}
	.modalbdymain{ background:url(/new-assets/img/login-bg-img.png) left top no-repeat;}
	.sky-form{ border:unset !important; }
	.registermain{ display: block;padding: 10px 20px 5px; background:url(/new-assets/img/register-bg-img.png) left top no-repeat; background-size:cover; }
    .stdntpopupmain{ padding:40px 0px;}   
    .stdntpopupTop{  background: url(/assets/images/homepage/loginpopup-bg1.png);}  
    .stdntpopupHeader{ border-bottom:unset !important; padding-top:0px !important; padding-bottom:0px !important;}
    .stdntdetailRight{ padding-right:4%; padding-top:15px; padding-left:4%;}
    .paracontent p{ font-size:16px; text-align:center; }
    .paracontent p a{ font-weight:600; }

    .paracontentsignup p{ font-size:16px; text-align:center; }
    .paracontentsignup p a{ font-size:16px; text-align:center; }
    .login-box ul li{ display: inline;}
    .login-box ul li a {font-family: open sans, serif; display: inline-block; background: #3b5998; color: #fff; font-size: 18px; margin-bottom: 15px;
        text-align: center; font-weight: 500; padding: 5px;}
    .login-box ul li a span { font-family: open sans, serif;}
    .login-box ul li a.active { background: #d40d12;}
	.loginDetailBox{box-shadow:#298baf 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}

	.login-box1 a {font-family: open sans, serif; display: inline-block; background: #3b5998; color: #fff; font-size: 18px; margin-bottom: 15px;
        text-align: center; font-weight: 500; padding: 5px;}
    .login-box1 a span { font-family: open sans, serif;}
    .login-box1 a.active { background: #d40d12;}
</style>

<!-- //Old Studebt Signup Modal 29-june-2020 -->
<?php
/*<div class="modal fade" id="signUpModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => 'student-sign-up-action','method' => 'POST','class' => 'sky-form studentSignUpProcess' ,'role'=>'form','id'=>'sky-form4', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
                <div class="modal-header modal-header-design" style="background:#d3070c;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Create new student account</h4>
                </div>
                <div class="registermain">
                    <div class="modal-body">
                        <p class="duplicateEmaill text-danger"></p>
                        <div class="margin-bottom-20">
                            <label class="text-center">For College Please <a href="{{ URL::to('educational-institution') }}" style="color: #d3070c;">Signup here</a></label>
                        </div>
                        <div class="margin-bottom-20">
                            <!-- <span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span> -->
                            <label>Suffix</label>
                            <select class="form-control rounded-right" name="suffix">
                                    <option value="" disabled selected>Select suffix</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Miss.">Miss.</option>
                                    <option value="Mrs.">Mrs.</option>
                            </select>
                        </div>
                        <div class="margin-bottom-20">
                            <!-- <span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span> -->
                            <label>First Name</label>
                            <input class="form-control rounded-right" type="text" name="firstName" placeholder="Enter first name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your first name" data-parsley-pattern="^[a-zA-Z\s .]*$" required="">
                        </div>
                        <div class="margin-bottom-20">
                            <!-- <span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span> -->
                            <label>Middle Name</label>
                            <input class="form-control" type="text" name="middleName" placeholder="Enter middle name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your middle name" data-parsley-pattern="^[a-zA-Z\s .]*$">
                        </div>
                        <div class="margin-bottom-20">
                            <!-- <span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span> -->
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="lastName" placeholder="Enter last name here" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter your last name" required="">
                        </div>
                        <div class="margin-bottom-20">
                            <!-- <span class="input-group-addon rounded-left"><i class="icon-envelope color-green"></i></span> -->
                            <label>Email</label>
                            <input class="form-control validateEmailAddress" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" placeholder="Enter email here" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
                            <p class="text-danger validateEmailAddressMsg hide">This email address is already exist with another user, try again with another email address.</p> 
                        </div>
                        <div class="margin-bottom-20">
                            <!-- <span class="input-group-addon rounded-left"><i class="icon-call-end color-green"></i></span> -->
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter phone number here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid phone number" required="" ><!-- data-parsley-pattern="^[7-9][0-9]{9}$" maxlength="10" data-parsley-length="[8, 11]"-->
                        </div>
                        <!-- <div class="margin-bottom-20">
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
                                    <div class="padding-top10  margin-bottom-20">
                                        <label>Parent Name</label>
                                        <input class="form-control rounded-right" type="text" name="parentsname" placeholder="Enter parent name here" data-parsley-error-message = "Please enter your parent name" data-parsley-trigger="change">
                                    </div>
                                    <label>
                                        <span class="text-info">(Please exclude country code before mobile number [For India : +91])</span>
                                    </label>
                                    <div class="margin-bottom-20">
                                        <label>Parent Phone No</label>
                                        <input type="text" class="form-control" name="parentsnumber" placeholder="Enter mobile number here" data-parsley-type ="digits" data-parsley-trigger="change" data-parsley-length="[8, 11]" data-parsley-error-message="Please enter valid mobile number" data-parsley-pattern="^[7-9][0-9]{9}$">
                                    </div>
                                </div>  
                            </div>
                        </div> -->
                        <div class="margin-bottom-20">
                            <label>Password</label>
                            <input type="password" class="form-control rounded-right" data-type="password" id="password1" name="password" placeholder="Password" required="" data-parsley-trigger="change" data-parsley-error-message="Please enter password minimum 6 character" minlength="6" >
                            <!-- data-parsley-minlength="6" data-parsley-min="6" -->
                        </div>              
                        <div class="margin-bottom-20">
                            <label>Confirm Password </label>
                            <input type="password" class="form-control rounded-right" data-type="password" id="password_again" name="password_again" placeholder="Confirm Password" data-parsley-trigger="change" data-parsley-equalto="#password1" data-equalto-message="Password doesn't match" required="" data-parsley-error-message="Password does not match" minlength="6"  >
                        </div>

                        <div class="row margin-bottom-20">
                            <div class="col-md-12">
                                <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
                                {!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn-u btn-block rounded"><i class="fa fa-spinner fa-pulse hide" id="loader"></i> Create new</button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>*/
?>

<!-- // After upgrade first login model design 29-june-2020 -->

<!-- <div class="modal fade" id="loginModalold" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md modalMain" role="document">
        <div class="modal-content" style="border:unset !important; border-radius:0px !important; ">
            <form  action="javascript:void(0);" method="POST" data-parsley-validate="" class="newLoginPopupWindow">
                <div class="modal-header modal-header-design" style="background: #d3070c;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Login to your account</h4>
                </div>
                <div class="modal-body modalbdymain">
                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide" id="dialog" role="alert">
                        <strong class="errorMessage"></strong>
                    </div>
                    <fieldset class="padding-top10">
                        <div class="control-group">
                            <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input required="" id="email" name="email" type="text" class="form-control input-medium" placeholder="Email">
                            </div>
                        </div>
                        <div class="control-group padding-top10">
                            <label class="control-label" for="passwordinput">Password:</label>
                            <div class="controls">
                                <input required="" id="passwordinput" name="password" class="form-control input-medium" type="password" placeholder="********">
                            </div>
                        </div>
                        <div class="form-group btn_group_divs loginer_btGroups margin-top20">
                            <button id="submit_loginn" class="login_btn_click" type="submit">Submit</button>
                            <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
                            <a href="javascript:void(0);" class="forgot_pass text-black" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="" href="">Forgot Password</a>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- END -->


<!-- //After upgrade blog bookmark login model 29-june-2020 -->
<!-- <div class="modal fade" id="loginModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md modalMain" role="document">
        <div class="modal-content">
            <form  action="javascript:void(0);" method="POST" data-parsley-validate="" class="homeLoginPopupWindow1">
                <div class="modal-header modal-header-design" style="background: #d3070c;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Login to your account</h4>
                </div>
                <div class="modal-body modalbdymain" style="padding-bottom:0px;">
                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide" id="dialog" role="alert">
                        <strong class="errorMessage"></strong>
                    </div>
                    <div class="ifNotLoggedInBlock"></div>
                    <div class="margin-bottom-10">
                        <label>Email</label>
                        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" placeholder="">                       
                    </div>
                    <div class="margin-bottom-10">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" placeholder="">
                    </div>              
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3"><button type="submit" class="btn-u rounded btn-block">Login</button></div>
                    </div>
                    <h4>Forget your Password ?</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <p>No worries, <a class="color-green" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="" href="">click here</a> to reset your password.</p>
                        </div>
                        <div class="col-md-4">
                            <p><a class="color-green" data-toggle="modal" data-target="#signUpModel" data-whatever="" href="">? New User Registration Here </a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->

<!-- If No Logged In Session For College Home Page -->
<!-- <div class="modal fade" id="loginModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md modalMain" role="document">
        <div class="modal-content">
            <form  action="javascript:void(0);" method="POST" data-parsley-validate="" class="homeLoginPopupWindow2">
                <div class="modal-header modal-header-design" style="background: #d3070c;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Login to your account</h4>
                </div>
                <div class="modal-body modalbdymain" style="padding-bottom:0px;">
                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide" id="dialog" role="alert">
                        <strong class="errorMessage"></strong>
                    </div>
                    <div class="ifNotLoggedInBlock"></div>
                    <div class="margin-bottom-10">
                        <label>Email</label>
                        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" placeholder="">                       
                    </div>
                    <div class="margin-bottom-10">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" placeholder="">
                    </div>              
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3"><button type="submit" class="btn-u rounded btn-block">Login</button></div>
                    </div>
                    <h4>Forget your Password ?</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <p>No worries, <a class="color-green" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="" href="">click here</a> to reset your password.</p>
                        </div>
                        <div class="col-md-4">
                            <p><a class="color-green" data-toggle="modal" data-target="#signUpModel" data-whatever="" href="">? New User Registration Here </a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
 --><!-- End -->

<!-- If No Logged In Session For COURSE Home Page -->
<!-- <div class="modal fade" id="loginModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md modalMain" role="document">
        <div class="modal-content">
            <form  action="javascript:void(0);" method="POST" data-parsley-validate="" class="homeLoginPopupWindow3">
                <div class="modal-header modal-header-design" style="background: #d3070c;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Login to your account</h4>
                </div>
                <div class="modal-body modalbdymain" style="padding-bottom:0px;">
                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide" id="dialog" role="alert">
                        <strong class="errorMessage"></strong>
                    </div>
                    <div class="ifNotLoggedInBlock"></div>
                    <div class="margin-bottom-10">
                        <label>Email</label>
                        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" placeholder="">                       
                    </div>
                    <div class="margin-bottom-10">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" placeholder="">
                    </div>              
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3"><button type="submit" class="btn-u rounded btn-block">Login</button></div>
                    </div>
                    <h4>Forget your Password ?</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <p>No worries, <a class="color-green" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="" href="">click here</a> to reset your password.</p>
                        </div>
                        <div class="col-md-4">
                            <p><a class="color-green" data-toggle="modal" data-target="#signUpModel" data-whatever="" href="">? New User Registration Here </a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- End -->