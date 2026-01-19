<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SocialManagement;
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

class SocialManagementController extends Controller
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
            //$socialmanagement = SocialManagement::paginate(15);
            $socialmanagement = SocialManagement::orderBy('socialmanagements.id', 'ASC')
                        ->leftJoin('users as eID','socialmanagements.employee_id', '=','eID.id')
                        ->whereIN('socialmanagements.id', [1,2,3,4,5])
                        ->orderBy('socialmanagements.id', 'ASC')         
                        ->paginate(15, array('socialmanagements.id','socialmanagements.title','socialmanagements.url', 'socialmanagements.isActive', 'socialmanagements.other','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','socialmanagements.updated_at'));                    

            return view('administrator/socialmanagement.index', compact('socialmanagement'));
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            /*$socialmanagementObj = SocialManagement::orderby('id','DESC')
                        ->paginate(15, array('title','description','url','isActive'));*/
        
            return view('administrator/socialmanagement.create')
                    /*->with('socialmanagementObj', $socialmanagementObj)*/
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
            // SocialManagement::create($request->all());
        
            $socialObj = new SocialManagement;
            $socialObj->title = Input::get('title');
            $socialObj->description = Input::get('description');
            $socialObj->url = Input::get('url');
            $socialObj->isActive = Input::get('isActive');
            $socialObj->other = str_slug(Input::get('url'), "-");
            $socialObj->employee_id = Auth::id();
            $socialObj->save();

            Session::flash('flash_message', 'SocialManagement added!');

            return redirect('administrator/socialmanagement');
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
            //$socialmanagement = SocialManagement::findOrFail($id);
            $socialmanagement = SocialManagement::orderBy('socialmanagements.id', 'DESC')
                        ->leftJoin('users as eID','socialmanagements.employee_id', '=','eID.id')
                        ->select('socialmanagements.id', 'socialmanagements.title', 'socialmanagements.description', 'socialmanagements.url', 'socialmanagements.isActive', 'socialmanagements.other','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','socialmanagements.updated_at')
                        ->findOrFail($id);
            return view('administrator/socialmanagement.show', compact('socialmanagement'));
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
            $socialmanagement = SocialManagement::findOrFail($id);

            return view('administrator/socialmanagement.edit', compact('socialmanagement'));
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
            $socialmanagement = SocialManagement::findOrFail($id);
        
            $socialmanagement->title = Input::get('title');
            $socialmanagement->description = Input::get('description');
            $socialmanagement->url = Input::get('url');
            $socialmanagement->isActive = Input::get('isActive');
            $socialmanagement->other = str_slug(Input::get('title'), "-");
            $socialmanagement->employee_id = Auth::id();
            $socialmanagement->save();
           
            Session::flash('flash_message', 'SocialManagement updated!');

            return redirect('administrator/socialmanagement');
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
            SocialManagement::destroy($id);

            Session::flash('flash_message', 'SocialManagement deleted!');

            return redirect('administrator/socialmanagement');
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
