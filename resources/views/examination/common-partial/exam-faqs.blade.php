<form class="margin-top20" method="post" action="/update/exam-faqs/{{$examId}}" data-parsley-validate="">
	<div class="panel-body">
        <div class="row margin-bottom10">
            <div class="col-md-12">
                <h3 class="text-uppercase text-success">Please list all exam faq details you see</h3>
            </div>
        </div>
        <div class="examFaqSection">
        	@foreach($examFaqsObj as $key => $item)
            <div class="clientContactDetails">
                <h4 class="padding-bottom10">Faq Question & Answer Faq Detail <a class="btn btn-outline btn-danger btn-xs removeFaqDetailsDetails pull-right"><i class="fa fa-remove"></i> Remove</a></h4>
                <div class="row">
                    <div class="col-md-12">
                        <label class="">Question</label>
                        <input type="text" name="question[]"  class="form-control question" data-parsley-trigger="change" data-parsley-error-message="Please enter valid question"  id="question" placeholder="Please enter question" value="{{$item->question}}" > 
                    </div>
                </div>
                <hr class="hr-line-dashed">
                <div class="row">
                    <div class="col-md-12">
                        <label class="">Answer</label>
                        <textarea class="form-control answer" id="answer"  placeholder="Enter answer." name="answer[]">@if($item->answer) {{ $item->answer or ''}} @endif</textarea>
                    </div>
                </div>
                <hr class="hr-line-dashed">
                <div class="row">
                    <div class="col-md-12">
                        <label class="">Reference Link</label>
                        <input type="url" name="refLinks[]"  class="form-control refLinks" data-parsley-trigger="change" data-parsley-error-message="Please enter valid reference links"  id="refLinks" placeholder="Please enter reference links" value="{{$item->refLinks}}" >
                    </div>
                </div>
            </div>
            <hr class="hr-line-dashed">
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-2 pull-right margin-top20">
                <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addNewFaqDetailRow"><i class="fa fa-plus"></i> Add Faqs</a>
            </div>
        </div>
    </div>
	<hr>
	<div class="col-sm-12 text-center">
		<div class="form-group mb-0 mt-20">
			<button type="submit" class="btn btn-primary fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit</button>
		</div>
	</div>
</form>