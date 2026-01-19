<?php

namespace App\Http\Controllers\administrator;

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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            //$testimonial = Testimonial::paginate(15);
            $testimonial = Testimonial::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','testimonials.employee_id', '=','eID.id')
                        ->paginate(15, array('testimonials.id', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','testimonials.updated_at'));
                        
            return view('administrator/testimonial.index', compact('testimonial'));
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $userObj = User::all();
            return view('administrator/testimonial.create')
            ->with('userObj', $userObj);
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
           /* Testimonial::create($request->all());
            Session::flash('flash_message', 'Testimonial added!');
            return redirect('administrator/testimonial');*/

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
                    //     return redirect('administrator/testimonial');
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
                $testimonialObj->slug =  str_slug(Input::get('author'), "-");
                $testimonialObj->employee_id = Auth::id();
                $testimonialObj->save();
            }
            else{
            }
           
            return redirect('administrator/testimonial');
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            //$testimonial = Testimonial::findOrFail($id);
            $testimonial = Testimonial::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','testimonials.employee_id', '=','eID.id')
                        ->leftJoin('users', 'testimonials.author','=','users.id')
                        ->select('testimonials.id', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','testimonials.updated_at')
                       ->findOrFail($id)
                        ;

            return view('administrator/testimonial.show', compact('testimonial'));
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $testimonial = Testimonial::findOrFail($id);
            $userObj = User::all();

            return view('administrator/testimonial.edit', compact('testimonial'))
            ->with('userObj', $userObj);
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
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
                    //     return redirect('administrator/testimonial');
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
            return redirect('administrator/testimonial');
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
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            Testimonial::destroy($id);
            Session::flash('flash_message', 'Testimonial deleted!');

            return redirect('administrator/testimonial');
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
