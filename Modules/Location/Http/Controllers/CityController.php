<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Routing\Controller;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Modules\Location\Entities\Country;
use File;
use Modules\Location\Entities\State;

class CityController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        abort_if(!userCan('city.view'), 403);

        $query = City::query();

        // name filter
        if ($request->has('name') && $request->name != null) {

            $query->where('name', 'LIKE', "%$request->name%");
        }

        if ($request->has('state') && $request->state != null) {

            $query->where('state_id', $request->state);
        }

        // sortby
        if ($request->has('sortby') && $request->sortby) {
            if ($request->sortby == 'latest') {
                $query->latest();
            } else {
                $query->oldest();
            }
        }

        $states = State::all(['id', 'name']);

        // request('perpage', 10);
        $cities = $query->with('state')->paginate(20)->onEachSide(0);

        if ($request->perpage != 'all') {
            $cities = $cities->withQueryString();
        }

        return view('location::city.index', compact('cities', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(!userCan('city.create'), 403);

        $states = State::all();

        return view('location::city.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        abort_if(!userCan('city.create'), 403);

        $request->validate([
            'state' => 'required',
            'name' => 'required',
        ]);

        City::create([
            'state_id' => $request->state,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        flashSuccess('City Created Successfully');

        return redirect()->route('module.city.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(City $city)
    {
        $city->loadCount('ads');
        $ads = $city->ads;

        return view('location::city.show', compact('city', 'ads'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(City $city)
    {
        abort_if(!userCan('city.update'), 403);

        // $city = City::find($city);
        $states = State::all();

        return view('location::city.edit', compact('city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, City $city)
    {
        abort_if(!userCan('city.update'), 403);

        $request->validate([
            'state' => 'required',
            'city' => 'required',
        ]);


        $city->update([
            'name' => $request->city,
            'state_id' => $request->state,
        ]);


        flashSuccess('City has been Successfully Updated !!');
        return redirect()->route('module.city.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(City $city)
    {
        abort_if(!userCan('city.delete'), 403);

        $city->delete();

        flashSuccess('City deleted successfully');
        return redirect()->back();
    }

    public function getState(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }

    public function multipleDestroy(Request $request)
    {

        $cities = City::whereIn('id', $request->ids)->get();

        foreach ($cities as $city) {

            $city->delete();
        }

        flashSuccess('City Deleted Successfully !!');

        return true;
    }
}
