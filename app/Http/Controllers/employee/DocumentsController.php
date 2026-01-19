<?php

namespace App\Http\Controllers\employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Document;
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
use App\Models\Category as Category;

class DocumentsController extends Controller
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
                                ->where('alltableinformations.name', '=', 'Document')
                                ->where('userprivileges.index', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                 //GET ACCESS FOR THE UPDATE METHOD
                $validateUserRoleAction = DB::table('users')
                                ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                ->where('users.id', '=', $userId)
                                ->where('alltableinformations.name', '=', 'Document')
                                ->where('userprivileges.index', '=', '1')
                                ->select('userprivileges.edit', 'userprivileges.update')
                                ->orderBy('userprivileges.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
                                   
                $storeEditUpdateAction = $validateUserRoleAction[0]->edit;

                $documents = Document::orderBy('id', 'DESC')
                        ->leftjoin('category', 'documents.category_id', '=', 'category.id')
                        ->leftjoin('users', 'documents.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('users as eID','documents.employee_id', '=','eID.id')
                        ->where('users.userstatus_id','!=','5')
                        ->Paginate(20, array('documents.id', 'documents.name as documentsName', 'documents.users_id','category.name as categoryName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','documents.description','documents.width', 'documents.height','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','documents.updated_at'));

                $collegeProfileObj = DB::table('users')
                            ->leftJoin('userrole', 'users.userrole_id','=','userrole.id')
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname','userrole.id as userRoleId', 'userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ;
                    
                return View::make('employee/documents.index')
                    ->with('documents', $documents)
                    ->with('collegeProfileObj',$collegeProfileObj)
                    ->with('storeEditUpdateAction', $storeEditUpdateAction)
                    ;
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
                                ->where('alltableinformations.name', '=', 'Document')
                                ->where('userprivileges.create', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                $categoryObj = Category::all();
                $userObj = User::all();
                return view('employee/documents.create')
                ->with('userObj', $userObj)
                ->with('categoryObj', $categoryObj);
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
           // Document::create($request->all());
            //Session::flash('flash_message', 'Document added!');
            
            $getSlugUrl = User::where('id', '=', Input::get('users_id'))->firstOrFail();
            //Create slug url
            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getSlugUrl->firstname.' '.$getSlugUrl->id);
            $slugUrl = strtolower($slugUrl);

            if($request->file('uploadCollegeDoc'))
            {            
                $extensionOfFile = '';
                $path = $_FILES['uploadCollegeDoc']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                /*if( $ext != 'png' || $ext != 'jpg' || $ext != 'jpeg' || $ext != 'pdf' ){
                    Session::flash('wrongFileUpload', 'Not valid file extension');
                    return redirect('employee/documents');
                    die;
                }*/
                
                $tempPath = $_FILES[ 'uploadCollegeDoc' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/document/'.$slugUrl.'/';
                }else{
                    $dirPath = public_path().'/document/'.$slugUrl.'/';
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
            
            $documentObj = new Document;
            $documentObj->name= $fileWithExtension;
            $documentObj->fullimage= $fileWithExtension1;
            if( !empty($newwidth)){
                $documentObj->width = $newwidth;  
            }else{
                $documentObj->width = '0';
            }
            if( !empty($newheight)){
                $documentObj->height = $newheight;  
            }else{
                $documentObj->height = '0';  
            }
            $documentObj->description= Input::get('description');
            $documentObj->users_id = Input::get('users_id');
            $documentObj->category_id = '2';
            $documentObj->employee_id = Auth::id(); 
            $documentObj->save();
           
            return redirect('employee/documents');
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
                                ->where('alltableinformations.name', '=', 'Document')
                                ->where('userprivileges.show', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
               //$document = Document::findOrFail($id);
                $document = DB::table('documents')
                            ->leftjoin('category', 'documents.category_id', '=', 'category.id')
                            ->leftjoin('users', 'documents.users_id', '=', 'users.id')
                            ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                            ->leftJoin('users as eID','documents.employee_id', '=','eID.id')
                            ->where('documents.id', '=', $id)
                            ->select('documents.id', 'documents.name as documentsName', 'documents.users_id','category.name as categoryName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','documents.description','documents.height', 'documents.width','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','documents.updated_at')
                             ->orderBy('documents.id', 'DESC')
                            ->get();
                    
                return View::make('employee/documents.show')
                 ->with('document', $document);
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
                                ->where('alltableinformations.name', '=', 'Document')
                                ->where('userprivileges.edit', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
               //$document = Document::leftJoin('users', 'documents.users_id', '=', 'users.id')->where('documents.id', '=' ,$id)->firstOrFail();
                $document = Document::orderBy('documents.id', 'DESC')
                            ->leftJoin('users', 'documents.users_id', '=', 'users.id')
                            ->leftJoin('collegeprofile', 'users.id', '=', 'collegeprofile.users_id')
                            ->select('documents.id', 'documents.name as documentsName', 'documents.fullimage as documentsFullImage','documents.description', 'users.id as usersId', 'collegeprofile.slug')
                            ->orderBy('documents.id', 'ASC')
                            ->findOrFail($id)
                            ;

                //$document = Document::findOrFail($id);
                $categoryObj = Category::all();
                $userObj = User::all();
                return view('employee/documents.edit', compact('document'))
                ->with('userObj', $userObj)
                ->with('categoryObj', $categoryObj);
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
            
            $getSlugUrl = User::where('id', '=', Input::get('users_id'))->firstOrFail();
            //Create slug url
            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getSlugUrl->firstname.' '.$getSlugUrl->id);
            $slugUrl = strtolower($slugUrl);

            $documentObj = Document::findOrFail($id);
            if($request->file('uploadCollegeDoc'))
            {            
                $extensionOfFile = '';
                $path = $_FILES['uploadCollegeDoc']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $ext = strtolower($ext);
                /*if( $ext != 'png' || $ext != 'jpg' || $ext != 'jpeg' || $ext != 'pdf' ){
                    Session::flash('wrongFileUpload', 'Not valid file extension');
                    return redirect('employee/documents');
                    die;
                }*/

                $tempPath = $_FILES[ 'uploadCollegeDoc' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = $slugUrl.'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/document/'.$slugUrl.'/';
                }else{
                    $dirPath = public_path().'/document/'.$slugUrl.'/';
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

                $documentObj->name = $fileWithExtension;
                $documentObj->fullimage = $fileWithExtension1;
                
                $documentObj->width = $newwidth;
                $documentObj->height = $newheight;
            }
            $documentObj->employee_id = Auth::id(); 
            $documentObj->description= Input::get('description');
            $documentObj->users_id = Input::get('users_id');
            $documentObj->save();
            
            return redirect('employee/documents');
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
                                ->where('alltableinformations.name', '=', 'Document')
                                ->where('userprivileges.delete', '=', '1')
                                ->count()
                                ;

            if( $validateUrlUsers >= '1' ){
                Document::destroy($id);
                Session::flash('flash_message', 'Document deleted!');
                return redirect('employee/documents');
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
     * Search users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function documentEmployeeSearch(Request $request)
    {
        $search0 = 'documents.id';
       
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
                
        $documentSearchDataObj = DB::select( DB::raw("SELECT documents.id as documentsID, documents.name as documentsName,documents.fullimage as documentsFullimage, documents.users_id,category.name as categoryName,users.id as userID,users.firstname, users.lastname, userrole.name as userRoleName,documents.description FROM  `documents`
                        LEFT JOIN `category` ON `documents`.`category_id` = `category`.`id`
                        LEFT JOIN `users` ON `documents`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        WHERE  $search0  
                        $search1
                        AND users.userstatus_id != '5'
                        ORDER BY documents.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $documentSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(documents.id) as totalCount FROM  `documents` 
                        LEFT JOIN `category` ON `documents`.`category_id` = `category`.`id`
                        LEFT JOIN `users` ON `documents`.`users_id` = `users`.`id`
                        LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                        WHERE  $search0  
                        $search1
                        AND users.userstatus_id != '5'
                        ORDER BY documents.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($documentSearchDataObj1)){
            $numRecords = $documentSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'documentSearchDataObj' => $documentSearchDataObj,
                    'documentSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $documentSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'documentSearchDataObj' => $documentSearchDataObj,
                    'documentSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $documentSearchDataObj1,
                );
        }

        if( !empty($documentSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allDocumentEmployeeSearch(Request $request){

        $documents = Document::orderBy('documents.id', 'DESC')
                        ->leftjoin('category', 'documents.category_id', '=', 'category.id')
                        ->leftjoin('users', 'documents.users_id', '=', 'users.id')
                        ->leftjoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->where('users.userstatus_id','!=','5')
                        ->select('documents.id as documentsID', 'documents.name as documentsName', 'documents.users_id','category.name as categoryName','users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','documents.description')
                        ->take(20)
                        ->get();
  
        return json_encode($documents);
    }

    public function deleteEmployeeSearchDocument(Request $request, $id)
    {   
        Document::destroy($id);
        return Redirect::back();
    }



}
