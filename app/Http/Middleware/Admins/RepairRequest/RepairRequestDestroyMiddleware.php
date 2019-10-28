<?php

namespace App\Http\Middleware\Admins\RepairRequest;

use Closure;

class RepairRequestDestroyMiddleware
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
            if (!$user->hasAnyPermission(['admin.request.destroy'])) {

                if($request->ajax()) {
                    return response([], 401);
                }

                abort(401);
            }
        }

        return $next($request);
    }
}
