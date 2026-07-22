<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking {{ $field->name }} - BOA Futsal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        /* Dark calendar picker */
        input[type="date"] {
            color-scheme: dark;
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1) brightness(0.8);
            cursor: pointer;
        }

        /* Native select dark fallback (Firefox / non-Chromium) */
        select {
            color-scheme: dark;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234ade80' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
        select option {
            background-color: #121212;
            color: #ffffff;
        }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black relative overflow-x-hidden min-h-screen flex flex-col">

    <!-- Background Orbs -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-green-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>
    <div class="absolute bottom-1/4 right-0 w-[500px] h-[500px] bg-green-900/20 rounded-full blur-[150px] pointer-events-none z-0"></div>

    <x-public-navbar simple="true" backUrl="/#fields" backText="Kembali ke Daftar Lapangan" />

    @php
    if (!function_exists('getSessionName')) {
        function getSessionName($timeString) {
            $hour = (int) substr($timeString, 0, 2);
            if ($hour < 12) return 'Sesi Pagi';
            if ($hour < 15) return 'Sesi Siang';
            if ($hour < 18) return 'Sesi Sore';
            return 'Sesi Malam';
        }
    }
    @endphp

    <!-- Main Content -->
    <div class="pt-28 md:pt-36 pb-16 md:pb-24 px-4 md:px-6 relative z-10 flex-grow">
        <div class="container mx-auto max-w-[1100px]">
            
            <div class="mb-8">
                <a href="/#fields" class="inline-flex items-center gap-2 text-gray-400 hover:text-green-400 transition-colors text-sm font-bold bg-white/5 border border-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-10">
                <!-- Left Panel: Field Info & Price -->
                <div class="lg:col-span-5">
                    <div class="lg:sticky lg:top-32 space-y-6">
                        
                        <!-- Field Card -->
                        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] overflow-hidden shadow-2xl group">
                            <div class="relative h-64 md:h-72 overflow-hidden">
                                <img src="{{ asset($field->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-transparent"></div>
                                <div class="absolute bottom-5 left-5 right-5">
                                    <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-1">{{ $field->name }}</h2>
                                    <div class="flex items-center gap-2 text-xs md:text-sm font-bold text-green-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $field->surface_type }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-400 text-sm leading-relaxed font-medium">{{ $field->description }}</p>
                            </div>
                        </div>

                        <!-- Price Info Card -->
                        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] p-6 shadow-2xl">
                            <h3 class="font-extrabold mb-5 flex items-center gap-2 text-lg text-white">
                                <div class="w-8 h-8 bg-green-500/10 border border-green-500/20 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                Rincian Harga
                            </h3>
                            
                            <div class="space-y-6">
                                @foreach($field->prices->groupBy('day_type') as $dayType => $prices)
                                    <div>
                                        <div class="flex items-center gap-2 mb-3">
                                            @if($dayType == 'weekday')
                                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <p class="text-green-400 font-extrabold text-sm uppercase tracking-widest">Senin - Jumat</p>
                                            @else
                                                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                                <p class="text-yellow-400 font-extrabold text-sm uppercase tracking-widest">Sabtu - Minggu</p>
                                            @endif
                                        </div>
                                        <div class="space-y-2.5">
                                            @foreach($prices as $price)
                                                <div class="flex items-center justify-between p-3.5 bg-black/40 rounded-xl border border-white/10 hover:border-{{ $dayType == 'weekday' ? 'green' : 'yellow' }}-500/50 hover:bg-{{ $dayType == 'weekday' ? 'green' : 'yellow' }}-500/5 transition-all group">
                                                    <div class="flex flex-col">
                                                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-0.5">{{ getSessionName($price->start_time) }}</span>
                                                        <span class="text-sm font-medium text-gray-200">{{ date('H:i', strtotime($price->start_time)) }} - {{ date('H:i', strtotime($price->end_time)) }} WIB</span>
                                                    </div>
                                                    <div class="flex items-baseline gap-1.5">
                                                        <span class="text-base font-extrabold text-white group-hover:text-{{ $dayType == 'weekday' ? 'green' : 'yellow' }}-400 transition-colors">Rp {{ number_format($price->price_regular, 0, ',', '.') }}</span>
                                                        <span class="text-xs font-medium text-gray-500">/ Jam</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if(auth()->check() && auth()->user()->is_member)
                                <div class="mt-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-green-400 text-sm font-extrabold">Status Member Aktif</p>
                                            <p class="text-xs text-gray-400 font-medium">Anda berhak mendapat diskon!</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Panel: Booking Form -->
                <div class="lg:col-span-7">
                    <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] p-6 md:p-10 shadow-2xl relative">
                        <div class="mb-8">
                            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">Form <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-600">Booking</span></h1>
                            <p class="text-gray-400 font-medium">Lengkapi detail di bawah ini untuk mengamankan slot lapanganmu.</p>
                        </div>

                        @if(session('error'))
                            <div class="mb-8 p-4 bg-red-500/10 border border-red-500/20 rounded-xl flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-red-400 text-sm font-medium">{{ session('error') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="field_id" value="{{ $field->id_field }}">

                            <!-- Guest Information (if not logged in) -->
                            @guest
                            <div class="p-6 bg-yellow-500/5 border border-yellow-500/20 rounded-2xl backdrop-blur-md mb-8">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-base font-extrabold text-yellow-400 flex items-center gap-2 uppercase tracking-widest">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Data Pemesan
                                    </h3>
                                </div>
                                
                                <div class="space-y-5">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Nama Lengkap</label>
                                        <input 
                                            type="text" 
                                            name="guest_name" 
                                            value="{{ old('guest_name') }}"
                                            required
                                            placeholder="Masukkan nama lengkap"
                                            class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 focus:shadow-[0_0_15px_rgba(234,179,8,0.2)] transition-all font-medium text-sm md:text-base"
                                        >
                                        @error('guest_name')
                                            <p class="mt-2 text-xs font-bold text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="grid md:grid-cols-2 gap-5">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Email</label>
                                            <input 
                                                type="email" 
                                                name="guest_email" 
                                                value="{{ old('guest_email') }}"
                                                required
                                                placeholder="contoh@email.com"
                                                class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 focus:shadow-[0_0_15px_rgba(234,179,8,0.2)] transition-all font-medium text-sm md:text-base"
                                            >
                                            @error('guest_email')
                                                <p class="mt-2 text-xs font-bold text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Nomor WhatsApp</label>
                                            <input 
                                                type="tel" 
                                                name="guest_phone" 
                                                value="{{ old('guest_phone') }}"
                                                required
                                                placeholder="08xx-xxxx-xxxx"
                                                class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 focus:shadow-[0_0_15px_rgba(234,179,8,0.2)] transition-all font-medium text-sm md:text-base"
                                            >
                                            @error('guest_phone')
                                                <p class="mt-2 text-xs font-bold text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 p-4 bg-black/40 border border-white/5 rounded-xl">
                                    <p class="text-sm text-gray-400 font-medium">
                                        💡 <strong class="text-white">ingin diskon?</strong> 
                                        <a href="{{ route('register') }}" class="text-green-400 hover:text-green-300 font-bold underline">join member</a>
                                    </p>
                                </div>
                            </div>
                            @endguest

                            @auth
                            <div class="mb-8 p-5 bg-green-500/10 border border-green-500/20 rounded-2xl flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-black/50 rounded-full flex items-center justify-center border border-white/10 shrink-0">
                                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Booking Sebagai</p>
                                        <p class="text-base font-extrabold text-white flex items-center gap-2">
                                            {{ auth()->user()->name }}
                                            @if(auth()->user()->is_member)
                                                <span class="px-2 py-0.5 bg-green-500 text-black text-[10px] font-black rounded uppercase tracking-widest">Member</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endauth

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Date -->
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Tanggal Booking</label>
                                    <input 
                                        type="date" 
                                        name="booking_date" 
                                        id="booking_date"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                        class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium text-sm md:text-base cursor-pointer"
                                    >
                                    @error('booking_date')
                                        <p class="mt-2 text-xs font-bold text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Schedule Info (AJAX) -->
                                <div id="scheduleInfo" class="md:col-span-2 hidden transition-all duration-500">
                                    <div class="p-5 bg-white/5 border border-white/10 rounded-xl backdrop-blur-sm">
                                        <h4 class="text-xs font-extrabold text-white mb-3 uppercase tracking-widest flex items-center gap-2">
                                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Jadwal Sudah Terisi
                                        </h4>
                                        <div id="bookedSlots" class="flex flex-wrap gap-2">
                                            <!-- Dynamically filled by JS -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Time -->
                                <div>
                                    <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Jam Mulai</label>
                                    <select 
                                        name="start_time" 
                                        id="start_time"
                                        required
                                        class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium text-sm md:text-base cursor-pointer"
                                    >
                                        <option value="" disabled selected>Pilih Jam</option>
                                        @for($i = 7; $i <= 23; $i++)
                                            <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }} WIB</option>
                                        @endfor
                                    </select>
                                    @error('start_time')
                                        <p class="mt-2 text-xs font-bold text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Duration -->
                                <div>
                                    <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Durasi (Jam)</label>
                                    <select 
                                        name="duration_hours" 
                                        id="duration_hours"
                                        required
                                        class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium text-sm md:text-base cursor-pointer"
                                    >
                                        <option value="" disabled selected>Pilih Durasi</option>
                                        @for($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}">{{ $i }} Jam</option>
                                        @endfor
                                    </select>
                                    @error('duration_hours')
                                        <p class="mt-2 text-xs font-bold text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Voucher Code -->
                            <div x-data="{ 
                                voucherCode: '', 
                                voucherApplied: false, 
                                voucherData: null,
                                originalPrice: 0,
                                finalPrice: 0,
                                isValidating: false,
                                errorMsg: ''
                            }">
                                <label class="block text-sm font-bold mb-2">Kode Voucher (Opsional)</label>
                                <div class="flex gap-2">
                                    <input 
                                        type="text" 
                                        x-model="voucherCode"
                                        :disabled="voucherApplied"
                                        placeholder="Masukkan kode voucher"
                                        class="flex-1 px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 uppercase focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all text-sm md:text-base disabled:opacity-50"
                                    >
                                    <button 
                                        type="button"
                                        @click="validateVoucher()"
                                        :disabled="!voucherCode || voucherApplied || isValidating"
                                        class="px-6 py-3 bg-green-500 text-black rounded-xl font-bold hover:bg-green-400 transition-all disabled:opacity-50 disabled:cursor-not-allowed text-sm md:text-base"
                                        x-text="voucherApplied ? '✓' : (isValidating ? '...' : 'Terapkan')"
                                    ></button>
                                </div>
                                
                                <input type="hidden" name="voucher_code" :value="voucherApplied ? voucherCode : ''">
                                
                                <!-- Success Message -->
                                <div x-show="voucherApplied" x-cloak class="mt-3 p-3 bg-green-500/10 border border-green-500/20 rounded-xl">
                                    <p class="text-sm text-green-400 font-bold">
                                        ✓ Voucher berhasil diterapkan!
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1" x-text="voucherData?.name"></p>
                                    <button type="button" @click="removeVoucher()" class="text-xs text-red-400 hover:text-red-300 mt-2">Hapus voucher</button>
                                </div>
                                
                                <!-- Error Message -->
                                <div x-show="errorMsg" x-cloak class="mt-3 p-3 bg-red-500/10 border border-red-500/20 rounded-xl">
                                    <p class="text-sm text-red-400" x-text="errorMsg"></p>
                                </div>

                                <script>
                                    function validateVoucher() {
                                        const bookingDate = document.getElementById('booking_date').value;
                                        const durationHours = document.getElementById('duration_hours').value;
                                        
                                        if (!bookingDate || !durationHours) {
                                            this.errorMsg = 'Pilih tanggal dan durasi booking terlebih dahulu';
                                            return;
                                        }

                                        // Calculate estimated price (rough calculation)
                                        const estimatedPrice = durationHours * 100000; // Estimasi Rp100k per jam

                                        this.isValidating = true;
                                        this.errorMsg = '';

                                        fetch('/api/voucher/validate', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                code: this.voucherCode.toUpperCase(),
                                                booking_amount: estimatedPrice,
                                                booking_date: bookingDate
                                            })
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.success) {
                                                this.voucherApplied = true;
                                                this.voucherData = data.voucher;
                                                this.errorMsg = '';
                                            } else {
                                                this.errorMsg = data.message || 'Voucher tidak valid';
                                            }
                                        })
                                        .catch(err => {
                                            this.errorMsg = 'Terjadi kesalahan saat validasi voucher';
                                        })
                                        .finally(() => {
                                            this.isValidating = false;
                                        });
                                    }

                                    function removeVoucher() {
                                        this.voucherApplied = false;
                                        this.voucherCode = '';
                                        this.voucherData = null;
                                        this.errorMsg = '';
                                    }
                                </script>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Catatan (Opsional)</label>
                                <textarea 
                                    name="notes" 
                                    rows="3"
                                    placeholder="Tambahkan catatan khusus jika ada..."
                                    class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium text-sm md:text-base resize-none"
                                ></textarea>
                            </div>

                            <!-- Submit -->
                            <div class="pt-4">
                                <button 
                                    type="submit"
                                    class="w-full py-4 bg-gradient-to-r from-green-400 to-green-600 text-black rounded-xl font-extrabold text-base md:text-lg hover:from-green-300 hover:to-green-500 transition-all shadow-[0_0_20px_rgba(34,197,94,0.3)] hover:shadow-[0_0_30px_rgba(34,197,94,0.5)] flex items-center justify-center gap-2 group"
                                >
                                    @guest
                                        Lanjutkan ke Pembayaran
                                    @else
                                        Booking Sekarang
                                    @endguest
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                                
                                @guest
                                <p class="text-center text-xs text-gray-500 mt-4 font-medium">
                                    Setelah klik tombol, Anda akan diarahkan ke WhatsApp kasir.
                                </p>
                                @endguest
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Simple -->
    <footer class="py-6 border-t border-white/5 text-center mt-auto z-10 relative">
        <p class="text-xs text-gray-600 font-medium">© {{ date('Y') }} BOA Futsal. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            document.getElementById('mobileMenu')?.classList.toggle('hidden');
        });

        const fieldId = {{ $field->id_field }};
        const dateInput = document.getElementById('booking_date');
        const scheduleInfo = document.getElementById('scheduleInfo');
        const bookedSlots = document.getElementById('bookedSlots');

        dateInput.addEventListener('change', function() {
            const selectedDate = this.value;
            if (!selectedDate) {
                scheduleInfo.classList.add('hidden');
                return;
            }

            // Fetch booked schedules
            fetch(`/api/field-schedule/${fieldId}/${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        scheduleInfo.classList.remove('hidden');
                        bookedSlots.innerHTML = data.map(booking => {
                            const isConfirmed = booking.status === 'confirmed';
                            const bgColor = isConfirmed ? 'bg-red-500/10' : 'bg-yellow-500/10';
                            const borderColor = isConfirmed ? 'border-red-500/20' : 'border-yellow-500/20';
                            const textColor = isConfirmed ? 'text-red-400' : 'text-yellow-400';
                            const icon = isConfirmed 
                                ? `<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>`
                                : `<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
                            
                            return `
                                <div class="flex items-center gap-1.5 px-3 py-1.5 ${bgColor} border ${borderColor} rounded-lg ${textColor} text-xs font-bold">
                                    ${icon}
                                    ${booking.start_time.substring(0,5)} - ${booking.end_time.substring(0,5)}
                                </div>
                            `;
                        }).join('');
                    } else {
                        scheduleInfo.classList.remove('hidden');
                        bookedSlots.innerHTML = `
                            <div class="flex items-center gap-2 px-3 py-2 bg-green-500/10 border border-green-500/20 rounded-lg text-green-400 text-xs font-bold w-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Seluruh slot waktu masih tersedia!
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error fetching schedule:', error);
                });
        });
    </script>

</body>
</html>
