<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event;
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


class EventController extends Controller
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
            $event = Event::orderBy('id', 'DESC')
                        ->leftjoin('collegeprofile', 'event.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','event.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->Paginate(20, array('event.id','event.name as eventName', 'datetime', 'venue', 'event.description', 'link','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','event.updated_at'));

            $collegeProfileObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->where('users.userrole_id', '=', '2')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                ->get()
                                ;
            return view('administrator/event.index', compact('event'))
            ->with('collegeProfileObj',$collegeProfileObj);
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
             $collegeProfileObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ; 
            return view('administrator/event.create')
            ->with('collegeProfileObj',$collegeProfileObj);
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
           /* Event::create($request->all());
            Session::flash('flash_message', 'Event added!');*/
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

            $eventObj = new Event;
            
            $eventObj->name = Input::get('name');
            
            $arr = explode('/', Input::get('datetime'));
            $eventObj->datetime = $arr[2].'-'.$arr[1].'-'.$arr[0];

            $eventObj->venue = Input::get('venue');
            $eventObj->description = Input::get('description');
            $eventObj->link = Input::get('link');
            $eventObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
            $eventObj->employee_id = Auth::id();
            $eventObj->save();

            return redirect('administrator/event');
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
            $event = Event::orderBy('id', 'DESC')
                        ->leftjoin('collegeprofile', 'event.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','event.employee_id', '=','eID.id')
                        ->select('event.id','event.name as eventName', 'datetime', 'venue', 'event.description', 'link','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','event.updated_at')
                        ->findOrFail($id);

            return view('administrator/event.show', compact('event'));
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
            $event = Event::findOrFail($id);
            $collegeProfileObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ; 

            $collegeObj = Event::where('event.id', $event->id)
                                        ->leftjoin('collegeprofile', 'event.collegeprofile_id', '=', 'collegeprofile.id')
                                        ->leftjoin('users', 'collegeprofile.users_id','=','users.id')
                                        ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                                        ->select('users.id','users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName' )
                                        ->where('users.userrole_id','=', '2')
                                        ->get()->first();
            return view('administrator/event.edit', compact('event'))
            ->with('collegeProfileObj',$collegeProfileObj)
            ->with('collegeObj',$collegeObj);
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
            /*$event = Event::findOrFail($id);
            $event->update($request->all());
            Session::flash('flash_message', 'Event updated!');*/
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


            $eventObj = Event::findOrFail($id);

            $eventObj->name = Input::get('name');
            
            $arr = explode('/', Input::get('datetime'));
            $eventObj->datetime = $arr[2].'-'.$arr[1].'-'.$arr[0];
            
            $eventObj->venue = Input::get('venue');
            $eventObj->description = Input::get('description');
            $eventObj->link = Input::get('link');
            $eventObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
            $eventObj->employee_id = Auth::id();
            $eventObj->save();

            return redirect('administrator/event');
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
            Event::destroy($id);
            Session::flash('flash_message', 'Event deleted!');
            return redirect('administrator/event');
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
    public function collegeEventSearch(Request $request)
    {
        $search0 = 'event.id';
       
        if( $request->eventDateStart != '' && $request->eventDateEnd == '' ){
            $eventDateStartArray = explode('/', $request->eventDateStart);
            $eventDateStart1 = $eventDateStartArray[2].'-'.$eventDateStartArray[0].'-'.$eventDateStartArray[1];

            $search1 = "AND `event`.`datetime` >= '".$eventDateStart1."'";
        }elseif( $request->eventDateStart == '' && $request->eventDateEnd != '' ){

            $eventDateEndArray = explode('/', $request->eventDateEnd);
            $eventDateEnd1 = $eventDateEndArray[2].'-'.$eventDateEndArray[0].'-'.$eventDateEndArray[1];
            $search1 = "AND `event`.`datetime` <= '".$eventDateEnd1."'";
        }elseif($request->eventDateStart != '' && $request->eventDateEnd != '' ){

            $eventDateStartArray = explode('/', $request->eventDateStart);
            $eventDateStart1 = $eventDateStartArray[2].'-'.$eventDateStartArray[0].'-'.$eventDateStartArray[1];

            $eventDateEndArray = explode('/', $request->eventDateEnd);
            $eventDateEnd1 = $eventDateEndArray[2].'-'.$eventDateEndArray[0].'-'.$eventDateEndArray[1];
            $search1 = "AND `event`.`datetime` BETWEEN '".$eventDateStart1."' AND '".$eventDateEnd1."'";
        }else{
            $search1 = '';
        }

        if( $request->collegeName != null ){
            $search2 = "AND `users`.`firstname` LIKE  '%".$request->collegeName."%'";
        }else{
            $search2 =  '';
        }

        if( $request->eventName != '' ){
            $search3 = " AND `event`.`name` LIKE  '%".$request->eventName."%'";           
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
                
        $eventSearchDataObj = DB::select( DB::raw("SELECT event.id as eventId, event.name as eventName, datetime, venue, event.description, event.link as eventLink, users.id as userID,users.firstname, users.lastname, userrole.name as userRoleName,collegeprofile.id as collegeprofileID,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname, event.updated_at FROM  `event`
                        LEFT JOIN `collegeprofile` ON `event`.`collegeprofile_id` =  `collegeprofile`.`id`
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `event`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        AND users.userstatus_id != '5'
                        ORDER BY event.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $eventSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(event.id) as totalCount FROM  `event` 
                        LEFT JOIN `collegeprofile` ON `event`.`collegeprofile_id` =  `collegeprofile`.`id`
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `event`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        AND users.userstatus_id != '5'
                        ORDER BY event.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($eventSearchDataObj1)){
            $numRecords = $eventSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'eventSearchDataObj' => $eventSearchDataObj,
                    'eventSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $eventSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'eventSearchDataObj' => $eventSearchDataObj,
                    'eventSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $eventSearchDataObj1,
                );
        }

        if( !empty($eventSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allEventSearch(Request $request){

        $eventSearch = Event::orderBy('event.id', 'DESC')
                        ->leftjoin('collegeprofile', 'event.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','event.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->select('event.id as eventId','event.name as eventName', 'datetime', 'venue', 'event.description', 'event.link as eventLink','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','event.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($eventSearch);
    }

    public function deleteSearchEvent(Request $request, $id)
    {   
        Event::destroy($id);
        return Redirect::back();
    }

}
