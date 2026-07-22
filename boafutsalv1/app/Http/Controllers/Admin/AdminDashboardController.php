<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Field;
use App\Models\Payment;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
            'pending_revenue' => Booking::where('status', 'pending')->sum('total_price'),
            'unread_messages' => ContactMessage::where('status', 'unread')->where('type', 'collab')->count(),
        ];

        $recentBookings = Booking::with(['user', 'field'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $recentMessages = ContactMessage::where('type', 'collab')->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentMessages'));
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'field', 'payment'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(20);

        return view('admin.bookings', compact('bookings'));
    }

    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking berhasil dikonfirmasi');
    }

    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking berhasil dibatalkan');
    }

    public function finishBooking($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Update status to completed
        // Don't change end_time - keep original booking time
        $booking->update([
            'status' => 'completed'
        ]);

        return back()->with('success', 'Booking berhasil diselesaikan');
    }

    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Delete related payment if exists
        if ($booking->payment) {
            $booking->payment->delete();
        }
        
        $booking->delete();

        return back()->with('success', 'Booking berhasil dihapus');
    }

    public function messages()
    {
        $messages = ContactMessage::where('type', 'collab')->orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = ContactMessage::where('type', 'collab')->where('status', 'unread')->count();
        return view('admin.messages', compact('messages', 'unreadCount'));
    }

    public function comments()
    {
        $messages = ContactMessage::where('type', 'general')->orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = ContactMessage::where('type', 'general')->where('status', 'unread')->count();
        return view('admin.comments', compact('messages', 'unreadCount'));
    }

    public function markRead($id)
    {
        ContactMessage::findOrFail($id)->update(['status' => 'read']);
        return back()->with('success', 'Pesan ditandai sudah dibaca');
    }

    public function deleteMessage($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return back()->with('success', 'Pesan berhasil dihapus');
    }
}
