
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techjcs.com/education/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 May 2020 01:41:12 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edu-Counselor: Top Schools, Exam & Courses in India </title>

        <!-- Required CSS files -->

    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    {!! Html::style('/new-assets/css/owl.carousel.css') !!}
    {!! Html::style('/new-assets/css/barfiller.css') !!}
    {!! Html::style('/new-assets/css/animate.css') !!}
    {!! Html::style('/new-assets/css/font-awesome.min.css') !!}
    {!! Html::style('/new-assets/css/bootstrap.min.css') !!}
    {!! Html::style('/new-assets/css/slicknav.css') !!}
    {!! Html::style('/new-assets/css/main.css') !!}
</head>
@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
{{--*/   
    $listOfCareerStream = $fetchDataServiceController->listOfCareerStream(1);
    $listOfPopularCareer = $fetchDataServiceController->listOfPopularCareer(1);
    $listOfCareerCourses = $fetchDataServiceController->listOfCareerCourses(1);
    $stateBoards = $fetchDataServiceController->listOfBoardDetails('State');
    $nationalBoards = $fetchDataServiceController->listOfBoardDetails('National');
    $listOfExamination = $fetchDataServiceController->listOfExamination(1);
    //print_r($listOfCareerCourses);die;
/*--}}
<body>
    <div class="preloader">
        <span class="preloader-spin"></span>
    </div>
    <div class="site">
        <nav id="top-bar" class="tab-hidden mobile-hidden" >
        	<div class="container">
                <div class="row">
                	<ul class="nav navbar-nav navbar-main">
                		<li class="main-navbar-tab"><a href="{{ URL::to('top-college-page') }}" class="">top schools</a></li>
                		<li class="main-navbar-tab"><a href="{{ URL::to('top-college-page') }}" class="">top universities</a></li>
                		<li class="main-navbar-tab"><a href="{{ URL::to('top-college-page') }}" class="">top courses</a></li>
                		<li class="main-navbar-tab"><a href="{{ URL::to('top-college-page') }}" class="">colleges</a></li>
                		<li class="main-navbar-tab"><a href="{{ URL::to('top-college-page') }}" class="">exams</a></li>
                		<li class="main-navbar-tab"><a href="{{ URL::to('top-college-page') }}" class="">REVIEWS</a></li>
                		<li class="main-navbar-tab"><a href="{{ URL::to('top-college-page') }}" class="">news</a></li>
                		<li class="main-navbar-tab"><a href="{{ URL::to('top-college-page') }}" class="">ADMISSION 2020</a></li>
                	</ul>

                	<ul class="nav nav-right">
                		<li><i class="fa fa-question-circle-o"></i> Ask</li>
                		<li><i class="fa fa-user"></i> Login | Signup</li>
                	</ul>


                </div>
            </div>    	
        </nav>
       {{--  <header>
            <div class="container">
                <div class="row">
                    <div class="col-6 col-sm-3 logo-column">
                        <a href="{{ URL::to('demo-new-home') }}" class="logo text-dark">
                            Edu-Counselor
                        </a>
                    </div>
                    <div class="col-6 col-sm-9 nav-column clearfix">
                        <div class="right-nav">
                            <span class="search-icon fa fa-search"></span>
                            <form action="#" class="search-form">
                                <input type="search" placeholder="search now">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <div class="header-social">
                                <a href="#" class="fa fa-facebook"></a>
                                <a href="#" class="fa fa-twitter"></a>
                            </div>
                        </div>
                        <nav id="menu" class="d-none d-lg-block navigationTopNav">
                            <ul>
                                <li class="current-menu-item"><a href="{{ URL::to('/demo-new-home') }}">Home</a></li>
                                <li><a href="{{ URL::to('top-college-page') }}">Schools</a></li>
                                <li><a href="{{ URL::to('top-college-page') }}">Collage</a></li>                         
                                <li><a href="#">Study Abroad</a></li>
                                <li><a href="#">Counseling</a></li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Examination <i class="fa fa-chevron-down"></i></a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        @foreach( $listOfExamination as $key => $item )
                                                            <li style="line-height: 30px !important;" class="@if($key == 0) active @endif"> <a style="font-size: 12px !important;" href="#tabExam{{$key}}" data-toggle="tab">{{$item->name}} Exams</a>
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
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/examination-details/'.$item->slug.'/'.$item1->slug) }}">{{$item1->sortname}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/examination-list/'.$item->slug) }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All {{$item->name}} Exams</a></li>
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
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header> --}}

        <style type="text/css">
            

.headerTopMain{ background:#f5f6f9; border-bottom:#efefef solid 1px; }
.headerTopLeft ul li, .headerTopRight ul li, .exploreCategorybotRightBot ul li, .exploreCategorybotRightDesign ul li{ display:inline;}
.headerTopLeft ul li a{ display:inline-block;  font-size:15px; padding-right:3%; color:#000000; font-weight:500; }
.headerTopRight ul li a{ display:inline-block; font-size:15px; color:#000000; font-weight:500; }
.stickyHeader{ position: fixed; top: 0; width: 100%; background:#fff !important;
 z-index:999 !important; padding: 0px !important;  }
.navigationTopContent{ float: right; padding-right:0px;}
.navigationTopContent ul li a{ background-color:unset !important;
 font-family: open sans, serif; color:#000 !important;
 text-transform:capitalize; font-size:14px; font-weight:600;}
.navigationTop .navigationTopContentco1>.active>a{ background-color:unset !important; color:#f00 !important; }
.navigationTop{ 
  margin-bottom:unset !important; 
  background-color:unset !important;
   border:unset !important; border-bottom:unset !important; }


.navigationTopNav ul li{ position:relative;  padding:0 5px; transition: all 1s ease;}
.navigationTopNav ul li a{ text-decoration:none; color:#000; text-transform:capitalize; 
 }
.navigationTopNav ul li .dropdownmenu{  width:89%; z-index:998;
 position:fixed; left:0px; display:none;}
.navigationTopNav ul li .dropdownmenu .container{ position:absolute;
right: 0px; width: 65%; line-height:50px; background:#eee;  }
.navigationTopNav ul li:hover .dropdownmenu{ display:block;}
.navigationTopNav ul li a>i{  transition: all 1s ease; }
.navigationTopNav ul li:hover i{ transform: rotate(180deg);  }
.navigationTopNav ul li .dropdown-toggle:after{ transition:all 0.5s ease;}
.navigationTopNav ul li:hover .dropdown-toggle:after{ transform:rotate(180deg);}
.dropdownNavTabMain{ padding:0px;}

/*Dropdown start*/
.dropdownNavTabMain{  display: flex;  flex-wrap: wrap; }
.dropdownNavTab{ position: relative; background: #fff;  width:245px; float: left; }
.dropdownNavTabContent{ width: calc(100% - 245px);
   float: left; padding:8px 0 0px 18px; background-color: unset;  border: unset;}
.dropdownNavTab li{ width: 245px; display:inline; padding:0px 0 0 15px !important; transition:all 2s ease; }
.dropdownNavTab li a{ font-family: 'Open Sans', sans-serif; color:#000 !important; font-size:14px !important;
 display:inline-block !important;  line-height: 40px;
 border:unset !important; font-weight: unset !important;
 box-shadow:unset !important; padding:0px !important;  }
.dropdownNavTab li:hover, .dropdownNavTab li.active{ border-left:#f00 solid 2px;  
 background:#eee !important; color:#f00 !important; }
.dropdownNavTab li i{ width:100%; font-size:14px !important; position: absolute; right: 0px; top: 19px;  }
.dropdownNavTabContentBot ul li a{ display:block; line-height:35px;
 font-size:14px !important; color:#666; font-weight: normal; }
.dropdownNavTabContentBot ul li a:hover{ color:#000; }
.submenutext{  font-family: 'Open Sans', sans-serif; display:block;  line-height:30px !important;
 font-size:13px !important; color:#666; font-weight: normal !important; }






@media (min-width:320px) and (max-width:767px) {

.dropdownNavTab li { width: 276px;}
.navigationTopNav ul li .dropdownmenu .container{ width: 95% !important;  position: relative;}
.dropdownNavTab li a{ font-size:14px !important; }
.dropdownNavTab { width: 100%; height: auto;}
.dropdownNavTabContentBot ul li a{ width:100px; }
.navigationTopNav ul li .dropdownmenu { width: 100%; position: relative;}
.navigationTopContent{ overflow: scroll !important;  height: 500px;}
.navigationTopNav ul li a>i{ float:right;}
.navigationTopContent{ width:100%; padding-left:0px; }
.navigationTopNav ul li:hover .dropdownmenu{ display: none; }
.navigationTopNav ul li.dropdownhover .dropdownmenu{ display:none; }
.navigationTopNav ul li.dropdownhover .dropdownmenu.active{ display:block; }

}

        </style>

        <div  class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end navigationTopNav" id="navbarNav">
                              <ul class="nav navbar-nav">
                                <li class="active"><a href="#">home</a></li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Examination <i class="fa fa-chevron-down"></i></a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        @foreach( $listOfExamination as $key => $item )
                                                            <li style="line-height: 30px !important;" class="@if($key == 0) active @endif"> <a style="font-size: 12px !important;" href="#tabExam{{$key}}" data-toggle="tab">{{$item->name}} Exams</a>
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
                                                                        <li style="line-height: 25px; font-size: 13px;"><a href="{{ URL::to('/examination-details/'.$item->slug.'/'.$item1->slug) }}">{{$item1->sortname}}</a></li>
                                                                        @endforeach
                                                                        <li><a class="submenutext" href="{{ URL::to('/examination-list/'.$item->slug) }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All {{$item->name}} Exams</a></li>
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
                                <li><a href="#">Study Abroad</a></li>
                                <li><a href="#"> Commerce </a></li>
                                <li><a href="#">Engineering</a></li>
                                <li class="hide"><a href="{{ URL::to('counselling') }}">Counselling</a></li>
                                <li class="dropdownhover">
                                    <a href="javascript:void(0);">Counselling <i class="fa fa-chevron-down"></i> </a>
                                    <div class="col-md-12 dropdownmenu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 dropdownNavTabMain">
                                                    <ul class="nav nav-pills dropdownNavTab">
                                                        <li style="line-height: 25px !important; font-size: 12px !important; " class="active"> <a  href="#tabCareerStream" data-toggle="tab">Career By Stream </a></li>
                                                        <li style="line-height: 25px !important; font-size: 12px !important; "><a  href="#tabPopularCareer" data-toggle="tab">Poplar Careers</a></li>
                                                        @foreach( $listOfCareerCourses as $key => $item )
                                                        <li style="line-height: 25px !important; font-size: 12px !important; "><a  href="#tab{{$item->educationLevelSlug}}" data-toggle="tab">Careers After {{$item->name}}</a></li>
                                                        @endforeach
                                                        <li style="line-height: 25px !important; font-size: 12px !important; "><a  href="#tabNationalBoard" data-toggle="tab">National Boards</a></li>
                                                        <li style="line-height: 25px !important; font-size: 12px !important; "><a  href="#tabStateBoard" data-toggle="tab">State Boards</a></li>
                                                    </ul>
                                                    <div class="tab-content well dropdownNavTabContent">
                                                        <div class="tab-pane active" id="tabCareerStream">
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
                                                        <div class="tab-pane" id="tabPopularCareer">
                                                            <div class="col-md-12">
                                                                <div class="dropdownNavTabContentBot">
                                                                    <div class="row">
                                                                        @foreach($listOfPopularCareer as $key => $item)
                                                                        <div class="col-md-6">
                                                                            <a class="submenutext" href="{{ URL::to('/popular-careers/'.$item->slug) }}">{{ $item->title }}</a>
                                                                        </div>
                                                                        @endforeach
                                                                        <div class="col-md-6"><a class="submenutext" href="{{ URL::to('/popular-careers') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Other Careers</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                <li><a href="{{ URL::to('education-blogs') }}">blogs</a></li>
                            </ul>
                        </div>
                    </nav>
                    
                </div>
            </div>
        </div>



        <div class="hero-slider">
           
            <div class="single-slide" style="background-image: url(new-assets/img/slider.jpg)">
                <div class="inner">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 text-center">
                                <div class="slide-content">
                                    <h2 class="tab-hidden mobile-hidden">FIND OVER  
                                       <span
                                          class="txt-rotate"
                                          data-period="2000"
                                          data-rotate='[ "11000 Schools", "150 Exams", "24000 Colleges", "6000+ Courses"]'></span> IN INDIA
                                      </h2>
                                      <h2 class="desktop-hidden">FIND OVER <br/> 
                                       <span
                                          class="txt-rotate"
                                          data-period="2000"
                                          data-rotate='[ "11000 Schools", "150 Exams", "24000 Colleges", "6000+ Courses"]'></span> IN INDIA
                                      </h2>
                                    <div class="header-search-container">
                                    <input type="text" name="search" placeholder="SEARCH" id="header-search">
                                    <button class="searchbtn"><i class="fa fa-search"></i></button></div>
                                       <div class="header-bottom">
                                       	   <p>Best schools in dehradun</p>
                                           <a href="#" class="headerbtn">Read More</a>
                                        </div>
                                        
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>

        <div class="main-explore-section section sp">
        	<div class="container">
                <div class="section-title">
                    <h2>Explore Almost Everything</h2>          
                </div>
                <div class="row">
                	<div class="col-md-4 text-center">
                	  <div class="single-box">
                		<img src="new-assets/img/school.png">
                		<h3>Find Best School</h3>
                		<p class="mobile-hidden tab-hidden">Find Best Top Schools in your city by Level, Board, Area, Pincode, Facilities </p>
                	   </div>
                	</div>
                	<div class="col-md-4 text-center">
                		 <div class="single-box">
                		<img src="new-assets/img/exam.png">
                		<h3>Explore Exams</h3>
                		<p class="mobile-hidden tab-hidden">All information about the exams that will get you into your dream school.</p>
                		</div>
                	</div>
                	<div class="col-md-4 text-center">
                		 <div class="single-box">
                		<img src="new-assets/img/addmission.png">
                		<h3>Get Addmission</h3>
                		<p class="mobile-hidden tab-hidden">Find Information about the admission procedure and School fees. </p>
                		</div>
                	</div>
                	<div class="col-md-4 text-center">
                		 <div class="single-box">
                		<img src="new-assets/img/newspaper.png">
                		<h3>Get Latest Updates</h3>
                		<p class="mobile-hidden tab-hidden">Stay informed about the latest updates of school, exam, courses.</p>
                		</div>
                	</div>
                	<div class="col-md-4 text-center">
                	  <div class="single-box">
                		<img src="new-assets/img/course.png">
                		<h3>Top Courses</h3>
                		<p class="mobile-hidden tab-hidden">Learn about various mix of courses offered across the country.</p>
                		</div>
                	</div>
                	<div class="col-md-4 text-center">
                	  <div class="single-box">
                		<img src="new-assets/img/review.png">
                		<h3>Top Reviews</h3>
                		<p class="mobile-hidden tab-hidden">Know what others have to say about the schools you are searching.</p>
                	  </div>	
                	</div>                	
                </div>           
        	</div>
        </div>


<div class="portfolio-area sp section featured-school">
    <div class="container">
        <div class="section-title">
            <h2>Top Featured Schools of India</h2>          
        </div>
        <div class="row">
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        <img src="new-assets/img/ecole-globale.jpg" alt="portfolio-image">
                        <div class="hover-content">
                            <div>
                                <a href="{{ URL::to('college-list-page') }}" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="{{ URL::to('college-list-page') }}"><h3>Ecole Globale International Girls' School</h3></a>
                        <span>Dehradun</span>
                    </div>
                </div>
            </div>
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        <img src="new-assets/img/the-sanskaar-valley.jpg" alt="portfolio-image">
                        <div class="hover-content">
                            <div>
                                <a href="#" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="#"><h3>The Sanskaar Valley School</h3></a>
                        <span>Bhopal</span>
                    </div>
                </div>
            </div>
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        <img src="new-assets/img/Maharaja-Sawai-Bhawani-Singh-School.jpg" alt="portfolio-image">
                        <div class="hover-content">
                            <div>
                                <a href="#" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="#"><h3>Maharaja Sawai Bhawani Singh School</h3></a>
                        <span>Jaipur</span>
                    </div>
                </div>
            </div>
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        <img src="new-assets/img/Little-Angels-School.jpg" alt="portfolio-image">
                        <div class="hover-content">
                            <div>
                                <a href="#" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="#"><h3>Little Angels High School</h3></a>
                        <span>Gwalior</span>
                    </div>
                </div>
            </div>
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        <img src="new-assets/img/hyderabad-public-school.jpg" alt="portfolio-image">
                        <div class="hover-content">
                            <div>
                                <a href="#" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="#"><h3>Hyderabad Public School</h3></a>
                        <span>Hyderabad</span>
                    </div>
                </div>
            </div>
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        <img src="new-assets/img/asian-school.jpg" alt="portfolio-image">
                        <div class="hover-content">
                            <div>
                                <a href="#" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="#"><h3>The Asian School</h3></a>
                        <span>Dehradun</span>
                    </div>
                </div>
            </div>
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        <img src="new-assets/img/St-John-s-High-School.jpg" alt="portfolio-image">
                        <div class="hover-content">
                            <div>
                                <a href="#" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="#"><h3>St. John’s High School</h3></a>
                        <span>Chandigarh</span>
                    </div>
                </div>
            </div>
            <div class="single-portfolio col-md-3">
                <div class="inner">
                    <div class="portfolio-img">
                        <img src="new-assets/img/delhi-public-school.jpg" alt="portfolio-image">
                        <div class="hover-content">
                            <div>
                                <a href="#" >Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <a href="#"><h3>The Future Foundation School</h3></a>
                        <span>Kolkata</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="brand-area section" >
    <div class="container">
    	<div class="section-title">
            <h2>Study Abroad</h2>
            <p>Interested in studying abroad? Choose a country</p>          
        </div>
        <div class="row">
        <div class="studyabroad">
            <div class="single-slide">
                <div class="inner">
                	<img src="new-assets/img/united-states.png" >
                    <p>USA</p>
                </div>
            </div>
            <div class="single-slide">
                <div class="inner">
                	<img src="new-assets/img/uk.png" >
                    <p>UK</p>
                </div>
            </div>
            <div class="single-slide">
                <div class="inner">
                	<img src="new-assets/img/australia.png" >
                    <p>Australia</p>
                </div>
            </div>
            <div class="single-slide">
                <div class="inner">
                	<img src="new-assets/img/canada.png" >
                    <p>Canada</p>
                </div>
            </div>                                
        </div>
    </div>
</div>
</div>


<div class="top-courses sp bgg section">
	<div class="container">
	<div class="section-title white">
        <h2 class="text-dark">Top Courses</h2>
    </div>

    <ul>
    	<li>After 12th - Science</li>
    	<li>After 12th - Arts</li>
    	<li>After 12th - Commerce</li>
    	<li>LL.B.</li>
        <li>Science</li>
        <li>Paramedical</li> 
        <li>Bachelor of Pharmacy (B.Pharma)</li> 
        <li>Masters in Vocational Courses</li>          
    	<li>MBA (Masters of Business Administration)</li>
    	<li>BBA (Bachelor of Business Administration)</li>
    	<li>MBBS</li>
    	<li>B.Sc.</li>
    	<li>B.Com</li>
    	<li>BCA (Bachelor of Computer Applications)</li>
    	<li>B.A (Bachelor of Arts)</li>
    	<li>Company Secretary</li>
    	<li>Computer Science Engineering</li>
    	<li>Chartered Accountancy</li>
    	<li>Engineering</li>
    	<li>Commerce</li>
    	<li>Fashion Designing</li>
    	<li>B.Ed</li>
    	<li>Hotel Management</li> 
    	<li>M.Sc. (Master of Science)</li> 
    </ul>
    </div>
</div>

<div class="testimonial-area sp section">
    <div class="container">
        <div class="section-title white">
            <h2 class="text-dark">Latest Updates</h2>
        </div>
        <div class="testimonial-slider latest-updates owl-theme">
            <div class="single-slide">
                <div class="inner">
                    <p>COVID-19 Lockdown: Harayana govt to conduct online tutorials for class 1 to 12 students</p>
                    <span style="font-size: 12px;">Saumya Jain</span>, <span style="font-size: 12px;">Apr 7, 2020</span>
                </div>
            </div>
            <div class="single-slide">
                <div class="inner">
                    <p>UPSEE 2020 exam postponed by AKTU due to COVID-19 epidemic; Check details here</p>
                    <span style="font-size: 12px;">Anuj Kumar</span>, <span style="font-size: 12px;">Apr 7, 2020</span>
                </div>
            </div>
            <div class="single-slide">
                <div class="inner">
                    <p>All educational institutions in Odisha to remain shut until June 17: Naveen Patnaik</p>
                    <span style="font-size: 12px;">Chhavi Sharma</span>, <span style="font-size: 12px;">Apr 6, 2020</span>
                </div>
            </div>
            <div class="single-slide">
                <div class="inner">
                    <p>COVID-19 impact: 38 private schools in Punjab get notice for demanding fee</p>
                    <span style="font-size: 12px;">Anuj Kumar</span>, <span style="font-size: 12px;">Apr 6, 2020</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top: 20px;">
         <button>View All Updates <i class="fa fa-angle-right" aria-hidden="true"></i></button>
         </div>
    </div>
</div>

<div class="foooter-above ">
	<div class="container">
		<div class="row justify-content-center flex-column">
			<h3 class="text-uppercase text-center text-white">subscribe to our news letter</h3>
			<div class="ft-newsletter-text text-center text-white text-capitalize ">
				<p class="desktop-hidden">get latest notification of schools, exams and News</p>
				<span class="tab-hidden mobile-hidden">school notification</span>
				<span class="tab-hidden mobile-hidden">exam notification</span>
				<span class="tab-hidden mobile-hidden">news update</span>
			</div>			
			<div class="row justify-content-center ft-newsletter-form">
				<input type="text" class="nw-name" placeholder="Name">
                <input type="text" class="nw-name" placeholder="Email Id">
                <input type="submit" class="nw-name nwbtn" value="Submit">
			</div>
		</div>

	</div>

</div>
<footer>
    <div class="footer-top tab-hidden mobile-hidden">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 footer_widget">
                    <div class="inner">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About </a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">advertising</a></li>
                            <li><a href="#">careers</a></li>
                            <li><a href="#">privacy</a></li>
                            <li><a href="#">terms & conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 footer_widget">
                    <div class="inner">
                        <h4>Top Courses</h4>
                        <ul>
                            <li><a href="#">Animation</a></li>
                            <li><a href="#">mca</a></li>
                            <li><a href="#">BBA</a></li>
                            <li><a href="#">BCA</a></li>
                            <li><a href="#">CA</a></li>
                            <li><a href="#">Law</a></li>
                            <li><a href="#">Hotel Manegment</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 footer_widget">
                    <div class="inner">
                        <h4>top exams</h4>
                        <ul>
                        <li><a href="#">cat</a></li>
                        <li><a href="#">jee-main</a></li>
                        <li><a href="#">neet</a></li>
                        <li><a href="#">xat</a></li>
                        <li><a href="#">clat</a></li>
                        <li><a href="#">mat</a></li>
                        <li><a href="#">NDA</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 footer_widget">
                    <div class="inner">
                        <h4>Study Abroad</h4>
                        <ul>
                        <li><a href="#">MS abroad</a></li>
                        <li><a href="#">GRE</a></li>
                        <li><a href="#">GMAT</a></li>
                        <li><a href="#">SAT</a></li>
                        <li><a href="#">MBA abroad</a></li>
                        <li><a href="#">BTech abroad</a></li>
                        <li><a href="#">Study Abroad Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright-txt">
                         Copyright © 2020 Edu-Counselor | All Rights Reserved.
                    </div>
                </div>
                <div class="col-lg-6 text-right mobile-hidden">
                    <div class="footer-nav">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
       
       
        
    </div>

    <!--Required JS files-->
{!! Html::script('new-assets/js/jquery-2.2.4.min.js') !!}
{!! Html::script('new-assets/js/popper.min.js') !!}
{!! Html::script('new-assets/js/bootstrap.min.js') !!}
{!! Html::script('new-assets/js/owl.carousel.min.js') !!}
{!! Html::script('new-assets/js/isotope.pkgd.min.js') !!}
{!! Html::script('new-assets/js/jquery.barfiller.js') !!}
{!! Html::script('new-assets/js/loopcounter.js') !!}
{!! Html::script('new-assets/js/slicknav.min.js') !!}
{!! Html::script('new-assets/js/active.js') !!}

<script type="text/javascript">
	var TxtRotate = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

TxtRotate.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  var that = this;
  var delta = 300 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
};

window.onload = function() {
  var elements = document.getElementsByClassName('txt-rotate');
  for (var i=0; i<elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-rotate');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  }
  // INJECT CSS
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
  document.body.appendChild(css);
};

</script>
<script>
        window.onscroll = function() {myFunction()};
            var header = document.getElementById("fixedHeader");
            var sticky = header.offsetTop;
            function myFunction() {
                if (window.pageYOffset > sticky) {
                    header.classList.add("stickyHeader");
                } else {
                    header.classList.remove("stickyHeader");
                }
            }
    </script>

<script type="text/javascript">
$(document).on('mouseenter', '[data-toggle="tab"]', function () {
  $(this).tab('show');
});
</script>
<script type="text/javascript">
$('.dropdownhover').on('click', function(){
    $('.dropdownmenu').toggleClass('active');
});

</script>
</body>


<!-- Mirrored from techjcs.com/education/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 May 2020 01:41:12 GMT -->
</html>