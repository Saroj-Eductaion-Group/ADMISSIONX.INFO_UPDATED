@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>User Group Details <a href="{{ url('employee/usergroup/create') }}" class="btn btn-primary pull-right btn-sm">Add New User Group</a></h2>
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
                   <!-- <div class=""><a href="{{ url('employee/usergroup') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></div> -->
               </div>
               <div class="row">
                    <div class="col-md-4">
                       <h3>User Group Name : {{ $usergroup->userGroupName }}</h3>
                    </div> 
                   <div class="col-md-4">
                       <h3>User Name : {{ $usergroup->firstname }} {{ $usergroup->middlename }} {{ $usergroup->lastname }}</h3>
                   </div>
                   <div class="col-md-4">
                       <h3>Table Name : {{ $usergroup->tableName }}</h3>
                   </div>                   
               </div>
               <hr class="hr-line-dashed">

                <div class="row">
                    <div class="col-md-4">
                        <h4>Create : 
                            @if( $usergroup->create_action == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Update : 
                            @if( $usergroup->edit_action == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Index  : 
                            @if( $usergroup->index_action == '1')
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
                        <h4>Show  : 
                            @if( $usergroup->show_action == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Metrics 1 : 
                            @if( $usergroup->metrics1_action == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Metrics 2 : 
                            @if( $usergroup->metrics2_action == '1')
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
                        <h4>Metrics 3 : 
                            @if( $usergroup->metrics3_action == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Metrics 4 : 
                            @if( $usergroup->metrics4_action == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div>    
                    <div class="col-md-4">
                        <h4>Metrics 5 : 
                            @if( $usergroup->metrics5_action == '1')
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
                        <h4>Metrics 6 : 
                            @if( $usergroup->metrics6_action == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                    </div> 
                   <div class="col-md-4">
                       <h4>Queries : 
                            @if( $usergroup->queries_action == '1')
                                <span class="text-info">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif    
                        </h4>
                   </div>
                   <div class="col-md-4">
                       <h4>Last Updated By : 
                        @if($usergroup->eUserId)
                        <a href="{{ url('employee/users', $usergroup->eUserId) }}">{{ $usergroup->employeeFirstname }} {{ $usergroup->employeeMiddlename}} {{ $usergroup->employeeLastname}} (ID:- {{ $usergroup->eUserId}}) Date & Time:-  {{ $usergroup->updated_at}}</a>
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