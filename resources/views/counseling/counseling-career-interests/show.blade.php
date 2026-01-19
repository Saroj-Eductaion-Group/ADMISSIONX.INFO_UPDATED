@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CounselingCareerInterest'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Counseling Career Interest Details {{ $counselingcareerinterest->id }}  <a href="{{ url('counseling/counseling-career-interests/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling Career Interest</a></h2>
                @endif
            @else
                <h2>Counseling Career Interest Details {{ $counselingcareerinterest->id }}  <a href="{{ url('counseling/counseling-career-interests/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling Career Interest</a></h2>
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
               <a href="{{ url('counseling/counseling-career-interests') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url('counseling/counseling-career-interests/' . $counselingcareerinterest->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Eligibility Criteria"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['counseling/counseling-career-interests', $counselingcareerinterest->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Eligibility Criteria',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                        <a href="{{ url('counseling/counseling-career-interests/' . $counselingcareerinterest->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Eligibility Criteria"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['counseling/counseling-career-interests', $counselingcareerinterest->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Eligibility Criteria',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif
                
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $counselingcareerinterest->id }}</td> 
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td>{{ $counselingcareerinterest->functionalAreaName }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $counselingcareerinterest->title }} </td>
                        </tr>
                        <tr>
                            <th>Icon Image</th>
                            <td> 
                                @if(isset($counselingcareerinterest) && !empty($counselingcareerinterest->image))
                                    <img class="img-responsive thumbnail" width="200" src="/counselingimages/{{ $counselingcareerinterest->image }}" alt="{{ $counselingcareerinterest->image }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $counselingcareerinterest->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $counselingcareerinterest->description !!} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($counselingcareerinterest->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $counselingcareerinterest->eUserId) }}" @endif>{{ $counselingcareerinterest->employeeFirstname }} {{ $counselingcareerinterest->employeeMiddlename}} {{ $counselingcareerinterest->employeeLastname}} (ID:- {{ $counselingcareerinterest->eUserId}}) Date & Time:-  {{ $counselingcareerinterest->updated_at}} </a></a>
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