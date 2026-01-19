<!-- COURSE FORM DATA -->
<style type="text/css">
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>

<div class="detail-page-signup margin-bottom40 table-responsive">
	<div class="headline"><h2>Manage Your College Courses</h2></div>
	<!-- Updated Course List -->
	@if( sizeof($getUpdatedCoursesObj) > 0 )
		@foreach( $getUpdatedCoursesObj as $getUpdatedCourses )
			<div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 rating_reviews_info">
	            <div class="col-md-6">
	                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
	                	<div>
	                        <label class="font-noraml"><i class="fa-fw fa  fa-calendar"></i> Course Duration : 
	                        @if($getUpdatedCourses->courseduration)
								@if( $getUpdatedCourses->courseduration == '1')
									{{ $getUpdatedCourses->courseduration }}
								@else
									{{ $getUpdatedCourses->courseduration }}
								@endif
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Stream : 
	                    	@if($getUpdatedCourses->functionalareaName)
								{{ $getUpdatedCourses->functionalareaName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Degree : 
	                		@if($getUpdatedCourses->degreeName)
								{{ $getUpdatedCourses->degreeName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
							</label>
	                    </div>
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa fa-list"></i> Degree Level : 
	                        @if($getUpdatedCourses->educationlevelName)
								{{ $getUpdatedCourses->educationlevelName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course Type : 
	                        @if($getUpdatedCourses->coursetypeName)
								{{ $getUpdatedCourses->coursetypeName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course : 
	                        @if($getUpdatedCourses->courseName)
								{{ $getUpdatedCourses->courseName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
	                    
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa fa-percent"></i> 12th Marks : 
	                        @if($getUpdatedCourses->twelvemarks)
								{{ $getUpdatedCourses->twelvemarks }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Course Eligibility : 
	                        @if( $getUpdatedCourses->others )
								{{ $getUpdatedCourses->others }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa fa-money"></i> Total Fees (per year) : 
	                        Rs.
							@if( $getUpdatedCourses->fees )
								{{ $getUpdatedCourses->fees }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa fa-ticket"></i> Seats : 
	                        @if( $getUpdatedCourses->seats )
								{{ $getUpdatedCourses->seats }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa fa-ticket"></i> Seats Allocated To Admission X : 
	                        @if( $getUpdatedCourses->seatsallocatedtobya == '0')
								<span class="label label-success">All Seats Full</span>
							@elseif( $getUpdatedCourses->seatsallocatedtobya )
								{{ $getUpdatedCourses->seatsallocatedtobya }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div class="row">
	                    	<div class="col-md-6">
								<button class="btn btn-xs btn-block rounded btn-info updateCollegeMasterID" id="updateCollegeMasterID" data-effect="mfp-zoom-in">Update</button>
								<input type="hidden" name="collegemasterId" class="collegemasterId" value="{{ $getUpdatedCourses->collegemasterId }}">
	                    	</div>
	                    	<div class="col-md-6">
								<a class="btn btn-xs btn-block rounded btn-danger" href="{{ url('college/delete-college-master/') }}/{{ $getUpdatedCourses->collegemasterId }}/{{ $slugUrl }}">Remove</a>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
		@endforeach
	@else
		<h5>No courses listed.</h5>
	@endif
	<!-- End -->
	<!-- FORM -->
	<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewCourse"><i class="fa fa-plus"></i>Add New Course Details</button></div>
	{!! Form::open(['url' => '/college-course-partial', 'class' => 'form-horizontal courseForm', 'data-parsley-validate' => '']) !!} <!-- , 'style' => 'visibility: hidden' -->
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				@if( $getCollegeNameObj )
					@foreach( $getCollegeNameObj as $getCollegeName )
						{{--*/ $collegeName = $getCollegeName->firstname /*--}}
						<h4>College Name : <strong>{{ $collegeName }}</strong></h4>									
					@endforeach
				@endif
				<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
			</div>
		</div>
		<span class="text-highlights text-highlights-red rounded-2x"> College are advised to increase fees, from lowest to highest and start with lowest fees as low as 25%</span>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Course Duration</label></div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<select name="courseduration" class="form-control">
		                    <option value="" selected disabled>Select Course Duration</option>   
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
	                    <option value="{{ $functional->id }}">{{ $functional->name }}</option>
	                @endforeach       
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
		<div class="col-md-12"><label>Degree</label></div>
			<div class="col-md-12">
				<select name="degree_id" class="form-control chosen-select" data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select stream first for degree selection</option>   
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Course</label></div>
			<div class="col-md-12">
				<select name="course_id" class="form-control chosen-select coursename" data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select degree first for course selection</option>   
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Degree Level</label>
			</div>
			<div class="col-md-12">
				<select name="educationlevel_id" class="form-control chosen-select educationlevel" data-parsley-error-message=" Please select degree level" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select degree level</option>   
                    @foreach ($educationLevelObj as $education)
	                    <option value="{{ $education->id }}">{{ $education->name }}</option>
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
	                    <option value="{{ $courseType->id }}">{{ $courseType->name }}</option>
	                @endforeach       
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
            <div class="col-sm-12">
            	<label>Description : </label>
            	 <textarea class="form-control" rows="4" placeholder="Enter the description" name="description"></textarea>
            </div>
        </div> 
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Total Fees (per year) <span class="tooltips hide glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="Tution fees should remain same for entire course duration"></span> <span class="label label-primary hide"> <i class="fa fa-arrow-right"></i> Per Year fee for the student cannot be the more than the amount mentioned here for the duration of the course.</span></label>
				{!! Form::text('fees', null, ['class' => 'form-control', 'placeholder' => 'Enter fees','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter total fee course','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'8','maxlength'=>'8', 'required' => '']) !!}
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Total available seats in the course</label>
				{!! Form::text('seats', null, ['class' => 'form-control', 'id'=>'txtTotalSeats', 'placeholder' => 'Enter seats','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter total available seats in the course of 1 to 5 digits','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'5','maxlength'=>'5' , 'required' => '']) !!}
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
            <div class="col-sm-12">
            	<label>Seats Allocated To Admission X : </label>
        		<input type="text" class="form-control" id="txtByaSeats" name="seatsallocatedtobya" placeholder = "Enter seats allocated to Admission X" data-parsley-trigger="change" data-parsley-error-message="Please enter seats allocated to Admission X of 1 to 5 digits" data-parsley-type="digits" data-parsley-minlength="1" data-parsley-maxlength="5" maxlength="5" disabled="">
            </div>
        </div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Course Eligibility (Please enter minimum required 12th percentage)</label>
				{!! Form::text('twelvemarks', null, ['class' => 'form-control', 'placeholder' => 'Enter course eligibility','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter correct course eligibility','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'3','maxlength'=>'3','data-parsley-max'=>'100']) !!}
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Course Eligibility (Please mention entrance exam and their score, if any)</label>
				{!! Form::text('others', null, ['class' => 'form-control', 'placeholder' => 'Enter course eligibility','data-parsley-pattern'=>'^[0-9a-zA-Z\s -.,]*$', 'data-parsley-error-message' =>'Please enter correct course eligibility here', 'data-parsley-trigger'=>'change' ]) !!}
				<p class="text-info">(Please enter in this format : Exam name - Marks/Percentage)</p>
			</div>
		</div>
		
		<!-- <div class="detail-page-signup facultyNameBlock" style="visibility: hidden;">
			<div class="row">
				<div class="col-md-12">
					<h4 class="headline">Update Faculty Information</h4>
					<label>Faculty Name</label>
                    <select class="form-control facultyName chosen-select" name="facultyName[]" data-parsley-error-message="Please select faculty names" multiple="">
                    </select>
                </div>
            </div>
        </div> -->
		<!-- START FACULTY -->
		<!-- <div class="detail-page-signup">
			<div class="row">
				<div class="col-md-12">
					<h4 class="headline">Update Faculty Information</h4>
					<label>Faculty Name 1</label>
					<select class="form-control" name="suffix_1">
						<option disabled="" selected="">Please select suffix</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
						<option value="Mr.">Mr.</option>
						<option value="Miss">Miss</option>
						<option value="Mrs.">Mrs.</option>
					</select>
					<input type="text" class="form-control margin-top10 margin-bottom10" name="faculty_1" placeholder="Enter faculty name here" data-parsley-error-message = "Please enter valid faculty name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
					<input type="text" class="form-control margin-top10 margin-bottom10" name="description_1" placeholder="Enter education qualification here" data-parsley-error-message = "Please enter valid education qualification" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\\/s ().,-]*$">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<label>Faculty Name 2</label>
					<select class="form-control" name="suffix_2">
						<option disabled="" selected="">Please select suffix</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
						<option value="Mr.">Mr.</option>
						<option value="Miss">Miss</option>
						<option value="Mrs.">Mrs.</option>
					</select>
					<input type="text" class="form-control margin-top10 margin-bottom10" name="faculty_2" placeholder="Enter faculty name here" data-parsley-error-message = "Please enter valid faculty name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
					<input type="text" class="form-control margin-top10 margin-bottom10" name="description_2" placeholder="Enter education qualification here" data-parsley-error-message = "Please enter valid education qualification" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\\/s ().,-]*$">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<label>Faculty Name 3</label>
					<select class="form-control" name="suffix_3">
						<option disabled="" selected="">Please select suffix</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
						<option value="Mr.">Mr.</option>
						<option value="Miss">Miss</option>
						<option value="Mrs.">Mrs.</option>
					</select>
					<input type="text" class="form-control margin-top10 margin-bottom10" name="faculty_3" placeholder="Enter faculty name here" data-parsley-error-message = "Please enter valid faculty name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
					<input type="text" class="form-control margin-top10 margin-bottom10" name="description_3" placeholder="Enter education qualification here" data-parsley-error-message = "Please enter valid education qualification" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\\/s ().,-]*$">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<label>Faculty Name 4</label>
					<select class="form-control" name="suffix_4">
						<option disabled="" selected="">Please select suffix</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
						<option value="Mr.">Mr.</option>
						<option value="Miss">Miss</option>
						<option value="Mrs.">Mrs.</option>
					</select>
					<input type="text" class="form-control margin-top10 margin-bottom10" name="faculty_4" placeholder="Enter faculty name here" data-parsley-error-message = "Please enter valid faculty name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
					<input type="text" class="form-control margin-top10 margin-bottom10" name="description_4" placeholder="Enter education qualification here" data-parsley-error-message = "Please enter valid education qualification" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\\/s ().,-]*$">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<label>Faculty Name 5</label>
					<select class="form-control" name="suffix_5">
						<option disabled="" selected="">Please select suffix</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
						<option value="Mr.">Mr.</option>
						<option value="Miss">Miss</option>
						<option value="Mrs.">Mrs.</option>
					</select>
					<input type="text" class="form-control margin-top10 margin-bottom10" name="faculty_5" placeholder="Enter faculty name here" data-parsley-error-message = "Please enter valid faculty name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
					<input type="text" class="form-control margin-top10 margin-bottom10" name="description_5" placeholder="Enter education qualification here" data-parsley-error-message = "Please enter valid education qualification" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\\/s ().,-]*$">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<label>Faculty Name 6</label>
					<select class="form-control" name="suffix_6">
						<option disabled="" selected="">Please select suffix</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
						<option value="Mr.">Mr.</option>
						<option value="Miss">Miss</option>
						<option value="Mrs.">Mrs.</option>
					</select>
					<input type="text" class="form-control margin-top10 margin-bottom10" name="faculty_6" placeholder="Enter faculty name here" data-parsley-error-message = "Please enter valid faculty name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
					<input type="text" class="form-control margin-top10 margin-bottom10" name="description_6" placeholder="Enter education qualification here" data-parsley-error-message = "Please enter valid education qualification" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\\/s ().,-]*$">
				</div>
			</div>
		</div> -->
		<!-- END -->

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12 col-lg-12 text-right">
				<button class="btn-u" id="btnSubmit" type="submit">Submit</button>
			</div>
		</div>
	{!! Form::close() !!}
</div>
<!-- END -->
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
    });
</script>
<script type="text/javascript">
	//---------------- Ajax Call for course modal-------------------------------------------------------//
    $('.updateCollegeMasterID').click(function(){
   		var collegemasterId = $(this).next('.collegemasterId').val();
   		var slugUrl = "{!! $slugUrl !!}";
	    $.ajax({
	        type: "GET",
	        url: '/courseMasterPartial',
	        data: {
	            collegemasterId: collegemasterId,
	            slugUrl: slugUrl,
	        },
	        success: function(data){
	            $.magnificPopup.open({
	                type: 'inline',
	                items: {
	                    src: data
	                },
	                closeOnContentClick : false, 
			        closeOnBgClick :true, 
			        showCloseBtn : false, 
			        enableEscapeKey : false,
			        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)"></button>'
	            })
	        }
	    });
	});
	//---------------- Ajax Call for course modal-------------------------------------------------------//
</script>

<script type="text/javascript">
	$("#txtTotalSeats").blur(function(){
		if( $("#txtTotalSeats").val().length != '0' ){
			$("#txtByaSeats").removeAttr('disabled', '');
			$("#txtByaSeats").prop('required', true);			
		}else{
			$("#txtByaSeats").addAttr('disabled', 'disabled');
			$("#txtByaSeats").prop('required', false);	
		}		
	});

	$('#txtByaSeats').on('change', function(){
		var totalSeats = $("#txtTotalSeats").val();
	    var byaSeats = $("#txtByaSeats").val();
        if (totalSeats < byaSeats) {
            $("#txtByaSeats").val(totalSeats);
            return false;
        }
        return true;
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