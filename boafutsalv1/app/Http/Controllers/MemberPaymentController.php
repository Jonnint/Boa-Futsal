<?php

namespace App\Http\Controllers;

use App\Models\MembershipPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberPaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:BCA,Mandiri,GoPay',
            'membership_tier' => 'required|in:regular,vip,vvip',
        ]);

        $user = Auth::user();
        
        $prices = [
            'regular' => 150000,
            'vip' => 250000,
            'vvip' => 500000,
        ];
        
        $amount = $prices[$request->membership_tier];
        
        $payment = MembershipPayment::create([
            'user_id' => $user->id_user,
            'payment_method' => $request->payment_method,
            'membership_tier' => $request->membership_tier,
            'amount' => $amount,
            'status' => 'pending',
            'transaction_id' => 'TRX-' . time() . '-' . $user->id_user,
        ]);

        return redirect()->route('payment.member.success', $payment->id)
            ->with('success', 'Pembayaran membership sedang diproses');
    }

    public function success($id)
    {
        $payment = MembershipPayment::with('user')->findOrFail($id);
        return view('payment.member-success', compact('payment'));
    }

    public function approve($id)
    {
        $payment = MembershipPayment::findOrFail($id);
        
        // Update payment status
        $payment->update([
            'status' => 'paid',
            'payment_date' => now(),
            'expired_at' => now()->addYear(),
        ]);

        // Activate membership with tier
        $payment->user->update([
            'is_member' => true,
            'membership_tier' => $payment->membership_tier,
            'membership_expired_at' => now()->addYear(),
        ]);

        // TODO: Send email notification to user

        return back()->with('success', 'Membership ' . $payment->user->name . ' (' . strtoupper($payment->membership_tier) . ') berhasil diaktifkan!');
    }
}
