<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsStaff
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isStaff()) {
            abort(403, 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}
