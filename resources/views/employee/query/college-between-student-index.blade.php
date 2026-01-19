@extends('employee/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Query Details <!-- <a href="{{ url('employee/query/create') }}" class="btn btn-primary pull-right btn-sm">Add New Query</a> --></h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                     <h5>Here are the details</h5>              
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Chat Between College &amp;  Student</h2>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>College Name</th>
                                        <th>Student Name</th>
                                        <th>Chat Key</th>
                                        <th>Last Updated By</th>
                                        <th>Show</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $getAllQueriesBetween as $item)
                                        <tr>
                                            <td><a href="{{ URL('/employee/query-college-student-details', [$item->chatkey, $item->id]) }}">{{ $item->id }}</a></td>
                                            <td><a href="{{ URL('/employee/query-college-student-details', [$item->chatkey, $item->id]) }}">{{ $item->subject }}</a></td>
                                            <td>{{ str_limit($item->message, 50) }}</td>
                                            <td>
                                                @if( $item->collegeprofileID )
                                                  <a href="{{ url('employee/collegeprofile', $item->collegeprofileID) }}">{{ $item->U2FirstName }}</a>
                                                @else
                                                    <span class="label label-warning">Not Updated Yet</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if( $item->U3Id )
                                                  <a href="{{ url('employee/studentprofile', $item->studentprofileID) }}">{{ $item->U3FirstName }} {{ $item->U3MiddleName }} {{ $item->U3LastName }}</a>
                                                @else
                                                    <span class="label label-warning">Not Updated Yet</span>
                                                @endif
                                            </td>
                                            <td><span class="badge badge-info text-uppercase">{{ str_slug($item->queryflowtype, ' ') }}</span></td>
                                            <td>
                                                @if($item->eUserId)
                                                <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                                @else
                                                    <span class="label label-warning">Not Updated Yet</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ URL('/employee/query-college-student-details', [$item->chatkey, $item->id]) }}" class="btn btn-xs btn-info">Show</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <div class="pagination pull-right">{!! $getAllQueriesBetween->render() !!} </div>                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
