<?php

namespace App\Http\Controllers\administrator;

use DB;
use Auth;
use Hash;
use Mail;
use View;
use Input;
use Session;
use Redirect;
use Response;
use Validator;
use Carbon\Carbon;
use App\Models\Blog;
use App\User as User;
use App\Http\Requests;
use App\Models\SeoContent;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserRole as UserRole;
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
        if (Auth::check()) {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            if ($roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1') {
                $blogs = Blog::orderBy('blogs.id', 'DESC')
                    ->join('users', 'blogs.users_id', '=', 'users.id')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->leftJoin('users as eID', 'blogs.employee_id', '=', 'eID.id')
                    ->paginate(20, array('blogs.id', 'users.id as userID', 'users.firstname', 'users.lastname', 'userrole.name as userRoleName', 'blogs.topic', 'blogs.description', 'blogs.isactive', 'blogs.featimage', 'eID.id as eUserId', 'eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname', 'blogs.updated_at'));

                $usersObj = DB::table('users')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName', 'users.middlename', 'users.lastname')
                    ->orderBy('users.id', 'ASC')
                    ->get();

                return view('administrator/blogs.index', compact('blogs'))
                    ->with('usersObj', $usersObj);
            } else {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        } else {
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
        if (Auth::check()) {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            if ($roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1') {
                $usersObj = DB::table('users')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                    ->orderBy('users.id', 'ASC')
                    ->get();
                return view('administrator/blogs.create')
                    ->with('usersObj', $usersObj);
            } else {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        } else {
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
        if (Auth::check()) {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            if ($roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1') {

                if ($request->hasFile('uploadFeatureImage')) {
                    $blogsObj = new Blog;
                    $blogsObj->topic = $request->input('topic');
                    $blogsObj->description = $request->input('description');
                    $blogsObj->isactive = $request->input('isactive');
                    $blogsObj->users_id = $request->input('users_id');

                    //GET THE LAST CREATED ID
                    $getLastID = DB::table('blogs')->select('id')->orderBy('id', 'DESC')->get();
                    if (empty($getLastID)) {
                        $totalIDNumber = '1';
                    } else {
                        $totalIDNumber = $getLastID[0]->id + 1;
                    }
                    $slugUrl = str_slug($request->input('topic') . ' ' . $totalIDNumber, "-");
                    $blogsObj->slug = str_slug($slugUrl, "-");

                    // Get the uploaded file
                    $file = $request->file('uploadFeatureImage');
                    $ext = strtolower($file->getClientOriginalExtension());

                    // Validate file type
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'tiff', 'svg'];
                    if (!in_array($ext, $allowedExtensions)) {
                        Session::flash('error_message', 'Please upload only image files (jpg, jpeg, png, webp, gif, bmp, tiff, svg).');
                        return redirect()->back()->withInput();
                    }

                    $currentMyTime = time();
                    $imageNameWithTime = $slugUrl . '-' . $currentMyTime;
                    $fileWithExtension = $imageNameWithTime . '.' . $ext;
                    $fileWithExtension1 = $imageNameWithTime . '_original.' . $ext;

                    //Set the image folder path
                    $dirPath = public_path() . '/blogs/';

                    // Ensure directory exists
                    if (!file_exists($dirPath)) {
                        mkdir($dirPath, 0777, true);
                    }

                    // Save original image
                    $file->move($dirPath, $fileWithExtension1);

                    // Check if GD functions exist before using them
                    $newwidth = 0;
                    $newheight = 0;

                    //IMAGE SAVED IN FOLDER NOW RESIZE IT
                    if (file_exists($dirPath . $fileWithExtension1)) {
                        // Copy original to resized version
                        copy($dirPath . $fileWithExtension1, $dirPath . $fileWithExtension);

                        // Get image size
                        list($width, $height) = getimagesize($dirPath . $fileWithExtension);

                        if ($width > 5000) {
                            $newwidth = 1500;

                            // Check if GD functions are available
                            if (function_exists('imagecreatefromjpeg') && function_exists('imagecreatefrompng')) {

                                // Create image resource based on extension
                                $image = null;
                                switch ($ext) {
                                    case 'jpg':
                                    case 'jpeg':
                                        $image = @imagecreatefromjpeg($dirPath . $fileWithExtension);
                                        break;
                                    case 'png':
                                        $image = @imagecreatefrompng($dirPath . $fileWithExtension);
                                        break;
                                    case 'gif':
                                        $image = @imagecreatefromgif($dirPath . $fileWithExtension);
                                        break;
                                    case 'webp':
                                        if (function_exists('imagecreatefromwebp')) {
                                            $image = @imagecreatefromwebp($dirPath . $fileWithExtension);
                                        }
                                        break;
                                    case 'bmp':
                                        if (function_exists('imagecreatefrombmp')) {
                                            $image = @imagecreatefrombmp($dirPath . $fileWithExtension);
                                        }
                                        break;
                                }

                                if ($image) {
                                    $orig_width = imagesx($image);
                                    $orig_height = imagesy($image);

                                    // Calc the new height
                                    $newheight = (($orig_height * $newwidth) / $orig_width);

                                    // Create thumbnail
                                    $thumb = imagecreatetruecolor($newwidth, $newheight);

                                    // Preserve transparency for supported formats
                                    if ($ext == 'png' || $ext == 'gif') {
                                        imagealphablending($thumb, false);
                                        imagesavealpha($thumb, true);
                                        $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
                                        imagefilledrectangle($thumb, 0, 0, $newwidth, $newheight, $transparent);
                                    }

                                    // Resize the $thumb image
                                    imagecopyresized($thumb, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                                    // Save resized image based on format
                                    switch ($ext) {
                                        case 'jpg':
                                        case 'jpeg':
                                            imagejpeg($thumb, $dirPath . $fileWithExtension, 90);
                                            break;
                                        case 'png':
                                            imagepng($thumb, $dirPath . $fileWithExtension, 9);
                                            break;
                                        case 'gif':
                                            imagegif($thumb, $dirPath . $fileWithExtension);
                                            break;
                                        case 'webp':
                                            if (function_exists('imagewebp')) {
                                                imagewebp($thumb, $dirPath . $fileWithExtension, 90);
                                            }
                                            break;
                                        case 'bmp':
                                            if (function_exists('imagebmp')) {
                                                imagebmp($thumb, $dirPath . $fileWithExtension);
                                            }
                                            break;
                                    }

                                    // Clean up
                                    imagedestroy($thumb);
                                    imagedestroy($image);
                                } else {
                                    // GD failed to create image - keep original dimensions
                                    $newwidth = $width;
                                    $newheight = $height;
                                }
                            } else {
                                // GD not available - keep original dimensions
                                $newwidth = $width;
                                $newheight = $height;
                            }
                        } else {
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
                } else {
                    $blogsObj = new Blog;
                    $blogsObj->topic = $request->input('topic');
                    $blogsObj->description = $request->input('description');
                    $blogsObj->isactive = $request->input('isactive');
                    $blogsObj->users_id = $request->input('users_id');

                    //GET THE LAST CREATED ID
                    $getLastID = DB::table('blogs')->select('id')->orderBy('id', 'DESC')->get();
                    if (empty($getLastID)) {
                        $totalIDNumber = '1';
                    } else {
                        $totalIDNumber = $getLastID[0]->id + 1;
                    }
                    $slugUrl = str_slug($request->input('topic') . ' ' . $totalIDNumber, "-");
                    $blogsObj->slug = str_slug($slugUrl, "-");
                    $blogsObj->employee_id = Auth::id();
                    $blogsObj->save();
                }

                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($blogsObj->id, $request->all());

                Session::flash('flash_message', 'Blog added successfully!');
                return redirect('administrator/blogs');
            } else {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        } else {
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
        if (Auth::check()) {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            if ($roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1') {
                $blog = Blog::orderBy('blogs.id', 'ASC')
                    ->join('users', 'blogs.users_id', '=', 'users.id')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->leftJoin('users as eID', 'blogs.employee_id', '=', 'eID.id')
                    ->select('blogs.id', 'users.id as userID', 'users.firstname', 'users.lastname', 'userrole.name as userRoleName', 'blogs.topic', 'blogs.description', 'blogs.isactive', 'blogs.featimage', 'eID.id as eUserId', 'eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname', 'blogs.updated_at')
                    ->findOrFail($id);

                $seocontent = SeoContent::orderBy('seo_contents.id', 'DESC')
                    ->leftJoin('users as eID', 'seo_contents.employee_id', '=', 'eID.id')
                    ->where('seo_contents.blogId', '=', $id)
                    ->select('seo_contents.id', 'pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId', 'seo_contents.courseId', 'seo_contents.blogId', 'seo_contents.examSectionId', 'seo_contents.employee_id', 'eID.id as eUserId', 'eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname', 'seo_contents.updated_at')
                    ->first();

                return view('administrator/blogs.show', compact('blog', 'seocontent'));
            } else {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        } else {
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
        if (Auth::check()) {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            if ($roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1') {
                $blog = Blog::findOrFail($id);
                $usersObj = DB::table('users')
                    ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
                    ->select('users.id', 'users.firstname', 'users.middlename', 'users.lastname', 'userrole.name as userRoleName')
                    ->orderBy('users.id', 'ASC')
                    ->get();

                $seocontent = SeoContent::where('seo_contents.blogId', '=', $id)
                    ->select('seo_contents.id as seoContentId', 'pagetitle', 'seo_contents.description as SEODescription', 'keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId', 'courseId', 'blogId', 'examSectionId')
                    ->get();

                return view('administrator/blogs.edit', compact('blog', 'seocontent'))
                    ->with('usersObj', $usersObj);
            } else {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        } else {
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
        if (Auth::check()) {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            if ($roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1') {

                // Find the blog
                $blog = Blog::findOrFail($id);

                // Update basic fields
                $blog->topic = $request->input('topic');
                $blog->description = $request->input('description');
                $blog->isactive = $request->input('isactive');
                $blog->users_id = $request->input('users_id');
                $blog->employee_id = Auth::id();

                // Get existing slug
                $slugUrl = $blog->slug;

                // Set the image folder path
                $dirPath = public_path() . '/blogs/';

                // Ensure directory exists
                if (!file_exists($dirPath)) {
                    mkdir($dirPath, 0777, true);
                }

                // Check if file is uploaded
                if ($request->hasFile('uploadFeatureImage')) {

                    // Get the uploaded file
                    $file = $request->file('uploadFeatureImage');

                    // Get file extension
                    $ext = strtolower($file->getClientOriginalExtension());

                    // Validate file type - support all common image formats
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'tiff', 'svg'];
                    if (!in_array($ext, $allowedExtensions)) {
                        Session::flash('error_message', 'Please upload only image files (jpg, jpeg, png, webp, gif, bmp, tiff, svg).');
                        return redirect()->back()->withInput();
                    }

                    // Generate unique filename
                    $currentMyTime = time();
                    $imageNameWithTime = $slugUrl . '-' . $currentMyTime;
                    $fileWithExtension = $imageNameWithTime . '.' . $ext;
                    $fileWithExtension1 = $imageNameWithTime . '_original.' . $ext;

                    try {
                        // Save original image
                        $file->move($dirPath, $fileWithExtension1);

                        // Check if file was saved successfully
                        if (!file_exists($dirPath . $fileWithExtension1)) {
                            throw new \Exception('Failed to save uploaded file');
                        }

                        // For SVG files, we don't need to resize or process
                        if ($ext == 'svg') {
                            // Just copy the SVG file as-is
                            copy($dirPath . $fileWithExtension1, $dirPath . $fileWithExtension);
                            $newwidth = 0;
                            $newheight = 0;
                        } else {
                            // Copy original to resized version
                            copy($dirPath . $fileWithExtension1, $dirPath . $fileWithExtension);

                            // Get image dimensions
                            list($width, $height) = getimagesize($dirPath . $fileWithExtension);

                            // Initialize dimensions
                            $newwidth = $width;
                            $newheight = $height;

                            // Check if we need to resize (only for non-SVG images)
                            if ($width > 5000) {
                                $newwidth = 1500;
                                $newheight = intval(($height * $newwidth) / $width);

                                // Create image resource based on extension
                                $source = null;
                                switch ($ext) {
                                    case 'jpg':
                                    case 'jpeg':
                                        $source = @imagecreatefromjpeg($dirPath . $fileWithExtension);
                                        break;
                                    case 'png':
                                        $source = @imagecreatefrompng($dirPath . $fileWithExtension);
                                        break;
                                    case 'gif':
                                        $source = @imagecreatefromgif($dirPath . $fileWithExtension);
                                        break;
                                    case 'webp':
                                        if (function_exists('imagecreatefromwebp')) {
                                            $source = @imagecreatefromwebp($dirPath . $fileWithExtension);
                                        }
                                        break;
                                    case 'bmp':
                                        if (function_exists('imagecreatefrombmp')) {
                                            $source = @imagecreatefrombmp($dirPath . $fileWithExtension);
                                        }
                                        break;
                                }

                                if ($source) {
                                    // Create thumbnail
                                    $thumb = imagecreatetruecolor($newwidth, $newheight);

                                    // Preserve transparency for supported formats
                                    if ($ext == 'png' || $ext == 'gif') {
                                        imagealphablending($thumb, false);
                                        imagesavealpha($thumb, true);
                                        $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
                                        imagefilledrectangle($thumb, 0, 0, $newwidth, $newheight, $transparent);
                                    }

                                    // Resize image
                                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                                    // Save resized image based on format
                                    switch ($ext) {
                                        case 'jpg':
                                        case 'jpeg':
                                            imagejpeg($thumb, $dirPath . $fileWithExtension, 90);
                                            break;
                                        case 'png':
                                            imagepng($thumb, $dirPath . $fileWithExtension, 9);
                                            break;
                                        case 'gif':
                                            imagegif($thumb, $dirPath . $fileWithExtension);
                                            break;
                                        case 'webp':
                                            if (function_exists('imagewebp')) {
                                                imagewebp($thumb, $dirPath . $fileWithExtension, 90);
                                            }
                                            break;
                                        case 'bmp':
                                            if (function_exists('imagebmp')) {
                                                imagebmp($thumb, $dirPath . $fileWithExtension);
                                            }
                                            break;
                                    }

                                    // Clean up
                                    imagedestroy($thumb);
                                    imagedestroy($source);
                                }
                            }
                        }

                        // Delete old images if they exist
                        if ($blog->featimage && file_exists($dirPath . $blog->featimage)) {
                            @unlink($dirPath . $blog->featimage);
                        }
                        if ($blog->fullimage && file_exists($dirPath . $blog->fullimage)) {
                            @unlink($dirPath . $blog->fullimage);
                        }

                        // Update image fields
                        $blog->featimage = $fileWithExtension;
                        $blog->fullimage = $fileWithExtension1;
                        $blog->width = round($newwidth);
                        $blog->height = round($newheight);
                    } catch (\Exception $e) {
                        Session::flash('error_message', 'Error uploading image: ' . $e->getMessage());
                        return redirect()->back()->withInput();
                    }
                }

                // Save the blog
                $blog->save();

                // Update SEO content
                $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());

                Session::flash('flash_message', 'Blog updated successfully!');
                return redirect('administrator/blogs');
            } else {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        } else {
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
        if (Auth::check()) {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

            if ($roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1') {
                DB::table('seo_contents')
                    ->where('seo_contents.blogId', '=', $id)
                    ->delete();

                Blog::destroy($id);
                Session::flash('flash_message', 'Blog deleted!');
                return redirect('administrator/blogs');
            } else {
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        } else {
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

        if ($request->collegeName != null) {
            $search1 = "AND `users`.`firstname` LIKE  '%" . $request->collegeName . "%'";
        } else {
            $search1 =  '';
        }

        if ($request->topic != null) {
            $search2 = "AND `blogs`.`topic` LIKE  '%" . $request->topic . "%'";
        } else {
            $search2 =  '';
        }

        if ($request->isactive != '') {
            $search3 = " AND `blogs`.`isactive` LIKE  '%" . $request->isactive . "%'";
        } else {
            $search3 = '';
        }


        if ($request->startCounter != '') {
            $startCounter = $request->startCounter;
        } else {
            $startCounter = 0;
        }

        if ($request->prevCounter != '') {
            $startCounter = $request->prevCounter;
        } else {
            $startCounter = $request->startCounter;
        }

        if ($startCounter == '') {
            $startCounter = 0;
        }

        $currentNode = $request->currentNode;
        if (!empty($currentNode)) {
            $getValue = ($currentNode - 1) * 20;
        } else {
            $getValue = 0;
        }

        $blogsSearchDataObj = DB::select(DB::raw(
            "SELECT blogs.id as blogsId, users.id as userID,users.firstname, users.lastname, userrole.name as userRoleName,blogs.topic, blogs.description, blogs.isactive,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,blogs.updated_at FROM  `blogs`
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

        $blogsSearchDataObj1 = DB::select(DB::raw(
            "SELECT COUNT(blogs.id) as totalCount FROM  `blogs` 
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

        if (!empty($blogsSearchDataObj1)) {
            $numRecords = $blogsSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords / 20);
            $dataArray = array(
                'blogsSearchDataObj' => $blogsSearchDataObj,
                'blogsSearchDataObj1' => $total_pages,
                'currentNode' => $currentNode,
                'getTotalCount' => $blogsSearchDataObj1,
            );
        } else {
            $total_pages = 0;
            $dataArray = array(
                'blogsSearchDataObj' => $blogsSearchDataObj,
                'blogsSearchDataObj1' => $total_pages,
                'currentNode' => $currentNode,
                'getTotalCount' => $blogsSearchDataObj1,
            );
        }

        if (!empty($blogsSearchDataObj)) {
            return json_encode($dataArray);
        } else {
            return json_encode('no');
        }
    }

    public function allBlogsSearch(Request $request)
    {

        $blogs = Blog::orderBy('blogs.id', 'DESC')
            ->join('users', 'blogs.users_id', '=', 'users.id')
            ->join('userrole', 'users.userrole_id', '=', 'userrole.id')
            ->leftJoin('users as eID', 'blogs.employee_id', '=', 'eID.id')
            ->select('blogs.id as blogsId', 'users.id as userID', 'users.firstname', 'users.lastname', 'userrole.name as userRoleName', 'blogs.topic', 'blogs.description', 'blogs.isactive', 'eID.id as eUserId', 'eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname', 'blogs.updated_at')
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
