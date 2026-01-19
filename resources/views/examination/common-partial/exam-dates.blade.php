<form class="margin-top20" method="post" action="/update/exam-dates/{{$examId}}" data-parsley-validate="">
	<div class="row">
		<div class="col-md-12">
			<label>Description of exam dates</label>
	        <textarea class="form-control summernote examDates" id="examDates"  placeholder="Enter description." name="examDates">@if(isset($examinationDetailsObj) && $examinationDetailsObj->examDates) {{ $examinationDetailsObj->examDates or ''}} @endif</textarea>
	        <input type="hidden" name="examDetailId" value="{{ $examinationDetailsObj->id}}">
	    </div>
	</div>

	<hr>
	<div class="row margin-bottom10">
	    <div class="col-md-10">
	        <h3 class="text-uppercase text-success">List of exam dates</h3>
	    </div>
	    <div class="col-md-2">
	        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addExamDatesRow"><i class="fa fa-plus"></i> Add exam dates</a>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-12">
	        <table class="table table-bordered table-hover">
	            <thead>
	                <tr>
	                    <th>Event Date</th>
	                    <th>Event Name</th>
	                    <th>Event Status</th>
	                    <th>Degree Name</th>
	                    <th>Action</th>
	                </tr>
	            </thead>
	            <tbody class="tableExamDatesSection">
	            	@foreach($examDatesObj as $item)
                        <tr>
		                    <td>
		                        <input type="text" class="form-control" value="{{$item->eventDate}}" name="eventDate[]" placeholder="event date">
		                    </td>
		                    <td>
		                        <input type="text" class="form-control" value="{{$item->eventName}}" name="eventName[]" placeholder="event name">
		                    </td>
		                    <td>
		                        <select name="eventStatus[]" class="form-control event status" data-parsley-error-message="Please select event status">
		                            <option value="" selected="">--Select event status--</option>
		                            <option value="1" @if( $item->eventStatus == 1) selected="" @endif>Ongoing</option>
		                            <option value="2" @if( $item->eventStatus == 2) selected="" @endif>Upcoming</option>
		                            <option value="3" @if( $item->eventStatus == 3) selected="" @endif>Closed</option>
		                        </select>
		                    </td>
		                    <td>
		                        <select class="form-control text-capitalize" required="" name="degreeId[]" data-parsley-error-message="Please select degree name">
					                <option disabled="" selected="">Please select</option>
					                @foreach( $examDegreeObj as $degree )
					                	<option value="{{ $degree->degreeId }}"  @if($item->degreeId == $degree->degreeId) selected="" @endif>{{ $degree->degreeName }}</option>
					                @endforeach
					            </select>
		                    </td>
		                    <td>
		                        <a class="btn btn-outline btn-danger btn-xs removeExamDatesRow"><i class="fa fa-remove"></i> Remove</a>
		                    </td>
		                </tr>
                    @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>
	<hr>
	<div class="col-sm-12 text-center">
		<div class="form-group mb-0 mt-20">
			<button type="submit" class="btn btn-primary fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit</button>
		</div>
	</div>
</form>