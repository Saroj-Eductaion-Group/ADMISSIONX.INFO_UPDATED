<?php

namespace App\Http\Controllers\website;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Log;
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
use App\Models\CollegeLog;
use App\Models\Address;

class WebsiteLogController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function catchAllEventInApp($eventName)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $validateWithAdminRole = DB::table('users')
                                        ->where('users.id', '=', AUTH::id())
                                        ->select('users.userrole_id')
                                        ->take(1)
                                        ->orderBy('users.id', 'DESC')
                                        ->get()
                                        ;
            
        	$websiteLogObj = New Log;
            $websiteLogObj->users_id = Auth::id();
            $websiteLogObj->event = $eventName;
            $websiteLogObj->userrole_id = $validateWithAdminRole[0]->userrole_id;
            $websiteLogObj->ipaddress = app('Illuminate\Http\Request')->ip();
            $websiteLogObj->employee_id = Auth::id();
            $websiteLogObj->save();
            
        }else{
            $websiteLogObj = New Log;
            $websiteLogObj->users_id = '0';
            $websiteLogObj->event = $eventName;
            $websiteLogObj->userrole_id = '0';
            $websiteLogObj->ipaddress = app('Illuminate\Http\Request')->ip();
            $websiteLogObj->save();
       	}
       	return 1;
    }

    public function catchAllEventCollege($CollegeLogEvent, $collegeID)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $validateUserRole = DB::table('users')
                                        ->where('users.id', '=', AUTH::id())
                                        ->select('users.userrole_id')
                                        ->take(1)
                                        ->orderBy('users.id', 'DESC')
                                        ->get()
                                        ;
            
            $websiteLogObj = New CollegeLog;
            $websiteLogObj->users_id = Auth::id();
            $websiteLogObj->event = $CollegeLogEvent;
            $websiteLogObj->college_id = $collegeID;
            $websiteLogObj->course_id = '0';
            if($validateUserRole[0]->userrole_id == '3'){
                $websiteLogObj->student_id = Auth::id();
            }
            $websiteLogObj->userrole_id = $validateUserRole[0]->userrole_id;
            $websiteLogObj->ipaddress = app('Illuminate\Http\Request')->ip();
            if($validateUserRole[0]->userrole_id == '1' && $validateUserRole[0]->userrole_id == '4'){
                $websiteLogObj->employee_id = Auth::id();
            }
            $websiteLogObj->save();
            
        }else{
            $websiteLogObj = New CollegeLog;
            $websiteLogObj->users_id = '0';
            $websiteLogObj->event = $CollegeLogEvent;
            $websiteLogObj->college_id = $collegeID;
            $websiteLogObj->course_id = '0';
            $websiteLogObj->student_id = '0';
            $websiteLogObj->userrole_id = '0';
            $websiteLogObj->ipaddress = app('Illuminate\Http\Request')->ip();
            $websiteLogObj->save();
        }
        return 1;
    }

    public function catchAllEventCourseCollege($CollegeLogEvent, $collegeID, $collegemasterId)
    {
        //Get the auth validity
        if (Auth::check())
        {
            $validateUserRole = DB::table('users')
                                        ->where('users.id', '=', AUTH::id())
                                        ->select('users.userrole_id')
                                        ->take(1)
                                        ->orderBy('users.id', 'DESC')
                                        ->get()
                                        ;
            
            $websiteLogObj = New CollegeLog;
            $websiteLogObj->users_id = Auth::id();
            $websiteLogObj->event = $CollegeLogEvent;
            $websiteLogObj->college_id = $collegeID;
            $websiteLogObj->course_id = $collegemasterId;
            if($validateUserRole[0]->userrole_id == '3'){
                $websiteLogObj->student_id = Auth::id();
            }
            $websiteLogObj->userrole_id = $validateUserRole[0]->userrole_id;
            $websiteLogObj->ipaddress = app('Illuminate\Http\Request')->ip();
            if($validateUserRole[0]->userrole_id == '1' && $validateUserRole[0]->userrole_id == '4'){
                $websiteLogObj->employee_id = Auth::id();
            }
            $websiteLogObj->save();
            
        }else{
            $websiteLogObj = New CollegeLog;
            $websiteLogObj->users_id = '0';
            $websiteLogObj->event = $CollegeLogEvent;
            $websiteLogObj->college_id = $collegeID;
            $websiteLogObj->course_id = $collegemasterId;
            $websiteLogObj->student_id = '0';
            $websiteLogObj->userrole_id = '0';
            $websiteLogObj->ipaddress = app('Illuminate\Http\Request')->ip();
            $websiteLogObj->save();
        }
        return 1;
    }


    
    public function testEmailTemp(Request $request)
    {
        return view('emailtemplate/course-application.email-to-college')
                ->with('email' , 'technochords2014@gmail.com')
                ->with('collegeName' , 'School of Computer Science')
                ->with('courseName' , 'Master of computer applications')
                ->with('applicationId' , 'bya16-08-04-45')
                ;
    }
}
