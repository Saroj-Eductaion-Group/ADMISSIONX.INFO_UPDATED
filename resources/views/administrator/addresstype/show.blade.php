@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <!-- <h2>Address Type Details <a href="{{ url('administrator/addresstype/create') }}" class="btn btn-primary pull-right btn-sm">Add New Address Type</a></h2> -->
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/addresstype') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $addresstype->id }}</td> 
                        </tr>
                        <tr>
                            <th>Type Of Address</th>
                            <td>{{ $addresstype->name }} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($addresstype->eUserId)
                                <a href="{{ url('administrator/users', $addresstype->eUserId) }}">{{ $addresstype->employeeFirstname }} {{ $addresstype->employeeMiddlename}} {{ $addresstype->employeeLastname}} (ID:- {{ $addresstype->eUserId}}) Date & Time:-  {{ $addresstype->updated_at}}</a>
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