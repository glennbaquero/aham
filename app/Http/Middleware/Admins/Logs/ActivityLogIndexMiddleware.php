<?php

namespace App\Http\Middleware\Admins\Logs;

use Closure;

class ActivityLogIndexMiddleware
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

        if (!$user->hasAnyPermission(['activity-logs.index'])) {
            abort(401);
        }

        return $next($request);
    }
}
