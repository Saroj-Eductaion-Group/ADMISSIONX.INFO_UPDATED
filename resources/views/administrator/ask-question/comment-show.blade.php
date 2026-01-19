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
        <h2>Ask Comment Details {{ $askComments->id }}
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleAskQuestion)) && (sizeof($validateUserRoleAskQuestion) > 0) && ($validateUserRoleAskQuestion[0]->create == '1'))
                <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/create') }}" class="btn btn-primary pull-right btn-sm">Add New Ask Question</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/create') }}" class="btn btn-primary pull-right btn-sm">Add New Ask Question</a>
            @endif
        @endif
        </h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
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
                <a href="{{ url($fetchDataServiceController->routeCall().'/all-ask-comments') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
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
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-comments/edit/' . $askComments->id) }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit Comment</button>
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
                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-comments/edit/' . $askComments->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">Edit Comment</button>
                        </a> 
                        <a href="/delete-ask/question-answer-comments/{{$askComments->questionId}}/{{$askComments->answerId}}/{{$askComments->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Comment</button></a>  
                    @endif
                @endif
                
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $askComments->id }}</td> 
                        </tr>
                        <tr>
                            <th>Question</th>
                            <td>{!! $askComments->question !!} </td>
                        </tr>
                        <tr>
                            <th>Answer</th>
                            <td>{!! $askComments->answer !!} </td>
                        </tr>
                        <tr>
                            <th>Comment</th>
                            <td>{!! $askComments->replyanswer !!} </td>
                        </tr>
                        <tr>
                            <th>Comment Date</th>
                            <td>{!! date('F d, Y', strtotime($askComments->answerDate)) !!} </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $askComments->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Comment Added By</th>
                            <td>
                                @if($askComments->userID)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $askComments->userID) }}" @endif>{{ $askComments->firstname }} {{ $askComments->lastname}} (ID:- {{ $askComments->userID}}) |  Date & Time:-  {{ $askComments->answerDate}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($askComments->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $askComments->eUserId) }}" @endif>{{ $askComments->employeeFirstname }} {{ $askComments->employeeMiddlename}} {{ $askComments->employeeLastname}} (ID:- {{ $askComments->eUserId}}) | Date & Time:-  {{ $askComments->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

@endsection
