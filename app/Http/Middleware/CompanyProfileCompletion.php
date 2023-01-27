<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyProfileCompletion
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
        // Please note here complete = 1 means company has completed his profile
        if (!auth('user')->user()->company->profile_completion) {
            return redirect(route('company.account-progress'));
        }

        return $next($request);
    }
}
