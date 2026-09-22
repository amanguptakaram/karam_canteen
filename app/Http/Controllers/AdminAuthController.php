<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Show admin/staff login page.
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin/staff login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {

            return back()
                ->withErrors([
                    'email' => 'Invalid email or password.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Admin / Staff Access
        |--------------------------------------------------------------------------
        |
        | Any user assigned to a role can use the admin/staff login.
        |
        */

        if (!$user->role_id && $user->role !== 'admin') {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withErrors([
                    'email' => 'You do not have admin/staff access.',
                ])
                ->onlyInput('email');
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Handle admin/staff logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }
}