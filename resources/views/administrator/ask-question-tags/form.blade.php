<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Tag Name : </label>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter tag name here', 'data-parsley-error-message' => 'Please enter tag name here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>

<hr>
<div class="row">
   <div class="col-md-12">
       <div class="headline"><h2>SEO Content</h2></div>
        <input type="hidden" name="seopagename" value="asktagpage">
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
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>