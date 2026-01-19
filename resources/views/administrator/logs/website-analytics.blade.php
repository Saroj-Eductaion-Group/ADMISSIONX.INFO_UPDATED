@extends('administrator/admin-layouts.master')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Website Analytics</h2>        
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated bounceInRight">
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">
                    <h2><span class="text-navy">AdmissionX - Analytics</span>
                    is provided with current <br>current status of users.</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Visits in last 24 hours</h5>
                    <h1 class="no-margins">{{ $getAllLastToday }}</h1>
                    <small>Total users</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Visits this week</h5>
                    <h1 class="no-margins">{{ $getAllCurrentWeek }}</h1>
                    <small>Total users</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Current month</h5>
                    <h1 class="no-margins">{{ $getAllCurrentMonth }}</h1>
                    <small>Total users</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Last 3 months</h5>
                    <h1 class="no-margins">{{ $getAllLastThreeWeek }}</h1>
                    <small>Total users</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Total users logged in 24 hours</h5>
                    <table class="table table-stripped small m-t-md">
                        <tbody>
                    	@foreach( $getAllLastTodayCounter as $key => $item )
                    	@if( $key == '0' )
                    		<tr>
	                            <td class="no-borders">
	                            	@if( $item->userRole == '2' )
	                            		<i class="fa fa-circle text-navy"></i> College : 
	                            	@elseif( $item->userRole == '3' )
	                            		<i class="fa fa-circle text-navy"></i> Student : 
	                            	@elseif( $item->userRole == '1' )
	                            		<i class="fa fa-circle text-navy"></i> Admin : 
	                            	@elseif( $item->userRole == '4' )
	                            		<i class="fa fa-circle text-navy"></i> Employee : 
	                            	@elseif( $item->userRole == '0' )
	                            		<i class="fa fa-circle text-danger"></i> Guest : 
	                            	@endif
	                                
	                            </td>
	                            <td class="no-borders">
	                                <div class="stat-percent font-bold text-navy" title="Total logged in users : {{ $item->totalCount }}">{{ $item->totalCount }} <i class="fa fa-bolt"></i></div>
	                            </td>
	                        </tr>
                    	@else
	                		<tr>
	                            <td>
	                            	@if( $item->userRole == '2' )
	                            		<i class="fa fa-circle text-navy"></i> College : 
	                            	@elseif( $item->userRole == '3' )
	                            		<i class="fa fa-circle text-navy"></i> Student : 
	                            	@elseif( $item->userRole == '1' )
	                            		<i class="fa fa-circle text-navy"></i> Admin : 
	                            	@elseif( $item->userRole == '4' )
	                            		<i class="fa fa-circle text-navy"></i> Employee : 
	                            	@elseif( $item->userRole == '0' )
	                            		<i class="fa fa-circle text-danger"></i> Guest : 
	                            	@endif
	                                
	                            </td>
	                            <td>
	                            	<div class="stat-percent font-bold text-navy" title="Total logged in users : {{ $item->totalCount }}">{{ $item->totalCount }} <i class="fa fa-bolt"></i></div>
	                            </td>
	                        </tr>
                        @endif
                    	@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Total users logged in this week</h5>
                    <table class="table table-stripped small m-t-md">
                        <tbody>
                    	@foreach( $getAllCurrentWeekCounter as $key => $item )
                    	@if( $key == '0' )
                    		<tr>
	                            <td class="no-borders">
	                            	@if( $item->userRole == '2' )
	                            		<i class="fa fa-circle text-navy"></i> College : 
	                            	@elseif( $item->userRole == '3' )
	                            		<i class="fa fa-circle text-navy"></i> Student : 
	                            	@elseif( $item->userRole == '1' )
	                            		<i class="fa fa-circle text-navy"></i> Admin : 
	                            	@elseif( $item->userRole == '4' )
	                            		<i class="fa fa-circle text-navy"></i> Employee : 
	                            	@elseif( $item->userRole == '0' )
	                            		<i class="fa fa-circle text-danger"></i> Guest : 
	                            	@endif
	                                
	                            </td>
	                            <td class="no-borders">
	                                <div class="stat-percent font-bold text-navy" title="Total logged in users : {{ $item->totalCount }}">{{ $item->totalCount }} <i class="fa fa-bolt"></i></div>
	                            </td>
	                        </tr>
                    	@else
	                		<tr>
	                            <td>
	                            	@if( $item->userRole == '2' )
	                            		<i class="fa fa-circle text-navy"></i> College : 
	                            	@elseif( $item->userRole == '3' )
	                            		<i class="fa fa-circle text-navy"></i> Student : 
	                            	@elseif( $item->userRole == '1' )
	                            		<i class="fa fa-circle text-navy"></i> Admin : 
	                            	@elseif( $item->userRole == '4' )
	                            		<i class="fa fa-circle text-navy"></i> Employee : 
	                            	@elseif( $item->userRole == '0' )
	                            		<i class="fa fa-circle text-danger"></i> Guest : 
	                            	@endif
	                                
	                            </td>
	                            <td>
	                            	<div class="stat-percent font-bold text-navy" title="Total logged in users : {{ $item->totalCount }}">{{ $item->totalCount }} <i class="fa fa-bolt"></i></div>
	                            </td>
	                        </tr>
                        @endif
                    	@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Total users logged in current month</h5>
                    <table class="table table-stripped small m-t-md">
                        <tbody>
                    	@foreach( $getAllCurrentMonthCounter as $key => $item )
                    	@if( $key == '0' )
                    		<tr>
	                            <td class="no-borders">
	                            	@if( $item->userRole == '2' )
	                            		<i class="fa fa-circle text-navy"></i> College : 
	                            	@elseif( $item->userRole == '3' )
	                            		<i class="fa fa-circle text-navy"></i> Student : 
	                            	@elseif( $item->userRole == '1' )
	                            		<i class="fa fa-circle text-navy"></i> Admin : 
	                            	@elseif( $item->userRole == '4' )
	                            		<i class="fa fa-circle text-navy"></i> Employee : 
	                            	@elseif( $item->userRole == '0' )
	                            		<i class="fa fa-circle text-danger"></i> Guest : 
	                            	@endif
	                                
	                            </td>
	                            <td class="no-borders">
	                                <div class="stat-percent font-bold text-navy" title="Total logged in users : {{ $item->totalCount }}">{{ $item->totalCount }} <i class="fa fa-bolt"></i></div>
	                            </td>
	                        </tr>
                    	@else
	                		<tr>
	                            <td>
	                            	@if( $item->userRole == '2' )
	                            		<i class="fa fa-circle text-navy"></i> College : 
	                            	@elseif( $item->userRole == '3' )
	                            		<i class="fa fa-circle text-navy"></i> Student : 
	                            	@elseif( $item->userRole == '1' )
	                            		<i class="fa fa-circle text-navy"></i> Admin : 
	                            	@elseif( $item->userRole == '4' )
	                            		<i class="fa fa-circle text-navy"></i> Employee : 
	                            	@elseif( $item->userRole == '0' )
	                            		<i class="fa fa-circle text-danger"></i> Guest : 
	                            	@endif
	                                
	                            </td>
	                            <td>
	                            	<div class="stat-percent font-bold text-navy" title="Total logged in users : {{ $item->totalCount }}">{{ $item->totalCount }} <i class="fa fa-bolt"></i></div>
	                            </td>
	                        </tr>
                        @endif
                    	@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Total users logged in last 3 months</h5>
                    <table class="table table-stripped small m-t-md">
                        <tbody>
                    	@foreach( $getAllLastThreeWeekCounter as $key => $item )
                    	@if( $key == '0' )
                    		<tr>
	                            <td class="no-borders">
	                            	@if( $item->userRole == '2' )
	                            		<i class="fa fa-circle text-navy"></i> College : 
	                            	@elseif( $item->userRole == '3' )
	                            		<i class="fa fa-circle text-navy"></i> Student : 
	                            	@elseif( $item->userRole == '1' )
	                            		<i class="fa fa-circle text-navy"></i> Admin : 
	                            	@elseif( $item->userRole == '4' )
	                            		<i class="fa fa-circle text-navy"></i> Employee : 
	                            	@elseif( $item->userRole == '0' )
	                            		<i class="fa fa-circle text-danger"></i> Guest : 
	                            	@endif
	                                
	                            </td>
	                            <td class="no-borders">
	                                <div class="stat-percent font-bold text-navy" title="Total logged in users : {{ $item->totalCount }}">{{ $item->totalCount }} <i class="fa fa-bolt"></i></div>
	                            </td>
	                        </tr>
                    	@else
	                		<tr>
	                            <td>
	                            	@if( $item->userRole == '2' )
	                            		<i class="fa fa-circle text-navy"></i> College : 
	                            	@elseif( $item->userRole == '3' )
	                            		<i class="fa fa-circle text-navy"></i> Student : 
	                            	@elseif( $item->userRole == '1' )
	                            		<i class="fa fa-circle text-navy"></i> Admin : 
	                            	@elseif( $item->userRole == '4' )
	                            		<i class="fa fa-circle text-navy"></i> Employee : 
	                            	@elseif( $item->userRole == '0' )
	                            		<i class="fa fa-circle text-danger"></i> Guest : 
	                            	@endif
	                                
	                            </td>
	                            <td>
	                            	<div class="stat-percent font-bold text-navy" title="Total logged in users : {{ $item->totalCount }}">{{ $item->totalCount }} <i class="fa fa-bolt"></i></div>
	                            </td>
	                        </tr>
                        @endif
                    	@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection