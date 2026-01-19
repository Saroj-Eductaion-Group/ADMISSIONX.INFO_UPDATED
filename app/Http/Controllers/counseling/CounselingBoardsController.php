<?php

namespace App\Http\Controllers\counseling;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CounselingBoard;
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
use App\Models\CounselingBoardAdmissionDate;
use App\Models\CounselingBoardDetail;
use App\Models\CounselingBoardExamDate;
use App\Models\CounselingBoardHighlight;
use App\Models\CounselingBoardImpDate;
use App\Models\CounselingBoardLatestUpdate;
use App\Models\CounselingBoardSamplePaper;
use App\Models\CounselingBoardSyllabus;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class CounselingBoardsController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingBoard');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CounselingBoard::orderBy('counseling_boards.id', 'DESC')
                ->leftJoin('users as eID','counseling_boards.employee_id', '=','eID.id');

        if (!empty($keyword)) {
            $query->where('counseling_boards.title', 'LIKE', "%$keyword%");
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('counseling_boards.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('counseling_boards.status', '=', Input::get('status'));
            }
        }

        if ($request->has('misc') && !empty($request->get('misc'))) {
            $query->where('counseling_boards.misc', '=', Input::get('misc'));
        }

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('counseling_boards.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        $counselingboards = $query->paginate(20, array('counseling_boards.id','name','title', 'misc', 'status', 'slug','counseling_boards.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_boards.updated_at'));

        return view('counseling.counseling-boards.index', compact('counselingboards'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingBoard');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        return view('counseling.counseling-boards.create');
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

        $createObj = New CounselingBoard();
        $createObj->name = Input::get('name');
        $createObj->title = Input::get('title');
        $createObj->misc = Input::get('misc');
        $createObj->status = Input::get('status');
        $createObj->employee_id = Auth::id();
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('name'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $createObj->slug = $slug;
        $createObj->save();

        $createCounselingBoardDetail                        = New CounselingBoardDetail();
        $createCounselingBoardDetail->counselingBoardId     = $createObj->id;
        $createCounselingBoardDetail->employee_id           = Auth::id();
        $createCounselingBoardDetail->save();

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());

        Session::flash('flash_message', 'CounselingBoard added!');

        return redirect('counseling/counseling-boards');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingBoard');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingboard = CounselingBoard::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','counseling_boards.employee_id', '=','eID.id')
                        ->select('counseling_boards.id','name','title','misc', 'status', 'slug','counseling_boards.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_boards.updated_at')
                        ->findOrFail($id);

            $counselingBoardDetailObj           =  DB::table('counseling_board_details')
                                                    ->where('counselingBoardId','=', $id)
                                                    ->orderBy('counseling_board_details.id', 'ASC')
                                                    ->first();  

            $counselingBoardImpDateObj          =  DB::table('counseling_board_imp_dates')
                                                    ->where('counselingBoardId','=', $id)
                                                    ->orderBy('counseling_board_imp_dates.id', 'ASC')
                                                    ->get();

            $counselingBoardLatestUpdateObj     =  DB::table('counseling_board_latest_updates')
                                                    ->where('counselingBoardId','=', $id)
                                                    ->orderBy('counseling_board_latest_updates.id', 'ASC')
                                                    ->get();

            $counselingBoardHighlightObj        =  DB::table('counseling_board_highlights')
                                                    ->where('counselingBoardId','=', $id)
                                                    ->orderBy('counseling_board_highlights.id', 'ASC')
                                                    ->get();

            $counselingBoardExamDateObj         =  DB::table('counseling_board_exam_dates')
                                                    ->where('counselingBoardId','=', $id)
                                                    ->orderBy('counseling_board_exam_dates.id', 'ASC')
                                                    ->get();

            $counselingBoardSamplePaperObj      =  DB::table('counseling_board_sample_papers')
                                                    ->where('counselingBoardId','=', $id)
                                                    ->orderBy('counseling_board_sample_papers.id', 'ASC')
                                                    ->get();  

            $counselingBoardSyllabusObj         =  DB::table('counseling_board_syllabus')
                                                    ->where('counselingBoardId','=', $id)
                                                    ->orderBy('counseling_board_syllabus.id', 'ASC')
                                                    ->get();

            $counselingBoardAdmissionDateObj    =  DB::table('counseling_board_admission_dates')
                                                    ->where('counselingBoardId','=', $id)
                                                    ->orderBy('counseling_board_admission_dates.id', 'ASC')
                                                    ->get();

            $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.boardId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();


        return view('counseling.counseling-boards.show', compact('counselingboard','counselingBoardDetailObj','counselingBoardImpDateObj','counselingBoardLatestUpdateObj','counselingBoardHighlightObj','counselingBoardExamDateObj','counselingBoardSamplePaperObj','counselingBoardSyllabusObj','counselingBoardAdmissionDateObj','seocontent'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingBoard');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingboard = CounselingBoard::findOrFail($id);

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.boardId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                        ->get();

        return view('counseling.counseling-boards.edit', compact('counselingboard','seocontent'));
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
        $updateObj = CounselingBoard::findOrFail($id);
        $updateObj->name = Input::get('name');
        $updateObj->title = Input::get('title');
        $updateObj->misc = Input::get('misc');
        $updateObj->status = Input::get('status');
        $updateObj->employee_id = Auth::id();
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('name'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateObj->slug = $slug;
        $updateObj->save();

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());

        Session::flash('flash_message', 'CounselingBoard updated!');

        return redirect('counseling/counseling-boards');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingBoard');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::table('counseling_board_details')
            ->where('counselingBoardId','=', $id)
            ->delete(); 

        DB::table('counseling_board_imp_dates')
            ->where('counselingBoardId','=', $id)
            ->delete();

        DB::table('counseling_board_latest_updates')
            ->where('counselingBoardId','=', $id)
            ->delete();

        DB::table('counseling_board_highlights')
            ->where('counselingBoardId','=', $id)
            ->delete();

        DB::table('counseling_board_exam_dates')
            ->where('counselingBoardId','=', $id)
            ->delete();

        DB::table('counseling_board_sample_papers')
            ->where('counselingBoardId','=', $id)
            ->delete();  

        DB::table('counseling_board_syllabus')
            ->where('counselingBoardId','=', $id)
            ->delete();

        DB::table('counseling_board_admission_dates')
            ->where('counselingBoardId','=', $id)
            ->delete();

        DB::table('seo_contents')
            ->where('seo_contents.boardId', '=', $id)
            ->delete();

        CounselingBoard::destroy($id);

        Session::flash('flash_message', 'CounselingBoard deleted!');

        return redirect('counseling/counseling-boards');
    }


    public function updateFormDetails($boardId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingBoard');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingBoardObj = CounselingBoard::orderBy('counseling_boards.id' ,'DESC')
                ->where('counseling_boards.id','=', $boardId)
                ->get();

        if (sizeof($counselingBoardObj) > 0) {
            $counselingBoard                    = CounselingBoard::orderBy('counseling_boards.id' ,'DESC')
                                                    ->where('counseling_boards.id','=', $boardId)
                                                    ->first();

            $counselingBoardDetailObj           =  DB::table('counseling_board_details')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_details.id', 'ASC')
                                                    ->first();  

            $counselingBoardImpDateObj          =  DB::table('counseling_board_imp_dates')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_imp_dates.id', 'ASC')
                                                    ->get();

            $counselingBoardLatestUpdateObj     =  DB::table('counseling_board_latest_updates')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_latest_updates.id', 'ASC')
                                                    ->get();

            $counselingBoardHighlightObj        =  DB::table('counseling_board_highlights')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_highlights.id', 'ASC')
                                                    ->get();

            $counselingBoardExamDateObj         =  DB::table('counseling_board_exam_dates')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_exam_dates.id', 'ASC')
                                                    ->get();

            $counselingBoardSamplePaperObj      =  DB::table('counseling_board_sample_papers')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_sample_papers.id', 'ASC')
                                                    ->get();  

            $counselingBoardSyllabusObj         =  DB::table('counseling_board_syllabus')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_syllabus.id', 'ASC')
                                                    ->get();

            $counselingBoardAdmissionDateObj    =  DB::table('counseling_board_admission_dates')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_admission_dates.id', 'ASC')
                                                    ->get();

            return view('counseling.common-partial.all-board-form-details', compact('counselingBoardDetailObj','counselingBoardImpDateObj','counselingBoardLatestUpdateObj','counselingBoardHighlightObj','counselingBoardExamDateObj','counselingBoardSamplePaperObj','counselingBoardSyllabusObj','counselingBoardAdmissionDateObj','boardId','counselingBoard'));
        }else{
            return redirect('counseling/counseling-boards');
        }
    }

    public function updateCounselingBoardDetails(Request $request, $boardId)
    {   
        $typeOfExaminationObj = CounselingBoard::orderBy('counseling_boards.id' ,'DESC')
                ->where('counseling_boards.id','=', $boardId)
                ->first();

        $getBoardDetailId = DB::table('counseling_board_details')
                               ->where('counselingBoardId', '=', $boardId)
                               ->select('id')
                               ->orderBy('id','DESC')
                               ->take(1)
                               ->get();
        if(sizeof($getBoardDetailId) == 0):
            $createCounselingBoardDetail                        = New CounselingBoardDetail;
        else:
            $createCounselingBoardDetail                        = CounselingBoardDetail::findOrFail($getBoardDetailId[0]->id);
        endif;
            $createCounselingBoardDetail->title                 = Input::get('examtitle');
            $createCounselingBoardDetail->description           = Input::get('description');
            $createCounselingBoardDetail->aboutBoard            = Input::get('aboutBoard');
            $createCounselingBoardDetail->admissionDesc         = Input::get('admissionDesc');
            $createCounselingBoardDetail->boardDesc             = Input::get('boardDesc');
            $createCounselingBoardDetail->syllabusDesc          = Input::get('syllabusDesc');
            $createCounselingBoardDetail->samplePaper           = Input::get('samplePaper');
            $createCounselingBoardDetail->admitCardDetails      = Input::get('admitCardDetails');
            $createCounselingBoardDetail->preprationTips        = Input::get('preprationTips');
            $createCounselingBoardDetail->resultDesc            = Input::get('resultDesc');
            $createCounselingBoardDetail->entranceExam          = Input::get('entranceExam');
            $createCounselingBoardDetail->chooseRightCollege    = Input::get('chooseRightCollege');
            $createCounselingBoardDetail->counselingBoardId     = $boardId;
            $createCounselingBoardDetail->employee_id           = Auth::id();
            $createCounselingBoardDetail->save();

            if($request->file('image')){
                $fileName = 'counseling-boards-'.$typeOfExaminationObj->slug.'-'.$createCounselingBoardDetail->id.".".$request->image->getClientOriginalExtension();
                $request->image->move(public_path('counselingimages/'), $fileName);
                DB::table('counseling_board_details')->where('counseling_board_details.id', '=', $createCounselingBoardDetail->id)->update(array('counseling_board_details.image' => $fileName)); 
            }

        DB::statement(DB::raw("DELETE FROM counseling_board_highlights WHERE (counselingBoardId = $boardId)"));
        if (!empty(Input::get('highlightsTitle'))) {
            $sizeOfHighlights = sizeof(Input::get('highlightsTitle'));
            for($highlightCounter = 0; $highlightCounter < $sizeOfHighlights; $highlightCounter++){
                $createHighlightObj                          = New CounselingBoardHighlight();
                $createHighlightObj->title                   = Input::get('highlightsTitle')[$highlightCounter];
                $createHighlightObj->description             = Input::get('highlightsDescription')[$highlightCounter];
                $createHighlightObj->counselingBoardId       = $boardId;
                $createHighlightObj->employee_id             = Auth::id();
                $createHighlightObj->save();
            }
        }
        
        DB::statement(DB::raw("DELETE FROM counseling_board_imp_dates WHERE (counselingBoardId = $boardId)"));
        if (!empty(Input::get('importantDates'))) {
            $sizeOfImpDates = sizeof(Input::get('importantDates'));
            for($impDateCounter = 0; $impDateCounter < $sizeOfImpDates; $impDateCounter++){
                $createImpDateObj                          = New CounselingBoardImpDate();
                $createImpDateObj->dates                   = Input::get('importantDates')[$impDateCounter];
                $createImpDateObj->description             = Input::get('importantDescription')[$impDateCounter];
                $createImpDateObj->counselingBoardId       = $boardId;
                $createImpDateObj->employee_id             = Auth::id();
                $createImpDateObj->save();
            }
        }

        DB::statement(DB::raw("DELETE FROM counseling_board_latest_updates WHERE (counselingBoardId = $boardId)"));
        if (!empty(Input::get('latestUpdateDates'))) {
            $sizeOflatestUpdate = sizeof(Input::get('latestUpdateDates'));
            for($latestUpdateCounter = 0; $latestUpdateCounter < $sizeOflatestUpdate; $latestUpdateCounter++){
                $createLatestUpdateObj                     = New CounselingBoardLatestUpdate();
                $createLatestUpdateObj->dates              = Input::get('latestUpdateDates')[$latestUpdateCounter];
                $createLatestUpdateObj->description        = Input::get('latestUpdateDescription')[$latestUpdateCounter];
                $createLatestUpdateObj->counselingBoardId  = $boardId;
                $createLatestUpdateObj->employee_id        = Auth::id();
                $createLatestUpdateObj->save();
            }
        }

        DB::statement(DB::raw("DELETE FROM counseling_board_admission_dates WHERE (counselingBoardId = $boardId)"));
        if (!empty(Input::get('admissionClass'))) {
            $sizeOfAdmissionDate = sizeof(Input::get('admissionClass'));
            for($admissionDateCounter = 0; $admissionDateCounter < $sizeOfAdmissionDate; $admissionDateCounter++){
                $createAdmissionDateObj                      = New CounselingBoardAdmissionDate();
                $createAdmissionDateObj->class               = Input::get('admissionClass')[$admissionDateCounter];
                $createAdmissionDateObj->dates               = Input::get('admissionDates')[$admissionDateCounter];
                $createAdmissionDateObj->subjects            = Input::get('admissionSubjects')[$admissionDateCounter];
                $createAdmissionDateObj->fees                = Input::get('admissionFees')[$admissionDateCounter];
                $createAdmissionDateObj->place               = Input::get('admissionPlace')[$admissionDateCounter];
                $createAdmissionDateObj->counselingBoardId   = $boardId;
                $createAdmissionDateObj->employee_id         = Auth::id();
                $createAdmissionDateObj->save();
            }
        }

        DB::statement(DB::raw("DELETE FROM counseling_board_syllabus WHERE (counselingBoardId = $boardId)"));
        if (!empty(Input::get('syllabusClass'))) {
            $sizeOfSyllabus = sizeof(Input::get('syllabusClass'));
            for($syllabusCounter = 0; $syllabusCounter < $sizeOfSyllabus; $syllabusCounter++){
                $createSyllabusObj                          = New CounselingBoardSyllabus();
                $createSyllabusObj->class                   = Input::get('syllabusClass')[$syllabusCounter];
                $createSyllabusObj->subject                 = Input::get('syllabusSubject')[$syllabusCounter];
                $createSyllabusObj->description             = Input::get('syllabusDescription')[$syllabusCounter];
                $createSyllabusObj->counselingBoardId       = $boardId;
                $createSyllabusObj->employee_id             = Auth::id();
                $createSyllabusObj->save();
            }
        }

        DB::statement(DB::raw("DELETE FROM counseling_board_sample_papers WHERE (counselingBoardId = $boardId)"));
        if (!empty(Input::get('samplePaperClass'))) {
            $sizeOfSamplePaper = sizeof(Input::get('samplePaperClass'));
            for($samplePaperCounter = 0; $samplePaperCounter < $sizeOfSamplePaper; $samplePaperCounter++){
                $createSamplePaperObj                      = New CounselingBoardSamplePaper();
                $createSamplePaperObj->class               = Input::get('samplePaperClass')[$samplePaperCounter];
                $createSamplePaperObj->subject             = Input::get('samplePaperSubject')[$samplePaperCounter];
                $createSamplePaperObj->description         = Input::get('samplePaperDescription')[$samplePaperCounter];
                $createSamplePaperObj->counselingBoardId   = $boardId;
                $createSamplePaperObj->employee_id         = Auth::id();
                $createSamplePaperObj->save();
            }
        }

        DB::statement(DB::raw("DELETE FROM counseling_board_exam_dates WHERE (counselingBoardId = $boardId)"));
        if (!empty(Input::get('examclass'))) {
            $sizeOfExamDates = sizeof(Input::get('examclass'));
            for($examDatesCounter = 0; $examDatesCounter < $sizeOfExamDates; $examDatesCounter++){
                $createExamDateObj                          = New CounselingBoardExamDate();
                $createExamDateObj->class                   = Input::get('examclass')[$examDatesCounter];
                $createExamDateObj->dates                   = Input::get('examdates')[$examDatesCounter];
                $createExamDateObj->subject                 = Input::get('examsubject')[$examDatesCounter];
                $createExamDateObj->setting                 = Input::get('examsetting')[$examDatesCounter];
                $createExamDateObj->counselingBoardId       = $boardId;
                $createExamDateObj->employee_id             = Auth::id();
                $createExamDateObj->save();
            }
        }

        Session::flash('alert_class', 'alert-success');    
        Session::flash('flash_message', 'Counseling Board details has been updated!');
        return Redirect::back();
    }
}
