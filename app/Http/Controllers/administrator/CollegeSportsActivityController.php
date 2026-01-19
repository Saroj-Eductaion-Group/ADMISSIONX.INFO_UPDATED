<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeSportsActivity;
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

class CollegeSportsActivityController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeSportsActivity');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CollegeSportsActivity::orderBy('college_sports_activities.id', 'DESC')
                ->leftJoin('users as eID','college_sports_activities.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_sports_activities.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id');

        if (!empty($keyword)) {
            $query->orWhere('college_sports_activities.name', 'LIKE', "%$keyword%");
        }

        if (!empty($request->get('typeOfActivity'))) {
            $query->where('college_sports_activities.typeOfActivity', '=', Input::get('typeOfActivity'));
        }

        if (!empty($request->get('collegeprofile_id'))) {
            $query->where('college_sports_activities.collegeprofile_id', '=', Input::get('collegeprofile_id'));
        }

        $collegesportsactivity = $query->paginate(20, array('college_sports_activities.id','college_sports_activities.typeOfActivity','college_sports_activities.name','college_sports_activities.users_id', 'college_sports_activities.collegeprofile_id','college_sports_activities.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_sports_activities.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug'));


        $collegeProfileObj = DB::table('college_sports_activities')
                                ->leftJoin('collegeprofile', 'college_sports_activities.collegeprofile_id', '=', 'collegeprofile.id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                ->groupBy('college_sports_activities.collegeprofile_id')
                                ->get();

        return view('administrator.college-sports-activity.index', compact('collegesportsactivity','collegeProfileObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeSportsActivity');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        return view('administrator.college-sports-activity.create', compact('collegeProfileObj'));
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

        $CollegeSportsActivityObj = new CollegeSportsActivity;
        $CollegeSportsActivityObj->typeOfActivity = Input::get('typeOfActivity');
        $CollegeSportsActivityObj->name = Input::get('name');
        $CollegeSportsActivityObj->collegeprofile_id = Input::get('collegeprofile_id');
        $CollegeSportsActivityObj->users_id = $collegeObj->users_id;
        $CollegeSportsActivityObj->employee_id = Auth::id();
        $CollegeSportsActivityObj->save();

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Sports Activity added!');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-sports-activity');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeSportsActivity');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegesportsactivity = CollegeSportsActivity::orderBy('college_sports_activities.id', 'DESC')
                ->leftJoin('users as eID','college_sports_activities.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_sports_activities.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->select('college_sports_activities.id','college_sports_activities.typeOfActivity','college_sports_activities.name','college_sports_activities.users_id', 'college_sports_activities.collegeprofile_id','college_sports_activities.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_sports_activities.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug')
                ->findOrFail($id);

        return view('administrator.college-sports-activity.show', compact('collegesportsactivity'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeSportsActivity');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegesportsactivity = CollegeSportsActivity::findOrFail($id);
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);


        return view('administrator.college-sports-activity.edit', compact('collegesportsactivity','collegeProfileObj'));
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

        $CollegeSportsActivityObj = CollegeSportsActivity::findOrFail($id);
        $CollegeSportsActivityObj->typeOfActivity = Input::get('typeOfActivity');
        $CollegeSportsActivityObj->name = Input::get('name');
        $CollegeSportsActivityObj->collegeprofile_id = Input::get('collegeprofile_id');
        $CollegeSportsActivityObj->users_id = $collegeObj->users_id;
        $CollegeSportsActivityObj->employee_id = Auth::id();
        $CollegeSportsActivityObj->save();

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Sports Activity updated!');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-sports-activity');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeSportsActivity');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        CollegeSportsActivity::destroy($id);

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Sports Activity deleted!');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-sports-activity');
    }
}
