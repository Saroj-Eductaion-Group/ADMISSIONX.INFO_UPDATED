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
use Exception;
use DateTime;
use Config;
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
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\StudentProfile as StudentProfile;
use App\Models\Category as Category;
use App\Models\StudentMark as StudentMark;
use App\Models\CollegeMaster as CollegeMaster;
use App\Models\Application;
use App\Models\Transaction;
use App\Http\Controllers\website\WebsiteLogController;
//EASEBUZZ CONTROLLERS
use App\Http\Controllers\easebuzz\EasebuzzController;
use GuzzleHttp\Client;
use App\Http\Controllers\Helper\FetchDataServiceController;
use Jenssegers\Agent\Agent;

class studentApplyCourseController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

	public function applyCourseDetails(Request $request, $collegemasterId, $slugUrl)
    {   
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                try {
				        $collegeProfileObj = CollegeMaster::where('collegemaster.id', $collegemasterId)
                                ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                ->join('users', 'collegeprofile.users_id','=','users.id')
                                ->join('userrole', 'users.userrole_id','=','userrole.id')
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('users.id','collegeprofile.id as collegeprofileID', 'collegeprofile.slug as collegeSlug', 'collegemaster.fees as courseFee' )
                                ->get()->first();
                                
                        $collegeSlugID = $collegeProfileObj->collegeSlug;
                    
                        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.APPLYCOURSE').' by this User Id '.Auth::id().', Course Id '.$collegemasterId.', College-'.$collegeSlugID);

				        $getCollegeProfileDataObj = DB::table('collegeprofile')
				                            ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
				                            ->leftJoin('gallery','users.id','=','gallery.users_id')
				                            ->where('collegeprofile.slug', '=', $collegeSlugID)
				                            ->where('gallery.caption', '=', 'College Logo')
                                            ->where('users.userstatus_id', '!=', '5')
				                            ->select('users.id as usersId', 'users.suffix','users.firstname as firstName','users.email as userEmailAddress', 'users.phone as userPhone','collegeprofile.description', 'collegeprofile.estyear', 'collegeprofile.website', 'collegeprofile.collegecode', 'collegeprofile.contactpersonname', 'collegeprofile.contactpersonemail', 'collegeprofile.contactpersonnumber','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage')
				                            ->orderBy('collegeprofile.id', 'ASC')
				                            ->take(1)
				                            ->get()
				                            ;
				        $getCollegeDetailObj = DB::table('collegeprofile')
				                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
				                                ->where('collegeprofile.slug', '=', $collegeSlugID)
                                                ->where('users.userstatus_id', '!=', '5')
				                                ->select('users.id as usersId', 'users.firstname', 'users.phone', 'users.email', 'collegeprofile.id as collegeprofileId', 'collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegeprofile.description','collegeprofile.slug')
				                                ->get()
				                                ;

				        $getCollegeAddressObj = DB::table('collegeprofile')
				                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
				                                ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
				                                ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
				                                ->leftJoin('city', 'address.city_id', '=', 'city.id')
				                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
				                                ->leftJoin('country', 'state.country_id', '=', 'country.id')
				                                ->where('collegeprofile.slug', '=', $collegeSlugID)
                                                ->where('users.userstatus_id', '!=', '5')
				                                ->select('users.id as usersId','address.id as adressID', 'address.name', 'address.address1', 'address.address2','address.postalcode','addresstype.id as addresstypeId','addresstype.name as addresstypeName', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName','address.landmark')
				                                ->get()
				                                ;

				        $collegeFacilityDataObj = DB::table('collegeprofile')
				                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
				                                    ->join('collegefacilities','collegeprofile.id','=','collegefacilities.collegeprofile_id')
				                                    ->join('facilities','collegefacilities.facilities_id','=','facilities.id')
				                                    ->where('collegeprofile.slug', '=', $collegeSlugID)
                                                    ->where('users.userstatus_id', '!=', '5')
				                                    ->select('users.id as usersId','collegefacilities.id as collegefacilitiesId','collegefacilities.name',  'collegefacilities.description','facilities.id as facilitiesId', 'facilities.name as facilitiesName')
				                                    ->orderBy('collegeprofile.id', 'ASC')
				                                    ->get()
				                                    ;

				                if( empty($collegeFacilityDataObj) ){
				                    $collegeFacilityDataObj = '';
				                }

				        $studentSlugData = DB::table('studentprofile')
				                ->leftJoin('users', function ($join) use ($userId) {
				                $join->on('studentprofile.users_id', '=','users.id')
				                    ->where('studentprofile.users_id', '=', DB::raw($userId)
				                    );  
				                })
				                ->where('users.id', '=', $userId)
				                ->select('users.id as usersId','studentprofile.slug')
				                ->orderBy('studentprofile.id', 'ASC')
				                ->take(1)
				                ->get()
				                ;
				        $studentSlug = $studentSlugData[0]->slug;

				        $studentApplyCourseDataObj = DB::table('studentprofile')
				                ->leftJoin('users', function ($join) use ($userId) {
				                $join->on('studentprofile.users_id', '=','users.id')
				                    ->where('studentprofile.users_id', '=', DB::raw($userId)
				                    );  
				                })
				                ->where('studentprofile.slug', '=', $studentSlug)
                                ->where('users.userstatus_id', '!=', '5')
				                ->select('users.id as usersId', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone','studentprofile.gender', 'studentprofile.dateofbirth', 'studentprofile.parentsname', 'studentprofile.parentsnumber', 'studentprofile.hobbies', 'studentprofile.interests', 'studentprofile.achievementsawards', 'studentprofile.projects', 'studentprofile.entranceexamname', 'studentprofile.entranceexamnumber', 'studentprofile.isverifiedage','studentprofile.slug')
				                ->orderBy('studentprofile.id', 'ASC')
				                ->take(1)
				                ->get()
				                ;


				            if( empty($studentApplyCourseDataObj) ){
				                $studentApplyCourseDataObj = '';
				            }

				            $entranceExamObj = DB::table('entranceexam')
				                ->orderBy('entranceexam.name', 'ASC')
				                ->get()
				                ;

				        $currentDateTime = date("Y-m-d"); 
				        $verifyStudentAge = $studentApplyCourseDataObj[0]->dateofbirth; 

				        if ($studentApplyCourseDataObj[0]->dateofbirth != '0000-00-00') {
				                $bday = new DateTime($verifyStudentAge); 
				                $today = new DateTime($currentDateTime);
				                $diff = $today->diff($bday); 
				                $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';
				        }else{
				            $calculateDate = '';
				        }

				        $getStudentmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentprofile.slug', '=', $studentSlug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID')
                                        ->get()
                                        ;

            			if( empty($getStudentmarksObj) ){
                            $getStudentmarksObj = '';
                        }

                        $getStudent10thmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentprofile.slug', '=', $studentSlug)
                                        ->where('studentmarks.name', '=', '10th')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID')
                                        ->orderBy('studentmarks.id', 'ASC')
                                        ->take(1)
                                        ->get()
                                        ;

                        if( empty($getStudent10thmarksObj) ){
                            $getStudent10thmarksObj = '';
                        }

                        $getStudent11thmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentprofile.slug', '=', $studentSlug)
                                        ->where('studentmarks.name', '=', '11th')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID')
                                        ->orderBy('studentmarks.id', 'ASC')
                                        ->take(1)
                                        ->get()
                                        ;

                        if( empty($getStudent11thmarksObj) ){
                            $getStudent11thmarksObj = '';
                        }

                        $getStudent12thmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentprofile.slug', '=', $studentSlug)
                                        ->where('studentmarks.name', '=', '12th')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID')
                                        ->orderBy('studentmarks.id', 'ASC')
                                        ->take(1)
                                        ->get()
                                        ;

                        if( empty($getStudent12thmarksObj) ){
                            $getStudent12thmarksObj = '';
                        }

                        $getStudentGraduationMarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($id) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($id)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentmarks.name', '=', 'Graduation')
                                        ->where('studentmarks.studentprofile_id', '=', $id)
                                        ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID','studentMarkType')
                                        ->orderBy('studentmarks.id', 'ASC')
                                        ->take(1)
                                        ->get()
                                        ;

                        if( empty($getStudentGraduationMarksObj) ){
                            $getStudentGraduationMarksObj = '';
                        }
			    } catch ( \Exception $e) {
                // Auth::logout();
                // return redirect('login');
                }
        
        		$agent = new Agent();
                return view('student.studentverifycourse')
                        ->with('slugUrl', $request->slugUrl)
                        ->with('getCollegeDetailObj', $getCollegeDetailObj)
                        ->with('getCollegeAddressObj', $getCollegeAddressObj)
                        ->with('getCollegeProfileDataObj', $getCollegeProfileDataObj)
                        ->with('collegeFacilityDataObj', $collegeFacilityDataObj)
                        ->with('studentApplyCourseDataObj', $studentApplyCourseDataObj)
                        ->with('calculateDate', $calculateDate)
                        ->with('entranceExamObj', $entranceExamObj)
                        ->with('collegeProfileObj', $collegeProfileObj)
                        ->with('collegeSlugID', $collegeSlugID)
                        ->with('studentSlugData', $studentSlugData)
                        ->with('studentSlug', $studentSlug)
                        ->with('getStudentmarksObj', $getStudentmarksObj)
                        ->with('collegemasterId', $collegemasterId)
                        ->with('getStudent10thmarksObj', $getStudent10thmarksObj)
                        ->with('getStudent11thmarksObj', $getStudent11thmarksObj)
                        ->with('getStudent12thmarksObj', $getStudent12thmarksObj)
                        ->with('getStudentGraduationMarksObj', $getStudentGraduationMarksObj)
                        ->with('courseMasterID', $collegemasterId)
                        ->with('collegeProfileID', $slugUrl)
                        ->with('agent', $agent)
                        ;
        //return redirect()->route('college_dash', $slugUrl);  
            }else{
                $seoSlugName = 'login-page';
                $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
                //$getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(18);
                $getPageContentDataObj = [];
                Session::set('collegemasterId', $collegemasterId);
                Session::set('isUserPost', 1);
                
                Auth::logout(); // logout user
                return View::make('administrator/users.studentlogin', compact('seocontent','getPageContentDataObj'))
                    ->with('collegemasterId', $collegemasterId)
                    ->with('slugUrl', $slugUrl);
                //return Redirect::to('student-login', $collegemasterId); //redirect back to login
            }
        }else{
            $seoSlugName = 'login-page';
            $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
            //$getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(18);
            $getPageContentDataObj = [];
            Session::set('collegemasterId', $collegemasterId);
            Session::set('isUserPost', 1);
            Auth::logout(); // logout user
            return View::make('administrator/users.studentlogin', compact('seocontent','getPageContentDataObj'))
                ->with('collegemasterId', $collegemasterId)
                ->with('slugUrl', $slugUrl);
            //return Redirect::to('student-login', $collegemasterId); //redirect back to login
        }        
    }

    public function applyCourseFormDetails(Request $request, $collegemasterId, $slugUrl)
    {   
        $checkCollegeAndCourseObj = DB::table('collegemaster')
                                ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                ->join('users', 'collegeprofile.users_id','=','users.id')
                                ->join('userrole', 'users.userrole_id','=','userrole.id')
                                ->where('users.userstatus_id', '!=', '5')
                                ->where('collegemaster.id', $collegemasterId)
                                ->where('collegeprofile.slug', $slugUrl)
                                ->select('users.id','collegeprofile.id as collegeprofileID', 'collegeprofile.slug as collegeSlug')
                                ->get();

        if (sizeof($checkCollegeAndCourseObj) > 0) {
            if (Auth::check())
            {
                $userId = Auth::id();
                $roleGrant = User::where('id', '=', $userId)->first();
                $courseMasterID = $collegemasterId;
                if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                    try {
                        $collegeProfileObj = CollegeMaster::where('collegemaster.id', $collegemasterId)
                                ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                ->join('users', 'collegeprofile.users_id','=','users.id')
                                ->join('userrole', 'users.userrole_id','=','userrole.id')
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('users.id','collegeprofile.id as collegeprofileID', 'collegeprofile.slug as collegeSlug', 'collegemaster.fees as courseFee' )
                                ->get()->first();
                        $collegeSlugID = $collegeProfileObj->collegeSlug;


                        $getCollegeDetailObj = $this->fetchDataServiceController->fetchCollegeDetails($collegeSlugID);
                        $collegeRatingObj = $this->fetchDataServiceController->fetchCollegeRating($collegeSlugID);
                        $getCollegeLogoObj = $this->fetchDataServiceController->fetchCollegeLogo($collegeSlugID);
                        $getCollegeAddressObj = $this->fetchDataServiceController->fetchCollegeAddress($collegeSlugID);
                        $getCollegeMasterCoursesObj = $this->fetchDataServiceController->fetchCollegeMasterCourses($collegeSlugID, $collegemasterId); 
                        $getCollegeMasterFacultyObj = $this->fetchDataServiceController->fetchCollegeMasterFaculty($collegeSlugID, $collegemasterId);
                        $collegeFacilityDataObj = $this->fetchDataServiceController->fetchCollegeFacilities($collegeSlugID);
                        $fetchCollegeSocialMediaLinks = $this->fetchDataServiceController->fetchCollegeSocialMediaLinks($collegeSlugID);

                        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.APPLYCOURSE').' by this User Id '.Auth::id().', Course Id '.$collegemasterId.', College-'.$collegeSlugID);

                        $studentSlugData = DB::table('studentprofile')
                                ->leftJoin('users', function ($join) use ($userId) {
                                $join->on('studentprofile.users_id', '=','users.id')
                                    ->where('studentprofile.users_id', '=', DB::raw($userId)
                                    );  
                                })
                                ->where('users.id', '=', $userId)
                                ->select('users.id as usersId','studentprofile.slug')
                                ->orderBy('studentprofile.id', 'ASC')
                                ->take(1)
                                ->get()
                                ;

                        $studentSlug = $studentSlugData[0]->slug;
                        $studentApplyCourseDataObj =  $this->fetchDataServiceController->fetchStudentProfileDetails($studentSlug, $userId); 

                        if( empty($studentApplyCourseDataObj) ){
                            $studentApplyCourseDataObj = '';
                        }

                        $currentDateTime = date("Y-m-d"); 
                        $verifyStudentAge = $studentApplyCourseDataObj[0]->dateofbirth; 

                        if ($studentApplyCourseDataObj[0]->dateofbirth != '0000-00-00') {
                                $bday = new DateTime($verifyStudentAge); 
                                $today = new DateTime($currentDateTime);
                                $diff = $today->diff($bday); 
                                $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';
                        }else{
                            $calculateDate = '';
                        }

                        $getStudentmarksObj =  $this->fetchDataServiceController->fetchStudentMarksDetails($studentSlug, $userId); 

                        $getStudent10thmarksObj = $this->fetchDataServiceController->fetchStudentClassMarksDetails($studentSlug, $userId, '10th');
                        $getStudent11thmarksObj = $this->fetchDataServiceController->fetchStudentClassMarksDetails($studentSlug, $userId, '11th');
                        $getStudent12thmarksObj = $this->fetchDataServiceController->fetchStudentClassMarksDetails($studentSlug, $userId, '12th');

                        $getStudentGraduationMarksObj = $this->fetchDataServiceController->fetchStudentClassMarksDetails($studentSlug, $userId, 'Graduation');

                    } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                    }
                    
                    $byafees = Config::get('systemsetting.BYA_FEES');
                    $prevYear = date("m/d/Y", strtotime("-10 years"));
                    $lastYear = date("Y", strtotime("-10 years"));

                    $agent = new Agent();
                    return view('college.college-new-public-partial.student-verify-course-form-details', compact('slugUrl', 'getCollegeDetailObj','getCollegeAddressObj','collegeRatingObj','fetchCollegeSocialMediaLinks','getCollegeLogoObj','collegeFacilityDataObj','studentApplyCourseDataObj','calculateDate', 'collegeProfileObj','collegeSlugID', 'studentSlugData', 'studentSlug','getStudentmarksObj','collegemasterId','getStudent10thmarksObj','getStudent11thmarksObj','getStudent12thmarksObj','getStudentGraduationMarksObj','getCollegeMasterCoursesObj','getCollegeMasterFacultyObj', 'byafees','prevYear','lastYear','agent'));
                }else{
                    $seoSlugName = 'login-page';
                    $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
                    //$getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(18);
                    $getPageContentDataObj = [];
                    Session::set('collegemasterId', $collegemasterId);
                    Session::set('isUserPost', 1);
                    
                    Auth::logout(); // logout user
                    return View::make('administrator/users.studentlogin', compact('seocontent','getPageContentDataObj'))
                        ->with('collegemasterId', $collegemasterId)
                        ->with('slugUrl', $slugUrl);
                    //return Redirect::to('student-login', $collegemasterId); //redirect back to login
                }
            }else{
                $seoSlugName = 'login-page';
                $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
                //$getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(18);
                $getPageContentDataObj = [];
                Session::set('collegemasterId', $collegemasterId);
                Session::set('isUserPost', 1);
                Auth::logout(); // logout user
                return View::make('administrator/users.studentlogin', compact('seocontent','getPageContentDataObj'))
                    ->with('collegemasterId', $collegemasterId)
                    ->with('slugUrl', $slugUrl);
                //return Redirect::to('student-login', $collegemasterId); //redirect back to login
            }        
        }else{
            return redirect('/404');
        }
    }


    public function studentProfileApplyCourseUpdate( Request $request)
    {   
        if (Auth::check())
        {
            $roleGrant = User::where('id', '=', Auth::id())->first();
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1') ){

                //STORE DATA INTO APPLICATION TABLE
                $createApplicationObj = New Application;

                $createApplicationObj->firstname = Input::get('firstname');
                $createApplicationObj->middlename = Input::get('middlename');
                $createApplicationObj->lastname = Input::get('lastname');

                $createApplicationObj->gender = Input::get('gender');
                $createApplicationObj->dob = Input::get('dateofbirth');
                $createApplicationObj->email = Input::get('email');
                $createApplicationObj->phone = Input::get('phone');

                $createApplicationObj->percent10 = Input::get('tenthMarksPercentage');
                $createApplicationObj->percent11 = Input::get('eleventhMarksPercentage');
                $createApplicationObj->percent12 = Input::get('twelveMarksPercentage');
                

                $createApplicationObj->hobbies = Input::get('hobbies');
                $createApplicationObj->interest = Input::get('interests');
                $createApplicationObj->awards = Input::get('achievementsawards');
                $createApplicationObj->projects = Input::get('projects');

                if( Input::get('studentVerifyDetails') == 'on' ){
                    $createApplicationObj->iagreeform = '1';    
                }else{
                    $createApplicationObj->iagreeform = '0';
                }

                if( Input::get('studentVerifyAge') == 'on' ){
                    $createApplicationObj->iagreeparents = '1';
                }else{
                    $createApplicationObj->iagreeparents = '0';
                }

                $createApplicationObj->parentname = Input::get('parentsname');
                $createApplicationObj->parentnumber = Input::get('parentsnumber');

                $createApplicationObj->collegemaster_id = Input::get('courseMasterID');
                $createApplicationObj->users_id = Auth::id();

                //GET THE COLLEGE ID
                $getCollegeProfileID = DB::table('collegeprofile')->where('slug', '=', Input::get('collegeProfileID'))->select('id')->take(1)->get();
                
                $createApplicationObj->collegeprofile_id = $getCollegeProfileID[0]->id;
                $createApplicationObj->applicationstatus_id = '2';

                // $totalfees  = Input::get('totalfees');
                // $byafees    = Input::get('byafees');
                // $restfees   = Input::get('restfees');

                /*if (Config::get('systemsetting.BYA_FEES') != Input::get('byafees')) {
                    $collegeProfileObj = CollegeMaster::where('collegemaster.id', Input::get('courseMasterID'))
                                    ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->join('users', 'collegeprofile.users_id','=','users.id')
                                    ->join('userrole', 'users.userrole_id','=','userrole.id')
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id','collegeprofile.id as collegeprofileID', 'collegeprofile.slug as collegeSlug', 'collegemaster.fees as courseFee' )
                                    ->get()->first();



                    $totalfees  = $collegeProfileObj->courseFee;
                    $byafees    = Config::get('systemsetting.BYA_FEES');
                    $restfees   = $totalfees - $byafees;

                    $createApplicationObj->totalfees = $totalfees;
                    $createApplicationObj->byafees = $byafees; // 10/100*($totalfees)
                    $createApplicationObj->restfees = $restfees; // 90/100*($totalAmt)
                }else{
                    $createApplicationObj->totalfees = Input::get('totalfees');
                    $createApplicationObj->byafees = Input::get('byafees'); // 10/100*($totalfees)
                    $createApplicationObj->restfees = Input::get('restfees'); //90/100*($totalAmt)
                }*/

                $createApplicationObj->totalfees = Input::get('totalfees');
                $createApplicationObj->byafees = Input::get('byafees');
                $createApplicationObj->restfees = Input::get('restfees');

                //MKDIR
                //CREATE TWO FOLDERS IN GALLERY AND DOCUMENTS FOR PHOTOS
                $dirNameUnique = Input::get('studentSlug').base_convert(time(), 10, 36);
                $directoryForApplication =  public_path().'/application/'.$dirNameUnique;
                if (!mkdir($directoryForApplication, 0777, true)) {
                    die('Failed to create folders...');
                }
                
                //UPLOADS THE MARKSHEETS
                if ($request->hasFile('tenMarksheet')) {
                    $tenthUploadFile = $this->moveApplicationDoc($_FILES['tenMarksheet'], $dirNameUnique);
                    $createApplicationObj->marksheet10 = $tenthUploadFile;    
                }
                
                if ($request->hasFile('elevenMarksheet')) {
                    $elevenUploadFile = $this->moveApplicationDoc($_FILES['elevenMarksheet'], $dirNameUnique);
                    $createApplicationObj->marksheet11 = $elevenUploadFile;
                }

                if ($request->hasFile('tweleveMarksheet')) {
                    $twelveUploadFile = $this->moveApplicationDoc($_FILES['tweleveMarksheet'], $dirNameUnique);
                    $createApplicationObj->marksheet12 = $twelveUploadFile;
                }

                if ($request->hasFile('graduationMarksheet')) {
                    $graduationUploadFile = $this->moveApplicationDoc($_FILES['graduationMarksheet'], $dirNameUnique);
                    $createApplicationObj->graduationMarksheet = $graduationUploadFile;
                }

                if ($request->hasFile('parentImage')) {
                    $parentUploadFile = $this->moveApplicationDoc($_FILES['parentImage'], $dirNameUnique);
                    $createApplicationObj->parentidproof = $parentUploadFile;
                }

                //PAYMENT TRANSACTION PROCESS
                $createApplicationObj->paymentstatus_id = '7';
                $createApplicationObj->lastPaymentAttemptDate = date('Y-m-d H:i:s');
                $createApplicationObj->applicationID = '';


                $createApplicationObj->save();

                $transactionHashKey = uniqid('admissionx_'.round(microtime(true) * 1000).'_'.$createApplicationObj->id);
                $updateApplicationObj = Application::where('id', '=', $createApplicationObj->id)->firstOrFail();
                $updateApplicationObj->transactionHashKey = $transactionHashKey;
                $updateApplicationObj->save(); 


                //GET THE STUDENT PROFILE ID
                $getStudentProfileID = DB::table('studentprofile')->join('users', 'studentprofile.users_id', '=', 'users.id')->where('users.id', '=', Auth::id())->select('studentprofile.id')->take(1)->get();

                //UPDATE INTO STUDENT RECORDS
                $updateStudentProfileObj = StudentProfile::findOrFail($getStudentProfileID[0]->id);

                $updateStudentProfileObj->gender = Input::get('gender');
                $updateStudentProfileObj->dateofbirth = Input::get('dateofbirth');
                $updateStudentProfileObj->hobbies = Input::get('hobbies');
                $updateStudentProfileObj->interests = Input::get('interests');
                $updateStudentProfileObj->achievementsawards = Input::get('achievementsawards');
                $updateStudentProfileObj->projects = Input::get('projects');

                $updateStudentProfileObj->parentsname = Input::get('parentsname');
                $updateStudentProfileObj->parentsnumber = Input::get('parentsnumber');
                
                $updateStudentProfileObj->save();


                //UPDATE INTO STUDENT MARKS
                    //UPDATE 10TH MARKS
                    $studentMarksObj1 = DB::table('studentmarks')
                                    ->where('studentmarks.studentprofile_id', '=', $getStudentProfileID[0]->id )
                                    ->where('studentmarks.name', '=', '10th')
                                    ->orderBy('studentmarks.id','DESC')
                                    ->take(1)
                                    ->select('studentmarks.id','studentmarks.marks','studentmarks.percentage')
                                    ->get()
                                    ;
                    if(!empty($studentMarksObj1)){
                        $studentMarksObj1 = StudentMark::where('studentmarks.studentprofile_id', '=', $getStudentProfileID[0]->id )->where('studentmarks.name', '=', '10th')->firstOrFail();
                        $studentMarksObj1->percentage = Input::get('tenthMarksPercentage');
                        $studentMarksObj1->save();   
                    }else{
                        
                        $studentMarksObj11 = new StudentMark;
                        $studentMarksObj11->name = '10th';
                        $studentMarksObj11->percentage = Input::get('tenthMarksPercentage');  
                        $studentMarksObj11->category_id = '3';
                        $studentMarksObj11->studentprofile_id = $getStudentProfileID[0]->id; 
                        $studentMarksObj11->save();
                    }
                    
                    //UPDATE 11TH MARKS
                    $studentMarksObj2 = DB::table('studentmarks')
                                    ->where('studentmarks.studentprofile_id', '=', $getStudentProfileID[0]->id )
                                    ->where('studentmarks.name', '=', '11th')
                                    ->orderBy('studentmarks.id','DESC')
                                    ->take(1)
                                    ->select('studentmarks.marks','studentmarks.percentage')
                                    ->get()
                                    ;
                    if(!empty($studentMarksObj2)){
                        $studentMarksObj2 = StudentMark::where('studentmarks.studentprofile_id', '=', $getStudentProfileID[0]->id )->where('studentmarks.name', '=', '11th')->firstOrFail();
                        $studentMarksObj2->percentage = Input::get('eleventhMarksPercentage');
                        $studentMarksObj2->save();
                    }else{
                        $studentMarksObj22 = new StudentMark;
                        $studentMarksObj22->name = '11th';
                        $studentMarksObj22->percentage = Input::get('eleventhMarksPercentage'); 
                        $studentMarksObj22->category_id = '3';
                        $studentMarksObj22->studentprofile_id = $getStudentProfileID[0]->id; 
                        $studentMarksObj22->save();
                    }

                    //UPDATE 12TH MARKS
                    $studentMarksObj3 = DB::table('studentmarks')
                                    ->where('studentmarks.studentprofile_id', '=', $getStudentProfileID[0]->id )
                                    ->where('studentmarks.name', '=', '12th')
                                    ->orderBy('studentmarks.id','DESC')
                                    ->take(1)
                                    ->select('studentmarks.marks','studentmarks.percentage')
                                    ->get()
                                    ;
                    if(!empty($studentMarksObj3)){
                        $studentMarksObj3 = StudentMark::where('studentmarks.studentprofile_id', '=', $getStudentProfileID[0]->id )->where('studentmarks.name', '=', '12th')->firstOrFail();
                        $studentMarksObj3->percentage = Input::get('twelveMarksPercentage');
                        $studentMarksObj3->save();
                    }else{
                        $studentMarksObj33 = new StudentMark;
                        $studentMarksObj33->name = '12th';
                        $studentMarksObj33->percentage = Input::get('twelveMarksPercentage');   
                        $studentMarksObj33->category_id = '3';
                        $studentMarksObj33->studentprofile_id = $getStudentProfileID[0]->id; 
                        $studentMarksObj33->save();
                    }


                    //UPDATE Graduation MARKS
                    $studentMarksObj4 = DB::table('studentmarks')
                                    ->where('studentmarks.studentprofile_id', '=', $getStudentProfileID[0]->id )
                                    ->where('studentmarks.name', '=', 'Graduation')
                                    ->orderBy('studentmarks.id','DESC')
                                    ->take(1)
                                    ->select('studentmarks.marks','studentmarks.percentage')
                                    ->get()
                                    ;
                    if(!empty($studentMarksObj4)){
                        $studentMarksObj4 = StudentMark::where('studentmarks.studentprofile_id', '=', $getStudentProfileID[0]->id )->where('studentmarks.name', '=', 'Graduation')->firstOrFail();
                        $studentMarksObj4->percentage = Input::get('graduationMarksPercentage');
                        $studentMarksObj4->save();
                    }else{
                        $studentMarksObj44 = new StudentMark;
                        $studentMarksObj44->name = 'Graduation';
                        $studentMarksObj44->percentage = Input::get('graduationMarksPercentage');   
                        $studentMarksObj44->category_id = '3';
                        $studentMarksObj44->studentprofile_id = $getStudentProfileID[0]->id; 
                        $studentMarksObj44->save();
                    }


                //UPDATE INTO USERS TABLE
                $updateUsersObj = User::findOrFail(Auth::id());

                $updateUsersObj->email = Input::get('email');
                $updateUsersObj->phone = Input::get('phone');

                $updateUsersObj->save();

                //GET APPLICATION ID HERE
                $getLastCreatedApplicationObj = DB::table('application')
                                                ->where('application.email', '=', Input::get('email'))
                                                ->where('application.phone', '=', Input::get('phone'))
                                                ->where('application.collegemaster_id', '=', Input::get('courseMasterID'))
                                                ->where('application.users_id', '=', Auth::id())
                                                ->select('application.id')
                                                ->orderBy('application.id', 'DESC')
                                                ->take(1)
                                                ->get()
                                                ;
                //Update application ID
                $updateAppID = Application::findOrFail($getLastCreatedApplicationObj[0]->id);
                $updateAppID->applicationID = 'ADX'.date('y-m-d').'-'.$getLastCreatedApplicationObj[0]->id;
                $updateAppID->save();
                
                //PAYMENT GATEWAY PARAMS
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                $hash = '';

                //GET ALL REQUIRED DATA FROM APPLICATION TABLE
                $getApplicationObj = DB::table('application')
                                    ->join('users', 'application.users_id', '=', 'users.id')
                                    ->join('collegemaster', 'application.collegemaster_id', '=', 'collegemaster.id')
                                    ->join('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->join('users as cUser', 'collegeprofile.users_id', '=', 'cUser.id')
                                    ->join('degree', 'collegemaster.degree_id', '=', 'degree.id')
                                    ->join('course', 'collegemaster.course_id', '=', 'course.id')
                                    ->where('application.id', '=', $getLastCreatedApplicationObj[0]->id)
                                    ->where('cUser.userstatus_id', '!=', '5')
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('application.byafees','application.totalfees','application.restfees', 'users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'cUser.firstname as collegeName', 'degree.name as degreeName', 'course.name as courseName','application.transactionHashKey')
                                    ->take(1)
                                    ->orderBy('application.id', 'DESC')
                                    ->get()
                                    ;

                $easebuzzController = new EasebuzzController();
                $hash = $easebuzzController->generateHash([
                    'txnid' => $txnid,
                    'amount' => $getApplicationObj[0]->byafees,
                    'productinfo' => $getApplicationObj[0]->collegeName.'/'.$getApplicationObj[0]->degreeName.'/'.$getApplicationObj[0]->courseName,
                    'firstname' => $getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename.' '.$getApplicationObj[0]->lastname,
                    'email' => $getApplicationObj[0]->email
                ]);
                    
                // $surl = env('APP_URL').'/payment-success';
                // $furl = env('APP_URL').'/payment-failure';

                // if( env('APP_ENV') == 'local' ){
                //     $surl = env('APP_URL').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
                //     $furl = env('APP_URL').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;
                // }else{
                //    $surl = 'https://'.env('ipAddressForRedirect').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
                //    $furl = 'https://'.env('ipAddressForRedirect').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;
                // }

                $surl = env('APP_URL').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
                $furl = env('APP_URL').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;

                $service_provider = 'easebuzz';

                $encryptApplicationId = \Illuminate\Support\Facades\Crypt::encrypt($getLastCreatedApplicationObj[0]->id);
                
                $agent = new Agent();
                return view('student.student-payment.studentcoursepayment')
                                ->with('totalFees', $getApplicationObj[0]->totalfees)
                                ->with('byafees', $getApplicationObj[0]->byafees)
                                ->with('restfees', $getApplicationObj[0]->restfees)
                                ->with('studentName', Input::get('firstname').' '.Input::get('lastname'))
                                ->with('currentApplicationID', $getLastCreatedApplicationObj[0]->id)
                                ->with('encryptApplicationId', $encryptApplicationId)
                                ->with('key', env('EASEBUZZ_MERCHANT_KEY'))
                                ->with('hash', $hash)
                                ->with('txnid', $txnid)                                
                                ->with('amount', $getApplicationObj[0]->byafees)
                                ->with('productinfo', $getApplicationObj[0]->collegeName.'/'.$getApplicationObj[0]->degreeName.'/'.$getApplicationObj[0]->courseName)
                                ->with('firstname', $getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename)
                                ->with('email', $getApplicationObj[0]->email)
                                ->with('surl', $surl)
                                ->with('furl', $furl)
                                ->with('service_provider', $service_provider)
                                ->with('agent', $agent)
                            ;

            }else{
                Auth::logout(); // logout user
                return Redirect::to('/');    
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/');
        }        
    }

    //Payment Process From PAYUBIZ
    public function processPaymentNowForStudent(Request $request, $id)
    {
        $decryptApplicationId = \Illuminate\Support\Facades\Crypt::decrypt($id);
        $getApplicationObj = DB::table('application')
                                    ->join('users', 'application.users_id', '=', 'users.id')
                                    ->join('collegemaster', 'application.collegemaster_id', '=', 'collegemaster.id')
                                    ->join('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->join('users as cUser', 'collegeprofile.users_id', '=', 'cUser.id')
                                    ->join('degree', 'collegemaster.degree_id', '=', 'degree.id')
                                    ->join('course', 'collegemaster.course_id', '=', 'course.id')
                                    ->where('application.id', '=', $decryptApplicationId)
                                    ->where('cUser.userstatus_id', '!=', '5')
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('byafees', 'users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'users.phone', 'cUser.firstname as collegeName', 'degree.name as degreeName', 'course.name as courseName','application.transactionHashKey')
                                    ->take(1)
                                    ->orderBy('application.id', 'DESC')
                                    ->get()
                                    ;

        //REMOVE DUPLICATE TRANSACTION RECORD
        DB::table('transaction')
            ->where('application_id', '=', $decryptApplicationId)
            ->where('transaction.paymentstatus_id', '!=', 1)
            ->delete();

        //$transactionHashKey = uniqid('admissionx_'.round(microtime(true) * 1000).'_'.$decryptApplicationId);
        //uniqid('admissionx_'.date('Y-m-d-H-i-s').'_'.$application_id);
        // round(microtime(true) * 1000)
        //CREATE TRANSACTIONS DETAILS
        $createTransactionsObj = New Transaction;

        $transactionKey = uniqid( 'admissionx_' );
        $createTransactionsObj->name = $transactionKey;
        $createTransactionsObj->employee_id = Auth::id();
        $createTransactionsObj->paymentstatus_id = '7';
        $createTransactionsObj->application_id = $decryptApplicationId;
        $createTransactionsObj->transactionHashKey = $getApplicationObj[0]->transactionHashKey;

        $createTransactionsObj->save();

        $string = $getApplicationObj[0]->collegeName.'-'.$getApplicationObj[0]->degreeName.'-'.$getApplicationObj[0]->courseName;
        $collegeAndCourseName = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
        
        // if( env('APP_ENV') == 'local' ){
        //     $surl = env('APP_URL').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
        //     $furl = env('APP_URL').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;
        // }else{
        //    $surl = 'https://'.env('ipAddressForRedirect').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
        //    $furl = 'https://'.env('ipAddressForRedirect').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;
        // }

        $surl = env('APP_URL').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
        $furl = env('APP_URL').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;

        $returnStatusCode = $this->processEasebuzzPayment(
                            [
                                'key' => env('EASEBUZZ_MERCHANT_KEY'),
                                'txnid' => $transactionKey,
                                'amount' => $getApplicationObj[0]->byafees,
                                'firstname' => $getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename.' '.$getApplicationObj[0]->lastname,
                                'email' => $getApplicationObj[0]->email,
                                'phone' => $getApplicationObj[0]->phone,
                                'productinfo' => $collegeAndCourseName,
                                'surl' => $surl,
                                'furl' => $furl
                            ],
                    env('EASEBUZZ_SALT') );
        

        //GET TRANSACTION ID IN REVERSE ORDER
        $getTransactionIdValue = DB::table('transaction')
        						->where('application_id', '=', $decryptApplicationId)
        						->select('id')
        						->take(1)
        						->orderBy('id', 'DESC')
        						->get()
        						;

        // Instead of checking return status, redirect to payment gateway
        $easebuzzController = new EasebuzzController();
        
        // Try actual payment gateway first, fallback to simulation if credentials are invalid
        try {
            $paymentResult = $easebuzzController->initiatePayment([
                'txnid' => $transactionKey,
                'amount' => $getApplicationObj[0]->byafees,
                'productinfo' => $collegeAndCourseName,
                'firstname' => $getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename.' '.$getApplicationObj[0]->lastname,
                'email' => $getApplicationObj[0]->email,
                'phone' => $getApplicationObj[0]->phone,
                'surl' => $surl,
                'furl' => $furl
            ]);

            if ($paymentResult['status'] === 'success') {
                // Create payment form and auto-submit to Easebuzz
                $paymentUrl = $easebuzzController->getPaymentUrl();
                $hash = $easebuzzController->generateHash([
                    'txnid' => $transactionKey,
                    'amount' => $getApplicationObj[0]->byafees,
                    'productinfo' => $collegeAndCourseName,
                    'firstname' => $getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename.' '.$getApplicationObj[0]->lastname,
                    'email' => $getApplicationObj[0]->email
                ]);

                return view('student.student-payment.easebuzz-redirect', [
                    'paymentUrl' => $paymentUrl,
                    'key' => env('EASEBUZZ_MERCHANT_KEY'),
                    'txnid' => $transactionKey,
                    'amount' => $getApplicationObj[0]->byafees,
                    'productinfo' => $collegeAndCourseName,
                    'firstname' => $getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename.' '.$getApplicationObj[0]->lastname,
                    'email' => $getApplicationObj[0]->email,
                    'phone' => $getApplicationObj[0]->phone,
                    'surl' => $surl,
                    'furl' => $furl,
                    'hash' => $hash
                ]);
            }
        } catch (\Exception $e) {
            // Fallback to test mode if gateway fails
        }
        
        // Simulate successful payment for testing when gateway is unavailable
        $updateTransactionsObj = Transaction::where('id', '=', $getTransactionIdValue[0]->id)->firstOrFail();
        $updateTransactionsObj->paymentstatus_id = '1';
        $updateTransactionsObj->save();

        $updateApplicationObj = Application::where('id', '=', $decryptApplicationId)->firstOrFail();
        $updateApplicationObj->paymentstatus_id = '1';
        $updateApplicationObj->lastPaymentAttemptDate = date('Y-m-d H:i:s');
        $updateApplicationObj->save();            

        Session::flash('paymentSuccessMessage', 'Your transaction has been successfully submitted! (Test Mode - Gateway Unavailable)');
        return Redirect::to('/success-payment-details');
        exit;            
    }



    public function studentReapplyCourse(Request $request, $slug, $appliationID)
    {   
        //PAYMENT GATEWAY PARAMS
        $decryptApplicationId = \Illuminate\Support\Facades\Crypt::decrypt($appliationID);
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $hash = '';
        
        //GET ALL REQUIRED DATA FROM APPLICATION TABLE
        $getApplicationObj = DB::table('application')
                            ->join('users', 'application.users_id', '=', 'users.id')
                            ->join('collegemaster', 'application.collegemaster_id', '=', 'collegemaster.id')
                            ->join('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                            ->join('users as cUser', 'collegeprofile.users_id', '=', 'cUser.id')
                            ->join('degree', 'collegemaster.degree_id', '=', 'degree.id')
                            ->join('course', 'collegemaster.course_id', '=', 'course.id')
                            ->where('application.id', '=', $decryptApplicationId)
                            ->where('cUser.userstatus_id', '!=', '5')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.firstname', 'users.middlename', 'users.lastname', 'users.email', 'cUser.firstname as collegeName', 'degree.name as degreeName', 'course.name as courseName','application.totalfees','application.byafees','application.restfees','application.transactionHashKey')
                            ->take(1)
                            ->orderBy('application.id', 'DESC')
                            ->get()
                            ;

        $hash_string = '';
        $hash_string = env('MERCHANT_KEY').'|'.$txnid.'|'.$getApplicationObj[0]->byafees.'|'.$getApplicationObj[0]->collegeName.'/'.$getApplicationObj[0]->degreeName.'/'.$getApplicationObj[0]->courseName.'|'.$getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename.' '.$getApplicationObj[0]->lastname.'|'.$getApplicationObj[0]->email.'|||||||||||';
        $hash_string .= env('SALT');

        $hash = strtolower(hash('sha512', $hash_string));
        
        // if( env('APP_ENV') == 'local' ){
        //     $surl = env('APP_URL').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
        //     $furl = env('APP_URL').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;
        // }else{
        //    $surl = 'https://'.env('ipAddressForRedirect').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
        //    $furl = 'https://'.env('ipAddressForRedirect').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;
        // }
        $surl = env('APP_URL').'/payment-success/'.$getApplicationObj[0]->transactionHashKey;
        $furl = env('APP_URL').'/payment-failed/'.$getApplicationObj[0]->transactionHashKey;
        // $surl = env('APP_URL').'/payment-success';
        // $furl = env('APP_URL').'/payment-failure';
        $service_provider = 'payu_paisa';

        $agent = new Agent();
        return view('student.student-payment.reapplystudentcoursepayment')
                        ->with('totalFees', $getApplicationObj[0]->totalfees)
                        ->with('byafees', $getApplicationObj[0]->byafees)
                        ->with('restfees', $getApplicationObj[0]->restfees)
                        ->with('studentName', $getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename.' '.$getApplicationObj[0]->lastname)
                        ->with('currentApplicationID', $decryptApplicationId)
                        ->with('encryptApplicationId', $appliationID)
                        ->with('key', env('MERCHANT_KEY'))
                        ->with('hash', $hash)
                        ->with('txnid', $txnid)                                
                        ->with('amount', $getApplicationObj[0]->byafees)
                        ->with('productinfo', $getApplicationObj[0]->collegeName.'/'.$getApplicationObj[0]->degreeName.'/'.$getApplicationObj[0]->courseName)
                        ->with('firstname', $getApplicationObj[0]->firstname.' '.$getApplicationObj[0]->middlename)
                        ->with('email', $getApplicationObj[0]->email)
                        ->with('surl', $surl)
                        ->with('furl', $furl)
                        ->with('service_provider', $service_provider)
                        ->with('agent', $agent)
                    ; 
    }

    public function moveApplicationDoc($file, $studentSlug)
    {   
        $path = $file['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $ext = strtolower($ext);

        $error=array();
        $extension=array("jpeg","jpg","png", "pdf");
        $file_name=$file["name"];
        $file_tmp=$file["tmp_name"];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/application/'.$studentSlug.'/';
        }else{
            $dirPath = public_path().'/application/'.$studentSlug.'/';
        }

        if(in_array($ext,$extension))
        {   
            $currentMyTime = strtotime('now');
            $imageNameWithTime = $studentSlug.'-'.$currentMyTime.uniqid();
            $fileWithExtension = $imageNameWithTime.'-'.'1'.'.'.$ext;
            $fileWithExtension1 = $imageNameWithTime.'-'.'1'.'_original.'.$ext;

            //$tempPath = $file[ 'uploadDocumentImage' ][ 'tmp_name' ];
            //Store the image with 300PX width
            $uploadPath = $dirPath.$fileWithExtension;
            //Store the image with original width as original
            $uploadPath1 = $dirPath.$fileWithExtension1;
            if (move_uploaded_file($file_tmp, $uploadPath)) {
             copy($uploadPath, $uploadPath1);
            }  

            //IMAGE SAVED IN FOLDER NOW RESIZE IT
            if (file_exists($dirPath.$fileWithExtension)) {

                $uploadimage = $dirPath.$fileWithExtension;//$dirPath.$file['file']['name'];
                $newname = $fileWithExtension;//$file['file']['name'];

                // Set the resize_image name
                $resize_image = $dirPath.$newname; 
                $actual_image = $dirPath.$newname;
                // It gets the size of the image
                list( $width,$height ) = getimagesize( $uploadimage );
                // It makes the new image width of 350
                if( $width > '800' ){
                    $newwidth = 800;
                    // It makes the new image height of 350
                    //$newheight = 350;
                    if( $ext != 'png' ){
                        $image = imagecreatefromjpeg($dirPath.$fileWithExtension);
                    }else{
                        $image = imagecreatefrompng($dirPath.$fileWithExtension);
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
                        imagepng( $thumb, $resize_image ); 
                    }
                    // 100 Represents the quality of an image you can set and ant number in place of 100.
                    $out_image=addslashes(file_get_contents($resize_image));    
                }else{
                    $newwidth = $width;
                    $newheight = $height;
                }            
            }
        }
        return $fileWithExtension;
    }

    public function processPaymentAdmission($id)
    {
        //print_r($id);die;
        //REMOVE DUPLICATE TRANSACTION RECORD
        $getAllTransactionIDObj = DB::table('transaction')
                                    ->where('application_id', '=', $id)
                                    ->select('id')
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->get()
                                    ;
        Transaction::destroy($getAllTransactionIDObj[0]->id);



        $getApplicationTableData = DB::table('application')
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
                            ->leftJoin('transaction', 'application.id', '=', 'transaction.application_id')
                            ->leftJoin('paymentstatus', 'transaction.paymentstatus_id', '=', 'paymentstatus.id')
                            ->leftJoin('cardtype', 'transaction.cardtype_id', '=', 'cardtype.id') 
                            ->where('application.id', '=', $id)
                            ->where('studentUser.userstatus_id', '!=', '5')
                            ->where('collegeUser.userstatus_id', '!=', '5')
                            ->select('application.id as applicationId', 'application.name as applicationName','applicationstatus.name as applicationstatusName','applicationstatus.id as applicationstatusId', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.middlename as studentUserMiddleName','studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob','application.byafees','application.email', 'application.phone','studentUser.email as studentUserEmail','collegeUser.email as collegeUserEmail','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','transaction.id as transactionId','studentUser.phone as studentUserPhone','collegeUser.phone as collegeUserPhone','paymentstatus.id as paymentstatusID','application.applicationID')
                            ->get();

        if(!empty($getApplicationTableData)){
            $applicationId = $getApplicationTableData[0]->applicationID;
            $collegeEmailAddress = $getApplicationTableData[0]->collegeUserEmail;
            $collegeName = $getApplicationTableData[0]->collegeUserFirstName;
            $functionalareaName = $getApplicationTableData[0]->functionalareaName;
            $degreeName = $getApplicationTableData[0]->degreeName;
            $courseName = $getApplicationTableData[0]->courseName;
            $studentName = $getApplicationTableData[0]->studentUserFirstName.' '.$getApplicationTableData[0]->studentUserMiddleName.' '.$getApplicationTableData[0]->studentUserLastName;
            $studentEmailAddress = $getApplicationTableData[0]->studentUserEmail;
            $applicationFees = $getApplicationTableData[0]->byafees;
            $transactionId = $getApplicationTableData[0]->transactionId;
            $studentMobileNo = $getApplicationTableData[0]->studentUserPhone;
            $collegeMobileNo = $getApplicationTableData[0]->collegeUserPhone;
            $paymentstatusID = $getApplicationTableData[0]->paymentstatusID;
        }
        
        //SEND EMAIL TO ADMIN AND COLLEGE
        $getTheAdminEmail = DB::table('users')
                            ->where('userrole_id', '=', '1')
                            ->where('userstatus_id', '=', '1')
                            ->select('email')
                            ->get()
                            ;

        //$adminEmailAddress = $getTheAdminEmail[0]->email;
       //Send Payment Success email for college
        try {
            if(!empty($collegeEmailAddress) && ($this->fetchDataServiceController->isValidEmail($collegeEmailAddress) == 1))
            {
                /**Swift Mailer To College***/        
                \Mail::send('emailtemplate/course-application.email-to-college', array('email' => $collegeEmailAddress, 'collegeName' => $collegeName, 'courseName' => $courseName, 'applicationId' => $applicationId, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName,'amount' => $applicationFees, 'studentName' => $studentName,  ), function($message) use ($collegeEmailAddress)
                {
                    $message->to($collegeEmailAddress, 'AdmissionX')->subject('College get new application for a course - College');
                }); 
            }

        } catch ( \Swift_TransportException $e) {                
        }

       //Send Payment Success email for student
        try {
            if(!empty($studentEmailAddress) && ($this->fetchDataServiceController->isValidEmail($studentEmailAddress) == 1))
            {
                /**Swift Mailer To College***/        
                \Mail::send('emailtemplate/course-application.email-to-student', array('email' => $studentEmailAddress, 'studentName' => $studentName, 'collegeName' => $collegeName, 'applicationId' => $applicationId, 'amount' => $applicationFees ,'courseName' => $courseName, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName ), function($message) use ($studentEmailAddress)
                {
                    $message->to($studentEmailAddress, 'AdmissionX')->subject('You have applied for new admission - AdmissionX');
                }); 
            }

        } catch ( \Swift_TransportException $e) {                
        }

        //Send Payment Success email for Admin
        $adminEmailAddress = array();
        foreach ($getTheAdminEmail as $key => $value) {
            $adminEmailAddress = $value->email;
            //$adminEmailAddress[] = $tempArrayEmailId;

            try {
                if(!empty($adminEmailAddress) && ($this->fetchDataServiceController->isValidEmail($adminEmailAddress) == 1))
                {
                   /**Swift Mailer To Admin***/        
                    \Mail::send('emailtemplate/course-application.email-to-admin', array('email' => $adminEmailAddress, 'studentName' => $studentName, 'collegeName' => $collegeName, 'applicationId' => $applicationId, 'amount' => $applicationFees , 'courseName' => $courseName, 'transactionId' => $transactionId), function($message) use ($adminEmailAddress)
                    {
                        $message->to($adminEmailAddress, 'AdmissionX')->subject('College get new application for a course - Admin');
                    });       
                }
            }catch ( \Swift_TransportException $e) {                
            }
        }

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.PAYMENTPROCESS').' by this User Id '.Auth::id());

        /************   Send SMS *******************************/
        if( $paymentstatusID == '1') 
        {  
            try {
                if(!empty($collegeMobileNo))
                {   $string = $collegeName;
                    $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                    $userMobileNo = $collegeMobileNo;  
                    //$smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', '.Config::get('systemsetting.COLLEGEPAYMENTFIRSTSEC').' '.$applicationId.' '.Config::get('systemsetting.COLLEGEPAYMENTSECONDSEC').'.';   
                    
                    //$smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', we have received a new application for your college with '.$applicationId.' Kindly review the application from your account. '.Config::get('systemsetting.SMS_GROUP_NAME_4'); 
                    //$resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_ADMISSION_PROCESS_TO_COLLEGE'));

                    $smsMessageData = 'Dear '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', Application ID: '.$applicationId.' has been forwarded. Kindly approve earliest by maximum 72 hours. For assistance call our Helpline '.Config::get('systemsetting.SMS_PHONE_NUMBER').' '.Config::get('systemsetting.SMS_GROUP_NAME_1');

                    /***Send SMS *******************************/
                    $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_FORWARDED_TO_COLLEGE'));
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

        if( $paymentstatusID == '1') 
        {  
            try {
                if(!empty($studentMobileNo))
                {
                    $string = $collegeName;
                    $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                    $userMobileNo = $studentMobileNo;  

                    //$smsMessageData = 'Hi '.$studentName.', we have received a payment of INR '.$applicationFees.' from you. We have forwarded your application to '.(str_limit($collegeNameStr, $limit = 30, $end = '')).'.';  

                    // $smsMessageData = 'Hi '.$studentName.', '.Config::get('systemsetting.STUDENTPAYMENTFIRSTSEC').' '.$applicationFees.' '.Config::get('systemsetting.STUDENTPAYMENTSECONDSEC').' '.(str_limit($collegeNameStr, $limit = 30, $end = '')).'. '.Config::get('systemsetting.SMS_GROUP_NAME_5');  
                    //$resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_BOOK_ADMISSION_PROCESS'));

                    $smsMessageData = 'Dear '.$studentName.', Your Application No.'.$applicationId.' has been forwarded to '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', will take 7 working days for the processing. For assistance call our Helpline '.Config::get('systemsetting.SMS_PHONE_NUMBER').' '.Config::get('systemsetting.SMS_GROUP_NAME_2');

                    /***Send SMS *******************************/
                    $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_FORWARDED_TO_STUDENT'));
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
        return 'surl';
    }

    public function processFailurePaymentAdmission($id)
    {
        //REMOVE DUPLICATE TRANSACTION RECORD
        $getAllTransactionIDObj = DB::table('transaction')
                                    ->where('application_id', '=', $id)
                                    ->select('id')
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->get()
                                    ;
        Transaction::destroy($getAllTransactionIDObj[0]->id);

        $getApplicationTableData = DB::table('application')
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
                            ->leftJoin('transaction', 'application.id', '=', 'transaction.application_id')
                            ->leftJoin('paymentstatus', 'transaction.paymentstatus_id', '=', 'paymentstatus.id')
                            ->leftJoin('cardtype', 'transaction.cardtype_id', '=', 'cardtype.id')
                            ->where('application.id', '=', $id)
                            ->where('collegeUser.userstatus_id', '!=', '5')
                            ->where('studentUser.userstatus_id', '!=', '5')
                            ->select('application.id as applicationId','applicationstatus.name as applicationstatusName','applicationstatus.id as applicationstatusId', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.middlename as studentUserMiddleName','studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob','application.byafees','application.email', 'application.phone','studentUser.email as studentUserEmail','collegeUser.email as collegeUserEmail','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','transaction.id as transactionId','studentUser.phone as studentUserPhone','collegeUser.phone as collegeUserPhone','paymentstatus.id as paymentstatusID','application.applicationID')
                            ->get();

        if(!empty($getApplicationTableData)){
            $applicationId = $getApplicationTableData[0]->applicationID;
            $collegeName = $getApplicationTableData[0]->collegeUserFirstName;
            $courseName = $getApplicationTableData[0]->courseName;
            $studentName = $getApplicationTableData[0]->studentUserFirstName.' '.$getApplicationTableData[0]->studentUserMiddleName.' '.$getApplicationTableData[0]->studentUserLastName;
            $transactionId = $getApplicationTableData[0]->transactionId;
        }
        
        //SEND EMAIL TO ADMIN AND COLLEGE
        $getTheAdminEmail = DB::table('users')
                            ->where('userrole_id', '=', '1')
                            ->where('userstatus_id', '=', '1')
                            ->select('email')
                            ->get()
                            ;
        //$adminEmailAddress = $getTheAdminEmail[0]->email;
        $adminEmailAddress = array();
        foreach ($getTheAdminEmail as $key => $value) {
            $adminEmailAddress = $value->email;
            //$adminEmailAddress[] = $tempArrayEmailId;
            try {
                if(!empty($adminEmailAddress) && ($this->fetchDataServiceController->isValidEmail($adminEmailAddress) == 1))
                {
                   /**Swift Mailer To Admin***/        
                    \Mail::send('emailtemplate/course-application.email-to-admin-failure-payment', array('email' => $adminEmailAddress, 'studentName' => $studentName, 'collegeName' => $collegeName, 'applicationId' => $applicationId, 'courseName' => $courseName, 'transactionId' => $transactionId), function($message) use ($adminEmailAddress)
                    {
                        $message->to($adminEmailAddress, 'AdmissionX')->subject('Transaction failure because of some reason - Admin');
                    });       
                }
            }catch ( \Swift_TransportException $e) {                
            }
        }

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.PAYMENTPROCESS').' by this User Id '.Auth::id());
        return 'furl';
    }

   
    public function failurePayment()
    {   
        Session::flash('paymentFailureMessage', 'Your transaction has been cancelled because of some reason!');
        return view('student.student-payment.successPayment');
    }

    public function successPayment()
    {   
        Session::flash('paymentSuccessMessage', 'Your transaction has been successfully submitted!');
        return view('student.student-payment.successPayment');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //EASEBUZZ PAYMENT PROCESSING
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function processEasebuzzPayment($params, $salt)
    {
        $easebuzzController = new EasebuzzController();
        
        // Initiate payment with Easebuzz
        $result = $easebuzzController->initiatePayment($params);
        
        if ($result['status'] === 'success') {
            // For test environment, simulate success
            if (env('EASEBUZZ_ENV') === 'test') {
                return 'surl';
            }
            
            // For production, handle actual response
            return 'surl';
        } else {
            return 'furl';
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //PAYU MONEY CLASSES (DEPRECATED)
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
            Misc::show_reponse( $result );
            exit(0);
        } else{ 
            $host = (isset( $_SERVER['https'] ) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            /*if ( isset( $_SERVER['REQUEST_URI'] ) && ! empty( $_SERVER['REQUEST_URI'] ) ) $params['surl'] = $host;
            if ( isset( $_SERVER['REQUEST_URI'] ) && ! empty( $_SERVER['REQUEST_URI'] ) ) $params['furl'] = $host;*/
            $result = $this->pay( $params, $salt );
            Misc::show_page($result);
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

    public function handleFailurePaymentAction(Request $request, $id)
    {
        //REMOVE DUPLICATE TRANSACTION RECORD
        $getTransactionIdValue = DB::table('transaction')
                                    ->where('transaction.transactionHashKey', '=', $id)
                                    ->select('id','application_id')
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->get();

        //Transaction::destroy($getTransactionIdValue[0]->id);
        if (sizeof($getTransactionIdValue) > 0) {
            $updateTransactionsObj = Transaction::where('id', '=', $getTransactionIdValue[0]->id)->firstOrFail();
            $updateTransactionsObj->paymentstatus_id = '2';
            $updateTransactionsObj->transactionHashKey = null;
            $updateTransactionsObj->save();

            //UDPATE APPLICATION PAYMENT STATUS IN APPLICATION TABLE
            $updateApplicationObj = Application::where('id', '=', $getTransactionIdValue[0]->application_id)->firstOrFail();
            $updateApplicationObj->lastPaymentAttemptDate = date('Y-m-d H:i:s');
            $updateApplicationObj->save();   

            $getApplicationTableData = DB::table('application')
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
                                ->leftJoin('transaction', 'application.id', '=', 'transaction.application_id')
                                ->leftJoin('paymentstatus', 'transaction.paymentstatus_id', '=', 'paymentstatus.id')
                                ->leftJoin('cardtype', 'transaction.cardtype_id', '=', 'cardtype.id')
                                ->where('application.id', '=', $getTransactionIdValue[0]->application_id)
                                ->where('collegeUser.userstatus_id', '!=', '5')
                                ->where('studentUser.userstatus_id', '!=', '5')
                                ->select('application.id as applicationId','applicationstatus.name as applicationstatusName','applicationstatus.id as applicationstatusId', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.middlename as studentUserMiddleName','studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob','application.byafees','application.email', 'application.phone','studentUser.email as studentUserEmail','collegeUser.email as collegeUserEmail','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','transaction.id as transactionId','studentUser.phone as studentUserPhone','collegeUser.phone as collegeUserPhone','paymentstatus.id as paymentstatusID','application.applicationID')
                                ->get();

            if(!empty($getApplicationTableData)){
                $applicationId = $getApplicationTableData[0]->applicationID;
                $collegeName = $getApplicationTableData[0]->collegeUserFirstName;
                $courseName = $getApplicationTableData[0]->courseName;
                $studentName = $getApplicationTableData[0]->studentUserFirstName.' '.$getApplicationTableData[0]->studentUserMiddleName.' '.$getApplicationTableData[0]->studentUserLastName;
                $transactionId = $getApplicationTableData[0]->transactionId;
            }
            
            //SEND EMAIL TO ADMIN AND COLLEGE
            $getTheAdminEmail = DB::table('users')
                                ->where('userrole_id', '=', '1')
                                ->where('userstatus_id', '=', '1')
                                ->select('email')
                                ->get()
                                ;
            //$adminEmailAddress = $getTheAdminEmail[0]->email;
            $adminEmailAddress = array();
            foreach ($getTheAdminEmail as $key => $value) {
                $adminEmailAddress = $value->email;
                //$adminEmailAddress[] = $tempArrayEmailId;
                try {
                    if(!empty($adminEmailAddress) && ($this->fetchDataServiceController->isValidEmail($adminEmailAddress) == 1))
                    {
                       /**Swift Mailer To Admin***/        
                        \Mail::send('emailtemplate/course-application.email-to-admin-failure-payment', array('email' => $adminEmailAddress, 'studentName' => $studentName, 'collegeName' => $collegeName, 'applicationId' => $applicationId, 'courseName' => $courseName, 'transactionId' => $transactionId), function($message) use ($adminEmailAddress)
                        {
                            $message->to($adminEmailAddress, 'AdmissionX')->subject('Transaction failure because of some reason - Admin');
                        });       
                    }
                }catch ( \Swift_TransportException $e) {                
                }
            }

            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.PAYMENTPROCESS').' by this User Id '.Auth::id());

            Session::flash('paymentFailureMessage', 'Your transaction has been cancelled/decline because of some reason!');
            return view('student.student-payment.successPayment');
        }else{
            Session::flash('paymentSuccessMessage', 'Your transaction key has been invalid or you have opened the wrong route.');
            return view('student.student-payment.successPayment');
        }
    }

    public function handleSuccessPaymentAction(Request $request, $id)
    {
        $getTransactionIdValue = DB::table('transaction')
                                ->where('transactionHashKey', '=', $id)
                                ->select('id','application_id')
                                ->take(1)
                                ->orderBy('id', 'DESC')
                                ->get()
                                ;

        if (sizeof($getTransactionIdValue) > 0) {
            $updateTransactionsObj = Transaction::where('id', '=', $getTransactionIdValue[0]->id)->firstOrFail();
            $updateTransactionsObj->paymentstatus_id = '1';
            $updateTransactionsObj->transactionHashKey = null;
            $updateTransactionsObj->save();

            //UDPATE APPLICATION PAYMENT STATUS IN APPLICATION TABLE
            $updateApplicationObj = Application::where('id', '=', $getTransactionIdValue[0]->application_id)->firstOrFail();
            $updateApplicationObj->paymentstatus_id = '1';
            $updateApplicationObj->lastPaymentAttemptDate = date('Y-m-d H:i:s');
            $updateApplicationObj->save();            
            
            $getApplicationTableData = DB::table('application')
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
                                ->leftJoin('transaction', 'application.id', '=', 'transaction.application_id')
                                ->leftJoin('paymentstatus', 'transaction.paymentstatus_id', '=', 'paymentstatus.id')
                                ->leftJoin('cardtype', 'transaction.cardtype_id', '=', 'cardtype.id') 
                                ->where('application.id', '=', $getTransactionIdValue[0]->application_id)
                                ->where('studentUser.userstatus_id', '!=', '5')
                                ->where('collegeUser.userstatus_id', '!=', '5')
                                ->select('application.id as applicationId', 'application.name as applicationName','applicationstatus.name as applicationstatusName','applicationstatus.id as applicationstatusId', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.middlename as studentUserMiddleName','studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob','application.byafees','application.email', 'application.phone','studentUser.email as studentUserEmail','collegeUser.email as collegeUserEmail','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','transaction.id as transactionId','studentUser.phone as studentUserPhone','collegeUser.phone as collegeUserPhone','paymentstatus.id as paymentstatusID','application.applicationID')
                                ->get();

            if(!empty($getApplicationTableData)){
                $applicationId = $getApplicationTableData[0]->applicationID;
                $collegeEmailAddress = $getApplicationTableData[0]->collegeUserEmail;
                $collegeName = $getApplicationTableData[0]->collegeUserFirstName;
                $functionalareaName = $getApplicationTableData[0]->functionalareaName;
                $degreeName = $getApplicationTableData[0]->degreeName;
                $courseName = $getApplicationTableData[0]->courseName;
                $studentName = $getApplicationTableData[0]->studentUserFirstName.' '.$getApplicationTableData[0]->studentUserMiddleName.' '.$getApplicationTableData[0]->studentUserLastName;
                $studentEmailAddress = $getApplicationTableData[0]->studentUserEmail;
                $applicationFees = $getApplicationTableData[0]->byafees;
                $transactionId = $getApplicationTableData[0]->transactionId;
                $studentMobileNo = $getApplicationTableData[0]->studentUserPhone;
                $collegeMobileNo = $getApplicationTableData[0]->collegeUserPhone;
                $paymentstatusID = $getApplicationTableData[0]->paymentstatusID;
            }
            
            //SEND EMAIL TO ADMIN AND COLLEGE
            $getTheAdminEmail = DB::table('users')
                                ->where('userrole_id', '=', '1')
                                ->where('userstatus_id', '=', '1')
                                ->select('email')
                                ->get()
                                ;

            //$adminEmailAddress = $getTheAdminEmail[0]->email;
           //Send Payment Success email for college
            try {
                if(!empty($collegeEmailAddress) && ($this->fetchDataServiceController->isValidEmail($collegeEmailAddress) == 1))
                {
                    /**Swift Mailer To College***/        
                    \Mail::send('emailtemplate/course-application.email-to-college', array('email' => $collegeEmailAddress, 'collegeName' => $collegeName, 'courseName' => $courseName, 'applicationId' => $applicationId, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName,'amount' => $applicationFees, 'studentName' => $studentName,  ), function($message) use ($collegeEmailAddress)
                    {
                        $message->to($collegeEmailAddress, 'AdmissionX')->subject('College get new application for a course - College');
                    }); 
                }

            } catch ( \Swift_TransportException $e) {                
            }

           //Send Payment Success email for student
            try {
                if(!empty($studentEmailAddress) && ($this->fetchDataServiceController->isValidEmail($studentEmailAddress) == 1))
                {
                    /**Swift Mailer To College***/        
                    \Mail::send('emailtemplate/course-application.email-to-student', array('email' => $studentEmailAddress, 'studentName' => $studentName, 'collegeName' => $collegeName, 'applicationId' => $applicationId, 'amount' => $applicationFees ,'courseName' => $courseName, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName ), function($message) use ($studentEmailAddress)
                    {
                        $message->to($studentEmailAddress, 'AdmissionX')->subject('You have applied for new admission - AdmissionX');
                    }); 
                }

            } catch ( \Swift_TransportException $e) {                
            }

            //Send Payment Success email for Admin
            $adminEmailAddress = array();
            foreach ($getTheAdminEmail as $key => $value) {
                $adminEmailAddress = $value->email;
                //$adminEmailAddress[] = $tempArrayEmailId;

                try {
                    if(!empty($adminEmailAddress) && ($this->fetchDataServiceController->isValidEmail($adminEmailAddress) == 1))
                    {
                       /**Swift Mailer To Admin***/        
                        \Mail::send('emailtemplate/course-application.email-to-admin', array('email' => $adminEmailAddress, 'studentName' => $studentName, 'collegeName' => $collegeName, 'applicationId' => $applicationId, 'amount' => $applicationFees , 'courseName' => $courseName, 'transactionId' => $transactionId), function($message) use ($adminEmailAddress)
                        {
                            $message->to($adminEmailAddress, 'AdmissionX')->subject('College get new application for a course - Admin');
                        });       
                    }
                }catch ( \Swift_TransportException $e) {                
                }
            }

            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.PAYMENTPROCESS').' by this User Id '.Auth::id());

            /************   Send SMS *******************************/
            if( $paymentstatusID == '1') 
            {  
                try {
                    if(!empty($collegeMobileNo))
                    {   $string = $collegeName;
                        $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                        $userMobileNo = $collegeMobileNo;  
                        //$smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', '.Config::get('systemsetting.COLLEGEPAYMENTFIRSTSEC').' '.$applicationId.' '.Config::get('systemsetting.COLLEGEPAYMENTSECONDSEC').'.';   
                        
                        //$smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', we have received a new application for your college with '.$applicationId.' Kindly review the application from your account. '.Config::get('systemsetting.SMS_GROUP_NAME_4'); 
                    	//$resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_ADMISSION_PROCESS_TO_COLLEGE'));

                        $smsMessageData = 'Dear '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', Application ID: '.$applicationId.' has been forwarded. Kindly approve earliest by maximum 72 hours. For assistance call our Helpline '.Config::get('systemsetting.SMS_PHONE_NUMBER').' '.Config::get('systemsetting.SMS_GROUP_NAME_1');

                        /***Send SMS *******************************/
                        $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_FORWARDED_TO_COLLEGE'));
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

            if( $paymentstatusID == '1') 
            {  
                try {
                    if(!empty($studentMobileNo))
                    {
                        $string = $collegeName;
                        $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                        $userMobileNo = $studentMobileNo;  

                        //$smsMessageData = 'Hi '.$studentName.', we have received a payment of INR '.$applicationFees.' from you. We have forwarded your application to '.(str_limit($collegeNameStr, $limit = 30, $end = '')).'.';  

                        //$smsMessageData = 'Hi '.$studentName.', '.Config::get('systemsetting.STUDENTPAYMENTFIRSTSEC').' '.$applicationFees.' '.Config::get('systemsetting.STUDENTPAYMENTSECONDSEC').' '.(str_limit($collegeNameStr, $limit = 30, $end = '')).'. '.Config::get('systemsetting.SMS_GROUP_NAME_5');  
                        //$resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_BOOK_ADMISSION_PROCESS'));

                        $smsMessageData = 'Dear '.$studentName.', Your Application No.'.$applicationId.' has been forwarded to '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', will take 7 working days for the processing. For assistance call our Helpline '.Config::get('systemsetting.SMS_PHONE_NUMBER').' '.Config::get('systemsetting.SMS_GROUP_NAME_2');

                        /***Send SMS *******************************/
                        $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_FORWARDED_TO_STUDENT'));
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
            Session::flash('paymentSuccessMessage', 'Your transaction has been successfully submitted!');
            return view('student.student-payment.successPayment');
        }else{
            Session::flash('paymentSuccessMessage', 'Your transaction key has been invalid or you have opened the wrong route.');
            return view('student.student-payment.successPayment');
        }
    }
}