@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Request to make college profile form details</h2>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url($fetchDataServiceController->routeCall().'/request/create-college-account') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <table class="table table-bordered">
                    <tbody class="tbody">
                        <tr>
                            <th>ID</th>
                            <td>{{ $requestforcreatecollegeaccount->id }}</td> 
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td>{{ $requestforcreatecollegeaccount->collegeName }} </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $requestforcreatecollegeaccount->email }} </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $requestforcreatecollegeaccount->phone }} </td>
                        </tr>

                        <tr>
                            <th>Contact Person Name</th>
                            <td>{{ $requestforcreatecollegeaccount->contactPersonName }} </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $requestforcreatecollegeaccount->status == '1' )
                                    <span class="label label-success">Approved</span>
                                @else
                                    <span class="label label-danger">Pending</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ date('d F Y h:i a', strtotime($requestforcreatecollegeaccount->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($requestforcreatecollegeaccount->eUserId)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $requestforcreatecollegeaccount->eUserId) }}" @endif>{{ $requestforcreatecollegeaccount->employeeFirstname }} {{ $requestforcreatecollegeaccount->employeeMiddlename}} {{ $requestforcreatecollegeaccount->employeeLastname}} (ID:- {{ $requestforcreatecollegeaccount->eUserId}}) <hr> Date & Time:- {{ $requestforcreatecollegeaccount->updated_at}}</a>
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

@section('script')

@endsection