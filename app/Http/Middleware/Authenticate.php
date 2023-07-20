<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {        

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login');
        }

        if ($request->is('claimant') || $request->is('claimant/*')) {
            return route('claimant.login');
        }

        if ($request->is('super-admin') || $request->is('super-admin/*')) {
            return route('super-admin.login');
        }

        if ($request->is('user') || $request->is('user/*')) {
            return route('user.login');
        }

        if ($request->is('associate-partner') || $request->is('associate-partner/*')) {
            return route('associate-partner.login');
        }

        if ($request->is('employee') || $request->is('employee/*')) {
            return route('employee.login');
        }

        if ($request->is('hospital') || $request->is('hospital/*')) {
            return route('hospital.login');
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
