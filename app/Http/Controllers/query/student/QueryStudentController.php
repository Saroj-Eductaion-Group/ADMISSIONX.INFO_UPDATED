<?php

namespace App\Http\Controllers\query\student;

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
use Session;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\StudentProfile;
use App\Models\Query;
use App\Http\Controllers\Helper\FetchDataServiceController;

class QueryStudentController extends Controller
{
	protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

	public function checkQueriesForStudent(Request $request, $option)
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


			$loggedInId = Auth::id();
			$getStudentNameDetailObj = DB::table('users')
										->join('studentprofile', function ($join) use ($loggedInId) {
					                       $join->on('studentprofile.users_id', '=', 'users.id')
					                            ->where('users.id', '=', DB::raw($loggedInId));
					                       })
										->where('users.id', '=', $loggedInId)
										->select('users.firstname', 'users.middlename', 'users.lastname', 'studentprofile.slug')
										->take(1)
										->get()
										;

			$getQueriesDataObj =Query::orderBy('query.id', 'DESC')
									->join('users', 'query.student_id', '=', 'users.id')
									->leftJoin('collegeprofile', 'collegeprofile.id','=', 'query.college_id')
                                    ->leftJoin('users as u1', 'collegeprofile.users_id', '=', 'u1.id')
									->where('users.id', '=', Auth::id())
									->where('query.admin_id', '=', '0')
									->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
									->groupBy('query.chatkey')
									->paginate(20, array('query.id', 'query.subject', 'query.message', 'query.created_at','u1.firstname as collegeName','querytypeinfo'))
									;

			$getQueriesDataObj1 =Query::orderBy('query.id', 'DESC')
									->join('users', 'query.student_id', '=', 'users.id')
									->where('users.id', '=', Auth::id())
									->where('query.admin_id', '=', '0')
									->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
									->groupBy('query.chatkey')
									->count()
									;
			 
			if( $getQueriesDataObj1 == '0' ){
				$getQueriesDataObj = '';
			}

			$getQueriesAdminDataObj =Query::orderBy('query.id', 'DESC')
									->join('users', 'query.student_id', '=', 'users.id')
									->leftJoin('users as u1', 'query.admin_id', '=', 'u1.id')
									->where('users.id', '=', Auth::id())
									->where('query.admin_id', '!=', '0')
									->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
									->groupBy('query.chatkey')
									->paginate(20, array('query.id', 'query.subject', 'query.message', 'query.created_at','u1.firstname', 'u1.middlename', 'u1.lastname','querytypeinfo'))
									;

			$getQueriesAdminDataObj1 =Query::orderBy('query.id', 'DESC')
									->join('users', 'query.student_id', '=', 'users.id')
									->where('users.id', '=', Auth::id())
									->where('query.admin_id', '!=', '0')
									->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
									->groupBy('query.chatkey')
									->count()
									;
			// print_r($getQueriesAdminDataObj1);die;
			if( $getQueriesAdminDataObj1 == '0' ){
				$getQueriesAdminDataObj = '';
			}

