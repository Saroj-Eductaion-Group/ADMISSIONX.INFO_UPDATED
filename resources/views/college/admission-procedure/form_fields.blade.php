<input type="hidden" name="slug" value="{{ $slug }}">
<div class="row padding-top5 padding-bottom5">
	<div class="col-md-12"><label>Title</label></div>
	<div class="col-md-12">
		<input type="text" class="form-control" name="title" placeholder="Enter cut offs title here" data-parsley-trigger="change" data-parsley-error-message="Please enter cut offs title here" required="" value="{{$getAdmissionProcedureObj->title}}">
	</div>
</div>
<div class="row padding-top5 padding-bottom5">
	<div class="col-md-12"><label>Stream</label></div>
	<div class="col-md-12">
		<select name="functionalarea_id" class="form-control chosen-select " data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select stream</option>   
            @foreach ($functionalAreaObj as $functional)
                <option value="{{ $functional->id }}"  @if(isset($getAdmissionProcedureObj) && $getAdmissionProcedureObj->functionalarea_id == $functional->id) selected="" @endif>{{ $functional->name }}</option>
            @endforeach       
        </select>
	</div>
</div>
<div class="row padding-top5 padding-bottom5">
	<div class="col-md-12"><label>Degree</label></div>
	<div class="col-md-12">
		<select name="degree_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select stream first for degree selection</option>   
            @if(isset($degreeObj) && $getAdmissionProcedureObj->degree_id)
				@foreach($degreeObj as $item)
					<option value="{{ $item->id }}" @if($item->id == $getAdmissionProcedureObj->degree_id) selected="" @endif>{{ $item->name }}</option>
				@endforeach
			@endif
        </select>
	</div>
</div>
<div class="row padding-top5 padding-bottom5">
	<div class="col-md-12"><label>Course</label></div>
	<div class="col-md-12">
		<select name="course_id" class="form-control chosen-select " data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select degree first for course selection</option> 
            @if(isset($courseObj) && $getAdmissionProcedureObj->course_id)
				@foreach($courseObj as $item)
					<option value="{{ $item->id }}" @if($item->id == $getAdmissionProcedureObj->course_id) selected="" @endif>{{ $item->name }}</option>
				@endforeach
			@endif  
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
                <option value="{{ $education->id }}"  @if(isset($getAdmissionProcedureObj) && $getAdmissionProcedureObj->educationlevel_id == $education->id) selected="" @endif>{{ $education->name }}</option>
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
                <option value="{{ $courseType->id }}"  @if(isset($getAdmissionProcedureObj) && $getAdmissionProcedureObj->coursetype_id == $courseType->id) selected="" @endif>{{ $courseType->name }}</option>
            @endforeach       
        </select>
	</div>
</div>
<div class="row padding-top5 padding-bottom5">
    <div class="col-sm-12">
    	<label>Description : </label>
    	 <textarea class="form-control summernote" rows="4" placeholder="Enter the description" name="description">{{$getAdmissionProcedureObj->description}}</textarea>
    </div>
</div>


<hr class="hr-gap">
<div class="row padding-top5 padding-bottom5">
    <div class="col-md-12">
        <div class="headline"><h2>Important Dates</h2></div>
    </div>
</div>
<div class="row margin-bottom10">
    <div class="col-md-10">
        <h3 class="text-uppercase text-success">List of all important dates</h3>
    </div>
    <div class="col-md-2">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addAdmissionDatesRow"><i class="fa fa-plus"></i> Add Important Dates</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Form Date</th>
                    <th>To Date</th>
                    <th>Remove Action</th>
                </tr>
            </thead>
            <tbody class="tableImportantDateSection">
            @if(isset($importantDatesObj))
            @foreach($importantDatesObj as $item)
                <tr>
                    <td><input type="text" class="form-control" name="eventName[]" value="{{ $item->eventName }}" placeholder="Enter event name" data-parsley-error-message=" Please enter event name" data-parsley-trigger="change" required=""></td>
                    <td width="10%"><input type="date" class="form-control" name="fromdate[]" value="{{ $item->fromdate }}" placeholder="Enter form date" data-parsley-error-message=" Please enter form date" data-parsley-trigger="change" required=""></td>
                    <td width="10%"><input type="date" class="form-control" name="todate[]" value="{{ $item->todate }}" placeholder="Enter to date" data-parsley-error-message=" Please enter to date" data-parsley-trigger="change" required=""></td>
                    <td width="10%"><a class="btn btn-outline text-white btn-danger btn-xs removeAdmissionDatesRow"><i class="fa fa-remove"></i> Remove</a></td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
