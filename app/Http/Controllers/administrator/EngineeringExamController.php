<?php

namespace App\Http\Controllers\administrator;

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
use App\Models\Examtransaction;
use App\Http\Controllers\website\WebsiteLogController;
use Illuminate\Database\QueryException as QueryException;
//PAYU MONEY CONTROLLERS
use App\Http\Controllers\payumoney\CurlController as Curl;
use App\Http\Controllers\payumoney\CookiesController as Cookies;
use App\Http\Controllers\payumoney\ResponseController as ResponsePayu;
use App\Http\Controllers\payumoney\MiscController as Misc;
use App\Http\Controllers\payumoney\PaymentController as Payment;
use App\Http\Controllers\Helper\FetchDataServiceController;

class EngineeringExamController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $engineeringexam = EngineeringExam::paginate(25);

        return view('administrator/engineering-exam.index', compact('engineeringexam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('administrator/engineering-exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $dataArray = [];
        $requestData = $request->all();
        $examapikey = uniqid( 'admissionx_exam' );

        $engineeringExam = new EngineeringExam;
        $engineeringExam->title = Input::get('title');
        $engineeringExam->firstname = Input::get('firstname');
        $engineeringExam->middlename = Input::get('middlename');
        $engineeringExam->lastname = Input::get('lastname');
        $engineeringExam->fathername = Input::get('fathername');
        $engineeringExam->category = Input::get('category');
        $engineeringExam->gender = Input::get('gender');
        $engineeringExam->nationality = Input::get('nationality');
        $engineeringExam->choice1st = Input::get('choice1st');
        $engineeringExam->choice2nd = Input::get('choice2nd');
        $engineeringExam->choice3rd = Input::get('choice3rd');
        $engineeringExam->firstaddress1 = Input::get('firstaddress1');
        $engineeringExam->firstaddress2 = Input::get('firstaddress2');
        $engineeringExam->firstaddress3 = Input::get('firstaddress3');
        $engineeringExam->firstcity = Input::get('firstcity');
        $engineeringExam->firststate = Input::get('firststate');
        $engineeringExam->firstpincode = Input::get('firstpincode');
        $engineeringExam->firstcontact = Input::get('firstcontact');
        $engineeringExam->addresssame = Input::get('addresssame');
        if (Input::get('addresssame') == '1') {
            $engineeringExam->secondaddress1 = Input::get('firstaddress1');
            $engineeringExam->secondaddress2 = Input::get('firstaddress2');
            $engineeringExam->secondaddress3 = Input::get('firstaddress3');
            $engineeringExam->secondstate = Input::get('firstcity');
            $engineeringExam->secondcity = Input::get('firststate');
            $engineeringExam->secondpincode = Input::get('firstpincode');
            $engineeringExam->secondcontact = Input::get('firstcontact');
        }else{
            $engineeringExam->secondaddress1 = Input::get('secondaddress1');
            $engineeringExam->secondaddress2 = Input::get('secondaddress2');
            $engineeringExam->secondaddress3 = Input::get('secondaddress3');
            $engineeringExam->secondstate = Input::get('secondstate');
            $engineeringExam->secondcity = Input::get('secondcity');
            $engineeringExam->secondpincode = Input::get('secondpincode');
            $engineeringExam->secondcontact = Input::get('secondcontact');
        }
        $engineeringExam->board1 = Input::get('board1');
        $engineeringExam->subject1 = Input::get('subject1');
        $engineeringExam->passingyr1 = Input::get('passingyr1');
        $engineeringExam->percentage1 = Input::get('percentage1');
        $engineeringExam->cgpa1 = Input::get('cgpa1');
        $engineeringExam->division1 = Input::get('division1');
        $engineeringExam->board2 = Input::get('board2');
        $engineeringExam->subject2 = Input::get('subject2');
        $engineeringExam->passingyr2 = Input::get('passingyr2');
        $engineeringExam->percentage2 = Input::get('percentage2');
        $engineeringExam->cgpa2 = Input::get('cgpa2');
        $engineeringExam->division2 = Input::get('division2');
        $engineeringExam->iagree = Input::get('iagree');
        $engineeringExam->place = Input::get('place');
        $engineeringExam->date = Input::get('date');
        $engineeringExam->email = Input::get('email');
        $engineeringExam->phone = Input::get('phone');
        $engineeringExam->apikey = $examapikey;
        $engineeringExam->save();

        $examTransactionHashKey = uniqid('admissionx_'.round(microtime(true) * 1000).'_'.$engineeringExam->id);
        $updateApplicationObj = EngineeringExam::where('id', '=', $engineeringExam->id)->firstOrFail();
        $updateApplicationObj->examTransactionHashKey = $examTransactionHashKey;
        $updateApplicationObj->save(); 
        /*$dataArray = [
                    '_token' => $request->_token,
                    'title' => $request->title,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'fathername' => $request->fathername,
                    'category' => $request->category,
                    'gender' => $request->gender,
                    'nationality' => $request->nationality,
                    'choice1st' => $request->choice1st,
                    'choice2nd' => $request->choice2nd,
                    'choice3rd' => $request->choice3rd,
                    'firstaddress1' => $request->firstaddress1,
                    'firstaddress2' => $request->firstaddress2,
                    'firstaddress3' => $request->firstaddress3,
                    'firstcity' => $request->firstcity,
                    'firststate' => $request->firststate,
                    'firstpincode' => $request->firstpincode,
                    'firstcontact' => $request->firstcontact,
                    'addresssame' => $request->addresssame,
                    'secondaddress1' => $request->secondaddress1,
                    'secondaddress2' => $request->secondaddress2,
                    'secondaddress3' => $request->secondaddress3,
                    'secondstate' => $request->secondstate,
                    'secondcity' => $request->secondcity,
                    'secondpincode' => $request->secondpincode,
                    'secondcontact' => $request->secondcontact,
                    'board1' => $request->board1,
                    'subject1' => $request->subject1,
                    'passingyr1' => $request->passingyr1,
                    'percentage1' => $request->percentage1,
                    'cgpa1' => $request->cgpa1,
                    'division1' => $request->division1,
                    'board2' => $request->board2,
                    'subject2' => $request->subject2,
                    'passingyr2' => $request->passingyr2,
                    'percentage2' => $request->percentage2,
                    'cgpa2' => $request->cgpa2,
                    'division2' => $request->division2,
                    'iagree' => $request->iagree,
                    'place' => $request->place,
                    'date' => $request->date,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'apikey' => $examapikey,
                ];

        EngineeringExam::create($dataArray);*/
        /*return  view('administrator/engineering-exam.sendEmailBody')
                    ->with('dataArray', $requestData)
                    ;*/
        // EMAIL TO ADMIN
        /*try {
            $emailText = env('ADMIN_EMAIL_ADDRESS');
            if(!empty($emailText) && ($this->fetchDataServiceController->isValidEmail($emailText) == 1)){
                \Mail::send('administrator/engineering-exam.sendEmailBody', array('email' => $emailText,'dataArray' => $requestData), function($message) use ($emailText)
                {
                    $message->to($emailText, 'AdmissionX')->subject('All India Engineering Association Examination - Candidate');
                });  
            }
        }catch ( \Swift_TransportException $e) {                
        }*/


        //GET ENGINEERINGEXAMS ID HERE
        $getLastCreatedApplicationObj = DB::table('engineeringexams')
                                        ->where('engineeringexams.email', '=', Input::get('email'))
                                        ->where('engineeringexams.phone', '=', Input::get('phone'))
                                        ->where('engineeringexams.firstname', '=', Input::get('firstname'))
                                        ->where('apikey', '=', $examapikey)
                                        ->select('engineeringexams.id')
                                        ->orderBy('engineeringexams.id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;
        //Update application ID
        $updateAppID = EngineeringExam::findOrFail($getLastCreatedApplicationObj[0]->id);
        $updateAppID->applicationId = 'ADX-AIEA-'.date('y-m-d').'-'.$getLastCreatedApplicationObj[0]->id;
        $updateAppID->save();
        
        //PAYMENT GATEWAY PARAMS
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $hash = '';

        //GET ALL REQUIRED DATA FROM APPLICATION TABLE
        $getExamApplicationObj = DB::table('engineeringexams')
                            ->where('engineeringexams.id', '=', $getLastCreatedApplicationObj[0]->id)
                            ->select('id','firstname', 'middlename', 'lastname', 'email','phone','fathername','gender','examTransactionHashKey')
                            ->take(1)
                            ->orderBy('engineeringexams.id', 'DESC')
                            ->get()
                            ;
        $examfee = '1000';

        $hash_string = '';
        $hash_string = env('MERCHANT_KEY').'|'.$txnid.'|'.$examfee.'|'.'All India Engineering Association Examination'.'|'.$getExamApplicationObj[0]->firstname.' '.$getExamApplicationObj[0]->middlename.' '.$getExamApplicationObj[0]->lastname.'|'.$getExamApplicationObj[0]->email.'|||||||||||';
        $hash_string .= env('SALT');

        $hash = strtolower(hash('sha512', $hash_string));
        
        // if( env('APP_ENV') == 'local' ){
        //     $surl = env('APP_URL').'/exam-success-payment-success/'.$getExamApplicationObj[0]->examTransactionHashKey;
        //     $furl = env('APP_URL').'/exam-success-payment-failed/'.$getExamApplicationObj[0]->examTransactionHashKey;
        // }else{
        //    $surl = 'https://'.env('ipAddressForRedirect').'/exam-success-payment-success/'.$getExamApplicationObj[0]->examTransactionHashKey;
        //    $furl = 'https://'.env('ipAddressForRedirect').'/exam-success-payment-failed/'.$getExamApplicationObj[0]->examTransactionHashKey;
        // }  
        $surl = env('APP_URL').'/exam-success-payment-success/'.$getExamApplicationObj[0]->examTransactionHashKey;
        $furl = env('APP_URL').'/exam-success-payment-failed/'.$getExamApplicationObj[0]->examTransactionHashKey;
        
        $service_provider = 'payu_paisa';

        Session::flash('flash_message', 'Thank you, we will contact you soon with details');
        Session::flash('alert-color-success', 'warning');

        $encryptApplicationId = \Illuminate\Support\Facades\Crypt::encrypt($getLastCreatedApplicationObj[0]->id);
        return view('website.home.exam-payment.studentexampayment')
                                ->with('restfees', Input::get('restfees'))
                                ->with('studentName', $request->firstname.' '.$request->middlename
                                    .' '.$request->lastname)
                                ->with('currentApplicationID', $getLastCreatedApplicationObj[0]->id)
                                ->with('encryptApplicationId', $encryptApplicationId)
                                ->with('key', env('MERCHANT_KEY'))
                                ->with('hash', $hash)
                                ->with('txnid', $txnid)                                
                                ->with('amount', $examfee)
                                ->with('productinfo', 'All India Engineering Association Examination Fee')
                                ->with('firstname', $getExamApplicationObj[0]->firstname.' '.$getExamApplicationObj[0]->middlename.' '.$getExamApplicationObj[0]->lastname)
                                ->with('email', $getExamApplicationObj[0]->email)
                                ->with('phone', $getExamApplicationObj[0]->phone)
                                ->with('surl', $surl)
                                ->with('furl', $furl)
                                ->with('service_provider', $service_provider)
                            ;
        // return redirect('/');
        //return Redirect::back();
    }


    //Payment Process From PAYUBIZ
    public function examPaymentNowForStudent(Request $request, $id)
    {
        $decryptApplicationId = \Illuminate\Support\Facades\Crypt::decrypt($id);
        $getAieaApplicationObj = DB::table('engineeringexams')
                                    ->where('engineeringexams.id', '=', $decryptApplicationId)
                                    ->select('id','firstname', 'middlename', 'lastname', 'email','phone','fathername','gender','apikey','engineeringexams.examTransactionHashKey')
                                    ->take(1)
                                    ->orderBy('engineeringexams.id', 'DESC')
                                    ->get()
                                    ;

        //CREATE Examtransaction DETAILS
        $createExamTransactionsObj = New Examtransaction;

        $transactionKey = $getAieaApplicationObj[0]->apikey;
        $createExamTransactionsObj->name = $transactionKey;
        $createExamTransactionsObj->studentname = $getAieaApplicationObj[0]->firstname.' '.$getAieaApplicationObj[0]->middlename.' '.$getAieaApplicationObj[0]->lastname;
        $createExamTransactionsObj->employee_id = Auth::id();
        $createExamTransactionsObj->paymentstatus_id = '7';
        $createExamTransactionsObj->engineeringexams_id = $decryptApplicationId;
        $createExamTransactionsObj->amount = '1000';
        $createExamTransactionsObj->examTransactionHashKey = $getAieaApplicationObj[0]->examTransactionHashKey;
        $createExamTransactionsObj->save();


        $string = 'All India Engineering Association Examination';
        $productinfo = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);

        // if( env('APP_ENV') == 'local' ){
        //     $surl = env('APP_URL').'/exam-success-payment-success/'.$getAieaApplicationObj[0]->examTransactionHashKey;
        //     $furl = env('APP_URL').'/exam-success-payment-failed/'.$getAieaApplicationObj[0]->examTransactionHashKey;
        // }else{
        //    $surl = 'https://'.env('ipAddressForRedirect').'/exam-success-payment-success/'.$getAieaApplicationObj[0]->examTransactionHashKey;
        //    $furl = 'https://'.env('ipAddressForRedirect').'/exam-success-payment-failed/'.$getAieaApplicationObj[0]->examTransactionHashKey;
        // }  
        $surl = env('APP_URL').'/exam-success-payment-success/'.$getAieaApplicationObj[0]->examTransactionHashKey;
        $furl = env('APP_URL').'/exam-success-payment-failed/'.$getAieaApplicationObj[0]->examTransactionHashKey;

         $returnStatusCode = $this->pay_page( array (   
                    'key' => env('MERCHANT_KEY'),
                    'txnid' => $transactionKey,
                    'amount' => '1000',
                    'firstname' => $getAieaApplicationObj[0]->firstname.' '.$getAieaApplicationObj[0]->middlename.' '.$getAieaApplicationObj[0]->lastname,
                    'email' => $getAieaApplicationObj[0]->email,
                    'phone' => $getAieaApplicationObj[0]->phone,
                    'productinfo' => $productinfo,
                    'surl' => $surl,
                    'furl' => $furl),
                    env('SALT') );

       /* $returnStatusCode = $this->pay_page( array (   
                    'key' => env('MERCHANT_KEY'),
                    'txnid' => $transactionKey,
                    'amount' => '1000',
                    'firstname' => $getAieaApplicationObj[0]->firstname.' '.$getAieaApplicationObj[0]->middlename.' '.$getAieaApplicationObj[0]->lastname,
                    'email' => $getAieaApplicationObj[0]->email,
                    'phone' => $getAieaApplicationObj[0]->phone,
                    'productinfo' => $productinfo,
                    'surl' => 'processPaymentApplication#'.$id,
                    'furl' => 'processFailurePaymentApplication#'.$id),
                    env('SALT') );*/
        

        //GET TRANSACTION ID IN REVERSE ORDER
        $getTransactionIdValue = DB::table('examtransaction')
                                ->where('engineeringexams_id', '=', $decryptApplicationId)
                                ->select('id')
                                ->take(1)
                                ->orderBy('id', 'DESC')
                                ->get()
                                ;

        if( $returnStatusCode == 'surl' ){
            $updateTransactionsObj = Examtransaction::where('id', '=', $getTransactionIdValue[0]->id)->firstOrFail();
            $updateTransactionsObj->paymentstatus_id = '1';
            $updateTransactionsObj->save();

            Session::flash('paymentSuccessMessage', 'Your transaction has been successfully submitted! Thank you, we will contact you soon with details');
            return Redirect::to('/exam-success-payment-details');                        
        }else{
            $updateTransactionsObj = Examtransaction::where('id', '=', $getTransactionIdValue[0]->id)->firstOrFail();            
            $updateTransactionsObj->paymentstatus_id = '2';
            $updateTransactionsObj->save();

            Session::flash('paymentFailureMessage', 'Your transaction has been cancelled because of some reason!');
            return Redirect::to('/exam-failure-payment-details');            
        }
        exit;            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
       // $engineeringexam = EngineeringExam::findOrFail($id);
        $engineeringexam = EngineeringExam::orderBy('engineeringexams.id', 'DESC')
                        ->leftJoin('examtransaction','examtransaction.engineeringexams_id','=','engineeringexams.id')
                        ->leftJoin('paymentstatus','examtransaction.paymentstatus_id','=','paymentstatus.id')
                        ->leftJoin('users as eID','examtransaction.employee_id', '=','eID.id')
                        ->select('engineeringexams.id','title', 'engineeringexams.firstname', 'engineeringexams.middlename', 'engineeringexams.lastname', 'fathername', 'category', 'gender', 'nationality', 'choice1st', 'choice2nd', 'choice3rd', 'firstaddress1', 'firstaddress2', 'firstaddress3', 'firstcity', 'firststate', 'firstpincode', 'firstcontact', 'secondaddress1', 'secondaddress2', 'secondaddress3', 'secondcity', 'secondstate', 'secondpincode', 'secondcontact', 'addresssame', 'board1', 'subject1', 'passingyr1', 'percentage1', 'cgpa1', 'division1', 'board2', 'subject2', 'passingyr2', 'percentage2', 'cgpa2', 'division2', 'iagree', 'place', 'date', 'engineeringexams.email', 'engineeringexams.phone', 'engineeringexams.created_at', 'engineeringexams.updated_at','paymentstatus.name as paymentstatusName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','examtransaction.id as examtransactionId','examtransaction.name as examtransactionname','examtransaction.studentname','examtransaction.created_at as transactiondate','examtransaction.amount','applicationId')
                        ->findOrFail($id)
                        ;

        return view('administrator/engineering-exam.show', compact('engineeringexam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $engineeringexam = EngineeringExam::findOrFail($id);

        return view('administrator/engineering-exam.edit', compact('engineeringexam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $engineeringexam = EngineeringExam::findOrFail($id);
        $engineeringexam->update($requestData);

        Session::flash('flash_message', 'EngineeringExam updated!');

        return redirect('administrator/engineering-exam');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        EngineeringExam::destroy($id);

        Session::flash('flash_message', 'EngineeringExam deleted!');

        return redirect('administrator/engineering-exam');
    }

    public function AllIndiaEngineeringAssociation(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
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
                return view('administrator/engineering-exam.all-india-engineering-association', compact('engineeringexam'))
                ->with('getAllCityObj', $getAllCityObj);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function processPaymentApplication($id)
    {
        //print_r($id);die;
        //REMOVE DUPLICATE TRANSACTION RECORD
        $getAllExamTransactionIDObj = DB::table('examtransaction')
                                    ->where('engineeringexams_id', '=', $id)
                                    ->select('id')
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->get()
                                    ;
        Examtransaction::destroy($getAllExamTransactionIDObj[0]->id);



        $getApplicationTableData = DB::table('engineeringexams')
                            ->where('engineeringexams.id', '=', $id)
                            ->select('engineeringexams.id','title', 'firstname', 'middlename', 'lastname', 'fathername', 'category', 'gender', 'nationality', 'choice1st', 'choice2nd', 'choice3rd', 'firstaddress1', 'firstaddress2', 'firstaddress3', 'firstcity', 'firststate', 'firstpincode', 'firstcontact', 'secondaddress1', 'secondaddress2', 'secondaddress3', 'secondcity', 'secondstate', 'secondpincode', 'secondcontact', 'addresssame', 'board1', 'subject1', 'passingyr1', 'percentage1', 'cgpa1', 'division1', 'board2', 'subject2', 'passingyr2', 'percentage2', 'cgpa2', 'division2', 'iagree', 'place', 'date', 'email', 'phone','applicationId')
                            ->get();


        if(!empty($getApplicationTableData)){

            $requestData = [
                        'title' => $getApplicationTableData[0]->title,
                        'firstname' => $getApplicationTableData[0]->firstname,
                        'middlename' => $getApplicationTableData[0]->middlename,
                        'lastname' => $getApplicationTableData[0]->lastname,
                        'fathername' => $getApplicationTableData[0]->fathername,
                        'category' => $getApplicationTableData[0]->category,
                        'gender' => $getApplicationTableData[0]->gender,
                        'nationality' => $getApplicationTableData[0]->nationality,
                        'choice1st' => $getApplicationTableData[0]->choice1st,
                        'choice2nd' => $getApplicationTableData[0]->choice2nd,
                        'choice3rd' => $getApplicationTableData[0]->choice3rd,
                        'firstaddress1' => $getApplicationTableData[0]->firstaddress1,
                        'firstaddress2' => $getApplicationTableData[0]->firstaddress2,
                        'firstaddress3' => $getApplicationTableData[0]->firstaddress3,
                        'firstcity' => $getApplicationTableData[0]->firstcity,
                        'firststate' => $getApplicationTableData[0]->firststate,
                        'firstpincode' => $getApplicationTableData[0]->firstpincode,
                        'firstcontact' => $getApplicationTableData[0]->firstcontact,
                        'addresssame' => $getApplicationTableData[0]->addresssame,
                        'secondaddress1' => $getApplicationTableData[0]->secondaddress1,
                        'secondaddress2' => $getApplicationTableData[0]->secondaddress2,
                        'secondaddress3' => $getApplicationTableData[0]->secondaddress3,
                        'secondstate' => $getApplicationTableData[0]->secondstate,
                        'secondcity' => $getApplicationTableData[0]->secondcity,
                        'secondpincode' => $getApplicationTableData[0]->secondpincode,
                        'secondcontact' => $getApplicationTableData[0]->secondcontact,
                        'board1' => $getApplicationTableData[0]->board1,
                        'subject1' => $getApplicationTableData[0]->subject1,
                        'passingyr1' => $getApplicationTableData[0]->passingyr1,
                        'percentage1' => $getApplicationTableData[0]->percentage1,
                        'cgpa1' => $getApplicationTableData[0]->cgpa1,
                        'division1' => $getApplicationTableData[0]->division1,
                        'board2' => $getApplicationTableData[0]->board2,
                        'subject2' => $getApplicationTableData[0]->subject2,
                        'passingyr2' => $getApplicationTableData[0]->passingyr2,
                        'percentage2' => $getApplicationTableData[0]->percentage2,
                        'cgpa2' => $getApplicationTableData[0]->cgpa2,
                        'division2' => $getApplicationTableData[0]->division2,
                        'iagree' => $getApplicationTableData[0]->iagree,
                        'place' => $getApplicationTableData[0]->place,
                        'date' => $getApplicationTableData[0]->date,
                        'email' => $getApplicationTableData[0]->email,
                        'phone' => $getApplicationTableData[0]->phone,

                    ];

        }

        $emailText = env('ADMIN_EMAIL_ADDRESS');
        if(!empty($emailText) && ($this->fetchDataServiceController->isValidEmail($emailText) == 1)){ 
            \Mail::send('administrator/engineering-exam.sendEmailBody', array('email' => $emailText,'dataArray' => $requestData), function($message) use ($emailText)
            {
                $message->to($emailText, 'AdmissionX')->subject('All India Engineering Association Examination - Candidate');
            });  
        }
        
        // EMAIL TO ADMIN
        /*try {
            $emailText = env('ADMIN_EMAIL_ADDRESS');
            if(!empty($emailText) && ($this->fetchDataServiceController->isValidEmail($emailText) == 1)){ 
                \Mail::send('administrator/engineering-exam.sendEmailBody', array('email' => $emailText,'dataArray' => $requestData), function($message) use ($emailText)
                {
                    $message->to($emailText, 'AdmissionX')->subject('All India Engineering Association Examination - Candidate');
                }); 
            } 
        }catch ( \Swift_TransportException $e) {                
        }*/

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('All India Engineering Association Examination - '.$getApplicationTableData[0]->applicationId);

        
        return 'surl';
    }

    public function processFailurePaymentApplication($id)
    {
        //REMOVE DUPLICATE TRANSACTION RECORD
         $getAllExamTransactionIDObj = DB::table('examtransaction')
                                    ->where('engineeringexams_id', '=', $id)
                                    ->select('id')
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->get()
                                    ;
        Examtransaction::destroy($getAllExamTransactionIDObj[0]->id);



        $getApplicationTableData = DB::table('engineeringexams')
                            ->where('engineeringexams.id', '=', $id)
                            ->select('engineeringexams.id','title', 'firstname', 'middlename', 'lastname', 'fathername', 'category', 'gender', 'nationality', 'choice1st', 'choice2nd', 'choice3rd', 'firstaddress1', 'firstaddress2', 'firstaddress3', 'firstcity', 'firststate', 'firstpincode', 'firstcontact', 'secondaddress1', 'secondaddress2', 'secondaddress3', 'secondcity', 'secondstate', 'secondpincode', 'secondcontact', 'addresssame', 'board1', 'subject1', 'passingyr1', 'percentage1', 'cgpa1', 'division1', 'board2', 'subject2', 'passingyr2', 'percentage2', 'cgpa2', 'division2', 'iagree', 'place', 'date', 'email', 'phone','applicationId')
                            ->get();

        if(!empty($getApplicationTableData)){
            $requestData = [
                        'title' => $getApplicationTableData[0]->title,
                        'firstname' => $getApplicationTableData[0]->firstname,
                        'middlename' => $getApplicationTableData[0]->middlename,
                        'lastname' => $getApplicationTableData[0]->lastname,
                        'fathername' => $getApplicationTableData[0]->fathername,
                        'category' => $getApplicationTableData[0]->category,
                        'gender' => $getApplicationTableData[0]->gender,
                        'nationality' => $getApplicationTableData[0]->nationality,
                        'choice1st' => $getApplicationTableData[0]->choice1st,
                        'choice2nd' => $getApplicationTableData[0]->choice2nd,
                        'choice3rd' => $getApplicationTableData[0]->choice3rd,
                        'firstaddress1' => $getApplicationTableData[0]->firstaddress1,
                        'firstaddress2' => $getApplicationTableData[0]->firstaddress2,
                        'firstaddress3' => $getApplicationTableData[0]->firstaddress3,
                        'firstcity' => $getApplicationTableData[0]->firstcity,
                        'firststate' => $getApplicationTableData[0]->firststate,
                        'firstpincode' => $getApplicationTableData[0]->firstpincode,
                        'firstcontact' => $getApplicationTableData[0]->firstcontact,
                        'addresssame' => $getApplicationTableData[0]->addresssame,
                        'secondaddress1' => $getApplicationTableData[0]->secondaddress1,
                        'secondaddress2' => $getApplicationTableData[0]->secondaddress2,
                        'secondaddress3' => $getApplicationTableData[0]->secondaddress3,
                        'secondstate' => $getApplicationTableData[0]->secondstate,
                        'secondcity' => $getApplicationTableData[0]->secondcity,
                        'secondpincode' => $getApplicationTableData[0]->secondpincode,
                        'secondcontact' => $getApplicationTableData[0]->secondcontact,
                        'board1' => $getApplicationTableData[0]->board1,
                        'subject1' => $getApplicationTableData[0]->subject1,
                        'passingyr1' => $getApplicationTableData[0]->passingyr1,
                        'percentage1' => $getApplicationTableData[0]->percentage1,
                        'cgpa1' => $getApplicationTableData[0]->cgpa1,
                        'division1' => $getApplicationTableData[0]->division1,
                        'board2' => $getApplicationTableData[0]->board2,
                        'subject2' => $getApplicationTableData[0]->subject2,
                        'passingyr2' => $getApplicationTableData[0]->passingyr2,
                        'percentage2' => $getApplicationTableData[0]->percentage2,
                        'cgpa2' => $getApplicationTableData[0]->cgpa2,
                        'division2' => $getApplicationTableData[0]->division2,
                        'iagree' => $getApplicationTableData[0]->iagree,
                        'place' => $getApplicationTableData[0]->place,
                        'date' => $getApplicationTableData[0]->date,
                        'email' => $getApplicationTableData[0]->email,
                        'phone' => $getApplicationTableData[0]->phone,

                    ];
        }
        
        // EMAIL TO ADMIN
        try {
            $emailText = env('ADMIN_EMAIL_ADDRESS');
            if(!empty($emailText) && ($this->fetchDataServiceController->isValidEmail($emailText) == 1)){ 
                \Mail::send('administrator/engineering-exam.sendEmailBody', array('email' => $emailText,'dataArray' => $requestData), function($message) use ($emailText)
                {
                    $message->to($emailText, 'AdmissionX')->subject('All India Engineering Association Examination - Candidate');
                });
            }  
        }catch ( \Swift_TransportException $e) {                
        }

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('All India Engineering Association Examination - '.$getApplicationTableData[0]->applicationId);

        return 'furl';
    }


    public function failurePayment()
    {   
        Session::flash('paymentFailureMessage', 'Your transaction has been cancelled because of some reason!');
        return view('website.home.exam-payment.successPayment');
    }

    public function successPayment()
    {   
        Session::flash('paymentSuccessMessage', 'Your transaction has been successfully submitted! Thank you, we will contact you soon with details');
        return view('website.home.exam-payment.successPayment');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //PAYU MONEY CLASSES
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Returns the pay page url or the merchant js file.
     * 
     * @param unknown $params           
     * @param unknown $salt         
     * @throws Exception
     * @return Ambigous <multitype:number string , multitype:number Ambigous <boolean, string> >
     */
    function pay ( $params, $salt )
    {
        if ( ! is_array( $params ) ) throw new Exception( 'Pay params is empty' );
        
        if ( empty( $salt ) ) throw new Exception( 'Salt is empty' );
        
        $payment = new Payment( $salt );
        $result = $payment->pay( $params );
        unset( $payment );
        
        return $result;
    }

    /**
     * Displays the pay page.
     * 
     * @param unknown $params           
     * @param unknown $salt         
     * @throws Exception
     */
    function pay_page( $params, $salt )
    {  
        if ( count( $_POST ) && isset( $_POST['mihpayid'] ) && ! empty( $_POST['mihpayid'] ) ) {
            $_POST['surl']  = $params['surl'];
            $_POST['furl']  = $params['furl'];
            $result         = $this->response( $_POST, $salt );
            Misc::show_exam_reponse( $result );
            exit(0);
        } else{ 
            $host = (isset( $_SERVER['https'] ) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            /*if ( isset( $_SERVER['REQUEST_URI'] ) && ! empty( $_SERVER['REQUEST_URI'] ) ) $params['surl'] = $host;
            if ( isset( $_SERVER['REQUEST_URI'] ) && ! empty( $_SERVER['REQUEST_URI'] ) ) $params['furl'] = $host;*/
            $result = $this->pay( $params, $salt );
            Misc::show_exam_page($result);
            exit(0);
        }
    }

    /**
     * Returns the response object.
     * 
     * @param unknown $params           
     * @param unknown $salt         
     * @throws Exception
     * @return number
     */
    function response ( $params, $salt )
    {
        if ( ! is_array( $params ) ) throw new Exception( 'PayU response params is empty' );
        
        if ( empty( $salt ) ) throw new Exception( 'Salt is empty' );
        
        if ( empty( $params['status'] ) ) throw new Exception( 'Status is empty' );
        
        $response = new ResponsePayu( $salt );
        $result = $response->get_response( $_POST );
        unset( $response );
        
        return $result;
    }

    public function handleSuccessExamPaymentAction(Request $request, $id)
    {
        //print_r($id);die;
        //REMOVE DUPLICATE TRANSACTION RECORD
        $getAllExamTransactionIDObj = DB::table('examtransaction')
                                    ->where('examTransactionHashKey', '=', $id)
                                    ->select('id','engineeringexams_id')
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->get()
                                    ;

        //Examtransaction::destroy($getAllExamTransactionIDObj[0]->id);
        if (sizeof($getAllExamTransactionIDObj) > 0) {
            $updateTransactionsObj = Examtransaction::where('id', '=', $getAllExamTransactionIDObj[0]->id)->firstOrFail();
            $updateTransactionsObj->paymentstatus_id = '1';
            $updateTransactionsObj->examTransactionHashKey = null;
            $updateTransactionsObj->save();

            $getApplicationTableData = DB::table('engineeringexams')
                                ->where('engineeringexams.id', '=', $getAllExamTransactionIDObj[0]->engineeringexams_id)
                                ->select('engineeringexams.id','title', 'firstname', 'middlename', 'lastname', 'fathername', 'category', 'gender', 'nationality', 'choice1st', 'choice2nd', 'choice3rd', 'firstaddress1', 'firstaddress2', 'firstaddress3', 'firstcity', 'firststate', 'firstpincode', 'firstcontact', 'secondaddress1', 'secondaddress2', 'secondaddress3', 'secondcity', 'secondstate', 'secondpincode', 'secondcontact', 'addresssame', 'board1', 'subject1', 'passingyr1', 'percentage1', 'cgpa1', 'division1', 'board2', 'subject2', 'passingyr2', 'percentage2', 'cgpa2', 'division2', 'iagree', 'place', 'date', 'email', 'phone','applicationId','examTransactionHashKey')
                                ->get();

            if(!empty($getApplicationTableData)){

                $requestData = [
                            'title' => $getApplicationTableData[0]->title,
                            'firstname' => $getApplicationTableData[0]->firstname,
                            'middlename' => $getApplicationTableData[0]->middlename,
                            'lastname' => $getApplicationTableData[0]->lastname,
                            'fathername' => $getApplicationTableData[0]->fathername,
                            'category' => $getApplicationTableData[0]->category,
                            'gender' => $getApplicationTableData[0]->gender,
                            'nationality' => $getApplicationTableData[0]->nationality,
                            'choice1st' => $getApplicationTableData[0]->choice1st,
                            'choice2nd' => $getApplicationTableData[0]->choice2nd,
                            'choice3rd' => $getApplicationTableData[0]->choice3rd,
                            'firstaddress1' => $getApplicationTableData[0]->firstaddress1,
                            'firstaddress2' => $getApplicationTableData[0]->firstaddress2,
                            'firstaddress3' => $getApplicationTableData[0]->firstaddress3,
                            'firstcity' => $getApplicationTableData[0]->firstcity,
                            'firststate' => $getApplicationTableData[0]->firststate,
                            'firstpincode' => $getApplicationTableData[0]->firstpincode,
                            'firstcontact' => $getApplicationTableData[0]->firstcontact,
                            'addresssame' => $getApplicationTableData[0]->addresssame,
                            'secondaddress1' => $getApplicationTableData[0]->secondaddress1,
                            'secondaddress2' => $getApplicationTableData[0]->secondaddress2,
                            'secondaddress3' => $getApplicationTableData[0]->secondaddress3,
                            'secondstate' => $getApplicationTableData[0]->secondstate,
                            'secondcity' => $getApplicationTableData[0]->secondcity,
                            'secondpincode' => $getApplicationTableData[0]->secondpincode,
                            'secondcontact' => $getApplicationTableData[0]->secondcontact,
                            'board1' => $getApplicationTableData[0]->board1,
                            'subject1' => $getApplicationTableData[0]->subject1,
                            'passingyr1' => $getApplicationTableData[0]->passingyr1,
                            'percentage1' => $getApplicationTableData[0]->percentage1,
                            'cgpa1' => $getApplicationTableData[0]->cgpa1,
                            'division1' => $getApplicationTableData[0]->division1,
                            'board2' => $getApplicationTableData[0]->board2,
                            'subject2' => $getApplicationTableData[0]->subject2,
                            'passingyr2' => $getApplicationTableData[0]->passingyr2,
                            'percentage2' => $getApplicationTableData[0]->percentage2,
                            'cgpa2' => $getApplicationTableData[0]->cgpa2,
                            'division2' => $getApplicationTableData[0]->division2,
                            'iagree' => $getApplicationTableData[0]->iagree,
                            'place' => $getApplicationTableData[0]->place,
                            'date' => $getApplicationTableData[0]->date,
                            'email' => $getApplicationTableData[0]->email,
                            'phone' => $getApplicationTableData[0]->phone,

                        ];

            }

            $emailText = env('ADMIN_EMAIL_ADDRESS');
            try {
                if(!empty($emailText) && ($this->fetchDataServiceController->isValidEmail($emailText) == 1)){ 
                    \Mail::send('administrator/engineering-exam.sendEmailBody', array('email' => $emailText,'dataArray' => $requestData), function($message) use ($emailText)
                    {
                        $message->to($emailText, 'AdmissionX')->subject('All India Engineering Association Examination - Candidate');
                    }); 
                } 
            }catch ( \Swift_TransportException $e) {                
            }
            
            // EMAIL TO ADMIN
            /*try {
                $emailText = env('ADMIN_EMAIL_ADDRESS');
                if(!empty($emailText) && ($this->fetchDataServiceController->isValidEmail($emailText) == 1)){ 
                    \Mail::send('administrator/engineering-exam.sendEmailBody', array('email' => $emailText,'dataArray' => $requestData), function($message) use ($emailText)
                    {
                        $message->to($emailText, 'AdmissionX')->subject('All India Engineering Association Examination - Candidate');
                    });  
                }
            }catch ( \Swift_TransportException $e) {                
            }*/

            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('All India Engineering Association Examination - '.$getApplicationTableData[0]->applicationId);

            Session::flash('paymentSuccessMessage', 'Your transaction has been successfully submitted! Thank you, we will contact you soon with details');
            return view('website.home.exam-payment.successPayment');  
        }else{
            Session::flash('paymentSuccessMessage', 'Your transaction key has been invalid or you have opened the wrong route.');
            return view('website.home.exam-payment.successPayment'); 
        }                    
    }

    public function handleFailureExamPaymentAction(Request $request, $id)
    {
        //REMOVE DUPLICATE TRANSACTION RECORD
         $getAllExamTransactionIDObj = DB::table('examtransaction')
                                    ->where('examTransactionHashKey', '=', $id)
                                    ->select('id','engineeringexams_id')
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->get()
                                    ;
        //Examtransaction::destroy($getAllExamTransactionIDObj[0]->id);
        if (sizeof($getAllExamTransactionIDObj) > 0) {
            $updateTransactionsObj = Examtransaction::where('id', '=', $getAllExamTransactionIDObj[0]->id)->firstOrFail();
            $updateTransactionsObj->examTransactionHashKey = null;
            $updateTransactionsObj->paymentstatus_id = '2';
            $updateTransactionsObj->save();

            $getApplicationTableData = DB::table('engineeringexams')
                            ->where('engineeringexams.id', '=', $getAllExamTransactionIDObj[0]->engineeringexams_id)
                            ->select('engineeringexams.id','title', 'firstname', 'middlename', 'lastname', 'fathername', 'category', 'gender', 'nationality', 'choice1st', 'choice2nd', 'choice3rd', 'firstaddress1', 'firstaddress2', 'firstaddress3', 'firstcity', 'firststate', 'firstpincode', 'firstcontact', 'secondaddress1', 'secondaddress2', 'secondaddress3', 'secondcity', 'secondstate', 'secondpincode', 'secondcontact', 'addresssame', 'board1', 'subject1', 'passingyr1', 'percentage1', 'cgpa1', 'division1', 'board2', 'subject2', 'passingyr2', 'percentage2', 'cgpa2', 'division2', 'iagree', 'place', 'date', 'email', 'phone','applicationId','examTransactionHashKey')
                            ->get();

            if(!empty($getApplicationTableData)){
                $requestData = [
                            'title' => $getApplicationTableData[0]->title,
                            'firstname' => $getApplicationTableData[0]->firstname,
                            'middlename' => $getApplicationTableData[0]->middlename,
                            'lastname' => $getApplicationTableData[0]->lastname,
                            'fathername' => $getApplicationTableData[0]->fathername,
                            'category' => $getApplicationTableData[0]->category,
                            'gender' => $getApplicationTableData[0]->gender,
                            'nationality' => $getApplicationTableData[0]->nationality,
                            'choice1st' => $getApplicationTableData[0]->choice1st,
                            'choice2nd' => $getApplicationTableData[0]->choice2nd,
                            'choice3rd' => $getApplicationTableData[0]->choice3rd,
                            'firstaddress1' => $getApplicationTableData[0]->firstaddress1,
                            'firstaddress2' => $getApplicationTableData[0]->firstaddress2,
                            'firstaddress3' => $getApplicationTableData[0]->firstaddress3,
                            'firstcity' => $getApplicationTableData[0]->firstcity,
                            'firststate' => $getApplicationTableData[0]->firststate,
                            'firstpincode' => $getApplicationTableData[0]->firstpincode,
                            'firstcontact' => $getApplicationTableData[0]->firstcontact,
                            'addresssame' => $getApplicationTableData[0]->addresssame,
                            'secondaddress1' => $getApplicationTableData[0]->secondaddress1,
                            'secondaddress2' => $getApplicationTableData[0]->secondaddress2,
                            'secondaddress3' => $getApplicationTableData[0]->secondaddress3,
                            'secondstate' => $getApplicationTableData[0]->secondstate,
                            'secondcity' => $getApplicationTableData[0]->secondcity,
                            'secondpincode' => $getApplicationTableData[0]->secondpincode,
                            'secondcontact' => $getApplicationTableData[0]->secondcontact,
                            'board1' => $getApplicationTableData[0]->board1,
                            'subject1' => $getApplicationTableData[0]->subject1,
                            'passingyr1' => $getApplicationTableData[0]->passingyr1,
                            'percentage1' => $getApplicationTableData[0]->percentage1,
                            'cgpa1' => $getApplicationTableData[0]->cgpa1,
                            'division1' => $getApplicationTableData[0]->division1,
                            'board2' => $getApplicationTableData[0]->board2,
                            'subject2' => $getApplicationTableData[0]->subject2,
                            'passingyr2' => $getApplicationTableData[0]->passingyr2,
                            'percentage2' => $getApplicationTableData[0]->percentage2,
                            'cgpa2' => $getApplicationTableData[0]->cgpa2,
                            'division2' => $getApplicationTableData[0]->division2,
                            'iagree' => $getApplicationTableData[0]->iagree,
                            'place' => $getApplicationTableData[0]->place,
                            'date' => $getApplicationTableData[0]->date,
                            'email' => $getApplicationTableData[0]->email,
                            'phone' => $getApplicationTableData[0]->phone,

                        ];
            }
            
            // EMAIL TO ADMIN
            try {
                $emailText = env('ADMIN_EMAIL_ADDRESS');
                if(!empty($emailText) && ($this->fetchDataServiceController->isValidEmail($emailText) == 1)){ 
                    \Mail::send('administrator/engineering-exam.sendEmailBody', array('email' => $emailText,'dataArray' => $requestData), function($message) use ($emailText)
                    {
                        $message->to($emailText, 'AdmissionX')->subject('All India Engineering Association Examination - Candidate');
                    });  
                }
            }catch ( \Swift_TransportException $e) {                
            }

            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('All India Engineering Association Examination - '.$getApplicationTableData[0]->applicationId);

            Session::flash('paymentFailureMessage', 'Your transaction has been cancelled because of some reason!');
            return view('website.home.exam-payment.successPayment');  
        }else{
            Session::flash('paymentSuccessMessage', 'Your transaction key has been invalid or you have opened the wrong route.');
            return view('website.home.exam-payment.successPayment'); 
        }
    }
}
