@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Invitation Details <a href="{{ url('employee/invite/create') }}" class="btn btn-primary pull-right btn-sm">Add New Invitation</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('employee/invite') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $invite->id }}</td>
                        </tr>
                        <tr>
                            <th>Link</th>
                            <td>{{ $invite->link }}</td>
                        </tr>
                        <tr>
                            <th>Refer Email</th>
                            <td>{{ $invite->referemail }}</td>
                        </tr>
                        <tr>
                            <th>Is Active Status</th>
                            <td>
                                @if( $invite->isactive )
                                    <span class="label label-success">YES</span>
                                @else
                                    <span class="label label-danger">NO</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <td><a href="{{ url('employee/users') }}/{{ $invite->userID }}" title="{{ $invite->firstname }} {{ $invite->middlename }} {{ $invite->lastname }}">{{ $invite->firstname }} {{ $invite->middlename }} {{ $invite->lastname }} </a></td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($invite->eUserId)
                                <a href="{{ url('employee/users', $invite->eUserId) }}">{{ $invite->employeeFirstname }} {{ $invite->employeeMiddlename}} {{ $invite->employeeLastname}} (ID:- {{ $invite->eUserId}}) Date & Time:-  {{ $invite->updated_at}}</a>
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