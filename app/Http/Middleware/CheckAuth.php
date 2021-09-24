<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 *
 */
class CheckAuth
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
