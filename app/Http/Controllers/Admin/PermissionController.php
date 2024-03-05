<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();

        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if($permission->hasRole($request->role)) {
            return redirect()->back()->with('error', 'Role already assigned to this permission');
        }

        $permission->assignRole($request->role);

        return redirect()->back()->with('success', 'Role assigned to permission successfully');
    }

    public function revokeRole(Permission $permission, Role $role)
    {
        if($permission->hasRole($role)) {
            $permission->removeRole($role);

            return redirect()->back()->with('success', 'Role revoked from permission successfully');
        }

        return redirect()->back()->with('error', 'Role not assigned to this permission');
    }
}
