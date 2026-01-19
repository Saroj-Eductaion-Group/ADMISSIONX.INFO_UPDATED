<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Career;
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
use App\Models\Document as Document;

class CareerController extends Controller
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
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Career')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    //GET ACCESS FOR THE UPDATE METHOD
                    $validateUserRoleAction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $userId)
                                    ->where('alltableinformations.name', '=', 'Career')
                                    ->where('userprivileges.index', '=', '1')
                                    ->select('userprivileges.edit', 'userprivileges.update')
                                    ->orderBy('userprivileges.id', 'DESC')
                                    ->take(1)
                                    ->get()
                                    ;
                                       
                    $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                    //$career = Career::paginate(15);
                    $career = Career::orderBy('careers.id', 'DESC')
                        ->leftJoin('users as eID','careers.employee_id', '=','eID.id')
                        ->paginate(15, array('careers.id','careers.firstname', 'careers.middlename', 'careers.lastname', 'careers.email', 'careers.dateOfBirth', 'careers.gender', 'careers.phonenumber', 'careers.address', 'careers.pincode', 'careers.cv', 'careers.postappliedfor','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','careers.updated_at'));
                    return view('employee/career.index', compact('career'))
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
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Career')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $cityNameObj = DB::table('city')
                    ->where('city.cityStatus','=','1')
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;
                    $stateNameObj = DB::table('state')
                            ->orderBy('state.name', 'ASC')
                            ->get()
                            ;

                   return view('employee/career.create')
                   ->with('cityNameObj', $cityNameObj)
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
        
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                
                $careerObj = New Career();
        
                if( !empty(Input::get('firstname')) ){
                    $careerObj->firstname = Input::get('firstname');    
                }

                if( !empty(Input::get('middlename')) ){
                    $careerObj->middlename = Input::get('middlename');    
                }

                if( !empty(Input::get('lastname')) ){
                    $careerObj->lastname = Input::get('lastname');    
                }

                if( !empty(Input::get('email')) ){
                    $careerObj->email = Input::get('email');    
                }

                if( !empty(Input::get('dateOfBirth')) ){
                    $careerObj->dateOfBirth = Input::get('dateOfBirth');    
                }

                if( !empty(Input::get('gender')) ){
                    $careerObj->gender = Input::get('gender');    
                }

                if( !empty(Input::get('phonenumber')) ){
                    $careerObj->phonenumber = Input::get('phonenumber');    
                }

                
                if( !empty(Input::get('address')) ){
                    $careerObj->address = Input::get('address');    
                }

                if( !empty(Input::get('pincode')) ){
                    $careerObj->pincode = Input::get('pincode');    
                }

                if( !empty(Input::get('postappliedfor')) ){
                    $careerObj->postappliedfor = Input::get('postappliedfor');    
                }

                if( !empty(Input::get('city_id')) ){
                    $careerObj->city_id = Input::get('city_id');    
                }

                /****upload document ***/

                if($request->file('cvFIle'))
                {   
                    $documentObj = new Document;
                    if($request->file('cvFIle'))
                    {            
                        if( $_FILES["cvFIle"]["size"] <= '7340032' ){ 
                            $path = $_FILES['cvFIle']['name'];
                            $ext = pathinfo($path, PATHINFO_EXTENSION);
                            $ext = strtolower($ext);

                            $extensionOfFile = $_FILES[ 'cvFIle' ][ 'type' ];
                            
                            $tempPath = $_FILES[ 'cvFIle' ][ 'tmp_name' ];
                            $currentMyTime = strtotime('now');
                            $imageNameWithTime = Input::get('firstname').'-'.$currentMyTime;
                            $cvWithExtension = $imageNameWithTime.'1'.'.'.$ext;//$extensionOfFile;
                            $cvWithExtension1 = $imageNameWithTime.'1'.'_original'.'.'.$ext;//$extensionOfFile;
                         
                            //Set the image folder path
                            if(env('APP_ENV') == 'local'){
                               $dirPath = public_path().'/resume/';
                            }else{
                                $dirPath = public_path().'/resume/';
                            }
                            
                            //Store the image with 300PX width
                            $uploadPath = $dirPath.$cvWithExtension;
                            //Store the image with original width as original
                            $uploadPath1 = $dirPath.$cvWithExtension1;
                            if (move_uploaded_file($tempPath, $uploadPath)) {
                             copy($uploadPath, $uploadPath1);
                            }
                            
                            //IMAGE SAVED IN FOLDER NOW RESIZE IT
                            if (file_exists($dirPath.$cvWithExtension)) {

                                $uploadimage = $dirPath.$cvWithExtension;//$dirPath.$_FILES['file']['name'];
                                $newname = $cvWithExtension;//$_FILES['file']['name'];

                                // Set the resize_image name
                                $resize_image = $dirPath.$newname; 
                                $actual_image = $dirPath.$newname;
                                // It gets the size of the image
                                list( $width,$height ) = getimagesize( $uploadimage );
                                // It makes the new image width of 350
                               
                                if( $width > '600' ){
                                    $newwidth = 600;
                                    // It makes the new image height of 350
                                    //$newheight = 350;
                                    if( $ext != 'png' ){
                                        $image = imagecreatefromjpeg($dirPath.$cvWithExtension);
                                    }else{
                                        $image = imagecreatefrompng($dirPath.$cvWithExtension);
                                    }
                                    $orig_width = imagesx($image);
                                    $orig_height = imagesy($image);

                                    // Calc the new height
                                    $newheight = (($orig_height * $newwidth) / $orig_width);
                                    // It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
                                    $thumb = imagecreatetruecolor( $newwidth, $newheight );
                                    if( $ext != 'png' ){
                                        $source = imagecreatefromjpeg( $resize_image );
                                    }else{
                                        $source = imagecreatefrompng( $resize_image );
                                    }
                                    
                                    // Resize the $thumb image.
                                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                                    // It then save the new image to the location specified by $resize_image variable
                                    if( $ext != 'png' ){
                                        imagejpeg( $thumb, $resize_image, 100 ); 
                                    }else{
                                        header('Content-Type: image/png');
                                        imagepng( $thumb, $resize_image); 
                                    }
                                    // 100 Represents the quality of an image you can set and ant number in place of 100.
                                    $out_image=addslashes(file_get_contents($resize_image));    
                                }else{
                                    $newwidth = $width;
                                    $newheight = $height;
                                }            
                            }
                    }

                    $documentObj->name= $cvWithExtension;
                    $documentObj->fullimage= $cvWithExtension1;
                    $documentObj->description= '';
                    $documentObj->width = round($newwidth);
                    $documentObj->height = round($newheight);
                    $documentObj->users_id = null; 
                    $documentObj->category_id = '5'; //hard-code value
                    $documentObj->employee_id = Auth::id();
                    $documentObj->save();
                }else{

                    }
                }
                
                if( !empty($cvWithExtension) ){
                    $careerObj->cv = $cvWithExtension;    
                }
                $careerObj->employee_id = Auth::id();
                $careerObj->save();

                Session::flash('flash_message', 'Career added!');

                return redirect('employee/career');
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
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Career')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    //$career = Career::findOrFail($id);

                        $careerDataObj = DB::table('careers')
                                    ->leftJoin('city', 'careers.city_id', '=','city.id')
                                    ->leftJoin('state', 'city.state_id', '=','state.id')
                                    ->leftJoin('country', 'state.country_id', '=','country.id')
                                    ->leftJoin('users as eID','careers.employee_id', '=','eID.id')
                                    ->where('careers.id','=', $id)
                                    ->select('careers.id as careersId', 'careers.firstname', 'careers.middlename', 'careers.lastname', 'careers.email', 'careers.dateOfBirth', 'careers.gender', 'careers.phonenumber', 'careers.address', 'careers.pincode', 'careers.cv', 'careers.postappliedfor','city.id as cityId','city.name as cityName','state.id as stateId','state.name as stateName','country.id as countryId','country.name as countryName','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','careers.updated_at')
                                    ->orderBy('careers.id', 'ASC')
                                    ->get()
                                    ;


                        $carrerData = array();
                        $dataArray = array();
                        if( empty($careerDataObj) ){
                            $careerDataObj = '';
                        }else{
                            foreach ($careerDataObj as $item) {
                                $fileName = $item->cv;
                                $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                                
                                //Data Array Content
                                $carrerData['careersId'] = $item->careersId;
                                $carrerData['firstname'] = $item->firstname;
                                $carrerData['middlename'] = $item->middlename;
                                $carrerData['lastname'] = $item->lastname;
                                $carrerData['dateOfBirth'] = $item->dateOfBirth;
                                $carrerData['email'] = $item->email;
                                $carrerData['gender'] = $item->gender;
                                $carrerData['phonenumber'] = $item->phonenumber;
                                $carrerData['address'] = $item->address;
                                $carrerData['pincode'] = $item->pincode;
                                $carrerData['postappliedfor'] = $item->postappliedfor;
                                $carrerData['cv'] = $item->cv;
                                $carrerData['cityName'] = $item->cityName;
                                $carrerData['stateName'] = $item->stateName;
                                $carrerData['countryName'] = $item->countryName;
                                $carrerData['ext'] = $ext;
                                $carrerData['eUserId'] = $item->eUserId;
                                $carrerData['employeeFirstname'] = $item->employeeFirstname;
                                $carrerData['employeeMiddlename'] = $item->employeeMiddlename;
                                $carrerData['employeeLastname'] = $item->employeeLastname;
                                $carrerData['updated_at'] = $item->updated_at;
                                $dataArray[] = $carrerData;
                            }
                        }

                        return view('employee/career.show')
                            ->with('careerDataObj', $dataArray);
                   
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
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Career')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    $career = Career::findOrFail($id);

                    $cityNameObj = DB::table('city')
                        ->where('city.cityStatus','=','1')
                        ->orderBy('city.name', 'ASC')
                        ->get()
                        ;
                    $stateNameObj = DB::table('state')
                            ->orderBy('state.name', 'ASC')
                            ->get()
                            ;

                    $addressDataObj = DB::table('careers')
                                    ->leftJoin('city','careers.city_id','=','city.id')
                                    ->leftJoin('state','city.state_id','=','state.id')
                                    ->select('careers.id','city.id as cityId','city.name as cityName','state.id as stateId','state.name as stateName')
                                    ->where('careers.id', '=', $id)
                                    ->take(1)
                                    ->orderBy('careers.id', 'DESC' )
                                    ->get()
                                    ;

                    return view('employee/career.edit', compact('career'))
                    ->with('cityNameObj', $cityNameObj)
                    ->with('stateNameObj', $stateNameObj)
                    ->with('addressDataObj', $addressDataObj);
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
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $careerObj = Career::findOrFail($id);
                //$career->update($request->all());
        
                if( !empty(Input::get('firstname')) ){
                    $careerObj->firstname = Input::get('firstname');    
                }

                if( !empty(Input::get('middlename')) ){
                    $careerObj->middlename = Input::get('middlename');    
                }

                if( !empty(Input::get('lastname')) ){
                    $careerObj->lastname = Input::get('lastname');    
                }

                if( !empty(Input::get('email')) ){
                    $careerObj->email = Input::get('email');    
                }
                
                if( !empty(Input::get('dateofbirth')) ){
                    $careerObj->dateOfBirth = Input::get('dateofbirth');   
                }

                if( !empty(Input::get('gender')) ){
                    $careerObj->gender = Input::get('gender');    
                }

                if( !empty(Input::get('phonenumber')) ){
                    $careerObj->phonenumber = Input::get('phonenumber');    
                }

                
                if( !empty(Input::get('address')) ){
                    $careerObj->address = Input::get('address');    
                }

                if( !empty(Input::get('pincode')) ){
                    $careerObj->pincode = Input::get('pincode');    
                }

                if( !empty(Input::get('postappliedfor')) ){
                    $careerObj->postappliedfor = Input::get('postappliedfor');    
                }

                if( !empty(Input::get('city_id')) ){
                    $careerObj->city_id = Input::get('city_id');    
                }

                /****upload document ***/

                if($request->file('cvFIle'))
                {   
                    $documentObj = new Document;
                    if($request->file('cvFIle'))
                    {            
                        if( $_FILES["cvFIle"]["size"] <= '7340032' ){ 
                            $path = $_FILES['cvFIle']['name'];
                            $ext = pathinfo($path, PATHINFO_EXTENSION);
                            $ext = strtolower($ext);

                            $extensionOfFile = $_FILES[ 'cvFIle' ][ 'type' ];
                            
                            $tempPath = $_FILES[ 'cvFIle' ][ 'tmp_name' ];
                            $currentMyTime = strtotime('now');
                            $imageNameWithTime = Input::get('firstname').'-'.$currentMyTime;
                            $cvWithExtension = $imageNameWithTime.'1'.'.'.$ext;//$extensionOfFile;
                            $cvWithExtension1 = $imageNameWithTime.'1'.'_original'.'.'.$ext;//$extensionOfFile;
                         
                            //Set the image folder path
                            if(env('APP_ENV') == 'local'){
                               $dirPath = public_path().'/resume/';
                            }else{
                                $dirPath = public_path().'/resume/';
                            }
                            
                            //Store the image with 300PX width
                            $uploadPath = $dirPath.$cvWithExtension;
                            //Store the image with original width as original
                            $uploadPath1 = $dirPath.$cvWithExtension1;
                            if (move_uploaded_file($tempPath, $uploadPath)) {
                             copy($uploadPath, $uploadPath1);
                            }
                            
                            //IMAGE SAVED IN FOLDER NOW RESIZE IT
                            if (file_exists($dirPath.$cvWithExtension)) {

                                $uploadimage = $dirPath.$cvWithExtension;//$dirPath.$_FILES['file']['name'];
                                $newname = $cvWithExtension;//$_FILES['file']['name'];

                                // Set the resize_image name
                                $resize_image = $dirPath.$newname; 
                                $actual_image = $dirPath.$newname;
                                // It gets the size of the image
                                list( $width,$height ) = getimagesize( $uploadimage );
                                // It makes the new image width of 350
                               
                                if( $width > '600' ){
                                    $newwidth = 600;
                                    // It makes the new image height of 350
                                    //$newheight = 350;
                                    if( $ext != 'png' ){
                                        $image = imagecreatefromjpeg($dirPath.$cvWithExtension);
                                    }else{
                                        $image = imagecreatefrompng($dirPath.$cvWithExtension);
                                    }
                                    $orig_width = imagesx($image);
                                    $orig_height = imagesy($image);

                                    // Calc the new height
                                    $newheight = (($orig_height * $newwidth) / $orig_width);
                                    // It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
                                    $thumb = imagecreatetruecolor( $newwidth, $newheight );
                                    if( $ext != 'png' ){
                                        $source = imagecreatefromjpeg( $resize_image );
                                    }else{
                                        $source = imagecreatefrompng( $resize_image );
                                    }
                                    
                                    // Resize the $thumb image.
                                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                                    // It then save the new image to the location specified by $resize_image variable
                                    if( $ext != 'png' ){
                                        imagejpeg( $thumb, $resize_image, 100 ); 
                                    }else{
                                        header('Content-Type: image/png');
                                        imagepng( $thumb, $resize_image); 
                                    }
                                    // 100 Represents the quality of an image you can set and ant number in place of 100.
                                    $out_image=addslashes(file_get_contents($resize_image));    
                                }else{
                                    $newwidth = $width;
                                    $newheight = $height;
                                }            
                            }
                    }

                    $documentObj->name= $cvWithExtension;
                    $documentObj->fullimage= $cvWithExtension1;
                    $documentObj->description= '';
                    $documentObj->width = round($newwidth);
                    $documentObj->height = round($newheight);
                    $documentObj->users_id = null; 
                    $documentObj->category_id = '5'; //hard-code value
                    $documentObj->employee_id = Auth::id();
                    $documentObj->save();
                }else{

                    }
                }
                
                if( !empty($cvWithExtension) ){
                    $careerObj->cv = $cvWithExtension;    
                }
                $careerObj->employee_id = Auth::id();
                $careerObj->save();

                Session::flash('flash_message', 'Career updated!');

                return redirect('employee/career');
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
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1' ){
                $validateUrlUsers = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Career')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

                if( $validateUrlUsers >= '1' ){
                    Career::destroy($id);
                    Session::flash('flash_message', 'Career deleted!');
                    return redirect('employee/career');
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
