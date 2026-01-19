<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CollegeAdmissionImportantDated;
use Illuminate\Http\Request;
use Session;

class CollegeAdmissionImportantDatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return Redirect::back();
        $collegeadmissionimportantdated = CollegeAdmissionImportantDated::paginate(25);

        return view('administrator.college-admission-important-dated.index', compact('collegeadmissionimportantdated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Redirect::back();
        return view('administrator.college-admission-important-dated.create');
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
        
        CollegeAdmissionImportantDated::create($requestData);

        Session::flash('flash_message', 'CollegeAdmissionImportantDated added!');

        return redirect('administrator/college-admission-important-dated');
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
        $collegeadmissionimportantdated = CollegeAdmissionImportantDated::findOrFail($id);

        return view('administrator.college-admission-important-dated.show', compact('collegeadmissionimportantdated'));
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
        $collegeadmissionimportantdated = CollegeAdmissionImportantDated::findOrFail($id);

        return view('administrator.college-admission-important-dated.edit', compact('collegeadmissionimportantdated'));
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
        
        $collegeadmissionimportantdated = CollegeAdmissionImportantDated::findOrFail($id);
        $collegeadmissionimportantdated->update($requestData);

        Session::flash('flash_message', 'CollegeAdmissionImportantDated updated!');

        return redirect('administrator/college-admission-important-dated');
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
        CollegeAdmissionImportantDated::destroy($id);

        Session::flash('flash_message', 'CollegeAdmissionImportantDated deleted!');

        return redirect('administrator/college-admission-important-dated');
    }
}
