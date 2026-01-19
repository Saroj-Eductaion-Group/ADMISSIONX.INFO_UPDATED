<?php
namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserGroup;
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
use Config;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\UserPrivilege;
use App\Models\AllTableInformation;


class UsergroupController extends Controller
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
            $usergroup = UserGroup::orderBy('usergroups.id', 'DESC')
                            ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                            ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                            ->leftJoin('users as eID','usergroups.employee_id', '=','eID.id')
                            ->groupBy('usergroups.name')
                            ->paginate(15, array('usergroups.id', 'users.firstname', 'users.lastname', 'alltableinformations.name as tableName','usergroups.name as userGroupName','usergroups.slug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','usergroups.updated_at'));

            return view('administrator/usergroup.index', compact('usergroup'));
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
            //$allTableInfoObj = AllTableInformation::all();
            $allTableInfoObj = DB::table('alltableinformations')
                    ->whereNotIN('id', [39,40,2,3,5,8, 9,30, 42,  46,34])
                    ->orderBy('alltableinformations.name', 'ASC')
                    ->get()
                    ;
            $allUsersObj = DB::table('users')->where('userrole_id', '=', '4')->get();
            return view('administrator/usergroup.create')
                    ->with('allTableInfoObj', $allTableInfoObj)
                    ->with('allUsersObj', $allUsersObj)
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
        
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $slugName = str_slug(Input::get('name'), "-");

            $checkSlugObj = DB::table('usergroups')
                            ->where('slug', '=', $slugName)
                            ->count()
                            ;

            if( $checkSlugObj == '0' ){
                //SAVE INTO DB
                try{
                    $alltablenameid = Input::get('allTableInformation_id');
                    foreach($alltablenameid as $key ) {
                        $allTableInfoID = DB::table('alltableinformations')
                                                    ->where('id', '=', $key)
                                                    ->take(1)
                                                    ->select('alltableinformations.id as alltableinformationsID')
                                                    ->get()
                                                    ;

                        $userGroupObj = New UserGroup();  
                        $userGroupObj->name = Input::get('name');
                        $userGroupObj->allTableInformation_id = $allTableInfoID[0]->alltableinformationsID;
                        $userGroupObj->users_id = $userId;
                        $userGroupObj->slug = str_slug(Input::get('name'), "-");
                        
                        $userGroupObj->create_action = '0';
                        $userGroupObj->metrics1_action = '0';
                        $userGroupObj->metrics2_action = '0';
                        $userGroupObj->metrics3_action = '0';
                        $userGroupObj->metrics4_action = '0';
                        $userGroupObj->metrics5_action = '0';
                        $userGroupObj->metrics6_action = '0';
                        $userGroupObj->queries_action = '0';
                        $userGroupObj->edit_action = '0';
                        $userGroupObj->update_action = '0';
                        $userGroupObj->index_action = '0';;
                        $userGroupObj->delete_action = '0';
                        $userGroupObj->show_action = '0';
                        $userGroupObj->employee_id = Auth::id();
                        $userGroupObj->save();

                        
                    }
                }
                catch (QueryException $e){
                }
            }else{
                Session::flash('warning', 'Duplicate user group found, kindly use another user group name'); 
                return redirect('administrator/usergroup/create');
            }

            // return redirect()->action('UsergroupController@userGroupTableInfo', [$slugName]);
            if(env('APP_ENV') == 'local'){
               $dirUrl = url().'/administrator/usergroup-table-info/'.$slugName;
            }else{
                $dirUrl = url().'/administrator/usergroup-table-info/'.$slugName;
            }
            return Redirect::to($dirUrl);

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
            $usergroup = UserGroup::orderBy('usergroups.id', 'DESC')
                        ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                        ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                        ->leftJoin('users as eID','usergroups.employee_id', '=','eID.id')
                        ->select('usergroups.id', 'users.firstname','users.middlename', 'users.lastname', 'alltableinformations.name as tableName','usergroups.name as userGroupName','create_action', 'edit_action', 'update_action', 'delete_action', 'show_action', 'metrics1_action', 'metrics2_action', 'metrics3_action', 'metrics4_action', 'metrics5_action', 'metrics6_action', 'queries_action','index_action','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','usergroups.updated_at')
                        ->findOrFail($id);

            return view('administrator/usergroup.show', compact('usergroup'));
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
            $usergroup = UserGroup::findOrFail($id);
           // $allTableInfoObj = AllTableInformation::all();
            $allTableInfoObj = DB::table('alltableinformations')
                    ->whereNotIN('id', [39,40,2,3,5,8, 9,30, 42,  46,34])
                    ->orderBy('alltableinformations.name', 'ASC')
                    ->get()
                    ;
            return view('administrator/usergroup.edit', compact('usergroup'))
            ->with('allTableInfoObj', $allTableInfoObj)
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
        
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){

            $slugName = str_slug(Input::get('name'), "-");

            $checkSlugObj = DB::table('usergroups')
                            ->where('slug', '=', $slugName)
                            ->count()
                            ;

            if( $checkSlugObj == '0' ){
                //SAVE INTO DB
                try{
                    $slugUrlName = $request->slugUrl;

                    //DATA UPDATE IN DB
                    $userGroupObj = UserGroup::findOrFail($id);
                    $userGroupObj->name = Input::get('name');         
                    $userGroupObj->slug = str_slug(Input::get('name'), "-");

                    if(Input::get('allTableInformation_id')){
                        $userGroupObj->allTableInformation_id = Input::get('allTableInformation_id');
                    }
                    $userGroupObj->users_id = $userId;
                    $userGroupObj->create_action = Input::get('create');
                    $userGroupObj->metrics1_action = Input::get('metrics1');
                    $userGroupObj->metrics2_action = Input::get('metrics2');
                    $userGroupObj->metrics3_action = Input::get('metrics3');
                    $userGroupObj->metrics4_action = Input::get('metrics4');
                    $userGroupObj->metrics5_action = Input::get('metrics5');
                    $userGroupObj->metrics6_action = Input::get('metrics6');
                    $userGroupObj->queries_action = Input::get('queries');
                    $userGroupObj->edit_action = Input::get('edit');
                    $userGroupObj->update_action = Input::get('edit');
                    if( Input::get('listOtherAction') == '1' ){
                        $userGroupObj->index_action = '1';                    
                        $userGroupObj->delete_action = '1';
                        $userGroupObj->show_action = '1';
                    }else{
                        $userGroupObj->index_action = '0';;
                        $userGroupObj->delete_action = '0';
                        $userGroupObj->show_action = '0';
                    }
                    $userGroupObj->employee_id = Auth::id();
                    $userGroupObj->save();

                    $changeGroupNameObj = DB::table('usergroups')
                                            ->where('usergroups.id', '=', $id)
                                            ->where('usergroups.slug', '=', $slugName)
                                            ->select('usergroups.id','usergroups.name','usergroups.slug')
                                            ->orderBy('usergroups.id', 'DESC')
                                            ->get()
                                            ;

                    $changeGroupName = $changeGroupNameObj[0]->name;
                    $changeSlugName = $changeGroupNameObj[0]->slug;

                    DB::table('usergroups')->where('usergroups.slug', '=', $slugUrlName)->update(array('usergroups.name' => $changeGroupName,'usergroups.slug' => $changeSlugName ));

                    DB::table('userprivileges')->where('userprivileges.slug', '=', $slugUrlName)->update(array('userprivileges.slug' => $changeSlugName ));
                }
                catch (QueryException $e){
                }
            }else{
                Session::flash('warning', 'Duplicate user group found, kindly use another user group name'); 
                return Redirect::Back();
            }
            
            Session::flash('flash_message', 'userPrivilege updated!');

            return redirect('administrator/usergroup');
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
            UserGroup::destroy($id);
            Session::flash('flash_message', 'UserGroup deleted!');
            //return Redirect::back();
            return redirect('administrator/usergroup');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
        
    }

    public function userGroupTableInfo(Request $request, $slugName)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $usergroupdetails = UserGroup::orderBy('usergroups.id', 'DESC')
                        ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                        ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                        ->leftJoin('users as eID','usergroups.employee_id', '=','eID.id')
                        ->where('usergroups.slug','=', $slugName)
                        //->groupBy('usergroups.slug')
                        ->select('usergroups.id', 'users.firstname','users.middlename', 'users.lastname', 'alltableinformations.name as tableName','usergroups.name as userGroupName','create_action', 'edit_action', 'update_action', 'delete_action', 'show_action', 'metrics1_action', 'metrics2_action', 'metrics3_action', 'metrics4_action', 'metrics5_action', 'metrics6_action', 'queries_action','index_action','usergroups.slug as slugUrl','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','usergroups.updated_at')
                        ->get();


            $userGroupNameObj = UserGroup::orderBy('usergroups.id', 'DESC')
                        ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                        ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                        ->leftJoin('users as eID','usergroups.employee_id', '=','eID.id')
                        ->where('usergroups.slug','=', $slugName)
                        ->select('usergroups.id', 'users.firstname','users.middlename', 'users.lastname', 'alltableinformations.name as tableName','usergroups.name as userGroupName','usergroups.slug as slugUrl','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','usergroups.updated_at')
                        ->take(1)
                        ->get();

            $slugUrl = $userGroupNameObj[0]->slugUrl;
            
            $allTableInfoObj = DB::table('alltableinformations')
                    ->whereNotIN('id', [39,40,2,3,5,8, 9,30, 42,  46,34])
                    ->orderBy('alltableinformations.name', 'ASC')
                    ->get()
                    ;
            return view('administrator/usergroup.tableShowUpdate')
                        ->with('usergroupdetails', $usergroupdetails)
                        ->with('userGroupNameObj', $userGroupNameObj)
                        ->with('slugUrl', $slugUrl)
                        ->with('allTableInfoObj', $allTableInfoObj);
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function updateTableInfo(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $tableInfoId = $request->tableInfoId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '1' && ($roleGrant['userstatus_id'] == '1') ){

                if($request->ajax())
                {
                    $getTableInfoData = UserGroup::where('usergroups.id', '=', $tableInfoId)
                                    ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                                    ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                                    ->where('usergroups.slug', '=', $slugUrl)
                                    ->select('usergroups.id as usergroupsId', 'users.firstname','users.middlename', 'users.lastname', 'alltableinformations.name as tableName','usergroups.name as userGroupName','create_action', 'edit_action', 'update_action', 'delete_action', 'show_action', 'metrics1_action', 'metrics2_action', 'metrics3_action', 'metrics4_action', 'metrics5_action', 'metrics6_action', 'queries_action','index_action','usergroups.slug')
                                    ->firstOrFail()
                                    ;
                    return view('administrator/usergroup.tableInfoUpdate')
                            ->with('getTableInfoData', $getTableInfoData)
                            ->with('slugUrl', $slugUrl);

                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
                }
            }
            else
            {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }   
        }
        else
        {
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }  
    }

    public function userGroupTableUpdate(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
            if( $roleGrant->userrole_id == '1' && ($roleGrant['userstatus_id'] == '1' ) ){
        
                $userGroupObj = UserGroup::where('usergroups.id', '=', Input::get('usergroupsId'))->firstOrFail();
                $userGroupObj->users_id = $userId;
                $userGroupObj->create_action = Input::get('create');
                $userGroupObj->metrics1_action = Input::get('metrics1');
                $userGroupObj->metrics2_action = Input::get('metrics2');
                $userGroupObj->metrics3_action = Input::get('metrics3');
                $userGroupObj->metrics4_action = Input::get('metrics4');
                $userGroupObj->metrics5_action = Input::get('metrics5');
                $userGroupObj->metrics6_action = Input::get('metrics6');
                $userGroupObj->queries_action = Input::get('queries');
                $userGroupObj->edit_action = Input::get('edit');
                $userGroupObj->update_action = Input::get('edit');
                
                if( Input::get('listOtherAction') == '1' ){
                    $userGroupObj->index_action = '1';                    
                    $userGroupObj->delete_action = '1';
                    $userGroupObj->show_action = '1';
                }else{
                    $userGroupObj->index_action = '0';;
                    $userGroupObj->delete_action = '0';
                    $userGroupObj->show_action = '0';
                }
                $userGroupObj->employee_id = Auth::id();
                $userGroupObj->save();

                $updateSameActionObj = DB::table('usergroups')
                                    ->where('usergroups.id', '=', Input::get('usergroupsId'))
                                    ->where('usergroups.slug', '=', $slugUrl)
                                    ->select('usergroups.id','usergroups.slug','usergroups.name as userGroupName','create_action', 'edit_action', 'update_action', 'delete_action', 'show_action', 'metrics1_action', 'metrics2_action', 'metrics3_action', 'metrics4_action', 'metrics5_action', 'metrics6_action', 'queries_action','index_action','usergroups.allTableInformation_id')
                                    ->orderBy('usergroups.id', 'DESC')
                                    ->get()
                                    ;

                        DB::table('userprivileges')
                            ->where('userprivileges.slug', '=', $slugUrl)
                            ->where('userprivileges.allTableInformation_id','=', $updateSameActionObj[0]->allTableInformation_id)
                            ->update(array(
                                            'userprivileges.create' => $updateSameActionObj[0]->create_action,
                                            'userprivileges.edit' => $updateSameActionObj[0]->edit_action,
                                            'userprivileges.update' => $updateSameActionObj[0]->update_action,
                                            'userprivileges.index' => $updateSameActionObj[0]->index_action,
                                            'userprivileges.delete' => $updateSameActionObj[0]->delete_action,
                                            'userprivileges.show' => $updateSameActionObj[0]->show_action,
                                            'userprivileges.metrics1' => $updateSameActionObj[0]->metrics1_action,
                                            'userprivileges.metrics2' => $updateSameActionObj[0]->metrics2_action,
                                            'userprivileges.metrics3' => $updateSameActionObj[0]->metrics3_action,
                                            'userprivileges.metrics4' => $updateSameActionObj[0]->metrics4_action,
                                            'userprivileges.metrics5' => $updateSameActionObj[0]->metrics5_action,
                                            'userprivileges.metrics6' => $updateSameActionObj[0]->metrics6_action,
                                            'userprivileges.queries' => $updateSameActionObj[0]->queries_action 
                                    ));


                $getTableInfoData = DB::table('usergroups')
                                ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                                ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                                ->where('usergroups.slug', '=', $slugUrl)
                                ->where('usergroups.id', '=', Input::get('usergroupsId'))
                                ->select('usergroups.id as usergroupsId', 'alltableinformations.name as tableName','usergroups.name as userGroupName','usergroups.slug')
                                ->get()
                                ;

                $tableName = $getTableInfoData[0]->tableName;
                    
                //END                
                Session::flash('userGroupUpdate', $tableName.' '.'Table actions has been updated successfully!');

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

    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function addNewTable(Request $request)
    {
        
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $slugName = Input::get('slugUrlName');
            $groupName = Input::get('groupName');
           // print_r($slugName);die;

            $checkSlugObj = DB::table('usergroups')
                            ->where('slug', '=', $slugName)
                            ->count()
                            ;

            if( $checkSlugObj != '0' ){
                //SAVE INTO DB
                try{
                    $alltablenameid = Input::get('allTableInformation_id');
                    foreach($alltablenameid as $key ) {
                        $allTableInfoID = DB::table('alltableinformations')
                                                    ->where('id', '=', $key)
                                                    ->take(1)
                                                    ->select('alltableinformations.id as alltableinformationsID')
                                                    ->get()
                                                    ;

                        $checkTableNameObj = DB::table('usergroups')
                                            ->where('usergroups.allTableInformation_id', '=', $key)
                                            ->where('usergroups.slug', '=', $slugName)
                                            ->count()
                                            ;
                        if( $checkTableNameObj == '0' ){
                            $userGroupObj = New UserGroup();  
                            $userGroupObj->name = $groupName;
                            $userGroupObj->allTableInformation_id = $allTableInfoID[0]->alltableinformationsID;
                            $userGroupObj->users_id = $userId;
                            $userGroupObj->slug = $slugName;
                            $userGroupObj->create_action = '0';
                            $userGroupObj->metrics1_action = '0';
                            $userGroupObj->metrics2_action = '0';
                            $userGroupObj->metrics3_action = '0';
                            $userGroupObj->metrics4_action = '0';
                            $userGroupObj->metrics5_action = '0';
                            $userGroupObj->metrics6_action = '0';
                            $userGroupObj->queries_action = '0';
                            $userGroupObj->edit_action = '0';
                            $userGroupObj->update_action = '0';
                            $userGroupObj->index_action = '0';;
                            $userGroupObj->delete_action = '0';
                            $userGroupObj->show_action = '0';
                            $userGroupObj->employee_id = Auth::id();
                            $userGroupObj->save();

                            $currentRowID = UserGroup::orderBy('id', 'DESC')->get()->first();
                            $slugName = $currentRowID->slug;
                            $allTableInformationId = $currentRowID->allTableInformation_id;
                            
                            $checkAddTableNameObj = DB::table('userprivileges')
                                            ->where('userprivileges.allTableInformation_id', '=', $allTableInformationId)
                                            ->where('userprivileges.slug', '=', $slugName)
                                            ->count()
                                            ;

                            if( $checkAddTableNameObj == '0' ){
                                $allUserGroupTableInfoID = DB::table('usergroups')
                                                ->where('usergroups.slug', '=', $slugName)
                                                ->select('usergroups.id as userGroupsID')
                                                ->get()
                                                ;
                                foreach($allUserGroupTableInfoID as $key ) {
                                    $allTableInfoID = DB::table('usergroups')
                                                    ->leftJoin('alltableinformations', 'usergroups.allTableInformation_id', '=', 'alltableinformations.id')
                                                    ->leftJoin('users', 'usergroups.users_id', '=', 'users.id')
                                                    ->where('usergroups.id', '=', $key->userGroupsID)
                                                    ->take(1)
                                                    ->select('usergroups.id as userGroupID', 'users.firstname','users.middlename', 'users.lastname', 'alltableinformations.name as tableName','usergroups.name as userGroupName','create_action', 'edit_action', 'update_action', 'delete_action', 'show_action', 'metrics1_action', 'metrics2_action', 'metrics3_action', 'metrics4_action', 'metrics5_action', 'metrics6_action', 'queries_action','index_action','alltableinformations.id as alltableinformationsID','usergroups.slug')
                                                    ->get()
                                                    ;

                                    $checkTableNameObj = DB::table('userprivileges')
                                            ->where('userprivileges.allTableInformation_id', '=', $allTableInfoID[0]->alltableinformationsID)
                                            ->where('userprivileges.slug', '=', $slugName)
                                            ->count()
                                            ;

                                    if( $checkTableNameObj == '0' ){
                                        $getAllUserID = DB::table('userprivileges')
                                                ->where('userprivileges.slug', '=', $slugName)
                                                ->groupBy('userprivileges.users_id')
                                                ->select('userprivileges.id as userprivilegesID','userprivileges.users_id')
                                                ->get()
                                                ;
                                        foreach ($getAllUserID as $item) {
                                        $userPrivilegeObj = New UserPrivilege();
                                        $userPrivilegeObj->users_id = $item->users_id;
                                        $userPrivilegeObj->allTableInformation_id = $allTableInfoID[0]->alltableinformationsID;
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
                                        }
                                    }
                                }
                            }  
                            
                        }
                    }
                }
                catch (QueryException $e){
                }
            }else{
                Session::flash('warning', 'User group not found, kindly use another user group name'); 
                return redirect('administrator/usergroup/create');
            }

            // return redirect()->action('UsergroupController@userGroupTableInfo', [$slugName]);
            if(env('APP_ENV') == 'local'){
               $dirUrl = url().'/administrator/usergroup-table-info/'.$slugName;
            }else{
                $dirUrl = url().'/administrator/usergroup-table-info/'.$slugName;
            }
            return Redirect::to($dirUrl);

        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }

    }

    public function deleteUserGroup(Request $request, $id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $changeGroupNameObj = DB::table('usergroups')
                                ->where('usergroups.id', '=', $id)
                                ->select('usergroups.id','usergroups.name','usergroups.slug')
                                ->orderBy('usergroups.id', 'DESC')
                                ->get()
                                ;
            $changeSlugName = $changeGroupNameObj[0]->slug;

            $checkSlugCountObj = DB::table('userprivileges')
                            ->where('userprivileges.slug', '=', $changeSlugName)
                            ->count()
                            ;
            if( $checkSlugCountObj == '0' ){
                //SAVE INTO DB
                try{
                    DB::table('usergroups')->where('usergroups.slug', '=', $changeSlugName)->delete();
                    return Redirect::back();
                    //return redirect('administrator/usergroup');
                }
                catch (QueryException $e){
                }
            }else{
                Session::flash('warning', 'This group is already used'); 
                return Redirect::back();
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