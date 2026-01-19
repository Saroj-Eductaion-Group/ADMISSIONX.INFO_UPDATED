@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('ExamCounsellingForm'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Exam Counselling Form {{ $examcounsellingform->id }}  <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/create') }}" class="btn btn-primary pull-right btn-sm">Add New Exam Counselling Form</a></h2>
                @endif
            @else
                <h2>Exam Counselling Form {{ $examcounsellingform->id }}  <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/create') }}" class="btn btn-primary pull-right btn-sm">Add New Exam Counselling Form</a></h2>
            @endif
        @endif
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/' . $examcounsellingform->id . '/edit') }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => [$fetchDataServiceController->routeCall().'/exam-counselling-form', $examcounsellingform->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Exam Counselling Form',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                       <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/' . $examcounsellingform->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Exam Counselling Form"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/exam-counselling-form', $examcounsellingform->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Exam Counselling Form',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}

                    @endif
                @endif
           
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $examcounsellingform->id }}</td> 
                        </tr>
                        <tr>
                            <th>Examination Name</th>
                            <td>
                                {{$examcounsellingform->sortname}}  {{ $examcounsellingform->examinationName or '' }} ({{ $examcounsellingform->exam_sectionsName}})
                                <a href="{{ url('/examination-details/'.$examcounsellingform->examinationSlug.'/'.$examcounsellingform->slug) }}" target="_blank" class="btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> Examination Public View</a>
                                <a href="{{ url('/examination/type-of-examination/' . $examcounsellingform->exam_id) }}" class="btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> Examination Details</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                @if( $examcounsellingform->name )
                                    {{ $examcounsellingform->name }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                @if( $examcounsellingform->email )
                                    {{ $examcounsellingform->email }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                @if( $examcounsellingform->phone )
                                    {{ $examcounsellingform->phone }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>
                                @if( $examcounsellingform->city_id )
                                   {{$examcounsellingform->cityname}}, {{ $examcounsellingform->stateName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <td>
                                @if( $examcounsellingform->course_id )
                                   {{$examcounsellingform->courseName}} ({{$examcounsellingform->degreeName}}, {{$examcounsellingform->functionalareaName}})
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Form Submit Date</th>
                            <td>{!! date('F d, Y', strtotime($examcounsellingform->created_at)) !!} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($examcounsellingform->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $examcounsellingform->eUserId) }}" @endif>{{ $examcounsellingform->employeeFirstname }} {{ $examcounsellingform->employeeMiddlename}} {{ $examcounsellingform->employeeLastname}} (ID:- {{ $examcounsellingform->eUserId}}) <hr> Date & Time:-  {{ $examcounsellingform->updated_at}} </a></a>
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