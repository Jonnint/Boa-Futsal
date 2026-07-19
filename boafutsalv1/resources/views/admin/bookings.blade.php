@extends('layouts.admin')

@section('title', 'Kelola Booking')

@section('content')
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl md:text-4xl font-extrabold mb-2 text-white">Kelola Booking</h1>
                    <p class="text-sm md:text-base text-gray-400">Konfirmasi atau batalkan booking penyewaan lapangan</p>
                </div>
                
                <!-- Filter or action placeholder (Optional) -->
                <div class="flex items-center gap-2">
                    <div class="px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-sm font-medium text-gray-400 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Semua Status
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-4 md:p-8 backdrop-blur-xl shadow-2xl">
                <div class="overflow-x-auto -mx-4 md:mx-0">
                    <!-- Desktop Table View -->
                    <div class="hidden lg:block min-w-full align-middle px-4 md:px-0">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">ID</th>
                                    <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Customer</th>
                                    <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Jadwal & Lapangan</th>
                                    <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status & Harga</th>
                                    <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($bookings as $booking)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="py-5 px-4 whitespace-nowrap">
                                        <span class="text-sm font-bold text-gray-500 group-hover:text-gray-300 transition-colors">#{{ $booking->id_booking }}</span>
                                    </td>
                                    <td class="py-5 px-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <!-- Avatar -->
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500/20 to-purple-500/20 border border-blue-500/30 flex items-center justify-center text-blue-400 font-extrabold text-sm shadow-sm">
                                                @if($booking->booking_type === 'guest')
                                                    {{ strtoupper(substr($booking->guest_name, 0, 1)) }}
                                                @else
                                                    {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                                @endif
                                            </div>
                                            <!-- Info -->
                                            <div>
                                                <div class="text-sm font-bold text-white group-hover:text-green-400 transition-colors flex items-center gap-2">
                                                    @if($booking->booking_type === 'guest')
                                                        {{ $booking->guest_name }}
                                                        <span class="px-2 py-0.5 bg-purple-500/10 border border-purple-500/20 text-purple-400 rounded-full text-[9px] font-extrabold uppercase">Guest</span>
                                                    @else
                                                        {{ $booking->user->name }}
                                                        <span class="px-2 py-0.5 bg-green-500/10 border border-green-500/20 text-green-400 rounded-full text-[9px] font-extrabold uppercase">Member</span>
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-400 mt-0.5">
                                                    {{ $booking->booking_type === 'guest' ? $booking->guest_email : $booking->user->email }}
                                                </div>
                                                <div class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                    {{ $booking->booking_type === 'guest' ? $booking->guest_phone : $booking->user->phone }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5 px-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <div class="text-sm font-bold text-white mb-1">{{ $booking->field->name }}</div>
                                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5 px-4 whitespace-nowrap">
                                        <div class="flex flex-col items-start gap-2">
                                            <!-- Status Badge -->
                                            @if($booking->status === 'pending')
                                                <span class="px-3 py-1 bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 rounded-full text-xs font-bold shadow-sm flex items-center gap-1">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse"></span>
                                                    Pending
                                                </span>
                                            @elseif($booking->status === 'confirmed')
                                                <span class="px-3 py-1 bg-green-500/10 border border-green-500/30 text-green-400 rounded-full text-xs font-bold shadow-sm flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    Confirmed
                                                </span>
                                            @else
                                                <span class="px-3 py-1 bg-red-500/10 border border-red-500/30 text-red-400 rounded-full text-xs font-bold shadow-sm flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    Cancelled
                                                </span>
                                            @endif
                                            <!-- Price -->
                                            <div class="text-sm font-extrabold text-white">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                        </div>
                                    </td>
                                    <td class="py-5 px-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            @if($booking->status === 'pending')
                                                <!-- Confirm Button -->
                                                <form method="POST" action="{{ route('admin.bookings.update-status', [$booking->id_booking, 'confirmed']) }}" class="inline" onsubmit="return confirm('Konfirmasi booking ini?')">
                                                    @csrf
                                                    <button type="submit" class="p-2 bg-green-500/10 text-green-400 rounded-lg hover:bg-green-500 hover:text-white transition-all shadow-[0_0_10px_rgba(34,197,94,0)] hover:shadow-[0_0_15px_rgba(34,197,94,0.5)]" title="Konfirmasi Booking">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    </button>
                                                </form>
                                                <!-- Cancel Button -->
                                                <form method="POST" action="{{ route('admin.bookings.update-status', [$booking->id_booking, 'cancelled']) }}" class="inline" onsubmit="return confirm('Batalkan booking ini?')">
                                                    @csrf
                                                    <button type="submit" class="p-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-[0_0_10px_rgba(239,68,68,0)] hover:shadow-[0_0_15px_rgba(239,68,68,0.5)]" title="Batalkan Booking">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id_booking) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus data booking ini secara permanen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-gray-500/10 text-gray-400 rounded-lg hover:bg-red-500 hover:text-white transition-all ml-2" title="Hapus Permanen">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-16 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg class="w-16 h-16 mb-4 text-gray-600/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                            <p class="text-lg font-medium">Belum ada booking yang masuk</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards View -->
                    <div class="block lg:hidden space-y-4 px-4">
                        @forelse($bookings as $booking)
                            <div class="bg-black/40 border border-white/5 rounded-2xl p-5 flex flex-col gap-4 shadow-lg">
                                <!-- Top: ID & Status -->
                                <div class="flex items-center justify-between border-b border-white/5 pb-3">
                                    <span class="text-sm font-extrabold text-gray-400">#{{ $booking->id_booking }}</span>
                                    @if($booking->status === 'pending')
                                        <span class="px-3 py-1 bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 rounded-full text-xs font-bold flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse"></span> Pending
                                        </span>
                                    @elseif($booking->status === 'confirmed')
                                        <span class="px-3 py-1 bg-green-500/10 border border-green-500/30 text-green-400 rounded-full text-xs font-bold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Confirmed
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-red-500/10 border border-red-500/30 text-red-400 rounded-full text-xs font-bold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancelled
                                        </span>
                                    @endif
                                </div>

                                <!-- Middle: Customer Info -->
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500/20 to-purple-500/20 border border-blue-500/30 flex items-center justify-center text-blue-400 font-extrabold text-lg shrink-0">
                                        @if($booking->booking_type === 'guest')
                                            {{ strtoupper(substr($booking->guest_name, 0, 1)) }}
                                        @else
                                            {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div class="overflow-hidden">
                                        <div class="text-base font-bold text-white truncate flex items-center gap-2">
                                            @if($booking->booking_type === 'guest')
                                                {{ $booking->guest_name }} <span class="px-2 py-0.5 bg-purple-500/10 text-purple-400 rounded-full text-[9px] font-extrabold uppercase shrink-0">Guest</span>
                                            @else
                                                {{ $booking->user->name }} <span class="px-2 py-0.5 bg-green-500/10 text-green-400 rounded-full text-[9px] font-extrabold uppercase shrink-0">Member</span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-400 truncate mt-0.5">{{ $booking->booking_type === 'guest' ? $booking->guest_email : $booking->user->email }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            {{ $booking->booking_type === 'guest' ? $booking->guest_phone : $booking->user->phone }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Schedule & Price -->
                                <div class="bg-white/5 rounded-xl p-3 grid grid-cols-2 gap-3 border border-white/5">
                                    <div>
                                        <div class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-1">Lapangan</div>
                                        <div class="text-sm font-bold text-white">{{ $booking->field->name }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-1">Total Harga</div>
                                        <div class="text-sm font-extrabold text-green-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-span-2 flex items-center gap-4 text-xs text-gray-300 bg-black/30 p-2 rounded-lg">
                                        <div class="flex items-center gap-1.5 font-medium">
                                            <svg class="w-3.5 h-3.5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M y') }}
                                        </div>
                                        <div class="flex items-center gap-1.5 font-medium">
                                            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="pt-3 border-t border-white/5 flex items-center justify-end gap-2">
                                    @if($booking->status === 'pending')
                                        <form method="POST" action="{{ route('admin.bookings.update-status', [$booking->id_booking, 'confirmed']) }}" class="flex-1" onsubmit="return confirm('Konfirmasi booking ini?')">
                                            @csrf
                                            <button type="submit" class="w-full py-2.5 bg-green-500/10 text-green-400 rounded-lg text-sm font-bold hover:bg-green-500 hover:text-white transition-colors border border-green-500/20 flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Konfirmasi
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.bookings.update-status', [$booking->id_booking, 'cancelled']) }}" class="flex-1" onsubmit="return confirm('Batalkan booking ini?')">
                                            @csrf
                                            <button type="submit" class="w-full py-2.5 bg-red-500/10 text-red-400 rounded-lg text-sm font-bold hover:bg-red-500 hover:text-white transition-colors border border-red-500/20 flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Batalkan
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id_booking) }}" class="{{ $booking->status === 'pending' ? 'shrink-0' : 'flex-1' }}" onsubmit="return confirm('Yakin ingin menghapus data booking ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="{{ $booking->status === 'pending' ? 'p-2.5' : 'w-full py-2.5 flex items-center justify-center gap-2' }} bg-gray-500/10 text-gray-400 rounded-lg text-sm font-bold hover:bg-red-500 hover:text-white transition-colors border border-gray-500/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            @if($booking->status !== 'pending') Hapus Data @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="py-10 text-center bg-black/20 rounded-2xl border border-white/5">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-600/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                <p class="text-sm font-medium text-gray-500">Belum ada booking yang masuk</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
@endsection
