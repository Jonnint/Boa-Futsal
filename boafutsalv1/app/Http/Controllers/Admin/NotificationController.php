<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberNotification;
use App\Models\Voucher;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = MemberNotification::with(['user', 'voucher'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        $vouchers = Voucher::where('is_active', true)->get();
        return view('admin.notifications.create', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'message' => 'required',
            'type' => 'required|in:promo,info,warning',
            'broadcast_type' => 'required|in:all,specific',
            'user_id' => 'required_if:broadcast_type,specific',
        ]);

        $userId = $request->broadcast_type === 'all' ? null : $request->user_id;

        MemberNotification::create([
            'user_id' => $userId,
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'voucher_id' => $request->voucher_id,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notifikasi berhasil dikirim');
    }

    public function destroy(MemberNotification $notification)
    {
        $notification->delete();
        return back()->with('success', 'Notifikasi berhasil dihapus');
    }
}
