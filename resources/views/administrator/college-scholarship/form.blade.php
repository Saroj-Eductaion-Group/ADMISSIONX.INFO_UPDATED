<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >College Name : </label>
        <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select college name </option>  
            @foreach( $collegeProfileObj as $college )
                <option value="{{ $college->collegeprofileID }}" @if(isset($collegescholarship) && $collegescholarship->collegeprofile_id == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Scholarship Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter scholarship title" required="" data-parsley-error-message="Please enter scholarship title" @if(isset($collegescholarship) && $collegescholarship->title) value="{{  $collegescholarship->title }}" @else value="" @endif>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Scholarship Description</label>
        <textarea class="form-control summernote" name="description" rows="8" data-parsley-error-message = "Please enter the scholarship description" data-parsley-trigger="change">@if(isset($collegescholarship) && $collegescholarship->description) {{ $collegescholarship->description or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>