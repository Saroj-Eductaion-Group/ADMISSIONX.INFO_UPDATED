<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\LatestUpdate;
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
use App\Http\Controllers\Helper\FetchDataServiceController;

class LatestUpdateController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LatestUpdate');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = LatestUpdate::orderBy('latest_updates.id', 'DESC')
                    ->leftJoin('users as eID','latest_updates.employee_id', '=','eID.id');

        if (!empty($keyword)) {
            $query->where('latest_updates.name', 'LIKE', "%$keyword%");
        }

        if (!empty($request->get('description'))) {
            $query->where('latest_updates.description', 'LIKE', "%$request->get('description')");
        }

        $latestupdate = $query->paginate(20, array('latest_updates.id','name', 'date', 'desc', 'status', 'users_id','latest_updates.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','latest_updates.updated_at'));

        return view('administrator.latest-update.index', compact('latestupdate'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LatestUpdate');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        return view('administrator.latest-update.create');
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
        $latestUpdateObj = New LatestUpdate();
        $latestUpdateObj->name = Input::get('name');
        $latestUpdateObj->date = date('Y-m-d');
        $latestUpdateObj->desc = Input::get('desc');
        $latestUpdateObj->status = Input::get('status');
        $latestUpdateObj->users_id = Auth::id();
        $latestUpdateObj->employee_id = Auth::id();
        $latestUpdateObj->save();

        Session::flash('flash_message', 'Latest Update added!');

        return redirect($this->fetchDataServiceController->routeCall().'/latest-update');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LatestUpdate');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $latestupdate = LatestUpdate::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','latest_updates.employee_id', '=','eID.id')
                        ->select('latest_updates.id','name', 'date', 'desc', 'status', 'users_id','latest_updates.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','latest_updates.updated_at')
                        ->findOrFail($id);

        return view('administrator.latest-update.show', compact('latestupdate'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LatestUpdate');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $latestupdate = LatestUpdate::findOrFail($id);

        return view('administrator.latest-update.edit', compact('latestupdate'));
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
        $latestUpdateObj = LatestUpdate::findOrFail($id);
        $latestUpdateObj->name = Input::get('name');
        $latestUpdateObj->date = date('Y-m-d');
        $latestUpdateObj->desc = Input::get('desc');
        $latestUpdateObj->status = Input::get('status');
        $latestUpdateObj->users_id = Auth::id();
        $latestUpdateObj->employee_id = Auth::id();
        $latestUpdateObj->save();

        Session::flash('flash_message', 'LatestUpdate updated!');

        return redirect($this->fetchDataServiceController->routeCall().'/latest-update');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LatestUpdate');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        LatestUpdate::destroy($id);

        Session::flash('flash_message', 'LatestUpdate deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/latest-update');
    }
}
