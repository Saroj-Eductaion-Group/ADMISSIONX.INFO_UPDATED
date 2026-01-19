@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Facility Details <a href="{{ url('administrator/collegefacilities/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Facility</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/collegefacilities') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $collegefacility->id }}</td> 
                        </tr>
                         <tr>
                            <th>College Name</th>
                            <td>
                                @if( $collegefacility->collegeprofileID)
                                    <a href="{{ url('administrator/collegeprofile') }}/{{ $collegefacility->collegeprofileID }}" title="{{ $collegefacility->firstname }} {{ $collegefacility->lastname }}">{{ $collegefacility->firstname }} {{ $collegefacility->lastname }} </a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Facility</th>
                             <td>
                                @if( $collegefacility->facilitiesName)
                                    {{ $collegefacility->facilitiesName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                         <tr>
                            <th>Description</th>
                            <td>
                                @if( $collegefacility->description)
                                    {{ $collegefacility->description }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($collegefacility->eUserId)
                                <a href="{{ url('administrator/users', $collegefacility->eUserId) }}">{{ $collegefacility->employeeFirstname }} {{ $collegefacility->employeeMiddlename}} {{ $collegefacility->employeeLastname}} (ID:- {{ $collegefacility->eUserId}}) Date & Time:-  {{ $collegefacility->updated_at}}</a>
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