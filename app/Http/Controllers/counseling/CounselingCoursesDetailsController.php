<?php

namespace App\Http\Controllers\counseling;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CounselingCoursesDetail;
use Illuminate\Http\Request;
use Session;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
Use Image;
use Config;
use Storage;
use DateTime;
use DateTimeZone;
use PDF;
use File;
use Artisan;
use Excel;
use PHPMailer;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\CounselingCoursesMoreDetail;
use App\Models\CounselingCoursesJobCareer;
use App\Models\CounselingCoursesEducationLevel;
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\EducationLevel as EducationLevel;
use App\Models\Degree as Degree;
use App\Models\CourseType as CourseType;
use App\Models\Course as Course;
use App\Models\EligibilityCriterion;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class CounselingCoursesDetailsController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCoursesDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CounselingCoursesDetail::orderBy('counseling_courses_details.id', 'DESC')
                ->leftJoin('users as eID','counseling_courses_details.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'counseling_courses_details.functionalarea_id', '=', 'functionalarea.id');

        if (!empty($keyword)) {
            $query->where('counseling_courses_details.description', 'LIKE', "%$keyword%");
            $query->orWhere('counseling_courses_details.title', 'LIKE', "%$keyword%");
        }

        if ($request->has('functionalarea') && !empty($request->get('functionalarea'))) {
            $query->where('counseling_courses_details.functionalarea_id', '=', Input::get('functionalarea'));
        }

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('counseling_courses_details.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        $counselingcoursesdetails = $query->paginate(20, array('counseling_courses_details.id', 'title', 'description', 'image', 'bestChoiceOfCourse', 'jobsCareerOpportunityDesc','slug','functionalarea_id','counseling_courses_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_courses_details.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName'));

        $functionalAreaObj = FunctionalArea::all();

        return view('counseling.counseling-courses-details.index', compact('counselingcoursesdetails','functionalAreaObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCoursesDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $functionalAreaObj = FunctionalArea::all();
        //$educationLevelObj = EducationLevel::all();
        $eligibilityCriterion           = EligibilityCriterion::get();
        
        return view('counseling.counseling-courses-details.create',compact('functionalAreaObj','eligibilityCriterion'));
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
        $createObj = New CounselingCoursesDetail();
        $createObj->title = Input::get('title');
        $createObj->description = Input::get('description');
        $createObj->bestChoiceOfCourse = Input::get('bestChoiceOfCourse');
        $createObj->jobsCareerOpportunityDesc = Input::get('jobsCareerOpportunityDesc');
        $createObj->functionalarea_id = Input::get('functionalarea_id');
        $createObj->employee_id = Auth::id();
        $createObj->save();

        $updateSlugObj = CounselingCoursesDetail::findOrFail($createObj->id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($createObj->title.'-'.$createObj->id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();

        if($request->file('image')){
            $fileName1 = 'counseling-courses-details-'.$createObj->id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_courses_details')->where('counseling_courses_details.id', '=', $createObj->id)->update(array('counseling_courses_details.image' => $fileName1)); 
        }

        $educationlevelIds = Input::get('educationlevel_id');
        if (sizeof($educationlevelIds) > 0) {
            foreach ($educationlevelIds as $key => $value) {
                $degreeObj                         = EligibilityCriterion::orderBy('eligibility_criterias.id' ,'ASC')
                                                    ->where('eligibility_criterias.id','=', $value)
                                                    ->first();

                $addEducationLevelObj = New CounselingCoursesEducationLevel;
                $addEducationLevelObj->educationlevel_id = $value;
                $addEducationLevelObj->coursesDetailsId = $createObj->id;
                $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($degreeObj->name)); 
                $slug1 = strtolower(trim($cleanChar));
                $slug1 = preg_replace('/[^a-z0-9-]/', '-', $slug1);
                $slug1 = preg_replace('/-+/', "-", $slug1);
                rtrim($slug1, '-');
                $addEducationLevelObj->educationLevelSlug = $slug1;
                $addEducationLevelObj->functionalarea_id = Input::get('functionalarea_id');
                $addEducationLevelObj->save();
            }
        }

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());

        Session::flash('flash_message', 'CounselingCoursesDetail added!');

        return redirect('counseling/counseling-courses-details');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCoursesDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcoursesdetail = CounselingCoursesDetail::orderBy('counseling_courses_details.id', 'DESC')
                ->leftJoin('users as eID','counseling_courses_details.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'counseling_courses_details.functionalarea_id', '=', 'functionalarea.id')
                ->select('counseling_courses_details.id', 'title', 'description', 'image', 'bestChoiceOfCourse', 'jobsCareerOpportunityDesc','slug','functionalarea_id','counseling_courses_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_courses_details.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                 ->findOrFail($id);

        $counselingCoursesEducationLevelObj = DB::table('counseling_courses_education_levels')
            ->leftjoin('eligibility_criterias', 'counseling_courses_education_levels.educationlevel_id', '=', 'eligibility_criterias.id')
            ->select('eligibility_criterias.id','eligibility_criterias.name')
            ->where('counseling_courses_education_levels.coursesDetailsId', '=', $id)
            ->orderBy('eligibility_criterias.name', 'ASC')
            ->get();

        $counselingCoursesMoreDetailObj     =  DB::table('counseling_courses_more_details')
                                                ->leftjoin('degree', 'counseling_courses_more_details.degree_id', '=', 'degree.id')
                                                ->where('coursesDetailsId','=', $id)
                                                ->select('counseling_courses_more_details.id', 'title', 'description', 'popularCities', 'specialisations', 'entranceExamsName', 'coursesDetailsId', 'degree_id', 'degree.id as degreeID','degree.name as degreeName')
                                                ->orderBy('counseling_courses_more_details.id', 'ASC')
                                                ->get();
       
        $counselingCoursesJobCareerObj  =  DB::table('counseling_courses_job_careers')
                                                ->where('coursesDetailsId','=', $id)
                                                ->orderBy('counseling_courses_job_careers.id', 'ASC')
                                                ->get();

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.courseId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();


        return view('counseling.counseling-courses-details.show', compact('counselingcoursesdetail','counselingCoursesEducationLevelObj','counselingCoursesMoreDetailObj','counselingCoursesJobCareerObj','seocontent'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCoursesDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcoursesdetail = CounselingCoursesDetail::findOrFail($id);
        $functionalAreaObj = FunctionalArea::all();
        //$educationLevelObj = EducationLevel::all();
        $eligibilityCriterion           = EligibilityCriterion::get();
        $counselingCoursesEducationLevelObj = DB::table('counseling_courses_education_levels')
                    ->leftjoin('eligibility_criterias', 'counseling_courses_education_levels.educationlevel_id', '=', 'eligibility_criterias.id')
                    ->select('eligibility_criterias.id','eligibility_criterias.name')
                    ->where('counseling_courses_education_levels.coursesDetailsId', '=', $id)
                    ->orderBy('eligibility_criterias.name', 'ASC')
                    ->get();

         $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.courseId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                        ->get();

        return view('counseling.counseling-courses-details.edit', compact('counselingcoursesdetail','functionalAreaObj','counselingCoursesEducationLevelObj','eligibilityCriterion','seocontent'));
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
        $createObj = CounselingCoursesDetail::findOrFail($id);
        $createObj->title = Input::get('title');
        $createObj->description = Input::get('description');
        $createObj->bestChoiceOfCourse = Input::get('bestChoiceOfCourse');
        $createObj->jobsCareerOpportunityDesc = Input::get('jobsCareerOpportunityDesc');
        $createObj->functionalarea_id = Input::get('functionalarea_id');
        $createObj->employee_id = Auth::id();
        $createObj->save();

        $updateSlugObj = CounselingCoursesDetail::findOrFail($id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($createObj->title.'-'.$id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();

        if($request->file('image')){
            $fileName1 = 'counseling-courses-details-'.$id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_courses_details')->where('counseling_courses_details.id', '=', $id)->update(array('counseling_courses_details.image' => $fileName1)); 
        }

        $educationlevelIds = Input::get('educationlevel_id');
        if (sizeof($educationlevelIds) > 0) {
            DB::table('counseling_courses_education_levels')->where('counseling_courses_education_levels.coursesDetailsId', '=', $id)->delete();
            foreach ($educationlevelIds as $key => $value) {
                $degreeObj                         = EligibilityCriterion::orderBy('eligibility_criterias.id' ,'ASC')
                                                    ->where('eligibility_criterias.id','=', $value)
                                                    ->first();

                $addEducationLevelObj = New CounselingCoursesEducationLevel;
                $addEducationLevelObj->educationlevel_id = $value;
                $addEducationLevelObj->coursesDetailsId = $createObj->id;
                $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($degreeObj->name)); 
                $slug1 = strtolower(trim($cleanChar));
                $slug1 = preg_replace('/[^a-z0-9-]/', '-', $slug1);
                $slug1 = preg_replace('/-+/', "-", $slug1);
                rtrim($slug1, '-');
                $addEducationLevelObj->educationLevelSlug = $slug1;
                $addEducationLevelObj->functionalarea_id = Input::get('functionalarea_id');
                $addEducationLevelObj->save();
            }
        }

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());

        Session::flash('flash_message', 'CounselingCoursesDetail updated!');

        return redirect('counseling/counseling-courses-details');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCoursesDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::table('counseling_courses_more_details')
            ->where('counseling_courses_more_details.coursesDetailsId', '=', $id)
            ->delete();

        DB::table('counseling_courses_job_careers')
            ->where('counseling_courses_job_careers.coursesDetailsId', '=', $id)
            ->delete();

        DB::table('counseling_courses_education_levels')
            ->where('counseling_courses_education_levels.coursesDetailsId', '=', $id)
            ->delete();

        DB::table('seo_contents')
            ->where('seo_contents.courseId', '=', $id)
            ->delete();

        CounselingCoursesDetail::destroy($id);

        Session::flash('flash_message', 'CounselingCoursesDetail deleted!');

        return redirect('counseling/counseling-courses-details');
    }

    public function updateFormDetails($courseId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCoursesDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingCoursesDetailObj = CounselingCoursesDetail::orderBy('counseling_courses_details.id' ,'DESC')
                ->where('counseling_courses_details.id','=', $courseId)
                ->get();

        if (sizeof($counselingCoursesDetailObj) > 0) {
            $counselingCoursesDetail        = CounselingCoursesDetail::orderBy('counseling_courses_details.id' ,'DESC')
                                                    ->where('counseling_courses_details.id','=', $courseId)
                                                    ->first();

            $counselingCoursesMoreDetailObj     =  DB::table('counseling_courses_more_details')
                                                    ->where('coursesDetailsId','=', $courseId)
                                                    ->orderBy('counseling_courses_more_details.id', 'ASC')
                                                    ->get();
           
            $counselingCoursesJobCareerObj  =  DB::table('counseling_courses_job_careers')
                                                    ->where('coursesDetailsId','=', $courseId)
                                                    ->orderBy('counseling_courses_job_careers.id', 'ASC')
                                                    ->get();

            $degreeObj = DB::table('degree')
                    ->select('id','name')
                    ->where('degree.functionalarea_id', '=', $counselingCoursesDetail->functionalarea_id)
                    ->orderBy('degree.name', 'ASC')
                    ->get();

            return view('counseling.common-partial.all-course-form-details', compact('counselingCoursesDetail','counselingCoursesMoreDetailObj','counselingCoursesJobCareerObj','courseId','degreeObj'));
        }else{
            return redirect('counseling/counseling-boards');
        }
    }

    public function updateCounselingCourseDetails(Request $request, $courseId)
    {   
        $counselingCoursesDetail        = CounselingCoursesDetail::orderBy('counseling_courses_details.id' ,'DESC')
                                            ->where('counseling_courses_details.id','=', $courseId)
                                            ->first();

        DB::statement(DB::raw("DELETE FROM counseling_courses_more_details WHERE (coursesDetailsId = $courseId)"));
        if (!empty(Input::get('title'))) {
            $sizeOfCourseDetails = sizeof(Input::get('title'));
            for($counter = 0; $counter < $sizeOfCourseDetails; $counter++){
                $createHighlightObj                          = New CounselingCoursesMoreDetail();
                $createHighlightObj->title                   = Input::get('title')[$counter];
                $createHighlightObj->description             = Input::get('description')[$counter];
                $createHighlightObj->popularCities           = Input::get('popularCities')[$counter];
                $createHighlightObj->specialisations         = Input::get('specialisations')[$counter];
                $createHighlightObj->entranceExamsName       = Input::get('entranceExamsName')[$counter];
                $createHighlightObj->degree_id               = Input::get('degree_id')[$counter];
                $createHighlightObj->coursesDetailsId        = $courseId;
                $createHighlightObj->functionalarea_id       = $counselingCoursesDetail->functionalarea_id;
                $createHighlightObj->employee_id             = Auth::id();
                $createHighlightObj->save();

            }
        }
        
        DB::statement(DB::raw("DELETE FROM counseling_courses_job_careers WHERE (coursesDetailsId = $courseId)"));
        if (!empty(Input::get('courseName'))) {
            $sizeOfCareerJobs = sizeof(Input::get('courseName'));
            for($jobsCounter = 0; $jobsCounter < $sizeOfCareerJobs; $jobsCounter++){
                $createImpDateObj                          = New CounselingCoursesJobCareer();
                $createImpDateObj->courseName              = Input::get('courseName')[$jobsCounter];
                $createImpDateObj->jobProfiles             = Input::get('jobProfiles')[$jobsCounter];
                $createImpDateObj->avgSalery               = Input::get('avgSalery')[$jobsCounter];
                $createImpDateObj->topCompany              = Input::get('topCompany')[$jobsCounter];
                $createImpDateObj->coursesDetailsId        = $courseId;
                $createImpDateObj->employee_id             = Auth::id();
                $createImpDateObj->save();
            }
        }

        Session::flash('alert_class', 'alert-success');    
        Session::flash('flash_message', 'Counseling course details has been updated!');
        return Redirect::back();
    }
}
