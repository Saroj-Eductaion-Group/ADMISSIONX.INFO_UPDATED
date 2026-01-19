@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeAdmissionProcedure'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Admission Procedure
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Admission Procedure</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Admission Procedure</a>
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
                        <h2>Search College Admission Procedure</h2>        
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

                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/college-admission-procedure') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select collegeName" name="collegeprofile_id" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                <option value="" disabled="" selected="">Select college</option>
                                @foreach( $collegeProfileObj as $college )
                                    <option value="{{ $college->collegeprofileID }}" @if( Request::get('collegeprofile_id') == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
                                @endforeach
                            </select> 
                        </div>                        
                        <div class="col-md-6">
                            <label class="control-label">Search</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter title or description" data-parsley-trigger="change" data-parsley-error-message="Please enter title or description" value="{{ Request::get('search') }}">
                        </div> 
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Stream<span class="pull-right"> <a href="javascript:void(0);" id="refresh6" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                           <select class="form-control chosen-select functionalarea_id" name="functionalarea_id" data-parsley-trigger="change" data-parsley-error-message="Please select stream">
                                <option value="" disabled="" selected="">Select stream</option>
                                @foreach( $functionalAreaObj as $functional )
                                    <option value="{{ $functional->id }}">{{ $functional->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h4 for="usr">Degree
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select degree_id" name="degree_id" data-parsley-trigger="change" data-parsley-error-message="Please select degree">
                                <option value="" disabled="" selected="">Select degree</option>
                                @foreach( $degreeObj as $degree )
                                    <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h4 for="usr">Course
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh7" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select course_id" name="course_id" data-parsley-trigger="change" data-parsley-error-message="Please select course">
                                <option value="" disabled="" selected="">Select course</option>
                                @foreach( $courseObj as $course )
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <h4 for="usr">Degree Level
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select educationlevel_id" name="educationlevel_id" data-parsley-trigger="change" data-parsley-error-message="Please select degree level">
                                <option value="" disabled="" selected="">Select degree level</option>
                                @foreach( $educationLevelObj as $education )
                                    <option value="{{ $education->id }}">{{ $education->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-md-4">
                            <h4 for="usr">Course Type
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select coursetype_id" name="coursetype_id" data-parsley-trigger="change" data-parsley-error-message="Please select course type">
                                <option value="" disabled="" selected="">Select course type</option>
                                @foreach( $courseTypeObj as $courseType )
                                    <option value="{{ $courseType->id }}">{{ $courseType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/college-admission-procedure') }}" class="btn btn-md btn-primary">Clear</a>
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>College Name</th>
                            <th>Title</th>
                            <th>Stream</th>
                            <th>Degree</th>
                            <th>Course</th>
                            <th>Degree Level</th>
                            <th>Course Type</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($collegeadmissionprocedure as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td width="20%">
                                {{ $item->collegeUserFirstName }} <hr>
                                <a href="{{ url('college/' . $item->slug) }}" target="_blank" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> College Public View</a>
                                @if(Auth::check() && Auth::user()->userrole_id == 1)
                                <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $item->collegeprofile_id) }}" class="btn-block btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> College Profile</a>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/users', $item->collegeUserID) }}" class="btn-block btn btn-sm btn-primary" title="edit"><i class="fa fa-edit"></i> User Details</a>
                                @endif
                            </td>
                            <td>
                                @if( $item->title )
                                   {{$item->title}}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                            <td>
                                @if( $item->functionalAreaName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/functionalarea') }}/{{ $item->functionalareaID }}" @endif title=" {{ $item->functionalAreaName }}">{{ $item->functionalAreaName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if( $item->degreeName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/degree') }}/{{ $item->degreeId }}" @endif title=" {{ $item->degreeName }}">{{ $item->degreeName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if( $item->courseName)
                                   <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/course') }}/{{ $item->courseID }}" @endif title="{{ $item->courseName }}"> {{ $item->courseName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if( $item->educationlevelName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/educationlevel') }}/{{ $item->educationlevelId }}" @endif title=" {{ $item->educationlevelName }}">{{ $item->educationlevelName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if( $item->coursetypeName)
                                    <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/coursetype') }}/{{ $item->coursetypeId }}" @endif title=" {{ $item->coursetypeName }}">{{ $item->coursetypeName }}</a>
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
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    <td>
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a> 
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => [$fetchDataServiceController->routeCall().'/college-admission-procedure', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete College Admission Procedure',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            ))!!}
                                        {!! Form::close() !!}
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-admission-procedure/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>/
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/college-admission-procedure', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete College Admission Procedure',
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
        <div class="pagination"> {!! $collegeadmissionprocedure->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('.collegeName').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.collegeName').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });

    $('.educationlevel_id').on('change',function(){
        $('#refresh3').removeClass('hide');
    });
    $('#refresh3').on('click',function(e){
        $('.educationlevel_id').val('').trigger('chosen:updated');
        $('#refresh3').addClass('hide');
    });

    $('.coursetype_id').on('change',function(){
        $('#refresh4').removeClass('hide');
    });
    $('#refresh4').on('click',function(e){
        $('.coursetype_id').val('').trigger('chosen:updated');
        $('#refresh4').addClass('hide');
    });
    
    $('.degree_id').on('change',function(){
        $('#refresh5').removeClass('hide');
    });
    $('#refresh5').on('click',function(e){
        $('.degree_id').val('').trigger('chosen:updated');
        $('#refresh5').addClass('hide');
    });

    $('.functionalarea_id').on('change',function(){
        $('#refresh6').removeClass('hide');
    });
    $('#refresh6').on('click',function(e){
        $('.functionalarea_id').val('').trigger('chosen:updated');
        $('#refresh6').addClass('hide');
    });

    $('.course_id').on('change',function(){
        $('#refresh7').removeClass('hide');
    });
    $('#refresh7').on('click',function(e){
        $('.course_id').val('').trigger('chosen:updated');
        $('#refresh7').addClass('hide');
    });
</script>
@include('administrator.college-cut-offs.fetch-degree-course-partial')

@endsection


