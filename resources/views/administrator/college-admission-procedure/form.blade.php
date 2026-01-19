<div class="form-group">
    <div class="col-sm-12"><label class="control-label" >College Name : </label></div>
    <div class="col-sm-12">
        <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select college name </option>  
            @foreach( $collegeProfileObj as $college )
                <option value="{{ $college->collegeprofileID }}" @if(isset($collegeadmissionprocedure) && $collegeadmissionprocedure->collegeprofile_id == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Admission Procedure Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter admission procedure title" required="" data-parsley-error-message="Please enter admission procedure title" @if(isset($collegeadmissionprocedure) && $collegeadmissionprocedure->title) value="{{  $collegeadmissionprocedure->title }}" @else value="" @endif>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12"><label>Stream</label></div>
    <div class="col-md-12">
        <select name="functionalarea_id" class="form-control chosen-select " data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select stream</option>   
            @foreach ($functionalAreaObj as $functional)
                <option value="{{ $functional->id }}" @if(isset($collegeadmissionprocedure) && $collegeadmissionprocedure->functionalarea_id == $functional->id) selected="" @endif>{{ $functional->name }}</option>
            @endforeach       
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12"><label>Degree</label></div>
    <div class="col-md-12">
        <select name="degree_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select degree</option>   
            @if(isset($degreeObj))
                @foreach ($degreeObj as $degree)
                    <option value="{{ $degree->id }}" @if(isset($collegeadmissionprocedure) && $collegeadmissionprocedure->degree_id == $degree->id) selected="" @endif>{{ $degree->name }}</option>
                @endforeach       
            @endif
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12"><label>Course</label></div>
    <div class="col-md-12">
        <select name="course_id" class="form-control chosen-select " data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select course </option>  
            @if(isset($courseObj)) 
                @foreach ($courseObj as $course)
                    <option value="{{ $course->id }}" @if(isset($collegeadmissionprocedure) && $collegeadmissionprocedure->course_id == $course->id) selected="" @endif>{{ $course->name }}</option>
                @endforeach    
            @endif   
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12"><label>Degree Level</label></div>
    <div class="col-md-12">
        <select name="educationlevel_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree level" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select degree level</option>   
            @foreach ($educationLevelObj as $education)
                <option value="{{ $education->id }}" @if(isset($collegeadmissionprocedure) && $collegeadmissionprocedure->educationlevel_id == $education->id) selected="" @endif>{{ $education->name }}</option>
            @endforeach       
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12"><label>Course Type</label></div>
    <div class="col-md-12">
        <select name="coursetype_id" class="form-control chosen-select " data-parsley-error-message=" Please select course type" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select course type</option>   
            @foreach ($courseTypeObj as $courseType)
                <option value="{{ $courseType->id }}" @if(isset($collegeadmissionprocedure) && $collegeadmissionprocedure->coursetype_id == $courseType->id) selected="" @endif>{{ $courseType->name }}</option>
            @endforeach       
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Admission Procedure Description</label>
        <textarea class="form-control summernote" name="description" rows="8" data-parsley-error-message = "Please enter the admission procedure description" data-parsley-trigger="change">@if(isset($collegeadmissionprocedure) && $collegeadmissionprocedure->description) {{ $collegeadmissionprocedure->description or ''}} @endif</textarea>
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
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>