@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AdsTopCollegeList'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Ads Top College List Details {{ $adstopcollegelist->id }}  <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list/create') }}" class="btn btn-primary pull-right btn-sm">Add New Ads Top College List</a></h2>
                @endif
            @else
                <h2>Ads Top College List Details {{ $adstopcollegelist->id }}  <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list/create') }}" class="btn btn-primary pull-right btn-sm">Add New Ads Top College List</a></h2>
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
               <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list/' . $adstopcollegelist->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Ads Top College"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => [$fetchDataServiceController->routeCall().'/ads-top-college-list', $adstopcollegelist->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Ads Top College',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                        <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list/' . $adstopcollegelist->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Ads Top College"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/ads-top-college-list', $adstopcollegelist->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Ads Top College',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif
                @if(Session::has('flash_message'))
                    <div class="row margin-top20 margin-botttom20">
                        <div class="col-md-12">
                            <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ Session::get('flash_message') }}</strong>
                            </div>
                        </div>
                    </div>
                @endif
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $adstopcollegelist->id }}</td> 
                        </tr>
                        <tr>
                            <th>Method Type</th>
                            <td>{{ $adstopcollegelist->method_type }}</td> 
                        </tr>
                        <tr>
                            <th>Page Title</th>
                            <td>
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if(!empty($adstopcollegelist->course_id))
                                            {{ $adstopcollegelist->courseName }}
                                        @elseif(!empty($adstopcollegelist->educationlevel_id))
                                            {{ $adstopcollegelist->educationlevelName }}
                                        @elseif(!empty($adstopcollegelist->degree_id))
                                            {{ $adstopcollegelist->degreeName }}
                                        @elseif(!empty($adstopcollegelist->functionalarea_id))
                                            {{ $adstopcollegelist->functionalAreaName }}
                                        @elseif(!empty($adstopcollegelist->university_id))
                                            {{ $adstopcollegelist->universityName }}
                                        @elseif(!empty($adstopcollegelist->country_id))
                                            {{ $adstopcollegelist->countryName }}
                                        @elseif(!empty($adstopcollegelist->state_id))
                                            {{ $adstopcollegelist->stateName }}
                                        @elseif(!empty($adstopcollegelist->city_id))
                                            {{ $adstopcollegelist->cityName }}
                                        @else
                                            --
                                        @endif
                                    @else
                                        @if(!empty($adstopcollegelist->course_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/course/' . $adstopcollegelist->course_id) }}">{{ $adstopcollegelist->courseName }}</a>
                                        @elseif(!empty($adstopcollegelist->educationlevel_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/educationlevel/' . $adstopcollegelist->educationlevel_id) }}">{{ $adstopcollegelist->educationlevelName }}</a>
                                        @elseif(!empty($adstopcollegelist->degree_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/degree/' . $adstopcollegelist->degree_id) }}">{{ $adstopcollegelist->degreeName }}</a>
                                        @elseif(!empty($adstopcollegelist->functionalarea_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/' . $adstopcollegelist->functionalarea_id) }}">{{ $adstopcollegelist->functionalAreaName }}</a>
                                        @elseif(!empty($adstopcollegelist->university_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/university/' . $adstopcollegelist->university_id) }}">{{ $adstopcollegelist->universityName }}</a>
                                        @elseif(!empty($adstopcollegelist->country_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/address/' . $adstopcollegelist->country_id) }}">{{ $adstopcollegelist->countryName }}</a>
                                        @elseif(!empty($adstopcollegelist->state_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/city/' . $adstopcollegelist->state_id) }}">{{ $adstopcollegelist->stateName }}</a>
                                        @elseif(!empty($adstopcollegelist->city_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/state/' . $adstopcollegelist->city_id) }}">{{ $adstopcollegelist->cityName }}</a>
                                        @else
                                            --
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $adstopcollegelist->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>College List</th>
                            <td>
                                @if($adstopcollegelist->collegeprofile_id) 
                                    @foreach( $collegeListObj as $key1 => $item1 )
                                        <a href="{{ url('/college/' . strtolower($item1->slug)) }}" target="_blank" title="Go to Product View"><button class="btn btn-success btn-xs">{{ $item1->fullname }}</button></a>
                                    @endforeach
                                @else 
                                    <span class="badge badge-warning">Not Updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($adstopcollegelist->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $adstopcollegelist->eUserId) }}" @endif>{{ $adstopcollegelist->employeeFirstname }} {{ $adstopcollegelist->employeeMiddlename}} {{ $adstopcollegelist->employeeLastname}} (ID:- {{ $adstopcollegelist->eUserId}}) Date & Time:-  {{ $adstopcollegelist->updated_at}} </a></a>
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