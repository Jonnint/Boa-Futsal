@extends('layouts.admin')

@section('title', 'Pembayaran Member')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-extrabold mb-2">Pembayaran Member</h1>
    <p class="text-gray-400">Kelola dan approve pembayaran membership</p>
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
                        @if($payment->status === 'pending')
                            <form method="POST" action="{{ route('admin.membership.approve', $payment->id) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                    onclick="return confirm('Approve pembayaran ini dan aktifkan membership?')"
                                    class="px-4 py-2 bg-green-500 text-black rounded-lg text-xs font-bold hover:bg-green-400 transition-all">
                                    ✓ Approve
                                </button>
                            </form>
                        @else
                            <span class="text-xs text-gray-500">-</span>
                        @endif
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

    <div class="mt-6">
        {{ $payments->links() }}
    </div>
</div>
@endsection
