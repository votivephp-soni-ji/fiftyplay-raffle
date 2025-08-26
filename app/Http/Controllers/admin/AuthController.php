<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OtpService;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function loginPost(LoginRequest $request)
    {

        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {

            $user = Auth::user();
            if ($user->is_mfa_enabled) {
                // Temporarily log out, store user_id in session
                Auth::logout();
                session(['mfa_user_id' => $user->id]);

                $otp = OtpService::send('email', $user->email, 'login');

                return response()->json([
                    'status' => 'success',
                    'redirect' => route('mfa.verify')
                ]);
            }

            return response()->json([
                'status' => 'success',
                'redirect' => route('dashboard')
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials'
        ], 401);
    }

    public function mfaVerify()
    {
        $email = User::find(session('mfa_user_id'))->email;
        return view('auth.mfa-verify', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        $user = User::find(session('mfa_user_id'));

        if (!$user) {
            return redirect()->route('login')->withError('Session expired. Please login again.');
        }

        $isVerify = OtpService::verify('email', $user->email, 'login', $request->otp);

        if ($isVerify) {
            Auth::login($user);
            return response()->json(['status' => 'success', 'redirect' => route('dashboard')]);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid OTP']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard(Request $request)
    {
        return view('dashboard');
    }
}
