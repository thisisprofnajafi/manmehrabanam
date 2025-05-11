<?php

namespace App\Providers;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;
use App\Notifications\Channels\GhasedakChannel;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->make(ChannelManager::class)->extend('ghasedak', function ($app) {
            return new GhasedakChannel();
        });
    }
} 