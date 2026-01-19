<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >College Name : </label>
        <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select college name </option>  
            @foreach( $collegeProfileObj as $college )
                <option value="{{ $college->collegeprofileID }}" @if(isset($collegefaq) && $collegefaq->collegeprofile_id == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Question</label>
        <input type="text" class="form-control" name="question" placeholder="Enter question" required="" data-parsley-error-message="Please enter question" @if(isset($collegefaq) && $collegefaq->question) value="{{  $collegefaq->question }}" @else value="" @endif>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Reference Link</label>
        {!! Form::url('refLinks', null, ['class' => 'form-control', 'placeholder' => 'Enter reference link here', 'data-parsley-error-message' => 'Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)', 'pattern' => '^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$', 'data-parsley-type' => 'url', 'data-parsley-trigger' => 'change']) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Scholarship Description</label>
        <textarea class="form-control summernote" name="answer" rows="8" data-parsley-error-message = "Please enter faq answer" data-parsley-trigger="change">@if(isset($collegefaq) && $collegefaq->answer) {{ $collegefaq->answer or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>