<?php

namespace App\Http\Controllers\college;

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
use Config;
use Session;
use DateTime;
use Log;
use File;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\Country as Country;
use App\Models\State as State;
use App\Models\CollegeType as CollegeType;
use App\Models\University;
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
use App\Models\Event as Event;
use App\Models\Facility as Facility;
use App\Models\CollegeFacility as CollegeFacility;
use App\Models\Faculty;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\Query;
use App\Models\ApplicationStatusMessage;
use App\Models\CollegeManagementDetail;
use App\Models\CollegeScholarship;
use App\Models\CollegeSportsActivity;
use App\Models\CollegeSocialMediaLink;
use App\Models\CollegeReview;
use App\Models\CollegeFaq;
use App\Models\CollegeCutOff;
use App\Models\FacultyExperience;
use App\Models\FacultyQualification;
use App\Models\FacultyDepartment;
use App\Models\CollegeMasterAssociateFaculty;
use App\Models\CollegeAdmissionImportantDated;
use App\Models\CollegeAdmissionProcedure;
use App\Models\Transaction;
use GuzzleHttp\Client;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;
use Jenssegers\Agent\Agent;

class CollegeController extends Controller
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
    public function index(Request $request)
    {   

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;

            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                
                $getCollegeNameObj = DB::table('collegeprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('collegeprofile.users_id', '=','users.id')
                                            ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->where('users.id', '=', $userId)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId', 'users.firstname', 'users.phone', 'users.email', 'collegeprofile.id as collegeprofileId', 'collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegeprofile.description','collegeprofile.slug', 'collegeprofile.facebookurl')
                                    ->take(1)
                                    ->get()
                                    ;
                if( empty($getCollegeNameObj) ){
                    $getCollegeNameObj = '';
                }

                $collegeDataObj = DB::table('collegeprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('collegeprofile.users_id', '=','users.id')
                                            ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->leftJoin('gallery','users.id','=','gallery.users_id')
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->where('gallery.caption', '=', 'College Logo')
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone','collegeprofile.description', 'collegeprofile.estyear', 'collegeprofile.website', 'collegeprofile.collegecode', 'collegeprofile.contactpersonname', 'collegeprofile.contactpersonemail', 'collegeprofile.contactpersonnumber','collegeprofile.calenderinfo','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage')
                                    ->orderBy('gallery.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;

              
                if( empty($collegeDataObj) ){
                    $collegeDataObj = '';
                }

                $collegeDataDescObj = DB::table('collegeprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('collegeprofile.users_id', '=','users.id')
                                            ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone','collegeprofile.description', 'collegeprofile.estyear', 'collegeprofile.website', 'collegeprofile.collegecode', 'collegeprofile.contactpersonname', 'collegeprofile.contactpersonemail', 'collegeprofile.contactpersonnumber','collegeprofile.calenderinfo')
                                    ->orderBy('collegeprofile.id', 'ASC')
                                    ->take(1)
                                    ->get()
                                    ;

              
                if( empty($collegeDataDescObj) ){
                    $collegeDataDescObj = '';
                }


                $getAddressData = DB::table('collegeprofile')
                                    ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                    ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                    ->leftJoin('city', 'address.city_id', '=', 'city.id')    
                                    ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                    ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->select('collegeprofile.id', 'address.id as adressID', 'address.name', 'address.address1', 'address.address2', 'addresstype.id as addresstypeId','addresstype.name as addresstypeName', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName', 'address.postalcode')
                                    ->orderBy('address.id', 'ASC')
                                    ->take(2)
                                    ->get()
                                    ;
                if( empty($getAddressData) ){
                    $getAddressData = '';
                }

                $collegeFacilityDataObj = DB::table('collegeprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('collegeprofile.users_id', '=','users.id')
                                            ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->join('collegefacilities','collegeprofile.id','=','collegefacilities.collegeprofile_id')
                                    ->join('facilities','collegefacilities.facilities_id','=','facilities.id')
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId','collegefacilities.id as collegefacilitiesId','collegefacilities.name',  'collegefacilities.description','facilities.id as facilitiesId', 'facilities.name as facilitiesName','facilities.iconname as iconname')
                                    ->orderBy('collegeprofile.id', 'ASC')
                                    ->get()
                                    ;

                if( empty($collegeFacilityDataObj) ){
                    $collegeFacilityDataObj = '';
                }


                $getApplicationsStatusDataObj = Application::orderBy('application.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slugUrl) {
                                               $join->on('application.collegeprofile_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slugUrl));
                                               })
                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                            ->where('application.applicationstatus_id','=', '2')
                                            ->where('application.paymentstatus_id','=', '1')
                                            ->groupBy('collegeprofile.id')
                                            ->count()
                                            ;
              
                if( empty($getApplicationsStatusDataObj) ){
                    $getApplicationsStatusDataObj = '';
                }

                $getQueryCollegeDataObj = Query::orderBy('query.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slugUrl) {
                                               $join->on('query.college_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slugUrl));
                                               })
                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                            ->where('query.admin_id', '=', '0')
                                            ->whereRaw('query.replytoid is NULL')
                                            ->where('query.queryflowtype', '=', 'student-to-college')
                                            ->count()
                                            ;
// print_r($getQueryCollegeDataObj);die;
                if( empty($getQueryCollegeDataObj) ){
                    $getQueryCollegeDataObj = '';
                }

                $agent = new Agent();

                return view('college/dashboard.index')
                        ->with('slugUrl', $request->slug)
                        ->with('getCollegeNameObj', $getCollegeNameObj)
                        ->with('collegeDataObj', $collegeDataObj)
                        ->with('collegeDataDescObj', $collegeDataDescObj)
                        ->with('getAddressData', $getAddressData)
                        ->with('collegeFacilityDataObj', $collegeFacilityDataObj)
                        ->with('getApplicationsStatusDataObj', $getApplicationsStatusDataObj)
                        ->with('getQueryCollegeDataObj', $getQueryCollegeDataObj)
                        ->with('agent', $agent)
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

    public function profilePartial(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
  
                try {
                    $collegeDataObj = DB::table('collegeprofile')
                            ->leftJoin('users', function ($join) use ($userId) {
                            $join->on('collegeprofile.users_id', '=','users.id')
                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                );  
                            })
                            ->leftJoin('collegetype','collegeprofile.collegetype_id','=','collegetype.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone','collegetype.id as collegeTypeId','collegetype.name as collegeTypeName','collegeprofile.description', 'collegeprofile.estyear', 'collegeprofile.website', 'collegeprofile.collegecode', 'collegeprofile.contactpersonname', 'collegeprofile.contactpersonemail', 'collegeprofile.contactpersonnumber','collegeprofile.calenderinfo','collegeprofile.collegetype_id', 'collegeprofile.university_id','approvedBy','collegeprofile.mediumOfInstruction','collegeprofile.studyForm','collegeprofile.studyTo','collegeprofile.admissionStart','collegeprofile.admissionEnd','collegeprofile.CCTVSurveillance','collegeprofile.totalStudent','collegeprofile.ACCampus')
                            ->orderBy('collegeprofile.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;

                        if( empty($collegeDataObj) ){
                            $collegeDataObj = '';
                        }
                   
                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
                $states =State::all();
                $collegeType = DB::table('collegetype')
                        ->orderBy('collegetype.name', 'ASC')
                        ->get()
                        ;
                $university = University::orderBy('name', 'ASC')->get();

                $city = DB::table('city')
                        ->where('city.cityStatus','=','1')    
                        ->orderBy('city.name', 'ASC')
                        ->get()
                        ;
                $addressType = DB::table('addresstype')
                            ->orderBy('addresstype.name', 'ASC')
                            ->get()
                            ;

                $htmlBlock = view('college/college-profile-partial.profilePartial')
                        ->with('collegeDataObj', $collegeDataObj)
                        ->with('collegeType', $collegeType)
                        ->with('addressType', $addressType)
                        ->with('city', $city)
                        ->with('states', $states)
                        ->with('university', $university)
                        ->with('slugUrl', $slugUrl)->render();
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

    public function addressPartial(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            $slugUrl1 = $request->slug;

            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                try {
                       
                        $collegeRegisteredAddressDataObj = DB::table('collegeprofile')
                                                            ->join('users', function ($join) use ($userId) {
                                                                $join->on('collegeprofile.users_id', '=','users.id')
                                                                    ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                                    );  
                                                                })
                                                            ->leftJoin('collegetype','collegeprofile.collegetype_id','=','collegetype.id')
                                                            ->leftJoin('address','collegeprofile.id','=','address.collegeprofile_id')
                                                            ->leftJoin('addresstype', function ($join) {
                                                                $join->on('address.addresstype_id', '=','addresstype.id')
                                                                    ->where('address.addresstype_id', '=', '1');  
                                                                })
                                                            ->leftJoin('city','address.city_id','=','city.id')
                                                            ->leftJoin('state','city.state_id','=','state.id')
                                                            ->leftJoin('country','state.country_id','=','country.id')
                                                            ->where('address.addresstype_id', '=', '1')
                                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                                            ->where('users.userstatus_id', '!=', '5')
                                                            ->select('users.id as usersId','collegeprofile.id as collegeProfileId', 'collegeprofile.slug','collegetype.id as collegeTypeId','collegetype.name as collegeTypeName','address.id as addressId','address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalCode','addresstype.id as addressTypeId','addresstype.name as addressTypeName','city.id as cityId','city.name as cityName','state.id as stateId','state.name as stateName', 'country.id as countryId','country.name as countryName')
                                                            ->orderBy('collegeprofile.id', 'DESC')
                                                            ->take(1)
                                                            ->get()
                                                            ;

                        $collegeCampusAddressDataObj = DB::table('collegeprofile')
                                                            ->join('users', function ($join) use ($userId) {
                                                                $join->on('collegeprofile.users_id', '=','users.id')
                                                                    ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                                    );  
                                                                })
                                                            ->leftJoin('collegetype','collegeprofile.collegetype_id','=','collegetype.id')
                                                            ->leftJoin('address','collegeprofile.id','=','address.collegeprofile_id')
                                                            ->leftJoin('addresstype', function ($join) {
                                                                $join->on('address.addresstype_id', '=','addresstype.id')
                                                                    ->where('address.addresstype_id', '=', '2');  
                                                                })
                                                            ->leftJoin('city','address.city_id','=','city.id')
                                                            ->leftJoin('state','city.state_id','=','state.id')
                                                            ->leftJoin('country','state.country_id','=','country.id')
                                                            ->where('address.addresstype_id', '=', '2')
                                                            ->where('collegeprofile.slug', '=', $slugUrl1)
                                                            ->where('users.userstatus_id', '!=', '5')
                                                            ->select('users.id as usersId','collegeprofile.id as collegeProfileId','collegeprofile.slug','collegetype.id as collegeTypeId','collegetype.name as collegeTypeName','address.id as addressId','address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalCode','addresstype.id as addressTypeId','addresstype.name as addressTypeName','city.id as cityId','city.name as cityName','state.id as stateId','state.name as stateName', 'country.id as countryId','country.name as countryName')
                                                            ->orderBy('collegeprofile.id', 'DESC')
                                                            ->take(1)
                                                            ->get()
                                                            ;
                
                } catch ( \Exception $e) {
                    $collegeRegisteredAddressDataObj = '';
                    // Auth::logout();
                    // return redirect('login');
                }
            
                $states =State::all();
                $country =Country::all();
                $collegeType = DB::table('collegetype')
                        ->orderBy('collegetype.name', 'ASC')
                        ->get()
                        ;
                $city = DB::table('city')
                        ->where('city.cityStatus','=','1')
                        ->orderBy('city.name', 'ASC')
                        ->get()
                        ;
                $addressType = DB::table('addresstype')
                            ->orderBy('addresstype.name', 'ASC')
                            ->get()
                            ;

                $states1 =State::all();
                $country1 =Country::all();
                $collegeType1 = DB::table('collegetype')
                        ->orderBy('collegetype.name', 'ASC')
                        ->get()
                        ;
                $city1 = DB::table('city')
                        ->where('city.cityStatus','=','1')
                        ->orderBy('city.name', 'ASC')
                        ->get()
                        ;
                $addressType1 = DB::table('addresstype')
                            ->orderBy('addresstype.name', 'ASC')
                            ->get()
                            ;

                $htmlBlock = view('college/college-profile-partial.addressPartial')
                        ->with('collegeRegisteredAddressDataObj', $collegeRegisteredAddressDataObj)
                        ->with('collegeCampusAddressDataObj', $collegeCampusAddressDataObj)
                        ->with('collegeType', $collegeType)
                        ->with('addressType', $addressType)
                        ->with('city', $city)
                        ->with('states', $states)
                        ->with('collegeType1', $collegeType1)
                        ->with('addressType1', $addressType1)
                        ->with('city1', $city1)
                        ->with('states1', $states1)
                        ->with('country', $country)
                        ->with('country1', $country1)
                        ->with('slugUrl', $slugUrl)
                        ->with('slugUrl1', $slugUrl1)->render();

                return response()->json($htmlBlock);

            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }        
    }

    public function photoVideoPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;

            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                
                $getOldUploadedImages = DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('gallery', 'users.id', '=','gallery.users_id')
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('gallery.misc', '=', 'college-upload-gallery-img')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeprofileID', 'users.id as usersID', 'gallery.id as galleryId', 'gallery.name as galleryName', 'gallery.fullimage as galleryFullImage', 'gallery.caption')
                                        ->orderBy('gallery.id', 'ASC')
                                        ->get()
                                        ;
                if( empty($getOldUploadedImages) ){
                    $getOldUploadedImages = '';
                }    

                $getOldUploadedVideos = DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('gallery', 'users.id', '=','gallery.users_id')
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('gallery.caption', '=', 'videogallery')
                                        ->where('gallery.caption', '!=', 'College Logo')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeprofileID', 'users.id as usersID', 'gallery.id as galleryId', 'gallery.name as galleryName', 'gallery.fullimage as galleryFullImage', 'gallery.caption')
                                        ->orderBy('gallery.id', 'DESC')
                                        ->get()
                                        ;

                                           

                                        

                $dataArray = array();
                if( empty($getOldUploadedVideos) ){
                    $getOldUploadedVideos = '';
                }else{
                    foreach ($getOldUploadedVideos as $value) {
                        $url = $value->galleryName;
                        $step1=explode('v=', $url);
                        $step2 =explode('&',$step1[1]);
                        $video_id = $step2[0];
                        $value->galleryName = $video_id;
                        $dataArray[] = $value;
                       
                    }
                }                


                
                $htmlBlock = view('college/college-profile-partial.photoVideoPartial')
                           ->with('slugUrl', $slugUrl)
                           ->with('getOldUploadedImages', $getOldUploadedImages)
                           ->with('getOldUploadedVideos', $dataArray)
                           ->render();

                return response()->json($htmlBlock);

                //return view('college/college-profile-partial.photoVideoPartial', compact('collegePhotoVideoDataObj'));
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function achievementPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                 
                $getOldUploadedImages = DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('documents', 'users.id', '=','documents.users_id')
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('documents.category_id', '=', '2')
                                        ->where('documents.name', '!=', 'no-image-upload')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeprofileID', 'users.id as usersID', 'documents.id as documentsId', 'documents.name as documentsName', 'documents.fullimage as documentsFullImage','documents.description')
                                        ->orderBy('documents.id', 'ASC')
                                        ->get()
                                        ;

                $getOldUploadedDescription = DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('documents', 'users.id', '=','documents.users_id')
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('documents.category_id', '=', '2')
                                        ->where('documents.name', '=', 'no-image-upload')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeprofileID', 'users.id as usersID', 'documents.id as documentsId', 'documents.name as documentsName', 'documents.fullimage as documentsFullImage','documents.description')
                                        ->orderBy('documents.id', 'ASC')
                                        ->get()
                                        ;
                if(empty($getOldUploadedDescription)){
                    $getOldUploadedDescription = '';
                }
                $dataArrayContent = array();
                $dataArray = array();
                if( empty($getOldUploadedImages) ){
                    $getOldUploadedImages = '';
                }else{
                    foreach ($getOldUploadedImages as $item) {
                        $fileName = $item->documentsName;
                        $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                        
                        //Data Array Content
                        $dataArrayContent['collegeprofileID'] = $item->collegeprofileID;
                        $dataArrayContent['usersID'] = $item->usersID;
                        $dataArrayContent['documentsId'] = $item->documentsId;
                        $dataArrayContent['documentsName'] = $item->documentsName;
                        $dataArrayContent['documentsFullImage'] = $item->documentsFullImage;
                        $dataArrayContent['description'] = $item->description;
                        $dataArrayContent['ext'] = $ext;
                        $dataArray[] = $dataArrayContent;
                    }
                }
                
                $htmlBlock = view('college/college-profile-partial.achievementPartial')
                        ->with('slugUrl', $slugUrl)
                        ->with('getOldUploadedImages', $dataArray)
                        ->with('getOldUploadedDescription', $getOldUploadedDescription)
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

    public function placementPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    $collegePlacementDataObj = DB::table('placement')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','placement.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.id', '=', $userId)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','placement.id as placementId', 'placement.numberofrecruitingcompany', 'placement.numberofplacementlastyear', 'placement.ctchighest', 'placement.ctclowest', 'placement.ctcaverage','placement.placementinfo')
                        ->orderBy('placement.id', 'ASC')
                        ->get()
                        ;

                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
                $htmlBlock = view('college/college-profile-partial.placementPartial')
                        ->with('collegePlacementDataObj', $collegePlacementDataObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function managementPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    $collegeManagementDataObj = DB::table('college_management_details')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','college_management_details.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.id', '=', $userId)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','college_management_details.id as collegeManagementDetailsId', 'college_management_details.suffix','college_management_details.name', 'college_management_details.designation', 'college_management_details.gender', 'college_management_details.picture', 'college_management_details.emailaddress', 'college_management_details.phoneno', 'college_management_details.landlineNo', 'college_management_details.about', 'college_management_details.users_id', 'college_management_details.collegeprofile_id')
                        ->orderBy('college_management_details.id', 'ASC')
                        ->get()
                        ;

                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
                $htmlBlock = view('college/college-profile-partial.managementPartial')
                        ->with('collegeManagementDataObj', $collegeManagementDataObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function scholarshipPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    $collegeScholarshipsDataObj = DB::table('college_scholarships')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','college_scholarships.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.id', '=', $userId)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','college_scholarships.id as collegeScholarshipId', 'college_scholarships.title','college_scholarships.description', 'college_scholarships.users_id', 'college_scholarships.collegeprofile_id')
                        ->orderBy('college_scholarships.id', 'ASC')
                        ->get()
                        ;

                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
                $htmlBlock = view('college/college-profile-partial.scholarshipPartial')
                        ->with('collegeScholarshipsDataObj', $collegeScholarshipsDataObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function facilitiesPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    $collegeFacilityDataObj = DB::table('collegefacilities')
                        ->leftJoin('collegeprofile','collegefacilities.collegeprofile_id','=','collegeprofile.id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->leftJoin('facilities','collegefacilities.facilities_id','=','facilities.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.id', '=', $userId)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegefacilities.id as collegefacilitiesId','collegefacilities.name',  'collegefacilities.description','facilities.id as facilitiesId', 'facilities.name as facilitiesName','facilities.iconname as iconname')
                        ->orderBy('collegefacilities.id', 'ASC')
                        ->get()
                        ;

                    $facilitiesTypeObj = Facility::all();
                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
                $htmlBlock = view('college/college-profile-partial.facilitiesPartial')
                        ->with('collegeFacilityDataObj', $collegeFacilityDataObj)
                        ->with('facilitiesTypeObj', $facilitiesTypeObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function coursesPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    //ADD NEW COLLEGE INFORMATION INTO COLLEGE MASTER
                    $educationLevelObj = EducationLevel::all();
                    $functionalAreaObj = FunctionalArea::all();
                    $courseTypeObj = CourseType::all();
                    //$courseObj = Course::all();
                    $courseObj = DB::table('course')
                            ->orderBy('course.name', 'ASC')
                            ->get()
                            ;

                    $getUpdatedCoursesObj = DB::table('collegeprofile')
                                        ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                                        ->leftJoin('educationlevel','collegemaster.educationlevel_id','=','educationlevel.id')
                                        ->leftJoin('functionalarea','collegemaster.functionalarea_id','=','functionalarea.id')
                                        ->leftJoin('degree','collegemaster.degree_id','=','degree.id')
                                        ->leftJoin('coursetype','collegemaster.coursetype_id','=','coursetype.id')
                                        ->leftJoin('course','collegemaster.course_id','=','course.id')
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->where('collegemaster.id', '!=', '')
                                        ->select('collegemaster.id as collegemasterId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'collegemaster.fees', 'collegemaster.seats','collegemaster.twelvemarks','collegemaster.others','collegemaster.seatsallocatedtobya', 'collegemaster.courseduration')
                                        ->orderBy('collegemaster.id','ASC')
                                        ->get()
                                        ;


                    $getCollegeNameObj = DB::table('collegeprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('collegeprofile.users_id', '=','users.id')
                                            ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->where('users.id', '=', $userId)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId', 'users.firstname', 'users.phone', 'users.email', 'collegeprofile.id as collegeprofileId', 'collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegeprofile.description','collegeprofile.slug', 'collegeprofile.facebookurl')
                                    ->take(1)
                                    ->get()
                                    ;
                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
                $htmlBlock = view('college/college-profile-partial.coursesListPartial', compact('getCollegeNameObj'))
                        ->with('educationLevelObj', $educationLevelObj)
                        ->with('functionalAreaObj', $functionalAreaObj)
                        ->with('courseTypeObj', $courseTypeObj)
                        ->with('courseObj', $courseObj)
                        ->with('getUpdatedCoursesObj', $getUpdatedCoursesObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function eventsPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    $collegeCalenderDataObj = DB::table('event')
                                ->leftJoin('collegeprofile','event.collegeprofile_id','=','collegeprofile.id')
                                ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                                ->where('collegeprofile.slug', '=', $slugUrl)
                                ->where('users.id', '=', $userId)
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('users.id as usersId','event.id as eventId','event.name', 'event.datetime', 'event.venue', 'event.description', 'event.link')
                                ->orderBy('collegeprofile.id', 'ASC')
                                ->get();

                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }

                $htmlBlock = view('college/college-profile-partial.eventsPartial')
                        ->with('collegeCalenderDataObj', $collegeCalenderDataObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function profilePartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = Input::get('slugUrl'); 
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $checkCollegeProfileObj = CollegeProfile::where('collegeprofile.users_id', '=', $userId)
                            ->leftJoin('users', function ($join) use ($userId) {
                            $join->on('collegeprofile.users_id', '=','users.id')
                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                );  
                            })
                            ->leftJoin('collegetype','collegeprofile.collegetype_id','=','collegetype.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegetype.id as collegeTypeId','collegetype.name as collegeTypeName','collegeprofile.description', 'collegeprofile.estyear', 'collegeprofile.website', 'collegeprofile.collegecode', 'collegeprofile.contactpersonname', 'collegeprofile.contactpersonemail', 'collegeprofile.contactpersonnumber','collegeprofile.slug')
                            ->firstOrFail();                 

                            $collegeProfileObj = CollegeProfile::where('collegeprofile.users_id', '=', $userId)->first();
                            if( !empty(Input::get('description')) ){
                                $collegeProfileObj->description = Input::get('description');    
                            }

                            if( !empty(Input::get('contactpersonname')) ){
                                $collegeProfileObj->contactpersonname = Input::get('contactpersonname');    
                            }

                            if( !empty(Input::get('contactpersonemail')) ){
                                $collegeProfileObj->contactpersonemail = Input::get('contactpersonemail');    
                            }

                            if( !empty(Input::get('contactpersonnumber')) ){
                                $collegeProfileObj->contactpersonnumber = Input::get('contactpersonnumber');    
                            }

                            if( !empty(Input::get('collegetype_id')) ){
                                $collegeProfileObj->collegetype_id = Input::get('collegetype_id');    
                            }

                            if( !empty(Input::get('estyear')) ){
                                $collegeProfileObj->estyear = Input::get('estyear');    
                            }

                            if( !empty(Input::get('collegecode')) ){
                                $collegeProfileObj->collegecode = Input::get('collegecode');    
                            }

                            if( !empty(Input::get('approvedBy')) ){
                                $collegeProfileObj->approvedBy = Input::get('approvedBy');    
                            }

                            if( !empty(Input::get('university_id')) ){
                                $collegeProfileObj->university_id = Input::get('university_id');    
                            }

                            if( !empty(Input::get('website')) ){
                                $collegeProfileObj->website = Input::get('website');    
                            }
                            
                            $collegeProfileObj->facebookurl = Input::get('facebookPageUrl');    
                            $collegeProfileObj->employee_id = Auth::id();

                            if( !empty(Input::get('mediumOfInstruction')) ){
                                $collegeProfileObj->mediumOfInstruction = Input::get('mediumOfInstruction');    
                            }

                            if( !empty(Input::get('studyForm')) ){
                                $collegeProfileObj->studyForm = Input::get('studyForm');    
                            }

                            if( !empty(Input::get('studyTo')) ){
                                $collegeProfileObj->studyTo = Input::get('studyTo');    
                            }

                            if( !empty(Input::get('admissionStart')) ){
                                $collegeProfileObj->admissionStart = Input::get('admissionStart');    
                            }

                            if( !empty(Input::get('admissionEnd')) ){
                                $collegeProfileObj->admissionEnd = Input::get('admissionEnd');    
                            }


                            if( !empty(Input::get('totalStudent')) ){
                                $collegeProfileObj->totalStudent = Input::get('totalStudent');    
                            }

                            $collegeProfileObj->CCTVSurveillance = Input::get('CCTVSurveillance');    
                            $collegeProfileObj->ACCampus = Input::get('ACCampus');    
                            $collegeProfileObj->save();   

                            Session::flash('collegeProfileUpdate', 'College profile has been updated successfully!');
               
                $dataArray = array(
                            'code' => '200',
                            'response' => 'success',
                            'message' => 'College profile has been updated successfully!',
                            'facebookMessage' => 'Facebook url has been updated successfully!',
                        );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                die;
                //return redirect()->route('college_dash', $checkCollegeProfileObj->slug);

            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }   
    }

     public function placementPartialCreated( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = Input::get('slugUrl'); 
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get();

                if(sizeof($collegeProfileDataObj) > 0){
                    $collegeProfileId = $collegeProfileDataObj[0]->collegeProfileId;
                    $placementObj = New Placement();
                    $placementObj->numberofrecruitingcompany = Input::get('numberofrecruitingcompany');
                    $placementObj->numberofplacementlastyear = Input::get('numberofplacementlastyear');
                    $placementObj->ctchighest = Input::get('ctchighest');
                    $placementObj->ctclowest = Input::get('ctclowest');
                    $placementObj->ctcaverage = Input::get('ctcaverage');
                    $placementObj->placementinfo = Input::get('placementinfo');
                    $placementObj->collegeprofile_id = $collegeProfileId;
                    $placementObj->employee_id = Auth::id();
                    $placementObj->save();

                    Session::flash('collegePlacementUpdate', 'College placement info has been updated successfully!');
                    return redirect('/college/dashboard/edit/'.$slugUrl.'#placement');
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

    public function placementUpdatePartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $placementId = $request->placementId;
            $slugUrl = $request->slugUrl; 
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                try {
                    $collegePlacementDataObj = Placement::where('placement.id', '=', $placementId)
                            ->leftJoin('collegeprofile','placement.collegeprofile_id','=','collegeprofile.id')
                            ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.id', '=', $userId)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegeprofile.description', 'collegeprofile.estyear', 'collegeprofile.website', 'collegeprofile.collegecode', 'collegeprofile.contactpersonname', 'collegeprofile.contactpersonemail', 'collegeprofile.contactpersonnumber','collegeprofile.slug','placement.id as placementId', 'placement.numberofrecruitingcompany', 'placement.numberofplacementlastyear', 'placement.ctchighest', 'placement.ctclowest', 'placement.ctcaverage','placement.placementinfo')
                            ->firstOrFail();

                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
                $htmlBlock = view('college/college-profile-partial.placementUpdatePartial')
                        ->with('collegePlacementDataObj', $collegePlacementDataObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function placementPartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = Input::get('slugUrl'); 
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get();

                $collegeProfileId = $collegeProfileDataObj[0]->collegeProfileId;
                

                $placementObj = Placement::where('placement.collegeprofile_id', '=', $collegeProfileId)->firstOrFail();
                $placementObj->numberofrecruitingcompany = Input::get('numberofrecruitingcompany');
                $placementObj->numberofplacementlastyear = Input::get('numberofplacementlastyear');
                $placementObj->ctchighest = Input::get('ctchighest');
                $placementObj->ctclowest = Input::get('ctclowest');
                $placementObj->ctcaverage = Input::get('ctcaverage');
                $placementObj->placementinfo = Input::get('placementinfo');
                $placementObj->collegeprofile_id = $collegeProfileId;
                $placementObj->employee_id = Auth::id();
                $placementObj->save();
                       
                Session::flash('collegePlacementUpdate', 'College placement info has been updated successfully!');
                return redirect('/college/dashboard/edit/'.$slugUrl.'#placement');
                //return redirect()->route('college_dash', $checkPlacementObj->slug);
                // $dataArray = array(
                //             'code' => '200',
                //             'response' => 'success',
                //             'message' => 'College placement info has been updated successfully!',
                //         );
                // header('Content-Type: application/json');
                // echo json_encode($dataArray);
                // die;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function registeredAddressPartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            $slug =Input::get('slug');
            $slugUrl = Input::get('slugUrl'); 
                      
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get();

                $collegeProfileId = $collegeProfileDataObj[0]->collegeProfileId;
                
                $checkRegisteredAddressObj = DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('address','collegeprofile.id','=','address.collegeprofile_id')
                                        ->leftJoin('addresstype', function ($join) {
                                            $join->on('address.addresstype_id', '=','addresstype.id')
                                                ->where('address.addresstype_id', '=', '1');  
                                            })
                                        ->where('address.addresstype_id', '=', '1')
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.id as usersId','collegeprofile.id as collegeProfileId','address.id as addressId','address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalCode','addresstype.id as addressTypeId','addresstype.name as addressTypeName')
                                        ->orderBy('collegeprofile.id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;
              
                                        
                $addressTypeId = $checkRegisteredAddressObj[0]->addressTypeId;
                                 
                if(!empty($collegeProfileId && $addressTypeId == '1'))
                {     
                    $addressObj = Address::where('address.collegeprofile_id', '=', $collegeProfileId)->where('address.addresstype_id', '=', '1')->firstOrFail();
                    $addressObj->name = Input::get('name');
                    $addressObj->address1 = Input::get('address1');
                    $addressObj->address2 = Input::get('address2');
                    $addressObj->landmark = Input::get('landmark');
                    $addressObj->postalcode = Input::get('postalCode');
                    $addressObj->addresstype_id = Input::get('addresstype_id');
                    $addressObj->city_id = Input::get('city_id');
                    $addressObj->collegeprofile_id = $collegeProfileId;
                    $addressObj->employee_id = Auth::id();
                    $addressObj->save();

                    if (($addressObj->addresstype_id == 1) || ($addressObj->addresstype_id == 2) && (!empty($addressObj->collegeprofile_id))) {
                        $updateCollegeAddress = $this->fetchDataServiceController->updateCollegeAddress($addressObj->addresstype_id, $addressObj->collegeprofile_id);
                    }
                    
                }
                //return redirect()->route('college_dash', $slug);
                $dataArray = array(
                            'code' => '200',
                            'response' => 'success',
                            'message' => 'College registered address has been updated successfully!',
                        );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                die;

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function campusAddressPartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slug =Input::get('slug'); 
            $slugUrl1 = Input::get('slugUrl1'); 
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get();

                $collegeProfileId = $collegeProfileDataObj[0]->collegeProfileId;

                $checkCampusAddressObj = DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('address','collegeprofile.id','=','address.collegeprofile_id')
                                        ->leftJoin('addresstype', function ($join) {
                                            $join->on('address.addresstype_id', '=','addresstype.id')
                                                ->where('address.addresstype_id', '=', '2');  
                                            })
                                        ->where('address.addresstype_id', '=', '2')
                                        ->where('collegeprofile.slug', '=', $slugUrl1)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.id as usersId','collegeprofile.id as collegeProfileId','collegeprofile.slug','address.id as addressId','address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalCode','addresstype.id as addressTypeId','addresstype.name as addressTypeName')
                                        ->orderBy('collegeprofile.id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;
                $addressTypeId = $checkCampusAddressObj[0]->addressTypeId;
                
                if(!empty($collegeProfileId) && $addressTypeId == '2' )
                {     
                   
                    $addressObj = Address::where('address.collegeprofile_id', '=', $collegeProfileId)->where('address.addresstype_id', '=', '2')->firstOrFail();
                    $addressObj->name = Input::get('name');
                    $addressObj->address1 = Input::get('address1');
                    $addressObj->address2 = Input::get('address2');
                    $addressObj->landmark = Input::get('landmark');
                    $addressObj->postalcode = Input::get('postalCode');
                    $addressObj->addresstype_id = Input::get('addresstype_id');
                    $addressObj->city_id = Input::get('city_id');
                    $addressObj->collegeprofile_id = $collegeProfileId;
                    $addressObj->employee_id = Auth::id();
                    $addressObj->save();

                    if (($addressObj->addresstype_id == 1) || ($addressObj->addresstype_id == 2) && (!empty($addressObj->collegeprofile_id))) {
                        $updateCollegeAddress = $this->fetchDataServiceController->updateCollegeAddress($addressObj->addresstype_id, $addressObj->collegeprofile_id);
                    }
                    
                }
               
                //return redirect()->route('college_dash', $slug);
                $dataArray = array(
                            'code' => '200',
                            'response' => 'success',
                            'message' => 'College campus address has been updated successfully!',
                        );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                die;

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function courseMasterCreate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl =Input::get('slugUrl');
            
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
                if( !empty($collegeProfileDataObj) ){
                    $collegeMasterObj = new CollegeMaster;
                    $collegeMasterObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
                    $collegeMasterObj->educationlevel_id = Input::get('educationlevel_id');
                    $collegeMasterObj->functionalarea_id = Input::get('functionalarea_id');
                    $collegeMasterObj->degree_id = Input::get('degree_id');
                    $collegeMasterObj->coursetype_id = Input::get('coursetype_id');
                    $collegeMasterObj->course_id = Input::get('course_id');
                    $collegeMasterObj->fees = Input::get('fees');
                    $collegeMasterObj->seats = Input::get('seats');
                    $collegeMasterObj->twelvemarks = Input::get('twelvemarks');
                    $collegeMasterObj->others = Input::get('others');
                    $collegeMasterObj->seatsallocatedtobya = Input::get('seatsallocatedtobya');
                    $collegeMasterObj->description = Input::get('description');
                    
                    $collegeMasterObj->courseduration = Input::get('courseduration').' '.Input::get('courseduration1');
                    $collegeMasterObj->employee_id = Auth::id();
                    $collegeMasterObj->save();
                   
                   //Old Functionality
                    //GET LATEST COLLEGE MASTER ID
                   /* $getLatestCollegeMasterID = DB::table('collegemaster')
                                                ->where('collegemaster.collegeprofile_id', '=', $collegeProfileDataObj[0]->collegeProfileId)
                                                ->select('collegemaster.id')
                                                ->orderBy('id', 'DESC')
                                                ->take(1)
                                                ->get()
                                                ;*/

                    //CREATE ROWS IN FACULTY TABLE
                    /*for ($counter=1; $counter <= 6; $counter++) { 
                        $facultyTableObj = new Faculty;
                        $facultyTableObj->suffix = Input::get('suffix_'.$counter);
                        $facultyTableObj->name = Input::get('faculty_'.$counter);
                        $facultyTableObj->description = Input::get('description_'.$counter);
                        $facultyTableObj->sortorder = $counter;
                        $facultyTableObj->collegemaster_id = $getLatestCollegeMasterID[0]->id;
                        $facultyTableObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
                        $facultyTableObj->employee_id = Auth::id();
                        $facultyTableObj->save();
                    }*/
                    //END

                    //New FUnctionality comment 18 july 2020
                    /*if (!empty(Input::get('facultyName'))) {
                        $sizeOfFacultyName = sizeof(Input::get('facultyName'));
                        for($experiences = 0; $experiences < $sizeOfFacultyName; $experiences++){
                            $createExperiencesList                          = New CollegeMasterAssociateFaculty;
                            $createExperiencesList->faculty_id              = Input::get('facultyName')[$experiences];
                            $createExperiencesList->functionalarea_id       = $collegeMasterObj->functionalarea_id;
                            $createExperiencesList->educationlevel_id       = $collegeMasterObj->educationlevel_id;
                            $createExperiencesList->degree_id               = $collegeMasterObj->degree_id;
                            $createExperiencesList->coursetype_id           = $collegeMasterObj->coursetype_id;
                            $createExperiencesList->course_id               = $collegeMasterObj->course_id;
                            $createExperiencesList->collegemaster_id        = $collegeMasterObj->id;
                            $createExperiencesList->collegeprofile_id       = $collegeMasterObj->collegeprofile_id;
                            $createExperiencesList->users_id                = Auth::id();
                            $createExperiencesList->employee_id             = Auth::id();
                            $createExperiencesList->save();
                        }
                    }*/

                    Session::flash('collegeMasterCreate', 'Course has been created successfully!');
                    //return redirect()->route('college_dash', $slugUrl); 

                    return redirect('/college/dashboard/edit/'.$slugUrl.'#courses');    
                }
                
            }else{
                //Auth::logout(); // logout user
                //return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function courseMasterPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $collegemasterId = $request->collegemasterId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                if($request->ajax())
                {
                    $getCollegeMasterData = CollegeProfile::where('collegemaster.id', '=', $collegemasterId)
                                            ->join('users', function ($join) use ($userId) {
                                                $join->on('collegeprofile.users_id', '=','users.id')
                                                    ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                    );  
                                                })
                                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                            ->where('users.userstatus_id', '!=', '5')
                                            ->select('collegemaster.id as collegemasterId','collegemaster.fees', 'collegemaster.seats', 'collegemaster.collegeprofile_id', 'collegemaster.educationlevel_id', 'collegemaster.functionalarea_id', 'collegemaster.degree_id', 'collegemaster.coursetype_id', 'collegemaster.course_id', 'users.firstName', 'collegeprofile.slug','collegemaster.twelvemarks','collegemaster.others','collegemaster.seatsallocatedtobya', 'collegemaster.courseduration', 'collegemaster.description')
                                            ->firstOrFail()
                                            ;

                    //GET FACULTY INFOMARTION
                    /*$getFacultyInfomartion = DB::table('collegeprofile')
                                            ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                                            ->join('faculty', 'collegemaster.id', '=', 'faculty.collegemaster_id')
                                            ->select('faculty.id', 'faculty.name', 'faculty.sortorder', 'faculty.description', 'faculty.suffix')
                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                            ->where('collegemaster.id', '=', $collegemasterId)
                                            ->orderBy('faculty.id','ASC')
                                            ->get()
                                            ;*/
                    $getFacultyInfomartion = [];

                    //Change on 18 july 2020
                    $getCollegeMasterFacultyObj=[];

                    /*$getCollegeMasterFacultyObj = DB::table('college_master_associate_faculties')
                                            ->join('collegeprofile', 'college_master_associate_faculties.collegeprofile_id', '=', 'collegeprofile.id')
                                            ->join('faculty', 'college_master_associate_faculties.faculty_id', '=', 'faculty.id')
                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                            ->where('college_master_associate_faculties.collegemaster_id', '=', $collegemasterId)
                                            ->where('college_master_associate_faculties.users_id', '=', Auth::id())
                                            ->select('faculty.id','faculty.name','faculty.suffix','faculty.designation', DB::raw("CONCAT(faculty.suffix,' ',faculty.name,' (Designation - ', faculty.designation,')') as fullname"))
                                            ->orderBy('faculty.id','ASC')
                                            ->get()
                                            ;*/

                    $getAllFacultyName = DB::table('faculty_departments')
                        ->leftJoin('collegeprofile', 'faculty_departments.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftJoin('faculty','faculty_departments.faculty_id','=','faculty.id')
                        ->where('faculty_departments.course_id', '=', $getCollegeMasterData->course_id) 
                        ->where('faculty_departments.educationlevel_id', '=', $getCollegeMasterData->educationlevel_id) 
                        ->where('faculty_departments.coursetype_id', '=', $getCollegeMasterData->coursetype_id) 
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('faculty.name', '<>', '')
                        ->select( 'faculty.id','faculty.name','faculty.suffix','faculty.designation', DB::raw("CONCAT(faculty.suffix,' ',faculty.name,' (Designation - ', faculty.designation,')') as fullname"))
                        ->orderBy('faculty.name', 'ASC')
                        ->get();
                                            
                    $educationLevelObj = EducationLevel::all();
                    $functionalAreaObj = FunctionalArea::all();
                    $degreeObj = Degree::all();
                    $courseTypeObj = CourseType::all();
                    $courseObj = Course::all();

                    $htmlBlock = view('college/college-profile-partial.courseMasterUpdate')
                        ->with('getCollegeMasterData', $getCollegeMasterData)
                        ->with('educationLevelObj', $educationLevelObj)
                        ->with('functionalAreaObj', $functionalAreaObj)
                        ->with('degreeObj', $degreeObj)
                        ->with('courseTypeObj', $courseTypeObj)
                        ->with('getFacultyInfomartion', $getFacultyInfomartion)
                        ->with('getCollegeMasterFacultyObj', $getCollegeMasterFacultyObj)
                        ->with('getAllFacultyName', $getAllFacultyName)
                        ->with('slugUrl', $slugUrl)
                        ->with('courseObj', $courseObj)->render();
                    return response()->json($htmlBlock);
                    

                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
                }
            }
            else
            {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }   
        }
        else
        {
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }  
    }

    public function courseMasterUpdate(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                $collegeMasterObj = CollegeMaster::where('collegemaster.id', '=', Input::get('collegemasterId'))->firstOrFail();
                $collegeMasterObj->educationlevel_id = Input::get('educationlevel_id');
                $collegeMasterObj->functionalarea_id = Input::get('functionalarea_id');
                $collegeMasterObj->degree_id = Input::get('degree_id');
                $collegeMasterObj->coursetype_id = Input::get('coursetype_id');
                $collegeMasterObj->course_id = Input::get('course_id');
                $collegeMasterObj->fees = Input::get('fees');
                $collegeMasterObj->seats = Input::get('seats');
                $collegeMasterObj->twelvemarks = Input::get('twelvemarks');
                $collegeMasterObj->others = Input::get('others');
                $collegeMasterObj->seatsallocatedtobya = Input::get('seatsallocatedtobya');

                $collegeMasterObj->courseduration = Input::get('courseduration').' '.Input::get('courseduration1');
                $collegeMasterObj->description = Input::get('description');
                $collegeMasterObj->employee_id = Auth::id();
                $collegeMasterObj->save();
                
                // Old functionality
                //GET LATEST COLLEGE MASTER ID
                // $getLatestCollegeMasterID = DB::table('collegemaster')
                //                             ->where('collegemaster.id', '=', Input::get('collegemasterId'))
                //                             ->select('collegemaster.id')
                //                             ->orderBy('id', 'DESC')
                //                             ->take(1)
                //                             ->get()
                //                             ;

                //GET ALL FACULTY TABLE ID
                // $getFacIds = DB::table('faculty')
                //             ->where('faculty.collegemaster_id', '=', $getLatestCollegeMasterID[0]->id)
                //             ->select('id')
                //             ->orderBy('sortorder','ASC')
                //             ->get()
                //             ;
                
                // foreach ($getFacIds as $key => $value) {
                //     $ct = $key + 1;
                //     $facultyTableObj = Faculty::findOrFail($value->id);
                //     $facultyTableObj->suffix = Input::get('suffix_'.$ct);
                //     $facultyTableObj->name = Input::get('faculty_'.$ct);
                //     $facultyTableObj->description = Input::get('description_'.$ct);
                //     $facultyTableObj->employee_id = Auth::id();
                //     $facultyTableObj->save();
                // }
                //END


                //Change on 18 july 2020 new function
                /*if (!empty(Input::get('facultyName'))) {
                    Db::table('college_master_associate_faculties')
                    ->where('college_master_associate_faculties.collegemaster_id','=', $collegeMasterObj->id)
                    ->where('college_master_associate_faculties.users_id', '=', Auth::id())
                    ->where('college_master_associate_faculties.collegeprofile_id', '=', $collegeMasterObj->collegeprofile_id)
                    ->delete();


                    $sizeOfFacultyName = sizeof(Input::get('facultyName'));
                    for($experiences = 0; $experiences < $sizeOfFacultyName; $experiences++){
                        $createExperiencesList                          = New CollegeMasterAssociateFaculty;
                        $createExperiencesList->faculty_id              = Input::get('facultyName')[$experiences];
                        $createExperiencesList->functionalarea_id       = $collegeMasterObj->functionalarea_id;
                        $createExperiencesList->educationlevel_id       = $collegeMasterObj->educationlevel_id;
                        $createExperiencesList->degree_id               = $collegeMasterObj->degree_id;
                        $createExperiencesList->coursetype_id           = $collegeMasterObj->coursetype_id;
                        $createExperiencesList->course_id               = $collegeMasterObj->course_id;
                        $createExperiencesList->collegemaster_id        = $collegeMasterObj->id;
                        $createExperiencesList->collegeprofile_id       = $collegeMasterObj->collegeprofile_id;
                        $createExperiencesList->users_id                = Auth::id();
                        $createExperiencesList->employee_id             = Auth::id();
                        $createExperiencesList->save();
                    }
                }*/

                Session::flash('collegeMasterUpdate', 'Course has been updated successfully!');
                //return redirect()->route('college_dash', $slugUrl);  
                return redirect('/college/dashboard/edit/'.$slugUrl.'#courses');
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function managementDetailsCreatePartial( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl =Input::get('slugUrl');
            
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
                if( !empty($collegeProfileDataObj) ){
                    $collegeManagementObj = new CollegeManagementDetail;
                    $collegeManagementObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
                    $collegeManagementObj->suffix = Input::get('suffix');
                    $collegeManagementObj->name = Input::get('name');
                    $collegeManagementObj->designation = Input::get('designation');
                    $collegeManagementObj->gender = Input::get('gender');
                    $collegeManagementObj->emailaddress = Input::get('emailaddress');
                    $collegeManagementObj->phoneno = Input::get('phoneno');
                    $collegeManagementObj->landlineNo = Input::get('landlineNo');
                    $collegeManagementObj->about = Input::get('about');
                    $collegeManagementObj->users_id = Auth::id();
                    $collegeManagementObj->employee_id = Auth::id();
                    $collegeManagementObj->save();

                    if($request->file('picture')){
                        $fileName = time().'-'.$userId.".".$request->picture->getClientOriginalExtension();
                        $request->picture->move(public_path('gallery/'.$request->slugUrl.'/'), $fileName);
                        DB::table('college_management_details')->where('college_management_details.id', '=', $collegeManagementObj->id)->update(array('college_management_details.picture' => $fileName));
                    }
                   
                    //END
                    Session::flash('collegeMasterCreate', 'Management details has been created successfully!');
                    //return redirect()->route('college_dash', $slugUrl);  
                    return redirect('/college/dashboard/edit/'.$slugUrl.'#management');  
                }
                
            }else{
                //Auth::logout(); // logout user
                //return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function managementDetailsPartial(Request $request)
    {
        if (Auth::check()){

            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $collegeManagementDetailsId = $request->collegeManagementDetailsId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                if($request->ajax()){
                    $getCollegeManagementData = CollegeManagementDetail::where('college_management_details.id', '=', $collegeManagementDetailsId)
                            ->leftJoin('collegeprofile','collegeprofile.id','=','college_management_details.collegeprofile_id')
                            ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.id', '=', $userId)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegeprofile.slug','college_management_details.id as collegeManagementDetailsId', 'college_management_details.suffix','college_management_details.name', 'college_management_details.designation', 'college_management_details.gender', 'college_management_details.picture', 'college_management_details.emailaddress', 'college_management_details.phoneno', 'college_management_details.landlineNo', 'college_management_details.about', 'college_management_details.users_id', 'college_management_details.collegeprofile_id')
                            ->firstOrFail()
                            ;


                    $htmlBlock = view('college/college-profile-partial.collegeManagementUpdate')
                        ->with('getCollegeManagementData', $getCollegeManagementData)
                        ->render();
                    return response()->json($htmlBlock);
                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
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


    public function managementDetailsUpdatePartial(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                $collegeManagementObj = CollegeManagementDetail::where('college_management_details.id', '=', Input::get('collegeManagementDetailsId'))->firstOrFail();;
                $collegeManagementObj->suffix = Input::get('suffix');
                $collegeManagementObj->name = Input::get('name');
                $collegeManagementObj->designation = Input::get('designation');
                $collegeManagementObj->gender = Input::get('gender');
                $collegeManagementObj->emailaddress = Input::get('emailaddress');
                $collegeManagementObj->phoneno = Input::get('phoneno');
                $collegeManagementObj->landlineNo = Input::get('landlineNo');
                $collegeManagementObj->about = Input::get('about');
                $collegeManagementObj->users_id = Auth::id();
                $collegeManagementObj->employee_id = Auth::id();
                $collegeManagementObj->save();

                if($request->file('picture')){
                    $fileName = time().'-'.$userId.".".$request->picture->getClientOriginalExtension();
                    $request->picture->move(public_path('gallery/'.$request->slugUrl.'/'), $fileName);
                    DB::table('college_management_details')->where('college_management_details.id', '=', $collegeManagementObj->id)->update(array('college_management_details.picture' => $fileName));
                }
               
                //END
                Session::flash('collegeMasterCreate', 'Management details has been updated successfully!');
                //return redirect()->route('college_dash', $slugUrl);  
                return redirect('/college/dashboard/edit/'.$slugUrl.'#management');  
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }


    public function scholarshipCreatePartial( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl =Input::get('slugUrl');
            
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
                if( !empty($collegeProfileDataObj) ){
                    $collegeScholarshipObj = new CollegeScholarship;
                    $collegeScholarshipObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
                    $collegeScholarshipObj->title = Input::get('title');
                    $collegeScholarshipObj->description = Input::get('description');
                    $collegeScholarshipObj->users_id = Auth::id();
                    $collegeScholarshipObj->employee_id = Auth::id();
                    $collegeScholarshipObj->save();

                    //END
                    Session::flash('collegeMasterCreate', 'Scholarship details has been created successfully!');
                    //return redirect()->route('college_dash', $slugUrl);  
                    return redirect('/college/dashboard/edit/'.$slugUrl.'#scholarship');    
                }
                
            }else{
                //Auth::logout(); // logout user
                //return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function scholarshipDetailsPartial(Request $request)
    {
        if (Auth::check()){

            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $collegeScholarshipId = $request->collegeScholarshipId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                if($request->ajax()){
                    $collegeScholarshipsDataObj = CollegeScholarship::where('college_scholarships.id', '=', $collegeScholarshipId)
                            ->leftJoin('collegeprofile','collegeprofile.id','=','college_scholarships.collegeprofile_id')
                            ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.id', '=', $userId)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegeprofile.slug','college_scholarships.id as collegeScholarshipId', 'college_scholarships.title','college_scholarships.description', 'college_scholarships.users_id', 'college_scholarships.collegeprofile_id')
                            ->firstOrFail()
                            ;

                    $htmlBlock = view('college/college-profile-partial.scholarshipPartialUpdate')
                        ->with('collegeScholarshipsDataObj', $collegeScholarshipsDataObj)
                        ->render();
                    return response()->json($htmlBlock);
                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
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


    public function scholarshipUpdatePartial(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                $collegeScholarshipObj = CollegeScholarship::where('college_scholarships.id', '=', Input::get('collegeScholarshipId'))->firstOrFail();;
                $collegeScholarshipObj->title = Input::get('title');
                $collegeScholarshipObj->description = Input::get('description');
                $collegeScholarshipObj->users_id = Auth::id();
                $collegeScholarshipObj->employee_id = Auth::id();
                $collegeScholarshipObj->save();

                //END
                Session::flash('collegeMasterCreate', 'Scholarship details has been updated successfully!');
                return redirect('/college/dashboard/edit/'.$slugUrl.'#scholarship');  
               // return redirect()->route('college_dash', $slugUrl);  
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function galleryPartialLoad(Request $request)
    {
        $galleryId = Input::get('galleryId');
        $slugUrl = Input::get('slugUrl');
        $oldCaption = Input::get('caption');
        $htmlBlock = view('college/college-profile-partial.galleryPartialLoad')
                    ->with('galleryId', $galleryId)
                    ->with('slugUrl', $slugUrl)
                    ->with('oldCaption', $oldCaption)
                    ->render();
        return response()->json($htmlBlock);
    }

    public function galleryPartialLoadUpdate(Request $request)
    {
        $galleryId = $request->galleryId;
        $slugUrl = $request->slugUrl;
        
        $udpateGalleryObj = Gallery::where('id', '=', $galleryId)->firstOrFail();
        $udpateGalleryObj->caption = Input::get('caption');
        $udpateGalleryObj->employee_id = Auth::id();
        $udpateGalleryObj->save();

        Session::flash('collegeGalleryCaptionUpdate', 'Caption has been updated successfully!');

        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#photosvideos';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#photosvideos';
        }
        return Redirect::to($dirUrl);
    }


    public function documentPartialLoad(Request $request)
    {
        $documentId = Input::get('documentId');
        $slugUrl = Input::get('slugUrl');
        $description = Input::get('description');
        $htmlBlock = view('college/college-profile-partial.documentPartialLoad')
                    ->with('documentId', $documentId)
                    ->with('slugUrl', $slugUrl)
                    ->with('description', $description)
                    ->render();
        return response()->json($htmlBlock);
    }

    public function documentPartialLoadUpdate(Request $request)
    {
        $documentId = $request->documentId;
        $slugUrl = $request->slugUrl;
        
        $udpateGalleryObj = Document::where('id', '=', $documentId)->firstOrFail();
        $udpateGalleryObj->description = Input::get('description');
        $udpateGalleryObj->employee_id = Auth::id();
        $udpateGalleryObj->save();

        Session::flash('collegeDocumentCaptionUpdate', 'Caption has been updated successfully!');

        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#awardsach';echo $dirUrl;
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#awardsach';echo $dirUrl;
        }
        return Redirect::to($dirUrl);
    }


    public function calenderEventPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $eventId = $request->eventId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                if($request->ajax())
                {
                    $getCalenderEventData = CollegeProfile::where('event.id', '=', $eventId)
                                            ->join('users', function ($join) use ($userId) {
                                                $join->on('collegeprofile.users_id', '=','users.id')
                                                    ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                    );  
                                                })
                                            ->join('event', 'collegeprofile.id', '=', 'event.collegeprofile_id')
                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                            ->where('users.userstatus_id', '!=', '5')
                                            ->select( 'users.firstName', 'collegeprofile.slug','event.id as eventId','event.name', 'event.datetime', 'event.venue', 'event.description', 'event.link')
                                            ->firstOrFail()
                                            ;

                    $htmlBlock = view('college/college-profile-partial.calenderEventUpdate')
                        ->with('getCalenderEventData', $getCalenderEventData)->render();
                    return response()->json($htmlBlock);
                    

                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
                }
            }
            else
            {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }   
        }
        else
        {
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }  
    }

    public function eventPartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl =Input::get('slugUrl');

            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
                if( !empty($collegeProfileDataObj) ){
                    $explodDate = explode('/', Input::get('datetime'));
                    $eventObj = new Event;
                    $eventObj->name = Input::get('name');
                    //$eventObj->datetime = date('Y-m-d', strtotime(Input::get('datetime')));
                    //$eventObj->datetime = $explodDate[2].'-'.$explodDate[1].'-'.$explodDate[0];
                    $eventObj->datetime = Input::get('datetime');
                    $eventObj->venue = Input::get('venue');
                    $eventObj->description = Input::get('description');
                    $eventObj->link = Input::get('link');
                    $eventObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId; 
                    $eventObj->employee_id = Auth::id();              
                    $eventObj->save();

                    Session::flash('collegeEventcreate', 'Calender information has been created successfully!');
                   
                    //return redirect()->route('college_dash', $slugUrl); 
                    return redirect('/college/dashboard/edit/'.$slugUrl.'#events');       
                }
                
            }else{
                //Auth::logout(); // logout user
                //return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function calenderEventUpdate(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   

            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
            $explodDate = explode('/', Input::get('datetime'));
            
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                $calenderEventObj = Event::where('event.id', '=', Input::get('eventId'))->firstOrFail();
                $calenderEventObj->name = Input::get('name');
                //$calenderEventObj->datetime = $explodDate[2].'-'.$explodDate[1].'-'.$explodDate[0];
                $calenderEventObj->datetime = Input::get('datetime');
                $calenderEventObj->venue = Input::get('venue');
                $calenderEventObj->description = Input::get('description');
                $calenderEventObj->link = Input::get('link');
                $calenderEventObj->employee_id = Auth::id();   
                $calenderEventObj->save();
                
                Session::flash('collegeEventUpdate', 'Calender information has been updated successfully!');
                //return redirect()->route('college_dash', $slugUrl); 
                return redirect('/college/dashboard/edit/'.$slugUrl.'#events'); 

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function facilityPartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl =Input::get('slugUrl');

            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
                if( !empty($collegeProfileDataObj) ){

                    $eventObj = new CollegeFacility;
                    // $eventObj->name = Input::get('name');
                    $eventObj->description = Input::get('description');
                    $eventObj->facilities_id = Input::get('facilities_id');
                    $eventObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId; 
                    $eventObj->employee_id = Auth::id();                 
                    $eventObj->save();
                    
                    Session::flash('collegefacilityUpdate', 'College facility has been created successfully!');
                    //return redirect()->route('college_dash', $slugUrl);   

                    return redirect('/college/dashboard/edit/'.$slugUrl.'#facilities'); 
                }
                
            }else{
                //Auth::logout(); // logout user
                //return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function collegeFacilityPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $collegefacilitiesId = $request->collegefacilitiesId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                if($request->ajax())
                {
                    $getCollegeFacilityData = CollegeProfile::where('collegefacilities.id', '=', $collegefacilitiesId)
                                            ->join('users', function ($join) use ($userId) {
                                                $join->on('collegeprofile.users_id', '=','users.id')
                                                    ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                    );  
                                                })
                                            ->join('collegefacilities', 'collegeprofile.id', '=', 'collegefacilities.collegeprofile_id')
                                            ->leftJoin('facilities','collegefacilities.facilities_id','=','facilities.id')
                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                            ->where('users.userstatus_id', '!=', '5')
                                            ->select( 'users.id as usersId','collegefacilities.id as collegefacilitiesId','collegefacilities.name',  'collegefacilities.description','collegefacilities.facilities_id','facilities.id as facilitiesId', 'facilities.name as facilitiesName','collegeprofile.slug')
                                            ->firstOrFail()
                                            ;
                    $facilitiesTypeObj = Facility::all();                       
                    $htmlBlock = view('college/college-profile-partial.collegeFacilityUpdate')
                        ->with('getCollegeFacilityData', $getCollegeFacilityData)
                        ->with('facilitiesTypeObj',$facilitiesTypeObj)->render();
                    return response()->json($htmlBlock);
                    

                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
                }
            }
            else
            {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }   
        }
        else
        {
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }  
    }

    public function collegeFacilityUpdate(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   

            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                $collegeFacilityObj = CollegeFacility::where('collegefacilities.id', '=', Input::get('collegefacilitiesId'))->firstOrFail();
                //$collegeFacilityObj->name = Input::get('name');
                $collegeFacilityObj->description = Input::get('description');
                $collegeFacilityObj->facilities_id = Input::get('facilities_id');
                $collegeFacilityObj->employee_id = Auth::id(); 
                $collegeFacilityObj->save();

                Session::flash('collegeFacilityUpdates', 'College facility has been updated successfully!');
               
                //return redirect()->route('college_dash', $slugUrl); 
                return redirect('/college/dashboard/edit/'.$slugUrl.'#facilities');  

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function deleteEvent(Request $request, $eventId, $slugUrl)
    {   
        Event::destroy($eventId);
        //return redirect()->route('college_dash', $slugUrl);  
        return redirect('/college/dashboard/edit/'.$slugUrl.'#events');
    }


    public function deleteCollegeMaster(Request $request, $collegemasterId, $slugUrl)
    {   
        //Get Faculty Id & Remove Faculty Info
        $getFacultyId = DB::table('faculty')
                        ->leftJoin('collegeprofile', 'faculty.collegeprofile_id', '=','collegeprofile.id')
                        ->where('faculty.collegemaster_id', '=', $collegemasterId)
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->orderBy('faculty.id', 'DESC')
                        ->select('faculty.id')
                        ->get()
                        ;
        foreach ($getFacultyId as $key) {
            Faculty::destroy($key->id);    
        }
        
        CollegeMaster::destroy($collegemasterId);
        //return redirect()->route('college_dash', $slugUrl);  
        return redirect('/college/dashboard/edit/'.$slugUrl.'#courses');
    }

    public function deleteCollegeFacility(Request $request, $collegefacilitiesId, $slugUrl)
    {   
        CollegeFacility::destroy($collegefacilitiesId);
        //return redirect()->route('college_dash', $slugUrl); 
        return redirect('/college/dashboard/edit/'.$slugUrl.'#facilities');  
    }

    public function deleteCollegeManagentDetail(Request $request, $managementId, $slugUrl)
    {   
        //Get Faculty Id & Remove Faculty Info
        $getCollegeManagentDetail = DB::table('college_management_details')
                        ->leftJoin('collegeprofile', 'college_management_details.collegeprofile_id', '=','collegeprofile.id')
                        ->where('college_management_details.id', '=', $managementId)
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->orderBy('college_management_details.id', 'DESC')
                        ->select('college_management_details.id')
                        ->get()
                        ;
        if(sizeof($getCollegeManagentDetail) > 0) {
            CollegeManagementDetail::destroy($managementId);    
        }
        
        //return redirect()->route('college_dash', $slugUrl); 
        return redirect('/college/dashboard/edit/'.$slugUrl.'#management');   
    }

    public function deleteCollegeScholarship(Request $request, $scholarshipId, $slugUrl)
    {   
        //Get Faculty Id & Remove Faculty Info
        $collegeScholarships = DB::table('college_scholarships')
                        ->leftJoin('collegeprofile', 'college_scholarships.collegeprofile_id', '=','collegeprofile.id')
                        ->where('college_scholarships.id', '=', $scholarshipId)
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->orderBy('college_scholarships.id', 'DESC')
                        ->select('college_scholarships.id')
                        ->get()
                        ;
        if(sizeof($collegeScholarships) > 0) {
            CollegeScholarship::destroy($scholarshipId);    
        }
        return redirect('/college/dashboard/edit/'.$slugUrl.'#scholarship');  
        //return redirect()->route('college_dash', $slugUrl);  
    }

    public function deletePlacement(Request $request, $placementId, $slugUrl)
    {   
        //Get Faculty Id & Remove Faculty Info
        $collegePlacement = DB::table('placement')
                        ->leftJoin('collegeprofile', 'placement.collegeprofile_id', '=','collegeprofile.id')
                        ->where('placement.id', '=', $placementId)
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->orderBy('placement.id', 'DESC')
                        ->select('placement.id')
                        ->get()
                        ;
        if(sizeof($collegePlacement) > 0) {
            Placement::destroy($placementId);    
        }
        return redirect('/college/dashboard/edit/'.$slugUrl.'#placement');  
        //return redirect()->route('college_dash', $slugUrl);  
    }

    public function getAccountSettingPartials(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            $htmlBlock = view('college/college-profile-partial.getAccountSettingPartials')
                        ->with('getPreviousData', $roleGrant)
                        ->with('slugUrl', $request->slug)
                        ->render();
            return response()->json($htmlBlock);
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function getAccountSettingPartialsUpdate(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            
            //VALIDATE THE USER NOW
            $getValidateState = DB::table('collegeprofile')
                                ->where('slug', '=', $request->slugUrl)
                                ->where('collegeprofile.users_id', '=', $userId)
                                ->count()
                                ;
            if( $getValidateState == '1' ){
                
                //UPDATE COLLEGE NAME IN SLUG, GALLERY, DOCUMENT
                $slugUrlNew = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('firstname').' '.$userId);
                $slugUrlNew = strtolower($slugUrlNew);
                //Set slud in college profile
                $setSlug = CollegeProfile::where('users_id', '=', $userId)->firstOrFail();

                //Rename folder
                $slugUrlOld = $setSlug->slug;
                $directoryForDocument =  public_path().'/document/'.$slugUrlOld;
                $directoryForGallery =  public_path().'/gallery/'.$slugUrlOld;

                rename($directoryForDocument, public_path().'/document/'.$slugUrlNew);
                rename($directoryForGallery, public_path().'/gallery/'.$slugUrlNew);

                $setSlug->slug = $slugUrlNew;
                $setSlug->employee_id = Auth::id(); 
                $setSlug->save();
                //END

                $updateUsersObj = $usersObj = User::findOrFail($userId);
                $updateUsersObj->firstname = Input::get('firstname');

                if ($updateUsersObj->email != Input::get('email')) {
                    $checkUserName = DB::table('users')
                    ->where('email', '=', Input::get('email'))
                    ->count()
                    ;
                    if( $checkUserName == '0' ){
                        $updateUsersObj->email = Input::get('email');
                        $emailaddressmsg = '0';
                    }else{
                        $emailaddressmsg = '1';
                    }
                }else{
                    $emailaddressmsg = '2';
                }

               // $updateUsersObj->email = Input::get('email');
                $updateUsersObj->phone = Input::get('phone');
                if( !empty(Input::get('password')) ){
                    $updateUsersObj->password = Hash::make(Input::get('password'));    
                }
                $updateUsersObj->employee_id = Auth::id();                
                $updateUsersObj->save();

                if ($emailaddressmsg == '1') {
                    Session::flash('accountSettingsUpdate', 'Account Settings Updated. But duplicate email address found, kindly use another email address');
                }else{
                    Session::flash('accountSettingsUpdate', 'Account Settings Updated!');
                }
                return redirect()->route('college_dash', $slugUrlNew);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login        
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login    
        }
    }

    public function getAffiliattionLettersPartials(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;

            $getAffiliattionLettersObj = DB::table('collegeprofile')
                                    ->join('users', function ($join) use ($userId) {
                                        $join->on('collegeprofile.users_id', '=','users.id')
                                            ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->leftJoin('gallery', 'users.id', '=','gallery.users_id')
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->where('gallery.caption', '!=', 'videogallery')
                                    ->where('gallery.caption', '!=', 'College Logo')
                                    ->where('gallery.misc', '=', 'affiliationLettersImage')
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('collegeprofile.id as collegeprofileID', 'users.id as usersID', 'gallery.id as galleryId', 'gallery.name as galleryName', 'gallery.fullimage as galleryFullImage', 'gallery.caption')
                                    ->orderBy('gallery.id', 'ASC')
                                    ->get()
                                    ;
            if( empty($getAffiliattionLettersObj) ){
                $getAffiliattionLettersObj = '';
            }

            $dataArrayContent = array();
                $dataArray = array();
                if( empty($getAffiliattionLettersObj) ){
                    $getAffiliattionLettersObj = '';
                }else{
                    foreach ($getAffiliattionLettersObj as $item) {
                        $fileName = $item->galleryName;
                        $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                        
                        //Data Array Content
                        $dataArrayContent['collegeprofileID'] = $item->collegeprofileID;
                        $dataArrayContent['usersID'] = $item->usersID;
                        $dataArrayContent['galleryId'] = $item->galleryId;
                        $dataArrayContent['galleryName'] = $item->galleryName;
                        $dataArrayContent['galleryFullImage'] = $item->galleryFullImage;
                        $dataArrayContent['caption'] = $item->caption;
                        $dataArrayContent['ext'] = $ext;
                        $dataArray[] = $dataArrayContent;
                    }
                }

            $htmlBlock = view('college/college-profile-partial.getAffiliattionLettersPartials')
                        ->with('getPreviousData', $roleGrant)
                        ->with('slugUrl', $slugUrl)
                        ->with('getAffiliattionLettersObj', $dataArray)
                        ->render();
            return response()->json($htmlBlock);
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function affiliationPartialLoad(Request $request)
    {
        $galleryId = Input::get('galleryId');
        $slugUrl = Input::get('slugUrl');
        $oldCaption = Input::get('caption');
        $htmlBlock = view('college/college-profile-partial.affiliationPartialLoad')
                    ->with('galleryId', $galleryId)
                    ->with('slugUrl', $slugUrl)
                    ->with('oldCaption', $oldCaption)
                    ->render();
        return response()->json($htmlBlock);
    }

    public function affiliationPartialLoadpdate(Request $request)
    {
        $galleryId = $request->galleryId;
        $slugUrl = $request->slugUrl;
        
        $udpateGalleryObj = Gallery::where('id', '=', $galleryId)->firstOrFail();
        $udpateGalleryObj->caption = Input::get('caption');
        $udpateGalleryObj->employee_id = Auth::id();
        $udpateGalleryObj->save();

        Session::flash('affiliationAccreditationLetters', 'Document description has been updated successfully!');

        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#profile';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#profile';
        }
        return Redirect::to($dirUrl);
    }

    public function checkFacebookPageExists(Request $request)
    {
        $url = Input::get('facebookPageUrl');

        $channel = curl_init();
        curl_setopt($channel, CURLOPT_URL, $url);
        curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($channel, CURLOPT_TIMEOUT, 10);
        curl_setopt($channel, CURLOPT_HEADER, true);
        curl_setopt($channel, CURLOPT_NOBODY, true);
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($channel, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201');
        curl_setopt($channel, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($channel, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_exec($channel);
        $httpCode = curl_getinfo( $channel, CURLINFO_HTTP_CODE );
        curl_close($channel);
        return $httpCode;        
    }

    public function checkApplications(Request $request, $slug)
    {
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '2' && $checkRole->userstatus_id == '1' ){
                //GET AUTH AS PER COLLEGE PROFILE
                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.firstname')
                                        ->take(1)
                                        ->get()
                                        ;
                

                //Get All Applications Related to College Profile
                $getApplicationsDataObj = Application::orderBy('application.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('application.collegeprofile_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                            ->join('applicationstatus', 'application.applicationstatus_id', '=', 'applicationstatus.id')
                                            ->leftJoin('paymentstatus', 'application.paymentstatus_id', '=', 'paymentstatus.id')
                                            ->leftJoin('users', 'application.users_id','=', 'users.id')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('users.userstatus_id','!=','5')
                                            ->groupBy('application.id')
                                            ->paginate(20, array('application.id', 'application.created_at', 'applicationstatus.id as applicationstatusId','applicationstatus.name as applicationstatusName', 'percent10', 'percent11', 'percent12', 'totalfees', 'functionalarea.name as functionalareaName','degree.name as degreeName','course.name as courseName','users.firstname as userFirsrName','users.middlename as userMiddleName','users.lastname as userLastName','application.applicationID','paymentstatus.id as paymentstatusID','paymentstatus.name as paymentstatusName'))
                                            ;

                $getApplicationsDataObj1 = Application::orderBy('application.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('application.collegeprofile_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                            ->leftJoin('users', 'application.users_id','=', 'users.id')
                                            ->join('applicationstatus', 'application.applicationstatus_id', '=', 'applicationstatus.id')
                                            ->where('collegeprofile.slug', '=', $slug)
                                             ->where('users.userstatus_id','!=','5')
                                            ->groupBy('application.id')
                                            ->count()
                                            ;
                
                if( $getApplicationsDataObj1 == '0' ){
                    $getApplicationsDataObj = '';
                }

                return view('college/application.index-application')    
                        ->with('slug', $slug)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)
                        ->with('getApplicationsDataObj', $getApplicationsDataObj)
                        ;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('/'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/'); //r))edirect back to login
        }
    }

    public function checkCollegeApplications(Request $request, $option)
    {   
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '2' && $checkRole->userstatus_id == '1' ){

                $conditionQuery = '';
                if( $option == 'accepted' ){
                    $conditionQuery = '1';
                }elseif( $option == 'pending' ){
                    $conditionQuery = '2';
                }elseif( $option == 'rejected'){
                    $conditionQuery = '3';
                }elseif( $option == 'cancelled'){
                    $conditionQuery = '4';
                }else{
                    $conditionQuery = "1,2,3,4";
                }

               
                //GET AUTH AS PER College PROFILE
                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.users_id', '=', Auth::id())
                                        ->select('users.firstname','collegeprofile.slug')
                                        ->take(1)
                                        ->get()
                                        ;
                $slug = $getCollegeProfileObj[0]->slug;

                //Get All Applications Related to Student Profile
                $getApplicationsDataObj = Application::orderBy('application.id', 'DESC')
                                        ->join('collegeprofile', function ($join) use ($slug) {
                                           $join->on('application.collegeprofile_id', '=', 'collegeprofile.id')
                                                ->where('collegeprofile.slug', '=', DB::raw($slug));
                                           })
                                        ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                        ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                        ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                        ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                        ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                        ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                        ->join('applicationstatus', 'application.applicationstatus_id', '=', 'applicationstatus.id')
                                        ->leftJoin('paymentstatus', 'application.paymentstatus_id', '=', 'paymentstatus.id')
                                        ->leftJoin('users', 'application.users_id','=', 'users.id')
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->whereRaw("applicationstatus.id IN (".$conditionQuery.")")
                                        ->where('users.userstatus_id','!=','5')
                                        ->paginate(20, array('application.id', 'application.created_at', 'applicationstatus.id as applicationstatusId','applicationstatus.name as applicationstatusName', 'percent10', 'percent11', 'percent12', 'totalfees', 'functionalarea.name as functionalareaName','degree.name as degreeName','course.name as courseName','users.firstname as userFirsrName','users.middlename as userMiddleName','users.lastname as userLastName','application.applicationID','paymentstatus.id as paymentstatusID','paymentstatus.name as paymentstatusName'))
                                        ;

                $getApplicationsDataObj1 = Application::orderBy('application.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('application.collegeprofile_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                            ->leftJoin('users', 'application.users_id','=', 'users.id')
                                            ->join('applicationstatus', 'application.applicationstatus_id', '=', 'applicationstatus.id')
                                            ->whereRaw("applicationstatus.id IN (".$conditionQuery.")")
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('users.userstatus_id','!=','5')
                                            ->count()
                                            ;
                
                if( $getApplicationsDataObj1 == '0' ){
                    $getApplicationsDataObj = '';
                }
               
                return view('college/application.index-application')
                        ->with('slug', $slug)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)
                        ->with('getApplicationsDataObj', $getApplicationsDataObj)
                        ;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('/'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/'); //r))edirect back to login
        }
    }

    public function detailsForApplications(Request $request, $slug, $applicationId)
    {
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '2' && $checkRole->userstatus_id == '1' ){
                //GET AUTH AS PER COLLEGE PROFILE
                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.firstname')
                                        ->take(1)
                                        ->get()
                                        ;
                

                //Get All Applications Related to College Profile
                $getApplicationsDataObj = DB::table('application')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('application.collegeprofile_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                            ->join('applicationstatus', 'application.applicationstatus_id', '=', 'applicationstatus.id')
                                            ->leftJoin('paymentstatus', 'application.paymentstatus_id', '=', 'paymentstatus.id')
                                            ->leftJoin('users', 'application.users_id','=', 'users.id')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('application.id', '=', $applicationId)
                                            ->where('users.userstatus_id', '!=', '5')
                                            ->groupBy('application.id')
                                            ->orderBy('application.id','DESC')
                                            ->select('application.id', 'application.created_at', 'applicationstatus.id as applicationstatusId','applicationstatus.name as applicationstatusName', 'percent10', 'percent11', 'percent12', 'totalfees', 'functionalarea.name as functionalareaName','degree.name as degreeName','course.name as courseName', 'application.marksheet10','application.marksheet11', 'application.marksheet12', 'application.graduationPercent', 'application.graduationMarksheet',  'application.hobbies', 'application.interest', 'application.awards', 'application.projects', 'application.iagreeparents','application.iagreeform','application.totalfees','application.byafees','application.restfees', 'educationlevel.name as educationlevelName', 'coursetype.name as coursetypeName','users.firstname as userFirsrName','users.middlename as userMiddleName','users.lastname as userLastName','application.gender','application.dob','application.email','application.phone','application.parentname','application.parentnumber','paymentstatus.id as paymentstatusID','paymentstatus.name as paymentstatusName')
                                            ->get()
                                            ;

                //$getApplicationStatusObj = ApplicationStatus::all();
                $getApplicationStatusObj = DB::table('applicationstatus')
                                            ->whereIn('applicationstatus.id', array(1, 3))
                                            ->select('applicationstatus.id','applicationstatus.name')
                                            ->get()
                                            ;

                return view('college/application.detail-application')    
                        ->with('slug', $slug)
                        ->with('applicationId', $applicationId)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)
                        ->with('getApplicationsDataObj', $getApplicationsDataObj)
                        ->with('getApplicationStatusObj', $getApplicationStatusObj)
                        ;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('/'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/'); //r))edirect back to login
        }
    }

    public function updateApplicationStatus(Request $request)
    {   
        if( !empty(Input::get('message')) ){
            $messageText = Input::get('message');    
        }


        //Update Application Status
        $updateApplicationStatus = Application::findOrFail(Input::get('applicationId'));

        $updateApplicationStatus->applicationstatus_id = Input::get('applicationStaus');
        $updateApplicationStatus->employee_id = Auth::id();      
        $updateApplicationStatus->save();

        //SEND MAIL
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
                                ->where('application.id','=', Input::get('applicationId'))
                                ->where('u2.userstatus_id', '!=', '5')
                                ->select('u1.email as studentEmail','u1.phone as studentPhone','u2.email as collegeEmail','applicationstatus.name','application.collegemaster_id','u1.firstname as StudentFirstName','u1.middlename as studentMiddleName','u1.lastname as studentLastName','u2.firstname as collegeName','application.applicationID','u2.phone as collegePhone' ,'collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','application.byafees','application.created_at')
                                ->orderBy('application.id','DESC')
                                ->take(1)
                                ->get()
                                ;
        $collegeMasterId = $getStudentEmailAddress[0]->collegemaster_id;

        $applicationstatusId = $getStudentEmailAddress[0]->name; 
        $studentEmailId = $getStudentEmailAddress[0]->studentEmail; 
        $collegeEmailId = $getStudentEmailAddress[0]->collegeEmail;
        $studentName = $getStudentEmailAddress[0]->StudentFirstName.' '.$getStudentEmailAddress[0]->studentMiddleName.' '.$getStudentEmailAddress[0]->studentLastName;
        $collegeName = $getStudentEmailAddress[0]->collegeName;
        $applicationIDs = $getStudentEmailAddress[0]->applicationID;
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

        $applicationStatusMessageObj->application_id = Input::get('applicationId');    
        $applicationStatusMessageObj->student_id = $updateApplicationStatus->users_id; 
        $applicationStatusMessageObj->college_id = $updateApplicationStatus->collegeprofile_id; 
        $applicationStatusMessageObj->admin_id = '';
        $applicationStatusMessageObj->message = $messageText;
        $applicationStatusMessageObj->others = 'College Remarks';
        $applicationStatusMessageObj->applicationStatus = $applicationstatusId;
        $applicationStatusMessageObj->employee_id = Auth::id();
        $applicationStatusMessageObj->save();

        /*************** Update College Course Seat Approved By College ******************/
        if( Input::get('applicationStaus') == '1') 
        { 
            $collegeCourseSeatUpdate = CollegeMaster::where('collegemaster.id','=', $collegeMasterId)->firstOrFail();

            $getSeatsAllocatedToBya = $collegeCourseSeatUpdate->seatsallocatedtobya;
            if(!empty($getSeatsAllocatedToBya) && ($getSeatsAllocatedToBya != 0))
            {
                $totalRemainingSeat = $getSeatsAllocatedToBya - 1;
                $collegeCourseSeatUpdate->seatsallocatedtobya = $totalRemainingSeat;
            }
            $collegeCourseSeatUpdate->employee_id = Auth::id();
            $collegeCourseSeatUpdate->save();
            
        }

        /************ Send SMS For Approving Application*******************************/
        /* $applicationID = $request->applicationId;
        $userMobileNo =  $getStudentEmailAddress[0]->studentPhone;
        $smsMessageData = 'Thanks for approving '.$applicationID.'. Candidate will report within 15 days.';    

        if( Input::get('applicationStaus') == '1') 
        {       
            $userIdHorizonSms = Config::get('app.userIdHorizonSms');
            $passwordHorizonSms = Config::get('app.passwordHorizonSms');
            $accountFromHorizon = Config::get('app.accountFromHorizon');

            $toMobileNo = $userMobileNo;
            $message = $smsMessageData;  
            
            //extract data from the post
            //set POST variables
            $url = 'http://210.210.26.40/sendsms/push_sms.php?';
            $fields = array(
                'user' => urlencode($userIdHorizonSms),
                'pwd' => urlencode($passwordHorizonSms),
                'from' => urlencode($accountFromHorizon),
                'to' => urlencode($toMobileNo),
                'msg' => urlencode($message),
            );

            //url-ify the data for the POST
            $fields_string = '';
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');

            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

            //execute post
            $result = curl_exec($ch);

            //close connection
            curl_close($ch);
        }*/
        /************ End Send SMS *******************************/

        /************ Send SMS for Student After Approving Application*******************************/
        /*$userMobileNo =  $getStudentEmailAddress[0]->studentPhone;
        $smsMessageData = 'Your allotment letter has been mailed at your registered id, you are requested to report college within 15 days.';    

        if( Input::get('applicationStaus') == '1') 
        {       
            $userIdHorizonSms = Config::get('app.userIdHorizonSms');
            $passwordHorizonSms = Config::get('app.passwordHorizonSms');
            $accountFromHorizon = Config::get('app.accountFromHorizon');

            $toMobileNo = $userMobileNo;
            $message = $smsMessageData;  
            
            //extract data from the post
            //set POST variables
            $url = 'http://210.210.26.40/sendsms/push_sms.php?';
            $fields = array(
                'user' => urlencode($userIdHorizonSms),
                'pwd' => urlencode($passwordHorizonSms),
                'from' => urlencode($accountFromHorizon),
                'to' => urlencode($toMobileNo),
                'msg' => urlencode($message),
            );

            //url-ify the data for the POST
            $fields_string = '';
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');

            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

            //execute post
            $result = curl_exec($ch);

            //close connection
            curl_close($ch);
        }*/


        if( Input::get('applicationStaus') == '1') 
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
                    ]);*/  
                } 
            }catch (\Exception $e) {
                return $e;
            }
        }

        if( Input::get('applicationStaus') == '3') 
        {  
            try {
                if(!empty($studentPhoneNo))
                {   
                    $string = $collegeName;
                    $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 
                    $userMobileNo = $studentPhoneNo;  

                    $smsMessageData = 'Hi '.$studentNameSms.', '.(str_limit($collegeNameStr, $limit = 30, $end = '')).' '.Config::get('systemsetting.APPLICATIONREJECT').' '.Config::get('systemsetting.SMS_GROUP_NAME_3');
                    // $smsMessageData = 'Hi '.$studentName.', '.$collegeName.' has rejected your application. Please login to your account to see further details and ask for refund. '.Config::get('systemsetting.SMS_GROUP_NAME_3');     

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

        if( Input::get('applicationStaus') == '1') 
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
                    ]); */ 
                } 
            }catch (\Exception $e) {
                return $e;
            }
        }

        if( Input::get('applicationStaus') == '3') 
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
        /************ End Send SMS *******************************/
            
        if( Input::get('applicationStaus') != '2') 
        { 
            try {
                if(!empty($studentEmailId) && ($this->fetchDataServiceController->isValidEmail($studentEmailId) == 1))
                {
                        /**Swift Mailer TO Student***/        
                        \Mail::send('college/application.email.student.emailTemplate', array('email' => $studentEmailId, 'messageData' => $messageText, 'applicationstatusName' => $applicationstatusId,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationIDs, 'studentPhoneNo' => $studentPhoneNo,'courseName' => $courseName, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName,'applicationFees' => $applicationFees,'approvalDate' => $approvalDate ), function($message) use ($studentEmailId)
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
                        \Mail::send('college/application.email.college.emailTemplate', array('email' => $collegeEmailId, 'messageData' => $messageText, 'applicationstatusName' => $applicationstatusId,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationIDs, 'studentPhoneNo' => $studentPhoneNo,'courseName' => $courseName, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName,'applicationFees' => $applicationFees,'approvalDate' => $approvalDate, 'studentEmailId' => $studentEmailId ), function($message) use ($collegeEmailId)
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
                        \Mail::send('college/application.email.cancelAdmission', array('email' => $adminEmailId, 'messageData' => $messageText, 'applicationstatusName' => $applicationstatusId ), function($message) use ($adminEmailId)
                        {
                            $message->to($adminEmailId, 'AdmissionX')->subject('Remarks Admission Status');
                        });  
                    }
                }catch ( \Swift_TransportException $e) {                
                }
            }

        }



        return Redirect::back();
    }

    public function checkMatrixForCollege(Request $request, $slug)
    {
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '2' && $checkRole->userstatus_id == '1' ){
                //GET AUTH AS PER COLLEGE PROFILE
                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.firstname','collegeprofile.id')
                                        ->take(1)
                                        ->get()
                                        ;
                
                //GET TOTAL COUNT.
                $getAllCollege = DB::table('collegelog')
                                    ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                    ->count()
                                    ;
                $getAllCourseCounter = DB::table('collegelog')
                                            ->where('collegelog.course_id','!=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getAllApplicationCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getAllCollegeQuery = DB::table('query')
                                    ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                    ->count()
                                    ;

                //GET ALL USERS VISITS IN THE LAST 24H.
                $getAllLastTodayCollegeCounter = DB::table('collegelog')
                                            ->whereRaw('collegelog.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('collegelog.course_id','=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getAllLastTodayCourseCounter = DB::table('collegelog')
                                            ->whereRaw('collegelog.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('collegelog.course_id','!=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getAllLastTodayApplicationCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getAllRejectTodayApplicationCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->where('application.applicationstatus_id','=', '3')
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getAllAcceptTodayApplicationCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->where('application.applicationstatus_id','=', '1')
                                            ->where('application.paymentstatus_id','=', '1')
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getAllTodayCollegeQueryPending = DB::table('query')
                                            ->whereRaw('query.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('query.querytypeinfo','=', 'pending')
                                            ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('query.college_id')
                                            ->orderBy('query.college_id', 'ASC')
                                            ->count()
                                            ;

                $getAllTodayCollegeQueryReply = DB::table('query')
                                            ->whereRaw('query.created_at BETWEEN "'.date('Y-m-d 00:00:00').'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('query.querytypeinfo', '=', 'replied')
                                            ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('query.college_id')
                                            ->orderBy('query.college_id', 'ASC')
                                            ->count()
                                            ;

                //GET ALL USERS VISITS IN THE CURRENT WEEK.
                $getCurrentWeekCollege = DB::table('collegelog')
                                            ->whereRaw('collegelog.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('collegelog.course_id','=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getCurrentWeekCourse = DB::table('collegelog')
                                            ->whereRaw('collegelog.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('collegelog.course_id','!=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getCurrentWeekApplication = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getCurrentweekCollegeQueryPending = DB::table('query')
                                            ->whereRaw('query.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('query.querytypeinfo','=', 'pending')
                                            ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('query.college_id')
                                            ->orderBy('query.college_id', 'ASC')
                                            ->count()
                                            ;

                $getCurrentweekCollegeQueryReply = DB::table('query')
                                            ->whereRaw('query.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('query.querytypeinfo', '=', 'replied')
                                            ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('query.college_id')
                                            ->orderBy('query.college_id', 'ASC')
                                            ->count()
                                            ;

                $getAllRejectWeekApplicationCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->where('application.applicationstatus_id','=', '3')
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getAllAcceptWeekApplicationCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-7 days')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->where('application.applicationstatus_id','=', '1')
                                            ->where('application.paymentstatus_id','=', '1')
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                
                //GET ALL USERS VISITS IN THE CURRENT MONTH.
                $getCurrentMonthCollege = DB::table('collegelog')
                                            ->whereRaw('MONTH(collegelog.created_at) = "'.date('m').'"')
                                            ->where('collegelog.course_id','=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getCurrentMonthCourse = DB::table('collegelog')
                                            ->whereRaw('MONTH(collegelog.created_at) = "'.date('m').'"')
                                            ->where('collegelog.course_id','!=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getCurrentMonthApplication = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('MONTH(application.created_at) = "'.date('m').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getMonthRejectApplicationCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('MONTH(application.created_at) = "'.date('m').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->where('application.applicationstatus_id','=', '3')
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getMonthAcceptApplicationCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('MONTH(application.created_at) = "'.date('m').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->where('application.applicationstatus_id','=', '1')
                                            ->where('application.paymentstatus_id','=', '1')
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getCurrentMonthCollegeQueryPending = DB::table('query')
                                            ->whereRaw('MONTH(query.created_at) = "'.date('m').'"')
                                            ->where('query.querytypeinfo','=', 'pending')
                                            ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('query.college_id')
                                            ->orderBy('query.college_id', 'ASC')
                                            ->count()
                                            ;

                $getCurrentMonthCollegeQueryReply = DB::table('query')
                                            ->whereRaw('MONTH(query.created_at) = "'.date('m').'"')
                                            ->where('query.querytypeinfo', '=', 'replied')
                                            ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('query.college_id')
                                            ->orderBy('query.college_id', 'ASC')
                                            ->count()
                                            ;

                //GET ALL USERS VISITS IN THE LAST 3 MONTHS.
                $getCurrentThreeMonthCollege = DB::table('collegelog')
                                            ->whereRaw('collegelog.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('collegelog.course_id','=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getCurrentThreeMonthCourse = DB::table('collegelog')
                                            ->whereRaw('collegelog.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('collegelog.course_id','!=', '0')
                                            ->where('collegelog.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('collegelog.college_id')
                                            ->orderBy('collegelog.college_id', 'ASC')
                                            ->count()
                                            ;
                $getCurrentThreeMonthApplication = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getThreeMonthRejectApplCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->where('application.applicationstatus_id','=', '3')
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getThreeMonthAcceptApplCounter = DB::table('application')
                                            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
                                            ->whereRaw('application.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('application.collegeprofile_id', '=', $getCollegeProfileObj[0]->id)
                                            ->where('application.applicationstatus_id','=', '1')
                                            ->where('application.paymentstatus_id','=', '1')
                                            ->groupBy('application.collegeprofile_id')
                                            ->orderBy('application.collegeprofile_id', 'ASC')
                                            ->count()
                                            ;

                $getThreeMonthCollegeQueryPending = DB::table('query')
                                            ->whereRaw('query.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('query.querytypeinfo','=', 'pending')
                                            ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('query.college_id')
                                            ->orderBy('query.college_id', 'ASC')
                                            ->count()
                                            ;

                $getThreeMonthCollegeQueryReply = DB::table('query')
                                            ->whereRaw('query.created_at BETWEEN "'.date('Y-m-d 00:00:00', strtotime('-3 months')).'" AND "'.date('Y-m-d 23:59:59').'"')
                                            ->where('query.querytypeinfo', '=', 'replied')
                                            ->where('query.college_id', '=', $getCollegeProfileObj[0]->id)
                                            ->groupBy('query.college_id')
                                            ->orderBy('query.college_id', 'ASC')
                                            ->count()
                                            ;

                return view('college/college-profile-partial.college-matrix')
                        ->with('slug', $slug)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)

                        ->with('getAllCollege', $getAllCollege)
                        ->with('getAllCourseCounter', $getAllCourseCounter)
                        ->with('getAllApplicationCounter', $getAllApplicationCounter)
                        ->with('getAllCollegeQuery', $getAllCollegeQuery)

                        ->with('getAllLastTodayCollegeCounter', $getAllLastTodayCollegeCounter)
                        ->with('getAllLastTodayCourseCounter', $getAllLastTodayCourseCounter)
                        ->with('getAllLastTodayApplicationCounter', $getAllLastTodayApplicationCounter)
                        ->with('getAllTodayCollegeQueryPending', $getAllTodayCollegeQueryPending)
                        ->with('getAllTodayCollegeQueryReply', $getAllTodayCollegeQueryReply)
                        ->with('getAllRejectTodayApplicationCounter', $getAllRejectTodayApplicationCounter)
                        ->with('getAllAcceptTodayApplicationCounter', $getAllAcceptTodayApplicationCounter)

                        ->with('getCurrentWeekCollege', $getCurrentWeekCollege)
                        ->with('getCurrentWeekCourse', $getCurrentWeekCourse)
                        ->with('getCurrentWeekApplication', $getCurrentWeekApplication)
                        ->with('getCurrentweekCollegeQueryPending', $getCurrentweekCollegeQueryPending)
                        ->with('getCurrentweekCollegeQueryReply', $getCurrentweekCollegeQueryReply)
                        ->with('getAllRejectWeekApplicationCounter', $getAllRejectWeekApplicationCounter)
                        ->with('getAllAcceptWeekApplicationCounter', $getAllAcceptWeekApplicationCounter)
                        
                        ->with('getCurrentMonthCollege', $getCurrentMonthCollege)
                        ->with('getCurrentMonthCourse', $getCurrentMonthCourse)
                        ->with('getCurrentMonthApplication', $getCurrentMonthApplication)
                        ->with('getCurrentMonthCollegeQueryPending', $getCurrentMonthCollegeQueryPending)
                        ->with('getCurrentMonthCollegeQueryReply', $getCurrentMonthCollegeQueryReply)
                        ->with('getMonthRejectApplicationCounter', $getMonthRejectApplicationCounter)
                        ->with('getMonthAcceptApplicationCounter', $getMonthAcceptApplicationCounter)
                        
                        ->with('getCurrentThreeMonthCollege', $getCurrentThreeMonthCollege)
                        ->with('getCurrentThreeMonthCourse', $getCurrentThreeMonthCourse)
                        ->with('getCurrentThreeMonthApplication', $getCurrentThreeMonthApplication)
                        ->with('getThreeMonthCollegeQueryPending', $getThreeMonthCollegeQueryPending)
                        ->with('getThreeMonthCollegeQueryReply', $getThreeMonthCollegeQueryReply)
                        ->with('getThreeMonthRejectApplCounter', $getThreeMonthRejectApplCounter)
                        ->with('getThreeMonthAcceptApplCounter', $getThreeMonthAcceptApplCounter)
                        ;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('/'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/'); //r))edirect back to login
        }
    }


     public function collegeTermsConditions(Request $request, $slug)
    {
        if(Auth::check()){
            $checkRole = User::where('id', '=', Auth::id())->get()->first();
            if( $checkRole->userrole_id == '2' && $checkRole->userstatus_id == '1' ){
                //GET AUTH AS PER COLLEGE PROFILE
                $getCollegeProfileObj = DB::table('users')
                                        ->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.firstname','collegeprofile.id')
                                        ->take(1)
                                        ->get()
                                        ;
                
                

                return view('college/college-profile-partial.college-terms-conditions')
                        ->with('slug', $slug)
                        ->with('getCollegeProfileObj', $getCollegeProfileObj)
                        ;
            }else{
                Auth::logout(); // logout user
                return Redirect::to('/'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('/'); //r))edirect back to login
        }
    }

    /*public function AddBulkCollegeData(Request $request)
    {
        $getAllCollegeData = DB::table('collegeData')
                ->select('collegeData.id','collegeName', 'contactNo', 'collegeEmail', 'description')
                ->orderBy('collegeData.id', 'ASC')
                ->get();

        //->where('collegeData.id', '>', '39') 
        //echo "<pre>";
        //print_r($getAllCollegeData);die;

        foreach ($getAllCollegeData as $key) {
            $value = $key->id;

            $getCollegeData = DB::table('collegeData')
                ->select('collegeData.id','collegeName', 'contactNo', 'collegeEmail', 'description')
                ->where('collegeData.id', '=', $value)
                ->orderBy('collegeData.id', 'ASC')
                ->get();


            $email = $getCollegeData[0]->collegeEmail;
            $collegeName = $getCollegeData[0]->collegeName;
            $contactNumber = $getCollegeData[0]->contactNo;
            $password = "welcome@123";
            $description = $getCollegeData[0]->description;

            //Check for already existing account
            $checkEmailDuplicateObj = DB::table('users')
                                        ->where('email' ,'=', $email)
                                        ->take(1)
                                        ->get()
                                        ;
            if( empty($checkEmailDuplicateObj) ){
                //STORE INTO USERS TABLE
                $userObj = New User;
                $userObj->email = $email;
                $userObj->firstName = $collegeName;
                $userObj->password = Hash::make($password);
                $userObj->phone = $contactNumber;
                $userObj->userstatus_id = '1'; //Inasctive
                $userObj->userrole_id = '2'; //ROLE_COLLEGE 

                $encrytEmail = md5($email);
                $userObj->token = $encrytEmail;

                $userObj->save();


                $getEmailWiseUserId = User::where('email', '=', $email)->firstOrFail();

                //STORE INTO COLLEGEPROFILES TABLE FOR CREATE RECORD
                $collegeProfileObj = New CollegeProfile;
                $collegeProfileObj->users_id = $getEmailWiseUserId->id;
                $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getEmailWiseUserId->firstname.' '.$getEmailWiseUserId->id);
                $slugUrl = strtolower($slugUrl);
                $collegeProfileObj->slug = strtolower($slugUrl);
                $collegeProfileObj->description = $description;
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
                $createGalleryCollegeLogo->users_id = $getEmailWiseUserId->id;

                $createGalleryCollegeLogo->save();

                //GET COLLEGE PROFILE ID AS PER SLUG
                $getCollProId = CollegeProfile::where('slug', '=', $slugUrl)->firstOrFail();
                //STORE INTO ADDRESS TABLE FOR CREATE RECORD
                //For Registered address
                $addressObj = New Address;
                $addressObj->addresstype_id = '1';
                $addressObj->collegeprofile_id = $getCollProId->id;
                $addressObj->save();

                //For Campus address
                $addressObj = New Address;
                $addressObj->addresstype_id = '2';
                $addressObj->collegeprofile_id = $getCollProId->id;
                $addressObj->save();

                $placementObj = New Placement;
                $placementObj->collegeprofile_id = $getCollProId->id;
                $placementObj->save();

            }


        }
         echo "successfully added";
    }*/


    /*public function AddUsaCollegeData(Request $request)
    {
        $getAllCollegeData = DB::table('collegeData')
                ->select('collegeData.id','collegeName', 'collegeEmail')
                ->where('collegeName', '!=', '')
                ->get();

       
        // echo "<pre>";
        // print_r($getAllCollegeData);die;

        foreach ($getAllCollegeData as $key) {
            $value = $key->id;

            $getCollegeData = DB::table('collegeData')
                ->select('collegeData.id','collegeName', 'address', 'contactPersionName', 'contactPersionEmail', 'contactPersionMobile', 'collegeCode', 'collegeWebsite', 'collegeAboutLongDesc', 'establishedYear', 'approvedBy', 'collegeEmail', 'collegeMobileNo', 'collegePhoneNo', 'UniversityId','cityID')
                ->where('collegeData.id', '=', $value)
                ->orderBy('collegeData.id', 'ASC')
                ->get();


            $email = $getCollegeData[0]->collegeEmail;
            $collegeName = $getCollegeData[0]->collegeName;
            $contactNumber = $getCollegeData[0]->collegePhoneNo;
            $password = "welcome@123";
            $description = $getCollegeData[0]->collegeAboutLongDesc;
            $contactPersionName = $getCollegeData[0]->contactPersionName;
            $contactPersionEmail = $getCollegeData[0]->contactPersionEmail;
            $contactPersionMobile = $getCollegeData[0]->contactPersionMobile;
            $establishedYear = $getCollegeData[0]->establishedYear;
            $approvedBy = $getCollegeData[0]->approvedBy;
            $cityID = $getCollegeData[0]->cityID;
            $address = $getCollegeData[0]->address;
            $collegeCode = $getCollegeData[0]->collegeCode;
            $collegeWebsite = $getCollegeData[0]->collegeWebsite;
            $UniversityId = $getCollegeData[0]->UniversityId;

            //Check for already existing account
            $checkEmailDuplicateObj = DB::table('users')
                                        ->where('email' ,'=', $email)
                                        ->take(1)
                                        ->get()
                                        ;
            if( empty($checkEmailDuplicateObj) ){
                //STORE INTO USERS TABLE
                $userObj = New User;
                $userObj->email = $email;
                $userObj->firstName = $collegeName;
                $userObj->password = Hash::make($password);
                $userObj->phone = $contactNumber;
                $userObj->userstatus_id = '1'; //Inasctive
                $userObj->userrole_id = '2'; //ROLE_COLLEGE 

                $encrytEmail = md5($email);
                $userObj->token = $encrytEmail;

                $userObj->save();


                $getEmailWiseUserId = User::where('email', '=', $email)->firstOrFail();

                //STORE INTO COLLEGEPROFILES TABLE FOR CREATE RECORD
                $collegeProfileObj = New CollegeProfile;
                $collegeProfileObj->users_id = $getEmailWiseUserId->id;
                $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getEmailWiseUserId->firstname.' '.$getEmailWiseUserId->id);
                $slugUrl = strtolower($slugUrl);
                $collegeProfileObj->slug = strtolower($slugUrl);
                $collegeProfileObj->description = $description;
                $collegeProfileObj->estyear = $establishedYear;
                $collegeProfileObj->website = $collegeWebsite;
                $collegeProfileObj->collegecode = $collegeCode;
                $collegeProfileObj->contactpersonname = $contactPersionName;
                $collegeProfileObj->contactpersonemail = $contactPersionEmail;
                $collegeProfileObj->contactpersonnumber = $contactPersionMobile;
                $collegeProfileObj->review = '1';
                $collegeProfileObj->verified = '1';
                $collegeProfileObj->approvedBy = $approvedBy;
                $collegeProfileObj->university_id = $UniversityId;
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
                $createGalleryCollegeLogo->users_id = $getEmailWiseUserId->id;

                $createGalleryCollegeLogo->save();

                //GET COLLEGE PROFILE ID AS PER SLUG
                $getCollProId = CollegeProfile::where('slug', '=', $slugUrl)->firstOrFail();
                //STORE INTO ADDRESS TABLE FOR CREATE RECORD
                //For Registered address
                $addressObj1 = New Address;
                $addressObj1->addresstype_id = '1';
                $addressObj1->name = $address;
                $addressObj1->city_id = $cityID;
                $addressObj1->collegeprofile_id = $getCollProId->id;
                $addressObj1->save();

                
                //For Campus address
                $addressObj2 = New Address;
                $addressObj2->addresstype_id = '2';
                $addressObj2->name = $address;
                $addressObj2->city_id = $cityID;
                $addressObj2->collegeprofile_id = $getCollProId->id;
                $addressObj2->save();

                $placementObj = New Placement;
                $placementObj->collegeprofile_id = $getCollProId->id;
                $placementObj->save();

                $seoContentObj = New SeoContent;
                $seoContentObj->pagetitle = $collegeName;
                $seoContentObj->misc = 'collegepage';
                $seoContentObj->collegeId = $getCollProId->id;
                $seoContentObj->employee_id = Auth::id();
                $seoContentObj->save();

            }


        }
         echo "successfully added";
    }

    */

   /* public function addUnivercityData(Request $request)
    {
        $getAllCollegeData = DB::table('collegeData')
                ->select('collegeData.id','universityName')
                ->where('universityName', '!=', '')
                ->get();
                // echo "<pre>";
                // print_r($getAllCollegeData);die;

        //Add University

        foreach ($getAllCollegeData as $key) {
            $value = $key->universityName;

            $checkEmailDuplicateObj = DB::table('university')
                                        ->where('name' ,'=', $value)
                                        ->select('id')
                                        ->take(1)
                                        ->get()
                                        ;

            //DB::table('collegeData')->where('collegeData.universityName', '=', $value)->update(array('collegeData.UniversityId' => $checkEmailDuplicateObj[0]->id));


                                       // print_r($checkEmailDuplicateObj);die;

            if (empty($checkEmailDuplicateObj)) {
                $universityObj = New University;
                $universityObj->name = $value;
                $universityObj->save();

                //DB::insert('insert into university (name) values(?)', [$value]);
            }
        } 
        echo "successfully added";
    }*/

    public function addUpdteCityData(Request $request)
    {
        $getAllCollegeData = DB::table('collegeData')
                ->select('collegeData.id','state','city')
                ->where('city', '!=', '')
                ->get();
                // echo "<pre>";
                // print_r($getAllCollegeData);die;

        //Add University

        foreach ($getAllCollegeData as $key) {
            $value = $key->state;
            $value1 = $key->city;


            $checkEmailDuplicateObj = DB::table('city')
                                        ->leftjoin('state', 'city.state_id','=', 'state.id')
                                        ->where('city.name' ,'=', $value1)
                                        ->where('')
                                        ->select('city.id','city.name as cityName','state.name as stateName')
                                        ->get()
                                        ;


print_r($checkEmailDuplicateObj);die;

            //DB::table('collegeData')->where('collegeData.universityName', '=', $value)->update(array('collegeData.UniversityId' => $checkEmailDuplicateObj[0]->id));


                                       // print_r($checkEmailDuplicateObj);die;

            /*if (empty($checkEmailDuplicateObj)) {
                $universityObj = New University;
                $universityObj->name = $value;
                $universityObj->save();

                //DB::insert('insert into university (name) values(?)', [$value]);
            }*/
        } 
        echo "successfully added";
    }

    /*public function updateStateId(Request $request)
    {
        $getAllstateData = DB::table('state')
                ->select('state.id','name', 'stateid')
                ->orderBy('state.id', 'ASC')
                ->get();

        foreach ($getAllstateData as $key) {
            $value = $key->stateid;
            $value1 = $key->id;

            DB::table('college_details')->where('college_details.state_id', '=', $value)->update(array('college_details.state_id' => $value1));

        }
         echo "successfully added";
    }

    public function updateCityId(Request $request)
    {
        $getAllCityData = DB::table('city')
                ->select('city.id','name', 'cityid')
                ->orderBy('city.id', 'ASC')
                ->get();

        foreach ($getAllCityData as $key) {
            $value = $key->cityid;
            $value1 = $key->id;

            DB::table('college_details')->where('college_details.city', '=', $value)->update(array('college_details.city' => $value1));

        }
         echo "successfully added";
    }*/

    /*public function updateCollegeUnivertityData(Request $request)
    {
        $getAllCollegeData = DB::table('college_details')
                ->select('college_details.id','college_name','college_admin_id','university_name')
                ->orderBy('college_details.id', 'ASC')
                ->get();

        //Add University

        foreach ($getAllCollegeData as $key) {
            $value = $key->id;

            $getCollegeData = DB::table('college_details')
                ->leftJoin('college_admin', 'college_details.college_admin_id','=', 'college_admin.id')
                ->select('college_details.id','college_admin_id', 'college_name', 'college_code', 'college_website','college_email','college_details.country_id','college_details.contact_number','college_details.contact_name','college_details.state_id','college_details.city','college_details.address','college_details.pincode','university_name', 'college_description', 'college_establish_year', 'college_aicte','college_admin.email')
                ->where('college_details.id', '=', $value)
                ->orderBy('college_details.id', 'ASC')
                ->get();

            if ($getCollegeData[0]->university_name != '' ) {
                $universityName = $getCollegeData[0]->university_name;
            }
            

            $checkEmailDuplicateObj = DB::table('university')
                                        ->where('name' ,'=', $universityName)
                                        ->take(1)
                                        ->get()
                                        ;

            if (empty($checkEmailDuplicateObj)) {
                $addressObj = New University;
                $addressObj->name = $universityName;
                $addressObj->save();
            }
        } 
        echo "successfully added";
        
        //Update University Id
        $getAllCityData = DB::table('university')
                ->select('university.id','name')
                ->orderBy('university.id', 'ASC')
                ->get();

        foreach ($getAllCityData as $key) {
            $value = $key->name;
            $value1 = $key->id;

            DB::table('college_details')->where('college_details.university_name', '=', $value)->update(array('college_details.university_name' => $value1));

        }
               
        //echo "successfully added";
    }*/

    public function AddOldCollegeData(Request $request)
    {
        $getAllCollegeData = DB::table('college_details')
                ->select('college_details.id','college_name','college_admin_id','college_email')
                ->where('college_email', '!=', '')
                ->orderBy('college_details.id', 'ASC')
                ->get();
                
        //->where('collegeData.id', '>', '39') 
        echo "<pre>";
        print_r($getAllCollegeData);die;

        foreach ($getAllCollegeData as $key) {
            $value = $key->id;

            /*$getCollegeData = DB::table('college_details')
                ->leftJoin('college_admin', 'college_details.college_admin_id','=', 'college_admin.id')
                ->select('college_details.id','college_admin_id', 'college_name', 'college_code', 'college_website','college_email','college_details.country_id','college_details.contact_number','college_details.contact_name','college_details.state_id','college_details.city','college_details.address','college_details.pincode','university_name', 'college_description', 'college_establish_year', 'college_aicte','college_admin.email')
                ->where('college_details.id', '=', $value)
                ->orderBy('college_details.id', 'ASC')
                ->get();*/

            $getCollegeData = DB::table('college_details')
                ->select('college_details.id','college_admin_id', 'college_name', 'college_code', 'college_website','college_email','college_details.country_id','college_details.contact_number','college_details.contact_name','college_details.state_id','college_details.city','college_details.address','college_details.pincode','university_name', 'college_description', 'college_establish_year', 'college_aicte')
                ->where('college_details.id', '=', $value)
                ->orderBy('college_details.id', 'ASC')
                ->get();
            
            //$email = $getCollegeData[0]->email;
            $collegeName = $getCollegeData[0]->college_name;
            $contactNumber = $getCollegeData[0]->contact_number;
            $password = "welcome@123";
            $description = $getCollegeData[0]->college_description;
            $collegecode = $getCollegeData[0]->college_code;
            $website = $getCollegeData[0]->college_website;
            $contactName = $getCollegeData[0]->contact_name;
            $calenderinfo =  $getCollegeData[0]->id;
            //$establishYear = $getCollegeData[0]->college_establish_year;
            if ($getCollegeData[0]->college_email != '0' && $getCollegeData[0]->college_email != 'NA' && $getCollegeData[0]->college_email != 'na') {
                $collegeEmail = $getCollegeData[0]->college_email;
            }elseif ($getCollegeData[0]->college_email == '0' && $getCollegeData[0]->college_email == 'NA' && $getCollegeData[0]->college_email == 'na' ) {
                $collegeEmail = $getCollegeData[0]->college_website;
            }else{
                $collegeEmail = $contactNumber;
            }
            

            if ($getCollegeData[0]->college_establish_year != 0 ) {
                $establishYear = $getCollegeData[0]->college_establish_year;
            }else{
                $establishYear = '';
            }

            if ($getCollegeData[0]->address != '' ) {
                $address = $getCollegeData[0]->address;
            }else{
                $address = '';
            }

            if ($getCollegeData[0]->pincode != '' ) {
                $pincode = $getCollegeData[0]->pincode;
            }else{
                $pincode = null;
            }

            if ($getCollegeData[0]->university_name != '' ) {
                $universityName = $getCollegeData[0]->university_name;
            }else{
                $universityName = null;
            }

            if ($getCollegeData[0]->city != '' ) {
                $cityName = $getCollegeData[0]->city;
            }else{
                $cityName = null;
            }

            //$collegeEmail = preg_replace('/\s+/', '', $collegeEmail);
            
            //Check for already existing account
            $checkEmailDuplicateObj = DB::table('users')
                                        ->where('email' ,'=', $collegeEmail)
                                        ->take(1)
                                        ->get()
                                        ;
            if( empty($checkEmailDuplicateObj) ){
                //STORE INTO USERS TABLE
                $userObj = New User;
                $userObj->email = $collegeEmail;
                $userObj->firstName = $collegeName;
                $userObj->password = Hash::make($password);
                $userObj->phone = $contactNumber;
                $userObj->userstatus_id = '1'; //Inasctive
                $userObj->userrole_id = '2'; //ROLE_COLLEGE 

                $encrytEmail = md5($collegeEmail);
                $userObj->token = $encrytEmail;

                $userObj->save();


                $getEmailWiseUserId = User::where('email', '=', $collegeEmail)->firstOrFail();

                //STORE INTO COLLEGEPROFILES TABLE FOR CREATE RECORD
                $collegeProfileObj = New CollegeProfile;
                $collegeProfileObj->users_id = $getEmailWiseUserId->id;
                $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getEmailWiseUserId->firstname.' '.$getEmailWiseUserId->id);
                $slugUrl = strtolower($slugUrl);
                $collegeProfileObj->slug = strtolower($slugUrl);
                $collegeProfileObj->description = $description;

                $collegeProfileObj->calenderinfo = $calenderinfo;
                $collegeProfileObj->estyear = $establishYear;
                $collegeProfileObj->website = $website;
                $collegeProfileObj->collegecode = $collegecode;
                $collegeProfileObj->contactpersonname = $contactName;
                $collegeProfileObj->contactpersonemail = $collegeEmail;
                $collegeProfileObj->contactpersonnumber = $contactNumber;
                $collegeProfileObj->approvedBy = 'AICTE';
                $collegeProfileObj->review = '0';
                $collegeProfileObj->agreement = '0';
                $collegeProfileObj->verified = '0';
                $collegeProfileObj->advertisement = '0';
                $collegeProfileObj->university_id = $universityName;
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
                $createGalleryCollegeLogo->users_id = $getEmailWiseUserId->id;

                $createGalleryCollegeLogo->save();

                //GET COLLEGE PROFILE ID AS PER SLUG
                $getCollProId = CollegeProfile::where('slug', '=', $slugUrl)->firstOrFail();
                //STORE INTO ADDRESS TABLE FOR CREATE RECORD
                //For Registered address
                $addressObj = New Address;
                $addressObj->addresstype_id = '1';
                $addressObj->collegeprofile_id = $getCollProId->id;
                $addressObj->name = $address;
                $addressObj->postalcode = $pincode;
                $addressObj->city_id = $cityName;
                
                $addressObj->save();

                //For Campus address
                $addressObj2 = New Address;
                $addressObj2->addresstype_id = '2';
                $addressObj2->collegeprofile_id = $getCollProId->id;
                $addressObj2->save();

                $placementObj = New Placement;
                $placementObj->collegeprofile_id = $getCollProId->id;
                $placementObj->save();

                $seoContentObj = New SeoContent;
                $seoContentObj->pagetitle = $collegeName;
                $seoContentObj->misc = 'collegepage';
                $seoContentObj->collegeId = $getCollProId->id;
                $seoContentObj->employee_id = Auth::id();
                $seoContentObj->save();

            }

        }
        echo "successfully added";
    }

    public function AddOldCollegeCourseData(Request $request)
    {
        $getAllCollegeCourseData = DB::table('college_courses')
                ->select('college_courses.id','college_id','course_name')
                ->orderBy('college_courses.id', 'ASC')
                ->get();
                
        echo "<pre>";
        print_r($getAllCollegeCourseData);die;

        foreach ($getAllCollegeCourseData as $key) {
            $value = $key->id;
            $CollegeID = $key->college_id;
            $courseId = $key->course_name;

            $getCollegeData = DB::table('college_courses')
                ->leftJoin('collegeprofile', 'college_courses.college_id','=', 'collegeprofile.calenderinfo')
                ->leftjoin('course', 'college_courses.course_name', '=', 'course.id')
                ->leftjoin('degree', 'degree.id', '=', 'course.degree_id')
                ->leftjoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                ->select('college_courses.id','college_id', 'course_name', 'functional_area', 'course_level', 'course_type', 'eligibility', 'course_fee', 'course_duration', 'no_of_seats', 'total_seats','collegeprofile.id as collegeprofileId','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','course.id as courseID','course.name as courseName')
                ->where('college_courses.id','=', $value)
                ->orderBy('college_courses.id', 'ASC')
                ->get();

           
            if ($getCollegeData[0]->collegeprofileId != '') {
                # code...
                $CollegeProfileId = $getCollegeData[0]->collegeprofileId;
                $functionalareaId = $getCollegeData[0]->functionalareaID;
                $degreeId = $getCollegeData[0]->degreeId;
                $courseID = $getCollegeData[0]->courseID;
                $courseLevel = $getCollegeData[0]->course_level;
                $educationlevelId = $getCollegeData[0]->eligibility;
                $courseFee = $getCollegeData[0]->course_fee;
                $courseDuration = $getCollegeData[0]->course_duration;
                $totalSeats = $getCollegeData[0]->total_seats;
                $byaSeats =  $getCollegeData[0]->no_of_seats;
                
                /*** College Profile Details **/
               
                $collegeMasterObj = new CollegeMaster;
                $collegeMasterObj->collegeprofile_id = $CollegeProfileId;
                $collegeMasterObj->educationlevel_id = $educationlevelId;
                $collegeMasterObj->functionalarea_id = $functionalareaId;
                $collegeMasterObj->degree_id = $degreeId;
                $collegeMasterObj->course_id = $courseID;
                $collegeMasterObj->coursetype_id = $courseLevel;
                $collegeMasterObj->fees = $courseFee;
                $collegeMasterObj->seats = $totalSeats;
                $collegeMasterObj->seatsallocatedtobya = $byaSeats;
                $collegeMasterObj->courseduration = $courseDuration;
                $collegeMasterObj->save();
            }
        }
        echo "successfully added";
    }

    public function AddFacultyName(Request $request)
    {
        $getAllCollegeCourseData = DB::table('collegemaster')
                ->select('collegemaster.id','collegeprofile_id')
                ->orderBy('collegemaster.id', 'ASC')
                ->get();
                
        foreach ($getAllCollegeCourseData as $key) {
            $value = $key->id;
            
            $getLatestCollegeMasterID = DB::table('collegemaster')
                                    ->where('collegemaster.id', '=', $value)
                                    ->select('collegemaster.id','collegeprofile_id')
                                    ->orderBy('id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
            //CREATE ROWS IN FACULTY TABLE
            for ($counter=1; $counter <= 6; $counter++) { 
                $facultyTableObj = new Faculty;
                $facultyTableObj->sortorder = $counter;
                $facultyTableObj->collegemaster_id = $getLatestCollegeMasterID[0]->id;
                $facultyTableObj->collegeprofile_id = $getLatestCollegeMasterID[0]->collegeprofile_id;
                $facultyTableObj->save();
            }
        }
        echo "successfully added";
        //GET LATEST COLLEGE MASTER ID
    }

    public function AddFacilityName($value='')
    {
        $getAllCollegeCourseData = DB::table('collegeprofile')
                ->select('collegeprofile.id')
                ->orderBy('collegeprofile.id', 'ASC')
                ->get();
                
        echo "<pre>";
        print_r($getAllCollegeCourseData);die;

        foreach ($getAllCollegeCourseData as $key) {
            $value = $key->id;
            
            $getLatestCollegeMasterID = DB::table('collegeprofile')
                                    ->where('collegeprofile.id', '=', $value)
                                    ->select('collegeprofile.id')
                                    ->orderBy('id', 'DESC')
                                    ->take(1)
                                    ->get();

            for ($counter=1; $counter <= 9; $counter++) { 
                $collegeFacilityTableObj = new CollegeFacility;
                $collegeFacilityTableObj->facilities_id = $counter;
                $collegeFacilityTableObj->collegeprofile_id = $getLatestCollegeMasterID[0]->id;
                $collegeFacilityTableObj->save();
            }
        }
        echo "successfully added";
        //GET LATEST COLLEGE MASTER ID
    }

    public function AddMissingGallery(Request $request)
    {
        $getAllCollegeData = DB::table('collegeprofile')
                                ->leftJoin('users', 'users.id', '=', 'collegeprofile.users_id')
                                ->where('users.userrole_id', '=', '2')
                                ->select('users.id as UserID','users.firstname', 'collegeprofile.id as collegeprofileId','collegeprofile.slug')
                                ->groupBy('collegeprofile.id')
                                ->orderBy('collegeprofile.id', 'ASC')
                                ->get()
                                ;
        /*echo "<pre>";
        print_r($getAllCollegeData);die;*/
                
        foreach ($getAllCollegeData as $key) {
            $value = $key->UserID;

            //Check for already existing logo
            $checkLogoDuplicateObj = DB::table('gallery')
                                        ->select('gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage','gallery.caption','gallery.misc','users_id')
                                        ->where('users_id' ,'=', $value)
                                        ->where('gallery.caption', '=', 'College Logo')
                                        ->where('gallery.misc', '=', 'college-logo-img')
                                        ->orderBy('gallery.id', 'ASC')
                                        ->take(1)
                                        ->get()
                                        ;

            if (!empty($checkLogoDuplicateObj)) {
                
            }else{
                $createGalleryCollegeLogo = new Gallery;

                $createGalleryCollegeLogo->caption = 'College Logo';
                $createGalleryCollegeLogo->misc = 'college-logo-img';
                $createGalleryCollegeLogo->category_id = '1';
                $createGalleryCollegeLogo->users_id = $value;

                $createGalleryCollegeLogo->save();
            }
        }
        echo "successfully added";
    }


    public function UpdateCollegeReviewVerify(Request $request)
    {
        CollegeProfile::orderBy('collegeprofile.id', 'ASC')
                ->leftJoin('users', 'users.id', '=', 'collegeprofile.users_id')
                ->where('users.userrole_id', '=', '2')
                ->where('collegeprofile.review', '=', '0')
                ->where('collegeprofile.verified', '=', '0')
                ->select('users.id as UserID','users.firstname', 'collegeprofile.id as collegeprofileId','collegeprofile.slug','users.email','users.phone')
                ->groupBy('collegeprofile.id')
                ->chunk(50, function ($dataObj) {
                foreach ($dataObj as $key) {
                        $value = $key->collegeprofileId;
                        //echo $value;echo '<br>';
                        $collegeprofileOwnerEmailId = CollegeProfile::where('collegeprofile.id', '=', $value)
                                                        ->leftJoin('users', 'users.id', '=', 'collegeprofile.users_id')
                                                        ->select('users.email','users.phone','users.firstname','collegeprofile.review','collegeprofile.agreement','verified','advertisement')
                                                        ->firstOrFail()
                                                        ;
                        $checkStatus = self::isValidEmail($collegeprofileOwnerEmailId->email);                        
                        if( $checkStatus == '1' ){
                            $profileOwnerEmailAddress = $collegeprofileOwnerEmailId->email;
                            $collegeProfileName = $collegeprofileOwnerEmailId->firstname;

                            //SEND EMAILS ON REVIEW IS ON 1
                            if( $collegeprofileOwnerEmailId->review == '0' ){
                                try {
                                    //Swift Mailer Data Fetching
                                    if(!empty($profileOwnerEmailAddress) && ($this->fetchDataServiceController->isValidEmail($profileOwnerEmailAddress) == 1)){ 
                                        \Mail::send('administrator/collegeprofile/emails.review-success', array('email' => $profileOwnerEmailAddress,'collegeName' => $collegeProfileName ), function($message) use ($profileOwnerEmailAddress)
                                        {
                                            $message->to($profileOwnerEmailAddress, 'AdmissionX')->subject('Your college profile has been successfully reviewed.');
                                        });
                                    }   
                                } catch ( \Swift_TransportException $e){
                                    Log::info('Email not sent on this email address: '.$profileOwnerEmailAddress);
                                    Log::info('Email Section College profile Id :'.$value);
                                }
                            }    
                        }                        

                       /* if( $collegeprofileOwnerEmailId->review == '0' ){
                            $userMobileNo = $collegeprofileOwnerEmailId->phone;
                            try {
                                if(!empty($collegeprofileOwnerEmailId->phone))
                                {   
                                    $string = $collegeProfileName;
                                    $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 
                                    
                                    $smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 35, $end = '')).', AdmissionX has successfully reviewed your profile. You can start taking admissions on our portal now. '.Config::get('systemsetting.SMS_GROUP_NAME_2');      
                                    $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_COLLEGE_PROFILE_REVIEWED')); 
                                    // $userIdHorizonSms = Config::get('app.userIdHorizonSms');
                                    // $passwordHorizonSms = Config::get('app.passwordHorizonSms');
                                    // $accountFromHorizon = Config::get('app.accountFromHorizon');

                                    // $url = 'http://210.210.26.40/sendsms/push_sms.php';

                                    // $client = new \GuzzleHttp\Client();
                                    // $res = $client->request('POST', $url, [
                                    //     'form_params' => [
                                    //         'user' => urlencode($userIdHorizonSms),
                                    //         'pwd' => urlencode($passwordHorizonSms),
                                    //         'from' => urlencode($accountFromHorizon),
                                    //         'to' => urlencode($userMobileNo),
                                    //         'msg' => $smsMessageData,
                                    //     ]
                                    // ]);  
                                } 
                            }catch (\Exception $e) {
                                Log::info('SMS not sent on this mobile : '.$userMobileNo);
                                Log::info('SMS Section College profile Id :'.$value);
                            }
                        }*/

                        // DB::table('collegeprofile')->where('collegeprofile.id', '=', $value)->update(array('collegeprofile.review' => '1', 'collegeprofile.verified' => '1' ));
                    }
                });
        return "SUCCESSFULLY ADDED";
    }

    function isValidEmail($email){ 
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 1;
        }else{
            return 0;
        }        
    }


    public function UpdateCollegeAgreement(Request $request)
    { 
        $checkCollegeFeeObj = CollegeMaster::orderBy('collegemaster.id', 'ASC')
                ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users', 'users.id', '=', 'collegeprofile.users_id')
                ->where('users.userrole_id', '=', '2')
                ->where('collegeprofile.collegetype_id', '=', '1')
                ->where('collegeprofile.collegetype_id', '=', '1')
                ->where('collegemaster.fees', '!=', '0')
                ->where('collegemaster.fees', '!=', '')
                ->select('collegeprofile.id as collegeprofileId','collegeprofile.slug')
                ->groupBy('collegeprofile.id')
                ->get();

                
            foreach ($checkCollegeFeeObj as $key) {
                $value = $key->collegeprofileId;
                DB::table('collegeprofile')->where('collegeprofile.id', '=', $value)->update(array('collegeprofile.review' => '1', 'collegeprofile.verified' => '1', 'collegeprofile.agreement' => '1'));
            }
        return "SUCCESSFULLY ADDED";
    }

    /************************************************************************************
    *   LIST ALL THE FACULTY MEMBERS
    /************************************************************************************/
    public function listFacultyAction(Request $request, $slug)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getFacultyObj  = Faculty::getFacultyObj($slug);
                return view('college/college-faculty.index')
                        ->with('getFacultyObj', $getFacultyObj)
                        ->with('slug', $slug)
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

    /************************************************************************************
    *   CREATE FACULTY MEMBERS
    /************************************************************************************/
    public function createFacultyAction(Request $request, $slug)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getFacultyObj  = (object)[
                                    'suffix'        => '',
                                    'name'          => '',
                                    'description'   => '',
                                    'email'         => '',
                                    'phone'         => '',
                                    'dob'           => '',
                                    'gender'        => '',
                                    'designation'   =>  '',
                                    'languageKnown' =>  '',
                                    'addressline1'  =>  '',
                                    'addressline2'  =>  '',
                                    'landmark'      =>  '',
                                    'pincode'       =>  '',
                                    'country_id'    =>  '',
                                    'state_id'      =>  '',
                                    'city_id'       =>  '',
                                ];

                $getCountryObj  =Country::all();
                //$educationLevelObj = EducationLevel::all();
                //$functionalAreaObj = FunctionalArea::all();
                //$courseTypeObj = CourseType::all();
                //$degreeObj = Degree::all();
                //$courseObj = DB::table('course');
                /*$courseObj = DB::table('course')
                                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                                ->select('functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName','course.id as courseId', 'course.name as courseName')
                                ->orderBy('course.name', 'ASC')->get();*/

                /*$collegeMasterId = null;
                $allCourseObj = $this->fetchDataServiceController->fetchCollegeCoursesOnFacultyAssociate($slug, $collegeMasterId);*/

                $allCourseObj = $this->fetchDataServiceController->fetchCollegeCourses($slug);

                return view('college/college-faculty.create', compact('allCourseObj'))
                        ->with('getFacultyObj', $getFacultyObj)
                        ->with('slug', $slug)
                        ->with('getCountryObj', $getCountryObj)
                        //->with('educationLevelObj', $educationLevelObj)
                        //->with('functionalAreaObj', $functionalAreaObj)
                        //->with('degreeObj', $degreeObj)
                        //->with('courseTypeObj', $courseTypeObj)
                        //->with('courseObj', $courseObj)
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

    /************************************************************************************
    *   STORE FACULTY MEMBERS
    /************************************************************************************/
    public function storeFacultyAction(Request $request, $slug)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();
                $create                                 = New Faculty; 
                $create->suffix                         = Input::get('suffix');
                $create->name                           = Input::get('name');
                $create->description                    = Input::get('description');
                $create->collegeprofile_id              = $collegeProfileObj->id;
                $create->email                          = Input::get('email');
                $create->phone                          = Input::get('phone');
                $create->dob                            = Input::get('dob');
                $create->languageKnown                  = Input::get('languageKnown');
                $create->designation                    = Input::get('designation');
                $create->gender                         = Input::get('gender');
                $create->addressline1                   = Input::get('addressline1');
                $create->addressline2                   = Input::get('addressline2');
                $create->landmark                       = Input::get('landmark');
                $create->pincode                        = Input::get('pincode');
                $create->country_id                     = Input::get('country_id');
                $create->state_id                       = Input::get('state_id');
                $create->city_id                        = Input::get('city_id');
                $imageObj                               = self::uploadFacultyMemeberProfile($request, $slug);
                if(sizeof($imageObj) > 0):
                    $create->imagename                  = $imageObj['small_img'];
                    $create->image_original             = $imageObj['big_img'];
                endif;
                $create->save();

                if (!empty(Input::get('qualification'))) {
                    $sizeOfQualificationsList = sizeof(Input::get('qualification'));
                    for($qualfication = 0; $qualfication < $sizeOfQualificationsList; $qualfication++){
                        $createQualificationsList                       = New FacultyQualification;
                        $createQualificationsList->qualification        = Input::get('qualification')[$qualfication];
                        $createQualificationsList->course               = Input::get('course')[$qualfication];
                        $createQualificationsList->subjects             = Input::get('subjects')[$qualfication];
                        $createQualificationsList->year                 = Input::get('year')[$qualfication];
                        $createQualificationsList->collegename          = Input::get('collegename')[$qualfication];
                        $createQualificationsList->boardName            = Input::get('boardName')[$qualfication];
                        $createQualificationsList->faculty_id           = $create->id;
                        $createQualificationsList->collegeprofile_id    = $collegeProfileObj->id;
                        $createQualificationsList->users_id             = $userId;
                        $createQualificationsList->employee_id          = $userId;
                        $createQualificationsList->save();
                    }
                }

                if (!empty(Input::get('organisation'))) {
                    $sizeOfExperiencesList = sizeof(Input::get('organisation'));
                    for($experiences = 0; $experiences < $sizeOfExperiencesList; $experiences++){
                        $createExperiencesList                          = New FacultyExperience;
                        $createExperiencesList->organisation            = Input::get('organisation')[$experiences];
                        $createExperiencesList->role                    = Input::get('role')[$experiences];
                        $createExperiencesList->fromyear                = Input::get('fromyear')[$experiences];
                        $createExperiencesList->toyear                  = Input::get('toyear')[$experiences];
                        $createExperiencesList->city                    = Input::get('city')[$experiences];
                        $createExperiencesList->faculty_id              = $create->id;
                        $createExperiencesList->collegeprofile_id       = $collegeProfileObj->id;
                        $createExperiencesList->users_id                = $userId;
                        $createExperiencesList->employee_id             = $userId;
                        $createExperiencesList->save();
                    }
                }

                /*if (!empty(Input::get('course_id'))) {
                    $sizeOfDepartmentList = sizeof(Input::get('course_id'));
                    for($department = 0; $department < $sizeOfDepartmentList; $department++){
                        if (!empty(Input::get('course_id')[$department])) {
                            $getDegreeDataObj      = DB::table('course')
                                                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                                    ->where('course.id','=', Input::get('course_id')[$department])
                                                    ->select('course.id','course.degree_id','degree.functionalarea_id')
                                                    ->orderBy('course.id' ,'DESC')
                                                    ->first();

                            $createFacultyDepartment                          = New FacultyDepartment;
                            $createFacultyDepartment->course_id               = Input::get('course_id')[$department];
                            $createFacultyDepartment->educationlevel_id       = Input::get('educationlevel_id')[$department];
                            $createFacultyDepartment->coursetype_id           = Input::get('coursetype_id')[$department];
                            $createFacultyDepartment->functionalarea_id       = $getDegreeDataObj->functionalarea_id;
                            $createFacultyDepartment->degree_id               = $getDegreeDataObj->degree_id;
                            $createFacultyDepartment->faculty_id              = $create->id;
                            $createFacultyDepartment->collegeprofile_id       = $collegeProfileObj->id;
                            $createFacultyDepartment->users_id                = $userId;
                            $createFacultyDepartment->employee_id             = $userId;
                            $createFacultyDepartment->save();
                        }
                    }
                }*/

                if (!empty(Input::get('collegemaster_id'))) {
                    $sizeOfDepartmentList = sizeof(Input::get('collegemaster_id'));
                    for($department = 0; $department < $sizeOfDepartmentList; $department++){
                        if (!empty(Input::get('collegemaster_id')[$department])) {
                            $getCollegeMasterDataObj = DB::table('collegemaster')
                                                        ->where('collegemaster.id','=', Input::get('collegemaster_id')[$department])
                                                        ->select('collegemaster.educationlevel_id','collegemaster.functionalarea_id','collegemaster.degree_id','collegemaster.coursetype_id','collegemaster.course_id')
                                                        ->orderBy('collegemaster.id' ,'DESC')
                                                        ->first();

                            $createFacultyDepartment                          = New FacultyDepartment;
                            $createFacultyDepartment->collegemaster_id       = Input::get('collegemaster_id')[$department];
                            $createFacultyDepartment->course_id               = $getCollegeMasterDataObj->course_id;
                            $createFacultyDepartment->educationlevel_id       = $getCollegeMasterDataObj->educationlevel_id;
                            $createFacultyDepartment->coursetype_id           = $getCollegeMasterDataObj->coursetype_id;
                            $createFacultyDepartment->functionalarea_id       = $getCollegeMasterDataObj->functionalarea_id;
                            $createFacultyDepartment->degree_id               = $getCollegeMasterDataObj->degree_id;
                            $createFacultyDepartment->faculty_id              = $create->id;
                            $createFacultyDepartment->collegeprofile_id       = $collegeProfileObj->id;
                            $createFacultyDepartment->users_id                = $userId;
                            $createFacultyDepartment->employee_id             = $userId;
                            $createFacultyDepartment->save();

                            $collegeMasterAssociate                          = New CollegeMasterAssociateFaculty;
                            $collegeMasterAssociate->faculty_id              = $create->id;
                            $collegeMasterAssociate->functionalarea_id       = $getCollegeMasterDataObj->functionalarea_id;
                            $collegeMasterAssociate->educationlevel_id       = $getCollegeMasterDataObj->educationlevel_id;
                            $collegeMasterAssociate->degree_id               = $getCollegeMasterDataObj->degree_id;
                            $collegeMasterAssociate->coursetype_id           = $getCollegeMasterDataObj->coursetype_id;
                            $collegeMasterAssociate->course_id               = $getCollegeMasterDataObj->course_id;
                            $collegeMasterAssociate->collegemaster_id        = Input::get('collegemaster_id')[$department];
                            $collegeMasterAssociate->collegeprofile_id       = $collegeProfileObj->id;
                            $collegeMasterAssociate->users_id                = $userId;
                            $collegeMasterAssociate->employee_id             = $userId;
                            $collegeMasterAssociate->save();
                        }
                    }
                }

                return Redirect::to('college/faculty/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    /************************************************************************************
    *   Show FACULTY MEMBERS
    /************************************************************************************/
    public function showFacultyAction(Request $request, $slug, $id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getFacultyObj      =   Faculty::orderBy('faculty.id', 'DESC')
                                            ->leftJoin('collegeprofile', 'collegeprofile.id', '=', 'faculty.collegeprofile_id')
                                            ->leftJoin('city', 'faculty.city_id', '=', 'city.id')
                                            ->leftJoin('state', 'faculty.state_id', '=', 'state.id')
                                            ->leftJoin('country', 'faculty.country_id', '=', 'country.id')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->select('faculty.id','faculty.name','faculty.description','faculty.suffix','faculty.email','faculty.phone','faculty.imagename','faculty.image_original','faculty.designation','faculty.dob','faculty.gender','faculty.addressline1','faculty.addressline2','faculty.landmark','faculty.pincode','faculty.collegeprofile_id','collegeprofile.users_id','city.name as cityName','state.name as stateName','country.name as countryName','faculty.languageKnown')
                                            ->findOrFail($id);


                   $qualificationsObj = DB::table('faculty_qualifications')
                                        ->where('faculty_qualifications.faculty_id','=', $getFacultyObj->id)
                                        ->where('faculty_qualifications.users_id','=', $getFacultyObj->users_id)
                                        ->where('faculty_qualifications.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                        ->orderBy('faculty_qualifications.id', 'ASC')
                                        ->get();

                    $experienceObj = DB::table('faculty_experiences')
                                        ->where('faculty_experiences.faculty_id','=', $getFacultyObj->id)
                                        ->where('faculty_experiences.users_id','=', $getFacultyObj->users_id)
                                        ->where('faculty_experiences.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                        ->orderBy('faculty_experiences.id', 'ASC')
                                        ->get();

                    $facultyDepartmentObj = DB::table('faculty_departments')
                                        ->leftJoin('educationlevel','faculty_departments.educationlevel_id','=','educationlevel.id')
                                        ->leftJoin('functionalarea','faculty_departments.functionalarea_id','=','functionalarea.id')
                                        ->leftJoin('degree','faculty_departments.degree_id','=','degree.id')
                                        ->leftJoin('coursetype','faculty_departments.coursetype_id','=','coursetype.id')
                                        ->leftJoin('course','faculty_departments.course_id','=','course.id')
                                        ->where('faculty_departments.users_id','=', $getFacultyObj->users_id)
                                        ->where('faculty_departments.faculty_id','=', $getFacultyObj->id)
                                        ->where('faculty_departments.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                        ->select('educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName','collegemaster_id')
                                        ->orderBy('faculty_departments.id', 'ASC')
                                        ->get();


                return view('college/college-faculty.show')
                            ->with('getFacultyObj', $getFacultyObj)
                            ->with('qualificationsObj', $qualificationsObj)
                            ->with('experienceObj', $experienceObj)
                            ->with('facultyDepartmentObj', $facultyDepartmentObj)
                            ->with('slug', $slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    /************************************************************************************
    *   EDIT FACULTY MEMBERS
    /************************************************************************************/
    public function editFacultyAction(Request $request, $slug, $id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getFacultyObj = Faculty::findOrFail($id);
                $getCountryObj  =Country::all();
                $getStateObj    = DB::table('state')->where('country_id', '=', $getFacultyObj->country_id)->select('id', 'name')->get();
                $getCityObj     = DB::table('city')->where('state_id', '=', $getFacultyObj->state_id)->select('id', 'name')->get();

                $qualificationsObj = DB::table('faculty_qualifications')
                                ->where('faculty_qualifications.faculty_id','=', $getFacultyObj->id)
                                ->where('faculty_qualifications.users_id','=', $userId)
                                ->where('faculty_qualifications.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                ->orderBy('faculty_qualifications.id', 'ASC')
                                ->get();

                $experienceObj = DB::table('faculty_experiences')
                                    ->where('faculty_experiences.faculty_id','=', $getFacultyObj->id)
                                    ->where('faculty_experiences.users_id','=', $userId)
                                    ->where('faculty_experiences.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                    ->orderBy('faculty_experiences.id', 'ASC')
                                    ->get();

                $getCountryObj  =Country::all();
                //$educationLevelObj = EducationLevel::all();
                //$courseTypeObj = CourseType::all();
                //$functionalAreaObj = FunctionalArea::all();
                //$degreeObj = Degree::all();
                //$courseObj = DB::table('course')->orderBy('course.name', 'ASC')->get();
                /*$courseObj = DB::table('course')
                                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                                ->select('functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName','course.id as courseId', 'course.name as courseName')
                                ->orderBy('course.name', 'ASC')->get();*/

                $facultyDepartmentObj = DB::table('faculty_departments')
                                    ->where('faculty_departments.users_id','=', $userId)
                                    ->where('faculty_departments.faculty_id','=', $getFacultyObj->id)
                                    ->where('faculty_departments.collegeprofile_id','=', $getFacultyObj->collegeprofile_id)
                                    ->orderBy('faculty_departments.id', 'ASC')
                                    ->get();


                /*$collegeMasterIds = DB::select(DB::raw("SELECT GROUP_CONCAT(faculty_departments.collegemaster_id) as collegeMasterId FROM faculty_departments where faculty_departments.users_id = $userId and faculty_departments.faculty_id = $getFacultyObj->id and faculty_departments.collegeprofile_id = $getFacultyObj->collegeprofile_id"));

                if (sizeof($collegeMasterIds) > 0) {
                    $collegeMasterId = $collegeMasterIds[0]->collegeMasterId;
                }else{
                    $collegeMasterId = null;
                }*/
                    //$collegeMasterId = null;
                //$allCourseObj = $this->fetchDataServiceController->fetchCollegeCoursesOnFacultyAssociate($slug, $collegeMasterId);
                $allCourseObj = $this->fetchDataServiceController->fetchCollegeCourses($slug);

                return view('college/college-faculty.edit', compact('allCourseObj'))
                            ->with('getFacultyObj', $getFacultyObj)
                            ->with('getCountryObj', $getCountryObj)
                            ->with('getStateObj', $getStateObj)
                            ->with('getCityObj', $getCityObj)
                            ->with('qualificationsObj', $qualificationsObj)
                            ->with('experienceObj', $experienceObj)
                            //->with('educationLevelObj', $educationLevelObj)
                            //->with('functionalAreaObj', $functionalAreaObj)
                            //->with('courseTypeObj', $courseTypeObj)
                            //->with('courseObj', $courseObj)
                            //->with('degreeObj', $degreeObj)
                            ->with('facultyDepartmentObj', $facultyDepartmentObj)
                            ->with('slug', $slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    /************************************************************************************
    *   UPDATE FACULTY MEMBERS
    /************************************************************************************/
    public function updateFacultyAction(Request $request, $slug)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();

                $update                                 = Faculty::findOrFail(Input::get('id')); 
                $update->suffix                         = Input::get('suffix');
                $update->name                           = Input::get('name');
                $update->description                    = Input::get('description');
                $update->email                          = Input::get('email');
                $update->phone                          = Input::get('phone');
                $update->dob                            = Input::get('dob');
                $update->designation                    = Input::get('designation');
                $update->languageKnown                  = Input::get('languageKnown');
                $update->gender                         = Input::get('gender');
                $update->addressline1                   = Input::get('addressline1');
                $update->addressline2                   = Input::get('addressline2');
                $update->landmark                       = Input::get('landmark');
                $update->pincode                        = Input::get('pincode');
                $update->country_id                     = Input::get('country_id');
                $update->state_id                       = Input::get('state_id');
                $update->city_id                        = Input::get('city_id');
                $imageObj                               = self::uploadFacultyMemeberProfile($request, $slug);
                if(sizeof($imageObj) > 0):
                    $update->imagename                  = $imageObj['small_img'];
                    $update->image_original             = $imageObj['big_img'];
                endif;
                $update->save();

                if (!empty(Input::get('qualification'))) {
                    Db::table('faculty_qualifications')
                    ->where('faculty_qualifications.faculty_id','=', Input::get('id'))
                    ->where('faculty_qualifications.users_id', '=', $userId)
                    ->where('faculty_qualifications.collegeprofile_id', '=', $collegeProfileObj->id)
                    ->delete();

                    $sizeOfQualificationsList = sizeof(Input::get('qualification'));
                    for($qualfication = 0; $qualfication < $sizeOfQualificationsList; $qualfication++){
                        $createQualificationsList                       = New FacultyQualification;
                        $createQualificationsList->qualification        = Input::get('qualification')[$qualfication];
                        $createQualificationsList->course               = Input::get('course')[$qualfication];
                        $createQualificationsList->subjects             = Input::get('subjects')[$qualfication];
                        $createQualificationsList->year                 = Input::get('year')[$qualfication];
                        $createQualificationsList->collegename          = Input::get('collegename')[$qualfication];
                        $createQualificationsList->boardName            = Input::get('boardName')[$qualfication];
                        $createQualificationsList->faculty_id           = $update->id;
                        $createQualificationsList->collegeprofile_id    = $collegeProfileObj->id;
                        $createQualificationsList->users_id             = $userId;
                        $createQualificationsList->employee_id          = $userId;
                        $createQualificationsList->save();
                    }
                }

                if (!empty(Input::get('organisation'))) {
                    Db::table('faculty_experiences')
                    ->where('faculty_experiences.faculty_id','=', Input::get('id'))
                    ->where('faculty_experiences.users_id', '=', $userId)
                    ->where('faculty_experiences.collegeprofile_id', '=', $collegeProfileObj->id)
                    ->delete();

                    $sizeOfExperiencesList = sizeof(Input::get('organisation'));
                    for($experiences = 0; $experiences < $sizeOfExperiencesList; $experiences++){
                        $createExperiencesList                          = New FacultyExperience;
                        $createExperiencesList->organisation            = Input::get('organisation')[$experiences];
                        $createExperiencesList->role                    = Input::get('role')[$experiences];
                        $createExperiencesList->fromyear                = Input::get('fromyear')[$experiences];
                        $createExperiencesList->toyear                  = Input::get('toyear')[$experiences];
                        $createExperiencesList->city                    = Input::get('city')[$experiences];
                        $createExperiencesList->faculty_id              = $update->id;
                        $createExperiencesList->collegeprofile_id       = $collegeProfileObj->id;
                        $createExperiencesList->users_id                = $userId;
                        $createExperiencesList->employee_id             = $userId;
                        $createExperiencesList->save();
                    }
                }

                /*if (!empty(Input::get('course_id'))) {
                    Db::table('faculty_departments')
                    ->where('faculty_departments.faculty_id','=', Input::get('id'))
                    ->where('faculty_departments.users_id', '=', $userId)
                    ->where('faculty_departments.collegeprofile_id', '=', $collegeProfileObj->id)
                    ->delete();

                    $sizeOfDepartmentList = sizeof(Input::get('course_id'));
                    for($department = 0; $department < $sizeOfDepartmentList; $department++){
                        if (!empty(Input::get('course_id')[$department])) {
                            $getDegreeDataObj      = DB::table('course')
                                                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                                    ->where('course.id','=', Input::get('course_id')[$department])
                                                    ->select('course.id','course.degree_id','degree.functionalarea_id')
                                                    ->orderBy('course.id' ,'DESC')
                                                    ->first();

                            $createFacultyDepartment                          = New FacultyDepartment;
                            $createFacultyDepartment->course_id               = Input::get('course_id')[$department];
                            $createFacultyDepartment->educationlevel_id       = Input::get('educationlevel_id')[$department];
                            $createFacultyDepartment->coursetype_id           = Input::get('coursetype_id')[$department];
                            $createFacultyDepartment->functionalarea_id       = $getDegreeDataObj->functionalarea_id;
                            $createFacultyDepartment->degree_id               = $getDegreeDataObj->degree_id;
                            $createFacultyDepartment->faculty_id              = $update->id;
                            $createFacultyDepartment->collegeprofile_id       = $collegeProfileObj->id;
                            $createFacultyDepartment->users_id                = $userId;
                            $createFacultyDepartment->employee_id             = $userId;
                            $createFacultyDepartment->save();
                        }
                    }
                }*/

                if (!empty(Input::get('collegemaster_id'))) {
                    Db::table('faculty_departments')
                        ->where('faculty_departments.faculty_id','=', Input::get('id'))
                        ->where('faculty_departments.users_id', '=', $userId)
                        ->where('faculty_departments.collegeprofile_id', '=', $collegeProfileObj->id)
                        ->delete();

                    Db::table('college_master_associate_faculties')
                        ->where('college_master_associate_faculties.faculty_id','=', Input::get('id'))
                        ->where('college_master_associate_faculties.users_id', '=', $userId)
                        ->where('college_master_associate_faculties.collegeprofile_id', '=', $collegeProfileObj->id)
                        ->delete();
                    $sizeOfDepartmentList = sizeof(Input::get('collegemaster_id'));
                    for($department = 0; $department < $sizeOfDepartmentList; $department++){
                        if (!empty(Input::get('collegemaster_id')[$department])) {
                            $getCollegeMasterDataObj = DB::table('collegemaster')
                                                        ->where('collegemaster.id','=', Input::get('collegemaster_id')[$department])
                                                        ->select('collegemaster.educationlevel_id','collegemaster.functionalarea_id','collegemaster.degree_id','collegemaster.coursetype_id','collegemaster.course_id')
                                                        ->orderBy('collegemaster.id' ,'DESC')
                                                        ->first();

                            $createFacultyDepartment                          = New FacultyDepartment;
                            $createFacultyDepartment->collegemaster_id       = Input::get('collegemaster_id')[$department];
                            $createFacultyDepartment->course_id               = $getCollegeMasterDataObj->course_id;
                            $createFacultyDepartment->educationlevel_id       = $getCollegeMasterDataObj->educationlevel_id;
                            $createFacultyDepartment->coursetype_id           = $getCollegeMasterDataObj->coursetype_id;
                            $createFacultyDepartment->functionalarea_id       = $getCollegeMasterDataObj->functionalarea_id;
                            $createFacultyDepartment->degree_id               = $getCollegeMasterDataObj->degree_id;
                            $createFacultyDepartment->faculty_id              = $update->id;
                            $createFacultyDepartment->collegeprofile_id       = $collegeProfileObj->id;
                            $createFacultyDepartment->users_id                = $userId;
                            $createFacultyDepartment->employee_id             = $userId;
                            $createFacultyDepartment->save();

                            $collegeMasterAssociate                          = New CollegeMasterAssociateFaculty;
                            $collegeMasterAssociate->faculty_id              = $update->id;
                            $collegeMasterAssociate->functionalarea_id       = $getCollegeMasterDataObj->functionalarea_id;
                            $collegeMasterAssociate->educationlevel_id       = $getCollegeMasterDataObj->educationlevel_id;
                            $collegeMasterAssociate->degree_id               = $getCollegeMasterDataObj->degree_id;
                            $collegeMasterAssociate->coursetype_id           = $getCollegeMasterDataObj->coursetype_id;
                            $collegeMasterAssociate->course_id               = $getCollegeMasterDataObj->course_id;
                            $collegeMasterAssociate->collegemaster_id        = Input::get('collegemaster_id')[$department];
                            $collegeMasterAssociate->collegeprofile_id       = $collegeProfileObj->id;
                            $collegeMasterAssociate->users_id                = $userId;
                            $collegeMasterAssociate->employee_id             = $userId;
                            $collegeMasterAssociate->save();
                        }
                    }
                }

                return Redirect::to('college/faculty/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    /************************************************************************************
    *   DELETE FACULTY MEMBERS
    /************************************************************************************/
    public function removeFacultyAction(Request $request, $slug, $id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getFacultyObj = Faculty::findOrFail($id);

                DB::table('faculty_experiences')
                    ->where('faculty_experiences.faculty_id','=', $id)
                    ->where('faculty_experiences.collegeprofile_id', '=', $getFacultyObj->collegeprofile_id)
                    ->delete();

                DB::table('faculty_qualifications')
                    ->where('faculty_qualifications.faculty_id','=', $id)
                    ->where('faculty_qualifications.collegeprofile_id', '=', $getFacultyObj->collegeprofile_id)
                    ->delete();

                Db::table('faculty_departments')
                    ->where('faculty_departments.faculty_id','=', $id)
                    ->where('faculty_departments.collegeprofile_id', '=', $getFacultyObj->collegeprofile_id)
                    ->delete();

                Db::table('college_master_associate_faculties')
                    ->where('college_master_associate_faculties.faculty_id','=', $id)
                    ->where('college_master_associate_faculties.collegeprofile_id', '=', $getFacultyObj->id)
                    ->delete();

                Faculty::destroy($id);
                return Redirect::to('college/faculty/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }       
    }

    /************************************************************************************
    *   UPDATE FACULTY MEMBERS PROFILE PICTURES
    /************************************************************************************/
    public function uploadFacultyMemeberProfile($request, $slug)
    {
        $dataArray                              = [];
        if($request->hasFile('imagename')):
            $extensionOfFile                    = '';
            $path                               = $_FILES['imagename']['name'];
            $ext                                = pathinfo($path, PATHINFO_EXTENSION);
            $ext                                = strtolower($ext);
            $tempPath                           = $_FILES[ 'imagename' ][ 'tmp_name' ];
            $currentMyTime                      = strtotime('now');
            $imageNameWithTime                  = str_limit('faculty_memeber_'.$slug.'-'.$currentMyTime, 150, '');
            $fileWithExtension                  = $imageNameWithTime.'.'.$ext;
            $fileWithExtension1                 = $imageNameWithTime.'_original'.'.'.$ext;
            //Set the image folder path
            $dirPath                            = public_path().'/gallery/'.$slug.'/';
            //Store the image with 300PX width
            $uploadPath                         = $dirPath.$fileWithExtension;
            //Store the image with original width as original
            $uploadPath1                        = $dirPath.$fileWithExtension1;
            if (move_uploaded_file($tempPath, $uploadPath)):
                copy($uploadPath, $uploadPath1);
            endif;

            $dataArray                          = [
                                                    'small_img'     => $fileWithExtension,
                                                    'big_img'       => $fileWithExtension1,
                                                ];
        endif;
        return $dataArray;
    }

    public function getBannerImagePartials(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $slugUrl = $request->slug;
            $collegeDataObj = DB::table('collegeprofile')
                            ->leftJoin('users', function ($join) use ($userId) {
                            $join->on('collegeprofile.users_id', '=','users.id')
                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                );  
                            })
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegeprofile.bannerimage')
                            ->orderBy('collegeprofile.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;

            $htmlBlock = view('college/college-profile-partial.getBannerImagePartials')
                        ->with('collegeDataObj', $collegeDataObj)
                        ->with('slugUrl', $request->slug)
                        ->render();
            return response()->json($htmlBlock);
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function getBannerImagePartialsUpdate(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            //VALIDATE THE USER NOW
            $getValidateState = DB::table('collegeprofile')
                                ->where('slug', '=', $request->slugUrl)
                                ->where('collegeprofile.users_id', '=', $userId)
                                ->count();

            if( $getValidateState == '1' ){
                if($request->file('bannerimage')){
                    $fileName = time().'-'.$userId.".".$request->bannerimage->getClientOriginalExtension();
                    $request->bannerimage->move(public_path('gallery/'.$request->slugUrl.'/'), $fileName);
                    DB::table('collegeprofile')->where('collegeprofile.users_id', '=', $userId)->update(array('collegeprofile.bannerimage' => $fileName));
                }

                Session::flash('collegeBannerUpdate', 'College Banner Image Updated!');
                return redirect()->route('college_dash', $request->slugUrl);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login        
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login    
        }
    }

    public function getFacebookWidgetPartials(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $slugUrl = $request->slug;
            $collegeDataObj = DB::table('collegeprofile')
                            ->leftJoin('users', function ($join) use ($userId) {
                            $join->on('collegeprofile.users_id', '=','users.id')
                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                );  
                            })
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegeprofile.id as collegeprofileId','collegeprofile.slug', 'collegeprofile.facebookurl')
                            ->orderBy('collegeprofile.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;

            $htmlBlock = view('college/college-profile-partial.facebookWidgetLink')
                        ->with('collegeDataObj', $collegeDataObj)
                        ->with('slugUrl', $request->slug)
                        ->render();
            return response()->json($htmlBlock);
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function getFacebookWidgetPartialsUpdate(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            //VALIDATE THE USER NOW
            $getValidateState = DB::table('collegeprofile')
                                ->where('slug', '=', $request->slugUrl)
                                ->where('collegeprofile.users_id', '=', $userId)
                                ->count();

            if( $getValidateState == '1' ){
                $collegeProfileObj = CollegeProfile::where('collegeprofile.users_id', '=', $userId)->first();
                $collegeProfileObj->facebookurl = Input::get('facebookPageUrl');    
                $collegeProfileObj->employee_id = Auth::id();
                $collegeProfileObj->save();     

                Session::flash('collegeProfileUpdate', 'College profile has been updated successfully!');
               
                $dataArray = array(
                            'code' => '200',
                            'response' => 'success',
                            'message' => 'College profile has been updated successfully!',
                            'facebookMessage' => 'Facebook url has been updated successfully!',
                        );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                die;
                //Session::flash('facebookWidgetUrlUpdate', 'Facebook url has been updated successfully!');
                //return redirect()->route('college_dash', $request->slugUrl);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login        
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login    
        }
    }

    public function getSocialLinkPartials(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    $socialMediaLinksDataObj = DB::table('college_social_media_links')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','college_social_media_links.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->where('users.id', '=', $userId)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','college_social_media_links.id as collegeSocialMediaLinkId', 'college_social_media_links.title', 'college_social_media_links.url', 'college_social_media_links.isActive', 'college_social_media_links.other', 'college_social_media_links.users_id', 'college_social_media_links.collegeprofile_id', 'college_social_media_links.employee_id')
                        ->orderBy('college_social_media_links.id', 'ASC')
                        ->get()
                        ;

                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
                $htmlBlock = view('college/college-profile-partial.socialMediaLinks')
                        ->with('socialMediaLinksDataObj', $socialMediaLinksDataObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }


    public function getSocialLinkPartialsUpdate(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            //VALIDATE THE USER NOW
            $collegeProfileDataObj= DB::table('collegeprofile')
                                ->join('users', function ($join) use ($userId) {
                                    $join->on('collegeprofile.users_id', '=','users.id')
                                        ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                        );  
                                    })
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('collegeprofile.id as collegeProfileId')
                                ->take(1)
                                ->get();

            if(sizeof($collegeProfileDataObj) > 0){
                $collegeProfileId = $collegeProfileDataObj[0]->collegeProfileId;
                if (!empty(Input::get('socialId'))) {
                    $sizeOfSocialmanagement = sizeof(Input::get('socialId'));
                    for($socialLinks = 0; $socialLinks < $sizeOfSocialmanagement; $socialLinks++){
                        if (!empty(Input::get('collegeSocialMediaLinkId')[$socialLinks])) {
                            $updateSocialmanagement                     = CollegeSocialMediaLink::findOrFail(Input::get('collegeSocialMediaLinkId')[$socialLinks]);
                            $updateSocialmanagement->title              = Input::get('title')[$socialLinks];
                            $updateSocialmanagement->other              = Input::get('title')[$socialLinks];
                            $updateSocialmanagement->url                = Input::get('url')[$socialLinks];
                            $updateSocialmanagement->isActive           = Input::get('isActive'.$socialLinks);
                            $updateSocialmanagement->users_id           = Auth::id();
                            $updateSocialmanagement->collegeprofile_id  = $collegeProfileId;
                            $updateSocialmanagement->employee_id        = Auth::id();
                            $updateSocialmanagement->save();
                        }else{
                            $createSocialmanagement                     = New CollegeSocialMediaLink;
                            $createSocialmanagement->title              = Input::get('title')[$socialLinks];
                            $createSocialmanagement->other              = Input::get('title')[$socialLinks];
                            $createSocialmanagement->url                = Input::get('url')[$socialLinks];
                            $createSocialmanagement->isActive           = Input::get('isActive'.$socialLinks);
                            $createSocialmanagement->users_id           = Auth::id();
                            $createSocialmanagement->collegeprofile_id  = $collegeProfileId;
                            $createSocialmanagement->employee_id        = Auth::id();
                            $createSocialmanagement->save();
                        }
                    }
                }

                $dataArray = array(
                            'code' => '200',
                            'response' => 'success',
                            'message' => 'Social Links has been updated successfully!',
                        );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                die;
                //Session::flash('socialLinkManagementUpdate', 'Social Links has been updated successfully!');
                //return redirect()->route('college_dash', $request->slugUrl);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login        
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login    
        }
    }

    public function sportsActivityPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    $collegeSportsActivityDataObj = DB::table('college_sports_activities')
                                ->leftJoin('collegeprofile','college_sports_activities.collegeprofile_id','=','collegeprofile.id')
                                ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                                ->where('collegeprofile.slug', '=', $slugUrl)
                                ->where('users.id', '=', $userId)
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('users.id as usersId','collegeprofile.slug','college_sports_activities.id as collegeSportsActivityId','college_sports_activities.typeOfActivity', 'college_sports_activities.name', 'college_sports_activities.users_id', 'college_sports_activities.collegeprofile_id', 'college_sports_activities.employee_id')
                                ->orderBy('collegeprofile.id', 'ASC')
                                ->get();

                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }

                $htmlBlock = view('college/college-profile-partial.sportsActivityPartial')
                        ->with('collegeSportsActivityDataObj', $collegeSportsActivityDataObj)
                        ->with('slugUrl', $slugUrl)->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function sportsActivityCreate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl =Input::get('slugUrl');

            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
                if( !empty($collegeProfileDataObj) ){

                    $createObj = new CollegeSportsActivity;
                    $createObj->typeOfActivity = Input::get('typeOfActivity');
                    $createObj->name = Input::get('name');
                    $createObj->users_id = Auth::id();
                    $createObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId; 
                    $createObj->employee_id = Auth::id();                 
                    $createObj->save();
                    
                    Session::flash('collegefacilityUpdate', 'College sports & activity has been created successfully!');
                    //return redirect()->route('college_dash', $slugUrl);   

                    return redirect('/college/dashboard/edit/'.$slugUrl.'#sportsactivity'); 
                }
                
            }else{
                //Auth::logout(); // logout user
                //return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function sportsActivityUpdatePartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $collegeSportsActivityId = $request->collegeSportsActivityId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                if($request->ajax())
                {
                    $collegeSportsActivityDataObj = CollegeSportsActivity::where('college_sports_activities.id', '=', $collegeSportsActivityId)
                            ->leftJoin('collegeprofile','college_sports_activities.collegeprofile_id','=','collegeprofile.id')
                            ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('users.id', '=', $userId)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','collegeprofile.slug','college_sports_activities.id as collegeSportsActivityId','college_sports_activities.typeOfActivity', 'college_sports_activities.name', 'college_sports_activities.users_id', 'college_sports_activities.collegeprofile_id', 'college_sports_activities.employee_id')
                            ->firstOrFail()
                            ;

                    $htmlBlock = view('college/college-profile-partial.sportsActivityUpdatePartial')
                        ->with('collegeSportsActivityDataObj', $collegeSportsActivityDataObj)
                        ->with('slugUrl',$slugUrl)->render();
                    return response()->json($htmlBlock);
                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
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

    public function sportsActivityUpdate(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   

            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $updateObj = CollegeSportsActivity::where('college_sports_activities.id', '=', Input::get('collegeSportsActivityId'))->firstOrFail();;
                $updateObj->typeOfActivity = Input::get('typeOfActivity');
                $updateObj->name = Input::get('name');
                $updateObj->employee_id = Auth::id();                 
                $updateObj->save();
                
                Session::flash('collegefacilityUpdate', 'College sports & activity has been created successfully!');
                //return redirect()->route('college_dash', $slugUrl);   
                return redirect('/college/dashboard/edit/'.$slugUrl.'#sportsactivity'); 
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function deleteCollegeSportsActivity(Request $request, $collegeSportsActivityId, $slugUrl)
    {   
        //Get Faculty Id & Remove Faculty Info
        $collegePlacement = DB::table('college_sports_activities')
                        ->leftJoin('collegeprofile', 'college_sports_activities.collegeprofile_id', '=','collegeprofile.id')
                        ->where('college_sports_activities.id', '=', $collegeSportsActivityId)
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->orderBy('college_sports_activities.id', 'DESC')
                        ->select('college_sports_activities.id')
                        ->get()
                        ;
        if(sizeof($collegePlacement) > 0) {
            CollegeSportsActivity::destroy($collegeSportsActivityId);    
        }
        return redirect('/college/dashboard/edit/'.$slugUrl.'#sportsactivity');  
        //return redirect()->route('college_dash', $slugUrl);  
    }

    public function collegeCutOffPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;   
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){ 
                try {
                    $educationLevelObj = EducationLevel::all();
                    $functionalAreaObj = FunctionalArea::all();
                    $courseTypeObj = CourseType::all();
                    //$courseObj = Course::all();
                    $courseObj = DB::table('course')
                            ->orderBy('course.name', 'ASC')
                            ->get()
                            ;

                    $collegeCutOffsDataObj = DB::table('college_cut_offs')
                                        ->leftJoin('collegeprofile','college_cut_offs.collegeprofile_id','=','collegeprofile.id')
                                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                                        ->leftJoin('educationlevel','college_cut_offs.educationlevel_id','=','educationlevel.id')
                                        ->leftJoin('functionalarea','college_cut_offs.functionalarea_id','=','functionalarea.id')
                                        ->leftJoin('degree','college_cut_offs.degree_id','=','degree.id')
                                        ->leftJoin('coursetype','college_cut_offs.coursetype_id','=','coursetype.id')
                                        ->leftJoin('course','college_cut_offs.course_id','=','course.id')
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.id', '=', $userId)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.id as usersId','collegeprofile.slug','college_cut_offs.id as collegeCutOffId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'college_cut_offs.title', 'college_cut_offs.description')
                                        ->orderBy('college_cut_offs.id','ASC')
                                        ->get()
                                        ;

                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }

                $htmlBlock = view('college/college-profile-partial.collegeCutOffPartial')
                        ->with('collegeCutOffsDataObj', $collegeCutOffsDataObj)
                        ->with('slugUrl', $slugUrl)
                        ->with('educationLevelObj', $educationLevelObj)
                        ->with('functionalAreaObj', $functionalAreaObj)
                        ->with('courseTypeObj', $courseTypeObj)
                        ->with('courseObj', $courseObj)
                        ->render();
                return response()->json($htmlBlock);
                
            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }
    }

    public function collegeCutOffCreate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl =Input::get('slugUrl');

            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                /*** College Profile Details **/
                $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
                if( !empty($collegeProfileDataObj) ){

                    $createObj = new CollegeCutOff;
                    $createObj->title = Input::get('title');
                    $createObj->description = Input::get('description');
                    $createObj->functionalarea_id = Input::get('functionalarea_id');
                    $createObj->degree_id = Input::get('degree_id');
                    $createObj->course_id = Input::get('course_id');
                    $createObj->educationlevel_id = Input::get('educationlevel_id');
                    $createObj->coursetype_id = Input::get('coursetype_id');
                    $createObj->users_id = Auth::id();
                    $createObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId; 
                    $createObj->employee_id = Auth::id();                 
                    $createObj->save();

                    Session::flash('collegefacilityUpdate', 'College sports & activity has been created successfully!');
                    //return redirect()->route('college_dash', $slugUrl);   
                    return redirect('/college/dashboard/edit/'.$slugUrl.'#cutoffs'); 
                }
            }else{
                //Auth::logout(); // logout user
                //return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function collegeCutOffUpdatePartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $collegeCutOffId = $request->collegeCutOffId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                if($request->ajax())
                {   
                    $educationLevelObj = EducationLevel::all();
                    $functionalAreaObj = FunctionalArea::all();
                    $courseTypeObj = CourseType::all();
                    //$courseObj = Course::all();
                    $courseObj = DB::table('course')
                            ->orderBy('course.name', 'ASC')
                            ->get()
                            ;

                    $degreeObj = Degree::all();

                    $collegeCutOffsDataObj = CollegeCutOff::where('college_cut_offs.id', '=', $collegeCutOffId)
                                ->leftJoin('collegeprofile','college_cut_offs.collegeprofile_id','=','collegeprofile.id')
                                ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                                ->leftJoin('educationlevel','college_cut_offs.educationlevel_id','=','educationlevel.id')
                                ->leftJoin('functionalarea','college_cut_offs.functionalarea_id','=','functionalarea.id')
                                ->leftJoin('degree','college_cut_offs.degree_id','=','degree.id')
                                ->leftJoin('coursetype','college_cut_offs.coursetype_id','=','coursetype.id')
                                ->leftJoin('course','college_cut_offs.course_id','=','course.id')
                                ->where('collegeprofile.slug', '=', $slugUrl)
                                ->where('users.id', '=', $userId)
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('users.id as usersId','collegeprofile.slug','college_cut_offs.id as collegeCutOffId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'college_cut_offs.title', 'college_cut_offs.description', 'college_cut_offs.functionalarea_id', 'college_cut_offs.degree_id', 'college_cut_offs.coursetype_id', 'college_cut_offs.course_id','college_cut_offs.educationlevel_id')
                                 ->firstOrFail();

                    $htmlBlock = view('college/college-profile-partial.collegeCutOffUpdatePartial')
                        ->with('collegeCutOffsDataObj', $collegeCutOffsDataObj)
                        ->with('educationLevelObj', $educationLevelObj)
                        ->with('functionalAreaObj', $functionalAreaObj)
                        ->with('courseTypeObj', $courseTypeObj)
                        ->with('courseObj', $courseObj)
                        ->with('degreeObj', $degreeObj)
                        ->with('slugUrl',$slugUrl)->render();
                    return response()->json($htmlBlock);
                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
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

    public function collegeCutOffUpdate(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   

            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                $updateObj = CollegeCutOff::where('college_cut_offs.id', '=', Input::get('collegeCutOffId'))->firstOrFail();;
                $updateObj->title = Input::get('title');
                $updateObj->description = Input::get('description');
                $updateObj->functionalarea_id = Input::get('functionalarea_id');
                $updateObj->degree_id = Input::get('degree_id');
                $updateObj->course_id = Input::get('course_id');
                $updateObj->educationlevel_id = Input::get('educationlevel_id');
                $updateObj->coursetype_id = Input::get('coursetype_id');
                $updateObj->users_id = Auth::id();
                $updateObj->employee_id = Auth::id();                 
                $updateObj->save();
                
                Session::flash('collegefacilityUpdate', 'College sports & activity has been created successfully!');
                //return redirect()->route('college_dash', $slugUrl);   
                return redirect('/college/dashboard/edit/'.$slugUrl.'#cutoffs'); 
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function deleteCollegeCutOff(Request $request, $collegeCutOffId, $slugUrl)
    {   
        //Get Faculty Id & Remove Faculty Info
        $collegePlacement = DB::table('college_cut_offs')
                        ->leftJoin('collegeprofile', 'college_cut_offs.collegeprofile_id', '=','collegeprofile.id')
                        ->where('college_cut_offs.id', '=', $collegeCutOffId)
                        ->where('collegeprofile.slug', '=', $slugUrl)
                        ->orderBy('college_cut_offs.id', 'DESC')
                        ->select('college_cut_offs.id')
                        ->get()
                        ;
        if(sizeof($collegePlacement) > 0) {
            CollegeCutOff::destroy($collegeCutOffId);    
        }
        return redirect('/college/dashboard/edit/'.$slugUrl.'#cutoffs');  
        //return redirect()->route('college_dash', $slugUrl);  
    }

    /************************************************************************************
    *   LIST ALL THE COLLEGE FAQS
    /************************************************************************************/
    public function listFaqsAction(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                $getCollegeFaqsObj  = CollegeFaq::getCollegeFaqsObj($slug);
                return view('college/college-faqs.index')
                        ->with('getCollegeFaqsObj', $getCollegeFaqsObj)
                        ->with('slug', $slug)
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

    /************************************************************************************
    *   CREATE COLLEGE FAQS
    /************************************************************************************/
    public function createFaqsAction(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getCollegeFaqsObj  = (object)[
                                    'question'        => '',
                                    'refLinks'        => '',
                                    'answer'          => '',
                                ];

                return view('college/college-faqs.create')
                        ->with('getCollegeFaqsObj', $getCollegeFaqsObj)
                        ->with('slug', $slug)
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

    /************************************************************************************
    *   STORE COLLEGE FAQS
    /************************************************************************************/
    public function storeFaqsAction(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();
                $create                                 = New CollegeFaq; 
                $create->question                       = Input::get('question');
                $create->answer                         = Input::get('answer');
                $create->refLinks                       = Input::get('refLinks');
                $create->collegeprofile_id              = $collegeProfileObj->id;
                $create->users_id                       = Auth::id();
                $create->employee_id                    = Auth::id();
                $create->save();
                return Redirect::to('college/faqs/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    /************************************************************************************
    *   EDIT COLLEGE FAQS
    /************************************************************************************/
    public function editFaqsAction(Request $request, $slug, $id)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getCollegeFaqsObj = CollegeFaq::findOrFail($id);
                return view('college/college-faqs.edit')
                            ->with('getCollegeFaqsObj', $getCollegeFaqsObj)
                            ->with('slug', $slug)
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

    /************************************************************************************
    *   UPDATE COLLEGE FAQS
    /************************************************************************************/
    public function updateFaqsAction(Request $request, $slug)
    {
        if (Auth::check())
        {   

            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $update                                 = CollegeFaq::findOrFail(Input::get('id')); 
                $update->question                       = Input::get('question');
                $update->answer                         = Input::get('answer');
                $update->refLinks                       = Input::get('refLinks');
                $update->employee_id                    = Auth::id();
                $update->save();
                return Redirect::to('college/faqs/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    /************************************************************************************
    *   DELETE COLLEGE FAQS
    /************************************************************************************/
    public function removeFaqsAction(Request $request, $slug, $id)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                 $collegeFaqs = DB::table('college_faqs')
                        ->leftJoin('collegeprofile', 'college_faqs.collegeprofile_id', '=','collegeprofile.id')
                        ->where('college_faqs.id', '=', $id)
                        ->where('collegeprofile.slug', '=', $slug)
                        ->orderBy('college_faqs.id', 'DESC')
                        ->select('college_faqs.id')
                        ->get()
                        ;
                if(sizeof($collegeFaqs) > 0) {
                    CollegeFaq::destroy($id);    
                }
                return Redirect::to('college/faqs/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }               
    }

    
    
     /************************************************************************************
    *   LIST ALL THE Transaction
    /************************************************************************************/
    public function listTransactionAction(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                $getApplicationsDataObj = Application::orderBy('application.id', 'DESC')
                                            ->join('collegeprofile', function ($join) use ($slug) {
                                               $join->on('application.collegeprofile_id', '=', 'collegeprofile.id')
                                                    ->where('collegeprofile.slug', '=', DB::raw($slug));
                                               })
                                            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
                                            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
                                            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
                                            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
                                            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
                                            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
                                            ->join('applicationstatus', 'application.applicationstatus_id', '=', 'applicationstatus.id')
                                            ->leftJoin('paymentstatus', 'application.paymentstatus_id', '=', 'paymentstatus.id')
                                            ->leftJoin('users', 'application.users_id','=', 'users.id')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->where('users.userstatus_id','!=','5')
                                            ->groupBy('application.id')
                                            ->paginate(20, array('application.id', 'application.created_at', 'applicationstatus.id as applicationstatusId','applicationstatus.name as applicationstatusName', 'percent10', 'percent11', 'percent12', 'totalfees', 'functionalarea.name as functionalareaName','degree.name as degreeName','course.name as courseName','users.firstname as userFirsrName','users.middlename as userMiddleName','users.lastname as userLastName','application.applicationID','paymentstatus.id as paymentstatusID','paymentstatus.name as paymentstatusName'));

                foreach ($getApplicationsDataObj as $key => $value) {
                    $value->getCollegeTransactionObj = Transaction::orderBy('transaction.id', 'DESC')
                                ->leftJoin('paymentstatus', 'transaction.paymentstatus_id', '=', 'paymentstatus.id')
                                ->leftJoin('cardtype', 'transaction.cardtype_id', '=', 'cardtype.id')
                                ->leftJoin('application', 'transaction.application_id', '=', 'application.id')
                                ->leftJoin('collegeprofile', 'application.collegeprofile_id', '=','collegeprofile.id')
                                ->where('transaction.application_id', '=', $value->id)
                                ->where('collegeprofile.users_id', '=', $userId)
                                ->where('collegeprofile.slug', '=', $slug)
                                ->select('transaction.id', 'transaction.name','paymentstatus.id as paymentstatusID','paymentstatus.name as paymentstatusName', 'cardtype.name as cardtypeName', 'application.id as applicationId','application.name as applicationName' ,'application.applicationID','transaction.created_at','totalfees', 'byafees', 'restfees','transaction.updated_at','application.firstname','application.lastname','application.middlename','application.created_at as applicationCreated_at')
                                ->get();
                }
               
                return view('college/college-profile-partial.transaction-list')
                        ->with('getApplicationsDataObj', $getApplicationsDataObj)
                        ->with('slug', $slug)
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


     /************************************************************************************
    *   LIST ALL THE COLLEGE Admission Procedure
    /************************************************************************************/
    public function listAdmissionProcedureAction(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                $getAdmissionProcedureObj  = CollegeAdmissionProcedure::getAdmissionProcedureObj($slug);
                return view('college/admission-procedure.index')
                        ->with('getAdmissionProcedureObj', $getAdmissionProcedureObj)
                        ->with('slug', $slug)
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

    /************************************************************************************
    *   CREATE COLLEGE Admission Procedure
    /************************************************************************************/
    public function createAdmissionProcedureAction(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $educationLevelObj = EducationLevel::all();
                $functionalAreaObj = FunctionalArea::all();
                $courseTypeObj = CourseType::all();
                $courseObj = DB::table('course')
                        ->orderBy('course.name', 'ASC')
                        ->get()
                        ;
                $getAdmissionProcedureObj  = (object)[
                                    'title'                 => '',
                                    'description'           => '',
                                    'functionalarea_id'     => '',
                                    'educationlevel_id'     => '',
                                    'degree_id'             => '',
                                    'coursetype_id'         => '',
                                    'course_id'             => '',
                                ];

                return view('college/admission-procedure.create')
                        ->with('getAdmissionProcedureObj', $getAdmissionProcedureObj)
                        ->with('educationLevelObj', $educationLevelObj)
                        ->with('functionalAreaObj', $functionalAreaObj)
                        ->with('courseTypeObj', $courseTypeObj)
                        ->with('courseObj', $courseObj)
                        ->with('slug', $slug)
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

    /************************************************************************************
    *   STORE COLLEGE Admission Procedure
    /************************************************************************************/
    public function storeAdmissionProcedureAction(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();
                $create                                 = New CollegeAdmissionProcedure; 
                $create->title                          = Input::get('title');
                $create->description                    = Input::get('description');
                $create->functionalarea_id              = Input::get('functionalarea_id');
                $create->educationlevel_id              = Input::get('educationlevel_id');
                $create->degree_id                      = Input::get('degree_id');
                $create->coursetype_id                  = Input::get('coursetype_id');
                $create->course_id                      = Input::get('course_id');
                $create->collegeprofile_id              = $collegeProfileObj->id;
                $create->users_id                       = Auth::id();
                $create->employee_id                    = Auth::id();
                $create->save();

                if (!empty(Input::get('eventName'))) {
                    $sizeOfImpDatesList = sizeof(Input::get('eventName'));
                    for($eventCount = 0; $eventCount < $sizeOfImpDatesList; $eventCount++){
                        $createImportantDates                               = New CollegeAdmissionImportantDated;
                        $createImportantDates->eventName                    = Input::get('eventName')[$eventCount];
                        $createImportantDates->fromdate                     = Input::get('fromdate')[$eventCount];
                        $createImportantDates->todate                       = Input::get('todate')[$eventCount];
                        $createImportantDates->collegeAdmissionProcedure_id = $create->id;
                        $createImportantDates->collegeprofile_id            = $collegeProfileObj->id;
                        $createImportantDates->users_id                     = $userId;
                        $createImportantDates->employee_id                  = $userId;
                        $createImportantDates->save();
                    }
                }
                return Redirect::to('college/admission-procedure/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    /************************************************************************************
    *   SHOW COLLEGE Admission Procedure
    /************************************************************************************/
    public function showAdmissionProcedureAction(Request $request, $slug, $id)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getAdmissionProcedureObj = CollegeAdmissionProcedure::orderBy('college_admission_procedures.id', 'DESC')
                                                ->leftJoin('collegeprofile', 'college_admission_procedures.collegeprofile_id', '=', 'collegeprofile.id')
                                                ->leftJoin('educationlevel','college_admission_procedures.educationlevel_id','=','educationlevel.id')
                                                ->leftJoin('functionalarea','college_admission_procedures.functionalarea_id','=','functionalarea.id')
                                                ->leftJoin('degree','college_admission_procedures.degree_id','=','degree.id')
                                                ->leftJoin('coursetype','college_admission_procedures.coursetype_id','=','coursetype.id')
                                                ->leftJoin('course','college_admission_procedures.course_id','=','course.id')
                                                ->where('collegeprofile.slug', '=', $slug)
                                                ->select(
                                                        'college_admission_procedures.id',
                                                        'college_admission_procedures.title', 
                                                        'college_admission_procedures.description',
                                                        'college_admission_procedures.functionalarea_id',
                                                        'college_admission_procedures.educationlevel_id',
                                                        'college_admission_procedures.degree_id',
                                                        'college_admission_procedures.coursetype_id',
                                                        'college_admission_procedures.course_id',
                                                        'college_admission_procedures.users_id',
                                                        'college_admission_procedures.collegeprofile_id', 
                                                        'educationlevel.id as educationlevelId',
                                                        'educationlevel.name as educationlevelName',
                                                        'functionalarea.id as functionalareaId',
                                                        'functionalarea.name as functionalareaName', 
                                                        'degree.id as degreeId', 
                                                        'degree.name as degreeName', 
                                                        'coursetype.id as coursetypeId', 
                                                        'coursetype.name as coursetypeName', 
                                                        'course.id as courseId', 
                                                        'course.name as courseName',
                                                        'collegeprofile.slug'
                                                    )
                                                ->findOrFail($id);


                $importantDatesObj = DB::table('college_admission_important_dateds')
                                ->where('college_admission_important_dateds.collegeAdmissionProcedure_id','=', $id)
                                ->where('college_admission_important_dateds.users_id','=', $userId)
                                ->where('college_admission_important_dateds.collegeprofile_id','=', $getAdmissionProcedureObj->collegeprofile_id)
                                ->orderBy('college_admission_important_dateds.id', 'ASC')
                                ->get();
                return view('college/admission-procedure.show')
                            ->with('getAdmissionProcedureObj', $getAdmissionProcedureObj)
                            ->with('importantDatesObj', $importantDatesObj)
                            ->with('slug', $slug)
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

    /************************************************************************************
    *   EDIT COLLEGE Admission Procedure
    /************************************************************************************/
    public function editAdmissionProcedureAction(Request $request, $slug, $id)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $getAdmissionProcedureObj = CollegeAdmissionProcedure::findOrFail($id);
                $importantDatesObj = DB::table('college_admission_important_dateds')
                                ->where('college_admission_important_dateds.collegeAdmissionProcedure_id','=', $id)
                                ->where('college_admission_important_dateds.users_id','=', $userId)
                                ->where('college_admission_important_dateds.collegeprofile_id','=', $getAdmissionProcedureObj->collegeprofile_id)
                                ->orderBy('college_admission_important_dateds.id', 'ASC')
                                ->get();

                $educationLevelObj = EducationLevel::all();
                $functionalAreaObj = FunctionalArea::all();
                $courseTypeObj = CourseType::all();
                $courseObj = DB::table('course')
                        ->orderBy('course.name', 'ASC')
                        ->get()
                        ;
                $degreeObj = Degree::all();

                return view('college/admission-procedure.edit')
                            ->with('getAdmissionProcedureObj', $getAdmissionProcedureObj)
                            ->with('importantDatesObj', $importantDatesObj)
                            ->with('educationLevelObj', $educationLevelObj)
                            ->with('functionalAreaObj', $functionalAreaObj)
                            ->with('courseTypeObj', $courseTypeObj)
                            ->with('courseObj', $courseObj)
                            ->with('degreeObj', $degreeObj)
                            ->with('slug', $slug)
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

    /************************************************************************************
    *   UPDATE COLLEGE Admission Procedure
    /************************************************************************************/
    public function updateAdmissionProcedureAction(Request $request, $slug)
    {
        if (Auth::check())
        {   

            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();

                $checkuserObj  =  CollegeAdmissionProcedure::orderBy('college_admission_procedures.id', 'DESC')
                                    ->leftJoin('collegeprofile', 'college_admission_procedures.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->where('collegeprofile.slug', '=', $slug)
                                    ->where('college_admission_procedures.id', '=', Input::get('id'))
                                    ->count();

                if ($checkuserObj == 1) {
                    $update                                 = CollegeAdmissionProcedure::findOrFail(Input::get('id')); 
                    $update->title                          = Input::get('title');
                    $update->description                    = Input::get('description');
                    $update->functionalarea_id              = Input::get('functionalarea_id');
                    $update->educationlevel_id              = Input::get('educationlevel_id');
                    $update->degree_id                      = Input::get('degree_id');
                    $update->coursetype_id                  = Input::get('coursetype_id');
                    $update->course_id                      = Input::get('course_id');
                    $update->collegeprofile_id              = $collegeProfileObj->id;
                    $update->users_id                       = Auth::id();
                    $update->employee_id                    = Auth::id();
                    $update->save();


                    if (!empty(Input::get('eventName'))) {
                        Db::table('college_admission_important_dateds')
                            ->where('college_admission_important_dateds.collegeAdmissionProcedure_id','=', Input::get('id'))
                            ->where('college_admission_important_dateds.users_id', '=', $userId)
                            ->where('college_admission_important_dateds.collegeprofile_id', '=', $collegeProfileObj->id)
                            ->delete();

                        $sizeOfImpDatesList = sizeof(Input::get('eventName'));
                        for($eventCount = 0; $eventCount < $sizeOfImpDatesList; $eventCount++){
                            $createImportantDates                               = New CollegeAdmissionImportantDated;
                            $createImportantDates->eventName                    = Input::get('eventName')[$eventCount];
                            $createImportantDates->fromdate                     = Input::get('fromdate')[$eventCount];
                            $createImportantDates->todate                       = Input::get('todate')[$eventCount];
                            $createImportantDates->collegeAdmissionProcedure_id = $update->id;
                            $createImportantDates->collegeprofile_id            = $collegeProfileObj->id;
                            $createImportantDates->users_id                     = $userId;
                            $createImportantDates->employee_id                  = $userId;
                            $createImportantDates->save();
                        }
                    }
                }
                return Redirect::to('college/admission-procedure/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    /************************************************************************************
    *   DELETE COLLEGE Admission Procedure
    /************************************************************************************/
    public function removeAdmissionProcedureAction(Request $request, $slug, $id)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '2' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                 $collegeFaqs = DB::table('college_admission_procedures')
                        ->leftJoin('collegeprofile', 'college_admission_procedures.collegeprofile_id', '=','collegeprofile.id')
                        ->where('college_admission_procedures.id', '=', $id)
                        ->where('collegeprofile.slug', '=', $slug)
                        ->orderBy('college_admission_procedures.id', 'DESC')
                        ->select('college_admission_procedures.id')
                        ->get()
                        ;
                if(sizeof($collegeFaqs) > 0) {
                    DB::table('college_admission_important_dateds')
                        ->where('college_admission_important_dateds.collegeAdmissionProcedure_id','=', $id)
                        ->delete();

                    CollegeAdmissionProcedure::destroy($id);    
                }
                return Redirect::to('college/admission-procedure/'.$slug);
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