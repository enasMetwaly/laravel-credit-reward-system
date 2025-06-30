<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     // Create the user
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     // Generate a Sanctum token
    //     $token = $user->createToken('user-token')->plainTextToken;

    //     // Return the token and user data
    //     return response()->json([
    //         'message' => 'User registered successfully',
    //         'token' => $token,
    //         'user' => $user,
    //     ], 201);
    // }
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Check if user exists
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // Update existing user (optional: reset password, etc.)
        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
    } else {
        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'credits' => 0,
            'reward_points' => 0,
        ]);
    }

    $token = $user->createToken('user-token')->plainTextToken;

    return response()->json([
        'message' => $user->wasRecentlyCreated ? 'User registered successfully' : 'User updated successfully',
        'token' => $token,
        'user' => $user,
    ], 201);
}

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate credentials manually
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('user-token')->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}