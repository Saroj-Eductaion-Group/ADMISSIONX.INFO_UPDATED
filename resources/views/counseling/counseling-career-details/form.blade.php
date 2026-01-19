<div class="row">
    <div class="col-md-12">
        <label>Career Details Title</label>
        <input id="title" name="title" class="form-control" type="text" @if(isset($counselingcareerdetail) && $counselingcareerdetail->title) value="{{ $counselingcareerdetail->title or ''}}" @else value="" @endif  placeholder="Enter Title here"  data-parsley-error-message="Please enter Title here">
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($counselingcareerdetail) && $counselingcareerdetail->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($counselingcareerdetail) && $counselingcareerdetail->status == 0) selected="" @endif>Inactive</option>
        </select>
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
    @if(isset($counselingcareerdetail) && !empty($counselingcareerdetail->image))
    <div class="col-sm-12">
        <img class="img-responsive thumbnail" width="200" src="/counselingimages/{{ $counselingcareerdetail->image }}" alt="{{ $counselingcareerdetail->image }}">
    </div>
    @endif
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Description</label>
        <textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description">@if(isset($counselingcareerdetail) && $counselingcareerdetail->description) {{ $counselingcareerdetail->description or ''}} @endif</textarea>
    </div>
</div>
<hr>
@include('counseling.common-partial.counseling_career_skill_requirements')
<div class="row">
    <div class="col-md-12">
        <label>Job Profile Desc</label>
        <textarea class="form-control summernote jobProfileDesc" id="jobProfileDesc"  placeholder="Enter Job Profile Desc." name="jobProfileDesc">@if(isset($counselingcareerdetail) && $counselingcareerdetail->jobProfileDesc) {{ $counselingcareerdetail->jobProfileDesc or ''}} @endif</textarea>
    </div>
</div>
<hr>
@include('counseling.common-partial.counseling_career_job_role_saleries')
<div class="row">
    <div class="col-md-12">
        <label>Pros.</label>
        <textarea class="form-control summernote" id="pros"  placeholder="Enter pros." name="pros">@if(isset($counselingcareerdetail) && $counselingcareerdetail->pros) {{ $counselingcareerdetail->pros or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Cons.</label>
        <textarea class="form-control summernote" id="cons"  placeholder="Enter cons." name="cons">@if(isset($counselingcareerdetail) && $counselingcareerdetail->cons) {{ $counselingcareerdetail->cons or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Purpose</label>
        <textarea class="form-control summernote" id="purpose_desc"  placeholder="Enter purpose" name="purpose_desc">@if(isset($counselingcareerdetail) && $counselingcareerdetail->purpose_desc) {{ $counselingcareerdetail->purpose_desc or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Future Growth Purpose</label>
        <textarea class="form-control summernote" id="futureGrowthPurpose"  placeholder="Enter future growth purpose." name="futureGrowthPurpose">@if(isset($counselingcareerdetail) && $counselingcareerdetail->futureGrowthPurpose) {{ $counselingcareerdetail->futureGrowthPurpose or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Employee Opportunities</label>
        <textarea class="form-control summernote" id="employeeOpportunities"  placeholder="Enter employee opportunities." name="employeeOpportunities">@if(isset($counselingcareerdetail) && $counselingcareerdetail->employeeOpportunities) {{ $counselingcareerdetail->employeeOpportunities or ''}} @endif</textarea>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-md-12">
        <label>Eligibility</label>
        <textarea class="form-control summernote" id="eligibility"  placeholder="Enter eligibility" name="eligibility">@if(isset($counselingcareerdetail) && $counselingcareerdetail->eligibility) {{ $counselingcareerdetail->eligibility or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Qualification</label>
        <textarea class="form-control summernote" id="qualification"  placeholder="Enter qualification" name="qualification">@if(isset($counselingcareerdetail) && $counselingcareerdetail->qualification) {{ $counselingcareerdetail->qualification or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Syllabus</label>
        <textarea class="form-control summernote" id="syllabus"  placeholder="Enter syllabus" name="syllabus">@if(isset($counselingcareerdetail) && $counselingcareerdetail->syllabus) {{ $counselingcareerdetail->syllabus or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Exam Pattern</label>
        <textarea class="form-control summernote" id="exam_pattern"  placeholder="Enter exam pattern" name="exam_pattern">@if(isset($counselingcareerdetail) && $counselingcareerdetail->exam_pattern) {{ $counselingcareerdetail->exam_pattern or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Selection Criteria</label>
        <textarea class="form-control summernote" id="selection_criteria"  placeholder="Enter selection criteria" name="selection_criteria">@if(isset($counselingcareerdetail) && $counselingcareerdetail->selection_criteria) {{ $counselingcareerdetail->selection_criteria or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Frequency</label>
        <textarea class="form-control summernote" id="frequency"  placeholder="Enter frequency" name="frequency">@if(isset($counselingcareerdetail) && $counselingcareerdetail->frequency) {{ $counselingcareerdetail->frequency or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Study Material</label>
        <textarea class="form-control summernote" id="studyMaterial"  placeholder="Enter study material." name="studyMaterial">@if(isset($counselingcareerdetail) && $counselingcareerdetail->studyMaterial) {{ $counselingcareerdetail->studyMaterial or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Where To Study</label>
        <textarea class="form-control summernote" id="whereToStudy"  placeholder="Enter whereToStudy." name="whereToStudy">@if(isset($counselingcareerdetail) && $counselingcareerdetail->whereToStudy) {{ $counselingcareerdetail->whereToStudy or ''}} @endif</textarea>
    </div>
</div>
<hr>
@include('counseling.common-partial.counseling_career_where_to_studies')
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Other Details</label>
        <textarea class="form-control summernote" id="other_details"  placeholder="Enter other details" name="other_details">@if(isset($counselingcareerdetail) && $counselingcareerdetail->other_details) {{ $counselingcareerdetail->other_details or ''}} @endif</textarea>
    </div>
</div>