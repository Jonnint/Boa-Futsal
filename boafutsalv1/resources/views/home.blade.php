<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOA Futsal - Futsal Arena Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

    <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden bg-[#050505]">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('asset/img/landing.jfif') }}" alt="Background" class="w-full h-full object-cover object-center opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-[#050505]/90 via-[#050505]/40 to-[#050505]"></div>
        </div>

        <div class="container mx-auto px-6 z-10 relative flex flex-col items-center text-center">
            
            <h1 class="text-5xl md:text-7xl lg:text-[6rem] xl:text-[7rem] font-extrabold leading-[1.1] tracking-tighter text-white mb-6 uppercase">
                MAIN PRO <span class="text-green-400">SETIAP HARI.</span>
            </h1>
            
            <p class="text-gray-300 text-base md:text-lg max-w-2xl leading-relaxed mb-10">
                Nikmati kualitas rumput internasional dan atmosfer stadion profesional di pusat kota. Booking lapanganmu dalam hitungan detik.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Primary Button -->
                <a href="#fields" class="group flex items-center justify-center gap-3 px-8 py-4 bg-green-500 text-black font-bold text-sm tracking-widest uppercase transition-all hover:bg-green-400 hover:shadow-[0_0_20px_rgba(34,197,94,0.4)]">
                    <span class="w-3 h-3 rounded-full bg-black group-hover:scale-110 transition-transform"></span>
                    Booking
                </a>
                
                <!-- Secondary Button -->
                <a href="#fields" class="group flex items-center justify-center gap-3 px-8 py-4 bg-transparent border border-green-500/30 text-green-400 font-bold text-sm tracking-widest uppercase transition-all hover:border-green-500 hover:bg-green-500/10">
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm1 5A9 9 0 1116 2a9 9 0 010 18z"></path></svg>
                    Jelajahi Lapangan
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10">
            <a href="#facilities" class="flex flex-col items-center opacity-50 hover:opacity-100 transition-opacity animate-bounce text-white hover:text-green-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
    </section>

    <section id="facilities" class="py-32 bg-[#050505]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Fasilitas</h2>
                <div class="w-20 h-1 bg-green-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Toilet -->
                <div class="bg-white/5 rounded-2xl p-6 border border-white/10 hover:border-green-500/50 transition-colors h-full flex flex-col">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400 mb-4 border border-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Toilet</h3>
                    <p class="text-gray-400 text-sm leading-relaxed text-justify">Kamar mandi yang bersih dan terawat untuk menjamin kenyamanan para pengunjung sebelum atau sesudah berolahraga.</p>
                </div>

                <!-- Mushola -->
                <div class="bg-white/5 rounded-2xl p-6 border border-white/10 hover:border-green-500/50 transition-colors h-full flex flex-col">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400 mb-4 border border-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Mushola</h3>
                    <p class="text-gray-400 text-sm leading-relaxed text-justify">Fasilitas ibadah yang nyaman dan bersih, dilengkapi dengan tempat wudhu agar ibadah Anda tetap terjaga.</p>
                </div>

                <!-- Kasir -->
                <div class="bg-white/5 rounded-2xl p-6 border border-white/10 hover:border-green-500/50 transition-colors h-full flex flex-col">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400 mb-4 border border-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Kasir</h3>
                    <p class="text-gray-400 text-sm leading-relaxed text-justify">Area pelayanan untuk administrasi dan reservasi yang siap melayani dengan proses yang cepat serta ramah.</p>
                </div>

                <!-- Parkiran -->
                <div class="bg-white/5 rounded-2xl p-6 border border-white/10 hover:border-green-500/50 transition-colors h-full flex flex-col">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400 mb-4 border border-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Parkiran</h3>
                    <p class="text-gray-400 text-sm leading-relaxed text-justify">Area parkir kendaraan untuk mobil dan motor yang aman, luas, serta sangat mudah diakses oleh pengunjung.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="fields" class="relative py-32 bg-[#050505]">
        <!-- Responsive Background with Glassmorphism and Seamless Mask -->
        <div class="absolute inset-0 z-0 pointer-events-none" style="mask-image: linear-gradient(to bottom, transparent, black 15%, black 85%, transparent); -webkit-mask-image: linear-gradient(to bottom, transparent, black 15%, black 85%, transparent);">
            <!-- Mobile Background -->
            <img src="{{ asset('asset/img/aboutus.jfif') }}" alt="Background Mobile" class="w-full h-full object-cover object-center md:hidden">
            <!-- Desktop Background -->
            <img src="{{ asset('asset/img/sejarah.jfif') }}" alt="Background Desktop" class="w-full h-full object-cover object-center hidden md:block">
            
            <!-- Glassmorphism Overlay -->
            <div class="absolute inset-0 bg-black/60 backdrop-blur-md"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Pilih <span class="text-green-400">Arena</span> Kamu</h2>
                <div class="w-20 h-1 bg-green-500 mx-auto rounded-full mb-4"></div>
                <p class="text-gray-400">Pilih lapangan sesuai gaya permainan timmu.</p>
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
                    <!-- Interactive Map with Floating Info Card -->
                    <div class="relative w-full h-[500px] lg:h-auto lg:min-h-[500px] rounded-[2rem] overflow-hidden border border-white/10 group">
                        <!-- Google Maps iframe -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.7844146059635!2d106.8437021!3d-6.4729864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ea687f799a95%3A0xc58db16e109db14a!2sBoa%20Futsal!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
                            class="absolute inset-0 w-full h-full grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>

                        <!-- Floating Info Card -->
                        <div class="absolute bottom-6 left-6 right-6 lg:right-auto lg:w-[320px] bg-white/95 backdrop-blur-xl border border-white/20 p-6 rounded-2xl shadow-2xl transition-transform duration-500 hover:-translate-y-2 text-black">
                            <div class="space-y-5">
                                <!-- Lokasi -->
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-500 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <div>
                                        <h4 class="font-bold text-black text-sm">Headquarters</h4>
                                        <p class="text-xs text-gray-600 leading-relaxed mt-1">Jl. Raya Jakarta-Bogor No.KM.39, RT.02/RW.02, Pabuaran, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16916</p>
                                    </div>
                                </div>
                                
                                <!-- Phone -->
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    <p class="text-xs text-gray-600 font-medium">02122086938</p>
                                </div>
                                
                                <!-- Email -->
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <p class="text-xs text-gray-600 font-medium">info@boafutsal.com</p>
                                </div>

                                <!-- Button -->
                                <a href="https://www.google.com/maps/place/boa+futsal/data=!4m2!3m1!1s0x2e69ea687f799a95:0xc58db16e109db14a?sa=X&ved=1t:242&ictx=111" target="_blank" class="mt-2 w-full py-2.5 bg-green-500 text-black rounded-xl font-bold text-sm text-center block hover:bg-green-400 transition-colors shadow-lg">
                                    Get Directions
                                </a>
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



    <a href="https://wa.me/yournumber" target="_blank" class="fixed bottom-6 right-6 md:bottom-8 md:right-8 z-[999] group flex items-center gap-3">
        <span class="px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-sm font-bold opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0 shadow-xl hidden md:block">
            Chat Admin
        </span>
        <div class="w-12 h-12 md:w-16 md:h-16 bg-green-500 rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(34,197,94,0.4)] hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6 md:w-8 md:h-8 text-black" fill="currentColor" viewBox="0 0 24 24">
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

    <!-- Footer -->
    <footer class="relative pt-24 pb-10 bg-[#050505] overflow-hidden border-t border-white/5 mt-10">
        <!-- Glow Effect -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-[1px] bg-gradient-to-r from-transparent via-green-500/50 to-transparent"></div>
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-96 h-48 bg-green-500/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-12 lg:mb-16">
                
                <!-- Brand & About -->
                <div class="lg:col-span-4 lg:pr-4 text-center md:text-left">
                    <div class="text-3xl font-extrabold tracking-tighter text-green-400 mb-5">
                        BOA<span class="text-white">FUTSAL</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6 md:mb-8">
                        Arena futsal premium di Bogor dengan fasilitas lengkap, rumput sintetis berstandar tinggi, dan sistem reservasi digital yang super cepat.
                    </p>
                    <div class="flex items-center justify-center md:justify-start gap-3">
                        <!-- Social Icons -->
                        <a href="#" class="w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-gray-400 hover:text-black hover:border-green-500 hover:bg-green-500 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-gray-400 hover:text-black hover:border-green-500 hover:bg-green-500 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.46 2.89 2.89 0 012.9-4.22c.1 0 .21.01.31.02v-3.26c-.1-.01-.2-.02-.31-.02a6.35 6.35 0 00-6.35 6.35c0 3.51 2.84 6.35 6.35 6.35a6.35 6.35 0 006.35-6.35V8.59a8.4 8.4 0 004.18 1.13V6.26c-1.46 0-2.81-.56-3.8-1.5z"/></svg>
                        </a>
                        <a href="#" class="w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-gray-400 hover:text-black hover:border-green-500 hover:bg-green-500 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.94 3.659 1.437 5.634 1.437h.005c6.558 0 11.894-5.335 11.897-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div class="lg:col-span-2 text-center md:text-left">
                    <h4 class="text-white font-bold mb-5 md:mb-6 tracking-wide uppercase text-xs">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-sm font-medium text-gray-400 hover:text-green-400 hover:translate-x-1 transition-transform inline-block">Home</a></li>
                        <li><a href="#facilities" class="text-sm font-medium text-gray-400 hover:text-green-400 hover:translate-x-1 transition-transform inline-block">Fasilitas</a></li>
                        <li><a href="#fields" class="text-sm font-medium text-gray-400 hover:text-green-400 hover:translate-x-1 transition-transform inline-block">Lapangan</a></li>
                        <li><a href="#contact" class="text-sm font-medium text-gray-400 hover:text-green-400 hover:translate-x-1 transition-transform inline-block">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Operational Hours -->
                <div class="lg:col-span-3">
                    <h4 class="text-white font-bold mb-5 md:mb-6 tracking-wide uppercase text-xs text-center md:text-left">Jam Operasional</h4>
                    <ul class="space-y-4">
                        <li class="flex items-center justify-between text-sm border-b border-white/5 pb-2">
                            <span class="text-gray-400">Senin - Jumat</span>
                            <span class="text-white font-bold">08:00 - 23:00</span>
                        </li>
                        <li class="flex items-center justify-between text-sm border-b border-white/5 pb-2">
                            <span class="text-gray-400">Sabtu - Minggu</span>
                            <span class="text-white font-bold">07:00 - 24:00</span>
                        </li>
                        <li class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Hari Libur</span>
                            <span class="text-green-400 font-bold bg-green-500/10 px-3 py-1 rounded-full text-xs border border-green-500/20">Tetap Buka</span>
                        </li>
                    </ul>
                </div>

                <!-- CTA -->
                <div class="lg:col-span-3 text-center md:text-left">
                    <h4 class="text-white font-bold mb-5 md:mb-6 tracking-wide uppercase text-xs">Siap Main?</h4>
                    <p class="text-gray-400 text-sm mb-5 leading-relaxed">Jangan sampai kehabisan jadwal! Booking lapangan favorit timmu sekarang juga.</p>
                    <a href="#fields" class="w-full py-3.5 bg-green-500 hover:bg-green-400 text-black rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(34,197,94,0.2)] hover:shadow-[0_0_30px_rgba(34,197,94,0.4)] hover:-translate-y-1 flex items-center justify-center gap-2 group">
                        Booking Sekarang
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

            </div>

            <!-- Copyright -->
            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm font-medium text-center md:text-left">© 2026 BOA Futsal. All rights reserved.</p>
                <div class="flex items-center justify-center gap-6 text-sm font-medium text-gray-500">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <span class="w-1 h-1 bg-gray-600 rounded-full"></span>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

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

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Apply fade-up animation to sections and cards automatically
            document.querySelectorAll('section').forEach((el) => {
                if (!el.hasAttribute('data-aos')) el.setAttribute('data-aos', 'fade-up');
            });
            document.querySelectorAll('.group, .grid > div').forEach((el, index) => {
                if (!el.hasAttribute('data-aos')) {
                    el.setAttribute('data-aos', 'fade-up');
                    el.setAttribute('data-aos-delay', (index % 3) * 100);
                }
            });
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
            });
        });
    </script>
</body>
</html>
