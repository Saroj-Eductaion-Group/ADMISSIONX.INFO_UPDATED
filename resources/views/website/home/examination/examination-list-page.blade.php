@extends('website/new-design-layouts.master')
@section('styles')

@include('website.home.search-pages.search-field-partials.exam-search-style-partial')
@endsection
@section('content')
<!-- college in india top start -->
<div class="govtexamListTop">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="searchindiaTop">
					<!-- <h2>BE/B.TECH EXAMS 2020-2021, DATES, APPLICATION FORM & ALERTS</h2> -->
					@include('website.home.search-pages.search-field-partials.exam-search-partial')
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
						<form method="GET" action="/examination-list/{{$stream}}" class="filterCollegeFormBlock">
							<div class="panel-body" >
								<div class="searchselectmn">
									<div class="panel-heading searchindiaselect">
										<h4 class="panel-title searchindiatitle">
											<a data-toggle="collapse" href="#collapse0">
												<i class="indicator fa fa-caret-down" aria-hidden="true"></i>Examination Type
											</a>
										</h4>
									</div>
									<div id="collapse0" class="panel-collapse collapse in selectCollapse" >
										<ul class="list-group">
											@foreach( $examinationType as $item )
												{{--*/ $flag1 = 0 /*--}}
												@if( !empty(Request::get('examinationtype')) )
													@foreach(Request::get('examinationtype') as $data)
														@if( $data == $item->id )
															<li class="list-group-item selectlistGroup">
																<div class="chiller_cb">
															    	<input id="examinationtype{{$item->id}}" type="checkbox" checked="" name="examinationtype[]" value="{{$item->id}}" class="checkbox">
															    	<label for="examinationtype{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
															    	<span></span>
						  										</div>
															</li>
															{{--*/ $flag1 = 1 /*--}}
														@endif
	                    							@endforeach
	                							@endif
	                							@if( $flag1 == '0' )
	                								<li class="list-group-item selectlistGroup">
														<div class="chiller_cb">
													    	<input id="examinationtype{{$item->id}}" type="checkbox" name="examinationtype[]" value="{{$item->id}}" class="checkbox">
													    	<label for="examinationtype{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
													    	<span></span>
				  										</div>
													</li>
	            								@endif
							                @endforeach
										</ul>
									</div>
								</div>
								<div class="searchselectmn">
									<div class="panel-heading searchindiaselect">
										<h4 class="panel-title searchindiatitle">
											<a data-toggle="collapse" href="#collapse1">
												<i class="indicator fa fa-caret-down" aria-hidden="true"></i> Application & Exam Status
											</a>
										</h4>
									</div>
									<div id="collapse1" class="panel-collapse collapse in selectCollapse" >
										<ul class="list-group">
											@foreach( $applicationAndExamStatus as $item )
												{{--*/ $flag2 = 0 /*--}}
												@if( !empty(Request::get('applicationandexamstatus')) )
													@foreach(Request::get('applicationandexamstatus') as $data)
														@if( $data == $item->id )
															<li class="list-group-item selectlistGroup">
																<div class="chiller_cb">
															    	<input id="applicationandexamstatus{{$item->id}}" type="checkbox" checked="" name="applicationandexamstatus[]" value="{{$item->id}}" class="checkbox">
															    	<label for="applicationandexamstatus{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
															    	<span></span>
						  										</div>
															</li>
															{{--*/ $flag2 = 1 /*--}}
														@endif
	                    							@endforeach
	                							@endif
	                							@if( $flag2 == '0' )
	                								<li class="list-group-item selectlistGroup">
														<div class="chiller_cb">
													    	<input id="applicationandexamstatus{{$item->id}}" type="checkbox" name="applicationandexamstatus[]" value="{{$item->id}}" class="checkbox">
													    	<label for="applicationandexamstatus{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
													    	<span></span>
				  										</div>
													</li>
	            								@endif
							                @endforeach
										</ul>
									</div>
								</div>
								<div class="searchselectmn">
									<div class="panel-heading searchindiaselect">
										<h4 class="panel-title searchindiatitle">
											<a data-toggle="collapse" href="#collapse3"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Application Mode</a>
										</h4>
									</div>
									<div id="collapse3" class="panel-collapse collapse in selectCollapse">
										<ul class="list-group">
											@foreach( $applicationMode as $item )
												{{--*/ $flag3 = 0 /*--}}
												@if( !empty(Request::get('applicationmode')) )
													@foreach(Request::get('applicationmode') as $data)
														@if( $data == $item->id )
															<li class="list-group-item selectlistGroup">
																<div class="chiller_cb">
															    	<input id="applicationmode{{$item->id}}" type="checkbox" checked="" name="applicationmode[]" value="{{$item->id}}" class="checkbox">
															    	<label for="applicationmode{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
															    	<span></span>
						  										</div>
															</li>
															{{--*/ $flag3 = 1 /*--}}
														@endif
	                    							@endforeach
	                							@endif
	                							@if( $flag3 == '0' )
	                								<li class="list-group-item selectlistGroup">
														<div class="chiller_cb">
													    	<input id="applicationmode{{$item->id}}" type="checkbox" name="applicationmode[]" value="{{$item->id}}" class="checkbox">
													    	<label for="applicationmode{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
													    	<span></span>
				  										</div>
													</li>
	            								@endif
							                @endforeach
										</ul>
									</div>
								</div>
								<div class="searchselectmn">
									<div class="panel-heading searchindiaselect searchindiaselect">
										<h4 class="panel-title searchindiatitle">
											<a data-toggle="collapse" href="#collapse4"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Examination Mode</a>
										</h4>
									</div>
									<div id="collapse4" class="panel-collapse collapse in selectCollapse">
										<ul class="list-group">
											@foreach( $examinationMode as $item )
												{{--*/ $flag4 = 0 /*--}}
												@if( !empty(Request::get('examinationmode')) )
													@foreach(Request::get('examinationmode') as $data)
														@if( $data == $item->id )
															<li class="list-group-item selectlistGroup">
																<div class="chiller_cb">
															    	<input id="examinationmode{{$item->id}}" type="checkbox" checked="" name="examinationmode[]" value="{{$item->id}}" class="checkbox">
															    	<label for="examinationmode{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
															    	<span></span>
						  										</div>
															</li>
															{{--*/ $flag4 = 1 /*--}}
														@endif
	                    							@endforeach
	                							@endif
	                							@if( $flag4 == '0' )
	                								<li class="list-group-item selectlistGroup">
														<div class="chiller_cb">
													    	<input id="examinationmode{{$item->id}}" type="checkbox" name="examinationmode[]" value="{{$item->id}}" class="checkbox">
													    	<label for="examinationmode{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
													    	<span></span>
				  										</div>
													</li>
	            								@endif
							                @endforeach
										</ul>
									</div>
								</div>
								<div class="searchselectmn">	
									<div class="panel-heading searchindiaselect searchindiaselect">
										<h4 class="panel-title searchindiatitle">
											<a data-toggle="collapse" href="#collapse6"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Eligibility Criteria</a>
										</h4>
									</div>
									<div id="collapse6" class="panel-collapse collapse in selectCollapse">
										<ul class="list-group">
											@foreach( $eligibilityCriterion as $item )
												{{--*/ $flag5 = 0 /*--}}
												@if( !empty(Request::get('eligibilitycriteria')) )
													@foreach(Request::get('eligibilitycriteria') as $data)
														@if( $data == $item->id )
															<li class="list-group-item selectlistGroup">
																<div class="chiller_cb">
															    	<input id="eligibilitycriteria{{$item->id}}" type="checkbox" checked="" name="eligibilitycriteria[]" value="{{$item->id}}" class="checkbox">
															    	<label for="eligibilitycriteria{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
															    	<span></span>
						  										</div>
															</li>
															{{--*/ $flag5 = 1 /*--}}
														@endif
	                    							@endforeach
	                							@endif
	                							@if( $flag5 == '0' )
	                								<li class="list-group-item selectlistGroup">
														<div class="chiller_cb">
													    	<input id="eligibilitycriteria{{$item->id}}" type="checkbox" name="eligibilitycriteria[]" value="{{$item->id}}" class="checkbox">
													    	<label for="eligibilitycriteria{{$item->id}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->name))}}</label>
													    	<span></span>
				  										</div>
													</li>
	            								@endif
							                @endforeach
										</ul>
									</div>
								</div>
								@if(isset($degreeSlug) && (empty($degreeSlug)))
								<div class="searchselectmn">	
									<div class="panel-heading searchindiaselect searchindiaselect">
										<h4 class="panel-title searchindiatitle">
											<a data-toggle="collapse" href="#collapse7"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Type of Course</a>
										</h4>
									</div>
									<div id="collapse7" class="panel-collapse collapse in selectCollapse">
										<ul class="list-group">
											@foreach( $examDegreeObj as $item )
												{{--*/ $flag6 = 0 /*--}}
												@if( !empty(Request::get('typeofcourse')) )
													@foreach(Request::get('typeofcourse') as $data)
														@if( $data == $item->degreeId )
															<li class="list-group-item selectlistGroup">
																<div class="chiller_cb">
															    	<input id="typeofcourse{{$item->degreeId}}" type="checkbox" checked="" name="typeofcourse[]" value="{{$item->degreeId}}" class="checkbox">
															    	<label for="typeofcourse{{$item->degreeId}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->degreeName))}}</label>
															    	<span></span>
						  										</div>
															</li>
															{{--*/ $flag6 = 1 /*--}}
														@endif
	                    							@endforeach
	                							@endif
	                							@if( $flag6 == '0' )
	                								<li class="list-group-item selectlistGroup">
														<div class="chiller_cb">
													    	<input id="typeofcourse{{$item->degreeId}}" type="checkbox" name="typeofcourse[]" value="{{$item->degreeId}}" class="checkbox">
													    	<label for="typeofcourse{{$item->degreeId}}" class="selectmyCheckbox">{{ ucfirst(strtolower($item->degreeName))}}</label>
													    	<span></span>
				  										</div>
													</li>
	            								@endif
							                @endforeach
										</ul>
									</div>
								</div>
								@endif
							</div>
						</form>
					</div>
				</div>
				<div class="searchindiaBotNotifi">
					<div class="notificationTop">
						<h2>Notifications</h2>
					</div>
					@foreach( $examNotificationList as $item )
						<div class="notificationBot padding-top20">
							<div class="row">
		          				<div class="col-md-2 margin-left15" style="cursor: pointer;">
		          					<div class="detailCoursebotIcon">
		          						<div style="cursor:pointer;">
			          						@if(!empty($item->universitylogo))
			          						<a style="cursor:pointer;"  target="_blank" href="{{ URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug) }}">
			          							<img class="" width="40" src="/examinationlogo/{{ $item->universitylogo }}" width="120" alt="{{ $item->universitylogo }}">
			          						</a>
			          						@else
				          					<a style="cursor:pointer;" target="_blank" href="{{ URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug) }}">
				          						<i class="fa fa-university"></i>
				          					</a>
				          					@endif
		          						</div>
		          					</div>
		          				</div>
		          				<div class="col-md-8">
		          					<div class="detailCoursebotContent">
		          						<a target="_blank" href="{{ URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug) }}">
		          							<h2 style="font-size: 15px !important;">{{ $item->sortname }}</h2>
		          						</a>		
		          					</div>
		          				</div>
		          			</div>
							<h2 style="margin-top:0px; font-size: 12px !important;">{{$item->name}}</h2>
							<p style="font-size: 11px !important;">{{$item->universityName}}</p>
							<p style="font-size: 11px !important;">{{$item->title}} 
								<div class="pull-right">
								<a style="font-size:12px;" target="_blank" href="{{ URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug) }}">Read More.. </a>
								</div>
							</p>
							<hr style="margin-bottom:0px;">
						</div>
					@endforeach
					
				</div>	
			</div>
			<div class="col-md-9"> 
			     <div class="card padding-bottom30">
			        <ul class="nav nav-tabs govtexamDetailNav">
			        	<div class="viewLessCategoryBlock">
			        	@foreach( $examDegreeObj as $key1 => $item1)
			        		<a class="btn-sm btn btn-warning margin-bottom5" target="_blank" href="{{ URL::to('/examination-list/'.$item1->streamSlug.'/'.$item1->degreeSlug) }}"> {{ $item1->degreeName }} ({{$item1->examCount}})</a>
		        			@if($key1 == 6)
	 							{{--*/ break; /*--}}
	  						@endif	
			          	@endforeach
				        	<a href="javascript:void(0);" class="btn-sm btn btn-info margin-bottom5 viewMoreCategoryBtn" role="button">View all Degree</a>
			        	</div>

			        	<div class="viewAllCategoryBlock hide">
			          	@foreach( $examDegreeObj as $key1 => $item1)
							<a class="btn-sm btn btn-warning margin-bottom5" target="_blank" href="{{ URL::to('/examination-list/'.$item1->streamSlug.'/'.$item1->degreeSlug) }}"> {{ $item1->degreeName }} ({{$item1->examCount}})</a>
			          	@endforeach
				        	<a  href="javascript:void(0);" class="btn-sm btn btn-info margin-bottom5 hide viewLessCategoryBtn" role="button">View Less</a>
			        	</div>
			        </ul>
			     	<div class="row">
			        	<div class="col-md-12 padding-top10">
			        		@foreach( $getFilterOutDataObj as $searchkey => $searchKeyObj)
			        			@include('website.home.examination.exam-filter-page-content-partial')
				       			@if($searchkey == 2)
		 							{{--*/ break; /*--}}
		  						@endif		
			        		@endforeach
			        		<div class="detailCoursemain padding-bottom20">
			          			<div class="detailCoursetop">
			          				<h2>LATEST APPLICATION FORMS 2020</h2>
			          			</div>
			          			<div class="detailCoursebot">
			          				@foreach( $latestExaminationList as $latest => $latestObj)
				          				<div class="row padding-top10">
					          				<div class="col-md-1">
					          					<div class="detailCoursebotIcon" style="cursor: pointer;">
						          					@if(!empty($latestObj->universitylogo))
						          						<a target="_blank" href="{{ URL::to('/examination-details/'.$latestObj->streamSlug.'/'.$latestObj->slug) }}">
					          							<img class="" width="60" src="/examinationlogo/{{ $latestObj->universitylogo }}" width="120" alt="{{ $latestObj->universitylogo }}"></a>
					          						@else
							          					<a target="_blank" href="{{ URL::to('/examination-details/'.$latestObj->streamSlug.'/'.$latestObj->slug) }}">
							          						<i class="fa fa-university"></i>
							          					</a>
						          					@endif
					          					</div>
					          				</div>
					          				<div class="col-md-9">
					          					<div class="detailCoursebotContent">
					          						<a target="_blank" href="{{ URL::to('/examination-details/'.$latestObj->streamSlug.'/'.$latestObj->slug) }}">
					          							<h2 style="font-size: 15px;">{{ $latestObj->sortname }} - {{$latestObj->name}}</h2>
					          							<p style="font-size: 12px;">{{$latestObj->universityName}}</p>
														<p style="font-size: 12px;">{{$latestObj->title}}</p>
					          						</a>		
					          					</div>
					          				</div>
					          				<div class="col-md-2">
					          					<div class="detailApplyNow">
					          						<a target="_blank" href="{{ URL::to('/examination-details/'.$latestObj->streamSlug.'/'.$latestObj->slug) }}">apply now</a>
					          					</div>
					          				</div>
				          				</div>
				          				<hr>
						          	@endforeach
			          			</div>		
			          		</div>
			          		<div class="margin-top20">
			        		@foreach( $getFilterOutDataObj as $searchkey => $searchKeyObj)
				       			@if($searchkey > 2)
			        				@include('website.home.examination.exam-filter-page-content-partial')
		  						@endif		
			        		@endforeach
			        		</div>
							<div class="row padding-top20 padding-bottom20">
			                  	<div class="col-xs-12">
									<div class="input_right_text text-center">
										<ul class="pagination">
											<li class="search_text">Search results</li>
											<li><a href="{{$getFilterOutDataObj->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
											<li class="active"><a href="javascript:void(0);">{{ $getFilterOutDataObj->lastItem() }}</a></li>
											<li class="search_text" style="width: auto;">of {{ $getFilterOutDataObj->total() }}</li>
											<li><a href="{{$getFilterOutDataObj->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
										</ul>
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
<!-- end college in india bot -->
@endsection

@section('scripts')
	{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
	@include('website.home.search-pages.autocomplete-script-partial.examination-search-partial')
	<script type="text/javascript">
		function toggleChevron(e) {
			$(e.target)
			.prev('.panel-heading')
			.find("i.indicator")
			.toggleClass('fa-caret-down fa-caret-right');
		}
		$('#accordion').on('hidden.bs.collapse', toggleChevron);
		$('#accordion').on('shown.bs.collapse', toggleChevron);
	</script>

	<script type="text/javascript">
		$(function() {
	        $('.checkbox').change(function() {
	            this.form.submit();
	        });
		});

		function showHideSection(firstHide, secondShow, thirdShow, fourthShow){
		    $('.'+firstHide).addClass('hide');
		    $('.'+secondShow).removeClass('hide');
		    $('.'+thirdShow).addClass('hide');
		    $('.'+fourthShow).removeClass('hide');
		}
	</script>

	<script type="text/javascript">
	  	$(document).on('click','.viewMoreCategoryBtn', function(){
			$('.viewLessCategoryBlock').addClass('hide');
			$('.viewAllCategoryBlock').removeClass('hide');
			$('.viewLessCategoryBtn').removeClass('hide');
			$('.viewMoreCategoryBtn').addClass('hide');
	    });

	    $(document).on('click','.viewLessCategoryBtn', function(){
	    	$('.viewLessCategoryBlock').removeClass('hide');
			$('.viewAllCategoryBlock').addClass('hide');
			$('.viewLessCategoryBtn').addClass('hide');
			$('.viewMoreCategoryBtn').removeClass('hide');
	    });
	</script>

@endsection



