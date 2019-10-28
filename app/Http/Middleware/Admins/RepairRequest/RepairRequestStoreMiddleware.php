<?php

namespace App\Http\Middleware\Admins\RepairRequest;

use Closure;

class RepairRequestStoreMiddleware
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
            if (!$user->hasAnyPermission(['admin.request.create'])) {
                abort(401);
            }
        }

        return $next($request);
    }
}
