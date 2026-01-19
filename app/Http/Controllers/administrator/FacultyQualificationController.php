<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FacultyQualification;
use Illuminate\Http\Request;
use Session;

class FacultyQualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return Redirect::back();
        $facultyqualification = FacultyQualification::paginate(25);

        return view('administrator.faculty-qualification.index', compact('facultyqualification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Redirect::back();
        return view('administrator.faculty-qualification.create');
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
        
        FacultyQualification::create($requestData);

        Session::flash('flash_message', 'FacultyQualification added!');

        return redirect('administrator/faculty-qualification');
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
        $facultyqualification = FacultyQualification::findOrFail($id);

        return view('administrator.faculty-qualification.show', compact('facultyqualification'));
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
        $facultyqualification = FacultyQualification::findOrFail($id);

        return view('administrator.faculty-qualification.edit', compact('facultyqualification'));
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
        
        $facultyqualification = FacultyQualification::findOrFail($id);
        $facultyqualification->update($requestData);

        Session::flash('flash_message', 'FacultyQualification updated!');

        return redirect('administrator/faculty-qualification');
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
        FacultyQualification::destroy($id);

        Session::flash('flash_message', 'FacultyQualification deleted!');

        return redirect('administrator/faculty-qualification');
    }
}
