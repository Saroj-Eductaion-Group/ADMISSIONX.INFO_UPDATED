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
use Session;
use Mailchimp;
use DateTime;
use Cache;
use Artisan;
use Config;
use App\Models\Subscribe;
use App\Models\FunctionalArea;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\UserRole;
use App\Models\UserStatus;
use App\User as User;
use App\Models\StudentProfile as StudentProfile;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\ApplicationStatusMessage;
use App\Models\Application;
use App\Models\WhatWeOffer;
use App\Models\ExaminationType;
use App\Models\ApplicationAndExamStatus;
use App\Models\ApplicationMode;
use App\Models\ExaminationMode;
use App\Models\EligibilityCriterion;
use App\Models\ExaminationImportantLink;
use App\Models\ExamSection;
use App\Models\TypeOfExamination;
use App\Models\ExamApplicationProcess;
use App\Models\ExamApplicationFee;
use App\Models\ExamEligibility;
use App\Models\ExamDate;
use App\Models\ExamSyllabusPaper;
use App\Models\ExamSyllabusPaperMark;
use App\Models\ExamPattern;
use App\Models\ExamAdmitCard;
use App\Models\ExamResult;
use App\Models\ExamCutOff;
use App\Models\ExamCounselling;
use App\Models\ExamCounsellingDate;
use App\Models\ExamCounsellingContact;
use App\Models\ExamPreprationTip;
use App\Models\ExamAnalysisRecord;
use App\Models\ExamAnswerKey;
use App\Models\ExamAnswerKeyEvent;
use App\Models\ExamFaq;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionAnswer;
use App\Models\ExamQuestionAnswerComment;
use Jenssegers\Agent\Agent;

use App\Models\CounselingBoardAdmissionDate;
use App\Models\CounselingBoardDetail;
use App\Models\CounselingBoardExamDate;
use App\Models\CounselingBoardHighlight;
use App\Models\CounselingBoardImpDate;
use App\Models\CounselingBoardLatestUpdate;
use App\Models\CounselingBoardSamplePaper;
use App\Models\CounselingBoard;
use App\Models\CounselingBoardSyllabus;
use App\Models\CounselingCareerDetail;
use App\Models\CounselingCareerInterest;
use App\Models\CounselingCareerJobRoleSalery;
use App\Models\CounselingCareerRelevant;
use App\Models\CounselingCareerSkillRequirement;
use App\Models\CounselingCareerWhereToStudy;
use App\Models\CounselingCoursesDetail;
use App\Models\CounselingCoursesJobCareer;
use App\Models\CounselingCoursesMoreDetail;
use App\Models\CounselingCoursesEducationLevel;
use App\Models\SeoContent;
use App\Models\SliderManager;
use App\Models\LatestUpdate;
use App\Http\Controllers\Helper\FetchDataServiceController;
use Illuminate\Database\QueryException as QueryException;

class HomeController extends Controller
{
    protected $fetchDataServiceController;
    protected $mailchimp;
    protected $listId = 'bc80df542e';

    public function __construct(Mailchimp $mailchimp, FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
        $this->mailchimp = $mailchimp;
    }

	public function index()
	{
        //REMOVE COOKIES
        unset($_COOKIE['collegeName']);
        setcookie('collegeName', '', time() - 3600, '/');
        unset($_COOKIE['collegeUserId']);
        setcookie('collegeUserId', '', time() - 3600, '/');
        unset($_COOKIE['emailAddress']);
        setcookie('emailAddress', '', time() - 3600, '/');

		$functionalAreaObj = DB::table('functionalarea')
                                ->select('id', 'name')
                                ->orderBy('name', 'ASC')
                                ->get()
                                ;
        $countryObj = DB::table('country')
                    ->select('id', 'name')
                    ->orderBy('country.name', 'ASC')
                    ->get()
                    ;

        //GET THE LATEST 4 BLOGS
        $getBlogsObj = DB::table('blogs')
                        ->leftJoin('users', 'blogs.users_id', '=', 'users.id')
                        ->orderBy('blogs.id', 'DESC')
                        ->select('blogs.id', 'blogs.topic', 'blogs.description', 'blogs.featimage', 'users.firstname', 'blogs.slug', 'blogs.created_at as createdDate')
                        ->take(4)
                        ->get()
                        ;

        $getBlogsObjArray = array();
        if( empty($getBlogsObj) ){
            $getBlogsObj = '';
        }else{

            foreach ($getBlogsObj as $key => $value) {
                $tempArrayBlogs['id'] = $value->id;
                $tempArrayBlogs['topic'] = $value->topic;
                $tempArrayBlogs['description'] = $value->description;
                $tempArrayBlogs['featimage'] = $value->featimage;
                $tempArrayBlogs['firstname'] = $value->firstname;
                $tempArrayBlogs['slug'] = $value->slug;
                $tempArrayBlogs['onlyCreatedDate'] = date("d", strtotime($value->createdDate));
                $tempArrayBlogs['onlyCreatedMonth'] = date("M", strtotime($value->createdDate));
                $tempArrayBlogs['bookmarked']= '0';

                $getBlogsObjArray[] = $tempArrayBlogs;

            }
        }
        $currentDateTime = date("Y-m-d"); //print_r($currentDateTime);die;
        //GET THE LATEST COLLEGE INFO
        $getCollegesInfoObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'users.id', '=', 'collegeprofile.users_id')
                                ->leftJoin('gallery', 'gallery.users_id', '=', 'collegeprofile.users_id')
                                ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                ->where('gallery.caption', '=', 'College Logo')
                                ->where('users.userstatus_id', '=', '1')
                                ->where('collegeprofile.review', '=', '1')
                                ->where('collegeprofile.verified', '=', '1')
                                ->where('collegeprofile.advertisement', '=', '1')
                                ->where('collegeprofile.advertisementTimeFrameEnd', '>=', $currentDateTime)
                                ->where('collegeprofile.advertisementTimeFrame', '<=', $currentDateTime)
                                ->where('users.userstatus_id', '!=', '5')
                                ->where('address.addresstype_id','=','2')
                                ->select('users.firstname', 'collegeprofile.id as collegeprofileId','collegeprofile.slug', 'collegeprofile.description', 'gallery.name as logoImageName', 'gallery.width', 'gallery.height', 'address.id as adressID', 'address.name as addressname', 'address.address1', 'address.address2','address.postalcode','addresstype.id as addresstypeId','addresstype.name as addresstypeName', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName','address.collegeprofile_id')
                                ->groupBy('collegeprofile.id')
                                ->orderBy('collegeprofile.id', 'DESC')
                                ->take(12)
                                ->get()
                                ;

        if( empty($getCollegesInfoObj) ){
            $getCollegesInfoObj = [];
        }

        /*$getCollegesYoutubeObj = DB::table('gallery')
                        ->leftjoin('category', 'gallery.category_id', '=', 'category.id')
                        ->where('gallery.caption', '=', 'Youtube Link Update')
                        ->where('gallery.misc', '=', 'collegeyoutubeurl')
                        ->select('gallery.id', 'gallery.name as galleryName','caption','gallery.misc')
                        ->orderBy('gallery.id', 'DESC')
                        ->take(1)
                        ->get();

        if( empty($getCollegesYoutubeObj) ){
            $getCollegesYoutubeObj = '';
        }

        $getStudentYoutubeObj = DB::table('gallery')
                        ->leftjoin('category', 'gallery.category_id', '=', 'category.id')
                        ->where('gallery.caption', '=', 'Youtube Link Update')
                        ->where('gallery.misc', '=', 'studentyoutubeurl')
                        ->select('gallery.id', 'gallery.name as galleryName','caption','gallery.misc')
                        ->orderBy('gallery.id', 'DESC')
                        ->take(1)
                        ->get();

        if( empty($getStudentYoutubeObj) ){
            $getStudentYoutubeObj = '';
        }

        $getTestimonialDataObj = DB::table('testimonials')
                        ->leftJoin('users', 'testimonials.author','=','users.id')
                        ->where('testimonials.misc', '=', 'Testimonial Image')
                        ->select('testimonials.id as testimonialsID', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname')
                        ->orderBy('testimonials.id', 'DESC')
                        ->get();

        if( empty($getTestimonialDataObj) ){
            $getTestimonialDataObj = '';
        }*/


        if( Auth::check() ){
            //GET ALL BOOKMARK BLOGS
            $studentBookMarkInfoBlogs = DB::table('users')
                            ->leftJoin('bookmarks', 'users.id', '=', 'bookmarks.student_id')
                            ->where('users.id', '=', Auth::id())
                            ->where('users.userrole_id', '=', '3')
                            ->where('bookmarks.bookmarktypeinfo_id', '=', '3')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('bookmarks.id', 'bookmarks.blog_id')
                            ->get()
                            ;

            //GET ALL COLLEGES BLOGS
            $studentCollegesInfoBlogs = DB::table('users')
                            ->leftJoin('bookmarks', 'users.id', '=', 'bookmarks.student_id')
                            ->where('users.id', '=', Auth::id())
                            ->where('users.userrole_id', '=', '3')
                            ->where('bookmarks.bookmarktypeinfo_id', '=', '1')
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('bookmarks.id', 'bookmarks.college_id')
                            ->get()
                            ;

        }else{
            $studentBookMarkInfoBlogs = '';
            $studentCollegesInfoBlogs = '';
        }

				if( !empty($getCollegesInfoObj) ){
					$idString = '';
					foreach($getCollegesInfoObj as $item){
							$idString .= $item->collegeprofile_id.',';
					}
					$idString = rtrim($idString, ',');

	        $collegeFacilityDataObj = DB::select(DB::raw("SELECT collegeprofile.id as collegeprofileId, collegeprofile.slug, collegefacilities.id as collegefacilitiesId, collegefacilities.name, collegefacilities.description, facilities.id as facilitiesId, facilities.name as facilitiesName, collegefacilities.collegeprofile_id, facilities.iconname FROM collegeprofile LEFT JOIN collegefacilities ON collegeprofile.id = collegefacilities.collegeprofile_id LEFT JOIN facilities ON collegefacilities.facilities_id = facilities.id WHERE collegeprofile.id IN ($idString) ORDER BY collegeprofile.id DESC"));

				}
				if( empty($collegeFacilityDataObj) ){
						$collegeFacilityDataObj = '';
				}

        //GET THE HOME PAGE BANNER AD
        $getHomeBannerAds = DB::table('ads_managements')
                                ->where('slug', '=', 1)
                                ->where('isactive', '=', 1)
                                ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                                ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                                ->select('img', 'redirectto')
                                ->orderBy('ads_managements.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
        //$getHomeBannerAds = [];                                
        $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  $this->fetchDataServiceController->getListOfAdsManagements(1);
        });

