@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>User Privilege Details <a href="{{ url('employee/userprivilege/create') }}" class="btn btn-primary pull-right btn-sm">Add New User Privilege</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <div class="row">
                   <!-- <div class=""><a href="{{ url('employee/userprivilege') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></div> -->
               </div>
               <div class="row">
                   <div class="col-md-6">
                       <h3>Employee Name : {{ $userprivilege->firstname }} {{ $userprivilege->middlename }} {{ $userprivilege->lastname }}</h3>
                   </div>
                   <div class="col-md-6">
                       <h3>Table Name : {{ $userprivilege->name }}</h3>
                   </div>                   
               </div>
               <hr class="hr-line-dashed">

                <div class="row">
                    <div class="col-md-4">
                        <h4>Create : 
                            @if( $userprivilege->create == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Update : 
                            @if( $userprivilege->edit == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Index / Show : 
                            @if( $userprivilege->index == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
               </div>
               <hr class="hr-line-dashed">
               <div class="row">
                    <div class="col-md-4">
                        <h4>Metrics 1 : 
                            @if( $userprivilege->metrics1 == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Metrics 2 : 
                            @if( $userprivilege->metrics2 == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Metrics 3 : 
                            @if( $userprivilege->metrics3 == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
               </div>
               <hr class="hr-line-dashed">

               <div class="row">
                    <div class="col-md-4">
                        <h4>Metrics 4 : 
                            @if( $userprivilege->metrics4 == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Metrics 5 : 
                            @if( $userprivilege->metrics5 == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Metrics 6 : 
                            @if( $userprivilege->metrics6 == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
               </div>
               <hr class="hr-line-dashed">

               <div class="row">
                   <div class="col-md-6">
                       <h4>Queries : 
                            @if( $userprivilege->queries == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                   </div>
                   <div class="col-md-6">
                       <h4>Last Updated By : 
                            @if($userprivilege->eUserId)
                            <a href="{{ url('employee/users', $userprivilege->eUserId) }}">{{ $userprivilege->employeeFirstname }} {{ $userprivilege->employeeMiddlename}} {{ $userprivilege->employeeLastname}} (ID:- {{ $userprivilege->eUserId}}) Date & Time:-  {{ $userprivilege->updated_at}}</a>
                            @else
                                <span class="label label-warning">Not Updated Yet</span>
                            @endif
                        </h4>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

@endsection