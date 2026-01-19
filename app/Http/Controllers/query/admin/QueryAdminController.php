<?php

namespace App\Http\Controllers\query\admin;

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
use Config;
use App\Traits\CaptchaTrait;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\StudentProfile;
use App\Models\Query;
use GuzzleHttp\Client;
use App\Http\Controllers\Helper\FetchDataServiceController;

class QueryAdminController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }
    
	public function contactUsForm(Request $request)
    {

        if (!empty(Input::get('g-recaptcha-response'))) {
            # code...
            $queryDataObj = New Query();

            $getTheUserDetails = DB::table('users')->where('id', '=', Auth::id())->select('id', 'email','phone','firstname','middlename','lastname','userrole_id')->take(1)->get();

            if( !empty(Input::get('guestname')) ){
                $queryDataObj->guestname = Input::get('guestname');
            }else{
                $queryDataObj->guestname = $getTheUserDetails[0]->firstname.' '.$getTheUserDetails[0]->middlename.' '.$getTheUserDetails[0]->lastname;
            }

            if( !empty(Input::get('guestemail')) ){
                $queryDataObj->guestemail = Input::get('guestemail');
            }else{
                $queryDataObj->guestemail = $getTheUserDetails[0]->email;
            }

            if( !empty(Input::get('guestphone')) ){
                $queryDataObj->guestphone = Input::get('guestphone');
            }else if(!empty($getTheUserDetails[0]->phone)){
                $queryDataObj->guestphone = $getTheUserDetails[0]->phone;
            }
            else{
                $queryDataObj->guestphone = NULL;
            }

            if( !empty($getTheUserDetails) ){
                if( $getTheUserDetails[0]->userrole_id == '3' ){
                    $queryDataObj->student_id = $getTheUserDetails[0]->id;
                    $queryDataObj->queryflowtype = 'student-to-admin';
                    $queryDataObj->querytypeinfo = 'pending';
                }elseif( $getTheUserDetails[0]->userrole_id == '2' ){

                    $getCollegeProfieId = DB::table('collegeprofile')
                                            ->join('users', 'collegeprofile.users_id','=','users.id')
                                            ->where('collegeprofile.users_id', '=', $getTheUserDetails[0]->id)
                                            ->select('collegeprofile.id')
                                            ->orderBy('id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
                    $queryDataObj->college_id = $getCollegeProfieId[0]->id;
                    $queryDataObj->queryflowtype = 'college-to-admin';
                    $queryDataObj->querytypeinfo = 'pending';
                }else{
                    $queryDataObj->queryflowtype = 'guest-to-admin';
                }
            }else{
                $queryDataObj->queryflowtype = 'guest-to-admin';
                $queryDataObj->querytypeinfo = 'pending';
            }

            if( !empty(Input::get('subject')) ){
                $queryDataObj->subject = Input::get('subject');
            }

            if( !empty(Input::get('message')) ){
                $queryDataObj->message = Input::get('message');
            }

            $getTheAdmin = DB::table('users')->where('userrole_id', '=', '1')->select('id','email')->take(1)->get();
                $adminId = $getTheAdmin[0]->id;

            if( !empty($adminId) ){
                $queryDataObj->admin_id = $adminId;
            }

            $queryDataObj->chatkey = uniqid();

            $queryDataObj->save();

            if( !empty(Input::get('subject')) ){
                $subjectText = Input::get('subject');
            }else{
                $subjectText = '';
            }

            if( !empty(Input::get('message')) ){
                $messageText = Input::get('message');
            }else{
                $messageText = '';
            }

            $getTheEmailAdmin = DB::table('users')
                                ->where('userrole_id', '=', '1')
                                ->where('users.userstatus_id','=', '1')
                                ->where('users.email', '!=', 'support@admissionx.info')
                                ->select('email')
                                ->get();

            $supportEmailAddress = 'support@admissionx.info';
            $adminEmailId = array();
            foreach ($getTheEmailAdmin as $key => $value) {
                $adminEmailId = $value->email;
                //$adminEmailId[] = $tempArrayEmailId;

                try {

                    if(!empty($adminEmailId) && ($this->fetchDataServiceController->isValidEmail($adminEmailId) == 1))
                    {
                       /**Swift Mailer Data TO admin_id***/
                        \Mail::send('emailtemplate/query-admin.queryToAdmin', array('email' => $adminEmailId, 'subjectData' => $subjectText,'messageData' => $messageText, 'username' => $queryDataObj->guestname, 'useremail' => $queryDataObj->guestemail, 'usercontact' => $queryDataObj->guestphone  ), function($message) use ($adminEmailId)
                        {
                            $message->to($adminEmailId, 'AdmissionX')->subject('You got a new query');
                        });
                    }
                }catch ( \Swift_TransportException $e) {
                }
            }

            try {
                    if(!empty($supportEmailAddress) && ($this->fetchDataServiceController->isValidEmail($supportEmailAddress) == 1))
                    {
                       /**Swift Mailer Data TO admin_id***/
                        \Mail::send('emailtemplate/query-admin.queryToAdmin', array('email' => $supportEmailAddress, 'subjectData' => $subjectText,'messageData' => $messageText, 'username' => $queryDataObj->guestname, 'useremail' => $queryDataObj->guestemail, 'usercontact' => $queryDataObj->guestphone  ), function($message) use ($supportEmailAddress)
                        {
                            $message->to($supportEmailAddress, 'AdmissionX')->subject('You got a new query');
                        });
                    }
                }catch ( \Swift_TransportException $e) {
                }

            /*$smsMessageData = 'Your allotment letter has been mailed at your registered id, you are requested to report college within 15 days.';

            if( !empty(Input::get('guestphone')) ){
                $userMobileNo = '91'.$request->guestphone;
            }else{
                $userMobileNo = '91'.$getTheUserDetails[0]->phone;
            }

            // Define Function Call
            $this->sendSms($userMobileNo, $smsMessageData);*/

            Session::flash('confirmContactUs','Thanks for getting in touch. We will get back to you soon.');
            return Redirect::back();
        }else{
            Session::flash('errormessage','Please verify the captcha');
            return Redirect::back();
        }
    }

    public function sendSms($userMobileNo, $smsMessageData)
    {
        /***Send SMS *******************************/
        $userIdHorizonSms = Config::get('app.userIdHorizonSms');
        $passwordHorizonSms = Config::get('app.passwordHorizonSms');
        $accountFromHorizon = Config::get('app.accountFromHorizon');

        $toMobileNo = $userMobileNo;
        $message = $smsMessageData;

        //extract data from the post
        //set POST variables
        $url = 'http://210.210.26.40/sendsms/push_sms.php?';
        $fields = array(
            'user' => urlencode($userIdHorizonSms),
            'pwd' => urlencode($passwordHorizonSms),
            'from' => urlencode($accountFromHorizon),
            'to' => urlencode($toMobileNo),
            'msg' => urlencode($message),
        );

        //url-ify the data for the POST
        $fields_string = '';
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);
    }


}
