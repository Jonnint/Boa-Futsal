@extends('layouts.admin')

@section('title', 'Kelola Booking')

@section('content')
            <div class="mb-4 md:mb-8">
                <h1 class="text-2xl md:text-4xl font-extrabold mb-2">Kelola Booking</h1>
                <p class="text-sm md:text-base text-gray-400">Konfirmasi atau batalkan booking dari user</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-4 md:p-8">
                <div class="overflow-x-auto -mx-4 md:mx-0">
                    <div class="inline-block min-w-full align-middle px-4 md:px-0">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap hidden md:table-cell">ID</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">User</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap hidden sm:table-cell">Lapangan</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">Tanggal</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap hidden lg:table-cell">Waktu</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap hidden lg:table-cell">Durasi</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">Total</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">Status</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm whitespace-nowrap hidden md:table-cell">#{{ $booking->id_booking }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 whitespace-nowrap">
                                        <div class="text-xs md:text-sm font-bold">{{ $booking->user->name }}</div>
                                        <div class="text-[10px] md:text-xs text-gray-500">{{ $booking->user->email }}</div>
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm whitespace-nowrap hidden sm:table-cell">{{ $booking->field->name }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M y') }}
                                        <div class="lg:hidden text-[10px] text-gray-500 mt-0.5">{{ date('H:i', strtotime($booking->start_time)) }}</div>
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm whitespace-nowrap hidden lg:table-cell">{{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm whitespace-nowrap hidden lg:table-cell">{{ $booking->duration_hours }} jam</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm font-bold whitespace-nowrap">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 whitespace-nowrap">
                                        @if($booking->status === 'pending')
                                            <span class="px-2 py-1 md:px-3 md:py-1 bg-yellow-500/10 text-yellow-400 rounded-full text-[10px] md:text-xs font-bold">Pending</span>
                                        @elseif($booking->status === 'confirmed')
                                            <span class="px-2 py-1 md:px-3 md:py-1 bg-green-500/10 text-green-400 rounded-full text-[10px] md:text-xs font-bold">Confirmed</span>
                                        @else
                                            <span class="px-2 py-1 md:px-3 md:py-1 bg-red-500/10 text-red-400 rounded-full text-[10px] md:text-xs font-bold">Cancelled</span>
                                        @endif
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 whitespace-nowrap">
                                        <div class="flex gap-2">
                                            @if($booking->status === 'pending')
                                                <form method="POST" action="/admin/bookings/{{ $booking->id_booking }}/confirm" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-2 py-1 md:px-3 md:py-1 bg-green-500/10 text-green-400 rounded-lg text-[10px] md:text-xs font-bold hover:bg-green-500/20 transition-all">
                                                        ✔
                                                        <span class="hidden md:inline ml-1">Konfirmasi</span>
                                                    </button>
                                                </form>
                                                <form method="POST" action="/admin/bookings/{{ $booking->id_booking }}/cancel" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-2 py-1 md:px-3 md:py-1 bg-red-500/10 text-red-400 rounded-lg text-[10px] md:text-xs font-bold hover:bg-red-500/20 transition-all">
                                                        ✖
                                                        <span class="hidden md:inline ml-1">Batal</span>
                                                    </button>
                                                </form>
                                            @elseif($booking->status === 'confirmed')
                                                <form method="POST" action="/admin/bookings/{{ $booking->id_booking }}/finish" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-2 py-1 md:px-3 md:py-1 bg-blue-500/10 text-blue-400 rounded-lg text-[10px] md:text-xs font-bold hover:bg-blue-500/20 transition-all">
                                                        Selesai
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <!-- Delete button for all statuses -->
                                            <form method="POST" action="/admin/bookings/{{ $booking->id_booking }}/delete" class="inline" onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 md:px-3 md:py-1 bg-red-500/10 text-red-400 rounded-lg text-[10px] md:text-xs font-bold hover:bg-red-500/20 transition-all">
                                                    🗑
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="py-8 text-center text-[10px] md:text-sm text-gray-500">Belum ada booking</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            </div>
@endsection
