<?php

namespace App\Http\Middleware\Admins\Users;

use Closure;

class UsersDestroyMiddleware
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

        if (!$user->hasAnyPermission(['admin.users.destroy'])) {

            if($request->ajax()) {
                return response([], 401);
            }

            abort(401);
        }

        return $next($request);
    }
}
