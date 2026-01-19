<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeMaster;
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
use Config;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\EducationLevel as EducationLevel;
use App\Models\Degree as Degree;
use App\Models\CourseType as CourseType;
use App\Models\Course as Course;
use App\Models\AddressType as AddressType;
use App\Models\City as City;
use App\Models\State as State;
use App\Models\Country as Country;
use App\Models\Faculty;
use App\Http\Controllers\website\WebsiteLogController;

class CollegeMasterController extends Controller
{

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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $collegemaster = CollegeMaster::orderBy('id', 'DESC')
                        ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                        ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                        ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                        ->leftjoin('coursetype', 'collegemaster.coursetype_id', '=', 'coursetype.id')
                        ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','collegemaster.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->Paginate(20, array('collegemaster.id','collegemaster.twelvemarks', 'collegemaster.others', 'collegemaster.fees', 'collegemaster.seats','collegemaster.seatsallocatedtobya','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName','collegeprofile.id as collegeprofileID','collegemaster.courseduration','collegemaster.description as courseDescription','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegemaster.updated_at'));
            $functionalAreaObj = FunctionalArea::all();
            $educationLevelObj = EducationLevel::all();
            $degreeObj = Degree::all();
            $courseTypeObj = CourseType::all();
            $courseObj = Course::all();

            $collegeProfileObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->where('users.userrole_id', '=', '2')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id','users.firstname')
                                ->get()
                                ;
            
            $cityNameObj = DB::table('city')
                    ->where('city.cityStatus','=','1')    
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;

