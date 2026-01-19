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
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\Country;
use App\Models\State;
use App\Models\CollegeType;
use App\Models\City;
use App\Models\Address;
use App\Models\Gallery;
use App\Models\Document;
use App\Models\AddressType;
use App\Models\CollegeProfile;
use App\Models\Degree;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\EducationLevel;
use App\Models\FunctionalArea;
use App\Models\CollegeMaster;
use App\Models\Placement;
use App\Models\Faculty;
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
use App\Http\Controllers\website\WebsiteLogController;

class CollegeProfileShowController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

	public function index(Request $request, $slug)
    {	
        //REDIRECT IF USER STATUS IS DISABLED
        $checkDisabledStatus = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id')->where('collegeprofile.slug', '=', $slug)->firstOrFail();
        if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
            return Redirect::to('/');
        }

        $getCollegeDetailObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->where('collegeprofile.slug', '=', $slug)
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('users.id as usersId', 'users.firstname', 'users.phone', 'users.email', 'collegeprofile.id as collegeprofileId', 'collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegeprofile.description','collegeprofile.slug', 'collegeprofile.facebookurl')
                                ->get()
                                ;

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.COLLEGEVIEW').' by this User Id '.Auth::id().' College Id '.$getCollegeDetailObj[0]->collegeprofileId.' '.$slug);

        $collegeID = $getCollegeDetailObj[0]->collegeprofileId;
        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventCollege(Config::get('systemsetting.COLLEGEVIEW').' by this User Id '.Auth::id().' College Id '.$getCollegeDetailObj[0]->collegeprofileId.' '.$slug, $collegeID);

        $getCollegeAddressObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                ->where('users.userstatus_id', '!=', '5')
                                ->where('collegeprofile.slug', '=', $slug)
                                ->select('users.id as usersId','address.id as adressID', 'address.name', 'address.address1', 'address.address2','address.postalcode','addresstype.id as addresstypeId','addresstype.name as addresstypeName', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName','address.landmark')
                                ->get()
                                ;

        $getCollegeProfileDataObj = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->leftJoin('gallery','users.id','=','gallery.users_id')
                                    ->where('collegeprofile.slug', '=', $slug)
                                    ->where('gallery.caption', '=', 'College Logo')
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId', 'users.suffix','users.firstname as firstName','users.email as userEmailAddress', 'users.phone as userPhone','collegeprofile.description', 'collegeprofile.estyear', 'collegeprofile.website', 'collegeprofile.collegecode', 'collegeprofile.contactpersonname', 'collegeprofile.contactpersonemail', 'collegeprofile.contactpersonnumber','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage', 'gallery.width', 'gallery.height')
                                    ->orderBy('gallery.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;

         $getCollegeMasterCoursesObj = DB::table('collegeprofile')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->leftJoin('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                                        ->leftJoin('educationlevel','collegemaster.educationlevel_id','=','educationlevel.id')
                                        ->leftJoin('functionalarea','collegemaster.functionalarea_id','=','functionalarea.id')
                                        ->leftJoin('degree','collegemaster.degree_id','=','degree.id')
                                        ->leftJoin('coursetype','collegemaster.coursetype_id','=','coursetype.id')
                                        ->leftJoin('course','collegemaster.course_id','=','course.id')
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegemaster.id as collegemasterId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'collegemaster.fees', 'collegemaster.seats','collegemaster.twelvemarks','collegemaster.others','collegemaster.seatsallocatedtobya','collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegemaster.courseduration','collegemaster.description as courseDescription')
                                        ->orderBy('course.name','ASC')
                                        ->get()
                                        ;

         $getCourseListCount = DB::table('collegeprofile')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->join('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;

        $getCollegeCalender = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->leftJoin('event','collegeprofile.id','=','event.collegeprofile_id')
                                    ->where('collegeprofile.slug', '=', $slug)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId','event.id as eventId','event.name', 'event.datetime', 'event.venue', 'event.description', 'event.link')
                                    ->orderBy('collegeprofile.id', 'ASC')
                                    ->get()
                                    ;
       
                if( empty($getCollegeCalender) ){
                    $getCollegeCalender = '';
                }

        $getEventListCount = DB::table('collegeprofile')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->join('event','collegeprofile.id','=','event.collegeprofile_id')
                                        ->where('collegeprofile.slug', '=', $slug)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
                if( empty($getEventListCount) ){
                    $getEventListCount = '';
                }

        $collegeFacilityDataObj = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->join('collegefacilities','collegeprofile.id','=','collegefacilities.collegeprofile_id')
                                    ->join('facilities','collegefacilities.facilities_id','=','facilities.id')
                                    ->where('collegeprofile.slug', '=', $slug)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId','collegefacilities.id as collegefacilitiesId','collegefacilities.name',  'collegefacilities.description','facilities.id as facilitiesId', 'facilities.name as facilitiesName','facilities.iconname as iconname')
                                    ->orderBy('collegeprofile.id', 'ASC')
                                    ->get()
                                    ;

                if( empty($collegeFacilityDataObj) ){
                    $collegeFacilityDataObj = '';
                }

        $getCollegeFacilityListCount = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->join('collegefacilities','collegeprofile.id','=','collegefacilities.collegeprofile_id')
                                    ->where('collegeprofile.slug', '=', $slug)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->count()
                                    ;
                if( empty($getCollegeFacilityListCount) ){
                    $getCollegeFacilityListCount = '';
                }

        if (Auth::check())
        {
            //GET BOOKMARKED COLLEGE PROFILE STATUS
            $getBookMarkedCollegeStaus = DB::table('bookmarks')
                                            ->leftJoin('users', 'bookmarks.student_id', '=', 'users.id')
                                            ->leftJoin('collegeprofile', 'bookmarks.college_id', '=', 'collegeprofile.id')
                                            ->where('users.id', '=', Auth::id())
                                            ->where('users.userrole_id', '=', '3')
                                            ->where('bookmarks.bookmarktypeinfo_id', '=', '1')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->select('bookmarks.id', 'bookmarks.college_id')
                                            ->orderBy('bookmarks.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
                                            
            //VISIBLE ONLY IF COLLEGE LOGGED IN
            $checkCollegeIsLoggedIn = DB::table('users')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('users.userrole_id', '=', '2')
                                        ->where('users.userstatus_id', '=', '1')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
            if( $checkCollegeIsLoggedIn == '1' ){
                Session::flash('rightNowCollegeLogIn', 'You are currently in public view mode. To update details, please go to the');     
            }            
        }else{
            $getBookMarkedCollegeStaus = '';
        }

        //GET THE HOME PAGE BANNER AD
        /*$getCollegeDetailBannerAds = DB::table('ads_managements')
                                ->where('slug', '=', 3)
                                ->where('isactive', '=', 1)
                                ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                                ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                                ->select('img', 'redirectto')
                                ->orderBy('ads_managements.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;*/

        $getCollegeDetailBannerAds = [];
        $getListOfAdsManagements = $this->fetchDataServiceController->getListOfAdsManagements(3);

        $agent = new Agent();
        return view('college/college-profile-show-partial.index')
                        ->with('slugUrl', $request->slug)
                        ->with('getCourseListCount', $getCourseListCount)
                        ->with('getCollegeMasterCoursesObj', $getCollegeMasterCoursesObj)
                        ->with('getCollegeProfileDataObj', $getCollegeProfileDataObj)
                        ->with('getCollegeDetailObj', $getCollegeDetailObj)
                        ->with('getCollegeAddressObj', $getCollegeAddressObj)
                        ->with('getCollegeCalender', $getCollegeCalender)
                        ->with('getEventListCount', $getEventListCount)
                        ->with('getCollegeFacilityListCount', $getCollegeFacilityListCount)
                        ->with('collegeFacilityDataObj',$collegeFacilityDataObj)
                        ->with('getBookMarkedCollegeStaus',$getBookMarkedCollegeStaus)
                        ->with('getCollegeDetailBannerAds',$getCollegeDetailBannerAds)
                        ->with('agent', $agent)
                        ->with('getListOfAdsManagements', $getListOfAdsManagements)
                        ;
    }

    public function courseListShow(Request $request)
    {
        $collegeProfileDataObj = DB::table('collegeprofile')
                                    ->leftJoin('collegetype', 'collegeprofile.collegetype_id', '=', 'collegetype.id')
                                    ->leftJoin('university', 'collegeprofile.university_id', '=', 'university.id')
                                    ->where('collegeprofile.slug', '=', Input::get('slug'))
                                    ->select('collegeprofile.id as collegeprofileId','description', 'estyear', 'website', 'collegecode', 'contactpersonname', 'contactpersonemail', 'contactpersonnumber', 'review', 'agreement','slug', 'collegetype.id as collegetypeId', 'collegetype.name as collegetypeName', 'university.name as universityName','approvedBy')
                                    ->get()
                                    ;
        
        $getCourseListCount = DB::table('collegeprofile')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->join('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                                        ->where('collegeprofile.slug', '=', Input::get('slug'))
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;

        $getCollegeMasterCoursesObj = DB::table('collegeprofile')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->leftJoin('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                                        ->leftJoin('educationlevel','collegemaster.educationlevel_id','=','educationlevel.id')
                                        ->leftJoin('functionalarea','collegemaster.functionalarea_id','=','functionalarea.id')
                                        ->leftJoin('degree','collegemaster.degree_id','=','degree.id')
                                        ->leftJoin('coursetype','collegemaster.coursetype_id','=','coursetype.id')
                                        ->leftJoin('course','collegemaster.course_id','=','course.id')
                                        ->where('collegeprofile.slug', '=', Input::get('slug'))
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegemaster.id as collegemasterId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'collegemaster.fees', 'collegemaster.seats','collegemaster.twelvemarks','collegemaster.others','collegemaster.seatsallocatedtobya','collegeprofile.slug','collegemaster.courseduration','collegemaster.description as courseDescription','collegeprofile.agreement')
                                        ->get()
                                        ;

        $getEventListCount = DB::table('collegeprofile')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->join('event','collegeprofile.id','=','event.collegeprofile_id')
                                        ->where('collegeprofile.slug', '=', Input::get('slug'))
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
        $getCollegeCalender = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->leftJoin('event','collegeprofile.id','=','event.collegeprofile_id')
                                    ->where('collegeprofile.slug', '=', Input::get('slug'))
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId','event.id as eventId','event.name', 'event.datetime', 'event.venue', 'event.description', 'event.link')
                                    ->orderBy('collegeprofile.id', 'ASC')
                                    ->get()
                                    ;        
                

        $htmlBlock = view('college/college-profile-show-partial.college-course-fee-partials')
                        ->with('collegeProfileDataObj', $collegeProfileDataObj)
                        ->with('getCourseListCount', $getCourseListCount)
                        ->with('getCollegeMasterCoursesObj', $getCollegeMasterCoursesObj)
                        ->with('getEventListCount', $getEventListCount)
                        ->with('getCollegeCalender', $getCollegeCalender)
                        ->with('slugUrl', Input::get('slug'))
                        ->render()
                        ;
        return response()->json($htmlBlock);        
    }

    public function profilePartialShow(Request $request)
    {
        $collegeProfileDataObj = DB::table('collegeprofile')
                                    ->leftJoin('collegetype', 'collegeprofile.collegetype_id', '=', 'collegetype.id')
                                    ->leftJoin('university', 'collegeprofile.university_id', '=', 'university.id')
                                    ->where('collegeprofile.slug', '=', Input::get('slug'))
                                    ->select('collegeprofile.id as collegeprofileId','description', 'estyear', 'website', 'collegecode', 'contactpersonname', 'contactpersonemail', 'contactpersonnumber', 'review', 'agreement','slug', 'collegetype.id as collegetypeId', 'collegetype.name as collegetypeName', 'university.name as universityName','approvedBy', 'collegeprofile.updated_at')
                                    ->get()
                                    ;
        
        if( empty($collegeProfileDataObj) ){
            $collegeProfileDataObj = '';
        }

        $getRegisteredCollegeAddress = DB::table('collegeprofile')
                                        ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                        ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                        ->where('collegeprofile.slug', '=', Input::get('slug'))
                                        ->where('addresstype.id', '=', '1')
                                        ->select('collegeprofile.id', 'address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalcode','city.name as cityName', 'state.name as stateName', 'country.name as countryName')
                                        ->get()
                                        ;
        $getCampusCollegeAddress = DB::table('collegeprofile')
                                        ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                        ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                        ->where('collegeprofile.slug', '=', Input::get('slug'))
                                        ->where('addresstype.id', '=', '2')
                                        ->select('collegeprofile.id', 'address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalcode','city.name as cityName', 'state.name as stateName', 'country.name as countryName')
                                        ->get()
                                        ;
        
        $htmlBlock = view('college/college-profile-show-partial.profileShowPartial')
                        ->with('collegeProfileDataObj', $collegeProfileDataObj)
                        ->with('getRegisteredCollegeAddress', $getRegisteredCollegeAddress)
                        ->with('getCampusCollegeAddress', $getCampusCollegeAddress)
                        ->with('slugUrl', Input::get('slug'))
                        ->render()
                        ;
        return response()->json($htmlBlock);        
    }
   
    public function addressPartialShow(Request $request)
    {
        $getRegisteredCollegeAddress = DB::table('collegeprofile')
                                        ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                        ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                        ->where('collegeprofile.slug', '=', Input::get('slug'))
                                        ->where('addresstype.id', '=', '1')
                                        ->select('collegeprofile.id', 'address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalcode','city.name as cityName', 'state.name as stateName', 'country.name as countryName')
                                        ->get()
                                        ;
        if( empty($getRegisteredCollegeAddress) ){
            $getRegisteredCollegeAddress = '';
        }
        $getCampusCollegeAddress = DB::table('collegeprofile')
                                        ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                        ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                        ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                        ->where('collegeprofile.slug', '=', Input::get('slug'))
                                        ->where('addresstype.id', '=', '2')
                                        ->select('collegeprofile.id', 'address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalcode','city.name as cityName', 'state.name as stateName', 'country.name as countryName')
                                        ->get()
                                        ;
        if( empty($getCampusCollegeAddress) ){
            $getCampusCollegeAddress = '';
        }

        $htmlBlock = view('college/college-profile-show-partial.addressShowPartial')
                        ->with('getRegisteredCollegeAddress', $getRegisteredCollegeAddress)
                        ->with('getCampusCollegeAddress', $getCampusCollegeAddress)
                        ->with('slugUrl', Input::get('slug'))
                        ->render()
                        ;
        return response()->json($htmlBlock);  
    }

    public function photoVideoPartialShow(Request $request)
    {
        $getOldUploadedImages = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->leftJoin('gallery','gallery.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', Input::get('slug'))
                            ->where('gallery.misc', '=', 'college-upload-gallery-img')
                            ->where('gallery.caption', '!=', 'College Logo')
                            ->where('gallery.misc', '!=', 'affiliationLettersImage')
                            ->where('gallery.caption', '!=', 'videogallery')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'gallery.name as galleryName', 'gallery.fullimage','gallery.caption', 'gallery.width', 'gallery.height')
                            ->get()
                            ;

        $getOldUploadedVideos = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->leftJoin('gallery','gallery.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', Input::get('slug'))
                            ->where('gallery.caption', '=', 'videogallery')
                            ->where('gallery.misc', '=', 'videogallery')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'gallery.name as galleryName', 'gallery.fullimage','gallery.caption', 'gallery.width', 'gallery.height')
                            ->get()
                            ;

        if( empty($getOldUploadedImages) ){
            $getOldUploadedImages = '';
        }

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

        $getOldUploadedImagesAttach = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->join('documents','documents.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', Input::get('slug'))
                            ->where('documents.name', '!=', 'no-image-upload')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height')
                            ->get()
                            ;

        $getOldUploadedDescription = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->join('documents','documents.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', Input::get('slug'))
                            ->where('documents.name', '=', 'no-image-upload')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height')
                            ->get()
                            ;

        $dataArrayContentAttach = array();
        $dataArrayAttach = array();
        if( empty($getOldUploadedImagesAttach) ){
            $getOldUploadedImagesAttach = '';
        }else{
            foreach ($getOldUploadedImagesAttach as $item) {
                $fileName = $item->documentsName;
                $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                
                //Data Array Content
                $dataArrayContentAttach['collegeprofileId'] = $item->collegeprofileId;
                $dataArrayContentAttach['usersId'] = $item->usersId;
                $dataArrayContentAttach['documentsId'] = $item->documentsId;
                $dataArrayContentAttach['documentsName'] = $item->documentsName;
                $dataArrayContentAttach['fullimage'] = $item->fullimage;
                $dataArrayContentAttach['description'] = $item->description;
                $dataArrayContentAttach['ext'] = $ext;
                $dataArrayAttach[] = $dataArrayContentAttach;
            }
        }

        $htmlBlock = view('college/college-profile-show-partial.photoVideoShowPartial')
                        ->with('getOldUploadedImages', $getOldUploadedImages)
                        ->with('getOldUploadedVideos', $dataArray)
                        ->with('getOldUploadedImagesAtt', $dataArrayAttach)
                        ->with('getOldUploadedDescription', $getOldUploadedDescription)
                        ->with('slugUrl', Input::get('slug'))
                        ->render()
                        ;
        return response()->json($htmlBlock);  
    }

    public function achievementsPartialShow(Request $request)
    {
        $getOldUploadedImages = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->join('documents','documents.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', Input::get('slug'))
                            ->where('documents.name', '!=', 'no-image-upload')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height')
                            ->get()
                            ;

        $getOldUploadedDescription = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->join('documents','documents.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', Input::get('slug'))
                            ->where('documents.name', '=', 'no-image-upload')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height')
                            ->get()
                            ;

        if( empty($getOldUploadedDescription) ){
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
                $dataArrayContent['collegeprofileId'] = $item->collegeprofileId;
                $dataArrayContent['usersId'] = $item->usersId;
                $dataArrayContent['documentsId'] = $item->documentsId;
                $dataArrayContent['documentsName'] = $item->documentsName;
                $dataArrayContent['fullimage'] = $item->fullimage;
                $dataArrayContent['description'] = $item->description;
                $dataArrayContent['ext'] = $ext;
                $dataArray[] = $dataArrayContent;
            }
        }

        $htmlBlock = view('college/college-profile-show-partial.achievementShowPartial')
                        ->with('getOldUploadedImages', $dataArray)
                        ->with('getOldUploadedDescription', $getOldUploadedDescription)
                        ->with('slugUrl', Input::get('slug'))
                        ->render()
                        ;
        return response()->json($htmlBlock);  
    }

    public function placementPartialShow(Request $request)
    {
        $collegePlacementDataObj = DB::table('collegeprofile')
                                    ->leftJoin('placement','collegeprofile.id','=','placement.collegeprofile_id')
                                    ->where('collegeprofile.slug', '=', Input::get('slug'))
                                    ->select('placement.numberofrecruitingcompany', 'placement.numberofplacementlastyear', 'placement.ctchighest', 'placement.ctclowest', 'placement.ctcaverage','placement.placementinfo')
                                    ->get()
                                    ;
        if( empty($collegePlacementDataObj) ){
            $collegePlacementDataObj = '';
        }
        $htmlBlock = view('college/college-profile-show-partial.placementShowPartial')
                        ->with('collegePlacementDataObj', $collegePlacementDataObj)
                        ->with('slugUrl', Input::get('slug'))->render();
        return response()->json($htmlBlock);
    }


    public function applyCourses(Request $request, $collegemasterId, $slugUrl)
    {   
        $checkDisabledStatus = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id')->where('collegeprofile.slug', '=', $slugUrl)->firstOrFail();
        if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
            return Redirect::to('/');
        }
       
        //CollegeMaster::destroy($collegemasterId);
        $getCollegeProfileDataObj = DB::table('collegeprofile')
                            ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->leftJoin('gallery','users.id','=','gallery.users_id')
                            ->where('collegeprofile.slug', '=', $slugUrl)
                            ->where('gallery.caption', '=', 'College Logo')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId', 'users.suffix','users.firstname as firstName','users.email as userEmailAddress', 'users.phone as userPhone','collegeprofile.description', 'collegeprofile.estyear', 'collegeprofile.website', 'collegeprofile.collegecode', 'collegeprofile.contactpersonname', 'collegeprofile.contactpersonemail', 'collegeprofile.contactpersonnumber','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage')
                            ->orderBy('collegeprofile.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;
        $getCollegeDetailObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->where('collegeprofile.slug', '=', $slugUrl)
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('users.id as usersId', 'users.firstname', 'users.phone', 'users.email', 'collegeprofile.id as collegeprofileId', 'collegeprofile.review','collegeprofile.verified', 'collegeprofile.agreement', 'collegeprofile.description','collegeprofile.slug')
                                ->get()
                                ;

        $getCollegeAddressObj = DB::table('collegeprofile')
                                ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                ->where('collegeprofile.slug', '=', $slugUrl)
                                ->where('collegemaster.id','=', $collegemasterId)   
                                ->where('users.userstatus_id', '!=', '5')
                                ->select('users.id as usersId','address.id as adressID', 'address.name', 'address.address1', 'address.address2','address.postalcode','addresstype.id as addresstypeId','addresstype.name as addresstypeName', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName','address.landmark')
                                ->get()
                                ;
    
        $getCollegeMasterCoursesObj = DB::table('collegeprofile')
                                        ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                        ->leftJoin('collegemaster','collegeprofile.id','=','collegemaster.collegeprofile_id')
                                        ->leftJoin('educationlevel','collegemaster.educationlevel_id','=','educationlevel.id')
                                        ->leftJoin('functionalarea','collegemaster.functionalarea_id','=','functionalarea.id')
                                        ->leftJoin('degree','collegemaster.degree_id','=','degree.id')
                                        ->leftJoin('coursetype','collegemaster.coursetype_id','=','coursetype.id')
                                        ->leftJoin('course','collegemaster.course_id','=','course.id')
                                        ->where('collegeprofile.slug', '=', $slugUrl)
                                        ->where('collegemaster.id','=', $collegemasterId)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('collegemaster.id as collegemasterId', 'educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName', 'collegemaster.fees', 'collegemaster.seats','collegemaster.twelvemarks','collegemaster.others','collegemaster.seatsallocatedtobya','collegeprofile.slug','collegemaster.courseduration','collegemaster.description as courseDescription')
                                        ->get()
                                        ;

        // $getFacultyMemberDetails = DB::table('collegeprofile')
        //                             ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
        //                             ->join('faculty', 'faculty.collegemaster_id', '=', 'collegemaster.id')
        //                             ->where('collegeprofile.slug', '=', $slugUrl)
        //                             ->where('collegemaster.id','=', $collegemasterId)
        //                             ->select('faculty.suffix', 'faculty.name', 'faculty.description')
        //                             ->groupBy('faculty.id')
        //                             ->orderBy('faculty.id', 'ASC')
        //                             ->get()
        //                             ;
        $getFacultyMemberDetails = [];

        $getCollegeMasterFacultyObj = DB::table('college_master_associate_faculties')
                                            ->join('collegeprofile', 'college_master_associate_faculties.collegeprofile_id', '=', 'collegeprofile.id')
                                            ->join('faculty', 'college_master_associate_faculties.faculty_id', '=', 'faculty.id')
                                            ->where('collegeprofile.slug', '=', $slugUrl)
                                            ->where('college_master_associate_faculties.collegemaster_id', '=', $collegemasterId)
                                            ->select('faculty.id','faculty.name','faculty.suffix','faculty.designation', DB::raw("CONCAT(faculty.suffix,' ',faculty.name,' (Designation - ', faculty.designation,')') as fullname"),'faculty.description','faculty.imagename','faculty.languageKnown','collegeprofile.users_id')
                                            ->orderBy('faculty.id','ASC')
                                            ->get()
                                            ;

        $collegeFacilityDataObj = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id')
                                    ->join('collegefacilities','collegeprofile.id','=','collegefacilities.collegeprofile_id')
                                    ->join('facilities','collegefacilities.facilities_id','=','facilities.id')
                                    ->where('collegeprofile.slug', '=', $slugUrl)
                                    ->where('collegemaster.id','=', $collegemasterId)   
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId','collegefacilities.id as collegefacilitiesId','collegefacilities.name',  'collegefacilities.description','facilities.id as facilitiesId', 'facilities.name as facilitiesName','facilities.iconname as iconname')
                                    ->orderBy('collegeprofile.id', 'ASC')
                                    ->get()
                                    ;

        if( empty($collegeFacilityDataObj) ){
            $collegeFacilityDataObj = '';
        }


        if(Auth::check()){
            //GET COURSE BOOKMARKED STATUS
            $getCourseBookmarkedStatus = DB::table('bookmarks')
                                            ->leftJoin('users', 'bookmarks.student_id', '=', 'users.id')
                                            ->where('users.id', '=', Auth::id())
                                            ->where('users.userrole_id', '=', '3')
                                            ->where('bookmarks.bookmarktypeinfo_id', '=', '2')
                                            ->where('bookmarks.course_id', '=', $collegemasterId)
                                            ->select('bookmarks.id', 'bookmarks.course_id')
                                            ->orderBy('bookmarks.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
        }else{
            $getCourseBookmarkedStatus = '';
        }

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.COURSEVIEW').' by this User Id '.Auth::id().', College -'.$slugUrl.', Course Id '.$collegemasterId);

        $collegeID = $getCollegeDetailObj[0]->collegeprofileId;
        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventCourseCollege(Config::get('systemsetting.COURSEVIEW').' by this User Id '.Auth::id().', College -'.$slugUrl.', Course Id '.$collegemasterId, $collegeID, $collegemasterId);

        $agent = new Agent();
        return view('college/college-profile-show-partial.courseDetail')
                        ->with('slugUrl', $request->slugUrl)
                        ->with('getCollegeDetailObj', $getCollegeDetailObj)
                        ->with('getCollegeAddressObj', $getCollegeAddressObj)
                        ->with('getCollegeMasterCoursesObj', $getCollegeMasterCoursesObj)
                        ->with('getCollegeProfileDataObj', $getCollegeProfileDataObj)
                        ->with('getFacultyMemberDetails',$getFacultyMemberDetails)
                        ->with('collegeFacilityDataObj', $collegeFacilityDataObj)
                        ->with('collegemasterId', $collegemasterId)
                        ->with('getCourseBookmarkedStatus', $getCourseBookmarkedStatus)
                        ->with('getCollegeMasterFacultyObj', $getCollegeMasterFacultyObj)
                        ->with('agent', $agent)
                        ;
    }


    public function collegeCourseDetails(Request $request, $collegemasterId, $slugUrl)
    {   
        $checkDisabledStatus = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id')->where('collegeprofile.slug', '=', $slugUrl)->firstOrFail();
        if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
            return Redirect::to('/');
        }
       
        $getCollegeDetailObj = $this->fetchDataServiceController->fetchCollegeDetails($slugUrl);
        $collegeprofileId   =   $getCollegeDetailObj[0]->collegeprofileId; 

        $collegeRatingObj = $this->fetchDataServiceController->fetchCollegeRating($slugUrl);
        $getCollegeLogoObj = $this->fetchDataServiceController->fetchCollegeLogo($slugUrl);
        $getCollegeAddressObj = $this->fetchDataServiceController->fetchCollegeAddress($slugUrl);
        $getCollegeMasterCoursesObj = $this->fetchDataServiceController->fetchCollegeMasterCourses($slugUrl, $collegemasterId); 
        $getCollegeMasterFacultyObj = $this->fetchDataServiceController->fetchCollegeMasterFaculty($slugUrl, $collegemasterId);
        $collegeFacilityDataObj = $this->fetchDataServiceController->fetchCollegeFacilities($slugUrl);
        $fetchCollegeSocialMediaLinks = $this->fetchDataServiceController->fetchCollegeSocialMediaLinks($slugUrl);

        if(Auth::check()){
            //GET COURSE BOOKMARKED STATUS
            $getCourseBookmarkedStatus = DB::table('bookmarks')
                                            ->leftJoin('users', 'bookmarks.student_id', '=', 'users.id')
                                            ->where('users.id', '=', Auth::id())
                                            ->where('users.userrole_id', '=', '3')
                                            ->where('bookmarks.bookmarktypeinfo_id', '=', '2')
                                            ->where('bookmarks.course_id', '=', $collegemasterId)
                                            ->select('bookmarks.id', 'bookmarks.course_id')
                                            ->orderBy('bookmarks.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
        }else{
            $getCourseBookmarkedStatus = '';
        }

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.COURSEVIEW').' by this User Id '.Auth::id().', College -'.$slugUrl.', Course Id '.$collegemasterId);

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventCourseCollege(Config::get('systemsetting.COURSEVIEW').' by this User Id '.Auth::id().', College -'.$slugUrl.', Course Id '.$collegemasterId, $collegeprofileId, $collegemasterId);

        $agent = new Agent();
        return view('college.college-new-public-partial.college-course-details', compact('getCollegeDetailObj', 'collegeRatingObj','getCollegeLogoObj', 'getCollegeAddressObj', 'getCollegeMasterCoursesObj', 'getCollegeMasterFacultyObj','collegeFacilityDataObj','slugUrl','collegemasterId','getCourseBookmarkedStatus','fetchCollegeSocialMediaLinks','agent'));
    }

    public function reviewListShow(Request $request)
    {
        $htmlBlock = view('college/college-profile-show-partial.reviewShowPartial')
                        ->with('slugUrl', Input::get('slug'))
                        ->render();
        return response()->json($htmlBlock);         
    }

    public function scholarshipListShow(Request $request)
    {
        $htmlBlock = view('college/college-profile-show-partial.scholarshipShowPartial')
                        ->with('slugUrl', Input::get('slug'))
                        ->render();
        return response()->json($htmlBlock);         
    }

    public function facultyListShow(Request $request)
    {
        $getFacultyObj  = Faculty::getFacultyObj(Input::get('slug'));
        $htmlBlock = view('college/college-profile-show-partial.facultyShowPartial')
                        ->with('slugUrl', Input::get('slug'))
                        ->with('getFacultyObj', $getFacultyObj)
                        ->render();
        return response()->json($htmlBlock);         
    }

    public function collegeProfileDetails(Request $request, $slug)
    {   
        //REDIRECT IF USER STATUS IS DISABLED
        $checkDisabledStatus = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id')->where('collegeprofile.slug', '=', $slug)->firstOrFail();
        if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
            return Redirect::to('/');
        }

        $getCollegeDetailObj = $this->fetchDataServiceController->fetchCollegeDetails($slug);
        $collegeprofileId   =   $getCollegeDetailObj[0]->collegeprofileId; 

        $collegeRatingObj = $this->fetchDataServiceController->fetchCollegeRating($slug);
        $getCollegeLogoObj = $this->fetchDataServiceController->fetchCollegeLogo($slug);
        $getCollegeAddressObj = $this->fetchDataServiceController->fetchCollegeAddress($slug);
        $fetchCollegeSocialMediaLinks = $this->fetchDataServiceController->fetchCollegeSocialMediaLinks($slug);
        $sportsActivityDataObj = $this->fetchDataServiceController->fetchSportsActivity($slug);
        $collegeGalleryImagesObj = $this->fetchDataServiceController->fetchCollegeGalley($slug);
        $fetchCollegeManagementList = $this->fetchDataServiceController->fetchCollegeManagementList($slug);
        $fetchCollegeCoursesObj = $this->fetchDataServiceController->fetchCollegeCourses($slug);
        $collegeFacilityDataObj = $this->fetchDataServiceController->fetchCollegeFacilities($slug);
        $getCollegeEvents = $this->fetchDataServiceController->fetchCollegeEvents($slug);
        $collegeScholarshipsObj = $this->fetchDataServiceController->fetchCollegeScholarships($slug);
        $collegePlacementDataObj = $this->fetchDataServiceController->fetchCollegePlacement($slug);
        $collegeCutOffsObj = $this->fetchDataServiceController->fetchCollegeCutOffs($slug);

        $getOldUploadedVideos = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->leftJoin('gallery','gallery.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slug)
                            ->where('gallery.caption', '=', 'videogallery')
                            ->where('gallery.misc', '=', 'videogallery')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'gallery.name as galleryName', 'gallery.fullimage','gallery.caption', 'gallery.width', 'gallery.height')
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

        $getOldUploadedImagesAttach = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->join('documents','documents.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slug)
                            ->where('documents.name', '!=', 'no-image-upload')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height')
                            ->get()
                            ;

        $getOldUploadedDescription = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->join('documents','documents.users_id', '=','users.id')
                            ->where('collegeprofile.slug', '=', $slug)
                            ->where('documents.name', '=', 'no-image-upload')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height')
                            ->get()
                            ;

        $dataArrayContentAttach = array();
        $dataArrayAttach = array();
        if( empty($getOldUploadedImagesAttach) ){
            $getOldUploadedImagesAttach = '';
        }else{
            foreach ($getOldUploadedImagesAttach as $item) {
                $fileName = $item->documentsName;
                $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                
                //Data Array Content
                $dataArrayContentAttach['collegeprofileId'] = $item->collegeprofileId;
                $dataArrayContentAttach['usersId'] = $item->usersId;
                $dataArrayContentAttach['documentsId'] = $item->documentsId;
                $dataArrayContentAttach['documentsName'] = $item->documentsName;
                $dataArrayContentAttach['fullimage'] = $item->fullimage;
                $dataArrayContentAttach['description'] = $item->description;
                $dataArrayContentAttach['ext'] = $ext;
                $dataArrayAttach[] = $dataArrayContentAttach;
            }
        }

        //GET THE HOME PAGE BANNER AD
        //$getCollegeDetailBannerAds = $this->fetchDataServiceController->fetchCollegeDetailBannerAds($slug);
        $getCollegeDetailBannerAds = [];
        $getListOfAdsManagements = $this->fetchDataServiceController->getListOfAdsManagements(3);
        $storeCollegeViewLog = $this->fetchDataServiceController->storeCollegeViewLog($collegeprofileId, $slug);

        if (Auth::check()){
            //GET BOOKMARKED COLLEGE PROFILE STATUS
            $getBookMarkedCollegeStaus = DB::table('bookmarks')
                                            ->leftJoin('users', 'bookmarks.student_id', '=', 'users.id')
                                            ->leftJoin('collegeprofile', 'bookmarks.college_id', '=', 'collegeprofile.id')
                                            ->where('users.id', '=', Auth::id())
                                            ->where('users.userrole_id', '=', '3')
                                            ->where('bookmarks.bookmarktypeinfo_id', '=', '1')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->select('bookmarks.id', 'bookmarks.college_id')
                                            ->orderBy('bookmarks.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
                                            
            //VISIBLE ONLY IF COLLEGE LOGGED IN
            $checkCollegeIsLoggedIn = DB::table('users')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('users.userrole_id', '=', '2')
                                        ->where('users.userstatus_id', '=', '1')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
            if( $checkCollegeIsLoggedIn == '1' ){
                Session::flash('rightNowCollegeLogIn', 'You are currently in public view mode. To update details, please go to the');     
            }            
        }else{
            $getBookMarkedCollegeStaus = '';
        }

        $seocontent = $this->fetchDataServiceController->seoContentDetailsById('collegeId','collegepage',$collegeprofileId);
        $agent = new Agent();
        return view('college/college-profile-show-partial.new-index', compact('getCollegeDetailObj','getCollegeLogoObj','getCollegeAddressObj','collegeRatingObj','fetchCollegeSocialMediaLinks','sportsActivityDataObj','collegeGalleryImagesObj','fetchCollegeManagementList','fetchCollegeCoursesObj','getCollegeDetailBannerAds','collegeFacilityDataObj','getCollegeEvents','collegeScholarshipsObj','collegePlacementDataObj','collegeCutOffsObj','seocontent','agent','getListOfAdsManagements'))
            ->with('slugUrl', $request->slug)
            ->with('getBookMarkedCollegeStaus',$getBookMarkedCollegeStaus)
            ->with('getOldUploadedVideos', $dataArray)
            ->with('getOldUploadedImagesAtt', $dataArrayAttach)
            ->with('getOldUploadedDescription', $getOldUploadedDescription);
    }

    public function collegeProfileFacultyList(Request $request, $slug)
    {
        $checkDisabledStatus = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id')->where('collegeprofile.slug', '=', $slug)->firstOrFail();
        if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
            return Redirect::to('/');
        }

        $getFacultyObj  = Faculty::getFacultyObj($slug);
        $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();
        $seocontent = $this->fetchDataServiceController->seoContentDetailsById('collegeId','collegepage',$collegeProfileObj->id);

        $getCollegeDetailObj = $this->fetchDataServiceController->fetchCollegeDetails($slug);
        $collegeRatingObj = $this->fetchDataServiceController->fetchCollegeRating($slug);
        $getCollegeLogoObj = $this->fetchDataServiceController->fetchCollegeLogo($slug);
        $fetchCollegeSocialMediaLinks = $this->fetchDataServiceController->fetchCollegeSocialMediaLinks($slug);

        if (Auth::check()){
            //GET BOOKMARKED COLLEGE PROFILE STATUS
            $getBookMarkedCollegeStaus = DB::table('bookmarks')
                                            ->leftJoin('users', 'bookmarks.student_id', '=', 'users.id')
                                            ->leftJoin('collegeprofile', 'bookmarks.college_id', '=', 'collegeprofile.id')
                                            ->where('users.id', '=', Auth::id())
                                            ->where('users.userrole_id', '=', '3')
                                            ->where('bookmarks.bookmarktypeinfo_id', '=', '1')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->select('bookmarks.id', 'bookmarks.college_id')
                                            ->orderBy('bookmarks.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
                                            
            //VISIBLE ONLY IF COLLEGE LOGGED IN
            $checkCollegeIsLoggedIn = DB::table('users')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('users.userrole_id', '=', '2')
                                        ->where('users.userstatus_id', '=', '1')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
            if( $checkCollegeIsLoggedIn == '1' ){
                Session::flash('rightNowCollegeLogIn', 'You are currently in public view mode. To update details, please go to the');     
            }            
        }else{
            $getBookMarkedCollegeStaus = '';
        }

        $agent = new Agent();
        return view('college.college-new-public-partial.faculty-list-partial', compact('seocontent','collegeRatingObj','getCollegeDetailObj','getCollegeLogoObj','fetchCollegeSocialMediaLinks','getBookMarkedCollegeStaus','agent'))
                ->with('getFacultyObj', $getFacultyObj)
                ->with('slug', $slug)
                ->with('slugUrl', $slug)
                ;
    }

    public function collegeProfileReviewsList(Request $request, $slug)
    {
        $checkDisabledStatus = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id')->where('collegeprofile.slug', '=', $slug)->firstOrFail();

        if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
            return Redirect::to('/');
        }

        $listOfSubmitReviews = CollegeReview::orderBy('college_reviews.id', 'DESC')
                ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                ->where('collegeprofile.slug', '=', $slug)
                ->paginate(15, array('college_reviews.id','college_reviews.title', 'college_reviews.description', 'college_reviews.votes', 'college_reviews.academic', 'college_reviews.accommodation', 'college_reviews.faculty', 'college_reviews.infrastructure', 'college_reviews.placement', 'college_reviews.social', 'college_reviews.guestUserId', 'college_reviews.users_id', 'college_reviews.collegeprofile_id', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug as collegeSlug','college_reviews.created_at','studentprofile.slug as studentSlug'));

        $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();
        $seocontent = $this->fetchDataServiceController->seoContentDetailsById('collegeId','collegepage',$collegeProfileObj->id);

        $getCollegeDetailObj = $this->fetchDataServiceController->fetchCollegeDetails($slug);
        $collegeRatingObj = $this->fetchDataServiceController->fetchCollegeRating($slug);
        $getCollegeLogoObj = $this->fetchDataServiceController->fetchCollegeLogo($slug);
        $fetchCollegeSocialMediaLinks = $this->fetchDataServiceController->fetchCollegeSocialMediaLinks($slug);

        if (Auth::check()){
            //GET BOOKMARKED COLLEGE PROFILE STATUS
            $getBookMarkedCollegeStaus = DB::table('bookmarks')
                                            ->leftJoin('users', 'bookmarks.student_id', '=', 'users.id')
                                            ->leftJoin('collegeprofile', 'bookmarks.college_id', '=', 'collegeprofile.id')
                                            ->where('users.id', '=', Auth::id())
                                            ->where('users.userrole_id', '=', '3')
                                            ->where('bookmarks.bookmarktypeinfo_id', '=', '1')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->select('bookmarks.id', 'bookmarks.college_id')
                                            ->orderBy('bookmarks.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
                                            
            //VISIBLE ONLY IF COLLEGE LOGGED IN
            $checkCollegeIsLoggedIn = DB::table('users')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('users.userrole_id', '=', '2')
                                        ->where('users.userstatus_id', '=', '1')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
            if( $checkCollegeIsLoggedIn == '1' ){
                Session::flash('rightNowCollegeLogIn', 'You are currently in public view mode. To update details, please go to the');     
            }            
        }else{
            $getBookMarkedCollegeStaus = '';
        }

        $agent = new Agent();
        return view('college.college-new-public-partial.reviews-list-partial', compact('listOfSubmitReviews','slug','collegeRatingObj','seocontent','getCollegeDetailObj','getCollegeLogoObj','fetchCollegeSocialMediaLinks','getBookMarkedCollegeStaus','agent'))->with('slugUrl', $slug);
    }

    public function collegeAdmissionProcedureList(Request $request, $slug)
    {
        $checkDisabledStatus = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id')->where('collegeprofile.slug', '=', $slug)->firstOrFail();

        if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
            return Redirect::to('/');
        }

        $getAdmissionProcedureObj  = CollegeAdmissionProcedure::getAdmissionProcedureObj($slug);

        $collegeProfileObj                      = CollegeProfile::where('slug','=',$slug)->first();
        $seocontent = $this->fetchDataServiceController->seoContentDetailsById('collegeId','collegepage',$collegeProfileObj->id);

        $getCollegeDetailObj = $this->fetchDataServiceController->fetchCollegeDetails($slug);
        $collegeRatingObj = $this->fetchDataServiceController->fetchCollegeRating($slug);
        $getCollegeLogoObj = $this->fetchDataServiceController->fetchCollegeLogo($slug);
        $fetchCollegeSocialMediaLinks = $this->fetchDataServiceController->fetchCollegeSocialMediaLinks($slug);

        if (Auth::check()){
            //GET BOOKMARKED COLLEGE PROFILE STATUS
            $getBookMarkedCollegeStaus = DB::table('bookmarks')
                                            ->leftJoin('users', 'bookmarks.student_id', '=', 'users.id')
                                            ->leftJoin('collegeprofile', 'bookmarks.college_id', '=', 'collegeprofile.id')
                                            ->where('users.id', '=', Auth::id())
                                            ->where('users.userrole_id', '=', '3')
                                            ->where('bookmarks.bookmarktypeinfo_id', '=', '1')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->select('bookmarks.id', 'bookmarks.college_id')
                                            ->orderBy('bookmarks.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
                                            
            //VISIBLE ONLY IF COLLEGE LOGGED IN
            $checkCollegeIsLoggedIn = DB::table('users')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('users.userrole_id', '=', '2')
                                        ->where('users.userstatus_id', '=', '1')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
            if( $checkCollegeIsLoggedIn == '1' ){
                Session::flash('rightNowCollegeLogIn', 'You are currently in public view mode. To update details, please go to the');     
            }            
        }else{
            $getBookMarkedCollegeStaus = '';
        }

        $agent = new Agent();
        return view('college.college-new-public-partial.admission-procedure-partial', compact('getAdmissionProcedureObj','slug','seocontent','collegeRatingObj','getCollegeDetailObj','getCollegeLogoObj','fetchCollegeSocialMediaLinks','getBookMarkedCollegeStaus','agent'))->with('slugUrl', $slug);
    }

    public function collegeFaqsList(Request $request, $slug)
    {
        $checkDisabledStatus = CollegeProfile::join('users', 'collegeprofile.users_id', '=', 'users.id')->where('collegeprofile.slug', '=', $slug)->firstOrFail();

        if( $checkDisabledStatus->userstatus_id == '2' || $checkDisabledStatus->userstatus_id == '3' || $checkDisabledStatus->userstatus_id == '4'  ){
            return Redirect::to('/');
        }

        $getCollegeFaqsObj  = CollegeFaq::getCollegeFaqsObj($slug);
        $collegeProfileObj  = CollegeProfile::where('slug','=',$slug)->first();

        $seocontent = $this->fetchDataServiceController->seoContentDetailsById('collegeId','collegepage',$collegeProfileObj->id);

        $getCollegeDetailObj = $this->fetchDataServiceController->fetchCollegeDetails($slug);
        $collegeRatingObj = $this->fetchDataServiceController->fetchCollegeRating($slug);
        $getCollegeLogoObj = $this->fetchDataServiceController->fetchCollegeLogo($slug);
        $fetchCollegeSocialMediaLinks = $this->fetchDataServiceController->fetchCollegeSocialMediaLinks($slug);

        if (Auth::check()){
            //GET BOOKMARKED COLLEGE PROFILE STATUS
            $getBookMarkedCollegeStaus = DB::table('bookmarks')
                                            ->leftJoin('users', 'bookmarks.student_id', '=', 'users.id')
                                            ->leftJoin('collegeprofile', 'bookmarks.college_id', '=', 'collegeprofile.id')
                                            ->where('users.id', '=', Auth::id())
                                            ->where('users.userrole_id', '=', '3')
                                            ->where('bookmarks.bookmarktypeinfo_id', '=', '1')
                                            ->where('collegeprofile.slug', '=', $slug)
                                            ->select('bookmarks.id', 'bookmarks.college_id')
                                            ->orderBy('bookmarks.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
                                            
            //VISIBLE ONLY IF COLLEGE LOGGED IN
            $checkCollegeIsLoggedIn = DB::table('users')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('users.userrole_id', '=', '2')
                                        ->where('users.userstatus_id', '=', '1')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;
            if( $checkCollegeIsLoggedIn == '1' ){
                Session::flash('rightNowCollegeLogIn', 'You are currently in public view mode. To update details, please go to the');     
            }            
        }else{
            $getBookMarkedCollegeStaus = '';
        }

        $agent = new Agent();
        return view('college.college-new-public-partial.faqs-list-partial', compact('getCollegeFaqsObj','slug','seocontent','collegeRatingObj','getCollegeDetailObj','getCollegeLogoObj','fetchCollegeSocialMediaLinks','getBookMarkedCollegeStaus','agent'))->with('slugUrl', $slug);
    }
}