<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Slider Title : </label>
        {!! Form::text('sliderTitle', null, ['class' => 'form-control', 'placeholder' => 'Enter slider title here', 'data-parsley-error-message' => 'Please enter slider title here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="row padding-bottom20">
    <div class="col-md-12">
        <label>Slider Image : </label>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" name="sliderImage" class="sliderImage form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload banner image" @if(isset($slidermanager) && !empty($slidermanager->sliderImage)) @else required="" @endif>
        <p class="text-danger hide" id="sliderImage">(please upload .png, .jpg and .jpeg file only)</p>
        <p class="text-danger">(please upload .png, .jpg and .jpeg file only, but we require weight (1300 to 1600) and height (350 to 500) size image.)</p>

    </div>
    @if(isset($slidermanager) && !empty($slidermanager->sliderImage))
    <div class="col-sm-12">
        <img class="img-responsive" src="/slider-image/{{ $slidermanager->sliderImage }}" alt="{{ $slidermanager->sliderImage }}">
    </div>
    @endif
</div>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Bottom Text : </label>
        {!! Form::text('bottomText', null, ['class' => 'form-control', 'placeholder' => 'Enter bottom text here', 'data-parsley-error-message' => 'Please enter bottom text here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Bottom Link : </label>
        {!! Form::url('bottomLink', null, ['class' => 'form-control', 'placeholder' => 'Enter bottom link here', 'data-parsley-error-message' => 'Please enter bottom link here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($slidermanager) && $slidermanager->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($slidermanager) && $slidermanager->status == 0) selected="" @endif>Inactive</option>
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Scroller First Text : </label>
        {!! Form::text('scrollerFirstText', null, ['class' => 'form-control', 'placeholder' => 'Enter scroller first text here', 'data-parsley-error-message' => 'Please enter scroller first text here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label>Is Show College Count</label><br>
        <div class="radio radio-success radio-inline">
            <input type="radio" id="isShowCollegeCountEnabled" value="1" name="isShowCollegeCount" required="" data-parsley-error-message="Please select isShowCollegeCount" data-parsley-trigger="change" @if(isset($slidermanager) && $slidermanager->isShowCollegeCount == '1') checked=""  @elseif(isset($slidermanager) && $slidermanager->isShowCollegeCount == '0')  @else checked="" @endif>
            <label for="isShowCollegeCountEnabled"> Enabled </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="isShowCollegeCountDisable" value="0" name="isShowCollegeCount" required="" data-parsley-error-message="Please select isShowCollegeCount" data-parsley-trigger="change" @if(isset($slidermanager) && $slidermanager->isShowCollegeCount == 0) checked="" @endif>
            <label for="isShowCollegeCountDisable"> Disable </label>
        </div>
    </div>
    <div class="col-md-3">
        <label>Is Show Exam Count</label><br>
        <div class="radio radio-success radio-inline">
            <input type="radio" id="isShowExamCountEnabled" value="1" name="isShowExamCount" required="" data-parsley-error-message="Please select isShowExamCount" data-parsley-trigger="change" @if(isset($slidermanager) && $slidermanager->isShowExamCount == '1') checked=""  @elseif(isset($slidermanager) && $slidermanager->isShowExamCount == '0')  @else checked="" @endif>
            <label for="isShowExamCountEnabled"> Enabled </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="isShowExamCountDisable" value="0" name="isShowExamCount" required="" data-parsley-error-message="Please select isShowExamCount" data-parsley-trigger="change" @if(isset($slidermanager) && $slidermanager->isShowExamCount == 0) checked="" @endif>
            <label for="isShowExamCountDisable"> Disable </label>
        </div>
    </div>
    <div class="col-md-3">
        <label>Is Show Course Count</label><br>
        <div class="radio radio-success radio-inline">
            <input type="radio" id="isShowCourseCountEnabled" value="1" name="isShowCourseCount" required="" data-parsley-error-message="Please select isShowCourseCount" data-parsley-trigger="change" @if(isset($slidermanager) && $slidermanager->isShowCourseCount == '1') checked=""  @elseif(isset($slidermanager) && $slidermanager->isShowCourseCount == '0')  @else checked="" @endif>
            <label for="isShowCourseCountEnabled"> Enabled </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="isShowCourseCountDisable" value="0" name="isShowCourseCount" required="" data-parsley-error-message="Please select isShowCourseCount" data-parsley-trigger="change" @if(isset($slidermanager) && $slidermanager->isShowCourseCount == 0) checked="" @endif>
            <label for="isShowCourseCountDisable"> Disable </label>
        </div>
    </div>
    <div class="col-md-3">
        <label>Is Show Blog Count</label><br>
        <div class="radio radio-success radio-inline">
            <input type="radio" id="isShowBlogCountEnabled" value="1" name="isShowBlogCount" required="" data-parsley-error-message="Please select isShowBlogCount" data-parsley-trigger="change" @if(isset($slidermanager) && $slidermanager->isShowBlogCount == '1') checked=""  @elseif(isset($slidermanager) && $slidermanager->isShowBlogCount == '0')  @else checked="" @endif>
            <label for="isShowBlogCountEnabled"> Enabled </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="isShowBlogCountDisable" value="0" name="isShowBlogCount" required="" data-parsley-error-message="Please select isShowBlogCount" data-parsley-trigger="change" @if(isset($slidermanager) && $slidermanager->isShowBlogCount == 0) checked="" @endif>
            <label for="isShowBlogCountDisable"> Disable </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Scroller Last Text : </label>
        {!! Form::text('scrollerLastText', null, ['class' => 'form-control', 'placeholder' => 'Enter scroller last text here', 'data-parsley-error-message' => 'Please enter scroller last text here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>