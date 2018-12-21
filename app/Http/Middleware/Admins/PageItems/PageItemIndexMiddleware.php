<?php

namespace App\Http\Middleware\Admins\PageItems;

use Closure;

class PageItemIndexMiddleware
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

        if (!$user->hasAnyPermission(['admin.page-items.create', 'admin.page-items.edit', 'admin.page-items.destroy'])) {
            abort(401);
        }

        return $next($request);
    }
}
