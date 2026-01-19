<?php

namespace App\Http\Controllers\examination;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ExamSection;
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
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class ExamSectionController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamSection');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = ExamSection::orderBy('exam_sections.id', 'DESC')
                ->leftJoin('users as eID','exam_sections.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id');

        if (!empty($keyword)) {
            $query->where('exam_sections.name', 'LIKE', "%$keyword%");
            $query->orWhere('exam_sections.title', 'LIKE', "%$keyword%");
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('exam_sections.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('exam_sections.status', '=', Input::get('status'));
            }
        }

        $isShowOnTop = Input::get('isShowOnTop');
        if ($isShowOnTop == '0') {
            $query->where('exam_sections.isShowOnTop', '=', '0');
        }else{
            if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                $query->where('exam_sections.isShowOnTop', '=', Input::get('isShowOnTop'));
            }
        }

        $isShowOnHome = Input::get('isShowOnHome');
        if ($isShowOnHome == '0') {
            $query->where('exam_sections.isShowOnHome', '=', '0');
        }else{
            if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                $query->where('exam_sections.isShowOnHome', '=', Input::get('isShowOnHome'));
            }
        }


        if ($request->has('functionalarea') && !empty($request->get('functionalarea'))) {
            $query->where('exam_sections.functionalarea_id', '=', Input::get('functionalarea'));
        }

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('exam_sections.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        $examsection = $query->paginate(20, array('exam_sections.id','exam_sections.name', 'title', 'iconImage', 'status', 'slug','exam_sections.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_sections.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','exam_sections.isShowOnTop','exam_sections.isShowOnHome'));

        $functionalAreaObj = FunctionalArea::all();
        $tablename = 'exam_sections';
        return view('examination.exam-section.index', compact('examsection','functionalAreaObj','tablename'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamSection');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $functionalAreaObj = FunctionalArea::all();
        return view('examination.exam-section.create', compact('functionalAreaObj'));
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
        $createObj              = New ExamSection();
        $createObj->name        = Input::get('name');
        $createObj->title       = Input::get('title');
        $createObj->status      = Input::get('status');
        $createObj->isShowOnTop    =  Input::get('isShowOnTop');
        $createObj->isShowOnHome   =  Input::get('isShowOnHome');
        $createObj->functionalarea_id      = Input::get('functionalarea_id');
        $createObj->employee_id = Auth::id();
        $cleanChar              =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('name'))); 
        $slug                   = strtolower(trim($cleanChar));
        $slug                   = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug                   = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $createObj->slug        = $slug;
        $createObj->save();

        if($request->file('iconImage')){
            $fileName = $slug.'-'.$createObj->id.".".$request->iconImage->getClientOriginalExtension();
            $request->iconImage->move(public_path('examinationicon/'), $fileName);
            DB::table('exam_sections')->where('exam_sections.id', '=', $createObj->id)->update(array('exam_sections.iconImage' => $fileName));
        }

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($createObj->id, $request->all());

        Session::flash('flash_message', 'ExamSection added!');

        return redirect('examination/exam-section');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamSection');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examsection = ExamSection::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','exam_sections.employee_id', '=','eID.id')
                        ->leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                        ->select('exam_sections.id','exam_sections.name', 'title', 'iconImage', 'status', 'slug','exam_sections.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_sections.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                        ->findOrFail($id);

       $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.examSectionId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();
        
        $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('ExamSection','exam_sections',$id);
        $tablename = 'exam_sections';

        return view('examination.exam-section.show', compact('examsection','seocontent','newUpdatedFields','tablename'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamSection');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examsection = ExamSection::findOrFail($id);
        $functionalAreaObj = FunctionalArea::all();

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.examSectionId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId','examSectionId')
                        ->get();

        $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('ExamSection','exam_sections',$id);
        $tablename = 'exam_sections';

        return view('examination.exam-section.edit', compact('examsection','functionalAreaObj','seocontent','newUpdatedFields','tablename'));
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
        $updateObj              = ExamSection::findOrFail($id);
        $updateObj->name        = Input::get('name');
        $updateObj->title       = Input::get('title');
        $updateObj->status      = Input::get('status');
        $updateObj->isShowOnTop    =  Input::get('isShowOnTop');
        $updateObj->isShowOnHome   =  Input::get('isShowOnHome');
        $updateObj->functionalarea_id      = Input::get('functionalarea_id');
        $updateObj->employee_id = Auth::id();
        $cleanChar              =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('name'))); 
        $slug                   = strtolower(trim($cleanChar));
        $slug                   = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug                   = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateObj->slug        = $slug;
        $updateObj->save();

        if($request->file('iconImage')){
            $fileName = $slug.'-'.$id.".".$request->iconImage->getClientOriginalExtension();
            $request->iconImage->move(public_path('examinationicon/'), $fileName);
            DB::table('exam_sections')->where('exam_sections.id', '=', $id)->update(array('exam_sections.iconImage' => $fileName));
        }

        $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());

        Session::flash('flash_message', 'ExamSection updated!');

        return redirect('examination/exam-section');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamSection');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::table('seo_contents')
            ->where('seo_contents.examSectionId', '=', $id)
            ->delete();
            
        ExamSection::destroy($id);

        Session::flash('flash_message', 'ExamSection deleted!');

        return redirect('examination/exam-section');
    }
}
