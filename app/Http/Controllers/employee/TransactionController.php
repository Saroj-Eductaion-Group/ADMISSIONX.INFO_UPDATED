<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Transaction;
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
use App\Models\PaymentStatus as PaymentStatus;
use App\Models\CardType as CardType;
use App\Models\Application as Application;
use DateTime;

class TransactionController extends Controller
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
                                ->where('alltableinformations.name', '=', 'Transaction')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                    //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Transaction')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                    //$transaction = Transaction::paginate(15);
                $transaction = Transaction::orderBy('id', 'DESC')
                                ->leftJoin('paymentstatus', 'transaction.paymentstatus_id', '=', 'paymentstatus.id')
                                ->leftJoin('cardtype', 'transaction.cardtype_id', '=', 'cardtype.id')
                                ->leftJoin('application', 'transaction.application_id', '=', 'application.id')
                                ->leftJoin('users as eID','transaction.employee_id', '=','eID.id')
                                ->paginate(15, array('transaction.id', 'transaction.name', 'paymentstatus.name as paymentstatusName', 'cardtype.name as cardtypeName', 'application.id as applicationId','application.name as applicationName','application.applicationID' ,'eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','transaction.created_at','totalfees', 'byafees', 'restfees','transaction.updated_at','application.firstname','application.lastname','application.middlename'));
                //$applicationObj = Application::all();

                $applicationObj = DB::table('application')
                        ->select('application.id','application.applicationID')
                        ->orderBy('application.id', 'ASC')
                        ->get()
                        ;
                $cartTypeobj = CardType::all();
                $paymentStatusObj = PaymentStatus::all();

                $getSumOfTransaction = DB::table('transaction')
                                    ->join('application', 'transaction.application_id', '=', 'application.id')
                                    ->where('application.paymentstatus_id', '=', '1')
                                    ->sum('application.byafees')
                                    ;

                return view('employee/transaction.index', compact('transaction'))
                    ->with('applicationObj',$applicationObj)
                    ->with('cartTypeobj', $cartTypeobj)
                    ->with('storeEditUpdateAction', $storeEditUpdateAction)
                    ->with('paymentStatusObj',$paymentStatusObj)
                    ->with('getSumOfTransaction',$getSumOfTransaction);
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
                                ->where('alltableinformations.name', '=', 'Transaction')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                    //$transaction = Transaction::paginate(15);
                    $applicationObj = Application::all();
                    $cartTypeobj = CardType::all();
                    $paymentStatusObj = PaymentStatus::all();
                    return view('employee/transaction.create')
                    ->with('applicationObj',$applicationObj)
                    ->with('cartTypeobj', $cartTypeobj)
                    ->with('paymentStatusObj',$paymentStatusObj);
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
            //Transaction::create($request->all());    

            $transaction = New Transaction();
            $transaction->name = Input::get('name');
            $transaction->paymentstatus_id = Input::get('paymentstatus_id');
            $transaction->cardtype_id = Input::get('cardtype_id');
            $transaction->application_id = Input::get('application_id');
            $transaction->employee_id = Auth::id();

            $transaction->save();

            Session::flash('flash_message', 'Transacton added!');
            return redirect('employee/transaction');
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
                                ->where('alltableinformations.name', '=', 'Transaction')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $transaction = Transaction::orderBy('id', 'DESC')
                    ->leftJoin('paymentstatus','transaction.paymentstatus_id','=','paymentstatus.id')
                    ->leftJoin('cardtype','transaction.cardtype_id','=','cardtype.id')
                    ->leftJoin('application','transaction.application_id','=','application.id')
                    ->leftJoin('users as eID','transaction.employee_id', '=','eID.id')
                    ->select('transaction.id', 'transaction.name', 'paymentstatus.name as paymentstatusName', 'cardtype.name as cardtypeName', 'application.id as applicationID', 'application.name as applicationName','application.applicationID as applicationIDs','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','transaction.created_at','totalfees', 'byafees', 'restfees','transaction.updated_at')
                    ->findOrFail($id)
                    ;
                return view('employee/transaction.show', compact('transaction'));
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
                                ->where('alltableinformations.name', '=', 'Transaction')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $transaction = Transaction::findOrFail($id);
                $applicationObj = Application::all();
                $cartTypeobj = CardType::all();
                $paymentStatusObj = PaymentStatus::all();
                return view('employee/transaction.edit', compact('transaction'))
                 ->with('applicationObj',$applicationObj)
                ->with('cartTypeobj', $cartTypeobj)
                ->with('paymentStatusObj',$paymentStatusObj);
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
            
            $transaction = Transaction::findOrFail($id);
            $transaction->name = Input::get('name');
            $transaction->paymentstatus_id = Input::get('paymentstatus_id');
            $transaction->cardtype_id = Input::get('cardtype_id');
            $transaction->application_id = Input::get('application_id');
            $transaction->employee_id = Auth::id();
            $transaction->save();

            Session::flash('flash_message', 'Transaction updated!');
            return redirect('employee/transaction');
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
                                ->where('alltableinformations.name', '=', 'Transaction')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                Transaction::destroy($id);
                Session::flash('flash_message', 'Transaction deleted!');
                return redirect('employee/transaction');
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


    public function transactionEmployeeSearch(Request $request)
    {
        $search0 = 'transaction.id';
       
        if( $request->applicationName != null ){
            $search1 = "AND `application`.`id` =  '".$request->applicationName."'" ;
        }else{
            $search1 =  '';
        }

        if( $request->transactionName != '' ){
            $search2 = "AND `transaction`.`name` LIKE  '%".$request->transactionName."%'";
        }else{
            $search2 =  '';
        }

        if( $request->cardType != null ){
            $search3 = " AND `cardtype`.`id` =  '".$request->cardType."'";           
        }else{
            $search3 = '';
        }

        if( $request->paymentStatus != null ){
            $search4 = " AND `paymentstatus`.`id` =  '".$request->paymentStatus."'";           
        }else{
            $search4 = '';
        }


        if( $request->startCounter != '' ){
            $startCounter = $request->startCounter;
        }else{
            $startCounter = 0;
        }

        if( $request->prevCounter != '' ){
            $startCounter = $request->prevCounter;
        }else{
            $startCounter = $request->startCounter;
        }

        if( $startCounter == '' ){
            $startCounter = 0;
        }
        
        $currentNode = $request->currentNode;
        if(!empty($currentNode)){
            $getValue = ($currentNode - 1)*20;  
        }else{
            $getValue = 0;
        }
                
        $transactionSearchDataObj = DB::select( DB::raw("SELECT transaction.id as transactionID, transaction.name, paymentstatus.name as paymentstatusName, cardtype.name as cardtypeName, application.id as applicationId,application.name as applicationName,application.applicationID,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,transaction.created_at,totalfees, byafees, restfees,transaction.updated_at,application.firstname,application.lastname,application.middlename FROM  `transaction`
                        LEFT JOIN `paymentstatus` ON `transaction`.`paymentstatus_id` = `paymentstatus`.`id`
                        LEFT JOIN `cardtype` ON `transaction`.`cardtype_id` = `cardtype`.`id`
                        LEFT JOIN `application` ON `transaction`.`application_id` = `application`.`id`
                        LEFT JOIN `users` as `eID` ON `transaction`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        ORDER BY transaction.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $transactionSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(transaction.id) as totalCount FROM  `transaction` 
                        LEFT JOIN `paymentstatus` ON `transaction`.`paymentstatus_id` = `paymentstatus`.`id`
                        LEFT JOIN `cardtype` ON `transaction`.`cardtype_id` = `cardtype`.`id`
                        LEFT JOIN `application` ON `transaction`.`application_id` = `application`.`id`
                        LEFT JOIN `users` as `eID` ON `transaction`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        ORDER BY transaction.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($transactionSearchDataObj1)){
            $numRecords = $transactionSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'transactionSearchDataObj' => $transactionSearchDataObj,
                    'transactionSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $transactionSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'transactionSearchDataObj' => $transactionSearchDataObj,
                    'transactionSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $transactionSearchDataObj1,
                );
        }

        if( !empty($transactionSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allTransactionEmployeeSearch(Request $request){

       $transaction = Transaction::orderBy('transaction.id', 'DESC')
                        ->leftJoin('paymentstatus', 'transaction.paymentstatus_id', '=', 'paymentstatus.id')
                        ->leftJoin('cardtype', 'transaction.cardtype_id', '=', 'cardtype.id')
                        ->leftJoin('application', 'transaction.application_id', '=', 'application.id')
                        ->leftJoin('users as eID','transaction.employee_id', '=','eID.id')
                        ->select('transaction.id as transactionID', 'transaction.name', 'paymentstatus.name as paymentstatusName', 'cardtype.name as cardtypeName', 'application.id as applicationId','application.name as applicationName','application.applicationID','eID.id as eUserId','eID.firstname as employeeFirstname','eID.middlename as employeeMiddlename','eID.lastname as employeeLastname','transaction.created_at','totalfees','byafees','restfees','transaction.updated_at','application.firstname','application.lastname','application.middlename' )
                        ->take(20)
                        ->get();
  
        return json_encode($transaction);
    }

    public function TransactionAnalyticsIndex(Request $request)
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
                    $previousElevenMonth = new DateTime($request->endRange);
                    $previousElevenMonth->modify('-365 day');
                    $lastElevenMonthDate = $previousElevenMonth->format('Y-m-d h:s:i'); //print_r($lastElevenMonthDate);die;

                    $currentDateTime = date("Y-m-d H:i:s");

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
                    $paymentStatusObj = PaymentStatus::all();
                                       
                    return view('employee/transaction.transactionAnalytics')
                                ->with('transactionAnalytics', $jsonObj)
                                ->with('paymentStatusObj',$paymentStatusObj);

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

    public function searchTransactionAnalyticsIndex(Request $request)
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
                                ->where('alltableinformations.name', '=', 'TransactionAnalytics')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $startRange = $request->startRange;
                    $startRangeArray = explode('/', $startRange);
                    $startRange1 = $startRangeArray[2].'-'.$startRangeArray[0].'-'.$startRangeArray[1];    
                    
                    $endRange = $request->endRange;
                    $endRangeArray = explode('/', $endRange);
                    $endRange1 = $endRangeArray[2].'-'.$endRangeArray[0].'-'.$endRangeArray[1];       

                     if( $request->paymentStatus != null ){
                        $paymentstatusId = "AND transaction.paymentstatus_id =  '".$request->paymentStatus."'";           
                    }else{
                        $paymentstatusId = '';
                    }
                   
                    $transactionAnalytics = DB::select(DB::raw("SELECT count(transaction.id) as transactionAnalytics, transaction.name ,  paymentstatus.name as paymentstatusName ,  cardtype.name as cardtypeName , application.id as applicationId , application.name as applicationName , transaction.created_at as transactionDate FROM transaction left join paymentstatus on transaction.paymentstatus_id = paymentstatus.id left join cardtype on transaction.cardtype_id = cardtype.id left join application on transaction.application_id = application.id left join applicationstatus on application.applicationstatus_id = applicationstatus.id where transaction.created_at between '$startRange1' and '$endRange1' $paymentstatusId group by MONTH(transaction.created_at) order By transaction.created_at ASC"));

                    
                   
                    foreach ($transactionAnalytics as $value) {
                        $value->transactionDate = date('M, Y', strtotime($value->transactionDate));
                    }
                    //echo "<pre>";print_r($transactionAnalytics);die;

                    if(!empty($transactionAnalytics)){
                        $jsonObj = json_encode($transactionAnalytics);    
                    }else{
                        $jsonObj = '0';
                    }        
                                       
                    $paymentStatusObj = PaymentStatus::all();   
                    return view('employee/transaction.transactionGraphSearchResult')
                                ->with('transactionAnalytics', $jsonObj)
                                ->with('paymentStatusObj',$paymentStatusObj)
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

}
