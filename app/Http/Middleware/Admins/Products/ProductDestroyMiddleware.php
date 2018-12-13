<?php

namespace App\Http\Middleware\Admins\Products;

use Closure;

class ProductDestroyMiddleware
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

        if (!$user->hasAnyPermission(['admin.product.destroy'])) {

            if($request->ajax()) {
                return response([], 401);
            }

            abort(401);
        }

        return $next($request);
    }
}
