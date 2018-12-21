<?php

namespace App\Http\Middleware\Admins\RepairRequest;

use Closure;

class RepairRequestUpdateMiddleware
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

        if (!$user->hasAnyPermission(['admin.request.edit'])) {
            abort(401);
        }

        return $next($request);
    }
}
