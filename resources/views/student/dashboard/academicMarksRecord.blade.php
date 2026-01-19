<!-- COURSE FORM DATA -->
<div class="col-sm-12 col-md-12 col-lg-12">
	<div class="detail-page-signup margin-bottom40 table-responsive">
		<div class="headline"><h2>Manage Your Academic Marks <a href="javascript:void(0);" id="clodeMarksRecords" class="btn btn-xs btn-danger pull-right"><i class="fa fa-close"></i> Close</a></h2></div>
		<!-- Updated Course List -->
		@if( $getStudentmarksListCount > 0 )
		<table class="table table-hover table-bordered">
			<!-- <p class="text-danger">Once you Update your marks next time you are not able to update by your own please contact email :- <a href="mailto:support@admissionx.info">support@admissionx.info</a></p> -->
			<thead>
				<tr>
					<th>Class / Course</th>
					<th>Marks</th>
					<th>Marks Type / Bachelor Degree</th>
					<th>Percentage</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $getStudentmarksObj as $getUpdatedMarks )
					<tr>
						<td>
							@if($getUpdatedMarks->marksName)
								{{ $getUpdatedMarks->marksName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
						<td>
							@if($getUpdatedMarks->marks)
								{{ $getUpdatedMarks->marks }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
						<td>
							@if($getUpdatedMarks->studentMarkType)
								{{ $getUpdatedMarks->studentMarkType }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
						<td>
							@if($getUpdatedMarks->percentage)
								{{ $getUpdatedMarks->percentage }}%
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
						<td>
							<button class="btn btn-xs rounded btn-info" id="updateStudentMarksID" data-effect="mfp-zoom-in">Update</button>
							<input type="hidden" name="studentmarksId" class="studentmarksId" value="{{ $getUpdatedMarks->studentmarksIdValue }}"> <!-- / <a class="btn btn-xs rounded btn-danger" href="{{ url('student/delete-student-marks/') }}/{{ $getUpdatedMarks->studentmarksId }}/{{ $slugUrl }}">Remove</a> -->
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<h5>No Academic Marks Listed.</h5>
		@endif
		<!-- End -->
		<!-- FORM -->
		<!-- <div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewMarks"><i class="fa fa-plus"></i> Add Academic Marks Details</button></div> -->
		{!! Form::open(['url' => '/student-marks-partial', 'class' => 'form-horizontal studentMarksForm', 'data-parsley-validate' => '', 'style' => 'visibility: hidden']) !!}
			<div class="row padding-top5 padding-bottom5">
				<div class="col-md-12">
					<h4>Student Name : <strong>{{ $studentName }} {{ $studentName1 }} {{ $studentName2 }}</strong></h4>									
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
				</div>
			</div>

			<div class="row padding-top5 padding-bottom5">
				<div class="col-md-12">
					<label>Class </label>
					<!-- {!! Form::text('className', null, ['class' => 'form-control', 'placeholder' => 'Enter class name',  'required' => '', 'data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter class name here']) !!} -->
					<select name="className" class="form-control" required="" data-parsley-error-message="Please enter class name here">
	                    <option value="" selected disabled >Select class</option>
	                    <option value="10th">10th</option>
	                    <option value="11th">11th</option>
	                    <option value="12th">12th</option>
	                    <option value="Graduation">Graduation</option>
	                </select>
				</div>
			</div>
			<div class="row padding-top5 padding-bottom5">
				<div class="col-md-12">
					<label>Marks</label>
					{!! Form::text('marks', null, ['class' => 'form-control', 'placeholder' => 'Enter mark',  'required' => '','data-parsley-type'=>'number','data-parsley-length' => '[2, 3]', 'data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter mark here']) !!}
				</div>
			</div>
			<div class="row padding-top5 padding-bottom5">
				<div class="col-md-12">
					<label>Percentage</label>
					{!! Form::text('percentage', null, ['class' => 'form-control', 'placeholder' => 'Enter percentage','data-parsley-type'=>'number','required' => '','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter percentage here']) !!}
				</div>
			</div>
			<div class="row padding-top5 padding-bottom5">
				<div class="col-md-12">
					<label>Marks Type </label>
					<select name="studentMarkType" class="form-control chosen-select" data-placeholder="Choose mark type ..." data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
	                    <option value="" selected disabled >Select Mark Type</option>
	                    <option value="" disabled ></option>
	                    <option value="PCB">PCB (Physics, Chemistry, Biology)</option>
	                    <option value="PCM">PCM (Physics, Chemistry, Math)</option>
	                    <option value="BEST 4">BEST 4</option>
	                    <option value="BEST 5">BEST 5</option>
	                    <option value="BEST 6">BEST 6</option>
	                    <optgroup label="Bachelor Degree In">
		                    <option value="Art / Design">Art / Design</option>
							<option value="Business / Management">Business / Management</option>
							<option value="Computers / Technology">Computers / Technology</option>
							<option value="Criminal Justice / Legal">Criminal Justice / Legal</option>
							<option value="Education / Teaching">Education / Teaching</option>
							<option value="Liberal Arts / Humanities">Liberal Arts / Humanities</option>
							<option value="Nursing / Healthcare">Nursing / Healthcare</option>
							<option value="Psychology / Counseling">Psychology / Counseling</option>
							<option value="Science / Engineering">Science / Engineering</option>
							<option value="Trades / Careers">Trades / Careers</option>
					    </optgroup>
	                    <option value="None Of These">None Of These</option>
	                </select>
				</div>
			</div>
			<div class="row padding-top5 padding-bottom5">
				<div class="col-md-12 col-lg-12 text-right">
					<button class="btn-u" type="submit">Submit</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<!-- END -->