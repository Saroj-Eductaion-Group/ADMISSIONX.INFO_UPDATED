<?php

namespace App\Http\Controllers\website;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Session;
use Mailchimp;
use DateTime;
use Cache;
use Artisan;
use Config;
use URL;
use App\Models\Subscribe;
use App\Models\FunctionalArea;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\UserRole;
use App\Models\UserStatus;
use App\User as User;
use App\Models\StudentProfile as StudentProfile;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\CollegeType as CollegeType;
use App\Models\Address as Address;
use App\Models\Gallery as Gallery;
use App\Models\Document as Document;
use App\Models\AddressType as AddressType;
use App\Models\Degree as Degree;
use App\Models\Course as Course;
use App\Models\CourseType as CourseType;
use App\Models\EducationLevel as EducationLevel;
use App\Models\CollegeMaster as CollegeMaster;
use App\Models\ApplicationStatusMessage;
use App\Models\Application;
use App\Models\WhatWeOffer;
use App\Models\ExaminationType;
use App\Models\ApplicationAndExamStatus;
use App\Models\ApplicationMode;
use App\Models\ExaminationMode;
use App\Models\EligibilityCriterion;
use App\Models\ExaminationImportantLink;
use App\Models\ExamSection;
use App\Models\TypeOfExamination;
use App\Models\ExamApplicationProcess;
use App\Models\ExamApplicationFee;
use App\Models\ExamEligibility;
use App\Models\ExamDate;
use App\Models\ExamSyllabusPaper;
use App\Models\ExamSyllabusPaperMark;
use App\Models\ExamPattern;
use App\Models\ExamAdmitCard;
use App\Models\ExamResult;
use App\Models\ExamCutOff;
use App\Models\ExamCounselling;
use App\Models\ExamCounsellingDate;
use App\Models\ExamCounsellingContact;
use App\Models\ExamPreprationTip;
use App\Models\ExamAnalysisRecord;
use App\Models\ExamAnswerKey;
use App\Models\ExamAnswerKeyEvent;
use App\Models\ExamFaq;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionAnswer;
use App\Models\ExamQuestionAnswerComment;
use Jenssegers\Agent\Agent;
use App\Models\CounselingBoardAdmissionDate;
use App\Models\CounselingBoardDetail;
use App\Models\CounselingBoardExamDate;
use App\Models\CounselingBoardHighlight;
use App\Models\CounselingBoardImpDate;
use App\Models\CounselingBoardLatestUpdate;
use App\Models\CounselingBoardSamplePaper;
use App\Models\CounselingBoard;
use App\Models\CounselingBoardSyllabus;
use App\Models\CounselingCareerDetail;
use App\Models\CounselingCareerInterest;
use App\Models\CounselingCareerJobRoleSalery;
use App\Models\CounselingCareerRelevant;
use App\Models\CounselingCareerSkillRequirement;
use App\Models\CounselingCareerWhereToStudy;
use App\Models\CounselingCoursesDetail;
use App\Models\CounselingCoursesJobCareer;
use App\Models\CounselingCoursesMoreDetail;
use App\Models\CounselingCoursesEducationLevel;
use App\Models\SeoContent;
use App\Models\SliderManager;
use App\Models\LatestUpdate;
use App\Http\Controllers\Helper\FetchDataServiceController;
use Illuminate\Database\QueryException as QueryException;

class SearchPageController extends Controller
{
    protected $fetchDataServiceController;
    protected $mailchimp;
    protected $listId = 'bc80df542e';

    public function __construct(Mailchimp $mailchimp, FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
        $this->mailchimp = $mailchimp;
    }

