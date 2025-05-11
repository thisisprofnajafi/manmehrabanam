<?php

namespace App\Notifications;

use Carbon\Carbon;
use Ghasedak\DataTransferObjects\Request\InputDTO;
use Ghasedak\DataTransferObjects\Request\ReceptorDTO;
use Ghasedaksms\GhasedaksmsLaravel\Message\GhasedaksmsVerifyLookUp;
use Ghasedaksms\GhasedaksmsLaravel\Notification\GhasedaksmsBaseNotification;
use Illuminate\Bus\Queueable;

class SendOtpToUser extends GhasedaksmsBaseNotification
{
    use Queueable;

    protected $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function toGhasedaksms($notifiable): GhasedaksmsVerifyLookUp
    {
        $message = new GhasedaksmsVerifyLookUp();
        $message->setSendDate(Carbon::now());
        $message->setReceptors([new ReceptorDTO($notifiable->phone, uniqid())]);
        $message->setTemplateName('newOTP');
        $message->setInputs([new InputDTO('code', $this->otp)]);
        return $message;
    }
} 