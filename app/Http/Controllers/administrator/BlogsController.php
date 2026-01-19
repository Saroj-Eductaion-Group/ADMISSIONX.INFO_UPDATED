<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Blog;
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

class BlogsController extends Controller
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

        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $blogs = Blog::orderBy('blogs.id', 'DESC')
                        ->join('users', 'blogs.users_id', '=', 'users.id')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','blogs.employee_id', '=','eID.id')
                        ->paginate(20, array('blogs.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','blogs.topic', 'blogs.description', 'blogs.isactive','blogs.featimage','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','blogs.updated_at'))
                        ;

            $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName','users.middlename','users.lastname')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

            return view('administrator/blogs.index', compact('blogs'))
            ->with('usersObj',$usersObj);
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
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;
            return view('administrator/blogs.create')
             ->with('usersObj', $usersObj);
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
        
            if($request->file('uploadFeatureImage'))
            {   
                $blogsObj = New Blog;
                $blogsObj->topic = Input::get('topic');
                $blogsObj->description = Input::get('description');
                $blogsObj->isactive = Input::get('isactive');
                $blogsObj->users_id = Input::get('users_id');
                
                //GET THE LAST CREATED ID
                $getLastID = DB::table('blogs')->select('id')->orderBy('id', 'DESC')->get();
                if( empty($getLastID)  ){
                    $totalIDNumber = '1';
                }else{
                    $totalIDNumber = $getLastID[0]->id + 1;
                }
                $slugUrl = str_slug(Input::get('topic').' '.$totalIDNumber, "-");
                $blogsObj->slug = str_slug($slugUrl, "-");
                

                $extensionOfFile = '';
                $path = $_FILES['uploadFeatureImage']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);

                $tempPath = $_FILES[ 'uploadFeatureImage' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/blogs/';
                }else{
                    $dirPath = public_path().'/blogs/';
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

                
                $blogsObj->featimage = $fileWithExtension;
                $blogsObj->fullimage = $fileWithExtension1;
                $blogsObj->width = round($newwidth);
                $blogsObj->height = round($newheight);
                $blogsObj->employee_id = Auth::id();

                $blogsObj->save();
                            
            }else{
                $blogsObj = New Blog;
                $blogsObj->topic = Input::get('topic');
                $blogsObj->description = Input::get('description');
                $blogsObj->isactive = Input::get('isactive');
                $blogsObj->users_id = Input::get('users_id');
                                
                //GET THE LAST CREATED ID
                $getLastID = DB::table('blogs')->select('id')->orderBy('id', 'DESC')->get();
                if( empty($getLastID)  ){
                    $totalIDNumber = '1';
                }else{
                    $totalIDNumber = $getLastID[0]->id + 1;
                }
                $slugUrl = str_slug(Input::get('topic').' '.$totalIDNumber, "-");
                $blogsObj->slug = str_slug($slugUrl, "-");
                $blogsObj->employee_id = Auth::id();
                $blogsObj->save();
            }


            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($blogsObj->id, $request->all());
                

            Session::flash('flash_message', 'Blog added!');
            return redirect('administrator/blogs');
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
            $blog = Blog::orderBy('blogs.id', 'ASC')
                    ->join('users', 'blogs.users_id', '=', 'users.id')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->leftJoin('users as eID','blogs.employee_id', '=','eID.id')
                    ->select('blogs.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName', 'blogs.topic', 'blogs.description', 'blogs.isactive','blogs.featimage','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','blogs.updated_at')
                    ->findOrFail($id)
                    ;

            $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.blogId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.blogId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();

            return view('administrator/blogs.show', compact('blog','seocontent'));
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
            $blog = Blog::findOrFail($id);
            $usersObj = DB::table('users')
                        ->join('userrole', 'users.userrole_id','=','userrole.id')
                        ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                        ->orderBy('users.id','ASC')
                        ->get()
                        ;

            $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                ->where('seo_contents.blogId','=', $id)
                ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId','examSectionId')
                ->get();
            return view('administrator/blogs.edit', compact('blog','seocontent')) 
            ->with('usersObj', $usersObj);
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
            /*$blog = Blog::findOrFail($id);
            $blog->update($request->all());*/

                $blogsObj = Blog::findOrFail($id);
                $blogsObj->topic = Input::get('topic');
                $blogsObj->description = Input::get('description');
                $blogsObj->isactive = Input::get('isactive');
                $blogsObj->users_id = Input::get('users_id');
                $blogsObj->employee_id = Auth::id();
                                
                //GET THE LAST CREATED ID
                $getLastID = DB::table('blogs')
                            ->select('slug')
                            ->where('blogs.id','=', $id)
                            ->orderBy('id', 'DESC')
                            ->get();

                $slugUrl = $getLastID[0]->slug;

                if($request->file('uploadFeatureImage'))
                {                
                    $extensionOfFile = '';
                    $path = $_FILES['uploadFeatureImage']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    $tempPath = $_FILES[ 'uploadFeatureImage' ][ 'tmp_name' ];
                    $currentMyTime = strtotime('now');
                    $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                    $fileWithExtension = $imageNameWithTime.'.'.$ext;
                    $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
                 
                    //Set the image folder path
                    if(env('APP_ENV') == 'local'){
                       $dirPath = public_path().'/blogs/';
                    }else{
                        $dirPath = public_path().'/blogs/';
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

                    $blogsObj->featimage = $fileWithExtension;
                    $blogsObj->fullimage = $fileWithExtension1;
                    $blogsObj->width = round($newwidth);
                    $blogsObj->height = round($newheight);
                }
                
            $blogsObj->save();

            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());
            
            Session::flash('flash_message', 'Blog updated!');
            return redirect('administrator/blogs');
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
            ->where('seo_contents.blogId', '=', $id)
            ->delete();
            
            Blog::destroy($id);
            Session::flash('flash_message', 'Blog deleted!');
            return redirect('administrator/blogs');
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
    public function blogsSearch(Request $request)
    {
        $search0 = 'blogs.id';
       
        if( $request->collegeName != null ){
            $search1 = "AND `users`.`firstname` LIKE  '%".$request->collegeName."%'" ;
        }else{
            $search1 =  '';
        }

        if( $request->topic != null ){
            $search2 = "AND `blogs`.`topic` LIKE  '%".$request->topic."%'";
        }else{
            $search2 =  '';
        }

        if( $request->isactive != '' ){
            $search3 = " AND `blogs`.`isactive` LIKE  '%".$request->isactive."%'";           
        }else{
            $search3 = '';
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
                
        $blogsSearchDataObj = DB::select( DB::raw("SELECT blogs.id as blogsId, users.id as userID,users.firstname, users.lastname, userrole.name as userRoleName,blogs.topic, blogs.description, blogs.isactive,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,blogs.updated_at FROM  `blogs`
                         LEFT JOIN `users` ON `blogs`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `blogs`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        ORDER BY blogs.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $blogsSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(blogs.id) as totalCount FROM  `blogs` 
                        LEFT JOIN `users` ON `blogs`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        LEFT JOIN `users` as `eID` ON `blogs`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        $search3
                        ORDER BY blogs.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($blogsSearchDataObj1)){
            $numRecords = $blogsSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'blogsSearchDataObj' => $blogsSearchDataObj,
                    'blogsSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $blogsSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'blogsSearchDataObj' => $blogsSearchDataObj,
                    'blogsSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $blogsSearchDataObj1,
                );
        }

        if( !empty($blogsSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allBlogsSearch(Request $request){

         $blogs = Blog::orderBy('blogs.id', 'DESC')
                        ->join('users', 'blogs.users_id', '=', 'users.id')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','blogs.employee_id', '=','eID.id')
                        ->select('blogs.id as blogsId', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','blogs.topic', 'blogs.description', 'blogs.isactive','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','blogs.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($blogs);
    }

    public function deleteSearchBlog(Request $request, $id)
    {   
        Blog::destroy($id);
        return Redirect::back();
    }

}
