<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Page;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus;

class PagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                //$pages = Page::paginate(15);
                $pages = Page::orderBy('id', 'DESC')
                            ->leftJoin('users as eID','pages.employee_id', '=','eID.id')
                            ->paginate(15, array('pages.id','pages.title', 'pages.body', 'pages.slug', 'pages.status', 'pages.created_at', 'pages.updated_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','pages.updated_at'))
                            ;

                return view('administrator/pages.index', compact('pages'));
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
     * @return Response
     */
    public function create()
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
                return view('administrator/pages.create');
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
     * @return Response
     */
    public function store(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            //Page::create($request->all());
            $pageObj = New Page;
            $pageObj->title = Input::get('title');
            $pageObj->body = Input::get('body');

            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('title'));
            $slugUrl = strtolower($slugUrl);
            $pageObj->slug = $slugUrl;
            $pageObj->status = Input::get('status');
            $pageObj->employee_id = Auth::id();

            $pageObj->save();


            Session::flash('flash_message', 'Page added!');

            return redirect('administrator/pages');
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
     * @return Response
     */
    public function show($id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
           // $page = Page::findOrFail($id);
            
            $page = Page::orderBy('id', 'DESC')
                        ->leftJoin('users as eID','pages.employee_id', '=','eID.id')
                        ->select('pages.id','pages.title', 'pages.body', 'pages.slug', 'pages.status', 'pages.created_at', 'pages.updated_at','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','pages.updated_at')
                        ->findOrFail($id);
            return view('administrator/pages.show', compact('page'));
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
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            $page = Page::findOrFail($id);

            return view('administrator/pages.edit', compact('page'));
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
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            /*$page = Page::findOrFail($id);
            $page->update($request->all());*/

            $pageObj = Page::findOrFail($id);
            $pageObj->title = Input::get('title');
            $pageObj->body = Input::get('body');

            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', Input::get('title'));
            $slugUrl = strtolower($slugUrl);
            $pageObj->slug = $slugUrl;
            $pageObj->status = Input::get('status');
            $pageObj->employee_id = Auth::id();

            $pageObj->save();

            Session::flash('flash_message', 'Page updated!');

            return redirect('administrator/pages');
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
     * @return Response
     */
    public function destroy($id)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();
            
        if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ){
            Page::destroy($id);
            Session::flash('flash_message', 'Page deleted!');
            return redirect('administrator/pages');
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
     * Search users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function pagesSearch(Request $request)
    {
        $search0 = 'pages.id';
       
       
        if( $request->title != null ){
            $search1 = "AND `pages`.`title` LIKE  '%".$request->title."%'";
        }else{
            $search1 =  '';
        }

        if( $request->status != '' ){
            $search2 = " AND `pages`.`status` LIKE  '%".$request->status."%'";           
        }else{
            $search2 = '';
        }


        if( $request->startCounter != '' ){
            $startCounter = $request->startCounter;
        }else{
            $startCounter = 0;
        }

        if( $request->prevCounter != '' ){
            $startCounter = $request->prevCounter;
        }else{
            $startCounter = $request->startCounter;
        }

        if( $startCounter == '' ){
            $startCounter = 0;
        }
        
        $currentNode = $request->currentNode;
        if(!empty($currentNode)){
            $getValue = ($currentNode - 1)*20;  
        }else{
            $getValue = 0;
        }
                
        $pagesSearchDataObj = DB::select( DB::raw("SELECT pages.id as pagesId, pages.title, pages.status, pages.body,eID.id as eUserId, eID.firstname as employeeFirstname, eID.middlename as employeeMiddlename, eID.lastname as employeeLastname,pages.updated_at FROM  `pages`
                        LEFT JOIN `users` as `eID` ON `pages`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY pages.id ASC
                        LIMIT 20 OFFSET $getValue"
                        ));
         
        $pagesSearchDataObj1 = DB::select( DB::raw("SELECT COUNT(pages.id) as totalCount FROM  `pages` 
                        LEFT JOIN `users` as `eID` ON `pages`.`employee_id` = `eID`.`id`
                        WHERE  $search0  
                        $search1
                        $search2
                        ORDER BY pages.id ASC
                        LIMIT 20"
                    ));
        
        if(!empty($pagesSearchDataObj1)){
            $numRecords = $pagesSearchDataObj1[0]->totalCount;
            $total_pages = ceil($numRecords/20);
            $dataArray = array(
                    'pagesSearchDataObj' => $pagesSearchDataObj,
                    'pagesSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $pagesSearchDataObj1,
                );
        }else{
            $total_pages = 0;
            $dataArray = array(
                    'pagesSearchDataObj' => $pagesSearchDataObj,
                    'pagesSearchDataObj1' => $total_pages,
                    'currentNode' => $currentNode,
                    'getTotalCount' => $pagesSearchDataObj1,
                );
        }

        if( !empty($pagesSearchDataObj) )
        {
            return json_encode($dataArray);
        }else{
            return json_encode('no');
        }
    }

    public function allPagesSearch(Request $request){

         $pages = Page::orderBy('pages.id', 'DESC')
                        ->leftJoin('users as eID','pages.employee_id', '=','eID.id')
                        ->select('pages.id as pagesId', 'pages.title', 'pages.status', 'pages.body','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','pages.updated_at')
                        ->take(20)
                        ->get();
  
        return json_encode($pages);
    }

    public function deleteSearchPages(Request $request, $id)
    {   
        Page::destroy($id);
        return Redirect::back();
    }

}
