<?php

namespace App\Http\Middleware\Admins\Locations;

use Closure;

class LocationDestroyMiddleware
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
        $user = $request->user();

        if (!$user->hasAnyPermission(['admin.locations.destroy'])) {

            if($request->ajax()) {
                return response([], 401);
            }

            abort(401);
        }
    }
}
