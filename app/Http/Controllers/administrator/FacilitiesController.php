<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Facility;
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

class FacilitiesController extends Controller
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
            //$facilities = Facility::paginate(15);
            $facilities = Facility::orderBy('facilities.id', 'DESC')
                        ->leftJoin('users as eID','facilities.employee_id', '=','eID.id')
                        ->paginate(15, array('facilities.id', 'facilities.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','facilities.updated_at'));
            return view('administrator/facilities.index', compact('facilities'));
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
            return view('administrator/facilities.create');
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
            //Facility::create($request->all());
            $facilities = New Facility();
            $facilities->name = Input::get('name');
            $facilities->employee_id = Auth::id();
            $facilities->save();
            Session::flash('flash_message', 'Facility added!');
            return redirect('administrator/facilities');
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
            //$facility = Facility::findOrFail($id);
            $facility = Facility::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','facilities.employee_id', '=','eID.id')
                        ->select('facilities.id', 'facilities.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','facilities.updated_at')
                        ->findOrFail($id);
            return view('administrator/facilities.show', compact('facility'));
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
            $facility = Facility::findOrFail($id);
            return view('administrator/facilities.edit', compact('facility'));
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
            /*$facility = Facility::findOrFail($id);
            $facility->update($request->all());*/

            $facilities = Facility::findOrFail($id);
            $facilities->name = Input::get('name');
            $facilities->employee_id = Auth::id();
            $facilities->save();
            Session::flash('flash_message', 'Facility updated!');
            return redirect('administrator/facilities');
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
            Facility::destroy($id);
            Session::flash('flash_message', 'Facility deleted!');
            return redirect('administrator/facilities');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function facilitySearch(Request $request)
    {
        $search0 = 'facilities.id';
       
       
        if( $request->facilityName != null ){
            $search1 = "AND `facilities`.`name` LIKE  '%".$request->facilityName."%'";
        }else{
            $search1 =  '';
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
                
        $facilitySearchDataObj = DB::select( DB::raw("SELECT facilities.id as facilitiesId, facilities.name, eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,facilities.updated_at  FROM  `facilities`
                        LEFT JOIN `users` as `eID` ON `facilities`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        ORDER BY facilities.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $facilitySearchDataObj1 = DB::select( DB::raw("SELECT COUNT(facilities.id) as totalCount FROM  `facilities` 
                        LEFT JOIN `users` as `eID` ON `facilities`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        ORDER BY facilities.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($facilitySearchDataObj1)){
            $numRecords = $facilitySearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'facilitySearchDataObj' => $facilitySearchDataObj,
                    'facilitySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $facilitySearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'facilitySearchDataObj' => $facilitySearchDataObj,
                    'facilitySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $facilitySearchDataObj1,
                );
        }

        if( !empty($facilitySearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allFacilitySearch(Request $request){

         $facilities = Facility::orderBy('facilities.id', 'DESC')
                        ->leftJoin('users as eID','facilities.employee_id', '=','eID.id')
                        ->select('facilities.id as facilitiesId', 'facilities.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','facilities.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($facilities);
    }

    public function deleteSearchFacilities(Request $request, $id)
    {   
        Facility::destroy($id);
        return Redirect::back();
    }

}
