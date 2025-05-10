<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryWinner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prize_amount',
        'purchase_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchase()
    {
        return $this->belongsTo(HoroscopePurchase::class, 'purchase_id');
    }
} 