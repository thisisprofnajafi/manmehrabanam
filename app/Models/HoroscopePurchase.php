<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoroscopePurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'horoscope_type',
        'status',
        'is_winner'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lotteryWinner()
    {
        return $this->hasOne(LotteryWinner::class, 'purchase_id');
    }
} 