<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User as User;
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
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                //ACCESS CHECK
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'User')
                                    ->where('userprivileges.index', '=', '1')
                                    ->count()
                                    ;
                
                if( $validateUrlUsers >= '1' ){
                     //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'User')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;


                    $users = User::orderBy('id', 'DESC')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                        ->leftJoin('users as eID','users.employee_id', '=','eID.id')
                        ->where('users.userrole_id', '!=', '1')
                        ->where('users.userstatus_id','!=','5')
                        ->paginate(15, array('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone','userrole.id as userRoleId','userrole.name as userRoleName', 'userstatus.name as userStatusName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','users.updated_at'));
                
                    $userRoleObj = UserRole::all();
                    $userStatusObj = UserStatus::all();

                    return view('employee/users.index', compact('users'))
                            ->with('userRoleObj', $userRoleObj)
                            ->with('storeEditUpdateAction', $storeEditUpdateAction)
                            ->with('userStatusObj', $userStatusObj);    
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
                //ACCESS CHECK
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'User')
                                    ->where('userprivileges.create', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $users = User::orderBy('id', 'DESC')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                        ->paginate(15, array('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone','userrole.name as userRoleName', 'userstatus.name as userStatusName'));

                    $userRoleObj = UserRole::where('id', '!=', '1')
                                    ->where('id', '!=', '4')
                                    ->orderBy('name', 'desc')
                                    ->get()
                                    ;
                                    
                    $userStatusObj = UserStatus::all();

                    return view('employee/users.create')
                            ->with('userRoleObj', $userRoleObj)
                            ->with('userStatusObj', $userStatusObj)
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
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){

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

                                return redirect('employee/studentprofile/'.$getStudentProId->id.'/edit');

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
                                   /* $userIdHorizonSms = Config::get('app.userIdHorizonSms');
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

                            return redirect('employee/users');
                        }
                        catch (QueryException $e){
                        }
                    }else{
                        Session::flash('warning', 'Duplicate email address found, kindly use another email address'); 
                        return redirect('employee/users/create');
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
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                //ACCESS CHECK
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'User')
                                    ->where('userprivileges.show', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $users = DB::table('users')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                        ->leftJoin('users as eID','users.employee_id', '=','eID.id')
                        ->where('users.id', '=', $id)
                        ->where('users.userstatus_id','!=','5')
                        ->where('users.userrole_id','!=','1')
                        ->select('users.id', 'users.suffix','users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone', 'userrole.name as userRoleName', 'userstatus.name as userStatusName','users.userrole_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','users.updated_at')
                        ->orderBy('users.id', 'DESC')
                        ->get();

                    if (sizeof($users) > 0) {
                        return view('employee/users.show', compact('users'));
                    }else{
                        Session::flash('access_restricted_msg', 'Access Restricted!');
                        return Redirect::action('employee\AdminEmployeeController@index');
                    }

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
                //ACCESS CHECK
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'User')
                                    ->where('userprivileges.edit', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $user = User::findOrFail($id);
                    $userRoleObj = UserRole::all();
                    $userStatusObj = UserStatus::all();
                    

                    return view('employee/users.edit', compact('user'))
                            ->with('userRoleObj', $userRoleObj)
                            ->with('userStatusObj', $userStatusObj)
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

                try{
                        $usersObj = User::findOrFail($id);
                        //$user->update($request->all());
                        if( $usersObj->userrole_id == '2' ){

                            $usersObj->firstname = Input::get('firstName');
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
                        return redirect('employee/users/' . $id . '/edit');
                    }else{
                        Session::flash('warning', 'User Details has been Updated!');
                    }
                    
                    return redirect('employee/users');
                }
                catch ( QueryException $e){

                    Session::flash('warning', 'Duplicate email address found, kindly use another email address'); 
                    return redirect('employee/users/' . $id . '/edit');
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
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                //ACCESS CHECK
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'User')
                                    ->where('userprivileges.delete', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    User::destroy($id);

                    Session::flash('flash_message', 'User deleted!');

                    return redirect('employee/users');
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
     * Search users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function searchEmployeeUsers(Request $request)
    {
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
                        AND users.userrole_id != '1'
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
                        AND users.userrole_id != '1'
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

    public function allEmployeeUserDetails(Request $request){

        $users = User::orderBy('id', 'DESC')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                    ->leftJoin('users as eID','users.employee_id', '=','eID.id')
                    ->where('users.userstatus_id','!=','5')
                    ->where('users.userrole_id', '!=', '1')
                    ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone','userrole.name as userRoleName', 'userstatus.name as userStatusName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','users.updated_at')
                    ->orderBy('users.id', 'DESC')
                    ->take(20)
                    ->get();
  
        return json_encode($users);
    }

    public function employeeSendEmails(Request $request)
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

            $getTheEmailAdmin = DB::table('users')->where('userrole_id', '=', '1')->where('users.userstatus_id','=', '1')->select('email')->get();
            //$adminEmailId = $getTheEmailAdmin[0]->email;
            // $adminEmailId = 'amaresh091@gmail.com';
            $adminEmailId = array();
            foreach ($getTheEmailAdmin as $key => $value) {
                $adminEmailId = $value->email;
                //$adminEmailId = 'amareshtechnochords@gmail.com';
               // $adminEmailId[] = $tempArrayEmailId;

                try {
                   
                    if(!empty($adminEmailId) && ($this->fetchDataServiceController->isValidEmail($adminEmailId) == 1))
                    {
                       /**Swift Mailer Data TO admin_id***/        
                        \Mail::send('employee/users.email.emailtoAdmin', array('email' => $adminEmailId,'subjectData' => $subjectText, 'messageData' => $messageText ), function($message) use ($adminEmailId)
                        {
                            $message->to($adminEmailId, 'AdmissionX')->subject('New ticket form team :- Admission X');
                        });  
                    }
                }catch ( \Swift_TransportException $e) {                
                }
            }
            return Redirect::back();
        }else{
            Auth::logout();
            return Redirect::to('login');
        }        
    }

    public function deleteEmployeeSearchUser(Request $request, $id)
    {   
        //User::destroy($id);
        $usersObj = User::findOrFail($id);
        $usersObj->userstatus_id = '5';
        $usersObj->save();
        return Redirect::back();
    }


}
