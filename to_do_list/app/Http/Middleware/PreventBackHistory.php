<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //    $response=$next($request);
    //    return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
    //         ->header('Pragma','no-cache')
    //         ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');

    // }
    public function handle($request, Closure $next, $guard = null)
     {
     // if (Auth::guard($guard)->check() && Auth::user()) {
     //        return redirect('/welcome');
     //    }
        return $next($request);
    }
}
