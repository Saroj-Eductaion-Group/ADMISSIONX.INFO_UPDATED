@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Query Details <!-- <a href="{{ url('/administrator/query-college-student') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                     <h5>Here are the details</h5>              
                </div>

                <div class="ibox-content">
                    <div class="row">
                        @foreach( $queryInfo as $item )
                        <div class="col-md-6">                            
                            <h2><a href="javascript:void(0);"><i class="fa fa-comments"></i> {{ $item->subject }}</a></h2>                                                        
                    	</div>
                        <div class="col-md-6 text-right">
                            <h2><i class="fa fa-calendar"></i> {{ date('M d, Y', strtotime($item->created_at)) }}</h2>
                        </div>
                        @endforeach                        
                    </div>
                    <hr class="hr-line-dashed">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach( $query as $item )
                                @if( $item->queryflowtype == 'student-to-college' )
                                	<div class="row">
                                		<div class="col-md-12 text-left">
                                			<p><a href="javascript:void(0);"><i class="fa fa-user"></i> {{ $item->sFirstName }} {{ $item->sLastName }} (Student)</a> : {{ $item->message }}</p>
                                		</div>
                            		</div>                                        
                                    <hr class="hr-line-dashed">
                                @else
                                	<div class="row">
                                		<div class="col-md-12 text-right">
                                			<p><a href="javascript:void(0);"><i class="fa fa-graduation-cap"></i> {{ $item->cName }} (College)</a> : {{ $item->message }}</p>
                                		</div>
                            		</div>                                        
                                    <hr class="hr-line-dashed">
                                @endif
                                <div>
                                    <h4>Last Updated By:-
                                    @if($item->eUserId)
                                    <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}})  Date & Time:- {{ $item->updated_at}}</a>
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                    </h4>
                                </div>
                            @endforeach    
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection