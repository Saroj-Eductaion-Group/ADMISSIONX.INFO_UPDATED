<div class="profile-edit tab-pane fade in active">
	<!-- <h2 class="heading-md text-center">Manage your college profile details</h2> -->
	<br>
	<div class="detail-page-signup">
	{!! Form::model($studentDataObj , ['url' => 'student-profile-partial', 'method' => 'POST', 'class' => 'form-horizontal profileUpdateNow', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
		<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Date Of Birth</label>
				@if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<input type="date" class="form-control" name="dateofbirth" value="{{ $studentData->dateofbirth }}" placeholder="Enter date of birth here" required=""  data-parsley-error-message = "Please enter your date of birth" id="dateChange" data-parsley-trigger="change">
					@endforeach
				@else
					<input type="date" class="form-control" name="dateofbirth" placeholder="Enter date of birth here" required=""  data-parsley-error-message = "Please enter your date of birth" id="dateChange" data-parsley-trigger="change">

				@endif
				<label class="text-primary">Age as on {!! date('d-m-Y') !!} : </label>
				<label class="text-primary calculatedDateFromNow">{{ $calculateDate }}</label>
			</div>
		</div>
		
	    <div class="guradianBlock hide">
	    	<div class="row padding-top5 padding-bottom5">
		        <div class="col-md-12">
		            <label>Parent Name</label>
		            @if( $studentDataObj )
						@foreach(  $studentDataObj as  $studentData )
							<input type="text" class="form-control" name="parentsname" value="{{ $studentData->parentsname }}" placeholder="Enter parent name here"  data-parsley-error-message = "Please enter your parent name" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\s .]*$">
						@endforeach
					@else
						<input type="text" class="form-control" name="parentsname" placeholder="Enter parent name here"  required  data-parsley-error-message = "Please enter your parent name" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z\s .]*$">
					@endif
		        </div>
		    </div>
		    <div class="row padding-top5 padding-bottom5">
				<div class="col-md-12">
					<label>
						Parent Phone No
						<br><span class="text-info">(Please exclude country code before mobile number [For India : +91])</span>
					</label>
					@if( $studentDataObj )
						@foreach(  $studentDataObj as  $studentData )
							<input type="text" class="form-control" name="parentsnumber" value="{{ $studentData->parentsnumber }}" placeholder="Please enter mobile number" data-parsley-type ="digits" data-parsley-error-message = "Please enter valid mobile number" data-parsley-trigger="change"><!--  data-parsley-length="[7, 11]" data-parsley-pattern="^[7-9][0-9]{9}$" -->
						@endforeach
					@else
						<input type="text" class="form-control" name="parentsnumber" placeholder="Please enter mobile number" data-parsley-type ="digits" data-parsley-error-message = "Please enter valid mobile number"  data-parsley-trigger="change">
						<!-- data-parsley-length="[7, 11]" data-parsley-pattern="^[7-9][0-9]{9}$" -->
					@endif
				</div>
			</div>
	    </div>
		<div class="row padding-top5 padding-bottom5">
	        <div class="col-md-12">
	            <label>Gender </label>
	            @if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<select name="gender" class="form-control" value="{{ $studentData->gender }}" data-parsley-error-message=" Please select sex " data-parsley-trigger="change" required="">
                        <option value=""  selected disabled>Select Sex</option>
                        <option @if($studentData->gender == 'Male') selected="" @endif value="Male">Male</option>
                        <option @if($studentData->gender == 'Female') selected="" @endif value="Female">Female</option>
                        <option @if($studentData->gender == 'Other') selected="" @endif value="Other">Other</option>      
                    </select>
					@endforeach
				@else
					<select name="gender" class="form-control chosen-select" data-placeholder="Choose sex ..." data-parsley-error-message=" Please select sex " data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select Sex</option>
                        <option value="" disabled ></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
				@endif
	        </div>
	    </div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Hobbies</label>
				@if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<input type="text" class="form-control" name="hobbies" value="{{ $studentData->hobbies }}" placeholder="Enter hobbies here"  data-parsley-error-message = "Please enter your hobbies" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$">
					@endforeach
				@else
					<input type="text" class="form-control" name="hobbies" placeholder="Enter hobbies here"  data-parsley-error-message = "Please enter your hobbies" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$">
				@endif
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Interest </label>
				@if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<input type="text" class="form-control" name="interests" value="{{ $studentData->interests }}" placeholder="Enter interests here" data-parsley-error-message = "Please enter your interests" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$">
					@endforeach
				@else
					<input type="text" class="form-control" name="interests" placeholder="Enter interests here" data-parsley-error-message = "Please enter your interests" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$">
				@endif
			</div>
		</div>
	
		<div class="row padding-top5 padding-bottom5">
			<!-- <div class="col-md-12">
				<label>Entrance Exam Name </label>
				@if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<input type="text" class="form-control" name="entranceexamname" value="{{ $studentData->entranceexamname }}" placeholder="Enter entrance exam name here" required="" data-parsley-error-message = "Please enter your entrance exam name" data-parsley-trigger="change">
					@endforeach
				@else
					<input type="text" class="form-control" name="entranceexamname" placeholder="Enter entrance exam name here" required="" data-parsley-error-message = "Please enter your entrance exam name" data-parsley-trigger="change">
				@endif
			</div> -->
			<div class="col-md-12">
			<label>Entrance Exam Name </label>
				@if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<select name="entranceexamname" class="form-control chosen-select collegeTypeName">
			                <option value="" selected disabled>Select entrance exam</option> 
			                @foreach ($entranceExamObj as $item)
		                    	@if( $studentData->entranceexamname == $item->id)
			                    	<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
		                    	@else
		                    		<option value="{{ $item->id }}">{{ $item->name }}</option>
	                    		@endif
			                @endforeach
			                <option value="Others">Others</option>
			            </select>
					@endforeach
				@else
					<select name="entranceexamname" class="form-control chosen-select ">
	                    <option value="" selected disabled>Select entrance exam </option>   
	                    @foreach ($entranceExamObj as $entrance)
		                    <option value="{{ $entrance->id }}">{{ $entrance->name }}</option>
		                @endforeach       
		                <option value="Others">Others</option>
	                </select>
				@endif
				<div class="hide other_entrance_exam_name margin-top10">
                   <input type="text" class="form-control other_entranceexamname" name="other_entranceexamname" placeholder="Please enter entrance exam name here" data-parsley-trigger="change" data-parsley-error-message="Please enter entrance exam name here">
                   <p class="text-danger">Enter the name of the valid entrance exam here. example - (NEET – National Eligibility Cum Entrance Test)</p>
               </div>
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Entrance Exam Number </label>
				@if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<input type="text" class="form-control" name="entranceexamnumber" value="{{ $studentData->entranceexamnumber }}" placeholder="Enter entrance exam number here" data-parsley-minlength="1" data-parsley-maxlength="4" maxlength="4" data-parsley-max="1000" data-parsley-trigger="change" data-parsley-type="digits" data-parsley-error-message = "Please enter valid entrance exam number">
					@endforeach
				@else
					<input type="text" class="form-control" name="entranceexamnumber" placeholder="Enter entrance exam number here"  data-parsley-minlength="1" data-parsley-maxlength="4" maxlength="4" data-parsley-max="1000" data-parsley-trigger="change" data-parsley-type="digits" data-parsley-error-message = "Please enter valid entrance exam number">
				@endif
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Achievement Awards <span class="tooltips hide glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="For multiple achivement / awards please use comma ( , ) separator"></span> <span class="label label-primary hide"> <i class="fa fa-arrow-right"></i> For multiple achivement / awards please use comma ( , ) separator</span></label></label>
				@if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<input type="textarea" class="form-control" name="achievementsawards" value="{{ $studentData->achievementsawards }}" placeholder="Enter achievement awards here" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$" data-parsley-error-message = "Please enter valid achievement awards">
					@endforeach
				@else
					<input type="textarea" class="form-control" name="achievementsawards" placeholder="Enter achievement awards here" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$" data-parsley-error-message = "Please enter valid achievement awards">
				@endif
			</div>
		</div>

		<!-- <div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Projects </label>
				@if( $studentDataObj )
					@foreach(  $studentDataObj as  $studentData )
						<input type="textarea" class="form-control" name="projects" value="{{ $studentData->projects }}" placeholder="Enter projects here" required="" data-parsley-error-message = "Please enter your projects" data-parsley-trigger="change">
					@endforeach
				@else
					<input type="textarea" class="form-control" name="projects" placeholder="Enter projects here" required="" data-parsley-error-message = "Please enter your projects" data-parsley-trigger="change">
				@endif
			</div>
		</div> -->

		
		
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12 col-lg-12 text-right">
				<button class="btn-u" type="submit">Submit</button>
			</div>
		</div>
	{!! Form::close() !!}
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
    });
