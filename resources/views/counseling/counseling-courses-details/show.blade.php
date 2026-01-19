@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('style')
<link rel="stylesheet" type="text/css" crossorigin="anonymous" media="all" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script rel="prefetch" type="text/javascript" crossorigin="anonymous" media="all" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
  p{font-size: 16px; font-family: 'Montserrat', sans-serif;}
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
</style>
{{ Html::style('website-assets/css/bootstrap.min.css') }}
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CounselingCoursesDetail'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Counseling Courses Detail Details {{ $counselingcoursesdetail->id }}  <a href="{{ url('counseling/counseling-courses-details/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling Courses Detail</a></h2>
                @endif
            @else
                <h2>Counseling Courses Detail Details {{ $counselingcoursesdetail->id }}  <a href="{{ url('counseling/counseling-courses-details/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling Courses Detail</a></h2>
            @endif
        @endif
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url('counseling/counseling-courses-details') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a class="" href="{{ url('counseling/courses/update-form-details/' . $counselingcoursesdetail->id) }}"><button type="submit" class="btn btn-warning btn-xs">Update More Details</button></a>   
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url('counseling/counseling-courses-details/' . $counselingcoursesdetail->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Eligibility Criteria"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['counseling/counseling-courses-details', $counselingcoursesdetail->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Eligibility Criteria',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                        <a class="" href="{{ url('counseling/courses/update-form-details/' . $counselingcoursesdetail->id) }}"><button type="submit" class="btn btn-warning btn-xs">Update More Details</button></a>    
                        <a href="{{ url('counseling/counseling-courses-details/' . $counselingcoursesdetail->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Eligibility Criteria"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['counseling/counseling-courses-details', $counselingcoursesdetail->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Eligibility Criteria',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif
                
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $counselingcoursesdetail->id }}</td> 
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td>{{ $counselingcoursesdetail->functionalAreaName }}</td>
                        </tr>
                        <tr>
                            <th>Eligibility</th>
                            <th>
                                @foreach($counselingCoursesEducationLevelObj as $item)
                                <span class="label label-info">{{ $item->name }}</span>
                                @endforeach
                            </th>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $counselingcoursesdetail->title }} </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $counselingcoursesdetail->description !!} </td>
                        </tr>
                        <tr>
                            <th>Icon Image</th>
                            <td> 
                                @if(isset($counselingcoursesdetail) && !empty($counselingcoursesdetail->image))
                                    <img class="img-responsive thumbnail" width="200" src="/counselingimages/{{ $counselingcoursesdetail->image }}" alt="{{ $counselingcoursesdetail->image }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Best Choice Of Course</th>
                            <td>{!! $counselingcoursesdetail->bestChoiceOfCourse !!} </td>
                        </tr>
                        <tr>
                            <th>Jobs Career Opportunity Desc</th>
                            <td>{!! $counselingcoursesdetail->jobsCareerOpportunityDesc !!} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($counselingcoursesdetail->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $counselingcoursesdetail->eUserId) }}" @endif>{{ $counselingcoursesdetail->employeeFirstname }} {{ $counselingcoursesdetail->employeeMiddlename}} {{ $counselingcoursesdetail->employeeLastname}} (ID:- {{ $counselingcoursesdetail->eUserId}}) Date & Time:-  {{ $counselingcoursesdetail->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>List of "{{strtoupper($counselingcoursesdetail->title)}}" Job Careers</h5>                            
            </div>
            <div class="ibox-content">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Job Profiles</th>
                            <th>Avg Salery</th>
                            <th>Top Company</th>
                        </tr>
                    </thead>
                    <tbody class="tableCoursesJobCareerSection">
                        @foreach($counselingCoursesJobCareerObj as $item)
                            <tr>
                                <td>
                                    {{$item->courseName}}
                                </td>
                                <td>
                                    {{$item->jobProfiles}}
                                </td>
                                <td>
                                    {{$item->avgSalery}}
                                </td>
                                <td>
                                    {{$item->topCompany}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="panel-body">
    <div class="row margin-bottom10">
        <div class="col-md-12">
            <h3 class="text-uppercase text-info">List of Course details</h3>
        </div>
    </div>
    <div class="counslingHighlightsSection">
        @foreach($counselingCoursesMoreDetailObj as $key => $item)
        <div class="clientContactDetails">
            <h4 class="padding-bottom10">{{strtoupper($item->degreeName)}} details</h4>
            <div class="row">
                <div class="col-md-12">
                    <label class="">Title : </label>
                    <p>{{ $item->title or 'Not Updated Yet' }}</p>
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-md-12">
                    <label class="">Popular Cities : </label>
                    <p>{{ $item->popularCities or 'Not Updated Yet' }}</p>
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-md-12">
                    <label class="">Specialisations : </label>
                    <p>{{ $item->specialisations or 'Not Updated Yet' }}</p>
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-md-12">
                    <label class="">Entrance Exams Name : </label>
                    <p>{{ $item->entranceExamsName or 'Not Updated Yet' }}</p>
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-md-12">
                    <label class="">Description : </label>
                    <p>{!! $item->description or 'Not Updated Yet' !!}</p>
                </div>
            </div>
            <hr class="hr-line-dashed">
        </div>
        <hr class="hr-line-dashed">
        @endforeach
    </div>
</div>
<hr>
@endsection