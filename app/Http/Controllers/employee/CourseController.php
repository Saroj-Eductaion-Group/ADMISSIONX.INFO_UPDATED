<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Course;
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
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\Degree as Degree;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class CourseController extends Controller
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
                                    ->where('alltableinformations.name', '=', 'Course')
                                    ->where('userprivileges.index', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Course')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                    $query = Course::orderBy('id', 'DESC')
                            ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                            ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                            ->leftJoin('users as eID','course.employee_id', '=','eID.id');

                    $isShowOnTop = Input::get('isShowOnTop');
                    if ($isShowOnTop == '0') {
                        $query->where('course.isShowOnTop', '=', '0');
                    }else{
                        if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                            $query->where('course.isShowOnTop', '=', Input::get('isShowOnTop'));
                        }
                    }

                    $isShowOnHome = Input::get('isShowOnHome');
                    if ($isShowOnHome == '0') {
                        $query->where('course.isShowOnHome', '=', '0');
                    }else{
                        if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                            $query->where('course.isShowOnHome', '=', Input::get('isShowOnHome'));
                        }
                    }

                    if (!empty(Input::get('courseName'))) {
                        $query->where('course.name', 'LIKE', '%' . Input::get('courseName') . '%');
                    }

                    if (!empty($request->get('degreeName'))) {
                        $query->where('degree.id', '=', Input::get('degreeName'));
                    }

                    if (!empty($request->get('searchByEmployeeId'))) {
                        $query->where('course.employee_id', '=', Input::get('searchByEmployeeId'));
                    }

                    $course = $query->paginate(15, array('course.id', 'course.name', 'degree.name as degreeName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','functionalarea.name as functionalareaName','course.updated_at','course.isShowOnTop','course.isShowOnHome'));

                    $tablename = 'course';
                    $degreeObj = Degree::all();
                    return view('administrator/course.index', compact('course','tablename'))
                    ->with('degreeObj', $degreeObj)
                    ->with('storeEditUpdateAction', $storeEditUpdateAction);
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
                $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Course')
                                    ->where('userprivileges.create', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $degreeObj = Degree::all();
                    $functionalAreaObj = DB::table('functionalarea')
                        ->orderBy('functionalarea.name', 'ASC')
                        ->get()
                        ;
                    
                    $tablename = 'course';
                    return view('employee/course.create', compact('tablename'))
                    ->with('degreeObj', $degreeObj)
                    ->with('functionalAreaObj', $functionalAreaObj);
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

                $courseObj = New Course;
                $courseObj->name = Input::get('name');
                $courseObj->degree_id = Input::get('degree_id');
                $courseObj->functionalarea_id = Input::get('functionalarea_id');
                $courseObj->employee_id = Auth::id();
                $courseObj->save();      

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('Course','course',$courseObj->id, $request->all(), 'course');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($courseObj->id, $request->all());      

                Session::flash('flash_message', 'Course added!');
                return redirect('employee/course');
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
                                    ->where('alltableinformations.name', '=', 'Course')
                                    ->where('userprivileges.show', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $course = Course::orderBy('id', 'DESC')
                                ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                                ->leftJoin('functionalarea', 'functionalarea.id', '=', 'degree.functionalarea_id')
                                ->leftJoin('users as eID','course.employee_id', '=','eID.id')
                                ->select('course.id', 'course.name', 'degree.name as degreeName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','functionalarea.name as functionalareaName','course.updated_at')
                                 ->findOrFail($id);

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                            ->where('seo_contents.topCourseId','=', $id)
                            ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','topCourseId')
                            ->first();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('Course','course',$id);
                    $tablename = 'course';
                
                    return view('employee/course.show', compact('course','seocontent','newUpdatedFields','tablename'));
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
                                    ->where('alltableinformations.name', '=', 'Course')
                                    ->where('userprivileges.edit', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $course = Course::findOrFail($id);
                    $degreeObj = Degree::all();

                    $functionalAreaObj = DB::table('functionalarea')
                        ->orderBy('functionalarea.name', 'ASC')
                        ->get()
                        ;

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->where('seo_contents.topCourseId','=', $id)
                            ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                            ->get();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('Course','course',$id);
                    $tablename = 'course';
                    return view('employee/course.edit', compact('course','seocontent','newUpdatedFields','tablename'))
                    ->with('degreeObj', $degreeObj)
                    ->with('functionalAreaObj', $functionalAreaObj);
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
                /*$course = Course::findOrFail($id);
                $course->update($request->all());*/

                $courseObj = Course::findOrFail($id);
                $courseObj->name = Input::get('name');
                $courseObj->degree_id = Input::get('degree_id');
                $courseObj->functionalarea_id = Input::get('functionalarea_id');
                $courseObj->employee_id = Auth::id();
                $courseObj->save();  

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('Course','course',$courseObj->id, $request->all(), 'course');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($courseObj->id, $request->all());

                Session::flash('flash_message', 'Course updated!');
                return redirect('employee/course');
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
                                    ->where('alltableinformations.name', '=', 'Course')
                                    ->where('userprivileges.delete', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    DB::table('seo_contents')
                        ->where('seo_contents.topCourseId', '=', $id)
                        ->delete();
                        
                    Course::destroy($id);
                    Session::flash('flash_message', 'Course deleted!');
                    return redirect('employee/course');
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
    public function courseEmployeeSearch(Request $request)
    {
        $search0 = 'course.id';
      
        if( $request->courseName != '' ){
            $search1 = "AND `course`.`name` LIKE  '%".$request->courseName."%'";
        }else{
            $search1 =  '';
        }

        if( $request->degreeName != '' ){
            $search2 = "AND `degree`.`id` = '".$request->degreeName."'";
        }else{
            $search2 =  '';
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
                
        $courseSearchDataObj = DB::select( DB::raw("SELECT course.id as courseID, course.name, degree.name as degreeName,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,course.updated_at FROM  `course`
                        LEFT JOIN `degree` ON `course`.`degree_id` = `degree`.`id`
                        LEFT JOIN `users` as `eID` ON `course`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY course.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
        
       //  print_r($courseSearchDataObj);die;
        $courseSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(course.id) as totalCount FROM  `course` 
                        LEFT JOIN `degree` ON `course`.`degree_id` = `degree`.`id`
                        LEFT JOIN `users` as `eID` ON `course`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY course.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($courseSearchDataObj1)){
            $numRecords = $courseSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'courseSearchDataObj' => $courseSearchDataObj,
                    'courseSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $courseSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'courseSearchDataObj' => $courseSearchDataObj,
                    'courseSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $courseSearchDataObj1,
                );
        }

        if( !empty($courseSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allCourseEmployeeSearch(Request $request){

         $course = Course::orderBy('course.id', 'DESC')
                        ->leftJoin('degree', 'course.degree_id', '=', 'degree.id')
                        ->leftJoin('users as eID','course.employee_id', '=','eID.id')
                        ->select('course.id as courseID', 'course.name', 'degree.name as degreeName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','course.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($course);
    }

    public function deleteEmployeeSearchCourse(Request $request, $id)
    {   
        Course::destroy($id);
        return Redirect::back();
    }


}
