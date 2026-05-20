<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOA Futsal - Futsal Arena Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glow-green { shadow-[0_0_20px_rgba(74,222,128,0.2)] }
        .glass { background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(74, 222, 128, 0.1); }
        #public-comments::-webkit-scrollbar { width: 4px; }
        #public-comments::-webkit-scrollbar-track { background: transparent; }
        #public-comments::-webkit-scrollbar-thumb { background: rgba(74, 222, 128, 0.3); border-radius: 99px; }
        #public-comments::-webkit-scrollbar-thumb:hover { background: rgba(74, 222, 128, 0.6); }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black">

    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 py-6">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between bg-black/20 backdrop-blur-lg border border-white/5 rounded-2xl px-6 py-3">
            <div class="text-2xl font-extrabold tracking-tighter text-green-400">
                BOA<span class="text-white">FUTSAL</span>
            </div>
            
            <div class="hidden md:flex items-center gap-10">
                <a href="#home" class="text-sm font-medium hover:text-green-400 transition-colors">Home</a>
                <a href="#facilities" class="text-sm font-medium hover:text-green-400 transition-colors">Fasilitas</a>
                <a href="#fields" class="text-sm font-medium hover:text-green-400 transition-colors">Lapangan</a>
                <a href="#contact" class="text-sm font-medium hover:text-green-400 transition-colors">Contact Us</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-green-400 transition-colors">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 bg-white/5 border border-white/10 text-white rounded-xl font-bold text-sm hover:bg-white/10 transition-all">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 bg-green-500 text-black rounded-xl font-bold text-sm hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">Login</a>
                @endauth
            </div>

            <button id="mobile-menu-btn" class="md:hidden p-2 text-green-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden mt-4 bg-black/90 border border-white/10 rounded-2xl overflow-hidden backdrop-blur-xl">
            <div class="flex flex-col p-4 space-y-4">
                <a href="#home" class="mobile-link text-sm font-medium px-4 py-2 hover:bg-green-500/10 rounded-lg">Home</a>
                <a href="#facilities" class="mobile-link text-sm font-medium px-4 py-2 hover:bg-green-500/10 rounded-lg">Fasilitas</a>
                <a href="#fields" class="mobile-link text-sm font-medium px-4 py-2 hover:bg-green-500/10 rounded-lg">Lapangan</a>
                <a href="#contact" class="mobile-link text-sm font-medium px-4 py-2 hover:bg-green-500/10 rounded-lg">Contact Us</a>
                <a href="{{ route('login') }}" class="mobile-link bg-green-500 text-black px-4 py-3 rounded-xl font-bold text-center">Login</a>
            </div>
        </div>
    </div>
