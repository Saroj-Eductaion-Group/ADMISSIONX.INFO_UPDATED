<div class="row">
	<div class="col-md-12">
		<label>Title</label>
		<input id="examtitle" name="examtitle" class="form-control examtitle" type="text" @if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->title) value="{{ $counselingBoardDetailObj->title or ''}}" @else value="" @endif  placeholder="Please title"  data-parsley-error-message="Please title">
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Description</label>
        <textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->description) {{ $counselingBoardDetailObj->description or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Logo Image</label>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" name="image" class="image form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload image">
        <p class="text-danger hide" id="image">(please upload .png, .jpg and .jpeg file only)</p>
	    @if(isset($counselingBoardDetailObj) && !empty($counselingBoardDetailObj->image))
	        <img class="img-responsive thumbnail" width="200" src="/counselingimages/{{ $counselingBoardDetailObj->image }}" alt="{{ $counselingBoardDetailObj->image }}">
	    @endif
	</div>
</div>
<hr>
@include('counseling.common-partial.counseling_board_highlights')
@include('counseling.common-partial.counseling_board_imp_dates')
@include('counseling.common-partial.counseling_board_latest_updates')
<hr>
<div class="row">
	<div class="col-md-12">
		<label>About {{strtoupper($counselingBoard->name)}} Board</label>
        <textarea class="form-control summernote aboutBoard" id="aboutBoard"  placeholder="Enter about Board." name="aboutBoard">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->aboutBoard) {{ $counselingBoardDetailObj->aboutBoard or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Admission Process Descibe</label>
        <textarea class="form-control summernote admissionDesc" id="admissionDesc"  placeholder="Enter admission process descibe." name="admissionDesc">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->admissionDesc) {{ $counselingBoardDetailObj->admissionDesc or ''}} @endif</textarea>
    </div>
</div>
<hr>
@include('counseling.common-partial.counseling_board_admission_dates')
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Board Details</label>
        <textarea class="form-control summernote boardDesc" id="boardDesc"  placeholder="Enter board details." name="boardDesc">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->boardDesc) {{ $counselingBoardDetailObj->boardDesc or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Syllabus Details</label>
        <textarea class="form-control summernote syllabusDesc" id="syllabusDesc"  placeholder="Enter syllabus details." name="syllabusDesc">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->syllabusDesc) {{ $counselingBoardDetailObj->syllabusDesc or ''}} @endif</textarea>
    </div>
</div>
<hr>
@include('counseling.common-partial.counseling_board_syllabus')
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Sample Paper Details</label>
        <textarea class="form-control summernote samplePaper" id="samplePaper"  placeholder="Enter sample paper details." name="samplePaper">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->samplePaper) {{ $counselingBoardDetailObj->samplePaper or ''}} @endif</textarea>
    </div>
</div>
<hr>
@include('counseling.common-partial.counseling_board_sample_papers')
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Admit Card Details</label>
        <textarea class="form-control summernote admitCardDetails" id="admitCardDetails"  placeholder="Enter admit card details." name="admitCardDetails">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->admitCardDetails) {{ $counselingBoardDetailObj->admitCardDetails or ''}} @endif</textarea>
    </div>
</div>
<hr>
@include('counseling.common-partial.counseling_board_exam_dates')
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Prepration Tips</label>
        <textarea class="form-control summernote preprationTips" id="preprationTips"  placeholder="Enter prepration tips." name="preprationTips">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->preprationTips) {{ $counselingBoardDetailObj->preprationTips or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Result Details</label>
        <textarea class="form-control summernote resultDesc" id="resultDesc"  placeholder="Enter result details." name="resultDesc">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->resultDesc) {{ $counselingBoardDetailObj->resultDesc or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Entrance Exam Details</label>
        <textarea class="form-control summernote entranceExam" id="entranceExam"  placeholder="Enter entrance exam details." name="entranceExam">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->entranceExam) {{ $counselingBoardDetailObj->entranceExam or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Choose Right College Details</label>
        <textarea class="form-control summernote chooseRightCollege" id="chooseRightCollege"  placeholder="Enter choose right college details." name="chooseRightCollege">@if(isset($counselingBoardDetailObj) && $counselingBoardDetailObj->chooseRightCollege) {{ $counselingBoardDetailObj->chooseRightCollege or ''}} @endif</textarea>
    </div>
</div>
<hr>
