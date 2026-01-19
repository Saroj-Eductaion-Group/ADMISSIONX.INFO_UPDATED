<?php

namespace App\Http\Controllers\counseling;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CounselingCareerRelevant;
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
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\EducationLevel as EducationLevel;
use App\Models\Degree as Degree;
use App\Models\EligibilityCriterion;
use App\Models\CounselingCareerDetail;
use App\Models\CounselingCareerJobRoleSalery;
use App\Models\CounselingCareerInterest;
use App\Models\CounselingCareerSkillRequirement;
use App\Models\CounselingCareerWhereToStudy;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class CounselingCareerRelevantController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerRelevant');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CounselingCareerRelevant::orderBy('counseling_career_relevants.id', 'DESC')
                ->leftJoin('users as eID','counseling_career_relevants.employee_id', '=','eID.id')
                ->leftjoin('counseling_career_interests', 'counseling_career_relevants.careerInterest', '=', 'counseling_career_interests.id')
                ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id');

        if (!empty($keyword)) {
            $query->orWhere('counseling_career_relevants.title', 'LIKE', "%$keyword%");
            $query->orWhere('counseling_career_relevants.description', 'LIKE', "%$keyword%");
            $query->orWhere('counseling_career_relevants.stream', 'LIKE', "%$keyword%");
            $query->orWhere('counseling_career_relevants.mandatorySubject', 'LIKE', "%$keyword%");
            $query->orWhere('counseling_career_relevants.academicDifficulty', 'LIKE', "%$keyword%");
        }

        if ($request->has('careerInterest') && !empty($request->get('careerInterest'))) {
            $query->where('counseling_career_relevants.careerInterest', '=', Input::get('careerInterest'));
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('counseling_career_relevants.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('counseling_career_relevants.status', '=', Input::get('status'));
            }
        }

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('counseling_career_relevants.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        $counselingcareerrelevant = $query->paginate(20, array('counseling_career_relevants.id', 'counseling_career_relevants.title', 'counseling_career_relevants.description', 'counseling_career_relevants.image', 'counseling_career_relevants.status','salery', 'stream', 'mandatorySubject', 'academicDifficulty', 'counseling_career_relevants.functionalarea_id', 'counseling_career_relevants.slug','counseling_career_relevants.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_career_relevants.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','counseling_career_interests.id as counseling_career_interestsID','counseling_career_interests.title as interestsTitle'));

        $counselingCareerInterestObj = DB::table('counseling_career_interests')
                                        ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                                        ->select('counseling_career_interests.id', 'counseling_career_interests.title', 'functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                                        ->where('counseling_career_interests.status', '=', '1')
                                        ->orderBy('counseling_career_interests.title', 'DESC')
                                        ->get();


        return view('counseling.counseling-career-relevant.index', compact('counselingcareerrelevant','counselingCareerInterestObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerRelevant');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingCareerInterestObj = DB::table('counseling_career_interests')
                                        ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                                        ->select('counseling_career_interests.id', 'counseling_career_interests.title', 'functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                                        ->where('counseling_career_interests.status', '=', '1')
                                        ->orderBy('counseling_career_interests.title', 'DESC')
                                        ->get();

        return view('counseling.counseling-career-relevant.create', compact('counselingCareerInterestObj'));
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
        $CounselingCareerInterest       = CounselingCareerInterest::findOrFail(Input::get('careerInterest'));

        $createObj                      = New CounselingCareerRelevant();
        $createObj->title               = Input::get('title');
        $createObj->description         = Input::get('description');
        $createObj->status              = Input::get('status');
        $createObj->salery              = Input::get('salery');
        $createObj->stream              = Input::get('stream');
        $createObj->mandatorySubject    = Input::get('mandatorySubject');
        $createObj->academicDifficulty  = Input::get('academicDifficulty');
        $createObj->careerInterest      = Input::get('careerInterest');
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('title'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $createObj->slug                = $slug;
        $createObj->functionalarea_id   = $CounselingCareerInterest->functionalarea_id;
        $createObj->employee_id         = Auth::id();
        $createObj->save();

        if($request->file('image')){
            $fileName1 = 'counseling-career-relevants-'.$createObj->id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_career_relevants')->where('counseling_career_relevants.id', '=', $createObj->id)->update(array('counseling_career_relevants.image' => $fileName1)); 
        }

        $releventObj = New CounselingCareerDetail();
        $releventObj->status = 1;
        $releventObj->functionalarea_id   = $CounselingCareerInterest->functionalarea_id;
        $releventObj->careerRelevantId    = $createObj->id;
        $releventObj->employee_id = Auth::id();
        $releventObj->save();

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());

        Session::flash('flash_message', 'Counseling Career Relevant added!');


        return redirect('/counseling/career/update-form-details/'.$createObj->id);
        //return redirect('counseling/counseling-career-relevant');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerRelevant');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcareerrelevant = CounselingCareerRelevant::orderBy('counseling_career_relevants.id', 'DESC')
                ->leftJoin('users as eID','counseling_career_relevants.employee_id', '=','eID.id')
                ->leftjoin('counseling_career_interests', 'counseling_career_relevants.careerInterest', '=', 'counseling_career_interests.id')
                ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                ->select('counseling_career_relevants.id', 'counseling_career_relevants.title', 'counseling_career_relevants.description', 'counseling_career_relevants.image', 'counseling_career_relevants.status','salery', 'stream', 'mandatorySubject', 'academicDifficulty', 'counseling_career_relevants.functionalarea_id', 'counseling_career_relevants.slug','counseling_career_relevants.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_career_relevants.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','counseling_career_interests.id as counseling_career_interestsID','counseling_career_interests.title as interestsTitle')
                ->findOrFail($id);

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.careerReleventId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();


        return view('counseling.counseling-career-relevant.show', compact('counselingcareerrelevant','seocontent'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerRelevant');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcareerrelevant       = CounselingCareerRelevant::findOrFail($id);
        $counselingCareerInterestObj    = DB::table('counseling_career_interests')
                                            ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                                            ->select('counseling_career_interests.id', 'counseling_career_interests.title', 'functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                                            ->where('counseling_career_interests.status', '=', '1')
                                            ->orderBy('counseling_career_interests.title', 'DESC')
                                            ->get();

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.careerReleventId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                        ->get();


        return view('counseling.counseling-career-relevant.edit', compact('counselingcareerrelevant','counselingCareerInterestObj','seocontent'));
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
        $CounselingCareerInterest       = CounselingCareerInterest::findOrFail(Input::get('careerInterest'));

        $updateObj                      = CounselingCareerRelevant::findOrFail($id);
        $updateObj->title               = Input::get('title');
        $updateObj->description         = Input::get('description');
        $updateObj->status              = Input::get('status');
        $updateObj->salery              = Input::get('salery');
        $updateObj->stream              = Input::get('stream');
        $updateObj->mandatorySubject    = Input::get('mandatorySubject');
        $updateObj->academicDifficulty  = Input::get('academicDifficulty');
        $updateObj->careerInterest      = Input::get('careerInterest');
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('title'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateObj->slug                = $slug;
        $updateObj->functionalarea_id   = $CounselingCareerInterest->functionalarea_id;
        $updateObj->employee_id         = Auth::id();
        $updateObj->save();

        if($request->file('image')){
            $fileName1 = 'counseling-career-relevants-'.$id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_career_relevants')->where('counseling_career_relevants.id', '=', $id)->update(array('counseling_career_relevants.image' => $fileName1)); 
        }

        $counselingCareerDetailObj = CounselingCareerDetail::orderBy('counseling_career_details.id' ,'DESC')
                ->where('counseling_career_details.careerRelevantId','=', $id)
                ->select('id')
                ->get();

        if (sizeof($counselingCareerDetailObj) == 0) {
            $releventObj = New CounselingCareerDetail();
            $releventObj->status = 1;
            $releventObj->functionalarea_id   = $CounselingCareerInterest->functionalarea_id;
            $releventObj->careerRelevantId    = $id;
            $releventObj->employee_id = Auth::id();
            $releventObj->save();
        }

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($updateObj->id, $request->all());

        Session::flash('flash_message', 'Counseling Career Relevant updated!');

        return redirect('counseling/counseling-career-relevant');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerRelevant');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcareerdetail     = CounselingCareerDetail::orderBy('counseling_career_details.id' ,'DESC')->where('counseling_career_details.careerRelevantId','=', $id)->first();

        $careerId   =   $counselingcareerdetail->id;

        DB::table('counseling_career_where_to_studies')
            ->where('counseling_career_where_to_studies.careerDetailsId', '=', $careerId)
            ->delete();

        DB::table('counseling_career_job_role_saleries')
            ->where('counseling_career_job_role_saleries.careerDetailsId', '=', $careerId)
            ->delete();

        DB::table('counseling_career_skill_requirements')
            ->where('counseling_career_skill_requirements.careerDetailsId', '=', $careerId)
            ->delete();

        DB::table('seo_contents')
            ->where('seo_contents.careerReleventId', '=', $id)
            ->delete();

        DB::table('counseling_career_details')
            ->where('counseling_career_details.careerRelevantId', '=', $id)
            ->delete();

        CounselingCareerRelevant::destroy($id);

        Session::flash('flash_message', 'CounselingCareerRelevant deleted!');

        return redirect('counseling/counseling-career-relevant');
    }

    public function updateFormDetails($careerRelevantId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerRelevant');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingCareerDetailObj = CounselingCareerDetail::orderBy('counseling_career_details.id' ,'DESC')
                ->where('counseling_career_details.careerRelevantId','=', $careerRelevantId)
                ->select('id')
                ->get();

        if (sizeof($counselingCareerDetailObj) > 0) {
            $counselingcareerdetail        = CounselingCareerDetail::orderBy('counseling_career_details.id' ,'DESC')
                                                    ->where('counseling_career_details.id','=', $counselingCareerDetailObj[0]->id)
                                                    ->first();

            $careerId   =   $counselingcareerdetail->id;


            $counselingCareerSkillRequirementObj    =  DB::table('counseling_career_skill_requirements')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_skill_requirements.id', 'ASC')
                                                        ->get();

            $counselingCareerJobRoleSaleryObj       =  DB::table('counseling_career_job_role_saleries')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_job_role_saleries.id', 'ASC')
                                                        ->get();  

            $counselingCareerWhereToStudyObj         =  DB::table('counseling_career_where_to_studies')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_where_to_studies.id', 'ASC')
                                                        ->get();

            return view('counseling.common-partial.all-career-form-details', compact('counselingcareerdetail', 'counselingCareerJobRoleSaleryObj','counselingCareerWhereToStudyObj','counselingCareerSkillRequirementObj','careerId'));
        }else{
            return redirect('counseling/counseling-career-relevant');
        }
    }

    public function updateCounselingCareerDetails(Request $request, $careerId)
    {   
        $counselingCoursesDetail        = CounselingCareerDetail::orderBy('counseling_career_details.id' ,'DESC')
                                            ->where('counseling_career_details.id','=', $careerId)
                                            ->first();

        if (!empty($counselingCoursesDetail)) {
            $updateObj = CounselingCareerDetail::findOrFail($careerId);
        }else{
            $updateObj = New CounselingCareerDetail();
        }
        $updateObj->title = Input::get('title');
        $updateObj->description = Input::get('description');
        $updateObj->status = Input::get('status');
        $updateObj->jobProfileDesc = Input::get('jobProfileDesc');
        $updateObj->totalLikes = Input::get('totalLikes');
        $updateObj->pros = Input::get('pros');
        $updateObj->cons = Input::get('cons');
        $updateObj->futureGrowthPurpose = Input::get('futureGrowthPurpose');
        $updateObj->employeeOpportunities = Input::get('employeeOpportunities');
        $updateObj->studyMaterial = Input::get('studyMaterial');
        $updateObj->whereToStudy = Input::get('whereToStudy');
        $updateObj->purpose_desc = Input::get('purpose_desc');
        $updateObj->eligibility = Input::get('eligibility');
        $updateObj->qualification = Input::get('qualification');
        $updateObj->syllabus = Input::get('syllabus');
        $updateObj->exam_pattern = Input::get('exam_pattern');
        $updateObj->selection_criteria = Input::get('selection_criteria');
        $updateObj->frequency = Input::get('frequency');
        $updateObj->other_details = Input::get('other_details');
        $updateObj->employee_id = Auth::id();
        $updateObj->save();


        $updateSlugObj = CounselingCareerDetail::findOrFail($updateObj->id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($updateObj->title.'-'.$updateObj->id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();


        if($request->file('image')){
            $fileName1 = 'counseling-career-details-'.$updateObj->id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_career_details')->where('counseling_career_details.id', '=', $updateObj->id)->update(array('counseling_career_details.image' => $fileName1)); 
        }

        DB::statement(DB::raw("DELETE FROM counseling_career_skill_requirements WHERE (careerDetailsId = $updateObj->id)"));
        if (!empty(Input::get('skillTitle'))) {
            $sizeOfSkillTitle = sizeof(Input::get('skillTitle'));
            for($skillTITleCounter = 0; $skillTITleCounter < $sizeOfSkillTitle; $skillTITleCounter++){
                $createImpDateObj                          = New CounselingCareerSkillRequirement();
                $createImpDateObj->title                   = Input::get('skillTitle')[$skillTITleCounter];
                $createImpDateObj->careerDetailsId         = $updateObj->id;
                $createImpDateObj->employee_id             = Auth::id();
                $createImpDateObj->save();
            }
        }


        DB::statement(DB::raw("DELETE FROM counseling_career_job_role_saleries WHERE (careerDetailsId = $updateObj->id)"));
        if (!empty(Input::get('jobTitle'))) {
            $sizeOfJobTitle = sizeof(Input::get('jobTitle'));
            for($jobTitleCounter = 0; $jobTitleCounter < $sizeOfJobTitle; $jobTitleCounter++){
                $createHighlightObj                          = New CounselingCareerJobRoleSalery();
                $createHighlightObj->title                   = Input::get('jobTitle')[$jobTitleCounter];
                $createHighlightObj->avgSalery               = Input::get('jobAvgSalery')[$jobTitleCounter];
                $createHighlightObj->topCompany              = Input::get('jobTopCompany')[$jobTitleCounter];
                $createHighlightObj->careerDetailsId         = $updateObj->id;
                $createHighlightObj->employee_id             = Auth::id();
                $createHighlightObj->save();
            }
        }

        DB::statement(DB::raw("DELETE FROM counseling_career_where_to_studies WHERE (careerDetailsId = $updateObj->id)"));
        if (!empty(Input::get('studyInstituteName'))) {
            $sizeOfWhereToStudy = sizeof(Input::get('studyInstituteName'));
            for($whereToStudyCounter = 0; $whereToStudyCounter < $sizeOfWhereToStudy; $whereToStudyCounter++){
                $createLatestUpdateObj                     = New CounselingCareerWhereToStudy();
                $createLatestUpdateObj->instituteName      = Input::get('studyInstituteName')[$whereToStudyCounter];
                $createLatestUpdateObj->instituteUrl       = Input::get('studyInstituteUrl')[$whereToStudyCounter];
                $createLatestUpdateObj->city               = Input::get('studyCity')[$whereToStudyCounter];
                $createLatestUpdateObj->programmeFees      = Input::get('studyProgrammeFees')[$whereToStudyCounter];
                $createLatestUpdateObj->careerDetailsId    = $updateObj->id;
                $createLatestUpdateObj->employee_id        = Auth::id();
                $createLatestUpdateObj->save();
            }
        }

        Session::flash('alert_class', 'alert-success');    
        Session::flash('flash_message', 'Counseling Career Detail has been updated!');
        return Redirect::back();
    }
}
