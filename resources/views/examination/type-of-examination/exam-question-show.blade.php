@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('ExamQuestion'); /*--}}
{{--*/ $validateUserRoleTypeOfExamination = $fetchDataServiceController->validateUserRoleCall('TypeOfExamination'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Ask Examination Question Details {{ $examQuestion->id }}  
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleTypeOfExamination)) && (sizeof($validateUserRoleTypeOfExamination) > 0) && ($validateUserRoleTypeOfExamination[0]->create == '1'))
                    <a href="{{ url('examination/type-of-examination/create') }}" class="btn btn-primary pull-right btn-sm">Add New List of Examination</a>
                @endif
            @else
                <a href="{{ url('examination/type-of-examination/create') }}" class="btn btn-primary pull-right btn-sm">Add New List of Examination</a>
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
                <a href="{{ url('examination/all-exam-question') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleTypeOfExamination)) && (sizeof($validateUserRoleTypeOfExamination) > 0) && ($validateUserRoleTypeOfExamination[0]->show == '1'))
                            <a href="{{ url('examination/type-of-examination/' . $examQuestion->examId) }}">
                                <button type="submit" class="btn btn-warning btn-xs">View Examination Details</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url('examination/exam-question/edit/' . $examQuestion->id) }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit Question</button>
                            </a>  
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            <a href="/delete-exam/question/{{$examQuestion->examId}}/{{$examQuestion->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Question</button></a> 
                        @endif
                    @else
                        <a href="{{ url('examination/type-of-examination/' . $examQuestion->examId) }}">
                            <button type="submit" class="btn btn-warning btn-xs">View Examination Details</button>
                        </a>
                        <a href="{{ url('examination/exam-question/edit/' . $examQuestion->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">Edit Question</button>
                        </a> 
                        <a href="/delete-exam/question/{{$examQuestion->examId}}/{{$examQuestion->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Question</button></a> 
                    @endif
                @endif
                
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $examQuestion->id }}</td> 
                        </tr>
                        <tr>
                            <th>Examination Name</th>
                            <td>{{ $examQuestion->sortname }}  {{ $examQuestion->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>Examination Section</th>
                            <td>{!! $examQuestion->exam_sectionsName !!} </td>
                        </tr>
                        <tr>
                            <th>Question</th>
                            <td>{!! $examQuestion->question !!} </td>
                        </tr>
                        <tr>
                            <th>Question Date</th>
                            <td>{!! date('F d, Y', strtotime($examQuestion->questionDate)) !!} </td>
                        </tr>
                        <tr>
                            <th>Question Added By</th>
                            <td>
                                @if($examQuestion->userID)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $examQuestion->userID) }}" @endif>{{ $examQuestion->firstname }} {{ $examQuestion->lastname}} (ID:- {{ $examQuestion->userID}}) |  Date & Time:-  {{ $examQuestion->questionDate}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($examQuestion->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $examQuestion->eUserId) }}" @endif>{{ $examQuestion->employeeFirstname }} {{ $examQuestion->employeeMiddlename}} {{ $examQuestion->employeeLastname}} (ID:- {{ $examQuestion->eUserId}}) | Date & Time:-  {{ $examQuestion->updated_at}} </a></a>
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
