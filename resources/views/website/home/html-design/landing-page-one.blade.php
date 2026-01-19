<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->


<!-- Mirrored from themeelite.com/demos/e-learn/image+text-rotator/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Jul 2020 22:05:36 GMT -->
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Metas Page details-->
<title>AdmissionX</title>
<meta name="description" content="UX designer and web developer">
<meta name="author" content="">
<!-- Mobile Specific Metas-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--main style-->
<link rel="stylesheet" type="text/css" media="screen" href="/landing-assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="/landing-assets/css/main1.css">
<link rel="stylesheet" type="text/css" media="screen" href="/landing-assets/css/default.css" data-name="skins">
<!--Theme Switcher -->
<link rel="stylesheet" type="text/css" href="/landing-assets/switcher/css/switcher.css" media="screen" />
<!--google font style-->
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!--font-family: 'Metrophobic', sans-serif;-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600italic,600,700italic,700' rel='stylesheet' type='text/css'>
<!--font-family: 'Open Sans', sans-serif; -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,400italic,500,300italic,300,100,500italic' rel='stylesheet' type='text/css'>
<!--font-family: 'Roboto', sans-serif; -->

<!-- font icon css style-->
<link rel="stylesheet" href="/landing-assets/css/font-awesome.min.css">
{!! Html::style('assets/administrator/css/parsley.css') !!}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body onLoad="load()" onUnload="GUnload()">
  @include('website.new-design-layouts.socialMediaScript')
<style type="text/css">
    .msg-error {color: #c64848;  padding-left: 15px;}
  .g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
</style>

<style type="text/css">
  #clockdiv{ width:100%; 
  font-family: sans-serif;
  color: #fff;
  display: inline-block;
  font-weight: 100;
  text-align: center;
  font-size: 30px;
}

#clockdiv > div{
  padding: 10px;
  border-radius: 3px;
  margin-right: 8%; 
  display: inline-block;
}

#clockdiv div > span{
  padding: 15px; font-size:50px; 
  border-radius: 3px;
  
  display: inline-block;
}

.smalltext{
  padding-top: 5px;
  font-size: 18px;
}

/* carousel */
#quote-carousel 
{
  /*padding: 0 10px 30px 10px;*/
  margin-top: 30px;
}

/* Control buttons  */
#quote-carousel .carousel-control
{
  background: none;
  color: #222;
  font-size: 2.3em;
  text-shadow: none;
  margin-top: 30px;
}
/* Previous button  */
#quote-carousel .carousel-control.left 
{
  left: -12px;
}
/* Next button  */
#quote-carousel .carousel-control.right 
{
  right: -12px !important;
}
/* Changes the position of the indicators */
#quote-carousel .carousel-indicators 
{
  right: 50%;
  top: auto;
  bottom: 0px;
  margin-right: -19px;
}
/* Changes the color of the indicators */
#quote-carousel .carousel-indicators li 
{
  background: #c0c0c0;
}
#quote-carousel .carousel-indicators .active 
{
  background: #333333;
}
#quote-carousel img
{
  width: 250px;
  height: 100px
}
/* End carousel */

.item blockquote {
    border-left: none; 
    margin: 0;
}

.item blockquote img {
    margin-bottom: 10px;
}

.item blockquote p:before {
    content: "\f10d";
    font-family: 'Fontawesome';
    float: left;
    margin-right: 10px;
}



/**
  MEDIA QUERIES
*/

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) { 
    #quote-carousel 
    {
      margin-bottom: 0;
      padding: 0 40px 30px 40px;
    }
    
}

/* Small devices (tablets, up to 768px) */
@media (max-width: 768px) { 
    
    /* Make the indicators larger for easier clicking with fingers/thumb on mobile */
    
    #quote-carousel .carousel-indicators {
        bottom: -20px !important;  
    }
    #quote-carousel .carousel-indicators li {
        display: inline-block;
        margin: 0px 5px;
        width: 15px;
        height: 15px;
    }
    #quote-carousel .carousel-indicators li.active {
        margin: 0px 5px;
        width: 20px;
        height: 20px;
    }
}



.hover_listing li .img,.hover_listing li .img:hover{ background:unset !important; }
.img a img:hover{background:unset !important; }


.managementMain ul{ list-style:none; padding:0px; margin:0px; width:50%;
    float: left; }
