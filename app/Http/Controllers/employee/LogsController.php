<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Log;
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

class LogsController extends Controller
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
                                ->where('alltableinformations.name', '=', 'Log')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                  //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Log')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                                   
                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;


                $logs = Log::orderBy('logs.id', 'DESC')
                        ->join('users', 'logs.users_id', '=', 'users.id')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','logs.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->paginate(20, array('logs.id', 'users.firstname', 'users.lastname', 'userrole.name as userRoleName','logs.event','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','logs.updated_at'))
                        ;

                $userObj = DB::table('users')
                        ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
                return view('employee/logs.index', compact('logs'))
                    ->with('userObj', $userObj)
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
                                ->where('alltableinformations.name', '=', 'Log')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
                return view('employee/logs.create')
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
            Log::create($request->all());
            Session::flash('flash_message', 'Log added!');
            return redirect('employee/logs');
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
                                ->where('alltableinformations.name', '=', 'Log')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $log = Log::orderBy('logs.id', 'ASC')
                    ->join('users', 'logs.users_id', '=', 'users.id')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->leftJoin('users as eID','logs.employee_id', '=','eID.id')
                    ->select('logs.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName', 'logs.event','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','logs.updated_at')
                    ->findOrFail($id)
                    ;
            
                return view('employee/logs.show', compact('log'));
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
                                ->where('alltableinformations.name', '=', 'Log')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $log = Log::findOrFail($id);
                $usersObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ;            
                return view('employee/logs.edit', compact('log'))
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
            $log = Log::findOrFail($id);
            $log->update($request->all());
            Session::flash('flash_message', 'Log updated!');
            return redirect('employee/logs');
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
                                ->where('alltableinformations.name', '=', 'Log')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                Log::destroy($id);
                Session::flash('flash_message', 'Log deleted!');
                return redirect('employee/logs');
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
    public function logsEmployeeSearch(Request $request)
    {
        $search0 = 'logs.id';
      
        if( $request->event != '' ){
            $search1 = "AND `logs`.`event` LIKE  '%".$request->event."%'";
        }else{
            $search1 =  '';
        }

        if( $request->userName != '' ){
            $search2 = "AND `users`.`id` =  '".$request->userName."'";
        }else{
            $search2 =  '';
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
                
        $logsSearchDataObj = DB::select( DB::raw("SELECT logs.id as logId, users.firstname, users.lastname, userrole.name as userRoleName,logs.event,users.id as usersId,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,logs.updated_at FROM  `logs`
                        LEFT JOIN `users` ON `logs`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `logs`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        AND users.userstatus_id != '5'
                        ORDER BY logs.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
        
       //  print_r($logsSearchDataObj);die;
        $logsSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(logs.id) as totalCount FROM  `logs` 
                        LEFT JOIN `users` ON `logs`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `logs`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        AND users.userstatus_id != '5'
                        ORDER BY logs.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($logsSearchDataObj1)){
            $numRecords = $logsSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'logsSearchDataObj' => $logsSearchDataObj,
                    'logsSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $logsSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'logsSearchDataObj' => $logsSearchDataObj,
                    'logsSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $logsSearchDataObj1,
                );
        }

        if( !empty($logsSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allLogEmployeeSearch(Request $request){

         $logs = Log::orderBy('logs.id', 'DESC')
                        ->join('users', 'logs.users_id', '=', 'users.id')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','logs.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->select('logs.id as logId','users.id as usersId','users.firstname', 'users.lastname', 'userrole.name as userRoleName','logs.event','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','logs.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($logs);
    }

    public function deleteEmployeeSearchLogs(Request $request, $id)
    {   
        Log::destroy($id);
        return Redirect::back();
    }

    public function WebsiteAnalytics(Request $request)
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
                                ->where('alltableinformations.name', '=', 'WebsiteMetrics')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    //GET ALL USERS VISITS IN THE LAST 24H.
                    $getAllLastToday = DB::table('logs')
                                        ->whereRaw('logs.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                        ->count()
                                        ;

                    $getAllLastTodayCounter = DB::table('logs')
                                                ->whereRaw('logs.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                                ->select(DB::raw( 'COUNT( logs.id ) as totalCount' ),'userrole_id as userRole')
                                                ->groupBy('logs.userrole_id')
                                                ->orderBy('logs.userrole_id', 'ASC')
                                                ->get()
                                                ;
                                                
                    //GET ALL USERS VISITS IN THE CURRENT WEEK.
                    $getAllCurrentWeek = DB::table('logs')
                                        ->whereRaw('logs.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                        ->count()
                                        ;

                    $getAllCurrentWeekCounter = DB::table('logs')
                                                ->whereRaw('logs.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                                ->select(DB::raw( 'COUNT( logs.id ) as totalCount' ),'userrole_id as userRole')
                                                ->groupBy('logs.userrole_id')
                                                ->orderBy('logs.userrole_id', 'ASC')
                                                ->get()
                                                ;

                    //GET ALL USERS VISITS IN THE CURRENT MONTH.
                    $getAllCurrentMonth = DB::table('logs')
                                        ->whereRaw('MONTH(logs.created_at) = "'.date('m').'"')
                                        ->count()
                                        ;

                    $getAllCurrentMonthCounter = DB::table('logs')
                                                ->whereRaw('MONTH(logs.created_at) = "'.date('m').'"')
                                                ->select(DB::raw( 'COUNT( logs.id ) as totalCount' ),'userrole_id as userRole')
                                                ->groupBy('logs.userrole_id')
                                                ->orderBy('logs.userrole_id', 'ASC')
                                                ->get()
                                                ;

                    //GET ALL USERS VISITS IN THE LAST 3 MONTHS.
                    $getAllLastThreeWeek = DB::table('logs')
                                        ->whereRaw('logs.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                        ->count()
                                        ;

                    $getAllLastThreeWeekCounter = DB::table('logs')
                                                ->whereRaw('logs.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                                ->select(DB::raw( 'COUNT( logs.id ) as totalCount' ),'userrole_id as userRole')
                                                ->groupBy('logs.userrole_id')
                                                ->orderBy('logs.userrole_id', 'ASC')
                                                ->get()
                                                ;
                    
                    return view('employee/logs.website-analytics')
                            ->with('getAllLastToday', $getAllLastToday)
                            ->with('getAllLastTodayCounter', $getAllLastTodayCounter)

                            ->with('getAllCurrentWeek', $getAllCurrentWeek)
                            ->with('getAllCurrentWeekCounter', $getAllCurrentWeekCounter)

                            ->with('getAllCurrentMonth', $getAllCurrentMonth)
                            ->with('getAllCurrentMonthCounter', $getAllCurrentMonthCounter)

                            ->with('getAllLastThreeWeek', $getAllLastThreeWeek)
                            ->with('getAllLastThreeWeekCounter', $getAllLastThreeWeekCounter)
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

}
