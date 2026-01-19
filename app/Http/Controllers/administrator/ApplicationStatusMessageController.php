<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ApplicationStatusMessage;
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
use App\Models\ApplicationStatus;

class ApplicationStatusMessageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            //$applicationstatusmessage = ApplicationStatusMessage::paginate(15);
    
            $applicationstatusmessage = ApplicationStatusMessage::orderBy('id', 'DESC')
                            ->leftJoin('application', 'applicationstatusmessages.application_id','=', 'application.id')
                            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                            ->leftJoin('users as studentUser', 'applicationstatusmessages.student_id','=', 'studentUser.id')
                            ->leftJoin('studentprofile', 'studentUser.id','=', 'studentprofile.users_id')
                            ->leftJoin('collegeprofile', 'applicationstatusmessages.college_id','=', 'collegeprofile.id')
                            ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                            ->leftJoin('users as eID','applicationstatusmessages.employee_id', '=','eID.id')
                            ->where('collegeUser.userstatus_id','!=','5')
                            ->where('studentUser.userstatus_id','!=','5')
                            ->paginate(15,array('applicationstatusmessages.id','applicationstatusmessages.applicationStatus','applicationstatusmessages.message','applicationstatusmessages.others','application.id as applicationId','studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName','studentUser.middlename as studentUserMiddleName', 'studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob', 'application.email', 'application.phone','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','studentprofile.id as studentprofileId','application.applicationID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','applicationstatusmessages.updated_at' ))
                            ;

            $userObj = DB::table('users')
                        ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
            $applicationStatusObj = ApplicationStatus::all();
         
            return view('administrator/applicationstatusmessage.index', compact('applicationstatusmessage'))
                    ->with('userObj',$userObj)
                    ->with('applicationStatusObj', $applicationStatusObj);
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            return view('administrator/applicationstatusmessage.create');
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            ApplicationStatusMessage::create($request->all());

            Session::flash('flash_message', 'ApplicationStatusMessage added!');

            return redirect('administrator/applicationstatusmessage');
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            //$applicationstatusmessage = ApplicationStatusMessage::findOrFail($id);
            $applicationstatusmessage = ApplicationStatusMessage::orderBy('id', 'DESC')
                       ->leftJoin('application', 'applicationstatusmessages.application_id','=', 'application.id')
                        ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                        ->leftJoin('users as studentUser', 'applicationstatusmessages.student_id','=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentUser.id','=', 'studentprofile.users_id')
                        ->leftJoin('collegeprofile', 'applicationstatusmessages.college_id','=', 'collegeprofile.id')
                        ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                        ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                        ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                        ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                        ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                        ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                        ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                        ->leftJoin('users as eID','applicationstatusmessages.employee_id', '=','eID.id')
                        ->select('applicationstatusmessages.id','applicationstatusmessages.applicationStatus','applicationstatusmessages.message','applicationstatusmessages.others','application.id as applicationId','studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName','studentUser.middlename as studentUserMiddleName', 'studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob', 'application.email', 'application.phone','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','studentprofile.id as studentprofileId','application.applicationID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','applicationstatusmessages.updated_at' )
                        ->findOrFail($id)
                        ;
            return view('administrator/applicationstatusmessage.show', compact('applicationstatusmessage'));
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $applicationstatusmessage = ApplicationStatusMessage::findOrFail($id);

            return view('administrator/applicationstatusmessage.edit', compact('applicationstatusmessage'));
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
            $applicationstatusmessage = ApplicationStatusMessage::findOrFail($id);
            $applicationstatusmessage->update($request->all());

            Session::flash('flash_message', 'ApplicationStatusMessage updated!');

            return redirect('administrator/applicationstatusmessage');
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
            ApplicationStatusMessage::destroy($id);

            Session::flash('flash_message', 'ApplicationStatusMessage deleted!');

            return redirect('administrator/applicationstatusmessage');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }

    }

    public function applicationRemarkSearch(Request $request)
    {
        $search0 = 'applicationstatusmessages.id';
       
       
        if( $request->applicationstatus != null ){
            $search1 = "AND `applicationstatusmessages`.`applicationStatus` LIKE '%".$request->applicationstatus."%'" ;
        }else{
            $search1 =  '';
        }
        
        if( $request->remarkApplication != '' ){
            $search2 = "AND `applicationstatusmessages`.`others` LIKE  '%".$request->remarkApplication."%'";
        }else{
            $search2 =  '';
        }

        if( $request->studentName != null ){
            $search3 = " AND `studentUser`.`id` =  '".$request->studentName."'";           
        }else{
            $search3 = '';
        }

        if( $request->collegeName != null ){
            $search4 = " AND `collegeUser`.`id` =  '".$request->collegeName."'";           
        }else{
            $search4 = '';
        }

        $createdDateFrom = $request->createdDateStart;
        $createdDateTo = $request->createdDateEnd;
       
        if( $createdDateFrom != '' && $createdDateTo == '' ){

            $createdDateStartArray = explode('/', $createdDateFrom);
            $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

            $applicationDate = "AND application.created_at >= '".$createdDateStart1."'";
        }elseif( $createdDateFrom == '' && $createdDateTo != '' ){

            $createdDateEndArray = explode('/', $createdDateTo);
            $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
            $applicationDate = "AND application.created_at <= '".$createdDateEnd1."'";
        }elseif($createdDateFrom != '' && $createdDateTo != '' ){

            $createdDateStartArray = explode('/', $createdDateFrom);
            $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

            $createdDateEndArray = explode('/', $createdDateTo);
            $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
            $applicationDate = "AND application.created_at BETWEEN '".$createdDateStart1."' AND '".$createdDateEnd1."'";
        }else{
            $applicationDate = '';
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
                
        $applicationRemarkSearchDataObj = DB::select( DB::raw("SELECT  applicationstatusmessages.id, applicationstatusmessages.applicationStatus, applicationstatusmessages.message, applicationstatusmessages.others, application.id as applicationId, studentUser.id as studentUserID,  studentUser.firstname as studentUserFirstName, studentUser.middlename as studentUserMiddleName ,  studentUser.lastName as studentUserLastName ,  collegeprofile.id as collegeprofileID,  collegeprofile.description as collegeprofileDescription,  collegeUser.firstname as collegeUserFirstName, application.firstname as applicationFirstName,  application.middlename as applicationMiddleName,  application.lastname as applicationLastname,  application.dob,  application.email,  application.phone, collegemaster.id as collegemasterId, educationlevel.name as educationlevelName, functionalarea.name as functionalareaName, degree.name as degreeName, coursetype.name as coursetypeName, course.name as courseName, studentprofile.id as studentprofileId ,applicationstatus.id as applicationstatusId, applicationstatus.name as applicationstatusName, application.applicationID,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname, applicationstatusmessages.updated_at FROM  `applicationstatusmessages`
                        LEFT JOIN `application` ON `applicationstatusmessages`.`application_id` = `application`.`id`
                        LEFT JOIN `applicationstatus` ON `application`.`applicationstatus_id` = `applicationstatus`.`id`
                        LEFT JOIN `users` as `studentUser` ON `applicationstatusmessages`.`student_id` = `studentUser`.`id`
                        LEFT JOIN `studentprofile` ON `studentUser`.`id` = `studentprofile`.`users_id`
                        LEFT JOIN `collegeprofile` ON `applicationstatusmessages`.`college_id` = `collegeprofile`.`id`
                        LEFT JOIN `users` as `collegeUser` ON `collegeprofile`.`users_id` = `collegeUser`.`id`
                        LEFT JOIN `collegemaster` ON `application`.`collegemaster_id` = `collegemaster`.`id`
                        LEFT JOIN `educationlevel` ON `collegemaster`.`educationlevel_id` = `educationlevel`.`id`
                        LEFT JOIN `functionalarea` ON `collegemaster`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `degree` ON `collegemaster`.`degree_id` = `degree`.`id`
                        LEFT JOIN `coursetype` ON `collegemaster`.`coursetype_id` = `coursetype`.`id`
                        LEFT JOIN `course` ON `collegemaster`.`course_id` = `course`.`id`
                        LEFT JOIN `users` as `eID` ON `applicationstatusmessages`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        $applicationDate
                        AND studentUser.userstatus_id != '5'
                        AND collegeUser.userstatus_id != '5'
                        ORDER BY applicationstatusmessages.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $applicationRemarkSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(applicationstatusmessages.id) as totalCount FROM  `applicationstatusmessages` 
                        LEFT JOIN `application` ON `applicationstatusmessages`.`application_id` = `application`.`id`
                        LEFT JOIN `applicationstatus` ON `application`.`applicationstatus_id` = `applicationstatus`.`id`
                        LEFT JOIN `users` as `studentUser` ON `applicationstatusmessages`.`student_id` = `studentUser`.`id`
                        LEFT JOIN `studentprofile` ON `studentUser`.`id` = `studentprofile`.`users_id`
                        LEFT JOIN `collegeprofile` ON `applicationstatusmessages`.`college_id` = `collegeprofile`.`id`
                        LEFT JOIN `users` as `collegeUser` ON `collegeprofile`.`users_id` = `collegeUser`.`id`
                        LEFT JOIN `collegemaster` ON `application`.`collegemaster_id` = `collegemaster`.`id`
                        LEFT JOIN `educationlevel` ON `collegemaster`.`educationlevel_id` = `educationlevel`.`id`
                        LEFT JOIN `functionalarea` ON `collegemaster`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `degree` ON `collegemaster`.`degree_id` = `degree`.`id`
                        LEFT JOIN `coursetype` ON `collegemaster`.`coursetype_id` = `coursetype`.`id`
                        LEFT JOIN `course` ON `collegemaster`.`course_id` = `course`.`id`
                        LEFT JOIN `users` as `eID` ON `applicationstatusmessages`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        $applicationDate
                        AND studentUser.userstatus_id != '5'
                        AND collegeUser.userstatus_id != '5'
                        ORDER BY applicationstatusmessages.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($applicationRemarkSearchDataObj1)){
            $numRecords = $applicationRemarkSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'applicationRemarkSearchDataObj' => $applicationRemarkSearchDataObj,
                    'applicationRemarkSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $applicationRemarkSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'applicationRemarkSearchDataObj' => $applicationRemarkSearchDataObj,
                    'applicationRemarkSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $applicationRemarkSearchDataObj1,
                );
        }

        if( !empty($applicationRemarkSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allApplicationStatusSearch(Request $request){

        $applicationStatusRemarks = ApplicationStatusMessage::orderBy('applicationstatusmessages.id', 'DESC')
                        ->leftJoin('application', 'applicationstatusmessages.application_id','=', 'application.id')
                        ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                        ->leftJoin('users as studentUser', 'applicationstatusmessages.student_id','=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentUser.id','=', 'studentprofile.users_id')
                        ->leftJoin('collegeprofile', 'applicationstatusmessages.college_id','=', 'collegeprofile.id')
                        ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                        ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                        ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                        ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                        ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                        ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                        ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                        ->leftJoin('users as eID','applicationstatusmessages.employee_id', '=','eID.id')
                        ->where('collegeUser.userstatus_id','!=','5')
                        ->where('studentUser.userstatus_id','!=','5')
                        ->select('applicationstatusmessages.id','applicationstatusmessages.applicationStatus','applicationstatusmessages.message','applicationstatusmessages.others','application.id as applicationId','studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName','studentUser.middlename as studentUserMiddleName', 'studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob', 'application.email', 'application.phone','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','studentprofile.id as studentprofileId' ,'application.applicationID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','applicationstatusmessages.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($applicationStatusRemarks);
    }

}
