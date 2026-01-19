@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Facilities Details <a href="{{ url('employee/facilities/create') }}" class="btn btn-primary pull-right btn-sm">Add New Facilities</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('employee/facilities') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $facility->id }}</td>
                        </tr>
                        <tr>
                            <th>Facility Name</th>
                            <td>{{ $facility->name }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($facility->eUserId)
                                <a href="{{ url('employee/users', $facility->eUserId) }}">{{ $facility->employeeFirstname }} {{ $facility->employeeMiddlename}} {{ $facility->employeeLastname}} (ID:- {{ $facility->eUserId}}) Date & Time:-  {{ $facility->updated_at}}</a>
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