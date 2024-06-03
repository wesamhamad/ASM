<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getRoleBasedUrl')) {
    function getRoleBasedUrl() {
        $user = Auth::user();
        if ($user && $user->hasRole('student')) {
            return route('appointments.index');
        } elseif ($user && $user->hasRole('dean')) {
            return route('dean.appointments.index');
        } elseif ($user && $user->hasRole('coordinator')) {
            return route('coordinator.appointments.index');
        }
        return '#';
    }
}

if (!function_exists('isCurrentRoleUrl')) {
    function isCurrentRoleUrl() {
        $user = Auth::user();
        if ($user && $user->hasRole('student') && request()->is('appointments')) {
            return 'text-primary';
        } elseif ($user && $user->hasRole('dean') && request()->is('dean/appointments')) {
            return 'text-primary';
        } elseif ($user && $user->hasRole('coordinator') && request()->is('coordinator/appointments')) {
            return 'text-primary';
        }
        return 'text-dark';
    }
}
