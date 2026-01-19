@extends('website/new-design-layouts.master')

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
	  max-width: 600px;
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
</style>
@endsection


@section('content')
<div class="wrapper">
	<div class="content container">
		<div class="row">
 				<div class="col-md-3 filter-by-block md-margin-bottom-60">
 					<h1>Filter By</h1>
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
 									<select name="functionalareaID" id="functionalareaID" class="form-control chosen-select" multiple="" data-placeholder="Choose a Stream...">
 										@if( $getFunctionalAreaObj )
 											@foreach( $getFunctionalAreaObj as $item )
 												@if( $functionalareaID == $item->id )
 													<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
	                        					@else
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
									<select name="degreeID" id="degreeID" class="form-control chosen-select" multiple="" data-placeholder="Choose a Stream First...">
										@if( $getDegreeObj )
											@foreach( $getDegreeObj as $item )
												@if( $degreeID == $item->id )
													<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                        					@else
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
 									<select name="courseID" id="courseID" class="form-control chosen-select" multiple="" data-placeholder="Choose a Degree  First...">
										@if( $getCourseObj )
											@foreach( $getCourseObj as $item )
												@if( $courseID == $item->id )
													<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                        					@else
                        						<option value="{{ $item->id }}">{{ $item->name }}</option>
                    						@endif
                    						@endforeach
	                					@endif
 									</select> 									
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->

 					<div class="panel-group" id="accordion-v4">
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
 									<select name="educationLevelID" id="educationLevelID" class="form-control chosen-select" multiple="" data-placeholder="Choose a Degree Level...">
										@if( $getEducationLevelObj )
											@foreach( $getEducationLevelObj as $item )
												<option value="{{ $item->id }}">{{ $item->name }}</option>
                    						@endforeach
	                					@endif
 									</select> 									
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->

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
 									<select name="countryID" id="countryID" class="form-control chosen-select" multiple="" data-placeholder="Choose a country...">
										@if( $getStateObj )
											@foreach( $getCountryObj as $item )
												@if( $countryID == $item->id )
													<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
												@else
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
 									<select name="stateID" id="stateID" class="form-control chosen-select" multiple="" data-placeholder="Choose a State...">
										@if( $getStateObj )
											@foreach( $getStateObj as $item )
												@if( $stateID == $item->id )
													<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
												@else
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
 									<select name="cityID" id="cityID" class="form-control chosen-select" multiple="" data-placeholder="Choose a City...">
										@if( $getCityObj )
											@foreach( $getCityObj as $item )
												@if( $cityID == $item->id )
													<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
												@else
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
 								<div class="panel-body">
 									<div class="slider-snap"></div>
 									<p class="slider-snap-text">
 										<span class="slider-snap-value-lower"></span>
 										<span class="slider-snap-value-upper"></span>
 									</p>
 								</div>
 							</div>
 						</div>
 					</div><!--/end panel group-->

 					
 					<button type="button" class="btn-u btn-brd btn-brd-hover btn-u-lg btn-u-sea-shop btn-block resetNow">Reset</button>
 				</div>

 				<div class="col-md-9">
 					<div class="row margin-bottom-5">
 						<div class="col-sm-12 result-category">
 							<h3>BROWSE COLLEGE</h3>
 							<div class="headline">
 								@if( $noMatchFound == '1' )
		 							<h3>No match found, please try with different search criteria</h3>
	 								<h3>Suggested Colleges From AdmissionX</h3>
								@endif
 							</div>
 						</div> 						
 					</div><!--/end result category-->

 					<div class="filter-results">
 						<p class="text-center hide loader">
							<img src="{{asset('assets/images/loading.gif')}}" width="64">	
						</p>
 						<div class="row illustration-v2 margin-bottom-30 filter-results-blocks">
 							@if( !empty($getFilterOutDataObj['getFilterOutDataObj']) )
 							@foreach( $getFilterOutDataObj['getFilterOutDataObj'] as $item )
 								<div class="col-xs-12 col-sm-6 col-md-6 col-md-6">
		 							<div class="row row-block-border marginall10">
		 								<a href="{{ URL::to('/college', $item->slug) }}" title="{{ $item->firstname }}">
		 									@if( $item->caption == 'College Logo' )
		 										@if( $item->galleryName != '' )
		 											<div class="col-md-4 col-left-block-img" style="background-image: url('{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->galleryName }}');"></div>
		 										@else
		 											<div class="col-md-4 col-left-block-img" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png');"></div>
	 											@endif
	 										@else
	 											<div class="col-md-4 col-left-block-img" style="background-image: url('{{asset('assets/images/')}}/no-college-logo.png');"></div>
 											@endif
	 									</a>
		 								<div class="col-md-8">
		 									{{--*/ $loactionName =  $item->cityName.', '.$item->stateName /*--}}
		 									<em>{{ str_limit($loactionName, 35 ) }}</em>	 
		 									<h6><a href="{{ URL::to('/college', $item->slug) }}" title="{{ $item->firstname }}">{{ str_limit( $item->firstname, 35) }}</a></h6>
		 									<p>
		 										<div class="row">
		 											@if( empty($functionalareaID) )
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
		 											@elseif( !empty($functionalareaID) AND empty($degreeID) AND empty($courseID) )
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
	 												@elseif( !empty($functionalareaID) AND !empty($degreeID) AND empty($courseID) )
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
	 													<span class="pull-left"><a href="{{ URL::to('/college/detail-course', array($item->collegemasterID,$item->slug), false) }}" class="anchorTagText">{{ $item->degreeName }} | {{ $item->courseName }}</a></span>
	 													</div>
		 											@endif
		 										</div>
		 										<!-- <span class="pull-left"><a href="{{ URL::to('college/detail-course', array($item->collegemasterID,$item->slug), false) }}">{{ $item->degreeName }} | {{ $item->courseName }}</a></span> -->
		 									</p>
		 									@if( !empty($functionalareaID) AND !empty($degreeID) AND !empty($courseID) )
											<p class="clearBothNow">
												@if( $item->seats <= 5 && $item->seats > '0')
		 											<span class="pull-left text-left">Seats Available<br>{{ $item->seats }}</span>
		 										@endif
		 										<span class="pull-right text-right badge badge-sea rounded">Total fees (per year)<br>Rs. {{ $item->fees }}</span>
		 									</p>
		 									@endif
		 									@if( !empty($item->collegefacilitiesID) )
		 									<p class="clearBothNow"><a href="javascript:void(0);" id="collegeAmenitiesView" class="{{ $item->collegeprofileID }}">View College Amenities</a></p>
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
										        	<a class="btn btn-sm btn-windows" href="{{ URL::to('/college', $item->slug) }}">Query</a>	
													@endif
												@else
													<a class="btn btn-sm btn-windows" href="{{ URL::to('/query-search-login', $item->slug) }}">Query</a>
												@endif
	 												
												@if( $item->agreement == '1')
													<a class="btn btn-sm btn-windows" href="{{ URL::to('/college', $item->slug) }}">Admission</a>
												@endif
 												</span>
		 									</p>
		 								</div>
		 							</div>
		 						</div>
 							@endforeach 							
 							@else
 								<div class="headline text-center"><h3>No match found, please try with different search criteria</h3></div>
 							@endif
 					</div><!--/end filter resilts-->
 					@if( $getFilterOutDataObj )
	 					<input type="hidden" value="{{ $getFilterOutDataObj['getFilterOutDataObj1'] }}" id="oldUsersId" name="oldUsersId">
	 					<p class="text-center hide scrollDownLoader">
							<img src="{{asset('assets/images/loading.gif')}}" width="64">	
						</p>
					@endif
 					</div><!--/end pagination-->
 				</div>
 			</div>
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
    {!! Html::script('home-layout/assets/js/plugins/college-ajax-process.js') !!}
    {!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}

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
@endsection