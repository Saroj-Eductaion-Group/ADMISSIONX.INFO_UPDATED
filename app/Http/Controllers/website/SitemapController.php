<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
use Config;
use Cache;
use Artisan;
use Jenssegers\Agent\Agent;
use App\Models\Subscribe;
use App\Models\FunctionalArea;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Blog;
use App\Models\UserRole;
use App\Models\UserStatus;
use App\User as User;
use App\Models\StudentProfile as StudentProfile;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\CollegeMaster;
use App\Models\WhatWeOffer;
use App\Models\ExamSection;
use App\Models\TypeOfExamination;
use App\Models\CounselingBoardDetail;
use App\Models\CounselingBoard;
use App\Models\CounselingCareerDetail;
use App\Models\CounselingCareerInterest;
use App\Models\CounselingCareerRelevant;
use App\Models\CounselingCoursesDetail;
use App\Models\SeoContent;
use App\Models\CollegeReview;
use App\Models\AskQuestion;
use App\Models\AskQuestionAnswer;
use App\Models\AskQuestionAnswerComment;
use App\Models\AskQuestionTag;
use App\Models\LatestUpdate;
use App\Models\News;
use App\Models\NewsType;
use App\Models\NewsTag;
use App\Http\Controllers\website\WebsiteLogController;
use Illuminate\Database\QueryException as QueryException;
use App\Http\Controllers\Helper\FetchDataServiceController;

