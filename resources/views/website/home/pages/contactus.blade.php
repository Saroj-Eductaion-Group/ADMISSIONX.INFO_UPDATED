@extends('website/new-design-layouts.master')

@section('styles')
	<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	/* 
 * 	Core Owl Carousel CSS File
 *	v1.24
 */

 /*Contact Pages
------------------------------------*/
.map {
	width:100%; 
	height:350px;
	border-top:solid 1px #eee;
	border-bottom:solid 1px #eee;
}

/* important! bootstrap sets max-width on img to 100% which conflicts with google map canvas*/
.map img {
	max-width: none;
}

.map-box {
	height: 250px;
}

.map-box-space {
	margin-top: 15px;
}
.map-box-space1 {
	margin-top: 7px;
}


/* clearfix */
.owl-carousel .owl-wrapper:after {
	content: ".";
	display: block;
	clear: both;
	visibility: hidden;
	line-height: 0;
	height: 0;
}
/* display none until init */
.owl-carousel{
	display: none;
	position: relative;
	width: 100%;
	-ms-touch-action: pan-y;
}
.owl-carousel .owl-wrapper{
	display: none;
	position: relative;
	-webkit-transform: translate3d(0px, 0px, 0px);
}
.owl-carousel .owl-wrapper-outer{
	overflow: hidden;
	position: relative;
	width: 100%;
}
.owl-carousel .owl-wrapper-outer.autoHeight{
	-webkit-transition: height 500ms ease-in-out;
	-moz-transition: height 500ms ease-in-out;
	-ms-transition: height 500ms ease-in-out;
	-o-transition: height 500ms ease-in-out;
	transition: height 500ms ease-in-out;
}
	
