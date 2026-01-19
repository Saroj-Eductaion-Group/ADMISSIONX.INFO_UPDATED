@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')

<style type="text/css">
    header .header-logo {
  color: #001b4f;
    font-weight: 700;
    font-size: 23px;
    transition: .4s;
    -webkit-transition: .4s;
    -moz-transition: .4s;
    -ms-transition: .4s;
    -o-transition: .4s;
}

header {
  background: #fff;
  -webkit-box-shadow: 0 1px 5px 0 rgba(83, 83, 83, 0.4);
  box-shadow: 0 1px 5px 0 rgba(83, 83, 83, 0.4);
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 1000;
}

header .main-menu>li {
  position: relative;
}

header .main-menu>li>a {
  color: #173966;
  font-size: 15px;
  padding: 25px 1.5vw;
  font-weight: 700;
  display: block;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
}

header .main-menu>li.active>a {
  color: #10bd3b;
}

header .main-menu>li:hover>a {
  color: #10bd3b;
}

header .main-menu>li>a>i {
  color: #03328E;
}

header .main-menu>li>a:hover>i {
  color: #fff;
}

header .main-menu>li:hover>a i {
  color: #fff;
}

header .main-menu .sub-menu {
  display: none;
  position: absolute;
  left: 50%;
  top: 100%;
  width: 180px;
  overflow: hidden;
  border-top: 2px solid #f49306;
  background: #fff;
  -webkit-box-shadow: 0 1px 5px 0 rgba(83, 83, 83, 0.2);
  box-shadow: 0 1px 5px 0 rgba(83, 83, 83, 0.2);
  z-index: 5;
  transform: translateX(-50%);
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
}

header .main-menu .sub-menu a {
  padding: 11px 10px;
  display: block;
  color: #173966;
  font-weight: 600;
  font-size: 15px;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
}

header .main-menu .sub-menu a i {
  color: #03328E;
}

header .main-menu .sub-menu a:hover {
  background: #10bd3b;
  color: #fff;
}

header .main-menu>li:hover .sub-menu {
  display: block;
}

header .header-logo figure img {
  max-width: 200px;
}

header .demo-link {
  margin-left: 1vw;
}

header .side-menu-close {
  background: transparent;
      position: absolute;
    top: 32px;
    right: 4px;
}

header .side-menu-close span {
  background: #21395F;
  width: 28px;
}

#call-action .call-action {
  color: #001b4f;
  font-weight: 700;
  font-size: 23px;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
}

#call-action .call-action:hover {
  color: #10bd3b;
}

/* side menu */
.side-menu-wrap {
  width: 300px;
  position: fixed;
  left: -100%;
  top: 0;
  background: #fff;
  height: 100%;
  -webkit-box-shadow: 0 1px 5px 0 rgba(83, 83, 83, 0.2);
  box-shadow: 0 1px 5px 0 rgba(83, 83, 83, 0.2);
  overflow-y: auto;
  z-index: 15000;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
  
}

.side-menu-wrap.opened {
  left: 0;
  transition: .8s;
  -webkit-transition: .8s;
  -moz-transition: .8s;
  -ms-transition: .8s;
  -o-transition: .8s;

}

.side-menu-logo {
  border-bottom: 2px solid #FE8204;
}

.side-menu-nav .main-menu>li {
  position: relative;
  border-bottom: 1px solid #ccc;
}

.side-menu-nav .main-menu>li>a>i {
  color: #03328E;
}

.side-menu-nav .main-menu .sub-menu {
  border-top: 1px solid #FE8204;
  background: #fff;
  display: none;
}

.side-menu-nav .main-menu .sub-menu li {
  border-bottom: 1px solid #eee;
}

.side-menu-nav .main-menu .sub-menu a {
  padding: 10px 22px;
  display: block;
  color: #212529;
  font-weight: 600;
  font-size: .9em;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
}

.side-menu-nav .main-menu .sub-menu a i {
  color: #03328E;
}

.side-menu-nav .main-menu .sub-menu~i {
  font-size: .8em;
  position: absolute;
  padding: 21px 11px;
  right: 0;
  top: 0;
  border-left: 1px solid #ccc;
}

.side-menu-nav .main-menu .sub-menu a:hover {
  background: #F5F5F5;
}

.side-menu-nav .main-menu>li>a {
  color: #212529;
  padding: 15px 30px 15px 10px;
  font-weight: 600;
  display: block;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
}

.side-menu-wrap .side-menu-close {
  position: absolute;
  right: 0;
  top: 0;
  height: 37px;
  width: 37px;
  border-radius: 0;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  -ms-border-radius: 0;
  -o-border-radius: 0;
  padding-top: 15px;
  padding-left: 7px;

}

.side-menu-close {
  height: 40px;
  width: 40px;
  background: #f00;
  border-radius: 50%;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  -o-border-radius: 50%;
}

.side-menu-close span {
  height: 2px;
  width: 20px;
  background: #fff;
  position: relative;
  opacity: 1;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
}

.side-menu-close span:nth-child(1) {
  top: -5px;
}

.side-menu-close span:nth-child(3) {
  bottom: -5px;
}

.side-menu-close.closed span:nth-child(1) {
  transform: translateY(7px) rotate(45deg);
  -webkit-transform: translateY(7px) rotate(45deg);
  -moz-transform: translateY(7px) rotate(45deg);
  -ms-transform: translateY(7px) rotate(45deg);
  -o-transform: translateY(7px) rotate(45deg);
}

.side-menu-close.closed span:nth-child(2) {
  opacity: 0;
}

.side-menu-close.closed span:nth-child(3) {
  transform: translateY(-7px) rotate(-45deg);
  -webkit-transform: translateY(-7px) rotate(-45deg);
  -moz-transform: translateY(-7px) rotate(-45deg);
  -ms-transform: translateY(-7px) rotate(-45deg);
  -o-transform: translateY(-7px) rotate(-45deg);
}

/*  custom overlay */
.custom-overlay {
  position: fixed;
  left: 0;
  top: 0;
  background: rgba(0, 0, 0, .4);
  z-index: 12500;
  visibility: hidden;
  opacity: 0;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
}

.custom-overlay.show {
  visibility: visible;
  opacity: 1;
  transition: .4s;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  -ms-transition: .4s;
  -o-transition: .4s;
}

