@extends('website/new-design-layouts.master')

@section('styles')
@endsection

@section('content')
<!-- banner start -->
<div class="bannerMain">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="bannerContent">
					<ul class="nav nav-tabs navtabTop" role="tablist">
   						 <li class="nav-item active">
      						<a class="nav-link" data-toggle="tab" href="#college">College</a>
    					</li>
					    <li class="nav-item">
					    	<a class="nav-link" data-toggle="tab" href="#exam">Exams</a>
					    </li>
					</ul>
					<div class="row">
					  	<div class="tab-content">
					    	<div id="college" class="container tab-pane active"><br>
					      		<div class="row">
					      			<div class="col-md-12">
					      				<div class="bannerContentBot">
					      					<div class="bannerContentBotInput">
					      						<input class="form-control collegeInstinp" name="College/Institute" type="text" placeholder="College/Institute">
					      						<select class="js-example-placeholder-multiple js-states form-control collegeInstSelect" multiple="multiple">
					      							<option>Delhi</option>
					      							<option>Mumbai</option>
					      							<option>Punjab</option>
					      							<option>Chandigarh</option>
					      							<option>Kolkata</option>
					      						</select>
					      					</div>
					      					<button class="EnterDetailsButton" type="submit">Search</button>
					      				</div>
					      			</div>
					      		</div>
					    	</div>
					    	<div id="exam" class="container tab-pane fade"><br>
					      		<div class="row">
					      			<div class="col-md-12">
					      				<div class="bannerContentBot">
					      					<div class="bannerContentBotInput">
					      						<input class="form-control collegeInstinp" name="College/Institute" type="text" placeholder="College/Institute">
					      						<select style="width:28%;" class="js-example-placeholder-multiple js-states form-control collegeInstSelect" multiple="multiple">
					      							<option>Delhi</option>
					      							<option>Mumbai</option>
					      							<option>Punjab</option>
					      							<option>Chandigarh</option>
					      							<option>Kolkata</option>
					      						</select>
					      					</div>
					      					<button class="EnterDetailsButton" type="submit">Search</button>
					      				</div>
					      			</div>
					      		</div>
					    	</div>
					    </div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end banner slider -->

<!-- form start -->
<!-- <div class="formMain padding-top30 padding-bottom30">
	<div class="">
		<div class="row formTop">
			<div class="col-md-12 formTopContent">
				<form>
					<input class="form-control EnterDetailInput" name="College/Institute" type="text" placeholder="College/Institute" required="" autocomplete="on">
					<input class="form-control EnterDetailInput" name="Exams" type="text" placeholder="Exams" required="" autocomplete="off">
					<input class="form-control EnterDetailInput" name="Location" type="text" placeholder="Location" required="" autocomplete="off">
					<button class="EnterDetailsButton" type="submit">Search</button>
				</form>
			</div>
		</div>
	</div>
</div>
 --><!-- end form -->


