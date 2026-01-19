@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeCutOff'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College CutOff {{ $collegecutoff->id }} 
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-cut-offs/create') }}" class="btn btn-primary pull-right btn-sm">Add New College CutOff</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/college-cut-offs/create') }}" class="btn btn-primary pull-right btn-sm">Add New College CutOff</a>
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
               <a href="{{ url($fetchDataServiceController->routeCall().'/college-cut-offs') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/college-cut-offs/' . $collegecutoff->id . '/edit') }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => [$fetchDataServiceController->routeCall().'/college-cut-offs', $collegecutoff->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete College CutOff',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                       <a href="{{ url($fetchDataServiceController->routeCall().'/college-cut-offs/' . $collegecutoff->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit College CutOff"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/college-cut-offs', $collegecutoff->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete College CutOff',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif
           
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $collegecutoff->id }}</td> 
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td>
                                {{ $collegecutoff->collegeUserFirstName }} <hr>
                                <a href="{{ url('college/' . $collegecutoff->slug) }}" target="_blank" class="btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> College Public View</a>
                                @if(Auth::check() && Auth::user()->userrole_id == 1)
                                <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $collegecutoff->collegeprofile_id) }}" class="btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> College Profile</a>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/users', $collegecutoff->collegeUserID) }}" class="btn btn-sm btn-primary" title="edit"><i class="fa fa-edit"></i> User Details</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>
                                @if( $collegecutoff->title )
                                    {{ $collegecutoff->title }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td>
                                @if( $collegecutoff->functionalAreaName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else  href="{{ url($fetchDataServiceController->routeCall().'/functionalarea') }}/{{ $collegecutoff->functionalareaID }}" @endif title="{{ $collegecutoff->firstname }} {{ $collegecutoff->lastname }}">{{ $collegecutoff->functionalAreaName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Degree</th>
                            <td>
                                @if( $collegecutoff->degreeName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else  href="{{ url($fetchDataServiceController->routeCall().'/degree') }}/{{ $collegecutoff->degreeId }}" @endif title="{{ $collegecutoff->firstname }} {{ $collegecutoff->lastname }}">{{ $collegecutoff->degreeName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <td>
                                @if( $collegecutoff->courseName)
                                   <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else  href="{{ url($fetchDataServiceController->routeCall().'/course') }}/{{ $collegecutoff->courseID }}" @endif title="{{ $collegecutoff->courseName }} {{ $collegecutoff->lastname }}"> {{ $collegecutoff->courseName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Degree Level</th>
                            <td>
                                @if( $collegecutoff->educationlevelName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else  href="{{ url($fetchDataServiceController->routeCall().'/educationlevel') }}/{{ $collegecutoff->educationlevelId }}" @endif title="{{ $collegecutoff->firstname }} {{ $collegecutoff->lastname }}">{{ $collegecutoff->educationlevelName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course Type</th>
                            <td>
                                @if( $collegecutoff->coursetypeName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else  href="{{ url($fetchDataServiceController->routeCall().'/coursetype') }}/{{ $collegecutoff->coursetypeId }}" @endif title="{{ $collegecutoff->firstname }} {{ $collegecutoff->lastname }}">{{ $collegecutoff->coursetypeName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <th>Description</th>
                            <td>{!! $collegecutoff->description !!} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($collegecutoff->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else  href="{{ url($fetchDataServiceController->routeCall().'/users', $collegecutoff->eUserId) }}" @endif>{{ $collegecutoff->employeeFirstname }} {{ $collegecutoff->employeeMiddlename}} {{ $collegecutoff->employeeLastname}} (ID:- {{ $collegecutoff->eUserId}}) <hr> Date & Time:-  {{ $collegecutoff->updated_at}} </a></a>
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