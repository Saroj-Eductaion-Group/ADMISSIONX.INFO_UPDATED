@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('ExamQuestion'); /*--}}
{{--*/ $validateUserRoleTypeOfExamination = $fetchDataServiceController->validateUserRoleCall('TypeOfExamination'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>List of Examination Question details
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleTypeOfExamination)) && (sizeof($validateUserRoleTypeOfExamination) > 0) && ($validateUserRoleTypeOfExamination[0]->create == '1'))
                    <a href="{{ url('examination/type-of-examination/create') }}" class="btn btn-primary pull-right btn-sm">Add New List of Examination</a>
                @endif
            @else
                <a href="{{ url('examination/type-of-examination/create') }}" class="btn btn-primary pull-right btn-sm">Add New List of Examination</a>
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
                        <h2>Search List of Examination Question</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to('/examination/all-exam-question') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Examination Name</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter name" data-parsley-trigger="change" data-parsley-error-message="Please enter name" value="{{ Request::get('search') }}">
                        </div>   
                        <div class="col-md-4">
                            <h4 for="usr">Exam section
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="@if(!empty(Request::get('examsection'))) @else hide @endif"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select examsection" name="examsection" data-parsley-trigger="change" data-parsley-error-message="Please select exam section">
                                <option value="" disabled="" selected="">Select exam section</option>
                                @foreach( $examsectionsObj as $obj )
                                    <option value="{{ $obj->id }}"  @if(Request::get('examsection') == $obj->id) checked="" @endif>{{ $obj->name }}</option>
                                @endforeach
                            </select>
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
                    <hr>
                    <div class="row">   
                        <div class="col-md-8">
                            <label class="control-label">Question</label>
                            <input type="text" class="form-control" name="question" placeholder="Enter question" data-parsley-trigger="change" data-parsley-error-message="Please enter question" value="{{ Request::get('question') }}">
                        </div>                        
                        <div class="col-md-4 pull-right text-right margin-top20">
                            <a href="{{ URL::to('/examination/all-exam-question') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th>Exam Name</th>
                            <th>Exam Section</th>
                            <th>Question</th>
                            <th>Question Date</th>
                            <th>Question Added By</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($examQuestion as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{$item->sortname}}  {{ $item->name or '' }}</td>
                            <td>{{ $item->exam_sectionsName or 'Not updated yet' }}</td>
                            <td><span class="minimize"><p class="no-word-wrap">{!! strip_tags($item->question) !!}</p></span></td>
                            <td>{!! date('F d, Y', strtotime($item->questionDate)) !!}</td>
                            <td>
                                @if($item->userID)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $item->userID) }}" @endif>{{ $item->firstname }} {{ $item->lastname}} (ID:- {{ $item->userID}}) <hr> Date & Time:-  {{ $item->answerDate}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if((isset($validateUserRoleTypeOfExamination)) && (sizeof($validateUserRoleTypeOfExamination) > 0) && ($validateUserRoleTypeOfExamination[0]->show == '1'))
                                            <a href="{{ url('examination/type-of-examination/' . $item->examId) }}">
                                                <button type="submit" class="btn btn-warning btn-xs">View Examination Details</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                            <a href="{{ url('examination/exam-question/show/' . $item->id) }}">
                                                <button type="submit" class="btn btn-info btn-xs">View Question</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                            <a href="{{ url('examination/exam-question/edit/' . $item->id) }}">
                                                <button type="submit" class="btn btn-primary btn-xs">Edit Question</button>
                                            </a> 
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                            <a href="/delete-exam/question/{{$item->examId}}/{{$item->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Question</button></a>
                                        @endif
                                    @else
                                        <a href="{{ url('examination/type-of-examination/' . $item->examId) }}">
                                            <button type="submit" class="btn btn-warning btn-xs">View Examination Details</button>
                                        </a>
                                        <a href="{{ url('examination/exam-question/show/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">View Question</button>
                                        </a>
                                        <a href="{{ url('examination/exam-question/edit/' . $item->id) }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit Question</button>
                                        </a> 
                                        <a href="/delete-exam/question/{{$item->examId}}/{{$item->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete Question</button></a>
                                    @endif
                                @endif
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $examQuestion->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('.examsection').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.examsection').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
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
@endsection


