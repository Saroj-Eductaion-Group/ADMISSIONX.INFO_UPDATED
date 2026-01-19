<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use DateTime;
use Redirect;
use Auth;
use Mail;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\StudentMark as StudentMark;
use App\Models\Gallery as Gallery;
use App\Models\SeoContent;
use App\Models\Entranceexam;
use App\Http\Controllers\Helper\FetchDataServiceController;

class StudentProfileController extends Controller
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
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'StudentProfile')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'StudentProfile')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                    //$studentprofile = StudentProfile::paginate(15);

                    $studentprofile = StudentProfile::orderBy('studentprofile.id', 'ASC')
                        ->join('users', 'studentprofile.users_id', '=', 'users.id')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('entranceexam', 'studentprofile.entranceexamname','=', 'entranceexam.id')
                        ->leftJoin('users as eID','studentprofile.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->paginate(15, array('studentprofile.id','gender', 'dateofbirth', 'parentsname', 'parentsnumber', 'hobbies', 'interests', 'achievementsawards', 'projects', 'entranceexamname', 'entranceexamnumber','users.id as userID','users.firstname', 'users.lastname','users.middlename', 'userrole.name as userRoleName', 'entranceexam.name as entranceexamName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','studentprofile.updated_at','studentprofile.created_at'));

                    $studentProfileObj = DB::table('studentprofile')
                                ->join('users', 'studentprofile.users_id', '=', 'users.id')
                                ->select('studentprofile.id as studentprofileID', 'users.id as userID','users.firstname','users.middlename','users.lastname')
                                ->where('users.userrole_id', '=', '3')
                                ->get()
                                ;

                    return view('employee/studentprofile.index', compact('studentprofile'))
                    ->with('storeEditUpdateAction', $storeEditUpdateAction)
                    ->with('studentProfileObj', $studentProfileObj)
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   
        return Redirect::back();
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
                                ->where('alltableinformations.name', '=', 'StudentProfile')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $userObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->where('users.userrole_id', '=','3')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

                $entranceExam = DB::table('entranceexam')
                    ->orderBy('entranceexam.name', 'ASC')
                    ->get()
                    ;

                    return view('employee/studentprofile.create')
                        ->with('userObj', $userObj)
                        ->with('entranceExam', $entranceExam);
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
                /*StudentProfile::create($request->all());
                Session::flash('flash_message', 'StudentProfile added!');*/

                $gender = Input::get('gender');
                $dateofbirth = Input::get('dateofbirth');
                $parentsname = Input::get('parentsname');
                $parentsnumber = Input::get('parentsnumber');
                $hobbies = Input::get('hobbies');
                $interests = Input::get('interests');
                $achievementsawards = Input::get('achievementsawards');
                $projects = Input::get('projects');
                $entranceexamname = Input::get('entranceexamname');
                $entranceexamnumber = Input::get('entranceexamnumber');
                $usersName = Input::get('usersName');  
           
                $studentProfileObj = new StudentProfile;

                $studentProfileObj->gender = $gender;
                $studentProfileObj->dateofbirth = $dateofbirth;
                $studentProfileObj->parentsname = $parentsname;
                $studentProfileObj->parentsnumber = $parentsnumber; 
                $studentProfileObj->hobbies = $hobbies;
                $studentProfileObj->interests = $interests;
                $studentProfileObj->achievementsawards = $achievementsawards;
                $studentProfileObj->projects = $projects; 
                $studentProfileObj->entranceexamname = $entranceexamname;
                $studentProfileObj->entranceexamnumber = $entranceexamnumber;
                $studentProfileObj->users_id = $usersName;
                $studentProfileObj->employee_id = Auth::id();
                $studentProfileObj->save();

                return redirect('employee/studentprofile');
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
                                ->where('alltableinformations.name', '=', 'StudentProfile')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    //$studentprofile = StudentProfile::findOrFail($id);
                      $studentprofile = StudentProfile::orderBy('studentprofile.id', 'ASC')
                        ->join('users', 'studentprofile.users_id', '=', 'users.id')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                        ->leftJoin('gallery','users.id','=','gallery.users_id')
                        ->leftJoin('entranceexam', 'studentprofile.entranceexamname','=','entranceexam.id')
                        ->leftJoin('address', 'studentprofile.id', '=', 'address.studentprofile_id')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->leftJoin('users as eID','studentprofile.employee_id', '=','eID.id')
                        ->where('addresstype.id','=','3')
                        ->select('studentprofile.id','gender', 'dateofbirth', 'parentsname', 'parentsnumber', 'hobbies', 'interests', 'achievementsawards', 'projects', 'entranceexam.name as entranceexamname', 'entranceexamnumber','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','users.email', 'users.phone', 'gallery.fullimage', 'studentprofile.slug', 'userstatus.name as userstatusName', 'address.name as addressName','address.address1','address.address2','address.postalcode','addresstype.id as addresstypeID', 'addresstype.name as addresstypeName','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName','country.name as countryName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','studentprofile.updated_at','studentprofile.created_at')
                        ->findOrFail($id)
                        ;

                    $studentprofile1 = StudentProfile::orderBy('studentprofile.id', 'ASC')
                        ->join('users', 'studentprofile.users_id', '=', 'users.id')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->join('userstatus', 'users.userstatus_id', '=', 'userstatus.id')
                        ->leftJoin('gallery','users.id','=','gallery.users_id')
                        ->leftJoin('entranceexam', 'studentprofile.entranceexamname','=','entranceexam.id')
                        ->leftJoin('address', 'studentprofile.id', '=', 'address.studentprofile_id')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->where('addresstype.id','=','4')
                        ->select('studentprofile.id','gender', 'dateofbirth', 'parentsname', 'parentsnumber', 'hobbies', 'interests', 'achievementsawards', 'projects', 'entranceexam.name as entranceexamname', 'entranceexamnumber','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','users.email', 'users.phone', 'gallery.fullimage', 'studentprofile.slug', 'userstatus.name as userstatusName', 'address.name as addressName','address.address1','address.address2','address.postalcode','addresstype.id as addresstypeID', 'addresstype.name as addresstypeName','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName','country.name as countryName')
                        ->findOrFail($id)
                        ;

                    $getStudentmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($id) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($id)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->where('studentmarks.studentprofile_id', '=', $id)
                                        ->select('studentmarks.id as studentmarksId', 'studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID','studentMarkType')
                                        ->orderBy('studentmarks.id', 'ASC')
                                        ->get()
                                        ;
                                     
                        if( empty($getStudentmarksObj) ){
                            $getStudentmarksObj = '';
                        }

                    $getStudentDocumentImages = DB::table('studentprofile')
                            ->leftJoin('users','studentprofile.users_id', '=','users.id')
                            ->join('documents','documents.users_id', '=','users.id')
                            ->where('studentprofile.id', '=', $id)
                            ->select('studentprofile.id as studentprofileId', 'users.id as usersId', 'documents.id as documentsId','documents.name as documentsName', 'documents.fullimage','documents.description', 'documents.width', 'documents.height','studentprofile.slug')
                            ->get()
                            ;

                    $dataArrayContent2 = array();
                    $dataArray2 = array();
                    if( empty($getStudentDocumentImages) ){
                        $getStudentDocumentImages = '';
                    }else{
                        foreach ($getStudentDocumentImages as $item) {
                            $fileName = $item->documentsName;
                            $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                            
                            //Data Array Content
                            $dataArrayContent2['studentprofileId'] = $item->studentprofileId;
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

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.userId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();

                    return view('employee/studentprofile.show', compact('studentprofile','seocontent'))
                            ->with('studentprofile', $studentprofile)
                            ->with('getStudentmarksObj',$getStudentmarksObj)
                            ->with('studentprofile1', $studentprofile1)
                            ->with('getStudentDocumentImages', $dataArray2);
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
                                ->where('alltableinformations.name', '=', 'StudentProfile')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $studentprofile = StudentProfile::findOrFail($id);
                    $userObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                            ->where('users.userrole_id', '=','3')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ;

                    $entranceExam = DB::table('entranceexam')
                    ->orderBy('entranceexam.name', 'ASC')
                    ->get()
                    ;

                        $currentDateTime = date("Y-m-d"); 
                        $verifyStudentAge = $studentprofile->dateofbirth; 

                        if ($studentprofile->dateofbirth != '0000-00-00') {
                                $bday = new DateTime($verifyStudentAge); 
                                $today = new DateTime($currentDateTime);
                                $diff = $today->diff($bday); 
                                $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';
                        }else{
                            $calculateDate = '';
                        }

                    $getStudent10thmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($id) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($id)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentmarks.name', '=', '10th')
                                        ->where('studentmarks.studentprofile_id', '=', $id)
                                        ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID','studentMarkType')
                                        ->orderBy('studentmarks.id', 'ASC')
                                        ->take(1)
                                        ->get()
                                        ;


                        if( empty($getStudent10thmarksObj) ){
                            $getStudent10thmarksObj = '';
                        }

                        $getStudent11thmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($id) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($id)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentmarks.name', '=', '11th')
                                        ->where('studentmarks.studentprofile_id', '=', $id)
                                        ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID','studentMarkType')
                                        ->orderBy('studentmarks.id', 'ASC')
                                        ->take(1)
                                        ->get()
                                        ;

                        if( empty($getStudent11thmarksObj) ){
                            $getStudent11thmarksObj = '';
                        }

                        $getStudent12thmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($id) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($id)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentmarks.name', '=', '12th')
                                        ->where('studentmarks.studentprofile_id', '=', $id)
                                        ->select('studentmarks.id as studentmarksId', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID','studentMarkType')
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

                        $studentUserId = $studentprofile->users_id;
                        $studentDataObj = DB::table('studentprofile')
                                    ->leftJoin('users', function ($join) use ( $studentUserId) {
                                        $join->on('studentprofile.users_id', '=','users.id')
                                            ->where('studentprofile.users_id', '=', DB::raw( $studentUserId)
                                            );  
                                        })
                                    ->leftJoin('gallery','users.id','=','gallery.users_id')
                                    ->where('studentprofile.slug', '=', $studentprofile->slug)
                                    ->where('gallery.caption', '=', 'Student Profile Picture')
                                    ->select('users.id as usersId','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage')
                                    ->orderBy('gallery.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;

            // print_r($studentDataObj);die;
                if( empty($studentDataObj) ){
                    $studentDataObj = '';
                }

                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.userId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                        ->get();

                return view('employee/studentprofile.edit', compact('studentprofile','seocontent'))
                ->with('userObj', $userObj)
                ->with('entranceExam', $entranceExam)
                ->with('getStudent10thmarksObj', $getStudent10thmarksObj)
                ->with('getStudent11thmarksObj', $getStudent11thmarksObj)
                ->with('getStudent12thmarksObj', $getStudent12thmarksObj)
                ->with('getStudentGraduationMarksObj', $getStudentGraduationMarksObj)
                ->with('calculateDate', $calculateDate)
                ->with('studentDataObj', $studentDataObj);
                   
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
            $dateofbirth = Input::get('dateofbirth');
            $currentDateTime = date("Y-m-d"); 
            //$calculateDate = $currentDateTime -  $dateofbirth; 
            $bday = new DateTime($dateofbirth); 
            $today = new DateTime($currentDateTime);
            $diff = $today->diff($bday); 
            $calculateDate = $diff->y; 
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){   
               /* $studentprofile = StudentProfile::findOrFail($id);
                $studentprofile->update($request->all());
                Session::flash('flash_message', 'StudentProfile updated!');*/

                $studentProfileObj = StudentProfile::findOrFail($id);

                //$studentProfileObj->users_id = Input::get('usersName'); 
                
                if( !empty(Input::get('gender')) ){
                    $studentProfileObj->gender = Input::get('gender');    
                }

                if( !empty(Input::get('dateofbirth')) ){
                    $studentProfileObj->dateofbirth = Input::get('dateofbirth');    
                }

                if( !empty(Input::get('parentsname')) ){
                    $studentProfileObj->parentsname = Input::get('parentsname');    
                }

                if( !empty(Input::get('parentsnumber')) ){
                    $studentProfileObj->parentsnumber = Input::get('parentsnumber');    
                }

                if( !empty(Input::get('hobbies')) ){
                    $studentProfileObj->hobbies = Input::get('hobbies');    
                }

                if( !empty(Input::get('interests')) ){
                    $studentProfileObj->interests = Input::get('interests');    
                }

                if( !empty(Input::get('achievementsawards')) ){
                    $studentProfileObj->achievementsawards = Input::get('achievementsawards');    
                }

                if( !empty(Input::get('projects')) ){
                    $studentProfileObj->projects = Input::get('projects');    
                }
                if( !empty(Input::get('entranceexamname')) ){
                    if((Input::get('entranceexamname') == "Others") && !empty(Input::get('other_entranceexamname'))){
                        $entranceexam = New Entranceexam();
                        $entranceexam->name = Input::get('other_entranceexamname');
                        $entranceexam->employee_id = Auth::id();
                        $entranceexam->save();
                        $studentProfileObj->entranceexamname = $entranceexam->id;        
                    }else{
                        $studentProfileObj->entranceexamname = Input::get('entranceexamname');        
                    }
                }

                if( !empty(Input::get('entranceexamnumber')) ){
                    $studentProfileObj->entranceexamnumber = Input::get('entranceexamnumber');    
                }

                if ($calculateDate >= 18 ) {
                    $studentProfileObj->isverifiedage = '1';
                }else{
                    $studentProfileObj->isverifiedage = '0';
                }
                $studentProfileObj->employee_id = Auth::id();
                $studentProfileObj->save();


                
                $studentMarksObj1 = DB::table('studentmarks')
                                    ->where('studentmarks.studentprofile_id', '=', $id )
                                    ->where('studentmarks.name', '=', '10th')
                                    ->orderBy('studentmarks.id','DESC')
                                    ->take(1)
                                    ->select('studentmarks.id','studentmarks.marks','studentmarks.percentage')
                                    ->get()
                                    ;
                    
                    if(!empty($studentMarksObj1)){
                        $studentMarksObj1 = StudentMark::where('studentmarks.studentprofile_id', '=', $id )->where('studentmarks.name', '=', '10th')->firstOrFail();

                        $studentMarksObj1->marks = Input::get('tenthMarks');
                        $studentMarksObj1->percentage = Input::get('tenthMarksPercentage');
                        $studentMarksObj1->studentMarkType = Input::get('tenthMarkType'); 
                        $studentMarksObj1->employee_id = Auth::id();
                        $studentMarksObj1->save();   
                    }else{
                       
                        $studentMarksObj1 = new StudentMark;
                        $studentMarksObj1->name = '10th';
                        $studentMarksObj1->marks = Input::get('tenthMarks'); 
                        $studentMarksObj1->percentage = Input::get('tenthMarksPercentage'); 
                        $studentMarksObj1->studentMarkType = Input::get('tenthMarkType');  
                        $studentMarksObj1->category_id = '3';
                        $studentMarksObj1->studentprofile_id = $id; 
                        $studentMarksObj1->employee_id = Auth::id();
                        $studentMarksObj1->save();
                    }
                    

                
                $studentMarksObj2 = DB::table('studentmarks')
                                    ->where('studentmarks.studentprofile_id', '=', $id )
                                    ->where('studentmarks.name', '=', '11th')
                                    ->orderBy('studentmarks.id','DESC')
                                    ->take(1)
                                    ->select('studentmarks.marks','studentmarks.percentage')
                                    ->get()
                                    ;
             
                if(!empty($studentMarksObj2)){
                    $studentMarksObj2 = StudentMark::where('studentmarks.studentprofile_id', '=', $id )->where('studentmarks.name', '=', '11th')->firstOrFail();

                    $studentMarksObj2->marks = Input::get('eleventhmarks');
                    $studentMarksObj2->percentage = Input::get('eleventhMarksPercentage');
                    $studentMarksObj2->studentMarkType = Input::get('eleventhMarkType');
                    $studentMarksObj2->studentprofile_id = $id;
                    $studentMarksObj2->employee_id = Auth::id();
                    $studentMarksObj2->save();
                }else{
                    $studentMarksObj22 = new StudentMark;
                    $studentMarksObj22->name = '11th';
                    $studentMarksObj22->marks = Input::get('eleventhmarks');  
                    $studentMarksObj22->percentage = Input::get('eleventhMarksPercentage'); 
                    $studentMarksObj22->studentMarkType = Input::get('eleventhMarkType');
                    $studentMarksObj22->category_id = '3';
                    $studentMarksObj22->studentprofile_id = $id; 
                    $studentMarksObj22->employee_id = Auth::id();
                    $studentMarksObj22->save();
                }

               
                $studentMarksObj3 = DB::table('studentmarks')
                                    ->where('studentmarks.studentprofile_id', '=', $id )
                                    ->where('studentmarks.name', '=', '12th')
                                    ->orderBy('studentmarks.id','DESC')
                                    ->take(1)
                                    ->select('studentmarks.marks','studentmarks.percentage')
                                    ->get()
                                    ;

                if(!empty($studentMarksObj3)){
                     $studentMarksObj3 = StudentMark::where('studentmarks.studentprofile_id', '=', $id )->where('studentmarks.name', '=', '12th')->firstOrFail();
                     
                    $studentMarksObj3->marks = Input::get('twelvemarks');
                    $studentMarksObj3->percentage = Input::get('twelveMarksPercentage');
                    $studentMarksObj3->studentMarkType = Input::get('twelveMarkType');
                    $studentMarksObj3->employee_id = Auth::id();
                    $studentMarksObj3->save();
                }else{
                    $studentMarksObj33 = new StudentMark;
                    $studentMarksObj33->name = '12th';
                    $studentMarksObj33->marks = Input::get('twelvemarks');
                    $studentMarksObj33->percentage = Input::get('twelveMarksPercentage'); 
                    $studentMarksObj33->studentMarkType = Input::get('twelveMarkType');  
                    $studentMarksObj33->category_id = '3';
                    $studentMarksObj33->studentprofile_id = $id; 
                    $studentMarksObj33->employee_id = Auth::id();
                    $studentMarksObj33->save();
                }

                $studentMarksObj4 = DB::table('studentmarks')
                                    ->where('studentmarks.studentprofile_id', '=', $id )
                                    ->where('studentmarks.name', '=', 'Graduation')
                                    ->orderBy('studentmarks.id','DESC')
                                    ->take(1)
                                    ->select('studentmarks.marks','studentmarks.percentage')
                                    ->get()
                                    ;

                if(!empty($studentMarksObj4)){
                    $studentMarksObj4 = StudentMark::where('studentmarks.studentprofile_id', '=', $id )->where('studentmarks.name', '=', 'Graduation')->firstOrFail();
                    
                    $studentMarksObj4->marks = Input::get('graduationmarks');
                    $studentMarksObj4->percentage = Input::get('graduationMarksPercentage');
                    $studentMarksObj4->studentMarkType = Input::get('graduationMarkType');
                    $studentMarksObj4->employee_id = Auth::id();
                    $studentMarksObj4->save();
                }else{
                    $studentMarksObj4 = new StudentMark;
                    $studentMarksObj4->name = 'Graduation';
                    $studentMarksObj4->marks = Input::get('graduationmarks');
                    $studentMarksObj4->percentage = Input::get('graduationMarksPercentage');
                    $studentMarksObj4->studentMarkType = Input::get('graduationMarkType');   
                    $studentMarksObj4->category_id = '3';
                    $studentMarksObj4->studentprofile_id = $id; 
                    $studentMarksObj4->employee_id = Auth::id();
                    $studentMarksObj4->save();
                }

                if($request->file('uploadStudentProfilePic'))
                {   
                    $extensionOfFile = '';
                    $path = $_FILES['uploadStudentProfilePic']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $ext = strtolower($ext);

                    $tempPath = $_FILES[ 'uploadStudentProfilePic' ][ 'tmp_name' ];
                    $currentMyTime = strtotime('now');
                    $imageNameWithTime = $studentProfileObj->slug.'-'.$currentMyTime;
                    $fileWithExtension = $imageNameWithTime.'.'.$ext;
                    $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
                 
                    //Set the image folder path
                    if(env('APP_ENV') == 'local'){
                       $dirPath = public_path().'/gallery/'.$studentProfileObj->slug.'/';
                    }else{
                        $dirPath = public_path().'/gallery/'.$studentProfileObj->slug.'/';
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
                        //unlink($dirPath.$galleryObj->name);
                        //unlink($dirPath.$galleryObj->fullimage);                

                        $galleryObj->name = $fileWithExtension;
                        $galleryObj->fullimage = $fileWithExtension1;
                        $galleryObj->caption = 'Student Profile Picture';
                        $galleryObj->width = round($newwidth);
                        $galleryObj->height = round($newheight);
                        $galleryObj->users_id =  $studentProfileObj->users_id;
                        $galleryObj->category_id = '3';
                        $galleryObj->employee_id = Auth::id();
                        $galleryObj->save();
                    }else{
                        $galleryObj = new Gallery;

                        $galleryObj->name = $fileWithExtension;
                        $galleryObj->fullimage = $fileWithExtension1;
                        $galleryObj->caption = 'Student Profile Picture';
                        $galleryObj->width = round($newwidth);
                        $galleryObj->height = round($newheight);
                        $galleryObj->users_id = $studentProfileObj->users_id;
                        $galleryObj->category_id = '3';
                        $galleryObj->employee_id = Auth::id();
                        $galleryObj->save();
                    }
                }
                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());
                
                return redirect('employee/studentprofile');
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
                                ->where('alltableinformations.name', '=', 'StudentProfile')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    StudentProfile::destroy($id);
                    Session::flash('flash_message', 'StudentProfile deleted!');
                    return redirect('employee/studentprofile');
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
    public function studentProfileEmployeeSearch(Request $request)
    {
        $search0 = 'studentprofile.id';

        if( $request->studentName != null ){
            $search1 = "AND `users`.`firstname` LIKE  '%".$request->studentName."%'";
        }else{
            $search1 =  '';
        }

        if( $request->userEmailAddress != '' ){
            $search2 = "AND `users`.`email` LIKE  '%".$request->userEmailAddress."%'";
        }else{
            $search2 =  '';
        }

        if( $request->userPhoneNumber != '' ){
            $search3 = "AND `users`.`phone` LIKE  '%".$request->userPhoneNumber."%'";
        }else{
            $search3 =  '';
        }

        if( $request->parentsName != '' ){
            $search4 = "AND `parentsName` LIKE  '%".$request->parentsName."%'";
        }else{
            $search4 =  '';
        }

        if( $request->gender != '' ){
            $search5 = "AND `gender` =  '".$request->gender."'";
        }else{
            $search5 =  '';
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
       
                      
        $studentProfileDataObj = DB::select( DB::raw("SELECT studentprofile.id as studentprofileId, gender, dateofbirth, parentsname, parentsnumber, hobbies, interests, achievementsawards, projects, entranceexamname, entranceexamnumber,users.id as userID, users.firstname, users.lastname,users.middlename, userrole.name as userRoleName,users.email, users.phone, eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,studentprofile.updated_at,studentprofile.created_at FROM  `studentprofile`      
                        LEFT JOIN `users` ON `studentprofile`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `studentprofile`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        $search5
                        AND users.userstatus_id != '5'
                        ORDER BY studentprofile.id ASC
                        LIMIT 20 OFFSET $getValue"
                    ));

        $studentProfileDataObj1 = DB::select( DB::raw("SELECT COUNT(studentprofile.id) as totalCount FROM  `studentprofile` 
                        LEFT JOIN `users` ON `studentprofile`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `studentprofile`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        $search5
                        AND users.userstatus_id != '5'
                        ORDER BY studentprofile.id ASC
                        LIMIT 20 "
                    ));

//print_r($studentProfileDataObj1);die;

        if(!empty($studentProfileDataObj1)){
            $numRecords = $studentProfileDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'studentProfileDataObj' => $studentProfileDataObj,
                    'studentProfileDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $studentProfileDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'studentProfileDataObj' => $studentProfileDataObj,
                    'studentProfileDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $studentProfileDataObj1,
                );
        }

        if( !empty($studentProfileDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allStudentProfileEmployeeSearch(Request $request){

        $studentProfile = StudentProfile::orderBy('studentprofile.id', 'ASC')
                    ->leftJoin('users', 'studentprofile.users_id', '=', 'users.id')
                    ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->leftJoin('entranceexam', 'studentprofile.entranceexamname','=', 'entranceexam.id')
                    ->leftJoin('users as eID','studentprofile.employee_id', '=','eID.id')
                    ->where('users.userstatus_id','!=','5')
                    ->select('studentprofile.id as studentprofileId','gender', 'dateofbirth', 'parentsname', 'parentsnumber', 'hobbies', 'interests', 'achievementsawards', 'projects', 'entranceexamname', 'entranceexamnumber','users.id as userID','users.firstname', 'users.lastname','users.middlename', 'userrole.name as userRoleName','entranceexam.name as entranceexamName','users.email', 'users.phone','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','studentprofile.updated_at','studentprofile.created_at')
                    ->take(20)
                    ->get();
  
        return json_encode($studentProfile);
    }

}