</nav>

    <section id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="absolute top-0 -left-20 w-96 h-96 bg-green-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-green-900/10 rounded-full blur-[120px]"></div>

        <div class="container mx-auto px-6 z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="text-left space-y-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold uppercase tracking-widest">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        Arena Futsal Di Cilangkap
                    </div>
                    <h1 class="text-6xl md:text-8xl font-extrabold leading-[1.1] tracking-tighter">
                        MAIN <span class="text-green-400">PRO</span> <br>SETIAP HARI.
                    </h1>
                    <p class="text-gray-400 text-lg md:text-xl max-w-lg leading-relaxed">
                        Nikmati kualitas rumput internasional dan atmosfer stadion profesional di pusat kota. Booking lapanganmu dalam hitungan detik.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#fields" class="px-8 py-4 bg-green-500 text-black rounded-2xl font-bold text-lg hover:bg-green-400 transition-all text-center">Jelajahi Lapangan</a>
                        <a href="#fields" class="px-8 py-4 bg-white/5 border border-white/10 rounded-2xl font-bold text-lg hover:bg-white/10 transition-all text-center text-white">Booking</a>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-green-500/20 rounded-[2rem] blur-2xl"></div>
                    <img src="{{asset ('asset/img/landing.jfif')}}" 
                           class="relative rounded-[2rem] border border-white/10 shadow-2xl grayscale hover:grayscale-0 transition duration-700">
                </div>
            </div>
        </div>
    </section>

    <section id="facilities" class="py-32 bg-[#050505]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Fasilitas</h2>
                <div class="w-20 h-1 bg-green-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="group relative h-80 rounded-[2rem] overflow-hidden border border-white/10 shadow-2xl">
                    <img src="{{asset ('asset/img/toilet.jfif')}}" alt="Locker Room" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 p-8">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center text-black mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold">Toilet</h3>
                        <p class="text-gray-300 text-sm mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500">Kamar mandi untuk para pengunjung.</p>
                    </div>
                </div>

                <div class="group relative h-80 rounded-[2rem] overflow-hidden border border-white/10 shadow-2xl">
                    <img src="{{asset ('asset/img/kasir.jfif')}}" alt="Cafe" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 p-8">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center text-black mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold">Kasir & Parkiran</h3>
                        <p class="text-gray-300 text-sm mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500">Tempat untuk Reservasi dan Parkir mobil/motor.</p>
                    </div>
                </div>

                <div class="group relative h-80 rounded-[2rem] overflow-hidden border border-white/10 shadow-2xl">
                    <img src="{{asset ('asset/img/mushola.jfif')}}" alt="Mushola" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 p-8">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center text-black mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold">Mushola</h3>
                        <p class="text-gray-300 text-sm mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500">Ibadah tetap nyaman dengan fasilitas yang bersih.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fields" class="py-32 bg-[#080808]">
    <div class="container mx-auto px-6">
        <div class="mb-16">
            <h2 class="text-4xl font-bold">Pilih <span class="text-green-400">Arena</span> Kamu</h2>
            <p class="text-gray-500 mt-2">Pilih lapangan sesuai gaya permainan timmu.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            @foreach($fields as $field)
            <div class="group bg-white/5 rounded-[2.5rem] overflow-hidden border border-white/10 hover:border-green-500/30 transition-all duration-500 shadow-2xl" data-field-id="{{ $field->id }}">
                <div class="h-64 overflow-hidden relative">
                    <img src="{{ asset('asset/img/lapangan' . $field->id_field . '.jfif') }}" 
                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                    alt="{{ $field->name }}">
                    <span class="absolute top-4 left-4 px-4 py-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold rounded-full">Rumput Sintetis</span>
                    
                    <!-- Status Badge -->
                    <div class="field-status-badge absolute top-4 right-4 hidden">
                        <span class="px-4 py-2 bg-red-500/90 backdrop-blur-md text-white text-xs font-bold rounded-full flex items-center gap-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                            </span>
                            <span class="field-status-text">Sedang Dipakai</span>
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-2">{{ $field->name }}</h3>
                    <p class="text-gray-400 text-sm mb-4">Rumput sintetis terbaru. Minim risiko cedera lutut dan pantulan bola stabil.</p>
                    
                    <!-- Real-time Status Info -->
                    <div class="field-status-info mb-6 hidden">
                        <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-gray-400">Sedang Dipakai</span>
                                <span class="text-xs font-bold text-red-400 field-countdown"></span>
                            </div>
                            <div class="text-sm text-gray-300">
                                <span class="field-current-time"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Available Status -->
                    <div class="field-available-info mb-6 hidden">
                        <div class="p-4 bg-green-500/10 border border-green-500/20 rounded-xl">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-bold text-green-400">Tersedia Sekarang</span>
                            </div>
                            <div class="field-next-booking text-xs text-gray-400 mt-2 hidden">
                                Booking berikutnya: <span class="field-next-time font-bold"></span>
                            </div>
                        </div>
                    </div>
                    
                    <button onclick="openPriceModal({{ $field->id_field }})" class="w-full py-4 bg-white/5 border border-white/10 hover:bg-green-500 hover:text-black hover:border-green-500 text-white rounded-2xl font-bold transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Detail Harga
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div id="priceModal" class="fixed inset-0 z-[100] hidden items-center justify-center px-4">
    <div onclick="closePriceModal()" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
    
    <div id="priceModalContent" class="relative bg-white/10 backdrop-blur-2xl border border-white/20 p-8 rounded-[2.5rem] w-full max-w-lg shadow-2xl transform transition-all">
        <button onclick="closePriceModal()" class="absolute top-6 right-6 text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
            <span class="w-2 h-8 bg-green-500 rounded-full"></span>
            <span id="modalFieldName">Price Information</span>
        </h3>

        <div id="modalPriceContent" class="space-y-6">
            <!-- Dynamic content will be loaded here -->
        </div>

        <a id="modalBookingButton" href="#" class="mt-8 w-full py-4 bg-green-500 text-black rounded-2xl font-black text-center block hover:scale-[1.02] transition shadow-[0_0_20px_rgba(34,197,94,0.3)]">
            BOOKING SEKARANG
        </a>
    </div>
</div>

    <section id="contact" class="py-32 bg-[#050505] relative overflow-hidden">
        <div class="absolute top-1/2 left-0 w-64 h-64 bg-green-500/5 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-green-900/5 rounded-full blur-[100px]"></div>

        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Contact <span class="text-green-400">Us</span></h2>
                <div class="w-20 h-1 bg-green-500 mx-auto rounded-full"></div>
                <p class="text-gray-500 mt-4 max-w-md mx-auto">Ada pertanyaan, mau collab, atau sekadar kasih komentar?</p>
            </div>

            {{-- Tab Switcher --}}
            <div class="flex justify-center mb-10">
                <div class="inline-flex bg-white/5 border border-white/10 rounded-2xl p-1 gap-1">
                    <button id="tab-general" onclick="switchTab('general')"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-green-500 text-black">
                        Komentar Umum
                    </button>
                    <button id="tab-collab" onclick="switchTab('collab')"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-gray-400 hover:text-white">
                        Collab & Sponsorship
                    </button>
                </div>
            </div>

            @if(session('contact_success'))
            @endif
            @if(session('collab_success'))
            @endif

            {{-- TAB: Komentar Umum --}}
            <div id="panel-general" class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Info Cards -->
                    <div class="flex flex-col gap-5">
                        <div class="group bg-white/5 border border-white/10 hover:border-green-500/30 rounded-[2rem] p-6 flex items-center gap-5 transition-all duration-500">
                            <div class="w-14 h-14 shrink-0 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center justify-center group-hover:bg-green-500 group-hover:border-green-500 transition-all duration-300">
                                <svg class="w-6 h-6 text-green-400 group-hover:text-black transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Email</h3>
                                <p class="text-gray-400 text-sm">admin@boafutsal.com</p>
                                <a href="mailto:admin@boafutsal.com" class="text-green-400 text-sm hover:text-green-300 transition-colors mt-1 inline-block">Send Email</a>
                            </div>
                        </div>
                        <div class="group bg-white/5 border border-white/10 hover:border-green-500/30 rounded-[2rem] p-6 flex items-center gap-5 transition-all duration-500">
                            <div class="w-14 h-14 shrink-0 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center justify-center group-hover:bg-green-500 group-hover:border-green-500 transition-all duration-300">
                                <svg class="w-6 h-6 text-green-400 group-hover:text-black transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Lokasi</h3>
                                <p class="text-gray-400 text-sm">Jl. Cilangkap Raya, Jakarta Timur</p>
                                <a href="https://maps.google.com" target="_blank" class="text-green-400 text-sm hover:text-green-300 transition-colors mt-1 inline-block">View on Map</a>
                            </div>
                        </div>
                        <div class="group bg-white/5 border border-white/10 hover:border-green-500/30 rounded-[2rem] p-6 flex items-center gap-5 transition-all duration-500">
                            <div class="w-14 h-14 shrink-0 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center justify-center group-hover:bg-green-500 group-hover:border-green-500 transition-all duration-300">
                                <svg class="w-6 h-6 text-green-400 group-hover:text-black transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.94 3.659 1.437 5.634 1.437h.005c6.558 0 11.894-5.335 11.897-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">WhatsApp</h3>
                                <p class="text-gray-400 text-sm">+62 812-3456-7890</p>
                                <a href="https://wa.me/yournumber" target="_blank" class="text-green-400 text-sm hover:text-green-300 transition-colors mt-1 inline-block">Send Message</a>
                            </div>
                        </div>
                    </div>

                    <!-- General Comment Form -->
                    <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                        <h3 class="text-lg font-bold mb-5">Tinggalkan Komentar</h3>
                        @auth
                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="type" value="general">
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Nama</label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                    placeholder="Nama kamu">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Email</label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                    placeholder="email@kamu.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Subjek</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                    placeholder="Subjek komentar">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Komentar</label>
                                <textarea name="message" rows="4" required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all resize-none"
                                    placeholder="Tulis komentarmu...">{{ old('message') }}</textarea>
                            </div>
                            <button type="submit"
                                class="w-full py-4 bg-green-500 text-black rounded-2xl font-bold hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                                Kirim Komentar
                            </button>
                        </form>
                        @else
                        <div class="flex flex-col items-center justify-center h-full text-center py-10 gap-6">
                            <div class="w-16 h-16 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-bold text-lg mb-2">Login dulu untuk komentar</p>
                                <p class="text-gray-500 text-sm">Kamu perlu login sebelum bisa meninggalkan komentar.</p>
                            </div>
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-green-500 text-black rounded-2xl font-bold hover:bg-green-400 transition-all">
                                Login Sekarang
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>

                {{-- Public Comments --}}
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold">Komentar Pengunjung</h3>
                        <span id="comments-count" class="text-xs text-gray-500"></span>
                    </div>
                    <div class="bg-white/3 border border-white/10 rounded-[2rem] p-6">
                        <div id="public-comments" class="space-y-4 overflow-y-auto pr-1" style="max-height: 420px;">
                            <div class="text-gray-500 text-sm">Memuat komentar...</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB: Collab & Sponsorship --}}
            <div id="panel-collab" class="max-w-3xl mx-auto hidden">
                <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8 md:p-10">
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-2">Collab & <span class="text-green-400">Sponsorship</span></h3>
                        <p class="text-gray-400 text-sm">Tertarik untuk berkolaborasi atau menjadi sponsor BOA Futsal? Isi form di bawah dan tim kami akan menghubungi kamu.</p>
                    </div>
                    @auth
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                        @csrf
                        <input type="hidden" name="type" value="collab">
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Nama / Perusahaan</label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                    placeholder="Nama atau perusahaan kamu">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Email</label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                    placeholder="email@perusahaan.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Jenis Kerjasama</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                                placeholder="Contoh: Sponsorship Jersey, Event Collab, dll">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Detail Proposal</label>
                            <textarea name="message" rows="6" required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all resize-none"
                                placeholder="Ceritakan ide kolaborasi atau proposal sponsorship kamu...">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit"
                            class="w-full py-4 bg-green-500 text-black rounded-2xl font-black hover:bg-green-400 transition-all shadow-lg shadow-green-500/20 flex items-center justify-center gap-2">
                            Kirim Proposal
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </form>
                    @else
                    <div class="flex flex-col items-center justify-center text-center py-10 gap-6">
                        <div class="w-16 h-16 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-bold text-lg mb-2">Login dulu untuk kirim proposal</p>
                            <p class="text-gray-500 text-sm">Kamu perlu login sebelum bisa mengirim proposal collab.</p>
                        </div>
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-green-500 text-black rounded-2xl font-bold hover:bg-green-400 transition-all">
                            Login Sekarang
                        </a>
                    </div>
                    @endauth
                </div>
            </div>

        </div>
    </section>

    <footer class="pt-20 pb-10 border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-2">
                    <div class="text-3xl font-extrabold text-green-400 mb-6 uppercase tracking-tighter">BOAFUTSAL</div>
                    <p class="text-gray-500 max-w-sm">Tempat berkumpulnya para juara. Kami menyediakan fasilitas olahraga terbaik untuk komunitas futsal di Indonesia.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-green-400 transition">Harga Lapangan</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">Jadwal Member</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">Lokasi Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Social Media</h4>
                    <div class="flex gap-4">
                        <!-- Instagram -->
                        <a href="https://instagram.com/boafutsal" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-green-500 hover:border-green-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <!-- TikTok -->
                        <a href="https://tiktok.com/@boafutsal" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-green-500 hover:border-green-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.75a4.85 4.85 0 01-1.01-.06z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 text-center text-sm text-gray-600">
                &copy; 2026 BOA Futsal Arena. Built for Performance.
            </div>
        </div>
    </footer>

    <a href="https://wa.me/yournumber" target="_blank" class="fixed bottom-8 right-8 z-[999] group flex items-center gap-3">
        <span class="px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-sm font-bold opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0 shadow-xl">
            Chat Admin
        </span>
        <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(34,197,94,0.4)] hover:scale-110 transition-transform duration-300">
            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.94 3.659 1.437 5.634 1.437h.005c6.558 0 11.894-5.335 11.897-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </div>
    </a>

    <script>
        // Tab switching for contact section
        function switchTab(tab) {
            const panelGeneral = document.getElementById('panel-general');
            const panelCollab = document.getElementById('panel-collab');
            const tabGeneral = document.getElementById('tab-general');
            const tabCollab = document.getElementById('tab-collab');

            if (tab === 'general') {
                panelGeneral.classList.remove('hidden');
                panelCollab.classList.add('hidden');
                tabGeneral.classList.add('bg-green-500', 'text-black');
                tabGeneral.classList.remove('text-gray-400');
                tabCollab.classList.remove('bg-green-500', 'text-black');
                tabCollab.classList.add('text-gray-400');
            } else {
                panelCollab.classList.remove('hidden');
                panelGeneral.classList.add('hidden');
                tabCollab.classList.add('bg-green-500', 'text-black');
                tabCollab.classList.remove('text-gray-400');
                tabGeneral.classList.remove('bg-green-500', 'text-black');
                tabGeneral.classList.add('text-gray-400');
            }
        }

        // Load public comments
        function loadPublicComments() {
            fetch('/api/public-comments')
                .then(r => r.json())
                .then(comments => {
                    const container = document.getElementById('public-comments');
                    const countEl = document.getElementById('comments-count');

                    if (!comments.length) {
                        container.innerHTML = '<p class="text-gray-500 text-sm">Belum ada komentar. Jadilah yang pertama!</p>';
                        return;
                    }

                    if (countEl) countEl.textContent = `${comments.length} komentar`;

                    const itemHeight = 88; // approx height per comment item in px
                    const visibleCount = 5;

                    container.innerHTML = comments.map((c, i) => `
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-5 flex gap-4">
                            <div class="w-10 h-10 shrink-0 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center font-bold text-green-400 uppercase">
                                ${c.name.charAt(0)}
                            </div>
                            <div>
                                <p class="font-bold text-sm text-white">${c.name}</p>
                                <p class="text-gray-400 text-sm mt-1">${c.message}</p>
                                <p class="text-gray-600 text-xs mt-2">${new Date(c.created_at).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'})}</p>
                            </div>
                        </div>
                    `).join('');

                    // Set max-height to show exactly 5 items, scroll reveals the rest
                    if (comments.length > visibleCount) {
                        container.style.maxHeight = (visibleCount * itemHeight + (visibleCount - 1) * 16) + 'px';
                    } else {
                        container.style.maxHeight = 'none';
                    }
                })
                .catch(() => {});
        }

        loadPublicComments();

        // Auto-switch to collab tab if collab_success session
        @if(session('collab_success'))
            switchTab('collab');
        @endif

        const fieldsData = @json($fields);

        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        // Fungsi buka/tutup menu
        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Otomatis tutup menu kalau salah satu link diklik
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        function openPriceModal(fieldId) {
            const field = fieldsData.find(f => f.id_field === fieldId);
            if (!field) return;

            const modal = document.getElementById('priceModal');
            const modalFieldName = document.getElementById('modalFieldName');
            const modalPriceContent = document.getElementById('modalPriceContent');
            const modalBookingButton = document.getElementById('modalBookingButton');

            // Set field name
            modalFieldName.textContent = field.name;

            // Group prices by day_type
            const weekdayPrices = field.prices.filter(p => p.day_type === 'weekday');
            const weekendPrices = field.prices.filter(p => p.day_type === 'weekend');

            // Build price HTML
            let priceHTML = '';

            if (weekdayPrices.length > 0) {
                priceHTML += `
                    <div>
                        <p class="text-green-400 font-bold text-sm uppercase tracking-widest mb-3 italic">Senin - Jumat</p>
                        <div class="space-y-2">
                `;
                weekdayPrices.forEach(price => {
                    priceHTML += `
                        <div class="flex justify-between p-3 bg-white/5 rounded-xl border border-white/5">
                            <span class="text-gray-300">${price.start_time.substring(0,5)} - ${price.end_time.substring(0,5)}</span>
                            <span class="font-bold">Rp ${parseInt(price.price_regular).toLocaleString('id-ID')}</span>
                        </div>
                    `;
                });
                priceHTML += '</div></div>';
            }

            if (weekendPrices.length > 0) {
                priceHTML += `
                    <div>
                        <p class="text-green-400 font-bold text-sm uppercase tracking-widest mb-3 italic">Sabtu - Minggu</p>
                        <div class="space-y-2">
                `;
                weekendPrices.forEach(price => {
                    priceHTML += `
                        <div class="flex justify-between p-3 bg-white/5 rounded-xl border border-white/5">
                            <span class="text-gray-300">${price.start_time.substring(0,5)} - ${price.end_time.substring(0,5)}</span>
                            <span class="font-bold">Rp ${parseInt(price.price_regular).toLocaleString('id-ID')}</span>
                        </div>
                    `;
                });
                priceHTML += '</div></div>';
            }

            modalPriceContent.innerHTML = priceHTML;

            // Set booking button link
            @auth
                modalBookingButton.href = `/bookings/create/${fieldId}`;
            @else
                modalBookingButton.href = `/login`;
            @endauth

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closePriceModal() {
            const modal = document.getElementById('priceModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Real-time field status update
        function updateFieldStatus() {
            fetch('/api/field-status')
                .then(response => response.json())
                .then(data => {
                    data.forEach(fieldStatus => {
                        const fieldCard = document.querySelector(`[data-field-id="${fieldStatus.field_id}"]`);
                        if (!fieldCard) return;

                        const statusBadge = fieldCard.querySelector('.field-status-badge');
                        const statusInfo = fieldCard.querySelector('.field-status-info');
                        const availableInfo = fieldCard.querySelector('.field-available-info');
                        const countdown = fieldCard.querySelector('.field-countdown');
                        const currentTime = fieldCard.querySelector('.field-current-time');
                        const nextBooking = fieldCard.querySelector('.field-next-booking');
                        const nextTime = fieldCard.querySelector('.field-next-time');

                        if (fieldStatus.is_occupied && fieldStatus.current_booking) {
                            // Field is occupied
                            statusBadge.classList.remove('hidden');
                            statusInfo.classList.remove('hidden');
                            availableInfo.classList.add('hidden');

                            const remaining = fieldStatus.current_booking.remaining_minutes;
                            const hours = Math.floor(remaining / 60);
                            const minutes = remaining % 60;
                            
                            countdown.textContent = `${hours}j ${minutes}m lagi`;
                            
                            // Fix time display
                            const startTime = fieldStatus.current_booking.start_time;
                            const endTime = fieldStatus.current_booking.end_time;
                            currentTime.textContent = `${startTime.substring(0,5)} - ${endTime.substring(0,5)}`;
                        } else {
                            // Field is available
                            statusBadge.classList.add('hidden');
                            statusInfo.classList.add('hidden');
                            availableInfo.classList.remove('hidden');

                            if (fieldStatus.next_booking) {
                                nextBooking.classList.remove('hidden');
                                nextTime.textContent = `${fieldStatus.next_booking.start_time.substring(0,5)} - ${fieldStatus.next_booking.end_time.substring(0,5)}`;
                            } else {
                                nextBooking.classList.add('hidden');
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching field status:', error);
                });
        }

        // Update status immediately and then every 30 seconds
        updateFieldStatus();
        setInterval(updateFieldStatus, 30000);

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('glass', 'py-4');
                navbar.classList.remove('py-6');
            } else {
                navbar.classList.remove('glass', 'py-4');
                navbar.classList.add('py-6');
            }
        });
    </script>

    {{-- Toast Notification --}}
    <div id="toast" class="fixed top-6 right-6 z-[9999] flex items-center gap-3 px-5 py-4 bg-[#0a0a0a] border border-green-500/40 rounded-2xl shadow-[0_0_30px_rgba(34,197,94,0.15)] translate-x-[120%] transition-transform duration-500 ease-out max-w-sm">
        <div class="w-9 h-9 shrink-0 bg-green-500/10 border border-green-500/30 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-white font-bold text-sm">Pesan Terkirim!</p>
            <p id="toast-msg" class="text-gray-400 text-xs mt-0.5"></p>
        </div>
        <button onclick="hideToast()" class="text-gray-600 hover:text-white transition-colors ml-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <script>
        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            toast.classList.remove('translate-x-[120%]');
            toast.classList.add('translate-x-0');
            clearTimeout(window._toastTimer);
            window._toastTimer = setTimeout(hideToast, 4000);
        }
        function hideToast() {
            const toast = document.getElementById('toast');
            toast.classList.add('translate-x-[120%]');
            toast.classList.remove('translate-x-0');
        }

        @if(session('contact_success'))
            document.addEventListener('DOMContentLoaded', () => showToast('Komentar kamu berhasil dikirim!'));
        @endif
        @if(session('collab_success'))
            document.addEventListener('DOMContentLoaded', () => showToast('Proposal collab/sponsorship berhasil dikirim!'));
        @endif
    </script>
</body>
</html>