<!-- what we offer start -->
<div class="WeofferMain padding-top40">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="WeofferTop text-center">
					<h2 class="text-transform padding-bottom30">what we offer</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-xs-12">
				<div class="WeofferBotleft">
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<div class="WeofferBotleftSub">
								<div class="WeofferBotleftContentTop">
									<figure>
										<img src="/assets/images/homepage/college-img1.png">
									</figure>
									<h2>College</h2>
								</div>
								<div class="WeofferBotleftContentBot">
									<p class="pull-left"><span>dolor sit amet,</span> consectetur, adipisci velit</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xs-12">
							<div class="WeofferBotleftSub">
								<div class="WeofferBotleftContentTop">
									<figure>
										<img src="/assets/images/homepage/cut-off-img1.png">
									</figure>
									<h2>Cut Off</h2>
								</div>
								<div class="WeofferBotleftContentBot">
									<p class="pull-left"><span>dolor sit amet,</span> consectetur, adipisci velit</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xs-12">
							<div class="WeofferBotleftSub">
								<div class="WeofferBotleftContentTop">
									<figure>
										<img src="/assets/images/homepage/exam-img1.png">
									</figure>
									<h2>Exam</h2>
								</div>
								<div class="WeofferBotleftExam">
									<p class="pull-left"><span>dolor sit amet,</span> consectetur, adipisci velit</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="WeofferMid">
					<figure>
						<img src="/assets/images/homepage/what-we-offer-bg.png">
					</figure>
				</div>
			</div>
			<div class="col-md-3 col-md-offset-1 col-xs-12">
				<div class="WeofferBotleft">
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<div class="WeofferBotleftSub">
								<div class="WeofferBotleftContentTop">
									<figure>
										<img src="/assets/images/homepage/rank-img1.png">
									</figure>
									<h2>Rank</h2>
								</div>
								<div class="WeofferBotleftContentBot">
									<p class="pull-left"><span>dolor sit amet,</span> consectetur, adipisci velit</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xs-12">
							<div class="WeofferBotleftSub">
								<div class="WeofferBotleftContentTop">
									<figure>
										<img src="/assets/images/homepage/job-fair-img1.png">
									</figure>
									<h2>Job Fair</h2>
								</div>
								<div class="WeofferBotleftJobFair">
									<p class="pull-left"><span>dolor sit amet,</span> consectetur, adipisci velit</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xs-12">
							<div class="WeofferBotleftSub">
								<div class="WeofferBotleftContentTop">
									<figure>
										<img src="/assets/images/homepage/internships-img1.png">
									</figure>
									<h2>Internships</h2>
								</div>
								<div class="WeofferBotleftContentBot">
									<p class="pull-left"><span>dolor sit amet,</span> consectetur, adipisci velit</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end what we offer -->

<!-- choose future start -->
<div class="choosefutureMain bg-grey padding-top40 padding-bottom40">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="choosefutureTop text-center">
					<h2 class="text-transform padding-bottom20">choose your future</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="tabbable-panel margin-tops4">
	      			<div class="tabbable-line">
				        <ul class="nav nav-tabs tabtop  tabsetting">
				        	<li class="active"> <a class="text-transform" href="#tabColleges" data-toggle="tab">colleges </a> </li>
				       		<li><a class="text-transform" href="#tabExams" data-toggle="tab">exams</a> </li>
				        </ul>
			        	<div class="tab-content margin-tops margin-top40">
			          		<div class="tab-pane active fade in" id="tabColleges">
			          			<div class="row choosefutureManageResponse margin-bottom30">
						            <div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<figure>
					              				<img src="/assets/images/homepage/management-img.png">
					              				<h2>Management</h2>
					              				<p>626 colleges</p>
				              				</figure>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<figure>
					              				<img src="/assets/images/homepage/engineering-img.png">
					              				<h2>Engineering</h2>
					              				<p>326 colleges</p>
				              				</figure>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/medical-img.png">
				              				<h2>Medical</h2>
				              				<p>226 colleges</p>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/agriculture-img.png">
				              				<h2>Agriculture</h2>
				              				<p>128 colleges</p>
				              			</div>
				          			</div>
			          			</div>
			          			<div class="row">
						            <div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/architecture-img.png">
				              				<h2>Architecture </h2>
				              				<p>530 colleges</p>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/commerce-img.png">
				              				<h2>Commerce</h2>
				              				<p>328 colleges</p>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/dental-img.png">
				              				<h2>Dental</h2>
				              				<p>726 colleges</p>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/arts-img.png">
				              				<h2>Arts</h2>
				              				<p>226 colleges</p>
				              			</div>
				          			</div>
			          			</div>
			          		</div>
			          		<div class="tab-pane fade" id="tabExams">
			            		<div class="row margin-bottom30">
						            <div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<figure>
					              				<img src="/assets/images/homepage/management-img.png">
					              				<h2>Management</h2>
					              				<p>626 colleges</p>
				              				</figure>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<figure>
					              				<img src="/assets/images/homepage/engineering-img.png">
					              				<h2>Engineering</h2>
					              				<p>326 colleges</p>
				              				</figure>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/medical-img.png">
				              				<h2>Medical</h2>
				              				<p>226 colleges</p>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/agriculture-img.png">
				              				<h2>Agriculture</h2>
				              				<p>128 colleges</p>
				              			</div>
				          			</div>
			          			</div>
			          			<div class="row">
						            <div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/architecture-img.png">
				              				<h2>Architecture </h2>
				              				<p>530 colleges</p>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/commerce-img.png">
				              				<h2>Commerce</h2>
				              				<p>328 colleges</p>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/dental-img.png">
				              				<h2>Dental</h2>
				              				<p>726 colleges</p>
				              			</div>
				          			</div>
				          			<div class="col-md-3 col-xs-12">
				              			<div class="choosefutureManage">
				              				<img src="/assets/images/homepage/arts-img.png">
				              				<h2>Arts</h2>
				              				<p>226 colleges</p>
				              			</div>
				          			</div>
			          			</div>
			          		</div>
			         	</div>
		      		</div>
		    	</div>
			</div>
		</div>
	</div>
