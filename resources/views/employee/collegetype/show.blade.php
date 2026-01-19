@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Type Details <a href="{{ url('employee/collegetype/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Type</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('employee/collegetype') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $collegetype->id }}</td>
                        </tr>
                        <tr>
                            <th>College Type Name</th>
                            <td>{{ $collegetype->name }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated by</th>
                            <td>
                                @if($collegetype->eUserId)
                                <a href="{{ url('employee/users', $collegetype->eUserId) }}">{{ $collegetype->employeeFirstname }} {{ $collegetype->employeeMiddlename}} {{ $collegetype->employeeLastname}} (ID:- {{ $collegetype->eUserId}}) Date & Time:-  {{ $collegetype->updated_at}}</a>
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