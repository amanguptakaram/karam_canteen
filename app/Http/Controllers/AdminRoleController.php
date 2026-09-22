<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')
            ->latest()
            ->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'slug' => 'required|string|max:100|alpha_dash|unique:roles,slug',
        ]);

        Role::create($validated);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $role->id,
            'slug' => 'required|string|max:100|alpha_dash|unique:roles,slug,' . $role->id,
        ]);

        $role->update($validated);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'This role is assigned to a user and cannot be deleted.'
                );
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }

    public function managePermissions(Role $role, PermissionService $permissionService)
    {
        $permissionService->syncFromConfig();

        $permissions = Permission::all();

        $role->load('permissions');

        $assignedPermissions = $role->permissions
            ->pluck('id')
            ->toArray();

        return view('admin.permissions.manage', compact(
            'role',
            'permissions',
            'assignedPermissions'
        ));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $permissionIds = $request->input('permissions', []);

        $role->permissions()->sync($permissionIds);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Permissions updated successfully.');
    }
}
