<?php

namespace Modules\Location\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\Country;
use File;

class CountryController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!userCan('country.view'), 403);

        $query = Country::query();

        // name filter
        if ($request->has('name') && $request->name != null) {

            $query->where('name', 'LIKE', "%$request->name%");
        }

        // country
        if ($request->has('country') && $request->country != null) {

            $query->where('id', $request->country);
        }

        $allCountries = Country::all(['id', 'name']);

        // request('perpage', 10);
        $countries = $query->select('id', 'name', 'image', 'slug')->withCount('states')->paginate(20)->onEachSide(0);

        if ($request->perpage != 'all') {
            $countries = $countries->withQueryString();
        }

        return view('location::country.index', compact('countries', 'allCountries'));
    }

    public function create()
    {
        abort_if(!userCan('country.create'), 403);

        $countrys = Country::all();
        return view('location::country.create', compact('countrys'));
    }


    public function store(Request $request)
    {
        abort_if(!userCan('country.create'), 403);

        //Validation
        $request->validate([
            'name' => 'required|unique:countries,name',
            'image'  =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'required',

        ]);

        if ($request->file('image')) {
            $path = 'country';
            $image = uploadImage($request->image, $path);
        }
        //return $request->icon;
        Country::create([
            'name' => $request->name,
            'image' => $request->file('image') ? $image : 'backend/image/default.png',
            'icon' => $request->icon,
        ]);

        flashSuccess('Country Created Successfully !!');

        return redirect()->route('module.country.index');
    }

    public function show(Country $country)
    {
        $states = $country->states()->withCount('cities')->paginate(20);
        return view('location::country.show', compact('country', 'states'));
    }

    public function edit(Country $country)
    {
        abort_if(!userCan('country.update'), 403);

        $countries = Country::all();
        return view('location::country.edit', compact('country', 'countries'));
    }

    public function update(Request $request, Country $country)
    {
        abort_if(!userCan('country.update'), 403);

        $request->validate([
            'name' => 'required',
        ]);

        if ($request->file('image')) {
            //image validation
            $request->validate([
                'image'  =>  'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $oldImg = $country->image;
            if (file_exists($oldImg)) {
                deleteImage($oldImg);
            }

            $path = 'country';
            $image = uploadImage($request->image, $path);
            $country->update([
                'image' => $image,
            ]);
        }

        $country->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        flashSuccess('Country Updated Successfully !!');
        return redirect()->route('module.country.index');
    }

    public function destroy(Country $country)
    {
        abort_if(!userCan('country.delete'), 403);

        $country->delete();
        flashSuccess('Country Deleted Successfully !!');

        return redirect()->back();
    }

    public function multipleDestroy(Request $request)
    {
        abort_if(!userCan('country.delete'), 403);
        $countries = Country::whereIn('id', $request->ids)->get();

        foreach ($countries as $country) {

            $oldimg =   $country->image;
            if ($country->image) {
                deleteImage($oldimg);
            }
            $country->delete();
        }

        flashSuccess('Country Deleted Successfully !!');

        return true;
    }

    public function setAppCountry(Request $request)
    {
        $country =  Country::FindOrFail($request->country);

        $setting = Setting::first();
        $setting->update([
            'app_country' => $country->id,
            'default_long' => $country->longitude,
            'default_lat' => $country->latitude,
        ]);

        flashSuccess('App country set success');
        return redirect()->back();
    }
}
