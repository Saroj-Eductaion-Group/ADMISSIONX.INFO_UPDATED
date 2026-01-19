@extends('website/new-design-layouts.master')

{{--*/ $bannerImg1 = $bannerImg2 = $bannerImg3 = $bannerImg4 = ''  /*--}}
{{--*/ $redirectTo1 = $redirectTo2 = $redirectTo3 = $redirectTo4 = ''  /*--}}
@foreach($getCollegeSeachBannerAds as $key => $obj)
@if($key == 0)
{{--*/ $bannerImg1 = $obj->img  /*--}}
{{--*/ $redirectTo1 = $obj->redirectto  /*--}}
@elseif($key == 1)
{{--*/ $bannerImg2 = $obj->img  /*--}}
{{--*/ $redirectTo2 = $obj->redirectto  /*--}}
@elseif($key == 2)
{{--*/ $bannerImg3 = $obj->img  /*--}}
{{--*/ $redirectTo3 = $obj->redirectto  /*--}}
@elseif($key == 3)
{{--*/ $bannerImg4 = $obj->img  /*--}}
{{--*/ $redirectTo4 = $obj->redirectto  /*--}}
@endif
@endforeach


@section('styles')
<!-- CSS Page Style -->
{!! Html::style('home-layout/assets/css/filter-style.css') !!}
{!! Html::style('home-layout/assets/plugins/noUiSlider/jquery.nouislider.min.css') !!}
{!! Html::style('home-layout/assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css') !!}
{!! Html::style('assets/css/chosen/chosen.css') !!}

{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
<style type="text/css">
	/* text-based popup styling */
	.white-popup {
	  position: relative;
	  background: #FFF;
	  padding: 25px;
	  width: auto;
	  max-width: 800px;
	  margin: 0 auto;
	}

	/*

	====== Zoom effect ======

	*/
	.mfp-zoom-in {
	  /* start state */
	  /* animate in */
	  /* animate out */
	}
	.mfp-zoom-in .mfp-with-anim {
	  opacity: 0;
	  transition: all 0.2s ease-in-out;
	  transform: scale(0.8);
	}
	.mfp-zoom-in.mfp-bg {
	  opacity: 0;
	  transition: all 0.3s ease-out;
	}
	.mfp-zoom-in.mfp-ready .mfp-with-anim {
	  opacity: 1;
	  transform: scale(1);
	}
	.mfp-zoom-in.mfp-ready.mfp-bg {
	  opacity: 0.8;
	}
	.mfp-zoom-in.mfp-removing .mfp-with-anim {
	  transform: scale(0.8);
	  opacity: 0;
	}
	.mfp-zoom-in.mfp-removing.mfp-bg {
	  opacity: 0;
	}

	.mfp-close{
		width: 25px !important;
	    height: 25px !important;
	    line-height: 25px !important;
	}
	.mfp-close-btn-in .mfp-close {
	    color: #ffffff !important;
	    background: #000000 !important;
    }
    .wrapper{background-color: #f7f7f7 !important;}
    .newfilterCss{height: 70px;background-color: #e4e4e4;position: relative;z-index: 9;width: 100%;box-shadow: 0 2px 2px -2px #d4d4d4;border-bottom: 2px solid #e1e1e1;}
    .setPosition{position: fixed; top: 70px;}

    @media only screen and (max-width: 992px){
    	.reverse{display: flex; flex-direction: column-reverse;}
	}
</style>
@endsection


@section('content')
<div class="wrapper">

	<!-- <div class="newfilterCss">
		<div class="container">
			<form method="GET" action="/explore/college" class="filterCollegeFormBlock">
				<div class="row">
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<select name="country_id[]" id="countryID" class="form-control chosen-select textColorSelect" multiple="" data-placeholder="Choose a country...">
								@if( $getCountryObj )
									@foreach( $getCountryObj as $item )
										{{--*/ $flag = 0 /*--}}
										@if( !empty(Request::get('country_id')) )
											@foreach(Request::get('country_id') as $data)
												@if( $data == $item->id )
													<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
													{{--*/ $flag = 1 /*--}}
												@endif
	            							@endforeach
	        							@endif
	        							@if( $flag == '0' )
	        								<option value="{{ $item->id }}">{{ $item->name }}</option>
	    								@endif
	        						@endforeach
	        					@endif
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<select name="state_id[]" id="stateID" class="form-control textColorSelect chosen-select" multiple="" data-placeholder="Choose a State...">
									@if( sizeof($getAllSelectedStates) > 0 )
										@foreach( $getAllSelectedStates as $item )
											{{--*/ $flag = 0 /*--}}
											@if( !empty(Request::get('state_id')) )
												@foreach(Request::get('state_id') as $data)
													@if( $data == $item->id )
														<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
														{{--*/ $flag = 1 /*--}}
													@endif
		            							@endforeach
		        							@endif
											@if( $flag == '0' )
		        								<option value="{{ $item->id }}">{{ $item->name }}</option>
		    								@endif
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<select name="city_id[]" id="cityID" class="form-control textColorSelect chosen-select" multiple="" data-placeholder="Choose a City...">
									@if( sizeof($getAllSelectedCities) > 0 )
										@foreach( $getAllSelectedCities as $item )
											{{--*/ $flag = 0 /*--}}
											@if( !empty(Request::get('city_id')) )
												@foreach(Request::get('city_id') as $data)
													@if( $data == $item->id )
														<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
														{{--*/ $flag = 1 /*--}}
													@endif
			        							@endforeach
			    							@endif
											@if( $flag == '0' )
			    								<option value="{{ $item->id }}">{{ $item->name }}</option>
											@endif
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div> -->


	<div class="content container">
		<form method="GET" action="/explore/college" class="filterCollegeFormBlock">
			<div class="row reverse">
 				<div class="col-md-3 filter-by-block md-margin-bottom-60">
 					<h1>Filter By</h1>
 					<div class="panel-group" id="accordion-v8">
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<h2 class="panel-title">
 									<a data-toggle="collapse" data-parent="#accordion-v8" href="#collapseEight">
 										Country
 										<i class="fa fa-angle-down"></i>
 									</a>
 								</h2>
 							</div>
 							<div id="collapseEight" class="panel-collapse collapse in">
 								<div class="panel-body">
 									<select name="country_id[]" id="countryID" class="form-control chosen-select textColorSelect" multiple="" data-placeholder="Choose a country...">
										@if( $getCountryObj )
											@foreach( $getCountryObj as $item )
												{{--*/ $flag = 0 /*--}}
												@if( !empty(Request::get('country_id')) )
													@foreach(Request::get('country_id') as $data)
														@if( $data == $item->id )
															<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
															{{--*/ $flag = 1 /*--}}
														@endif
	                    							@endforeach
                    							@endif
                    							@if( $flag == '0' )
                    								<option value="{{ $item->id }}">{{ $item->name }}</option>
                								@endif
                    						@endforeach
	                					@endif
 									</select>
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->

 					<div class="panel-group" id="accordion-v5">
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<h2 class="panel-title">
 									<a data-toggle="collapse" data-parent="#accordion-v5" href="#collapseFive">
 										State
 										<i class="fa fa-angle-down"></i>
 									</a>
 								</h2>
 							</div>
 							<div id="collapseFive" class="panel-collapse collapse in">
 								<div class="panel-body">
 									<select name="state_id[]" id="stateID" class="form-control textColorSelect chosen-select" multiple="" data-placeholder="Choose a State...">
									@if( sizeof($getAllSelectedStates) > 0 )
										@foreach( $getAllSelectedStates as $item )
											{{--*/ $flag = 0 /*--}}
											@if( !empty(Request::get('state_id')) )
												@foreach(Request::get('state_id') as $data)
													@if( $data == $item->id )
														<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
														{{--*/ $flag = 1 /*--}}
													@endif
                    							@endforeach
                							@endif
											@if( $flag == '0' )
                								<option value="{{ $item->id }}">{{ $item->name }}</option>
            								@endif
										@endforeach
 									@endif
 									</select>
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->

 					<div class="panel-group" id="accordion-v6">
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<h2 class="panel-title">
 									<a data-toggle="collapse" data-parent="#accordion-v6" href="#collapseSix">
 										City
 										<i class="fa fa-angle-down"></i>
 									</a>
 								</h2>
 							</div>
 							<div id="collapseSix" class="panel-collapse collapse in">
 								<div class="panel-body">
 									<select name="city_id[]" id="cityID" class="form-control textColorSelect chosen-select" multiple="" data-placeholder="Choose a City...">
										@if( sizeof($getAllSelectedCities) > 0 )
										@foreach( $getAllSelectedCities as $item )
											{{--*/ $flag = 0 /*--}}
											@if( !empty(Request::get('city_id')) )
												@foreach(Request::get('city_id') as $data)
													@if( $data == $item->id )
														<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
														{{--*/ $flag = 1 /*--}}
													@endif
                    							@endforeach
                							@endif
											@if( $flag == '0' )
                								<option value="{{ $item->id }}">{{ $item->name }}</option>
            								@endif
										@endforeach
 									@endif
 									</select>
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->
 					<div class="panel-group" id="accordion">
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<h2 class="panel-title">
 									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
 										Stream
 										<i class="fa fa-angle-down"></i>
 									</a>
 								</h2>
 							</div>
 							<div id="collapseOne" class="panel-collapse collapse in">
 								<div class="panel-body">
 									<select name="functionalarea_id[]" id="functionalareaID" class="form-control chosen-select textColorSelect" multiple="" data-placeholder="Choose a Stream...">
 										@if( $getFunctionalAreaObj )
 											@foreach( $getFunctionalAreaObj as $item )
												{{--*/ $flag = 0 /*--}}
												@if( !empty(Request::get('functionalarea_id')) )
													@foreach(Request::get('functionalarea_id') as $data)
														@if( $data == $item->id )
															<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
															{{--*/ $flag = 1 /*--}}
														@endif
	                    							@endforeach
                    							@endif
                    							@if( $flag == '0' )
                    								<option value="{{ $item->id }}">{{ $item->name }}</option>
                								@endif
                    						@endforeach
                    					@endif
 									</select>
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->

 					<div class="panel-group" id="accordion-v2">
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<h2 class="panel-title">
 									<a data-toggle="collapse" data-parent="#accordion-v2" href="#collapseTwo">
 										Degree
 										<i class="fa fa-angle-down"></i>
 									</a>
 								</h2>
 							</div>
 							<div id="collapseTwo" class="panel-collapse collapse in">
 								<div class="panel-body">
									<select name="degree_id[]" id="degreeID" class="form-control chosen-select textColorSelect" multiple="" data-placeholder="Choose a Stream First...">
										@if( sizeof($getAllSelectedDegree) > 0 )
											@foreach( $getAllSelectedDegree as $item )
												{{--*/ $flag = 0 /*--}}
												@if( !empty(Request::get('degree_id')) )
													@foreach(Request::get('degree_id') as $data)
														@if( $data == $item->id )
															<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
															{{--*/ $flag = 1 /*--}}
														@endif
	                    							@endforeach
	                							@endif
												@if( $flag == '0' )
	                								<option value="{{ $item->id }}">{{ $item->name }}</option>
	            								@endif
											@endforeach
	 									@endif
 									</select>
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->


 					<div class="panel-group" id="accordion-v3">
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<h2 class="panel-title">
 									<a data-toggle="collapse" data-parent="#accordion-v3" href="#collapseThree">
 										Branch
 										<i class="fa fa-angle-down"></i>
 									</a>
 								</h2>
 							</div>
 							<div id="collapseThree" class="panel-collapse collapse in">
 								<div class="panel-body">
 									<select name="course_id[]" id="courseID" class="form-control chosen-select textColorSelect" multiple="" data-placeholder="Choose a Degree  First...">
										@if( sizeof($getAllSelectedBranch) > 0 )
											@foreach( $getAllSelectedBranch as $item )
												{{--*/ $flag = 0 /*--}}
												@if( !empty(Request::get('course_id')) && !empty(Request::get('degree_id')))
													@foreach(Request::get('course_id') as $data)
														@if( $data == $item->id )
															<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
															{{--*/ $flag = 1 /*--}}
														@endif
	                    							@endforeach
	                							@endif
												@if( $flag == '0' )
	                								<option value="{{ $item->id }}">{{ $item->name }}</option>
	            								@endif
											@endforeach
	 									@endif
 									</select>
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->

 					<div class="panel-group hidden" id="accordion-v4" style="visibility: hidden;">
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<h2 class="panel-title">
 									<a data-toggle="collapse" data-parent="#accordion-v4" href="#collapseFour">
 										Degree Level
 										<i class="fa fa-angle-down"></i>
 									</a>
 								</h2>
 							</div>
 							<div id="collapseFour" class="panel-collapse collapse in">
 								<div class="panel-body">
 									<select name="degreelevel_id[]" id="educationLevelID" class="form-control chosen-select textColorSelect" multiple="" data-placeholder="Choose a Degree Level...">
										@if( $getEducationLevelObj )
											@foreach( $getEducationLevelObj as $item )
												{{--*/ $flag = 0 /*--}}
												@if( !empty(Request::get('degreelevel_id')) )
													@foreach(Request::get('degreelevel_id') as $data)
														@if( $data == $item->id )
															<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
															{{--*/ $flag = 1 /*--}}
														@endif
	                    							@endforeach
                    							@endif
                    							@if( $flag == '0' )
                    								<option value="{{ $item->id }}">{{ $item->name }}</option>
                								@endif
                    						@endforeach
	                					@endif
 									</select>
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->

 					<div class="panel-group" id="accordion-v7">
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<h2 class="panel-title">
 									<a data-toggle="collapse" data-parent="#accordion-v7" href="#collapseSeven">
 										Fees
 										<i class="fa fa-angle-down"></i>
 									</a>
 								</h2>
 							</div>
 							<div id="collapseSeven" class="panel-collapse collapse in">
 								<div class="panel-body sky-form">
 									<label class="radio">
 										<input type="radio" name="fees" value="1" @if(Request::get('fees') == '1') checked="" @endif ><i class="rounded-x"></i> < 1 Lakh
									</label>
 									<label class="radio">
 										<input type="radio" name="fees" value="2" @if(Request::get('fees') == '2') checked="" @endif ><i class="rounded-x"></i> 1 - 2 Lakh
									</label>
 									<label class="radio">
 										<input type="radio" name="fees" value="3" @if(Request::get('fees') == '3') checked="" @endif ><i class="rounded-x"></i> 2 - 3 Lakh
									</label>
 									<label class="radio">
 										<input type="radio" name="fees" value="4" @if(Request::get('fees') == '4') checked="" @endif ><i class="rounded-x"></i> 3 - 5 Lakh
									</label>
 									<label class="radio">
 										<input type="radio" name="fees" value="5" @if(Request::get('fees') == '5') checked="" @endif ><i class="rounded-x"></i> > 5 Lakh
									</label>
 									<!-- <div class="slider-snap"></div>
 									<p class="slider-snap-text">
 										<span class="slider-snap-value-lower"></span>
 										<span class="slider-snap-value-upper"></span>
 									</p> -->
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->


 					<a href="{{ URL::to('explore/college') }}"><button type="button" class="btn-u btn-brd btn-brd-hover btn-u-lg btn-u-sea-shop btn-block resetNow">Reset</button></a>
 					@if(!empty($bannerImg1))
					<div class="margin-top20">
						<a href="{{ $redirectTo1 }}" target="_blank" title="View Now">
 							<img src="{{ asset('assets/ads-banner/'.$bannerImg1) }}" class="img-responsive img-thumbnail">
						</a>
					</div>
					@endif
					@include('common-partials.ads-slider', ['addonClass' => 'margin-top20 margin-bottom20', 'ads_position' => 'sidebar'])
 				</div>

 				<div class="col-md-9">
 					<div class="row margin-bottom-5">
 						<div class="col-sm-12 col-md-12 result-category">
 						<h5 class="text-center"><span class="text-highlights text-highlights-red rounded-2x"> To view college fees select Stream, Degree & Branch </span></h5>
 						</div>
 						<div class="col-sm-12 col-md-8 result-category">
 							<h3>BROWSE COLLEGE</h3>
 						</div>
 						<div class="col-sm-12 col-md-4 result-category">
 							<select name="filterBy" id="filterBy" class="form-control textColorSelect">
 								<option selected="" disabled="">Sort By</option>
 								@if( Request::get('filterBy') == '1' )
 									<option value="1" selected="">Fees -- Low to High</option>
								@else
									<option value="1">Fees -- Low to High</option>
								@endif
								@if( Request::get('filterBy') == '2' )
 									<option value="2" selected="">Fees -- High to Low</option>
								@else
									<option value="2">Fees -- High to Low</option>
								@endif
 								@if( Request::get('filterBy') == '3' )
 									<option value="3" selected="">Newest First</option>
								@else
									<option value="3">Newest First</option>
								@endif
 							</select>
 						</div>
 					</div><!--/end result category-->

 					<div class="filter-results">
 						<p class="text-center hide loader">
							<img src="{{asset('assets/images/loading.gif')}}" width="64">
						</p>
 						<div class="row illustration-v2 margin-bottom-30 filter-results-blocks">
 							@if( sizeof($getFilterOutDataObj) > 0 )
 							@foreach( $getFilterOutDataObj as $item )
 								<div class="col-xs-12 col-sm-12 col-md-12 col-md-12">
		 							<div class="row row-block-border marginall10">
		 								<a href="{{ URL::to('/college', $item->slug) }}" title="{{ $item->firstname }}">
		 									@if( $item->caption == 'College Logo' )
		 										@if( $item->galleryName != '' )
		 											<div class="col-md-2 col-left-block-img" style="background-image: url('{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->galleryName }}');"></div>
		 										@else
		 											<div class="col-md-2 col-left-block-img" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png');"></div>
	 											@endif
	 										@else
	 											<div class="col-md-2 col-left-block-img" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png');"></div>
 											@endif
	 									</a>
		 								<div class="col-md-10">
		 									{{--*/ $loactionName =  $item->cityName.', '.$item->stateName /*--}}
		 									@if($item->cityName != '')
		 									<em class="searchAddress">{{ str_limit($loactionName, 35 ) }}</em>
		 									@else
		 									<br>
		 									@endif
		 									<h6 class="collegeNameSearch"><a href="{{ URL::to('/college', $item->slug) }}" title="{{ $item->firstname }}">{{ $item->firstname }}<!-- {{ str_limit( $item->firstname, 30) }} --></a></h6>
		 									<p>
		 										<div class="row">
		 											@if( empty(Request::get('functionalarea_id')) )
		 												<div class="col-md-12 sky-form sky-form-no-block">
	 													<h6>Available Streams : </h6>
			 											{{--*/ $explodeFuncArea = explode(',', $item->functionalareaName) /*--}}
		 												<label class="select">
		 													<select>
			 													@foreach( $explodeFuncArea as $explode )
			 														<option disabled="" selected="">{{ $explode }}</option>
			 													@endforeach
			 												</select>
			 												<i></i>
		 												</label>
		 												</div>
		 											@elseif( !empty(Request::get('functionalarea_id')) AND empty(Request::get('degree_id')) AND empty(Request::get('course_id')) )
		 												<div class="col-md-12 sky-form sky-form-no-block">
		 													<h6>Available Courses : </h6>
				 											{{--*/ $explodeFuncArea = explode(',', $item->functionalareaName) /*--}}
			 												<label class="select">
			 													<select>
				 													@foreach( $explodeFuncArea as $explode )
				 														<option disabled="" selected="">{{ $explode }}</option>
				 													@endforeach
				 												</select>
				 												<i></i>
			 												</label>
		 												</div>
	 												@elseif( !empty(Request::get('functionalarea_id')) AND !empty(Request::get('degree_id')) AND empty(Request::get('course_id')) )
	 													<div class="col-md-12 sky-form sky-form-no-block">
		 													<h6>Available Branches : </h6>
				 											{{--*/ $explodeFuncArea = explode(',', $item->functionalareaName) /*--}}
			 												<label class="select">
			 													<select>
				 													@foreach( $explodeFuncArea as $explode )
				 														<option disabled="" selected="">{{ $explode }}</option>
				 													@endforeach
				 												</select>
				 												<i></i>
			 												</label>
		 												</div>
		 											@else
		 												<div class="col-md-12 sky-form sky-form-no-block">
	 													<span class="pull-left"><a href="{{ URL::to('/college/detail-course', array($item->collegemasterID,$item->slug), false) }}"  style="color: #000000;">{{ $item->degreeName }} | {{ $item->courseName }}</a></span>
	 													</div>
	 												<!-- class="anchorTagText" -->
		 											@endif
		 										</div>
		 										<!-- <span class="pull-left"><a href="{{ URL::to('college/detail-course', array($item->collegemasterID,$item->slug), false) }}">{{ $item->degreeName }} | {{ $item->courseName }}</a></span> -->
		 									</p>
		 									@if( !empty(Request::get('functionalarea_id')) AND !empty(Request::get('degree_id')) AND !empty(Request::get('course_id')) )
											<p class="clearBothNow">
												@if( $item->seats <= 5 && $item->seats > '0')
		 											<span class="pull-left text-left">Seats Available<br>{{ $item->seats }}</span>
		 										@endif
		 										@if($item->fees == '0')
		 										<span class="pull-right text-right"><b style="color: #cb3904;">Fee : N/A</b></span>
		 										@else
		 										<span class="pull-right text-right"><b style="color: #cb3904;">₹ {{ $item->fees }}</b></span><br> <span class="pull-right text-right" style="font-size: 10px;color: #5c952e;"> Per year </span>
		 										@endif
		 									</p>
		 									@endif
		 									<!-- @if( !empty($item->collegefacilitiesID) )
		 									<p class="clearBothNow"><a href="javascript:void(0);" id="collegeAmenitiesView" class="{{ $item->collegeprofileID }}">View College Amenities</a></p>
		 									@endif -->
		 									@if( !empty($item->collegefacilitiesID) )
		 									{{--*/
	 											 $collegeFacilityDataObj = DB::table('collegefacilities')
							                        ->leftJoin('facilities', 'collegefacilities.facilities_id', '=', 'facilities.id')
							                        ->where('collegefacilities.collegeprofile_id', '=', $item->collegeprofileID)
							                        ->select('collegefacilities.id as collegefacilitiesId','collegefacilities.name',  'collegefacilities.description', 'facilities.id as facilitiesId', 'facilities.name as facilitiesName','collegefacilities.collegeprofile_id', 'facilities.iconname as iconname')
							                        ->orderBy('collegefacilities.id', 'DESC')
							                        ->get()
							                        ;
                                    		/*--}}


                                    		<p class="clearBothNow">
		 									@if( $collegeFacilityDataObj )
												<div class="row collegefacility">
													@foreach( $collegeFacilityDataObj as $facility )
														@if($facility->collegeprofile_id == $item->collegeprofileID)
														<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1">
															<p class="feature-facility-icon">
																<img src="/home-layout/assets/img/facility/{{ $facility->iconname }}" width="20">
															</p>
														</div>
														@endif
													@endforeach
												</div>
											@endif
											</p>
											@endif
		 									<p class="clearBothNow">
		 										<span class="pull-right">
		 										@if(Auth::check())
													{{--*/   $getLoggedObj = DB::table('users')
															->where('users.id', '=', Auth::id())
										                    ->select('users.id')
										                    ->take(1)
										                    ->get()
										                    ;
										        	/*--}}
										        	@if( $getLoggedObj )
										        	<a class="btn btn-u btn-u-dark" href="{{ URL::to('/college', $item->slug) }}">Query</a>
													@endif
												@else
													<a class="btn btn-u btn-u-dark" href="{{ URL::to('/query-search-login', $item->slug) }}">Query</a>
												@endif

												@if( $item->agreement == '1')
													@if( !empty(Request::get('functionalarea_id')) AND !empty(Request::get('degree_id')) AND !empty(Request::get('course_id')) )
														<a class="btn btn-u btn-u-red" href="{{ URL::to('/college/detail-course', array($item->collegemasterID,$item->slug), false) }}">Admission</a>
													@else
														<a class="btn btn-u btn-u-red" href="{{ URL::to('/college', $item->slug) }}">Admission</a>
													@endif
												@endif
 												</span>
		 									</p>
		 								</div>
		 							</div>
		 						</div>
 							@endforeach

 							<div class="row indexPagination">
	                            <div class="col-md-12">
	                                <div class="pull-right custom-pagination">{!! $getFilterOutDataObj->appends(\Input::except('page'))->render() !!}</div>
	                            </div>
	                        </div>

	                        @if(!empty($bannerImg2))
								<div class="margin-top20">
									<a href="{{ $redirectTo2 }}" target="_blank" title="View Now">
										<img src="{{ asset('assets/ads-banner/'.$bannerImg2) }}" class="img-responsive img-thumbnail">
									</a>
								</div>
							@endif
							@include('common-partials.ads-slider', ['addonClass' => 'margin-top20 margin-bottom20', 'ads_position' => 'default'])
 							@else
 								<div class="headline text-center"><h3>No match found, please try with different search criteria</h3></div>
 							@endif
 					</div><!--/end filter resilts-->
 					</div><!--/end pagination-->
 				</div>
 			</div>
		</form>
	</div>

</div>
</div>
<div id="collegeAmenModal" class="hide white-popup">
	<div class="detail-page-signup">
		<div class="row">
			<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">College Amenities Details</a></h2>
			<hr>
			<div class="col-md-7 col-md-offset-3">
				<p id="collegeDataRecords"></p>
			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')
    {!! Html::script('home-layout/assets/plugins/noUiSlider/jquery.nouislider.all.min.js') !!}
    {!! Html::script('home-layout/assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js') !!}
    {!! Html::script('home-layout/assets/js/plugins/mouse-wheel.js') !!}
    {!! Html::script('assets/js/chosen/chosen.jquery.js') !!}
    {!! Html::script('home-layout/assets/js/plugins/college-ajax-process.js1') !!}
    {!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}

    {{-- <? @include('common-partials.ads-slider-script') ?> --}}
    <script type="text/javascript">
    	jQuery(document).ready(function() {
 			App.initScrollBar();
 			MouseWheel.initMouseWheel();
 		});
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"100%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        });

				// $('.resetNow').on('click', function(){
				//     $("select option:selected").removeAttr("selected");
				//     $("select").trigger("chosen:updated");
				//     window.location.reload();
				// });
    </script>
    <script type="text/javascript">
		$(document).on('click', '#collegeAmenitiesView', function(){
			var curentCollegeID = $(this).attr('class');

			//AJAX FOR POPUP MAGNIFIC
			$.ajax({
		        type: "POST",
		        url: '/getAllCollegeAmenitiesView',
		        data: {
		            curentCollegeID: curentCollegeID,
		        },
		        dataType: "json",
		        success: function(data){
	        		if( data.code == '200' ){
	        			var HTML = '';
	        			$('#collegeAmenModal').removeClass('hide');

	        			HTML += '<ul class="list-unstyled">';
	        			$.each(data.getAmenitiesObj, function(key, value) {
	        				HTML += '<li class="padding-top10 padding-bottom10">';
	        				if( data.getAmenitiesObj[key].facilitiesID == '1' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/hostel.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}else if( data.getAmenitiesObj[key].facilitiesID == '2' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/transport.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}else if( data.getAmenitiesObj[key].facilitiesID == '3' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/cafeteria.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}else if( data.getAmenitiesObj[key].facilitiesID == '4' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/audotarium.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}else if( data.getAmenitiesObj[key].facilitiesID == '5' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/library.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}else if( data.getAmenitiesObj[key].facilitiesID == '6' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/labs.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}else if( data.getAmenitiesObj[key].facilitiesID == '7' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/gym.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}else if( data.getAmenitiesObj[key].facilitiesID == '8' ){
	        					HTML += '<img src="/home-layout/assets/img/facility/wifi.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}else{
	        					HTML += '<img src="/home-layout/assets/img/facility/internet.png" width="32"> ('+data.getAmenitiesObj[key].facilitiesName+') - '+data.getAmenitiesObj[key].description+'';
	        				}
	        				HTML += '</li>';
	        			});
	        			HTML += '</ul>';
	        			$('#collegeDataRecords').html(HTML);
						$.magnificPopup.open({
					        items: {
					            src: '#collegeAmenModal',
					        },
					        type: 'inline'
					    });
	        		}
		        }
		    });
		});
    </script>

<script type="text/javascript">
	$(function() {
        $('.textColorSelect').change(function() {
            this.form.submit();
        });

        $('input[type="radio"][name="fees"]').change(function() {
	        this.form.submit();
	    });
	});
</script>
<script type="text/javascript">
	$('.newfilterCss').waypoint(function() {
      $('.newfilterCss').addClass('setPosition');
  	}, { offset: '5%' });
</script>

<script type="text/javascript">
	$(document).ready(function() {
	    $('#functionalareaID').on('click',function(e){
	        $('#degreeID').val('');
	        $('#courseID').val('');
	    });

	    $('#degreeID').on('click',function(e){
	        $('#courseID').val('');
	    });
	});
</script>
@endsection
