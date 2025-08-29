<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Kreait\Firebase\Auth as FirebaseAuth;
use Illuminate\Http\Request;

class FirebaseAuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function login(Request $request)
    {
        try {
            // Extract Firebase ID token
            $idToken = $request->bearerToken();

            // Verify with Firebase
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            // Get Firebase user info
            $firebaseUser = $this->firebaseAuth->getUser($uid);

            // Find or create local user
            $user = User::firstOrCreate(
                ['email' => $firebaseUser->email],
                ['name' => $firebaseUser->displayName ?? 'Unknown']
            );

            // Issue Laravel token (Sanctum example)
            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized', 'message' => $e->getMessage()], 401);
        }
    }
}
