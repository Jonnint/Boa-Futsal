@extends('layouts.admin')

@section('title', 'Kelola Notifikasi Member')

@section('content')
<div class="mb-6 md:mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-white mb-2 tracking-tight">Notifikasi Member</h1>
        <p class="text-sm md:text-base text-gray-400">Kirim dan kelola pemberitahuan, info, serta promo untuk member.</p>
    </div>
    <a href="{{ route('admin.notifications.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-500 hover:bg-green-400 text-black rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(74,222,128,0.3)] hover:shadow-[0_0_30px_rgba(74,222,128,0.5)] w-full md:w-auto">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Kirim Notifikasi
    </a>
</div>

@if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="font-bold">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[1.5rem] overflow-hidden">
    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-black/40 border-b border-white/5 uppercase text-xs font-extrabold tracking-wider text-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-4 rounded-tl-[1.5rem]">Penerima</th>
                    <th scope="col" class="px-6 py-4">Tipe</th>
                    <th scope="col" class="px-6 py-4">Pesan</th>
                    <th scope="col" class="px-6 py-4">Terkait Voucher</th>
                    <th scope="col" class="px-6 py-4">Tanggal Kirim</th>
                    <th scope="col" class="px-6 py-4 rounded-tr-[1.5rem] text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($notifications as $notification)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4">
                            @if($notification->user_id)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center font-bold text-blue-400">
                                        {{ substr($notification->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="font-bold text-white">{{ $notification->user->name ?? 'Member' }}</span>
                                </div>
                            @else
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center font-bold text-purple-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <span class="font-bold text-purple-400">Semua Member</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($notification->type === 'promo')
                                <span class="px-3 py-1 bg-green-500/10 text-green-400 text-xs font-bold rounded-lg border border-green-500/20">Promo</span>
                            @elseif($notification->type === 'warning')
                                <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 text-xs font-bold rounded-lg border border-yellow-500/20">Peringatan</span>
                            @else
                                <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-xs font-bold rounded-lg border border-blue-500/20">Info</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white mb-1">{{ $notification->title }}</div>
                            <div class="text-xs text-gray-400 truncate max-w-xs" title="{{ $notification->message }}">{{ $notification->message }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">
                            @if($notification->voucher)
                                <span class="inline-flex items-center gap-1 font-mono text-green-400 bg-green-500/10 px-2 py-0.5 rounded border border-green-500/20 text-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    {{ $notification->voucher->code }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">
                            {{ $notification->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-500 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p class="text-lg font-bold text-white mb-1">Belum Ada Notifikasi</p>
                                <p class="text-sm">Anda belum mengirim notifikasi apapun kepada member.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="grid grid-cols-1 gap-4 md:hidden p-4">
        @forelse($notifications as $notification)
            <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex flex-col gap-3 relative">
                <!-- Delete Button (Top Right) -->
                <div class="absolute top-3 right-3">
                    <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 text-gray-500 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
                
                <div class="flex items-center gap-3 pr-10">
                    @if($notification->user_id)
                        <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center font-bold text-blue-400 shrink-0">
                            {{ substr($notification->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Member Spesifik</div>
                            <div class="font-bold text-white text-sm">{{ $notification->user->name ?? 'Member' }}</div>
                        </div>
                    @else
                        <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center font-bold text-purple-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Broadcast</div>
                            <div class="font-bold text-purple-400 text-sm">Semua Member</div>
                        </div>
                    @endif
                </div>

                <div class="mt-2">
                    <div class="font-bold text-white text-base mb-1">{{ $notification->title }}</div>
                    <div class="text-sm text-gray-400">{{ $notification->message }}</div>
                </div>
                
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    @if($notification->type === 'promo')
                        <span class="px-2 py-1 bg-green-500/10 text-green-400 text-[10px] font-bold rounded uppercase tracking-wider">Promo</span>
                    @elseif($notification->type === 'warning')
                        <span class="px-2 py-1 bg-yellow-500/10 text-yellow-400 text-[10px] font-bold rounded uppercase tracking-wider">Peringatan</span>
                    @else
                        <span class="px-2 py-1 bg-blue-500/10 text-blue-400 text-[10px] font-bold rounded uppercase tracking-wider">Info</span>
                    @endif

                    @if($notification->voucher)
                        <span class="inline-flex items-center gap-1 font-mono text-green-400 bg-green-500/10 px-2 py-1 rounded border border-green-500/20 text-[10px]">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            {{ $notification->voucher->code }}
                        </span>
                    @endif
                    <span class="text-xs text-gray-500 ml-auto">{{ $notification->created_at->format('d M y H:i') }}</span>
                </div>
            </div>
        @empty
            <div class="text-center py-10 text-gray-500 text-sm bg-black/20 rounded-xl border border-white/5 border-dashed">
                Belum ada notifikasi
            </div>
        @endforelse
    </div>
    
    @if($notifications->hasPages())
        <div class="p-4 border-t border-white/5 bg-black/20">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection
