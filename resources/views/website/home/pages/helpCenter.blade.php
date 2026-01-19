@extends('website/new-design-layouts.master')

@section('styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	.footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
</style>
<style type="text/css">
	/*FAQ-page
------------------------------------*/
.faq-breadcrumb {
	text-align: center;
	position: relative;
	background: url(assets/img/bg/19.jpg) no-repeat center;
}

.faq-breadcrumb:before {
	left: 0;
	width: 100%;
	height: 100%;
	content: " ";
	position: absolute;
	background: rgba(0,0,0,0.3);
}

.faq-page .tab-v1 {
	margin-top: 19px;
}

/*.faq-page .tab-v1  .panel-title {
	text-transform: uppercase;
}*/

/*Check-style*/
.faq-page .check-style {
	margin-bottom: 0;
}

.faq-page .check-style li {
	margin-bottom: 10px;
}
.faq-page .check-style li:last-child {
	margin-bottom: 0;
}

.faq-page .check-style i {
	font-size: 18px;
	font-weight: 600;
	vertical-align: middle;
}

/*Check-style in Responsive*/
@media (max-width: 450px) {
	.faq-page .main-check .col-xs-6 {
		width: 100%;
	}
}

/*Faq-add*/
.faq-page .faq-add {
	padding: 15px;
	margin-bottom: 20px;
	border: 2px solid #eee;
}

.faq-page .top-part i {
	float: left;
	color: #777;
	font-size: 20px;
	padding-top: 3px;
	margin-right: 10px;
}

.faq-page .new-title {
	color: #72c02c;
	font-size: 18px;
	margin-bottom: 5px;
}

.faq-page .faq-add p {
	line-height: 1.5;
}

/*ParallaxBg6
------------------------------------*/
/*Title-Box*/
.faq-bg .title-box-v2 h2,
.faq-bg .title-box-v2 p {
	color: #fff;
}

/*Contact Pages
------------------------------------*/
.map {
	width: 100%;
	height: 350px;
	border-top: solid 1px #eee;
	border-bottom: solid 1px #eee;
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
		
		@if(Session::has('confirmHelpCenter'))
		<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			<strong>{{ Session::get('confirmHelpCenter') }}</strong>
		</div>
		@endif
		<div class="breadcrumbs-v2 faq-breadcrumb margin-bottom-20">
			<div class="breadcrumbs-v2-in">
				<h1>Frequently Asked Questions</h1>
				<!-- <ul class="breadcrumb-v2 list-inline">
					<li><a href="#"><i class="rounded-x fa fa-angle-right"></i>Home</a></li>
					<li><a href="#"><i class="rounded-x fa fa-angle-right"></i>Page</a></li>
					<li class="active"><i class="rounded-x fa fa-angle-right"></i>F.A.Q</li>
				</ul> -->
			</div>
		</div>

		<div class="container content faq-page">
			<!-- FAQ Blocks -->
			<div class="row equal-height-columns margin-bottom-40">
				<div class="col-sm-4">
					<div class="easy-block-v3 service-or equal-height-column" style="height: 160px;">
						<div class="service-bg"></div>
						<i class="icon-badge"></i>
						<div class="inner-faq-b">
							<h3>Vision</h3>
							<p>We want to maximize student enrollment to educational institutions by identifying..<span class="color-green"><a href="{{ URL::to('about') }}" target="_blank">More</a></span></p>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="easy-block-v3 service-or equal-height-column" style="height: 160px;">
						<div class="service-bg"></div>
						<i class="icon-directions"></i>
						<div class="inner-faq-b">
							<h3>Mission</h3>
							<p>We want every school leaving student to have access to higher education..<span class="color-green"><a href="{{ URL::to('about') }}" target="_blank">More</a></span></p>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="easy-block-v3 service-or equal-height-column" style="height: 160px;">
						<div class="service-bg"></div>
						<i class="icon-layers"></i>
						<div class="inner-faq-b">
							<h3>What we do</h3>
							<p>Making Higher Education Accessible, just a click away!</p>
						</div>
					</div>
				</div>
			</div>
			<!-- End FAQ Blocks -->

			<!-- FAQ Content -->
			<div class="row">
				<!-- Begin Tab v1 -->
				<div class="col-md-12">
					<div class="tab-v1">
						<ul class="nav nav-tabs margin-bottom-20">
							<li class="active"><a data-toggle="tab" href="#home">Institute</a></li>
							<li><a data-toggle="tab" href="#profile">Students</a></li>
							<!-- <li><a data-toggle="tab" href="#general">General</a></li>
							<li><a data-toggle="tab" href="#paymentsRefunds">Payments & Refunds</a></li>
							<li><a data-toggle="tab" href="#admissions">Admissions</a></li> -->
						</ul>
						<div class="tab-content">
							<!-- Tab Content 1 -->
							<div id="home" class="tab-pane fade in active">
								<div id="accordion-v1" class="panel-group acc-v1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-One" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													What do I need to do to start taking admission on AdmissionX.com?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse in" id="collapse-One">
											<div class="panel-body">
												Create an account for your institute by providing us with all relevant details. This is totally free of charge! Sign up <a href="{{ URL::to('educational-institution') }}" target="_blank">here!</a>
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Two" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													Why does a college need to upload relevant documents before AdmissionX makes the institute’s profile active?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Two">
											<div class="panel-body">
												This is done to verify the authenticity of the account holder. During this period, the profile is ‘Under Review’. Once this process is complete, the profile is active on the website.
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Three" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													What are the clauses to agree upon for taking admissions through Admission X?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Three">
											<div class="panel-body">
												You should be in agreement with the clauses listed in the <a href="{{ URL::to('college-partner-agreement') }}" target="_blank"> College Partner Agreement.</a>
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Four" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													Why is it recommended by AdmissionX for the college to fill in all the available sections in the dashboard?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Four">
											<div class="panel-body">
												Profile completion ensures a higher level of confidence in the institute. It also provides all the necessary details to the student, helping them make an informed and swift decision.
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Five" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													Why do I need to confirm my email address before accessing my account?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Five">
											<div class="panel-body">
												We need to do this to make sure that all the correspondence and important communication (like applications and queries) reach the right person.
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Six" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													Can an institute change the fee and number of seats for a particular course?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Six">
											<div class="panel-body">
												Yes, you can change it at any time! It is a flexible mechanism completely driven by the institute’s authorities.
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Seven" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													What are the details of the student that are sent to the college when a student makes an application?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Seven">
											<div class="panel-body">
												The application generated by Admission X contains the following details: 10th and 12th academic records and information on other extra-curricular activities and projects undertaken. Also, the details of the amount paid for the application fee is sent.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Eight" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													What is the amount charged by the AdmissionX when a student makes his/her application?   
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Eight">
											<div class="panel-body">
												AdmissionX charges the student a fee of Rs. 499 which forms a part of the First year Fee to the Institution. Please refer to the <a href="{{ URL::to('college-partner-agreement') }}" target="_blank">College Partner Agreement</a> for details on this charge
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Nine" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													How much time do I have to accept/reject an application?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Nine">
											<div class="panel-body">
												We encourage the institution to make a quick decision on the application. We provide the institution a period of 2 working days to arrive at a decision.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Ten" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													What happens when I accept or reject an application?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Ten">
											<div class="panel-body">
												When an application is accepted, a provisional admission letter is generated for the student, a copy of which is sent to the institution as well. In case an application is rejected, the student gets a refund for the application fee.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-Eleventh" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													What happens after the student receives the provisional admission letter?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-Eleventh">
											<div class="panel-body">
												Once the provisional admission letter is generated, the students have a period of 6 working days to report at institute’s admission office to confirm their admission by getting their documents verified and fulfilling other formalities, as per institute’s policy.
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Tab Content 1 -->

							<!-- Tab Content 2 -->
							<div id="profile" class="tab-pane fade">
								<div id="accordion-v2" class="panel-group acc-v1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-One" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													Why do I need to upload my academic records?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse in" id="collapse-v2-One">
											<div class="panel-body">
												We need to forward these documents to the institution so that they can take an informed decision on your application. Without these details, your application is incomprehensible, incomplete and does not have a basis of admission 
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Two" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													Why is it important to keep an updated and accurate profile at all times?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Two">
											<div class="panel-body">
												It is important to keep your profile updated and accurate at all times since it forms an integral part of your application. Also, this is to ensure all correspondence and communication reaches the right person.
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Three" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													Why do I need to confirm my e-mail before I get access to my account?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Three">
											<div class="panel-body">
												It is important to verify the email address as all the essential communication regarding your application and queries will be notified on the registered email address. Therefore, it is mandatory to verify your email so that the correspondence reaches the right person.
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Four" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													Why do I need to enter my guardian/parent details before booking an admission if I am under 18?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Four">
											<div class="panel-body">
												We need to make sure anyone who is under 18 years of age at the time of application, has the consent of their guardian or parent before doing a monetary transaction with us.
											</div>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Five" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													When will I get to know the decision on my application? 
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Five">
											<div class="panel-body">
												You will be sent notifications through email and SMS. Also, you will be prompted when you next log in to your account on AdmissionX website. We will be regularly notifying you through email and SMS at every step of your account creation and application process.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Six" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													My application has been accepted, what happens now?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Six">
											<div class="panel-body">
												A provisional admission letter will be generated and e-mailed to you and the institution. You can take this as a proof along with all the required documents to the institution’s admissions office. You will then need to fulfil all remaining requirements to confirm your admission before the listed deadline date. This will include the verification of your documents and payment of any remaining fees as per the institution’s policy. 
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Seven" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													My application has been rejected, what do I do?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Seven">
											<div class="panel-body">
												We are sorry to hear that! Please head to our website and search for other options. Alternatively, shall you wish for a refund, please refer to <a href="{{ URL::to('cancellation-refunds') }}" target="_blank"> our refund and cancellation policy</a>.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Eight" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													I have changed my mind and would like to cancel my application, what should I do?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Eight">
											<div class="panel-body">
												The student is NOT entitled to a refund of the amount paid to AdmissionX if they cancel their admission after the generation of the provisional admission letter. However, half the student is entitled to half refund minus transaction charges if he cancels the admission within 3 working days of applying for such admission. For any queries, please refer to <a href="{{ URL::to('cancellation-refunds') }}" target="_blank">our refund and cancellation policy. </a> 
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Nine" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													 I have a valid provisional admission letter and the institution has refused admission to me, what do I do?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Nine">
											<div class="panel-body">
												Please contact us through phone or E-Mail at the earliest and we will try to resolve this issue. If there is no solution whatsoever, we shall refund your application fee in full.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Ten" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													How long does it take to process a refund?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Ten">
											<div class="panel-body">
												It takes the payment gateway 10-15 working days to complete the refund process. 
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-Eleven" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													  Can I transfer/sell my admission rights to a third party?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id="collapse-v2-Eleven">
											<div class="panel-body">
												No. Admission to particular course is valid only for that candidate. Under no circumstances, is this offer of admission transferable to someone else.
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Tab Content 2 -->
							
							<!-- Tab Content 3 -->
							<div id="general" class="tab-pane fade">
								<div id="accordion-v2" class="panel-group acc-v1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-One" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													What is Lorem Ipsum?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse in" id="collapse-v2-One">
											<div class="panel-body">
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Tab Content 3 -->

							<!-- Tab Content 4 -->
							<div id="paymentsRefunds" class="tab-pane fade">
								<div id="accordion-v2" class="panel-group acc-v1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-One" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													Why do we use it?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse in" id="collapse-v2-One">
											<div class="panel-body">
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Tab Content 4 -->

							<!-- Tab Content 5 -->
							<div id="admissions" class="tab-pane fade">
								<div id="accordion-v2" class="panel-group acc-v1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-One" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													Where does it come from?
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse in" id="collapse-v2-One">
											<div class="panel-body">
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Tab Content 5 -->
						</div>
					</div>
				</div><!--/col-md-6-->
				<!--End Tab v1-->
			</div>
			<!-- End FAQ Content -->
		</div>

		<div class="container content-sm">
			<!-- <div class="row equal-height-columns margin-bottom-40">
				<div class="col-sm-4 no-space">
					<div class="easy-block-v3 equal-height-column first" style="height: 167px;">
						<i class="fa fa-headphones"></i>
						<div class="inner-faq-b">
							<h3>Contact Us</h3>
							<h4>L 5, Lajpat Nagar, New Delhi - 110024 </h4>
							<p></p>
						</div>
					</div>
				</div>
				<div class="col-sm-4 no-space">
					<div class="easy-block-v3 equal-height-column second" style="height: 167px;">
						<i class="icon-cursor"></i>
						<div class="inner-faq-b">
							<h3>Email Us</h3>
							<h4><a href="mailto:support@admissionx.info">support@admissionx.info</a></h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4 no-space">
					<div class="easy-block-v3 equal-height-column third" style="height: 167px;">
						<i class="icon-support"></i>
						<div class="inner-faq-b">
							<h3>Support</h3>
							<h4>Call Us</h4>
							<h4>011-4224-9249 </h4>
						</div>
					</div>
				</div>
			</div> -->

			<div class="row">
				<div class="col-md-6 col-sm-6">
					<!-- Google Map -->
					<!-- 16:9 aspect ratio -->
					<div class="embed-responsive embed-responsive-16by9">
						<!-- <div id="gmap_canvas" class="embed-responsive-item" style="width:100%;"></div> -->
						<!-- Google Map -->
						{{-- <div id="map" class="map embed-responsive-item" style="width:100%;"></div> --}}
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14016.225727923327!2d77.2465785!3d28.5680681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3b1f9e020ad%3A0x18cc0ea2cb1636b7!2sAdmissionX!5e0!3m2!1sen!2sin!4v1701671854368!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						<!---/map-->
						<!-- End Google Map -->
					</div>

					
					<!-- End Google Map -->
				</div>
				<div class="col-md-6 col-sm-6">
					<!-- Business Hours -->
					<h3>Get In Touch</h3>
					<ul class="list-inline">
						<li><strong>Monday-Saturday:</strong> 10 AM to 5 PM</li>
						<li><strong>Sunday:</strong> Closed</li>
					</ul>

					<hr>
					
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
					<div class="row">
						<form action="/help-center-detail-query" method="post" class="contact-style" novalidate="novalidate" data-parsley-validate ="", enctype = "multipart/form-data">
							<div>
								<div class="col-sm-6">
									<div class="input-group margin-bottom-10">
										<label>Name</label>
										<input type="name" name="userName"class="form-control" placeholder="Enter name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" required="">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-group margin-bottom-20">
										<label>Email Address</label>
										<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="emailAddress" class="form-control" placeholder="Enter email here" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
									</div>
								</div>
							</div>
							<div class="col-sm-12 margin-bottom-20">
								<textarea rows="5" name="message" id="message" class="form-control " placeholder="Type your question here..." data-parsley-trigger="change"  data-parsley-error-message="Please enter message" required=""></textarea>
							</div>

							<div class="col-md-12 margin-bottom-20">
								<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
								{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
							</div>
							<div class="col-sm-12">
								<button class="btn-u btn-u-sm pull-right margin-top-20" id="btnValidate" type="submit">Send Query</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

			
@endsection


@section('scripts')
	<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKlTjj72lhQm1xqvMI5LPRP4uyBKfP3BY"></script>
	{!! Html::script('home-layout/assets/js/gmap.js') !!}
	{!! Html::script('home-layout/assets/js/page_contacts.js') !!}
	<script type="text/javascript">
	jQuery(document).ready(function() {
		ContactPage.initMap();
	});
	</script>
	<!-- <script type="text/javascript">
	$('#btnValidate').click(function(e){
		e.preventDefault();
	  	var $captcha = $('#recaptcha'),
	    response = grecaptcha.getResponse();
		if (response.length === 0) {
			toastr.error('reCAPTCHA is mandatory');
		    $( '.msg-error').text( "reCAPTCHA is mandatory" );
		    if( !$captcha.hasClass( "error" ) ){
		      $captcha.addClass( "error" );
		    }
		    return false;
		}else{
		    $('.msg-error').text('');
		    $captcha.removeClass( "error" );
		    //toastr.success('reCAPTCHA marked');
		    this.form.submit();
		}
	});
</script> -->
<script type="text/javascript">
    window.onload = function() {
	    var $recaptcha = document.querySelector('#g-recaptcha-response');

	    if($recaptcha) {
	        $recaptcha.setAttribute("required", "required");
	    }
  	};
</script>

@endsection

			