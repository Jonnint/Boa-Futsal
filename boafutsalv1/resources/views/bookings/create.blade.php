<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking {{ $field->name }} - BOA Futsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

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
        }
        select option {
            background-color: #121212;
            color: #ffffff;
        }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 py-4 md:py-6 bg-black/20 backdrop-blur-lg border-b border-white/5">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex items-center justify-between">
                <a href="/" class="text-xl md:text-2xl font-extrabold tracking-tighter text-green-400">
                    BOA<span class="text-white">FUTSAL</span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="/" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Homepage</a>
                    @auth
                        <span class="text-gray-600">|</span>
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Dashboard</a>
                    @else
                        <span class="text-gray-600">|</span>
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Login</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden p-2 text-gray-400 hover:text-green-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pt-4 border-t border-white/10">
                <div class="flex flex-col gap-3">
                    <a href="/" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Homepage</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-24 md:pt-32 pb-12 md:pb-20 px-4 md:px-6">
        <div class="container mx-auto max-w-5xl">
            <!-- Back Button -->
            <a href="/" class="inline-flex items-center gap-2 text-gray-400 hover:text-green-400 transition-colors mb-6 md:mb-8 text-sm md:text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Beranda
            </a>

            <div class="grid lg:grid-cols-5 gap-6 md:gap-8">
                <!-- Field Info -->
                <div class="lg:col-span-2">
                    <div class="lg:sticky lg:top-24">
                        <div class="bg-white/5 border border-white/10 rounded-xl md:rounded-[2rem] overflow-hidden">
                            <img src="{{ asset($field->image) }}" class="w-full h-48 md:h-64 object-cover">
                            <div class="p-4 md:p-6">
                                <h2 class="text-xl md:text-2xl font-bold mb-2">{{ $field->name }}</h2>
                                <p class="text-gray-400 text-xs md:text-sm mb-4">{{ $field->description }}</p>
                                <div class="flex items-center gap-2 text-xs md:text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $field->surface_type }}
                                </div>
                            </div>
                        </div>

                        <!-- Price Info -->
                        <div class="mt-4 md:mt-6 bg-white/5 border border-white/10 rounded-xl md:rounded-[2rem] p-4 md:p-6">
                            <h3 class="font-bold mb-3 md:mb-4 flex items-center gap-2 text-sm md:text-base">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Informasi Harga
                            </h3>
                            <div class="space-y-3 text-xs md:text-sm">
                                @foreach($field->prices->groupBy('day_type') as $dayType => $prices)
                                    <div>
                                        <p class="text-green-400 font-bold mb-2">{{ $dayType == 'weekday' ? 'Senin - Jumat' : 'Sabtu - Minggu' }}</p>
                                        @foreach($prices as $price)
                                            <div class="flex justify-between text-gray-400 mb-1">
                                                <span>{{ date('H:i', strtotime($price->start_time)) }} - {{ date('H:i', strtotime($price->end_time)) }}</span>
                                                <span class="font-bold text-white">Rp {{ number_format($price->price_regular, 0, ',', '.') }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                                @if(auth()->check() && auth()->user()->is_member)
                                    <div class="mt-4 p-3 bg-green-500/10 border border-green-500/20 rounded-xl">
                                        <p class="text-green-400 text-xs font-bold">✓ Harga Member Aktif</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="lg:col-span-3">
                    <div class="bg-white/5 border border-white/10 rounded-xl md:rounded-[2rem] p-6 md:p-8">
                        <h1 class="text-2xl md:text-3xl font-extrabold mb-2">Booking Lapangan</h1>
                        <p class="text-gray-400 mb-6 md:mb-8 text-sm md:text-base">Isi form di bawah untuk booking lapangan</p>

                        @if(session('error'))
                            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-5 md:space-y-6">
                            @csrf
                            <input type="hidden" name="field_id" value="{{ $field->id_field }}">

                            <!-- Guest Information (if not logged in) -->
                            @guest
                            <div class="p-4 md:p-6 bg-yellow-500/10 border border-yellow-500/20 rounded-xl">
                                <h3 class="text-sm md:text-base font-bold mb-4 text-yellow-400 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Informasi Kontak
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs md:text-sm font-medium mb-2">Nama Lengkap</label>
                                        <input 
                                            type="text" 
                                            name="guest_name" 
                                            value="{{ old('guest_name') }}"
                                            required
                                            placeholder="Masukkan nama lengkap"
                                            class="w-full px-4 py-3 bg-[#121212] border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all text-sm md:text-base"
                                        >
                                        @error('guest_name')
                                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs md:text-sm font-medium mb-2">Email</label>
                                        <input 
                                            type="email" 
                                            name="guest_email" 
                                            value="{{ old('guest_email') }}"
                                            required
                                            placeholder="contoh@email.com"
                                            class="w-full px-4 py-3 bg-[#121212] border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all text-sm md:text-base"
                                        >
                                        @error('guest_email')
                                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs md:text-sm font-medium mb-2">Nomor Telepon / WhatsApp</label>
                                        <input 
                                            type="tel" 
                                            name="guest_phone" 
                                            value="{{ old('guest_phone') }}"
                                            required
                                            placeholder="08xx-xxxx-xxxx"
                                            class="w-full px-4 py-3 bg-[#121212] border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all text-sm md:text-base"
                                        >
                                        @error('guest_phone')
                                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mt-4 p-3 bg-green-500/10 border border-green-500/20 rounded-lg">
                                    <p class="text-xs text-green-400 mb-1">
                                        <strong>✓ Setelah booking,</strong> Anda akan diarahkan ke WhatsApp untuk konfirmasi pembayaran di kasir
                                    </p>
                                </div>
                                
                                <div class="mt-3 p-3 bg-blue-500/10 border border-blue-500/20 rounded-lg">
                                    <p class="text-xs text-blue-400">
                                        💡 <strong>Ingin mendapatkan harga member?</strong> 
                                        <a href="{{ route('login') }}" class="underline hover:text-blue-300">Login</a> atau 
                                        <a href="{{ route('register') }}" class="underline hover:text-blue-300">Daftar</a> untuk join membership!
                                    </p>
                                </div>
                            </div>
                            @endguest

                            @auth
                            <div class="p-4 bg-green-500/10 border border-green-500/20 rounded-xl">
                                <p class="text-sm text-green-400">
                                    ✓ Login sebagai: <strong>{{ auth()->user()->name }}</strong>
                                    @if(auth()->user()->is_member)
                                        <span class="ml-2 px-2 py-1 bg-green-500 text-black text-xs font-bold rounded">MEMBER</span>
                                    @endif
                                </p>
                                @if(auth()->user()->is_member)
                                    <p class="text-xs text-green-300 mt-2">🎉 Anda akan mendapat harga member!</p>
                                @endif
                            </div>
                            @endauth

                            <!-- Date -->
                            <div>
                                <label class="block text-sm font-bold mb-2">Tanggal Booking</label>
                                <input 
                                    type="date" 
                                    name="booking_date" 
                                    id="booking_date"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full px-4 py-3 bg-[#121212] border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all hover:border-green-500/50 cursor-pointer text-sm md:text-base"
                                    style="color-scheme: dark;"
                                >
                                @error('booking_date')
                                    <p class="mt-2 text-xs md:text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Schedule Info -->
                            <div id="scheduleInfo" class="hidden">
                                <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                                    <h4 class="text-xs md:text-sm font-bold mb-3 text-blue-400">Jadwal Terboking Hari Ini:</h4>
                                    <div id="bookedSlots" class="space-y-2 text-xs md:text-sm"></div>
                                </div>
                            </div>

                            <!-- Time -->
                            <div>
                                <label class="block text-sm font-bold mb-2">Jam Mulai</label>
                                <select 
                                    name="start_time" 
                                    id="start_time"
                                    required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all text-sm md:text-base"
                                >
                                    <option value="" disabled selected>Pilih Jam</option>
                                    @for($i = 7; $i <= 23; $i++)
                                        <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                    @endfor
                                </select>
                                @error('start_time')
                                    <p class="mt-2 text-xs md:text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Duration -->
                            <div>
                                <label class="block text-sm font-bold mb-2">Durasi (Jam)</label>
                                <select 
                                    name="duration_hours" 
                                    id="duration_hours"
                                    required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all text-sm md:text-base"
                                >
                                    <option value="" disabled selected>Pilih Durasi</option>
                                    @for($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}">{{ $i }} Jam</option>
                                    @endfor
                                </select>
                                @error('duration_hours')
                                    <p class="mt-2 text-xs md:text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="block text-sm font-bold mb-2">Catatan (Opsional)</label>
                                <textarea 
                                    name="notes" 
                                    rows="3"
                                    placeholder="Tambahkan catatan jika ada..."
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all text-sm md:text-base"
                                ></textarea>
                            </div>

                            <!-- Submit -->
                            @guest
                            <button 
                                type="submit"
                                class="w-full px-6 py-3 md:py-4 bg-green-500 text-black rounded-xl font-bold text-base md:text-lg hover:bg-green-400 transition-all shadow-lg shadow-green-500/20 flex items-center justify-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                Booking & Konfirmasi via WhatsApp
                            </button>
                            @else
                            <button 
                                type="submit"
                                class="w-full px-6 py-3 md:py-4 bg-green-500 text-black rounded-xl font-bold text-base md:text-lg hover:bg-green-400 transition-all shadow-lg shadow-green-500/20"
                            >
                                Lanjutkan ke Pembayaran
                            </button>
                            @endguest
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });

        const fieldId = {{ $field->id_field }};
        const dateInput = document.getElementById('booking_date');
        const scheduleInfo = document.getElementById('scheduleInfo');
        const bookedSlots = document.getElementById('bookedSlots');

        dateInput.addEventListener('change', function() {
            const selectedDate = this.value;
            if (!selectedDate) return;

            // Fetch booked schedules
            fetch(`/api/field-schedule/${fieldId}/${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        scheduleInfo.classList.remove('hidden');
                        bookedSlots.innerHTML = data.map(booking => {
                            const statusColor = booking.status === 'confirmed' ? 'text-green-400' : 'text-yellow-400';
                            const statusText = booking.status === 'confirmed' ? 'Confirmed' : 'Pending';
                            return `
                                <div class="flex justify-between items-center p-2 bg-white/5 rounded-lg">
                                    <span class="text-gray-300">${booking.start_time.substring(0,5)} - ${booking.end_time.substring(0,5)}</span>
                                    <span class="${statusColor} text-xs font-bold">${statusText}</span>
                                </div>
                            `;
                        }).join('');
                    } else {
                        scheduleInfo.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error fetching schedule:', error);
                });
        });
    </script>

</body>
</html>
