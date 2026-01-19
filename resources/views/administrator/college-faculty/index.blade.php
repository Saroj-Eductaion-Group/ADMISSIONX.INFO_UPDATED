@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<style type="text/css">
    .rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
    .rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
    .rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
    .rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
    </style>
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Faculty'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Faculty
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/faculty/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Faculty</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/faculty/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Faculty</a>
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
                        <h2>Search College Faculty</h2>        
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
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/faculty') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Faculty Name</label>
                            <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}">
                        </div>   
                        <div class="col-md-4">
                            <label class="control-label">Faculty Email</label>
                            <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}">
                        </div> 
                        <div class="col-md-4">
                            <label class="control-label">Faculty Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ Request::get('phone') }}">
                        </div>   
                    </div>
                    <hr>
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
                            <input type="text" class="form-control" name="search" placeholder="Enter address,description,designation etc." data-parsley-trigger="change" data-parsley-error-message="Please enter address,description,designation etc." value="{{ Request::get('search') }}">
                        </div> 
                        <div class="col-md-2 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/faculty') }}" class="btn btn-md btn-primary">Clear</a>
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
                @if( sizeof($faculty) > 0 )
                    @foreach( $faculty as $item )
                        <div class="row margin-bottom20 rating_reviews_info">
                            <div class="col-md-3">
                                <div class="padding-top10 padding-bottom10 padding-left10 padding-right10">
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa  fa-picture-o"></i> Profile Picture :  </label> <br>
                                        @if(!empty($item->imagename))
                                            <img class="img-circle" src="{{ asset('gallery'.'/'.$item->slug.'/'.$item->imagename) }}" width="120" height="120">
                                        @else
                                            <img src="/assets/images/no-college-logo.jpg" style="width:100%;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i>College Name : 
                                        @if( $item->collegeUserFirstName )
                                            {{ $item->collegeUserFirstName }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Name : 
                                        @if( $item->name )
                                            {{ $item->suffix }} {{ $item->name }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa fa-user"></i> Designation : 
                                        @if( $item->designation )
                                            {{ $item->designation }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa fa-envelope"></i> Email : 
                                        @if( $item->email )
                                            {{ $item->email }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa fa-phone"></i> Phone : 
                                        @if( $item->phone )
                                            {{ $item->phone }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa @if($item->gender == "1") fa-male @elseif($item->gender == "2") fa-female @elseif($item->gender == "3") fa-user @else fa-user @endif "></i> Gender : 
                                        @if($item->gender)
                                            @if($item->gender == "1") Male @elseif($item->gender == "2") Female @elseif($item->gender == "3") Other @endif
                                        @else
                                             <span class="label label-warning">Not updated yet</span>
                                        @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa fa-calendar"></i> Date Of Birth : 
                                        @if($item->dob)
                                            {{ date('d F Y', strtotime($item->dob)) }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="font-noraml"><i class="fa-fw fa fa-language"></i> Language Known : 
                                        @if( $item->languageKnown )
                                            {{ $item->languageKnown }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
                                    <div>
                                        @if(Auth::check())
                                            @if(Auth::user()->userrole_id == 4)
                                                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/faculty/' . $item->id) }}">
                                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                                    </a>
                                                @endif
                                                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/faculty/' . $item->id . '/edit') }}">
                                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                                    </a>
                                                @endif
                                                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                                    {!! Form::open([
                                                        'method'=>'DELETE',
                                                        'url' => [$fetchDataServiceController->routeCall().'/faculty', $item->id],
                                                        'style' => 'display:inline'
                                                    ]) !!}
                                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-danger btn-xs',
                                                                'title' => 'Delete College Faculty',
                                                                'onclick'=>'return confirm("Confirm delete?")'
                                                        ))!!}
                                                    {!! Form::close() !!}
                                                @endif
                                            @else
                                                <a href="{{ url($fetchDataServiceController->routeCall().'/faculty/' . $item->id) }}">
                                                    <button type="submit" class="btn btn-info btn-xs">Show</button>
                                                </a> /
                                                <a href="{{ url($fetchDataServiceController->routeCall().'/faculty/' . $item->id . '/edit') }}">
                                                    <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                                </a>/
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => [$fetchDataServiceController->routeCall().'/faculty', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger btn-xs',
                                                            'title' => 'Delete College Faculty',
                                                            'onclick'=>'return confirm("Confirm delete?")'
                                                    ))!!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseQualification{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-success" title="view"><i class="fa fa-eye"></i> Qualification Details</a>
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseExperience{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> Experience Details</a>
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseAssociateDepartment{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-primary" title="view"><i class="fa fa-eye"></i> Associate Department Details</a>
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseAddressDetails{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-warning" title="view"><i class="fa fa-eye"></i> Address Details</a>
                                        <a href="{{ url('college/' . $item->slug) }}" target="_blank" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> College Public View</a>
                                    </div>
                                </div>
                            </div>
                            @include('college/college-faculty.qualification-partial')
                            @include('college/college-faculty.experience-partial')
                            @include('college/college-faculty.associate-department-partial')
                            @include('college/college-faculty.address-details-partial')
                        </div>
                    @endforeach
                    <div class="row indexPagination">
                        <div class="col-md-12 text-center">
                        <div class="custom-pagination">{!! $faculty->render() !!}</div>
                        </div>
                    </div>
                @else
                    <h5>No Faculty listed.</h5>
                @endif
            </div>
        </div>
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


