<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Gallery;
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
use App\Models\Category;
use App\Models\Album;

class GalleryController extends Controller
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
            
            $gallery = Gallery::orderBy('id', 'DESC')
                        ->leftjoin('category', 'gallery.category_id', '=', 'category.id')
                        ->leftjoin('users', 'gallery.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','gallery.employee_id', '=','eID.id')
                        ->where('gallery.misc', '!=', 'collegeyoutubeurl')
                        ->where('gallery.misc', '!=', 'studentyoutubeurl')
                        ->where('gallery.misc', '!=', 'college-logo-img')
                        ->where('users.userstatus_id','!=','5')
                        ->Paginate(20, array('gallery.id', 'gallery.name as galleryName','caption','width','height', 'category.name as categoryName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','gallery.misc','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','gallery.updated_at'));
            
            $collegeProfileObj = DB::table('users')
                        ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

                return View::make('administrator/gallery.index')
                    ->with('gallery', $gallery)
                    ->with('collegeProfileObj', $collegeProfileObj)
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
            $categoryObj = Category::all();
            $userObj = User::where('users.userstatus_id', '=', '1')->where('users.userrole_id', '=', '2')->get();
            
            return view('administrator/gallery.create')
            ->with('userObj', $userObj)
            ->with('categoryObj', $categoryObj)
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
            
            $getSlugUrl = User::where('id', '=', Input::get('usersName'))->firstOrFail();
            //Create slug url
            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getSlugUrl->firstname.' '.$getSlugUrl->id);
            $slugUrl = strtolower($slugUrl);
            
            
            if($request->file('uploadCollegeImg'))
            {   
                $extensionOfFile = '';
                $path = $_FILES['uploadCollegeImg']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                /*if( $ext != 'png' || $ext != 'jpg' || $ext != 'jpeg' ){
                    Session::flash('wrongFileUpload', 'Not valid file extension');
                    return redirect('administrator/galleries');
                    die;
                }
                */
                $tempPath = $_FILES[ 'uploadCollegeImg' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/gallery/'.$slugUrl.'/';
                }else{
                    $dirPath = public_path().'/gallery/'.$slugUrl.'/';
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

            $galleryObj = new Gallery;
            $galleryObj->name= $fileWithExtension; 
            $galleryObj->fullimage= $fileWithExtension1; 
            $galleryObj->caption = Input::get('caption');
             if( !empty($newwidth)){
                $galleryObj->width = $newwidth;  
            }
            if( !empty($newheight)){
                $galleryObj->height = $newheight;  
            }
            //$galleryObj->width = $newwidth;
            //$galleryObj->height = $newheight;
            $galleryObj->users_id = Input::get('usersName'); 
            $galleryObj->category_id = '1';
            $galleryObj->misc = 'college-upload-gallery-img';
            $galleryObj->employee_id = Auth::id();
            $galleryObj->save();
            return redirect('administrator/galleries');
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
            /*$gallery = Gallery::findOrFail($id);
            return view('administrator/gallery.show', compact('gallery'));*/
             $gallery = DB::table('gallery')
                        ->leftjoin('category', 'gallery.category_id', '=', 'category.id')
                        ->leftjoin('users', 'gallery.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','gallery.employee_id', '=','eID.id')
                        ->where('gallery.id', '=', $id)
                        ->select('gallery.id', 'gallery.name as galleryName', 'caption','width','height','category.name as categoryName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName' ,'gallery.misc','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','gallery.updated_at')
                         ->orderBy('gallery.id', 'DESC')
                        ->get();
                
            return View::make('administrator/gallery.show')
             ->with('gallery', $gallery);
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
            //$gallery = Gallery::leftJoin('users', 'gallery.users_id', '=', 'users.id')->where('gallery.id', '=' ,$id)->firstOrFail();
            // $gallery = Gallery::findOrFail($id);
            $gallery = Gallery::orderBy('gallery.id' ,'DESC')
                            ->leftJoin('users', 'gallery.users_id', '=', 'users.id')
                            ->leftJoin('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                            ->select('gallery.id','users.firstname', 'gallery.name', 'gallery.fullimage as galleryFullImage','gallery.misc','gallery.users_id', 'collegeprofile.slug','caption')
                            ->findOrFail($id)
                            ;
                            
            $categoryObj = Category::all();
            $userObj = User::where('users.userstatus_id', '=', '1')->where('users.userrole_id', '=', '2')->get();
            
            return view('administrator/gallery.edit', compact('gallery'))
            ->with('userObj', $userObj)
            ->with('categoryObj', $categoryObj)
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
           /* $gallery = Gallery::findOrFail($id);
            $gallery->update($request->all());
            Session::flash('flash_message', 'Gallery updated!');*/
            $getSlugUrl = User::where('id', '=', Input::get('usersName'))->firstOrFail();
            //Create slug url
            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getSlugUrl->firstname.' '.$getSlugUrl->id);
            $slugUrl = strtolower($slugUrl);
            
            $galleryObj = Gallery::findOrFail($id);

            if($request->file('uploadCollegeImg'))
            {   
                $extensionOfFile = '';
                $path = $_FILES['uploadCollegeImg']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                /*if( $ext != 'png' || $ext != 'jpg' || $ext != 'jpeg' ){
                    Session::flash('wrongFileUpload', 'Not valid file extension');
                    return redirect('administrator/galleries');
                    die;
                }*/

                $tempPath = $_FILES[ 'uploadCollegeImg' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/gallery/'.$slugUrl.'/';
                }else{
                    $dirPath = public_path().'/gallery/'.$slugUrl.'/';
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

                $galleryObj->name = $fileWithExtension;
                $galleryObj->fullimage = $fileWithExtension1;
                $galleryObj->width = $newwidth;
                $galleryObj->height = $newheight;
                
            }

            $galleryObj->caption = Input::get('caption');
            $galleryObj->category_id = '1';
            $galleryObj->users_id = Input::get('usersName');
            //$galleryObj->misc = 'college-upload-gallery-img';
            $galleryObj->employee_id = Auth::id();
            $galleryObj->save();
            return redirect('administrator/galleries');
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
            Gallery::destroy($id);
            Session::flash('flash_message', 'Gallery deleted!');
            return redirect('administrator/galleries');
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
    public function gallerySearch(Request $request)
    {
        $search0 = 'gallery.id';
       
        if( $request->collegeName != null ){
            $search1 = "AND `users`.`firstname` LIKE  '%".$request->collegeName."%'" ;
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
                
        $gallerySearchDataObj = DB::select( DB::raw("SELECT gallery.id as galleryID, gallery.name as galleryName,gallery.fullimage as galleryFullimage, gallery.users_id,category.name as categoryName,users.id as userID,users.firstname, users.lastname, userrole.name as userRoleName, gallery.caption as galleryCaption,gallery.misc,gallery.updated_at FROM  `gallery`
                        LEFT JOIN `category` ON `gallery`.`category_id` = `category`.`id`
                        LEFT JOIN `users` ON `gallery`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        WHERE  $search0  
                        $search1
                        AND users.userstatus_id != '5'
                        ORDER BY gallery.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $gallerySearchDataObj1 = DB::select( DB::raw("SELECT COUNT(gallery.id) as totalCount FROM  `gallery` 
                        LEFT JOIN `category` ON `gallery`.`category_id` = `category`.`id`
                        LEFT JOIN `users` ON `gallery`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        WHERE  $search0  
                        $search1
                        AND users.userstatus_id != '5'
                        ORDER BY gallery.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($gallerySearchDataObj1)){
            $numRecords = $gallerySearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'gallerySearchDataObj' => $gallerySearchDataObj,
                    'gallerySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $gallerySearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'gallerySearchDataObj' => $gallerySearchDataObj,
                    'gallerySearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $gallerySearchDataObj1,
                );
        }

        if( !empty($gallerySearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allGallerySearch(Request $request){

        $gallery = Gallery::orderBy('gallery.id', 'DESC')
                        ->leftjoin('category', 'gallery.category_id', '=', 'category.id')
                        ->leftjoin('users', 'gallery.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->where('users.userstatus_id','!=','5')
                        ->select('gallery.id as galleryID', 'gallery.name as galleryName','gallery.caption as galleryCaption','width','height', 'category.name as categoryName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','gallery.misc','gallery.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($gallery);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function affiliationAccreditation(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            
            $getSlugUrl = User::where('id', '=', Input::get('usersName'))->firstOrFail();
            //Create slug url
            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getSlugUrl->firstname.' '.$getSlugUrl->id);
            $slugUrl = strtolower($slugUrl);
            
            
            if($request->file('uploadAffiliationLettersImage'))
            {   
                $extensionOfFile = '';
                $path = $_FILES['uploadAffiliationLettersImage']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);

                /*if( $ext != 'png' || $ext != 'jpg' || $ext != 'jpeg' ){
                    Session::flash('wrongFileUpload', 'Not valid file extension');
                    return redirect('administrator/galleries');
                    die;
                }
                */
                $tempPath = $_FILES[ 'uploadAffiliationLettersImage' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/gallery/'.$slugUrl.'/';
                }else{
                    $dirPath = public_path().'/gallery/'.$slugUrl.'/';
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

            $galleryObj = new Gallery;
            $galleryObj->name= $fileWithExtension; 
            $galleryObj->fullimage= $fileWithExtension1; 
            $galleryObj->caption = Input::get('caption');
            if( !empty($newwidth)){
                $galleryObj->width = $newwidth;  
            }
            if( !empty($newheight)){
                $galleryObj->height = $newheight;  
            }
           // $galleryObj->height = $newheight;
            $galleryObj->users_id = Input::get('usersName'); 
            $galleryObj->category_id = '1';
            $galleryObj->misc = 'affiliationLettersImage';
            $galleryObj->employee_id = Auth::id();
            $galleryObj->save();

            return redirect('administrator/galleries');
        }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function deleteSearchGallery(Request $request, $id)
    {   
        Gallery::destroy($id);
        return Redirect::back();
    }

    public function youtubeLink(Request $request)
    {
        //GET OLD YOUTUBE LINKS
        $oldYoutubeLink1 = DB::table('gallery')
                            ->leftJoin('users as eID','gallery.employee_id', '=','eID.id')
                            ->where('gallery.misc', '=', 'studentyoutubeurl')
                            ->select('gallery.id','name', 'misc','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','gallery.updated_at')
                            ->get()
                            ;

        $oldYoutubeLink2 = DB::table('gallery')
                            ->leftJoin('users as eID','gallery.employee_id', '=','eID.id')
                            ->where('gallery.misc', '=', 'collegeyoutubeurl')
                            ->select('gallery.id','name', 'misc','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','gallery.updated_at')
                            ->get()
                            ;
                            

        return view('administrator/gallery.youtubelink')
                ->with('oldYoutubeLink1', $oldYoutubeLink1)
                ->with('oldYoutubeLink2', $oldYoutubeLink2)
                ;
    }

    public function updateYoutubeLink(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                
            if( !empty(Input::get('youtubesection')) ){
                $galleryObj = Gallery::where('gallery.misc', '=', Input::get('youtubesection'))->orderBy('gallery.id','=','DESC')->first();
                 if( !empty($galleryObj) ){
                    $galleryObj->name= Input::get('youtubeurl'); 
                    $galleryObj->fullimage= Input::get('youtubeurl'); 
                    $galleryObj->caption = 'Youtube Link Update';
                    $galleryObj->misc = Input::get('youtubesection'); 
                    $galleryObj->users_id = $userId;
                    $galleryObj->employee_id = Auth::id();
                    $galleryObj->save();

                 }else{
                    $galleryObj = new Gallery;
                    $galleryObj->name= Input::get('youtubeurl'); 
                    $galleryObj->fullimage= Input::get('youtubeurl'); 
                    $galleryObj->caption = 'Youtube Link Update';
                    $galleryObj->misc = Input::get('youtubesection'); 
                    $galleryObj->users_id = $userId;
                    $galleryObj->employee_id = Auth::id();
                    $galleryObj->save();
                 }
               
            }else{
               
                $galleryObj = new Gallery;
                $galleryObj->name= Input::get('youtubeurl'); 
                $galleryObj->fullimage= Input::get('youtubeurl'); 
                $galleryObj->caption = 'Youtube Link Update';
                $galleryObj->misc = Input::get('youtubesection'); 
                $galleryObj->users_id = $userId;
                $galleryObj->employee_id = Auth::id();
                $galleryObj->save();
            }

            Session::flash('successUpdateYoutube','Your youtube link has been update successfully.'); 
            return redirect('administrator/youtube');
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
