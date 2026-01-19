<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\City;
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
use App\Models\State as State;
use App\Models\Country as Country;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class CityController extends Controller
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
                $query = City::orderBy('id', 'DESC')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country','state.country_id','=','country.id')
                            ->leftJoin('users as eID','city.employee_id', '=','eID.id');

                $isShowOnTop = Input::get('isShowOnTop');
                if ($isShowOnTop == '0') {
                    $query->where('city.isShowOnTop', '=', '0');
                }else{
                    if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                        $query->where('city.isShowOnTop', '=', Input::get('isShowOnTop'));
                    }
                }

                $isShowOnHome = Input::get('isShowOnHome');
                if ($isShowOnHome == '0') {
                    $query->where('city.isShowOnHome', '=', '0');
                }else{
                    if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                        $query->where('city.isShowOnHome', '=', Input::get('isShowOnHome'));
                    }
                }

                if (!empty(Input::get('cityName'))) {
                    $query->where('city.name', 'LIKE', '%' . Input::get('cityName') . '%');
                }
                if (!empty($request->get('stateName'))) {
                    $query->where('state.id', '=', Input::get('stateName'));
                }

                if (!empty($request->get('country_id'))) {
                    $query->where('country.id', '=', Input::get('country_id'));

                    $stateObj = DB::table('state')
                                ->where('state.country_id','=',Input::get('country_id'))    
                                ->orderBy('state.name', 'ASC')
                                ->get()
                                ;
                }else{
                    $stateObj = DB::table('state')
                                ->where('state.country_id','=', 99)    
                                ->orderBy('state.name', 'ASC')
                                ->get()
                                ;
                }

                if (!empty($request->get('searchByEmployeeId'))) {
                    $query->where('city.employee_id', '=', Input::get('searchByEmployeeId'));
                }

                $city = $query->paginate(15, array('city.id', 'city.name', 'state.name as stateName','cityStatus','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','country.name as countryName','city.updated_at','city.isShowOnTop','city.isShowOnHome'));

                $tablename = 'city';

                $countryObj = Country::all();
                return view('administrator/city.index', compact('city','tablename'))
                ->with('stateObj', $stateObj)
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
                $stateObj = State::all();
                $countryObj = Country::all();

                $tablename = 'city';
               
                return view('administrator/city.create', compact('tablename'))
                ->with('stateObj', $stateObj)
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
                
                $cityObj = new City;

                $cityObj->name = Input::get('name');
                $cityObj->state_id = Input::get('state_id');

                if (Input::get('cityStatus')) {
                    $cityObj->cityStatus = Input::get('cityStatus');
                }else{
                    $cityObj->cityStatus = '0';
                }

                $cityObj->employee_id = Auth::id();           
                $cityObj->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('City','city',$cityObj->id, $request->all(), 'city');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($cityObj->id, $request->all());

                Session::flash('flash_message', 'City added!');
                return redirect('administrator/city');
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
               
                 $city = City::orderBy('id', 'DESC')
                                ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                ->leftJoin('country','state.country_id','=','country.id')
                                ->leftJoin('users as eID','city.employee_id', '=','eID.id')
                                ->select('city.id', 'city.name', 'state.name as stateName','cityStatus','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','country.name as countryName','city.updated_at')
                                ->findOrFail($id);

                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                            ->where('seo_contents.cityId','=', $id)
                            ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','cityId')
                            ->first();

                $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('City','city',$id);
                $tablename = 'city';

                return view('administrator/city.show', compact('city','seocontent','newUpdatedFields','tablename'));
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
                $city = City::findOrFail($id);
                $stateObj = State::all();
                $countryObj = Country::all();

                $cityDataObj = DB::table('city')
                            ->leftJoin('state','city.state_id','=','state.id')
                            ->leftJoin('country','state.country_id','=','country.id')
                            ->select('city.id','city.name','state.id as stateId','state.name as stateName','country.id as countryId','country.name as countryName')
                            ->where('city.id', '=', $id)
                            ->take(1)
                            ->orderBy('city.id', 'DESC' )
                            ->get()
                            ;

                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->where('seo_contents.cityId','=', $id)
                            ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                            ->get();

                $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('City','city',$id);

                $tablename = 'city';
                
                return view('administrator/city.edit', compact('city','seocontent','newUpdatedFields','tablename')) 
                ->with('stateObj', $stateObj)
                ->with('countryObj', $countryObj)
                ->with('cityDataObj', $cityDataObj);
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
                /*$city = City::findOrFail($id);
                $city->update($request->all());*/

                $cityObj = City::findOrFail($id);

                $cityObj->name = Input::get('name');
                $cityObj->state_id = Input::get('state_id');
                $cityObj->employee_id = Auth::id(); 

                if (Input::get('cityStatus')) {
                    $cityObj->cityStatus = Input::get('cityStatus');
                }else{
                    $cityObj->cityStatus = '0';
                }            
                $cityObj->save();
                $updateNewFields = $this->fetchDataServiceController->updateNewFields('City','city',$cityObj->id, $request->all(), 'city');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($cityObj->id, $request->all());

                Session::flash('flash_message', 'City updated!');
                return redirect('administrator/city');
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
            ->where('seo_contents.cityId', '=', $id)
            ->delete();
            
            City::destroy($id);
            Session::flash('flash_message', 'City deleted!');
            return redirect('administrator/city');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function citySearch(Request $request)
    {
        $search0 = 'city.id';
      
        if( $request->cityName != '' ){
            $search1 = "AND `city`.`name` LIKE  '%".$request->cityName."%'";
        }else{
            $search1 =  '';
        }

        if( $request->stateName != null ){
            $search2 = "AND `state`.`id` =  '".$request->stateName."'";
        }else{
            $search2 =  '';
        }

        if( $request->country_id != null ){
            $search3 = "AND `country`.`id` =  '".$request->country_id."'";
        }else{
            $search3 =  '';
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
                
        $citySearchDataObj = DB::select( DB::raw("SELECT city.id as cityID, city.name, city.cityStatus, state.name as stateName,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname ,country.name as countryName, city.updated_at FROM  `city`
                        LEFT JOIN `state` ON `city`.`state_id` = `state`.`id`
                        LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                        LEFT JOIN `users` as `eID` ON `city`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        ORDER BY city.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
        
       //  print_r($citySearchDataObj);die;
        $citySearchDataObj1 = DB::select( DB::raw("SELECT COUNT(city.id) as totalCount FROM  `city` 
                        LEFT JOIN `state` ON `city`.`state_id` = `state`.`id`
                        LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                        LEFT JOIN `users` as `eID` ON `city`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        ORDER BY city.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($citySearchDataObj1)){
            $numRecords = $citySearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'citySearchDataObj' => $citySearchDataObj,
                    'citySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $citySearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'citySearchDataObj' => $citySearchDataObj,
                    'citySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $citySearchDataObj1,
                );
        }

        if( !empty($citySearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allCitySearch(Request $request){

        $city = City::orderBy('city.id', 'DESC')
                            ->leftJoin('state', 'city.state_id', '=', 'state.id')
                            ->leftJoin('country','state.country_id','=','country.id')
                            ->leftJoin('users as eID','city.employee_id', '=','eID.id')
                            ->select('city.id as cityID', 'city.name', 'state.name as stateName','city.cityStatus','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','country.name as countryName','city.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($city);
    }
}
