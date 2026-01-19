@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('TypeOfExamination'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>List of Examination details <a href="{{ url('examination/type-of-examination/create') }}" class="btn btn-primary pull-right btn-sm">Add New List of Examination</a></h2>
                @endif
            @else
                <h2>List of Examination details <a href="{{ url('examination/type-of-examination/create') }}" class="btn btn-primary pull-right btn-sm">Add New List of Examination</a></h2>
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
                        <h2>Search List of Examination</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to('/examination/type-of-examination') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
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
                    </div>
                    <hr>
                    <div class="row">    
                        <div class="col-md-3">
                            <h4 for="usr">Examination Type
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="@if(!empty(Request::get('examinationtype'))) @else hide @endif"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select examinationtype" name="examinationtype" data-parsley-trigger="change" data-parsley-error-message="Please select exam section">
                                <option value="" disabled="" selected="">Select exam section</option>
                                @foreach( $examinationType as $obj )
                                    <option value="{{ $obj->id }}"  @if(Request::get('examinationtype') == $obj->id) selected="" @endif>{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>         
                        <div class="col-md-3">
                            <h4 for="usr">Application And Exam Status
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="@if(!empty(Request::get('applicationandexamstatus'))) @else hide @endif"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select applicationandexamstatus" name="applicationandexamstatus" data-parsley-trigger="change" data-parsley-error-message="Please select exam section">
                                <option value="" disabled="" selected="">Select exam section</option>
                                @foreach( $applicationAndExamStatus as $obj )
                                    <option value="{{ $obj->id }}"  @if(Request::get('applicationandexamstatus') == $obj->id) selected="" @endif>{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-md-3">
                            <h4 for="usr">Application Mode
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="@if(!empty(Request::get('modeofapplication'))) @else hide @endif"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select modeofapplication" name="modeofapplication" data-parsley-trigger="change" data-parsley-error-message="Please select exam section">
                                <option value="" disabled="" selected="">Select exam section</option>
                                @foreach( $applicationMode as $obj )
                                    <option value="{{ $obj->id }}"  @if(Request::get('modeofapplication') == $obj->id) selected="" @endif>{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>         
                        <div class="col-md-3">
                            <h4 for="usr">Examination Mode
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="@if(!empty(Request::get('examinationmode'))) @else hide @endif"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select examinationmode" name="examinationmode" data-parsley-trigger="change" data-parsley-error-message="Please select exam section">
                                <option value="" disabled="" selected="">Select exam section</option>
                                @foreach( $examinationMode as $obj )
                                    <option value="{{ $obj->id }}"  @if(Request::get('examinationmode') == $obj->id) selected="" @endif>{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>      
                     </div>
                    <hr>
                    <div class="row">   
                        <div class="col-md-3">
                            <h4 for="usr">Eligibility Criteria
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh6" class="@if(!empty(Request::get('eligibilitycriteria'))) @else hide @endif"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select eligibilitycriteria" name="eligibilitycriteria" data-parsley-trigger="change" data-parsley-error-message="Please select exam section">
                                <option value="" disabled="" selected="">Select exam section</option>
                                @foreach( $eligibilityCriterion as $obj )
                                    <option value="{{ $obj->id }}"  @if(Request::get('eligibilitycriteria') == $obj->id) selected="" @endif>{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>                  
                        <div class="col-md-3">
                            <h4 for="usr">Mode Of Payment
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh7" class="@if(!empty(Request::get('modeofpayment'))) @else hide @endif"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select modeofpayment" name="modeofpayment" data-parsley-trigger="change" data-parsley-error-message="Please select exam section">
                                <option value="" disabled="" selected="">Select exam section</option>
                                <option value="1"  @if(Request::get('modeofpayment') == 1) selected="" @endif>Online</option>
                                <option value="2"  @if(Request::get('modeofpayment') == 2) selected="" @endif>Offline</option>
                                <option value="3"  @if(Request::get('modeofpayment') == 3) selected="" @endif>Online & Offline</option>
                            </select>
                        </div>
                        @include('common-partials.common-exam-fileds-index-search-partial')
                    </div>
                    <hr>
                    <div class="row">   
                        @include('common-partials.common-search-employee-fileds-index-partial')
                        
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to('/examination/type-of-examination') }}" class="btn btn-md btn-primary">Clear</a>
                            <button class="btn btn-danger btn-md">Submit</button>                            
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
                @if( sizeof($typeofexamination) > 0 )
                    @foreach( $typeofexamination as $key => $item )
                    <div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 exam-list">
                        <div class="col-md-3">
                            <div class="white-bg padding-top10 padding-bottom10 padding-left10 padding-right10">
                                <div>
                                    <label class="font-noraml">S.No : <span class="font-bold text-uppercase text-black"><a href="{{ url('examination/type-of-examination', $item->id) }}">{{ $item->id }}</a> </span></label>
                                </div>
                                <div>
                                    <label class="font-noraml">Exam Sort name : <span class="font-bold text-uppercase text-black"><a href="{{ url('examination/type-of-examination', $item->id) }}">{{$item->sortname}}</a> </span></label>
                                </div>
                                <div class="">
                                    <label class="font-noraml">Exam Full Name : <span class="font-bold text-navy">{{ $item->name or '' }}</span></label>
                                </div>
                                <div class="">
                                    <label class="font-noraml">University : <span class="font-bold text-danger">{{ ucfirst($item->universityName) }}</span></label>
                                </div>
                                <div class="">
                                    <label class="font-noraml">Exam Section : <span class="font-bold text-danger">{{ $item->exam_sectionsName or 'Not updated yet' }}</span></label>
                                </div>
                                <div class="">
                                    <label class="font-noraml">Stream : <span class="font-bold text-danger">{{ ucfirst($item->functionalAreaName) }}</span></label>
                                </div>
                                
                                @if($item->status == 1)
                                    <label class="font-noraml">Status : <span class="font-bold badge badge-warning">Active</span></label>
                                @elseif($item->status == 2)
                                    <label class="font-noraml">Status : <span class="font-bold badge badge-success">Inactive</span></label>
                                @else
                                    <label class="font-noraml">Status : <span class="font-bold badge badge-danger">Not updated yet</span></label>
                                @endif
                                <div class="">
                                    <label class="font-noraml">Last Updated By : <span class="font-bold text-black">
                                    @if($item->eUserId)
                                        <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ date('F dS Y', strtotime($item->updated_at)) }} </a></a>
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                    </span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="white-bg padding-top10 padding-bottom10 padding-left10 padding-right10">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="">
                                            <label class="font-noraml"> Application Dates : @if(!empty($item->applicationFrom) && !empty($item->applicationTo)) {{ date('d F Y', strtotime($item->applicationFrom)) }} - {{ date('d F Y', strtotime($item->applicationTo)) }} @else Not updated yet @endif</label>
                                        </div>
                                        <div class="">
                                            <label class="font-noraml"> Exmination Date : {{ $item->exminationDate or 'Not updated yet' }}</label> 
                                        </div>
                                        <div class="">
                                            <label class="font-noraml"> Result Announce : {{ $item->resultAnnounce or 'Not updated yet' }}</label>
                                        </div>
                                        <div class="">
                                            <label class="font-noraml">Examination Type : <span class="font-bold text-navy">{{ $item->examination_typesName or 'Not updated yet' }}</span></label>
                                        </div>
                                        <div class="">
                                            <label class="font-noraml">Application And Exam Status : <span class="font-bold text-danger">{{ $item->applicationexamstatusesName or 'Not updated yet' }}</span></label>
                                        </div>
                                        <div class="">
                                            <label class="font-noraml">Application Mode : <span class="font-bold text-danger">{{ $item->application_modesName or 'Not updated yet' }}</span></label>
                                        </div>
                                        <div class="">
                                            <label class="font-noraml">Examination Mode : <span class="font-bold text-danger">{{ $item->examination_modesName or 'Not updated yet' }}</span></label>
                                        </div>
                                        <div class="">
                                            <label class="font-noraml">Eligibility Criteria : <span class="font-bold text-danger">{{ $item->eligibility_criteriasName or 'Not updated yet' }}</span></label>
                                        </div>
                                        <div class="">
                                            <label class="font-noraml">Mode Of Payment : 
                                            @if($item->modeofpayment == 1)
                                                <span class="font-bold badge badge-warning">Online</span>
                                            @elseif($item->modeofpayment == 2)
                                                <span class="font-bold badge badge-success">Offline</span>
                                            @elseif($item->modeofpayment == 3)
                                                <span class="font-bold badge badge-success">Online & Offline</span>
                                            @else
                                                <span class="font-bold badge badge-danger">Not updated yet</span>
                                            @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="">
                                            <label class="font-noraml">Logo :</label>
                                            @if( $item->universitylogo )
                                                <img class="img-responsive thumbnail" src="/examinationlogo/{{ $item->universitylogo }}" width="60" alt="{{ $item->universitylogo }}">
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-3 exam-action">
                            <div class="white-bg padding-top10 padding-bottom10 padding-left10 padding-right10">
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                        <a href="{{ url('examination/type-of-examination/' . $item->id) }}" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> View Details</a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url('examination/type-of-examination/' . $item->id . '/edit') }}" class="btn-block btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> Update</a>
                                        <a href="{{ url('examination/review-and-update-form-details/' . $item->id) }}" target="_blank">
                                            <button type="submit" class="btn-block btn btn-sm btn-primary"><i class="fa fa-edit"></i> Review & Update All Form Details</button>
                                        </a>
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-success" title="view"><i class="fa fa-edit"></i> Partial Update Exam Details</a> 
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/examination/type-of-examination', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn-block btn btn-sm btn-danger',
                                                    'title' => 'Delete Class',
                                                    'onclick'=>'return confirm("Confirm delete? Are you sure to proceed? As you click on the ok button, all the records of the examination will be deleted and cannot be recovered again.")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    @endif
                                    @include('common-partials.common-exam-fileds-index-partial')
                                @else
                                    <a href="{{ url('examination/type-of-examination/' . $item->id) }}" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> View Details</a>
                                    <a href="{{ url('examination/type-of-examination/' . $item->id . '/edit') }}" class="btn-block btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> Update</a>
                                    
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/examination/type-of-examination', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                'type' => 'submit',
                                                'class' => 'btn-block btn btn-sm btn-danger',
                                                'title' => 'Delete Class',
                                                'onclick'=>'return confirm("Confirm delete? Are you sure to proceed? As you click on the ok button, all the records of the examination will be deleted and cannot be recovered again.")'
                                        )) !!}
                                    {!! Form::close() !!}

                                    <a href="{{ url('examination/review-and-update-form-details/' . $item->id) }}" target="_blank">
                                        <button type="submit" class="btn-block btn btn-sm btn-primary"><i class="fa fa-edit"></i> Review & Update All Form Details</button>
                                    </a>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-success" title="view"><i class="fa fa-edit"></i> Partial Update Exam Details</a> 
                                    @include('common-partials.common-exam-fileds-index-partial')
                                @endif
                            @endif
                            </div>
                        </div>
                        @include('examination.common-partial.all-exam-partial-page-list')
                    </div>
                    @endforeach
                <div class="pagination-wrapper text-right"> {!! $typeofexamination->appends(\Input::except('page'))->render() !!}</div>
                @else
                    <div class="headline text-center"><h3>Examination records not found</h3></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('common-partials.common-exam-fileds-index-script-partial')
