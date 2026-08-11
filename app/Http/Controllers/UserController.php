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
}
