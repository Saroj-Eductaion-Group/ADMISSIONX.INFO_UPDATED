<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FacultyExperience;
use Illuminate\Http\Request;
use Session;

class FacultyExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return Redirect::back();
        $facultyexperience = FacultyExperience::paginate(25);

        return view('administrator.faculty-experience.index', compact('facultyexperience'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Redirect::back();
        return view('administrator.faculty-experience.create');
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
        
        FacultyExperience::create($requestData);

        Session::flash('flash_message', 'FacultyExperience added!');

        return redirect('administrator/faculty-experience');
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
        $facultyexperience = FacultyExperience::findOrFail($id);

        return view('administrator.faculty-experience.show', compact('facultyexperience'));
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
        $facultyexperience = FacultyExperience::findOrFail($id);

        return view('administrator.faculty-experience.edit', compact('facultyexperience'));
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
        
        $facultyexperience = FacultyExperience::findOrFail($id);
        $facultyexperience->update($requestData);

        Session::flash('flash_message', 'FacultyExperience updated!');

        return redirect('administrator/faculty-experience');
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
        FacultyExperience::destroy($id);

        Session::flash('flash_message', 'FacultyExperience deleted!');

        return redirect('administrator/faculty-experience');
    }
}
