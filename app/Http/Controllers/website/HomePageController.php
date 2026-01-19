<?php

namespace App\Http\Controllers\website;

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
use Mailchimp;
use Cache;
use Artisan;
use Config;
use App\Models\Subscribe;
use App\Models\Blog;
use App\Models\News;
use App\Models\NewsType;
use App\Models\NewsTag;
use App\Models\Career as Career;
use App\Models\Document as Document;
use App\Models\Query as Query;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\CollegeMaster;
use App\Models\CollegeProfile;
use App\Models\StudentProfile;
use Illuminate\Database\QueryException as QueryException;
use App\Models\LatestUpdate;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;
use App\Models\AskQuestion;
use App\Models\AskQuestionAnswer;
use App\Models\AskQuestionAnswerComment;
use App\Models\AskQuestionTag;
use App\Models\CollegeReview;
use App\Models\Testimonial;

class HomePageController extends Controller
{

    protected $fetchDataServiceController;
    protected $mailchimp;
    protected $listId = 'bc80df542e';

    public function __construct(Mailchimp $mailchimp, FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
        $this->mailchimp = $mailchimp;
    }
    
    public function aboutUs()
    {
        // $slugName = 'about-us';
        // $getAboutUsPageDataObj = DB::table('pages')
        //                     ->where('pages.slug', '=', $slugName)
        //                     ->where('pages.status', '=', '1')
        //                     ->select('pages.id as pagesId', 'pages.title', 'pages.body', 'pages.slug','pages.status')
        //                     ->take(1)
        //                     ->get()
        //                     ;
        
        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(1);


         $getCollegesYoutubeObj = DB::table('gallery')
                        ->leftjoin('category', 'gallery.category_id', '=', 'category.id')
                        ->where('gallery.caption', '=', 'Youtube Link Update')
                        ->where('gallery.misc', '=', 'collegeyoutubeurl')
                        ->select('gallery.id', 'gallery.name as galleryName','caption','gallery.misc')
                        ->orderBy('gallery.id', 'DESC')
                        ->take(1)
                        ->get();
                            
        if( empty($getCollegesYoutubeObj) ){
            $getCollegesYoutubeObj = '';
        }

        $getStudentYoutubeObj = DB::table('gallery')
                        ->leftjoin('category', 'gallery.category_id', '=', 'category.id')
                        ->where('gallery.caption', '=', 'Youtube Link Update')
                        ->where('gallery.misc', '=', 'studentyoutubeurl')
                        ->select('gallery.id', 'gallery.name as galleryName','caption','gallery.misc')
                        ->orderBy('gallery.id', 'DESC')
                        ->take(1)
                        ->get();
                            
        if( empty($getStudentYoutubeObj) ){
            $getStudentYoutubeObj = '';
        }

        $seoSlugName = 'about-us';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home/pages.about', compact('seocontent', 'getPageContentDataObj'))
            ->with('getCollegesYoutubeObj', $getCollegesYoutubeObj)
            ->with('getStudentYoutubeObj', $getStudentYoutubeObj);
        //->with('getAboutUsPageDataObj', $getAboutUsPageDataObj);
    }
 
    public function contactUs()
    {
        // $slugName = 'contact-us';
        // $getContactUsPageDataObj = DB::table('pages')
        //                     ->where('pages.slug', '=', $slugName)
        //                     ->where('pages.status', '=', '1')
        //                     ->select('pages.id as pagesId', 'pages.title', 'pages.body', 'pages.slug','pages.status')
        //                     ->take(1)
        //                     ->get()
        //                     ;

        $seoSlugName = 'contact-us';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(6);

        return view('website/home/pages.contactus',compact('seocontent','getPageContentDataObj'));
        // ->with('getContactUsPageDataObj', $getContactUsPageDataObj);
    }

    public function careers()
    {
        // $slugName = 'careers';
        // $getCareersPageDataObj = DB::table('pages')
        //                     ->where('pages.slug', '=', $slugName)
        //                     ->where('pages.status', '=', '1')
        //                     ->select('pages.id as pagesId', 'pages.title', 'pages.body', 'pages.slug','pages.status')
        //                     ->take(1)
        //                     ->get()
        //                     ;
        $cityNameObj = DB::table('city')
                    ->where('city.cityStatus','=','1')   
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;
        $stateNameObj = DB::table('state')
                    ->orderBy('state.name', 'ASC')
                    ->get()
                    ;

        $seoSlugName = 'careers';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home/pages.careers', compact('seocontent'))
        ->with('cityNameObj', $cityNameObj)
        ->with('stateNameObj', $stateNameObj);
        //->with('getCareersPageDataObj', $getCareersPageDataObj);
    }

    public function counselling()
    {
        $seoSlugName = 'counselling';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(8);

        return view('website/home/pages.counselling', compact('seocontent','getPageContentDataObj'));
        
    }
    
    public function helpCenter()
    {
        $seoSlugName = 'help-center';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home/pages.helpCenter', compact('seocontent'));
    }

    public function press()
    {
        // $slugName = 'press';
        // $getPressPageDataObj = DB::table('pages')
        //                     ->where('pages.slug', '=', $slugName)
        //                     ->where('pages.status', '=', '1')
        //                     ->select('pages.id as pagesId', 'pages.title', 'pages.body', 'pages.slug','pages.status')
        //                     ->take(1)
        //                     ->get()
        //                     ;

        $seoSlugName = 'press';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(11);

        return view('website/home/pages.press', compact('seocontent','getPageContentDataObj'));
        //->with('getPressPageDataObj', $getPressPageDataObj);
    }

