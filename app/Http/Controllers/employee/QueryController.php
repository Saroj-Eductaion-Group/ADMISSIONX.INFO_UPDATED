<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Query;
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
use App\Models\StudentProfile as StudentProfile;
use App\Models\CollegeProfile as CollegeProfile;

class QueryController extends Controller
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
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Query')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                 //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Query')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                                   
                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;


                $query = Query::orderBy('query.id', 'DESC')
                        ->leftJoin('users as U1', 'query.admin_id', '=', 'U1.id')
                        ->leftJoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
                        ->leftJoin('users as U3', 'query.student_id', '=', 'U3.id')
                        ->leftJoin('studentprofile', 'U3.id', '=', 'studentprofile.users_id')
                        ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                        ->whereRaw('U1.id is NULL')
                        ->paginate(20, array('query.id', 'query.subject', 'query.queryflowtype', 'query.chatkey','query.message','U1.id as U1Id','U1.firstname as U1FirstName', 'U1.lastname as U1LastName', 'U2.id as U2Id','U2.firstname as U2FirstName', 'U2.lastname as U2LastName', 'U3.id as U3Id','U3.firstname as U3FirstName', 'U3.lastname as U3LastName','collegeprofile.id as collegeprofileID','studentprofile.id as studentprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename','eID.lastname as employeeLastname','query.updated_at'))
                        ;
            
                $userObj = DB::table('users')
                            ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ;


                return view('employee/query.index', compact('query'))
                ->with('userObj',$userObj)
                ->with('storeEditUpdateAction', $storeEditUpdateAction);
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Query')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

                return view('employee/query.create')
                    ->with('usersObj', $usersObj)
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
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            //Query::create($request->all());
            $queryObj = New Query();
        
            if( !empty(Input::get('subject')) ){
                $queryObj->subject = Input::get('subject');    
            }

            if( !empty(Input::get('message')) ){
                $queryObj->message = Input::get('message');    
            }

            if( !empty(Input::get('admin_id')) ){
                $queryObj->admin_id = Input::get('admin_id');    
            }

            if( !empty(Input::get('student_id')) ){
                $queryObj->student_id = Input::get('student_id');    
            }
            
            if( !empty(Input::get('college_id')) ){
                //GET THE COLLEGE PROFILE ID
                $getCollegeProfieId = DB::table('collegeprofile')
                                        ->where('collegeprofile.users_id', '=', Input::get('college_id'))
                                        ->select('collegeprofile.id')
                                        ->orderBy('id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;
                
                $queryObj->college_id = $getCollegeProfieId[0]->id;
            }

            $queryObj->queryflowtype = 'student-to-college';
            $queryObj->chatkey = uniqid();          
            $queryObj->employee_id = Auth::id();
            $queryObj->save();
            
            Session::flash('flash_message', 'Query added!');
            return redirect('employee/query');
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
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Query')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $query = Query::orderBy('query.id', 'ASC')
                    ->leftJoin('users as U1', 'query.admin_id', '=', 'U1.id')
                    ->leftJoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                    ->leftJoin('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
                    ->leftJoin('users as U3', 'query.student_id', '=', 'U3.id')
                    ->leftJoin('studentprofile', 'U3.id', '=', 'studentprofile.users_id')
                    ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                    ->select('query.id', 'query.subject', 'query.message','U1.id as U1Id','U1.firstname as U1FirstName', 'U1.lastname as U1LastName', 'U2.id as U2Id','U2.firstname as U2FirstName', 'U2.lastname as U2LastName', 'U3.id as U3Id','U3.firstname as U3FirstName', 'U3.lastname as U3LastName','collegeprofile.id as collegeprofileID','studentprofile.id as studentprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at')
                    ->findOrFail($id)
                    ;
                return view('employee/query.show', compact('query'));
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Query')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $query = Query::findOrFail($id);
                $usersObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ;
                            
                $collegeProfileObj = Query::where('query.id', $query->id)
                                ->leftjoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                                ->join('users', 'collegeprofile.users_id','=','users.id')
                                ->join('userrole', 'users.userrole_id','=','userrole.id')
                                ->select('users.id','users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName' )
                                ->get()->first();

                return view('employee/query.edit', compact('query'))
                    ->with('usersObj', $usersObj)
                    ->with('collegeProfileObj', $collegeProfileObj)
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
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            //$query = Query::findOrFail($id);
            //$query->update($request->all());
            $queryObj = Query::findOrFail($id);
            if( !empty(Input::get('subject')) ){
                $queryObj->subject = Input::get('subject');    
            }

            if( !empty(Input::get('message')) ){
                $queryObj->message = Input::get('message');    
            }

            if( !empty(Input::get('admin_id')) ){
                $queryObj->admin_id = Input::get('admin_id');    
            }

            if( !empty(Input::get('student_id')) ){
                $queryObj->student_id = Input::get('student_id');    
            }
            
            if( !empty(Input::get('college_id')) ){
                //GET THE COLLEGE PROFILE ID
                $getCollegeProfieId = DB::table('collegeprofile')
                                        ->where('collegeprofile.users_id', '=', Input::get('college_id'))
                                        ->select('collegeprofile.id')
                                        ->orderBy('id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;
                $queryObj->college_id = $getCollegeProfieId[0]->id;
            }

            $queryObj->queryflowtype = 'student-to-college';  
            $queryObj->employee_id = Auth::id();
            $queryObj->save();
            Session::flash('flash_message', 'Query updated!');
            return redirect('employee/query');
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Query')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                Query::destroy($id);
                Session::flash('flash_message', 'Query deleted!');
                return redirect('employee/query');
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
     * Search users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function queryEmployeeSearch(Request $request)
    {
        $search0 = 'query.id';
      
        if( $request->collegeName != '' ){
            $search2 = "AND `U2`.`id` =  '".$request->collegeName."'";
        }else{
            $search2 =  '';
        }

        if( $request->studentName != '' ){
            $search4 = "AND `U3`.`id` =  '".$request->studentName."'";
        }else{
            $search4 =  '';
        }

        if( $request->subject != '' ){
            $search3 = " AND `query`.`subject` LIKE  '%".$request->subject."%'";           
        }else{
            $search3 = '';
        }

         $createdDateFrom = $request->createdDateStart;
        $createdDateTo = $request->createdDateEnd;
       
        if( $createdDateFrom != '' && $createdDateTo == '' ){

            $createdDateStartArray = explode('/', $createdDateFrom);
            $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

            $queryDate = "AND query.created_at >= '".$createdDateStart1."'";
        }elseif( $createdDateFrom == '' && $createdDateTo != '' ){

            $createdDateEndArray = explode('/', $createdDateTo);
            $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
            $queryDate = "AND query.created_at <= '".$createdDateEnd1."'";
        }elseif($createdDateFrom != '' && $createdDateTo != '' ){

            $createdDateStartArray = explode('/', $createdDateFrom);
            $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

            $createdDateEndArray = explode('/', $createdDateTo);
            $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
            $queryDate = "AND query.created_at BETWEEN '".$createdDateStart1."' AND '".$createdDateEnd1."'";
        }else{
            $queryDate = '';
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
                
        $querySearchDataObj = DB::select( DB::raw("SELECT query.id as queryID,query.queryflowtype, query.subject,query.chatkey, query.message,U1.id as U1Id,U1.firstname as U1FirstName, U1.lastname as U1LastName, U2.id as U2Id,U2.firstname as U2FirstName, U2.lastname as U2LastName, U3.id as U3Id,U3.firstname as U3FirstName, U3.middlename as U3MiddleName,U3.lastname as U3LastName,collegeprofile.id as collegeprofileID,studentprofile.id as studentprofileID,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,query.updated_at  FROM  `query`
                        LEFT JOIN users as U1 ON query.admin_id  = U1.id 
                        LEFT JOIN collegeprofile ON query.college_id = collegeprofile.id
                        LEFT JOIN users as U2 ON collegeprofile.users_id = U2.id
                        LEFT JOIN users as U3 ON query.student_id = U3.id
                        LEFT JOIN studentprofile ON U3.id = studentprofile.users_id
                        LEFT JOIN `users` as `eID` ON `query`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search2
                        $search3
                        $search4
                        $queryDate
                        AND query.queryflowtype != 'admin-to-college'
                        AND query.queryflowtype != 'college-to-admin'
                        AND query.queryflowtype != 'student-to-admin'
                        AND query.queryflowtype != 'admin-to-student'
                        AND query.queryflowtype != 'guest-to-admin'
                        ORDER BY query.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
        
       //  print_r($querySearchDataObj);die;
        $querySearchDataObj1 = DB::select( DB::raw("SELECT COUNT(query.id) as totalCount FROM  `query` 
                        LEFT JOIN users as U1 ON query.admin_id  = U1.id 
                        LEFT JOIN collegeprofile ON query.college_id = collegeprofile.id
                        LEFT JOIN users as U2 ON collegeprofile.users_id = U2.id
                        LEFT JOIN users as U3 ON query.student_id = U3.id
                        LEFT JOIN studentprofile ON U3.id = studentprofile.users_id
                        LEFT JOIN `users` as `eID` ON `query`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search2
                        $search3
                        $search4
                        $queryDate
                        AND query.queryflowtype != 'admin-to-college'
                        AND query.queryflowtype != 'college-to-admin'
                        AND query.queryflowtype != 'student-to-admin'
                        AND query.queryflowtype != 'admin-to-student'
                        AND query.queryflowtype != 'guest-to-admin'
                        ORDER BY query.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($querySearchDataObj1)){
            $numRecords = $querySearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'querySearchDataObj' => $querySearchDataObj,
                    'querySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $querySearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'querySearchDataObj' => $querySearchDataObj,
                    'querySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $querySearchDataObj1,
                );
        }

        if( !empty($querySearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allQueryEmployeeSearch(Request $request){

         $query = Query::orderBy('query.id', 'DESC')
                        ->leftJoin('users as U1', 'query.admin_id', '=', 'U1.id')
                        ->leftJoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
                        ->leftJoin('users as U3', 'query.student_id', '=', 'U3.id')
                        ->leftJoin('studentprofile', 'U3.id', '=', 'studentprofile.users_id')
                         ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                        ->select('query.id as queryID', 'query.subject', 'query.message','U1.id as U1Id','U1.firstname as U1FirstName', 'U1.lastname as U1LastName', 'U2.id as U2Id','U2.firstname as U2FirstName', 'U2.lastname as U2LastName', 'U3.id as U3Id','U3.firstname as U3FirstName', 'U3.lastname as U3LastName','collegeprofile.id as collegeprofileID','studentprofile.id as studentprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($query);
    }


    public function queryToBya(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            
            $query = Query::orderBy('query.id', 'DESC')
                        ->leftJoin('users as U1', 'query.admin_id', '=', 'U1.id')
                        ->leftJoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
                        ->leftJoin('users as U3', 'query.student_id', '=', 'U3.id')
                        ->leftJoin('studentprofile', 'U3.id', '=', 'studentprofile.users_id')
                        ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                        ->where('query.queryflowtype', '!=', 'college-to-student')
                        ->where('query.queryflowtype', '!=', 'student-to-college')
                        ->groupBy('query.chatkey')
                        ->paginate(20, array('query.id', 'query.subject', 'query.queryflowtype', 'query.chatkey','query.message','U1.id as U1Id','U1.firstname as U1FirstName', 'U1.lastname as U1LastName', 'U2.id as U2Id','U2.firstname as U2FirstName', 'U2.lastname as U2LastName', 'U3.id as U3Id','U3.firstname as U3FirstName', 'U3.lastname as U3LastName','U3.middlename as U3MiddleName','collegeprofile.id as collegeprofileID','studentprofile.id as studentprofileID','query.querytypeinfo','query.guestname','query.guestemail','query.guestphone','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at'))
                        ;
            $userObj = DB::table('users')
                        ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

            return view('employee/query.bya-index', compact('query'))
            ->with('userObj',$userObj);
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function queryToByaDetails(Request $request, $id, $person)
    {
        //GET THE QUERY DETAILS
        $queryInfo = DB::table('query')
                            ->leftJoin('users as U1', 'query.admin_id', '=', 'U1.id')
                            ->leftJoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                            ->leftJoin('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
                            ->leftJoin('users as U3', 'query.student_id', '=', 'U3.id')
                            ->leftJoin('studentprofile', 'U3.id', '=', 'studentprofile.users_id')
                            ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                            ->where('query.id', '=', $id)
                            ->where('query.queryflowtype', '=', $person)
                            ->groupBy('query.chatkey')
                            ->select('query.id', 'query.subject', 'query.created_at', 'query.queryflowtype', 'query.chatkey','query.message','U1.id as U1Id','U1.firstname as U1FirstName', 'U1.lastname as U1LastName', 'U2.id as U2Id','U2.firstname as U2FirstName', 'U2.lastname as U2LastName', 'U3.id as U3Id','U3.firstname as U3FirstName', 'U3.lastname as U3LastName','collegeprofile.id as collegeprofileID','studentprofile.id as studentprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at')
                            ->get()
                            ;
        
        $query = DB::table('query')
                            ->leftJoin('users as U1', 'query.admin_id', '=', 'U1.id')
                            ->leftJoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                            ->leftJoin('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
                            ->leftJoin('users as U3', 'query.student_id', '=', 'U3.id')
                            ->leftJoin('studentprofile', 'U3.id', '=', 'studentprofile.users_id')
                            ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                            ->where('query.chatkey', '=', $queryInfo[0]->chatkey)
                            ->select('query.id', 'query.subject', 'query.queryflowtype', 'query.chatkey','query.message','U1.id as U1Id','U1.firstname as U1FirstName', 'U1.lastname as U1LastName', 'U2.id as U2Id','U2.firstname as U2FirstName', 'U2.lastname as U2LastName', 'U3.id as U3Id','U3.firstname as U3FirstName', 'U3.lastname as U3LastName','collegeprofile.id as collegeprofileID','studentprofile.id as studentprofileID', 'query.guestname' ,'query.guestemail' ,'query.guestphone','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at' )
                            ->orderBy('query.id', 'ASC')
                            ->get()
                            ;
        
        $userObj = DB::table('users')
                        ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

        return view('employee/query.bya-index-details', compact('query'))
            ->with('queryInfo',$queryInfo)
            ->with('userObj',$userObj)
            ->with('queryID', $id)
            ->with('person', $person)
            ;
    }

    public function queryReplyBya(Request $request)
    {
        $chatkey = Input::get('queryChatKey');
        $message = Input::get('message');
        $person = Input::get('person');

        //GET OLD QUERY INFO
        $getOldQueryInfo = DB::table('query')
                            ->where('chatkey', '=', $chatkey)
                            ->select('query.id', 'admin_id', 'college_id', 'student_id', 'queryflowtype', 'replytoid', 'chatkey')
                            ->orderBy('query.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;
        
        //UPDATE REPLYTOID IN OLD ENTRY
        $updateOldQueryReply = Query::findOrFail($getOldQueryInfo[0]->id);

        $updateOldQueryReply->replytoid = $getOldQueryInfo[0]->id;
        $updateOldQueryReply->querytypeinfo = 'replied';
        $updateOldQueryReply->employee_id = Auth::id();
        $updateOldQueryReply->save();

        $createQueryReply = New Query();

        $createQueryReply->message = $message;
        $createQueryReply->admin_id = Auth::id();
        
        if( $person == 'college-to-admin' ){
            $createQueryReply->college_id = $getOldQueryInfo[0]->college_id;    
            $createQueryReply->queryflowtype = 'admin-to-college';
        }else{
            $createQueryReply->student_id = $getOldQueryInfo[0]->student_id;    
            $createQueryReply->queryflowtype = 'admin-to-student';
        }
        
        $createQueryReply->replytoid = $getOldQueryInfo[0]->id;
        $createQueryReply->chatkey = $chatkey;
        $createQueryReply->querytypeinfo = 'replied';
        $createQueryReply->employee_id = Auth::id();
        $createQueryReply->save();

        return Redirect::back();
    }

    public function queryBetweenCollegeStudent(Request $request)
    {
        //GET ALL QUERIES IN CHAT FORMATION
        $getAllQueriesBetween = Query::orderBy('query.id', 'DESC')
                            ->leftJoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                            ->leftJoin('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
                            ->leftJoin('users as U3', 'query.student_id', '=', 'U3.id')
                            ->leftJoin('studentprofile', 'U3.id', '=', 'studentprofile.users_id')
                            ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                            ->where('query.queryflowtype', '=', 'student-to-college')
                            //->groupBy('query.chatkey')
                            ->paginate(20, array('query.id', 'query.subject', 'query.message', 'query.chatkey','U2.id as U2Id','U2.firstname as U2FirstName', 'U2.lastname as U2LastName', 'U3.id as U3Id','U3.firstname as U3FirstName', 'U3.middlename as U3MiddleName','U3.lastname as U3LastName','collegeprofile.id as collegeprofileID','studentprofile.id as studentprofileID','queryflowtype','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at'))
                            ;                                        

        $userObj = DB::table('users')
                        ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;                                       

        return view('employee/query.college-between-student-index')
                ->with('getAllQueriesBetween', $getAllQueriesBetween)
                ->with('userObj', $userObj)
                ;
    }

    public function queryBetweenCollegeStudentDetails($chatkey, $id)
    {   
        //GET QUERY DETAILS AS PER CHAT KEYS
        $queryInfo  = DB::table('query')
                        ->where('query.chatkey', '=', $chatkey)
                        ->groupBy('query.chatkey')
                        ->orderBy('query.id', 'DESC')
                        ->select('query.id', 'query.subject', 'query.created_at')                        
                        ->get()
                        ;

        $query  = DB::table('query')
                        ->leftJoin('users as student', 'query.student_id', '=','student.id')
                        ->leftJoin('collegeprofile', 'query.college_id', '=','collegeprofile.id')
                        ->leftJoin('users as college', 'collegeprofile.users_id', '=','college.id')
                        ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                        ->where('query.chatkey', '=', $chatkey)
                        ->orderBy('query.id', 'ASC')
                        ->select('query.id', 'query.chatkey', 'query.subject', 'query.message', 'queryflowtype', 'replytoid', 'student.firstname as sFirstName', 'student.lastname as sLastName', 'college.firstname as cName', 'query.created_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at')                        
                        ->get()
                        ;
                        
        return view('employee/query.college-between-student-details')
                ->with('query', $query)
                ->with('queryInfo', $queryInfo)
                ;
    }

    public function queryDetails($chatkey, $id)
    {   
        //GET QUERY DETAILS AS PER CHAT KEYS
        $queryInfo  = DB::table('query')
                        ->where('query.chatkey', '=', $chatkey)
                        ->groupBy('query.chatkey')
                        ->orderBy('query.id', 'DESC')
                        ->select('query.id', 'query.subject', 'query.created_at')                        
                        ->get()
                        ;

        $query  = DB::table('query')
                        ->leftJoin('users as student', 'query.student_id', '=','student.id')
                        ->leftJoin('collegeprofile', 'query.college_id', '=','collegeprofile.id')
                        ->leftJoin('users as college', 'collegeprofile.users_id', '=','college.id')
                        ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                        ->where('query.chatkey', '=', $chatkey)
                        ->orderBy('query.id', 'ASC')
                        ->select('query.id', 'query.chatkey', 'query.subject', 'query.message', 'queryflowtype', 'replytoid', 'student.firstname as sFirstName', 'student.lastname as sLastName', 'college.firstname as cName', 'query.created_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at')                        
                        ->get()
                        ;
                        
        return view('employee/query.query-details')
                ->with('query', $query)
                ->with('queryInfo', $queryInfo)
                ;
    }


    /**
     * Search users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function querySearchAdmissionxEmployee(Request $request)
    {
        $search0 = 'query.id';
      
        if( $request->collegeName != '' ){
            $search2 = "AND `U2`.`id` =  '".$request->collegeName."'";
        }else{
            $search2 =  '';
        }

        if( $request->studentName != '' ){
            $search4 = "AND `U3`.`id` =  '".$request->studentName."'";
        }else{
            $search4 =  '';
        }

        if( $request->subject != '' ){
            $search3 = " AND `query`.`subject` LIKE  '%".$request->subject."%'";           
        }else{
            $search3 = '';
        }

         $createdDateFrom = $request->createdDateStart;
        $createdDateTo = $request->createdDateEnd;
       
        if( $createdDateFrom != '' && $createdDateTo == '' ){

            $createdDateStartArray = explode('/', $createdDateFrom);
            $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

            $queryDate = "AND query.created_at >= '".$createdDateStart1."'";
        }elseif( $createdDateFrom == '' && $createdDateTo != '' ){

            $createdDateEndArray = explode('/', $createdDateTo);
            $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
            $queryDate = "AND query.created_at <= '".$createdDateEnd1."'";
        }elseif($createdDateFrom != '' && $createdDateTo != '' ){

            $createdDateStartArray = explode('/', $createdDateFrom);
            $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

            $createdDateEndArray = explode('/', $createdDateTo);
            $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
            $queryDate = "AND query.created_at BETWEEN '".$createdDateStart1."' AND '".$createdDateEnd1."'";
        }else{
            $queryDate = '';
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
                
        $querySearchDataObj = DB::select( DB::raw("SELECT query.id as queryID,query.queryflowtype, query.subject,query.chatkey, query.message,U1.id as U1Id,U1.firstname as U1FirstName, U1.middlename as U1MiddleName,U1.lastname as U1LastName, U2.id as U2Id,U2.firstname as U2FirstName, U2.lastname as U2LastName, U3.id as U3Id,U3.firstname as U3FirstName, U3.middlename as U3MiddleName,U3.lastname as U3LastName,collegeprofile.id as collegeprofileID,studentprofile.id as studentprofileID, query.guestname , query.guestemail , query.guestphone ,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,query.updated_at FROM  `query`
                        LEFT JOIN users as U1 ON query.admin_id  = U1.id 
                        LEFT JOIN collegeprofile ON query.college_id = collegeprofile.id
                        LEFT JOIN users as U2 ON collegeprofile.users_id = U2.id
                        LEFT JOIN users as U3 ON query.student_id = U3.id
                        LEFT JOIN studentprofile ON U3.id = studentprofile.users_id
                        LEFT JOIN `users` as `eID` ON `query`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search2
                        $search3
                        $search4
                        $queryDate
                        AND query.queryflowtype != 'college-to-student'
                        AND query.queryflowtype != 'student-to-college'
                        /*group by query.chatkey*/
                        ORDER BY query.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
        
       //  print_r($querySearchDataObj);die;
        $querySearchDataObj1 = DB::select( DB::raw("SELECT COUNT(query.id) as totalCount FROM  `query` 
                        LEFT JOIN users as U1 ON query.admin_id  = U1.id 
                        LEFT JOIN collegeprofile ON query.college_id = collegeprofile.id
                        LEFT JOIN users as U2 ON collegeprofile.users_id = U2.id
                        LEFT JOIN users as U3 ON query.student_id = U3.id
                        LEFT JOIN studentprofile ON U3.id = studentprofile.users_id
                        LEFT JOIN `users` as `eID` ON `query`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search2
                        $search3
                        $search4
                        $queryDate
                        AND query.queryflowtype != 'college-to-student'
                        AND query.queryflowtype != 'student-to-college'
                        ORDER BY query.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($querySearchDataObj1)){
            $numRecords = $querySearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'querySearchDataObj' => $querySearchDataObj,
                    'querySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $querySearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'querySearchDataObj' => $querySearchDataObj,
                    'querySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $querySearchDataObj1,
                );
        }

        if( !empty($querySearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allQuerySearchAdmissionxEmployee(Request $request){

         $query = Query::orderBy('query.id', 'DESC')
                        ->leftJoin('users as U1', 'query.admin_id', '=', 'U1.id')
                        ->leftJoin('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
                        ->leftJoin('users as U3', 'query.student_id', '=', 'U3.id')
                        ->leftJoin('studentprofile', 'U3.id', '=', 'studentprofile.users_id')
                        ->leftJoin('users as eID','query.employee_id', '=','eID.id')
                        ->where('query.queryflowtype', '!=', 'college-to-student')
                        ->where('query.queryflowtype', '!=', 'student-to-college')
                        ->groupBy('query.chatkey')
                        ->select('query.id as queryID','query.queryflowtype', 'query.subject','query.chatkey', 'query.message','U1.id as U1Id','U1.firstname as U1FirstName', 'U1.middlename as U1MiddleName','U1.lastname as U1LastName', 'U2.id as U2Id','U2.firstname as U2FirstName', 'U2.lastname as U2LastName', 'U3.id as U3Id','U3.firstname as U3FirstName', 'U3.middlename as U3MiddleName','U3.lastname as U3LastName','collegeprofile.id as collegeprofileID','studentprofile.id as studentprofileID', 'query.guestname' , 'query.guestemail' , 'query.guestphone','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','query.updated_at')
                        ->take(20)
                        ->get();

        return json_encode($query);
    }

    public function deleteEmployeeSearchQuery(Request $request, $id)
    {   
        Query::destroy($id);
        return Redirect::back();
    }

}
