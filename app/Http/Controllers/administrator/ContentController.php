<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Content;
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
use App\Models\Contentcategory;
use App\User;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class ContentController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('Content');
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

            //     if (!empty($keyword)) {
            //         $content = Content::where('description', 'LIKE', "%$keyword%")
        				// ->orWhere('status', 'LIKE', "%$keyword%")
        				// ->paginate($perPage);
            //     } else {
            //         $content = Content::orderBy('contents.id', 'DESC')
            //             ->leftJoin('contentcategory', 'contents.contentcategory_id', '=', 'contentcategory.id')
            //             ->paginate(25, array('contents.id', 'contents.description', 'contents.status','contentcategory.name as contentcategoryName','title'));
            //     }

                $content = Content::orderBy('contents.id', 'DESC')
                        ->leftJoin('contentcategory', 'contents.contentcategory_id', '=', 'contentcategory.id')
                        ->groupBy('contents.contentcategory_id')
                        ->paginate(25, array('contents.id','contents.contentcategory_id', 'contents.description', 'contents.status','contentcategory.name as contentcategoryName','title', DB::raw('count(contents.contentcategory_id) as count')));

                return view('/administrator/content.index', compact('content'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('Content');
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
                $contentcategoryObj = DB::table('contentcategory')->get();
                return view('/administrator/content.create', compact('contentcategoryObj'));
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
                $contentObj = New Content();
                $contentObj->title = Input::get('title');
                $contentObj->description = Input::get('description');
                $contentObj->status = Input::get('status');
                $contentObj->contentcategory_id = Input::get('contentcategory_id');
                $getCategoryNameObj = DB::table('contentcategory')
                                ->where('id', '=', Input::get('contentcategory_id'))
                                ->select('contentcategory.name')
                                ->get()
                                ; 

                $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getCategoryNameObj[0]->name);
                $slugUrl = strtolower($slugUrl);
                $contentObj->contentslug = $slugUrl;
                $contentObj->save();

                Session::flash('flash_message', 'Content added!');
                return redirect($this->fetchDataServiceController->routeCall().'/content');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('Content');
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
                $content = Content::leftJoin('contentcategory', 'contents.contentcategory_id', '=', 'contentcategory.id')
                        ->leftJoin('seo_contents', 'seo_contents.pageId', '=', 'contentcategory.id')
                        ->findOrFail($id, array('contents.id', 'contents.description', 'contents.status','contentcategory.name as contentcategoryName','seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image1', 'imagealttext1', 'image2', 'imagealttext2', 'content1', 'content2', 'productId', 'blogId','pageId','title','contentcategory_id','categoryId'));

                return view('/administrator/content.show', compact('content'));
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
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('Content');
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
                $content = Content::findOrFail($id);
                $contentcategoryObj = DB::table('contentcategory')->get();
                return view('/administrator/content.edit', compact('content','contentcategoryObj'));
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
                $contentObj = Content::findOrFail($id);
                $contentObj->title = Input::get('title');
                $contentObj->description = Input::get('description');
                $contentObj->status = Input::get('status');
                //$contentObj->contentcategory_id = Input::get('contentcategory_id');
                // $getCategoryNameObj = DB::table('contentcategory')
                //                 ->where('id', '=', Input::get('contentcategory_id'))
                //                 ->select('contentcategory.name')
                //                 ->get()
                //                 ; 

                // $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $getCategoryNameObj[0]->name);
                // $slugUrl = strtolower($slugUrl);
                //$contentObj->contentslug = $slugUrl;
                $contentObj->save();

                Session::flash('flash_message', 'Content updated!');
                return redirect($this->fetchDataServiceController->routeCall().'/content');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('Content');
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
                Content::destroy($id);

                Session::flash('flash_message', 'Content deleted!');

                return redirect($this->fetchDataServiceController->routeCall().'/content');
            }else{
                Auth::logout(); // logout user
                return Redirect::to('login'); //redirect back to login
            }
        }else{
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        }
    }

    public function allPageContents($id)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('Content');
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

                $content = Content::orderBy('contents.id', 'ASC')
                        ->leftJoin('contentcategory', 'contents.contentcategory_id', '=', 'contentcategory.id')
                        ->where('contents.contentcategory_id','=', $id)
                        ->paginate(25, array('contents.id', 'contents.description', 'contents.status','contentcategory.name as contentcategoryName','title','contentcategory_id'));

                return view('/administrator/content.allPageContent', compact('content','id'));
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
