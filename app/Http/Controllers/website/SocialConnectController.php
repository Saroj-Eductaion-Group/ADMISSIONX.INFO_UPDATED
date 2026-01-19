<?php

namespace App\Http\Controllers\website;

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
use Config;
use Storage;
use DateTime;
use DateTimeZone;
use PDF;
use File;
use Excel;
use Artisan;
use Socialite;
use Session;
use PHPMailer;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\Country as Country;
use App\Models\State as State;
use App\Models\CollegeType as CollegeType;
use App\Models\City as City;
use App\Models\Address as Address;
use App\Models\Gallery as Gallery;
use App\Models\Document as Document;
use App\Models\AddressType as AddressType;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\Placement as Placement;
use App\Models\StudentProfile as StudentProfile;
use App\Models\StudentMark as StudentMark;
use GuzzleHttp\Client;
use App\Models\SeoContent;
use App\Models\CollegeMaster;
use App\Models\RequestForCreateCollegeAccount;
use Jenssegers\Agent\Agent;
use App\Models\Blog as Blog;
use App\Models\Course as Course;
use App\Models\Bookmark as Bookmark;
use App\Models\Application as Application;
use App\Models\ApplicationStatus as ApplicationStatus;
use App\Models\FunctionalArea as FunctionalArea;
use App\Http\Controllers\Helper\FetchDataServiceController;
use App\Http\Controllers\website\WebsiteLogController;
use Illuminate\Database\QueryException as QueryException;
use App\Models\Query;
use App\Models\TypeOfExamination;
use App\Models\AskQuestion;
use App\Models\AskQuestionAnswer;
use App\Models\AskQuestionAnswerComment;
use App\Models\AskQuestionTag;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionAnswer;
use App\Models\ExamQuestionAnswerComment;


