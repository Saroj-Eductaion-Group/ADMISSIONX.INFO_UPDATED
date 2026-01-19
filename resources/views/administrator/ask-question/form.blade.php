<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Question : </label>
        <textarea class="form-control summernote question" id="question"  placeholder="Enter description." name="question">@if(isset($askquestion) && $askquestion->question) {{$askquestion->question}} @endif</textarea>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($askquestion) && $askquestion->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($askquestion) && $askquestion->status == 0) selected="" @endif>Inactive</option>
        </select>
    </div>
</div>
<!-- id="videotagmaster-tag_name" -->
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Ask Question Tag : </label>
        @if(isset($askquestion) && $askquestion->askQuestionTagIds)
            {{--*/
                $askQuestionTagArray = explode(',', $askquestion->askQuestionTagIds);                            
            /*--}}
            <select class="form-control chosen-select askQuestionTagIds" name="askQuestionTagIds[]" data-parsley-error-message="Please select ask question tag" multiple="" data-parsley-trigger="change" required="">
                <option value="" disabled="">Please select ask question tag</option>
                @foreach( $askQuestionTagObj as $item )
                    {{--*/ $flagTags = 0; /*--}}
                    @foreach($askQuestionTagArray as $obj)
                        @if( $obj == $item->id )
                            {{--*/ $flagTags = 1; /*--}}
                            <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                            {{--*/ break; /*--}}
                        @endif                                    
                    @endforeach
                    @if($flagTags == 0)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <select multiple="multiple" name="askQuestionTagIds[]" class="form-control chosen-select" data-placeholder="Ask Question Tag" autocomplete="off" data-parsley-error-message="Please select ask question tag" required="">
                <option value="" disabled="">Select Ask Question Tag</option>
                @foreach($askQuestionTagObj as $item)
                    <option value="{{ $item->id }}">{!! $item->name !!}</option>
                @endforeach
            </select>
        @endif
    </div>
</div>
<hr>
<div class="row">
   <div class="col-md-12">
       <div class="headline"><h2>SEO Content</h2></div>
        <input type="hidden" name="seopagename" value="askquestionpage">
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