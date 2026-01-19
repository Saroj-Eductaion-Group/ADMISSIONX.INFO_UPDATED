@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Logs Details <a href="{{ url('employee/logs/create') }}" class="btn btn-primary pull-right btn-sm">Add New Log Entry</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/logs') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $log->id }}</td>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <td><a href="{{ url('employee/users') }}/{{ $log->userID }}" title="{{ $log->firstname }} {{ $log->lastname }}">{{ $log->firstname }} {{ $log->lastname }} </a></td>
                        </tr>
                        <tr>
                            <th>Event Name</th>
                            <td>{{ $log->event }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($log->eUserId)
                                <a href="{{ url('employee/users', $log->eUserId) }}">{{ $log->employeeFirstname }} {{ $log->employeeMiddlename}} {{ $log->employeeLastname}} (ID:- {{ $log->eUserId}}) Date & Time:-  {{ $log->updated_at}}</a>
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