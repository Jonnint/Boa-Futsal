@extends('layouts.user')

@section('title', 'Diskon Saya')

@section('content')
<div class="mb-6 md:mb-8">
    <h1 class="text-3xl font-extrabold text-white mb-2">Benefit Diskon</h1>
    <p class="text-gray-400">Nikmati berbagai penawaran dan diskon khusus untuk Anda.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Discount Card -->
    <div class="rounded-[1.5rem] bg-gradient-to-br from-green-500/10 to-transparent border border-green-500/20 p-6 relative overflow-hidden group hover:border-green-500/40 transition-all">
        <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full blur-3xl group-hover:bg-green-500/20 transition-all"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white mb-2">Diskon Member 10%</h2>
            <p class="text-gray-400 text-sm mb-4">Sebagai member aktif, Anda berhak mendapatkan potongan 10% untuk setiap booking lapangan futsal.</p>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold uppercase">
                Otomatis Aktif
            </div>
        </div>
    </div>
</div>
@endsection
