<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >Stream : </label>
        <select name="functionalarea_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select Stream </option>  
            @foreach ($functionalAreaObj as $functional)
                <option value="{{ $functional->id }}" @if(isset($examsection) && $examsection->functionalarea_id == $functional->id) selected="" @endif>{{ $functional->name }}</option>
            @endforeach    
        </select>  
        <input type="hidden" name="name" @if(isset($examsection) && $examsection->name) value="{{$examsection->name}}" @else value="" @endif >   
    </div>
</div>

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
    @if(isset($examsection) && !empty($examsection->iconImage))
    <div class="col-sm-12">
        <img class="img-responsive thumbnail" width="200" src="/examinationicon/{{ $examsection->iconImage }}" alt="{{ $examsection->iconImage }}">
    </div>
    @endif
</div>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($examsection) && $examsection->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($examsection) && $examsection->status == 0) selected="" @endif>Inactive</option>
        </select>
    </div>
</div>
<hr>
@include('common-partials.common-exam-fileds-update-partial')
<hr>
<div class="row">
   <div class="col-md-12">
       <div class="headline"><h2>SEO Content</h2></div>
        <input type="hidden" name="seopagename" value="examsectionpage">
        @if(isset($seocontent) && (sizeof($seocontent) > 0))
            @if(!empty($seocontent[0]->seoContentId))
                <input type="hidden" name="seoContentId" value="{{ $seocontent[0]->seoContentId }}">
            @endif
            @include ('administrator.seo-content.seo-update-partial')
        @else
            @include ('administrator.seo-content.seo-create-partial')
        @endif
   </div> 
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>