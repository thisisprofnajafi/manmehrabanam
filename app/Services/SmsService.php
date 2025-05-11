<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.ghasedak.me/v2';

    public function __construct()
    {
        $this->apiKey = config('services.ghasedak.api_key');
    }

    public function sendOtp($phone, $otp)
    {
        try {
            $response = Http::withHeaders([
                'apikey' => $this->apiKey,
            ])->post($this->baseUrl . '/verification/send/simple', [
                'receptor' => $phone,
                'template' => 'otp',
                'type' => '1',
                'param1' => $otp,
            ]);

            if ($response->successful()) {
                Log::info('SMS sent successfully', [
                    'phone' => $phone,
                    'response' => $response->json()
                ]);
                return true;
            }

            Log::error('Failed to send SMS', [
                'phone' => $phone,
                'response' => $response->json()
            ]);
            return false;
        } catch (\Exception $e) {
            Log::error('SMS service error', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
} 