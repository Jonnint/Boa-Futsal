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
        <div class="container mx-auto max-w-5xl">
            <!-- Back Button -->
            <a href="/" class="inline-flex items-center gap-2 text-gray-400 hover:text-green-400 transition-colors mb-8">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Beranda
            </a>

            <div class="grid lg:grid-cols-5 gap-8">
                <!-- Field Info -->
                <div class="lg:col-span-2">
                    <div class="sticky top-32">
                        <div class="bg-white/5 border border-white/10 rounded-[2rem] overflow-hidden">
                            <img src="{{ asset($field->image) }}" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h2 class="text-2xl font-bold mb-2">{{ $field->name }}</h2>
                                <p class="text-gray-400 text-sm mb-4">{{ $field->description }}</p>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $field->surface_type }}
                                </div>
                            </div>
                        </div>

                        <!-- Price Info -->
                        <div class="mt-6 bg-white/5 border border-white/10 rounded-[2rem] p-6">
                            <h3 class="font-bold mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Informasi Harga
                            </h3>
                            <div class="space-y-3 text-sm">
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
                                @if(auth()->user()->is_member)
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
                    <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                        <h1 class="text-3xl font-extrabold mb-2">Booking Lapangan</h1>
                        <p class="text-gray-400 mb-8">Isi form di bawah untuk booking lapangan</p>

                        @if(session('error'))
                            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="field_id" value="{{ $field->id_field }}">

                            <!-- Date -->
                            <div>
                                <label class="block text-sm font-bold mb-2">Tanggal Booking</label>
                                <input 
                                    type="date" 
                                    name="booking_date" 
                                    id="booking_date"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full px-4 py-3 bg-[#121212] border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all hover:border-green-500/50 cursor-pointer"
                                    style="color-scheme: dark;"
                                >
                                @error('booking_date')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Schedule Info -->
                            <div id="scheduleInfo" class="hidden">
                                <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                                    <h4 class="text-sm font-bold mb-3 text-blue-400">Jadwal Terboking Hari Ini:</h4>
                                    <div id="bookedSlots" class="space-y-2 text-sm"></div>
                                </div>
                            </div>

                            <!-- Time -->
                            <div>
                                <label class="block text-sm font-bold mb-2">Jam Mulai</label>
                                <select 
                                    name="start_time" 
                                    id="start_time"
                                    required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                >
                                    <option value="" disabled selected>Pilih Jam</option>
                                    @for($i = 7; $i <= 23; $i++)
                                        <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                    @endfor
                                </select>
                                @error('start_time')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Duration -->
                            <div>
                                <label class="block text-sm font-bold mb-2">Durasi (Jam)</label>
                                <select 
                                    name="duration_hours" 
                                    id="duration_hours"
                                    required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                >
                                    <option value="" disabled selected>Pilih Durasi</option>
                                    @for($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}">{{ $i }} Jam</option>
                                    @endfor
                                </select>
                                @error('duration_hours')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="block text-sm font-bold mb-2">Catatan (Opsional)</label>
                                <textarea 
                                    name="notes" 
                                    rows="3"
                                    placeholder="Tambahkan catatan jika ada..."
                                    class="w-full pzx-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                ></textarea>
                            </div>

                            <!-- Submit -->
                            <button 
                                type="submit"
                                class="w-full px-6 py-4 bg-green-500 text-black rounded-xl font-bold text-lg hover:bg-green-400 transition-all shadow-lg shadow-green-500/20"
                            >
                                Lanjutkan ke Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
