@extends('website/new-design-layouts.master')

@section('content')

       
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
   
    {!! Html::style('/new-assets/css/main.css') !!}


<div class="preloader">
        <span class="preloader-spin"></span>
</div>

<div class="hero-slider">
    <div class="single-slide" style="background-image: url(new-assets/img/slider.jpg)">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-11 col-md-offset-1 text-center">
                        <div class="slide-content">
                            <h2 class="tab-hidden mobile-hidden">FIND OVER  
                                <a style="color:#fff;" href="" class="typewrite" data-period="2000" data-type='[ "150 Exams", "24000 Colleges.", "24000 Colleges" ]'>
                                <span class="wrap"></span>IN INDIA
                                </a>
                            </h2>
                            <div class="header-search-container">
                                <input type="text" name="search" placeholder="SEARCH" id="header-search">
                                <button class="searchbtn"><i class="fa fa-search"></i></button>
                            </div>
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

<!-- Explore Almost Everything Start -->
<div class="main-explore-section section sp bg-white">
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
<!-- End Explore Almost Everything -->

<!-- Top College of India Start -->
<div class="portfolio-area sp section featured-school bg-white">
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
<!-- End Top College of India -->

<!-- Study Abroad Start -->
<div class="brand-area section bg-white" >
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
<!-- End Study Abroad -->

<!-- Top Courses Start -->
<div class="top-courses sp bgg section ">
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
<!-- End Top Courses -->

<!-- Latest Updates Start -->
<div class="testimonial-area sp section bg-white">
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
        <div class="row" style="margin-top: 20px;">
            <div class="viewDetail">
                <a>
                    View All Updates 
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Latest Updates -->

<!-- Subscribe to Our News Letter Start -->
<div class="foooter-above ">
    <div class="container">
        <div class="row">
            <h3 class="text-uppercase text-center text-white">subscribe to our news letter</h3>
            <div class="ft-newsletter-text text-center text-white text-capitalize ">
                <p class="desktop-hidden">get latest notification of schools, exams and News</p>
                <span class="tab-hidden mobile-hidden">school notification</span>
                <span class="tab-hidden mobile-hidden">exam notification</span>
                <span class="tab-hidden mobile-hidden">news update</span>
            </div>          
            <div class="row">
                <div class="padding-top40 col-md-offset-3">
                    <input type="text" class="nw-name" placeholder="Name">
                    <input type="text" class="nw-name" placeholder="Email Id">
                    <input type="submit" class="nw-name nwbtn" value="Submit">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Subscribe to Our News Letter -->



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


{!! Html::script('new-assets/js/jquery-2.2.4.min.js') !!}
{!! Html::script('new-assets/js/owl.carousel.min.js') !!}
{!! Html::script('new-assets/js/slicknav.min.js') !!}
{!! Html::script('new-assets/js/active.js') !!}

<script type="text/javascript">
    //made by vipul mirajkar thevipulm.appspot.com
var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

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
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>

@endsection

@section('scripts')
    
@endsection

