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
                <i class="fa fa-question"></i> Question No {{$key+1}} <span class="pull-right"><a href="/delete-exam/question/{{$examId}}/{{$item->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a> </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Question :- {!! $item->question !!}</label>
                        <br>
                        <label>Date : {{ date('d F Y h:s a', strtotime($item->questionDate)) }}</label>
                        @foreach($item->examQuestionAnswersObj as $key1 => $item1)
                        <div class="row">
                            <div class="col-lg-12 margin-top10">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <i class="fa fa-edit"></i> Answer No {{$key1+1}} <span class="pull-right"><a href="/delete-exam/question-answer/{{$examId}}/{{$item->id}}/{{$item1->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a> </span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Answer :- {!! $item1->answer !!}</label>
                                                <br>
                                                <label>Date : {{ date('d F Y h:s a', strtotime($item1->answerDate)) }}</label>
                                                @foreach($item1->examQuestionAnswerCommentsObj as $key2 => $item2)
                                                <div class="row">
                                                    <div class="col-lg-12 margin-top10">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading">
                                                                <i class="fa fa-comments"></i> Comments {{$key2+1}} <span class="pull-right"><a href="/delete-exam/question-answer-comments/{{$examId}}/{{$item->id}}/{{$item1->id}}/{{$item2->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a> </span>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label>Comments :- {!! $item2->replyanswer !!}</label>
                                                                        <br>
                                                                        <label>Date : {{ date('d F Y h:s a', strtotime($item2->answerDate)) }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <form class="margin-top20" method="post" action="/update/exam-question-answer-comment/{{$examId}}/{{$item->id}}/{{$item1->id}}" data-parsley-validate="">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Add Comments  </label>
                                                    <textarea class="form-control replyanswer" id="replyanswer" placeholder="Enter description." name="replyanswer"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 text-center">
                                                <div class="form-group margin-top20">
                                                    <button type="submit" class="btn btn-info fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Comment</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <form class="margin-top20" method="post" action="/update/exam-question-answer/{{$examId}}/{{$item->id}}" data-parsley-validate="">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Add New Answer  </label>
                            <textarea class="form-control summernote answer" id="answer"  placeholder="Enter description." name="answer"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <div class="form-group margin-top20">
                            <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Answer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach