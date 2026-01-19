<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\EducationLevel;
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
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class EducationLevelController extends Controller
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
                                    ->where('alltableinformations.name', '=', 'EducationLevel')
                                    ->where('userprivileges.index', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'EducationLevel')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                   // $educationlevel = EducationLevel::paginate(15);
                    $query =  EducationLevel::orderBy('educationlevel.id', 'DESC')
                            ->leftJoin('users as eID','educationlevel.employee_id', '=','eID.id');

                    $isShowOnTop = Input::get('isShowOnTop');
                    if ($isShowOnTop == '0') {
                        $query->where('educationlevel.isShowOnTop', '=', '0');
                    }else{
                        if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                            $query->where('educationlevel.isShowOnTop', '=', Input::get('isShowOnTop'));
                        }
                    }

                    $isShowOnHome = Input::get('isShowOnHome');
                    if ($isShowOnHome == '0') {
                        $query->where('educationlevel.isShowOnHome', '=', '0');
                    }else{
                        if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                            $query->where('educationlevel.isShowOnHome', '=', Input::get('isShowOnHome'));
                        }
                    }

                    if (!empty(Input::get('educationLevel'))) {
                        $query->where('educationlevel.name', 'LIKE', '%' . Input::get('educationLevel') . '%');
                    }

                    if (!empty($request->get('searchByEmployeeId'))) {
                        $query->where('educationlevel.employee_id', '=', Input::get('searchByEmployeeId'));
                    }

                    $educationlevel = $query->paginate(15, array('educationlevel.id', 'educationlevel.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','educationlevel.updated_at','educationlevel.isShowOnTop','educationlevel.isShowOnHome'));

                    $tablename = 'educationlevel';
                    return view('administrator/educationlevel.index', compact('educationlevel','tablename'))
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
                                    ->where('alltableinformations.name', '=', 'EducationLevel')
                                    ->where('userprivileges.create', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $tablename = 'educationlevel';
                    return view('employee/educationlevel.create', compact('tablename'));
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
                //EducationLevel::create($request->all());

                $educationlevel = New EducationLevel();
                $educationlevel->name = Input::get('name');
                $educationlevel->employee_id = Auth::id();
                $educationlevel->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('EducationLevel','educationlevel',$educationlevel->id, $request->all(), 'educationlevel');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($educationlevel->id, $request->all());
                Session::flash('flash_message', 'EducationLevel added!');
                return redirect('employee/educationlevel');
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
                                    ->where('alltableinformations.name', '=', 'EducationLevel')
                                    ->where('userprivileges.show', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    //$educationlevel = EducationLevel::findOrFail($id);
                    $educationlevel = EducationLevel::orderBy('id', 'DESC')
                            ->leftJoin('users as eID','educationlevel.employee_id', '=','eID.id')
                            ->select('educationlevel.id', 'educationlevel.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','educationlevel.updated_at')
                            ->findOrFail($id);

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                            ->where('seo_contents.educationLevelId','=', $id)
                            ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','educationLevelId')
                            ->first();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('EducationLevel','educationlevel',$id);
                    $tablename = 'educationlevel';

                    return view('employee/educationlevel.show', compact('educationlevel','seocontent','newUpdatedFields','tablename'));
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
                                    ->where('alltableinformations.name', '=', 'EducationLevel')
                                    ->where('userprivileges.edit', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $educationlevel = EducationLevel::findOrFail($id);

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->where('seo_contents.educationLevelId','=', $id)
                            ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                            ->get();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('EducationLevel','educationlevel',$id);
                    $tablename = 'educationlevel';
                    
                    return view('employee/educationlevel.edit', compact('educationlevel','seocontent','newUpdatedFields','tablename'));
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
                /*$educationlevel = EducationLevel::findOrFail($id);
                $educationlevel->update($request->all());*/
                $educationlevel = EducationLevel::findOrFail($id);
                $educationlevel->name = Input::get('name');
                $educationlevel->employee_id = Auth::id();
                $educationlevel->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('EducationLevel','educationlevel',$educationlevel->id, $request->all(), 'educationlevel');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($educationlevel->id, $request->all());
                Session::flash('flash_message', 'EducationLevel updated!');
                return redirect('employee/educationlevel');
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
                                    ->where('alltableinformations.name', '=', 'EducationLevel')
                                    ->where('userprivileges.delete', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    DB::table('seo_contents')
                        ->where('seo_contents.educationLevelId', '=', $id)
                        ->delete();
                        
                    EducationLevel::destroy($id);
                    Session::flash('flash_message', 'EducationLevel deleted!');
                    return redirect('employee/educationlevel');
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


   public function educationLevelEmployeeSearch(Request $request)
    {
        $search0 = 'educationlevel.id';
       
       
        if( $request->educationLevel != null ){
            $search1 = "AND `educationlevel`.`name` LIKE  '%".$request->educationLevel."%'";
        }else{
            $search1 =  '';
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
                
        $educationLevelSearchDataObj = DB::select( DB::raw("SELECT educationlevel.id as educationlevelId, educationlevel.name ,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,educationlevel.updated_at FROM  `educationlevel`
                        LEFT JOIN `users` as `eID` ON `educationlevel`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        ORDER BY educationlevel.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $educationLevelSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(educationlevel.id) as totalCount FROM  `educationlevel` 
                        LEFT JOIN `users` as `eID` ON `educationlevel`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        ORDER BY educationlevel.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($educationLevelSearchDataObj1)){
            $numRecords = $educationLevelSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'educationLevelSearchDataObj' => $educationLevelSearchDataObj,
                    'educationLevelSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $educationLevelSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'educationLevelSearchDataObj' => $educationLevelSearchDataObj,
                    'educationLevelSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $educationLevelSearchDataObj1,
                );
        }

        if( !empty($educationLevelSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }



    public function allEducationLevelEmployeeSearch(Request $request){

         $educationLevel = EducationLevel::orderBy('educationlevel.id', 'DESC')
                        ->leftJoin('users as eID','educationlevel.employee_id', '=','eID.id')
                        ->select('educationlevel.id as educationlevelId', 'educationlevel.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','educationlevel.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($educationLevel);
    }

    public function deleteEmployeeSearchEducationLavel(Request $request, $id)
    {   
        EducationLevel::destroy($id);
        return Redirect::back();
    }

}
