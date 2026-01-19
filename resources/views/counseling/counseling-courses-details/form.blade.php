<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >Stream : </label>
        <select name="functionalarea_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select Stream </option>  
            @foreach ($functionalAreaObj as $functional)
                <option value="{{ $functional->id }}" @if(isset($counselingcoursesdetail) && $counselingcoursesdetail->functionalarea_id == $functional->id) selected="" @endif>{{ $functional->name }}</option>
            @endforeach    
        </select>  
    </div>
</div>

<div class="form-group prevDegreeCheckBox">
    <div class="col-md-12">
        <label class="control-label" >Select eligibility : </label>
        <div class="row">
            @foreach( $eligibilityCriterion as $item )
                <div class="col-md-3">
                @if(isset($counselingCoursesEducationLevelObj))
                    {{--*/ $flag = '0' /*--}}
                    @foreach( $counselingCoursesEducationLevelObj as $key)                                    
                        @if( $key->id == $item->id )
                            <div class="checkbox checkbox-primary checkbox-inline">
                                <input type="checkbox" data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required=""  class="" name="educationlevel_id[]" id="degree{{ $item->id }}" value="{{ $item->id }}" checked="">
                                <label for="degree{{ $item->id }}">{{ $item->name }}</label>
                            </div>
                            {{--*/ $flag = '1' /*--}}
                        @endif
                    @endforeach
                    @if( $flag == '0' )
                        <div class="checkbox checkbox-primary checkbox-inline">
                            <input type="checkbox" data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="" id="degree{{ $item->id }}"  class="" name="educationlevel_id[]" value="{{ $item->id }}">
                            <label for="degree{{ $item->id }}">{{ $item->name }}</label>
                        </div>
                    @endif
                @else
                    <div class="checkbox checkbox-primary checkbox-inline">
                        <input type="checkbox" data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="" id="degree{{ $item->id }}"  class="" name="educationlevel_id[]" value="{{ $item->id }}">
                        <label for="degree{{ $item->id }}">{{ $item->name }}</label>
                    </div>
                @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Title : </label>
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title here', 'data-parsley-error-message' => 'Please enter Title here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Description</label>
        <textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description">@if(isset($counselingcoursesdetail) && $counselingcoursesdetail->description) {{ $counselingcoursesdetail->description or ''}} @endif</textarea>
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
    @if(isset($counselingcoursesdetail) && !empty($counselingcoursesdetail->image))
    <div class="col-sm-12">
        <img class="img-responsive thumbnail" width="200" src="/counselingimages/{{ $counselingcoursesdetail->image }}" alt="{{ $counselingcoursesdetail->image }}">
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12">
        <label>Best Choice Of Course</label>
        <textarea class="form-control summernote bestChoiceOfCourse" id="bestChoiceOfCourse"  placeholder="Enter best choice of course." name="bestChoiceOfCourse">@if(isset($counselingcoursesdetail) && $counselingcoursesdetail->bestChoiceOfCourse) {{ $counselingcoursesdetail->bestChoiceOfCourse or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Jobs Career Opportunity Desc</label>
        <textarea class="form-control summernote jobsCareerOpportunityDesc" id="jobsCareerOpportunityDesc"  placeholder="Enter jobs career opportunity desc." name="jobsCareerOpportunityDesc">@if(isset($counselingcoursesdetail) && $counselingcoursesdetail->jobsCareerOpportunityDesc) {{ $counselingcoursesdetail->jobsCareerOpportunityDesc or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
   <div class="col-md-12">
       <div class="headline"><h2>SEO Content</h2></div>
        <input type="hidden" name="seopagename" value="coursepage">
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