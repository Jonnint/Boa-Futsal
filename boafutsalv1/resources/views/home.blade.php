<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOA Futsal - Futsal Arena Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

    <x-public-navbar />

    <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden bg-transparent pb-32">
        <!-- Background Image with Seamless Mask -->
        <div class="absolute inset-0 z-0 pointer-events-none" style="mask-image: linear-gradient(to bottom, black 0%, black 85%, transparent); -webkit-mask-image: linear-gradient(to bottom, black 0%, black 85%, transparent);">
            <img src="{{ asset('asset/img/landing.webp') }}" alt="Background" fetchpriority="high" class="w-full h-full object-cover object-center opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-[#050505]/90 via-[#050505]/40 to-transparent"></div>
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
                <a href="#fields" class="group flex items-center justify-center gap-3 px-8 py-4 bg-green-500 text-black font-bold text-sm tracking-widest uppercase transition-all hover:bg-green-400 hover:shadow-[0_0_20px_rgba(34,197,94,0.4)] rounded-full">
                    <span class="w-3 h-3 rounded-full bg-black group-hover:scale-110 transition-transform"></span>
                    <span>Booking</span>
                </a>
                
                <!-- Secondary Button -->
                <a href="#fields" class="group flex items-center justify-center gap-3 px-8 py-4 bg-transparent border border-green-500/30 text-green-400 font-bold text-sm tracking-widest uppercase transition-all hover:border-green-500 hover:bg-green-500/10 rounded-full">
                    <span>Jelajahi Lapangan</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 pointer-events-auto">
            <a href="#facilities" class="flex flex-col items-center opacity-50 hover:opacity-100 transition-opacity animate-bounce text-white hover:text-green-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
    </section>

    <section id="facilities" class="relative pt-64 pb-32 -mt-32 bg-transparent z-10 pointer-events-none">
        <!-- Background Image with Seamless Mask -->
        <div class="absolute inset-0 z-0" style="mask-image: linear-gradient(to bottom, transparent 0%, black 15%, black 85%, transparent); -webkit-mask-image: linear-gradient(to bottom, transparent 0%, black 15%, black 85%, transparent);">
            <img src="{{ asset('asset/img/lapangan1.webp') }}" alt="Background Fasilitas" loading="lazy" class="w-full h-full object-cover object-center opacity-50">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pointer-events-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Fasilitas</h2>
                <div class="w-20 h-1 bg-green-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Toilet -->
                <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-green-500/50 transition-all duration-300 h-full flex flex-col shadow-2xl hover:shadow-[0_0_30px_rgba(34,197,94,0.15)] hover:-translate-y-2">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400 mb-4 border border-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Toilet</h3>
                    <p class="text-gray-400 text-sm leading-relaxed text-justify">Kamar mandi yang bersih dan terawat untuk menjamin kenyamanan para pengunjung sebelum atau sesudah berolahraga.</p>
                </div>

                <!-- Mushola -->
                <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-green-500/50 transition-all duration-300 h-full flex flex-col shadow-2xl hover:shadow-[0_0_30px_rgba(34,197,94,0.15)] hover:-translate-y-2">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400 mb-4 border border-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Mushola</h3>
                    <p class="text-gray-400 text-sm leading-relaxed text-justify">Fasilitas ibadah yang nyaman dan bersih, dilengkapi dengan tempat wudhu agar ibadah Anda tetap terjaga.</p>
                </div>

                <!-- Kasir -->
                <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-green-500/50 transition-all duration-300 h-full flex flex-col shadow-2xl hover:shadow-[0_0_30px_rgba(34,197,94,0.15)] hover:-translate-y-2">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400 mb-4 border border-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Kasir</h3>
                    <p class="text-gray-400 text-sm leading-relaxed text-justify">Area pelayanan untuk administrasi dan reservasi yang siap melayani dengan proses yang cepat serta ramah.</p>
                </div>

                <!-- Parkiran -->
                <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-green-500/50 transition-all duration-300 h-full flex flex-col shadow-2xl hover:shadow-[0_0_30px_rgba(34,197,94,0.15)] hover:-translate-y-2">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400 mb-4 border border-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Parkiran</h3>
                    <p class="text-gray-400 text-sm leading-relaxed text-justify">Area parkir kendaraan untuk mobil dan motor yang aman, luas, serta sangat mudah diakses oleh pengunjung.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="fields" class="relative pt-64 pb-32 -mt-32 bg-transparent z-10 pointer-events-none">
        <!-- Responsive Background with Glassmorphism and Seamless Mask -->
        <div class="absolute inset-0 z-0" style="mask-image: linear-gradient(to bottom, transparent 0%, black 15%, black 85%, transparent); -webkit-mask-image: linear-gradient(to bottom, transparent 0%, black 15%, black 85%, transparent);">
            <!-- Mobile Background -->
            <img src="{{ asset('asset/img/aboutus.webp') }}" alt="Background Mobile" loading="lazy" class="w-full h-full object-cover object-center md:hidden">
            <!-- Desktop Background -->
            <img src="{{ asset('asset/img/sejarah.webp') }}" alt="Background Desktop" loading="lazy" class="w-full h-full object-cover object-center hidden md:block">
            
            <!-- Glassmorphism Overlay -->
            <div class="absolute inset-0 bg-black/60 backdrop-blur-md"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pointer-events-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Pilih <span class="text-green-400">Arena</span> Kamu</h2>
                <div class="w-20 h-1 bg-green-500 mx-auto rounded-full mb-4"></div>
                <p class="text-gray-400">Pilih lapangan sesuai gaya permainan timmu.</p>
            </div>

        <div class="grid lg:grid-cols-3 gap-8">
            @foreach($fields as $field)
            <div class="group bg-white/5 rounded-[2.5rem] overflow-hidden border border-white/10 hover:border-green-500/30 transition-all duration-500 shadow-2xl" data-field-id="{{ $field->id }}">
                <div class="h-64 overflow-hidden relative">
                    <img src="{{ asset('asset/img/lapangan' . $field->id_field . '.webp') }}" 
                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy"
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

    <section id="contact" class="relative pt-64 pb-32 -mt-32 bg-transparent z-10 pointer-events-none">
        <!-- Background Transition & Glows -->
        <div class="absolute inset-0 z-0 pointer-events-none bg-gradient-to-b from-transparent via-[#050505] to-[#050505]" style="mask-image: linear-gradient(to bottom, transparent 0%, black 15%, black 100%); -webkit-mask-image: linear-gradient(to bottom, transparent 0%, black 15%, black 100%);"></div>
        <div class="absolute top-1/2 left-0 w-96 h-96 bg-green-500/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-green-900/10 rounded-full blur-[150px] pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10 pointer-events-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold mb-4 text-white">Contact <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-600">Us</span></h2>
                <div class="w-20 h-1 bg-green-500 mx-auto rounded-full shadow-[0_0_10px_rgba(34,197,94,0.5)]"></div>
                <p class="text-gray-400 mt-4 max-w-md mx-auto font-medium">Ada pertanyaan, mau collab, atau sekadar kasih komentar?</p>
            </div>

            {{-- Tab Switcher --}}
            <div class="flex justify-center mb-10">
                <div class="inline-flex bg-white/5 border border-white/10 rounded-full p-1.5 gap-1 backdrop-blur-md shadow-lg">
                    <button id="tab-general" onclick="switchTab('general')"
                        class="px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 bg-green-500 text-black shadow-[0_0_20px_rgba(34,197,94,0.3)]">
                        Komentar Umum
                    </button>
                    <button id="tab-collab" onclick="switchTab('collab')"
                        class="px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 text-gray-400 hover:text-white hover:bg-white/10">
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
                    <!-- Info Cards & Interactive Map -->
                    <div class="relative w-full h-[500px] lg:h-auto lg:min-h-[500px] rounded-[2rem] overflow-hidden border border-white/10 group shadow-2xl">
                        <!-- Google Maps iframe -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.7844146059635!2d106.8437021!3d-6.4729864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ea687f799a95%3A0xc58db16e109db14a!2sBoa%20Futsal!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
                            class="absolute inset-0 w-full h-full grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>

                        <!-- Floating Info Card (Dark Glassmorphism) -->
                        <div class="absolute bottom-5 left-5 right-5 lg:right-auto lg:w-[280px] bg-black/60 backdrop-blur-2xl border border-white/10 p-5 rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.5)] transition-transform duration-500 hover:-translate-y-2 text-white">
                            <div class="space-y-4">
                                <!-- Lokasi -->
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 shrink-0 bg-green-500/10 border border-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-white text-xs">Headquarters</h4>
                                        <p class="text-[11px] text-gray-400 leading-relaxed mt-1 font-medium">Jl. Raya Jakarta-Bogor No.KM.39, RT.02/RW.02, Pabuaran, Kec. Cibinong, Bogor 16916</p>
                                    </div>
                                </div>
                                
                                <!-- Phone -->
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 shrink-0 bg-green-500/10 border border-green-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <p class="text-xs text-gray-300 font-bold">02122086938</p>
                                </div>
                                
                                <!-- Email -->
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 shrink-0 bg-green-500/10 border border-green-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-xs text-gray-300 font-bold">info@boafutsal.com</p>
                                </div>

                                <a href="https://maps.google.com/?q=Boa+Futsal" target="_blank" class="block w-full py-2.5 mt-2 bg-green-500 hover:bg-green-400 text-black text-xs font-bold rounded-xl text-center transition-colors">
                                    Get Directions &rarr;
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- General Comment Form -->
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] p-8 shadow-2xl">
                        <h3 class="text-2xl font-extrabold mb-6 text-white">Tinggalkan Komentar</h3>
                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                            @csrf
                            <input type="hidden" name="type" value="general">
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Nama</label>
                                <input type="text" name="name" value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" required
                                    class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium"
                                    placeholder="Nama kamu">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Email</label>
                                <input type="email" name="email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" required
                                    class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium"
                                    placeholder="email@kamu.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Subjek</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" required
                                    class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium"
                                    placeholder="Subjek komentar">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Komentar</label>
                                <textarea name="message" rows="4" required
                                    class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all resize-none font-medium"
                                    placeholder="Tulis komentarmu...">{{ old('message') }}</textarea>
                            </div>
                            <button type="submit"
                                class="w-full py-4 mt-2 bg-gradient-to-r from-green-400 to-green-600 text-black rounded-xl font-extrabold hover:from-green-300 hover:to-green-500 transition-all shadow-[0_0_20px_rgba(34,197,94,0.3)] hover:shadow-[0_0_30px_rgba(34,197,94,0.5)]">
                                Kirim Komentar
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Public Comments --}}
                <div class="mt-16">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-extrabold text-white">Komentar <span class="text-green-400">Pengunjung</span></h3>
                        <span id="comments-count" class="px-3 py-1 bg-white/10 rounded-full text-xs font-bold text-gray-300 border border-white/10"></span>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] p-8 shadow-2xl">
                        <div id="public-comments" class="space-y-5 overflow-y-auto pr-2 custom-scrollbar" style="max-height: 460px;">
                            <div class="text-gray-500 text-sm font-medium text-center py-8">Memuat komentar...</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB: Collab & Sponsorship --}}
            <div id="panel-collab" class="max-w-4xl mx-auto hidden">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-2xl">
                    <div class="mb-10 text-center">
                        <h3 class="text-3xl font-extrabold mb-3 text-white">Collab & <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-600">Sponsorship</span></h3>
                        <p class="text-gray-400 text-sm max-w-lg mx-auto font-medium">Tertarik untuk berkolaborasi atau menjadi sponsor BOA Futsal? Isi form di bawah dan tim kami akan segera menghubungi kamu.</p>
                    </div>
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="type" value="collab">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Nama / Perusahaan</label>
                                <input type="text" name="name" value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" required
                                    class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium"
                                    placeholder="Nama atau perusahaan kamu">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Email</label>
                                <input type="email" name="email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" required
                                    class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium"
                                    placeholder="email@perusahaan.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Jenis Kerjasama</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all font-medium"
                                placeholder="Contoh: Sponsorship Jersey, Event Collab, dll">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-green-400 mb-2 uppercase tracking-widest">Detail Proposal</label>
                            <textarea name="message" rows="6" required
                                class="w-full px-5 py-3.5 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all resize-none font-medium"
                                placeholder="Ceritakan ide kolaborasi atau proposal sponsorship kamu secara detail...">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit"
                            class="w-full py-4 mt-4 bg-gradient-to-r from-green-400 to-green-600 text-black rounded-xl font-extrabold hover:from-green-300 hover:to-green-500 transition-all shadow-[0_0_20px_rgba(34,197,94,0.3)] hover:shadow-[0_0_30px_rgba(34,197,94,0.5)] flex items-center justify-center gap-2">
                            Kirim Proposal
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </form>
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

            // Helper function for session names
            const getSessionName = (timeString) => {
                const hour = parseInt(timeString.substring(0, 2));
                if (hour < 12) return 'Sesi Pagi';
                if (hour < 15) return 'Sesi Siang';
                if (hour < 18) return 'Sesi Sore';
                return 'Sesi Malam';
            };

            // Build price HTML
            let priceHTML = '';

            if (weekdayPrices.length > 0) {
                priceHTML += `
                    <div class="mb-5">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-green-400 font-extrabold text-sm uppercase tracking-widest">Senin - Jumat</p>
                        </div>
                        <div class="space-y-2.5">
                `;
                weekdayPrices.forEach(price => {
                    priceHTML += `
                        <div class="flex items-center justify-between p-3.5 bg-black/40 rounded-xl border border-white/10 hover:border-green-500/50 hover:bg-green-500/5 transition-all group">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-0.5">${getSessionName(price.start_time)}</span>
                                <span class="text-sm font-medium text-gray-200">${price.start_time.substring(0,5)} - ${price.end_time.substring(0,5)} WIB</span>
                            </div>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-base font-extrabold text-white group-hover:text-green-400 transition-colors">Rp ${parseInt(price.price_regular).toLocaleString('id-ID')}</span>
                                <span class="text-xs font-medium text-gray-500">/ Jam</span>
                            </div>
                        </div>
                    `;
                });
                priceHTML += '</div></div>';
            }

            if (weekendPrices.length > 0) {
                priceHTML += `
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            <p class="text-yellow-400 font-extrabold text-sm uppercase tracking-widest">Sabtu - Minggu</p>
                        </div>
                        <div class="space-y-2.5">
                `;
                weekendPrices.forEach(price => {
                    priceHTML += `
                        <div class="flex items-center justify-between p-3.5 bg-black/40 rounded-xl border border-white/10 hover:border-yellow-500/50 hover:bg-yellow-500/5 transition-all group">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-0.5">${getSessionName(price.start_time)}</span>
                                <span class="text-sm font-medium text-gray-200">${price.start_time.substring(0,5)} - ${price.end_time.substring(0,5)} WIB</span>
                            </div>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-base font-extrabold text-white group-hover:text-yellow-400 transition-colors">Rp ${parseInt(price.price_regular).toLocaleString('id-ID')}</span>
                                <span class="text-xs font-medium text-gray-500">/ Jam</span>
                            </div>
                        </div>
                    `;
                });
                priceHTML += '</div></div>';
            }

            modalPriceContent.innerHTML = priceHTML;

            // Set booking button link - everyone can book now
            modalBookingButton.href = `/bookings/create/${fieldId}`;

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
    <footer class="relative pt-32 pb-16 overflow-hidden mt-10">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('asset/img/landing.webp') }}" alt="Footer Background" class="w-full h-full object-cover object-center opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-black/80 to-[#050505]"></div>
        </div>

        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <!-- Glassmorphism Card -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl md:rounded-[2.5rem] p-6 md:p-12 shadow-2xl">
                
                <!-- Main Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 lg:gap-8 mb-10 md:mb-12">
                    
                    <!-- Column 1: Brand -->
                    <div class="lg:pr-4">
                        <a href="#home" class="text-3xl font-extrabold tracking-tighter text-green-400 block mb-5">
                            BOA<span class="text-white">FUTSAL</span>
                        </a>
                        <p class="text-gray-400 text-sm leading-relaxed mb-8">
                            Kami membantu tim Anda merasakan pengalaman bermain di arena futsal premium dengan fasilitas berstandar tinggi.
                        </p>
                        <a href="#fields" class="inline-flex items-center gap-2 text-green-400 font-bold hover:text-white transition-colors group">
                            Booking Lapangan 
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>

                    <!-- Column 2: Navigasi -->
                    <div>
                        <h4 class="text-white font-bold mb-6 tracking-widest uppercase text-xs">Navigasi</h4>
                        <ul class="space-y-4">
                            <li><a href="#home" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Home</a></li>
                            <li><a href="#facilities" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Fasilitas</a></li>
                            <li><a href="#fields" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Lapangan</a></li>
                            <li><a href="#contact" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Hubungi Kami</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Jam Operasional -->
                    <div>
                        <h4 class="text-white font-bold mb-6 tracking-widest uppercase text-xs">Jam Operasional</h4>
                        <ul class="space-y-4">
                            <li>
                                <p class="text-sm font-medium text-gray-400 mb-1">Senin - Jumat</p>
                                <p class="text-sm font-bold text-white">08:00 - 23:00</p>
                            </li>
                            <li>
                                <p class="text-sm font-medium text-gray-400 mb-1">Sabtu - Minggu</p>
                                <p class="text-sm font-bold text-white">07:00 - 24:00</p>
                            </li>
                            <li>
                                <p class="text-sm font-medium text-gray-400 mb-1">Hari Libur</p>
                                <p class="text-sm font-bold text-green-400">Tetap Buka</p>
                            </li>
                        </ul>
                    </div>

                    <!-- Column 4: Contact -->
                    <div>
                        <h4 class="text-white font-bold mb-6 tracking-widest uppercase text-xs">Contact</h4>
                        <ul class="space-y-5">
                            <li class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="text-sm text-gray-300">info@boafutsal.com</span>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <span class="text-sm text-gray-300">021 2208 6938</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span class="text-sm text-gray-300 leading-relaxed">Bogor, Indonesia</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Bar inside Card -->
                <div class="pt-8 border-t border-white/10 flex flex-col lg:flex-row items-center justify-between gap-6">
                    
                    <!-- Tags/Services -->
                    <div class="flex flex-wrap justify-center lg:justify-start items-center gap-3 text-xs text-gray-400 font-medium">
                        <span>Lapangan Sintetis</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                        <span>Lapangan Vinyl</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                        <span>Membership</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                        <span>Turnamen</span>
                    </div>

                    <!-- Social Icons -->
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-gray-400 hover:text-black hover:bg-green-500 hover:border-green-500 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-gray-400 hover:text-black hover:bg-green-500 hover:border-green-500 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.46 2.89 2.89 0 012.9-4.22c.1 0 .21.01.31.02v-3.26c-.1-.01-.2-.02-.31-.02a6.35 6.35 0 00-6.35 6.35c0 3.51 2.84 6.35 6.35 6.35a6.35 6.35 0 006.35-6.35V8.59a8.4 8.4 0 004.18 1.13V6.26c-1.46 0-2.81-.56-3.8-1.5z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-gray-400 hover:text-black hover:bg-green-500 hover:border-green-500 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.94 3.659 1.437 5.634 1.437h.005c6.558 0 11.894-5.335 11.897-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="mt-8 text-center lg:text-left text-gray-500 text-xs font-medium">
                    © 2026 BOA Futsal. All Rights Reserved.
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
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
