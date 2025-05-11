<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Services\SmsService;
use App\Notifications\SendOtpToUser;

class AuthController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function showLoginForm()
    {
        return view('auth.phone');
    }

    public function sendOtp(Request $request)
    {
        try {
            \Log::info('Starting OTP send process for phone: ' . $request->phone);
            
            $request->validate([
                'phone' => 'required|string|size:11'
            ]);

            $phone = $request->phone;
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            \Log::info('Invalidating existing OTP codes for phone: ' . $phone);
            
            // Invalidate any existing OTP codes for this phone
            $invalidated = OtpCode::where('phone', $phone)
                ->where('used', false)
                ->where('expires_at', '>', now())
                ->update(['used' => true]);
            
            \Log::info('Invalidated existing OTP codes: ' . $invalidated);

            \Log::info('Creating new OTP code with data:', [
                'phone' => $phone,
                'code' => $otp,
                'expires_at' => now()->addMinutes(2)
            ]);
            
            // Create new OTP code
            $otpCode = new OtpCode([
                'phone' => $phone,
                'code' => Hash::make($otp),
                'expires_at' => now()->addMinutes(2),
                'used' => false
            ]);

            $saved = $otpCode->save();
            
            \Log::info('OTP code save result: ' . ($saved ? 'success' : 'failed'));

            if (!$saved) {
                \Log::error('Failed to create OTP code for phone: ' . $phone);
                return back()->with('error', 'خطا در ارسال کد تایید. لطفا دوباره تلاش کنید.');
            }

            // Create a temporary user for notification
            $user = new User();
            $user->phone = $phone;

            // Send OTP via notification
            $user->notify(new SendOtpToUser($otp));

            \Log::info('OTP code created and SMS sent successfully', [
                'phone' => $phone,
                'otp' => $otp,
                'expires_at' => $otpCode->expires_at,
                'id' => $otpCode->id
            ]);

            // Check if user exists
            $isNewUser = !User::where('phone', $phone)->exists();

            return view('auth.verify', compact('phone', 'isNewUser'));
        } catch (\Exception $e) {
            \Log::error('Error in sendOtp: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'phone' => $request->phone ?? 'not provided'
            ]);
            return back()->with('error', 'خطا در ارسال کد تایید. لطفا دوباره تلاش کنید.');
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|size:11',
            'otp' => 'required|digits:6',
            'name' => 'required|string|min:2'
        ]);

        $phone = $request->phone;
        $otp = $request->otp;
        $name = $request->name;

        // Find the latest valid OTP code
        $otpCode = OtpCode::where('phone', $phone)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otpCode) {
            return back()->with('error', 'کد تایید نامعتبر است.');
        }

        if (!Hash::check($otp, $otpCode->code)) {
            return back()->with('error', 'کد تایید نامعتبر است.');
        }

        // Mark OTP as used
        $otpCode->update(['used' => true]);

        // Check if user exists
        $existingUser = User::where('phone', $phone)->first();
        
        if ($existingUser) {
            // Update existing user's name
            $existingUser->update(['name' => $name]);
            $user = $existingUser;
        } else {
            // Create new user with provided name
            $user = User::create([
                'phone' => $phone,
                'name' => $name,
            ]);
        }

        // Login user
        Auth::login($user);

        return redirect()->intended(route('horoscope.index'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function checkUser($phone)
    {
        $user = User::where('phone', $phone)->first();
        return response()->json(['exists' => $user !== null]);
    }
} 