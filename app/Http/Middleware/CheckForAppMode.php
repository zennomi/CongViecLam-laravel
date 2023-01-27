<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckForAppMode
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
        $admin_check = auth('admin')->check();

        if (config('app.mode') == 'maintenance' && !$request->is('admin/*') && !$admin_check) {
            return response()->view('errors.maintenance');
        } elseif (config('app.mode') == 'comingsoon' && !$request->is('admin/*') && !$admin_check) {
            return response()->view('errors.comingsoon');
        }

        return $next($request);
    }
}
