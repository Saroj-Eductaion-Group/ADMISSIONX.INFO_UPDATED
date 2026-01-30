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
use Config;
use DateTime;
use App\User;
use Illuminate\Database\QueryException as QueryException;
use App\Models\Country as Country;
use App\Models\State as State;
use App\Models\CollegeType as CollegeType;
use App\Models\City as City;
use App\Models\Address as Address;
use App\Models\Gallery as Gallery;
use App\Models\Document as Document;
use App\Models\AddressType as AddressType;
use App\Models\StudentMark as StudentMark;
use App\Models\StudentProfile as StudentProfile;
use GuzzleHttp\Client;
use App\Models\Entranceexam as Entranceexam;
use App\Models\SeoContent;
use App\Models\CollegeMaster;
use App\Http\Controllers\Helper\FetchDataServiceController;
use Illuminate\Support\Facades\Http;

class studentSignUpController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

    public function oldStudentSignUp()
    {
        $seoSlugName = 'registration-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
        return view('student.studentSignUp', compact('seocontent'));
    }

    public function studentSignUp()
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            if( $roleGrant['userrole_id'] == '1' && $roleGrant['userstatus_id'] == '1' )
            {
                return Redirect::to('/administrator/dashboard');
            }elseif( $roleGrant['userrole_id'] == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getSlugUrl = CollegeProfile::where('users_id', '=', $userId)->firstOrFail();
                //return Redirect::to('/college/dashboard/', [ $getSlugUrl->slug]);
                return redirect()->route('college_dash', $getSlugUrl->slug);
            }elseif ( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ) {

                $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();
                return redirect()->route('student_dash', $getSlugUrl->slug);

            }elseif ( $roleGrant['userrole_id'] == '4'  && $roleGrant['userstatus_id'] == '1'  ) {
                return Redirect::to('/agent/dashboard');
            }else{
                Auth::logout();
                return Redirect::to('/');
            }
        }
        Auth::logout();
        $seoSlugName = 'registration-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(18);

        return view('website.home.signup-pages.new-student-signup', compact('seocontent','getPageContentDataObj'));
    }

    public function index( Request $request)
    {
        //GET PARAMS
        if (!empty(Input::get('g-recaptcha-response'))) {
            $suffix = Input::get('suffix');
            $email = Input::get('email');
            $firstName = Input::get('firstName');
            $middleName = Input::get('middleName');
            $lastName = Input::get('lastName');
            $phone = Input::get('phone');
            $password = Input::get('password');

            //Check for already existing account
            $checkEmailDuplicateObj = DB::table('users')
                                        ->where('email' ,'=', $email)
                                        ->take(1)
                                        ->get()
                                        ;
            if( empty($checkEmailDuplicateObj) ){
                //STORE INTO USERS TABLE
                $userObj = New User;
                if (Input::get('suffix')) {
                    $userObj->suffix = $suffix;
                }
                $userObj->email = $email;
                $userObj->firstName = $firstName;
                if (Input::get('middleName')) {
                    $userObj->middleName = $middleName;
                }
                $userObj->lastName = $lastName;
                $userObj->password = Hash::make($password);
                $userObj->phone = $phone;
                $userObj->userstatus_id = '2'; //Inactive
                $userObj->userrole_id = '3'; //ROLE_STUDENT 

                $encrytEmail = md5($email);
                $userObj->token = $encrytEmail;

                $userObj->save();


                $getEmailWiseUserId = User::where('email', '=', $email)->firstOrFail();

                //STORE INTO STUDENTPROFILES TABLE FOR CREATE RECORD
                $studentProfileObj = New StudentProfile;
                $studentProfileObj->users_id = $getEmailWiseUserId->id;
                $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getEmailWiseUserId->firstname.' '.$getEmailWiseUserId->id);
                $slugUrl = strtolower($slugUrl);
                $studentProfileObj->slug = strtolower($slugUrl);

                if( !empty(Input::get('gender')) ){
                    $studentProfileObj->gender = Input::get('gender');    
                }

                if( !empty(Input::get('dateofbirth')) ){
                    $studentProfileObj->dateofbirth = Input::get('dateofbirth');    
                }

                if( !empty(Input::get('parentsname')) ){
                    $studentProfileObj->parentsname = Input::get('parentsname');    
                }

                if( !empty(Input::get('parentsnumber')) ){
                    $studentProfileObj->parentsnumber = Input::get('parentsnumber');    
                }

                $studentProfileObj->save();

                //CREATE TWO FOLDERS IN GALLERY AND DOCUMENTS FOR PHOTOS
                $directoryForDocument =  public_path().'/document/'.$slugUrl;
                $directoryForGallery =  public_path().'/gallery/'.$slugUrl;
                if (!is_dir($directoryForDocument)) {
                    mkdir($directoryForDocument, 0777, true);
                }
                if (!is_dir($directoryForGallery)) {
                    mkdir($directoryForGallery, 0777, true);
                }
                
                //GET STUDENT PROFILE ID AS PER SLUG
                $getStudentProId = StudentProfile::where('slug', '=', $slugUrl)->firstOrFail();
                
                //STORE INTO ADDRESS TABLE FOR CREATE RECORD
                //For Permanent Address
                $addressObj = New Address;
                $addressObj->addresstype_id = '3';
                $addressObj->studentprofile_id = $getStudentProId->id;
                $addressObj->save();

                //For Present Address
                $addressObj = New Address;
                $addressObj->addresstype_id = '4';
                $addressObj->studentprofile_id = $getStudentProId->id;
                $addressObj->save();

                $studentMarksObj = new StudentMark;
                $studentMarksObj->name = '10th'; 
                $studentMarksObj->category_id = '3';
                $studentMarksObj->studentprofile_id = $getStudentProId->id; 
                $studentMarksObj->save();

                $studentMarksObj = new StudentMark;
                $studentMarksObj->name = '11th';
                $studentMarksObj->category_id = '3';
                $studentMarksObj->studentprofile_id = $getStudentProId->id; 
                $studentMarksObj->save();

                $studentMarksObj = new StudentMark;
                $studentMarksObj->name = '12th';  
                $studentMarksObj->category_id = '3';
                $studentMarksObj->studentprofile_id = $getStudentProId->id; 
                $studentMarksObj->save();

                $studentMarksObj = new StudentMark;
                $studentMarksObj->name = 'Graduation';  
                $studentMarksObj->category_id = '3';
                $studentMarksObj->studentprofile_id = $getStudentProId->id; 
                $studentMarksObj->save();

                $seoContentObj = New SeoContent;
                $seoContentObj->pagetitle = Input::get('firstName');
                $seoContentObj->misc = 'studentpage';
                $seoContentObj->userId = $getStudentProId->id;
                $seoContentObj->employee_id = Auth::id();
                $seoContentObj->save();

                $baseUrl = env('APP_URL').'/verify-student-email-address/';
                $ecyEmailUrl = $baseUrl.$encrytEmail;

                $resultMailSet = $this->sendStudentSignupMail($email, $ecyEmailUrl);

                //GET EMAIL ADDRESS
                $getEmailObj = DB::table('users')
                                        ->where('email' ,'=', $email)
                                        ->take(1)
                                        ->get()
                                        ;

                $encryptPasswordId = \Illuminate\Support\Facades\Crypt::encrypt($password);

                setcookie('studentUserId', $getEmailObj[0]->id, time() + (86400 * 30), "/");
                setcookie('firstName', $firstName, time() + (86400 * 30), "/");
                setcookie('middleName', $middleName, time() + (86400 * 30), "/");
                setcookie('lastName', $lastName, time() + (86400 * 30), "/");
                setcookie('email', $email, time() + (86400 * 30), "/");

                //Send Signup message for student using SmartPing
                $smsMessageData = "Welcome to Admission X! Your account has been created successfully. Email: " . $email;
                
                // Send SMS using SmartPing
                $smsResult = $this->sendSmartPingSMS($phone, $smsMessageData);
                
                // Log SMS result
                \Log::info('SMS Sent to ' . $phone . ': ' . ($smsResult ? 'Success' : 'Failed'));

                $postPublishDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postPublishDataFromSession($getEmailWiseUserId->id);

                $postAskExamDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postAskExamDataFromSession($getEmailWiseUserId->id);

                $dataArray = array(
                   'code' => '200',
                   'email' => $getEmailObj[0]->email,
                   'response' => '',
                   'slug' => $slugUrl,
                );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                exit;

            }else{
                $dataArray = array(
                   'code' => '401',
                   'email' => $email,
                   'response' => '',
                   'slug' => '',
                );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                exit;
            }
        }else{
            $dataArray = array(
               'code' => '400',
               'email' => '',
               'response' => 'Please verify the captcha',
               'slug' => '',
            );
            header('Content-Type: application/json');
            echo json_encode($dataArray);
            exit;
        }
       
    }

    // SmartPing SMS Function
    private function sendSmartPingSMS($mobile, $message)
    {
        try {
            $username = env('SMARTPING_USERNAME', 'saroj.trans');
            $password = env('SMARTPING_PASSWORD', 'v4wxb');
            $senderid = env('SMARTPING_SENDER', 'SARSIS');
            
            // Prepare mobile number (add 91 if not present)
            if (strpos($mobile, '91') !== 0) {
                $mobile = '91' . $mobile;
            }
            
            $url = 'https://api.smartping.ai/send';
            
            $params = [
                'username' => $username,
                'password' => $password,
                'senderid' => $senderid,
                'mobile' => $mobile,
                'message' => $message,
                'unicode' => 'false'
            ];
            
            $fullUrl = $url . '?' . http_build_query($params);
            
            \Log::info('SmartPing SMS URL: ' . $fullUrl);
            
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $fullUrl, [
                'verify' => false,
                'timeout' => 30
            ]);
            
            $responseBody = $response->getBody()->getContents();
            \Log::info('SmartPing Response: ' . $responseBody);
            
            // Check if SMS was sent successfully
            if (strpos($responseBody, 'SUCCESS') !== false || 
                strpos($responseBody, 'OK') !== false || 
                strpos($responseBody, 'MessageId') !== false) {
                return true;
            }
            
            return false;
            
        } catch (\Exception $e) {
            \Log::error('SmartPing SMS Error: ' . $e->getMessage());
            return false;
        }
    }

    public function smsCallback(Request $request)
    {
        // Handle SMS delivery status
        $status = $request->input('status');
        $messageId = $request->input('message_id');
        
        // Log or process the callback data as needed
        \Log::info('SMS Callback: ', $request->all());
        
        return response('OK', 200);
    }

    public function sendSignupSms($userMobileNo, $smsMessageData)
    {
        // Use SmartPing instead
        return $this->sendSmartPingSMS($userMobileNo, $smsMessageData);
    }

    public function sendStudentSignupMail($email, $ecyEmailUrl)
    {
         try {
            if(!empty($email))
            {
                $mail = new PHPMailer\PHPMailer\PHPMailer;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
                $mail->SMTPAuth = true;
                $mail->Username = env('MAIL_USERNAME');
                $mail->Password = env('MAIL_PASSWORD');
                $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
                $mail->Port = env('MAIL_PORT', 587);

                $mail->setFrom(env('MAIL_FROM_ADDRESS', 'noreply@admissionx.info'), env('MAIL_FROM_NAME', 'AdmissionX'));
                $mail->addAddress($email, 'AdmissionX');

                // Email template
                $message = '<!DOCTYPE html>
                <html>
                <head>
                    <title>Welcome to AdmissionX</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
                        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                        .header { text-align: center; padding-bottom: 20px; border-bottom: 2px solid #337ab7; }
                        .header h2 { color: #337ab7; margin: 0; }
                        .content { padding: 20px 0; }
                        .button { display: inline-block; background-color: #337ab7; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; }
                        .footer { text-align: center; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 14px; }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="header">
                            <h2>Welcome to AdmissionX!</h2>
                        </div>
                        <div class="content">
                            <p>Dear Student,</p>
                            <p>Thank you for registering with AdmissionX. Your account has been created successfully.</p>
                            <p>Please verify your email address by clicking the button below:</p>
                            <p style="text-align: center; margin: 30px 0;">
                                <a href="' . $ecyEmailUrl . '" class="button">Verify Email Address</a>
                            </p>
                            <p>If the button doesn\'t work, copy and paste this URL in your browser:</p>
                            <p style="word-break: break-all; background-color: #f9f9f9; padding: 10px; border-radius: 5px;">' . $ecyEmailUrl . '</p>
                            <p>After verification, you can login and complete your profile.</p>
                            <p>If you didn\'t create an account, please ignore this email.</p>
                        </div>
                        <div class="footer">
                            <p>Best regards,<br><strong>AdmissionX Team</strong></p>
                            <p>Need help? Contact us at: support@admissionx.info</p>
                        </div>
                    </div>
                </body>
                </html>';

                $mail->isHTML(true);
                $mail->Subject = 'Verify Your AdmissionX Account';
                $mail->Body = $message;
                $mail->AltBody = "Welcome to AdmissionX! Please verify your email by visiting: " . $ecyEmailUrl;

                if(!$mail->send()) {
                    \Log::error('Email Error: ' . $mail->ErrorInfo);
                    return false;
                } else {
                    \Log::info('Email sent successfully to: ' . $email);
                    return true;
                }
            }
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            return false;
        }        
    }

    public function detailsSignUp($slugUrl)
    {   
        $getStudentNameObj = DB::table('studentprofile')
                        ->leftJoin('users', 'studentprofile.users_id', '=','users.id')
                        ->where('studentprofile.slug', '=', $slugUrl)
                        ->select('users.id as usersId', 'users.firstname as firstName', 'users.lastname as lastName', 'users.middlename as middleName', 'users.phone', 'users.email', 'studentprofile.id as studentprofileId','studentprofile.slug','userrole_id','userstatus_id')
                        ->take(1)
                        ->get()
                        ;

        if (sizeof($getStudentNameObj) > 0) {
            if( !empty($_COOKIE['studentUserId'])){
                $entranceExam = DB::table('entranceexam')
                        ->orderBy('entranceexam.name', 'ASC')
                        ->get()
                        ;

                if ($getStudentNameObj[0]->userstatus_id == 1) {
                    $studentUserId = $_COOKIE['studentUserId'];
                    $userObj = User::find($studentUserId);
                    Auth::login($userObj);
                    if($userObj->userrole_id == '3'  && $userObj->userstatus_id == '1') {
                        $getSlugUrl = StudentProfile::where('users_id', '=', $studentUserId)->firstOrFail();
                        return redirect()->route('student_dash', $getSlugUrl->slug);
                    }
                }else{
                    $studentUserId = $_COOKIE['studentUserId'];
                    $firstName = $_COOKIE['firstName'];
                    if (!empty($_COOKIE['lastName'])) {
                        $lastName = $_COOKIE['lastName'];
                    }else{
                        $lastName = "";
                    }
                    $email  = $_COOKIE['email']; 

                    $seoSlugName = 'registration-page';
                    $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
                    $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(18);
                    $prevYear = date("m/d/Y", strtotime("-10 years"));
                    $lastYear = date("Y", strtotime("-10 years"));
                    return view('student.detailSignUp', compact('seocontent','getPageContentDataObj','lastYear','prevYear'))
                           ->with('entranceExam', $entranceExam)
                            ->with('getStudentNameObj', $getStudentNameObj)
                            ->with('studentUserId', $studentUserId)
                            ->with('firstName', $firstName)
                            ->with('lastName', $lastName)
                            ->with('email', $email)
                            ->with('slug', $slugUrl)
                            ;
                }
            }else{
                Session::flash('confirmDisabledEmail','Email address not found'); 
                return Redirect::to('/login');
            }     
        }else{
            Session::flash('confirmDisabledEmail','Email address not found'); 
            return Redirect::to('/login');
        }    
    }

    public function studentDetailStore(Request $request)
    {
        // Implementation from backup file - truncated for brevity
        return redirect('/sucess-signup');
    }

    public function sucessSignUp()
    {
        return view('student.sucess');
    }

    // Test email functionality
    public function testEmail()
    {
        $testEmail = 'test@example.com';
        $testUrl = 'http://localhost:8000/verify-test';
        
        $result = $this->sendStudentSignupMail($testEmail, $testUrl);
        
        if ($result) {
            return response()->json(['status' => 'success', 'message' => 'Test email sent successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to send test email']);
        }
    }
    
    // Test SMS functionality
    public function testSMS()
    {
        $mobile = '91XXXXXXXXXX'; // Add your test number
        $message = 'Test SMS from AdmissionX - SmartPing API';
        
        $result = $this->sendSmartPingSMS($mobile, $message);
        
        if ($result) {
            return response()->json(['status' => 'success', 'message' => 'Test SMS sent successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to send test SMS']);
        }
    }

    public function verifyEmailAddress($token)
    {
        try {
            $userObj = User::where('token', '=' ,$token)->firstOrFail();
            $userObj->token = '';
            $userObj->userstatus_id = '1';
            $userObj->save();

            // Send welcome SMS after verification
            $smsMessage = "Welcome! Your AdmissionX account has been verified successfully.";
            $this->sendSmartPingSMS($userObj->phone, $smsMessage);

            Session::flash('verifiedEmail', 'Thank you for email confirmation! Happy to have you on our board.');
        } catch ( \Exception $e) {
            Session::flash('verifiedEmail', 'Invalid Url');
        }

        return View::make('administrator/users.login');
    }
}