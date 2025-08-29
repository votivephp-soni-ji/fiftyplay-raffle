<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => strtolower($request->email),
            'password' => $request->password,
            'user_type' => EVENT_ORGANIZER,
        ]);

        if ($request->device_token && $request->platform) {
            UserDevice::create([
                'user_id' => $user->id,
                'device_token' => $request->device_token,
                'platform' => $request->platform
            ]);
        }



        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $cred = $request->validated();

        $user = User::when(isset($cred['email']), fn($q) => $q->where('email', $cred['email']))
            ->when(isset($cred['phone']), fn($q) => $q->where('phone', $cred['phone']))
            ->first();

        if (!$user || (!Hash::check($cred['password'], $user->password))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'message' => 'Logged in.',
            'data' => ['user' => $user],
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out.']);
    }
}
