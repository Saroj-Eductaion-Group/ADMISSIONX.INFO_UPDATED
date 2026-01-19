<?php

namespace App\Http\Controllers\Helper;

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
use Config;
use PHPMailer;
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
use App\Models\CollegeReview;
use App\Models\ExamCounsellingForm;
use Illuminate\Database\QueryException as QueryException;
use Artisan;
use App\Models\LandingPageQueryForm;

class FetchDataServiceController extends Controller
{
    public function listOfBoardStateDetails($misc)
    {
        $listOfBoardStateDetails = Cache::remember('listOfBoardStateDetails', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 

            return  CounselingBoard::orderBy('counseling_boards.id', 'DESC')
                        ->where('counseling_boards.misc', '=', "State")
                        ->where('counseling_boards.status', '=', 1)
                        ->select('counseling_boards.id','counseling_boards.name','counseling_boards.slug')
                        ->get();
        });

        return $listOfBoardStateDetails;
    }

    public function listOfBoardNationalDetails($misc)
    {
        $listOfBoardNationalDetails = Cache::remember('listOfBoardNationalDetails', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 

            return  CounselingBoard::orderBy('counseling_boards.id', 'DESC')
                        ->where('counseling_boards.misc', '=', "National")
                        ->where('counseling_boards.status', '=', 1)
                        ->select('counseling_boards.id','counseling_boards.name','counseling_boards.slug')
                        ->get();
        });

        return $listOfBoardNationalDetails;
    }

    public function listOfCareerCourses($status)
    {
        $listOfCareerCourses = Cache::remember('listOfCareerCourses', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            $internalQuery = DB::table('counseling_courses_education_levels')
                                ->leftjoin('eligibility_criterias', 'counseling_courses_education_levels.educationlevel_id', '=', 'eligibility_criterias.id')
                                ->select('eligibility_criterias.name','educationlevel_id','educationLevelSlug')
                                ->orderBy('counseling_courses_education_levels.id', 'ASC')
                                ->groupBy('educationlevel_id')
                                ->get();
            foreach ($internalQuery as $key => $value) {
                $value->counselingCoursesObj = DB::table('counseling_courses_education_levels')
                    ->leftjoin('counseling_courses_details', 'counseling_courses_education_levels.coursesDetailsId', '=', 'counseling_courses_details.id')
                    ->leftjoin('functionalarea', 'counseling_courses_details.functionalarea_id', '=', 'functionalarea.id')
                    ->select('counseling_courses_details.id', 'title','slug','functionalarea.name as functionalAreaName')
                    ->where('counseling_courses_education_levels.educationlevel_id', '=', $value->educationlevel_id)
                    ->orderBy('counseling_courses_education_levels.id', 'ASC')
                    ->get();
            }
            return $internalQuery;
        });
        return $listOfCareerCourses;
    }

    public function listOfPopularCareer($status)
    {   
        $popularCareeerlist = Cache::remember('popularCareeerlist', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            return  CounselingCareerDetail::orderBy('counseling_career_details.id', 'DESC')
                        ->where('counseling_career_details.status', '=', '1')
                        ->where('counseling_career_details.functionalarea_id', '=', null)
                        ->where('counseling_career_details.careerRelevantId', '=', null)
                        ->select('counseling_career_details.id','title', 'image','slug','description')
                        ->take(15)
                        ->get();

        });

        return $popularCareeerlist;
    }

    public function listOfCareerStream($status)
    {
        $functionalAreaObj = Cache::remember('functionalAreaObj', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            return  DB::table('counseling_career_interests')
                            ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                            ->select('functionalarea.name')
                            ->orderBy('counseling_career_interests.id', 'ASC')
                            ->groupBy('functionalarea_id')
                            ->get();

        });

        foreach ($functionalAreaObj as $key => $value) {
            $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($value->name)); 
            $slug = strtolower(trim($cleanChar));
            $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
            $slug = preg_replace('/-+/', "-", $slug);
            rtrim($slug, '-');
            $value->slug = $slug;
        }

        return $functionalAreaObj;
    }

    public function listOfExamination()
    {
        $listOfExamination = Cache::remember('listOfExamination', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            $isShowOnTop = "if(exam_sections.isShowOnTop = 1, 1,2) as isShowOnTop";
            $internalQuery =  ExamSection::leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                ->where('exam_sections.status', '=', '1')
                ->select('exam_sections.id','exam_sections.name', 'title', 'slug','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName', DB::raw('(SELECT COUNT(type_of_examinations.examsection_id) FROM type_of_examinations WHERE type_of_examinations.examsection_id = exam_sections.id and type_of_examinations.status = 1) AS examCount'),'exam_sections.isShowOnTop','exam_sections.isShowOnHome', DB::Raw($isShowOnTop))
                ->having('examCount', '>', 0)
                ->orderBy('exam_sections.isShowOnTop', 'DESC')
                ->orderBy('exam_sections.name', 'ASC')
                ->take(12)
                ->get();

            foreach ($internalQuery as $key => $value) {
                $isShowOnTopMenu = "if(type_of_examinations.isShowOnTop = 1, 1,2) as isShowOnTop";
                $value->listofexamination = TypeOfExamination::where('type_of_examinations.status', '=', '1')
                                    ->where('type_of_examinations.examsection_id', '=', $value->id)
                                    ->select('type_of_examinations.id','sortname', 'name', 'status', 'slug','employee_id','universitylogo','universityName','university_id','examsection_id','functionalarea_id','isShowOnTop','isShowOnHome', DB::Raw($isShowOnTopMenu))
                                    ->orderBy('type_of_examinations.isShowOnTop', 'DESC')
                                    ->orderBy('type_of_examinations.id', 'DESC')
                                    ->take(12)
                                    ->get();


                $value->examListMultipleDegreeObj = DB::table('exam_list_multiple_degrees')
                        ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                        ->select('degree.id as degreeId','degree.name as degreeName','degreeSlug')
                        ->where('exam_list_multiple_degrees.examsection_id', '=', $value->id)
                        ->orderBy('degree.name', 'ASC')
                        ->groupBy('degree.id')
                        ->take(12)
                        ->get()
                        ;
            }

            return $internalQuery;
        });

        /*$hTMLBlock = '';
           
        
        $hTMLBlock .= '<div class="row">';
            $hTMLBlock .= '<div class="col-md-12 dropdownNavTabMain">';
                $hTMLBlock .= '<ul class="nav nav-pills dropdownNavTab">';
                    foreach( $listOfExamination as $key => $item ):
                        $hTMLBlock .= '<li style="line-height: 30px !important;" class="@if($key == 0) active @endif"> <a style="font-size: 12px !important;" href="#tabExam'.$key.'" data-toggle="tab">'.$item->name.' Exams</a>';
                        $hTMLBlock .= '</li>';
                    endforeach;
                $hTMLBlock .= '</ul>';
                $hTMLBlock .= '<div class="tab-content well dropdownNavTabContent">';
                foreach( $listOfExamination as $key => $item ):
                    if ($key == 0) {
                        $hTMLBlock .= '<div class="tab-pane active" id="tabExam'.$key.'">';
                    }else{
                        $hTMLBlock .= '<div class="tab-pane" id="tabExam'.$key.'">';

                    }
                        $hTMLBlock .= '<div class="col-md-6">';
                            $hTMLBlock .= '<div class="dropdownNavTabContentBot">';
                                $hTMLBlock .= '<ul>';
                                    $hTMLBlock .= '<li style="color: red; line-height: 25px;">Exam List</li>';
                                    foreach( $item->listofexamination as $item1 ):
                                    $hTMLBlock .= '<li style="line-height: 25px; font-size: 13px;"><a href="/examination-details/'.$item->slug.'/'.$item1->slug.'">'.$item1->sortname.'</a></li>';
                                    endforeach;
                                    $hTMLBlock .= '<li><a class="submenutext" href="/examination-list/'.$item->slug.'"><i class="fa fa-arrow-left" aria-hidden="true"></i> All '.$item->name.' Exams</a></li>';
                                    $hTMLBlock .= '<li><a class="submenutext" href="/examination"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Examination</a></li>';
                                $hTMLBlock .= '</ul>';
                            $hTMLBlock .= '</div>';
                        $hTMLBlock .= '</div>';
                        $hTMLBlock .= '<div class="col-md-6">';
                            $hTMLBlock .= '<div class="dropdownNavTabContentBot">';
                                $hTMLBlock .= '<ul>';
                                    $hTMLBlock .= '<li style="color: red; line-height: 25px;">Stream</li>';
                                    foreach($item->examListMultipleDegreeObj as $key2 => $item2):
                                    $hTMLBlock .= '<li style="line-height: 25px; font-size: 13px;"><a href="/examination-list/'.$item->slug.'/'.$item2->degreeSlug.'">'. $item2->degreeName .'</a></li>';
                                    endforeach;
                                $hTMLBlock .= '</ul>';
                            $hTMLBlock .= '</div>';
                        $hTMLBlock .= '</div>';
                    $hTMLBlock .= '</div>';
                endforeach;
                $hTMLBlock .= '</div>';
            $hTMLBlock .= '</div>';
        $hTMLBlock .= '</div>';

        session(['is_open_popup_window_status' => $hTMLBlock]);*/

        return  $listOfExamination;
    }

    public function listOfStudyAbroad($status)
    {
        $listOfStudyAbroad = Cache::remember('listOfStudyAbroad', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            $isShowOnTop = "if(country.isShowOnTop = 1 , 1,2) as isShowOnTop";
            $query = DB::table('country')->where('totalCollegeRegAddress', '>', 0); 
            $query->where('country.id', '!=', 99);
            $query->select('country.id','name','pageslug','logoimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress', DB::Raw($isShowOnTop));
            $query->groupBy('country.id');
            $query->orderBy('isShowOnTop', 'ASC');
            $query->orderBy('totalCollegeRegAddress', 'DESC');
            $query->take(12);
            $internalQuery = $query->get();
            foreach ($internalQuery as $key => $value) {
                $value->getFunctionalAreaObj = DB::table('functionalarea')->orderBy(DB::raw('RAND()'))->take(12)->get();
                $value->getAllStateObj = DB::table('state')->where('totalCollegeRegAddress', '>', 0)->where('state.country_id', '=', $value->id)->orderBy(DB::raw('RAND()'))->take(12)->get();
            }
            return $internalQuery;
        });
        return $listOfStudyAbroad;
    }

    public function listOfEngineering($id)
    {
        $listOfEngineering = Cache::remember('listOfEngineering', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            
            $isShowOnTop = "if(degree.isShowOnTop = 1 , 1,2) as isShowOnTop";
            $query = DB::table('degree')->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id'); 
            //$query->where('functionalarea.id', '=', 1);
            $query->whereIN('functionalarea.id', [1,37]);
            $query->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTop), 'degree.functionalarea_id');
            $query->groupBy('degree.id');
            $query->orderBy('isShowOnTop', 'ASC');
            $query->take(12);
            $internalQuery = $query->get();
            foreach ($internalQuery as $key => $value) {
                $isShowOnTopCourse = "if(course.isShowOnTop = 1 , 1,2) as isShowOnTop";
                $value->courseList = DB::table('course')
                                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id') 
                                    ->where('functionalarea.id', '=', $value->functionalarea_id)
                                    ->where('course.degree_id', '=', $value->id)
                                    ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::raw('(SELECT COUNT(collegemaster.collegeprofile_id) FROM collegemaster WHERE collegemaster.course_id = course.id) AS totalCollegeCount'), DB::Raw($isShowOnTopCourse))
                                    ->groupBy('course.id')
                                    ->orderBy('course.isShowOnTop', 'DESC')
                                    ->orderBy('totalCollegeCount', 'DESC')
                                    ->take(12)
                                    ->get();
            }
            return $internalQuery;
        });
        return $listOfEngineering;
    }

    public function listOfManagement($id)
    {
        $listOfManagement = Cache::remember('listOfManagement', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            
            $isShowOnTop = "if(degree.isShowOnTop = 1 , 1,2) as isShowOnTop";
            $query = DB::table('degree')->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id'); 
            //$query->where('functionalarea.id', '=', 6);
            $query->whereIN('functionalarea.id', [6,7]);
            $query->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTop), 'degree.functionalarea_id');
            $query->groupBy('degree.id');
            $query->orderBy('isShowOnTop', 'ASC');
            $query->take(12);
            $internalQuery = $query->get();
            foreach ($internalQuery as $key => $value) {
                $isShowOnTopCourse = "if(course.isShowOnTop = 1 , 1,2) as isShowOnTop";
                $value->courseList = DB::table('course')
                                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id') 
                                    ->where('functionalarea.id', '=', $value->functionalarea_id)
                                    ->where('course.degree_id', '=', $value->id)
                                    ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::raw('(SELECT COUNT(collegemaster.collegeprofile_id) FROM collegemaster WHERE collegemaster.course_id = course.id) AS totalCollegeCount'), DB::Raw($isShowOnTopCourse))
                                    ->groupBy('course.id')
                                    ->orderBy('course.isShowOnTop', 'DESC')
                                    ->orderBy('totalCollegeCount', 'DESC')
                                    ->take(12)
                                    ->get();
            }
            return $internalQuery;
        });
        return $listOfManagement;
    }

    public function listOfMedical($id)
    {
        $listOfMedical = Cache::remember('listOfMedical', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            $internalQuery = DB::table('functionalarea')
                            ->whereIN('functionalarea.id', [9,10,11,12,13,21,22,23,30,46])
                            ->select('functionalarea.id','functionalarea.name','pageslug')
                            ->orderBy('functionalarea.name', 'ASC')
                            ->get();

            foreach ($internalQuery as $key => $value) {
                $isShowOnTopCourse = "if(course.isShowOnTop = 1 , 1,2) as isShowOnTop";
                $value->courseList = DB::table('course')
                                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id') 
                                    ->where('functionalarea.id', '=', $value->id)
                                    ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::raw('(SELECT COUNT(collegemaster.collegeprofile_id) FROM collegemaster WHERE collegemaster.course_id = course.id) AS totalCollegeCount'), DB::Raw($isShowOnTopCourse))
                                    ->groupBy('course.id')
                                    ->orderBy('course.isShowOnTop', 'DESC')
                                    ->orderBy('totalCollegeCount', 'DESC')
                                    ->take(12)
                                    ->get();

                $isShowOnTopDegree = "if(degree.isShowOnTop = 1 , 1,2) as isShowOnTop";
                $value->degreeList = DB::table('degree')
                                        ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                                        ->where('functionalarea.id', '=', $value->id)
                                        ->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTopDegree))
                                        ->orderBy('degree.isShowOnTop', 'DESC')
                                        ->orderBy(DB::raw('RAND()'))
                                        ->take(12)
                                        ->get();
            }
            return $internalQuery;
        });
        return $listOfMedical;
    }

    public function listOfMoreStream($id)
    {
        $listOfMoreStream = Cache::remember('listOfMoreStream', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            $internalQuery = DB::table('functionalarea')
                            //->whereIN('functionalarea.id', [2,3,4,5,8,14,15,16,17,19,36])
                            ->whereIN('functionalarea.id', [2,3,4,5,8,14,15,16,17,18,19,20,26,31,35,37,36,41])
                            //->whereNotIN('functionalarea.id', [1,37,6,7,9,10,11,12,13,21,22,23,30,46])
                            ->select('functionalarea.id','functionalarea.name','pageslug')
                            ->orderBy('functionalarea.name', 'ASC')
                            ->get();

            foreach ($internalQuery as $key => $value) {
                $isShowOnTopCourse = "if(course.isShowOnTop = 1 , 1,2) as isShowOnTop";
                $value->courseList = DB::table('course')
                                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id') 
                                    ->where('functionalarea.id', '=', $value->id)
                                    ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::raw('(SELECT COUNT(collegemaster.collegeprofile_id) FROM collegemaster WHERE collegemaster.course_id = course.id) AS totalCollegeCount'), DB::Raw($isShowOnTopCourse))
                                    ->groupBy('course.id')
                                    ->orderBy('course.isShowOnTop', 'DESC')
                                    ->orderBy('totalCollegeCount', 'DESC')
                                    ->take(12)
                                    ->get();

                $isShowOnTopDegree = "if(degree.isShowOnTop = 1 , 1,2) as isShowOnTop";
                $value->degreeList = DB::table('degree')
                                        ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                                        ->where('functionalarea.id', '=', $value->id)
                                        ->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug','functionalarea.id as functionalareaId', DB::Raw($isShowOnTopDegree))
                                        ->orderBy('degree.isShowOnTop', 'DESC')
                                        ->orderBy(DB::raw('RAND()'))
                                        ->take(12)
                                        ->get();
            }
            return $internalQuery;
        });
        return $listOfMoreStream;
    }

    public function seoContentCreateUpdate($id, $requestData)
    {
        if (!empty(Input::get('seoContentId'))) {
            $setSlug = SeoContent::where('id', '=', Input::get('seoContentId'))->firstOrFail();
            $seoContentObj = SeoContent::findOrFail(Input::get('seoContentId'));
            $seoContentObj->pagetitle = Input::get('seopagetitle');

            if (!empty(Input::get('seoDescription'))) {
                $seoContentObj->description = Input::get('seoDescription');
            }else{
                $seoContentObj->description = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seokeyword'))) {
                $seoContentObj->keyword = Input::get('seokeyword');
            }else{
                $seoContentObj->keyword = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seoh1title'))) {
                $seoContentObj->h1title = Input::get('seoh1title');
            }else{
                $seoContentObj->h1title = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seoh2title'))) {
                $seoContentObj->h2title = Input::get('seoh2title');
            }else{
                $seoContentObj->h2title = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seoh3title'))) {
                $seoContentObj->h3title = Input::get('seoh3title');
            }else{
                $seoContentObj->h3title = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seoimagealttext'))) {
                $seoContentObj->imagealttext = Input::get('seoimagealttext');
            }else{
                $seoContentObj->imagealttext = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seocontent'))) {
                $seoContentObj->content = Input::get('seocontent');
            }else{
                $seoContentObj->content = Input::get('seopagetitle');
            }

            $seoContentObj->canonical = Input::get('seocanonical');
            //$seoContentObj->misc = str_slug(Input::get('seopagetitle'), "-");

            if (Input::get('seopagename') == "boardpage") {
               $seoContentObj->boardId = $id;
            }elseif (Input::get('seopagename') == "contentpage"){
                $seoContentObj->pageId = $id;
            }elseif (Input::get('seopagename') == "blogpage"){
                $seoContentObj->blogId = $id;
            }elseif (Input::get('seopagename') == "collegepage"){
                $seoContentObj->collegeId = $id;
            }elseif (Input::get('seopagename') == "studentpage"){
                $seoContentObj->userId = $id;
            }elseif (Input::get('seopagename') == "examinationpage"){
                $seoContentObj->examId = $id;
            }elseif (Input::get('seopagename') == "careerreleventpage"){
                $seoContentObj->careerReleventId = $id;
            }elseif (Input::get('seopagename') == "popularcareerpage"){
                $seoContentObj->popularCareerId = $id;
            }elseif (Input::get('seopagename') == "coursepage"){
                $seoContentObj->courseId = $id;
            }elseif (Input::get('seopagename') == "examsectionpage"){
                $seoContentObj->examSectionId = $id;
            }elseif (Input::get('seopagename') == "educationlevelpage"){
                $seoContentObj->educationLevelId = $id;
            }elseif (Input::get('seopagename') == "degreepage"){
                $seoContentObj->degreeId = $id;
            }elseif (Input::get('seopagename') == "functionalareapage"){
                $seoContentObj->functionalAreaId = $id;
            }elseif (Input::get('seopagename') == "topcoursepage"){
                $seoContentObj->topCourseId = $id;
            }elseif (Input::get('seopagename') == "universitypage"){
                $seoContentObj->universityId = $id;
            }elseif (Input::get('seopagename') == "countrypage"){
                $seoContentObj->countryId = $id;
            }elseif (Input::get('seopagename') == "statepage"){
                $seoContentObj->stateId = $id;
            }elseif (Input::get('seopagename') == "citypage"){
                $seoContentObj->cityId = $id;
            }elseif (Input::get('seopagename') == "newspage"){
                $seoContentObj->newsId = $id;
            }elseif (Input::get('seopagename') == "newstagpage"){
                $seoContentObj->newsTagId = $id;
            }elseif (Input::get('seopagename') == "newstypepage"){
                $seoContentObj->newsTypeId = $id;
            }elseif (Input::get('seopagename') == "askquestionpage"){
                $seoContentObj->askQuestionId = $id;
            }elseif (Input::get('seopagename') == "asktagpage"){
                $seoContentObj->askTagId = $id;
            }
            
            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('seopagetitle').' '.Input::get('seoContentId'));
            $slugUrl = strtolower($slugUrl);
            $slugUrlOld = $setSlug->slugurl;

            $seoContentObj->slugurl = $slugUrl;
            $seoContentObj->employee_id = Auth::id();
            $seoContentObj->save();

            if(Input::file('seoimage')){
                $fileName1 = 'seo-image-'.Input::get('seoContentId').".".Input::file('seoimage')->getClientOriginalExtension();
        
                Input::file('seoimage')->move(public_path('/seo-content/'), $fileName1);

                DB::table('seo_contents')->where('seo_contents.id', '=', Input::get('seoContentId'))->update(array('seo_contents.image' => $fileName1));
            }
        }else{
            $seoContentObj = New SeoContent();
            $seoContentObj->pagetitle = Input::get('seopagetitle');

            if (!empty(Input::get('seoDescription'))) {
                $seoContentObj->description = Input::get('seoDescription');
            }else{
                $seoContentObj->description = Input::get('seopagetitle');
            }
            
            if (!empty(Input::get('seokeyword'))) {
                $seoContentObj->keyword = Input::get('seokeyword');
            }else{
                $seoContentObj->keyword = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seoh1title'))) {
                $seoContentObj->h1title = Input::get('seoh1title');
            }else{
                $seoContentObj->h1title = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seoh2title'))) {
                $seoContentObj->h2title = Input::get('seoh2title');
            }else{
                $seoContentObj->h2title = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seoh3title'))) {
                $seoContentObj->h3title = Input::get('seoh3title');
            }else{
                $seoContentObj->h3title = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seoimagealttext'))) {
                $seoContentObj->imagealttext = Input::get('seoimagealttext');
            }else{
                $seoContentObj->imagealttext = Input::get('seopagetitle');
            }

            if (!empty(Input::get('seocontent'))) {
                $seoContentObj->content = Input::get('seocontent');
            }else{
                $seoContentObj->content = Input::get('seopagetitle');
            }

            $seoContentObj->canonical = Input::get('seocanonical');
            
            //$seoContentObj->slugurl = str_slug(Input::get('seopagetitle'), "-");

            if (Input::get('seopagename') == "boardpage") {
               $seoContentObj->boardId = $id;
               $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "contentpage"){
                $seoContentObj->pageId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "blogpage"){
                $seoContentObj->blogId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "collegepage"){
                $seoContentObj->collegeId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "studentpage"){
                $seoContentObj->userId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "examinationpage"){
                $seoContentObj->examId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "careerreleventpage"){
                $seoContentObj->careerReleventId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "popularcareerpage"){
                $seoContentObj->popularCareerId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "coursepage"){
                $seoContentObj->courseId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "examsectionpage"){
                $seoContentObj->examSectionId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "educationlevelpage"){
                $seoContentObj->educationLevelId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "degreepage"){
                $seoContentObj->degreeId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "functionalareapage"){
                $seoContentObj->functionalAreaId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "topcoursepage"){
                $seoContentObj->topCourseId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "universitypage"){
                $seoContentObj->universityId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "countrypage"){
                $seoContentObj->countryId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "statepage"){
                $seoContentObj->stateId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "citypage"){
                $seoContentObj->cityId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "newspage"){
                $seoContentObj->newsId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "newstagpage"){
                $seoContentObj->newsTagId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "newstypepage"){
                $seoContentObj->newsTypeId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "askquestionpage"){
                $seoContentObj->askQuestionId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }elseif (Input::get('seopagename') == "asktagpage"){
                $seoContentObj->askTagId = $id;
                $seoContentObj->misc = str_slug(Input::get('seopagename'), "-");
            }else{
                $seoContentObj->misc = str_slug(Input::get('seopagetitle'), "-");
            }
            $seoContentObj->employee_id = Auth::id();

            $seoContentObj->save();

            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('seopagetitle').' '.$seoContentObj->id);
            $slugUrl = strtolower($slugUrl);
            $seoContentObj->slugurl = $slugUrl;
            $seoContentObj->save();

            if(Input::file('seoimage')){
                $fileName1 = 'seo-image-'.$seoContentObj->id.".".Input::file('seoimage')->getClientOriginalExtension();
        
                Input::file('seoimage')->move(public_path('/seo-content/'), $fileName1);

                DB::table('seo_contents')->where('seo_contents.id', '=', $seoContentObj->id)->update(array('seo_contents.image' => $fileName1));
            }else{

            }
        }

        if(empty($seoContentObj->image)){
            if (Input::get('seopagename') == "boardpage") {
                $counselingBoardDetail = DB::table('counseling_board_details')
                               ->where('counselingBoardId', '=', $id)
                               ->select('id')
                               ->orderBy('id','DESC')
                               ->get();
                if (sizeof($counselingBoardDetail) > 0) {
                    if (!empty($counselingBoardDetail[0]->image)) {
                        $file_tmp1 = public_path().'/counselingimages/'.$counselingBoardDetail[0]->image;
                        if (file_exists($file_tmp1) && !empty($counselingBoardDetail[0]->image)) {
                            $fileWithExtensionNew = 'seo-image-'.$seoContentObj->id.'-'.$counselingBoardDetail[0]->image;

                            $dirPath = public_path().'/seo-content/';
                            $uploadPath = $dirPath.$fileWithExtensionNew;
                            copy($file_tmp1, $uploadPath);

                            $updateObj = SeoContent::findOrFail($seoContentObj->id);
                            $updateObj->image= $fileWithExtensionNew;
                            $updateObj->save();
                        }
                    }
                }
            }elseif (Input::get('seopagename') == "contentpage"){
                
            }elseif (Input::get('seopagename') == "blogpage"){
                $blogObj = Blog::findOrFail($id);
                if (!empty($blogObj->fullimage)) {
                    $file_tmp1 = public_path().'/blogs/'.$blogObj->fullimage;
                    if (file_exists($file_tmp1) && !empty($blogObj->fullimage)) {
                        $fileWithExtensionNew = 'seo-image-'.$seoContentObj->id.'-'.$blogObj->fullimage;

                        $dirPath = public_path().'/seo-content/';
                        $uploadPath = $dirPath.$fileWithExtensionNew;
                        copy($file_tmp1, $uploadPath);

                        $updateObj = SeoContent::findOrFail($seoContentObj->id);
                        $updateObj->image= $fileWithExtensionNew;
                        $updateObj->save();
                    }
                }               
            }elseif (Input::get('seopagename') == "collegepage"){
                $collegeProfileObj = DB::table('collegeprofile')
                                    ->leftJoin('gallery','collegeprofile.users_id','=','gallery.users_id')
                                    ->where('collegeprofile.id', '=', $id)
                                    ->where('gallery.caption', '=', 'College Logo')
                                    ->select('collegeprofile.slug','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage')
                                    ->orderBy('gallery.id', 'DESC')
                                    ->take(1)
                                    ->get();

                if (sizeof($collegeProfileObj) > 0) {
                    if (!empty($collegeProfileObj[0]->galleryFullImage)) {
                        $file_tmp1 = public_path().'/gallery/'.$collegeProfileObj[0]->slug.'/'.$collegeProfileObj[0]->galleryFullImage;
                        if (file_exists($file_tmp1) && !empty($collegeProfileObj[0]->galleryFullImage)) {
                            $fileWithExtensionNew = 'seo-image-'.$seoContentObj->id.'-'.$collegeProfileObj[0]->galleryFullImage;

                            $dirPath = public_path().'/seo-content/';
                            $uploadPath = $dirPath.$fileWithExtensionNew;
                            copy($file_tmp1, $uploadPath);

                            $updateObj = SeoContent::findOrFail($seoContentObj->id);
                            $updateObj->image= $fileWithExtensionNew;
                            $updateObj->save();
                        }
                    }
                }
            }elseif (Input::get('seopagename') == "examinationpage"){
                $typeOfExaminationObj = TypeOfExamination::findOrFail($id);
                if (!empty($typeOfExaminationObj->universitylogo)) {
                    $file_tmp1 = public_path().'/examinationlogo/'.$typeOfExaminationObj->universitylogo;
                    if (file_exists($file_tmp1) && !empty($typeOfExaminationObj->universitylogo)) {
                        $fileWithExtensionNew = 'seo-image-'.$seoContentObj->id.'-'.$typeOfExaminationObj->universitylogo;

                        $dirPath = public_path().'/seo-content/';
                        $uploadPath = $dirPath.$fileWithExtensionNew;
                        copy($file_tmp1, $uploadPath);

                        $updateObj = SeoContent::findOrFail($seoContentObj->id);
                        $updateObj->image= $fileWithExtensionNew;
                        $updateObj->save();
                    }
                }
            }elseif (Input::get('seopagename') == "careerreleventpage"){
                $counselingCareerDetailObj = CounselingCareerDetail::orderBy('counseling_career_details.id' ,'DESC')
                            ->where('counseling_career_details.careerRelevantId','=', $id)
                            ->select('id')
                            ->get();

                if (sizeof($counselingCareerDetailObj) > 0) {
                    if (!empty($counselingCareerDetailObj[0]->image)) {
                        $file_tmp1 = public_path().'/counselingimages/'.$counselingCareerDetailObj[0]->image;
                        if (file_exists($file_tmp1) && !empty($counselingCareerDetailObj[0]->image)) {
                            $fileWithExtensionNew = 'seo-image-'.$seoContentObj->id.'-'.$counselingCareerDetailObj[0]->image;

                            $dirPath = public_path().'/seo-content/';
                            $uploadPath = $dirPath.$fileWithExtensionNew;
                            copy($file_tmp1, $uploadPath);

                            $updateObj = SeoContent::findOrFail($seoContentObj->id);
                            $updateObj->image= $fileWithExtensionNew;
                            $updateObj->save();
                        }
                    }
                }
            }elseif (Input::get('seopagename') == "popularcareerpage"){
                $counselingCareerDetailObj = CounselingCareerDetail::findOrFail($id);
                if (!empty($counselingCareerDetailObj->image)) {
                    $file_tmp1 = public_path().'/counselingimages/'.$counselingCareerDetailObj->image;
                    if (file_exists($file_tmp1) && !empty($counselingCareerDetailObj->image)) {
                        $fileWithExtensionNew = 'seo-image-'.$seoContentObj->id.'-'.$counselingCareerDetailObj->image;

                        $dirPath = public_path().'/seo-content/';
                        $uploadPath = $dirPath.$fileWithExtensionNew;
                        copy($file_tmp1, $uploadPath);

                        $updateObj = SeoContent::findOrFail($seoContentObj->id);
                        $updateObj->image= $fileWithExtensionNew;
                        $updateObj->save();
                    }
                }
            }elseif (Input::get('seopagename') == "coursepage"){
                $counselingCoursesDetailObj = CounselingCoursesDetail::findOrFail($id);
                if (!empty($counselingCoursesDetailObj->image)) {
                    $file_tmp1 = public_path().'/counselingimages/'.$counselingCoursesDetailObj->image;
                    if (file_exists($file_tmp1) && !empty($counselingCoursesDetailObj->image)) {
                        $fileWithExtensionNew = 'seo-image-'.$seoContentObj->id.'-'.$counselingCoursesDetailObj->image;

                        $dirPath = public_path().'/seo-content/';
                        $uploadPath = $dirPath.$fileWithExtensionNew;
                        copy($file_tmp1, $uploadPath);

                        $updateObj = SeoContent::findOrFail($seoContentObj->id);
                        $updateObj->image= $fileWithExtensionNew;
                        $updateObj->save();
                    }
                }
            }elseif (Input::get('seopagename') == "examsectionpage"){
                $examSectionObj = ExamSection::findOrFail($id);
                if (!empty($examSectionObj->iconImage)) {
                    $file_tmp1 = public_path().'/examinationicon/'.$examSectionObj->iconImage;
                    if (file_exists($file_tmp1) && !empty($examSectionObj->iconImage)) {
                        $fileWithExtensionNew = 'seo-image-'.$seoContentObj->id.'-'.$examSectionObj->iconImage;

                        $dirPath = public_path().'/seo-content/';
                        $uploadPath = $dirPath.$fileWithExtensionNew;
                        copy($file_tmp1, $uploadPath);

                        $updateObj = SeoContent::findOrFail($seoContentObj->id);
                        $updateObj->image= $fileWithExtensionNew;
                        $updateObj->save();
                    }
                }
            }
        }

        Artisan::call('cache:clear');
        return true;  
    }

    public function seoContentDetailsById($whereConditionCol, $misc, $refId)
    {   
        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $checkSEOMisc = DB::table('seo_contents')
            ->select('id', 'canonical')
            ->where('seo_contents.'.$whereConditionCol, '=', $refId)
            ->where('seo_contents.misc', '=', $misc)
            ->orderBy('seo_contents.id', 'DESC')
            ->take(1)
            ->get();

        if (sizeof($checkSEOMisc) > 0) {
            if(empty($checkSEOMisc[0]->canonical)):
                DB::statement(DB::raw("UPDATE seo_contents SET seo_contents.canonical='".$actual_link."' WHERE seo_contents.id='".$checkSEOMisc[0]->id."'"));   
            elseif($checkSEOMisc[0]->canonical != $actual_link):
                DB::statement(DB::raw("UPDATE seo_contents SET seo_contents.canonical='".$actual_link."' WHERE seo_contents.id='".$checkSEOMisc[0]->id."'"));
            endif;

            $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                ->findOrFail($checkSEOMisc[0]->id, array('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext','content'));

        }else{
            $seocontent = [];
        }

        return $seocontent;
    }

    public function seoContentDetailsByMisc($misc)
    {   
        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $checkSEOMisc = DB::table('seo_contents')
                        ->select('id', 'canonical')
                        ->where('misc', '=', $misc)
                        ->orderBy('seo_contents.id', 'DESC')
                        ->take(1)
                        ->get();
        if (sizeof($checkSEOMisc) > 0) {
            if(empty($checkSEOMisc[0]->canonical)):
                DB::statement(DB::raw("UPDATE seo_contents SET seo_contents.canonical='".$actual_link."' WHERE seo_contents.id='".$checkSEOMisc[0]->id."'"));   
            elseif($checkSEOMisc[0]->canonical != $actual_link):
                DB::statement(DB::raw("UPDATE seo_contents SET seo_contents.canonical='".$actual_link."' WHERE seo_contents.id='".$checkSEOMisc[0]->id."'"));
            endif;
            
            $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                ->findOrFail($checkSEOMisc[0]->id, array('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext','content'));

        }else{
            $seocontent = [];
        }

        return $seocontent;
    }

    public function fetchSeoContentDetailsById($id)
    {   
        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $checkSEOMisc = DB::table('seo_contents')
            ->select('id', 'canonical')
            ->where('seo_contents.id', '=', $id)
            ->orderBy('seo_contents.id', 'DESC')
            ->take(1)
            ->get()
            ;
        if (sizeof($checkSEOMisc) > 0) {
            if(empty($checkSEOMisc[0]->canonical)):
                DB::statement(DB::raw("UPDATE seo_contents SET seo_contents.canonical='".$actual_link."' WHERE seo_contents.id='".$checkSEOMisc[0]->id."'"));   
            elseif($checkSEOMisc[0]->canonical != $actual_link):
                DB::statement(DB::raw("UPDATE seo_contents SET seo_contents.canonical='".$actual_link."' WHERE seo_contents.id='".$checkSEOMisc[0]->id."'"));
            endif;

            $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                ->findOrFail($checkSEOMisc[0]->id, array('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext','content'));
        }else{
            $seocontent = [];
        }

        return $seocontent;
    }

    public function pageContentDetailsById($contentcategoryId)
    {   
       $getPageContentDataObj = DB::table('contents')
                        ->leftjoin('contentcategory', 'contents.contentcategory_id', '=', 'contentcategory.id')
                        ->where('contents.contentcategory_id', '=', $contentcategoryId)
                        ->where('contents.status', '=', '1')
                        ->select('contents.id','contents.title', 'contents.description', 'contents.status','contentcategory.name as contentcategoryName','contentslug')
                        ->get()
                        ;

        return $getPageContentDataObj;
    }

    public function layoutCall()
    {
        if(Auth::check()):
            if( Auth::user()->userrole_id == '1'):
                $layouts =    "administrator/admin-layouts.master";
            elseif( Auth::user()->userrole_id == '4'):
                $layouts =    "employee/admin-layouts.master";
            endif;
            return $layouts;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
    }

    public function routeCall()
    {
        if(Auth::check()):
            if( Auth::user()->userrole_id == '1'):
                $routeslug =    "administrator";
            elseif( Auth::user()->userrole_id == '4'):
                $routeslug =    "employee";
            endif;
            return $routeslug;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
    }

    public function validateUserRoleCall($tableName)
    {
        $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', Auth::id())
                                ->where('alltableinformations.name', '=', $tableName)
                                ->where('userprivileges.index', '=', '1')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get();

        return $validateUserRoleAction;
    }

    public function updateNewFields($modelName, $tableName, $id, $requestData, $imageTitle)
    {
        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('name'));
        $slugUrl = strtolower($slugUrl);

        $model_name                                   = '\\App\\Models\\'.$modelName;
        $updateSaleObj                                =  $model_name::findOrFail($id);
        $updateSaleObj->pagetitle                     =  Input::get('pagetitle');
        $updateSaleObj->pagedescription               =  Input::get('pagedescription');
        $updateSaleObj->isShowOnTop                   =  Input::get('isShowOnTop');
        $updateSaleObj->isShowOnHome                  =  Input::get('isShowOnHome');
        $updateSaleObj->pageslug                      =  $slugUrl;

        
        $updateSaleObj->save();
        //Update lOGO Images & Banner Image
        if(Input::file('logoimage')){
            $logoimage = time().'-'.$imageTitle.'-'.$id.".".Input::file('logoimage')->getClientOriginalExtension();
            
            Input::file('logoimage')->move(public_path('/common-logo/'), $logoimage);

            DB::table($tableName)->where($tableName.'.id', '=', $id)->update(array($tableName.'.logoimage' => $logoimage));
        } 

        if(Input::file('bannerimage')){
            $bannerimage = time().'-'.$imageTitle.'-'.$id.".".Input::file('bannerimage')->getClientOriginalExtension();
            
            Input::file('bannerimage')->move(public_path('/common-banner/'), $bannerimage);

            DB::table($tableName)->where($tableName.'.id', '=', $id)->update(array($tableName.'.bannerimage' => $bannerimage));
        } 
        return true;
    }

    public function fetchNewUpdatedFields($modelName, $tableName, $id)
    {
        $model_name                                   = '\\App\\Models\\'.$modelName;
        $newUpdatedFields                             =  $model_name::findOrFail($id);
        return $newUpdatedFields;
    }

    public function isShowOnHome(Request $request)
    {
        $status = Input::get('currentStatus');
        $tablename = Input::get('tablename');
        $id = Input::get('id');
        DB::statement(DB::raw("UPDATE $tablename SET isShowOnHome=".Input::get('currentStatus')." WHERE id=".Input::get('id').""));
        Artisan::call('cache:clear');
        return response()->json(['code' => 200, 'response' => 'success']);
    }

    public function isShowOnTop(Request $request)
    {
        $status = Input::get('currentStatus');
        $tablename = Input::get('tablename');
        $id = Input::get('id');
        DB::statement(DB::raw("UPDATE $tablename SET isShowOnTop=".Input::get('currentStatus')." WHERE id=".Input::get('id').""));
        Artisan::call('cache:clear');
        return response()->json(['code' => 200, 'response' => 'success']);
    }

    public function updateTableSlug($tableName)
    {   
        // This function used by (Country, State, City, Course, Degree, Education Level, Functional Area & University only)
        $getAllListObj  = DB::table($tableName)->orderBy('id', 'DESC')->get();

        foreach (array_chunk($getAllListObj,100) as $totalList ) {
            foreach ($totalList as $key => $value) {
                $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $value->name);
                $slugUrl = strtolower($slugUrl);

                DB::statement(DB::raw("UPDATE $tableName SET pageslug='".$slugUrl."' WHERE id=".$value->id.""));
            }
        }
        print_r($tableName .' slug has been updated'); die;
        return true;
    }


    static public function updateCollegeAddress($addressType, $collegeProfileId)
    {   
        if (($addressType == 1) && (!empty($collegeProfileId)))  {
            $collegeRegisteredAddress = DB::table('address')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->where('address.collegeprofile_id', '=', $collegeProfileId)
                        ->where('address.addresstype_id','=', 1)
                        ->select('address.name as addressName','address.address1','address.address2','address.postalcode','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName','country.id as countryId','country.name as countryName')
                        ->get();

            foreach ($collegeRegisteredAddress as $key1 => $value1) {
                if(!empty($value1->addressName)){ 
                    $com_addressName = $value1->addressName.',';
                }else{
                    $com_addressName = '';
                }

                if(!empty($value1->address1)){ 
                    $com_address1 = $value1->address1;
                }else{
                    $com_address1 = '';
                }
                
                if(!empty($value1->address2)) { 
                    $com_address2 = ','. $value1->address2; 
                } else{
                    $com_address2 = '';
                }
                if(!empty($value1->landmark)) { 
                    $com_landmark = ','. $value1->landmark; 
                } else{
                    $com_landmark = '';
                }
                if(!empty($value1->cityName)) { 
                    $com_cityName = ','. $value1->cityName;
                    $sort_cityName = $value1->cityName;
                } else{
                    $com_cityName = '';
                    $sort_cityName = '';
                }
                if(!empty($value1->stateName)) { 
                    $com_stateName = ','. $value1->stateName; 
                    $sort_stateName = ','. $value1->stateName; 
                }else{
                    $com_stateName = '';
                    $sort_stateName = '';
                }
                if(!empty($value1->countryName)) { 
                    $com_countryName = ','. $value1->countryName; 
                    $sort_countryName = ','. $value1->countryName; 
                } else{
                    $com_countryName = '';
                    $sort_countryName = '';
                }
                if(!empty($value1->postalcode)){ 
                    $com_postalcode = $value1->postalcode; 
                }else{
                    $com_postalcode = '';
                }

                $registeredFullAddress = $com_addressName.' '.$com_address1.' '.$com_address2.' '.$com_cityName.' '.$com_stateName.' '.$com_countryName.' '.$com_postalcode;

                if(!empty($value1->cityId)) { 
                    $registeredSortAddress =  $sort_cityName.' '.$sort_stateName.' '.$sort_countryName;
                } else{
                    $registeredSortAddress = null;
                }

                $updateCollegeProfileObj = CollegeProfile::findOrFail($collegeProfileId);
                $updateCollegeProfileObj->registeredFullAddress = $registeredFullAddress;
                $updateCollegeProfileObj->registeredSortAddress = $registeredSortAddress;
                $updateCollegeProfileObj->registeredAddressCityId = $value1->cityId;
                $updateCollegeProfileObj->registeredAddressStateId = $value1->stateId;
                $updateCollegeProfileObj->registeredAddressCountryId = $value1->countryId;
                $updateCollegeProfileObj->save();
            }
        }

        if (($addressType == 2) && (!empty($collegeProfileId)))  {
            $collegeCampusAddress = DB::table('address')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->where('address.collegeprofile_id', '=', $collegeProfileId)
                        ->where('address.addresstype_id','=','2')
                        ->select('address.name as addressName','address.address1','address.address2','address.postalcode','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName','country.id as countryId','country.name as countryName')
                        ->get();

            foreach ($collegeCampusAddress as $key2 => $value2) {
                if(!empty($value2->addressName)){ 
                    $com_addressName = $value2->addressName.',';
                }else{
                    $com_addressName = '';
                }

                if(!empty($value2->address1)){ 
                    $com_address1 = $value2->address1;
                }else{
                    $com_address1 = '';
                }
                
                if(!empty($value2->address2)) { 
                    $com_address2 = ','. $value2->address2; 
                } else{
                    $com_address2 = '';
                }
                if(!empty($value2->landmark)) { 
                    $com_landmark = ','. $value2->landmark; 
                } else{
                    $com_landmark = '';
                }
                if(!empty($value2->cityName)) { 
                    $com_cityName = ','. $value2->cityName;
                    $sort_cityName = $value2->cityName;
                } else{
                    $com_cityName = '';
                    $sort_cityName = '';
                }
                if(!empty($value2->stateName)) { 
                    $com_stateName = ','. $value2->stateName; 
                    $sort_stateName = ','. $value2->stateName; 
                }else{
                    $com_stateName = '';
                    $sort_stateName = '';
                }
                if(!empty($value2->countryName)) { 
                    $com_countryName = ','. $value2->countryName; 
                    $sort_countryName = ','. $value2->countryName; 
                } else{
                    $com_countryName = '';
                    $sort_countryName = '';
                }
                if(!empty($value2->postalcode)){ 
                    $com_postalcode = $value2->postalcode; 
                }else{
                    $com_postalcode = '';
                }

                $campusFullAddress = $com_addressName.' '.$com_address1.' '.$com_address2.' '.$com_cityName.' '.$com_stateName.' '.$com_countryName.' '.$com_postalcode;

                if(!empty($value2->cityId)) { 
                    $campusSortAddress =  $sort_cityName.' '.$sort_stateName.' '.$sort_countryName;
                } else{
                    $campusSortAddress = null;
                }

                $updateCollegeProfileObj = CollegeProfile::findOrFail($collegeProfileId);
                $updateCollegeProfileObj->campusFullAddress = $campusFullAddress;
                $updateCollegeProfileObj->campusSortAddress = $campusSortAddress;
                $updateCollegeProfileObj->campusAddressCityId = $value2->cityId;
                $updateCollegeProfileObj->campusAddressStateId = $value2->stateId;
                $updateCollegeProfileObj->campusAddressCountryId = $value2->countryId;
                $updateCollegeProfileObj->save();
            }
        }

        return true;
    }

    public function listOfSubmitReviewsAction(Request $request, $userroleslug, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' || $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $query = CollegeReview::orderBy('college_reviews.id', 'DESC')
                        ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                        ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id');
   
                if ($userroleslug == 'student') {
                    $query->where('college_reviews.guestUserId', '=', $userId);
                    $query->where('studentprofile.slug', '=', $slug);
                }elseif($userroleslug == 'college'){
                    $query->where('collegeprofile.users_id', '=', $userId);
                    $query->where('collegeprofile.slug', '=', $slug);
                }

                $listOfSubmitReviews = $query->paginate(15, array('college_reviews.id','college_reviews.title', 'college_reviews.description', 'college_reviews.votes', 'college_reviews.academic', 'college_reviews.accommodation', 'college_reviews.faculty', 'college_reviews.infrastructure', 'college_reviews.placement', 'college_reviews.social', 'college_reviews.guestUserId', 'college_reviews.users_id', 'college_reviews.collegeprofile_id', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug as collegeSlug','college_reviews.created_at','studentprofile.slug as studentSlug'));

                $collegeRatingObj = self::fetchCollegeRating($slug);

                // $totalAcademic = $totalAccommodation = $totalFaculty = $totalInfrastructure = $totalPlacement = $totalSocial = $totalLikes = $totalDislike = 0;
                // if(sizeof($collegeRatingObj) > 0):
                //     $totalAcademic          = round(($collegeRatingObj[0]->totalAcademic), 2);
                //     $totalAccommodation     = round(($collegeRatingObj[0]->totalAccommodation), 2);
                //     $totalFaculty           = round(($collegeRatingObj[0]->totalFaculty), 2);
                //     $totalInfrastructure    = round(($collegeRatingObj[0]->totalInfrastructure), 2);
                //     $totalPlacement         = round(($collegeRatingObj[0]->totalPlacement), 2);
                //     $totalSocial            = round(($collegeRatingObj[0]->totalSocial), 2);
                // endif;    
                // $value->totalAcademic       = $totalAcademic;
                // $value->totalAccommodation  = $totalAccommodation;
                // $value->totalFaculty        = $totalFaculty;
                // $value->totalInfrastructure = $totalInfrastructure;
                // $value->totalPlacement      = $totalPlacement;
                // $value->totalSocial         = $totalSocial;

                return view('common-partials.submit-reviews-partial', compact('listOfSubmitReviews','userroleslug','slug','collegeRatingObj'));
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

     /************************************************************************************
    *   STORE COLLEGE REVIEW FORMS
    /************************************************************************************/
    public function collegeReviewFormsStore(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();
                $collegeReviewObj = DB::table('college_reviews')
                        ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                        ->where('college_reviews.users_id', '=', $collegeProfileObj->users_id)
                        ->where('college_reviews.collegeprofile_id', '=', $collegeProfileObj->id)
                        ->where('college_reviews.guestUserId', '=', $userId)
                        ->select('college_reviews.id','studentprofile.slug')
                        ->orderBy('college_reviews.id', 'DESC')
                        ->get();

                $title                          = Input::get('title');
                $description                    = Input::get('description');
                $votes                          = Input::get('votes');
                $academic                       = Input::get('academic');
                $accommodation                  = Input::get('accommodation');
                $faculty                        = Input::get('faculty');
                $infrastructure                 = Input::get('infrastructure');
                $placement                      = Input::get('placement');
                $social                         = Input::get('social');

                self::submitCollegeReview($slug, $userId, $title, $description, $academic, $accommodation, $faculty, $infrastructure, $placement, $social);
                if (sizeof($collegeReviewObj) > 0) {
                    Session::flash('flash_message', 'Your review has already been submitted, I have updated again!');
                    Session::flash('alert_class', 'alert-info');
                    $urlRedirect = url().'/student/review-forms/'.$collegeReviewObj[0]->slug.'/edit/'.$collegeReviewObj[0]->id;
                    return Redirect::to($urlRedirect);
                }

                Session::flash('collegeReviews', 'Your reviews been submitted successfully!');
                return Redirect::back();
            }elseif( $roleGrant->userrole_id != '3'){
                Session::flash('collegeReviews', 'This feature is only available for students account.'); 
                return Redirect::back();
            }else{
                Session::flash('collegeReviews', 'Please login & fill this form. This feature is only available for students account!'); 
                return Redirect::back();
            }
        }else{
            Session::flash('collegeReviews', 'Please login & fill this form. This feature is only available for students account!'); 
            return Redirect::back();
            // Auth::logout();
            // return Redirect::to('login');
        }        
    }

    public function submitCollegeReview($slug, $userId, $title, $description, $votes, $academic, $accommodation, $faculty, $infrastructure, $placement, $social)
    {
        $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();

        $collegeReviewObj = DB::table('college_reviews')
                        ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                        ->where('college_reviews.users_id', '=', $collegeProfileObj->users_id)
                        ->where('college_reviews.collegeprofile_id', '=', $collegeProfileObj->id)
                        ->where('college_reviews.guestUserId', '=', $userId)
                        ->select('college_reviews.id','studentprofile.slug')
                        ->orderBy('college_reviews.id', 'DESC')
                        ->get();

        if (sizeof($collegeReviewObj) > 0) {
            $create                                 = CollegeReview::findOrFail($collegeReviewObj[0]->id); 
        }else{
            $create                                 = New CollegeReview; 
        }
            $create->title                          = $title;
            $create->description                    = $description;
            $create->votes                          = $votes;
            $create->academic                       = $academic;
            $create->accommodation                  = $accommodation;
            $create->faculty                        = $faculty;
            $create->infrastructure                 = $infrastructure;
            $create->placement                      = $placement;
            $create->social                         = $social;
            $create->collegeprofile_id              = $collegeProfileObj->id;
            $create->users_id                       = $collegeProfileObj->users_id;
            $create->guestUserId                    = $userId;
            $create->employee_id                    = $userId;
            $create->save();

        $userDetailsObj = User::orderBy('users.id' ,'DESC')
                ->where('users.id','=',$userId)
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->first();

        $collegeDetailsObj = User::orderBy('users.id' ,'DESC')
                ->where('users.id','=',$collegeProfileObj->users_id)
                ->select('users.id','email','firstname','middlename','lastname')
                ->first();

        $collegeName            = $collegeDetailsObj->firstname;
        $collegeEmail           = $collegeDetailsObj->email;
        $userName               = $userDetailsObj->fullname;
        $userEmail              = $userDetailsObj->email;
        $collegeUrl             = env('APP_URL').'/college/'.$slug;
        $collegeReviewUrl       = env('APP_URL').'/college/'.$slug.'/reviews';

        $votesLike = "";
        if ($votes == 1) {
            $votesLike = "Like";
        }else if ($votes == 2) {
            $votesLike = "Dislike";
        }
        
        $bodyContent    =   '<p><b>User Details :</b></p>
                            <ul>
                                <li>User Name : '.$userName.'</li>
                                <li>Email : '.$userEmail.'</li>
                            </ul>
                            <p><b>Review Details :</b></p>
                            <ul>
                                <li>Title               : '.$title.'</li>
                                <li>Vote                : '.$votesLike.'</li>
                                <li>Academic            : '.$academic.'</li>
                                <li>Accommodation       : '.$accommodation.'</li>
                                <li>Faculty             : '.$faculty.'</li>
                                <li>Infrastructure      : '.$infrastructure.'</li>
                                <li>Placement           : '.$placement.'</li>
                                <li>Social              : '.$social.'</li>
                                <li>Description         : '.$description.'</li>
                                <li>College Name        : '.$collegeName.'</li>
                                <li>College URL         : '.$collegeUrl.'</li>
                                <li>List Of Reviews     : '.$collegeReviewUrl.'</li>
                            </ul>';

        $send_to = $userEmail;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $userName;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

        $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
                ->where('users.userstatus_id','=', '1')
                ->where('users.userrole_id','=', '1')
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->get();

        $slug1 = 'submit_college_review';
        foreach ($getTheEmailAdmin as $key => $value) {
            $fullname1 = $value->fullname;
            $send_to1 = $value->email;
            $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
            $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        }

        $array2   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($collegeEmail, $slug1, $array2);


        $msg = 'Your reviews been submitted successfully!';
        
        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return true;
    }

     /************************************************************************************
    *   STORE COLLEGE REVIEW FORMS
    /************************************************************************************/
    public function counsellingFormSubmit(Request $request)
    {
        $name                           = Input::get('name');
        $email                          = Input::get('email');
        $phone                          = Input::get('phone');
        $misc                           = Input::get('misc');
        $city_id                        = Input::get('city_id');
        $course_id                      = Input::get('course_id');
        $exam_id                        = Input::get('exam_id');
        $isResponse                     = 1;
        $isResponseMethod               = 1;
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                self::counsellingFormStore($userId, $name, $email, $phone, $misc, $city_id, $course_id, $exam_id, $isResponse, $isResponseMethod);

                Session::flash('counsellingForm', 'Your counselling form has been submitted successfully!. One of our representatives will be in contact with you shortly regarding your inquiry.');
                return Redirect::back();
            }elseif( $roleGrant->userrole_id != '3'){
                self::counsellingSession($name, $email, $phone, $misc, $city_id, $course_id, $exam_id, $isResponse, $isResponseMethod);
                Session::flash('counsellingForm', 'This feature is only available for students account.'); 
                return Redirect::back();
            }else{
                self::counsellingSession($name, $email, $phone, $misc, $city_id, $course_id, $exam_id, $isResponse, $isResponseMethod);
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
                Session::flash('pleaseVierfyYourEmail', 'Please login & fill this form. This feature is only available for students account!'); 
                //return Redirect::back();
            }
        }else{
            self::counsellingSession($name, $email, $phone, $misc, $city_id, $course_id, $exam_id, $isResponse, $isResponseMethod);
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
            Session::flash('pleaseVierfyYourEmail', 'Please login & fill this form. This feature is only available for students account!'); 
            //return Redirect::back();
        }        
    }

    public function counsellingSession($name, $email, $phone, $misc, $city_id, $course_id, $exam_id, $isResponse, $isResponseMethod)
    {
        Session::set('examFormUserName', $name);
        Session::set('examFormUserEmail', $email);
        Session::set('examFormUserPhone', $phone);
        Session::set('examFormUserMisc', $misc);
        Session::set('examFormUserCity', $city_id);
        Session::set('examFormUserCourse', $course_id);
        Session::set('examFormUserExam', $exam_id);
        Session::set('examFormUserIsResponse', $isResponse);
        Session::set('examFormUserIsResponseMethod', $isResponseMethod);
        Session::set('isUserPost', 9);
    }

    public function counsellingFormStore($userId, $name, $email, $phone, $misc, $city_id, $course_id, $exam_id, $isResponse, $isResponseMethod)
    {
        $create                                 = New ExamCounsellingForm; 
        $create->name                           = $name;
        $create->email                          = $email;
        $create->phone                          = $phone;
        $create->misc                           = $misc;
        $create->city_id                        = $city_id;
        $create->course_id                      = $course_id;
        $create->exam_id                        = $exam_id;
        $create->isResponse                     = $isResponse;
        $create->isResponseMethod               = $isResponseMethod;
        $create->users_id                       = $userId;
        $create->employee_id                    = $userId;
        $create->save();

        $cityObj =  City::where('id', '=' , $city_id)->firstOrFail();
        $courseObj = DB::table('course')
                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                    ->where('course.id','=', $course_id)
                    ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                    ->orderBy('course.name','ASC')
                    ->get();

        if (sizeof($courseObj) > 0) {
            $courseName = $courseObj[0]->name.' ('.$courseObj[0]->degreeName.', '.$courseObj[0]->functionalareaName.')';
        }else{
            $courseName = "";
        }

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
            ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
            ->where('type_of_examinations.id','=', $exam_id)
            ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as examinationSlug') 
            ->first();

        $examinationName = $typeOfExaminationObj->sortname.' - '.$typeOfExaminationObj->name;
        $examinationUrl = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->examinationSlug.'/'.$typeOfExaminationObj->slug;

        $bodyContent    =   '<ul>
                                <li>Name                : '.$create->name.'</li>
                                <li>Email               : '.$create->email.'</li>
                                <li>Phone               : '.$create->phone.'</li>
                                <li>City                : '.$cityObj->name.'</li>
                                <li>Course              : '.$courseName.'</li>
                                <li>Examination Name    : '.$examinationName.'</li>
                                <li>Examination URL     : '.$examinationUrl.'</li>
                                <li>Page                : Examination Page</li>
                            </ul>';

        $send_to = $create->email;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $create->name;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);


        $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
                ->where('users.userstatus_id','=', '1')
                ->where('users.userrole_id','=', '1')
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->get();

        $slug1 = 'examination_counselling_forms';
        foreach ($getTheEmailAdmin as $key => $value) {
            $fullname1 = $value->fullname;
            $send_to1 = $value->email;
            $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
            $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        }

        $msg = 'Your counselling form has been submitted successfully!. One of our representatives will be in contact with you shortly regarding your inquiry.';
        
        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return true;
    }

    public function fetchCollegeDetails($slugUrl)
    {
        $getCollegeDetailObj = DB::table('collegeprofile')
                            ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->leftJoin('collegetype', 'collegeprofile.collegetype_id', '=', 'collegetype.id')
                            ->leftJoin('university', 'collegeprofile.university_id', '=', 'university.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId', 'users.firstname', 'users.phone', 'users.email', 'collegeprofile.id as collegeprofileId', 'collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegeprofile.description','collegeprofile.slug', 'collegeprofile.facebookurl','collegeprofile.calenderinfo','collegeprofile.slug','collegeprofile.twitterurl','collegeprofile.approvedBy','collegeprofile.bannerimage','collegeprofile.registeredSortAddress','collegeprofile.registeredFullAddress','collegeprofile.campusSortAddress','collegeprofile.campusFullAddress', 'estyear', 'website', 'collegecode', 'contactpersonname', 'contactpersonemail', 'contactpersonnumber','collegetype.id as collegetypeId', 'collegetype.name as collegetypeName', 'university.name as universityName','collegeprofile.updated_at','collegeprofile.mediumOfInstruction','collegeprofile.studyForm','collegeprofile.studyTo','collegeprofile.admissionStart','collegeprofile.admissionEnd','collegeprofile.CCTVSurveillance','collegeprofile.totalStudent','collegeprofile.ACCampus','collegeprofile.rating','collegeprofile.totalRatingUser')
                            ->get()
                            ;
        return  $getCollegeDetailObj;
    }

    public function fetchCollegeRating($slugUrl)
    {
        $collegeRatingObj = DB::table('college_reviews')
                    ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                    ->where('collegeprofile.slug', '=', $slugUrl)
                    ->select('college_reviews.id', 'collegeprofile.id as collegeId',
                        DB::Raw('(SELECT count(votes) from college_reviews where votes=1 and college_reviews.users_id= users.id) AS totalLikes'),
                        DB::Raw('(SELECT count(votes) from college_reviews where votes=2 and college_reviews.users_id= users.id) AS totalDislike'),
                        DB::Raw('(Count(college_reviews.id)) AS totalCount'),
                        DB::Raw('(SUM(academic)) AS totalAcademic'),
                        DB::Raw('(SUM(academic)/Count(academic)) AS totalAcademicStar'),
                        DB::Raw('(SUM(accommodation)) AS totalAccommodation'),
                        DB::Raw('(SUM(accommodation)/Count(accommodation)) AS totalAccommodationStar'),
                        DB::Raw('(SUM(faculty)) AS totalFaculty'),
                        DB::Raw('(SUM(faculty)/Count(faculty)) AS totalFacultyStar'),
                        DB::Raw('(SUM(infrastructure)) AS totalInfrastructure'),
                        DB::Raw('(SUM(infrastructure)/Count(infrastructure)) AS totalInfrastructureStar'),
                        DB::Raw('(SUM(placement)) AS totalPlacement'),
                        DB::Raw('(SUM(placement)/Count(placement)) AS totalPlacementStar'),
                        DB::Raw('(SUM(social)) AS totalSocial'),
                        DB::Raw('(SUM(social)/Count(social)) AS totalSocialStar')
                    )
                    ->orderBy('college_reviews.id', 'ASC')
                    ->get()
                    ;

        foreach ($collegeRatingObj as $key => $value) {
            if ($collegeRatingObj[0]->totalCount > 0) {
                $totalUserRating = $value->totalAcademic + $value->totalAccommodation + $value->totalFaculty + $value->totalInfrastructure + $value->totalPlacement + $value->totalSocial;

                $totalAllStarCount = $value->totalAcademicStar + $value->totalAccommodationStar + $value->totalFacultyStar + $value->totalInfrastructureStar + $value->totalPlacementStar + $value->totalSocialStar;

                //$ratingStar = round(($value->totalAcademic + $value->totalAccommodation + $value->totalFaculty + $value->totalInfrastructure + $value->totalPlacement + $value->totalSocial) / ($value->totalCount + $value->totalAccommodationStar + $value->totalFacultyStar + $value->totalInfrastructureStar + $value->totalPlacementStar + $value->totalSocialStar), 2);

                $value->totalUserRating = $totalUserRating;
                $value->totalAllStarCount = $totalAllStarCount;

                $ratingStar = round(($totalUserRating) / ($value->totalCount), 2);
                $overAllRating = round(($ratingStar) / 6, 1);
                $value->totlaUserRating = $overAllRating;


                $updateCollegeProfileObj = CollegeProfile::findOrFail($value->collegeId);
                $updateCollegeProfileObj->rating = $overAllRating;
                $updateCollegeProfileObj->totalRatingUser = $value->totalCount;
                $updateCollegeProfileObj->save();
            }else{
                $min = 3.5;
                $max = 5;
                $number = mt_rand ($min * 10, $max * 10) / 10;
                $value->totlaUserRating = $number;
            }
        }
        
        return  $collegeRatingObj;
    }

    public function fetchCollegeSocialMediaLinks($slugUrl)
    {
        $socialMediaLinksDataObj = DB::table('college_social_media_links')
            ->leftJoin('collegeprofile','collegeprofile.id','=','college_social_media_links.collegeprofile_id')
            ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
            ->where('collegeprofile.slug', '=', $slugUrl)
            ->where('users.userstatus_id', '!=', '5')
            ->select('users.id as usersId','collegeprofile.slug','college_social_media_links.id as collegeSocialMediaLinkId', 'college_social_media_links.title', 'college_social_media_links.url', 'college_social_media_links.isActive', 'college_social_media_links.other')
            ->orderBy('college_social_media_links.id', 'ASC')
            ->get();

        return $socialMediaLinksDataObj;
    }

    public function fetchSportsActivity($slugUrl)
    {
        $sportsActivityDataObj = DB::table('college_sports_activities')
                            ->leftJoin('collegeprofile','college_sports_activities.collegeprofile_id','=','collegeprofile.id')
                            ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegeprofile.slug','college_sports_activities.id as collegeSportsActivityId','college_sports_activities.typeOfActivity', 'college_sports_activities.name')
                            ->orderBy('college_sports_activities.id', 'ASC')
                            ->get();

        return  $sportsActivityDataObj;
    }

    public function fetchCollegeGalley($slugUrl)
    {
        $collegeGalleryImagesObj = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->leftJoin('gallery','gallery.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('gallery.misc', '=', 'college-upload-gallery-img')
                            ->where('gallery.caption', '!=', 'College Logo')
                            ->where('gallery.misc', '!=', 'affiliationLettersImage')
                            ->where('gallery.caption', '!=', 'videogallery')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'gallery.name as galleryName', 'gallery.fullimage','gallery.caption', 'gallery.width', 'gallery.height')
                            ->get()
                            ;

        return  $collegeGalleryImagesObj;
    }

    public function fetchCollegeManagementList($slugUrl)
    {
        $collegeManagementDataObj = DB::table('college_management_details')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','college_management_details.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','college_management_details.id as collegeManagementDetailsId', 'college_management_details.suffix','college_management_details.name', 'college_management_details.designation', 'college_management_details.gender', 'college_management_details.picture', 'college_management_details.emailaddress', 'college_management_details.phoneno', 'college_management_details.landlineNo', 'college_management_details.about', 'college_management_details.users_id', 'college_management_details.collegeprofile_id')
                        ->orderBy('college_management_details.id', 'ASC')
                        ->get()
                        ;

        return  $collegeManagementDataObj;
    }

    public function fetchCollegeCourses($slugUrl)
    {
        $getCollegeMasterCoursesObj =DB::table('collegeprofile')
                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftJoin('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                        ->leftJoin('educationlevel','collegemaster.educationlevel_id','=','educationlevel.id')
                        ->leftJoin('functionalarea','collegemaster.functionalarea_id','=','functionalarea.id')
                        ->leftJoin('degree','collegemaster.degree_id','=','degree.id')
                        ->leftJoin('coursetype','collegemaster.coursetype_id','=','coursetype.id')
                        ->leftJoin('course','collegemaster.course_id','=','course.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.userstatus_id', '!=', '5')
                        ->where('collegemaster.id', '!=', '')
                        ->select('collegemaster.id as collegemasterId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'collegemaster.fees', 'collegemaster.seats','collegemaster.twelvemarks','collegemaster.others','collegemaster.seatsallocatedtobya','collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegemaster.courseduration','collegemaster.description as courseDescription')
                        ->orderBy('course.name','ASC')
                        ->get()
                        ;
        return  $getCollegeMasterCoursesObj;
    }

    public function fetchCollegeCoursesOnFacultyAssociate($slugUrl, $condition = null)
    {
        $query  =   DB::table('collegeprofile')
                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftJoin('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                        ->leftJoin('educationlevel','collegemaster.educationlevel_id','=','educationlevel.id')
                        ->leftJoin('functionalarea','collegemaster.functionalarea_id','=','functionalarea.id')
                        ->leftJoin('degree','collegemaster.degree_id','=','degree.id')
                        ->leftJoin('coursetype','collegemaster.coursetype_id','=','coursetype.id')
                        ->leftJoin('course','collegemaster.course_id','=','course.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.userstatus_id', '!=', '5');

        // if (!empty($condition) && ($condition != null)) {
        //     $query->whereNotIN('collegemaster.id', explode(',', $condition));
        // } 

        $getCollegeMasterCoursesObj = $query->select('collegemaster.id as collegemasterId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName')->orderBy('course.name','ASC')->get();

        return  $getCollegeMasterCoursesObj;
    }

    public function fetchCollegeFacilities($slugUrl)
    {
        $collegeFacilityDataObj = DB::table('collegeprofile')
                            ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->join('collegefacilities','collegeprofile.id','=','collegefacilities.collegeprofile_id')
                            ->join('facilities','collegefacilities.facilities_id','=','facilities.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegefacilities.id as collegefacilitiesId','collegefacilities.name',  'collegefacilities.description','facilities.id as facilitiesId', 'facilities.name as facilitiesName','facilities.iconname as iconname')
                            ->orderBy('collegeprofile.id', 'ASC')
                            ->get();

        return $collegeFacilityDataObj;             
    }

    public function fetchCollegeEvents($slugUrl)
    {
        $getCollegeCalender = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->leftJoin('event','collegeprofile.id','=','event.collegeprofile_id')
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId','event.id as eventId','event.name', 'event.datetime', 'event.venue', 'event.description', 'event.link')
                                    ->orderBy('collegeprofile.id', 'ASC')
                                    ->get()
                                    ;
        return  $getCollegeCalender;
    }

    public function fetchCollegeAddress($slugUrl)
    {
        $getCollegeAddressObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                ->where('users.userstatus_id', '!=', '5')
                                ->where('collegeprofile.slug', '=', $slugUrl)
                                ->select('users.id as usersId','address.id as adressID', 'address.name', 'address.address1', 'address.address2','address.postalcode','addresstype.id as addresstypeId','addresstype.name as addresstypeName', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName','address.landmark')
                                ->get()
                                ;
        return  $getCollegeAddressObj;
    }

    public function fetchCollegeLogo($slugUrl)
    {
        $getCollegeLogoObj = DB::table('collegeprofile')
                            ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->leftJoin('gallery','users.id','=','gallery.users_id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('gallery.caption', '=', 'College Logo')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId', 'users.suffix','users.firstname as firstName','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage', 'gallery.width', 'gallery.height')
                            ->orderBy('gallery.id', 'DESC')
                            ->take(1)
                            ->get()
                            ;
        return  $getCollegeLogoObj;
    }

    public function fetchCollegeDetailBannerAds($slugUrl)
    {
        $getCollegeDetailBannerAds = DB::table('ads_managements')
                                ->where('slug', '=', 3)
                                ->where('isactive', '=', 1)
                                ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                                ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                                ->select('img', 'redirectto', 'ads_position')
                                ->orderBy('ads_managements.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
        return  $getCollegeDetailBannerAds;
    }

    public function fetchCollegeScholarships($slugUrl)
    {
        $collegeScholarshipsDataObj = DB::table('college_scholarships')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','college_scholarships.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','college_scholarships.id as collegeScholarshipId', 'college_scholarships.title','college_scholarships.description', 'college_scholarships.users_id', 'college_scholarships.collegeprofile_id')
                        ->orderBy('college_scholarships.id', 'ASC')
                        ->get()
                        ;
        return  $collegeScholarshipsDataObj;
    }

    public function fetchCollegePlacement($slugUrl)
    {
        $collegePlacementDataObj = DB::table('placement')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','placement.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','placement.id as placementId', 'placement.numberofrecruitingcompany', 'placement.numberofplacementlastyear', 'placement.ctchighest', 'placement.ctclowest', 'placement.ctcaverage','placement.placementinfo')
                        ->orderBy('placement.id', 'ASC')
                        ->get()
                        ;

        return  $collegePlacementDataObj;
    }

    public function fetchCollegeCutOffs($slugUrl)
    {
        $collegeCutOffsDataObj = DB::table('college_cut_offs')
                        ->leftJoin('collegeprofile','college_cut_offs.collegeprofile_id','=','collegeprofile.id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->leftJoin('educationlevel','college_cut_offs.educationlevel_id','=','educationlevel.id')
                        ->leftJoin('functionalarea','college_cut_offs.functionalarea_id','=','functionalarea.id')
                        ->leftJoin('degree','college_cut_offs.degree_id','=','degree.id')
                        ->leftJoin('coursetype','college_cut_offs.coursetype_id','=','coursetype.id')
                        ->leftJoin('course','college_cut_offs.course_id','=','course.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','college_cut_offs.id as collegeCutOffId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'college_cut_offs.title', 'college_cut_offs.description')
                        ->orderBy('college_cut_offs.id','ASC')
                        ->get()
                        ;
        return  $collegeCutOffsDataObj;
    }

    public function fetchCollegeMasterCourses($slugUrl, $collegemasterId)
    {
        $getCollegeMasterCoursesObj = DB::table('collegeprofile')
                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftJoin('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                        ->leftJoin('educationlevel','collegemaster.educationlevel_id','=','educationlevel.id')
                        ->leftJoin('functionalarea','collegemaster.functionalarea_id','=','functionalarea.id')
                        ->leftJoin('degree','collegemaster.degree_id','=','degree.id')
                        ->leftJoin('coursetype','collegemaster.coursetype_id','=','coursetype.id')
                        ->leftJoin('course','collegemaster.course_id','=','course.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('collegemaster.id','=', $collegemasterId)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('collegemaster.id as collegemasterId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'collegemaster.fees', 'collegemaster.seats','collegemaster.twelvemarks','collegemaster.others','collegemaster.seatsallocatedtobya','collegeprofile.slug','collegemaster.courseduration','collegemaster.description as courseDescription')
                        ->get()
                        ;
        return  $getCollegeMasterCoursesObj;
    }

    public function fetchCollegeMasterFaculty($slugUrl, $collegemasterId)
    {
        $getCollegeMasterFacultyObj = DB::table('college_master_associate_faculties')
                        ->join('collegeprofile', 'college_master_associate_faculties.collegeprofile_id', '=', 'collegeprofile.id')
                        ->join('faculty', 'college_master_associate_faculties.faculty_id', '=', 'faculty.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('college_master_associate_faculties.collegemaster_id', '=', $collegemasterId)
                        ->select('faculty.id','faculty.name','faculty.suffix','faculty.designation', DB::raw("CONCAT(faculty.suffix,' ',faculty.name,' (Designation - ', faculty.designation,')') as fullname"),'faculty.description','faculty.imagename','faculty.languageKnown','collegeprofile.users_id')
                        ->orderBy('faculty.id','ASC')
                        ->get()
                        ;
        return  $getCollegeMasterFacultyObj;
    }

    public function fetchStudentClassMarksDetails($studentSlug, $userId, $className)
    {
        $getStudentClassMarksObj = DB::table('studentprofile')
                                ->leftJoin('users', function ($join) use ($userId) {
                                    $join->on('studentprofile.users_id', '=','users.id')
                                        ->where('studentprofile.users_id', '=', DB::raw($userId)
                                        );  
                                    })
                                ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                ->leftJoin('category','studentmarks.category_id','=','category.id')
                                ->where('studentprofile.slug', '=', $studentSlug)
                                ->where('studentmarks.name', '=', $className)
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID')
                                ->orderBy('studentmarks.id', 'ASC')
                                ->take(1)
                                ->get()
                                ;
        return  $getStudentClassMarksObj;
    }

    public function fetchStudentMarksDetails($studentSlug, $userId)
    {
        $getStudentMarksObj = DB::table('studentprofile')
                            ->leftJoin('users', function ($join) use ($userId) {
                                $join->on('studentprofile.users_id', '=','users.id')
                                    ->where('studentprofile.users_id', '=', DB::raw($userId)
                                    );  
                                })
                            ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                            ->leftJoin('category','studentmarks.category_id','=','category.id')
                            ->where('studentprofile.slug', '=', $studentSlug)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID')
                            ->get()
                            ;
        return  $getStudentMarksObj;
    }

    public function fetchStudentProfileDetails($studentSlug, $userId)
    {
        $getStudentProfileObj = DB::table('studentprofile')
                            ->leftJoin('users', function ($join) use ($userId) {
                            $join->on('studentprofile.users_id', '=','users.id')
                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                );  
                            })
                            ->where('studentprofile.slug', '=', $studentSlug)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone','studentprofile.gender', 'studentprofile.dateofbirth', 'studentprofile.parentsname', 'studentprofile.parentsnumber', 'studentprofile.hobbies', 'studentprofile.interests', 'studentprofile.achievementsawards', 'studentprofile.projects', 'studentprofile.entranceexamname', 'studentprofile.entranceexamnumber', 'studentprofile.isverifiedage','studentprofile.slug')
                            ->orderBy('studentprofile.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;
        return  $getStudentProfileObj;
    }

    public function fetchExamNotificationList($status)
    {
        $examNotificationList = DB::table('type_of_examinations')  
                            ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                            ->leftJoin('examination_details', 'type_of_examinations.id', '=', 'examination_details.typeOfExaminations_id')
                            ->where('type_of_examinations.status', '=', $status)
                            ->where('applicationFrom', '<=', date("m/d/Y"))
                            ->where('applicationTo', '>=', date("m/d/Y"))
                            //->whereRaw("applicationFrom BETWEEN '".$startFromDate."' and '". $endToDate ."'")
                            ->select('type_of_examinations.id','type_of_examinations.sortname', 'type_of_examinations.name', 'type_of_examinations.status','type_of_examinations.slug','universitylogo','universityName','university_id','examination_details.applicationFrom','examination_details.title','exam_sections.slug as streamSlug','applicationTo')
                            ->orderBy('examination_details.applicationFrom', 'ASC')
                            ->groupBy('type_of_examinations.id')
                            ->take(5)
                            ->get();

        return  $examNotificationList;
    }

    public function fetchLatestExaminationList($status)
    {
        $latestExaminationList = DB::table('type_of_examinations')  
                            ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                            ->leftJoin('examination_details', 'type_of_examinations.id', '=', 'examination_details.typeOfExaminations_id')
                            ->where('type_of_examinations.status', '=', $status)
                            ->select('type_of_examinations.id','type_of_examinations.sortname', 'type_of_examinations.name', 'type_of_examinations.status','type_of_examinations.slug','universitylogo','universityName','university_id','examination_details.applicationFrom','examination_details.applicationTo','examination_details.title','exam_sections.slug as streamSlug')
                            ->orderBy('examination_details.applicationFrom', 'DESC')
                            ->groupBy('type_of_examinations.id')
                            ->take(5)
                            ->get();
        return  $latestExaminationList;
    }

    public function storeCollegeViewLog($collegeprofileId, $slugUrl)
    {
        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.COLLEGEVIEW').' by this User Id '.Auth::id().' College Id '.$collegeprofileId.' '.$slugUrl);

        $collegeID = $collegeprofileId;
        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventCollege(Config::get('systemsetting.COLLEGEVIEW').' by this User Id '.Auth::id().' College Id '.$collegeprofileId.' '.$slugUrl, $collegeID);

        return true;
    }

    public function setBlogBookmarkSession(Request $request)
    { 
        Session::forget('blogName');
        Session::forget('blogURL');
        Session::forget('isUserPost');

        Session::set('blogName', Input::get('blogName'));
        Session::set('blogURL', Input::get('url'));    
        Session::set('isUserPost', 3);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setCollegeBookmarkSession(Request $request)
    { 
        Session::forget('collegeName');
        Session::forget('collegeURL');
        Session::forget('isUserPost');

        Session::set('collegeName', Input::get('collegeName'));
        Session::set('collegeURL', Input::get('url'));    
        Session::set('isUserPost', 4);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setCourseBookMarkSession(Request $request)
    { 
        Session::forget('courseName');
        Session::forget('courseURL');
        Session::forget('isUserPost');

        Session::set('courseName', Input::get('courseName'));
        Session::set('courseURL', Input::get('url'));    
        Session::set('isUserPost', 5);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setCollegeReviewsSession(Request $request)
    { 
        Session::forget('reviewTitle');
        Session::forget('reviewDescription');
        Session::forget('reviewVotes');
        Session::forget('reviewAcademic');
        Session::forget('reviewAccommodation');
        Session::forget('reviewFaculty');
        Session::forget('reviewInfrastructure');
        Session::forget('reviewPlacement');
        Session::forget('reviewSocial');
        Session::forget('reviewCollegeSlug');
        Session::forget('collegeId');
        Session::forget('isUserPost');

        $collegeProfile = CollegeProfile::where('slug', '=', Input::get('slugUrl'))->firstOrFail();
        $collegeId = $collegeProfile->id;

        Session::set('reviewTitle', Input::get('title'));
        Session::set('reviewDescription', Input::get('description'));
        Session::set('reviewVotes', Input::get('votes'));
        Session::set('reviewAcademic', Input::get('academic'));
        Session::set('reviewAccommodation', Input::get('accommodation'));
        Session::set('reviewFaculty', Input::get('faculty'));
        Session::set('reviewInfrastructure', Input::get('infrastructure'));
        Session::set('reviewPlacement', Input::get('placement'));
        Session::set('reviewSocial', Input::get('social'));
        Session::set('reviewCollegeSlug', Input::get('slugUrl')); 
        Session::set('collegeId', $collegeId);     
        Session::set('isUserPost', 7);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }

    public function setCollegeHelpDeskSession(Request $request)
    { 
        Session::forget('subject');
        Session::forget('message');
        Session::forget('collegeSlugUrl');
        Session::forget('collegeId');
        Session::forget('isUserPost');

        $collegeProfile = CollegeProfile::where('slug', '=', Input::get('slugUrl'))->firstOrFail();
        $collegeId = $collegeProfile->id;

        Session::set('subject', Input::get('subject'));
        Session::set('message', Input::get('message'));
        Session::set('collegeSlugUrl', Input::get('slugUrl')); 
        Session::set('collegeId', $collegeId);     
        Session::set('isUserPost', 8);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setExamQuestionContentSession(Request $request)
    { 
        Session::set('examId', Input::get('examId'));
        Session::set('examQuestion', Input::get('question'));
        Session::set('isUserPost', 10);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setExamAnswerContentSession(Request $request)
    { 
        Session::set('examId', Input::get('examId'));
        Session::set('examQuestionId', Input::get('examQuestionId'));
        Session::set('examanswer', Input::get('answer'));
        Session::set('isUserPost', 11);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setExamCommentContentSession(Request $request)
    { 
        Session::set('examId', Input::get('examId'));
        Session::set('examQuestionId', Input::get('examQuestionId'));
        Session::set('examAnswerId', Input::get('examAnswerId'));
        Session::set('examReplyanswer', Input::get('replyanswer'));
        Session::set('isUserPost', 12);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setAskQuestionContentSession(Request $request)
    { 
        Session::set('askQuestion', Input::get('question'));
        Session::set('askQuestionTagIds', Input::get('askQuestionTagIds'));    
        Session::set('isUserPost', 13);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setAskAnswerContentSession(Request $request)
    { 
        Session::set('askQuestionId', Input::get('askQuestionId'));
        Session::set('askAnswer', Input::get('answer'));   
        Session::set('isUserPost', 14);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function setAskCommentContentSession(Request $request)
    { 
        Session::set('askQuestionId', Input::get('askQuestionId'));
        Session::set('askAnswerId', Input::get('askAnswerId'));
        Session::set('askReplyanswer', Input::get('replyanswer'));
        Session::set('isUserPost', 15);

        $dataArray = [
                        'code'      => '200',
                        'response'  => 'success',
                    ];
        return response()->json($dataArray);
    }  

    public function fetchCollegeProfileList($userrole)
    {
        $collegeProfileObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->where('users.userrole_id', '=', $userrole)
                                ->select('collegeprofile.id as collegeprofileID','collegeprofile.description', 'collegeprofile.estyear', 'users.id as userID','users.firstname','users.middlename', 'users.lastname' )
                                ->get();

        return $collegeProfileObj;
    }

    public function fetchUserList($userrole)
    {
        $userObj = DB::table('users')
                    ->select('users.id as userID','users.firstname','users.middlename', 'users.lastname', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"), 'users.userrole_id')
                    //->where('users.userrole_id', '=', $userrole)
                    ->whereIN('users.userrole_id', $userrole)
                    ->where('users.userstatus_id', '=', 1)
                    ->get();

        return $userObj;
    }
    

    public function sendEmailTemplateViaSupport($to, $slug, $array)
    {
        $subject        = '';
        $message        = '';

        $templateInfo   = DB::table('templates')
                            ->where('slug', '=', $slug)
                            ->select('id', 'name', 'description', 'slug', 'status', 'created_at', 'updated_at')
                            ->orderBy('templates.id', 'DESC')
                            ->get();

        if(sizeof($templateInfo) > 0){

            $subject   = $templateInfo[0]->name;
            $message   = $templateInfo[0]->description;

            foreach($array as $find => $replace){
                $message        =   str_replace($find, $replace, $message);
            }
        }

        $header     =   'MIME-Version: 1.0' . "\r\n";
        $header     .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


        $mail               = new PHPMailer\PHPMailer\PHPMailer;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        stream_context_set_default( [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
        get_headers('https://www.admissionx.info/');
        $mail->SMTPDebug    = 0;  // Enable verbose debug output
        $mail->Debugoutput  = 'html';
        $mail->isSMTP();    // Set mailer to use SMTP
        $mail->Host         = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth     = true;     // Enable SMTP authentication
        $mail->Username     = Config::get('systemsetting.SupportEmail');  // SMTP username
        $mail->Password     = Config::get('systemsetting.SupportEmailPassword');  // SMTP password
       // $mail->Username     = 'tdeveloper4@gmail.com';  // SMTP username
       // $mail->Password     = 'Technochords@2017';  // SMTP password

        $mail->SMTPSecure   = 'tls';  // Enable TLS encryption, `ssl` also accepted
        $mail->Port         = '587';   // TCP port to connect to
        $mail->From         = Config::get('systemsetting.SupportEmail');

        $mail->setFrom('support@admissionx.info', 'AdmissionX | Welcome Aboard!');
        //Set an alternative reply-to address
        $mail->addReplyTo('support@admissionx.info', 'AdmissionX | Welcome Aboard!');
        $copyrightdate = date('Y');
        //$template = file_get_contents('/assets/sendemailtemplate.html');
        $template = file_get_contents('https://admissionx.info/assets/sendemailtemplate.html');
        $template = str_replace('%copyrightdate%', $copyrightdate, $template);
        $content = str_replace('%textcontentdescription%', $message, $template);

        $mail->isHTML(true);  // Set email format to HTML
        //Set who the message is to be sent to
        if(env('APP_ENV') == 'local'){
            $mail->addAddress('amareshtechnochords@gmail.com');
        }else{
            $mail->addAddress($to);
        }

        $mail->Subject = $subject;
        $mail->Body    = $content;

        if(!$mail->send()){
            return false;
        }else{
            return true;
        }
    }

    public function sendEmailTemplateViaWelcome($to, $slug, $array)
    {
        $subject        = '';
        $message        = '';

        $templateInfo   = DB::table('templates')
                            ->where('slug', '=', $slug)
                            ->select('id', 'name', 'description', 'slug', 'status', 'created_at', 'updated_at')
                            ->orderBy('templates.id', 'DESC')
                            ->get();

        if(sizeof($templateInfo) > 0){

            $subject   = $templateInfo[0]->name;
            $message   = $templateInfo[0]->description;

            foreach($array as $find => $replace){
                $message        =   str_replace($find, $replace, $message);
            }
        }

        $header     =   'MIME-Version: 1.0' . "\r\n";
        $header     .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


        $mail               = new PHPMailer\PHPMailer\PHPMailer;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        stream_context_set_default( [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
        get_headers('https://www.admissionx.info/');
        $mail->SMTPDebug    = 0;  // Enable verbose debug output
        $mail->Debugoutput  = 'html';
        $mail->isSMTP();    // Set mailer to use SMTP
        $mail->Host         = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth     = true;     // Enable SMTP authentication
        $mail->Username     = Config::get('systemsetting.WelcomeEmail');  // SMTP username
        $mail->Password     = Config::get('systemsetting.WelcomeEmailPassword');  // SMTP password
       // $mail->Username     = 'tdeveloper4@gmail.com';  // SMTP username
       // $mail->Password     = 'Technochords@2017';  // SMTP password

        $mail->SMTPSecure   = 'tls';  // Enable TLS encryption, `ssl` also accepted
        $mail->Port         = '587';   // TCP port to connect to
        $mail->From         = Config::get('systemsetting.WelcomeEmail');

        $mail->setFrom('welcome@admissionx.info', 'AdmissionX | Welcome Aboard!');
        //Set an alternative reply-to address
        $mail->addReplyTo('welcome@admissionx.info', 'AdmissionX | Welcome Aboard!');
        $copyrightdate = date('Y');
        //$template = file_get_contents('/assets/sendemailtemplate.html');
        $template = file_get_contents('https://admissionx.info/assets/sendemailtemplate.html');
        $template = str_replace('%copyrightdate%', $copyrightdate, $template);
        $content = str_replace('%textcontentdescription%', $message, $template);

        $mail->isHTML(true);  // Set email format to HTML
        //Set who the message is to be sent to
        if(env('APP_ENV') == 'local'){
            $mail->addAddress('amareshtechnochords@gmail.com');
        }else{
            $mail->addAddress($to);
        }

        $mail->Subject = $subject;
        $mail->Body    = $content;

        if(!$mail->send()){
            return false;
        }else{
            return true;
        }
    }

    public function getAllCollegeCourseNameData( Request $request )
    {
        $collegeId = Input::get('collegeId');

        $getCollegeMasterCoursesObj =DB::table('collegeprofile')
                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                    ->leftJoin('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                    ->leftJoin('educationlevel','collegemaster.educationlevel_id','=','educationlevel.id')
                    ->leftJoin('functionalarea','collegemaster.functionalarea_id','=','functionalarea.id')
                    ->leftJoin('degree','collegemaster.degree_id','=','degree.id')
                    ->leftJoin('coursetype','collegemaster.coursetype_id','=','coursetype.id')
                    ->leftJoin('course','collegemaster.course_id','=','course.id')
                    ->where('collegeprofile.id', '=', $collegeId)
                    ->where('users.userstatus_id', '!=', '5')
                    ->where('collegemaster.id', '!=', '')
                    ->select('collegemaster.id as collegemasterId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'collegemaster.fees', 'collegemaster.seats','collegemaster.twelvemarks','collegemaster.others','collegemaster.seatsallocatedtobya','collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegemaster.courseduration','collegemaster.description as courseDescription')
                    ->orderBy('course.name','ASC')
                    ->get()
                    ;

        if( !empty($collegeId) ){
            $dataArray = array( 'code' => '200' , 'collegeCourseObj' => $getCollegeMasterCoursesObj );
        }else{
            $dataArray = array( 'code' => '401' , 'collegeCourseObj' => '' );
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }

    public function landingPageQueryFormSubmit(Request $request)
    {
        $userId = Auth::id();
        $fullname                               = Input::get('fullname');
        $mobilenumber                           = Input::get('mobilenumber');
        $emailaddress                           = Input::get('emailaddress');


        $create                                 = New LandingPageQueryForm; 
        $create->fullname                       = $fullname;
        $create->mobilenumber                   = $mobilenumber;
        $create->emailaddress                   = $emailaddress;
        $create->users_id                       = $userId;
        $create->employee_id                    = $userId;
        $create->save();

        $landingPageUrl = env('APP_URL').'/landing-page-one';

        $bodyContent    =   '<ul>
                                <li>Name                : '.$fullname.'</li>
                                <li>Phone               : '.$mobilenumber.'</li>
                                <li>Email               : '.$emailaddress.'</li>
                                <li>Page                : Landing Page</li>
                                <li>Page URL            : '.$landingPageUrl.'</li>
                            </ul>';

        $send_to = $emailaddress;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $fullname;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);


        $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
                ->where('users.userstatus_id','=', '1')
                ->where('users.userrole_id','=', '1')
                ->where('users.id','=', '2')
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->get();

        $slug1 = 'submit_landing_page_query';
        foreach ($getTheEmailAdmin as $key => $value) {
            $fullname1 = $value->fullname;
            $send_to1 = $value->email;
            $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
            $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        }

        $msg = 'Your query has been submitted successfully!. One of our representatives will be in contact with you shortly regarding your inquiry.';

        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        Session::flash('flash_message', $msg);
        Session::flash('alert_class', 'alert-success');

        return Redirect::back();        
    }

    public function getFunctionalAreaCollegeFee($functionalarea_id, $collegeprofile_id)
    {
        $dataSet    = DB::table('collegemaster')
                    ->select('fees','seats')
                    ->where('collegemaster.functionalarea_id', '=', $functionalarea_id)
                    ->where('collegemaster.collegeprofile_id', '=', $collegeprofile_id)
                    ->where('collegemaster.fees', '>', 0)
                    ->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC')
                    ->take(1)
                    ->get();

        return $dataSet;
    }

    public function getDegreeAreaCollegeFee($degree_id, $collegeprofile_id)
    {
        $dataSet    = DB::table('collegemaster')
                    ->select('fees','seats')
                    ->where('collegemaster.degree_id', '=', $degree_id)
                    ->where('collegemaster.collegeprofile_id', '=', $collegeprofile_id)
                    ->where('collegemaster.fees', '>', 0)
                    ->orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC')
                    ->take(1)
                    ->get();

        return $dataSet;
    }

    // public function sendTextSmsOnMobileOldFunction($userMobileNo, $smsMessageData)
    // {
    //     /***Send SMS *******************************/
    //     /*$userIdHorizonSms = Config::get('app.userIdHorizonSms');
    //     $passwordHorizonSms = Config::get('app.passwordHorizonSms');
    //     $accountFromHorizon = Config::get('app.accountFromHorizon');

    //     $url = 'http://210.210.26.40/sendsms/push_sms.php';

    //     $client = new \GuzzleHttp\Client();
    //     $res = $client->request('POST', $url, [
    //         'form_params' => [
    //             'user' => urlencode($userIdHorizonSms),
    //             'pwd' => urlencode($passwordHorizonSms),
    //             'from' => urlencode($accountFromHorizon),
    //             'to' => urlencode($userMobileNo),
    //             'msg' => $smsMessageData,
    //         ]
    //     ]); */       

    //     // $client = new \GuzzleHttp\Client();
    //     // $res = $client->request('POST', Config::get('systemsetting.SEND_SMS_URL'), [
    //     //     'form_params' => [
    //     //         'authentic-key' => Config::get('systemsetting.AUTHENTIC_KEY'),
    //     //         'senderid' => 6,
    //     //         'route' => 2,
    //     //         'unicode' => 2,
    //     //         'number' => urlencode($userMobileNo),
    //     //         'message' => $smsMessageData,
    //     //     ]
    //     // ]); 
    // }

    public function sendTextSmsOnMobile($userMobileNo, $smsMessageData, $templateId)
    {
        /***Send SMS *******************************/
        $userIdSms          =   Config::get('systemsetting.SMS_USER_NAME');
        $passwordSms        =   Config::get('systemsetting.SMS_PASSWORD');
        $senderId           =   Config::get('systemsetting.SMS_SENDER_ID');

        //$message = "Dear Amaresh, You have got admission, student will report you within 15 days. For assistance call our Helpline +9111-4224-9249. SAROJL";

        //extract data from the post
        //set POST variables
        if(env('APP_ENV') == 'local'){
            $mobileNumber = '9910469042';
        }else{
            $mobileNumber = $userMobileNo;
        }

        $url = 'http://smpp.webtechsolution.co/http-api.php?';
        $fields = array(
            'username'  =>  urlencode($userIdSms),
            'password'  =>  urlencode($passwordSms),
            'senderid'  =>  urldecode($senderId),
            'route'     =>  1,
            'unicode'   =>  2,
            'number'    =>  urlencode($mobileNumber),
            'message'   =>  urlencode($smsMessageData),
            'templateid' => $templateId
        );

        //url-ify the data for the POST
        $fields_string = '';
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        return true;
    }

    public function getListOfAdsManagements($misc)
    {
        $adsManagementsObj = DB::table('ads_managements')
                        ->where('slug', '=', $misc)
                        ->where('isactive', '=', 1)
                        ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                        ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                        ->select('id','title','img','description','isactive','users_id','slug','redirectto','start','end','ads_position')
                        ->orderBy('ads_managements.id', 'DESC')
                        ->get();

        return $adsManagementsObj;
    }

    public function getAllDropdownOptions( Request $request)
    {
        $actionType = Input::get('actionType');
        $dataObj = [];
        if($actionType == "Functional Area"):
            $dataObj = DB::table('functionalarea')
                        ->whereNotNull('functionalarea.name')
                        ->select('id','name','pageslug','name as fullname')
                        ->orderBy('functionalarea.name', 'ASC')
                        ->get();
        elseif($actionType == "Degree"):
            $dataObj = DB::table('degree')
                        ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                        ->whereNotNull('degree.name')
                        ->select('degree.id','degree.name','degree.pageslug', DB::raw("CONCAT(degree.name,' - (', functionalarea.name, ')') as fullname"))
                        ->orderBy('degree.name', 'ASC')
                        ->get();
        elseif($actionType == "Course"):
            $dataObj = DB::table('course')
                        ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                        ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                        ->whereNotNull('course.name')
                        ->whereNotNull('degree.name')
                        ->whereNotNull('functionalarea.name')
                        ->select('course.id','course.name','course.pageslug', DB::raw("CONCAT(course.name,' - (', degree.name, ')',' - (', functionalarea.name, ')') as fullname"))
                        ->orderBy('course.name', 'ASC')
                        ->get();
        elseif($actionType == "Education Level"):
            $dataObj = DB::table('educationlevel')
                             ->whereNotNull('educationlevel.name')
                             ->select('id','name','pageslug','name as fullname')
                             ->orderBy('educationlevel.name', 'ASC')
                             ->get();
        elseif($actionType == "City"):
            $dataObj = DB::table('city')
                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->whereNotNull('city.name')
                        ->whereNotNull('state.name')
                        ->whereNotNull('country.name')
                        ->select('city.id','city.name','city.pageslug', DB::raw("CONCAT(city.name,' - (', state.name, ')',' - (', country.name, ')') as fullname"))
                        ->orderBy('city.name', 'ASC')
                        ->get();
        elseif($actionType == "State"):
            $dataObj = DB::table('state')
                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                        ->whereNotNull('state.name')
                        ->whereNotNull('country.name')
                        ->select('state.id','state.name','state.pageslug', DB::raw("CONCAT(state.name,' - (', country.name, ')') as fullname"))
                        ->orderBy('state.name', 'ASC')
                        ->get();
        elseif($actionType == "Country"):
            $dataObj = DB::table('country')
                        ->whereNotNull('country.name')
                        ->select('id','name','pageslug','name as fullname')
                        ->orderBy('country.name', 'ASC')
                        ->get();
        elseif($actionType == "University"):
            $dataObj = DB::table('university')
                            ->whereNotNull('university.name')
                            ->select('id','name','pageslug','name as fullname')
                            ->orderBy('university.name', 'ASC')
                            ->get();
        endif;

        if(sizeof($dataObj) > 0){
            $dataArray = array( 'code' => '200' , 'dataObj' => $dataObj);
        }else{
            $dataArray = array( 'code' => '401' , 'dataObj' => '' );
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }

    public function updateStatusOnChange(Request $request)
    {   
        $currentStatus = $request->get('currentStatus');
        $currentId = $request->get('currentId');
        $tableName = $request->get('tableName');
        $columnName = $request->get('columnName');
        
        DB::statement(DB::raw("UPDATE ".$tableName." SET ".$columnName."=".$currentStatus." WHERE id=".$currentId.""));

        if(Auth::check()):
            DB::statement(DB::raw("UPDATE ".$tableName." SET employee_id=".Auth::id()." WHERE id=".$currentId.""));
        endif;

        return response()->json(['code' => 200, 'response' => 'success']);
    }

    public function checkExistingAdsCollegeList(Request $request)
    {
        $method_type = Input::get('method_type');
        $page_name_id = Input::get('page_name_id');

        $query = DB::table('ads_top_college_lists');
        if($method_type == "Functional Area"):
            $query->where('functionalarea_id', '=', $page_name_id);
        elseif($method_type == "Degree"):
            $query->where('degree_id', '=', $page_name_id);
        elseif($method_type == "Course"):
            $query->where('course_id', '=', $page_name_id);
        elseif($method_type == "Education Level"):
            $query->where('educationlevel_id', '=', $page_name_id);
        elseif($method_type == "City"):
            $query->where('city_id', '=', $page_name_id);
        elseif($method_type == "State"):
            $query->where('state_id', '=', $page_name_id);
        elseif($method_type == "Country"):
            $query->where('country_id', '=', $page_name_id);
        elseif($method_type == "University"):
            $query->where('university_id', '=', $page_name_id);
        endif;
        $checkExistingAdsCollegeList = $query->first();

       if(!empty($checkExistingAdsCollegeList)){
            $dataArray = array( 'code' => '200', 'dataObj' => $checkExistingAdsCollegeList);
        }else{
            $dataArray = array( 'code' => '401', 'dataObj' => []);
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }

    public function fetchAdsCollegeList($columnName, $id)
    {

        $query = DB::table('ads_top_college_lists');
        $query->where($columnName, '=', $id);
        $query->where('status', '=', 1);
        $checkExistingAdsCollegeList = $query->first();

        $collegeId = '';
        if(!empty($checkExistingAdsCollegeList)){
            $collegeId = $checkExistingAdsCollegeList->collegeprofile_id;
        }
        return $collegeId;
    }

    public function topAdsCollegeQueryString($collegeId)
    {
        $queryString = '';
        if(!empty($collegeId)){
            $queryString = "if(collegeprofile.id in ($collegeId), 1,2) as topAdsCollegeQueryString";
        }
        return $queryString;
    }

    public function isValidEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 1;
        }else{
            return 0;
        }  
    }
}
