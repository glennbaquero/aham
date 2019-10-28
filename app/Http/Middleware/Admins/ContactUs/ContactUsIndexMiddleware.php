<?php

namespace App\Http\Middleware\Admins\ContactUs;

use Closure;

class ContactUsIndexMiddleware
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
            if (!$user->hasAnyPermission(['admin.contacts.index'])) {
                abort(401);
            }
        }
        return $next($request);
    }
}
