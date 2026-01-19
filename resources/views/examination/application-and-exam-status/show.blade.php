@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Application And Exam Status Details {{ $applicationandexamstatus->id }}  <a href="{{ url('examination/application-and-exam-status/create') }}" class="btn btn-primary pull-right btn-sm">Add New Application and exam status</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url('examination/application-and-exam-status') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <a href="{{ url('examination/application-and-exam-status/' . $applicationandexamstatus->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit ApplicationAndExamStatus"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['examination/application-and-exam-status', $applicationandexamstatus->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'title' => 'Delete ApplicationAndExamStatus',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $applicationandexamstatus->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $applicationandexamstatus->name }} </td>
                        </tr>
                        <tr>
                            <th>Misc</th>
                            <td>
                                @if($applicationandexamstatus->misc == 'Application')
                                    <span class="label label-primary">Application</span>
                                @elseif($applicationandexamstatus->misc == 'Examination')
                                    <span class="label label-info">Examination</span>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $applicationandexamstatus->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($applicationandexamstatus->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" href="{{ url('administrator/users', $applicationandexamstatus->eUserId) }}" @endif>{{ $applicationandexamstatus->employeeFirstname }} {{ $applicationandexamstatus->employeeMiddlename}} {{ $applicationandexamstatus->employeeLastname}} (ID:- {{ $applicationandexamstatus->eUserId}}) Date & Time:-  {{ $applicationandexamstatus->updated_at}} </a></a>
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