<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Application;
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
use Swift_Attachment;
use Config;
use DateTime;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\ApplicationStatus as ApplicationStatus;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\ApplicationStatusMessage;
use App\Models\CollegeMaster as CollegeMaster;
use GuzzleHttp\Client;
use PDF;
use Dompdf\Dompdf;
use Anam\PhantomMagick\Converter;
use App\Http\Controllers\Helper\FetchDataServiceController;

class ApplicationController extends Controller
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
            //$application = Application::paginate(15);
            $application = Application::orderBy('id', 'DESC')
                            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                            ->leftJoin('users as studentUser', 'application.users_id','=', 'studentUser.id')
                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                            ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                            ->leftJoin('users as eID','application.employee_id', '=','eID.id')
                            ->where('collegeUser.userstatus_id','!=','5')
                            ->where('studentUser.userstatus_id','!=','5')
                            ->paginate(15,array('application.id', 'application.name as applicationName','applicationstatus.name as applicationstatusName','applicationstatus.id as applicationstatusId', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob', 'application.email', 'application.phone', 'gender', 'percent10', 'marksheet10', 'percent11', 'marksheet11', 'percent12', 'marksheet12', 'graduationPercent', 'graduationMarksheet', 'parentname', 'parentnumber', 'parentidproof', 'hobbies', 'interest', 'awards', 'projects', 'iagreeparents', 'iagreeform', 'totalfees', 'byafees', 'restfees','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','application.applicationID','application.lastPaymentAttemptDate','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','application.updated_at','application.created_at' ))
                            ;

            $applicationStatusObj = ApplicationStatus::all();
            //$userObj = User::all();
            $userObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->where('users.userrole_id', '!=', '2')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

            $collegeProfileObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->where('users.userrole_id', '=', '2')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

            return view('administrator/application.index', compact('application'))
                        ->with('collegeProfileObj',$collegeProfileObj)
                        ->with('applicationStatusObj',$applicationStatusObj)
                        ->with('userObj',$userObj);
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
            
            $applicationStatusObj = ApplicationStatus::all();
            $userObj = User::all();

            $collegeProfileObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->where('users.userrole_id', '=', '2')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
            return view('administrator/application.create')
            ->with('collegeProfileObj',$collegeProfileObj)
            ->with('applicationStatusObj',$applicationStatusObj)
            ->with('userObj',$userObj);
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            
            $collegeProfileId = Input::get('collegeprofile_id');

            $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($collegeProfileId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($collegeProfileId)
                                                );  
                                            })
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
            $application = New Application();
            $application->name = Input::get('name');
            $application->applicationstatus_id = Input::get('applicationstatus_id');
            $application->users_id = Input::get('users_id');
            $application->collegeprofile_id =  $collegeProfileDataObj[0]->collegeProfileId;
            $application->employee_id = Auth::id();
            $application->save();

            Session::flash('flash_message', 'Application added!');
            return redirect('administrator/application');
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
            $application = Application::orderBy('id', 'DESC')
                            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                            ->leftJoin('users as studentUser', 'application.users_id','=', 'studentUser.id')
                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                            ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                            ->leftJoin('users as eID','application.employee_id', '=','eID.id')
                            ->select('application.id', 'application.name','applicationstatus.id as applicationstatusId','applicationstatus.name as applicationstatusName', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob', 'application.email', 'application.phone', 'gender', 'percent10', 'marksheet10', 'percent11', 'marksheet11', 'percent12', 'marksheet12', 'graduationPercent', 'graduationMarksheet', 'parentname', 'parentnumber', 'parentidproof', 'hobbies', 'interest', 'awards', 'projects', 'iagreeparents', 'iagreeform', 'totalfees', 'byafees', 'restfees','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','application.applicationID','application.lastPaymentAttemptDate','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','application.updated_at','application.created_at')
                            ->findOrFail($id)
                            ;

            return view('administrator/application.show', compact('application'));
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
            $application = Application::findOrFail($id);

            $collegeProfileObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->where('users.userrole_id', '=', '2')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
            $collegeObj = Application::where('application.id', $application->id)
                                        ->leftjoin('collegeprofile', 'application.collegeprofile_id', '=', 'collegeprofile.id')
                                        ->join('users', 'collegeprofile.users_id','=','users.id')
                                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                                        ->select('users.id','users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName' )
                                        ->get()->first();

            $userObj = User::all();
            $applicationStatusObj = ApplicationStatus::all();
            return view('administrator/application.edit', compact('application'))
                    ->with('collegeProfileObj',$collegeProfileObj)
                    ->with('applicationStatusObj',$applicationStatusObj)
                    ->with('userObj', $userObj)
                    ->with('collegeObj',$collegeObj);
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
            
            if( !empty(Input::get('message')) ){
                $messageText = Input::get('message');    
            }else{
                $messageText = '';
            }

            $collegeProfileId = Input::get('collegeprofile_id');

            $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($collegeProfileId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($collegeProfileId)
                                                );  
                                            })
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
            $application = Application::findOrFail($id);
            //$application->name = Input::get('name');
            $application->applicationstatus_id = Input::get('applicationstatus_id');
            $application->employee_id = Auth::id();
            //$application->users_id = Input::get('users_id');
           // $application->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
            $application->save();

            $getStudentEmailAddress = DB::table('application')
                            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                            ->leftJoin('users as u1','application.users_id','=','u1.id')
                            ->leftJoin('collegeprofile','application.collegeprofile_id','=', 'collegeprofile.id')
                            ->leftJoin('users as u2','u2.id','=','collegeprofile.users_id')
                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                            ->where('application.id','=', $id)
                            ->select('u1.email as studentEmail','u2.email as collegeEmail','application.applicationstatus_id','applicationstatus.name','application.collegemaster_id','u1.firstname as StudentFirstName','u1.middlename as studentMiddleName','u1.lastname as studentLastName','u2.firstname as collegeName','application.applicationID','u1.phone as studentPhone','u2.phone as collegePhone','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','application.byafees','application.created_at')
                            ->get()
                            ;

            $collegeMasterId = $getStudentEmailAddress[0]->collegemaster_id;

            $applicationstatusName = $getStudentEmailAddress[0]->name; 
            $applicationstatusId = $getStudentEmailAddress[0]->applicationstatus_id; 
            $studentEmailId = $getStudentEmailAddress[0]->studentEmail;
            $collegeEmailId = $getStudentEmailAddress[0]->collegeEmail;
            $studentName = $getStudentEmailAddress[0]->StudentFirstName.' '.$getStudentEmailAddress[0]->studentMiddleName.' '.$getStudentEmailAddress[0]->studentLastName;
            $collegeName = $getStudentEmailAddress[0]->collegeName;
            $applicationID = $getStudentEmailAddress[0]->applicationID;
            $studentPhoneNo = $getStudentEmailAddress[0]->studentPhone; 
            $collegePhoneNo = $getStudentEmailAddress[0]->collegePhone; 
            $studentNameSms = $getStudentEmailAddress[0]->StudentFirstName;
            $functionalareaName = $getStudentEmailAddress[0]->functionalareaName;
            $degreeName = $getStudentEmailAddress[0]->degreeName;
            $courseName = $getStudentEmailAddress[0]->courseName;
            $applicationFees = $getStudentEmailAddress[0]->byafees;
            $applydate = $getStudentEmailAddress[0]->created_at;

            $nextFifteenDateTime = new DateTime($applydate);
            $nextFifteenDateTime->modify('+15 day');
            $approvalDate = $nextFifteenDateTime->format('d-m-Y');

            /****** Get Admin Email Address ****/
            $getTheEmailAdmin = DB::table('users')->where('userrole_id', '=', '1')->where('users.userstatus_id','=', '1')->select('email')->get();
                //$adminEmailId = $getTheEmailAdmin[0]->email;
            
            /********** Update Application Remarks ********************/
            $applicationStatusMessageObj = New ApplicationStatusMessage();

            $applicationStatusMessageObj->application_id = $id;    
            $applicationStatusMessageObj->student_id = $application->users_id; 
            $applicationStatusMessageObj->college_id = $application->collegeprofile_id; 
            $applicationStatusMessageObj->admin_id = $userId;
            $applicationStatusMessageObj->message = $messageText;
            $applicationStatusMessageObj->others = 'Admin Remarks';
            $applicationStatusMessageObj->applicationStatus = $applicationstatusName;
            $applicationStatusMessageObj->employee_id = Auth::id();
            $applicationStatusMessageObj->save();

            /*************** Update College Course Seat Approved By College ******************/
            if( Input::get('applicationstatus_id') == '1') 
            { 
                $collegeCourseSeatUpdate = CollegeMaster::where('collegemaster.id','=', $collegeMasterId)->firstOrFail();

                $getSeatsAllocatedToBya = $collegeCourseSeatUpdate->seatsallocatedtobya;
                if(!empty($getSeatsAllocatedToBya != '0'))
                {
                    $totalRemainingSeat = $getSeatsAllocatedToBya - 1;
                    $collegeCourseSeatUpdate->seatsallocatedtobya = $totalRemainingSeat;

                }
                $collegeCourseSeatUpdate->employee_id = Auth::id();
                $collegeCourseSeatUpdate->save();
                
            }
            
            if( Input::get('applicationstatus_id') == '1') 
            {  
                try {
                    if(!empty($studentPhoneNo))
                    {   
                        $string = $collegeName;
                        $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 
                        $userMobileNo = $studentPhoneNo;  

                        //$smsMessageData = 'Hi '.$studentNameSms.', '.(str_limit($collegeNameStr, $limit = 28, $end = '')).' '.Config::get('systemsetting.APPLICATIONSTUDENTACCEPTED').' '.Config::get('systemsetting.SMS_GROUP_NAME_3');
                        // $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_STATUS_CHANGED'));

                        $smsMessageData = 'Dear '.$studentNameSms.', Your allotment letter has been mailed at your registered id, you are requested to report college within 15 days. For assistance call our Helpline '.Config::get('systemsetting.SMS_PHONE_NUMBER').' '.Config::get('systemsetting.SMS_GROUP_NAME_2');

                        /***Send SMS *******************************/
                        $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_STUDENT_ALLOTMENT_LETTER'));
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
            }

            if( Input::get('applicationstatus_id') == '3') 
            {  
                try {
                    if(!empty($studentPhoneNo))
                    {   
                        $string = $collegeName;
                        $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 
                        $userMobileNo = $studentPhoneNo;  

                        $smsMessageData = 'Hi '.$studentNameSms.', '.(str_limit($collegeNameStr, $limit = 30, $end = '')).' '.Config::get('systemsetting.APPLICATIONREJECT').' '.Config::get('systemsetting.SMS_GROUP_NAME_3');
                        //$smsMessageData = 'Hi '.$studentName.', '.$collegeName.' has rejected your application. Please login to your account to see further details and ask for refund. '.Config::get('systemsetting.SMS_GROUP_NAME_3');  

                        /***Send SMS *******************************/
                        $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_REJECTED'));
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
            }

            if( Input::get('applicationstatus_id') == '1') 
            {  
                try {
                    if(!empty($collegePhoneNo))
                    {   
                        $string = $collegeName;
                        $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                        $userMobileNo = $collegePhoneNo;  
                        // $smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 28, $end = '')).', you have accepted '.$studentNameSms.''.Config::get('systemsetting.APPLICATIONCOLLEGEACCEPTEDMSG').'. '.Config::get('systemsetting.SMS_GROUP_NAME_4');
                        // $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_ACCEPTED_TO_COLLEGE'));

                        $smsMessageData = 'Dear '.(str_limit($collegeNameStr, $limit = 28, $end = '')).', You have got admission, student will report you within 15 days. For assistance call our Helpline '.Config::get('systemsetting.SMS_PHONE_NUMBER').' '.Config::get('systemsetting.SMS_GROUP_NAME_2');      

                        /***Send SMS *******************************/
                        $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_COLLEGE_GOT_NEW_ADMISSION'));
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
                        ]);  */
                    } 
                }catch (\Exception $e) {
                    return $e;
                }
            }

            if( Input::get('applicationstatus_id') == '3') 
            {  
                try {
                    if(!empty($collegePhoneNo))
                    {   
                        $string = $collegeName;
                        $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                        $userMobileNo = $collegePhoneNo;  
                        $smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', you have rejected '.$studentNameSms.''.Config::get('systemsetting.APPLICATIONREJECTCOLLEGE').' '.Config::get('systemsetting.SMS_GROUP_NAME_4');   

                        /***Send SMS *******************************/
                        $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_REJECTED_TO_COLLEGE'));
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
            }

            try {
                if(!empty($studentEmailId) && ($this->fetchDataServiceController->isValidEmail($studentEmailI) == 1))
                {
                        /**Swift Mailer TO Student***/        
                        \Mail::send('administrator/application.email.student.emailTemplate', array('email' => $studentEmailId, 'messageData' => $messageText, 'applicationstatusName' => $applicationstatusName,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationID, 'studentPhoneNo' => $studentPhoneNo,'courseName' => $courseName, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName,'applicationFees' => $applicationFees,'approvalDate' => $approvalDate ), function($message) use ($studentEmailId)
                        {
                            $message->to($studentEmailId, 'AdmissionX')->subject('Remarks Admission Status');
                        });  
                } 
            }catch ( \Swift_TransportException $e) {                
            }

            try {
                if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
                {
                        /**Swift Mailer TO COLLEGE***/        
                        \Mail::send('administrator/application.email.college.emailTemplate', array('email' => $collegeEmailId, 'messageData' => $messageText, 'applicationstatusName' => $applicationstatusName,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationID, 'studentPhoneNo' => $studentPhoneNo,'courseName' => $courseName, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName,'applicationFees' => $applicationFees,'approvalDate' => $approvalDate, 'studentEmailId' => $studentEmailId ), function($message) use ($collegeEmailId)
                        {
                            $message->to($collegeEmailId, 'AdmissionX')->subject('Remarks Admission Status');
                        });  
                } 
            }catch ( \Swift_TransportException $e) {                
            }

            $adminEmailId = array();
            foreach ($getTheEmailAdmin as $key => $value) {
                $adminEmailId = $value->email;
                //$adminEmailId[] = $tempArrayEmailId;

                try {
                   
                    if(!empty($adminEmailId) && ($this->fetchDataServiceController->isValidEmail($adminEmailId) == 1))
                    {
                       /**Swift Mailer Data TO admin_id***/        
                        \Mail::send('administrator/application.email.cancelAdmission', array('email' => $adminEmailId, 'messageData' => $messageText,'applicationstatusName' => $applicationstatusName  ), function($message) use ($adminEmailId)
                        {
                            $message->to($adminEmailId, 'AdmissionX')->subject('Change Application Status For AdmissionX');
                        });  
                    }
                }catch ( \Swift_TransportException $e) {                
                }
            }
                
                


            Session::flash('flash_message', 'Application updated!');
            return redirect('administrator/application');
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
            Application::destroy($id);
            Session::flash('flash_message', 'Application deleted!');
            return redirect('administrator/application');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function applicationSearch(Request $request)
    {
        $search0 = 'application.id';
       
        if( $request->applicationStatus != null ){
            $search1 = "AND `applicationstatus`.`id` =  '".$request->applicationStatus."'" ;
        }else{
            $search1 =  '';
        }

        if( $request->applicationName != '' ){
            $search2 = "AND `application`.`name` =  '".$request->applicationName."'";
        }else{
            $search2 =  '';
        }

        if( $request->userName != null ){
            $search3 = " AND `studentUser`.`id` =  '".$request->userName."'";           
        }else{
            $search3 = '';
        }

        if( $request->collegeProfile != null ){
            $search4 = " AND `collegeUser`.`id` =  '".$request->collegeProfile."'";           
        }else{
            $search4 = '';
        }

        $createdDateFrom = $request->createdDateStart;
        $createdDateTo = $request->createdDateEnd;
       
        if( $createdDateFrom != '' && $createdDateTo == '' ){

            $createdDateStartArray = explode('/', $createdDateFrom);
            $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

            $applicationDate = "AND application.created_at >= '".$createdDateStart1."'";
        }elseif( $createdDateFrom == '' && $createdDateTo != '' ){

            $createdDateEndArray = explode('/', $createdDateTo);
            $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
            $applicationDate = "AND application.created_at <= '".$createdDateEnd1."'";
        }elseif($createdDateFrom != '' && $createdDateTo != '' ){

            $createdDateStartArray = explode('/', $createdDateFrom);
            $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

            $createdDateEndArray = explode('/', $createdDateTo);
            $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
            $applicationDate = "AND application.created_at BETWEEN '".$createdDateStart1."' AND '".$createdDateEnd1."'";
        }else{
            $applicationDate = '';
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
                
        $applicationSearchDataObj = DB::select( DB::raw("SELECT application.id as applicationId, application.name as applicationName, application.dob, application.email, application.phone, application.gender, applicationstatus.id as applicationstatusId, applicationstatus.name as applicationstatusName, studentUser.id as studentUserID, studentUser.firstname as studentUserFirstName, studentUser.lastName as studentUserLastName, studentUser.middlename as studentUserMiddleName, collegeprofile.id as collegeprofileID, collegeprofile.description as collegeprofileDescription,collegeUser.id as collegeUserID, collegeUser.firstname as collegeUserFirstName, collegemaster.id as collegemasterId, educationlevel.name as educationlevelName,functionalarea.name as functionalareaName, degree.name as degreeName, coursetype.name as coursetypeName,course.name as courseName, application.applicationID,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,application.updated_at, application.created_at FROM  `application`
                        LEFT JOIN `applicationstatus` ON `application`.`applicationstatus_id` = `applicationstatus`.`id`
                        LEFT JOIN `users` as `studentUser` ON `application`.`users_id` = `studentUser`.`id`
                        LEFT JOIN `collegeprofile` ON `application`.`collegeprofile_id` = `collegeprofile`.`id`
                        LEFT JOIN `users` as `collegeUser` ON `collegeprofile`.`users_id` = `collegeUser`.`id`
                        LEFT JOIN `collegemaster` ON `application`.`collegemaster_id` = `collegemaster`.`id`
                        LEFT JOIN `educationlevel` ON `collegemaster`.`educationlevel_id` = `educationlevel`.`id`
                        LEFT JOIN `functionalarea` ON `collegemaster`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `degree` ON `collegemaster`.`degree_id` = `degree`.`id`
                        LEFT JOIN `coursetype` ON `collegemaster`.`coursetype_id` = `coursetype`.`id`
                        LEFT JOIN `course` ON `collegemaster`.`course_id` = `course`.`id`
                        LEFT JOIN `users` as `eID` ON `application`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        $applicationDate
                        AND studentUser.userstatus_id != '5'
                        AND collegeUser.userstatus_id != '5'
                        ORDER BY application.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $applicationSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(application.id) as totalCount FROM  `application` 
                        LEFT JOIN `applicationstatus` ON `application`.`applicationstatus_id` = `applicationstatus`.`id`
                        LEFT JOIN `users` as `studentUser` ON `application`.`users_id` = `studentUser`.`id`
                        LEFT JOIN `collegeprofile` ON `application`.`collegeprofile_id` = `collegeprofile`.`id`
                        LEFT JOIN `users` as `collegeUser` ON `collegeprofile`.`users_id` = `collegeUser`.`id`
                        LEFT JOIN `collegemaster` ON `application`.`collegemaster_id` = `collegemaster`.`id`
                        LEFT JOIN `educationlevel` ON `collegemaster`.`educationlevel_id` = `educationlevel`.`id`
                        LEFT JOIN `functionalarea` ON `collegemaster`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `degree` ON `collegemaster`.`degree_id` = `degree`.`id`
                        LEFT JOIN `coursetype` ON `collegemaster`.`coursetype_id` = `coursetype`.`id`
                        LEFT JOIN `course` ON `collegemaster`.`course_id` = `course`.`id`
                        LEFT JOIN `users` as `eID` ON `application`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        $search4
                        $applicationDate
                        AND studentUser.userstatus_id != '5'
                        AND collegeUser.userstatus_id != '5'
                        ORDER BY application.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($applicationSearchDataObj1)){
            $numRecords = $applicationSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'applicationSearchDataObj' => $applicationSearchDataObj,
                    'applicationSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $applicationSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'applicationSearchDataObj' => $applicationSearchDataObj,
                    'applicationSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $applicationSearchDataObj1,
                );
        }

        if( !empty($applicationSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allApplicationSearch(Request $request){

        $application = Application::orderBy('application.id', 'DESC')
                        ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                        ->leftJoin('users as studentUser', 'application.users_id','=', 'studentUser.id')
                        ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                        ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                        ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                        ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                        ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                        ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                        ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                        ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                        ->leftJoin('users as eID','application.employee_id', '=','eID.id')
                        ->where('collegeUser.userstatus_id','!=','5')
                        ->where('studentUser.userstatus_id','!=','5')
                        ->select('application.id as applicationID', 'application.name as applicationName','application.dob', 'application.email', 'application.phone', 'gender','applicationstatus.id as applicationstatusId','applicationstatus.name as applicationstatusName', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastName as studentUserLastName', 'studentUser.middlename as studentUserMiddleName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','application.applicationID','application.lastPaymentAttemptDate','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','application.updated_at','application.created_at')
                        ->take(20)
                        ->get();
  
        return json_encode($application);
    }

    public function sendProvisionalLetter(Request $request , $id)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' )
        {
           $getStudentEmailAddress = DB::table('application')
                            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                            ->leftJoin('users as u1','application.users_id','=','u1.id')
                            ->leftJoin('collegeprofile','application.collegeprofile_id','=', 'collegeprofile.id')
                            ->leftJoin('users as u2','u2.id','=','collegeprofile.users_id')
                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                            ->where('application.id','=', $id)
                            ->select('u1.email as studentEmail','u2.email as collegeEmail','application.applicationstatus_id','applicationstatus.name','application.collegemaster_id','u1.firstname as StudentFirstName','u1.middlename as studentMiddleName','u1.lastname as studentLastName','u2.firstname as collegeName','application.applicationID','u1.phone as studentPhone','u2.phone as collegePhone','application.parentname','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','application.byafees')
                            ->get()
                            ;

                            //print_r($getStudentEmailAddress);die;
            $studentEmailId = $getStudentEmailAddress[0]->studentEmail;
            $collegeEmailId = $getStudentEmailAddress[0]->collegeEmail;
            $studentName = $getStudentEmailAddress[0]->StudentFirstName.' '.$getStudentEmailAddress[0]->studentMiddleName.' '.$getStudentEmailAddress[0]->studentLastName;
            $collegeName = $getStudentEmailAddress[0]->collegeName;
            $applicationID = $getStudentEmailAddress[0]->applicationID;
            $studentMobileNo = $getStudentEmailAddress[0]->studentPhone;
            $collegeMobileNo = $getStudentEmailAddress[0]->collegePhone;
            $studentNameSms = $getStudentEmailAddress[0]->StudentFirstName;
            $fatherName = $getStudentEmailAddress[0]->parentname;
            $courseName = $getStudentEmailAddress[0]->educationlevelName.' / '.$getStudentEmailAddress[0]->functionalareaName.' / '.$getStudentEmailAddress[0]->degreeName.' / '.$getStudentEmailAddress[0]->coursetypeName.' / '.$getStudentEmailAddress[0]->courseName;
            $byafees = $getStudentEmailAddress[0]->byafees;

            //Provisional letter valid date
            $currentDateTime = date("Y-m-d");
            $nextDateTime = new DateTime($currentDateTime);
            $nextDateTime->modify('+30 day');
            $nextMonthDate = $nextDateTime->format('d-m-Y'); 
            $validDate = $nextMonthDate;

            $htmlContent = View::make('administrator/application.email.provisionalletter.htmltopdfview')
                            ->with('applicationID', $applicationID)
                            ->with('studentName', $studentName)
                            ->with('fatherName', $fatherName)
                            ->with('studentEmailId', $studentEmailId)
                            ->with('studentMobileNo', $studentMobileNo)
                            ->with('courseName', $courseName)
                            ->with('byafees', $byafees)
                            ->with('collegeName', $collegeName)
                            ;

            $fileName = $applicationID;
            $filePath = public_path().'/provisional-letters/';

            \PDF::loadHTML($htmlContent)
            ->setPaper('a4')
            ->save($filePath.$fileName);


            //Send file path for provisional letter download link
           // $pathToFile = 'https://'.env('ipAddressForRedirect').'/assets/images/provisionalletter.pdf/';
            $pathToFile = env('APP_URL').'/provisional-letters/'.$applicationID;
            
            //Send provisional letter email for student
            try {
                if(!empty($studentEmailId) && ($this->fetchDataServiceController->isValidEmail($studentEmailId) == 1))
                {   
                    /**Swift Mailer TO Student***/    
                    \Mail::send('administrator/application.email.provisionalletter.studentEmailTemplate', array('email' => $studentEmailId,'studentName'=>$studentName,'applicationID'=>$applicationID,'validDate'=>$validDate,'filePath'=>$pathToFile ), function($message) use ($studentEmailId, $applicationID)
                    {
                        $message->to($studentEmailId, 'AdmissionX')->subject('Generate Provisional Letter');
                        $message->attach('https://admissionx.com/provisional-letters/'.$applicationID, array('as' => 'provisionaldemo','mime' => 'application/pdf'));
                        //$message->attach('https://admissionx.com/assets/images/provisionalletter.pdf', array('as' => 'provisionaldemo','mime' => 'application/pdf'));
                    });  
                } 
            }catch ( \Swift_TransportException $e) {                
            }

            //Send provisional letter email for college
            try {
                if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
                {
                        /**Swift Mailer TO COLLEGE***/        
                        \Mail::send('administrator/application.email.provisionalletter.collegeEmailTemplate', array('email' => $collegeEmailId,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationID,'filePath'=>$pathToFile ), function($message) use ($collegeEmailId, $applicationID)
                        {
                            $message->to($collegeEmailId, 'AdmissionX')->subject('Generate Provisional Letter');
                            $message->attach('https://admissionx.com/provisional-letters/'.$applicationID, array('as' => 'provisionaldemo','mime' => 'application/pdf'));
                            //$message->attach('https://admissionx.com/assets/images/provisionalletter.pdf', array('as' => 'provisionaldemo','mime' => 'application/pdf'));
                        });  
                } 
            }catch ( \Swift_TransportException $e) {                
            }

            /*$strValue = $collegeName;
            $removeDots = str_replace("."," ",$strValue);
            $removeSpecialChar = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($removeDots)); 
            $words = explode(" ", $removeSpecialChar);
            $acronym = "";
            foreach ($words as $w) {
              $acronym .= $w[0];
            }
            $shortForm = strtoupper($acronym);
            print_r($acronym);die;*/

            // Provisional letter sms send for college
             try {
                if(!empty($collegeMobileNo))
                {
                    $string = $collegeName;
                    $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                    $userMobileNo = $collegeMobileNo;  

                    //$smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 7, $end = '')).', '.Config::get('systemsetting.COLLEGEPROVISIONAL').' '.$studentNameSms.' & application id '.$applicationID.'.'.Config::get('systemsetting.COLLEGEPROVISIONALSEC').'.';  
         
                    $smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 7, $end = '')).',You have been emailed a copy of the provisional admission letter for '.$studentNameSms.' & application id '.$applicationID.'. Please read the enclosed T&C carefully. '.Config::get('systemsetting.SMS_GROUP_NAME_2');

                   //********Send SMS ******************************
                    $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_COPY_PROVISIONAL_ADMISSION_LETTER'));
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

            // Provisional letter sms send for student
            try {
                if(!empty($studentMobileNo))
                {
                    $string = $collegeName;
                    $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                    $userMobileNo = $studentMobileNo;  
                    $smsMessageData = 'Hi '.$studentNameSms.', '.Config::get('systemsetting.STUDENTPROVISIONAL').' '.$applicationID.'. '.Config::get('systemsetting.STUDENTPROVISIONALSEC').' '.$validDate.'. '.Config::get('systemsetting.SMS_GROUP_NAME_3');

                   // $smsMessageData = 'Hi '.$studentNameSms.', you have been emailed the provisional admission letter for application id '.$applicationId.' Please read the enclosed T&C carefully. This letter is valid until 2016-08-31'; 

                    //*****************Send SMS ******************************
                    $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_PROVISIONAL_LETTER_TO_STUDENT'));
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

            Session::flash('sendProvisionalLetterMsg', 'Provisional letter send Succesfully!');
            return Redirect::Back();
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function provisionalLetter(Request $request)
    {
        /*$id = '50';

        $getApplicationTableData = DB::table('application')
                            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                            ->leftJoin('users as u1','application.users_id','=','u1.id')
                            ->leftJoin('collegeprofile','application.collegeprofile_id','=', 'collegeprofile.id')
                            ->leftJoin('users as u2','u2.id','=','collegeprofile.users_id')
                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                            ->where('application.id','=', $id)
                            ->select('u1.email as studentEmail','u2.email as collegeEmail','application.applicationstatus_id','applicationstatus.name','application.collegemaster_id','u1.firstname as StudentFirstName','u1.middlename as studentMiddleName','u1.lastname as studentLastName','u2.firstname as collegeName','application.applicationID','u1.phone as studentPhone','u2.phone as collegePhone','application.parentname','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','application.byafees')
                            ->get()
                            ;

                        //print_r($getApplicationTableData);die;
        $studentEmailId = $getApplicationTableData[0]->studentEmail;
        $collegeEmailId = $getApplicationTableData[0]->collegeEmail;
        $studentName = $getApplicationTableData[0]->StudentFirstName.' '.$getApplicationTableData[0]->studentMiddleName.' '.$getApplicationTableData[0]->studentLastName;
        $collegeName = $getApplicationTableData[0]->collegeName;
        $applicationID = $getApplicationTableData[0]->applicationID;
        $studentMobileNo = $getApplicationTableData[0]->studentPhone;
        $collegeMobileNo = $getApplicationTableData[0]->collegePhone;
        $studentNameSms = $getApplicationTableData[0]->StudentFirstName;
        $fatherName = $getApplicationTableData[0]->parentname;
        $courseName = $getApplicationTableData[0]->educationlevelName.' / '.$getApplicationTableData[0]->functionalareaName.' / '.$getApplicationTableData[0]->degreeName.' / '.$getApplicationTableData[0]->coursetypeName.' / '.$getApplicationTableData[0]->courseName;
        $byafees = $getApplicationTableData[0]->byafees;

        $data['documentHeading'] = 'This is a PDF file';
        $data['documentContent'] = 'I hope that you find it valuable!';
        $htmlContent = View::make('administrator/application.email.provisionalletter.htmltopdfview')
                            ->with('applicationID', $applicationID)
                            ->with('studentName', $studentName)
                            ->with('fatherName', $fatherName)
                            ->with('studentEmailId', $studentEmailId)
                            ->with('studentMobileNo', $studentMobileNo)
                            ->with('courseName', $courseName)
                            ->with('byafees', $byafees)
                            ->with('data',$data);

        $fileName = $applicationID;
        $filePath = public_path().'/provisional-letters/';

        \PDF::loadHTML($htmlContent)
        ->setPaper('a4')
        ->save($filePath.$fileName);

            //Provisional letter valid date
            $currentDateTime = date("Y-m-d");
            $nextDateTime = new DateTime($currentDateTime);
            $nextDateTime->modify('+30 day');
            $nextMonthDate = $nextDateTime->format('d-m-Y'); 
            $validDate = $nextMonthDate;

            //Send file path for provisional letter download link
            $pathToFile = env('APP_URL').'/provisional-letters/'.$applicationID;
           // print_r($pathToFile);die;
            
            //Send provisional letter email for student
            try {
                if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
                {
                        //Swift Mailer TO COLLEGE        
                        \Mail::send('administrator/application.email.provisionalletter.collegeEmailTemplate', array('email' => $collegeEmailId,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationID,'filePath'=>$pathToFile ), function($message) use ($collegeEmailId, $applicationID)
                        {
                            $message->to($collegeEmailId, 'AdmissionX')->subject('Generate Provisional Letter');
                            $message->attach('https://admissionx.com/provisional-letters/'.$applicationID, array('as' => 'provisionaldemo','mime' => 'application/pdf'));
                        });  
                } 
            }catch ( \Swift_TransportException $e) {                
            }

        return redirect::back();*/

        //View PDF Page
       /* return PDF::loadFile(public_path().'/provisionalLetterDemo.html')
                ->save(public_path().'/provisional_letter_store.pdf')
                ->setPaper('a4', 'landscape')->setWarnings(false)
                ->stream('download.pdf');*/

        //return PDF::loadFile(public_path().'/myfile.html')->save(public_path().'/provisional_letter_store.pdf')->stream('download.pdf');

        //View Provisional Blade Page
        /*return view('administrator/application.email.provisionalletter.htmltopdfview')
        ->with('applicationID', $applicationID)
        ->with('studentName', $studentName)
        ->with('fatherName', $fatherName)
        ->with('studentEmailId', $studentEmailId)
        ->with('studentMobileNo', $studentMobileNo)
        ->with('courseName', $courseName)
        ->with('byafees', $byafees)
        ;*/
    }

}
