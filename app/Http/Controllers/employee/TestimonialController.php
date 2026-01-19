<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Testimonial;
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

class TestimonialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
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
                                ->where('alltableinformations.name', '=', 'Testimonial')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Testimonial')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                                   
                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                 //$testimonial = Testimonial::paginate(15);
                $testimonial = Testimonial::orderBy('id', 'DESC')
                        ->leftJoin('users', 'testimonials.author','=','users.id')
                        ->leftJoin('users as eID','testimonials.employee_id', '=','eID.id')
                        ->paginate(15, array('testimonials.id', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','testimonials.updated_at'));
                        
                return view('employee/testimonial.index', compact('testimonial'))
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
                                ->where('alltableinformations.name', '=', 'Testimonial')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $userObj = User::all();

                return view('employee/testimonial.create')
                ->with('userObj', $userObj);
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
           /* Testimonial::create($request->all());
            Session::flash('flash_message', 'Testimonial added!');
            return redirect('employee/testimonial');*/

            if($request->file('uploadTestimonialDoc'))
            {            
                if( $_FILES["uploadTestimonialDoc"]["size"] <= '7340032' )
                {
                    $getLastID = DB::table('testimonials')->select('id')->orderBy('id', 'DESC')->get();
                    if( empty($getLastID)  ){
                        $totalIDNumber = '1';
                    }else{
                        $totalIDNumber = $getLastID[0]->id + 1;
                    }
                    $slugUrl = str_slug(Input::get('title'), "-");
                    
                    $extensionOfFile = '';
                    $path = $_FILES['uploadTestimonialDoc']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $ext = strtolower($ext);

                    // if( $ext != 'png' || $ext != 'jpg' || $ext != 'jpeg' || $ext != 'pdf' ){
                    //     Session::flash('wrongFileUpload', 'Not valid file extension');
                    //     return redirect('employee/testimonial');
                    //     die;
                    // }
                    
                    $tempPath = $_FILES[ 'uploadTestimonialDoc' ][ 'tmp_name' ];
                    $currentMyTime = strtotime('now');
                    $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                    $fileWithExtension = $imageNameWithTime.'.'.$ext;
                    $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
                 
                    //Set the image folder path
                    if(env('APP_ENV') == 'local'){
                       $dirPath = public_path().'/testimonial/';
                    }else{
                        $dirPath = public_path().'/testimonial/';
                    }
                    

                    //Store the image with 300PX width
                    $uploadPath = $dirPath.$fileWithExtension;
                    //Store the image with original width as original
                    $uploadPath1 = $dirPath.$fileWithExtension1;
                    if (move_uploaded_file($tempPath, $uploadPath)) {
                     copy($uploadPath, $uploadPath1);
                    }
                    
                    //IMAGE SAVED IN FOLDER NOW RESIZE IT
                    if (file_exists($dirPath.$fileWithExtension)) {

                        $uploadimage = $dirPath.$fileWithExtension;//$dirPath.$_FILES['file']['name'];
                        $newname = $fileWithExtension;//$_FILES['file']['name'];

                        // Set the resize_image name
                        $resize_image = $dirPath.$newname; 
                        $actual_image = $dirPath.$newname;
                        // It gets the size of the image
                        list( $width,$height ) = getimagesize( $uploadimage );
                        // It makes the new image width of 350
                        if( $width > '600' ){
                            $newwidth = 300;
                            // It makes the new image height of 350
                            //$newheight = 350;
                            if( $ext != 'png' ){
                                $image = imagecreatefromjpeg($dirPath.$fileWithExtension);
                            }else{
                                $image = imagecreatefrompng($dirPath.$fileWithExtension);
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
                
                $testimonialObj = new Testimonial;
                if( !empty(Input::get('title')) ){
                    $testimonialObj->title = Input::get('title');    
                }
                $testimonialObj->featuredimage = $fileWithExtension;
                $testimonialObj->featuredimageBig = $fileWithExtension1;
                if( !empty($newwidth)){
                    $testimonialObj->width = $newwidth;  
                }else{
                    $testimonialObj->width = '0';
                }
                if( !empty($newheight)){
                    $testimonialObj->height = $newheight;  
                }else{
                    $testimonialObj->height = '0';  
                }
                if( !empty(Input::get('description')) ){
                    $testimonialObj->description = Input::get('description');    
                }
                if( !empty(Input::get('author')) ){
                    $testimonialObj->author = Input::get('author');    
                }
                $testimonialObj->misc = 'Testimonial Image';
                $testimonialObj->slug =  str_slug(Input::get('title'), "-");
                $testimonialObj->employee_id = Auth::id();
                $testimonialObj->save();
            }
            else{
            }
           
            return redirect('employee/testimonial');
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
                                ->where('alltableinformations.name', '=', 'Testimonial')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                //$testimonial = Testimonial::findOrFail($id);
                $testimonial = Testimonial::orderBy('id', 'DESC')
                            ->leftJoin('users', 'testimonials.author','=','users.id')
                            ->leftJoin('users as eID','testimonials.employee_id', '=','eID.id')
                            ->select('testimonials.id', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','testimonials.updated_at')
                           ->findOrFail($id)
                            ;

                return view('employee/testimonial.show', compact('testimonial'));
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
                                ->where('alltableinformations.name', '=', 'Testimonial')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $testimonial = Testimonial::findOrFail($id);
                $userObj = User::all();

                return view('employee/testimonial.edit', compact('testimonial'))
                ->with('userObj', $userObj);
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
            /*$testimonial = Testimonial::findOrFail($id);
            $testimonial->update($request->all());
            Session::flash('flash_message', 'Testimonial updated!');*/
            $testimonialObj = Testimonial::findOrFail($id);

            if( !empty(Input::get('title')) ){
                $testimonialObj->title = Input::get('title');    
            }

            if( !empty(Input::get('description')) ){
                $testimonialObj->description = Input::get('description');    
            }
            if( !empty(Input::get('author')) ){
                $testimonialObj->author = Input::get('author');    
            }
            $testimonialObj->misc = 'Testimonial Image';
            $testimonialObj->slug =  str_slug(Input::get('title'), "-");

            //GET THE LAST CREATED ID
                $getLastID = DB::table('testimonials')
                            ->select('slug')
                            ->where('testimonials.id','=', $id)
                            ->orderBy('id', 'DESC')
                            ->get();

                $slugUrl = $getLastID[0]->slug;

            if($request->file('uploadTestimonialDoc'))
            {            
                if( $_FILES["uploadTestimonialDoc"]["size"] <= '7340032' )
                {
                    $extensionOfFile = '';
                    $path = $_FILES['uploadTestimonialDoc']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $ext = strtolower($ext);

                    // if( $ext != 'png' || $ext != 'jpg' || $ext != 'jpeg' || $ext != 'pdf' ){
                    //     Session::flash('wrongFileUpload', 'Not valid file extension');
                    //     return redirect('employee/testimonial');
                    //     die;
                    // }
                    
                    $tempPath = $_FILES[ 'uploadTestimonialDoc' ][ 'tmp_name' ];
                    $currentMyTime = strtotime('now');
                    $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                    $fileWithExtension = $imageNameWithTime.'.'.$ext;
                    $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
                 
                    //Set the image folder path
                    if(env('APP_ENV') == 'local'){
                       $dirPath = public_path().'/testimonial/';
                    }else{
                        $dirPath = public_path().'/testimonial/';
                    }
                    

                    //Store the image with 300PX width
                    $uploadPath = $dirPath.$fileWithExtension;
                    //Store the image with original width as original
                    $uploadPath1 = $dirPath.$fileWithExtension1;
                    if (move_uploaded_file($tempPath, $uploadPath)) {
                     copy($uploadPath, $uploadPath1);
                    }
                    
                    //IMAGE SAVED IN FOLDER NOW RESIZE IT
                    if (file_exists($dirPath.$fileWithExtension)) {

                        $uploadimage = $dirPath.$fileWithExtension;//$dirPath.$_FILES['file']['name'];
                        $newname = $fileWithExtension;//$_FILES['file']['name'];

                        // Set the resize_image name
                        $resize_image = $dirPath.$newname; 
                        $actual_image = $dirPath.$newname;
                        // It gets the size of the image
                        list( $width,$height ) = getimagesize( $uploadimage );
                        // It makes the new image width of 350
                        if( $width > '600' ){
                            $newwidth = 300;
                            // It makes the new image height of 350
                            //$newheight = 350;
                            if( $ext != 'png' ){
                                $image = imagecreatefromjpeg($dirPath.$fileWithExtension);
                            }else{
                                $image = imagecreatefrompng($dirPath.$fileWithExtension);
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
                
                $testimonialObj->featuredimage = $fileWithExtension;
                $testimonialObj->featuredimageBig = $fileWithExtension1;
                if( !empty($newwidth)){
                    $testimonialObj->width = $newwidth;  
                }else{
                    $testimonialObj->width = '0';
                }
                if( !empty($newheight)){
                    $testimonialObj->height = $newheight;  
                }else{
                    $testimonialObj->height = '0';  
                }
                
            }
            else{
            }
            $testimonialObj->employee_id = Auth::id();

            $testimonialObj->save();
            return redirect('employee/testimonial');
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
                                ->where('alltableinformations.name', '=', 'Testimonial')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                Testimonial::destroy($id);
                Session::flash('flash_message', 'Testimonial deleted!');

                return redirect('employee/testimonial');
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