			return view('student/query.index-query')
					->with('getStudentNameDetailObj', $getStudentNameDetailObj)
					->with('getQueriesDataObj', $getQueriesDataObj)
					->with('getQueriesAdminDataObj', $getQueriesAdminDataObj)
					->with('option', $option)
					;
		}else{
			Auth::logout();
			return Redirect::to('/');
		}
	}

	public function queryDetailForStudent(Request $request, $option,$queryId)
	{
		if(Auth::check()){
			$loggedInId = Auth::id();
			$getStudentNameDetailObj = DB::table('users')
										->join('studentprofile', function ($join) use ($loggedInId) {
					                       $join->on('studentprofile.users_id', '=', 'users.id')
					                            ->where('users.id', '=', DB::raw($loggedInId));
					                       })
										->where('users.id', '=', $loggedInId)
										->select('users.firstname', 'users.middlename', 'users.lastname', 'studentprofile.slug')
										->take(1)
										->get()
										;

			$getQueriesDataObj = DB::table('query')
									->join('users', 'query.student_id', '=', 'users.id')
									->where('users.id', '=', Auth::id())
									->where('query.id', '=', $queryId)
									->select('query.id', 'query.subject', 'query.message', 'query.created_at', 'query.chatkey')
									->orderBy('query.id','ASC')
									->get()
									;

			$chatkey = $getQueriesDataObj[0]->chatkey;
			$getQueryDataForReplies = DB::table('query')
										->join('users as U1', 'query.student_id', '=', 'U1.id')
										->join('collegeprofile', 'query.college_id', '=', 'collegeprofile.id')
										->join('users as U2', 'collegeprofile.users_id', '=', 'U2.id')
										->where('U1.id', '=', Auth::id())
										->where('query.chatkey', '=', $chatkey)
										->select('query.id', 'query.subject', 'query.message', 'query.created_at', 'query.queryflowtype','U2.firstname')
										->orderBy('query.id','ASC')
										->limit(500)
										->offset(1)
										->get()
										;

			return view('student/query.details-query')
					->with('option', $option)
					->with('getStudentNameDetailObj', $getStudentNameDetailObj)
					->with('getQueriesDataObj', $getQueriesDataObj)
					->with('getQueryDataForReplies', $getQueryDataForReplies)
					;
		}else{
			Auth::logout();
			return Redirect::to('/');
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
							->select('query.id', 'admin_id', 'college_id', 'student_id', 'queryflowtype', 'replytoid', 'chatkey','users.email as collegeEmail')
							->orderBy('query.id', 'ASC')
							->take(1)
							->get()
							;
		//$collegeEmailId = $getOldQueryInfo[0]->collegeEmail;

		$createQueryReply = New Query();

		$createQueryReply->message = $message;
		$createQueryReply->admin_id = $getOldQueryInfo[0]->admin_id;
		$createQueryReply->college_id = $getOldQueryInfo[0]->college_id;
		$createQueryReply->student_id = $getOldQueryInfo[0]->student_id;
		$createQueryReply->queryflowtype = 'student-to-college';
		$createQueryReply->replytoid = $getOldQueryInfo[0]->id;
		$createQueryReply->chatkey = $chatkey;
		$createQueryReply->querytypeinfo = 'replied';
		$createQueryReply->employee_id = Auth::id();
		$createQueryReply->save();

		/*try {
            if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
            {
                    //Swift Mailer TO COLLEGE        
                    \Mail::send('emailtemplate/query-emails.queryToCollegeByStudent', array('email' => $collegeEmailId), function($message) use ($collegeEmailId)
                    {
                        $message->to($collegeEmailId, 'AdmissionX')->subject('You got a new query - college');
                    });  
            } 

        }catch ( \Swift_TransportException $e) {                
        }*/

		return Redirect::back();
	}

	public function queryDetailForByaAdmin(Request $request, $option, $queryId)
	{
		if(Auth::check()){
			$loggedInId = Auth::id();
			$getStudentNameDetailObj = DB::table('users')
										->join('studentprofile', function ($join) use ($loggedInId) {
					                       $join->on('studentprofile.users_id', '=', 'users.id')
					                            ->where('users.id', '=', DB::raw($loggedInId));
					                       })
										->where('users.id', '=', $loggedInId)
										->select('users.firstname', 'users.middlename', 'users.lastname', 'studentprofile.slug')
										->take(1)
										->get()
										;

			$getQueriesDataObj = DB::table('query')
									->join('users', 'query.student_id', '=', 'users.id')
									->where('users.id', '=', Auth::id())
									->where('query.id', '=', $queryId)
									->select('query.id', 'query.subject', 'query.message', 'query.created_at', 'query.chatkey')
									->orderBy('query.id','ASC')
									->get()
									;

			$chatkey = $getQueriesDataObj[0]->chatkey;
			$getQueryDataForReplies = DB::table('query')
										->join('users as U1', 'query.student_id', '=', 'U1.id')
										->join('users as U2', 'query.admin_id', '=', 'U2.id')
										->where('query.chatkey', '=', $chatkey)
										->select('query.id', 'query.subject', 'query.message', 'query.created_at', 'query.queryflowtype','U2.firstname')
										->orderBy('query.id','ASC')
										->limit(500)
										->offset(1)
										->get()
										;
										
			return view('student/query.details-query-bya-admin')
					->with('option', $option)
					->with('getStudentNameDetailObj', $getStudentNameDetailObj)
					->with('getQueriesDataObj', $getQueriesDataObj)
					->with('getQueryDataForReplies', $getQueryDataForReplies)
					;
		}else{
			Auth::logout();
			return Redirect::to('/');
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
        $createQueryReply->queryflowtype = 'student-to-admin';
        $createQueryReply->replytoid = $getOldQueryInfo[0]->id;
        $createQueryReply->chatkey = $chatkey;
        $createQueryReply->querytypeinfo = 'replied';
        $createQueryReply->employee_id = Auth::id();
        $createQueryReply->save();

        return Redirect::back();
	}
}