@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Alltableinformation Details <a href="{{ url('employee/alltableinformation/create') }}" class="btn btn-primary pull-right btn-sm">Add New Alltableinformation</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/alltableinformation') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $alltableinformation->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $alltableinformation->name }} </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>
                            @if( $alltableinformation->description )
                                {{ $alltableinformation->description }}
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