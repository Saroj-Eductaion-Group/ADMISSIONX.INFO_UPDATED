<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdsTopCollegeList;
use App\Models\CollegeProfile;
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

class AdsTopCollegeListController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsTopCollegeList');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $method_type = Input::get('method_type');
        $page_name_id = Input::get('page_name_id');
        $query = AdsTopCollegeList::orderBy('ads_top_college_lists.id', 'DESC')
                    ->leftjoin('educationlevel', 'ads_top_college_lists.educationlevel_id', '=', 'educationlevel.id')
                    ->leftjoin('functionalarea', 'ads_top_college_lists.functionalarea_id', '=', 'functionalarea.id')
                    ->leftjoin('degree', 'ads_top_college_lists.degree_id', '=', 'degree.id')
                    ->leftjoin('course', 'ads_top_college_lists.course_id', '=', 'course.id')
                    ->leftjoin('university', 'ads_top_college_lists.university_id', '=', 'university.id')
                    ->leftJoin('city', 'ads_top_college_lists.city_id', '=', 'city.id')
                    ->leftJoin('state', 'ads_top_college_lists.state_id', '=', 'state.id')
                    ->leftJoin('country', 'ads_top_college_lists.country_id', '=', 'country.id')
                    ->leftJoin('users as eID','ads_top_college_lists.employee_id', '=','eID.id');

        if($method_type == "Functional Area"):
            $query->where('ads_top_college_lists.functionalarea_id', '=', $page_name_id);
        elseif($method_type == "Degree"):
            $query->where('ads_top_college_lists.degree_id', '=', $page_name_id);
        elseif($method_type == "Course"):
            $query->where('ads_top_college_lists.course_id', '=', $page_name_id);
        elseif($method_type == "Education Level"):
            $query->where('ads_top_college_lists.educationlevel_id', '=', $page_name_id);
        elseif($method_type == "City"):
            $query->where('ads_top_college_lists.city_id', '=', $page_name_id);
        elseif($method_type == "State"):
            $query->where('ads_top_college_lists.state_id', '=', $page_name_id);
        elseif($method_type == "Country"):
            $query->where('ads_top_college_lists.country_id', '=', $page_name_id);
        elseif($method_type == "University"):
            $query->where('ads_top_college_lists.university_id', '=', $page_name_id);
        endif;

        if (!empty($request->get('searchByEmployeeId'))) {
            $query->where('ads_top_college_lists.employee_id', '=', Input::get('searchByEmployeeId'));
        }

        if ($request->has('status') && !empty($request->get('status'))) {
            $status = Input::get('status');
            if ($status == 'Inactive') {
                $query->where('ads_top_college_lists.status', '=', 0);
            }else{
                $query->where('ads_top_college_lists.status', '=', 1);
            }
        }

        $adstopcollegelist = $query->paginate(20, array('ads_top_college_lists.id', 'ads_top_college_lists.method_type','ads_top_college_lists.collegeprofile_id', 'ads_top_college_lists.functionalarea_id', 'ads_top_college_lists.degree_id', 'ads_top_college_lists.course_id', 'ads_top_college_lists.educationlevel_id', 'ads_top_college_lists.city_id', 'ads_top_college_lists.state_id', 'ads_top_college_lists.country_id', 'ads_top_college_lists.university_id', 'ads_top_college_lists.status', 'ads_top_college_lists.employee_id','educationlevel.name as educationlevelName','functionalarea.name as functionalAreaName','degree.name as degreeName','course.name as courseName','university.name as universityName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','ads_top_college_lists.updated_at','city.name as cityName', 'state.name as stateName','country.name as countryName'));


        $collegeListObj = [];
        foreach ($adstopcollegelist as $key => $value) {
            if (!empty($value->collegeprofile_id)) {
                $collegeListObj = DB::table('collegeprofile')
                                    ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->whereIN('collegeprofile.id', explode(',', $value->collegeprofile_id))
                                    ->select('collegeprofile.id','collegeprofile.slug', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                                    ->orderBy('collegeprofile.id', 'DESC')
                                    ->get();
            }
            $value->collegeListObj = $collegeListObj;
        }

        return view('administrator.ads-top-college-list.index', compact('adstopcollegelist'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsTopCollegeList');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        return view('administrator.ads-top-college-list.create');
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
        $collegeProfileId = Input::get('collegeId');
        if(!empty($collegeProfileId) || sizeof($collegeProfileId) > 0){
            $method_type = Input::get('method_type');
            $page_name_id = Input::get('page_name_id');

            $query = DB::table('ads_top_college_lists');
            if($method_type == "Functional Area"):
                $query->where('functionalarea_id', '=', $page_name_id);
            elseif($method_type == "Degree"):
                $query->where('degree_id', '=', $page_name_id);
            elseif($method_type == "Course"):
                $query->where('course_id', '=', $page_name_id);
            elseif($method_type == "Education Level"):
                $query->where('educationlevel_id', '=', $page_name_id);
            elseif($method_type == "City"):
                $query->where('city_id', '=', $page_name_id);
            elseif($method_type == "State"):
                $query->where('state_id', '=', $page_name_id);
            elseif($method_type == "Country"):
                $query->where('country_id', '=', $page_name_id);
            elseif($method_type == "University"):
                $query->where('university_id', '=', $page_name_id);
            endif;
            $checkExistingAdsCollegeList = $query->first();

            if(empty($checkExistingAdsCollegeList)){
                if (!empty($collegeProfileId)) {
                    $arrSelectedForms       = [];
                    $arrSelectedForms1 []   = array_unique($collegeProfileId);

                    foreach ($arrSelectedForms1[0] as $key => $value) {
                        $arrSelectedForms [] = $value;
                    }

                    $collegeprofile_ids = implode(',', $arrSelectedForms);
                }else{
                    $collegeprofile_ids = '';
                }

                $adsTopCollegeListObj                       = New AdsTopCollegeList();
                $adsTopCollegeListObj->method_type          = Input::get('method_type');
                $adsTopCollegeListObj->status               = Input::get('status');
                $adsTopCollegeListObj->collegeprofile_id    = $collegeprofile_ids;
                if($method_type == "Functional Area"):
                    $adsTopCollegeListObj->functionalarea_id    = $page_name_id;
                elseif($method_type == "Degree"):
                    $adsTopCollegeListObj->degree_id            = $page_name_id;
                elseif($method_type == "Course"):
                    $adsTopCollegeListObj->course_id            = $page_name_id;
                elseif($method_type == "Education Level"):
                    $adsTopCollegeListObj->educationlevel_id    = $page_name_id;
                elseif($method_type == "City"):
                    $adsTopCollegeListObj->city_id              = $page_name_id;
                elseif($method_type == "State"):
                    $adsTopCollegeListObj->state_id             = $page_name_id;
                elseif($method_type == "Country"):
                    $adsTopCollegeListObj->country_id           = $page_name_id;
                elseif($method_type == "University"):
                    $adsTopCollegeListObj->university_id        = $page_name_id;
                endif;

                $adsTopCollegeListObj->employee_id          = Auth::id();
                $adsTopCollegeListObj->save();

                Session::flash('alert_class', 'alert-success');
                Session::flash('flash_message', 'Ads Top College List added!');
            }else{
                Session::flash('alert_class', 'alert-danger');
                $urlLink = url($this->fetchDataServiceController->routeCall().'/ads-top-college-list/'.$checkExistingAdsCollegeList->id.'/edit');
                Session::flash('flash_message', "This ads college list is already exist, Please edit existing records id ".$checkExistingAdsCollegeList->id." or copy this link ".$urlLink);
            }
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please select college name');
        }
        return redirect($this->fetchDataServiceController->routeCall().'/ads-top-college-list');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsTopCollegeList');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $adstopcollegelist = AdsTopCollegeList::orderBy('ads_top_college_lists.id', 'DESC')
                    ->leftjoin('educationlevel', 'ads_top_college_lists.educationlevel_id', '=', 'educationlevel.id')
                    ->leftjoin('functionalarea', 'ads_top_college_lists.functionalarea_id', '=', 'functionalarea.id')
                    ->leftjoin('degree', 'ads_top_college_lists.degree_id', '=', 'degree.id')
                    ->leftjoin('course', 'ads_top_college_lists.course_id', '=', 'course.id')
                    ->leftjoin('university', 'ads_top_college_lists.university_id', '=', 'university.id')
                    ->leftJoin('city', 'ads_top_college_lists.city_id', '=', 'city.id')
                    ->leftJoin('state', 'ads_top_college_lists.state_id', '=', 'state.id')
                    ->leftJoin('country', 'ads_top_college_lists.country_id', '=', 'country.id')
                    ->leftJoin('users as eID','ads_top_college_lists.employee_id', '=','eID.id')
                    ->select('ads_top_college_lists.id', 'ads_top_college_lists.method_type','ads_top_college_lists.collegeprofile_id', 'ads_top_college_lists.functionalarea_id', 'ads_top_college_lists.degree_id', 'ads_top_college_lists.course_id', 'ads_top_college_lists.educationlevel_id', 'ads_top_college_lists.city_id', 'ads_top_college_lists.state_id', 'ads_top_college_lists.country_id', 'ads_top_college_lists.university_id', 'ads_top_college_lists.status', 'ads_top_college_lists.employee_id','educationlevel.name as educationlevelName','functionalarea.name as functionalAreaName','degree.name as degreeName','course.name as courseName','university.name as universityName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','ads_top_college_lists.updated_at','city.name as cityName', 'state.name as stateName','country.name as countryName')
                    ->findOrFail($id);

        $collegeListObj = [];
        if (!empty($adstopcollegelist->collegeprofile_id)) {
            $collegeListObj = DB::table('collegeprofile')
                                ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->whereIN('collegeprofile.id', explode(',', $adstopcollegelist->collegeprofile_id))
                                ->select('collegeprofile.id','collegeprofile.slug', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                                ->orderBy('id', 'DESC')
                                ->get();
        }

        return view('administrator.ads-top-college-list.show', compact('adstopcollegelist','collegeListObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsTopCollegeList');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $adstopcollegelist = AdsTopCollegeList::findOrFail($id);

        $collegeListObj = [];
        if (!empty($adstopcollegelist->collegeprofile_id)) {
            $collegeListObj = DB::table('collegeprofile')
                                ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->whereIN('collegeprofile.id', explode(',', $adstopcollegelist->collegeprofile_id))
                                ->select('collegeprofile.id','collegeprofile.slug', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                                ->orderBy('id', 'DESC')
                                ->get();
        }

        return view('administrator.ads-top-college-list.edit', compact('adstopcollegelist','collegeListObj'));
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
        $collegeProfileId = Input::get('collegeId');
        if(!empty($collegeProfileId) || sizeof($collegeProfileId) > 0){
            $adsTopCollegeListUpdate                       = AdsTopCollegeList::findOrFail($id);
            $adsTopCollegeListUpdate->functionalarea_id    = NULL;
            $adsTopCollegeListUpdate->degree_id            = NULL;
            $adsTopCollegeListUpdate->course_id            = NULL;
            $adsTopCollegeListUpdate->educationlevel_id    = NULL;
            $adsTopCollegeListUpdate->city_id              = NULL;
            $adsTopCollegeListUpdate->state_id             = NULL;
            $adsTopCollegeListUpdate->country_id           = NULL;
            $adsTopCollegeListUpdate->university_id        = NULL;
            $adsTopCollegeListUpdate->save();

            if (!empty($collegeProfileId)) {
                $arrSelectedForms       = [];
                $arrSelectedForms1 []   = array_unique($collegeProfileId);
                foreach ($arrSelectedForms1[0] as $key => $value) {
                    $arrSelectedForms [] = $value;
                }
                $collegeprofile_ids = implode(',', $arrSelectedForms);
            }else{
                $collegeprofile_ids = '';
            }

            $adsTopCollegeListObj                       = AdsTopCollegeList::findOrFail($id);
            $adsTopCollegeListObj->method_type          = Input::get('method_type');
            $adsTopCollegeListObj->status               = Input::get('status');
            $adsTopCollegeListObj->collegeprofile_id    = $collegeprofile_ids;
            if(Input::get('method_type') == "Functional Area"):
                $adsTopCollegeListObj->functionalarea_id    = Input::get('page_name_id');
            elseif(Input::get('method_type') == "Degree"):
                $adsTopCollegeListObj->degree_id            = Input::get('page_name_id');
            elseif(Input::get('method_type') == "Course"):
                $adsTopCollegeListObj->course_id            = Input::get('page_name_id');
            elseif(Input::get('method_type') == "Education Level"):
                $adsTopCollegeListObj->educationlevel_id    = Input::get('page_name_id');
            elseif(Input::get('method_type') == "City"):
                $adsTopCollegeListObj->city_id              = Input::get('page_name_id');
            elseif(Input::get('method_type') == "State"):
                $adsTopCollegeListObj->state_id             = Input::get('page_name_id');
            elseif(Input::get('method_type') == "Country"):
                $adsTopCollegeListObj->country_id           = Input::get('page_name_id');
            elseif(Input::get('method_type') == "University"):
                $adsTopCollegeListObj->university_id        = Input::get('page_name_id');
            endif;

            $adsTopCollegeListObj->employee_id          = Auth::id();
            $adsTopCollegeListObj->save();

            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Ads Top College List updated!');
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please select college name');
        }
        return redirect($this->fetchDataServiceController->routeCall().'/ads-top-college-list');        
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsTopCollegeList');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        AdsTopCollegeList::destroy($id);

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Ads Top College List deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/ads-top-college-list');
    }
}
