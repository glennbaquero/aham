<?php

namespace App\Http\Middleware\Admins\ContactUs;

use Closure;

class ContactUsDestroyMiddleware
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

        if (!$user->hasAnyPermission(['admin.contacts.destroy'])) {

            if($request->ajax()) {
                return response([], 401);
            }

            abort(401);
        }

        return $next($request);
    }
}