class SocialConnectController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

	/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProviderFacebook(Request $request)
    {
        return Socialite::driver('facebook')->with(["access_type" => "offline"])->redirect();
        return Socialite::driver($social)->redirect();
    }
    public function redirectToProviderGoogle(Request $request)
    {
        return Socialite::driver('google')->with(["access_type" => "offline"])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallbackFacebook(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();

            $facebook_client_token = [
                'access_token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'social'    => 'facebook',
                'profile_image' => $user->avatar_original,
            ];

            Session::set('socialSharePic', $user->avatar_original);
            $authUser = $this->findOrCreateUser($user, 'facebook', $user->token, $user->refreshToken, json_encode($facebook_client_token));
            
            if( empty((array)($authUser))):
                $agent = new Agent();
                $social = 'facebook';

                $collegeRoleId = \Illuminate\Support\Facades\Crypt::encrypt(2);
                $studentRoleId = \Illuminate\Support\Facades\Crypt::encrypt(3);

                $slugName = 'registration-page';
                $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($slugName);

                return view('website.home.signup-pages.social-register', compact('agent', 'user', 'social','collegeRoleId','studentRoleId','seocontent'));
            else:
                Auth::login($authUser, true);
                $userId = Auth::id();
                $emailAddress = $authUser->email;

                if (Session::has('isUserPost')) {
                    $redirectUrlAction = self::redirectUrlAction($userId, $emailAddress);
                    if (!empty($redirectUrlAction) && $redirectUrlAction != '') {
                        return Redirect::to($redirectUrlAction);
                    }
                }

                if( $authUser->userrole_id == '1' && $authUser->userstatus_id == '1' ){
                    return Redirect::to('/administrator/dashboard');
                }else if($authUser->userrole_id == '2' && ($authUser->userstatus_id == '1' || $authUser->userstatus_id == '3')) {

                    $getSlugUrl = CollegeProfile::where('users_id', '=', $userId)->firstOrFail();
                
                    //SET SESSION
                    if( $getSlugUrl->review == '0' ){
                        Session::flash('collegeProfileReviewStatus','Your college profile is in review till yet you can update your profile &amp; once your profile successfully review we will make you public thanks | Team AdmissionX.');     
                    }
                    if( $authUser->userstatus_id == '3' ){
                        Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.');    
                    }
                     
                    return redirect()->route('college_dash', $getSlugUrl->slug);
                }else if($authUser->userrole_id == '3'  && $authUser->userstatus_id == '1') {
                    $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();
                    return redirect()->route('student_dash', $getSlugUrl->slug);
                    //return Redirect::to('/student/dashboard');
                }else if($authUser->userrole_id == '4' && $authUser->userstatus_id == '1') {
                    return Redirect::to('/employee/dashboard');
                }else{
                    // Session::flash('alert-color-success', 'alert-danger'); 
                    // Session::flash('emailverification1', 'Entered email/mobile and password does not match.'); 
                    // Auth::logout();
                    // return Redirect::to('/login');

                    Auth::logout();
                    //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                    $emailLink = $userObj = User::where('email', '=' , $emailAddress)->firstOrFail();
                    if( $emailLink->userstatus_id == '2' ){
                        Session::flash('emailAdd', $emailAddress); 
                        Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.'); 
                    }

                    if( $emailLink->userstatus_id == '3' ){
                        Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.'); 
                    }  

                    if( $emailLink->userstatus_id == '4' ){
                        Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                    }                
                    return Redirect::to('/login');
                }
            endif;
        } catch (\Exception $e) {
            return Redirect::to('/login');
        }
    }   

    public function handleProviderCallbackGoogle(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();
        
        //GET ACCESS TOKEN AND TTL
        $google_client_token = [
            'access_token' => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires_in' => $user->expiresIn,
            'social'    => 'google',
            'profile_image' => $user->avatar_original,
        ];

        Session::set('socialSharePic', $user->avatar_original);
        $authUser = $this->findOrCreateUser($user, 'google', $user->token, $user->refreshToken, json_encode($google_client_token));
        if( empty((array)($authUser))):
            $agent = new Agent();
            $social = 'google';

            $collegeRoleId = \Illuminate\Support\Facades\Crypt::encrypt(2);
            $studentRoleId = \Illuminate\Support\Facades\Crypt::encrypt(3);

            $slugName = 'registration-page';
            $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($slugName);
            
            return view('website.home.signup-pages.social-register', compact('agent', 'user', 'social','collegeRoleId','studentRoleId','seocontent'));
        else:
            Auth::login($authUser, true);
            $userId = Auth::id();
            $emailAddress = $authUser->email;

            if (Session::has('isUserPost')) {
                $redirectUrlAction = self::redirectUrlAction($userId, $emailAddress);
                if (!empty($redirectUrlAction) && $redirectUrlAction != '') {
                    return Redirect::to($redirectUrlAction);
                }
            }

            if( $authUser->userrole_id == '1' && $authUser->userstatus_id == '1' ){
                    return Redirect::to('/administrator/dashboard');
            }else if($authUser->userrole_id == '2' && ($authUser->userstatus_id == '1' || $authUser->userstatus_id == '3')) {
                $getSlugUrl = CollegeProfile::where('users_id', '=', $userId)->firstOrFail();
            
                //SET SESSION
                if( $getSlugUrl->review == '0' ){
                    Session::flash('collegeProfileReviewStatus','Your college profile is in review till yet you can update your profile &amp; once your profile successfully review we will make you public thanks | Team AdmissionX.');     
                }
                if( $authUser->userstatus_id == '3' ){
                    Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.');    
                }
                 
                return redirect()->route('college_dash', $getSlugUrl->slug);
            }else if($authUser->userrole_id == '3'  && $authUser->userstatus_id == '1') {
                $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();
                return redirect()->route('student_dash', $getSlugUrl->slug);
                //return Redirect::to('/student/dashboard');
            }else if($authUser->userrole_id == '4' && $authUser->userstatus_id == '1') {
                return Redirect::to('/employee/dashboard');
            }else{
                // Session::flash('alert-color-success', 'alert-danger'); 
                // Session::flash('emailverification1', 'Entered email and password does not match.'); 
                // Auth::logout();
                // return Redirect::to('/login');

                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                $emailLink = $userObj = User::where('email', '=' , $emailAddress)->firstOrFail();
                if( $emailLink->userstatus_id == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.'); 
                }

                if( $emailLink->userstatus_id == '3' ){
                    Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.'); 
                }  

                if( $emailLink->userstatus_id == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }                
                return Redirect::to('/login');
            }
        endif;
    }	

    public function findOrCreateUser($user, $provider, $token, $refreshToken, $googleClientToken)
    {
        if( $provider == 'google' ):
            $authUser = User::where('google_provider_id', $user->id)->orWhere('email', $user->email)->first();
        else:
            $authUser = User::where('fb_provider_id', $user->id)->orWhere('email', $user->email)->first();
        endif;
        if($authUser){
            if( $provider == 'google' ):
                $authUser->google_provider_id      = $user->id;
                $authUser->google_token            = $token;
                $authUser->google_refresh_token    = $refreshToken;
            else:
                $authUser->fb_provider_id       = $user->id;
                $authUser->fb_token            = $token;
                $authUser->fb_refresh_token    = $refreshToken;
            endif;
            $authUser->save();
            
            return $authUser;
        }else{
            return (object)[];    
        }
    }

    public function socialFbGoogleSignupAction(Request $request)
    {
        $emailaddress = json_decode(Input::get('userObj'))->email;
        if(!empty(Input::get('user_role')) && !empty($emailaddress)):
            $userRoleId = \Illuminate\Support\Facades\Crypt::decrypt(Input::get('user_role'));
            $redirectUrl = self::createProfileGoogle(json_decode(Input::get('userObj'))->name, json_decode(Input::get('userObj'))->email, json_decode(Input::get('userObj'))->id, Input::get('social'),$userRoleId);
            
            Session::flash('alert_class', 'alert-success');  
            Session::flash('pleaseVierfyYourEmail', 'Congratulations! Your account has been registered. Please verify your email address by checking your inbox.  After verification of your email address, your details will be verified by our team following which your account will be approved.');

            if ($redirectUrl != '') {
                return Redirect::to($redirectUrl);
            }else{
                return view('administrator/users.login');
            }
        else:
            Session::flash('returnBackSignup', 'You Edit your email id on social media page. that\'s the reason you not allowed to create account. please don\'t edit email id just click on continue as button');
            return Redirect::to('/login');
        endif;
        //return Redirect::to($redirectUrl);
    }

    public function createProfileGoogle($name, $email, $provider_id, $social,$userRoleId)
    {
        $redirectUrl = '';
        $role = $userRoleId;
        $userEmail = $email;
        $firstName = $name;
        $middleName = '';
        $lastName = '';
        $phone = '';
        $last5chars = substr($firstName, -4);
        $uniqueKey = uniqid();
        $lastUserId = User::max('id');
        $password = ($lastUserId+1).'$Adx@'.date('Y').'#'.$last5chars;
        
        $createUserObj = New User;
        if( $social == 'google' ):
            $createUserObj->google_provider_id   = $provider_id;
            $createUserObj->type_of_user         = 'google';
        else:
            $createUserObj->fb_provider_id         = $provider_id;
            $createUserObj->type_of_user         = 'facebook';
        endif;
        $createUserObj->email = $userEmail;
        $createUserObj->firstName = $firstName;
        $createUserObj->middleName = $middleName;
        $createUserObj->lastName = $lastName;
        $createUserObj->password = Hash::make($password);
        $createUserObj->phone = $phone;
        $createUserObj->userstatus_id = '2'; //Active
        $createUserObj->userrole_id = $role;
        $createUserObj->apikey = $uniqueKey;
        $encrytEmail = md5($userEmail);
        $createUserObj->token = $encrytEmail;
        $createUserObj->save();

        /*if(env('APP_ENV') == 'local'){
           $baseUrl = env('APP_URL').'/verify-email-address/';
        }else{
           $baseUrl = 'https://'.env('ipAddressForRedirect').'/verify-email-address/';
        }*/
        $baseUrl = env('APP_URL').'/verify-email-address/';
        $ecyEmailUrl = $baseUrl.$encrytEmail;


        if($role == '2' ){
            $getEmailWiseUserId = User::where('email', '=', $userEmail)->firstOrFail(); 
            //STORE INTO COLLEGEPROFILES TABLE FOR CREATE RECORD
            $collegeProfileObj = New CollegeProfile;
            $collegeProfileObj->users_id = $getEmailWiseUserId->id;
            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getEmailWiseUserId->firstname.' '.$getEmailWiseUserId->id);
            $slugUrl = strtolower($slugUrl);
            $collegeProfileObj->slug = strtolower($slugUrl);
            $collegeProfileObj->employee_id = Auth::id();
            $collegeProfileObj->save();

            //CREATE TWO FOLDERS IN GALLERY AND DOCUMENTS FOR PHOTOS
            $directoryForDocument =  public_path().'/document/'.$slugUrl;
            $directoryForGallery =  public_path().'/gallery/'.$slugUrl;
            if (!mkdir($directoryForDocument, 0777, true)) {
                die('Failed to create folders...');
            }
            if (!mkdir($directoryForGallery, 0777, true)) {
                die('Failed to create folders...');
            }

            //GET COLLEGE PROFILE ID AS PER SLUG
            $getCollProId = CollegeProfile::where('slug', '=', $slugUrl)->firstOrFail();
            //STORE INTO ADDRESS TABLE FOR CREATE RECORD
            //For Registered address
            $addressObj = New Address;
            $addressObj->addresstype_id = '1';
            $addressObj->collegeprofile_id = $getCollProId->id;
            $addressObj->employee_id = Auth::id();
            $addressObj->save();

            //For Campus address
            $addressObj = New Address;
            $addressObj->addresstype_id = '2';
            $addressObj->collegeprofile_id = $getCollProId->id;
            $addressObj->employee_id = Auth::id();
            $addressObj->save();

            $placementObj = New Placement;
            $placementObj->collegeprofile_id = $getCollProId->id;
            $placementObj->employee_id = Auth::id();
            $placementObj->save();

            $seoContentObj = New SeoContent;
            $seoContentObj->pagetitle = Input::get('firstName');
            $seoContentObj->misc = 'collegepage';
            $seoContentObj->collegeId = $getCollProId->id;
            $seoContentObj->employee_id = Auth::id();
            $seoContentObj->save();

            /*$getImageName                       = self::getSocialProfilePicture($name, $directoryForGallery);
            //CREATE GALLERY PROFILE
            $galleryObj                         = new Gallery();
            $galleryObj->name                   = $getImageName['small_image'];
            $galleryObj->fullimage              = $getImageName['big_image'];
            $galleryObj->width                  = '';
            $galleryObj->height                 = '';
            $galleryObj->caption                = 'College Logo';
            $galleryObj->misc                   = 'college-logo-img';
            $galleryObj->category_id            = 1;
            $galleryObj->users_id               = $getEmailWiseUserId->id;
            $galleryObj->save();*/

            //SET TRY CATCH BLOCK FOR THANK YOU FOR REGISTERING
            $resultMailSet = app('App\Http\Controllers\college\quickSignUpController')->sendCollegeSignupMail($userEmail, $ecyEmailUrl, $firstName);
          
            try {
                if(!empty($phone))
                {
                    $userMobileNo = $phone;  
                    $smsMessageData = Config::get('systemsetting.SIGNUPMSG').' '.$userEmail.' '.Config::get('systemsetting.SMS_GROUP_NAME_5');
                    /***Send SMS *******************************/
                    $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_SIGN_OTP'));
                    /*$userIdHorizonSms = Config::get('app.userIdHorizonSms');
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
                    ]);*/  
                } 
            }catch (\Exception $e) {
                return $e;
            }
            
            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('New Registration by this User Id <b>'.$createUserObj->id);
            //SET COOKIE
            setcookie('collegeUserId', $createUserObj->id, time() + (86400 * 30), "/");                        
            setcookie('collegeName', $firstName, time() + (86400 * 30), "/");
            setcookie('emailAddress', $userEmail, time() + (86400 * 30), "/");

            self::postAskExamDataFromSession($getEmailWiseUserId->id);

           // return redirect('/detail-sign-up/'.$slugUrl);
            $redirectUrl = '/detail-sign-up/'.$slugUrl;
        }else if($role == '3' ){
            $getEmailWiseUserId = User::where('email', '=', $userEmail)->firstOrFail(); 
            //STORE INTO STUDENTPROFILES TABLE FOR CREATE RECORD
            $studentProfileObj = New StudentProfile;
            $studentProfileObj->users_id = $getEmailWiseUserId->id;
            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getEmailWiseUserId->firstname.' '.$getEmailWiseUserId->id);
            $slugUrl = strtolower($slugUrl);
            $studentProfileObj->slug = strtolower($slugUrl);
            $studentProfileObj->employee_id = Auth::id();
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
            $addressObj->employee_id = Auth::id();
            $addressObj->save();

            //For Present Address
            $addressObj = New Address;
            $addressObj->addresstype_id = '4';
            $addressObj->studentprofile_id = $getStudentProId->id;
            $addressObj->employee_id = Auth::id();
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
            $seoContentObj->pagetitle = $firstName;
            $seoContentObj->misc = 'studentpage';
            $seoContentObj->userId = $getStudentProId->id;
            $seoContentObj->employee_id = Auth::id();
            $seoContentObj->save();

            /*$getImageName                       = self::getSocialProfilePicture($name, $directoryForGallery);
            //CREATE GALLERY PROFILE
            $galleryObj                         = new Gallery();
            $galleryObj->name                   = $getImageName['small_image'];
            $galleryObj->fullimage              = $getImageName['big_image'];
            $galleryObj->width                  = '';
            $galleryObj->height                 = '';
            $galleryObj->caption                = 'Student Profile Picture';
            $galleryObj->misc                   = '';
            $galleryObj->category_id            = '3';
            $galleryObj->users_id               = $getEmailWiseUserId->id;
            $galleryObj->save();*/

            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('New Registration by this User Id <b>'.$createUserObj->id);

            $resultMailSet = app('App\Http\Controllers\student\studentSignUpController')->sendStudentSignupMail($userEmail, $ecyEmailUrl, $firstName);

            //GET EMAIL ADDRESS
            setcookie('studentUserId', $createUserObj->id, time() + (86400 * 30), "/");                        
            setcookie('firstName', $firstName, time() + (86400 * 30), "/");
            setcookie('middleName', $middleName, time() + (86400 * 30), "/");
            setcookie('lastName', $lastName, time() + (86400 * 30), "/");
            setcookie('email', $userEmail, time() + (86400 * 30), "/");

            //Send Signup message for student
           //$smsMessageData = 'Welcome to Admission X. We are happy to have you onboard ! Your registered email id is : '.$email;
            $smsMessageData = Config::get('systemsetting.SIGNUPMSG').' '.$userEmail.' '.Config::get('systemsetting.SMS_GROUP_NAME_5');
            // Define Function Call
            $resultSet = app('App\Http\Controllers\student\studentSignUpController')->sendSignupSms($phone, $smsMessageData, Config::get('systemsetting.TEMPLATE_SIGN_OTP'));
            self::postPublishDataFromSession($getEmailWiseUserId->id);
            self::postAskExamDataFromSession($getEmailWiseUserId->id);
            //return redirect('/detail-sign-up/'.$slugUrl);
            $redirectUrl = '/student-detail-sign-up/'.$slugUrl;
        }

        //FORCE FULLY LOGIN BY ID
        // $userObj = User::find($createUserObj->id);
        // Auth::login($userObj);

        /*if( $userObj->userrole_id == '1' && $userObj->userstatus_id == '1' ){
                return Redirect::to('/administrator/dashboard');
        }else if($userObj->userrole_id == '2'  && ($userObj->userstatus_id == '1' || $userObj->userstatus_id == '3')) {
            $getSlugUrl = CollegeProfile::where('users_id', '=', $userId)->firstOrFail();
        
            //SET SESSION
            if( $getSlugUrl->review == '0' ){
                Session::flash('collegeProfileReviewStatus','Your college profile is in review till yet you can update your profile &amp; once your profile successfully review we will make you public thanks | Team AdmissionX.');     
            }
            if( $userObj->userstatus_id == '3' ){
                Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.');    
            }
            return redirect()->route('college_dash', $getSlugUrl->slug);
        }else if($userObj->userrole_id == '3'  && $userObj->userstatus_id == '1') {
            $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();
            return redirect()->route('student_dash', $getSlugUrl->slug);
            //return Redirect::to('/student/dashboard');
        }else if($userObj->userrole_id == '4' && $userObj->userstatus_id == '1') {
            return Redirect::to('/employee/dashboard');
        }else{
            Session::flash('alert-color-success', 'alert-danger'); 
            Session::flash('emailverification1', 'Entered email and password does not match.'); 
            Auth::logout();
            return Redirect::to('/login');
        }*/

        return $redirectUrl;
    }

    public function getSocialProfilePicture($userName, $folderPath)
    {
        $imageUrl                        = Session::get('socialSharePic');
        if(!empty($imageUrl)):
            // $fileName                     = pathinfo($imageUrl, PATHINFO_FILENAME);
            $ext                          = 'jpg';//strtolower(pathinfo($imageUrl,PATHINFO_EXTENSION));
            $currentMyTime                = round(microtime(true) * 1000).'_'.uniqid();
            $imageNameWithTime            = $userName.'-'.$currentMyTime;
            $fileWithExtensionNew         = $imageNameWithTime.'-'.'.'.$ext;
            $fileWithExtensionNew1        = $imageNameWithTime.'-'.'_original.'.$ext;
            $uploadPath                   = $folderPath.'/'.$fileWithExtensionNew;
            $uploadPath1                  = $folderPath.'/'.$fileWithExtensionNew1;
            copy($imageUrl, $uploadPath);copy($imageUrl, $uploadPath1);
            Session::forget('socialSharePic');
        else:
            $fileWithExtensionNew = $fileWithExtensionNew1 = '';
        endif;
        return [
                'small_image'       => $fileWithExtensionNew,
                'big_image'         => $fileWithExtensionNew1,
            ];
    }

    public function redirectUrlAction($userId,$emailAddress)
    {
        $urlRedirect = '';
        $roleGrant = User::where('id', '=', $userId)->first();
        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.LOGINMSG').' by this User Id '.Auth::id());
        if(Session::has('isUserPost') && (Session::get('isUserPost') == 1 || Session::get('isUserPost') == 2)){
            $collegemasterId = Session::get('collegemasterId'); 
            $collegeProfileObj = CollegeMaster::where('collegemaster.id', $collegemasterId)
                                ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                ->select('collegeprofile.slug as collegeSlug')
                                ->first();
                                
            $collegeSlugUrl = $collegeProfileObj->collegeSlug;
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ){
                $urlRedirect = '/student/apply-course-details/'.$collegemasterId.'/'.$collegeSlugUrl;
                Session::forget('collegemasterId');
                Session::forget('isUserPost');
                //return Redirect::to($urlRedirect);
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 3)){
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ){
                $blogName = Session::get('blogName');
                $url = Session::get('blogURL'); 
                self::addBlogBookmark($userId, $blogName, $url);
                $urlRedirect = '/blogs/'.$blogName;
                //return Redirect::to($urlRedirect);
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 4)){
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ){
                $collegeName = Session::get('collegeName');
                $url = Session::get('collegeURL'); 
                $collegePageUrl = self::addCollegeBookmark($userId, $collegeName, $url);
                $urlRedirect = $collegePageUrl;
                //return Redirect::to($urlRedirect);
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 5)){
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ){
                $courseName = Session::get('courseName');
                $url = Session::get('courseURL'); 
                $coursePageUrl = self::addCourseBookmark($userId, $courseName, $url);
                $urlRedirect = $coursePageUrl;
                //return Redirect::to($urlRedirect);
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 6)){
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ){
                $collegeId = Session::get('collegeId'); 
                $collegeProfile = CollegeProfile::where('id', '=', $collegeId)->firstOrFail();
                $collegeSlugUrl = $collegeProfile->slug;
                $urlRedirect = url().'/college/'.$collegeSlugUrl;
                Session::forget('collegeId');
                Session::forget('isUserPost');
                //return Redirect::to($urlRedirect);
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 7)){
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ){
                $urlRedirect = self::addCollegeReview($userId);
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 8)) {
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ){
                $urlRedirect = self::studentForCollegeQuery($userId);;
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 9)) {
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  ){
                $urlRedirect = self::counsellingExamForm($userId);;
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 10)) {
            if($roleGrant['userstatus_id'] == '1'){
                $urlRedirect = self::addExaminationQuestion($userId);;
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 11)) {
            if($roleGrant['userstatus_id'] == '1'){
                $urlRedirect = self::addExaminationAnswer($userId);;
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 12)) {
            if($roleGrant['userstatus_id'] == '1'){
                $urlRedirect = self::addExaminationComment($userId);;
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 13)) {
            if($roleGrant['userstatus_id'] == '1'){
                $urlRedirect = self::addAskQuestion($userId);;
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 14)) {
            if($roleGrant['userstatus_id'] == '1'){
                $urlRedirect = self::addAskAnswer($userId);;
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 15)) {
            if($roleGrant['userstatus_id'] == '1'){
                $urlRedirect = self::addAskComment($userId);;
            }else{
                Auth::logout();
                //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                if( $roleGrant['userstatus_id'] == '2' ){
                    Session::flash('emailAdd', $emailAddress); 
                    Session::flash('confirmEmail', 'Please confirm your email ('.$emailAddress.') before login thank you.');
                }
                if( $roleGrant['userrole_id'] != '3' ){
                    Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                }
                
                if( $roleGrant['userstatus_id'] == '4' ){
                    Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                }

                $urlRedirect = '/login';
            }
        } 

        return $urlRedirect;
    }

    public function postPublishDataFromSession($userId)
    {
        if(Session::has('isUserPost') && (Session::get('isUserPost') == 3)){
            $blogName = Session::get('blogName');
            $url = Session::get('blogURL'); 
            self::addBlogBookmark($userId, $blogName, $url);
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 4)){
            $collegeName = Session::get('collegeName');
            $url = Session::get('collegeURL'); 
            self::addCollegeBookmark($userId, $collegeName, $url);
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 5)){
            $courseName = Session::get('courseName');
            $url = Session::get('courseURL'); 
            self::addCourseBookmark($userId, $courseName, $url);
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 7)){
            self::addCollegeReview($userId);
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 8)) {
            self::studentForCollegeQuery($userId);
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 9)) {
            self::counsellingExamForm($userId);
        }
        return true;
    }

    public function postAskExamDataFromSession($userId)
    {
        if(Session::has('isUserPost') && (Session::get('isUserPost') == 10)){
            self::addExaminationQuestion($userId);
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 11)){
            self::addExaminationAnswer($userId);
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 12)){
            self::addExaminationComment($userId);
        }else if(Session::has('isUserPost') && (Session::get('isUserPost') == 13)){
            self::addAskQuestion($userId);
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 14)) {
            self::addAskAnswer($userId);
        }else if (Session::has('isUserPost') && (Session::get('isUserPost') == 15)) {
            self::addAskComment($userId);
        }
        return true;
    }

    public function addCollegeBookmark($userId, $collegeProfile, $url)
    {
        $bookmarkObj = new Bookmark;
        $bookmarkObj->student_id = $userId;
                
        if( !empty($collegeProfile) ){
            $getCollegeProfileId = DB::table('collegeprofile')
                                ->leftJoin('users','collegeprofile.users_id','=','users.id')
                                ->where('slug', '=', $collegeProfile)
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('collegeprofile.id','users.firstname')
                                ->take(1)
                                ->get()
                                ;

            if( !empty($getCollegeProfileId) ){
                $bookmarkObj->college_id = $getCollegeProfileId[0]->id;  
                $bookmarkObj->title = $getCollegeProfileId[0]->firstname; 
                $bookmarkObj->bookmarktypeinfo_id = '1'; 
            }
        }

        if( !empty($url) ){
            $bookmarkObj->url = $url;    
        }
        $bookmarkObj->employee_id = $userId;
        $bookmarkObj->save();

        Session::forget('collegeName');
        Session::forget('collegeURL');
        Session::forget('isUserPost');

        $returnPageUrl = "/college/".$collegeProfile;

        $msg = 'Your college has been bookmark successfully!';
        
        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return $returnPageUrl;
    }

    public function addCourseBookmark($userId, $courseName, $url)
    {
        $bookmarkObj = new Bookmark;
        $bookmarkObj->student_id = $userId;
        if( !empty($courseName) ){
            $getCollegeMasterId = DB::table('collegemaster')
                                ->leftJoin('collegeprofile', 'collegemaster.collegeprofile_id','=', 'collegeprofile.id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                ->where('collegemaster.id', '=', $courseName)
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('collegemaster.id','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','users.firstname','collegeprofile.slug')
                                ->take(1)
                                ->get()
                                ;
            if( !empty($getCollegeMasterId) ){
                $bookmarkObj->course_id = $getCollegeMasterId[0]->id; 
                $bookmarkObj->title = $getCollegeMasterId[0]->firstname.' - '.$getCollegeMasterId[0]->educationlevelName.' / '.$getCollegeMasterId[0]->functionalareaName.' / '.$getCollegeMasterId[0]->degreeName.' / '.$getCollegeMasterId[0]->courseName.' / '.$getCollegeMasterId[0]->coursetypeName; 
                $bookmarkObj->bookmarktypeinfo_id = '2';       
            }
        }

        if( !empty($url) ){
            $bookmarkObj->url = $url;    
        }
        $bookmarkObj->employee_id = $userId;
        $bookmarkObj->save();

        Session::forget('courseName');
        Session::forget('courseURL');
        Session::forget('isUserPost');

        $returnPageUrl = "/college/detail-course/".$courseName.'/'.$getCollegeMasterId[0]->slug;

        $msg = 'Your course has been bookmark successfully!';
        
        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return $returnPageUrl;
    }

    public function addBlogBookmark($userId, $blogName, $url)
    {
        $bookmarkObj = new Bookmark;
        $bookmarkObj->student_id = $userId;
                
        if( !empty($blogName) ){
            $getBlogsId = DB::table('blogs')
                                ->where('slug', '=', $blogName)
                                ->select('id','topic')
                                ->take(1)
                                ->get()
                                ;
            if( !empty($getBlogsId) ){
                $bookmarkObj->blog_id = $getBlogsId[0]->id; 
                $bookmarkObj->title = $getBlogsId[0]->topic; 
                $bookmarkObj->bookmarktypeinfo_id = '3';       
            }
        }

        if( !empty($url) ){
            $bookmarkObj->url = $url;    
        }
        $bookmarkObj->employee_id = $userId;
        $bookmarkObj->save();

        Session::forget('blogName');
        Session::forget('blogURL');
        Session::forget('isUserPost');

        $msg = 'Your blog has been bookmark successfully!';
        
        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return true;
    }


    public function addCollegeReview($userId)
    {
        $title = Session::get('reviewTitle');
        $description = Session::get('reviewDescription');
        $votes = Session::get('reviewVotes');
        $academic = Session::get('reviewAcademic');
        $accommodation = Session::get('reviewAccommodation');
        $faculty = Session::get('reviewFaculty');
        $infrastructure = Session::get('reviewInfrastructure');
        $placement = Session::get('reviewPlacement');
        $social = Session::get('reviewSocial');
        $slugUrl = Session::get('reviewCollegeSlug'); 
        $collegeId = Session::get('collegeId'); 

        $collegeProfile = CollegeProfile::where('id', '=', $collegeId)->firstOrFail();
        $collegeSlugUrl = $collegeProfile->slug;

        $this->fetchDataServiceController->submitCollegeReview($collegeSlugUrl, $userId, $title, $description, $votes, $academic, $accommodation, $faculty, $infrastructure, $placement, $social);

        Session::forget('reviewTitle');
        Session::forget('reviewDescription');
        Session::forget('reviewVotes');
        Session::forget('reviewAcademic');
        Session::forget('reviewAccommodation');
        Session::forget('reviewFaculty');
        Session::forget('reviewInfrastructure');
        Session::forget('reviewPlacement');
        Session::forget('reviewSocial');
        Session::forget('reviewCollegeSlug');
        Session::forget('collegeId');
        Session::forget('isUserPost');

        $urlRedirect = url().'/college/'.$collegeSlugUrl.'/reviews';
        return $urlRedirect;
    }


    public function studentForCollegeQuery($userId)
    {
        $subject = Session::get('subject');
        $message = Session::get('message');
        $slugUrl = Session::get('collegeSlugUrl'); 
        $collegeId = Session::get('collegeId'); 

        $collegeProfile = CollegeProfile::where('id', '=', $collegeId)->firstOrFail();
        $collegeSlugUrl = $collegeProfile->slug;

        $queryObj = New Query();
        $queryObj->subject = $subject;    
        $queryObj->message = $message;    

        if( !empty($collegeSlugUrl) ){
            //GET THE COLLEGE PROFILE ID
            $getCollegeProfieId = DB::table('collegeprofile')
                                    ->join('users', 'collegeprofile.users_id','=','users.id')
                                    ->where('collegeprofile.slug', '=', $collegeSlugUrl)
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
        $subjectText = $subject;    
        $messageText = $message;    

        foreach ($getTheEmailAdmin as $key => $value) {
            $adminEmailId = $value->email;
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

        $urlRedirect = url().'/college/'.$collegeSlugUrl;
        $bodyContent    =   '<p><b>Query Details :</b></p>
                            <ul>
                                <li>Subject               : '.$subject.'</li>
                                <li>Message                : '.$message.'</li>
                                <li>College URL         : '.$urlRedirect.'</li>
                            </ul>';

        $send_to = Auth::user()->email;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

        Session::forget('subject');
        Session::forget('message');
        Session::forget('collegeSlugUrl');
        Session::forget('collegeId');
        Session::forget('isUserPost');

        $msg = 'Your query has been submitted successfully!';
        
        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return $urlRedirect;   
    }

    public function counsellingExamForm($userId)
    {
        $name = Session::get('examFormUserName');
        $email = Session::get('examFormUserEmail');
        $phone = Session::get('examFormUserPhone');
        $misc = Session::get('examFormUserMisc');
        $city_id = Session::get('examFormUserCity');
        $course_id = Session::get('examFormUserCourse');
        $exam_id = Session::get('examFormUserExam');
        $isResponse = Session::get('examFormUserIsResponse');
        $isResponseMethod = Session::get('examFormUserIsResponseMethod');
        Session::set('isUserPost', 9);

        $this->fetchDataServiceController->counsellingFormStore($userId, $name, $email, $phone, $misc, $city_id, $course_id, $exam_id, $isResponse, $isResponseMethod);;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
            ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
            ->where('type_of_examinations.id','=', $exam_id)
            ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as examinationSlug') 
            ->first();

        Session::forget('examFormUserName');
        Session::forget('examFormUserEmail');
        Session::forget('examFormUserPhone');
        Session::forget('examFormUserMisc');
        Session::forget('examFormUserCity');
        Session::forget('examFormUserCourse');
        Session::forget('examFormUserExam');
        Session::forget('examFormUserIsResponse');
        Session::forget('examFormUserIsResponseMethod');
        Session::forget('isUserPost');

        $urlRedirect = url().'/examination-details/'.$typeOfExaminationObj->examinationSlug.'/'.$typeOfExaminationObj->slug;

        return $urlRedirect;
    }

    public function addExaminationQuestion($userId)
    {
        $question = Session::get('examQuestion');
        $examId = Session::get('examId');

        app('App\Http\Controllers\examination\ExaminationDetailsController')->submitExamQuestion($examId, $question, $userId);

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('type_of_examinations.id','=', $examId)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as streamSlug') 
                ->first();

        $urlRedirect         = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->streamSlug.'/'.$typeOfExaminationObj->slug.'/questions';

        Session::forget('examQuestion');
        Session::forget('examId');
        Session::forget('isUserPost');

        return $urlRedirect;
    }

    public function addExaminationAnswer($userId)
    {
        $examId = Session::get('examId');
        $questionId = Session::get('examQuestionId');
        $answer = Session::get('examanswer');

        app('App\Http\Controllers\examination\ExaminationDetailsController')->submitExamQuestionAnswer($examId, $questionId, $answer, $userId);

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('type_of_examinations.id','=', $examId)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as streamSlug') 
                ->first();

        $urlRedirect   = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->streamSlug.'/'.$typeOfExaminationObj->slug.'/'.$questionId.'/question-details';
        
        Session::forget('examId');
        Session::forget('examQuestionId');
        Session::forget('examanswer');
        Session::forget('isUserPost');

        return $urlRedirect;
    }

    public function addExaminationComment($userId)
    {
        $examId = Session::get('examId');
        $questionId = Session::get('examQuestionId');
        $answerId = Session::get('examAnswerId');
        $replyanswer = Session::get('examReplyanswer');

        app('App\Http\Controllers\examination\ExaminationDetailsController')->submitExamQuestionAnswerComment($examId, $questionId, $answerId, $replyanswer, $userId);

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('type_of_examinations.id','=', $examId)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as streamSlug') 
                ->first();

        $urlRedirect  = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->streamSlug.'/'.$typeOfExaminationObj->slug.'/'.$questionId.'/question-details';
        
        Session::forget('examId');
        Session::forget('examQuestionId');
        Session::forget('examAnswerId');
        Session::forget('examReplyanswer');
        Session::forget('isUserPost');

        return $urlRedirect;
    }

    public function addAskQuestion($userId)
    {
        $question = Session::get('askQuestion');
        $askQuestionTagIds = Session::get('askQuestionTagIds');

        app('App\Http\Controllers\administrator\AskQuestionController')->submitAskQuestion($question, $askQuestionTagIds, $userId);

        $urlRedirect  = env('APP_URL').'/ask';
        
        Session::forget('askQuestion');
        Session::forget('askQuestionTagIds');
        Session::forget('isUserPost');

        return $urlRedirect;
    }

    public function addAskAnswer($userId)
    {
        $questionId = Session::get('askQuestionId');
        $answer = Session::get('askAnswer');

        app('App\Http\Controllers\administrator\AskQuestionController')->submitAskQuestionAnswer($questionId, $answer, $userId);

        $questionObj = AskQuestion::orderBy('ask_questions.id' ,'DESC')
                ->where('ask_questions.id','=',$questionId)
                ->first();

        $urlRedirect            = env('APP_URL').'/ask/'.$questionObj->slug;
        
        Session::forget('askQuestionId');
        Session::forget('askAnswer');
        Session::forget('isUserPost');

        return $urlRedirect;
    }

    public function addAskComment($userId)
    {
        $questionId = Session::get('askQuestionId');
        $answerId = Session::get('askAnswerId');
        $replyanswer = Session::get('askReplyanswer');

        app('App\Http\Controllers\administrator\AskQuestionController')->submitAskQuestionAnswerComment($questionId, $answerId, $replyanswer, $userId);

        $questionObj = AskQuestion::orderBy('ask_questions.id' ,'DESC')
                ->where('ask_questions.id','=',$questionId)
                ->first();

        $urlRedirect            = env('APP_URL').'/ask/'.$questionObj->slug;
        
        Session::forget('askQuestionId');
        Session::forget('askAnswerId');
        Session::forget('askReplyanswer');
        Session::forget('isUserPost');

        return $urlRedirect;
    }
}