<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Group;

class GroupAdmin
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
        $group_id = $request->segment(2);
        $group = Group::find($group_id);
        $owner_id = $group->owner_id;
        if (Auth::user() && Auth::user()->id == $owner_id) {
            return $next($request);
        }

        if (Auth::user() && Auth::user()->isAdminGroup($request)) {
            return $next($request);
        }

        if (Auth::user() && Auth::user()->is_admin){
            return $next($request);
        }
        return response('Forbidden -  you do not have permission to execute this page, group permission error', 403);
    }
}