</script>

<script type="text/javascript">
	//AJAX
	$( '.profileUpdateNow' ).submit(function(e) {
		$('.updateProfileBlock').addClass('hide');
  		e.preventDefault();
  		var form = $(this).serialize();
  		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("student-profile-partial") }}',
	        data: form,
	        success: function(data){
	            if( data.code =='200' ){
	            	//window.location.reload();
	            	$('.updateProfileBlock').removeClass('hide');
	            	$('.updateProfileBlock .profileUpdateMessage').html(data.message);
	            	$('#profileUpdate').modal({show: 'true'}); 
	            	setTimeout(function(){
				   		window.location.reload();
					}, 5000);
	            }
	        }
	    });	
	});

	//INPUT BLUR
		$( 'input[name=achievementsawards]' ).focusin(function() {
	  		$('span.label-primary').removeClass('hide');
		});
		$( 'input[name=achievementsawards]' ).focusout(function() {
	  		$('span.label-primary').addClass('hide');
		});
</script>
<script type="text/javascript">
  $(function() {
   // $("#datepicker").datepicker({ dateFormat: 'dd/mm/yy' }).datepicker("setDate", new Date());
  });
</script>
<script type="text/javascript">
	$(document).ready(function(){
	    $('#dateChange').on('change', function(){
			var dateofbirth = $(this).val();
			var HTML = '';
			var year = '';
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            data: { dateofbirth: dateofbirth },
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            url: "{{ URL::to('/getCurrentDateCalculate') }}",
	            success: function(data) {
	            	if( data.code == '200' ){
            			$('.calculatedDateFromNow').text(data.calculateDate);	
            			year = data.year;

           	 			if( year < 18 ){
           	 				// $('input[name=parentsname]').val('');
           	 				// $('input[name=parentsnumber]').val('');
           	 				$('.guradianBlock').removeClass('hide');
           	 				$('input[name=parentsname]').attr('required', 'required');
           	 				$('input[name=parentsnumber]').attr('required', 'required');
            			}else{
            				// $('input[name=parentsname]').val('');
           	 				// $('input[name=parentsnumber]').val('');
            				$('.guradianBlock').addClass('hide');
            				$('input[name=parentsname]').removeAttr('required', '');
           	 				$('input[name=parentsnumber]').removeAttr('required', '');
            			}
            		}else{

            		}
	        		$('.calculatedDateFromNow').text(data.calculateDate);
	            }
	        });
		});
	});
</script>

<script type="text/javascript">
    $('select[name=entranceexamname]').on('change', function(){
        checkRequiredFields($(this).val());
    });

    var other_entranceexamname = $('select[name=entranceexamname]').val();
    checkRequiredFields(other_entranceexamname);

    function checkRequiredFields(entranceexamname) {
        if(entranceexamname == "Others"){
            $('.other_entrance_exam_name').removeClass('hide');
            $('input[name=other_entranceexamname]').attr("required", true);
        }else{
            $('.other_entrance_exam_name').addClass('hide');
            $('input[name=other_entranceexamname]').attr("required", false);
        }
    }

</script>