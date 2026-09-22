<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        // User login nahi hai
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Admin / Staff Panel Access
        |--------------------------------------------------------------------------
        |
        | Any user having a role can enter the admin/staff panel.
        | Actual feature access is controlled by permissions.
        |
        */

        if (!$user->role_id && $user->role !== 'admin') {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('admin.login')
                ->withErrors([
                    'email' => 'You do not have admin/staff access.',
                ]);
        }

        return $next($request);
    }
}