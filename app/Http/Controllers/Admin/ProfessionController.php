<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('professions.view'), 403);

        $professions = Profession::paginate(15);
        return view('admin.profession.index', compact('professions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!userCan('professions.create'), 403);

        $request->validate([
            'name' => 'required|string|unique:professions,name|max:255',
        ]);

        $newProfession = Profession::create($request->only('name'));

        $newProfession ? flashSuccess('Profession created!') : flashError('Something went wrong...');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        abort_if(!userCan('professions.update'), 403);
        $prof = $profession;
        $professions = Profession::latest()->paginate(15);
        return view('admin.profession.index', compact('prof', 'professions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profession $profession)
    {
        abort_if(!userCan('professions.update'), 403);

        $request->validate([
            'name' => 'required|max:255|unique:professions,name,' . $profession->id,
        ]);

        $profession->name = $request->name;
        $edited = $profession->save();

        $edited ? flashSuccess('Profession updated!') : flashSuccess('Something went wrong...');

        return redirect()->route('profession.edit', $profession->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        abort_if(!userCan('professions.delete'), 403);

        $success = $profession->delete();
        $success ? flashSuccess('Profession deleted!') : flashSuccess('Something went wrong...');
        return redirect()->route('profession.index');
    }
}
