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
        <h2>College Faculty {{ $faculty->id }} 
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

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url($fetchDataServiceController->routeCall().'/faculty') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/faculty/' . $faculty->id . '/edit') }}">
                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => [$fetchDataServiceController->routeCall().'/faculty', $faculty->id],
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
                       <a href="{{ url($fetchDataServiceController->routeCall().'/faculty/' . $faculty->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit College Faculty"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/faculty', $faculty->id],
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

                <a href="{{ url('/college/' . $faculty->slug) }}" target="_blank" class="btn btn-xs btn-info" title="view"><i class="fa fa-eye"></i> College Public View</a>
           
                @if(!empty($faculty))
                    <div class="row margin-bottom20 rating_reviews_info">
                        <div class="col-md-3">
                            <div class="padding-top10 padding-bottom10 padding-left10 padding-right10">
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa  fa-picture-o"></i> Profile Picture :  </label> <br>
                                    @if(!empty($faculty->imagename))
                                        <img class="img-circle" src="{{ asset('gallery'.'/'.$faculty->slug.'/'.$faculty->imagename) }}" width="120" height="120">
                                    @else
                                        <img src="/assets/images/no-college-logo.jpg" style="width:100%;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
                                <h4 class=""><strong>Personal Information</strong></h4>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i>College Name : 
                                    @if( $faculty->collegeUserFirstName )
                                        {{ $faculty->collegeUserFirstName }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Name : 
                                    @if( $faculty->name )
                                        {{ $faculty->suffix }} {{ $faculty->name }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-user"></i> Designation : 
                                    @if( $faculty->designation )
                                        {{ $faculty->designation }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-envelope"></i> Email : 
                                    @if( $faculty->email )
                                        {{ $faculty->email }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-phone"></i> Phone : 
                                    @if( $faculty->phone )
                                        {{ $faculty->phone }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa @if($faculty->gender == "1") fa-male @elseif($faculty->gender == "2") fa-female @elseif($faculty->gender == "3") fa-user @endif "></i> Gender : 
                                    @if($faculty->gender)
                                        @if($faculty->gender == "1") Male @elseif($faculty->gender == "2") Female @elseif($faculty->gender == "3") Other @endif
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-calendar"></i> Date Of Birth : 
                                    @if($faculty->dob)
                                        {{ date('d F Y', strtotime($faculty->dob)) }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-language"></i> Language Known : 
                                    @if( $faculty->languageKnown )
                                        {{ $faculty->languageKnown }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
                                <h4 class=""><strong>Address Information</strong></h4>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Address Line 1 : 
                                    @if($faculty->addressline1)
                                        {{ $faculty->addressline1 }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Address Line 2 : 
                                    @if($faculty->addressline2)
                                        {{ $faculty->addressline2 }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Landmark : 
                                    @if($faculty->landmark)
                                        {{ $faculty->landmark }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> City : 
                                    @if($faculty->cityName)
                                        {{ $faculty->cityName }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> State : 
                                    @if($faculty->stateName)
                                        {{ $faculty->stateName }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Country : 
                                    @if($faculty->countryName)
                                        {{ $faculty->countryName }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Pincode : 
                                    @if($faculty->pincode)
                                        {{ $faculty->pincode }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>    
                        <div class="col-md-12">
                            <div class="white-bg">
                                <div class="panel-body">
                                    <h4 class=""><strong>Qualification Details</strong></h4>
                                    @if(sizeof($qualificationsObj) > 0)
                                    <div class="ibox-content table-responsive">
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Qualification</th>
                                                    <th>Course</th>
                                                    <th>Subject</th>
                                                    <th>Passing Year</th>
                                                    <th>College Name</th>
                                                    <th>Board Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($qualificationsObj as $key1 => $item1)
                                                <tr>
                                                    <td>{{ $item1->qualification }}</td>
                                                    <td>{{ $item1->course }}</td>
                                                    <td>{{ $item1->subjects }}</td>
                                                    <td>{{ $item1->year }}</td>
                                                    <td>{{ $item1->collegename }}</td>
                                                    <td>{{ $item1->boardName }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="profile-bio">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="headline text-center">
                                                    <h2 class="">No Faculty Qualification Added...</h2>
                                                </div>
                                            </div>                          
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="white-bg">
                                <div class="panel-body">
                                    <h4 class=""><strong>Experience Details</strong></h4>
                                    @if(sizeof($experienceObj) > 0)
                                    <div class="ibox-content table-responsive">
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Organization Name</th>
                                                    <th>Role</th>
                                                    <th>Form Year</th>
                                                    <th>To Year</th>
                                                    <th>City</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($experienceObj as $key1 => $item2)
                                                <tr>
                                                    <td>{{ $item2->organisation }}</td>
                                                    <td>{{ $item2->role }}</td>
                                                    <td>{{ $item2->fromyear }}</td>
                                                    <td>{{ $item2->toyear }}</td>
                                                    <td>{{ $item2->city }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="profile-bio">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="headline text-center">
                                                    <h2 class="">No Faculty Experience Added...</h2>
                                                </div>
                                            </div>                          
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="white-bg">
                                <div class="panel-body">
                                    <h4 class=""><strong>List of all the departments with which you are connected</strong></h4>
                                    @if(sizeof($facultyDepartmentObj) > 0)
                                    <div class="ibox-content table-responsive">
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Stream</th>
                                                    <th>Degree</th>
                                                    <th>Course</th>
                                                    <th>Degree Level</th>
                                                    <th>Course Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($facultyDepartmentObj as $key1 => $item3)
                                                <tr>
                                                    <td>{{ $item3->functionalareaName }}</td>
                                                    <td>{{ $item3->degreeName }}</td>
                                                    <td>{{ $item3->courseName }}</td>
                                                    <td>{{ $item3->educationlevelName }}</td>
                                                    <td>{{ $item3->coursetypeName }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="profile-bio">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="headline text-center">
                                                    <h2 class="">No Faculty Associate Department Added...</h2>
                                                </div>
                                            </div>                          
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h5>Faculty Detaails Not Found.</h5>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection