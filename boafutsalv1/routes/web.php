<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Field;

Route::get('/', function () {
    $fields = Field::with('prices')->where('is_active', true)->get();
    return view('home', compact('fields'));
});

Route::get('/sejarah', function () {
    return view('sejarah');
})->name('sejarah.index');

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Redirect admin to admin dashboard
    if ($user->isAdmin()) {
        return redirect('/admin/dashboard');
    }
    
    // Check if user is member, if not redirect to payment
    if (!$user->is_member) {
        // Check if already has pending payment
        $pendingPayment = \App\Models\MembershipPayment::where('user_id', $user->id_user)
            ->where('status', 'pending')
            ->first();
            
        if ($pendingPayment) {
            return redirect()->route('payment.member.success', $pendingPayment->id)
                ->with('info', 'Menunggu konfirmasi pembayaran dari admin');
        }
        
        return redirect()->route('payment.member')
            ->with('info', 'Silakan selesaikan pembayaran membership untuk akses dashboard');
    }
    
    $bookings = $user->bookings()->with(['field', 'payment'])->get();
    
    $stats = [
        'total_bookings' => $bookings->count(),
        'active_bookings' => $bookings->whereIn('status', ['pending', 'confirmed'])->count(),
        'total_spent' => $bookings->whereIn('status', ['confirmed', 'completed'])->sum('total_price'),
    ];
    
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Booking routes - index requires auth to view user's bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    
    // User sidebar routes
    Route::get('/user/membership', function () {
        return view('user.membership');
    })->name('user.membership');

    Route::get('/user/diskon', function () {
        return view('user.diskon');
    })->name('user.diskon');

    Route::get('/user/voucher', function () {
        return view('user.voucher');
    })->name('user.voucher');
    
    // Member payment
    Route::get('/payment/member', function () {
        return view('payment.member');
    })->name('payment.member');
    Route::post('/payment/member/process', [\App\Http\Controllers\MemberPaymentController::class, 'store'])->name('payment.member.process');
    Route::get('/payment/member/success/{id}', [\App\Http\Controllers\MemberPaymentController::class, 'success'])->name('payment.member.success');
    
    // Notifications
    Route::get('/api/notifications', [\App\Http\Controllers\MemberNotificationController::class, 'index'])->name('notifications.index');
    Route::get('/api/notifications/unread-count', [\App\Http\Controllers\MemberNotificationController::class, 'unreadCount'])->name('notifications.unread');
    Route::post('/api/notifications/{id}/read', [\App\Http\Controllers\MemberNotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/api/notifications/read-all', [\App\Http\Controllers\MemberNotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
});

// Public booking routes - anyone can create bookings
Route::get('/bookings/create/{field}', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
Route::get('/api/field-schedule/{field}/{date}', [BookingController::class, 'getFieldSchedule'])->name('bookings.schedule');

// Voucher validation (public API)
Route::post('/api/voucher/validate', [\App\Http\Controllers\VoucherController::class, 'validate'])->name('voucher.validate');

// Fonnte Webhook API
Route::post('/webhook/fonnte', [\App\Http\Controllers\Admin\ChatbotController::class, 'handleWebhook'])->name('webhook.fonnte');

// Public API for field status (no auth required)
Route::get('/api/field-status', [BookingController::class, 'getCurrentFieldStatus'])->name('field.status');

// Public contact form (auth not required)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/api/public-comments', [ContactController::class, 'publicComments'])->name('contact.public');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/bookings', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'bookings'])->name('admin.bookings');
    Route::post('/bookings/{id}/confirm', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'confirmBooking'])->name('admin.bookings.confirm');
    Route::post('/bookings/{id}/cancel', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'cancelBooking'])->name('admin.bookings.cancel');
    Route::post('/bookings/{id}/finish', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'finishBooking'])->name('admin.bookings.finish');
    Route::delete('/bookings/{id}/delete', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'deleteBooking'])->name('admin.bookings.delete');
    
    // User management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // Contact messages
    Route::get('/messages', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'messages'])->name('admin.messages');
    Route::post('/messages/{id}/read', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'markRead'])->name('admin.messages.read');
    Route::delete('/messages/{id}', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'deleteMessage'])->name('admin.messages.delete');
    
    // Comments filtering
    Route::get('/comments', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'comments'])->name('admin.comments');
    Route::post('/comments/{id}/read', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'markRead'])->name('admin.comments.read');
    Route::delete('/comments/{id}', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'deleteMessage'])->name('admin.comments.delete');
    
    // Vouchers
    Route::resource('vouchers', \App\Http\Controllers\Admin\VoucherController::class)->names([
        'index' => 'admin.vouchers.index',
        'create' => 'admin.vouchers.create',
        'store' => 'admin.vouchers.store',
        'edit' => 'admin.vouchers.edit',
        'update' => 'admin.vouchers.update',
        'destroy' => 'admin.vouchers.destroy',
    ]);
    Route::post('/vouchers/{voucher}/toggle', [\App\Http\Controllers\Admin\VoucherController::class, 'toggle'])->name('admin.vouchers.toggle');
    
    // Notifications
    Route::resource('notifications', \App\Http\Controllers\Admin\NotificationController::class)->only(['index', 'create', 'store', 'destroy'])->names([
        'index' => 'admin.notifications.index',
        'create' => 'admin.notifications.create',
        'store' => 'admin.notifications.store',
        'destroy' => 'admin.notifications.destroy',
    ]);
    
    // Membership payments
    Route::get('/membership-payments', function() {
        $payments = \App\Models\MembershipPayment::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.membership-payments', compact('payments'));
    })->name('admin.membership.payments');
    Route::post('/membership-payments/{id}/approve', [\App\Http\Controllers\MemberPaymentController::class, 'approve'])->name('admin.membership.approve');
    Route::post('/membership-payments/{id}/reject', [\App\Http\Controllers\MemberPaymentController::class, 'reject'])->name('admin.membership.reject');

    // Chatbot settings management
    Route::get('/chatbot', [\App\Http\Controllers\Admin\ChatbotController::class, 'index'])->name('admin.chatbot');
    Route::post('/chatbot/update', [\App\Http\Controllers\Admin\ChatbotController::class, 'update'])->name('admin.chatbot.update');
});

require __DIR__.'/auth.php';
