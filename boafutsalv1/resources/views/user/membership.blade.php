@extends('layouts.user')

@section('title', 'Membership')

@section('content')
<div class="mb-6 md:mb-8">
    <h1 class="text-3xl font-extrabold text-white mb-2">Membership Saya</h1>
    <p class="text-gray-400">Kelola status dan informasi membership Anda.</p>
</div>

<!-- Membership Info Card -->
<div class="mb-6 md:mb-8 rounded-[1.5rem] bg-gradient-to-r from-green-600/20 to-green-900/10 border border-green-500/20 p-6 flex flex-col md:flex-row items-center justify-between gap-6 glow-green relative overflow-hidden">
    <div class="absolute right-0 top-0 w-64 h-full bg-green-500/5 blur-3xl rounded-full"></div>
    <div class="flex items-center gap-5 relative z-10">
        <div class="w-14 h-14 bg-green-500/20 rounded-2xl flex items-center justify-center shrink-0 border border-green-500/30">
            <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-white mb-1">Status Member Aktif</h2>
            <p class="text-sm text-gray-400">Terima kasih telah bergabung menjadi keluarga besar BOA Futsal.</p>
        </div>
    </div>
    <div class="flex flex-row gap-6 w-full md:w-auto bg-black/30 p-4 rounded-xl border border-white/5 relative z-10">
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Masa Aktif s/d</p>
            <p class="font-bold text-white text-lg">{{ Auth::user()->is_member ? now()->addYear()->format('d M Y') : '-' }}</p>
        </div>
        <div class="w-px bg-white/10"></div>
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Benefit Diskon</p>
            <p class="font-extrabold text-green-400 text-lg">10% OFF</p>
        </div>
    </div>
</div>
@endsection
