<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarketPlace
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            if (in_array($userRole, $roles)) {
                return $next($request);
            }

            if ($userRole === 'user') {
                return redirect('/');
            } elseif ($userRole === 'client') {
                return redirect('/');
            }
        }
        return redirect('/login');
    }
}