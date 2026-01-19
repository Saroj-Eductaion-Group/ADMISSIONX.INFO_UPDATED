<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\LandingPageQueryForm;
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
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Http\Controllers\Helper\FetchDataServiceController;

class LandingPageQueryFormController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LandingPageQueryForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = LandingPageQueryForm::orderBy('landing_page_query_forms.id', 'DESC')
                ->leftJoin('users as eID','landing_page_query_forms.employee_id', '=','eID.id')
                ->leftJoin('users', 'landing_page_query_forms.users_id', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id');

        if (!empty(Input::get('name'))) {
            $query->where('landing_page_query_forms.fullname', 'LIKE', '%'.Input::get('name').'%');
        }

        if (!empty(Input::get('email'))) {
            $query->where('landing_page_query_forms.mobilenumber', 'LIKE', '%'.Input::get('email').'%');
        }

        if (!empty(Input::get('phone'))) {
            $query->where('landing_page_query_forms.emailaddress', 'LIKE', '%'.Input::get('phone').'%');
        }

        if (!empty(Input::get('startdate'))) {
            $query->where('landing_page_query_forms.created_at', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
        }

        if (!empty(Input::get('enddate'))) {
            $query->where('landing_page_query_forms.created_at', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
        }

        if (!empty($keyword)) {
            $query->where('landing_page_query_forms.subject', 'LIKE', "%$keyword%");
            $query->orWhere('landing_page_query_forms.message', 'LIKE', "%$keyword%");
        }

        $landingpagequeryform = $query->paginate(20, array('landing_page_query_forms.id','landing_page_query_forms.fullname', 'landing_page_query_forms.mobilenumber', 'landing_page_query_forms.emailaddress', 'landing_page_query_forms.subject', 'landing_page_query_forms.message', 'landing_page_query_forms.users_id', 'landing_page_query_forms.employee_id','landing_page_query_forms.updated_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','landing_page_query_forms.created_at', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName'));

        return view('administrator.landing-page-query-form.index', compact('landingpagequeryform'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Redirect::back();
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LandingPageQueryForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
        return view('administrator.landing-page-query-form.create');
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
        return Redirect::back();
        $requestData = $request->all();
        
        LandingPageQueryForm::create($requestData);

        Session::flash('flash_message', 'LandingPageQueryForm added!');

        return redirect($this->fetchDataServiceController->routeCall().'/landing-page-query-form');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LandingPageQueryForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $landingpagequeryform = LandingPageQueryForm::orderBy('landing_page_query_forms.id', 'DESC')
                                ->leftJoin('users as eID','landing_page_query_forms.employee_id', '=','eID.id')
                                ->leftJoin('users', 'landing_page_query_forms.users_id', '=', 'users.id')
                                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                                ->select('landing_page_query_forms.id','landing_page_query_forms.fullname', 'landing_page_query_forms.mobilenumber', 'landing_page_query_forms.emailaddress', 'landing_page_query_forms.subject', 'landing_page_query_forms.message', 'landing_page_query_forms.users_id', 'landing_page_query_forms.employee_id','landing_page_query_forms.updated_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','landing_page_query_forms.created_at', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName')
                                ->findOrFail($id);

        return view('administrator.landing-page-query-form.show', compact('landingpagequeryform'));
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
        return Redirect::back();
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LandingPageQueryForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $landingpagequeryform = LandingPageQueryForm::findOrFail($id);

        return view('administrator.landing-page-query-form.edit', compact('landingpagequeryform'));
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
        return Redirect::back();
        $requestData = $request->all();
        
        $landingpagequeryform = LandingPageQueryForm::findOrFail($id);
        $landingpagequeryform->update($requestData);

        Session::flash('flash_message', 'LandingPageQueryForm updated!');

        return redirect($this->fetchDataServiceController->routeCall().'/landing-page-query-form');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('LandingPageQueryForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        LandingPageQueryForm::destroy($id);

        Session::flash('flash_message', 'LandingPageQueryForm deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/landing-page-query-form');
    }
}
