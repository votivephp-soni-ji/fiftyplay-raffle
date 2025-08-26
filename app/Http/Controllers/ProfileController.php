<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function me(Request $request)
    {
        return response()->json(['data' => ['user' => $request->user()]]);
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