@include('common-partials.common-search-employee-index-script-partial')
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
    $('.examsection').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.examsection').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });

    $('.examinationtype').on('change',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('.examinationtype').val('').trigger('chosen:updated');
        $('#refresh2').addClass('hide');
    });

    $('.applicationandexamstatus').on('change',function(){
        $('#refresh3').removeClass('hide');
    });
    $('#refresh3').on('click',function(e){
        $('.applicationandexamstatus').val('').trigger('chosen:updated');
        $('#refresh3').addClass('hide');
    });


    $('.modeofapplication').on('change',function(){
        $('#refresh4').removeClass('hide');
    });
    $('#refresh4').on('click',function(e){
        $('.modeofapplication').val('').trigger('chosen:updated');
        $('#refresh4').addClass('hide');
    });

    $('.examinationmode').on('change',function(){
        $('#refresh5').removeClass('hide');
    });
    $('#refresh5').on('click',function(e){
        $('.examinationmode').val('').trigger('chosen:updated');
        $('#refresh5').addClass('hide');
    });

    $('.eligibilitycriteria').on('change',function(){
        $('#refresh6').removeClass('hide');
    });
    $('#refresh6').on('click',function(e){
        $('.eligibilitycriteria').val('').trigger('chosen:updated');
        $('#refresh6').addClass('hide');
    });

    $('.modeofpayment').on('change',function(){
        $('#refresh7').removeClass('hide');
    });
    $('#refresh7').on('click',function(e){
        $('.modeofpayment').val('').trigger('chosen:updated');
        $('#refresh7').addClass('hide');
    });    
</script>
@endsection


