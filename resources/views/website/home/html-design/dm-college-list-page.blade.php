@extends('website/new-design-layouts.master')

@section('content')

       
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
   
    {!! Html::style('/new-assets/css/main.css') !!}


<div class="preloader">
        <span class="preloader-spin"></span>
</div>


<div class="single-listing-school-template single">
    <div class="page-header">
        <div class="container">
            <div class="col-md-12">
                <div class="row justify-content-between">       
                    <div><span><a class="text-dark" href="{{ URL::to('top-college-page') }}">Home </a> > Schools > Ecole Globale</span></div>
                </div>
            </div>
        </div>
    </div>        
    <div class="featured-school-single">
        <div class="container">
            <div class="header-section"></div>
            <div class="header-bg-section">
                <img src="new-assets/img/schools-in-dehradun-ecole.jpg">
            </div>
            <div class="header-wrapper d-flex">
                <div class="listing-logo">
                    <img src="new-assets/img/ecole-logo.jpg">
                </div>
                <div class="listing-content">
                    <a href="#">
                        <h3>Ecole Globale International Girls' School</h3>
                    </a>
                    <div class="review-star">
                        4.9
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        (98)
                    </div>
                    <div class="school-social-link">
                        <a href="https://www.facebook.com/ecoleglobaleinternationalgirlsschool/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="https://twitter.com/ecoleglobale" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="https://www.linkedin.com/in/ecole-globale/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/ecole_girls_school/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://www.youtube.com/channel/UCAOXi0p46gOFwEDL1XCO8xA" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        <a href="https://www.ecoleglobale.com/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                </div>
            </div>
            <div class="school-info section">
                <div class="section-title">
                    <h3>School Info</h3>
                </div>
                <div class="section-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <a href="#">Know More</a>
                </div>
            </div>
            <div class="school-info section">
                <div class="section-title">
                    <h3>Key Information</h3>
                </div>
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                                <table class="featured-table table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>School Type</td>
                                            <td>Boarding School</td>
                                        </tr>
                                        <tr>
                                            <td>Afflilation</td>
                                            <td>CBSE</td>
                                        </tr>
                                        <tr>
                                            <td>Establishment Year</td>
                                            <td>2012</td>
                                        </tr>
                                        <tr>
                                            <td>Medium of Instruction</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>Chairman Name</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Principal Name</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Grade From</td>
                                            <td>Class 4</td>
                                        </tr>
                                        <tr>
                                            <td>Grade To :</td>
                                            <td>Class 12</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="col-md-6">
                            <table class="featured-table table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Admission Start</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Admission End</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Sector</td>
                                        <td>Private</td>
                                    </tr>
                                    <tr>
                                        <td>CCTV Surveillance</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Student Teacher Ratio</td>
                                        <td>1:9</td>
                                    </tr>
                                    <tr>
                                        <td>AC Campus</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>No of Teachers</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Website: </td>
                                        <td><a href="#">Go to Website</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="school-location section">
                <div class="section-title">
                    <h3>Location</h3>
                </div>
                <div class="section-content">
                    <table class="featured-table table table-striped">
                        <tbody>
                            <tr>
                                <td>State</td>
                                <td>Uttarakhand</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>Dehradun</td>
                            </tr>
                            <tr>
                                <td>Locality</td>
                                <td>Village Horawalla, Near Sahaspur</td>
                            </tr>
                            <tr>
                                <td>Pin Code</td>
                                <td>248197</td>
                            </tr>                        
                            <tr>
                                <td>Google Map</td>
                                <td><a href="https://goo.gl/maps/9dD9NLM4wPrrnNFA8" target="_blank">Go to Location</a></td>
                            </tr>                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="school-activity-sports section">
                <div class="section-title">
                    <h3>Sports & Activity</h3>
                </div>
                <div class="section-content">
                    <p>Outdoor Sports</p>
                    <ul>
                        <li>Badminton</li>
                        <li>Squash</li>
                        <li>Basketball</li>        
                        <li>Lawn</li>
                        <li>Tennis</li>
                        <li>Cricket</li>
                        <li>Football</li>
                        <li>Shooting</li>
                        <li>Hockey</li>
                        <li>Horse riding</li>
                        <li>Swimming</li>
                    </ul>

                    <p class="padding-top20">Indoor Sports</p>
                    <ul>
                        <li>Carrom Board</li>
                        <li>Table Tennis</li>
                        <li>Billiard</li>        
                        <li>Chess</li>
                    </ul>

                    <p class="padding-top20">Co-curricular Activity</p>
                    <ul>
                        <li>Dance</li>    
                        <li>Music</li>
                        <li>Debate</li>              
                        <li>Foreign Language</li>
                        <li>Photography</li>
                        <li>Drama Club</li>
                        <li>Drawing</li>    
                        <li>Painting</li>
                    </ul>
                </div>
            </div>
            <div class="school-fees section">
                <div class="section-title">
                    <h3>Fee Details</h3>
                </div>
                <div class="section-content">
                    <div class="section-content">
                        <table class="featured-table table table-striped">
                            <p>Fee Structure - Indian Nationals </p>
                            <tbody>
                                <tr>
                                    <td>Admission Application Fee</td>
                                    <td>₹20,000 </td>
                                </tr>
                                <tr>
                                    <td>Other One Time Payment</td>
                                    <td>₹100,000</td>
                                </tr>
                                <tr>
                                    <td>Security Deposit</td>
                                    <td>₹100,000</td>
                                </tr>
                                <tr>
                                    <td>Yearly Fees</td>
                                    <td>₹648,000 </td>
                                </tr>                                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="school-contact section">
                <div class="section-title">
                    <h3>Contact Details</h3>
                </div>
                <div class="section-content">
                    <div class="section-content">
                        <table class="featured-table table table-striped">                    
                            <tbody>
                                <tr>
                                    <td>Email</td>
                                    <td>ecoleglobale@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>Phone No</td>
                                    <td>+91-9557291888</td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td><a href="#">Go to Website</a></td>
                                </tr>                  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="school-gallery section">
                <div class="section-title">
                    <h3>School Gallery</h3>
                </div>
                <div class="section-content">
                    <div class="school-carousel owl-theme">
                        <div class="single-slide">
                            <div class="inner">
                               <img src="new-assets/img/carousel-1.jpg">
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="inner">
                                <img src="new-assets/img/carousel-2.jpg">
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="inner">
                                <img src="new-assets/img/carousel-3.jpg">
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="inner">
                                <img src="new-assets/img/carousel-4.jpg">
                            </div>
                        </div>
                    </div>
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

