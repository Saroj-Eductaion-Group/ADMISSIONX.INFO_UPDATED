@extends('administrator/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Application Status Details <a href="{{ url('administrator/applicationstatus/create') }}" class="btn btn-primary pull-right btn-sm">Add New Application Status</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('administrator/applicationstatus') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $applicationstatus->id }}</td>
                        </tr>
                        <tr>
                            <th>Status Name</th>
                            <td>{{ $applicationstatus->name }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($applicationstatus->eUserId)
                                <a href="{{ url('administrator/users', $applicationstatus->eUserId) }}">{{ $applicationstatus->employeeFirstname }} {{ $applicationstatus->employeeMiddlename}} {{ $applicationstatus->employeeLastname}} (ID:- {{ $applicationstatus->eUserId}}) Date & Time:-  {{ $applicationstatus->updated_at}} </a></a>
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