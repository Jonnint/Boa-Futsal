<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function validate(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'booking_amount' => 'required|numeric',
            'booking_date' => 'required|date',
        ]);

        $voucher = Voucher::where('code', strtoupper($request->code))->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Kode voucher tidak ditemukan'
            ], 404);
        }

        $user = Auth::user();
        
        if ($voucher->is_member_only && (!$user || !$user->is_member)) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher ini khusus untuk member'
            ], 403);
        }

        if (!$voucher->canBeUsedBy($user?->id_user, $request->booking_amount, $request->booking_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher tidak dapat digunakan untuk booking ini'
            ], 400);
        }

        $discount = $voucher->calculateDiscount($request->booking_amount);
        $newTotal = $request->booking_amount - $discount;

        return response()->json([
            'success' => true,
            'message' => 'Voucher berhasil diterapkan!',
            'voucher' => [
                'id' => $voucher->id,
                'code' => $voucher->code,
                'name' => $voucher->name,
                'type' => $voucher->type,
                'discount_value' => $voucher->discount_value,
            ],
            'discount_amount' => $discount,
            'original_amount' => $request->booking_amount,
            'new_total' => $newTotal,
        ]);
    }
}
