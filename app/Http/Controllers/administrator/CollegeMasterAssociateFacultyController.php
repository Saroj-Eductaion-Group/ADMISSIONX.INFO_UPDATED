<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CollegeMasterAssociateFaculty;
use Illuminate\Http\Request;
use Session;

class CollegeMasterAssociateFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return Redirect::back();
        $collegemasterassociatefaculty = CollegeMasterAssociateFaculty::paginate(25);

        return view('administrator.college-master-associate-faculty.index', compact('collegemasterassociatefaculty'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Redirect::back();
        return view('administrator.college-master-associate-faculty.create');
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
        
        CollegeMasterAssociateFaculty::create($requestData);

        Session::flash('flash_message', 'CollegeMasterAssociateFaculty added!');

        return redirect('administrator/college-master-associate-faculty');
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
        $collegemasterassociatefaculty = CollegeMasterAssociateFaculty::findOrFail($id);

        return view('administrator.college-master-associate-faculty.show', compact('collegemasterassociatefaculty'));
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
        $collegemasterassociatefaculty = CollegeMasterAssociateFaculty::findOrFail($id);

        return view('administrator.college-master-associate-faculty.edit', compact('collegemasterassociatefaculty'));
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
        
        $collegemasterassociatefaculty = CollegeMasterAssociateFaculty::findOrFail($id);
        $collegemasterassociatefaculty->update($requestData);

        Session::flash('flash_message', 'CollegeMasterAssociateFaculty updated!');

        return redirect('administrator/college-master-associate-faculty');
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
        CollegeMasterAssociateFaculty::destroy($id);

        Session::flash('flash_message', 'CollegeMasterAssociateFaculty deleted!');

        return redirect('administrator/college-master-associate-faculty');
    }
}
