@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Degree Details <a href="{{ url('employee/degree/create') }}" class="btn btn-primary pull-right btn-sm">Add New Degree</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('employee/degree') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $degree->id }}</td>
                        </tr>
                        <tr>
                            <th>Degree Name</th>
                            <td>{{ $degree->name }}</td>
                        </tr>
                        <tr>
                             <th>Stream</th>
                            <td>{{ $degree->functionalareaName }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($degree->eUserId)
                                <a href="{{ url('employee/users', $degree->eUserId) }}">{{ $degree->employeeFirstname }} {{ $degree->employeeMiddlename}} {{ $degree->employeeLastname}} (ID:- {{ $degree->eUserId}}) Date & Time:-  {{ $degree->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        @include('common-partials.common-fileds-details-partial')
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