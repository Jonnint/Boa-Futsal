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
    
    // Booking routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{field}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/api/field-schedule/{field}/{date}', [BookingController::class, 'getFieldSchedule'])->name('bookings.schedule');
});

// Public API for field status (no auth required)
Route::get('/api/field-status', [BookingController::class, 'getCurrentFieldStatus'])->name('field.status');

// Public contact form (auth required for collab, guest allowed for general)
Route::post('/contact', [ContactController::class, 'store'])->middleware('auth')->name('contact.store');
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
});

require __DIR__.'/auth.php';
