<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoroscopePurchase;
use Illuminate\Support\Facades\Auth;

class HoroscopeController extends Controller
{
    public function index()
    {
        return view('horoscope.index');
    }

    public function purchase(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'horoscope_type' => 'required|string'
        ]);

        $purchase = HoroscopePurchase::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'horoscope_type' => $request->horoscope_type,
            'status' => 'pending'
        ]);

        // Here you would typically integrate with a payment gateway
        // For now, we'll just mark it as completed
        $purchase->update(['status' => 'completed']);

        return redirect()->route('lottery.index')
            ->with('success', 'خرید فالنامه با موفقیت انجام شد و شما در قرعه‌کشی شرکت داده شدید!');
    }
}
