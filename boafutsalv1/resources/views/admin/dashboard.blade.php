<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BOA Futsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#050505] text-white">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 py-6 bg-black/20 backdrop-blur-lg border-b border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between">
                <a href="/admin/dashboard" class="text-2xl font-extrabold tracking-tighter text-green-400">
                    BOA<span class="text-white">FUTSAL</span> <span class="text-sm text-gray-500">Admin</span>
                </a>
                
                <div class="flex items-center gap-4">
                    <a href="/" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">
                        Homepage
                    </a>
                    <a href="/admin/bookings" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">
                        Kelola Booking
                    </a>
                    <a href="/admin/users" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">
                        Kelola User
                    </a>
                    <a href="/admin/messages" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors flex items-center gap-1">
                        Pesan Masuk
                        @php $unread = \App\Models\ContactMessage::where('status','unread')->count(); @endphp
                        @if($unread > 0)
                            <span class="px-1.5 py-0.5 bg-green-500 text-black text-xs font-extrabold rounded-full">{{ $unread }}</span>
                        @endif
                    </a>
                    <span class="text-gray-600">|</span>
                    <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 bg-white/5 border border-white/10 text-white rounded-xl font-bold text-sm hover:bg-white/10 transition-all">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-32 pb-20 px-6">
        <div class="container mx-auto max-w-7xl">
            <!-- Welcome Banner -->
            <div class="relative overflow-hidden rounded-[2rem] p-8 md:p-12 bg-gradient-to-br from-green-500/10 via-green-600/5 to-transparent border border-green-500/20 mb-8">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tighter mb-3">
                    Admin <span class="text-green-400">Dashboard</span>
                </h1>
                <p class="text-gray-400 text-lg">
                    Kelola semua booking dan data BOA Futsal
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
                <div class="lg:col-span-2 group relative overflow-hidden rounded-[1.5rem] bg-white/5 border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">{{ $stats['total_bookings'] }}</h3>
                    <p class="text-sm text-gray-400">Total Booking</p>
                </div>

                <div class="lg:col-span-2 group relative overflow-hidden rounded-[1.5rem] bg-white/5 border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">{{ $stats['pending_bookings'] }}</h3>
                    <p class="text-sm text-gray-400">Menunggu Konfirmasi</p>
                </div>

                <div class="lg:col-span-2 group relative overflow-hidden rounded-[1.5rem] bg-white/5 border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">{{ $stats['confirmed_bookings'] }}</h3>
                    <p class="text-sm text-gray-400">Booking Terkonfirmasi</p>
                </div>

                <div class="lg:col-span-3 group relative overflow-hidden rounded-[1.5rem] bg-gradient-to-br from-green-500/20 to-green-600/10 border border-green-500/30 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                    <p class="text-sm text-green-400">Total Pendapatan</p>
                </div>

                <div class="lg:col-span-3 group relative overflow-hidden rounded-[1.5rem] bg-white/5 border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">Rp {{ number_format($stats['pending_revenue'], 0, ',', '.') }}</h3>
                    <p class="text-sm text-gray-400">Pending Revenue</p>
                </div>

                <div class="lg:col-span-2 group relative overflow-hidden rounded-[1.5rem] bg-white/5 border {{ $stats['unread_messages'] > 0 ? 'border-green-500/30' : 'border-white/10' }} p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">{{ $stats['unread_messages'] }}</h3>
                    <p class="text-sm text-gray-400">Pesan Belum Dibaca</p>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-extrabold">Booking Terbaru</h2>
                    <a href="/admin/bookings" class="text-sm text-green-400 hover:text-green-300 transition-colors">
                        Lihat Semua →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/10">
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">ID</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">User</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Lapangan</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Tanggal</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Waktu</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Total</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                <td class="py-4 px-4 text-sm">#{{ $booking->id_booking }}</td>
                                <td class="py-4 px-4 text-sm">{{ $booking->user->name }}</td>
                                <td class="py-4 px-4 text-sm">{{ $booking->field->name }}</td>
                                <td class="py-4 px-4 text-sm">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                <td class="py-4 px-4 text-sm">{{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}</td>
                                <td class="py-4 px-4 text-sm font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                <td class="py-4 px-4">
                                    @if($booking->status === 'pending')
                                        <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded-full text-xs font-bold">Pending</span>
                                    @elseif($booking->status === 'confirmed')
                                        <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-xs font-bold">Confirmed</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-500/10 text-red-400 rounded-full text-xs font-bold">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-gray-500">Belum ada booking</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Recent Messages -->
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8 mt-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-extrabold">Pesan Terbaru</h2>
                    <a href="/admin/messages" class="text-sm text-green-400 hover:text-green-300 transition-colors">Lihat Semua →</a>
                </div>

                @if($recentMessages->isEmpty())
                    <p class="text-center text-gray-500 py-8">Belum ada pesan masuk</p>
                @else
                    <div class="space-y-4">
                        @foreach($recentMessages as $msg)
                            <div class="flex items-start gap-4 p-4 rounded-2xl {{ $msg->status === 'unread' ? 'bg-green-500/5 border border-green-500/20' : 'bg-white/5 border border-white/5' }}">
                                <div class="w-10 h-10 shrink-0 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center font-bold text-green-400 uppercase">
                                    {{ substr($msg->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap mb-0.5">
                                        <span class="font-bold text-sm">{{ $msg->name }}</span>
                                        @if($msg->status === 'unread')
                                            <span class="px-2 py-0.5 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">Baru</span>
                                        @endif
                                        <span class="text-gray-500 text-xs ml-auto">{{ $msg->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-400 text-xs mb-1">{{ $msg->email }}</p>
                                    <p class="text-white text-sm font-semibold">{{ $msg->subject }}</p>
                                    <p class="text-gray-400 text-xs mt-1 truncate">{{ $msg->message }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
