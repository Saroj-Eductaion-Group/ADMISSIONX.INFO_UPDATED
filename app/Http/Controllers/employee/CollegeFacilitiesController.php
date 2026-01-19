<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeFacility;
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
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\Facility as Facility;

class CollegeFacilitiesController extends Controller
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
                                ->where('alltableinformations.name', '=', 'CollegeFacility')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'CollegeFacility')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                                   
                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                $collegefacilities = CollegeFacility::orderBy('id', 'DESC')
                        ->leftjoin('collegeprofile', 'collegefacilities.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('facilities', 'collegefacilities.facilities_id', '=', 'facilities.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','collegefacilities.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->Paginate(20, array('collegefacilities.id','collegefacilities.name as collegeFacilitiesName', 'collegefacilities.description', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','facilities.name as facilitiesName','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegefacilities.updated_at'));

                $collegeProfileObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                            ->where('users.userrole_id','=', '2')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ; 
                $facilitiesObj = Facility::all();

                return view('employee/collegefacilities.index', compact('collegefacilities'))
                 ->with('collegeProfileObj',$collegeProfileObj)
                ->with('facilitiesObj',$facilitiesObj)
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
                                ->where('alltableinformations.name', '=', 'CollegeFacility')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $collegeProfileObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ; 
                $facilitiesObj = Facility::all();
                
                return view('employee/collegefacilities.create')
                    ->with('collegeProfileObj',$collegeProfileObj)
                    ->with('facilitiesObj',$facilitiesObj);
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
            /*CollegeFacility::create($request->all());
            Session::flash('flash_message', 'CollegeFacility added!');*/

            $collegeFacilityObj = new CollegeFacility;

            $collegeProfileId = Input::get('collegeprofile_id');

            $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($collegeProfileId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($collegeProfileId)
                                                );  
                                            })
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;

            //$collegeFacilityObj->name = Input::get('name');
            $collegeFacilityObj->description = Input::get('description');
            $collegeFacilityObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
            $collegeFacilityObj->facilities_id = Input::get('facilities_id');
            $collegeFacilityObj->employee_id = Auth::id(); 
            $collegeFacilityObj->save();
            return redirect('employee/collegefacilities');
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
                                ->where('alltableinformations.name', '=', 'CollegeFacility')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                //$collegefacility = CollegeFacility::findOrFail($id);

                $collegefacility = CollegeFacility::orderBy('id', 'DESC')
                    ->leftjoin('collegeprofile', 'collegefacilities.collegeprofile_id', '=', 'collegeprofile.id')
                    ->leftjoin('facilities', 'collegefacilities.facilities_id', '=', 'facilities.id')
                     ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                    ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->leftJoin('users as eID','collegefacilities.employee_id', '=','eID.id')
                    ->select('collegefacilities.id','collegefacilities.name as collegeFacilitiesName', 'collegefacilities.description', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','facilities.name as facilitiesName','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegefacilities.updated_at')
                    ->findOrFail($id);

                return view('employee/collegefacilities.show', compact('collegefacility'));
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
                                ->where('alltableinformations.name', '=', 'CollegeFacility')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $collegefacility = CollegeFacility::findOrFail($id);
                $collegeProfileObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                            ->where('users.userrole_id','=', '2')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ; 

                $collegeObj = CollegeFacility::where('collegefacilities.id', $collegefacility->id)
                                            ->leftjoin('collegeprofile', 'collegefacilities.collegeprofile_id', '=', 'collegeprofile.id')
                                            ->leftjoin('users', 'collegeprofile.users_id','=','users.id')
                                            ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                                            ->select('users.id','users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName' )
                                            ->where('users.userrole_id','=', '2')
                                            ->get()->first();

                $facilitiesObj = Facility::all();
                return view('employee/collegefacilities.edit', compact('collegefacility'))
                    ->with('collegeProfileObj',$collegeProfileObj)
                    ->with('facilitiesObj',$facilitiesObj)
                    ->with('collegeObj', $collegeObj);
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
           /* $collegefacility = CollegeFacility::findOrFail($id);
            $collegefacility->update($request->all());
            Session::flash('flash_message', 'CollegeFacility updated!');*/

            $collegeFacilityObj = CollegeFacility::findOrFail($id);

            $collegeProfileId = Input::get('collegeprofile_id');
            $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($collegeProfileId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($collegeProfileId)
                                                );  
                                            })
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
            
            //$collegeFacilityObj->name = Input::get('name');
            $collegeFacilityObj->description = Input::get('description');
            $collegeFacilityObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId; 
            $collegeFacilityObj->facilities_id = Input::get('facilities_id');
            $collegeFacilityObj->employee_id = Auth::id(); 
            $collegeFacilityObj->save();
            return redirect('employee/collegefacilities');
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
                                ->where('alltableinformations.name', '=', 'CollegeFacility')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                CollegeFacility::destroy($id);
                Session::flash('flash_message', 'CollegeFacility deleted!');
                return redirect('employee/collegefacilities');
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
    public function collegeFacilityEmployeeSearch(Request $request)
    {
        $search0 = 'collegefacilities.id';
       
        if( $request->collegeprofile_id != null ){
            $search1 = "AND `users`.`firstname` LIKE  '%".$request->collegeprofile_id."%'";
        }else{
            $search1 =  '';
        }

        if( $request->facilities_id != null ){
            $search2 = "AND `facilities`.`name` LIKE  '%".$request->facilities_id."%'";
        }else{
            $search2 =  '';
        }

        if( $request->facilityName != '' ){
            $search3 = " AND `collegefacilities`.`name` LIKE  '%".$request->facilityName."%'";           
        }else{
            $search3 = '';
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
                
        $collegeFacilitySearchDataObj = DB::select( DB::raw("SELECT collegefacilities.id as collegefacilitiesId, collegefacilities.name as collegeFacilitiesName, collegefacilities.description as collegefacilitiesDesciption,collegeprofile.id as collegeprofileID, users.id as userID, users.firstname, users.lastname, userrole.name as userRoleName,facilities.name as facilitiesName,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,collegefacilities.updated_at FROM  `collegefacilities`
                        LEFT JOIN `collegeprofile` ON `collegefacilities`.`collegeprofile_id` =  `collegeprofile`.`id`
                        LEFT JOIN `facilities` ON `collegefacilities`.`facilities_id` = `facilities`.`id`
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `collegefacilities`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        AND users.userstatus_id != '5'
                        ORDER BY collegefacilities.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $collegeFacilitySearchDataObj1 = DB::select( DB::raw("SELECT COUNT(collegefacilities.id) as totalCount FROM  `collegefacilities`            LEFT JOIN `collegeprofile` ON `collegefacilities`.`collegeprofile_id` =  `collegeprofile`.`id`
                        LEFT JOIN `facilities` ON `collegefacilities`.`facilities_id` = `facilities`.`id`
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `collegefacilities`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        AND users.userstatus_id != '5'
                        ORDER BY collegefacilities.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($collegeFacilitySearchDataObj1)){
            $numRecords = $collegeFacilitySearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'collegeFacilitySearchDataObj' => $collegeFacilitySearchDataObj,
                    'collegeFacilitySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $collegeFacilitySearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'collegeFacilitySearchDataObj' => $collegeFacilitySearchDataObj,
                    'collegeFacilitySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $collegeFacilitySearchDataObj1,
                );
        }

        if( !empty($collegeFacilitySearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allFacilityEmployeeSearch(Request $request){

        $collegefacilities = CollegeFacility::orderBy('collegefacilities.id', 'DESC')
                        ->leftjoin('collegeprofile', 'collegefacilities.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('facilities', 'collegefacilities.facilities_id', '=', 'facilities.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','collegefacilities.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->select('collegefacilities.id as collegefacilitiesId','collegefacilities.name as collegeFacilitiesName', 'collegefacilities.description as collegefacilitiesDesciption', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','facilities.name as facilitiesName','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegefacilities.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($collegefacilities);
    }

    public function deleteEmployeeSearchFacility(Request $request, $id)
    {   
        CollegeFacility::destroy($id);
        return Redirect::back();
    }

}
