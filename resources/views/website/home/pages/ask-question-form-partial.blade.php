<div class="row clientContactDetails margin-bottom-20">
	@if(Auth::check()) 
		<form action="/ask-new-question" method="post" data-parsley-validate ="" enctype = "multipart/form-data">
	@else
		<form class="checkLoginStatusAskQuestionSubmit" data-parsley-validate ="" enctype = "multipart/form-data">
	@endif 
		<div class="col-sm-12">
			<label class="" >Ask Question : </label>
			<textarea rows="5" name="question" id="question" class="form-control summernote" placeholder="Type your question here..." data-parsley-trigger="change"  data-parsley-error-message="Please enter question" required=""></textarea>
		</div>
		<div class="col-md-12 margin-bottom-20">
    		<label class="" >Ask Question Tag : </label>
			<select multiple="multiple" name="askQuestionTagIds[]" class="form-control chosen-select" data-placeholder="Ask Question Tag" autocomplete="off" data-parsley-error-message="Please select ask question tag" required="">
                <option value="" disabled="">Select Ask Question Tag</option>
                @foreach($askQuestionTagObj as $item)
                    <option value="{{ $item->id }}">{!! $item->name !!}</option>
                @endforeach
            </select>
        </div>
		<div class="col-md-12 margin-bottom-20">
			<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
			{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
		</div>
		<div class="col-sm-12">
			<button class="btn btn-md btn-success  pull-right margin-top-20" id="btnValidate" type="submit">Ask Question</button>
		</div>
	</form>
</div>