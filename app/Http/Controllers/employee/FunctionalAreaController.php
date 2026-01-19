<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\FunctionalArea;
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


class FunctionalAreaController extends Controller
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
                                    ->where('alltableinformations.name', '=', 'FunctionalArea')
                                    ->where('userprivileges.index', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                     //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'FunctionalArea')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;


                   // $functionalarea = FunctionalArea::paginate(15);
                     $query =  FunctionalArea::orderBy('functionalarea.id', 'DESC')
                            ->leftJoin('users as eID','functionalarea.employee_id', '=','eID.id');

                    $isShowOnTop = Input::get('isShowOnTop');
                    if ($isShowOnTop == '0') {
                        $query->where('functionalarea.isShowOnTop', '=', '0');
                    }else{
                        if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                            $query->where('functionalarea.isShowOnTop', '=', Input::get('isShowOnTop'));
                        }
                    }

                    $isShowOnHome = Input::get('isShowOnHome');
                    if ($isShowOnHome == '0') {
                        $query->where('functionalarea.isShowOnHome', '=', '0');
                    }else{
                        if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                            $query->where('functionalarea.isShowOnHome', '=', Input::get('isShowOnHome'));
                        }
                    }

                    if (!empty(Input::get('functionalArea'))) {
                        $query->where('functionalarea.name', 'LIKE', '%' . Input::get('functionalArea') . '%');
                    }

                    if (!empty($request->get('searchByEmployeeId'))) {
                        $query->where('functionalarea.employee_id', '=', Input::get('searchByEmployeeId'));
                    }

                    $functionalarea = $query->paginate(15, array('functionalarea.id', 'functionalarea.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','functionalarea.updated_at','functionalarea.isShowOnTop','functionalarea.isShowOnHome'));

                    $tablename = 'functionalarea';
                    return view('administrator/functionalarea.index', compact('functionalarea','tablename'))
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
                                    ->where('alltableinformations.name', '=', 'FunctionalArea')
                                    ->where('userprivileges.create', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $tablename = 'functionalarea';
                    return view('employee/functionalarea.create', compact('tablename'));
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
                //FunctionalArea::create($request->all());

                $functionalarea = New FunctionalArea();
                $functionalarea->name = Input::get('name');
                $functionalarea->employee_id = Auth::id();
                $functionalarea->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('FunctionalArea','functionalarea',$functionalarea->id, $request->all(), 'functionalarea');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($functionalarea->id, $request->all());
                Session::flash('flash_message', 'FunctionalArea added!');
                return redirect('employee/functionalarea');
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
                                    ->where('alltableinformations.name', '=', 'FunctionalArea')
                                    ->where('userprivileges.show', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                  //  $functionalarea = FunctionalArea::findOrFail($id);
                    $functionalarea = FunctionalArea::orderBy('id', 'DESC')
                            ->leftJoin('users as eID','functionalarea.employee_id', '=','eID.id')
                            ->select('functionalarea.id', 'functionalarea.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','functionalarea.updated_at')
                            ->findOrFail($id);

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                            ->where('seo_contents.functionalAreaId','=', $id)
                            ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','functionalAreaId')
                            ->first();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('FunctionalArea','functionalarea',$id);
                    $tablename = 'functionalarea';

                    return view('employee/functionalarea.show', compact('functionalarea','seocontent','newUpdatedFields','tablename'));
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
                                    ->where('alltableinformations.name', '=', 'FunctionalArea')
                                    ->where('userprivileges.edit', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $functionalarea = FunctionalArea::findOrFail($id);

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->where('seo_contents.functionalAreaId','=', $id)
                            ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                            ->get();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('FunctionalArea','functionalarea',$id);
                    $tablename = 'functionalarea';
                              
                    return view('employee/functionalarea.edit', compact('functionalarea','seocontent','newUpdatedFields','tablename'));
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
                /*$functionalarea = FunctionalArea::findOrFail($id);
                $functionalarea->update($request->all());*/

                $functionalarea = FunctionalArea::findOrFail($id);
                $functionalarea->name = Input::get('name');
                $functionalarea->employee_id = Auth::id();
                $functionalarea->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('FunctionalArea','functionalarea',$functionalarea->id, $request->all(), 'functionalarea');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($functionalarea->id, $request->all());
                Session::flash('flash_message', 'FunctionalArea updated!');
                return redirect('employee/functionalarea');
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
                                    ->where('alltableinformations.name', '=', 'FunctionalArea')
                                    ->where('userprivileges.delete', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    DB::table('seo_contents')
                        ->where('seo_contents.functionalAreaId', '=', $id)
                        ->delete();
                        
                    FunctionalArea::destroy($id);
                    Session::flash('flash_message', 'FunctionalArea deleted!');
                    return redirect('employee/functionalarea');
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
    public function functionalAreaEmployeeSearch(Request $request)
    {
        $search0 = 'functionalarea.id';
       
       
        if( $request->functionalArea != null ){
            $search1 = "AND `functionalarea`.`name` LIKE  '%".$request->functionalArea."%'";
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
                
        $functionalAreaSearchDataObj = DB::select( DB::raw("SELECT functionalarea.id as functionalareaId, functionalarea.name ,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,functionalarea.updated_at FROM  `functionalarea`
                        LEFT JOIN `users` as `eID` ON `functionalarea`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        ORDER BY functionalarea.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $functionalAreaSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(functionalarea.id) as totalCount ,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname FROM  `functionalarea` 
                        LEFT JOIN `users` as `eID` ON `functionalarea`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        ORDER BY functionalarea.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($functionalAreaSearchDataObj1)){
            $numRecords = $functionalAreaSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'functionalAreaSearchDataObj' => $functionalAreaSearchDataObj,
                    'functionalAreaSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $functionalAreaSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'functionalAreaSearchDataObj' => $functionalAreaSearchDataObj,
                    'functionalAreaSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $functionalAreaSearchDataObj1,
                );
        }

        if( !empty($functionalAreaSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allFunctionalAreaEmployeeSearch(Request $request){

         $functionalarea = FunctionalArea::orderBy('functionalarea.id', 'DESC')
                        ->leftJoin('users as eID','functionalarea.employee_id', '=','eID.id')
                        ->select('functionalarea.id as functionalareaId', 'functionalarea.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','functionalarea.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($functionalarea);
    }

    public function deleteSearchFunctionalArea(Request $request, $id)
    {   
        FunctionalArea::destroy($id);
        return Redirect::back();
    }

}
