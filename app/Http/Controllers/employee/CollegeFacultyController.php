<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Faculty as faculty;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Config;
use Mail;
use DateTime;
use Log;
use File;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\CollegeMaster as CollegeMaster;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\EducationLevel as EducationLevel;
use App\Models\Degree as Degree;
use App\Models\CourseType as CourseType;
use App\Models\Course as Course;
use App\Models\FacultyExperience;
use App\Models\FacultyQualification;
use App\Models\FacultyDepartment;
use App\Models\CollegeMasterAssociateFaculty;
use App\Http\Controllers\Helper\FetchDataServiceController;
use App\Models\Country as Country;
use App\Models\State as State;
use App\Models\CollegeType as CollegeType;
use App\Models\University;
use App\Models\City as City;

class CollegeFacultyController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Faculty')
                                    ->where('userprivileges.index', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Faculty')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                    $collegeProfileObj = DB::table('faculty')
                                        ->leftJoin('collegeprofile', 'collegeprofile.id', '=', 'faculty.collegeprofile_id')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->select('collegeprofile.id as collegeprofileID', 'users.id','users.firstname')
                                        ->where('users.userrole_id', '=', '2')
                                        ->groupBy('faculty.collegeprofile_id')
                                        ->get()
                                        ;

                    $query = Faculty::orderBy('faculty.id', 'DESC')
                            ->leftJoin('users as eID','faculty.employee_id', '=','eID.id')
                            ->leftJoin('collegeprofile', 'faculty.collegeprofile_id', '=', 'collegeprofile.id')
                            ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                            ->leftJoin('city', 'faculty.city_id', '=', 'city.id')
                            ->leftJoin('state', 'faculty.state_id', '=', 'state.id')
                            ->leftJoin('country', 'faculty.country_id', '=', 'country.id')
                            ->where('faculty.name', '<>', '');

                    if (!empty(Input::get('name'))) {
                        $query->where('faculty.name', 'LIKE', '%'.Input::get('name').'%');
                    }

                    if (!empty(Input::get('email'))) {
                        $query->where('faculty.email', 'LIKE', '%'.Input::get('email').'%');
                    }

                    if (!empty(Input::get('phone'))) {
                        $query->where('faculty.phone', 'LIKE', '%'.Input::get('phone').'%');
                    }


                    if (!empty($keyword)) {
                        $query->where('faculty.description', 'LIKE', "%$keyword%");
                        $query->orWhere('faculty.designation', 'LIKE', "%$keyword%");
                        $query->orWhere('faculty.addressline1', 'LIKE', "%$keyword%");
                        $query->orWhere('faculty.addressline2', 'LIKE', "%$keyword%");
                        $query->orWhere('faculty.landmark', 'LIKE', "%$keyword%");
                        $query->orWhere('faculty.pincode', 'LIKE', "%$keyword%");
                        $query->orWhere('faculty.languageKnown', 'LIKE', "%$keyword%");
                        $query->orWhere('city.name', 'LIKE', "%$keyword%");
                        $query->orWhere('state.name', 'LIKE', "%$keyword%");
                        $query->orWhere('country.name', 'LIKE', "%$keyword%");
                    }

                    if ($request->has('collegeprofile_id') && !empty($request->get('collegeprofile_id'))) {
                        $query->where('faculty.collegeprofile_id', '=', Input::get('collegeprofile_id'));
                    }

                    $faculty = $query->paginate(20, array('faculty.id','faculty.suffix','faculty.name', 'faculty.email', 'faculty.phone', 'faculty.description','faculty.imagename','faculty.image_original','faculty.designation','faculty.dob','faculty.gender','faculty.addressline1','faculty.addressline2','faculty.landmark','faculty.pincode','faculty.languageKnown','faculty.collegeprofile_id','collegeprofile.users_id','city.name as cityName','state.name as stateName','country.name as countryName','faculty.updated_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug'));

                    foreach ($faculty as $key => $value) {
                        $value->qualificationsObj = DB::table('faculty_qualifications')
                                            ->where('faculty_qualifications.faculty_id','=', $value->id)
                                            ->where('faculty_qualifications.users_id','=', $value->users_id)
                                            ->where('faculty_qualifications.collegeprofile_id','=', $value->collegeprofile_id)
                                            ->orderBy('faculty_qualifications.id', 'ASC')
                                            ->get();

                        $value->experienceObj = DB::table('faculty_experiences')
                                            ->where('faculty_experiences.faculty_id','=', $value->id)
                                            ->where('faculty_experiences.users_id','=', $value->users_id)
                                            ->where('faculty_experiences.collegeprofile_id','=', $value->collegeprofile_id)
                                            ->orderBy('faculty_experiences.id', 'ASC')
                                            ->get();

                        $value->facultyDepartmentObj = DB::table('faculty_departments')
                                            ->leftJoin('educationlevel','faculty_departments.educationlevel_id','=','educationlevel.id')
                                            ->leftJoin('functionalarea','faculty_departments.functionalarea_id','=','functionalarea.id')
                                            ->leftJoin('degree','faculty_departments.degree_id','=','degree.id')
                                            ->leftJoin('coursetype','faculty_departments.coursetype_id','=','coursetype.id')
                                            ->leftJoin('course','faculty_departments.course_id','=','course.id')
                                            ->where('faculty_departments.users_id','=', $value->users_id)
                                            ->where('faculty_departments.faculty_id','=', $value->id)
                                            ->where('faculty_departments.collegeprofile_id','=', $value->collegeprofile_id)
                                            ->select('educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName')
                                            ->orderBy('faculty_departments.id', 'ASC')
                                            ->get();

                    }
                    return view('administrator/college-faculty.index', compact('faculty'))
                            ->with('storeEditUpdateAction', $storeEditUpdateAction)
                            ->with('collegeProfileObj',$collegeProfileObj)
                            ;
                }else{
                    Session::flash('access_restricted_msg', 'Access Restricted!');
                    return Redirect::action('employee\AdminEmployeeController@index');
                }
                    
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Faculty')
                                    ->where('userprivileges.create', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $getFacultyObj  = (object)[
                                    'suffix'        => '',
                                    'name'          => '',
                                    'description'   => '',
                                    'email'         => '',
                                    'phone'         => '',
                                    'dob'           => '',
                                    'gender'        => '',
                                    'designation'   =>  '',
                                    'languageKnown' =>  '',
                                    'addressline1'  =>  '',
                                    'addressline2'  =>  '',
                                    'landmark'      =>  '',
                                    'pincode'       =>  '',
                                    'country_id'    =>  '',
                                    'state_id'      =>  '',
                                    'city_id'       =>  '',
                                    'collegeprofile_id' => '',
                                ];

                    $getCountryObj  =Country::all();
                    $allCourseObj = [];
                    $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
                    return view('administrator/college-faculty.create',compact('getFacultyObj','getCountryObj','allCourseObj'))
                            ->with('collegeProfileObj', $collegeProfileObj);
                }else{
                    Session::flash('access_restricted_msg', 'Access Restricted!');
                    return Redirect::action('employee\AdminEmployeeController@index');
                }
                    
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                   $collegeProfileObj = CollegeProfile::where('id','=',Input::get('collegeprofile_id'))->first();
                $create                                 = New Faculty; 
                $create->suffix                         = Input::get('suffix');
                $create->name                           = Input::get('name');
                $create->description                    = Input::get('description');
                $create->collegeprofile_id              = $collegeProfileObj->id;
                $create->email                          = Input::get('email');
                $create->phone                          = Input::get('phone');
                $create->dob                            = Input::get('dob');
                $create->languageKnown                  = Input::get('languageKnown');
                $create->designation                    = Input::get('designation');
                $create->gender                         = Input::get('gender');
                $create->addressline1                   = Input::get('addressline1');
                $create->addressline2                   = Input::get('addressline2');
                $create->landmark                       = Input::get('landmark');
                $create->pincode                        = Input::get('pincode');
                $create->country_id                     = Input::get('country_id');
                $create->state_id                       = Input::get('state_id');
                $create->city_id                        = Input::get('city_id');
                $imageObj                               = app('App\Http\Controllers\college\CollegeController')->uploadFacultyMemeberProfile($request, $collegeProfileObj->slug);
                if(sizeof($imageObj) > 0):
                    $create->imagename                  = $imageObj['small_img'];
                    $create->image_original             = $imageObj['big_img'];
                endif;
                $create->save();

                if (!empty(Input::get('qualification'))) {
                    $sizeOfQualificationsList = sizeof(Input::get('qualification'));
                    for($qualfication = 0; $qualfication < $sizeOfQualificationsList; $qualfication++){
                        $createQualificationsList                       = New FacultyQualification;
                        $createQualificationsList->qualification        = Input::get('qualification')[$qualfication];
                        $createQualificationsList->course               = Input::get('course')[$qualfication];
                        $createQualificationsList->subjects             = Input::get('subjects')[$qualfication];
                        $createQualificationsList->year                 = Input::get('year')[$qualfication];
                        $createQualificationsList->collegename          = Input::get('collegename')[$qualfication];
                        $createQualificationsList->boardName            = Input::get('boardName')[$qualfication];
                        $createQualificationsList->faculty_id           = $create->id;
                        $createQualificationsList->collegeprofile_id    = $collegeProfileObj->id;
                        $createQualificationsList->users_id             = $userId;
                        $createQualificationsList->employee_id          = $userId;
                        $createQualificationsList->save();
                    }
                }

                if (!empty(Input::get('organisation'))) {
                    $sizeOfExperiencesList = sizeof(Input::get('organisation'));
                    for($experiences = 0; $experiences < $sizeOfExperiencesList; $experiences++){
                        $createExperiencesList                          = New FacultyExperience;
                        $createExperiencesList->organisation            = Input::get('organisation')[$experiences];
                        $createExperiencesList->role                    = Input::get('role')[$experiences];
                        $createExperiencesList->fromyear                = Input::get('fromyear')[$experiences];
                        $createExperiencesList->toyear                  = Input::get('toyear')[$experiences];
                        $createExperiencesList->city                    = Input::get('city')[$experiences];
                        $createExperiencesList->faculty_id              = $create->id;
                        $createExperiencesList->collegeprofile_id       = $collegeProfileObj->id;
                        $createExperiencesList->users_id                = $collegeProfileObj->users_id;
                        $createExperiencesList->employee_id             = $userId;
                        $createExperiencesList->save();
                    }
                }

                if (!empty(Input::get('collegemaster_id'))) {
                    $sizeOfDepartmentList = sizeof(Input::get('collegemaster_id'));
                    for($department = 0; $department < $sizeOfDepartmentList; $department++){
                        if (!empty(Input::get('collegemaster_id')[$department])) {
                            $getCollegeMasterDataObj = DB::table('collegemaster')
                                                        ->where('collegemaster.id','=', Input::get('collegemaster_id')[$department])
                                                        ->select('collegemaster.educationlevel_id','collegemaster.functionalarea_id','collegemaster.degree_id','collegemaster.coursetype_id','collegemaster.course_id')
                                                        ->orderBy('collegemaster.id' ,'DESC')
                                                        ->first();

                            $createFacultyDepartment                          = New FacultyDepartment;
                            $createFacultyDepartment->collegemaster_id       = Input::get('collegemaster_id')[$department];
                            $createFacultyDepartment->course_id               = $getCollegeMasterDataObj->course_id;
                            $createFacultyDepartment->educationlevel_id       = $getCollegeMasterDataObj->educationlevel_id;
                            $createFacultyDepartment->coursetype_id           = $getCollegeMasterDataObj->coursetype_id;
                            $createFacultyDepartment->functionalarea_id       = $getCollegeMasterDataObj->functionalarea_id;
                            $createFacultyDepartment->degree_id               = $getCollegeMasterDataObj->degree_id;
                            $createFacultyDepartment->faculty_id              = $create->id;
                            $createFacultyDepartment->collegeprofile_id       = $collegeProfileObj->id;
                            $createFacultyDepartment->users_id                = $collegeProfileObj->users_id;
                            $createFacultyDepartment->employee_id             = $userId;
                            $createFacultyDepartment->save();

                            $collegeMasterAssociate                          = New CollegeMasterAssociateFaculty;
                            $collegeMasterAssociate->faculty_id              = $create->id;
                            $collegeMasterAssociate->functionalarea_id       = $getCollegeMasterDataObj->functionalarea_id;
                            $collegeMasterAssociate->educationlevel_id       = $getCollegeMasterDataObj->educationlevel_id;
                            $collegeMasterAssociate->degree_id               = $getCollegeMasterDataObj->degree_id;
                            $collegeMasterAssociate->coursetype_id           = $getCollegeMasterDataObj->coursetype_id;
                            $collegeMasterAssociate->course_id               = $getCollegeMasterDataObj->course_id;
                            $collegeMasterAssociate->collegemaster_id        = Input::get('collegemaster_id')[$department];
                            $collegeMasterAssociate->collegeprofile_id       = $collegeProfileObj->id;
                            $collegeMasterAssociate->users_id                = $collegeProfileObj->users_id;
                            $collegeMasterAssociate->employee_id             = $userId;
                            $collegeMasterAssociate->save();
                        }
                    }
                }

                Session::flash('flash_message', 'faculty added!');
                return redirect::back();
                    //return redirect('employee/faculty');
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Faculty')
                                    ->where('userprivileges.show', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $faculty    =   Faculty::orderBy('faculty.id', 'DESC')
                                    ->leftJoin('users as eID','faculty.employee_id', '=','eID.id')
                                    ->leftJoin('collegeprofile', 'faculty.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                                    ->leftJoin('city', 'faculty.city_id', '=', 'city.id')
                                    ->leftJoin('state', 'faculty.state_id', '=', 'state.id')
                                    ->leftJoin('country', 'faculty.country_id', '=', 'country.id')
                                    ->select('faculty.id','faculty.suffix','faculty.name', 'faculty.email', 'faculty.phone', 'faculty.description','faculty.imagename','faculty.image_original','faculty.designation','faculty.dob','faculty.gender','faculty.addressline1','faculty.addressline2','faculty.landmark','faculty.pincode','faculty.languageKnown','faculty.collegeprofile_id','collegeprofile.users_id','city.name as cityName','state.name as stateName','country.name as countryName','faculty.updated_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug')
                                    ->findOrFail($id);

                   $qualificationsObj = DB::table('faculty_qualifications')
                                        ->where('faculty_qualifications.faculty_id','=', $faculty->id)
                                        ->where('faculty_qualifications.users_id','=', $faculty->users_id)
                                        ->where('faculty_qualifications.collegeprofile_id','=', $faculty->collegeprofile_id)
                                        ->orderBy('faculty_qualifications.id', 'ASC')
                                        ->get();

                    $experienceObj = DB::table('faculty_experiences')
                                        ->where('faculty_experiences.faculty_id','=', $faculty->id)
                                        ->where('faculty_experiences.users_id','=', $faculty->users_id)
                                        ->where('faculty_experiences.collegeprofile_id','=', $faculty->collegeprofile_id)
                                        ->orderBy('faculty_experiences.id', 'ASC')
                                        ->get();

                    $facultyDepartmentObj = DB::table('faculty_departments')
                                        ->leftJoin('educationlevel','faculty_departments.educationlevel_id','=','educationlevel.id')
                                        ->leftJoin('functionalarea','faculty_departments.functionalarea_id','=','functionalarea.id')
                                        ->leftJoin('degree','faculty_departments.degree_id','=','degree.id')
                                        ->leftJoin('coursetype','faculty_departments.coursetype_id','=','coursetype.id')
                                        ->leftJoin('course','faculty_departments.course_id','=','course.id')
                                        ->where('faculty_departments.users_id','=', $faculty->users_id)
                                        ->where('faculty_departments.faculty_id','=', $faculty->id)
                                        ->where('faculty_departments.collegeprofile_id','=', $faculty->collegeprofile_id)
                                        ->select('educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName','collegemaster_id')
                                        ->orderBy('faculty_departments.id', 'ASC')
                                        ->get();

                    return view('administrator/college-faculty.show', compact('faculty','qualificationsObj','experienceObj','facultyDepartmentObj'));
                }else{
                    Session::flash('access_restricted_msg', 'Access Restricted!');
                    return Redirect::action('employee\AdminEmployeeController@index');
                }
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Faculty')
                                    ->where('userprivileges.edit', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $getFacultyObj = Faculty::findOrFail($id);
                    $getCountryObj  =Country::all();
                    $getStateObj    = DB::table('state')->where('country_id', '=', $getFacultyObj->country_id)->select('id', 'name')->get();
                    $getCityObj     = DB::table('city')->where('state_id', '=', $getFacultyObj->state_id)->select('id', 'name')->get();

                    $collegeProfile = CollegeProfile::where('id','=',$getFacultyObj->collegeprofile_id)->first();

                    $qualificationsObj = DB::table('faculty_qualifications')
                                    ->where('faculty_qualifications.faculty_id','=', $getFacultyObj->id)
                                    ->where('faculty_qualifications.users_id','=', $collegeProfile->users_id)
                                    ->where('faculty_qualifications.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                    ->orderBy('faculty_qualifications.id', 'ASC')
                                    ->get();

                    $experienceObj = DB::table('faculty_experiences')
                                        ->where('faculty_experiences.faculty_id','=', $getFacultyObj->id)
                                        ->where('faculty_experiences.users_id','=', $collegeProfile->users_id)
                                        ->where('faculty_experiences.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                        ->orderBy('faculty_experiences.id', 'ASC')
                                        ->get();

                    $getCountryObj  =Country::all();
                    $facultyDepartmentObj = DB::table('faculty_departments')
                                        ->where('faculty_departments.users_id','=', $collegeProfile->users_id)
                                        ->where('faculty_departments.faculty_id','=', $getFacultyObj->id)
                                        ->where('faculty_departments.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                        ->orderBy('faculty_departments.id', 'ASC')
                                        ->get();

                    $allCourseObj = $this->fetchDataServiceController->fetchCollegeCourses($collegeProfile->slug);
                    $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);

                    return view('administrator/college-faculty.edit', compact('allCourseObj','collegeProfileObj'))
                                ->with('getFacultyObj', $getFacultyObj)
                                ->with('getCountryObj', $getCountryObj)
                                ->with('getStateObj', $getStateObj)
                                ->with('getCityObj', $getCityObj)
                                ->with('qualificationsObj', $qualificationsObj)
                                ->with('experienceObj', $experienceObj)
                                ->with('facultyDepartmentObj', $facultyDepartmentObj)
                                ->with('slug', $collegeProfile->slug);
                }else{
                    Session::flash('access_restricted_msg', 'Access Restricted!');
                    return Redirect::action('employee\AdminEmployeeController@index');
                }
                
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                    $collegeProfileObj = CollegeProfile::where('id','=',Input::get('collegeprofile_id'))->first();

                $update                                 = Faculty::findOrFail($id); 
                $update->suffix                         = Input::get('suffix');
                $update->name                           = Input::get('name');
                $update->description                    = Input::get('description');
                $update->email                          = Input::get('email');
                $update->phone                          = Input::get('phone');
                $update->dob                            = Input::get('dob');
                $update->designation                    = Input::get('designation');
                $update->languageKnown                  = Input::get('languageKnown');
                $update->gender                         = Input::get('gender');
                $update->addressline1                   = Input::get('addressline1');
                $update->addressline2                   = Input::get('addressline2');
                $update->landmark                       = Input::get('landmark');
                $update->pincode                        = Input::get('pincode');
                $update->country_id                     = Input::get('country_id');
                $update->state_id                       = Input::get('state_id');
                $update->city_id                        = Input::get('city_id');
                $imageObj                               = app('App\Http\Controllers\college\CollegeController')->uploadFacultyMemeberProfile($request, $collegeProfileObj->slug);
                if(sizeof($imageObj) > 0):
                    $update->imagename                  = $imageObj['small_img'];
                    $update->image_original             = $imageObj['big_img'];
                endif;
                $update->save();

                if (!empty(Input::get('qualification'))) {
                    Db::table('faculty_qualifications')
                    ->where('faculty_qualifications.faculty_id','=', $id)
                    ->where('faculty_qualifications.users_id', '=', $collegeProfileObj->users_id)
                    ->where('faculty_qualifications.collegeprofile_id', '=', $collegeProfileObj->id)
                    ->delete();

                    $sizeOfQualificationsList = sizeof(Input::get('qualification'));
                    for($qualfication = 0; $qualfication < $sizeOfQualificationsList; $qualfication++){
                        $createQualificationsList                       = New FacultyQualification;
                        $createQualificationsList->qualification        = Input::get('qualification')[$qualfication];
                        $createQualificationsList->course               = Input::get('course')[$qualfication];
                        $createQualificationsList->subjects             = Input::get('subjects')[$qualfication];
                        $createQualificationsList->year                 = Input::get('year')[$qualfication];
                        $createQualificationsList->collegename          = Input::get('collegename')[$qualfication];
                        $createQualificationsList->boardName            = Input::get('boardName')[$qualfication];
                        $createQualificationsList->faculty_id           = $update->id;
                        $createQualificationsList->collegeprofile_id    = $collegeProfileObj->id;
                        $createQualificationsList->users_id             = $collegeProfileObj->users_id;
                        $createQualificationsList->employee_id          = $userId;
                        $createQualificationsList->save();
                    }
                }

                if (!empty(Input::get('organisation'))) {
                    Db::table('faculty_experiences')
                    ->where('faculty_experiences.faculty_id','=', $id)
                    ->where('faculty_experiences.users_id', '=', $collegeProfileObj->users_id)
                    ->where('faculty_experiences.collegeprofile_id', '=', $collegeProfileObj->id)
                    ->delete();

                    $sizeOfExperiencesList = sizeof(Input::get('organisation'));
                    for($experiences = 0; $experiences < $sizeOfExperiencesList; $experiences++){
                        $createExperiencesList                          = New FacultyExperience;
                        $createExperiencesList->organisation            = Input::get('organisation')[$experiences];
                        $createExperiencesList->role                    = Input::get('role')[$experiences];
                        $createExperiencesList->fromyear                = Input::get('fromyear')[$experiences];
                        $createExperiencesList->toyear                  = Input::get('toyear')[$experiences];
                        $createExperiencesList->city                    = Input::get('city')[$experiences];
                        $createExperiencesList->faculty_id              = $update->id;
                        $createExperiencesList->collegeprofile_id       = $collegeProfileObj->id;
                        $createExperiencesList->users_id                = $collegeProfileObj->users_id;
                        $createExperiencesList->employee_id             = $userId;
                        $createExperiencesList->save();
                    }
                }

                if (!empty(Input::get('collegemaster_id'))) {
                    Db::table('faculty_departments')
                        ->where('faculty_departments.faculty_id','=', $id)
                        ->where('faculty_departments.users_id', '=', $collegeProfileObj->users_id)
                        ->where('faculty_departments.collegeprofile_id', '=', $collegeProfileObj->id)
                        ->delete();

                    Db::table('college_master_associate_faculties')
                        ->where('college_master_associate_faculties.faculty_id','=', $id)
                        ->where('college_master_associate_faculties.users_id', '=', $collegeProfileObj->users_id)
                        ->where('college_master_associate_faculties.collegeprofile_id', '=', $collegeProfileObj->id)
                        ->delete();
                    $sizeOfDepartmentList = sizeof(Input::get('collegemaster_id'));
                    for($department = 0; $department < $sizeOfDepartmentList; $department++){
                        if (!empty(Input::get('collegemaster_id')[$department])) {
                            $getCollegeMasterDataObj = DB::table('collegemaster')
                                                        ->where('collegemaster.id','=', Input::get('collegemaster_id')[$department])
                                                        ->select('collegemaster.educationlevel_id','collegemaster.functionalarea_id','collegemaster.degree_id','collegemaster.coursetype_id','collegemaster.course_id')
                                                        ->orderBy('collegemaster.id' ,'DESC')
                                                        ->first();

                            $createFacultyDepartment                          = New FacultyDepartment;
                            $createFacultyDepartment->collegemaster_id       = Input::get('collegemaster_id')[$department];
                            $createFacultyDepartment->course_id               = $getCollegeMasterDataObj->course_id;
                            $createFacultyDepartment->educationlevel_id       = $getCollegeMasterDataObj->educationlevel_id;
                            $createFacultyDepartment->coursetype_id           = $getCollegeMasterDataObj->coursetype_id;
                            $createFacultyDepartment->functionalarea_id       = $getCollegeMasterDataObj->functionalarea_id;
                            $createFacultyDepartment->degree_id               = $getCollegeMasterDataObj->degree_id;
                            $createFacultyDepartment->faculty_id              = $update->id;
                            $createFacultyDepartment->collegeprofile_id       = $collegeProfileObj->id;
                            $createFacultyDepartment->users_id                = $collegeProfileObj->users_id;
                            $createFacultyDepartment->employee_id             = $userId;
                            $createFacultyDepartment->save();

                            $collegeMasterAssociate                          = New CollegeMasterAssociateFaculty;
                            $collegeMasterAssociate->faculty_id              = $update->id;
                            $collegeMasterAssociate->functionalarea_id       = $getCollegeMasterDataObj->functionalarea_id;
                            $collegeMasterAssociate->educationlevel_id       = $getCollegeMasterDataObj->educationlevel_id;
                            $collegeMasterAssociate->degree_id               = $getCollegeMasterDataObj->degree_id;
                            $collegeMasterAssociate->coursetype_id           = $getCollegeMasterDataObj->coursetype_id;
                            $collegeMasterAssociate->course_id               = $getCollegeMasterDataObj->course_id;
                            $collegeMasterAssociate->collegemaster_id        = Input::get('collegemaster_id')[$department];
                            $collegeMasterAssociate->collegeprofile_id       = $collegeProfileObj->id;
                            $collegeMasterAssociate->users_id                = $collegeProfileObj->users_id;
                            $collegeMasterAssociate->employee_id             = $userId;
                            $collegeMasterAssociate->save();
                        }
                    }
                }

                Session::flash('flash_message', 'faculty updated!');
                return redirect::back();

                //return redirect('employee/faculty');
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Faculty')
                                    ->where('userprivileges.delete', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $getFacultyObj = Faculty::findOrFail($id);

                    DB::table('faculty_experiences')
                        ->where('faculty_experiences.faculty_id','=', $id)
                        ->where('faculty_experiences.collegeprofile_id', '=', $getFacultyObj->collegeprofile_id)
                        ->delete();

                    DB::table('faculty_qualifications')
                        ->where('faculty_qualifications.faculty_id','=', $id)
                        ->where('faculty_qualifications.collegeprofile_id', '=', $getFacultyObj->collegeprofile_id)
                        ->delete();

                    Db::table('faculty_departments')
                        ->where('faculty_departments.faculty_id','=', $id)
                        ->where('faculty_departments.collegeprofile_id', '=', $getFacultyObj->collegeprofile_id)
                        ->delete();

                    Db::table('college_master_associate_faculties')
                        ->where('college_master_associate_faculties.faculty_id','=', $id)
                        ->where('college_master_associate_faculties.collegeprofile_id', '=', $getFacultyObj->id)
                        ->delete();

                    Faculty::destroy($id);
                    Session::flash('flash_message', 'faculty deleted!');
                    return redirect('employee/faculty');
                }else{
                    Session::flash('access_restricted_msg', 'Access Restricted!');
                    return Redirect::action('employee\AdminEmployeeController@index');
                }
                
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
        
    }

    public function getAllCollegeMasterName(Request $request)
    {
        $collegeProfileId = $request->currentID;

        $collegeMasterObj = DB::table('collegeprofile')
                    ->join('users', function ($join) use ($collegeProfileId) {
                            $join->on('collegeprofile.users_id', '=','users.id')
                                ->where('collegeprofile.users_id', '=', DB::raw($collegeProfileId)
                                );  
                            }) 
                    ->leftJoin('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                    ->leftjoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                    ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                    ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                    ->leftjoin('coursetype', 'collegemaster.coursetype_id', '=', 'coursetype.id')
                    ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')              
                    ->select('collegemaster.id as collegemasterId', 'collegemaster.twelvemarks','collegemaster.others', 'collegemaster.fees', 'collegemaster.seats','collegemaster.seatsallocatedtobya','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','users.id as userID','users.firstname', 'users.lastname', 'functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName')
                    ->get()
                    ;

       
        if( !empty($collegeMasterObj) ){
            $dataArray = array(
                        'code' => '200',
                        'collegeMasterObj' => $collegeMasterObj,
                     );    
        }else{
            $dataArray = array(
                        'code' => '401',
                        'collegeMasterObj' => '',
                     );
        }
        
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }

    /**
     * Search College Profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function facultyEmployeeSearch(Request $request)
    {
           
        $search0 = 'faculty.id';
        if( $request->collegeName != null ){
            $search1 = "AND `users`.`id` =  '".$request->collegeName."'";
        }else{
            $search1 =  '';
        }

        if( $request->functionalarea_id != '' ){
            $search2 = "AND `collegemaster`.`functionalarea_id` =  '".$request->functionalarea_id."'";
        }else{
            $search2 =  '';
        }

        
        if( $request->degree_id != '' ){
            $search3 = "AND `collegemaster`.`degree_id` =  '".$request->degree_id."'";
        }else{
            $search3 =  '';
        }

        if( $request->course_id != '' ){
            $search4 = "AND `collegemaster`.`course_id` =  '".$request->course_id."'";
        }else{
            $search4 =  '';
        }

        
        if( $request->startCounter != '' ){
            $startCounter = $request->startCounter;
        }else{
            $startCounter = 0;
        }

        if( $request->prevCounter != '' ){
            $startCounter = $request->prevCounter;
        }else{
            $startCounter = $request->startCounter;
        }

        if( $startCounter == '' ){
            $startCounter = 0;
        }

        $currentNode = $request->currentNode;
        if(!empty($currentNode)){
            $getValue = ($currentNode - 1)*20;  
        }else{
            $getValue = 0;
        }
       
        $facultyDataObj = DB::select( DB::raw("SELECT faculty.id as facultyId,faculty.suffix, faculty.name as facultyName,faculty.description as facultyDescription, collegeprofile.id as collegeprofileId,users.firstname, faculty.collegemaster_id, course.name as courseName, degree.name as degreeName, functionalarea.name as functionalareaName,collegeprofile.id as collegeprofileId,collegemaster.id as collegemasterId,eID.id as eUserId,eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,faculty.updated_at FROM  `faculty`  
                        LEFT JOIN `collegeprofile` ON `faculty`.`collegeprofile_id` = `collegeprofile`.`id`
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `collegemaster` ON `faculty`.`collegemaster_id` = `collegemaster`.`id`
                        LEFT JOIN `functionalarea` ON `collegemaster`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `degree` ON `collegemaster`.`degree_id` = `degree`.`id`
                        LEFT JOIN `course` ON `collegemaster`.`course_id` = `course`.`id`
                        LEFT JOIN `users` as `eID` ON `collegemaster`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        AND users.userstatus_id != '5'
                        ORDER BY faculty.id ASC
                        LIMIT 20 OFFSET $getValue"
                    ));
/*echo "<pre>";  
print_r($facultyDataObj);die;*/
        $facultyDataObj1 = DB::select( DB::raw("SELECT COUNT(faculty.id) as totalCount FROM  `faculty` 
                         
                        LEFT JOIN `collegeprofile` ON `faculty`.`collegeprofile_id` = `collegeprofile`.`id`
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `collegemaster` ON `faculty`.`collegemaster_id` = `collegemaster`.`id`
                        LEFT JOIN `functionalarea` ON `collegemaster`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `degree` ON `collegemaster`.`degree_id` = `degree`.`id`
                        LEFT JOIN `course` ON `collegemaster`.`course_id` = `course`.`id`
                        LEFT JOIN `users` as `eID` ON `collegemaster`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        AND users.userstatus_id != '5'
                        ORDER BY faculty.id ASC
                        LIMIT 20 "
                    ));

//print_r($facultyDataObj1);die;

        if(!empty($facultyDataObj1)){
            $numRecords = $facultyDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'facultyDataObj' => $facultyDataObj,
                    'totalCountReturn' => sizeof($facultyDataObj),
                    'facultyDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $facultyDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'facultyDataObj' => $facultyDataObj,
                    'totalCountReturn' => '',
                    'facultyDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $facultyDataObj1,
                );
        }

        if( !empty($facultyDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allFacultyEmployeeSearch(Request $request){

        $faculty = Faculty::orderBy('faculty.id', 'DESC')
                            ->leftjoin('collegeprofile', 'faculty.collegeprofile_id', '=', 'collegeprofile.id')
                            ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->leftjoin('collegemaster', 'faculty.collegemaster_id', '=', 'collegemaster.id')
                            ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                            ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                            ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                            ->leftJoin('users as eID','faculty.employee_id', '=','eID.id')
                            ->where('users.userstatus_id','!=','5')
                            ->select('faculty.id as facultyId','faculty.suffix', 'faculty.name as facultyName','faculty.description as facultyDescription', 'collegeprofile.id as collegeprofileId','users.firstname', 'faculty.collegemaster_id', 'course.name as courseName', 'degree.name as degreeName', 'functionalarea.name as functionalareaName','collegeprofile.id as collegeprofileId','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegemaster.id as collegemasterId','faculty.updated_at')
                            ->take(20)
                            ->get();
  
        return json_encode($faculty);
    }

}
