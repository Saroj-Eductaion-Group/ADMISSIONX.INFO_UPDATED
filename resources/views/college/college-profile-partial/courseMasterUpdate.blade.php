<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<!-- START ADDRESS FORM FOR REGISTER -->
		<div>
			<form method="POST" action="/college-course-master-update" data-parsley-validate>
				<input type="hidden" name="collegemasterId" value="{{ $getCollegeMasterData->collegemasterId }}">
				<input type="hidden" name="slugUrl" value="{{ $getCollegeMasterData->slug }}">
				<div class="row padding-top5 padding-bottom5">
			     	<div class="col-md-12"><h4>College Name : {{ $getCollegeMasterData->firstName }}</h4></div>
		     	</div>
		     	<span class="text-highlights text-highlights-red rounded-2x"> College are advised to increase fees, from lowest to highest and start with lowest fees as low as 25%</span>
		     	<div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12"><label>Course Duration : {{ $getCollegeMasterData->courseduration }}</label></div>
			    	<div class="col-md-12">
			    		<div class="row">
			    			<div class="col-md-6">
								<select name="courseduration" class="form-control">
				                    <option value="" selected disabled>Select Course Duration :</option>   
				                    @for ($yearName = 1; $yearName < 11; $yearName++)
				                    	@if( $yearName == '1' )
				                    		<option value="{{ $yearName }} Year">{{ $yearName }} Year</option>
			                    		@else
									    	<option value="{{ $yearName }} Years">{{ $yearName }} Years</option>
								    	@endif
									@endfor
				                </select>
							</div>
							<div class="col-md-6">
								<select name="courseduration1" class="form-control">
				                    <option value="" selected disabled>Select Course Duration</option>   
				                    @for ($monthName = 1; $monthName < 13; $monthName++)
				                    	@if( $monthName == '1' )
				                    		<option value="{{ $monthName }} month">{{ $monthName }} month(s)</option>
			                    		@else
									    	<option value="{{ $monthName }} months">{{ $monthName }} month(s)</option>
								    	@endif
							    	@endfor
				                </select>
							</div>
			    		</div>			            
			        </div>
			    </div>

		     	<div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12"><label>Stream</label></div>
			    	<div class="col-md-12">
			            <select name="functionalarea_id" class="form-control chosen-select " data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select stream</option>   
		                    @foreach ($functionalAreaObj as $functional)
		                    	@if( $getCollegeMasterData->functionalarea_id == $functional->id )
			                    	<option value="{{ $functional->id }}" selected="">{{ $functional->name }}</option>
	                    		@else
	                    			<option value="{{ $functional->id }}">{{ $functional->name }}</option>
                    			@endif
			                @endforeach       
		                </select>
			        </div>
			    </div>

				<div class="row padding-top5 padding-bottom5">
					<div class="col-md-12"><label>Degree</label></div>
			    	<div class="col-md-12">			            
			            <select name="degree_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select degree</option>   
		                    @foreach ($degreeObj as $degree)
		                    	@if( $getCollegeMasterData->degree_id == $degree->id )
			                    	<option value="{{ $degree->id }}" selected="">{{ $degree->name }}</option>
		                    	@else
		                    		<option value="{{ $degree->id }}">{{ $degree->name }}</option>
	                    		@endif
			                @endforeach       
		                </select>
			        </div>
			    </div>

			    <div class="row padding-top5 padding-bottom5">
					<div class="col-md-12"><label>Course</label></div>
			    	<div class="col-md-12">
			            <select name="course_id" class="form-control chosen-select coursename" data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select course </option>   
		                    @foreach ($courseObj as $course)
		                    	@if( $getCollegeMasterData->course_id == $course->id )
			                    	<option value="{{ $course->id }}" selected="">{{ $course->name }}</option>
		                    	@else
		                    		<option value="{{ $course->id }}">{{ $course->name }}</option>
	                    		@endif			                    			                    
			                @endforeach       
		                </select>
			        </div>
			    </div>

			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12"><label>Course Type</label></div>
			    	<div class="col-md-12">
			            <select name="coursetype_id" class="form-control chosen-select coursetype" data-parsley-error-message=" Please select course type" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select course type</option>   
		                    @foreach ($courseTypeObj as $courseType)
		                    	@if( $getCollegeMasterData->coursetype_id == $courseType->id )
			                    	<option value="{{ $courseType->id }}" selected="">{{ $courseType->name }}</option>
		                    	@else
		                    		<option value="{{ $courseType->id }}">{{ $courseType->name }}</option>
	                    		@endif			                    
			                @endforeach       
		                </select>
			        </div>
			    </div>

				<div class="row padding-top5 padding-bottom5">
			     	<div class="col-md-12"><label>Degree Level</label></div>
			    	<div class="col-md-12">
			            <select name="educationlevel_id" class="form-control chosen-select educationlevel" data-parsley-error-message=" Please select degree level" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select degree level</option>   
		                    @foreach ($educationLevelObj as $education)
		                    	@if( $getCollegeMasterData->educationlevel_id == $education->id)
			                    	<option value="{{ $education->id }}" selected="">{{ $education->name }}</option>
		                    	@else
		                    		<option value="{{ $education->id }}">{{ $education->name }}</option>
	                    		@endif
			                @endforeach       
		                </select>
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
	                <div class="col-sm-12">
	                	<label>Description : </label>
	                	@if( $getCollegeMasterData->description )
			            	<input class="form-control" rows="4" placeholder="Enter the description" name="description" value="{{ $getCollegeMasterData->description }}">
		            	@else
		            		<input class="form-control" rows="4" placeholder="Enter the description" name="description">
	            		@endif
	                	 
	                </div>
	            </div> 
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Total Fees (per year) <span class="label label-primary hide"> <i class="fa fa-arrow-right"></i> Per Year fee for the student cannot be the more than the amount mentioned here for the duration of the course.</span></label>
			            @if( $getCollegeMasterData->fees )
			            	<input type="text" class="form-control" name="fees" placeholder="Please enter total fees (per year)" value="{{ $getCollegeMasterData->fees }}"  data-parsley-type="digits" data-parsley-minlength="1" data-parsley-maxlength="8" maxlength="8" data-parsley-error-message="Please enter total fee course" required="" data-parsley-trigger="change">
		            	@else
		            		<input type="text" class="form-control" name="fees" placeholder="Please enter total fees (per year)"  data-parsley-type="digits" data-parsley-minlength="1" data-parsley-maxlength="8" maxlength="8" data-parsley-error-message="Please enter total fee course" required="" data-parsley-trigger="change">
            			@endif
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Total available seats in the course</label>
			            @if( $getCollegeMasterData->seats )
			            	<input type="text" class="form-control" name="seats" placeholder="Please enter course total seats" value="{{ $getCollegeMasterData->seats }}" data-parsley-trigger="change" data-parsley-error-message="Please enter total available seats in the course of 1 to 5 digits" data-parsley-type="digits" data-parsley-minlength="1"data-parsley-maxlength="5" maxlength="5" required="">
		            	@else
		            		<input type="text" class="form-control" name="seats" placeholder="Please enter course total seats" data-parsley-trigger="change" data-parsley-error-message="Please enter total available seats in the course of 1 to 5 digits" data-parsley-type="digits" data-parsley-minlength="1" data-parsley-maxlength="5" maxlength="5" required="">
	            		@endif
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Seats Allocated To Admission X</label>
			            @if( $getCollegeMasterData->seatsallocatedtobya )
			            	<input type="text" class="form-control" name="seatsallocatedtobya" placeholder="Enter seats allocated to Admission X" value="{{ $getCollegeMasterData->seatsallocatedtobya }}" data-parsley-trigger="change" data-parsley-error-message="Please enter seats allocated to Admission X of 1 to 5 digits" data-parsley-type="digits" data-parsley-minlength="1" data-parsley-maxlength="5" maxlength="5" required="">
		            	@else
		            		<input type="text" class="form-control" name="seatsallocatedtobya" placeholder="Enter seats allocated to Admission X" data-parsley-trigger="change" data-parsley-error-message="Please enter seats allocated to Admission X of 1 to 5 digits" data-parsley-type="digits" data-parsley-minlength="1" data-parsley-maxlength="5" maxlength="5" required="">
	            		@endif
			        </div>
			    </div>
			    
			     <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Course Eligibility (Please enter minimum required 12th percentage)</label>
			            @if( $getCollegeMasterData->twelvemarks )
			            	<input type="text" class="form-control" name="twelvemarks" placeholder="Enter Course Eligibility"  value="{{ $getCollegeMasterData->twelvemarks }}" data-parsley-trigger="change" data-parsley-error-message="Please enter correct course eligibility" data-parsley-type="digits" data-parsley-minlength="1" data-parsley-maxlength="3" maxlength="3" data-parsley-max="100">
		            	@else
		            		<input type="text" class="form-control" name="twelvemarks" placeholder="Enter Course Eligibility" data-parsley-trigger="change" data-parsley-error-message="Please enter correct course eligibility" data-parsley-type="digits" data-parsley-minlength="1" data-parsley-maxlength="3" maxlength="3" data-parsley-max="100">
            			@endif
			        </div>
			    </div>

			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Course Eligibility (Please mention entrance exam and their score, if any)</label>
			            @if( $getCollegeMasterData->others )
			            	<input type="text" class="form-control" name="others" placeholder="Please enter course eligibility" value="{{ $getCollegeMasterData->others }}"  data-parsley-pattern="^[0-9a-zA-Z\s .,-]*$" data-parsley-error-message ="Please enter correct course eligibility here" data-parsley-trigger="change" >
		            	@else
		            		<input type="text" class="form-control" name="others" placeholder="Please enter  course eligibility" data-parsley-pattern="^[0-9a-zA-Z\s .,-]*$" data-parsley-error-message ="Please enter correct course eligibility here" data-parsley-trigger="change" >
	            		@endif
	            		<p class="text-info">(Please enter in this format : Exam name - Marks/Percentage)</p>
			        </div>
			    </div>

			    
			    <!-- <div class="detail-page-signup facultyNameBlock" @if(sizeof($getCollegeMasterFacultyObj) > 0) @else style="visibility: hidden;" @endif>
					<div class="row">
						<div class="col-md-12">
							<h4 class="headline">Update Faculty Information</h4>
							<label>Faculty Name</label>
		                    <select class="form-control facultyName chosen-select" name="facultyName[]" data-parsley-error-message="Please select faculty names" multiple="">
								@foreach( $getAllFacultyName as $item )
									{{--*/ $flag = 0 /*--}}
									@if(sizeof($getCollegeMasterFacultyObj) > 0)
										@foreach($getCollegeMasterFacultyObj as $data)
											@if( $data->id == $item->id )
												<option value="{{ $item->id }}" selected="">{{ $item->fullname }}</option>
												{{--*/ $flag = 1 /*--}}
											@endif
            							@endforeach
        							@endif
        							@if( $flag == '0' )
        								<option value="{{ $item->id }}">{{ $item->fullname }}</option>
    								@endif
        						@endforeach
		                    </select>
		                </div>
		            </div>
		        </div> -->
			    

			    <!-- START FACULTY -->
			    <!-- @if( $getFacultyInfomartion )
					<div class="detail-page-signup">
						<h4 class="headline">Update Faculty Information</h4>
						@foreach( $getFacultyInfomartion as $key => $value )
							<div class="row">
								<div class="col-md-12">									
									<label>Faculty Name {{ $value->sortorder }}</label>
									<select class="form-control margin-top10 margin-bottom10" name="suffix_{{ $value->sortorder }}">
										<option disabled="" selected="">Please select suffix</option>
										@if( $value->suffix )
											<option value="{{ $value->suffix }}" disabled="" selected="">{{ $value->suffix }}</option>
										@endif
										<option value="Dr.">Dr.</option>
										<option value="Prof.">Prof.</option>
										<option value="Mr.">Mr.</option>
										<option value="Miss">Miss</option>
										<option value="Mrs.">Mrs.</option>
									</select>
									<input type="text" class="form-control margin-top10 margin-bottom10" name="faculty_{{ $value->sortorder }}" value="{{ $value->name }}" placeholder="Enter faculty name here" data-parsley-error-message = "Please enter valid faculty name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
									<input type="text" class="form-control margin-top10 margin-bottom10" name="description_{{ $value->sortorder }}" value="{{ $value->description }}" placeholder="Enter education qualification here"  data-parsley-error-message = "Please enter valid education qualification" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\\/s ().,-]*$">
								</div>
							</div>
							<hr>
						@endforeach
					</div>
				@endif -->
				<!-- END -->


				<div class="row padding-top5 padding-bottom5">
					<div class="col-md-12 col-lg-12 text-right">
						<button class="btn-u" type="submit">Submit</button>
					</div>
				</div>
			</form>			
		</div>
	</div>
</div>


{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
  $('form').parsley();
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

        //INPUT BLUR
		$( 'input[name=fees]' ).focusin(function() {
	  		$('span.label-primary').removeClass('hide');
		});
		$( 'input[name=fees]' ).focusout(function() {
	  		$('span.label-primary').addClass('hide');
		});

    });
</script>

<script type="text/javascript">
	$('select[name=functionalarea_id]').on('change', function(){
		var currentID = $(this).val();
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllDegreeName') }}",
            success: function(data) {
            	var HTML = '';
            	HTML += '<option selected="" disabled="">Select degree</option>';
            	if( data.code == '200' ){
            		$.each(data.degreeObj, function(i, item) {
            			HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No degree available for this stream</option>';
            	}

            	$('select[name="degree_id"]').empty();
            	$('select[name="degree_id"]').html(HTML);
            	$('select[name="degree_id"]').trigger('chosen:updated');
            }
        });
	});
</script>

<script type="text/javascript">
	$('select[name=degree_id]').on('change', function(){
		var currentID = $(this).val();
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCourseName') }}",
            success: function(data) {
            	var HTML = '';
            	HTML += '<option selected="" disabled="">Select course</option>';
            	if( data.code == '200' ){
            		$.each(data.courseObj, function(i, item) {
            			HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No course available for this degree</option>';
            	}

            	$('select[name="course_id"]').empty();
            	$('select[name="course_id"]').html(HTML);
            	$('select[name="course_id"]').trigger('chosen:updated');
            }
        });
	});
</script>
<!-- @include('college.college-profile-partial.fetch-faculty-name-partial') -->