<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - BOA Futsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black">

    <x-public-navbar simple="true" backUrl="/" backText="Homepage" />

    <!-- Main Content -->
    <div class="pt-24 md:pt-32 pb-12 md:pb-20 px-4 md:px-6">
        <div class="container mx-auto max-w-6xl">
            <div class="mb-6 md:mb-8">
                <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Riwayat Booking</h1>
                <p class="text-gray-400 text-sm md:text-base">Semua booking yang pernah kamu buat</p>
            </div>

            @if($bookings->isEmpty())
                <div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-8 md:p-12 text-center">
                    <svg class="w-12 h-12 md:w-16 md:h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-lg md:text-xl font-bold mb-2">Belum ada booking</h3>
                    <p class="text-gray-400 mb-6 text-sm md:text-base">Yuk booking lapangan sekarang!</p>
                    <a href="/" class="inline-block px-6 py-3 bg-green-500 text-black rounded-xl font-bold hover:bg-green-400 transition-all text-sm md:text-base">
                        Booking Sekarang
                    </a>
                </div>
            @else
                <div class="space-y-3 md:space-y-4">
                    @foreach($bookings as $booking)
                    <a href="{{ route('bookings.show', $booking->id_booking) }}" class="block bg-white/5 border border-white/10 rounded-xl md:rounded-[2rem] p-4 md:p-6 hover:border-green-500/30 transition-all">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 md:gap-6">
                            <div class="flex items-center gap-4 md:gap-6 flex-1 w-full">
                                <!-- Field Image -->
                                <div class="w-16 h-16 md:w-24 md:h-24 rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ asset($booking->field->image) }}" class="w-full h-full object-cover">
                                </div>

                                <!-- Booking Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg md:text-xl font-bold mb-1 truncate">{{ $booking->field->name }}</h3>
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-xs md:text-sm text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}
                                        </span>
                                    </div>
                                    <p class="text-green-400 font-bold mt-2 text-sm md:text-base">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex-shrink-0 w-full sm:w-auto">
                                <span class="inline-flex items-center justify-center gap-2 px-3 md:px-4 py-1.5 md:py-2 rounded-full text-xs font-bold uppercase w-full sm:w-auto
                                    @if($booking->status == 'pending') bg-yellow-500/10 border border-yellow-500/20 text-yellow-400
                                    @elseif($booking->status == 'confirmed') bg-green-500/10 border border-green-500/20 text-green-400
                                    @elseif($booking->status == 'completed') bg-blue-500/10 border border-blue-500/20 text-blue-400
                                    @else bg-red-500/10 border border-red-500/20 text-red-400
                                    @endif
                                ">
                                    @if($booking->status == 'pending') Pending
                                    @elseif($booking->status == 'confirmed') Confirmed
                                    @elseif($booking->status == 'completed') Completed
                                    @else Cancelled
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</body>
</html>
