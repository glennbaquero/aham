<?php

namespace App\Http\Middleware\Admins\RepairRequest;

use Closure;

class RepairRequestIndexMiddleware
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

        if (!$user->hasAnyPermission(['admin.request.create', 'admin.request.edit', 'admin.request.destroy'])) {
            abort(401);
        }

        return $next($request);
    }
}
