<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoroscopePurchase;
use App\Models\LotteryWinner;

class LotteryController extends Controller
{
    public function index()
    {
        $totalPrize = 1000000000; // 1 Billion Toman
        $participants = HoroscopePurchase::where('status', 'completed')->count();
        
        return view('lottery.index', compact('totalPrize', 'participants'));
    }

    public function winners()
    {
        $winners = LotteryWinner::with('user')->latest()->get();
        return view('lottery.winners', compact('winners'));
    }

    public function draw()
    {
        // This would typically be a scheduled task
        $eligiblePurchases = HoroscopePurchase::where('status', 'completed')
            ->where('is_winner', false)
            ->get();

        if ($eligiblePurchases->count() > 0) {
            $winner = $eligiblePurchases->random();
            
            LotteryWinner::create([
                'user_id' => $winner->user_id,
                'prize_amount' => 1000000000, // 1 Billion Toman
                'purchase_id' => $winner->id
            ]);

            $winner->update(['is_winner' => true]);
        }

        return redirect()->route('lottery.winners')
            ->with('success', 'برنده جدید قرعه‌کشی انتخاب شد!');
    }
} 