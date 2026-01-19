@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Subscribe Details <a href="{{ url('employee/subscribe/create') }}" class="btn btn-primary pull-right btn-sm">Add New Subscribe</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('employee/subscribe') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $subscribe->id }}</td>
                        </tr>
                        <tr>
                            <th>Subscriber Name</th>
                            <td>
                                @if($subscribe->name)
                                    {{ $subscribe->name}}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $subscribe->email }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($subscribe->eUserId)
                                <a href="{{ url('employee/users', $subscribe->eUserId) }}">{{ $subscribe->employeeFirstname }} {{ $subscribe->employeeMiddlename}} {{ $subscribe->employeeLastname}} (ID:- {{ $subscribe->eUserId}}) Date & Time:-  {{ $subscribe->updated_at}}</a>
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