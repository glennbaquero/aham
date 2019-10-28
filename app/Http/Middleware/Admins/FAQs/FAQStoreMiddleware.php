<?php

namespace App\Http\Middleware\Admins\FAQs;

use Closure;

class FAQStoreMiddleware
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

        if(!$user->hasRole('Super Admin')) {
            if (!$user->hasAnyPermission(['admin.faqs.create'])) {
                abort(401);
            }
        }

        return $next($request);
    }
}
