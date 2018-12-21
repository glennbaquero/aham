<?php

namespace App\Http\Middleware\Admins\RolesAndPermissions;

use Closure;

class RolesPermissionsStoreMiddleware
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

        if (!$user->hasAnyPermission(['admin.roles.create'])) {
            abort(401);
        }

        return $next($request);
    }
}
