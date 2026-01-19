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

                // if(env('APP_ENV') == 'local'){
                //    $baseUrl = env('APP_URL').'/verify-student-email-address/';
                // }else{
                //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/verify-student-email-address/';
                // }

                $baseUrl = env('APP_URL').'/verify-student-email-address/';
                $ecyEmailUrl = $baseUrl.$encrytEmail;

                //SET TRY CATCH BLOCK FOR THANK YOU FOR REGISTERING
               /* try {
                   if(!empty($email) && ($this->fetchDataServiceController->isValidEmail($email) == 1))
                    {
                        //Swift Mailer Data Fetching      
                        \Mail::send('student.signupmail', array('email' => $email, 'ecyEmailUrl' => $ecyEmailUrl), function($message) use ($email)
                        {
                            $message->to($email, 'AdmissionX')->subject('Thank you for registering with AdmissionX');
                        });  
                    } 
                } catch ( \Swift_TransportException $e) {                
                }*/

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

    public function sendSignupSms($userMobileNo, $smsMessageData)
    {
        /***Send SMS *******************************/
        $userIdHorizonSms = Config::get('app.userIdHorizonSms');
        $passwordHorizonSms = Config::get('app.passwordHorizonSms');
        $accountFromHorizon = Config::get('app.accountFromHorizon');

        $url = 'http://210.210.26.40/sendsms/push_sms.php';

        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', $url, [
            'form_params' => [
                'user' => urlencode($userIdHorizonSms),
                'pwd' => urlencode($passwordHorizonSms),
                'from' => urlencode($accountFromHorizon),
                'to' => urlencode($userMobileNo),
                'msg' => $smsMessageData,
            ]
        ]);        
    }

    public function sendStudentSignupMail($email, $ecyEmailUrl)
    {
         try {
            if(!empty($email))
            {

                $header     =   'MIME-Version: 1.0' . "\r\n";
                $header     .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


                $mail               = new PHPMailer\PHPMailer\PHPMailer;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                stream_context_set_default( [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);
                get_headers('https://www.admissionx.info/');

                $mail->SMTPDebug = 0;                                   // Enable verbose debug output

                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username     = env('MAIL_USERNAME');  // SMTP username
                $mail->Password     = env('MAIL_PASSWORD');  // SMTP password
                $mail->SMTPSecure = env('MAIL_ENCRYPTION'); \/\/ Enable TLS encryption, `ssl` also accepted
                $mail->Port = env('MAIL_PORT'); \/\/ TCP port to connect to

                $mail->setFrom(env('MAIL_USERNAME'), 'Welcome to AdmissionX');
                $mail->addAddress($email, 'AdmissionX');       // Add a recipient

                $message = file_get_contents('assets/studentSignupMail.html');

                $message = str_replace('%ecyEmailUrl%', $ecyEmailUrl, $message);
                $mail->isHTML(true);                                     // Set email format to HTML

                $mail->Subject = 'Thank you for registering with AdmissionX';
                $mail->Body    =  ''.$message.'';

                if(!$mail->send()) {
                    // echo 'Message could not be sent.';
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    Session::flash('sendEmailMsg', 'Email send Succesfully!');
                }
            }
        } catch (Exception $e) {
            
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
                    //$middleName  = $_COOKIE['middleName']; 
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
                            //->with('middleName', $middleName)
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

    public function getCurrentDOBCalculate( Request $request )
    {
        $dateofbirth = Input::get('dateofbirth');
        
        $currentDateTime = date("Y-m-d"); 
        
        $dateExp = explode('/', $dateofbirth);

        $bday = new DateTime($dateExp['2'].'-'.$dateExp['0'].'-'.$dateExp['1']);
        $today = new DateTime($currentDateTime);

        $diff = $today->diff($bday); 
        $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';    

        if( !empty($dateofbirth) ){
            $dataArray = array( 'code' => '200' , 'calculateDate' => $calculateDate, 'year' => $diff->y );
        }else{
            $dataArray = array( 'code' => '401' , 'calculateDate' => '', 'year' => '' );
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }

    public function getCurrentDOBCalculateApply( Request $request )
    {
        $dateofbirth = Input::get('dateofbirth');
        $currentDateTime = date("Y-m-d"); 
        $dateExp = explode('/', $dateofbirth);

       // $bday = new DateTime($dateExp['2'].'-'.$dateExp['1'].'-'.$dateExp['0']);
        $bday = new DateTime($dateExp['0']);
        $today = new DateTime($currentDateTime);

        $diff = $today->diff($bday); 
        $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';    

        if( !empty($dateofbirth) ){
            $dataArray = array( 'code' => '200' , 'calculateDate' => $calculateDate, 'year' => $diff->y );
        }else{
            $dataArray = array( 'code' => '401' , 'calculateDate' => '', 'year' => '' );
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }

    public function studentDetailStore(Request $request)
    {
        $slug = Input::get('slug');
        $studentUserId = Input::get('studentUserId');
        $calculateDate = '';
        $currentDateTime = date("Y-m-d"); 
        $studentProfileObj = StudentProfile::where('slug', '=', $slug)->firstOrFail();
        if (!empty($studentProfileObj)) {
            if( !empty(Input::get('gender')) ){
                $studentProfileObj->gender = Input::get('gender');    
            }
           
            if( !empty(Input::get('dateofbirth')) ){
                $dateofbirth = Input::get('dateofbirth');
                $dateExp = explode('/', $dateofbirth);

                $bday = new DateTime($dateExp['2'].'-'.$dateExp['0'].'-'.$dateExp['1']);
                $today = new DateTime($currentDateTime);

                $diff = $today->diff($bday); 
                $calculateDate = $diff->y;    

                //$dateofbirth = Input::get('dateofbirth');
                //$calculateDate = $currentDateTime -  $dateofbirth;
                $explodDate = explode('/', Input::get('dateofbirth'));
                $studentProfileObj->dateofbirth = $explodDate[2].'-'.$explodDate[0].'-'.$explodDate[1];    
            }

            if( !empty(Input::get('parentsname')) ){
                $studentProfileObj->parentsname = Input::get('parentsname');    
            }

            if( !empty(Input::get('parentsnumber')) ){
                $studentProfileObj->parentsnumber = Input::get('parentsnumber');    
            }

            if( !empty(Input::get('hobbies')) ){
                $studentProfileObj->hobbies = Input::get('hobbies');    
            }

            if( !empty(Input::get('interests')) ){
                $studentProfileObj->interests = Input::get('interests');    
            }

            if( !empty(Input::get('achievementsawards')) ){
                $studentProfileObj->achievementsawards = Input::get('achievementsawards');    
            }

            if( !empty(Input::get('projects')) ){
                $studentProfileObj->projects = Input::get('projects');    
            }

            if( !empty(Input::get('entranceExam')) ){
                $studentProfileObj->entranceexamname = Input::get('entranceExam');    
            }

            if( !empty(Input::get('entranceexamnumber')) ){
                $studentProfileObj->entranceexamnumber = Input::get('entranceexamnumber');    
            }

            if ($calculateDate >= 18) {
                $studentProfileObj->isverifiedage = '1';
            }else{
                $studentProfileObj->isverifiedage = '0';
            }
            
            $studentProfileObj->save();  
       
            $getStudentProfileId = StudentProfile::where('slug', '=', $slug)->firstOrFail();


            /***** STUDENT Marks Details  Update ****/
            
            $studentMarksObj1 = DB::table('studentmarks')
                            ->where('studentmarks.studentprofile_id', '=', $getStudentProfileId->id )
                            ->where('studentmarks.name', '=', '10th')
                            ->orderBy('studentmarks.id','DESC')
                            ->take(1)
                            ->select('studentmarks.id','studentmarks.marks','studentmarks.percentage')
                            ->get()
                            ;
                       // print_r($studentMarksObj1);die;
            if(!empty($studentMarksObj1)){
                $studentMarksObj1 = StudentMark::where('studentmarks.studentprofile_id', '=', $getStudentProfileId->id )->where('studentmarks.name', '=', '10th')->firstOrFail();
                //$studentMarksObj1->marks = Input::get('tenthMarks');
                $studentMarksObj1->percentage = Input::get('tenthMarksPercentage');
                $studentMarksObj1->save();   
            }else{
                
                $studentMarksObj11 = new StudentMark;
                $studentMarksObj11->name = '10th';
               // $studentMarksObj11->marks = Input::get('tenthMarks'); 
                $studentMarksObj11->percentage = Input::get('tenthMarksPercentage');  
                $studentMarksObj11->category_id = '3';
                $studentMarksObj11->studentprofile_id = $getStudentProfileId->id; 
                $studentMarksObj11->save();

            }
            

            $studentMarksObj2 = DB::table('studentmarks')
                            ->where('studentmarks.studentprofile_id', '=', $getStudentProfileId->id )
                            ->where('studentmarks.name', '=', '11th')
                            ->orderBy('studentmarks.id','DESC')
                            ->take(1)
                            ->select('studentmarks.marks','studentmarks.percentage')
                            ->get()
                            ;
            if(!empty($studentMarksObj2)){
                $studentMarksObj2 = StudentMark::where('studentmarks.studentprofile_id', '=', $getStudentProfileId->id )->where('studentmarks.name', '=', '11th')->firstOrFail();

                //$studentMarksObj2->marks = Input::get('eleventhmarks');
                $studentMarksObj2->percentage = Input::get('eleventhMarksPercentage');
                $studentMarksObj2->save();
            }else{
                $studentMarksObj22 = new StudentMark;
                $studentMarksObj22->name = '11th';
                //$studentMarksObj22->marks = Input::get('eleventhmarks');  
                $studentMarksObj22->percentage = Input::get('eleventhMarksPercentage'); 
                $studentMarksObj22->category_id = '3';
                $studentMarksObj22->studentprofile_id = $getStudentProfileId->id; 
                $studentMarksObj22->save();
            }

            
            $studentMarksObj3 = DB::table('studentmarks')
                            ->where('studentmarks.studentprofile_id', '=', $getStudentProfileId->id )
                            ->where('studentmarks.name', '=', '12th')
                            ->orderBy('studentmarks.id','DESC')
                            ->take(1)
                            ->select('studentmarks.marks','studentmarks.percentage')
                            ->get()
                            ;
            if(!empty($studentMarksObj3)){
                $studentMarksObj3 = StudentMark::where('studentmarks.studentprofile_id', '=', $getStudentProfileId->id )->where('studentmarks.name', '=', '12th')->firstOrFail();
                //$studentMarksObj3->marks = Input::get('twelvemarks');
                $studentMarksObj3->percentage = Input::get('twelveMarksPercentage');
                $studentMarksObj3->save();
            }else{
                $studentMarksObj33 = new StudentMark;
                $studentMarksObj33->name = '12th';
               // $studentMarksObj33->marks = Input::get('twelvemarks');
                $studentMarksObj33->percentage = Input::get('twelveMarksPercentage');   
                $studentMarksObj33->category_id = '3';
                $studentMarksObj33->studentprofile_id = $getStudentProfileId->id; 
                $studentMarksObj33->save();
            }

            $studentMarksObj4 = DB::table('studentmarks')
                            ->where('studentmarks.studentprofile_id', '=', $getStudentProfileId->id )
                            ->where('studentmarks.name', '=', 'Graduation')
                            ->orderBy('studentmarks.id','DESC')
                            ->take(1)
                            ->select('studentmarks.marks','studentmarks.percentage')
                            ->get()
                            ;
            if(!empty($studentMarksObj4)){
                $studentMarksObj4 = StudentMark::where('studentmarks.studentprofile_id', '=', $getStudentProfileId->id )->where('studentmarks.name', '=', 'Graduation')->firstOrFail();
                //$studentMarksObj4->marks = Input::get('graduationmarks');
                $studentMarksObj4->percentage = Input::get('graduationMarksPercentage');
                $studentMarksObj4->save();
            }else{
                $studentMarksObj44 = new StudentMark;
                $studentMarksObj44->name = 'Graduation';
               // $studentMarksObj44->marks = Input::get('graduationmarks');
                $studentMarksObj44->percentage = Input::get('graduationMarksPercentage');   
                $studentMarksObj44->category_id = '3';
                $studentMarksObj44->studentprofile_id = $getStudentProfileId->id; 
                $studentMarksObj44->save();
            }


            /****upload document ***/
            if($request->file('tenthDocument'))
            {   
                $documentObj = new Document;
                if($request->file('tenthDocument'))
                {            
                    if( $_FILES["tenthDocument"]["size"] <= '7340032' ){ 
                        $path = $_FILES['tenthDocument']['name'];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $ext = strtolower($ext);

                        $extensionOfFile = $_FILES[ 'tenthDocument' ][ 'type' ];
                        
                        $tempPath = $_FILES[ 'tenthDocument' ][ 'tmp_name' ];
                        $currentMyTime = strtotime('now');
                        $imageNameWithTime = Input::get('slug').'-'.$currentMyTime;
                        $tenthDocumentWithExtension = $imageNameWithTime.'1'.'.'.$ext;//$extensionOfFile;
                        $tenthDocumentWithExtension1 = $imageNameWithTime.'1'.'_original'.'.'.$ext;//$extensionOfFile;
                     
                        //Set the image folder path
                        if(env('APP_ENV') == 'local'){
                           $dirPath = public_path().'/document/'.Input::get('slug').'/';
                        }else{
                            $dirPath = public_path().'/document/'.Input::get('slug').'/';
                        }
                        
                        //Store the image with 300PX width
                        $uploadPath = $dirPath.$tenthDocumentWithExtension;
                        //Store the image with original width as original
                        $uploadPath1 = $dirPath.$tenthDocumentWithExtension1;
                        if (move_uploaded_file($tempPath, $uploadPath)) {
                         copy($uploadPath, $uploadPath1);
                        }
                        
                        //IMAGE SAVED IN FOLDER NOW RESIZE IT
                        if (file_exists($dirPath.$tenthDocumentWithExtension)) {

                            $uploadimage = $dirPath.$tenthDocumentWithExtension;//$dirPath.$_FILES['file']['name'];
                            $newname = $tenthDocumentWithExtension;//$_FILES['file']['name'];

                            // Set the resize_image name
                            $resize_image = $dirPath.$newname; 
                            $actual_image = $dirPath.$newname;
                            // It gets the size of the image
                            list( $width,$height ) = getimagesize( $uploadimage );
                            // It makes the new image width of 350
                           
                            if( $width > '600' ){
                                $newwidth = 600;
                                // It makes the new image height of 350
                                //$newheight = 350;
                                if( $ext != 'png' ){
                                    $image = imagecreatefromjpeg($dirPath.$tenthDocumentWithExtension);
                                }else{
                                    $image = imagecreatefrompng($dirPath.$tenthDocumentWithExtension);
                                }
                                $orig_width = imagesx($image);
                                $orig_height = imagesy($image);

                                // Calc the new height
                                $newheight = (($orig_height * $newwidth) / $orig_width);
                                // It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
                                $thumb = imagecreatetruecolor( $newwidth, $newheight );
                                if( $ext != 'png' ){
                                    $source = imagecreatefromjpeg( $resize_image );
                                }else{
                                    $source = imagecreatefrompng( $resize_image );
                                }
                                
                                // Resize the $thumb image.
                                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                                // It then save the new image to the location specified by $resize_image variable
                                if( $ext != 'png' ){
                                    imagejpeg( $thumb, $resize_image, 100 ); 
                                }else{
                                    header('Content-Type: image/png');
                                    imagepng( $thumb, $resize_image); 
                                }
                                // 100 Represents the quality of an image you can set and ant number in place of 100.
                                $out_image=addslashes(file_get_contents($resize_image));    
                            }else{
                                $newwidth = $width;
                                $newheight = $height;
                            }            
                        }
                    }

                    $documentObj->name= $tenthDocumentWithExtension;
                    $documentObj->fullimage= $tenthDocumentWithExtension1;
                    $documentObj->description= '';
                    $documentObj->width = round($newwidth);
                    $documentObj->height = round($newheight);
                    $documentObj->users_id = $studentUserId; 
                    $documentObj->category_id = '3'; //hard-code value
                    $documentObj->save();
                }else{

                    }
                }

                if($request->file('twelveDocument'))
                {   
                    $documentObj1 = new Document;
                    if($request->file('twelveDocument'))
                    {   
                        if( $_FILES["twelveDocument"]["size"] <= '7340032' ){          
                        $extensionOfFile = $_FILES[ 'twelveDocument' ][ 'type' ];
                        
                        $path = $_FILES['twelveDocument']['name'];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $ext = strtolower($ext);
                        
                        $tempPath = $_FILES[ 'twelveDocument' ][ 'tmp_name' ];
                        $currentMyTime = strtotime('now');
                        $imageNameWithTime = Input::get('slug').'-'.$currentMyTime;
                        $twelveDocumentWithExtension = $imageNameWithTime.'2'.'.'.$ext;//$extensionOfFile;
                        $twelveDocumentWithExtension1 = $imageNameWithTime.'2'.'_original'.'.'.$ext;//$extensionOfFile;
                     
                        //Set the image folder path
                        if(env('APP_ENV') == 'local'){
                           $dirPath = public_path().'/document/'.Input::get('slug').'/';
                        }else{
                            $dirPath = public_path().'/document/'.Input::get('slug').'/';
                        }
                        
                        //Store the image with 300PX width
                        $uploadPath = $dirPath.$twelveDocumentWithExtension;
                        //Store the image with original width as original
                        $uploadPath1 = $dirPath.$twelveDocumentWithExtension1;
                        if (move_uploaded_file($tempPath, $uploadPath)) {
                         copy($uploadPath, $uploadPath1);
                        }
                        
                        //IMAGE SAVED IN FOLDER NOW RESIZE IT
                        if (file_exists($dirPath.$twelveDocumentWithExtension)) {

                            $uploadimage = $dirPath.$twelveDocumentWithExtension;//$dirPath.$_FILES['file']['name'];
                            $newname = $twelveDocumentWithExtension;//$_FILES['file']['name'];

                            // Set the resize_image name
                            $resize_image = $dirPath.$newname; 
                            $actual_image = $dirPath.$newname;
                            // It gets the size of the image
                            list( $width,$height ) = getimagesize( $uploadimage );
                            // It makes the new image width of 350
                             
                            if( $width > '600' ){
                                $newwidth = 600;
                                // It makes the new image height of 350
                                //$newheight = 350;
                                if( $ext != 'png' ){
                                    $image = imagecreatefromjpeg($dirPath.$twelveDocumentWithExtension);
                                }else{
                                    $image = imagecreatefrompng($dirPath.$twelveDocumentWithExtension);
                                }
                                $orig_width = imagesx($image);
                                $orig_height = imagesy($image);

                                // Calc the new height
                                $newheight = (($orig_height * $newwidth) / $orig_width);
                                // It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
                                $thumb = imagecreatetruecolor( $newwidth, $newheight );
                                if( $ext != 'png' ){
                                    $source = imagecreatefromjpeg( $resize_image );
                                }else{
                                    $source = imagecreatefrompng( $resize_image );
                                }
                                
                                // Resize the $thumb image.
                                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                                // It then save the new image to the location specified by $resize_image variable
                                if( $ext != 'png' ){
                                    imagejpeg( $thumb, $resize_image, 100 ); 
                                }else{
                                    header('Content-Type: image/png');
                                    imagepng( $thumb, $resize_image); 
                                }
                                // 100 Represents the quality of an image you can set and ant number in place of 100.
                                $out_image=addslashes(file_get_contents($resize_image));    
                            }else{
                                $newwidth = $width;
                                $newheight = $height;
                            }                      
                        }
                    }

                    $documentObj1->name= $twelveDocumentWithExtension;
                    $documentObj1->fullimage= $twelveDocumentWithExtension1;
                    $documentObj1->width = round($newwidth);
                    $documentObj1->height = round($newheight);
                    $documentObj1->users_id = $studentUserId; 
                    $documentObj1->description = '';
                    $documentObj1->category_id = '3'; //hard-code value

                    $documentObj1->save();
                }else{
                            
                }
            }

            if(Session::has('isUserPost') && (Session::get('isUserPost') == 2)){
                $collegemasterId = Session::get('collegemasterId'); 
                $collegeProfileObj = CollegeMaster::where('collegemaster.id', $collegemasterId)
                                    ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->select('collegeprofile.slug as collegeSlug')
                                    ->first();
                                    
                $collegeSlugUrl = $collegeProfileObj->collegeSlug;

                if(env('APP_ENV') == 'local'){
                   $dirUrl = url().'/student/apply-course-details/'.$collegemasterId.'/'.$collegeSlugUrl;
                }else{
                    $dirUrl = url().'/student/apply-course-details/'.$collegemasterId.'/'.$collegeSlugUrl;
                }
                Session::flash('success', 'Your password updated please try again with new password');
                Session::forget('collegemasterId');
                Session::forget('isUserPost');
                return Redirect::to($dirUrl);
            }

            $getStudentNameObj = DB::table('studentprofile')
                            ->leftJoin('users', 'studentprofile.users_id', '=','users.id')
                            ->where('studentprofile.slug', '=', $slug)
                            ->select('users.id as usersId', 'users.firstname as firstName', 'users.lastname as lastName', 'users.middlename as middleName', 'users.phone', 'users.email', 'studentprofile.id as studentprofileId','studentprofile.slug','userrole_id','userstatus_id')
                            ->take(1)
                            ->get()
                            ;

            if (sizeof($getStudentNameObj) > 0) {
                if ($getStudentNameObj[0]->userstatus_id == 1) {
                    $studentUserId = $getStudentNameObj[0]->usersId;
                    $userObj = User::find($studentUserId);
                    Auth::login($userObj);
                    if($userObj->userrole_id == '3'  && $userObj->userstatus_id == '1') {
                        $getSlugUrl = StudentProfile::where('users_id', '=', $studentUserId)->firstOrFail();
                        return redirect()->route('student_dash', $getSlugUrl->slug);
                    }else{
                        return Redirect::to('/sucess-signup');
                    }   
                }else{
                    return Redirect::to('/sucess-signup');
                }   
            }else{
                return Redirect::to('/sucess-signup');
            }   
            //return view('student.sucess');
        }else{
            return redirect('/404');
        }  
    }
    

    public function sucessSignUp()
    {
        return view('student.sucess');
    }

    public function verifyEmailAddress($token)
    {
        //VALIDATE TOKEN AGAINST EMAIL ADDRESS AND SET USER STATUS TO 1(Active) FROM 2(Inactive)
        try {
            $remember_token = $token;
            $userObj = User::where('token', '=' ,$token)->firstOrFail();
            $userObj->token = '';
            $userObj->userstatus_id = '1';
            $userObj->save();    

            if ($userObj->userrole_id == 3) {
                if(Session::has('isUserPost') && (Session::get('isUserPost') == 2)){
                    $collegemasterId = Session::get('collegemasterId'); 
                    $collegeProfileObj = CollegeMaster::where('collegemaster.id', $collegemasterId)
                                    ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->select('collegeprofile.slug as collegeSlug')
                                    ->first();
                                    
                    $collegeSlugUrl = $collegeProfileObj->collegeSlug;

                    if(env('APP_ENV') == 'local'){
                       $dirUrl = url().'/student/apply-course-details/'.$collegemasterId.'/'.$collegeSlugUrl;
                    }else{
                        $dirUrl = url().'/student/apply-course-details/'.$collegemasterId.'/'.$collegeSlugUrl;
                    }
                    Session::flash('success', 'Thank you for email confirmation! Happy to have you on our board.');
                    Session::forget('collegemasterId');
                    Session::forget('isUserPost');
                    return Redirect::to($dirUrl);
                }
                
                $postPublishDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postPublishDataFromSession($userObj->id);
            }

            $postAskExamDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postAskExamDataFromSession($userObj->id);
            
            Session::flash('verifiedEmail', 'Thank you for email confirmation! Happy to have you on our board.');
        } catch ( \Exception $e) {            
            Session::flash('verifiedEmail', 'Invalid Url');
        }        

        //REDIRECT TO LOGIN PAGE
        return View::make('administrator/users.login');
        //return redirect('login');

    }

    public function resendEmailAddressLink($emailAddress)
    {
        $encrytEmail = md5($emailAddress);
        $userObj = User::where('email', '=' ,$emailAddress)->firstOrFail();
        $userObj->token = $encrytEmail;
        $userObj->userstatus_id = '2';
        $userObj->save();

        // if(env('APP_ENV') == 'local'){
        //    $baseUrl = env('APP_URL').'/verify-student-email-address/';
        // }else{
        //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/verify-student-email-address/';
        // }
        $baseUrl = env('APP_URL').'/verify-student-email-address/';
        $ecyEmailUrl = $baseUrl.$encrytEmail;

        //SET TRY CATCH BLOCK FOR THANK YOU FOR REGISTERING
        // try {
        //    if(!empty($emailAddress) && ($this->fetchDataServiceController->isValidEmail($emailAddress) == 1))
        //     {
        //         //Swift Mailer Data Fetching       
        //         \Mail::send('website.home.signupmail', array('email' => $emailAddress, 'ecyEmailUrl' => $ecyEmailUrl), function($message) use ($emailAddress)
        //         {
        //             $message->to($emailAddress, 'AdmissionX')->subject('Thank you for registering with AdmissionX');
        //         });  
        //     } 
        // } catch ( \Swift_TransportException $e) {
            
        // }

        try {
            if(!empty($emailAddress))
            {
                $header     =   'MIME-Version: 1.0' . "\r\n";
                $header     .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


                $mail               = new PHPMailer\PHPMailer\PHPMailer;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                stream_context_set_default( [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);
                get_headers('https://www.admissionx.info/');

                $mail->SMTPDebug = 0;                                   // Enable verbose debug output

                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username     = env('MAIL_USERNAME');  // SMTP username
                $mail->Password     = env('MAIL_PASSWORD');  // SMTP password
                $mail->SMTPSecure = env('MAIL_ENCRYPTION'); \/\/ Enable TLS encryption, `ssl` also accepted
                $mail->Port = env('MAIL_PORT'); \/\/ TCP port to connect to

                $mail->setFrom(env('MAIL_USERNAME'), 'Welcome to AdmissionX');
                $mail->addAddress($emailAddress, 'AdmissionX');       // Add a recipient

                $message = file_get_contents('assets/signupmail.html');

                $message = str_replace('%ecyEmailUrl%', $ecyEmailUrl, $message);
                $mail->isHTML(true);                                     // Set email format to HTML

                $mail->Subject = 'Thank you for registering with AdmissionX';
                $mail->Body    =  ''.$message.'';

                if(!$mail->send()) {
                    // echo 'Message could not be sent.';
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    Session::flash('sendEmailMsg', 'Email send Succesfully!');
                }
            }
        } catch (Exception $e) {
            
        }        

        //REDIRECT TO LOGIN PAGE
        Session::flash('pleaseVierfyYourEmail', 'Please verify your email to get the access on our platform Thank You.');
        return redirect('login');

    }

    public function returnBackHome()
    {   
        Session::flash('returnBackSignup', 'Please confirm your e-mail to have access of your account.');
        return redirect('/');
    }


    public function applyCourseStudentSingup( Request $request)
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

                // if(env('APP_ENV') == 'local'){
                //    $baseUrl = env('APP_URL').'/verify-student-email-address/';
                // }else{
                //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/verify-student-email-address/';
                // }
                $baseUrl = env('APP_URL').'/verify-student-email-address/';
                $ecyEmailUrl = $baseUrl.$encrytEmail;

                //SET TRY CATCH BLOCK FOR THANK YOU FOR REGISTERING
                /*try {
                   if(!empty($email) && ($this->fetchDataServiceController->isValidEmail($email) == 1))
                    {
                        //Swift Mailer Data Fetching
                        \Mail::send('student.signupmail', array('email' => $email, 'ecyEmailUrl' => $ecyEmailUrl), function($message) use ($email)
                        {
                            $message->to($email, 'AdmissionX')->subject('Thank you for registering with AdmissionX');
                        });  
                    } 
                } catch ( \Swift_TransportException $e) {                
                }*/

                $resultMailSet = $this->sendStudentSignupMail($email, $ecyEmailUrl);

                //GET EMAIL ADDRESS
                $getEmailObj = DB::table('users')
                                        ->where('email' ,'=', $email)
                                        ->take(1)
                                        ->get()
                                        ;

                Session::set('collegemasterId', Input::get('collegemasterId'));
                Session::set('isUserMethod', 2);

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
                // if(env('APP_ENV') == 'local'){
                //    $dirUrl = url().'/student-detail-sign-up/'.$slugUrl;
                // }else{
                //     $dirUrl = url().'/student-detail-sign-up/'.$slugUrl;
                // }
                // return Redirect::to($dirUrl);

                $dataArray = array(
                   'code' => '200',
                   'email' => $email,
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
}
