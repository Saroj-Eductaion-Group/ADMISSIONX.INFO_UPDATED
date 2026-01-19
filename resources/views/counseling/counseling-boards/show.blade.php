@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')

{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CounselingBoard'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Counseling Board Details {{ $counselingboard->id }}  <a href="{{ url('counseling/counseling-boards/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling Board</a></h2>
                @endif
            @else
                <h2>Counseling Board Details {{ $counselingboard->id }}  <a href="{{ url('counseling/counseling-boards/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling Board</a></h2>
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
               <a href="{{ url('counseling/counseling-boards') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url('counseling/boards/update-form-details/' . $counselingboard->id) }}">
                                <button type="submit" class="btn btn-warning btn-xs">Update More Details</button>
                            </a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url('counseling/counseling-boards/' . $counselingboard->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit counselingboard"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['counseling/counseling-boards', $counselingboard->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete counselingboard',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                        <a href="{{ url('counseling/boards/update-form-details/' . $counselingboard->id) }}">
                            <button type="submit" class="btn btn-warning btn-xs">Update More Details</button>
                        </a>
                        <a href="{{ url('counseling/counseling-boards/' . $counselingboard->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit counselingboard"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['counseling/counseling-boards', $counselingboard->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete counselingboard',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $counselingboard->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $counselingboard->name }} </td>
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td>{{ $counselingboard->title }} </td>
                        </tr>
                        <tr>
                            <th>Misc</th>
                            <td>
                                @if($counselingboard->misc == 'National')
                                    <span class="label label-primary">National</span>
                                @elseif($counselingboard->misc == 'State')
                                    <span class="label label-info">State</span>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $counselingboard->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($counselingboard->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $counselingboard->eUserId) }}" @endif>{{ $counselingboard->employeeFirstname }} {{ $counselingboard->employeeMiddlename}} {{ $counselingboard->employeeLastname}} (ID:- {{ $counselingboard->eUserId}}) Date & Time:-  {{ $counselingboard->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>

                <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2>Board Details</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            @if(!empty($counselingBoardDetailObj->image))
                                <img class="" src="/counselingimages/{{ $counselingBoardDetailObj->image }}" alt="{{ $counselingBoardDetailObj->image }}">
                            @endif
                        </div>
                    </div>
                    @if(sizeof($counselingBoardLatestUpdateObj) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileRight">
                                <h2>{{strtoupper($counselingboard->name)}} latest updates</h2>
                                <ul>
                                @foreach($counselingBoardLatestUpdateObj as $item)
                                    <li><span class="" style="color: orange;"> <strong>     => {{ $item->dates or '' }} </strong></span>: <span>{!! $item->description or '' !!}</span></li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(sizeof($counselingBoardImpDateObj) > 0)
                    <div class="row margin-top10">
                        <div class="col-md-12">
                            <div class="jobSkillReq">
                                <h2>Important Dates</h2>
                                <ul>
                                    @foreach($counselingBoardImpDateObj as $item)
                                        <li>
                                            <a href="javascript:void(0);"><i class="fa fa-check"></i>&nbsp;{{$item->dates}} : {!! $item->description or '' !!}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->aboutBoard))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2>About {{strtoupper($counselingboard->name)}} Board</h2>
                                <p>{!! $counselingBoardDetailObj->aboutBoard or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(sizeof($counselingBoardHighlightObj) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="jobProfileTop">List of {{strtoupper($counselingboard->name)}} highlights</h2>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Feature</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($counselingBoardHighlightObj as $item)
                                        <tr>
                                            <td width="25%">
                                                {{ $item->title or '' }}
                                            </td>
                                            <td>
                                               {!! $item->description or '' !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->admissionDesc))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2>Admission Process {{strtoupper($counselingboard->name)}} Board</h2>
                                <p>{!! $counselingBoardDetailObj->admissionDesc or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(sizeof($counselingBoardAdmissionDateObj) > 0)
                    <div class="row margin-bottom10">
                        <div class="col-md-8">
                            <h3 class="text-uppercase text-primary">List of {{strtoupper($counselingboard->name)}} Admission Dates</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Dates</th>
                                        <th>Subjects</th>
                                        <th>Fees</th>
                                        <th>Place</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($counselingBoardAdmissionDateObj as $item)
                                        <tr>
                                            <td>
                                                {{ $item->class or '' }}
                                            </td>
                                            <td>
                                                {{ $item->dates or '' }}
                                            </td>
                                            <td>
                                                {{ $item->subjects or '' }}
                                            </td>
                                            <td>
                                                {{ $item->fees or '' }}
                                            </td>
                                            <td>
                                                {{ $item->place or '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->boardDesc))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2> {{strtoupper($counselingboard->name)}} Board Details</h2>
                                <p>{!! $counselingBoardDetailObj->boardDesc or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->syllabusDesc))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2> {{strtoupper($counselingboard->name)}} Syllabus Details</h2>
                                <p>{!! $counselingBoardDetailObj->syllabusDesc or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(sizeof($counselingBoardSyllabusObj) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Subjects</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($counselingBoardSyllabusObj as $item)
                                        <tr>
                                            <td>
                                                {{ $item->class or '' }}
                                            </td>
                                            <td>
                                                {{ $item->subject or '' }}
                                            </td>
                                            <td>
                                                {!! $item->description or '' !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->samplePaper))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2> {{strtoupper($counselingboard->name)}} Sample Paper Details</h2>
                                <p>{!! $counselingBoardDetailObj->samplePaper or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(sizeof($counselingBoardSamplePaperObj) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Subjects</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($counselingBoardSamplePaperObj as $item)
                                        <tr>
                                            <td>
                                                {{ $item->class or '' }}
                                            </td>
                                            <td>
                                                {{ $item->subject or '' }}
                                            </td>
                                            <td>
                                                {!! $item->description or '' !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->admitCardDetails))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2> {{strtoupper($counselingboard->name)}} Admit Card Details</h2>
                                <p>{!! $counselingBoardDetailObj->admitCardDetails or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(sizeof($counselingBoardSamplePaperObj) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Dates</th>
                                        <th>Subject</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($counselingBoardSamplePaperObj as $item)
                                        <tr>
                                            <td>
                                                {{ $item->class or '' }}
                                            </td>
                                            <td>
                                                {{ $item->dates or '' }}
                                            </td>
                                            <td>
                                                {!! $item->subject or '' !!}
                                            </td>
                                            <td>
                                                {!! $item->setting or '' !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->preprationTips))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2> {{strtoupper($counselingboard->name)}} Board Prepration Tips</h2>
                                <p>{!! $counselingBoardDetailObj->preprationTips or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->resultDesc))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2> {{strtoupper($counselingboard->name)}} Result Details</h2>
                                <p>{!! $counselingBoardDetailObj->resultDesc or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->entranceExam))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2> {{strtoupper($counselingboard->name)}} Entrance Exam Details</h2>
                                <p>{!! $counselingBoardDetailObj->entranceExam or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($counselingBoardDetailObj->chooseRightCollege))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jobProfileTop">
                                <h2> {{strtoupper($counselingboard->name)}} Choose Right College Details</h2>
                                <p>{!! $counselingBoardDetailObj->chooseRightCollege or '' !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>

@endsection