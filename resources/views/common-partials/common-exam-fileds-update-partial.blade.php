<div class="row">
    <div class="col-md-12">
        <label class="" >Is Show On Top Menu List: </label>
        <div class="radio radio-success radio-inline">
            <input type="radio" id="isShowOnTopEnabled" value="1" name="isShowOnTop" required="" data-parsley-error-message="Please select isShowOnTop" data-parsley-trigger="change" @if(isset($newUpdatedFields) && $newUpdatedFields->isShowOnTop == '1') checked="" @endif>
            <label for="isShowOnTopEnabled"> Enabled </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="isShowOnTopDisable" value="0" name="isShowOnTop" required="" data-parsley-error-message="Please select isShowOnTop" data-parsley-trigger="change" @if(isset($newUpdatedFields) && $newUpdatedFields->isShowOnTop == '1')  @elseif(isset($newUpdatedFields) && $newUpdatedFields->isShowOnTop == '0') checked="" @else checked="" @endif>
            <label for="isShowOnTopDisable"> Disable </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label class="" >Is Show On Exam Page : </label>
        <div class="radio radio-success radio-inline">
            <input type="radio" id="isShowOnHomeEnabled" value="1" name="isShowOnHome" required="" data-parsley-error-message="Please select isShowOnHome" data-parsley-trigger="change" @if(isset($newUpdatedFields) && $newUpdatedFields->isShowOnHome == '1') checked="" @endif>
            <label for="isShowOnHomeEnabled"> Enabled </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="isShowOnHomeDisable" value="0" name="isShowOnHome" required="" data-parsley-error-message="Please select isShowOnHome" data-parsley-trigger="change" @if(isset($newUpdatedFields) && $newUpdatedFields->isShowOnHome == '1')  @elseif(isset($newUpdatedFields) && $newUpdatedFields->isShowOnHome == '0') checked="" @else checked="" @endif>
            <label for="isShowOnHomeDisable"> Disable </label>
        </div>
    </div>
</div>