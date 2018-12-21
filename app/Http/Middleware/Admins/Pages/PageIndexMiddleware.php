<?php

namespace App\Http\Middleware\Admins\Pages;

use Closure;

class PageIndexMiddleware
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

        if (!$user->hasAnyPermission(['admin.pages.create', 'admin.pages.edit', 'admin.pages.destroy'])) {
            abort(401);
        }

        return $next($request);
    }
}
