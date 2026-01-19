<!-- COURSE FORM DATA -->
<div class="detail-page-signup margin-bottom40 table-responsive">
	<div class="headline"><h2>Manage Your College Courses</h2></div>
	<!-- Updated Course List -->
	@if( sizeof($getUpdatedCoursesObj) > 0 )
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Course Duration</th>
				<th>Degree Level</th>
				<th>Stream</th>
				<th>Degree</th>
				<th>Course Type</th>
				<th>Course</th>
				<th>12th Marks</th>
				<th>Course Eligibility</th>
				<th>Total Fees (per year)</th>
				<th>Seats</th>
				<th>Seats Allocated To Admission X</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $getUpdatedCoursesObj as $getUpdatedCourses )
				<tr>
					<td>
						@if($getUpdatedCourses->courseduration)
							@if( $getUpdatedCourses->courseduration == '1')
								{{ $getUpdatedCourses->courseduration }}
							@else
								{{ $getUpdatedCourses->courseduration }}
							@endif
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if($getUpdatedCourses->educationlevelName)
							{{ $getUpdatedCourses->educationlevelName }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if($getUpdatedCourses->functionalareaName)
							{{ $getUpdatedCourses->functionalareaName }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if($getUpdatedCourses->degreeName)
							{{ $getUpdatedCourses->degreeName }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if($getUpdatedCourses->coursetypeName)
							{{ $getUpdatedCourses->coursetypeName }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if($getUpdatedCourses->courseName)
							{{ $getUpdatedCourses->courseName }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if($getUpdatedCourses->twelvemarks)
							{{ $getUpdatedCourses->twelvemarks }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if( $getUpdatedCourses->others )
							{{ $getUpdatedCourses->others }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						Rs.
						@if( $getUpdatedCourses->fees )
							{{ $getUpdatedCourses->fees }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if( $getUpdatedCourses->seats )
							{{ $getUpdatedCourses->seats }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if( $getUpdatedCourses->seatsallocatedtobya == '0')
							<span class="label label-success">All Seats Full</span>
						@elseif( $getUpdatedCourses->seatsallocatedtobya )
							{{ $getUpdatedCourses->seatsallocatedtobya }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						<button class="btn btn-xs rounded btn-info" id="updateCollegeMasterID" data-effect="mfp-zoom-in">Update</button>
						<input type="hidden" name="collegemasterId" class="collegemasterId" value="{{ $getUpdatedCourses->collegemasterId }}"> / <a class="btn btn-xs rounded btn-danger" href="{{ url('college/delete-college-master/') }}/{{ $getUpdatedCourses->collegemasterId }}/{{ $slugUrl }}">Remove</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@else
		<h5>No courses listed.</h5>
	@endif
	<!-- End -->
	<!-- FORM -->
	<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewCourse"><i class="fa fa-plus"></i>Add New Course Details</button></div>
	{!! Form::open(['url' => '/college-course-partial', 'class' => 'form-horizontal courseForm', 'data-parsley-validate' => '', 'style' => 'visibility: hidden']) !!}
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				@if( $getCollegeNameObj )
					@foreach( $getCollegeNameObj as $getCollegeName )
						{{ $getCollegeName->firstname }} <a href="{{ URL::to('college', $slugUrl) }}" title="{{ $getCollegeName->firstname }}"></a>
						{{--*/ $collegeName = $getCollegeName->firstname /*--}}
					@endforeach
				@endif
				<h4>College Name : <strong>{{ $collegeName }}</strong></h4>									
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
				<select name="degree_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select stream first for degree selection</option>   
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Course</label></div>
			<div class="col-md-12">
				<select name="course_id" class="form-control chosen-select " data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select degree first for course selection</option>   
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Degree Level</label>
			</div>
			<div class="col-md-12">
				<select name="educationlevel_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree level" data-parsley-trigger="change" required="">
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
        		<select name="coursetype_id" class="form-control chosen-select " data-parsley-error-message=" Please select course type" data-parsley-trigger="change" required="">
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
				{!! Form::text('fees', null, ['class' => 'form-control', 'placeholder' => 'Enter fees','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter total fee course','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'8','maxlength'=>'8']) !!}
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Total available seats in the course</label>
				{!! Form::text('seats', null, ['class' => 'form-control', 'id'=>'txtTotalSeats', 'placeholder' => 'Enter seats','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter total available seats in the course of 1 to 5 digits','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'5','maxlength'=>'5']) !!}
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
		
		<!-- START FACULTY -->
		<div class="detail-page-signup">
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
		</div>
		<!-- END -->

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12 col-lg-12 text-right">
				<button class="btn-u" id="btnSubmit" type="submit">Submit</button>
			</div>
		</div>
	{!! Form::close() !!}
</div>
<!-- END -->

<script type="text/javascript">
	//---------------- Ajax Call for course modal-------------------------------------------------------//

    $('table > tbody tr > td > #updateCollegeMasterID').click(function(){
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
			        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">   </button>'
	            })
	        }
	    });
	});

	//---------------- Ajax Call for course modal-------------------------------------------------------//
</script>