<?php

namespace App\Http\Middleware\Admins\ProductCategories;

use Closure;

class CategoryUpdateMiddleware
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

        if (!$user->hasAnyPermission(['admin.categories.edit'])) {
            abort(401);
        }

        return $next($request);
    }
}
