<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BOA Futsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glow-green { box-shadow: 0 0 20px rgba(74, 222, 128, 0.2); }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black">

    <x-public-navbar simple="true" backUrl="/" backText="Homepage" />



    <!-- Main Content -->
    <div class="pt-24 md:pt-32 pb-12 md:pb-20 px-4 md:px-6">
        <div class="container mx-auto max-w-7xl">
            <!-- Welcome Banner -->
            <div class="relative overflow-hidden rounded-2xl md:rounded-[2rem] p-6 md:p-12 bg-gradient-to-br from-green-500/10 via-green-600/5 to-transparent border border-green-500/20 mb-6 md:mb-8">
                <div class="absolute top-0 -left-20 w-96 h-96 bg-green-600/10 rounded-full blur-[120px]"></div>
                <div class="absolute bottom-0 -right-20 w-96 h-96 bg-green-900/10 rounded-full blur-[120px]"></div>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold uppercase tracking-widest mb-3 md:mb-4">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        Member Active
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-6xl font-extrabold leading-tight tracking-tighter mb-2 md:mb-3">
                        Halo, <span class="text-green-400">{{ Auth::user()->name }}</span>! 👋
                    </h1>
                    <p class="text-gray-400 text-base md:text-lg lg:text-xl max-w-2xl">
                        Selamat datang di dashboard BOA Futsal. Kelola booking dan profil kamu di sini.
                    </p>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
                <div class="group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-4 md:p-6 hover:border-green-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-full blur-3xl group-hover:bg-green-500/10 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-3 md:mb-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500 uppercase tracking-wider">Total</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">{{ $stats['total_bookings'] }}</h3>
                        <p class="text-xs md:text-sm text-gray-400">Total Booking</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-4 md:p-6 hover:border-yellow-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/5 rounded-full blur-3xl group-hover:bg-yellow-500/10 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-3 md:mb-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500 uppercase tracking-wider">Active</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">{{ $stats['active_bookings'] }}</h3>
                        <p class="text-xs md:text-sm text-gray-400">Booking Aktif</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-4 md:p-6 hover:border-blue-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full blur-3xl group-hover:bg-blue-500/10 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-3 md:mb-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-500/10 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500 uppercase tracking-wider">Spent</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</h3>
                        <p class="text-xs md:text-sm text-gray-400">Total Pengeluaran</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div>
                <div class="flex items-center gap-3 mb-4 md:mb-6">
                    <h2 class="text-xl md:text-2xl font-extrabold tracking-tight">Quick Actions</h2>
                    <div class="flex-1 h-px bg-gradient-to-r from-white/10 to-transparent"></div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                    <a href="/" class="group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-gradient-to-br from-green-500 to-green-600 p-6 md:p-8 hover:scale-[1.02] transition-all duration-300 glow-green sm:col-span-2 md:col-span-1">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-3 md:mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-white mb-1 md:mb-2">Booking Baru</h3>
                            <p class="text-green-50 text-sm">Pesan lapangan sekarang juga</p>
                        </div>
                    </a>

                    <a href="{{ route('bookings.index') }}" class="group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-6 md:p-8 hover:border-white/20 hover:bg-white/[0.07] transition-all duration-300">
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center mb-3 md:mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 md:w-7 md:h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-white mb-1 md:mb-2">Riwayat Booking</h3>
                        <p class="text-gray-400 text-sm">Lihat semua booking kamu</p>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-6 md:p-8 hover:border-white/20 hover:bg-white/[0.07] transition-all duration-300">
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-purple-500/10 rounded-2xl flex items-center justify-center mb-3 md:mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 md:w-7 md:h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-white mb-1 md:mb-2">Profil Saya</h3>
                        <p class="text-gray-400 text-sm">Edit informasi akun</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
