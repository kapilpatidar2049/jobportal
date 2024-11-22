<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;


class SwitchLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $defaultLanguage = Session::get('changed_language');
        if (!Session::has('changed_language')) {
            $changedLanguage = isset($defaultLanguage) ? $defaultLanguage->local : 'en';
            Session::put('changed_language', $changedLanguage);
        }
        App::setLocale(Session::get('changed_language'));
        return $next($request);
    }
}
