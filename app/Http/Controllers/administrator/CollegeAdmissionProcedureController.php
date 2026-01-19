<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeAdmissionProcedure;
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
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\EducationLevel as EducationLevel;
use App\Models\Degree as Degree;
use App\Models\CourseType as CourseType;
use App\Models\Course as Course;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;
use App\Models\CollegeAdmissionImportantDated;

class CollegeAdmissionProcedureController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeAdmissionProcedure');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CollegeAdmissionProcedure::orderBy('college_admission_procedures.id', 'DESC')
                ->leftJoin('users as eID','college_admission_procedures.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_admission_procedures.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftJoin('educationlevel','college_admission_procedures.educationlevel_id','=','educationlevel.id')
                ->leftJoin('functionalarea','college_admission_procedures.functionalarea_id','=','functionalarea.id')
                ->leftJoin('degree','college_admission_procedures.degree_id','=','degree.id')
                ->leftJoin('coursetype','college_admission_procedures.coursetype_id','=','coursetype.id')
                ->leftJoin('course','college_admission_procedures.course_id','=','course.id');

        if (!empty($keyword)) {
            $query->orWhere('college_admission_procedures.title', 'LIKE', "%$keyword%");
            $query->orWhere('college_admission_procedures.description', 'LIKE', "%$keyword%");
        }

        if (!empty($request->get('collegeprofile_id'))) {
            $query->where('college_admission_procedures.collegeprofile_id', '=', Input::get('collegeprofile_id'));
        }

        if (!empty($request->get('educationlevel_id'))) {
            $query->where('college_admission_procedures.educationlevel_id', '=', Input::get('educationlevel_id'));
        }

        if (!empty($request->get('functionalarea_id'))) {
            $query->where('college_admission_procedures.functionalarea_id', '=', Input::get('functionalarea_id'));
        }

        if (!empty($request->get('degree_id'))) {
            $query->where('college_admission_procedures.degree_id', '=', Input::get('degree_id'));
        }

        if (!empty($request->get('course_id'))) {
            $query->where('college_admission_procedures.course_id', '=', Input::get('course_id'));
        }

        if (!empty($request->get('coursetype_id'))) {
            $query->where('college_admission_procedures.coursetype_id', '=', Input::get('coursetype_id'));
        }

        $collegeadmissionprocedure = $query->paginate(20, array('college_admission_procedures.id','college_admission_procedures.title','college_admission_procedures.description','college_admission_procedures.users_id', 'college_admission_procedures.collegeprofile_id','college_admission_procedures.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_admission_procedures.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName'));


        $collegeProfileObj = DB::table('college_admission_procedures')
                                ->leftJoin('collegeprofile', 'college_admission_procedures.collegeprofile_id', '=', 'collegeprofile.id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                ->groupBy('college_admission_procedures.collegeprofile_id')
                                ->get();

        $educationLevelObj = EducationLevel::all();
        $functionalAreaObj = FunctionalArea::all();
        $courseTypeObj     = CourseType::all();

        $degreeObj = DB::table('college_admission_procedures')
                        ->leftJoin('degree', 'college_admission_procedures.degree_id', '=', 'degree.id')
                        ->select('degree.id','degree.name')
                        ->groupBy('college_admission_procedures.degree_id')
                        ->orderBy('degree.name', 'ASC')
                        ->get();

        $courseObj  = DB::table('college_admission_procedures')
                        ->leftJoin('course', 'college_admission_procedures.course_id', '=', 'course.id')
                        ->select('course.id','course.name')
                        ->groupBy('college_admission_procedures.course_id')
                        ->orderBy('course.name', 'ASC')
                        ->get();

        return view('administrator.college-admission-procedure.index', compact('collegeadmissionprocedure','collegeProfileObj','educationLevelObj','functionalAreaObj','courseTypeObj','courseObj','degreeObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeAdmissionProcedure');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        $educationLevelObj = EducationLevel::all();
        $functionalAreaObj = FunctionalArea::all();
        $courseTypeObj     = CourseType::all();
        return view('administrator.college-admission-procedure.create', compact('collegeProfileObj','educationLevelObj','functionalAreaObj','courseTypeObj'));
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
        $collegeAdmissionProcedureObj = new CollegeAdmissionProcedure;
        $collegeAdmissionProcedureObj->title = Input::get('title');
        $collegeAdmissionProcedureObj->description = Input::get('description');
        $collegeAdmissionProcedureObj->educationlevel_id = Input::get('educationlevel_id');
        $collegeAdmissionProcedureObj->functionalarea_id = Input::get('functionalarea_id');
        $collegeAdmissionProcedureObj->degree_id = Input::get('degree_id');
        $collegeAdmissionProcedureObj->coursetype_id = Input::get('coursetype_id');
        $collegeAdmissionProcedureObj->course_id = Input::get('course_id');
        $collegeAdmissionProcedureObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeAdmissionProcedureObj->users_id = $collegeObj->users_id;
        $collegeAdmissionProcedureObj->employee_id = Auth::id();
        $collegeAdmissionProcedureObj->save();


        if (!empty(Input::get('eventName'))) {
            $sizeOfImpDatesList = sizeof(Input::get('eventName'));
            for($eventCount = 0; $eventCount < $sizeOfImpDatesList; $eventCount++){
                $createImportantDates                               = New CollegeAdmissionImportantDated;
                $createImportantDates->eventName                    = Input::get('eventName')[$eventCount];
                $createImportantDates->fromdate                     = Input::get('fromdate')[$eventCount];
                $createImportantDates->todate                       = Input::get('todate')[$eventCount];
                $createImportantDates->collegeAdmissionProcedure_id = $collegeAdmissionProcedureObj->id;
                $createImportantDates->collegeprofile_id            = Input::get('collegeprofile_id');
                $createImportantDates->users_id                     = $collegeObj->users_id;
                $createImportantDates->employee_id                  = Auth::id();
                $createImportantDates->save();
            }
        }

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Admission Procedure added!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-admission-procedure');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeAdmissionProcedure');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegeadmissionprocedure = CollegeAdmissionProcedure::orderBy('college_admission_procedures.id', 'DESC')
                ->leftJoin('users as eID','college_admission_procedures.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_admission_procedures.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftjoin('educationlevel', 'college_admission_procedures.educationlevel_id', '=', 'educationlevel.id')
                ->leftjoin('functionalarea', 'college_admission_procedures.functionalarea_id', '=', 'functionalarea.id')
                ->leftjoin('degree', 'college_admission_procedures.degree_id', '=', 'degree.id')
                ->leftjoin('coursetype', 'college_admission_procedures.coursetype_id', '=', 'coursetype.id')
                ->leftjoin('course', 'college_admission_procedures.course_id', '=', 'course.id')
                ->select('college_admission_procedures.id','college_admission_procedures.title','college_admission_procedures.description','college_admission_procedures.users_id', 'college_admission_procedures.collegeprofile_id','college_admission_procedures.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_admission_procedures.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName')
                ->findOrFail($id);
        
        $importantDatesObj = DB::table('college_admission_important_dateds')
                            ->where('college_admission_important_dateds.collegeAdmissionProcedure_id','=', $collegeadmissionprocedure->id)
                            ->where('college_admission_important_dateds.users_id','=', $collegeadmissionprocedure->users_id)
                            ->where('college_admission_important_dateds.collegeprofile_id','=', $collegeadmissionprocedure->collegeprofile_id)
                            ->orderBy('college_admission_important_dateds.id', 'ASC')
                            ->get();


        return view('administrator.college-admission-procedure.show', compact('collegeadmissionprocedure','importantDatesObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeAdmissionProcedure');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegeadmissionprocedure = CollegeAdmissionProcedure::findOrFail($id);
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        $educationLevelObj = EducationLevel::all();
        $functionalAreaObj = FunctionalArea::all();
        $courseTypeObj     = CourseType::all();

        $courseObj = DB::table('course')
                        ->where('course.degree_id','=', $collegeadmissionprocedure->degree_id)
                        ->orderBy('course.name', 'ASC')
                        ->get();

        $degreeObj  = DB::table('degree')
                        ->where('degree.functionalarea_id','=', $collegeadmissionprocedure->functionalarea_id)
                        ->orderBy('degree.name', 'ASC')
                        ->get();

        $importantDatesObj = DB::table('college_admission_important_dateds')
                            ->where('college_admission_important_dateds.collegeAdmissionProcedure_id','=', $collegeadmissionprocedure->id)
                            ->where('college_admission_important_dateds.users_id','=', $collegeadmissionprocedure->users_id)
                            ->where('college_admission_important_dateds.collegeprofile_id','=', $collegeadmissionprocedure->collegeprofile_id)
                            ->orderBy('college_admission_important_dateds.id', 'ASC')
                            ->get();

        return view('administrator.college-admission-procedure.edit', compact('collegeadmissionprocedure','collegeProfileObj','educationLevelObj','functionalAreaObj','courseTypeObj','courseObj','degreeObj','importantDatesObj'));
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
        $collegeAdmissionProcedureObj = CollegeAdmissionProcedure::findOrFail($id);
        $collegeAdmissionProcedureObj->title = Input::get('title');
        $collegeAdmissionProcedureObj->description = Input::get('description');
        $collegeAdmissionProcedureObj->educationlevel_id = Input::get('educationlevel_id');
        $collegeAdmissionProcedureObj->functionalarea_id = Input::get('functionalarea_id');
        $collegeAdmissionProcedureObj->degree_id = Input::get('degree_id');
        $collegeAdmissionProcedureObj->coursetype_id = Input::get('coursetype_id');
        $collegeAdmissionProcedureObj->course_id = Input::get('course_id');
        $collegeAdmissionProcedureObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeAdmissionProcedureObj->users_id = $collegeObj->users_id;
        $collegeAdmissionProcedureObj->employee_id = Auth::id();
        $collegeAdmissionProcedureObj->save();

        if (!empty(Input::get('eventName'))) {
            Db::table('college_admission_important_dateds')
                ->where('college_admission_important_dateds.collegeAdmissionProcedure_id','=', $id)
                ->where('college_admission_important_dateds.users_id', '=', $collegeObj->users_id)
                ->where('college_admission_important_dateds.collegeprofile_id', '=', $collegeObj->id)
                ->delete();

            $sizeOfImpDatesList = sizeof(Input::get('eventName'));
            for($eventCount = 0; $eventCount < $sizeOfImpDatesList; $eventCount++){
                $createImportantDates                               = New CollegeAdmissionImportantDated;
                $createImportantDates->eventName                    = Input::get('eventName')[$eventCount];
                $createImportantDates->fromdate                     = Input::get('fromdate')[$eventCount];
                $createImportantDates->todate                       = Input::get('todate')[$eventCount];
                $createImportantDates->collegeAdmissionProcedure_id = $collegeAdmissionProcedureObj->id;
                $createImportantDates->collegeprofile_id            = Input::get('collegeprofile_id');
                $createImportantDates->users_id                     = $collegeObj->users_id;
                $createImportantDates->employee_id                  = Auth::id();
                $createImportantDates->save();
            }
        }

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'CollegeAdmissionProcedure updated!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-admission-procedure');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeAdmissionProcedure');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        CollegeAdmissionProcedure::destroy($id);

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'CollegeAdmissionProcedure deleted!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-admission-procedure');
    }
}
