<div class="profile-edit tab-pane fade in active">
	<div class="detail-page-signup">
	{!! Form::model($collegeDataObj , ['url' => 'college-profile-partial', 'method' => 'POST', 'class' => 'form-horizontal profileUpdateNow', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
		<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Select University</label>
			</div>
			<div class="col-md-12">
				@if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<select name="university_id" class="form-control chosen-select collegeTypeName" data-parsley-trigger="change" data-parsley-error-message="Please select your university" required="">
			                <option value="" selected disabled>Select university</option> 
			                @foreach ($university as $item)
		                    	@if( $collegeData->university_id == $item->id)
			                    	<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
		                    	@else
		                    		<option value="{{ $item->id }}">{{ $item->name }}</option>
	                    		@endif
			                @endforeach
			            </select>
					@endforeach
				@else
					<select name="university_id" class="form-control chosen-select " data-parsley-error-message=" Please select university" data-parsley-trigger="change" required="">
	                    <option value="" selected disabled>Select university</option>   
	                    @foreach ($university as $uniName)
		                    <option value="{{ $uniName->id }}">{{ $uniName->name }}</option>
		                @endforeach       
	                </select>
				@endif
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Select College Type</label>
			</div>
			<div class="col-md-12">
	        	@if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<select name="collegetype_id" class="form-control chosen-select collegeTypeName" data-parsley-trigger="change" data-parsley-error-message="Please select your college type" required="">
			                <option value="" selected disabled>Select college type</option> 
			               <!--  @if( $collegeData->collegeTypeId )
			                    <option value="{{ $collegeData->collegeTypeId }}" selected="">{{ $collegeData->collegeTypeName }}</option>
			                @else
				              	@foreach ($collegeType as $college)
				                    <option value="{{ $college->id }}">{{ $college->name }}</option>
				                @endforeach             
			                @endif -->
			                @foreach ($collegeType as $collegeTyep)
		                    	@if( $collegeData->collegetype_id == $collegeTyep->id)
			                    	<option value="{{ $collegeTyep->id }}" selected="">{{ $collegeTyep->name }}</option>
		                    	@else
		                    		<option value="{{ $collegeTyep->id }}">{{ $collegeTyep->name }}</option>
	                    		@endif
			                @endforeach
			            </select>
					@endforeach
				@else
					<select name="collegetype_id" class="form-control chosen-select " data-parsley-error-message=" Please select college type" data-parsley-trigger="change" required="">
	                    <option value="" selected disabled>Select college type</option>   
	                    @foreach ($collegeType as $college)
		                    <option value="{{ $college->id }}">{{ $college->name }}</option>
		                @endforeach       
	                </select>
				@endif 
			</div>	
		</div>

		<div class="row padding-top5 padding-bottom5">
	        <div class="col-md-12">
	            <label>Website</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="url" class="form-control" name="website" value="{{ $collegeData->website }}" placeholder="Enter url here" required="" data-parsley-type ="url" data-parsley-error-message = "Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)" data-parsley-trigger="change" pattern="^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$">
					@endforeach
				@else
					<input type="url" class="form-control" name="website" placeholder="Enter url here" required data-parsley-type ="url" data-parsley-error-message = "Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)" data-parsley-trigger="change" pattern="^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$">
				@endif
	        </div>
	    </div>

	    
	    <div class="row padding-top5 padding-bottom5">
	    	<div class="col-md-12">
	            <label>Approved By</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
					<select name="approvedBy" class="form-control" value="{{ $collegeData->approvedBy }}" data-parsley-error-message=" Please select approved type " data-parsley-trigger="change">
	                    <option value=""  selected disabled>Select approved type</option>
	                        @if( $collegeData->approvedBy == 'AICTE')
	                            <option selected="" value="AICTE">AICTE</option>
	                            <option value="UGC">UGC</option>
		                        <option value="PCI">PCI</option>
		                        <option value="Others">Others</option>
	                        @elseif( $collegeData->approvedBy == 'UGC')
	                            <option value="AICTE">AICTE</option>
	                            <option selected="" value="UGC">UGC</option>
	                            <option value="PCI">PCI</option>
		                        <option value="Others">Others</option>
		                    @elseif( $collegeData->approvedBy == 'PCI')
	                            <option value="AICTE">AICTE</option>
	                            <option value="UGC">UGC</option>
	                            <option selected="" value="PCI">PCI</option>
		                        <option value="Others">Others</option>
		                    @elseif( $collegeData->approvedBy == 'Others')
	                            <option value="AICTE">AICTE</option>
	                            <option value="UGC">UGC</option>
	                            <option value="PCI">PCI</option>
		                        <option selected="" value="Others">Others</option>
	                        @else( $collegeData->approvedBy == '')
		                        <option value="AICTE">AICTE</option>
		                        <option value="UGC">UGC</option>
		                        <option value="PCI">PCI</option>
		                        <option value="Others">Others</option>
	                        @endif        
	                </select>
	                @endforeach
				@else
					<select name="approvedBy" class="form-control chosen-select " data-parsley-error-message=" Please select approved type" data-parsley-trigger="change" required="">
	                    <option value="" selected disabled>Select approved type</option>   
                        <option value="AICTE">AICTE</option>
                        <option value="UGC">UGC</option>
                        <option value="PCI">PCI</option>
                        <option value="Others">Others</option>      
	                </select>
				@endif 
	        </div>
	    </div>

		<div class="row padding-top5 padding-bottom5">
	        <div class="col-md-12">
	            <label>Established Year</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="text" class="form-control" name="estyear" value="{{ $collegeData->estyear }}" placeholder="Please enter established year" data-parsley-type ="number" data-parsley-error-message = "Please enter correct established year" data-parsley-min="1050" data-parsley-max="{!! date('Y') !!}"  data-parsley-trigger="change">
					@endforeach
				@else
					<input type="text" class="form-control" name="estyear" placeholder="Please enter established year"  required data-parsley-type ="number" data-parsley-error-message = "Please enter correct established year" data-parsley-min="1050" data-parsley-max="{!! date('Y') !!}" data-parsley-trigger="change">
				@endif
	        </div>
	    </div>

	    <div class="row padding-top5 padding-bottom5">
	        <div class="col-md-12">
	            <label>College Code</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="text" class="form-control" name="collegecode" value="{{ $collegeData->collegecode }}" placeholder="Please enter college code"  data-parsley-error-message = "Please enter college code" data-parsley-trigger="change" >
					@endforeach
				@else
					<input type="text" class="form-control" name="collegecode" placeholder="Please enter college code" data-parsley-error-message = "Please enter college code" data-parsley-trigger="change">
				@endif
	        </div>
	    </div>
		
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Contact Person / Administrator Officer Name</label>
				@if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="text" class="form-control" name="contactpersonname" value="{{ $collegeData->contactpersonname }}" placeholder="Please enter contact/administrator name"   data-parsley-error-message = "Please enter contact/administrator name"  data-parsley-trigger="change">
					@endforeach
				@else
					<input type="text" class="form-control" name="contactpersonname" placeholder="Please enter contact/administrator name"   data-parsley-error-message = "Please enter contact/administrator name"  data-parsley-trigger="change">
				@endif
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Contact Person / Administrator Officer Email</label>
				@if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="text" class="form-control" name="contactpersonemail" value="{{ $collegeData->contactpersonemail }}" placeholder="Please enter email address"  data-parsley-error-message = "Please enter valid email address" data-parsley-type="email" data-parsley-trigger="change">
					@endforeach
				@else
					<input type="text" class="form-control" name="contactpersonemail" placeholder="Please enter email address"  data-parsley-error-message = "Please enter valid email address" data-parsley-type="email" data-parsley-trigger="change">
				@endif
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>
					Contact Person / Administrator Officer Phone
					<br><span class="text-info">(Please exclude country code before mobile number [For India : +91])</span>
				</label>
				@if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="text" class="form-control" name="contactpersonnumber" value="{{ $collegeData->contactpersonnumber }}" placeholder="Please enter mobile number"  data-parsley-type ="digits" data-parsley-error-message = "Please enter valid mobile number"   data-parsley-trigger="change" ><!-- data-parsley-length="[7, 11]" maxlength="10" -->
					@endforeach
				@else
					<input type="text" class="form-control" name="contactpersonnumber" placeholder="Please enter mobile number"  data-parsley-type ="digits" data-parsley-error-message = "Please enter valid mobile number"   data-parsley-trigger="change"> <!-- data-parsley-length="[7, 11]" maxlength="10" -->
				@endif
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
	        <div class="col-md-12">
	            <label>Medium of Instruction</label>
	            @if( $collegeDataObj )
					@foreach($collegeDataObj as  $collegeData)
						<input type="text" class="form-control" name="mediumOfInstruction" value="{{ $collegeData->mediumOfInstruction }}" placeholder="Please enter medium Of instruction" data-parsley-error-message = "Please enter correct medium Of instruction" data-parsley-trigger="change">
					@endforeach
				@else
					<input type="text" class="form-control" name="mediumOfInstruction" placeholder="Please enter medium Of instruction" required data-parsley-error-message="Please enter correct medium Of instruction" data-parsley-trigger="change">
				@endif
	        </div>
	    </div>


	    <div class="row padding-top5 padding-bottom5">
	        <div class="col-md-6">
	            <label>Study From</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="text" class="form-control" name="studyForm" value="{{ $collegeData->studyForm }}" placeholder="Please enter which class starts study" data-parsley-error-message="Please enter which class starts study"  data-parsley-trigger="change">
					@endforeach
				@else
					<input type="text" class="form-control" name="studyForm" placeholder="Please enter which class starts study"  required data-parsley-error-message="Please enter which class starts study" data-parsley-trigger="change">
				@endif
	        </div>
	        <div class="col-md-6">
	            <label>Study To</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="text" class="form-control" name="studyTo" value="{{ $collegeData->studyTo }}" placeholder="Please enter which class ends study" data-parsley-error-message="Please enter which class ends study"  data-parsley-trigger="change">
					@endforeach
				@else
					<input type="text" class="form-control" name="studyTo" placeholder="Please enter which class ends study"  required data-parsley-error-message="Please enter which class ends study" data-parsley-trigger="change">
				@endif
	        </div>
	    </div>

	    <div class="row padding-top5 padding-bottom5">
	        <div class="col-md-6">
	            <label>Admission Start Date</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="date" class="form-control" name="admissionStart" value="{{ $collegeData->admissionStart }}" placeholder="Please enter admission start" data-parsley-error-message="Please enter admission start"  data-parsley-trigger="change">
					@endforeach
				@else
					<input type="date" class="form-control" name="admissionStart" placeholder="Please enter admission start"  required data-parsley-error-message="Please enter admission start" data-parsley-trigger="change">
				@endif
	        </div>
	        <div class="col-md-6">
	            <label>Admission End Date</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="date" class="form-control" name="admissionEnd" value="{{ $collegeData->admissionEnd }}" placeholder="Please enter admission end date" data-parsley-error-message="Please enter admission end date"  data-parsley-trigger="change">
					@endforeach
				@else
					<input type="date" class="form-control" name="admissionEnd" placeholder="Please enter admission end date"  required data-parsley-error-message="Please enter admission end date" data-parsley-trigger="change">
				@endif
	        </div>
	    </div>

	    <div class="row padding-top5 padding-bottom5">
	        <div class="col-md-4">
	            <label>CCTV Surveillance</label>
	           	@if( $collegeDataObj )
					@foreach($collegeDataObj as  $collegeData )
					<select name="CCTVSurveillance" class="form-control" value="{{ $collegeData->CCTVSurveillance }}" data-parsley-error-message=" Please select cctv surveillance option" data-parsley-trigger="change">
	                    <option value=""  selected disabled>Select cctv surveillance option</option>
                        <option @if( $collegeData->CCTVSurveillance == '1') selected="" @endif value="1">Yes</option>
                        <option @if( $collegeData->CCTVSurveillance == '0') selected="" @endif value="0">No</option>
	                </select>
	                @endforeach
				@else
					<select name="CCTVSurveillance" class="form-control chosen-select " data-parsley-error-message=" Please select cctv surveillance option" data-parsley-trigger="change" required="">
	                    <option value="" selected disabled>Select cctv surveillance option</option>   
                        <option value="1">Yes</option>
                        <option value="0">No</option>
	                </select>
				@endif 
	        </div>
	        <div class="col-md-4">
	            <label>AC Campus</label>
	           	@if( $collegeDataObj )
					@foreach($collegeDataObj as  $collegeData )
					<select name="ACCampus" class="form-control" value="{{ $collegeData->ACCampus }}" data-parsley-error-message=" Please select ac campus option" data-parsley-trigger="change">
	                    <option value=""  selected disabled>Select ac campus option</option>
                        <option @if( $collegeData->ACCampus == '1') selected="" @endif value="1">Yes</option>
                        <option @if( $collegeData->ACCampus == '0') selected="" @endif value="0">No</option>
	                </select>
	                @endforeach
				@else
					<select name="ACCampus" class="form-control chosen-select " data-parsley-error-message=" Please select ac campus option" data-parsley-trigger="change" required="">
	                    <option value="" selected disabled>Select ac campus option</option>   
                        <option value="1">Yes</option>
                        <option value="0">No</option>
	                </select>
				@endif 
	        </div>
	        <div class="col-md-4">
	            <label>Total No Of Students</label>
	            @if( $collegeDataObj )
					@foreach(  $collegeDataObj as  $collegeData )
						<input type="text" class="form-control" name="totalStudent" value="{{ $collegeData->totalStudent }}" placeholder="Please enter no of students" data-parsley-type ="number" data-parsley-error-message = "Please enter correct no of students" data-parsley-min="1"  data-parsley-trigger="change">
					@endforeach
				@else
					<input type="text" class="form-control" name="totalStudent" placeholder="Please enter no of students"  required data-parsley-type ="number" data-parsley-error-message = "Please enter correct no of students" data-parsley-min="1" data-parsley-trigger="change">
				@endif
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

{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
  $('form').parsley();
</script>

<script type="text/javascript">
    // $(document).ready(function(){
    //     var config = {
    //         '.chosen-select'           : {},
    //         '.chosen-select-deselect'  : {allow_single_deselect:true},
    //         '.chosen-select-no-single' : {disable_search_threshold:10},
    //         '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
    //         '.chosen-select-width'     : {width:"100%"}
    //         }
    //     for (var selector in config) {
    //         $(selector).chosen(config[selector]);
    //     }
    // });
</script>

<script type="text/javascript">
	//AJAX
	$( '.profileUpdateNow' ).submit(function(e) {
		$('.updateProfileBlock').addClass('hide');
  		e.preventDefault();
  		var form = $(this).serialize();
  		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("college-profile-partial") }}',
	        data: form,
	        success: function(data){
	            if( data.code =='200' ){
	            	$('#updateDescNow').addClass('hide');
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
</script>