<div class="row">
    <div class="col-md-3">
        <label>Select Page</label>
        <select class="form-control slug_page" name="slug" data-parsley-trigger="change" data-parsley-error-message="Please select page" required="">
            <option value="" selected="" disabled="">-- Please select an option --</option>
            <option value="1" @if( $slug == 1) selected="" @endif>Home Page</option>
            <option value="2" @if( $slug == 2) selected="" @endif>Search Page</option>
            <option value="3" @if( $slug == 3) selected="" @endif>College Detail Page</option>
        </select>
    </div>
    <div class="col-md-3">
        <label>Banner Image</label>
        <input type="file" class="form-control" name="img">
        @if(!empty($img))
        <div class="margin-top20">
            <a href="{{ asset('assets/ads-banner/'.$img) }}" title="_blank">
                <img src="{{ asset('assets/ads-banner/'.$img) }}" style="max-width: 100%; max-height: 100px;">
            </a>
        </div>
        <input type="hidden" name="old_img" value="{{ $img}}">
        @endif
    </div>
    <div class="col-md-3">
        <label>Website AD Status</label>
        <br>
        <div class="radio radio-success radio-inline">
            <input type="radio" id="optionsRadios2" value="1" name="isactive" data-parsley-error-message="Please select status" data-parsley-trigger="change" @if( $isactive == 1 ) checked="" @endif>
            <label for="optionsRadios2"> Active </label>
        </div>
        <div class="radio radio-danger radio-inline">
            <input type="radio" id="optionsRadios1" value="0" name="isactive" data-parsley-error-message="Please select status" data-parsley-trigger="change" @if( $isactive == 0 ) checked="" @endif>
             <label for="optionsRadios1">Inactive</label>
        </div>
    </div>
    <div class="col-md-3">
        <label>Ads Position</label>
        <br>
        {{-- <select style="width: 100%;" class="form-control" name="ads_position" required="" data-parsley-error-message="Please select an option">
            <option value="" selected="" disabled>-- Select an option --</option>
            <option value="default" @if((isset($ads_position)) && $ads_position == "default")) selected="" @else selected="" @endif>Default</option>
            <option value="sidebar" @if((isset($ads_position)) && $ads_position == "sidebar")) selected="" @endif>Sidebar</option>
        </select> --}}

        <div class="radio radio-success radio-inline ads_position_1">
            <input type="radio" id="ads_position_1" value="default" name="ads_position" data-parsley-error-message="Please select ads position" data-parsley-trigger="change" @if((isset($ads_position)) && $ads_position == "default")) checked="" @else checked="" @endif>
            <label for="ads_position_1"> Default </label>
        </div>
        <div class="radio radio-danger radio-inline ads_position_2">
            <input type="radio" id="ads_position_2" value="sidebar" name="ads_position" data-parsley-error-message="Please select ads position" data-parsley-trigger="change" @if((isset($ads_position)) && $ads_position == "sidebar")) checked="" @endif>
             <label for="ads_position_2">Sidebar</label>
        </div>
    </div>
</div>

<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-4">
        <label>Redirect To</label>
        <input type="text" class="form-control" name="redirectto" placeholder="Enter redirect url" required="" data-parsley-error-message="Please enter redirect url" value="{{ $redirectto }}">
    </div>
    <div class="col-md-8">
        <label>Start To End</label>
        <div class="form-group">
            <div class="input-daterange input-group">
                <input type="text" class="form_datetime_pick form-control" name="start" value="{{ date('m/d/Y h:i A', strtotime($start)) }}" placeholder="Select start date" data-parsley-trigger="change" data-parsley-error-message="Please select start date" required="">
                <span class="input-group-addon">to</span>
                <input type="text" class="form_datetime_pick form-control" name="end" value="{{ date('m/d/Y h:i A', strtotime($end)) }}" placeholder="Select end date" data-parsley-trigger="change" data-parsley-error-message="Please select end date" required="">
            </div>
        </div>
    </div>
</div>

<hr class="hr-line-dashed">
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>