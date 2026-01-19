@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer'); /*--}}
{{--*/ $validateUserRoleAskQuestion = $fetchDataServiceController->validateUserRoleCall('AskQuestion'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Ask Answer Details {{ $askAnswer->id }} 
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
                <a href="{{ url($fetchDataServiceController->routeCall().'/all-ask-answers') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleAskQuestion)) && (sizeof($validateUserRoleAskQuestion) > 0) && ($validateUserRoleAskQuestion[0]->show == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $askAnswer->questionId) }}">
                                <button type="submit" class="btn btn-warning btn-xs">View Question Details</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-answers/edit/' . $askAnswer->id) }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit Answer</button>
                            </a> 
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            <a href="/delete-ask/question-answer/{{$askAnswer->questionId}}/{{$askAnswer->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Answer</button></a> 
                        @endif
                    @else
                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $askAnswer->questionId) }}">
                            <button type="submit" class="btn btn-warning btn-xs">View Question Details</button>
                        </a>
                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-answers/edit/' . $askAnswer->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">Edit Answer</button>
                        </a> 
                        <a href="/delete-ask/question-answer/{{$askAnswer->questionId}}/{{$askAnswer->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Answer</button></a> 
                    @endif
                @endif
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $askAnswer->id }}</td> 
                        </tr>
                        <tr>
                            <th>Question</th>
                            <td>{!! $askAnswer->question !!} </td>
                        </tr>
                        <tr>
                            <th>Answer</th>
                            <td>{!! $askAnswer->answer !!} </td>
                        </tr>
                        <tr>
                            <th>Answer Date</th>
                            <td>{!! date('F d, Y', strtotime($askAnswer->answerDate)) !!} </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $askAnswer->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Comments</th>
                            <td>
                                <span class="badge badge-info">{{$askAnswer->totalCommentsCount}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Answer Added By</th>
                            <td>
                                @if($askAnswer->userID)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $askAnswer->userID) }}" @endif>{{ $askAnswer->firstname }} {{ $askAnswer->lastname}} (ID:- {{ $askAnswer->userID}}) |  Date & Time:-  {{ $askAnswer->answerDate}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($askAnswer->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $askAnswer->eUserId) }}" @endif>{{ $askAnswer->employeeFirstname }} {{ $askAnswer->employeeMiddlename}} {{ $askAnswer->employeeLastname}} (ID:- {{ $askAnswer->eUserId}}) | Date & Time:-  {{ $askAnswer->updated_at}} </a></a>
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
