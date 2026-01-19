<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Address;
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
use App\Models\AddressType as AddressType;
use App\Models\City as City;
use App\Models\StudentProfile as StudentProfile;
use App\Models\CollegeProfile as CollegeProfile;
use App\Http\Controllers\Helper\FetchDataServiceController;

class AddressController extends Controller
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
                                ->where('alltableinformations.name', '=', 'Address')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){

                //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Address')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;

                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

               $address = Address::orderBy('id', 'DESC')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->leftJoin('studentprofile', 'address.studentprofile_id', '=', 'studentprofile.id')
                        ->leftJoin('users as studentUser', 'studentprofile.users_id', '=', 'studentUser.id')
                        ->leftJoin('collegeprofile', 'address.collegeprofile_id', '=', 'collegeprofile.id')
                        ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                        ->leftJoin('users as eID','address.employee_id', '=','eID.id')
                        ->paginate(15, array('address.id', 'address.name', 'address.address1', 'address.address2', 'address.postalcode', 'addresstype.name as addressType', 'city.name as cityName', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName', 'studentprofile.gender as studentUserGender', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName', 'collegeprofile.estyear as collegeUserEstYear','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','state.name as stateName', 'country.name as countryName','address.updated_at'))
                        ;

                $collegeProfileObj = DB::table('users')
                            ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
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

                return view('employee/address.index', compact('address'))
                    ->with('collegeProfileObj', $collegeProfileObj)
                    ->with('cityNameObj', $cityNameObj)
                    ->with('addressTypeObj', $addressTypeObj)
                    ->with('stateNameObj', $stateNameObj)
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
                                ->where('alltableinformations.name', '=', 'Address')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $collegeProfileObj = DB::table('collegeprofile')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->where('users.userrole_id', '=', '2')
                                ->select('collegeprofile.id as collegeprofileID','collegeprofile.description', 'collegeprofile.estyear', 'users.id as userID','users.firstname','users.middlename', 'users.lastname' )
                                ->get()
                                ;

                $studentProfile = DB::table('studentprofile')
                                    ->leftJoin('users', 'studentprofile.users_id', '=', 'users.id')
                                    ->where('users.userrole_id', '=', '3')
                                    ->select('studentprofile.id as studentprofileID','studentprofile.gender', 'users.id as userID','users.firstname','users.middlename', 'users.lastname')
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
                return view('employee/address.create')
                ->with('collegeProfileObj', $collegeProfileObj)
                ->with('studentProfile', $studentProfile)
                ->with('cityNameObj', $cityNameObj)
                ->with('addressTypeObj', $addressTypeObj)
                ->with('stateNameObj', $stateNameObj);
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

            $addressObj = New Address();
            $addressObj->name = Input::get('name');
            $addressObj->address1 = Input::get('address1');
            $addressObj->address2 = Input::get('address2');
            $addressObj->landmark = Input::get('landmark');
            $addressObj->postalcode = Input::get('postalcode');
            $addressObj->addresstype_id = Input::get('addresstype_id');
            $addressObj->city_id = Input::get('city_id');
            $addressObj->studentprofile_id = Input::get('studentprofile_id');
            $addressObj->collegeprofile_id = Input::get('collegeprofile_id');
            $addressObj->employee_id = Auth::id();
            $addressObj->save();

            if (($addressObj->addresstype_id == 1) || ($addressObj->addresstype_id == 2) && (!empty($addressObj->collegeprofile_id))) {
                $updateCollegeAddress = $this->fetchDataServiceController->updateCollegeAddress($addressObj->addresstype_id, $addressObj->collegeprofile_id);
            }

            Session::flash('flash_message', 'Address added!');
            return redirect('employee/address');
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
                                ->where('alltableinformations.name', '=', 'Address')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                //$address = Address::findOrFail($id);
                $address = Address::orderBy('id', 'DESC')
                            ->leftJoin('addresstype','address.addresstype_id','=','addresstype.id')
                            ->leftJoin('city','address.city_id','=','city.id')
                            ->leftJoin('state','city.state_id','=','state.id')
                            ->leftJoin('country','state.country_id','=','country.id')
                            ->leftJoin('studentprofile', 'address.studentprofile_id', '=', 'studentprofile.id')
                            ->leftJoin('users as studentUser', 'studentprofile.users_id', '=', 'studentUser.id')
                            ->leftJoin('collegeprofile', 'address.collegeprofile_id', '=', 'collegeprofile.id')
                            ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                            ->leftJoin('users as eID','address.employee_id', '=','eID.id')
                            ->select('address.id', 'address.name', 'address.address1', 'address.address2', 'address.landmark','address.postalcode', 'addresstype.name as addressType', 'city.name as cityName', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName', 'studentprofile.gender as studentUserGender', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName', 'collegeprofile.estyear as collegeUserEstYear','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','state.name as stateName', 'country.name as countryName','address.updated_at')
                            ->findOrFail($id)
                            ;

                return view('employee/address.show', compact('address'));
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
                                ->where('alltableinformations.name', '=', 'Address')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $address = Address::findOrFail($id);

                $collegeProfileObj = DB::table('collegeprofile')
                                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                    ->where('users.userrole_id', '=', '2')
                                    ->select('collegeprofile.id as collegeprofileID','collegeprofile.description', 'collegeprofile.estyear', 'users.id as userID','users.firstname')
                                    ->get()
                                    ;

                $studentProfile = DB::table('studentprofile')
                                    ->leftJoin('users', 'studentprofile.users_id', '=', 'users.id')
                                    ->where('users.userrole_id', '=', '3')
                                    ->select('studentprofile.id as studentprofileID','studentprofile.gender', 'users.id as userID','users.firstname','users.middlename', 'users.lastname')
                                    ->get()
                                    ;
                $addressDataObj = DB::table('address')
                                    ->leftJoin('city','address.city_id','=','city.id')
                                    ->leftJoin('state','city.state_id','=','state.id')
                                    ->leftJoin('country','state.country_id','=','country.id')
                                    ->select('address.id','city.id as cityId','city.name as cityName','state.id as stateId','state.name as stateName','country.id as countryId','country.name as countryName')
                                    ->where('address.id', '=', $id)
                                    ->take(1)
                                    ->orderBy('address.id', 'DESC' )
                                    ->get()
                                    ;
                                          //  print_r($addressDataObj);die;
                $cityNameObj = DB::table('city')
                        ->where('city.cityStatus','=','1')
                        ->orderBy('city.name', 'ASC')
                        ->get()
                        ;

                $stateNameObj = DB::table('state')
                        ->orderBy('state.name', 'ASC')
                        ->get()
                        ;

                $countryObj = DB::table('country')
                    ->orderBy('country.name', 'ASC')
                    ->get()
                    ;

                $addressTypeObj = AddressType::all();

                return view('employee/address.edit', compact('address'))
                ->with('collegeProfileObj', $collegeProfileObj)
                ->with('studentProfile', $studentProfile)
                ->with('cityNameObj', $cityNameObj)
                ->with('addressTypeObj', $addressTypeObj)
                ->with('stateNameObj', $stateNameObj)
                ->with('addressDataObj', $addressDataObj)
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

            $addressObj = Address::findOrFail($id);
            $addressObj->name = Input::get('name');
            $addressObj->address1 = Input::get('address1');
            $addressObj->address2 = Input::get('address2');
            $addressObj->landmark = Input::get('landmark');
            $addressObj->postalcode = Input::get('postalcode');
            $addressObj->addresstype_id = Input::get('addresstype_id');
            $addressObj->city_id = Input::get('city_id');
            $addressObj->studentprofile_id = Input::get('studentprofile_id');
            $addressObj->collegeprofile_id = Input::get('collegeprofile_id');
            $addressObj->employee_id = Auth::id();
            $addressObj->save();

            if (($addressObj->addresstype_id == 1) || ($addressObj->addresstype_id == 2) && (!empty($addressObj->collegeprofile_id))) {
                $updateCollegeAddress = $this->fetchDataServiceController->updateCollegeAddress($addressObj->addresstype_id, $addressObj->collegeprofile_id);
            }

            Session::flash('flash_message', 'Address updated!');
            return redirect('employee/address');
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
                                ->where('alltableinformations.name', '=', 'Address')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                Address::destroy($id);
                Session::flash('flash_message', 'Address deleted!');
                return redirect('employee/address');
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

    public function getAllCityNameData( Request $request )
    {
        $stateId = Input::get('stateId');

        $cityObj = DB::table('state')
                    ->join('city', function ($join) use ($stateId) {
                                   $join->on('state.id', '=', 'city.state_id')
                                        ->where('state.id', '=', DB::raw($stateId));
                                   })
                    ->select('city.id', 'city.name')
                    ->where('city.cityStatus','=','1')
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

   /**

     * Search users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function addressEmployeeSearch(Request $request)
    {
      $search0 = 'address.id';

      if( $request->collegeprofile_id != null ){
          $search1 = "AND `collegeUser`.`firstname` = '".$request->collegeprofile_id."' OR `studentUser`.`firstname` =  '".$request->collegeprofile_id."'" ;
      }else{
          $search1 =  '';
      }

      if( $request->addresstype_id != null ){
          $search2 = "AND `addresstype`.`id` =  '".$request->addresstype_id."'";
      }else{
          $search2 =  '';
      }

      if( $request->addressName != '' ){
          $search3 = " AND `address`.`name` LIKE  '%".$request->addressName."%'";
      }else{
          $search3 = '';
      }


      if( $request->postalCode != '' ){
          $search4 = " AND `address`.`postalcode` LIKE  '%".$request->postalCode."%'";
      }else{
          $search4 = '';
      }

      if( $request->city_id != '' ){
          $search5 = "AND `city`.`id` =  '".$request->city_id."'";
          $cityID = Input::get('city_id');

      }else{
          $search5 =  '';
          $cityID= '';
      }

      if( $request->stateName != '' ){
          $search6 = " AND `state`.`id` =  '".$request->stateName."'";
          $stateID = Input::get('stateName');
      }else{
          $search6 = '';
          $stateID = '';
      }

     /* print_r($request->city_id);
      print_r($request->stateName);die;*/

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

      $addressSearchDataObj = DB::select( DB::raw("SELECT address.id as addressId, address.name as addressName, address.address1, address.address2, address.postalcode, addresstype.name as addressType, city.name as cityName, studentUser.id as studentUserID, studentUser.firstname as studentUserFirstName, studentUser.lastname as studentUserLastName, studentprofile.gender as studentUserGender, collegeUser.id as collegeUserID, collegeUser.firstname as collegeUserFirstName, collegeprofile.estyear as collegeUserEstYear,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname, state.name as stateName, country.name as countryName, address.updated_at FROM  `address`
                      LEFT JOIN `addresstype` ON `address`.`addresstype_id` = `addresstype`.`id`
                      LEFT JOIN `city` ON `address`.`city_id` = `city`.`id`
                      LEFT JOIN `state` ON `city`.`state_id` = `state`.`id`
                      LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                      LEFT JOIN `studentprofile` ON `address`.`studentprofile_id` = `studentprofile`.`id`
                      LEFT JOIN `users` as `studentUser` ON `studentprofile`.`users_id` = `studentUser`.`id`
                      LEFT JOIN `collegeprofile` ON `address`.`collegeprofile_id` = `collegeprofile`.`id`
                      LEFT JOIN `users` as `collegeUser` ON `collegeprofile`.`users_id` = `collegeUser`.`id`
                      LEFT JOIN `users` as `eID` ON `address`.`employee_id` = `eID`.`id`
                      WHERE  $search0
                      $search1
                      $search2
                      $search3
                      $search4
                      $search5
                      $search6
                      ORDER BY address.id ASC
                      LIMIT 20 OFFSET $getValue"
                      ));
      // print_r($addressSearchDataObj);die;
      $addressSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(address.id) as totalCount FROM  `address`
                      LEFT JOIN `addresstype` ON `address`.`addresstype_id` = `addresstype`.`id`
                      LEFT JOIN `city` ON `address`.`city_id` = `city`.`id`
                      LEFT JOIN `state` ON `city`.`state_id` = `state`.`id`
                      LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                      LEFT JOIN `studentprofile` ON `address`.`studentprofile_id` = `studentprofile`.`id`
                      LEFT JOIN `users` as `studentUser` ON `studentprofile`.`users_id` = `studentUser`.`id`
                      LEFT JOIN `collegeprofile` ON `address`.`collegeprofile_id` = `collegeprofile`.`id`
                      LEFT JOIN `users` as `collegeUser` ON `collegeprofile`.`users_id` = `collegeUser`.`id`
                      LEFT JOIN `users` as `eID` ON `address`.`employee_id` = `eID`.`id`
                      WHERE  $search0
                      $search1
                      $search2
                      $search3
                      $search4
                      $search5
                      $search6
                      ORDER BY address.id ASC
                      LIMIT 20"
                  ));

      if(!empty($addressSearchDataObj1)){
          $numRecords = $addressSearchDataObj1[0]->totalCount;
          $total_pages = ceil($numRecords/20);
          $dataArray = array(
                  'addressSearchDataObj' => $addressSearchDataObj,
                  'addressSearchDataObj1' => $total_pages,
                  'currentNode' => $currentNode,
                  'getTotalCount' => $addressSearchDataObj1,

              );
      }else{
          $total_pages = 0;
          $dataArray = array(
                  'addressSearchDataObj' => $addressSearchDataObj,
                  'addressSearchDataObj1' => $total_pages,
                  'currentNode' => $currentNode,
                  'getTotalCount' => $addressSearchDataObj1,
              );
      }

      if( !empty($addressSearchDataObj) )
      {
          return json_encode($dataArray);
      }else{
          return json_encode('no');
      }
      
    }

    public function allAddressEmployeeSearch(Request $request){

      $address = Address::orderBy('address.id', 'DESC')
                      ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                      ->leftJoin('city', 'address.city_id', '=', 'city.id')
                      ->leftJoin('state','city.state_id','=','state.id')
                      ->leftJoin('country','state.country_id','=','country.id')
                      ->leftJoin('studentprofile', 'address.studentprofile_id', '=', 'studentprofile.id')
                      ->leftJoin('users as studentUser', 'studentprofile.users_id', '=', 'studentUser.id')
                      ->leftJoin('collegeprofile', 'address.collegeprofile_id', '=', 'collegeprofile.id')
                      ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                      ->leftJoin('users as eID','address.employee_id', '=','eID.id')
                      ->select('address.id as addressId', 'address.name as addressName', 'address.address1', 'address.address2', 'address.postalcode', 'addresstype.name as addressType', 'city.name as cityName', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName', 'studentprofile.gender as studentUserGender', 'collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName', 'collegeprofile.estyear as collegeUserEstYear','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','state.name as stateName', 'country.name as countryName','address.updated_at')
                      ->take(20)
                      ->get();


      return json_encode($address);
    }

}
