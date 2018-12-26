<?php

namespace App\Http\Middleware\Admins\Products;

use Closure;

class ProductUploadMiddleware
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

        if (!$user->hasAnyPermission(['admin.products.upload'])) {
            abort(401);
        }

        return $next($request);
    }
}
