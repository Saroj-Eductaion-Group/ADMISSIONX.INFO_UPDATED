@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('TypeOfExamination'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>List of Examination Details {{ $typeofexamination->id }}  <a href="{{ url('examination/type-of-examination/create') }}" class="btn btn-primary pull-right btn-sm">Add New List of Examination</a></h2>
                @endif
            @else
                <h2>List of Examination Details {{ $typeofexamination->id }}  <a href="{{ url('examination/type-of-examination/create') }}" class="btn btn-primary pull-right btn-sm">Add New List of Examination</a></h2>
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
               <a href="{{ url('examination/type-of-examination') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url('examination/type-of-examination/' . $typeofexamination->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit List of Examination"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['examination/type-of-examination', $typeofexamination->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete List of Examination',
                                        'onclick'=>'return confirm("Confirm delete? Are you sure to proceed? As you click on the ok button, all the records of the examination will be deleted and cannot be recovered again.")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url('examination/review-and-update-form-details/' . $typeofexamination->id) }}" target="_blank">
                                <button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Review & Update All Form Details</button>
                            </a>
                        @endif
                    @else
                        <a href="{{ url('examination/type-of-examination/' . $typeofexamination->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit List of Examination"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['examination/type-of-examination', $typeofexamination->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete List of Examination',
                                    'onclick'=>'return confirm("Confirm delete? Are you sure to proceed? As you click on the ok button, all the records of the examination will be deleted and cannot be recovered again.")'
                            ))!!}
                        {!! Form::close() !!}
                        <a href="{{ url('examination/review-and-update-form-details/' . $typeofexamination->id) }}" target="_blank">
                            <button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Review & Update All Form Details</button>
                        </a>
                    @endif
                @endif
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            @include ('examination.type-of-examination.partial-edit-pages')
                        @endif
                    @else
                        @include ('examination.type-of-examination.partial-edit-pages')
                    @endif
                @endif
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $typeofexamination->id }}</td> 
                        </tr>
                        <tr>
                            <th>Exam Sort name</th>
                            <td>{{ $typeofexamination->sortname }} </td>
                        </tr>
                        <tr>
                            <th>Exam Full Form Name</th>
                            <td>{{ $typeofexamination->name }} </td>
                        </tr>
                        <tr>
                            <th>University</th>
                            <td>{{ $typeofexamination->universityName }}</td>
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td>{{ $typeofexamination->functionalAreaName }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $typeofexamination->exam_sectionstitle }}</td>
                        </tr>
                        <tr>
                            <th>Degree</th>
                            <th>
                                @foreach($examListMultipleDegreeObj as $item)
                                <span class="label label-info">{{ $item->degreeName }}</span>
                                @endforeach
                            </th>
                        </tr>
                        <tr>
                            <th>Logo</th>
                            <td> 
                                @if( $typeofexamination->universitylogo )
                                    <img class="img-responsive thumbnail" src="/examinationlogo/{{ $typeofexamination->universitylogo }}" width="120" alt="{{ $typeofexamination->universitylogo }}">
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif 
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $typeofexamination->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        @include('common-partials.common-exam-fileds-details-partial')
                        <tr>
                            <th>Application Dates</th>
                            <td>@if(!empty($typeofexamination->applicationFrom) && !empty($typeofexamination->applicationTo)) {{ date('d F Y', strtotime($typeofexamination->applicationFrom)) }} - {{ date('d F Y', strtotime($typeofexamination->applicationTo)) }} @else Not updated yet @endif</td>
                        </tr>
                        <tr>
                            <th>Exmination Date</th>
                            <td>{{ $typeofexamination->exminationDate or 'Not updated yet' }}</td>
                        </tr>
                        <tr>
                            <th>Result Announce</th>
                            <td>{{ $typeofexamination->resultAnnounce or 'Not updated yet' }}</td>
                        </tr>
                        <tr>
                            <th>Exam Section</th>
                            <td>{{ $typeofexamination->exam_sectionsName or 'Not updated yet' }}</td>
                        </tr>
                        <tr>
                            <th>Examination Type</th>
                            <td>{{ $typeofexamination->examination_typesName or 'Not updated yet' }}</td>
                        </tr>
                        <tr>
                            <th>Application And Exam Status</th>
                            <td>{{ $typeofexamination->applicationexamstatusesName or 'Not updated yet' }}</td>
                        </tr>
                        <tr>
                            <th>Application Mode</th>
                            <td>{{ $typeofexamination->application_modesName or 'Not updated yet' }}</td>
                        </tr>
                        <tr>
                            <th>Examination Mode</th>
                            <td>{{ $typeofexamination->examination_modesName or 'Not updated yet' }}</td>
                        </tr>
                        <tr>
                            <th>Eligibility Criteria</th>
                            <td>{{ $typeofexamination->eligibility_criteriasName or 'Not updated yet' }}</td>
                        </tr>
                        <tr>
                            <th>Mode Of Payment</th>
                            <td>
                               @if($typeofexamination->modeofpayment == 1)
                                    <span class="font-bold badge badge-warning">Online</span>
                                @elseif($typeofexamination->modeofpayment == 2)
                                    <span class="font-bold badge badge-success">Offline</span>
                                @elseif($typeofexamination->modeofpayment == 3)
                                    <span class="font-bold badge badge-success">Online & Offline</span>
                                @else
                                    <span class="font-bold badge badge-danger">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($typeofexamination->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $typeofexamination->eUserId) }}" @endif>{{ $typeofexamination->employeeFirstname }} {{ $typeofexamination->employeeMiddlename}} {{ $typeofexamination->employeeLastname}} (ID:- {{ $typeofexamination->eUserId}}) Date & Time:-  {{ $typeofexamination->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>

@endsection