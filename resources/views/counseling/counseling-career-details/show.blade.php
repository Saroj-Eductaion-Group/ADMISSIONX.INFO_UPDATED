@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CounselingCareerDetail'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Popular Career Details {{ $counselingcareerdetail->id }}  <a href="{{ url('counseling/counseling-career-details/create') }}" class="btn btn-primary pull-right btn-sm">Add New Popular Career</a></h2>
                @endif
            @else
                <h2>Popular Career Details {{ $counselingcareerdetail->id }}  <a href="{{ url('counseling/counseling-career-details/create') }}" class="btn btn-primary pull-right btn-sm">Add New Popular Career</a></h2>
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
               <a href="{{ url('counseling/counseling-career-details') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url('counseling/counseling-career-details/' . $counselingcareerdetail->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Eligibility Criteria"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['counseling/counseling-career-details', $counselingcareerdetail->id],
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
                        <a href="{{ url('counseling/counseling-career-details/' . $counselingcareerdetail->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Eligibility Criteria"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['counseling/counseling-career-details', $counselingcareerdetail->id],
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
                            <td>{{ $counselingcareerdetail->id }}</td> 
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $counselingcareerdetail->title }} </td>
                        </tr>
                        <tr>
                            <th>Icon Image</th>
                            <td> 
                                @if(isset($counselingcareerdetail) && !empty($counselingcareerdetail->image))
                                    <img class="img-responsive thumbnail" width="200" src="/counselingimages/{{ $counselingcareerdetail->image }}" alt="{{ $counselingcareerdetail->image }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $counselingcareerdetail->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $counselingcareerdetail->description !!} </td>
                        </tr>
                        <tr>
                            <th>Skills</th>
                            <td>
                                <div class="row margin-top20">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Skill</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tableCounslingJobRoleSalerySection">
                                                @if(isset($counselingCareerSkillRequirementObj))
                                                @foreach($counselingCareerSkillRequirementObj as $item)
                                                    <tr>
                                                        <td>{{$item->title}}</td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Job Profile Desc</th>
                            <td>{!! $counselingcareerdetail->jobProfileDesc !!}
                                <div class="row margin-top20">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Job Title</th>
                                                    <th>Avg Salery</th>
                                                    <th>Top Company</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tableCounslingJobRoleSalerySection">
                                                @if(isset($counselingCareerJobRoleSaleryObj))
                                                @foreach($counselingCareerJobRoleSaleryObj as $item)
                                                    <tr>
                                                        <td>{{$item->title}}</td>
                                                        <td>{{$item->avgSalery}}</td>
                                                        <td>{{$item->topCompany}}</td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Pros.</th>
                            <td>{!! $counselingcareerdetail->pros !!}</td>
                        </tr>
                        <tr>
                            <th>Cons.</th>
                            <td>{!! $counselingcareerdetail->cons !!}</td>
                        </tr>
                        <tr>
                            <th>Purpose</th>
                            <td>{!! $counselingcareerdetail->purpose_desc !!}</td>
                        </tr>
                        <tr>
                            <th>Future Growth Purpose</th>
                            <td>{!! $counselingcareerdetail->futureGrowthPurpose !!}</td>
                        </tr>
                        <tr>
                            <th>Eligibility</th>
                            <td>{!! $counselingcareerdetail->eligibility !!}</td>
                        </tr>
                        <tr>
                            <th>Qualification</th>
                            <td>{!! $counselingcareerdetail->qualification !!}</td>
                        </tr>
                        <tr>
                            <th>Syllabus</th>
                            <td>{!! $counselingcareerdetail->syllabus !!}</td>
                        </tr>
                        <tr>
                            <th>Exam Pattern</th>
                            <td>{!! $counselingcareerdetail->exam_pattern !!}</td>
                        </tr>
                        <tr>
                            <th>Selection Criteria</th>
                            <td>{!! $counselingcareerdetail->selection_criteria !!}</td>
                        </tr>
                        <tr>
                            <th>Frequency</th>
                            <td>{!! $counselingcareerdetail->frequency !!}</td>
                        </tr>
                        <tr>
                            <th>Employee Opportunities</th>
                            <td>{!! $counselingcareerdetail->employeeOpportunities !!}</td>
                        </tr>
                        <tr>
                            <th>Study Material</th>
                            <td>{!! $counselingcareerdetail->studyMaterial !!}</td>
                        </tr>
                        <tr>
                            <th>Where To Study</th>
                            <td>
                                {!! $counselingcareerdetail->whereToStudy !!}
                                <br>
                                <div class="row margin-top20">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Institute Name</th>
                                                    <th>Institute Url</th>
                                                    <th>City</th>
                                                    <th>Programme Fees</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tableCounslingJobRoleSalerySection">
                                                @if(isset($counselingCareerWhereToStudyObj))
                                                @foreach($counselingCareerWhereToStudyObj as $item)
                                                    <tr>
                                                        <td>{{$item->instituteName}}</td>
                                                        <td>{{$item->instituteUrl}}</td>
                                                        <td>{{$item->city}}</td>
                                                        <td>{{$item->programmeFees}}</td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Other Details</th>
                            <td>{!! $counselingcareerdetail->other_details !!}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($counselingcareerdetail->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $counselingcareerdetail->eUserId) }}" @endif>{{ $counselingcareerdetail->employeeFirstname }} {{ $counselingcareerdetail->employeeMiddlename}} {{ $counselingcareerdetail->employeeLastname}} (ID:- {{ $counselingcareerdetail->eUserId}}) Date & Time:-  {{ $counselingcareerdetail->updated_at}} </a></a>
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

@endsection