<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheckMiddleware
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
        if (auth('user')->check() && auth('user')->user()->role == 'candidate') {
            return redirect()->route('candidate.dashboard');
        }elseif (auth('user')->check() && auth('user')->user()->role == 'company') {
            return redirect()->route('company.dashboard');
        }

        return redirect('login');
    }
}
