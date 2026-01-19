<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeManagementDetail;
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

class CollegeManagementDetailsController extends Controller
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
                $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeManagementDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;  

        $keyword = $request->get('search');
        $query = CollegeManagementDetail::orderBy('college_management_details.id', 'DESC')
                ->leftJoin('users as eID','college_management_details.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_management_details.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id');

        if (!empty($keyword)) {
            $query->orWhere('college_management_details.name', 'LIKE', "%$keyword%");
            $query->orWhere('college_management_details.designation', 'LIKE', "%$keyword%");
            $query->orWhere('college_management_details.emailaddress', 'LIKE', "%$keyword%");
            $query->orWhere('college_management_details.about', 'LIKE', "%$keyword%");
            $query->orWhere('college_management_details.phoneno', 'LIKE', "%$keyword%");
            $query->orWhere('college_management_details.landlineNo', 'LIKE', "%$keyword%");
        }

        if (!empty($request->get('collegeprofile_id'))) {
            $query->where('college_management_details.collegeprofile_id', '=', Input::get('collegeprofile_id'));
        }

        $collegemanagementdetails = $query->paginate(20, array('college_management_details.id','college_management_details.suffix','college_management_details.name', 'college_management_details.designation', 'college_management_details.gender', 'college_management_details.picture', 'college_management_details.emailaddress', 'college_management_details.phoneno', 'college_management_details.landlineNo', 'college_management_details.about', 'college_management_details.users_id', 'college_management_details.collegeprofile_id','college_management_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_management_details.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug'));


        $collegeProfileObj = DB::table('college_management_details')
                                ->leftJoin('collegeprofile', 'college_management_details.collegeprofile_id', '=', 'collegeprofile.id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                ->groupBy('college_management_details.collegeprofile_id')
                                ->get();

        return view('administrator.college-management-details.index', compact('collegemanagementdetails','collegeProfileObj'));
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
                $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeManagementDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;  
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        return view('administrator.college-management-details.create',compact('collegeProfileObj'));
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

        $collegeManagementObj = new CollegeManagementDetail;
        $collegeManagementObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeManagementObj->suffix = Input::get('suffix');
        $collegeManagementObj->name = Input::get('name');
        $collegeManagementObj->designation = Input::get('designation');
        $collegeManagementObj->gender = Input::get('gender');
        $collegeManagementObj->emailaddress = Input::get('emailaddress');
        $collegeManagementObj->phoneno = Input::get('phoneno');
        $collegeManagementObj->landlineNo = Input::get('landlineNo');
        $collegeManagementObj->about = Input::get('about');
        $collegeManagementObj->users_id = $collegeObj->users_id;
        $collegeManagementObj->employee_id = Auth::id();
        $collegeManagementObj->save();

        if($request->file('picture')){
            $fileName = time().'-'.$collegeObj->users_id.".".$request->picture->getClientOriginalExtension();
            $request->picture->move(public_path('gallery/'.$collegeObj->slug.'/'), $fileName);
            DB::table('college_management_details')->where('college_management_details.id', '=', $collegeManagementObj->id)->update(array('college_management_details.picture' => $fileName));
        }
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Management Detail added!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-management-details');
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
                $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeManagementDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;  

        $collegemanagementdetail = CollegeManagementDetail::orderBy('college_management_details.id', 'DESC')
                                    ->leftJoin('users as eID','college_management_details.employee_id', '=','eID.id')
                                    ->leftJoin('collegeprofile', 'college_management_details.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                                    ->select('college_management_details.id','college_management_details.suffix','college_management_details.name', 'college_management_details.designation', 'college_management_details.gender', 'college_management_details.picture', 'college_management_details.emailaddress', 'college_management_details.phoneno', 'college_management_details.landlineNo', 'college_management_details.about', 'college_management_details.users_id', 'college_management_details.collegeprofile_id','college_management_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_management_details.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug')
                                    ->findOrFail($id);

        return view('administrator.college-management-details.show', compact('collegemanagementdetail'));
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
                $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeManagementDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;  

        $collegemanagementdetail = CollegeManagementDetail::orderBy('college_management_details.id', 'DESC')
                                    ->leftJoin('users as eID','college_management_details.employee_id', '=','eID.id')
                                    ->leftJoin('collegeprofile', 'college_management_details.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                                    ->select('college_management_details.id','college_management_details.suffix','college_management_details.name', 'college_management_details.designation', 'college_management_details.gender', 'college_management_details.picture', 'college_management_details.emailaddress', 'college_management_details.phoneno', 'college_management_details.landlineNo', 'college_management_details.about', 'college_management_details.users_id', 'college_management_details.collegeprofile_id','college_management_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_management_details.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug')
                                    ->findOrFail($id);
                                    
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);

        return view('administrator.college-management-details.edit', compact('collegemanagementdetail','collegeProfileObj'));
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

        $collegeManagementObj = CollegeManagementDetail::findOrFail($id);
        $collegeManagementObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeManagementObj->suffix = Input::get('suffix');
        $collegeManagementObj->name = Input::get('name');
        $collegeManagementObj->designation = Input::get('designation');
        $collegeManagementObj->gender = Input::get('gender');
        $collegeManagementObj->emailaddress = Input::get('emailaddress');
        $collegeManagementObj->phoneno = Input::get('phoneno');
        $collegeManagementObj->landlineNo = Input::get('landlineNo');
        $collegeManagementObj->about = Input::get('about');
        $collegeManagementObj->users_id = $collegeObj->users_id;
        $collegeManagementObj->employee_id = Auth::id();
        $collegeManagementObj->save();

        if($request->file('picture')){
            $fileName = time().'-'.$collegeObj->users_id.".".$request->picture->getClientOriginalExtension();
            $request->picture->move(public_path('gallery/'.$collegeObj->slug.'/'), $fileName);
            DB::table('college_management_details')->where('college_management_details.id', '=', $collegeManagementObj->id)->update(array('college_management_details.picture' => $fileName));
        }
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Management Detail updated!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-management-details');
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
                $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CollegeManagementDetail');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;  

        CollegeManagementDetail::destroy($id);
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'CollegeManagementDetail deleted!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-management-details');
    }
}
