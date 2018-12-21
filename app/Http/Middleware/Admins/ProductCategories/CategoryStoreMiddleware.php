<?php

namespace App\Http\Middleware\Admins\ProductCategories;

use Closure;

class CategoryStoreMiddleware
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

        if (!$user->hasAnyPermission(['admin.categories.create'])) {
            abort(401);
        }

        return $next($request);
    }
}
