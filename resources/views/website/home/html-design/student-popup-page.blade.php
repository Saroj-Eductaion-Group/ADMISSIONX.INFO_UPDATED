
@extends('website/new-design-layouts.master')

@section('content')

<style type="text/css">
    .stdntpopupmain{ padding:40px 0px;}   
    .stdntpopupTop{  background: url(/assets/images/homepage/loginpopup-bg1.png);}  
    .stdntpopupHeader{ border-bottom:unset !important; padding-top:0px !important; padding-bottom:0px !important;}
    .stdntdetailRight{ padding-right:4%; padding-top:30px;}
    .paracontent p{ font-size:16px; text-align:center; }
    .paracontent p a{ font-weight:600; }

    .paracontentsignup p{ font-size:16px; text-align:center; }
    .paracontentsignup p a{ font-size:16px; text-align:center; }
    .login-box ul li{ display: inline;}
    .login-box ul li a {font-family: open sans, serif; display: inline-block; background: #3b5998; color: #fff; font-size: 18px; margin-bottom: 15px;
        text-align: center; font-weight: 500; padding: 5px;}
    .login-box ul li a span { font-family: open sans, serif;}
    .login-box ul li a.active { background: #d40d12;}
</style>

<div class="container stdntpopupmain">
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modalLoginRegister" role="document">
            <div class="modal-content stdntpopupTop">
                <div class="modal-header stdntpopupHeader">
                    <button style="margin-top:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:#f00;">×</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-left:0px !important; padding-right:0px !important; padding-top:0px !important;">
                    <div class="row stdntsigninMn">
                        <div class="col-md-6">
                            <img src="/assets/images/homepage/loginpopup-bg.png" style="width:100%;">
                        </div>
                        <div class="col-md-6">
                            <div class="stdntdetailRight">
                               <div class="modal-body popupModelbdy">
                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane fade active in" id="signinNew">
                                            <form action="/user/doLogin" method="POST" data-parsley-validate="" class="newLoginPopupWindow form-horizontal" novalidate="">
                                                <div class="alert alert-danger alert-dismissible errorMessageBlock hide padding-top10" id="dialog" role="alert">
                                                    <strong class="errorMessage"></strong>
                                                </div>
                                                <fieldset class="padding-top10">
                                                    <div class="control-group">
                                                        <label class="control-label" for="email">Email</label>
                                                        <div class="controls">
                                                            <input required="" id="email" name="email" type="text" class="form-control input-medium" placeholder="Email" data-parsley-id="4">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="passwordinput">Password:</label>
                                                        <div class="controls">
                                                            <input required="" id="passwordinput" name="password" class="form-control input-medium" type="password" placeholder="********" data-parsley-id="6">
                                                        </div>
                                                    </div>
                                                    <div class="form-group btn_group_divs loginer_btGroups margin-top20">
                                                        <button id="submit_loginn" class="login_btn_click" type="submit">Login</button>
                                                        <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
                                                        <a style="padding-left:20%;" href="javascript:void(0);" class="forgot_pass text-black" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Forgot Password</a>
                                                    </div>
                                                </fieldset>
                                            </form>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="paracontent">
                                <p>New to AdmissionX? 
                                    <a href="javascript:void(0);" id="modalSignupBtn"> Sign Up</a>
                                </p>
                            </div>                           
                        </div>
                    </div>
                    <div id="box" class="row stdntsignupMn hide">
                        <div class="col-md-6">
                            <img src="/assets/images/homepage/loginpopup-bg.png" style="width:100%;">
                        </div>
                        <div class="col-md-6">
                            <div class="stdntdetailRight">
                               <div class="modal-body popupModelbdy">
                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane fade active in" id="">
                                            <form action="/user/doLogin" method="POST" data-parsley-validate="" class="newLoginPopupWindow form-horizontal" novalidate="">
                                                <div class="alert alert-danger alert-dismissible errorMessageBlock hide padding-top10" id="dialog" role="alert">
                                                    <strong class="errorMessage"></strong>
                                                </div>
                                                <fieldset class="padding-top10">
                                                     <div class="control-group">
                                                        <label class="control-label" for="full name">Full Name</label>
                                                        <div class="controls">
                                                            <input required="" id="" name="email" type="full name" class="form-control input-medium" placeholder="Full Name" data-parsley-id="4">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="email">Email</label>
                                                        <div class="controls">
                                                            <input required="" id="email" name="email" type="text" class="form-control input-medium" placeholder="Email" data-parsley-id="4">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="passwordinput">Password:</label>
                                                        <div class="controls">
                                                            <input required="" id="passwordinput" name="password" class="form-control input-medium" type="password" placeholder="********" data-parsley-id="6">
                                                        </div>
                                                    </div>
                                                    <div class="form-group btn_group_divs loginer_btGroups margin-top20">
                                                        <button id="submit_loginn" class="login_btn_click" type="submit">Sign Up</button>
                                                        <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
                                                    </div>
                                                </fieldset>
                                            </form>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="paracontentsignup">
                                <p>Already have an account?
                                    <a href="javascript:void(0);" id="modalSigninBtn"> Log in</a>
                                </p>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button>
</div>


@endsection

@section('scripts')

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
</script>
    
@endsection


