<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserPrivilege;
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

class UserPrivilegeController extends Controller
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
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'UserPrivilege')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'UserPrivilege')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                                   
                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                $userprivilege = userPrivilege::orderBy('userprivileges.id', 'DESC')
                            ->join('alltableinformations', 'userprivileges.allTableInformation_id', '=', 'alltableinformations.id')
                            ->join('users', 'userprivileges.users_id', '=', 'users.id')
                            ->leftJoin('users as eID','userprivileges.employee_id', '=','eID.id')
                            ->groupBy('userprivileges.users_id')
                            ->paginate(20, array('userprivileges.id', 'users.firstname', 'users.lastname', 'alltableinformations.name as tableName','userprivileges.slug','users.id as usersId','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','alltableinformations.name','userprivileges.updated_at'))
                            ;

                return view('employee/userprivilege.index', compact('userprivilege'))
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
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'UserPrivilege')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $allTableInfoObj = DB::table('alltableinformations')
                    ->whereNotIN('id', [39,40,2,3,5,8, 9,30, 42,  46,34])
                    ->orderBy('alltableinformations.name', 'ASC')
                    ->get()
                    ;

                $allUserGroupObj = DB::table('usergroups')
                        ->orderBy('usergroups.name', 'ASC')
                        ->groupBy('usergroups.name')
                        ->select('usergroups.id', 'usergroups.name','usergroups.slug')
                        ->get()
                        ;
                $allUsersObj = DB::table('users')->where('userrole_id', '=', '4')->get();

                return view('employee/userprivilege.create')
                    ->with('allTableInfoObj', $allTableInfoObj)
                    ->with('allUsersObj', $allUsersObj)
                    ->with('allUserGroupObj', $allUserGroupObj);
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
            
            //VALIDATE USER AND TABLE HAS ALREADY ROW OR NOT
            $validateRows = DB::table('userprivileges')
                            ->where('userprivileges.allTableInformation_id', '=', Input::get('allTableInformation_id'))
                            ->where('userprivileges.users_id', '=', Input::get('users_id'))
                            ->orderBy('id', 'DESC')
                            ->take(1)
                            ->get()
                            ;

            if( !empty($validateRows) ){
                foreach ($validateRows as $key => $value) {
                    Session::flash('alradyRoleWithPermission', 'This employee is already has permissions on this table');
                    return redirect()->action('employee\UserPrivilegeController@edit', [$value->id]);
                }
            }else{
                //DATA SAVE IN DB
                $usersGroupId = Input::get('usersGroupId');
                $userGroupInfoID = DB::table('usergroups')
                                        ->where('usergroups.id', '=', $usersGroupId)
                                        ->take(1)
                                        ->select('usergroups.id','usergroups.slug as userGroupSlug')
                                        ->get()
                                        ;
                $userGroupSlug = $userGroupInfoID[0]->userGroupSlug;

                $allUserGroupTableInfoID = DB::table('usergroups')
                                                ->where('usergroups.slug', '=', $userGroupSlug)
                                                ->select('usergroups.id as userGroupsID')
                                                ->get()
                                                ;
                            $checkExistingGroupName = DB::table('userprivileges')
                            ->where('userprivileges.slug', '=', $userGroupSlug)
                            ->where('userprivileges.users_id', '=', Input::get('users_id'))
                            ->groupBy('userprivileges.slug')
                            ->count()
                            ;
                if($checkExistingGroupName == '0'){
                    foreach($allUserGroupTableInfoID as $key ) {
                       
                        $allTableInfoID = DB::table('usergroups')
                                                    ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                                                    ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                                                    ->where('usergroups.id', '=', $key->userGroupsID)
                                                    ->take(1)
                                                    ->select('usergroups.id as userGroupID', 'users.firstname','users.middlename', 'users.lastname', 'alltableinformations.name as tableName','usergroups.name as userGroupName','create_action', 'edit_action', 'update_action', 'delete_action', 'show_action', 'metrics1_action', 'metrics2_action', 'metrics3_action', 'metrics4_action', 'metrics5_action', 'metrics6_action', 'queries_action','index_action','alltableinformations.id as alltableinformationsID','usergroups.slug')
                                                    ->get()
                                                    ;
                        
                        $checkTableIdInfoObj = DB::table('userprivileges')
                                            ->where('userprivileges.allTableInformation_id', '=', $allTableInfoID[0]->alltableinformationsID)
                                            ->where('userprivileges.users_id', '=', Input::get('users_id'))
                                            ->count()
                                            ;
                        if($checkTableIdInfoObj == '0') {
                            $userPrivilegeObj = New UserPrivilege();

                            $userPrivilegeObj->allTableInformation_id = $allTableInfoID[0]->alltableinformationsID;
                            $userPrivilegeObj->users_id = Input::get('users_id');
                            $userPrivilegeObj->slug = $allTableInfoID[0]->slug;
                            
                            $userPrivilegeObj->create = $allTableInfoID[0]->create_action;
                            $userPrivilegeObj->metrics1 = $allTableInfoID[0]->metrics1_action;
                            $userPrivilegeObj->metrics2 = $allTableInfoID[0]->metrics2_action;
                            $userPrivilegeObj->metrics3 = $allTableInfoID[0]->metrics3_action;
                            $userPrivilegeObj->metrics4 = $allTableInfoID[0]->metrics4_action;
                            $userPrivilegeObj->metrics5 = $allTableInfoID[0]->metrics5_action;
                            $userPrivilegeObj->metrics6 = $allTableInfoID[0]->metrics6_action;
                            $userPrivilegeObj->queries = $allTableInfoID[0]->queries_action;
                            $userPrivilegeObj->edit = $allTableInfoID[0]->edit_action;
                            $userPrivilegeObj->update = $allTableInfoID[0]->update_action;
                            $userPrivilegeObj->index = $allTableInfoID[0]->index_action;
                            $userPrivilegeObj->delete = $allTableInfoID[0]->delete_action;
                            $userPrivilegeObj->show = $allTableInfoID[0]->show_action;
                            $userPrivilegeObj->employee_id = Auth::id();
                            $userPrivilegeObj->save();
                        }else{
                            $checkInfoObj = DB::table('userprivileges')
                                            ->where('userprivileges.allTableInformation_id', '=', $allTableInfoID[0]->alltableinformationsID)
                                            ->where('userprivileges.users_id', '=', Input::get('users_id'))
                                            ->select('userprivileges.id','userprivileges.allTableInformation_id','slug')
                                            ->get()
                                            ;

                            $getGroupName = DB::table('usergroups')
                                            ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                                            ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                                            ->where('usergroups.allTableInformation_id', '=', $checkInfoObj[0]->allTableInformation_id)
                                            ->where('usergroups.slug', '=', $checkInfoObj[0]->slug)
                                            ->select('usergroups.id','usergroups.name','usergroups.slug','alltableinformations.name as tableName')
                                            ->get()
                                            ;

                            if(env('APP_ENV') == 'local'){
                               $dirUrl = url().'/employee/usergroup-table-info/'.$getGroupName[0]->slug;
                            }else{
                                $dirUrl = url().'/employee/usergroup-table-info/'.$getGroupName[0]->slug;
                            }
                            Session::flash('duplicate', 'This employee is already has permissions some tables on this '.$getGroupName[0]->name.' '.' Group, Click to view <a href="'.$dirUrl.'" target="_blank">'.$getGroupName[0]->name.'</a>');
                            return redirect('employee/userprivilege');
                        }

                    }
                    /*$userPrivilegeObj = New UserPrivilege();            
                    $userPrivilegeObj->allTableInformation_id = Input::get('allTableInformation_id');
                    $userPrivilegeObj->users_id = Input::get('users_id');
                    $userPrivilegeObj->create = Input::get('create');
                    $userPrivilegeObj->metrics1 = Input::get('metrics1');
                    $userPrivilegeObj->metrics2 = Input::get('metrics2');
                    $userPrivilegeObj->metrics3 = Input::get('metrics3');
                    $userPrivilegeObj->metrics4 = Input::get('metrics4');
                    $userPrivilegeObj->metrics5 = Input::get('metrics5');
                    $userPrivilegeObj->metrics6 = Input::get('metrics6');
                    $userPrivilegeObj->queries = Input::get('queries');
                    $userPrivilegeObj->edit = Input::get('edit');
                    $userPrivilegeObj->update = Input::get('edit');
                    if( Input::get('listOtherAction') == '1' ){
                        $userPrivilegeObj->index = '1';                    
                        $userPrivilegeObj->delete = '1';
                        $userPrivilegeObj->show = '1';
                    }else{
                        $userPrivilegeObj->index = '0';;
                        $userPrivilegeObj->delete = '0';
                        $userPrivilegeObj->show = '0';
                    }
                    
                    $userPrivilegeObj->save();*/
                }
                else{
                Session::flash('warning', 'This employee is already has permissions on this group, kindly use another user group name');
                return redirect('employee/userprivilege'); 
                //return Redirect::Back();
                }
            }

            Session::flash('flash_message', 'userPrivilege added!');

            return redirect('employee/userprivilege');
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
                                ->where('alltableinformations.name', '=', 'UserPrivilege')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                
                $userprivilege = userPrivilege::orderBy('userprivileges.id', 'DESC')
                ->join('alltableinformations', 'userprivileges.allTableInformation_id', '=', 'alltableinformations.id')
                ->join('users', 'userprivileges.users_id', '=', 'users.id')
                ->leftJoin('users as eID','userprivileges.employee_id', '=','eID.id')
                ->select('userprivileges.id', 'create', 'edit', 'update', 'delete', 'show', 'metrics1', 'metrics2', 'metrics3', 'metrics4', 'metrics5', 'metrics6', 'queries','index', 'slug','users.firstname','users.middlename','users.lastname','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','alltableinformations.name','userprivileges.updated_at')
                ->findOrFail($id);

                return view('employee/userprivilege.show', compact('userprivilege'));
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
                                ->where('alltableinformations.name', '=', 'UserPrivilege')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $userprivilege = userPrivilege::findOrFail($id);
               // $allTableInfoObj = AllTableInformation::all();
                $allTableInfoObj = DB::table('alltableinformations')
                        ->whereNotIN('id', [39,40,2,3,5,8, 9,30, 42,  46,34])
                        ->orderBy('alltableinformations.name', 'ASC')
                        ->get()
                        ;
                $allUsersObj = DB::table('users')->where('userrole_id', '=', '4')->get();

                return view('employee/userprivilege.edit', compact('userprivilege'))
                        ->with('allTableInfoObj', $allTableInfoObj)
                        ->with('allUsersObj', $allUsersObj);
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
            //VALIDATE USER AND TABLE HAS ALREADY ROW OR NOT
            $validateRows = DB::table('userprivileges')
                            ->where('userprivileges.allTableInformation_id', '=', Input::get('allTableInformation_id'))
                            ->where('userprivileges.users_id', '=', Input::get('users_id'))
                            ->orderBy('id', 'DESC')
                            ->take(1)
                            ->get()
                            ;

            if( !empty($validateRows) ){
                //DATA UPDATE IN DB
                $userPrivilegeObj = userPrivilege::findOrFail($id);
                $userPrivilegeObj->users_id = Input::get('users_id');
                $userPrivilegeObj->create = Input::get('create');
                $userPrivilegeObj->metrics1 = Input::get('metrics1');
                $userPrivilegeObj->metrics2 = Input::get('metrics2');
                $userPrivilegeObj->metrics3 = Input::get('metrics3');
                $userPrivilegeObj->metrics4 = Input::get('metrics4');
                $userPrivilegeObj->metrics5 = Input::get('metrics5');
                $userPrivilegeObj->metrics6 = Input::get('metrics6');
                $userPrivilegeObj->queries = Input::get('queries');

                $userPrivilegeObj->edit = Input::get('edit');
                $userPrivilegeObj->update = Input::get('edit');

                if( Input::get('listOtherAction') == '1' ){
                    $userPrivilegeObj->index = '1';                    
                    $userPrivilegeObj->delete = '1';
                    $userPrivilegeObj->show = '1';
                }else{
                    $userPrivilegeObj->index = '0';
                    $userPrivilegeObj->delete = '0';
                    $userPrivilegeObj->show = '0';
                }
                $userPrivilegeObj->employee_id = Auth::id();
                $userPrivilegeObj->save();

                // foreach ($validateRows as $key => $value) {
                //     Session::flash('alradyRoleWithPermission', 'This employee is already has permissions on this table');
                //     return redirect()->action('employee\UserPrivilegeController@edit', [$value->id]);
                // }
            }else{
                //DATA UPDATE IN DB
                $userPrivilegeObj = userPrivilege::findOrFail($id);
                $userPrivilegeObj->allTableInformation_id = Input::get('allTableInformation_id');
                $userPrivilegeObj->users_id = Input::get('users_id');
                $userPrivilegeObj->create = Input::get('create');
                $userPrivilegeObj->metrics1 = Input::get('metrics1');
                $userPrivilegeObj->metrics2 = Input::get('metrics2');
                $userPrivilegeObj->metrics3 = Input::get('metrics3');
                $userPrivilegeObj->metrics4 = Input::get('metrics4');
                $userPrivilegeObj->metrics5 = Input::get('metrics5');
                $userPrivilegeObj->metrics6 = Input::get('metrics6');
                $userPrivilegeObj->queries = Input::get('queries');
                
                $userPrivilegeObj->edit = Input::get('edit');
                $userPrivilegeObj->update = Input::get('edit');

                if( Input::get('listOtherAction') == '1' ){
                    $userPrivilegeObj->index = '1';
                    $userPrivilegeObj->delete = '1';
                    $userPrivilegeObj->show = '1';
                }else{
                    $userPrivilegeObj->index = '0';
                    $userPrivilegeObj->delete = '0';
                    $userPrivilegeObj->show = '0';
                }
                $userPrivilegeObj->employee_id = Auth::id();
                $userPrivilegeObj->save();
            }            

            Session::flash('flash_message', 'userPrivilege updated!');
            return redirect('employee/userprivilege');
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
                                ->where('alltableinformations.name', '=', 'UserPrivilege')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                userPrivilege::destroy($id);
                Session::flash('flash_message', 'userPrivilege deleted!');
                return redirect('employee/userprivilege');
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

    public function userPrivilegeInfo(Request $request, $usersId)
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
                                ->where('alltableinformations.name', '=', 'UserPrivilege')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'UserPrivilege')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                                   
                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                $userprivilege = userPrivilege::orderBy('userprivileges.id', 'DESC')
                            ->join('alltableinformations', 'userprivileges.allTableInformation_id', '=', 'alltableinformations.id')
                            ->join('users', 'userprivileges.users_id', '=', 'users.id')
                            ->leftJoin('users as eID','userprivileges.employee_id', '=','eID.id')
                            ->where('userprivileges.users_id', '=', $usersId)
                            ->paginate(20, array('userprivileges.id', 'users.firstname', 'users.lastname', 'alltableinformations.name as tableName','userprivileges.slug','users.id as usersId','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','alltableinformations.name','userprivileges.updated_at'))
                            ;
               // $allTableInfoObj = AllTableInformation::all();
                $allTableInfoObj = DB::table('alltableinformations')
                        ->whereNotIN('id', [39,40,2,3,5,8, 9,30, 42,  46,34])
                        ->orderBy('alltableinformations.name', 'ASC')
                        ->get()
                        ;
                $allUsersObj = DB::table('users')->where('userrole_id', '=', '4')->get();
                
                return view('employee/userprivilege.userPrivilegeInedx', compact('userprivilege'))
                    ->with('allTableInfoObj', $allTableInfoObj)
                    ->with('allUsersObj', $allUsersObj)
                    ->with('usersId', $usersId)
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


    public function deleteUserprivilege(Request $request, $usersId)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $checkUserNameObj = DB::table('userprivileges')
                                ->where('userprivileges.users_id', '=', $usersId)
                                ->select('userprivileges.id','userprivileges.slug','userprivileges.users_id')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->get()
                                ;
            $userName = $checkUserNameObj[0]->users_id;
            DB::table('userprivileges')->where('userprivileges.users_id', '=', $userName)->delete();
            Session::flash('warning', 'User Privilege Deleted!'); 
            return Redirect::back();
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
        
    }


    public function addNewTableUserPrivileges(Request $request)
    {
        if (Auth::check())
            {   
                $userId = Auth::id();
                $roleGrant = User::where('id', '=', $userId)->first();
                
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $userEmpId = $request->usersId;
                
                //VALIDATE USER AND TABLE HAS ALREADY ROW OR NOT
                $validateRows = DB::table('userprivileges')
                                ->where('userprivileges.allTableInformation_id', '=', Input::get('allTableInformation_id'))
                                ->where('userprivileges.users_id', '=', $userEmpId)
                                ->orderBy('id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                if( !empty($validateRows) ){
                    foreach ($validateRows as $key => $value) {
                        Session::flash('alradyRoleWithPermission', 'This employee is already has permissions on this table');
                        return redirect()->action('employee\UserPrivilegeController@edit', [$value->id]);
                    }
                }else{
                    
                    $userPrivilegeObj = New UserPrivilege();            
                    $userPrivilegeObj->allTableInformation_id = Input::get('allTableInformation_id');
                    $userPrivilegeObj->users_id = $userEmpId;
                    $userPrivilegeObj->create = Input::get('create');
                    $userPrivilegeObj->metrics1 = Input::get('metrics1');
                    $userPrivilegeObj->metrics2 = Input::get('metrics2');
                    $userPrivilegeObj->metrics3 = Input::get('metrics3');
                    $userPrivilegeObj->metrics4 = Input::get('metrics4');
                    $userPrivilegeObj->metrics5 = Input::get('metrics5');
                    $userPrivilegeObj->metrics6 = Input::get('metrics6');
                    $userPrivilegeObj->queries = Input::get('queries');
                    $userPrivilegeObj->edit = Input::get('edit');
                    $userPrivilegeObj->update = Input::get('edit');
                    if( Input::get('listOtherAction') == '1' ){
                        $userPrivilegeObj->index = '1';                    
                        $userPrivilegeObj->delete = '1';
                        $userPrivilegeObj->show = '1';
                    }else{
                        $userPrivilegeObj->index = '0';;
                        $userPrivilegeObj->delete = '0';
                        $userPrivilegeObj->show = '0';
                    }
                    $userPrivilegeObj->employee_id = Auth::id();
                    $userPrivilegeObj->save();
                }

            Session::flash('warning', 'User Privilege Table Added!');
            return Redirect::Back();
            //return redirect('employee/userprivilege');
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
