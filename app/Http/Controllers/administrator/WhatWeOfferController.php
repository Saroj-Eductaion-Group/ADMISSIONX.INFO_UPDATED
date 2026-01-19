<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\WhatWeOffer;
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

class WhatWeOfferController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('WhatWeOffer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = WhatWeOffer::orderBy('what_we_offers.id', 'DESC')
                    ->leftJoin('users as eID','what_we_offers.employee_id', '=','eID.id');

        if (!empty($keyword)) {
            $query->where('what_we_offers.title', 'LIKE', "%$keyword%")
                    ->orWhere('what_we_offers.description', 'LIKE', "%$keyword%");
        }

        $whatweoffer = $query->paginate(20, array('what_we_offers.id','title', 'iconImage', 'bannerText', 'bannerImage', 'description', 'status', 'slug','what_we_offers.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','what_we_offers.updated_at','what_we_offers.pageurl'));

        return view('administrator.what-we-offer.index', compact('whatweoffer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Redirect::back();
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('WhatWeOffer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
        return view('administrator.what-we-offer.create');
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
        
        $whatWeOfferObj = New WhatWeOffer();
        $whatWeOfferObj->title = Input::get('title');
        $whatWeOfferObj->bannerText = Input::get('bannerText');
        $whatWeOfferObj->description = Input::get('description');
        $whatWeOfferObj->status = Input::get('status');
        $whatWeOfferObj->pageurl = Input::get('pageurl');
        $whatWeOfferObj->employee_id = Auth::id();
        $whatWeOfferObj->save();

        $updateSlugObj = WhatWeOffer::findOrFail($whatWeOfferObj->id);
        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($whatWeOfferObj->title.'-'.$whatWeOfferObj->id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $updateSlugObj->slug = $slug;
        $updateSlugObj->save();

        if($request->file('iconImage')){
            $fileName = time().'-'.$whatWeOfferObj->id.".".$request->iconImage->getClientOriginalExtension();
            $request->iconImage->move(public_path('whatweoffer/'), $fileName);
            DB::table('what_we_offers')->where('what_we_offers.id', '=', $whatWeOfferObj->id)->update(array('what_we_offers.iconImage' => $fileName));
        }

        if($request->file('bannerImage')){
            $fileName = time().'-'.$whatWeOfferObj->id.".".$request->bannerImage->getClientOriginalExtension();
            $request->bannerImage->move(public_path('whatweoffer/'), $fileName);
            DB::table('what_we_offers')->where('what_we_offers.id', '=', $whatWeOfferObj->id)->update(array('what_we_offers.bannerImage' => $fileName));
        }

        Session::flash('flash_message', 'What We Offer added!');

        return redirect($this->fetchDataServiceController->routeCall().'/what-we-offer');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('WhatWeOffer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $whatweoffer = WhatWeOffer::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','what_we_offers.employee_id', '=','eID.id')
                        ->select('what_we_offers.id','title', 'iconImage', 'bannerText', 'bannerImage', 'description', 'status', 'slug','what_we_offers.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','what_we_offers.updated_at','what_we_offers.pageurl')
                        ->findOrFail($id);

        return view('administrator.what-we-offer.show', compact('whatweoffer'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('WhatWeOffer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $whatweoffer = WhatWeOffer::findOrFail($id);

        return view('administrator.what-we-offer.edit', compact('whatweoffer'));
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
        
        $whatWeOfferObj = WhatWeOffer::findOrFail($id);
        $whatWeOfferObj->title = Input::get('title');
        $whatWeOfferObj->bannerText = Input::get('bannerText');
        $whatWeOfferObj->description = Input::get('description');
        $whatWeOfferObj->status = Input::get('status');
        $whatWeOfferObj->pageurl = Input::get('pageurl');
        $whatWeOfferObj->employee_id = Auth::id();

        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower(Input::get('title').'-'.$id)); 
        $slug = strtolower(trim($cleanChar));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        rtrim($slug, '-');
        $whatWeOfferObj->slug = $slug;
        $whatWeOfferObj->save();

        if($request->file('iconImage')){
            $fileName = time().'-'.$id.".".$request->iconImage->getClientOriginalExtension();
            $request->iconImage->move(public_path('whatweoffer/'), $fileName);
            DB::table('what_we_offers')->where('what_we_offers.id', '=', $id)->update(array('what_we_offers.iconImage' => $fileName));
        }

        if($request->file('bannerImage')){
            $fileName = time().'-'.$id.".".$request->bannerImage->getClientOriginalExtension();
            $request->bannerImage->move(public_path('whatweoffer/'), $fileName);
            DB::table('what_we_offers')->where('what_we_offers.id', '=', $id)->update(array('what_we_offers.bannerImage' => $fileName));
        }

        Session::flash('flash_message', 'WhatWeOffer updated!');

        return redirect($this->fetchDataServiceController->routeCall().'/what-we-offer');
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
        return Redirect::back();
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('WhatWeOffer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
        WhatWeOffer::destroy($id);

        Session::flash('flash_message', 'WhatWeOffer deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/what-we-offer');
    }
}
