@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

<style type="text/css">
.rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
</style>
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeReview'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Reviews
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-reviews/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Reviews</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/college-reviews/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Reviews</a>
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
                        <h2>Search College Reviews</h2>        
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
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/college-reviews') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select collegeName" name="collegeprofile_id" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                <option value="" disabled="" selected="">Select college</option>
                                @foreach( $collegeProfileObj as $college )
                                    <option value="{{ $college->collegeprofileID }}" @if( Request::get('collegeprofile_id') == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
                                @endforeach
                            </select> 
                        </div>       
                        <div class="col-md-3">
                            <h4 for="usr">User Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select studentName" name="guestUserId" data-parsley-trigger="change" data-parsley-error-message="Please select user name">
                                <option value="" disabled="" selected="">Select user name</option>
                                @foreach( $userProfileObj as $user )
                                    <option value="{{ $user->id }}" @if( Request::get('guestUserId') == $user->id) selected="" @endif>{{ $user->fullname }}</option>
                                @endforeach
                            </select> 
                        </div>                        
                        <div class="col-md-3">
                            <label class="control-label">Search</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter title or description" data-parsley-trigger="change" data-parsley-error-message="Please enter title or description" value="{{ Request::get('search') }}">
                        </div> 
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/college-reviews') }}" class="btn btn-md btn-primary">Clear</a>
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
            <div class="ibox-content table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th width="20%">College Name</th>
                            <th>Student Name</th>
                            <th>Review Date</th>
                            <th>Vote</th>
                            <th width="25%">Ratings</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($collegereviews as $item)
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
                                @if( $item->collegeUserFirstName )
                                    {{ $item->studentUserFirstName }} {{ $item->studentUserLastName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->created_at)
                                    {{ date('d F Y', strtotime($item->created_at)) }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                            <td>
                                @if( $item->votes )
                                    @if($item->votes == 1)<span class="label label-success rounded">Liked</span> @elseif($item->votes == 2)<span class="label label-danger rounded">Disliked</span> @endif
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Academic : 
                                    @if( $item->academic )
                                        {{ $item->academic }}/5
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Accommodation : 
                                    @if( $item->accommodation )
                                        {{ $item->accommodation }}/5
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Faculty : 
                                    @if( $item->faculty )
                                        {{ $item->faculty }}/5
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Infrastructure : 
                                    @if( $item->infrastructure )
                                        {{ $item->infrastructure }}/5
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Placement : 
                                    @if( $item->placement )
                                        {{ $item->placement }}/5
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Social : 
                                    @if( $item->social )
                                        {{ $item->social }}/5
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
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
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/college-reviews/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/college-reviews/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => [$fetchDataServiceController->routeCall().'/college-reviews', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete College Reviews',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            ))!!}
                                        {!! Form::close() !!}
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-reviews/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/college-reviews/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>/
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/college-reviews', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete College Reviews',
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
        <div class="pagination"> {!! $collegereviews->render() !!} </div>
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

    $('.studentName').on('change',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('.studentName').val('').trigger('chosen:updated');
        $('#refresh2').addClass('hide');
    });
</script>
@endsection


