<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Placement;
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


class PlacementController extends Controller
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
            $placement = Placement::orderBy('id', 'DESC')
                        ->leftJoin('collegeprofile', 'placement.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                        ->leftJoin('users as eID','placement.employee_id', '=','eID.id')
                        ->where('collegeUser.userstatus_id','!=','5')
                        ->paginate(15, array('placement.id', 'numberofrecruitingcompany', 'numberofplacementlastyear', 'ctchighest', 'ctclowest', 'ctcaverage','placementinfo', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName', 'collegeprofile.estyear as collegeUserEstYear','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','placement.updated_at'))
                        ;

            $collegeProfileObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->where('users.userrole_id', '=', '2')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName','users.middlename','users.lastname')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

            return view('administrator/placement.index', compact('placement'))
            ->with('collegeProfileObj', $collegeProfileObj);
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

            $collegeProfileObj = DB::table('collegeprofile')
                            ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->where('users.userrole_id', '=', '2')
                            ->select('collegeprofile.id as collegeprofileID','collegeprofile.description', 'collegeprofile.estyear', 'users.id as userID','users.firstname')
                            ->get()
                            ;
            return view('administrator/placement.create')
            ->with('collegeProfileObj', $collegeProfileObj);
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
           // Placement::create($request->all());
            $placementObj = New Placement();
            $placementObj->numberofrecruitingcompany = Input::get('numberofrecruitingcompany');
            $placementObj->numberofplacementlastyear = Input::get('numberofplacementlastyear');
            $placementObj->ctchighest = Input::get('ctchighest');
            $placementObj->ctclowest = Input::get('ctclowest');
            $placementObj->ctcaverage = Input::get('ctcaverage');
            $placementObj->placementinfo = Input::get('placementinfo');
            $placementObj->collegeprofile_id = Input::get('collegeprofile_id');
            $placementObj->employee_id = Auth::id();
            $placementObj->save();

            Session::flash('flash_message', 'Placement added!');

            return redirect('administrator/placement');
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

            $placement = Placement::orderBy('id', 'DESC')
                    ->leftJoin('collegeprofile', 'placement.collegeprofile_id', '=', 'collegeprofile.id')
                    ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                    ->leftJoin('users as eID','placement.employee_id', '=','eID.id')
                    ->select('placement.id', 'numberofrecruitingcompany', 'numberofplacementlastyear', 'ctchighest', 'ctclowest', 'ctcaverage','placementinfo', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName', 'collegeprofile.estyear as collegeUserEstYear','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','placement.updated_at')
                    ->findOrFail($id)
                    ;

            return view('administrator/placement.show', compact('placement'));
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
            $placement = Placement::findOrFail($id);
            $collegeProfileObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->where('users.userrole_id', '=', '2')
                                ->select('collegeprofile.id as collegeprofileID','collegeprofile.description', 'collegeprofile.estyear', 'users.id as userID','users.firstname')
                                ->get()
                                ;
            return view('administrator/placement.edit', compact('placement'))
            ->with('collegeProfileObj', $collegeProfileObj);
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
            /*$placement = Placement::findOrFail($id);
            $placement->update($request->all());*/

            $placementObj = Placement::findOrFail($id);
            $placementObj->numberofrecruitingcompany = Input::get('numberofrecruitingcompany');
            $placementObj->numberofplacementlastyear = Input::get('numberofplacementlastyear');
            $placementObj->ctchighest = Input::get('ctchighest');
            $placementObj->ctclowest = Input::get('ctclowest');
            $placementObj->ctcaverage = Input::get('ctcaverage');
            $placementObj->placementinfo = Input::get('placementinfo');
            $placementObj->collegeprofile_id = Input::get('collegeprofile_id');
            $placementObj->employee_id = Auth::id();
            $placementObj->save();

            Session::flash('flash_message', 'Placement updated!');

            return redirect('administrator/placement');
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
            Placement::destroy($id);

            Session::flash('flash_message', 'Placement deleted!');

            return redirect('administrator/placement');
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
    public function placementSearch(Request $request)
    {
        $search0 = 'placement.id';
       
        if( $request->collegeName != null ){
            $search1 = "AND `users`.`firstname` LIKE  '%".$request->collegeName."%'" ;
        }else{
            $search1 =  '';
        }

        if( $request->numberofrecruitingcompany != null ){
            $search2 = "AND `placement`.`numberofrecruitingcompany` LIKE  '%".$request->numberofrecruitingcompany."%'";
        }else{
            $search2 =  '';
        }

        if( $request->numberofplacementlastyear != '' ){
            $search3 = " AND `placement`.`numberofplacementlastyear` LIKE  '%".$request->numberofplacementlastyear."%'";           
        }else{
            $search3 = '';
        }

        if( $request->ctchighest != null ){
            $search4 = "AND `placement`.`ctchighest` LIKE  '%".$request->ctchighest."%'";
        }else{
            $search4 =  '';
        }

        if( $request->ctclowest != '' ){
            $search5 = " AND `placement`.`ctclowest` LIKE  '%".$request->ctclowest."%'";           
        }else{
            $search5 = '';
        }

        if( $request->ctcaverage != '' ){
            $search6 = " AND `placement`.`ctcaverage` LIKE  '%".$request->ctcaverage."%'";           
        }else{
            $search6 = '';
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
                
        $placementSearchDataObj = DB::select( DB::raw("SELECT placement.id as placementId, numberofrecruitingcompany, numberofplacementlastyear, ctchighest, ctclowest, ctcaverage,placementinfo, users.id as usersID, users.firstname as usersFirstName, collegeprofile.estyear as collegeEstYear,collegeprofile.id as collegeprofileID ,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname, placement.updated_at FROM  `placement`
                        LEFT JOIN `collegeprofile` ON `placement`.`collegeprofile_id` = `collegeprofile`.`id`
                        LEFT JOIN  `users` ON  `collegeprofile`.`users_id` =  `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `placement`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        $search5
                        $search6
                        AND users.userstatus_id != '5'
                        ORDER BY placement.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
        
        $placementSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(placement.id) as totalCount FROM  `placement` 
                        LEFT JOIN `collegeprofile` ON `placement`.`collegeprofile_id` = `collegeprofile`.`id`
                        LEFT JOIN  `users` ON  `collegeprofile`.`users_id` =  `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `placement`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        $search5
                        $search6
                        AND users.userstatus_id != '5'
                        ORDER BY placement.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($placementSearchDataObj1)){
            $numRecords = $placementSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'placementSearchDataObj' => $placementSearchDataObj,
                    'placementSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $placementSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'placementSearchDataObj' => $placementSearchDataObj,
                    'placementSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $placementSearchDataObj1,
                );
        }

        if( !empty($placementSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allPlacementSearch(Request $request){

         $placement = Placement::orderBy('placement.id', 'DESC')
                        ->leftJoin('collegeprofile', 'placement.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftJoin('users as eID','placement.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->select('placement.id as placementId', 'numberofrecruitingcompany', 'numberofplacementlastyear', 'ctchighest', 'ctclowest', 'ctcaverage','placementinfo', 'users.id as usersID', 'users.firstname as usersFirstName', 'collegeprofile.estyear as collegeEstYear','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','placement.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($placement);
    }

    public function deleteSearchPlacemant(Request $request, $id)
    {   
        Placement::destroy($id);
        return Redirect::back();
    }

}
