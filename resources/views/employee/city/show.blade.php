@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>City Details <a href="{{ url('employee/city/create') }}" class="btn btn-primary pull-right btn-sm">Add New City</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/city') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $city->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $city->name }} </td>
                        </tr>
                        <tr>
                            <th>City Status</th>
                            <td>
                                @if($city->cityStatus == '1') 
                                   <span class="label label-success">Active</span> 
                                @else
                                   <span class="label label-warning">Inactive</span> 
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>State Name</th>
                            <td>{{ $city->stateName }}</td>
                        </tr>
                        @include('common-partials.common-fileds-details-partial')
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($city->eUserId)
                                <a href="{{ url('employee/users', $city->eUserId) }}">{{ $city->employeeFirstname }} {{ $city->employeeMiddlename}} {{ $city->employeeLastname}} (ID:- {{ $city->eUserId}}) Date & Time:-  {{ $city->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>

@endsection