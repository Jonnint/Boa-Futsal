<?php

namespace App\Http\Controllers;

use App\Models\MembershipPayment;
use App\Models\MemberNotification;
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
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        
        $prices = [
            'regular' => 150000,
            'vip' => 250000,
            'vvip' => 500000,
        ];
        
        $amount = $prices[$request->membership_tier];
        
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $payment = MembershipPayment::create([
            'user_id' => $user->id_user,
            'payment_method' => $request->payment_method,
            'membership_tier' => $request->membership_tier,
            'amount' => $amount,
            'status' => 'pending',
            'payment_proof' => $paymentProofPath,
            'transaction_id' => 'TRX-' . time() . '-' . $user->id_user,
        ]);

        $settings = \App\Models\ChatbotSetting::getSettings();
        
        // Determine greeting based on Indonesian time (WIB - Asia/Jakarta)
        $hour = now()->timezone('Asia/Jakarta')->hour;
        if ($hour >= 4 && $hour < 11) {
            $greeting = 'Pagi';
        } elseif ($hour >= 11 && $hour < 15) {
            $greeting = 'Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Sore';
        } else {
            $greeting = 'Malam';
        }

        $messageText = str_replace('{greeting}', $greeting, $settings->user_message_template);
        $waNumber = $settings->wa_number;

        // Clean WA number (keep only digits)
        $waNumberClean = preg_replace('/[^0-9]/', '', $waNumber);

        $whatsappUrl = "https://wa.me/{$waNumberClean}?text=" . urlencode($messageText);

        return redirect()->away($whatsappUrl);
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

        // Notify user that payment is approved
        MemberNotification::create([
            'user_id' => $payment->user_id,
            'title' => 'Pembayaran Membership Berhasil',
            'message' => 'Selamat! Pembayaran membership Anda (' . $payment->transaction_id . ') telah disetujui. Membership ' . strtoupper($payment->membership_tier) . ' Anda aktif hingga ' . $payment->expired_at->format('d M Y') . '.',
            'type' => 'info',
        ]);

        return back()->with('success', 'Membership ' . $payment->user->name . ' (' . strtoupper($payment->membership_tier) . ') berhasil diaktifkan!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $payment = MembershipPayment::with('user')->findOrFail($id);

        if ($payment->status !== 'pending') {
            return back()->with('success', 'Pembayaran ini sudah diproses sebelumnya.');
        }

        $reason = trim((string) $request->input('reason'));
        if ($reason === '') {
            $reason = 'Bukti pembayaran tidak valid atau tidak sesuai. Silakan upload ulang bukti pembayaran yang benar.';
        }

        $payment->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
        ]);

        // Notify user that payment failed / wrong payment proof
        MemberNotification::create([
            'user_id' => $payment->user_id,
            'title' => 'Pembayaran Membership Gagal',
            'message' => 'Pembayaran membership Anda (' . $payment->transaction_id . ') tidak dapat disetujui. Alasan: ' . $reason . ' Silakan lakukan pembayaran ulang dengan bukti transfer yang benar melalui halaman Pembayaran Member.',
            'type' => 'warning',
        ]);

        return back()->with('success', 'Pembayaran ' . $payment->user->name . ' ditolak dan notifikasi telah dikirim ke user.');
    }
}
