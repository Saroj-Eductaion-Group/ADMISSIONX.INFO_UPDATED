<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Invite;
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

class InviteController extends Controller
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
            $invite = Invite::orderBy('invite.id', 'DESC')
                        ->leftJoin('users', 'invite.users_id', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','invite.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->paginate(20, array('invite.id', 'users.id as userID','users.firstname','users.middlename', 'users.lastname', 'userrole.name as userRoleName','invite.link', 'invite.referemail', 'invite.isactive','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','invite.updated_at'))
                        ;

            $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
            return view('administrator/invite.index', compact('invite'))
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
            $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
            return view('administrator/invite.create')
                    ->with('usersObj', $usersObj)
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
            //Invite::create($request->all());
            if( $request->isactive == 'on' )
            {
                $isactiveValue = '1';
            }else{
                $isactiveValue = '0';
            }

            $inviteObj = New Invite();
            $inviteObj->link = Input::get('link');
            $inviteObj->referemail = Input::get('referemail');
            $inviteObj->isactive = $isactiveValue;
            $inviteObj->users_id = Input::get('users_id');
            $inviteObj->employee_id = Auth::id();
            $inviteObj->save();

            Session::flash('flash_message', 'Invite added!');
            return redirect('administrator/invite');
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
            $invite = Invite::orderBy('invite.id', 'ASC')
                    ->join('users', 'invite.users_id', '=', 'users.id')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->leftJoin('users as eID','invite.employee_id', '=','eID.id')
                    ->select('invite.id', 'users.id as userID','users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName', 'invite.link', 'invite.referemail', 'invite.isactive','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','invite.updated_at')
                    ->findOrFail($id)
                    ;


            return view('administrator/invite.show', compact('invite'));
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
            $invite = Invite::findOrFail($id);
            $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ; 
            return view('administrator/invite.edit', compact('invite'))
                        ->with('usersObj', $usersObj)
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            /*$invite = Invite::findOrFail($id);
            $invite->update($request->all());*/

           // print_r($request->isactive);die;
            if( $request->isactive == 'on' )
            {
                $isactiveValue = '1';
            }else{
                $isactiveValue = '0';
            }
                
            $inviteObj = Invite::findOrFail($id);
            $inviteObj->link = Input::get('link');
            $inviteObj->referemail = Input::get('referemail');
            $inviteObj->isactive = $isactiveValue;
            $inviteObj->users_id = Input::get('users_id');
            $inviteObj->employee_id = Auth::id();
            $inviteObj->save();

            Session::flash('flash_message', 'Invite updated!');
            return redirect('administrator/invite');
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            Invite::destroy($id);
            Session::flash('flash_message', 'Invite deleted!');
            return redirect('administrator/invite');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function inviteSearch(Request $request)
    {
        $search0 = 'invite.id';
       
        if( $request->userName != null ){
            $search1 = "AND `users`.`id` =  '".$request->userName."'" ;
        }else{
            $search1 =  '';
        }

        if( $request->link != '' ){
            $search2 = "AND `invite`.`link` LIKE  '%".$request->link."%'";
        }else{
            $search2 =  '';
        }

        if( $request->isactive != '' ){
            $search3 = " AND `invite`.`isactive` LIKE  '%".$request->isactive."%'";           
        }else{
            $search3 = '';
        }

        if( $request->referemail != '' ){
            $search4 = " AND `invite`.`referemail` LIKE  '%".$request->referemail."%'";           
        }else{
            $search4 = '';
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
                
        $inviteSearchDataObj = DB::select( DB::raw("SELECT invite.id as inviteId, users.id as userID,users.firstname,users.middlename, users.lastname, userrole.name as userRoleName,invite.link, invite.referemail, invite.isactive,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname, invite.updated_at FROM  `invite`
                        LEFT JOIN `users` ON `invite`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `invite`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        AND users.userstatus_id != '5'
                        ORDER BY invite.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $inviteSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(invite.id) as totalCount FROM  `invite` 
                        LEFT JOIN `users` ON `invite`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `invite`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        AND users.userstatus_id != '5'
                        ORDER BY invite.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($inviteSearchDataObj1)){
            $numRecords = $inviteSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'inviteSearchDataObj' => $inviteSearchDataObj,
                    'inviteSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $inviteSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'inviteSearchDataObj' => $inviteSearchDataObj,
                    'inviteSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $inviteSearchDataObj1,
                );
        }

        if( !empty($inviteSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allInviteSearch(Request $request){

         $invite = Invite::orderBy('invite.id', 'DESC')
                        ->leftJoin('users', 'invite.users_id', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','invite.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->select('invite.id as inviteId', 'users.id as userID','users.firstname','users.middlename', 'users.lastname', 'userrole.name as userRoleName','invite.link', 'invite.referemail', 'invite.isactive','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','invite.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($invite);
    }

    public function deleteSearchInvite(Request $request, $id)
    {   
        Invite::destroy($id);
        return Redirect::back();
    }

}
