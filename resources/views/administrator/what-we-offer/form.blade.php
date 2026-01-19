<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Title : </label>
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title here', 'data-parsley-error-message' => 'Please enter Title here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="row padding-bottom20">
    <div class="col-md-12">
        <label>Icon Image : </label>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" name="iconImage" class="iconImage form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload image">
        <p class="text-danger hide" id="iconImage">(please upload .png, .jpg and .jpeg file only)</p>
    </div>
    @if(isset($whatweoffer) && !empty($whatweoffer->iconImage))
    <div class="col-sm-12">
        <img class="img-responsive thumbnail" width="200" src="/whatweoffer/{{ $whatweoffer->iconImage }}" alt="{{ $whatweoffer->iconImage }}">
    </div>
    @endif
</div>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($whatweoffer) && $whatweoffer->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($whatweoffer) && $whatweoffer->status == 0) selected="" @endif>Inactive</option>
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Page URL : </label>
        {!! Form::url('pageurl', null, ['class' => 'form-control', 'placeholder' => 'Enter page url here', 'data-parsley-error-message' => 'Please enter page url here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
        <label class="" >Description : </label>
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here', 'data-parsley-error-message' => 'Please enter description here', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Banner Text : </label>
        {!! Form::text('bannerText', null, ['class' => 'form-control', 'placeholder' => 'Enter banner text here', 'data-parsley-error-message' => 'Please enter banner text here', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="row padding-bottom20">
    <div class="col-md-12">
        <label>Banner Image : </label>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" name="bannerImage" class="bannerImage form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload image">
        <p class="text-danger hide" id="bannerImage">(please upload .png, .jpg and .jpeg file only)</p>
    </div>
    @if(isset($whatweoffer) && !empty($whatweoffer->bannerImage))
    <div class="col-sm-12">
        <img class="img-responsive thumbnail" width="200" src="/whatweoffer/{{ $whatweoffer->bannerImage }}" alt="{{ $whatweoffer->bannerImage }}">
    </div>
    @endif
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>