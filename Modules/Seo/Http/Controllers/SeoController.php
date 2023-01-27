<?php

namespace Modules\Seo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Seo\Entities\Seo;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $seos = Seo::all();
        return view('seo::index', compact('seos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('seo::create');
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
        return view('seo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('seo::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $page)
    {
        // return $request;


        $request->validate([
            'title' => 'required',
            'description' => 'max:166',
        ]);

        $page = Seo::where('page_slug', $page)->first();
        $page->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if($request->image != null && $request->hasFile('image')){

            deleteImage($page->image);

            $path = 'images/seo';
           $image = uploadImage($request->image, $path);

           $page->update([
                'image' => $image,
            ]);
        }

        flashSuccess('Page Meta Data Edited');

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
