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
                $userObj->userstatus_id = '2'; //Inasctive
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
                if (!mkdir($directoryForDocument, 0777, true)) {
                    die('Failed to create folders...');
                }
                if (!mkdir($directoryForGallery, 0777, true)) {
                    die('Failed to create folders...');
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

                //Send Signup message for student
               //$smsMessageData = 'Welcome to Admission X. We are happy to have you onboard ! Your registered email id is : '.$email;
                $smsMessageData = Config::get('systemsetting.SIGNUPMSG').' '.$email.' '.Config::get('systemsetting.SMS_GROUP_NAME_5');
                $userMobileNo = $phone;
                // Define Function Call
                //$resultSet = $this->sendSignupSms($userMobileNo, $smsMessageData);
                $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_SIGN_OTP'));

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
        $userId = 'saroj.trans';
        $password = 'v4wxb';
        $senderId = 'SARSIS';
        $dltContentId = '1707175610376977716'; // Update this with your template ID
        
        $url = 'https://gui.smartping.ai/fe/api/v1/send';
        
        $data = array(
            'username' => $userId,
            'password' => $password,
            'unicode' => 'false',
            'from' => $senderId,
            'to' => $userMobileNo,
            'text' => $smsMessageData, // Message must match registered DLT template
            'dltContentId' => $dltContentId
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Log the response for debugging
        error_log('SMS Response: ' . $response);
        
        return $response;
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
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = env('MAIL_USERNAME');
                $mail->Password = env('MAIL_PASSWORD');
                $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                $mail->Port = env('MAIL_PORT');

                $mail->setFrom(env('MAIL_USERNAME'), 'Welcome to AdmissionX');
                $mail->addAddress($email, 'AdmissionX');

                // Fix the template path
                $templatePath = public_path('assets/studentSignupMail.html');
                if (file_exists($templatePath)) {
                    $message = file_get_contents($templatePath);
                    $message = str_replace('%ecyEmailUrl%', $ecyEmailUrl, $message);
                } else {
                    // Fallback message if template doesn't exist
                    $message = '<h2>Welcome to AdmissionX!</h2><p>Thank you for registering. Please verify your email by clicking <a href="'.$ecyEmailUrl.'">here</a></p>';
                }

                $mail->isHTML(true);
                $mail->Subject = 'Thank you for registering with AdmissionX';
                $mail->Body = $message;

                if(!$mail->send()) {
                    error_log('Mail Error: ' . $mail->ErrorInfo);
                    return false;
                } else {
                    Session::flash('sendEmailMsg', 'Email sent successfully!');
                    return true;
                }
            }
        } catch (Exception $e) {
            error_log('Email sending failed: ' . $e->getMessage());
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

    public function verifyEmailAddress($token)
    {
        try {
            $userObj = User::where('token', '=' ,$token)->firstOrFail();
            $userObj->token = '';
            $userObj->userstatus_id = '1';
            $userObj->save();

            Session::flash('verifiedEmail', 'Thank you for email confirmation! Happy to have you on our board.');
        } catch ( \Exception $e) {
            Session::flash('verifiedEmail', 'Invalid Url');
        }

        return View::make('administrator/users.login');
    }
}