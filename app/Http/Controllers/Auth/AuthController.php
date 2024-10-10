<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'messages' => 'Unauthorized'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'messages' => 'Login successfully',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:user,email'],
            'password' => Password::min(8)->letters()->numbers()
        ]);

        User::create($credentials);

        return response()->json([
            'messages' => 'User created successfully'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'messages' => 'Logout successfully'
        ]);
    }
}
