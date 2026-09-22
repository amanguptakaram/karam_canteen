<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'emp_code' => 'required|string|max:50|unique:users,emp_code',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'department' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        $userRole = Role::where('slug', 'user')->first();

        if (!$userRole) {
            return back()
                ->withErrors([
                    'email' => 'Default User role is not configured.',
                ])
                ->withInput();
        }

        User::create([
            'emp_code' => $request->emp_code,
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'password' => Hash::make($request->password),
            'role_id' => $userRole->id,
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Your account has been created successfully. Please login.'
            );
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'You have been logged out successfully.');
    }
}