<?php

namespace App\Http\Middleware\Admins\ProductCategories;

use Closure;

class CategoryIndexMiddleware
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

        if (!$user->hasAnyPermission(['admin.categories.create', 'admin.categories.edit', 'admin.categories.destroy'])) {
            abort(401);
        }

        return $next($request);
    }
}
