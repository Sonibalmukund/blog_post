<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Gate::allows('is-admin')) {
            return response()->view('errors.403_custom', [], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
