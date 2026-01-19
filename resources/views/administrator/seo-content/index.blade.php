@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection


@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('SeoContent'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Seo Content</h2>        
    </div>    
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search SEO Content</h2>        
                    </div>    
                </div>
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/seo-content') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Page Title</label>
                            <input type="text" name="pagetitle" class="form-control" value="{{ Request::get('pagetitle') }}">
                        </div>    
                        <div class="col-md-4">
                            <label class="control-label">Meta Keyword</label>
                            <input type="text" name="keyword" class="form-control" value="{{ Request::get('keyword') }}">
                        </div> 
                        <div class="col-md-4">
                            <label class="control-label">H1 Title</label>
                            <input type="text" name="h1title" class="form-control" value="{{ Request::get('h1title') }}">
                        </div> 
                    </div>
                    <div class="row margin-top20">
                        <div class="col-md-8">
                            <label class="control-label">Any Other Search Value</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter anu other search value" data-parsley-trigger="change" data-parsley-error-message="Please enter anu other search value" value="{{ Request::get('search') }}">
                        </div>   
                        <div class="col-md-4 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/seo-content') }}" class="btn btn-md btn-primary">Clear</a>
                            <button class="btn btn-danger btn-md">Submit</button>                            
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
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
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page Title</th>
                        <th>H1 Title</th>
                        <th>Keyword</th>
                        <th>Misc</th>
                        <th>SEO On Page</th>
                        <th>Last Updated By</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $seocontent as $item )
                    <tr>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id) }}">{{ $item->id }}</a></td>
                        <td class=""><a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id) }}">{{ $item->pagetitle or '--' }}</a></td>
                        <td class="">{{ $item->h1title or '--' }}</td>
                        <td>{{ $item->keyword or '--'}}</td>
                        <td><label class="label label-info">{{ strtoupper($item->misc)}}</label></td>
                        <td>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if(!empty($item->pageId))
                                        {{ $item->contentcategoryName }}
                                    @elseif(!empty($item->userId))
                                        {{ $item->studentName }}
                                    @elseif(!empty($item->collegeId))
                                        {{ $item->collegeName }}
                                    @elseif(!empty($item->examId))
                                        {{ $item->sortname }}
                                    @elseif(!empty($item->boardId))
                                        {{ $item->counseling_boardsName }}
                                    @elseif(!empty($item->careerReleventId))
                                        {{ $item->careerRelevantsTitle }}
                                    @elseif(!empty($item->popularCareerId))
                                        {{ $item->popularCareerTitle }}
                                    @elseif(!empty($item->courseId))
                                        {{ $item->careerCourseTitle }}
                                    @elseif(!empty($item->blogId))
                                        {{ $item->topic }}
                                    @elseif(!empty($item->examSectionId))
                                        {{ $item->exam_sectionsName }}
                                    @elseif(!empty($item->educationLevelId))
                                        {{ $item->educationlevelName }}
                                    @elseif(!empty($item->degreeId))
                                        {{ $item->degreeName }}
                                    @elseif(!empty($item->functionalAreaId))
                                        {{ $item->functionalareaName }}
                                    @elseif(!empty($item->topCourseId))
                                        {{ $item->courseName }}
                                    @elseif(!empty($item->universityId))
                                        {{ $item->universityName }}
                                    @elseif(!empty($item->countryId))
                                        {{ $item->countryName }}
                                    @elseif(!empty($item->stateId))
                                        {{ $item->stateName }}
                                    @elseif(!empty($item->cityId))
                                        {{ $item->cityName }}
                                    @elseif(!empty($item->newsId))
                                        {{ $item->newsTopic }}
                                    @elseif(!empty($item->newsTagId))
                                        {{ $item->news_tagsName }}
                                    @elseif(!empty($item->newsTypeId))
                                        {{ $item->news_typesName }}
                                    @elseif(!empty($item->askQuestionId))
                                        {{ str_limit(strip_tags($item->ask_questionsName), 50) }}
                                    @elseif(!empty($item->askTagId))
                                        {{ $item->ask_question_tagsName }}
                                    @else
                                        --
                                    @endif
                                @else
                                    @if(!empty($item->pageId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $item->pageId) }}">{{ $item->contentcategoryName }}</a>
                                    @elseif(!empty($item->userId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/studentprofile/' . $item->userId) }}">{{ $item->studentName }}</a>
                                    @elseif(!empty($item->collegeId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $item->collegeId) }}">{{ $item->collegeName }}</a>
                                    @elseif(!empty($item->examId))
                                        <a href="{{ url('/examination/type-of-examination/' . $item->examId) }}">{{ $item->sortname }}</a>
                                    @elseif(!empty($item->boardId))
                                        <a href="{{ url('/counseling/counseling-boards/' . $item->boardId) }}">{{ $item->counseling_boardsName }}</a>
                                    @elseif(!empty($item->careerReleventId))
                                        <a href="{{ url('/counseling/counseling-career-relevant/' . $item->careerReleventId) }}">{{ $item->careerRelevantsTitle }}</a>
                                    @elseif(!empty($item->popularCareerId))
                                        <a href="{{ url('/counseling/counseling-career-details/' . $item->popularCareerId) }}">{{ $item->popularCareerTitle }}</a>
                                    @elseif(!empty($item->courseId))
                                        <a href="{{ url('/counseling/counseling-courses-details/' . $item->courseId) }}">{{ $item->careerCourseTitle }}</a>
                                    @elseif(!empty($item->blogId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/blogs/' . $item->blogId) }}">{{ $item->topic }}</a>
                                    @elseif(!empty($item->examSectionId))
                                        <a href="{{ url('/examination/exam-section/' . $item->examSectionId) }}">{{ $item->exam_sectionsName }}</a>
                                    @elseif(!empty($item->educationLevelId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/educationlevel/' . $item->educationLevelId) }}">{{ $item->educationlevelName }}</a>
                                    @elseif(!empty($item->degreeId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/degree/' . $item->degreeId) }}">{{ $item->degreeName }}</a>
                                    @elseif(!empty($item->functionalAreaId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/' . $item->functionalAreaId) }}">{{ $item->functionalareaName }}</a>
                                    @elseif(!empty($item->topCourseId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/course/' . $item->topCourseId) }}">{{ $item->courseName }}</a>
                                    @elseif(!empty($item->universityId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/university/' . $item->universityId) }}">{{ $item->universityName }}</a>
                                    @elseif(!empty($item->countryId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/address/' . $item->countryId) }}">{{ $item->countryName }}</a>
                                    @elseif(!empty($item->stateId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/city/' . $item->stateId) }}">{{ $item->stateName }}</a>
                                    @elseif(!empty($item->cityId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/state/' . $item->cityId) }}">{{ $item->cityName }}</a>
                                    @elseif(!empty($item->newsId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/news/' . $item->newsId) }}">{{ $item->newsTopic }}</a>
                                    @elseif(!empty($item->newsTagId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/news-type/' . $item->newsTagId) }}">{{ $item->news_tagsName }}</a>
                                    @elseif(!empty($item->newsTypeId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/' . $item->newsTypeId) }}">{{ $item->news_typesName }}</a>
                                    @elseif(!empty($item->askQuestionId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $item->askQuestionId) }}">{{ str_limit(strip_tags($item->ask_questionsName), 50) }}</a>
                                    @elseif(!empty($item->askTagId))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question-tags/' . $item->askTagId) }}">{{ $item->ask_question_tagsName }}</a>
                                    @else
                                        --
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($item->eUserId)
                            <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                            @else
                                <span class="label label-warning">Not Updated Yet</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id) }}" title="View Seo Content"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id . '/edit') }}" title="Edit Seo Content"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    @endif
                                @else
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id . '/edit') }}" title="Edit Seo Content"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $seocontent->appends(\Input::except('page'))->render() !!} </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection