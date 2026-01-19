@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Query Details <!-- <a href="{{ url('administrator/query-bya') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
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
                        {{--*/ $queryChatKey = $item->chatkey /*--}}
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
                                @if( $item->queryflowtype != "guest-to-admin" )
                                    <div class="row">
                                        @if( $item->queryflowtype == "college-to-admin" || $item->queryflowtype == "student-to-admin" )
                                        <div class="col-md-12 text-left">
                                            @if( $item->queryflowtype == "college-to-admin" )
                                                <p><a href="javascript:void(0);"><i class="fa fa-user"></i> {{ $item->U2FirstName }}</a> : {{ $item->message }}</p>
                                            @elseif( $item->queryflowtype == "student-to-admin" )
                                                <p><a href="javascript:void(0);"><i class="fa fa-user"></i> {{ $item->U3FirstName }} {{ $item->U3LastName }}</a> : {{ $item->message }}</p>
                                            @endif
                                        </div>
                                        <div>
                                            <h4>Last Updated By:- 
                                                @if($item->eUserId)
                                                <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) Date & Time:-  {{ $item->updated_at}}</a>
                                                @else
                                                    <span class="label label-warning">Not Updated Yet</span>
                                                @endif
                                            </h4>
                                        </div>
                                        @else
                                        <div class="col-md-12 text-right">
                                            <p><a href="javascript:void(0);"><i class="fa fa-user"></i> {{ $item->U1FirstName }} {{ $item->U1LastName }}</a> : {{ $item->message }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <hr class="hr-line-dashed">
                                @else
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Guest Name : {{ $item->guestname }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Guest Email : <a href="mailto:{{ $item->guestemail }}">{{ $item->guestemail }}</a></label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Guest Phone : @if( $item->guestphone) {{ $item->guestphone }} @else -- @endif</label>
                                        </div>
                                    </div>
                                    <hr class="hr-line-dashed">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Subject : {{ $item->subject }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Guest Message</label>
                                            <p>{{ $item->message }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <h4>Last Updated By:- 
                                            @if($item->eUserId)
                                            <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) Date & Time:-  {{ $item->updated_at}}</a>
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif
                                        </h4>
                                    </div>
                                @endif
                            @endforeach    
                        </div>                        
                    </div>
                    @if($guestToAdmin != "guest-to-admin")
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ URL::to('administrator/query-reply-bya') }}" method="POST" data-parsley-validate>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="person" value="{{ $person }}">
                                        <input type="hidden" name="queryChatKey" value="{{ $queryChatKey }}">
                                        <textarea class="form-control" name="message" required="" placeholder="Enter reply message here" data-parsley-error-message="Please enter message here"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top10">
                                    <div class="col-md-offset-10 col-md-2">
                                        <button class="form-control btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection