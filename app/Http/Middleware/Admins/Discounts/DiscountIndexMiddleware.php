<?php

namespace App\Http\Middleware\Admins\Discounts;

use Closure;

class DiscountIndexMiddleware
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

        if (!$user->hasAnyPermission(['admin.discount.create', 'admin.discount.edit', 'admin.discount.destroy'])) {
            abort(401);
        }

        return $next($request);
    }
}
