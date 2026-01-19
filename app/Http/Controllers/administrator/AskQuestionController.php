<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AskQuestion;
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
use App\Models\AskQuestionAnswer;
use App\Models\AskQuestionAnswerComment;
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\AskQuestionTag;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;


class AskQuestionController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $perPage = 25;

        $query = AskQuestion::orderBy('ask_questions.id', 'DESC')
                ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftJoin('users as eID','ask_questions.employee_id', '=','eID.id');

        if ($request->has('userId')) {
            $query->where('users.id', '=', Input::get('userId'));
        }

        if (!empty(Input::get('startdate'))) {
            $query->where('ask_questions.questionDate', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
        }

        if (!empty(Input::get('enddate'))) {
            $query->where('ask_questions.questionDate', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('ask_questions.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('ask_questions.status', '=', Input::get('status'));
            }
        }

        if ($request->has('askQuestionTagIds')) {
           $askQuestionTagIds = array();
            $allTechs[] = $request->get('askQuestionTagIds');
            foreach($allTechs as $key ) {
                $askQuestionTagIds = $key;  

            }
            if(!empty($askQuestionTagIds)){
                $storeTechID = implode (',',$askQuestionTagIds);  
            }
            $query->whereRaw("find_in_set('$storeTechID',ask_questions.newstagsids)");
        }

        if (!empty(Input::get('question'))) {
            $query->where('ask_questions.question', 'LIKE', '%'.Input::get('question').'%');
        }

        $askquestion = $query->paginate(15, array('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','ask_questions.updated_at','totalAnswerCount','totalCommentsCount','askQuestionTagIds'));


        $tags = [];
        foreach ($askquestion as $key => $value) {
            if (!empty($value->askQuestionTagIds)) {
                $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($value->askQuestionTagIds)"));
            }
            $value->tagname = $tags;
        }

        $usersObj = DB::table('ask_questions')
                    ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                    ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                    ->where('users.userstatus_id', '=', 1)
                    ->select('users.id as UserID', 'users.firstName', 'users.lastName', 'userrole.name as userRoleName')
                    ->orderBy('users.id','ASC')
                    ->groupBy('ask_questions.userId')
                    ->get();

        $askQuestionTagObj = AskQuestionTag::all();

        return view('administrator.ask-question.index', compact('askquestion','usersObj','askQuestionTagObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $askQuestionTagObj = AskQuestionTag::all();
        return view('administrator.ask-question.create',compact('askQuestionTagObj'));
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
        $askQuestionTagIds = Input::get('askQuestionTagIds');
        if (!empty($askQuestionTagIds)) {
            $arrSelectedForms       = [];
            $arrSelectedForms1 []   = array_unique($askQuestionTagIds);

            foreach ($arrSelectedForms1[0] as $key => $value) {
                $arrSelectedForms [] = $value;
            }

            $sForms = implode(',', $arrSelectedForms);
        }else{
            $sForms = '';
        }


        $createObj = New AskQuestion();
        $createObj->question = Input::get('question');
        $createObj->questionDate = date('Y-m-d H:i:s');
        $createObj->userId = Auth::id();
        $createObj->status = Input::get('status');
        $createObj->askQuestionTagIds = $sForms;
        $createObj->employee_id = Auth::id();
        $createObj->save();

        $slugTitle = strip_tags($createObj->question);

        $updateSlugObj = AskQuestion::findOrFail($createObj->id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($slugTitle.'-'.$createObj->id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());


        Session::flash('flash_message', 'AskQuestion added!');

        return redirect($this->fetchDataServiceController->routeCall().'/ask-question');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $askquestion = AskQuestion::orderBy('ask_questions.id', 'DESC')
                ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftJoin('users as eID','ask_questions.employee_id', '=','eID.id')
                ->select('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','ask_questions.updated_at','totalAnswerCount','totalCommentsCount','askQuestionTagIds')
                ->findOrFail($id);


        $tags = [];
        if (!empty($askquestion->askQuestionTagIds)) {
            $tags = DB::select(DB::raw("SELECT ask_question_tags.name FROM ask_question_tags where ask_question_tags.id IN ($askquestion->askQuestionTagIds)"));
        }


        $askQuestionAnswersObj         =  DB::table('ask_question_answers')
                                            ->where('questionId','=', $id)
                                            ->orderBy('ask_question_answers.id', 'ASC')
                                            ->get(); 


        foreach ($askQuestionAnswersObj as $key => $ans) {
            $ans->askQuestionAnswerCommentsObj  =  DB::table('ask_question_answer_comments')
                                                ->where('questionId','=', $id)
                                                ->where('answerId','=', $ans->id)
                                                ->orderBy('ask_question_answer_comments.id', 'ASC')
                                                ->get();  
        }

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.askQuestionId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.askQuestionId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();

        return view('administrator.ask-question.show', compact('askquestion','askQuestionAnswersObj','seocontent','tags'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $askquestion = AskQuestion::findOrFail($id);
        $askQuestionTagObj = AskQuestionTag::all();

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                    ->where('seo_contents.askQuestionId','=', $id)
                    ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','askQuestionId','examSectionId')
                    ->get();

        return view('administrator.ask-question.edit', compact('askquestion','askQuestionTagObj','seocontent'));
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
        $askQuestionTagIds = Input::get('askQuestionTagIds');
        if (!empty($askQuestionTagIds)) {
            $arrSelectedForms       = [];
            $arrSelectedForms1 []   = array_unique($askQuestionTagIds);

            foreach ($arrSelectedForms1[0] as $key => $value) {
                $arrSelectedForms [] = $value;
            }

            $sForms = implode(',', $arrSelectedForms);
        }else{
            $sForms = '';
        }

        $totalAnswerCount = DB::table('ask_question_answers')
                            ->where('questionId','=', $id)
                            ->count();


        $totalCommentsCount = DB::table('ask_question_answer_comments')
                            ->where('questionId','=', $id)
                            ->count();

        
        $askquestion = AskQuestion::findOrFail($id);
        $askquestion->question = Input::get('question');
        $askquestion->questionDate = date('Y-m-d H:i:s');
        //$askquestion->userId = Auth::id();
        $askquestion->status = Input::get('status');
        $askquestion->employee_id = Auth::id();
        $slugTitle = strip_tags(Input::get('question'));

        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($slugTitle.'-'.$id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $askquestion->slug = $slug;
        $askquestion->askQuestionTagIds = $sForms;
        $askquestion->totalAnswerCount = $totalAnswerCount;
        $askquestion->totalCommentsCount = $totalCommentsCount;
        $askquestion->save();

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());
        Session::flash('flash_message', 'AskQuestion updated!');

        return redirect($this->fetchDataServiceController->routeCall().'/ask-question');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        Db::table('ask_question_answer_comments')
            ->where('ask_question_answer_comments.questionId', '=', $id)
            ->delete();

        Db::table('ask_question_answers')
            ->where('ask_question_answers.questionId', '=', $id)
            ->delete();

        DB::table('seo_contents')
            ->where('seo_contents.askQuestionId', '=', $id)
            ->delete();
            
        AskQuestion::destroy($id);
        
        Session::flash('flash_message', 'AskQuestion deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/ask-question');
    }

    public function allASKAnswers(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $perPage = 25;

        $query = AskQuestionAnswer::orderBy('ask_question_answers.id', 'DESC')
                ->leftJoin('ask_questions', 'ask_question_answers.questionId', '=', 'ask_questions.id')
                ->leftJoin('users', 'ask_question_answers.userId', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftJoin('users as eID','ask_question_answers.employee_id', '=','eID.id');

        if ($request->has('userId')) {
            $query->where('users.id', '=', Input::get('userId'));
        }

        if (!empty(Input::get('startdate'))) {
            $query->where('ask_question_answers.answerDate', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
        }

        if (!empty(Input::get('enddate'))) {
            $query->where('ask_question_answers.answerDate', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('ask_question_answers.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('ask_question_answers.status', '=', Input::get('status'));
            }
        }

        if (!empty(Input::get('question'))) {
            $query->where('ask_questions.question', 'LIKE', '%'.Input::get('question').'%');
        }

        if (!empty(Input::get('answer'))) {
            $query->where('ask_question_answers.answer', 'LIKE', '%'.Input::get('answer').'%');
        }

        $askAnswer = $query->paginate(15, array('ask_question_answers.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_question_answers.answer','ask_question_answers.answerDate', 'ask_question_answers.status', 'ask_question_answers.employee_id','ask_questions.slug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','ask_question_answers.updated_at','ask_question_answers.totalCommentsCount','questionId'));


        $usersObj = DB::table('ask_question_answers')
                    ->leftJoin('users', 'ask_question_answers.userId', '=', 'users.id')
                    ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                    ->where('users.userstatus_id', '=', 1)
                    ->select('users.id as UserID', 'users.firstName', 'users.lastName', 'userrole.name as userRoleName')
                    ->orderBy('users.id','ASC')
                    ->groupBy('ask_question_answers.userId')
                    ->get();


        return view('administrator.ask-question.all-ask-answers', compact('askAnswer','usersObj'));
    }

    public function editASKAnswers($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $askAnswer = AskQuestionAnswer::orderBy('ask_question_answers.id', 'DESC')
                        ->leftJoin('ask_questions', 'ask_question_answers.questionId', '=', 'ask_questions.id')
                        ->select('ask_question_answers.id','ask_questions.question', 'ask_question_answers.answer','ask_question_answers.questionId')
                        ->findOrFail($id);


        return view('administrator.ask-question.answer-edit', compact('askAnswer'));
    }

    public function showASKAnswers($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $askAnswer = AskQuestionAnswer::orderBy('ask_question_answers.id', 'DESC')
                        ->leftJoin('ask_questions', 'ask_question_answers.questionId', '=', 'ask_questions.id')
                        ->leftJoin('users', 'ask_question_answers.userId', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','ask_question_answers.employee_id', '=','eID.id')
                        ->select('ask_question_answers.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_question_answers.answer','ask_question_answers.answerDate', 'ask_question_answers.status', 'ask_question_answers.employee_id','ask_questions.slug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','ask_question_answers.updated_at','ask_question_answers.totalCommentsCount','questionId')
                        ->findOrFail($id);

        return view('administrator.ask-question.answer-show', compact('askAnswer'));
    }

    public function allASKComments(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $perPage = 25;

        $query = AskQuestionAnswerComment::orderBy('ask_question_answer_comments.id', 'DESC')
                ->leftJoin('ask_question_answers', 'ask_question_answer_comments.answerId', '=', 'ask_question_answers.id')
                ->leftJoin('ask_questions', 'ask_question_answer_comments.questionId', '=', 'ask_questions.id')
                ->leftJoin('users', 'ask_question_answer_comments.userId', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftJoin('users as eID','ask_question_answer_comments.employee_id', '=','eID.id');

        if ($request->has('userId')) {
            $query->where('users.id', '=', Input::get('userId'));
        }

        if (!empty(Input::get('startdate'))) {
            $query->where('ask_question_answer_comments.answerDate', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
        }

        if (!empty(Input::get('enddate'))) {
            $query->where('ask_question_answer_comments.answerDate', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('ask_question_answer_comments.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('ask_question_answer_comments.status', '=', Input::get('status'));
            }
        }

        if (!empty(Input::get('question'))) {
            $query->where('ask_questions.question', 'LIKE', '%'.Input::get('question').'%');
        }

        if (!empty(Input::get('answer'))) {
            $query->where('ask_question_answers.answer', 'LIKE', '%'.Input::get('answer').'%');
        }

        if (!empty(Input::get('comment'))) {
            $query->where('ask_question_answer_comments.replyanswer', 'LIKE', '%'.Input::get('comment').'%');
        }

        $askComments = $query->paginate(15, array('ask_question_answer_comments.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_question_answers.answer','ask_questions.slug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','ask_question_answer_comments.questionId','ask_question_answer_comments.answerId','replyanswer','ask_question_answer_comments.answerDate', 'ask_question_answer_comments.status', 'ask_question_answer_comments.employee_id','ask_question_answer_comments.updated_at'));

        $usersObj = DB::table('ask_question_answer_comments')
                    ->leftJoin('users', 'ask_question_answer_comments.userId', '=', 'users.id')
                    ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                    ->where('users.userstatus_id', '=', 1)
                    ->select('users.id as UserID', 'users.firstName', 'users.lastName', 'userrole.name as userRoleName')
                    ->orderBy('users.id','ASC')
                    ->groupBy('ask_question_answer_comments.userId')
                    ->get();

        return view('administrator.ask-question.all-ask-comments', compact('askComments','usersObj'));
    }

    public function editASKComments($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $askComments = AskQuestionAnswerComment::orderBy('ask_question_answer_comments.id', 'DESC')
                        ->leftJoin('ask_question_answers', 'ask_question_answer_comments.answerId', '=', 'ask_question_answers.id')
                        ->leftJoin('ask_questions', 'ask_question_answer_comments.questionId', '=', 'ask_questions.id')
                        ->select('ask_question_answer_comments.id','ask_questions.question', 'ask_question_answers.answer','ask_questions.slug','ask_question_answer_comments.questionId','ask_question_answer_comments.answerId','replyanswer','ask_question_answer_comments.answerDate')
                        ->findOrFail($id);


        return view('administrator.ask-question.comment-edit', compact('askComments'));
    }

    public function showASKComments($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $askComments = AskQuestionAnswerComment::orderBy('ask_question_answer_comments.id', 'DESC')
                        ->leftJoin('ask_question_answers', 'ask_question_answer_comments.answerId', '=', 'ask_question_answers.id')
                        ->leftJoin('ask_questions', 'ask_question_answer_comments.questionId', '=', 'ask_questions.id')
                        ->leftJoin('users', 'ask_question_answer_comments.userId', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','ask_question_answer_comments.employee_id', '=','eID.id')
                        ->select('ask_question_answer_comments.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_question_answers.answer','ask_questions.slug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','ask_question_answer_comments.questionId','ask_question_answer_comments.answerId','replyanswer','ask_question_answer_comments.answerDate', 'ask_question_answer_comments.status', 'ask_question_answer_comments.employee_id','ask_question_answer_comments.updated_at')
                        ->findOrFail($id);

        return view('administrator.ask-question.comment-show', compact('askComments'));
    }


    public function addNewAskQuestion(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        endif;

        if (Auth::check()){ 
            $userId = Auth::id();
            $question = Input::get('question');
            $askQuestionTagIds = Input::get('askQuestionTagIds');
            self::submitAskQuestion($question, $askQuestionTagIds, $userId);
            
            Session::flash('alert_class', 'alert-success');
            if(Auth::check() && (Auth::user()->userrole_id == 1)){
                Session::flash('flash_message', 'Question has been added successfully!');
            }else{
                Session::flash('flash_message', 'Question has been added successfully, Your question approval is under process!');
            }
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function submitAskQuestion($question, $askQuestionTagIds, $userId)
    {
        if (!empty($askQuestionTagIds)) {
            $arrSelectedForms       = [];
            $arrSelectedForms1 []   = array_unique($askQuestionTagIds);

            foreach ($arrSelectedForms1[0] as $key => $value) {
                $arrSelectedForms [] = $value;
            }

            $sForms = implode(',', $arrSelectedForms);
        }else{
            $sForms = '';
        }

        $createObj = New AskQuestion();
        $createObj->question = $question;
        $createObj->questionDate = date('Y-m-d H:i:s');
        $createObj->userId = Auth::id();
        if(Auth::check() && (Auth::user()->userrole_id == 1)){
            $createObj->status = 1;
        }else{
            $createObj->status = 0;
        }
        $createObj->askQuestionTagIds = $sForms;
        $createObj->employee_id = Auth::id();
        $createObj->save();

        $slugTitle = strip_tags($createObj->question);

        $updateSlugObj = AskQuestion::findOrFail($createObj->id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($slugTitle.'-'.$createObj->id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());

        $userDetailsObj = User::orderBy('users.id' ,'DESC')
                ->where('users.id','=',$userId)
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->first();

        $userName               = $userDetailsObj->fullname;
        $userEmail              = $userDetailsObj->email;
        $askUrl                 = env('APP_URL').'/ask';

        $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($sForms)"));

        $bodyContent    =   '<p><b>User Details :</b></p>
                            <ul>
                                <li>User Name : '.$userName.'</li>
                                <li>Email : '.$userEmail.'</li>
                            </ul>
                            <p><b>Ask Question Details :</b></p>
                            <ul>
                                <li>Question            : '.$question.'</li>
                                <li>Question Tags       : '.$tags.'</li>
                                <li>Page Url            : '.$askUrl.'</li>
                            </ul>';

        $send_to = $userEmail;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $userName;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

        // $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
        //         ->where('users.userstatus_id','=', '1')
        //         ->where('users.userrole_id','=', '1')
        //         ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
        //         ->get();

        // $slug1 = 'submit_question_answer_comment';
        // foreach ($getTheEmailAdmin as $key => $value) {
        //     $fullname1 = $value->fullname;
        //     $send_to1 = $value->email;
        //     $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        //     $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        // }

        if(Auth::check() && (Auth::user()->userrole_id == 1)){
            $msg = 'Question has been added successfully!';
        }else{
            $msg = 'Question has been added successfully!, Your answer approval is under process!';
        }

        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);


        return true;
    }

    public function addNewAskQuestionAnswer(Request $request, $questionId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        endif;

        if (Auth::check()){ 
            $userId = Auth::id();
            $answer = Input::get('answer');

            self::submitAskQuestionAnswer($questionId, $answer, $userId);
                   
            Session::flash('alert_class', 'alert-success');

            if(Auth::check() && (Auth::user()->userrole_id == 1)){
                Session::flash('flash_message', 'Answer has been added successfully!');
            }else{
                Session::flash('flash_message', 'Answer has been added successfully, Your answer approval is under process!');
            }

            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function submitAskQuestionAnswer($questionId, $answer, $userId)
    {
        $createObj = New AskQuestionAnswer();
        $createObj->answer = $answer;
        $createObj->answerDate = date('Y-m-d H:i:s');
        $createObj->questionId = $questionId;
        $createObj->employee_id = Auth::id();
        if(Auth::check() && (Auth::user()->userrole_id == 1)){
            $createObj->status = 1;
        }else{
            $createObj->status = 0;
        }

        $createObj->userId = Auth::id();
        $createObj->save();

        $totalAnswerCount = DB::table('ask_question_answers')
                            ->where('questionId','=', $questionId)
                            ->count();

        $totalCommentsCount = DB::table('ask_question_answer_comments')
                            ->where('questionId','=', $questionId)
                            ->count();
        
        $askquestion = AskQuestion::findOrFail($questionId);
        $askquestion->totalAnswerCount = $totalAnswerCount;
        $askquestion->totalCommentsCount = $totalCommentsCount;
        $askquestion->save();

        $userDetailsObj = User::orderBy('users.id' ,'DESC')
                ->where('users.id','=',$userId)
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->first();

        $questionObj = AskQuestion::orderBy('ask_questions.id' ,'DESC')
                ->where('ask_questions.id','=',$questionId)
                ->first();

        $userName               = $userDetailsObj->fullname;
        $userEmail              = $userDetailsObj->email;
        $askUrl                 = env('APP_URL').'/ask/'.$questionObj->slug;

        $bodyContent    =   '<p><b>User Details :</b></p>
                            <ul>
                                <li>User Name : '.$userName.'</li>
                                <li>Email : '.$userEmail.'</li>
                            </ul>
                            <p><b>Answer Details :</b></p>
                            <ul>
                                <li>Question            : '.$questionObj->question.'</li>
                                <li>Answer              : '.$answer.'</li>
                                <li>Page Url            : '.$askUrl.'</li>
                            </ul>';

        $send_to = $userEmail;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $userName;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

        // $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
        //         ->where('users.userstatus_id','=', '1')
        //         ->where('users.userrole_id','=', '1')
        //         ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
        //         ->get();

        // $slug1 = 'submit_question_answer_comment';
        // foreach ($getTheEmailAdmin as $key => $value) {
        //     $fullname1 = $value->fullname;
        //     $send_to1 = $value->email;
        //     $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        //     $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        // }

        if(Auth::check() && (Auth::user()->userrole_id == 1)){
            $msg = 'Answer has been added successfully!';
        }else{
            $msg = 'Answer has been added successfully, Your answer approval is under process!';
        }

        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return true;
    }

    public function addNewAskQuestionAnswerComment(Request $request, $questionId, $answerId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        endif;

        if (Auth::check()){ 
            $userId = Auth::id();
            $replyanswer = Input::get('replyanswer');
            self::submitAskQuestionAnswerComment($questionId, $answerId, $replyanswer, $userId);

            if(Auth::check() && (Auth::user()->userrole_id == 1)){
                Session::flash('flash_message', 'Comment has been added successfully!');
            }else{
                Session::flash('flash_message', 'Comment has been added successfully, Your Comment approval is under process!');
            }
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function submitAskQuestionAnswerComment($questionId, $answerId, $replyanswer, $userId)
    {
        $createObj = New AskQuestionAnswerComment();
        $createObj->replyanswer = $replyanswer;
        $createObj->answerDate = date('Y-m-d H:i:s');
        $createObj->answerId = $answerId;
        $createObj->questionId = $questionId;
        $createObj->employee_id = Auth::id();
        if(Auth::check() && (Auth::user()->userrole_id == 1)){
            $createObj->status = 1;
        }else{
            $createObj->status = 0;
        }
        $createObj->userId = Auth::id();
        $createObj->save();
        
        $totalAnswerCount = DB::table('ask_question_answers')
                            ->where('questionId','=', $questionId)
                            ->count();

        $totalCommentsCount = DB::table('ask_question_answer_comments')
                            ->where('questionId','=', $questionId)
                            ->count();

        
        $askquestion = AskQuestion::findOrFail($questionId);
        $askquestion->totalAnswerCount = $totalAnswerCount;
        $askquestion->totalCommentsCount = $totalCommentsCount;
        $askquestion->save();

        $userDetailsObj = User::orderBy('users.id' ,'DESC')
                ->where('users.id','=',$userId)
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->first();

        $questionObj = AskQuestion::orderBy('ask_questions.id' ,'DESC')
                ->where('ask_questions.id','=',$questionId)
                ->first();

        $answerObj = AskQuestionAnswer::orderBy('ask_question_answers.id' ,'DESC')
                ->where('ask_question_answers.id','=',$answerId)
                ->where('ask_question_answers.questionId','=',$questionId)
                ->first();

        $userName               = $userDetailsObj->fullname;
        $userEmail              = $userDetailsObj->email;
        $askUrl                 = env('APP_URL').'/ask/'.$questionObj->slug;

        $bodyContent    =   '<p><b>User Details :</b></p>
                            <ul>
                                <li>User Name : '.$userName.'</li>
                                <li>Email : '.$userEmail.'</li>
                            </ul>
                            <p><b>Comment Details :</b></p>
                            <ul>
                                <li>Question            : '.$questionObj->question.'</li>
                                <li>Answer              : '.$answerObj->answer.'</li>
                                <li>Comments            : '.$replyanswer.'</li>
                                <li>Page Url            : '.$askUrl.'</li>
                            </ul>';

        $send_to = $userEmail;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $userName;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

        // $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
        //         ->where('users.userstatus_id','=', '1')
        //         ->where('users.userrole_id','=', '1')
        //         ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
        //         ->get();

        // $slug1 = 'submit_question_answer_comment';
        // foreach ($getTheEmailAdmin as $key => $value) {
        //     $fullname1 = $value->fullname;
        //     $send_to1 = $value->email;
        //     $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        //     $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        // }

        if(Auth::check() && (Auth::user()->userrole_id == 1)){
            $msg = 'Comment has been added successfully!';
        }else{
            $msg = 'Comment has been added successfully!, Your answer approval is under process!';
        }

        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return true;
    }

    public function updateAskQuestionAnswer(Request $request, $questionId, $answerId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        endif;

        if (Auth::check()){ 
            $userId = Auth::id();
            $checkUser = DB::table('ask_question_answers')
                            ->where('ask_question_answers.id','=',$answerId)
                            ->where('ask_question_answers.questionId','=',$questionId)
                            ->where('ask_question_answers.userId', '=', $userId)
                            ->get();

            if (sizeof($checkUser) > 0) {

                $createObj = AskQuestionAnswer::findOrFail($answerId);
                $createObj->answer = Input::get('answer');
                $createObj->questionId = $questionId;
                $createObj->employee_id = Auth::id();
                //$createObj->userId = Auth::id();
                if(Auth::check() && (Auth::user()->userrole_id == 1)){
                    $createObj->status = 1;
                }else{
                    $createObj->status = 0;
                }
                $createObj->save();

                $totalAnswerCount = DB::table('ask_question_answers')
                                    ->where('questionId','=', $questionId)
                                    ->count();

                $totalCommentsCount = DB::table('ask_question_answer_comments')
                                    ->where('questionId','=', $questionId)
                                    ->count();

                
                $askquestion = AskQuestion::findOrFail($questionId);
                $askquestion->totalAnswerCount = $totalAnswerCount;
                $askquestion->totalCommentsCount = $totalCommentsCount;
                $askquestion->save();

                $userDetailsObj = User::orderBy('users.id' ,'DESC')
                    ->where('users.id','=',$userId)
                    ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                    ->first();

                $questionObj = AskQuestion::orderBy('ask_questions.id' ,'DESC')
                        ->where('ask_questions.id','=',$questionId)
                        ->first();

                $userName               = $userDetailsObj->fullname;
                $userEmail              = $userDetailsObj->email;
                $askUrl                 = env('APP_URL').'/ask/'.$questionObj->slug;

                $bodyContent    =   '<p><b>User Details :</b></p>
                                    <ul>
                                        <li>User Name : '.$userName.'</li>
                                        <li>Email : '.$userEmail.'</li>
                                    </ul>
                                    <p><b>Answer Details :</b></p>
                                    <ul>
                                        <li>Question            : '.$questionObj->question.'</li>
                                        <li>Answer              : '.Input::get('answer').'</li>
                                        <li>Page Url            : '.$askUrl.'</li>
                                    </ul>';

                $send_to = $userEmail;
                $send_cc = null;
                $send_bcc = null;
                $slug = 'send_response_email';
                $title =  Config::get('systemsetting.TITLE');
                $form_name = $userName;

                $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
                $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);
                
                Session::flash('alert_class', 'alert-success');
                if(Auth::check() && (Auth::user()->userrole_id == 1)){
                    Session::flash('flash_message', 'Answer has been updated successfully!');
                }else{
                    Session::flash('flash_message', 'Answer has been updated successfully, Your answer approval is under process!');
                }
                return Redirect::back();
            }else{
                Session::flash('alert_class', 'alert-danger');
                Session::flash('flash_message', 'You are not authorize person for this answer');
                return Redirect::back();
            }
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function updateAskQuestionAnswerComment(Request $request, $questionId, $answerId, $commentId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        endif;


        if (Auth::check()){ 

            $userId = Auth::id();
            $checkUser = DB::table('ask_question_answer_comments')
                            ->where('ask_question_answer_comments.id','=',$commentId)
                            ->where('ask_question_answer_comments.answerId','=',$answerId)
                            ->where('ask_question_answer_comments.questionId','=',$questionId)
                            ->where('ask_question_answer_comments.userId', '=', $userId)
                            ->get();

            if (sizeof($checkUser) > 0) {
                $createObj = AskQuestionAnswerComment::findOrFail($commentId);
                $createObj->replyanswer = Input::get('replyanswer');
                $createObj->answerId = $answerId;
                $createObj->questionId = $questionId;
                $createObj->employee_id = Auth::id();
                //$createObj->userId = Auth::id();
                if(Auth::check() && (Auth::user()->userrole_id == 1)){
                    $createObj->status = 1;
                }else{
                    $createObj->status = 0;
                }
                $createObj->save();

                $totalAnswerCount = DB::table('ask_question_answers')
                                    ->where('questionId','=', $questionId)
                                    ->count();

                $totalCommentsCount = DB::table('ask_question_answer_comments')
                                    ->where('questionId','=', $questionId)
                                    ->count();

                
                $askquestion = AskQuestion::findOrFail($questionId);
                $askquestion->totalAnswerCount = $totalAnswerCount;
                $askquestion->totalCommentsCount = $totalCommentsCount;
                $askquestion->save();

                $userDetailsObj = User::orderBy('users.id' ,'DESC')
                    ->where('users.id','=',$userId)
                    ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                    ->first();

                $questionObj = AskQuestion::orderBy('ask_questions.id' ,'DESC')
                        ->where('ask_questions.id','=',$questionId)
                        ->first();

                $answerObj = AskQuestionAnswer::orderBy('ask_question_answers.id' ,'DESC')
                        ->where('ask_question_answers.id','=',$answerId)
                        ->where('ask_question_answers.questionId','=',$questionId)
                        ->first();

                $userName               = $userDetailsObj->fullname;
                $userEmail              = $userDetailsObj->email;
                $askUrl                 = env('APP_URL').'/ask/'.$questionObj->slug;

                $bodyContent    =   '<p><b>User Details :</b></p>
                                    <ul>
                                        <li>User Name : '.$userName.'</li>
                                        <li>Email : '.$userEmail.'</li>
                                    </ul>
                                    <p><b>Comment Details :</b></p>
                                    <ul>
                                        <li>Question            : '.$questionObj->question.'</li>
                                        <li>Answer              : '.$answerObj->answer.'</li>
                                        <li>Comments            : '.Input::get('replyanswer').'</li>
                                        <li>Page Url            : '.$askUrl.'</li>
                                    </ul>';

                $send_to = $userEmail;
                $send_cc = null;
                $send_bcc = null;
                $slug = 'send_response_email';
                $title =  Config::get('systemsetting.TITLE');
                $form_name = $userName;

                $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
                $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

                Session::flash('alert_class', 'alert-success');
                if(Auth::check() && (Auth::user()->userrole_id == 1)){
                    Session::flash('flash_message', 'Comment has been updated successfully!');
                }else{
                    Session::flash('flash_message', 'Comment has been updated successfully, Your Comment approval is under process!');
                }
                return Redirect::back();
            }else{
                Session::flash('alert_class', 'alert-danger');
                Session::flash('flash_message', 'You are not authorize person for this answer');
                return Redirect::back();
            }
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function updateAskQuestionAnswerAdmin(Request $request, $questionId, $answerId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check()){ 
            $userId = Auth::id();
            $createObj = AskQuestionAnswer::findOrFail($answerId);
            $createObj->answer = Input::get('answer');
            //$createObj->questionId = $questionId;
            $createObj->employee_id = Auth::id();
            $createObj->save();

            $totalAnswerCount = DB::table('ask_question_answers')
                                ->where('questionId','=', $questionId)
                                ->count();

            $totalCommentsCount = DB::table('ask_question_answer_comments')
                                ->where('questionId','=', $questionId)
                                ->count();
            
            $askquestion = AskQuestion::findOrFail($questionId);
            $askquestion->totalAnswerCount = $totalAnswerCount;
            $askquestion->totalCommentsCount = $totalCommentsCount;
            $askquestion->save();

            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Answer has been updated successfully!');
            
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function updateAskQuestionAnswerCommentAdmin(Request $request, $questionId, $answerId, $commentId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check()){ 
            $userId = Auth::id();
            $createObj = AskQuestionAnswerComment::findOrFail($commentId);
            $createObj->replyanswer = Input::get('replyanswer');
            //$createObj->answerId = $answerId;
            //$createObj->questionId = $questionId;
            $createObj->employee_id = Auth::id();
            $createObj->save();

            $totalAnswerCount = DB::table('ask_question_answers')
                                ->where('questionId','=', $questionId)
                                ->count();

            $totalCommentsCount = DB::table('ask_question_answer_comments')
                                ->where('questionId','=', $questionId)
                                ->count();
            
            $askquestion = AskQuestion::findOrFail($questionId);
            $askquestion->totalAnswerCount = $totalAnswerCount;
            $askquestion->totalCommentsCount = $totalCommentsCount;
            $askquestion->save();

            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Comment has been updated successfully!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function deleteAskQuestionAnswer($questionId, $answerId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check()){ 
            Db::table('ask_question_answer_comments')
                ->where('ask_question_answer_comments.questionId', '=', $questionId)
                ->where('ask_question_answer_comments.answerId', '=', $answerId)
                ->delete();

            Db::table('ask_question_answers')
                ->where('ask_question_answers.questionId', '=', $questionId)
                ->where('ask_question_answers.id', '=', $answerId)
                ->delete();

            $totalAnswerCount = DB::table('ask_question_answers')
                                ->where('questionId','=', $questionId)
                                ->count();

            $totalCommentsCount = DB::table('ask_question_answer_comments')
                                ->where('questionId','=', $questionId)
                                ->count();

            $askquestion = AskQuestion::findOrFail($questionId);
            $askquestion->totalAnswerCount = $totalAnswerCount;
            $askquestion->totalCommentsCount = $totalCommentsCount;
            $askquestion->save();

            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Ask question answer deleted successfully!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'You are not authorize person for this answer. Please login first!'); 
            return Redirect::back();
        }
    }

    public function deleteAskQuestionAnswerComment($questionId, $answerId, $commentId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
        
        if (Auth::check()){ 
            Db::table('ask_question_answer_comments')
                ->where('ask_question_answer_comments.questionId', '=', $questionId)
                ->where('ask_question_answer_comments.answerId', '=', $answerId)
                ->where('ask_question_answer_comments.id', '=', $commentId)
                ->delete();

            $totalCommentsCount = DB::table('ask_question_answer_comments')
                                ->where('questionId','=', $questionId)
                                ->count();

            $askquestion = AskQuestion::findOrFail($questionId);
            $askquestion->totalCommentsCount = $totalCommentsCount;
            $askquestion->save();

            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Ask question comments has been deleted successfully!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'You are not authorize person for this answer. Please login first!'); 
            return Redirect::back();
        }
    }

    public function answerStatusChange(Request $request)
    {
        $status = Input::get('currentStatus');
        $id = Input::get('id');
        DB::statement(DB::raw("UPDATE ask_question_answers SET status=".Input::get('currentStatus')." WHERE id=".Input::get('id').""));
        return response()->json(['code' => 200, 'response' => 'success']);
    }

    public function answerCommentStatusChange(Request $request)
    {
        $status = Input::get('currentStatus');
        $id = Input::get('id');
        DB::statement(DB::raw("UPDATE ask_question_answer_comments SET status=".Input::get('currentStatus')." WHERE id=".Input::get('id').""));
        return response()->json(['code' => 200, 'response' => 'success']);
    }

    public function listOfSubmitQuestionAction(Request $request, $userroleslug, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' || $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $listOfSubmitQuestion = AskQuestion::orderBy('ask_questions.id', 'DESC')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->where('users.id', '=', $userId)
                        ->paginate(15, array('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','askQuestionTagIds'));

                $tags = [];
                foreach ($listOfSubmitQuestion as $key => $value) {
                    if (!empty($value->askQuestionTagIds)) {
                        $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($value->askQuestionTagIds)"));
                    }
                    $value->tagname = $tags;
                }
                return view('common-partials.submit-question-list-partial', compact('listOfSubmitQuestion','userroleslug','slug'));
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function listOfSubmitAnswerAction(Request $request, $userroleslug, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' || $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $listOfSubmitAnswers = AskQuestionAnswer::orderBy('ask_question_answers.id', 'DESC')
                        ->leftJoin('ask_questions', 'ask_question_answers.questionId', '=', 'ask_questions.id')
                        ->leftJoin('users', 'ask_question_answers.userId', '=', 'users.id')
                        ->where('ask_question_answers.userId', '=', $userId)
                        ->paginate(15, array('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','askQuestionTagIds','answer', 'answerDate'));

                $tags = [];
                foreach ($listOfSubmitAnswers as $key => $value) {
                    if (!empty($value->askQuestionTagIds)) {
                        $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($value->askQuestionTagIds)"));
                    }
                    $value->tagname = $tags;
                }
                return view('common-partials.submit-answer-list-partial', compact('listOfSubmitAnswers','userroleslug','slug'));
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function listOfSubmitCommentsAction(Request $request, $userroleslug, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' || $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $listOfSubmitComments = AskQuestionAnswerComment::orderBy('ask_question_answer_comments.id', 'DESC')
                        ->leftJoin('ask_question_answers', 'ask_question_answer_comments.answerId', '=', 'ask_question_answers.id')
                        ->leftJoin('ask_questions', 'ask_question_answer_comments.questionId', '=', 'ask_questions.id')
                        ->leftJoin('users', 'ask_question_answer_comments.userId', '=', 'users.id')
                        ->where('ask_question_answer_comments.userId', '=', $userId)
                        ->paginate(15, array('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','askQuestionTagIds','ask_question_answers.answer', 'ask_question_answer_comments.answerDate','ask_question_answer_comments.replyanswer'));

                $tags = [];
                foreach ($listOfSubmitComments as $key => $value) {
                    if (!empty($value->askQuestionTagIds)) {
                        $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($value->askQuestionTagIds)"));
                    }
                    $value->tagname = $tags;
                }
                return view('common-partials.submit-comments-list-partial', compact('listOfSubmitComments','userroleslug','slug'));
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }
}
