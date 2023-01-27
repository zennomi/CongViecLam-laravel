<?php

namespace Modules\Faq\Http\Controllers;


use Modules\Faq\Entities\Faq;
use Illuminate\Routing\Controller;
use Modules\Faq\Actions\DeleteFaq;
use Modules\Faq\Actions\UpdateFaq;
use Illuminate\Contracts\Support\Renderable;
use Modules\Faq\Http\Requests\FaqFormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Faq\Actions\CreateFaq;
use Modules\Faq\Entities\FaqCategory;

class FaqController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($slug = null)
    {
        abort_if(!userCan('faq.view'), 403);

        $faq_category = FaqCategory::withCount('faqs')->get();

        if ($slug) {
            $faqs = Faq::whereHas('faq_category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })->get();
        } else {
            $faqs = Faq::all();
        }

        $all_faqs_count = Faq::count();

        return view('faq::index', compact('faq_category', 'faqs','all_faqs_count'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(!userCan('faq.create'), 403);

        $faq_categories = FaqCategory::oldest('order')->get();
        return view('faq::create', compact('faq_categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param FaqFormRequest $request
     * @return Renderable
     */
    public function store(FaqFormRequest $request)
    {
        abort_if(!userCan('faq.create'), 403);

        $faq = CreateFaq::create($request);

        if ($faq) {
            flashSuccess('Faq Created Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Faq $faq)
    {
        abort_if(!userCan('faq.update'), 403);

        $faq_categories = FaqCategory::oldest('order')->get();
        return view('faq::edit', compact('faq', 'faq_categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param FaqFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(FaqFormRequest $request, Faq $faq)
    {
        abort_if(!userCan('faq.update'), 403);

        $faq = UpdateFaq::update($request, $faq);

        if ($faq) {
            flashSuccess('Faq Updated Successfully');
            return redirect(route('module.faq.index'));
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Faq $faq)
    {
        abort_if(!userCan('faq.delete'), 403);

        $faq = DeleteFaq::delete($faq);

        if ($faq) {
            flashSuccess('Faq Deleted Successfully');
            return redirect(route('module.faq.index'));
        } else {
            flashError();
            return back();
        }
    }
}
