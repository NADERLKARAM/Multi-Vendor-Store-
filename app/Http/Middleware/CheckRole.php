<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$types)
{
    // Get the authenticated user
    $user = $request->user();

    // If user is not authenticated, redirect to login page
    if (!$user) {
        return redirect()->route('login');
    }

    // // If no types are provided, allow access
    if (empty($types)) {
        return $next($request);
    }

    // Check if the user's role matches any of the provided types
    if (!in_array($user->roles, $types)) {
        // If not authorized, abort with a 403 Forbidden error
        abort(403);
    }

    return $next($request);
}
}