    public function homePageSearchList(Request $request)
    {
        $query = (!empty($request->get('q'))) ? strtolower($request->get('q')) : null;
        if (!isset($query)):
            die('Invalid query.');
        endif;

        $SearchQuery  = DB::table('users')
                    ->leftJoin('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                    ->leftJoin('gallery', 'users.id', '=', 'gallery.users_id')
                    ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                    ->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                    ->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                    ->leftJoin('course', 'collegemaster.course_id', '=', 'course.id')
                    ->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                    ->leftJoin('city', 'address.city_id', '=', 'city.id')
                    ->leftJoin('state', 'city.state_id', '=', 'state.id')
                    ->leftJoin('country', 'state.country_id', '=', 'country.id')
                    ->where('collegeprofile.review', '=', '1')
                    ->where('collegeprofile.verified', '=', '1')
                    ->where('users.userstatus_id', '!=', '5')
                    ->where('gallery.misc', '=', 'college-logo-img')
                    ->whereRaw('(MATCH (users.firstname) AGAINST ("'.$request->get('q').'" IN NATURAL LANGUAGE MODE))');
                    //->orWhere('users.firstname', 'LIKE', '%'.$query.'%');
                    //->whereRaw('users.firstname like "%'.$query.'%"');

        if ($request->has('q') && !empty($request->get('q')) && ($request->get('q') != 'null')) {
                $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                        ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.$request->get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('functionalarea.id', DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                        ->get();

                if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->id))  {
                    $SearchQuery->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->id));
                }else{
                    $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                    ->whereRaw('(MATCH (degree.name) AGAINST ("'.$request->get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('degree.id', DB::raw("GROUP_CONCAT(degree.id) as value"))
                                    ->get();

                    if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->id) ) {
                        $SearchQuery->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->id));
                    }else{
                        $getCoursId = Course::orderBy('course.id', 'ASC')
                                        ->whereRaw('(MATCH (course.name) AGAINST ("'.$request->get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('course.id', DB::raw("GROUP_CONCAT(course.id) as value"))
                                        ->get();

                        if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->id) ) {
                            $SearchQuery->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->id));
                        }                    
                    }
                }

                $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                        ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.$request->get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('educationlevel.id', DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                        ->get();

                if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->id) ) {
                    $SearchQuery->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->id));
                }

                $getCountryId = Country::orderBy('country.id', 'ASC')
                                ->whereRaw('(MATCH (country.name) AGAINST ("'.$request->get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->select('country.id', DB::raw("GROUP_CONCAT(country.id) as value"))
                                ->get();

                if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->id) ) {
                    $SearchQuery->whereIn('country.id', explode(',', $getCountryId[0]->id));
                }else{
                    $getStateId = State::orderBy('state.id', 'ASC')
                                ->whereRaw('(MATCH (state.name) AGAINST ("'.$request->get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->where('state.name', 'not like', '%college%')
                                ->where('state.name', 'not like', '%university%')
                                ->select('state.id', DB::raw("GROUP_CONCAT(state.id) as value"))
                                ->get();

                    if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->id) ) {
                        $SearchQuery->whereIn('state.id', explode(',', $getStateId[0]->id));
                    }else{
                        $getCityId = City::orderBy('city.id', 'ASC')
                                    ->whereRaw('(MATCH (city.name) AGAINST ("'.$request->get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('city.name', 'not like', '%college%')
                                    ->where('city.name', 'not like', '%university%')
                                    ->select('city.id', DB::raw("GROUP_CONCAT(city.id) as value"))
                                    ->get();

                        if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->id) ) {
                            $SearchQuery->whereIn('city.id', explode(',', $getCityId[0]->id));
                        }
                    }
                }
            }
            $databaseCollegeUsersObj = $SearchQuery->select('collegeprofile.id','collegeprofile.slug', 'users.firstname', 'users.lastname', 'gallery.name as galleryName', 'city.name as cityName', 'state.name as stateName','country.name as countryName')
                ->groupBy('collegeprofile.id')
                ->orderBy('collegeprofile.id',DB::raw('RAND()'))
                //->orderBy(DB::raw('RAND()'))
                //->take(10)
                ->get()
                ;
        $status         = true;
        $databaseCollegeUsers  = [];
        $collegelogo    = '';
        foreach ($databaseCollegeUsersObj as $item) {
            if(!empty($item->galleryName)){
                if(file_exists(public_path().'/gallery/'.$item->slug.'/'.$item->galleryName)){
                    $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/gallery/'.$item->slug.'/'.$item->galleryName.'" class="rounded-3x searchimg padding-right5" width="32" height="32">';
                }else{
                    $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/school.png" class="rounded-3x searchimg padding-right5" width="32" height="32">';
                }                          
            }else{
                $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/school.png" class="rounded-3x searchimg padding-right5" width="32" height="32">';
            }

            $collegeUrl = URL::to('/college/'.$item->slug);
            $databaseCollegeUsers[] = array(
                        'id'            => $item->id,
                        'collegeUrl'    => $collegeUrl,
                        'collegelogo'   => $collegelogo,
                        'collegename'   => $item->firstname.' '.$item->lastname,
                        'collegeplace'  => ucfirst($item->cityName).','.ucfirst($item->countryName),
                    );
        }

        $resultCollgeUsers = [];
        foreach ($databaseCollegeUsers as $key => $collegeUser) {
            if(!empty($collegeUser['id'])){
                $resultCollgeUsers[] = $collegeUser;
            }
        }

        $databaseUniversityObj = DB::table('university')
                            ->whereRaw('university.name like "%'.$query.'%"')
                            ->select('id','name','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome')->orderBy(DB::raw('RAND()'))
                            ->groupBy('university.id')
                            //->take(10)
                            ->get();
        $databaseUniversity   = [];
        $universitySection      = '';
        foreach ($databaseUniversityObj as $item) {
            if(!empty($item->logo)){
                $universitySection = '<img style="display: unset !important;width: auto !important;"  src=/common-logo/'.$item->slug.'/'.$item->logo.' class="rounded-3x searchimg" width="32" height="32">';
            }else{
                $universitySection = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/university.png" class="rounded-3x searchimg" width="32" height="32">';
            }
            $universityurl = URL::to('/university/'.$item->pageslug);
            $databaseUniversity[] = array(
                        'id'                => $item->id,
                        'universityurl'     => $universityurl,
                        'universityname'    => $item->name,
                        'logo'              => $universitySection,
                    );
        }
        $resultUniversity = [];
        foreach ($databaseUniversity as $key => $oneUniversity) {
            if(!empty($oneUniversity['id'])){
               $resultUniversity[] = $oneUniversity; 
            }
        }

        // Means no result were found
        if (empty($resultCollgeUsers) && empty($resultUniversity)) {
            $status = false;
        }else{
            $status = true;
        }
        $databaseExaminationObj = DB::table('type_of_examinations')
                            ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                            ->whereRaw('type_of_examinations.name like "%'.$query.'%"')
                            ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','exam_sections.slug as streamSlug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('type_of_examinations.id')
                            ->take(10)
                            ->get()
                            ;
        $databaseExamination = [];
        foreach ($databaseExaminationObj as $item) {
            $examUrl = URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug);
            $databaseExamination[] = array(
                                        'id' => $item->id,
                                        'examUrl' => $examUrl,
                                        'name' => $item->sortname.'-'.$item->name,
                                    );
        }


        $resultExam = [];
        foreach ($databaseExamination as $key => $oneExam) {
            if(!empty($oneExam['id'])){
               $resultExam[] = $oneExam; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam)) {
            $status = false;
        }else{
            $status = true;
        }

        $databasePopularCareerCoursesObj = DB::table('counseling_career_details')
                            ->whereRaw('counseling_career_details.title like "%'.$query.'%"')
                            ->where('counseling_career_details.status', '=', '1')
                            ->where('counseling_career_details.functionalarea_id', '=', null)
                            ->where('counseling_career_details.careerRelevantId', '=', null)
                            ->select('counseling_career_details.id','title', 'image','slug','description')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('counseling_career_details.id')
                            ->take(10)   
                            ->get()
                            ;

        $databasePopularCareerCourses = array();
        foreach ($databasePopularCareerCoursesObj as $item) {
            $careerCoursesUrl = URL::to('/popular-careers/'.$item->slug);
            $databasePopularCareerCourses[] = array(
                        'id' => $item->id,
                        'careerCoursesUrl' => $careerCoursesUrl,
                        'title' => $item->title,
                    );
        }

        $resultPopularCareerCourses = [];
        foreach ($databasePopularCareerCourses as $key => $onePopularCareer) {
            if(!empty($onePopularCareer['id'])){
               $resultPopularCareerCourses[] = $onePopularCareer; 
            }
        }
        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseFuncationalAreaObj = DB::table('functionalarea')
                            ->whereRaw('functionalarea.name like "%'.$query.'%"')
                            ->select('functionalarea.id','name', 'pageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('functionalarea.id')
                            ->take(20)   
                            ->get()
                            ;

        $databaseFuncationalArea = array();
        foreach ($databaseFuncationalAreaObj as $item) {
            $funcationalAreaUrl = URL::to($item->pageslug.'/colleges');
            $databaseFuncationalArea[] = array(
                        'id' => $item->id,
                        'funcationalAreaUrl' => $funcationalAreaUrl,
                        'name' => $item->name,
                    );
        }

        $resultFuncationalArea = [];
        foreach ($databaseFuncationalArea as $key => $oneStream) {
            if(!empty($oneStream['id'])){
               $resultFuncationalArea[] = $oneStream; 
            }
        }
        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseDegreeObj = DB::table('degree')
                            ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                            ->whereRaw('degree.name like "%'.$query.'%"')
                            ->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('degree.id')
                            ->take(20)
                            ->get();

        $databaseDegree = array();
        foreach ($databaseDegreeObj as $item) {
            $degreeUrl = URL::to($item->functionalareapageslug.'/'.$item->pageslug.'/colleges');
            $databaseDegree[] = array(
                        'id' => $item->id,
                        'degreeUrl' => $degreeUrl,
                        'name' => $item->name,
                    );
        }

        $resultDegree = [];
        foreach ($databaseDegree as $key => $oneDegree) {
            if(!empty($oneDegree['id'])){
               $resultDegree[] = $oneDegree; 
            }
        }
        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea) && empty($resultDegree)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseCoursesObj = DB::table('course')
                            ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                            ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                            ->whereRaw('course.name like "%'.$query.'%"')
                            ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('course.id')
                            ->take(10)   
                            ->get()
                            ;

        $databaseCourses = array();
        foreach ($databaseCoursesObj as $item) {
            $coursesUrl = URL::to($item->functionalareapageslug.'/'.$item->degreepageslug.'/'.$item->pageslug.'/colleges');
            $databaseCourses[] = array(
                        'id' => $item->id,
                        'coursesUrl' => $coursesUrl,
                        'name' => $item->name,
                    );
        }

        $resultCourses = [];
        foreach ($databaseCourses as $key => $oneCourse) {
            if(!empty($oneCourse['id'])){
               $resultCourses[] = $oneCourse; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseBlogsObj = DB::table('blogs')
                            ->leftJoin('users', 'blogs.users_id', '=', 'users.id')
                            ->where('blogs.isactive', '=' , "1")
                            ->whereRaw('blogs.topic like "%'.$query.'%"')
                            ->whereRaw('blogs.description like "%'.$query.'%"')
                            ->select('blogs.id', 'blogs.topic', 'blogs.description', 'blogs.featimage', 'users.firstname', 'blogs.slug', 'blogs.created_at as createdDate')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('blogs.id')
                            ->take(10)
                            ->get()
                            ;

        $databaseBlogs = array();
        foreach ($databaseBlogsObj as $item) {
            $databaseBlogs[] = array(
                        'id' => $item->id,
                        'blogUrl' => URL::to('/blogs/'.$item->slug),
                        'topic' => $item->topic,
                        'slug' => $item->slug,
                    );
        }


        $resultBlogs = [];
        foreach ($databaseBlogs as $key => $oneBlog) {
            if(!empty($oneBlog['id'])){
               $resultBlogs[] = $oneBlog; 
            }
        }

        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultBlogs)) {
            $status = false;
        }else{
            $status = true;
        }


        $databaseNewssObj = DB::table('news')
                            ->leftJoin('users', 'news.users_id', '=', 'users.id')
                            ->where('news.isactive', '=' , "1")
                            ->whereRaw('news.topic like "%'.$query.'%"')
                            ->whereRaw('news.description like "%'.$query.'%"')
                            ->select('news.id', 'news.topic', 'news.description', 'news.featimage', 'users.firstname', 'news.slug', 'news.created_at as createdDate')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('news.id')
                            ->take(10)
                            ->get()
                            ;

        $databaseNews = array();
        foreach ($databaseNewssObj as $item) {
            $databaseNews[] = array(
                        'id' => $item->id,
                        'newsUrl' => URL::to('/news/'.$item->slug),
                        'topic' => $item->topic,
                        'slug' => $item->slug,
                    );
        }

        $resultNews = [];
        foreach ($databaseNews as $key => $oneNews) {
            if(!empty($oneNews['id'])){
               $resultNews[] = $oneNews; 
            }
        }

        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultBlogs) && empty($resultNews)) {
            $status = false;
        }else{
            $status = true;
        }


        $databaseAskQuestionObj = DB::table('ask_questions')
                            ->whereRaw('ask_questions.question like "%'.$query.'%"')
                            ->where('ask_questions.status', '=', 1)
                            ->select('ask_questions.id','ask_questions.question','slug','questionDate')
                            ->orderBy('ask_questions.question', 'ASC')
                            ->get();

        $databaseAskQuestion = array();
        foreach ($databaseAskQuestionObj as $item) {
            $askPageUrl = URL::to('/ask/'.$item->slug);
            $databaseAskQuestion[] = array(
                        'id'                => $item->id,
                        'question'          => strip_tags($item->question),
                        'slug'              => $item->slug,
                        'askPageUrl'        => $askPageUrl,
                    );
        }


        $resultAskQuestion = [];
        foreach ($databaseAskQuestion as $key => $oneExamSec) {
            if(!empty($oneExamSec['id'])){
               $resultAskQuestion[] = $oneExamSec; 
            }
        }

        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultBlogs) && empty($resultNews) && empty($resultAskQuestion)) {
            $status = false;
        }else{
            $status = true;
        }

        $getCountryList = DB::table('country')
                ->whereRaw('country.name like "%'.$query.'%"')
                ->select('country.id','name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress')
                ->groupBy('country.id')
                ->orderBy('country.name', 'ASC')
                ->get();


        $databaseCountry = array();
        foreach ($getCountryList as $item) {
            $countryCollegePageUrl = URL::to('/'.$item->pageslug.'/college-list');
            $countryStatePageUrl = URL::to('/study-abroad/'.$item->pageslug);
            $databaseCountry[] = array(
                        'id'                        => $item->id,
                        'countryname'               => strip_tags($item->name),
                        'slug'                      => $item->pageslug,
                        'countryCollegePageUrl'     => $countryCollegePageUrl,
                        'countryStatePageUrl'       => $countryStatePageUrl,

                    );
        }


        $resultCountry = [];
        foreach ($databaseCountry as $key => $oneCountry) {
            if(!empty($oneCountry['id'])){
               $resultCountry[] = $oneCountry; 
            }
        }

        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultBlogs) && empty($resultNews) && empty($resultAskQuestion) && empty($resultCountry)) {
            $status = false;
        }else{
            $status = true;
        }

        $getCountryWiseStateList = DB::table('state')
                ->leftJoin('country','state.country_id','=','country.id')
                ->whereRaw('state.name like "%'.$query.'%"')
                ->select('state.id','state.name','state.pagetitle','state.pagedescription','state.pageslug','state.bannerimage','state.isShowOnTop','state.isShowOnHome','state.totalCollegeRegAddress','state.totalCollegeByCampusAddress','country.pageslug as countrySlug','country.name as countryName')
                ->groupBy('state.id')
                ->orderBy('state.name', 'ASC')
                ->get();

        $databaseCountryWiseState = array();
        foreach ($getCountryWiseStateList as $item) {
            $stateCollegePageUrl = URL::to('/'.$item->pageslug.'/'.$item->countrySlug.'/college-list');
            $stateCitiesPageUrl = URL::to('/study-abroad/'.$item->countrySlug.'/'.$item->pageslug.'/cities');
            $databaseCountryWiseState[] = array(
                        'id'                        => $item->id,
                        'statename'                 => strip_tags($item->name).' ('.strip_tags($item->countryName).')',
                        'stateslug'                 => $item->pageslug,
                        'countryname'               => strip_tags($item->countryName),
                        'countrySlug'               => $item->countrySlug,
                        'stateCollegePageUrl'       => $stateCollegePageUrl,
                        'stateCitiesPageUrl'        => $stateCitiesPageUrl,

                    );
        }


        $resultCountryWiseState = [];
        foreach ($databaseCountryWiseState as $key => $oneState) {
            if(!empty($oneState['id'])){
               $resultCountryWiseState[] = $oneState; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultBlogs) && empty($resultNews) && empty($resultAskQuestion) && empty($resultCountry) && empty($resultCountryWiseState)) {
            $status = false;
        }else{
            $status = true;
        }


        $getStateWiseCityList = DB::table('city')
                    ->leftJoin('state','city.state_id','=','state.id')
                    ->leftJoin('country','state.country_id','=','country.id')
                    ->whereRaw('city.name like "%'.$query.'%"')
                    ->select('city.id','city.name','city.pagetitle','city.pagedescription','city.pageslug','city.bannerimage','city.isShowOnTop','city.isShowOnHome','city.totalCollegeRegAddress','city.totalCollegeByCampusAddress','state.pageslug as stateSlug','state.name as stateName','country.pageslug as countrySlug','country.name as countryName')
                    ->groupBy('city.id')
                    ->orderBy('city.name', 'ASC')
                    ->get();


        $databaseStateWiseCity = array();
        foreach ($getStateWiseCityList as $item) {
            $cityCollegePageUrl = URL::to('/'.$item->pageslug.'/'.$item->stateSlug.'/'.$item->countrySlug.'/college-list');
            $databaseStateWiseCity[] = array(
                        'id'                        => $item->id,
                        'cityname'                  => strip_tags($item->name).' ('.strip_tags($item->stateName).','.strip_tags($item->countryName).')',
                        'cityslug'                  => $item->pageslug,
                        'statename'                 => strip_tags($item->stateName),
                        'stateslug'                 => $item->stateSlug,
                        'countryname'               => strip_tags($item->countryName),
                        'countrySlug'               => $item->countrySlug,
                        'cityCollegePageUrl'        => $cityCollegePageUrl,

                    );
        }


        $resultStateWiseCity = [];
        foreach ($databaseStateWiseCity as $key => $oneCity) {
            if(!empty($oneCity['id'])){
               $resultStateWiseCity[] = $oneCity; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultExam) && empty($resultPopularCareerCourses) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultBlogs) && empty($resultNews) && empty($resultAskQuestion) && empty($resultCountry) && empty($resultCountryWiseState) & empty($resultStateWiseCity)) {
            $status = false;
        }else{
            $status = true;
        }

        header('Content-Type: application/json');

        echo json_encode(array(
            "status" => $status,
            "error"  => null,
            "data"   => array(
                "college"           => $resultCollgeUsers,
                "university"        => $resultUniversity,
                "examination"       => $resultExam,
                "popularCareer"     => $resultPopularCareerCourses,
                "functionalarea"    => $resultFuncationalArea,
                "degree"            => $resultDegree,
                "courses"           => $resultCourses,
                "blogs"             => $resultBlogs,
                "news"              => $resultNews,
                "question"          => $resultAskQuestion,
                'resultCountry'     => $resultCountry,
                'resultState'       => $resultCountryWiseState,
                'resultCity'        => $resultStateWiseCity,
            )
        ));
    }

    public function searchCollegeListPage(Request $request)
    {
        $getAllStateObj = [];
        $getAllCityObj = [];
        $getDegreeObj = [];
        $getCourseObj = [];

        $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
        $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
        $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
        $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
        $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
        $query->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id');
        $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
        $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
        $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
        $query->leftJoin('city', 'address.city_id', '=', 'city.id');
        $query->leftJoin('state', 'city.state_id', '=', 'state.id');
        $query->leftJoin('country', 'state.country_id', '=', 'country.id');
        $query->where('users.firstname', '!=', "");

        if ($request->has('approvedBy')) {
            $allApprovedBy[] = $request->get('approvedBy');
            foreach($allApprovedBy as $key ) {
                $approvedByIDS = $key;
            }
            if(!empty($approvedByIDS)){
            $storeApprovedBy = implode (", ", $approvedByIDS);
            }
            $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
        }

        if ($request->has('collegeType')) {
            $allCollegeType[] = $request->get('collegeType');
            foreach($allCollegeType as $key ) {
                $collegeTypeIDS = $key;
            }
            if(!empty($collegeTypeIDS)){
            $storeCollegeType = implode (", ", $collegeTypeIDS);
            }
            $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
        }

        if ($request->has('country')) {
            $allCountry[] = $request->get('country');
            foreach($allCountry as $key ) {
                $countryIDS = $key;
            }
            if(!empty($countryIDS)){
                $storeCountryID = implode (", ", $countryIDS);
            }
            $query->whereIn('country.id', explode(',', $storeCountryID));
            //$query->whereIn('collegeprofile.registeredAddressCountryId', explode(',', $storeCountryID));
            //$query->orWhereIn('collegeprofile.campusAddressCountryId', explode(',', $storeCountryID));

            $getAllStateObj = DB::select(DB::raw("SELECT id, name FROM state WHERE state.country_id in (".$storeCountryID.") ORDER BY state.name ASC"));
        }/*else{
            $getAllStateObj = DB::select(DB::raw("SELECT id, name FROM state WHERE state.country_id = 99 ORDER BY state.name ASC"));
        }*/

        if ($request->has('state')) {
            $allState[] = $request->get('state');
            foreach($allState as $key ) {
                $stateIDS = $key;
            }
            if(!empty($stateIDS)){
            $storeStateID = implode (", ", $stateIDS);
            }

            $query->whereIn('state.id', explode(',', $storeStateID));
            // $query->whereIn('collegeprofile.registeredAddressStateId', explode(',', $storeStateID));
            // $query->orWhereIn('collegeprofile.campusAddressStateId', explode(',', $storeStateID));

            $getAllCityObj = DB::select(DB::raw("SELECT id, name FROM city WHERE city.state_id in (".$storeStateID.") ORDER BY city.name ASC"));
        }/*else{
            $getAllCityObj = DB::table('country')
                            ->leftJoin('state', 'country.id', '=', 'state.country_id')
                            ->leftJoin('city', 'state.id', '=', 'city.state_id')
                            ->where('country.id', '=', 99)
                            ->where('cityStatus','=', 1)
                            ->where('city.isShowOnHome','=', 1)
                            ->select('city.id', 'city.name', 'cityStatus')
                            ->orderBy('city.name', 'ASC')
                            ->get();
        }*/

        if ($request->has('city')) {
            $allCity[] = $request->get('city');
            foreach($allCity as $key ) {
                $cityIDS = $key;
            }
            if(!empty($cityIDS)){
                $storeCityID = implode (", ", $cityIDS);
            }
            $query->whereIn('city.id', explode(',', $storeCityID));
            // $query->whereIn('collegeprofile.registeredAddressCityId', explode(',', $storeCityID));
            // $query->orWhereIn('collegeprofile.campusAddressCityId', explode(',', $storeCityID));
            
        }

        if ($request->has('educationlevel')) {
            $allEducationlevel[] = $request->get('educationlevel');
            foreach($allEducationlevel as $key ) {
                $educationlevelIDS = $key;
            }
            if(!empty($educationlevelIDS)){
            $storeEducationlevelID = implode (", ", $educationlevelIDS);
            }

            $query->whereIn('collegemaster.educationlevel_id', explode(',', $storeEducationlevelID));
        }

        if ($request->has('educationlevel')) {
            $allEducationlevel[] = $request->get('educationlevel');
            foreach($allEducationlevel as $key ) {
                $educationlevelIDS = $key;
            }
            if(!empty($educationlevelIDS)){
            $storeEducationlevelID = implode (", ", $educationlevelIDS);
            }

            $query->whereIn('collegemaster.educationlevel_id', explode(',', $storeEducationlevelID));
        }

        if ($request->has('functionalarea')) {
            $allFunctionalArea[] = $request->get('functionalarea');
            foreach($allFunctionalArea as $key ) {
                $functionalAreaIDS = $key;
            }
            if(!empty($functionalAreaIDS)){
            $storeFunctionalID = implode (", ", $functionalAreaIDS);
            }

            $query->whereIn('collegemaster.functionalarea_id', explode(',', $storeFunctionalID));
            $getDegreeObj = DB::select(DB::raw("SELECT id, name FROM degree WHERE degree.functionalarea_id in (".$storeFunctionalID.") ORDER BY degree.name ASC"));
        }else{
            $getDegreeObj = DB::table('degree')->orderBy('degree.id', 'ASC')->get();
        }

        if ($request->has('degree')) {
            $allDegree[] = $request->get('degree');
            foreach($allDegree as $key ) {
                $degreeIDS = $key;
            }
            if(!empty($degreeIDS)){
                $storeDegreeID = implode (", ", $degreeIDS);
            }

            $query->whereIn('collegemaster.degree_id', explode(',', $storeDegreeID));
            $getCourseObj = DB::select(DB::raw("SELECT id, name FROM course WHERE course.degree_id in (".$storeDegreeID.") ORDER BY course.name ASC"));
        }/*else{
            $getCourseObj = DB::table('course')->where('course.isShowOnHome','=', 1)->orderBy('course.id', 'ASC')->get();
        }*/


        if ($request->has('degree')) {
            if ($request->has('course')) {
                $allCourse[] = $request->get('course');

                foreach($allCourse as $key ) {
                    $courseIds = $key;
                }
                if(!empty($courseIds)){
                    $storeCourseID = implode (", ", $courseIds);
                }
                $query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
            }
        }

        if ($request->has('field_id')) {
            $query->where('collegeprofile.id', '=', $request->get('field_id'));
        }

        if($request->has('filterBy')){
            if( $request->get('filterBy') == '1' ){
                $query->where('collegemaster.fees', '>', '1');
            }
        }

        if($request->has('fees')){
            if( $request->get('fees') == '1' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
            }elseif( $request->get('fees') == '2' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
            }elseif( $request->get('fees') == '3' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
            }elseif( $request->get('fees') == '4' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
            }elseif( $request->get('fees') == '5' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
            }else{}
        }

        if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
            // $query->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (address.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (address.address1) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (address.address2) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE) OR MATCH (address.landmark) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))'); 
        
            $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                    ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('functionalarea.id', DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                    ->get();

            if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->id))  {
                $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->id));
            }else{
                $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->select('degree.id', DB::raw("GROUP_CONCAT(degree.id) as value"))
                                ->get();

                if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->id) ) {
                    $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->id));
                }else{
                    $getCoursId = Course::orderBy('course.id', 'ASC')
                                    ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('course.id', DB::raw("GROUP_CONCAT(course.id) as value"))
                                    ->get();

                    if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->id) ) {
                        $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->id));
                    }                    
                }
            }

            $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                    ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('educationlevel.id', DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                    ->get();

            if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->value) ) {
                $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->value));
            }

            $getCountryId = Country::orderBy('country.id', 'ASC')
                            ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                            ->select('country.id', DB::raw("GROUP_CONCAT(country.id) as value"))
                            ->get();

            if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->id) ) {
                $query->whereIn('country.id', explode(',', $getCountryId[0]->id));
            }else{
                $getStateId = State::orderBy('state.id', 'ASC')
                                ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->where('state.name', 'not like', '%college%')
                                ->where('state.name', 'not like', '%university%')
                                ->select('state.id', DB::raw("GROUP_CONCAT(state.id) as value"))
                                ->get();

                if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->id) ) {
                    $query->whereIn('state.id', explode(',', $getStateId[0]->id));
                }else{
                    $getCityId = City::orderBy('city.id', 'ASC')
                                    ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('city.name', 'not like', '%college%')
                                    ->where('city.name', 'not like', '%university%')
                                    ->select('city.id', DB::raw("GROUP_CONCAT(city.id) as value"))
                                    ->get();

                    if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->id) ) {
                        $query->whereIn('city.id', explode(',', $getCityId[0]->id));
                    }
                }
            }
        }

        // $query->where('address.addresstype_id', '=', '2');
        $query->where('collegeprofile.review', '=', '1');
        $query->where('collegeprofile.verified', '=', '1');
        $query->where('users.userstatus_id', '!=', '5');
        $query->where('users.userrole_id', '=', '2');
        $query->where('gallery.misc', '=', 'college-logo-img');
        
        $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser');

        if( !empty(Input::get('functionalarea_id')) ){
            $query->groupBy('collegeprofile.id');
            $query->groupBy('functionalarea.id');
        }else{
            $query->groupBy('collegeprofile.id');
        }

        if($request->has('filterBy')){
            if( $request->get('filterBy') == '1' ){
                $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
            }elseif ($request->get('filterBy') == '2') {
                $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
            }elseif($request->get('filterBy') == '3'){
                $query->orderBy('collegeprofile.id', 'DESC');
            }else{
                $query->orderBy('collegeprofile.id', 'DESC');
            }
        }else{
            $query->orderBy('users.firstname', 'ASC');
        }

        $getFilterOutDataObj = $query->paginate(10);

        //GET ALL VALUES
        $getFunctionalAreaObj = Cache::remember('getFunctionalAreaObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('functionalarea')->orderBy('functionalarea.name', 'ASC')->get();
        });
        $getEducationLevelObj = Cache::remember('getEducationLevelObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('educationlevel')->orderBy('educationlevel.name', 'ASC')->get();
        });
        $getCountryObj = Cache::remember('getCountryObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('country')->orderBy('country.name', 'ASC')->get();
        });
        $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
        });


        //GET THE HOME PAGE BANNER AD
        /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return   DB::table('ads_managements')
                        ->where('slug', '=', 2)
                        ->where('isactive', '=', 1)
                        ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                        ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                        ->select('img', 'redirectto')
                        ->orderBy('ads_managements.id', 'ASC')
                        ->take(4)
                        ->get()
                        ;
        });*/

        $getCollegeSeachBannerAds = [];                                
        $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  $this->fetchDataServiceController->getListOfAdsManagements(2);
        });

        $urlSlug = 'search';

        $seoSlugName = 'search-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.search-pages.search-college-list-page', compact('collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCountryObj','getAllStateObj','getAllCityObj','getCollegeSeachBannerAds','urlSlug','seocontent','getListOfAdsManagements'));
    }

    public function topUniversityListPage(Request $request)
    {
        $isShowOnTop = "if(university.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $query = DB::table('university'); 
        $query->select('university.id','name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome', DB::Raw($isShowOnTop), DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.university_id = university.id) AS totalCollegeCount'));
        $query->groupBy('university.id');
        $query->orderBy('isShowOnTop', 'ASC');

        $getUniversityInfoObj = $query->paginate(20);


        $seoSlugName = 'top-university-list-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.search-pages.top-university-list-page', compact('getUniversityInfoObj','seocontent'));
    }

    public function universityCollegeListPage(Request $request, $slug)
    {
        $getUniversityDetailInfoObj = DB::table('university')
                                ->where('university.pageslug','=',$slug)
                                ->select('university.id','name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome',DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.university_id = university.id) AS totalCollegeCount'))
                                ->groupBy('university.id')
                                ->orderBy('university.id', 'ASC')
                                ->first();

        if (!empty($getUniversityDetailInfoObj)) {
            //$collegeIds = DB::select(DB::raw("SELECT GROUP_CONCAT(collegeprofile.id) as collegeId FROM collegeprofile where collegeprofile.university_id = $getUniversityDetailInfoObj->id"));
            $getFilterOutDataObj = [];
            $getDegreeObj = [];
            $getCourseObj = [];
            $getAllStateObj = [];
            $getAllCityObj = [];
            $getCountryObj = [];
            if (!empty($getUniversityDetailInfoObj) && ($getUniversityDetailInfoObj->totalCollegeCount > 0)) {
                $topAdsCollegeQueryString = '';
                $fetchAdsCollegeList = $this->fetchDataServiceController->fetchAdsCollegeList("university_id", $getUniversityDetailInfoObj->id);
                $topAdsCollegeQueryString = $this->fetchDataServiceController->topAdsCollegeQueryString($fetchAdsCollegeList);

                $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
                $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
                $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
                $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
                $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
                $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
                $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
                $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
                $query->leftJoin('city', 'address.city_id', '=', 'city.id');
                $query->leftJoin('state', 'city.state_id', '=', 'state.id');
                $query->leftJoin('country', 'state.country_id', '=', 'country.id');
                $query->where('users.firstname', '<>', "");
                //$query->whereIn('collegeprofile.id', explode(',', $collegeIds[0]->collegeId));
                $query->where('collegeprofile.university_id', '=', $getUniversityDetailInfoObj->id);

                if ($request->has('approvedBy')) {
                    $allApprovedBy[] = $request->get('approvedBy');
                    foreach($allApprovedBy as $key ) {
                        $approvedByIDS = $key;
                    }
                    if(!empty($approvedByIDS)){
                    $storeApprovedBy = implode (", ", $approvedByIDS);
                    }
                    $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
                }

                if ($request->has('collegeType')) {
                    $allCollegeType[] = $request->get('collegeType');
                    foreach($allCollegeType as $key ) {
                        $collegeTypeIDS = $key;
                    }
                    if(!empty($collegeTypeIDS)){
                    $storeCollegeType = implode (", ", $collegeTypeIDS);
                    }
                    $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
                }

                if ($request->has('functionalarea')) {
                    $allFunctionalArea[] = $request->get('functionalarea');
                    foreach($allFunctionalArea as $key ) {
                        $functionalAreaIDS = $key;
                    }
                    if(!empty($functionalAreaIDS)){
                    $storeFunctionalID = implode (", ", $functionalAreaIDS);
                    }
                    $query->whereIn('collegemaster.functionalarea_id', explode(',', $storeFunctionalID));
                }

                if ($request->has('degree')) {
                    $allDegree[] = $request->get('degree');
                    foreach($allDegree as $key ) {
                        $degreeIDS = $key;
                    }
                    if(!empty($degreeIDS)){
                        $storeDegreeID = implode (", ", $degreeIDS);
                    }
                    $query->whereIn('collegemaster.degree_id', explode(',', $storeDegreeID));
                }


                if ($request->has('degree')) {
                    if ($request->has('course')) {
                        $allCourse[] = $request->get('course');

                        foreach($allCourse as $key ) {
                            $courseIds = $key;
                        }
                        if(!empty($courseIds)){
                            $storeCourseID = implode (", ", $courseIds);
                        }
                        $query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
                    }
                }

                if($request->has('fees')){
                    if( $request->get('fees') == '1' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
                    }elseif( $request->get('fees') == '2' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
                    }elseif( $request->get('fees') == '3' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
                    }elseif( $request->get('fees') == '4' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
                    }elseif( $request->get('fees') == '5' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
                    }else{}
                }

                if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
                    $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                            ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('functionalarea.id', DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                            ->get();

                    if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->id))  {
                        $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->id));
                    }else{
                        $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                        ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('degree.id', DB::raw("GROUP_CONCAT(degree.id) as value"))
                                        ->get();

                        if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->id) ) {
                            $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->id));
                        }else{
                            $getCoursId = Course::orderBy('course.id', 'ASC')
                                            ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('course.id', DB::raw("GROUP_CONCAT(course.id) as value"))
                                            ->get();

                            if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->id) ) {
                                $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->id));
                            }                    
                        }
                    }

                    $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                            ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('educationlevel.id', DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                            ->get();

                    if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->id) ) {
                        $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->id));
                    }

                    $getCountryId = Country::orderBy('country.id', 'ASC')
                                    ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('country.id', DB::raw("GROUP_CONCAT(country.id) as value"))
                                    ->get();

                    if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->id) ) {
                        $query->whereIn('country.id', explode(',', $getCountryId[0]->id));
                    }else{
                        $getStateId = State::orderBy('state.id', 'ASC')
                                    ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('state.name', 'not like', '%college%')
                                    ->where('state.name', 'not like', '%university%')
                                    ->select('state.id', DB::raw("GROUP_CONCAT(state.id) as value"))
                                    ->get();

                        if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->id) ) {
                            $query->whereIn('state.id', explode(',', $getStateId[0]->id));
                        }else{
                            $getCityId = City::orderBy('city.id', 'ASC')
                                        ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->where('city.name', 'not like', '%college%')
                                        ->where('city.name', 'not like', '%university%')
                                        ->select('city.id', DB::raw("GROUP_CONCAT(city.id) as value"))
                                        ->get();

                            if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->id) ) {
                                $query->whereIn('city.id', explode(',', $getCityId[0]->id));
                            }
                        }
                    }
                }

                // $query->where('address.addresstype_id', '=', '2');
                $query->where('collegeprofile.review', '=', '1');
                $query->where('collegeprofile.verified', '=', '1');
                $query->where('users.userstatus_id', '!=', '5');
                $query->where('users.userrole_id', '=', '2');
                $query->where('gallery.misc', '=', 'college-logo-img');
                
                if(!empty($topAdsCollegeQueryString)){
                    $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($topAdsCollegeQueryString));
                }else{
                    $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser');
                }


                if( !empty(Input::get('functionalarea_id')) ){
                    $query->groupBy('collegeprofile.id');
                    $query->groupBy('functionalarea.id');
                }else{
                    $query->groupBy('collegeprofile.id');
                }

                if(!empty($topAdsCollegeQueryString)){
                    $query->orderBy('topAdsCollegeQueryString', 'ASC');
                }

                if($request->has('filterBy')){
                    if( $request->get('filterBy') == '1' ){
                        $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
                    }elseif ($request->get('filterBy') == '2') {
                        $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
                    }elseif($request->get('filterBy') == '3'){
                        $query->orderBy('collegeprofile.id', 'DESC');
                    }else{
                        $query->orderBy('collegeprofile.id', 'DESC');
                    }
                }else{
                    $query->orderBy('users.firstname', 'ASC');
                }

                $getFilterOutDataObj = $query->paginate(10);
            }


            $getDegreeObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                            ->where('collegeprofile.university_id', '=', $getUniversityDetailInfoObj->id)
                            ->where('degree.name', '!=', '')
                            ->select('degree.id','degree.name')
                            ->orderBy('degree.name', 'Desc')
                            ->groupBy('degree.id')
                            ->get();

            $getCourseObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('course', 'collegemaster.course_id', '=', 'course.id')
                            ->where('collegeprofile.university_id', '=', $getUniversityDetailInfoObj->id)
                            ->where('course.name', '!=', '')
                            ->select('course.id','course.name')
                            ->orderBy('course.name', 'Desc')
                            ->groupBy('course.id')
                            ->get();

            $getFunctionalAreaObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                            ->where('collegeprofile.university_id', '=', $getUniversityDetailInfoObj->id)
                            ->where('functionalarea.name', '!=', '')
                            ->select('functionalarea.id','functionalarea.name')
                            ->orderBy('functionalarea.name', 'Desc')
                            ->groupBy('functionalarea.id')
                            ->get();

            $getEducationLevelObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                            ->where('collegeprofile.university_id', '=', $getUniversityDetailInfoObj->id)
                            ->where('educationlevel.name', '!=', '')
                            ->select('educationlevel.id','educationlevel.name')
                            ->orderBy('educationlevel.name', 'Desc')
                            ->groupBy('educationlevel.id')
                            ->get();

            $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
            });

            //GET THE HOME PAGE BANNER AD
            /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return   DB::table('ads_managements')
                            ->where('slug', '=', 2)
                            ->where('isactive', '=', 1)
                            ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                            ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                            ->select('img', 'redirectto')
                            ->orderBy('ads_managements.id', 'ASC')
                            ->take(4)
                            ->get()
                            ;
            });*/

            $getCollegeSeachBannerAds = [];                                
            $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  $this->fetchDataServiceController->getListOfAdsManagements(2);
            });

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('universityId','universitypage',$getUniversityDetailInfoObj->id);

            //return view('website/home.search-pages.search-university-college-list-page', compact('getUniversityDetailInfoObj','collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCollegeSeachBannerAds','seocontent'));
            $urlSlug = $request->path();
            return view('website/home.search-pages.search-college-list-page', compact('getUniversityDetailInfoObj','collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCollegeSeachBannerAds','seocontent','urlSlug','getCountryObj','getAllStateObj','getAllCityObj','getListOfAdsManagements'));
        }else{
            return redirect('/404');
        }
    }

    public function topCollegeListPage(Request $request)
    {
        $isShowOnTop = "if(collegeprofile.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $getAllStateObj = [];
        $getAllCityObj = [];
        $getDegreeObj = [];
        $getCourseObj = [];
                
        $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
        $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
        $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
        $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
        $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
        $query->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id');
        $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
        $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
        $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
        $query->leftJoin('city', 'address.city_id', '=', 'city.id');
        $query->leftJoin('state', 'city.state_id', '=', 'state.id');
        $query->leftJoin('country', 'state.country_id', '=', 'country.id');
        $query->where('users.firstname', '<>', "");

        if ($request->has('approvedBy')) {
            $allApprovedBy[] = $request->get('approvedBy');
            foreach($allApprovedBy as $key ) {
                $approvedByIDS = $key;
            }
            if(!empty($approvedByIDS)){
            $storeApprovedBy = implode (", ", $approvedByIDS);
            }
            $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
        }

        if ($request->has('collegeType')) {
            $allCollegeType[] = $request->get('collegeType');
            foreach($allCollegeType as $key ) {
                $collegeTypeIDS = $key;
            }
            if(!empty($collegeTypeIDS)){
            $storeCollegeType = implode (", ", $collegeTypeIDS);
            }
            $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
        }

        if ($request->has('country')) {
            $allCountry[] = $request->get('country');
            foreach($allCountry as $key ) {
                $countryIDS = $key;
            }
            if(!empty($countryIDS)){
                $storeCountryID = implode (", ", $countryIDS);
            }
            $query->whereIn('country.id', explode(',', $storeCountryID));
            // $query->whereIn('collegeprofile.registeredAddressCountryId', explode(',', $storeCountryID));
            // $query->orWhereIn('collegeprofile.campusAddressCountryId', explode(',', $storeCountryID));

            $getAllStateObj = DB::select(DB::raw("SELECT id, name FROM state WHERE state.country_id in (".$storeCountryID.") ORDER BY state.name ASC"));
        }

        if ($request->has('state')) {
            $allState[] = $request->get('state');
            foreach($allState as $key ) {
                $stateIDS = $key;
            }
            if(!empty($stateIDS)){
            $storeStateID = implode (", ", $stateIDS);
            }

            $query->whereIn('state.id', explode(',', $storeStateID));
            // $query->whereIn('collegeprofile.registeredAddressStateId', explode(',', $storeStateID));
            // $query->orWhereIn('collegeprofile.campusAddressStateId', explode(',', $storeStateID));

            $getAllCityObj = DB::select(DB::raw("SELECT id, name FROM city WHERE city.state_id in (".$storeStateID.") ORDER BY city.name ASC"));
        }

        if ($request->has('city')) {
            $allCity[] = $request->get('city');
            foreach($allCity as $key ) {
                $cityIDS = $key;
            }
            if(!empty($cityIDS)){
                $storeCityID = implode (", ", $cityIDS);
            }
            $query->whereIn('city.id', explode(',', $storeCityID));
            // $query->whereIn('collegeprofile.registeredAddressCityId', explode(',', $storeCityID));
            // $query->orWhereIn('collegeprofile.campusAddressCityId', explode(',', $storeCityID));
            
        }

        if ($request->has('educationlevel')) {
            $allEducationlevel[] = $request->get('educationlevel');
            foreach($allEducationlevel as $key ) {
                $educationlevelIDS = $key;
            }
            if(!empty($educationlevelIDS)){
            $storeEducationlevelID = implode (", ", $educationlevelIDS);
            }

            $query->whereIn('collegemaster.educationlevel_id', explode(',', $storeEducationlevelID));
        }

        if ($request->has('functionalarea')) {
            $allFunctionalArea[] = $request->get('functionalarea');
            foreach($allFunctionalArea as $key ) {
                $functionalAreaIDS = $key;
            }
            if(!empty($functionalAreaIDS)){
            $storeFunctionalID = implode (", ", $functionalAreaIDS);
            }

            $query->whereIn('collegemaster.functionalarea_id', explode(',', $storeFunctionalID));
            $getDegreeObj = DB::select(DB::raw("SELECT id, name FROM degree WHERE degree.functionalarea_id in (".$storeFunctionalID.") ORDER BY degree.name ASC"));
        }else{
            $getDegreeObj = DB::table('degree')->orderBy('degree.id', 'ASC')->get();
        }

        if ($request->has('degree')) {
            $allDegree[] = $request->get('degree');
            foreach($allDegree as $key ) {
                $degreeIDS = $key;
            }
            if(!empty($degreeIDS)){
                $storeDegreeID = implode (", ", $degreeIDS);
            }

            $query->whereIn('collegemaster.degree_id', explode(',', $storeDegreeID));
            $getCourseObj = DB::select(DB::raw("SELECT id, name FROM course WHERE course.degree_id in (".$storeDegreeID.") ORDER BY course.name ASC"));
        }/*else{
            $getCourseObj = DB::table('course')->where('course.isShowOnHome','=', 1)->orderBy('course.id', 'ASC')->get();
        }*/


        if ($request->has('degree')) {
            if ($request->has('course')) {
                $allCourse[] = $request->get('course');

                foreach($allCourse as $key ) {
                    $courseIds = $key;
                }
                if(!empty($courseIds)){
                    $storeCourseID = implode (", ", $courseIds);
                }
                $query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
            }
        }

        if ($request->has('field_id')) {
            $query->where('collegeprofile.id', '=', $request->get('field_id'));
        }

        if($request->has('filterBy')){
            if( $request->get('filterBy') == '1' ){
                $query->where('collegemaster.fees', '>', '1');
            }
        }

        if($request->has('fees')){
            if( $request->get('fees') == '1' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
            }elseif( $request->get('fees') == '2' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
            }elseif( $request->get('fees') == '3' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
            }elseif( $request->get('fees') == '4' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
            }elseif( $request->get('fees') == '5' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
            }else{}
        }

        if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
            $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                    ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select(DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                    ->get();

            if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->value))  {
                $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->value));
            }else{
                $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->select(DB::raw("GROUP_CONCAT(degree.id) as value"))
                                ->get();

                if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->value) ) {
                    $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->value));
                }else{
                    $getCoursId = Course::orderBy('course.id', 'ASC')
                                    ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select(DB::raw("GROUP_CONCAT(course.id) as value"))
                                    ->get();

                    if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->value) ) {
                        $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->value));
                    }                    
                }
            }

            $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                    ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select(DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                    ->get();

            if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->value) ) {
                $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->value));
            }

            $getCountryId = Country::orderBy('country.id', 'ASC')
                            ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                            ->select(DB::raw("GROUP_CONCAT(country.id) as value"))
                            ->get();

            if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->value) ) {
                $query->whereIn('country.id', explode(',', $getCountryId[0]->value));
            }else{
                $getStateId = State::orderBy('state.id', 'ASC')
                                ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->where('state.name', 'not like', '%college%')
                                ->where('state.name', 'not like', '%university%')
                                ->select(DB::raw("GROUP_CONCAT(state.id) as value"))
                                ->get();

                if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->value) ) {
                    $query->whereIn('state.id', explode(',', $getStateId[0]->value));
                }else{
                    $getCityId = City::orderBy('city.id', 'ASC')
                                    ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('city.name', 'not like', '%college%')
                                    ->where('city.name', 'not like', '%university%')
                                    ->select(DB::raw("GROUP_CONCAT(city.id) as value"))
                                    ->get();

                    if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->value) ) {
                        $query->whereIn('city.id', explode(',', $getCityId[0]->value));
                    }
                }
            }
        }

        // $query->where('address.addresstype_id', '=', '2');
        $query->where('collegeprofile.review', '=', '1');
        $query->where('collegeprofile.verified', '=', '1');
        $query->where('users.userstatus_id', '!=', '5');
        $query->where('users.userrole_id', '=', '2');
        $query->where('gallery.misc', '=', 'college-logo-img');

        $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($isShowOnTop));

        if( !empty(Input::get('functionalarea_id')) ){
            $query->groupBy('collegeprofile.id');
            $query->groupBy('functionalarea.id');
        }else{
            $query->groupBy('collegeprofile.id');
        }

        $query->orderBy('isShowOnTop', 'ASC');

        if($request->has('filterBy')){
            if( $request->get('filterBy') == '1' ){
                $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
            }elseif ($request->get('filterBy') == '2') {
                $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
            }elseif($request->get('filterBy') == '3'){
                $query->orderBy('collegeprofile.id', 'DESC');
            }else{
                $query->orderBy('collegeprofile.id', 'DESC');
            }
        }else{
            $query->orderBy('users.firstname', 'ASC');
        }
        $getFilterOutDataObj = $query->paginate(10);

        //GET ALL VALUES
        $getFunctionalAreaObj = Cache::remember('getFunctionalAreaObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('functionalarea')->orderBy('functionalarea.name', 'ASC')->get();
        });
        $getEducationLevelObj = Cache::remember('getEducationLevelObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('educationlevel')->orderBy('educationlevel.name', 'ASC')->get();
        });
        $getCountryObj = Cache::remember('getCountryObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('country')->orderBy('country.name', 'ASC')->get();
        });
        $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
        });


        //GET THE HOME PAGE BANNER AD
        /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return   DB::table('ads_managements')
                        ->where('slug', '=', 2)
                        ->where('isactive', '=', 1)
                        ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                        ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                        ->select('img', 'redirectto')
                        ->orderBy('ads_managements.id', 'ASC')
                        ->take(4)
                        ->get()
                        ;
        });*/
        $getCollegeSeachBannerAds = [];                                
        $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  $this->fetchDataServiceController->getListOfAdsManagements(2);
        });

        $urlSlug = 'top-colleges';

        $seoSlugName = 'top-college-list-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.search-pages.search-college-list-page', compact('collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCountryObj','getAllStateObj','getAllCityObj','getCollegeSeachBannerAds','urlSlug','seocontent','getListOfAdsManagements'));
    }

    public function topCoursesListPage(Request $request)
    {
        $isShowOnTop = "if(functionalarea.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $functionalareaList = DB::table('functionalarea')
                ->select('functionalarea.id','name','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome', DB::Raw($isShowOnTop))
                ->groupBy('functionalarea.id')
                ->orderBy('isShowOnTop', 'ASC')
                ->get();


        foreach ($functionalareaList as $key => $value) {
            $isShowOnTopDegree = "if(degree.isShowOnTop = 1 , 1,2) as isShowOnTopDegree";
            $value->streamDegreeList = DB::table('degree')->where('degree.functionalarea_id','=', $value->id)->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTopDegree), DB::raw('(SELECT COUNT(course.id) FROM course WHERE course.degree_id = degree.id) AS totalCourseCount'))->groupBy('degree.id')->orderBy('isShowOnTopDegree', 'ASC')->get();
        }

        $getEducationLevelObj = Cache::remember('getEducationLevelObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('educationlevel')->get(); });

        $seoSlugName = 'top-course-list-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.search-pages.top-courses-list-page', compact('functionalareaList','getEducationLevelObj','seocontent'));
    }

    public function streamAndEduLevelCollegeListPage(Request $request, $pageslug)
    {

        $checkEducationLevel = DB::table('educationlevel')
                    ->where('pageslug', '=', $pageslug)
                    ->get();

        $checkFuncationalArea = DB::table('functionalarea')
                    ->where('pageslug', '=', $pageslug)
                    ->get();


        $flag = 0;
        $queryString = '';
        $seocontent = [];
        $topAdsCollegeQueryString = '';
        if (sizeof($checkEducationLevel) > 0) {
            $fetchAdsCollegeList = $this->fetchDataServiceController->fetchAdsCollegeList("educationlevel_id", $checkEducationLevel[0]->id);
            $topAdsCollegeQueryString = $this->fetchDataServiceController->topAdsCollegeQueryString($fetchAdsCollegeList);
            $queryString = "if(educationlevel.isShowOnTop = 1 , 1,2) as queryString";
            $flag = 1;
            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('educationLevelId','educationlevelpage',$checkEducationLevel[0]->id);
        }elseif (sizeof($checkFuncationalArea) > 0){
            $fetchAdsCollegeList = $this->fetchDataServiceController->fetchAdsCollegeList("functionalarea_id", $checkFuncationalArea[0]->id);
            $topAdsCollegeQueryString = $this->fetchDataServiceController->topAdsCollegeQueryString($fetchAdsCollegeList);
            $queryString = "if(functionalarea.isShowOnTop = 1 , 1,2) as queryString";
            $flag = 2;
            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('functionalAreaId','functionalareapage',$checkFuncationalArea[0]->id);
        }else{
            return redirect('/404');
        }

        $isShowOnTop = "if(collegeprofile.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $getAllStateObj = [];
        $getAllCityObj = [];
        $getDegreeObj = [];
        $getCourseObj = [];
        $getFunctionalAreaObj = [];
        $getEducationLevelObj = [];
                
        $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
        $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
        $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
        $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
        $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
        $query->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id');
        $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
        $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
        $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
        $query->leftJoin('city', 'address.city_id', '=', 'city.id');
        $query->leftJoin('state', 'city.state_id', '=', 'state.id');
        $query->leftJoin('country', 'state.country_id', '=', 'country.id');
        $query->where('users.firstname', '<>', "");

        if ($request->has('approvedBy')) {
            $allApprovedBy[] = $request->get('approvedBy');
            foreach($allApprovedBy as $key ) {
                $approvedByIDS = $key;
            }
            if(!empty($approvedByIDS)){
            $storeApprovedBy = implode (", ", $approvedByIDS);
            }
            $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
        }

        if ($request->has('collegeType')) {
            $allCollegeType[] = $request->get('collegeType');
            foreach($allCollegeType as $key ) {
                $collegeTypeIDS = $key;
            }
            if(!empty($collegeTypeIDS)){
            $storeCollegeType = implode (", ", $collegeTypeIDS);
            }
            $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
        }

        if ($request->has('country')) {
            $allCountry[] = $request->get('country');
            foreach($allCountry as $key ) {
                $countryIDS = $key;
            }
            if(!empty($countryIDS)){
                $storeCountryID = implode (", ", $countryIDS);
            }

            $query->whereIn('country.id', explode(',', $storeCountryID));
            // $query->whereIn('collegeprofile.registeredAddressCountryId', explode(',', $storeCountryID));
            // $query->orWhereIn('collegeprofile.campusAddressCountryId', explode(',', $storeCountryID));

            $getAllStateObj = DB::select(DB::raw("SELECT id, name FROM state WHERE state.country_id in (".$storeCountryID.") ORDER BY state.name ASC"));
        }

        if ($request->has('state')) {
            $allState[] = $request->get('state');
            foreach($allState as $key ) {
                $stateIDS = $key;
            }
            if(!empty($stateIDS)){
            $storeStateID = implode (", ", $stateIDS);
            }
            $query->whereIn('state.id', explode(',', $storeStateID));
            // $query->whereIn('collegeprofile.registeredAddressStateId', explode(',', $storeStateID));
            // $query->orWhereIn('collegeprofile.campusAddressStateId', explode(',', $storeStateID));

            $getAllCityObj = DB::select(DB::raw("SELECT id, name FROM city WHERE city.state_id in (".$storeStateID.") ORDER BY city.name ASC"));
        }

        if ($request->has('city')) {
            $allCity[] = $request->get('city');
            foreach($allCity as $key ) {
                $cityIDS = $key;
            }
            if(!empty($cityIDS)){
                $storeCityID = implode (", ", $cityIDS);
            }
            $query->whereIn('city.id', explode(',', $storeCityID));
            // $query->whereIn('collegeprofile.registeredAddressCityId', explode(',', $storeCityID));
            // $query->orWhereIn('collegeprofile.campusAddressCityId', explode(',', $storeCityID));
            
        }

        if (sizeof($checkEducationLevel) > 0) {
            $query->where('collegemaster.educationlevel_id', '=', $checkEducationLevel[0]->id);
            if ($request->has('functionalarea')) {
                $allFunctionalArea[] = $request->get('functionalarea');
                foreach($allFunctionalArea as $key ) {
                    $functionalAreaIDS = $key;
                }
                if(!empty($functionalAreaIDS)){
                $storeFunctionalID = implode (", ", $functionalAreaIDS);
                }

                $query->whereIn('collegemaster.functionalarea_id', explode(',', $storeFunctionalID));
                $getDegreeObj = DB::select(DB::raw("SELECT id, name FROM degree WHERE degree.functionalarea_id in (".$storeFunctionalID.") ORDER BY degree.name ASC"));
            }

            $getFunctionalAreaObj = DB::table('functionalarea')->orderBy('functionalarea.name', 'ASC')->get();
        }elseif (sizeof($checkFuncationalArea) > 0){
            $query->where('collegemaster.functionalarea_id', '=', $checkFuncationalArea[0]->id);
            if ($request->has('educationlevel')) {
                $allEducationlevel[] = $request->get('educationlevel');
                foreach($allEducationlevel as $key ) {
                    $educationlevelIDS = $key;
                }
                if(!empty($educationlevelIDS)){
                $storeEducationlevelID = implode (", ", $educationlevelIDS);
                }

                $query->whereIn('collegemaster.educationlevel_id', explode(',', $storeEducationlevelID));
            }


            $getDegreeObj = DB::select(DB::raw("SELECT id, name FROM degree WHERE degree.functionalarea_id in (".$checkFuncationalArea[0]->id.") ORDER BY degree.name ASC"));
            $getEducationLevelObj = DB::table('educationlevel')->orderBy('educationlevel.name', 'ASC')->get();
        }

        if ($request->has('degree')) {
            $allDegree[] = $request->get('degree');
            foreach($allDegree as $key ) {
                $degreeIDS = $key;
            }
            if(!empty($degreeIDS)){
                $storeDegreeID = implode (", ", $degreeIDS);
            }

            $query->whereIn('collegemaster.degree_id', explode(',', $storeDegreeID));
            $getCourseObj = DB::select(DB::raw("SELECT id, name FROM course WHERE course.degree_id in (".$storeDegreeID.") ORDER BY course.name ASC"));
        }


        if ($request->has('degree')) {
            if ($request->has('course')) {
                $allCourse[] = $request->get('course');

                foreach($allCourse as $key ) {
                    $courseIds = $key;
                }
                if(!empty($courseIds)){
                    $storeCourseID = implode (", ", $courseIds);
                }
                $query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
            }
        }

        if ($request->has('field_id')) {
            $query->where('collegeprofile.id', '=', $request->get('field_id'));
        }

        if($request->has('filterBy')){
            if( $request->get('filterBy') == '1' ){
                $query->where('collegemaster.fees', '>', '1');
            }
        }

        if($request->has('fees')){
            if( $request->get('fees') == '1' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
            }elseif( $request->get('fees') == '2' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
            }elseif( $request->get('fees') == '3' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
            }elseif( $request->get('fees') == '4' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
            }elseif( $request->get('fees') == '5' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
            }else{}
        }

        if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
            $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                    ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select(DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                    ->get();

            if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->value))  {
                $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->value));
            }else{
                $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->select(DB::raw("GROUP_CONCAT(degree.id) as value"))
                                ->get();

                if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->value) ) {
                    $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->value));
                }else{
                    $getCoursId = Course::orderBy('course.id', 'ASC')
                                    ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select(DB::raw("GROUP_CONCAT(course.id) as value"))
                                    ->get();

                    if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->value) ) {
                        $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->value));
                    }                    
                }
            }

            $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                    ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select(DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                    ->get();

            if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->value) ) {
                $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->value));
            }

            $getCountryId = Country::orderBy('country.id', 'ASC')
                            ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                            ->select(DB::raw("GROUP_CONCAT(country.id) as value"))
                            ->get();

            if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->value) ) {
                $query->whereIn('country.id', explode(',', $getCountryId[0]->value));
            }else{
                $getStateId = State::orderBy('state.id', 'ASC')
                                ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->where('state.name', 'not like', '%college%')
                                ->where('state.name', 'not like', '%university%')
                                ->select(DB::raw("GROUP_CONCAT(state.id) as value"))
                                ->get();

                if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->value) ) {
                    $query->whereIn('state.id', explode(',', $getStateId[0]->value));
                }else{
                    $getCityId = City::orderBy('city.id', 'ASC')
                                    ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('city.name', 'not like', '%college%')
                                    ->where('city.name', 'not like', '%university%')
                                    ->select(DB::raw("GROUP_CONCAT(city.id) as value"))
                                    ->get();

                    if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->value) ) {
                        $query->whereIn('city.id', explode(',', $getCityId[0]->value));
                    }
                }
            }
        }

        // $query->where('address.addresstype_id', '=', '2');
        $query->where('collegeprofile.review', '=', '1');
        $query->where('collegeprofile.verified', '=', '1');
        $query->where('users.userstatus_id', '!=', '5');
        $query->where('users.userrole_id', '=', '2');
        $query->where('gallery.misc', '=', 'college-logo-img');
        
        if(!empty($topAdsCollegeQueryString)){
            $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($topAdsCollegeQueryString), DB::Raw($isShowOnTop), DB::Raw($queryString));
        }else{
            $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($isShowOnTop), DB::Raw($queryString));
        }


        if( !empty(Input::get('functionalarea_id')) ){
            $query->groupBy('collegeprofile.id');
            $query->groupBy('functionalarea.id');
        }else{
            $query->groupBy('collegeprofile.id');
        }
        if(!empty($topAdsCollegeQueryString)){
            $query->orderBy('topAdsCollegeQueryString', 'ASC');
        }
        $query->orderBy('isShowOnTop', 'ASC');
        $query->orderBy('queryString', 'ASC');

        if($request->has('filterBy')){
            if( $request->get('filterBy') == '1' ){
                $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
            }elseif ($request->get('filterBy') == '2') {
                $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
            }elseif($request->get('filterBy') == '3'){
                $query->orderBy('collegeprofile.id', 'DESC');
            }else{
                $query->orderBy('collegeprofile.id', 'DESC');
            }
        }else{
            $query->orderBy('users.firstname', 'ASC');
        }
        $getFilterOutDataObj = $query->paginate(10);

        //GET ALL VALUES
        $getCountryObj = Cache::remember('getCountryObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('country')->orderBy('country.name', 'ASC')->get();
        });
        $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
        });


        //GET THE HOME PAGE BANNER AD
        /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return   DB::table('ads_managements')
                        ->where('slug', '=', 2)
                        ->where('isactive', '=', 1)
                        ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                        ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                        ->select('img', 'redirectto')
                        ->orderBy('ads_managements.id', 'ASC')
                        ->take(4)
                        ->get()
                        ;
        });*/

        $getCollegeSeachBannerAds = [];                                
        $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  $this->fetchDataServiceController->getListOfAdsManagements(2);
        });

        $urlSlug = $request->path();
        return view('website/home.search-pages.search-college-list-page', compact('collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCountryObj','getAllStateObj','getAllCityObj','getCollegeSeachBannerAds','urlSlug','checkEducationLevel','checkFuncationalArea','flag','seocontent','getListOfAdsManagements'));
    }

    public function degreeCollegeListPage(Request $request, $stream, $degree)
    {
        $checkDegreeObj  = DB::table('degree')
                            ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                            ->where('degree.pageslug', '=', $degree)
                            ->where('functionalarea.pageslug', '=', $stream)
                            ->select('degree.id', 'degree.name','degree.pageslug', 'degree.functionalarea_id','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug','degree.pagetitle','degree.pagedescription','degree.logoimage','degree.bannerimage')
                            ->get();

        if (sizeof($checkDegreeObj) > 0) {
            $isShowOnTop = "if(collegeprofile.isShowOnTop = 1 , 1,2) as isShowOnTop";
            $queryString = "if(degree.isShowOnTop = 1 , 1,2) as queryString";
            $getAllStateObj = [];
            $getAllCityObj = [];
            $getDegreeObj = [];
            $getCourseObj = [];

            $topAdsCollegeQueryString = '';
            $fetchAdsCollegeList = $this->fetchDataServiceController->fetchAdsCollegeList("degree_id", $checkDegreeObj[0]->id);
            $topAdsCollegeQueryString = $this->fetchDataServiceController->topAdsCollegeQueryString($fetchAdsCollegeList);
                    
            $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
            $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
            $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
            $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
            $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
            $query->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id');
            $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
            $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
            $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
            $query->leftJoin('city', 'address.city_id', '=', 'city.id');
            $query->leftJoin('state', 'city.state_id', '=', 'state.id');
            $query->leftJoin('country', 'state.country_id', '=', 'country.id');
            $query->where('users.firstname', '<>', "");

            $query->where('collegemaster.functionalarea_id', '=', $checkDegreeObj[0]->functionalarea_id);
            $query->where('collegemaster.degree_id', '=', $checkDegreeObj[0]->id);

            if ($request->has('approvedBy')) {
                $allApprovedBy[] = $request->get('approvedBy');
                foreach($allApprovedBy as $key ) {
                    $approvedByIDS = $key;
                }
                if(!empty($approvedByIDS)){
                $storeApprovedBy = implode (", ", $approvedByIDS);
                }
                $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
            }

            if ($request->has('collegeType')) {
                $allCollegeType[] = $request->get('collegeType');
                foreach($allCollegeType as $key ) {
                    $collegeTypeIDS = $key;
                }
                if(!empty($collegeTypeIDS)){
                $storeCollegeType = implode (", ", $collegeTypeIDS);
                }
                $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
            }

            if ($request->has('country')) {
                $allCountry[] = $request->get('country');
                foreach($allCountry as $key ) {
                    $countryIDS = $key;
                }
                if(!empty($countryIDS)){
                    $storeCountryID = implode (", ", $countryIDS);
                }

                $query->whereIn('country.id', explode(',', $storeCountryID));
                // $query->whereIn('collegeprofile.registeredAddressCountryId', explode(',', $storeCountryID));
                // $query->orWhereIn('collegeprofile.campusAddressCountryId', explode(',', $storeCountryID));

                $getAllStateObj = DB::select(DB::raw("SELECT id, name FROM state WHERE state.country_id in (".$storeCountryID.") ORDER BY state.name ASC"));
            }

            if ($request->has('state')) {
                $allState[] = $request->get('state');
                foreach($allState as $key ) {
                    $stateIDS = $key;
                }
                if(!empty($stateIDS)){
                $storeStateID = implode (", ", $stateIDS);
                }

                $query->whereIn('state.id', explode(',', $storeStateID));
                // $query->whereIn('collegeprofile.registeredAddressStateId', explode(',', $storeStateID));
                // $query->orWhereIn('collegeprofile.campusAddressStateId', explode(',', $storeStateID));

                $getAllCityObj = DB::select(DB::raw("SELECT id, name FROM city WHERE city.state_id in (".$storeStateID.") ORDER BY city.name ASC"));
            }

            if ($request->has('city')) {
                $allCity[] = $request->get('city');
                foreach($allCity as $key ) {
                    $cityIDS = $key;
                }
                if(!empty($cityIDS)){
                    $storeCityID = implode (", ", $cityIDS);
                }
                $query->whereIn('city.id', explode(',', $storeCityID));
                // $query->whereIn('collegeprofile.registeredAddressCityId', explode(',', $storeCityID));
                // $query->orWhereIn('collegeprofile.campusAddressCityId', explode(',', $storeCityID));
                
            }

            if ($request->has('educationlevel')) {
                $allEducationlevel[] = $request->get('educationlevel');
                foreach($allEducationlevel as $key ) {
                    $educationlevelIDS = $key;
                }
                if(!empty($educationlevelIDS)){
                $storeEducationlevelID = implode (", ", $educationlevelIDS);
                }

                $query->whereIn('collegemaster.educationlevel_id', explode(',', $storeEducationlevelID));
            }

            
            if ($request->has('course')) {
                $allCourse[] = $request->get('course');

                foreach($allCourse as $key ) {
                    $courseIds = $key;
                }
                if(!empty($courseIds)){
                    $storeCourseID = implode (", ", $courseIds);
                }
                $query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
            }
            

            if ($request->has('field_id')) {
                $query->where('collegeprofile.id', '=', $request->get('field_id'));
            }

            if($request->has('filterBy')){
                if( $request->get('filterBy') == '1' ){
                    $query->where('collegemaster.fees', '>', '1');
                }
            }

            if($request->has('fees')){
                if( $request->get('fees') == '1' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
                }elseif( $request->get('fees') == '2' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
                }elseif( $request->get('fees') == '3' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
                }elseif( $request->get('fees') == '4' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
                }elseif( $request->get('fees') == '5' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
                }else{}
            }

            if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
                $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                        ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select(DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                        ->get();

                if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->value))  {
                    $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->value));
                }else{
                    $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                    ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select(DB::raw("GROUP_CONCAT(degree.id) as value"))
                                    ->get();

                    if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->value) ) {
                        $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->value));
                    }else{
                        $getCoursId = Course::orderBy('course.id', 'ASC')
                                        ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select(DB::raw("GROUP_CONCAT(course.id) as value"))
                                        ->get();

                        if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->value) ) {
                            $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->value));
                        }                    
                    }
                }

                $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                        ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select(DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                        ->get();

                if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->value) ) {
                    $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->value));
                }

                $getCountryId = Country::orderBy('country.id', 'ASC')
                                ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->select(DB::raw("GROUP_CONCAT(country.id) as value"))
                                ->get();

                if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->value) ) {
                    $query->whereIn('country.id', explode(',', $getCountryId[0]->value));
                }else{
                    $getStateId = State::orderBy('state.id', 'ASC')
                                ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                ->where('state.name', 'not like', '%college%')
                                ->where('state.name', 'not like', '%university%')
                                ->select(DB::raw("GROUP_CONCAT(state.id) as value"))
                                ->get();

                    if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->value) ) {
                        $query->whereIn('state.id', explode(',', $getStateId[0]->value));
                    }else{
                        $getCityId = City::orderBy('city.id', 'ASC')
                                    ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('city.name', 'not like', '%college%')
                                    ->where('city.name', 'not like', '%university%')
                                    ->select(DB::raw("GROUP_CONCAT(city.id) as value"))
                                    ->get();

                        if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->value) ) {
                            $query->whereIn('city.id', explode(',', $getCityId[0]->value));
                        }
                    }
                }
            }

            // $query->where('address.addresstype_id', '=', '2');
            $query->where('collegeprofile.review', '=', '1');
            $query->where('collegeprofile.verified', '=', '1');
            $query->where('users.userstatus_id', '!=', '5');
            $query->where('users.userrole_id', '=', '2');
            $query->where('gallery.misc', '=', 'college-logo-img');
            
            if(!empty($topAdsCollegeQueryString)){
                $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($isShowOnTop), DB::Raw($queryString), DB::Raw($topAdsCollegeQueryString));
            }else{
                $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($isShowOnTop), DB::Raw($queryString));
            }

            if( !empty(Input::get('functionalarea_id')) ){
                $query->groupBy('collegeprofile.id');
                $query->groupBy('functionalarea.id');
            }else{
                $query->groupBy('collegeprofile.id');
            }

            if(!empty($topAdsCollegeQueryString)){
                $query->orderBy('topAdsCollegeQueryString', 'ASC');
            }

            $query->orderBy('isShowOnTop', 'ASC');

            if($request->has('filterBy')){
                if( $request->get('filterBy') == '1' ){
                    $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
                }elseif ($request->get('filterBy') == '2') {
                    $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
                }elseif($request->get('filterBy') == '3'){
                    $query->orderBy('collegeprofile.id', 'DESC');
                }else{
                    $query->orderBy('collegeprofile.id', 'DESC');
                }
            }else{
                $query->orderBy('users.firstname', 'ASC');
            }
            $getFilterOutDataObj = $query->paginate(10);

            


            //GET ALL VALUES
            $getFunctionalAreaObj = [];
            $getEducationLevelObj = Cache::remember('getEducationLevelObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('educationlevel')->orderBy('educationlevel.name', 'ASC')->get();
            });

            $getCourseObj = DB::select(DB::raw("SELECT id, name FROM course WHERE course.degree_id in (".$checkDegreeObj[0]->id.") ORDER BY course.name ASC"));

            $getCountryObj = Cache::remember('getCountryObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('country')->orderBy('country.name', 'ASC')->get();
            });
            $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
            });


            //GET THE HOME PAGE BANNER AD
            /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return   DB::table('ads_managements')
                            ->where('slug', '=', 2)
                            ->where('isactive', '=', 1)
                            ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                            ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                            ->select('img', 'redirectto')
                            ->orderBy('ads_managements.id', 'ASC')
                            ->take(4)
                            ->get()
                            ;
            });*/

            $getCollegeSeachBannerAds = [];                                
            $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  $this->fetchDataServiceController->getListOfAdsManagements(2);
            });

            $urlSlug = $request->path();
            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('degreeId','degreepage',$checkDegreeObj[0]->id);
            return view('website/home.search-pages.search-college-list-page', compact('collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCountryObj','getAllStateObj','getAllCityObj','urlSlug','checkDegreeObj','seocontent','getCollegeSeachBannerAds','getListOfAdsManagements'));
        }else{
            return redirect('/404');
        }
    }

    public function coursesCollegeListPage(Request $request, $stream, $degree, $courses)
    {
        $checkCoursesObj      = DB::table('course')
                                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                ->where('course.pageslug', '=', $courses)
                                ->where('degree.pageslug', '=', $degree)
                                ->where('functionalarea.pageslug', '=', $stream)
                                ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug','course.pagetitle','course.pagedescription','course.logoimage','course.bannerimage','course.degree_id','degree.functionalarea_id')
                                ->get();

        if (sizeof($checkCoursesObj) > 0) {
            $isShowOnTop = "if(collegeprofile.isShowOnTop = 1 , 1,2) as isShowOnTop";
            $queryString = "if(course.isShowOnTop = 1 , 1,2) as queryString";
            $getAllStateObj = [];
            $getAllCityObj = [];
            $getDegreeObj = [];
            $getCourseObj = [];
            $getFunctionalAreaObj = [];

            $topAdsCollegeQueryString = '';
            $fetchAdsCollegeList = $this->fetchDataServiceController->fetchAdsCollegeList("course_id", $checkCoursesObj[0]->id);
            $topAdsCollegeQueryString = $this->fetchDataServiceController->topAdsCollegeQueryString($fetchAdsCollegeList);
                    
            $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
            $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
            $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
            $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
            $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
            $query->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id');
            $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
            $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
            $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
            $query->leftJoin('city', 'address.city_id', '=', 'city.id');
            $query->leftJoin('state', 'city.state_id', '=', 'state.id');
            $query->leftJoin('country', 'state.country_id', '=', 'country.id');
            $query->where('users.firstname', '<>', "");

            $query->where('collegemaster.functionalarea_id', '=', $checkCoursesObj[0]->functionalarea_id);
            $query->where('collegemaster.degree_id', '=', $checkCoursesObj[0]->degree_id);
            $query->where('collegemaster.course_id', '=', $checkCoursesObj[0]->id);

            if ($request->has('approvedBy')) {
                $allApprovedBy[] = $request->get('approvedBy');
                foreach($allApprovedBy as $key ) {
                    $approvedByIDS = $key;
                }
                if(!empty($approvedByIDS)){
                $storeApprovedBy = implode (", ", $approvedByIDS);
                }
                $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
            }

            if ($request->has('collegeType')) {
                $allCollegeType[] = $request->get('collegeType');
                foreach($allCollegeType as $key ) {
                    $collegeTypeIDS = $key;
                }
                if(!empty($collegeTypeIDS)){
                $storeCollegeType = implode (", ", $collegeTypeIDS);
                }
                $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
            }

            if ($request->has('country')) {
                $allCountry[] = $request->get('country');
                foreach($allCountry as $key ) {
                    $countryIDS = $key;
                }
                if(!empty($countryIDS)){
                    $storeCountryID = implode (", ", $countryIDS);
                }

                $query->whereIn('country.id', explode(',', $storeCountryID));
                // $query->whereIn('collegeprofile.registeredAddressCountryId', explode(',', $storeCountryID));
                // $query->orWhereIn('collegeprofile.campusAddressCountryId', explode(',', $storeCountryID));

                $getAllStateObj = DB::select(DB::raw("SELECT id, name FROM state WHERE state.country_id in (".$storeCountryID.") ORDER BY state.name ASC"));
            }

            if ($request->has('state')) {
                $allState[] = $request->get('state');
                foreach($allState as $key ) {
                    $stateIDS = $key;
                }
                if(!empty($stateIDS)){
                $storeStateID = implode (", ", $stateIDS);
                }
                $query->whereIn('state.id', explode(',', $storeStateID));
                //$query->whereIn('collegeprofile.registeredAddressStateId', explode(',', $storeStateID));
                //$query->orWhereIn('collegeprofile.campusAddressStateId', explode(',', $storeStateID));

                $getAllCityObj = DB::select(DB::raw("SELECT id, name FROM city WHERE city.state_id in (".$storeStateID.") ORDER BY city.name ASC"));
            }

            if ($request->has('city')) {
                $allCity[] = $request->get('city');
                foreach($allCity as $key ) {
                    $cityIDS = $key;
                }
                if(!empty($cityIDS)){
                    $storeCityID = implode (", ", $cityIDS);
                }
                $query->whereIn('city.id', explode(',', $storeCityID));
                // $query->whereIn('collegeprofile.registeredAddressCityId', explode(',', $storeCityID));
                // $query->orWhereIn('collegeprofile.campusAddressCityId', explode(',', $storeCityID));
                
            }

            if ($request->has('educationlevel')) {
                $allEducationlevel[] = $request->get('educationlevel');
                foreach($allEducationlevel as $key ) {
                    $educationlevelIDS = $key;
                }
                if(!empty($educationlevelIDS)){
                $storeEducationlevelID = implode (", ", $educationlevelIDS);
                }

                $query->whereIn('collegemaster.educationlevel_id', explode(',', $storeEducationlevelID));
            }

            if ($request->has('field_id')) {
                $query->where('collegeprofile.id', '=', $request->get('field_id'));
            }

            if($request->has('filterBy')){
                if( $request->get('filterBy') == '1' ){
                    $query->where('collegemaster.fees', '>', '1');
                }
            }

            if($request->has('fees')){
                if( $request->get('fees') == '1' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
                }elseif( $request->get('fees') == '2' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
                }elseif( $request->get('fees') == '3' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
                }elseif( $request->get('fees') == '4' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
                }elseif( $request->get('fees') == '5' ){
                    $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
                }else{}
            }

            if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
                    $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                            ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('functionalarea.id', DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                            ->get();

                    if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->id))  {
                        $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->id));
                    }else{
                        $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                        ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('degree.id', DB::raw("GROUP_CONCAT(degree.id) as value"))
                                        ->get();

                        if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->id) ) {
                            $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->id));
                        }else{
                            $getCoursId = Course::orderBy('course.id', 'ASC')
                                            ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('course.id', DB::raw("GROUP_CONCAT(course.id) as value"))
                                            ->get();

                            if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->id) ) {
                                $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->id));
                            }                    
                        }
                    }

                    $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                            ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('educationlevel.id', DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                            ->get();

                    if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->id) ) {
                        $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->id));
                    }

                    $getCountryId = Country::orderBy('country.id', 'ASC')
                                    ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('country.id', DB::raw("GROUP_CONCAT(country.id) as value"))
                                    ->get();

                    if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->id) ) {
                        $query->whereIn('country.id', explode(',', $getCountryId[0]->id));
                    }else{
                        $getStateId = State::orderBy('state.id', 'ASC')
                                    ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('state.name', 'not like', '%college%')
                                    ->where('state.name', 'not like', '%university%')
                                    ->select('state.id', DB::raw("GROUP_CONCAT(state.id) as value"))
                                    ->get();

                        if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->id) ) {
                            $query->whereIn('state.id', explode(',', $getStateId[0]->id));
                        }else{
                            $getCityId = City::orderBy('city.id', 'ASC')
                                        ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->where('city.name', 'not like', '%college%')
                                        ->where('city.name', 'not like', '%university%')
                                        ->select('city.id', DB::raw("GROUP_CONCAT(city.id) as value"))
                                        ->get();

                            if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->id) ) {
                                $query->whereIn('city.id', explode(',', $getCityId[0]->id));
                            }
                        }
                    }
                }

            // $query->where('address.addresstype_id', '=', '2');
            $query->where('collegeprofile.review', '=', '1');
            $query->where('collegeprofile.verified', '=', '1');
            $query->where('users.userstatus_id', '!=', '5');
            $query->where('users.userrole_id', '=', '2');
            $query->where('gallery.misc', '=', 'college-logo-img');

            if(!empty($topAdsCollegeQueryString)){
                $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($isShowOnTop), DB::Raw($queryString), DB::Raw($topAdsCollegeQueryString));
            }else{
                $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($isShowOnTop), DB::Raw($queryString));
            }

            if( !empty(Input::get('functionalarea_id')) ){
                $query->groupBy('collegeprofile.id');
                $query->groupBy('functionalarea.id');
            }else{
                $query->groupBy('collegeprofile.id');
            }            

            if(!empty($topAdsCollegeQueryString)){
                $query->orderBy('topAdsCollegeQueryString', 'ASC');
            }

            $query->orderBy('isShowOnTop', 'ASC');

            if($request->has('filterBy')){
                if( $request->get('filterBy') == '1' ){
                    $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
                }elseif ($request->get('filterBy') == '2') {
                    $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
                }elseif($request->get('filterBy') == '3'){
                    $query->orderBy('collegeprofile.id', 'DESC');
                }else{
                    $query->orderBy('collegeprofile.id', 'DESC');
                }
            }else{
                $query->orderBy('users.firstname', 'ASC');
            }
            $getFilterOutDataObj = $query->paginate(10);

            //GET ALL VALUES
            $getEducationLevelObj = Cache::remember('getEducationLevelObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('educationlevel')->orderBy('educationlevel.name', 'ASC')->get();
            });

            $getCountryObj = Cache::remember('getCountryObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('country')->orderBy('country.name', 'ASC')->get();
            });
            $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
            });


            //GET THE HOME PAGE BANNER AD
            /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return   DB::table('ads_managements')
                            ->where('slug', '=', 2)
                            ->where('isactive', '=', 1)
                            ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                            ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                            ->select('img', 'redirectto')
                            ->orderBy('ads_managements.id', 'ASC')
                            ->take(4)
                            ->get()
                            ;
            });*/

            $getCollegeSeachBannerAds = [];                                
            $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  $this->fetchDataServiceController->getListOfAdsManagements(2);
            });

            $urlSlug = $request->path();
            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('topCourseId','topcoursepage',$checkCoursesObj[0]->id);
            return view('website/home.search-pages.search-college-list-page', compact('collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCountryObj','getAllStateObj','getAllCityObj','getCollegeSeachBannerAds','urlSlug','checkCoursesObj','seocontent','getListOfAdsManagements'));
        
        }else{
            return redirect('/404');
        }
    }

    public function studyAbroadListPage(Request $request)
    {
        $isShowOnTop = "if(country.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $query = DB::table('country')->where('totalCollegeRegAddress', '>', 0);
        $query->select('country.id','name','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress', DB::Raw($isShowOnTop), DB::raw('(SELECT COUNT(state.id) FROM state WHERE state.country_id = country.id) AS totalStateCount'));
        $query->groupBy('country.id');
        $query->orderBy('isShowOnTop', 'ASC');
        $query->orderBy('totalCollegeRegAddress', 'DESC');

        $getStudyAbroadObj = $query->paginate(20);

        $seoSlugName = 'study-abroad-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.search-pages.studyabroad-list-page', compact('getStudyAbroadObj','seocontent'));
    }

    public function countryStateList(Request $request, $country)
    {
        $getCountryDetailInfoObj = DB::table('country')
                                ->where('country.pageslug','=',$country)
                                ->select('country.id','country.pageslug as countrySlug','country.name as countryName')
                                ->first();

        if (!empty($getCountryDetailInfoObj)) {
            $isShowOnTop = "if(state.isShowOnTop = 1 , 1,2) as isShowOnTop";

            $query = DB::table('state')
                    ->leftJoin('country','state.country_id','=','country.id')
                    ->where('country.pageslug', '=', $country);

            $query->select('state.id','state.name','state.pagetitle','state.pagedescription','state.pageslug','state.bannerimage','state.isShowOnTop','state.isShowOnHome','state.totalCollegeRegAddress','state.totalCollegeByCampusAddress','country.pageslug as countrySlug','country.name as countryName', DB::Raw($isShowOnTop), DB::Raw($isShowOnTop), DB::Raw($isShowOnTop), DB::raw('(SELECT COUNT(city.id) FROM city WHERE city.state_id = state.id) AS totalCityCount'));
            $query->groupBy('state.id');
            $query->orderBy('state.isShowOnTop', 'ASC');
            $query->orderBy('state.totalCollegeRegAddress', 'DESC');

            $getCountryStateList = $query->paginate(21);

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('countryId','countrypage',$getCountryDetailInfoObj->id);

            return view('website/home.search-pages.country-wise-state-list', compact('getCountryStateList','seocontent','getCountryDetailInfoObj'));
        }else{
            return redirect('/404');
        }
    }

    public function countryStateCityList(Request $request, $country, $state)
    {
        $getStateDetailInfoObj = DB::table('state')
                                ->leftJoin('country','state.country_id','=','country.id')
                                ->where('state.pageslug','=', $state)
                                ->where('country.pageslug','=', $country)
                                ->select('state.id','state.pageslug as stateSlug','state.name as stateName','country.pageslug as countrySlug','country.name as countryName')
                                ->first();

        if (!empty($getStateDetailInfoObj)) {
            $isShowOnTop = "if(state.isShowOnTop = 1 , 1,2) as isShowOnTop";

            $query = DB::table('city')
                    ->leftJoin('state','city.state_id','=','state.id')
                    ->leftJoin('country','state.country_id','=','country.id')
                    ->where('state.pageslug','=', $state)
                    ->where('country.pageslug','=', $country);

            $query->select('city.id','city.name','city.pagetitle','city.pagedescription','city.pageslug','city.bannerimage','city.isShowOnTop','city.isShowOnHome','city.totalCollegeRegAddress','city.totalCollegeByCampusAddress','state.pageslug as stateSlug','state.name as stateName','country.pageslug as countrySlug','country.name as countryName');
            $query->groupBy('city.id');
            $query->orderBy('city.isShowOnTop', 'ASC');
            $query->orderBy('city.totalCollegeRegAddress', 'DESC');

            $getCountryStateCityList = $query->paginate(21);

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('stateId','statepage',$getStateDetailInfoObj->id);

            return view('website/home.search-pages.country-state-wise-city-list', compact('getCountryStateCityList','seocontent','getStateDetailInfoObj'));
        }else{
            return redirect('/404');
        }

    }

    public function studyAbroadCollegeListPage(Request $request, $slug)
    {
        $getCountryDetailInfoObj = DB::table('country')
                                ->where('country.pageslug','=',$slug)
                                ->select('country.id','name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress')
                                ->groupBy('country.id')
                                ->orderBy('country.id', 'ASC')
                                ->first();

        if (!empty($getCountryDetailInfoObj)) {
            $getFilterOutDataObj = [];
            $getDegreeObj = [];
            $getCourseObj = [];
            $getCountryObj = [];
            $getAllStateObj = [];
            $getAllCityObj = [];
            $getAllStateObj = DB::select(DB::raw("SELECT id, name FROM state WHERE state.country_id in (".$getCountryDetailInfoObj->id.") ORDER BY state.name ASC"));


            if (!empty($getCountryDetailInfoObj) && ($getCountryDetailInfoObj->totalCollegeRegAddress > 0 || $getCountryDetailInfoObj->totalCollegeByCampusAddress > 0)) {
                $topAdsCollegeQueryString = "";
                $fetchAdsCollegeList = $this->fetchDataServiceController->fetchAdsCollegeList("country_id", $getCountryDetailInfoObj->id);
                $topAdsCollegeQueryString = $this->fetchDataServiceController->topAdsCollegeQueryString($fetchAdsCollegeList);
                $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
                $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
                $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
                $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
                $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
                $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
                $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
                $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
                $query->leftJoin('city', 'address.city_id', '=', 'city.id');
                $query->leftJoin('state', 'city.state_id', '=', 'state.id');
                $query->leftJoin('country', 'state.country_id', '=', 'country.id');
                $query->where('users.firstname', '<>', "");
                $query->where('country.id', '=', $getCountryDetailInfoObj->id);
                // $query->where('collegeprofile.registeredAddressCountryId', '=', $getCountryDetailInfoObj->id);
                // $query->orWhere('collegeprofile.campusAddressCountryId', '=', $getCountryDetailInfoObj->id);

                if ($request->has('approvedBy')) {
                    $allApprovedBy[] = $request->get('approvedBy');
                    foreach($allApprovedBy as $key ) {
                        $approvedByIDS = $key;
                    }
                    if(!empty($approvedByIDS)){
                    $storeApprovedBy = implode (", ", $approvedByIDS);
                    }
                    $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
                }

                if ($request->has('collegeType')) {
                    $allCollegeType[] = $request->get('collegeType');
                    foreach($allCollegeType as $key ) {
                        $collegeTypeIDS = $key;
                    }
                    if(!empty($collegeTypeIDS)){
                    $storeCollegeType = implode (", ", $collegeTypeIDS);
                    }
                    $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
                }

                if ($request->has('functionalarea')) {
                    $allFunctionalArea[] = $request->get('functionalarea');
                    foreach($allFunctionalArea as $key ) {
                        $functionalAreaIDS = $key;
                    }
                    if(!empty($functionalAreaIDS)){
                    $storeFunctionalID = implode (", ", $functionalAreaIDS);
                    }
                    $query->whereIn('collegemaster.functionalarea_id', explode(',', $storeFunctionalID));
                    $getDegreeObj = DB::select(DB::raw("SELECT id, name FROM degree WHERE degree.functionalarea_id in (".$storeFunctionalID.") ORDER BY degree.name ASC"));
                }

                if ($request->has('degree')) {
                    $allDegree[] = $request->get('degree');
                    foreach($allDegree as $key ) {
                        $degreeIDS = $key;
                    }
                    if(!empty($degreeIDS)){
                        $storeDegreeID = implode (", ", $degreeIDS);
                    }
                    $query->whereIn('collegemaster.degree_id', explode(',', $storeDegreeID));
                    $getCourseObj = DB::select(DB::raw("SELECT id, name FROM course WHERE course.degree_id in (".$storeDegreeID.") ORDER BY course.name ASC"));
                }


                if ($request->has('degree')) {
                    if ($request->has('course')) {
                        $allCourse[] = $request->get('course');

                        foreach($allCourse as $key ) {
                            $courseIds = $key;
                        }
                        if(!empty($courseIds)){
                            $storeCourseID = implode (", ", $courseIds);
                        }
                        $query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
                    }
                }

                if ($request->has('state')) {
                    $allState[] = $request->get('state');
                    foreach($allState as $key ) {
                        $stateIDS = $key;
                    }
                    if(!empty($stateIDS)){
                    $storeStateID = implode (", ", $stateIDS);
                    }
                    $query->whereIn('state.id', explode(',', $storeStateID));
                    // $query->whereIn('collegeprofile.registeredAddressStateId', explode(',', $storeStateID));
                    // $query->orWhereIn('collegeprofile.campusAddressStateId', explode(',', $storeStateID));

                    $getAllCityObj = DB::select(DB::raw("SELECT id, name FROM city WHERE city.state_id in (".$storeStateID.") ORDER BY city.name ASC"));
                }

                if ($request->has('city')) {
                    $allCity[] = $request->get('city');
                    foreach($allCity as $key ) {
                        $cityIDS = $key;
                    }
                    if(!empty($cityIDS)){
                        $storeCityID = implode (", ", $cityIDS);
                    }
                    $query->whereIn('city.id', explode(',', $storeCityID));
                    // $query->whereIn('collegeprofile.registeredAddressCityId', explode(',', $storeCityID));
                    // $query->orWhereIn('collegeprofile.campusAddressCityId', explode(',', $storeCityID));
                    
                }


                if($request->has('fees')){
                    if( $request->get('fees') == '1' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
                    }elseif( $request->get('fees') == '2' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
                    }elseif( $request->get('fees') == '3' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
                    }elseif( $request->get('fees') == '4' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
                    }elseif( $request->get('fees') == '5' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
                    }else{}
                }

                if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
                    $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                            ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('functionalarea.id', DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                            ->get();

                    if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->id))  {
                        $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->id));
                    }else{
                        $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                        ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('degree.id', DB::raw("GROUP_CONCAT(degree.id) as value"))
                                        ->get();

                        if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->id) ) {
                            $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->id));
                        }else{
                            $getCoursId = Course::orderBy('course.id', 'ASC')
                                            ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('course.id', DB::raw("GROUP_CONCAT(course.id) as value"))
                                            ->get();

                            if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->id) ) {
                                $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->id));
                            }                    
                        }
                    }

                    $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                            ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('educationlevel.id', DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                            ->get();

                    if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->id) ) {
                        $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->id));
                    }

                    $getCountryId = Country::orderBy('country.id', 'ASC')
                                    ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('country.id', DB::raw("GROUP_CONCAT(country.id) as value"))
                                    ->get();

                    if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->id) ) {
                        $query->whereIn('country.id', explode(',', $getCountryId[0]->id));
                    }else{
                        $getStateId = State::orderBy('state.id', 'ASC')
                                    ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('state.name', 'not like', '%college%')
                                    ->where('state.name', 'not like', '%university%')
                                    ->select('state.id', DB::raw("GROUP_CONCAT(state.id) as value"))
                                    ->get();

                        if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->id) ) {
                            $query->whereIn('state.id', explode(',', $getStateId[0]->id));
                        }else{
                            $getCityId = City::orderBy('city.id', 'ASC')
                                        ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->where('city.name', 'not like', '%college%')
                                        ->where('city.name', 'not like', '%university%')
                                        ->select('city.id', DB::raw("GROUP_CONCAT(city.id) as value"))
                                        ->get();

                            if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->id) ) {
                                $query->whereIn('city.id', explode(',', $getCityId[0]->id));
                            }
                        }
                    }
                }

                // $query->where('address.addresstype_id', '=', '2');
                $query->where('collegeprofile.review', '=', '1');
                $query->where('collegeprofile.verified', '=', '1');
                $query->where('users.userstatus_id', '!=', '5');
                $query->where('users.userrole_id', '=', '2');
                $query->where('gallery.misc', '=', 'college-logo-img');
                
                if(!empty($topAdsCollegeQueryString)){
                    $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($topAdsCollegeQueryString));
                }else{
                    $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser');
                }

                if( !empty(Input::get('functionalarea_id')) ){
                    $query->groupBy('collegeprofile.id');
                    $query->groupBy('functionalarea.id');
                }else{
                    $query->groupBy('collegeprofile.id');
                }

                if(!empty($topAdsCollegeQueryString)){
                    $query->orderBy('topAdsCollegeQueryString', 'ASC');
                }


                if($request->has('filterBy')){
                    if( $request->get('filterBy') == '1' ){
                        $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
                    }elseif ($request->get('filterBy') == '2') {
                        $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
                    }elseif($request->get('filterBy') == '3'){
                        $query->orderBy('collegeprofile.id', 'DESC');
                    }else{
                        $query->orderBy('collegeprofile.id', 'DESC');
                    }
                }else{
                    $query->orderBy('users.firstname', 'ASC');
                }

                $getFilterOutDataObj = $query->paginate(10);

                
            }


            // $getDegreeObj = DB::table('collegeprofile')
            //                 ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
            //                 ->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
            //                 ->where('collegeprofile.registeredAddressCountryId', '=', $getCountryDetailInfoObj->id)
            //                 ->where('degree.name', '!=', '')
            //                 ->select('degree.id','degree.name')
            //                 ->orderBy('degree.name', 'Desc')
            //                 ->groupBy('degree.id')
            //                 ->get();

            // $getCourseObj = DB::table('collegeprofile')
            //                 ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
            //                 ->leftJoin('course', 'collegemaster.course_id', '=', 'course.id')
            //                 ->where('collegeprofile.registeredAddressCountryId', '=', $getCountryDetailInfoObj->id)
            //                 ->where('course.name', '!=', '')
            //                 ->select('course.id','course.name')
            //                 ->orderBy('course.name', 'Desc')
            //                 ->groupBy('course.id')
            //                 ->get();

            $getFunctionalAreaObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                            //->where('collegeprofile.registeredAddressCountryId', '=', $getCountryDetailInfoObj->id)
                            ->where('functionalarea.name', '!=', '')
                            ->select('functionalarea.id','functionalarea.name')
                            ->orderBy('functionalarea.name', 'Desc')
                            ->groupBy('functionalarea.id')
                            ->get();

            $getEducationLevelObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                            //->where('collegeprofile.registeredAddressCountryId', '=', $getCountryDetailInfoObj->id)
                            ->where('educationlevel.name', '!=', '')
                            ->select('educationlevel.id','educationlevel.name')
                            ->orderBy('educationlevel.name', 'Desc')
                            ->groupBy('educationlevel.id')
                            ->get();

            $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
            });

            //GET THE HOME PAGE BANNER AD
            /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return   DB::table('ads_managements')
                            ->where('slug', '=', 2)
                            ->where('isactive', '=', 1)
                            ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                            ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                            ->select('img', 'redirectto')
                            ->orderBy('ads_managements.id', 'ASC')
                            ->take(4)
                            ->get()
                            ;
            });*/

            $getCollegeSeachBannerAds = [];                                
            $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  $this->fetchDataServiceController->getListOfAdsManagements(2);
            });

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('countryId','countrypage',$getCountryDetailInfoObj->id);

            //return view('website/home.search-pages.search-studyabroad-college-list-page', compact('getCountryDetailInfoObj','collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCollegeSeachBannerAds','getAllStateObj','getAllCityObj','seocontent'));

            $urlSlug = $request->path();
            return view('website/home.search-pages.search-college-list-page', compact('getCountryDetailInfoObj','collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCollegeSeachBannerAds','seocontent','urlSlug','getCountryObj','getAllStateObj','getAllCityObj','getListOfAdsManagements'));
        }else{
            return redirect('/404');
        }
    }

    public function stateCollegeListPage(Request $request, $stateslug, $countryslug)
    {
        $getStateDetailInfoObj = DB::table('state')
                                ->leftJoin('country','state.country_id','=','country.id')
                                ->where('state.pageslug','=', $stateslug)
                                ->where('country.pageslug','=', $countryslug)
                                ->select('state.id','state.name','state.employee_id','state.pagetitle','state.pagedescription','state.pageslug','state.bannerimage','state.isShowOnTop','state.isShowOnHome','state.totalCollegeRegAddress','state.totalCollegeByCampusAddress','country.logoimage','country.bannerimage as countryBannerimage','country.pageslug as countrySlug','country.name as countryName')
                                ->groupBy('state.id')
                                ->orderBy('state.id', 'ASC')
                                ->first();

        if (!empty($getStateDetailInfoObj)) {
            $getFilterOutDataObj = [];
            $getDegreeObj = [];
            $getCourseObj = [];
            $getAllStateObj = [];
            $getAllCityObj = [];
            $getCountryObj = [];
            $getAllCityObj = DB::select(DB::raw("SELECT id, name FROM city WHERE city.state_id in (".$getStateDetailInfoObj->id.") ORDER BY city.name ASC"));

            if (!empty($getStateDetailInfoObj) && ($getStateDetailInfoObj->totalCollegeRegAddress > 0 || $getStateDetailInfoObj->totalCollegeByCampusAddress > 0)) {
                $topAdsCollegeQueryString = '';
                $fetchAdsCollegeList = $this->fetchDataServiceController->fetchAdsCollegeList("state_id", $getStateDetailInfoObj->id);
                $topAdsCollegeQueryString = $this->fetchDataServiceController->topAdsCollegeQueryString($fetchAdsCollegeList);

                $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
                $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
                $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
                $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
                $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
                $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
                $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
                $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
                $query->leftJoin('city', 'address.city_id', '=', 'city.id');
                $query->leftJoin('state', 'city.state_id', '=', 'state.id');
                $query->leftJoin('country', 'state.country_id', '=', 'country.id');
                $query->where('users.firstname', '<>', "");
                $query->where('state.id', '=', $getStateDetailInfoObj->id);
                //$query->where('collegeprofile.registeredAddressStateId', '=', $getStateDetailInfoObj->id);
                //$query->orWhere('collegeprofile.campusAddressStateId', '=', $getStateDetailInfoObj->id);

                if ($request->has('approvedBy')) {
                    $allApprovedBy[] = $request->get('approvedBy');
                    foreach($allApprovedBy as $key ) {
                        $approvedByIDS = $key;
                    }
                    if(!empty($approvedByIDS)){
                    $storeApprovedBy = implode (", ", $approvedByIDS);
                    }
                    $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
                }

                if ($request->has('collegeType')) {
                    $allCollegeType[] = $request->get('collegeType');
                    foreach($allCollegeType as $key ) {
                        $collegeTypeIDS = $key;
                    }
                    if(!empty($collegeTypeIDS)){
                    $storeCollegeType = implode (", ", $collegeTypeIDS);
                    }
                    $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
                }

                if ($request->has('functionalarea')) {
                    $allFunctionalArea[] = $request->get('functionalarea');
                    foreach($allFunctionalArea as $key ) {
                        $functionalAreaIDS = $key;
                    }
                    if(!empty($functionalAreaIDS)){
                    $storeFunctionalID = implode (", ", $functionalAreaIDS);
                    }
                    $query->whereIn('collegemaster.functionalarea_id', explode(',', $storeFunctionalID));
                    $getDegreeObj = DB::select(DB::raw("SELECT id, name FROM degree WHERE degree.functionalarea_id in (".$storeFunctionalID.") ORDER BY degree.name ASC"));
                }

                if ($request->has('degree')) {
                    $allDegree[] = $request->get('degree');
                    foreach($allDegree as $key ) {
                        $degreeIDS = $key;
                    }
                    if(!empty($degreeIDS)){
                        $storeDegreeID = implode (", ", $degreeIDS);
                    }
                    $query->whereIn('collegemaster.degree_id', explode(',', $storeDegreeID));
                    $getCourseObj = DB::select(DB::raw("SELECT id, name FROM course WHERE course.degree_id in (".$storeDegreeID.") ORDER BY course.name ASC"));
                }


                if ($request->has('degree')) {
                    if ($request->has('course')) {
                        $allCourse[] = $request->get('course');

                        foreach($allCourse as $key ) {
                            $courseIds = $key;
                        }
                        if(!empty($courseIds)){
                            $storeCourseID = implode (", ", $courseIds);
                        }
                        $query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
                    }
                }

                if ($request->has('city')) {
                    $allCity[] = $request->get('city');
                    foreach($allCity as $key ) {
                        $cityIDS = $key;
                    }
                    if(!empty($cityIDS)){
                        $storeCityID = implode (", ", $cityIDS);
                    }
                    $query->whereIn('city.id', explode(',', $storeCityID));
                    // $query->whereIn('collegeprofile.registeredAddressCityId', explode(',', $storeCityID));
                    // $query->orWhereIn('collegeprofile.campusAddressCityId', explode(',', $storeCityID));
                    
                }

                if($request->has('fees')){
                    if( $request->get('fees') == '1' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
                    }elseif( $request->get('fees') == '2' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
                    }elseif( $request->get('fees') == '3' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
                    }elseif( $request->get('fees') == '4' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
                    }elseif( $request->get('fees') == '5' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
                    }else{}
                }

                if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
                    $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                            ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('functionalarea.id', DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                            ->get();

                    if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->id))  {
                        $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->id));
                    }else{
                        $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                        ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('degree.id', DB::raw("GROUP_CONCAT(degree.id) as value"))
                                        ->get();

                        if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->id) ) {
                            $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->id));
                        }else{
                            $getCoursId = Course::orderBy('course.id', 'ASC')
                                            ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('course.id', DB::raw("GROUP_CONCAT(course.id) as value"))
                                            ->get();

                            if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->id) ) {
                                $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->id));
                            }                    
                        }
                    }

                    $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                            ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('educationlevel.id', DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                            ->get();

                    if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->id) ) {
                        $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->id));
                    }

                    $getCountryId = Country::orderBy('country.id', 'ASC')
                                    ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('country.id', DB::raw("GROUP_CONCAT(country.id) as value"))
                                    ->get();

                    if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->id) ) {
                        $query->whereIn('country.id', explode(',', $getCountryId[0]->id));
                    }else{
                        $getStateId = State::orderBy('state.id', 'ASC')
                                    ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('state.name', 'not like', '%college%')
                                    ->where('state.name', 'not like', '%university%')
                                    ->select('state.id', DB::raw("GROUP_CONCAT(state.id) as value"))
                                    ->get();

                        if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->id) ) {
                            $query->whereIn('state.id', explode(',', $getStateId[0]->id));
                        }else{
                            $getCityId = City::orderBy('city.id', 'ASC')
                                        ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->where('city.name', 'not like', '%college%')
                                        ->where('city.name', 'not like', '%university%')
                                        ->select('city.id', DB::raw("GROUP_CONCAT(city.id) as value"))
                                        ->get();

                            if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->id) ) {
                                $query->whereIn('city.id', explode(',', $getCityId[0]->id));
                            }
                        }
                    }
                }

                // $query->where('address.addresstype_id', '=', '2');
                $query->where('collegeprofile.review', '=', '1');
                $query->where('collegeprofile.verified', '=', '1');
                $query->where('users.userstatus_id', '!=', '5');
                $query->where('users.userrole_id', '=', '2');
                $query->where('gallery.misc', '=', 'college-logo-img');
                

                if(!empty($topAdsCollegeQueryString)){
                    $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($topAdsCollegeQueryString));
                }else{
                    $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser');
                }

                if( !empty(Input::get('functionalarea_id')) ){
                    $query->groupBy('collegeprofile.id');
                    $query->groupBy('functionalarea.id');
                }else{
                    $query->groupBy('collegeprofile.id');
                }

                if(!empty($topAdsCollegeQueryString)){
                    $query->orderBy('topAdsCollegeQueryString', 'ASC');
                }
                
                if($request->has('filterBy')){
                    if( $request->get('filterBy') == '1' ){
                        $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
                    }elseif ($request->get('filterBy') == '2') {
                        $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
                    }elseif($request->get('filterBy') == '3'){
                        $query->orderBy('collegeprofile.id', 'DESC');
                    }else{
                        $query->orderBy('collegeprofile.id', 'DESC');
                    }
                }else{
                    $query->orderBy('users.firstname', 'ASC');
                }

                $getFilterOutDataObj = $query->paginate(10);

            }


            // $getDegreeObj = DB::table('collegeprofile')
            //                 ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
            //                 ->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
            //                 ->where('collegeprofile.registeredAddressCountryId', '=', $getStateDetailInfoObj->id)
            //                 ->where('degree.name', '!=', '')
            //                 ->select('degree.id','degree.name')
            //                 ->orderBy('degree.name', 'Desc')
            //                 ->groupBy('degree.id')
            //                 ->get();

            // $getCourseObj = DB::table('collegeprofile')
            //                 ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
            //                 ->leftJoin('course', 'collegemaster.course_id', '=', 'course.id')
            //                 ->where('collegeprofile.registeredAddressCountryId', '=', $getStateDetailInfoObj->id)
            //                 ->where('course.name', '!=', '')
            //                 ->select('course.id','course.name')
            //                 ->orderBy('course.name', 'Desc')
            //                 ->groupBy('course.id')
            //                 ->get();

            $getFunctionalAreaObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                            //->where('collegeprofile.registeredAddressCountryId', '=', $getStateDetailInfoObj->id)
                            ->where('functionalarea.name', '!=', '')
                            ->select('functionalarea.id','functionalarea.name')
                            ->orderBy('functionalarea.name', 'Desc')
                            ->groupBy('functionalarea.id')
                            ->get();

            $getEducationLevelObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                            //->where('collegeprofile.registeredAddressCountryId', '=', $getStateDetailInfoObj->id)
                            ->where('educationlevel.name', '!=', '')
                            ->select('educationlevel.id','educationlevel.name')
                            ->orderBy('educationlevel.name', 'Desc')
                            ->groupBy('educationlevel.id')
                            ->get();

            $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
            });

            //GET THE HOME PAGE BANNER AD
            /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return   DB::table('ads_managements')
                            ->where('slug', '=', 2)
                            ->where('isactive', '=', 1)
                            ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                            ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                            ->select('img', 'redirectto')
                            ->orderBy('ads_managements.id', 'ASC')
                            ->take(4)
                            ->get()
                            ;
            });*/

            $getCollegeSeachBannerAds = [];                                
            $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  $this->fetchDataServiceController->getListOfAdsManagements(2);
            });

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('stateId','statepage',$getStateDetailInfoObj->id);

            $urlSlug = $request->path();

            return view('website/home.search-pages.search-college-list-page', compact('getStateDetailInfoObj','collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCountryObj','getAllStateObj','getAllCityObj','getCollegeSeachBannerAds','urlSlug','seocontent','getListOfAdsManagements'));
        }else{
            return redirect('/404');
        }
    }

    public function cityCollegeListPage(Request $request, $slug, $state, $country)
    {
        $getCityDetailInfoObj = DB::table('city')
                                ->leftJoin('state','city.state_id','=','state.id')
                                ->leftJoin('country','state.country_id','=','country.id')
                                ->where('city.pageslug','=',$slug)
                                ->where('state.pageslug','=',$state)
                                ->where('country.pageslug','=',$country)
                                ->select('city.id','city.name','city.employee_id','city.pagetitle','city.pagedescription','city.pageslug','city.bannerimage','city.isShowOnTop','city.isShowOnHome','city.totalCollegeRegAddress','city.totalCollegeByCampusAddress','state.bannerimage as stateBannerimage','country.logoimage','country.bannerimage as countryBannerimage','state.pageslug as stateSlug','state.name as stateName','country.pageslug as countrySlug','country.name as countryName')
                                ->groupBy('city.id')
                                ->orderBy('city.id', 'ASC')
                                ->first();

        if (!empty($getCityDetailInfoObj)) {
            $getFilterOutDataObj = [];
            $getDegreeObj = [];
            $getCourseObj = [];
            $getAllStateObj = [];
            $getAllCityObj = [];
            $getCountryObj = [];

            if (!empty($getCityDetailInfoObj) && ($getCityDetailInfoObj->totalCollegeRegAddress > 0 || $getCityDetailInfoObj->totalCollegeByCampusAddress > 0)) {

                $topAdsCollegeQueryString = '';
                $fetchAdsCollegeList = $this->fetchDataServiceController->fetchAdsCollegeList("city_id", $getCityDetailInfoObj->id);
                $topAdsCollegeQueryString = $this->fetchDataServiceController->topAdsCollegeQueryString($fetchAdsCollegeList);

                $query = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id');
                $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
                $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
                $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
                $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
                $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
                $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');
                $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
                $query->leftJoin('city', 'address.city_id', '=', 'city.id');
                $query->leftJoin('state', 'city.state_id', '=', 'state.id');
                $query->leftJoin('country', 'state.country_id', '=', 'country.id');
                $query->where('users.firstname', '<>', "");
                $query->where('city.id', '=', $getCityDetailInfoObj->id);
                // $query->where('collegeprofile.registeredAddressCityId', '=', $getCityDetailInfoObj->id);
                // $query->orWhere('collegeprofile.campusAddressCityId', '=', $getCityDetailInfoObj->id);

                if ($request->has('approvedBy')) {
                    $allApprovedBy[] = $request->get('approvedBy');
                    foreach($allApprovedBy as $key ) {
                        $approvedByIDS = $key;
                    }
                    if(!empty($approvedByIDS)){
                    $storeApprovedBy = implode (", ", $approvedByIDS);
                    }
                    $query->whereIn('collegeprofile.approvedBy', explode(',', $storeApprovedBy));
                }

                if ($request->has('collegeType')) {
                    $allCollegeType[] = $request->get('collegeType');
                    foreach($allCollegeType as $key ) {
                        $collegeTypeIDS = $key;
                    }
                    if(!empty($collegeTypeIDS)){
                    $storeCollegeType = implode (", ", $collegeTypeIDS);
                    }
                    $query->whereIn('collegeprofile.collegetype_id', explode(',', $storeCollegeType));
                }

                if ($request->has('functionalarea')) {
                    $allFunctionalArea[] = $request->get('functionalarea');
                    foreach($allFunctionalArea as $key ) {
                        $functionalAreaIDS = $key;
                    }
                    if(!empty($functionalAreaIDS)){
                    $storeFunctionalID = implode (", ", $functionalAreaIDS);
                    }
                    $query->whereIn('collegemaster.functionalarea_id', explode(',', $storeFunctionalID));
                    $getDegreeObj = DB::select(DB::raw("SELECT id, name FROM degree WHERE degree.functionalarea_id in (".$storeFunctionalID.") ORDER BY degree.name ASC"));
                }

                if ($request->has('degree')) {
                    $allDegree[] = $request->get('degree');
                    foreach($allDegree as $key ) {
                        $degreeIDS = $key;
                    }
                    if(!empty($degreeIDS)){
                        $storeDegreeID = implode (", ", $degreeIDS);
                    }
                    $query->whereIn('collegemaster.degree_id', explode(',', $storeDegreeID));
                    $getCourseObj = DB::select(DB::raw("SELECT id, name FROM course WHERE course.degree_id in (".$storeDegreeID.") ORDER BY course.name ASC"));
                }


                if ($request->has('degree')) {
                    if ($request->has('course')) {
                        $allCourse[] = $request->get('course');

                        foreach($allCourse as $key ) {
                            $courseIds = $key;
                        }
                        if(!empty($courseIds)){
                            $storeCourseID = implode (", ", $courseIds);
                        }
                        $query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
                    }
                }

                if($request->has('fees')){
                    if( $request->get('fees') == '1' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
                    }elseif( $request->get('fees') == '2' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
                    }elseif( $request->get('fees') == '3' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
                    }elseif( $request->get('fees') == '4' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
                    }elseif( $request->get('fees') == '5' ){
                        $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
                    }else{}
                }

                if ($request->has('q') && !empty(Input::get('q')) && (Input::get('q') != 'null')) {
                    $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                            ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('functionalarea.id', DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                            ->get();

                    if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->id))  {
                        $query->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->id));
                    }else{
                        $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                        ->whereRaw('(MATCH (degree.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('degree.id', DB::raw("GROUP_CONCAT(degree.id) as value"))
                                        ->get();

                        if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->id) ) {
                            $query->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->id));
                        }else{
                            $getCoursId = Course::orderBy('course.id', 'ASC')
                                            ->whereRaw('(MATCH (course.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('course.id', DB::raw("GROUP_CONCAT(course.id) as value"))
                                            ->get();

                            if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->id) ) {
                                $query->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->id));
                            }                    
                        }
                    }

                    $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                            ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                            ->select('educationlevel.id', DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                            ->get();

                    if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->id) ) {
                        $query->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->id));
                    }

                    $getCountryId = Country::orderBy('country.id', 'ASC')
                                    ->whereRaw('(MATCH (country.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('country.id', DB::raw("GROUP_CONCAT(country.id) as value"))
                                    ->get();

                    if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->id) ) {
                        $query->whereIn('country.id', explode(',', $getCountryId[0]->id));
                    }else{
                        $getStateId = State::orderBy('state.id', 'ASC')
                                    ->whereRaw('(MATCH (state.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('state.name', 'not like', '%college%')
                                    ->where('state.name', 'not like', '%university%')
                                    ->select('state.id', DB::raw("GROUP_CONCAT(state.id) as value"))
                                    ->get();

                        if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->id) ) {
                            $query->whereIn('state.id', explode(',', $getStateId[0]->id));
                        }else{
                            $getCityId = City::orderBy('city.id', 'ASC')
                                        ->whereRaw('(MATCH (city.name) AGAINST ("'.Input::get('q').'" IN NATURAL LANGUAGE MODE))')
                                        ->where('city.name', 'not like', '%college%')
                                        ->where('city.name', 'not like', '%university%')
                                        ->select('city.id', DB::raw("GROUP_CONCAT(city.id) as value"))
                                        ->get();

                            if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->id) ) {
                                $query->whereIn('city.id', explode(',', $getCityId[0]->id));
                            }
                        }
                    }
                }

                // $query->where('address.addresstype_id', '=', '2');
                $query->where('collegeprofile.review', '=', '1');
                $query->where('collegeprofile.verified', '=', '1');
                $query->where('users.userstatus_id', '!=', '5');
                $query->where('users.userrole_id', '=', '2');
                $query->where('gallery.misc', '=', 'college-logo-img');

                if(!empty($topAdsCollegeQueryString)){
                    $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser', DB::Raw($topAdsCollegeQueryString));
                }else{
                    $query->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','collegeprofile.rating','collegeprofile.totalRatingUser');
                }

                if( !empty(Input::get('functionalarea_id')) ){
                    $query->groupBy('collegeprofile.id');
                    $query->groupBy('functionalarea.id');
                }else{
                    $query->groupBy('collegeprofile.id');
                }

                if(!empty($topAdsCollegeQueryString)){
                    $query->orderBy('topAdsCollegeQueryString', 'ASC');
                }

                if($request->has('filterBy')){
                    if( $request->get('filterBy') == '1' ){
                        $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
                    }elseif ($request->get('filterBy') == '2') {
                        $query->orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
                    }elseif($request->get('filterBy') == '3'){
                        $query->orderBy('collegeprofile.id', 'DESC');
                    }else{
                        $query->orderBy('collegeprofile.id', 'DESC');
                    }
                }else{
                    $query->orderBy('users.firstname', 'ASC');
                }

                $getFilterOutDataObj = $query->paginate(10);

                
            }


            // $getDegreeObj = DB::table('collegeprofile')
            //                 ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
            //                 ->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
            //                 ->where('collegeprofile.registeredAddressCountryId', '=', $getCityDetailInfoObj->id)
            //                 ->where('degree.name', '!=', '')
            //                 ->select('degree.id','degree.name')
            //                 ->orderBy('degree.name', 'Desc')
            //                 ->groupBy('degree.id')
            //                 ->get();

            // $getCourseObj = DB::table('collegeprofile')
            //                 ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
            //                 ->leftJoin('course', 'collegemaster.course_id', '=', 'course.id')
            //                 ->where('collegeprofile.registeredAddressCountryId', '=', $getCityDetailInfoObj->id)
            //                 ->where('course.name', '!=', '')
            //                 ->select('course.id','course.name')
            //                 ->orderBy('course.name', 'Desc')
            //                 ->groupBy('course.id')
            //                 ->get();

            $getFunctionalAreaObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                            //->where('collegeprofile.registeredAddressCountryId', '=', $getCityDetailInfoObj->id)
                            ->where('functionalarea.name', '!=', '')
                            ->select('functionalarea.id','functionalarea.name')
                            ->orderBy('functionalarea.name', 'Desc')
                            ->groupBy('functionalarea.id')
                            ->get();

            $getEducationLevelObj = DB::table('collegeprofile')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                            //->where('collegeprofile.registeredAddressCountryId', '=', $getCityDetailInfoObj->id)
                            ->where('educationlevel.name', '!=', '')
                            ->select('educationlevel.id','educationlevel.name')
                            ->orderBy('educationlevel.name', 'Desc')
                            ->groupBy('educationlevel.id')
                            ->get();

            $collegeType = Cache::remember('collegeType', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  DB::table('collegetype')->orderBy('collegetype.name', 'ASC')->get();
            });

            //GET THE HOME PAGE BANNER AD
            /*$getCollegeSeachBannerAds = Cache::remember('getCollegeSeachBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return   DB::table('ads_managements')
                            ->where('slug', '=', 2)
                            ->where('isactive', '=', 1)
                            ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                            ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                            ->select('img', 'redirectto')
                            ->orderBy('ads_managements.id', 'ASC')
                            ->take(4)
                            ->get()
                            ;
            });*/

            $getCollegeSeachBannerAds = [];                                
            $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
                return  $this->fetchDataServiceController->getListOfAdsManagements(2);
            });

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('cityId','citypage',$getCityDetailInfoObj->id);

            $urlSlug = $request->path();
            return view('website/home.search-pages.search-college-list-page', compact('getCityDetailInfoObj','collegeType','getFilterOutDataObj','getFunctionalAreaObj','getDegreeObj','getCourseObj','getEducationLevelObj','getCountryObj','getAllStateObj','getAllCityObj','getCollegeSeachBannerAds','urlSlug','seocontent','getListOfAdsManagements'));
        }else{
            return redirect('/404');
        }
    }

    public function streamList(Request $request)
    {
        $isShowOnTop = "if(functionalarea.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $query = DB::table('functionalarea'); 
        $query->select('functionalarea.id','name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome', DB::Raw($isShowOnTop), DB::raw('(SELECT COUNT(degree.id) FROM degree WHERE degree.functionalarea_id = functionalarea.id) AS totalDegreeCount'));
        $query->groupBy('functionalarea.id');
        $query->orderBy('isShowOnTop', 'ASC');

        $functionalareaList = $query->get();

        $seoSlugName = 'stream-list-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.search-pages.stream-list', compact('functionalareaList','seocontent'));
    }

    public function streamDegreeList(Request $request, $slug)
    {
        $getStreamDetailInfoObj = DB::table('functionalarea')
                                ->where('functionalarea.pageslug','=',$slug)
                                ->select('functionalarea.id','functionalarea.pageslug','functionalarea.name')
                                ->first();

        if (!empty($getStreamDetailInfoObj)) {

            $isShowOnTop = "if(degree.isShowOnTop = 1 , 1,2) as isShowOnTop";

            $query = DB::table('degree')->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id'); 
            $query->where('functionalarea.pageslug', '=', $slug);
            $query->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTop), DB::raw('(SELECT COUNT(course.id) FROM course WHERE course.degree_id = degree.id) AS totalCourseCount'));
            $query->groupBy('degree.id');
            $query->orderBy('isShowOnTop', 'ASC');

            $streamDegreeList = $query->paginate(21);

            $seoSlugName = 'stream-degree-list-page';
            $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

            return view('website/home.search-pages.stream-degree-list', compact('streamDegreeList','seocontent','getStreamDetailInfoObj'));
        }else{
            return redirect('/404');
        }
    }

    public function streamDegreeCourseList(Request $request, $stream, $degree)
    {
        $getDegreeDetailInfoObj = DB::table('degree')
                                ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                ->where('functionalarea.pageslug', '=', $stream)
                                ->where('degree.pageslug', '=', $degree)
                                ->select('degree.id','degree.name','degree.pageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                                ->first();

        if (!empty($getDegreeDetailInfoObj)) {
            $isShowOnTop = "if(course.isShowOnTop = 1 , 1,2) as isShowOnTop";

            $query = DB::table('course')
                        ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                        ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id'); 
            $query->where('functionalarea.pageslug', '=', $stream);
            $query->where('degree.pageslug', '=', $degree);
            $query->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTop), DB::raw('(SELECT COUNT(collegemaster.collegeprofile_id) FROM collegemaster WHERE collegemaster.course_id = course.id) AS totalCollegeCount'));

            $query->groupBy('course.id');
            $query->orderBy('isShowOnTop', 'ASC');

            $streamDegreeCourseList = $query->paginate(21);

            $seoSlugName = 'degree-course-list-page';
            $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

            return view('website/home.search-pages.stream-degree-course-list', compact('streamDegreeCourseList','seocontent','getDegreeDetailInfoObj'));
        }else{
            return redirect('/404');
        }
    }

    public function getUniversityList(Request $request)
    {
        $search = Input::get('term');
        $isShowOnTop = "if(university.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $query = DB::table('university'); 
        $query->where('university.name', 'like', '%'.$search.'%')
                ->orWhere('university.pagetitle', 'like', '%'.$search.'%')
                ->orWhere('university.pagedescription', 'like', '%'.$search.'%');

        $query->select('university.id','name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome', DB::Raw($isShowOnTop), DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.university_id = university.id) AS totalCollegeCount'));

        $query->groupBy('university.id');
        $query->orderBy('isShowOnTop', 'ASC');

        $getUniversityList = $query->get();

        if( empty($getUniversityList) ){
            $getUniversityList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getUniversityList);
        die;
    }

    public function getCollegeList(Request $request)
    {
        $search = Input::get('term');
        $isShowOnTop = "if(collegeprofile.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $query = DB::table('users')
                ->leftJoin('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                ->leftJoin('gallery', 'users.id', '=', 'gallery.users_id')
                ->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                ->leftJoin('city', 'address.city_id', '=', 'city.id')
                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                ->leftJoin('country', 'state.country_id', '=', 'country.id')
                ->where('collegeprofile.review', '=', '1')
                ->where('collegeprofile.verified', '=', '1')
                ->where('users.userstatus_id', '!=', '5')
                ->where('gallery.misc', '=', 'college-logo-img')
                ->whereRaw('users.firstname like "%'.$search.'%"')
                ->select('collegeprofile.id','collegeprofile.slug', 'users.firstname', 'users.lastname', 'gallery.name as galleryName', 'city.name as cityName', 'state.name as stateName','country.name as countryName',DB::Raw($isShowOnTop));

        $query->groupBy('collegeprofile.id');
        $query->orderBy('isShowOnTop', 'ASC');

        $databaseCollegeUsersObj = $query->get();

        $status         = true;
        $databaseCollegeUsers  = [];
        $collegelogo    = '';
        foreach ($databaseCollegeUsersObj as $item) {
            if(!empty($item->galleryName)){
                if(file_exists(public_path().'/gallery/'.$item->slug.'/'.$item->galleryName)){
                    $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/gallery/'.$item->slug.'/'.$item->galleryName.'" class="rounded-3x searchimg padding-right5" width="32" height="32">';
                }else{
                    $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/school.png" class="rounded-3x searchimg padding-right5" width="32" height="32">';
                }                          
            }else{
                $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/school.png" class="rounded-3x searchimg padding-right5" width="32" height="32">';
            }

            $collegeUrl = URL::to('/college/'.$item->slug);
            $databaseCollegeUsers[] = array(
                        'id'            => $item->id,
                        'collegeUrl'    => $collegeUrl,
                        'collegelogo'   => $collegelogo,
                        'collegename'   => $item->firstname.' '.$item->lastname,
                        'collegeplace'  => ucfirst($item->cityName).','.ucfirst($item->countryName),
                    );
        }

        header('Content-Type: application/json');
        echo json_encode($databaseCollegeUsers);
        die;
    }

    public function getStreamList(Request $request)
    {
        $search = Input::get('term');
        $isShowOnTop = "if(functionalarea.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $query = DB::table('functionalarea'); 
        $query->where('functionalarea.name', 'like', '%'.$search.'%')
                ->orWhere('functionalarea.pagetitle', 'like', '%'.$search.'%')
                ->orWhere('functionalarea.pagedescription', 'like', '%'.$search.'%');

        $query->select('functionalarea.id','name','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome', DB::Raw($isShowOnTop));

        $query->groupBy('functionalarea.id');
        $query->orderBy('isShowOnTop', 'ASC');

        $getStreamList = $query->get();

        if( empty($getStreamList) ){
            $getStreamList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getStreamList);
        die;
    }

    public function getStreamDegreeList(Request $request)
    {
        $search = Input::get('term');
        $isShowOnTop = "if(degree.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $query = DB::table('degree')->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id'); 
        $query->where('degree.name', 'like', '%'.$search.'%')
                ->orWhere('degree.pagetitle', 'like', '%'.$search.'%')
                ->orWhere('degree.pagedescription', 'like', '%'.$search.'%');

        $query->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTop));

        $query->groupBy('degree.id');
        $query->orderBy('isShowOnTop', 'ASC');

        $getStreamDegreeList = $query->get();

        if( empty($getStreamDegreeList) ){
            $getStreamDegreeList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getStreamDegreeList);
        die;
    }

    public function getStreamDegreeCourseList(Request $request)
    {
        $search = Input::get('term');
        $isShowOnTop = "if(course.isShowOnTop = 1 , 1,2) as isShowOnTop";

        $query = DB::table('course')
                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id'); 
        $query->where('course.name', 'like', '%'.$search.'%')
                ->orWhere('course.pagetitle', 'like', '%'.$search.'%')
                ->orWhere('course.pagedescription', 'like', '%'.$search.'%');

        $query->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTop));

        $query->groupBy('functionalarea.id');
        $query->orderBy('isShowOnTop', 'ASC');

        $getStreamList = $query->get();

        if( empty($getStreamList) ){
            $getStreamList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getStreamList);
        die;
    }

    public function getExaminationList(Request $request)
    {
        $search = Input::get('term');
        $status = true;

        $databaseExamSectionObj = DB::table('exam_sections')
                            ->where('exam_sections.status', '=', 1)
                            ->whereRaw('exam_sections.name like "%'.$search.'%"')
                            ->orWhere('exam_sections.title', 'like', '%'.$search.'%')
                            ->select('exam_sections.id','exam_sections.name', 'title', 'iconImage', 'status', 'slug')
                            ->orderBy('exam_sections.name', 'ASC')
                            ->get()
                            ;

        $databaseExamSection = array();
        foreach ($databaseExamSectionObj as $item) {
            $examSectionUrl = URL::to('/examination-list/'.$item->slug);
            $databaseExamSection[] = array(
                        'id'                => $item->id,
                        'name'              => $item->name,
                        'slug'              => $item->slug,
                        'examSectionUrl'    => $examSectionUrl,
                    );
        }


        $resultExamSection = [];
        foreach ($databaseExamSection as $key => $oneExamSec) {
            if(!empty($oneExamSec['id'])){
               $resultExamSection[] = $oneExamSec; 
            }
        }

        $databaseExaminationObj = DB::table('type_of_examinations')
                            ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                            ->where('type_of_examinations.status', '=', 1)
                            ->whereRaw('type_of_examinations.name like "%'.$search.'%"')
                            ->orWhere('type_of_examinations.sortname', 'like', '%'.$search.'%')
                            ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','exam_sections.slug as streamSlug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('type_of_examinations.id')
                            ->take(10)
                            ->get()
                            ;
        $databaseExamination = [];
        foreach ($databaseExaminationObj as $item) {
            $examUrl = URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug);
            $databaseExamination[] = array(
                                        'id' => $item->id,
                                        'examUrl' => $examUrl,
                                        'name' => $item->sortname.'-'.$item->name,
                                    );
        }


        $resultExamList = [];
        foreach ($databaseExamination as $key => $oneExamList) {
            if(!empty($oneExamList['id'])){
               $resultExamList[] = $oneExamList; 
            }
        }

        // Means no result were found
        if (empty($resultExamSection) && empty($resultExamList)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseExamListDegreeObj = DB::table('exam_list_multiple_degrees')
                            ->leftjoin('exam_sections', 'exam_list_multiple_degrees.examsection_id', '=', 'exam_sections.id')
                            ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                            ->whereRaw('degree.name like "%'.$search.'%"')
                            ->select('exam_list_multiple_degrees.id','degree.id as degreeId','degree.name as degreeName','degreeSlug','exam_sections.slug as examSlug','exam_sections.name as examSectionName')
                            ->orderBy('degree.name', 'ASC')
                            ->groupBy('degree.id')
                            ->get();

        $databaseExamListDegree = array();
        foreach ($databaseExamListDegreeObj as $item) {
            $examDegreeUrl = URL::to('/examination-list/'.$item->examSlug.'/'.$item->degreeSlug);
            $databaseExamListDegree[] = array(
                        'id' => $item->degreeId,
                        'degreeName' => $item->degreeName.' ('.$item->examSectionName.')',
                        'degreeSlug' => $item->degreeSlug,
                        'degreeUrl' => $examDegreeUrl,
                    );
        }


        $resultExamDegree = [];
        foreach ($databaseExamListDegree as $key => $oneExamDegree) {
            if(!empty($oneExamDegree['id'])){
               $resultExamDegree[] = $oneExamDegree; 
            }
        }

        // Means no result were found
        if (empty($resultExamSection) && empty($resultExamList) && empty($resultExamDegree)) {
            $status = false;
        }else{
            $status = true;
        }

        $dataArray = array(
            'status'       => $status,
            'error'        => null,
            'examsection'  => $resultExamSection,
            'examlist'     => $resultExamList,
            'examdegree'   => $resultExamDegree,
        );           

       return response()->json($dataArray);
    }  

    public function getExaminationBoardsList(Request $request)
    {
        $search = Input::get('term');

        $query = DB::table('counseling_boards');
        $query->where('counseling_boards.status', '=', 1);
        $query->where('counseling_boards.name', 'like', '%'.$search.'%')
                ->orWhere('counseling_boards.title', 'like', '%'.$search.'%');

        $query->select('counseling_boards.id','counseling_boards.name','counseling_boards.title','counseling_boards.misc', 'counseling_boards.status', 'counseling_boards.slug');

        $query->groupBy('counseling_boards.id');
        $query->orderBy('counseling_boards.name', 'ASC');

        $getExaminationBoardsList = $query->get();

        if( empty($getExaminationBoardsList) ){
            $getExaminationBoardsList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getExaminationBoardsList);
        die;
    }  

    public function getCareerCoursesList(Request $request)
    {
        $search = Input::get('term');

        $query = DB::table('counseling_courses_education_levels')
                    ->leftjoin('eligibility_criterias', 'counseling_courses_education_levels.educationlevel_id', '=', 'eligibility_criterias.id')
                    ->leftjoin('counseling_courses_details', 'counseling_courses_education_levels.coursesDetailsId', '=', 'counseling_courses_details.id')
                    ->leftjoin('functionalarea', 'counseling_courses_details.functionalarea_id', '=', 'functionalarea.id');
        $query->where('eligibility_criterias.name', 'like', '%'.$search.'%')
                ->orWhere('counseling_courses_details.title', 'like', '%'.$search.'%')
                ->orWhere('functionalarea.name', 'like', '%'.$search.'%');

        $query->select('counseling_courses_details.id', 'title','counseling_courses_details.slug','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','eligibility_criterias.name as eduLevelName','educationLevelSlug');

        $query->orderBy('eligibility_criterias.name', 'ASC');

        $getCareerCoursesList = $query->get();

        if( empty($getCareerCoursesList) ){
            $getCareerCoursesList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getCareerCoursesList);
        die;
    }  

    public function getPopularCareerCoursesList(Request $request)
    {
        $search = Input::get('term');

        $query = DB::table('counseling_career_details')
                ->where('counseling_career_details.status', '=', '1')
                ->where('counseling_career_details.functionalarea_id', '=', null)
                ->where('counseling_career_details.careerRelevantId', '=', null)
                ->whereRaw('counseling_career_details.title like "%'.$search.'%"');

        $query->select('counseling_career_details.id','title', 'image','slug','description','status');

        $query->groupBy('counseling_career_details.id');
        $query->orderBy('counseling_career_details.title', 'ASC');

        $getPopularCareerCoursesList = $query->get();

        if( empty($getPopularCareerCoursesList) ){
            $getPopularCareerCoursesList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getPopularCareerCoursesList);
        die;
    }  

    public function getBlogsList(Request $request)
    {
        $search = Input::get('term');

        $query = DB::table('blogs')
                ->leftJoin('users', 'blogs.users_id', '=', 'users.id')
                ->where('blogs.isactive', '=' , "1")
                ->whereRaw('blogs.topic like "%'.$search.'%"')
                ->whereRaw('blogs.description like "%'.$search.'%"');

        $query->select('blogs.id', 'blogs.topic', 'blogs.description', 'blogs.featimage', 'users.firstname', 'blogs.slug', 'blogs.created_at as createdDate');

        $query->groupBy('blogs.id');
        $query->orderBy('blogs.topic', 'ASC');

        $getBlogsList = $query->get();

        if( empty($getBlogsList) ){
            $getBlogsList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getBlogsList);
        die;
    }  
    
    public function getCountryStateCityList(Request $request)
    {
        $search = Input::get('term');
        $status = true;

        $query = DB::table('country')
                ->whereRaw('country.name like "%'.$search.'%"');

        $query->select('country.id','name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress');

        $query->groupBy('country.id');
        $query->orderBy('country.name', 'ASC');

        $getCountryList = $query->get();


        $databaseCountry = array();
        foreach ($getCountryList as $item) {
            $countryCollegePageUrl = URL::to('/'.$item->pageslug.'/college-list');
            $countryStatePageUrl = URL::to('/study-abroad/'.$item->pageslug);
            $databaseCountry[] = array(
                        'id'                        => $item->id,
                        'countryname'               => strip_tags($item->name),
                        'slug'                      => $item->pageslug,
                        'countryCollegePageUrl'     => $countryCollegePageUrl,
                        'countryStatePageUrl'       => $countryStatePageUrl,

                    );
        }


        $resultCountry = [];
        foreach ($databaseCountry as $key => $oneCountry) {
            if(!empty($oneCountry['id'])){
               $resultCountry[] = $oneCountry; 
            }
        }

        $query1 = DB::table('state')
                ->leftJoin('country','state.country_id','=','country.id')
                ->whereRaw('state.name like "%'.$search.'%"');

        $query1->select('state.id','state.name','state.pagetitle','state.pagedescription','state.pageslug','state.bannerimage','state.isShowOnTop','state.isShowOnHome','state.totalCollegeRegAddress','state.totalCollegeByCampusAddress','country.pageslug as countrySlug','country.name as countryName');

        $query1->groupBy('state.id');
        $query1->orderBy('state.name', 'ASC');

        $getCountryWiseStateList = $query1->get();


        $databaseCountryWiseState = array();
        foreach ($getCountryWiseStateList as $item) {
            $stateCollegePageUrl = URL::to('/'.$item->pageslug.'/'.$item->countrySlug.'/college-list');
            $stateCitiesPageUrl = URL::to('/study-abroad/'.$item->countrySlug.'/'.$item->pageslug.'/cities');
            $databaseCountryWiseState[] = array(
                        'id'                        => $item->id,
                        'statename'                 => strip_tags($item->name).' ('.strip_tags($item->countryName).')',
                        'stateslug'                 => $item->pageslug,
                        'countryname'               => strip_tags($item->countryName),
                        'countrySlug'               => $item->countrySlug,
                        'stateCollegePageUrl'       => $stateCollegePageUrl,
                        'stateCitiesPageUrl'        => $stateCitiesPageUrl,

                    );
        }


        $resultCountryWiseState = [];
        foreach ($databaseCountryWiseState as $key => $oneState) {
            if(!empty($oneState['id'])){
               $resultCountryWiseState[] = $oneState; 
            }
        }

        // Means no result were found
        if (empty($resultCountry) && empty($resultCountryWiseState)) {
            $status = false;
        }else{
            $status = true;
        }


        $query2 = DB::table('city')
                    ->leftJoin('state','city.state_id','=','state.id')
                    ->leftJoin('country','state.country_id','=','country.id')
                    ->whereRaw('city.name like "%'.$search.'%"');

        $query2->select('city.id','city.name','city.pagetitle','city.pagedescription','city.pageslug','city.bannerimage','city.isShowOnTop','city.isShowOnHome','city.totalCollegeRegAddress','city.totalCollegeByCampusAddress','state.pageslug as stateSlug','state.name as stateName','country.pageslug as countrySlug','country.name as countryName');
        $query2->groupBy('city.id');
        $query2->orderBy('city.name', 'ASC');

        $getStateWiseCityList = $query2->get();


        $databaseStateWiseCity = array();
        foreach ($getStateWiseCityList as $item) {
            $cityCollegePageUrl = URL::to('/'.$item->pageslug.'/'.$item->stateSlug.'/'.$item->countrySlug.'/college-list');
            $databaseStateWiseCity[] = array(
                        'id'                        => $item->id,
                        'cityname'                  => strip_tags($item->name).' ('.strip_tags($item->stateName).','.strip_tags($item->countryName).')',
                        'cityslug'                  => $item->pageslug,
                        'statename'                 => strip_tags($item->stateName),
                        'stateslug'                 => $item->stateSlug,
                        'countryname'               => strip_tags($item->countryName),
                        'countrySlug'               => $item->countrySlug,
                        'cityCollegePageUrl'        => $cityCollegePageUrl,

                    );
        }


        $resultStateWiseCity = [];
        foreach ($databaseStateWiseCity as $key => $oneCity) {
            if(!empty($oneCity['id'])){
               $resultStateWiseCity[] = $oneCity; 
            }
        }

        // Means no result were found
        if (empty($resultCountry) && empty($resultCountryWiseState) && empty($resultStateWiseCity)) {
            $status = false;
        }else{
            $status = true;
        }

        $dataArray = array(
            'status'                    => $status,
            'error'                     => null,
            'resultCountry'             => $resultCountry,
            'resultCountryWiseState'    => $resultCountryWiseState,
            'resultStateWiseCity'       => $resultStateWiseCity,
        );           

       return response()->json($dataArray);
    }  

    public function getNewsList(Request $request)
    {
        $search = Input::get('term');

        $query = DB::table('news')
                ->leftJoin('users', 'news.users_id', '=', 'users.id')
                ->where('news.isactive', '=' , "1")
                ->whereRaw('news.topic like "%'.$search.'%"')
                ->whereRaw('news.description like "%'.$search.'%"');

        $query->select('news.id', 'news.topic', 'news.description', 'news.featimage', 'users.firstname', 'news.slug', 'news.created_at as createdDate');

        $query->groupBy('news.id');
        $query->orderBy('news.topic', 'ASC');

        $getNewsList = $query->get();

        if( empty($getNewsList) ){
            $getNewsList = [];
        }

        header('Content-Type: application/json');
        echo json_encode($getNewsList);
        die;
    }    

    public function getAskQuestionList(Request $request)
    {
        $search = Input::get('term');
        $status = true;

        $databaseAskQuestionObj = DB::table('ask_questions')
                            ->whereRaw('ask_questions.question like "%'.$search.'%"')
                            ->where('ask_questions.status', '=', 1)
                            ->select('ask_questions.id','ask_questions.question','slug','questionDate')
                            ->orderBy('ask_questions.question', 'ASC')
                            ->get();

        $databaseAskQuestion = array();
        foreach ($databaseAskQuestionObj as $item) {
            $askPageUrl = URL::to('/ask/'.$item->slug);
            $databaseAskQuestion[] = array(
                        'id'                => $item->id,
                        'question'          => strip_tags($item->question),
                        'slug'              => $item->slug,
                        'askPageUrl'        => $askPageUrl,
                    );
        }


        $resultAskQuestion = [];
        foreach ($databaseAskQuestion as $key => $oneExamSec) {
            if(!empty($oneExamSec['id'])){
               $resultAskQuestion[] = $oneExamSec; 
            }
        }

        $databaseAskQuestionTagObj = DB::table('ask_question_tags')
                            ->whereRaw('ask_question_tags.name like "%'.$search.'%"')
                            ->select('ask_question_tags.id','ask_question_tags.name','ask_question_tags.slug')
                            ->orderBy('ask_question_tags.name', 'ASC')
                            ->groupBy('ask_question_tags.id')
                            ->get()
                            ;
        $databaseAskQuestionTag = [];
        foreach ($databaseAskQuestionTagObj as $item) {
            $tagUrl = URL::to('/ask/tags/'.$item->slug);
            $databaseAskQuestionTag[] = array(
                                        'id' => $item->id,
                                        'tagUrl' => $tagUrl,
                                        'name' => $item->name,
                                    );
        }


        $resultAskQuestionTag = [];
        foreach ($databaseAskQuestionTag as $key => $oneExamList) {
            if(!empty($oneExamList['id'])){
               $resultAskQuestionTag[] = $oneExamList; 
            }
        }

        // Means no result were found
        if (empty($resultAskQuestion) && empty($resultAskQuestionTag)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseAskQuestionAnswerObj = DB::table('ask_question_answers')
                            ->leftjoin('ask_questions', 'ask_question_answers.questionId', '=', 'ask_questions.id')
                            ->whereRaw('ask_question_answers.answer like "%'.$search.'%"')
                            ->select('ask_question_answers.id','ask_question_answers.answer','ask_questions.question','ask_questions.slug','answerDate')
                            ->orderBy('answer', 'ASC')
                            ->take(50)
                            ->get()
                            ;

        $databaseAskQuestionAnswer = array();
        foreach ($databaseAskQuestionAnswerObj as $item) {
            $answerUrl = URL::to('/ask/'.$item->slug);
            $databaseAskQuestionAnswer[] = array(
                        'id' => $item->id,
                        'question' => strip_tags($item->question),
                        'answerUrl' => $answerUrl,
                    );
        }

        $resultAskQuestionAnswer = [];
        foreach ($databaseAskQuestionAnswer as $key => $oneExamDegree) {
            if(!empty($oneExamDegree['id'])){
               $resultAskQuestionAnswer[] = $oneExamDegree; 
            }
        }

        // Means no result were found
        if (empty($resultAskQuestion) && empty($resultAskQuestionTag) && empty($resultAskQuestionAnswer)) {
            $status = false;
        }else{
            $status = true;
        }

        $dataArray = array(
            'status'                    => $status,
            'error'                     => null,
            'resultAskQuestion'         => $resultAskQuestion,
            'resultAskQuestionTag'      => $resultAskQuestionTag,
            'resultAskQuestionAnswer'   => $resultAskQuestionAnswer,
        );           

       return response()->json($dataArray);
    }  


    public function getAllSearchTypeList(Request $request)
    {
        // $query = (!empty($request->get('q'))) ? strtolower($request->get('q')) : null;
        // if (!isset($query)):
        //     die('Invalid query.');
        // endif;
        $query = Input::get('term');

        $SearchQuery = DB::table('users')
                            ->leftJoin('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                            ->leftJoin('gallery', 'users.id', '=', 'gallery.users_id')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                            ->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                            ->leftJoin('course', 'collegemaster.course_id', '=', 'course.id')
                            ->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                            ->leftJoin('city', 'address.city_id', '=', 'city.id')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country', 'state.country_id', '=', 'country.id')
                            ->where('collegeprofile.review', '=', '1')
                            ->where('collegeprofile.verified', '=', '1')
                            ->where('users.userstatus_id', '!=', '5')
                            ->where('gallery.misc', '=', 'college-logo-img')
                            ->whereRaw('(MATCH (users.firstname) AGAINST ("'.$request->get('term').'" IN NATURAL LANGUAGE MODE))');
                            //->whereRaw('users.firstname like "%'.$query.'%"')

            if ($request->has('term') && !empty($request->get('term')) && ($request->get('term') != 'null')) {
                $getFunctionalAreaId = FunctionalArea::orderBy('functionalarea.id', 'ASC')
                                        ->whereRaw('(MATCH (functionalarea.name) AGAINST ("'.$request->get('term').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('functionalarea.id', DB::raw("GROUP_CONCAT(functionalarea.id) as value"))
                                        ->get();

                if ((sizeof($getFunctionalAreaId) > 0) && !empty($getFunctionalAreaId[0]->id))  {
                    $SearchQuery->whereIn('collegemaster.functionalarea_id', explode(',', $getFunctionalAreaId[0]->id));
                }else{
                    $getDegreeId = Degree::orderBy('degree.id', 'ASC')
                                    ->whereRaw('(MATCH (degree.name) AGAINST ("'.$request->get('term').'" IN NATURAL LANGUAGE MODE))')
                                    ->select('degree.id', DB::raw("GROUP_CONCAT(degree.id) as value"))
                                    ->get();

                    if ((sizeof($getDegreeId) > 0) && !empty($getDegreeId[0]->id) ) {
                        $SearchQuery->whereIn('collegemaster.degree_id', explode(',', $getDegreeId[0]->id));
                    }else{
                        $getCoursId = Course::orderBy('course.id', 'ASC')
                                        ->whereRaw('(MATCH (course.name) AGAINST ("'.$request->get('term').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('course.id', DB::raw("GROUP_CONCAT(course.id) as value"))
                                        ->get();

                        if ((sizeof($getCoursId) > 0) && !empty($getCoursId[0]->id) ) {
                            $SearchQuery->whereIn('collegemaster.course_id', explode(',', $getCoursId[0]->id));
                        }                    
                    }
                }

                $getEducationLevelId = EducationLevel::orderBy('educationlevel.id', 'ASC')
                                        ->whereRaw('(MATCH (educationlevel.name) AGAINST ("'.$request->get('term').'" IN NATURAL LANGUAGE MODE))')
                                        ->select('educationlevel.id', DB::raw("GROUP_CONCAT(educationlevel.id) as value"))
                                        ->get();

                if ((sizeof($getEducationLevelId) > 0) && !empty($getEducationLevelId[0]->id) ) {
                    $SearchQuery->whereIn('collegemaster.educationlevel_id', explode(',', $getEducationLevelId[0]->id));
                }

                $getCountryId = Country::orderBy('country.id', 'ASC')
                                ->whereRaw('(MATCH (country.name) AGAINST ("'.$request->get('term').'" IN NATURAL LANGUAGE MODE))')
                                ->select('country.id', DB::raw("GROUP_CONCAT(country.id) as value"))
                                ->get();

                if ((sizeof($getCountryId) > 0) && !empty($getCountryId[0]->id) ) {
                    $SearchQuery->whereIn('country.id', explode(',', $getCountryId[0]->id));
                }else{
                    $getStateId = State::orderBy('state.id', 'ASC')
                                ->whereRaw('(MATCH (state.name) AGAINST ("'.$request->get('term').'" IN NATURAL LANGUAGE MODE))')
                                ->where('state.name', 'not like', '%college%')
                                ->where('state.name', 'not like', '%university%')
                                ->select('state.id', DB::raw("GROUP_CONCAT(state.id) as value"))
                                ->get();

                    if ((sizeof($getStateId) > 0) && !empty($getStateId[0]->id) ) {
                        $SearchQuery->whereIn('state.id', explode(',', $getStateId[0]->id));
                    }else{
                        $getCityId = City::orderBy('city.id', 'ASC')
                                    ->whereRaw('(MATCH (city.name) AGAINST ("'.$request->get('term').'" IN NATURAL LANGUAGE MODE))')
                                    ->where('city.name', 'not like', '%college%')
                                    ->where('city.name', 'not like', '%university%')
                                    ->select('city.id', DB::raw("GROUP_CONCAT(city.id) as value"))
                                    ->get();

                        if ((sizeof($getCityId) > 0) && !empty($getCityId[0]->id) ) {
                            $SearchQuery->whereIn('city.id', explode(',', $getCityId[0]->id));
                        }
                    }
                }
            }
            $databaseCollegeUsersObj    =   $SearchQuery->select('collegeprofile.id','collegeprofile.slug', 'users.firstname', 'users.lastname', 'gallery.name as galleryName', 'city.name as cityName', 'state.name as stateName','country.name as countryName')
                        ->groupBy('collegeprofile.id')
                        ->orderBy('collegeprofile.id',DB::raw('RAND()'))
                        //->orderBy(DB::raw('RAND()'))
                        //->take(10)
                        ->get();

        $status         = true;
        $databaseCollegeUsers  = [];
        $collegelogo    = '';
        foreach ($databaseCollegeUsersObj as $item) {
            if(!empty($item->galleryName)){
                if(file_exists(public_path().'/gallery/'.$item->slug.'/'.$item->galleryName)){
                    $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/gallery/'.$item->slug.'/'.$item->galleryName.'" class="rounded-3x searchimg padding-right5" width="32" height="32">';
                }else{
                    $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/school.png" class="rounded-3x searchimg padding-right5" width="32" height="32">';
                }                          
            }else{
                $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/school.png" class="rounded-3x searchimg padding-right5" width="32" height="32">';
            }

            $collegeUrl = URL::to('/college/'.$item->slug);
            $databaseCollegeUsers[] = array(
                        'id'            => $item->id,
                        'collegeUrl'    => $collegeUrl,
                        'collegelogo'   => $collegelogo,
                        'collegename'   => $item->firstname.' '.$item->lastname,
                        'collegeplace'  => ucfirst($item->cityName).','.ucfirst($item->countryName),
                    );
        }

        $resultCollgeUsers = [];
        foreach ($databaseCollegeUsers as $key => $collegeUser) {
            if(!empty($collegeUser['id'])){
                $resultCollgeUsers[] = $collegeUser;
            }
        }

        $databaseUniversityObj = DB::table('university')
                            ->whereRaw('university.name like "%'.$query.'%"')
                            ->select('id','name','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome')->orderBy(DB::raw('RAND()'))
                            ->groupBy('university.id')
                            ->take(20)
                            ->get();
        $databaseUniversity   = [];
        $universitySection      = '';
        foreach ($databaseUniversityObj as $item) {
            if(!empty($item->logo)){
                $universitySection = '<img style="display: unset !important;width: auto !important;"  src=/common-logo/'.$item->slug.'/'.$item->logo.' class="rounded-3x searchimg" width="32" height="32">';
            }else{
                $universitySection = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/university.png" class="rounded-3x searchimg" width="32" height="32">';
            }
            $universityurl = URL::to('/university/'.$item->pageslug);
            $databaseUniversity[] = array(
                        'id'                => $item->id,
                        'universityurl'     => $universityurl,
                        'universityname'    => $item->name,
                        'logo'              => $universitySection,
                    );
        }
        $resultUniversity = [];
        foreach ($databaseUniversity as $key => $oneUniversity) {
            if(!empty($oneUniversity['id'])){
               $resultUniversity[] = $oneUniversity; 
            }
        }

        // Means no result were found
        if (empty($resultCollgeUsers) && empty($resultUniversity)) {
            $status = false;
        }else{
            $status = true;
        }
        

        $databaseFuncationalAreaObj = DB::table('functionalarea')
                            ->whereRaw('functionalarea.name like "%'.$query.'%"')
                            ->select('functionalarea.id','name', 'pageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('functionalarea.id')
                            ->take(20)   
                            ->get()
                            ;

        $databaseFuncationalArea = array();
        foreach ($databaseFuncationalAreaObj as $item) {
            $streamCollegeUrl = URL::to('/'.$item->pageslug.'/colleges');
            $allDegreeePageUrl = URL::to('/stream/'.$item->pageslug.'/degree');
            $databaseFuncationalArea[] = array(
                        'id'                    => $item->id,
                        'name'                  => $item->name,
                        'streamSlug'            => $item->pageslug,
                        'streamCollegeUrl'      => $streamCollegeUrl,
                        'degreePageUrl'         => $allDegreeePageUrl,
                    );
        }

        $resultFuncationalArea = [];
        foreach ($databaseFuncationalArea as $key => $oneStream) {
            if(!empty($oneStream['id'])){
               $resultFuncationalArea[] = $oneStream; 
            }
        }
        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseDegreeObj = DB::table('degree')
                            ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                            ->where('degree.functionalarea_id','!=', "")
                            ->whereRaw('degree.name like "%'.$query.'%"')
                            ->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('degree.id')
                            ->take(20)
                            ->get();

        $databaseDegree = array();
        foreach ($databaseDegreeObj as $item) {
            $degreeCollegePageUrl = URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges');
            $allCoursePageUrl = URL::to('/stream/'.$item->functionalareapageslug.'/'.$item->pageslug.'/courses');
            $databaseDegree[] = array(
                        'id'                    => $item->id,
                        'name'                  => $item->name.' - ('.$item->functionalareaName.')',
                        'degreeSlug'            => $item->pageslug,
                        'degreeCollegePageUrl'  => $degreeCollegePageUrl,
                        'coursePageUrl'         => $allCoursePageUrl,
                        'funcationalAreaUrl'    => $item->functionalareapageslug,
                    );
        }

        $resultDegree = [];
        foreach ($databaseDegree as $key => $oneDegree) {
            if(!empty($oneDegree['id'])){
               $resultDegree[] = $oneDegree; 
            }
        }
        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseCoursesObj = DB::table('course')
                            ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                            ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                            ->where('course.degree_id','!=', "")
                            ->where('degree.functionalarea_id','!=', "")
                            ->whereRaw('course.name like "%'.$query.'%"')
                            ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('course.id')
                            ->take(20)   
                            ->get()
                            ;

        $databaseCourses = array();
        foreach ($databaseCoursesObj as $item) {
            $courseCollegePageUrl = URL::to('/'.$item->functionalareapageslug.'/'.$item->degreepageslug.'/'.$item->pageslug.'/colleges');
            $databaseCourses[] = array(
                        'id'                    => $item->id,
                        'name'                  => $item->name.' - ('.$item->degreeName.', '.$item->functionalareaName.')',
                        'coursesSlug'           => $item->pageslug,
                        'courseCollegePageUrl'  => $courseCollegePageUrl,
                        'degreeUrl'             => $item->degreepageslug,
                        'funcationalAreaUrl'    => $item->functionalareapageslug,
                    );
        }

        $resultCourses = [];
        foreach ($databaseCourses as $key => $oneCourse) {
            if(!empty($oneCourse['id'])){
               $resultCourses[] = $oneCourse; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses)) {
            $status = false;
        }else{
            $status = true;
        }


        $getCountryList = DB::table('country')
                ->whereRaw('country.name like "%'.$query.'%"')
                ->select('country.id','name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress')
                ->groupBy('country.id')
                ->orderBy('country.name', 'ASC')
                ->take(20)
                ->get();


        $databaseCountry = array();
        foreach ($getCountryList as $item) {
            $countryCollegePageUrl = URL::to('/'.$item->pageslug.'/college-list');
            $countryStatePageUrl = URL::to('/study-abroad/'.$item->pageslug);
            $databaseCountry[] = array(
                        'id'                        => $item->id,
                        'countryname'               => strip_tags($item->name),
                        'slug'                      => $item->pageslug,
                        'countryCollegePageUrl'     => $countryCollegePageUrl,
                        'countryStatePageUrl'       => $countryStatePageUrl,

                    );
        }


        $resultCountry = [];
        foreach ($databaseCountry as $key => $oneCountry) {
            if(!empty($oneCountry['id'])){
               $resultCountry[] = $oneCountry; 
            }
        }

        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry)) {
            $status = false;
        }else{
            $status = true;
        }

        $getCountryWiseStateList = DB::table('state')
                ->leftJoin('country','state.country_id','=','country.id')
                ->whereRaw('state.name like "%'.$query.'%"')
                ->select('state.id','state.name','state.pagetitle','state.pagedescription','state.pageslug','state.bannerimage','state.isShowOnTop','state.isShowOnHome','state.totalCollegeRegAddress','state.totalCollegeByCampusAddress','country.pageslug as countrySlug','country.name as countryName')
                ->groupBy('state.id')
                ->orderBy('state.name', 'ASC')
                ->take(20)
                ->get();

        $databaseCountryWiseState = array();
        foreach ($getCountryWiseStateList as $item) {
            $stateCollegePageUrl = URL::to('/'.$item->pageslug.'/'.$item->countrySlug.'/college-list');
            $stateCitiesPageUrl = URL::to('/study-abroad/'.$item->countrySlug.'/'.$item->pageslug.'/cities');
            $databaseCountryWiseState[] = array(
                        'id'                        => $item->id,
                        'statename'                 => strip_tags($item->name).' ('.strip_tags($item->countryName).')',
                        'stateslug'                 => $item->pageslug,
                        'countryname'               => strip_tags($item->countryName),
                        'countrySlug'               => $item->countrySlug,
                        'stateCollegePageUrl'       => $stateCollegePageUrl,
                        'stateCitiesPageUrl'        => $stateCitiesPageUrl,

                    );
        }


        $resultCountryWiseState = [];
        foreach ($databaseCountryWiseState as $key => $oneState) {
            if(!empty($oneState['id'])){
               $resultCountryWiseState[] = $oneState; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState)) {
            $status = false;
        }else{
            $status = true;
        }


        $getStateWiseCityList = DB::table('city')
                    ->leftJoin('state','city.state_id','=','state.id')
                    ->leftJoin('country','state.country_id','=','country.id')
                    ->whereRaw('city.name like "%'.$query.'%"')
                    ->select('city.id','city.name','city.pagetitle','city.pagedescription','city.pageslug','city.bannerimage','city.isShowOnTop','city.isShowOnHome','city.totalCollegeRegAddress','city.totalCollegeByCampusAddress','state.pageslug as stateSlug','state.name as stateName','country.pageslug as countrySlug','country.name as countryName')
                    ->groupBy('city.id')
                    ->orderBy('city.name', 'ASC')
                    ->take(20)
                    ->get();


        $databaseStateWiseCity = array();
        foreach ($getStateWiseCityList as $item) {
            $cityCollegePageUrl = URL::to('/'.$item->pageslug.'/'.$item->stateSlug.'/'.$item->countrySlug.'/college-list');
            $databaseStateWiseCity[] = array(
                        'id'                        => $item->id,
                        'cityname'                  => strip_tags($item->name).' ('.strip_tags($item->stateName).','.strip_tags($item->countryName).')',
                        'cityslug'                  => $item->pageslug,
                        'statename'                 => strip_tags($item->stateName),
                        'stateslug'                 => $item->stateSlug,
                        'countryname'               => strip_tags($item->countryName),
                        'countrySlug'               => $item->countrySlug,
                        'cityCollegePageUrl'        => $cityCollegePageUrl,

                    );
        }


        $resultStateWiseCity = [];
        foreach ($databaseStateWiseCity as $key => $oneCity) {
            if(!empty($oneCity['id'])){
               $resultStateWiseCity[] = $oneCity; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState) & empty($resultStateWiseCity)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseEducationLevelObj = DB::table('educationlevel')
                            ->whereRaw('educationlevel.name like "%'.$query.'%"')
                            ->select('educationlevel.id','name', 'pageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('educationlevel.id')
                            ->take(20)   
                            ->get()
                            ;

        $databaseEducationLevel = array();
        foreach ($databaseEducationLevelObj as $item) {
            $collegePageUrl = URL::to('/'.$item->pageslug.'/colleges');
            $databaseEducationLevel[] = array(
                        'id'                    => $item->id,
                        'name'                  => $item->name,
                        'pageSlug'              => $item->pageslug,
                        'collegePageUrl'        => $collegePageUrl,
                    );
        }

        $resultEducationLevel = [];
        foreach ($databaseEducationLevel as $key => $oneEduLevel) {
            if(!empty($oneEduLevel['id'])){
               $resultEducationLevel[] = $oneEduLevel; 
            }
        }
        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState) && empty($resultStateWiseCity) && empty($resultEducationLevel) ) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseExamSectionObj = DB::table('exam_sections')
                            ->where('exam_sections.status', '=', 1)
                            ->whereRaw('exam_sections.name like "%'.$query.'%"')
                            ->orWhere('exam_sections.title', 'like', '%'.$query.'%')
                            ->select('exam_sections.id','exam_sections.name', 'title', 'iconImage', 'status', 'slug')
                            ->orderBy('exam_sections.name', 'ASC')
                            ->take(20)
                            ->get()
                            ;

        $databaseExamSection = array();
        foreach ($databaseExamSectionObj as $item) {
            $examSectionUrl = URL::to('/examination-list/'.$item->slug);
            $databaseExamSection[] = array(
                        'id'                => $item->id,
                        'name'              => $item->name,
                        'slug'              => $item->slug,
                        'examSectionUrl'    => $examSectionUrl,
                    );
        }


        $resultExamSection = [];
        foreach ($databaseExamSection as $key => $oneExamSec) {
            if(!empty($oneExamSec['id'])){
               $resultExamSection[] = $oneExamSec; 
            }
        }

        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState) && empty($resultStateWiseCity) && empty($resultEducationLevel) && empty($resultExamSection)) {
            $status = false;
        }else{
            $status = true;
        }


        $databaseExaminationObj = DB::table('type_of_examinations')
                            ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                            ->where('type_of_examinations.status', '=', 1)
                            ->whereRaw('type_of_examinations.name like "%'.$query.'%"')
                            ->orWhere('type_of_examinations.sortname', 'like', '%'.$query.'%')
                            ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','exam_sections.slug as streamSlug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('type_of_examinations.id')
                            ->take(20)
                            ->get()
                            ;
        $databaseExamination = [];
        foreach ($databaseExaminationObj as $item) {
            $examUrl = URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug);
            $databaseExamination[] = array(
                                        'id' => $item->id,
                                        'examUrl' => $examUrl,
                                        'name' => $item->sortname.'-'.$item->name,
                                    );
        }


        $resultExamList = [];
        foreach ($databaseExamination as $key => $oneExamList) {
            if(!empty($oneExamList['id'])){
               $resultExamList[] = $oneExamList; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState) && empty($resultStateWiseCity) && empty($resultEducationLevel) && empty($resultExamSection) && empty($resultExamList)) {
            $status = false;
        }else{
            $status = true;
        }
        
        $databaseExamListDegreeObj = DB::table('exam_list_multiple_degrees')
                            ->leftjoin('exam_sections', 'exam_list_multiple_degrees.examsection_id', '=', 'exam_sections.id')
                            ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                            ->whereRaw('degree.name like "%'.$query.'%"')
                            ->select('exam_list_multiple_degrees.id','degree.id as degreeId','degree.name as degreeName','degreeSlug','exam_sections.slug as examSlug','exam_sections.name as examSectionName')
                            ->orderBy('degree.name', 'ASC')
                            ->groupBy('degree.id')
                            ->take(20)
                            ->get();

        $databaseExamListDegree = array();
        foreach ($databaseExamListDegreeObj as $item) {
            $examDegreeUrl = URL::to('/examination-list/'.$item->examSlug.'/'.$item->degreeSlug);
            $databaseExamListDegree[] = array(
                        'id' => $item->degreeId,
                        'degreeName' => $item->degreeName.' ('.$item->examSectionName.')',
                        'degreeSlug' => $item->degreeSlug,
                        'degreeUrl' => $examDegreeUrl,
                    );
        }


        $resultExamDegree = [];
        foreach ($databaseExamListDegree as $key => $oneExamDegree) {
            if(!empty($oneExamDegree['id'])){
               $resultExamDegree[] = $oneExamDegree; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState) && empty($resultStateWiseCity) && empty($resultEducationLevel) && empty($resultExamSection) && empty($resultExamList) && empty($resultExamDegree)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseCounselingCoursesObj = DB::table('counseling_courses_education_levels')
                            ->leftjoin('eligibility_criterias', 'counseling_courses_education_levels.educationlevel_id', '=', 'eligibility_criterias.id')
                            ->leftjoin('counseling_courses_details', 'counseling_courses_education_levels.coursesDetailsId', '=', 'counseling_courses_details.id')
                            ->leftjoin('functionalarea', 'counseling_courses_details.functionalarea_id', '=', 'functionalarea.id')
                            ->where('eligibility_criterias.name', 'like', '%'.$query.'%')
                            ->orWhere('counseling_courses_details.title', 'like', '%'.$query.'%')
                            ->orWhere('functionalarea.name', 'like', '%'.$query.'%')
                            ->select('counseling_courses_details.id', 'title','counseling_courses_details.slug','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','eligibility_criterias.name as eduLevelName','educationLevelSlug')
                            ->orderBy('eligibility_criterias.name', 'ASC')
                            ->take(20)
                            ->get();

        $databaseCounselingCoursesList = array();
        foreach ($databaseCounselingCoursesObj as $item) {
            $careersCoursesUrl = URL::to('/careers-courses/'.$item->educationLevelSlug.'/'.$item->slug);
            $databaseCounselingCoursesList[] = array(
                        'id' => $item->id,
                        'title' => $item->title,
                        'functionalAreaName' => $item->functionalAreaName,
                        'slug' => $item->slug,
                        'careersCoursesUrl' => $careersCoursesUrl,
                        'eduLevelName' => $item->eduLevelName,
                    );
        }


        $resultCounselingCourses = [];
        foreach ($databaseCounselingCoursesList as $key => $oneCounselingCourses) {
            if(!empty($oneCounselingCourses['id'])){
               $resultCounselingCourses[] = $oneCounselingCourses; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState) && empty($resultStateWiseCity) && empty($resultEducationLevel) && empty($resultExamSection) && empty($resultExamList) && empty($resultExamDegree) && empty($resultCounselingCourses)) {
            $status = false;
        }else{
            $status = true;
        }

        
        $databasePopularCareerCoursesListObj = DB::table('counseling_career_details')
                                        ->where('counseling_career_details.status', '=', '1')
                                        ->where('counseling_career_details.functionalarea_id', '=', null)
                                        ->where('counseling_career_details.careerRelevantId', '=', null)
                                        ->whereRaw('counseling_career_details.title like "%'.$query.'%"')
                                        ->select('counseling_career_details.id','title','slug')
                                        ->groupBy('counseling_career_details.id')
                                        ->orderBy('counseling_career_details.title', 'ASC')
                                        ->take(20)
                                        ->get();

        $databasePopularCareerList = array();
        foreach ($databasePopularCareerCoursesListObj as $item) {
            $popularCareerUrl = URL::to('/popular-careers/'.$item->slug);
            $databasePopularCareerList[] = array(
                        'id' => $item->id,
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'popularCareerUrl' => $popularCareerUrl,
                    );
        }


        $resultPopularCareer = [];
        foreach ($databasePopularCareerList as $key => $onePopularCareer) {
            if(!empty($onePopularCareer['id'])){
               $resultPopularCareer[] = $onePopularCareer; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState) && empty($resultStateWiseCity) && empty($resultEducationLevel) && empty($resultExamSection) && empty($resultExamList) && empty($resultExamDegree) && empty($resultPopularCareer)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseExaminationBoardsListObj = DB::table('counseling_boards')
                                        ->where('counseling_boards.status', '=', 1)
                                        ->where('counseling_boards.name', 'like', '%'.$query.'%')
                                        ->orWhere('counseling_boards.title', 'like', '%'.$query.'%')
                                        ->select('counseling_boards.id','counseling_boards.name','counseling_boards.title','counseling_boards.misc', 'counseling_boards.status', 'counseling_boards.slug')
                                        ->groupBy('counseling_boards.id')
                                        ->orderBy('counseling_boards.name', 'ASC')
                                        ->take(20)
                                        ->get();

        $databaseExaminationBoardsList = array();
        foreach ($databaseExaminationBoardsListObj as $item) {
            $boardUrl = URL::to('/board/'.strtolower($item->misc).'/'.$item->slug);
            $databaseExaminationBoardsList[] = array(
                        'id' => $item->id,
                        'name' => $item->name,
                        'title' => $item->title,
                        'misc' => $item->misc,
                        'slug' => $item->slug,
                        'boardUrl' => $boardUrl,
                    );
        }


        $resultExaminationBoards = [];
        foreach ($databaseExaminationBoardsList as $key => $oneExaminationBoards) {
            if(!empty($oneExaminationBoards['id'])){
               $resultExaminationBoards[] = $oneExaminationBoards; 
            }
        }

        // Means no result were found
        if (empty($resultUniversity) && empty($resultCollgeUsers) && empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultCountry) && empty($resultCountryWiseState) && empty($resultStateWiseCity) && empty($resultEducationLevel) && empty($resultExamSection) && empty($resultExamList) && empty($resultExamDegree) && empty($resultPopularCareer) && empty($resultExaminationBoards)) {
            $status = false;
        }else{
            $status = true;
        }

        $dataArray = array(
            'status'                    => $status,
            'error'                     => null,
            "college"                   => $resultCollgeUsers,
            "university"                => $resultUniversity,
            "functionalarea"            => $resultFuncationalArea,
            "degree"                    => $resultDegree,
            "courses"                   => $resultCourses,
            "educationlevel"            => $resultEducationLevel,
            'resultCountry'             => $resultCountry,
            'resultState'               => $resultCountryWiseState,
            'resultCity'                => $resultStateWiseCity,
            'examsection'               => $resultExamSection,
            'examlist'                  => $resultExamList,
            'examdegree'                => $resultExamDegree,
            'counselingCourses'         => $resultCounselingCourses,
            'popularCareer'             => $resultPopularCareer, 
            'examinationBoards'         => $resultExaminationBoards,  
        );           

       return response()->json($dataArray);
    }

    public function getStreamDegreeCourseEduList(Request $request)
    {
        $query = Input::get('term');

        $databaseFuncationalAreaObj = DB::table('functionalarea')
                            ->whereRaw('functionalarea.name like "%'.$query.'%"')
                            ->select('functionalarea.id','name', 'pageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('functionalarea.id')
                            ->take(20)   
                            ->get()
                            ;

        $databaseFuncationalArea = array();
        foreach ($databaseFuncationalAreaObj as $item) {
            $streamCollegeUrl = URL::to('/'.$item->pageslug.'/colleges');
            $allDegreeePageUrl = URL::to('/stream/'.$item->pageslug.'/degree');
            $databaseFuncationalArea[] = array(
                        'id'                    => $item->id,
                        'name'                  => $item->name,
                        'streamSlug'            => $item->pageslug,
                        'streamCollegeUrl'      => $streamCollegeUrl,
                        'degreePageUrl'         => $allDegreeePageUrl,
                    );
        }

        $resultFuncationalArea = [];
        foreach ($databaseFuncationalArea as $key => $oneStream) {
            if(!empty($oneStream['id'])){
               $resultFuncationalArea[] = $oneStream; 
            }
        }
        // Means no result were found
        if (empty($resultFuncationalArea)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseDegreeObj = DB::table('degree')
                            ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                            ->where('degree.functionalarea_id','!=', "")
                            ->whereRaw('functionalarea.name like "%'.$query.'%"')
                            ->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('degree.id')
                            ->take(20)
                            ->get();

        $databaseDegree = array();
        foreach ($databaseDegreeObj as $item) {
            $degreeCollegePageUrl = URL::to('/'.$item->functionalareapageslug.'/'.$item->pageslug.'/colleges');
            $allCoursePageUrl = URL::to('/stream/'.$item->functionalareapageslug.'/'.$item->pageslug.'/courses');
            $databaseDegree[] = array(
                        'id'                    => $item->id,
                        'name'                  => $item->name.' - ('.$item->functionalareaName.')',
                        'degreeSlug'            => $item->pageslug,
                        'degreeCollegePageUrl'  => $degreeCollegePageUrl,
                        'coursePageUrl'         => $allCoursePageUrl,
                        'funcationalAreaUrl'    => $item->functionalareapageslug,
                    );
        }

        $resultDegree = [];
        foreach ($databaseDegree as $key => $oneDegree) {
            if(!empty($oneDegree['id'])){
               $resultDegree[] = $oneDegree; 
            }
        }
        // Means no result were found
        if (empty($resultFuncationalArea) && empty($resultDegree)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseCoursesObj = DB::table('course')
                            ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                            ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                            ->where('course.degree_id','!=', "")
                            ->where('degree.functionalarea_id','!=', "")
                            ->whereRaw('course.name like "%'.$query.'%"')
                            ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('course.id')
                            ->take(10)   
                            ->get()
                            ;

        $databaseCourses = array();
        foreach ($databaseCoursesObj as $item) {
            $courseCollegePageUrl = URL::to('/'.$item->functionalareapageslug.'/'.$item->degreepageslug.'/'.$item->pageslug.'/colleges');
            $databaseCourses[] = array(
                        'id'                    => $item->id,
                        'name'                  => $item->name.' - ('.$item->degreeName.', '.$item->functionalareaName.')',
                        'coursesSlug'           => $item->pageslug,
                        'courseCollegePageUrl'  => $courseCollegePageUrl,
                        'degreeUrl'             => $item->degreepageslug,
                        'funcationalAreaUrl'    => $item->functionalareapageslug,
                    );
        }

        $resultCourses = [];
        foreach ($databaseCourses as $key => $oneCourse) {
            if(!empty($oneCourse['id'])){
               $resultCourses[] = $oneCourse; 
            }
        }

        // Means no result were found
        if (empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses)) {
            $status = false;
        }else{
            $status = true;
        }

        $databaseEducationLevelObj = DB::table('educationlevel')
                            ->whereRaw('educationlevel.name like "%'.$query.'%"')
                            ->select('educationlevel.id','name', 'pageslug')
                            ->orderBy(DB::raw('RAND()'))
                            ->groupBy('educationlevel.id')
                            ->take(20)   
                            ->get()
                            ;

        $databaseEducationLevel = array();
        foreach ($databaseEducationLevelObj as $item) {
            $collegePageUrl = URL::to('/'.$item->pageslug.'/colleges');
            $databaseEducationLevel[] = array(
                        'id'                    => $item->id,
                        'name'                  => $item->name,
                        'pageSlug'              => $item->pageslug,
                        'collegePageUrl'        => $collegePageUrl,
                    );
        }

        $resultEducationLevel = [];
        foreach ($databaseEducationLevel as $key => $oneEduLevel) {
            if(!empty($oneEduLevel['id'])){
               $resultEducationLevel[] = $oneEduLevel; 
            }
        }
        // Means no result were found
        if (empty($resultFuncationalArea) && empty($resultDegree) && empty($resultCourses) && empty($resultEducationLevel) ) {
            $status = false;
        }else{
            $status = true;
        }

        $dataArray = array(
            'status'                    => $status,
            'error'                     => null,
            "functionalarea"            => $resultFuncationalArea,
            "degree"                    => $resultDegree,
            "courses"                   => $resultCourses,
            "educationlevel"            => $resultEducationLevel,
        );           

       return response()->json($dataArray);
    }

    public function getAdsCollegeProfileList(Request $request)
    {
        // $term = (!empty($request->get('q'))) ? strtolower($request->get('q')) : null;
        // if (!isset($term)):
        //     die('Invalid term.');
        // endif;
        $term = Input::get('term');
        $actionType = Input::get('methodTypeId');
        $pageNameId = Input::get('pageNameId');

        $searchQuery = DB::table('users')
                            ->leftJoin('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                            ->leftJoin('gallery', 'users.id', '=', 'gallery.users_id')
                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                            ->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                            ->leftJoin('city', 'address.city_id', '=', 'city.id')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country', 'state.country_id', '=', 'country.id')
                            ->where('collegeprofile.review', '=', '1')
                            ->where('collegeprofile.verified', '=', '1')
                            ->where('users.userstatus_id', '!=', '5')
                            ->where('gallery.misc', '=', 'college-logo-img');

            if(!empty($term)):
                $searchQuery->whereRaw('(MATCH (users.firstname) AGAINST ("'.$term.'"))');
               // $searchQuery->whereRaw('(MATCH (users.firstname) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (degree.name) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (course.name) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (educationlevel.name) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (country.name) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (state.name) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (city.name) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (address.name) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (address.address1) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (address.address2) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE) OR MATCH (address.landmark) AGAINST ("'.$term.'" IN NATURAL LANGUAGE MODE))'); 
                // $searchQuery->whereRaw('users.firstname like "%'.$term.'%"');
            endif;

            $dataObj = [];
            if($actionType == "Functional Area"):
                $searchQuery->where('collegemaster.functionalarea_id', '=', $pageNameId);
            elseif($actionType == "Degree"):
                $searchQuery->where('collegemaster.degree_id', '=', $pageNameId);
            elseif($actionType == "Course"):
                $searchQuery->where('collegemaster.course_id', '=', $pageNameId);
            elseif($actionType == "Education Level"):
                $searchQuery->where('collegemaster.educationlevel_id', '=', $pageNameId);
            elseif($actionType == "City"):
                $searchQuery->where('city.id', '=', $pageNameId);
            elseif($actionType == "State"):
                $searchQuery->where('state.id', '=', $pageNameId);
            elseif($actionType == "Country"):
                $searchQuery->where('country.id', '=', $pageNameId);
            elseif($actionType == "University"):
                $searchQuery->where('collegeprofile.university_id', '=', $pageNameId);
            endif;

            $searchQuery->select('collegeprofile.id','collegeprofile.slug', 'users.firstname', 'users.lastname', 'gallery.name as galleryName', 'city.name as cityName', 'state.name as stateName','country.name as countryName');
            $searchQuery->groupBy('collegeprofile.id');
            $searchQuery->orderBy('collegeprofile.id', DB::raw('RAND()'));

            $databaseCollegeUsersObj    =   $searchQuery->get();

        $status         = true;
        $databaseCollegeUsers  = [];
        $collegelogo    = '';
        foreach ($databaseCollegeUsersObj as $item) {
            if(!empty($item->galleryName)){
                if(file_exists(public_path().'/gallery/'.$item->slug.'/'.$item->galleryName)){
                    $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/gallery/'.$item->slug.'/'.$item->galleryName.'" class="rounded-3x searchimg padding-right5" width="32" height="32">';
                }else{
                    $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/school.png" class="rounded-3x searchimg padding-right5" width="32" height="32">';
                }                          
            }else{
                $collegelogo = '<img style="display: unset !important;width: auto !important;" src="/new-assets/img/school.png" class="rounded-3x searchimg padding-right5" width="32" height="32">';
            }

            $collegeUrl = URL::to('/college/'.$item->slug);
            $databaseCollegeUsers[] = array(
                        'id'            => $item->id,
                        'collegeUrl'    => $collegeUrl,
                        'collegelogo'   => $collegelogo,
                        'collegename'   => $item->firstname.' '.$item->lastname,
                        'collegeplace'  => ucfirst($item->cityName).','.ucfirst($item->countryName),
                    );
        }

        $resultCollgeUsers = [];
        foreach ($databaseCollegeUsers as $key => $collegeUser) {
            if(!empty($collegeUser['id'])){
                $resultCollgeUsers[] = $collegeUser;
            }
        }
    
        if (empty($resultCollgeUsers)) {
            $status = false;
        }else{
            $status = true;
        }

        $dataArray = array(
            'status'                    => $status,
            'error'                     => null,
            "college"                   => $resultCollgeUsers,
        );           

       return response()->json($dataArray);
    }
}
