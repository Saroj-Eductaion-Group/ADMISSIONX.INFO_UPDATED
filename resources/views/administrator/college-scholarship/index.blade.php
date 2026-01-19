@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeScholarship'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Scholarship
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-scholarship/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Scholarship</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/college-scholarship/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Scholarship</a>
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
                        <h2>Search College Scholarship</h2>        
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
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/college-scholarship') }}" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select collegeName" name="collegeprofile_id" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                <option value="" disabled="" selected="">Select college</option>
                                @foreach( $collegeProfileObj as $college )
                                    <option value="{{ $college->collegeprofileID }}" @if( Request::get('collegeprofile_id') == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
                                @endforeach
                            </select> 
                        </div>                        
                        <div class="col-md-5">
                            <label class="control-label">Search</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter title or description" data-parsley-trigger="change" data-parsley-error-message="Please enter title or description" value="{{ Request::get('search') }}">
                        </div> 
                        <div class="col-md-2 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/college-scholarship') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th>Scholarships Title</th>
                            <th>Description</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($collegescholarship as $item)
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
                                @if( $item->description )
                                    <span class="minimize"><p class="no-word-wrap">{!! strip_tags($item->description) !!}</p></span>
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
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/college-scholarship/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/college-scholarship/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => [$fetchDataServiceController->routeCall().'/college-scholarship', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete College Scholarship',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            ))!!}
                                        {!! Form::close() !!}
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-scholarship/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-scholarship/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>/
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/college-scholarship', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete College Scholarship',
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
        <div class="pagination"> {!! $collegescholarship->render() !!} </div>
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


