<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetAdminLocale
{
    /**
     * Force the admin panel to always use English, regardless of APP_LOCALE.
     */
    public function handle(Request $request, Closure $next): Response
    {
        app()->setLocale('en');

        return $next($request);
    }
}
