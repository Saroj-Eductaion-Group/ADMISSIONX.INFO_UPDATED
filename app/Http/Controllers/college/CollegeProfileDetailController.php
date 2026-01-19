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
use Session;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use App\Models\Gallery;
use App\Models\Document;

class CollegeProfileDetailController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
               
    }

    public function uploadCollegeLogo(Request $request)
    {   
        if($request->file('uploadCollegeLogo'))
        {            
            if( $_FILES["uploadCollegeLogo"]["size"] <= '50400320' ){

            $extensionOfFile = '';
            $path = $_FILES['uploadCollegeLogo']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            $tempPath = $_FILES[ 'uploadCollegeLogo' ][ 'tmp_name' ];
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
                // unlink($dirPath.$galleryObj->name);
                // unlink($dirPath.$galleryObj->fullimage);                

                $galleryObj->name = $fileWithExtension;
                $galleryObj->fullimage = $fileWithExtension1;
                $galleryObj->caption = 'College Logo';
                $galleryObj->width = round($newwidth);
                $galleryObj->height = round($newheight);
                $galleryObj->users_id = Auth::Id(); 
                $galleryObj->category_id = '1';
                $galleryObj->misc = 'college-logo-img';
                $galleryObj->employee_id = Auth::id();
                $galleryObj->save();
            }else{
                $galleryObj = new Gallery;

                $galleryObj->name = $fileWithExtension;
                $galleryObj->fullimage = $fileWithExtension1;
                $galleryObj->caption = 'College Logo';
                $galleryObj->width = round($newwidth);
                $galleryObj->height = round($newheight);
                $galleryObj->users_id = Auth::Id(); 
                $galleryObj->category_id = '1';
                $galleryObj->misc = 'college-logo-img';
                $galleryObj->employee_id = Auth::id();

                $galleryObj->save();
            }
            
        }else{

        }

            return redirect()->route('college_dash', Input::get('slugUrl'));
        }
        return redirect()->route('college_dash', Input::get('slugUrl'));
    }

    public function deleteCollegeLogo(Request $request, $galleryId, $slugUrl)
    {   
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/gallery/'.$slugUrl.'/';
        }else{
            $dirPath = public_path().'/gallery/'.$slugUrl.'/';
        }

        $galleryObj = Gallery::findOrFail($galleryId);

        //UNLINK THE PREVIOUS IMAGE                
        try {
            if( !empty($galleryObj->fullimage) ){
            unlink($dirPath.$galleryObj->name);
            unlink($dirPath.$galleryObj->fullimage);    
        }
        } catch (\Exception $e) {
            
        }

        $galleryObj->name = '';
        $galleryObj->fullimage = '';
        $galleryObj->employee_id = Auth::id();
        $galleryObj->save();
        // Gallery::destroy($galleryId);
    
        return redirect()->route('college_dash', $slugUrl);
    }

    public function deleteCollegeGallery(Request $request, $galleryId, $slugUrl)
    {   
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/gallery/'.$slugUrl.'/';
        }else{
            $dirPath = public_path().'/gallery/'.$slugUrl.'/';
        }

        $galleryObj = Gallery::findOrFail($galleryId);

        //UNLINK THE PREVIOUS IMAGE                
        try {
            if( !empty($galleryObj->fullimage) ){
                unlink($dirPath.$galleryObj->name);
                unlink($dirPath.$galleryObj->fullimage);    
            }   
        } catch (\Exception $e) {
            
        }

        Gallery::destroy($galleryId);
    
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.$slugUrl.'#photosvideos';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.$slugUrl.'#photosvideos';
        }
        return Redirect::to($dirUrl);
    }

    public function uploadGalleryImage(Request $request)
    {   
        foreach($_FILES["uploadGalleryImage"]["tmp_name"] as $key=>$tmp_name)
        {   
            if( $_FILES["uploadGalleryImage"]["size"][$key] <= '50400320' ){
            $error=array();
            $extension=array("jpeg","jpg","png");
            $file_name=$_FILES["uploadGalleryImage"]["name"][$key];
            $file_tmp=$_FILES["uploadGalleryImage"]["tmp_name"][$key];
            $ext=pathinfo($file_name,PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            //Set the image folder path
            if(env('APP_ENV') == 'local'){
               $dirPath = public_path().'/gallery/'.Input::get('slugUrl').'/';
            }else{
                $dirPath = public_path().'/gallery/'.Input::get('slugUrl').'/';
            }

            if(in_array($ext,$extension))
            {   
                $currentMyTime = strtotime('now');
                $imageNameWithTime = Input::get('slugUrl').'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'-'.$key.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'-'.$key.'_original.'.$ext;

                //$tempPath = $_FILES[ 'uploadGalleryImage' ][ 'tmp_name' ][$key];
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
                            //header('Content-Type: image/png');
                            imagepng( $thumb, $resize_image ); 
                        }
                        // 100 Represents the quality of an image you can set and ant number in place of 100.
                        $out_image=addslashes(file_get_contents($resize_image));    
                    }else{
                        $newwidth = $width;
                        $newheight = $height;
                    }            
                }

                $galleryObj = new Gallery;

                $galleryObj->name = $fileWithExtension;
                $galleryObj->fullimage = $fileWithExtension1;
                $galleryObj->caption = '';
                $galleryObj->width = round($newwidth);
                $galleryObj->height = round($newheight);
                $galleryObj->users_id = Auth::Id(); 
                $galleryObj->category_id = '1';
                $galleryObj->misc = 'college-upload-gallery-img';
                $galleryObj->employee_id = Auth::id();
                $galleryObj->save();  
                
            }
        }else{
            //

        }
        }   

        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#photosvideos';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#photosvideos';
        }
        return Redirect::to($dirUrl);
        //return redirect()->route('college_dash', Input::get('slugUrl'));     
    }

    public function uploadDocumentImage(Request $request)
    {   
        foreach($_FILES["uploadDocumentImage"]["tmp_name"] as $key=>$tmp_name)
        {   
            if( $_FILES["uploadDocumentImage"]["size"][$key] <= '50400320' ){
            $error=array();
            $extension=array("jpeg","jpg","png", "pdf");
            $file_name=$_FILES["uploadDocumentImage"]["name"][$key];
            $file_tmp=$_FILES["uploadDocumentImage"]["tmp_name"][$key];
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

                //$tempPath = $_FILES[ 'uploadDocumentImage' ][ 'tmp_name' ][$key];
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
                $documentObj->category_id = '2'; //hard-code value
                $documentObj->employee_id = Auth::id();
                $documentObj->save();  
                
            }
            }else{
            
        }
        }   
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#awardsach';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#awardsach';
        }
        return Redirect::to($dirUrl);
    }

    public function deleteUploadedDocument(Request $request, $galleryId, $slugUrl)
    {   
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/document/'.$slugUrl.'/';
        }else{
            $dirPath = public_path().'/document/'.$slugUrl.'/';
        }

        $galleryObj = Document::findOrFail($galleryId);

        //UNLINK THE PREVIOUS IMAGE
        try {
                if( !empty($galleryObj->name) ){
                    if( $galleryObj->name != 'no-image-upload' ){
                        unlink($dirPath.$galleryObj->name);
                        unlink($dirPath.$galleryObj->fullimage);          
                    }   
                }
        } catch (\Exception $e) {
            
        }        

        Document::destroy($galleryId);
    
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.$slugUrl.'#awardsach';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.$slugUrl.'#awardsach';
        }
        return Redirect::to($dirUrl);
    }

    public function uploadCollegeVideoUrl(Request $request)
    {
        $valid = preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", Input::get('youtubeUrl'));
        if ($valid) {
            $galleryObj = new Gallery;
            $galleryObj->name = Input::get('youtubeUrl');
            $galleryObj->caption = 'videogallery';
            $galleryObj->misc = 'videogallery';
            $galleryObj->users_id = Auth::Id(); 
            $galleryObj->category_id = '1'; //hard-code value
            $galleryObj->employee_id = Auth::id();
            $galleryObj->save(); 

            $dataArray = array(
                        'code' => '200',
                        'response' => 'success',
                    );

        } else {
            $dataArray = array(
                        'code' => '401',
                        'response' => 'failure',
                    );            
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;        
    }

    public function uploadCollegeAwardsDesc(Request $request)
    {
        $documentObj = new Document;
        $documentObj->name = 'no-image-upload';
        $documentObj->description = Input::get('description');
        $documentObj->users_id = Auth::Id(); 
        $documentObj->category_id = '2'; //hard-code value
        $documentObj->employee_id = Auth::id();
        $documentObj->save(); 

        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#awardsach';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#awardsach';
        }
        return Redirect::to($dirUrl);
    }

    public function uploadAffiliationLettersImage(Request $request)
    {   
        foreach($_FILES["uploadAffiliationLettersImage"]["tmp_name"] as $key=>$tmp_name)
        {   
            if( $_FILES["uploadAffiliationLettersImage"]["size"][$key] <= '50400320' ){
            $error=array();
            $extension=array("jpeg","jpg","png","pdf");
            $file_name=$_FILES["uploadAffiliationLettersImage"]["name"][$key];
            $file_tmp=$_FILES["uploadAffiliationLettersImage"]["tmp_name"][$key];
            $ext=pathinfo($file_name,PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            //Set the image folder path
            if(env('APP_ENV') == 'local'){
               $dirPath = public_path().'/gallery/'.Input::get('slugUrl').'/';
            }else{
                $dirPath = public_path().'/gallery/'.Input::get('slugUrl').'/';
            }

            if(in_array($ext,$extension))
            {   
                $currentMyTime = strtotime('now');
                $imageNameWithTime = Input::get('slugUrl').'-'.$currentMyTime;
                $fileWithExtension = $imageNameWithTime.'-'.$key.'.'.$ext;
                $fileWithExtension1 = $imageNameWithTime.'-'.$key.'_original.'.$ext;

                //$tempPath = $_FILES[ 'uploadAffiliationLettersImage' ][ 'tmp_name' ][$key];
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
                            //header('Content-Type: image/png');
                            imagepng( $thumb, $resize_image ); 
                        }
                        // 100 Represents the quality of an image you can set and ant number in place of 100.
                        $out_image=addslashes(file_get_contents($resize_image));    
                    }else{
                        $newwidth = $width;
                        $newheight = $height;
                    }            
                }

                $galleryObj = new Gallery;

                $galleryObj->name = $fileWithExtension;
                $galleryObj->fullimage = $fileWithExtension1;
                $galleryObj->caption = '';
                $galleryObj->width = round($newwidth);
                $galleryObj->height = round($newheight);
                $galleryObj->users_id = Auth::Id(); 
                $galleryObj->category_id = '1';
                $galleryObj->misc = 'affiliationLettersImage';
                $galleryObj->employee_id = Auth::id();
                $galleryObj->save();  
                
            }
        }else{
          
        }
        }   
         Session::flash('affiliationAccreditationLetters', 'Documents has been Uploaded!');
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#profile';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.Input::get('slugUrl').'#profile';
        }
        return Redirect::to($dirUrl);
        // return redirect()->route('college_dash', Input::get('slugUrl'));     
    }

    public function deleteCollegeAffiliation(Request $request, $galleryId, $slugUrl)
    {   
        //Set the image folder path
        if(env('APP_ENV') == 'local'){
           $dirPath = public_path().'/gallery/'.$slugUrl.'/';
        }else{
            $dirPath = public_path().'/gallery/'.$slugUrl.'/';
        }

        $galleryObj = Gallery::findOrFail($galleryId);

        try {
            //UNLINK THE PREVIOUS IMAGE                
        if( !empty($galleryObj->fullimage) ){
            unlink($dirPath.$galleryObj->name);
            unlink($dirPath.$galleryObj->fullimage);    
        }
        } catch (\Exception $e) {
            
        }

        Gallery::destroy($galleryId);
        Session::flash('affiliationAccreditationLetters', 'Document has been deleted successfully!');
        if(env('APP_ENV') == 'local'){
           $dirUrl = url().'/college/dashboard/edit/'.$slugUrl.'#profile';
        }else{
            $dirUrl = url().'/college/dashboard/edit/'.$slugUrl.'#profile';
        }
        return Redirect::to($dirUrl);
    }
}