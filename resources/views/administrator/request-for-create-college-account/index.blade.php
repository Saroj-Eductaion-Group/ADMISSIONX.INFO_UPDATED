@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection
@section('styles')
{!! Html::style('/assets/administrator/css/plugins/sweetalert/sweetalert.css') !!}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-12">
        <h2>Manage Request to make college profile form details</h2>    
    </div>    
</div>
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('RequestForCreateCollegeAccount'); /*--}}
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search request to make college profile form details</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/request/create-college-account') }}" method="GET">
                    <div class="row margin-top20">
                        <div class="col-md-3">
                            <h4 for="usr">College name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control collegeName" name="collegeName" placeholder="Enter college name here" data-parsley-error-message="Please enter college name" data-parsley-trigger="change" value="{{Request::get('collegeName') }}">
                        </div>
                        <div class="col-md-3">
                            <h4 for="usr">Email<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control email" name="email" placeholder="Enter email address here" data-parsley-error-message="Please enter email address" data-parsley-trigger="change" value="{{Request::get('email') }}">
                        </div>
                        <div class="col-md-3">
                            <h4 for="usr">University Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control phone" name="phone" placeholder="Enter phone number here" data-parsley-error-message="Please enter phone number" data-parsley-trigger="change" value="{{Request::get('phone') }}">
                        </div>
                        <div class="col-md-3">
                            <h4 for="usr">University Name<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control contactPersonName" name="contactPersonName" placeholder="Enter contact person name here" data-parsley-error-message="Please enter contact person name" data-parsley-trigger="change" value="{{Request::get('contactPersonName') }}">
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
                                <div class="col-md-3">
                                    <div class="margin-bottom-20">
                                        <h4>Status <span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" class="status" id="status1" value="0" name="status" @if(Request::get('status') == '0') checked="" @endif>
                                            <label for="status1"> Pending </label>
                                        </div>
                                    
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" class="status" id="status0" value="1" name="status" @if(Request::get('status') == '1') checked="" @endif>
                                            <label for="status0"> Approved </label>
                                        </div>
                                    </div>
                                </div>          
                                <div class="col-md-3 pull-right text-right margin-top20">
                                    <a href="{{ URL::to($fetchDataServiceController->routeCall().'/request/create-college-account') }}" class="btn btn-md btn-primary">Clear</a>
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


<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
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
                @if( sizeof($requestforcreatecollegeaccount) > 0 )
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>College Name </th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Contact Person Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Last Updated By</th>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                    <th style="width: 10px">Actions</th>
                                    @endif
                                @else
                                    <th style="width: 10px">Actions</th>
                                @endif
                            @endif          
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        @foreach( $requestforcreatecollegeaccount as $key => $item )
                        <tr>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/request/create-college-account', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/request/create-college-account', $item->id) }}">{{ $item->collegeName }}</a></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->contactPersonName }}</td>
                            <td>
                                @if( $item->status == '1' )
                                    <span class="label label-success">Approved</span>
                                @else
                                    <span class="label label-danger">Pending</span>
                                @endif
                            </td>
                            <td>{{ date('d F Y h:i a', strtotime($item->created_at)) }}</td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else 
                                href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>             
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                    <td>
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                                            @if($item->status == 0)
                                            <a href="javascript:void(0);" class="collegeProfileCreated" id="{{$item->id}}">
                                                <button type="submit" class="btn btn-primary btn-xs">Create Profile <i class="fa fa-plus tooltips" data-toggle="tooltip" data-placement="right" title="On clicking the create profile button, his account will be created, if there is any problem then you will get the message here"></i></button>
                                            </a> /
                                            @endif
                                        @endif
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/request/create-college-account/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">View</button>
                                        </a>
                                        @if($item->status == 0)
                                         /
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/request/create-college-account/' . $item->id) }}" class="tooltips" data-toggle="tooltip" data-placement="right" title="You can send an email if the email already exists or if you have any other problems, Otherwise no need">
                                            <button type="submit" class="btn btn-warning btn-xs">Send Notification <i class="fa fa-question"></i></button>
                                        </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                            @if($item->status == 0)
                                             /
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => [$fetchDataServiceController->routeCall().'/request/create-college-account', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif
                                    </td>   
                                    @endif
                                @else
                                    <td>
                                        @if($item->status == 0)
                                        <a href="javascript:void(0);" class="collegeProfileCreated" id="{{$item->id}}">
                                            <button type="submit" class="btn btn-primary btn-xs">Create Profile <i class="fa fa-plus tooltips" data-toggle="tooltip" data-placement="right" title="On clicking the create profile button, his account will be created, if there is any problem then you will get the message here"></i></button>
                                        </a> /
                                        @endif
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/request/create-college-account/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">View</button>
                                        </a>
                                        @if($item->status == 0)
                                         /
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/request/create-college-account/' . $item->id) }}" class="tooltips" data-toggle="tooltip" data-placement="right" title="You can send an email if the email already exists or if you have any other problems, Otherwise no need">
                                            <button type="submit" class="btn btn-warning btn-xs">Send Notification <i class="fa fa-question"></i></button>
                                        </a>
                                        @endif
                                        @if($item->status == 0)
                                         /
                                        {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => [$fetchDataServiceController->routeCall().'/request/create-college-account', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>   
                                @endif
                            @endif
                        </tr>
                        @endforeach                   
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>College Name </th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Contact Person Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Last Updated By</th>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                    <th style="width: 10px">Actions</th>
                                    @endif
                                @else
                                    <th style="width: 10px">Actions</th>
                                @endif
                            @endif          
                        </tr>
                        </tfoot> 
                    </table>
                </div>
                <div class="pagination-wrapper text-right"> {!! $requestforcreatecollegeaccount->appends(\Input::except('page'))->render() !!}</div>
                @else
                    <div class="headline text-center"><h3>No match found, please try with different search criteria</h3></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Html::script('/assets/administrator/js/plugins/sweetalert/sweetalert.min.js') !!}
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
    $('.collegeName').on('blur',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.collegeName').val('');
        $('#refresh1').addClass('hide');
    });

    $('.email').on('blur',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('.email').val('');
        $('#refresh2').addClass('hide');
    });

    $('.phone').on('blur',function(){
        $('#refresh3').removeClass('hide');
    });
    $('#refresh3').on('click',function(e){
        $('.phone').val('');
        $('#refresh3').addClass('hide');
    });

    $('.contactPersonName').on('blur',function(){
        $('#refresh4').removeClass('hide');
    });
    $('#refresh4').on('click',function(e){
        $('.contactPersonName').val('');
        $('#refresh4').addClass('hide');
    });

    $('.status').on('blur',function(){
        $('#refresh5').removeClass('hide');
    });
    $('#refresh5').on('click',function(e){
        $('.status').val('');
        $('#refresh5').addClass('hide');
    });
</script>

<script type="text/javascript">
    $(document).on('click', '.collegeProfileCreated', function(){
        var id = $(this).attr('id');
        var onpage = $('#field_id1').val();
        swal({   title: "Are you sure you want to create this college profile?",   
            text: "Are you sure to proceed? As you click on the create button, college profile has been created.",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#d43f3a",   
            confirmButtonText: "Create College Profile",   
            cancelButtonText: "No",   
            closeOnConfirm: false,   
            closeOnCancel: false }, 
            function(isConfirm){
                if (isConfirm) 
                {   
                    var section = onpage;
                    var url ='';
                    url += '/administrator/accept-request/college-account/created';
                    dataType: "json",
                    $.ajax({
                        type: "POST",  
                        url: url,
                        data: { section: section, id: id },
                        success: function(data){
                            if(data.code == 200){
                                toastr.success(data.response);
                                window.location.reload();
                            }else if(data.code == 400){
                                toastr.warning(data.response);
                            }else {
                                toastr.error(data.response);
                            }
                            swal("College Profile", data.response, "success");   
                        }
                    });
                } 
                else{     
                    swal("Hurray", "Creation not done!", "error");   
                }   
            }
        );
    });
</script>
@endsection