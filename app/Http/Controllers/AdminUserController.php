<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'role' => ['required','in:faculty,student'],
        ]);

        $tempPassword = Str::random(10) . 'aA1!'; // simple temp password pattern

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'status' => 'active',
            'must_change_password' => true,
            'password' => $tempPassword,
        ]);

        return response()->json([
            'message' => 'User created',
            'user' => $user,
            'temp_password' => $tempPassword, // show once (later we can email it)
        ], 201);
    }
}
