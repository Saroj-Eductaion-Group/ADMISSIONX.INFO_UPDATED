@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('ExamCounsellingForm'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Exam Counselling Form <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/create') }}" class="btn btn-primary pull-right btn-sm">Add New Exam Counselling Form</a></h2>
                @endif
            @else
                <h2>Exam Counselling Form <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/create') }}" class="btn btn-primary pull-right btn-sm">Add New Exam Counselling Form</a></h2>
            @endif
        @endif
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Exam Counselling Form</h2>        
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
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/exam-counselling-form') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">User Name</label>
                            <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}">
                        </div>   
                        <div class="col-md-4">
                            <label class="control-label">User Email</label>
                            <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}">
                        </div> 
                        <div class="col-md-4">
                            <label class="control-label">User Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ Request::get('phone') }}">
                        </div>   
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Course Name</label>
                            <select class="form-control chosen-select course" name="course_id" data-parsley-trigger="change" data-parsley-error-message="Please select course">
                                <option value="" disabled="" selected="">Select course</option>
                                @foreach( $cousesListObj as $item )
                                    <option value="{{ $item->id }}" @if( Request::get('course_id') == $item->id) selected="" @endif>{{ $item->name }} - {{ $item->degreeName }} {{ $item->functionalareaName }}</option>
                                @endforeach
                            </select> 
                        </div> 
                        <div class="col-md-4">
                            <label class="control-label">City</label>
                            <select class="form-control chosen-select" name="city_id" data-parsley-trigger="change" data-parsley-error-message="Please select city">
                                <option value="" disabled="" selected="">Select city</option>
                                @foreach( $cityListObj as $item )
                                    <option value="{{ $item->id }}" @if( Request::get('city_id') == $item->id) selected="" @endif>{{ $item->name }} - {{ $item->stateName }}</option>
                                @endforeach
                            </select> 
                        </div>      
                        <div class="col-md-4">
                            <label class="control-label">Exam section</label>
                            <select class="form-control chosen-select examsection" name="examsection" data-parsley-trigger="change" data-parsley-error-message="Please select exam section">
                                <option value="" disabled="" selected="">Select exam section</option>
                                @foreach( $examsectionsObj as $obj )
                                    <option value="{{ $obj->id }}"  @if(Request::get('examsection') == $obj->id) checked="" @endif>{{ $obj->name }}</option>
                                @endforeach
                            </select>
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
                                    <a href="{{ URL::to($fetchDataServiceController->routeCall().'/exam-counselling-form') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th>Exam Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>City</th>
                            <th>Submit Date</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($examcounsellingform as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{$item->sortname}}  {{ $item->examinationName or '' }} ({{ $item->exam_sectionsName}})
                                <a href="{{ url('/examination-details/'.$item->examinationSlug.'/'.$item->slug) }}" target="_blank" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> Examination Public View</a>
                                <a href="{{ url('/examination/type-of-examination/' . $item->exam_id) }}" class="btn-block btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> Examination Details</a>
                            </td>
                            <td>
                                {{ $item->name or 'Not updated yet'}}
                            </td>
                            <td>
                                {{ $item->email or 'Not updated yet'}}
                            </td>
                            <td>
                                {{ $item->phone or 'Not updated yet'}}
                            </td>
                            <td>
                                @if( $item->city_id )
                                   {{$item->cityname}}, {{$item->stateName}}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                            <td>
                                @if( $item->course_id )
                                   {{$item->courseName}} ({{$item->degreeName}}, {{$item->functionalareaName}})
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
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        / <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                        / 
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => [$fetchDataServiceController->routeCall().'/exam-counselling-form', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete Exam Counselling Form',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            ))!!}
                                        {!! Form::close() !!}
                                        @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/exam-counselling-form/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>/
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/exam-counselling-form', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete Exam Counselling Form',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        ))!!}
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
        <div class="pagination"> {!! $examcounsellingform->render() !!} </div>
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


