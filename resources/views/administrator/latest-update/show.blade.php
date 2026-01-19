@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('LatestUpdate'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Latest Update Details {{ $latestupdate->id }}  <a href="{{ url($fetchDataServiceController->routeCall().'/latest-update') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                        <a href="{{ url($fetchDataServiceController->routeCall().'/latest-update/' . $latestupdate->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit latestupdate"><i class="fa fa-pencil"></i> Edit</a>
                        @endif
                    @else
                        <a href="{{ url($fetchDataServiceController->routeCall().'/latest-update/' . $latestupdate->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit latestupdate"><i class="fa fa-pencil"></i> Edit</a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/latest-update', $latestupdate->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete latestupdate',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif

               <a href="{{ url($fetchDataServiceController->routeCall().'/latest-update') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $latestupdate->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $latestupdate->name }} </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $latestupdate->desc !!}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ date('F dS Y', strtotime($latestupdate->date)) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $latestupdate->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($latestupdate->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $latestupdate->eUserId) }}" @endif>{{ $latestupdate->employeeFirstname }} {{ $latestupdate->employeeMiddlename}} {{ $latestupdate->employeeLastname}} (ID:- {{ $latestupdate->eUserId}}) Date & Time:-  {{ $latestupdate->updated_at}} </a></a>
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