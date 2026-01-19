<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FacultyDepartment;
use Illuminate\Http\Request;
use Session;

class FacultyDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return Redirect::back();
        $facultydepartment = FacultyDepartment::paginate(25);

        return view('administrator.faculty-department.index', compact('facultydepartment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Redirect::back();
        return view('administrator.faculty-department.create');
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
        
        FacultyDepartment::create($requestData);

        Session::flash('flash_message', 'FacultyDepartment added!');

        return redirect('administrator/faculty-department');
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
        $facultydepartment = FacultyDepartment::findOrFail($id);

        return view('administrator.faculty-department.show', compact('facultydepartment'));
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
        $facultydepartment = FacultyDepartment::findOrFail($id);

        return view('administrator.faculty-department.edit', compact('facultydepartment'));
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
        
        $facultydepartment = FacultyDepartment::findOrFail($id);
        $facultydepartment->update($requestData);

        Session::flash('flash_message', 'FacultyDepartment updated!');

        return redirect('administrator/faculty-department');
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
        FacultyDepartment::destroy($id);

        Session::flash('flash_message', 'FacultyDepartment deleted!');

        return redirect('administrator/faculty-department');
    }
}
