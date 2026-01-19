
@extends('website/new-design-layouts.master')

@section('content')

<style type="text/css">
   .student-pop-left{
    background: url(/assets/images/homepage/student-pop-bg1.png);
     padding:150px 5%; background-size:cover; height:530px;  }
   
	.panel-title > a:before {
    float: right !important; font-family: FontAwesome;
    content:"\f056";  padding-right: 5px;}
	.panel-title > a.collapsed:before { float: right !important;
    	content:"\f055";}
	.panel-title > a:hover, 
	.panel-title > a:active, 
	.panel-title > a:focus {  text-decoration:none;}
	.student-pop-heading{ background-color:unset !important; border-color:unset !important;}
	.student-pop-panel{ border-color:unset !important; border:unset !important;}
	.whysignUp h2{ font-size:20px; font-weight:600; padding:0 15px;}
	.student-pop-top ul li{ display:inline; color:#000; font-size:20px; 
    	padding-right: 12%; font-weight:600;  }
   
	.student-pop-top{ border-bottom:unset; }
	.student-pop-top li a{text-transform:uppercase;font-weight:600;font-size:18px; padding-left:0px !important; 
	 	margin-right:25px !important; background:unset !important;}

	.student-pop-top li.active>a, .student-pop-top li.active>a:focus, .student-pop-top li.active>a:hover{ 
	  background-color: unset !important;  border-bottom:#d40d12 solid 3px !important;   font-family:'Open Sans', sans-serif; font-weight: 700 !important;
	    font-size: 18px; border-right:unset; border-left:unset; color:#d40d12; border-top:unset;  }
	.student-pop-top li a:hover{ background-color:unset !important; border:unset; border-color: unset !important; cursor:pointer !important; }
	
	.login_btn_click{ background: #d40d12; border-radius: 50px; padding:5px 25px; color: #FFF;
     font-size: 18px !important; border: unset;}
       .login-box ul li{ display:inline;}
    .login-box ul li a
        {  border-radius: 50px;  font-family: open sans, serif; display:inline-block; background:#3b5998; color:#fff; font-size:18px; margin-bottom:15px; text-align:center; font-weight: 500;
         padding:5px;}
	.login-box ul li a.active{ background:#d40d12;} 
	.login-box ul li a span{     font-family: open sans, serif; }
	.student-pop-right-main{ background:#f6f6f6; padding-left:8%;}
	.dot{ height: 25px; width: 25px; background-color: #bbb; border-radius: 50%;
	 display: inline-block; color: #fff; font-weight: bold;}
	 .student-input-field{ padding: 18px 15px !important;
    border: unset;
    border-radius: 50px; }
</style>


	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 student-pop-left">
				<div class="student-pop-leftTop" style=" background:#fff; padding:10px 15px;">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="whysignUp">
							<h2>Why Sign Up?</h2>
						</div>
					    <div class="panel panel-default student-pop-panel">
					        <div class="panel-heading student-pop-heading" role="tab" id="headingTwo">
					            <h4 class="panel-title">
						        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          Lorem Ipsum
						        </a>
					      		</h4>
							</div>
					        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					            <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.</div>
					        </div>
					    </div>
					    <div class="panel panel-default student-pop-panel">
					        <div class="panel-heading student-pop-heading" role="tab" id="headingThree">
					            <h4 class="panel-title">
						        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						          Lorem Ipsum
						        </a>
					      		</h4>
							</div>
					        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
					            <div class="panel-body">
					            	Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
					        	</div>
					        </div>
					    </div>
					    <div class="panel panel-default student-pop-panel">
					        <div class="panel-heading student-pop-heading" role="tab" id="headingFour">
					            <h4 class="panel-title">
						        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						          Lorem Ipsum
						        </a>
					      		</h4>
							</div>
					        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
					            <div class="panel-body">
					            	Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
					        	</div>
					        </div>
					    </div>
					   	<div class="panel panel-default student-pop-panel">
					        <div class="panel-heading student-pop-heading" role="tab" id="headingFive">
					            <h4 class="panel-title">
						        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
						          Lorem Ipsum
						        </a>
					      		</h4>
							</div>
					        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
					            <div class="panel-body">
					            	Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
					        	</div>
					        </div>
					    </div>
					</div>
				</div>
			</div>
			<div class="col-md-6 student-pop-right-main"
			 style="padding-top:40px; height:530px;">
				<div class="">
					<div class="bs-example bs-example-tabs">
	                    <ul id="myTab" class="nav nav-tabs student-pop-top">
	                        <li class="active">
	                        	<a id="modalSigninBtn" href="#signinNew" data-toggle="tab" aria-expanded="true">Login</a>
	                        </li>
	                        <li class="">
	                        	<a id="modalSignupBtn" href="#signupNew" data-toggle="tab" aria-expanded="false">Sign Up</a>
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
						<div class="row stdntsigninMn">
	                        <div class="col-md-10">
	                            <div class="stdntdetailRight">
	                               <div class="popupModelbdy">
	                                    <form style="padding-top:20px;" action="/user/doLogin" method="POST" data-parsley-validate="" class="newLoginPopupWindow form-horizontal" novalidate="">
	                                        <div class="alert alert-danger alert-dismissible errorMessageBlock hide padding-top10" id="dialog" role="alert">
	                                            <strong class="errorMessage"></strong>
	                                        </div>
	                                        <fieldset class="padding-top10">
	                                            <div class="control-group">
	                                                <div class="controls">
	                                                    <input required="" id="email" name="email" type="text" class="form-control input-medium student-input-field" placeholder="Email" data-parsley-id="4">
	                                                </div>
	                                            </div>
	                                            <div class="control-group margin-top20">
	                                               	<div class="controls">
	                                                    <input required="" id="passwordinput" name="password" class="form-control input-medium student-input-field" type="password" placeholder="Password" data-parsley-id="6">
	                                                </div>
	                                            </div>
	                                            <div class="form-group btn_group_divs loginer_btGroups margin-top20">
	                                                <button id="submit_loginn" class="login_btn_click btn-block" type="submit">Login</button>
	                                                <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
	                                                <a style="display:block; padding-top:15px;  font-size:16px; font-weight:600; text-align:center;"  href="javascript:void(0);" class="forgot_pass text-black" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="">Forgot Password</a>
	                                            </div>
	                                            <div>
	                                            	<p class="text-center margin-top10"><span class="dot">or</span></p>
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
	                                        </fieldset>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row stdntsignupMn hide">
	                       <div class="col-md-10">
	                            <div class="stdntdetailRight1">
	                               <div class="popupModelbdy">
		                                <form style="padding-top:20px;" action="/user/doLogin" method="POST" data-parsley-validate="" class="newLoginPopupWindow form-horizontal" novalidate="">
		                                    <div class="alert alert-danger alert-dismissible errorMessageBlock hide padding-top10" id="dialog" role="alert">
		                                        <strong class="errorMessage"></strong>
		                                    </div>
		                                    <fieldset class="padding-top10">
		                                        <div class="control-group">
		                                            <div class="controls">
		                                                <input required="" id="" name="email" type="full name" class="form-control input-medium student-input-field" placeholder="Full Name" data-parsley-id="4">
		                                            </div>
		                                        </div>
		                                        <div class="control-group" style="margin:20px 0px;">
		                                           	<div class="controls">
		                                                <input required="" id="email" name="email" type="text" class="form-control input-medium student-input-field" placeholder="Email" data-parsley-id="4">
		                                            </div>
		                                        </div>
		                                        <div class="control-group">
		                                           	<div class="controls">
		                                                <input required="" id="passwordinput" name="password" class="form-control input-medium student-input-field" type="password" placeholder="Password" data-parsley-id="6">
		                                            </div>
		                                        </div>
		                                        <div class="form-group btn_group_divs loginer_btGroups margin-top20">
		                                            <button id="submit_loginn" class="login_btn_click btn-block" type="submit">Sign Up</button>
		                                            <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
		                                        </div>
		                                        <div>
	                                            	<p class="text-center margin-top15"><span class="dot">or</span></p>
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
 

@endsection


