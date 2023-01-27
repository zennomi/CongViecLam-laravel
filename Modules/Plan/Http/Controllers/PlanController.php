<?php

namespace Modules\Plan\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Plan\Entities\Plan;
use Modules\Plan\Http\Requests\PlanFormRequest;

class PlanController extends Controller
{


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        abort_if(!userCan('plan.view'), 403);

        $data['plans'] = Plan::get();
        return view('plan::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(!userCan('plan.create'), 403);

        return view('plan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PlanFormRequest $request)
    {
        abort_if(!userCan('plan.create'), 403);

        Plan::create($request->all());

        flashSuccess('Plan Created Successfully');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Plan $plan)
    {
        abort_if(!userCan('plan.update'), 403);

        return view('plan::edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PlanFormRequest $request, Plan $plan)
    {
        abort_if(!userCan('plan.update'), 403);

        $plan->update($request->all());

        flashSuccess('Plan Updated Successfully');
        return redirect()->route('module.plan.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Plan $plan)
    {
        abort_if(!userCan('plan.delete'), 403);

        $plan->delete();

        flashSuccess('Plan Deleted Successfully');
        return back();
    }

    public function markRecommended()
    {
        abort_if(!userCan('plan.update'), 403);

        \DB::table('plans')->update(['recommended' => false]);
        Plan::findOrFail(request('plan_id'))->update(['recommended' => true]);

        flashSuccess('Plan Updated Successfully');
        return back();
    }

    public function markDefault(Request $request)
    {
        abort_if(!userCan('plan.update'), 403);

        Setting::first()->update([
            'default_plan' => $request->plan_id
        ]);

        flashSuccess('Default Plan Package Updated Successfully');
        return back();
    }
}
