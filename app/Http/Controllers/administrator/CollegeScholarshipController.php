<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeScholarship;
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

class CollegeScholarshipController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeScholarship');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CollegeScholarship::orderBy('college_scholarships.id', 'DESC')
                ->leftJoin('users as eID','college_scholarships.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_scholarships.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id');

        if (!empty($keyword)) {
            $query->orWhere('college_scholarships.title', 'LIKE', "%$keyword%");
            $query->orWhere('college_scholarships.description', 'LIKE', "%$keyword%");
        }

        if (!empty($request->get('collegeprofile_id'))) {
            $query->where('college_scholarships.collegeprofile_id', '=', Input::get('collegeprofile_id'));
        }

        $collegescholarship = $query->paginate(20, array('college_scholarships.id','college_scholarships.title','college_scholarships.description','college_scholarships.users_id', 'college_scholarships.collegeprofile_id','college_scholarships.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_scholarships.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug'));


        $collegeProfileObj = DB::table('college_scholarships')
                                ->leftJoin('collegeprofile', 'college_scholarships.collegeprofile_id', '=', 'collegeprofile.id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                ->groupBy('college_scholarships.collegeprofile_id')
                                ->get();

        return view('administrator.college-scholarship.index', compact('collegescholarship','collegeProfileObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeScholarship');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        return view('administrator.college-scholarship.create', compact('collegeProfileObj'));
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

        $collegeScholarshipObj = new CollegeScholarship;
        $collegeScholarshipObj->title = Input::get('title');
        $collegeScholarshipObj->description = Input::get('description');
        $collegeScholarshipObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeScholarshipObj->users_id = $collegeObj->users_id;
        $collegeScholarshipObj->employee_id = Auth::id();
        $collegeScholarshipObj->save();
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Scholarship added!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-scholarship');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeScholarship');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegescholarship = CollegeScholarship::orderBy('college_scholarships.id', 'DESC')
                ->leftJoin('users as eID','college_scholarships.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_scholarships.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->select('college_scholarships.id','college_scholarships.title','college_scholarships.description','college_scholarships.users_id', 'college_scholarships.collegeprofile_id','college_scholarships.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_scholarships.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug')
                ->findOrFail($id);

        return view('administrator.college-scholarship.show', compact('collegescholarship'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeScholarship');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegescholarship = CollegeScholarship::findOrFail($id);
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);

        return view('administrator.college-scholarship.edit', compact('collegescholarship','collegeProfileObj'));
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

        $collegeScholarshipObj = CollegeScholarship::findOrFail($id);
        $collegeScholarshipObj->title = Input::get('title');
        $collegeScholarshipObj->description = Input::get('description');
        $collegeScholarshipObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeScholarshipObj->users_id = $collegeObj->users_id;
        $collegeScholarshipObj->employee_id = Auth::id();
        $collegeScholarshipObj->save();
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'CollegeScholarship updated!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-scholarship');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeScholarship');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        CollegeScholarship::destroy($id);
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'CollegeScholarship deleted!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-scholarship');
    }
}
