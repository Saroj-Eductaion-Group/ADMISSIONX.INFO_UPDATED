@extends('website/new-design-layouts.master')

@section('styles')
@include('website.home.search-pages.search-field-partials.exam-search-style-partial')

<style type="text/css">
	.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	.wrapper{ position:relative;margin:0 auto;overflow:hidden;padding:5px; height:50px;}
	.list {position:absolute;left:0px;top:0px;min-width:3000px;margin-left:12px;margin-top:0px;}
	.list li{display:table-cell;position:relative;text-align:center;cursor:grab;cursor:-webkit-grab;color:#efefef;vertical-align:middle;}
	.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: #fff; cursor: default; background-color: #d40d12; border: 1px solid #ddd; border-bottom-color: transparent;}
	.scroller {text-align:center;cursor:pointer;display:none;padding:7px;padding-top:11px;white-space:no-wrap;vertical-align:middle;background-color:#fff;}
	.scroller-right{float:right;}
	.scroller-left {float:left;}
</style>

<style>
    .scrolling-wrapper {overflow-x: scroll;  overflow-y: hidden;  white-space: nowrap;}
    .cardMobile {display: inline-block;}
    .cardMobile {width: auto; margin: 5px; border: 1px solid #ccc;} 
    .cardMobile img {max-width: 100%;}
    .cardMobile .text {padding: 5px 5px 0px 5px;text-align: center;}
    .cardMobile .text > button {background: gray;border: 0;color: white;padding: 10px;width: 100%;}
</style>
@endsection
@section('content')

<!-- govt exam detail page start -->
<div class="govtexamDetailTop padding-top80 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="searchindiaTop">
					@include('website.home.search-pages.search-field-partials.exam-search-partial')
					<h2 class="text-center padding-bottom15">{{$typeOfExaminationObj->sortname}} - {{$typeOfExaminationObj->name}} details</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="govtexamDetailMain">
	<div class="container">
		@if($agent->isMobile())
		<div class="school-info section">
            <div class="section-title margin-bottom0">
            	<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 text-center hidden-lg hidden-md">
			            <div class="scrolling-wrapper">
			                <div class="cardMobile">
			                    <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">Overview</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">APPLICATION PROCESSES</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">ELIGIBILITIES</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">DATES</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">SYLLABUS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">PATTERNS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab7" aria-controls="tab7" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">ADMIT CARDS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab8" aria-controls="tab8" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">RESULTS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab9" aria-controls="tab9" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">CUT OFFS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab10" aria-controls="tab10" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">COUNSELLINGS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab11" aria-controls="tab11" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">PREPRATION TIPS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab12" aria-controls="tab12" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">ANSWER KEY</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab13" aria-controls="tab13" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">ANALYSIS RECORDS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab14" aria-controls="tab14" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">REFERENCE LINKS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="#tab15" aria-controls="tab15" role="tab" data-toggle="tab">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">FAQS</p>
			                        </div>
			                    </a>
			                </div>
				          	<div class="cardMobile">
			                    <a href="{{ URL::to('/examination-details/'.$stream.'/'.$slug.'/questions') }}" target="_blank">
			                        <div class="text">
			                            <p class="textColorBlack text-capitalize fontSize15  textDecoration margin-bottom5">QUESTIONS & ANSWER</p>
			                        </div>
			                    </a>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
		@endif
		<div class="row">
            @if($agent->isDesktop() || $agent->isTablet())
            <div class="col-md-12 margin-top20">
				<div class="scroller scroller-left"><i class="glyphicon glyphicon-chevron-left"></i></div>
				<div class="scroller scroller-right"><i class="glyphicon glyphicon-chevron-right"></i></div>
				<div class="wrapper">
					<ul class="nav nav-tabs list" id="myTab">
						<li role="tab1" class="item active">
			          		<a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><span>Overview</span></a>
			          	</li>
			          	<li class="item" role="tab2">
			          		<a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><span>APPLICATION PROCESSES</span></a>
			          	</li>
			          	<li class="item" role="tab3">
			          		<a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><span>ELIGIBILITIES</span></a>
			          	</li>
			          	<li class="item" role="tab4">
			          		<a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"><span>DATES</span></a>
			          	</li>
			          	<li class="item" role="tab5">
			          		<a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab"><span>SYLLABUS</span></a>
			          	</li>
			          	<li class="item" role="tab6">
			          		<a href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab"><span>PATTERNS</span></a>
			          	</li>
			          	<li class="item" role="tab7">
			          		<a href="#tab7" aria-controls="tab7" role="tab" data-toggle="tab"><span>ADMIT CARDS</span></a>
			          	</li>
			          	<li class="item" role="tab8">
			          		<a href="#tab8" aria-controls="tab8" role="tab" data-toggle="tab"><span>RESULTS</span></a>
			          	</li>
			          	<li class="item" role="tab9">
			          		<a href="#tab9" aria-controls="tab9" role="tab" data-toggle="tab"><span>CUT OFFS</span></a>
			          	</li>
			          	<li class="item" role="tab10">
			          		<a href="#tab10" aria-controls="tab10" role="tab" data-toggle="tab"><span>COUNSELLINGS</span></a>
			          	</li>
			          	<li class="item" role="tab11">
			          		<a href="#tab11" aria-controls="tab11" role="tab" data-toggle="tab"><span>PREPRATION TIPS</span></a>
			          	</li>
			          	<li class="item" role="tab12">
			          		<a href="#tab12" aria-controls="tab12" role="tab" data-toggle="tab"><span>ANSWER KEY</span></a>
			          	</li>
			          	<li class="item" role="tab13">
			          		<a href="#tab13" aria-controls="tab13" role="tab" data-toggle="tab"><span>ANALYSIS RECORDS</span></a>
			          	</li>
			          	<li class="item" role="tab14">
			          		<a href="#tab14" aria-controls="tab14" role="tab" data-toggle="tab"><span>REFERENCE LINKS</span></a>
			          	</li>
			          	<!-- <li class="item" role="tab15">
			          		<a href="{{ URL::to('/examination-details/'.$stream.'/'.$slug.'/faqs') }}" target="_blank"><span>FAQS</span></a>
			          	</li> -->
			          	<li class="item" role="tab15">
			          		<a href="#tab15" aria-controls="tab15" role="tab" data-toggle="tab"><span>FAQS</span></a>
			          	</li>
			          	<!-- <li class="item" role="tab16">
			          		<a href="#tab16" aria-controls="tab16" role="tab" data-toggle="tab"><span>QUESTIONS & ANSWER</span></a>
			          	</li> -->
			          	<li class="item" role="tab16">
			          		<a href="{{ URL::to('/examination-details/'.$stream.'/'.$slug.'/questions') }}" target="_blank"><span>QUESTIONS & ANSWER</span></a>
			          	</li>
					</ul>
				</div>
			</div>
            @endif
			<div class="col-md-12"> 
				@if(Session::has('counsellingForm'))
				<div class="padding-top20">
					<div class="alert alert-success  text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('counsellingForm') }}</strong>
					</div>
				</div>
				@endif
			    <div class="card padding-bottom30">
			        <div class="tab-content padding-top20 clientContactDetails margin-top20">
			        	<div role="tabpanel" class="tab-pane active" id="tab1">
			        		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
				          				<div class="row">
											<div class="col-md-12">
												<h2>Title : {{  $examinationDetailsObj->title }}</h2>
											</div>
											<div class="col-md-12">
												<label>Application Dates : 
													@if(isset($examinationDetailsObj) && !empty($examinationDetailsObj->applicationFrom) &&  !empty($examinationDetailsObj->applicationTo)) 
														@if(strtotime($examinationDetailsObj->applicationFrom))
															{{ date('d F Y h:s a', strtotime($examinationDetailsObj->applicationFrom)) }}
														@else
															{{$examinationDetailsObj->applicationFrom}}
														@endif 
														-
														@if(strtotime($examinationDetailsObj->applicationTo))
															{{ date('d F Y h:s a', strtotime($examinationDetailsObj->applicationTo)) }}
														@else
															{{$examinationDetailsObj->applicationTo}}
														@endif 
													@else 
														Not Updated Yet 
													@endif
												</label>
											</div>
											<div class="col-md-12">
												<label>Exmination Date : {{  $examinationDetailsObj->exminationDate }} </label> 
											</div>
											<div class="col-md-12">
												<label>Result Announce : {{  $examinationDetailsObj->resultAnnounce }} </label>
											</div>
											<div class="col-md-12">
												<label>Description : {!!  $examinationDetailsObj->description !!}</label>
										    </div>
										    <div class="col-md-12">
												<label>Contents : {!!  $examinationDetailsObj->content !!}</label>
										    </div>
										</div>
				          			</div>
				          		</div>
				          		<div class="col-md-3">
				          			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			      		</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab2">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										<div class="row">
											<div class="col-md-12">
												<label>Mode of application :
													@foreach( $applicationMode as $item )
									                	@if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofapplication == $item->id) {{ $item->name }}
									                	@endif
									                @endforeach
									            </label>
											</div>
											<div class="col-md-12">
												<label>Examination Type :
													@foreach( $examinationType as $item )
									                	@if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->examinationtype == $item->id) {{ $item->name }}
									                	@endif
									                @endforeach
									            </label>
											</div>
											<div class="col-md-12">
												<label>Application & Exam Status :
													@foreach( $applicationAndExamStatus as $item )
									                	@if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->applicationandexamstatus == $item->id) {{ $item->name }}
									                	@endif
									                @endforeach
									            </label>
											</div>
											<div class="col-md-12">
												<label>Mode Of Examination :
													@foreach( $examinationMode as $item )
									                	@if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->examinationmode == $item->id) {{ $item->name }}
									                	@endif
									                @endforeach
									            </label>
											</div>
											<div class="col-md-12">
												<label>Eligibility Criteria :
													@foreach( $eligibilityCriterion as $item )
									                	@if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->eligibilitycriteria == $item->id) {{ $item->name }}
									                	@endif
									                @endforeach
									            </label>
											</div>
											<div class="col-md-12">
												<label>Mode of payment :
													@if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 1) Online
					                				@elseif(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 2) Offline
					                				@elseif(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 3) Online & Offline
					                				@else Not Updated yet 
					                				@endif
									            </label>
											</div>
											<div class="col-md-12">
												<label>Description : {!! $examApplicationProcessesObj->description or ''!!}</label>
										    </div>
										</div>
										<div class="row margin-bottom10">
										    <div class="col-md-10">
										        <h3 class="text-uppercase text-success">List of application fees</h3>
										    </div>
										</div>
										<div class="row">
										    <div class="col-md-12">
										        <table class="table table-bordered table-hover">
										            <thead>
										                <tr>
										                    <th>Category</th>
										                    <th>Quota</th>
										                    <th>Mode</th>
										                    <th>Gender</th>
										                    <th>Amount</th>
										                </tr>
										            </thead>
										            <tbody class="tableApplicationFeesSection">
										            	@foreach($examApplicationFeesObj as $item)
									                        <tr>
											                    <td>{{$item->category}}</td>
											                    <td>{{$item->quota}}</td>
											                    <td>
											                    	@if($item->mode == 1) Online
									                				@elseif($item->mode == 2) Offline
									                				@else Not Updated yet 
									                				@endif
											                    </td>
											                    <td>
											                    	@if($item->gender == 1) Male
									                				@elseif($item->gender == 2) Female
									                				@elseif($item->gender == 3) Other
									                				@else Not Updated yet 
									                				@endif
											                    </td>
											                    <td>₹{{number_format($item->amount,2)}}</td>
											                </tr>
									                    @endforeach
										            </tbody>
										        </table>
										    </div>
										</div>
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab3">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
				          				<label>Description of examination eligibilities</label>
	        							<p>{!! isset($examinationDetailsObj) && $examinationDetailsObj->examEligibilityCriteria or '' !!}</p>

        								@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
											    @foreach( $examEligibilitiesObj as $eligibility)                    
											       @if(($eligibility->degreeId == $item->degreeId) && !empty($eligibility->description))
										    		<div class="panel panel-info">
										                <div class="panel-heading">
										                    <i class="fa fa-arrow-right"></i> Description of {{$item->degreeName}} examination eligibilities
										                </div>
										                <div class="panel-body">
										            		{!! $eligibility->description or ''!!}
										                </div>
												    </div>
											        @endif
											    @endforeach
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab4">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
				          				<div class="row">
											<div class="col-md-12">
												<label>Description of exam dates : </label>
												{!! isset($examinationDetailsObj) && $examinationDetailsObj->examDates or ''!!}
										    </div>
										</div>
										<div class="row margin-bottom10">
										    <div class="col-md-10">
										        <h3 class="text-uppercase text-success">List of exam dates</h3>
										    </div>
										</div>
										<div class="row">
										    <div class="col-md-12">
										        <table class="table table-bordered table-hover">
										            <thead>
										                <tr>
										                    <th>Event Date</th>
										                    <th>Event Name</th>
										                    <th>Event Status</th>
										                    <th>Degree Name</th>
										                </tr>
										            </thead>
										            <tbody class="tableApplicationFeesSection">
										            	@foreach($examDatesObj as $item)
									                        <tr>
											                    <td>{{$item->eventDate}}</td>
											                    <td>{{$item->eventName}}</td>
											                    <td>
											                    	@if($item->eventStatus == 1) Ongoing
									                				@elseif($item->eventStatus == 2) Upcoming
									                				@elseif($item->eventStatus == 3) Closed
									                				@else Not Updated yet 
									                				@endif
											                    </td>
											                    <td>
											                    	@foreach( $examDegreeObj as $degree )
					                									@if($item->degreeId == $degree->degreeId) {{ $degree->degreeName }}@endif
					                								@endforeach
					                							</td>
											                </tr>
									                    @endforeach
										            </tbody>
										        </table>
										    </div>
										</div>
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab5">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-primary">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> {{$item->degreeName}} examination syllabus
									                </div>
											        <div class="panel-body">
												        @foreach( $examSyllabusPapersObj as $key)                     
												            @if( $key->degreeId == $item->degreeId )
											                	<div class="row">
											                		<div class="col-md-12">
																		<label>Paper name : {{ $syllabus->paperName or ''}}</label>
																	</div>
																	<div class="col-md-12">
																		<label>Total Mark : {{ $syllabus->totalMark or ''}}</label>
																	</div>
																	<div class="col-md-12">
													            		{!! $syllabus->description or ''!!}
																	</div>
											                	</div>
												            @endif
												        @endforeach
												        <hr>
														<div class="row margin-bottom10">
														    <div class="col-md-9">
														        <h3 class="text-uppercase text-success">List of Exam Syllabus Paper</h3>
														    </div>
														</div>
														<div class="row">
														    <div class="col-md-12">
														        <table class="table table-bordered table-hover">
														            <thead>
														                <tr>
														                    <th>Unit Name</th>
														                    <th>Topic Name</th>
														                    <th>Topic Description</th>
														                </tr>
														            </thead>
														            <tbody class="tableExamSyllabusPaperMarksSection{{$item->degreeId}}">
														            	@foreach($examSyllabusPaperMarksObj as $obj2)
														            		@if( $obj2->degreeId == $item->degreeId )
													                        <tr>
															                    <td> {{$obj2->unitName}}</td>
															                    <td>{{$obj2->topicname}}</td>
															                    <td>{!! $obj2->topicDesc or '' !!}</td>
															                </tr>
															                @endif
													                    @endforeach
														            </tbody>
														        </table>
														    </div>
														</div>
										            </div>
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab6">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-warning">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> {{$item->degreeName}} examination pattern
									                </div>
											        @foreach( $examPatternsObj as $key)                              
											            @if( $key->degreeId == $item->degreeId )
											                <div class="panel-body">
											                	<div class="row">
											                		<div class="col-md-12">
																		<label>Mode of exam : 
														                @foreach( $examinationMode as $item )
														                	@if($key->modeOfExam == $item->id) {{ $item->name }} @endif
														                @endforeach
														                </label>
																	</div>
																	<div class="col-md-12">
																		<label>Total Mark :{{ $key->examDuration or ''}} </label>
																	</div>
											                		<div class="col-md-12">
																		<label>Total Question : {{ $key->totalQuestion or ''}} </label>
																	</div>
																	<div class="col-md-12">
																		<label>Total Mark : {{ $key->totalMarks  or ''}} </label>
																	</div>
											                		<div class="col-md-12">
																		<label>Section name : {{ $key->section or ''}} </label>
																	</div>
																	<div class="col-md-12">
																		<label>Language of paper : {{ $key->languageofpaper or ''}} </label>
																	</div>
																	<div class="col-md-12">
																		<label>Marking Schem : </label>
																		{!! $key->markingSchem or ''!!}
																	</div>
																	<div class="col-md-12">
																		<label>Pattern Description : </label>
																		{!! $key->patternDesc or ''!!}
																	</div>
											                	</div>
											                </div>
											            @endif
											        @endforeach
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab7">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										<div class="row">
											<div class="col-md-12">
												<label>Description of about admit card</label>
												{!! nl2br(isset($examinationDetailsObj) && $examinationDetailsObj->admidCardDesc)!!}
										    </div>
											<div class="col-md-12">
												<label>Admid Card Instructions</label>
										       	{!! nl2br(isset($examinationDetailsObj) && $examinationDetailsObj->admidCardInstructions) !!} 
										    </div>
										</div>
										@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-warning">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> About {{$item->degreeName}} admit card details
									                </div>
											        @foreach( $examAdmitCardsObj as $key)                  
											            @if( $key->degreeId == $item->degreeId )
											                <div class="panel-body">
											                	<div class="row">
																	<div class="col-md-12">
																		<label>Admit card Details : </label>
																		{!! $key->description or '' !!}
																	</div>
											                	</div>
											                	<hr>
											                	<div class="row">
																	<div class="col-md-12">
																		<label>Rebember Points : </label>
																		{!! $key->rebemberPoints or '' !!}
																	</div>
											                	</div>
											                </div>
											            @endif
											        @endforeach
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab8">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										<div class="row">
											<div class="col-md-12">
												<label>Description of about exam results</label>
										        {!! isset($examinationDetailsObj) && $examinationDetailsObj->examResultDesc or '' !!}
										    </div>
										</div>
										@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-warning">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> About {{$item->degreeName}} result details
									                </div>
											        @foreach( $examResultsObj as $key)                                    
											            @if( $key->degreeId == $item->degreeId )
											                <div class="panel-body">
											                	<div class="row">
																	<div class="col-md-12">
																		<label>Result Details :</label>
																		{!! $key->description or '' !!}
																	</div>
											                	</div>
											                </div>
											            @endif
											        @endforeach
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab9">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-warning">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> About {{$item->degreeName}} exam cut offs details
									                </div>
											        @foreach( $examCutOffsObj as $key)                                    
											            @if( $key->degreeId == $item->degreeId )
											                <div class="panel-body">
											                	<div class="row">
																	<div class="col-md-12">
																		<label>Cut offs details :</label>
																		{!! $key->description or '' !!}
																	</div>
											                	</div>
											                </div>
											            @endif
											        @endforeach
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab10">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-warning">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> {{$item->degreeName}} counselling procedure
									                </div>
									        		<div class="panel-body">
												        @foreach( $examCounsellingsObj as $key)                  
												            @if( $key->degreeId == $item->degreeId )
											                	<div class="row">
											                		<div class="col-md-12">
																		<label>Mode of exam :
																			@if($key->modeofcounselling == 1) Online
											                				@elseif($key->modeofcounselling == 2) Offline
											                				@else Not Updated yet 
											                				@endif 
											                			</label>
																	</div>
																	<div class="col-md-12">
																		<label>Website Link : <a href="{{ $key->websiteLink or ''}}" target="_blank" class="btn btn-xs btn-info">Click here</a> </label>
																	</div>
																	<div class="col-md-12">
																		<label>Description</label>
																		{!! $key->description or '' !!}
																	</div>
																	<div class="col-md-12">
																		<label>Counselling Procedure</label>
																		{!! $key->counsellingProcedure or '' !!}
																	</div>
																	<div class="col-md-12">
																		<label>Documents Required</label>
																		{!! $key->documentsRequired or '' !!}
																	</div>
											                	</div>
												            @endif
												        @endforeach
											        	<hr>
														<div class="row margin-bottom10">
														    <div class="col-md-12">
														        <h3 class="text-uppercase text-success">List of Counselling dates</h3>
														    </div>
														</div>
														<div class="row">
														    <div class="col-md-12">
														        <table class="table table-bordered table-hover">
														            <thead>
														                <tr>
														                    <th>Mode of Counselling</th>
														                    <th>Event Name </th>
														                    <th>Event Date</th>
														                </tr>
														            </thead>
														            <tbody class="tableApplicationFeesSection{{$item->degreeId}}">
														            	@foreach($examCounsellingDatesObj as $obj)
														            		@if( $obj->degreeId == $item->degreeId )
														                        <tr>
																                    <td>
																                    	@if($obj->modeofcounselling == 1) Online
														                				@elseif($obj->modeofcounselling == 2) Offline
														                				@else Not Updated yet 
														                				@endif 
																                    </td>
																                    <td>{{$obj->eventName}}</td>
																                    <td>{{$obj->eventDate}}</td>
																                </tr>
																            @endif
													                    @endforeach
														            </tbody>
														        </table>
														    </div>
														</div>
														<hr>
														<div class="row margin-bottom10">
														    <div class="col-md-12">
														        <h3 class="text-uppercase text-success">List of Exam Counselling Contacts</h3>
														    </div>
														</div>
														<div class="row">
														    <div class="col-md-12">
														        <table class="table table-bordered table-hover">
														            <thead>
														                <tr>
														                    <th>Contact Person Name</th>
														                    <th>Contact Number</th>
														                </tr>
														            </thead>
														            <tbody class="tableExamCounsellingContactsSection{{$item->degreeId}}">
														            	@foreach($examCounsellingContactsObj as $obj1)
														            		@if( $obj1->degreeId == $item->degreeId )
													                        <tr>
															                    <td>{{$obj1->contactPersonName}}</td>
															                    <td>{{$obj1->contactNumber}}</td>
															                </tr>
															                @endif
													                    @endforeach
														            </tbody>
														        </table>
														    </div>
														</div>
													</div>
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab11">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										@foreach($examDegreeObj as $item)
										{{--*/ $flag2 = '0' /*--}}
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-warning">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> {{$item->degreeName}} examination prepration details
									                </div>
											        @foreach( $examPreprationTipsObj as $key)     
											            @if( $key->degreeId == $item->degreeId )
											                <div class="panel-body">
											                	<div class="row">
																	<div class="col-md-12">
																		<label>Description : </label>
																		{!! $key->description or '' !!}
																	</div>
																	<div class="col-md-12">
																		<label>Books Name</label>
																		{!! $key->booksName or '' !!}
																	</div>
																	<div class="col-md-12">
																		<label>Pattern Desc</label>
																		{!! $key->patternDesc or '' !!}
																	</div>
											                	</div>
											                </div>
											            @endif
											        @endforeach
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab12">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-warning">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> {{$item->degreeName}} Answer Keys
									                </div>
											        <div class="panel-body">
												        @foreach( $examAnswerKeysObj as $key)                     
												            @if( $key->degreeId == $item->degreeId )
										            		<div class="row">
										            			<div class="col-md-12">
										            				<label>Paper names : </label>
										            				{!! $key->papername or '' !!}
										            			</div>
										            			<div class="col-md-12">
										            				<label>Description</label>
										            				{!! $key->description or '' !!}
										            			</div>
										            			<div class="col-md-12">
										            				<label>Important Description</label>
										            				{!! $key->importantDesc or ''!!}
										            			</div>
										            		</div>
												            @endif
												        @endforeach
												        <hr>
														<div class="row margin-bottom10">
														    <div class="col-md-9">
														        <h3 class="text-uppercase text-success">List of Exam Answer Key</h3>
														    </div>
														</div>
														<div class="row">
														    <div class="col-md-12">
														        <table class="table table-bordered table-hover">
														            <thead>
														                <tr>
														                    <th>Paper Name</th>
														                    <th>Dates</th>
														                    <th>Files</th>
														                    <th>Links</th>
														                </tr>
														            </thead>
														            <tbody class="tableExamAnswerKeySection{{$item->degreeId}}">
														            	@foreach($examAnswerKeyEventsObj as $obj2)
														            		@if( $obj2->degreeId == $item->degreeId )
													                        <tr>
															                    <td>{{$obj2->paperName}}</td>
															                    <td>{{$obj2->dates}}</td>
															                    <td width="15%">
															                        @if(!empty($obj2->files))
																                    	{{--*/  $answerFile = $obj2->files;  /*--}}
													                                    {{--*/  $answerext1=pathinfo($answerFile,PATHINFO_EXTENSION); /*--}}
																                        
															                            @if($answerext1 == 'pdf' )
															                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/pdf.png" alt="pdf icon" style="width: 80px; height: 80px;"></a>
															                            @elseif($answerext1 == 'doc' )
															                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/doc.png" alt="doc icon" style="width: 80px; height: 80px;"></a>
															                            @elseif($answerext1 == 'docx' )
															                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/docx.png" alt="docx icon" style="width: 80px; height: 80px;"></a>
															                            @elseif($answerext1 == 'ppt' )
															                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/ppt.png" alt="ppt icon" style="width: 80px; height: 80px;"></a>
															                            @elseif($answerext1 == 'pptx' )
															                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/pptx.png" alt="pptx icon" style="width: 80px; height: 80px;"></a>
															                            @else
															                            @endif
																                    @endif
															                    </td>
															                    <td><a href="{{$obj2->links}}" target="_blank" class="btn btn-xs btn-info">Click Here</a></td>
															                </tr>
															                @endif
													                    @endforeach
														            </tbody>
														        </table>
														    </div>
														</div>
										            </div>
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab13">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										<div class="row">
											<div class="col-md-12">
												<label>Description of exam analysis</label>
										        {!! isset($examinationDetailsObj) && $examinationDetailsObj->examAnalysisDesc or '' !!}
										    </div>
										</div>
										@foreach($examDegreeObj as $item)
									    <div class="row">
									    	<div class="col-lg-12">
									    		<div class="panel panel-warning">
									                <div class="panel-heading">
									                    <i class="fa fa-edit"></i> About {{$item->degreeName}} exam analysis details
									                </div>
											        @foreach( $examAnalysisRecordsObj as $key)             
											            @if( $key->degreeId == $item->degreeId )
											                <div class="panel-body">
											                	<div class="row">
																	<div class="col-md-12">
																		<label>Paper name</label>
																		{!! $key->papername or '' !!} 
																	</div>
																	<div class="col-md-12">
																		<label>Description</label>
																		{!! $key->description or '' !!}
																	</div>
											                		<div class="col-md-12">
											                        	<label>Upload File : </label>
											                    		@if(!empty($key->files))
													                    	{{--*/  $analysisFileName = $key->files;  /*--}}
										                                    {{--*/  $analysisFileExt=pathinfo($analysisFileName,PATHINFO_EXTENSION); /*--}}
												                            @if($analysisFileExt == 'pdf' )
												                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/pdf.png" alt="pdf icon" style="width: 80px; height: 80px;"></a>
												                            @elseif($analysisFileExt == 'doc' )
												                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/doc.png" alt="doc icon" style="width: 80px; height: 80px;"></a>
												                            @elseif($analysisFileExt == 'docx' )
												                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/docx.png" alt="docx icon" style="width: 80px; height: 80px;"></a>
												                            @elseif($analysisFileExt == 'ppt' )
												                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/ppt.png" alt="ppt icon" style="width: 80px; height: 80px;"></a>
												                            @elseif($analysisFileExt == 'pptx' )
												                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/pptx.png" alt="pptx icon" style="width: 80px; height: 80px;"></a>
												                            @else
												                            @endif
												                    	@endif
											                        </div>
														        </div>
											                </div>
											            @endif
											        @endforeach
											    </div>
									        </div>
									    </div>
									    @endforeach
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab14">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										<div class="row margin-bottom10">
										    <div class="col-md-12">
										        <h3 class="text-uppercase text-success">List of important reference links</h3>
										    </div>
										</div>
										<div class="row">
										    <div class="col-md-12">
										        <table class="table table-bordered table-hover">
										            <thead>
										                <tr>
										                    <th>Title</th>
										                    <th>Url</th>
										                </tr>
										            </thead>
										            <tbody class="tableReferenceLinkSection">
										            	@foreach($examinationImportantLinksObj as $item)
									                        <tr>
											                    <td>{{$item->title}}</td>
											                    <td>
											                       <a href="{{$item->url}}" target="_blank" class="btn btn-xs btn-info ">Click here</a>
											                    </td>
											                </tr>
									                    @endforeach
										            </tbody>
										        </table>
										    </div>
										</div>
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<div role="tabpanel" class="tab-pane padding-top20" id="tab15">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
								        <div class="row margin-bottom10">
								            <div class="col-md-12">
								                <h3 class="text-uppercase text-success">List of all exam faq details</h3>
								            </div>
								        </div>
								        <div class="row">
								            <div class="col-md-12">
										        <div class="examFaqSection">
										        	@foreach($examFaqsObj as $faqkey => $faqitem)
							                        <div class="panel-group" id="accordion">
							                            <div class="panel panel-default">
							                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faqkey}}" class="" aria-expanded="true">
							                                    <h4 class="panel-title">
							                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faqkey}}" class="" aria-expanded="true">Question : {{$faqitem->question}}</a>
							                                    </h4>
							                                </div>
							                                <div id="collapse{{$faqkey}}" class="panel-collapse collapse in" aria-expanded="true" style="">
							                                    <div class="panel-body">
							                                        <h4 class="fontsize-20">Answer :</h4>
							                                        {!! $faqitem->answer or '' !!}
							                                        <br>
							                                        <label class="">Reference Link <a href="{{$faqitem->refLinks}}" class="btn btn-xs btn-info">Click here</a></label>
							                                    </div>
							                                </div>
							                            </div>
							                        </div>
										            @endforeach
										        </div>
										    </div>
										</div>
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div>
			          	<!-- <div role="tabpanel" class="tab-pane padding-top20" id="tab16">
			          		<div class="row">
				          		<div class="col-md-9">
				          			<div class="overviewLeft">
										@foreach($examQuestionsObj as $key => $item)
										<div class="clientContactDetails">
							                <h4 class="padding-bottom10">Question : {!! $item->question !!}</h4>
							                <span class="">Date : {{ date('d F Y h:s a', strtotime($item->questionDate)) }}</span>
							                @foreach($item->examQuestionAnswersObj as $key1 => $item1)
							                <div class="clientContactDetails margin-bottom10 margin-top10">
								                <div class="row">
								                    <div class="col-md-12">
								                        <label class="">Answer : {!! $item1->answer !!}</label>
								                        <label>Date : {{ date('d F Y h:s a', strtotime($item1->answerDate)) }}</label>
								                        @foreach($item1->examQuestionAnswerCommentsObj as $key2 => $item2)
										                <div class="clientContactDetails margin-bottom10 margin-top10">
											                <div class="row">
											                    <div class="col-md-12">
											                        <label class="">Comments : {!! $item2->replyanswer !!}</label>
											                        <label>Date : {{ date('d F Y h:s a', strtotime($item2->answerDate)) }}</label>
											                    </div>
											                </div>
										                </div>
										                @endforeach
								                    </div>
								                </div>
								                <form class="margin-top20" method="post" action="/add/exam-question-answer-comment/{{$examId}}/{{$item->id}}/{{$item1->id}}" data-parsley-validate="">
		                                            <div class="row">
		                                                <div class="col-md-12">
		                                                    <label>Add Comments  </label>
		                                                    <textarea class="form-control replyanswer" id="replyanswer" placeholder="Enter description." name="replyanswer" data-parsley-trigger="change" data-parsley-error-message="Please enter answer" required=""></textarea>
		                                                </div>
		                                            </div>
		                                            <div class="row">
			                                            <div class="col-sm-12 text-center">
			                                                <div class="form-group margin-top20">
			                                                    <button type="submit" class="btn btn-info fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Comment</button>
			                                                </div>
			                                            </div>
		                                            </div>
		                                        </form>
							                </div>
							                @endforeach
							                <form class="margin-top20" method="post" action="/add/exam-question-answer/{{$examId}}/{{$item->id}}" data-parsley-validate="">
							                    <div class="row">
							                        <div class="col-md-12">
							                            <label>Add New Answer  </label>
							                            <textarea class="form-control summernote answer" id="answer"  placeholder="Enter description." name="answer" data-parsley-trigger="change" data-parsley-error-message="Please enter answer" required=""></textarea>
							                        </div>
							                    </div>
							                    <div class="row">
								                    <div class="col-sm-12 text-center">
								                        <div class="form-group margin-top20">
								                            <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Answer</button>
								                        </div>
								                    </div>
								                </div>
							                </form>
							            </div>
							            <hr class="hr-line-dashed">
										@endforeach
										<div class="clientContactDetails margin-top20 margin-bottom20">
					          				<form class="margin-top20" method="post" action="/add/exam-question/{{$examId}}" data-parsley-validate="">
											    <div class="row">
											        <div class="col-md-12">
											            <label>Have a question related to {{$typeOfExaminationObj->sortname}} - {{$typeOfExaminationObj->name}} ?  </label>
											            <textarea class="form-control question summernote" id="question" placeholder="Enter question." name="question" minlength="50" minlength="250" data-parsley-trigger="change" data-parsley-error-message="Please enter question between 50 to 250 character" required=""></textarea>
											        </div>
											    </div>
											    <div class="row">
												    <div class="col-sm-12 text-center">
												        <div class="form-group margin-top20">
												            <button type="submit" class="btn btn-success fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Ask Question</button>
												        </div>
												    </div>
												</div>
											</form>
										</div>
				          			</div>
				          		</div>
				          		<div class="col-md-3">
					      			@include('website.home.examination.examination-detail-getmoreinfo-link')
					      		</div>
			        		</div>
			          	</div> -->
			        </div>
			    </div>
      		</div>
		</div>
	</div>
</div>

<!-- end govt exam detail page -->
@endsection

@section('scripts')
{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
  $('form').parsley();
</script>
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.examination-search-partial')
<script type="text/javascript">
	$(function(){
	  var hash = window.location.hash;
	  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

	  $('.nav-tabs a').click(function (e) {
	    $(this).tab('show');
	    var scrollmem = $('body').scrollTop();
	    window.location.hash = this.hash;
	    $('html,body').scrollTop(scrollmem);
	  });
	});

</script>	
<script type="text/javascript">
	var hidWidth;
	var scrollBarWidths = 40;

	var widthOfList = function(){
		var itemsWidth = 0;
		$('.list li').each(function(){
			var itemWidth = $(this).outerWidth();
			itemsWidth+=itemWidth;
		});
		return itemsWidth;
	};

	var widthOfHidden = function(){
	  	return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
	};

	var getLeftPosi = function(){
	  	return $('.list').position().left;
	};

	var reAdjust = function(){
	  	if (($('.wrapper').outerWidth()) < widthOfList()) {
	    	$('.scroller-right').show();
	  	}else {
	    	$('.scroller-right').hide();
	  	}
	  
		if (getLeftPosi()<0) {
			$('.scroller-left').show();
		}else {
			$('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
				$('.scroller-left').hide();
		}
	}

	reAdjust();

	$(window).on('resize',function(e){  
		reAdjust();
	});

	$('.scroller-right').click(function() {
		$('.scroller-left').fadeIn('slow');
		$('.scroller-right').fadeOut('slow');
		$('.list').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){

		});
	});

	$('.scroller-left').click(function() {
		$('.scroller-right').fadeIn('slow');
		$('.scroller-left').fadeOut('slow');
		$('.list').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){

		});
	});    
</script>
@endsection



