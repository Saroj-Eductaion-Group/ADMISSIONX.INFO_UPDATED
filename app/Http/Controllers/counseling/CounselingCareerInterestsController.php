<?php

namespace App\Http\Controllers\counseling;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CounselingCareerInterest;
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
use App\Models\CounselingCareerRelevant;
use App\Models\CounselingCareerSkillRequirement;
use App\Models\CounselingCareerWhereToStudy;
use App\Http\Controllers\Helper\FetchDataServiceController;

class CounselingCareerInterestsController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerInterest');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CounselingCareerInterest::orderBy('counseling_career_interests.id', 'DESC')
                ->leftJoin('users as eID','counseling_career_interests.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id');

        if (!empty($keyword)) {
            $query->orWhere('counseling_career_interests.title', 'LIKE', "%$keyword%");
        }

        if ($request->has('functionalarea') && !empty($request->get('functionalarea'))) {
            $query->where('counseling_career_interests.functionalarea_id', '=', Input::get('functionalarea'));
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('counseling_career_interests.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('counseling_career_interests.status', '=', Input::get('status'));
            }
        }

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('counseling_career_interests.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        $counselingcareerinterests = $query->paginate(20, array('counseling_career_interests.id', 'title', 'description', 'image', 'status', 'functionalarea_id', 'slug','counseling_career_interests.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_career_interests.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName'));

        //$functionalAreaObj = FunctionalArea::all();

        $functionalAreaObj = DB::table('functionalarea')
                                    ->whereIN('functionalarea.id', [2,5,8])
                                    ->orderBy('functionalarea.id', 'ASC')
                                    ->get();

        return view('counseling.counseling-career-interests.index', compact('counselingcareerinterests','functionalAreaObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerInterest');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        //$functionalAreaObj = FunctionalArea::all();
        $functionalAreaObj = DB::table('functionalarea')
                                    ->whereIN('functionalarea.id', [2,5,8])
                                    ->orderBy('functionalarea.id', 'ASC')
                                    ->get();
        return view('counseling.counseling-career-interests.create', compact('functionalAreaObj'));
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
        $createObj = New CounselingCareerInterest();
        $createObj->title = Input::get('title');
        $createObj->description = Input::get('description');
        $createObj->status = Input::get('status');
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('title'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $createObj->slug = $slug;
        $createObj->functionalarea_id = Input::get('functionalarea_id');
        $createObj->employee_id = Auth::id();
        $createObj->save();

        if($request->file('image')){
            $fileName1 = 'counseling-career-interest-'.$createObj->id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_career_interests')->where('counseling_career_interests.id', '=', $createObj->id)->update(array('counseling_career_interests.image' => $fileName1)); 
        }

        Session::flash('flash_message', 'Counseling Career Interest added!');

        return redirect('counseling/counseling-career-interests');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerInterest');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcareerinterest = CounselingCareerInterest::orderBy('counseling_career_interests.id', 'DESC')
                ->leftJoin('users as eID','counseling_career_interests.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                ->select('counseling_career_interests.id', 'title', 'description', 'image', 'status', 'functionalarea_id', 'slug','counseling_career_interests.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_career_interests.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                ->findOrFail($id);

        return view('counseling.counseling-career-interests.show', compact('counselingcareerinterest'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerInterest');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->eidt == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $counselingcareerinterest = CounselingCareerInterest::findOrFail($id);
        //$functionalAreaObj = FunctionalArea::all();
        $functionalAreaObj = DB::table('functionalarea')
                                    ->whereIN('functionalarea.id', [2,5,8])
                                    ->orderBy('functionalarea.id', 'ASC')
                                    ->get();

        return view('counseling.counseling-career-interests.edit', compact('counselingcareerinterest','functionalAreaObj'));
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
        $updateObj = CounselingCareerInterest::findOrFail($id);
        $updateObj->title = Input::get('title');
        $updateObj->description = Input::get('description');
        $updateObj->status = Input::get('status');
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('title'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateObj->slug = $slug;
        $updateObj->functionalarea_id = Input::get('functionalarea_id');
        $updateObj->employee_id = Auth::id();
        $updateObj->save();

        if($request->file('image')){
            $fileName1 = 'counseling-career-interest-'.$id.".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('counselingimages/'), $fileName1);
            DB::table('counseling_career_interests')->where('counseling_career_interests.id', '=', $id)->update(array('counseling_career_interests.image' => $fileName1)); 
        }

        Session::flash('flash_message', 'Counseling Career Interest updated!');

        return redirect('counseling/counseling-career-interests');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CounselingCareerInterest');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        CounselingCareerInterest::destroy($id);

        Session::flash('flash_message', 'CounselingCareerInterest deleted!');

        return redirect('counseling/counseling-career-interests');
    }
}
