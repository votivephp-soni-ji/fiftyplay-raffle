<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceTokenRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function me(Request $request)
    {
        return response()->json(['data' => ['user' => $request->user()]]);
    }

    public function registerDevice(DeviceTokenRequest $request)
    {

        auth()->user()->devices()->updateOrCreate(
            ['device_token' => $request->device_token],
            ['platform' => $request->platform]
        );

        return response()->json(['success' => true]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());

        // recalc age verification if dob updated
        if ($user->dob) $user->is_age_verified = $user->dob->age >= 18;

        $user->save();
        return response()->json(['message' => 'Profile updated', 'data' => ['user' => $user]]);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate(['avatar' => 'required|image|max:2048']);
        $path = $request->file('avatar')->store('avatars', 'public');
        $user = $request->user();
        $user->avatar_url = Storage::disk('public')->url($path);
        $user->save();

        return response()->json(['message' => 'Avatar uploaded', 'data' => ['avatar_url' => $user->avatar_url]]);
    }
}
