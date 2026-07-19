@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
            <!-- Welcome Banner -->
            <div class="relative overflow-hidden rounded-3xl p-8 md:p-14 bg-white/5 border border-white/10 backdrop-blur-xl shadow-2xl mb-8 group">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 via-transparent to-transparent opacity-50 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold leading-tight tracking-tighter mb-2 text-white">
                            Admin <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-600">Dashboard</span>
                        </h1>
                        <p class="text-gray-400 text-base lg:text-xl font-medium">
                            Kelola semua aktivitas dan performa BOA Futsal
                        </p>
                    </div>
                    <div class="hidden md:flex items-center justify-center w-24 h-24 rounded-full bg-green-500/10 border border-green-500/20 shadow-[0_0_30px_rgba(34,197,94,0.2)]">
                        <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6 mb-8">
                <!-- Total Booking -->
                <div class="col-span-2 lg:col-span-2 group relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-6 hover:-translate-y-1 hover:shadow-[0_10px_40px_-10px_rgba(34,197,94,0.3)] hover:border-green-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center group-hover:bg-green-500/20 transition-colors">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">{{ $stats['total_bookings'] }}</h3>
                    <p class="text-sm text-gray-400 font-medium">Total Booking</p>
                </div>

                <!-- Menunggu Konfirmasi -->
                <div class="col-span-2 lg:col-span-2 group relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-6 hover:-translate-y-1 hover:shadow-[0_10px_40px_-10px_rgba(234,179,8,0.3)] hover:border-yellow-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center group-hover:bg-yellow-500/20 transition-colors">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">{{ $stats['pending_bookings'] }}</h3>
                    <p class="text-sm text-gray-400 font-medium">Menunggu Konfirmasi</p>
                </div>

                <!-- Booking Terkonfirmasi -->
                <div class="col-span-2 lg:col-span-2 group relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-6 hover:-translate-y-1 hover:shadow-[0_10px_40px_-10px_rgba(59,130,246,0.3)] hover:border-blue-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center group-hover:bg-blue-500/20 transition-colors">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">{{ $stats['confirmed_bookings'] }}</h3>
                    <p class="text-sm text-gray-400 font-medium">Booking Terkonfirmasi</p>
                </div>

                <!-- Total Pendapatan -->
                <div class="col-span-2 lg:col-span-3 group relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-500/20 to-green-600/5 border border-green-500/30 p-6 hover:-translate-y-1 hover:shadow-[0_10px_40px_-10px_rgba(34,197,94,0.4)] transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center group-hover:bg-green-500/30 transition-colors">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                    <p class="text-sm text-green-400 font-bold">Total Pendapatan</p>
                </div>

                <!-- Pending Revenue -->
                <div class="col-span-2 lg:col-span-2 group relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-6 hover:-translate-y-1 hover:shadow-[0_10px_40px_-10px_rgba(168,85,247,0.3)] hover:border-purple-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center group-hover:bg-purple-500/20 transition-colors">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">Rp {{ number_format($stats['pending_revenue'], 0, ',', '.') }}</h3>
                    <p class="text-sm text-gray-400 font-medium">Pending Revenue</p>
                </div>

                <!-- Unread Messages -->
                <div class="col-span-2 lg:col-span-1 group relative overflow-hidden rounded-2xl bg-white/5 border {{ $stats['unread_messages'] > 0 ? 'border-green-500/50 shadow-[0_0_20px_rgba(34,197,94,0.15)]' : 'border-white/10' }} p-6 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-1">{{ $stats['unread_messages'] }}</h3>
                    <p class="text-sm text-gray-400 font-medium">Pesan Baru</p>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Recent Bookings -->
                <div class="xl:col-span-2 bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl flex flex-col">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-extrabold text-white">Booking Terbaru</h2>
                        <a href="/admin/bookings" class="flex items-center gap-2 text-sm font-bold text-green-400 hover:text-green-300 transition-colors">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>

                    <div class="overflow-x-auto -mx-6 md:mx-0 flex-1">
                        <div class="inline-block min-w-full align-middle px-6 md:px-0">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-white/10">
                                        <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Customer</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider hidden sm:table-cell">Jadwal</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @forelse($recentBookings as $booking)
                                    <tr class="hover:bg-white/5 transition-colors group">
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400/20 to-green-600/20 border border-green-500/30 flex items-center justify-center text-green-400 font-extrabold text-sm">
                                                    @if($booking->booking_type === 'guest')
                                                        {{ strtoupper(substr($booking->guest_name, 0, 1)) }}
                                                    @else
                                                        {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-white group-hover:text-green-400 transition-colors">
                                                        @if($booking->booking_type === 'guest')
                                                            {{ $booking->guest_name }} <span class="ml-1 px-1.5 py-0.5 bg-blue-500/20 text-blue-400 rounded text-[9px] font-extrabold uppercase">Guest</span>
                                                        @else
                                                            {{ $booking->user->name }}
                                                        @endif
                                                    </div>
                                                    <div class="text-xs text-gray-400 mt-0.5">{{ $booking->field->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap hidden sm:table-cell">
                                            <div class="text-sm text-white font-medium">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            @if($booking->status === 'pending')
                                                <span class="px-3 py-1 bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 rounded-full text-xs font-bold shadow-sm">Pending</span>
                                            @elseif($booking->status === 'confirmed')
                                                <span class="px-3 py-1 bg-green-500/10 border border-green-500/30 text-green-400 rounded-full text-xs font-bold shadow-sm">Confirmed</span>
                                            @else
                                                <span class="px-3 py-1 bg-red-500/10 border border-red-500/30 text-red-400 rounded-full text-xs font-bold shadow-sm">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap text-right">
                                            <span class="text-sm font-extrabold text-white group-hover:text-green-400 transition-colors">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-500">
                                                <svg class="w-12 h-12 mb-3 text-gray-600/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                                <p class="text-sm font-medium">Belum ada booking terbaru</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Messages -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl flex flex-col">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-extrabold text-white">Pesan Masuk</h2>
                        <a href="/admin/messages" class="flex items-center gap-2 text-sm font-bold text-green-400 hover:text-green-300 transition-colors">
                            Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7-7m7-7H3"></path></svg>
                        </a>
                    </div>

                    @if($recentMessages->isEmpty())
                        <div class="flex-1 flex flex-col items-center justify-center text-gray-500 py-12">
                            <svg class="w-12 h-12 mb-3 text-gray-600/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <p class="text-sm font-medium">Belum ada pesan</p>
                        </div>
                    @else
                        <div class="space-y-4 flex-1">
                            @foreach($recentMessages as $msg)
                                <a href="/admin/messages" class="block group">
                                    <div class="flex items-start gap-4 p-4 rounded-2xl transition-all duration-300 {{ $msg->status === 'unread' ? 'bg-green-500/10 border-l-2 border-green-500 shadow-lg' : 'bg-white/5 border-l-2 border-transparent hover:bg-white/10' }}">
                                        <div class="w-10 h-10 shrink-0 rounded-full bg-white/10 flex items-center justify-center font-bold text-white uppercase text-sm group-hover:bg-green-500/20 group-hover:text-green-400 transition-colors">
                                            {{ substr($msg->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="font-bold text-sm text-white group-hover:text-green-400 transition-colors truncate pr-2">{{ $msg->name }}</span>
                                                <span class="text-gray-500 text-[10px] shrink-0 whitespace-nowrap">{{ $msg->created_at->shortAbsoluteDiffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-300 text-xs font-semibold truncate mb-1">{{ $msg->subject }}</p>
                                            <p class="text-gray-500 text-xs truncate">{{ $msg->message }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
@endsection
