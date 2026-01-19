<input type="hidden" name="slug" value="{{ $slug }}">
<div class="row">
	<div class="col-md-12">
		<label>Question</label>
		<input type="text" class="form-control" name="question" placeholder="Enter question" required="" data-parsley-error-message="Please enter question" value="{{ $getCollegeFaqsObj->question }}">
	</div>
</div>
<div class="row margin-top20">
	<div class="col-md-12">
		<label>Reference Link</label>
		<input type="url" class="form-control" name="refLinks" placeholder="Enter refLinks" data-parsley-error-message="Please enter refLinks" value="{{ $getCollegeFaqsObj->refLinks }}">
	</div>
</div>
<div class="row margin-top20">
	<div class="col-md-12">
		<label>Answer</label>
		<textarea class="form-control summernote" rows="4" placeholder="Enter the answer" name="answer" required="">{{ $getCollegeFaqsObj->answer }}</textarea>
	</div>
</div>