@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Country Details <a href="{{ url('employee/country/create') }}" class="btn btn-primary pull-right btn-sm">Add New Country</a></h2>
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
               <!-- <a href="{{ url('employee/country') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $country->id }}</td> 
                        </tr>
                        <tr>
                            <th>Country Name</th>
                            <td>{{ $country->name }} </td>
                        </tr>
                        @include('common-partials.common-fileds-details-partial')
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($country->eUserId)
                                <a href="{{ url('employee/users', $country->eUserId) }}">{{ $country->employeeFirstname }} {{ $country->employeeMiddlename}} {{ $country->employeeLastname}} (ID:- {{ $country->eUserId}}) Date & Time:-  {{ $country->updated_at}}</a>
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