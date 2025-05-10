<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $fillable = [
        'phone',
        'code',
        'expires_at',
        'used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean'
    ];

    protected $table = 'otp_codes';

    public function isValid()
    {
        return !$this->used && $this->expires_at->isFuture();
    }
} 