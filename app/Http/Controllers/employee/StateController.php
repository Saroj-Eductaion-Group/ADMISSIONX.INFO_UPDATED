<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\State;
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
use App\Models\Country as Country;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class StateController extends Controller
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
                                ->where('alltableinformations.name', '=', 'State')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                  //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'State')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                                   
                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                $query = State::orderBy('id', 'DESC')
                    ->leftJoin('country', 'state.country_id', '=', 'country.id')
                    ->leftJoin('users as eID','state.employee_id', '=','eID.id');

                $isShowOnTop = Input::get('isShowOnTop');
                if ($isShowOnTop == '0') {
                    $query->where('state.isShowOnTop', '=', '0');
                }else{
                    if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                        $query->where('state.isShowOnTop', '=', Input::get('isShowOnTop'));
                    }
                }

                $isShowOnHome = Input::get('isShowOnHome');
                if ($isShowOnHome == '0') {
                    $query->where('state.isShowOnHome', '=', '0');
                }else{
                    if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                        $query->where('state.isShowOnHome', '=', Input::get('isShowOnHome'));
                    }
                }

                if (!empty(Input::get('stateName'))) {
                    $query->where('state.name', 'LIKE', '%' . Input::get('stateName') . '%');
                }

                if (!empty(Input::get('countryName'))) {
                    $query->where('country.name', 'LIKE', '%' . Input::get('countryName') . '%');
                }

                if (!empty($request->get('searchByEmployeeId'))) {
                    $query->where('state.employee_id', '=', Input::get('searchByEmployeeId'));
                }

                $state = $query->paginate(15, array('state.id', 'state.name', 'country.name as countryName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','state.updated_at','state.isShowOnTop','state.isShowOnHome'));

                $tablename = 'state';
                $countryObj = Country::all();
                return view('administrator/state.index', compact('state','tablename'))
                    ->with('countryObj', $countryObj)
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
                                ->where('alltableinformations.name', '=', 'State')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $countryObj = Country::all();
                    $tablename = 'state';
                    return view('employee/state.create', compact('tablename'))
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
            
            $stateObj = new State;

            $stateObj->name = Input::get('name');
            $stateObj->country_id = Input::get('country_id');
            $stateObj->employee_id = Auth::id();
            $stateObj->save();

            $updateNewFields = $this->fetchDataServiceController->updateNewFields('State','state',$stateObj->id, $request->all(), 'state');

            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($stateObj->id, $request->all());

            Session::flash('flash_message', 'State added!');
            return redirect('employee/state');
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
                            ->where('alltableinformations.name', '=', 'State')
                            ->where('userprivileges.show', '=', '1')
                            ->count()
                            ;

            if( $validateUrlUsers >= '1' ){
                $state = State::orderBy('id', 'DESC')
                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                        ->leftJoin('users as eID','state.employee_id', '=','eID.id')
                        ->select('state.id', 'state.name', 'country.name as countryName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','state.updated_at')
                        ->findOrFail($id);

                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                            ->where('seo_contents.stateId','=', $id)
                            ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','stateId')
                            ->first();

                $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('State','state',$id);
                $tablename = 'state';
                return view('employee/state.show', compact('state','seocontent','newUpdatedFields','tablename'));
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
                                ->where('alltableinformations.name', '=', 'State')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $state = State::findOrFail($id);
                    $countryObj = Country::all();

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                                ->where('seo_contents.stateId','=', $id)
                                ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                                ->get();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('State','state',$id);
                    $tablename = 'state';
                    return view('employee/state.edit', compact('state','seocontent','newUpdatedFields','tablename'))
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
            /*$state = State::findOrFail($id);
            $state->update($request->all());*/

            $stateObj = State::findOrFail($id);

            $stateObj->name = Input::get('name');
            $stateObj->country_id = Input::get('country_id');
            $stateObj->employee_id = Auth::id();           
            $stateObj->save();

            $updateNewFields = $this->fetchDataServiceController->updateNewFields('State','state',$stateObj->id, $request->all(), 'state');

            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($stateObj->id, $request->all());

            Session::flash('flash_message', 'State updated!');
            return redirect('employee/state');
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
                            ->where('alltableinformations.name', '=', 'State')
                            ->where('userprivileges.delete', '=', '1')
                            ->count()
                            ;

            if( $validateUrlUsers >= '1' ){
                DB::table('seo_contents')
                        ->where('seo_contents.stateId', '=', $id)
                        ->delete();
                        
                State::destroy($id);
                Session::flash('flash_message', 'State deleted!');
                return redirect('employee/state');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    /*public function destroy($id)
    {   
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            State::destroy($id);
            Session::flash('flash_message', 'State deleted!');
            return redirect('administrator/state');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    /*public function destroy($id)
    {   
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            State::destroy($id);
            Session::flash('flash_message', 'State deleted!');
            return redirect('administrator/state');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }
*/

    public function stateEmployeeSearch(Request $request)
    {
        $search0 = 'state.id';
      
        if( $request->stateName != '' ){
            $search1 = "AND `state`.`name` LIKE  '%".$request->stateName."%'";
        }else{
            $search1 =  '';
        }

        if( $request->countryName != null ){
            $search2 = "AND `country`.`name` =  '".$request->countryName."'";
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
                
        $stateSearchDataObj = DB::select( DB::raw("SELECT state.id as stateId, state.name, country.name as countryName,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,state.updated_at FROM  `state`
                        LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                        LEFT JOIN `users` as `eID` ON `state`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY state.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
        
       //  print_r($stateSearchDataObj);die;
        $stateSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(state.id) as totalCount FROM  `state` 
                        LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                        LEFT JOIN `users` as `eID` ON `state`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY state.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($stateSearchDataObj1)){
            $numRecords = $stateSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'stateSearchDataObj' => $stateSearchDataObj,
                    'stateSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $stateSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'stateSearchDataObj' => $stateSearchDataObj,
                    'stateSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $stateSearchDataObj1,
                );
        }

        if( !empty($stateSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allStateEmployeeSearch(Request $request){

        $state = State::orderBy('state.id', 'DESC')
                        ->leftJoin('country', 'state.country_id', '=', 'country.id')
                        ->leftJoin('users as eID','state.employee_id', '=','eID.id')
                        ->select('state.id as stateId', 'state.name', 'country.name as countryName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','state.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($state);
    }

}
