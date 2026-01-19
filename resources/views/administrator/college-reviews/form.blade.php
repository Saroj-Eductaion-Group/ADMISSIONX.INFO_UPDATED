<div class="form-group">
    <div class="col-sm-12"><label class="control-label" >College Name : </label></div>
    <div class="col-sm-12">
        <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose college..."  data-parsley-error-message=" Please select college" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select college name </option>  
            @foreach( $collegeProfileObj as $college )
                <option value="{{ $college->collegeprofileID }}" @if(isset($collegereview) && $collegereview->collegeprofile_id == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-sm-12"><label class="control-label" >User Name : </label></div>
    <div class="col-sm-12">
        <select name="guestUserId" class="form-control chosen-select " data-placeholder="Choose user..."  data-parsley-error-message=" Please select user" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select user name </option>  
            @foreach( $userObj as $item )
                <option value="{{ $item->userID }}" @if(isset($collegereview) && $collegereview->guestUserId == $item->userID) selected="" @endif>{{ $item->fullname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <label>Review Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter review title" required="" data-parsley-error-message="Please enter review title" @if(isset($collegereview) && $collegereview->title) value="{{  $collegereview->title }}" @else value="" @endif>
    </div>
    <div class="col-md-4">
        <label>Like & Dislike </label><br>
        <div class="radio radio-success radio-inline">
            <input type="radio" id="FormCreate0" value="1" name="votes" data-parsley-error-message="Please select votes" data-parsley-trigger="change" @if(isset($collegereview) && $collegereview->votes == 1) checked="" @elseif(isset($collegereview) && $collegereview->votes == '2')  @else checked="" @endif>
            <label for="FormCreate0"> <i class="fa fa-thumbs-up"></i> Like </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="FormCreate1" value="2" name="votes" data-parsley-error-message="Please select votes" data-parsley-trigger="change" @if(isset($collegereview) && $collegereview->votes == 2) checked @endif>
             <label for="FormCreate1"><i class="fa fa-thumbs-down"></i> Dislike</label>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-2">
        <label>Academic</label>
        <input type="text" class="form-control" name="academic" placeholder="Enter academic val" required="" data-parsley-error-message="Please enter academic value between 1 to 5 also float value accepted" @if(isset($collegereview) && $collegereview->academic) value="{{ $collegereview->academic }}" @else value="" @endif  min="1" max="5" step="0.1">
    </div>
    <div class="col-md-2">
        <label>Accommodation</label>
        <input type="text" class="form-control" name="accommodation" placeholder="Enter accommodation val" required="" data-parsley-error-message="Please enter accommodation value between 1 to 5 also float value accepted" @if(isset($collegereview) && $collegereview->accommodation) value="{{ $collegereview->accommodation }}" @else value="" @endif  min="1" max="5" step="0.1">
    </div>
    <div class="col-md-2">
        <label>Faculty</label>
        <input type="text" class="form-control" name="faculty" placeholder="Enter faculty val" required="" data-parsley-error-message="Please enter faculty value between 1 to 5 also float value accepted" @if(isset($collegereview) && $collegereview->faculty) value="{{ $collegereview->faculty }}" @else value="" @endif  min="1" max="5" step="0.1">
    </div>
    <div class="col-md-2">
        <label>Infrastructure</label>
        <input type="text" class="form-control" name="infrastructure" placeholder="Enter infrastructure val" required="" data-parsley-error-message="Please enter infrastructure value between 1 to 5 also float value accepted" @if(isset($collegereview) && $collegereview->infrastructure) value="{{ $collegereview->infrastructure }}" @else value="" @endif  min="1" max="5" step="0.1">
    </div>
    <div class="col-md-2">
        <label>Placement</label>
        <input type="text" class="form-control" name="placement" placeholder="Enter placement val" required="" data-parsley-error-message="Please enter placement value between 1 to 5 also float value accepted" @if(isset($collegereview) && $collegereview->placement) value="{{ $collegereview->placement }}" @else value="" @endif  min="1" max="5" step="0.1">
    </div>
    <div class="col-md-2">
        <label>Social</label>
        <input type="text" class="form-control" name="social" placeholder="Enter social val" required="" data-parsley-error-message="Please enter social value between 1 to 5 also float value accepted" @if(isset($collegereview) && $collegereview->social) value="{{ $collegereview->social }}" @else value="" @endif  min="1" max="5" step="0.1">
    </div>
</div>  
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Review Description</label>
        <textarea class="form-control summernote" name="description" rows="8" data-parsley-error-message = "Please enter the review description" data-parsley-trigger="change">@if(isset($collegereview) && $collegereview->description) {{ $collegereview->description or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>