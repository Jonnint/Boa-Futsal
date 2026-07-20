<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard') - BOA Futsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Custom Scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(74, 222, 128, 0.3); border-radius: 99px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: rgba(74, 222, 128, 0.6); }
    </style>
</head>
<body class="bg-[#050505] text-white flex min-h-screen overflow-x-hidden">

    <!-- Mobile Header -->
    <div class="lg:hidden fixed top-0 left-0 right-0 h-16 bg-black/50 backdrop-blur-xl border-b border-white/10 z-50 flex items-center justify-between px-4">
        <a href="/dashboard" class="text-xl font-extrabold tracking-tighter text-green-400">
            BOA<span class="text-white">FUTSAL</span>
        </a>
        <button id="mobileMenuBtn" class="p-2 text-gray-400 hover:text-green-400 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-black/40 backdrop-blur-2xl border-r border-white/5 z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">
        
        <!-- Logo -->
        <div class="h-16 lg:h-24 flex items-center px-8 border-b border-white/5 shrink-0 hidden lg:flex">
            <a href="/dashboard" class="text-2xl font-extrabold tracking-tighter text-green-400">
                BOA<span class="text-white">FUTSAL</span> <span class="text-xs text-gray-500 block -mt-1">Member Panel</span>
            </a>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 space-y-2 mt-16 lg:mt-0">
            <p class="px-4 text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Menu Utama</p>
            
            <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('dashboard') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="font-bold text-sm">Dashboard</span>
            </a>

            <a href="/user/membership" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('user/membership') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-bold text-sm">Membership</span>
            </a>

            <a href="/user/diskon" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('user/diskon') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold text-sm">Diskon</span>
            </a>

            <a href="/user/voucher" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('user/voucher') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                <span class="font-bold text-sm">Voucher</span>
            </a>

            <div class="pt-6 pb-2">
                <p class="px-4 text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Sistem</p>
                <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-gray-400 hover:bg-white/5 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-bold text-sm">Kembali ke Web</span>
                </a>
            </div>
        </div>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-white/5 shrink-0">
            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center font-bold text-green-400 uppercase">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-400 truncate">Member</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-xl font-bold transition-all border border-red-500/20 hover:border-red-500 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-30 hidden lg:hidden"></div>

    <!-- Notification Bell -->
    <x-notification-bell />

    <!-- Main Content -->
    <main class="flex-1 lg:ml-72 flex flex-col min-h-screen">
        <div class="flex-1 pt-24 lg:pt-8 pb-12 px-4 md:px-8">
            <div class="container mx-auto max-w-7xl">
                @yield('content')
            </div>
        </div>
    </main>

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', toggleSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', toggleSidebar);
        }
    </script>
    
    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.bg-white\\/5, .shadow-xl').forEach((el, index) => {
                if (!el.hasAttribute('data-aos')) {
                    el.setAttribute('data-aos', 'fade-up');
                    el.setAttribute('data-aos-delay', (index % 5) * 50);
                }
            });
            AOS.init({ duration: 600, once: true, offset: 20 });
        });
    </script>
    @stack('scripts')
    
    @if(session('login_success'))
        <!-- Login Success Toast -->
        <div id="loginToast" class="fixed top-4 md:top-6 right-4 md:right-6 z-[100] transform transition-all duration-700 translate-x-[150%] opacity-0">
            <div class="bg-black/90 backdrop-blur-xl border border-green-500/30 p-4 rounded-2xl shadow-[0_0_30px_rgba(74,222,128,0.2)] flex items-center gap-4">
                <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center shrink-0 border border-green-500/30 animate-pulse">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="pr-4">
                    <h4 class="text-white font-extrabold text-sm tracking-tight">{{ session('login_success') }}</h4>
                    <p class="text-xs text-green-400/80 font-medium">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.getElementById('loginToast');
                if (toast) {
                    // Animate in smoothly
                    setTimeout(() => {
                        toast.classList.remove('translate-x-[150%]', 'opacity-0');
                        toast.classList.add('translate-x-0', 'opacity-100');
                    }, 500);
                    
                    // Animate out gently after 4 seconds
                    setTimeout(() => {
                        toast.classList.remove('translate-x-0', 'opacity-100');
                        toast.classList.add('translate-x-[150%]', 'opacity-0');
                    }, 4500);
                }
            });
        </script>
    @endif
</body>
</html>
