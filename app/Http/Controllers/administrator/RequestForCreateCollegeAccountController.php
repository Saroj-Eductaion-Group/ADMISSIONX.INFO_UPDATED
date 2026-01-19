<?php

namespace App\Http\Controllers\administrator;

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
use Illuminate\Database\QueryException as QueryException;
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
use GuzzleHttp\Client;
use App\Models\SeoContent;
use App\Models\RequestForCreateCollegeAccount;
use App\Http\Controllers\Helper\FetchDataServiceController;

class RequestForCreateCollegeAccountController extends Controller
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
    public function index(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('RequestForCreateCollegeAccount');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' || $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){

                //$requestforcreatecollegeaccount = RequestForCreateCollegeAccount::paginate(25);
                $query = RequestForCreateCollegeAccount::orderBy('request_for_create_college_accounts.id', 'DESC')
                        ->leftJoin('users as eID','request_for_create_college_accounts.employee_id', '=','eID.id');

                if (!empty(Input::get('startdate'))) {
                    $query->where('request_for_create_college_accounts.created_at', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
                }

                if (!empty(Input::get('enddate'))) {
                    $query->where('request_for_create_college_accounts.created_at', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
                }

                $status = Input::get('status');
                if ($status == '0') {
                    $query->where('request_for_create_college_accounts.status', '=', '0');
                }else{
                    if ($request->has('status') && !empty($request->get('status'))) {
                        $query->where('request_for_create_college_accounts.status', '=', Input::get('status'));
                    }
                }

                if (!empty(Input::get('collegeName'))) {
                    $query->where('request_for_create_college_accounts.collegeName', 'LIKE', '%'.Input::get('collegeName').'%');
                }

                if (!empty(Input::get('email'))) {
                    $query->where('request_for_create_college_accounts.email', 'LIKE', '%'.Input::get('email').'%');
                }

                if (!empty(Input::get('phone'))) {
                    $query->where('request_for_create_college_accounts.phone', 'LIKE', '%'.Input::get('phone').'%');
                }

                if (!empty(Input::get('contactPersonName'))) {
                    $query->where('request_for_create_college_accounts.contactPersonName', 'LIKE', '%'.Input::get('contactPersonName').'%');
                }

                $requestforcreatecollegeaccount = $query->paginate(20, array('request_for_create_college_accounts.id', 'request_for_create_college_accounts.collegeName', 'request_for_create_college_accounts.email', 'request_for_create_college_accounts.phone', 'request_for_create_college_accounts.contactPersonName', 'request_for_create_college_accounts.employee_id', 'request_for_create_college_accounts.status','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','request_for_create_college_accounts.updated_at','request_for_create_college_accounts.created_at'));

                return view('administrator.request-for-create-college-account.index', compact('requestforcreatecollegeaccount'));
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
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('RequestForCreateCollegeAccount');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' || $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                return redirect::back();
                return view('administrator.request-for-create-college-account.create');
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' || $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $requestData = $request->all();
                return redirect::back();
                RequestForCreateCollegeAccount::create($requestData);

                Session::flash('flash_message', 'RequestForCreateCollegeAccount added!');

                return redirect($this->fetchDataServiceController->routeCall().'/request/create-college-account');
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
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('RequestForCreateCollegeAccount');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' || $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                //$requestforcreatecollegeaccount = RequestForCreateCollegeAccount::findOrFail($id);
                $requestforcreatecollegeaccount = RequestForCreateCollegeAccount::orderBy('request_for_create_college_accounts.id', 'DESC')
                        ->leftJoin('users as eID','request_for_create_college_accounts.employee_id', '=','eID.id')
                        ->select('request_for_create_college_accounts.id', 'request_for_create_college_accounts.collegeName', 'request_for_create_college_accounts.email', 'request_for_create_college_accounts.phone', 'request_for_create_college_accounts.contactPersonName', 'request_for_create_college_accounts.employee_id', 'request_for_create_college_accounts.status','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','request_for_create_college_accounts.updated_at','request_for_create_college_accounts.created_at')
                        ->findOrFail($id);

                return view('administrator.request-for-create-college-account.show', compact('requestforcreatecollegeaccount'));
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
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('RequestForCreateCollegeAccount');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' || $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                return redirect::back();
                $requestforcreatecollegeaccount = RequestForCreateCollegeAccount::findOrFail($id);

                return view('administrator.request-for-create-college-account.edit', compact('requestforcreatecollegeaccount'));
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' || $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                return redirect::back();
                $requestData = $request->all();
                
                $requestforcreatecollegeaccount = RequestForCreateCollegeAccount::findOrFail($id);
                $requestforcreatecollegeaccount->update($requestData);

                Session::flash('flash_message', 'RequestForCreateCollegeAccount updated!');

                return redirect($this->fetchDataServiceController->routeCall().'/request/create-college-account');
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('RequestForCreateCollegeAccount');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' || $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                //return redirect::back();
                RequestForCreateCollegeAccount::destroy($id);

                Session::flash('flash_message', 'RequestForCreateCollegeAccount deleted!');

                return redirect($this->fetchDataServiceController->routeCall().'/request/create-college-account');
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }


    public function collegeProfileCreated(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('RequestForCreateCollegeAccount');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $requestId = Input::get('id');
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            if( $roleGrant->userrole_id == '1' || $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $requestFormObj = DB::table('request_for_create_college_accounts')
                                        ->where('request_for_create_college_accounts.id' ,'=', $requestId)
                                        ->first();

                $checkEmailDuplicateObj = DB::table('users')
                                        ->where('email' ,'=', $requestFormObj->email)
                                        ->count();

                if ($checkEmailDuplicateObj == 0) {
                    $emailAddress = $requestFormObj->email;
                    $collegeName = $requestFormObj->collegeName;
                    $contactNumber = $requestFormObj->phone;
                    $contactPersonName = $requestFormObj->contactPersonName;

                    $lastCollegeId = CollegeProfile::max('id');

                    $last5chars = substr($contactNumber, -4);
                    $uniqueKey = uniqid();
                    $password = ($lastCollegeId+1).'$Adx@'.date('Y').'#'.$last5chars;

                    //STORE INTO USERS TABLE
                    $userObj = New User;
                    $userObj->firstName = $collegeName;
                    $userObj->email = $emailAddress;
                    $userObj->password = Hash::make($password);
                    $userObj->phone = $contactNumber;
                    $userObj->userstatus_id = '2'; //Inasctive
                    $userObj->userrole_id = '2'; //ROLE_COLLEGE 
                    $encrytEmail = md5($emailAddress);
                    $userObj->token = $encrytEmail;
                    $userObj->save();

                    //STORE INTO COLLEGEPROFILES TABLE FOR CREATE RECORD
                    $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $collegeName.' '.$userObj->id);
                    $slugUrl = strtolower($slugUrl);

                    $collegeProfileObj = New CollegeProfile;
                    $collegeProfileObj->users_id = $userObj->id;
                    $collegeProfileObj->contactpersonname = $contactPersonName;
                    $collegeProfileObj->contactpersonemail = $emailAddress;
                    $collegeProfileObj->contactpersonnumber = $contactNumber;
                    $collegeProfileObj->slug = strtolower($slugUrl);
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

                    //Create Blank Row For Every College LOGOS
                    $createGalleryCollegeLogo = new Gallery;
                    $createGalleryCollegeLogo->caption = 'College Logo';
                    $createGalleryCollegeLogo->misc = 'college-logo-img';
                    $createGalleryCollegeLogo->category_id = '1';
                    $createGalleryCollegeLogo->users_id = $userObj->id;
                    $createGalleryCollegeLogo->save();

                    //STORE INTO ADDRESS TABLE FOR CREATE RECORD
                    //For Registered address
                    $addressObj = New Address;
                    $addressObj->addresstype_id = '1';
                    $addressObj->collegeprofile_id = $collegeProfileObj->id;
                    $addressObj->save();

                    //For Campus address
                    $addressObj = New Address;
                    $addressObj->addresstype_id = '2';
                    $addressObj->collegeprofile_id = $collegeProfileObj->id;
                    $addressObj->save();

                    $placementObj = New Placement;
                    $placementObj->collegeprofile_id = $collegeProfileObj->id;
                    $placementObj->save();

                    $seoContentObj = New SeoContent;
                    $seoContentObj->pagetitle = $collegeName;
                    $seoContentObj->misc = 'collegepage';
                    $seoContentObj->collegeId = $collegeProfileObj->id;
                    $seoContentObj->employee_id = Auth::id();
                    $seoContentObj->save();

                    // if(env('APP_ENV') == 'local'){
                    //    $baseUrl = env('APP_URL').'/verify-email-address/';
                    // }else{
                    //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/verify-email-address/';
                    // }
                    $baseUrl = env('APP_URL').'/verify-email-address/';
                    $loginUrl = env('APP_URL').'/login';

                    $ecyEmailUrl = $baseUrl.$encrytEmail;

                    $resultMailSet = app('App\Http\Controllers\college\quickSignUpController')->sendCollegeSignupMail($emailAddress, $ecyEmailUrl, $collegeName);

                    $bodyContent    = '<ul>
                                        <li>College Name : '.$collegeName.'</li>
                                        <li>Email : '.$emailAddress.'</li>
                                        <li>Phone : '.$contactNumber.'</li>
                                        <li>Contact Person Name : '.$contactPersonName.'</li>
                                    </ul>
                                    <p><b>Login Details :</b></p>
                                    <ul>
                                        <li>Login Url : '.$loginUrl.'</li>
                                        <li>Email : '.$emailAddress.'</li>
                                        <li>Password : '.$password.'</li>
                                    </ul>
                                    <p>When you activate and login your account, then reset your account password.</p>';

                    $send_to = $emailAddress;
                    $send_cc = null;
                    $send_bcc = null;
                    $slug = 'after_college_account_created_notification_email';
                    $title =  Config::get('systemsetting.TITLE');
                    $form_name = $collegeName;

                    $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
                    $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

                    try {
                        if(!empty($contactNumber))
                        {
                            $userMobileNo = $contactNumber;  
                            $smsMessageData = Config::get('systemsetting.SIGNUPMSG').' '.$emailAddress.' '.Config::get('systemsetting.SMS_GROUP_NAME_5');
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
                            ]); */ 
                        } 
                    }catch (\Exception $e) {
                        return $e;
                    }

                    $updateObj = RequestForCreateCollegeAccount::findOrFail($requestId);
                    $updateObj->status = 1;
                    $updateObj->employee_id = Auth::id();
                    $updateObj->save();
                    
                    $dataArray = array(
                        'code' => '200',
                        'message' => 'success',
                        'response'  => 'Your college profile has been created successfully.',
                    );
                    return response()->json($dataArray);
                }else{
                    $dataArray = array(
                        'code' => '401',
                        'message' => 'success',
                        'response'  => 'This email address is already exist with another user.',
                    );
                    return response()->json($dataArray);
                }
            }else{
                $dataArray = array(
                    'code' => '400',
                    'message' => 'warning',
                    'response'  => 'You want to create but not you authorized person for this function!',
                );
                return response()->json($dataArray);
            }
        }else{
            $dataArray = array(
                'code' => '401',
                'message' => 'failure',
                'response'  => 'You are not authorized person for this function!',
            );
            return response()->json($dataArray);
        }
    }
}
