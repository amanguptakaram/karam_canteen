<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Display all registered users.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display a single user with order history.
     */
    public function show(User $user)
    {
        $user->load([
            'orders' => function ($query) {
                $query->latest();
            },
            'orders.items.food',
        ]);

        return view('admin.users.show', compact('user'));
    }
}