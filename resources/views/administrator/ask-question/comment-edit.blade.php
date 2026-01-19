@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer'); /*--}}
{{--*/ $validateUserRoleAskQuestion = $fetchDataServiceController->validateUserRoleCall('AskQuestion'); /*--}}
{{--*/ $validateUserRoleAskQuestionAnswer = $fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Ask Comment <a href="{{ url($fetchDataServiceController->routeCall().'/all-ask-comments') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Ask Comment details</h5>                            
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
                        @if((isset($validateUserRoleAskQuestion)) && (sizeof($validateUserRoleAskQuestion) > 0) && ($validateUserRoleAskQuestion[0]->show == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $askComments->questionId) }}">
                                <button type="submit" class="btn btn-warning btn-xs">View Question Details</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleAskQuestionAnswer)) && (sizeof($validateUserRoleAskQuestionAnswer) > 0) && ($validateUserRoleAskQuestionAnswer[0]->show == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-answers/show/' . $askComments->answerId) }}">
                                <button type="submit" class="btn btn-info btn-xs">View Answer Details</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-comments/show/' . $askComments->id) }}">
                                <button type="submit" class="btn btn-primary btn-xs">View Comment</button>
                            </a> 
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            <a href="/delete-ask/question-answer-comments/{{$askComments->questionId}}/{{$askComments->answerId}}/{{$askComments->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Comment</button></a>  
                        @endif
                    @else
                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $askComments->questionId) }}">
                            <button type="submit" class="btn btn-warning btn-xs">View Question Details</button>
                        </a>
                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-answers/show/' . $askComments->answerId) }}">
                            <button type="submit" class="btn btn-info btn-xs">View Answer Details</button>
                        </a>
                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-comments/show/' . $askComments->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">View Comment</button>
                        </a> 
                        <a href="/delete-ask/question-answer-comments/{{$askComments->questionId}}/{{$askComments->answerId}}/{{$askComments->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Comment</button></a>    
                    @endif
                @endif

                <form class="margin-top20" method="post" action="/administrator/update/ask-question-answer-comment/{{$askComments->questionId}}/{{$askComments->answerId}}/{{$askComments->id}}" data-parsley-validate="">
                    <div class="row">
                        <div class="col-sm-12"><label class="control-label" >Question : {!! $askComments->question !!}</label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"><label class="control-label" >Answer : {!! $askComments->answer !!}</label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Comment</label>
                            <textarea class="form-control summernote replyanswer" id="replyanswer"  placeholder="Enter description." name="replyanswer">{!! $askComments->replyanswer !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Update Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')

@endsection