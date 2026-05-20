<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking - BOA Futsal</title>
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
        <div class="container mx-auto max-w-4xl">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-8 p-6 bg-green-500/10 border border-green-500/20 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-green-400 font-bold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Booking Status -->
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full 
                    @if($booking->status == 'pending') bg-yellow-500/10 border border-yellow-500/20 text-yellow-400
                    @elseif($booking->status == 'confirmed') bg-green-500/10 border border-green-500/20 text-green-400
                    @elseif($booking->status == 'completed') bg-blue-500/10 border border-blue-500/20 text-blue-400
                    @else bg-red-500/10 border border-red-500/20 text-red-400
                    @endif
                ">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full 
                            @if($booking->status == 'pending') bg-yellow-400
                            @elseif($booking->status == 'confirmed') bg-green-400
                            @elseif($booking->status == 'completed') bg-blue-400
                            @else bg-red-400
                            @endif opacity-75
                        "></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 
                            @if($booking->status == 'pending') bg-yellow-500
                            @elseif($booking->status == 'confirmed') bg-green-500
                            @elseif($booking->status == 'completed') bg-blue-500
                            @else bg-red-500
                            @endif
                        "></span>
                    </span>
                    <span class="font-bold uppercase text-xs tracking-wider">
                        @if($booking->status == 'pending') Menunggu Konfirmasi
                        @elseif($booking->status == 'confirmed') Dikonfirmasi
                        @elseif($booking->status == 'completed') Selesai
                        @else Dibatalkan
                        @endif
                    </span>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Booking Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Main Info -->
                    <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                        <h1 class="text-3xl font-extrabold mb-6">Detail Booking</h1>

                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-400 mb-1">Lapangan</p>
                                    <p class="text-xl font-bold">{{ $booking->field->name }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-400 mb-1">Tanggal & Waktu</p>
                                    <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</p>
                                    <p class="text-gray-400">{{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }} ({{ $booking->duration_hours }} jam)</p>
                                </div>
                            </div>

                            @if($booking->notes)
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-400 mb-1">Catatan</p>
                                    <p class="text-white">{{ $booking->notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-gradient-to-br from-green-500/10 to-green-600/5 border border-green-500/20 rounded-[2rem] p-8">
                        <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Informasi Pembayaran
                        </h2>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Harga per jam</span>
                                <span class="font-bold">Rp {{ number_format($booking->price_per_hour, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Durasi</span>
                                <span class="font-bold">{{ $booking->duration_hours }} jam</span>
                            </div>
                            @if($booking->is_member_price)
                            <div class="flex justify-between text-green-400">
                                <span>Diskon Member</span>
                                <span class="font-bold">✓ Aktif</span>
                            </div>
                            @endif
                            <div class="pt-3 border-t border-white/10 flex justify-between">
                                <span class="text-lg font-bold">Total</span>
                                <span class="text-2xl font-extrabold text-green-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-white/5 rounded-xl">
                            <p class="text-sm text-gray-400 mb-2">💳 Metode Pembayaran</p>
                            <p class="font-bold text-green-400">Bayar di Kasir</p>
                            <p class="text-xs text-gray-500 mt-1">Silakan lakukan pembayaran di kasir BOA Futsal sebelum waktu booking</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="lg:col-span-1">
                    <div class="sticky top-32 space-y-4">
                        <a href="{{ route('dashboard') }}" class="block w-full px-6 py-3 bg-green-500 text-black rounded-xl font-bold text-center hover:bg-green-400 transition-all">
                            Kembali ke Dashboard
                        </a>

                        <a href="{{ route('bookings.index') }}" class="block w-full px-6 py-3 bg-white/5 border border-white/10 text-white rounded-xl font-bold text-center hover:bg-white/10 transition-all">
                            Lihat Semua Booking
                        </a>

                        @if($booking->status == 'pending')
                        <div class="p-6 bg-yellow-500/10 border border-yellow-500/20 rounded-xl">
                            <p class="text-yellow-400 text-sm font-bold mb-2">⏳ Menunggu Konfirmasi</p>
                            <p class="text-xs text-gray-400">Booking kamu akan dikonfirmasi oleh admin setelah pembayaran di kasir</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
