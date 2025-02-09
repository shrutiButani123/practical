<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (auth()->check() && !auth()->user()->verified) {
        //     return redirect()->route('login.create')->with('error', 'You need to verify your account before logging in.');
        // }
    
        // return $next($request);

        // Check if the user is authenticated and verified
        if (auth()->check()) {
            if (!auth()->user()->verified) {
                return redirect()->route('login.create')->with('error', 'You need to verify your account before logging in.');
            }
            return $next($request);
        }

        // If not authenticated, redirect to login page
        return redirect()->route('login.create')->with('error', 'Please log in to continue.');
    }
}
