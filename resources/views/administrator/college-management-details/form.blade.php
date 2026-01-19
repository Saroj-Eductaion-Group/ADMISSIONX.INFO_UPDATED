<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >College Name : </label>
        <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select college name </option>  
            @foreach( $collegeProfileObj as $college )
                <option value="{{ $college->collegeprofileID }}" @if(isset($collegemanagementdetail) && $collegemanagementdetail->collegeprofile_id == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <label>Select Title</label>
        <select class="form-control" name="suffix" required="" data-parsley-error-message="Please select an option">
            <option value="" selected="">-- Select an option --</option>
            <option value="Dr." @if(isset($collegemanagementdetail) && $collegemanagementdetail->suffix == 'Dr.') selected="" @endif>Dr.</option>
            <option value="Prof." @if(isset($collegemanagementdetail) && $collegemanagementdetail->suffix == 'Prof.') selected="" @endif>Prof.</option>
            <option value="Mr." @if(isset($collegemanagementdetail) && $collegemanagementdetail->suffix == 'Mr.') selected="" @endif>Mr.</option>
            <option value="Miss" @if(isset($collegemanagementdetail) && $collegemanagementdetail->suffix == 'Miss.') selected="" @endif>Miss</option>
            <option value="Mrs." @if(isset($collegemanagementdetail) && $collegemanagementdetail->suffix == 'Mrs.') selected="" @endif>Mrs.</option>
        </select>
    </div>
    <div class="col-sm-4">
        <label class="control-label" >Contact Person Name : </label>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter contact person name here', 'data-parsley-error-message' => 'Please enter valid contact person name', 'required' => '', 'data-parsley-trigger'=>'change', 'data-parsley-pattern' => '^[a-zA-Z\s .]*$']) !!}
    </div>
    <div class="col-sm-4">
        <label class="control-label" >Designation : </label>
        <input type="text" class="form-control" name="designation" placeholder="Enter designation here" data-parsley-error-message = "Please enter valid designation" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change" @if(isset($collegemanagementdetail) && $collegemanagementdetail->designation) value="{{  $collegemanagementdetail->designation }}" @else value="" @endif>
    </div>
</div>
<hr>
<div class="row padding-bottom20">
    <div class="col-sm-6">
        <label>Gender</label>
        <select class="form-control" name="gender" required="" data-parsley-error-message="Please select an option">
            <option value="" selected="">-- Select an option --</option>
            <option value="1" @if(isset($collegemanagementdetail) && $collegemanagementdetail->gender == 1) selected="" @endif>Male</option>
            <option value="2" @if(isset($collegemanagementdetail) && $collegemanagementdetail->gender == 2) selected="" @endif>Female</option>
            <option value="3" @if(isset($collegemanagementdetail) && $collegemanagementdetail->gender == 3) selected="" @endif>Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Image : </label>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" name="picture" class="picture form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload image">
        <p class="text-danger hide" id="picture">(please upload .png, .jpg and .jpeg file only)</p>
        @if(isset($collegemanagementdetail) && !empty($collegemanagementdetail->picture))
        <div class="row">
            <div class="col-md-6">
                <img class="img-responsive" src="{{asset('gallery/')}}/{{ $collegemanagementdetail->slug }}/{{ $collegemanagementdetail->picture }}" alt="College Banner Image" height="100" width="100">
            </div>
        </div>
        @endif
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <label>Email</label>
        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="emailaddress" placeholder="Enter email address" required="" data-parsley-error-message="Please enter email" @if(isset($collegemanagementdetail) && $collegemanagementdetail->emailaddress) value="{{  $collegemanagementdetail->emailaddress }}" @else value="" @endif>
    </div>
    <div class="col-md-4">
        <label>Phone</label>
        <input type="text" class="form-control" name="phoneno" placeholder="Enter phone number here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid phone number" required="" data-parsley-pattern="^[6-9][0-9]{9}$" maxlength="11" data-parsley-length="[8, 11]" @if(isset($collegemanagementdetail) && $collegemanagementdetail->phoneno) value="{{  $collegemanagementdetail->phoneno }}" @else value="" @endif>
    </div>
    <div class="col-md-4">
        <label>Office No</label>
        <input type="text" class="form-control" name="landlineNo" placeholder="Enter office landline no here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid office landline no" @if(isset($collegemanagementdetail) && $collegemanagementdetail->landlineNo) value="{{  $collegemanagementdetail->landlineNo }}" @else value="" @endif  data-parsley-pattern="^[0-9]{2,4}[-][0-9]{6,8}" maxlength="15" minlength="10">
    </div>
</div>

<hr>
<!-- <div class="row">
    <div class="col-md-12">
        <label>About</label>
        <textarea class="form-control summernote about" id="about"  placeholder="Enter about." name="about">@if(isset($collegemanagementdetail) && $collegemanagementdetail->about) {{ $collegemanagementdetail->about or ''}} @endif</textarea>
    </div>
</div>
<hr> -->
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>