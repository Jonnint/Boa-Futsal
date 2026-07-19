<?php

namespace App\Http\Controllers;

use App\Models\MemberNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberNotificationController extends Controller
{
    public function index()
    {
        $notifications = MemberNotification::where(function($query) {
                $query->where('user_id', Auth::id())
                      ->orWhereNull('user_id');
            })
            ->active()
            ->with('voucher')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    public function unreadCount()
    {
        $count = MemberNotification::where(function($query) {
                $query->where('user_id', Auth::id())
                      ->orWhereNull('user_id');
            })
            ->active()
            ->unread()
            ->count();

        return response()->json(['count' => $count]);
    }

    public function markAsRead($id)
    {
        $notification = MemberNotification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        MemberNotification::where('user_id', Auth::id())
            ->orWhereNull('user_id')
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
