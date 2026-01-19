<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\EngineeringExam;
use Illuminate\Http\Request;
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
use App\Models\UserStatus as UserStatus;

class EngineeringExamController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {   
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'AIEA_Exam')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    //$engineeringexam = EngineeringExam::findOrFail($id);
                    $engineeringexam = EngineeringExam::orderBy('engineeringexams.id', 'DESC')
                            ->leftJoin('examtransaction','examtransaction.engineeringexams_id','=','engineeringexams.id')
                            ->leftJoin('paymentstatus','examtransaction.paymentstatus_id','=','paymentstatus.id')
                            ->leftJoin('users as eID','examtransaction.employee_id', '=','eID.id')
                            ->select('engineeringexams.id','title', 'engineeringexams.firstname', 'engineeringexams.middlename', 'engineeringexams.lastname', 'fathername', 'category', 'gender', 'nationality', 'choice1st', 'choice2nd', 'choice3rd', 'firstaddress1', 'firstaddress2', 'firstaddress3', 'firstcity', 'firststate', 'firstpincode', 'firstcontact', 'secondaddress1', 'secondaddress2', 'secondaddress3', 'secondcity', 'secondstate', 'secondpincode', 'secondcontact', 'addresssame', 'board1', 'subject1', 'passingyr1', 'percentage1', 'cgpa1', 'division1', 'board2', 'subject2', 'passingyr2', 'percentage2', 'cgpa2', 'division2', 'iagree', 'place', 'date', 'engineeringexams.email', 'engineeringexams.phone', 'engineeringexams.created_at', 'engineeringexams.updated_at','paymentstatus.name as paymentstatusName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','examtransaction.id as examtransactionId','examtransaction.name as examtransactionname','examtransaction.studentname','examtransaction.created_at as transactiondate','examtransaction.amount','applicationId')
                            ->findOrFail($id)
                            ;
                    return view('employee/engineering-exam.show', compact('engineeringexam'));
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

    
    public function AllIndiaEngineeringAssociation(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'AIEA_Exam')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    //$engineeringexam = EngineeringExam::paginate(20);
                    $query = EngineeringExam::orderBy('examtransaction.id', 'DESC');
                    $query->join('examtransaction','engineeringexams.id','=','examtransaction.engineeringexams_id');
                    $query->leftJoin('paymentstatus','examtransaction.paymentstatus_id','=','paymentstatus.id');

                    if($request->has('student')){
                        $query->whereRaw('engineeringexams.firstname LIKE "%'.Input::get('student').'%" OR engineeringexams.lastname LIKE "%'.Input::get('student').'%" OR engineeringexams.middlename LIKE "%'.Input::get('student').'%"'   );
                    }

                    if($request->has('email')){
                        $query->where('engineeringexams.email', '=', Input::get('email'));
                    }
                    if($request->has('phone')){
                        $query->where('engineeringexams.phone', '=', Input::get('phone'));
                    }
                    
                    if($request->has('city')){
                        $query->whereRaw('engineeringexams.choice1st LIKE "%'.Input::get('city').'%" OR engineeringexams.choice2nd LIKE "%'.Input::get('city').'%" OR engineeringexams.choice3rd LIKE "%'.Input::get('city').'%" OR engineeringexams.firstcity LIKE "%'.Input::get('city').'%" OR engineeringexams.secondcity LIKE "%'.Input::get('city').'%"'   );
                    }
                    $query->where('examtransaction.paymentstatus_id','=','1');
                    $query->groupBy('engineeringexams.id');
                    $engineeringexam = $query->Paginate(20, array('engineeringexams.id','title', 'firstname', 'middlename', 'lastname', 'fathername', 'category', 'gender', 'nationality', 'choice1st', 'choice2nd', 'choice3rd', 'firstaddress1', 'firstaddress2', 'firstaddress3', 'firstcity', 'firststate', 'firstpincode', 'firstcontact', 'secondaddress1', 'secondaddress2', 'secondaddress3', 'secondcity', 'secondstate', 'secondpincode', 'secondcontact', 'addresssame', 'board1', 'subject1', 'passingyr1', 'percentage1', 'cgpa1', 'division1', 'board2', 'subject2', 'passingyr2', 'percentage2', 'cgpa2', 'division2', 'iagree', 'place', 'date', 'email', 'phone', 'engineeringexams.created_at', 'engineeringexams.updated_at','applicationId','examtransaction.amount','paymentstatus.name as paymentstatusName'));

                    $getAllCityObj = DB::table('city')
                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                ->select('city.id','city.name','country.name as countryName')
                                ->where('country_id','=','99')
                                ->orderBy('city.id', 'ASC')
                                ->get();
                    return view('employee/engineering-exam.all-india-engineering-association', compact('engineeringexam'))
                    ->with('getAllCityObj', $getAllCityObj);
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
