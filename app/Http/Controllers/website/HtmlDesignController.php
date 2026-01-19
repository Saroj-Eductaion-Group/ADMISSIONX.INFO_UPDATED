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
use DateTime;

use Illuminate\Database\QueryException as QueryException;

class HtmlDesignController extends Controller
{
    public function newHomeDesign()
    {
        return view('website/home.html-design.new-home-design');
    }

    public function searchCollegePage()
    {
        return view('website/home.html-design.search-college-page');
    }

    public function govtExamsPage()
    {
        return view('website/home.html-design.govt-exams-page');
    }

    public function govtExamsDetailPage()
    {
        return view('website/home.html-design.govt-exams-detail-page');
    }

    public function govtExamsListPage()
    {
        return view('website/home.html-design.govt-exams-list-page');
    }

    public function chooseStreamPage()
    {
        return view('website/home.html-design.choose-stream-page');
    }

    public function chooseStreamDetailPage()
    {
        return view('website/home.html-design.choose-stream-detail-page');
    }

    public function chooseStreamFullDetailPage()
    {
        return view('website/home.html-design.choose-stream-full-detail-page');
    }

    public function demoNewDesign()
    {
        return view('website/home.html-design.demo-new-design');
    }

    public function collegeListPage()
    {
        return view('website/home.html-design.college-list-page');
    }

    public function topCollegePage()
    {
        return view('website/home.html-design.top-college-page');
    }


    public function dmNewHomeDesign()
    {
        return view('website/home.html-design.dm-new-home-design');
    }

    public function dmCollegeListPage()
    {
        return view('website/home.html-design.dm-college-list-page');
    }


    public function dmTopCollegePage()
    {
        return view('website/home.html-design.dm-top-college-page');
    }


    public function studentPopupPage()
    {
        return view('website/home.html-design.student-popup-page');
    }


    public function studentPopupOnePage()
    {
        return view('website/home.html-design.student-popup-one-page');
    }

    public function collegePopupOnePage()
    {
        return view('website/home.html-design.college-popup-one-page');
    }

   public function landingPageOne()
    {
        return view('website/home.html-design.landing-page-one');
    }

}
