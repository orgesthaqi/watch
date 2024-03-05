<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(25);

        return view('users.index' , compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function assignRole(Request $request, User $user)
    {
        if($user->hasRole($request->role)){
            return back()->with('error', 'Role already assigned');
        }

        $user->assignRole($request->role);

        return back()->with('success', 'Role assigned successfully');
    }

    public function revokeRole(User $user, Role $role)
    {
        if($user->hasRole($role)){
            $user->removeRole($role);

            return back()->with('success', 'Role revoked successfully');
        }

        return back()->with('error', 'Role not found');
    }
}
