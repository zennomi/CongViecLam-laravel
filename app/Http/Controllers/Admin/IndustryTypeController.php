<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndustryType;
use Illuminate\Http\Request;

class IndustryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('industry_types.view'), 403);

        $industrytypes = IndustryType::paginate(15);
        return view('admin.industryType.index', compact('industrytypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!userCan('industry_types.create'), 403);

        $request->validate([
            'name' => 'required|string|unique:industry_types,name|max:255',
        ]);

        $newType = IndustryType::create($request->only('name'));

        $newType ? flashSuccess('Industry Type created!') : flashError('Something went wrong...');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(IndustryType $industryType)
    {
        abort_if(!userCan('industry_types.update'), 403);
        $industry_type = $industryType;
        $industrytypes = IndustryType::latest()->paginate(15);
        return view('admin.industryType.index', compact('industry_type', 'industrytypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndustryType $industryType)
    {
        abort_if(!userCan('industry_types.update'), 403);

        $request->validate([
            'name' => 'required|max:255|unique:industry_types,name,' . $industryType->id,
        ]);

        $industryType->name = $request->name;
        $edited = $industryType->save();

        $edited ? flashSuccess('Industry Type updated!') : flashSuccess('Something went wrong...');

        return redirect()->route('industryType.edit', $industryType->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndustryType $industryType)
    {
        abort_if(!userCan('industry_types.delete'), 403);

        $success = $industryType->delete();
        $success ? flashSuccess('Industry Type deleted!') : flashSuccess('Something went wrong...');
        return redirect()->route('industryType.index');
    }
}
