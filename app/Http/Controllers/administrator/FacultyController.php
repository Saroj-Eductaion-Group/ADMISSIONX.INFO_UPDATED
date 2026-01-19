<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Faculty;
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
use Mail;
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

class FacultyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                    $faculty = Faculty::orderBy('faculty.id', 'DESC')
                                ->leftjoin('collegeprofile', 'faculty.collegeprofile_id', '=', 'collegeprofile.id')
                                ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->leftjoin('collegemaster', 'faculty.collegemaster_id', '=', 'collegemaster.id')
                                ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                                ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                                ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                                ->leftJoin('users as eID','faculty.employee_id', '=','eID.id')
                                ->paginate(15, array('faculty.id','faculty.suffix', 'faculty.name','faculty.description', 'collegeprofile.id as collegeprofileId','users.firstname', 'faculty.collegemaster_id', 'course.name as courseName', 'degree.name as degreeName', 'functionalarea.name as functionalareaName','collegeprofile.id as collegeprofileId','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','faculty.updated_at'));

                    $functionalAreaObj = FunctionalArea::all();
                    $degreeObj = Degree::all();
                    $courseObj = Course::all();

                    $collegeProfileObj = DB::table('collegeprofile')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->where('users.userrole_id', '=', '2')
                                        ->select('collegeprofile.id as collegeprofileID', 'users.id','users.firstname')
                                        ->get()
                                        ;

                    return view('administrator/faculty.index', compact('faculty'))
                            ->with('functionalAreaObj',$functionalAreaObj)
                            ->with('degreeObj',$degreeObj)
                            ->with('courseObj',$courseObj)
                            ->with('collegeProfileObj',$collegeProfileObj)
                            ;
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                    $usersObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get();
                    return view('administrator/faculty.create')
                    ->with('usersObj', $usersObj);
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                    faculty::create($request->all());
                    /*$faculty = New faculty();
                    $faculty->collegeprofile_id = Input::get('collegeprofile_id');
                    $faculty->collegemaster_id = Input::get('collegemaster_id');
                    $faculty->name = Input::get('name');
                    $faculty->description = Input::get('description');
                    $faculty->employee_id = Auth::id();
                    $faculty->save();*/

                    Session::flash('flash_message', 'faculty added!');
                    return redirect('administrator/faculty');
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                    $faculty =  Faculty::orderBy('id', 'DESC')
                                ->leftjoin('collegeprofile', 'faculty.collegeprofile_id', '=', 'collegeprofile.id')
                                ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->leftjoin('collegemaster', 'faculty.collegemaster_id', '=', 'collegemaster.id')
                                ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                                ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                                ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                                ->leftJoin('users as eID','faculty.employee_id', '=','eID.id')
                                ->select('faculty.id', 'faculty.suffix','faculty.name', 'faculty.description', 'faculty.collegeprofile_id', 'faculty.collegemaster_id', 'course.name as courseName', 'degree.name as degreeName', 'functionalarea.name as functionalareaName', 'users.firstname', 'collegeprofile.id as collegeprofileId','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','faculty.updated_at')
                                ->findOrFail($id)
                                ;


                    return view('administrator/faculty.show', compact('faculty'));
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                $faculty = faculty::findOrFail($id);

                $usersObj = DB::table('users')
                        ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                        ->where('users.userrole_id', '=', '2')
                        ->where('users.userstatus_id', '=', '1')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get();

            $collegeCourseObj = CollegeMaster::all();
                    
                    return view('administrator/faculty.edit', compact('faculty'))
                    ->with('usersObj', $usersObj)
                    ->with('collegeCourseObj', $collegeCourseObj);
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                    // $faculty = faculty::findOrFail($id);
                    // $faculty->update($request->all());
                    $faculty = faculty::findOrFail($id);
                    $faculty->suffix = Input::get('suffix');
                    $faculty->name = Input::get('name');
                    $faculty->description = Input::get('description');
                    $faculty->employee_id = Auth::id();
                    $faculty->save();
                    Session::flash('flash_message', 'faculty updated!');

                    return redirect('administrator/faculty');
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                faculty::destroy($id);
                Session::flash('flash_message', 'faculty deleted!');
                return redirect('administrator/faculty');
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
    public function facultySearch(Request $request)
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

    public function allFacultySearch(Request $request){

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
