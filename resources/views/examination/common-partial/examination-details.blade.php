<form class="margin-top20" method="post" action="/update/examination-details/{{$examId}}" data-parsley-validate="" files=" true"  enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">
			<label>Title</label>
			<input id="examtitle" name="examtitle" class="form-control examtitle" type="text" @if(isset($examinationDetailsObj) && $examinationDetailsObj->title) value="{{ $examinationDetailsObj->title or ''}}" @else value="" @endif  placeholder="Please title"  data-parsley-error-message="Please title">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<label>Description</label>
	        <textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description">@if(isset($examinationDetailsObj) && $examinationDetailsObj->description) {{ $examinationDetailsObj->description or ''}} @endif</textarea>
	    </div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<label>Application From Date</label>
			<input type="text" name="applicationFrom" id="startdate1" placeholder="Application From Date" @if(isset($examinationDetailsObj) && $examinationDetailsObj->applicationFrom) value="{{ $examinationDetailsObj->applicationFrom or ''}}" @else value="" @endif class="form-control" data-parsley-error-message="Please select application from date" data-parsley-trigger="change">
		</div>
		<div class="col-md-6">
			<label>Application To Date</label>
			<input type="text" name="applicationTo" id="enddate1" placeholder="Application To Date" @if(isset($examinationDetailsObj) && $examinationDetailsObj->applicationTo) value="{{ $examinationDetailsObj->applicationTo or ''}}" @else value="" @endif class="form-control" data-parsley-error-message="Please select application to date" data-parsley-trigger="change">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<label>Exmination Date</label>
			<input type="text" name="exminationDate" id="exminationDate" placeholder="Exmination Date" @if(isset($examinationDetailsObj) && $examinationDetailsObj->exminationDate) value="{{ $examinationDetailsObj->exminationDate or ''}}" @else value="" @endif class="form-control" data-parsley-error-message="Please enter exmination date" data-parsley-trigger="change">
		</div>
		<div class="col-md-6">
			<label>Result Announce</label>
			<input type="text" name="resultAnnounce" placeholder="Result Announce" @if(isset($examinationDetailsObj) && $examinationDetailsObj->resultAnnounce) value="{{ $examinationDetailsObj->resultAnnounce or ''}}" @else value="" @endif class="form-control" data-parsley-error-message="Please enter result announce" data-parsley-trigger="change">
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
	<div class="col-sm-12 text-center">
		<div class="form-group mb-0 mt-20">
			<button type="submit" class="btn btn-primary fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit</button>
		</div>
	</div>
</form>