@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
            <!-- Welcome Banner -->
            <div class="relative overflow-hidden rounded-2xl md:rounded-[2rem] p-6 md:p-12 bg-gradient-to-br from-green-500/10 via-green-600/5 to-transparent border border-green-500/20 mb-6 md:mb-8">
                <h1 class="text-3xl md:text-4xl lg:text-6xl font-extrabold leading-tight tracking-tighter mb-2 md:mb-3">
                    Admin <span class="text-green-400">Dashboard</span>
                </h1>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg">
                    Kelola semua booking dan data BOA Futsal
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-6 mb-6 md:mb-8">
                <div class="lg:col-span-2 group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-4 md:p-6">
                    <div class="flex items-center justify-between mb-3 md:mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">{{ $stats['total_bookings'] }}</h3>
                    <p class="text-xs md:text-sm text-gray-400">Total Booking</p>
                </div>

                <div class="lg:col-span-2 group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-4 md:p-6">
                    <div class="flex items-center justify-between mb-3 md:mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">{{ $stats['pending_bookings'] }}</h3>
                    <p class="text-xs md:text-sm text-gray-400">Menunggu Konfirmasi</p>
                </div>

                <div class="lg:col-span-2 group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-4 md:p-6">
                    <div class="flex items-center justify-between mb-3 md:mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">{{ $stats['confirmed_bookings'] }}</h3>
                    <p class="text-xs md:text-sm text-gray-400">Booking Terkonfirmasi</p>
                </div>

                <div class="col-span-2 lg:col-span-3 group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-gradient-to-br from-green-500/20 to-green-600/10 border border-green-500/30 p-4 md:p-6">
                    <div class="flex items-center justify-between mb-3 md:mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                    <p class="text-xs md:text-sm text-green-400">Total Pendapatan</p>
                </div>

                <div class="lg:col-span-2 group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border border-white/10 p-4 md:p-6">
                    <div class="flex items-center justify-between mb-3 md:mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">Rp {{ number_format($stats['pending_revenue'], 0, ',', '.') }}</h3>
                    <p class="text-xs md:text-sm text-gray-400">Pending Revenue</p>
                </div>

                <div class="lg:col-span-1 group relative overflow-hidden rounded-xl md:rounded-[1.5rem] bg-white/5 border {{ $stats['unread_messages'] > 0 ? 'border-green-500/30' : 'border-white/10' }} p-4 md:p-6">
                    <div class="flex items-center justify-between mb-3 md:mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-1">{{ $stats['unread_messages'] }}</h3>
                    <p class="text-xs md:text-sm text-gray-400">Pesan Belum Dibaca</p>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-4 md:p-8">
                <div class="flex items-center justify-between mb-4 md:mb-6">
                    <h2 class="text-xl md:text-2xl font-extrabold">Booking Terbaru</h2>
                    <a href="/admin/bookings" class="text-xs md:text-sm text-green-400 hover:text-green-300 transition-colors">
                        Lihat Semua →
                    </a>
                </div>

                <div class="overflow-x-auto -mx-4 md:mx-0">
                    <div class="inline-block min-w-full align-middle px-4 md:px-0">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400">ID</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400">User</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 hidden sm:table-cell">Lapangan</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 hidden md:table-cell">Tanggal</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 hidden lg:table-cell">Waktu</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400">Total</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm">#{{ $booking->id_booking }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm">
                                        @if($booking->booking_type === 'guest')
                                            <span class="flex items-center gap-1">
                                                {{ $booking->guest_name }}
                                                <span class="px-1.5 py-0.5 bg-blue-500/10 text-blue-400 rounded text-[8px] font-bold">GUEST</span>
                                            </span>
                                        @else
                                            {{ $booking->user->name }}
                                        @endif
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm hidden sm:table-cell">{{ $booking->field->name }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm hidden md:table-cell">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm hidden lg:table-cell">{{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4">
                                        @if($booking->status === 'pending')
                                            <span class="px-2 md:px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded-full text-xs font-bold">Pending</span>
                                        @elseif($booking->status === 'confirmed')
                                            <span class="px-2 md:px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-xs font-bold">Confirmed</span>
                                        @else
                                            <span class="px-2 md:px-3 py-1 bg-red-500/10 text-red-400 rounded-full text-xs font-bold">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-gray-500 text-sm">Belum ada booking</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Messages -->
            <div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-4 md:p-8 mt-6 md:mt-8">
                <div class="flex items-center justify-between mb-4 md:mb-6">
                    <h2 class="text-xl md:text-2xl font-extrabold">Pesan Terbaru</h2>
                    <a href="/admin/messages" class="text-xs md:text-sm text-green-400 hover:text-green-300 transition-colors">Lihat Semua →</a>
                </div>

                @if($recentMessages->isEmpty())
                    <p class="text-center text-gray-500 py-8 text-sm">Belum ada pesan masuk</p>
                @else
                    <div class="space-y-3 md:space-y-4">
                        @foreach($recentMessages as $msg)
                            <div class="flex items-start gap-3 md:gap-4 p-3 md:p-4 rounded-xl md:rounded-2xl {{ $msg->status === 'unread' ? 'bg-green-500/5 border border-green-500/20' : 'bg-white/5 border border-white/5' }}">
                                <div class="w-8 h-8 md:w-10 md:h-10 shrink-0 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center font-bold text-green-400 uppercase text-sm md:text-base">
                                    {{ substr($msg->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap mb-0.5">
                                        <span class="font-bold text-xs md:text-sm truncate">{{ $msg->name }}</span>
                                        @if($msg->status === 'unread')
                                            <span class="px-2 py-0.5 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">Baru</span>
                                        @endif
                                        <span class="text-gray-500 text-xs ml-auto shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-400 text-xs mb-1 truncate">{{ $msg->email }}</p>
                                    <p class="text-white text-xs md:text-sm font-semibold truncate">{{ $msg->subject }}</p>
                                    <p class="text-gray-400 text-xs mt-1 truncate">{{ $msg->message }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
@endsection
