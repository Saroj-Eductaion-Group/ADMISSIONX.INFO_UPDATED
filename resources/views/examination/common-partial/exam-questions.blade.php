<form class="margin-top20" method="post" action="/update/exam-question/{{$examId}}" data-parsley-validate="">
    <div class="row">
        <div class="col-md-12">
            <label>Add New Question  </label>
            <textarea class="form-control question summernote" id="question" placeholder="Enter question." name="question"></textarea>
        </div>
    </div>
    <div class="col-sm-12 text-center">
        <div class="form-group margin-top20">
            <button type="submit" class="btn btn-success fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Question</button>
        </div>
    </div>
</form>
@foreach($examQuestionsObj as $key => $item)
<div class="row">
    <div class="col-lg-12 margin-top20">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-question"></i> Question No {{$key+1}} <span class="pull-right"><a href="/get-ask-exam-questions-answer-partial/{{$examId}}/{{$item->id}}"><button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Details</button></a> <a href="/delete-exam/question/{{$examId}}/{{$item->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a> </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Question :- {!! $item->question !!}</label>
                        <br>
                        <label>Date : {{ date('d F Y h:s a', strtotime($item->questionDate)) }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach