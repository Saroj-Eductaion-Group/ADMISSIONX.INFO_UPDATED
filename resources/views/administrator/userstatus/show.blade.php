@extends('administrator/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>User Status Details <a href="{{ url('administrator/userstatus/create') }}" class="btn btn-primary pull-right btn-sm">Add New User Status</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/userstatus') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID.</th> 
                            <th>Name</th>
                            <th>Last Update By</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $userstatus as $item)
                        <tr>
                            <td>{{ $item->id }}</td> 
                            <td> {{ $item->name }} </td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}})</a>
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