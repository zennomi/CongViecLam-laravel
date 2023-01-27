<?php

namespace Modules\Faq\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Faq\Entities\Faq;
use Illuminate\Routing\Controller;
use Modules\Faq\Entities\FaqCategory;
use Modules\Faq\Actions\SortingFaqCategory;
use Illuminate\Contracts\Support\Renderable;

class FaqCategoryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        abort_if(!userCan('faq.view'), 403);

        $data['faqCategories'] = FaqCategory::oldest('order')->get();
        return view('faq::faqcategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(!userCan('faq.create'), 403);

        return view('faq::faqcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        abort_if(!userCan('faq.create'), 403);

        $request->validate([
            'name' => 'required|unique:faq_categories,name',
            'icon' => 'required',
        ]);

        FaqCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon
        ]);

        flashSuccess('Faq Category Successfully Created');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(FaqCategory $faq_category)
    {
        abort_if(!userCan('faq.update'), 403);

        return view('faq::faqcategory.edit', compact('faq_category'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, FaqCategory $faq_category)
    {
        abort_if(!userCan('faq.update'), 403);

        $request->validate([
            'name' => "required|unique:faq_categories,name,{$faq_category->id}"
        ]);

        $faq_category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon
        ]);

        flashSuccess('Faq Category Successfully Updated');
        return redirect()->route('module.faq.category.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param FaqCategory $faq_category
     * @return Renderable
     */
    public function destroy(FaqCategory $faq_category)
    {
        abort_if(!userCan('faq.delete'), 403);

        $faq_category->delete();

        flashSuccess('Faq Category Successfully Deleted');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param $request
     * @return Response
     */
    public function updateOrder(Request $request)
    {
        abort_if(!userCan('faq.update'), 403);

        try {
            SortingFaqCategory::sort($request);
            return response()->json(['message' => 'Faq Category Sorted Successfully!']);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }
}
