<?php

namespace App\Services;

use App\Models\Booking;

class BookingMessageService
{
    /**
     * Build message from booking snapshot.
     */
    public static function buildConfirmationMessage(Booking $booking, ?string $template = null): string
    {
        $defaultTemplate = "Halo {nama}, booking Anda di {nama_lapangan} ({jenis_olahraga}) pada {tanggal} jam {jam} sudah dikonfirmasi. Total: Rp {total}. Booking ID: {booking_id}.";
        $template = $template ?: $defaultTemplate;

        $customerName = $booking->user ? $booking->user->name : ($booking->guest_name ?? 'Pelanggan');
        $fieldName = $booking->field_name_snapshot ?? ($booking->field ? $booking->field->name : 'Lapangan');
        $sportName = $booking->sport_type_name_snapshot ?? 'Futsal';
        $date = \Carbon\Carbon::parse($booking->booking_date)->format('d F Y');
        $time = date('H:i', strtotime($booking->start_time)) . ' - ' . date('H:i', strtotime($booking->end_time));
        $total = number_format($booking->total_price, 0, ',', '.');

        $replacements = [
            '{nama}' => $customerName,
            '{nama_lapangan}' => $fieldName,
            '{jenis_olahraga}' => $sportName,
            '{tanggal}' => $date,
            '{jam}' => $time,
            '{total}' => $total,
            '{booking_id}' => '#' . $booking->id_booking,
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $template);
    }
}
