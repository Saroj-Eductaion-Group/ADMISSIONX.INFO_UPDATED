<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CollegeSocialMediaLink;
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

class CollegeSocialMediaLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return Redirect::back();
        $collegesocialmedialinks = CollegeSocialMediaLink::paginate(25);

        return view('administrator.college-social-media-links.index', compact('collegesocialmedialinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Redirect::back();
        return view('administrator.college-social-media-links.create');
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
        return Redirect::back();
        $requestData = $request->all();
        
        CollegeSocialMediaLink::create($requestData);

        Session::flash('flash_message', 'CollegeSocialMediaLink added!');

        return redirect('administrator/college-social-media-links');
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
        return Redirect::back();
        $collegesocialmedialink = CollegeSocialMediaLink::findOrFail($id);

        return view('administrator.college-social-media-links.show', compact('collegesocialmedialink'));
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
        return Redirect::back();
        $collegesocialmedialink = CollegeSocialMediaLink::findOrFail($id);

        return view('administrator.college-social-media-links.edit', compact('collegesocialmedialink'));
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
        return Redirect::back();
        $requestData = $request->all();
        
        $collegesocialmedialink = CollegeSocialMediaLink::findOrFail($id);
        $collegesocialmedialink->update($requestData);

        Session::flash('flash_message', 'CollegeSocialMediaLink updated!');

        return redirect('administrator/college-social-media-links');
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
        CollegeSocialMediaLink::destroy($id);

        Session::flash('flash_message', 'CollegeSocialMediaLink deleted!');

        return redirect('administrator/college-social-media-links');
    }
}
