<?php

namespace App\Http\Controllers\administrator;

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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){

                $studentmarks = StudentMark::orderBy('id', 'DESC')
                        ->leftjoin('category', 'studentmarks.category_id', '=', 'category.id')
                        ->leftjoin('studentprofile', 'studentmarks.studentprofile_id', '=', 'studentprofile.id')
                        ->leftjoin('users', 'studentprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->where('users.userstatus_id','!=','5')
                        ->Paginate(20, array('studentmarks.id', 'marks','percentage','category.name as categoryName','studentprofile.parentsname','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','studentmarks.name as studentmarksName','studentMarkType','studentmarks.updated_at'));
                    
                return View::make('administrator/studentmarks.index')
                    ->with('studentmarks', $studentmarks)
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

                $category = Category::all();
                $studentProfile = DB::table('users')
                                    ->leftJoin('studentprofile', 'users.id', '=','studentprofile.users_id')
                                    ->where('users.userstatus_id', '=', '1')
                                    ->where('users.userrole_id', '=', '3')
                                    ->select('studentprofile.id','users.firstname', 'users.middlename', 'users.lastname')
                                    ->get()
                                    ;
                
                return view('administrator/studentmarks.create')
                ->with('category',$category)
                ->with('studentProfile', $studentProfile);
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
            
                return redirect('administrator/studentmarks');
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

                $studentmark = StudentMark::orderBy('studentmarks.id', 'ASC')
                        ->leftjoin('category', 'studentmarks.category_id', '=', 'category.id')
                        ->leftjoin('studentprofile', 'studentmarks.studentprofile_id', '=', 'studentprofile.id')
                        ->leftjoin('users', 'studentprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->select('studentmarks.id', 'marks','percentage','category.name as categoryName','studentprofile.parentsname','studentprofile.id as studentprofileId','gender', 'dateofbirth', 'parentsname', 'parentsnumber', 'hobbies', 'interests', 'achievementsawards', 'projects', 'entranceexamname', 'entranceexamnumber','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','studentmarks.name as studentmarksName','studentMarkType','studentmarks.updated_at')
                        ->findOrFail($id)
                        ;
                //$studentmark = StudentMark::findOrFail($id);
                return view('administrator/studentmarks.show', compact('studentmark'));
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                $studentmark = StudentMark::findOrFail($id);
                $category = Category::all();
                //$studentProfile = StudentProfile::all();

                $studentProfile = DB::table('studentprofile')
                                ->join('users', 'studentprofile.users_id', '=', 'users.id')
                                ->select('studentprofile.id', 'users.id as userID','users.firstname','users.middlename','users.lastname')
                                ->where('users.userrole_id', '=', '3')
                                ->get()
                                ;

                return view('administrator/studentmarks.edit', compact('studentmark'))
                ->with('category',$category)
                ->with('studentProfile', $studentProfile)
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
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
                return redirect('administrator/studentmarks');
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
                StudentMark::destroy($id);
                Session::flash('flash_message', 'StudentMark deleted!');
                return redirect('administrator/studentmarks');
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
