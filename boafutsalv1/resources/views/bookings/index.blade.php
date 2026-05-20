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

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 py-6 bg-black/20 backdrop-blur-lg border-b border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between">
                <a href="/" class="text-2xl font-extrabold tracking-tighter text-green-400">
                    BOA<span class="text-white">FUTSAL</span>
                </a>
                
                <div class="flex items-center gap-4">
                    <a href="/" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Homepage</a>
                    <span class="text-gray-600">|</span>
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-32 pb-20 px-6">
        <div class="container mx-auto max-w-6xl">
            <div class="mb-8">
                <h1 class="text-4xl font-extrabold mb-2">Riwayat Booking</h1>
                <p class="text-gray-400">Semua booking yang pernah kamu buat</p>
            </div>

            @if($bookings->isEmpty())
                <div class="bg-white/5 border border-white/10 rounded-[2rem] p-12 text-center">
                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-xl font-bold mb-2">Belum ada booking</h3>
                    <p class="text-gray-400 mb-6">Yuk booking lapangan sekarang!</p>
                    <a href="/" class="inline-block px-6 py-3 bg-green-500 text-black rounded-xl font-bold hover:bg-green-400 transition-all">
                        Booking Sekarang
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($bookings as $booking)
                    <a href="{{ route('bookings.show', $booking->id_booking) }}" class="block bg-white/5 border border-white/10 rounded-[2rem] p-6 hover:border-green-500/30 transition-all">
                        <div class="flex items-center justify-between gap-6">
                            <div class="flex items-center gap-6 flex-1">
                                <!-- Field Image -->
                                <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ asset($booking->field->image) }}" class="w-full h-full object-cover">
                                </div>

                                <!-- Booking Info -->
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold mb-1">{{ $booking->field->name }}</h3>
                                    <div class="flex items-center gap-4 text-sm text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}
                                        </span>
                                    </div>
                                    <p class="text-green-400 font-bold mt-2">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold uppercase
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
