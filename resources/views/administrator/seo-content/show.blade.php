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
    <div class="col-lg-1">
       <!--  <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/') }}" class="btn btn-warning btn-sm" title="Seo Content"><i class="fa fa-arrow-left"></i> Back</a> -->
        <a href="{{ URL::previous() }}" class="btn btn-warning btn-sm" title="Seo Content"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    <div class="col-lg-1">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $seocontent->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $seocontent->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
            @endif
        @endif
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ $seocontent->id }}</th>
                                </tr>
                                <tr>
                                    <th> Page Title </th>
                                    <td> {{ $seocontent->pagetitle }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {{ strip_tags($seocontent->SEODescription) }} </td>
                                </tr>
                                <tr>
                                    <th> H1 Title </th>
                                    <td> {{ $seocontent->h1title }} </td>
                                </tr>
                                <tr>
                                    <th> Meta Keyword </th>
                                    <td> {{ $seocontent->keyword }}</td>
                                </tr>
                                 <tr>
                                    <th> H2 Title </th>
                                    <td> {{ $seocontent->h2title }} </td>
                                </tr>
                                 <tr>
                                    <th> H3 Title </th>
                                    <td> {{ $seocontent->h3title }} </td>
                                </tr>
                                 <tr>
                                    <th> Canonical </th>
                                    <td> {{ $seocontent->canonical }} </td>
                                </tr>
                                 <tr>
                                    <th> SEO Image </th>
                                    <td> 
                                        @if($seocontent->image != '')
                                            <img class="img-thumbnail img-responsive" src="{{ asset('seo-content') }}/{{ $seocontent->image }}" style="width: 160px; height: 160px; ">
                                        @else

                                            <img  class="img-responsive margin-top15"  id="uploadImage" src="/assets/images/no-college-logo.jpg" alt="your image" style="width: 200px; height: 160px; "/>
                                        @endif
                                    </td>
                                </tr>
                                 <tr>
                                    <th> SEO Image alt text</th>
                                    <td> {{ $seocontent->imagealttext }} </td>
                                </tr>
                                <tr>
                                    <th> SEO Image Description </th>
                                    <td> {{ strip_tags($seocontent->content) }} </td>
                                </tr>
                                <tr>
                                    <th> MISC </th>
                                    <td> {{ $seocontent->misc }}</td>
                                </tr>
                                <tr>
                                    <th>SEO On Page</th>
                                    <td>
                                        @if(Auth::check())
                                            @if(Auth::user()->userrole_id == 4)
                                                @if(!empty($seocontent->pageId))
                                                    {{ $seocontent->contentcategoryName }}
                                                @elseif(!empty($seocontent->userId))
                                                    {{ $seocontent->studentName }}
                                                @elseif(!empty($seocontent->collegeId))
                                                    {{ $seocontent->collegeName }}
                                                @elseif(!empty($seocontent->examId))
                                                    {{ $seocontent->sortname }}
                                                @elseif(!empty($seocontent->boardId))
                                                    {{ $seocontent->counseling_boardsName }}
                                                @elseif(!empty($seocontent->careerReleventId))
                                                    {{ $seocontent->careerRelevantsTitle }}
                                                @elseif(!empty($seocontent->popularCareerId))
                                                    {{ $seocontent->popularCareerTitle }}
                                                @elseif(!empty($seocontent->courseId))
                                                    {{ $seocontent->careerCourseTitle }}
                                                @elseif(!empty($seocontent->blogId))
                                                    {{ $seocontent->topic }}
                                                @elseif(!empty($seocontent->examSectionId))
                                                    {{ $seocontent->exam_sectionsName }}
                                                @elseif(!empty($seocontent->educationLevelId))
                                                    {{ $seocontent->educationlevelName }}
                                                @elseif(!empty($seocontent->degreeId))
                                                    {{ $seocontent->degreeName }}
                                                @elseif(!empty($seocontent->functionalAreaId))
                                                    {{ $seocontent->functionalareaName }}
                                                @elseif(!empty($seocontent->topCourseId))
                                                    {{ $seocontent->courseName }}
                                                @elseif(!empty($seocontent->universityId))
                                                    {{ $seocontent->universityName }}
                                                @elseif(!empty($seocontent->countryId))
                                                    {{ $seocontent->countryName }}
                                                @elseif(!empty($seocontent->stateId))
                                                    {{ $seocontent->stateName }}
                                                @elseif(!empty($seocontent->cityId))
                                                    {{ $seocontent->cityName }}
                                                @elseif(!empty($seocontent->newsId))
                                                    {{ $seocontent->newsTopic }}
                                                @elseif(!empty($seocontent->newsTagId))
                                                    {{ $seocontent->news_tagsName }}
                                                @elseif(!empty($seocontent->newsTypeId))
                                                    {{ $seocontent->news_typesName }}
                                                @elseif(!empty($seocontent->askQuestionId))
                                                    {{ str_limit(strip_tags($seocontent->ask_questionsName), 50) }}
                                                @elseif(!empty($seocontent->askTagId))
                                                    {{ $seocontent->ask_question_tagsName }}
                                                @else
                                                    --
                                                @endif
                                            @else
                                                @if(!empty($seocontent->pageId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $seocontent->pageId) }}">{{ $seocontent->contentcategoryName }}</a>
                                                @elseif(!empty($seocontent->userId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/studentprofile/' . $seocontent->userId) }}">{{ $seocontent->studentName }}</a>
                                                @elseif(!empty($seocontent->collegeId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $seocontent->collegeId) }}">{{ $seocontent->collegeName }}</a>
                                                @elseif(!empty($seocontent->examId))
                                                    <a href="{{ url('/examination/type-of-examination/' . $seocontent->examId) }}">{{ $seocontent->sortname }}</a>
                                                @elseif(!empty($seocontent->boardId))
                                                    <a href="{{ url('/counseling/counseling-boards/' . $seocontent->boardId) }}">{{ $seocontent->counseling_boardsName }}</a>
                                                @elseif(!empty($seocontent->careerReleventId))
                                                    <a href="{{ url('/counseling/counseling-career-relevant/' . $seocontent->careerReleventId) }}">{{ $seocontent->careerRelevantsTitle }}</a>
                                                @elseif(!empty($seocontent->popularCareerId))
                                                    <a href="{{ url('/counseling/counseling-career-details/' . $seocontent->popularCareerId) }}">{{ $seocontent->popularCareerTitle }}</a>
                                                @elseif(!empty($seocontent->courseId))
                                                    <a href="{{ url('/counseling/counseling-courses-details/' . $seocontent->courseId) }}">{{ $seocontent->careerCourseTitle }}</a>
                                                @elseif(!empty($seocontent->blogId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/blogs/' . $seocontent->blogId) }}">{{ $seocontent->topic }}</a>
                                                @elseif(!empty($seocontent->examSectionId))
                                                    <a href="{{ url('/examination/exam-section/' . $seocontent->examSectionId) }}">{{ $seocontent->exam_sectionsName }}</a>
                                                @elseif(!empty($seocontent->educationLevelId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/educationlevel/' . $seocontent->educationLevelId) }}">{{ $seocontent->educationlevelName }}</a>
                                                @elseif(!empty($seocontent->degreeId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/degree/' . $seocontent->degreeId) }}">{{ $seocontent->degreeName }}</a>
                                                @elseif(!empty($seocontent->functionalAreaId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/' . $seocontent->functionalAreaId) }}">{{ $seocontent->functionalareaName }}</a>
                                                @elseif(!empty($seocontent->topCourseId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/course/' . $seocontent->topCourseId) }}">{{ $seocontent->courseName }}</a>
                                                @elseif(!empty($seocontent->universityId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/university/' . $seocontent->universityId) }}">{{ $seocontent->universityName }}</a>
                                                @elseif(!empty($seocontent->countryId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/address/' . $seocontent->countryId) }}">{{ $seocontent->countryName }}</a>
                                                @elseif(!empty($seocontent->stateId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/city/' . $seocontent->stateId) }}">{{ $seocontent->stateName }}</a>
                                                @elseif(!empty($seocontent->cityId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/state/' . $seocontent->cityId) }}">{{ $seocontent->cityName }}</a>
                                                @elseif(!empty($seocontent->newsId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/news/' . $seocontent->newsId) }}">{{ $seocontent->newsTopic }}</a>
                                                @elseif(!empty($seocontent->newsTagId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/news-type/' . $seocontent->newsTagId) }}">{{ $seocontent->news_tagsName }}</a>
                                                @elseif(!empty($seocontent->newsTypeId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/' . $seocontent->newsTypeId) }}">{{ $seocontent->news_typesName }}</a>
                                                @elseif(!empty($seocontent->askQuestionId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $seocontent->askQuestionId) }}">{!! $seocontent->ask_questionsName !!}</a>
                                                @elseif(!empty($seocontent->askTagId))
                                                    <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question-tags/' . $seocontent->askTagId) }}">{{ $seocontent->ask_question_tagsName }}</a>
                                                @else
                                                    --
                                                @endif
                                            @endif
                                        @endif
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>Last Updated By</th>
                                    <td>
                                        @if($seocontent->eUserId)
                                        <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $seocontent->eUserId) }}" @endif>{{ $seocontent->employeeFirstname }} {{ $seocontent->employeeMiddlename}} {{ $seocontent->employeeLastname}} (ID:- {{ $seocontent->eUserId}}) <hr> Date & Time:- {{ $seocontent->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection