<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Booking - Admin BOA Futsal</title>
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
                    <a href="/admin/dashboard" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">
                        Dashboard
                    </a>
                    <a href="/admin/users" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">
                        Kelola User
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
            <div class="mb-8">
                <h1 class="text-4xl font-extrabold mb-2">Kelola Booking</h1>
                <p class="text-gray-400">Konfirmasi atau batalkan booking dari user</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/10">
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">ID</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">User</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Lapangan</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Tanggal</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Waktu</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Durasi</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Total</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Status</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                <td class="py-4 px-4 text-sm">#{{ $booking->id_booking }}</td>
                                <td class="py-4 px-4">
                                    <div class="text-sm font-bold">{{ $booking->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                                </td>
                                <td class="py-4 px-4 text-sm">{{ $booking->field->name }}</td>
                                <td class="py-4 px-4 text-sm">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                <td class="py-4 px-4 text-sm">{{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}</td>
                                <td class="py-4 px-4 text-sm">{{ $booking->duration_hours }} jam</td>
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
                                <td class="py-4 px-4">
                                    <div class="flex gap-2">
                                        @if($booking->status === 'pending')
                                            <form method="POST" action="/admin/bookings/{{ $booking->id_booking }}/confirm" class="inline">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-green-500/10 text-green-400 rounded-lg text-xs font-bold hover:bg-green-500/20 transition-all">
                                                    Konfirmasi
                                                </button>
                                            </form>
                                            <form method="POST" action="/admin/bookings/{{ $booking->id_booking }}/cancel" class="inline">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-red-500/10 text-red-400 rounded-lg text-xs font-bold hover:bg-red-500/20 transition-all">
                                                    Batalkan
                                                </button>
                                            </form>
                                        @elseif($booking->status === 'confirmed')
                                            <form method="POST" action="/admin/bookings/{{ $booking->id_booking }}/finish" class="inline">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-lg text-xs font-bold hover:bg-blue-500/20 transition-all">
                                                    Selesai Main
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <!-- Delete button for all statuses -->
                                        <form method="POST" action="/admin/bookings/{{ $booking->id_booking }}/delete" class="inline" onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500/10 text-red-400 rounded-lg text-xs font-bold hover:bg-red-500/20 transition-all">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="py-8 text-center text-gray-500">Belum ada booking</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>

</body>
</html>
