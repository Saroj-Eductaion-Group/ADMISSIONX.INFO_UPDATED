<?php

namespace App\Http\Controllers\college;

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
use App\User;
use Config;
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
use App\Models\Placement as Placement;
use GuzzleHttp\Client;
use App\Models\SeoContent;
use App\Models\RequestForCreateCollegeAccount;
use App\Http\Controllers\Helper\FetchDataServiceController;

class quickSignUpController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

    public function index()
    {
        if (!empty(Input::get('g-recaptcha-response'))) {
            //GET PARAMS
            $emailAddress = Input::get('email');
            $collegeName = Input::get('collegeName');
            $contactNumber = Input::get('contactNumber');
            $password = Input::get('password');

            //Check for already existing account
            $checkEmailDuplicateObj = DB::table('users')
                                        ->where('email' ,'=', $emailAddress)
                                        ->take(1)
                                        ->get()
                                        ;
            if( empty($checkEmailDuplicateObj) ){
                //STORE INTO USERS TABLE
                $userObj = New User;
                $userObj->email = $emailAddress;
                $userObj->firstName = $collegeName;
                $userObj->password = Hash::make($password);
                $userObj->phone = $contactNumber;
                $userObj->userstatus_id = '2'; //Inasctive
                $userObj->userrole_id = '2'; //ROLE_COLLEGE 

                $encrytEmail = md5($emailAddress);
                $userObj->token = $encrytEmail;

                $userObj->save();


                $getEmailWiseUserId = User::where('email', '=', $emailAddress)->firstOrFail();

                //STORE INTO COLLEGEPROFILES TABLE FOR CREATE RECORD
                $collegeProfileObj = New CollegeProfile;
                $collegeProfileObj->users_id = $getEmailWiseUserId->id;
                $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getEmailWiseUserId->firstname.' '.$getEmailWiseUserId->id);
                $slugUrl = strtolower($slugUrl);
                $collegeProfileObj->slug = strtolower($slugUrl);
                $collegeProfileObj->save();

                //CREATE TWO FOLDERS IN GALLERY AND DOCUMENTS FOR PHOTOS
                $directoryForDocument =  public_path().'/document/'.$slugUrl;
                $directoryForGallery =  public_path().'/gallery/'.$slugUrl;
                if (!mkdir($directoryForDocument, 0777, true)) {
                    die('Failed to create folders...');
                }
                if (!mkdir($directoryForGallery, 0777, true)) {
                    die('Failed to create folders...');
                }

                //Create Blank Row For Every College LOGOS
                $createGalleryCollegeLogo = new Gallery;

                $createGalleryCollegeLogo->caption = 'College Logo';
                $createGalleryCollegeLogo->misc = 'college-logo-img';
                $createGalleryCollegeLogo->category_id = '1';
                $createGalleryCollegeLogo->users_id = $getEmailWiseUserId->id;

                $createGalleryCollegeLogo->save();



                //GET COLLEGE PROFILE ID AS PER SLUG
                $getCollProId = CollegeProfile::where('slug', '=', $slugUrl)->firstOrFail();
                //STORE INTO ADDRESS TABLE FOR CREATE RECORD
                //For Registered address
                $addressObj = New Address;
                $addressObj->addresstype_id = '1';
                $addressObj->collegeprofile_id = $getCollProId->id;
                $addressObj->save();

                //For Campus address
                $addressObj = New Address;
                $addressObj->addresstype_id = '2';
                $addressObj->collegeprofile_id = $getCollProId->id;
                $addressObj->save();

                $placementObj = New Placement;
                $placementObj->collegeprofile_id = $getCollProId->id;
                $placementObj->save();

                $seoContentObj = New SeoContent;
                $seoContentObj->pagetitle = $collegeName;
                $seoContentObj->misc = 'collegepage';
                $seoContentObj->collegeId = $getCollProId->id;
                $seoContentObj->employee_id = Auth::id();
                $seoContentObj->save();

                // if(env('APP_ENV') == 'local'){
                //    $baseUrl = env('APP_URL').'/verify-email-address/';
                // }else{
                //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/verify-email-address/';
                // }
                $baseUrl = env('APP_URL').'/verify-email-address/';
                $ecyEmailUrl = $baseUrl.$encrytEmail;

                //SET TRY CATCH BLOCK FOR THANK YOU FOR REGISTERING
               /* try {
                   if(!empty($emailAddress) && ($this->fetchDataServiceController->isValidEmail($emailAddress) == 1))
                    {
                        //Swift Mailer Data Fetching
                        //'website.home.signupmail
                        \Mail::send('website.home.proposalOfCollegeSignUp', array('email' => $emailAddress, 'ecyEmailUrl' => $ecyEmailUrl,'collegeName'=> $collegeName), function($message) use ($emailAddress)
                        {
                            $message->to($emailAddress, 'AdmissionX')->subject('Thank you for registering with AdmissionX');
                        });  
                    } 
                } catch ( \Swift_TransportException $e) {                
                }*/

                $resultMailSet = $this->sendCollegeSignupMail($emailAddress, $ecyEmailUrl, $collegeName);

              
                try {
                    if(!empty($contactNumber))
                    {
                        $userMobileNo = $contactNumber;  
                        $smsMessageData = Config::get('systemsetting.SIGNUPMSG').' '.$emailAddress.' '.Config::get('systemsetting.SMS_GROUP_NAME_5');
                        /***Send SMS *******************************/

                        $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_SIGN_OTP'));
                        /*$userIdHorizonSms = Config::get('app.userIdHorizonSms');
                        $passwordHorizonSms = Config::get('app.passwordHorizonSms');
                        $accountFromHorizon = Config::get('app.accountFromHorizon');

                        $url = 'http://210.210.26.40/sendsms/push_sms.php';

                        $client = new \GuzzleHttp\Client();
                        $res = $client->request('POST', $url, [
                            'form_params' => [
                                'user' => urlencode($userIdHorizonSms),
                                'pwd' => urlencode($passwordHorizonSms),
                                'from' => urlencode($accountFromHorizon),
                                'to' => urlencode($userMobileNo),
                                'msg' => $smsMessageData,
                            ]
                        ]); */ 
                    } 
                }catch (\Exception $e) {
                    return $e;
                }
                
                //GET EMAIL ADDRESS
                $getEmailObj = DB::table('users')
                                        ->where('email' ,'=', $emailAddress)
                                        ->take(1)
                                        ->get()
                                        ;

                //SET COOKIE
                setcookie('collegeUserId', $getEmailObj[0]->id, time() + (86400 * 30), "/");                        
                setcookie('collegeName', $collegeName, time() + (86400 * 30), "/");
                setcookie('emailAddress', $emailAddress, time() + (86400 * 30), "/");

                $dataArray = array(
                   'code' => '200',
                   'email' => $getEmailObj[0]->email,
                   'response' => '',
                   'slug' => $slugUrl,
                );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                exit;
            }else{
                $dataArray = array(
                   'code' => '401',
                   'email' => $emailAddress,
                   'response' => '',
                   'slug' => '',
                );
                header('Content-Type: application/json');
                echo json_encode($dataArray);
                exit;
            }
        }else{
            $dataArray = array(
               'code' => '400',
               'email' => '',
               'response' => 'Please verify the captcha',
               'slug' => '',
            );
            header('Content-Type: application/json');
            echo json_encode($dataArray);
            exit;
        }
    }

    /*public function detailSignUp()
    {
        return view('college/register.detailSignUp');
    }*/

    public function detailSignUp($slug)
    {   
        if( !empty($_COOKIE['collegeUserId'])){

            $collegeType = DB::table('collegetype')
                    ->orderBy('collegetype.name', 'ASC')
                    ->get()
                    ;

            $states =State::all();
            $countryObj =Country::all();

            $city = DB::table('city')
                    ->where('city.cityStatus','=','1')
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;

            $addressType = DB::table('addresstype')
                        ->orderBy('addresstype.name', 'ASC')
                        ->get()
                        ;

            $collegeUserId = $_COOKIE['collegeUserId'];
            $emailAddress = $_COOKIE['emailAddress'];
            $collegeName  = $_COOKIE['collegeName']; 

            return view('college/register.detailSignUp')
                    ->with('collegeType', $collegeType)
                    ->with('addressTypeID', $addressType)
                    ->with('cityID', $city)
                    ->with('states', $states)
                    ->with('emailAddress', $emailAddress)
                    ->with('collegeName', $collegeName)
                    ->with('collegeUserId', $collegeUserId)
                    ->with('countryObj', $countryObj)
                    ->with('slug', $slug)
                    ;
        }else{
            return Redirect::to('/');
        }     
        
    }

    public function collegeProfileStore(Request $request)
    {
        $slug = Input::get('slug');
        $administratorName = Input::get('administratorName');
        $emailAddress = Input::get('emailAddress');
        $phoneNo = Input::get('phoneNo');

        $careOfName = Input::get('careOfName');
        $address1 = Input::get('address1');
        $address2 = Input::get('address2');
        $landmark = Input::get('landmark');
        $postalCode = Input::get('postalCode');
        $addressTypeName = Input::get('addressTypeName');
        $cityName = Input::get('cityName');
        $collegeType = Input::get('collegeType');

        $collegeuserID = Input::get('collegeuserID');

        /*** College Profile Details **/
        $collegeProfileObj = CollegeProfile::where('slug', '=', $slug)->firstOrFail();

        $collegeProfileObj->contactpersonname = $administratorName;
        $collegeProfileObj->contactpersonemail = $emailAddress;
        $collegeProfileObj->contactpersonnumber = $phoneNo;

        $collegeProfileObj->users_id = $collegeuserID; 
        $collegeProfileObj->collegetype_id = $collegeType; 

        $collegeProfileObj->save();          

                                                                                                                                                                                                                                       
        /*** Upload logo on gallery ***/
        if($request->file('collegeLogo'))
        {      
            //get Gallery ID
            $getGalleryIdObj = DB::table('gallery')
                                ->where('gallery.users_id', '=', $collegeuserID)
                                ->where('gallery.caption', '=', 'College Logo')
                                ->where('gallery.misc', '=', 'college-logo-img')
                                ->where('gallery.category_id', '=', '1')
                                ->select('id')
                                ->orderBy('gallery.id', 'DESC')
                                ->take(1)
                                ->get()
                                ;
            $galleryObj = Gallery::findOrfail($getGalleryIdObj[0]->id);

            // $file1=$request->file('collegeLogo')->getClientOriginalName();
            // $request->file('collegeLogo')->move(
            // base_path().'/public/gallery/', $file1
            // );
            if($request->file('collegeLogo'))
            {            
                if( $_FILES["collegeLogo"]["size"] <= '7340032' ){
                $extensionOfFile = '';
                $path = $_FILES['collegeLogo']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                $tempPath = $_FILES[ 'collegeLogo' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = Input::get('slug').'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'_original'.'.'.$ext;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/gallery/'.Input::get('slug').'/';
                }else{
                    $dirPath = public_path().'/gallery/'.Input::get('slug').'/';
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
                        $newwidth = 600;
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


                $galleryObj->name= $fileWithExtension;
                $galleryObj->fullimage= $fileWithExtension1;
                $galleryObj->caption = 'College Logo';
                $galleryObj->width = round($newwidth);
                $galleryObj->height = round($newheight);
                $galleryObj->users_id = $collegeuserID; 
                $galleryObj->category_id = '1';

                $galleryObj->save();
        }else{

            }
        }

        /****upload document ***/
        if($request->file('aicteDocument'))
        {   
            $documentObj = new Gallery;

            // $file2=$request->file('aicteDocument')->getClientOriginalName();
            // $request->file('aicteDocument')->move(
            // base_path().'/public/document/'.$slug.'/', $file2
            // );
            if($request->file('aicteDocument'))
            {            
                if( $_FILES["aicteDocument"]["size"] <= '7340032' ){
                $path = $_FILES['aicteDocument']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                $extensionOfFile = $_FILES[ 'aicteDocument' ][ 'type' ];
                
                $tempPath = $_FILES[ 'aicteDocument' ][ 'tmp_name' ];
                $currentMyTime = strtotime('now');
                $imageNameWithTime = Input::get('slug').'-'.$currentMyTime;
                $aictefileWithExtension = $imageNameWithTime.'1'.'.'.$ext;//$extensionOfFile;
                $aictefileWithExtension1 = $imageNameWithTime.'1'.'_original'.'.'.$ext;//$extensionOfFile;
             
                //Set the image folder path
                if(env('APP_ENV') == 'local'){
                   $dirPath = public_path().'/gallery/'.Input::get('slug').'/';
                }else{
                    $dirPath = public_path().'/gallery/'.Input::get('slug').'/';
                }
                

                //Store the image with 300PX width
                $uploadPath = $dirPath.$aictefileWithExtension;
                //Store the image with original width as original
                $uploadPath1 = $dirPath.$aictefileWithExtension1;
                if (move_uploaded_file($tempPath, $uploadPath)) {
                 copy($uploadPath, $uploadPath1);
                }
                
                //IMAGE SAVED IN FOLDER NOW RESIZE IT
                if (file_exists($dirPath.$aictefileWithExtension)) {

                    $uploadimage = $dirPath.$aictefileWithExtension;//$dirPath.$_FILES['file']['name'];
                    $newname = $aictefileWithExtension;//$_FILES['file']['name'];

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
                            $image = imagecreatefromjpeg($dirPath.$aictefileWithExtension);
                        }else{
                            $image = imagecreatefrompng($dirPath.$aictefileWithExtension);
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

            $documentObj->name= $aictefileWithExtension;
            $documentObj->fullimage= $aictefileWithExtension1;
            $documentObj->caption= '';
            $documentObj->width = round($newwidth);
            $documentObj->height = round($newheight);
            $documentObj->users_id = $collegeuserID; 
            $documentObj->misc = 'affiliationLettersImage'; 
            $documentObj->category_id = '1'; //hard-code value
            $documentObj->save();
        }else{

            }
        }

        if($request->file('ugcDocument'))
        {   
            $documentObj1 = new Gallery;

            // $file3=$request->file('ugcDocument')->getClientOriginalName();
            // $request->file('ugcDocument')->move(
            // base_path().'/public/document/'.$slug.'/', $file3
            // );

            if($request->file('ugcDocument'))
            {            
                if( $_FILES["collegeLogo"]["size"] <= '7340032' ){
                    $extensionOfFile = $_FILES[ 'ugcDocument' ][ 'type' ];
                    
                    $path = $_FILES['ugcDocument']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $ext = strtolower($ext);
                    
                    $tempPath = $_FILES[ 'ugcDocument' ][ 'tmp_name' ];
                    $currentMyTime = strtotime('now');
                    $imageNameWithTime = Input::get('slug').'-'.$currentMyTime;
                    $ugcfileWithExtension = $imageNameWithTime.'2'.'.'.$ext;//$extensionOfFile;
                    $ugcfileWithExtension1 = $imageNameWithTime.'2'.'_original'.'.'.$ext;//$extensionOfFile;
                 
                    //Set the image folder path
                    if(env('APP_ENV') == 'local'){
                       $dirPath = public_path().'/gallery/'.Input::get('slug').'/';
                    }else{
                        $dirPath = public_path().'/gallery/'.Input::get('slug').'/';
                    }
                    

                    //Store the image with 300PX width
                    $uploadPath = $dirPath.$ugcfileWithExtension;
                    //Store the image with original width as original
                    $uploadPath1 = $dirPath.$ugcfileWithExtension1;
                    if (move_uploaded_file($tempPath, $uploadPath)) {
                     copy($uploadPath, $uploadPath1);
                    }
                
                    //IMAGE SAVED IN FOLDER NOW RESIZE IT
                    if (file_exists($dirPath.$ugcfileWithExtension)) {

                        $uploadimage = $dirPath.$ugcfileWithExtension;//$dirPath.$_FILES['file']['name'];
                        $newname = $ugcfileWithExtension;//$_FILES['file']['name'];

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
                                $image = imagecreatefromjpeg($dirPath.$ugcfileWithExtension);
                            }else{
                                $image = imagecreatefrompng($dirPath.$ugcfileWithExtension);
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

            $documentObj1->name= $ugcfileWithExtension;
            $documentObj1->fullimage= $ugcfileWithExtension1;
            $documentObj1->width = round($newwidth);
            $documentObj1->height = round($newheight);
            $documentObj1->users_id = $collegeuserID; 
            $documentObj1->caption = '';
            $documentObj1->misc = 'affiliationLettersImage'; 
            $documentObj1->category_id = '1'; //hard-code value

            $documentObj1->save();
            }else{

            }
        }

        /*** Address Details ****/  
        $collegeProfileID = CollegeProfile::where('slug', '=', $slug)->firstOrFail();
        if( $addressTypeName == '1' ){
            $addressObj = Address::where('addresstype_id', '=', '1')->where('collegeprofile_id', '=', $collegeProfileID->id)->firstOrFail();    
        }else{
            $addressObj = Address::where('addresstype_id', '=', '2')->where('collegeprofile_id', '=', $collegeProfileID->id)->firstOrFail();    
        }

        
        $addressObj->name = $careOfName;
        $addressObj->address1 = $address1;
        $addressObj->address2 = $address2;
        $addressObj->landmark = $landmark;
        $addressObj->postalcode = $postalCode;
        $addressObj->addresstype_id = $addressTypeName;
        $addressObj->city_id = $cityName;

        
        $addressObj->collegeprofile_id = $collegeProfileID->id;

        $addressObj->save();


        if (($addressObj->addresstype_id == 1) || ($addressObj->addresstype_id == 2) && (!empty($addressObj->collegeprofile_id))) {
            $updateCollegeAddress = $this->fetchDataServiceController->updateCollegeAddress($addressObj->addresstype_id, $addressObj->collegeprofile_id);
        }

        if( $request->checkboxInline == 'on' ){
            $addressObj1 = Address::where('addresstype_id', '=', '1')->where('collegeprofile_id', '=', $collegeProfileID->id)->firstOrFail();
            $addressObj1->name = $careOfName;
            $addressObj1->address1 = $address1;
            $addressObj1->address2 = $address2;
            $addressObj1->landmark = $landmark;
            $addressObj1->postalcode = $postalCode;
            $addressObj1->addresstype_id = '1';
            $addressObj1->city_id = $cityName;

            
            $addressObj1->collegeprofile_id = $collegeProfileID->id;

            $addressObj1->save();

            $addressObj2 = Address::where('addresstype_id', '=', '2')->where('collegeprofile_id', '=', $collegeProfileID->id)->firstOrFail();
            $addressObj2->name = $careOfName;
            $addressObj2->address1 = $address1;
            $addressObj2->address2 = $address2;
            $addressObj2->landmark = $landmark;
            $addressObj2->postalcode = $postalCode;
            $addressObj2->addresstype_id = '2';
            $addressObj2->city_id = $cityName;

            
            $addressObj2->collegeprofile_id = $collegeProfileID->id;

            $addressObj2->save();
        }


        
        if(!empty($collegeuserID))
        {
            //Send Mail For Admin
            $adminEmail = 'signupreview@admissionx.com';

            $administratorName = Input::get('administratorName');
            $emailAddress = Input::get('emailAddress');
            $phoneNo = Input::get('phoneNo');

            $careOfName = Input::get('careOfName');
            $address1 = Input::get('address1');
            $address2 = Input::get('address2');
            $landmark = Input::get('landmark');
            $postalCode = Input::get('postalCode');
           /* $addressTypeName = Input::get('addressTypeName');
            $cityName = Input::get('cityName');
            $collegeType = Input::get('collegeType');
            $collegeuserID = Input::get('collegeuserID');*/

            $collegeTypeObj = DB::table('collegetype')
                    ->where('id' ,'=', $collegeType)
                    ->select('collegetype.id as collegeTypeId','collegetype.name as collegeTypeName')
                    ->get()
                    ;
            $collegeTypeName = $collegeTypeObj[0]->collegeTypeName;

            $cityNameObj = DB::table('city')
                    ->where('id' ,'=', $cityName)
                    ->select('city.id as cityId','city.name as cityName')
                    ->get()
                    ;
            $cityNameData =  $cityNameObj[0]->cityName;

            $addressTypeObj = DB::table('addresstype')
                        ->where('id' ,'=', $addressTypeName)
                        ->select('addresstype.id as addressTypeId','addresstype.name as addressTypeName')
                        ->get()
                        ;
            $addressTypeNameData = $addressTypeObj[0]->addressTypeName;

            $usersDataObj1 = DB::table('users')
                        ->where('id' ,'=', $collegeuserID)
                        ->select('users.id', 'users.suffix','users.firstname as firstName', 'users.middlename as middleName', 'users.lastname as lastName', 'users.email as userEmailAddress', 'users.phone as userPhone')
                        ->orderBy('users.id', 'DESC')
                        ->get();

            $firstName = $usersDataObj1[0]->firstName;
            $middleName = $usersDataObj1[0]->middleName;
            $lastName = $usersDataObj1[0]->lastName;
            $userEmailAddress = $usersDataObj1[0]->userEmailAddress;
            $userPhone = $usersDataObj1[0]->userPhone;

            try {
               if(!empty($emailAddress) && ($this->fetchDataServiceController->isValidEmail($emailAddress) == 1))
                {
                    /**Swift Mailer Data Fetching***/        
                    \Mail::send('website.home.emails.signUpDetails', array('userEmailAddress' => $userEmailAddress,'firstName' => $firstName,'middleName' => $middleName,'lastName' => $lastName, 'userPhone'=>$userPhone,'administratorName'=>$administratorName,'emailAddress'=>$emailAddress,'phoneNo'=>$phoneNo,'careOfName'=>$careOfName,'address1'=>$address1,'address2'=>$address2,'landmark'=>$landmark,'postalCode'=>$postalCode,'collegeTypeName'=>$collegeTypeName,'cityNameData'=>$cityNameData,'addressTypeNameData'=>$addressTypeNameData), function($message) use ($adminEmail)
                    {
                        $message->to($adminEmail, 'AdmissionX')->subject('New college registrations with AdmissionX');
                    }); 
                } 
            } catch ( \Swift_TransportException $e) {
                
            }
           
        }

        return redirect('/sucess-signup-details');
    }
    
    
    public function sucessSignUp()
    {
        return view('college/register.sucess');
    }


    public function getCityTotal( Request $request )
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

    public function verifyEmailAddress($token)
    {
        //VALIDATE TOKEN AGAINST EMAIL ADDRESS AND SET USER STATUS TO 1(Active) FROM 2(Inactive)
        try {
            $remember_token = $token;
            $userObj = User::where('token', '=' ,$token)->firstOrFail();
            $userObj->token = '';
            $userObj->userstatus_id = '1';
            $userObj->save();    

            if ($userObj->userrole_id == 3) {
                if(Session::has('isUserPost') && (Session::get('isUserPost') == 2)){
                    $collegemasterId = Session::get('collegemasterId'); 
                    $collegeProfileObj = CollegeMaster::where('collegemaster.id', $collegemasterId)
                                    ->leftjoin('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->select('collegeprofile.slug as collegeSlug')
                                    ->first();
                                    
                    $collegeSlugUrl = $collegeProfileObj->collegeSlug;

                    if(env('APP_ENV') == 'local'){
                       $dirUrl = url().'/student/apply-course-details/'.$collegemasterId.'/'.$collegeSlugUrl;
                    }else{
                        $dirUrl = url().'/student/apply-course-details/'.$collegemasterId.'/'.$collegeSlugUrl;
                    }
                    Session::flash('success', 'Thank you for email confirmation! Happy to have you on our board.');
                    Session::forget('collegemasterId');
                    Session::forget('isUserPost');
                    return Redirect::to($dirUrl);
                }
                
                $postPublishDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postPublishDataFromSession($userObj->id);
            }

            $postAskExamDataFromSession = app('App\Http\Controllers\website\SocialConnectController')->postAskExamDataFromSession($userObj->id);

            Session::flash('verifiedEmail', 'Thank you for email confirmation! Happy to have you onboard.');
            return redirect('login');
        } catch ( \Exception $e) {            
            Session::flash('verifiedEmail', 'Email verification link is broken.');
            return redirect('login');
        }        
    }

    public function resendEmailAddressLink($emailAddress)
    {
        $encrytEmail = md5($emailAddress);
        $userObj = User::where('email', '=' ,$emailAddress)->firstOrFail();
        $userObj->token = $encrytEmail;
        $userObj->userstatus_id = '2';
        $userObj->save();

        $getCollegeName = User::where('email', '=', $emailAddress)->first();
        $collegeName = $getCollegeName->firstname;

        // if(env('APP_ENV') == 'local'){
        //    $baseUrl = env('APP_URL').'/verify-email-address/';
        // }else{
        //    $baseUrl = 'https://'.env('ipAddressForRedirect').'/verify-email-address/';
        // }
        $baseUrl = env('APP_URL').'/verify-email-address/';
        $ecyEmailUrl = $baseUrl.$encrytEmail;

        //SET TRY CATCH BLOCK FOR THANK YOU FOR REGISTERING
        /*try {
           if(!empty($emailAddress) && ($this->fetchDataServiceController->isValidEmail($emailAddress) == 1))
            {
                //Swift Mailer Data Fetching   
                \Mail::send('website.home.proposalOfCollegeSignUp', array('email' => $emailAddress, 'ecyEmailUrl' => $ecyEmailUrl), function($message) use ($emailAddress)
                {
                    $message->to($emailAddress, 'AdmissionX')->subject('Thank you for registering with AdmissionX');
                });  
            } 
        } catch ( \Swift_TransportException $e) {
            
        }*/

        $resultMailSet = $this->sendCollegeSignupMail($emailAddress, $ecyEmailUrl, $collegeName);

        //REDIRECT TO LOGIN PAGE
        Session::flash('pleaseVierfyYourEmail', 'Please verify your email to get the access on our platform Thank You.');
        return redirect('login');

    }

    public function sendCollegeSignupMail($emailAddress, $ecyEmailUrl, $collegeName)
    {
         try {
            if(!empty($emailAddress))
            {
                $mail = new PHPMailer\PHPMailer\PHPMailer;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                stream_context_set_default( [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);
                get_headers('https://www.admissionx.info/');

                $mail->SMTPDebug = 0;                                   // Enable verbose debug output

                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username     = Config::get('systemsetting.WelcomeEmail');  // SMTP username
                $mail->Password     = Config::get('systemsetting.WelcomeEmailPassword');  // SMTP password
                $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                      // TCP port to connect to

                $mail->setFrom('welcome@admissionx.info', 'Welcome to AdmissionX');
                $mail->addAddress($emailAddress, 'AdmissionX');       // Add a recipient

                $message = file_get_contents('assets/proposalOfCollegeSignUp.html');

                $message = str_replace('%collegeName%', $collegeName, $message);
                $message = str_replace('%ecyEmailUrl%', $ecyEmailUrl, $message);
                $mail->isHTML(true);                                     // Set email format to HTML

                $mail->Subject = 'Thank you for registering with AdmissionX';
                $mail->Body    =  ''.$message.'';

                if(!$mail->send()) {
                    // echo 'Message could not be sent.';
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    Session::flash('sendEmailMsg', 'Email send Succesfully!');
                }
            }
        } catch (Exception $e) {
            
        }        
    }


    public function requestCollegeAccountFormSubmit()
    {
        if (!empty(Input::get('g-recaptcha-response'))) {
            //GET PARAMS
            $collegeName = Input::get('collegeName');
            $emailAddress = Input::get('email');
            $contactNumber = Input::get('contactNumber');
            $contactPersonName = Input::get('contactPersonName');
            //Check for already existing account
            $checkEmailDuplicateObj = DB::table('users')
                                        ->where('email' ,'=', $emailAddress)
                                        ->take(1)
                                        ->get();

            if(empty($checkEmailDuplicateObj)){
                $checkExistingRequestObj = DB::table('request_for_create_college_accounts')
                                        ->where('email' ,'=', $emailAddress)
                                        ->where('status' ,'=', 0)
                                        ->count();
                if ($checkExistingRequestObj == 0) {
                    //STORE INTO USERS TABLE
                    $requestObj = New RequestForCreateCollegeAccount;
                    $requestObj->collegeName = $collegeName;
                    $requestObj->email = $emailAddress;
                    $requestObj->phone = $contactNumber;
                    $requestObj->contactPersonName = $contactPersonName;
                    $requestObj->employee_id = Auth::id();
                    $requestObj->status = '0'; //ROLE_COLLEGE 
                    $requestObj->save();

                    $getCollegeRequestObj  =   DB::table('request_for_create_college_accounts')
                            ->where('request_for_create_college_accounts.id', '=', $requestObj->id)
                            ->first();

                    $bodyContent    = '<ul>
                                        <li>College Name : '.$getCollegeRequestObj->collegeName.'</li>
                                        <li>Email : '.$getCollegeRequestObj->email.'</li>
                                        <li>Phone : '.$getCollegeRequestObj->phone.'</li>
                                        <li>Contact Person Name : '.$getCollegeRequestObj->contactPersonName.'</li>
                                    </ul>';

                    $send_to = $getCollegeRequestObj->email;
                    $send_cc = null;
                    $send_bcc = null;
                    $slug = 'reply_college_profile_requester';
                    $title =  Config::get('systemsetting.TITLE');
                    $form_name = $getCollegeRequestObj->collegeName;

                    $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
                    $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

                    $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
                            ->where('users.userstatus_id','=', '1')
                            ->where('users.userrole_id','=', '1')
                            ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                            ->get();

                    $slug1 = 'college_profile_request_form';
                    foreach ($getTheEmailAdmin as $key => $value) {
                        $fullname1 = $value->fullname;
                        $send_to1 = $value->email;
                        $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
                        $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
                    }

                    try {
                        /***Send SMS *******************************/
                        if(!empty($contactNumber))
                        {
                            $userMobileNo = $contactNumber;  
                            $smsMessageData = Config::get('systemsetting.REQUEST_COLLEGE_SIGNUPMSG').' '.$emailAddress.' '.Config::get('systemsetting.SMS_GROUP_NAME_1');

                            $resultSet = $this->fetchDataServiceController->sendTextSmsOnMobile($userMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_STUDENT_APPLICATION_SUBMITTED'));
                            
                            /*$userIdHorizonSms = Config::get('app.userIdHorizonSms');
                            $passwordHorizonSms = Config::get('app.passwordHorizonSms');
                            $accountFromHorizon = Config::get('app.accountFromHorizon');

                            $url = 'http://210.210.26.40/sendsms/push_sms.php';

                            $client = new \GuzzleHttp\Client();
                            $res = $client->request('POST', $url, [
                                'form_params' => [
                                    'user' => urlencode($userIdHorizonSms),
                                    'pwd' => urlencode($passwordHorizonSms),
                                    'from' => urlencode($accountFromHorizon),
                                    'to' => urlencode($userMobileNo),
                                    'msg' => $smsMessageData,
                                ]
                            ]);*/  
                        } 
                    }catch (\Exception $e) {
                        return $e;
                    }
                    Session::flash('alert_class', 'alert-success');  
                    Session::flash('flash_message', 'Your college profile request has been submitted!');    
                }else{
                    Session::flash('alert_class', 'alert-danger');  
                    Session::flash('flash_message', 'This email address request already exists, try again with another email or wait for confirmation.');  
                }
            }else{
                Session::flash('alert_class', 'alert-danger');  
                Session::flash('flash_message', 'This email address is already exist with another user, try again with another user.');  
            } 
        }else{
            Session::flash('alert_class', 'alert-danger');  
            Session::flash('flash_message', 'Please verify the captcha.');  
        }        
        return redirect::back();
    }
}