        return view('website/home.index')
                ->with('functionalAreaObj', $functionalAreaObj)
                ->with('countryObj', $countryObj)
                ->with('getBlogsObj', $getBlogsObjArray)
                ->with('getCollegesInfoObj', $getCollegesInfoObj)
               // ->with('getCollegesYoutubeObj', $getCollegesYoutubeObj)
               // ->with('getStudentYoutubeObj', $getStudentYoutubeObj)
                //->with('getTestimonialDataObj', $getTestimonialDataObj)
                ->with('studentBookMarkInfoBlogs', $studentBookMarkInfoBlogs)
                ->with('studentCollegesInfoBlogs', $studentCollegesInfoBlogs)
                ->with('collegeFacilityDataObj', $collegeFacilityDataObj)
                ->with('getHomeBannerAds', $getHomeBannerAds)
                ->with('getListOfAdsManagements', $getListOfAdsManagements)
                ;
	}

    public function homeDesign()
    {
        //REMOVE COOKIES
        unset($_COOKIE['collegeName']);
        setcookie('collegeName', '', time() - 3600, '/');
        unset($_COOKIE['collegeUserId']);
        setcookie('collegeUserId', '', time() - 3600, '/');
        unset($_COOKIE['emailAddress']);
        setcookie('emailAddress', '', time() - 3600, '/');

        //FILTER ACTIONS
        $functionalAreaObj = FunctionalArea::all();
        $stateObj = State::all();

        return view('website/home.newIndex')
                ->with('functionalAreaObj', $functionalAreaObj)
                ->with('stateObj', $stateObj)
                ;
    }

	public function quickSignUp()
	{
        $seoSlugName = 'quick-signup-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

		return view('website/home.quickSignUp', compact('seocontent'));
	}

    public function OldEducationalInstitution()
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
                return Redirect::to('/agent/dashboard');
            }else{
                Auth::logout();
                return Redirect::to('/');
            }
        }
        Auth::logout();
        return view('website/home.educationalInstitution');
    }

    public function educationalInstitution()
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
                return Redirect::to('/agent/dashboard');
            }else{
                Auth::logout();
                return Redirect::to('/');
            }
        }
        Auth::logout();
        $seoSlugName = 'college-signup';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
        return view('website.home.signup-pages.request-for-college-signup', compact('seocontent'));
    }

    public function addEmailToList(Mailchimp $request, Request $req)
    {

        $email = $req->emailSubscribe;
        $name = $req->subscribeName;
        //STORE EMAIL ADDRESS INTO SUBSCRIBE TABLE
        try {
            $subscribeObj = new Subscribe;
            $subscribeObj->email = $email;
            $subscribeObj->name = $name;
            $subscribeObj->save();
        } catch ( \Exception $e) {
        }

       	try {
            //$this->mailchimp->lists->subscribe($this->listId, ['name' => $name, 'email' => $email]);
            $dataArray = array(
            			'code' => '200',
            			'response' => 'success',
                        'message' => 'Thank you for subscribing AdmissionX'
            		);
            header('Content-Type: application/json');
            echo json_encode($dataArray);
            exit;
        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            // do something
            $dataArray = array(
            			'code' => '400',
            			'response' => 'warning',
                        'message' => 'Thank you for reconfirming as you are already subscribed us'
            		);
            header('Content-Type: application/json');
            echo json_encode($dataArray);
            exit;
        } catch (\Mailchimp_Error $e) {
            // do something
            $dataArray = array(
            			'code' => '401',
            			'response' => 'failure',
                        'message' => 'Something went wrong! Either mailchimp not working or apikey invalid'
            		);
            header('Content-Type: application/json');
            echo json_encode($dataArray);
            exit;
        }

        return view('website/home.index');
    }

    public function addEmailToListViaBlogs(Mailchimp $request, Request $req)
    {

        $email = $req->email;
       // $name = $req->name;

        //STORE EMAIL ADDRESS INTO SUBSCRIBE TABLE
        try {
            $subscribeObj = new Subscribe;
            $subscribeObj->email = $email;
           // $subscribeObj->name = $name;
            $subscribeObj->save();
        } catch ( \Exception $e) {
        }

        try {
            //$this->mailchimp->lists->subscribe($this->listId, ['email' => $email]);

            Session::flash('blogs-session-msg', 'Thank you for subscribing AdmissionX.');
            return Redirect::back();
            exit;
        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            // do something
            Session::flash('blogs-session-msg', 'Thank you for reconfirming as you are already subscribed us.');
            return Redirect::back();
            exit;
        } catch (\Mailchimp_Error $e) {
            // do something
            Session::flash('blogs-session-msg', 'Something went wrong! Either mailchimp not working or apikey invalid.');
            return Redirect::back();
            exit;
        }

        return view('website/home.index');
    }

    public function insertCountryStateCity(Request $request)
    {
        ini_set('max_execution_time', 0);
        $getAllDataFromWorldTable = DB::table('countries')
                                    ->join('states', 'countries.id', '=', 'states.country_id')
                                    ->select('countries.id as countryId', 'countries.name as countryName', 'states.id as statesId', 'states.name as statesName')
                                    ->get()
                                    ;


        foreach ($getAllDataFromWorldTable as $item) {
            if( $item->countryId != '101'){
                $newState = New State;
                $newState->name = $item->statesName;
                $newState->country_id = '1';
                $newState->save();

                //GET NEW STATE ID
                $getStateID = DB::table('state')
                            ->select('state.id')
                            ->orderBy('state.id', 'DESC')
                            ->take(1)
                            ->get()
                            ;


                //GET ALL CITY ON THE BEHALF OF STATE ID
                $getAllCity = DB::table('states')
                                    ->join('cities', 'states.id', '=', 'cities.state_id')
                                    ->where('states.id', '=', $item->statesId)
                                    ->select('cities.id as city_id', 'cities.name as cityName')
                                    ->get()
                                    ;

                foreach ($getAllCity as $value) {
                    $newCity = New City;
                    $newCity->name = $value->cityName;
                    $newCity->state_id = $getStateID[0]->id;
                    $newCity->save();
                }
            }
        }
        echo "DONE";exit(0);
    }

    public function engineeringAssociationExamination(Request $request)
    {
        $getAllCityObj = DB::table('city')
                            ->whereIN('id', [5,6,77,102,380,125,195,215,216,223,228,282,305,332,353,366,405,416,422,532])
                            ->orderBy('city.name', 'ASC')
                            ->get()
                            ;
        $getAllStateObj = DB::table('state')
                            ->select('state.id','state.name')
                            ->where('country_id','=','99')
                            ->orderBy('state.id', 'ASC')
                            ->get()
                            ;
        /*$getAllCityPlaceObj = DB::table('city')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country', 'state.country_id', '=', 'country.id')
                            ->select('city.id','city.name','country.name as countryName')
                            ->where('country_id','=','99')
                            ->orderBy('city.id', 'ASC')
                            ->get()
                            ;*/

        $seoSlugName = 'engineering-association-examination';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.engineeringAssociationExamination', compact('seocontent'))
                    ->with('getAllCityObj', $getAllCityObj)
                    ->with('getAllStateObj', $getAllStateObj)
                    //->with('getAllCityPlaceObj',$getAllCityPlaceObj)
                    ;
    }

    // public function changeNameData(Request $request)
    // {
    //     $getAllCourseData = DB::table('course')
    //             ->select('course.id','name')
    //             ->where('degree_id', '=', '43')
    //             ->get();
    //             // echo "<pre>";
    //             // print_r($getAllCourseData);die;

    //     //Add University

    //     foreach ($getAllCourseData as $key) {
    //         $value = $key->id;
    //         $value1 = explode('Bachelor of Science', $key->name);
    //         if(!empty($value1[1])){
    //             DB::table('course')->where('course.id', '=', $value)->update(array('course.name' => rtrim(str_replace('(', '', $value1[1]), ')')));
    //         }

    //     }
    //     echo "successfully added";
    // }

    // public function changeNameData(Request $request)
    // {
    //     $getAllCourseData = DB::table('course')
    //             ->select('course.id','name')
    //             ->get();

    //     foreach ($getAllCourseData as $key) {
    //         $value = $key->id;
    //         $value1 = trim($key->name, " ");

    //         if(!empty($value1[1])){
    //             DB::table('course')->where('course.id', '=', $value)->update(array('course.name' => $value1 ));
    //         }

    //     }
    //     echo "successfully added";
    // }

    /*public function changeNameData(Request $request)
    {
        $getAllCourseData = DB::table('course')
                ->leftjoin('degree', 'degree.id', '=', 'course.degree_id')
                ->leftjoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                ->select('course.id','course.name as courseName','degree_id','degree.name as degreeName','functionalarea.id as fid','functionalarea.name as functionalareaName')
                ->get();

        foreach ($getAllCourseData as $key) {
            echo "<pre>";
            echo    $value = $key->id; echo " ---- ";
            echo    $value1 = $key->degree_id; echo " ---- ";
            echo    $key->degreeName; echo " ---- ";
            echo    $key->fid; echo " ---- ";
            echo    $key->functionalareaName;

                DB::table('course')->where('course.id', '=', $value)->update(array('course.functionalarea_id' => $key->fid ));

        }
        echo "successfully added";
    }*/

    public function checkApplicationStatus(Request $request)
    {

        $getAllApplicationData = DB::table('application')
                            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                            ->whereRaw('application.created_at <= "'.date('Y-m-d H:i:s', strtotime('-72 hours', strtotime(date('Y-m-d H:i:s')))).'"')
                            ->where('application.applicationstatus_id','=', '2')
                            ->where('application.paymentstatus_id','=', '1')
                            ->select('application.id','applicationstatus.name as applicationstatusName','applicationstatus.id as applicationstatusId','application.created_at','applicationstatus_id')
                            ->get();

       //echo "<pre>";
      // print_r($getAllApplicationData);die;
        foreach ($getAllApplicationData as $key) {
            $value = $key->id;

            $applicationDate = $key->created_at;
            $dateFromDatabase = strtotime($applicationDate);
            $dateSeventyTwoHoursAgo = strtotime("-72 hours");

            if ($dateFromDatabase <= $dateSeventyTwoHoursAgo) {
               //echo "more than 72 hours ago"; echo "<br>";
               // DB::table('application')->where('application.id', '=', $value)->update(array('application.applicationstatus_id' => '4' ));

                $updateApplicationStatus = Application::where('application.id', '=', $value)->firstOrFail();
                $updateApplicationStatus->applicationstatus_id = '4';
                $updateApplicationStatus->save();

                $getStudentDestails = DB::table('application')
                                ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                                ->leftJoin('users as u1','application.users_id','=','u1.id')
                                ->leftJoin('collegeprofile','application.collegeprofile_id','=', 'collegeprofile.id')
                                ->leftJoin('users as u2','u2.id','=','collegeprofile.users_id')
                                ->where('application.id','=', $value)
                                ->select('u1.email as studentEmail','u2.email as collegeEmail','applicationstatus.name','u1.firstname as StudentFirstName','u1.middlename as studentMiddleName','u1.lastname as studentLastName','u2.firstname as collegeName','application.applicationID','collegeprofile.id as collegeprofileID','u1.id as u1Id')
                                ->get()
                                ;

                $applicationstatusId = $getStudentDestails[0]->name;
                $studentEmailId = $getStudentDestails[0]->studentEmail;
                $collegeEmailId = $getStudentDestails[0]->collegeEmail;
                $studentName = $getStudentDestails[0]->StudentFirstName.' '.$getStudentDestails[0]->studentMiddleName.' '.$getStudentDestails[0]->studentLastName;
                $collegeName = $getStudentDestails[0]->collegeName;
                $applicationID = $getStudentDestails[0]->applicationID;
                $messageText = 'College has been not review aplication within 72 hours';

                $applicationStatusMessageObj = New ApplicationStatusMessage();
                $applicationStatusMessageObj->application_id = $value;
                $applicationStatusMessageObj->student_id = $getStudentDestails[0]->u1Id;
                $applicationStatusMessageObj->college_id = $getStudentDestails[0]->collegeprofileID;
                $applicationStatusMessageObj->admin_id = '';
                $applicationStatusMessageObj->message = $messageText;
                $applicationStatusMessageObj->others = 'After 72 Hours';
                $applicationStatusMessageObj->applicationStatus = $applicationstatusId;
                $applicationStatusMessageObj->save();

                try {
                    if(!empty($studentEmailId) && ($this->fetchDataServiceController->isValidEmail($studentEmailId) == 1))
                    {
                            /**Swift Mailer TO Student***/
                            \Mail::send('website/home.emails.studentCancelAdmission', array('email' => $studentEmailId, 'messageData' => $messageText, 'applicationstatusName' => $applicationstatusId,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationID), function($message) use ($studentEmailId)
                            {
                                $message->to($studentEmailId, 'AdmissionX')->subject('Cancel Admission');
                            });
                    }
                }catch ( \Swift_TransportException $e) {
                }

                try {
                    if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
                    {
                            /**Swift Mailer TO COLLEGE***/
                            \Mail::send('website/home.emails.collegeCancelAdmission', array('email' => $collegeEmailId, 'messageData' => $messageText,'applicationstatusName' => $applicationstatusId,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationID ), function($message) use ($collegeEmailId)
                            {
                                $message->to($collegeEmailId, 'AdmissionX')->subject('Cancel Admission');
                            });
                    }
                }catch ( \Swift_TransportException $e) {
                }

                $getTheEmailAdmin = DB::table('users')->where('userrole_id', '=', '1')->where('users.userstatus_id','=', '1')->select('email')->get();
                $adminEmailId = array();
                foreach ($getTheEmailAdmin as $key => $value) {
                    $adminEmailId = $value->email;
                    try {

                        if(!empty($adminEmailId) && ($this->fetchDataServiceController->isValidEmail($adminEmailId) == 1))
                        {
                           /**Swift Mailer TO Admin***/
                            \Mail::send('website/home.emails.cancelAdmission', array('email' => $adminEmailId, 'messageData' => $messageText ,'applicationstatusName' => $applicationstatusId), function($message) use ($adminEmailId)
                            {
                                $message->to($adminEmailId, 'AdmissionX')->subject('Cancel Admission');
                            });
                        }
                    }catch ( \Swift_TransportException $e) {
                    }
                }
            }

        }
    }

    public function newHomePage()
    {
        $whatweoffer = WhatWeOffer::orderBy('what_we_offers.id', 'ASC')
                            ->select('what_we_offers.id','title', 'iconImage', 'bannerText', 'bannerImage', 'description', 'status', 'slug','what_we_offers.pageurl')
                            ->get();


         $collegeCousesCount = DB::table('functionalarea')
                                    ->whereIN('functionalarea.id', [1,2,5,6,9,10,16,17])
                                    ->select('functionalarea.id','functionalarea.name', DB::raw('(SELECT COUNT(collegemaster.functionalarea_id) FROM collegemaster WHERE collegemaster.functionalarea_id = functionalarea.id group by collegemaster.functionalarea_id and collegemaster.collegeprofile_id)  AS totalCourses'))
                                    ->orderBy('functionalarea.id', 'ASC')
                                    ->get();

        $examCousesCount    = DB::table('functionalarea')
                                    ->whereIN('functionalarea.id', [1,2,5,6,9,10,16,17])
                                    ->select('functionalarea.id','functionalarea.name', DB::raw('(SELECT COUNT(collegemaster.functionalarea_id) FROM collegemaster WHERE collegemaster.functionalarea_id = functionalarea.id group by collegemaster.functionalarea_id and collegemaster.collegeprofile_id)  AS totalCourses'))
                                    ->orderBy('totalCourses', 'DESC')
                                    ->get();

        $getTestimonialDataObj = DB::table('testimonials')
                        ->leftJoin('users', 'testimonials.author','=','users.id')
                        ->where('testimonials.misc', '=', 'Testimonial Image')
                        ->select('testimonials.id as testimonialsID', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname')
                        ->orderBy('testimonials.id', 'DESC')
                        ->get();


        $seoSlugName = 'home-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.new-home-design', compact('whatweoffer', 'collegeCousesCount','examCousesCount','getTestimonialDataObj','seocontent'));
    }


    public function newHomePageAction()
    {
        $sliderManager = Cache::remember('sliderManager', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  SliderManager::orderBy('slider_managers.id', 'ASC')
                            ->where('status', '=', '1')
                            ->select('slider_managers.id','sliderTitle', 'bottomText', 'sliderImage', 'bottomLink', 'status', 'isShowCollegeCount', 'isShowExamCount', 'isShowCourseCount', 'isShowBlogCount', 'scrollerFirstText', 'scrollerLastText')
                            ->get();
        });

        $whatweoffer = Cache::remember('whatweoffer', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  WhatWeOffer::orderBy('what_we_offers.id', 'ASC')
                            ->select('what_we_offers.id','title', 'iconImage', 'bannerText', 'bannerImage', 'description', 'status', 'slug','what_we_offers.pageurl')
                            ->get();
        });

        $topCousesList = Cache::remember('topCousesList', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('course')
                        ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                        ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                        ->where('course.isShowOnHome','=', 1)
                        ->where('course.degree_id','!=', "")
                        ->where('degree.functionalarea_id','!=', "")
                        ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                        ->orderBy(DB::raw('RAND()'))
                        ->take(20)
                        ->get();
        });

        $topDegreeList = Cache::remember('topDegreeList', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            $isShowOnTop = "if(degree.isShowOnTop = 1 , 1,2) as isShowOnTop";
            return  DB::table('degree')
                    ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                    ->where('degree.isShowOnHome','=', 1)
                    ->where('degree.functionalarea_id','!=', "")
                    ->select('degree.id', 'degree.name','degree.pageslug', 'functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug', DB::Raw($isShowOnTop))
                    ->orderBy('degree.isShowOnTop', 'ASC')
                    ->orderBy(DB::raw('RAND()'))
                    ->take(20)
                    ->get();
        });

        $functionalareaList = Cache::remember('functionalareaList', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('functionalarea')->where('functionalarea.isShowOnHome','=', 1)->orderBy('functionalarea.id', 'ASC')->get();
        });

        $educationlevelCount = Cache::remember('educationlevelCount', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('educationlevel')->where('educationlevel.isShowOnHome','=', 1)->get();
        });

        $totalExamination = Cache::remember('totalExamination', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('type_of_examinations')->count(); });

        $totalBlogs = Cache::remember('totalBlogs', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('blogs')->where('isactive', '=', '1')->count(); });

        $totalCourses = Cache::remember('totalCourses', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('course')->count(); });

        $totalCollege = Cache::remember('totalCollege', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('collegeprofile')->count(); });

        $latestUpdateObj = Cache::remember('latestUpdateObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('latest_updates')
                            ->where('status', '=', '1')
                            ->orderBy('latest_updates.id', 'DESC')
                            ->get();
        });

        $currentDateTime = date("Y-m-d");
        $getCollegesInfoObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'users.id', '=', 'collegeprofile.users_id')
                                ->leftJoin('gallery', 'gallery.users_id', '=', 'collegeprofile.users_id')
                                ->leftJoin('address', 'collegeprofile.id', '=', 'address.collegeprofile_id')
                                ->leftJoin('city', 'address.city_id', '=', 'city.id')
                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                ->where('gallery.caption', '=', 'College Logo')
                                ->where('users.userstatus_id', '=', '1')
                                ->where('collegeprofile.review', '=', '1')
                                ->where('collegeprofile.verified', '=', '1')
                                ->where('collegeprofile.advertisement', '=', '1')
                                ->where('collegeprofile.advertisementTimeFrameEnd', '>=', $currentDateTime)
                                ->where('collegeprofile.advertisementTimeFrame', '<=', $currentDateTime)
                                ->where('users.userstatus_id', '!=', '5')
                                ->where('address.addresstype_id','=','2')
                                ->where('collegeprofile.isShowOnHome','=','1')
                                ->select('users.firstname', 'collegeprofile.id as collegeprofileId','collegeprofile.slug', 'gallery.name as logoImageName', 'address.id as adressID', 'address.name as addressname', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName','address.collegeprofile_id')
                                ->groupBy('collegeprofile.id')
                                ->orderBy(DB::raw('RAND()'))
                                //->orderBy('collegeprofile.id', 'DESC')
                                ->take(8)
                                ->get();

        $studuAbroadObj = Cache::remember('studuAbroadObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('country')
                            ->where('country.isShowOnHome','=','1')
                            ->where('country.logoimage','!=','')
                            ->orderBy('country.id', 'DESC')
                            ->get();
        });

        $agent = new Agent();
        $seoSlugName = 'home-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getHomeBannerAds = [];
        /*$getHomeBannerAds = Cache::remember('getHomeBannerAds', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  DB::table('ads_managements')
                        ->where('slug', '=', 1)
                        ->where('isactive', '=', 1)
                        ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                        ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                        ->select('img', 'redirectto')
                        ->orderBy('ads_managements.id', 'DESC')
                        ->take(1)
                        ->get();
        });*/

        $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  $this->fetchDataServiceController->getListOfAdsManagements(1);
        });

        $listOfExaminationSection = Cache::remember('listOfExaminationSection', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            $isShowOnHome = "if(exam_sections.isShowOnHome = 1, 1,2) as isShowOnHome";
            return  ExamSection::leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                ->where('exam_sections.status', '=', '1')
                ->where('exam_sections.isShowOnHome', '=', '1')
                ->select('exam_sections.id','exam_sections.name', 'title', 'slug','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName', DB::raw('(SELECT COUNT(type_of_examinations.examsection_id) FROM type_of_examinations WHERE type_of_examinations.examsection_id = exam_sections.id and type_of_examinations.status = 1) AS examCount'),'exam_sections.isShowOnTop','exam_sections.isShowOnHome')
                //, DB::Raw($isShowOnHome)
                ->having('examCount', '>', 0)
                ->orderBy('exam_sections.isShowOnHome', 'DESC')
                ->orderBy('exam_sections.name', 'ASC')
                ->get();
        });

        $listOfExaminationList = Cache::remember('listOfExaminationList', Config::get('systemsetting.CACHE_LIFE_LIMIT120'), function () { 
            //$isShowOnHome = "if(type_of_examinations.isShowOnHome = 1, 1,2) as isShowOnHome";
            return TypeOfExamination::leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                    ->where('type_of_examinations.status', '=', '1')
                    ->where('type_of_examinations.isShowOnHome', '=', '1')
                    ->whereNotNull('type_of_examinations.examsection_id')
                    ->select('type_of_examinations.id','type_of_examinations.sortname', 'type_of_examinations.name', 'type_of_examinations.slug','type_of_examinations.examsection_id','type_of_examinations.functionalarea_id','type_of_examinations.isShowOnTop','type_of_examinations.isShowOnHome','exam_sections.name as exam_sections_name','exam_sections.slug as exam_sections_slug')
                    //DB::Raw($isShowOnHome) 
                    ->orderBy('type_of_examinations.isShowOnHome', 'DESC') 
                    ->orderBy('type_of_examinations.id', 'DESC')
                    ->take(100)
                    ->get();
        });

        return view('website/home.new-home-page', compact('whatweoffer', 'totalExamination','topCousesList','educationlevelCount','totalCourses','totalBlogs','totalCollege','sliderManager','getCollegesInfoObj','latestUpdateObj','functionalareaList','topDegreeList','studuAbroadObj','agent','seocontent','getHomeBannerAds','listOfExaminationSection','listOfExaminationList','getListOfAdsManagements'));
    }

    public function examinationPage()
    {
        $agent = new Agent();
        $isShowOnHome = "if(exam_sections.isShowOnHome = 1, 1,2) as isShowOnHome";
        $examsection = ExamSection::leftJoin('users as eID','exam_sections.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                ->where('exam_sections.status', '=', '1')
                ->select('exam_sections.id','exam_sections.name', 'title', 'iconImage', 'status', 'slug','exam_sections.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','exam_sections.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName', DB::raw('(SELECT COUNT(type_of_examinations.examsection_id) FROM type_of_examinations WHERE type_of_examinations.examsection_id = exam_sections.id and type_of_examinations.status = 1) AS examCount'),'exam_sections.isShowOnHome','exam_sections.isShowOnHome', DB::Raw($isShowOnHome))
                ->having('examCount', '>', 0)
                ->orderBy('exam_sections.isShowOnHome', 'DESC')
                ->orderBy('exam_sections.name', 'ASC')
                ->get();

        foreach ($examsection as $key => $value) {
            $isShowOnTopMenu = "if(type_of_examinations.isShowOnHome = 1, 1,2) as isShowOnHome";
            $value->listofexamination = TypeOfExamination::orderBy('type_of_examinations.id', 'DESC')
                                ->where('type_of_examinations.examsection_id', '=', $value->id)
                                ->where('type_of_examinations.status', '=', '1')
                                ->select('type_of_examinations.id','sortname', 'name', 'status', 'slug','employee_id','universitylogo','universityName','university_id','examsection_id','functionalarea_id','isShowOnTop','isShowOnHome', DB::Raw($isShowOnTopMenu))
                                ->orderBy('type_of_examinations.isShowOnHome', 'DESC')
                                ->orderBy('type_of_examinations.id', 'DESC')
                                ->get();


            $value->examListMultipleDegreeObj = DB::table('exam_list_multiple_degrees')
                    ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                    ->select('degree.id as degreeId','degree.name as degreeName','degreeSlug')
                    ->where('exam_list_multiple_degrees.examsection_id', '=', $value->id)
                    //->orderBy('degree.name', 'ASC')
                    ->orderBy(DB::raw('RAND()'))
                    ->groupBy('degree.id')
                    ->get();
        }

        $listofexaminationCount = TypeOfExamination::orderBy('type_of_examinations.id', 'ASC')
                                ->where('type_of_examinations.status', '=', '1')
                                ->count();


        $seoSlugName = 'examination-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.examination.examination-page', compact('examsection', 'listofexaminationCount','agent','seocontent'));
    }

    public function examinationDetailPage(Request $request, $stream, $slug)
    {
        $agent = new Agent();

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('exam_sections.slug','=', $stream)
                ->where('type_of_examinations.slug','=', $slug)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','type_of_examinations.employee_id','type_of_examinations.universitylogo','type_of_examinations.universityName','type_of_examinations.university_id','type_of_examinations.examsection_id','type_of_examinations.functionalarea_id') 
                ->first();

        if (!empty($typeOfExaminationObj) > 0) {
            $examId = $typeOfExaminationObj->id;
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  

            $examApplicationProcessesObj    =  DB::table('exam_application_processes')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_application_processes.id', 'ASC')
                                                ->first();

            $examApplicationFeesObj         =  DB::table('exam_application_fees')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_application_fees.id', 'ASC')
                                                ->get();

            $examEligibilitiesObj           =  DB::table('exam_eligibilities')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_eligibilities.id', 'ASC')
                                                ->get();

            $examDatesObj                   =  DB::table('exam_dates')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_dates.id', 'ASC')
                                                ->get();

            $examSyllabusPapersObj          =  DB::table('exam_syllabus_papers')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_syllabus_papers.id', 'ASC')
                                                ->get();  

            $examSyllabusPaperMarksObj      =  DB::table('exam_syllabus_paper_marks')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_syllabus_paper_marks.id', 'ASC')
                                                ->get();

            $examPatternsObj                =  DB::table('exam_patterns')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_patterns.id', 'ASC')
                                                ->get();

            $examAdmitCardsObj              =  DB::table('exam_admit_cards')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_admit_cards.id', 'ASC')
                                                ->get();  

            $examResultsObj                 =  DB::table('exam_results')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_results.id', 'ASC')
                                                ->get();  

            $examCutOffsObj                 =  DB::table('exam_cut_offs')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_cut_offs.id', 'ASC')
                                                ->get();  

            $examCounsellingsObj            =  DB::table('exam_counsellings')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counsellings.id', 'ASC')
                                                ->get();  

            $examCounsellingDatesObj        =  DB::table('exam_counselling_dates')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counselling_dates.id', 'ASC')
                                                ->get();  

            $examCounsellingContactsObj     =  DB::table('exam_counselling_contacts')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counselling_contacts.id', 'ASC')
                                                ->get();  

            $examPreprationTipsObj          =  DB::table('exam_prepration_tips')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_prepration_tips.id', 'ASC')
                                                ->get(); 

            $examAnswerKeysObj              =  DB::table('exam_answer_keys')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_answer_keys.id', 'ASC')
                                                ->get();  

            $examAnswerKeyEventsObj         =  DB::table('exam_answer_key_events')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_answer_key_events.id', 'ASC')
                                                ->get();  

            $examAnalysisRecordsObj         =  DB::table('exam_analysis_records')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_analysis_records.id', 'ASC')
                                                ->get();  

            $examinationImportantLinksObj   =  DB::table('examination_important_links')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_important_links.id', 'ASC')
                                                ->get(); 

            $examFaqsObj                    =  DB::table('exam_faqs')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_faqs.id', 'ASC')
                                                ->get(); 

            $examQuestionsObj =[];

           /* $examQuestionsObj               =  DB::table('exam_questions')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_questions.id', 'ASC')
                                                ->get();  

            foreach ($examQuestionsObj as $key => $que) {
                $examQuestionAnswersObj         =  DB::table('exam_question_answers')
                                                    ->where('typeOfExaminations_id','=', $examId)
                                                    ->where('questionId','=', $que->id)
                                                    ->orderBy('exam_question_answers.id', 'ASC')
                                                    ->get(); 


                foreach ($examQuestionAnswersObj as $key => $ans) {
                    $ans->examQuestionAnswerCommentsObj  =  DB::table('exam_question_answer_comments')
                                                        ->where('typeOfExaminations_id','=', $examId)
                                                        ->where('questionId','=', $que->id)
                                                        ->where('answerId','=', $ans->id)
                                                        ->orderBy('exam_question_answer_comments.id', 'ASC')
                                                        ->get();  
                }

                $que->examQuestionAnswersObj   =  $examQuestionAnswersObj; 
            }*/

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName','degreeSlug')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            $cousesListObj                  = DB::table('course')
                                                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                                ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                                ->where('functionalarea.id','=', $typeOfExaminationObj->functionalarea_id)
                                                ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                                                ->orderBy('course.name','ASC')
                                                ->get();

            $cityListObj = Cache::remember('cityListObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('city')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country', 'country.id', '=', 'state.country_id')
                            ->where('country.id','=', 99)
                            ->select('city.id', 'city.name','state.name as stateName')
                            ->orderBy('city.name','ASC')
                            ->get();
            });

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('examId','examinationpage',$examId);
            $examNotificationList = $this->fetchDataServiceController->fetchExamNotificationList(1);
            $latestExaminationList = $this->fetchDataServiceController->fetchLatestExaminationList(1);

            return view('website/home.examination.examination-detail-page', compact('examinationDetailsObj','examApplicationProcessesObj','examApplicationFeesObj','examEligibilitiesObj','examDatesObj','examSyllabusPapersObj','examSyllabusPaperMarksObj','examPatternsObj','examAdmitCardsObj','examResultsObj','examCutOffsObj','examCounsellingsObj','examCounsellingDatesObj','examCounsellingContactsObj','examPreprationTipsObj','examQuestionsObj','examAnswerKeyEventsObj','examAnswerKeysObj','examAnalysisRecordsObj','examinationImportantLinksObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj','agent','seocontent','cousesListObj','cityListObj','stream','slug','examFaqsObj','examNotificationList','latestExaminationList'));
        }else{
            return redirect('/examination');
        }
    }

    public function examinationFaqsDetailPage(Request $request, $stream, $slug)
    {
        $agent = new Agent();

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('exam_sections.slug','=', $stream)
                ->where('type_of_examinations.slug','=', $slug)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','type_of_examinations.employee_id','type_of_examinations.universitylogo','type_of_examinations.universityName','type_of_examinations.university_id','type_of_examinations.examsection_id','type_of_examinations.functionalarea_id') 
                ->first();

        if (!empty($typeOfExaminationObj) > 0) {
            $examId = $typeOfExaminationObj->id;
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  

            $examFaqsObj                    =   ExamFaq::orderBy('exam_faqs.id', 'DESC')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->where('exam_faqs.question', '<>', '')
                                                ->paginate(20, array(
                                                    'exam_faqs.id',
                                                    'exam_faqs.question',
                                                    'exam_faqs.answer',
                                                    'exam_faqs.refLinks',
                                                    'exam_faqs.typeOfExaminations_id',
                                                    'exam_faqs.employee_id'
                                                ));

            $cityListObj = Cache::remember('cityListObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('city')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country', 'country.id', '=', 'state.country_id')
                            ->where('country.id','=', 99)
                            ->select('city.id', 'city.name','state.name as stateName')
                            ->orderBy('city.name','ASC')
                            ->get();
            });

            $cousesListObj                  = DB::table('course')
                                                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                                ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                                ->where('functionalarea.id','=', $typeOfExaminationObj->functionalarea_id)
                                                ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                                                ->orderBy('course.name','ASC')
                                                ->get();

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('examId','examinationpage',$examId);
            $examNotificationList = $this->fetchDataServiceController->fetchExamNotificationList(1);
            $latestExaminationList = $this->fetchDataServiceController->fetchLatestExaminationList(1);

        

            return view('website/home.examination.examination-faq-page', compact('examinationDetailsObj','examFaqsObj','agent','seocontent','cityListObj','stream','slug','typeOfExaminationObj','examId','cousesListObj','examNotificationList','latestExaminationList'));
        }else{
            return redirect('/examination');
        }
    }

    public function examinationQuesListPage(Request $request, $stream, $slug)
    {
        $agent = new Agent();

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('exam_sections.slug','=', $stream)
                ->where('type_of_examinations.slug','=', $slug)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','type_of_examinations.employee_id','type_of_examinations.universitylogo','type_of_examinations.universityName','type_of_examinations.university_id','type_of_examinations.examsection_id','type_of_examinations.functionalarea_id') 
                ->first();

        if (!empty($typeOfExaminationObj) > 0) {
            $examId = $typeOfExaminationObj->id;
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  

            $getAskQuestionObj = ExamQuestion::orderBy('exam_questions.id', 'DESC')
                                    ->leftJoin('users', 'exam_questions.userId', '=', 'users.id')
                                    ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                                    ->where('typeOfExaminations_id','=', $examId)
                                    ->paginate(10, array('exam_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','exam_questions.question', 'exam_questions.questionDate', 'exam_questions.employee_id','exam_questions.updated_at', DB::raw('(SELECT COUNT(exam_question_answers.id) FROM exam_question_answers WHERE exam_question_answers.questionId = exam_questions.id) AS totalAnswerCount'), DB::raw('(SELECT COUNT(exam_question_answer_comments.id) FROM exam_question_answer_comments WHERE exam_question_answer_comments.questionId = exam_questions.id) AS totalCommentsCount'), DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname")));

            $cityListObj = Cache::remember('cityListObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('city')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country', 'country.id', '=', 'state.country_id')
                            ->where('country.id','=', 99)
                            ->select('city.id', 'city.name','state.name as stateName')
                            ->orderBy('city.name','ASC')
                            ->get();
            });

            $cousesListObj  = DB::table('course')
                                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                ->where('functionalarea.id','=', $typeOfExaminationObj->functionalarea_id)
                                ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                                ->orderBy('course.name','ASC')
                                ->get();

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('examId','examinationpage',$examId);
            $examNotificationList = $this->fetchDataServiceController->fetchExamNotificationList(1);
            $latestExaminationList = $this->fetchDataServiceController->fetchLatestExaminationList(1);

            return view('website/home.examination.examination-question-page', compact('examinationDetailsObj','getAskQuestionObj','agent','seocontent','cityListObj','stream','slug','typeOfExaminationObj','examId','cousesListObj','examNotificationList','latestExaminationList'));
        }else{
            return redirect('/examination');
        }
    }


    public function examinationQuesAnswerDetailPage(Request $request, $stream, $slug, $questionId)
    {
        $agent = new Agent();

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('exam_sections.slug','=', $stream)
                ->where('type_of_examinations.slug','=', $slug)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','type_of_examinations.employee_id','type_of_examinations.universitylogo','type_of_examinations.universityName','type_of_examinations.university_id','type_of_examinations.examsection_id','type_of_examinations.functionalarea_id') 
                ->first();

        if (!empty($typeOfExaminationObj) > 0) {
            $examId = $typeOfExaminationObj->id;
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  

            $examQuestionsObj              =  DB::table('exam_questions')
                                                ->leftJoin('users', 'exam_questions.userId', '=', 'users.id')
                                                ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                                                ->where('exam_questions.typeOfExaminations_id','=', $examId)
                                                ->where('exam_questions.id','=', $questionId)
                                                ->select('exam_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'users.userrole_id','userrole.name as userRoleName','exam_questions.question', 'exam_questions.questionDate', 'exam_questions.employee_id','exam_questions.updated_at', DB::raw('(SELECT COUNT(exam_question_answers.id) FROM exam_question_answers WHERE exam_question_answers.questionId = exam_questions.id) AS totalAnswerCount'), DB::raw('(SELECT COUNT(exam_question_answer_comments.id) FROM exam_question_answer_comments WHERE exam_question_answer_comments.questionId = exam_questions.id) AS totalCommentsCount'), DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                                                ->orderBy('exam_questions.id', 'DESC')
                                                ->get();

            if (sizeof($examQuestionsObj) > 0) {
                $examQuestionAnswersObj         =  DB::table('exam_question_answers')
                                                    ->leftJoin('users', 'exam_question_answers.userId', '=', 'users.id')
                                                    ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                                                    ->where('typeOfExaminations_id','=', $examId)
                                                    ->where('questionId','=', $questionId)
                                                    ->select('exam_question_answers.id', 'users.id as userID','users.firstname', 'users.lastname', 'users.userrole_id','userrole.name as userRoleName','exam_question_answers.answer', 'exam_question_answers.answerDate','exam_question_answers.questionId','exam_question_answers.userId','exam_question_answers.share','exam_question_answers.likes','exam_question_answers.typeOfExaminations_id', 'exam_question_answers.employee_id','exam_question_answers.updated_at', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                                                ->orderBy('exam_question_answers.id', 'DESC')
                                                ->get();

                foreach ($examQuestionAnswersObj as $key => $ans) {
                    $ans->examQuestionAnswerCommentsObj  =  DB::table('exam_question_answer_comments')
                                                        ->leftJoin('users', 'exam_question_answer_comments.userId', '=', 'users.id')
                                                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                                                        ->where('typeOfExaminations_id','=', $examId)
                                                        ->where('questionId','=', $questionId)
                                                        ->where('answerId','=', $ans->id)
                                                        ->select('exam_question_answer_comments.id', 'users.id as userID','users.firstname', 'users.lastname', 'users.userrole_id','userrole.name as userRoleName','exam_question_answer_comments.answerDate', 'exam_question_answer_comments.replyanswer','exam_question_answer_comments.questionId','exam_question_answer_comments.userId','exam_question_answer_comments.typeOfExaminations_id','exam_question_answer_comments.likes','exam_question_answer_comments.share', 'exam_question_answer_comments.employee_id','exam_question_answer_comments.updated_at', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                                                        ->orderBy('exam_question_answer_comments.id', 'DESC')
                                                        ->get();
                }

            

                $cityListObj = Cache::remember('cityListObj', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { return   DB::table('city')
                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                ->leftJoin('country', 'country.id', '=', 'state.country_id')
                                ->where('country.id','=', 99)
                                ->select('city.id', 'city.name','state.name as stateName')
                                ->orderBy('city.name','ASC')
                                ->get();
                });

                $cousesListObj  = DB::table('course')
                                    ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                    ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                    ->where('functionalarea.id','=', $typeOfExaminationObj->functionalarea_id)
                                    ->select('course.id', 'course.name','course.pageslug', 'degree.name as degreeName','degree.pageslug as degreepageslug','functionalarea.name as functionalareaName','functionalarea.pageslug as functionalareapageslug')
                                    ->orderBy('course.name','ASC')
                                    ->get();

                $seocontent = $this->fetchDataServiceController->seoContentDetailsById('examId','examinationpage',$examId);
                $examNotificationList = $this->fetchDataServiceController->fetchExamNotificationList(1);
                $latestExaminationList = $this->fetchDataServiceController->fetchLatestExaminationList(1);
                
                return view('website/home.examination.examination-question-details-page', compact('examinationDetailsObj','examQuestionsObj','agent','seocontent','cityListObj','stream','slug','typeOfExaminationObj','examId','cousesListObj','examQuestionAnswersObj','examNotificationList','latestExaminationList'));
            }else{
                return redirect('/examination');
            }
        }else{
            return redirect('/examination');
        }
    }

    public function examinationListPage(Request $request, $stream)
    {
        $agent = new Agent();
        $examinationType                = ExaminationType::get();
        $applicationAndExamStatus       = ApplicationAndExamStatus::get();
        $applicationMode                = ApplicationMode::get();
        $examinationMode                = ExaminationMode::get();
        $eligibilityCriterion           = EligibilityCriterion::get();

        $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                            ->leftjoin('exam_sections', 'exam_list_multiple_degrees.examsection_id', '=', 'exam_sections.id')
                                            ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                            ->select('degree.id as degreeId','degree.name as degreeName','degreeSlug','exam_sections.slug as streamSlug', DB::raw('(SELECT COUNT(exam_list_multiple_degrees.degree_id) FROM exam_list_multiple_degrees WHERE exam_list_multiple_degrees.degree_id = degree.id) AS examCount'))
                                            ->where('exam_sections.slug', '=', $stream)
                                            ->orderBy('degree.name', 'ASC')
                                            ->groupBy('degree.id')
                                            ->get();

        $startFromDate  = date('m/d/Y', strtotime('-1 day', strtotime(date('m/d/Y'))));
        $endToDate      = date('m/d/Y', strtotime('+30 day', strtotime(date('m/d/Y'))));

        $examNotificationList = $this->fetchDataServiceController->fetchExamNotificationList(1);
        $latestExaminationList = $this->fetchDataServiceController->fetchLatestExaminationList(1);

        $query = TypeOfExamination::orderBy('type_of_examinations.id', 'DESC')
                ->leftJoin('users as eID','type_of_examinations.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'type_of_examinations.functionalarea_id', '=', 'functionalarea.id')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->leftjoin('examination_details', 'type_of_examinations.id', '=', 'examination_details.typeOfExaminations_id')
                ->leftjoin('exam_application_processes', 'type_of_examinations.id', '=', 'exam_application_processes.typeOfExaminations_id')
                ->leftjoin('examination_types', 'exam_application_processes.examinationtype', '=', 'examination_types.id')
                ->leftjoin('application_and_exam_statuses', 'exam_application_processes.applicationandexamstatus', '=', 'application_and_exam_statuses.id')
                ->leftjoin('application_modes', 'exam_application_processes.modeofapplication', '=', 'application_modes.id')
                ->leftjoin('examination_modes', 'exam_application_processes.examinationmode', '=', 'examination_modes.id')
                ->leftjoin('eligibility_criterias', 'exam_application_processes.eligibilitycriteria', '=', 'eligibility_criterias.id')
                ->leftjoin('exam_list_multiple_degrees', 'type_of_examinations.id', '=', 'exam_list_multiple_degrees.typeOfExaminations_id')
                ->where('exam_sections.slug','=', $stream);

        if ($request->has('examinationtype')) {
            $examinationtype[] = $request->get('examinationtype');
            foreach($examinationtype as $key ) {
                $examinationTypeIDS = $key;
            }
            if(!empty($examinationTypeIDS)){
                $storeExaminationTypeID = implode (", ", $examinationTypeIDS);
            }
            $query->whereIn('exam_application_processes.examinationtype', explode(',', $storeExaminationTypeID));
        }

        if ($request->has('applicationandexamstatus')) {
            $allapplicationandexamstatus[] = $request->get('applicationandexamstatus');
            foreach($allapplicationandexamstatus as $key ) {
                $applicationExamStatusIDS = $key;
            }
            if(!empty($applicationExamStatusIDS)){
                $storeApplicationExamStatusID = implode (", ", $applicationExamStatusIDS);
            }
            $query->whereIn('exam_application_processes.applicationandexamstatus', explode(',', $storeApplicationExamStatusID));
        }

        if ($request->has('applicationmode')) {
            $allapplicationmode[] = $request->get('applicationmode');
            foreach($allapplicationmode as $key ) {
                $applicationmodeIDS = $key;
            }
            if(!empty($applicationmodeIDS)){
                $storeapplicationmodeID = implode (", ", $applicationmodeIDS);
            }
            $query->whereIn('exam_application_processes.modeofapplication', explode(',', $storeapplicationmodeID));
        }

        if ($request->has('examinationmode')) {
            $allexaminationmode[] = $request->get('examinationmode');
            foreach($allexaminationmode as $key ) {
                $examinationmodeIDS = $key;
            }
            if(!empty($examinationmodeIDS)){
                $storeexaminationmodeID = implode (", ", $examinationmodeIDS);
            }
            $query->whereIn('exam_application_processes.examinationmode', explode(',', $storeexaminationmodeID));
        }

        if ($request->has('eligibilitycriteria')) {
            $alleligibilitycriteria[] = $request->get('eligibilitycriteria');
            foreach($alleligibilitycriteria as $key ) {
                $eligibilitycriteriaIDS = $key;
            }
            if(!empty($eligibilitycriteriaIDS)){
                $storeeligibilitycriteriaID = implode (", ", $eligibilitycriteriaIDS);
            }
            $query->whereIn('exam_application_processes.eligibilitycriteria', explode(',', $storeeligibilitycriteriaID));
        }

        if ($request->has('typeofcourse')) {
            $alltypeofcourse[] = $request->get('typeofcourse');
            foreach($alltypeofcourse as $key ) {
                $typeofcourseIDS = $key;
            }
            if(!empty($typeofcourseIDS)){
                $storetypeofcourseID = implode (", ", $typeofcourseIDS);
            }
            $query->whereIn('exam_list_multiple_degrees.degree_id', explode(',', $storetypeofcourseID));
        }

        $query->groupBy('type_of_examinations.id');

        $getFilterOutDataObj = $query->paginate(20, array('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','type_of_examinations.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','type_of_examinations.updated_at','universitylogo','universityName','university_id','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle','exam_sections.slug as streamSlug','examination_details.applicationFrom','examination_details.applicationTo','examination_details.exminationDate','examination_details.resultAnnounce','examination_details.totalLikes','examination_details.totalViews','examination_details.totalApplicationClick','modeofpayment','examination_types.name as examination_typesName','application_and_exam_statuses.name as applicationexamstatusesName','application_modes.name as application_modesName','examination_modes.name as examination_modesName','eligibility_criterias.name as eligibility_criteriasName'));

        $degreeSlug = '';

        $seoSlugName = 'examination-search-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.examination.examination-list-page',compact('examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examDegreeObj','agent','examNotificationList','latestExaminationList','stream','getFilterOutDataObj','degreeSlug','seocontent'));
    }

    public function examinationStreamListPage(Request $request, $stream, $degreeSlug)
    {
        $agent = new Agent();
        $examinationType                = ExaminationType::get();
        $applicationAndExamStatus       = ApplicationAndExamStatus::get();
        $applicationMode                = ApplicationMode::get();
        $examinationMode                = ExaminationMode::get();
        $eligibilityCriterion           = EligibilityCriterion::get();

        $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                            ->leftjoin('exam_sections', 'exam_list_multiple_degrees.examsection_id', '=', 'exam_sections.id')
                                            ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                            ->select('degree.id as degreeId','degree.name as degreeName','degreeSlug','exam_sections.slug as streamSlug', DB::raw('(SELECT COUNT(exam_list_multiple_degrees.degree_id) FROM exam_list_multiple_degrees WHERE exam_list_multiple_degrees.degree_id = degree.id) AS examCount'))
                                            ->where('exam_sections.slug', '=', $stream)
                                            ->orderBy('degree.name', 'ASC')
                                            ->groupBy('degree.id')
                                            ->get();

        $startFromDate  = date('m/d/Y', strtotime('-1 day', strtotime(date('m/d/Y'))));
        $endToDate      = date('m/d/Y', strtotime('+30 day', strtotime(date('m/d/Y'))));

        $examNotificationList = $this->fetchDataServiceController->fetchExamNotificationList(1);
        $latestExaminationList = $this->fetchDataServiceController->fetchLatestExaminationList(1);

        $query = TypeOfExamination::orderBy('type_of_examinations.id', 'DESC')
                ->leftJoin('users as eID','type_of_examinations.employee_id', '=','eID.id')
                ->leftjoin('functionalarea', 'type_of_examinations.functionalarea_id', '=', 'functionalarea.id')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->leftjoin('examination_details', 'type_of_examinations.id', '=', 'examination_details.typeOfExaminations_id')
                ->leftjoin('exam_application_processes', 'type_of_examinations.id', '=', 'exam_application_processes.typeOfExaminations_id')
                ->leftjoin('examination_types', 'exam_application_processes.examinationtype', '=', 'examination_types.id')
                ->leftjoin('application_and_exam_statuses', 'exam_application_processes.applicationandexamstatus', '=', 'application_and_exam_statuses.id')
                ->leftjoin('application_modes', 'exam_application_processes.modeofapplication', '=', 'application_modes.id')
                ->leftjoin('examination_modes', 'exam_application_processes.examinationmode', '=', 'examination_modes.id')
                ->leftjoin('eligibility_criterias', 'exam_application_processes.eligibilitycriteria', '=', 'eligibility_criterias.id')
                ->leftjoin('exam_list_multiple_degrees', 'type_of_examinations.id', '=', 'exam_list_multiple_degrees.typeOfExaminations_id')
                ->where('exam_list_multiple_degrees.degreeSlug','=', $degreeSlug)
                ->where('exam_sections.slug','=', $stream);

        if ($request->has('examinationtype')) {
            $examinationtype[] = $request->get('examinationtype');
            foreach($examinationtype as $key ) {
                $examinationTypeIDS = $key;
            }
            if(!empty($examinationTypeIDS)){
                $storeExaminationTypeID = implode (", ", $examinationTypeIDS);
            }
            $query->whereIn('exam_application_processes.examinationtype', explode(',', $storeExaminationTypeID));
        }

        if ($request->has('applicationandexamstatus')) {
            $allapplicationandexamstatus[] = $request->get('applicationandexamstatus');
            foreach($allapplicationandexamstatus as $key ) {
                $applicationExamStatusIDS = $key;
            }
            if(!empty($applicationExamStatusIDS)){
                $storeApplicationExamStatusID = implode (", ", $applicationExamStatusIDS);
            }
            $query->whereIn('exam_application_processes.applicationandexamstatus', explode(',', $storeApplicationExamStatusID));
        }

        if ($request->has('applicationmode')) {
            $allapplicationmode[] = $request->get('applicationmode');
            foreach($allapplicationmode as $key ) {
                $applicationmodeIDS = $key;
            }
            if(!empty($applicationmodeIDS)){
                $storeapplicationmodeID = implode (", ", $applicationmodeIDS);
            }
            $query->whereIn('exam_application_processes.modeofapplication', explode(',', $storeapplicationmodeID));
        }

        if ($request->has('examinationmode')) {
            $allexaminationmode[] = $request->get('examinationmode');
            foreach($allexaminationmode as $key ) {
                $examinationmodeIDS = $key;
            }
            if(!empty($examinationmodeIDS)){
                $storeexaminationmodeID = implode (", ", $examinationmodeIDS);
            }
            $query->whereIn('exam_application_processes.examinationmode', explode(',', $storeexaminationmodeID));
        }

        if ($request->has('eligibilitycriteria')) {
            $alleligibilitycriteria[] = $request->get('eligibilitycriteria');
            foreach($alleligibilitycriteria as $key ) {
                $eligibilitycriteriaIDS = $key;
            }
            if(!empty($eligibilitycriteriaIDS)){
                $storeeligibilitycriteriaID = implode (", ", $eligibilitycriteriaIDS);
            }
            $query->whereIn('exam_application_processes.eligibilitycriteria', explode(',', $storeeligibilitycriteriaID));
        }

        if ($request->has('typeofcourse')) {
            $alltypeofcourse[] = $request->get('typeofcourse');
            foreach($alltypeofcourse as $key ) {
                $typeofcourseIDS = $key;
            }
            if(!empty($typeofcourseIDS)){
                $storetypeofcourseID = implode (", ", $typeofcourseIDS);
            }
            $query->whereIn('exam_list_multiple_degrees.degree_id', explode(',', $storetypeofcourseID));
        }

        $query->groupBy('type_of_examinations.id');

        $getFilterOutDataObj = $query->paginate(20, array('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.status', 'type_of_examinations.slug','type_of_examinations.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','type_of_examinations.updated_at','universitylogo','universityName','university_id','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','exam_sections.id as exam_sectionsID','exam_sections.name as exam_sectionsName','exam_sections.title as exam_sectionstitle','exam_sections.slug as streamSlug','examination_details.applicationFrom','examination_details.applicationTo','examination_details.exminationDate','examination_details.resultAnnounce','examination_details.totalLikes','examination_details.totalViews','examination_details.totalApplicationClick','modeofpayment','examination_types.name as examination_typesName','application_and_exam_statuses.name as applicationexamstatusesName','application_modes.name as application_modesName','examination_modes.name as examination_modesName','eligibility_criterias.name as eligibility_criteriasName'));


        $seoSlugName = 'examination-search-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.examination.examination-list-page',compact('examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examDegreeObj','agent','examNotificationList','latestExaminationList','stream','degreeSlug','getFilterOutDataObj','seocontent'));
    }

    public function allBoardsListPage(Request $request)
    {

        $nationalBoards = CounselingBoard::orderBy('counseling_boards.id', 'DESC')
                            ->leftjoin('counseling_board_details', 'counseling_boards.id', '=', 'counseling_board_details.counselingBoardId')
                            ->where('counseling_boards.misc', '=', 'National')
                            ->where('counseling_boards.status', '=', 1)
                            ->select('counseling_boards.id','counseling_boards.name','counseling_boards.title','counseling_boards.misc', 'counseling_boards.status', 'counseling_boards.slug','image')
                            ->get();

        $stateBoards    = CounselingBoard::orderBy('counseling_boards.id', 'DESC')
                            ->leftjoin('counseling_board_details', 'counseling_boards.id', '=', 'counseling_board_details.counselingBoardId')
                            ->where('counseling_boards.misc', '=', 'State')
                            ->where('counseling_boards.status', '=', 1)
                            ->select('counseling_boards.id','counseling_boards.name','counseling_boards.title','counseling_boards.misc', 'counseling_boards.status', 'counseling_boards.slug','image')
                            ->get();

        $seoSlugName = 'board-list-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.counseling.all-board-list-page',compact('nationalBoards','stateBoards','seocontent'));
    }

    public function boardDetailPage(Request $request, $category, $slug)
    {
        $counselingBoardObj = CounselingBoard::orderBy('counseling_boards.id' ,'DESC')
                ->where('counseling_boards.slug','=', $slug)
                ->get();

        if (sizeof($counselingBoardObj) > 0) {
            $boardId           =                $counselingBoardObj[0]->id;
            $relatedBoards                      = DB::table('counseling_boards')
                                                    ->leftjoin('counseling_board_details', 'counseling_boards.id', '=', 'counseling_board_details.counselingBoardId')
                                                    ->where('counseling_boards.misc', '=', $category)
                                                    ->where('counseling_boards.status', '=', 1)
                                                    ->select('counseling_boards.id','counseling_boards.name','counseling_boards.title','counseling_boards.slug','counseling_boards.misc', 'counseling_boards.status','image')
                                                    ->orderBy(DB::raw('RAND()'))
                                                    ->take(10)
                                                    ->get();

            $otherBoards                        = DB::table('counseling_boards')
                                                    ->leftjoin('counseling_board_details', 'counseling_boards.id', '=', 'counseling_board_details.counselingBoardId')
                                                    ->where('counseling_boards.misc', '!=', $category)
                                                    ->where('counseling_boards.status', '=', 1)
                                                    ->select('counseling_boards.id','counseling_boards.name','counseling_boards.title', 'counseling_boards.slug','counseling_boards.misc', 'counseling_boards.status','image')
                                                    ->orderBy(DB::raw('RAND()'))
                                                    ->take(10)
                                                    ->get();

            $counselingBoard                    = CounselingBoard::orderBy('counseling_boards.id' ,'DESC')
                                                    ->where('counseling_boards.id','=', $boardId)
                                                    ->first();

            $counselingBoardDetailObj           =  DB::table('counseling_board_details')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_details.id', 'ASC')
                                                    ->first();  

            $counselingBoardImpDateObj          =  DB::table('counseling_board_imp_dates')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_imp_dates.id', 'ASC')
                                                    ->get();

            $counselingBoardLatestUpdateObj     =  DB::table('counseling_board_latest_updates')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_latest_updates.id', 'ASC')
                                                    ->get();

            $counselingBoardHighlightObj        =  DB::table('counseling_board_highlights')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_highlights.id', 'ASC')
                                                    ->get();

            $counselingBoardExamDateObj         =  DB::table('counseling_board_exam_dates')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_exam_dates.id', 'ASC')
                                                    ->get();

            $counselingBoardSamplePaperObj      =  DB::table('counseling_board_sample_papers')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_sample_papers.id', 'ASC')
                                                    ->get();  

            $counselingBoardSyllabusObj         =  DB::table('counseling_board_syllabus')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_syllabus.id', 'ASC')
                                                    ->get();

            $counselingBoardAdmissionDateObj    =  DB::table('counseling_board_admission_dates')
                                                    ->where('counselingBoardId','=', $boardId)
                                                    ->orderBy('counseling_board_admission_dates.id', 'ASC')
                                                    ->get();

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('boardId','boardpage',$boardId);

            return view('website/home.counseling.board-details-page', compact('counselingBoardDetailObj','counselingBoardImpDateObj','counselingBoardLatestUpdateObj','counselingBoardHighlightObj','counselingBoardExamDateObj','counselingBoardSamplePaperObj','counselingBoardSyllabusObj','counselingBoardAdmissionDateObj','boardId','counselingBoard', 'relatedBoards','otherBoards','category','seocontent'));
        }else{
            return redirect('/boards');
        }
    }

    public function allCoursesListPage(Request $request)
    {
        $educationLevelObj = DB::table('counseling_courses_education_levels')
                                ->leftjoin('eligibility_criterias', 'counseling_courses_education_levels.educationlevel_id', '=', 'eligibility_criterias.id')
                                ->select('eligibility_criterias.name','educationlevel_id','educationLevelSlug')
                                ->orderBy('counseling_courses_education_levels.id', 'ASC')
                                ->groupBy('educationlevel_id')
                                ->get();

        foreach ($educationLevelObj as $key => $value) {
            $value->counselingCoursesObj = DB::table('counseling_courses_education_levels')
                ->leftjoin('counseling_courses_details', 'counseling_courses_education_levels.coursesDetailsId', '=', 'counseling_courses_details.id')
                ->leftjoin('functionalarea', 'counseling_courses_details.functionalarea_id', '=', 'functionalarea.id')
                ->select('counseling_courses_details.id', 'title', 'image','slug','counseling_courses_details.employee_id','counseling_courses_details.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                ->where('counseling_courses_education_levels.educationlevel_id', '=', $value->educationlevel_id)
                ->orderBy('counseling_courses_education_levels.id', 'ASC')
                ->get();
        }

        $seoSlugName = 'course-list-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.counseling.all-courses-list-page',compact('educationLevelObj','seocontent'));
    }


    public function coursesStreamDetailsPage(Request $request, $eligibility, $slug)
    {   
        $counselingCoursesEducationLevelObj = DB::table('counseling_courses_education_levels')
            ->leftjoin('counseling_courses_details', 'counseling_courses_education_levels.coursesDetailsId', '=', 'counseling_courses_details.id')
            ->select('counseling_courses_education_levels.coursesDetailsId')
            ->where('counseling_courses_education_levels.educationLevelSlug', '=', $eligibility)
            ->where('counseling_courses_details.slug', '=', $slug)
            ->orderBy('counseling_courses_education_levels.id', 'ASC')
            ->get();
        
        if (sizeof($counselingCoursesEducationLevelObj) > 0) {
            $courseId                       = $counselingCoursesEducationLevelObj[0]->coursesDetailsId;

            $counselingCoursesDetail        = CounselingCoursesDetail::orderBy('counseling_courses_details.id', 'DESC')
                                                ->leftjoin('functionalarea', 'counseling_courses_details.functionalarea_id', '=', 'functionalarea.id')
                                                ->select('counseling_courses_details.id', 'title', 'description', 'image', 'bestChoiceOfCourse', 'jobsCareerOpportunityDesc','slug','functionalarea_id','counseling_courses_details.employee_id','counseling_courses_details.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName')
                                                 ->findOrFail($courseId);

            $counselingCoursesMoreDetailObj     =  DB::table('counseling_courses_more_details')
                                                    ->leftjoin('functionalarea', 'counseling_courses_more_details.functionalarea_id', '=', 'functionalarea.id')
                                                    ->leftjoin('degree', 'counseling_courses_more_details.degree_id', '=', 'degree.id')
                                                    ->where('coursesDetailsId','=', $courseId)
                                                    ->select('counseling_courses_more_details.id','counseling_courses_more_details.title', 'counseling_courses_more_details.description', 'counseling_courses_more_details.popularCities', 'counseling_courses_more_details.specialisations', 'counseling_courses_more_details.entranceExamsName', 'counseling_courses_more_details.coursesDetailsId', 'counseling_courses_more_details.functionalarea_id', 'counseling_courses_more_details.degree_id','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeID','degree.name as degreeName')
                                                    ->orderBy('counseling_courses_more_details.id', 'ASC')
                                                    ->get();

            foreach ($counselingCoursesMoreDetailObj as $key => $value) {
                $value->courseObj = DB::table('course')
                    ->where('course.degree_id', '=', $value->degree_id)
                    ->select('course.id as courseId', 'course.name')
                    ->orderBy('course.name','ASC')
                    ->get();
            }
           
            $counselingCoursesJobCareerObj  =  DB::table('counseling_courses_job_careers')
                                                    ->where('coursesDetailsId','=', $courseId)
                                                    ->orderBy('counseling_courses_job_careers.id', 'ASC')
                                                    ->get();


            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('courseId','coursepage',$courseId);

            return view('website/home.counseling.course-details-page', compact('counselingCoursesDetail','counselingCoursesMoreDetailObj','counselingCoursesJobCareerObj','courseId','eligibility','slug','seocontent'));
        }else{
            return redirect('/');
        }
    }

    
    public function careersOpportunitiesListPage(Request $request)
    {
        $functionalAreaObj = DB::table('counseling_career_interests')
                                ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                                ->select('functionalarea.name','pageslug')
                                ->orderBy('counseling_career_interests.id', 'ASC')
                                ->groupBy('functionalarea_id')
                                ->get();

        $seoSlugName = 'careers-opportunities-list-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.counseling.careers-opportunities-page',compact('functionalAreaObj','seocontent'));
    }

    public function careersOpportunitiesIntrestPage(Request $request, $stream)
    {
        $functionalAreaObj = DB::table('functionalarea')
                                ->select('functionalarea.name', 'id','pageslug')
                                ->groupBy('id')
                                ->get();
        $functionalareaId = '';
        foreach ($functionalAreaObj as $key => $value) {
            if ($stream == $value->pageslug) {
               $functionalareaId = $value->id;

               break;
            }
        }

        $counselingcareerinterests = CounselingCareerInterest::orderBy('counseling_career_interests.id', 'ASC')
                ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                ->where('counseling_career_interests.status', '=', '1')
                ->where('counseling_career_interests.functionalarea_id', '=', $functionalareaId)
                ->select('counseling_career_interests.id', 'title', 'description', 'image', 'status', 'functionalarea_id', 'slug','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName', DB::raw('(SELECT COUNT(counseling_career_relevants.id) FROM counseling_career_relevants WHERE counseling_career_relevants.careerInterest = counseling_career_interests.id and counseling_career_relevants.status = 1) AS careerRelevantPostCount'))
                ->having('careerRelevantPostCount', '>', 0)
                ->get();

        $seoSlugName = 'careers-opportunities-intrest-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.counseling.careers-opportunities-intrest-page', compact('counselingcareerinterests','stream','seocontent'));
    }

    public function counselingCareerRelevantPage(Request $request, $stream)
    {
        $query                  = CounselingCareerRelevant::orderBy('counseling_career_relevants.id', 'DESC')
                                        ->leftjoin('counseling_career_interests', 'counseling_career_relevants.careerInterest', '=', 'counseling_career_interests.id')
                                        ->leftjoin('functionalarea', 'counseling_career_interests.functionalarea_id', '=', 'functionalarea.id')
                                        ->where('counseling_career_relevants.status', '=', '1');
        
        $careerInterest =   $request->get('interests');                                  
        if ($request->has('interests')) {
            $allInterestedStream[] = $request->get('interests');
            foreach($allInterestedStream as $key ) {
                $interestedStreamSlug = $key;
            }
            $query->whereIn('counseling_career_interests.slug', explode(',', $interestedStreamSlug));
        }else{
            $functionalAreaObj = DB::table('functionalarea')
                                ->select('functionalarea.name', 'id')
                                ->groupBy('id')
                                ->get();
            $functionalareaId = '';
            foreach ($functionalAreaObj as $key => $value) {
                if ($stream == $value->pageslug) {
                   $functionalareaId = $value->id;
                    $query->where('counseling_career_relevants.functionalarea_id', '=', $functionalareaId);
                   break;
                }
            }
        }
        
            
        $counselingCareerRelevant   =    $query->paginate(20, array('counseling_career_relevants.id', 'counseling_career_relevants.title', 'counseling_career_relevants.description', 'counseling_career_relevants.image', 'counseling_career_relevants.status','salery', 'stream', 'mandatorySubject', 'academicDifficulty', 'counseling_career_relevants.functionalarea_id', 'counseling_career_relevants.slug','counseling_career_relevants.employee_id','counseling_career_relevants.updated_at','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','counseling_career_interests.id as counseling_career_interestsID','counseling_career_interests.title as interestsTitle'));

        $seoSlugName = 'careers-opportunities-relevant-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.counseling.counseling-career-relevant-list-page', compact('stream','counselingCareerRelevant','careerInterest','seocontent'));
    }

    public function careersOpportunitiesStreamDetails(Request $request, $stream, $slug)
    {   
        $careersReleventDetailObj = DB::table('counseling_career_relevants')
            ->where('counseling_career_relevants.slug', '=', $slug)
            ->orderBy('counseling_career_relevants.id', 'ASC')
            ->first();

        if (!empty($careersReleventDetailObj)) {
            $careerRelevantId                       = $careersReleventDetailObj->id;
            $counselingCareerDetailObj = CounselingCareerDetail::orderBy('counseling_career_details.id' ,'DESC')
                            ->where('counseling_career_details.careerRelevantId','=', $careerRelevantId)
                            ->select('id')
                            ->get();

            $counselingcareerdetail = CounselingCareerDetail::orderBy('counseling_career_details.id', 'DESC')
                                        ->leftJoin('users as eID','counseling_career_details.employee_id', '=','eID.id')
                                        ->where('counseling_career_details.id','=', $counselingCareerDetailObj[0]->id)
                                        ->select('counseling_career_details.id','title', 'description', 'image', 'jobProfileDesc', 'totalLikes', 'pros', 'cons','status', 'futureGrowthPurpose', 'employeeOpportunities', 'studyMaterial', 'whereToStudy', 'functionalarea_id', 'slug', 'careerRelevantId','counseling_career_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_career_details.updated_at','counseling_career_details.purpose_desc','counseling_career_details.eligibility','counseling_career_details.qualification','counseling_career_details.syllabus','counseling_career_details.exam_pattern','counseling_career_details.selection_criteria','counseling_career_details.frequency','counseling_career_details.other_details')
                                        ->first();

            $careerId               =   $counselingcareerdetail->id;

            $counselingCareerSkillRequirementObj    =  DB::table('counseling_career_skill_requirements')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_skill_requirements.id', 'ASC')
                                                        ->get();

            $counselingCareerJobRoleSaleryObj       =  DB::table('counseling_career_job_role_saleries')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_job_role_saleries.id', 'ASC')
                                                        ->get();  

            $counselingCareerWhereToStudyObj         =  DB::table('counseling_career_where_to_studies')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_where_to_studies.id', 'ASC')
                                                        ->get();

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('careerReleventId','careerreleventpage',$careerId);

            return view('website/home.counseling.careers-opportunities-stream-details', compact('counselingcareerdetail','counselingCareerJobRoleSaleryObj','counselingCareerWhereToStudyObj','counselingCareerSkillRequirementObj', 'careerId', 'slug','stream','careersReleventDetailObj','seocontent'));
        }else{
            return redirect('/');
        }
    }

    public function allPopularCareerListPage(Request $request)
    {   

        $popularCareeerlist      = CounselingCareerDetail::orderBy('counseling_career_details.id', 'DESC')
                                            ->where('counseling_career_details.status', '=', '1')
                                            ->where('counseling_career_details.functionalarea_id', '=', null)
                                            ->where('counseling_career_details.careerRelevantId', '=', null)
                                            ->paginate(20, array('counseling_career_details.id','title', 'image','slug','description'));


        $seoSlugName = 'popular-careers';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home.counseling.all-popular-career-list-page', compact('popularCareeerlist','seocontent'));
    }

    public function popularCareersDetails(Request $request, $slug)
    {   
        $careersOpportunitiesDetailObj = DB::table('counseling_career_details')
            ->select('counseling_career_details.id')
            ->where('counseling_career_details.slug', '=', $slug)
            ->orderBy('counseling_career_details.id', 'ASC')
            ->get();

        if (sizeof($careersOpportunitiesDetailObj) > 0) {
            $careerId                       = $careersOpportunitiesDetailObj[0]->id;

            $counselingcareerdetail = CounselingCareerDetail::orderBy('counseling_career_details.id', 'DESC')
                                        ->leftJoin('users as eID','counseling_career_details.employee_id', '=','eID.id')
                                        ->where('counseling_career_details.functionalarea_id', '=', null)
                                        ->where('counseling_career_details.careerRelevantId', '=', null)
                                        ->select('counseling_career_details.id','title', 'description', 'image', 'jobProfileDesc', 'totalLikes', 'pros', 'cons','status', 'futureGrowthPurpose', 'employeeOpportunities', 'studyMaterial', 'whereToStudy', 'functionalarea_id', 'slug', 'careerRelevantId','counseling_career_details.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','counseling_career_details.updated_at','counseling_career_details.purpose_desc','counseling_career_details.eligibility','counseling_career_details.qualification','counseling_career_details.syllabus','counseling_career_details.exam_pattern','counseling_career_details.selection_criteria','counseling_career_details.frequency','counseling_career_details.other_details')
                                        ->findOrFail($careerId);

            $counselingCareerSkillRequirementObj    =  DB::table('counseling_career_skill_requirements')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_skill_requirements.id', 'ASC')
                                                        ->get();

            $counselingCareerJobRoleSaleryObj       =  DB::table('counseling_career_job_role_saleries')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_job_role_saleries.id', 'ASC')
                                                        ->get();  

            $counselingCareerWhereToStudyObj         =  DB::table('counseling_career_where_to_studies')
                                                        ->where('careerDetailsId','=', $careerId)
                                                        ->orderBy('counseling_career_where_to_studies.id', 'ASC')
                                                        ->get();

            $relatedPopularCareeerlist      = CounselingCareerDetail::orderBy('counseling_career_details.id', 'DESC')
                                                ->where('counseling_career_details.status', '=', '1')
                                                ->where('counseling_career_details.functionalarea_id', '=', null)
                                                ->where('counseling_career_details.careerRelevantId', '=', null)
                                                ->select('counseling_career_details.id','title', 'image','slug')
                                                ->take(15)
                                                ->get();


            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('popularCareerId','popularcareerpage',$careerId);

            return view('website/home.counseling.popular-careers-details', compact('counselingcareerdetail','counselingCareerJobRoleSaleryObj','counselingCareerWhereToStudyObj','counselingCareerSkillRequirementObj', 'careerId', 'slug','relatedPopularCareeerlist','seocontent','seocontent'));
        }else{
            return redirect('/');
        }
    }

    public function eduCareerMelaPage(Request $request, $slug)
    {
        if($slug == 2024){
            return view('website.home.educareer.edu-career-mela-2024');
        }else{
            return redirect('/');
        }
    }

}