<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeProfile;
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
use Excel;
use Config;
use PHPMailer;
Use File;
use Cache;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use App\Models\University as University;
use App\Models\CollegeType as CollegeType;
use App\Models\Gallery as Gallery;
use App\Models\AddressType as AddressType;
use App\Models\City as City;
use App\Models\State as State;
use App\Models\Country as Country;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;
use App\Models\CollegeSocialMediaLink;

class CollegeProfileController extends Controller
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
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'CollegeProfile')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'CollegeProfile')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                $query = CollegeProfile::orderBy('collegeprofile.id', 'DESC')
                        ->groupBy('collegeprofile.id')
                        ->leftjoin('university', 'collegeprofile.university_id', '=', 'university.id')
                        ->leftjoin('collegetype', 'collegeprofile.collegetype_id', '=', 'collegetype.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('gallery', 'users.id', '=','gallery.users_id')
                        ->leftJoin('users as eID','collegeprofile.employee_id', '=','eID.id')
                       // ->where('gallery.misc', '=', 'affiliationLettersImage')
                        ->where('users.userstatus_id','!=','5');
                        
                if (!empty(Input::get('collegeName'))) {
                    $query->whereRaw('((users.firstname LIKE "%'.Input::get('collegeName').'%") OR 
                                (users.middlename LIKE "%'.Input::get('collegeName').'%") OR 
                                (users.lastname LIKE "%'.Input::get('collegeName').'%"))');
                }

                if (!empty(Input::get('userEmailAddress'))) {
                    $query->where('users.email', 'LIKE', '%' . Input::get('userEmailAddress') . '%');
                }

                $review = Input::get('review');
                if ($review == '0') {
                    $query->where('collegeprofile.review', '=', '0');
                }else{
                    if ($request->has('review') && !empty($request->get('review'))) {
                        $query->where('collegeprofile.review', '=', Input::get('review'));
                    }
                }

                $verified = Input::get('verified');
                if ($verified == '0') {
                    $query->where('collegeprofile.verified', '=', '0');
                }else{
                    if ($request->has('verified') && !empty($request->get('verified'))) {
                        $query->where('collegeprofile.verified', '=', Input::get('verified'));
                    }
                }

                $agreement = Input::get('agreement');
                if ($agreement == '0') {
                    $query->where('collegeprofile.agreement', '=', '0');
                }else{
                    if ($request->has('agreement') && !empty($request->get('agreement'))) {
                        $query->where('collegeprofile.agreement', '=', Input::get('agreement'));
                    }
                }

                $isShowOnTop = Input::get('isShowOnTop');
                if ($isShowOnTop == '0') {
                    $query->where('collegeprofile.isShowOnTop', '=', '0');
                }else{
                    if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                        $query->where('collegeprofile.isShowOnTop', '=', Input::get('isShowOnTop'));
                    }
                }

                $isShowOnHome = Input::get('isShowOnHome');
                if ($isShowOnHome == '0') {
                    $query->where('collegeprofile.isShowOnHome', '=', '0');
                }else{
                    if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                        $query->where('collegeprofile.isShowOnHome', '=', Input::get('isShowOnHome'));
                    }
                }

                if (!empty($request->get('collegetype_id'))) {
                    $query->where('collegeprofile.collegetype_id', '=', Input::get('collegetype_id'));
                }

                if (!empty($request->get('university_id'))) {
                    $query->where('collegeprofile.university_id', '=', Input::get('university_id'));
                }

                if (!empty($request->get('addresstype'))) {
                    $query->where('addresstype.id', '=', Input::get('addresstype'));
                }
                if (!empty($request->get('city_id'))) {
                    $query->where('city.id', '=', Input::get('city_id'));
                }
                if (!empty($request->get('stateName'))) {
                    $query->where('state.id', '=', Input::get('stateName'));
                }
                if (!empty($request->get('country_id'))) {
                    $query->where('country.id', '=', Input::get('country_id'));
                }
                if (!empty($request->get('university_id'))) {
                    $query->where('collegeprofile.university_id', '=', Input::get('university_id'));
                }

                if (!empty($request->get('searchByEmployeeId'))) {
                    $query->where('collegeprofile.employee_id', '=', Input::get('searchByEmployeeId'));
                }

                $collegeprofile = $query->Paginate(20, array('collegeprofile.id', 'collegeprofile.slug','description', 'estyear', 'website', 'collegecode',  'contactpersonname', 'contactpersonemail', 'contactpersonnumber','advertisement','review', 'agreement', 'verified', 'calenderinfo','collegetype.name as collegetypeName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','university.name as universityName','gallery.id as galleryId', 'gallery.name as galleryName', 'gallery.fullimage as galleryFullImage', 'gallery.caption','gallery.misc','advertisementTimeFrame','advertisementTimeFrameEnd','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegeprofile.updated_at','collegeprofile.created_at','collegeprofile.isShowOnTop','collegeprofile.isShowOnHome','users.userstatus_id'));
            
                $collegeTypeObj = CollegeType::all();
                //$universityObj = University::all();
                $universityObj = Cache::remember('universityObj', Config::get('systemsetting.CACHE_LIFE_LIMIT15'), function () {
                    return   DB::table('university')
                                ->orderBy('university.name', 'ASC')
                                ->get()
                                ;
                });
                
                $collegeProfileObj = Cache::remember('collegeProfileObj', Config::get('systemsetting.CACHE_LIFE_LIMIT15'), function () {
                    return  DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->where('users.userrole_id', '=', '2')
                                    ->where('users.userstatus_id','!=','5')
                                    ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                    ->get()
                                    ;
                });

                $cityNameObj = Cache::remember('cityNameObj', Config::get('systemsetting.CACHE_LIFE_LIMIT15'), function () {
                    return   DB::table('city')
                                ->where('city.cityStatus','=','1')    
                                ->orderBy('city.name', 'ASC')
                                ->get()
                                ;
                });

                $stateNameObj = Cache::remember('stateNameObj', Config::get('systemsetting.CACHE_LIFE_LIMIT15'), function () {
                    return  DB::table('state')
                            ->orderBy('state.name', 'ASC')
                            ->get()
                            ;
                });

                $addressTypeObj = AddressType::all();

                $countryObj = Country::all();
                return view('employee/collegeprofile.index', compact('collegeprofile'))
                            ->with('collegeTypeObj', $collegeTypeObj)
                            ->with('universityObj', $universityObj)
                            ->with('collegeProfileObj',$collegeProfileObj)
                            ->with('storeEditUpdateAction', $storeEditUpdateAction)
                            ->with('cityNameObj', $cityNameObj)
                            ->with('addressTypeObj', $addressTypeObj)
                            ->with('stateNameObj', $stateNameObj)
                            ->with('countryObj', $countryObj);
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
        return redirect::back();
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'CollegeProfile')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $collegeTypeObj = CollegeType::all();
                $universityObj = University::all();
                $usersObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get();

                return view('employee/collegeprofile.create')
                ->with('usersObj', $usersObj)
                ->with('collegeTypeObj', $collegeTypeObj)
                ->with('universityObj', $universityObj);
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
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
            /*CollegeProfile::create($request->all());
            Session::flash('flash_message', 'CollegeProfile added!');*/

            $collegeProfileObj = new CollegeProfile;

            $collegeProfileObj->description = Input::get('description');
            $collegeProfileObj->estyear = Input::get('estyear');
            //$collegeProfileObj->website = Input::get('website');
            $collegeProfileObj->collegecode = Input::get('collegecode');
            $collegeProfileObj->contactpersonname = Input::get('contactpersonname');
            $collegeProfileObj->contactpersonemail = Input::get('contactpersonemail');
            $collegeProfileObj->contactpersonnumber = Input::get('contactpersonnumber');

            if (Input::get('review')) {
                $collegeProfileObj->review = Input::get('review');
            }else{
                $collegeProfileObj->review = '0';
            }
            
            if (Input::get('agreement')) {
                $collegeProfileObj->agreement = Input::get('agreement');
            }else{
                $collegeProfileObj->agreement = '0';
            }
            
            if (Input::get('verified')) {
                $collegeProfileObj->verified = Input::get('verified');
            }else{
                $collegeProfileObj->verified = '0';
            }

            if (Input::get('advertisement')) {
                $collegeProfileObj->advertisement = Input::get('advertisement');
            }else{
                $collegeProfileObj->advertisement = '0';
            }

            $collegeProfileObj->calenderinfo = Input::get('calenderinfo');
            $collegeProfileObj->users_id = Input::get('users_id');

            if (Input::get('university_id')) {
                $collegeProfileObj->university_id = Input::get('university_id');
            }else{
                $collegeProfileObj->university_id = null;
            }
            
            if (Input::get('collegetype_id')) {
                $collegeProfileObj->collegetype_id = Input::get('collegetype_id');  
            }else{
                $collegeProfileObj->collegetype_id = null;
            }
            
            if (Input::get('advertisementTimeFrame')) {
                $arr = explode('/', Input::get('advertisementTimeFrame'));
                $collegeProfileObj->advertisementTimeFrame = $arr[2].'-'.$arr[1].'-'.$arr[0];
            }else{
                $collegeProfileObj->advertisementTimeFrame = null;
            }

            if (Input::get('advertisementTimeFrameEnd')) {
                $arr = explode('/', Input::get('advertisementTimeFrameEnd'));
                $collegeProfileObj->advertisementTimeFrameEnd = $arr[2].'-'.$arr[1].'-'.$arr[0];
            }else{
                $collegeProfileObj->advertisementTimeFrameEnd = null;
            }

            $collegeProfileObj->employee_id = Auth::id(); 
            $collegeProfileObj->save();
            return redirect('employee/collegeprofile');
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
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'CollegeProfile')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $collegeprofile = CollegeProfile::orderBy('id', 'DESC')
                        ->leftjoin('university', 'collegeprofile.university_id', '=', 'university.id')
                        ->leftjoin('collegetype', 'collegeprofile.collegetype_id', '=', 'collegetype.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->leftJoin('users as eID','collegeprofile.employee_id', '=','eID.id')
                        ->where('addresstype.id','=','1')
                        ->select('collegeprofile.id', 'description', 'estyear', 'website', 'collegecode', 'contactpersonname', 'contactpersonemail', 'contactpersonnumber','review', 'agreement', 'verified', 'calenderinfo','collegetype.name as collegetypeName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','university.name as universityName','address.name as addressName','address.address1','address.address2','address.postalcode','addresstype.id as addresstypeID', 'addresstype.name as addresstypeName','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName','country.name as countryName','advertisement','advertisementTimeFrame','approvedBy','advertisementTimeFrameEnd','collegeprofile.slug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegeprofile.updated_at','collegeprofile.created_at','collegeprofile.bannerimage','collegeprofile.isShowOnTop','collegeprofile.isShowOnHome','mediumOfInstruction','studyForm','studyTo','admissionStart','admissionEnd','CCTVSurveillance','totalStudent','ACCampus','rating','totalRatingUser')
                        ->findOrFail($id);

                $collegeProfile1 = CollegeProfile::orderBy('id', 'DESC')
                            ->leftjoin('university', 'collegeprofile.university_id', '=', 'university.id')
                            ->leftjoin('collegetype', 'collegeprofile.collegetype_id', '=', 'collegetype.id')
                            ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                            ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                            ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                            ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                            ->leftJoin('state','city.state_id','=','state.id')
                            ->leftJoin('country','state.country_id','=','country.id')
                            ->where('addresstype.id','=','2')
                            ->select('collegeprofile.id', 'description', 'estyear', 'website', 'collegecode', 'contactpersonname', 'contactpersonemail', 'contactpersonnumber','review','advertisement', 'agreement', 'verified', 'calenderinfo','collegetype.name as collegetypeName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','university.name as universityName','address.name as addressName','address.address1','address.address2','address.postalcode','addresstype.id as addresstypeID', 'addresstype.name as addresstypeName','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName','country.name as countryName','advertisementTimeFrame','advertisementTimeFrameEnd')
                            ->findOrFail($id);

                $getAffiliattionLettersObj = DB::table('collegeprofile')
                                ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                                ->leftJoin('gallery', 'users.id', '=','gallery.users_id')
                                ->where('gallery.caption', '!=', 'videogallery')
                                ->where('gallery.caption', '!=', 'College Logo')
                                ->where('gallery.misc', '=', 'affiliationLettersImage')
                                ->where('collegeprofile.id', '=', $id)
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as usersID', 'gallery.id as galleryId', 'gallery.name as galleryName', 'gallery.fullimage as galleryFullImage', 'gallery.caption','collegeprofile.slug')
                                ->orderBy('gallery.id','ASC')
                                ->get();

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
                            $dataArrayContent['slug'] = $item->slug;
                            $dataArray[] = $dataArrayContent;
                        }
                    }

                $getOldUploadedImages = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->leftJoin('gallery','gallery.users_id', '=','users.id')
                            ->where('collegeprofile.id', '=', $id)
                            ->where('gallery.misc', '=', 'college-upload-gallery-img')
                            ->where('gallery.caption', '!=', 'College Logo')
                            ->where('gallery.misc', '!=', 'affiliationLettersImage')
                            ->where('gallery.caption', '!=', 'videogallery')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'gallery.name as galleryName', 'gallery.fullimage','gallery.caption', 'gallery.width', 'gallery.height','collegeprofile.slug')
                            ->get()
                            ;

                $getOldUploadedVideos = DB::table('collegeprofile')
                                    ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                                    ->leftJoin('gallery','gallery.users_id', '=','users.id')
                                    ->where('collegeprofile.id', '=', $id)
                                    ->where('gallery.caption', '=', 'videogallery')
                                    ->where('gallery.misc', '=', 'videogallery')
                                    ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'gallery.name as galleryName', 'gallery.fullimage','gallery.caption', 'gallery.width', 'gallery.height','collegeprofile.slug')
                                    ->get()
                                    ;

                if( empty($getOldUploadedImages) ){
                    $getOldUploadedImages = '';
                }

                $dataArray1 = array();
                if( empty($getOldUploadedVideos) ){
                    $getOldUploadedVideos = '';
                }else{
                    foreach ($getOldUploadedVideos as $value) {
                        $url = $value->galleryName;
                        $step1=explode('v=', $url);
                        $step2 =explode('&',$step1[1]);
                        $video_id = $step2[0];
                        $value->galleryName = $video_id;
                        $dataArray1[] = $value;                
                    }
                }

                $getCollegeDocumentImages = DB::table('collegeprofile')
                            ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                            ->join('documents','documents.users_id', '=','users.id')
                            ->where('collegeprofile.id', '=', $id)
                            ->where('documents.name', '!=', 'no-image-upload')
                            ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height','collegeprofile.slug')
                            ->get()
                            ;

                $getOldUploadedDescription = DB::table('collegeprofile')
                                    ->leftJoin('users','collegeprofile.users_id', '=','users.id')
                                    ->join('documents','documents.users_id', '=','users.id')
                                    ->where('collegeprofile.id', '=', $id)
                                    ->where('documents.name', '=', 'no-image-upload')
                                    ->select('collegeprofile.id as collegeprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height','collegeprofile.slug')
                                    ->get()
                                    ;

                if( empty($getOldUploadedDescription) ){
                    $getOldUploadedDescription = '';
                }
                
                $dataArrayContent2 = array();
                $dataArray2 = array();
                if( empty($getCollegeDocumentImages) ){
                    $getCollegeDocumentImages = '';
                }else{
                    foreach ($getCollegeDocumentImages as $item) {
                        $fileName = $item->documentsName;
                        $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                        
                        //Data Array Content
                        $dataArrayContent2['collegeprofileId'] = $item->collegeprofileId;
                        $dataArrayContent2['usersId'] = $item->usersId;
                        $dataArrayContent2['documentsId'] = $item->documentsId;
                        $dataArrayContent2['documentsName'] = $item->documentsName;
                        $dataArrayContent2['fullimage'] = $item->fullimage;
                        $dataArrayContent2['description'] = $item->description;
                        $dataArrayContent2['ext'] = $ext;
                        $dataArrayContent2['slug'] = $item->slug;
                        $dataArray2[] = $dataArrayContent2;
                    }
                }

                $galleryCollegeLogo = DB::table('collegeprofile')
                                    ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->leftjoin('gallery', 'users.id', '=', 'gallery.users_id')
                                    ->where('collegeprofile.id', '=', $id)
                                    ->where('gallery.misc', '=', 'college-logo-img')
                                    ->select('collegeprofile.slug', 'gallery.fullimage')
                                    ->take(1)
                                    ->orderBy('collegeprofile.id', 'DESC')
                                    ->get()
                                    ;
                if( empty($galleryCollegeLogo) ){
                    $galleryCollegeLogo = '';
                }

                $collegeID = $collegeprofile->id;
                $slug = $collegeprofile->slug;
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventCollege(Config::get('systemsetting.COLLEGEVIEW').' by this User Id '.Auth::id().' College Id '.$collegeID.' '.$slug, $collegeID);

                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.collegeId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();

                $socialMediaLinksDataObj = DB::table('college_social_media_links')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','college_social_media_links.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slug)
                        ->where('users.id', '=', $collegeprofile->userID)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','college_social_media_links.id as collegeSocialMediaLinkId', 'college_social_media_links.title', 'college_social_media_links.url', 'college_social_media_links.isActive', 'college_social_media_links.other', 'college_social_media_links.users_id', 'college_social_media_links.collegeprofile_id', 'college_social_media_links.employee_id')
                        ->orderBy('college_social_media_links.id', 'ASC')
                        ->get()
                        ;

                $collegeRatingObj = $this->fetchDataServiceController->fetchCollegeRating($slug);

               // print_r($getAffiliattionLettersObj);die;
               // $collegeprofile = CollegeProfile::findOrFail($id);
                return view('employee/collegeprofile.show', compact('collegeprofile','seocontent','socialMediaLinksDataObj','collegeRatingObj'))
                ->with('collegeProfile1',$collegeProfile1)
                ->with('getAffiliattionLettersObj', $dataArray)
                ->with('getOldUploadedImages', $getOldUploadedImages)
                ->with('getOldUploadedVideos', $getOldUploadedVideos)
                ->with('getCollegeDocumentImages', $dataArray2)
                ->with('getOldUploadedDescription', $getOldUploadedDescription)
                ->with('galleryCollegeLogo', $galleryCollegeLogo);
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
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'CollegeProfile')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $collegeprofile = CollegeProfile::findOrFail($id);
                $collegeTypeObj = CollegeType::all();
                $universityObj = University::all();
                $usersObj = DB::table('users')
                             ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get();

                $collegeUserId = $collegeprofile->users_id;
                $collegeDataObj = DB::table('collegeprofile')
                            ->leftJoin('users', function ($join) use ( $collegeUserId) {
                                $join->on('collegeprofile.users_id', '=','users.id')
                                    ->where('collegeprofile.users_id', '=', DB::raw( $collegeUserId)
                                    );  
                                })
                            ->leftJoin('userstatus','users.userstatus_id','=','userstatus.id')
                            ->leftJoin('gallery','users.id','=','gallery.users_id')
                            ->where('collegeprofile.slug', '=', $collegeprofile->slug)
                            ->where('gallery.caption', '=', 'College Logo')
                            ->select('users.id as usersId','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage', 'collegeprofile.slug', 'userstatus.name as userstatusName')
                            ->orderBy('gallery.id', 'DESC')
                            ->take(1)
                            ->get()
                            ;

         // print_r($collegeDataObj);die;
                if( empty($collegeDataObj) ){
                    $collegeDataObj = '';
                }

                $collegeID = $collegeprofile->id;
                $slug = $collegeprofile->slug;
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventCollege(Config::get('systemsetting.COLLEGEVIEW').' by this User Id '.Auth::id().' College Id '.$collegeID.' '.$slug, $collegeID);
                
                 $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.collegeId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                        ->get();

                $socialMediaLinksDataObj = DB::table('college_social_media_links')
                        ->leftJoin('collegeprofile','collegeprofile.id','=','college_social_media_links.collegeprofile_id')
                        ->leftJoin('users' , 'collegeprofile.users_id', '=','users.id')
                        ->where('collegeprofile.slug', '=', $slug)
                        ->where('users.id', '=', $collegeprofile->users_id)
                        ->where('users.userstatus_id', '!=', '5')
                        ->select('users.id as usersId','collegeprofile.slug','college_social_media_links.id as collegeSocialMediaLinkId', 'college_social_media_links.title', 'college_social_media_links.url', 'college_social_media_links.isActive', 'college_social_media_links.other', 'college_social_media_links.users_id', 'college_social_media_links.collegeprofile_id', 'college_social_media_links.employee_id')
                        ->orderBy('college_social_media_links.id', 'ASC')
                        ->get()
                        ;

                return view('employee/collegeprofile.edit', compact('collegeprofile','seocontent','socialMediaLinksDataObj'))
                ->with('usersObj', $usersObj)
                ->with('collegeTypeObj', $collegeTypeObj)
                ->with('universityObj', $universityObj)
                ->with('collegeDataObj', $collegeDataObj);
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
            /*$collegeprofile = CollegeProfile::findOrFail($id);
            $collegeprofile->update($request->all());
            Session::flash('flash_message', 'CollegeProfile updated!');*/
             //GET EMAIL OF UPDATED COLLEGE PROFILE
            $collegeprofileOwnerEmailId = CollegeProfile::where('collegeprofile.id', '=', $id)
                                            ->join('users', function ($join) use ($id) {
                                                $join->on('collegeprofile.users_id', '=','users.id')
                                                    ->where('collegeprofile.id', '=', DB::raw($id)
                                                    );  
                                                })
                                            ->select('users.email','users.phone','users.firstname','collegeprofile.review','collegeprofile.agreement','verified','advertisement')
                                            ->firstOrFail()
                                            ;

            $collegeProfileObj = CollegeProfile::findOrFail($id);

            $collegeProfileObj->description = Input::get('description');
            $collegeProfileObj->estyear = Input::get('estyear');
            //$collegeProfileObj->website = Input::get('website');
            $collegeProfileObj->collegecode = Input::get('collegecode');
            $collegeProfileObj->contactpersonname = Input::get('contactpersonname');
            $collegeProfileObj->contactpersonemail = Input::get('contactpersonemail');
            $collegeProfileObj->contactpersonnumber = Input::get('contactpersonnumber');
            $collegeProfileObj->calenderinfo = Input::get('calenderinfo');
            $collegeProfileObj->isShowOnTop = Input::get('isShowOnTop');
            $collegeProfileObj->isShowOnHome = Input::get('isShowOnHome');
            $collegeProfileObj->approvedBy = Input::get('approvedBy');
            //$collegeProfileObj->users_id = Input::get('users_id');
            if (Input::get('review')) {
                $collegeProfileObj->review = Input::get('review');
            }else{
                $collegeProfileObj->review = '0';
            }
            
            if (Input::get('agreement')) {
                $collegeProfileObj->agreement = Input::get('agreement');
            }else{
                $collegeProfileObj->agreement = '0';
            }
            
            if (Input::get('verified')) {
                $collegeProfileObj->verified = Input::get('verified');
            }else{
                $collegeProfileObj->verified = '0';
            }

            if (Input::get('advertisement')) {
                $collegeProfileObj->advertisement = Input::get('advertisement');
            }else{
                $collegeProfileObj->advertisement = '0';
            }
            
            if (Input::get('university_id')) {
                $collegeProfileObj->university_id = Input::get('university_id');
            }else{
                $collegeProfileObj->university_id = null;
            }
            
            if (Input::get('collegetype_id')) {
                $collegeProfileObj->collegetype_id = Input::get('collegetype_id');  
            }else{
                $collegeProfileObj->collegetype_id = null;
            }

            if (Input::get('advertisementTimeFrame')) {
                $arr = explode('/', Input::get('advertisementTimeFrame'));
                $collegeProfileObj->advertisementTimeFrame = $arr[2].'-'.$arr[1].'-'.$arr[0];
            }else{
                $collegeProfileObj->advertisementTimeFrame = null;
            }

            if (Input::get('advertisementTimeFrameEnd')) {
                $arr = explode('/', Input::get('advertisementTimeFrameEnd'));
                $collegeProfileObj->advertisementTimeFrameEnd = $arr[2].'-'.$arr[1].'-'.$arr[0];
            }else{
                $collegeProfileObj->advertisementTimeFrameEnd = null;
            }

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
            

            $collegeProfileObj->employee_id = Auth::id(); 


            if($request->file('bannerimage')){
                $fileName = time().'-'.$userId.".".$request->bannerimage->getClientOriginalExtension();
                $request->bannerimage->move(public_path('gallery/'.$collegeProfileObj->slug.'/'), $fileName);
                DB::table('collegeprofile')->where('collegeprofile.id', '=', $id)->update(array('collegeprofile.bannerimage' => $fileName));
            }

            if (!empty(Input::get('socialId'))) {
                $sizeOfSocialmanagement = sizeof(Input::get('socialId'));
                for($socialLinks = 0; $socialLinks < $sizeOfSocialmanagement; $socialLinks++){
                    if (!empty(Input::get('collegeSocialMediaLinkId')[$socialLinks])) {
                        $updateSocialmanagement                     = CollegeSocialMediaLink::findOrFail(Input::get('collegeSocialMediaLinkId')[$socialLinks]);
                        $updateSocialmanagement->title              = Input::get('title')[$socialLinks];
                        $updateSocialmanagement->other              = Input::get('title')[$socialLinks];
                        $updateSocialmanagement->url                = Input::get('url')[$socialLinks];
                        $updateSocialmanagement->isActive           = Input::get('isActive'.$socialLinks);
                        $updateSocialmanagement->users_id           = $collegeProfileObj->users_id;
                        $updateSocialmanagement->collegeprofile_id  = $id;
                        $updateSocialmanagement->employee_id        = Auth::id();
                        $updateSocialmanagement->save();
                    }else{
                        $createSocialmanagement                     = New CollegeSocialMediaLink;
                        $createSocialmanagement->title              = Input::get('title')[$socialLinks];
                        $createSocialmanagement->other              = Input::get('title')[$socialLinks];
                        $createSocialmanagement->url                = Input::get('url')[$socialLinks];
                        $createSocialmanagement->isActive           = Input::get('isActive'.$socialLinks);
                        $createSocialmanagement->users_id           = $collegeProfileObj->users_id;
                        $createSocialmanagement->collegeprofile_id  = $id;
                        $createSocialmanagement->employee_id        = Auth::id();
                        $createSocialmanagement->save();
                    }
                }
            }
           
            $profileOwnerEmailAddress = $collegeprofileOwnerEmailId->email;
            $collegeProfileName = $collegeprofileOwnerEmailId->firstname;

             //SEND EMAILS ON REVIEW IS ON 1
            if( $collegeprofileOwnerEmailId->review == '0' ){
                if((Input::get('review') != '0') && ($this->fetchDataServiceController->isValidEmail($profileOwnerEmailAddress) == 1)){
                    try {
                        //Swift Mailer Data Fetching     
                        \Mail::send('administrator/collegeprofile/emails.review-success', array('email' => $profileOwnerEmailAddress, 'collegeName' => $collegeProfileName), function($message) use ($profileOwnerEmailAddress)
                        {
                            $message->to($profileOwnerEmailAddress, 'AdmissionX')->subject('Your college profile has been successfully reviewed.');
                        });       
                    } catch ( \Swift_TransportException $e) {                
                    }
                }
            }

            //SEND EMAILS ON AGREEMENT IS ON 1
            if( $collegeprofileOwnerEmailId->agreement == '0' ){
                if( (Input::get('agreement') == '1') && ($this->fetchDataServiceController->isValidEmail($profileOwnerEmailAddress) == 1)){
                    try {
                        //Swift Mailer Data Fetching        
                        \Mail::send('administrator/collegeprofile/emails.agreement-success', array('email' => $profileOwnerEmailAddress, 'collegeName' => $collegeProfileName), function($message) use ($profileOwnerEmailAddress)
                        {
                            $message->to($profileOwnerEmailAddress, 'AdmissionX')->subject('Yay! You can now take admissions on Admission X portal.');
                        });       
                    } catch ( \Swift_TransportException $e) {                
                    }
                }
            }

            if( $collegeprofileOwnerEmailId->review == '0' ){
                    if( Input::get('review') != '0' ){
                    {  
                        try {
                            if(!empty($collegeprofileOwnerEmailId->phone))
                            {   
                                $string = $collegeProfileName;
                                $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                                $userMobileNo = $collegeprofileOwnerEmailId->phone;
                                $smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 35, $end = '')).', AdmissionX has successfully reviewed your profile. You can start taking admissions on our portal now. '.Config::get('systemsetting.SMS_GROUP_NAME_2'); 
                                $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_COLLEGE_PROFILE_REVIEWED'));      
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
                }
            }

            if( $collegeprofileOwnerEmailId->agreement == '0' ){
                    if( Input::get('agreement') != '0' ){
                    {  
                        try {
                            if(!empty($collegeprofileOwnerEmailId->phone))
                            {   
                                $string = $collegeProfileName;
                                $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($string)); 

                                $userMobileNo = $collegeprofileOwnerEmailId->phone;
                                $smsMessageData = 'Hi '.(str_limit($collegeNameStr, $limit = 35, $end = '')).', AdmissionX has successfully signed agreement with you. You can start taking admissions on our portal now. '.Config::get('systemsetting.SMS_GROUP_NAME_2');

                                $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_COLLEGE_SIGNED_AGREEMENT'));
    
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
                }
            }

            $collegeProfileObj->save();
            /*//SEND EMAILS ON REVIEW IS ON 1
            if( Input::get('review') == '1' ){
                try {
                    if(!empty($profileOwnerEmailAddress) && ($this->fetchDataServiceController->isValidEmail($profileOwnerEmailAddress) == 1)){
                        //Swift Mailer Data Fetching        
                        \Mail::send('employee/collegeprofile/emails.review-success', array('email' => $profileOwnerEmailAddress,  ), function($message) use ($profileOwnerEmailAddress)
                        {
                            $message->to($profileOwnerEmailAddress, 'AdmissionX')->subject('Your college profile is successfully reviewed');
                        });       
                    }
                } catch ( \Swift_TransportException $e) {                
                }
            }

            //SEND EMAILS ON AGREEMENT IS ON 1
            if( Input::get('agreement') == '1' ){
                try {
                    //Swift Mailer Data Fetching  
                    if(!empty($profileOwnerEmailAddress) && ($this->fetchDataServiceController->isValidEmail($profileOwnerEmailAddress) == 1)){
                        \Mail::send('employee/collegeprofile/emails.agreement-success', array('email' => $profileOwnerEmailAddress, 'collegeName' => $collegeProfileName), function($message) use ($profileOwnerEmailAddress)
                        {
                            $message->to($profileOwnerEmailAddress, 'AdmissionX')->subject('Your successfully signed the agreement with AdmissionX');
                        });       
                    }      
                } catch ( \Swift_TransportException $e) {                
                }
            }*/

            if($request->file('uploadCollegeLogo'))
            {   
                $extensionOfFile = '';
                $path = $_FILES['uploadCollegeLogo']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                $tempPath = $_FILES[ 'uploadCollegeLogo' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = $collegeProfileObj->slug.'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/gallery/'.$collegeProfileObj->slug.'/';
                }else{
                    $dirPath = public_path().'/gallery/'.$collegeProfileObj->slug.'/';
                }
                

                //Store the image with 300PX width
                $uploadPath = $dirPath.$fileWithExtension;
                //Store the image with original width as original
                $uploadPath1 = $dirPath.$fileWithExtension1;
                if (move_uploaded_file($tempPath, $uploadPath)) {
                 copy($uploadPath, $uploadPath1);
                }
                
                //IMAGE SAVED IN FOLDER NOW RESIZE IT
                if (file_exists($dirPath.$fileWithExtension)) {

                    $uploadimage = $dirPath.$fileWithExtension;//$dirPath.$_FILES['file']['name'];
                    $newname = $fileWithExtension;//$_FILES['file']['name'];

                    // Set the resize_image name
                    $resize_image = $dirPath.$newname; 
                    $actual_image = $dirPath.$newname;
                    // It gets the size of the image
                    list( $width,$height ) = getimagesize( $uploadimage );
                    // It makes the new image width of 350
                    if( $width > '600' ){
                        $newwidth = 300;
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
                            imagepng( $thumb, $resize_image); 
                        }
                        // 100 Represents the quality of an image you can set and ant number in place of 100.
                        $out_image=addslashes(file_get_contents($resize_image));    
                    }else{
                        $newwidth = $width;
                        $newheight = $height;
                    }            
                }
                
                if( !empty(Input::get('galleryId')) ){
                    $galleryObj = Gallery::findOrFail(Input::get('galleryId'));

                    //UNLINK THE PREVIOUS IMAGE                
                    // unlink($dirPath.$galleryObj->name);
                    // unlink($dirPath.$galleryObj->fullimage);                

                    $galleryObj->name = $fileWithExtension;
                    $galleryObj->fullimage = $fileWithExtension1;
                    $galleryObj->caption = 'College Logo';
                    $galleryObj->width = round($newwidth);
                    $galleryObj->height = round($newheight);
                    $galleryObj->users_id =  $collegeProfileObj->users_id;
                    $galleryObj->category_id = '1';
                    $galleryObj->misc = 'college-logo-img';
                    $galleryObj->employee_id = Auth::id(); 
                    $galleryObj->save();
                }else{
                    $galleryObj = new Gallery;

                    $galleryObj->name = $fileWithExtension;
                    $galleryObj->fullimage = $fileWithExtension1;
                    $galleryObj->caption = 'College Logo';
                    $galleryObj->width = round($newwidth);
                    $galleryObj->height = round($newheight);
                    $galleryObj->users_id = $collegeProfileObj->users_id;
                    $galleryObj->category_id = '1';
                    $galleryObj->misc = 'college-logo-img';
                    $galleryObj->employee_id = Auth::id();
                    $galleryObj->save();
                }
            }
            
            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());
            return redirect::back();
            return redirect('employee/collegeprofile');
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
            $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'CollegeProfile')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                CollegeProfile::destroy($id);
                Session::flash('flash_message', 'CollegeProfile deleted!');
                return redirect('employee/collegeprofile');
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
     * Search College Profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function searchEmployeeCollegeProfile(Request $request)
    {
        $search0 = 'collegeprofile.id';

        if( $request->collegeName != null ){
            $search1 = "AND `users`.`firstname` = '".$request->collegeName."'";
        }else{
            $search1 =  '';
        }

        if( $request->userEmailAddress != '' ){
            $search2 = "AND `users`.`email` LIKE  '%".$request->userEmailAddress."%'";
        }else{
            $search2 =  '';
        }

        if( $request->review != '' ){
            $search3 = "AND `review` LIKE  '%".$request->review."%'";
        }else{
            $search3 =  '';
        }

        if( $request->verified != '' ){
            $search4 = "AND `verified` LIKE  '%".$request->verified."%'";
        }else{
            $search4 =  '';
        }

        if( $request->agreement != '' ){
            $search5 = "AND `agreement` LIKE  '%".$request->agreement."%'";
        }else{
            $search5 =  '';
        }

        if( $request->collegetype_id != '' ){
            $search6 = "AND `collegetype_id` =  '".$request->collegetype_id."'";
        }else{
            $search6 =  '';
        }

        if( $request->university_id != '' ){
            $search7 = "AND `university_id` =  '".$request->university_id."'";
        }else{
            $search7 =  '';
        }

        if( $request->addresstype_id != null ){
            $search8 = "AND `addresstype`.`id` =  '".$request->addresstype_id."'";
        }else{
            $search8 =  '';
        }

        if( $request->city_id != '' ){
            $search9 = "AND `city`.`id` =  '".$request->city_id."'";
            $cityID = Input::get('city_id');

        }else{
            $search9 =  '';
            $cityID= '';
        }

        if( $request->stateName != '' ){
            $search10 = " AND `state`.`id` =  '".$request->stateName."'"; 
            $stateID = Input::get('stateName');          
        }else{
            $search10 = '';
            $stateID = '';
        }

        if( $request->country_id != null ){
            $search11 = "AND `country`.`id` =  '".$request->country_id."'";
            $countryID = Input::get('country_id');     
        }else{
            $search11 =  '';
            $countryID = '';     
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
       
                      
        $collegeProfileDataObj = DB::select( DB::raw("SELECT collegeprofile.id as collegeprofileID, collegeprofile.description as clgDescription, estyear, website, collegecode,  contactpersonname, contactpersonemail, contactpersonnumber,review, agreement, verified, calenderinfo,collegetype.name as collegetypeName, users.id as userID,users.firstname, users.lastname, userrole.name as userRoleName,university.name as universityName,address.id as addressId, addresstype.id as addresstypeID, addresstype.name as addresstypeName,city.id as cityId, city.name as cityName,state.id as stateId, state.name as stateName, eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,collegeprofile.updated_at,collegeprofile.created_at FROM  `collegeprofile`      
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN  `university` ON  `collegeprofile`.`university_id` =  `university`.`id`
                        LEFT JOIN `collegetype` ON `collegeprofile`.`collegetype_id` = `collegetype`.`id`
                        LEFT JOIN `address` ON `collegeprofile`.`id` = `address`.`collegeprofile_id`
                        LEFT JOIN `addresstype` ON `address`.`addresstype_id` = `addresstype`.`id`  
                        LEFT JOIN `city` ON `address`.`city_id` = `city`.`id`
                        LEFT JOIN `state` ON `city`.`state_id` = `state`.`id`
                        LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                        LEFT JOIN `users` as `eID` ON `collegeprofile`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        $search5
                        $search6
                        $search7
                        $search8
                        $search9
                        $search10
                        $search11
                        AND users.userstatus_id != '5'
                        group by users.id
                        ORDER BY collegeprofile.id ASC
                        LIMIT 20 OFFSET $getValue"
                    ));
//print_r($collegeProfileDataObj);die;
        $collegeProfileDataObj1 = DB::select( DB::raw("SELECT COUNT(collegeprofile.id) as totalCount FROM  `collegeprofile` 
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN  `university` ON  `collegeprofile`.`university_id` =  `university`.`id`
                        LEFT JOIN `collegetype` ON `collegeprofile`.`collegetype_id` = `collegetype`.`id`
                        LEFT JOIN `address` ON `collegeprofile`.`id` = `address`.`collegeprofile_id`
                        LEFT JOIN `addresstype` ON `address`.`addresstype_id` = `addresstype`.`id`  
                        LEFT JOIN `city` ON `address`.`city_id` = `city`.`id`
                        LEFT JOIN `state` ON `city`.`state_id` = `state`.`id`
                        LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                        LEFT JOIN `users` as `eID` ON `collegeprofile`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        $search5
                        $search6
                        $search7
                        $search8
                        $search9
                        $search10
                        $search11
                        AND users.userstatus_id != '5'
                       
                        ORDER BY collegeprofile.id ASC
                        "
                    ));
// AND address.addresstype_id = '1'
        // echo '<pre>';
        // print_r($collegeProfileDataObj1);die;

        if(!empty($collegeProfileDataObj1)){
            $numRecords = $collegeProfileDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'collegeProfileDataObj' => $collegeProfileDataObj,
                    'totalCountReturn' => sizeof($collegeProfileDataObj),
                    'collegeProfileDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $collegeProfileDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'collegeProfileDataObj' => $collegeProfileDataObj,
                    'totalCountReturn' => '',
                    'collegeProfileDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $collegeProfileDataObj1,
                );
        }

        if( !empty($collegeProfileDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allEmployeeCollegeProfile(Request $request){

        $collegeProfile = CollegeProfile::orderBy('collegeprofile.id', 'DESC')
                        ->leftjoin('university', 'collegeprofile.university_id', '=', 'university.id')
                        ->leftjoin('collegetype', 'collegeprofile.collegetype_id', '=', 'collegetype.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','collegeprofile.employee_id', '=','eID.id')
                        ->select('collegeprofile.id as collegeprofileID', 'collegeprofile.description as clgDescription', 'estyear', 'website', 'collegecode',  'contactpersonname', 'contactpersonemail', 'contactpersonnumber','review', 'agreement', 'verified', 'calenderinfo','collegetype.name as collegetypeName', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','university.name as universityName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegeprofile.updated_at','collegeprofile.created_at')
                        ->take(20)
                        ->get();
  
        return json_encode($collegeProfile);
    }

    public function sendWelcomeEmail(Request $request , $id)
    {
        $getWelcomeUserEmail = DB::table('collegeprofile')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('userstatus','users.userstatus_id','=','userstatus.id')
                        ->where('collegeprofile.id','=', $id)
                        ->orderBy('collegeprofile.id', 'DESC')
                        ->select('collegeprofile.id','users.id as userID','users.firstname','userrole.name as userRoleName','collegeprofile.slug','userstatus.name as userstatusName','users.email')
                        ->get();
        /*echo "<pre>";
        print_r($getWelcomeUserEmail);die;*/
        $collegeName = $getWelcomeUserEmail[0]->firstname;
        $collegeEmailId = $getWelcomeUserEmail[0]->email;

        $updateApiKey = User::findOrFail($getWelcomeUserEmail[0]->userID);
        $uniqueKey = uniqid();
        $updateApiKey->apikey = $uniqueKey;
        $updateApiKey->save();

        // $ecyEmail = $this->emailEncrypt($collegeEmailId);
        $ecyEmail = $collegeEmailId;
                
        // if(env('APP_ENV') == 'local'){
        //    $baseUrl = env('APP_URL').'/update-password/';
        // }else{
        //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/update-password/';
        // }    

        $baseUrl = env('APP_URL').'/update-password/';

        $forgetPasswordUrlLink = $baseUrl.$uniqueKey;

        // try {
        //     if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
        //     {
        //             //Swift Mailer TO COLLEGE   
        //             \Mail::send('administrator/collegeprofile/emails.welcomeEmail', array('email' => $collegeEmailId,'collegeName'=>$collegeName,'encryptedEmail' =>$ecyEmail, 'forgetPasswordUrlLink' => $forgetPasswordUrlLink ), function($message) use ($collegeEmailId)
        //             {
        //                 $message->to($collegeEmailId, 'AdmissionX')->subject('Welcome to AdmissionX');
        //             });  
        //     } 
        // }catch ( \Swift_TransportException $e) {                
        // }
        try {
            if(!empty($collegeEmailId))
            {
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

                $mail->SMTPDebug = 0;                                   // Enable verbose debug output

                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username     = Config::get('systemsetting.WelcomeEmail');  // SMTP username
                $mail->Password     = Config::get('systemsetting.WelcomeEmailPassword');  // SMTP password
                $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                      // TCP port to connect to

                $mail->setFrom('welcome@admissionx.info', 'Welcome to AdmissionX');
                $mail->addAddress($collegeEmailId, $collegeName);       // Add a recipient

                $message = file_get_contents('assets/welcomeemail.html');

                $message = str_replace('%forgetPasswordUrlLink%', $forgetPasswordUrlLink, $message);
                $mail->isHTML(true);                                     // Set email format to HTML

                $mail->Subject = 'Welcome to AdmissionX';
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

        Session::flash('sendEmailMsg', 'Email send Succesfully!');
        return Redirect::Back();
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


    public function collegeContactCard(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){

                $query = CollegeProfile::orderBy('users.firstname', 'ASC');

                $query->leftjoin('university', 'collegeprofile.university_id', '=', 'university.id');
                $query->leftjoin('collegetype', 'collegeprofile.collegetype_id', '=', 'collegetype.id');
                $query->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id');
                $query->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id');
                $query->leftJoin('gallery', 'users.id', '=','gallery.users_id');
                $query->leftJoin('address', 'collegeprofile.id', '=','address.collegeprofile_id');
                $query->leftJoin('city', 'address.city_id', '=','city.id');
                $query->leftJoin('state', 'city.state_id', '=','state.id');
                $query->where('gallery.misc', '=', 'college-logo-img');
                $query->where('users.userstatus_id','!=','5');


                if($request->has('college')){
                    $query->whereRaw('users.firstname LIKE "%'.Input::get('college').'%"');
                }
                if($request->has('email')){
                    $query->where('users.email', '=', Input::get('email'));
                }
                if($request->has('type')){
                    $query->where('collegeprofile.collegetype_id', '=', Input::get('type'));
                }
                if($request->has('review')){
                    $query->where('collegeprofile.review', '=', Input::get('review'));
                }
                if($request->has('agreement')){
                    $query->where('collegeprofile.agreement', '=', Input::get('agreement'));
                }
                if($request->has('verified')){
                    $query->where('collegeprofile.verified', '=', Input::get('verified'));
                }
                if($request->has('university')){
                    $query->where('collegeprofile.university_id', '=', Input::get('university'));
                }
                if($request->has('address')){
                    $query->where('address.addresstype_id', '=', Input::get('address'));
                }
                if($request->has('country')){
                    $query->where('state.country_id', '=', Input::get('country'));
                }
                if($request->has('state')){
                    $query->where('city.state_id', '=', Input::get('state'));
                }
                if($request->has('city')){
                    $query->where('address.city_id', '=', Input::get('city'));
                }

                $query->groupBy('collegeprofile.id');
                $collegeprofile = $query->Paginate(20, array('collegeprofile.id', 'description', 'collegetype.name as collegetypeName','users.id as userID','users.firstname', 'userrole.name as userRoleName','university.name as universityName','gallery.name as galleryName', 'users.phone', 'users.email', 'collegeprofile.slug', 'address.address1', 'address.address2','address.landmark', 'address.postalcode', 'city.name as cityName', 'state.name as stateName'));

                $universityObj = DB::table('university')
                        ->orderBy('university.name', 'ASC')
                        ->get()
                        ;
                $collegeProfileObj = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->where('users.userrole_id', '=', '2')
                                    ->where('users.userstatus_id','!=','5')
                                    ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                    ->get()
                                    ;
                
                $countryObj = Country::all();
                return view('employee/collegeprofile.college-contact-card', compact('collegeprofile'))
                        ->with('universityObj', $universityObj)
                        ->with('collegeProfileObj',$collegeProfileObj)
                        ->with('countryObj', $countryObj);

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
