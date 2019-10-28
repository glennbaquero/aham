<?php

namespace App\Http\Middleware\Admins\Locations;

use Closure;

class LocationIndexMiddleware
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
        if(!$user->hasRole('Super Admin')) {
            if (!$user->hasAnyPermission(['admin.locations.index'])) {
                abort(401);
            }
        }

        return $next($request);
    }
}
