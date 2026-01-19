@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeSportsActivity'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Sports & Activity 
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Sports & Activity</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Sports & Activity</a>
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
                        <h2>Search College Sports & Activity</h2>        
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
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/college-sports-activity') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select collegeName" name="collegeprofile_id" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                <option value="" disabled="" selected="">Select college</option>
                                @foreach( $collegeProfileObj as $college )
                                    <option value="{{ $college->collegeprofileID }}" @if(Request::get('collegeprofile_id') == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
                                @endforeach
                            </select> 
                        </div>                        
                        <div class="col-md-4">
                            <label class="control-label">Search</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter name" data-parsley-trigger="change" data-parsley-error-message="Please enter name" value="{{ Request::get('search') }}">
                        </div> 
                        <div class="col-md-2">
                            <label class="control-label">Type Of Activity</label>
                            <select name="typeOfActivity" class="form-control chosen-select " data-parsley-error-message=" Please select type of activity" data-parsley-trigger="change">
                                <option value="" selected disabled>Select Type Of Activity</option>
                                <option value="1" @if( Request::get('typeOfActivity') == 1) selected="" @endif>Outdoor Sports</option>   
                                <option value="2" @if( Request::get('typeOfActivity') == 2) selected="" @endif>Indoor Sports</option>   
                                <option value="3" @if( Request::get('typeOfActivity') == 3) selected="" @endif>Co-curricular Activity</option>     
                            </select>
                        </div> 
                        <div class="col-md-2 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/college-sports-activity') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th width="20%">Type Of Activity</th>
                            <th width="20%">Name</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($collegesportsactivity as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                {{ $item->collegeUserFirstName }} <hr>
                                <a href="{{ url('college/' . $item->slug) }}" target="_blank" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> College Public View</a>
                                @if(Auth::check() && Auth::user()->userrole_id == 1)
                                <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $item->collegeprofile_id) }}" class="btn-block btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i> College Profile</a>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/users', $item->collegeUserID) }}" class="btn-block btn btn-sm btn-primary" title="edit"><i class="fa fa-edit"></i> User Details</a>
                                @endif
                            </td>
                            <td>
                                @if($item->typeOfActivity == 1)
                                    Outdoor Sports
                                @elseif($item->typeOfActivity == 2)
                                    Indoor Sports
                                @elseif($item->typeOfActivity == 3)
                                    Co-curricular Activity
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->name)
                                    {{ $item->name }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
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
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => [$fetchDataServiceController->routeCall().'/college-sports-activity', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete College Sports & Activity',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            ))!!}
                                        {!! Form::close() !!}
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-sports-activity/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>/
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/college-sports-activity', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete College Sports & Activity',
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
        <div class="pagination"> {!! $collegesportsactivity->render() !!} </div>
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
</script>
@endsection


