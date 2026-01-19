<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserStatus;
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

class UserStatusController extends Controller
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
                //ACCESS CHECK
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'UserStatus')
                                    ->where('userprivileges.index', '=', '1')
                                    ->count()
                                    ;
                
                if( $validateUrlUsers >= '1' ){
                    //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'UserStatus')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;
                    $userstatus = UserStatus::paginate(15);
                    return view('employee/userstatus.index', compact('userstatus'))
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
                //ACCESS CHECK
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'UserStatus')
                                    ->where('userprivileges.create', '=', '1')
                                    ->count()
                                    ;
                
                if( $validateUrlUsers >= '1' ){
                    return view('employee/userstatus.create');
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
                //UserStatus::create($request->all());
                $userstatus = New UserStatus();
                $userstatus->name = Input::get('name');
                $userstatus->employee_id = Auth::id();
                $userstatus->save();
                Session::flash('flash_message', 'UserStatus added!');
                return redirect('employee/userstatus');
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
                                    ->where('alltableinformations.name', '=', 'UserStatus')
                                    ->where('userprivileges.show', '=', '1')
                                    ->count()
                                    ;
                
                if( $validateUrlUsers >= '1' ){
                   $userstatus = UserStatus::findOrFail($id);
                    return view('employee/userstatus.show', compact('userstatus'));
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
                                    ->where('alltableinformations.name', '=', 'UserStatus')
                                    ->where('userprivileges.edit', '=', '1')
                                    ->count()
                                    ;
                
                if( $validateUrlUsers >= '1' ){
                    $userstatus = UserStatus::findOrFail($id);
                    return view('employee/userstatus.edit', compact('userstatus'));
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
               /* $userstatus = UserStatus::findOrFail($id);
                $userstatus->update($request->all());*/
                $userstatus = UserStatus::findOrFail($id);
                $userstatus->name = Input::get('name');
                $userstatus->employee_id = Auth::id();
                $userstatus->save();
                Session::flash('flash_message', 'UserStatus updated!');
                return redirect('employee/userstatus');
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
                                    ->where('alltableinformations.name', '=', 'UserStatus')
                                    ->where('userprivileges.delete', '=', '1')
                                    ->count()
                                    ;
                                    
                if( $validateUrlUsers >= '1' ){
                    UserStatus::destroy($id);
                    Session::flash('flash_message', 'UserStatus deleted!');
                    return redirect('employee/userstatus');
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
