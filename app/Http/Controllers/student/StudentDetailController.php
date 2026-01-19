<?php

namespace App\Http\Controllers\student;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
use PHPMailer;
use Session;
use DateTime;
use App\User;
use Illuminate\Database\QueryException as QueryException;
use App\Models\Country as Country;
use App\Models\State as State;
use App\Models\CollegeType as CollegeType;
use App\Models\City as City;
use App\Models\Address as Address;
use App\Models\Gallery as Gallery;
use App\Models\Document as Document;
use App\Models\AddressType as AddressType;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\StudentProfile as StudentProfile;
use App\Models\Category as Category;
use App\Models\StudentMark as StudentMark;
use App\Models\Application as Application;
use App\Models\ApplicationStatusMessage;
use Jenssegers\Agent\Agent;
use App\Models\CollegeReview;
use App\Models\ExamCounsellingForm;
use App\Models\Entranceexam;
use App\Http\Controllers\Helper\FetchDataServiceController;

class StudentDetailController extends Controller
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

        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;

             if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                
                $getStudentNameObj = DB::table('studentprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('studentprofile.users_id', '=','users.id')
                                            ->where('studentprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->where('studentprofile.slug', '=', $slugUrl)
                                    ->where('users.id', '=', $userId)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId', 'users.firstname', 'users.phone as userPhoneNo', 'users.email', 'studentprofile.id as studentprofileId','studentprofile.slug','users.middlename', 'users.lastname')
                                    ->take(1)
                                    ->get()
                                    ;
                if( empty($getStudentNameObj) ){
                    $getStudentNameObj = '';
                }

                $studentDataObj = DB::table('studentprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('studentprofile.users_id', '=','users.id')
                                            ->where('studentprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->leftJoin('gallery','users.id','=','gallery.users_id')
                                    ->where('studentprofile.slug', '=', $slugUrl)
                                    ->where('gallery.caption', '=', 'Student Profile Picture')
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone','studentprofile.gender', 'studentprofile.dateofbirth', 'studentprofile.parentsname', 'studentprofile.parentsnumber', 'studentprofile.hobbies', 'studentprofile.interests', 'studentprofile.achievementsawards', 'studentprofile.projects', 'studentprofile.entranceexamname', 'studentprofile.entranceexamnumber', 'studentprofile.isverifiedage','gallery.id as galleryId','gallery.name as galleryName', 'gallery.fullimage as galleryFullImage')
                                    ->orderBy('studentprofile.id', 'ASC')
                                    ->take(1)
                                    ->get()
                                    ;

              
                if( empty($studentDataObj) ){
                    $studentDataObj = '';
                }

                $studentDOBDataObj = DB::table('studentprofile')
                                    ->leftJoin('users', function ($join) use ($userId) {
                                        $join->on('studentprofile.users_id', '=','users.id')
                                            ->where('studentprofile.users_id', '=', DB::raw($userId)
                                            );  
                                        })
                                    ->where('studentprofile.slug', '=', $slugUrl)
                                    ->where('users.userstatus_id', '!=', '5')
                                    ->select('users.id as usersId', 'users.phone as userPhone', 'studentprofile.dateofbirth','studentprofile.slug')
                                    ->orderBy('studentprofile.id', 'ASC')
                                    ->take(1)
                                    ->get()
                                    ;

                if( empty($studentDOBDataObj) ){
                    $studentDOBDataObj = '';
                }


                $currentDateTime = date("Y-m-d"); 
                $verifyStudentAge = $studentDOBDataObj[0]->dateofbirth; 

                if ($studentDOBDataObj[0]->dateofbirth != '0000-00-00') {
                        $bday = new DateTime($verifyStudentAge); 
                        $today = new DateTime($currentDateTime);
                        $diff = $today->diff($bday); 
                        $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';
                }else{
                    $calculateDate = '';
                }

                $getAddressData = DB::table('studentprofile')
                                    ->leftJoin('address', 'studentprofile.id', '=', 'address.studentprofile_id')
                                    ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')
                                    ->leftJoin('city', 'address.city_id', '=', 'city.id')    
                                    ->leftJoin('state', 'city.state_id', '=', 'state.id')
                                    ->leftJoin('country', 'state.country_id', '=', 'country.id')
                                    ->where('studentprofile.slug', '=', $slugUrl)
                                    ->whereIn('address.addresstype_id', [3,4])
                                    ->select('studentprofile.id', 'address.id as adressID', 'address.name', 'address.address1', 'address.address2', 'addresstype.id as addresstypeId','addresstype.name as addresstypeName', 'city.name as cityName', 'state.name as stateName', 'country.name as countryName', 'address.postalcode')
                                    ->orderBy('address.id', 'ASC')
                                    ->take(2)
                                    ->get()
                                    ;
                if( empty($getAddressData) ){
                    $getAddressData = '';
                }

                $getStudentmarksListCount = DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->join('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->count()
                                        ;

                if( empty($getStudentmarksListCount) ){
                                    $getStudentmarksListCount = '';
                                }

                $getStudentmarksObj = DB::table('studentprofile')
                                        ->leftJoin('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('studentmarks','studentprofile.id','=','studentmarks.studentprofile_id')
                                        ->leftJoin('category','studentmarks.category_id','=','category.id')
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentmarks.id as studentmarksId', 'studentmarks.id as studentmarksIdValue', 'category.id as categoryId', 'category.name as categoryName','studentmarks.marks','studentmarks.name as marksName','studentmarks.percentage','studentprofile.id as studentprofileID','studentMarkType')
                                        ->get()
                                        ;

                foreach ($getStudentmarksObj as $value) {
                    //$value->studentmarksIdValue = self::encryptIt($value->studentmarksIdValue);
                    $value->studentmarksIdValue = \Illuminate\Support\Facades\Crypt::encrypt($value->studentmarksIdValue);
                }
                if( empty($getStudentmarksObj) ){
                    $getStudentmarksObj = '';
                }

                $getApplicationsCount = Application::orderBy('application.id', 'DESC')
                                        ->where('application.users_id', '=', Auth::id())
                                        ->count();

                $getCollegeBookmarkCount = DB::table('bookmarks')
                                        ->where('bookmarks.student_id', '=', Auth::id())
                                        ->where('bookmarks.bookmarktypeinfo_id', '=', 1)
                                        ->orderBy('bookmarks.id', 'DESC')
                                        ->count();

                $getCoursesBookmarkCount = DB::table('bookmarks')
                                        ->where('bookmarks.student_id', '=', Auth::id())
                                        ->where('bookmarks.bookmarktypeinfo_id', '=', 2)
                                        ->orderBy('bookmarks.id', 'DESC')
                                        ->count();

                $getBlogBookmarkCount = DB::table('bookmarks')
                                        ->where('bookmarks.student_id', '=', Auth::id())
                                        ->where('bookmarks.bookmarktypeinfo_id', '=', 3)
                                        ->orderBy('bookmarks.id', 'DESC')
                                        ->count();

                $conditionQuery = "replied','pending";
                $getQueriesCount =  DB::table('query')
                                        ->where('query.student_id', '=', Auth::id())
                                        ->where('query.admin_id', '=', '0')
                                        ->whereRaw("query.querytypeinfo IN ('".$conditionQuery."')")
                                        ->groupBy('query.chatkey')
                                        ->orderBy('query.id', 'DESC')
                                        ->count();

                $agent = new Agent();
                return view('student/dashboard.index', compact('agent','getApplicationsCount','getCollegeBookmarkCount','getCoursesBookmarkCount','getBlogBookmarkCount','getQueriesCount'))
                        ->with('slugUrl', $request->slug)
                        ->with('getStudentNameObj', $getStudentNameObj)
                        ->with('studentDataObj', $studentDataObj)
                        ->with('getAddressData', $getAddressData)
                        ->with('getStudentmarksListCount', $getStudentmarksListCount)
                        ->with('getStudentmarksObj', $getStudentmarksObj)
                        ->with('calculateDate', $calculateDate)
                        ->with('studentDOBDataObj', $studentDOBDataObj)
                        ;

                        //ADD NEW COLLEGE INFORMATION INTO COLLEGE MASTER
                
               
            }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
                }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }


    public function uploadStudentPicture(Request $request)
    {   
        if($request->file('uploadStudentPic'))
        {    
            if( $_FILES["uploadStudentPic"]["size"] <= '7340032' ){        
            $extensionOfFile = '';
            $path = $_FILES['uploadStudentPic']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            $tempPath = $_FILES[ 'uploadStudentPic' ][ 'tmp_name' ];
            $currentMyTime = strtotime('now');
            $imageNameWithTime = Input::get('slugUrl').'-'.$currentMyTime;
            $fileWithExtension = $imageNameWithTime.'.'.$ext;
            $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
         
            //Set the image folder path
            if(env('APP_ENV') == 'local'){
               $dirPath = public_path().'/gallery/'.Input::get('slugUrl').'/';
            }else{
                $dirPath = public_path().'/gallery/'.Input::get('slugUrl').'/';
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

            if( !empty(Input::get('galleryId')) ){
                $galleryObj = Gallery::findOrFail(Input::get('galleryId'));

                //UNLINK THE PREVIOUS IMAGE                
                //unlink($dirPath.$galleryObj->name);
               // unlink($dirPath.$galleryObj->fullimage);                

                $galleryObj->name = $fileWithExtension;
                $galleryObj->fullimage = $fileWithExtension1;
                $galleryObj->caption = 'Student Profile Picture';
                $galleryObj->width = round($newwidth);
                $galleryObj->height = round($newheight);
                $galleryObj->users_id = Auth::Id(); 
                $galleryObj->category_id = '3';
                $galleryObj->employee_id = Auth::id();
                $galleryObj->save();
            }else{
                $galleryObj = new Gallery;

                $galleryObj->name = $fileWithExtension;
                $galleryObj->fullimage = $fileWithExtension1;
                $galleryObj->caption = 'Student Profile Picture';
                $galleryObj->width = round($newwidth);
                $galleryObj->height = round($newheight);
                $galleryObj->users_id = Auth::Id(); 
                $galleryObj->category_id = '3';
                $galleryObj->employee_id = Auth::id();
                $galleryObj->save();
            }
        }else{

        }
            
            return redirect()->route('student_dash', Input::get('slugUrl'));
        }
        return redirect()->route('student_dash', Input::get('slugUrl'));
    }

    public function deleteStudentPic(Request $request, $galleryId, $slugUrl)
    {   
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/gallery/'.$slugUrl.'/';
        }else{
            $dirPath = public_path().'/gallery/'.$slugUrl.'/';
        }

        $galleryObj = Gallery::findOrFail($galleryId);

        //UNLINK THE PREVIOUS IMAGE                
        if( !empty($galleryObj->fullimage) ){
            unlink($dirPath.$galleryObj->name);
            unlink($dirPath.$galleryObj->fullimage);    
        }

        Gallery::destroy($galleryId);
    
        return redirect()->route('student_dash', $slugUrl);
    }

    public function profileStudentPartial(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
  
                try {
                    $studentDataObj = DB::table('studentprofile')
                            ->leftJoin('users', function ($join) use ($userId) {
                            $join->on('studentprofile.users_id', '=','users.id')
                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                );  
                            })
                            ->where('studentprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone','studentprofile.gender', 'studentprofile.dateofbirth', 'studentprofile.parentsname', 'studentprofile.parentsnumber', 'studentprofile.hobbies', 'studentprofile.interests', 'studentprofile.achievementsawards', 'studentprofile.projects', 'studentprofile.entranceexamname', 'studentprofile.entranceexamnumber', 'studentprofile.isverifiedage','studentprofile.slug')
                            ->orderBy('studentprofile.id', 'ASC')
                            ->take(1)
                            ->get()
                            ;

                        if( empty($studentDataObj) ){
                            $studentDataObj = '';
                        }

                        $entranceExamObj = DB::table('entranceexam')
                            ->orderBy('entranceexam.name', 'ASC')
                            ->get()
                            ;

                        $currentDateTime = date("Y-m-d"); 
                        $verifyStudentAge = $studentDataObj[0]->dateofbirth; 

                        if ($studentDataObj[0]->dateofbirth != '0000-00-00') {
                                $bday = new DateTime($verifyStudentAge); 
                                $today = new DateTime($currentDateTime);
                                $diff = $today->diff($bday); 
                                $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';
                        }else{
                            $calculateDate = '';
                        }
                        
                   
                } catch ( \Exception $e) {
                    // Auth::logout();
                    // return redirect('login');
                }
               
                $addressType = DB::table('addresstype')
                            ->orderBy('addresstype.name', 'ASC')
                            ->get()
                            ;

                $htmlBlock = view('student/dashboard.profilePartial')
                        ->with('studentDataObj', $studentDataObj)
                        ->with('addressType', $addressType)
                        ->with('currentDateTime', $currentDateTime)
                        ->with('verifyStudentAge', $verifyStudentAge)
                        ->with('calculateDate', $calculateDate)
                        ->with('entranceExamObj', $entranceExamObj)
                        ->with('slugUrl', $slugUrl)->render()

                        ;
                return response()->json($htmlBlock);

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function profilePartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = Input::get('slugUrl'); 
            $calculateDate = '';

            $dateofbirth = Input::get('dateofbirth');
            $currentDateTime = date("Y-m-d"); 
            //$calculateDate = $currentDateTime -  $dateofbirth; 
            //$explodDate = explode('/', Input::get('dateofbirth'));


            if ((Input::get('dateofbirth') != '0000-00-00') && !empty(Input::get('dateofbirth'))) {
                $bday = new DateTime(Input::get('dateofbirth')); 
                $today = new DateTime($currentDateTime);
                $diff = $today->diff($bday); 
                $calculateDate = $diff->y;
            }else{
                $calculateDate = '';
            }
            
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $checkStudentProfileObj = StudentProfile::where('studentprofile.users_id', '=', $userId)
                            ->leftJoin('users', function ($join) use ($userId) {
                            $join->on('studentprofile.users_id', '=','users.id')
                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                );  
                            })
                            ->where('studentprofile.slug', '=', $slugUrl)
                            ->where('users.userstatus_id', '!=', '5')
                            ->select('users.id as usersId','studentprofile.gender', 'studentprofile.dateofbirth', 'studentprofile.parentsname', 'studentprofile.parentsnumber', 'studentprofile.hobbies', 'studentprofile.interests', 'studentprofile.achievementsawards', 'studentprofile.projects', 'studentprofile.entranceexamname', 'studentprofile.entranceexamnumber', 'studentprofile.isverifiedage','studentprofile.slug')
                            ->firstOrFail();                 

                            $studentProfileObj = StudentProfile::where('studentprofile.users_id', '=', $userId)->first();

                            if( !empty(Input::get('gender')) ){
                                $studentProfileObj->gender = Input::get('gender');    
                            }

                            if( !empty(Input::get('dateofbirth')) ){
                                $studentProfileObj->dateofbirth = Input::get('dateofbirth');    
                               // $studentProfileObj->dateofbirth = $explodDate[2].'-'.$explodDate[1].'-'.$explodDate[0];
                            }


                            if( !empty(Input::get('parentsname')) ){
                                $studentProfileObj->parentsname = Input::get('parentsname');    
                            }

                            /*if( !empty(Input::get('contactpersonnumber')) ){
                                $studentProfileObj->contactpersonnumber = Input::get('contactpersonnumber');    
                            }*/

                            if( !empty(Input::get('parentsnumber')) ){
                                $studentProfileObj->parentsnumber = Input::get('parentsnumber');    
                            }

                            if( !empty(Input::get('hobbies')) ){
                                $studentProfileObj->hobbies = Input::get('hobbies');    
                            }

                            if( !empty(Input::get('interests')) ){
                                $studentProfileObj->interests = Input::get('interests');    
                            }

                            if( !empty(Input::get('achievementsawards')) ){
                                $studentProfileObj->achievementsawards = Input::get('achievementsawards');    
                            }

                           /* if( !empty(Input::get('projects')) ){
                                $studentProfileObj->projects = Input::get('projects');    
                            }*/

                            if(!empty(Input::get('entranceexamname')) ){
                                if((Input::get('entranceexamname') == "Others") && (!empty(Input::get('other_entranceexamname')) && ((Input::get('other_entranceexamname') != "Others") || (Input::get('other_entranceexamname') != "Other")))){
                                    $entranceexam = New Entranceexam();
                                    $entranceexam->name = Input::get('other_entranceexamname');
                                    $entranceexam->employee_id = Auth::id();
                                    $entranceexam->save();
                                    $studentProfileObj->entranceexamname = $entranceexam->id;        
                                }else{
                                    $studentProfileObj->entranceexamname = Input::get('entranceexamname');        
                                }
                            }

                            if( !empty(Input::get('entranceexamnumber')) ){
                                $studentProfileObj->entranceexamnumber = Input::get('entranceexamnumber');    
                            }

                            /*if( !empty(Input::get('isverifiedage')) ){
                                $studentProfileObj->isverifiedage = Input::get('isverifiedage');    
                            }*/
                            
                            if ($calculateDate >= 18 ) {
                                $studentProfileObj->isverifiedage = '1';
                            }else{
                                $studentProfileObj->isverifiedage = '0';
                            }
                            $studentProfileObj->employee_id = Auth::id();
                            $studentProfileObj->save();     

                $dataArray = array(
                            'code' => '200',
                            'response' => 'success',
                            'message' => 'Student profile has been updated successfully!',
                        );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                die;
                //return redirect()->route('student_dash', $checkStudentProfileObj->slug);

            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }   
    }

    public function addressStudentPartial(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;
            $slugUrl1 = $request->slug;

            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                try {
                       
                        $studentParmanentAddressDataObj = DB::table('studentprofile')
                                                            ->join('users', function ($join) use ($userId) {
                                                                $join->on('studentprofile.users_id', '=','users.id')
                                                                    ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                                    );  
                                                                })
                                                            ->leftJoin('address','studentprofile.id','=','address.studentprofile_id')
                                                            ->leftJoin('addresstype', function ($join) {
                                                                $join->on('address.addresstype_id', '=','addresstype.id')
                                                                    ->where('address.addresstype_id', '=', '1');  
                                                                })
                                                            ->leftJoin('city','address.city_id','=','city.id')
                                                            ->leftJoin('state','city.state_id','=','state.id')
                                                            ->leftJoin('country','state.country_id','=','country.id')
                                                            ->where('address.addresstype_id', '=', '3')
                                                            ->where('studentprofile.slug', '=', $slugUrl)
                                                            ->where('users.userstatus_id', '!=', '5')
                                                            ->select('users.id as usersId','studentprofile.id as studentProfileId', 'studentprofile.slug','address.id as addressId','address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalCode','addresstype.id as addressTypeId','addresstype.name as addressTypeName','city.id as cityId','city.name as cityName','state.id as stateId','state.name as stateName', 'country.id as countryId','country.name as countryName')
                                                            ->orderBy('studentprofile.id', 'DESC')
                                                            ->take(1)
                                                            ->get()
                                                            ;

                        $studentPresentAddressDataObj = DB::table('studentprofile')
                                                            ->join('users', function ($join) use ($userId) {
                                                                $join->on('studentprofile.users_id', '=','users.id')
                                                                    ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                                    );  
                                                                })
                                                            ->leftJoin('address','studentprofile.id','=','address.studentprofile_id')
                                                            ->leftJoin('addresstype', function ($join) {
                                                                $join->on('address.addresstype_id', '=','addresstype.id')
                                                                    ->where('address.addresstype_id', '=', '2');  
                                                                })
                                                            ->leftJoin('city','address.city_id','=','city.id')
                                                            ->leftJoin('state','city.state_id','=','state.id')
                                                            ->leftJoin('country','state.country_id','=','country.id')
                                                            ->where('address.addresstype_id', '=', '4')
                                                            ->where('studentprofile.slug', '=', $slugUrl1)
                                                            ->where('users.userstatus_id', '!=', '5')
                                                            ->select('users.id as usersId','studentprofile.id as studentProfileId','studentprofile.slug','address.id as addressId','address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalCode','addresstype.id as addressTypeId','addresstype.name as addressTypeName','city.id as cityId','city.name as cityName','state.id as stateId','state.name as stateName', 'country.id as countryId','country.name as countryName')
                                                            ->orderBy('studentprofile.id', 'DESC')
                                                            ->take(1)
                                                            ->get()
                                                            ;
                
                } catch ( \Exception $e) {
                    $studentParmanentAddressDataObj = '';
                    // Auth::logout();
                    // return redirect('login');
                }
            
                $states =State::all();
                $country =Country::all();
                $collegeType = DB::table('collegetype')
                        ->orderBy('collegetype.name', 'ASC')
                        ->get()
                        ;
                $city = DB::table('city')
                        ->where('city.cityStatus','=','1')   
                        ->orderBy('city.name', 'ASC')
                        ->get()
                        ;
                $addressType = DB::table('addresstype')
                            ->orderBy('addresstype.name', 'ASC')
                            ->get()
                            ;

                $states1 =State::all();
                $country1 =Country::all();
                $collegeType1 = DB::table('collegetype')
                        ->orderBy('collegetype.name', 'ASC')
                        ->get()
                        ;
                $city1 = DB::table('city')
                        ->where('city.cityStatus','=','1')
                        ->orderBy('city.name', 'ASC')
                        ->get()
                        ;
                $addressType1 = DB::table('addresstype')
                            ->orderBy('addresstype.name', 'ASC')
                            ->get()
                            ;

                $htmlBlock = view('student/dashboard.addressPartial')
                        ->with('studentParmanentAddressDataObj', $studentParmanentAddressDataObj)
                        ->with('studentPresentAddressDataObj', $studentPresentAddressDataObj)
                        ->with('collegeType', $collegeType)
                        ->with('addressType', $addressType)
                        ->with('city', $city)
                        ->with('states', $states)
                        ->with('collegeType1', $collegeType1)
                        ->with('addressType1', $addressType1)
                        ->with('city1', $city1)
                        ->with('states1', $states1)
                        ->with('country', $country)
                        ->with('country1', $country1)
                        ->with('slugUrl', $slugUrl)
                        ->with('slugUrl1', $slugUrl1)->render();

                return response()->json($htmlBlock);

            }else{
                // Auth::logout(); // logout user
                // return Redirect::to('login'); //redirect back to login
            }
        }else{
            // Auth::logout(); // logout user
            // return Redirect::to('login'); //redirect back to login
        }        
    }

    public function parmanentAddressPartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            $slug =Input::get('slug');
            $slugUrl = Input::get('slugUrl'); 
                      
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                /*** College Profile Details **/
                $studentProfileDataObj= DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->select('studentprofile.id as studentProfileId')
                                        ->take(1)
                                        ->get();

                $studentProfileId = $studentProfileDataObj[0]->studentProfileId;
                
                $checkPermanentAddressObj = DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('address','studentprofile.id','=','address.studentprofile_id')
                                        ->leftJoin('addresstype', function ($join) {
                                            $join->on('address.addresstype_id', '=','addresstype.id')
                                                ->where('address.addresstype_id', '=', '3');  
                                            })
                                        ->where('address.addresstype_id', '=', '3')
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('users.id as usersId','studentprofile.id as studentProfileId','address.id as addressId','address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalCode','addresstype.id as addressTypeId','addresstype.name as addressTypeName')
                                        ->orderBy('studentprofile.id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;                  
                $addressTypeId = $checkPermanentAddressObj[0]->addressTypeId;
                                 
                if(!empty($studentProfileId && $addressTypeId == '3'))
                {     
                    $addressObj = Address::where('address.studentprofile_id', '=', $studentProfileId)->where('address.addresstype_id', '=', '3')->firstOrFail();
                    $addressObj->name = Input::get('name');
                    $addressObj->address1 = Input::get('address1');
                    $addressObj->address2 = Input::get('address2');
                    $addressObj->landmark = Input::get('landmark');
                    $addressObj->postalcode = Input::get('postalCode');
                    $addressObj->addresstype_id = Input::get('addresstype_id');
                    $addressObj->city_id = Input::get('city_id');
                    $addressObj->studentprofile_id = $studentProfileId;
                    $addressObj->employee_id = Auth::id();
                    $addressObj->save();
                    
                }
                //return redirect()->route('college_dash', $slug);
                $dataArray = array(
                            'code' => '200',
                            'response' => 'success',
                            'message' => 'Your parmanent address has been updated successfully!',
                        );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                die;

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function presentAddressPartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slug =Input::get('slug'); 
            $slugUrl1 = Input::get('slugUrl1'); 
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** College Profile Details **/
                $studentProfileDataObj= DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentprofile.id as studentProfileId')
                                        ->take(1)
                                        ->get();

                $studentProfileId = $studentProfileDataObj[0]->studentProfileId;

                $checkPresentAddressObj = DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('address','studentprofile.id','=','address.studentprofile_id')
                                        ->leftJoin('addresstype', function ($join) {
                                            $join->on('address.addresstype_id', '=','addresstype.id')
                                                ->where('address.addresstype_id', '=', '4');  
                                            })
                                        ->where('address.addresstype_id', '=', '4')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->where('studentprofile.slug', '=', $slugUrl1)
                                        ->select('users.id as usersId','studentprofile.id as studentProfileId','studentprofile.slug','address.id as addressId','address.name', 'address.address1', 'address.address2', 'address.landmark', 'address.postalCode','addresstype.id as addressTypeId','addresstype.name as addressTypeName')
                                        ->orderBy('studentprofile.id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;
                $addressTypeId = $checkPresentAddressObj[0]->addressTypeId;
                
                if(!empty($studentProfileId) && $addressTypeId == '4' )
                {     
                   
                    $addressObj = Address::where('address.studentprofile_id', '=', $studentProfileId)->where('address.addresstype_id', '=', '4')->firstOrFail();
                    $addressObj->name = Input::get('name');
                    $addressObj->address1 = Input::get('address1');
                    $addressObj->address2 = Input::get('address2');
                    $addressObj->landmark = Input::get('landmark');
                    $addressObj->postalcode = Input::get('postalCode');
                    $addressObj->addresstype_id = Input::get('addresstype_id');
                    $addressObj->city_id = Input::get('city_id');
                    $addressObj->studentprofile_id = $studentProfileId;
                    $addressObj->employee_id = Auth::id();
                    $addressObj->save();
                    
                }
               
                //return redirect()->route('college_dash', $slug);
                $dataArray = array(
                            'code' => '200',
                            'response' => 'success',
                            'message' => 'Your present address has been updated successfully!',
                        );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                die;

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    
    public function uploadAcademicRecordImage(Request $request)
    {   
        foreach($_FILES["uploadAcademicRecordImage"]["tmp_name"] as $key=>$tmp_name)
        {   
            if( $_FILES["uploadAcademicRecordImage"]["size"][$key] <= '7340032' ){        
            $error=array();
            $extension=array("jpeg","jpg","png", "pdf");
            $file_name=$_FILES["uploadAcademicRecordImage"]["name"][$key];
            $file_tmp=$_FILES["uploadAcademicRecordImage"]["tmp_name"][$key];
            $ext=pathinfo($file_name,PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            
            //Set the image folder path
            if(env('APP_ENV') == 'local'){
               $dirPath = public_path().'/document/'.Input::get('slugUrl').'/';
            }else{
                $dirPath = public_path().'/document/'.Input::get('slugUrl').'/';
            }

            if(in_array($ext,$extension))
            {   
                $currentMyTime = strtotime('now');
                $imageNameWithTime = Input::get('slugUrl').'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'-'.$key.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'-'.$key.'_original.'.$ext;

                //$tempPath = $_FILES[ 'uploadAcademicRecordImage' ][ 'tmp_name' ][$key];
                //Store the image with 300PX width
                $uploadPath = $dirPath.$fileWithExtension;
                //Store the image with original width as original
                $uploadPath1 = $dirPath.$fileWithExtension1;
                if (move_uploaded_file($file_tmp, $uploadPath)) {
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
                    if( $width > '800' ){
                        $newwidth = 800;
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
                            imagepng( $thumb, $resize_image ); 
                        }
                        // 100 Represents the quality of an image you can set and ant number in place of 100.
                        $out_image=addslashes(file_get_contents($resize_image));    
                    }else{
                        $newwidth = $width;
                        $newheight = $height;
                    }            
                }

                $documentObj = new Document;

                $documentObj->name= $fileWithExtension;
                $documentObj->fullimage= $fileWithExtension1;
                $documentObj->width = round($newwidth);
                $documentObj->height = round($newheight);
                //$documentObj->description = Input::get('description');
                
                $documentObj->users_id = Auth::Id(); 
                $documentObj->category_id = '3'; //hard-code value
                $documentObj->employee_id = Auth::id();
                $documentObj->save();  
                
            }

        }else{
            
        }
        }   
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/student/dashboard/edit/'.Input::get('slugUrl').'#academicrecord';
        }else{
            $dirUrl = url().'/student/dashboard/edit/'.Input::get('slugUrl').'#academicrecord';
        }
         Session::flash('academicrecordMessage','Your academic documents has been uploaded successfully!');
        return Redirect::to($dirUrl);
    }

    public function deleteStudentAcademicRecord(Request $request, $documentId, $slugUrl)
    {   
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/document/'.$slugUrl.'/';
        }else{
            $dirPath = public_path().'/document/'.$slugUrl.'/';
        }

        $galleryObj = Document::findOrFail($documentId);

        //UNLINK THE PREVIOUS IMAGE                
        if( !empty($galleryObj->fullimage) ){
            unlink($dirPath.$galleryObj->name);
            unlink($dirPath.$galleryObj->fullimage);    
        }

        Document::destroy($documentId);
    
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/student/dashboard/edit/'.$slugUrl.'#academicrecord';
        }else{
            $dirUrl = url().'/student/dashboard/edit/'.$slugUrl.'#academicrecord';
        }
        Session::flash('academicrecordMessage','Your academic documents has been deleted successfully!');
        return Redirect::to($dirUrl);
    }

    public function photoVideoPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;

            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                
                $getOldUploadedImages = DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('documents', 'users.id', '=','documents.users_id')
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentprofile.id as studentprofileID', 'users.id as usersID', 'documents.id as documentsId', 'documents.name as documentsName', 'documents.fullimage as documentsFullImage', 'documents.description')
                                        ->orderBy('documents.id', 'ASC')
                                        ->get()
                                        ;
                if( empty($getOldUploadedImages) ){
                    $getOldUploadedImages = '';
                }    

                $dataArrayContent = array();
                $dataArray = array();
                if( empty($getOldUploadedImages) ){
                    $getOldUploadedImages = '';
                }else{
                    foreach ($getOldUploadedImages as $item) {
                        $fileName = $item->documentsName;
                        $ext=pathinfo($fileName,PATHINFO_EXTENSION);
                        
                        //Data Array Content
                        $dataArrayContent['studentprofileID'] = $item->studentprofileID;
                        $dataArrayContent['usersID'] = $item->usersID;
                        $dataArrayContent['documentsId'] = $item->documentsId;
                        $dataArrayContent['documentsName'] = $item->documentsName;
                        $dataArrayContent['documentsFullImage'] = $item->documentsFullImage;
                        $dataArrayContent['description'] = $item->description;
                        $dataArrayContent['ext'] = $ext;
                        $dataArray[] = $dataArrayContent;
                    }
                }
                
                
                $htmlBlock = view('student/dashboard.academicrecord')
                           ->with('slugUrl', $slugUrl)
                           ->with('getOldUploadedImages', $dataArray)
                           ->render();

                return response()->json($htmlBlock);

                //return view('college/college-profile-partial.photoVideoPartial', compact('collegePhotoVideoDataObj'));
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function studentMarksPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $studentmarksId = $request->studentmarksId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                if($request->ajax())
                {
                    $decryptId = \Illuminate\Support\Facades\Crypt::decrypt($studentmarksId);
                    //$getStudentMarksData = StudentProfile::where('studentmarks.id', '=', self::decryptIt($studentmarksId))
                    $getStudentMarksData = StudentProfile::where('studentmarks.id', '=', $decryptId)
                                            ->join('users', function ($join) use ($userId) {
                                                $join->on('studentprofile.users_id', '=','users.id')
                                                    ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                    );  
                                                })
                                            ->leftJoin('studentmarks', 'studentprofile.id', '=', 'studentmarks.studentprofile_id')
                                            ->leftJoin('category', 'studentmarks.category_id', '=', 'category.id')
                                           
                                            ->where('studentprofile.slug', '=', $slugUrl)
                                            ->where('users.userstatus_id', '!=', '5')
                                            ->select('studentprofile.id as studentprofileId','studentmarks.id as studentmarksId','studentmarks.marks','studentmarks.name as marksname','studentmarks.name as marksnamevalue', 'studentmarks.percentage', 'studentmarks.studentprofile_id', 'studentmarks.category_id','users.firstname','users.middlename','users.lastname','studentprofile.slug','studentMarkType')
                                            ->firstOrFail()
                                            ;

                    
                    //$getStudentMarksData->marksnamevalue = self::encryptIt($getStudentMarksData->marksnamevalue);
                    $getStudentMarksData->marksnamevalue = \Illuminate\Support\Facades\Crypt::encrypt($getStudentMarksData->marksnamevalue);
                    
                    $categoryObj = Category::all();

                    $htmlBlock = view('student/dashboard.studentmarks')
                        ->with('getStudentMarksData', $getStudentMarksData)
                        ->with('categoryObj', $categoryObj)->render();
                    return response()->json($htmlBlock);
                    

                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
                }
            }
            else
            {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }   
        }
        else
        {
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }  
    }


    public function academicMarksPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $studentmarksId = $request->studentmarksId;
            $slugUrl = $request->slugUrl; //print_r($slugUrl);die;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                if($request->ajax())
                {
                    $decryptId = \Illuminate\Support\Facades\Crypt::decrypt($studentmarksId);
                    //$getStudentMarksData = StudentProfile::where('studentmarks.id', '=', self::decryptIt($studentmarksId))
                    $getStudentMarksData = StudentProfile::where('studentmarks.id', '=', $decryptId)
                                            ->join('users', function ($join) use ($userId) {
                                                $join->on('studentprofile.users_id', '=','users.id')
                                                    ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                    );  
                                                })
                                            ->leftJoin('studentmarks', 'studentprofile.id', '=', 'studentmarks.studentprofile_id')
                                            ->leftJoin('category', 'studentmarks.category_id', '=', 'category.id')
                                           
                                            ->where('studentprofile.slug', '=', $slugUrl)
                                            ->where('users.userstatus_id', '!=', '5')
                                            ->select('studentprofile.id as studentprofileId','studentmarks.id as studentmarksId','studentmarks.marks','studentmarks.name as marksname','studentmarks.name as marksnamevalue', 'studentmarks.percentage', 'studentmarks.studentprofile_id', 'studentmarks.category_id','users.firstname','users.middlename','users.lastname','studentprofile.slug','studentMarkType')
                                            ->firstOrFail()
                                            ;

                    
                    //$getStudentMarksData->marksnamevalue = self::encryptIt($getStudentMarksData->marksnamevalue);
                    $getStudentMarksData->marksnamevalue = \Illuminate\Support\Facades\Crypt::encrypt($getStudentMarksData->marksnamevalue);
                    
                    $categoryObj = Category::all();

                    $htmlBlock = view('student/dashboard.studentmarks')
                        ->with('getStudentMarksData', $getStudentMarksData)
                        ->with('categoryObj', $categoryObj)->render();
                    return response()->json($htmlBlock);
                    

                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
                }
            }
            else
            {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }   
        }
        else
        {
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }  
    }

    public function deleteStudentmarks(Request $request, $studentmarksId, $slugUrl)
    {   
        StudentMark::destroy($studentmarksId);
        return redirect()->route('student_dash', $slugUrl);  
    }

    public function studentMarksPartialUpdate( Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl =Input::get('slugUrl');
            
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
        
                /*** Student Profile Details **/
                $studentProfileDataObj= DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentprofile.id as studentProfileId')
                                        ->take(1)
                                        ->get()
                                        ;
                if( !empty($studentProfileDataObj) ){
                    $checkStudentMarks = DB::table('studentmarks')
                                    ->where('studentmarks.name','=',Input::get('className'))
                                    ->where('studentmarks.studentprofile_id','=', $studentProfileDataObj[0]->studentProfileId)
                                    ->count();
                    if($checkStudentMarks == '0'){
                        $studentmarksObj = new StudentMark;                
                        $studentmarksObj->studentprofile_id = $studentProfileDataObj[0]->studentProfileId;
                        $studentmarksObj->category_id = '3';
                        $studentmarksObj->marks = Input::get('marks');
                        $studentmarksObj->name = Input::get('className');
                        $studentmarksObj->percentage = Input::get('percentage');
                        $studentmarksObj->studentMarkType = Input::get('studentMarkType');
                        $studentmarksObj->employee_id = Auth::id();
                        $studentmarksObj->save();

                    }else{
                        Session::flash('studentMarksUpdateMsg', Input::get('className').' '.'marks already exist!');       
                    }            
                                        
                    return redirect()->route('student_dash', $slugUrl);    
                }
                
            }else{
                //Auth::logout(); // logout user
                //return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }   
    }

    public function studentMarksUpdate(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $studentProfileDataObj= DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentprofile.id as studentProfileId')
                                        ->take(1)
                                        ->get()
                                        ;

                //$classname = self::decryptIt(Input::get('classname'));
                $classname = \Illuminate\Support\Facades\Crypt::decrypt(Input::get('classname'));

                $checkStudentMarks = DB::table('studentmarks')
                                    ->where('studentmarks.name','=', $classname)
                                    ->where('studentmarks.id','=',Input::get('studentmarksId'))
                                    ->where('studentmarks.studentprofile_id','=', $studentProfileDataObj[0]->studentProfileId)
                                    ->count();
                if($checkStudentMarks == '1'){
                    $studentMarksObj = StudentMark::where('studentmarks.id', '=', Input::get('studentmarksId'))->firstOrFail();
                
                    $studentMarksObj->marks = Input::get('marks');
                    $studentMarksObj->percentage = Input::get('percentage');
                    $studentMarksObj->studentMarkType = Input::get('studentMarkType');        
                    $studentMarksObj->employee_id = Auth::id();
                    $studentMarksObj->save();

                    Session::flash('studentMarksUpdatemessage','Your academic marks has been updated successfully!');
                }else{
                    Session::flash('studentMarksUpdatemessage','Your input value is not valid!');     
                } 
                return redirect()->route('student_dash', $slugUrl);  

            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }        
    }

    public function projectPartial(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slug;

            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){

                $getOldUploadedDescription = DB::table('studentprofile')
                                        ->join('users', function ($join) use ($userId) {
                                            $join->on('studentprofile.users_id', '=','users.id')
                                                ->where('studentprofile.users_id', '=', DB::raw($userId)
                                                );  
                                            })
                                        ->leftJoin('documents', 'users.id', '=','documents.users_id')
                                        ->where('studentprofile.slug', '=', $slugUrl)
                                        ->where('documents.category_id', '=', '3')
                                        ->where('documents.name', '=', 'no-image-upload')
                                        ->where('users.userstatus_id', '!=', '5')
                                        ->select('studentprofile.id as studentprofileID', 'users.id as usersID', 'documents.id as documentsId', 'documents.name as documentsName', 'documents.fullimage as documentsFullImage','documents.description')
                                        ->orderBy('documents.id', 'ASC')
                                        ->get()
                                        ;
                if(empty($getOldUploadedDescription)){
                    $getOldUploadedDescription = '';
                }
                                
                $htmlBlock = view('student/dashboard.projectPartial')
                           ->with('slugUrl', $slugUrl)
                           ->with('getOldUploadedDescription', $getOldUploadedDescription)
                           ->render();

                return response()->json($htmlBlock);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function deleteUploadedDocument(Request $request, $documentId, $slugUrl)
    {   
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/document/'.$slugUrl.'/';
        }else{
            $dirPath = public_path().'/document/'.$slugUrl.'/';
        }

        $documentObj = Document::findOrFail($documentId);

        //UNLINK THE PREVIOUS IMAGE
        try {
            if( !empty($documentObj->name) ){
            if( $documentObj->name != 'no-image-upload' ){
                    unlink($dirPath.$documentObj->name);
                    unlink($dirPath.$documentObj->fullimage);          
                }
            }            
        } catch (\Exception $e) {
        }
        

        Document::destroy($documentId);
    
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/student/dashboard/edit/'.$slugUrl.'#academicrecord';
        }else{
            $dirUrl = url().'/student/dashboard/edit/'.$slugUrl.'#academicrecord';
        }
        Session::flash('academicrecordMessage','Your document has been deleted successfully!');
        return Redirect::to($dirUrl);
    }


    public function deleteProjectDocument(Request $request, $documentId, $slugUrl)
    {   
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/document/'.$slugUrl.'/';
        }else{
            $dirPath = public_path().'/document/'.$slugUrl.'/';
        }

        $documentObj = Document::findOrFail($documentId);

        //UNLINK THE PREVIOUS IMAGE
        if( !empty($documentObj->name) ){
            if( $documentObj->name != 'no-image-upload' ){
                unlink($dirPath.$documentObj->name);
                unlink($dirPath.$documentObj->fullimage);          
            }
        }        

        Document::destroy($documentId);
    
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/student/dashboard/edit/'.$slugUrl.'#projectrecord';
        }else{
            $dirUrl = url().'/student/dashboard/edit/'.$slugUrl.'#projectrecord';
        }
        Session::flash('academicrecordMessage','Your project description has been deleted successfully!');
        return Redirect::to($dirUrl);
    }

    public function uploadProjectDesc(Request $request)
    {
        $documentObj = new Document;
        $documentObj->name = 'no-image-upload';
        $documentObj->description = Input::get('description');
        $documentObj->users_id = Auth::Id(); 
        $documentObj->category_id = '3'; //hard-code value
        $documentObj->employee_id = Auth::id();
        $documentObj->save(); 

        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/student/dashboard/edit/'.Input::get('slugUrl').'#projectrecord';
        }else{
            $dirUrl = url().'/student/dashboard/edit/'.Input::get('slugUrl').'#projectrecord';
        }
        Session::flash('academicrecordMessage','Your project record has been created successfully!');
        return Redirect::to($dirUrl);
    }

    public function projectPartialLoad(Request $request)
    {
        $documentId = Input::get('documentId');
        $slugUrl = Input::get('slugUrl');
        $description = Input::get('description');
        $htmlBlock = view('student/dashboard.projectPartialLoad')
                    ->with('documentId', $documentId)
                    ->with('slugUrl', $slugUrl)
                    ->with('description', $description)
                    ->render();
        return response()->json($htmlBlock);
    }

    public function projectPartialLoadUpdate(Request $request)
    {
        $documentId = $request->documentId;
        $slugUrl = $request->slugUrl;
        
        $udpateGalleryObj = Document::where('id', '=', $documentId)->firstOrFail();
        $udpateGalleryObj->description = Input::get('description');
        $udpateGalleryObj->employee_id = Auth::id();
        $udpateGalleryObj->save();

        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/student/dashboard/edit/'.Input::get('slugUrl').'#projectrecord';echo $dirUrl;
        }else{
            $dirUrl = url().'/student/dashboard/edit/'.Input::get('slugUrl').'#projectrecord';echo $dirUrl;
        }
        Session::flash('academicrecordMessage','Your project description has been updated successfully!');
        return Redirect::to($dirUrl);
    }


    public function studentAccountSetting(Request $request)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            $htmlBlock = view('student/dashboard.studentAccountSetting')
                        ->with('getPreviousData', $roleGrant)
                        ->with('slugUrl', $request->slug)
                        ->render();
            return response()->json($htmlBlock);
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function studentAccountSettingPartialsUpdate(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            
            //VALIDATE THE USER NOW
            $getValidateState = DB::table('studentprofile')
                                ->where('slug', '=', $request->slugUrl)
                                ->where('studentprofile.users_id', '=', $userId)
                                ->count()
                                ;
            if( $getValidateState == '1' ){
                
                //UPDATE STUDENT NAME IN SLUG, GALLERY, DOCUMENT
                $slugUrlNew = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('firstname').' '.$userId);
                $slugUrlNew = strtolower($slugUrlNew);
                //Set slud in college profile
                $setSlug = StudentProfile::where('users_id', '=', $userId)->firstOrFail();

                //Rename folder
                $slugUrlOld = $setSlug->slug;
                $directoryForDocument =  public_path().'/document/'.$slugUrlOld;
                $directoryForGallery =  public_path().'/gallery/'.$slugUrlOld;

                rename($directoryForDocument, public_path().'/document/'.$slugUrlNew);
                rename($directoryForGallery, public_path().'/gallery/'.$slugUrlNew);

                $setSlug->slug = $slugUrlNew;
                $setSlug->employee_id = Auth::id();
                $setSlug->save();
                //END

                $updateUsersObj = $usersObj = User::findOrFail($userId);
                $updateUsersObj->firstname = Input::get('firstname');
                $updateUsersObj->middlename = Input::get('middlename');
                $updateUsersObj->lastname = Input::get('lastname');
                if ($updateUsersObj->email != Input::get('email')) {
                    $checkUserName = DB::table('users')
                    ->where('email', '=', Input::get('email'))
                    ->count()
                    ;
                    if( $checkUserName == '0' ){
                        $updateUsersObj->email = Input::get('email');
                        $emailaddressmsg = '0';
                    }else{
                        $emailaddressmsg = '1';
                    }
                }else{
                    $emailaddressmsg = '2';
                }

                $updateUsersObj->phone = Input::get('phone');
                if( !empty(Input::get('password')) ){
                    $updateUsersObj->password = Hash::make(Input::get('password'));    
                }                
                $updateUsersObj->employee_id = Auth::id();
                $updateUsersObj->save();

                if ($emailaddressmsg == '1') {
                    Session::flash('accountSettingsUpdate', 'Account Settings Updated. But duplicate email address found, kindly use another email address');
                }else{
                    Session::flash('accountSettingsUpdate', 'Account Settings Updated!');
                }

                if(env('APP_ENV') == 'local'){
                   $dirUrl = url().'/student/dashboard/edit/'.$slugUrlNew.'#accountsetting';echo $dirUrl;
                }else{
                    $dirUrl = url().'/student/dashboard/edit/'.$slugUrlNew.'#accountsetting';echo $dirUrl;
                }
              
                return Redirect::to($dirUrl);
                //return redirect()->route('student_dash', $slugUrlNew);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login        
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login    
        }
    }

    public function getCurrentDateCalculate( Request $request )
    {
        $dateofbirth = Input::get('dateofbirth');
        
        $currentDateTime = date("Y-m-d"); 
        
        $bday = new DateTime($dateofbirth); 
        $today = new DateTime($currentDateTime);
        $diff = $today->diff($bday); 
        $calculateDate = $diff->y.' years , '.$diff->m.' months , '.$diff->d.' days';    

        if( !empty($dateofbirth) ){
            $calculateDate = array( 'code' => '200' , 'calculateDate' => $calculateDate, 'year' => $diff->y );
        }else{
            $calculateDate = array( 'code' => '401' , 'calculateDate' => '', 'year' => '' );
        }
        header('Content-Type: application/json');
        echo json_encode($calculateDate);
        exit;
    }


    public function updateStudentApplicationStatus(Request $request)
    {   
        if( !empty(Input::get('message')) ){
            $messageText = Input::get('message');    
        }
        //Update Application Status
        $updateApplicationStatus = Application::findOrFail(Input::get('applicationId'));

        $updateApplicationStatus->applicationstatus_id = Input::get('applicationStaus');
        $updateApplicationStatus->employee_id = Auth::id();
        $updateApplicationStatus->save();


        $getStudentEmailAddress = DB::table('application')
                                ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
                                ->leftJoin('users as u1','application.users_id','=','u1.id')
                                ->leftJoin('collegeprofile','application.collegeprofile_id','=', 'collegeprofile.id')
                                ->leftJoin('users as u2','u2.id','=','collegeprofile.users_id')
                                ->where('application.id','=', Input::get('applicationId'))
                                ->where('u2.userstatus_id', '!=', '5')
                                ->where('u1.userstatus_id', '!=', '5')
                                ->select('u1.email as studentEmail','u2.email as collegeEmail','applicationstatus.name','u1.firstname as StudentFirstName','u1.middlename as studentMiddleName','u1.lastname as studentLastName','u2.firstname as collegeName','application.applicationID')
                                ->get()
                                ;

        $applicationstatusId = $getStudentEmailAddress[0]->name; 
        $studentEmailId = $getStudentEmailAddress[0]->studentEmail;
        $collegeEmailId = $getStudentEmailAddress[0]->collegeEmail;
        $studentName = $getStudentEmailAddress[0]->StudentFirstName.' '.$getStudentEmailAddress[0]->studentMiddleName.' '.$getStudentEmailAddress[0]->studentLastName;
        $collegeName = $getStudentEmailAddress[0]->collegeName;
        $applicationID = $getStudentEmailAddress[0]->applicationID;

        $getTheEmailAdmin = DB::table('users')->where('userrole_id', '=', '1')->where('users.userstatus_id','=', '1')->select('email')->get();
            //$adminEmailId = $getTheEmailAdmin[0]->email;
        
            $applicationStatusMessageObj = New ApplicationStatusMessage();

            $applicationStatusMessageObj->application_id = Input::get('applicationId');    
            $applicationStatusMessageObj->student_id = $updateApplicationStatus->users_id; 
            $applicationStatusMessageObj->college_id = $updateApplicationStatus->collegeprofile_id; 
            $applicationStatusMessageObj->admin_id = '';
            $applicationStatusMessageObj->message = $messageText;
            $applicationStatusMessageObj->others = 'Student Remarks';
            $applicationStatusMessageObj->applicationStatus = $applicationstatusId;
            $applicationStatusMessageObj->employee_id = Auth::id();
            $applicationStatusMessageObj->save();

        try {
            if(!empty($studentEmailId) && ($this->fetchDataServiceController->isValidEmail($studentEmailId) == 1))
            {
                    /**Swift Mailer TO Student***/        
                    \Mail::send('student/application.email.studentCancelAdmission', array('email' => $studentEmailId, 'messageData' => $messageText, 'applicationstatusName' => $applicationstatusId,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationID), function($message) use ($studentEmailId)
                    {
                        $message->to($studentEmailId, 'AdmissionX')->subject('Cancel Admission');
                    });  
            } 
        }catch ( \Swift_TransportException $e) {                
        }

        try {
            if(!empty($collegeEmailId) && ($this->fetchDataServiceController->isValidEmail($collegeEmailId) == 1))
            {
                    /**Swift Mailer TO COLLEGE***/        
                    \Mail::send('student/application.email.collegeCancelAdmission', array('email' => $collegeEmailId, 'messageData' => $messageText,'applicationstatusName' => $applicationstatusId,'collegeName'=>$collegeName,'studentName'=>$studentName,'applicationID'=>$applicationID ), function($message) use ($collegeEmailId)
                    {
                        $message->to($collegeEmailId, 'AdmissionX')->subject('Cancel Admission');
                    });  
            } 
        }catch ( \Swift_TransportException $e) {                
        }

        $adminEmailId = array();
        foreach ($getTheEmailAdmin as $key => $value) {
            $adminEmailId = $value->email;
            //$adminEmailId[] = $tempArrayEmailId;

            try {
               
                if(!empty($adminEmailId) && ($this->fetchDataServiceController->isValidEmail($adminEmailId) == 1))
                {
                   /**Swift Mailer TO Admin***/        
                    \Mail::send('student/application.email.cancelAdmission', array('email' => $adminEmailId, 'messageData' => $messageText ,'applicationstatusName' => $applicationstatusId), function($message) use ($adminEmailId)
                    {
                        $message->to($adminEmailId, 'AdmissionX')->subject('Cancel Admission');
                    }); 
                }
            }catch ( \Swift_TransportException $e) {                
            }
        }
        return Redirect::back();
    }


    public function documentPartialLoadStudent(Request $request)
    {
        $documentId = Input::get('documentId');
        $slugUrl = Input::get('slugUrl');
        $description = Input::get('description');
        $htmlBlock = view('student/dashboard.documentPartialLoad')
                    ->with('documentId', $documentId)
                    ->with('slugUrl', $slugUrl)
                    ->with('description', $description)
                    ->render();
        return response()->json($htmlBlock);
    }

    public function documentPartialLoadUpdate(Request $request)
    {
        $documentId = $request->documentId;
        $slugUrl = $request->slugUrl;
        
        $udpateGalleryObj = Document::where('id', '=', $documentId)->firstOrFail();
        $udpateGalleryObj->description = Input::get('description');
        $udpateGalleryObj->employee_id = Auth::id();
        $udpateGalleryObj->save();

        Session::flash('collegeDocumentCaptionUpdate', 'Caption has been updated successfully!');

        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/student/dashboard/edit/'.Input::get('slugUrl').'#academicrecord';
        }else{
            $dirUrl = url().'/student/dashboard/edit/'.Input::get('slugUrl').'#academicrecord';
        }
        Session::flash('academicrecordMessage','Your caption has been updated successfully!');
        return Redirect::to($dirUrl);
    }

    /************************************************************************************
    *   EDIT COLLEGE REVIEWS
    /************************************************************************************/
    public function studentReviewFormsEdit(Request $request, $slug, $id)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeReviews = DB::table('college_reviews')
                        ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                        ->where('college_reviews.id', '=', $id)
                        ->where('college_reviews.guestUserId', '=', $userId)
                        ->where('studentprofile.slug', '=', $slug)
                        ->orderBy('college_reviews.id', 'DESC')
                        ->select('college_reviews.id')
                        ->get();
                if (sizeof($collegeReviews) > 0) {
                    $getCollegeReviewObj = CollegeReview::findOrFail($id);
                    return view('student/dashboard.update-college-review')
                                ->with('getCollegeReviewObj', $getCollegeReviewObj)
                                ->with('slug', $slug)
                                ;
                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
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

    /************************************************************************************
    *   UPDATE COLLEGE REVIEWS
    /************************************************************************************/
    public function studentReviewFormsUpdate(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeReviews = DB::table('college_reviews')
                        ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                        ->where('college_reviews.id', '=', Input::get('id'))
                        ->where('college_reviews.guestUserId', '=', $userId)
                        ->where('studentprofile.slug', '=', $slug)
                        ->orderBy('college_reviews.id', 'DESC')
                        ->select('college_reviews.id')
                        ->get();

                if (sizeof($collegeReviews) > 0) {
                    $update                                 = CollegeReview::findOrFail(Input::get('id')); 
                    $update->title                          = Input::get('title');
                    $update->description                    = Input::get('description');
                    $update->votes                          = Input::get('votes');
                    $update->academic                       = Input::get('academic');
                    $update->accommodation                  = Input::get('accommodation');
                    $update->faculty                        = Input::get('faculty');
                    $update->infrastructure                 = Input::get('infrastructure');
                    $update->placement                      = Input::get('placement');
                    $update->social                         = Input::get('social');
                    $update->save();
                    return Redirect::to('student/review-list/'.$slug);
                }else{
                    Auth::logout(); // logout user
                    return Redirect::to('login'); //redirect back to login
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

    /************************************************************************************
    *   DELETE COLLEGE REVIEWS
    /************************************************************************************/
    public function studentReviewFormsDelete(Request $request, $slug, $id)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if( $roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $collegeReviews = DB::table('college_reviews')
                        ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                        ->where('college_reviews.id', '=', $id)
                        ->where('college_reviews.guestUserId', '=', $userId)
                        ->where('studentprofile.slug', '=', $slug)
                        ->orderBy('college_reviews.id', 'DESC')
                        ->select('college_reviews.id')
                        ->get();

                if(sizeof($collegeReviews) > 0) {
                    CollegeReview::destroy($id);    
                }
                return Redirect::to('student/review-list/'.$slug);
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }               
    }

    // public function encryptIt( $q ) {
    //     $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    //     $qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    //     return( $qEncoded );
    // }

    // public function decryptIt( $q ) {
    //     $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    //     $qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    //     return( $qDecoded );
    // }

    public function studentCounsellingForms(Request $request, $slug)
    {
        if (Auth::check())
        {   
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            $slugUrl = $request->slugUrl;
                       
            if($roleGrant->userrole_id == '3' && ($roleGrant['userstatus_id'] == '1' || $roleGrant['userstatus_id'] == '3') ){
                $listOfCounsellingForm = ExamCounsellingForm::orderBy('exam_counselling_forms.id', 'DESC')
                        ->leftJoin('city', 'exam_counselling_forms.city_id', '=', 'city.id')
                        ->leftJoin('course', 'exam_counselling_forms.course_id', '=', 'course.id')
                        ->leftJoin('type_of_examinations', 'exam_counselling_forms.exam_id', '=', 'type_of_examinations.id')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->where('exam_counselling_forms.users_id', '=', $userId)
                        ->paginate(15, array('exam_counselling_forms.id','exam_counselling_forms.name', 'exam_counselling_forms.email', 'exam_counselling_forms.phone', 'exam_counselling_forms.misc', 'exam_counselling_forms.isResponse','exam_counselling_forms.isResponseMethod','city.name as cityName','course.name as courseName','type_of_examinations.name as examinationName','type_of_examinations.sortname','type_of_examinations.slug as type_of_examinationsSlug','exam_sections.slug as examSlug','exam_id','exam_counselling_forms.created_at'));

                return view('student/dashboard.counselling-form-list', compact('listOfCounsellingForm','slug'));
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