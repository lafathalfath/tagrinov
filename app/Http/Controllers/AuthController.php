<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
        // $token = $user->createToken('auth_token')->plainTextToken;
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        return response()->json(['status' => 'created', 'payload' => $user], 201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) return response()->json(['status' => 'error', 'message' => 'cannot found any users'], 404);
        if (!Hash::check($request->password, $user->password)) return response()->json(['status' => 'error', 'message' => 'password invalid']);
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        return response()->json(['status' => 'success', 'message' => 'login successfully'], 200);
    }

    public function logout() {
        Auth::logout();
        return response()->json(['status' => 'success', 'message' => 'logout successfully']);
    }
}