.navig-main ul li a, .navig-top ul li a{
    text-decoration: none;
    display: block;
    padding: 1em 1em 1em 1.2em;
    outline: none;
    color: #f3efe0;
    text-transform: uppercase;
    text-shadow: 0 0 1px rgba(255,255,255,0.1);
    letter-spacing: 1px;
    font-weight: 400; border-bottom: 1px solid #f3f3f3;
    
}
.navig-main ul li, .navig-top ul li{
    color: #333;
    list-style: none;
    margin: 0;
    padding: 0;
    background:#365a92;
    
}
.navig-main ul li a, .navig-top ul li a:hover {
    background-color:#21395F; color:#fff; 
}
.navig-main ul li span, .navig-top ul li span{
    font-size: 17px;
    line-height: .25em; float:right; 
}
.hide1
{
   margin-left:-300px;
   transition: all 1s ease;
   display: block !important;
   
 }

.side-menu
{
  position:absolute;
  top:0px;
  background:#eeeeee;
  color:white;
  width: 299px;
  height:350px;
  background: transparent;
  background-color:  #21395F;
}
.side-menu ul {
    border-top: 1px solid #21395F;
    overflow-y: scroll;
    max-height: 618px;
}
.side-menu ul li a {
    background-color:#365a92;
}
.side-menu:last-child ul li a {
    background-color:#365a92;
}
.show-menu
{
  margin-left:0 !important;
    
}

.mobile-flex-column {
    -webkit-box-orient: vertical!important;
    -webkit-box-direction: normal!important;
    -ms-flex-direction: column!important;
    flex-direction: column!important;
}

</style>

