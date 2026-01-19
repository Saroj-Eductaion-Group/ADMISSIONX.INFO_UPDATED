<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\University;
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


class UniversityController extends Controller
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            //$university = University::orderBy('id','DESC')->paginate(15);
            $query = University::orderBy('university.id', 'DESC')
                        ->leftJoin('users as eID','university.employee_id', '=','eID.id');

            $isShowOnTop = Input::get('isShowOnTop');
            if ($isShowOnTop == '0') {
                $query->where('university.isShowOnTop', '=', '0');
            }else{
                if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                    $query->where('university.isShowOnTop', '=', Input::get('isShowOnTop'));
                }
            }

            $isShowOnHome = Input::get('isShowOnHome');
            if ($isShowOnHome == '0') {
                $query->where('university.isShowOnHome', '=', '0');
            }else{
                if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                    $query->where('university.isShowOnHome', '=', Input::get('isShowOnHome'));
                }
            }

            if (!empty(Input::get('universityName'))) {
                $query->where('university.name', 'LIKE', '%' . Input::get('universityName') . '%');
            }

            if (!empty($request->get('searchByEmployeeId'))) {
                $query->where('university.employee_id', '=', Input::get('searchByEmployeeId'));
            }

            $university = $query->paginate(15, array('university.id', 'university.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','university.updated_at','university.isShowOnTop','university.isShowOnHome'));

            $tablename = 'university';
            return view('administrator/university.index', compact('university','tablename'));
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $tablename = 'university';
            return view('administrator/university.create', compact('tablename'));
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){

                 //CHECK DUPLICATE University
                if( !empty(Input::get('name')) ){
                    $universityNameCheck = DB::table('university')
                                        ->where('name', '=', Input::get('name'))
                                        ->count()
                                        ;
                    
                    if( $universityNameCheck == '0' ){
                        //SAVE INTO DB
                        try{
                            //University::create($request->all());
                            $university = New University();
                            $university->name = Input::get('name');
                            $university->employee_id = Auth::id();
                            $university->save();

                            $updateNewFields = $this->fetchDataServiceController->updateNewFields('University','university',$university->id, $request->all(), 'university');

                            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($university->id, $request->all());

                            Session::flash('flash_message', 'University added!');
                            return redirect('administrator/university');
                        }
                        catch (QueryException $e){
                        }
                    }else{
                        Session::flash('universityName', 'Duplicate university name found, kindly use another university name'); 
                        return redirect('administrator/university/create');
                    }
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            //$university = University::findOrFail($id);
            $university = University::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','university.employee_id', '=','eID.id')
                        ->select('university.id', 'university.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','university.updated_at')
                        ->findOrFail($id);

            $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.universityId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','universityId')
                        ->first();

            $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('University','university',$id);
            $tablename = 'university';

            return view('administrator/university.show', compact('university','seocontent','newUpdatedFields','tablename'));
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $university = University::findOrFail($id);

            $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->where('seo_contents.universityId','=', $id)
                        ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                        ->get();

            $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('University','university',$id);
            $tablename = 'university';

            return view('administrator/university.edit', compact('university','seocontent','newUpdatedFields','tablename'));
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                if( !empty(Input::get('name')) ){
                    $universityNameCheck = DB::table('university')
                                        ->where('name', '=', Input::get('name'))
                                        ->where('id', '!=', $id)
                                        ->count()
                                        ;
                    
                    if( $universityNameCheck == '0' ){
                        //SAVE INTO DB
                        try{
                            /*$university = University::findOrFail($id);
                            $university->update($request->all());*/

                            $university = University::findOrFail($id);
                            $university->name = Input::get('name');
                            $university->employee_id = Auth::id();
                            $university->save();

                            $updateNewFields = $this->fetchDataServiceController->updateNewFields('University','university',$university->id, $request->all(), 'university');

                            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());

                            Session::flash('flash_message', 'University updated!');
                            return redirect('administrator/university');
                        }
                        catch (QueryException $e){
                        }
                    }else{
                        Session::flash('universityName', 'Duplicate university name found, kindly use another university name'); 
                        return redirect('administrator/university/'.$id.'/edit');
                    }
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
    public function destroy($id)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            DB::table('seo_contents')
                    ->where('seo_contents.universityId', '=', $id)
                    ->delete();
                    
            University::destroy($id);
            Session::flash('flash_message', 'University deleted!');
            return redirect('administrator/university');
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
    public function universitySearch(Request $request)
    {
        $search0 = 'university.id';
       
       
        if( $request->universityName != null ){
            $search1 = "AND `university`.`name` LIKE  '%".$request->universityName."%'";
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
                
        $universitySearchDataObj = DB::select( DB::raw("SELECT university.id as universityId, university.name, eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,university.updated_at FROM  `university`
                        LEFT JOIN `users` as `eID` ON `university`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        ORDER BY university.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $universitySearchDataObj1 = DB::select( DB::raw("SELECT COUNT(university.id) as totalCount FROM  `university` 
                        LEFT JOIN `users` as `eID` ON `university`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        ORDER BY university.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($universitySearchDataObj1)){
            $numRecords = $universitySearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'universitySearchDataObj' => $universitySearchDataObj,
                    'universitySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $universitySearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'universitySearchDataObj' => $universitySearchDataObj,
                    'universitySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $universitySearchDataObj1,
                );
        }

        if( !empty($universitySearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allUniversitySearch(Request $request){

         $university = University::orderBy('university.id', 'DESC')
                        ->leftJoin('users as eID','university.employee_id', '=','eID.id')
                        ->select('university.id as universityId', 'university.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','university.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($university);
    }

    public function deleteSearchUniversity(Request $request, $id)
    {   
        University::destroy($id);
        return Redirect::back();
    }

}
