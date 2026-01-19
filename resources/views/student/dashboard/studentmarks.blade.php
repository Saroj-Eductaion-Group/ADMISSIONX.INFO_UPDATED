<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<!-- <h2 class="heading-md text-center text-green"><a class="hover-effect" href="">Manage your course details</a></h2> -->
		<!-- <h4 class="text-danger">Once you Update your marks next time you are not able to update by your own please contact email :- <a href="mailto:support@admissionx.info">support@admissionx.info</a></h4>
		<hr> -->
		
		<!-- START ADDRESS FORM FOR REGISTER -->
		<div>
			<form method="POST" action="/student-marks-update" data-parsley-validate>
				<input type="hidden" name="studentmarksId" value="{{ $getStudentMarksData->studentmarksId }}">
				<input type="hidden" name="slugUrl" value="{{ $getStudentMarksData->slug }}">
				<input type="hidden" name="classname" value="{{ $getStudentMarksData->marksnamevalue }}">
				<div class="row padding-top5 padding-bottom5">
			     	<div class="col-md-12"><h4>Student Name : {{ $getStudentMarksData->firstname }} {{ $getStudentMarksData->middlename }} {{ $getStudentMarksData->lastname }}</h4></div>
		     	</div>
		     	
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Class </label>
			            @if( $getStudentMarksData->marksname )
			            	<input type="text" class="form-control" disabled="" value="{{ $getStudentMarksData->marksname }}" >
            			@endif
			        </div>

			    </div>
			     <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Marks</label>
			            @if( $getStudentMarksData->marks )
			            	<input type="text" class="form-control" name="marks" placeholder="Enter mark" data-parsley-error-message = "Please enter mark here" data-parsley-trigger="change" value="{{ $getStudentMarksData->marks }}" required data-parsley-type="number" data-parsley-length ="[2, 3]">
		            	@else
		            		<input type="text" class="form-control" name="marks" placeholder="Enter mark" data-parsley-error-message = "Please enter mark here" required data-parsley-type="number" data-parsley-trigger="change" data-parsley-length ="[2, 3]">
            			@endif
			        </div>

			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Percentage</label>
			            <!-- @if( $getStudentMarksData )
	                        <select class="form-control chosen-select" name="percentage">
	                            <option value="" disabled="" selected="">Please Select Percentage</option>
	                            {{--*/ $marksPercentage = '0' /*--}}
	                            @for( $marksPercentage = '0'; $marksPercentage < '101'; $marksPercentage++ )
	                                @if( $getStudentMarksData->percentage == $marksPercentage )
	                                    <option value="{{ $marksPercentage }}" selected="">{{ $marksPercentage }}%</option>
	                                @else
	                                    <option value="{{ $marksPercentage }}">{{ $marksPercentage }}%</option>
	                                @endif
	                            @endfor
	                        </select>
                        @else
                            <select class="form-control chosen-select" name="percentage">
                                <option value="" disabled="" selected="">Please Select Percentage</option>
                                {{--*/ $marksPercentage = '0' /*--}}
                                @for( $marksPercentage = '0'; $marksPercentage < '101'; $marksPercentage++ )
                                    <option value="{{ $marksPercentage }}">{{ $marksPercentage }}%</option>
                                @endfor
                            </select>
                        @endif -->
			            @if( $getStudentMarksData->percentage )
			            	<input type="text" class="form-control" name="percentage" placeholder="Enter percentage" data-parsley-error-message = "Please enter percentage here" data-parsley-trigger="change" min="0" max="100" step="0.1" value="{{ $getStudentMarksData->percentage }}"  required >
		            	@else
		            		<input type="text" class="form-control" name="percentage" placeholder="Enter percentage" data-parsley-error-message = "Please enter percentage here"  required  data-parsley-trigger="change" min="0" max="100" step="0.1">
            			@endif
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Marks Type</label>
						<select name="studentMarkType" class="form-control" value="{{ $getStudentMarksData->studentMarkType }}" data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
	                        <option value=""  selected disabled>Select mark type</option>
                            <option value="PCB" @if( $getStudentMarksData->studentMarkType == 'PCB') selected="" @endif>PCB (Physics, Chemistry, Biology)</option>
                            <option value="PCM" @if( $getStudentMarksData->studentMarkType == 'PCM') selected="" @endif>PCB (Physics, Chemistry, Math)</option>
	                        <option value="BEST 4" @if( $getStudentMarksData->studentMarkType == 'BEST 4') selected="" @endif>BEST 4</option>
	                        <option value="BEST 5" @if( $getStudentMarksData->studentMarkType == 'BEST 5') selected="" @endif>BEST 5</option>
	                        <option value="BEST 6" @if( $getStudentMarksData->studentMarkType == 'BEST 6') selected="" @endif>BEST 6</option>
	                        <optgroup label="Bachelor Degree In">
			                    <option value="Art / Design" @if( $getStudentMarksData->studentMarkType == 'Art / Design') selected="" @endif>Art / Design</option>
								<option value="Business / Management" @if( $getStudentMarksData->studentMarkType == 'Business / Management') selected="" @endif>Business / Management </option>
								<option value="Computers / Technology" @if( $getStudentMarksData->studentMarkType == 'Computers / Technology') selected="" @endif>Computers / Technology </option>
								<option value="Criminal Justice / Legal" @if( $getStudentMarksData->studentMarkType == 'Criminal Justice / Legal') selected="" @endif>Criminal Justice / Legal </option>
								<option value="Education / Teaching" @if( $getStudentMarksData->studentMarkType == 'Education / Teaching') selected="" @endif>Education / Teaching </option>
								<option value="Liberal Arts / Humanities" @if( $getStudentMarksData->studentMarkType == 'Liberal Arts / Humanities') selected="" @endif>Liberal Arts / Humanities </option>
								<option value="Nursing / Healthcare" @if( $getStudentMarksData->studentMarkType == 'Nursing / Healthcare') selected="" @endif>Nursing / Healthcare </option>
								<option value="Psychology / Counseling" @if( $getStudentMarksData->studentMarkType == 'Psychology / Counseling') selected="" @endif>Psychology / Counseling </option>
								<option value="Science / Engineering" @if( $getStudentMarksData->studentMarkType == 'Science / Engineering') selected="" @endif>Science / Engineering </option>
								<option value="Trades / Careers" @if( $getStudentMarksData->studentMarkType == 'Trades / Careers') selected="" @endif>Trades / Careers</option>
							</optgroup>
		                    <option value="None Of These" @if( $getStudentMarksData->studentMarkType == 'None Of These') selected="" @endif>None Of These</option>
	                    </select>
			        </div>
			    </div>
			    
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


