<?php

namespace Modules\Map\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\Country;
use Modules\SetupGuide\Entities\SetupGuide;
use Illuminate\Contracts\Support\Renderable;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('map::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('map::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('map::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('map::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $setting = Setting::first();

        $request->validate([
            'map_type' => 'required'
        ]);

        if ($request->map_type == 'google-map') {
            $request->validate([
                'google_map_key' => 'nullable',
            ]);
        } else {
            $request->validate([
                'map_box_key' => 'nullable',
            ]);
        }

        if ($request->map_type == 'google-map') {
            $setting->update([
                'default_map' => $request->map_type,
                'google_map_key' => $request->google_map_key ?? '',
            ]);
        } else {
            $setting->update([
                'default_map' => $request->map_type,
                'map_box_key' => $request->map_box_key ?? '',
            ]);
        }

        if ($request->map_type) {
            SetupGuide::where('task_name', 'map_configuration')->update(['status' => 1]);
        }

        if ($request->has('app_country_type')) {
            $setting->update([
                'app_country_type' => $request->app_country_type
            ]);

            if ($request->app_country_type == 'single_base') {

                $selected_country = session()->get('selected_country');
                if ($selected_country) {
                    session()->forget('selected_country');
                }

                $country =  Country::FindOrFail($request->app_country);
                $setting->update([
                    'app_country' => $country->id,
                    'default_long' => $country->longitude,
                    'default_lat' => $country->latitude,
                ]);

                SetupGuide::where('task_name', 'set_location')->update(['status' => 1]);
            } else {
                if ($request->has('multiple_country') && $request->multiple_country !== null) {

                    // first all old selected country unbind
                    $app_multiple_countries_old = Country::where('status', true)->get();
                    foreach ($app_multiple_countries_old as $country_old) {
                        $country_old->update([
                            'status' => 0,
                        ]);
                    }

                    // then new commer bind
                    $app_multiple_countries = Country::whereIn('id', $request->multiple_country)->get();
                    foreach ($app_multiple_countries as $country) {
                        $country->update([
                            'status' => true,
                        ]);
                    }

                    SetupGuide::where('task_name', 'set_location')->update(['status' => 1]);
                }
            }
        }


        flashSuccess('Location configuration updated !');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
