<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CandidateMiddleware
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
        if (auth('user')->user()->role == 'candidate') {
            return $next($request);
        }

        if (auth('user')->user()->role == 'company') {
            return redirect()->route('company.dashboard');
        }

        return redirect()->route('login');
    }
}
