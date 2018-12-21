<?php

namespace App\Http\Middleware\Admins\Locations;

use Closure;

class LocationStoreMiddleware
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

        if (!$user->hasAnyPermission(['admin.locations.create'])) {
            abort(401);
        }

        return $next($request);
    }
}
