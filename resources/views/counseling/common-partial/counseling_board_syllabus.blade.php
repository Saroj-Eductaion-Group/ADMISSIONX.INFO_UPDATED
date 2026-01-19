<div class="panel-body">
    <div class="row margin-bottom10">
        <div class="col-md-12">
            <h3 class="text-uppercase text-success">List of {{strtoupper($counselingBoard->name)}} Exam Syllabus</h3>
        </div>
    </div>
    <div class="counslingExamSyllabusSection">
        @foreach($counselingBoardSyllabusObj as $key => $item)
        <div class="clientContactDetails">
            <h4 class="padding-bottom10">{{strtoupper($counselingBoard->name)}} Exam Syllabus<a class="btn btn-outline btn-danger btn-xs removeCounslingExamSyllabus pull-right"><i class="fa fa-remove"></i> Remove</a></h4>
            <div class="row">
                <div class="col-md-6">
                    <label class="">Class</label>
                    <input type="text" name="syllabusClass[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid class name"  id="syllabusClass" placeholder="Please enter class name" value="{{$item->class}}" > 
                </div>
                <div class="col-md-6">
                    <label class="">Subject</label>
                    <input type="text" name="syllabusSubject[]"  class="form-control subject" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subject"  id="syllabusSubject" placeholder="Please enter subject" value="{{$item->subject}}" > 
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-md-12">
                    <label class="">Details</label>
                    <textarea class="form-control description" id="syllabusDescription"  placeholder="Enter description." name="syllabusDescription[]">@if($item->description) {{ $item->description or ''}} @endif</textarea>
                </div>
            </div>
        </div>
        <hr class="hr-line-dashed">
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-3 pull-right margin-top20">
            <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addNewCounslingExamSyllabusRow"><i class="fa fa-plus"></i> Add Exam Syllabus</a>
        </div>
    </div>
</div>
<hr>