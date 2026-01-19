@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Course Type Details <a href="{{ url('employee/coursetype/create') }}" class="btn btn-primary pull-right btn-sm">Add New Course Type</a></h2>
    </div>
</div>
 -->
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/coursetype') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $coursetype->id }}</td>
                        </tr>
                        <tr>
                            <th>Course Type Name</th>
                            <td>{{ $coursetype->name }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated by</th>
                            <td>
                                @if($coursetype->eUserId)
                                <a href="{{ url('employee/users', $coursetype->eUserId) }}">{{ $coursetype->employeeFirstname }} {{ $coursetype->employeeMiddlename}} {{ $coursetype->employeeLastname}} (ID:- {{ $coursetype->eUserId}}) Date & Time:-  {{ $coursetype->updated_at}}</a>
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