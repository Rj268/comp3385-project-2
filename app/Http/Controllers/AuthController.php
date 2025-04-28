<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
{
    // Validate against 'name' instead of 'email'
    $request->validate([
        'name'     => 'required|string',
        'password' => 'required|string',
    ]);

    // Attempt with name + password
    if (!Auth::attempt($request->only('name', 'password'))) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    $token = $request->user()->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type'   => 'Bearer',
    ]);
}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function user(Request $request)
{
    return response()->json([
      'id'         => $request->user()->id,
      'name'       => $request->user()->name,
      'email'      => $request->user()->email,
      'location'   => $request->user()->location,
      'biography'  => $request->user()->biography,
      'photo_url'  => $request->user()->photo ? url("storage/{$request->user()->photo}") : null,
      'joined_at'  => $request->user()->created_at->toDateString(),
      'favourites' => $request->user()->favourites, 
    ]);
}


    public function update(Request $request)
{
    $data = $request->validate([
      'name'      => 'required|string',
      'location'  => 'nullable|string',
      'biography' => 'nullable|string',
      // …other rules…
    ]);

    /** @var User $user */
    $user = $request->user();
    $user->update($data);

    return response()->json($user);
}

}
