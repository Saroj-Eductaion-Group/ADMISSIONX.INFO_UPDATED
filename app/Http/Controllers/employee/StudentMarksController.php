<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StudentMark;
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
use App\Models\Category as Category;
use App\Models\StudentProfile as StudentProfile;

class StudentMarksController extends Controller
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
                                ->where('alltableinformations.name', '=', 'StudentMark')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                      //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'StudentMark')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                    $studentmarks = StudentMark::orderBy('id', 'DESC')
                        ->leftjoin('category', 'studentmarks.category_id', '=', 'category.id')
                        ->leftjoin('studentprofile', 'studentmarks.studentprofile_id', '=', 'studentprofile.id')
                        ->leftjoin('users', 'studentprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->where('users.userstatus_id','!=','5')
                        ->Paginate(20, array('studentmarks.id', 'marks','percentage','category.name as categoryName','studentprofile.parentsname','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','studentmarks.name as studentmarksName','studentMarkType','studentmarks.updated_at'));
                    
                    return View::make('employee/studentmarks.index')
                        ->with('studentmarks', $studentmarks)
                        ->with('storeEditUpdateAction', $storeEditUpdateAction)
                        ;
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
                                ->where('alltableinformations.name', '=', 'StudentMark')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $category = Category::all();
                    $studentProfile = StudentProfile::all();

                    return view('employee/studentmarks.create')
                        ->with('category',$category)
                        ->with('studentProfile', $studentProfile);
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
                /*StudentMark::create($request->all());
                Session::flash('flash_message', 'StudentMark added!');*/
                
                $marks = Input::get('marks');
                $percentage = Input::get('percentage');
                $categoryName = Input::get('categoryName');
                $studentProfileName = Input::get('studentProfileName'); 
           
                $studentMarksObj = new StudentMark;

                $studentMarksObj->marks = $marks;
                $studentMarksObj->percentage = $percentage;
                $studentMarksObj->category_id = $categoryName;
                $studentMarksObj->studentprofile_id = $studentProfileName; 
                $studentMarksObj->employee_id = Auth::id();
                $studentMarksObj->studentMarkType = Input::get('studentMarkType');
                $studentMarksObj->save();
            
                return redirect('employee/studentmarks');
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
                                ->where('alltableinformations.name', '=', 'StudentMark')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $studentmark = StudentMark::orderBy('studentmarks.id', 'ASC')
                        ->leftjoin('category', 'studentmarks.category_id', '=', 'category.id')
                        ->leftjoin('studentprofile', 'studentmarks.studentprofile_id', '=', 'studentprofile.id')
                        ->leftjoin('users', 'studentprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->select('studentmarks.id', 'marks','percentage','category.name as categoryName','studentprofile.parentsname','studentprofile.id as studentprofileId','gender', 'dateofbirth', 'parentsname', 'parentsnumber', 'hobbies', 'interests', 'achievementsawards', 'projects', 'entranceexamname', 'entranceexamnumber','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','studentmarks.name as studentmarksName','studentMarkType','studentmarks.updated_at')
                        ->findOrFail($id)
                        ;
                    //$studentmark = StudentMark::findOrFail($id);
                    return view('employee/studentmarks.show', compact('studentmark'));
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
    {//Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'StudentMark')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $studentmark = StudentMark::findOrFail($id);
                    $category = Category::all();
                    //$studentProfile = StudentProfile::all();
                    $studentProfile = DB::table('studentprofile')
                                ->join('users', 'studentprofile.users_id', '=', 'users.id')
                                ->select('studentprofile.id', 'users.id as userID','users.firstname','users.middlename','users.lastname')
                                ->where('users.userrole_id', '=', '3')
                                ->get()
                                ;


                    
                    return view('employee/studentmarks.edit', compact('studentmark'))
                    ->with('category',$category)
                    ->with('studentProfile', $studentProfile)
                    ;
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
               /* $studentmark = StudentMark::findOrFail($id);
                $studentmark->update($request->all());
                Session::flash('flash_message', 'StudentMark updated!');*/

                $marks = Input::get('marks');
                $percentage = Input::get('percentage');
                $categoryName = Input::get('categoryName');
                $studentProfileName = Input::get('studentProfileName'); 
           
                $studentMarksObj = StudentMark::findOrFail($id);

                $studentMarksObj->marks = $marks;
                $studentMarksObj->percentage = $percentage;
                $studentMarksObj->category_id = $categoryName;
                $studentMarksObj->studentprofile_id = $studentProfileName; 
                $studentMarksObj->employee_id = Auth::id();
                $studentMarksObj->studentMarkType = Input::get('studentMarkType');
                $studentMarksObj->save();
                return redirect('employee/studentmarks');
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
                                ->where('alltableinformations.name', '=', 'StudentMark')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    StudentMark::destroy($id);
                    Session::flash('flash_message', 'StudentMark deleted!');
                    return redirect('employee/studentmarks');
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
