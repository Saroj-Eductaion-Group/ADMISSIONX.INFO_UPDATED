<div class="form-group">
    <div class="col-sm-12"><label class="control-label" >College Name : </label></div>
    <div class="col-sm-12">
        <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select college name </option>  
            @foreach( $collegeProfileObj as $college )
                <option value="{{ $college->collegeprofileID }}" @if(isset($collegecutoff) && $collegecutoff->collegeprofile_id == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Cutoffs Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter Cutoffs title" required="" data-parsley-error-message="Please enter Cutoffs title" @if(isset($collegecutoff) && $collegecutoff->title) value="{{  $collegecutoff->title }}" @else value="" @endif>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12"><label>Stream</label></div>
    <div class="col-md-12">
        <select name="functionalarea_id" class="form-control chosen-select " data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select stream</option>   
            @foreach ($functionalAreaObj as $functional)
                <option value="{{ $functional->id }}" @if(isset($collegecutoff) && $collegecutoff->functionalarea_id == $functional->id) selected="" @endif>{{ $functional->name }}</option>
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
                    <option value="{{ $degree->id }}" @if(isset($collegecutoff) && $collegecutoff->degree_id == $degree->id) selected="" @endif>{{ $degree->name }}</option>
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
                    <option value="{{ $course->id }}" @if(isset($collegecutoff) && $collegecutoff->course_id == $course->id) selected="" @endif>{{ $course->name }}</option>
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
                <option value="{{ $education->id }}" @if(isset($collegecutoff) && $collegecutoff->educationlevel_id == $education->id) selected="" @endif>{{ $education->name }}</option>
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
                <option value="{{ $courseType->id }}" @if(isset($collegecutoff) && $collegecutoff->coursetype_id == $courseType->id) selected="" @endif>{{ $courseType->name }}</option>
            @endforeach       
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Cutoffs Description</label>
        <textarea class="form-control summernote" name="description" rows="8" data-parsley-error-message = "Please enter the Cutoffs description" data-parsley-trigger="change">@if(isset($collegecutoff) && $collegecutoff->description) {{ $collegecutoff->description or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>