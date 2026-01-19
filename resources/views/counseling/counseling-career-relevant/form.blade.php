<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >Career Intrested : </label>
        <select name="careerInterest" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select Stream </option>  
            @foreach ($counselingCareerInterestObj as $functional)
                <option value="{{ $functional->id }}" @if(isset($counselingcareerrelevant) && $counselingcareerrelevant->careerInterest == $functional->id) selected="" @endif>{{ $functional->functionalAreaName }} : {{ $functional->title }}</option>
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
    <div class="col-sm-12">
    <label class="control-label" >AVG. Salery : </label>
        {!! Form::text('salery', null, ['class' => 'form-control', 'placeholder' => 'Enter avg salery here', 'data-parsley-error-message' => 'Please enter avg salery here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Stream : </label>
        {!! Form::text('stream', null, ['class' => 'form-control', 'placeholder' => 'Enter stream here', 'data-parsley-error-message' => 'Please enter stream here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Mandatory Subject : </label>
        {!! Form::text('mandatorySubject', null, ['class' => 'form-control', 'placeholder' => 'Enter mandatory subject here', 'data-parsley-error-message' => 'Please enter mandatory subject here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Academic Difficulty : </label>
        {!! Form::text('academicDifficulty', null, ['class' => 'form-control', 'placeholder' => 'Enter academic difficulty here', 'data-parsley-error-message' => 'Please enter academic difficulty here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($counselingcareerrelevant) && $counselingcareerrelevant->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($counselingcareerrelevant) && $counselingcareerrelevant->status == 0) selected="" @endif>Inactive</option>
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
    @if(isset($counselingcareerrelevant) && !empty($counselingcareerrelevant->image))
    <div class="col-sm-12">
        <img class="img-responsive thumbnail" width="200" src="/counselingimages/{{ $counselingcareerrelevant->image }}" alt="{{ $counselingcareerrelevant->image }}">
    </div>
    @endif
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Description</label>
        <textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description">@if(isset($counselingcareerrelevant) && $counselingcareerrelevant->description) {{ $counselingcareerrelevant->description or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
       <div class="headline"><h2>SEO Content</h2></div>
        <input type="hidden" name="seopagename" value="careerreleventpage">
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