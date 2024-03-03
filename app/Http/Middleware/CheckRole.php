<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated and has one of the specified roles
        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // If user doesn't have the required role, redirect or respond with an error
        return abort(403, 'Unauthorized.');
    }
}