.managementMain ul li{  padding-right:6%; }
.managementMain ul li a{   color:#000; font-size:15px;}


</style>


<!--wrapper start-->
<div class="wrapper" id="wrapper"> 
  <!-- Preloader -->
  
  <!--Header start -->
  <header> 
    <!--Language start -->
   
    <!--/Language end --> 
    <!--menu start-->
    <div class="menu">
      <div class="navbar-wrapper">
        <div class="container"> 
          <!-- Navbar start -->
          <div class="navwrapper">
            <div class="navbar navbar-inverse navbar-static-top">
              <div class="container">
                <div class="logo">
                  <a href="#">
                    <img src="/assets/images/homepage/admissionx-logo.png">
                  </a> 
                </div>
                <nav class="navArea">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                  </div>
                  <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav" id="navigation">
                      <li class="menuItem" id="home"><a href="#wrapper">Home</a></li>
                      <li class="menuItem"><a href="#features">features</a></li>
                      <li class="menuItem"><a href="#courses">courses</a></li>
                      <li class="menuItem"><a href="#teachers">colleges</a></li>
                      
                      <li class="menuItem"><a href="#testimonial">Testimonial</a></li>
                      <!-- <li><a href="blog-medium-image.html">blog</a></li>
                      <li class="menuItem"><a href="#contact">Contact</a></li> -->
                    </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
          <!-- Navbar end --> 
        </div>
      </div>
    </div>
    <!--menu end--> 
    
    <!--banner start -->
    <div class="header_v1">
      <div class="banner row" id="banner">
        <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 noPadd slides-container" style="height:100%;"> 
          <!--background slide show start-->
          <div class="slide"> 
            <!--Header text1 start-->
            <div class="container hedaer-inner">
              <div class="bannerText">
                <h3>Hassle Free Admission</h3>
                <p>
                  We are one of the leading educational portals to
                  provide online admission facilities to students.
                </p>
              </div>
            </div>
            <!--Header text1 end--> 
            <img src="/landing-assets/images/header-image/image01.jpg" alt="image01">
          </div>
          <div class="slide"> 
            <!--Header text2 start-->
            <div class="container hedaer-inner">
              <div class="bannerText">
                <h3>Search and Explore the world of Education</h3>
                <p>Get all updates related to colleges, courses,
                admission, fees and much more.</p>
              </div>
            </div>
            <!--Header text2 end--> 
            <img src="/landing-assets/images/header-image/image02.jpg" alt="image02"> 
          </div>
          <div class="slide"> 
            <!--Header text2 start-->
            <div class="container hedaer-inner">
              <div class="bannerText">
                <h3>Get expert guidance related to Career</h3>
                <p>Our community and expert team provides you reliable
                answers to all your career related queries.</p>
              </div>
            </div>
            <!--Header text2 end--> 
            <img src="/landing-assets/images/header-image/image03.jpg" alt="image03"> 
          </div>
          <!--background slide show end--> 
        </div>
      </div>
    </div>
    <!--banner end --> 
    
    <!--Header form -->
    <div class="container form-header">
      <div class="form-container">
        @if(Session::has('flash_message'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>{{ Session::get('flash_message') }}</strong>
                    </div>
                </div>
            </div>
        @endif
        <h2>Easiest way to get admission to your choice of college.<span>Browse 1505+ courses, 16900+ colleges &amp; 400+ exams</span></h2>

        <div class="row">
          <form action="/landing-page-query" method="POST" data-parsley-validate="" enctype="multipart/form-data">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-row">
              <input style="width:100%;" type="text" name="fullname"class="normal small inputSmall" placeholder="Name" data-parsley-trigger="change" data-parsley-error-message="Please enter your name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" required="">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-row">
             <input style="width:100%;" type="text" name="mobilenumber" class="normal small last inputSmall" placeholder="Mobile Number" data-parsley-type ="digits" data-parsley-error-message = "Please enter valid mobile number"  data-parsley-trigger="change" required="" minlength="10" maxlength="10" data-parsley-pattern="^[6-9][0-9]{9}$">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-row">
              <input style="width:100%;" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="emailaddress" class="normal small last inputSmall" placeholder="Email" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <input type="submit" class="button" value="Contact us">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--/Header form --> 
    
  </header>
  <!--Header end --> 
  <!--Membership features start -->
  <section class="white_section section_gap" style="padding:80px 0px;" id="features">
    <div class="container">
      <div class="heading">
        <h1><span>CHOOSE US, CHOOSE</span>FUTURE.</h1>
        <p>Explore the world of courses, colleges and careers options.</p>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="membership_listing"> <span><i class="fa fa-search"></i></span>
            <h3>Search colleges</h3>
            <p>Search any college and get in- depth detailed information of almost every
            college.</p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="membership_listing"> <span><i class="fa fa-video-camera"></i></span>
            <h3>Testimonial</h3>
            <p>Students are sharing their experience of using Admssionx, go ahead and
            see what users are talking about us.</p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="membership_listing"> <span><i class="fa fa-microphone"></i></span>
            <h3>Hassle- free admission</h3>
            <p>We take immense pleasure to announce that our portal is helping
              thousands of students to get admission in their choice of college hassle
              free.</p>
          </div>
        </div>
      </div>
      <div class="row sec_top_gp" style="padding-top:0px;">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="membership_listing"> <span><i class="fa fa-file-text-o"></i></span>
            <h3>Career guidance</h3>
            <p>We provide counselling service to the students, so that they can choose the
            right career path for them</p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="membership_listing"> <span><i class="fa fa-pencil"></i></span>
            <h3>Latest updates</h3>
            <p>Get all the updates, recent news, exams announcements, courses, cut-
            offs and fees on a single portal.</p>
          </div>
        </div>
       {{--  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="membership_listing"> <span><i class="fa fa-life-ring"></i></span>
            <h3>Latest updates</h3>
            <p>Morbi leo risus, porta ac consectetur, vestibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor </p>
          </div>
        </div> --}}
      </div>
    </div>
  </section>
  <!--/Membership features end --> 
  <!--Available course start-->
  <section class="grey_section section_gap" style="padding:80px 0px;" id="course">
    <div class="container">
      <div class="heading">
        <h1><span>Find Top</span>Courses</h1>
        <p>Checkout the top courses which we have especially segregated
          based on the stream wise for easy navigation</p>
      </div>
     {{--  <div style="margin-bottom:15px;">
        <h2 style="font-size:23px; margin:0px;">Importance of Right Career</h2>
        <p style="font-size:17px;">Choosing a right career is very important in today’s
          times, as it plays an integral role in shaping your
          future &amp; happiness.<br>So, to ease you work little, we
          have listed down top courses of each field.</p>
      </div> --}}
      <div class="row"> 
        <!-- Vertical tabs start-->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
          <ul class="nav nav-tabs custom-nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#graphicesigning" aria-controls="graphicesigning" role="tab" data-toggle="tab">MANAGEMENT COURSES</a></li>
            <li role="presentation"><a href="#onlinemarketing" aria-controls="onlinemarketing" role="tab" data-toggle="tab">ENGINEERING COURSES</a></li>
            <li role="presentation"><a href="#brandstrategy" aria-controls="brandstrategy" role="tab" data-toggle="tab">MEDICAL COURSES</a></li>
            <li role="presentation"><a href="#generalmedicine" aria-controls="generalmedicine" role="tab" data-toggle="tab">CREATIVE COURSES</a></li>
            <li role="presentation"><a href="#basicphotography" aria-controls="basicphotography" role="tab" data-toggle="tab">Commerce Courses</a></li>
          </ul>
        </div>
        <!-- Vertical tabs end--> 
        <!-- Vertical tabs content start-->
        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9 tab_text">
          <div class="tab-content"> 
            <!-- Vertical tabs content01 start-->
            <div role="tabpanel" class="tab-pane active" id="graphicesigning">
              <div class="row"> 
                {{-- <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                  <img src="/landing-assets/images/graphic-design.jpg" alt="">
                </div> --}}
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-12">
                  <div class="managementMain">
                    <h3>Management Courses</h3>
                    <ul>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Marketing
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Human Resource Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Management Studies
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Hons
                        </a>
                      </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Business Administration in
                            Computer Applications
                          </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          International Business
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Tourism And Travel
                          Management
                        </a>
                      </li>
                        <li>
                        <a href="javascript:void(0);">
                          Certificate in Tourism And Travel
                          Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Retail Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Dilploma in Event Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Business Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Retail Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Entrepreneurship
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in front Office
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Digital Marketing
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Logistics Management 
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Information Technology
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Tourism And Travel Management
                        </a>
                      </li>
                    </ul>
                    <ul>    
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Tourism &amp; Travel Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Hospital Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Travel and Tourism
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Business Administration
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Hospitality &amp; Tourism
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Banking and Insurance
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Business Administration in
                          Hotel Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor in Hospital Administration
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Human Resource Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Financial Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of business Administration in
                          Tourism
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor in Tourism Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of business Administration in
                          Event Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BBA in Foreign Trade
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Advanced Diploma in Business 
                          Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BBA in Finance and Accounts
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Certificate in Human Resources
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Export and Import Management
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Certificate in Project Management
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Vertical tabs content01 end--> 
            <!-- Vertical tabs content02 start-->
            <div role="tabpanel" class="tab-pane fade" id="onlinemarketing">
              <div class="row">
               {{--  <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                  <img src="/landing-assets/images/internet-marketing.jpg" alt="">
                </div> --}}
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-12">
                  <div class="managementMain">
                    <h3>Engineering Courses</h3>
                    <p style="font-size:16px; padding-bottom:15px;">These courses are 4 years and full time.</p>
                    <ul>
                      <li>
                        <a href="javascript:void(0);">
                          B.tech Mechanical Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.tech Computer Science and Engineering 
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.tech Civil Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Mechanical Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Civil Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.tech Electrical and Electronics Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.tech Information technology
                        </a>
                      </li>
                        <li>
                          <a href="javascript:void(0);">
                            BE Computer Science and Engineering
                          </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Electronics &amp; Communication Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.tech Electrical Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Electrical and Electronics Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Information Technology
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Electrical Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Electronics and Communication Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Electronics &amp; Telecom Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Computer Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Biotechnology 
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Automobile Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Computer Engineering
                        </a>
                      </li>
                    </ul>
                    <ul>  
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Electronics &amp; Telecommunication Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Agricultural Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Automobile Engineering
                        </a>
                      </li>
                        <li>
                          <a href="javascript:void(0);">
                            B.Tech Food Technology
                          </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Information Science &amp; Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Electronics and Instrumentation Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Chemical Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Mining Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE BioMedical Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Aeronautical Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Aeronautical Engineering
                        </a>
                      </li>

                      <li>
                        <a href="javascript:void(0);">
                          BE Electronics and Instrumentation Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Mechatronics
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Computer Science
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech BioMedical Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Electronics Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Data Science
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          B.Tech Petroleum Engineering
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          BE Mechatronics Engineering
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Vertical tabs content02 end--> 
            <!-- Vertical tabs content03 start-->
            <div role="tabpanel" class="tab-pane fade" id="brandstrategy">
              <div class="row">
               {{--  <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5"><img src="/landing-assets/images/branding.jpg" alt=""></div> --}}
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-12">
                  <div class="managementMain">
                    <h3>Medical Courses</h3>
                    <ul>  
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Medicine
                        </a>
                      </li>
                       <li>
                        <a href="javascript:void(0);">
                          Bachelor of Surgery
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Physiotherapy
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Science in Medical Laboratory Technology
                        </a>
                      </li>

                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Medical Laboratory Technology
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Ayurvedic Medicine AND Surgery
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Homeopathic Medicine &amp; Surgery
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor of Science in Operation Threatre Technology
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Bachelor in Medical Laboratory Technology
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Physiotherapy
                        </a>
                      </li>
                      <li>
                        <a href="javascript:void(0);">
                          Diploma in Medical Radio Diagnosis
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Vertical tabs content03 end--> 
            <!-- Vertical tabs content04 start-->
            <div role="tabpanel" class="tab-pane fade" id="generalmedicine">
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-12">
                    <div class="managementMain">
                      <h3>Creative Courses</h3>
                      <ul>  
                        <li>
                          <a href="javascript:void(0);">
                            Diploma in Fashion Design
                          </a>
                        </li>
                         <li>
                          <a href="javascript:void(0);">
                            Certificate Course in Interior Design
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Certificate Course in Fashion Design
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Advanced Diploma in Fashion Design
                          </a>
                        </li>

                        <li>
                          <a href="javascript:void(0);">
                            BS in Digital Cinematography
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            SPA and Hospitality Management
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Diploma in Hair Styling and Hair Coloring
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            PGDEM-Post Graduate Diploma Course in Event Management
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            B.Sc Degree in  Fashion, Interior and Textile Design
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            B.Sc. in Food Chemistry
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            B.A. in Drawing and Painting (HONS)
                          </a>
                        </li>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
            <!-- Vertical tabs content04 end--> 
            <!-- Vertical tabs content05 start-->
            <div role="tabpanel" class="tab-pane fade" id="basicphotography">
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-12">
                    <div class="managementMain">
                      <h3>Commerce Courses</h3>
                      <ul>  
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce
                          </a>
                        </li>
                         <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Computer Applications
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce Hons
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Accounting and Finance
                          </a>
                        </li>

                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Corporate Secretaryship
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Banking and Insurance
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Taxation
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce Hons in Accountancy
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Finance
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce Hons in Accounting and Finance
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Certificate Course in Tally
                          </a>
                        </li>


                         <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Accountancy
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Professional 
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Co-Operation 
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Banking Management
                          </a>
                        </li>
                      </ul>

                       <ul>  
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Computer Science
                          </a>
                        </li>
                         <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Tax  Procedure and Practice
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Information Technology
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Financial Markets
                          </a>
                        </li>

                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Marketing
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Taxation and Finance
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in E-Commerce
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Foreign Trade Management
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Business Administration
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Banking &amp; Finance
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Financial Accounting
                          </a>
                        </li>


                         <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Accounting
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Management Studies
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Statistics
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">
                            Bachelor of Commerce in Economics
                          </a>
                        </li>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
            <!-- Vertical tabs content01 start--> 
          </div>
        </div>
        <!-- Vertical tabs content end--> 
      </div>
    </div>
  </section>
  <!--/Available course end--> 
  <!--popular courses start-->
   <section style="background-color:#fff; padding:80px 0px;" class="grey_section section_gap" id="courses">
    <div class="container">
      <div class="heading">
        <h1><span>Choose Your Dream College to Apply for</span>Admission </h1>
        <p>Admissionx is a leading search portal, where we
        provide admission facilities <span style="display:block;">and information related to
        colleges and courses.</span></p>
      </div>
      <ul class="hover_listing row" style="margin:20px -10px 0px 0;">
        <div class="">
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course1.jpg" alt="">
                </a>
              </div>
              <h3>
                <a href="javascript:void(0);">COMMERCE</a>
              </h3>
              <p>3000+ colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
            <div class="img">
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/courses/course2.jpg" alt=""></a>
              </div>
              <h3><a href="javascript:void(0);">LAW</a></h3>
              <p>1000+colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course3.jpg" alt="">
                </a>
              </div>
              <h3>
                <a href="javascript:void(0);">PARAMEDICAL</a>
              </h3>
             <p>1000+ colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course4.jpg" alt="">
                </a>
              </div>
              <h3>
                <a href="javascript:void(0);">PHARMACY</a>
              </h3>
              <p>1000+colleges  </p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course5.jpg" alt="">
                </a>
              </div>
              <h3><a href="javascript:void(0);">DESIGN</a></h3>
              <p>700+ colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course6.jpg" alt="">
                </a>
              </div>
              <h3><a href="javascript:void(0);">AGRICULTURE</a></h3>
              <p>600+ colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course7.jpg" alt="">
                </a>
              </div>
              <h3><a href="javascript:void(0);">DENTAL</a></h3>
              <p>100+ colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course8.jpg" alt="">
                </a>
              </div>
              <h3><a href="javascript:void(0);">ARCHITECTURE</a></h3>
              <p>500+colleges</p>
          </li>
        </div>
        <div class="viewAllCategoryBlock text-center hide">
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
            <div class="img">
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/courses/course9.jpg" alt="">
              </a>
            </div>
            <h3><a href="javascript:void(0);">ANIMATION</a></h3>
            <p>300+colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
            <div class="img">
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/courses/course10.jpg" alt="">
              </a>
            </div>
            <h3><a href="javascript:void(0);">AVIATION</a></h3>
            <p>200+colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
            <div class="img">
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/courses/course11.jpg" alt="">
              </a>
            </div>
            <h3><a href="javascript:void(0);">COMPUTER APPLICATION</a></h3>
            <p>3000+colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course12.jpg" alt="">
                </a>
              </div>
              <h3><a href="javascript:void(0);">MASS MEDIA</a></h3>
              <p>972+ colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course13.jpg" alt="">
                </a>
              </div>
              <h3><a href="javascript:void(0);">HOTEL MANAGEMENT</a></h3>
              <p>800+ colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course14.jpg" alt="">
                </a>
              </div>
              <h3><a href="javascript:void(0);">MBA</a></h3>
              <p>2000+ colleges</p>
          </li>
          <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
              <div class="img">
                <a href="javascript:void(0);">
                  <img src="/landing-assets/images/courses/course15.jpg" alt="">
                </a>
              </div>
              <h3><a href="javascript:void(0);">ENGINEERING</a></h3>
              <p>3000+ colleges</p>
          </li>
        </div>
      </ul>
      <p  class="text-center noPadd">
        <a id="" style="" href="javascript:void(0);" class="btn btn-primary btn-lg viewMoreCategoryBtn" role="button">View all Courses</a>
        <a  id="" href="javascript:void(0);" class="btn btn-primary btn-lg hide viewLessCategoryBtn" role="button">View Less</a>
      </p>
    </div>
  </section>
  <!--/popular courses end--> 
  <!--fun facts start -->
  <section class="yellow_section numbers_section factabout" style="padding-top:70px;">
    <div class="container">
      <ul class="numbers countarea row">
        <li> <i class="fa fa-smile-o"></i>
          <h3 class="timer" data-from="100" data-to="4500" data-speed="10000">&nbsp;</h3>
          <span>Happy Student</span> </li>
        <li> <i class="fa fa-smile-o"></i>
          <h3 class="timer" data-from="100" data-to="16900" data-speed="10000">&nbsp;</h3>
          <span>Total Colleges</span> </li>
        <li> <i class="fa fa-smile-o"></i>
          <h3 class="timer" data-from="100" data-to="1505" data-speed="10000">&nbsp;</h3>
          <span>Total Courses</span> </li>
        <li> <i class="fa fa-smile-o"></i>
          <h3 class="timer" data-from="100" data-to="490" data-speed="10000">&nbsp;</h3>
          <span>Total Examination</span> </li>
        <li> <i class="fa fa-smile-o"></i>
          <h3 class="timer" data-from="100" data-to="550" data-speed="10000">&nbsp;</h3>
          <span>Certification</span> </li>
      </ul>
    </div>
  </section>
  <!--fun facts end --> 
  <!-- Teachers details start-->
  <section class="grey_section section_gap" id="teachers" style="padding:80px 0px 60px;">
    <div class="container">
      <div class="heading">
        <h1><span>Popular Colleges on</span>our portal</h1>
        <p>We have listed down some of the colleges which are getting
          most searched on your platform.</p>
      </div>
      <ul class="hover_listing row"> <!-- Teacher 01 details start-->
        <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
          <div class="img"><img src="/landing-assets/images/university/university1.jpg" alt="teacher1">
          </div>
          <h3 class="uppercase" style="font-size:14px;">Lovely Professional University</h3>
          <h4 style="font-size:14px;">(New Delhi/ India) Master of Business Administration</h4>
          <p>Total Fees: ₹ 3.50 Lakh<br>2 years<br>Full Time</p>



        </li>
        <!-- Teacher 01 details end--> 
        <!-- Teacher 02 details start-->
        <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
          <div class="img"><img src="/landing-assets/images/university/university2.jpg" alt="teacher2">
          </div>
          <h3 class="uppercase" style="font-size:14px;">Amity University, Noida</h3>
          <h4 style="font-size:14px;">B.A. in Journalism and Mass Communication</h4>
          <p>Total Fees: ₹ 8.07 Lakh<br> 3 years<br>Full Time </p>
        </li>
        <!-- Teacher 02 details end--> <!-- Teacher 03 details start-->
        <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
          <div class="img"><img src="/landing-assets/images/university/university3.jpg" alt="teacher3">
          </div>
          <h3 style="font-size:14px;" class="uppercase">Delhi University (DU)</h3>
          <h4 style="font-size:14px;">BBA in Financial and Investment<br>Analysis</h4>
          <p>Total Fees: INR 69,105<br> 3 years<br>Full time </p>
        </li>
        <!-- Teacher 03 details end--> 
        <!-- Teacher 04 details start-->
        <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3 noPadd">
          <div class="img"><img src="/landing-assets/images/university/university4.jpg" alt="teacher4">
          </div>
          <h3 class="uppercase" style="font-size:14px;">IIT Bombay - Indian Institute of Technology</h3>
          <h4 style="font-size:14px;">B.Tech. in Computer Science and Engineering</h4>
          <p>Total Fees: ₹ 8.55 Lakh<br> 4 years<br>Full Time</p>
        </li>
        <!-- Teacher 04 details end-->
      </ul>
    </div>
  </section>
  <!-- Teachers details end--> 
  <!--Pricing Tables start-->
  <section class="pricingtables section_gap" id="pricing" style="padding:40px 0px;">
    <div class="container">
     
    </div>
  </section>
  <!--Pricing Tables end --> 
  <!--Happy Students star-->
  <section class="white_section section_gap" id="testimonial">
    <div class="container">
      <div class="heading">
        <h1><span>Happy Students,</span>Happy us!</h1>
        <p>Positive reviews motivates us to provide more value services to students which
        ease their admission process.</p>
      </div>
      
      <div class='row'>
          <div class='col-md-offset-2 col-md-8'>
              <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                <ol class="carousel-indicators">
                  <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                  <li data-target="#quote-carousel" data-slide-to="1"></li>
                  <li data-target="#quote-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                      <blockquote>
                          <div class="row">
                            {{-- <div class="col-sm-3 text-center">
                                 <img class="img-circle" src="http://www.reactiongifs.com/r/overbite.gif" style="width: 100px;height:100px;">
                                  <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">
                            </div> --}}
                            <div class="col-sm-9">
                                <p>This portal is simply amazing! Admissionx helped me to
                                  get admission in my dream college, and I got a discount
                                  on my college fees too. Thank you so much, keep it up</p>
                               {{--  <small>Someone famous</small> --}}
                            </div>
                          </div>
                      </blockquote>
                    </div>
                  <div class="item">
                      <blockquote>
                          <div class="row">
                            {{-- <div class="col-sm-3 text-center">
                                <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/mijustin/128.jpg" style="width: 100px;height:100px;">
                            </div> --}}
                            <div class="col-sm-9">
                                <p>Admissionx is a one-stop solution for all latest updates
                                related to colleges, exams, cut off and admission.</p>
                                {{-- <small>Someone famous</small> --}}
                            </div>
                          </div>
                      </blockquote>
                  </div>
                    <div class="item">
                      <blockquote>
                          <div class="row">
                            {{-- <div class="col-sm-3 text-center">
                                <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/keizgoesboom/128.jpg" style="width: 100px;height:100px;">
                            </div> --}}
                            <div class="col-sm-9">
                                <p>An excellent platform for all the aspiring students
                                  provides you with a bundle of information, related to the
                                  courses and its scope in India. What’s more? They also
                                  provide counselling service which erases your doubt of
                                  what to choose and what not.</p>
                                {{-- <small>Someone famous</small> --}}
                            </div>
                          </div>
                      </blockquote>
                    </div>
                </div>
                {{-- <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a> --}}
              </div>                          
          </div>
      </div>
    </div>
  </section>
  <!--/Happy Students end--> 
  <!--Newsletter section star -->
  <section class="yellow_section section_gap" id="blog">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-7">
          <h3 class="signup_text">Sign up now to get the latest update related to your favourite colleges, courses and exams.</h3>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
          <div id="mesaj"></div>
          <div class="row">
            <div class="col-md-12">
              @if(Session::has('blogs-session-msg'))
                <div class="alert alert-info alert-dismissable text-center">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  {{ Session::get('blogs-session-msg') }}                        
                </div>
              @endif
            </div>
          </div>
          <!-- <form method="post"{{--  action="http://themeelite.com/demos/e-learn/image+text-rotator/php/subscribe.php" --}} name="sform" id="subscribeform"> -->
          <form action="{{ URL::to('/mailchimp-blogs') }}" method="POST" data-parsley-validate>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" id="subemail" class="normal" name="email" placeholder="Email Address" data-parsley-type="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 button">
                <input type="submit" name="send" class="button" value="Subscribe">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!--/Newsletter section end--> 
   
  <!--Bottom Four Column start-->
  <section class="blue_section section_gap" style="padding:80px 0px;">
    <div class="container">
      <div class="row bottomfourcol"> 
        <!-- Footer About us start-->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bottomAbout">
          <h5 class="heading">About us</h5>
          <p>Admissionx is a search engine platform where a student can apply for admission,
          counselling service, seek information related to colleges, courses, exams &amp; cut-
          offs.</p>
          {{-- <h5>Connect with us</h5>
          <div class="socialshare">
            <a href="#"><i class="fa fa-facebook"></i></a> 
            <a href="#"><i class="fa fa-instagram"></i></a> 
            <a href="#"><i class="fa fa-twitter"></i></a> 
            <a href="#"><i class="fa fa-linkedin"></i></a>
          </div> --}}
        </div>
        <!-- Footer About us end--> 
        <!-- Footer Recent news start-->
       
        <!-- Footer Recent news end--> 
        <!-- Footer How it works start-->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <h5 class="heading">How it Works?</h5>
          <p>We have tie-ups with major institutes and colleges which are listed on our portal,
            a user or student can login to the dashboard and can apply for admission to their
            choice of college hassle- free and get updates related to their admission status</p>
          {{-- <ul class="list">
            <li>Phasellus mattis felis quis enim</li>
            <li>Nullam porta risus vitaeuik dapibus </li>
            <li>Phasellus mattis felis quis enim </li>
            <li>Vivamus sit amet ligulague semper</li>
          </ul> --}}
        </div>
         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <h5 class="heading">Connect with us</h5>
           <div class="socialshare">
            <a href="https://www.facebook.com/AdmissionX/" target="_blank"><i class="fa fa-facebook"></i></a> 
            <a href="https://www.instagram.com/admissionxofficial/"><i class="fa fa-instagram"></i></a> 
            <a href="https://twitter.com/adxdotcom" target="_blank"><i class="fa fa-twitter"></i></a> 
            <a href="https://in.linkedin.com/company/officialadx" target="_blank"><i class="fa fa-linkedin"></i></a>
          </div>
        </div> 
        <!-- Footer How it works end--> 
        <!-- Footer we accept start-->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 contactInfo">
          <h5 class="heading">We Accept</h5>
          {{-- <p>Phasellus mattis felis quis enim viverratys accumsan. Nullam porta risus felis, vitaeuik dapibus arcu viverra eu.</p> --}}
          <ul>
            <li>
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/google-pay.jpg"  alt="google-pay">
              </a>  
            </li>
            <li>
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/paytm.jpg"  alt="paytm">
              </a>  
            </li>
            <li>
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/visa-one.jpg"  alt="visa-one">
              </a>  
            </li>
            <li>
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/master-card.jpg"  alt="master-card">
              </a>  
            </li>
            <li>
              <a href="javascript:void(0);">
                <img src="/landing-assets/images/mobikwik.jpg"  alt="mobikwik">
              </a>  
            </li>
          </ul>
        </div>
        <!-- Footer we accept end--> 
      </div>
    </div>
  </section>
  <!--/Bottom Four Column end --> 
  <!--Footer start-->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="pull-left">
          <p>&copy; Copyright © 2016 - 2020 | All Rights Reserved.AdmissionX
          </p>
        </div>
        <div class="pull-right"><a class="gototop smooth" href="#wrapper">Go To Top<i class="fa fa-chevron-up"></i></a></div>
      </div>
    </div>
  </footer>
  <!--Footer end --> 
</div>
<!--wrapper end--> 

<!--modernizr js--> 
<script type="text/javascript" src="/landing-assets/js/modernizr.custom.26633.js"></script> 
<!--jquary min js--> 
<script type="text/javascript" src="/landing-assets/js/jquery-1.11.2.min.js"></script> 
<script src="/landing-assets/js/bootstrap.min.js"></script> 
{!! Html::script('assets/administrator/js/parsley.js') !!}
<script  src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" ></script>
<script type="text/javascript">
  $('form').parsley();
  $(".alert").fadeTo(10000, 500).slideUp(500, function(){
      $(".alert").alert('close');
  });
</script>
<script type="text/javascript">
  @if(Session::get('is_open_popup_window_status') == 1)
    $(window).ready(function () {
      toastr.success('{{Session::get('is_open_popup_window_text')}}');
      {{ session()->forget('is_open_popup_window_status') }}
      {{ session()->forget('is_open_popup_window_text') }}
    });
  @endif
</script>

<!--for placeholder jquery--> 
<script type="text/javascript" src="/landing-assets/js/jquery.placeholder.js"></script> 

<!--for header jquery--> 
<script type="text/javascript" src="/landing-assets/js/stickUp.js"></script> 
<script src="/landing-assets/js/jquery.superslides.js" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript">
"use strict";
//<![CDATA[
  $('.header_v1 #banner').superslides({
    animation: 'fade',
    play: 5000
  });
//]]>
</script> 

<!--for portfolio jquery--> 
<script src="/landing-assets/js/jquery.isotope.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" property="stylesheet" id="theme" href="/landing-assets/css/jquery-ui-1.8.16.custom.css">
<link type="text/css" rel="stylesheet" property="stylesheet" href="/landing-assets/css/lightbox.min.css">
<script type="text/javascript" src="/landing-assets/js/jquery.ui.widget.min.js"></script> 
<script type="text/javascript" src="/landing-assets/js/jquery.ui.rlightbox.js"></script> 

<!--for video lightbox -->
<link rel="stylesheet" property="stylesheet" href="/landing-assets/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" />
<script src="/landing-assets/js/jquery.prettyPhoto.js" type="text/javascript"></script>

<!--contact form js--> 
<script type="text/javascript" src="/landing-assets/js/jquery.contact.js"></script> 
<!--Newsletter js--> 
<script type="text/javascript" src="/landing-assets/js/jquery.subscribe.js"></script> 
<!-- <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxSPW5CJgpdgO_s4yyMovOaVh_KvvhSfpvagV18eOyDWu7VytS6Bi1CWxw" type="text/javascript"></script> -->
<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKlTjj72lhQm1xqvMI5LPRP4uyBKfP3BY"></script>

<script type="text/javascript">
  "use strict";
    //<![CDATA[
    var map;

    function load() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(-37.817682, 144.957595), 13);
        document.getElementById("map").checked = true;
        toggleZoom(false);
      }
    }

    function toggleZoom(isChecked) {
      if (isChecked) {
        map.enableScrollWheelZoom();
      } else {
        map.disableScrollWheelZoom();
      }
    }

    //]]>
</script> 

<!--about jquery--> 
<script src="/landing-assets/js/jquery.classyloader.min.html"></script> 
<script defer src="/landing-assets/js/jquery.flexslider.js"></script> 
<script src="/landing-assets/js/jquery.easing.js"></script> 
<script src="/landing-assets/js/jquery.mousewheel.js"></script> 
<script defer src="/landing-assets/js/slideroption.js"></script> 

<!--Home Testimonial --> 
<script>


</script> 

<!--for coundown jquary--> 
<script type="text/javascript" src="/landing-assets/js/jquery.countTo.js"></script> 
<script type="text/javascript" src="/landing-assets/js/jquery.countTo.js"></script> 
<script type="text/javascript">
jQuery(function($) {
$(document).ready( function() {
  //enabling stickUp on the '.navbar-wrapper' class
  $('.navbar-wrapper').stickUp({
    parts: {
      0: 'banner',
      1: 'features',
      2: 'courses',
      3: 'teachers',
      4: 'pricing',
      5: 'testimonial',
      6: 'blog',
      7: 'contact'
    },
    itemClass: 'menuItem',
    itemHover: 'active',
    topMargin: 'auto'
    });
  
    // run rlightbox
    $( ".lb" ).rlightbox();
    $( ".lb_title-overwritten" ).rlightbox({overwriteTitle: true});
    
    $('.flexslider').flexslider({
      animation: "fade",
      animationLoop: true,
      slideshow: true,
      pauseOnAction: false,
      slideshowSpeed: 7000,
      controlNav: true,
      start: function(slider){
      $('body').removeClass('loading');
      }
    });   
  
  var activeImage;

  var getmaxHeight = 0;
  $(".testimonialText li").each(function(index, element) {
        if($(this).height()>getmaxHeight){
      getmaxHeight = $(this).height();
      $(".footerTopContent").height(getmaxHeight);
      }
    });
  
    $(".testimonialText li").fadeTo("fast",0);
  $(".testimonialText li:first").fadeTo("fast",1);
  $(".imageSlide .imageBox").removeClass("activeImage");
  $(".imageSlide .imageBox:first").addClass("activeImage");
  $(".imageSlide .imageBox").mouseenter(function(){
    if(!$(this).hasClass("activeImage")){
      var gi = $(this).index();
      //console.log(gi);
      $(".imageSlide .imageBox").removeClass("activeImage");
      $(this).addClass("activeImage");
      $(".testimonialText li").fadeTo("fast",0);
      $(".testimonialText li:eq("+gi+")").fadeTo("fast",1);
      }
  })
    
  // Video lightbox
  $("a[data-rel^='prettyPhoto']").prettyPhoto();  
  
  // for client work jquary
  var windowBottom = $(window).height()+0;
  var index=0;
  $(document).scroll(function(){
    divposition = parseInt($('.factabout').offset().top),10;
    divsrollpos = parseInt($(window).scrollTop()),10;
    ctop = parseInt(divposition-divsrollpos),10;
    if(ctop<Math.round(windowBottom/2)){
      if(index==0){ 
        
        $('.timer').each(count);
        
      }
      index++;
    }
  });



function count(options) {
  var $this = $(this);
  options = $.extend({}, options || {}, $this.data('countToOptions') || {});
  $this.countTo(options);
}
  
  
  });

});
</script> 


<script type="text/javascript">
  function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
initializeClock('clockdiv', deadline);
</script> 
<script type="text/javascript">
  var flkty = new Flickity( '.main-gallery', {
  cellAlign: 'left',
  contain: true,
  wrapAround: true,
  prevNextButtons: false,
  autoPlay: 5000
}); 
</script>
<script type="text/javascript">
  // When the DOM is ready, run this function
$(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pause: true,
    interval: 4000,
  });
});


</script>
<script type="text/javascript">
  $(document).on('click','.viewMoreCategoryBtn', function(){
      $('.viewAllCategoryBlock').removeClass('hide');
      $('.viewLessCategoryBtn').removeClass('hide');
      $('.viewMoreCategoryBtn').addClass('hide');
    });

    $(document).on('click','.viewLessCategoryBtn', function(){
      $('.viewAllCategoryBlock').addClass('hide');
      $('.viewLessCategoryBtn').addClass('hide');
      $('.viewMoreCategoryBtn').removeClass('hide');
    });
</script>

<!--Theme switcher -->
<script type="text/javascript" src="/landing-assets/switcher/js/jquery.cookie.js"></script> <!-- jQuery cookie --> 
<script type="text/javascript" src="/landing-assets/switcher/js/styleswitch.js"></script> <!-- Style Colors Switcher -->

<!--for theme custom jquery--> 
<script src="/landing-assets/js/custom.js"></script>
<!-- Start Style Switcher -->
{{-- <div class="switcher"></div> --}}
<!-- End Style Switcher -->
</body>

<!-- Mirrored from themeelite.com/demos/e-learn/image+text-rotator/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Jul 2020 22:06:24 GMT -->
</html>