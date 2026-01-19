@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Entrance Exam Details <a href="{{ url('administrator/entranceexam/create') }}" class="btn btn-primary pull-right btn-sm">Add New Entrance Exam</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/entranceexam') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $entranceexam->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $entranceexam->name }} </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>@if( $entranceexam->description )
                                    {{ $entranceexam->description }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($entranceexam->eUserId)
                                <a href="{{ url('administrator/users', $entranceexam->eUserId) }}">{{ $entranceexam->employeeFirstname }} {{ $entranceexam->employeeMiddlename}} {{ $entranceexam->employeeLastname}} (ID:- {{ $entranceexam->eUserId}}) Date & Time:-  {{ $entranceexam->updated_at}}</a>
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