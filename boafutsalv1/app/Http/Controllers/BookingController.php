<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Booking;
use App\Models\FieldPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create($fieldId)
    {
        $field = Field::with('prices')->findOrFail($fieldId);
        
        return view('bookings.create', compact('field'));
    }

    public function store(Request $request)
    {
        // Determine if user is logged in
        $isLoggedIn = Auth::check();
        
        // Validation rules
        $rules = [
            'field_id' => 'required|exists:fields,id_field',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'duration_hours' => 'required|integer|min:1|max:8',
        ];
        
        // Add guest information validation if user is not logged in
        if (!$isLoggedIn) {
            $rules['guest_name'] = 'required|string|max:255';
            $rules['guest_email'] = 'required|email|max:255';
            $rules['guest_phone'] = 'required|string|max:20';
        }
        
        $request->validate($rules);

        $field = Field::findOrFail($request->field_id);
        $bookingDate = Carbon::parse($request->booking_date);
        $startTime = Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = $startTime->copy()->addHours((int)$request->duration_hours);

        $isBooked = Booking::where('field_id', $request->field_id)
            ->where('booking_date', $bookingDate->format('Y-m-d'))
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime->format('H:i'), $endTime->format('H:i')])
                      ->orWhereBetween('end_time', [$startTime->format('H:i'), $endTime->format('H:i')])
                      ->orWhere(function($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime->format('H:i'))
                            ->where('end_time', '>=', $endTime->format('H:i'));
                      });
            })
            ->exists();

        if ($isBooked) {
            return back()->with('error', 'Jadwal sudah dibooking. Pilih waktu lain.');
        }

        $dayType = in_array($bookingDate->dayOfWeek, [0, 6]) ? 'weekend' : 'weekday';

        $startTimeStr = $startTime->format('H:i');
        $price = FieldPrice::where('field_id', $request->field_id)
            ->where('day_type', $dayType)
            ->where(function($query) use ($startTimeStr) {
                $query->where(function($q) use ($startTimeStr) {
                    $q->where('start_time', '<=', $startTimeStr)
                      ->where('end_time', '>', $startTimeStr)
                      ->where('end_time', '!=', '00:00');
                })->orWhere(function($q) use ($startTimeStr) {
                    $q->where('start_time', '<=', $startTimeStr)
                      ->where('end_time', '=', '00:00');
                });
            })
            ->first();

        if (!$price) {
            return back()->withInput()->with('error', 'Harga tidak ditemukan untuk waktu yang dipilih.');
        }

        // Calculate total price - only members get discount
        $isMember = $isLoggedIn && Auth::user()->is_member;
        $pricePerHour = $isMember ? $price->price_member : $price->price_regular;
        $totalPrice = $pricePerHour * $request->duration_hours;

        // Prepare booking data
        $bookingData = [
            'field_id' => $request->field_id,
            'booking_date' => $bookingDate->format('Y-m-d'),
            'start_time' => $startTime->format('H:i'),
            'end_time' => $endTime->format('H:i'),
            'duration_hours' => $request->duration_hours,
            'price_per_hour' => $pricePerHour,
            'total_price' => $totalPrice,
            'is_member_price' => $isMember,
            'status' => 'pending',
            'notes' => $request->notes,
        ];
        
        // Add user_id or guest information
        if ($isLoggedIn) {
            $bookingData['user_id'] = Auth::id();
            $bookingData['booking_type'] = 'member';
        } else {
            $bookingData['guest_name'] = $request->guest_name;
            $bookingData['guest_email'] = $request->guest_email;
            $bookingData['guest_phone'] = $request->guest_phone;
            $bookingData['booking_type'] = 'guest';
        }

        // Create booking
        $booking = Booking::create($bookingData);

        // Different flow for guest vs member
        if (!$isLoggedIn) {
            // Guest booking - redirect to WhatsApp for payment confirmation
            $whatsappNumber = env('WHATSAPP_NUMBER', '6281234567890');
            $bookingDetails = "Halo, saya ingin konfirmasi booking:\n\n" .
                "Nama: {$booking->guest_name}\n" .
                "Email: {$booking->guest_email}\n" .
                "Telepon: {$booking->guest_phone}\n" .
                "Lapangan: {$field->name}\n" .
                "Tanggal: " . \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') . "\n" .
                "Waktu: " . date('H:i', strtotime($booking->start_time)) . " - " . date('H:i', strtotime($booking->end_time)) . "\n" .
                "Durasi: {$booking->duration_hours} jam\n" .
                "Total: Rp " . number_format($booking->total_price, 0, ',', '.') . "\n" .
                "Booking ID: #{$booking->id_booking}";
            
            $whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($bookingDetails);
            
            return redirect()->away($whatsappUrl);
        } else {
            // Member booking - redirect to booking detail page
            return redirect()->route('bookings.show', $booking->id_booking)
                ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
        }
    }

    public function show($id)
    {
        $booking = Booking::with(['field', 'payment'])->findOrFail($id);
        
        // Check if user owns this booking (for logged in users) or allow guest access
        if ($booking->user_id && Auth::check() && $booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('bookings.show', compact('booking'));
    }

    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with(['field', 'payment'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function getFieldSchedule($fieldId, $date)
    {
        $bookings = Booking::where('field_id', $fieldId)
            ->where('booking_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('start_time')
            ->get(['start_time', 'end_time', 'status']);

        return response()->json($bookings);
    }

    public function getCurrentFieldStatus()
    {
        $now = now();
        $currentDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');

        $fields = Field::where('is_active', true)->get();
        $fieldStatuses = [];

        foreach ($fields as $field) {
            // Only check confirmed bookings (not completed or cancelled)
            // Use DATE() to compare only the date part
            $currentBooking = Booking::where('field_id', $field->id)
                ->whereRaw("DATE(booking_date) = ?", [$currentDate])
                ->where('status', 'confirmed')
                ->whereRaw("TIME(start_time) <= ?", [$currentTime])
                ->whereRaw("TIME(end_time) > ?", [$currentTime])
                ->first();

            // Next booking can be pending or confirmed (not completed or cancelled)
            $nextBooking = Booking::where('field_id', $field->id)
                ->whereRaw("DATE(booking_date) = ?", [$currentDate])
                ->whereIn('status', ['pending', 'confirmed'])
                ->whereRaw("TIME(start_time) > ?", [$currentTime])
                ->orderBy('start_time')
                ->first();

            $fieldStatuses[] = [
                'field_id' => $field->id_field,
                'field_name' => $field->name,
                'is_occupied' => $currentBooking ? true : false,
                'current_booking' => $currentBooking ? [
                    'user_name' => $currentBooking->user_id 
                        ? $currentBooking->user->name 
                        : $currentBooking->guest_name,
                    'start_time' => date('H:i', strtotime($currentBooking->start_time)),
                    'end_time' => date('H:i', strtotime($currentBooking->end_time)),
                    'remaining_minutes' => $this->calculateRemainingMinutes($currentBooking->end_time, $currentTime),
                ] : null,
                'next_booking' => $nextBooking ? [
                    'start_time' => date('H:i', strtotime($nextBooking->start_time)),
                    'end_time' => date('H:i', strtotime($nextBooking->end_time)),
                ] : null,
            ];
        }

        return response()->json($fieldStatuses);
    }

    private function calculateRemainingMinutes($endTime, $currentTime)
    {
        // Parse times - handle both TIME and DATETIME formats
        try {
            $end = \Carbon\Carbon::parse($endTime);
            $current = \Carbon\Carbon::parse($currentTime);
        } catch (\Exception $e) {
            return 0;
        }
        
        // Return remaining minutes (end - current)
        $remaining = $current->diffInMinutes($end, false);
        return $remaining > 0 ? $remaining : 0;
    }
}
