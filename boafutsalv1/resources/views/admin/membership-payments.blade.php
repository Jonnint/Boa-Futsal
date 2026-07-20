@extends('layouts.admin')

@section('title', 'Pembayaran Member')

@section('content')
<div class="mb-6 md:mb-8">
    <h1 class="text-2xl md:text-4xl font-extrabold mb-2">Pembayaran Member</h1>
    <p class="text-sm md:text-base text-gray-400">Kelola dan approve pembayaran membership</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-4 md:p-8">
    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left">
            <thead class="border-b border-white/10">
                <tr class="border-b border-white/10">
                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-400">ID</th>
                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-400">User</th>
                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-400">Tier</th>
                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-400">Metode</th>
                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-400">Jumlah</th>
                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-400">Status</th>
                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-400">Tanggal</th>
                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                    <td class="py-4 px-4 text-sm font-mono">{{ $payment->transaction_id }}</td>
                    <td class="py-4 px-4">
                        <div class="text-sm font-bold">{{ $payment->user->name }}</div>
                        <div class="text-xs text-gray-400">{{ $payment->user->email }}</div>
                    </td>
                    <td class="py-4 px-4">
                        @if($payment->membership_tier === 'regular')
                            <span class="px-3 py-1 bg-gray-500/10 text-gray-400 rounded-full text-xs font-bold">REGULAR</span>
                        @elseif($payment->membership_tier === 'vip')
                            <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded-full text-xs font-bold">VIP</span>
                        @else
                            <span class="px-3 py-1 bg-purple-500/10 text-purple-400 rounded-full text-xs font-bold">VVIP</span>
                        @endif
                    </td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-xs font-bold">
                            {{ $payment->payment_method }}
                        </span>
                    </td>
                    <td class="py-4 px-4 text-sm font-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td class="py-4 px-4">
                        @if($payment->status === 'pending')
                            <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded-full text-xs font-bold">Pending</span>
                        @elseif($payment->status === 'paid')
                            <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-xs font-bold">Paid</span>
                        @else
                            <span class="px-3 py-1 bg-red-500/10 text-red-400 rounded-full text-xs font-bold">Expired</span>
                        @endif
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-400">
                        {{ $payment->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center gap-2">
                            @if($payment->payment_proof)
                                <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="px-3 py-2 bg-blue-500/20 text-blue-400 rounded-lg text-xs font-bold hover:bg-blue-500/30 transition-all flex items-center justify-center" title="Lihat Bukti">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            @endif

                            @if($payment->status === 'pending')
                                <form method="POST" action="{{ route('admin.membership.approve', $payment->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" 
                                        onclick="return confirm('Approve pembayaran ini dan aktifkan membership?')"
                                        class="px-4 py-2 bg-green-500 text-black rounded-lg text-xs font-bold hover:bg-green-400 transition-all">
                                        ✓ Approve
                                    </button>
                                </form>
                            @elseif(!$payment->payment_proof)
                                <span class="text-xs text-gray-500">-</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-500">Belum ada pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @forelse($payments as $payment)
        <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex flex-col gap-4">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm font-bold text-white">{{ $payment->user->name }}</div>
                    <div class="text-xs text-gray-400 font-mono mt-1">{{ $payment->transaction_id }}</div>
                </div>
                <div>
                    @if($payment->status === 'pending')
                        <span class="px-2 py-1 bg-yellow-500/10 text-yellow-400 rounded text-[10px] font-bold uppercase tracking-wider">Pending</span>
                    @elseif($payment->status === 'paid')
                        <span class="px-2 py-1 bg-green-500/10 text-green-400 rounded text-[10px] font-bold uppercase tracking-wider">Paid</span>
                    @else
                        <span class="px-2 py-1 bg-red-500/10 text-red-400 rounded text-[10px] font-bold uppercase tracking-wider">Expired</span>
                    @endif
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-y-3 gap-x-2 text-xs bg-white/5 p-3 rounded-lg">
                <div>
                    <span class="text-gray-500 block mb-1 text-[10px] uppercase tracking-wider">Tier</span>
                    <span class="font-bold text-white uppercase">{{ $payment->membership_tier }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block mb-1 text-[10px] uppercase tracking-wider">Metode</span>
                    <span class="font-bold text-blue-400 uppercase">{{ $payment->payment_method }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block mb-1 text-[10px] uppercase tracking-wider">Jumlah</span>
                    <span class="font-bold text-green-400 text-sm">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block mb-1 text-[10px] uppercase tracking-wider">Tanggal</span>
                    <span class="text-gray-300">{{ $payment->created_at->format('d M Y H:i') }}</span>
                </div>
            </div>
            
            @if($payment->status === 'pending' || $payment->payment_proof)
                <div class="pt-2 border-t border-white/5 mt-1 flex gap-2">
                    @if($payment->payment_proof)
                        <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="flex-1 py-3 bg-blue-500/20 border border-blue-500/30 text-blue-400 rounded-lg text-sm font-extrabold hover:bg-blue-500/30 transition-all text-center flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Lihat Bukti
                        </a>
                    @endif

                    @if($payment->status === 'pending')
                        <form method="POST" action="{{ route('admin.membership.approve', $payment->id) }}" class="flex-1">
                            @csrf
                            <button type="submit" 
                                onclick="return confirm('Approve pembayaran ini dan aktifkan membership?')"
                                class="w-full py-3 bg-green-500 text-black rounded-lg text-sm font-extrabold hover:bg-green-400 transition-all text-center flex items-center justify-center gap-2 shadow-[0_0_15px_rgba(74,222,128,0.2)]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Approve
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
        @empty
        <div class="text-center py-10 text-gray-500 text-sm bg-black/20 rounded-xl border border-white/5 border-dashed">
            Belum ada data pembayaran
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $payments->links() }}
    </div>
</div>
@endsection