{{--*/   
    $listOfCareerStream = $fetchDataServiceController->listOfCareerStream(1);
    $listOfPopularCareer = $fetchDataServiceController->listOfPopularCareer(1);
    $listOfCareerCourses = $fetchDataServiceController->listOfCareerCourses(1);
    $stateBoards = $fetchDataServiceController->listOfBoardStateDetails('State');
    $nationalBoards = $fetchDataServiceController->listOfBoardNationalDetails('National');
    $listOfExamination = $fetchDataServiceController->listOfExamination(1);
    $listOfStudyAbroad = $fetchDataServiceController->listOfStudyAbroad(1);
    $listOfEngineering = $fetchDataServiceController->listOfEngineering(1);
    $listOfMedical = $fetchDataServiceController->listOfMedical(1);
    $listOfManagement = $fetchDataServiceController->listOfManagement(1);
    $listOfMoreStream = $fetchDataServiceController->listOfMoreStream(1);
    //print_r($listOfCareerCourses);die;
/*--}}

			{{-- <div class="col-md-5">
				<div class="headerTopLeft">
					<ul>
						<li><a href="javascript:void(0);"><i class="fa fa-phone"></i>&nbsp;&nbsp;+1-012-345-6789</a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-envelope"></i>&nbsp;&nbsp;support@admissionx.info</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-7">
				<div class="headerTopRight pull-right">
					<ul>
                        @if(Auth::check())
      			        <li><a class="text-red-color" href="">Hi, {{ str_limit(Auth::user()->firstname, $limit = 17, $end = '') }}</a></li>		
                        <li>|</li>
                        <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                        @else
                        <li><a class="btn-lg" data-toggle="modal" data-target=".bs-modal-sm" data-whatever="" href="">Login | Sign Up</a></li>
                        <li><a class="color-green" data-toggle="modal" data-target="#loginModal" data-whatever="" href="">Log In</a></li>
                        <li><a class="color-green" data-toggle="modal" data-target="#signUpModel" data-whatever="" href="">Sign Up</a></li>
                        @endif
                        <div class="modal fade bs-modal-sm" id="newLoginRegModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modalLoginRegister modal-md">
                            <div class="modal-content popupContent">
                                <button type="button" class="close popupheaderBtn" data-dismiss="modal" aria-hidden="true">×</button>
                                <div class="row">
                                    <div class="col-md-6 padding-top40">
                                        <img src="/assets/images/homepage/loginpopup-bg.png" style="width:100%;">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="popupheaderRight">
                                            <div class="bs-example bs-example-tabs">
                                                <ul id="myTab" class="nav nav-tabs popupNavtab">
                                                    <li class=""><a href="#signinNew" data-toggle="tab">Sign In</a></li>
                                                    <li class="active"><a href="#signupNew" data-toggle="tab">Register</a></li>
                                                </ul>
                                            </div>
                                            <div class="modal-body popupModelbdy">
                                                <div id="myTabContent" class="tab-content">
                                                    <div class="tab-pane fade" id="signinNew">
                                                        <form action="/user/doLogin" method="POST" data-parsley-validate="" class="newLoginPopupWindow form-horizontal">
                                                            <div class="alert alert-danger alert-dismissible errorMessageBlock hide padding-top10" id="dialog" role="alert">
                                                                <strong class="errorMessage"></strong>
                                                            </div>
                                                            <fieldset class="padding-top10">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="email">Email</label>
                                                                    <div class="controls">
                                                                        <input required="" id="email" name="email" type="text" class="form-control input-medium" placeholder="Email">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
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
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade active in" id="signupNew">
                                                        <form class="form-horizontal">
                                                            <fieldset>
                                                                <div class="control-group padding-top10">
                                                                    <label class="control-label" for="first name">First Name</label>
                                                                    <div class="controls">
                                                                        <input id="first name" name="first name" class="form-control input-large" type="text" placeholder="First Name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label" for="last name">Last Name</label>
                                                                    <div class="controls">
                                                                        <input id="last name" name="last name" class="form-control input-large" type="text" placeholder="Last Name" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label" for="email">Email</label>
                                                                    <div class="controls">
                                                                        <input id="email" name="email" class="form-control input-large" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" placeholder="Email" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label" for="phonr no">Phone No</label>
                                                                    <div class="controls">
                                                                        <input id="phonr no" name="phonr no" class="form-control input-large" type="phonr no" placeholder="Phone No" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label" for="password">Password:</label>
                                                                    <div class="controls">
                                                                        <input id="password" name="password" class="form-control input-large" type="password" placeholder="********" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label" for="reenterpassword">Reference Code</label>
                                                                    <div class="controls">
                                                                        <input id="reenterpassword" class="form-control input-large" name="reenterpassword" type="reference code" placeholder="********" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="accept_termss padding-top10">
                                                                    <label class="filter_check">
                                                                        <input type="checkbox" checked="checked"><span class="checkmark"></span><span></span>I accept all the 
                                                                        <a href="javascript:void(0);">Terms &amp; Conditions</a>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group btn_group_divs loginer_btGroups margin-top20">
                                                                    <button id="submit_signup" class="login_btn_click" type="button">Submit</button>
                                                                    <p class="text-center hide margin-top10 spin_loader_login text-white"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></p>
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
					</ul>
				</div>
			</div>  --}}

            <div class="">
                <nav id="top-bar" class="tab-hidden hidden-xs hidden-sm">
                    <div class="container">
                        <div class="row">
                            <ul class="nav navbar-nav navbar-main">
                                <li class="main-navbar-tab"><a href="{{ URL::to('top-colleges') }}" class="">top colleges</a></li>
                                <li class="main-navbar-tab"><a href="{{ URL::to('top-university') }}" class="">top universities</a></li>
                                <li class="main-navbar-tab"><a href="{{ URL::to('top-courses') }}" class="">top courses</a></li>
                                <li class="main-navbar-tab"><a href="{{ URL::to('study-abroad') }}" class="">Study Abroad</a></li>
                                <li class="main-navbar-tab"><a href="{{ URL::to('examination') }}" class="">exams</a></li>
                                <li class="main-navbar-tab"><a href="{{ URL::to('reviews') }}" class="">REVIEWS</a></li>
                                <li class="main-navbar-tab"><a href="{{ URL::to('news') }}" class="">news</a></li>
                                <li class="main-navbar-tab"><a href="{{ URL::to('education-blogs') }}" class="">blogs</a></li>
                                {{-- <li class="main-navbar-tab"><a href="{{ URL::to('latest-updates') }}" class="">ADMISSION {!! date('Y') !!}</a></li> --}}
                                <li class="main-navbar-tab"><a href="{{ URL::to('ask') }}" class="">Ask <i class="fa fa-question"></i></a></li>
                            </ul>

                            <ul class="nav nav-right">
                                <a href="https://institute-registration-form.netlify.app/" class=""  rel="noopener noreferrer">
                                 <li>World Education Fair 2025-26</li>
                                </a>
                                
                               
                                @if(Auth::check())
                                {{-- <a href="{{ URL::to('ask') }}"><li>Ask <i class="fa fa-question"></i></li></a> --}}
                                <li>|</li>
                                <a href="/login"><li>Hi, {{ str_limit(Auth::user()->firstname, $limit = 17, $end = '') }}</li></a>     
                                <li>|</li>
                                <a href="{{ URL::to('logout') }}"><li>Logout</li></a>
                                @else
                                {{-- <a href="{{ URL::to('ask') }}"><li>Ask <i class="fa fa-question"></i></li></a> --}}
                                <li>|</li>
                                <li onclick="myFunction()"><span data-toggle="modal" data-target="#loginModal" data-whatever="" href=""><i class="fa fa-user"></i> Login</span> |<!-- <span data-toggle="modal" data-target="#signUpModel" data-whatever="" href="">Signup</span> --></li>
                                <style type="text/css">
                                    .signupBlock > a:hover {background-color: #ff7900 !important;}
                                    .signupBlock ul > li > a:hover {background-color: #ff7900 !important;}
                                    .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {background-color: #ff7900 !important;}
                                </style>
                                <li class="dropdown signupBlock">
                                    <a href="{{ URL::to('/student-sign-up') }}" class="dropdown-toggle padding0 text-white" title="Student Sign Up">Sign Up</a>
                                </li>
                                <?php
                                /*<li class="dropdown signupBlock">
                                    <a href="javascript:void(0);" class="dropdown-toggle padding0 text-white" data-toggle="dropdown" title="College/Student Sign Up">Sign Up</a>
                                    <ul class="dropdown-menu pull-right" style="top: auto;">
                                        <li><a href="{{ URL::to('/educational-institution') }}" title="College Sign Up"><b><i class="fa fa-sign-in" aria-hidden="true"></i> College Sign Up</b></a></li>
                                        <li><a href="{{ URL::to('/student-sign-up') }}" title="Student Sign Up"><b><i class="fa fa-sign-in" aria-hidden="true"></i> Student Sign Up</b></a></li>
                                    </ul>
                                </li>*/
                                ?>
                                @endif
                            </ul>
                        </div>
                    </div>      
                </nav>
            </div>

<!-- end header top -->
<!-- navigation -->
<div id="fixedHeader" class="navigationMain padding-top5 padding-bottom5 bg-white hidden-sm  hidden-xs">
    <div  class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default navigationTop">
                    <div class="">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ URL::to('/') }}">
                                <img src="{{ asset('assets/images/homepage/admissionx-logo.png') }}" alt="admissionx logo">
                            </a>
                        </div>
                        <div class="collapse navbar-collapse navigationTopNav navigationTopContent padding-top5" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav mobile-hidden">
                                <li class="active"><a href="{{ URL::to('/home') }}">Home</a></li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Engineering <i class="fa fa-chevron-down"></i></a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        @foreach( $listOfEngineering as $key => $item )
                                                            <li style="line-height: 15px !important;" class="@if($key == 0) active @endif"> <a style="font-size: 12px !important;" href="#tabEngineeringDegree{{$key}}" data-toggle="tab">{{ ucfirst($item->name)}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content well dropdownNavTabContent">
                                                    @foreach( $listOfEngineering as $key => $item )
                                                        <div class="tab-pane @if($key == 0) active @endif" id="tabEngineeringDegree{{$key}}">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">College List</li>
                                                                        @foreach( $item->courseList as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} Colleges</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Colleges</a></li>
                                                                        <li><a class="submenutext" href="{{ URL::to('/stream/'.$item->functionalareapageslug.'/'.$item->pageslug.'/courses') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Course List</li>
                                                                        @foreach( $item->courseList as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/stream/'.$item->functionalareapageslug.'/'.$item->pageslug.'/courses') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Medical <i class="fa fa-chevron-down"></i></a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        @foreach( $listOfMedical as $key => $item )
                                                            <li style="line-height: 15px !important;" class="@if($key == 0) active @endif"> <a style="font-size: 12px !important;" href="#tabMedicalDegree{{$key}}" data-toggle="tab">{{ ucfirst($item->name)}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content well dropdownNavTabContent">
                                                    @foreach( $listOfMedical as $key => $item )
                                                        <div class="tab-pane @if($key == 0) active @endif" id="tabMedicalDegree{{$key}}">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">College List</li>
                                                                        @foreach( $item->degreeList as $item1 )
                                                                        {{-- <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} in {{$item1->functionalareaName}} Colleges</a></li> --}}
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} Colleges</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/'.$item->pageslug.'/colleges') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Colleges</a></li>
                                                                        <li><a class="submenutext" href="{{ URL::to('/stream/'.$item->pageslug.'/degree') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Course List</li>
                                                                        @foreach( $item->courseList as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/stream/'.$item->pageslug.'/degree') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Management <i class="fa fa-chevron-down"></i></a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        @foreach( $listOfManagement as $key => $item )
                                                            <li style="line-height: 15px !important;" class="@if($key == 0) active @endif"> <a style="font-size: 12px !important;" href="#tabManagementDegree{{$key}}" data-toggle="tab">{{ ucfirst(str_limit( $item->name, 120 ))}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content well dropdownNavTabContent">
                                                    @foreach( $listOfManagement as $key => $item )
                                                        <div class="tab-pane @if($key == 0) active @endif" id="tabManagementDegree{{$key}}">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">College List</li>
                                                                        @foreach( $item->courseList as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} Colleges</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Colleges</a></li>
                                                                        <li><a class="submenutext" href="{{ URL::to('/stream/'.$item->functionalareapageslug.'/'.$item->pageslug.'/courses') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Course List</li>
                                                                        @foreach( $item->courseList as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges') }}">{{$item1->name}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/stream/'.$item->functionalareapageslug.'/'.$item->pageslug.'/courses') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- <li class="hide"><a href="{{ URL::to('counselling') }}">Counselling</a></li> -->
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Examination <i class="fa fa-chevron-down"></i></a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        @foreach( $listOfExamination as $key => $item )
                                                            <li style="line-height: 15px !important;" class="@if($key == 0) active @endif"> <a style="font-size: 12px !important;" href="#tabExam{{$key}}" data-toggle="tab">{{ ucfirst($item->name)}} Exams</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content well dropdownNavTabContent">
                                                    @foreach( $listOfExamination as $key => $item )
                                                        <div class="tab-pane @if($key == 0) active @endif" id="tabExam{{$key}}">
                                                            <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Exam List</li>
                                                                        @foreach( $item->listofexamination as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/examination-details/'.$item->slug.'/'.$item1->slug) }}" title="{{ $item1->name }}">{{$item1->sortname}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/examination-list/'.$item->slug) }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All {{ ucfirst($item->name)}} Exams</a></li>
                                                                        <li><a class="submenutext" href="{{ URL::to('/examination') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Examination</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Stream</li>
                                                                        @foreach($item->examListMultipleDegreeObj as $key2 => $item2)
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/examination-list/'.$item->slug.'/'.$item2->degreeSlug) }}">{{ $item2->degreeName }}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Study Abroad <i class="fa fa-chevron-down"></i></a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        <li style="line-height: 15px !important;" class="active"> <a style="font-size: 12px !important;" href="#countriesTab" data-toggle="tab">Countries</a>
                                                        </li>
                                                        @foreach( $listOfStudyAbroad as $key => $item )
                                                            <li style="line-height: 15px !important;"> <a style="font-size: 12px !important;" href="#tabStudyBaorad{{$key}}" data-toggle="tab">{{ ucfirst($item->name)}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content well dropdownNavTabContent">
                                                        <div class="tab-pane active" id="countriesTab">
                                                            <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Country Home</li>
                                                                        @foreach( $listOfStudyAbroad as $item )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item->pageslug.'/college-list') }}">Study In {{ ucfirst($item->name)}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/study-abroad') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore More Countries</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach( $listOfStudyAbroad as $key => $item )
                                                        <div class="tab-pane" id="tabStudyBaorad{{$key}}">
                                                            <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Stream</li>
                                                                        @foreach( $item->getFunctionalAreaObj as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item->pageslug.'/college-list?functionalarea%5B%5D='.$item1->id) }}">Study In {{$item1->name}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/'.$item->pageslug.'/college-list') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}}</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Location</li>
                                                                        @foreach( $item->getAllStateObj as $item2 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item2->pageslug.'/'.$item->pageslug.'/college-list') }}">Study In {{$item2->name}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/'.$item->pageslug.'/college-list') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}}</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Counselling <i class="fa fa-chevron-down"></i> </a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        <li style="line-height: 25px !important; font-size: 12px !important; " class="active"><a  href="#tabPopularCareer" data-toggle="tab">Popular Career</a></li>
                                                        <li style="line-height: 25px !important; font-size: 12px !important; "> <a  href="#tabCareerStream" data-toggle="tab">Career By Stream </a></li>
                                                        @foreach( $listOfCareerCourses as $key => $item )
                                                        <li style="line-height: 25px !important; font-size: 12px !important; "><a  href="#tab{{$item->educationLevelSlug}}" data-toggle="tab">Careers After {{ ucfirst($item->name)}}</a></li>
                                                        @endforeach
                                                        <li style="line-height: 25px !important; font-size: 12px !important; "><a  href="#tabNationalBoard" data-toggle="tab">National Boards</a></li>
                                                        <li style="line-height: 25px !important; font-size: 12px !important; "><a  href="#tabStateBoard" data-toggle="tab">State Boards</a></li>
                                                    </ul>
                                                    <div class="tab-content well dropdownNavTabContent">
                                                        <div class="tab-pane active" id="tabPopularCareer">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <div class="row">
                                                                        @foreach($listOfPopularCareer as $key => $item)
                                                                        <div class="col-md-12">
                                                                            <a class="submenutext" href="{{ URL::to('/popular-careers/'.$item->slug) }}">{{ $item->title }}</a>
                                                                        </div>
                                                                        @endforeach
                                                                        <div class="col-md-12"><a class="submenutext" href="{{ URL::to('/popular-careers') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Other Popular Career </a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="tabCareerStream">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <div class="row">
                                                                        @foreach($listOfCareerStream as $key => $item)
                                                                        <div class="col-md-4">
                                                                            <a class="submenutext" href="{{ URL::to('/careers/opportunities/'.$item->slug) }}">{{ $item->name }}</a>
                                                                        </div>
                                                                        @endforeach
                                                                        <div class="col-md-6"><a class="submenutext" href="{{ URL::to('/careers/opportunities') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Career Stream</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach( $listOfCareerCourses as $key => $item )
                                                        <div class="tab-pane" id="tab{{$item->educationLevelSlug}}">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <div class="row">
                                                                        @foreach( $item->counselingCoursesObj as $item1 )
                                                                        <div class="col-md-6">
                                                                            <a class="submenutext" href="{{ URL::to('/careers-courses/'.$item->educationLevelSlug.'/'.$item1->slug) }}">{{ $item1->title }}</a>
                                                                        </div>
                                                                        @endforeach
                                                                        <div class="col-md-6"><a class="submenutext" href="{{ URL::to('/careers-courses') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Career Courses</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        <div class="tab-pane" id="tabNationalBoard">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        @foreach($nationalBoards as $key => $item)
                                                                        <li><a href="{{ URL::to('/board/national/'.$item->slug) }}">{{ $item->name }}</a></li>
                                                                        @endforeach
                                                                        <li><a href="{{ URL::to('/boards') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Education Boards</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="tabStateBoard">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <div class="row">
                                                                        @foreach($stateBoards as $key => $item)
                                                                        <div class="col-md-3">
                                                                            <a class="submenutext" href="{{ URL::to('/board/state/'.$item->slug) }}">{{ $item->name }}</a>
                                                                        </div>
                                                                        @endforeach
                                                                        <div class="col-md-6"><a class="submenutext" href="{{ URL::to('/boards') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Education Boards</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">More <i class="fa fa-chevron-down"></i></a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        @foreach( $listOfMoreStream as $key => $item )
                                                            <li style="line-height: 15px !important;" class="@if($key == 0) active @endif"> <a style="font-size: 12px !important;" href="#tabViewMoreDegree{{$key}}" data-toggle="tab">{{ ucfirst($item->name)}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content well dropdownNavTabContent">
                                                    @foreach( $listOfMoreStream as $key => $item )
                                                        <div class="tab-pane @if($key == 0) active @endif" id="tabViewMoreDegree{{$key}}">
                                                            <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">College List</li>
                                                                        @foreach( $item->degreeList as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} Colleges</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/'.$item->pageslug.'/colleges') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Colleges</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <ul>
                                                                        <li style="color: red; line-height: 25px;">Course List</li>
                                                                        @foreach( $item->courseList as $item1 )
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/stream/'.$item->pageslug.'/degree') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- <li><a href="{{ URL::to('education-blogs') }}">blogs</a></li> -->
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>         


  <!--mobile menu start-->
  <header class="col-md-12 px-2 py-3 py-lg-0 px-sm-0 hidden-md hidden-lg">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <a  href="{{ URL::to('/') }}" title="Site Logo" class="header-logo visible-xs visible-sm">
              <img src="{{ asset('assets/images/homepage/admissionx-logo.png') }}" alt="admissionx logo">
            </a>
            <div
            class="side-menu-close d-flex d-lg-none flex-wrap mobile-flex-column align-items-center justify-content-center ml-auto">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
  </header>
  <div class="side-menu-wrap">
    <a style="padding:5px 14px;" href="{{ URL::to('/') }}" title="Site Logo"  class="header-logo visible-sm  visible-xs">
      <img src="{{ asset('assets/images/homepage/admissionx-logo.png') }}" alt="admissionx logo">
    </a>
    <nav class="side-menu-nav">
        <div class="nav-title navig-main"> 
            <!-- <a href="#" class="nav-link" id="layer1"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a> -->
            <ul>
                @if(Auth::check())
                    <li><a href="">Hi, {{ Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname}}</a>
                    </li>
                    <li><a href="{{ URL::to('login') }}">Dashboard</a></li>
                @endif
                <li>
                  <a href="#" class="nav-top-men" value="2">Top menu <span><i class="fa fa-angle-right"></i></span></a>
                </li>
                <li>
                  <a href="#" class="nav-top-men" value="3" >Study Abroad <span><i class="fa fa-angle-right"></i></span></a>
                </li>
                <li>
                  <a href="#" class="nav-top-men" value="4">Engineering <span><i class="fa fa-angle-right"></i></span> </a>
                </li>
                <li>
                  <a href="#" class="nav-top-men" value="5">Medical <span><i class="fa fa-angle-right"></i></span></a>
                </li>
                <li>
                  <a href="#" class="nav-top-men" value="6">Management <span><i class="fa fa-angle-right"></i></span></a>
                </li>
                <li>
                  <a href="#" class="nav-top-men" value="7">Examination <span><i class="fa fa-angle-right"></i></span></a>
                </li>
                <li>
                  <a href="#" class="nav-top-men" value="8">Counselling <span><i class="fa fa-angle-right"></i></span></a>
                </li>
                <li>
                  <a href="#" class="nav-top-men" value="9">More <span><i class="fa fa-angle-right"></i></span></a>
                </li>
                @if(Auth::check())
                  <li><a href="{{ URL::to('logout') }}">Logout <i class="fa fa-sign-out"></i></a></li>
                @else
                  <li><a class="loginmodel" data-toggle="modal" data-target="#loginModal" data-whatever="" href=""><i class="fa fa-sign-in"></i> Log In </a></li>
                  <li><a href="{{ URL::to('/student-sign-up') }}"><i class="fa fa-user"></i> Sign Up</a></li>
                @endif
            </ul>
        </div>

        <!--Top menu---->
        <div class="side-menu hide1 navig-top" id="layer2" style="height: 100%;" >
            <ul data-value="2">
                <li><a href="#" class="nav-link nav-top-menu" style="background-color: #21395F; "><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>
                <li><a href="{{ URL::to('top-colleges') }}" class="">TOP COLLEGES</a></li>
                <li><a href="{{ URL::to('top-university') }}" class="">TOP UNIVERSITIES</a></li>
                <li><a href="{{ URL::to('top-courses') }}" class="">TOP COURSES</a></li>
                <li><a href="{{ URL::to('study-abroad') }}" class="">STUDY ABROAD</a></li>
                <li><a href="{{ URL::to('examination') }}" class="">EXAMS</a></li>
                <li><a href="{{ URL::to('reviews') }}" class="">REVIEWS</a></li>
                <li><a href="{{ URL::to('news') }}" class="">NEWS</a></li>
                <li><a href="{{ URL::to('education-blogs') }}" class="">BLOGS</a></li>
                {{-- <li><a href="{{ URL::to('latest-updates') }}" class="">ADMISSION {!! date('Y') !!}</a></li> --}}
                <li><a href="{{ URL::to('latest-updates') }}" class="">Latest Updates</a></li>
                <li><a href="{{ URL::to('edu-career-mela/2024') }}" class="">Educareer Mela 2024</a></li>
                <li><a href="{{ URL::to('ask') }}" class="">Ask</a></li>
                @if(Auth::check())
                @else
                  <li><a class="loginmodel" data-toggle="modal" data-target="#loginModal" data-whatever="" href="">Log In</a></li>
                  <li><a href="{{ URL::to('/student-sign-up') }}">Sign Up</a></li>
                @endif
            </ul>
        </div>
        <!--Top menu---->

        <!--Engineering---->
        <div class="side-menu hide1 navig-top" id="layer4" style="height: 100%;" >
            <ul data-value="3">
                <li><a href="#" class="nav-link nav-top-men" style="background-color: #21395F; "><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>
                @foreach( $listOfEngineering as $key => $item )
                <li>
                  <a href="#" class="nav-top-men" value="{{199+$key+1}}">{{ ucfirst($item->name)}}<span><i class="fa fa-angle-right"></i></span></a>
                </li>
                @endforeach
            </ul>
        </div>
        @foreach( $listOfEngineering as $key => $item )
        <div class="side-menu hide1 navig-top" id="layer{{199+$key+1}}" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                <li><a href="javascript:void(0);" style="font-weight:600;">College List</a></li>
                @foreach( $item->courseList as $item1 )
                <li><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} Colleges</a></li>
                @endforeach
                <li><a href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Colleges</a></li>

                {{-- <li><a href="javascript:void(0);"># Course List</a></li>
                @foreach( $item->courseList as $item1 )
                <li><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}}</a></li>
                @endforeach --}}
                <li><a href="{{ URL::to('/stream/'.$item->functionalareapageslug.'/'.$item->pageslug.'/courses') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
            </ul>
        </div>
        @endforeach
        <!--Engineering---->

        <!--Medical---->
        <div class="side-menu hide1 navig-top" id="layer5" style="height: 100%;" >
            <ul data-value="4">
                <li><a href="#" class="nav-link nav-top-men" style="background-color: #21395F; "><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>
                @foreach( $listOfMedical as $key => $item )
                <li>
                  <a href="#" class="nav-top-men" value="{{299+$key+1}}">{{ ucfirst($item->name)}}<span><i class="fa fa-angle-right"></i></span></a>
                </li>
                @endforeach
            </ul>
        </div>
        @foreach( $listOfMedical as $key => $item )
        <div class="side-menu hide1 navig-top" id="layer{{299+$key+1}}" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                <li><a href="javascript:void(0);" style="font-weight:600;">College List</a></li>
                @foreach( $item->degreeList as $item1 )
                {{-- <li><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} in {{$item1->functionalareaName}} Colleges</a></li> --}}
                <li><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} Colleges</a></li>
                @endforeach
                <li><a href="{{ URL::to('/'.$item->pageslug.'/colleges') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst(strtolower($item->name))}} Colleges</a></li>

                {{-- <li><a href="javascript:void(0);" style="font-weight:600;">Course List</a></li>
                @foreach( $item->courseList as $item1  )
                <li><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}}</a></li>
                @endforeach --}}
                <li><a href="{{ URL::to('/stream/'.$item->pageslug.'/degree') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst(strtolower($item->name))}} Courses</a></li>
            </ul>
        </div>
        @endforeach
        <!--Medical---->

        <!--Management---->
        <div class="side-menu hide1 navig-top" id="layer6" style="height: 100%;" >
            <ul data-value="5">
                <li><a href="#" class="nav-link nav-top-men" style="background-color: #21395F; "><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>
                @foreach( $listOfManagement as $key => $item )
                <li>
                  <a href="#" class="nav-top-men" value="{{399+$key+1}}">{{ ucfirst($item->name)}}<span><i class="fa fa-angle-right"></i></span></a>
                </li>
                @endforeach
            </ul>
        </div>
        @foreach( $listOfManagement as $key => $item )
        <div class="side-menu hide1 navig-top" id="layer{{399+$key+1}}" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                <li><a href="javascript:void(0);" style="font-weight:600;">College List</a></li>
                @foreach( $item->courseList as $item1  )
                <li><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} Colleges</a></li>
                @endforeach
                <li><a href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst($item->name) }} Colleges</a></li>

                {{-- <li><a href="javascript:void(0);" style="font-weight:600;">Course List</a></li>
                @foreach( $item->courseList as $item1  )
                <li><a href="{{ URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges') }}">{{$item1->name}}</a></li>
                @endforeach --}}
                <li><a href="{{ URL::to('/stream/'.$item->functionalareapageslug.'/'.$item->pageslug.'/courses') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst($item->name) }} Courses</a></li>
            </ul>
        </div>
        @endforeach
        <!--Management---->

        <!--Examination---->
        <div class="side-menu hide1 navig-top" id="layer7" style="height: 100%;" >
            <ul data-value="6">
                <li><a href="#" class="nav-link nav-top-men" style="background-color: #21395F; "><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>
                @foreach( $listOfExamination as $key => $item )
                <li>
                  <a href="#" class="nav-top-men" value="{{499+$key+1}}">{{ ucfirst($item->name)}} Exams<span><i class="fa fa-angle-right"></i></span></a>
                </li>
                @endforeach
            </ul>
        </div>
        @foreach( $listOfExamination as $key => $item )
        <div class="side-menu hide1 navig-top" id="layer{{499+$key+1}}" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                <li><a href="javascript:void(0);" style="font-weight:600;"> Exam List</a></li>
                @foreach($item->listofexamination as $item1 )
                <li><a href="{{ URL::to('/examination-details/'.$item->slug.'/'.$item1->slug) }}" title="{{ $item1->name }}">{{$item1->sortname}}</a></li>
                @endforeach

                <li><a href="javascript:void(0);"># Stream</a></li>
                @foreach($item->examListMultipleDegreeObj as $key2 => $item2)
                <li><a href="{{ URL::to('/examination-list/'.$item->slug.'/'.$item2->degreeSlug) }}">{{ $item2->degreeName }}</a></li>
                @endforeach
                <li><a href="{{ URL::to('/examination-list/'.$item->slug) }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> All {{ ucfirst(strtolower($item->name))}} Exams</a></li>
                <li><a href="{{ URL::to('/examination') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> All Examination</a></li>
            </ul>
        </div>
        @endforeach
        <!--Examination---->

         <!--study abroad---->
        <div class="side-menu hide1 navig-top" id="layer3" style="height: 100%;" >
            <ul data-value="7">
                <li><a href="#" class="nav-link nav-top-men" style="background-color: #21395F; "><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>
                <li>
                  <a href="#" class="nav-top-men" value="100">Countries<span><i class="fa fa-angle-right"></i></span></a>
                </li>
                @foreach( $listOfStudyAbroad as $key => $item )
                <li>
                  <a href="#" class="nav-top-men" value="{{100+$key+1}}">{{ ucfirst($item->name)}}<span><i class="fa fa-angle-right"></i></span></a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="side-menu hide1 navig-top" id="layer100" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                @foreach( $listOfStudyAbroad as $item )
                <li><a href="{{ URL::to('/'.$item->pageslug.'/college-list') }}">Study In {{ ucfirst(strtolower($item->name))}}</a></li>
                @endforeach
                <li><a href="{{ URL::to('/study-abroad') }}"> <i class="fa fa-arrow-right" aria-hidden="true"></i> Explore More Countries </a></li>
            </ul>
        </div>
        @foreach( $listOfStudyAbroad as $key => $item )
        <div class="side-menu hide1 navig-top" id="layer{{100+$key+1}}" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                <li><a href="javascript:void(0);" style="font-weight:600;">Top Stream</a></li>
                @foreach( $item->getFunctionalAreaObj as $item1 )
                <li><a href="{{ URL::to('/'.$item->pageslug.'/college-list?functionalarea%5B%5D='.$item1->id) }}">Study In {{$item1->name}}</a></li>
                @endforeach

                <li><a href="javascript:void(0);"style="font-weight:600;">Top Location</a></li>
                @foreach( $item->getAllStateObj as $item2 )
                <li><a href="{{ URL::to('/'.$item2->pageslug.'/'.$item->pageslug.'/college-list') }}">Study In {{$item2->name}}</a></li>
                @endforeach

                <li><a href="{{ URL::to('/'.$item->pageslug.'/college-list') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}}</a></li>
            </ul>
        </div>
        @endforeach
        <!--study abroad---->

        <!--Counselling---->
        <div class="side-menu hide1 navig-top" id="layer8" style="height: 100%;" >
            <ul data-value="8">
                <li><a href="#" class="nav-link nav-top-men" style="background-color: #21395F; "><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>
                <li><a href="#" class="nav-top-men" value="601">Popular Careers<span><i class="fa fa-angle-right"></i></span></a></li>
                <li><a href="#" class="nav-top-men" value="600">Career By Stream<span><i class="fa fa-angle-right"></i></span></a></li>
                @foreach( $listOfCareerCourses as $key => $item )
                <li><a href="#" class="nav-top-men" value="{{603+$key+1}}">Careers After {{ ucfirst($item->name) }}<span><i class="fa fa-angle-right"></i></span></a></li>
                @endforeach
                <li><a href="#" class="nav-top-men" value="602">National Boards<span><i class="fa fa-angle-right"></i></span></a></li>
                <li><a href="#" class="nav-top-men" value="603">State Boards<span><i class="fa fa-angle-right"></i></span></a></li>
            </ul>
        </div>
        <div class="side-menu hide1 navig-top" id="layer600" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                @foreach($listOfPopularCareer as $key => $item)
                <li><a href="{{ URL::to('/popular-careers/'.$item->slug) }}">{{ ucfirst($item->title)}}</a></li>
                @endforeach
                <li><a href="{{ URL::to('/popular-careers') }}"> <i class="fa fa-arrow-right" aria-hidden="true"></i> All Other Popular Career </a></li>
            </ul>
        </div>
        <div class="side-menu hide1 navig-top" id="layer601" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                @foreach($listOfCareerStream as $key => $item)
                <li><a href="{{ URL::to('/careers/opportunities/'.$item->slug) }}">{{ ucfirst($item->name)}}</a></li>
                @endforeach
                <li><a href="{{ URL::to('/careers/opportunities') }}"> <i class="fa fa-arrow-right" aria-hidden="true"></i> All Career Stream </a></li>
            </ul>
        </div>
        @foreach( $listOfCareerCourses as $key => $item )
        <div class="side-menu hide1 navig-top" id="layer{{603+$key+1}}" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                @foreach( $item->counselingCoursesObj as $item1  )
                <li><a href="{{ URL::to('/careers-courses/'.$item->educationLevelSlug.'/'.$item1->slug) }}">{{$item1->title}}</a></li>
                @endforeach
                <li><a href="{{ URL::to('/careers-courses') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> All Career Courses</a></li>
            </ul>
        </div>
        @endforeach
        <div class="side-menu hide1 navig-top" id="layer602" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
              @foreach($nationalBoards as $key => $item)
              <li><a href="{{ URL::to('/board/national/'.$item->slug) }}">{{ $item->name }}</a></li>
              @endforeach
              <li><a href="{{ URL::to('/boards') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> All Education Boards</a></li>
            </ul>
        </div>
        <div class="side-menu hide1 navig-top" id="layer603" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
              @foreach($stateBoards as $key => $item)
                <li><a href="{{ URL::to('/board/state/'.$item->slug) }}">{{ $item->name }}</a></li>
              @endforeach
              <li><a href="{{ URL::to('/boards') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> All Education Boards</a></li>
            </ul>
        </div>
        <!--Counselling---->

        <!--More Stream---->
        <div class="side-menu hide1 navig-top" id="layer9" style="height: 100%;" >
            <ul data-value="9">
                <li><a href="#" class="nav-link nav-top-men" style="background-color: #21395F; "><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>
                @foreach( $listOfMoreStream as $key => $item )
                <li>
                  <a href="#" class="nav-top-men" value="{{699+$key+1}}">{{ ucfirst($item->name)}}<span><i class="fa fa-angle-right"></i></span></a>
                </li>
                @endforeach
            </ul>
        </div>
        @foreach( $listOfMoreStream as $key => $item )
        <div class="side-menu hide1 navig-top" id="layer{{699+$key+1}}" style="margin-top: 52px; height: calc(100% - 52px); background-color: #365a92;">
            <ul>
                <li><a href="javascript:void(0);" style="font-weight:600;">College List</a></li>
                @foreach( $item->degreeList as $item1 )
                <li><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}} Colleges</a></li>
                @endforeach
                <li><a href="{{ URL::to('/'.$item->pageslug.'/colleges') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Colleges</a></li>

                <li><a href="javascript:void(0);" style="font-weight:600;">Course List</a></li>
                @foreach($item->courseList as $item1 )
                <li><a href="{{ URL::to('/'.$item1->functionalareapageslug.'/'.$item1->degreepageslug.'/'.$item1->pageslug.'/colleges') }}">{{$item1->name}}</a></li>
                @endforeach
                <li><a href="{{ URL::to('/stream/'.$item->pageslug.'/degree') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Explore {{ ucfirst($item->name)}} Courses</a></li>
            </ul>
        </div>
        @endforeach
        <!--More Stream---->
    </nav>
    <div class="side-menu-close d-flex flex-wrap mobile-flex-column align-items-center justify-content-center">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
      // auto generated side menu from top header menu start
      var topHeaderMenu = $('header nav > ul').clone();
      var sideMenu = $('.side-menu-wrap nav');
      sideMenu.append(topHeaderMenu);
      if ($(sideMenu).find('.sub-menu').length != 0) {
        $(sideMenu).find('.sub-menu').parent().append('<i class="fas fa-chevron-right d-flex align-items-center"></i>');
      }
      // auto generated side menu from top header menu end

      // close menu when clicked on menu link start
      // $('.side-menu-wrap nav > ul > li > a').on('click', function () {
      //   sideMenuCloseAction();
      // });
      // close menu when clicked on menu link end

      // open close sub menu of side menu start
      var sideMenuList = $('.side-menu-wrap nav > ul > li > i');
      $(sideMenuList).on('click', function () {
        if (!($(this).siblings('.sub-menu').hasClass('visible-xs'))) {
          $(this).siblings('.sub-menu').addClass('visible-xs');
        } else {
          $(this).siblings('.sub-menu').removeClass('visible-xs');
        }
      });
      // open close sub menu of side menu end

      // side menu close start
      $('.side-menu-close').on('click', function () {
        if (!($('.side-menu-close').hasClass('closed'))) {
          $('.side-menu-close').addClass('closed');
        } else {
          $('.side-menu-close').removeClass('closed');
        }
      });
      // side menu close end

      // auto append overlay to body start
      $('.wrapper').append('<div class="custom-overlay h-100 w-100"></div>');
      // auto append overlay to body end

      // open side menu when clicked on menu button start
      $('.side-menu-close').on('click', function () {
        if (!($('.side-menu-wrap').hasClass('opened')) && !($('.custom-overlay').hasClass('show'))) {
          $('.side-menu-wrap').addClass('opened');
          $('.custom-overlay').addClass('show');
        } else {
          $('.side-menu-wrap').removeClass('opened');
          $('.custom-overlay').removeClass('show');
        }
      })
      // open side menu when clicked on menu button end

      // close side menu when clicked on overlay start
      $('.custom-overlay').on('click', function () {
        sideMenuCloseAction();
      });
      // close side menu when clicked on overlay end

      // close side menu when swiped start
      var isDragging = false, initialOffset = 0, finalOffset = 0;
      $(".side-menu-wrap")
      .mousedown(function(e) {
          isDragging = false;
        initialOffset = e.offsetX;
      })
      .mousemove(function() {
          isDragging = true;
       })
      .mouseup(function(e) {
          var wasDragging = isDragging;
          isDragging = false;
        finalOffset = e.offsetX;
          if (wasDragging) {
              if(initialOffset>finalOffset) {
                 sideMenuCloseAction();
                 }
          }
      });
    // close side menu when swiped end


      function sideMenuCloseAction() {
        $('.side-menu-wrap').addClass('open');
        $('.wrapper').addClass('freeze');
        $('.custom-overlay').removeClass('show');
        $('.side-menu-wrap').removeClass('opened');
        $('.side-menu-close').removeClass('closed');
        $(sideMenuList).siblings('.sub-menu').removeClass('visible-xs');
      }
      // close side menu when clicked on overlay end

    // close side menu over 992px start
      $(window).on('resize', function() {
          if($(window).width() >= 992) {
              sideMenuCloseAction();
          }
      })
    // close side menu over 992px end

    $('.nav-top-men').on('click',function(){
      var tag = $(this).attr('value');
      var tag1 = $(this).text();
      // window.alert("#layer"+tag1);
      var back_link="#layer"+tag;
      //window.alert(back_link);
      $('.nav-link').attr('href',back_link);
      //$('.nav-link').text(tag1);
      $('.nav-link').attr('value',tag);
      $("#layer"+tag).removeClass('hide1-menu'); 
      $("#layer"+tag).toggleClass('show-menu'); 
    });
    
    $('.nav-link').on('click',function(){
      var tag = $(this).attr('href');
      var val= $(this).attr('value');
      $(tag).removeClass('show-menu'); 
      if (val >= 100 && val < 199) {
        var back_link="#layer3";
        $('.nav-link').attr('href',back_link);
        $('.nav-link').attr('value',3);
      }else if (val >= 200 && val < 299) {
        var back_link="#layer4";
        $('.nav-link').attr('href',back_link);
        $('.nav-link').attr('value',4);
      }else if (val >= 300 && val < 399) {
        var back_link="#layer5";
        $('.nav-link').attr('href',back_link);
        $('.nav-link').attr('value',5);
      }else if (val >= 400 && val < 499) {
        var back_link="#layer6";
        $('.nav-link').attr('href',back_link);
        $('.nav-link').attr('value',6);
      }else if (val >= 500 && val < 599) {
        var back_link="#layer7";
        $('.nav-link').attr('href',back_link);
        $('.nav-link').attr('value',7);
      }else if (val >= 600 && val < 699) {
        var back_link="#layer8";
        $('.nav-link').attr('href',back_link);
        $('.nav-link').attr('value',8);
      }else if (val >= 700 && val < 799) {
        var back_link="#layer9";
        $('.nav-link').attr('href',back_link);
        $('.nav-link').attr('value',9);
      }else{
        var back_link="#layer"+(val-1);
        $('.nav-link').attr('href',back_link);
        $('.nav-link').attr('value',val-1);
      }
      //window.alert(back_link);   
    });

    $('.loginmodel').on('click', function () {
      sideMenuCloseAction();
    })
  </script>
<!-- navigation

    
