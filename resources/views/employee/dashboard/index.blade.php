@extends('employee/admin-layouts.master')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Welcome to AdmissionX</h2>
    </div>
</div>
<div class="ibox-content margin-top20">
    @if(Session::has('access_restricted_msg'))
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="alert alert-danger alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('access_restricted_msg') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <label>Search Statistics</label>
            <div class="row margin-top20">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <form action="{{ URL::to('/employee/dashboard') }}" method="GET" data-parsley-validate="">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>From Date</label>
                                    <input type="text" id="txtFromCreateDate" class="form-control createdDateStart" name="startdate" value="{{ Request::get('startdate') }}" placeholder="Form Date" data-parsley-trigger="change" data-parsley-error-message="Please select From date" required readonly="" data-parsley-errors-container="#startdate-validation-error-block">
                                    <div class="mb-2" id="startdate-validation-error-block"></div>
                                </div>
                                <div class="col-md-4">
                                    <label>To Date</label>
                                    <input type="text" id="txtToCreateDate" class="form-control createdDateEnd" name="enddate" value="{{ Request::get('enddate') }}" placeholder="To Date" data-parsley-trigger="change" data-parsley-error-message="Please select To date " required readonly="" data-parsley-errors-container="#enddate-validation-error-block">
                                    <div class="mb-2" id="enddate-validation-error-block"></div>
                                </div>
                                <div class="col-md-4 text-right margin-top20">
                                    <a href="{{ URL::to('/employee/dashboard') }}" class="btn btn-md btn-danger">Clear</a>
                                    <button class="btn btn-primary btn-md" id="weekdaywiseHub" >Submit</button>   
                                </div>
                            </div>                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-content table-responsive">
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins transaction-graph animated slideInRight margin-top20">
            <div class="ibox-content">
                <h2>Updated transaction data</h2>
                <hr class="hr-line-dashed"></hr>
                <div id="morris-one-line-chart"></div>
            </div>
        </div>        
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20 animated slideInLeft">
    <div class="col-md-4 col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>New Colleges Registered</h5>                            
            </div>
            <div class="ibox-content">
                {{--*/ $totalCol = '0'; /*--}}
                {{--*/ $totalColActve = '0'; /*--}}
                {{--*/ $totalColInactive = '0'; /*--}}
                {{--*/ $totalColDisabled = '0'; /*--}}
                @foreach( $totalUsersRegistered as $totalUsers )
                    @if( $totalUsers->userrole_id == 2 )
                        {{--*/ $totalCol += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == 1 && $totalUsers->userrole_id == 2 )
                        {{--*/ $totalColActve += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == 2 && $totalUsers->userrole_id == 2 )
                        {{--*/ $totalColInactive += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == 3 && $totalUsers->userrole_id == 2 )
                        {{--*/ $totalColDisabled += 1; /*--}}
                    @endif
                @endforeach
                <h1>{{ $totalCol }}</h1>
                <h5>Total Active College : <span class="label label-info">{{ $totalColActve }}</span></h5>
                <h5>Total Inactive College : <span class="label label-warning">{{ $totalColInactive }}</span></h5>
                <h5>Total Disable College : <span class="label label-danger">{{ $totalColDisabled }}</span></h5>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>New Student Registered</h5>                            
            </div>
            <div class="ibox-content">
                {{--*/ $totalStu = '0'; /*--}}
                {{--*/ $totalStuActve = '0'; /*--}}
                {{--*/ $totalStuInactive = '0'; /*--}}
                {{--*/ $totalStuDisabled = '0'; /*--}}
                @foreach( $totalUsersRegistered as $totalUsers )
                    @if( $totalUsers->userrole_id == '3' )
                        {{--*/ $totalStu += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == '1' && $totalUsers->userrole_id == '3' )
                        {{--*/ $totalStuActve += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == '2' && $totalUsers->userrole_id == '3' )
                        {{--*/ $totalStuInactive += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == '3' && $totalUsers->userrole_id == '3' )
                        {{--*/ $totalStuDisabled += 1; /*--}}
                    @endif
                @endforeach
                <h1>{{ $totalStu }}</h1>
                <h5>Total Active Student : <span class="label label-info">{{ $totalStuActve }}</span></h5>
                <h5>Total Inactive Student : <span class="label label-warning">{{ $totalStuInactive }}</span></h5>
                <h5>Total Disable Student : <span class="label label-danger">{{ $totalStuDisabled }}</span></h5>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>New Admin &amp; Agent Registered</h5>                            
            </div>
            <div class="ibox-content">
                {{--*/ $totalAgent = '0'; /*--}}
                {{--*/ $totalAgentActve = '0'; /*--}}
                {{--*/ $totalAgentInactive = '0'; /*--}}
                {{--*/ $totalAgentDisabled = '0'; /*--}}
                @foreach( $totalUsersRegistered as $totalUsers )
                    @if( $totalUsers->userrole_id == '4' )
                        {{--*/ $totalAgent += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == '1' && $totalUsers->userrole_id == '4' )
                        {{--*/ $totalAgentActve += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == '2' && $totalUsers->userrole_id == '4' )
                        {{--*/ $totalAgentInactive += 1; /*--}}
                    @endif
                    @if( $totalUsers->userstatus_id == '3' && $totalUsers->userrole_id == '4' )
                        {{--*/ $totalAgentDisabled += 1; /*--}}
                    @endif
                @endforeach
                <h1>{{ $totalAgent }}</h1>
                <h5>Total Active Agent : <span class="label label-info">{{ $totalAgentActve }}</span></h5>
                <h5>Total Inactive Agent : <span class="label label-warning">{{ $totalAgentInactive }}</span></h5>
                <h5>Total Disable Agent : <span class="label label-danger">{{ $totalAgentDisabled }}</span></h5>
            </div>
        </div>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20 animated slideInRight">
    <div class="col-md-4 col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Query For Admission X</h5>                            
            </div>
            <div class="ibox-content">
                {{--*/ $totalQueryCount = '0'; /*--}}
                {{--*/ $totalQueryCollege = '0'; /*--}}
                {{--*/ $totalQueryStudent = '0'; /*--}}
                {{--*/ $totalQueryGuest = '0'; /*--}}
                @foreach( $totalQuery as $queryResult )
                    @if( $queryResult->userstatus_id == '1'  && $queryResult->userrole_id == '1' )
                        {{--*/ $totalQueryCount += 1; /*--}}
                    @endif
                    @if( $queryResult->queryflowtype == 'college-to-admin')
                        {{--*/ $totalQueryCollege += 1; /*--}}
                    @endif
                    @if( $queryResult->queryflowtype == 'student-to-admin')
                        {{--*/ $totalQueryStudent += 1; /*--}}
                    @endif
                    @if( $queryResult->queryflowtype == 'guest-to-admin')
                        {{--*/ $totalQueryGuest += 1; /*--}}
                    @endif
                @endforeach
                <h1>{{ $totalQueryCount }}</h1>
                <h5>College To Admission X: <span class="label label-info">{{ $totalQueryCollege }}</span></h5>
                <h5>Student To Admission X : <span class="label label-info">{{ $totalQueryStudent }}</span></h5>
                <h5>Guest To Admission X : <span class="label label-info">{{ $totalQueryGuest }}</span></h5>
            </div>
        </div>
    </div> 
    <div class="col-md-4 col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Pending Query Status </h5>                            
            </div>
            <div class="ibox-content">
                {{--*/ $totalQueryCount = '0'; /*--}}
                {{--*/ $totalQueryCollege = '0'; /*--}}
                {{--*/ $totalQueryStudentToCollege = '0'; /*--}}
                {{--*/ $totalQueryStudentToAdmin = '0'; /*--}}
                {{--*/ $totalQueryGuest = '0'; /*--}}
                @foreach( $totalQuery as $queryResult )
                    @if( $queryResult->userstatus_id == '1'  && $queryResult->userrole_id == '1' )
                        {{--*/ $totalQueryCount += 1; /*--}}
                    @endif
                    @if( $queryResult->queryflowtype == 'college-to-admin' && $queryResult->querytypeinfo == 'pending')
                        {{--*/ $totalQueryCollege += 1; /*--}}
                    @endif
                    @if( $queryResult->queryflowtype == 'student-to-admin' && $queryResult->querytypeinfo == 'pending')
                        {{--*/ $totalQueryStudentToAdmin += 1; /*--}}
                    @endif
                    @if( $queryResult->queryflowtype == 'student-to-college' && $queryResult->querytypeinfo == 'pending')
                        {{--*/ $totalQueryStudentToCollege += 1; /*--}}
                    @endif
                    @if( $queryResult->queryflowtype == 'guest-to-admin' && $queryResult->querytypeinfo == 'pending')
                        {{--*/ $totalQueryGuest += 1; /*--}}
                    @endif
                @endforeach
                <h1>{{ $totalQueryCount }}</h1>
                <h5>Pending Query For Guest To Admin : <span class="label label-warning">{{ $totalQueryGuest }}</span></h5>
                <h5>Pending Query For College To Admin : <span class="label label-warning">{{ $totalQueryCollege }}</span></h5>
                <h5>Pending Query For Student To Admin : <span class="label label-warning">{{ $totalQueryStudentToAdmin }}</span></h5>
                <h5>Pending Query For Student To College : <span class="label label-warning">{{ $totalQueryStudentToCollege }}</span></h5>
            </div>
        </div>
    </div>   
    <div class="col-md-4 col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Application Status</h5>                            
            </div>
            <div class="ibox-content">
                {{--*/ $totalApplicationCount = '0'; /*--}}
                {{--*/ $totalApprovedApplication = '0'; /*--}}
                {{--*/ $totalPendingApplication = '0'; /*--}}
                {{--*/ $totalRejectedApplication = '0'; /*--}}
                {{--*/ $totalCancelledApplication = '0'; /*--}}
                @foreach( $totalApplication as $applicationResult )
                    
                        {{--*/ $totalApplicationCount += 1; /*--}}
                   
                    @if( $applicationResult->applicationstatusId == '1')
                        {{--*/ $totalApprovedApplication += 1; /*--}}
                    @endif
                    @if( $applicationResult->applicationstatusId == '2')
                        {{--*/ $totalPendingApplication += 1; /*--}}
                    @endif
                    @if( $applicationResult->applicationstatusId == '3')
                        {{--*/ $totalRejectedApplication += 1; /*--}}
                    @endif
                    @if( $applicationResult->applicationstatusId == '4')
                        {{--*/ $totalCancelledApplication += 1; /*--}}
                    @endif
                @endforeach
                <h1>{{ $totalApplicationCount }}</h1>
                <h5>Total Approved Application: <span class="label label-info">{{ $totalApprovedApplication }}</span></h5>
                <h5>Total Pending Application : <span class="label label-warning">{{ $totalPendingApplication }}</span></h5>
                <h5>Total Rejected Application: <span class="label label-danger">{{ $totalRejectedApplication }}</span></h5>
                <h5>Total Cancelled Application: <span class="label label-danger">{{ $totalCancelledApplication }}</span></h5>
            </div>
        </div>
    </div> 
</div>
@endsection

@section('script')
{!! Html::script('assets/js/morris/morris.js') !!}
{!! Html::script('assets/js/morris/raphael-2.1.0.min.js') !!}
<script type="text/javascript">
    $(function() {
        var transactionAnalytics = {!! $transactionAnalytics !!};
        if( transactionAnalytics != '0' ){
            Morris.Line({
                element: 'morris-one-line-chart',
                data: transactionAnalytics,
                xkey: 'transactionDate',
                ykeys: ['transactionAnalytics'],
                labels: ['Total Application'],
                parseTime: false,
                resize: true,
                lineWidth:5,
                pointSize:5,
                lineColors: ['#1ab394'],
            });    
        }
  });
</script>
<script type="text/javascript">
    $("#txtFromCreateDate").datepicker({
        numberOfMonths: 2,
        format: "yyyy/mm/dd",
        onSelect: function(selected) {
          $("#txtToCreateDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToCreateDate").datepicker({ 
        numberOfMonths: 2,
        format: "yyyy/mm/dd",
        onSelect: function(selected) {
           $("#txtFromCreateDate").datepicker("option","maxDate", selected)
        }
    });
</script>
@endsection
