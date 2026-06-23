<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $type = Auth::user()->type;

                return match ($type) {
                    'admin' => redirect()->route('admin.dashboard'),
                    'owner', 'staff' => redirect()->route('agent.dashboard'),
                    default => redirect()->route('user.dashboard'),
                };
            }
        }

        return $next($request);
    }
}
