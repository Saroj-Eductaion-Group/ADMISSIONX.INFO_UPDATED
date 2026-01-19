<?php

namespace App\Http\Controllers\student;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
use PHPMailer;
use Session;
use DateTime;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\Blog as Blog;
use App\Models\StudentProfile as StudentProfile;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\Course as Course;
use App\Models\Bookmark as Bookmark;
use App\Models\Application as Application;
use App\Models\ApplicationStatus as ApplicationStatus;
class StudentBookmarkController extends Controller
{
	public function addBookmark(Request $request)
	{
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '3' && $roleGrant->userstatus_id == '1' ){

                $bookmarkObj = new Bookmark;

                $bookmarkObj->student_id = $userId;
                
                if( !empty(Input::get('collegeProfile')) ){
                    $getCollegeProfileId = DB::table('collegeprofile')
                                        ->leftJoin('users','collegeprofile.users_id','=','users.id')
                                        ->where('slug', '=', Input::get('collegeProfile'))
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id','users.firstname')
                                        ->take(1)
                                        ->get()
                                        ;
                    
                    if( !empty($getCollegeProfileId) ){
                        $bookmarkObj->college_id = $getCollegeProfileId[0]->id;  
                        $bookmarkObj->title = $getCollegeProfileId[0]->firstname; 
                        $bookmarkObj->bookmarktypeinfo_id = '1'; 
                    }
                }

                if( !empty(Input::get('courseName')) ){
                    $getCollegeMasterId = DB::table('collegemaster')
                                        ->leftJoin('collegeprofile', 'collegemaster.collegeprofile_id','=', 'collegeprofile.id')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                        ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                        ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                        ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                        ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                        ->where('collegemaster.id', '=', Input::get('courseName'))
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegemaster.id','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','users.firstname')
                                        ->take(1)
                                        ->get()
                                        ;
                    if( !empty($getCollegeMasterId) ){
                        $bookmarkObj->course_id = $getCollegeMasterId[0]->id; 
                        $bookmarkObj->title = $getCollegeMasterId[0]->firstname.' - '.$getCollegeMasterId[0]->educationlevelName.' / '.$getCollegeMasterId[0]->functionalareaName.' / '.$getCollegeMasterId[0]->degreeName.' / '.$getCollegeMasterId[0]->courseName.' / '.$getCollegeMasterId[0]->coursetypeName; 
                        $bookmarkObj->bookmarktypeinfo_id = '2';       
                    }
                }

                 if( !empty(Input::get('blogName')) ){

                    $getBlogsId = DB::table('blogs')
                                        ->where('slug', '=', Input::get('blogName'))
                                        ->select('id','topic')
                                        ->take(1)
                                        ->get()
                                        ;
                    if( !empty($getBlogsId) ){
                        $bookmarkObj->blog_id = $getBlogsId[0]->id; 
                        $bookmarkObj->title = $getBlogsId[0]->topic; 
                        $bookmarkObj->bookmarktypeinfo_id = '3';       
                    }
                }

                if( !empty(Input::get('url')) ){
                    $bookmarkObj->url = Input::get('url');    
                }
                $bookmarkObj->employee_id = Auth::id();
                $bookmarkObj->save();

                //GET LATEST ID
                $getLatestBookMarkId = DB::table('bookmarks')
                                        ->where('student_id', '=', $userId)
                                        ->select('id')
                                        ->orderBy('id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;
                if(!empty($getLatestBookMarkId)){
                    $bookmarkedID = $getLatestBookMarkId[0]->id;
                }else{
                    $bookmarkedID = '';
                }

                $dataArray = array(
                        'code' => '200',
                        'response' => 'success',                
                        'otherUser' => '',
                        'message' => '',
                        'bookmarkedID' => $bookmarkedID,
                    );
                return response()->json($dataArray);

            }elseif( $roleGrant->userrole_id == '2' && $roleGrant->userstatus_id == '1' ) {
                
                $dataArray = array(
                        'code' => '200',
                        'response' => 'success',                
                        'otherUser' => '210',
                        'message' => 'This feature is only available for students.',
                        'bookmarkedID' => '',
                    );
                return response()->json($dataArray);
            }elseif( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ) {
                
                $dataArray = array(
                        'code' => '200',
                        'response' => 'success',                
                        'otherUser' => '210',
                        'message' => 'This feature is only available for students.',
                        'bookmarkedID' => '',
                    );
                return response()->json($dataArray);
            }else{
                $dataArray = array(
                        'code' => '200',
                        'response' => 'success',                
                        'otherUser' => '210',
                        'message' => 'This feature is only available for students.',
                        'bookmarkedID' => '',
                    );
                return response()->json($dataArray);
            }
        }else{
           $dataArray = array(
                        'code' => '401',
                    'response' => 'failure',                
                    'otherUser' => '',
                    'message' => '',
                    'bookmarkedID' => '',
                );
            return response()->json($dataArray);
        }   
        
	}


    public function getBookmarkCoursePartials(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            $getBookmarkCourseData = DB::table('bookmarks')
                                    ->where('bookmarks.student_id', '=', $userId)
                                    ->where('bookmarks.url', '!=', '')
                                    ->where('bookmarks.college_id', '=', '0')
                                    ->where('bookmarks.blog_id', '=', '0')
                                    ->select('id','url')
                                    ->orderBy('bookmarks.id', 'DESC')
                                    ->get()
                                    ;
            if( empty($getBookmarkCourseData) ){
                $getBookmarkCourseData = '';
            }
            /* return view('student/dashboard.getBookmarkCoursePartials')
            ->with('getBookmarkCourseData',$getBookmarkCourseData);*/
            $htmlBlock = view('student/dashboard.getBookmarkCoursePartials')
                        ->with('getBookmarkCourseData', $getBookmarkCourseData)
                        ->with('slugUrl', $request->slug)
                        ->render();
            return response()->json($htmlBlock);
        }else{
            //Auth::logout(); // logout user
            //return Redirect::to('login'); //redirect back to login
        }
    }

    public function getBookmarkCollegePartials(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            $getBookmarkCollegeData = DB::table('bookmarks')
                                    ->where('bookmarks.student_id', '=', $userId)
                                    ->where('bookmarks.url', '!=', '')
                                    ->where('bookmarks.college_id', '!=', '0')
                                    ->where('bookmarks.blog_id', '=', '0')
                                    ->select('id','url')
                                    ->orderBy('bookmarks.id', 'DESC')
                                    ->get()
                                    ;
            if( empty($getBookmarkCollegeData) ){
                $getBookmarkCollegeData = '';
            }

            $htmlBlock = view('student/dashboard.getBookmarkCollegePartials')
                        ->with('getBookmarkCollegeData', $getBookmarkCollegeData)
                        ->with('slugUrl', $request->slug)
                        ->render();
            return response()->json($htmlBlock);
        }else{
            //Auth::logout(); // logout user
            //return Redirect::to('login'); //redirect back to login
        }
    }

    public function getBookmarkBlogsPartials(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            $getBookmarkBlogData = DB::table('bookmarks')
                                    ->where('bookmarks.student_id', '=', $userId)
                                    ->where('bookmarks.url', '!=', '')
                                    ->where('bookmarks.college_id', '=', '0')
                                    ->where('bookmarks.blog_id', '!=', '0')
                                    ->select('id','url')
                                    ->orderBy('bookmarks.id', 'DESC')
                                    ->get()
                                    ;
            if( empty($getBookmarkBlogData) ){
                $getBookmarkBlogData = '';
            }

            $htmlBlock = view('student/dashboard.getBookmarkBlogsPartials')
                        ->with('getBookmarkBlogData', $getBookmarkBlogData)
                        ->with('slugUrl', $request->slug)
                        ->render();
            return response()->json($htmlBlock);
        }else{
            //Auth::logout(); // logout user
            //return Redirect::to('login'); //redirect back to login
        }
    }

    public function checkStudentApplications(Request $request, $option)
    {   
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '3' && $checkRole->userstatus_id == '1' ){

                $conditionQuery = '';
                if( $option == 'accepted' ){
                    $conditionQuery = '1';
                }elseif( $option == 'pending' ){
                    $conditionQuery = '2';
                }elseif( $option == 'rejected'){
                    $conditionQuery = '3';
                }else{
                    $conditionQuery = "1,2,3,4";
                }


                //GET AUTH AS PER Student PROFILE
                $getStudentProfileObj = DB::table('users')
                                        ->join('studentprofile', 'users.id', '=', 'studentprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.firstname','users.lastname','users.middlename', 'studentprofile.slug')
                                        ->take(1)
                                        ->get()
                                        ;
                

                //Get All Applications Related to Student Profile
                $getStudentApplicationsDataObj = Application::orderBy('application.id', 'DESC')
                                        ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                                        ->leftJoin('users as studentUser', 'application.users_id','=', 'studentUser.id')
                                        ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                        ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                                        ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                        ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                        ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                        ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                        ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                        ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                                        ->leftJoin('paymentstatus', 'application.paymentstatus_id', '=', 'paymentstatus.id')
                                        ->whereRaw("applicationstatus.id IN (".$conditionQuery.")")
                                        ->where('studentUser.id', '=', Auth::id())
                                        ->where('collegeUser.userstatus_id', '!=', '5')
                                        ->where('studentUser.userstatus_id', '!=', '5')
                                        ->paginate(20, array('application.id', 'application.name','applicationstatus.id as applicationstatusId','applicationstatus.name as applicationstatusName', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob', 'application.email', 'application.phone', 'application.gender', 'application.percent10', 'application.marksheet10', 'application.percent11', 'application.marksheet11', 'application.percent12', 'application.marksheet12', 'application.parentname', 'application.parentnumber', 'application.parentidproof', 'application.hobbies', 'application.interest', 'application.awards', 'application.projects', 'iagreeparents', 'iagreeform', 'totalfees', 'byafees', 'restfees','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','collegeprofile.slug as collegeSlug', 'application.created_at','paymentstatus.id as paymentstatusID','paymentstatus.name as paymentstatusName','application.applicationID', 'application.graduationPercent', 'application.graduationMarksheet'))
                                        ;

                foreach ($getStudentApplicationsDataObj as $key => $value) {
                    # code...
                    $value->encryptApplicationId = \Illuminate\Support\Facades\Crypt::encrypt($value->id);
                }

                $getApplicationsDataObj1 = Application::orderBy('application.id', 'DESC')
                                        ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                                        ->leftJoin('users as studentUser', 'application.users_id','=', 'studentUser.id')
                                        ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                        ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                                        ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                        ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                        ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                        ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                        ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                        ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                        ->leftjoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                                        ->leftJoin('paymentstatus', 'application.paymentstatus_id', '=', 'paymentstatus.id')
                                        ->whereRaw("applicationstatus.id IN (".$conditionQuery.")")
                                        ->where('studentUser.id', '=', Auth::id())
                                        ->where('collegeUser.userstatus_id', '!=', '5')
                                        ->where('studentUser.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
                
                if( $getApplicationsDataObj1 == '0' ){
                    $getStudentApplicationsDataObj = '';
                }
               // print_r($getStudentApplicationsDataObj);die;
                return view('student/application.studentApplication')
                        ->with('getStudentProfileObj', $getStudentProfileObj)
                        ->with('getStudentApplicationsDataObj', $getStudentApplicationsDataObj)
                        ;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('/'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/'); //r))edirect back to login
        }
    }

    public function detailsStudentApplications(Request $request, $slug, $applicationId)
    {
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '3' && $checkRole->userstatus_id == '1' ){
                $decryptApplicationId = \Illuminate\Support\Facades\Crypt::decrypt($applicationId);
                //GET AUTH AS PER COLLEGE PROFILE
                $getStudentProfileObj = DB::table('users')
                                        ->join('studentprofile', 'users.id', '=', 'studentprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('studentprofile.slug', '=', $slug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.firstname','users.lastname','users.middlename', 'studentprofile.slug')
                                        ->take(1)
                                        ->get()
                                        ;
                
                //Get All Applications Related to College Profile
                $getApplicationsDataObj = DB::table('application')
                                            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                                            ->leftJoin('users as studentUser', 'application.users_id','=', 'studentUser.id')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                            ->leftjoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                                            ->leftJoin('paymentstatus', 'application.paymentstatus_id', '=', 'paymentstatus.id')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('application.id', '=', $decryptApplicationId)
                                            ->where('collegeUser.userstatus_id', '!=', '5')
                                            ->where('studentUser.userstatus_id', '!=', '5')
                                            ->groupBy('application.id')
                                            ->orderBy('application.id','DESC')
                                            ->select('application.id', 'application.created_at','application.name','applicationstatus.id as applicationstatusId','applicationstatus.name as applicationstatusName', 'studentUser.id as studentUserID','studentUser.email as studentEmail','studentUser.phone as studentPhone', 'studentUser.firstname as studentUserFirstName','studentUser.middlename as studentUserMiddleName', 'studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob', 'application.email', 'application.phone', 'application.gender', 'application.percent10', 'application.marksheet10', 'application.percent11', 'application.marksheet11', 'application.percent12', 'application.marksheet12', 'application.parentname', 'application.parentnumber', 'application.parentidproof', 'application.hobbies', 'application.interest', 'application.awards', 'application.projects', 'iagreeparents', 'iagreeform', 'totalfees', 'byafees', 'restfees','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','collegeprofile.slug as collegeSlug','paymentstatus.id as paymentstatusID','paymentstatus.name as paymentstatusName', 'application.graduationPercent', 'application.graduationMarksheet')
                                            ->get()
                                            ;

                foreach ($getApplicationsDataObj as $key => $value) {
                    $value->encryptApplicationId = \Illuminate\Support\Facades\Crypt::encrypt($value->id);
                }

                //$getApplicationStatusObj = ApplicationStatus::all();
                 $getApplicationStatusObj = DB::table('applicationstatus')
                                            ->whereIn('applicationstatus.id', array( 4))
                                            ->select('applicationstatus.id','applicationstatus.name')
                                            ->get()
                                            ;

                return view('student/application.detail-studentApplication')    
                        ->with('slug', $slug)
                        ->with('applicationId', $applicationId)
                        ->with('getStudentProfileObj', $getStudentProfileObj)
                        ->with('getApplicationsDataObj', $getApplicationsDataObj)
                        ->with('getApplicationStatusObj', $getApplicationStatusObj)
                        ;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('/'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/'); //r))edirect back to login
        }
    }


    public function checkStudentBookmark(Request $request, $option)
    {   
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '3' && $checkRole->userstatus_id == '1' ){

                $conditionQuery = '';
                if( $option == 'colleges' ){
                    $conditionQuery = '1';
                }elseif( $option == 'courses' ){
                    $conditionQuery = '2';
                }elseif( $option == 'blog'){
                    $conditionQuery = '3';
                }else{
                    $conditionQuery = "1,2,3";
                }

                //GET AUTH AS PER Student PROFILE
                $getStudentProfileObj = DB::table('users')
                                        ->join('studentprofile', 'users.id', '=', 'studentprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->select('users.firstname','users.lastname','users.middlename', 'studentprofile.slug')
                                        ->take(1)
                                        ->get()
                                        ;
                //Get All Applications Related to Student Profile
                $getStudentBookmarkDataObj = Bookmark::orderBy('bookmarks.id', 'DESC')
                                        ->leftJoin('bookmarktypeinfos', 'bookmarks.bookmarktypeinfo_id', '=', 'bookmarktypeinfos.id')
                                        ->where('bookmarks.student_id', '=', Auth::id())
                                        ->whereRaw("bookmarks.bookmarktypeinfo_id IN (".$conditionQuery.")")
                                        ->paginate(20, array('bookmarks.id', 'bookmarks.title','bookmarks.url', 'bookmarks.created_at', 'bookmarktypeinfos.name as bookmarktypeinfoName'))
                                        ;

                $getBookmarkDataObj1 = Bookmark::orderBy('bookmarks.id', 'DESC')
                                        ->where('bookmarks.student_id', '=', Auth::id())
                                        ->whereRaw("bookmarks.bookmarktypeinfo_id IN (".$conditionQuery.")")
                                        ->count()
                                        ;
                
                if( $getBookmarkDataObj1 == '0' ){
                    $getStudentBookmarkDataObj = '';
                }
              
                return view('student/bookmark.studentBookmark')
                        ->with('option', $option)
                        ->with('getStudentProfileObj', $getStudentProfileObj)
                        ->with('getStudentBookmarkDataObj', $getStudentBookmarkDataObj)
                        ;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('/'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/'); //r))edirect back to login
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function deleteBookmark($id)
    {   
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '3' && $roleGrant->userstatus_id == '1' ){
                Bookmark::destroy($id);
                Session::flash('flash_message', 'Bookmark deleted!');
                return Redirect::back();
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function removeSelectedBookmarked(Request $request)
    {
        if (Auth::check())
        {
            Bookmark::destroy(Input::get('bookmarkedID'));
            $dataArray = array(
                        'code' => '200',
                        'response' => 'success',
                    );            
        }else{
            $dataArray = array(
                        'code' => '401',
                        'response' => 'failure',
                    );            
        }   
        return response()->json($dataArray);
    }
    
}