</div>
<!-- end choose future -->

<!-- top courses and exams start -->
<div class="CoursesExamMain">
	<div class="row CoursesExamTop">
		<div class="col-md-6 CoursesExamLeft padding-top40 padding-bottom40">
			<div class="row CoursesExamLeftBotResponse">
				<div class="col-md-12">
					<div class="CoursesExamLeftTopContent text-center">
						<h2 class="text-transform">Top Courses</h2>
					</div>
				</div>
			</div>
			<div class="row CoursesExamLeftBotResponse padding-top40">
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
			</div>
			<div class="row CoursesExamLeftBotResponse padding-top40">
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
			</div>
			<div class="row CoursesExamLeftBotResponse padding-top40">
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
			</div>
			<div class="row padding-top30">
				<div class="col-md-12">
					<div class="viewMore">
						<a href="javascript:void(0);">View More</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12 CoursesExamRight padding-top40 padding-bottom40">
			<div class="row CoursesExamLeftBotResponse">
				<div class="col-md-12">
					<div class="CoursesExamLeftTopContent text-center">
						<h2 class="text-transform">Top exams</h2>
					</div>
				</div>
			</div>
			<div class="row CoursesExamLeftBotResponse padding-top40">
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
			</div>
			<div class="row CoursesExamLeftBotResponse padding-top40">
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
			</div>
			<div class="row CoursesExamLeftBotResponse padding-top40">
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="CoursesExamLeftBotContent text-center">
						<h2>01</h2>
						<h3>BE/B.Tech</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos vel similique eos voluptatem error voluptat.</p>
					</div>
				</div>
			</div>
			<div class="row padding-top30">
				<div class="col-md-12">
					<div class="viewMore">
						<a href="javascript:void(0);">View More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end top courses and exams -->

<!-- what students say start -->
<div class="whatstudentsMain padding-top40 padding-bottom40">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="whatstudentsTop">
					<h2 class="text-center text-transform">WHAT’S STUDENT SAY</h2>
				</div>
			</div>
		</div>
		<div class="row padding-top30">
	        <div class="col-sm-12">
	          	<div id="customers-testimonials" class="owl-carousel">
					<div class="item">
						<div class="row">
							<div class="col-md-6">
			            		<div class="ViewtestimonialMain">
			            			<div>
										<h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</h5>
				                	</div>
				                	<div class="ViewtestimonialBot">
				                		<div class="pull-left">
				                			<img src="/assets/images/homepage/student-img1.png">
				                		</div>
				                		<div class="testireview">
					                		<h2>Lorem Ipsum</h2>
					                		<p>Lorem ipsum dolor sit amet.</p>
				                		</div>
				                	</div>		
			            		</div>
				            </div>
							<div class="col-md-6">
			            		<div class="ViewtestimonialMain">
			            			<div>
										<h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</h5>
				                	</div>
				                	<div class="ViewtestimonialBot">
				                		<div class="pull-left">
				                			<img src="/assets/images/homepage/student-img1.png">
				                		</div>
				                		<div class="testireview">
					                		<h2>Lorem Ipsum</h2>
					                		<p>Lorem ipsum dolor sit amet.</p>
				                		</div>
				                	</div>
			            		</div>
				            </div>
						</div>
		            </div>
		          	<div class="item">
						<div class="row">
							<div class="col-md-6">
			            		<div class="ViewtestimonialMain">
			            			<div>
										<h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</h5>
				                	</div>
				                	<div class="ViewtestimonialBot">
				                		<div class="pull-left">
				                			<img src="/assets/images/homepage/student-img1.png">
				                		</div>
				                		<div class="testireview">
					                		<h2>Lorem Ipsum</h2>
					                		<p>Lorem ipsum dolor sit amet.</p>
				                		</div>
				                	</div>		
			            		</div>
				            </div>
							<div class="col-md-6">
			            		<div class="ViewtestimonialMain">
			            			<div>
										<h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</h5>
				                	</div>
				                	<div class="ViewtestimonialBot">
				                		<div class="pull-left">
				                			<img src="/assets/images/homepage/student-img1.png">
				                		</div>
				                		<div class="testireview">
					                		<h2>Lorem Ipsum</h2>
					                		<p>Lorem ipsum dolor sit amet.</p>
				                		</div>
				                	</div>
			            		</div>
				            </div>
						</div>
		            </div>
	          	</div>
	        </div>
      	</div>
	</div>
