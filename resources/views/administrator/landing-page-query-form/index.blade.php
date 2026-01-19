@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Landing Page Query Form</h2>
    </div>
</div>
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('LandingPageQueryForm'); /*--}}
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Landing Page Query Form</h2>        
                    </div>    
                </div>
                @if(Session::has('flash_message'))
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ Session::get('flash_message') }}</strong>
                            </div>
                        </div>
                    </div>
                @endif
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/landing-page-query-form') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="{{ Request::get('fullname') }}">
                        </div>   
                        <div class="col-md-4">
                            <label class="control-label">Email Address</label>
                            <input type="text" name="mobilenumber" class="form-control" value="{{ Request::get('mobilenumber') }}">
                        </div> 
                        <div class="col-md-4">
                            <label class="control-label">Phone Number</label>
                            <input type="text" name="emailaddress" class="form-control" value="{{ Request::get('emailaddress') }}">
                        </div>   
                    </div>
                    <hr>
                    <div class="row">
                        <div class="" id="data_5">
                            <div class="input-daterange" id="datepicker">
                                <div class="col-md-3">
                                    <label>Start Date</label>
                                    <input type="text" id="txtFromCreateDate" class="form-control startRange" style="text-align: left;" name="startdate" placeholder="Enter start date" data-parsley-trigger="change" data-parsley-error-message="Please enter start date" readonly="" value="{{ Request::get('startdate') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>End Date</label>
                                    <input type="text" id="txtToCreateDate" class="form-control endRange" style="text-align: left;" name="enddate" placeholder="Enter end date" data-parsley-trigger="change" data-parsley-error-message="Please enter end date" readonly="" value="{{ Request::get('enddate') }}">   
                                </div> 
                                <div class="col-md-4">
                                    <label class="control-label">Search</label>
                                    <input type="text" class="form-control" name="search" placeholder="Enter title or description" data-parsley-trigger="change" data-parsley-error-message="Please enter title or description" value="{{ Request::get('search') }}">
                                </div> 
                                <div class="col-md-2 pull-right text-right margin-top20">
                                    <a href="{{ URL::to($fetchDataServiceController->routeCall().'/landing-page-query-form') }}" class="btn btn-md btn-primary">Clear</a>
                                    <button class="btn btn-danger btn-md">Submit</button>                            
                                </div>   
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Email </th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Submit Date</th>
                            <th>Last Updated By</th>
                             @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                    <th>Actions</th>
                                    @endif
                                @else
                                    <th>Actions</th>
                                @endif
                            @endif
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($landingpagequeryform as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                {{ $item->fullname or 'Not updated yet'}}
                            </td>
                            <td>
                                {{ $item->mobilenumber or 'Not updated yet'}}
                            </td>
                            <td>
                                {{ $item->emailaddress or 'Not updated yet'}}
                            </td>
                            <td>
                                @if( $item->subject )
                                   {{$item->subject}}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                            <td>
                                @if( $item->message )
                                   {{$item->message}}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                            <td>
                                {!! date('F d, Y', strtotime($item->created_at)) !!}
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    <td>
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/landing-page-query-form/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => [$fetchDataServiceController->routeCall().'/landing-page-query-form', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete LandingPageQueryForm" />', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete LandingPageQueryForm',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/landing-page-query-form/' . $item->id) }}" class="btn btn-success btn-xs" title="View LandingPageQueryForm"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/landing-page-query-form', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete LandingPageQueryForm" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete LandingPageQueryForm',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                </td>
                                @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $landingpagequeryform->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
    $("#txtFromCreateDate").datepicker({
        numberOfMonths: 1,
        changeMonth: true,
        changeYear: true,
        yearRange:  '1940:2050',
        endDate : 'today',
        onSelect: function(selected) {
          $("#txtToCreateDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToCreateDate").datepicker({ 
        numberOfMonths: 1,
        changeMonth: true,
        changeYear: true,
        yearRange:  '1940:2050',
        endDate : 'today',
        onSelect: function(selected) {
           $("#txtFromCreateDate").datepicker("option","maxDate", selected)
        }
    });

</script>
<script type="text/javascript">
    var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 200) return;
        
        $(this).html(
            t.slice(0,200)+'<span></span><a href="#" class="more">... <span class="badge badge-danger">Read More</span></a>'+
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(200,t.length)+'<br> <a href="#" class="less">... <span class="badge badge-danger">Read Less</span></a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
</script>
@endsection


