<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">Manage your college cut offs details</a></h2>
		<div>
			<form method="POST" action="/college-cut-offs-update" data-parsley-validate>
				<input type="hidden" name="collegeCutOffId" value="{{ $collegeCutOffsDataObj->collegeCutOffId }}">
				<input type="hidden" name="slugUrl" value="{{ $collegeCutOffsDataObj->slug }}">
				<div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Title</label>
			            @if( $collegeCutOffsDataObj->title )
			            	<input type="text" class="form-control" name="title" placeholder="Enter cut offs title here" data-parsley-trigger="change" data-parsley-error-message="Please enter cut offs title here" required="" value="{{$collegeCutOffsDataObj->title}}">
		            	@else
		            		<input type="text" class="form-control" name="title" placeholder="Enter cut offs title here" data-parsley-trigger="change" data-parsley-error-message="Please enter cut offs title here" required="">
            			@endif
			        </div>
			    </div>
		     	<div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12"><label>Stream</label></div>
			    	<div class="col-md-12">
			            <select name="functionalarea_id" class="form-control chosen-select " data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select stream</option>   
		                    @foreach ($functionalAreaObj as $functional)
		                    	@if( $collegeCutOffsDataObj->functionalarea_id == $functional->id )
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
		                    	@if( $collegeCutOffsDataObj->degree_id == $degree->id )
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
			            <select name="course_id" class="form-control chosen-select " data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select course </option>   
		                    @foreach ($courseObj as $course)
		                    	@if( $collegeCutOffsDataObj->course_id == $course->id )
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
			            <select name="coursetype_id" class="form-control chosen-select " data-parsley-error-message=" Please select course type" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select course type</option>   
		                    @foreach ($courseTypeObj as $courseType)
		                    	@if( $collegeCutOffsDataObj->coursetype_id == $courseType->id )
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
			            <select name="educationlevel_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree level" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select degree level</option>   
		                    @foreach ($educationLevelObj as $education)
		                    	@if( $collegeCutOffsDataObj->educationlevel_id == $education->id)
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
	                	@if( $collegeCutOffsDataObj->description )
			            	<textarea class="form-control summernote" rows="4" placeholder="Enter the description" name="description">{{ $collegeCutOffsDataObj->description }}</textarea>
		            	@else
		            		<textarea class="form-control summernote" rows="4" placeholder="Enter the description" name="description"></textarea>
	            		@endif
	                	 
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