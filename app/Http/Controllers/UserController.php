<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() 
    {   
        $alluser = User::all();
        return view('dashboard.user.index', compact('alluser'));
    }

    public function show($id) 
    {   
        $user = User::findOrFail($id);
        return view('dashboard.user.show', compact('user'));
    }

    public function updateRole(Request $request, User $user)
    {   
        $newRole = strtolower($request->role);

        $request->validate([
            'role' => 'required|in:admin,customer',
        ]);

        $user->role = $newRole;
        $user->save();

        return redirect()->back()->with('success', 'Role user berhasil diperbarui.');
    }
}
