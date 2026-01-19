@extends('website/new-design-layouts.master')
@section('styles')
<style type="text/css">
	/*FAQ-page
------------------------------------*/
.faq-breadcrumb {
	text-align: center;
	position: relative;
	background: url(assets/img/sliders/10.jpg) no-repeat center;
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
				<h1>Career Counselling</h1>
				<!-- <ul class="breadcrumb-v2 list-inline">
					<li><a href="#"><i class="rounded-x fa fa-angle-right"></i>Home</a></li>
					<li><a href="#"><i class="rounded-x fa fa-angle-right"></i>Page</a></li>
					<li class="active"><i class="rounded-x fa fa-angle-right"></i>F.A.Q</li>
				</ul> -->
			</div>
		</div>

		<div class="container content faq-page">

			<!-- FAQ Content -->
			<div class="row">
				<!-- Begin Tab v1 -->
				<div class="col-md-12">
					<div class="tab-v1">
						<ul class="nav nav-tabs margin-bottom-20">
							<li class="active"><a data-toggle="tab" href="#AFTER10TH">AFTER 10TH</a></li>
							<li><a data-toggle="tab" href="#AFTER12TH">AFTER 12TH</a></li>
							<li><a data-toggle="tab" href="#AFTERGRADUATION">AFTER GRADUATION</a></li>
						</ul>
						<div class="tab-content">
							<!-- Tab Content 1 -->
							<div id="AFTER10TH" class="tab-pane fade in active">
								<div id="accordion-v1" class="panel-group acc-v1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-One" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
													AFTER 10TH
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse in" id="collapse-One">
											<div class="panel-body">
												<p>Selecting a stream after 10th requires a lot of brainstorming and critical thinking.</p>

												<p>To successfully select a stream of your choice follow these steps:</p>
												<ul>
													<li>Think about the last 12 years of education you have had. Reflect on what you have liked, what subjects interested you, what ignited your passion and what you disliked. Write it down in 5-6 bullet points.</li>
													<li>After you have done this consider this question “What stream of the given 3- Science, Commerce, and Humanities suits your likings the best?” If you still don’t get the answer, try this:</li>
													<li>Think about the next 5 years, you will be finishing college (or 6 years) and getting placed/going for Masters. What would you like to work on? What makes you feel fulfilled? It could be giving back to society, or creating things, or making art, or just simply business. Find your calling.</li>
												</ul> 
												
												<p>Select a stream you think is right for YOU. Not your parents, not your neighbors- but you.
												And if you select a stream and realize it isn’t for you- don’t panic. Most schools give you an option to switch streams by submitting applications before a stipulated time.
												Here is a brief description of the streams available for a little help:</p><br />
												<ul>
												<li><strong>Science:</strong> Science is the most chosen stream of all. It offers popular and wholesome courses like Engineering and Medicine. It is also popular because it helps keep your options open, which means you can opt for commerce and arts courses after doing Science as 10+2. (With disadvantage of a few marks, of course.) The main subjects you will study in Science are Physics, Chemistry, and English, and usually are giving a choice between Mathematics, Biology, and Psychology amongst others depending on your school.
												</li><br />
												<li><strong>Commerce:</strong> Being second most popular stream in the country, it offers some of the highest paying jobs in the world ranging from investment banking, chartered accountant and financial advisors. With the corporate world booming manifold, this stream is picking up the pace with science with many students opting for commerce because of its wide scope in this economy.
												</li><br />
												<li>
												<strong>Humanities/Arts:</strong> Although there is a notion that Humanities is an easy stream for weaker students- it is not. This stream offers some exciting subjects and courses for the students interested in History, Political Science, Literature and Economics.</li><br />
												<li>This stream is popular for careers like teaching, journalism, lecturers and social work.</li><br />
												<li>Alternatively, if you do not wish to pursue school after 10th, here are some career courses to choose from-</li><br />
												<li><strong>Indian Army:</strong> After completing matriculation, students can apply to various posts in the Indian Army by giving examinations like Indian Army Soldier Clerks Examination, Indian Army Soldier Technical Examination. A point to be noted here is that these are not high but Clerical and Technical posts.</li><br />
												 
												<li><strong>Police Force:</strong>  On the basis of a physical and written test, one can join as constable in Central Reserve Police Force.
												</li><br />
												<li><strong>ITIs and ITCs:</strong> Established under Ministry of Labor, Government run Industrial Training Institutes and privately run Industrial Training Centers provide training in a technical field. ITI courses are designed for basic skill development needed for a specified trade like a fitter, plumber, electrician, mechanic, welder amongst others. Depending upon trade, the duration of the course may vary from one to three years. After passing the course one may opt to undergo practical training in his trade. A National Trade Certificate (NTC) in provided by National Council for Vocational Training (NCVT) in the concerned trade and to obtain this certificate one has to qualify the All India Trade Test (AITT).</li>
												</ul>
											</div>
										</div>
									</div>
									
								</div>
							</div>
							<!-- End Tab Content 1 -->

							<!-- Tab Content 2 -->
							<div id="AFTER12TH" class="tab-pane fade">
								<div id="accordion-v2" class="panel-group acc-v1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v2-One" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
													After 12th
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse in" id="collapse-v2-One">
											<div class="panel-body">
												<p>This is a crucial time in everyone’s life. The decisions you make now make your future. So make sure you take each step carefully, logically and most importantly, to YOUR benefit.</p>
												<p>First, reflect on the last two years of your education. 11th and 12th grade decide a lot of things.</p>
												<ul>
													<li>What stream did you take?</li>
													<li>What subjects did you like the most?</li>
													<li>How much did you score in each subject?</li>
												</ul>
												<p>Do an in-depth analysis of you strengths, weaknesses and pressure points.
												This will give you a strong insight into what is good for you.
												Do an opportunity analysis of your stream by assessing all the course options available for you and find the one that suits you best.
												It could be something other than Engineering, CA or Medicine. Don’t go with the crowd. The key here is to find a course that fulfils your purpose, not the other 8.2 million youth of the Country.
												</p>
												<h4><strong>Here is a list of some of the courses available for you to help start your career/course selection:</strong></h4><br>
												<h4>For Science Stream:</h4>
												<ul>
													<li>Engineering- Mechanical, Aeronautical, Civil, Electrical, Computer, Electronics, Robotics, Chemical, Agricultural, Environmental and Petroleum are just some of the engineering degree courses available after 12th.</li>
													<li>B.Sc. Botany, Zoology, Chemistry, B.Sc. Botany, Microbiology, Chemistry, B.Sc. Microbiology, Biotechnology, Chemistry, B.Sc. or B.Tech. in Biotechnology, B.Sc. in Microbiology, B.Sc. Agriculture Science, B.Sc. Marine Biology, B.Sc. Medical Laboratory Technology, B.Sc. in Radiology, B.Sc. in Bioinformatics, B.Sc. Computer Science are some other conventional courses after Science stream.</li>
													<li>Medicine- There is a range of medical courses available after 12th, after the science stream (with Biology). MBBS, BAMS (Ayurvedic), BHMS (Homoeopathy), BUMS (Unani), B.Dental Studies, Bachelor of Veterinary Science & Animal Husbandry (B.VSc AH), Bachelor of Naturopathy & Yogic Science (BNYS), Bachelor of Physiotherapy, Integrated M.Sc. and B.Sc. Nursing are some sought-after courses after PCB.</li>
												</ul>
												<p>Alternatively, students from Science stream can pursue courses from Commerce and Humanities at a slight marks disadvantage.</p>
												<p>Also, there are some standard courses available.</p>

												<h4><strong>For Commerce Stream:</strong></h4>
												<ul>
													<li>  B.Com, B.Com (H) - B.Com and B.Com(Hons.) are commerce specialized courses that deal with a wide range of subjects from business/corporate law, accountancy, management and other key business areas. These courses have a wide scope for further study and even specialization.</li>
													<li>B.A. (Hons.) Economics- One of the sophisticated courses offered in India. This course offers specialization in the field of Economics. The subjects are a little difficult, compared to B.Com/B.Com (H), but this course opens doors to a number of post-graduate specializations and jobs.</li>
													<li>Chartered Accountancy (CA)- The Chartered Accountancy course is a professional study regulated by ICAI (The Institute of Chartered Accountants of India) which deals with Accounting, Law, Economics and other of any business. It has been an upcoming and popular study due to its professional title and availability of opportunities in this field currently. It requires clearing of four levels of exams and completing and articleship of 3 years minimum to become a certified practicing CA.</li>
													<li>Company Secretary (CS)- Companies Secretary is a highly reputed and rewarding course that deals with the law, management and governance aspect of an organization to name a few. It is sometimes an above-managerial level position, otherwise, managerial. This profession deals with regulation, security and legal compliances of an organization. It is a specialization that is regulated by ICSI (The Institute of Company Secretaries of India.) and consists of 3 levels and 15 months of training with a practicing CS.</li>
													<li>Bachelors of Business Administration. (BBA)- BBA is a 3-year degree programme that provides fundamental knowledge of business and management principles. The study in this course ranges from international business, finance, real estate, computer information systems, to accounting. Many Schools provide practical management training as a part of curriculum making BBA a very sought after option to pursue.</li>
													<li>Cost and Management Accountant. (CMA) – Formerly known as Cost and Works Accountant (CWA), CMA is a proficiency in accounting, financial planning, analysis and management decision making. CMAs can specialize in many roles such as staff accountant, cost accountant, corporate accountant, internal auditor, tax accountant, financial analyst or budget analyst.</li>
													<li>BBA (LLB) - BBA (LLB) is the study of law that deals with common law aspects such as civil, criminal, procedural and corporate laws but also incorporates business aspect such as Business Ethics, Human resource management and strategic management. This is a very popular course amongst students who want to pursue corporate law in the future. It gives a good insight into business functions as well as the legal aspect of banking, corporate governance, investment, mergers and acquisitions.</li>
												</ul>
												<p>Enlisted above are some conventional courses for students of Commerce Stream.
												Alternatively, Commerce students can apply to Humanities courses. (At a slight marks disadvantage in some cases and colleges.)
												</p>

												<br>
												<h4><strong>For Humanities Stream:</strong></h4>
												<ul>
													<li>
														Bachelor of Arts- Bachelor of Arts (BA) is a broad interdisciplinary undergraduate programme. This degree is offered by many colleges and universities with honors and specializations in subjects like English, History, Political Science, Economics, Journalism, and Psychology to name a few. The prospects after these courses range from a Masters degree to jobs. The possibilities are government jobs, research work, and social work amongst others.
													</li>
													<li>
														Bachelor of Fine Arts-Fine Arts is an art form which is developed mainly for aesthetics rather than practical application. Subjects studied under this degree are drawing, painting, figure drawing, portraiture, watercolour, art-making concept development, and art history critique. Many students opt for this degree to pursue arts as a career or for a further, in-depth study into their skills. Job prospects range from Illustrator, Visual artist, art critic to design trainer. The possibilities are endless.
													</li>
													<li>Journalism and Mass Communication- Popularly called BJMC (Bachelor or Journalism and Mass Communication), it is an undergraduate Mass Communication course. It is aimed at the development of journalistic skills, media research and development, and foundation in many media technologies like print, radio, television, and internet. BJMC graduates can work in a number of media like print, television, radio. They can also freelance. BJMC is extremely career offering in nature.</li>
													<li>Hotel Management- The hotel industry is a crucial part of the hospitality industry with a huge growth potential in the near future. The demand for hotel management professionals is already huge and is expected to grow. The 3-year undergraduate program trains students in multiple skills like food and beverage service, front office operation, sales and marketing, and accounting.</li>

												</ul>
												<p>For any further queries and doubts, feel free to contact AdmissionX from our <a href="{{ URL::to('contact-us') }}" target="_blank">Contact Us</a> page.
												AdmissionX- Making higher education accessible, affordable and incredible!
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Tab Content 2 -->
							
							<!-- Tab Content 3 -->
							<div id="AFTERGRADUATION" class="tab-pane fade">
								<div id="accordion-v3" class="panel-group acc-v1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href="#collapse-v3-One" data-parent="#accordion-v3" data-toggle="collapse" class="accordion-toggle">
													AFTER GRADUATION
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse in" id="collapse-v3-One">
											<div class="panel-body">
												<p>
													After completing a Bachelors degree, a lot of options are opened. The two main choices in front of you are- to continue education and get a Masters degree or to get a job. While getting a job after graduation is a good idea, sometimes a further study of your subjects may open a lot more avenues in the future.
												</p>
												<p>
													Before selecting either of the options, do a careful analysis of your subjects and ask the
													following questions:
													“Do I really need a job immediately?” “Do I truly enjoy my subjects and want to study further?” “Does my career require further knowledge or a specific qualification?”

													If you are passionate about your subjects or require that extra qualification- great. Go ahead get that Master’s degree. But if you are going for Masters because it buys you another year or two in School, you might want to reconsider. Master’s degree is expensive and a lot of them, if not from top tier schools- are worthless.
												</p>
												<p>
													If you think your campus placement after graduation isn’t up to the mark, relax. Accept this is where you start. It is okay to not be placed as the CEO of a multi-billion corporation. Alternatively, here is a list of all courses and degrees that can be pursued after  graduation:
												</p>
												<p>
													<strong>M.COM.</strong> – Masters of Commerce is a post-graduate degree in commerce, management and accounting related subjects. Reputed universities have criteria of a minimum of 60% in a commerce or commerce related bachelor&#39;s degree.
												</p>
												<p>
													<strong>M.Tech.</strong> – Masters of Technology or Masters of Engineering is a postgraduate degree an engineer can opt for. It is an extension of engineer’s graduate education. It is a good choice if you wish to get in-depth knowledge of your technical field and is also a reputed qualification a lot of technical careers require.
												</p>
												<p>
													<strong>MBA</strong> - The most opted Master&#39;s degree of all, MBA is an internationally recognised degree designed to develop business and managerial skills. They include core curriculum subjects such as accounting, operations marketing and economics and elective courses for the student to mould his degree to his professional and personal preference.
												</p>
												<p>
													<strong>MCA</strong> - Masters of Computer Applications is an increasingly popular postgraduate degree in the field of Information Technology. MCA is inclined more towards Application Development and thus has more emphasis on latest programming language and tools to develop better and faster applications. MCA focuses on providing a sound theoretical background as well as good practical exposure to students in the relevant areas.
												</p>
												<p>
													<strong>M.Sc.</strong> - is a postgraduate level programme offered in the majority of universities in India. It offers in-depth theoretical as well as practical knowledge in a wide range of subjects such as Physics, Chemistry, Mathematics, Botany, Zoology etc. It forms the foundation for further study such as PhD.
												</p>
												<p>
													<strong>MA</strong> - Masters of Arts is a broad subdivision of a culture composed of many expressive disciplines. The field of arts encompasses visual arts, literature, performing arts, including music, drama, dance, film and related media, amongst others. It is a non-scientific postgraduate degree that is also available through Correspondence and Distance Learning.
												</p>
												<p>
													<strong>Alternatively</strong>, there are many other courses such as <strong>M.Pharma, Law, CA, CS,</strong> and <strong>other postgraduate courses in biological and life sciences.</strong>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Tab Content 3 -->

						</div>
					</div>
				</div><!--/col-md-6-->
				<!--End Tab v1-->
			</div>
			<!-- End FAQ Content -->
		</div>

@endsection

			