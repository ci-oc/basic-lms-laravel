<?php

namespace App\Http\Middleware;

use Closure;

class RestrictAdministrationAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $can_access = session()->get('answered-correctly');
        if ($can_access) {
            return $next($request);
        } else {
            return redirect()->back()->with('failed','');
        }
    }
}
