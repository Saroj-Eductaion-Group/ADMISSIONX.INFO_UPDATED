@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <!--  <div class="col-lg-12">
        <h2>Application Status Message Details <a href="{{ url('administrator/applicationstatusmessage/create') }}" class="btn btn-primary pull-right btn-sm">Add New Application Status Message</a></h2>
    </div> -->
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/applicationstatusmessage') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Application Id</th>
                            <td>
                                @if( $applicationstatusmessage->applicationId )
                                   <a href="{{ url('administrator/application', $applicationstatusmessage->applicationId) }}">{{ $applicationstatusmessage->applicationId }}</a> 
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($applicationstatusmessage->eUserId)
                                <a href="{{ url('administrator/users', $applicationstatusmessage->eUserId) }}">{{ $applicationstatusmessage->employeeFirstname }} {{ $applicationstatusmessage->employeeMiddlename}} {{ $applicationstatusmessage->employeeLastname}} (ID:- {{ $applicationstatusmessage->eUserId}})  Date & Time:- {{ $applicationstatusmessage->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Student Name</th>
                            <td>
                                @if( $applicationstatusmessage->studentUserFirstName )
                                   <a href="{{ url('administrator/studentprofile', $applicationstatusmessage->studentprofileId) }}">{{ $applicationstatusmessage->studentUserFirstName }} {{ $applicationstatusmessage->studentUserMiddleName }} {{ $applicationstatusmessage->studentUserLastName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>College Profile</th>
                            <td>
                                @if( $applicationstatusmessage->collegeprofileID )
                                   <a href="{{ url('administrator/collegeprofile', $applicationstatusmessage->collegeprofileID) }}">{{ $applicationstatusmessage->collegeUserFirstName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <th>Course</th>
                            <td>
                                @if( $applicationstatusmessage->collegemasterId )
                                   {{ $applicationstatusmessage->functionalareaName }} / {{ $applicationstatusmessage->degreeName }} / {{ $applicationstatusmessage->courseName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Application Status</th>
                            <td>
                                @if( $applicationstatusmessage->applicationStatus =='Approved' )
                                    <button class="btn btn-w-m btn-primary">{{ $applicationstatusmessage->applicationStatus }}</button>
                                @elseif( $applicationstatusmessage->applicationStatus =='Pending' )
                                    <button class="btn btn-w-m btn-warning">{{ $applicationstatusmessage->applicationStatus }}</button>
                                @elseif( $applicationstatusmessage->applicationStatus =='Rejected' )
                                    <button class="btn btn-w-m btn-info">{{ $applicationstatusmessage->applicationStatus }}</button>
                                @else
                                    <button class="btn btn-w-m btn-danger">{{ $applicationstatusmessage->applicationStatus }}</button>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Remark Application</th>
                            <td>
                                @if( $applicationstatusmessage->others )
                                   {{ $applicationstatusmessage->others }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>                        
                        <tr>
                            <th>Message</th>
                            <td>
                                @if( $applicationstatusmessage->message )
                                   {{ $applicationstatusmessage->message }}
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