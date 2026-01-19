<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ExamCounsellingForm;
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
use App\Models\ExamSection as ExamSection;
use App\Models\University as University;
use App\Models\TypeOfExamination;



class ExamCounsellingFormController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamCounsellingForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = ExamCounsellingForm::orderBy('exam_counselling_forms.id', 'DESC')
                ->leftJoin('users as eID','exam_counselling_forms.employee_id', '=','eID.id')
                ->leftjoin('type_of_examinations', 'exam_counselling_forms.exam_id', '=', 'type_of_examinations.id')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->leftJoin('users', 'exam_counselling_forms.users_id', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftjoin('city', 'exam_counselling_forms.city_id', '=', 'city.id')
                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                ->leftjoin('course', 'exam_counselling_forms.course_id', '=', 'course.id')
                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id');

        if (!empty(Input::get('name'))) {
            $query->where('exam_counselling_forms.name', 'LIKE', '%'.Input::get('name').'%');
        }

        if (!empty(Input::get('email'))) {
            $query->where('exam_counselling_forms.email', 'LIKE', '%'.Input::get('email').'%');
        }

        if (!empty(Input::get('phone'))) {
            $query->where('exam_counselling_forms.phone', 'LIKE', '%'.Input::get('phone').'%');
        }

        if (!empty(Input::get('startdate'))) {
            $query->where('exam_counselling_forms.created_at', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
        }

        if (!empty(Input::get('enddate'))) {
            $query->where('exam_counselling_forms.created_at', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
        }

        if (!empty($keyword)) {
            $query->where('type_of_examinations.name', 'LIKE', "%$keyword%");
            $query->orWhere('type_of_examinations.sortname', 'LIKE', "%$keyword%");
        }

        if ($request->has('city_id') && !empty($request->get('city_id'))) {
            $query->where('exam_counselling_forms.city_id', '=', Input::get('city_id'));
        }

        if ($request->has('course_id') && !empty($request->get('course_id'))) {
            $query->where('exam_counselling_forms.course_id', '=', Input::get('course_id'));
        }

        if ($request->has('exam_id') && !empty($request->get('exam_id'))) {
            $query->where('exam_counselling_forms.exam_id', '=', Input::get('exam_id'));
        }

        $examcounsellingform = $query->paginate(20, array('exam_counselling_forms.id','exam_counselling_forms.name', 'exam_counselling_forms.email', 'exam_counselling_forms.phone', 'exam_counselling_forms.misc', 'exam_counselling_forms.city_id', 'exam_counselling_forms.course_id', 'exam_counselling_forms.exam_id', 'exam_counselling_forms.users_id', 'exam_counselling_forms.employee_id','exam_counselling_forms.isResponse','exam_counselling_forms.isResponseMethod','exam_counselling_forms.updated_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name as examinationName','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','city.name as cityname','course.name as courseName','degree.name as degreeName','functionalarea.name as functionalareaName', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','type_of_examinations.slug','exam_sections.slug as examinationSlug','state.name as stateName','exam_counselling_forms.created_at'));

    
        $cousesListObj  = DB::table('exam_counselling_forms')
                            ->leftjoin('course', 'exam_counselling_forms.course_id', '=', 'course.id')
                            ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                            ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                            ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy('course.name','ASC')
                            ->groupBy('exam_counselling_forms.course_id')
                            ->get();

        $cityListObj    = DB::table('exam_counselling_forms')
                            ->leftjoin('city', 'exam_counselling_forms.city_id', '=', 'city.id')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country', 'country.id', '=', 'state.country_id')
                            ->select('city.id', 'city.name','state.name as stateName')
                            ->orderBy('city.name','ASC')
                            ->groupBy('exam_counselling_forms.city_id')
                            ->get();

        $examsectionsObj = DB::table('exam_sections')
                    ->select('id','name')
                    ->orderBy('exam_sections.name', 'ASC')
                    ->get()
                    ;

        return view('administrator.exam-counselling-form.index', compact('examcounsellingform','examsectionsObj','cousesListObj','cityListObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamCounsellingForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        //return redirect::back();
        $listOfExamObj  = DB::table('type_of_examinations')->get();
        $cousesListObj  = DB::table('course')
                            ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                            ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                            ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy('course.name','ASC')
                            ->get();

        $cityListObj = Cache::remember('cityListObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('city')
                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                        ->leftJoin('country', 'country.id', '=', 'state.country_id')
                        ->where('country.id','=', 99)
                        ->select('city.id', 'city.name','state.name as stateName')
                        ->orderBy('city.name','ASC')
                        ->get();
        });

        return view('administrator.exam-counselling-form.create', compact('listOfExamObj','cousesListObj','cityListObj'));
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
        //return redirect::back();
        
        $create                                 = New ExamCounsellingForm; 
        $create->name                           = Input::get('name');
        $create->email                          = Input::get('email');
        $create->phone                          = Input::get('phone');
        $create->misc                           = Input::get('misc');
        $create->city_id                        = Input::get('city_id');
        $create->course_id                      = Input::get('course_id');
        $create->exam_id                        = Input::get('exam_id');
        $create->isResponse                     = 1;
        $create->isResponseMethod               = 1;
        $create->users_id                       = Auth::id();
        $create->employee_id                    = Auth::id();
        $create->save();

        Session::flash('flash_message', 'ExamCounsellingForm added!');

        return redirect($this->fetchDataServiceController->routeCall().'/exam-counselling-form');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamCounsellingForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examcounsellingform = ExamCounsellingForm::orderBy('exam_counselling_forms.id', 'DESC')
                ->leftJoin('users as eID','exam_counselling_forms.employee_id', '=','eID.id')
                ->leftjoin('type_of_examinations', 'exam_counselling_forms.exam_id', '=', 'type_of_examinations.id')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->leftJoin('users', 'exam_counselling_forms.users_id', '=', 'users.id')
                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                ->leftjoin('city', 'exam_counselling_forms.city_id', '=', 'city.id')
                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                ->leftjoin('course', 'exam_counselling_forms.course_id', '=', 'course.id')
                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                ->select('exam_counselling_forms.id','exam_counselling_forms.name', 'exam_counselling_forms.email', 'exam_counselling_forms.phone', 'exam_counselling_forms.misc', 'exam_counselling_forms.city_id', 'exam_counselling_forms.course_id', 'exam_counselling_forms.exam_id', 'exam_counselling_forms.users_id', 'exam_counselling_forms.employee_id','exam_counselling_forms.isResponse','exam_counselling_forms.isResponseMethod','exam_counselling_forms.updated_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','type_of_examinations.id as examId','type_of_examinations.sortname', 'type_of_examinations.name as examinationName','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','city.name as cityname','course.name as courseName','degree.name as degreeName','functionalarea.name as functionalareaName', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','type_of_examinations.slug','exam_sections.slug as examinationSlug','exam_counselling_forms.created_at','state.name as stateName')
                ->findOrFail($id);

        return view('administrator.exam-counselling-form.show', compact('examcounsellingform'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamCounsellingForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $examcounsellingform = ExamCounsellingForm::findOrFail($id);
        $listOfExamObj = DB::table('type_of_examinations')->get();

        $cousesListObj  = DB::table('course')
                            ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                            ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                            ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                            ->orderBy('course.name','ASC')
                            ->get();

        $cityListObj = Cache::remember('cityListObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('city')
                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                        ->leftJoin('country', 'country.id', '=', 'state.country_id')
                        ->where('country.id','=', 99)
                        ->select('city.id', 'city.name','state.name as stateName')
                        ->orderBy('city.name','ASC')
                        ->get();
        });

        return view('administrator.exam-counselling-form.edit', compact('examcounsellingform','listOfExamObj','cousesListObj','cityListObj'));
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
        $create                                 = ExamCounsellingForm::findOrFail($id);
        $create->name                           = Input::get('name');
        $create->email                          = Input::get('email');
        $create->phone                          = Input::get('phone');
        $create->misc                           = Input::get('misc');
        $create->city_id                        = Input::get('city_id');
        $create->course_id                      = Input::get('course_id');
        $create->exam_id                        = Input::get('exam_id');
        $create->isResponse                     = 1;
        $create->isResponseMethod               = 1;
        //$create->users_id                       = Auth::id();
        $create->employee_id                    = Auth::id();
        $create->save();


        Session::flash('flash_message', 'ExamCounsellingForm updated!');

        return redirect($this->fetchDataServiceController->routeCall().'/exam-counselling-form');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamCounsellingForm');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        ExamCounsellingForm::destroy($id);

        Session::flash('flash_message', 'ExamCounsellingForm deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/exam-counselling-form');
    }
}
