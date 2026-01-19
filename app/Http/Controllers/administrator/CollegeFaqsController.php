<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeFaq;
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
Use File;
use Cache;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use App\Models\CollegeProfile;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class CollegeFaqsController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeFaq');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CollegeFaq::orderBy('college_faqs.id', 'DESC')
                ->leftJoin('users as eID','college_faqs.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_faqs.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id');

        if (!empty($keyword)) {
            $query->orWhere('college_faqs.question', 'LIKE', "%$keyword%");
            $query->orWhere('college_faqs.answer', 'LIKE', "%$keyword%");
        }

        if (!empty($request->get('collegeprofile_id'))) {
            $query->where('college_faqs.collegeprofile_id', '=', Input::get('collegeprofile_id'));
        }

        $collegefaqs = $query->paginate(20, array('college_faqs.id','college_faqs.question', 'college_faqs.answer', 'college_faqs.refLinks', 'college_faqs.users_id', 'college_faqs.collegeprofile_id','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug as collegeSlug','college_faqs.created_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_faqs.updated_at'));


        $collegeProfileObj = DB::table('college_faqs')
                        ->leftJoin('collegeprofile', 'college_faqs.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                        ->groupBy('college_faqs.collegeprofile_id')
                        ->get();

        return view('administrator.college-faqs.index', compact('collegefaqs','collegeProfileObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeFaq');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        return view('administrator.college-faqs.create', compact('collegeProfileObj'));
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
        $collegeObj = CollegeProfile::where('id', '=', Input::get('collegeprofile_id'))->firstOrFail();
        $collegeManagementObj = New CollegeFaq; 
        $collegeManagementObj->question = Input::get('question');
        $collegeManagementObj->answer = Input::get('answer');
        $collegeManagementObj->refLinks = Input::get('refLinks');
        $collegeManagementObj->users_id = $collegeObj->users_id;
        $collegeManagementObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeManagementObj->employee_id = Auth::id();
        $collegeManagementObj->save();

        Session::flash('flash_message', 'College Faq added!');
        Session::flash('alert_class', 'alert-success');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-faqs');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeFaq');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegefaq = CollegeFaq::orderBy('college_faqs.id', 'DESC')
                ->leftJoin('users as eID','college_faqs.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_faqs.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->select('college_faqs.id','college_faqs.question', 'college_faqs.answer', 'college_faqs.refLinks', 'college_faqs.users_id', 'college_faqs.collegeprofile_id','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug as collegeSlug','college_faqs.created_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_faqs.updated_at')
                ->findOrFail($id);

        return view('administrator.college-faqs.show', compact('collegefaq'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeFaq');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegefaq = CollegeFaq::findOrFail($id);
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);

        return view('administrator.college-faqs.edit', compact('collegefaq','collegeProfileObj'));
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
        $collegeObj = CollegeProfile::where('id', '=', Input::get('collegeprofile_id'))->firstOrFail();
        $collegeManagementObj = CollegeFaq::findOrFail($id);
        $collegeManagementObj->question = Input::get('question');
        $collegeManagementObj->answer = Input::get('answer');
        $collegeManagementObj->refLinks = Input::get('refLinks');
        $collegeManagementObj->users_id = $collegeObj->users_id;
        $collegeManagementObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeManagementObj->employee_id = Auth::id();
        $collegeManagementObj->save();

        Session::flash('flash_message', 'College Faq updated!');
        Session::flash('alert_class', 'alert-success');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-faqs');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeFaq');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        CollegeFaq::destroy($id);

        Session::flash('flash_message', 'College Faq deleted!');
        Session::flash('alert_class', 'alert-success');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-faqs');
    }
}
