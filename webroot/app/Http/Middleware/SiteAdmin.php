<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SiteAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        return response('Forbidden -  you do not have permission to execute this page', 403);
    }
}
