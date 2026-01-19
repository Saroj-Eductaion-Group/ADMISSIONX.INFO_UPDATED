@extends('website/new-design-layouts.master')

@section('content')
<!-- college in india top start -->
<div class="searchindiaMain">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="searchindiaTop">
					<h2>List of colleges in india</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end college in india top -->

<!-- college in india bot start -->
<div class="searchindiaBot padding-top40 padding-bottom40">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="searchindiaBotLeft">
					<div id="accordion" class="panel panel-primary behclick-panel searchindiaAccd">
						<div class="panel-body" >
							<div class="searchselectmn">
								<div class="panel-heading searchindiaselect">
									<h4 class="panel-title searchindiatitle">
										<a data-toggle="collapse" href="#collapse0">
											<i class="indicator fa fa-caret-down" aria-hidden="true"></i>Select State
										</a>
									</h4>
								</div>
								<div id="collapse0" class="panel-collapse collapse in selectCollapse" >
									<ul class="list-group">
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox" type="checkbox" checked>
										    	<label for="myCheckbox" class="selectmyCheckbox">Checkbox checked</label>
										    	<span></span>
	  										</div>
										</li>
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
											    <input id="myCheckbox2" type="checkbox">
											    <label for="myCheckbox2" class="selectmyCheckbox">Checkbox unchecked</label>
											    <span></span>
	  										</div>
										</li>
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox3" type="checkbox">
										    	<label for="myCheckbox3" class="selectmyCheckbox">Checkbox disabled</label>
										    	<span></span>
										  	</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="searchselectmn">
								<div class="panel-heading searchindiaselect">
									<h4 class="panel-title searchindiatitle">
										<a data-toggle="collapse" href="#collapse1">
											<i class="indicator fa fa-caret-down" aria-hidden="true"></i> By Course
										</a>
									</h4>
								</div>
								<div id="collapse1" class="panel-collapse collapse in selectCollapse" >
									<ul class="list-group">
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox4" type="checkbox">
										    	<label for="myCheckbox4" class="selectmyCheckbox">Checkbox checked</label>
										    	<span></span>
	  										</div>
										</li>
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
											    <input id="myCheckbox5" type="checkbox">
											    <label for="myCheckbox5" class="selectmyCheckbox">Checkbox unchecked</label>
											    <span></span>
	  										</div>
										</li>
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox6" type="checkbox">
										    	<label for="myCheckbox6" class="selectmyCheckbox">Checkbox disabled</label>
										    	<span></span>
										  	</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="searchselectmn">
								<div class="panel-heading searchindiaselect">
									<h4 class="panel-title searchindiatitle">
										<a data-toggle="collapse" href="#collapse3"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>By Sub Stream</a>
									</h4>
								</div>
								<div id="collapse3" class="panel-collapse collapse in selectCollapse">
									<ul class="list-group">
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox7" type="checkbox">
										    	<label for="myCheckbox7" class="selectmyCheckbox">Checkbox</label>
										    	<span></span>
	  										</div>
										</li>
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
											    <input id="myCheckbox8" type="checkbox">
											    <label for="myCheckbox8" class="selectmyCheckbox">Checkbox</label>
											    <span></span>
	  										</div>
										</li>
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox9" type="checkbox">
										    	<label for="myCheckbox9" class="selectmyCheckbox">Checkbox</label>
										    	<span></span>
										  	</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="searchselectmn">
								<div class="panel-heading searchindiaselect searchindiaselect">
									<h4 class="panel-title searchindiatitle">
										<a data-toggle="collapse" href="#collapse4"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Course Fee/Year</a>
									</h4>
								</div>
								<div id="collapse4" class="panel-collapse collapse in selectCollapse">
									<ul class="list-group">
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox8" type="checkbox">
										    	<label for="myCheckbox8" class="selectmyCheckbox">Checkbox</label>
										    	<span></span>
	  										</div>
										</li>
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
											    <input id="myCheckbox9" type="checkbox">
											    <label for="myCheckbox9" class="selectmyCheckbox">Checkbox</label>
											    <span></span>
	  										</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="searchselectmn">	
								<div class="panel-heading searchindiaselect searchindiaselect">
									<h4 class="panel-title searchindiatitle">
										<a data-toggle="collapse" href="#collapse6"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Approved by</a>
									</h4>
								</div>
								<div id="collapse6" class="panel-collapse collapse in selectCollapse">
									<ul class="list-group">
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox10" type="checkbox">
										    	<label for="myCheckbox10" class="selectmyCheckbox">Checkbox</label>
										    	<span></span>
	  										</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="searchselectmn">	
								<div class="panel-heading searchindiaselect searchindiaselect">
									<h4 class="panel-title searchindiatitle">
										<a data-toggle="collapse" href="#collapse7"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Type of Course</a>
									</h4>
								</div>
								<div id="collapse7" class="panel-collapse collapse in selectCollapse">
									<ul class="list-group">
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox11" type="checkbox">
										    	<label for="myCheckbox11" class="selectmyCheckbox">Checkbox</label>
										    	<span></span>
	  										</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="searchselectmn">	
								<div class="panel-heading searchindiaselect searchindiaselect">
									<h4 class="panel-title searchindiatitle">
										<a data-toggle="collapse" href="#collapse9"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Type of College</a>
									</h4>
								</div>
								<div id="collapse9" class="panel-collapse collapse in selectCollapse">
									<ul class="list-group">
										<li class="list-group-item selectlistGroup">
											<div class="chiller_cb">
										    	<input id="myCheckbox12" type="checkbox">
										    	<label for="myCheckbox12" class="selectmyCheckbox">Checkbox</label>
										    	<span></span>
	  										</div>
										</li>
									</ul>
								</div>
							</div>	
						</div>
					</div>
				</div>
				<div class="searchindiaBotImg">
					<img src="/assets/images/search-college/admission-img1.png" style="width: 100%;">
				</div>	
			</div>
			<div class="col-md-9">
				<div class="searchindiaBotRight">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<img class="searchCollegeImg" src="/assets/images/search-college/college-img1.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<hr class="hrbrdr">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<img class="searchCollegeImg" src="/assets/images/search-college/college-img2.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<hr class="hrbrdr">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<img class="searchCollegeImg" src="/assets/images/search-college/college-img3.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<hr class="hrbrdr">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<img class="searchCollegeImg" src="/assets/images/search-college/college-img4.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<hr class="hrbrdr">
					<div class="row">
						<div class="col-md-12">
							<div class="admissionOpenMid padding-bottom20">
								<img src="/assets/images/search-college/admission-open-img1.png" style="width:100%;">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<img class="searchCollegeImg"  src="/assets/images/search-college/college-img5.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<hr class="hrbrdr">
					<div class="row">
						<div class="col-md-3">
							<img class="searchCollegeImg" src="/assets/images/search-college/college-img6.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<hr class="hrbrdr">
					<div class="row">
						<div class="col-md-3">
							<img class="searchCollegeImg" src="/assets/images/search-college/college-img7.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<hr class="hrbrdr">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<img class="searchCollegeImg" src="/assets/images/search-college/college-img8.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<hr class="hrbrdr">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<img class="searchCollegeImg" src="/assets/images/search-college/college-img9.png">
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="admissionContent">
								<div class="admissionContentTop">
									<h2>Lorem Ipsum</h2>
									<ul>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star"></i>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="fa fa-star active"></i>
											</a>
										</li>
									</ul>
									<h3>Delhi</h3>
								</div>
								<div class="admissionContentBot">
									<ul>
										<li>
												<a href="javascript:void(0);">Admissions |</a>
										</li>
										<li>
												<a href="javascript:void(0);">Placements</a>
										</li>
									</ul>
									<p>Bachelor of Business Administration (BBA)</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="search-collegeApply padding-top90">
								<ul>
									<li>
										<a href="javascript:void(0);">Apply</a>
									</li>
									<li>
										<a href="javascript:void(0);">Query</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end college in india bot -->
@endsection

@section('scripts')
	<script>
    	    	

        function toggleChevron(e) {
		$(e.target)
				.prev('.panel-heading')
				.find("i.indicator")
				.toggleClass('fa-caret-down fa-caret-right');
	}
	$('#accordion').on('hidden.bs.collapse', toggleChevron);
	$('#accordion').on('shown.bs.collapse', toggleChevron);

	</script>
@endsection



