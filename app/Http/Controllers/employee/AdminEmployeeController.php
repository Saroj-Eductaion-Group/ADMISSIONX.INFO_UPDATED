<?php

namespace App\Http\Controllers\employee;

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
use DateTime;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;

class AdminEmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
    	//Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){

                if (!empty(Input::get('startdate'))) {
                    $startdate  = Input::get('startdate');
                    $formDate   = date('Y-m-d 00:00:00', strtotime($startdate));
                }

                if (!empty(Input::get('enddate'))) {
                    $enddate    = Input::get('enddate');
                    $toDate     = date('Y-m-d 23:59:59', strtotime($enddate));
                }


                $query1 = DB::table('users');
                if (!empty(Input::get('startdate'))) {
                    $query1->where('users.created_at', '>=', ''.$formDate. '');
                }

                if (!empty(Input::get('enddate'))) {
                    $query1->where('users.created_at', '<=', '' .$toDate. '');
                }
                $query1->select('id', 'userrole_id', 'userstatus_id');
                $totalUsersRegistered =    $query1->get();

                $query2 = DB::table('query');
                $query2->leftJoin('users', 'query.admin_id', '=', 'users.id');
                if (!empty(Input::get('startdate'))) {
                    $query2->where('query.created_at', '>=', ''.$formDate. '');
                }

                if (!empty(Input::get('enddate'))) {
                    $query2->where('query.created_at', '<=', '' .$toDate. '');
                }
                $query2->select('query.id', 'query.subject', 'query.queryflowtype', 'query.chatkey','query.message','users.userrole_id', 'users.userstatus_id','querytypeinfo');
                $totalQuery =  $query2->get();

                $query3 = DB::table('application');
                $query3->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id');
                $query3->leftJoin('users as studentUser', 'application.users_id','=', 'studentUser.id');
                $query3->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id');
                $query3->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id');
                $query3->where('collegeUser.userstatus_id','!=','5');
                $query3->where('studentUser.userstatus_id','!=','5');
                if (!empty(Input::get('startdate'))) {
                    $query3->where('application.created_at', '>=', ''.$formDate. '');
                }

                if (!empty(Input::get('enddate'))) {
                    $query3->where('application.created_at', '<=', '' .$toDate. '');
                }
                $query3->select('application.id','applicationstatus.name as applicationstatusName','applicationstatus.id as applicationstatusId');
                $totalApplication = $query3->get();

                /**************** Transaction Analytics Process *********************/
                if (!empty(Input::get('startdate'))) {
                    $lastElevenMonthDate = $formDate;
                }else{
                    $previousElevenMonth = new DateTime();
                    $previousElevenMonth->modify('-365 day');
                    $lastElevenMonthDate = $previousElevenMonth->format('Y-m-d 00:00:00');
                }

                if (!empty(Input::get('enddate'))) {
                    $currentDateTime = $toDate;
                }else{
                    $currentDateTime = date("Y-m-d 23:59:59");
                }

                $transactionAnalytics = DB::select(DB::raw("SELECT count(transaction.id) as transactionAnalytics, transaction.name ,  paymentstatus.name as paymentstatusName ,  cardtype.name as cardtypeName ,  application.id as applicationId , application.name as applicationName , transaction.created_at as transactionDate   FROM transaction left join paymentstatus on transaction.paymentstatus_id = paymentstatus.id left join cardtype on transaction.cardtype_id = cardtype.id left join application on transaction.application_id = application.id left join applicationstatus on application.applicationstatus_id = applicationstatus.id where transaction.paymentstatus_id = '1' and application.paymentstatus_id = '1' AND transaction.created_at between '$lastElevenMonthDate' and '$currentDateTime' group by MONTH(transaction.created_at) order By transaction.created_at ASC"));

                foreach ($transactionAnalytics as $value) {
                    $value->transactionDate = date('M, Y', strtotime($value->transactionDate));
                }
                //echo "<pre>";print_r($transactionAnalytics);die;

                if(!empty($transactionAnalytics)){
                    $jsonObj = json_encode($transactionAnalytics);    
                }else{
                    $jsonObj = '0';
                }        
                /***************** Transaction Analytics Process ***********************/


        		return view('employee/dashboard.index')
                        ->with('totalUsersRegistered', $totalUsersRegistered)
                        ->with('totalQuery', $totalQuery)
                        ->with('totalApplication', $totalApplication)
                        ->with('transactionAnalytics', $jsonObj)
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
}