@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Faculty Details <a href="{{ url('employee/faculty/create') }}" class="btn btn-primary pull-right btn-sm">Add New Faculty</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/faculty') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $faculty->id }}</td> 
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td><a href="{{ URL('employee/collegeprofile', $faculty->collegeprofileId) }}">{{ $faculty->firstname }}</a></td>
                        </tr>
                        <tr>
                            <th>Course Detail</th>
                            <td>{{ $faculty->functionalareaName }} / {{ $faculty->degreeName }} / {{ $faculty->courseName }}</td>
                        </tr>
                        <tr>
                            <th>Faculty Name</th>
                            <td>{{ $faculty->suffix }} {{ $faculty->name }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $faculty->description }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($faculty->eUserId)
                                <a href="{{ url('employee/users', $faculty->eUserId) }}">{{ $faculty->employeeFirstname }} {{ $faculty->employeeMiddlename}} {{ $faculty->employeeLastname}} (ID:- {{ $faculty->eUserId}}) Date & Time:-  {{ $faculty->updated_at}}</a>
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