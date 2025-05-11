<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SendOtpToUser extends Notification
{
    use Queueable;

    protected $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['ghasedak'];
    }

    public function toGhasedak($notifiable)
    {
        try {
            $curl = curl_init();

            $clientReferenceId = uniqid();
            
            $data = [
                'sendDate' => Carbon::now()->toIso8601String(),
                'receptors' => [
                    [
                        'mobile' => $notifiable->phone,
                        'clientReferenceId' => $clientReferenceId
                    ]
                ],
                'templateName' => 'newOTP',
                'inputs' => [
                    [
                        'param' => 'code',
                        'value' => $this->otp
                    ]
                ],
                'udh' => false,
                'isVoice' => false
            ];

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://gateway.ghasedak.me/rest/api/v1/WebService/SendOtpSMS',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'ApiKey: ' . config('services.ghasedak.api_key')
                ],
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $error = curl_error($curl);
            
            curl_close($curl);

            if ($error) {
                Log::error('SMS cURL error', [
                    'phone' => $notifiable->phone,
                    'error' => $error
                ]);
                return false;
            }

            $responseData = json_decode($response, true);

            if ($httpCode === 200 && isset($responseData['isSuccess']) && $responseData['isSuccess'] === true) {
                Log::info('SMS sent successfully', [
                    'phone' => $notifiable->phone,
                    'response' => $responseData,
                    'messageId' => $responseData['data']['items'][0]['messageId'] ?? null
                ]);
                return true;
            }

            Log::error('Failed to send SMS', [
                'phone' => $notifiable->phone,
                'response' => $responseData,
                'httpCode' => $httpCode,
                'message' => $responseData['message'] ?? 'Unknown error'
            ]);
            return false;
        } catch (\Exception $e) {
            Log::error('SMS service error', [
                'phone' => $notifiable->phone,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
} 