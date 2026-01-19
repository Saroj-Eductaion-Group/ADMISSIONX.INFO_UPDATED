<div class="panel-body">
    <div class="row margin-bottom10">
        <div class="col-md-12">
            <h3 class="text-uppercase text-success">List of {{strtoupper($counselingBoard->name)}} Exam Sample Paper</h3>
        </div>
    </div>
    <div class="counslingExamSamplePaperSection">
    	@foreach($counselingBoardSamplePaperObj as $key => $item)
        <div class="clientContactDetails">
            <h4 class="padding-bottom10">{{strtoupper($counselingBoard->name)}} Exam Sample Paper<a class="btn btn-outline btn-danger btn-xs removeCounslingExamSamplePaper pull-right"><i class="fa fa-remove"></i> Remove</a></h4>
            <div class="row">
                <div class="col-md-6">
                    <label class="">Class</label>
                    <input type="text" name="samplePaperClass[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid class name"  id="samplePaperClass" placeholder="Please enter class name" value="{{$item->class}}" > 
                </div>
                <div class="col-md-6">
                    <label class="">Subject</label>
                    <input type="text" name="samplePaperSubject[]"  class="form-control subject" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subject"  id="samplePaperSubject" placeholder="Please enter subject" value="{{$item->subject}}" > 
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-md-12">
                    <label class="">Details</label>
                    <textarea class="form-control description" id="samplePaperDescription"  placeholder="Enter description." name="samplePaperDescription[]">@if($item->description) {{ $item->description or ''}} @endif</textarea>
                </div>
            </div>
        </div>
        <hr class="hr-line-dashed">
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-3 pull-right margin-top20">
            <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addNewCounslingExamSamplePaperRow"><i class="fa fa-plus"></i> Add Exam Sample Paper</a>
        </div>
    </div>
</div>
<hr>