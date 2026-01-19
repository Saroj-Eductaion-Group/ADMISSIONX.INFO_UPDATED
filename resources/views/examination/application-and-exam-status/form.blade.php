<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Name : </label>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter name here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Misc : </label>
        <select class="form-control chosen-select" name="misc" data-parsley-error-message=" Please select misc" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select misc</option>
            <option value="Application" @if(isset($applicationandexamstatus) && $applicationandexamstatus->misc == 'Application') selected="" @endif>Application</option>
            <option value="Examination" @if(isset($applicationandexamstatus) && $applicationandexamstatus->misc == 'Examination') selected="" @endif>Examination</option>
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($applicationandexamstatus) && $applicationandexamstatus->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($applicationandexamstatus) && $applicationandexamstatus->status == 0) selected="" @endif>Inactive</option>
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>