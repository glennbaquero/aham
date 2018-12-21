<?php

namespace App\Http\Middleware\Admins\FAQs;

use Closure;

class FAQIndexMiddleware
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

        if (!$user->hasAnyPermission(['admin.faqs.create', 'admin.faqs.edit', 'admin.faqs.destroy'])) {
            abort(401);
        }

        return $next($request);
    }
}
