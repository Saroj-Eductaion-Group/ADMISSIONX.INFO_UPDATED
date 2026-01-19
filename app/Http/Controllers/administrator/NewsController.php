<?php
namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\News;
use Illuminate\Http\Request;
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
Use Image;
use Config;
use Storage;
use DateTime;
use DateTimeZone;
use PDF;
use File;
use Artisan;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;
use App\Models\NewsType;
use App\Models\NewsTag;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class NewsController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('News');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
           
                $keyword = $request->get('search');
                $perPage = 25;

                $query = News::orderBy('news.id', 'DESC')
                        ->leftJoin('users', 'news.users_id', '=', 'users.id')
                        ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('news_types', 'news.newstypeids', '=', 'news_types.id');

                if ($request->has('userId')) {
                    $query->where('users.id', '=', Input::get('userId'));
                }

                if (!empty(Input::get('startdate'))) {
                    $query->where('news.created_at', '>=', ''. date('Y-m-d', strtotime(Input::get('startdate'))) . '');
                }

                if (!empty(Input::get('enddate'))) {
                    $query->where('news.created_at', '<=', '' . date('Y-m-d', strtotime(Input::get('enddate'))) . '');
                }

                if ($request->has('status')) {
                    $query->where('news.isactive', '=', Input::get('status'));
                }

                if ($request->has('newstypeids')) {
                    $query->where('news.newstypeids', '=', Input::get('newstypeids'));
                }


                /*if ($request->has('newstagsids')) {
                   $newstagsidsIDS = array();
                    $allTechs[] = $request->get('newstagsids');
                    foreach($allTechs as $key ) {
                        $newstagsidsIDS = $key;  

                    }
                    if(!empty($newstagsidsIDS)){
                        $storeTechID = implode (',',$newstagsidsIDS);  
                    }
                    $query->whereRaw('news.newstagsids IN ('.$storeTechID.')');                    
                }*/

                if ($request->has('newstagsids')) {
                   $newstagsidsIDS = array();
                    $allTechs[] = $request->get('newstagsids');
                    foreach($allTechs as $key ) {
                        $newstagsidsIDS = $key;  

                    }
                    if(!empty($newstagsidsIDS)){
                        $storeTechID = implode (',',$newstagsidsIDS);  
                    }
                    $query->whereRaw("find_in_set('$storeTechID',news.newstagsids)");
                }

                // if (!empty(Input::get('newstagsids'))) {
                //     $newstagsidsString = implode(',', Input::get('newstagsids'));
                //     $query->whereIn('news.newstagsids', [$newstagsidsString]);
                // }

                if (!empty(Input::get('topic'))) {
                    $query->where('news.topic', 'LIKE', '%'.Input::get('topic').'%');
                }

                $news = $query->paginate(20, array('news.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','news.topic', 'news.description', 'news.isactive','news.featimage','news_types.name as news_typesname','newstagsids','newstypeids'));
                $tags = [];
                foreach ($news as $key => $value) {
                    if (!empty($value->newstagsids)) {
                        $tags = DB::select(DB::raw("SELECT news_tags.name, slug FROM news_tags where news_tags.id IN ($value->newstagsids)"));
                    }
                    $value->tagname = $tags;
                }
               /* echo "<pre>";
                print_r($news);die;*/
                
                $usersObj = DB::table('users')
                            ->leftjoin('userrole', 'users.userrole_id','=','userrole.id')
                            ->where('users.userstatus_id', '=', 1)
                            ->where('users.userrole_id', '=', 1)
                            ->select('users.id as UserID', 'users.firstName', 'users.lastName', 'userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ;

                $newsTypeObj = DB::table('news_types')->orderBy('name', 'ASC')->get();
                $newsTagObj = DB::table('news_tags')->orderBy('name', 'ASC')->get();
               

                return view('administrator/news.index', compact('news','newsTypeObj','newsTagObj'))
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
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('News');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                $usersObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->where('users.userstatus_id', '=', 1)
                            ->where('users.userrole_id', '=', 1)
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ;

                $newsTypeObj = DB::table('news_types')->orderBy('name', 'ASC')->get();
                $newsTagObj = DB::table('news_tags')->orderBy('name', 'ASC')->get();

                 return view('administrator/news.create', compact('newsTypeObj','newsTagObj'))
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
         if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                if(empty(Input::get('description'))):
                    Session::flash('alert_class', 'alert-danger');  
                    Session::flash('flash_message', 'Please enter the description..');
                    return Redirect::back();
                endif;

                $newstagsids = Input::get('newstagsids');
                if (!empty($newstagsids)) {
                    $arrSelectedForms       = [];
                    $arrSelectedForms1 []   = array_unique($newstagsids);

                    foreach ($arrSelectedForms1[0] as $key => $value) {
                        $arrSelectedForms [] = $value;
                    }

                    $sForms = implode(',', $arrSelectedForms);
                }else{
                    $sForms = '';
                }


                if($request->file('uploadFeatureImage'))
                {   
                    $newsObj = New News;
                    $newsObj->topic = Input::get('topic');
                    $newsObj->description = Input::get('description');
                    $newsObj->isactive = Input::get('isactive');
                    $newsObj->users_id = Input::get('users_id');
                    $newsObj->newstypeids = Input::get('newstypeids');
                    $newsObj->newstagsids = $sForms;
                    
                    //GET THE LAST CREATED ID
                    $getLastID = DB::table('news')->select('id')->orderBy('id', 'DESC')->get();
                    if(sizeof($getLastID) > 0){
                        $totalIDNumber = $getLastID[0]->id + 1;
                    }else{
                        $totalIDNumber = '1';
                    }
                    $slugUrl = str_slug(Input::get('topic').' '.$totalIDNumber, "-");
                    $newsObj->slug = str_slug($slugUrl, "-");
                    

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
                       $dirPath = public_path().'/news-image/';
                    }else{
                        $dirPath = public_path().'/news-image/';
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

                    $newsObj->featimage = $fileWithExtension;
                    $newsObj->fullimage = $fileWithExtension1;
                    $newsObj->width = round($newwidth);
                    $newsObj->height = round($newheight);
                
                    $newsObj->save();                
                }else{
                    $newsObj = New News;
                    $newsObj->topic = Input::get('topic');
                    $newsObj->description = Input::get('description');
                    $newsObj->isactive = Input::get('isactive');
                    $newsObj->users_id = Input::get('users_id');
                    $newsObj->newstypeids = Input::get('newstypeids');
                    $newsObj->newstagsids = $sForms;                                    
                    //GET THE LAST CREATED ID
                    $getLastID = DB::table('news')->select('id')->orderBy('id', 'DESC')->get();
                    if( empty($getLastID)  ){
                        $totalIDNumber = '1';
                    }else{
                        $totalIDNumber = $getLastID[0]->id + 1;
                    }
                    $slugUrl = str_slug(Input::get('topic').' '.$totalIDNumber, "-");
                    $newsObj->slug = str_slug($slugUrl, "-");
                    
                    $newsObj->save();
                }

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($newsObj->id, $request->all());
                Artisan::call('cache:clear');
                Session::flash('flash_message', 'News added!');
                return redirect($this->fetchDataServiceController->routeCall().'/news');
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
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('News');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                $news = News::orderBy('news.id', 'ASC')
                        ->join('users', 'news.users_id', '=', 'users.id')
                        ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                        ->leftJoin('news_types', 'news.newstypeids', '=', 'news_types.id')
                        ->select('news.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName', 'news.topic', 'news.description', 'news.isactive','news.featimage','news_types.name as news_typesname','newstagsids','newstypeids')
                        ->findOrFail($id)
                        ;
                $tags = [];
                if (!empty($news->newstagsids)) {
                    $tags = DB::select(DB::raw("SELECT news_tags.name FROM news_tags where news_tags.id IN ($news->newstagsids)"));
                }


                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.newsId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.newsId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();
                
                return view('administrator/news.show', compact('news','tags','seocontent'));
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }

        if( Auth::check() ){
           
        }else{
            Auth::logout();
            return Redirect::to('/login');
        }    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('News');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                
                $news = News::findOrFail($id);
                $usersObj = DB::table('users')
                            ->join('userrole', 'users.userrole_id','=','userrole.id')
                            ->where('users.userstatus_id', '=', 1)
                            ->where('users.userrole_id', '=', 1)
                            ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                            ->orderBy('users.id','ASC')
                            ->get()
                            ;
                $newsTypeObj = DB::table('news_types')->orderBy('name', 'ASC')->get();
                $newsTagObj = DB::table('news_tags')->orderBy('name', 'ASC')->get();

                $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                    ->where('seo_contents.newsId','=', $id)
                    ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','newsId','examSectionId')
                    ->get();

                return view('administrator/news.edit', compact('news','newsTypeObj','newsTagObj','seocontent')) 
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                if(empty(Input::get('description'))):
                    Session::flash('alert_class', 'alert-danger');  
                    Session::flash('flash_message', 'Please enter the description..');
                    return Redirect::back();
                endif;

                $newstagsids = Input::get('newstagsids');
                if (!empty($newstagsids)) {
                    $arrSelectedForms       = [];
                    $arrSelectedForms1 []   = array_unique($newstagsids);

                    foreach ($arrSelectedForms1[0] as $key => $value) {
                        $arrSelectedForms [] = $value;
                    }

                    $sForms = implode(',', $arrSelectedForms);
                }else{
                    $sForms = '';
                }

                $newsObj = News::findOrFail($id);
                $newsObj->topic = Input::get('topic');
                $newsObj->description = Input::get('description');
                $newsObj->isactive = Input::get('isactive');
                $newsObj->users_id = Input::get('users_id');
                $newsObj->newstypeids = Input::get('newstypeids');
                $newsObj->newstagsids = $sForms;
                
                //$slugUrl = str_slug(Input::get('topic').' '.$id, "-");
                //$newsObj->slug = str_slug($slugUrl, "-");
                //GET THE LAST CREATED ID
                $getLastID = DB::table('news')
                            ->select('slug')
                            ->where('news.id','=', $id)
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
                       $dirPath = public_path().'/news-image/';
                    }else{
                        $dirPath = public_path().'/news-image/';
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

                    $newsObj->featimage = $fileWithExtension;
                    $newsObj->fullimage = $fileWithExtension1;
                    $newsObj->width = round($newwidth);
                    $newsObj->height = round($newheight);
                }
                
                $newsObj->save();

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());

                /*$requestData = $request->all();
                $blog = News::findOrFail($id);*/
                Artisan::call('cache:clear');
                Session::flash('flash_message', 'News updated!');
                return redirect($this->fetchDataServiceController->routeCall().'/news');
            
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('News');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
            if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                DB::table('seo_contents')
                        ->where('seo_contents.newsId', '=', $id)
                        ->delete();
                        
                News::destroy($id);
                Session::flash('flash_message', 'Blog deleted!');
                return redirect($this->fetchDataServiceController->routeCall().'/news');

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
