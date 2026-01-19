@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeSportsActivity'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Sports & Activity {{ $collegesportsactivity->id }}  
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Sports & Activity</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Sports & Activity</a>
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
               <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/' . $collegesportsactivity->id . '/edit') }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => [$fetchDataServiceController->routeCall().'/college-sports-activity', $collegesportsactivity->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete College Sports & Activity',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                       <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/' . $collegesportsactivity->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit College Sports & Activity"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/college-sports-activity', $collegesportsactivity->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete College Sports & Activity',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}

                    @endif
                @endif
           
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $collegesportsactivity->id }}</td> 
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td>
                                {{ $collegesportsactivity->collegeUserFirstName }} <hr>
                                <a href="{{ url('college/' . $collegesportsactivity->slug) }}" target="_blank" class="btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> College Public View</a>
                                @if(Auth::check() && Auth::user()->userrole_id == 1)
                                <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $collegesportsactivity->collegeprofile_id) }}" class="btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> College Profile</a>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/users', $collegesportsactivity->collegeUserID) }}" class="btn btn-sm btn-primary" title="edit"><i class="fa fa-edit"></i> User Details</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Type Of Activity</th>
                            <td>
                                @if($collegesportsactivity->typeOfActivity == 1)
                                    Outdoor Sports
                                @elseif($collegesportsactivity->typeOfActivity == 2)
                                    Indoor Sports
                                @elseif($collegesportsactivity->typeOfActivity == 3)
                                    Co-curricular Activity
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sports & Activity Name</th>
                            <td>
                                @if($collegesportsactivity->name)
                                    {{ $collegesportsactivity->name }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($collegesportsactivity->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $collegesportsactivity->eUserId) }}" @endif>{{ $collegesportsactivity->employeeFirstname }} {{ $collegesportsactivity->employeeMiddlename}} {{ $collegesportsactivity->employeeLastname}} (ID:- {{ $collegesportsactivity->eUserId}}) <hr> Date & Time:-  {{ $collegesportsactivity->updated_at}} </a></a>
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