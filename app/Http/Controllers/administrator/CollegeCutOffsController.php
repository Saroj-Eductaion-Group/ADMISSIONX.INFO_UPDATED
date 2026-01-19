<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeCutOff;
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

class CollegeCutOffsController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeCutOff');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CollegeCutOff::orderBy('college_cut_offs.id', 'DESC')
                ->leftJoin('users as eID','college_cut_offs.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_cut_offs.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftjoin('educationlevel', 'college_cut_offs.educationlevel_id', '=', 'educationlevel.id')
                ->leftjoin('functionalarea', 'college_cut_offs.functionalarea_id', '=', 'functionalarea.id')
                ->leftjoin('degree', 'college_cut_offs.degree_id', '=', 'degree.id')
                ->leftjoin('coursetype', 'college_cut_offs.coursetype_id', '=', 'coursetype.id')
                ->leftjoin('course', 'college_cut_offs.course_id', '=', 'course.id');

        if (!empty($keyword)) {
            $query->orWhere('college_cut_offs.title', 'LIKE', "%$keyword%");
            $query->orWhere('college_cut_offs.description', 'LIKE', "%$keyword%");
        }

        if (!empty($request->get('collegeprofile_id'))) {
            $query->where('college_cut_offs.collegeprofile_id', '=', Input::get('collegeprofile_id'));
        }

        if (!empty($request->get('educationlevel_id'))) {
            $query->where('college_cut_offs.educationlevel_id', '=', Input::get('educationlevel_id'));
        }

        if (!empty($request->get('functionalarea_id'))) {
            $query->where('college_cut_offs.functionalarea_id', '=', Input::get('functionalarea_id'));
        }

        if (!empty($request->get('degree_id'))) {
            $query->where('college_cut_offs.degree_id', '=', Input::get('degree_id'));
        }

        if (!empty($request->get('course_id'))) {
            $query->where('college_cut_offs.course_id', '=', Input::get('course_id'));
        }

        if (!empty($request->get('coursetype_id'))) {
            $query->where('college_cut_offs.coursetype_id', '=', Input::get('coursetype_id'));
        }

        $collegecutoffs = $query->paginate(20, array('college_cut_offs.id','college_cut_offs.title','college_cut_offs.description','college_cut_offs.users_id', 'college_cut_offs.collegeprofile_id','college_cut_offs.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_cut_offs.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName'));


        $collegeProfileObj = DB::table('college_cut_offs')
                                ->leftJoin('collegeprofile', 'college_cut_offs.collegeprofile_id', '=', 'collegeprofile.id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                ->groupBy('college_cut_offs.collegeprofile_id')
                                ->get();

        $educationLevelObj = EducationLevel::all();
        $functionalAreaObj = FunctionalArea::all();
        $courseTypeObj     = CourseType::all();

        $degreeObj = DB::table('college_cut_offs')
                        ->leftJoin('degree', 'college_cut_offs.degree_id', '=', 'degree.id')
                        ->select('degree.id','degree.name')
                        ->groupBy('college_cut_offs.degree_id')
                        ->orderBy('degree.name', 'ASC')
                        ->get();

        $courseObj  = DB::table('college_cut_offs')
                        ->leftJoin('course', 'college_cut_offs.course_id', '=', 'course.id')
                        ->select('course.id','course.name')
                        ->groupBy('college_cut_offs.course_id')
                        ->orderBy('course.name', 'ASC')
                        ->get();

        return view('administrator.college-cut-offs.index', compact('collegecutoffs','collegeProfileObj','educationLevelObj','functionalAreaObj','courseTypeObj','courseObj','degreeObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeCutOff');
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

        return view('administrator.college-cut-offs.create', compact('collegeProfileObj','educationLevelObj','functionalAreaObj','courseTypeObj'));
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
        $collegeCutOffObj = new CollegeCutOff;
        $collegeCutOffObj->title = Input::get('title');
        $collegeCutOffObj->description = Input::get('description');
        $collegeCutOffObj->educationlevel_id = Input::get('educationlevel_id');
        $collegeCutOffObj->functionalarea_id = Input::get('functionalarea_id');
        $collegeCutOffObj->degree_id = Input::get('degree_id');
        $collegeCutOffObj->coursetype_id = Input::get('coursetype_id');
        $collegeCutOffObj->course_id = Input::get('course_id');
        $collegeCutOffObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeCutOffObj->users_id = $collegeObj->users_id;
        $collegeCutOffObj->employee_id = Auth::id();
        $collegeCutOffObj->save();

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Cut Off added!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-cut-offs');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeCutOff');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegecutoff = CollegeCutOff::orderBy('college_cut_offs.id', 'DESC')
                ->leftJoin('users as eID','college_cut_offs.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_cut_offs.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftjoin('educationlevel', 'college_cut_offs.educationlevel_id', '=', 'educationlevel.id')
                ->leftjoin('functionalarea', 'college_cut_offs.functionalarea_id', '=', 'functionalarea.id')
                ->leftjoin('degree', 'college_cut_offs.degree_id', '=', 'degree.id')
                ->leftjoin('coursetype', 'college_cut_offs.coursetype_id', '=', 'coursetype.id')
                ->leftjoin('course', 'college_cut_offs.course_id', '=', 'course.id')
                ->select('college_cut_offs.id','college_cut_offs.title','college_cut_offs.description','college_cut_offs.users_id', 'college_cut_offs.collegeprofile_id','college_cut_offs.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_cut_offs.updated_at', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName')
                ->findOrFail($id);

        return view('administrator.college-cut-offs.show', compact('collegecutoff'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeCutOff');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegecutoff = CollegeCutOff::findOrFail($id);
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        $educationLevelObj = EducationLevel::all();
        $functionalAreaObj = FunctionalArea::all();
        $courseTypeObj     = CourseType::all();

        $courseObj = DB::table('course')
                        ->where('course.degree_id','=', $collegecutoff->degree_id)
                        ->orderBy('course.name', 'ASC')
                        ->get();

        $degreeObj  = DB::table('degree')
                        ->where('degree.functionalarea_id','=', $collegecutoff->functionalarea_id)
                        ->orderBy('degree.name', 'ASC')
                        ->get();

        return view('administrator.college-cut-offs.edit', compact('collegecutoff','collegeProfileObj','educationLevelObj','functionalAreaObj','courseTypeObj','courseObj','degreeObj'));
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
        $collegeCutOffObj = CollegeCutOff::findOrFail($id);
        $collegeCutOffObj->title = Input::get('title');
        $collegeCutOffObj->description = Input::get('description');
        $collegeCutOffObj->educationlevel_id = Input::get('educationlevel_id');
        $collegeCutOffObj->functionalarea_id = Input::get('functionalarea_id');
        $collegeCutOffObj->degree_id = Input::get('degree_id');
        $collegeCutOffObj->coursetype_id = Input::get('coursetype_id');
        $collegeCutOffObj->course_id = Input::get('course_id');
        $collegeCutOffObj->collegeprofile_id = Input::get('collegeprofile_id');
        $collegeCutOffObj->users_id = $collegeObj->users_id;
        $collegeCutOffObj->employee_id = Auth::id();
        $collegeCutOffObj->save();

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Cut Off updated!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-cut-offs');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeCutOff');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        CollegeCutOff::destroy($id);

        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'College Cut Off deleted!');

        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-cut-offs');
    }
}