.owl-carousel .owl-item{
	float: left;
}
.owl-controls .owl-page,
.owl-controls .owl-buttons div{
	cursor: pointer;
}
.owl-controls {
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

/* mouse grab icon */
.grabbing { 
    cursor:url(grabbing.png) 8 8, move;
}

/* fix */
.owl-carousel  .owl-wrapper,
.owl-carousel  .owl-item{
	-webkit-backface-visibility: hidden;
	-moz-backface-visibility:    hidden;
	-ms-backface-visibility:     hidden;
  -webkit-transform: translate3d(0,0,0);
  -moz-transform: translate3d(0,0,0);
  -ms-transform: translate3d(0,0,0);
}

/* CSS3 Transitions */

.owl-origin {
	-webkit-perspective: 1200px;
	-webkit-perspective-origin-x : 50%;
	-webkit-perspective-origin-y : 50%;
	-moz-perspective : 1200px;
	-moz-perspective-origin-x : 50%;
	-moz-perspective-origin-y : 50%;
	perspective : 1200px;
}
/* fade */
.owl-fade-out {
  z-index: 10;
  -webkit-animation: fadeOut .7s both ease;
  -moz-animation: fadeOut .7s both ease;
  animation: fadeOut .7s both ease;
}
.owl-fade-in {
  -webkit-animation: fadeIn .7s both ease;
  -moz-animation: fadeIn .7s both ease;
  animation: fadeIn .7s both ease;
}
/* backSlide */
.owl-backSlide-out {
  -webkit-animation: backSlideOut 1s both ease;
  -moz-animation: backSlideOut 1s both ease;
  animation: backSlideOut 1s both ease;
}
.owl-backSlide-in {
  -webkit-animation: backSlideIn 1s both ease;
  -moz-animation: backSlideIn 1s both ease;
  animation: backSlideIn 1s both ease;
}
/* goDown */
.owl-goDown-out {
  -webkit-animation: scaleToFade .7s ease both;
  -moz-animation: scaleToFade .7s ease both;
  animation: scaleToFade .7s ease both;
}
.owl-goDown-in {
  -webkit-animation: goDown .6s ease both;
  -moz-animation: goDown .6s ease both;
  animation: goDown .6s ease both;
}
/* scaleUp */
.owl-fadeUp-in {
  -webkit-animation: scaleUpFrom .5s ease both;
  -moz-animation: scaleUpFrom .5s ease both;
  animation: scaleUpFrom .5s ease both;
}

.owl-fadeUp-out {
  -webkit-animation: scaleUpTo .5s ease both;
  -moz-animation: scaleUpTo .5s ease both;
  animation: scaleUpTo .5s ease both;
}
/* Keyframes */
/*empty*/
@-webkit-keyframes empty {
  0% {opacity: 1}
}
@-moz-keyframes empty {
  0% {opacity: 1}
}
@keyframes empty {
  0% {opacity: 1}
}
@-webkit-keyframes fadeIn {
  0% { opacity:0; }
  100% { opacity:1; }
}
@-moz-keyframes fadeIn {
  0% { opacity:0; }
  100% { opacity:1; }
}
@keyframes fadeIn {
  0% { opacity:0; }
  100% { opacity:1; }
}
@-webkit-keyframes fadeOut {
  0% { opacity:1; }
  100% { opacity:0; }
}
@-moz-keyframes fadeOut {
  0% { opacity:1; }
  100% { opacity:0; }
}
@keyframes fadeOut {
  0% { opacity:1; }
  100% { opacity:0; }
}
@-webkit-keyframes backSlideOut {
  25% { opacity: .5; -webkit-transform: translateZ(-500px); }
  75% { opacity: .5; -webkit-transform: translateZ(-500px) translateX(-200%); }
  100% { opacity: .5; -webkit-transform: translateZ(-500px) translateX(-200%); }
}
@-moz-keyframes backSlideOut {
  25% { opacity: .5; -moz-transform: translateZ(-500px); }
  75% { opacity: .5; -moz-transform: translateZ(-500px) translateX(-200%); }
  100% { opacity: .5; -moz-transform: translateZ(-500px) translateX(-200%); }
}
@keyframes backSlideOut {
  25% { opacity: .5; transform: translateZ(-500px); }
  75% { opacity: .5; transform: translateZ(-500px) translateX(-200%); }
  100% { opacity: .5; transform: translateZ(-500px) translateX(-200%); }
}
@-webkit-keyframes backSlideIn {
  0%, 25% { opacity: .5; -webkit-transform: translateZ(-500px) translateX(200%); }
  75% { opacity: .5; -webkit-transform: translateZ(-500px); }
  100% { opacity: 1; -webkit-transform: translateZ(0) translateX(0); }
}
@-moz-keyframes backSlideIn {
  0%, 25% { opacity: .5; -moz-transform: translateZ(-500px) translateX(200%); }
  75% { opacity: .5; -moz-transform: translateZ(-500px); }
  100% { opacity: 1; -moz-transform: translateZ(0) translateX(0); }
}
@keyframes backSlideIn {
  0%, 25% { opacity: .5; transform: translateZ(-500px) translateX(200%); }
  75% { opacity: .5; transform: translateZ(-500px); }
  100% { opacity: 1; transform: translateZ(0) translateX(0); }
}
@-webkit-keyframes scaleToFade {
  to { opacity: 0; -webkit-transform: scale(.8); }
}
@-moz-keyframes scaleToFade {
  to { opacity: 0; -moz-transform: scale(.8); }
}
@keyframes scaleToFade {
  to { opacity: 0; transform: scale(.8); }
}
@-webkit-keyframes goDown {
  from { -webkit-transform: translateY(-100%); }
}
@-moz-keyframes goDown {
  from { -moz-transform: translateY(-100%); }
}
@keyframes goDown {
  from { transform: translateY(-100%); }
}

@-webkit-keyframes scaleUpFrom {
  from { opacity: 0; -webkit-transform: scale(1.5); }
}
@-moz-keyframes scaleUpFrom {
  from { opacity: 0; -moz-transform: scale(1.5); }
}
@keyframes scaleUpFrom {
  from { opacity: 0; transform: scale(1.5); }
}

@-webkit-keyframes scaleUpTo {
  to { opacity: 0; -webkit-transform: scale(1.5); }
}
@-moz-keyframes scaleUpTo {
  to { opacity: 0; -moz-transform: scale(1.5); }
}
@keyframes scaleUpTo {
  to { opacity: 0; transform: scale(1.5); }
}


.contact-main{
    background: url(/assets/images/homepage/contact-bg1.png); background-size:cover; 
}

.action_card {
    background:#fff !important; border-radius:5px; padding:30px 30px;
}

</style>
@endsection
@section('content')

<!-- <div class="container  content-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12 md-margin-bottom-50">
			</div>
		</div>
	</div>
</div> -->

<div class="contact-main">
	<div class="container content">
		<div class="row margin-bottom-30">
			<div class="col-md-8 mb-margin-bottom-30">
				<div style="border-bottom:unset;" class="headline">
					<h2 style="border-bottom: 2px solid #d40d12;">Contact Form</h2></div>
				<br>
				<div style="background:#fff !important; border-radius:5px; padding:40px 55px;">
					@foreach($getPageContentDataObj as $item)
						<div class="overflow-h">
							<h3>{{ $item->title }}</h3>
							{!! $item->description !!}
						</div>
					@endforeach

					<div class="row">
						<div class="col-md-12 ">
							@if(Session::has('confirmContactUs'))
								<div class="alert alert-success alert-dismissable text-center">
			                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                        {{ Session::get('confirmContactUs') }}                        
			                    </div>
			            	@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 ">
							@if(Session::has('errormessage'))
								<div class="alert alert-danger alert-dismissable text-center">
			                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                        {{ Session::get('errormessage') }}                        
			                    </div>
			            	@endif
						</div>
					</div>
					<form action="/contact-us-detail-query" method="post" class="contact-style" novalidate="novalidate" data-parsley-validate ="", enctype = "multipart/form-data">
						<div class="">
							<div class="row margin-bottom-20">
								@if(Auth::check())									
									
								@else
									<div class="col-md-4">
										<label>Name <span class="color-red">*</span></label>
										<input type="text" name="guestname" id="guestname" class="form-control" placeholder="Enter name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your name" data-parsley-pattern="^[a-zA-Z\/s .-]*$" required="">
									</div>
									<div class="col-md-4">
										<label>Email Address <span class="color-red">*</span></label>
										<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="guestemail" id="guestemail" class="form-control" placeholder="Enter email here" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
									</div>
									<div class="col-md-4">
										<label>Phone Number<span class="color-red">*</span></label>
										<input type="text" name="guestphone" id="guestphone" class="form-control" placeholder="Enter phone number here" data-parsley-type ="digits" data-parsley-error-message = "Please enter valid mobile number"  data-parsley-trigger="change" required="" minlength="10" maxlength="10" data-parsley-pattern="^[7-9][0-9]{9}$"><!-- data-parsley-length="[7, 11]" data-parsley-pattern="^[7-9][0-9]{9}$" maxlength="10" -->
									</div>
								@endif						
							</div>
							
							<div class="row margin-bottom-20">
								<div class="col-md-12">
									<label>Subject</label>
									<input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject here" data-parsley-trigger="change">
								</div>
							</div>
							<div class="row margin-bottom-20">
								<div class="col-md-12">
									<label>Message <span class="color-red">*</span></label>
									<textarea rows="8" name="message" id="message" class="form-control" placeholder="Enter message here" data-parsley-trigger="change"  data-parsley-error-message="Please enter message" required=""></textarea>
								</div>
							</div>
							<div class="row margin-bottom-20">
								<div class="col-md-12">
									<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
									{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<button type="submit" class="btn-u btn-block rounded"><i class="fa fa-spinner fa-pulse hide" id="loader"></i>Send Message</button>
							</div>
						</div>
						
					</form>
				</div>
			</div><!--/col-md-9-->

			<div class="col-md-4">
				<!-- Contacts -->
				<div class="headline" style="border-bottom:unset;">
					<h2 style="border-bottom: 2px solid #d40d12; margin-bottom:25px;">FIND US</h2>
				</div>
                <div class="action_card">
                    <p class="main-head">AdmissionX (Yuvi Aviation Pvt. Ltd.)</p>
                    <p><i class="fa fa-home">&nbsp;&nbsp;</i>AdmissionX, 2nd Floor, L 5, Lajpat Nagar, New Delhi, 110024 India.
                    </p>
                   <!--  <p><i class="fa fa-home">&nbsp;&nbsp;</i>AdmissionX, 62, SVP Nagar, Four Bungalows, Versova, Mumbai,  400053 India.
                    </p> -->
                    <p>
                        <i class="fa fa-envelope">&nbsp;&nbsp;</i>
                        <a href="mailto:support@admissionx.info" class="mail_color">support@admissionx.info</a>
                    </p>
                    <p><i class="fa fa-phone" tel="011-4224-9249">&nbsp;&nbsp;</i>(+011) 413 444 44</p>
                    <p>
                        <i class="fa fa-globe">&nbsp;&nbsp;</i>
                        <a href="https://www.admissionx.com/" target="_blank" class="link_color">www.admissionx.com</a>
                    </p>
                    <p><i class="fa fa-clock-o">&nbsp;&nbsp;</i><strong>Monday-Saturday:</strong> 10 AM to 5 PM</p>
                    <p><i class="fa fa-calendar">&nbsp;&nbsp;</i><strong>Sunday:</strong> Closed</p>
                </div>
				 <!-- <hr class="btm-border"> -->
				<div class="hide" style="background:#fff !important; border-radius:5px; padding:40px 55px;">
					<ul class="list-unstyled who margin-bottom-30">
						<li><a href="#"><i class="fa fa-home"></i>AdmissionX, 2nd Floor, L 5, Lajpat Nagar, </a></li>
						<li class="padding-left25"> New Delhi - 110024</li>
						<li><a href="#"><i class="fa fa-home"></i>62, SVP Nagar, Four Bungalows, </a></li>
						<li class="padding-left25">Versova, Mumbai - 400053</li>
						<li><a href="mailto:support@admissionx.info"><i class="fa fa-envelope"></i>support@admissionx.info</a></li>
						<li><a href="#"><i class="fa fa-phone"></i>011-4224-9249 </a></li>
						<!-- <li><a href="#"><i class="fa fa-globe"></i>http://www.example.com</a></li> -->
					</ul>

					<!-- Business Hours -->
					<div class="headline" style="border-bottom:unset;">
						<h2>Business Hours</h2>
					</div>
					<ul class="list-unstyled margin-bottom-30">
						<li><strong>Monday-Saturday:</strong> 10 AM to 5 PM</li>
						<li><strong>Sunday:</strong> Closed</li>
					</ul>
				</div>
				<div class="latest-tweets">
					<div class="headline" style="border-bottom:unset;">
						<h2 class="heading-sm">Latest Tweets</h2>
					</div>
					<!-- <a class="twitter-timeline" data-lang="en" data-height="224" data-theme="light" href="https://twitter.com/BYA_HQ">Tweets by BYA_HQ</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>	 -->
					<a class="twitter-timeline" data-lang="en" data-height="300" data-theme="light" href="https://twitter.com/adxdotcom">Tweets by AdmissionX</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>

			</div><!--/col-md-3-->
		</div><!--/row-->
		<div class="row">

					<div class="col-md-6 col-sm-6">
						<div style="background:#fff !important; border-radius:5px;
						 padding:25px 25px;">
						<!-- Google Map -->
						<!-- 16:9 aspect ratio -->
						<div  class="embed-responsive embed-responsive-16by9">
							<!-- <div id="gmap_canvas" class="embed-responsive-item" style="width:100%;"></div> -->
							<!-- Google Map -->
							{{-- <div id="map" class="map embed-responsive-item" style="width:100%;"></div> --}}
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14016.225727923327!2d77.2465785!3d28.5680681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3b1f9e020ad%3A0x18cc0ea2cb1636b7!2sAdmissionX!5e0!3m2!1sen!2sin!4v1701671854368!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
							<!---/map-->
							<!-- End Google Map -->
						</div>
						<!-- End Google Map -->
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div style="background:#fff !important; border-radius:5px;
						 padding:25px 25px;">
							<!-- Google Map -->
							<!-- 16:9 aspect ratio -->
							<div class="embed-responsive embed-responsive-16by9">
								<!-- <div id="gmap_canvas" class="embed-responsive-item" style="width:100%;"></div> -->
								<!-- Google Map -->
								{{-- <div id="map1" class="map embed-responsive-item" style="width:100%;"></div> --}}
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.3225320371225!2d72.8192200740449!3d19.137354050045836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b610aa5a3a57%3A0x919c7b03302cb29c!2sSaroj%20Entertainment%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1701675636120!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								<!---/map-->
								<!-- End Google Map -->
							</div>
							<!-- End Google Map -->
						</div>
					</div>
				</div>
	</div>
</div>
			
@endsection



@section('scripts')
	<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKlTjj72lhQm1xqvMI5LPRP4uyBKfP3BY"></script>

	{!! Html::script('home-layout/assets/js/gmap.js') !!}
	{!! Html::script('home-layout/assets/js/page_contacts.js') !!}
	{!! Html::script('home-layout/assets/js/page_contactus1.js') !!}
	<script type="text/javascript">
	jQuery(document).ready(function() {
		ContactPage.initMap();
	});
	</script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		ContactPage1.initMap();
	});
	</script>
	<script type="text/javascript">
	    window.onload = function() {
		    var $recaptcha = document.querySelector('#g-recaptcha-response');

		    if($recaptcha) {
		        $recaptcha.setAttribute("required", "required");
		    }
	  	};
	</script>

@endsection