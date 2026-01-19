<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SliderManager;
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
use Excel;
use Config;
use PHPMailer;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Http\Controllers\Helper\FetchDataServiceController;

class SliderManagerController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SliderManager');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = SliderManager::orderBy('slider_managers.id', 'DESC')
                    ->leftJoin('users as eID','slider_managers.employee_id', '=','eID.id');

        if (!empty($keyword)) {
            $query->where('slider_managers.sliderTitle', 'LIKE', "%$keyword%")
                    ->orWhere('slider_managers.bottomText', 'LIKE', "%$keyword%")
                    ->orWhere('slider_managers.scrollerFirstText', 'LIKE', "%$keyword%")
                    ->orWhere('slider_managers.scrollerLastText', 'LIKE', "%$keyword%");
        }

        $slidermanager = $query->paginate(20, array('slider_managers.id','sliderTitle', 'bottomText', 'sliderImage', 'bottomLink', 'status', 'isShowCollegeCount', 'isShowExamCount', 'isShowCourseCount', 'isShowBlogCount', 'scrollerFirstText', 'scrollerLastText','slider_managers.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','slider_managers.updated_at'));

        return view('administrator.slider-manager.index', compact('slidermanager'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SliderManager');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        return view('administrator.slider-manager.create');
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
        $sliderManagerObj                     = New SliderManager();
        $sliderManagerObj->sliderTitle        = Input::get('sliderTitle');
        $sliderManagerObj->bottomText         = Input::get('bottomText');
        $sliderManagerObj->bottomLink         = Input::get('bottomLink');
        $sliderManagerObj->status             = Input::get('status');
        $sliderManagerObj->isShowCollegeCount = Input::get('isShowCollegeCount');
        $sliderManagerObj->isShowExamCount    = Input::get('isShowExamCount');
        $sliderManagerObj->isShowCourseCount  = Input::get('isShowCourseCount');
        $sliderManagerObj->isShowBlogCount    = Input::get('isShowBlogCount');
        $sliderManagerObj->status             = Input::get('status');
        $sliderManagerObj->scrollerFirstText  = Input::get('scrollerFirstText');
        $sliderManagerObj->scrollerLastText   = Input::get('scrollerLastText');
        $sliderManagerObj->employee_id        = Auth::id();
        $sliderManagerObj->save();

        if($request->file('sliderImage')){
            $fileName = time().'-'.$sliderManagerObj->id.".".$request->sliderImage->getClientOriginalExtension();
            $request->sliderImage->move(public_path('slider-image/'), $fileName);
            DB::table('slider_managers')->where('slider_managers.id', '=', $sliderManagerObj->id)->update(array('slider_managers.sliderImage' => $fileName));
        }

        Session::flash('flash_message', 'Slider Manager added!');

        return redirect($this->fetchDataServiceController->routeCall().'/slider-manager');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SliderManager');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $slidermanager = SliderManager::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','slider_managers.employee_id', '=','eID.id')
                        ->select('slider_managers.id','sliderTitle', 'bottomText', 'sliderImage', 'bottomLink', 'status', 'isShowCollegeCount', 'isShowExamCount', 'isShowCourseCount', 'isShowBlogCount', 'scrollerFirstText', 'scrollerLastText','slider_managers.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','slider_managers.updated_at')
                        ->findOrFail($id);

        return view('administrator.slider-manager.show', compact('slidermanager'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SliderManager');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $slidermanager = SliderManager::findOrFail($id);

        return view('administrator.slider-manager.edit', compact('slidermanager'));
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
        $sliderManagerObj                     = SliderManager::findOrFail($id);
        $sliderManagerObj->sliderTitle        = Input::get('sliderTitle');
        $sliderManagerObj->bottomText         = Input::get('bottomText');
        $sliderManagerObj->bottomLink         = Input::get('bottomLink');
        $sliderManagerObj->status             = Input::get('status');
        $sliderManagerObj->isShowCollegeCount = Input::get('isShowCollegeCount');
        $sliderManagerObj->isShowExamCount    = Input::get('isShowExamCount');
        $sliderManagerObj->isShowCourseCount  = Input::get('isShowCourseCount');
        $sliderManagerObj->isShowBlogCount    = Input::get('isShowBlogCount');
        $sliderManagerObj->status             = Input::get('status');
        $sliderManagerObj->scrollerFirstText  = Input::get('scrollerFirstText');
        $sliderManagerObj->scrollerLastText   = Input::get('scrollerLastText');
        $sliderManagerObj->employee_id        = Auth::id();
        $sliderManagerObj->save();

        if($request->file('sliderImage')){
            $fileName = time().'-'.$sliderManagerObj->id.".".$request->sliderImage->getClientOriginalExtension();
            $request->sliderImage->move(public_path('slider-image/'), $fileName);
            DB::table('slider_managers')->where('slider_managers.id', '=', $sliderManagerObj->id)->update(array('slider_managers.sliderImage' => $fileName));
        }

        Session::flash('flash_message', 'SliderManager updated!');

        return redirect($this->fetchDataServiceController->routeCall().'/slider-manager');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('SliderManager');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        SliderManager::destroy($id);

        Session::flash('flash_message', 'SliderManager deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/slider-manager');
    }

    public function isShowCollegeCount(Request $request)
    {
        $status = Input::get('currentStatus');
        $id = Input::get('id');
        DB::statement(DB::raw("UPDATE slider_managers SET isShowCollegeCount=".Input::get('currentStatus')." WHERE id=".Input::get('id').""));

        return response()->json(['code' => 200, 'response' => 'success']);
    }

    public function isShowExamCount(Request $request)
    {
        $status = Input::get('currentStatus');
        $id = Input::get('id');
        DB::statement(DB::raw("UPDATE slider_managers SET isShowExamCount=".Input::get('currentStatus')." WHERE id=".Input::get('id').""));

        return response()->json(['code' => 200, 'response' => 'success']);
    }

    public function isShowCourseCount(Request $request)
    {   
        $status = Input::get('currentStatus');
        $id = Input::get('id');
        DB::statement(DB::raw("UPDATE slider_managers SET isShowCourseCount=".Input::get('currentStatus')." WHERE id=".Input::get('id').""));

        return response()->json(['code' => 200, 'response' => 'success']);
    }

    public function isShowBlogCount(Request $request)
    {
        $status = Input::get('currentStatus');
        $id = Input::get('id');
        DB::statement(DB::raw("UPDATE slider_managers SET isShowBlogCount=".Input::get('currentStatus')." WHERE id=".Input::get('id').""));

        return response()->json(['code' => 200, 'response' => 'success']);
    }
}
