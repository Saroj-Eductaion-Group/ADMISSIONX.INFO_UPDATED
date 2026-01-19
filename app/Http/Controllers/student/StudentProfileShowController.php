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
use Session;
use DateTime;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\Country as Country;
use App\Models\State as State;
use App\Models\CollegeType as CollegeType;
use App\Models\City as City;
use App\Models\Address as Address;
use App\Models\Gallery as Gallery;
use App\Models\Document as Document;
use App\Models\AddressType as AddressType;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\Degree as Degree;
use App\Models\Course as Course;
use App\Models\CourseType as CourseType;
use App\Models\EducationLevel as EducationLevel;
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\CollegeMaster as CollegeMaster;
use App\Models\Placement as Placement;
use App\Models\StudentProfile as StudentProfile;
use App\Models\Category as Category;
use App\Models\StudentMark as StudentMark;


class StudentProfileShowController extends Controller
{

	public function index(Request $request, $slug)
    {	
         if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                //REDIRECT IF USER STATUS IS DISABLED
                $checkDisabledStatus = StudentProfile::join('users', 'studentprofile.users_id', '=', 'users.id')->where('studentprofile.slug', '=', $slug)->firstOrFail();
                if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
                    return Redirect::to('/');
                }

                //GET COLLEGE NAME
                $getStudentDetailObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('users.id','=', $userId)
                                        ->select('users.id as usersId', 'users.firstname',  'users.middlename', 'users.lastname','users.phone', 'users.email', 'studentprofile.id as studentprofileId','studentprofile.slug')
                                        ->get()
                                        ;


