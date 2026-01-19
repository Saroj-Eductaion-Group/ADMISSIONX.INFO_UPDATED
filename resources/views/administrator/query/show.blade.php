@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Query Details <!-- <a href="{{ url('administrator/query/create') }}" class="btn btn-primary pull-right btn-sm">Add New Query</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/query') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $query->id }}</td> 
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($query->eUserId)
                                <a href="{{ url('administrator/users', $query->eUserId) }}">{{ $query->employeeFirstname }} {{ $query->employeeMiddlename}} {{ $query->employeeLastname}} (ID:- {{ $query->eUserId}}) Date & Time:-  {{ $query->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>
                                @if( $query->subject )
                                   <a href="{{ url('administrator/query', $query->id) }}">{{ $query->subject }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Message</th>
                            <td>{{ $query->message }}</td>
                        </tr>
                        <tr>
                            <th>Administrator Name</th>
                            <td>
                                @if( $query->U1Id )
                                   <a href="{{ url('administrator/users', $query->U1Id) }}">{{ $query->U1FirstName }} {{ $query->U1MiddleName }} {{ $query->U1LastName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td>
                                @if( $query->U2Id )
                                  <a href="{{ url('administrator/collegeprofile', $query->collegeprofileID) }}">{{ $query->U2FirstName }} {{ $query->U2MiddleName }} {{ $query->U2LastName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr> 
                            <th>Student Name</th>
                             <td>
                                @if( $query->U3Id )
                                 <a href="{{ url('administrator/studentprofile', $query->studentprofileID) }}">{{ $query->U3FirstName }} {{ $query->U3MiddleName }} {{ $query->U3LastName }}</a>
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