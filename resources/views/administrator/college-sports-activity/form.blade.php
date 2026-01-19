<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >College Name : </label>
        <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select college name </option>  
            @foreach( $collegeProfileObj as $college )
                <option value="{{ $college->collegeprofileID }}" @if(isset($collegesportsactivity) && $collegesportsactivity->collegeprofile_id == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12"><label>Type Of Activity</label></div>
    <div class="col-md-12">
        <select name="typeOfActivity" class="form-control chosen-select " data-parsley-error-message=" Please select type of activity" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select Type Of Activity</option>
            <option value="1" @if(isset($collegesportsactivity) && $collegesportsactivity->typeOfActivity == 1) selected="" @endif>Outdoor Sports</option>   
            <option value="2" @if(isset($collegesportsactivity) && $collegesportsactivity->typeOfActivity == 2) selected="" @endif>Indoor Sports</option>   
            <option value="3" @if(isset($collegesportsactivity) && $collegesportsactivity->typeOfActivity == 3) selected="" @endif>Co-curricular Activity</option>     
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12"><label>Sport & Activity Name</label></div>
    <div class="col-md-12">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Please enter activity name', 'data-parsley-error-message' => 'Please enter activity name', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>