    public function policies()
    {
        // $slugName = 'policies';
        // $getPoliciesPageDataObj = DB::table('pages')
        //                     ->where('pages.slug', '=', $slugName)
        //                     ->where('pages.status', '=', '1')
        //                     ->select('pages.id as pagesId', 'pages.title', 'pages.body', 'pages.slug','pages.status')
        //                     ->take(1)
        //                     ->get()
        //                     ;

        $seoSlugName = 'policies';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);


        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(10);

        return view('website/home/pages.policies', compact('seocontent','getPageContentDataObj'));
        //->with('getPoliciesPageDataObj', $getPoliciesPageDataObj);
    }

    public function termsAndPrivacy()
    {
        /*$slugName = 'terms-and-privacy';
        $getTermsPrivacyPageDataObj = DB::table('pages')
                            ->where('pages.slug', '=', $slugName)
                            ->where('pages.status', '=', '1')
                            ->select('pages.id as pagesId', 'pages.title', 'pages.body', 'pages.slug','pages.status')
                            ->take(1)
                            ->get()
                            ;*/

        $seoSlugName = 'terms-and-privacy';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(15);

        return view('website/home/pages.terms-and-privacy', compact('seocontent','getPageContentDataObj'));
        //->with('getTermsPrivacyPageDataObj', $getTermsPrivacyPageDataObj);
    }

    public function termsAndConditions()
    {
        $seoSlugName = 'terms-and-conditions';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(16);
        return view('website/home/pages.terms-and-conditions', compact('seocontent','getPageContentDataObj'));
    }

    public function trustAndSafety()
    {
        // $slugName = 'trust-and-safety';
        // $getTrustSafetyPageDataObj = DB::table('pages')
        //                     ->where('pages.slug', '=', $slugName)
        //                     ->where('pages.status', '=', '1')
        //                     ->select('pages.id as pagesId', 'pages.title', 'pages.body', 'pages.slug','pages.status')
        //                     ->take(1)
        //                     ->get()
        //                     ;

        $seoSlugName = 'trust-and-safety';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(17);


        return view('website/home/pages.trust-and-safety', compact('seocontent','getPageContentDataObj'));
        //->with('getTrustSafetyPageDataObj', $getTrustSafetyPageDataObj);
    }

    public function disclaimer()
    {
        // $slugName = 'disclaimer';
        // $getDisclaimerPageDataObj = DB::table('pages')
        //                     ->where('pages.slug', '=', $slugName)
        //                     ->where('pages.status', '=', '1')
        //                     ->select('pages.id as pagesId', 'pages.title', 'pages.body', 'pages.slug','pages.status')
        //                     ->take(1)
        //                     ->get()
        //                     ;

        $seoSlugName = 'disclaimer';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(7);

        return view('website/home/pages.disclaimer', compact('seocontent','getPageContentDataObj'));
        //->with('getDisclaimerPageDataObj', $getDisclaimerPageDataObj);
    }

    public function termsOfService(Request $request)
    {
        $seoSlugName = 'terms-of-service';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(14);

        return view('website/home/pages.termsOfService',compact('seocontent','getPageContentDataObj'));  
    }

    public function blogDetailPage(Request $request , $slugUrl)
    {   
        $slugUrl = $request->slugUrl;
    
        $getBlogsObj = DB::table('blogs')
                        ->leftJoin('users', 'blogs.users_id', '=', 'users.id')
                        ->orderBy('blogs.id', 'DESC')
                        ->where('blogs.slug', '=', $slugUrl)
                        ->select('blogs.id','blogs.topic', 'blogs.description', 'blogs.isactive','blogs.featimage', 'blogs.fullimage','blogs.slug', 'users.firstname', 'blogs.created_at as createdDate')
                        ->take(1)
                        ->get()
                        ;
        if( empty($getBlogsObj) ){
            $getBlogsObj = '';
        }

        $seocontent = $this->fetchDataServiceController->seoContentDetailsById('blogId','blogpage',$getBlogsObj[0]->id);

        $getBlogsTopicObj = DB::table('blogs')
                        ->leftJoin('users', 'blogs.users_id', '=', 'users.id')
                        ->orderBy('blogs.id', 'DESC')
                        ->select('blogs.id','blogs.topic', 'blogs.description', 'blogs.isactive','blogs.featimage', 'blogs.fullimage','blogs.slug', 'users.firstname', 'blogs.created_at as createdDate')
                        ->take(4)
                        ->get()
                        ;
        if( empty($getBlogsTopicObj) ){
            $getBlogsTopicObj = '';
        }

        if(Auth::check()){
            //GET ALL BOOKMARK BLOGS
            $studentBookMarkInfoBlogs = DB::table('blogs')
                                        ->leftJoin('bookmarks', 'blogs.id', '=', 'bookmarks.blog_id')
                                        ->leftJoin('users', 'users.id', '=', 'bookmarks.student_id')
                                        ->where('users.id', '=', Auth::id())
                                        ->where('blogs.slug', '=', $slugUrl)
                                        ->where('users.userrole_id', '=', '3')
                                        ->where('bookmarks.bookmarktypeinfo_id', '=', '3')
                                        ->select('bookmarks.id', 'bookmarks.blog_id')
                                        ->orderBy('bookmarks.id', 'DESC')
                                        ->take(1)
                                        ->get()
                                        ;
            if( !empty($studentBookMarkInfoBlogs) ){
                $bookmarkedBlogId = $studentBookMarkInfoBlogs[0]->blog_id;                
                $bookmarkedTableId = $studentBookMarkInfoBlogs[0]->id;
            }else{
                $bookmarkedBlogId = '';
                $bookmarkedTableId = '';
            }            
        }else{
            $bookmarkedBlogId = '';
            $bookmarkedTableId = '';
        }

        if(!empty($getBlogsObj)){
            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.BLOGDETAIL').' by this User Id '.Auth::id().' Blog Id '.$getBlogsObj[0]->id);
        }
       
        return view('website/home/pages.blog-detail-page', compact('seocontent'))
            ->with('getBlogsObj', $getBlogsObj)
            ->with('getBlogsTopicObj', $getBlogsTopicObj)
            ->with('bookmarkedBlogId', $bookmarkedBlogId)
            ->with('bookmarkedTableId', $bookmarkedTableId)
            ;  
    }

    public function blogsListPage(Request $request )
    {   
        $getBlogsObj = Blog::orderBy('id', 'DESC')
                        ->leftJoin('users', 'blogs.users_id', '=', 'users.id')
                        ->paginate(5, array('blogs.id', 'blogs.topic', 'blogs.description', 'blogs.featimage', 'users.firstname', 'blogs.slug', 'blogs.created_at as createdDate'))
                        ;

        //GET THE LATEST 4 BLOGS
        $getBlogsObj1 = DB::table('blogs')
                        ->leftJoin('users', 'blogs.users_id', '=', 'users.id')
                        ->orderBy('blogs.id', 'DESC')
                        ->select('blogs.id', 'blogs.topic', 'blogs.description', 'blogs.featimage', 'users.firstname', 'blogs.slug', 'blogs.created_at as createdDate')
                        ->take(10)
                        ->get()
                        ;

        if( empty($getBlogsObj1) ){
            $getBlogsObj = '';
            $getBlogsObj1 = '';
        }

        if(Auth::check()){
            //GET ALL BOOKMARK BLOGS
            $studentBookMarkInfoBlogs = DB::table('users')
                            ->leftJoin('bookmarks', 'users.id', '=', 'bookmarks.student_id')
                            ->where('users.id', '=', Auth::id())
                            ->where('users.userrole_id', '=', '3')
                            ->where('bookmarks.bookmarktypeinfo_id', '=', '3')
                            ->select('bookmarks.id', 'bookmarks.blog_id')
                            ->get()
                            ;
        }else{
            $studentBookMarkInfoBlogs = '';
        }

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.BLOGINDEX').' by this User Id '.Auth::id());

        $seoSlugName = 'blog-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home/pages.blog-list-page', compact('seocontent'))
            ->with('getBlogsObj', $getBlogsObj)
            ->with('getBlogsObj1', $getBlogsObj1)
            ->with('studentBookMarkInfoBlogs', $studentBookMarkInfoBlogs)
            ;
    }

    public function admissionRegistrationPolicy(Request $request)
    {
        $seoSlugName = 'admission-registration-policy';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(2);

        return view('website/home/pages.admissionRegistrationPolicy',compact('seoSlugName','getPageContentDataObj'));  
    }

    public function advertiserAgreement(Request $request)
    {
        $seoSlugName = 'advertiser-agreement';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(3);
        return view('website/home/pages.advertiserAgreement', compact('seocontent','getPageContentDataObj'));  
    }

    public function cancellationRefunds(Request $request)
    {
        $seoSlugName = 'cancellation-refunds';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(4);

        return view('website/home/pages.cancellationRefunds', compact('seocontent','getPageContentDataObj'));  
    }

    public function collegePartnerAgreement(Request $request)
    {
        $seoSlugName = 'college-partner-agreement';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(5);

        return view('website/home/pages.collegePartnerAgreement', compact('seocontent','getPageContentDataObj'));  
    }

    public function paymentsTermsOfService(Request $request)
    {
        $seoSlugName = 'payments-terms-of-service';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(9);

        return view('website/home/pages.paymentsTermsOfService', compact('seocontent','getPageContentDataObj'));  
    }

    public function studentReferralPolicy(Request $request)
    {
        $seoSlugName = 'student-referral-policy';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(13);

        return view('website/home/pages.studentReferralPolicy', compact('seocontent','getPageContentDataObj'));  
    }

    public function privacyPolicy(Request $request)
    {
        $seoSlugName = 'privacy-policy';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $getPageContentDataObj = $this->fetchDataServiceController->pageContentDetailsById(12);

        return view('website/home/pages.privacyPolicy', compact('seocontent','getPageContentDataObj'));  
    }

    public function applyForJob(Request $request)
    {
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

        if( !empty(Input::get('achievementsawards')) ){
            $careerObj->achievementsawards = Input::get('achievementsawards');    
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
        if($request->file('cv'))
        {   
            $documentObj = new Document;
            if($request->file('cv'))
            {            
                if( $_FILES["cv"]["size"] <= '7340032' ){ 
                    $path = $_FILES['cv']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $ext = strtolower($ext);

                    $extensionOfFile = $_FILES[ 'cv' ][ 'type' ];
                    
                    $tempPath = $_FILES[ 'cv' ][ 'tmp_name' ];
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
            $documentObj->save();
        }else{

            }
        }
        
        if( !empty($cvWithExtension) ){
            $careerObj->cv = $cvWithExtension;    
        }
        $careerObj->save();

        return Redirect::back();
    }


    public function testimonials(Request $request)
    {   
        $getTestimonialDataObj = Testimonial::orderBy('testimonials.id', 'DESC')
                        ->leftJoin('users', 'testimonials.author','=','users.id')
                        ->where('testimonials.misc', '=', 'Testimonial Image')
                        ->paginate(30, array('testimonials.id as testimonialsID', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname'));


        $getTestimonialTopicDataObj = DB::table('testimonials')
                        ->leftJoin('users', 'testimonials.author','=','users.id')
                        ->select('testimonials.id as testimonialsID', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname')
                        ->orderBy('testimonials.id', 'DESC')
                        ->take(5)
                        ->get()
                        ;
        if( empty($getTestimonialTopicDataObj) ){
            $getTestimonialTopicDataObj = '';
        }

        $seoSlugName = 'testimonial-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
       
        return view('website/home/pages.testimonials',compact('seocontent'))
            ->with('getTestimonialDataObj', $getTestimonialDataObj)
            ->with('getTestimonialTopicDataObj', $getTestimonialTopicDataObj);  
    }

    public function testimonialDetails(Request $request , $testimonialsID)
    {   
        $testimonialId = $request->testimonialsID;
        $getTestimonialDataObj = DB::table('testimonials')
                        ->leftJoin('users', 'testimonials.author','=','users.id')
                        ->where('testimonials.misc', '=', 'Testimonial Image')
                        ->where('testimonials.id', '=', $testimonialId)
                        ->select('testimonials.id as testimonialsID', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname')
                        ->orderBy('testimonials.id', 'DESC')
                        ->take(1)
                        ->get();

        if( empty($getTestimonialDataObj) ){
            $getTestimonialDataObj = '';
        }

        $getTestimonialTopicDataObj = DB::table('testimonials')
                        ->leftJoin('users', 'testimonials.author','=','users.id')
                        ->orderBy('testimonials.id', 'DESC')
                        ->select('testimonials.id as testimonialsID', 'title', 'author', 'featuredimage', 'description', 'misc', 'slug','featuredimageBig', 'width', 'height','users.firstname','users.middlename','users.lastname')
                        ->take(5)
                        ->get()
                        ;

        $seoSlugName = 'testimonial-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
       
        return view('website/home/pages.testimonial-details',compact('seocontent'))
            ->with('getTestimonialDataObj', $getTestimonialDataObj)
            ->with('getTestimonialTopicDataObj', $getTestimonialTopicDataObj);  
    }

    public function helpCenterForm(Request $request)
    {
        if (!empty(Input::get('g-recaptcha-response'))) {

            if( !empty(Input::get('userName')) ){
                $userNameText = Input::get('userName');    
            }else{
                $userNameText = '';
            }

            if( !empty(Input::get('emailAddress')) ){
                $emailAddressText = Input::get('emailAddress');    
            }else{
                $emailAddressText = '';
            }

            if( !empty(Input::get('message')) ){
                $messageText = Input::get('message');    
            }else{
                $messageText = '';
            }
            
            $supportEmailAddress = 'support@admissionx.info';
           
            try{
                    if(!empty($supportEmailAddress) && ($this->fetchDataServiceController->isValidEmail($supportEmailAddress) == 1))
                    {
                       /**Swift Mailer Data TO admin_id***/        
                        \Mail::send('emailtemplate/help-center.queryToAdmin', array('email' => $supportEmailAddress, 'userNameData' => $userNameText,'emailAddressData' => $emailAddressText,'messageData' => $messageText   ), function($message) use ($supportEmailAddress)
                        {
                            $message->to($supportEmailAddress, 'AdmissionX')->subject('You got a new query');
                        });  
                    }
            }catch ( \Swift_TransportException $e) {                
            }

            Session::flash('confirmHelpCenter','Thanks for getting in touch. We will get back to you soon.');
            return Redirect::back();
        }else{
            Session::flash('errormessage','Please verify the captcha');
            return Redirect::back();
        }
    }

    public function getAllYears(Request $request)
    {
        CollegeProfile::orderBy('id', 'ASC')
                ->select('slug','id')
                ->chunk(50, function ($dataObj) {
                foreach ($dataObj as $value) {
                    echo '<br/>';
                    $directoryForDocument =  public_path().'/document/'.$value->slug;
                    $directoryForGallery =  public_path().'/gallery/'.$value->slug;

                    if (!file_exists($directoryForDocument)) {
                        mkdir($directoryForDocument, 0700);
                    }
                    if (!file_exists($directoryForGallery)) {
                        mkdir($directoryForGallery, 0700);
                    }

                    /*if (!mkdir($directoryForDocument, 0777, true)) {
                        die('Failed to create folders...'.$value->slug);
                    }
                    if (!mkdir($directoryForGallery, 0777, true)) {
                        die('Failed to create folders...'.$value->slug);
                    }*/
                    /*try {
                        if (!mkdir($directoryForDocument, 0777, true)) {
                            // die('Failed to create folders...');
                        }
                        if (!mkdir($directoryForGallery, 0777, true)) {
                            // die('Failed to create folders...');
                        }
                        echo "Successfully";
                    } catch (\Exception $e) {
                          echo 'Folder exists for '.$value->slug;              
                    }*/
                }
        });
        return 'Process Completed';
    }

    public function createAllStudentFolder(Request $request)
    {
        StudentProfile::orderBy('id', 'ASC')
                ->select('slug','id')
                ->chunk(50, function ($dataObj) {
                foreach ($dataObj as $value) {
                    echo '<br/>';
                    $directoryForDocument =  public_path().'/document/'.$value->slug;
                    $directoryForGallery =  public_path().'/gallery/'.$value->slug;

                    if (!file_exists($directoryForDocument)) {
                        mkdir($directoryForDocument, 0700);
                    }
                    if (!file_exists($directoryForGallery)) {
                        mkdir($directoryForGallery, 0700);
                    }
                }
        });
        return 'Process Completed';
    }

    public function errorPage()
    {
        $seoSlugName = '404-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
        return view('website.errors.404',compact('seocontent'));
    }

    public function latestUpdates(Request $request )
    {   
        $latestUpdates = LatestUpdate::orderBy('id', 'DESC')
                        ->leftJoin('users', 'latest_updates.users_id', '=', 'users.id')
                        ->where('status', '=', '1')
                        ->paginate(30, array('latest_updates.id', 'latest_updates.name', 'latest_updates.date', 'latest_updates.desc', 'latest_updates.status', 'latest_updates.users_id', 'latest_updates.employee_id', 'users.firstname'));

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('latest updates PAGE VIEW by this User Id '.Auth::id());


        $seoSlugName = 'latest-update-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home/pages.latest-updates', compact('latestUpdates','seocontent'));
    }

    public function websiteReviews(Request $request)
    {
        $query = CollegeReview::orderBy('college_reviews.id', 'DESC')
                ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id');

        $listOfSubmitReviews = $query->paginate(15, array('college_reviews.id','college_reviews.title', 'college_reviews.description', 'college_reviews.votes', 'college_reviews.academic', 'college_reviews.accommodation', 'college_reviews.faculty', 'college_reviews.infrastructure', 'college_reviews.placement', 'college_reviews.social', 'college_reviews.guestUserId', 'college_reviews.users_id', 'college_reviews.collegeprofile_id', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug as collegeSlug','college_reviews.created_at','studentprofile.slug as studentSlug'));

        $seoSlugName = 'review-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        return view('website/home/pages.website-reviews-page', compact('seocontent','listOfSubmitReviews'));
    }

    public function newsList(Request $request)
    {
        $getNewsObj = News::orderBy('id', 'DESC')
                        ->leftJoin('users', 'news.users_id', '=', 'users.id')
                         ->leftJoin('news_types', 'news.newstypeids', '=', 'news_types.id')
                        ->paginate(10, array('news.id', 'news.topic', 'news.featimage', 'news.fullimage', 'news.width', 'news.height', 'news.description', 'news.isactive', 'news.slug','newstypeids','newstagsids', 'news.created_at as createdDate','news_types.slug as newsslug','news_types.name as news_typesname', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname")))
                        ;


        $tags = [];
        foreach ($getNewsObj as $key => $value) {
            if (!empty($value->newstagsids)) {
                $tags = DB::select(DB::raw("SELECT news_tags.name, slug FROM news_tags where news_tags.id IN ($value->newstagsids)"));
            }
            $value->tagname = $tags;
        }

        //GET THE LATEST 4 BLOGS
        $getNewsTopicObj = DB::table('news')
                        ->leftJoin('users', 'news.users_id', '=', 'users.id')
                        ->orderBy('news.id', 'DESC')
                        ->select('news.id', 'news.topic', 'news.featimage', 'news.fullimage', 'news.width', 'news.height', 'news.description', 'news.isactive', 'news.slug','newstypeids','newstagsids', 'news.created_at as createdDate')
                        ->take(5)
                        ->get()
                        ;

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.BLOGINDEX').' by this User Id '.Auth::id());

        $seoSlugName = 'news-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $newsTypeObj = DB::table('news_types')->orderBy('name', 'ASC')->get();
        $newsTagObj = DB::table('news_tags')->orderBy('name', 'ASC')->get();
        $slugTagName = '';
        return view('website/home/pages.news-list-page', compact('getNewsTopicObj','seocontent','newsTypeObj','newsTagObj','getNewsObj','slugTagName'));
    }

    public function getNewsTypesAction(Request $request, $type, $slug)
    {
        $getNewsObj = [];
        $getNewsTopicObj = [];
        if( $type == 'tags'):
            $getNewsObj = self::getAllTagsWiseBlogs($slug);
            $getTagNameObj = DB::table('news_tags')
                    ->where('news_tags.slug', '=', $slug)
                    ->orderBy('news_tags.id','ASC')
                    ->select('id','name')
                    ->take(1)
                    ->get()
                    ;
            if (sizeof($getTagNameObj) > 0) {
                $slugTagName = $getTagNameObj[0]->name;
                $seocontent = $this->fetchDataServiceController->seoContentDetailsById('newsTagId','newstagpage',$getTagNameObj[0]->id);
            }else{
                $slugTagName = "";
                $seoSlugName = 'news-tags-list';
                $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
            }
            //GET THE LATEST 4 BLOGS
            
            $getNewsTopicObj = $getNewsObj;

        elseif( $type == 'categories'):
            $getNewsObj = self::getAllCategoriesWiseBlogs($slug);
            $getTypeNameObj = DB::table('news_types')
                    ->where('news_types.slug', '=', $slug)
                    ->orderBy('news_types.id','ASC')
                    ->select('id','name')
                    ->take(1)
                    ->get()
                    ;
            if (sizeof($getTypeNameObj) > 0) {
                $slugTagName = $getTypeNameObj[0]->name;
                $seocontent = $this->fetchDataServiceController->seoContentDetailsById('newsTypeId','newstypepage',$getTypeNameObj[0]->id);
            }else{
                $slugTagName = "";
                $seoSlugName = 'news-type-list';
                $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
            }
            $newstypeId = $getTypeNameObj[0]->id;
            $isShowOnTop = "if(news.newstypeids = $newstypeId, 1,2) as isShowOnTop";

            //GET THE LATEST 4 BLOGS
            $query = DB::table('news')
                        ->leftJoin('users', 'news.users_id', '=', 'users.id')
                        ->orderBy('news.id', 'DESC')
                        ->select('news.id', 'news.topic', 'news.featimage', 'news.fullimage', 'news.width', 'news.height', 'news.description', 'news.isactive', 'news.slug','newstypeids','newstagsids', 'news.created_at as createdDate',DB::Raw($isShowOnTop));

            $getNewsTopicObj = $query->orderBy('isShowOnTop', 'ASC')->take(5)->get();
        endif;
        
        $newsTypeObj = DB::table('news_types')->orderBy('name', 'ASC')->get();
        $newsTagObj = DB::table('news_tags')->orderBy('name', 'ASC')->get();

        if(Auth::check()){
            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('News index page view by this User Id '.Auth::id());
        }

        return view('website/home/pages.news-list-page', compact('getNewsTopicObj','seocontent','newsTypeObj','newsTagObj','getNewsObj','slugTagName'));
    }

    public function getAllTagsWiseBlogs($slug)
    {
        $getTagIdObj = DB::table('news_tags')
                    ->where('news_tags.slug', '=', $slug)
                    ->orderBy('news_tags.id','ASC')
                    ->select('id','name','slug')
                    ->get()
                    ;
        $getAllNewsObj = [];
        if (sizeof($getTagIdObj) > 0) {
            $storeTechID = $getTagIdObj[0]->id;
            $getAllNewsObj = News::orderBy('id', 'DESC')
                            ->leftJoin('users', 'news.users_id', '=', 'users.id')
                            ->leftJoin('news_types', 'news.newstypeids', '=', 'news_types.id')
                            ->where('news.isactive', '=', '1')
                            ->whereRaw("find_in_set('$storeTechID',news.newstagsids)")
                            ->paginate(10, array('news.id', 'news.topic', 'news.description', 'news.featimage', 'news.fullimage', 'users.firstname', 'news.slug', 'news.created_at as createdDate','news_types.name as news_typesname','newstagsids','newstypeids','news_types.slug as newsslug',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname")));

            $tags = [];
            foreach ($getAllNewsObj as $key => $value) {
                if (!empty($value->newstagsids)) {
                    $tags = DB::select(DB::raw("SELECT news_tags.name, slug FROM news_tags where news_tags.id IN ($value->newstagsids)"));
                }
                $value->tagname = $tags;
            }
        }

        return $getAllNewsObj;
    }

    public function getAllCategoriesWiseBlogs($slug)
    {
        $getAllNewsObj = News::orderBy('id', 'DESC')
                        ->leftJoin('users', 'news.users_id', '=', 'users.id')
                        ->leftJoin('news_types', 'news.newstypeids', '=', 'news_types.id')
                        ->where('news.isactive', '=', '1')
                        ->where('news_types.slug', '=', $slug)
                        ->paginate(10, array('news.id', 'news.topic', 'news.description', 'news.featimage', 'news.fullimage', 'users.firstname', 'news.slug', 'news.created_at as createdDate','news_types.name as news_typesname','newstagsids','newstypeids','news_types.slug as newsslug',  DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname")));
        $tags = [];
        foreach ($getAllNewsObj as $key => $value) {
            if (!empty($value->newstagsids)) {
                $tags = DB::select(DB::raw("SELECT news_tags.name, slug FROM news_tags where news_tags.id IN ($value->newstagsids)"));
            }
            $value->tagname = $tags;
        }

        return $getAllNewsObj;
    }

    public function newsDetails(Request $request, $slug)
    {
        $getNewsDetailObj = DB::table('news')
                            ->join('users', 'news.users_id', '=', 'users.id')
                            ->leftJoin('news_types', 'news.newstypeids', '=', 'news_types.id')
                            ->where('news.slug', '=', $slug)
                            ->select('news.id','news.topic', 'news.fullimage', 'news.featimage','news.description', 'news.created_at as createdDate', 'users.firstname', 'users.lastname', 'news.slug','news_types.name as news_typesname','newstagsids','newstypeids','news_types.slug as newsslug',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                            ->orderBy('news.id', 'DESC')
                            ->take(1)
                            ->get()
                            ;
        $newstagsids = $getNewsDetailObj[0]->newstagsids;
        $tags = [];
        if (!empty($newstagsids)) {
            $tags = DB::select(DB::raw("SELECT news_tags.name, slug FROM news_tags where news_tags.id IN ($newstagsids)"));
        }

        $newsTypeObj = DB::table('news_types')->orderBy('name', 'ASC')->get();
        $newsTagObj = DB::table('news_tags')->orderBy('name', 'ASC')->get();

        $getNewsTopicObj = DB::table('news')
                            ->join('users', 'news.users_id', '=', 'news.users_id')
                            ->leftJoin('news_types', 'news.newstypeids', '=', 'news_types.id')
                            ->where('news.isactive', '=', '1')
                            ->select('news.id','news.topic', 'news.fullimage', 'news.featimage','news.description', 'news.created_at as createdDate', 'users.firstname', 'users.lastname', 'news.slug','news_types.name as news_typesname','newstagsids','newstypeids','news_types.slug as newsslug',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                            ->orderBy('news.id', 'DESC')
                            ->groupBy('news.id')
                            ->take(5)
                            ->get()
                            ;

        $seocontent = $this->fetchDataServiceController->seoContentDetailsById('newsId','newspage',$getNewsDetailObj[0]->id);

        if(Auth::check()){
            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('News details page view by this User Id '.Auth::id());
        }
        return view('website/home/pages.news-details-page', compact('tags','newsTypeObj','newsTagObj','seocontent','getNewsDetailObj','getNewsTopicObj','slug'));
    }

    public function askQuestionPage(Request $request)
    {
        $getAskQuestionObj = AskQuestion::orderBy('ask_questions.id', 'DESC')
                            ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                            ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                            ->where('ask_questions.status', '=', 1)
                            ->paginate(15, array('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','ask_questions.updated_at', 'ask_questions.totalAnswerCount','ask_questions.totalCommentsCount','askQuestionTagIds', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname")));
        $tags = [];
        foreach ($getAskQuestionObj as $key => $value) {
            if (!empty($value->askQuestionTagIds)) {
                $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($value->askQuestionTagIds)"));
            }
            $value->tagname = $tags;
        }


        //GET THE LATEST 4 BLOGS
        $getUnansweredQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->where('ask_questions.totalAnswerCount', '=', 0)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

        $getNewAskQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.BLOGINDEX').' by this User Id '.Auth::id());

        $seoSlugName = 'ask-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $askQuestionTagObj = DB::table('ask_question_tags')->orderBy('name', 'ASC')->get();
        $slugTagName = '';
        return view('website/home/pages.ask-question-page', compact('getNewAskQuestionObj','seocontent','askQuestionTagObj','getAskQuestionObj','slugTagName','getUnansweredQuestionObj'));
    }


    public function unanswersQuestionPage(Request $request)
    {
        $getAskQuestionObj = AskQuestion::orderBy('ask_questions.id', 'DESC')
                            ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                            ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                            ->where('ask_questions.status', '=', 1)
                            ->where('ask_questions.totalAnswerCount', '=', 0)
                            ->paginate(15, array('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','ask_questions.updated_at', 'ask_questions.totalAnswerCount','ask_questions.totalCommentsCount','askQuestionTagIds', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname")));
        $tags = [];
        foreach ($getAskQuestionObj as $key => $value) {
            if (!empty($value->askQuestionTagIds)) {
                $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($value->askQuestionTagIds)"));
            }
            $value->tagname = $tags;
        }


        //GET THE LATEST 4 BLOGS
        $getUnansweredQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->where('ask_questions.totalAnswerCount', '=', 0)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

        $getNewAskQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.BLOGINDEX').' by this User Id '.Auth::id());

        $seoSlugName = 'ask-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $askQuestionTagObj = DB::table('ask_question_tags')->orderBy('name', 'ASC')->get();
        $slugTagName = 'Unanswers';
        return view('website/home/pages.ask-question-page', compact('getNewAskQuestionObj','seocontent','askQuestionTagObj','getAskQuestionObj','slugTagName','getUnansweredQuestionObj'));
    }

    public function discussionsQuestionPage(Request $request)
    {
        $getAskQuestionObj = AskQuestion::orderBy('ask_questions.id', 'DESC')
                            ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                            ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                            ->where('ask_questions.status', '=', 1)
                            ->where('ask_questions.totalAnswerCount', '>', 0)
                            ->paginate(15, array('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','ask_questions.updated_at', 'ask_questions.totalAnswerCount','ask_questions.totalCommentsCount','askQuestionTagIds', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname")));
        $tags = [];
        foreach ($getAskQuestionObj as $key => $value) {
            if (!empty($value->askQuestionTagIds)) {
                $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($value->askQuestionTagIds)"));
            }
            $value->tagname = $tags;
        }


        //GET THE LATEST 4 BLOGS
        $getUnansweredQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->where('ask_questions.totalAnswerCount', '=', 0)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

        $getNewAskQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

        $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp(Config::get('systemsetting.BLOGINDEX').' by this User Id '.Auth::id());

        $seoSlugName = 'ask-page';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);

        $askQuestionTagObj = DB::table('ask_question_tags')->orderBy('name', 'ASC')->get();
        $slugTagName = 'Discussions';
        return view('website/home/pages.ask-question-page', compact('getNewAskQuestionObj','seocontent','askQuestionTagObj','getAskQuestionObj','slugTagName','getUnansweredQuestionObj'));
    }

    public function askQuestionTagsPage(Request $request, $type, $slug)
    {
        $seoSlugName = 'ask-question-tags-list';
        $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
        $getAskQuestionObj = [];
        $getNewsTopicObj = [];
        if( $type == 'tags'):
            $getAskQuestionObj = self::getAllTagsWiseAskQuestion($slug);
            $getTagNameObj = DB::table('ask_question_tags')
                    ->where('ask_question_tags.slug', '=', $slug)
                    ->orderBy('ask_question_tags.id','ASC')
                    ->select('id','name')
                    ->take(1)
                    ->get()
                    ;
            if (sizeof($getTagNameObj) > 0) {
                $slugTagName = $getTagNameObj[0]->name;
                $seocontent = $this->fetchDataServiceController->seoContentDetailsById('askTagId','asktagpage',$getTagNameObj[0]->id);
            }else{
                $slugTagName = "";
                $seoSlugName = 'ask-question-tags-list';
                $seocontent = $this->fetchDataServiceController->seoContentDetailsByMisc($seoSlugName);
            }
            //GET THE LATEST 4 BLOGS
        endif;
        
        $getUnansweredQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->where('ask_questions.totalAnswerCount', '=', 0)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

        $getNewAskQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

        $askQuestionTagObj = DB::table('ask_question_tags')->orderBy('name', 'ASC')->get();

        if(Auth::check()){
            $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('News index page view by this User Id '.Auth::id());
        }

        return view('website/home/pages.ask-question-page', compact('getNewAskQuestionObj','seocontent','askQuestionTagObj','getAskQuestionObj','slugTagName','getUnansweredQuestionObj'));
    }


    public function getAllTagsWiseAskQuestion($slug)
    {
        $getTagIdObj = DB::table('ask_question_tags')
                    ->where('ask_question_tags.slug', '=', $slug)
                    ->orderBy('ask_question_tags.id','ASC')
                    ->select('id','name','slug')
                    ->get()
                    ;
        $getAskQuestionObj = [];
        if (sizeof($getTagIdObj) > 0) {
            $storeTechID = $getTagIdObj[0]->id;
            $getAskQuestionObj = AskQuestion::orderBy('id', 'DESC')
                            ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                            ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                            ->where('ask_questions.status', '=', 1)
                            ->whereRaw("find_in_set('$storeTechID',ask_questions.askQuestionTagIds)")
                            ->paginate(15, array('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','ask_questions.updated_at', 'ask_questions.totalAnswerCount','ask_questions.totalCommentsCount','askQuestionTagIds', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname")));

            $tags = [];
            foreach ($getAskQuestionObj as $key => $value) {
                if (!empty($value->askQuestionTagIds)) {
                    $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($value->askQuestionTagIds)"));
                }
                $value->tagname = $tags;
            }
        }

        return $getAskQuestionObj;
    }

    public function askQuestionDetailPage(Request $request, $slug)
    {
        $getAskQuestionDetailObj = DB::table('ask_questions')
                            ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                            ->leftJoin('userrole', 'users.userrole_id', '=', 'userrole.id')
                            ->where('ask_questions.slug', '=', $slug)
                            ->where('ask_questions.status', '=', 1)
                            ->select('ask_questions.id', 'users.id as userID','users.firstname', 'users.lastname', 'userrole.name as userRoleName','users.userrole_id','ask_questions.question', 'ask_questions.questionDate', 'ask_questions.status', 'ask_questions.employee_id','ask_questions.slug','ask_questions.likes','ask_questions.share','ask_questions.views','totalAnswerCount','totalCommentsCount','askQuestionTagIds', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                            ->orderBy('ask_questions.id', 'DESC')
                            ->take(1)
                            ->get();

        if (sizeof($getAskQuestionDetailObj) > 0) {
            $askQuestionTagIds = $getAskQuestionDetailObj[0]->askQuestionTagIds;
            $tags = [];
            if (!empty($askQuestionTagIds)) {
                $tags = DB::select(DB::raw("SELECT ask_question_tags.name, slug FROM ask_question_tags where ask_question_tags.id IN ($askQuestionTagIds)"));
            }

            $askQuestionAnswersObj         =  DB::table('ask_question_answers')
                                                ->leftJoin('users', 'ask_question_answers.userId', '=', 'users.id')
                                                ->where('questionId','=', $getAskQuestionDetailObj[0]->id)
                                                ->where('ask_question_answers.status', '=', 1)
                                                ->select('ask_question_answers.id', 'users.id as userID','users.firstname', 'users.lastname', 'users.userrole_id','ask_question_answers.answer', 'ask_question_answers.answerDate', 'ask_question_answers.questionId', 'ask_question_answers.userId','ask_question_answers.status', 'ask_question_answers.likes', 'ask_question_answers.share','ask_question_answers.totalCommentsCount')
                                                ->orderBy('ask_question_answers.id', 'Desc')
                                                ->get(); 


            foreach ($askQuestionAnswersObj as $key => $ans) {
                $ans->askQuestionAnswerCommentsObj  =  DB::table('ask_question_answer_comments')
                                                    ->leftJoin('users', 'ask_question_answer_comments.userId', '=', 'users.id')
                                                    ->where('questionId','=', $getAskQuestionDetailObj[0]->id)
                                                    ->where('answerId','=', $ans->id)
                                                    ->where('ask_question_answer_comments.status', '=', 1)
                                                    ->select('ask_question_answer_comments.id', 'users.id as userID','users.firstname', 'users.lastname', 'users.userrole_id','ask_question_answer_comments.replyanswer', 'ask_question_answer_comments.answerDate', 'ask_question_answer_comments.answerId', 'ask_question_answer_comments.questionId', 'ask_question_answer_comments.userId', 'ask_question_answer_comments.status', 'ask_question_answer_comments.likes', 'ask_question_answer_comments.share')
                                                    ->orderBy('ask_question_answer_comments.id', 'Desc')
                                                    ->get();  
            }

            $getUnansweredQuestionObj = DB::table('ask_questions')
                        ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                        ->where('ask_questions.status', '=', 1)
                        ->where('ask_questions.totalAnswerCount', '=', 0)
                        ->orderBy('ask_questions.id', 'DESC')
                        ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                        ->take(5)
                        ->get()
                        ;

            $getNewAskQuestionObj = DB::table('ask_questions')
                            ->leftJoin('users', 'ask_questions.userId', '=', 'users.id')
                            ->where('ask_questions.status', '=', 1)
                            ->orderBy('ask_questions.id', 'DESC')
                            ->select('ask_questions.id', 'ask_questions.question', 'ask_questions.slug','askQuestionTagIds', 'ask_questions.questionDate','ask_questions.totalAnswerCount','ask_questions.totalCommentsCount',DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                            ->take(5)
                            ->get()
                            ;

            $askQuestionTagObj = DB::table('ask_question_tags')->orderBy('name', 'ASC')->get();

            $seocontent = $this->fetchDataServiceController->seoContentDetailsById('askQuestionId','askquestionpage',$getAskQuestionDetailObj[0]->id);

            if(Auth::check()){
                $catchEvent = app('App\Http\Controllers\website\WebsiteLogController')->catchAllEventInApp('News details page view by this User Id '.Auth::id());
            }

            $askquestion = AskQuestion::findOrFail($getAskQuestionDetailObj[0]->id);
            $askquestion->views = $getAskQuestionDetailObj[0]->views+1;
            $askquestion->save();

            return view('website/home/pages.ask-question-details-page', compact('tags','getUnansweredQuestionObj','getNewAskQuestionObj','seocontent','getAskQuestionDetailObj','askQuestionTagObj','slug','askQuestionAnswersObj'));
        }else{
            return redirect('/404');
        }               
    }

    public function validateEmailAddress( Request $request )
    {
        $checkEmailAddress = DB::table('users')
                            ->where('email', '=', Input::get('emailaddress'))
                            ->count();

       if( $checkEmailAddress == '0' ){
            $dataArray = array( 'code' => '200');
        }else{
            $dataArray = array( 'code' => '401');
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }
    
}