@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Course'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Course Details @if(Auth::check()) @if(Auth::user()->userrole_id == 1) <a href="{{ url($fetchDataServiceController->routeCall().'/course/create') }}" class="btn btn-primary pull-right btn-sm">Add New Course</a> @endif @endif</h2>
        <!-- @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/course/create') }}" class="btn btn-primary pull-right btn-sm">Add New Course</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/course/create') }}" class="btn btn-primary pull-right btn-sm">Add New Course</a>
            @endif
        @endif
        </h2> -->
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Course</h2>        
                    </div>    
                </div>
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/course') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 for="usr">Course Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control courseName" name="courseName" placeholder="Enter course name here" data-parsley-error-message="Please enter course name" data-parsley-trigger="change" value="{{Request::get('courseName') }}">
                        </div> 
                        <div class="col-md-6">
                            <h4 for="usr">Degree Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select degreeName" name="degreeName" data-parsley-trigger="change" data-parsley-error-message="Please select degree name">
                                <option value="" disabled="" selected="">Select degree name</option>
                                @foreach( $degreeObj as $degree )
                                    <option value="{{ $degree->id }}" @if(Request::get('degreeName') == $degree->id) selected="" @endif>{{ $degree->name }}  (Stream - {{ $degree->functionalareaName }})</option>
                                @endforeach
                            </select> 
                        </div>
                        @include('common-partials.common-search-employee-fileds-index-partial')                      
                        @include('common-partials.common-fileds-index-search-partial')
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/course') }}" class="btn btn-md btn-primary">Clear</a>
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
                <label class="pull-right">Total Result :- {{ $course->total() }}</label>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Degree Name</th>
                            <th>Stream</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($course as $item)
                        <tr>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/course', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/course', $item->id) }}">{{ $item->name }}</a>
                            	@include('common-partials.common-fileds-index-partial')
                            </td>
                            <td>{{ $item->degreeName }}</td>
                            <td>{{ $item->functionalareaName }}</td>
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
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/course/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/course/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/course/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/course/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>/
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/course', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                    {!! Form::close() !!}
                                </td>
                                @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        		<div class="pagination"> {!! $course->appends(\Input::except('page'))->render() !!} </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('common-partials.common-fileds-index-script-partial')
@include('common-partials.common-search-employee-index-script-partial')
<script type="text/javascript">
    $(".chosen-select").chosen({
        placeholder_text_single: "Select an option",
        no_results_text: "Oops, nothing found!"
    });
    $('.slideDown').hide();
    $('.filterout').on('click',function(){
        $(".slideDown").toggle();
        $(".slideDown").css('visibility', 'visible');
        $(".resetfilter").addClass('hide');
        $(".exportToExcel").addClass('hide');
    });
    var resultZeroValue = $('.result-zero').val();
    if( resultZeroValue == '0' ){
        $('.filterout').addClass('hide');
    }

    $('.courseName').on('blur',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('.courseName').val('');
        $('#refresh2').addClass('hide');
    });
    

    $('.degreeName').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.degreeName').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });
</script>
@endsection