class SitemapController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(fetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

    public function sitemap(Request $request)
    {
        $seoSlugName = 'sitemap';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
        if ($request->path() == 'sitemap.html') {
            return response()->view('website/home/sitemap.sitemap-html', [
               // 'cityForAuction'           =>  $cityForAuction,
            ])->header('Content-Type', 'text/html');

        }elseif ($request->path() == 'urllist.txt') {
            return response()->view('website/home/sitemap.urllist', [
               // 'cityForAuction'           =>  $cityForAuction,
            ])->header('Content-Type', 'text/txt');
        }elseif ($request->path() == 'rss.xml') {
            return response()->view('website/home/sitemap.rssxml', [
                //'cityForAuction'           =>  $cityForAuction,
            ])->header('Content-Type', 'text/xml');
        }else{

            return view('website/home/sitemap.sitemap-page',compact('seocontent'));
        }
    }


    public function sitemapXmlAction(Request $request)
    {
        $collegeObj = DB::table('collegeprofile')
                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                ->where('users.userstatus_id', '!=', '5')
                ->count();

        $universityObj  = DB::table('university')->count();
        $askQuestionObj = DB::table('ask_questions')->where('ask_questions.status', '=', '1')->count();
        $reviewObj = DB::table('college_reviews')->count();
        $cityObj =  DB::table('city')
                        ->where('city.cityStatus', '=', 1)
                        //->orWhere('city.totalCollegeByCampusAddress','>',0)
                        //->orWhere('city.totalCollegeRegAddress','>',0)
                        ->count();

        $stateObj =  DB::table('state')
                        //->orWhere('state.totalCollegeByCampusAddress','>',0)
                        //->orWhere('state.totalCollegeRegAddress','>',0)
                        ->count();

        $lastmodDate= date('c'); 
        $collegePageCount = ceil($collegeObj/500);
        $universityPageCount = ceil($universityObj/500);
        $askPageCount = ceil($askQuestionObj/500);
        $reviewPageCount = ceil($reviewObj/100);
        $statePageCount = ceil($stateObj/500);
        $cityPageCount = ceil($cityObj/1000);

        return response()->view('website/home/sitemap.mainsitemapxml', [
            'collegePageCount'          =>  $collegePageCount,
            'universityPageCount'       =>  $universityPageCount,
            'askPageCount'              =>  $askPageCount,
            'reviewPageCount'           =>  $reviewPageCount,
            'lastmodDate'               =>  $lastmodDate,
            'cityPageCount'             =>  $cityPageCount,
            'statePageCount'            =>  $statePageCount,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function websiteXmlAction(Request $request)
    {
        return response()->view('website/home/sitemap.websitexml')->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }

    public function studyAbroadXmlAction(Request $request)
    {   
        $studyAbroadCollegeList = Cache::remember('studyAbroadCollegeList', Config::get('setting.CACHE_LIFE_LIMIT30'), function () {
            return   DB::table('country')
                    ->select('country.id','name','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress','country.updated_at')
                    ->orderBy('totalCollegeRegAddress', 'Desc')
                    ->get();
        });

        return response()->view('website/home/sitemap.study-abroad-xml', [
            'studyAbroadCollegeList'  =>  $studyAbroadCollegeList,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }

    public function universityXmlAction(Request $request, $slug)
    {   
        $urlFor = (explode("-", $slug));
        $urlFor1 = (explode(".", $urlFor[1]));
        $setlimit = 500;
        $offsetVal = ($urlFor1[0]-1)*500;
        $getUniversityInfoObj =  DB::table('university')
                ->select('university.id','name','pageslug','university.updated_at')
                ->orderBy('university.name', 'ASC')
                ->groupBy('university.id')
                ->skip($offsetVal)
                ->take($setlimit)
                ->get();

        return response()->view('website/home/sitemap.university-sitemap-xml', [
            'getUniversityInfoObj' =>  $getUniversityInfoObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }

    public function educationLevelCollegeListXmlAction(Request $request)
    {   
        $getEducationLevelObj = Cache::remember('getEducationLevelObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('educationlevel')->get(); });

        return response()->view('website/home/sitemap.education-level-college-list-xml', [
            'getEducationLevelObj' =>  $getEducationLevelObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }
    
    public function streamCollegeListXmlAction(Request $request)
    {   
        $functionalareaList = Cache::remember('functionalareaList', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('functionalarea')->get(); });

        return response()->view('website/home/sitemap.stream-college-list-xml', [
            'functionalareaList' =>  $functionalareaList,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }

    public function degreeCollegeListXmlAction(Request $request)
    {   
        $streamDegreeList = Cache::remember('streamDegreeList', Config::get('setting.CACHE_LIFE_LIMIT30'), function () {
            return   DB::table('degree')
                    ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                    ->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug','degree.updated_at')
                    ->orderBy('degree.id', 'ASC')
                    ->get();
        });

        return response()->view('website/home/sitemap.degree-college-list-xml', [
            'streamDegreeList' =>  $streamDegreeList,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }

    public function coursesCollegeListXmlAction(Request $request)
    {   
        $streamDegreeCourseList = Cache::remember('streamDegreeCourseList', Config::get('setting.CACHE_LIFE_LIMIT30'), function () {
            return   DB::table('course')
                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                    ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug','course.updated_at')
                    ->orderBy('course.id', 'ASC')
                    ->get();
        });

        return response()->view('website/home/sitemap.course-college-list-xml', [
            'streamDegreeCourseList' =>  $streamDegreeCourseList,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }

    public function streamListXmlAction(Request $request)
    {   
        $functionalareaList = Cache::remember('functionalareaList', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('functionalarea')->get(); });


        return response()->view('website/home/sitemap.stream-list-xml', [
            'functionalareaList'             =>  $functionalareaList,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function degreeListXmlAction(Request $request)
    {   
        $streamDegreeList = Cache::remember('streamDegreeList', Config::get('setting.CACHE_LIFE_LIMIT30'), function () {
            return   DB::table('degree')
                    ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                    ->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug','degree.updated_at')
                    ->orderBy('degree.id', 'ASC')
                    ->get();
        });

        return response()->view('website/home/sitemap.degree-list-xml', [
            'streamDegreeList'             =>  $streamDegreeList,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function examinationXmlAction(Request $request)
    {   
        $listOfExamSection = ExamSection::orderBy('exam_sections.name', 'ASC')
                ->leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                ->where('exam_sections.status', '=', '1')
                ->select('exam_sections.id','exam_sections.name','slug','exam_sections.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                ->get();

        
        $typesOfExamination = TypeOfExamination::orderBy('type_of_examinations.id', 'ASC')
                            ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                            ->leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                            ->where('type_of_examinations.status', '=', '1')
                            ->select('sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.name as examsectionName' ,'exam_sections.slug as examsectionSlug','type_of_examinations.updated_at')
                            ->get();


        $examListMultipleDegreeObj = DB::table('exam_list_multiple_degrees')
                ->leftjoin('exam_sections', 'exam_list_multiple_degrees.examsection_id', '=', 'exam_sections.id')
                ->leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                ->select('degree.id as degreeId','degree.name as degreeName','degreeSlug','exam_sections.name as examsectionName' ,'exam_sections.slug as examsectionSlug','exam_list_multiple_degrees.updated_at')
                ->orderBy('degree.name', 'ASC')
                ->groupBy('degree.id')
                ->get()
                ;

        return response()->view('website/home/sitemap.examination-xml', [
            'listOfExamSection'              =>  $listOfExamSection,
            'typesOfExamination'              =>  $typesOfExamination,
            'examListMultipleDegreeObj'              =>  $examListMultipleDegreeObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function careersOpportunitiesXmlAction(Request $request)
    {   
        $functionalAreaObj = DB::table('counseling_career_interests')
                                ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                                ->select('functionalarea.name','pageslug','counseling_career_interests.updated_at')
                                ->orderBy('counseling_career_interests.id', 'ASC')
                                ->groupBy('functionalarea_id')
                                ->get();

        $counselingcareerinterests = CounselingCareerInterest::orderBy('counseling_career_interests.id', 'DESC')
                ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                ->where('counseling_career_interests.status', '=', '1')
                ->select('counseling_career_interests.id', 'title', 'description', 'image', 'status', 'functionalarea_id', 'slug','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','functionalarea.pageslug')
                ->get();


        $counselingCareerRelevant = CounselingCareerRelevant::orderBy('counseling_career_relevants.id', 'DESC')
                                    ->leftjoin('counseling_career_interests', 'counseling_career_relevants.careerInterest', '=', 'counseling_career_interests.id')
                                    ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                                    ->where('counseling_career_relevants.status', '=', '1')
                                    ->select('counseling_career_relevants.id',  'counseling_career_relevants.slug','counseling_career_relevants.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','functionalarea.pageslug')
                                    ->get();
        
            

        return response()->view('website/home/sitemap.careers-opportunities-xml', [
            'functionalAreaObj'              =>  $functionalAreaObj,
            'counselingcareerinterests'      =>  $counselingcareerinterests,
            'counselingCareerRelevant'       =>  $counselingCareerRelevant,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function popularCareersXmlAction(Request $request)
    {   
         $popularCareeerlist      = CounselingCareerDetail::orderBy('counseling_career_details.id', 'DESC')
                                    ->where('counseling_career_details.status', '=', '1')
                                    ->where('counseling_career_details.functionalarea_id', '=', null)
                                    ->where('counseling_career_details.careerRelevantId', '=', null)
                                    ->select('counseling_career_details.id','title','slug','updated_at')
                                    ->get();
            

        return response()->view('website/home/sitemap.popular-careers-xml', [
            'popularCareeerlist'              =>  $popularCareeerlist,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function careersCoursesXmlAction(Request $request)
    {   
        $counselingCoursesObj = DB::table('counseling_courses_education_levels')
            ->leftjoin('eligibility_criterias', 'counseling_courses_education_levels.educationlevel_id', '=', 'eligibility_criterias.id')
            ->leftjoin('counseling_courses_details', 'counseling_courses_education_levels.coursesDetailsId', '=', 'counseling_courses_details.id')
            ->leftjoin('functionalarea', 'counseling_courses_details.functionalarea_id', '=', 'functionalarea.id')
            ->select('counseling_courses_details.id', 'title', 'image','counseling_courses_details.slug','counseling_courses_details.employee_id','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','educationLevelSlug')
            ->orderBy('counseling_courses_education_levels.id', 'ASC')
            ->get();

        return response()->view('website/home/sitemap.careers-courses-xml', [
            'counselingCoursesObj'           =>  $counselingCoursesObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function boardsXmlAction(Request $request)
    {   
        $nationalBoards = CounselingBoard::orderBy('counseling_boards.id', 'DESC')
                            ->leftjoin('counseling_board_details', 'counseling_boards.id', '=', 'counseling_board_details.counselingBoardId')
                            ->where('counseling_boards.misc', '=', 'National')
                            ->where('counseling_boards.status', '=', 1)
                            ->select('counseling_boards.id','counseling_boards.name','counseling_boards.slug','counseling_boards.updated_at')
                            ->get();

        $stateBoards    = CounselingBoard::orderBy('counseling_boards.id', 'DESC')
                            ->leftjoin('counseling_board_details', 'counseling_boards.id', '=', 'counseling_board_details.counselingBoardId')
                            ->where('counseling_boards.misc', '=', 'State')
                            ->where('counseling_boards.status', '=', 1)
                            ->select('counseling_boards.id','counseling_boards.name','counseling_boards.slug','counseling_boards.updated_at')
                            ->get();

        return response()->view('website/home/sitemap.boards-xml', [
            'nationalBoards'            =>  $nationalBoards,
            'stateBoards'               =>  $stateBoards,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }
    
    public function blogXmlAction(Request $request)
    {   
        $getBlogsObj = Cache::remember('getBlogsObj', Config::get('setting.CACHE_LIFE_LIMIT30'), function () {
            return   DB::table('blogs')
                ->where('blogs.isactive', '=', '1')
                ->select('blogs.id', 'blogs.topic', 'blogs.slug', 'blogs.created_at as createdDate')
                ->get()
                ;   
        });

        return response()->view('website/home/sitemap.blog-xml', [
            'getBlogsObj'              =>  $getBlogsObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function newsXmlAction(Request $request)
    {   
        $getNewsObj = Cache::remember('getNewsObj', Config::get('setting.CACHE_LIFE_LIMIT30'), function () {
            return   DB::table('news')
                ->where('news.isactive', '=', '1')
                ->select('news.id', 'news.topic', 'news.slug', 'news.created_at as createdDate')
                ->get()
                ;   
        });


        $getCategoryNewsObj = DB::table('news_types')
                    ->orderBy('news_types.id','ASC')
                    ->select('id','name','slug','updated_at')
                    ->get()
                    ;

        $getAllTagNewsObj = DB::table('news_tags')
                    ->orderBy('news_tags.id','ASC')
                    ->select('id','name','slug','updated_at')
                    ->get()
                    ;
        
        return response()->view('website/home/sitemap.news-xml', [
            'getNewsObj'              =>  $getNewsObj,
            'getCategoryNewsObj'      =>  $getCategoryNewsObj,
            'getAllTagNewsObj'        =>  $getAllTagNewsObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function collegeXmlAction(Request $request, $slug)
    {   
        $urlFor = (explode("-", $slug));
        $urlFor1 = (explode(".", $urlFor[1]));
        $setlimit = 500;
        $offsetVal = ($urlFor1[0]-1)*500;
        $collegeObj =  DB::table('collegeprofile')
                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                ->leftJoin('gallery', 'users.id', '=', 'gallery.users_id')
                ->where('collegeprofile.review', '=', '1')
                ->where('collegeprofile.verified', '=', '1')
                ->where('users.userstatus_id', '!=', '5')
                ->where('users.userrole_id', '=', '2')
                ->where('gallery.misc', '=', 'college-logo-img')
                ->where('gallery.name', '<>', "")
                ->select('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug','collegeprofile.updated_at', DB::raw('(SELECT COUNT(college_faqs.id) FROM college_faqs WHERE college_faqs.collegeprofile_id = collegeprofile.id) AS faqCount'), DB::raw('(SELECT COUNT(college_reviews.id) FROM college_reviews WHERE college_reviews.collegeprofile_id = collegeprofile.id) AS reviewCount'), DB::raw('(SELECT COUNT(college_admission_procedures.id) FROM college_admission_procedures WHERE college_admission_procedures.collegeprofile_id = collegeprofile.id) AS admissionProcedureCount'), DB::raw('(SELECT COUNT(faculty.id) FROM faculty WHERE faculty.collegeprofile_id = collegeprofile.id) AS facultyCount'))
                ->orderBy('users.firstname', 'ASC')
                ->groupBy('users.id')
                ->skip($offsetVal)
                ->take($setlimit)
                ->get();



        return response()->view('website/home/sitemap.college-sitemap-xml', [
            'collegeObj'             =>  $collegeObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function askTagXmlAction(Request $request)
    {   
        $getAllAskTagObj = DB::table('ask_question_tags')
                    ->orderBy('ask_question_tags.id','ASC')
                    ->select('id','name','slug','updated_at')
                    ->get()
                    ;

        return response()->view('website/home/sitemap.ask-tag-sitemap-xml', [
            'getAllAskTagObj'             =>  $getAllAskTagObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function askXmlAction(Request $request, $slug)
    {   
        $urlFor = (explode("-", $slug));
        $urlFor1 = (explode(".", $urlFor[1]));
        $setlimit = 500;
        $offsetVal = ($urlFor1[0]-1)*500;
        $askQuestionObj =  DB::table('ask_questions')
                ->where('ask_questions.status', '=', 1)
                ->select('ask_questions.id','ask_questions.slug','ask_questions.updated_at')
                ->orderBy('ask_questions.id', 'DESC')
                ->groupBy('ask_questions.id')
                ->skip($offsetVal)
                ->take($setlimit)
                ->get();

        return response()->view('website/home/sitemap.ask-sitemap-xml', [
            'askQuestionObj'             =>  $askQuestionObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function reviewsXmlAction(Request $request, $slug)
    {   
        $urlFor = (explode("-", $slug));
        $urlFor1 = (explode(".", $urlFor[1]));
        $setlimit = 100;
        $offsetVal = ($urlFor1[0]-1)*100;
        $listOfSubmitReviews =  DB::table('college_reviews')
                ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                ->select('college_reviews.id','college_reviews.title', 'college_reviews.description', 'college_reviews.votes', 'college_reviews.academic', 'college_reviews.accommodation', 'college_reviews.faculty', 'college_reviews.infrastructure', 'college_reviews.placement', 'college_reviews.social', 'college_reviews.guestUserId', 'college_reviews.users_id', 'college_reviews.collegeprofile_id', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug as collegeSlug','college_reviews.created_at','studentprofile.slug as studentSlug')
                ->orderBy('college_reviews.id', 'Desc')
                ->groupBy('collegeprofile.id')
                ->skip($offsetVal)
                ->take($setlimit)
                ->get();

        return response()->view('website/home/sitemap.reviews-sitemap-xml', [
            'listOfSubmitReviews'             =>  $listOfSubmitReviews,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }


    public function stateWiseCollegeListXmlAction(Request $request)
    {   
        $stateListObj = Cache::remember('stateListObj', Config::get('setting.CACHE_LIFE_LIMIT30'), function () {
            return   DB::table('state')
                    ->leftJoin('country','state.country_id','=','country.id')
                    //->orWhere('state.totalCollegeByCampusAddress','>',0)
                    //->orWhere('state.totalCollegeRegAddress','>',0)
                    ->select('state.id','state.name','state.pageslug','state.updated_at','country.pageslug as countrySlug')
                    ->orderBy('state.totalCollegeRegAddress', 'Desc')
                    ->get();
        });

        return response()->view('website/home/sitemap.state-wise-college-sitemap-xml', [
            'stateListObj' =>  $stateListObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }

    public function cityWiseCollegeListXmlAction(Request $request, $slug)
    {   
        $urlFor = (explode("-", $slug));
        $urlFor1 = (explode(".", $urlFor[1]));
        $setlimit = 1000;
        $offsetVal = ($urlFor1[0]-1)*1000;
        $cityListObj =  DB::table('city')
                    ->leftJoin('state','city.state_id','=','state.id')
                    ->leftJoin('country','state.country_id','=','country.id')
                    ->where('city.cityStatus', '=', 1)
                    //->orWhere('city.totalCollegeByCampusAddress','>',0)
                    //->orWhere('city.totalCollegeRegAddress','>',0)
                    ->select('city.name as cityName','city.pageslug','city.updated_at','state.pageslug as stateSlug','country.pageslug as countrySlug')
                    ->orderBy('city.totalCollegeRegAddress', 'Desc')
                    ->skip($offsetVal)
                    ->take($setlimit)
                    ->get();

        return response()->view('website/home/sitemap.city-wise-college-sitemap-xml', [
            'cityListObj'             =>  $cityListObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }

    public function countryWiseStateListXmlAction(Request $request)
    {   
        $countryWiseStateListObj = Cache::remember('countryWiseStateListObj', Config::get('setting.CACHE_LIFE_LIMIT30'), function () {
            return   DB::table('country')
                    ->select('country.id','name','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress','country.updated_at')
                    ->orderBy('totalCollegeRegAddress', 'Desc')
                    ->get();
        });

        return response()->view('website/home/sitemap.country-wise-state-sitemap-xml', [
            'countryWiseStateListObj' =>  $countryWiseStateListObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');
    }

    public function stateWiseCityListXmlAction(Request $request, $slug)
    {   
        $urlFor = (explode("-", $slug));
        $urlFor1 = (explode(".", $urlFor[1]));
        $setlimit = 500;
        $offsetVal = ($urlFor1[0]-1)*500;
        $stateWiseCityListObj =  DB::table('state')
                    ->leftJoin('country','state.country_id','=','country.id')
                    //->orWhere('state.totalCollegeByCampusAddress','>',0)
                    //->orWhere('state.totalCollegeRegAddress','>',0)
                    ->select('state.id','state.name','state.pageslug','state.updated_at','country.pageslug as countrySlug')
                    ->orderBy('state.totalCollegeRegAddress', 'Desc')
                    ->skip($offsetVal)
                    ->take($setlimit)
                    ->get();

        return response()->view('website/home/sitemap.state-wise-cities-sitemap-xml', [
            'stateWiseCityListObj'             =>  $stateWiseCityListObj,
        ])->header('Content-Type', 'text/xml', 'charset', 'ISO-8859-1');

    }
}