<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - BOA Futsal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        <a href="/admin/dashboard" class="text-xl font-extrabold tracking-tighter text-green-400">
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
            <a href="/admin/dashboard" class="text-2xl font-extrabold tracking-tighter text-green-400">
                BOA<span class="text-white">FUTSAL</span> <span class="text-xs text-gray-500 block -mt-1">Admin Panel</span>
            </a>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 space-y-2 mt-16 lg:mt-0">
            <p class="px-4 text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Menu Utama</p>
            
            <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/dashboard') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="font-bold text-sm">Dashboard</span>
            </a>

            <a href="/admin/bookings" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/bookings') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="font-bold text-sm">Kelola Booking</span>
            </a>

            <a href="/admin/users" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/users*') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="font-bold text-sm">Kelola User</span>
            </a>

            <a href="/admin/messages" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/messages') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <span class="font-bold text-sm">Pesan Masuk (Collab)</span>
                @php $unreadCollab = \App\Models\ContactMessage::where('type', 'collab')->where('status','unread')->count(); @endphp
                @if($unreadCollab > 0)
                    <span class="ml-auto px-2 py-0.5 bg-green-500 text-black text-xs font-extrabold rounded-full">{{ $unreadCollab }}</span>
                @endif
            </a>

            <a href="/admin/comments" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/comments') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                <span class="font-bold text-sm">Komentar Masuk</span>
                @php $unreadComments = \App\Models\ContactMessage::where('type', 'general')->where('status','unread')->count(); @endphp
                @if($unreadComments > 0)
                    <span class="ml-auto px-2 py-0.5 bg-green-500 text-black text-xs font-extrabold rounded-full">{{ $unreadComments }}</span>
                @endif
            </a>

            <div class="pt-6 pb-2">
                <p class="px-4 text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Member & Promo</p>
                
                <a href="/admin/vouchers" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/vouchers*') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <span class="font-bold text-sm">Kelola Voucher</span>
                </a>

                <a href="/admin/notifications" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/notifications*') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="font-bold text-sm">Notifikasi Member</span>
                </a>

                <a href="/admin/membership-payments" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/membership-payments') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="font-bold text-sm">Pembayaran Member</span>
                    @php $pending = \App\Models\MembershipPayment::where('status','pending')->count(); @endphp
                    @if($pending > 0)
                        <span class="ml-auto px-2 py-0.5 bg-yellow-500 text-black text-xs font-extrabold rounded-full">{{ $pending }}</span>
                    @endif
                </a>

                <a href="/admin/chatbot" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/chatbot*') ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <span class="font-bold text-sm">Kelola Chatbot</span>
                </a>
            </div>

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
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400 truncate">Administrator</p>
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
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
</body>
</html>
