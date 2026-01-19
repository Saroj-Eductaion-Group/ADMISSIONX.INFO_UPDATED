<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User as User;
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
use Config;
use Session;
use PHPMailer;
use ResetsPasswords;
use App\Models\AdsManagement;
use GuzzleHttp\Client;
use App\Http\Controllers\Helper\FetchDataServiceController;

class AdsManagementController extends Controller
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
    public function index()
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsManagement');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
                        

        $adsmanagement = AdsManagement::orderBy('id', 'DESC')
                            ->paginate(25, 
                                [
                                    'id',
                                    'slug',
                                    'isactive',
                                    'img',
                                    'redirectto',
                                    'start',
                                    'end',
                                    'ads_position',
                                ]);

        return view('administrator/ads-management.index', compact('adsmanagement'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsManagement');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
            
        return view('administrator/ads-management.create');
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
        $create             = New AdsManagement;
        $create->slug       = Input::get('slug');
        $create->isactive   = Input::get('isactive');
        $create->redirectto = Input::get('redirectto');
        $create->ads_position = Input::get('ads_position');
        $create->start      = date('Y-m-d H:i:s', strtotime(Input::get('start')));
        $create->end        = date('Y-m-d H:i:s', strtotime(Input::get('end')));
        $create->users_id   = Auth::id();

        if(Input::get('slug') == 1):
            $title = "Home Page";
        elseif(Input::get('slug') == 2):
            $title = "Search Page";
        elseif(Input::get('slug') == 3):
            $title = "College Detail Page";
        endif;
        $create->title   = $title;

        if($request->file('img')):
            $returnObj = self::uploadAdsBanner($request);
            if( $returnObj['code'] == '401'):
                Session::flash('wrongFileUpload', 'Not valid file extension');
                return Redirect::back();
                die;
            endif;
            
            $create->img    = $returnObj['fileName'];
        endif;

        $create->save();
        
        // ads-banner
        Session::flash('flash_message', 'AdsManagement added!');

        return redirect($this->fetchDataServiceController->routeCall().'/ads-management');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsManagement');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
            

        $adsmanagement = AdsManagement::findOrFail($id);

        return view('administrator/ads-management.show', compact('adsmanagement'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsManagement');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
            

        $adsmanagement = AdsManagement::findOrFail($id);

        return view('administrator/ads-management.edit', compact('adsmanagement'));
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
        $update             = AdsManagement::findOrFail($id);
        $update->slug       = Input::get('slug');
        $update->isactive   = Input::get('isactive');
        $update->users_id   = Auth::id();
        $update->redirectto = Input::get('redirectto');
        $update->ads_position = Input::get('ads_position');
        $update->start      = date('Y-m-d H:i:s', strtotime(Input::get('start')));
        $update->end        = date('Y-m-d H:i:s', strtotime(Input::get('end')));

        if(Input::get('slug') == 1):
            $title = "Home Page";
        elseif(Input::get('slug') == 2):
            $title = "Search Page";
        elseif(Input::get('slug') == 3):
            $title = "College Detail Page";
        endif;
        $update->title   = $title;

        if(!empty($request->file('img'))):
            $returnObj = self::uploadAdsBanner($request);
            if( $returnObj['code'] == '401'):
                Session::flash('wrongFileUpload', 'Not valid file extension');
                return Redirect::back();
                die;
            endif;
            
            $update->img    = $returnObj['fileName'];
        else:
            $update->img    = Input::get('old_img');
        endif;

        $update->save();   
        Session::flash('flash_message', 'AdsManagement updated!');
        return redirect($this->fetchDataServiceController->routeCall().'/ads-management');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('AdsManagement');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
            
        AdsManagement::destroy($id);

        Session::flash('flash_message', 'AdsManagement deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/ads-management');
    }

    public function uploadAdsBanner($request)
    {
        $extensionOfFile = '';
        $path = $_FILES['img']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        if( $ext != 'png' && $ext != 'jpg' && $ext != 'jpeg' ):
            return [
                'code' => '401',
                'response' => '',
            ];    
        endif;
        $tempPath = $_FILES['img'][ 'tmp_name' ];
        $currentMyTime = strtotime('now');
        $imageNameWithTime = 'ads'.$currentMyTime;
        $fileWithExtension = $imageNameWithTime.'.'.$ext;
         
        //Set the image folder path
        if( $_SERVER['REMOTE_ADDR'] == '127.0.0.1' ):
           $dirPath = public_path().'/assets/ads-banner/';
        else:
            $dirPath = public_path().'/assets/ads-banner/';
        endif;
        //Store the image with 300PX width
        $uploadPath = $dirPath.$fileWithExtension;
        move_uploaded_file($tempPath, $uploadPath);
        return [
            'code' => '200',
            'fileName' => $fileWithExtension,
        ];
    }
}
