@extends('administrator/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Card Type Details <a href="{{ url('administrator/cardtype/create') }}" class="btn btn-primary pull-right btn-sm">Add New Card Type</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('administrator/cardtype') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $cardtype->id }}</td>
                        </tr>
                        <tr>
                            <th>Card Type Name</th>
                            <td>{{ $cardtype->name }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($cardtype->eUserId)
                                <a href="{{ url('administrator/users', $cardtype->eUserId) }}">{{ $cardtype->employeeFirstname }} {{ $cardtype->employeeMiddlename}} {{ $cardtype->employeeLastname}} (ID:- {{ $cardtype->eUserId}}) Date & Time:-  {{ $cardtype->updated_at}}</a>
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
