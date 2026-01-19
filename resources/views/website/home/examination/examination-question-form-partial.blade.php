<div class="row clientContactDetails margin-bottom-20">
	@if(Auth::check()) 
		<form class="margin-top20" method="post" action="/add/exam-question/{{$examId}}" data-parsley-validate="">
	@else
		<form class="checkLoginStatusQuestionSubmit" data-parsley-validate ="" enctype = "multipart/form-data">
	@endif
		<input type="hidden" name="examId" value="{{$examId}}">
		<div class="col-sm-12">
			<label>Have a question related to {{$typeOfExaminationObj->sortname}} - {{$typeOfExaminationObj->name}} ?  </label>
		</div>
		<div class="col-sm-12">
			<label></label>
			<textarea rows="5" name="question" id="question" class="form-control summernote" placeholder="Type your question here..." data-parsley-trigger="change"  data-parsley-error-message="Please enter question" required=""></textarea>
		</div>
		<br>
		<div class="col-md-9 margin-bottom-20">
			<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
			{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
		</div>
		<div class="col-md-3">
			<button class="btn btn-md btn-success  pull-right margin-top-20" id="btnValidate" type="submit">Ask Question</button>
		</div>
	</form>
</div>