<div class="form-group">
    <label class="col-sm-2 control-label" >Page Title : </label>
    <div class="col-sm-10">
        <input type="text" name="pagetitle" class="form-control" data-parsley-error-message="Please enter page title" value="{{ isset($newUpdatedFields) && isset($newUpdatedFields->pagetitle) ? $newUpdatedFields->pagetitle : ''}}">
    </div>
</div>    
<div class="form-group">
    <label class="col-sm-2 control-label" >Page Description : </label>
    <div class="col-sm-10">
        <textarea name="pagedescription" placeholder="Enter page description here"  data-parsley-trigger="change" data-parsley-error-message="Please enter page description" class="summernote">{{ isset($newUpdatedFields) && isset($newUpdatedFields->pagedescription) ? $newUpdatedFields->pagedescription : ''}}</textarea>
    </div>
</div> 

<div class="form-group @if(isset($tablename) && ($tablename == 'state')) hide @elseif(isset($tablename) && ($tablename == 'city')) hide @else @endif">
    <label  class="col-sm-2 control-label">Upload Logo Image</label>
    <div class="col-sm-7">
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="logoimage" class="hide"><i class="fa fa-remove"></i></a> </span>
         <input type="file" name="logoimage" class="logoimage form-control"  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png">                     
    </div>
    @if(isset($newUpdatedFields) && isset($newUpdatedFields->logoimage))
    <div class="col-sm-3">
        <img class="img-thumbnail img-responsive" src="{{ asset('common-logo') }}/{{ $newUpdatedFields->logoimage }}" style="width: 120px; height: 120px; ">
    </div>
    @endif
</div>
<div class="form-group">
    <label  class="col-sm-2 control-label">Upload Banner Image</label>
    <div class="col-sm-10">
        <p class="text-danger">(please upload .png, .jpg and .jpeg file only, but we require weight (1200 to 1400) and height (300 to 400) size image.)</p>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="bannerimage" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" class="form-control bannerimage" name="bannerimage"  data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload only png , jpg or jpeg.">
        @if(isset($newUpdatedFields) && isset($newUpdatedFields->bannerimage))
        <div class="row">
            <div class="col-sm-12">
                <img class="img-thumbnail img-responsive" src="{{ asset('common-banner') }}/{{ $newUpdatedFields->bannerimage }}">
            </div>
        </div>
        @endif
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" >Is Show On Top List: </label>
    <div class="col-sm-10">
        <div class="radio radio-success radio-inline">
            <input type="radio" id="isShowOnTopEnabled" value="1" name="isShowOnTop" required="" data-parsley-error-message="Please select isShowOnTop" data-parsley-trigger="change" @if(isset($newUpdatedFields) && $newUpdatedFields->isShowOnTop == '1') checked=""  @elseif(isset($newUpdatedFields) && $newUpdatedFields->isShowOnTop == '0')  @else checked="" @endif>
            <label for="isShowOnTopEnabled"> Enabled </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="isShowOnTopDisable" value="0" name="isShowOnTop" required="" data-parsley-error-message="Please select isShowOnTop" data-parsley-trigger="change" @if(isset($newUpdatedFields) && $newUpdatedFields->isShowOnTop == 0) checked="" @endif>
            <label for="isShowOnTopDisable"> Disable </label>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" >Is Show On Home : </label>
    <div class="col-sm-10">
        <div class="radio radio-success radio-inline">
            <input type="radio" id="isShowOnHomeEnabled" value="1" name="isShowOnHome" required="" data-parsley-error-message="Please select isShowOnHome" data-parsley-trigger="change" @if(isset($newUpdatedFields) && $newUpdatedFields->isShowOnHome == '1') checked=""  @elseif(isset($newUpdatedFields) && $newUpdatedFields->isShowOnHome == '0')  @else checked="" @endif>
            <label for="isShowOnHomeEnabled"> Enabled </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="isShowOnHomeDisable" value="0" name="isShowOnHome" required="" data-parsley-error-message="Please select isShowOnHome" data-parsley-trigger="change" @if(isset($newUpdatedFields) && $newUpdatedFields->isShowOnHome == 0) checked="" @endif>
            <label for="isShowOnHomeDisable"> Disable </label>
        </div>
    </div>
</div>