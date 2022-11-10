<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionalAuthSanctum
{
    public function handle(Request $request, Closure $next)
    {

        if ($request->bearerToken()) {
            Auth::setUser(
                Auth::guard('sanctum')->user()
            );
        }

        return $next($request);
    }
}
