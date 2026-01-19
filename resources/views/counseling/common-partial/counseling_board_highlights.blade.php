<div class="panel-body">
    <div class="row margin-bottom10">
        <div class="col-md-12">
            <h3 class="text-uppercase text-info">List of {{strtoupper($counselingBoard->name)}} highlights</h3>
        </div>
    </div>
    <div class="counslingHighlightsSection">
    	@foreach($counselingBoardHighlightObj as $key => $item)
        <div class="clientContactDetails">
            <h4 class="padding-bottom10">{{strtoupper($counselingBoard->name)}} highlights<a class="btn btn-outline btn-danger btn-xs removeCounslingHighlights pull-right"><i class="fa fa-remove"></i> Remove</a></h4>
            <div class="row">
                <div class="col-md-12">
                    <label class="">Title</label>
                    <input type="text" name="highlightsTitle[]"  class="form-control title" data-parsley-trigger="change" data-parsley-error-message="Please enter valid title"  id="highlightstitle" placeholder="Please enter title" value="{{$item->title}}" > 
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-md-12">
                    <label class="">Details</label>
                    <textarea class="form-control description" id="highlightsDescription"  placeholder="Enter description." name="highlightsDescription[]">@if($item->description) {{ $item->description or ''}} @endif</textarea>
                </div>
            </div>
        </div>
        <hr class="hr-line-dashed">
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-3 pull-right margin-top20">
            <a href="javascript:void(0);" class="btn btn-block btn-sm btn-info" id="addNewCounslingHighlightsRow"><i class="fa fa-plus"></i> Add highlights</a>
        </div>
    </div>
</div>
<hr>