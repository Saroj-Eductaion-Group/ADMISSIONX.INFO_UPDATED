<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >Stream : </label>
        <select name="functionalarea_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select Stream </option>  
            @foreach ($functionalAreaObj as $functional)
                <option value="{{ $functional->id }}" @if(isset($counselingcareerinterest) && $counselingcareerinterest->functionalarea_id == $functional->id) selected="" @endif>{{ $functional->name }}</option>
            @endforeach    
        </select>  
    </div>
</div>

<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Title : </label>
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title here', 'data-parsley-error-message' => 'Please enter Title here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($counselingcareerinterest) && $counselingcareerinterest->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($counselingcareerinterest) && $counselingcareerinterest->status == 0) selected="" @endif>Inactive</option>
        </select>
    </div>
</div>
<hr>
<div class="row padding-bottom20">
    <div class="col-md-12">
        <label>Image : </label>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" name="image" class="image form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload image">
        <p class="text-danger hide" id="image">(please upload .png, .jpg and .jpeg file only)</p>
    </div>
    @if(isset($counselingcareerinterest) && !empty($counselingcareerinterest->image))
    <div class="col-sm-12">
        <img class="img-responsive thumbnail" width="200" src="/counselingimages/{{ $counselingcareerinterest->image }}" alt="{{ $counselingcareerinterest->image }}">
    </div>
    @endif
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Description</label>
        <textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description">@if(isset($counselingcareerinterest) && $counselingcareerinterest->description) {{ $counselingcareerinterest->description or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>