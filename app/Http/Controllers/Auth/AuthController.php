<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^09[0-9]{9}$/'
        ]);

        $phone = $request->phone;
        $otp = '123456'; // For development, in production use: str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Invalidate any existing OTP codes for this phone
        OtpCode::where('phone', $phone)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->update(['used' => true]);

        // Create new OTP code
        OtpCode::create([
            'phone' => $phone,
            'code' => Hash::make($otp),
            'expires_at' => now()->addMinutes(2),
            'used' => false
        ]);

        // TODO: Integrate with your SMS service provider
        // For development, we'll just log the OTP
        \Log::info("OTP for {$phone}: {$otp}");

        return back()->with('success', 'کد تایید به شماره موبایل شما ارسال شد.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^09[0-9]{9}$/',
            'otp' => 'required|digits:6'
        ]);

        $phone = $request->phone;
        $otp = $request->otp;

        // Find the latest valid OTP code
        $otpCode = OtpCode::where('phone', $phone)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otpCode || !Hash::check($otp, $otpCode->code)) {
            return back()->with('error', 'کد تایید نامعتبر است.');
        }

        // Mark OTP as used
        $otpCode->update(['used' => true]);

        // Find or create user
        $user = User::firstOrCreate(
            ['phone' => $phone],
            [
                'name' => 'کاربر ' . substr($phone, -4),
                'password' => Hash::make(Str::random(16))
            ]
        );

        // Login user
        Auth::login($user);

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
} 