</div>
<!-- end what students say -->

<!-- top colleges start -->
<div class="TopCollegesMain bg-grey padding-top40 padding-bottom40">
	<div class="container">
		<div class="row margin-bottom5">
			<div class="col-md-12">
				<div class="TopCollegesTop padding-bottom5 text-center text-transform">
					<h2>Top colleges</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="TopCollegesBot">
					<ul class="nav nav-tabs TopCollegesBotTab" role="tablist">
    					<li class="nav-item active">
      						<a class="nav-link" data-toggle="tab" href="#medical">Medical</a>
    					</li>
					    <li class="nav-item">
					    	<a class="nav-link" data-toggle="tab" href="#engineering">Engineering</a>
					    </li>
					    <li class="nav-item">
					    	<a class="nav-link" data-toggle="tab" href="#management">Management</a>
					    </li>
  					</ul>
				  	<div class="tab-content">
				    	<div id="medical" class="container tab-pane active"><br>
				      		<div class="row padding-top5">
				      			<div class="col-md-4 col-xs-12">
				      				<div class="TopCollegesBotContent">
				      					<figure>
				      						<img src="/assets/images/homepage/top-collegesimg1.png">
				      					</figure>
				      					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				      				</div>
				      			</div>
				      			<div class="col-md-4 col-xs-12">
				      				<div class="TopCollegesBotContent TopCollegesBotContentResponse">
				      					<figure>
				      						<img src="/assets/images/homepage/top-collegesimg2.png">
				      					</figure>
				      					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				      				</div>
				      			</div>
				      			<div class="col-md-4 col-xs-12">
				      				<div class="TopCollegesBotContent">
				      					<figure>
				      						<img src="/assets/images/homepage/top-collegesimg3.png">
				      					</figure>
				      					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				      				</div>
				      			</div>
				      		</div>
				    	</div>
				    	<div id="engineering" class="container tab-pane fade"><br>
				      		<div class="row padding-top5">
				      			<div class="col-md-4 col-xs-12">
				      				<div class="TopCollegesBotContent">
				      					<figure>
				      						<img src="/assets/images/homepage/top-collegesimg1.png">
				      					</figure>
				      					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				      				</div>
				      			</div>
				      			<div class="col-md-4 col-xs-12">
				      				<div class="TopCollegesBotContent">
				      					<figure>
				      						<img src="/assets/images/homepage/top-collegesimg2.png">
				      					</figure>
				      					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				      				</div>
				      			</div>
				      		</div>
				    	</div>
				    	<div id="management" class="container tab-pane fade"><br>
				      		<div class="row padding-top5">
				      			<div class="col-md-4 col-xs-12">
				      				<div class="TopCollegesBotContent">
				      					<figure>
				      						<img src="/assets/images/homepage/top-collegesimg1.png">
				      					</figure>
				      					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				      				</div>
				      			</div>
				      			<div class="col-md-4 col-xs-12">
				      				<div class="TopCollegesBotContent">
				      					<figure>
				      						<img src="/assets/images/homepage/top-collegesimg2.png">
				      					</figure>
				      					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				      				</div>
				      			</div>
				      			<div class="col-md-4 col-xs-12">
				      				<div class="TopCollegesBotContent">
				      					<figure>
				      						<img src="/assets/images/homepage/top-collegesimg3.png">
				      					</figure>
				      					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				      				</div>
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
@endsection