@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeAdmissionProcedure'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Admission Procedure {{ $collegeadmissionprocedure->id }} 
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Admission Procedure</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Admission Procedure</a>
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
               <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/' . $collegeadmissionprocedure->id . '/edit') }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => [$fetchDataServiceController->routeCall().'/college-admission-procedure', $collegeadmissionprocedure->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete College Admission Procedure',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                       <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/' . $collegeadmissionprocedure->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit College Admission Procedure"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/college-admission-procedure', $collegeadmissionprocedure->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete College Admission Procedure',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}

                    @endif
                @endif
           
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $collegeadmissionprocedure->id }}</td> 
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td>
                                {{ $collegeadmissionprocedure->collegeUserFirstName }} <hr>
                                <a href="{{ url('college/' . $collegeadmissionprocedure->slug) }}" target="_blank" class="btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> College Public View</a>
                                @if(Auth::check()) @if(Auth::user()->userrole_id == 1)
                                <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $collegeadmissionprocedure->collegeprofile_id) }}" class="btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> College Profile</a>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/users', $collegeadmissionprocedure->collegeUserID) }}" class="btn btn-sm btn-primary" title="edit"><i class="fa fa-edit"></i> User Details</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>
                                @if( $collegeadmissionprocedure->title )
                                    {{ $collegeadmissionprocedure->title }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td>
                                @if( $collegeadmissionprocedure->functionalAreaName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/functionalarea') }}/{{ $collegeadmissionprocedure->functionalareaID }}" @endif title="{{ $collegeadmissionprocedure->firstname }} {{ $collegeadmissionprocedure->lastname }}">{{ $collegeadmissionprocedure->functionalAreaName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Degree</th>
                            <td>
                                @if( $collegeadmissionprocedure->degreeName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/degree') }}/{{ $collegeadmissionprocedure->degreeId }}" @endif title="{{ $collegeadmissionprocedure->firstname }} {{ $collegeadmissionprocedure->lastname }}">{{ $collegeadmissionprocedure->degreeName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <td>
                                @if( $collegeadmissionprocedure->courseName)
                                   <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/course') }}/{{ $collegeadmissionprocedure->courseID }}" @endif title="{{ $collegeadmissionprocedure->courseName }} {{ $collegeadmissionprocedure->lastname }}"> {{ $collegeadmissionprocedure->courseName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Degree Level</th>
                            <td>
                                @if( $collegeadmissionprocedure->educationlevelName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/educationlevel') }}/{{ $collegeadmissionprocedure->educationlevelId }}" @endif title="{{ $collegeadmissionprocedure->firstname }} {{ $collegeadmissionprocedure->lastname }}">{{ $collegeadmissionprocedure->educationlevelName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course Type</th>
                            <td>
                                @if( $collegeadmissionprocedure->coursetypeName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/coursetype') }}/{{ $collegeadmissionprocedure->coursetypeId }}" @endif title="{{ $collegeadmissionprocedure->firstname }} {{ $collegeadmissionprocedure->lastname }}">{{ $collegeadmissionprocedure->coursetypeName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <th>Description</th>
                            <td>{!! $collegeadmissionprocedure->description !!} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($collegeadmissionprocedure->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $collegeadmissionprocedure->eUserId) }}" @endif>{{ $collegeadmissionprocedure->employeeFirstname }} {{ $collegeadmissionprocedure->employeeMiddlename}} {{ $collegeadmissionprocedure->employeeLastname}} (ID:- {{ $collegeadmissionprocedure->eUserId}}) <hr> Date & Time:-  {{ $collegeadmissionprocedure->updated_at}} </a></a>
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
    <div class="col-md-12">
        <div class="white-bg">
            <div class="panel-body">
                <h4 class=""><strong>Important Dates</strong></h4>
                @if(sizeof($importantDatesObj) > 0)
                <div class="ibox-content table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Form Date</th>
                                <th>To Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($importantDatesObj as $key1 => $item2)
                            <tr>
                                <td>{{ $item2->eventName }}</td>
                                <td width="10%">{{ $item2->fromdate }}</td>
                                <td width="10%">{{ $item2->todate }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="profile-bio">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="headline text-center">
                                <h2 class="">No Important Dates Added...</h2>
                            </div>
                        </div>                          
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection