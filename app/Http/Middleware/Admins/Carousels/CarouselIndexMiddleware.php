<?php

namespace App\Http\Middleware\Admins\Carousels;

use Closure;

class CarouselIndexMiddleware
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

        if (!$user->hasAnyPermission(['admin.carousel.index'])) {
            abort(401);
        }

        return $next($request);
    }
}
