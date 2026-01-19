<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Country;
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

class CountryController extends Controller
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
                                    ->where('alltableinformations.name', '=', 'Country')
                                    ->where('userprivileges.index', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Country')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                    //$country = Country::paginate(15);
                    $query = Country::orderBy('country.id', 'DESC')
                            ->leftJoin('users as eID','country.employee_id', '=','eID.id');

                    $isShowOnTop = Input::get('isShowOnTop');
                    if ($isShowOnTop == '0') {
                        $query->where('country.isShowOnTop', '=', '0');
                    }else{
                        if ($request->has('isShowOnTop') && !empty($request->get('isShowOnTop'))) {
                            $query->where('country.isShowOnTop', '=', Input::get('isShowOnTop'));
                        }
                    }

                    $isShowOnHome = Input::get('isShowOnHome');
                    if ($isShowOnHome == '0') {
                        $query->where('country.isShowOnHome', '=', '0');
                    }else{
                        if ($request->has('isShowOnHome') && !empty($request->get('isShowOnHome'))) {
                            $query->where('country.isShowOnHome', '=', Input::get('isShowOnHome'));
                        }
                    }

                    if (!empty(Input::get('countryName'))) {
                        $query->where('country.name', 'LIKE', '%' . Input::get('countryName') . '%');
                    }

                    if (!empty($request->get('searchByEmployeeId'))) {
                        $query->where('country.employee_id', '=', Input::get('searchByEmployeeId'));
                    }
                    
                    $country = $query->paginate(15, array('country.id', 'country.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','country.updated_at','country.isShowOnTop','country.isShowOnHome','country.logoimage'));

                    $tablename = 'country';
                    return view('administrator/country.index', compact('country','tablename'))
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
                                    ->where('alltableinformations.name', '=', 'Country')
                                    ->where('userprivileges.create', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $tablename = 'country';
                    return view('employee/country.create',compact('tablename'));
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
                //Country::create($request->all());

                $country = New Country();
                $country->name = Input::get('name');
                $country->employee_id = Auth::id();
                $country->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('Country','country',$country->id, $request->all(), 'country');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($country->id, $request->all());

                Session::flash('flash_message', 'Country added!');
                return redirect('employee/country');
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
                                    ->where('alltableinformations.name', '=', 'Country')
                                    ->where('userprivileges.show', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                   // $country = Country::findOrFail($id);
                    $country = Country::orderBy('id', 'DESC')
                            ->leftJoin('users as eID','country.employee_id', '=','eID.id')
                            ->select('country.id', 'country.name','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','country.updated_at')
                            ->findOrFail($id);

                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                            ->where('seo_contents.countryId','=', $id)
                            ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at','countryId')
                            ->first();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('Country','country',$id);
                    $tablename = 'country';
                    return view('employee/country.show', compact('country','seocontent','newUpdatedFields','tablename'));
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
                                    ->where('alltableinformations.name', '=', 'Country')
                                    ->where('userprivileges.edit', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    $country = Country::findOrFail($id);
                    $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                            ->where('seo_contents.countryId','=', $id)
                            ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId')
                            ->get();

                    $newUpdatedFields = $this->fetchDataServiceController->fetchNewUpdatedFields('Country','country',$id);
                    $tablename = 'country';
                    return view('employee/country.edit', compact('country','seocontent','newUpdatedFields','tablename'));
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
                /*$country = Country::findOrFail($id);
                $country->update($request->all());
    */
                $country = Country::findOrFail($id);
                $country->name = Input::get('name');
                $country->employee_id = Auth::id();
                $country->save();

                $updateNewFields = $this->fetchDataServiceController->updateNewFields('Country','country',$country->id, $request->all(), 'country');

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($country->id, $request->all());

                Session::flash('flash_message', 'Country updated!');
                return redirect('employee/country');
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
                                    ->where('alltableinformations.name', '=', 'Country')
                                    ->where('userprivileges.delete', '=', '1')
                                    ->count()
                                    ;

                if( $validateUrlUsers >= '1' ){
                    DB::table('seo_contents')
                        ->where('seo_contents.countryId', '=', $id)
                        ->delete();
                    
                    Country::destroy($id);
                    Session::flash('flash_message', 'Country deleted!');
                    return redirect('employee/country');
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

}
