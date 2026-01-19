<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User as User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use File;
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
use Session;
use PHPMailer;
use ResetsPasswords;
use App\Models\UserRole;
use App\Models\UserStatus;
use App\Models\CollegeProfile;
use Illuminate\Database\QueryException as QueryException;
use Illuminate\Auth\Passwords\PasswordBroker;
use App\Models\Address as Address;
use App\Models\Gallery as Gallery;
use App\Models\Document as Document;
use App\Models\Placement as Placement;
use App\Models\StudentProfile as StudentProfile;
use App\Models\StudentMark as StudentMark;
use App\Http\Controllers\website\WebsiteLogController;
use GuzzleHttp\Client;
use App\Models\SeoContent;
use App\Models\CollegeMaster;
use App\Http\Controllers\Helper\FetchDataServiceController;

class UsersController extends Controller
{

    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){

                $query = User::orderBy('id', 'DESC')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                        ->leftJoin('users as eID','users.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5');

                        if ($userId != 1) {
                            $query->where('users.id','!=','1');
                        }


                $users = $query->paginate(50, array('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone','userrole.id as userRoleId','userrole.name as userRoleName', 'userstatus.name as userStatusName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','users.updated_at'));
                
                $userRoleObj = UserRole::all();
                $userStatusObj = UserStatus::all();

                // $emailCheckObj = DB::table('users')
                // //->where('phone', '=', '+7 905 5102172')
                // //->whereBetween('id', [17291 , 18005])
                // //->where('users.userstatus_id','>','1')
                // //->where('users.userrole_id','=','3')
                // ->whereIn('id', [17970,17762,17748,17710,17700,17695,17527,17427,17417,17382,17336,17148,17147,17140,16306])
                // ->get();

                // foreach ($emailCheckObj as $key => $value) {
                //     if ($value->userrole_id == 2) {
                //         $getCollegeProId = CollegeProfile::where('users_id', '=', $value->id)->firstOrFail();

                //         Db::table('address')
                //             ->where('address.collegeprofile_id', '=', $getCollegeProId->id)
                //             ->delete();

                //         Db::table('placement')
                //             ->where('placement.collegeprofile_id', '=', $getCollegeProId->id)
                //             ->delete();

                //         Db::table('collegeprofile')
                //             ->where('collegeprofile.id', '=', $getCollegeProId->id)
                //             ->delete();

                //         Db::table('users')
                //             ->where('users.id', '=', $value->id)
                //             ->delete();
                //     }

                //     if ($value->userrole_id == 3) {
                //         $getStudentProId = StudentProfile::where('users_id', '=', $value->id)->firstOrFail();

                //         Db::table('address')
                //             ->where('address.studentprofile_id', '=', $getStudentProId->id)
                //             ->delete();

                //         Db::table('studentmarks')
                //             ->where('studentmarks.studentprofile_id', '=', $getStudentProId->id)
                //             ->delete();

                //         Db::table('studentprofile')
                //             ->where('studentprofile.id', '=', $getStudentProId->id)
                //             ->delete();

                //         Db::table('users')
                //             ->where('users.id', '=', $value->id)
                //             ->delete();
                //     }
                // }

                // print_r('wrong user deleted'); die;

                return view('administrator/users.index', compact('users'))
                        ->with('userRoleObj', $userRoleObj)
                        ->with('userStatusObj', $userStatusObj);        
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){

                $users = User::orderBy('id', 'DESC')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                        ->paginate(15, array('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone','userrole.name as userRoleName', 'userstatus.name as userStatusName'));

                $userRoleObj = UserRole::all();
                $userStatusObj = UserStatus::all();

                return view('administrator/users.create')
                        ->with('userRoleObj', $userRoleObj)
                        ->with('userStatusObj', $userStatusObj)
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

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   $email = Input::get('email'); 
            $password = Input::get('password');
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){

                //CHECK DUPLICATE EMAILS
                if( !empty(Input::get('email')) ){
                    $emailCheckObj = DB::table('users')
                                        ->where('email', '=', Input::get('email'))
                                        ->count()
                                        ;
                    
                    if( $emailCheckObj == '0' ){
                        //SAVE INTO DB
                        try{
                            $usersObj = new User;
                            
                            if( !empty(Input::get('suffix')) ){
                                $usersObj->suffix = Input::get('suffix');    
                            }                
                            
                            $usersObj->firstname = Input::get('firstName');
                            if (Input::get('middleName')) {
                                $usersObj->middlename =  Input::get('middleName');
                            }
                            $usersObj->lastname = Input::get('lastName');
                            $usersObj->email = Input::get('email');
                            $usersObj->phone = Input::get('phone');
                            $usersObj->password = Hash::make($password);
                            //$usersObj->password = Hash::make(Input::get('$request->password'));
                            $usersObj->userrole_id = Input::get('userRole');
                            $usersObj->userstatus_id = Input::get('userStatus');
                            $usersObj->employee_id = Auth::id();
                            $usersObj->save();

                            if( Input::get('userRole') == '2' )
                            {
                                $getEmailWiseUserId = User::where('email', '=', $email)->firstOrFail(); 

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
                            }

                            if( Input::get('userRole') == '3' )
                            {
                                $getEmailWiseUserId = User::where('email', '=', $email)->firstOrFail(); 

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
                                $seoContentObj->pagetitle = Input::get('firstName');
                                $seoContentObj->misc = 'studentpage';
                                $seoContentObj->userId = $getStudentProId->id;
                                $seoContentObj->employee_id = Auth::id();
                                $seoContentObj->save();

                                return redirect('administrator/studentprofile/'.$getStudentProId->id.'/edit');
                            }

                            $emailaddress = Input::get('email');
                            $contactNumber = Input::get('phone');
                            try {
                                if(!empty($contactNumber))
                                {
                                    $userMobileNo = $contactNumber;  
                                    $smsMessageData = Config::get('systemsetting.SIGNUPMSG').' '.$emailaddress.' '.Config::get('systemsetting.SMS_GROUP_NAME_5');
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
                            
                            Session::flash('flash_message', 'User added!');

                            return redirect('administrator/users');
                        }
                        catch (QueryException $e){
                        }
                    }else{
                        Session::flash('warning', 'Duplicate email address found, kindly use another email address'); 
                        return redirect('administrator/users/create');
                    }
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                if (($userId != 1) && ($id == 1)) {
                    Session::flash('warning', 'You are not authorize person for this account'); 
                    return Redirect::back();
                }
                $users = DB::table('users')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                        ->leftJoin('users as eID','users.employee_id', '=','eID.id')
                        ->where('users.id', '=', $id)
                        ->where('users.userstatus_id','!=','5')
                        ->select('users.id', 'users.suffix','users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone', 'userrole.name as userRoleName', 'userstatus.name as userStatusName','users.userrole_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','users.updated_at')
                        ->orderBy('users.id', 'DESC')
                        ->get();

                return view('administrator/users.show', compact('users'));
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){

                $user = User::findOrFail($id);
                $userRoleObj = UserRole::all();
                $userStatusObj = UserStatus::all();
                

                return view('administrator/users.edit', compact('user'))
                        ->with('userRoleObj', $userRoleObj)
                        ->with('userStatusObj', $userStatusObj)
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){

                try{
                        $usersObj = User::findOrFail($id);
                        //$user->update($request->all());
                        if( $usersObj->userrole_id == '2' ){

                            $usersObj->firstname = Input::get('firstName');
                            $usersObj->email = Input::get('email'); 

                            if ($usersObj->email != Input::get('email')) {
                                $checkUserName = DB::table('users')
                                ->where('email', '=', Input::get('email'))
                                ->count()
                                ;
                                if( $checkUserName == '0' ){
                                    $usersObj->email = Input::get('email');
                                    $emailaddressmsg = '0';
                                }else{
                                    $emailaddressmsg = '1';
                                }
                            }else{
                                $emailaddressmsg = '2';
                            }
                            $usersObj->phone = Input::get('phone');
                            $usersObj->userrole_id = '2';//Input::get('userRole');
                            $usersObj->userstatus_id = Input::get('userStatus');
                            if( $request->password != '' ){
                                $usersObj->password = Hash::make($request->password);    
                            }

                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('firstName').' '.$usersObj->id);
                            $slugUrl = strtolower($slugUrl);
                            //Set slud in college profile
                            $setSlug = CollegeProfile::where('users_id', '=', $usersObj->id)->firstOrFail();

                            //Rename folder
                            $slugUrlOld = $setSlug->slug;
                            $directoryForDocument =  public_path().'/document/'.$slugUrlOld;
                            $directoryForGallery =  public_path().'/gallery/'.$slugUrlOld;

                            rename($directoryForDocument, public_path().'/document/'.$slugUrl);
                            rename($directoryForGallery, public_path().'/gallery/'.$slugUrl);

                            $setSlug->slug = $slugUrl;
                            $setSlug->employee_id = Auth::id();
                            $setSlug->save();
                            
                        } 
                        else if ($usersObj->userrole_id == '3') {

                            if( !empty(Input::get('suffix')) ){
                            $usersObj->suffix = Input::get('suffix');    
                            }                
                            $usersObj->firstname = Input::get('firstName');

                            if (Input::get('middleName')) {
                               $usersObj->middlename = Input::get('middleName');
                            }
                            $usersObj->lastname = Input::get('lastName');
                            if ($usersObj->email != Input::get('email')) {
                                $checkUserName = DB::table('users')
                                ->where('email', '=', Input::get('email'))
                                ->count()
                                ;
                                if( $checkUserName == '0' ){
                                    $usersObj->email = Input::get('email');
                                    $emailaddressmsg = '0';
                                }else{
                                    $emailaddressmsg = '1';
                                }
                            }else{
                                $emailaddressmsg = '2';
                            }
                            $usersObj->phone = Input::get('phone');
                            $usersObj->userrole_id = '3';
                            $usersObj->userstatus_id = Input::get('userStatus');
                            if( $request->password != '' ){
                                $usersObj->password = Hash::make($request->password);    
                            }

                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('firstName').' '.$usersObj->id);
                            $slugUrl = strtolower($slugUrl);
                            //Set slud in college profile
                            $setSlug = StudentProfile::where('users_id', '=', $usersObj->id)->firstOrFail();

                            //Rename folder
                            $slugUrlOld = $setSlug->slug;
                            $directoryForDocument =  public_path().'/document/'.$slugUrlOld;
                            $directoryForGallery =  public_path().'/gallery/'.$slugUrlOld;

                            rename($directoryForDocument, public_path().'/document/'.$slugUrl);
                            rename($directoryForGallery, public_path().'/gallery/'.$slugUrl);
                            
                            $setSlug->slug = $slugUrl;
                            $setSlug->employee_id = Auth::id();
                            $setSlug->save();
                        }
                        else
                        {
                            if( !empty(Input::get('suffix')) ){
                            $usersObj->suffix = Input::get('suffix');    
                            }                
                            $usersObj->firstname = Input::get('firstName');
                            $usersObj->middlename = Input::get('middleName');
                            $usersObj->lastname = Input::get('lastName');
                            if ($usersObj->email != Input::get('email')) {
                                $checkUserName = DB::table('users')
                                ->where('email', '=', Input::get('email'))
                                ->count()
                                ;
                                if( $checkUserName == '0' ){
                                    $usersObj->email = Input::get('email');
                                    $emailaddressmsg = '0';
                                }else{
                                    $emailaddressmsg = '1';
                                }
                            }else{
                                $emailaddressmsg = '2';
                            }
                            $usersObj->phone = Input::get('phone');
                            $usersObj->userrole_id = Input::get('userRole');
                            $usersObj->userstatus_id = Input::get('userStatus');
                            if( $request->password != '' ){
                                $usersObj->password = Hash::make($request->password);    
                            }
                        }
                        $usersObj->employee_id = Auth::id();
                        $usersObj->save();

                    if ($emailaddressmsg == '1') {
                        Session::flash('warning', 'User Details has been Updated. But duplicate email address found, kindly use another email address');
                        return redirect('administrator/users/' . $id . '/edit');
                    }else{
                        Session::flash('warning', 'User Details has been Updated!');
                    }

                    return redirect('administrator/users');
                }
                catch ( QueryException $e){

                    Session::flash('warning', 'Duplicate email address found, kindly use another email address'); 
                    return redirect('administrator/users/' . $id . '/edit');
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
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                //print_r($userId);die;
               //User::destroy($id);
                $usersObj = User::findOrFail($id);
                $usersObj->userstatus_id = '5';
                $usersObj->employee_id = Auth::id();
                $usersObj->save();

                Session::flash('flash_message', 'User deleted!');

                return redirect('administrator/users');
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }         
    }

    public function doLogin()
    {

        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                //->withErrors($validator) // send back all errors to the login form
                //->withErrors(['auth-validation' => 'The password must be at least of 5 characters.'])
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                $emailAdd = Auth::user()->email;
                $userId = Auth::id();
                $roleGrant = User::where('id', '=', $userId)->first();
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.LOGINMSG').' by this User Id '.Auth::id());
                
                if( $roleGrant['userrole_id'] == '1'  && $roleGrant['userstatus_id'] == '1'  )
                {
                    return Redirect::to('/administrator/dashboard');
                }elseif( $roleGrant['userrole_id'] == '2'  && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                    $getSlugUrl = CollegeProfile::where('users_id', '=', $userId)->firstOrFail();
                    
                    //SET SESSION
                    if( $getSlugUrl->review == '0' ){
                        Session::flash('collegeProfileReviewStatus','Your college profile is in review till yet you can update your profile &amp; once your profile successfully review we will make you public thanks | Team AdmissionX.');     
                    }
                    if( $roleGrant['userstatus_id'] == '3' ){
                        Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.');    
                    }

                    $postAskExamDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postAskExamDataFromSession($userId);
                     
                    return redirect()->route('college_dash', $getSlugUrl->slug);
                }elseif ( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1' ){
                    $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();
                    $postPublishDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postPublishDataFromSession($userId);

                    $postAskExamDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postAskExamDataFromSession($userId);
                    return redirect()->route('student_dash', $getSlugUrl->slug);
                    //return Redirect::to('/student/dashboard');
                }elseif ( $roleGrant['userrole_id'] == '4'  && $roleGrant['userstatus_id'] == '1' ){
                    return Redirect::to('/employee/dashboard');
                }else{
                    Auth::logout();
                    //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                    $emailLink = $userObj = User::where('email', '=' ,$emailAdd)->firstOrFail();
                    if( $emailLink->userstatus_id == '2' ){
                        Session::flash('emailAdd', $emailAdd); 
                        Session::flash('confirmEmail', 'Please confirm your email ('.$emailAdd.') before login thank you.'); 
                    }

                    // if( $emailLink->userstatus_id == '3' ){
                        // Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.'); 
                    // }  

                    if( $emailLink->userstatus_id == '4' ){
                        Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                    }                
                    return Redirect::to('/login');
                }
                exit;          
            } else {        

                // validation not successful, send back to form 
                Auth::logout();
                return Redirect::back()
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password'));
                
                // return Redirect::to('/login')
                // ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                // ->withInput(Input::except('password'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
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
                return Redirect::to('/employee/dashboard');
            }else{
                Auth::logout();
                return Redirect::to('/');
            }
        }
        Auth::logout();
        $seoSlugName = 'login-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('administrator/users.login', compact('seocontent'));
        //return view('website/home.educationalInstitution');    
    }

    public function logout() {
        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.LOGOUTMSG').' by this User Id '.Auth::id());
        Auth::logout(); // logout user
        // return Redirect::to('login'); //redirect back to login
        return Redirect::to('/');
    }

    public function sucessLogin()
    {
        return view('administrator/collegeprofile.sucessLogin');
    }

    public function forgetPassword()
    {
        $email = Input::get('email'); 
        try {
            if(!empty($email) && ($this->fetchDataServiceController->isValidEmail($email) == 1))
            {
                $usersDataObj = DB::table('users')
                            ->where('email' ,'=', $email)
                            ->select('users.id', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as emailAddress', 'users.phone')
                            ->orderBy('users.id', 'DESC')
                            ->get();

                $firstName = $usersDataObj[0]->firstName;
                $middleName = $usersDataObj[0]->middleName;
                $lastName = $usersDataObj[0]->lastName;
                $emailAddress = $usersDataObj[0]->emailAddress;

                $updateApiKey = User::findOrFail($usersDataObj[0]->id);
                $uniqueKey = uniqid();
                $updateApiKey->apikey = $uniqueKey;
                $updateApiKey->save();

                // $ecyEmail = $this->emailEncrypt($emailAddress);
                $ecyEmail = $emailAddress;
                
            // if(env('APP_ENV') == 'local'){
            //    $baseUrl = env('APP_URL').'/update-password/';
            // }else{
            //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/update-password/';
            // }    
                $baseUrl = env('APP_URL').'/update-password/';
            $forgetPasswordUrlLink = $baseUrl.$uniqueKey;
            if(!empty($emailAddress) && ($this->fetchDataServiceController->isValidEmail($emailAddress) == 1)){ 
                 \Mail::send('administrator/users.email.forgetPassword', array('email' => $emailAddress,'firstName' => $firstName,'middleName' => $middleName,'lastName' => $lastName, 'encryptedEmail' =>$ecyEmail, 'forgetPasswordUrlLink' => $forgetPasswordUrlLink), function($message) use ($emailAddress)
                    {   
                        $message->from('support@admissionx.info', 'Support Team');
                        $message->to($emailAddress, 'AdmissionX')->subject('Forget password link - AdmissionX');                    
                    });
                }  

                Session::flash('checkEmailSucess', 'Thank you. Please check your e-mail to reset your Password.'); 
            
                return Redirect::to('/');
            }else{
                Session::flash('confirmBlockedEmail', 'This email address is not valid.'); 
                return Redirect::to('login');
            }
        } catch (\Exception $e) {
            Session::flash('confirmBlockedEmail', 'This email address is not registered with us. Team AdmissionX'); 
            return Redirect::to('login');
        }
    }

    public function emailEncrypt($emailAddress, $salt = "admissionx.com")
    {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $emailAddress, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }
    // This function will be used to decrypt data.
    
    public function emailDecrypt($emailAddress, $salt = "admissionx.com")
    {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($emailAddress), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

    public function updatePassword($key)
    {
            $usersObj = DB::table('users')
                    ->where('apikey', '=', $key)
                    ->select( 'users.id' )
                    ->take(1)
                    ->orderBy('id', 'DESC')
                    ->get()
                    ;

            $seoSlugName = 'update-password';
            $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
        
        if( !empty($usersObj) ){
            return view('administrator/users.updatePassword', compact('seocontent'))
                    ->with('userID', $usersObj[0]->id)
                    ;
        }else{
            return Redirect::to('/');
        }
    }

    public function passwordUpdateSucess(Request $request)
    {
        $userID = Input::get('userID');
        $password = Input::get('password');

        $userEditObj = User::findOrFail($userID);
        $userEditObj->password = Hash::make($password);
        $userEditObj->save();

        if ($userEditObj->userrole_id == 3) {
            if(Session::has('isUserPost') && (Session::get('isUserPost') == 1)){
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

            $postPublishDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postPublishDataFromSession($userID);
        }
        $postAskExamDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postAskExamDataFromSession($userID);

        Session::flash('success', 'Your password updated please try again with new password'); 

        return redirect('login');
    }

    /*public function forgetPassword()
    {
        $email = Input::get('email'); 
        try {
            if(!empty($email) && ($this->fetchDataServiceController->isValidEmail($email) == 1))
            {
                $usersDataObj = DB::table('users')
                            ->where('email' ,'=', $email)
                            ->select('users.id', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as emailAddress', 'users.phone')
                            ->orderBy('users.id', 'DESC')
                            ->get();

                $firstName = $usersDataObj[0]->firstName;
                $middleName = $usersDataObj[0]->middleName;
                $lastName = $usersDataObj[0]->lastName;
                $emailAddress = $usersDataObj[0]->emailAddress;

                $ecyEmail = $this->emailEncrypt($emailAddress);
                
             // if(env('APP_ENV') == 'local'){
            //    $baseUrl = env('APP_URL').'/update-password/';
            // }else{
            //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/update-password/';
            // }    
            $baseUrl = env('APP_URL').'/update-password/';
            $forgetPasswordUrlLink = $baseUrl.$ecyEmail;

             \Mail::send('administrator/users.email.forgetPassword', array('email' => $emailAddress,'firstName' => $firstName,'middleName' => $middleName,'lastName' => $lastName, 'encryptedEmail' =>$ecyEmail, 'forgetPasswordUrlLink' => $forgetPasswordUrlLink), function($message) use ($emailAddress)
                {
                    $message->to($emailAddress, 'AdmissionX')->subject('Forget password link - AdmissionX');
                });  

                Session::flash('checkEmailSucess', 'Thank you. Please check your e-mail to reset your Password.'); 
            
                return Redirect::to('/');
            }else{
                Session::flash('confirmBlockedEmail', 'This email address is not valid.'); 
                return Redirect::to('login');
            }
        } catch (\Exception $e) {
            Session::flash('confirmBlockedEmail', 'This email address is not registered with us. Team AdmissionX'); 
            return Redirect::to('login');
        }
    }

    public function emailEncrypt($emailAddress, $salt = "admissionx.com")
    {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $emailAddress, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }
    // This function will be used to decrypt data.
    
    public function emailDecrypt($emailAddress, $salt = "admissionx.com")
    {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($emailAddress), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

    public function updatePassword($emailAddress)
    {
        $decEmailAddrress = $this->emailDecrypt($emailAddress);
        
        $usersObj = DB::table('users')
                    ->where('email', '=', $decEmailAddrress)
                    ->select( 'users.id' )
                    ->take(1)
                    ->get()
                    ;
        
        if( !empty($usersObj) ){
            return view('administrator/users.updatePassword')
                    ->with('emailAddress', $decEmailAddrress)
                    ->with('userID', $usersObj[0]->id)
                    ;
        }else{
            return Redirect::to('/');
        }
    }

    public function passwordUpdateSucess(Request $request)
    {
        $userID = Input::get('userID');
        $password = Input::get('password');

        $userEditObj = User::findOrFail($userID);
        $userEditObj->password = Hash::make($password);
        $userEditObj->save();

        Session::flash('success', 'Your password updated please try again with new password'); 

        return redirect('login');
    }*/

    /**
     * Search users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function searchUsers(Request $request)
    {
        $userId = Auth::id();
        $search0 = 'users.id';

        if( $request->userFirstName != null ){
            $search1 = "AND `users`.`firstname` LIKE  '%".$request->userFirstName."%'";
        }else{
            $search1 =  '';
        }

        if( $request->userLastName != null ){
            $search2 = "AND `users`.`lastname` LIKE  '%".$request->userLastName."%'";
        }else{
            $search2 =  '';
        }

        if( $request->userEmailAddress != '' ){
            $search3 = "AND `users`.`email` LIKE  '%".$request->userEmailAddress."%'";
        }else{
            $search3 =  '';
        }

        if( $request->phoneNumber != '' ){
            $search4 = "AND `users`.`phone` LIKE  '%".$request->phoneNumber."%'";
        }else{
            $search4 =  '';
        }

        if( $request->userrole_id != '' ){
            $search5 = "AND `users`.`userrole_id` LIKE  '%".$request->userrole_id."%'";
        }else{
            $search5 =  '';
        }

        if( $request->userstatus_id != '' ){
            $search6 = "AND `users`.`userstatus_id` =  '".$request->userstatus_id."'";
        }else{
            $search6 =  '';
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

        if( $userId != 1 ){
            $search7 = "AND `users`.`id` != 1";
        }else{
            $search7 =  '';
        }

//AND users.userstatus_id != '5'
        $userDataObj = DB::select( DB::raw("SELECT users.id, users.firstname, users.middlename, users.lastname, users.phone, users.email, users.userstatus_id, users.userrole_id, userrole.name as userRoleName, userstatus.id as userstatusID,userstatus.name as userStatusName ,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,users.updated_at FROM  `users`      
                        INNER JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        INNER JOIN `userstatus` ON `users`.`userstatus_id` = `userstatus`.`id`
                        LEFT JOIN `users` as `eID` ON `users`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        $search5
                        $search6
                        $search7
                        ORDER BY users.id ASC
                        LIMIT 20 OFFSET $getValue"
                    ));

        $userDataObj1 = DB::select( DB::raw("SELECT COUNT(users.id) as totalCount FROM  `users` 
                        INNER JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        INNER JOIN `userstatus` ON `users`.`userstatus_id` = `userstatus`.`id`
                        LEFT JOIN `users` as `eID` ON `users`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        $search5
                        $search6
                        $search7
                        ORDER BY users.id ASC
                        LIMIT 20 "
                    ));

//print_r($userDataObj1);die;
        if(!empty($userDataObj1)){
            $numRecords = $userDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'userDataObj' => $userDataObj,
                    'userDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $userDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'userDataObj' => $userDataObj,
                    'userDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $userDataObj1,
                );
        }

        if( !empty($userDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allUserDetails(Request $request)
    {
        $userId = Auth::id();
        $query = User::orderBy('id', 'DESC')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                    ->leftJoin('users as eID','users.employee_id', '=','eID.id')
                    ->where('users.userstatus_id','!=','5');

        if ($userId != 1) {
            $query->where('users.id','!=','1');
        }
                    
        $users  = $query->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone','userrole.name as userRoleName', 'userstatus.name as userStatusName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','users.updated_at')
                    ->orderBy('users.id', 'DESC')
                    ->take(20)
                    ->get();
  
        return json_encode($users);
    }

    public function studentLoginDetails(Request $request)
    {
        $collegemasterId = Input::get('collegemasterId'); 
        $slugUrl = Input::get('slugUrl'); 
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                //->withErrors($validator) // send back all errors to the login form
                //->withErrors(['auth-validation' => 'The password must be at least of 5 characters.'])
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        }else{
                // create our user data for the authentication
                $userdata = array(
                    'email'     => Input::get('email'),
                    'password'  => Input::get('password')
                );
                // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                $emailAdd = Auth::user()->email;
                $userId = Auth::id();
                $roleGrant = User::where('id', '=', $userId)->first();
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.LOGINMSG').' by this User Id '.Auth::id());
                if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  )
                {
                    $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();
                    //return redirect()->route('student_dash', $getSlugUrl->slug);
                    if(env('APP_ENV') == 'local'){
                       $dirUrl = url().'/student/apply-course-details/'.$collegemasterId.'/'.$slugUrl;
                    }else{
                        $dirUrl = url().'/student/apply-course-details/'.$collegemasterId.'/'.$slugUrl;
                    }
                    return Redirect::to($dirUrl);
                    //return Redirect::to('/student/dashboard');
                }else{
                    Auth::logout();
                    //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                    $emailLink = $userObj = User::where('email', '=' ,$emailAdd)->firstOrFail();
                    if( $emailLink->userstatus_id == '2' ){
                        Session::flash('emailAdd', $emailAdd); 
                        Session::flash('confirmEmail', 'Please confirm your email ('.$emailAdd.') before login thank you.'); 
                    }
                    if( $emailLink->userrole_id != '3' ){
                        Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                    }
                    
                    if( $emailLink->userstatus_id == '4' ){
                        Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                    }

                    $seoSlugName = 'login-page';
                    $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
                    //$getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(18);
                    $getPageContentDataObj = [];

                    return View::make('administrator/users.studentlogin', compact('seocontent','getPageContentDataObj'))
                        ->with('collegemasterId', $collegemasterId)
                        ->with('slugUrl', $slugUrl);              
                    //return Redirect::to('/student-login');
                }
                exit;          
            }else {        
                // validation not successful, send back to form 
                Auth::logout();
                return Redirect::back()
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password'));
                // return Redirect::to('/login')
                // ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                // ->withInput(Input::except('password'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function studentLogin(Request $request)
    {   
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1' )
            {
                $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();
                
                return redirect()->route('student_dash', $getSlugUrl->slug);
                
            }else{
                Auth::logout();
                return Redirect::back();
                //return Redirect::to('/');
            }
        }else{
            Auth::logout();
            return Redirect::back();
            //$seoSlugName = 'login-page';
            //$seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

            //return View::make('administrator/users.studentlogin', compact('seoSlugName'));
        }
    }

    public function bookmarkLogin(Request $request)
    {
        
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                $emailAdd = Auth::user()->email;
                $userId = Auth::id();
                $roleGrant = User::where('id', '=', $userId)->first();
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.LOGINMSG').' by this User Id '.Auth::id());
                if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  )
                {
                    //return Redirect::back();
                    $dataArray = array(
                            'code' => '200',
                            'response' => 'success',                
                        );
                    return response()->json($dataArray);
                }else{
                    Auth::logout();
                    //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                    $emailLink = $userObj = User::where('email', '=' ,$emailAdd)->firstOrFail();
                    if( $emailLink->userstatus_id == '2' ){
                        Session::flash('emailAdd', $emailAdd); 
                        Session::flash('confirmEmail', 'Please confirm your email ('.$emailAdd.') before login thank you.'); 
                    }

                    return Redirect::to('/user/bookmark-login');
                }
                exit;          
            } else {        

                // validation not successful, send back to form 
                Auth::logout();
                return Redirect::back()
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password'));
            }

        }
    }

   
    public function adminSendEmails(Request $request)
    {
        if( Auth::check() ){
           

            if( !empty(Input::get('subject')) ){
                $subjectText = Input::get('subject');     
            }

            if( !empty(Input::get('message')) ){
                $messageText = Input::get('message');    
            }

            if( !empty(Input::get('userEmail')) ){
                $emailText = Input::get('userEmail');    
            }


            try {
                
                if(!empty($emailText) && ($this->fetchDataServiceController->isValidEmail($emailText) == 1))
                {
                        /**Swift Mailer TO COLLEGE***/        
                        \Mail::send('administrator/users.email.notifyUser', array('email' => $emailText,'subjectData' => $subjectText, 'messageData' => $messageText ), function($message) use ($emailText)
                        {
                            $message->to($emailText, 'AdmissionX')->subject('You got a notification form AdmissionX');
                        });  
                } 

            }catch ( \Swift_TransportException $e) {                
            }
            return Redirect::back();
        }else{
            Auth::logout();
            return Redirect::to('login');
        }        
    }


    public function deleteSearchUser(Request $request, $id)
    {   
        //User::destroy($id);
        $usersObj = User::findOrFail($id);
        $usersObj->userstatus_id = '5';
        $usersObj->save();
        return Redirect::back();
    }

    public function permanentlyDeleteUser(Request $request)
    {
        $id = Input::get('id');
        $usersObj = User::findOrFail($id);
        if (Auth::check() && Auth::user()->userrole_id == 1) {
            if( $usersObj->userrole_id == '2' ){
                $getCollProId = CollegeProfile::where('collegeprofile.users_id', '=', $id)->firstOrFail();

                $applicationCount = DB::table('application')
                                        ->where('application.collegeprofile_id', '=', $getCollProId->id)
                                        ->count();
                if ($applicationCount  == 0) {
                    $directoryForDocument =  public_path().'/document/'.$getCollProId->slug;
                    $directoryForGallery =  public_path().'/gallery/'.$getCollProId->slug;

                    File::deleteDirectory($directoryForDocument);
                    File::deleteDirectory($directoryForGallery);
                    DB::table('gallery')
                        ->where('gallery.users_id', '=', $id)
                        ->delete();

                    DB::table('documents')
                        ->where('documents.users_id', '=', $id)
                        ->delete();

                    DB::table('address')
                        ->where('address.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('placement')
                        ->where('placement.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('seo_contents')
                        ->where('seo_contents.collegeId', '=', $getCollProId->id)
                        ->delete();

                    DB::table('collegefacilities')
                        ->where('collegefacilities.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('event')
                        ->where('event.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('application')
                        ->where('application.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('applicationstatusmessages')
                        ->where('applicationstatusmessages.college_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('collegemaster')
                        ->where('collegemaster.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('faculty')
                        ->where('faculty.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_management_details')
                        ->where('college_management_details.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_scholarships')
                        ->where('college_scholarships.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_social_media_links')
                        ->where('college_social_media_links.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_cut_offs')
                        ->where('college_cut_offs.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_reviews')
                        ->where('college_reviews.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('faculty_experiences')
                        ->where('faculty_experiences.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('faculty_qualifications')
                        ->where('faculty_qualifications.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_faqs')
                        ->where('college_faqs.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_sports_activities')
                        ->where('college_sports_activities.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_master_associate_faculties')
                        ->where('college_master_associate_faculties.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('faculty_departments')
                        ->where('faculty_departments.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_admission_procedures')
                        ->where('college_admission_procedures.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('college_admission_important_dateds')
                        ->where('college_admission_important_dateds.collegeprofile_id', '=', $getCollProId->id)
                        ->delete();

                    DB::table('collegeprofile')
                        ->where('collegeprofile.users_id', '=', $id)
                        ->delete();

                    User::destroy($id);
                
                    $dataArray = array(
                        'code' => '200',
                        'message' => 'success',
                    );
                    return response()->json($dataArray);
                }else{
                    $dataArray = array(
                        'code' => '201',
                        'message' => 'can\'t be delete this acccount! beacuse '.$applicationCount.' applications are associated!',
                    );
                    return response()->json($dataArray);
                }
            }else if( $usersObj->userrole_id == '3' ){
                //GET STUDENT PROFILE ID AS PER SLUG
                $getStudentProId = StudentProfile::where('studentprofile.users_id', '=', $id)->firstOrFail();
                $applicationCount = DB::table('application')
                                        ->where('application.collegeprofile_id', '=', $getStudentProId->id)
                                        ->count();
                //if ($applicationCount  == 0) {
                    $directoryForDocument =  public_path().'/document/'.$getStudentProId->slug;
                    $directoryForGallery =  public_path().'/gallery/'.$getStudentProId->slug;

                    File::deleteDirectory($directoryForDocument);
                    File::deleteDirectory($directoryForGallery);

                    DB::table('gallery')
                        ->where('gallery.users_id', '=', $id)
                        ->delete();

                    DB::table('documents')
                        ->where('documents.users_id', '=', $id)
                        ->delete();

                    DB::table('address')
                        ->where('address.studentprofile_id', '=', $getStudentProId->id)
                        ->delete();

                    DB::table('studentmarks')
                        ->where('studentmarks.studentprofile_id', '=', $getStudentProId->id)
                        ->delete();

                    DB::table('seo_contents')
                        ->where('seo_contents.userId', '=', $getStudentProId->id)
                        ->delete();

                    DB::table('college_reviews')
                        ->where('college_reviews.guestUserId', '=', $id)
                        ->delete();

                    DB::table('application')
                        ->where('application.users_id', '=', $id)
                        ->delete();

                    DB::table('applicationstatusmessages')
                        ->where('applicationstatusmessages.student_id', '=', $id)
                        ->delete();

                    DB::table('bookmarks')
                        ->where('bookmarks.student_id', '=', $id)
                        ->delete();

                    DB::table('studentprofile')
                        ->where('studentprofile.users_id', '=', $id)
                        ->delete();

                    User::destroy($id);
                
                    $dataArray = array(
                        'code' => '200',
                        'message' => 'success',
                    );
                    return response()->json($dataArray);
                // }else{
                //      $dataArray = array(
                //         'code' => '201',
                //         'message' => 'can\'t be delete this acccount! beacuse '.$applicationCount.' applications are associated!',
                //     );
                //     return response()->json($dataArray);
                // }
            }else if ($usersObj->userrole_id == '1') {
                $dataArray = array(
                    'code' => '201',
                    'message' => 'can\'t be delete admin acccount!',
                );
                return response()->json($dataArray);
            }else{
                User::destroy($id);
                
                $dataArray = array(
                    'code' => '200',
                    'message' => 'success',
                );
                return response()->json($dataArray);
            }
        }else{
            $dataArray = array(
                'code' => '401',
                'message' => 'failure',
            );
            return response()->json($dataArray);
        }
    }

    public function ajaxDoLogin()
    {
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            $dataArray = array(
                        'code' => '401',
                        'response' => 'Entered email and password does not match.',
                        'url' => '',
                    );
        } else {
            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                $emailAdd = Auth::user()->email;
                $userId = Auth::id();
                $roleGrant = User::where('id', '=', $userId)->first();
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.LOGINMSG').' by this User Id '.Auth::id());
                if( $roleGrant['userrole_id'] == '1'  && $roleGrant['userstatus_id'] == '1'  )
                {   
                    $dataArray = array(
                        'code' => '200',
                        'response' => 'success',
                        'url' => 'administrator/dashboard',
                    );                    
                }elseif( $roleGrant['userrole_id'] == '2'  && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                    $getSlugUrl = CollegeProfile::where('users_id', '=', $userId)->firstOrFail();
                    
                    $postAskExamDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postAskExamDataFromSession($userId);
                    //SET SESSION
                    if( $getSlugUrl->review == '0' ){
                        Session::flash('collegeProfileReviewStatus','Your college profile is in review till yet you can update your profile &amp; once your profile successfully review we will make you public thanks | Team AdmissionX.');     
                    }
                    if( $roleGrant['userstatus_id'] == '3' ){
                        Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.');    
                    }
                    $dataArray = array(
                        'code' => '200',
                        'response' => 'success',
                        'url' => 'college/dashboard/edit/'.$getSlugUrl->slug,
                    ); 

                    // Auth::logout();
                    // $dataArray = array(
                    //     'code' => '200',
                    //     'response' => 'College Login Go to College Login Here',
                    //     'url' => 'educational-institution',
                    // );                    
                }elseif ( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1' ){
                    $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();
                    $postPublishDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postPublishDataFromSession($userId);
                    $dataArray = array(
                        'code' => '200',
                        'response' => 'success',
                        'url' => 'student/dashboard/edit/'.$getSlugUrl->slug,
                    ); 
                    
                }elseif ( $roleGrant['userrole_id'] == '4'  && $roleGrant['userstatus_id'] == '1' ){
                    $dataArray = array(
                        'code' => '200',
                        'response' => 'success',
                        'url' => 'employee/dashboard',
                    );                     
                }else{
                    Auth::logout();
                    //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                    $emailLink = $userObj = User::where('email', '=' ,$emailAdd)->firstOrFail();
                    if( $emailLink->userstatus_id == '2' ){
                        Session::flash('emailAdd', $emailAdd); 
                        Session::flash('confirmEmail', 'Please confirm your email ('.$emailAdd.') before login thank you.'); 
                    }
                    $dataArray = array(
                        'code' => '210',
                        'response' => 'Please confirm your email ('.$emailAdd.') before login thank you.',
                        'url' => '',
                    ); 
                    // if( $emailLink->userstatus_id == '3' ){
                        // Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.'); 
                    // }  

                    if( $emailLink->userstatus_id == '4' ){
                        Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info');

                        $dataArray = array(
                            'code' => '220',
                            'response' => 'Your account has been blocked, please contact administrator at support@admissionx.info',
                            'url' => '',
                        ); 
                    }                    
                }                
            } else {        

                // validation not successful, send back to form 
                Auth::logout();
                $dataArray = array(
                            'code' => '401',
                            'response' => 'Entered email and password does not match.',
                            'url' => '',
                        );                 
            }
        }
        return response()->json($dataArray);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function guestQueryLogin(Request $request, $slug)
    {   
        $collegeProfile = CollegeProfile::where('slug', '=', $slug)->firstOrFail();
        $collegeId = $collegeProfile->id;

        Session::set('collegeId', $collegeId);    
        Session::set('isUserPost', 6);

        return view('administrator/users.guestquerylogin')
        ->with('slug', $slug);
        
    }
   

    public function queryLoginDetails(Request $request)
    {

        $slugUrl = Input::get('slugUrl'); 
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                //->withErrors($validator) // send back all errors to the login form
                //->withErrors(['auth-validation' => 'The password must be at least of 5 characters.'])
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        }
        else{
                // create our user data for the authentication
                $userdata = array(
                    'email'     => Input::get('email'),
                    'password'  => Input::get('password')
                );
                // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                $emailAdd = Auth::user()->email;
                $userId = Auth::id();
                $roleGrant = User::where('id', '=', $userId)->first();
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.LOGINMSG').' by this User Id '.Auth::id());
                if( $roleGrant['userrole_id'] == '3'  && $roleGrant['userstatus_id'] == '1'  )
                {
                    $getSlugUrl = StudentProfile::where('users_id', '=', $userId)->firstOrFail();

                    //return redirect()->route('student_dash', $getSlugUrl->slug);
                    if(env('APP_ENV') == 'local'){
                       $dirUrl = url().'/college/'.$slugUrl;
                    }else{
                        $dirUrl = url().'/college/'.$slugUrl;
                    }
                    return Redirect::to($dirUrl);
                    //return Redirect::to('/student/dashboard');
                }else{
                    Auth::logout();
                    //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                    $emailLink = $userObj = User::where('email', '=' ,$emailAdd)->firstOrFail();
                    if( $emailLink->userstatus_id == '2' ){
                        Session::flash('emailAdd', $emailAdd); 
                        Session::flash('confirmEmail', 'Please confirm your email ('.$emailAdd.') before login thank you.'); 
                    }
                    if( $emailLink->userstatus_id == '4' ){
                        Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                    } 

                    if( $roleGrant['userrole_id'] != '3' ){
                        Session::flash('confirmBlockedEmail', 'This feature is only available for students account.'); 
                    }

                    return Redirect::to('/student-login');
                }
                exit;          
            }else {        
                // validation not successful, send back to form 
                Auth::logout();
                return Redirect::back()
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password'));
                // return Redirect::to('/login')
                // ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                // ->withInput(Input::except('password'));
            }
        }
    }

    public function collegeLoginAction()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('educational-institution')
                //->withErrors($validator) // send back all errors to the login form
                //->withErrors(['auth-validation' => 'The password must be at least of 5 characters.'])
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        }else {
            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                $emailAdd = Auth::user()->email;
                $userId = Auth::id();
                $roleGrant = User::where('id', '=', $userId)->first();
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.LOGINMSG').' by this User Id '.Auth::id());
                
                if( $roleGrant['userrole_id'] == '1'  && $roleGrant['userstatus_id'] == '1'  )
                {
                    return Redirect::to('/administrator/dashboard');
                }elseif( $roleGrant['userrole_id'] == '2'  && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                    $getSlugUrl = CollegeProfile::where('users_id', '=', $userId)->firstOrFail();
                    //SET SESSION
                    if( $getSlugUrl->review == '0' ){
                        Session::flash('collegeProfileReviewStatus','Your college profile is in review till yet you can update your profile &amp; once your profile successfully review we will make you public thanks | Team AdmissionX.');     
                    }
                    if( $roleGrant['userstatus_id'] == '3' ){
                        Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.');    
                    }
                    return redirect()->route('college_dash', $getSlugUrl->slug);
                }elseif ( $roleGrant['userrole_id'] == '3'){
                    Auth::logout();
                    Session::flash('college_flash_message', 'Only College can Login Here for Student Login Go to Student Login Here');
                    Session::flash('college_alert_class', 'alert-success');
                    return Redirect::to('/educational-institution');
                }elseif ( $roleGrant['userrole_id'] == '4'  && $roleGrant['userstatus_id'] == '1' ){
                    return Redirect::to('/employee/dashboard');
                }else{
                    Auth::logout();
                    //DB QUERY FOR VALIDATE THE SEND EMAIL LINK
                    $emailLink = $userObj = User::where('email', '=' ,$emailAdd)->firstOrFail();
                    if( $emailLink->userstatus_id == '2' ){
                        Session::flash('emailAdd', $emailAdd); 
                        Session::flash('confirmEmail', 'Please confirm your email ('.$emailAdd.') before login thank you.'); 
                    }

                    if( $emailLink->userstatus_id == '3' ){
                        Session::flash('confirmDisabledEmail','your account has been disabled, please contact administrator to unblock account at support@admissionx.info. You can not take or book admissions or make queries as long as your account is disabled.'); 
                    }  

                    if( $emailLink->userstatus_id == '4' ){
                        Session::flash('confirmBlockedEmail','Your account has been blocked, please contact administrator at support@admissionx.info'); 
                    }                
                    return Redirect::to('/login');
                }
                exit;          
            } else {        
                // validation not successful, send back to form 
                Auth::logout();
                return Redirect::back()
                ->withErrors(['auth-validation' => 'Entered username and password does not match.'])
                ->withInput(Input::except('password'));
            }
        }
    }


    public function emailTest(Request $request)
    {
        $firstname = 'Amaresh';
        $middlename = 'Kumar';
        $lastname = 'Anuj';
        $fullname = $firstname.' '.$middlename.' '.$lastname;
        $email = 'amaresh091@gmail.com';
        $forgetPasswordUrlLink = 'https://admissionx.com/update-password/59242e657853f';
        $mail = new PHPMailer\PHPMailer\PHPMailer;

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

        $mail->SMTPDebug = 0;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username     = Config::get('systemsetting.WelcomeEmail');  // SMTP username
        $mail->Password     = Config::get('systemsetting.WelcomeEmailPassword');  // SMTP password
        //$mail->Username     = 'tdeveloper4@gmail.com';  // SMTP username
        //$mail->Password     = 'vwahmkblldevvnio';  // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('support@admissionx.info', 'Support Team');
        $mail->addAddress($email, $fullname);     // Add a recipient

        $message = file_get_contents('assets/forgetPassword.html');
        $message = str_replace('%firstname%', $firstname, $message);
        $message = str_replace('%middlename%', $middlename, $message);
        $message = str_replace('%lastname%', $lastname, $message);
        $message = str_replace('%email%', $email, $message);
        $message = str_replace('%forgetPasswordUrlLink%', $forgetPasswordUrlLink, $message);
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Here is the subject';
        $mail->Body    =  ''.$message.'';
       // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}
