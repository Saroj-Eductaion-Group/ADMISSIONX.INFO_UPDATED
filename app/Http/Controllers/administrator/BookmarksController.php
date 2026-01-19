<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Bookmark;
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
use App\Models\Blog as Blog;
use App\Models\StudentProfile as StudentProfile;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\Course as Course;

class BookmarksController extends Controller
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

                $bookmarks = Bookmark::orderBy('id', 'DESC')
                        ->leftJoin('users as u1', 'bookmarks.student_id', '=', 'u1.id')
                        ->leftJoin('studentprofile', 'u1.id', '=', 'studentprofile.users_id')
                        ->leftJoin('userrole as ur1', 'u1.userrole_id', '=', 'ur1.id')
                        ->leftJoin('collegeprofile', 'bookmarks.college_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as u2', 'collegeprofile.users_id', '=', 'u2.id')
                        ->leftJoin('userrole as ur2', 'u2.userrole_id', '=', 'ur2.id')
                        ->leftJoin('collegemaster', 'bookmarks.course_id', '=', 'collegemaster.id')
                        ->leftjoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                        ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                        ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                        ->leftjoin('coursetype', 'collegemaster.coursetype_id', '=', 'coursetype.id')
                        ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                        ->leftJoin('blogs', 'bookmarks.blog_id', '=', 'blogs.id')
                        ->leftJoin('users as eID','bookmarks.employee_id', '=','eID.id')
                        ->paginate(15, array('bookmarks.id', 'u1.id as userId1','u1.firstname as u1firstname', 'u1.lastname as u1lastname', 'ur1.name as ur1UserRoleName', 'u2.id as userId2','u2.firstname as u2firstname', 'u2.lastname as u2lastname', 'ur2.name as url2UserRoleName','course.name as courseName','blogs.topic','blogs.id as blogsID','collegeprofile.id as collegeprofileId','studentprofile.id as studentprofileId','collegemaster.id as collegemasterID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','bookmarks.updated_at'))
                        ;

                //$bookmarks = Bookmark::paginate(15);
                return view('administrator/bookmarks.index', compact('bookmarks'))
                ->with('bookmarks',$bookmarks);
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

                $blog = Blog::all();
               // $studentProfile = StudentProfile::all();
                //$collegeProfile = CollegeProfile::all();
                $course = Course::all();
                $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
                return view('administrator/bookmarks.create')
                ->with('blog',$blog)
                ->with('usersObj',$usersObj)
                ->with('course',$course);
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
                /*Bookmark::create($request->all());
                Session::flash('flash_message', 'Bookmark added!');*/

                $studentProfile = Input::get('studentProfile');

                if( !empty(Input::get('collegeProfile')) ){
                    $collegeProfile = Input::get('collegeProfile');    
                }else{
                    $collegeProfile = '';
                }
                

                if( !empty(Input::get('courseName')) ){
                    $courseName = Input::get('courseName');
                }else{
                    $courseName = '';
                }

                if( !empty(Input::get('blogName')) ){
                    $blogName = Input::get('blogName'); 
                }else{
                    $blogName = ''; 
                }
                
                
           
                $bookmarkObj = new Bookmark;

                $bookmarkObj->student_id = $studentProfile;
                $bookmarkObj->college_id = $collegeProfile;
                $bookmarkObj->course_id = $courseName;
                $bookmarkObj->blog_id = $blogName; 
                $bookmarkObj->employee_id = Auth::id();
                $bookmarkObj->save();

                return redirect('administrator/bookmarks');
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
                //$bookmark = Bookmark::findOrFail($id);
                 $bookmark = Bookmark::orderBy('id', 'DESC')
                        ->leftJoin('users as u1', 'bookmarks.student_id', '=', 'u1.id')
                        ->leftJoin('studentprofile', 'u1.id', '=', 'studentprofile.users_id')
                        ->leftJoin('userrole as ur1', 'u1.userrole_id', '=', 'ur1.id')
                        ->leftJoin('collegeprofile', 'bookmarks.college_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as u2', 'collegeprofile.users_id', '=', 'u2.id')
                        ->leftJoin('userrole as ur2', 'u2.userrole_id', '=', 'ur2.id')
                        ->leftJoin('collegemaster', 'bookmarks.course_id', '=', 'collegemaster.id')
                        ->leftjoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                        ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                        ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                        ->leftjoin('coursetype', 'collegemaster.coursetype_id', '=', 'coursetype.id')
                        ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                        ->leftJoin('blogs', 'bookmarks.blog_id', '=', 'blogs.id')
                        ->leftJoin('users as eID','bookmarks.employee_id', '=','eID.id')
                        ->select('bookmarks.id', 'u1.id as userId1','u1.firstname as u1firstname', 'u1.lastname as u1lastname', 'ur1.name as ur1UserRoleName', 'u2.id as userId2','u2.firstname as u2firstname', 'u2.lastname as u2lastname', 'ur2.name as url2UserRoleName','course.name as courseName','blogs.id as blogsID','blogs.topic','collegeprofile.id as collegeprofileId','studentprofile.id as studentprofileId','collegemaster.id as collegemasterID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','bookmarks.updated_at')
                        ->findOrFail($id)
                        ;
                return view('administrator/bookmarks.show', compact('bookmark'))
                ->with('$bookmark',$bookmark);
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
                $bookmark = Bookmark::findOrFail($id);
                $blog = Blog::all();
                $course = Course::all();

               $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

                return view('administrator/bookmarks.edit', compact('bookmark'))
                ->with('blog',$blog)
                ->with('usersObj',$usersObj)
                ->with('course',$course);
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
               /* $bookmark = Bookmark::findOrFail($id);
                $bookmark->update($request->all());
                Session::flash('flash_message', 'Bookmark updated!');*/

                $studentProfile = Input::get('studentProfileName');
                $collegeProfile = Input::get('collegeProfile');
                $courseName = Input::get('courseName');
                $blogName = Input::get('blogName'); 
           
                $bookmarkObj = Bookmark::findOrFail($id);

                $bookmarkObj->student_id = $studentProfile;
                $bookmarkObj->college_id = $collegeProfile;
                $bookmarkObj->course_id = $courseName;
                $bookmarkObj->blog_id = $blogName; 
                $bookmarkObj->employee_id = Auth::id();
                $bookmarkObj->save();
                return redirect('administrator/bookmarks');
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
                Bookmark::destroy($id);
                Session::flash('flash_message', 'Bookmark deleted!');
                return redirect('administrator/bookmarks');
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
