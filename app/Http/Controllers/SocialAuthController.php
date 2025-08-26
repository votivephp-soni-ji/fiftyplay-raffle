<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function loginWithToken(Request $request, string $provider)
    {
        $request->validate(['access_token' => 'required|string', 'id_token' => 'nullable|string']);

        // Apple often uses id_token (JWT). For Google/Facebook, access_token is sufficient.
        $socialUser = match ($provider) {
            'google', 'facebook' => Socialite::driver($provider)->userFromToken($request->access_token),
            'apple' => Socialite::driver('apple')->userFromToken($request->id_token ?? $request->access_token),
        };

        $email = $socialUser->getEmail(); // may be null on first Apple login
        $providerUserId = $socialUser->getId();

        $user = null;

        // If we have email, try find user by email; else by linked social account
        if ($email) {
            $user = User::firstOrCreate(['email' => $email], [
                'name' => $socialUser->getName(),
                'email_verified_at' => now(),
                'is_age_verified' => false,
                'preferred_language' => 'en',
                'notification_settings' => ['email' => true, 'sms' => false, 'push' => true],
            ]);
        } else {
            $link = SocialAccount::where('provider', $provider)
                ->where('provider_user_id', $providerUserId)->first();
            if ($link) $user = $link->user;
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'preferred_language' => 'en',
                    'notification_settings' => ['email' => true, 'sms' => false, 'push' => true],
                ]);
            }
        }

        SocialAccount::updateOrCreate(
            ['provider' => $provider, 'provider_user_id' => $providerUserId],
            ['user_id' => $user->id, 'email' => $email, 'raw' => $socialUser]
        );

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'message' => 'Social login success.',
            'data' => ['user' => $user],
            'token' => $token,
        ]);
    }
}
