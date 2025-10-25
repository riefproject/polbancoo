<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $roleNames = array_map('trim', $roles);
        $user = $request->user();

        if (! $user || empty($roleNames)) {
            abort(403, 'Unauthorized: No user or no roles specified');
        }

        if (! $user->hasAnyRole($roleNames)) {
            abort(403, 'Unauthorized: User does not have required role(s)');
        }

        return $next($request);
    }
}