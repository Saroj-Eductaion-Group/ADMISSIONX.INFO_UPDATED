<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >Exam Stream : </label>
        <select name="examsection_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select Exam Stream </option>  
            @foreach ($examsectionsObj as $item)
                <option value="{{ $item->id }}" @if(isset($typeofexamination) && $typeofexamination->examsection_id == $item->id) selected="" @endif>{{ $item->name }}</option>
            @endforeach    
        </select>  
    </div>
</div>
<div class="appearDegreeCheckBox">
    
</div>

@if(isset($degreeObj) && isset($examListMultipleDegreeObj))
<div class="form-group prevDegreeCheckBox">
    <div class="col-md-12">
        <label class="control-label" >Degree name : </label>
        <div class="row">
            @foreach( $degreeObj as $item )
                {{--*/ $flag = '0' /*--}}
                <div class="col-md-3">
                @foreach( $examListMultipleDegreeObj as $key)                                    
                    @if( $key->degreeId == $item->id )
                        <div class="checkbox checkbox-primary checkbox-inline">
                            <input type="checkbox" data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required=""  class="" name="degreeIds[]" id="degree{{ $item->id }}" value="{{ $item->id }}" checked="">
                            <label for="degree{{ $item->id }}">{{ strtolower(trans($item->name)) }}</label>
                        </div>
                        {{--*/ $flag = '1' /*--}}
                    @endif
                @endforeach
                @if( $flag == '0' )
                    <div class="checkbox checkbox-primary checkbox-inline">
                        <input type="checkbox" data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="" id="degree{{ $item->id }}"  class="" name="degreeIds[]" value="{{ $item->id }}">
                        <label for="degree{{ $item->id }}">{{ strtolower(trans($item->name)) }}</label>
                    </div>
                @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<?php
/*<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >University Name : </label>
        <select name="university_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select Stream </option>  
            @foreach ($universityObj as $item)
                <option value="{{ $item->id }}" @if(isset($typeofexamination) && $typeofexamination->university_id == $item->id) selected="" @endif>{{ $item->name }}</option>
            @endforeach  
            <option value="0" selected="">Others</option>    
        </select>  
        <input type="hidden" name="universityName" @if(isset($typeofexamination) && $typeofexamination->universityName) value="{{$typeofexamination->universityName}}" @else value="" @endif >  
        <input  class="form-control hide otheruniversityname" type="text" name="otheruniversityname" value="">  
    </div>
</div>*/
?>


<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Exam Sort Name : </label>
        {!! Form::text('sortname', null, ['class' => 'form-control', 'placeholder' => 'Enter sort name here', 'data-parsley-error-message' => 'Please enter sort name here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >Exam Full Form Name : </label>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter name here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
    <label class="control-label" >University Name : </label>
        {!! Form::text('universityName', null, ['class' => 'form-control', 'placeholder' => 'Enter university name here', 'data-parsley-error-message' => 'Please enter university name here', 'data-parsley-trigger'=>'change']) !!}
    </div>
</div>
<div class="row padding-bottom20">
    <div class="col-md-12">
        <label>Logo Image : </label>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" name="universitylogo" class="universitylogo form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload image">
        <p class="text-danger hide" id="universitylogo">(please upload .png, .jpg and .jpeg file only)</p>
    </div>
    @if(isset($typeofexamination) && !empty($typeofexamination->universitylogo))
    <div class="col-sm-12">
        <img class="img-responsive thumbnail" width="200" src="/examinationlogo/{{ $typeofexamination->universitylogo }}" alt="{{ $typeofexamination->universitylogo }}">
    </div>
    @endif
</div>
<div class="form-group">
    <div class="col-md-12">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($typeofexamination) && $typeofexamination->status == 1) selected="" @endif>Active</option>
            <option value="2" @if(isset($typeofexamination) && $typeofexamination->status == 2) selected="" @endif>Inactive</option>
        </select>
    </div>
</div>

@include('common-partials.common-exam-fileds-update-partial')

<h2>Examination Details</h2>
<div class="row">
    <div class="col-md-12">
        <label>Title</label>
        <input id="examtitle" name="examtitle" class="form-control examtitle" type="text" @if(isset($examinationDetailsObj) && $examinationDetailsObj->title) value="{{ $examinationDetailsObj->title or ''}}" @else value="" @endif  placeholder="Please title"  data-parsley-error-message="Please title">
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Exam Description</label>
        <textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description">@if(isset($examinationDetailsObj) && $examinationDetailsObj->description) {{ $examinationDetailsObj->description or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <label>Application From Date</label>
        <input type="text" name="applicationFrom" id="startdate1" required="" placeholder="Application From Date" @if(isset($examinationDetailsObj) && $examinationDetailsObj->applicationFrom) value="{{ $examinationDetailsObj->applicationFrom or ''}}" @else value="" @endif class="form-control" data-parsley-error-message="Please select application from date" data-parsley-trigger="change">
    </div>
    <div class="col-md-6">
        <label>Application To Date</label>
        <input type="text" name="applicationTo" id="enddate1" required="" placeholder="Application To Date" @if(isset($examinationDetailsObj) && $examinationDetailsObj->applicationTo) value="{{ $examinationDetailsObj->applicationTo or ''}}" @else value="" @endif class="form-control" data-parsley-error-message="Please select application to date" data-parsley-trigger="change">
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <label>Exmination Date</label>
        <input type="text" name="exminationDate" id="exminationDate" required="" placeholder="Exmination Date" @if(isset($examinationDetailsObj) && $examinationDetailsObj->exminationDate) value="{{ $examinationDetailsObj->exminationDate or ''}}" @else value="" @endif class="form-control" data-parsley-error-message="Please enter exmination date" data-parsley-trigger="change">
    </div>
    <div class="col-md-6">
        <label>Result Announce</label>
        <input type="text" name="resultAnnounce" required="" placeholder="Result Announce" @if(isset($examinationDetailsObj) && $examinationDetailsObj->resultAnnounce) value="{{ $examinationDetailsObj->resultAnnounce or ''}}" @else value="" @endif class="form-control" data-parsley-error-message="Please enter result announce" data-parsley-trigger="change">
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <label>Mode of application</label>
        <select class="form-control text-capitalize" required="" name="modeofapplication" data-parsley-error-message="Please select degree name">
            <option disabled="" selected="">Please select</option>
            @foreach( $applicationMode as $item )
                <option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofapplication == $item->id) selected="" @endif>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Mode of payment</label>
        <select class="form-control text-capitalize" required="" name="modeofpayment" data-parsley-error-message="Please select degree name">
            <option disabled="" selected="">Please select</option>
            <option value="1"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 1) selected="" @endif>Online</option>
            <option value="2"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 2) selected="" @endif>Offline</option>
            <option value="3"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 3) selected="" @endif>Online & Offline</option>
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <label>Examination Type</label>
        <select class="form-control text-capitalize" required="" name="examinationtype" data-parsley-error-message="Please select degree name">
            <option disabled="" selected="">Please select</option>
            @foreach( $examinationType as $item )
                <option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->examinationtype == $item->id) selected="" @endif>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Application & Exam Status</label>
        <select class="form-control text-capitalize" required="" name="applicationandexamstatus" data-parsley-error-message="Please select degree name">
            <option disabled="" selected="">Please select</option>
            @foreach( $applicationAndExamStatus as $item )
                <option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->applicationandexamstatus == $item->id) selected="" @endif>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <label>Mode Of Examination</label>
        <select class="form-control text-capitalize" required="" name="examinationmode" data-parsley-error-message="Please select degree name">
            <option disabled="" selected="">Please select</option>
            @foreach( $examinationMode as $item )
                <option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->examinationmode == $item->id) selected="" @endif>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Eligibility Criteria</label>
        <select class="form-control text-capitalize" required="" name="eligibilitycriteria" data-parsley-error-message="Please select degree name">
            <option disabled="" selected="">Please select</option>
            @foreach( $eligibilityCriterion as $item )
                <option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->eligibilitycriteria == $item->id) selected="" @endif>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <label>Banner Image</label>
        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
        <input type="file" name="image" class="image form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload image">
        <p class="text-danger hide" id="image">(please upload .png, .jpg and .jpeg file only)</p>
        @if(isset($examinationDetailsObj) && !empty($examinationDetailsObj->image))
            <img class="img-responsive thumbnail" width="200" src="/examinationlogo/{{ $examinationDetailsObj->image }}" alt="{{ $examinationDetailsObj->image }}">
        @endif
    </div>
    <div class="col-md-6">
        <label>Banner Image alt text</label>
        <input id="imagealttext" name="imagealttext" class="form-control imagealttext" type="text" @if(isset($examinationDetailsObj) && $examinationDetailsObj->imagealttext) value="{{ $examinationDetailsObj->imagealttext or ''}}" @else value="" @endif  placeholder="Please image alt text"  data-parsley-error-message="Please image alt text">
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Get More Info Link</label>
        <input id="getMoreInfoLink" name="getMoreInfoLink" class="form-control getMoreInfoLink" type="url" @if(isset($examinationDetailsObj) && $examinationDetailsObj->getMoreInfoLink) value="{{ $examinationDetailsObj->getMoreInfoLink or ''}}" @else value="" @endif  placeholder="Please get more info link"  data-parsley-error-message="Please get more info link">
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Contents</label>
        <textarea class="form-control summernote content" id="content"  placeholder="Enter content." name="content">@if(isset($examinationDetailsObj) && $examinationDetailsObj->content) {{ $examinationDetailsObj->content or ''}} @endif</textarea>
    </div>
</div>
<hr>
<div class="row">
   <div class="col-md-12">
       <div class="headline"><h2>SEO Content</h2></div>
        <input type="hidden" name="seopagename" value="examinationpage">
        @if(isset($seocontent) && (sizeof($seocontent) > 0))
            @if(!empty($seocontent[0]->seoContentId))
                <input type="hidden" name="seoContentId" value="{{ $seocontent[0]->seoContentId }}">
            @endif
            @include ('administrator.seo-content.seo-update-partial')
        @else
            @include ('administrator.seo-content.seo-create-partial')
        @endif
   </div> 
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>