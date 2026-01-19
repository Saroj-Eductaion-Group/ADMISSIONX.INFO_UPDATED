@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Users Details <a href="{{ url('employee/users/create') }}" class="btn btn-primary pull-right btn-sm">Add New User</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('employee/users') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                    @foreach( $users as $user)
                        <tr>
                            <th>ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        
                        @if($user->userrole_id == '2')
                            <tr>
                                <th>College Name</th>
                                <td>
                                    @if($user->firstname)
                                        {{ $user->firstname }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                        @else
                            <tr>
                                <th>Suffix</th>
                                <td>
                                    @if($user->suffix)
                                        {{ $user->suffix }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td>
                                    @if($user->firstname)
                                        {{ $user->firstname }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Middle Name</th>
                                <td>
                                    @if($user->middlename)
                                        {{ $user->middlename }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>
                                    @if($user->lastname)
                                        {{ $user->lastname }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th>Email</th>
                            <td>
                                @if($user->email)
                                    {{ $user->email }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                @if($user->phone)
                                    {{ $user->phone }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>User Role</th>
                            <td>{{ $user->userRoleName }}</td>
                        </tr>
                        <tr>
                            <th>User Status</th>
                            <td>{{ $user->userStatusName }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($user->eUserId)
                                <a href="{{ url('employee/users', $user->eUserId) }}">{{ $user->employeeFirstname }} {{ $user->employeeMiddlename}} {{ $user->employeeLastname}} (ID:- {{ $user->eUserId}}) Date & Time:-  {{ $user->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</div>

@endsection