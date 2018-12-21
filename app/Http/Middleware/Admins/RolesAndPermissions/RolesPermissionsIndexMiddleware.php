<?php

namespace App\Http\Middleware\Admins\RolesAndPermissions;

use Closure;

class RolesPermissionsIndexMiddleware
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

        if (!$user->hasAnyPermission(['admin.roles.create', 'admin.roles.edit', 'admin.role.destroy'])) {
            abort(401);
        }

        return $next($request);
    }
}
