<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($userPlan =  session('user_plan')) {
            if ((int) $userPlan->job_limit < 1) {
                session()->forget('user_plan');
                session()->put('user_plan', auth('user')->user()->company->userPlan);

                session()->flash('error', 'You have reached your plan limit. Please upgrade your plan.');
                return redirect()->route('company.plan');
            }

            return $next($request);
        }

        session()->put('user_plan', auth('user')->user()->company->userPlan);

        return redirect()->route('company.dashboard');
    }
}
