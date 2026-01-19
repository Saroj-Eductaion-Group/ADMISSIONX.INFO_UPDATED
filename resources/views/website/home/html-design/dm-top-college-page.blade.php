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
                    <h1>List of Top Schools In India</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="featured-school">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar-filters">
                   <div class="sidebar-heading"><h2>Filters</h2></div>
                       <div class="school-type fillter-type single-item">
                           <div class="ft-title">School Type</div>
                           <div class="ft-content content">
                               <span><input type="checkbox" class="ft-checkbox"> Co-Ed schools</span>
                               <span><input type="checkbox" class="ft-checkbox"> Boys schools</span>
                               <span><input type="checkbox" class="ft-checkbox"> Girls schools</span>
                            </div>
                       </div>
                   <div class="affiliation-type fillter-type sy single-item">
                        <div class="ft-title">Affiliation</div>
                        <div class="ft-content content">
                            <span><input type="checkbox" class="ft-checkbox"> CBSE</span>
                            <span><input type="checkbox" class="ft-checkbox"> CBSE/ICSE</span>
                            <span><input type="checkbox" class="ft-checkbox"> ICSE</span>
                            <span><input type="checkbox" class="ft-checkbox"> ICSE/ISC</span>
                            <span><input type="checkbox" class="ft-checkbox"> Pre School</span>
                            <span><input type="checkbox" class="ft-checkbox"> Pre Board</span>
                         </div>
                    </div>
                    <div class="category-type fillter-type sy single-item">
                        <div class="ft-title">Category</div>
                        <div class="ft-content content">
                            <span><input type="checkbox" class="ft-checkbox"> Pre-Primary</span>
                            <span><input type="checkbox" class="ft-checkbox"> Primary</span>
                            <span><input type="checkbox" class="ft-checkbox"> Middle</span>
                            <span><input type="checkbox" class="ft-checkbox"> Secondary</span>
                            <span><input type="checkbox" class="ft-checkbox"> Hr. Sec.</span>
                         </div>
                    </div>
                    <div class="stream-type fillter-type single-item">
                        <div class="ft-title">Stream</div>
                        <div class="ft-content content">
                            <span><input type="checkbox" class="ft-checkbox"> Science</span>
                            <span><input type="checkbox" class="ft-checkbox"> Arts</span>
                            <span><input type="checkbox" class="ft-checkbox"> Commerce</span>
                         </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="slisting-search">
                        <input type="text" placeholder="Serch a school" class="serchinput">   
                    </div>
                    <div class="single-listing-box col-md-12">
                        <div class="inner d-flex">
                            <div class="listing-img">
                                <img src="/new-assets/img/ecole-globale.jpg" alt="portfolio-image">
                            </div>
                            <div class="listing-content">
                                <a href="{{ URL::to('college-list-page') }}"><h3>Ecole Globale International Girls' School</h3></a>
                                <div class="review-star">
                                    4.9 
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    (98)
                                </div>
                                <span><strong>Location: </strong>Dehradun</span>
                                <div class="boottom-link"> 
                                    <span>Addmission</span>
                                    <span>Coureses & Fees</span>
                                    <span>Placements</span>
                                </div>
                                <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="single-listing-box col-md-12">
                        <div class="inner d-flex">
                            <div class="listing-img">
                                <img src="/new-assets/img/the-sanskaar-valley.jpg" alt="portfolio-image">
                            </div>
                            <div class="listing-content">
                                <a href="#"><h3>The Sanskaar Valley School</h3></a>
                                <div class="review-star">
                                    4.9 
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    (98)
                                </div>
                                <span><strong>Location: </strong>Bhopal</span>
                                <div class="boottom-link"> 
                                    <span>Addmission</span>
                                    <span>Coureses & Fees</span>
                                    <span>Placements</span>
                                </div>
                                <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-listing-box col-md-12">
                        <div class="inner d-flex">
                            <div class="listing-img">
                                <img src="/new-assets/img/Maharaja-Sawai-Bhawani-Singh-School.jpg" alt="portfolio-image">
                            </div>
                            <div class="listing-content">
                                <a href="#"><h3>Maharaja Sawai Bhawani Singh School</h3></a>
                                <div class="review-star">
                                    4.9 
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    (98)
                                </div>
                                <span><strong>Location: </strong>Jaipur</span>
                                <div class="boottom-link"> 
                                    <span>Addmission</span>
                                    <span>Coureses & Fees</span>
                                    <span>Placements</span>
                                </div>
                                <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-listing-box col-md-12">
                        <div class="inner d-flex">
                            <div class="listing-img">
                                <img src="/new-assets/img/Little-Angels-School.jpg" alt="portfolio-image">
                            </div>
                            <div class="listing-content">
                                <a href="#"><h3>Little Angels High School</h3></a>
                                <div class="review-star">
                                    4.9 
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    (98)
                                </div>
                                <span><strong>Location: </strong>Gwalior</span>
                                <div class="boottom-link"> 
                                    <span>Addmission</span>
                                    <span>Coureses & Fees</span>
                                    <span>Placements</span>
                                </div>
                                <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-listing-box col-md-12">
                        <div class="inner d-flex">
                            <div class="listing-img">
                                <img src="/new-assets/img/hyderabad-public-school.jpg" alt="portfolio-image">
                            </div>                        
                            <div class="listing-content">
                                <a href="#"><h3>Hyderabad Public School</h3></a>
                                <div class="review-star">
                                    4.9 
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    (98)
                                </div>
                                <span><strong>Location: </strong>Hyderabad</span>
                                <div class="boottom-link"> 
                                    <span>Addmission</span>
                                    <span>Coureses & Fees</span>
                                    <span>Placements</span>
                                </div>
                                <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-listing-box col-md-12">
                        <div class="inner d-flex">
                            <div class="listing-img">
                                <img src="/new-assets/img/asian-school.jpg" alt="portfolio-image">
                            </div>
                            <div class="listing-content">
                                <a href="#"><h3>The Asian School</h3></a>
                                <div class="review-star">
                                    4.9 
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    (98)
                                </div>
                                <span><strong>Location: </strong>Dehradun</span>
                                <div class="boottom-link"> 
                                    <span>Addmission</span>
                                    <span>Coureses & Fees</span>
                                    <span>Placements</span>
                                </div>
                                <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-listing-box col-md-12">
                        <div class="inner d-flex">
                            <div class="listing-img">
                                <img src="/new-assets/img/St-John-s-High-School.jpg" alt="portfolio-image">                        
                            </div>
                            <div class="listing-content">
                                <a href="#"><h3>St. John’s High School</h3></a>
                                <div class="review-star">
                                    4.9 
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    (98)
                                </div>
                                <span><strong>Location: </strong>Chandigarh</span>
                                <div class="boottom-link"> 
                                    <span>Addmission</span>
                                    <span>Coureses & Fees</span>
                                    <span>Placements</span>
                                </div>
                                <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-listing-box col-md-12">
                        <div class="inner d-flex">
                            <div class="listing-img">
                                <img src="/new-assets/img/delhi-public-school.jpg" alt="portfolio-image">                            
                            </div>
                            <div class="listing-content">
                                <a href="#"><h3>The Future Foundation School</h3></a>
                                <div class="review-star">
                                    4.9 
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    (98)
                                </div>
                                <span><strong>Location: </strong>Bhopal</span>
                                <div class="boottom-link"> 
                                    <span>Addmission</span>
                                    <span>Coureses & Fees</span>
                                    <span>Placements</span>
                                </div>
                                <div class="applynow"><button class="btn-ApplyNow">Apply Now</button> </div>
                            </div>
                        </div>
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

