@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer'); /*--}}
{{--*/ $validateUserRoleAskQuestion = $fetchDataServiceController->validateUserRoleCall('AskQuestion'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Ask Answer details
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleAskQuestion)) && (sizeof($validateUserRoleAskQuestion) > 0) && ($validateUserRoleAskQuestion[0]->create == '1'))
                <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/create') }}" class="btn btn-primary pull-right btn-sm">Add New Ask Question</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/create') }}" class="btn btn-primary pull-right btn-sm">Add New Ask Question</a>
            @endif
        @endif
        </h2>
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Ask Answers</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/all-ask-answers') }}" method="GET">
                    <div class="row">
                        <div class="" id="data_5">
                            <div class="input-daterange" id="datepicker">
                                <div class="col-md-4">
                                    <label>Start Date</label>
                                    <input type="text" id="txtFromCreateDate" class="form-control startRange" style="text-align: left;" name="startdate" placeholder="Enter start date" data-parsley-trigger="change" data-parsley-error-message="Please enter start date" readonly="" value="{{ Request::get('startdate') }}">
                                </div>
                                <div class="col-md-4">
                                    <label>End Date</label>
                                    <input type="text" id="txtToCreateDate" class="form-control endRange" style="text-align: left;" name="enddate" placeholder="Enter end date" data-parsley-trigger="change" data-parsley-error-message="Please enter end date" readonly="" value="{{ Request::get('enddate') }}">   
                                </div> 
                                <div class="col-md-4">
                                    <label class="control-label">User Name</label>
                                    <select class="form-control chosen-select"  name="userId" data-parsley-error-message="Please select User">
                                        <option disabled="" selected="">Please select</option>
                                        @foreach( $usersObj as $item )
                                            @if( Request::get('userId') == $item->UserID )
                                                <option value="{{ $item->UserID }}" selected="">{{ $item->firstName }} {{ $item->lastName}}</option>
                                            @else
                                                <option value="{{ $item->UserID }}">{{ $item->firstName }} {{ $item->lastName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>                        
                            </div>
                        </div> 
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Question</label>
                            <input type="text" class="form-control" name="question" placeholder="Enter question" data-parsley-trigger="change" data-parsley-error-message="Please enter question" value="{{ Request::get('question') }}">
                        </div>  
                        <div class="col-md-4">
                            <label class="control-label">Answer</label>
                            <input type="text" class="form-control" name="answer" placeholder="Enter answer" data-parsley-trigger="change" data-parsley-error-message="Please enter answer" value="{{ Request::get('answer') }}">
                        </div>  
                        
                        <div class="col-md-2">
                            <label class="control-label">Status</label>
                            <br>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="FormCreate0" value="1" name="status" data-parsley-error-message="Please select status" data-parsley-trigger="change" @if(Request::get('status') == '1') checked="" @endif>
                                <label for="FormCreate0"> Active </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="FormCreate1" value="0" name="status" data-parsley-error-message="Please select status" data-parsley-trigger="change" @if(Request::get('status') == '0') checked="" @endif>
                                 <label for="FormCreate1">Inactive</label>
                            </div>
                        </div>                      
                        <div class="col-md-2 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/all-ask-answers') }}" class="btn btn-md btn-primary">Clear</a>
                            <button class="btn btn-danger btn-md">Submit</button>                            
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Answer Date</th>
                            <th>Status</th>
                            <th>Total Comment Count</th>
                            <th>Answer Added By</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($askAnswer as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><span class="minimize"><p class="no-word-wrap">{!! strip_tags($item->question) !!}</p></span></td>
                            <td><span class="minimize1"><p class="no-word-wrap">{!! strip_tags($item->answer) !!}</p></span></td>
                            <td>{!! date('F d, Y', strtotime($item->answerDate)) !!}</td>
                            
                            <td>
                                <div class="checkbox checkbox-primary">
                                    <input class="isApprovedAnswer" type="checkbox" id="{{ $item->id }}" name="isApprovedAnswer" @if( $item->status == 1) checked="" @endif>
                                    <label>
                                        @if($item->status == 1)
                                            <span class="label label-success isApprovedAnswerEnabled{{ $item->id }}">Approved</span>
                                        @else
                                            <span class="label label-danger isApprovedAnswerDisabled{{ $item->id }}">Disapproved</span>
                                        @endif
                                        <span class="label label-success hide isApprovedAnswerEnabled1{{ $item->id }}">Approved</span>
                                        <span class="label label-danger hide isApprovedAnswerDisabled1{{ $item->id }}">Disapproved</span>
                                    </label>
                                </div>
                            </td>
                            <td><span class="badge badge-info">{{$item->totalCommentsCount}}</span></td>
                            <td>
                                @if($item->userID)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->userID) }}" @endif>{{ $item->firstname }} {{ $item->lastname}} (ID:- {{ $item->userID}}) <hr> Date & Time:-  {{ $item->answerDate}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if((isset($validateUserRoleAskQuestion)) && (sizeof($validateUserRoleAskQuestion) > 0) && ($validateUserRoleAskQuestion[0]->show == '1'))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $item->questionId) }}">
                                                <button type="submit" class="btn btn-warning btn-xs">View Question Details</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-answers/show/' . $item->id) }}">
                                                <button type="submit" class="btn btn-info btn-xs">View Answer</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/ask-answers/edit/' . $item->id) }}">
                                                <button type="submit" class="btn btn-primary btn-xs">Edit Answer</button>
                                            </a> 
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                            <a href="/delete-ask/question-answer/{{$item->questionId}}/{{$item->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Answer</button></a> 
                                        @endif
                                    @else
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $item->questionId) }}">
                                            <button type="submit" class="btn btn-warning btn-xs">View Question Details</button>
                                        </a>
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-answers/show/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">View Answer</button>
                                        </a>
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-answers/edit/' . $item->id) }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit Answer</button>
                                        </a> 
                                        <a href="/delete-ask/question-answer/{{$item->questionId}}/{{$item->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Answer</button></a> 
                                    @endif
                                @endif
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $askAnswer->render() !!} </div>
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
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span></span><a href="#" class="more">... <span class="badge badge-danger">Read More</span></a>'+
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(100,t.length)+'<br> <a href="#" class="less">... <span class="badge badge-danger">Read Less</span></a></span>'
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
<script type="text/javascript">
    var minimized_elements = $('span.minimize1');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span></span><a href="#" class="more">... <span class="badge badge-danger">Read More</span></a>'+
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(100,t.length)+'<br> <a href="#" class="less">... <span class="badge badge-danger">Read Less</span></a></span>'
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.isApprovedAnswer').on('click', function(){
            var id              = $(this).attr('id');
            var currentStatus   = 0;
            if($(this).prop("checked") == true){
                currentStatus   = 1;
            }

            if (currentStatus == 1) {
                $('.isApprovedAnswerEnabled'+id).addClass('hide');
                $('.isApprovedAnswerDisabled'+id).addClass('hide');
                $('.isApprovedAnswerEnabled1'+id).removeClass('hide');
                $('.isApprovedAnswerDisabled1'+id).addClass('hide');
            }else if(currentStatus == 0){
                $('.isApprovedAnswerEnabled'+id).addClass('hide');
                $('.isApprovedAnswerDisabled'+id).addClass('hide');
                $('.isApprovedAnswerDisabled1'+id).removeClass('hide');
                $('.isApprovedAnswerEnabled1'+id).addClass('hide');
            }

            $.ajax({
                type: "POST",
                url: "{{ URL::to('administrator/annwer/status') }}",
                data: {id: id,currentStatus:currentStatus},
                success: function(data){
                    if(data.code == 200){
                        toastr.success("Answer status updated successfully.");
                    }
                }
            });
        });
    });
</script>
@endsection


