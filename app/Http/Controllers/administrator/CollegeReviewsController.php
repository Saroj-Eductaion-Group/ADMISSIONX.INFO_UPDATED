<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CollegeReview;
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
Use File;
use Cache;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use App\Models\CollegeProfile;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\SeoContent;
use App\Http\Controllers\Helper\FetchDataServiceController;

class CollegeReviewsController extends Controller
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeReview');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $keyword = $request->get('search');
        $query = CollegeReview::orderBy('college_reviews.id', 'DESC')
                ->leftJoin('users as eID','college_reviews.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id');

        if (!empty($keyword)) {
            $query->orWhere('college_reviews.title', 'LIKE', "%$keyword%");
            $query->orWhere('college_reviews.description', 'LIKE', "%$keyword%");
        }

        if (!empty($request->get('collegeprofile_id'))) {
            $query->where('college_reviews.collegeprofile_id', '=', Input::get('collegeprofile_id'));
        }

        if (!empty($request->get('guestUserId'))) {
            $query->where('college_reviews.guestUserId', '=', Input::get('guestUserId'));
        }

        $collegereviews = $query->paginate(20, array('college_reviews.id','college_reviews.title', 'college_reviews.description', 'college_reviews.votes', 'college_reviews.academic', 'college_reviews.accommodation', 'college_reviews.faculty', 'college_reviews.infrastructure', 'college_reviews.placement', 'college_reviews.social', 'college_reviews.guestUserId', 'college_reviews.users_id', 'college_reviews.collegeprofile_id', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug as collegeSlug','college_reviews.created_at','studentprofile.slug as studentSlug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_reviews.updated_at'));


        $userProfileObj = DB::table('college_reviews')
                                ->leftJoin('users', 'college_reviews.guestUserId', '=', 'users.id')
                                ->select('users.id','users.firstname', DB::raw("CONCAT(IFNULL(users.firstName,''),' ',IFNULL(users.middleName,''),' ',IFNULL(users.lastName,'')) as fullname"))
                                ->groupBy('college_reviews.guestUserId')
                                ->get();

        $collegeProfileObj = DB::table('college_reviews')
                                ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                                ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                                ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                                ->groupBy('college_reviews.collegeprofile_id')
                                ->get();

        return view('administrator.college-reviews.index', compact('collegereviews','collegeProfileObj','userProfileObj'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeReview');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

       // return Redirect::back();
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        $userObj = $this->fetchDataServiceController->fetchUserList([3]);
        return view('administrator.college-reviews.create', compact('collegeProfileObj','userObj'));
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
        //return Redirect::back();
        $collegeObj = CollegeProfile::where('id', '=', Input::get('collegeprofile_id'))->firstOrFail();

        $collegeReviewObj = DB::table('college_reviews')
                        ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                        ->where('college_reviews.users_id', '=', $collegeObj->users_id)
                        ->where('college_reviews.collegeprofile_id', '=', $collegeObj->id)
                        ->where('college_reviews.guestUserId', '=', Input::get('guestUserId'))
                        ->select('college_reviews.id','studentprofile.slug')
                        ->orderBy('college_reviews.id', 'DESC')
                        ->get();

        if (sizeof($collegeReviewObj) > 0) {
            $collegeManagementObj = CollegeReview::findOrFail($collegeReviewObj[0]->id); 
        }else{
            $collegeManagementObj = New CollegeReview; 
        }
            $collegeManagementObj->title = Input::get('title');
            $collegeManagementObj->description = Input::get('description');
            $collegeManagementObj->votes = Input::get('votes');
            $collegeManagementObj->academic = Input::get('academic');
            $collegeManagementObj->accommodation = Input::get('accommodation');
            $collegeManagementObj->faculty = Input::get('faculty');
            $collegeManagementObj->infrastructure = Input::get('infrastructure');
            $collegeManagementObj->placement = Input::get('placement');
            $collegeManagementObj->social = Input::get('social');
            $collegeManagementObj->guestUserId = Input::get('guestUserId');
            $collegeManagementObj->users_id = $collegeObj->users_id;
            $collegeManagementObj->collegeprofile_id = Input::get('collegeprofile_id');
            $collegeManagementObj->employee_id = Auth::id();
            $collegeManagementObj->save();

        Session::flash('flash_message', 'College Review added!');
        Session::flash('alert_class', 'alert-success');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-reviews');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeReview');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $collegereview = CollegeReview::orderBy('college_reviews.id', 'DESC')
                ->leftJoin('users as eID','college_reviews.employee_id', '=','eID.id')
                ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
                ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                ->select('college_reviews.id','college_reviews.title', 'college_reviews.description', 'college_reviews.votes', 'college_reviews.academic', 'college_reviews.accommodation', 'college_reviews.faculty', 'college_reviews.infrastructure', 'college_reviews.placement', 'college_reviews.social', 'college_reviews.guestUserId', 'college_reviews.users_id', 'college_reviews.collegeprofile_id', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.lastname as studentUserLastName','collegeUser.id as collegeUserID', 'collegeUser.firstname as collegeUserFirstName','collegeprofile.slug as collegeSlug','college_reviews.created_at','studentprofile.slug as studentSlug','eID.id as eUserId','eID.firstname as employeeFirstname', 'eID.middlename as employeeMiddlename', 'eID.lastname as employeeLastname','college_reviews.updated_at')
                ->findOrFail($id);

        return view('administrator.college-reviews.show', compact('collegereview'));
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeReview');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
        $collegereview = CollegeReview::findOrFail($id);
        $collegeProfileObj = $this->fetchDataServiceController->fetchCollegeProfileList(2);
        $userObj = $this->fetchDataServiceController->fetchUserList([3]);

        return view('administrator.college-reviews.edit', compact('collegereview','collegeProfileObj','userObj'));
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
        $collegeObj = CollegeProfile::where('id', '=', Input::get('collegeprofile_id'))->firstOrFail();

        $collegeReviewObj = DB::table('college_reviews')
                        ->leftJoin('users as studentUser', 'college_reviews.guestUserId', '=', 'studentUser.id')
                        ->leftJoin('studentprofile', 'studentprofile.users_id', '=', 'studentUser.id')
                        ->where('college_reviews.users_id', '=', $collegeObj->users_id)
                        ->where('college_reviews.collegeprofile_id', '=', $collegeObj->id)
                        ->where('college_reviews.guestUserId', '=', Input::get('guestUserId'))
                        ->select('college_reviews.id','studentprofile.slug')
                        ->orderBy('college_reviews.id', 'DESC')
                        ->get();

        if (sizeof($collegeReviewObj) > 0) {
            $collegeManagementObj = CollegeReview::findOrFail($collegeReviewObj[0]->id); 
        }else{
            $collegeManagementObj = CollegeReview::findOrFail($id);
        }
            $collegeManagementObj->title = Input::get('title');
            $collegeManagementObj->description = Input::get('description');
            $collegeManagementObj->votes = Input::get('votes');
            $collegeManagementObj->academic = Input::get('academic');
            $collegeManagementObj->accommodation = Input::get('accommodation');
            $collegeManagementObj->faculty = Input::get('faculty');
            $collegeManagementObj->infrastructure = Input::get('infrastructure');
            $collegeManagementObj->placement = Input::get('placement');
            $collegeManagementObj->social = Input::get('social');
            $collegeManagementObj->guestUserId = Input::get('guestUserId');
            $collegeManagementObj->users_id = $collegeObj->users_id;
            $collegeManagementObj->collegeprofile_id = Input::get('collegeprofile_id');
            $collegeManagementObj->employee_id = Auth::id();
            $collegeManagementObj->save();

        Session::flash('flash_message', 'College Review updated!');
        Session::flash('alert_class', 'alert-success');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-reviews');
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
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('CollegeReview');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        CollegeReview::destroy($id);

        Session::flash('flash_message', 'College Review deleted!');
        Session::flash('alert_class', 'alert-success');
        return Redirect::back();
        //return redirect($this->fetchDataServiceController->routeCall().'/college-reviews');
    }
}
