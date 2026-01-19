<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Name : </label>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter name here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Full Name : </label>
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter full name here', 'data-parsley-error-message' => 'Please enter full name here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <label class="" >Misc : </label>
        <select class="form-control chosen-select" name="misc" data-parsley-error-message=" Please select misc" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select misc</option>
            <option value="National" @if(isset($counselingboard) && $counselingboard->misc == 'National') selected="" @endif>National</option>
            <option value="State" @if(isset($counselingboard) && $counselingboard->misc == 'State') selected="" @endif>State</option>
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($counselingboard) && $counselingboard->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($counselingboard) && $counselingboard->status == 0) selected="" @endif>Inactive</option>
        </select>
    </div>
</div>

<hr>
<div class="row">
   <div class="col-md-12">
       <div class="headline"><h2>SEO Content</h2></div>
        <input type="hidden" name="seopagename" value="boardpage">
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