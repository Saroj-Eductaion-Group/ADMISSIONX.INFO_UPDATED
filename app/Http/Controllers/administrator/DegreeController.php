<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Degree;
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
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class DegreeController extends Controller
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
                $query =  Degree::orderBy('id', 'DESC')
                            ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                            ->leftJoin('users as eID','degree.employee_id', '=','eID.id');

                $isShowOnTop = Input::get('isShowOnTop');
                if ($isShowOnTop == '0') {
                    $query->where('degree.isShowOnTop', '=', '0');
                }else{
                    if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                        $query->where('degree.isShowOnTop', '=', Input::get('isShowOnTop'));
                    }
                }

                $isShowOnHome = Input::get('isShowOnHome');
                if ($isShowOnHome == '0') {
                    $query->where('degree.isShowOnHome', '=', '0');
                }else{
                    if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                        $query->where('degree.isShowOnHome', '=', Input::get('isShowOnHome'));
                    }
                }

                if (!empty(Input::get('degreeName'))) {
                    $query->where('degree.name', 'LIKE', '%' . Input::get('degreeName') . '%');
                }

                if (!empty($request->get('functionalAreaName'))) {
                    $query->where('functionalarea.id', '=', Input::get('functionalAreaName'));
                }

                if (!empty($request->get('searchByEmployeeId'))) {
                    $query->where('degree.employee_id', '=', Input::get('searchByEmployeeId'));
                }
                
                $degree = $query->paginate(15, array('degree.id', 'degree.name', 'functionalarea.name as functionalareaName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','degree.updated_at','degree.isShowOnTop','degree.isShowOnHome'));

                $tablename = 'degree';
                $functionalAreaObj = FunctionalArea::all();

                return view('administrator/degree.index', compact('degree','tablename'))
                ->with('functionalAreaObj', $functionalAreaObj);
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
                $functionalAreaObj = FunctionalArea::all();
                $tablename = 'degree';
                return view('administrator/degree.create',  compact('tablename'))
                ->with('functionalAreaObj',$functionalAreaObj);
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

                $degreeObj = new Degree;

                $degreeObj->name = Input::get('name');
                $degreeObj->functionalarea_id = Input::get('functionalarea_id');
                $degreeObj->employee_id = Auth::id();           
                $degreeObj->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('Degree','degree',$degreeObj->id, $request->all(), 'degree');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($degreeObj->id, $request->all());

                Session::flash('flash_message', 'Degree added!');
                return redirect('administrator/degree');
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

                $degree = Degree::orderBy('id', 'DESC')
                                ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                                ->leftJoin('users as eID','degree.employee_id', '=','eID.id')
                                ->select('degree.id', 'degree.name', 'functionalarea.name as functionalareaName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','degree.updated_at')
                                ->findOrFail($id);

                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                            ->where('seo_contents.degreeId','=', $id)
                            ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','degreeId')
                            ->first();

                $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('Degree','degree',$id);
                $tablename = 'degree';

                return view('administrator/degree.show', compact('degree','seocontent','newUpdatedFields','tablename'));
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
                $degree = Degree::findOrFail($id);
                $functionalAreaObj = FunctionalArea::all();
                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->where('seo_contents.degreeId','=', $id)
                            ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                            ->get();

                $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('Degree','degree',$id);
                $tablename = 'degree';
                return view('administrator/degree.edit', compact('degree','seocontent','newUpdatedFields','tablename'))
                ->with('functionalAreaObj',$functionalAreaObj);
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
               /* $degree = Degree::findOrFail($id);
                $degree->update($request->all());*/

                $degreeObj = Degree::findOrFail($id);

                $degreeObj->name = Input::get('name');
                $degreeObj->functionalarea_id = Input::get('functionalarea_id');
                $degreeObj->employee_id = Auth::id();             
                $degreeObj->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('Degree','degree',$degreeObj->id, $request->all(), 'degree');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($degreeObj->id, $request->all());

                Session::flash('flash_message', 'Degree updated!');
                return redirect('administrator/degree');
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
                    ->where('seo_contents.degreeId', '=', $id)
                    ->delete();
                    
            Degree::destroy($id);
            Session::flash('flash_message', 'Degree deleted!');
            return redirect('administrator/degree');
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
    public function degreeSearch(Request $request)
    {
        $search0 = 'degree.id';
      
        if( $request->degreeName != '' ){
            $search1 = "AND `degree`.`name` LIKE  '%".$request->degreeName."%'";
        }else{
            $search1 =  '';
        }

        if( $request->functionalAreaName != '' ){
            //$search2 = "AND `functionalarea`.`id` LIKE  '%".$request->functionalAreaName."%'";
            $search2 = "AND `functionalarea`.`id` = '".$request->functionalAreaName."'";
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
                
        $degreeSearchDataObj = DB::select( DB::raw("SELECT degree.id as degreeId, degree.name, functionalarea.name as functionalareaName,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,degree.updated_at FROM  `degree`
                        LEFT JOIN `functionalarea` ON `degree`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `users` as `eID` ON `degree`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY degree.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
        
       //  print_r($degreeSearchDataObj);die;
        $degreeSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(degree.id) as totalCount FROM  `degree` 
                        LEFT JOIN `functionalarea` ON `degree`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `users` as `eID` ON `degree`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY degree.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($degreeSearchDataObj1)){
            $numRecords = $degreeSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'degreeSearchDataObj' => $degreeSearchDataObj,
                    'degreeSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $degreeSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'degreeSearchDataObj' => $degreeSearchDataObj,
                    'degreeSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $degreeSearchDataObj1,
                );
        }

        if( !empty($degreeSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allDegreeSearch(Request $request){

            $degree = Degree::orderBy('degree.id', 'DESC')
                        ->leftJoin('functionalarea', 'degree.functionalarea_id', '=', 'functionalarea.id')
                        ->leftJoin('users as eID','degree.employee_id', '=','eID.id')
                        ->select('degree.id as degreeId', 'degree.name', 'functionalarea.name as functionalareaName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','degree.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($degree);
    }

    public function deleteSearchDegree(Request $request, $id)
    {   
        Degree::destroy($id);
        return Redirect::back();
    }

}
