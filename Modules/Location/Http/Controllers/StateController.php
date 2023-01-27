<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use Illuminate\Contracts\Support\Renderable;

class StateController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        abort_if(!userCan('state.view'), 403);

        $query = State::query();
        // name filter
        if ($request->has('name') && $request->name != null) {

            $query->where('name', 'LIKE', "%$request->name%");
        }

        if ($request->has('country') && $request->country != null) {

            $query->where('country_id', $request->country);
        }

        // state
        if ($request->has('state') && $request->state) {

            $query->where('state_id', $request->state);
        }

        $allCountries = Country::all(['id', 'name']);

        $states = $query->select('id', 'country_id', 'name', 'slug')->withCount('cities')->with('country')->paginate(20)->onEachSide(0);

        if ($request->perpage != 'all') {
            $states = $states->withQueryString();
        }

        return view('location::state.index', compact('states', 'allCountries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(!userCan('state.create'), 403);

        $countries = Country::all();
        return view('location::state.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        abort_if(!userCan('state.create'), 403);

        $request->validate([
            'country' => 'required',
            'state' => 'required',
        ]);

        State::create([
            'country_id' => $request->country,
            'name' => $request->state,
            'slug' => Str::slug($request->state),
        ]);

        flashSuccess('State Created !');
        return redirect()->route('module.state.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function show(State $state)
    {
        $cities = $state->cities()->paginate(20);

        return view('location::state.show', compact('state', 'cities'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(State $state)
    {
        abort_if(!userCan('state.update'), 403);

        $countries = Country::all();
        $states = State::all();

        return view('location::state.edit', compact('state', 'states', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, State $state)
    {
        abort_if(!userCan('state.update'), 403);

        $request->validate([
            'country' => 'required',
            'state' => 'required'
        ]);

        $state->update([
            'country_id' => $request->country,
            'name' => $request->state,
        ]);

        flashSuccess('State Updated !!');

        return redirect()->route('module.state.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(State $state)
    {
        abort_if(!userCan('state.delete'), 403);

        $state->delete();

        flashSuccess('State Deleted !!');
        return redirect()->back();
    }

    public function getCountry(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    public function multipleDestroy(Request $request)
    {

        $states = State::whereIn('id', $request->ids)->get();

        foreach ($states as $state) {

            $state->delete();
        }

        flashSuccess('State Deleted Successfully !!');

        return true;
    }
}