                $getStudentAddressObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('address', 'studentprofile.id', '=', 'address.studentprofile_id')
                                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                        ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('users.id','=', $userId)
                                        ->select('users.id as usersId','address.id as adressID', 'address.name', 'address.address1', 'address.address2','address.postalcode','addresstype.id as addresstypeId','addresstype.name as addresstypeName', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName')
                                        ->get()
                                        ;


                $getStudentProfileDataObj = DB::table('studentprofile')
                                            ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                            ->leftJoin('gallery','users.id','=','gallery.users_id')
                                            ->where('studentprofile.slug', '=', $slugUrl)
                                            ->where('users.id','=', $userId)
                                            ->where('gallery.caption', '=', 'Student Profile Picture')
                                            ->select('users.id as usersId', 'users.suffix','users.firstname as firstName','users.email as userEmailAddress', 'users.phone as userPhone','studentprofile.gender', 'studentprofile.dateofbirth', 'studentprofile.parentsname', 'studentprofile.parentsnumber', 'studentprofile.hobbies', 'studentprofile.interests', 'studentprofile.achievementsawards', 'studentprofile.projects', 'studentprofile.entranceexamname', 'studentprofile.entranceexamnumber', 'studentprofile.isverifiedage','studentprofile.slug','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage')
                                            ->orderBy('studentprofile.id', 'ASC')
                                            ->take(1)
                                            ->get()
                                            ;

                    $studentDOBDataObj = DB::table('studentprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('studentprofile.users_id', '=','users.id')
                                            ->where('studentprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->where('studentprofile.slug', '=', $slugUrl)
                                    ->where('users.id','=', $userId)
                                    ->select('users.id as usersId', 'users.phone as userPhone', 'studentprofile.dateofbirth','studentprofile.slug')
                                    ->orderBy('studentprofile.id', 'ASC')
                                    ->take(1)
                                    ->get()
                                    ;

                    if( empty($studentDOBDataObj) ){
                        $studentDOBDataObj = '';
                    }
                    $currentDateTime = date("Y-m-d"); 
                    $verifyStudentAge = $studentDOBDataObj[0]->dateofbirth; 

                    if ($studentDOBDataObj[0]->dateofbirth != '0000-00-00') {
                            $bday = new DateTime($verifyStudentAge); 
                            $today = new DateTime($currentDateTime);
                            $diff = $today->diff($bday); 
                            $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';
                    }else{
                        $calculateDate = '';
                    }
                $studentMarksDataObj = DB::table('studentprofile')
                                            ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                            ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                            ->leftJoin('category', 'studentmarks.category_id', '=', 'category.id')
                                            ->where('studentprofile.slug', '=', $slugUrl)
                                            ->where('users.id','=', $userId)
                                            ->select('users.id as usersId','studentmarks.id as studentmarksId','studentmarks.marks', 'studentmarks.percentage','studentmarks.name as marksName', 'studentmarks.studentprofile_id', 'studentmarks.category_id','users.firstname','users.middlename','users.lastname','studentprofile.slug')
                                            ->orderBy('studentprofile.id', 'ASC')
                                            ->get()
                                            ;
                                            
                        if( empty($studentMarksDataObj) ){
                            $studentMarksDataObj = '';
                        }

                $getStudentmarksListCount = DB::table('studentprofile')
                                            ->leftJoin('users', function ($join) use ($userId) {
                                                $join->on('studentprofile.users_id', '=','users.id')
                                                    ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                    );  
                                                })
                                            ->join('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                            ->where('studentprofile.slug', '=', $slugUrl)
                                            ->where('users.id','=', $userId)
                                            ->count()
                                            ;
                        if( empty($getStudentmarksListCount) ){
                            $getStudentmarksListCount = '';
                        }

                if (Auth::check())
                {
                    Session::flash('rightNowCollegeLogIn', 'You are currently in profile view mode. To update details, please go to the'); 
                }

                return view('student/student-profile-show.index')
                                ->with('slugUrl', $request->slug)
                                ->with('getStudentProfileDataObj', $getStudentProfileDataObj)
                                ->with('getStudentDetailObj', $getStudentDetailObj)
                                ->with('getStudentAddressObj', $getStudentAddressObj)
                                ->with('getStudentmarksListCount', $getStudentmarksListCount)
                                ->with('studentMarksDataObj',$studentMarksDataObj)
                                ->WITH('calculateDate', $calculateDate)
                                ->with('studentDOBDataObj',$studentDOBDataObj)
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

    public function profilePartialShow(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
  
                try {
                     $studentProfileDataObj = DB::table('studentprofile')
                            ->leftJoin('users', function ($join) use ($userId) {
                                $join->on('studentprofile.users_id', '=','users.id')
                                    ->where('studentprofile.users_id', '=', DB::raw($userId)
                                    );  
                                })
                            ->leftJoin('entranceexam','studentprofile.entranceexamname','=' ,'entranceexam.id')
                            ->where('users.id','=', $userId)
                            ->where('studentprofile.slug', '=', $slugUrl)
                            ->select('users.id as usersId', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone','studentprofile.gender', 'studentprofile.dateofbirth', 'studentprofile.parentsname', 'studentprofile.parentsnumber', 'studentprofile.hobbies', 'studentprofile.interests', 'studentprofile.achievementsawards', 'studentprofile.projects', 'studentprofile.entranceexamname', 'studentprofile.entranceexamnumber', 'studentprofile.isverifiedage','studentprofile.slug', 'entranceexam.name as entranceexamName')
                            ->orderBy('studentprofile.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;

        
                        if( empty($studentProfileDataObj) ){
                            $studentProfileDataObj = '';
                        }
                   
                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
               
               $htmlBlock = view('student/student-profile-show.profileShowPartial')
                        ->with('studentProfileDataObj', $studentProfileDataObj)
                        ->with('slugUrl', Input::get('slug'))
                        ->render()
                        ;
                return response()->json($htmlBlock);        

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }
   
    public function addressPartialShow(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                try {
                        $getStudentPermanentAddress = DB::table('studentprofile')
                                                        ->join('users', function ($join) use ($userId) {
                                                            $join->on('studentprofile.users_id', '=','users.id')
                                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                                );  
                                                            })
                                                        ->leftJoin('address','studentprofile.id','=','address.studentprofile_id')
                                                        ->leftJoin('addresstype', function ($join) {
                                                            $join->on('address.addresstype_id', '=','addresstype.id')
                                                                ->where('address.addresstype_id', '=', '3');  
                                                            })
                                                        ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                                        ->where('studentprofile.slug', '=', Input::get('slug'))
                                                        ->where('addresstype.id', '=', '3')
                                                        ->where('users.id','=', $userId)
                                                        ->select('studentprofile.id', 'address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalcode','city.name as cityName', 'state.name as stateName', 'country.name as countryName')
                                                        ->get()
                                                        ;
                        if( empty($getStudentPermanentAddress) ){
                            $getStudentPermanentAddress = '';
                        }
                        $getStudentPresentAddress = DB::table('studentprofile')
                                                        ->join('users', function ($join) use ($userId) {
                                                            $join->on('studentprofile.users_id', '=','users.id')
                                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                                );  
                                                            })
                                                        ->leftJoin('address','studentprofile.id','=','address.studentprofile_id')
                                                        ->leftJoin('addresstype', function ($join) {
                                                            $join->on('address.addresstype_id', '=','addresstype.id')
                                                                ->where('address.addresstype_id', '=', '4');  
                                                            })
                                                        ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                                        ->where('studentprofile.slug', '=', Input::get('slug'))
                                                        ->where('addresstype.id', '=', '4')
                                                        ->where('users.id','=', $userId)
                                                        ->select('studentprofile.id', 'address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalcode','city.name as cityName', 'state.name as stateName', 'country.name as countryName')
                                                        ->get()
                                                        ;
                        if( empty($getStudentPresentAddress) ){
                            $getStudentPresentAddress = '';
                        }
                    } catch ( \Exception $e) {
                                // Auth::logout();
                                // return redirect('login');
                            }

                $htmlBlock = view('student/student-profile-show.addressShowPartial')
                                ->with('getStudentPermanentAddress', $getStudentPermanentAddress)
                                ->with('getStudentPresentAddress', $getStudentPresentAddress)
                                ->with('slugUrl', Input::get('slug'))
                                ->render()
                                ;
                return response()->json($htmlBlock);
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }          
    }

    public function photoDocumentPartialShow(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                try {
                        $getStudentDocumentImages = DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('documents', 'users.id', '=','documents.users_id')
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('users.id','=', $userId)
                                        ->select('studentprofile.id as studentprofileID', 'users.id as usersID', 'documents.id as documentsId', 'documents.name as documentsName', 'documents.fullimage as documentsFullImage', 'documents.description')
                                        ->orderBy('documents.id', 'ASC')
                                        ->get()
                                        ;
                        if( empty($getStudentDocumentImages) ){
                            $getStudentDocumentImages = '';
                        }    

                        $dataArrayContent = array();
                        $dataArray = array();
                        if( empty($getStudentDocumentImages) ){
                            $getStudentDocumentImages = '';
                        }else{
                            foreach ($getStudentDocumentImages as $item) {
                                $fileName = $item->documentsName;
                                $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                                
                                //Data Array Content
                                $dataArrayContent['studentprofileID'] = $item->studentprofileID;
                                $dataArrayContent['usersID'] = $item->usersID;
                                $dataArrayContent['documentsId'] = $item->documentsId;
                                $dataArrayContent['documentsName'] = $item->documentsName;
                                $dataArrayContent['documentsFullImage'] = $item->documentsFullImage;
                                $dataArrayContent['description'] = $item->description;
                                $dataArrayContent['ext'] = $ext;
                                $dataArray[] = $dataArrayContent;
                            }
                        }
                    } 
                    catch ( \Exception $e) {
                        // Auth::logout();
                        // return redirect('login');
                    }

            $htmlBlock = view('student/student-profile-show.academicDocumentPartial')
                            ->with('getStudentDocumentImages', $dataArray)
                            ->with('slugUrl', Input::get('slug'))
                            ->render()
                            ;
            return response()->json($htmlBlock);
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }  
    }

    public function projectPartialShow(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                try {
                        $getOldUploadedDescription = DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('documents', 'users.id', '=','documents.users_id')
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('documents.category_id', '=', '3')
                                        ->where('documents.name', '=', 'no-image-upload')
                                        ->where('users.id','=', $userId)
                                        ->select('studentprofile.id as studentprofileID', 'users.id as usersID', 'documents.id as documentsId', 'documents.name as documentsName', 'documents.fullimage as documentsFullImage','documents.description')
                                        ->orderBy('documents.id', 'ASC')
                                        ->get()
                                        ;
                        if(empty($getOldUploadedDescription)){
                            $getOldUploadedDescription = '';
                        }
                    } 
                    catch ( \Exception $e) {
                        // Auth::logout();
                        // return redirect('login');
                    }

                $htmlBlock = view('student/student-profile-show.projectShowPartial')
                                ->with('getOldUploadedDescription', $getOldUploadedDescription)
                                ->with('slugUrl', Input::get('slug'))
                                ->render()
                                ;
                return response()->json($htmlBlock); 
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

}