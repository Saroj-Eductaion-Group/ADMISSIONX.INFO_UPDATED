@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswer'); /*--}}
{{--*/ $validateUserRoleExamQuestion = $fetchDataServiceController->validateUserRoleCall('ExamQuestion'); /*--}}
{{--*/ $validateUserRoleTypeOfExamination = $fetchDataServiceController->validateUserRoleCall('TypeOfExamination'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Examination Answer <a href="{{ url('examination/all-exam-answers') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Examination Answer details</h5>                            
            </div>
             @if(Session::has('flash_message'))
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>{{ Session::get('flash_message') }}</strong>
                        </div>
                    </div>
                </div>
            @endif
            <div class="ibox-content">
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleTypeOfExamination)) && (sizeof($validateUserRoleTypeOfExamination) > 0) && ($validateUserRoleTypeOfExamination[0]->show == '1'))
                            <a href="{{ url('examination/type-of-examination/' . $examAnswer->examId) }}">
                                <button type="submit" class="btn btn-warning btn-xs">View Examination Details</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleExamQuestion)) && (sizeof($validateUserRoleExamQuestion) > 0) && ($validateUserRoleExamQuestion[0]->show == '1'))
                            <a href="{{ url('examination/exam-question/show/' . $examAnswer->questionId) }}">
                                <button type="submit" class="btn btn-success btn-xs">View Question Details</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                            <a href="{{ url('examination/exam-answers/show/' . $examAnswer->id) }}">
                                <button type="submit" class="btn btn-primary btn-xs">View Answer</button>
                            </a> 
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            <a href="/delete-exam/question-answer/{{$examAnswer->examId}}/{{$examAnswer->questionId}}/{{$examAnswer->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a>
                        @endif
                    @else
                        <a href="{{ url('examination/type-of-examination/' . $examAnswer->examId) }}">
                            <button type="submit" class="btn btn-warning btn-xs">View Examination Details</button>
                        </a>
                        <a href="{{ url('examination/exam-question/show/' . $examAnswer->questionId) }}">
                            <button type="submit" class="btn btn-success btn-xs">View Question Details</button>
                        </a>
                        <a href="{{ url('examination/exam-answers/show/' . $examAnswer->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">View Answer</button>
                        </a> 
                        <a href="/delete-exam/question-answer/{{$examAnswer->examId}}/{{$examAnswer->questionId}}/{{$examAnswer->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a>
                    @endif
                @endif
                
                <form class="margin-top20" method="post" action="/examination/exam-question/update/{{ $examAnswer->examId }}/{{$examAnswer->questionId}}/{{ $examAnswer->id }}" data-parsley-validate="">
                    <div class="row">
                        <div class="col-sm-12"><label class="control-label" >Examination Name : {{$examAnswer->sortname}}  {{ $examAnswer->name or '' }}</label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"><label class="control-label" >Question : {!! $examAnswer->question !!}</label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Answer</label>
                            <textarea class="form-control summernote answer" id="answer"  placeholder="Enter description." name="answer">@if(isset($examAnswer) && $examAnswer->answer) {{$examAnswer->answer}} @endif</textarea>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Update Answer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')

@endsection