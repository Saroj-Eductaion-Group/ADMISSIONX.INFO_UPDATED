<?php

namespace App\Http\Controllers\counseling;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CounselingCareerDetail;
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
use App\Models\CounselingCareerInterest;
use App\Models\CounselingCareerJobRoleSalery;
use App\Models\CounselingCareerRelevant;
use App\Models\CounselingCareerSkillRequirement;
use App\Models\CounselingCareerWhereToStudy;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;


class CounselingCareerDetailsController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $query = CounselingCareerDetail::orderBy('counseling_career_details.id', 'DESC')
                ->leftJoin('users as eID','counseling_career_details.employee_id', '=','eID.id');

        if (!empty($keyword)) {
            $query->orWhere('counseling_career_details.title', 'LIKE', "%$keyword%");
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('counseling_career_details.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('counseling_career_details.status', '=', Input::get('status'));
            }
        }

        $query->where('counseling_career_details.functionalarea_id', '=', null);
        $query->where('counseling_career_details.careerRelevantId', '=', null);

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('counseling_career_details.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        $counselingcareerdetails = $query->paginate(20, array('counseling_career_details.id','title', 'description', 'image', 'jobProfileDesc', 'totalLikes', 'pros', 'cons','status', 'futureGrowthPurpose', 'employeeOpportunities', 'studyMaterial', 'whereToStudy', 'functionalarea_id', 'slug', 'careerRelevantId','counseling_career_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_career_details.updated_at','counseling_career_details.purpose_desc','counseling_career_details.eligibility','counseling_career_details.qualification','counseling_career_details.syllabus','counseling_career_details.exam_pattern','counseling_career_details.selection_criteria','counseling_career_details.frequency','counseling_career_details.other_details'));

        return view('counseling.counseling-career-details.index', compact('counselingcareerdetails'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        return view('counseling.counseling-career-details.create');
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
        $createObj = New CounselingCareerDetail();
        $createObj->title = Input::get('title');
        $createObj->description = Input::get('description');
        $createObj->status = Input::get('status');
        $createObj->jobProfileDesc = Input::get('jobProfileDesc');
        $createObj->totalLikes = Input::get('totalLikes');
        $createObj->pros = Input::get('pros');
        $createObj->cons = Input::get('cons');
        $createObj->futureGrowthPurpose = Input::get('futureGrowthPurpose');
        $createObj->employeeOpportunities = Input::get('employeeOpportunities');
        $createObj->studyMaterial = Input::get('studyMaterial');
        $createObj->whereToStudy = Input::get('whereToStudy');
        $createObj->purpose_desc = Input::get('purpose_desc');
        $createObj->eligibility = Input::get('eligibility');
        $createObj->qualification = Input::get('qualification');
        $createObj->syllabus = Input::get('syllabus');
        $createObj->exam_pattern = Input::get('exam_pattern');
        $createObj->selection_criteria = Input::get('selection_criteria');
        $createObj->frequency = Input::get('frequency');
        $createObj->other_details = Input::get('other_details');
        $createObj->functionalarea_id = null;
        $createObj->careerRelevantId = null;
        $createObj->employee_id = Auth::id();
        $createObj->save();

        $updateSlugObj = CounselingCareerDetail::findOrFail($createObj->id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($createObj->title.'-'.$createObj->id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();

        if($request->file('image')){
            $fileName1 = 'counseling-career-detail-'.$createObj->id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_career_details')->where('counseling_career_details.id', '=', $createObj->id)->update(array('counseling_career_details.image' => $fileName1)); 
        }

        DB::statement(DB::raw("DELETE FROM counseling_career_skill_requirements WHERE (careerDetailsId = $createObj->id)"));
        if (!empty(Input::get('skillTitle'))) {
            $sizeOfSkillTitle = sizeof(Input::get('skillTitle'));
            for($skillTITleCounter = 0; $skillTITleCounter < $sizeOfSkillTitle; $skillTITleCounter++){
                $createImpDateObj                          = New CounselingCareerSkillRequirement();
                $createImpDateObj->title                   = Input::get('skillTitle')[$skillTITleCounter];
                $createImpDateObj->careerDetailsId         = $createObj->id;
                $createImpDateObj->employee_id             = Auth::id();
                $createImpDateObj->save();
            }
        }


        DB::statement(DB::raw("DELETE FROM counseling_career_job_role_saleries WHERE (careerDetailsId = $createObj->id)"));
        if (!empty(Input::get('jobTitle'))) {
            $sizeOfJobTitle = sizeof(Input::get('jobTitle'));
            for($jobTitleCounter = 0; $jobTitleCounter < $sizeOfJobTitle; $jobTitleCounter++){
                $createHighlightObj                          = New CounselingCareerJobRoleSalery();
                $createHighlightObj->title                   = Input::get('jobTitle')[$jobTitleCounter];
                $createHighlightObj->avgSalery               = Input::get('jobAvgSalery')[$jobTitleCounter];
                $createHighlightObj->topCompany              = Input::get('jobTopCompany')[$jobTitleCounter];
                $createHighlightObj->careerDetailsId         = $createObj->id;
                $createHighlightObj->employee_id             = Auth::id();
                $createHighlightObj->save();
            }
        }

        DB::statement(DB::raw("DELETE FROM counseling_career_where_to_studies WHERE (careerDetailsId = $createObj->id)"));
        if (!empty(Input::get('studyInstituteName'))) {
            $sizeOfWhereToStudy = sizeof(Input::get('studyInstituteName'));
            for($whereToStudyCounter = 0; $whereToStudyCounter < $sizeOfWhereToStudy; $whereToStudyCounter++){
                $createLatestUpdateObj                     = New CounselingCareerWhereToStudy();
                $createLatestUpdateObj->instituteName      = Input::get('studyInstituteName')[$whereToStudyCounter];
                $createLatestUpdateObj->instituteUrl       = Input::get('studyInstituteUrl')[$whereToStudyCounter];
                $createLatestUpdateObj->city               = Input::get('studyCity')[$whereToStudyCounter];
                $createLatestUpdateObj->programmeFees      = Input::get('studyProgrammeFees')[$whereToStudyCounter];
                $createLatestUpdateObj->careerDetailsId    = $createObj->id;
                $createLatestUpdateObj->employee_id        = Auth::id();
                $createLatestUpdateObj->save();
            }
        }

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());

        Session::flash('flash_message', 'Counseling Career Detail added!');

        return redirect('counseling/counseling-career-details');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcareerdetail = CounselingCareerDetail::orderBy('counseling_career_details.id', 'DESC')
                ->leftJoin('users as eID','counseling_career_details.employee_id', '=','eID.id')
                ->where('counseling_career_details.functionalarea_id', '=', null)
                ->where('counseling_career_details.careerRelevantId', '=', null)
                ->select('counseling_career_details.id','title', 'description', 'image', 'jobProfileDesc', 'totalLikes', 'pros', 'cons','status', 'futureGrowthPurpose', 'employeeOpportunities', 'studyMaterial', 'whereToStudy', 'functionalarea_id', 'slug', 'careerRelevantId','counseling_career_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_career_details.updated_at','counseling_career_details.purpose_desc','counseling_career_details.eligibility','counseling_career_details.qualification','counseling_career_details.syllabus','counseling_career_details.exam_pattern','counseling_career_details.selection_criteria','counseling_career_details.frequency','counseling_career_details.other_details')
            ->findOrFail($id);

        $counselingCareerSkillRequirementObj    =  DB::table('counseling_career_skill_requirements')
                                                    ->where('careerDetailsId','=', $id)
                                                    ->orderBy('counseling_career_skill_requirements.id', 'ASC')
                                                    ->get();

        $counselingCareerJobRoleSaleryObj       =  DB::table('counseling_career_job_role_saleries')
                                                    ->where('careerDetailsId','=', $id)
                                                    ->orderBy('counseling_career_job_role_saleries.id', 'ASC')
                                                    ->get();  

        $counselingCareerWhereToStudyObj         =  DB::table('counseling_career_where_to_studies')
                                                    ->where('careerDetailsId','=', $id)
                                                    ->orderBy('counseling_career_where_to_studies.id', 'ASC')
                                                    ->get();


        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.popularCareerId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();


        return view('counseling.counseling-career-details.show', compact('counselingcareerdetail','counselingCareerJobRoleSaleryObj','counselingCareerWhereToStudyObj','counselingCareerSkillRequirementObj','seocontent'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcareerdetail = CounselingCareerDetail::findOrFail($id);

        $counselingCareerSkillRequirementObj    =  DB::table('counseling_career_skill_requirements')
                                                    ->where('careerDetailsId','=', $id)
                                                    ->orderBy('counseling_career_skill_requirements.id', 'ASC')
                                                    ->get();

        $counselingCareerJobRoleSaleryObj       =  DB::table('counseling_career_job_role_saleries')
                                                    ->where('careerDetailsId','=', $id)
                                                    ->orderBy('counseling_career_job_role_saleries.id', 'ASC')
                                                    ->get();  

        $counselingCareerWhereToStudyObj         =  DB::table('counseling_career_where_to_studies')
                                                    ->where('careerDetailsId','=', $id)
                                                    ->orderBy('counseling_career_where_to_studies.id', 'ASC')
                                                    ->get();

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.popularCareerId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                        ->get();

        return view('counseling.counseling-career-details.edit', compact('counselingcareerdetail', 'counselingCareerJobRoleSaleryObj','counselingCareerWhereToStudyObj','counselingCareerSkillRequirementObj','seocontent'));
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
        $updateObj = CounselingCareerDetail::findOrFail($id);
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
        $updateObj->functionalarea_id = null;
        $updateObj->careerRelevantId = null;
        $updateObj->employee_id = Auth::id();
        $updateObj->save();

        $updateSlugObj = CounselingCareerDetail::findOrFail($id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($updateObj->title.'-'.$id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();

        if($request->file('image')){
            $fileName1 = 'counseling-career-detail-'.$id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_career_details')->where('counseling_career_details.id', '=', $id)->update(array('counseling_career_details.image' => $fileName1)); 
        }


        DB::statement(DB::raw("DELETE FROM counseling_career_skill_requirements WHERE (careerDetailsId = $id)"));
        if (!empty(Input::get('skillTitle'))) {
            $sizeOfSkillTitle = sizeof(Input::get('skillTitle'));
            for($skillTITleCounter = 0; $skillTITleCounter < $sizeOfSkillTitle; $skillTITleCounter++){
                $createImpDateObj                          = New CounselingCareerSkillRequirement();
                $createImpDateObj->title                   = Input::get('skillTitle')[$skillTITleCounter];
                $createImpDateObj->careerDetailsId         = $id;
                $createImpDateObj->employee_id             = Auth::id();
                $createImpDateObj->save();
            }
        }


        DB::statement(DB::raw("DELETE FROM counseling_career_job_role_saleries WHERE (careerDetailsId = $id)"));
        if (!empty(Input::get('jobTitle'))) {
            $sizeOfJobTitle = sizeof(Input::get('jobTitle'));
            for($jobTitleCounter = 0; $jobTitleCounter < $sizeOfJobTitle; $jobTitleCounter++){
                $createHighlightObj                          = New CounselingCareerJobRoleSalery();
                $createHighlightObj->title                   = Input::get('jobTitle')[$jobTitleCounter];
                $createHighlightObj->avgSalery               = Input::get('jobAvgSalery')[$jobTitleCounter];
                $createHighlightObj->topCompany              = Input::get('jobTopCompany')[$jobTitleCounter];
                $createHighlightObj->careerDetailsId         = $id;
                $createHighlightObj->employee_id             = Auth::id();
                $createHighlightObj->save();
            }
        }

        DB::statement(DB::raw("DELETE FROM counseling_career_where_to_studies WHERE (careerDetailsId = $id)"));
        if (!empty(Input::get('studyInstituteName'))) {
            $sizeOfWhereToStudy = sizeof(Input::get('studyInstituteName'));
            for($whereToStudyCounter = 0; $whereToStudyCounter < $sizeOfWhereToStudy; $whereToStudyCounter++){
                $createLatestUpdateObj                     = New CounselingCareerWhereToStudy();
                $createLatestUpdateObj->instituteName      = Input::get('studyInstituteName')[$whereToStudyCounter];
                $createLatestUpdateObj->instituteUrl       = Input::get('studyInstituteUrl')[$whereToStudyCounter];
                $createLatestUpdateObj->city               = Input::get('studyCity')[$whereToStudyCounter];
                $createLatestUpdateObj->programmeFees      = Input::get('studyProgrammeFees')[$whereToStudyCounter];
                $createLatestUpdateObj->careerDetailsId    = $id;
                $createLatestUpdateObj->employee_id        = Auth::id();
                $createLatestUpdateObj->save();
            }
        }

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());

        Session::flash('flash_message', 'Counseling Career Detail updated!');

        return redirect('counseling/counseling-career-details');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::table('counseling_career_where_to_studies')
            ->where('counseling_career_where_to_studies.careerDetailsId', '=', $id)
            ->delete();

        DB::table('counseling_career_job_role_saleries')
            ->where('counseling_career_job_role_saleries.careerDetailsId', '=', $id)
            ->delete();

        DB::table('counseling_career_skill_requirements')
            ->where('counseling_career_skill_requirements.careerDetailsId', '=', $id)
            ->delete();

        DB::table('seo_contents')
            ->where('seo_contents.popularCareerId', '=', $id)
            ->delete();
            
        CounselingCareerDetail::destroy($id);

        Session::flash('flash_message', 'Counseling Career Detail deleted!');

        return redirect('counseling/counseling-career-details');
    }
}
