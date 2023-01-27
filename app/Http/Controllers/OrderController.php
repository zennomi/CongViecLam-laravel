<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Earning;
use App\Models\Order;
use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!userCan('order.view'), 403);

        $companies = Company::with('user')->select('id', 'user_id')->get()->makeHidden(['fullteam_size', 'banner_url', 'logo_url']);
        $plans = Plan::all();

        $order_query = Earning::query();

        if (request()->has('company') && request('company') != null) {
            $order_query->where('company_id', request('company'));
        }

        if (request()->has('plan') && request('plan') != null) {
            $order_query->where('plan_id', request('plan'));
        }

        if (request()->has('provider') && request('provider') != null) {
            $order_query->where('payment_provider', request('provider'));
        }

        if (request()->has('sort_by') && request('sort_by') != null) {
            if (request('sort_by') == 'latest') {
                $order_query->latest();
            } else {
                $order_query->oldest();
            }
        } else {
            $order_query->latest();
        }

        $orders = $order_query->with(['company.user', 'plan', 'manualPayment:id,name'])->paginate(10)->withQueryString();


        return view('admin.order.index', compact('orders', 'companies', 'plans'));
    }

    public function show($id)
    {
        abort_if(!userCan('order.view'), 403);
        $order = Earning::with('plan', 'company', 'manualPayment:id,name')->find($id);

        return view('admin.order.show', compact('order'));
    }
}
