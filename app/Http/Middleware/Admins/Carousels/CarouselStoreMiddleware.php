<?php

namespace App\Http\Middleware\Admins\Carousels;

use Closure;

class CarouselStoreMiddleware
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

        if (!$user->hasAnyPermission(['admin.carousel.create'])) {
            abort(401);
        }

        return $next($request);
    }
}
