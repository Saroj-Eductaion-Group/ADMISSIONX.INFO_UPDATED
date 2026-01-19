<?php

namespace App\Http\Controllers\query\college;

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
use Session;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\StudentProfile;
use App\Models\Query;
use App\Http\Controllers\Helper\FetchDataServiceController;

class QueryCollegeController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

	public function studentForCollege(Request $request)
    {
    	if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        		$queryObj = New Query();
            
    	        if( !empty(Input::get('subject')) ){
    	            $queryObj->subject = Input::get('subject');    
    	        }

    	        if( !empty(Input::get('message')) ){
    	            $queryObj->message = Input::get('message');    
    	        }

    	        if( !empty(Input::get('slugUrl')) ){
    	        	//GET THE COLLEGE PROFILE ID
    	        	$getCollegeProfieId = DB::table('collegeprofile')
    	        							->join('users', 'collegeprofile.users_id','=','users.id')
    	        							->where('collegeprofile.slug', '=', Input::get('slugUrl'))
            								->select('collegeprofile.id','users.email')
            								->orderBy('id', 'DESC')
            								->take(1)
            								->get()
            								;
            		$collegeEmailId = $getCollegeProfieId[0]->email;
    	            $queryObj->college_id = $getCollegeProfieId[0]->id;
    	        }

    	        //GET THE ROELS AS PER ID
    	        $getTheRolesID = DB::table('users')->where('id', '=', Auth::id())->select('id', 'email', 'userrole_id')->take(1)->get();

    	        if( $getTheRolesID[0]->userrole_id == '3' ){
            		$queryObj->student_id = Auth::id();
    	        }elseif( $getTheRolesID[0]->userrole_id == '1' ){
            		$queryObj->admin_id = Auth::id();
    	        }else{

    	        }

    	        $queryObj->queryflowtype = 'student-to-college';
                $queryObj->chatkey = uniqid();	        
                $queryObj->querytypeinfo = 'pending';
                $queryObj->employee_id = Auth::id();
    	        $queryObj->save();


    	        //GET EMAIL ADDRESS FOR ADMIN
    	        //GET THE ROELS AS PER ID
    	        $getTheEmailAdmin = DB::table('users')->where('userrole_id', '=', '1')->where('users.userstatus_id','=', '1')->select('email')->get();
            	//$adminEmailId = $getTheEmailAdmin[0]->email;
               
                if( !empty(Input::get('message')) ){
                    $messageText = Input::get('message');    
                }

                if( !empty(Input::get('subject')) ){
                    $subjectText = Input::get('subject');    
                }

                $adminEmailId = array();
                foreach ($getTheEmailAdmin as $key => $value) {
                    $adminEmailId = $value->email;
                   // $adminEmailId[] = $tempArrayEmailId;

                    try {
                       
                        if(!empty($adminEmailId) && ($this->fetchDataServiceController->isValidEmail($adminEmailId) == 1))
                        {
                           /**Swift Mailer Data TO admin_id***/        
                            \Mail::send('emailtemplate/query-emails.queryToCollege', array('email' => $adminEmailId, 'messageDataText'=> $messageText ,'subjectDataText' => $subjectText ), function($message) use ($adminEmailId)
                            {
                                $message->to($adminEmailId, 'AdmissionX')->subject('You got a new query - admin');
                            });  
                        }
                    }catch ( \Swift_TransportException $e) {                
                    }
                }

            	try {
    				
    		        if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
    	            {
    	                    /**Swift Mailer TO COLLEGE***/        
    	                    \Mail::send('emailtemplate/query-emails.queryToCollege', array('email' => $collegeEmailId,'messageDataText'=> $messageText ,'subjectDataText' => $subjectText), function($message) use ($collegeEmailId)
    	                    {
    	                        $message->to($collegeEmailId, 'AdmissionX')->subject('You got a new query - college');
    	                    });  
    	            } 

    	        }catch ( \Swift_TransportException $e) {                
    			}

                try {
                    
                    if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
                    {
                            /**Swift Mailer TO COLLEGE***/        
                            \Mail::send('emailtemplate/query-emails.queryToCollegeByStudent', array('email' => $collegeEmailId), function($message) use ($collegeEmailId)
                            {
                                $message->to($collegeEmailId, 'AdmissionX')->subject('You got a new query - college');
                            });  
                    } 

                }catch ( \Swift_TransportException $e) {                
                }

	            Session::flash('collegeQueryForm', 'Your query form has been submitted successfully!. One of our representatives will be in contact with you shortly regarding your inquiry.');
                return Redirect::back();
            }elseif( $roleGrant->userrole_id != '3'){
                Session::flash('collegeQueryForm', 'This feature is only available for students account.'); 
                return Redirect::back();
            }else{
                Session::flash('collegeQueryForm', 'Please login & fill this form. This feature is only available for students account!'); 
                return Redirect::back();
            }
		}else{
            Session::flash('collegeQueryForm', 'Please login & fill this form. This feature is only available for students account!'); 
            return Redirect::back();
			// Auth::logout();
			// return Redirect::to('login');
		}        
    }

    public function checkQueriesForCollege(Request $request, $slug)
    {
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '2' && $checkRole->userstatus_id == '1' ){
                //GET AUTH AS PER COLLEGE PROFILE
                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->select('users.firstname')
                                        ->take(1)
                                        ->get()
                                        ;
                

                //Get All Applications Related to College Profile
                $getQueryCollegeDataObj = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.queryflowtype', '=', 'student-to-college')
                                            ->groupBy('query.chatkey')
                                            ->paginate(20, array('query.id', 'query.created_at', 'query.message', 'query.subject', 'query.chatkey', 'query.chatkey'))
                                            ;

                $getQueryCollegeDataObj1 = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->groupBy('query.id')
                                            ->count()
                                            ;
                
                if( $getQueryCollegeDataObj1 == '0' ){
                    $getQueryCollegeDataObj = '';
                }

                 //Get All Applications Related to College Profile
                $getQueryAdminCollegeDataObj = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.queryflowtype', '=', 'college-to-admin')
                                            ->where('query.admin_id', '!=', '0')
                                            ->groupBy('query.chatkey')
                                            ->paginate(20, array('query.id', 'query.created_at', 'query.message', 'query.subject', 'query.chatkey', 'query.chatkey'))
                                            ;

                $getQueryAdminCollegeDataObj1 = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.admin_id', '!=', '0')
                                            ->groupBy('query.id')
                                            ->count()
                                            ;                                            
                //print_r($getQueryAdminCollegeDataObj1);die;
                if( $getQueryAdminCollegeDataObj1 == '0' ){
                    $getQueryAdminCollegeDataObj = '';
                }

                return view('college/query.index-query')    
                        ->with('slug', $slug)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)
                        ->with('getQueryCollegeDataObj', $getQueryCollegeDataObj)
                        ->with('getQueryAdminCollegeDataObj', $getQueryAdminCollegeDataObj)
                        ->with('getQueryCollegeDataObj1', $getQueryCollegeDataObj1)
                        ->with('getQueryAdminCollegeDataObj1', $getQueryAdminCollegeDataObj1)

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

    public function checkQueriesForCollegeStatus(Request $request, $option)
    {
        if(Auth::check()){

                $conditionQuery = '';
                if( $option == 'replied' ){
                    $conditionQuery = 'replied';
                }elseif( $option == 'pending' ){
                    $conditionQuery = 'pending';
                }else{
                    $conditionQuery = "replied','pending";
                }


                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.users_id', '=', Auth::id())
                                        ->select('users.firstname','collegeprofile.slug')
                                        ->take(1)
                                        ->get()
                                        ;
                $slug = $getCollegeProfileObj[0]->slug;

                //Get All Applications Related to College Profile
                $getQueryCollegeDataObj = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.admin_id', '=', '0')
                                            ->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
                                            ->where('query.queryflowtype', '=', 'student-to-college')
                                            ->groupBy('query.chatkey')
                                            ->paginate(20, array('query.id', 'query.created_at', 'query.message', 'query.subject', 'query.chatkey', 'query.chatkey','querytypeinfo'))
                                            ;

                $getQueryCollegeDataObj1 = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.admin_id', '=', '0')
                                            ->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
                                            ->groupBy('query.id')
                                            ->count()
                                            ;
                
                if( $getQueryCollegeDataObj1 == '0' ){
                    $getQueryCollegeDataObj = '';
                }
                

                //Get All Applications Related to College Profile
                $getQueryAdminCollegeDataObj = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.queryflowtype', '=', 'college-to-admin')
                                            ->where('query.admin_id', '!=', '0')
                                            ->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
                                            ->groupBy('query.chatkey')
                                            ->paginate(20, array('query.id', 'query.created_at', 'query.message', 'query.subject', 'query.chatkey', 'query.chatkey','querytypeinfo'))
                                            ;

                $getQueryAdminCollegeDataObj1 = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.admin_id', '!=', '0')
                                            ->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
                                            ->groupBy('query.id')
                                            ->count()
                                            ;
                //print_r($getQueryAdminCollegeDataObj1);die;
                if( $getQueryAdminCollegeDataObj1 == '0' ){
                    $getQueryAdminCollegeDataObj = '';
                }

             return view('college/query.index-query')    
                        ->with('slug', $slug)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)
                        ->with('getQueryCollegeDataObj', $getQueryCollegeDataObj)
                        ->with('getQueryAdminCollegeDataObj', $getQueryAdminCollegeDataObj)
                        ->with('option', $option)
                        ;
        }else{
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function queryDetailForCollege(Request $request, $slug, $queryId)
    {
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '2' && $checkRole->userstatus_id == '1' ){
                //GET AUTH AS PER COLLEGE PROFILE
                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->select('users.firstname')
                                        ->take(1)
                                        ->get()
                                        ;
                

                //Get All Applications Related to College Profile
                $getQueryCollegeDataObj = DB::table('query')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                           
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.id', '=', $queryId)
                                            ->groupBy('query.id')
                                            ->orderBy('query.id','DESC')
                                            ->select('query.id', 'query.created_at', 'query.message', 'query.subject', 'query.chatkey', 'query.queryflowtype')
                                            ->get()
                                            ;

                $getQueryDataForReplies = DB::table('query')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                           
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.chatkey', '=', $getQueryCollegeDataObj[0]->chatkey)
                                            ->select('query.id', 'query.created_at', 'query.message', 'query.subject', 'query.chatkey', 'query.queryflowtype')
                                            ->groupBy('query.id')
                                            ->orderBy('query.id','ASC')
                                            ->limit(500)
                                            ->offset(1)
                                            ->get()
                                            ;

                return view('college/query.details-query')    
                        ->with('slug', $slug)
                        ->with('queryId', $queryId)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)
                        ->with('getQueryCollegeDataObj', $getQueryCollegeDataObj)
                        ->with('getQueryDataForReplies', $getQueryDataForReplies)
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

    public function updateCommentQuery(Request $request)
    {
        $chatkey = Input::get('chatkey');
        $message = Input::get('message');

        //GET OLD QUERY INFO
        $getOldQueryInfo = DB::table('query')
                            ->leftJoin('collegeprofile', 'collegeprofile.id','=', 'query.college_id')
                            ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->leftJoin('users as u1', 'query.student_id', '=', 'u1.id')
                            ->where('chatkey', '=', $chatkey)
                            ->select('query.id', 'admin_id', 'college_id', 'student_id', 'queryflowtype', 'replytoid', 'chatkey','users.firstname','u1.email as studentEmail')
                            ->orderBy('query.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;

        $collegeName = $getOldQueryInfo[0]->firstname;
        $studentEmailId = $getOldQueryInfo[0]->studentEmail;
        //UPDATE REPLYTOID IN OLD ENTRY
        $updateOldQueryReply = Query::findOrFail($getOldQueryInfo[0]->id);

        $updateOldQueryReply->replytoid = $getOldQueryInfo[0]->id;
        $updateOldQueryReply->querytypeinfo = 'replied';
        $updateOldQueryReply->employee_id = Auth::id();
        $updateOldQueryReply->save();

        $createQueryReply = New Query();

        $createQueryReply->message = $message;
        $createQueryReply->admin_id = $getOldQueryInfo[0]->admin_id;
        $createQueryReply->college_id = $getOldQueryInfo[0]->college_id;
        $createQueryReply->student_id = $getOldQueryInfo[0]->student_id;
        $createQueryReply->queryflowtype = 'college-to-student';
        $createQueryReply->replytoid = $getOldQueryInfo[0]->id;
        $createQueryReply->chatkey = $chatkey;
        $createQueryReply->querytypeinfo = 'replied';
        $createQueryReply->employee_id = Auth::id();
        $createQueryReply->save();

        try {
            if(!empty($studentEmailId) && ($this->fetchDataServiceController->isValidEmail($studentEmailId) == 1))
            {
                    /**Swift Mailer TO Student***/        
                    \Mail::send('emailtemplate/query-emails.replyToStudentByCollege', array('email' => $studentEmailId,'collegeName'=>$collegeName), function($message) use ($studentEmailId)
                    {
                        $message->to($studentEmailId, 'AdmissionX')->subject('Query reply from college');
                    });  
            } 
        }catch ( \Swift_TransportException $e) {                
        }

        return Redirect::back();
    }

    public function queryDetailForByaAdmin(Request $request, $slug, $queryId)
    {
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '2' && $checkRole->userstatus_id == '1' ){
                //GET AUTH AS PER COLLEGE PROFILE
                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->select('users.firstname')
                                        ->take(1)
                                        ->get()
                                        ;
                

                //Get All Applications Related to College Profile
                $getQueryCollegeDataObj = DB::table('query')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                           
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.id', '=', $queryId)
                                            ->groupBy('query.id')
                                            ->orderBy('query.id','DESC')
                                            ->select('query.id', 'query.created_at', 'query.message', 'query.subject', 'query.chatkey', 'query.queryflowtype')
                                            ->get()
                                            ;

                $getQueryDataForReplies = DB::table('query')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                           
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('query.chatkey', '=', $getQueryCollegeDataObj[0]->chatkey)
                                            ->select('query.id', 'query.created_at', 'query.message', 'query.subject', 'query.chatkey', 'query.queryflowtype')
                                            ->groupBy('query.id')
                                            ->orderBy('query.id','ASC')
                                            ->limit(500)
                                            ->offset(1)
                                            ->get()
                                            ;

                return view('college/query.details-query-bya-admin')  
                        ->with('slug', $slug)
                        ->with('queryId', $queryId)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)
                        ->with('getQueryCollegeDataObj', $getQueryCollegeDataObj)
                        ->with('getQueryDataForReplies', $getQueryDataForReplies)
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

    public function updateCommentQueryToBya(Request $request)
    {
        $chatkey = Input::get('chatkey');
        $message = Input::get('message');

        //GET OLD QUERY INFO
        $getOldQueryInfo = DB::table('query')
                            ->where('chatkey', '=', $chatkey)
                            ->select('query.id', 'admin_id', 'college_id', 'student_id', 'queryflowtype', 'replytoid', 'chatkey')
                            ->orderBy('query.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;
        
        //UPDATE REPLYTOID IN OLD ENTRY
        $updateOldQueryReply = Query::findOrFail($getOldQueryInfo[0]->id);

        $updateOldQueryReply->replytoid = $getOldQueryInfo[0]->id;
        $updateOldQueryReply->querytypeinfo = 'replied';
        $updateOldQueryReply->employee_id = Auth::id();
        $updateOldQueryReply->save();

        $createQueryReply = New Query();

        $createQueryReply->message = $message;
        $createQueryReply->admin_id = $getOldQueryInfo[0]->admin_id;
        $createQueryReply->college_id = $getOldQueryInfo[0]->college_id;
        $createQueryReply->student_id = $getOldQueryInfo[0]->student_id;
        $createQueryReply->queryflowtype = 'college-to-admin';
        $createQueryReply->replytoid = $getOldQueryInfo[0]->id;
        $createQueryReply->chatkey = $chatkey;
        $createQueryReply->querytypeinfo = 'replied';
        $createQueryReply->employee_id = Auth::id();
        $createQueryReply->save();

        return Redirect::back();
    }
}