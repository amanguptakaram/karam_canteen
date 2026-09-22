<?php

namespace App\Http\Controllers;

use App\Models\Permission;

class AdminPermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('slug')->get();

        return view('admin.permissions.index', compact('permissions'));
    }
}