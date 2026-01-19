<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Subscribe;
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
use App\Models\UserStatus as UserStatus;

class SubscribeController extends Controller
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
                //$subscribe = Subscribe::paginate(15);
                $subscribe = Subscribe::orderBy('subscribe.id', 'DESC')
                        ->leftJoin('users as eID','subscribe.employee_id', '=','eID.id')
                        ->paginate(15, array('subscribe.id','subscribe.name', 'subscribe.email','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','subscribe.updated_at'));
                return view('administrator/subscribe.index', compact('subscribe'));
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
                return view('administrator/subscribe.create');
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

                try {
                    //Subscribe::create($request->all());    
                    $subscribe = New Subscribe();
                    $subscribe->email = Input::get('email');
                    $subscribe->name = Input::get('name');
                    $subscribe->employee_id = Auth::id();
                    $subscribe->save();
                } catch ( \Exception $e) {
                    Session::flash('emailDuplicate', 'Please enter another email address as this one ('.$request->email.')  is already in our records.');
                }

                return redirect('administrator/subscribe');
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
                //$subscribe = Subscribe::findOrFail($id);
                $subscribe = Subscribe::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','subscribe.employee_id', '=','eID.id')
                        ->select('subscribe.id','subscribe.name', 'subscribe.email','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','subscribe.updated_at')
                        ->findOrFail($id);
                return view('administrator/subscribe.show', compact('subscribe'));
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
                $subscribe = Subscribe::findOrFail($id);
                return view('administrator/subscribe.edit', compact('subscribe'));
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
                 try {
                   /* $subscribe = Subscribe::findOrFail($id);
                    $subscribe->update($request->all());*/
                    $subscribe = Subscribe::findOrFail($id);
                    $subscribe->email = Input::get('email');
                    $subscribe->name = Input::get('name');
                    $subscribe->employee_id = Auth::id();
                    $subscribe->save();
                } catch ( \Exception $e) {
                    Session::flash('emailDuplicate', 'Please enter another email address as this one ('.$request->email.')  is already in our records.');
                }
                return redirect('administrator/subscribe');
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
                Subscribe::destroy($id);
                Session::flash('flash_message', 'Subscribe deleted!');
                return redirect('administrator/subscribe');
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
    public function subscribeSearch(Request $request)
    {
        $search0 = 'subscribe.id';
       
       
        if( $request->emailAddress != null ){
            $search1 = "AND `subscribe`.`email` LIKE  '%".$request->emailAddress."%'";
        }else{
            $search1 =  '';
        }

        if( $request->name != null ){
            $search2 = "AND `subscribe`.`name` LIKE  '%".$request->name."%'";
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
                
        $subscribeSearchDataObj = DB::select( DB::raw("SELECT subscribe.id as subscribeId,subscribe.name, subscribe.email,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,subscribe.updated_at FROM  `subscribe`
                        LEFT JOIN `users` as `eID` ON `subscribe`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY subscribe.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $subscribeSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(subscribe.id) as totalCount FROM  `subscribe` 
                        LEFT JOIN `users` as `eID` ON `subscribe`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY subscribe.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($subscribeSearchDataObj1)){
            $numRecords = $subscribeSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'subscribeSearchDataObj' => $subscribeSearchDataObj,
                    'subscribeSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $subscribeSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'subscribeSearchDataObj' => $subscribeSearchDataObj,
                    'subscribeSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $subscribeSearchDataObj1,
                );
        }

        if( !empty($subscribeSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allSubscribeSearch(Request $request){

         $subscribe = Subscribe::orderBy('subscribe.id', 'DESC')
                        ->leftJoin('users as eID','subscribe.employee_id', '=','eID.id')
                        ->select('subscribe.id as subscribeId','subscribe.name', 'subscribe.email','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','subscribe.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($subscribe);
    }

    public function deleteSearchSubscribe(Request $request, $id)
    {   
        Subscribe::destroy($id);
        return Redirect::back();
    }


}
