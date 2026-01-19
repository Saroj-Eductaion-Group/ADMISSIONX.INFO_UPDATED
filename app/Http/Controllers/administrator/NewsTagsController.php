<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\NewsTag;
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
use Config;
use Storage;
use DateTime;
use DateTimeZone;
use PDF;
use File;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class NewsTagsController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('NewsTag');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $newstags = NewsTag::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $newstags = NewsTag::paginate($perPage);
        }

        return view('administrator.news-tags.index', compact('newstags'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('NewsTag');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        return view('administrator.news-tags.create');
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

        $checkNewTagName = DB::table('news_tags')
                ->where('name', '=', Input::get('name'))
                ->count()
                ;
        if ($checkNewTagName == '0') {
            $newsTagCreateObj = New NewsTag();
            $newsTagCreateObj->name = Input::get('name');
            $newsTagCreateObj->slug = str_slug(Input::get('name'), "-");
            $newsTagCreateObj->save();

            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($newsTagCreateObj->id, $request->all());

            Session::flash('flash_message', 'News Tag added!');
        }else{
            Session::flash('flash_message', 'This News Tag already exist.');
        }

        return redirect($this->fetchDataServiceController->routeCall().'/news-tags');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('NewsTag');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        //$newstag = NewsTag::findOrFail($id);

        $newstag = NewsTag::orderBy('news_tags.id', 'ASC')
                    ->select('news_tags.id', 'news_tags.name', 'news_tags.slug')
                    ->findOrFail($id)
                    ;

        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                        ->leftJoin('users as eID','seo_contents.employee_id', '=','eID.id')
                        ->where('seo_contents.newsTagId','=', $id)
                        ->select('seo_contents.id','pagetitle', 'seo_contents.description as SEODescription', 'seo_contents.keyword', 'seo_contents.misc', 'seo_contents.slugurl', 'seo_contents.h1title', 'seo_contents.canonical', 'seo_contents.h2title', 'seo_contents.h3title', 'seo_contents.image', 'seo_contents.imagealttext', 'seo_contents.content', 'seo_contents.pageId', 'seo_contents.userId', 'seo_contents.collegeId', 'seo_contents.examId', 'seo_contents.boardId', 'seo_contents.careerReleventId', 'seo_contents.popularCareerId','seo_contents.courseId','seo_contents.newsTagId','seo_contents.examSectionId','seo_contents.employee_id','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','seo_contents.updated_at')
                        ->first();

        return view('administrator.news-tags.show', compact('newstag','seocontent'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('NewsTag');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $newstag = NewsTag::findOrFail($id);
        $seocontent = SeoContent::orderBy('seo_contents.id' ,'DESC')
                    ->where('seo_contents.newsTagId','=', $id)
                    ->select('seo_contents.id as seoContentId','pagetitle', 'seo_contents.description as SEODescription','keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','newsTagId','examSectionId')
                    ->get();


        return view('administrator.news-tags.edit', compact('newstag','seocontent'));
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
        $checkNewTag = DB::table('news_tags')
            ->where('id', '=', $id)
            ->get()
            ;

        $checkNewTagName = DB::table('news_tags')
            ->where('name', '=', Input::get('name'))
            ->where('name', '!=', $checkNewTag[0]->name)
            ->count()
            ;

        if ($checkNewTagName == '0') {
            $newsTagUpdateObj = NewsTag::findOrFail($id);
            $newsTagUpdateObj->name = Input::get('name');
            $newsTagUpdateObj->slug = str_slug(Input::get('name'), "-");
            $newsTagUpdateObj->save();

            $seocontent = $this->fetchDataServiceController->seoContentCreateUpdate($id, $request->all());
            Session::flash('flash_message', 'News Tag updated!');
        }else{
            Session::flash('flash_message', 'This News Tag already exist.');
        }

        return redirect($this->fetchDataServiceController->routeCall().'/news-tags');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('NewsTag');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::table('seo_contents')
                    ->where('seo_contents.newsTagId', '=', $id)
                    ->delete();
                    
        NewsTag::destroy($id);

        Session::flash('flash_message', 'NewsTag deleted!');

        return redirect($this->fetchDataServiceController->routeCall().'/news-tags');
    }
}
