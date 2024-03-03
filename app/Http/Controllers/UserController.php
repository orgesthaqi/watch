<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $users = User::paginate(25);

        return view('users.index' , compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $user = User::create($request->all());

        return redirect()->route('users.index');
    }

    // Display the specified resource.
    public function show(User $user)
    {
        return $user;
    }

    // Update the specified resource in storage.
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user, 200);
    }

    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
