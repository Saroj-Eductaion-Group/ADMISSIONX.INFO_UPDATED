<?php

namespace App\Http\Controllers\examination;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\EligibilityCriterion;
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

class EligibilityCriteriaController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('EligibilityCriterion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = EligibilityCriterion::orderBy('eligibility_criterias.id', 'DESC')
                ->leftJoin('users as eID','eligibility_criterias.employee_id', '=','eID.id');

        if (!empty($keyword)) {
            $query->where('eligibility_criterias.name', 'LIKE', "%$keyword%");
        }

        $status = Input::get('status');
        if ($status == '0') {
            $query->where('eligibility_criterias.status', '=', '0');
        }else{
            if ($request->has('status') && !empty($request->get('status'))) {
                $query->where('eligibility_criterias.status', '=', Input::get('status'));
            }
        }

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('eligibility_criterias.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        $eligibilitycriteria = $query->paginate(20, array('eligibility_criterias.id','name', 'status', 'slug','eligibility_criterias.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','eligibility_criterias.updated_at'));

        return view('examination.eligibility-criteria.index', compact('eligibilitycriteria'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('EligibilityCriterion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        return view('examination.eligibility-criteria.create');
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
        $createObj = New EligibilityCriterion();
        $createObj->name = Input::get('name');
        $createObj->status = Input::get('status');
        $createObj->employee_id = Auth::id();
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('name'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $createObj->slug = $slug;
        $createObj->save();

        Session::flash('flash_message', 'Eligibility criteria added!');

        return redirect('examination/eligibility-criteria');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('EligibilityCriterion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $eligibilitycriterion = EligibilityCriterion::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','eligibility_criterias.employee_id', '=','eID.id')
                        ->select('eligibility_criterias.id','name', 'status', 'slug','eligibility_criterias.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','eligibility_criterias.updated_at')
                        ->findOrFail($id);

        return view('examination.eligibility-criteria.show', compact('eligibilitycriterion'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('EligibilityCriterion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $eligibilitycriterion = EligibilityCriterion::findOrFail($id);

        return view('examination.eligibility-criteria.edit', compact('eligibilitycriterion'));
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
        $updateObj = EligibilityCriterion::findOrFail($id);
        $updateObj->name = Input::get('name');
        $updateObj->status = Input::get('status');
        $updateObj->employee_id = Auth::id();
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('name'))); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateObj->slug = $slug;
        $updateObj->save();

        Session::flash('flash_message', 'Eligibility criteria updated!');

        return redirect('examination/eligibility-criteria');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('EligibilityCriterion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        EligibilityCriterion::destroy($id);

        Session::flash('flash_message', 'Eligibility criteria deleted!');

        return redirect('examination/eligibility-criteria');
    }
}
