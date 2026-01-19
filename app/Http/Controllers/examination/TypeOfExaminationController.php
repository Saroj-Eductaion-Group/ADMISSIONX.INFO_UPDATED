<?php

namespace App\Http\Controllers\examination;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\TypeOfExamination;
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
use Excel;
use Config;
use PHPMailer;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\ExamSection as ExamSection;
use App\Models\University as University;
use App\Models\ExamListMultipleDegree;
use App\Models\ExaminationDetail;
use App\Models\ExamApplicationProcess;
use App\Models\Degree;
use App\Models\ExaminationType;
use App\Models\ApplicationAndExamStatus;
use App\Models\ApplicationMode;
use App\Models\ExaminationMode;
use App\Models\EligibilityCriterion;
use App\Models\SeoContent;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionAnswer;
use App\Models\ExamQuestionAnswerComment;
use App\Http\Controllers\Helper\FetchDataServiceController;

class TypeOfExaminationController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = TypeOfExamination::orderBy('type_of_examinations.id', 'DESC')
                ->leftJoin('users as eID','type_of_examinations.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'type_of_examinations.functionalarea_id', '=', 'functionalarea.id')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->leftjoin('examination_details', 'type_of_examinations.id', '=', 'examination_details.typeOfExaminations_id')
                ->leftjoin('exam_application_processes', 'type_of_examinations.id', '=', 'exam_application_processes.typeOfExaminations_id')
                ->leftjoin('examination_types', 'exam_application_processes.examinationtype', '=', 'examination_types.id')
                ->leftjoin('application_and_exam_statuses', 'exam_application_processes.applicationandexamstatus', '=', 'application_and_exam_statuses.id')
                ->leftjoin('application_modes', 'exam_application_processes.modeofapplication', '=', 'application_modes.id')
                ->leftjoin('examination_modes', 'exam_application_processes.examinationmode', '=', 'examination_modes.id')
                ->leftjoin('eligibility_criterias', 'exam_application_processes.eligibilitycriteria', '=', 'eligibility_criterias.id');

        if (!empty($keyword)) {
            $query->where('type_of_examinations.name', 'LIKE', "%$keyword%");
            $query->orWhere('type_of_examinations.sortname', 'LIKE', "%$keyword%");
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('type_of_examinations.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('type_of_examinations.status', '=', Input::get('status'));
            }
        }

        $isShowOnTop = Input::get('isShowOnTop');
        if ($isShowOnTop == '0') {
            $query->where('type_of_examinations.isShowOnTop', '=', '0');
        }else{
            if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                $query->where('type_of_examinations.isShowOnTop', '=', Input::get('isShowOnTop'));
            }
        }

        $isShowOnHome = Input::get('isShowOnHome');
        if ($isShowOnHome == '0') {
            $query->where('type_of_examinations.isShowOnHome', '=', '0');
        }else{
            if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                $query->where('type_of_examinations.isShowOnHome', '=', Input::get('isShowOnHome'));
            }
        }

        if ($request->has('examsection') && !empty($request->get('examsection'))) {
            $query->where('type_of_examinations.examsection_id', '=', Input::get('examsection'));
        }

        if ($request->has('examinationtype') && !empty($request->get('examinationtype'))) {
            $query->where('exam_application_processes.examinationtype', '=', Input::get('examinationtype'));
        }
     
        if ($request->has('applicationandexamstatus') && !empty($request->get('applicationandexamstatus'))) {
            $query->where('exam_application_processes.applicationandexamstatus', '=', Input::get('applicationandexamstatus'));
        }

        if ($request->has('modeofapplication') && !empty($request->get('modeofapplication'))) {
            $query->where('exam_application_processes.modeofapplication', '=', Input::get('modeofapplication'));
        }

        if ($request->has('examinationmode') && !empty($request->get('examinationmode'))) {
            $query->where('exam_application_processes.examinationmode', '=', Input::get('examinationmode'));
        }

        if ($request->has('eligibilitycriteria') && !empty($request->get('eligibilitycriteria'))) {
            $query->where('exam_application_processes.eligibilitycriteria', '=', Input::get('eligibilitycriteria'));
        }

        if ($request->has('modeofpayment') && !empty($request->get('modeofpayment'))) {
            $query->where('exam_application_processes.modeofpayment', '=', Input::get('modeofpayment'));
        }

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('type_of_examinations.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        $typeofexamination = $query->paginate(20, array('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','type_of_examinations.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','type_of_examinations.updated_at','universitylogo','universityName','university_id','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle','examination_details.applicationFrom','examination_details.applicationTo','examination_details.exminationDate','examination_details.resultAnnounce','examination_details.totalLikes','examination_details.totalViews','examination_details.totalApplicationClick','modeofpayment','examination_types.name as examination_typesName','application_and_exam_statuses.name as applicationexamstatusesName','application_modes.name as application_modesName','examination_modes.name as examination_modesName','eligibility_criterias.name as eligibility_criteriasName','type_of_examinations.isShowOnTop','type_of_examinations.isShowOnHome'));


        $universityObj = DB::table('university')
                    ->select('id','name')
                    ->orderBy('university.name', 'ASC')
                    ->get()
                    ;

        $examsectionsObj = DB::table('exam_sections')
                    ->select('id','name')
                    ->orderBy('exam_sections.name', 'ASC')
                    ->get()
                    ;

        $examinationType                = ExaminationType::get();
        $applicationAndExamStatus       = ApplicationAndExamStatus::get();
        $applicationMode                = ApplicationMode::get();
        $examinationMode                = ExaminationMode::get();
        $eligibilityCriterion           = EligibilityCriterion::get();
        $tablename = 'type_of_examinations';
        return view('examination.type-of-examination.index', compact('typeofexamination','universityObj','examsectionsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','tablename'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examinationType                = ExaminationType::get();
        $applicationAndExamStatus       = ApplicationAndExamStatus::get();
        $applicationMode                = ApplicationMode::get();
        $examinationMode                = ExaminationMode::get();
        $eligibilityCriterion           = EligibilityCriterion::get();
        $universityObj = DB::table('university')
                    ->select('id','name')
                    ->orderBy('university.name', 'ASC')
                    ->get()
                    ;

        $examsectionsObj = DB::table('exam_sections')
                    ->select('id','name')
                    ->orderBy('exam_sections.name', 'ASC')
                    ->get()
                    ;
        return view('examination.type-of-examination.create',compact('universityObj','examsectionsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion'));
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
        $examsection = ExamSection::findOrFail(Input::get('examsection_id'));
        $createObj = New TypeOfExamination();
        $createObj->sortname = Input::get('sortname');
        $createObj->name = Input::get('name');
        $createObj->status = Input::get('status');
        $createObj->isShowOnTop    =  Input::get('isShowOnTop');
        $createObj->isShowOnHome   =  Input::get('isShowOnHome');
        $createObj->universityName = Input::get('universityName');
        $createObj->examsection_id = Input::get('examsection_id');
        $createObj->functionalarea_id = $examsection->functionalarea_id;
        $createObj->employee_id = Auth::id();
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('sortname'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $createObj->slug = $slug;
        $createObj->save();

        $degreeIds = Input::get('degreeIds');
        if (sizeof($degreeIds) > 0) {
            foreach ($degreeIds as $key => $value) {
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', $value)
                                                    ->first();

                $addDegreeObj = New ExamListMultipleDegree;
                $addDegreeObj->degree_id = $value;
                $addDegreeObj->typeOfExaminations_id = $createObj->id;
                $addDegreeObj->examsection_id = Input::get('examsection_id');
                $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($degreeObj->name)); 
                $slug1 = strtolower(trim($cleanChar));
                $slug1 = preg_replace('/[^a-z0-9-]/', '-', $slug1);
                $slug1 = preg_replace('/-+/', "-", $slug1);
                rtrim($slug1, '-');
                $addDegreeObj->degreeSlug = $slug1;
                $addDegreeObj->functionalarea_id = $examsection->functionalarea_id;
                $addDegreeObj->save();
            }
        }

        if($request->file('universitylogo')){
            $fileName = $slug.'-'.$createObj->id.".".$request->universitylogo->getClientOriginalExtension();
            $request->universitylogo->move(public_path('examinationlogo/'), $fileName);
            DB::table('type_of_examinations')->where('type_of_examinations.id', '=', $createObj->id)->update(array('type_of_examinations.universitylogo' => $fileName));
        }

        $createExaminationDetail                        = New ExaminationDetail;
        $createExaminationDetail->title                 = Input::get('examtitle');
        $createExaminationDetail->description           = Input::get('description');
        $createExaminationDetail->applicationFrom       = Input::get('applicationFrom');
        $createExaminationDetail->applicationTo         = Input::get('applicationTo');
        $createExaminationDetail->exminationDate        = Input::get('exminationDate');
        $createExaminationDetail->resultAnnounce        = Input::get('resultAnnounce');
        $createExaminationDetail->imagealttext          = Input::get('imagealttext');
        $createExaminationDetail->getMoreInfoLink       = Input::get('getMoreInfoLink');
        $createExaminationDetail->content               = Input::get('content');
        $createExaminationDetail->typeOfExaminations_id = $createObj->id;
        $createExaminationDetail->functionalarea_id     = $examsection->functionalarea_id;
        $createExaminationDetail->courses_id            = Input::get('examsection_id');
        $createExaminationDetail->slug                  = $createObj->slug;
        $createExaminationDetail->userId                = Auth::id();
        $createExaminationDetail->status                = 1;
        $createExaminationDetail->employee_id           = Auth::id();
        $createExaminationDetail->save();


        $createApplicationProcessObj                            =   New ExamApplicationProcess;
        $createApplicationProcessObj->modeofapplication         =   Input::get('modeofapplication');
        $createApplicationProcessObj->modeofpayment             =   Input::get('modeofpayment');
        $createApplicationProcessObj->examinationtype           =   Input::get('examinationtype');
        $createApplicationProcessObj->applicationandexamstatus  =   Input::get('applicationandexamstatus');
        $createApplicationProcessObj->examinationmode           =   Input::get('examinationmode');
        $createApplicationProcessObj->eligibilitycriteria       =   Input::get('eligibilitycriteria');
        $createApplicationProcessObj->typeOfExaminations_id     =   $createObj->id;
        $createApplicationProcessObj->employee_id               =   Auth::id();
        $createApplicationProcessObj->save();

        if($request->file('image')){
            $fileName1 = $createObj->slug.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('examinationlogo/'), $fileName1);
            DB::table('examination_details')->where('examination_details.id', '=', $createExaminationDetail->id)->update(array('examination_details.image' => $fileName1)); 
        }

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());

        Session::flash('flash_message', 'Type Of Examination added!');

        return redirect('examination/type-of-examination');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeofexamination = TypeOfExamination::orderBy('type_of_examinations.id', 'DESC')
                        ->leftJoin('users as eID','type_of_examinations.employee_id', '=','eID.id')
                        ->leftjoin('functionalarea', 'type_of_examinations.functionalarea_id', '=', 'functionalarea.id')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->leftjoin('examination_details', 'type_of_examinations.id', '=', 'examination_details.typeOfExaminations_id')
                        ->leftjoin('exam_application_processes', 'type_of_examinations.id', '=', 'exam_application_processes.typeOfExaminations_id')
                        ->leftjoin('examination_types', 'exam_application_processes.examinationtype', '=', 'examination_types.id')
                        ->leftjoin('application_and_exam_statuses', 'exam_application_processes.applicationandexamstatus', '=', 'application_and_exam_statuses.id')
                        ->leftjoin('application_modes', 'exam_application_processes.modeofapplication', '=', 'application_modes.id')
                        ->leftjoin('examination_modes', 'exam_application_processes.examinationmode', '=', 'examination_modes.id')
                        ->leftjoin('eligibility_criterias', 'exam_application_processes.eligibilitycriteria', '=', 'eligibility_criterias.id')
                        ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','type_of_examinations.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','type_of_examinations.updated_at','universitylogo','universityName','university_id','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle','examination_details.applicationFrom','examination_details.applicationTo','examination_details.exminationDate','examination_details.resultAnnounce','examination_details.totalLikes','examination_details.totalViews','examination_details.totalApplicationClick','modeofpayment','examination_types.name as examination_typesName','application_and_exam_statuses.name as applicationexamstatusesName','application_modes.name as application_modesName','examination_modes.name as examination_modesName','eligibility_criterias.name as eligibility_criteriasName')
                        ->findOrFail($id);

        $examListMultipleDegreeObj = DB::table('exam_list_multiple_degrees')
                    ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                    ->select('degree.id as degreeId','degree.name as degreeName')
                    ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $id)
                    ->orderBy('degree.name', 'ASC')
                    ->get()
                    ;

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.examId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();

        $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('TypeOfExamination','type_of_examinations',$id);
        $tablename = 'type_of_examinations';

        return view('examination.type-of-examination.show', compact('typeofexamination','examListMultipleDegreeObj','seocontent','newUpdatedFields','tablename'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeofexamination = TypeOfExamination::findOrFail($id);

        $universityObj = DB::table('university')
                    ->select('id','name')
                    ->orderBy('university.name', 'ASC')
                    ->get();

        $examsectionsObj = DB::table('exam_sections')
                    ->select('id','name')
                    ->orderBy('exam_sections.name', 'ASC')
                    ->get();

        $examListMultipleDegreeObj = DB::table('exam_list_multiple_degrees')
                    ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                    ->select('degree.id as degreeId','degree.name as degreeName')
                    ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $id)
                    ->orderBy('degree.name', 'ASC')
                    ->get();

        $degreeObj = DB::table('degree')
                    ->select('id','name')
                    ->where('degree.functionalarea_id', '=', $typeofexamination->functionalarea_id)
                    ->orderBy('degree.name', 'ASC')
                    ->get();

        $examinationType                = ExaminationType::get();
        $applicationAndExamStatus       = ApplicationAndExamStatus::get();
        $applicationMode                = ApplicationMode::get();
        $examinationMode                = ExaminationMode::get();
        $eligibilityCriterion           = EligibilityCriterion::get();

        $examinationDetailsObj          =  DB::table('examination_details')
                                            ->where('typeOfExaminations_id','=', $id)
                                            ->orderBy('examination_details.id', 'ASC')
                                            ->first();  

        $examApplicationProcessesObj    =  DB::table('exam_application_processes')
                                            ->where('typeOfExaminations_id','=', $id)
                                            ->orderBy('exam_application_processes.id', 'ASC')
                                            ->first();

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.examId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                        ->get();

        $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('TypeOfExamination','type_of_examinations',$id);
        $tablename = 'type_of_examinations';

        return view('examination.type-of-examination.edit', compact('typeofexamination','universityObj','examsectionsObj','examListMultipleDegreeObj','degreeObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examinationDetailsObj','examApplicationProcessesObj','seocontent','newUpdatedFields','tablename'));
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

        $examsection = ExamSection::findOrFail(Input::get('examsection_id'));
        $updateObj = TypeOfExamination::findOrFail($id);
        $updateObj->sortname = Input::get('sortname');
        $updateObj->name = Input::get('name');
        $updateObj->status = Input::get('status');
        $updateObj->isShowOnTop    =  Input::get('isShowOnTop');
        $updateObj->isShowOnHome   =  Input::get('isShowOnHome');
        $updateObj->universityName = Input::get('universityName');
        $updateObj->examsection_id = Input::get('examsection_id');
        $updateObj->functionalarea_id = $examsection->functionalarea_id;
        $updateObj->employee_id = Auth::id();
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('sortname'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateObj->slug = $slug;
        $updateObj->save();

        $updateSlugObj = TypeOfExamination::findOrFail($id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($updateObj->sortname.'-'.$id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();



        $degreeIds = Input::get('degreeIds');
        if (sizeof($degreeIds) > 0) {
            DB::table('exam_list_multiple_degrees')->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $id)->delete();
            foreach ($degreeIds as $key => $value) {
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', $value)
                                                    ->first();

                $addDegreeObj = New ExamListMultipleDegree;
                $addDegreeObj->degree_id = $value;
                $addDegreeObj->typeOfExaminations_id = $id;
                $addDegreeObj->examsection_id = Input::get('examsection_id');
                $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($degreeObj->name)); 
                $slug1 = strtolower(trim($cleanChar));
                $slug1 = preg_replace('/[^a-z0-9-]/', '-', $slug1);
                $slug1 = preg_replace('/-+/', "-", $slug1);
                rtrim($slug1, '-');
                $addDegreeObj->degreeSlug = $slug1;
                $addDegreeObj->functionalarea_id = $examsection->functionalarea_id;
                $addDegreeObj->save();
            }
        }

        if($request->file('universitylogo')){
            $fileName = $slug.'-'.$updateObj->id.".".$request->universitylogo->getClientOriginalExtension();
            $request->universitylogo->move(public_path('examinationlogo/'), $fileName);
            DB::table('type_of_examinations')->where('type_of_examinations.id', '=', $updateObj->id)->update(array('type_of_examinations.universitylogo' => $fileName));
        }

        $getExaminationId   = DB::table('examination_details')
                               ->where('typeOfExaminations_id', '=', $id)
                               ->select('id')
                               ->orderBy('id','DESC')
                               ->take(1)
                               ->get();


        $createExaminationDetail                        = ExaminationDetail::findOrFail($getExaminationId[0]->id);
        $createExaminationDetail->title                 = Input::get('examtitle');
        $createExaminationDetail->description           = Input::get('description');
        $createExaminationDetail->applicationFrom       = Input::get('applicationFrom');
        $createExaminationDetail->applicationTo         = Input::get('applicationTo');
        $createExaminationDetail->exminationDate        = Input::get('exminationDate');
        $createExaminationDetail->resultAnnounce        = Input::get('resultAnnounce');
        $createExaminationDetail->imagealttext          = Input::get('imagealttext');
        $createExaminationDetail->getMoreInfoLink       = Input::get('getMoreInfoLink');
        $createExaminationDetail->content               = Input::get('content');
        $createExaminationDetail->typeOfExaminations_id = $id;
        $createExaminationDetail->functionalarea_id     = $examsection->functionalarea_id;
        $createExaminationDetail->courses_id            = Input::get('examsection_id');
        $createExaminationDetail->slug                  = $updateObj->slug;
        $createExaminationDetail->userId                = Auth::id();
        $createExaminationDetail->status                = 1;
        $createExaminationDetail->employee_id           = Auth::id();
        $createExaminationDetail->save();

        if($request->file('image')){
            $fileName1 = $updateObj->slug.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('examinationlogo/'), $fileName1);
            DB::table('examination_details')->where('examination_details.id', '=', $createExaminationDetail->id)->update(array('examination_details.image' => $fileName1)); 
        }

        $getApplicationProcessId = DB::table('exam_application_processes')
                               ->where('typeOfExaminations_id', '=', $id)
                               ->select('id')
                               ->orderBy('id','DESC')
                               ->take(1)
                               ->get();

        $createApplicationProcessObj                            =   ExamApplicationProcess::findOrFail($getApplicationProcessId[0]->id);
        $createApplicationProcessObj->modeofapplication         =   Input::get('modeofapplication');
        $createApplicationProcessObj->modeofpayment             =   Input::get('modeofpayment');
        $createApplicationProcessObj->examinationtype           =   Input::get('examinationtype');
        $createApplicationProcessObj->applicationandexamstatus  =   Input::get('applicationandexamstatus');
        $createApplicationProcessObj->examinationmode           =   Input::get('examinationmode');
        $createApplicationProcessObj->eligibilitycriteria       =   Input::get('eligibilitycriteria');
        $createApplicationProcessObj->typeOfExaminations_id     =   $id;
        $createApplicationProcessObj->employee_id               =   Auth::id();
        $createApplicationProcessObj->save();

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());

        Session::flash('flash_message', 'Type Of Examination updated!');

        return redirect('examination/type-of-examination');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::table('exam_list_multiple_degrees')
            ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('examination_details')
            ->where('examination_details.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_application_processes')
            ->where('exam_application_processes.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_application_fees')
            ->where('exam_application_fees.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_eligibilities')
            ->where('exam_eligibilities.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_dates')
            ->where('exam_dates.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_syllabus_papers')
            ->where('exam_syllabus_papers.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_syllabus_paper_marks')
            ->where('exam_syllabus_paper_marks.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_patterns')
            ->where('exam_patterns.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_admit_cards')
            ->where('exam_admit_cards.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_results')
            ->where('exam_results.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_cut_offs')
            ->where('exam_cut_offs.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_counsellings')
            ->where('exam_counsellings.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_counselling_dates')
            ->where('exam_counselling_dates.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_counselling_contacts')
            ->where('exam_counselling_contacts.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_prepration_tips')
            ->where('exam_prepration_tips.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_answer_keys')
            ->where('exam_answer_keys.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_answer_key_events')
            ->where('exam_answer_key_events.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_analysis_records')
            ->where('exam_analysis_records.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('examination_important_links')
            ->where('examination_important_links.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_faqs')
            ->where('exam_faqs.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_questions')
            ->where('exam_questions.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_question_answers')
            ->where('exam_question_answers.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('exam_question_answer_comments')
            ->where('exam_question_answer_comments.typeOfExaminations_id', '=', $id)
            ->delete();

        DB::table('seo_contents')
            ->where('seo_contents.examId', '=', $id)
            ->delete();
            
        TypeOfExamination::destroy($id);

        Session::flash('flash_message', 'Type Of Examination deleted!');

        return redirect('examination/type-of-examination');
    }

    public function allExamQuestion(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');

        $query = ExamQuestion::orderBy('exam_questions.id', 'DESC')
                ->leftJoin('users', 'exam_questions.userId', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftJoin('users as eID','exam_questions.employee_id', '=','eID.id')
                ->leftjoin('type_of_examinations', 'exam_questions.typeOfExaminations_id', '=', 'type_of_examinations.id')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id');

        if ($request->has('userId')) {
            $query->where('users.id', '=', Input::get('userId'));
        }

        if (!empty(Input::get('startdate'))) {
            $query->where('exam_questions.questionDate', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
        }

        if (!empty(Input::get('enddate'))) {
            $query->where('exam_questions.questionDate', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
        }

        if (!empty(Input::get('question'))) {
            $query->where('exam_questions.question', 'LIKE', '%'.Input::get('question').'%');
        }

        if (!empty($keyword)) {
            $query->where('type_of_examinations.name', 'LIKE', "%$keyword%");
            $query->orWhere('type_of_examinations.sortname', 'LIKE', "%$keyword%");
        }

        if ($request->has('examsection') && !empty($request->get('examsection'))) {
            $query->where('type_of_examinations.examsection_id', '=', Input::get('examsection'));
        }

        $examQuestion = $query->paginate(15, array('exam_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','exam_questions.question', 'exam_questions.questionDate', 'exam_questions.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_questions.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle'));

        $examsectionsObj = DB::table('exam_sections')
                    ->select('id','name')
                    ->orderBy('exam_sections.name', 'ASC')
                    ->get()
                    ;

        $usersObj = DB::table('exam_questions')
                    ->leftJoin('users', 'exam_questions.userId', '=', 'users.id')
                    ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                    ->where('users.userstatus_id', '=', 1)
                    ->select('users.id as UserID', 'users.firstName', 'users.lastName', 'userrole.name as userRoleName')
                    ->orderBy('users.id','ASC')
                    ->groupBy('exam_questions.userId')
                    ->get();

        return view('examination.type-of-examination.all-exam-question', compact('examQuestion','examsectionsObj','usersObj'));
    }

    public function editExamQuestion($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;


        $examQuestion = ExamQuestion::orderBy('exam_questions.id', 'DESC')
                        ->leftjoin('type_of_examinations', 'exam_questions.typeOfExaminations_id', '=', 'type_of_examinations.id')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->select('exam_questions.id','exam_questions.question', 'exam_questions.questionDate', 'exam_questions.employee_id','exam_questions.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle')
                        ->findOrFail($id);


        return view('examination.type-of-examination.exam-question-edit', compact('examQuestion'));
    }

    public function showExamQuestion($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;


        $examQuestion = ExamQuestion::orderBy('exam_questions.id', 'DESC')
                        ->leftJoin('users', 'exam_questions.userId', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','exam_questions.employee_id', '=','eID.id')
                        ->leftjoin('type_of_examinations', 'exam_questions.typeOfExaminations_id', '=', 'type_of_examinations.id')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->select('exam_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','exam_questions.question', 'exam_questions.questionDate', 'exam_questions.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_questions.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle')
                        ->findOrFail($id);

        return view('examination.type-of-examination.exam-question-show', compact('examQuestion'));
    }

    public function allExamAnswers(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');

        $query = ExamQuestionAnswer::orderBy('exam_question_answers.id', 'DESC')
                ->leftJoin('exam_questions', 'exam_question_answers.questionId', '=', 'exam_questions.id')
                ->leftJoin('users', 'exam_question_answers.userId', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftJoin('users as eID','exam_question_answers.employee_id', '=','eID.id')
                ->leftjoin('type_of_examinations', 'exam_question_answers.typeOfExaminations_id', '=', 'type_of_examinations.id')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id');

        if ($request->has('userId')) {
            $query->where('users.id', '=', Input::get('userId'));
        }

        if (!empty(Input::get('startdate'))) {
            $query->where('exam_question_answers.answerDate', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
        }

        if (!empty(Input::get('enddate'))) {
            $query->where('exam_question_answers.answerDate', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
        }

        if (!empty(Input::get('question'))) {
            $query->where('exam_questions.question', 'LIKE', '%'.Input::get('question').'%');
        }

        if (!empty(Input::get('answer'))) {
            $query->where('exam_question_answers.answer', 'LIKE', '%'.Input::get('answer').'%');
        }

        if (!empty($keyword)) {
            $query->where('type_of_examinations.name', 'LIKE', "%$keyword%");
            $query->orWhere('type_of_examinations.sortname', 'LIKE', "%$keyword%");
        }

        if ($request->has('examsection') && !empty($request->get('examsection'))) {
            $query->where('type_of_examinations.examsection_id', '=', Input::get('examsection'));
        }

        $examAnswer = $query->paginate(15, array('exam_question_answers.id','exam_question_answers.answer','exam_question_answers.questionId', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','exam_questions.question', 'exam_question_answers.answerDate', 'exam_question_answers.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_question_answers.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle'));

        $examsectionsObj = DB::table('exam_sections')
                    ->select('id','name')
                    ->orderBy('exam_sections.name', 'ASC')
                    ->get()
                    ;

        $usersObj = DB::table('exam_question_answers')
                    ->leftJoin('users', 'exam_question_answers.userId', '=', 'users.id')
                    ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                    ->where('users.userstatus_id', '=', 1)
                    ->select('users.id as UserID', 'users.firstName', 'users.lastName', 'userrole.name as userRoleName')
                    ->orderBy('users.id','ASC')
                    ->groupBy('exam_question_answers.userId')
                    ->get();

        return view('examination.type-of-examination.all-exam-answers', compact('examAnswer','usersObj','examsectionsObj'));
    }

    public function editExamAnswer($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examAnswer = ExamQuestionAnswer::orderBy('exam_question_answers.id', 'DESC')
                        ->leftJoin('exam_questions', 'exam_question_answers.questionId', '=', 'exam_questions.id')
                        ->leftjoin('type_of_examinations', 'exam_question_answers.typeOfExaminations_id', '=', 'type_of_examinations.id')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->select('exam_question_answers.id','exam_question_answers.answer','exam_question_answers.questionId','exam_questions.question', 'exam_question_answers.answerDate', 'exam_question_answers.employee_id','exam_question_answers.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle')
                        ->findOrFail($id);


        return view('examination.type-of-examination.exam-answer-edit', compact('examAnswer'));
    }

    public function showExamAnswer($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examAnswer = ExamQuestionAnswer::orderBy('exam_question_answers.id', 'DESC')
                        ->leftJoin('exam_questions', 'exam_question_answers.questionId', '=', 'exam_questions.id')
                        ->leftJoin('users', 'exam_question_answers.userId', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','exam_question_answers.employee_id', '=','eID.id')
                        ->leftjoin('type_of_examinations', 'exam_question_answers.typeOfExaminations_id', '=', 'type_of_examinations.id')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->select('exam_question_answers.id','exam_question_answers.answer','exam_question_answers.questionId', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','exam_questions.question', 'exam_question_answers.answerDate', 'exam_question_answers.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_question_answers.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle')
                        ->findOrFail($id);

        return view('examination.type-of-examination.exam-answer-show', compact('examAnswer'));
    }

    public function allExamComments(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');

        $query = ExamQuestionAnswerComment::orderBy('exam_question_answer_comments.id', 'DESC')
                ->leftJoin('exam_question_answers', 'exam_question_answer_comments.answerId', '=', 'exam_question_answers.id')
                ->leftJoin('exam_questions', 'exam_question_answer_comments.questionId', '=', 'exam_questions.id')
                ->leftJoin('users', 'exam_question_answer_comments.userId', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftJoin('users as eID','exam_question_answer_comments.employee_id', '=','eID.id')
                ->leftjoin('type_of_examinations', 'exam_question_answer_comments.typeOfExaminations_id', '=', 'type_of_examinations.id')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id');

        if ($request->has('userId')) {
            $query->where('users.id', '=', Input::get('userId'));
        }

        if (!empty(Input::get('startdate'))) {
            $query->where('exam_question_answer_comments.answerDate', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
        }

        if (!empty(Input::get('enddate'))) {
            $query->where('exam_question_answer_comments.answerDate', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
        }

        if (!empty(Input::get('question'))) {
            $query->where('exam_questions.question', 'LIKE', '%'.Input::get('question').'%');
        }

        if (!empty(Input::get('answer'))) {
            $query->where('exam_question_answers.answer', 'LIKE', '%'.Input::get('answer').'%');
        }

        if (!empty(Input::get('comment'))) {
            $query->where('exam_question_answer_comments.replyanswer', 'LIKE', '%'.Input::get('comment').'%');
        }

        if (!empty($keyword)) {
            $query->where('type_of_examinations.name', 'LIKE', "%$keyword%");
            $query->orWhere('type_of_examinations.sortname', 'LIKE', "%$keyword%");
        }

        if ($request->has('examsection') && !empty($request->get('examsection'))) {
            $query->where('type_of_examinations.examsection_id', '=', Input::get('examsection'));
        }

        $examComment = $query->paginate(15, array('exam_question_answer_comments.id','exam_question_answer_comments.replyanswer','exam_question_answers.answer','exam_question_answer_comments.questionId','exam_question_answer_comments.answerId', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','exam_questions.question', 'exam_question_answer_comments.answerDate', 'exam_question_answer_comments.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_question_answer_comments.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle'));

        $examsectionsObj = DB::table('exam_sections')
                    ->select('id','name')
                    ->orderBy('exam_sections.name', 'ASC')
                    ->get()
                    ;

        $usersObj = DB::table('exam_question_answer_comments')
                    ->leftJoin('users', 'exam_question_answer_comments.userId', '=', 'users.id')
                    ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                    ->where('users.userstatus_id', '=', 1)
                    ->select('users.id as UserID', 'users.firstName', 'users.lastName', 'userrole.name as userRoleName')
                    ->orderBy('users.id','ASC')
                    ->groupBy('exam_question_answer_comments.userId')
                    ->get();


        return view('examination.type-of-examination.all-exam-comments', compact('examComment','examsectionsObj','usersObj'));
    }

    public function editExamComments($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examComment = ExamQuestionAnswerComment::orderBy('exam_question_answer_comments.id', 'DESC')
                        ->leftJoin('exam_question_answers', 'exam_question_answer_comments.answerId', '=', 'exam_question_answers.id')
                        ->leftJoin('exam_questions', 'exam_question_answer_comments.questionId', '=', 'exam_questions.id')
                        ->leftjoin('type_of_examinations', 'exam_question_answer_comments.typeOfExaminations_id', '=', 'type_of_examinations.id')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->select('exam_question_answer_comments.id','exam_question_answer_comments.replyanswer','exam_question_answers.answer','exam_question_answer_comments.questionId','exam_question_answer_comments.answerId','exam_questions.question','exam_question_answer_comments.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle')
                        ->findOrFail($id);


        return view('examination.type-of-examination.exam-comment-edit', compact('examComment'));
    }

    public function showExamComments($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examComment = ExamQuestionAnswerComment::orderBy('exam_question_answer_comments.id', 'DESC')
                        ->leftJoin('exam_question_answers', 'exam_question_answer_comments.answerId', '=', 'exam_question_answers.id')
                        ->leftJoin('exam_questions', 'exam_question_answer_comments.questionId', '=', 'exam_questions.id')
                        ->leftJoin('users', 'exam_question_answer_comments.userId', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','exam_question_answer_comments.employee_id', '=','eID.id')
                        ->leftjoin('type_of_examinations', 'exam_question_answer_comments.typeOfExaminations_id', '=', 'type_of_examinations.id')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->select('exam_question_answer_comments.id','exam_question_answer_comments.replyanswer','exam_question_answers.answer','exam_question_answer_comments.questionId','exam_question_answer_comments.answerId', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','exam_questions.question', 'exam_question_answer_comments.answerDate', 'exam_question_answer_comments.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_question_answer_comments.updated_at','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle')
                        ->findOrFail($id);

        return view('examination.type-of-examination.exam-comment-show', compact('examComment'));
    }


    public function updateExamQuestionAdmin(Request $request, $examId, $questionId)
    {   
        if (Auth::check()){   
            $userId = Auth::id();
            $createObj = ExamQuestion::findOrFail($questionId);
            $createObj->question = Input::get('question');
            $createObj->employee_id = Auth::id();
            //$createObj->userId = Auth::id();
            $createObj->save();

            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Answer has been updated successfully!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function updateExamAnswerAdmin(Request $request, $examId, $questionId, $answerId)
    {   
        if (Auth::check()){   
            $userId = Auth::id();
            $createObj = ExamQuestionAnswer::findOrFail($answerId);
            $createObj->answer = Input::get('answer');
            //$createObj->questionId = $questionId;
            $createObj->employee_id = Auth::id();
            //$createObj->userId = Auth::id();
            $createObj->save();

            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Answer has been updated successfully!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function updateExamCommentAdmin(Request $request, $examId, $questionId, $answerId, $commentId)
    {   
        if (Auth::check()){   
            $userId = Auth::id();
            $createObj = ExamQuestionAnswerComment::findOrFail($commentId);
            $createObj->replyanswer = Input::get('replyanswer');
            //$createObj->answerId = $answerId;
            //$createObj->questionId = $questionId;
            $createObj->employee_id = Auth::id();
            //$createObj->userId = Auth::id();
            $createObj->save();
            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Comment has been updated successfully!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

}