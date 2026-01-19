<div class="col-md-3">                                    
    <h4 for="usr">Is Show On Top Page<span class="pull-right"><a href="javascript:void(0);" id="isShowOnTopStatus" class="hide"><i class="fa fa-remove"></i></a></span></h4>
   <select name="isShowOnTop" class="form-control isShowOnTopSearch chosen-select" data-placeholder="Choose isShowOnTop ..."  data-parsley-error-message=" Please select isShowOnTop " data-parsley-trigger="change" >
        <option value="" selected disabled >Select status</option>
        <option value="1" @if(Request::get('isShowOnHome') == '1') selected="" @endif>Enable</option>
        <option value="0" @if(Request::get('isShowOnHome') == '0') selected="" @endif>Disabled</option>
    </select> 
</div>
<div class="col-md-3">                                    
    <h4 for="usr">Is Show On Exam Page<span class="pull-right"><a href="javascript:void(0);" id="isShowOnHomeStatus" class="hide"><i class="fa fa-remove"></i></a></span></h4>
   <select name="isShowOnHome" class="form-control isShowOnHomeSearch chosen-select" data-placeholder="Choose isShowOnHome ..."  data-parsley-error-message=" Please select isShowOnHome " data-parsley-trigger="change" >
        <option value="" selected disabled >Select status</option>
        <option value="1"  @if(Request::get('isShowOnHome') == '1') selected="" @endif>Enable</option>
        <option value="0" @if(Request::get('isShowOnHome') == '0') selected="" @endif>Disabled</option>
    </select>                              
</div>  