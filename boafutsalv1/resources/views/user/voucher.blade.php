@extends('layouts.user')

@section('title', 'Voucher Saya')

@section('content')
<div class="mb-6 md:mb-8">
    <h1 class="text-3xl font-extrabold text-white mb-2">Voucher Saya</h1>
    <p class="text-gray-400">Kumpulan voucher yang bisa Anda gunakan saat booking.</p>
</div>

@php
    // Fetch active vouchers (since we don't pass it from route directly to keep it simple, we can fetch here or just use empty state)
    $vouchers = \App\Models\Voucher::where('is_active', true)
        ->where('valid_until', '>=', now())
        ->get();
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($vouchers as $voucher)
        <div class="rounded-2xl bg-white/5 border border-white/10 p-6 relative overflow-hidden group hover:border-yellow-500/40 transition-all">
            <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/5 rounded-full blur-3xl group-hover:bg-yellow-500/10 transition-all"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                    </div>
                    <span class="px-2 py-1 bg-yellow-500/10 text-yellow-400 text-xs font-bold rounded-lg border border-yellow-500/20">
                        {{ $voucher->type === 'percentage' ? $voucher->value . '%' : 'Rp ' . number_format($voucher->value, 0, ',', '.') }}
                    </span>
                </div>
                
                <h3 class="text-xl font-bold text-white mb-1">{{ $voucher->name }}</h3>
                <p class="text-sm text-gray-400 mb-4 line-clamp-2">{{ $voucher->description ?? 'Gunakan kode voucher ini saat melakukan booking lapangan.' }}</p>
                
                <div class="bg-black/30 rounded-lg p-3 border border-white/5 flex justify-between items-center">
                    <span class="font-mono font-bold tracking-widest text-white">{{ $voucher->code }}</span>
                    <button onclick="navigator.clipboard.writeText('{{ $voucher->code }}'); alert('Kode disalin!');" class="text-yellow-400 hover:text-yellow-300 text-sm font-bold">
                        Salin
                    </button>
                </div>
                
                <div class="mt-4 text-xs text-gray-500 flex justify-between">
                    <span>Min. Transaksi: Rp {{ number_format($voucher->min_purchase ?? 0, 0, ',', '.') }}</span>
                    <span>S/d: {{ \Carbon\Carbon::parse($voucher->valid_until)->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full py-12 flex flex-col items-center justify-center text-center bg-white/5 rounded-2xl border border-white/10 border-dashed">
            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-1">Belum Ada Voucher</h3>
            <p class="text-gray-400 text-sm max-w-sm">Saat ini belum ada voucher promo yang tersedia. Cek kembali nanti untuk penawaran menarik!</p>
        </div>
    @endforelse
</div>
@endsection
