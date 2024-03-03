<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        if (!empty($request->password)) {
            $userData['password'] = bcrypt($request->password);
        }

        // Check if email already exists for another user
        $existingUser = User::where('email', $request->email)->where('id', '!=', $user->id)->first();
        if ($existingUser) {
            return redirect()->back()->with('error', 'Email already exists');
        }

        $user->fill($userData)->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }
}
