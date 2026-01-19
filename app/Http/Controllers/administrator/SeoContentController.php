<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SeoContent;
use Illuminate\Http\Request;
use Session;
use App\Models\Country as Country;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
use Excel;
use Config;
use PHPMailer;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Http\Controllers\Helper\FetchDataServiceController;

class SeoContentController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = SeoContent::orderBy('seo_contents.id' ,'DESC')
            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
            ->leftJoin('contentcategory', 'seo_contents.pageId', '=', 'contentcategory.id')
            ->leftJoin('studentprofile', 'seo_contents.userId', '=', 'studentprofile.id')
            ->leftJoin('users as studentUser','studentprofile.users_id', '=','studentUser.id')
            ->leftJoin('collegeprofile', 'seo_contents.collegeId', '=', 'collegeprofile.id')
            ->leftJoin('users as collegeUser','collegeprofile.users_id', '=','collegeUser.id')
            ->leftJoin('type_of_examinations', 'seo_contents.examId', '=', 'type_of_examinations.id')
            ->leftJoin('counseling_boards', 'seo_contents.boardId', '=', 'counseling_boards.id')
            ->leftJoin('counseling_career_relevants', 'seo_contents.careerReleventId', '=', 'counseling_career_relevants.id')
            ->leftJoin('counseling_career_details', 'seo_contents.popularCareerId', '=', 'counseling_career_details.id')
            ->leftJoin('counseling_courses_details', 'seo_contents.courseId', '=', 'counseling_courses_details.id')
            ->leftJoin('blogs', 'seo_contents.blogId', '=', 'blogs.id')
            ->leftJoin('exam_sections', 'seo_contents.examSectionId', '=', 'exam_sections.id')
            ->leftJoin('educationlevel', 'seo_contents.educationLevelId', '=', 'educationlevel.id')
            ->leftJoin('degree', 'seo_contents.degreeId', '=', 'degree.id')
            ->leftJoin('functionalarea', 'seo_contents.functionalAreaId', '=', 'functionalarea.id')
            ->leftJoin('course', 'seo_contents.topCourseId', '=', 'course.id')
            ->leftJoin('university', 'seo_contents.universityId', '=', 'university.id')
            ->leftJoin('country', 'seo_contents.countryId', '=', 'country.id')
            ->leftJoin('state', 'seo_contents.stateId', '=', 'state.id')
            ->leftJoin('city', 'seo_contents.cityId', '=', 'city.id')
            ->leftJoin('news', 'seo_contents.newsId', '=', 'news.id')
            ->leftJoin('news_tags', 'seo_contents.newsTagId', '=', 'news_tags.id')
            ->leftJoin('news_types', 'seo_contents.newsTypeId', '=', 'news_types.id')
            ->leftJoin('ask_questions', 'seo_contents.askQuestionId', '=', 'ask_questions.id')
            ->leftJoin('ask_question_tags', 'seo_contents.askTagId', '=', 'ask_question_tags.id');

            if (!empty($keyword)) {
                $query->where('seo_contents.pagetitle', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.description', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.keyword', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.misc', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.slugurl', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.h1title', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.h2title', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.h3title', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.canonical', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.imagealttext', 'LIKE', "%$keyword%");
                $query->orWhere('seo_contents.content', 'LIKE', "%$keyword%");
                $query->orWhere('studentUser.firstname', 'LIKE', "%$keyword%");
                $query->orWhere('collegeUser.firstname', 'LIKE', "%$keyword%");
                $query->orWhere('contentcategory.name', 'LIKE', "%$keyword%");
                $query->orWhere('type_of_examinations.sortname', 'LIKE', "%$keyword%");
                $query->orWhere('counseling_boards.name', 'LIKE', "%$keyword%");
                $query->orWhere('counseling_career_relevants.title', 'LIKE', "%$keyword%");
                $query->orWhere('counseling_career_details.title', 'LIKE', "%$keyword%");
                $query->orWhere('counseling_courses_details.title', 'LIKE', "%$keyword%");
                $query->orWhere('blogs.topic', 'LIKE', "%$keyword%");
                $query->orWhere('exam_sections.name', 'LIKE', "%$keyword%");
                $query->orWhere('educationlevel.name', 'LIKE', "%$keyword%");
                $query->orWhere('degree.name', 'LIKE', "%$keyword%");
                $query->orWhere('functionalarea.name', 'LIKE', "%$keyword%");
                $query->orWhere('course.name', 'LIKE', "%$keyword%");
                $query->orWhere('university.name', 'LIKE', "%$keyword%");
                $query->orWhere('country.name', 'LIKE', "%$keyword%");
                $query->orWhere('state.name', 'LIKE', "%$keyword%");
                $query->orWhere('city.name', 'LIKE', "%$keyword%");
                $query->orWhere('news.topic', 'LIKE', "%$keyword%");
                $query->orWhere('news_tags.name', 'LIKE', "%$keyword%");
                $query->orWhere('news_types.name', 'LIKE', "%$keyword%");
                $query->orWhere('ask_questions.question', 'LIKE', "%$keyword%");
                $query->orWhere('ask_question_tags.name', 'LIKE', "%$keyword%");
            }

            if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
                $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
            }

            if ($request->has('keyword') && !empty(Input::get('keyword'))) {
                $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
            }

            if ($request->has('h1title') && !empty(Input::get('h1title'))) {
                $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
            }

        $seocontent  = $query->paginate(50, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.educationLevelId','seo_contents.degreeId','seo_contents.functionalAreaId','seo_contents.topCourseId','seo_contents.universityId','seo_contents.countryId','seo_contents.stateId','seo_contents.cityId','seo_contents.newsId','seo_contents.newsTagId','seo_contents.newsTypeId','seo_contents.askQuestionId','seo_contents.askTagId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','contentcategory.name as contentcategoryName','studentUser.firstname as studentName','collegeUser.firstname as collegeName','type_of_examinations.sortname','counseling_boards.name as counseling_boardsName','counseling_career_relevants.title as careerRelevantsTitle','counseling_career_details.title as popularCareerTitle','counseling_courses_details.title as careerCourseTitle','blogs.topic','exam_sections.name as exam_sectionsName','educationlevel.name as educationlevelName','degree.name as degreeName','functionalarea.name as functionalareaName','course.name as courseName','university.name as universityName','country.name as countryName','state.name as stateName','city.name as cityName','news.topic as newsTopic','news_tags.name as news_tagsName','news_types.name as news_typesName','ask_questions.question as ask_questionsName','ask_question_tags.name as ask_question_tagsName'));

        return view('administrator.seo-content.index', compact('seocontent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        return redirect::back();
        return view('administrator.seo-content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $seoContentCreateObj = New SeoContent();
        $seoContentCreateObj->pagetitle = Input::get('pagetitle');
        $seoContentCreateObj->description = Input::get('description');
        if (!empty(Input::get('keyword'))) {
            $seoContentCreateObj->keyword = Input::get('keyword');
        }else{
            $seoContentCreateObj->keyword = Input::get('pagetitle');
        }

        if (!empty(Input::get('h1title'))) {
            $seoContentCreateObj->h1title = Input::get('h1title');
        }else{
            $seoContentCreateObj->h1title = Input::get('pagetitle');
        }

        if (!empty(Input::get('h2title'))) {
            $seoContentCreateObj->h2title = Input::get('h2title');
        }else{
            $seoContentCreateObj->h2title = Input::get('pagetitle');
        }

        if (!empty(Input::get('h3title'))) {
            $seoContentCreateObj->h3title = Input::get('h3title');
        }else{
            $seoContentCreateObj->h3title = Input::get('pagetitle');
        }

        if (!empty(Input::get('imagealttext'))) {
            $seoContentCreateObj->imagealttext = Input::get('imagealttext');
        }else{
            $seoContentCreateObj->imagealttext = Input::get('pagetitle');
        }

        $seoContentCreateObj->content = Input::get('content');
        $seoContentCreateObj->canonical = Input::get('canonical');
        $seoContentCreateObj->misc = str_slug(Input::get('pagetitle'), "-");
        $seoContentCreateObj->save();

        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('pagetitle').' '.$seoContentCreateObj->id);
        $slugUrl = strtolower($slugUrl);
        $seoContentCreateObj->slugurl = $slugUrl;
        $seoContentCreateObj->employee_id = Auth::id();
        $seoContentCreateObj->save();

        if($request->file('image')){
            $fileName1 = $seoContentCreateObj->slugurl.'-first-'.$seoContentCreateObj->id.".".$request->image->getClientOriginalExtension();
    
            $request->image->move(public_path('seo-content/'), $fileName1);

            DB::table('seo_contents')->where('seo_contents.id', '=', $seoContentCreateObj->id)->update(array('seo_contents.image' => $fileName1));
        }

        Session::flash('flash_message', 'Seo Content added!');

        return redirect($this->fetchDataServiceController->routeCall().'/seo-content');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
            ->leftJoin('contentcategory', 'seo_contents.pageId', '=', 'contentcategory.id')
            ->leftJoin('studentprofile', 'seo_contents.userId', '=', 'studentprofile.id')
            ->leftJoin('users as studentUser','studentprofile.users_id', '=','studentUser.id')
            ->leftJoin('collegeprofile', 'seo_contents.collegeId', '=', 'collegeprofile.id')
            ->leftJoin('users as collegeUser','collegeprofile.users_id', '=','collegeUser.id')
            ->leftJoin('type_of_examinations', 'seo_contents.examId', '=', 'type_of_examinations.id')
            ->leftJoin('counseling_boards', 'seo_contents.boardId', '=', 'counseling_boards.id')
            ->leftJoin('counseling_career_relevants', 'seo_contents.careerReleventId', '=', 'counseling_career_relevants.id')
            ->leftJoin('counseling_career_details', 'seo_contents.popularCareerId', '=', 'counseling_career_details.id')
            ->leftJoin('counseling_courses_details', 'seo_contents.courseId', '=', 'counseling_courses_details.id')
            ->leftJoin('blogs', 'seo_contents.blogId', '=', 'blogs.id')
            ->leftJoin('exam_sections', 'seo_contents.examSectionId', '=', 'exam_sections.id')
            ->leftJoin('educationlevel', 'seo_contents.educationLevelId', '=', 'educationlevel.id')
            ->leftJoin('degree', 'seo_contents.degreeId', '=', 'degree.id')
            ->leftJoin('functionalarea', 'seo_contents.functionalAreaId', '=', 'functionalarea.id')
            ->leftJoin('course', 'seo_contents.topCourseId', '=', 'course.id')
            ->leftJoin('university', 'seo_contents.universityId', '=', 'university.id')
            ->leftJoin('country', 'seo_contents.countryId', '=', 'country.id')
            ->leftJoin('state', 'seo_contents.stateId', '=', 'state.id')
            ->leftJoin('city', 'seo_contents.cityId', '=', 'city.id')
            ->leftJoin('news', 'seo_contents.newsId', '=', 'news.id')
            ->leftJoin('news_tags', 'seo_contents.newsTagId', '=', 'news_tags.id')
            ->leftJoin('news_types', 'seo_contents.newsTypeId', '=', 'news_types.id')
            ->leftJoin('ask_questions', 'seo_contents.askQuestionId', '=', 'ask_questions.id')
            ->leftJoin('ask_question_tags', 'seo_contents.askTagId', '=', 'ask_question_tags.id')
            ->findOrFail($id, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.educationLevelId','seo_contents.degreeId','seo_contents.functionalAreaId','seo_contents.topCourseId','seo_contents.universityId','seo_contents.countryId','seo_contents.stateId','seo_contents.cityId','seo_contents.newsId','seo_contents.newsTagId','seo_contents.newsTypeId','seo_contents.askQuestionId','seo_contents.askTagId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','contentcategory.name as contentcategoryName','studentUser.firstname as studentName','collegeUser.firstname as collegeName','type_of_examinations.sortname','counseling_boards.name as counseling_boardsName','counseling_career_relevants.title as careerRelevantsTitle','counseling_career_details.title as popularCareerTitle','counseling_courses_details.title as careerCourseTitle','blogs.topic','exam_sections.name as exam_sectionsName','educationlevel.name as educationlevelName','degree.name as degreeName','functionalarea.name as functionalareaName','course.name as courseName','university.name as universityName','country.name as countryName','state.name as stateName','city.name as cityName','news.topic as newsTopic','news_tags.name as news_tagsName','news_types.name as news_typesName','ask_questions.question as ask_questionsName','ask_question_tags.name as ask_question_tagsName'));

        return view('administrator.seo-content.show', compact('seocontent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $seocontent = SeoContent::findOrFail($id);

        return view('administrator.seo-content.edit', compact('seocontent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $setSlug = SeoContent::where('id', '=', $id)->firstOrFail();
        $seoContentUpdateObj = SeoContent::findOrFail($id);
        $seoContentUpdateObj->pagetitle = Input::get('pagetitle');
        $seoContentUpdateObj->description = Input::get('description');
        if (!empty(Input::get('keyword'))) {
            $seoContentUpdateObj->keyword = Input::get('keyword');
        }else{
            $seoContentUpdateObj->keyword = Input::get('pagetitle');
        }

        if (!empty(Input::get('h1title'))) {
            $seoContentUpdateObj->h1title = Input::get('h1title');
        }else{
            $seoContentUpdateObj->h1title = Input::get('pagetitle');
        }

        if (!empty(Input::get('h2title'))) {
            $seoContentUpdateObj->h2title = Input::get('h2title');
        }else{
            $seoContentUpdateObj->h2title = Input::get('pagetitle');
        }

        if (!empty(Input::get('h3title'))) {
            $seoContentUpdateObj->h3title = Input::get('h3title');
        }else{
            $seoContentUpdateObj->h3title = Input::get('pagetitle');
        }
        $seoContentUpdateObj->imagealttext = Input::get('imagealttext');
        $seoContentUpdateObj->content = Input::get('content');
        $seoContentUpdateObj->canonical = Input::get('canonical');
        //$seoContentUpdateObj->misc = str_slug(Input::get('pagetitle'), "-");
        //$seoContentUpdateObj->slugurl = str_slug(Input::get('pagetitle'), "-");

        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('pagetitle').' '.$id);
        $slugUrl = strtolower($slugUrl);

        if($request->file('image')){
            $fileName1 = $slugUrl.'-first-'.$id.".".$request->image->getClientOriginalExtension();
    
            $request->image->move(public_path('seo-content/'), $fileName1);

            DB::table('seo_contents')->where('seo_contents.id', '=', $id)->update(array('seo_contents.image' => $fileName1));
        }

        $seoContentUpdateObj->slugurl = $slugUrl;
        $seoContentUpdateObj->employee_id = Auth::id();
        $seoContentUpdateObj->save();

        Session::flash('flash_message', 'Seo Content updated!');

        return redirect($this->fetchDataServiceController->routeCall().'/seo-content/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        SeoContent::destroy($id);

        Session::flash('flash_message', 'Seo Content deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/seo-content');
    }

    public function customSeoContent(Request $request)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.pageId', '=', NULL);
        $query->where('seo_contents.userId', '=', NULL);
        $query->where('seo_contents.collegeId', '=', NULL);
        $query->where('seo_contents.examId', '=', NULL);
        $query->where('seo_contents.boardId', '=', NULL);
        $query->where('seo_contents.careerReleventId', '=', NULL);
        $query->where('seo_contents.popularCareerId', '=', NULL);
        $query->where('seo_contents.courseId', '=', NULL);
        $query->where('seo_contents.blogId', '=', NULL);
        $query->where('seo_contents.examSectionId', '=', NULL);
        $query->where('seo_contents.educationLevelId', '=', NULL);
        $query->where('seo_contents.degreeId', '=', NULL);
        $query->where('seo_contents.functionalAreaId', '=', NULL);
        $query->where('seo_contents.topCourseId', '=', NULL);
        $query->where('seo_contents.universityId', '=', NULL);
        $query->where('seo_contents.countryId', '=', NULL);
        $query->where('seo_contents.stateId', '=', NULL);
        $query->where('seo_contents.cityId', '=', NULL);
        $query->where('seo_contents.newsId', '=', NULL);
        $query->where('seo_contents.newsTagId', '=', NULL);
        $query->where('seo_contents.newsTypeId', '=', NULL);
        $query->where('seo_contents.askQuestionId', '=', NULL);
        $query->where('seo_contents.askTagId', '=', NULL);

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.educationLevelId','seo_contents.degreeId','seo_contents.functionalAreaId','seo_contents.topCourseId','seo_contents.universityId','seo_contents.countryId','seo_contents.stateId','seo_contents.cityId','seo_contents.newsId','seo_contents.newsTagId','seo_contents.newsTypeId','seo_contents.askQuestionId','seo_contents.askTagId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at'));

        return view('/administrator/seo-content.partials.custom-seo-content' , compact('seocontent'));
    }

    public function dynamicSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $contentcategoryObj = DB::table('contentcategory')->get();
        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('contentcategory', 'seo_contents.pageId', '=', 'contentcategory.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        if ($request->has('contentcategory_id')) {
            $query->where('contentcategory.id', '=',Input::get('contentcategory_id'));
        }
        
        $query->where('seo_contents.pageId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','contentcategory.name as contentcategoryName'));

        return view('/administrator/seo-content.partials.dynamic-seo-content' , compact('seocontent', 'contentcategoryObj'));
    }

    public function studentProfileSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $studentProfileObj = DB::table('seo_contents')
                                ->join('studentprofile', 'seo_contents.userId', '=', 'studentprofile.id')
                                ->join('users', 'studentprofile.users_id', '=', 'users.id')
                                ->select('studentprofile.id as studentprofileID', 'users.id as userID','users.firstname')
                                ->where('users.userrole_id', '=', '3')
                                ->where('users.userstatus_id','!=','5')
                                ->get();

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('studentprofile', 'seo_contents.userId', '=', 'studentprofile.id')
                ->leftJoin('users as studentUser','studentprofile.users_id', '=','studentUser.id')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id');


        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        if ($request->has('userId')) {
            $query->where('seo_contents.userId', '=', Input::get('userId'));
        }

        $query->where('seo_contents.userId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','studentUser.firstname as studentName'));

        return view('/administrator/seo-content.partials.student-profile-seo-content' , compact('seocontent','studentProfileObj'));
    }


    public function collegeProfileSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegeProfileObj = DB::table('seo_contents')
                                ->leftJoin('collegeprofile', 'seo_contents.collegeId', '=', 'collegeprofile.id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->where('users.userrole_id', '=', '2')
                                ->where('users.userstatus_id','!=','5')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                ->get()
                                ;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('collegeprofile', 'seo_contents.collegeId', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser','collegeprofile.users_id', '=','collegeUser.id')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id');


        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        if ($request->has('collegeId')) {
            $query->where('seo_contents.collegeId', '=', Input::get('collegeId'));
        }

        $query->where('seo_contents.collegeId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','collegeUser.firstname as collegeName'));

        return view('/administrator/seo-content.partials.college-profile-seo-content' , compact('seocontent','collegeProfileObj'));
    }

    public function examinationSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->join('type_of_examinations', 'seo_contents.examId', '=', 'type_of_examinations.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.examId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','type_of_examinations.sortname'));


        return view('/administrator/seo-content.partials.examination-seo-content' , compact('seocontent'));
    }

    public function boardSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->join('counseling_boards', 'seo_contents.boardId', '=', 'counseling_boards.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.boardId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','counseling_boards.name as counseling_boardsName'));


        return view('/administrator/seo-content.partials.board-details-seo-content' , compact('seocontent'));
    }

    public function careerReleventSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('counseling_career_relevants', 'seo_contents.careerReleventId', '=', 'counseling_career_relevants.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.careerReleventId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','counseling_career_relevants.title as careerRelevantsTitle'));

        return view('/administrator/seo-content.partials.career-relevent-seo-content' , compact('seocontent'));
    }

    public function popularCareerSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('counseling_career_details', 'seo_contents.popularCareerId', '=', 'counseling_career_details.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.popularCareerId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','counseling_career_details.title as popularCareerTitle'));

        return view('/administrator/seo-content.partials.popular-career-seo-content' , compact('seocontent'));
    }


    public function courseDetailsSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('counseling_courses_details', 'seo_contents.courseId', '=', 'counseling_courses_details.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.courseId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','counseling_courses_details.title as careerCourseTitle'));

        return view('/administrator/seo-content.partials.course-details-seo-content' , compact('seocontent'));
    }

    public function blogSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $blogsObj = DB::table('blogs')->get();
        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('blogs', 'seo_contents.blogId', '=', 'blogs.id')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        if ($request->has('blogid')) {
            $query->where('blogs.id', '=',Input::get('blogid'));
        }
        
        $query->where('seo_contents.blogId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','blogs.id as blogsId','blogs.topic'));

        return view('/administrator/seo-content.partials.blog-seo-content' , compact('seocontent', 'blogsObj'));
    }

    public function examSectionSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
            ->leftJoin('exam_sections', 'seo_contents.examSectionId', '=', 'exam_sections.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.examSectionId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','exam_sections.name as exam_sectionsName'));

        return view('/administrator/seo-content.partials.exam-section-seo-content' , compact('seocontent'));
    }

    public function educationLevelSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
            ->leftJoin('educationlevel', 'seo_contents.educationLevelId', '=', 'educationlevel.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.educationLevelId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','educationlevel.name as educationlevelName','educationLevelId'));

        return view('/administrator/seo-content.partials.education-level-seo-content' , compact('seocontent'));
    }

    public function degreeSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
            ->leftJoin('degree', 'seo_contents.degreeId', '=', 'degree.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.degreeId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','degree.name as degreeName','degreeId'));

        return view('/administrator/seo-content.partials.degree-seo-content' , compact('seocontent'));
    }

    public function functionalareaSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
            ->leftJoin('functionalarea', 'seo_contents.functionalAreaId', '=', 'functionalarea.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.functionalAreaId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','functionalarea.name as functionalareaName','functionalAreaId'));

        return view('/administrator/seo-content.partials.functionalarea-seo-content' , compact('seocontent'));
    }

    public function coursesSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
            ->leftJoin('course', 'seo_contents.topCourseId', '=', 'course.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.topCourseId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','course.name as courseName','topCourseId'));

        return view('/administrator/seo-content.partials.course-seo-content' , compact('seocontent'));
    }

    public function universitySeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('university', 'seo_contents.universityId', '=', 'university.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.universityId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','university.name as universityName','universityId'));

        return view('/administrator/seo-content.partials.university-seo-content' , compact('seocontent'));
    }

    public function countrySeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('country', 'seo_contents.countryId', '=', 'country.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.countryId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','country.name as countryName','countryId'));

        return view('/administrator/seo-content.partials.country-seo-content' , compact('seocontent'));
    }

    public function stateSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
            ->leftJoin('state', 'seo_contents.stateId', '=', 'state.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.stateId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','state.name as stateName','stateId'));

        return view('/administrator/seo-content.partials.state-seo-content' , compact('seocontent'));
    }

    public function citySeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('city', 'seo_contents.cityId', '=', 'city.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.cityId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','city.name as cityName','cityId'));

        return view('/administrator/seo-content.partials.city-seo-content' , compact('seocontent'));
    }

    public function newsSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('news', 'seo_contents.newsId', '=', 'news.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.newsId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','news.topic as newsName','newsId'));

        return view('/administrator/seo-content.partials.news-seo-content' , compact('seocontent'));
    }

    public function newsTagsSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('news_tags', 'seo_contents.newsTagId', '=', 'news_tags.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.newsTagId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','news_tags.name as news_tagsName','newsTagId'));

        return view('/administrator/seo-content.partials.news-tags-seo-content' , compact('seocontent'));
    }

    public function newsTypeSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('news_types', 'seo_contents.newsTypeId', '=', 'news_types.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.newsTypeId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','news_types.name as news_typesName','newsTypeId'));

        return view('/administrator/seo-content.partials.news-type-seo-content' , compact('seocontent'));
    }

    public function askQuestionSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('ask_questions', 'seo_contents.askQuestionId', '=', 'ask_questions.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.askQuestionId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','ask_questions.question as ask_questionsName','askQuestionId'));

        return view('/administrator/seo-content.partials.ask-questions-seo-content' , compact('seocontent'));
    }

    public function askQuestionTagsSeoContent(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SeoContent');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
        
        $query = SeoContent::orderBy('seo_contents.id', 'ASC')
                ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                ->leftJoin('ask_question_tags', 'seo_contents.askTagId', '=', 'ask_question_tags.id');

        if ($request->has('pagetitle') && !empty(Input::get('pagetitle'))) {
            $query->where('seo_contents.pagetitle', 'LIKE', '%' . Input::get('pagetitle') . '%');
        }

        if ($request->has('keyword') && !empty(Input::get('keyword'))) {
            $query->where('seo_contents.keyword', 'LIKE', '%' . Input::get('keyword') . '%');
        }

        if ($request->has('h1title') && !empty(Input::get('h1title'))) {
            $query->where('seo_contents.h1title', 'LIKE', '%' . Input::get('h1title') . '%');
        }

        $query->where('seo_contents.askTagId', '!=', '');

        $seocontent = $query->paginate(20, array('seo_contents.id','seo_contents.pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','ask_question_tags.name as ask_question_tagsName','askTagId'));

        return view('/administrator/seo-content.partials.ask-question-tags-seo-content' , compact('seocontent'));
    }
}