            $stateNameObj = DB::table('state')
                    ->orderBy('state.name', 'ASC')
                    ->get()
                    ;
            $addressTypeObj = AddressType::all();
            $countryObj = Country::all();
            return view('administrator/collegemaster.index', compact('collegemaster'))
            ->with('functionalAreaObj',$functionalAreaObj)
                        ->with('educationLevelObj',$educationLevelObj)
                        ->with('degreeObj',$degreeObj)
                        ->with('courseTypeObj',$courseTypeObj)
                        ->with('courseObj',$courseObj)
                        ->with('collegeProfileObj',$collegeProfileObj)
                        ->with('cityNameObj', $cityNameObj)
                        ->with('addressTypeObj', $addressTypeObj)
                        ->with('countryObj', $countryObj)
                        ->with('stateNameObj', $stateNameObj);
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
            $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->join('collegeprofile', 'users.id','=','collegeprofile.users_id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get();
            //$functionalAreaObj = FunctionalArea::all();
            $functionalAreaObj = DB::table('functionalarea')
                    ->orderBy('functionalarea.name', 'ASC')
                    ->get()
                    ;
            //$educationLevelObj = EducationLevel::all();
            $educationLevelObj = DB::table('educationlevel')
                    ->orderBy('educationlevel.name', 'ASC')
                    ->get()
                    ;
            $degreeObj = Degree::all();
            //$courseTypeObj = CourseType::all();
            $courseTypeObj = DB::table('coursetype')
                    ->orderBy('coursetype.name', 'ASC')
                    ->get()
                    ;
            $courseObj = Course::all();
            return view('administrator/collegemaster.create')
                        ->with('usersObj',$usersObj)
                        ->with('functionalAreaObj',$functionalAreaObj)
                        ->with('educationLevelObj',$educationLevelObj)
                        ->with('degreeObj',$degreeObj)
                        ->with('courseTypeObj',$courseTypeObj)
                        ->with('courseObj',$courseObj);
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
            /*CollegeMaster::create($request->all());
            Session::flash('flash_message', 'CollegeMaster added!');*/
            $collegeMasterObj = new CollegeMaster;

            $collegeProfileId = Input::get('collegeprofile_id');

            $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($collegeProfileId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($collegeProfileId)
                                                );  
                                            })
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
            if( !empty($collegeProfileDataObj) ){
                $collegeMasterObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;

               /* if (Input::get('courseduration')) {
                    $collegeMasterObj->courseduration = Input::get('courseduration').' '.Input::get('courseduration1');
                }else{
                    $collegeMasterObj->courseduration = null;
                }*/
                $collegeMasterObj->courseduration = Input::get('courseduration').' '.Input::get('courseduration1');

                if (Input::get('educationlevel_id')) {
                    $collegeMasterObj->educationlevel_id = Input::get('educationlevel_id');
                }else{
                    $collegeMasterObj->educationlevel_id = null;
                }

                if (Input::get('functionalarea_id')) {
                    $collegeMasterObj->functionalarea_id = Input::get('functionalarea_id');
                }else{
                    $collegeMasterObj->functionalarea_id = null;
                }
               
                if (Input::get('degree_id')) {
                    $collegeMasterObj->degree_id = Input::get('degree_id');
                }else{
                    $collegeMasterObj->degree_id = null;
                }
                
                if (Input::get('coursetype_id')) {
                    $collegeMasterObj->coursetype_id = Input::get('coursetype_id');
                }else{
                    $collegeMasterObj->coursetype_id = null;
                }
                
                if (Input::get('course_id')) {
                   $collegeMasterObj->course_id = Input::get('course_id');
                }else{
                    $collegeMasterObj->course_id = null;
                }
                
                $collegeMasterObj->fees = Input::get('fees');
                $collegeMasterObj->seats = Input::get('seats');
                $collegeMasterObj->twelvemarks = Input::get('twelvemarks');
                $collegeMasterObj->others = Input::get('others');
                $collegeMasterObj->seatsallocatedtobya = Input::get('seatsallocatedtobya');
                $collegeMasterObj->description = Input::get('description');
                $collegeMasterObj->employee_id = Auth::id();     

                $collegeMasterObj->save();

                //GET CURRENT CREATED COLLEGE MASTER ID
                $getCurrentCollegeMaster = DB::table('collegemaster')
                                            ->where('collegemaster.collegeprofile_id', '=', $collegeProfileDataObj[0]->collegeProfileId)
                                            ->where('collegemaster.fees', '=', Input::get('fees'))
                                            ->where('collegemaster.seats', '=', Input::get('seats'))
                                            ->where('collegemaster.functionalarea_id', '=', Input::get('functionalarea_id'))
                                            ->where('collegemaster.degree_id', '=', Input::get('degree_id'))
                                            ->where('collegemaster.course_id', '=', Input::get('course_id'))
                                            ->select('collegemaster.id')
                                            ->orderBy('collegemaster.id', 'DESC')
                                            ->take(1)
                                            ->get()
                                            ;
                

                //CREATE ROWS IN FACULTY TABLE
                for ($counter=1; $counter <= 6; $counter++) { 
                    $facultyTableObj = new Faculty;
                    $facultyTableObj->suffix = Input::get('suffix_'.$counter);
                    $facultyTableObj->name = Input::get('faculty_'.$counter);
                    $facultyTableObj->description = Input::get('description_'.$counter);
                    $facultyTableObj->sortorder = $counter;
                    $facultyTableObj->collegemaster_id = $getCurrentCollegeMaster[0]->id;
                    $facultyTableObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
                    $facultyTableObj->employee_id = Auth::id(); 
                    $facultyTableObj->save();
                }
                //END

                return redirect('administrator/collegemaster');    
            }else{
                Session::flash('noCollegeProfileAvail', 'No College Profile Available');
                return redirect('administrator/collegemaster');    
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
           // $collegemaster = CollegeMaster::findOrFail($id);
             $collegemaster = CollegeMaster::orderBy('id', 'DESC')
                        ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                        ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                        ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                        ->leftjoin('coursetype', 'collegemaster.coursetype_id', '=', 'coursetype.id')
                        ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','collegemaster.employee_id', '=','eID.id')
                        ->select('collegemaster.id','collegemaster.twelvemarks', 'collegemaster.others', 'collegemaster.fees', 'collegemaster.seats','collegemaster.seatsallocatedtobya','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName','collegemaster.courseduration','collegemaster.description as courseDescription','collegeprofile.slug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegemaster.updated_at')
                        ->findOrFail($id);

            $getFacultyInfo = DB::table('faculty')
                                ->where('collegemaster_id', '=', $id)
                                ->select('id','name', 'description')
                                ->orderBy('id', 'ASC')
                                ->get()
                                ;

            $collegeID = $collegemaster->userID;
            $collegemasterId = $collegemaster->id;
            $slugUrl = $collegemaster->slug;
            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventCourseCollege(Config::get('systemsetting.COURSEVIEW').' by this User Id '.Auth::id().', College -'.$slugUrl.', Course Id '.$collegemasterId, $collegeID, $collegemasterId);

            

            return view('administrator/collegemaster.show', compact('collegemaster'))
                        ->with('getFacultyInfo', $getFacultyInfo)
            ;

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
            $collegemaster = CollegeMaster::findOrFail($id);
            $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->join('collegeprofile', 'users.id','=','collegeprofile.users_id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName')
                        ->where('users.userrole_id', '=', '2')
                        ->orderBy('users.id','ASC')
                        ->get();
           
             //$functionalAreaObj = FunctionalArea::all();
            $functionalAreaObj = DB::table('functionalarea')
                    ->orderBy('functionalarea.name', 'ASC')
                    ->get()
                    ;
            //$educationLevelObj = EducationLevel::all();
            $educationLevelObj = DB::table('educationlevel')
                    ->orderBy('educationlevel.name', 'ASC')
                    ->get()
                    ;
            $degreeObj = Degree::all();
            //$courseTypeObj = CourseType::all();
            $courseTypeObj = DB::table('coursetype')
                    ->orderBy('coursetype.name', 'ASC')
                    ->get()
                    ;
            $courseObj = Course::all();

            $collegeProfileObj = CollegeMaster::where('collegemaster.id', $collegemaster->id)
                                ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                ->join('users', 'collegeprofile.users_id','=','users.id')
                                ->join('userrole', 'users.userrole_id','=','userrole.id')
                                ->select('users.id','users.firstname', 'users.middlename', 'users.lastname', 'userrole.id as userRoleId','userrole.name as userRoleName','collegeprofile.slug' )
                                ->get()->first();

            $getFacultyInfo = DB::table('faculty')
                                ->where('collegemaster_id', '=', $id)
                                ->select('id','name', 'description')
                                ->orderBy('id', 'ASC')
                                ->get()
                                ;

            

            $collegeID = $collegeProfileObj->id;
            $collegemasterId = $collegemaster->id;
            $slugUrl = $collegeProfileObj->slug;
            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventCourseCollege(Config::get('systemsetting.COURSEVIEW').' by this User Id '.Auth::id().', College -'.$slugUrl.', Course Id '.$collegemasterId, $collegeID, $collegemasterId);

            return view('administrator/collegemaster.edit', compact('collegemaster'))
                        ->with('usersObj',$usersObj)
                        ->with('functionalAreaObj',$functionalAreaObj)
                        ->with('educationLevelObj',$educationLevelObj)
                        ->with('degreeObj',$degreeObj)
                        ->with('courseTypeObj',$courseTypeObj)
                        ->with('courseObj',$courseObj)
                        ->with('collegeProfileObj', $collegeProfileObj)
                        ->with('getFacultyInfo', $getFacultyInfo)
                        ;
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
           /* $collegemaster = CollegeMaster::findOrFail($id);
            $collegemaster->update($request->all());
            Session::flash('flash_message', 'CollegeMaster updated!');*/

            $collegeMasterObj = CollegeMaster::findOrFail($id);

            $collegeProfileId = Input::get('collegeprofile_id');

            $collegeProfileDataObj= DB::table('collegeprofile')
                                        ->join('users', function ($join) use ($collegeProfileId) {
                                            $join->on('collegeprofile.users_id', '=','users.id')
                                                ->where('collegeprofile.users_id', '=', DB::raw($collegeProfileId)
                                                );  
                                            })
                                        ->select('collegeprofile.id as collegeProfileId')
                                        ->take(1)
                                        ->get()
                                        ;

            if( !empty($collegeProfileDataObj) ){
                $collegeMasterObj->collegeprofile_id = $collegeProfileDataObj[0]->collegeProfileId;
            
                
                $collegeMasterObj->courseduration = Input::get('courseduration').' '.Input::get('courseduration1');
                
                if (Input::get('educationlevel_id')) {
                    $collegeMasterObj->educationlevel_id = Input::get('educationlevel_id');
                }else{
                    $collegeMasterObj->educationlevel_id = null;
                }

                if (Input::get('functionalarea_id')) {
                    $collegeMasterObj->functionalarea_id = Input::get('functionalarea_id');
                }else{
                    $collegeMasterObj->functionalarea_id = null;
                }
               
                if (Input::get('degree_id')) {
                    $collegeMasterObj->degree_id = Input::get('degree_id');
                }else{
                    $collegeMasterObj->degree_id = null;
                }
                
                if (Input::get('coursetype_id')) {
                    $collegeMasterObj->coursetype_id = Input::get('coursetype_id');
                }else{
                    $collegeMasterObj->coursetype_id = null;
                }
                
                if (Input::get('course_id')) {
                   $collegeMasterObj->course_id = Input::get('course_id');
                }else{
                    $collegeMasterObj->course_id = null;
                }

                $collegeMasterObj->fees = Input::get('fees');
                $collegeMasterObj->seats = Input::get('seats');
                $collegeMasterObj->twelvemarks = Input::get('twelvemarks');
                $collegeMasterObj->others = Input::get('others');
                $collegeMasterObj->seatsallocatedtobya = Input::get('seatsallocatedtobya');
                $collegeMasterObj->description = Input::get('description');
                $collegeMasterObj->employee_id = Auth::id(); 
                $collegeMasterObj->save();
                return redirect('administrator/collegemaster');
            }else{
                Session::flash('noCollegeProfileAvail', 'No College Profile Available');
                return redirect('administrator/collegemaster');
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
            
            //Get Faculty Id & Remove Faculty Info
            $getFacultyId = DB::table('faculty')
                            ->leftJoin('collegeprofile', 'faculty.collegeprofile_id', '=','collegeprofile.id')
                            ->where('faculty.collegemaster_id', '=', $id)
                            ->orderBy('faculty.id', 'DESC')
                            ->select('faculty.id')
                            ->get()
                            ;
            foreach ($getFacultyId as $key) {
                Faculty::destroy($key->id);    
            }


            CollegeMaster::destroy($id);
            Session::flash('flash_message', 'CollegeMaster deleted!');
            return redirect('administrator/collegemaster');
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
    public function searchCollegeMaster(Request $request)
    {
           
        $search0 = 'collegemaster.id';
        if( $request->collegeName != null ){
            $search1 = "AND `users`.`id` =  '".$request->collegeName."'";
        }else{
            $search1 =  '';
        }

        if( $request->functionalarea_id != '' ){
            $search2 = "AND `collegemaster`.`functionalarea_id` =  '".$request->functionalarea_id."'";
        }else{
            $search2 =  '';
        }

        if( $request->educationlevel_id != '' ){
            $search3 = "AND `collegemaster`.`educationlevel_id` =  '".$request->educationlevel_id."'";
        }else{
            $search3 =  '';
        }

        if( $request->degree_id != '' ){
            $search4 = "AND `collegemaster`.`degree_id` =  '".$request->degree_id."'";
        }else{
            $search4 =  '';
        }

        if( $request->coursetype_id != '' ){
            $search5 = "AND `collegemaster`.`coursetype_id` =  '".$request->coursetype_id."'";
        }else{
            $search5 =  '';
        }

        if( $request->course_id != '' ){
            $search6 = "AND `collegemaster`.`course_id` =  '".$request->course_id."'";
        }else{
            $search6 =  '';
        }

        if( $request->twelvemarks != '' ){
            $search7 = "AND `twelvemarks` LIKE  '%".$request->twelvemarks."%'";
        }else{
            $search7 =  '';
        }

        if( $request->otherMarks != '' ){
            $search8 = "AND `otherMarks` LIKE  '%".$request->otherMarks."%'";
        }else{
            $search8 =  '';
        }

        if( $request->seats != '' ){
            $search9 = "AND `seats` LIKE  '%".$request->seats."%'";
        }else{
            $search9 =  '';
        }

        if( $request->seatsallocatedtobya != '' ){
            $search11 = "AND `seatsallocatedtobya` LIKE  '%".$request->seatsallocatedtobya."%'";
        }else{
            $search11 =  '';
        }
         
        if( $request->addresstype_id != null ){
            $search12 = "AND `addresstype`.`id` =  '".$request->addresstype_id."'";
        }else{
            $search12 =  '';
        }

        if( $request->city_id != '' ){
            $search13 = "AND `city`.`id` =  '".$request->city_id."'";
            $cityID = Input::get('city_id');

        }else{
            $search13 =  '';
            $cityID= '';
        }

        if( $request->stateName != '' ){
            $search14 = " AND `state`.`id` =  '".$request->stateName."'"; 
            $stateID = Input::get('stateName');          
        }else{
            $search14 = '';
            $stateID = '';
        }

        if( $request->country_id != null ){
            $search15 = "AND `country`.`id` =  '".$request->country_id."'";
            $countryID = Input::get('country_id');     
        }else{
            $search15 =  '';
            $countryID = '';     
        }
         

        $totalFeeRange = explode(';', $request->fees);
            //$feeRange = $totalFeeRange[0].','.$totalFeeRange[1];


        if( $request->fees != '' ){
            $search10 = "AND `fees` BETWEEN  ".$totalFeeRange[0]." AND ".$totalFeeRange[1]."";
        }else{
            $search10 =  '';
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
       
        $collegeMasterDataObj = DB::select( DB::raw("SELECT collegemaster.id as collegemasterId, collegemaster.twelvemarks,  collegemaster.others,  collegemaster.fees,  collegemaster.seats, collegemaster.seatsallocatedtobya, educationlevel.id as educationlevelId,  educationlevel.name as educationlevelName, users.id as userID, users.firstname,  users.lastname,  userrole.name as userRoleName, functionalarea.id as functionalareaID, functionalarea.name as functionalAreaName, degree.id as degreeId, degree.name as degreeName, coursetype.id as coursetypeId, coursetype.name as coursetypeName, course.id as courseID, course.name as courseName,address.id as addressId,collegeprofile.id as collegeprofileID, addresstype.id as addresstypeID, addresstype.name as addresstypeName,city.id as cityId, city.name as cityName,state.id as stateId, state.name as stateName,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname, collegemaster.updated_at FROM  `collegemaster`  
                        LEFT JOIN `collegeprofile` ON `collegemaster`.`collegeprofile_id` = `collegeprofile`.`id`
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `educationlevel` ON `collegemaster`.`educationlevel_id` = `educationlevel`.`id`
                        LEFT JOIN `functionalarea` ON `collegemaster`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `degree` ON `collegemaster`.`degree_id` = `degree`.`id`
                        LEFT JOIN `coursetype` ON `collegemaster`.`coursetype_id` = `coursetype`.`id`
                        LEFT JOIN `course` ON `collegemaster`.`course_id` = `course`.`id`

                        LEFT JOIN `address` ON `collegemaster`.`collegeprofile_id` = `address`.`collegeprofile_id`
                        LEFT JOIN `addresstype` ON `address`.`addresstype_id` = `addresstype`.`id`  
                        INNER JOIN `city` ON `address`.`city_id` = `city`.`id`
                        INNER JOIN `state` ON `city`.`state_id` = `state`.`id`  
                        LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                        LEFT JOIN `users` as `eID` ON `collegemaster`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        $search5
                        $search6
                        $search7
                        $search8
                        $search9
                        $search10
                        $search11
                        $search12
                        $search13
                        $search14
                        $search15
                        AND users.userstatus_id != '5'
                        group by collegemaster.id
                        ORDER BY collegemaster.id ASC
                        LIMIT 20 OFFSET $getValue"
                    ));
      //  LEFT JOIN `collegeprofile` ON `collegemaster`.`collegeprofile_id` = `collegeprofile`.`id`
//print_r($collegeMasterDataObj);die;
        $collegeMasterDataObj1 = DB::select( DB::raw("SELECT COUNT(collegemaster.id) as totalCount FROM  `collegemaster` 
                         
                        LEFT JOIN `collegeprofile` ON `collegemaster`.`collegeprofile_id` = `collegeprofile`.`id`
                        LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                        LEFT JOIN `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `educationlevel` ON `collegemaster`.`educationlevel_id` = `educationlevel`.`id`
                        LEFT JOIN `functionalarea` ON `collegemaster`.`functionalarea_id` = `functionalarea`.`id`
                        LEFT JOIN `degree` ON `collegemaster`.`degree_id` = `degree`.`id`
                        LEFT JOIN `coursetype` ON `collegemaster`.`coursetype_id` = `coursetype`.`id`
                        LEFT JOIN `course` ON `collegemaster`.`course_id` = `course`.`id`
                        LEFT JOIN `address` ON `collegemaster`.`collegeprofile_id` = `address`.`collegeprofile_id`
                        LEFT JOIN `addresstype` ON `address`.`addresstype_id` = `addresstype`.`id`  
                        INNER JOIN `city` ON `address`.`city_id` = `city`.`id`
                        INNER JOIN `state` ON `city`.`state_id` = `state`.`id`  
                        LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                        LEFT JOIN `users` as `eID` ON `collegemaster`.`employee_id` = `eID`.`id`
                        WHERE $search0  
                        $search1 
                        $search2
                        $search3
                        $search4
                        $search5
                        $search6
                        $search7
                        $search8
                        $search9
                        $search10
                        $search11
                        $search12
                        $search13
                        $search14
                        $search15
                        AND users.userstatus_id != '5'
                        ORDER BY collegemaster.id ASC
                        LIMIT 20 "
                    ));

//print_r($collegeMasterDataObj1);die;

        if(!empty($collegeMasterDataObj1)){
            $numRecords = $collegeMasterDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'collegeMasterDataObj' => $collegeMasterDataObj,
                    'totalCountReturn' => sizeof($collegeMasterDataObj),
                    'collegeMasterDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $collegeMasterDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'collegeMasterDataObj' => $collegeMasterDataObj,
                    'totalCountReturn' => '',
                    'collegeMasterDataObj1' => $total_pages,
                    'currentNode' =>$currentNode,
                    'getTotalCount' => $collegeMasterDataObj1,
                );
        }

        if( !empty($collegeMasterDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allCollegeMasterCourse(Request $request){

        /*$collegeProfile = CollegeMaster::orderBy('collegemaster.id', 'DESC')
                        ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                        ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                        ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                        ->leftjoin('coursetype', 'collegemaster.coursetype_id', '=', 'coursetype.id')
                        ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('address', 'users.id', '=', 'address.collegeprofile_id')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->select('collegemaster.id as collegemasterId','collegemaster.twelvemarks', 'collegemaster.others', 'collegemaster.fees', 'collegemaster.seats','collegemaster.seatsallocatedtobya','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName','address.id as addressId', 'addresstype.id as addresstypeID', 'addresstype.name as addresstypeName','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName')
                        ->take(20)
                        ->get();*/
         $collegeProfile = CollegeMaster::orderBy('collegemaster.id', 'DESC')
                        ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftjoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
                        ->leftjoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
                        ->leftjoin('degree', 'collegemaster.degree_id', '=', 'degree.id')
                        ->leftjoin('coursetype', 'collegemaster.coursetype_id', '=', 'coursetype.id')
                        ->leftjoin('course', 'collegemaster.course_id', '=', 'course.id')
                        ->leftjoin('users', 'collegeprofile.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','collegemaster.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->select('collegemaster.id as collegemasterId','collegemaster.twelvemarks', 'collegemaster.others', 'collegemaster.fees', 'collegemaster.seats','collegemaster.seatsallocatedtobya','educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','functionalarea.id as functionalareaID','functionalarea.name as functionalAreaName','degree.id as degreeId','degree.name as degreeName','coursetype.id as coursetypeId','coursetype.name as coursetypeName','course.id as courseID','course.name as courseName','collegeprofile.id as collegeprofileID','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','collegemaster.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($collegeProfile);
    }
    
    public function selectCityNameData( Request $request )
    {
        $stateId = Input::get('stateId');

        $cityObj = DB::table('state')
                    ->join('city', function ($join) use ($stateId) {
                                   $join->on('state.id', '=', 'city.state_id')
                                        ->where('state.id', '=', DB::raw($stateId));
                                   })
                    ->select('city.id', 'city.name')
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;

        if( !empty($stateId) ){
            $dataArray = array( 'code' => '200' , 'cityData' => $cityObj );
        }else{
            $dataArray = array( 'code' => '401' , 'cityData' => '' );
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }

    public function deleteSearchCollegeMaster(Request $request, $id)
    {   
        CollegeMaster::destroy($id);
        return Redirect::back();
    }

}
