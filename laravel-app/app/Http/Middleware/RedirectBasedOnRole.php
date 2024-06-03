<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('student')) {
                return redirect()->route('appointments.index');
            } elseif ($user->hasRole('dean')) {
                return redirect()->route('dean.appointments.index');
            } elseif ($user->hasRole('coordinator')) {
                return redirect()->route('coordinator.appointments.index');
            }
        }

        // Redirect to login if not authenticated
        return redirect()->route('login');
    }
}


