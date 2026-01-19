@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeManagementDetail'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Management Details {{ $collegemanagementdetail->id }}  
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-management-details/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Management Details</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/college-management-details/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Management Details</a>
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
               <a href="{{ url($fetchDataServiceController->routeCall().'/college-management-details') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/college-management-details/' . $collegemanagementdetail->id . '/edit') }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => [$fetchDataServiceController->routeCall().'/college-management-details', $collegemanagementdetail->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete College Management Details',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                       <a href="{{ url($fetchDataServiceController->routeCall().'/college-management-details/' . $collegemanagementdetail->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit College Management Details"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/college-management-details', $collegemanagementdetail->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete College Management Details',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}

                    @endif
                @endif
           
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $collegemanagementdetail->id }}</td> 
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td>
                                {{ $collegemanagementdetail->collegeUserFirstName }} <hr>
                                <a href="{{ url('college/' . $collegemanagementdetail->slug) }}" target="_blank" class="btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> College Public View</a>
                                @if(Auth::check() && Auth::user()->userrole_id == 1)
                                <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $collegemanagementdetail->collegeprofile_id) }}" class="btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> College Profile</a>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/users', $collegemanagementdetail->collegeUserID) }}" class="btn btn-sm btn-primary" title="edit"><i class="fa fa-edit"></i> User Details</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Contact Person</th>
                            <td>
                                @if( $collegemanagementdetail->name )
                                   {{$collegemanagementdetail->suffix}} {{ $collegemanagementdetail->name }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>
                                @if( $collegemanagementdetail->designation )
                                    {{ $collegemanagementdetail->designation }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>
                                @if($collegemanagementdetail->gender)
                                    @if($collegemanagementdetail->gender == "1") Male @elseif($collegemanagementdetail->gender == "2") Female @elseif($collegemanagementdetail->gender == "3") Other @endif
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                @if( $collegemanagementdetail->emailaddress )
                                    {{ $collegemanagementdetail->emailaddress }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                @if( $collegemanagementdetail->phoneno )
                                    {{ $collegemanagementdetail->phoneno }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Office Number</th>
                            <td>
                                @if( $collegemanagementdetail->landlineNo )
                                    {{ $collegemanagementdetail->landlineNo }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Icon Image</th>
                            <td> 
                                @if(!empty($collegemanagementdetail->picture))
                                    <img src="{{ asset('gallery'.'/'.$collegemanagementdetail->slug.'/'.$collegemanagementdetail->picture) }}" width="120" height="120" alt="{{ $collegemanagementdetail->name }} Profile Image">
                                @else
                                    <img src="/assets/images/no-college-logo.jpg" style="width:100%;" alt="{{ $collegemanagementdetail->name }} Profile Image">
                                @endif
                            </td>
                        </tr>
                       <!--  <tr>
                            <th>About</th>
                            <td>{!! $collegemanagementdetail->about !!} </td>
                        </tr> -->
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($collegemanagementdetail->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $collegemanagementdetail->eUserId) }}" @endif>{{ $collegemanagementdetail->employeeFirstname }} {{ $collegemanagementdetail->employeeMiddlename}} {{ $collegemanagementdetail->employeeLastname}} (ID:- {{ $collegemanagementdetail->eUserId}}) <hr> Date & Time:-  {{ $collegemanagementdetail->updated_at}} </a></a>
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