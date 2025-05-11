<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GhasedakChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toGhasedak')) {
            return $notification->toGhasedak($notifiable);
        }
        return false;
    }
} 