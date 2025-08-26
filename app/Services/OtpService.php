<?php

namespace App\Services;

use App\Models\Otp;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    public static function send(string $channel, string $recipient, string $purpose)
    {
        $code = (string) random_int(1000, 9999); // 4-digit
        $otp = Otp::create([
            'channel' => $channel,
            'recipient' => $recipient,
            'purpose' => $purpose,
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
            'ip' => request()->ip(),
        ]);

        // Send via chosen channel
        if ($channel === 'email') {
            $mail = Mail::to($recipient)->send(new \App\Mail\OtpCodeMail($code, $purpose));
        } else {
            // integrate your SMS provider here
            // Sms::send($recipient, "Your OTP is $code");
        }

        return $otp;
    }

    public static function verify(string $channel, string $recipient, string $purpose, string $code): bool
    {
        $otp = Otp::valid()
            ->where(compact('channel', 'recipient', 'purpose'))
            ->where('code', $code)->latest()->first();

        if (!$otp) return false;

        $otp->delete();
        return true;
    }
}
