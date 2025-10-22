<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  array<int, string>  $roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $roleNames = array_map('trim', $roles);
        $user = $request->user();

        if (! $user || empty($roleNames)) {
            abort(403);
        }

        if (! $user->hasAnyRole($roleNames)) {
            abort(403);
        }

        return $next($request);
    }
}
